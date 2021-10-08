<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class AddressController extends Controller
{
  public function getAddress()
  {
    $user_address = UserAddress::where('user_id', auth()->user()->id)->get();
    return response(['success' => true, 'data' => $user_address]);
  }

  public function addAddress(Request $request)
  {
    $request->validate([
      'address' => 'required',
      'lat' => 'required',
      'lang' => 'required',
    ]);

    $data = $request->all();
    $data['user_id'] = auth()->user()->id;

    UserAddress::where('user_id', $data['user_id'])->update(['selected' => 0]);
    UserAddress::create($data);
    return response(['success' => true, 'data' => 'Address picked successfully.']);
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
    $user_address = UserAddress::find($address_id);
    $user_address->update($request->all());
    return response(['success' => true, 'data' => $user_address]);
  }

  public function removeAddress($address_id)
  {
    $id = UserAddress::find($address_id);
    $id->delete();
    return response(['success' => true, 'data' => 'remove successfully..!!']);
  }
}
