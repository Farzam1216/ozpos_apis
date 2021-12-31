<?php
   
   namespace App\Http\Controllers\Customer;
   
   use App\Http\Controllers\Controller;
   use App\Models\BusinessSetting;
   use App\Models\GeneralSetting;
   use App\Models\MenuCategory;
   use App\Models\Order;
   use App\Models\OrderSetting;
   use App\Models\PaymentSetting;
   use App\Models\PromoCode;
   use App\Models\Role;
   use App\Models\User;
   use App\Models\UserAddress;
   use App\Models\Vendor;
   use App\Models\VendorDiscount;
   use App\Models\WorkingHours;
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
         return view('customer/home', compact('topRest'));
      }
      
      
      public function login()
      {
         if (Auth::check()) {
            if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
               $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . $_SERVER['HTTP_X_FORWARDED_HOST'];
               
               return redirect($url);
            } else {
               return redirect()->route('restaurant.index');
            }
         } else {
            return view('customer/login');
         }
      }
      
      // public function restaurantLogin($id)
      // {
      //    // dd($id);
      //    if (Auth::check()) {
      //       return redirect()->route('restaurant.index');
      //    } else {
      //       $vendor = Vendor::find($id);
      //       return view('customer/restaurant/login', compact('vendor'));
      //    }
      // }
      
      
      public function loginVerify(Request $request)
      {
         $request->validate([
             'email_id' => 'bail|required|email',
             'password' => 'bail|required',
         ]);
         
         // dd($request->all());
         if (Auth::attempt(['email_id' => request('email_id'), 'password' => request('password')])) {
            $user = Auth::user()->load('roles');
            
            // if($user->is_verified == 1)
            // {
            
            if ($user->roles->contains('title', 'user')) {
               
               $customer = User::where('id', auth()->user()->id)->first();
               
               if ($customer->status == 1) {
                  if ($user->roles->contains('title', 'user')) {
                     $userAddress = UserAddress::where('user_id', auth()->user()->id)->where('selected', 1)->first();
                     // dd($user);
                     if ($userAddress) {
                        
                        Toastr::success('You have set location already exist!');
                        // return redirect()->route('customer.restaurant.index',$customer->id);
                        // return redirect()->route('restaurant.index');
                        if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
                           $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . $_SERVER['HTTP_X_FORWARDED_HOST'];
                           return redirect($url);
                        } else {
                           return redirect()->route('restaurant.index');
                        }
                     } else {
                        Toastr::success('Set Your Location!');
                        if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
                           $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . $_SERVER['HTTP_X_FORWARDED_HOST'];
                           return redirect($url . '/delivery-location');
                        } else {
                           return redirect()->route('customer.delivery.location.index');
                        }
                        
                        // Session::put('vendor_driver', 0);
                     }
                     
                     
                     // return back();
                  } else {
                     Toastr::error('Invalid Email Or Password.');
                     if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
                        $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . $_SERVER['HTTP_X_FORWARDED_HOST'];
                        return redirect($url);
                     } else {
                        // return redirect()->route('customer.delivery.location.index');
                        return redirect()->back()->withErrors('Invalid Email Or Password.')->withInput();
                     }
                  }
               } else {
                  Toastr::warning('You disable by admin please contact admin.');
                  return redirect()->back()->withErrors('You disable by admin please contact admin.')->withInput();
               }
            } else {
               Auth::logout();
               Toastr::warning('Only customer can login.');
               return redirect()->back()->with('error', 'Only customer can login.')->withInput();
            }
            // }
            // else
            // {
            //     return redirect('customer/send_otp/'.$user->id);
            // }
         } else {
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
      
      public function restaurantSignup($id)
      {
         $vendor = Vendor::find($id);
         return view('customer/signup', compact('vendor'));
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
         $data['phone_code'] = '+' . $request->phone_code;
         $data['language'] = 'english';
         $user = User::create($data);
         $role_id = Role::where('title', 'user')->orWhere('title', 'User')->first();
         $user->roles()->sync($role_id);
         
         if ($user['is_verified'] == 1) {
            // $user['token'] = $user->createToken('mealUp')->accessToken;
            if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
               Toastr::success('Successfully signed up.');
               $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . $_SERVER['HTTP_X_FORWARDED_HOST'];
               return redirect($url);
               // return redirect()->back()->with('success', 'Successfully signed up.')->withInput();
            } else {
               Toastr::success('Successfully signed up.');
               return redirect()->back()->with('success', 'Successfully signed up.')->withInput();
               
            }
         } else {
            $admin_verify_user = GeneralSetting::find(1)->verification;
            if ($admin_verify_user == 1) {
               // $this->sendNotification($user);
               if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
                  Toastr::success('Your account created successfully please verify your account.');
                  $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . $_SERVER['HTTP_X_FORWARDED_HOST'];
                  return redirect($url);
                  // return redirect()->back()->with('success', 'Successfully signed up.')->withInput();
               } else {
                  Toastr::success('Your account created successfully please verify your account.');
                  // return redirect()->back()->with('success', 'Successfully signed up.')->withInput();
                  
                  return redirect()->back()->with('success', 'Your account created successfully please verify your account.')->withInput();
               }
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
         
         session(['delivery_location' => array('lat' => $input['lat'], 'lang' => $input['lang'])]);
         if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
            Toastr::success('Delivery Zone added successfully!');
            $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . $_SERVER['HTTP_X_FORWARDED_HOST'];
            return redirect($url);
            // return redirect()->route('restaurant.index');
         } else {
            Toastr::success('Delivery Zone added successfully!');
            return redirect()->route('restaurant.index');
            
         }
      }
      
      
      public function applyTax()
      {
         //  dd($request->all());
         // $user = Auth::user()->id;
         //    dd($user);
         $vendor = Vendor::find(1);
         //  dd($vendor);
         if ($vendor) {
            $User = auth()->user();
            $UserAddress = UserAddress::where([['user_id', $User->id], ['selected', 1]])->first();
            $orderSettting = OrderSetting::where('vendor_id', $vendor->id)->first();
            
            $googleApiKey = 'AIzaSyCDcZlGMIvPlbwuDgQzlEkdhjVQVPnne4c';
            $googleUrl = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&destinations="' . $UserAddress->lat . ',' . $UserAddress->lang . '"&origins="' . $vendor->lat . ',' . $vendor->lang . '"&key=' . $googleApiKey . '';
            $googleDistance =
                file_get_contents(
                    $googleUrl,
                );
            \Log::critical($googleDistance);
            $googleDistance = json_decode($googleDistance);
            
            $orderSettting['distance'] = 0;
            if ($googleDistance->status == "OK" && isset($googleDistance->rows[0]) && isset($googleDistance->rows[0]->elements[0]) && isset($googleDistance->rows[0]->elements[0]->distance))
               $orderSettting['distance'] = $googleDistance->rows[0]->elements[0]->distance->value / 1000;
            
            
            $taxtype = $vendor->tax_type;
            $tax = $vendor->tax;
            return response()->json(['tax' => $tax, 'taxtype' => $taxtype, 'orderSettting' => $orderSettting]);
         }
      }
      
      public function applySingleTax($id)
      {
         //  dd($request->all());
         // $user = Auth::user()->id;
         //    dd($user);
         $vendor = Vendor::find($id);
         
         //  dd($vendor);
         if ($vendor) {
            $User = auth()->user();
            $UserAddress = UserAddress::where([['user_id', $User->id], ['selected', 1]])->first();
            $orderSettting = OrderSetting::where('vendor_id', $vendor->id)->first();
            
            $googleApiKey = 'AIzaSyCDcZlGMIvPlbwuDgQzlEkdhjVQVPnne4c';
            $googleUrl = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&destinations="' . $UserAddress->lat . ',' . $UserAddress->lang . '"&origins="' . $vendor->lat . ',' . $vendor->lang . '"&key=' . $googleApiKey . '';
            $googleDistance =
                file_get_contents(
                    $googleUrl,
                );
            $googleDistance = json_decode($googleDistance);
            
            $orderSettting['distance'] = ($googleDistance->status == "OK") ? $googleDistance->rows[0]->elements[0]->distance->value / 1000 : 0;
            
            
            $taxtype = $vendor->tax_type;
            $tax = $vendor->tax;
            return response()->json(['tax' => $tax, 'taxtype' => $taxtype, 'orderSettting' => $orderSettting]);
         }
      }
      
      public function applyCoupon(Request $request)
      {
         //  dd($request->all());
         
         $coupon = PromoCode::where('promo_code', $request->coupon)->first();
         if ($coupon) {
            
            $discountType = $coupon->discountType;
            $discount = $coupon->discount;
            return response()->json(['discountType' => $discountType, 'discount' => $discount, 'coupon_id' => $coupon->id]);
         } else {
            dd('error');
         }
      }
      
      public function applySingleCoupon(Request $request, $id)
      {
         //  dd($request->all());
         
         $coupon = PromoCode::where('promo_code', $request->coupon)->first();
         if ($coupon) {
            $discountType = $coupon->discountType;
            $discount = $coupon->discount;
            return response()->json(['discountType' => $discountType, 'discount' => $discount, 'coupon_id' => $coupon->id]);
         } else {
            dd('error');
         }
      }
      
      ////// checkout /////
      
      
      public function checkout(Request $request)
      {
         
         //  dd($request->all());
         
         Session::put([
             'vendorID' => $request->vendorId,
             'total' => $request->total,
             'idTax' => $request->iTax,
             'iCoupons' => $request->iCoupons,
             'iDelivery' => $request->iDelivery,
             'iGrandTotal' => $request->iGrandTotal,
             'coupon_id' => $request->coupon_id,
             'product' => $request->product
         ]);
         
//         \Log::critical('$request->product');
         \Log::critical("Session::get('product')");
         \Log::critical(Session::get('product'));
         \Log::critical('$request->product');
         \Log::critical($request->product);
//         \Log::critical($request->product);
         \Log::critical('rawurldecode($request->product)');
         \Log::critical(rawurldecode($request->product));
         \Log::critical('json_decode(rawurldecode($request->product))');
         \Log::critical(json_decode(rawurldecode($request->product)));
         
         
         $data = json_decode(rawurldecode($request->product));
         // dd($data);
         $vendor = Vendor::find($request->vendorId);
         // dd($request->vendorId);
         $user = Auth::user()->id;
         $userAddress = UserAddress::where('user_id', $user)->get();
         $selectedAddress = UserAddress::where(['user_id' => $user, 'selected' => 1])->first();
         
         // $setting = GeneralSetting::first();
         // $start_time = carbon::now()->format('h:i a');
         // $currentTime = date("H:i", strtotime($start_time));
         
         // $current_day = carbon::today()->format('l');
         
         // $timePeriod = WorkingHours::where([['vendor_id', $vendor->id], ['type', 'delivery_time'],['day_index',$current_day],['status',1]])->first();
         $timeSlot = array();
         if (isset($vendor)) {
            // dd($vendor);
            // $time = json_decode($timePeriod->period_list);
            // $newStartTime = date("H:i", strtotime($time[0]->start_time));
            // $newEndTime = date("H:i", strtotime($time[0]->end_time));
            if ($vendor->vendor_status == 1 && $vendor->delivery_status == 1 && $vendor->delivery_status == 1) {
               $timeSlot = "true";
            } else if ($vendor->vendor_status == 1 && $vendor->pickup_status == 0 && $vendor->delivery_status == 1) {
               $timeSlot = "true";
            } else if ($vendor->vendor_status == 1 && $vendor->pickup_status == 1 && $vendor->delivery_status == 0) {
               $timeSlot = "false";
            } else {
               $timeSlot = "false";
            }
         } else {
            $timeSlot = "false";
         }
         // dd($data);
         
         return view('customer.checkout', compact('user', 'userAddress', 'selectedAddress', 'vendor'
             , 'data', 'timeSlot'));
      }
      
      
      //// payment/////////////
      public function bookOrder(Request $request)
      {
         // dd($request->all());
         
         
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
         //\Log::critical($request);
         //return;
         
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
                ]
            );
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
         } else {
            $bookData['promocode_id'] = null;
            $bookData['promocode_price'] = 0;
         }
   
         $data = Session::get('product');
         $data = rawurldecode($data);
         $data = json_decode($data);
   
         \Log::critical('$daiterm');
         \Log::critical($data);
//         \Log::critical($daiterm);
//         return;
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
         // if(isset($data)){
         foreach ($data as $key => $item) {
            \Log::critical(json_encode($item->summary));
//            return $item->summary;
//            $summary = json_decode(str_replace('\'', '"', $item->summary));
//            $summary = json_decode($item->summary);
            $summary = $item->summary;
            $idx++;
            $finalData['cart'][$idx] = [
                'category' => $summary->category,
                'total_amount' => $item->price,
                'menu_category' => "null",
                'quantity' => $item->quantity,
                'menu' => []
            ];
            $idx2 = -1;
            foreach ($summary->menu as $key2 => $value) {
               if($value === null)
                  continue;
               // dd($value);
               $idx2++;
               \Log::critical('json_encode($value)');
               \Log::critical(json_encode($value));
               $finalData['cart'][$idx]['menu'][$idx2] = [
                   'id' => $value->id,
                   'name' => $value->name,
                   'image' => $item->image,
                   'total_amount' => $item->price,
                   'addons' => []
                  //'deals_items' => $value->deals_items
               ];
               
               $idx3 = -1;
               foreach ($value->addons as $addo) {
                  $idx3++;
                  $finalData['cart'][$idx]['menu'][$idx2]['addons'][$idx3] = [
                      'id' => $addo->id,
                      'name' => $addo->name,
                      'price' => $addo->price,
                     //  'deals_items' => $value->deals_items
                  
                  ];
                  
                  
                  // dd($addo->id);
               }
            }
            
            // if($request->deliveryTime = "DELIVERY")
            // {
            //   $bookData['delivery_time'] = '';
            // }
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
         // }
         // dd(json_encode($finalData));
         $order_data = json_encode($finalData);
         $bookData['order_id'] = '#' . rand(100000, 999999);
         $bookData['vendor_id'] = $vendor->id;
         $bookData['order_data'] = $order_data;
         
         $notification = BusinessSetting::where([['vendor_id', $vendor->id], ['key', '0']])->first();
         if ($notification) {
            $notification->vendor_id = $vendor->id;
            $notification->key = '1';
            $notification->update();
         } else {
            $notification = new BusinessSetting;
            $notification->vendor_id = $vendor->id;
            $notification->key = '1';
            $notification->save();
         }
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
         $user = Auth::user();
         $userAddress = UserAddress::where('user_id', $user->id)->get();
         $selectedAddress = UserAddress::where(['user_id' => $user->id, 'selected' => 1])->first();
         return view('customer.profile', compact('user', 'userAddress', 'selectedAddress'));
      }
      
      public function singleProfile($id)
      {
         $vendor_id = $id;
         $rest = $this->getRest($id);
         $singleVendor = $this->singleVendor($id);
         $page = 1;
         $user = Auth::user();
         $userAddress = UserAddress::where('user_id', $user->id)->get();
         $selectedAddress = UserAddress::where(['user_id' => $user->id, 'selected' => 1])->first();
         return view('customer.profile', compact('user', 'userAddress', 'selectedAddress', 'rest', 'singleVendor'));
      }
      
      public function profileUpdate(Request $request, $id)
      {
         //dd($id);
         User::find($id)->update([
             'name' => $request->name,
             'phone_code' => '+' . $request->phone_code,
             'phone' => $request->phone,
             'email' => $request->name
         ]);
         
         if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
            $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . $_SERVER['HTTP_X_FORWARDED_HOST'];
            Toastr::success('Successfuly Updated your profile!');
            return redirect($url . '/user-profile');
         } else {
            Toastr::success('Successfuly Updated your profile!');
            return redirect()->back();
         }
      }
      
      public function singleProfileUpdate(Request $request, $ids, $id)
      {
         //  dd($id);
         User::find($id)->update([
             'name' => $request->name,
             'phone_code' => '+' . $request->phone_code,
             'phone' => $request->phone,
             'email' => $request->name
         ]);
         
         if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
            $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . $_SERVER['HTTP_X_FORWARDED_HOST'];
            Toastr::success('Successfuly Updated your profile!');
            return redirect($url . '/user-profile');
         } else {
            Toastr::success('Successfuly Updated your profile!');
            return redirect()->back();
         }
      }
      
      public function passwordChange(Request $request, $id)
      {
         $request->validate([
             'current_password' => ['required', new MatchOldPassword],
             'new_password' => ['required'],
             'new_confirm_password' => ['same:new_password'],
         ]);
         
         User::find($id)->update(['password' => Hash::make($request->new_password)]);
         Toastr::success('Successfuly Changed the Password!');
         //  dd('Successfuly Changed the Password!');
         return back();
      }
      
      public function singlePasswordChange(Request $request, $vendor_id, $user_id)
      {
         $request->validate([
             'current_password' => ['required', new MatchOldPassword],
             'new_password' => ['required'],
             'new_confirm_password' => ['same:new_password'],
         ]);
         
         User::find($user_id)->update(['password' => Hash::make($request->new_password)]);
         Toastr::success('Successfuly Changed the Password!');
         //  dd('Successfuly Changed the Password!');
         if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
            $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . $_SERVER['HTTP_X_FORWARDED_HOST'];
            
            return redirect($url . '/user-profile');
         } else {
            return redirect()->back();
         }
      }
      
      public function topRest(/* Request $request */)
      {
         $vendors = Vendor::where([['isTop', '1'], ['status', 1]])->orderBy('id', 'DESC')->get()->makeHidden(['vendor_logo']);
         foreach ($vendors as $vendor) {
            if (session()->has('delivery_location')) {
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
            } else {
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
         
         if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
            $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . $_SERVER['HTTP_X_FORWARDED_HOST'];
            
            Session::flush();
            Auth::logout();
            // dd($url.'/login');
            return redirect($url . '/login');
         } else {
            Session::flush();
            Auth::logout();
            return redirect()->route('customer.login');
         }
      }
      
      
      public function getRest($id)
      {
         $vendor = Vendor::where('id', $id)->first();
         // foreach ($vendors as $vendor) {
         //     $lat1 = $vendor->lat;
         //     $lon1 = $vendor->lang;
         //     $lat2 = $request->lat;
         //     $lon2 = $request->lang;
         //     $unit = 'K';
         //     if (($lat1 == $lat2) && ($lon1 == $lon2)) {
         //         $distance = 0;
         //     } else {
         //         $theta = $lon1 - $lon2;
         //         $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
         //         $dist = acos($dist);
         //         $dist = rad2deg($dist);
         //         $miles = $dist * 60 * 1.1515;
         //         $unit = strtoupper($unit);
         //         if ($unit == "K") {
         //             $distance = $miles * 1.609344;
         //         } else if ($unit == "N") {
         //             $distance = $miles * 0.8684;
         //         } else {
         //             $distance = $miles;
         //         }
         //     }
         //     $vendor['distance'] = round($distance);
         //     if (auth('api')->user() != null) {
         //         $user = auth('api')->user();
         //         $vendor['like'] = in_array($vendor->id, explode(',', $user->faviroute));
         //     } else {
         //         $vendor['like'] = false;
         //     }
         // }
         return $vendor;
      }
      
      
      public function singleVendor($vendor_id)
      {
         $master = array();
         
         $master['vendor'] = Vendor::where([['id', $vendor_id], ['status', 1]])->first(['id', 'image', 'tax', 'name', 'map_address', 'for_two_person', 'vendor_type', 'cuisine_id'])->makeHidden(['vendor_logo']);
         if ($master['vendor']->tax == null) {
            $master['vendor']->tax = strval(5);
         }
         
         //        $MenuCategory =
         //            MenuCategory::where([['menu_category.vendor_id', $vendor_id], ['menu_category.status', 1]])
         //                ->join('single_menu', 'menu_category.id', '=', 'single_menu.menu_category_id')
         //                ->join('half_n_half_menu', 'menu_category.id', '=', 'half_n_half_menu.menu_category_id')
         //                ->join('deals_menu', 'menu_category.id', '=', 'deals_menu.menu_category_id')
         //                ->orderBy('menu_category.id', 'DESC')
         //                ->get();
         //                ->get(['menu_category.id', 'menu_category.name', 'menu_category.type', 'single_menu.id', 'single_menu.menu_id', 'single_menu.item_category_id', 'single_menu.status']);
         //        DB::enableQueryLog();
         $MenuCategory =
             MenuCategory::with([
                 'SingleMenu',
                 'HalfNHalfMenu',
                 'DealsMenu'
             ])
                 ->where([['menu_category.vendor_id', $vendor_id], ['menu_category.status', 1]])
                 ->get();
         //        dd($MenuCategory);
         $master['MenuCategory'] = $MenuCategory;
         //        $menus = Menu::where([['vendor_id', $vendor_id], ['status', 1]])->orderBy('id', 'DESC')->get(['id', 'name', 'image']);
         //        $tax = GeneralSetting::first()->isItemTax;
         //        foreach ($menus as $menu) {
         //            $menu['submenu'] = Submenu::where([['menu_id', $menu->id], ['status', 1]])->get(['id', 'qty_reset', 'item_reset_value','type', 'name', 'image', 'price']);
         //            foreach ($menu['submenu'] as $value) {
         //                $value['custimization'] = SubmenuCusomizationType::where('submenu_id', $value->id)->get(['id', 'name', 'custimazation_item', 'type']);
         //                if ($tax == 0) {
         //                    $price_tax = GeneralSetting::first()->item_tax;
         //                    $disc = $value->price * $price_tax;
         //                    $discount = $disc / 100;
         //                    $value->price = strval($value->price + $discount);
         //                } else {
         //                    $value->price = strval($value->price);
         //                }
         //            }
         //        }
         //        $master['menu'] = $menus;
         //        $master['vendor_discount'] = VendorDiscount::where('vendor_id', $vendor_id)->orderBy('id', 'desc')->first(['id', 'type', 'discount', 'min_item_amount', 'max_discount_amount', 'start_end_date']);
         //        $master['delivery_timeslot'] = WorkingHours::where([['type', 'delivery_time'], ['vendor_id', $vendor_id]])->get(['id', 'day_index', 'period_list', 'status']);
         //        $master['pick_up_timeslot'] = WorkingHours::where([['type', 'pick_up_time'], ['vendor_id', $vendor_id]])->get(['id', 'day_index', 'period_list', 'status']);
         //        $master['selling_timeslot'] = WorkingHours::where([['type', 'selling_timeslot'], ['vendor_id', $vendor_id]])->get(['id', 'day_index', 'period_list', 'status']);
         //
         //        $now = Carbon::now();
         //        $today = Carbon::createFromFormat('H:i', '21:00');
         //        $dayname = $now->format('l');
         //
         //        foreach ($master['delivery_timeslot'] as $value) {
         //            $arr = json_decode($value['period_list'], true);
         //            if ($dayname == $value['day_index']) {
         //                foreach ($arr as $key => $a) {
         //                    $Hour1 = strtotime($a['start_time']);
         //                    $Hour2 = strtotime($a['end_time']);
         //                    $startofday = strtotime("01:00 am");
         //
         //                    $seconds = $Hour2 - $Hour1;
         //                    $hours = $seconds / 60 / 60;
         //                    $hours = abs($hours);
         //                    $tts = date("H", $Hour1);
         //                    $seconds = $Hour2 - $Hour1;
         //                    $hours = $seconds / 60 / 60;
         //                    $beadded = 0;
         //                    if ($hours < 0) {
         //                        $remainDay = 24 - $tts;
         //                        $nextday = $Hour2 - $startofday;
         //                        $d = $nextday / 60 / 60;
         //                        // $d + 1;
         //                        $beadded = $remainDay + $d + 1;
         //                    } else {
         //                        $beadded = $hours;
         //                    }
         //                    $today = Carbon::createFromFormat('H:i', date("H:i", $Hour1));
         //                    $arr[$key]['new_start_time'] = $today->copy()->toDateTimeString();
         //                    $arr[$key]['new_end_time'] = $today->addHours($beadded)->toDateTimeString();
         //                }
         //            }
         //            $value['period_list'] = $arr;
         //        }
         //        foreach ($master['pick_up_timeslot'] as $pvalue) {
         //            $parr = json_decode($pvalue['period_list'], true);
         //            if ($dayname == $pvalue['day_index']) {
         //                foreach ($parr as $pkey => $pa) {
         //                    $pHour1 = strtotime($pa['start_time']);
         //                    $pHour2 = strtotime($pa['end_time']);
         //                    $pstartofday = strtotime("01:00 am");
         //                    $pseconds = $pHour2 - $pHour1;
         //                    $phours = $pseconds / 60 / 60;
         //                    $phours = abs($phours);
         //                    $ptts = date("H", $pHour1);
         //                    $pseconds = $pHour2 - $pHour1;
         //                    $phours = $pseconds / 60 / 60;
         //                    $pbeadded = 0;
         //                    if ($phours < 0) {
         //                        $premainDay = 24 - $ptts;
         //
         //                        $pnextday = $pHour2 - $pstartofday;
         //                        $pd = $pnextday / 60 / 60;
         //                        $pbeadded = $premainDay + $pd + 1;
         //                    } else {
         //                        $pbeadded = $phours;
         //                    }
         //                    $ptoday = Carbon::createFromFormat('H:i', date("H:i", $pHour1));
         //                    $parr[$pkey]['new_start_time'] = $ptoday->copy()->toDateTimeString();
         //                    $parr[$pkey]['new_end_time'] = $ptoday->addHours($pbeadded)->toDateTimeString();
         //                }
         //            }
         //            $pvalue['period_list'] = $parr;
         //        }
         
         return $master;
      }
   }
