<?php

   namespace App\Http\Controllers\Api\User;

   use App\Http\Controllers\Controller;
   use App\Models\UserAddress;
   use Illuminate\Http\Request;
   use Log;

   class AddressController extends Controller
   {
      public function getIsAddressSelected()
      {
         $UserAddress = UserAddress::where([['user_id', auth()->user()->id], ['selected', 1]])->first();
         if($UserAddress === null){
           return response(['success' => false, 'data' => null]);
         }
         return response(['success' => true, 'data' => $UserAddress]);
      }
      public function getAddress()
      {
         $UserAddress = UserAddress::where('user_id', auth()->user()->id)->get();
         return response(['success' => true, 'data' => $UserAddress]);
      }

      public function addAddress(Request $request)
      {
         $request->validate([
             'address' => 'required',
             'lat' => 'required',
             'lang' => 'required',
         ]);

         $User = auth()->user();
         $data = $request->all();
         $data['user_id'] = $User->id;

         UserAddress::where('user_id', $data['user_id'])->update(['selected' => 0]);
         UserAddress::create($data);
         return response(['success' => true, 'data' => 'Address created & picked successfully.']);
      }

      public function editAddress($address_id)
      {
         $user_address = UserAddress::find($address_id);
         return response(['success' => true, 'data' => $user_address]);
      }

      public function updateAddress(Request $request, $address_id)
      {
         $request->validate([
             'address' => 'required',
             'lat' => 'required',
             'lang' => 'required',
         ]);
         $UserAddress = UserAddress::find($address_id);

         if($UserAddress === null)
            return response(['success' => false]);

         $UserAddress->update($request->all());
         return response(['success' => true, 'data' => $UserAddress]);
      }

      public function pickAddress($address_id)
      {
         $User = auth()->user();
         $UserAddress = UserAddress::find($address_id);
         Log::info("aaa".$address_id);
         if($UserAddress === null)
            return response(['success' => false, 'msg' => 'Address not found.']);

         UserAddress::where('user_id', $User->id)->update(['selected' => 0]);
         $UserAddress = UserAddress::find($address_id);
         $UserAddress->update(['selected' => 1]);
         return response(['success' => true, 'msg' => 'Address picked successfully.']);
      }

      public function removeAddress($address_id)
      {
         $id = UserAddress::find($address_id);
         $id->delete();
         return response(['success' => true, 'data' => 'Address remove successfully.']);
      }
   }
