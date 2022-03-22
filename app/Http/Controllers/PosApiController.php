<?php

namespace App\Http\Controllers;

use App\Models\booktable;
   use App\Mail\ForgotPassword;
   use App\Mail\StatusChange;
   use App\Mail\VendorOrder;
   use App\Mail\DriverOrder;
   use App\Models\Banner;
use App\Mail\Verification;
use App\Models\vendorTable;
use App\Models\BusinessSetting;
   use App\Models\Cuisine;
   use App\Models\DeliveryPerson;
   use App\Models\HalfNHalfMenu;
   use App\Models\ItemCategory;
   use App\Models\ItemSize;
   use App\Models\MenuCategory;
   use App\Models\WalletPayment;
   use App\Models\DeliveryZoneArea;
   use App\Models\Faq;
   use App\Models\Feedback;
   use App\Models\GeneralSetting;
   use App\Models\Menu;
   use App\Models\Notification;
   use App\Models\NotificationTemplate;
   use App\Models\Order;
   use App\Models\OrderChild;
   use App\Models\OrderSetting;
   use App\Models\PaymentSetting;
   use App\Models\PromoCode;
   use App\Models\Review;
   use App\Models\Refund;
   use App\Models\Role;
   use App\Models\Submenu;
   use App\Models\SubmenuCusomizationType;
   use App\Models\User;
   use App\Models\UserAddress;
   use App\Models\Vendor;
   use App\Models\VendorDiscount;
   use App\Models\WorkingHours;
   use App\Models\Tax;
   use Carbon\Carbon;
   use Config;
   use DB;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Auth;
   use Illuminate\Support\Facades\Hash;
   use Mail;
   use OneSignal;
   use Stripe\Stripe;
   use Twilio\Rest\Client;
   use Bavix\Wallet\Models\Transaction;
   use Arr;
   use Log;

class PosApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function apiUserLogin(Request $request)
    {
      log::info($request);
       $request->validate([
           'email_id' => 'bail|required|email',
           'password' => 'bail|required|min:6',
           'provider_token' => 'bail|required_if:provider:GOOGLE,FACEBOOK',
           'provider' => 'bail|required',
       ]);
       $user = ([
           'email_id' => $request->email_id,
           'password' => $request->password,
       ]);

       if ($request->provider == 'LOCAL') {
          if (Auth::attempt($user)) {
             $user = Auth::user();
             if ($user->status == 1) {
                if ( $user->roles->contains('title', 'pos_user')) {
                   if (isset($request->device_token)) {
                      $user->device_token = $request->device_token;
                      $user->save();
                   }
                   if ($user['is_verified'] == 1) {
                      $user['token'] = $user->createToken('mealUp')->accessToken;
                      return response()->json(['success' => true, 'data' => $user], 200);
                   } else {
                      $this->sendNotification($user);
                      return response(['success' => true, 'data' => $user, 'msg' => 'Otp send in your account']);
                   }
                } else {
                   return response(['success' => false, 'msg' => 'You have no permissions to login. Please ask administrators...']);
                }
             } else {
                return response()->json(['success' => false, 'message' => 'you are block by admin please contact support'], 401);
             }
          } else {
             return response()->json(['success' => false, 'message' => 'credintial does not match our record']);
          }
       } else {
          $data = $request->all();
          $data['role'] = 0;
          $data['is_verified'] = 1;
          $filtered = Arr::except($data, ['provider_token']);
          if ($data['provider'] !== 'LOCAL') {
             $user = User::where('email', $data['email'])->first()->makeHidden('otp');
             if ($user) {
                $user->provider_token = $request->provider_token;
                $token = $user->createToken('mealUp')->accessToken;
                $user->save();
                $user['token'] = $token;
                return response()->json(['success' => true, 'data' => $user], 200);
             } else {
                $data = User::firstOrCreate(['provider_token' => $request->provider_token], $filtered);
                if ($request->image != null) {
                   $url = $request->image;
                   $contents = file_get_contents($url);
                   $name = substr($url, strrpos($url, '/') + 1);
                   $destinationPath = public_path('/images/upload/') . $name . '.png';
                   file_put_contents($destinationPath, $contents);
                   $data['image'] = $name . '.png';
                } else {
                   $data['image'] = 'noimage.png';
                }
                if (isset($data['device_token'])) {
                   $data['device_token'] = $data->device_token;
                }
                $data->save();
                $token = $data->createToken('mealUp')->accessToken;
                $data['token'] = $token;
                return response()->json(['success' => true, 'data' => $data], 200);
             }
          }
       }
    }

    public function apiSingleVendor($vendor_id)
      {
         $master = array();
         $master['vendor'] = Vendor::where('id', $vendor_id)->first();
         if ($master['vendor']->tax == null) {
            $master['vendor']->tax = strval(5);
         }

         $MenuCategory =
             MenuCategory::with([
                 'SingleMenu' => function($query) {
                    $query->where('single_menu.status',1);
                 },

                 'SingleMenu.Menu.MenuAddon.Addon.AddonCategory',
                 'SingleMenu.Menu.GroupMenuAddon.AddonCategory',
                 'SingleMenu.Menu.MenuSize.GroupMenuAddon.AddonCategory',
                 'SingleMenu.Menu.MenuSize.MenuAddon.Addon.AddonCategory',
                 'SingleMenu.Menu.MenuSize.ItemSize',
                 'SingleMenu.SingleMenuItemCategory.ItemCategory',
                 'HalfNHalfMenu.ItemCategory',
                 'DealsMenu.DealsItems.ItemCategory',
             ])
                 ->where([['menu_category.vendor_id', $vendor_id], ['menu_category.status', 1]])
                 ->get();

         $master['MenuCategory'] = $MenuCategory;
         return response(['success' => true, 'data' => $master]);
      }

      public function apiOrderSetting($vendor_id)
      {
         $User = auth()->user();
         $UserAddress = UserAddress::where([['user_id', 155], ['selected', 1]])->first();
         $Vendor = Vendor::find($vendor_id);
        //  $vendorTable = vendorTable::where('vendor_id',$vendor_id)->with('booktables')->first();
         $bookTable = booktable::where('vendor_id',$vendor_id)->get();
        //  $notBookedTable = [];
        //  $bookedTable = [];

         $Setting = OrderSetting::firstOrCreate([
             'vendor_id' => $vendor_id,
         ], [
             'vendor_id' => $vendor_id,
             'free_delivery' => 0,
             'free_delivery_distance' => 10,
             'free_delivery_amount' => 0,
             'min_order_value' => 200,
             'order_commission' => 0,
             'order_assign_manually' => '0',
             'orderRefresh' => '5',
             'order_dashboard_default_time' => '7days',
             'vendor_order_max_time' => '60',
             'driver_order_max_time' => '60',
             'delivery_charge_type' => 'order_amount',
             'charges' => '[]',
         ]);


         $googleApiKey = 'AIzaSyCfl4ZvZl3ptxZDO_4D8J4F0T_yqzzIVes';
         $googleUrl = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&destinations="' . $UserAddress->lat . ',' . $UserAddress->lang . '"&origins="' . $Vendor->lat . ',' . $Vendor->lang . '"&key=' . $googleApiKey . '';
          //  $googleDistance =
        //      file_get_contents(
        //          $googleUrl,
        //      );
        // //  \Log::critical($googleDistance);
        //  $googleDistance = json_decode($googleDistance);
        //     if(isset($googleDistance->rows[0]->elements[0]->distance->value)){
        //       $Setting['distance'] = ($googleDistance->status == "OK") ? $googleDistance->rows[0]->elements[0]->distance->value : 'no route found';
        //     }
        //     else{
        //       $Setting['distance'] = 1.1;
        //     }
         $Setting['distance'] = 1.1;
         $Setting['tax_type'] = $Vendor->tax_type;
         $Setting['tax'] = $Vendor->tax;
         $Setting['resturant_dining_status'] = $Vendor->resturant_dining_status;
         $Setting['total_tables_number'] = $Vendor->total_tables_number;
        //  $Setting['vendor_tables'] = $vendorTable;
        //  $Setting['notbookedTable'] = array_values($remainigTable);
         $Setting['bookedTable'] = $bookTable;

         return response(['success' => true, 'data' => $Setting]);
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiVendorStatus($vendor_id)
    {
       $Vendor = Vendor::select('id', 'vendor_status', 'delivery_status', 'pickup_status')->find($vendor_id)->makeHidden('image', 'vendor_logo', 'cuisine', 'rate', 'review');

       if (!$Vendor){

        return response(['success' => false, 'msg' => 'vendor not found.']);
       }

       return response(['success' => true, 'data' => $Vendor]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function apiBookOrder(Request $request)
    {

       $validation = $request->validate([
           'date' => 'bail|required',
           'time' => 'bail|required',
           'amount' => 'bail|required|numeric',
           'sub_total' => 'bail|required|numeric',
           'item' => 'bail|required',
           'vendor_id' => 'required',
           'delivery_type' => 'bail|required',
//             'address_id' => 'bail|required_if:delivery_type,HOME',
        //   'payment_type' => 'bail|required',
        //   'payment_token' => 'bail|required_if:payment_type,STRIPE,RAZOR,PAYPAl',
          // 'delivery_charge' => 'bail|required_if:delivery_type,HOME',
//             'tax' => 'required',
       ]);


       $bookData = $request->all();
       $bookData['amount'] = (float)number_format((float)$bookData['amount'], 2, '.', '');
       $bookData['sub_total'] = (float)number_format((float)$bookData['sub_total'], 2, '.', '');
       $bookData['address_id'] = 32;

       if($bookData['delivery_date'] != null && $bookData['delivery_time'] != null)
       {
          $bookData['delivery_date'] = Carbon::createFromFormat('Y-m-d H:i:s.u', $bookData['delivery_date'])->format('Y-m-d');
          $bookData['delivery_time'] = Carbon::createFromFormat('g:i A', $bookData['delivery_time'])->format('H:i:s');

          $dateTime = $bookData['delivery_date'] .' '.$bookData['delivery_time'];
          $bookData['delivery_time'] = $dateTime;
       }

       $vendor = Vendor::where('id', $bookData['vendor_id'])->first();

       $vendorUser = User::find($vendor->user_id);
       $customer = User::find($vendor->user_id);
       if ($bookData['payment_type'] == 'STRIPE') {
          $paymentSetting = PaymentSetting::find(1);
          $stripe_sk = $paymentSetting->stripe_secret_key;
          $currency = GeneralSetting::find(1)->currency;
          $stripe = new \Stripe\StripeClient($stripe_sk);
          $token =  $stripe->tokens->create([
              'card' => [
                'number' => $bookData['card_number'],
                'exp_month' => $bookData['expiry_month'],
                'exp_year' => $bookData['expiry_year'],
                'cvc' => $bookData['cvv'],
              ],
            ]);
            $charge = $stripe->charges->create(
              [
                  "amount" => $bookData['amount'] * 100,
                  "currency" => $currency,
                  "source" => $token->id,
                  "description" => "payment for online food order",
              ]);
              log::info($charge);
          $bookData['payment_token'] = $charge->id;

       }
       if ($bookData['payment_type'] == 'WALLET') {
          $user = auth()->user();
          if ($bookData['amount'] > $user->balance) {
             return response(['success' => false, 'data' => "You Don't Have Sufficient Wallet Balance."]);
          }
       }
       $bookData['user_id'] = 155;

       $PromoCode = PromoCode::find($bookData['promocode_id']);
       if ($PromoCode) {
          $PromoCode->count_max_user = $PromoCode->count_max_user + 1;
          $PromoCode->count_max_count = $PromoCode->count_max_count + 1;
          $PromoCode->count_max_order = $PromoCode->count_max_order + 1;
          $PromoCode->save();
       } else {
          $bookData['promocode_id'] = null;
          $bookData['promocode_price'] = 0;
       }

       if( isset($bookData['old_order_id'])){

       }
       else
       {
            $bookData['order_id'] = '#' . rand(100000, 999999);
       }
       $bookData['vendor_id'] = $vendor->id;
       $bookData['order_data'] = $bookData['item'];
       $bookData['delivery_time'] = $bookData['delivery_time'];

       if(isset($bookData['old_order_id']) ){

          $order =Order::find($bookData['old_order_id']);

          $order->order_data =  $bookData['item'];
          $order->amount =  $bookData['amount'];
          $order->delivery_type =  $bookData['delivery_type'];
          $order->delivery_charge = $bookData['delivery_charge'];
          $order->payment_type =  $bookData['payment_type'];
          $order->payment_status =  $bookData['payment_status'];
          $order->order_status =  $bookData['order_status'];
          $order->promocode_id =  $bookData['promocode_id'];
          $order->payment_token =  $bookData['payment_token'];
          $order->promocode_price =  $bookData['promocode_price'];
          $order->tax =  $bookData['tax'];
          $order->table_no = $bookData['table_no'];
          $order->update();
       }
       else{
            $order = Order::create($bookData);
       }

       app('App\Http\Controllers\NotificationController')->process('vendor', 'order', 'New Order', [$vendorUser->id, $vendorUser->device_token, $vendorUser->email], $vendorUser->name, $order->order_id, $customer->name, $order->time);
       $amount = $order->amount;

       $tax = array();
       if ($vendor->admin_comission_type == 'percentage') {
          $comm = $amount * $vendor->admin_comission_value;
          $tax['admin_commission'] = 0;
          $tax['vendor_amount'] = 1;
       }
       if ($vendor->admin_comission_type == 'amount') {
          $tax['vendor_amount'] = 0;
          $tax['admin_commission'] = 0;
       }

       $notification = BusinessSetting::where([['vendor_id',$vendor->id],['key','0']])->first();
         if($notification)
         {
            $notification->vendor_id = $vendor->id;
               $notification->key = '1';
               $notification->update();
         }
         else
         {
            $notification = new BusinessSetting;
            $notification->vendor_id = $vendor->id;
            $notification->key = '1';
            $notification->save();
         }
               $order->update($tax);

       $firebaseQuery = app('App\Http\Controllers\FirebaseController')->setOrder($order->user_id, $order->id, $order->order_status);
       return response(['success' => true, 'data' => "order booked successfully wait for confirmation"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function apiShowOrder()
    {
      app('App\Http\Controllers\Vendor\VendorSettingController')->cancel_max_order();
      $orders = Order::where('user_id', 155)->orderBy('id', 'DESC')->get();
       foreach ($orders as $order) {
          if ($order->delivery_person_id != null) {
             $delivery_person = DeliveryPerson::find($order->delivery_person_id);
             $order->delivery_person = [
                 'name' => $delivery_person->first_name . ' ' . $delivery_person->last_name,
                 'image' => $delivery_person->image,
                 'contact' => $delivery_person->contact,
             ];
          }
       }
       return response(['success' => true, 'data' => $orders]);
    }

    public function apiSingleVendorRetrieveSizes($vendor_id, $item_category_id)
    {
       $data = ItemSize::with([
           'MenuSize.Menu.SingleMenu.SingleMenuItemCategory' => function ($query) use ($item_category_id) {
              $query->where('item_category_id', $item_category_id);

           },
           'MenuSize.GroupMenuAddon.AddonCategory',
           'MenuSize.MenuAddon.Addon.AddonCategory',
       ])->where('vendor_id', $vendor_id)->get();

//         Log::info(json_encode(['success' => true, 'data' => $data], JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
       return response(['success' => true, 'data' => $data]);
    }

    public function apiSingleVendorRetrieveSize($vendor_id, $item_category_id, $item_size_id)
    {

//         Log::info($item_category_id);
//         Log::info($item_size_id);
       $data = ItemSize::with([
           'MenuSize.Menu.SingleMenu.SingleMenuItemCategory' => function ($query) use ($item_category_id) {
              $query->where('item_category_id', $item_category_id);

           },
           'MenuSize.GroupMenuAddon.AddonCategory',
           'MenuSize.MenuAddon.Addon.AddonCategory',
       ])->where([['id', $item_size_id], ['vendor_id', $vendor_id]])->first();


       Log::info(json_encode(['success' => true, 'data' => $data], JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
       return response(['success' => true, 'data' => $data]);
    }

    public function apiPromoCode($vendor_id)
    {
       $promo = PromoCode::where('status', 1);
       $v = [];
       $promo_codes = PromoCode::where([['status', 1], ['display_customer_app', 1]])->get();
       foreach ($promo_codes as $promo_code) {
          $vendorIds = explode(',', $promo_code->vendor_id);
          if (($key = array_search($vendor_id, $vendorIds)) !== false) {
             array_push($v, $promo_code->id);
          }
       }
       $promo = $promo->whereIn('id', $v)->get();
       return response(['success' => true, 'data' => $promo]);
    }

    public function apiTax()
    {
       $taxs = Tax::whereStatus(1)->get(['id', 'name', 'tax', 'type']);
       return response(['success' => true, 'data' => $taxs]);
    }

    public function apiApplyPromoCode(Request $request)
    {
       $request->validate([
           'date' => 'required',
           'amount' => 'required',
           'delivery_type' => 'required',
           'promocode_id' => 'required',
       ]);
       $data = $request->all();

       $currency = GeneralSetting::first()->currency_symbol;
       $promoCode = PromoCode::find($data['promocode_id']);

       $users = explode(',', $promoCode->customer_id);
       if (($key = array_search(auth()->user()->id, $users)) !== false) {
          $exploded_date = explode(' - ', $promoCode->start_end_date);
          $currentDate = date('Y-m-d', strtotime($data['date']));
          if (($currentDate >= $exploded_date[0]) && ($currentDate <= $exploded_date[1])) {
             if ($promoCode->min_order_amount < $data['amount']) {
                if ($promoCode->coupen_type == 'both') {
                   if ($promoCode->count_max_count < $promoCode->max_count && $promoCode->count_max_order < $promoCode->max_order && $promoCode->count_max_user < $promoCode->max_user) {
                      $promo = PromoCode::where('id', $data['promocode_id'])->first(['id', 'image', 'isFlat', 'flatDiscount', 'discount', 'discountType']);
                      Log::critical($promo);
                      return response(['success' => true, 'data' => $promo]);
                   } else {
                      return response(['success' => false, 'data' => 'This Coupon is expire..!!']);
                   }
                } else {
                   if ($promoCode->coupen_type == $data['delivery_type']) {
                      if ($promoCode->count_max_count < $promoCode->max_count && $promoCode->count_max_order < $promoCode->max_order && $promoCode->count_max_user < $promoCode->max_user) {
                         $promo = PromoCode::where('id', $data['promocode_id'])->first(['id', 'image', 'isFlat', 'flatDiscount', 'discount', 'discountType']);
                         Log::critical($promo);
                         return response(['success' => true, 'data' => $promo]);
                      } else {
                         return response(['success' => false, 'data' => 'This Coupon is expire..!!']);
                      }
                   } else {
                      return response(['success' => false, 'data' => 'This Coupon is not valid for ' . $data['delivery_type']]);
                   }
                }
             } else {
                return response(['success' => false, 'data' => 'This Coupon not valid for less than ' . $currency . $promoCode->min_order_amount . ' amount']);
             }
          } else {
             return response(['success' => false, 'data' => 'Coupon is expire..!!']);
          }
       } else {
          return response(['success' => false, 'data' => 'Coupon is not valid for this user..!!']);
       }
    }

    public function apiCuisine()
    {
       $cuisines = Cuisine::where('status', 1)->orderBy('id', 'DESC')->get();
       return response(['success' => true, 'data' => $cuisines]);
    }

    public function apiFaq()
    {
       $faqs = Faq::where('type', 'customer')->orderBy('id', 'DESC')->get();
       return response(['success' => true, 'data' => $faqs]);
    }

    public function apiSetting()
    {
       $setting = GeneralSetting::first();
       return response(['success' => true, 'data' => $setting]);
    }



    /**
     * @throws \JsonException
     */




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
