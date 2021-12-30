<?php
   
   namespace App\Http\Controllers\Customer;
   
   use App\Http\Controllers\Controller;
   use App\Models\DealsItems;
   use App\Models\DealsMenu;
   use App\Models\DeliveryPerson;
   use App\Models\HalfNHalfMenu;
   use App\Models\ItemSize;
   use App\Models\Menu;
   use App\Models\MenuSize;
   use App\Models\Order;
   use App\Models\SingleMenu;
   use App\Models\UserAddress;
   use App\Models\Vendor;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Auth;
   
   class OrderController extends Controller
   {
      
      public function orderHistory()
      {
         app('App\Http\Controllers\Vendor\VendorSettingController')->cancel_max_order();
         // app('App\Http\Controllers\DriverApiController')->cancel_max_order();
         $pendingOrders = Order::where('user_id', auth()->user()->id)
             ->where(function ($q) {
                $q->where('order_status', 'PENDING')
                    ->orWhere('order_status', 'APPROVE')
                    ->orWhere('order_status', 'ACCEPT')
                    ->orWhere('order_status', 'PICKUP')
                    ->orWhere('order_status', 'DELIVERED')
                    ->orWhere('order_status', 'READY TO PICKUP')
                    ->orWhere('order_status', 'PREPARING FOOD')
                    ->orWhere('order_status', 'REJECT');
             })->orderBy('id', 'DESC')->get();
         // dd($pendingOrders);
         
         $cancelOrders = Order::where('user_id', auth()->user()->id)
             ->where('order_status', 'CANCEL')->orderBy('id', 'DESC')->get();
         $completeOrders = Order::where('user_id', auth()->user()->id)
             ->where('order_status', 'COMPLETE')->orderBy('id', 'DESC')->get();
         // foreach ($orders as $order) {
         //    if ($order->delivery_person_id != null) {
         //       $delivery_person = DeliveryPerson::find($order->delivery_person_id);
         //       $order->delivery_person = [
         //           'name' => $delivery_person->first_name . ' ' . $delivery_person->last_name,
         //           'image' => $delivery_person->image,
         //           'contact' => $delivery_person->contact,
         //       ];
         //    }
         // }
         
         $user = Auth::user()->id;
         $userAddress = UserAddress::where('user_id', $user)->get();
         $selectedAddress = UserAddress::where(['user_id' => $user, 'selected' => 1])->first();
         return view('customer.my-order', compact('pendingOrders', 'cancelOrders', 'completeOrders', 'userAddress', 'selectedAddress'));
      }
      
      
      public function getOrderModel($order_id)
      {
         // dd($order_id);
         // app('App\Http\Controllers\Vendor\VendorSettingController')->cancel_max_order();
         // app('App\Http\Controllers\DriverApiController')->cancel_max_order();
         $order = Order::find($order_id);
         
         // if ($order->delivery_person_id != null) {
         //     $delivery_person = DeliveryPerson::find($order->delivery_person_id);
         //     $order->delivery_person = [
         //         'name' => $delivery_person->first_name . ' ' . $delivery_person->last_name,
         //         'image' => $delivery_person->image,
         //         'contact' => $delivery_person->contact,
         //     ];
         // }
         // dd($order->userAddress->address);
         return view('customer.modals.track_Onprocess', compact('order'));
      }
      
      public function singleGetOrderModel($id, $order_id)
      {
         // dd($order_id);
         // app('App\Http\Controllers\Vendor\VendorSettingController')->cancel_max_order();
         // app('App\Http\Controllers\DriverApiController')->cancel_max_order();
         $order = Order::find($order_id);
         
         // if ($order->delivery_person_id != null) {
         //     $delivery_person = DeliveryPerson::find($order->delivery_person_id);
         //     $order->delivery_person = [
         //         'name' => $delivery_person->first_name . ' ' . $delivery_person->last_name,
         //         'image' => $delivery_person->image,
         //         'contact' => $delivery_person->contact,
         //     ];
         // }
         // dd($order->userAddress->address);
         return view('customer.modals.track_Onprocess', compact('order'));
      }
      
      public function getOrder($order_id)
      {
         app('App\Http\Controllers\Vendor\VendorSettingController')->cancel_max_order();
         // app('App\Http\Controllers\DriverApiController')->cancel_max_order();
         $order = Order::find($order_id);
         
         if ($order->delivery_person_id != null) {
            $delivery_person = DeliveryPerson::find($order->delivery_person_id);
            $order->delivery_person = [
                'name' => $delivery_person->first_name . ' ' . $delivery_person->last_name,
                'image' => $delivery_person->image,
                'contact' => $delivery_person->contact,
            ];
         }
         
         return json_encode($order);
      }
      
      public function singleGetOrder($id, $order_id)
      {
         app('App\Http\Controllers\Vendor\VendorSettingController')->cancel_max_order();
         // app('App\Http\Controllers\DriverApiController')->cancel_max_order();
         $order = Order::find($order_id);
         
         if ($order->delivery_person_id != null) {
            $delivery_person = DeliveryPerson::find($order->delivery_person_id);
            $order->delivery_person = [
                'name' => $delivery_person->first_name . ' ' . $delivery_person->last_name,
                'image' => $delivery_person->image,
                'contact' => $delivery_person->contact,
            ];
         }
         
         return json_encode($order);
      }
      
      public function trackOrder($order_id)
      {
         $order = Order::select('id', 'amount', 'vendor_id', 'order_status', 'delivery_person_id', 'delivery_charge', 'date', 'time', 'address_id')->where([['id', $order_id], ['user_id', auth()->user()->id]])->first();
         // dd($order);
         $trackData = array();
         $trackData['userLat'] = UserAddress::find($order->address_id)->lat;
         $trackData['userLang'] = UserAddress::find($order->address_id)->lang;
         $trackData['vendorLat'] = Vendor::find($order->vendor_id)->lat;
         $trackData['vendorLang'] = Vendor::find($order->vendor_id)->lang;
         $trackData['driverLat'] = DeliveryPerson::find($order->delivery_person_id)->lat;
         $trackData['driverLang'] = DeliveryPerson::find($order->delivery_person_id)->lang;
         
         $user = Auth::user()->id;
         $userAddress = UserAddress::where('user_id', $user)->get();
         $selectedAddress = UserAddress::where(['user_id' => $user, 'selected' => 1])->first();
         
         return view('customer/track', compact('order', 'trackData', 'userAddress', 'selectedAddress'));
      }
      
      public function singleTrackOrder($id, $order_id)
      {
         $order = Order::select('id', 'amount', 'vendor_id', 'order_status', 'delivery_person_id', 'delivery_charge', 'date', 'time', 'address_id')->where([['id', $order_id], ['user_id', auth()->user()->id]])->first();
         // dd($order);
         $trackData = array();
         $trackData['userLat'] = UserAddress::find($order->address_id)->lat;
         $trackData['userLang'] = UserAddress::find($order->address_id)->lang;
         $trackData['vendorLat'] = Vendor::find($order->vendor_id)->lat;
         $trackData['vendorLang'] = Vendor::find($order->vendor_id)->lang;
         $trackData['driverLat'] = DeliveryPerson::find($order->delivery_person_id)->lat;
         $trackData['driverLang'] = DeliveryPerson::find($order->delivery_person_id)->lang;
         
         $user = Auth::user()->id;
         $userAddress = UserAddress::where('user_id', $user)->get();
         $selectedAddress = UserAddress::where(['user_id' => $user, 'selected' => 1])->first();
         
         return view('customer/track', compact('order', 'trackData', 'userAddress', 'selectedAddress'));
      }
      
      public function getMenuSizeModel(Request $request)
      {
         // dd($request);
         $unique_id = $request->unique_id;
         $SingleMenu = SingleMenu::find($request->singleMenu_id);
         $rest = Vendor::find($request->vendorId);
         $Menu = $SingleMenu->Menu()->get()->first();
         return view('customer.restaurant.single.modals.sizes', compact('Menu', 'SingleMenu', 'rest', 'unique_id'));
         
      }
      
      public function getMenuAddonModel(Request $request)
      {
         // dd($request->all());
         $unique_id = $request->unique_id;
         $SingleMenu = SingleMenu::find($request->singleMenu_id);
         $rest = Vendor::find($request->vendorId);
         $Menu = $SingleMenu->Menu()->get()->first();
         return view('customer.restaurant.single.modals.addons', compact('Menu', 'SingleMenu', 'rest', 'unique_id'));
         
      }
      
      public function getDealsMenu(Request $request)
      {
         // dd($request->all());
         $unique_id = $request->unique_id;
         $DealsMenu = DealsMenu::find($request->dealsMenu_id);
         $rest = Vendor::find($request->vendorId);
         // dd($DealsMenu);
         // $Menu = $SingleMenu->Menu()->get()->first();
         return view('customer.restaurant.deals.modals.index', compact('DealsMenu', 'rest', 'unique_id'));
         
      }
      
      public function dealsMenuItems(Request $request)
      {
         // dd($request);
         $unique_id = $request->unique_id;
         $DealsItems = DealsItems::where([['deals_menu_id', $request->dealsMenuId], ['vendor_id', $request->vendorId], ['id', $request->dealsItemsId]])->first();
         $rest = Vendor::find($request->vendorId);
         $DealsMenu = DealsMenu::find($request->dealsMenuId);
         // dd($DealsItems);
         //  $Menu = $SingleMenu->Menu()->get()->first();
         return view('customer.restaurant.deals.modals.items', compact('DealsItems', 'DealsMenu', 'rest', 'unique_id'));
         
      }
      
      public function dealsMenuAddon(Request $request)
      {
         // dd($request);
         $DealsItems = DealsItems::find($request->dealsItems_id);
         $rest = Vendor::find($request->vendorId);
         $DealsMenu = DealsMenu::find($request->dealMenu_id);
         $Menu = Menu::find($request->menu_id);
         $MenuSize = MenuSize::find($request->menuSize_id);
         // dd($DealsItems);
         //  $Menu = $SingleMenu->Menu()->get()->first();
         return view('customer.restaurant.deals.modals.addons', compact('DealsItems', 'DealsMenu', 'MenuSize', 'Menu', 'rest'));
         
      }
      
      public function halfNHalfMenu(Request $request)
      {
         // dd($request->all());
         $unique_id = $request->unique_id;
         $rest = Vendor::find($request->vendorId);
         $unique_id = $request->unique_id;
         $HalfNHalfMenu = HalfNHalfMenu::find($request->HalfNHalfMenu_id);
         return view('customer.restaurant.half.modals.index', compact('HalfNHalfMenu', 'rest', 'unique_id'));
         
      }
      
      public function halfMenuSize(Request $request)
      {
         // dd($request->all());
         $unique_id = $request->unique_id;
         $rest = Vendor::find($request->vendorId);
         $ItemSizeId = $request->ItemSizeId;
         $HalfNHalfMenu = HalfNHalfMenu::find($request->HalfNHalfMenuId);
         $ItemSizeObj = ItemSize::where([['id', $ItemSizeId], ['vendor_id', $HalfNHalfMenu->vendor_id]])->get();
         //  dd($HalfNHalfMenu->id);
         return view('customer.restaurant.half.modals.halfNHalfSize', compact('HalfNHalfMenu', 'rest', 'ItemSizeId', 'ItemSizeObj', 'unique_id'));
         
      }
      
      public function halfMenuFirst(Request $request)
      {
         
         
         $prefix = "Single";
         $unique_id = $request->unique_id;
         //  $ItemSize =$request->ItemSizeId;
         $ItemSize = ItemSize::find($request->ItemSizeId);
         // dd($ItemSize);
         $rest = Vendor::find($request->vendorId);
         $HalfNHalfMenu = HalfNHalfMenu::find($request->HalfNHalfMenuId);
         $ItemSizeObj = ItemSize::where([['id', $ItemSize], ['vendor_id', $HalfNHalfMenu->vendor_id]])->get();
         //  dd($HalfNHalfMenu->id);
         return view('customer.restaurant.half.side', compact('HalfNHalfMenu', 'rest', 'prefix', 'ItemSize', 'ItemSizeObj', 'unique_id'));
         
      }
      
      public function halfMenuSecond(Request $request)
      {
         // dd($request);
         
         $prefix = "Second";
         $unique_id = $request->unique_id;
         //  $ItemSize =$request->ItemSizeId;
         $ItemSize = ItemSize::find($request->ItemSizeId);
         //  dd($ItemSize);
         $rest = Vendor::find($request->vendorId);
         $HalfNHalfMenu = HalfNHalfMenu::find($request->HalfNHalfMenuId);
         return view('customer.restaurant.half.side', compact('HalfNHalfMenu', 'rest', 'prefix', 'ItemSize', 'unique_id'));
         
      }
      
      public function halfMenuAddon(Request $request)
      {
         // dd($request);
         $prefix = $request->prefix;
         $ItemSize = $request->ItemSizeId;
         //  dd($ItemSize);
         $MenuSize = MenuSize::where('item_size_id', $ItemSize)->first();
         $Menu = Menu::where('id', $MenuSize->menu_id)->first();
         //dd($Menu);
         $rest = Vendor::find($request->vendorId);
         $HalfNHalfMenu = HalfNHalfMenu::find($request->HalfNHalfMenuId);
         return view('customer.restaurant.half.modals.side', compact('HalfNHalfMenu', 'rest', 'prefix', 'ItemSize', 'Menu', 'MenuSize'));
         
      }
      
      public function itemModal(Request $request)
      {
         
         $Menu = Menu::find($request->MenuId);
         $rest = Vendor::find($request->vendorId);
         $SingleMenu = SingleMenu::find($request->SingleMenuId);
         
         return view('customer.restaurant.half.modals.itemModal', compact('Menu', 'SingleMenu', 'rest'));
         
      }
      
      public function dealMenuModal(Request $request)
      {
         $rest = Vendor::find($request->vendorId);
         $dealsMenu = DealsMenu::find($request->dealsMenu_id);
         return view('customer.restaurant.half.modals.dealMenuModal', compact('dealsMenu', 'rest'));
         
      }
      
      public function halfNHalfMenuModal(Request $request)
      {
         
         
         $rest = Vendor::find($request->vendorId);
         $HalfNHalfMenu = HalfNHalfMenu::find($request->HalfNHalfMenu_id);
         return view('customer.restaurant.half.modals.halfNHalfMenuModal', compact('HalfNHalfMenu', 'rest'));
         
      }
      
   }
