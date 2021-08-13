<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\GeneralSetting;
use App\Models\PaymentSetting;
// use App\Models\Vendor;
use App\Models\UserAddress;
use App\Models\Vendor;
use App\Models\Order;
use App\Models\OrderChild;
use Log;
use Cart;
use Carbon\Carbon;

class OrderController extends Controller
{
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
                return redirect()->route('customer.restaurant.order.second.index', request()->route('id'));
         }



        $userAddresses = $this->customerUserAddress();
        $page = 2;
        return view('frontend/order',compact('userAddresses', 'page'));
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
                return redirect()->route('customer.restaurant.order.first.index')->withErrors('Pick delivery address.');
         }

        $userAddresses = $this->customerUserAddress();
        $page = 3;
        return view('frontend/payment',compact('userAddresses', 'page'));
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
                return redirect()->route('customer.restaurant.order.first.index')->withErrors('Pick delivery address.');
         }

        $cartContent = Cart::content();
        $cartSubTotal = Cart::subtotal();
        Cart::destroy();

        return view('frontend/receipt',compact('cartContent', 'cartSubTotal'));
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
                return redirect()->route('customer.restaurant.order.first.index')->withErrors('Pick delivery address.');
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
                'amount' => intval(Cart::subtotal(2, '.', '')),
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
        // $this->sendVendorOrderNotification($vendor, $bookData['order_id']);
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

}