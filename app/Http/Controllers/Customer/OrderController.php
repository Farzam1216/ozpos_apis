<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\DeliveryPerson;
use App\Models\Order;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

  public function orderHistory()
  {
    app('App\Http\Controllers\Vendor\VendorSettingController')->cancel_max_order();
    // app('App\Http\Controllers\DriverApiController')->cancel_max_order();
    $pendingOrders = Order::where('user_id', auth()->user()->id)
                      ->where('order_status','PENDING')->orderBy('id', 'DESC')->get();
    $cancelOrders = Order::where('user_id', auth()->user()->id)
                      ->where('order_status','CANCEL')->orderBy('id', 'DESC')->get();
    $completeOrders = Order::where('user_id', auth()->user()->id)
                      ->where('order_status','COMPLETE')->orderBy('id', 'DESC')->get();
    // foreach ($orders as $order) {
    //    if ($order->delivery_person_id != null) {
    //       $delivery_person = DeliveryPerson::find($order->delivery_person_id);
    //       $order->delivery_person = [
    //           'name' => $delivery_person->first_name . ' ' . $delivery_person->last_name,
    //           'image' => $delivery_person->image,
    //           'contact' => $delivery_person->contact,
    //       ];
    //    }
    // }
    // dd($cancelOrders);
    $user=Auth::user()->id;
    $userAddress = UserAddress::where('user_id',$user)->get();
    $selectedAddress = UserAddress::where(['user_id'=>$user,'selected'=> 1])->first();
    return view('customer.my-order',compact('pendingOrders','cancelOrders','completeOrders','userAddress','selectedAddress'));
  }

}
