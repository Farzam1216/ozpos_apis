<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DeliveryPerson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\GeneralSetting;
use App\Models\Notification;
use App\Models\NotificationTemplate;
use App\Models\PaymentSetting;
// use App\Models\Vendor;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Vendor;
use App\Models\Order;
use App\Models\OrderChild;
use Config;
use Log;
use Cart;
use OneSignal;
use Mail;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function showOrders($id = NULL)
    {
        app('App\Http\Controllers\Vendor\VendorSettingController')->cancel_max_order();
        // app('App\Http\Controllers\DriverApiController')->cancel_max_order();
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get(['id', 'amount', 'vendor_id', 'order_status', 'delivery_person_id', 'delivery_charge', 'date', 'time', 'address_id']);
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

        $rest = app('App\Http\Controllers\Frontend\RestaurantController')->getRest($id);
        return view('frontend/orders',compact('rest', 'orders'));
    }
    public function getOrders()
    {
        app('App\Http\Controllers\Vendor\VendorSettingController')->cancel_max_order();
        // app('App\Http\Controllers\DriverApiController')->cancel_max_order();
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get(['id', 'amount', 'vendor_id', 'order_status', 'delivery_person_id', 'delivery_charge', 'date', 'time', 'address_id']);
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

        return json_encode($orders);
    }
    public function getOrder($order_id)
    {
        app('App\Http\Controllers\Vendor\VendorSettingController')->cancel_max_order();
        // app('App\Http\Controllers\DriverApiController')->cancel_max_order();
        $order = Order::find($order_id);

        if ($order->delivery_person_id != null) {
            $delivery_person = DeliveryPerson::find($order->delivery_person_id);
            $order->delivery_person = [
                'name' => $delivery_person->first_name . ' ' . $delivery_person->last_name,
                'image' => $delivery_person->image,
                'contact' => $delivery_person->contact,
            ];
        }

        return json_encode($order);
    }
    public function trackOrder($order_id)
    {
        $order = Order::select('id', 'amount', 'vendor_id', 'order_status', 'delivery_person_id', 'delivery_charge', 'date', 'time', 'address_id')->where([['id', $order_id], ['user_id', auth()->user()->id]])->first();

        $trackData = array();
        $trackData['userLat'] = UserAddress::find($order->address_id)->lat;
        $trackData['userLang'] = UserAddress::find($order->address_id)->lang;
        $trackData['vendorLat'] = Vendor::find($order->vendor_id)->lat;
        $trackData['vendorLang'] = Vendor::find($order->vendor_id)->lang;
        $trackData['driverLat'] = DeliveryPerson::find($order->delivery_person_id)->lat;
        $trackData['driverLang'] = DeliveryPerson::find($order->delivery_person_id)->lang;

        return view('frontend/track',compact('order', 'trackData'));
    }

	public function first_index()
    {
         if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
         {
            $url = ( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http').'://'.$_SERVER['HTTP_X_FORWARDED_HOST'];

            if (Cart::content()->isEmpty())
                return redirect($url)->withErrors('Your cart is empty, add at least 1 item.');
            if (!Session::has('delivery_type'))
                return redirect($url)->withErrors('Pick delivery type.');
            if (Session::get('delivery_type') == 'SHOP')
                return redirect($url.'/order/2');
         }
         else
         {
            if (!Session::has('cart_vendor_id'))
                return redirect()->route('customer.home.index')->withErrors('You have not selected any restaurant yet.');
            if (Cart::content()->isEmpty() && !Session::has('cart_vendor_id'))
                return redirect()->back()->withErrors('Your cart is empty, add at least 1 item.');
            if (Cart::content()->isEmpty())
                return redirect()->route('customer.restaurant.get', Session::get('cart_vendor_id'))->withErrors('Your cart is empty, add at least 1 item.');
            if (!Session::has('delivery_type'))
                return redirect()->route('customer.restaurant.get', Session::get('cart_vendor_id'))->withErrors('Pick delivery type.');
            if (Session::get('delivery_type') == 'SHOP')
                return redirect()->route('customer.restaurant.order.second.index', Session::get('cart_vendor_id'));
         }



        $userAddresses = $this->customerUserAddress();
        $page = 2;
        $rest = app('App\Http\Controllers\Frontend\RestaurantController')->getRest(Session::get('cart_vendor_id'));
        return view('frontend/order',compact('rest', 'userAddresses', 'page'));
    }
    public function second_index()
    {
         if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
         {
            $url = ( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http').'://'.$_SERVER['HTTP_X_FORWARDED_HOST'];

            if (Cart::content()->isEmpty())
                return redirect($url)->withErrors('Your cart is empty, add at least 1 item.');
            if (!Session::has('delivery_type'))
                return redirect($url)->withErrors('Pick delivery type.');
            if (Session::get('delivery_type') == 'HOME' && !Session::has('user_address'))
                return redirect($url.'/order/1')->withErrors('Pick delivery address.');
         }
         else
         {
            if (!Session::has('cart_vendor_id'))
                return redirect()->route('customer.home.index')->withErrors('You have not selected any restaurant yet.');
            if (Cart::content()->isEmpty() && !Session::has('cart_vendor_id'))
                return redirect()->back()->withErrors('Your cart is empty, add at least 1 item.');
            if (Cart::content()->isEmpty())
                return redirect()->route('customer.restaurant.get', Session::get('cart_vendor_id'))->withErrors('Your cart is empty, add at least 1 item.');
            if (!Session::has('delivery_type'))
                return redirect()->route('customer.restaurant.get', Session::get('cart_vendor_id'))->withErrors('Pick delivery type.');
            if (Session::get('delivery_type') == 'HOME' && !Session::has('user_address'))
                return redirect()->route('customer.restaurant.order.first.index', Session::get('cart_vendor_id'))->withErrors('Pick delivery address.');
         }

        $userAddresses = $this->customerUserAddress();
        $page = 3;
        $rest = app('App\Http\Controllers\Frontend\RestaurantController')->getRest(Session::get('cart_vendor_id'));
        return view('frontend/payment',compact('rest', 'userAddresses', 'page'));
    }
    public function third_index()
    {
         if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
         {
            $url = ( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http').'://'.$_SERVER['HTTP_X_FORWARDED_HOST'];

            if (Cart::content()->isEmpty())
                return redirect($url)->withErrors('Your cart is empty, add at least 1 item.');
            if (!Session::has('delivery_type'))
                return redirect($url)->withErrors('Pick delivery type.');
            if (Session::get('delivery_type') == 'HOME' && !Session::has('user_address'))
                return redirect($url.'/order/1')->withErrors('Pick delivery address.');
         }
         else
         {
            if (!Session::has('cart_vendor_id'))
                return redirect()->route('customer.home.index')->withErrors('You have not selected any restaurant yet.');
            if (Cart::content()->isEmpty() && !Session::has('cart_vendor_id'))
                return redirect()->back()->withErrors('Your cart is empty, add at least 1 item.');
            if (Cart::content()->isEmpty())
                return redirect()->route('customer.restaurant.get', Session::get('cart_vendor_id'))->withErrors('Your cart is empty, add at least 1 item.');
            if (!Session::has('delivery_type'))
                return redirect()->route('customer.restaurant.get', Session::get('cart_vendor_id'))->withErrors('Pick delivery type.');
            if (Session::get('delivery_type') == 'HOME' && !Session::has('user_address'))
                return redirect()->route('customer.restaurant.order.first.index', Session::get('cart_vendor_id'))->withErrors('Pick delivery address.');
         }

        $cartContent = Cart::content();
        $cartSubTotal = Cart::subtotal();
        $cartTotal = Cart::total();
        $cartTax = Cart::tax();
        Cart::destroy();

        $rest = app('App\Http\Controllers\Frontend\RestaurantController')->getRest(Session::get('cart_vendor_id'));
        return view('frontend/receipt',compact('rest', 'cartContent', 'cartSubTotal', 'cartTax', 'cartTotal'));
    }
    public function book(Request $request)
    {
        if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
        {
            $url = ( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http').'://'.$_SERVER['HTTP_X_FORWARDED_HOST'];

            if (Cart::content()->isEmpty())
                return redirect($url)->withErrors('Your cart is empty, add at least 1 item.');
            if (!Session::has('delivery_type'))
                return redirect($url)->withErrors('Pick delivery type.');
            if (Session::get('delivery_type') == 'HOME' && !Session::has('user_address'))
                return redirect($url.'/order/1')->withErrors('Pick delivery address.');
        }
        else
        {
            if (!Session::has('cart_vendor_id'))
                return redirect()->route('customer.home.index')->withErrors('You have not selected any restaurant yet.');
            if (Cart::content()->isEmpty() && !Session::has('cart_vendor_id'))
                return redirect()->back()->withErrors('Your cart is empty, add at least 1 item.');
            if (Cart::content()->isEmpty())
                return redirect()->route('customer.restaurant.get', Session::get('cart_vendor_id'))->withErrors('Your cart is empty, add at least 1 item.');
            if (!Session::has('delivery_type'))
                return redirect()->route('customer.restaurant.get', Session::get('cart_vendor_id'))->withErrors('Pick delivery type.');
            if (Session::get('delivery_type') == 'HOME' && !Session::has('user_address'))
                return redirect()->route('customer.restaurant.order.first.index', Session::get('cart_vendor_id'))->withErrors('Pick delivery address.');
        }

        $request->validate([
            'payment_method' => 'bail|required',
        ]);

        $dateTime = Carbon::now();
        if (Session::get('delivery_type') == 'HOME') {
            $bookData = array(
                'date' => $dateTime->format('Y-m-d'),
                'time' => $dateTime->format('H:i a'),
                'amount' => intval(Cart::subtotal(2, '.', '')),
                'vendor_id' => Session::get('cart_vendor_id'),
                'delivery_type' => Session::get('delivery_type'),
                'delivery_charge' => 100,
                'address_id' => Session::get('user_address'),
                'order_status' => 'PENDING',
                'payment_type' => request('payment_method'),
                'tax' => json_encode([array("tax" => 9.87, "name" => "other tax")]),
            );
        }
        else {
            $bookData = array(
                'date' => $dateTime->format('Y-m-d'),
                'time' => $dateTime->format('H:i a'),
                'amount' => intval(Cart::subtotal(2, '.', '')+Session::get('cart_delivery_charges')),
                'vendor_id' => Session::get('cart_vendor_id'),
                'delivery_type' => Session::get('delivery_type'),
                'order_status' => 'PENDING',
                'payment_status' => 1,
                'payment_type' => request('payment_method'),
                'tax' => json_encode([array("tax" => 9.87, "name" => "other tax")]),
            );
        }

        $vendor = Vendor::where('id', $bookData['vendor_id'])->first();

        switch ($bookData['payment_type']) {
            case 'STRIPE':
                $bookData['payment_status'] = 1;
                $bookData['payment_token'] = request('stripe_token');
                $stripeResponse = $this->stripePayment( $bookData['payment_token'], $bookData['amount'] );
                $bookData['payment_token'] = $stripeResponse->id;
                break;
            case 'COD':
                $bookData['payment_status'] = 0;
                break;

            default:
                // code...
                break;
        }

        $bookData['user_id'] = auth()->user()->id;

        // if (isset($bookData['promocode_id'])) {
        //     $promocode = PromoCode::find($bookData['promocode_id']);
        //     $promocode->count_max_user = $promocode->count_max_user + 1;
        //     $promocode->count_max_count = $promocode->count_max_count + 1;
        //     $promocode->count_max_order = $promocode->count_max_order + 1;
        //     $promocode->save();
        // }

        $bookData['order_id'] = '#' . rand(100000, 999999);
        $bookData['vendor_id'] = $vendor->id;
        $order = Order::create($bookData);
        // if ($bookData['payment_type'] == 'WALLET') {
        //     $user->withdraw($bookData['amount'], [$order->id]);
        // }
        // $bookData['item'] = json_decode($bookData['item'], true);
        foreach (Cart::content() as $child_item) {
            $order_child = array();
            $order_child['order_id'] = $order->id;
            $order_child['item'] = $child_item->id;
            $order_child['price'] = $child_item->price;
            $order_child['qty'] = $child_item->qty;
            if ($child_item->options->has('custimization')) {
                $order_child['custimization'] = addslashes($child_item->options['custimization']);
                $order_child['custimization'] = "\"".$order_child['custimization']."\"";
            }
            OrderChild::create($order_child);
        }
        $this->sendVendorOrderNotification($vendor, $order->id);
        // $this->sendUserNotification($bookData['user_id'], $bookData['order_id']);
        $amount = $order->amount;
        $tax = array();
        if ($vendor->admin_comission_type == 'percentage') {
            $comm = $amount * $vendor->admin_comission_value;
            $tax['admin_commission'] = intval($comm / 100);
            $tax['vendor_amount'] = intval($amount - $tax['admin_commission']);
        }
        if ($vendor->admin_comission_type == 'amount') {
            $tax['vendor_amount'] = $amount - $vendor->admin_comission_value;
            $tax['admin_commission'] = $amount - $tax['vendor_amount'];
        }
        $order->update($tax);
        // return;
        // Log::debug($order);
        // if ($order->payment_type == 'FLUTTERWAVE') {
        //     return response(['success' => true, 'url' => url('FlutterWavepayment/' . $order->id), 'data' => "order booked successfully wait for confirmation"]);
        // } else {
            return response(['success' => true, 'data' => "order booked successfully wait for confirmation"]);
        // }
    }

    public function customerUserAddress()
    {
        $user_address = UserAddress::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        return $user_address;
    }

    public function stripePayment($stripeToken, $payment)
    {
        $paymentSetting = PaymentSetting::find(1);
        $stripe_sk = $paymentSetting->stripe_secret_key;
        $currency = GeneralSetting::find(1)->currency;
        $stripe = new \Stripe\StripeClient($stripe_sk);
        $charge = $stripe->charges->create([
            "amount" => $payment,
            "currency" => $currency,
            "source" => $stripeToken,
            "description" => "This payment is testing purpose of",
        ]);
        return $charge;
    }









    public function sendVendorOrderNotification($vendor, $order_id)
    {
        $vendor_notification = GeneralSetting::first()->vendor_notification;
        $vendor_mail = GeneralSetting::first()->vendor_mail;
        $content = NotificationTemplate::where('title', 'vendor order')->first();
        $vendor_user = User::where('id', $vendor->user_id)->first();
        if ($vendor->vendor_language == 'spanish') {
            $detail['Vendor_name'] = $vendor->name;
            $detail['Order_id'] = $order_id;
            $detail['User_name'] = auth()->user()->name;
            $v = ["{Vendor_name}", "{Order_id}", "{User_name}"];
            $notification_content = str_replace($v, $detail, $content->spanish_notification_content);
            if ($vendor_notification == 1) {
                try {
                    Config::set('onesignal.app_id', env('vendor_app_id'));
                    Config::set('onesignal.rest_api_key', env('vendor_api_key'));
                    Config::set('onesignal.user_auth_key', env('vendor_auth_key'));
                    OneSignal::sendNotificationToUser(
                        $notification_content,
                        $vendor_user->device_token,
                        $url = null,
                        $data = null,
                        $buttons = null,
                        $schedule = null,
                        GeneralSetting::find(1)->business_name
                    );
                } catch (\Throwable $th) {
                }
            }
            $p_notification = array();
            $p_notification['title'] = 'create order';
            $p_notification['user_type'] = 'vendor';
            $p_notification['user_id'] = $vendor->id;
            $p_notification['message'] = $notification_content;
            Notification::create($p_notification);
            $mail = str_replace($v, $detail, $content->spanish_mail_content);
            if ($vendor_mail == 1) {
                try {
                    Mail::to($vendor->email_id)->send(new VendorOrder($mail));
                } catch (\Throwable $th) {
                }
            }
            return true;
        } else {
            $detail['Vendor_name'] = $vendor->name;
            $detail['Order_id'] = $order_id;
            $detail['User_name'] = auth()->user()->name;
            $v = ["{Vendor_name}", "{Order_id}", "{User_name}"];
            $notification_content = str_replace($v, $detail, $content->notification_content);
            if ($vendor_notification == 1) {
                try {
                    Config::set('onesignal.app_id', env('vendor_app_id'));
                    Config::set('onesignal.rest_api_key', env('vendor_api_key'));
                    Config::set('onesignal.user_auth_key', env('vendor_auth_key'));
                    OneSignal::sendNotificationToUser(
                        $notification_content,
                        $vendor_user->device_token,
                        $url = null,
                        $data = null,
                        $buttons = null,
                        $schedule = null,
                        GeneralSetting::find(1)->business_name
                    );
                } catch (\Throwable $th) {
                }
            }
            $p_notification = array();
            $p_notification['title'] = 'create order';
            $p_notification['user_type'] = 'vendor';
            $p_notification['user_id'] = $vendor->id;
            $p_notification['message'] = $notification_content;
            Notification::create($p_notification);
            $mail = str_replace($v, $detail, $content->mail_content);
            if ($vendor_mail == 1) {
                try {
                    Mail::to($vendor->email_id)->send(new VendorOrder($mail));
                } catch (\Throwable $th) {
                }
            }
            return true;
        }
    }

}
