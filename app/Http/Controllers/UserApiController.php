<?php

namespace App\Http\Controllers;

use App\Mail\Verification;
use App\Mail\ForgotPassword;
use App\Mail\StatusChange;
use App\Mail\VendorOrder;
use App\Mail\DriverOrder;
use App\Models\Banner;
use App\Models\MenuSize;
use App\Models\Cuisine;
use App\Models\MenuAddon;
use App\Models\BusinessSetting;
use App\Models\cart;
use App\Models\DealsMenu;
use App\Models\DealsItems;
use App\Models\DeliveryPerson;
use Illuminate\Support\Facades\Session;
use App\Models\HalfNHalfMenu;
use App\Models\ItemCategory;
use App\Models\ItemSize;
use App\Models\MenuCategory;
use App\Models\WalletPayment;
use App\Models\DeliveryZoneArea;
use App\Models\Faq;
use App\Models\Feedback;
use App\Models\GeneralSetting;
use App\Models\Menu;
use App\Models\Notification;
use App\Models\NotificationTemplate;
use App\Models\Order;
use App\Models\OrderChild;
use App\Models\OrderSetting;
use App\Models\PaymentSetting;
use App\Models\PromoCode;
use App\Models\Review;
use App\Models\Refund;
use App\Models\Role;
use App\Models\Submenu;
use App\Models\SubmenuCusomizationType;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Vendor;
use App\Models\VendorDiscount;
use App\Models\WorkingHours;
use App\Models\Tax;
use Carbon\Carbon;
use Config;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mail;
use OneSignal;
use Stripe\Stripe;
use Twilio\Rest\Client;
use Bavix\Wallet\Models\Transaction;
use Arr;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Log;
use App\Models\DeliveryZoneNew;

class UserApiController extends Controller
{
  public function getNearBy($vendor_id)
  {
     $User = auth()->user();
     $UserAddress = UserAddress::where([['user_id', $User->id], ['selected', 1]])->first();
     log::info($UserAddress);

     $Point = new Point($UserAddress->lat, $UserAddress->lang);
     log::info($Point);
     $DeliveryZoneNew = DeliveryZoneNew::select('vendor_id')->contains('coordinates', $Point)->get();
     log::info('delivery zone');
     log::info($DeliveryZoneNew);
     if (!$DeliveryZoneNew)
        return response(['success' => false, 'data' => []]);

     $radius = GeneralSetting::first()->radius;
     // $vendors = Vendor::where('status', 1)->get(['id', 'image', 'name', 'lat', 'lang', 'cuisine_id', 'vendor_type'])->makeHidden(['vendor_logo']);
     $vendors = Vendor::where('id', $vendor_id)->whereIn('id', $DeliveryZoneNew)->get(['id', 'image', 'name', 'lat', 'lang', 'cuisine_id', 'vendor_type'])->makeHidden(['vendor_logo']);
     foreach ($vendors as $vendor) {
        $googleApiKey = 'AIzaSyCDcZlGMIvPlbwuDgQzlEkdhjVQVPnne4c';
        $googleUrl = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&destinations="' . $UserAddress->lat . ',' . $UserAddress->lang . '"&origins="' . $vendor->lat . ',' . $vendor->lang . '"&key=' . $googleApiKey . '';
        $googleDistance = file_get_contents( $googleUrl );
        $googleDistance = json_decode($googleDistance);

        $vendor['distance'] = ($googleDistance->status == "OK") ? $googleDistance->rows[0]->elements[0]->distance->text : 'no route found';
        $vendor['duration'] = ($googleDistance->status == "OK") ? $googleDistance->rows[0]->elements[0]->duration->text : 'no route found';

        if (auth('api')->user() != null) {
           $user = auth('api')->user();
           $vendor['like'] = in_array($vendor->id, explode(',', $user->faviroute));
        } else {
           $vendor['like'] = false;
        }
     }
     \Log::critical($vendors);
     return response(['success' => true, 'data' => $vendors]);
  }
  public function userAddress(Request $request){

    $address  = new UserAddress();
    $address->user_id = $request->userID;
    $address->lat = 33.6497;
    $address->lang = 33.55464;
    $address->address = $request->address;
    $address->type = $request->type;
    $address->save();
    $data['address'] = $address;
    return response(['success' => true, 'data' => $data]);
  }

  public function getUserAddress($id){
    $address  = UserAddress::where('user_id',$id)->get();
    $data['address'] = $address;
    return response(['success' => true, 'data' => $data]);
  }

  public function addToCart(Request $request)
  {

    if ($request->addon_id) {
      $addonString = $request->addon_id;
      for ($i = 0; $i < count($addonString); $i++) {
        if ($addonString[$i] != null) {
          if ($i != 0) {
            $value[] = $i;
          }
        }
      }
    }
    $addonPrice = 0;
    if (isset($value)) {
      $addon_id = implode(",", $value);

      for ($i = 0; $i < count($value); $i++) {

        $menuAddon = MenuAddon::where('vendor_id', $request->vendor_id)->where('menu_id', $request->menu_id)->where('addon_id', $value[$i])->first();
        if ($menuAddon) {
          $addonPrice = $addonPrice + $menuAddon->price;
        }
      }
    }
    $price = 0;
    $menuPrice = 0;
    if ($request->half_and_half_id) {
      $menuSize = MenuSize::where('vendor_id', $request->vendor_id)->where('menu_id', $request->first_half_id)->first();

      if ($menuSize) {
        if ($menuSize->display_discount_price) {
          $firstprice = $menuSize->display_discount_price / 2;
          $firstmenuPrice = $menuSize->display_discount_price / 2;
        } else {
          $firstprice = $menuSize->display_price / 2;
          $firstmenuPrice = $menuSize->display_price / 2;
        }
      }
      $menuSize = MenuSize::where('vendor_id', $request->vendor_id)->where('menu_id', $request->second_half_id)->first();

      if ($menuSize) {
        if ($menuSize->display_discount_price) {
          $secondprice = $menuSize->display_discount_price / 2;
          $secondmenuPrice = $menuSize->display_discount_price / 2;
        } else {
          $secondprice = $menuSize->display_price / 2;
          $secondmenuPrice = $menuSize->display_price / 2;
        }
      }
      $price = $firstprice + $secondprice;
      $menuPrice = $firstmenuPrice + $secondmenuPrice;
    } elseif ($request->size_id) {
      $menuSize = MenuSize::where('vendor_id', $request->vendor_id)->where('menu_id', $request->menu_id)->where('id', $request->size_id)->first();

      if ($menuSize) {
        if ($menuSize->display_discount_price) {
          $price = $menuSize->display_discount_price;
          $menuPrice = $menuSize->display_discount_price;
        } else {
          $price = $menuSize->display_price;
          $menuPrice = $menuSize->display_price;
        }
      }
    } else {
      $menu = menu::where('id', $request->menu_id)->where('vendor_id', $request->vendor_id)->first();
      if ($menu->display_discount_price) {
        $price = $menu->display_discount_price;
        $menuPrice = $menu->display_discount_price;
      } else {
        $price = $menu->display_price;
        $menuPrice = $menu->display_price;
      }
    }

    $price =  $price + $addonPrice;
    if ($request->half_and_half_id) {
      $menu = HalfNHalfMenu::where('id', $request->half_and_half_id)->where('vendor_id', $request->vendor_id)->first();
    } else {
      $menu = menu::where('id', $request->menu_id)->where('vendor_id', $request->vendor_id)->first();
    }


    if ($request->session_id) {
      $cart = new cart();
      $cart->vendor_id = $request->vendor_id;
      $cart->session_id = $request->session_id;
      $cart->menu_id = $request->menu_id;
      $cart->menu_name = $menu->name;
      $cart->unit_price = $menuPrice;
      // $cart->single_menu_id = $request->single_menu_id;
      $cart->half_menu_id = $request->half_and_half_id;
      // $cart->deal_menu_id = $request->deal_menu_id;
      $cart->size_id = $request->size_id;
      $cart->firstHalf = $request->first_half_id;
      $cart->secondHalf = $request->second_half_id;
      if (isset($value)) {
        $cart->addon_id = $addon_id;
      }
      $cart->quantity = $request->quantity;
      $cart->price = $price * $request->quantity;
      $cart->save();
    } else {
      $cart = new cart();
      $cart->session_id = session()->getId();
      $cart->vendor_id = $request->vendor_id;
      $cart->menu_id = $request->menu_id;
      $cart->menu_name = $menu->name;
      $cart->unit_price = $menuPrice;
      // $cart->single_menu_id = $request->single_menu_id;
      $cart->half_menu_id = $request->half_and_half_id;
      // $cart->deal_menu_id = $request->deal_menu_id;
      $cart->size_id = $request->size_id;
      $cart->firstHalf = $request->first_half_id;
      $cart->secondHalf = $request->second_half_id;
      if (isset($value)) {
        $cart->addon_id = $addon_id;
      }
      $cart->quantity = $request->quantity;
      $cart->price = $price * $request->quantity;
      $cart->save();
    }
    $data['cart'] = $cart;
    $data['session_id'] = $cart->session_id;
    return response(['success' => true, 'data' => $data]);
  }

  public function getCartData($vendor_id, $session_id)
  {
    $cart = cart::where('vendor_id', $vendor_id)->where('session_id', $session_id)->get();
    $data['cart'] = $cart;
    return response(['success' => true, 'data' => $data]);
  }

  public function getCartDataCheckout($cart_id)
  {
    $cart = cart::where('id', $cart_id)->first();
    $cart = cart::where('session_id', $cart->session_id)->get();
    $data['cart'] = $cart;
    return response(['success' => true, 'data' => $data]);
  }

  public function addQuantity($cart_id)
  {
    $cart = cart::find($cart_id);
    $cart->quantity = $cart->quantity + 1;
    $cart->price = $cart->quantity * $cart->unit_price;
    $cart->save();
    $data['cart'] = $cart;
    return response(['success' => true, 'data' => $data]);
  }

  public function minusQuantity($cart_id)
  {
    $cart = cart::find($cart_id);
    if ($cart->quantity > 1) {
      $cart->quantity = $cart->quantity - 1;
      $quantity = $cart->quantity;
      $cart->price = $quantity * $cart->unit_price;
      $cart->save();
    }

    $data['cart'] = $cart;
    return response(['success' => true, 'data' => $data]);
  }

  public function apiUserLogin(Request $request)
  {
    log::info($request);
    $request->validate([
      'email_id' => 'bail|required|email',
      'password' => 'bail|required|min:6',
      'provider_token' => 'bail|required_if:provider:GOOGLE,FACEBOOK',
      'provider' => 'bail|required',
    ]);
    $user = ([
      'email_id' => $request->email_id,
      'password' => $request->password,
    ]);

    if ($request->provider == 'LOCAL') {
      if (Auth::attempt($user)) {
        $user = Auth::user();
        if ($user->status == 1) {
          if ($user->roles->contains('title', 'user')) {
            if (isset($request->device_token)) {
              $user->device_token = $request->device_token;
              $user->save();
            }
            if ($user['is_verified'] == 1) {
              $user['token'] = $user->createToken('mealUp')->accessToken;
              return response()->json(['success' => true, 'data' => $user], 200);
            } else {
              $this->sendNotification($user);
              return response(['success' => true, 'data' => $user, 'msg' => 'Otp send in your account']);
            }
          } else {
            return response(['success' => false, 'msg' => 'You have no permissions to login. Please ask administrators...']);
          }
        } else {
          return response()->json(['success' => false, 'message' => 'you are block by admin please contact support'], 401);
        }
      } else {
        return response()->json(['success' => false, 'message' => 'credintial does not match our record']);
      }
    } else {
      $data = $request->all();
      $data['role'] = 0;
      $data['is_verified'] = 1;
      $filtered = Arr::except($data, ['provider_token']);
      if ($data['provider'] !== 'LOCAL') {
        $user = User::where('email', $data['email'])->first()->makeHidden('otp');
        if ($user) {
          $user->provider_token = $request->provider_token;
          $token = $user->createToken('mealUp')->accessToken;
          $user->save();
          $user['token'] = $token;
          return response()->json(['success' => true, 'data' => $user], 200);
        } else {
          $data = User::firstOrCreate(['provider_token' => $request->provider_token], $filtered);
          if ($request->image != null) {
            $url = $request->image;
            $contents = file_get_contents($url);
            $name = substr($url, strrpos($url, '/') + 1);
            $destinationPath = public_path('/images/upload/') . $name . '.png';
            file_put_contents($destinationPath, $contents);
            $data['image'] = $name . '.png';
          } else {
            $data['image'] = 'noimage.png';
          }
          if (isset($data['device_token'])) {
            $data['device_token'] = $data->device_token;
          }
          $data->save();
          $token = $data->createToken('mealUp')->accessToken;
          $data['token'] = $token;
          return response()->json(['success' => true, 'data' => $data], 200);
        }
      }
    }
  }

  public function apiUserRegister(Request $request)
  {
    $request->validate([
      'name' => 'bail|required',
      'email_id' => 'bail|required|unique:users',
      'password' => 'bail|min:6',
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
    $data['phone_code'] = $request->phone_code;
    $data['language'] = $request->language;
    $user = User::create($data);
    $role_id = Role::where('title', 'user')->orWhere('title', 'User')->first();
    $user->roles()->sync($role_id);

    if ($user['is_verified'] == 1) {
      $user['token'] = $user->createToken('mealUp')->accessToken;
      return response()->json(['success' => true, 'data' => $user, 'msg' => 'account created successfully..!!'], 200);
    } else {
      $admin_verify_user = GeneralSetting::find(1)->verification;
      if ($admin_verify_user == 1) {
        $this->sendNotification($user);
        return response(['success' => true, 'data' => $user, 'msg' => 'your account created successfully please verify your account']);
      }
    }
  }

  public function apiForgotPassword(Request $request)
  {
    $request->validate([
      'password' => 'bail|required|min:6',
      'password_confirmation' => 'bail|required|min:6|same:password',
      'user_id' => 'bail|required',
    ]);
    $data = $request->all();
    $user = User::find($request['user_id']);
    if ($user) {
      $user->password = Hash::make($data['password']);
      $user->save();
      return response(['success' => true, 'data' => 'Password Update Successfully...!!']);
    } else {
      return response(['success' => false, 'data' => 'User not found!!']);
    }
  }

  public function apiChangePassword(Request $request)
  {
    $request->validate([
      'old_password' => 'bail|required|min:6',
      'password' => 'bail|required|min:6',
      'password_confirmation' => 'bail|required|min:6',
    ]);
    $data = $request->all();
    $id = auth()->user();
    if (Hash::check($data['old_password'], $id->password) == true) {
      if ($data['password'] == $data['password_confirmation']) {
        $id->password = Hash::make($data['password']);
        $id->save();
        return response(['success' => true, 'data' => 'Password Update Successfully.!']);
      } else {
        return response(['success' => false, 'data' => 'password and confirm password does not match.']);
      }
    } else {
      return response(['success' => false, 'data' => 'Old password does not match.']);
    }
  }

  public function apiSendOtp(Request $request)
  {
    $request->validate([
      'email_id' => 'bail|required',
      'where' => 'bail|required'
    ]);
    $user = User::where('email_id', $request->email_id)->first();
    if ($user) {
      if ($request->where == 'register') {
        $this->sendNotification($user);
      }
      if ($request->where == 'forgot_password') {
        $this->ForgotPassword($user);
      }
      $user->makeHidden('otp');
      return response(['success' => true, 'data' => $user]);
    } else {
      return response(['success' => false, 'msg' => __('User Not Found.')]);
    }
  }

  public function apiCancelOrder(Request $request)
  {
    $request->validate([
      'cancel_reason' => 'required'
    ]);
    $data = $request->all();
    $order = Order::find($data['id']);
    if ($order) {
      $order->cancel_by = 'user';
      $order->order_status = 'CANCEL';
      $order->cancel_reason = $request->cancel_reason;
      $order->save();
      return response(['success' => true, 'data' => 'Cancel Order successfully..!!']);
    }
    return response(['success' => false, 'data' => 'No record found for this record']);
  }

  public function apiSingleMenu($menu_id)
  {
    $menu = Menu::find($menu_id);
    $tax = GeneralSetting::first()->isItemTax;
    $submenus = Submenu::where('menu_id', $menu->id)->get();
    foreach ($submenus as $submenu) {
      $submenu['custimization'] = SubmenuCusomizationType::where('submenu_id', $submenu->id)->get();
      if ($tax == 0) {
        $price_tax = GeneralSetting::first()->item_tax;
        $disc = $submenu->price * $price_tax;
        $tax = $disc / 100;
        $submenu->price = strval($submenu->price + $tax);
      }
    }
    return response(['success' => true, 'data' => $submenus]);
  }

  public function apiSingleVendor($vendor_id)
  {
    $master = array();
    $master['vendor'] = Vendor::where('id', $vendor_id)->first();
    if ($master['vendor']->tax == null) {
      $master['vendor']->tax = strval(5);
    }

    $MenuCategory =
      MenuCategory::with([
        'SingleMenu' => function ($query) {
          $query->where('single_menu.status', 1);
        },

        'SingleMenu.Menu.MenuAddon.Addon.AddonCategory',
        'SingleMenu.Menu.GroupMenuAddon.AddonCategory',
        'SingleMenu.Menu.MenuSize.GroupMenuAddon.AddonCategory',
        'SingleMenu.Menu.MenuSize.MenuAddon.Addon.AddonCategory',
        'SingleMenu.Menu.MenuSize.ItemSize',
        'SingleMenu.SingleMenuItemCategory.ItemCategory',
        'HalfNHalfMenu.ItemCategory',
        'DealsMenu.DealsItems.ItemCategory',
      ])
      ->where([['menu_category.vendor_id', $vendor_id], ['menu_category.status', 1]])
      ->get();

    $master['MenuCategory'] = $MenuCategory;
    return response(['success' => true, 'data' => $master]);
  }

  public function apiMenuAddon($vendor_id, $menu_id)
  {
    $MenuAddon =  MenuAddon::with(['MenuSize.ItemSize', 'AddonCategory.Addon', 'Addon.AddonCategory'])
      ->where('menu_id', $menu_id)
      ->where('vendor_id', $vendor_id)
      ->get();

    $master['MenuAddon'] = $MenuAddon;
    return response(['success' => true, 'data' => $master]);
  }

  public function apiMenuSize($vendor_id, $menu_id)
  {
    $MenuSizes =  MenuSize::with(['ItemSize', 'GroupMenuAddon.AddonCategory.Addon', 'GroupMenuAddon.Addon.AddonCategory', 'MenuAddon.AddonCategory.Addon'])
      ->where('menu_id', $menu_id)
      ->where('vendor_id', $vendor_id)
      ->get();

    $master['MenuSizes'] = $MenuSizes;
    return response(['success' => true, 'data' => $master]);
  }

  public function apiMenuSizeAddon($vendor_id, $menu_id, $size_id)
  {
    $MenuAddon =  MenuAddon::with(['MenuSize.ItemSize', 'AddonCategory.Addon', 'Addon.AddonCategory'])
      ->where('menu_id', $menu_id)
      ->where('vendor_id', $vendor_id)
      ->where('menu_size_id', $size_id)
      ->get();

    $master['MenuAddon'] = $MenuAddon;
    return response(['success' => true, 'data' => $master]);
  }


  public function apiSimpleVendor($vendor_id)
  {
    $Vendor = Vendor::where('id', $vendor_id)->first();
    if ($Vendor->tax == null) {
      $Vendor->tax = strval(5);
    }

    return response(['success' => true, 'data' => $Vendor]);
  }

  public function apiItemCategoriesVendor($vendor_id)
  {
    $ItemCategory = ItemCategory::where('vendor_id', $vendor_id)->get();

    return response(['success' => true, 'data' => $ItemCategory]);
  }

  /**
   * @throws \JsonException
   */
  public function apiSingleVendorRetrieveSizes($vendor_id, $item_category_id)
  {
    $data = ItemSize::with([
      'MenuSize.Menu.SingleMenu.SingleMenuItemCategory' => function ($query) use ($item_category_id) {
        $query->where('item_category_id', $item_category_id);
      },
      'MenuSize.GroupMenuAddon.AddonCategory',
      'MenuSize.MenuAddon.Addon.AddonCategory',
    ])->where('vendor_id', $vendor_id)->get();

    //         Log::info(json_encode(['success' => true, 'data' => $data], JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
    return response(['success' => true, 'data' => $data]);
  }

  /**
   * @throws \JsonException
   */
  public function apiSingleVendorRetrieveSize($vendor_id, $item_category_id, $item_size_id)
  {
    $data = ItemSize::with([
      'MenuSize.Menu.SingleMenu.SingleMenuItemCategory' => function ($query) use ($item_category_id) {
        $query->where('item_category_id', $item_category_id);
      },
      'MenuSize.GroupMenuAddon.AddonCategory',
      'MenuSize.MenuAddon.Addon.AddonCategory',
    ])->where([['id', $item_size_id], ['vendor_id', $vendor_id]])->first();


    Log::info(json_encode(['success' => true, 'data' => $data], JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
    return response(['success' => true, 'data' => $data]);
  }

  public function getMenuByPickingItemSize($vendor_id, $item_size_id)
  {
    $MenuSizes =  MenuSize::with(['Menu.MenuAddon.Addon'])
      ->where('item_size_id', $item_size_id)
      ->where('vendor_id', $vendor_id)
      ->get();
    $master['MenuSizes'] = $MenuSizes;
    return response(['success' => true, 'data' => $master]);
  }

  public function deaslMenuItems($vendor_id, $deal_item_id)
  {

    $deals = DealsItems::with('ItemCategory.SingleMenuItemCategory.SingleMenu.Menu')
      ->where('vendor_id', $vendor_id)
      ->where('deals_menu_id', $deal_item_id)
      ->get();
    return response(['success' => true, 'data' => $deals]);
  }

  public function deaslItems($vendor_id, $deal_item_id)
  {

    $deals = DealsItems::with('ItemCategory.SingleMenuItemCategory.SingleMenu.Menu')
      ->where('vendor_id', $vendor_id)
      ->where('id', $deal_item_id)
      ->get();
    return response(['success' => true, 'data' => $deals]);
  }

  public function apiPromoCode($vendor_id)
  {
    $promo = PromoCode::where('status', 1);
    $v = [];
    $promo_codes = PromoCode::where([['status', 1], ['display_customer_app', 1]])->get();
    foreach ($promo_codes as $promo_code) {
      $vendorIds = explode(',', $promo_code->vendor_id);
      if (($key = array_search($vendor_id, $vendorIds)) !== false) {
        array_push($v, $promo_code->id);
      }
    }
    $promo = $promo->whereIn('id', $v)->get();
    return response(['success' => true, 'data' => $promo]);
  }

  public function apiTax()
  {
    $taxs = Tax::whereStatus(1)->get(['id', 'name', 'tax', 'type']);
    return response(['success' => true, 'data' => $taxs]);
  }

  public function apiApplyPromoCode(Request $request)
  {
    $request->validate([
      'date' => 'required',
      'amount' => 'required',
      'delivery_type' => 'required',
      'promocode_id' => 'required',
    ]);
    $data = $request->all();

    $currency = GeneralSetting::first()->currency_symbol;
    $promoCode = PromoCode::find($data['promocode_id']);

    $users = explode(',', $promoCode->customer_id);
    if (($key = array_search(auth()->user()->id, $users)) !== false) {
      $exploded_date = explode(' - ', $promoCode->start_end_date);
      $currentDate = date('Y-m-d', strtotime($data['date']));
      if (($currentDate >= $exploded_date[0]) && ($currentDate <= $exploded_date[1])) {
        if ($promoCode->min_order_amount < $data['amount']) {
          if ($promoCode->coupen_type == 'both') {
            if ($promoCode->count_max_count < $promoCode->max_count && $promoCode->count_max_order < $promoCode->max_order && $promoCode->count_max_user < $promoCode->max_user) {
              $promo = PromoCode::where('id', $data['promocode_id'])->first(['id', 'image', 'isFlat', 'flatDiscount', 'discount', 'discountType']);
              Log::critical($promo);
              return response(['success' => true, 'data' => $promo]);
            } else {
              return response(['success' => false, 'data' => 'This Coupon is expire..!!']);
            }
          } else {
            if ($promoCode->coupen_type == $data['delivery_type']) {
              if ($promoCode->count_max_count < $promoCode->max_count && $promoCode->count_max_order < $promoCode->max_order && $promoCode->count_max_user < $promoCode->max_user) {
                $promo = PromoCode::where('id', $data['promocode_id'])->first(['id', 'image', 'isFlat', 'flatDiscount', 'discount', 'discountType']);
                Log::critical($promo);
                return response(['success' => true, 'data' => $promo]);
              } else {
                return response(['success' => false, 'data' => 'This Coupon is expire..!!']);
              }
            } else {
              return response(['success' => false, 'data' => 'This Coupon is not valid for ' . $data['delivery_type']]);
            }
          }
        } else {
          return response(['success' => false, 'data' => 'This Coupon not valid for less than ' . $currency . $promoCode->min_order_amount . ' amount']);
        }
      } else {
        return response(['success' => false, 'data' => 'Coupon is expire..!!']);
      }
    } else {
      return response(['success' => false, 'data' => 'Coupon is not valid for this user..!!']);
    }
  }

  public function apiCuisine()
  {
    $cuisines = Cuisine::where('status', 1)->orderBy('id', 'DESC')->get();
    return response(['success' => true, 'data' => $cuisines]);
  }

  public function apiFaq()
  {
    $faqs = Faq::where('type', 'customer')->orderBy('id', 'DESC')->get();
    return response(['success' => true, 'data' => $faqs]);
  }

  public function apiSetting()
  {
    $setting = GeneralSetting::first();
    return response(['success' => true, 'data' => $setting]);
  }

  public function apiOrderSetting($vendor_id)
  {
    $User = auth()->user();
    log::info($User);
    $UserAddress = UserAddress::where([['user_id', auth()->user()->id], ['selected', 1]])->first();
    $Vendor = Vendor::find($vendor_id);
    //         $Setting = OrderSetting::where('vendor_id', $vendor_id)->first();
    $Setting = OrderSetting::firstOrCreate([
      'vendor_id' => 1,
    ], [
      'vendor_id' => 1,
      'free_delivery' => 0,
      'free_delivery_distance' => 10,
      'free_delivery_amount' => 0,
      'min_order_value' => '100',
      'order_commission' => 0,
      'order_assign_manually' => '0',
      'orderRefresh' => '5',
      'order_dashboard_default_time' => '7days',
      'vendor_order_max_time' => '60',
      'driver_order_max_time' => '60',
      'delivery_charge_type' => 'order_amount',
      'charges' => '[]',
    ]);


     $googleApiKey = 'AIzaSyCfl4ZvZl3ptxZDO_4D8J4F0T_yqzzIVes';
     $googleUrl = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&destinations="' . $UserAddress->lat . ',' . $UserAddress->lang . '"&origins="' . $Vendor->lat . ',' . $Vendor->lang . '"&key=' . $googleApiKey . '';
     $googleDistance =
         file_get_contents(
             $googleUrl,
         );
     Log::critical($googleDistance);
     $googleDistance = json_decode($googleDistance);
        if(isset($googleDistance->rows[0]->elements[0]->distance->value)){
          $Setting['distance'] = ($googleDistance->status == "OK") ? $googleDistance->rows[0]->elements[0]->distance->value : 'no route found';
        }
        else{
          $Setting['distance'] = -1.1;
        }
    $Setting['tax_type'] = $Vendor->tax_type;
    $Setting['tax'] = $Vendor->tax;

    return response(['success' => true, 'data' => $Setting]);
  }

  public function apiVendorStatus($vendor_id)
  {
    $Vendor = Vendor::select('id', 'vendor_status', 'delivery_status', 'pickup_status')->find($vendor_id)->makeHidden('image', 'vendor_logo', 'cuisine', 'rate', 'review');

    if (!$Vendor) {

      return response(['success' => false, 'msg' => 'vendor not found.']);
    }

    return response(['success' => true, 'data' => $Vendor]);
  }

  public function apiPaymentSetting()
  {
    $setting = PaymentSetting::first();
    return response(['success' => true, 'data' => $setting]);
  }

  public function apiBookOrder(Request $request)
  {
    $validation = $request->validate([
      'date' => 'bail|required',
      'time' => 'bail|required',
      'amount' => 'bail|required|numeric',
      'sub_total' => 'bail|required|numeric',
      'item' => 'bail|required',
      'vendor_id' => 'required',
      'delivery_type' => 'bail',
      //             'address_id' => 'bail|required_if:delivery_type,HOME',
      'payment_type' => 'bail|required',
      'payment_token' => 'bail|required_if:payment_type,STRIPE,RAZOR,PAYPAl',
      // 'delivery_charge' => 'bail|required_if:delivery_type,HOME',
      //             'tax' => 'required',
    ]);
    //         \Log::critical($request);
    //         return;

    $bookData = $request->all();
    $bookData['amount'] = (float)number_format((float)$bookData['amount'], 2, '.', '');
    $bookData['sub_total'] = (float)number_format((float)$bookData['sub_total'], 2, '.', '');
    //  $bookData['address_id'] = 32;

    Log::info('$bookData[\'delivery_date\']');
    Log::info($bookData['delivery_date']);
    Log::info('$bookData[\'delivery_time\']');
    Log::info($bookData['delivery_time']);

    if ($bookData['delivery_date'] != null && $bookData['delivery_time'] != null) {
      $bookData['delivery_date'] = Carbon::createFromFormat('Y-m-d H:i:s.u', $bookData['delivery_date'])->format('Y-m-d');
      $bookData['delivery_time'] = Carbon::createFromFormat('g:i A', $bookData['delivery_time'])->format('H:i:s');
      Log::info('$bookData[\'delivery_date\']');
      Log::info($bookData['delivery_date']);
      Log::info('$bookData[\'delivery_time\']');
      Log::info($bookData['delivery_time']);
      $dateTime = $bookData['delivery_date'] . ' ' . $bookData['delivery_time'];
      Log::info('$dateTime');
      Log::info($dateTime);
      //            $bookData['delivery_time'] = Carbon::parse($dateTime)->timestamp;
      $bookData['delivery_time'] = $dateTime;
      Log::info('$bookData[\'delivery_time\']');
      Log::info($bookData['delivery_time']);
    }

    $vendor = Vendor::where('id', $bookData['vendor_id'])->first();
    $vendorUser = User::find($vendor->user_id);
    $customer = auth()->user();
    log::info($customer);
    $UserAddress = UserAddress::where('user_id', auth()->user()->id)->first();
    log::info($UserAddress);
    $bookData['address_id'] = $UserAddress->id;
    if ($vendor->vendor_status == 0)
      return response(['success' => false, 'data' => "Vendor is offline."]);
    if ($bookData['delivery_type'] == 'TAKEAWAY' && $vendor->delivery_status == 0)
      return response(['success' => false, 'data' => "Vendor delivery status is offline."]);
    if ($bookData['delivery_type'] == 'DELIVERY' && $vendor->pickup_status == 0)
      return response(['success' => false, 'data' => "Vendor pickup status is offline."]);

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

    $bookData['order_id'] = '#' . rand(100000, 999999);
    $bookData['vendor_id'] = $vendor->id;
    $bookData['order_data'] = $bookData['item'];
    $bookData['delivery_time'] = $bookData['delivery_time'];
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

    $tax = array();
    if ($vendor->admin_comission_type == 'percentage') {
      $comm = $amount * $vendor->admin_comission_value;
      $tax['admin_commission'] = intval($comm / 100);
      $tax['vendor_amount'] = intval($amount - $tax['admin_commission']);
    }
    if ($vendor->admin_comission_type == 'amount') {
      $tax['vendor_amount'] = $amount - $vendor->admin_comission_value;
      $tax['admin_commission'] = $amount - $tax['vendor_amount'];
    }

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
    $order->update($tax);

    $firebaseQuery = app('App\Http\Controllers\FirebaseController')->setOrder($order->user_id, $order->id, $order->order_status);

    //         if ($order->payment_type == 'FLUTTERWAVE') {
    //            return response(['success' => true, 'url' => url('FlutterWavepayment/' . $order->id), 'data' => "order booked successfully wait for confirmation"]);
    //         } else {
    return response(['success' => true, 'data' => "order booked successfully wait for confirmation"]);
    //         }
  }

  // vue js frontend
  public function apiBookOrderVuejs(Request $request)
  {
    Log::info($request);
    // $validation = $request->validate([
    //   'date' => 'bail|required',
    //   'time' => 'bail|required',
    //   'amount' => 'bail|required|numeric',
    //   'sub_total' => 'bail|required|numeric',
    //   'item' => 'bail|required',
    //   'vendor_id' => 'required',
    //   'delivery_type' => 'bail',
    //   'payment_type' => 'bail|required',
    //   'payment_token' => 'bail|required_if:payment_type,STRIPE,RAZOR,PAYPAl',
    // ]);

    $bookData = $request->all();
    $bookData['amount'] = (float)number_format((float)$bookData['amount'], 2, '.', '');
    $bookData['sub_total'] = (float)number_format((float)$bookData['sub_total'], 2, '.', '');
    //  $bookData['address_id'] = 32;

    // if ($bookData['delivery_date'] != null && $bookData['delivery_time'] != null) {
    //   $bookData['delivery_date'] = Carbon::createFromFormat('Y-m-d H:i:s.u', $bookData['delivery_date'])->format('Y-m-d');
    //   $bookData['delivery_time'] = Carbon::createFromFormat('g:i A', $bookData['delivery_time'])->format('H:i:s');
    //   Log::info('$bookData[\'delivery_date\']');
    //   Log::info($bookData['delivery_date']);
    //   Log::info('$bookData[\'delivery_time\']');
    //   Log::info($bookData['delivery_time']);
    //   $dateTime = $bookData['delivery_date'] . ' ' . $bookData['delivery_time'];
    //   Log::info('$dateTime');
    //   Log::info($dateTime);
    //   //            $bookData['delivery_time'] = Carbon::parse($dateTime)->timestamp;
    //   $bookData['delivery_time'] = $dateTime;
    //   Log::info('$bookData[\'delivery_time\']');
    //   Log::info($bookData['delivery_time']);
    // }

    $vendor = Vendor::where('id', $bookData['vendor_id'])->first();
    $vendorUser = User::find($vendor->user_id);
    $customer = User::find($request->user_id);
    log::info($customer);
    $UserAddress = UserAddress::where('user_id', $request->user_id)->first();
    log::info($UserAddress);
    $bookData['address_id'] = $UserAddress->id;
    if ($vendor->vendor_status == 0)
      return response(['success' => false, 'data' => "Vendor is offline."]);
    if ($bookData['delivery_type'] == 'TAKEAWAY' && $vendor->delivery_status == 0)
      return response(['success' => false, 'data' => "Vendor delivery status is offline."]);
    if ($bookData['delivery_type'] == 'DELIVERY' && $vendor->pickup_status == 0)
      return response(['success' => false, 'data' => "Vendor pickup status is offline."]);

    if ($bookData['payment_type'] == 'STRIPE') {
      $paymentSetting = PaymentSetting::find(1);
      log::info('payment setting');
      log::info( $paymentSetting);
      $stripe_sk = $paymentSetting->stripe_secret_key;
      log::info( $stripe_sk);
      // $currency = GeneralSetting::find(1)->currency;
      // log::info( $currency);
      $stripe = new \Stripe\StripeClient($stripe_sk);
      $payment_token  = $stripe->tokens->create([
        'card' => [
          'number' =>$request->cardNumber,
          'exp_month' => $request->month,
          'exp_year' => $request->year,
          'cvc' => $request->cvv,
        ],
      ]);
      log::info($payment_token->id);
      $charge = $stripe->charges->create(
        [
          "amount" => $bookData['amount'] * 100,
          "currency" => "AUD",
          "source" => $payment_token->id,
        ]
      );
      $bookData['payment_token'] = $charge->id;
    }
    $bookData['user_id'] = $request->user_id;

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

    $bookData['order_id'] = '#' . rand(100000, 999999);
    $bookData['vendor_id'] = $vendor->id;
    $bookData['order_status'] = "PENDING";
    log::info($bookData);
    // $bookData['order_data'] = $bookData['item'];
    // $bookData['delivery_time'] = $bookData['delivery_time'];
    $order = Order::create($bookData);
    app('App\Http\Controllers\NotificationController')->process('vendor', 'order', 'New Order', [$vendorUser->id, $vendorUser->device_token, $vendorUser->email], $vendorUser->name, $order->order_id, $customer->name, $order->time);
    $amount = $order->amount;

    $tax = array();
    if ($vendor->admin_comission_type == 'percentage') {
      $comm = $amount * $vendor->admin_comission_value;
      $tax['admin_commission'] = intval($comm / 100);
      $tax['vendor_amount'] = intval($amount - $tax['admin_commission']);
    }
    if ($vendor->admin_comission_type == 'amount') {
      $tax['vendor_amount'] = $amount - $vendor->admin_comission_value;
      $tax['admin_commission'] = $amount - $tax['vendor_amount'];
    }

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
    $order->update($tax);

    $firebaseQuery = app('App\Http\Controllers\FirebaseController')->setOrder($order->user_id, $order->id, $order->order_status);

    //         if ($order->payment_type == 'FLUTTERWAVE') {
    //            return response(['success' => true, 'url' => url('FlutterWavepayment/' . $order->id), 'data' => "order booked successfully wait for confirmation"]);
    //         } else {
    return response(['success' => true, 'data' => "order booked successfully wait for confirmation"]);
    //         }
  }

  //

  public function apiShowOrder()
  {
    app('App\Http\Controllers\Vendor\VendorSettingController')->cancel_max_order();
    // app('App\Http\Controllers\DriverApiController')->cancel_max_order();
    $orders = Order::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
    foreach ($orders as $order) {
      if ($order->delivery_person_id != null) {
        $delivery_person = DeliveryPerson::find($order->delivery_person_id);
        $order->delivery_person = [
          'name' => $delivery_person->first_name . ' ' . $delivery_person->last_name,
          'image' => $delivery_person->image,
          'contact' => $delivery_person->contact,
        ];
      }
    }
    \Log::info("apiShowOrder()");
    \Log::info(response(['success' => true, 'data' => $orders]));
    //  return;
    return response(['success' => true, 'data' => $orders]);
  }

  public function apiVendor(Request $request)
  {
    return Vendor::get();
    $vendors = Vendor::where('status', 1)->orderBy('id', 'DESC')->get(['id', 'image', 'name', 'lat', 'lang', 'cuisine_id', 'vendor_type'])->makeHidden(['vendor_logo']);
    foreach ($vendors as $vendor) {
      $lat1 = $vendor->lat;
      $lon1 = $vendor->lang;
      $lat2 = $request->lat;
      $lon2 = $request->lang;
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
      if (auth('api')->user() != null) {
        $user = auth('api')->user();
        $vendor['like'] = in_array($vendor->id, explode(',', $user->faviroute));
      } else {
        $vendor['like'] = false;
      }
    }
    return response(['success' => true, 'data' => $vendors]);
  }

  public function apiCheckOtp(Request $request)
  {
    $request->validate([
      'user_id' => 'bail|required',
      'otp' => 'bail|required|min:4',
      'where' => 'bail|required',
    ]);
    $user = User::find($request->user_id);
    if ($user) {
      if ($user->otp == $request->otp) {
        if ($request->where == 'register') {
          $user->is_verified = 1;
          $user->save();
          $user['token'] = $user->createToken('mealUp')->accessToken;
          return response(['success' => true, 'data' => $user, 'msg' => 'SuccessFully verify your account...!!']);
        } else {
          return response(['success' => true, 'data' => $user->id, 'msg' => 'SuccessFully verify your account...!!']);
        }
      } else {
        return response(['success' => false, 'msg' => 'Something went wrong otp does not match..!']);
      }
    } else {
      return response(['success' => false, 'msg' => 'Oops...user not found..!!']);
    }
  }

  public function apiUpdateUser(Request $request)
  {
    $data = $request->all();
    $request->validate([
      'name' => 'bail|required',
    ]);
    $id = auth()->user();
    $id->update($data);
    return response(['success' => true, 'data' => 'Update Successfully']);
  }

  public function apiUpdateImage(Request $request)
  {
    $request->validate([
      'image' => 'required',
    ]);
    $id = auth()->user();
    if (isset($request->image)) {
      $img = $request->image;
      $img = str_replace('data:image/png;base64,', '', $img);
      $img = str_replace(' ', '+', $img);
      $data1 = base64_decode($img);
      $Iname = uniqid();
      $file = public_path('/images/upload/') . $Iname . ".png";
      $success = file_put_contents($file, $data1);
      $data['image'] = $Iname . ".png";
    }
    $id->update($data);
    return response(['success' => true, 'data' => 'image updated succssfully..!!']);
  }

  public function apiRestFaviroute(Request $request)
  {
    $user = auth()->user();
    $faviroute = explode(',', $user->faviroute);
    $vendors = Vendor::where('status', 1)->whereIn('id', $faviroute)->get(['id', 'name', 'image', 'lat', 'lang', 'cuisine_id', 'vendor_type'])->makeHidden(['vendor_logo']);
    foreach ($vendors as $vendor) {
      $lat1 = $vendor->lat;
      $lon1 = $vendor->lang;
      $lat2 = $request->lat;
      $lon2 = $request->lang;
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
    return response(['success' => true, 'data' => $vendors]);
  }

  public function apiFilter(Request $request)
  {
    $result = Vendor::where('status', 1);
    $v = [];
    if (isset($request->cousins)) {
      $vendors = Vendor::where('status', 1)->get();
      foreach ($vendors as $vendor) {
        $cuisineId = explode(',', $vendor->cuisine_id);
        if (($key = array_search($request->cousins, $cuisineId)) !== false) {
          array_push($v, $vendor->id);
        }
      }
      $result = $result->whereIn('id', $v);
    }

    if (isset($request->quick_filter)) {
      $result = $result->where('vendor_type', $request->quick_filter);
    }

    $data = $result->get(['id', 'name', 'image', 'lat', 'lang', 'cuisine_id', 'vendor_type'])->makeHidden(['vendor_logo']);

    if (isset($request->sorting)) {
      if ($request->sorting == 'high_to_low') {
        $data = $data->sortByDesc('rate')->values()->all();
      }
      if ($request->sorting == 'low_to_high') {
        $data = $data->sortBy('rate')->values()->all();
      }
    }

    foreach ($data as $vendor) {
      $lat1 = $vendor->lat;
      $lon1 = $vendor->lang;
      $lat2 = $request->lat;
      $lon2 = $request->lang;
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
      if (auth('api')->user() != null) {
        $user = auth('api')->user();
        $vendor['like'] = in_array($vendor->id, explode(',', $user->faviroute));
      } else {
        $vendor['like'] = false;
      }
    }
    return response(['success' => true, 'data' => $data]);
  }

  public function apiSingleOrder($id)
  {
    $order = Order::where('id', $id)->first(['id', 'order_id', 'vendor_id', 'amount', 'delivery_person_id', 'order_status', 'address_id', 'promocode_id', 'promocode_price', 'user_id', 'vendor_discount_price', 'delivery_charge']);
    $tax = 0;
    foreach (json_decode(Order::find($id)->tax) as $t) {
      $tax += $t->tax;
    }
    $order->tax = $tax;
    if ($order->delivery_person_id != null) {
      $order['delivery_person'] = DeliveryPerson::where('id', $order->delivery_person_id)->first(['first_name', 'last_name', 'image']);
    }
    return response(['success' => true, 'data' => $order]);
  }

  public function apiCuisineVendor($id)
  {
    $v = Vendor::where('status', 1)->get(['id', 'image', 'name', 'lat', 'lang', 'cuisine_id', 'vendor_type'])->makeHidden(['vendor_logo']);
    $vendors = array();
    foreach ($v as $vendor) {
      $cuisines = explode(',', $vendor->cuisine_id);
      if (($key = array_search($id, $cuisines)) !== false) {
        array_push($vendors, $vendor);
      }
    }
    return response(['success' => true, 'data' => $vendors]);
  }

  public function apiSearch(Request $request)
  {
    $data = $request->all();
    $req = [];
    $radius = GeneralSetting::first()->radius;
    $req['vendor'] = Vendor::where('status', 1)->get(['id', 'image', 'name', 'lat', 'lang', 'cuisine_id', 'vendor_type'])->makeHidden(['vendor_logo']);
    // $req['vendor'] = Vendor::where('status', 1)->GetByDistance($request->lat, $request->lang, $radius)->get(['id', 'image', 'name', 'lat', 'lang', 'cuisine_id', 'vendor_type'])->makeHidden(['vendor_logo']);
    // $req['vendor'] = Vendor::where('name','LIKE','%'.$data['name']."%")->GetByDistance($request->lat, $request->lang, $radius)->get(['id','image','name','lat','lang','cuisine_id','vendor_type']);
    $req['cuisine'] = Cuisine::where('name', 'LIKE', '%' . $data['name'] . "%")->get(['id', 'name', 'image']);
    return response(['success' => true, 'data' => $req]);
  }

  public function apiTracking($order_id)
  {
    $order = Order::find($order_id);
    $temp['user_lat'] = UserAddress::find($order->address_id)->lat;
    $temp['user_lang'] = UserAddress::find($order->address_id)->lang;
    $temp['vendor_lat'] = Vendor::find($order->vendor_id)->lat;
    $temp['vendor_lang'] = Vendor::find($order->vendor_id)->lang;
    $temp['driver_lat'] = DeliveryPerson::find($order->delivery_person_id)->lat;
    $temp['driver_lang'] = DeliveryPerson::find($order->delivery_person_id)->lang;
    $data = $temp;
    return response(['success' => true, 'data' => $data]);
  }

  public function apiAddReview(Request $request)
  {
    $request->validate([
      'rate' => 'required',
      'comment' => 'required',
      'order_id' => 'required',
    ]);
    $data = $request->all();
    if (Review::where([['order_id', $data['order_id'], ['user_id', auth()->user()->id]]])->exists() != true) {
      $data['user_id'] = auth()->user()->id;
      $data['contact'] = auth()->user()->phone;
      $data['vendor_id'] = Order::find($data['order_id'])->vendor_id;
      $d_image = [];
      if (isset($data['image'])) {
        if (count($data['image']) <= 3) {
          foreach ($data['image'] as $image) {
            $img = $image;
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data1 = base64_decode($img);
            $Iname = uniqid();
            $file = public_path('/images/upload/') . $Iname . ".png";
            $success = file_put_contents($file, $data1);
            array_push($d_image, $Iname . ".png");
          }
          $data['image'] = json_encode($d_image);
        } else {
          return response(['success' => false, 'data' => 'only three image can upload']);
        }
      }
      $review = Review::create($data);
      return response(['success' => true, 'data' => "thanks for this review"]);
    } else {
      return response(['success' => false, 'data' => 'Review already addedd...!!']);
    }
  }

  public function apiAddFeedback(Request $request)
  {
    $request->validate([
      'rate' => 'required',
      'comment' => 'required',
    ]);
    $data = $request->all();
    $data['user_id'] = auth()->user()->id;
    $data['contact'] = auth()->user()->phone;
    $d_image = [];
    if (isset($data['image'])) {
      if (count($data['image']) <= 3) {
        foreach ($data['image'] as $image) {
          $img = $image;
          $img = str_replace('data:image/png;base64,', '', $img);
          $img = str_replace(' ', '+', $img);
          $data1 = base64_decode($img);
          $Iname = uniqid();
          $file = public_path('/images/upload/') . $Iname . ".png";
          $success = file_put_contents($file, $data1);
          array_push($d_image, $Iname . ".png");
        }
        $data['image'] = json_encode($d_image);
      } else {
        return response(['success' => false, 'data' => 'only three image can upload']);
      }
    }
    Feedback::create($data);
    return response(['success' => true, 'data' => "thanks for your feedback"]);
  }

  public function FlutterWavepayment($order_id)
  {
    $order = Order::find($order_id);
    return view('flutterPaymentTest', compact('order'));
  }

  public function transction_verify(Request $request, $order_id)
  {
    $order = Order::find($order_id);
    $id = $request->input('transaction_id');
    if ($request->input('status') == 'successful') {
      $order->payment_token = $id;
      $order->payment_status = 1;
      $order->save();
      return view('transction_verify');
    } else {
      return view('cancel');
    }
  }

  public function apiUserOrderStatus()
  {
    $user = User::find(auth()->user()->id);
    // $order = Order::where('user_id',$user)->where('order_status','!=','COMPLETE')->where('order_status','!=','CANCEL')->get(['order_status','id'])->makeHidden(['vendor','user','orderItems','user_address']);
    $order = Order::where('user_id', $user->id)->where([['order_status', '!=', 'COMPLETE'], ['order_status', '!=', 'PENDING'], ['order_status', '!=', 'CANCEL']])->get(['order_status', 'id'])->makeHidden(['vendor', 'user', 'orderItems', 'user_address']);
    return response(['data' => $order, 'success' => true]);
  }

  public function apiRefund(Request $request)
  {
    $request->validate([
      'order_id' => 'required',
      'refund_reason' => 'required',
    ]);
    $data = $request->all();
    if (Refund::where([['order_id', $data['order_id'], ['user_id', auth()->user()->id]]])->exists() != true) {
      $data['user_id'] = auth()->user()->id;
      $data['refund_status'] = 'PENDING';
      Refund::create($data);
      return response(['success' => true, 'data' => 'refund request generated successfully waiting for admin confirmation']);
    } else {
      return response(['success' => false, 'data' => 'refund request already generated..!!']);
    }
  }

  public function apiBankDetails(Request $request)
  {
    $request->validate([
      'account_number' => 'required',
      'micr_code' => 'required',
      'account_name' => 'required',
      'ifsc_code' => 'required',
    ]);
    $data = $request->all();
    $user = User::find(auth()->user()->id)->update($data);
    return response(['success' => true, 'data' => 'details update successfully..!!']);
  }

  public function sendNotification($user)
  {
    $admin_verify_user = GeneralSetting::find(1)->verification;
    $sms_verification = GeneralSetting::first()->verification_phone;
    $mail_verification = GeneralSetting::first()->verification_email;
    $verification_content = NotificationTemplate::where('title', 'verification')->first();
    if ($admin_verify_user == 1) {
      $otp = mt_rand(1000, 9999);
      // $otp = 0000;
      if ($user->language == 'spanish') {
        $msg_content = $verification_content->spanish_notification_content;
        $mail_content = $verification_content->spanish_mail_content;

        $sid = GeneralSetting::first()->twilio_acc_id;
        $token = GeneralSetting::first()->twilio_auth_token;

        $detail['otp'] = $otp;
        $detail['user_name'] = $user->name;
        $detail['app_name'] = GeneralSetting::first()->business_name;
        $data = ["{otp}", "{user_name}", "{app_name}"];

        $user->otp = $otp;
        $user->save();
        if ($mail_verification == 1) {
          $message1 = str_replace($data, $detail, $mail_content);
          try {
            Mail::to($user->email_id)->send(new Verification($message1));
          } catch (\Throwable $th) {
            Log::error($th);
          }
        }
        if ($sms_verification == 1) {
          try {
            $phone = $user->phone_code . $user->phone;
            $message1 = str_replace($data, $detail, $msg_content);
            $client = new Client($sid, $token);
            $client->messages->create(
              $phone,
              array(
                'from' => GeneralSetting::first()->twilio_phone_no,
                'body' => $message1
              )
            );
          } catch (\Throwable $th) {
            Log::error($th);
          }
        }
      } else {
        $msg_content = $verification_content->notification_content;
        $mail_content = $verification_content->mail_content;

        $sid = GeneralSetting::first()->twilio_acc_id;
        $token = GeneralSetting::first()->twilio_auth_token;

        $detail['otp'] = $otp;
        $detail['user_name'] = $user->name;
        $detail['app_name'] = GeneralSetting::first()->business_name;
        $data = ["{otp}", "{user_name}"];

        $user->otp = $otp;
        $user->save();
        if ($mail_verification == 1) {
          $message1 = str_replace($data, $detail, $mail_content);
          try {
            Mail::to($user->email_id)->send(new Verification($message1));
          } catch (\Throwable $th) {
            Log::error($th);
          }
        }
        if ($sms_verification == 1) {
          try {
            $phone = $user->phone_code . $user->phone;
            $message1 = str_replace($data, $detail, $msg_content);
            $client = new Client($sid, $token);
            $client->messages->create(
              $phone,
              array(
                'from' => GeneralSetting::first()->twilio_phone_no,
                'body' => $message1
              )
            );
          } catch (\Throwable $th) {
            Log::error($th);
          }
        }
      }
    }
  }

  public function apiUserBalance()
  {
    $user = auth()->user();
    $transactions = Transaction::where('payable_id', $user->id)->orderBy('id', 'DESC')->get()->makeHidden(['updated_at', 'payable_type', 'wallet_id', 'confirmed', 'meta', 'uuid']);
    foreach ($transactions as $transaction) {
      $transaction->payment_details = WalletPayment::where('transaction_id', $transaction->id)->first();
      $transaction->date = Carbon::parse($transaction->created_at)->format('Y-m-d');
      $transaction->amount = abs($transaction->amount);
      if ($transaction->type == 'withdraw') {
        $transaction->order = Order::find($transaction->meta[0], ['id', 'vendor_id', 'order_id'])->makeHidden(['user_address', 'orderItems', 'user', 'vendor']);
        $transaction->vendor_name = vendor::find($transaction->order->vendor_id)->name;
      }
    }
    return response(['success' => true, 'data' => $transactions]);
  }

  public function apiWalletBalance()
  {
    return response(['success' => true, 'data' => auth()->user()->balance]);
  }

  public function apiUserAddBalance(Request $request)
  {
    $request->validate([
      'amount' => 'bail|required|numeric',
      'payment_type' => 'bail|required',
      'payment_token' => 'bail|required',
    ]);
    $data = $request->all();
    $user = auth()->user();
    $deposit = $user->deposit($data['amount']);
    $transction = array();
    $transction['transaction_id'] = $deposit->id;
    $transction['payment_type'] = strtoupper($request->payment_type);
    $transction['payment_token'] = $request->payment_token;
    $transction['added_by'] = 'user';
    WalletPayment::create($transction);
    return response(['success' => true, 'data' => 'balance added']);
  }

  public function ForgotPassword($user)
  {
    $verification_content = NotificationTemplate::where('title', 'verification')->first();
    $otp = mt_rand(1000, 9999);
    $user->otp = $otp;
    $user->save();
    if ($user->language == 'spanish') {
      $msg_content = $verification_content->spanish_notification_content;
      $mail_content = $verification_content->spanish_mail_content;

      $sid = GeneralSetting::first()->twilio_acc_id;
      $token = GeneralSetting::first()->twilio_auth_token;
      $detail['otp'] = $otp;
      $detail['user_name'] = $user->name;
      $detail['app_name'] = GeneralSetting::first()->business_name;
      $data = ["{otp}", "{user_name}", "{app_name}"];

      $message1 = str_replace($data, $detail, $mail_content);
      // try {
      Mail::to($user->email_id)->send(new Verification($message1));
      // } catch (\Throwable $th) {
      //     //throw $th;
      // }
    } else {
      $mail_content = $verification_content->mail_content;
      $detail['otp'] = $otp;
      $detail['user_name'] = $user->name;
      $detail['app_name'] = GeneralSetting::first()->business_name;
      $data = ["{otp}", "{user_name}", "{app_name}"];
      $message1 = str_replace($data, $detail, $mail_content);
      try {
        Mail::to($user->email_id)->send(new Verification($message1));
      } catch (\Throwable $th) {
        //throw $th;
      }
    }
  }
}
