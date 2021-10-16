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
     return back();
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
