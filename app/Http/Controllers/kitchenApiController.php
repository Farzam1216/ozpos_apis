<?php

namespace App\Http\Controllers;

use App\Mail\Verification;
use App\Mail\ForgotPassword;
use App\Mail\StatusChange;
use App\Mail\VendorOrder;
use App\Mail\DriverOrder;
use App\Models\Cuisine;
use App\Models\Faq;
use App\Models\GeneralSetting;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\NotificationTemplate;
use App\Models\Order;
use App\Models\OrderChild;
use App\Models\Role;
use App\Models\Settle;
use App\Models\Submenu;
use App\Models\DeliveryPerson;
use App\Models\SubmenuCusomizationType;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Vendor;
use App\Models\VendorBankDetail;
use App\Models\VendorDiscount;
use App\Models\WorkingHours;
use Carbon\Carbon;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mail;
use Twilio\Rest\Client;
use OneSignal;
use App\Models\DeliveryZoneArea;
use App\Models\Notification;
use DB;
use Config;
use Log;

class kitchenApiController extends Controller
{
    public function apiLogin(Request $request)
    {
        $request->validate([
            'email_id' => 'bail|required|email',
            'password' => 'bail|required|min:6',
        ]);
        $user = ([
            'email_id' => $request->email_id,
            'password' => $request->password,
            'status' => 1,
        ]);

        if(Auth::attempt($user))
        {
            $user = Auth::user();
            if ($user->roles->contains('title', 'kitchen_user' && $user->vendor_id == '5'))
            {
                if (isset($request->device_token)) {
                    $user->device_token = $request->device_token;
                    $user->save();
                }
                if($user['is_verified'] == 1)
                {
                    $user['token'] =  $user->createToken('mealup')->accessToken;

                    $vendor = Vendor::where('user_id',$user->id)->first();
                    if(isset($vendor)){
                      $user['vendor_own_driver'] = $vendor->vendor_own_driver;
                    }
                    else{
                      $user['vendor_own_driver'] =0;
                    }

                    return response()->json(['success' => true , 'data' => $user], 200);
                }
                else
                {
                    $admin_verify_user = GeneralSetting::find(1)->verification;
                    if($admin_verify_user == 1)
                    {
                        $otp = mt_rand(1000, 9999);
                        $sms_verification = GeneralSetting::first()->verification_phone;
                        $mail_verification = GeneralSetting::first()->verification_email;

                        $verification_content = NotificationTemplate::where('title','verification')->first();

                        $msg_content = $verification_content->notification_content;
                        $mail_content = $verification_content->mail_content;

                        $sid = GeneralSetting::first()->twilio_acc_id;
                        $token = GeneralSetting::first()->twilio_auth_token;

                        $detail['otp'] = $otp;
                        $detail['user_name'] = $user->name;
                        $detail['app_name'] = GeneralSetting::first()->business_name;
                        $data = ["{otp}", "{user_name}"];

                        $user->otp = $otp;
                        $user->save();
                        if($mail_verification == 1)
                        {
                            $message1 = str_replace($data, $detail, $mail_content);
                            try
                            {
                                Mail::to($user->email_id)->send(new Verification($message1));
                            }
                            catch (\Throwable $th)
                            {
                                Log::error($th);
                            }
                        }
                        if($sms_verification == 1)
                        {
                            try
                            {
                                $phone = $user->phone_code . $user->phone;
                                $message1 = str_replace($data, $detail, $msg_content);
                                $client = new Client($sid, $token);
                                $client->messages->create(
                                    $phone,
                                    array(
                                        'from' => GeneralSetting::first()->twilio_phone_no,
                                        'body' => $message1
                                    )
                                );
                            }
                            catch (\Throwable $th) {
                                Log::error($th);
                            }
                        }

                        $vendor = Vendor::where('user_id',$user->id)->first();
                        $user['vendor_own_driver'] = $vendor->vendor_own_driver;

                        return response(['success' => true ,'data' => $user, 'message' => 'Otp send in your account']);
                    }
                }
            }
            else
            {
                return response(['success' => false , 'message' => 'You have no permissions to login. Please ask administrators...'], 401);
            }
        }
        else
        {
            return response()->json(['success' => false ,'message'=>'Email and password wrong..!!'], 401);
        }
    }

    //Order
    public function apiOrder($order_status , $vendor_id)
    {
        $vendor = Vendor::where('id', $vendor_id)->first();
        $orders = NULL;

        if($order_status == 'NewOrders') {
            $orders = Order::where('vendor_id', $vendor_id)->where(function ($query) {
                $query->Where('order_status', 'APPROVE')
                    ->orWhere('order_status', 'PREPARING FOOD')
                    ->orWhere('order_status', 'READY TO PICKUP');
            })->orderBy('id', 'desc')->get()->each->setAppends(['orderItems'])->makeHidden(['created_at', 'updated_at']);
        }
        else if ($order_status == 'PICKUP') {
            $orders = Order::where([['vendor_id', $vendor_id], ['order_status', 'PICKUP']])->orderBy('id', 'desc')->get()->each->setAppends(['orderItems'])->makeHidden(['created_at', 'updated_at']);
        }
        else if ($order_status == 'DELIVERED') {
            $orders = Order::where([['vendor_id', $vendor_id], ['order_status', 'DELIVERED']])->orderBy('id', 'desc')->get()->each->setAppends(['orderItems'])->makeHidden(['created_at', 'updated_at']);
        }
        else if($order_status == 'PastOrders') {
            $orders = Order::where('vendor_id', $vendor_id)->where(function ($query) {
                $query->where('order_status', 'COMPLETE')
                    ->orWhere('order_status', 'CANCEL')
                    ->orWhere('order_status', 'REJECT');
            })->orderBy('id', 'desc')->get()->each->setAppends(['orderItems'])->makeHidden(['created_at', 'updated_at']);
        }

        foreach ($orders as $order) {
            $order->user_name = User::find($order->user_id)->name;
            $order->user_phone = User::find($order->user_id)->phone;
            if ($order->delivery_type == 'HOME') {
                if (isset($order->delivery_person_id)) {
                    $order->delivery_person = DeliveryPerson::find($order->delivery_person_id, ['first_name', 'last_name', 'contact'])->makeHidden(['image', 'deliveryzone']);
                    $order->userAddress = UserAddress::find($order->address_id)->address;
                }
            }
            $order->vendorAddress = Vendor::find($order->vendor_id)->map_address;
        }
        return response(['success' => true, 'data' => $orders]);
    }

    public function apiChangeStatus(Request $request)
    {
        $status = strtoupper($request->status);
        $order = Order::find($request->id);
        if ($order) {


            /* Start - Abdullah */
            if ($request->status == 'PRINT' || $request->status == 'print')
                return $this->print_thermal($order->id);
            /* End - Abdullah */



            $vendor = Vendor::where('id',$order->vendor_id)->first();
            $order->order_status = $status;
            $order->save();
            $user = User::find($order->user_id);
            if ($request->status == 'APPROVE' || $request->status == 'approve')
            {
                $start_time = Carbon::now(env('timezone'))->format('h:i a');
                $order->order_start_time = $start_time;
                $order->save();
            }
            if ($request->status == 'COMPLETE' || $request->status == 'complete')
            {
                $order->order_end_time = Carbon::now(env('timezone'))->format('h:i a');
                $order->save();
            }
            if ($vendor->vendor_driver == 0)
            {
                if ($order->delivery_type == 'HOME' && ($request->status == 'APPROVE' || $request->status == 'approve'))
                {
                    $areas = DeliveryZoneArea::all();
                    $ds = array();
                    foreach ($areas as $value)
                    {
                        $vendorss = explode(',', $value->vendor_id);
                        if (($key = array_search($vendor->id, $vendorss)) !== false)
                        {
                            $ts = DB::select(DB::raw('SELECT id,delivery_zone_id,( 3959 * acos( cos( radians(' . $vendor->lat . ') ) * cos( radians( lat ) ) * cos( radians( lang ) - radians(' . $vendor->lang . ') ) + sin( radians(' . $vendor->lat . ') ) * sin( radians(lat) ) ) ) AS distance FROM delivery_zone_area HAVING distance < ' . $value->radius . ' ORDER BY distance'));
                            foreach ($ts as $t)
                            {
                                array_push($ds, $t->delivery_zone_id);
                            }
                        }
                    }
                    $near_drivers = DeliveryPerson::whereIn('delivery_zone_id', $ds)->get();

                    foreach ($near_drivers as $near_driver)
                    {
                        $driver_notification = GeneralSetting::first()->driver_notification;
                        $driver_mail = GeneralSetting::first()->driver_mail;
                        $content = NotificationTemplate::where('title', 'delivery person order')->first();
                        $detail['drive_name'] = $near_driver->first_name . ' - ' . $near_driver->last_name;
                        $detail['vendor_name'] = $vendor->name;
                        if (UserAddress::find($request->address_id))
                        {
                            $detail['address'] = UserAddress::find($request->address_id)->address;
                        }
                        $h = ["{driver_name}", "{vendor_name}", "{address}"];
                        $notification_content = str_replace($h, $detail, $content->notification_content);
                        if ($driver_notification == 1)
                        {
                            try {
                                Config::set('onesignal.app_id', env('driver_app_id'));
                                Config::set('onesignal.rest_api_key', env('driver_api_key'));
                                Config::set('onesignal.user_auth_key', env('driver_auth_key'));
                                OneSignal::sendNotificationToUser(
                                    $notification_content,
                                    $near_driver->device_token,
                                    $url = null,
                                    $data = null,
                                    $buttons = null,
                                    $schedule = null,
                                    GeneralSetting::find(1)->business_name
                                );
                            }
                            catch (\Throwable $th)
                            {
                                Log::error($th);
                            }
                        }
                        $p_notification = array();
                        $p_notification['title'] = 'create order';
                        $p_notification['user_type'] = 'driver';
                        $p_notification['user_id'] = $near_driver->id;
                        $p_notification['message'] = $notification_content;
                        Notification::create($p_notification);
                        if ($driver_mail == 1) {
                            $mail_content = str_replace($h, $detail, $content->mail_content);
                            try
                            {
                                Mail::to($near_driver->email_id)->send(new DriverOrder($mail_content));
                            }
                            catch (\Throwable $th) {
                                Log::error($th);
                            }
                        }
                    }
                }
            }

            app('App\Http\Controllers\NotificationController')->process('customer', 'change_status', 'Order Status Updated', [ $user->id, $user->device_token, $user->email ], $user->name, $order->order_id, $order->time, $order->order_status);



            if($order->delivery_type == 'SHOP')
            {
                $end_time = Carbon::now(env('timezone'))->format('h:i a');
                $order->order_start_time = $end_time;
                $order->save();
                if ($request->status == 'complete' || $request->status == 'COMPLETE')
                {
                    $settle = array();
                    $settle['vendor_id'] = $order->vendor_id;
                    $settle['order_id'] = $order->id;
                    if ($order->payment_type == 'COD')
                    {
                        $settle['payment'] = 0;
                    } else {
                        $settle['payment'] = 1;
                    }
                    $settle['vendor_status'] = 0;
                    $settle['admin_earning'] = $order->admin_commission;
                    $settle['vendor_earning'] = $order->vendor_amount;
                    Settle::create($settle);
                }
            }


            $firebaseQuery =  app('App\Http\Controllers\FirebaseController')->setOrder($order->user_id, $order->id, $order->order_status);

            return response(['success' => true, 'data' => 'status updated']);
        }
        else{
            return response(['success' => false , 'data' => 'order not found']);
        }
    }

}
