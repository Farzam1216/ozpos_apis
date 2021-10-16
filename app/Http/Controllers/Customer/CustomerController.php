<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\OrderSetting;
use App\Models\PromoCode;
use App\Models\Role;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Vendor;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Stripe\Coupon;

class CustomerController extends Controller
{
    public function index()
    {
        $topRest = $this->topRest();
        return view('customer/home',compact('topRest'));
    }


    public function login()
      {
        return view('customer/login');
      }


      public function loginVerify(Request $request)
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
                                return redirect('customer/restaurant/1');
                              }
                              else
                              {
                                Toastr::success('Successfully Logged in!');
                                return view('customer.map-select');
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

      public function signup()
      {
        return view('customer/signup');
      }


      public function signUpVerify(Request $request)
      {
          // dd($request->all());

          $request->validate([
            'name' => 'bail|required',
            'email_id' => 'bail|required|email|unique:users',
            'password' => 'bail|required|min:6',
            'phone' => 'bail|required|numeric|digits_between:6,12',
            'phone_code' => 'required'
        ]);


        $admin_verify_user = GeneralSetting::find(1)->verification;

        $veri = $admin_verify_user == 1 ? 0 : 1;
        // dd($veri);
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
            Toastr::success('Successfully signed up.');
            return redirect()->back()->with('success', 'Successfully signed up.')->withInput();
        } else {
            $admin_verify_user = GeneralSetting::find(1)->verification;
            if ($admin_verify_user == 1) {
                // $this->sendNotification($user);
                Toastr::success('Your account created successfully please verify your account.');
                return redirect()->back()->with('success', 'Your account created successfully please verify your account.')->withInput();
            }
        }
      }

      public function deliveryLocation( Request $request)
      {
        $input = $request->all();

          $address = new UserAddress;

          $address->create($input);

          session(['delivery_location' => array( 'lat'=>$input['lat'], 'lang'=>$input['lang'] )]);
          Toastr::success('Delivery Zone added successfully!');
          return redirect('customer/restaurant/1');
      }


      public function applyTax()
      {
          //  dd($request->all());
              // $user = Auth::user()->id;
              //    dd($user);
         $vendor = Vendor::find(1);

        //  dd($vendor);
         if($vendor)
         {
          $User = auth()->user();
          $UserAddress = UserAddress::where([['user_id', $User->id], ['selected', 1]])->first();
          $orderSettting = OrderSetting::where('vendor_id',$vendor->id)->first();

         $googleApiKey = 'AIzaSyCDcZlGMIvPlbwuDgQzlEkdhjVQVPnne4c';
         $googleUrl = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&destinations="' . $UserAddress->lat . ',' . $UserAddress->lang . '"&origins="' . $vendor->lat . ',' . $vendor->lang . '"&key=' . $googleApiKey . '';
         $googleDistance =
             file_get_contents(
                 $googleUrl,
             );
         $googleDistance = json_decode($googleDistance);

         $orderSettting['distance'] = ($googleDistance->status == "OK") ? $googleDistance->rows[0]->elements[0]->distance->value / 1000 : 0;


                $taxtype  = $vendor->tax_type;
                $tax    = $vendor->tax;
                return response()->json(['tax'=>$tax , 'taxtype'=> $taxtype, 'orderSettting' => $orderSettting]);

          }
        }
      public function applyCoupon(Request $request)
      {
          //  dd($request->all());

         $coupon = PromoCode::where('promo_code',$request->coupon)->first();
         if($coupon)
         {
          //  if($coupon->discountType == "percentage")
          //  {
                //  dd('cccc');
               // $discount = ($request->idTotal/$coupon->discount) * 100;
                // $discount    = $request->idTotal * $coupon->discount / 100;
                // $subtotal    = $request->idTotal - $discount;
                // $total       = $request->idTaxInput + $subtotal;

                $discountType = $coupon->discountType;
                $discount     = $coupon->discount;
                return response()->json(['discountType'=>$discountType,'discount'=>$discount]);

         }
         else
         {
          dd('error');
         }

      }

    public function topRest(/* Request $request */)
    {
        $vendors = Vendor::where([['isTop', '1'], ['status', 1]])->orderBy('id', 'DESC')->get()->makeHidden(['vendor_logo']);
        foreach ($vendors as $vendor) {
            if(session()->has('delivery_location')) {
                $lat1 = $vendor->lat;
                $lon1 = $vendor->lang;
                $lat2 = session()->get('delivery_location')['lat'];
                $lon2 = session()->get('delivery_location')['lang'];
                $unit = 'K';
                if (($lat1 == $lat2) && ($lon1 == $lon2)) {
                    $distance = 0;
                } else {
                    $theta = $lon1 - $lon2;
                    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                    $dist = acos($dist);
                    $dist = rad2deg($dist);
                    $miles = $dist * 60 * 1.1515;
                    $unit = strtoupper($unit);
                    if ($unit == "K") {
                        $distance = $miles * 1.609344;
                    } else if ($unit == "N") {
                        $distance = $miles * 0.8684;
                    } else {
                        $distance = $miles;
                    }
                }
                $vendor['distance'] = round($distance);
            }
            else {
                $vendor['distance'] = '?';
            }

            if (auth('api')->user() != null) {
                $user = auth('api')->user();
                $vendor['like'] = in_array($vendor->id, explode(',', $user->faviroute));
            } else {
                $vendor['like'] = false;
            }
        }
        return $vendors;
    }



}
