<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/* Start - Abdullah */
use Illuminate\Http\Request;
/* End - Abdullah */

class LoginController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /* Start - Abdullah */
    use AuthenticatesUsers {
        logout as performLogout;
    }
    /* End - Abdullah */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /* Start - Abdullah */
    public function logout(Request $request)
    {
        if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
        {
            $url = ( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http').'://'.$_SERVER['HTTP_X_FORWARDED_HOST'];

            $this->performLogout($request);
            return redirect($url);
        }
        else
        {
            $this->performLogout($request);
            return redirect()->route('vendor.login');
        }
    }
    /* End - Abdullah */
}
