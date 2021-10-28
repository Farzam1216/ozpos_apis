<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderSetting;
use App\Models\PaymentSetting;
use App\Models\PromoCode;
use App\Models\Role;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Vendor;
use App\Rules\MatchOldPassword;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
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
                                return redirect()->route('restaurant.index',1);
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
            // return redirect()->back()->with('success', 'Successfully signed up.')->withInput();
            return redirect()->route('customer.delivery.location.index');
        } else {
            $admin_verify_user = GeneralSetting::find(1)->verification;
            if ($admin_verify_user == 1) {
                // $this->sendNotification($user);
                Toastr::success('Your account created successfully please verify your account.');
                return redirect()->back()->with('success', 'Your account created successfully please verify your account.')->withInput();
            }
        }
      }

      public function deliveryLocation()
      {
        Toastr::warning('Please Select Your Location on the Map!');
        Toastr::success('Successfully Logged in!');
        return view('customer.map-select');
      }
      public function storeDeliveryLocation(Request $request)
      {
        $request->validate([
          'address' => 'bail|required',
          'lang' => 'bail|required',
          'lat' => 'bail|required',
          'type' => 'bail|required',
      ]);
          $input = $request->all();
          $address = new UserAddress;
          $address->create($input);

          session(['delivery_location' => array( 'lat'=>$input['lat'], 'lang'=>$input['lang'] )]);
          Toastr::success('Delivery Zone added successfully!');
          $id = 1;
          return redirect()->route('customer.restaurant.index',$id);
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

                $discountType = $coupon->discountType;
                $discount     = $coupon->discount;
                return response()->json(['discountType'=>$discountType,'discount'=>$discount,'coupon_id'=> $coupon->id]);

         }
         else
         {
          dd('error');
         }

      }

////// checkout /////


public function checkout(Request $request)
{

  // dd($request->all());
  Session::put(['total'=>$request->total,'idTax'=>$request->idTax,'iCoupons'=>$request->iCoupons,
                'iDelivery'=>$request->iDelivery,'iGrandTotal'=>$request->iGrandTotal,'coupon_id'=>$request->coupon_id,'product'=>$request
              ->product]);

  $user=Auth::user()->id;
  $userAddress = UserAddress::where('user_id',$user)->get();
  $selectedAddress = UserAddress::where(['user_id'=>$user,'selected'=> 1])->first();
  return view('customer.checkout',compact('user','userAddress','selectedAddress'));
}

//// payment/////////////
public function bookOrder(Request $request)
{
  // dd( Session::get('product'));


   $validation = $request->validate([
      //  'date' => 'bail|required',
      //  'time' => 'bail|required',
       'amount' => 'bail|required|numeric',
       'sub_total' => 'bail|required|numeric',
      //  'item' => 'bail|required',
       'vendor_id' => 'required',
       'delivery_type' => 'bail|required',
//             'address_id' => 'bail|required_if:delivery_type,HOME',
       'payment_type' => 'bail|required',
       'payment_token' => 'bail|required_if:payment_type,STRIPE,RAZOR,PAYPAl',
      // 'delivery_charge' => 'bail|required_if:delivery_type,HOME',
       'tax' => 'required',
   ]);
//         \Log::critical($request);
//         return;

// foreach($data as )
   $bookData = $request->all();
   $bookData['date'] = Carbon::now()->format('Y-m-d');
   $bookData['time'] = Carbon::now()->format('g:i A');
  //  $bookData['time'] = Carbon::now()->format('g:i A');
    //  dd($time);

   $bookData['amount'] = (float)number_format((float)$bookData['amount'], 2, '.', '');
   $bookData['sub_total'] = (float)number_format((float)$bookData['sub_total'], 2, '.', '');
   $bookData['order_status'] = "PENDING";
   $vendor = Vendor::where('id', $bookData['vendor_id'])->first();
   $vendorUser = User::find($vendor->user_id);
   $customer = auth()->user();

   if ($bookData['payment_type'] == 'STRIPE') {
      $paymentSetting = PaymentSetting::find(1);
      $stripe_sk = $paymentSetting->stripe_secret_key;
      $currency = GeneralSetting::find(1)->currency;
      $stripe = new \Stripe\StripeClient($stripe_sk);
      $charge = $stripe->charges->create(
          [
              "amount" => $bookData['amount'] * 100,
              "currency" => $currency,
              "source" => $request->payment_token,
          ]);
      $bookData['payment_token'] = $charge->id;
   }
   if ($bookData['payment_type'] == 'WALLET') {
      $user = auth()->user();
      // dd($user);
      if ($bookData['amount'] > $user->balance) {
         return response(['success' => false, 'data' => "You Don't Have Sufficient Wallet Balance."]);
      }
   }
   $bookData['user_id'] = auth()->user()->id;

   $PromoCode = PromoCode::find($bookData['promocode_id']);
   if ($PromoCode) {
      $PromoCode->count_max_user = $PromoCode->count_max_user + 1;
      $PromoCode->count_max_count = $PromoCode->count_max_count + 1;
      $PromoCode->count_max_order = $PromoCode->count_max_order + 1;
      $PromoCode->save();
   }
   else {
      $bookData['promocode_id'] = null;
      $bookData['promocode_price'] = 0;
   }



   $daiterm = Session::get('product');

    $data = json_decode($daiterm);
// dd($data);
    $finalData = [];
    $cart = array();
    $menu = array();
    $addons = array();
    $size = array();
    $finalData['vendor_id'] = $vendor->id;
    $finalData['cart'] = [];
    // array_push($finalData,['vendor_id'=>$vendor->id]);
    $idx = -1;
    foreach($data as $key=>$item)
    {
      $idx++;
      $finalData['cart'][$idx] = [
            'category'=> $item->summary->category,
            'total_amount'=>$item->price,
            'menu_category'=> "null",
            'quantity'=>$item->quantity,
            'menu'=>[]
        ];
        $idx2 = -1;
      foreach($item->summary->menu  as $key2=> $value)
      {
        $idx2++;
        $finalData['cart'][$idx]['menu'][$idx2] = [
          'id'=> $value->id,
          'name'=>$value->name,
          'image'=>$item->image,
          'total_amount'=>$item->price,
          'addons'=>[]
          //'deals_items' => $value->deals_items
      ];

      $idx3 = -1;
          foreach($value->addons as $addo)
          {
            $idx3++;
            $finalData['cart'][$idx]['menu'][$idx2]['addons'][$idx3] = [
              'id'=> $addo->id,
              'name'=>$addo->name,
              'price'=>$addo->price,
              //  'deals_items' => $value->deals_items

          ];


            // dd($addo->id);
          }
      }
      // if(isset($item->summary->size))
      //   {
      //     foreach($item->summary->size as $siz)
      //     {
      //       $finalData['size'] = [
      //         'id'=> $siz->id,
      //         'size_name'=>$siz->name,

      //     ];
      //     }
      //   }
      //   else
      //   {
      //     $finalData['size'] ="null";
      //   }
      //
      // dd();

    }

    // dd(json_encode($finalData));
    $order_data = json_encode($finalData);
    $bookData['order_id'] = '#' . rand(100000, 999999);
    $bookData['vendor_id'] = $vendor->id;
    $bookData['order_data'] =$order_data;
    $order = Order::create($bookData);

//         if ($bookData['payment_type'] == 'WALLET') {
//            $user->withdraw($bookData['amount'], [$order->id]);
//         }
//         $bookData['item'] = json_decode($bookData['item'], true);
//         foreach ($bookData['item'] as $child_item) {
//            $order_child = array();
//            $order_child['order_id'] = $order->id;
//            $order_child['item'] = $child_item['id'];
//            $order_child['price'] = $child_item['price'];
//            $order_child['qty'] = $child_item['qty'];
//            if (isset($child_item['custimization'])) {
//               $order_child['custimization'] = $child_item['custimization'];
//            }
//            OrderChild::create($order_child);
//         }
//        $this->sendVendorOrderNotification($vendor,$order->id);
//        $this->sendUserNotification($bookData['user_id'],$order->id);
            app('App\Http\Controllers\NotificationController')->process('vendor', 'order', 'New Order', [$vendorUser->id, $vendorUser->device_token, $vendorUser->email], $vendorUser->name, $order->order_id, $customer->name, $order->time);
            $amount = $order->amount;
//         $tax = array();
//         if ($vendor->admin_comission_type == 'percentage') {
//            $comm = $amount * $vendor->admin_comission_value;
//            $tax['admin_commission'] = intval($comm / 100);
//            $tax['vendor_amount'] = intval($amount - $tax['admin_commission']);
//         }
//         if ($vendor->admin_comission_type == 'amount') {
//            $tax['vendor_amount'] = $amount - $vendor->admin_comission_value;
//            $tax['admin_commission'] = $amount - $tax['vendor_amount'];
//         }
//         $order->update($tax);

//         $firebaseQuery = app('App\Http\Controllers\FirebaseController')->setOrder($order->user_id, $order->id, $order->order_status);

//         if ($order->payment_type == 'FLUTTERWAVE') {
//            return response(['success' => true, 'url' => url('FlutterWavepayment/' . $order->id), 'data' => "order booked successfully wait for confirmation"]);
//         } else {


            return response(['success' => true, 'data' => "order booked successfully wait for confirmation"]);
//         }
}

        // public function completeBookOrder()
        // {
        //    dd('successfull');
        // }



    /////////// Profile /////////////
    public function profile()
    {
      $user=Auth::user();
      $userAddress = UserAddress::where('user_id',$user->id)->get();
      $selectedAddress = UserAddress::where(['user_id'=>$user->id,'selected'=> 1])->first();
        return view('customer.profile',compact('user','userAddress','selectedAddress'));
    }

  public function profileUpdate(Request $request,$id)
  {
    // dd($request->all());
     User::find($id)->update([
      'name' => $request->name,
      'phone_code' => '+'.$request->phone_code,
      'phone' => $request->phone,
      'email' => $request->name
    ]);
    Toastr::success('Successfuly Updated your profile!');
    return redirect()->back();
  }

  public function passwordChange(Request $request,$id)
  {
    $request->validate([
      'current_password' => ['required', new MatchOldPassword],
      'new_password' => ['required'],
      'new_confirm_password' => ['same:new_password'],
    ]);

    User::find($id)->update(['password'=> Hash::make($request->new_password)]);
    Toastr::success('Successfuly Changed the Password!');
    dd('Successfuly Changed the Password!');
    return back();
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



    public function logout()
    {
      Session::flush();

      Auth::logout();

      return redirect()->route('customer.login');
    }

}
