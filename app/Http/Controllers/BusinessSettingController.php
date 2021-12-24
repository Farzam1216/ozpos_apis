<?php

namespace App\Http\Controllers;

use App\Models\BusinessSetting;
use App\Models\Order;
use App\Models\Vendor;
use Auth;
use Illuminate\Http\Request;

class BusinessSettingController extends Controller
{
  public function getNodification()
  {

      $vendor = Vendor::where('user_id',Auth::user()->id)->first();

      $new_order = Order::where('vendor_id',$vendor->id)->count();
  //  dd($new_order);
      return response()->json([
          'success' => 1,
          'data' => ['new_order' => $new_order]
      ]);
  }

  public function getOrderList()
  {
    $vendor = Vendor::where('user_id',Auth::user()->id)->first();

       $notification  = BusinessSetting::where([['vendor_id',$vendor->id],['key','1']])->first();
      //  dd($notification);
       $notification->key= '0';
       $notification->update();

       return redirect('vendor/Orders');
  }
}
