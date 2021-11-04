<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Vendor;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Cart;
use Illuminate\Http\Request;
use Session;

class SingleRestaurantController extends Controller
{
  public function restaurantLogin($id)
  {
    // dd($id);
    if(Auth::check())
    {
          return redirect()->route('restaurant.index');
    }
    else
    {
       $vendor=Vendor::find($id);
      return view('customer/restaurant/login',compact('vendor'));
    }
  }
  public function restaurantLoginVerify(Request $request,$id)
  {
        $request->validate([
          'email_id' => 'bail|required|email',
          'password' => 'bail|required',
      ]);

      // dd($request->all());
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
                          $userAddress = UserAddress::where('user_id',auth()->user()->id)->where('selected',1)->first();
                          // dd($user);
                          if ($userAddress)
                          {
                            // dd('asdasd');
                            Toastr::success('You have set location already exist!');
                            // return redirect()->route('customer.restaurant.index',$customer->id);
                            // return redirect()->route('restaurant.index');
                            if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                            {
                               $url = ( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http').'://'.$_SERVER['HTTP_X_FORWARDED_HOST'];
                               dd($url);
                               return redirect($url.'/restaurants/'.$id);
                            }
                            else
                            {

                               if (!Session::has('cart_vendor_id'))
                                   return redirect()->route('customer.home.index')->withErrors('You have not selected any restaurant yet.');
                               if (Cart::content()->isEmpty() && !Session::has('cart_vendor_id'))
                                   return redirect()->back()->withErrors('Your cart is empty, add at least 1 item.');
                               if (Cart::content()->isEmpty())
                                   return redirect()->route('customer.restaurant.get', Session::get('cart_vendor_id'))->withErrors('Your cart is empty, add at least 1 item.');
                               if (!Session::has('delivery_type'))
                                   return redirect()->route('customer.restaurant.get', Session::get('cart_vendor_id'))->withErrors('Pick delivery type.');
                               if (Session::get('delivery_type') == 'SHOP')
                                   return redirect()->route('customer.restaurant.order.second.index', Session::get('cart_vendor_id'));
                            }

                          }
                          else
                          {
                            Toastr::success('Set Your Location!');
                            return redirect()->route('customer.delivery.location.index');
                              // Session::put('vendor_driver', 0);
                          }
                          // dd('asdsasdasd');

                          // return back();
                      }
                      else
                      {
                        Toastr::error('Invalid Email Or Password.');
                        return redirect()->back()->withErrors('Invalid Email Or Password.')->withInput();
                      }
                  }
                  else
                  {
                      Toastr::warning('You disable by admin please contact admin.');
                      return redirect()->back()->withErrors('You disable by admin please contact admin.')->withInput();
                  }
              }
              else
              {
                  Auth::logout();
                  Toastr::warning('Only customer can login.');
                  return redirect()->back()->with('error','Only customer can login.')->withInput();
              }
          // }
          // else
          // {
          //     return redirect('customer/send_otp/'.$user->id);
          // }
      }
      else
      {
          Toastr::error('Invalid Email Or Password.');
          return redirect()->back()->withErrors('Invalid Email Or Password.')->withInput();
      }


      // $request->validate([
      //     'email_id' => 'bail|required|email',
      //     'password' => 'bail|required',
      // ]);
      // if(Auth::attempt(['email_id' => request('email_id'), 'password' => request('password')]))
      // {
      //     $user = Auth::user()->load('roles');
      //     if ($user->roles->contains('title', 'user') == true)
      //     {
      //         Auth::logout();
      //         return redirect()->back()->withErrors('Only admin can login');
      //     }
      //     if ($user->roles->contains('title', 'admin'))
      //     {
      //         return redirect('admin/home');
      //     }
      // }
      // return redirect()->back()->withErrors('this credential does not match our record')->withInput();
  }

public function restaurantSignup($id)
  {
    $vendor=Vendor::find($id);
    return view('customer/signup',compact('vendor'));
  }
}
