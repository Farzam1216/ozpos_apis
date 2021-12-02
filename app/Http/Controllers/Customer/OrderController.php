<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\DeliveryPerson;
use App\Models\Menu;
use App\Models\Order;
use App\Models\SingleMenu;
use App\Models\UserAddress;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

  public function orderHistory()
  {
    app('App\Http\Controllers\Vendor\VendorSettingController')->cancel_max_order();
    // app('App\Http\Controllers\DriverApiController')->cancel_max_order();
    $pendingOrders = Order::where('user_id', auth()->user()->id)
                      ->where(function($q) {
                        $q->where('order_status','PENDING')
                      ->orWhere('order_status','APPROVE')
                      ->orWhere('order_status','ACCEPT')
                      ->orWhere('order_status','PICKUP')
                      ->orWhere('order_status','DELIVERED')
                      ->orWhere('order_status','REJECT');
                    })->orderBy('id', 'DESC')->get();
                      // dd($pendingOrders);

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

    $user=Auth::user()->id;
    $userAddress = UserAddress::where('user_id',$user)->get();
    $selectedAddress = UserAddress::where(['user_id'=>$user,'selected'=> 1])->first();
    return view('customer.my-order',compact('pendingOrders','cancelOrders','completeOrders','userAddress','selectedAddress'));
  }


  public function getOrderModel($order_id)
  {
    // dd($order_id);
      // app('App\Http\Controllers\Vendor\VendorSettingController')->cancel_max_order();
      // app('App\Http\Controllers\DriverApiController')->cancel_max_order();
      $order = Order::find($order_id);

      // if ($order->delivery_person_id != null) {
      //     $delivery_person = DeliveryPerson::find($order->delivery_person_id);
      //     $order->delivery_person = [
      //         'name' => $delivery_person->first_name . ' ' . $delivery_person->last_name,
      //         'image' => $delivery_person->image,
      //         'contact' => $delivery_person->contact,
      //     ];
      // }
      // dd($order->userAddress->address);
      return view('customer.modals.track_Onprocess',compact('order'));
  }
  public function singleGetOrderModel($id,$order_id)
  {
    // dd($order_id);
      // app('App\Http\Controllers\Vendor\VendorSettingController')->cancel_max_order();
      // app('App\Http\Controllers\DriverApiController')->cancel_max_order();
      $order = Order::find($order_id);

      // if ($order->delivery_person_id != null) {
      //     $delivery_person = DeliveryPerson::find($order->delivery_person_id);
      //     $order->delivery_person = [
      //         'name' => $delivery_person->first_name . ' ' . $delivery_person->last_name,
      //         'image' => $delivery_person->image,
      //         'contact' => $delivery_person->contact,
      //     ];
      // }
      // dd($order->userAddress->address);
      return view('customer.modals.track_Onprocess',compact('order'));
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
  public function singleGetOrder($id,$order_id)
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
      // dd($order);
      $trackData = array();
      $trackData['userLat'] = UserAddress::find($order->address_id)->lat;
      $trackData['userLang'] = UserAddress::find($order->address_id)->lang;
      $trackData['vendorLat'] = Vendor::find($order->vendor_id)->lat;
      $trackData['vendorLang'] = Vendor::find($order->vendor_id)->lang;
      $trackData['driverLat'] = DeliveryPerson::find($order->delivery_person_id)->lat;
      $trackData['driverLang'] = DeliveryPerson::find($order->delivery_person_id)->lang;

      $user=Auth::user()->id;
      $userAddress = UserAddress::where('user_id',$user)->get();
      $selectedAddress = UserAddress::where(['user_id'=>$user,'selected'=> 1])->first();

      return view('customer/track',compact('order', 'trackData','userAddress','selectedAddress'));
  }
  public function singleTrackOrder($id,$order_id)
  {
      $order = Order::select('id', 'amount', 'vendor_id', 'order_status', 'delivery_person_id', 'delivery_charge', 'date', 'time', 'address_id')->where([['id', $order_id], ['user_id', auth()->user()->id]])->first();
      // dd($order);
      $trackData = array();
      $trackData['userLat'] = UserAddress::find($order->address_id)->lat;
      $trackData['userLang'] = UserAddress::find($order->address_id)->lang;
      $trackData['vendorLat'] = Vendor::find($order->vendor_id)->lat;
      $trackData['vendorLang'] = Vendor::find($order->vendor_id)->lang;
      $trackData['driverLat'] = DeliveryPerson::find($order->delivery_person_id)->lat;
      $trackData['driverLang'] = DeliveryPerson::find($order->delivery_person_id)->lang;

      $user=Auth::user()->id;
      $userAddress = UserAddress::where('user_id',$user)->get();
      $selectedAddress = UserAddress::where(['user_id'=>$user,'selected'=> 1])->first();

      return view('customer/track',compact('order', 'trackData','userAddress','selectedAddress'));
  }

  public function getMenuSizeModel(Request $request)
  {
    // dd($request);
     $SingleMenu = SingleMenu::find($request->singleMenu_id);
     $rest = Vendor::find($request->vendorId);
     $Menu = $SingleMenu->Menu()->get()->first();
     return view('customer.restaurant.single.modals.sizes',compact('Menu','SingleMenu','rest'));
    //  return response()->json(['menu'=> $Menu]);
    // $singleMenu =  Menu::where('id')
  }

}
