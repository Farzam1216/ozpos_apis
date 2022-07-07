<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleSocialiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
      // dd(Socialite::driver('google')->redirect());
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();
            if(!$user->email){
              $user->email = $user->id.'@gmail.com';
            }
            $finduser = User::where('google_id', $user->id)->orWhere('email_id', $user->email)->first();
            if($finduser){

                Auth::login($finduser);
                return redirect()->intended('customer/restaurants');

            }else{
              $admin_verify_user = GeneralSetting::find(1)->verification;
              $veri = $admin_verify_user == 1 ? 0 : 1;
                $newUser = User::create([
                    'name' => $user->name,
                    'email_id' => $user->email,
                    'google_id'=> $user->id,
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
