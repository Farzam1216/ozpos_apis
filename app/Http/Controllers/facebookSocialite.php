<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;

class facebookSocialite extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
      try {

        $user = Socialite::driver('facebook')->stateless()->user();
        if(!$user->email){
          $user->email = $user->id.'@gmail.com';
        }
        $finduser = User::where('facebook_id', $user->id)->orWhere('email_id', $user->email)->first();
        if($finduser){
            Auth::login($finduser);
            return redirect()->intended('customer/restaurants');
        }else{
          $admin_verify_user = GeneralSetting::find(1)->verification;
          $veri = $admin_verify_user == 1 ? 0 : 1;
            $newUser = User::create([
                'name' => $user->name,
                'email_id' => $user->email,
                'facebook_id'=> $user->id,
                'image' => $user->avatar,
                'password' => encrypt('12345678'),
                'is_verified' => 0,
                'status' => 1
            ]);
            $role_id = Role::where('title', 'user')->orWhere('title', 'User')->first();
            $newUser->roles()->sync($role_id);
            Auth::login($newUser);

            return redirect()->intended('customer/restaurants');
        }

    } catch (Exception $e) {
        log::info($e->getMessage());
    }
    }
}
