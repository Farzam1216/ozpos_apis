<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\UserAddress;

class CustomerController extends Controller
{
    public function customer_confirm_login(Request $request)
    {
        $request->validate([
            'email_id' => 'bail|required|email',
            'password' => 'bail|required',
        ]);

        if(Auth::attempt(['email_id' => request('email_id'), 'password' => request('password')]))
        {
            $user = Auth::user()->load('roles');

            // if($user->is_verified == 1)
            // {
                if ($user->roles->contains('title', 'user'))
                {
                    $customer = User::where('id',auth()->user()->id)->first();

                    if($customer->status == 1)
                    {
                        if ($user->roles->contains('title', 'user'))
                        {
                            // if ($customer->vendor_own_driver == 1)
                            // {
                            //     Session::put('vendor_driver', 1);
                            // }
                            // else
                            // {
                            //     Session::put('vendor_driver', 0);
                            // }
                            return redirect()->back()->with('success', 'Successfully logged in.')->withInput();
                        }
                        else
                        {
                            return redirect()->back()->withErrors('Invalid Email Or Password.')->withInput();
                        }
                    }
                    else
                    {
                        return redirect()->back()->withErrors('You disable by admin please contact admin.')->withInput();
                    }
                }
                else
                {
                    Auth::logout();
                    return redirect()->back()->withErrors('Only customer can login.')->withInput();
                }
            // }
            // else
            // {
            //     return redirect('customer/send_otp/'.$user->id);
            // }
        }
        else
        {
            return redirect()->back()->withErrors('Invalid Email Or Password.')->withInput();
        }


        $request->validate([
            'email_id' => 'bail|required|email',
            'password' => 'bail|required',
        ]);
        if(Auth::attempt(['email_id' => request('email_id'), 'password' => request('password')]))
        {
            $user = Auth::user()->load('roles');
            if ($user->roles->contains('title', 'user') == true)
            {
                Auth::logout();
                return redirect()->back()->withErrors('Only admin can login');
            }
            if ($user->roles->contains('title', 'admin'))
            {
                $data = GeneralSetting::find(1);
                $data->license_verify = 1;
                $data->save();
                $api = new LicenseBoxAPI();
                $res = $api->verify_license();
                if ($res['status'] != true)
                {
                    $data->license_verify = 0;
                    $data->save();
                }
                else
                {
                    $data->license_verify = 1;
                    $data->save();
                }
                return redirect('admin/home');
            }
        }
        return redirect()->back()->withErrors('this credential does not match our record')->withInput();
    }


    public function delivery_type(Request $request)
    {
        $input = $request->all();
        
        session(['delivery_type' => $input['delivery_type']]);

        return response()->json(['success'=>$input['delivery_type']]);
    }

    public function user_address(Request $request)
    {
        $input = $request->all();
        
        session(['user_address' => $input['user_address']]);

        return response()->json(['success'=>1]);
    }

    public function add_user_address(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'lat' => 'required',
            'lang' => 'required',
            'type' => 'required',
        ]);
        $input = $request->all();

        $input['user_id'] = auth()->user()->id;
        $insert = UserAddress::create($input);
        session(['user_address' => $insert->id]);

        return redirect()->back()->with('success', 'Successfully added address.')->withInput();
        // return response()->json(['success'=>1]);
    }
}