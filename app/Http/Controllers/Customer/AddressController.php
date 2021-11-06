<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Log;

class AddressController extends Controller
{
  public function addAddress(Request $request)
  {

     $request->validate([
         'address' => 'required',
         'lat' => 'required',
         'lang' => 'required',
     ]);
      // dd($request->all());
     $User  = auth()->user();

     $data = $request->all();
     $data['user_id'] = $User->id;

     UserAddress::where('user_id', $data['user_id'])->update(['selected' => 0]);
     UserAddress::create($data);
     if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
      $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . $_SERVER['HTTP_X_FORWARDED_HOST'];
      return redirect($url.'/address-store');
    } else {
       return back();
    }

  }
  public function singleAddAddress(Request $request,$id)
  {

     $request->validate([
         'address' => 'required',
         'lat' => 'required',
         'lang' => 'required',
     ]);
      // dd($request->all());
     $User  = auth()->user();

     $data = $request->all();
     $data['user_id'] = $User->id;

     UserAddress::where('user_id', $data['user_id'])->update(['selected' => 0]);
     UserAddress::create($data);
     if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
      $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . $_SERVER['HTTP_X_FORWARDED_HOST'];
      return redirect($url.'/');
    } else {
       return back();
    }

  }

  public function changeAddress(Request $request)
  {
      // dd($request->all());
         $address_id = $request->address_id;
         $User = auth()->user();
         $UserAddress = UserAddress::find($address_id);

         Log::info("aaa".$address_id);
         if($UserAddress === null)
         {
            return back()->with(['success' => false, 'msg' => 'Address not found.']);
          }

         UserAddress::where('user_id', $User->id)->update(['selected' => 0]);
         $UserAddress = UserAddress::find($address_id);
         $UserAddress->update(['selected' => 1]);
         return back()->with(['success' => 'Address picked successfully.']);
  }
}
