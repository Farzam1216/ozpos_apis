<?php
   
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Route;
   
   /*
   |--------------------------------------------------------------------------
   | API Routes
   |--------------------------------------------------------------------------
   |
   | Here is where you can register API routes for your application. These
   | routes are loaded by the RouteServiceProvider within a group which
   | is assigned the "api" middleware group. Enjoy building your API!
   |
   */
   
   Route::middleware('auth:api')->get('/user', function (Request $request) {
      return $request->user();
   });
   
   Route::group(['middleware' => ['cors']], function ($router) {
      
      
      /******  Vendor ********/
      Route::post('vendor/login', 'VendorApiController@apiLogin');
      Route::post('vendor/register', 'VendorApiController@apiRegister');
      Route::post('vendor/check_otp', 'VendorApiController@apiCheckOtp');
      Route::post('vendor/resend_otp', 'VendorApiController@apiResendOtp');
      Route::post('vendor/forgot_password', 'VendorApiController@apiForgotPassword');
      Route::post('user_login', 'UserApiController@apiUserLogin');
      Route::post('user_register', 'UserApiController@apiUserRegister');
      Route::post('check_otp', 'UserApiController@apiCheckOtp');
      Route::get('vendor/vendor_setting', 'VendorApiController@apiVendorSetting');
      // Test Api
      //  Route::get('vendor/menuCategory','Api\Vendor\MenuModule\MenuCategoryController@menuCategory');
      
      Route::middleware('auth:api')->prefix('vendor')->group(function () {
         
         Route::get('status', [App\Http\Controllers\Api\Vendor\VendorSettingApiController::class, 'status_get']);
         Route::post('status', [App\Http\Controllers\Api\Vendor\VendorSettingApiController::class, 'status_update']);
         
         Route::get('addon', [App\Http\Controllers\Api\Vendor\MenuModule\AddonController::class, 'indexAll']);
         
         Route::resources([
            //////////             Menu Module                //////////
             'item_category' => Api\Vendor\MenuModule\ItemCategoryController::class,
             'item_size' => Api\Vendor\MenuModule\ItemSizeController::class,
             'addon_category' => Api\Vendor\MenuModule\AddonCategoryController::class,
             'addon_category/{addon_category_id}/addon' => Api\Vendor\MenuModule\AddonController::class,
             'menu' => Api\Vendor\MenuModule\MenuController::class,
             'menu/{menu_id}/menu_size' => Api\Vendor\MenuModule\MenuSizeController::class,
             'menu/{menu_id}/menu_addon' => Api\Vendor\MenuModule\MenuAddonController::class,
             'menu/{menu_id}/menu_size/{menu_size_id}/menu_addon' => Api\Vendor\MenuModule\MenuSizeAddonController::class,
             
             'menu_category' => Api\Vendor\MenuModule\MenuCategoryController::class,
             'menu_category/{menu_category_id}/single_menu' => Api\Vendor\MenuModule\SingleMenuController::class,
             'menu_category/{menu_category_id}/half_n_half_menu' => Api\Vendor\MenuModule\HalfNHalfMenuController::class,
             'menu_category/{menu_category_id}/deals_menu' => Api\Vendor\MenuModule\DealsMenuController::class,
             'menu_category/{menu_category_id}/deals_menu/{deals_menu_id}/deals_items' => Api\Vendor\MenuModule\DealsItemsController::class,
         ]);
//      Route::resource('addon/{addon_category_id}', 'Api\Vendor\MenuModule\AddonController')->parameters([
//          '{addon_category_id}' => 'addon_id'
//      ]);
         
         /* ---- Vendor ---- */
         ///////// Add Menu Category /////////
         // Route::post('menuCategory/store',MenuCategoryApiController::class, 'store');
         // Route::edit('menuCategory/{menuCategory_id}/edit',MenuCategoryApiController::class, 'edit');
         // Route::put('menuCategory/{menuCategory_id}/update',MenuCategoryApiController::class, 'store');
         
         // driver
         Route::get('drivers', 'VendorApiController@apiDrivers');
         Route::get('drivers_clearance', 'VendorApiController@apiDriversClearance');
         Route::post('driver_get', 'VendorApiController@apiDriverGet');
         Route::post('driver_assign', 'VendorApiController@apiDriverAssign');
         Route::post('driver_clearance', 'VendorApiController@apiDriverClearance');
         Route::get('driver_clearance_orders/{driver_id}', 'VendorApiController@apiDriverClearanceOrders');
         
         
         //Menu
         Route::get('menu', 'VendorApiController@apiMenu');
         Route::post('create_menu', 'VendorApiController@apiCreateMenu');
         Route::get('edit_menu/{menu_id}', 'VendorApiController@apiEditMenu');
         Route::post('update_menu/{menu_id}', 'VendorApiController@apiUpdateMenu');
         Route::get('single_menu/{menu_id}', 'VendorApiController@apiSingleMenu');
         
         
         //Submenu
         Route::get('submenu/{menu_id}', 'VendorApiController@apiSubmenu');
         Route::post('create_submenu', 'VendorApiController@apiCreateSubmenu');
         Route::get('edit_submenu/{submenu_id}', 'VendorApiController@apiEditSubmenu');
         Route::post('update_submenu/{submenu_id}', 'VendorApiController@apiUpdateSubmenu');
         Route::get('single_submenu/{submenu_id}', 'VendorApiController@apiSingleSubmenu');
         
         //Custimization
         Route::get('custimization/{submenu_id}', 'VendorApiController@apiCustimization');
         Route::post('create_custimization', 'VendorApiController@apiCreateCustimization');
         Route::post('edit_custimization', 'VendorApiController@apiEditCustimization');
         Route::post('update_custimization', 'VendorApiController@apiUpdateCustimization');
         Route::post('delete_custimization', 'VendorApiController@apiDeleteCustimization');
         
         //Delivery timeslot
         Route::get('edit_deliveryTimeslot', 'VendorApiController@apiEditDeliveryTimeslot');
         Route::post('update_deliveryTimeslot', 'VendorApiController@apiUpdateDeliveryTimeslot');
         
         //Pickup timeslot
         Route::get('edit_PickUpTimeslot', 'VendorApiController@apiEditPickUpTimeslot');
         Route::post('update_PickUpTimeslot', 'VendorApiController@apiUpdatePickUpTimeslot');
         
         //Selling timeslot
         Route::get('edit_SellingTimeslot', 'VendorApiController@apiEditSellingTimeslot');
         Route::post('update_SellingTimeslot', 'VendorApiController@apiUpdateSellingTimeslot');
         
         //Discount
         Route::get('discount', 'VendorApiController@apiDiscount');
         Route::post('create_discount', 'VendorApiController@apiCreateDiscount');
         Route::get('edit_discount/{discount_id}', 'VendorApiController@apiEditDiscount');
         Route::post('update_discount/{discount_id}', 'VendorApiController@apiUpdateDiscount');
         
         //Bank Details
         Route::get('show_bank_detail', 'VendorApiController@apiShowBankDetails');
         Route::post('add_bank_detail', 'VendorApiController@apiAddBankDetails');
         Route::get('edit_bank_detail', 'VendorApiController@apiEditBankDetails');
         Route::post('update_bank_detail', 'VendorApiController@apiUpdateBankDetails');
         
         //Finance Details
         Route::get('last_7_days', 'VendorApiController@apiLast7Days');
         Route::get('current_month', 'VendorApiController@apiCurrentMonth');
         Route::post('specific_month', 'VendorApiController@apiMonth');
         Route::get('finance_details', 'VendorApiController@apiFinanceDetails');
         Route::get('cash_balance', 'VendorApiController@apiCashBalance');
         Route::get('insights', 'VendorApiController@apiInsights');
         
         //Order
         Route::get('order/{order_status}', 'VendorApiController@apiOrder');
         Route::post('create_order', 'VendorApiController@apiCreateOrder');
         
         // change status
         Route::post('change_status', 'VendorApiController@apiChangeStatus');
         
         //user
         Route::get('user', 'VendorApiController@apiUser');
         Route::post('create_user', 'VendorApiController@apiCreateUser');
         
         //User Address
         Route::get('user_address/{user_id}', 'VendorApiController@apiUserAddress');
         Route::post('create_user_address', 'VendorApiController@apiCreateUserAddress');
         
         /* ---- User Password ---- */
         Route::post('change_password', 'VendorApiController@apiChangePassword');
         Route::post('forgot_password', 'VendorApiController@apiChangePassword');
         
         // Faq
         Route::get('faq', 'VendorApiController@apiFaq');
         
         Route::get('vendor_login', 'VendorApiController@apiVendorLogin');
         Route::post('update_profile', 'VendorApiController@apiUpdateProfile');
         
      });
      
      /******  User ********/
      Route::middleware('auth:api')->group(function () {
         Route::get('order_setting/{vendor_id}', 'UserApiController@apiOrderSetting');
         Route::get('vendor_status/{vendor_id}', 'UserApiController@apiVendorStatus');
         Route::post('book_order', 'UserApiController@apiBookOrder');
         Route::get('show_order', 'UserApiController@apiShowOrder');
         Route::post('update_user', 'UserApiController@apiUpdateUser');
         Route::post('update_image', 'UserApiController@apiUpdateImage');
         Route::post('rest_faviroute', 'UserApiController@apiRestFaviroute');
         Route::post('cancel_order', 'UserApiController@apiCancelOrder');
         Route::get('single_order/{order_id}', 'UserApiController@apiSingleOrder');
         Route::post('apply_promo_code', 'UserApiController@apiApplyPromoCode');
         Route::post('add_review', 'UserApiController@apiAddReview');
         Route::post('add_feedback', 'UserApiController@apiAddFeedback');
         Route::get('user_order_status', 'UserApiController@apiUserOrderStatus');
         Route::post('refund', 'UserApiController@apirefund');
         Route::post('bank_details', 'UserApiController@apiBankDetails');
         Route::get('tracking/{order_id}', 'UserApiController@apiTracking');
         Route::get('user_balance', 'UserApiController@apiUserBalance');
         Route::get('wallet_balance', 'UserApiController@apiWalletBalance');
         Route::post('add_balance', 'UserApiController@apiUserAddBalance');
         Route::post('user_change_password', 'UserApiController@apiChangePassword');
         
         
         //////////////////////////////////////////////       General      //////////////////////////////////////////////
         
         
         //////////////////////////////////////////////      Address     //////////////////////////////////////////////
         Route::get('is_address_selected', [App\Http\Controllers\Api\User\AddressController::class, 'getIsAddressSelected']);
         Route::get('user_address', [App\Http\Controllers\Api\User\AddressController::class, 'getAddress']);
         Route::post('add_address', [App\Http\Controllers\Api\User\AddressController::class, 'addAddress']);
         Route::get('edit_address/{address_id}', [App\Http\Controllers\Api\User\AddressController::class, 'editAddress']);
         Route::post('update_address/{address_id}', [App\Http\Controllers\Api\User\AddressController::class, 'updateAddress']);
         Route::get('remove_address/{address_id}', [App\Http\Controllers\Api\User\AddressController::class, 'removeAddress']);
         Route::get('pick_address/{address_id}', [App\Http\Controllers\Api\User\AddressController::class, 'pickAddress']);
         
         
         //////////////////////////////////////////////        Home       //////////////////////////////////////////////
         Route::get('near_by', [App\Http\Controllers\Api\User\HomeController::class, 'getNearBy']);
         Route::get('banner', [App\Http\Controllers\Api\User\HomeController::class, 'apiBanner']);
         Route::get('top_rest', [App\Http\Controllers\Api\User\HomeController::class, 'apiTopRest']);
         Route::get('veg_rest', [App\Http\Controllers\Api\User\HomeController::class, 'apiVegRest']);
         Route::get('nonveg_rest', [App\Http\Controllers\Api\User\HomeController::class, 'apiNonVegRest']);
         Route::get('explore_rest', [App\Http\Controllers\Api\User\HomeController::class, 'apiExploreRest']);
         Route::post('faviroute', [App\Http\Controllers\Api\User\HomeController::class, 'apiFavorite']);
         
         
         //////////////////////////////////////////////  Vednor    //////////////////////////////////////////////
         Route::get('slider/{vendor_id}', [App\Http\Controllers\Api\User\VendorController::class, 'apiSlider']);
         Route::get('single/{vendor_id}', [App\Http\Controllers\Api\User\VendorController::class, 'apiSingleMenu']);
         Route::get('deals/{vendor_id}', [App\Http\Controllers\Api\User\VendorController::class, 'apiDealsMenu']);
         Route::get('half_n_half/{vendor_id}', [App\Http\Controllers\Api\User\VendorController::class, 'apiHalfnhalfMenu']);
         Route::get('in_range/{vendor_id}', [App\Http\Controllers\Api\User\VendorController::class, 'apiInRange']);
         
      });
      
      
      Route::get('tax', 'UserApiController@apiTax');
      Route::post('user_forgot_password', 'UserApiController@apiForgotPassword');
      Route::post('send_otp', 'UserApiController@apiSendOtp');
      Route::post('filter', 'UserApiController@apiFilter');
      Route::get('cuisine_vendor/{id}', 'UserApiController@apiCuisineVendor');
      Route::post('search', 'UserApiController@apiSearch');
      Route::get('menu_category/{vendor_id}', 'UserApiController@apiMenuCategory');
      Route::get('cuisine', 'UserApiController@apiCuisine');
      Route::post('vendor', 'UserApiController@apiVendor');
      Route::get('single_vendor/{vendor_id}', 'UserApiController@apiSingleVendor');
      Route::get('simple_vendor/{vendor_id}', 'UserApiController@apiSimpleVendor');
      Route::get('item_categories_vendor/{vendor_id}', 'UserApiController@apiItemCategoriesVendor');
      Route::get('single_vendor_retrieve_sizes/{vendor_id}/{half_n_half_menu_id}', 'UserApiController@apiSingleVendorRetrieveSizes');
      Route::get('single_vendor_retrieve_size/{vendor_id}/{item_category_id}/{item_size_id}', 'UserApiController@apiSingleVendorRetrieveSize');
      Route::get('menu/{vendor_id}', 'UserApiController@apiMenu');
      Route::get('promo_code/{vendor_id}', 'UserApiController@apiPromoCode');
      Route::get('faq', 'UserApiController@apiFaq');
      Route::get('single_menu/{menu_id}', 'UserApiController@apiSingleMenu');
      Route::get('setting', 'UserApiController@apiSetting');
      Route::get('payment_setting', 'UserApiController@apiPaymentSetting');
      
      /******  Driver ********/
      Route::post('driver/driver_login', 'DriverApiController@apiDriverLogin');
      Route::post('driver/driver_check_otp', 'DriverApiController@apiDriverCheckOtp');
      Route::post('driver/driver_register', 'DriverApiController@apiDriverRegister');
      Route::post('driver/driver_change_password', 'DriverApiController@apiDriverChangePassword');
      Route::post('driver/driver_resendOtp', 'DriverApiController@apiReSendOtp');
      Route::get('driver/driver_faq', 'DriverApiController@apiDriverFaq');
      Route::get('driver/driver_setting', 'DriverApiController@apiDriverSetting');
      
      Route::post('driver/forgot_password_otp', 'DriverApiController@apiForgotPasswordOtp');
      Route::post('driver/forgot_password_check_otp', 'DriverApiController@apiForgotPasswordCheckOtp');
      Route::post('driver/forgot_password', 'DriverApiController@apiForgotPassword');
      
      Route::middleware('auth:driverApi')->prefix('driver')->group(function () {
         Route::post('set_location', 'DriverApiController@apiSetLocation');
         Route::get('driver_order', 'DriverApiController@apiDriverOrder');
         Route::post('status_change', 'DriverApiController@apiStatusChange');
         Route::get('driver', 'DriverApiController@apiDriver');
         
         Route::post('update_driver', 'DriverApiController@apiUpdateDriver');
         Route::post('update_driver_image', 'DriverApiController@apiDriverImage');
         Route::get('order_history', 'DriverApiController@apiOrderHistory');
         Route::get('order_earning', 'DriverApiController@apiOrderEarning');
         Route::get('earning', 'DriverApiController@apiEarningHistory');
         
         Route::post('update_document', 'DriverApiController@apiUpdateVehical');
         Route::get('notification', 'DriverApiController@apiDriverNotification');
         Route::post('update_lat_lang', 'DriverApiController@apiUpdateLatLang');
         Route::post('delivery_person_change_password', 'DriverApiController@apiDeliveryPersonChangePassword');
         
         Route::get('delivery_zone', 'DriverApiController@apiDeliveryZone');
         Route::get('payment_pending', 'DriverApiController@apiPaymentPending');
      });
      
      
   });