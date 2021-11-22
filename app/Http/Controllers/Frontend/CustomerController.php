<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Role;
use App\Models\GeneralSetting;

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
                return redirect('admin/home');
            }
        }
        return redirect()->back()->withErrors('this credential does not match our record')->withInput();
    }

    public function customer_confirm_register(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'email_id' => 'bail|required|email|unique:users',
            'password' => 'bail|required|min:6',
            'phone' => 'bail|required|numeric|digits_between:6,12',
            'phone_code' => 'required'
        ]);


        $admin_verify_user = GeneralSetting::find(1)->verification;
        $veri = $admin_verify_user == 1 ? 0 : 1;

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['status'] = 1;
        $data['image'] = 'noimage.png';
        $data['is_verified'] = $veri;
        $data['phone_code'] = '+'.$request->phone_code;
        $data['language'] = 'english';
        $user = User::create($data);
        $role_id = Role::where('title', 'user')->orWhere('title', 'User')->first();
        $user->roles()->sync($role_id);

        if ($user['is_verified'] == 1) {
            // $user['token'] = $user->createToken('mealUp')->accessToken;
            return redirect()->back()->with('success', 'Successfully signed up.')->withInput();
        } else {
            $admin_verify_user = GeneralSetting::find(1)->verification;
            if ($admin_verify_user == 1) {
                // $this->sendNotification($user);
                return redirect()->back()->with('success', 'Your account created successfully please verify your account.')->withInput();
            }
        }
    }

    public function delivery_type(Request $request)
    {
        $input = $request->all();

        session(['delivery_type' => $input['delivery_type']]);

        return response()->json(['success'=>$input['delivery_type']]);
    }

    public function guest_delivery_type(Request $request)
    {
        $input = $request->all();

        session(['delivery_type' => $input['delivery_type']]);

        return redirect()->back()->with('success', 'Picked delivery type.');
    }

    public function guest_delivery_location(Request $request)
    {
        $input = $request->all();

        session(['delivery_location' => array('lat'=>$input['lat'],'lang'=>$input['lang'] )]);

        return redirect()->back()->with('success', 'Picked delivery location.');
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
