<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOzposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addon', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_vendor_id');
            $table->unsignedBigInteger('addon_category_id')->index('fk_addon_category_id');
            $table->string('name');
            $table->tinyInteger('is_checked')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('addon_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_vendor_id');
            $table->string('name');
            $table->integer('min');
            $table->integer('max');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('banner', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('image');
            $table->tinyInteger('status');
            $table->timestamps();
        });

        Schema::create('country', function (Blueprint $table) {
            $table->integer('id', true);
            $table->char('iso', 2);
            $table->string('name', 80);
            $table->string('nicename', 80);
            $table->char('iso3', 3)->nullable();
            $table->smallInteger('numcode')->nullable();
            $table->integer('phonecode');
        });

        Schema::create('cuisine', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('image');
            $table->tinyInteger('status');
            $table->timestamps();
        });

        Schema::create('currency', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('country', 100)->nullable();
            $table->string('currency', 100)->nullable();
            $table->string('code', 100)->nullable();
            $table->string('symbol', 100)->nullable();
        });

        Schema::create('deals_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_vendor_id');
            $table->unsignedBigInteger('menu_category_id')->index('fk_menu_category_id');
            $table->unsignedBigInteger('item_category_id')->index('fk_item_category_id');
            $table->unsignedBigInteger('item_size_id')->index('fk_item_size_id');
            $table->unsignedBigInteger('deals_menu_id')->index('fk_deals_menu_id');
            $table->string('name');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('deals_menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_vendor_id');
            $table->unsignedBigInteger('menu_category_id')->index('fk_menu_category_id');
            $table->string('name');
            $table->text('image');
            $table->string('description');
            $table->decimal('price', 6);
            $table->decimal('display_price', 6)->nullable();
            $table->decimal('display_discount_price', 6)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('delivery_person', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('otp')->nullable();
            $table->text('lat')->nullable();
            $table->text('lang')->nullable();
            $table->string('image');
            $table->string('first_name');
            $table->string('phone_code', 100);
            $table->tinyInteger('is_online');
            $table->string('last_name');
            $table->tinyInteger('is_verified');
            $table->string('email_id');
            $table->text('password');
            $table->string('contact');
            $table->text('full_address')->nullable();
            $table->text('vehicle_type')->nullable();
            $table->string('vehicle_number')->nullable();
            $table->string('licence_number')->nullable();
            $table->string('national_identity')->nullable();
            $table->string('licence_doc')->nullable();
            $table->unsignedBigInteger('delivery_zone_id')->nullable()->index('fk_delivery_person_delivery_zone_id');
            $table->tinyInteger('status');
            $table->integer('notification')->nullable();
            $table->text('device_token')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable()->index('fk_delivery_person_vendor_id');
            $table->timestamps();
        });

        Schema::create('delivery_zone', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('contact');
            $table->string('admin_name');
            $table->string('email');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

        Schema::create('delivery_zone_area', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name');
            $table->text('vendor_id')->nullable();
            $table->text('location');
            $table->integer('radius');
            $table->text('lat');
            $table->text('lang');
            $table->unsignedBigInteger('delivery_zone_id')->index('fk_delivery_zone_id');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::create('delivery_zone_news', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name');
            $table->bigInteger('vendor_id');
            $table->polygon('coordinates');
            $table->timestamps();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        Schema::create('faq', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('question');
            $table->string('type');
            $table->text('answer');
            $table->timestamps();
        });

        Schema::create('feedback', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedBigInteger('user_id')->index('fk_feedback_user_id');
            $table->integer('rate')->nullable();
            $table->text('comment')->nullable();
            $table->text('image')->nullable();
            $table->string('contact', 100);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::create('general_setting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('cancel_reason')->nullable();
            $table->text('company_white_logo')->nullable();
            $table->text('company_black_logo')->nullable();
            $table->text('favicon')->nullable();
            $table->string('business_name')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('contact')->nullable();
            $table->text('business_address')->nullable();
            $table->string('country')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('timezone')->nullable();
            $table->string('currency')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->string('help_line_no')->nullable();
            $table->string('start_time', 100)->nullable();
            $table->string('end_time', 100)->nullable();
            $table->tinyInteger('business_availability')->nullable();
            $table->text('message')->nullable();
            $table->integer('isItemTax')->nullable();
            $table->string('item_tax')->nullable();
            $table->string('tax_type')->nullable();
            $table->string('vendor_name')->nullable();
            $table->string('driver_name')->nullable();
            $table->tinyInteger('isPickup')->nullable();
            $table->tinyInteger('isSameDayDelivery')->nullable();
            $table->string('vendor_distance')->nullable();
            $table->tinyInteger('customer_notification')->nullable();
            $table->string('customer_app_id')->nullable();
            $table->string('customer_auth_key')->nullable();
            $table->string('customer_api_key')->nullable();
            $table->tinyInteger('driver_notification')->nullable();
            $table->string('driver_app_id')->nullable();
            $table->string('driver_auth_key')->nullable();
            $table->string('driver_api_key')->nullable();
            $table->tinyInteger('vendor_notification')->nullable();
            $table->string('vendor_app_id')->nullable();
            $table->string('vendor_auth_key')->nullable();
            $table->string('vendor_api_key')->nullable();
            $table->text('privacy_policy')->nullable();
            $table->text('terms_and_condition')->nullable();
            $table->text('help')->nullable();
            $table->text('about_us')->nullable();
            $table->string('site_color', 100)->nullable()->comment('#6777EF');
            $table->integer('settlement_days')->nullable();
            $table->integer('is_driver_accept_multipleorder')->nullable();
            $table->integer('driver_accept_multiple_order_count')->nullable();
            $table->integer('driver_assign_km')->nullable();
            $table->text('driver_vehical_type')->nullable();
            $table->text('driver_earning')->nullable();
            $table->text('company_details')->nullable();
            $table->string('twilio_acc_id')->nullable();
            $table->tinyInteger('verification')->nullable();
            $table->tinyInteger('verification_email')->nullable();
            $table->tinyInteger('verification_phone')->nullable();
            $table->string('twilio_auth_token')->nullable();
            $table->string('twilio_phone_no')->nullable();
            $table->string('radius')->nullable();
            $table->integer('driver_auto_refrese')->nullable();
            $table->text('mail_mailer')->nullable();
            $table->text('mail_host')->nullable();
            $table->text('mail_port')->nullable();
            $table->text('mail_username')->nullable();
            $table->text('mail_password')->nullable();
            $table->text('mail_encryption')->nullable();
            $table->text('mail_from_address')->nullable();
            $table->tinyInteger('customer_mail')->nullable();
            $table->tinyInteger('vendor_mail')->nullable();
            $table->tinyInteger('driver_mail')->nullable();
            $table->text('ios_customer_version')->nullable();
            $table->text('ios_vendor_version')->nullable();
            $table->text('ios_driver_version')->nullable();
            $table->text('ios_customer_app_url')->nullable();
            $table->text('ios_vendor_app_url')->nullable();
            $table->text('ios_driver_app_url')->nullable();
            $table->text('android_customer_version')->nullable();
            $table->text('android_vendor_version')->nullable();
            $table->text('android_driver_version')->nullable();
            $table->text('android_customer_app_url')->nullable();
            $table->text('android_vendor_app_url')->nullable();
            $table->text('android_driver_app_url')->nullable();
            $table->text('map_key')->nullable();
            $table->text('license_code')->nullable();
            $table->text('client_name')->nullable();
            $table->tinyInteger('license_verify')->nullable();
            $table->timestamps();
        });

        Schema::create('half_n_half_menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_vendor_id');
            $table->unsignedBigInteger('menu_category_id')->index('fk_menu_category_id');
            $table->unsignedBigInteger('item_category_id')->index('fk_item_category_id');
            $table->string('name');
            $table->text('image');
            $table->string('description');
            $table->tinyInteger('status')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('item_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_vendor_id');
            $table->string('name');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('item_size', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_vendor_id');
            $table->string('name');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('language', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('file');
            $table->string('image');
            $table->string('direction');
            $table->tinyInteger('status');
            $table->timestamps();
        });

        Schema::create('menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_vendor_id');
            $table->string('name');
            $table->text('image');
            $table->string('description');
            $table->decimal('price', 6)->nullable();
            $table->decimal('display_price', 6)->nullable();
            $table->decimal('display_discount_price', 6)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('menu_addon', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_vendor_id');
            $table->unsignedBigInteger('menu_id')->nullable()->index('fk_menu_id');
            $table->unsignedBigInteger('menu_size_id')->nullable()->index('fk_menu_size_id');
            $table->unsignedBigInteger('addon_category_id')->index('fk_addon_category_id');
            $table->unsignedBigInteger('addon_id')->index('fk_addon_id');
            $table->decimal('price', 6);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('menu_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_vendor_id');
            $table->string('name');
            $table->tinyInteger('status')->default(1);
            $table->text('type');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('menu_size', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_vendor_id');
            $table->unsignedBigInteger('menu_id')->index('fk_menu_id');
            $table->unsignedBigInteger('item_size_id')->index('fk_item_size_id');
            $table->decimal('price', 6);
            $table->decimal('display_price', 6)->nullable();
            $table->decimal('display_discount_price', 6)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('notification', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('user_type', 100);
            $table->string('title');
            $table->text('message');
            $table->bigInteger('user_id');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::create('notification_template', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject');
            $table->string('title');
            $table->text('notification_content');
            $table->text('mail_content');
            $table->text('spanish_notification_content')->nullable();
            $table->text('spanish_mail_content')->nullable();
            $table->timestamps();
        });

        Schema::create('oauth_access_tokens', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unsignedBigInteger('client_id');
            $table->string('name')->nullable();
            $table->text('scopes')->nullable();
            $table->tinyInteger('revoked');
            $table->timestamps();
            $table->dateTime('expires_at')->nullable();
        });

        Schema::create('oauth_auth_codes', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('client_id');
            $table->text('scopes')->nullable();
            $table->tinyInteger('revoked');
            $table->dateTime('expires_at')->nullable();
        });

        Schema::create('oauth_clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('name');
            $table->string('secret', 100)->nullable();
            $table->string('provider')->nullable();
            $table->text('redirect');
            $table->tinyInteger('personal_access_client');
            $table->tinyInteger('password_client');
            $table->tinyInteger('revoked');
            $table->timestamps();
        });

        Schema::create('oauth_personal_access_clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id');
            $table->timestamps();
        });

        Schema::create('oauth_refresh_tokens', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->string('access_token_id', 100)->index();
            $table->tinyInteger('revoked');
            $table->dateTime('expires_at')->nullable();
        });

        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_id', 11);
            $table->unsignedBigInteger('vendor_id')->index('fk_order_vendor_id');
            $table->unsignedBigInteger('user_id')->index('fk_order_user_id');
            $table->unsignedBigInteger('delivery_person_id')->nullable()->index('fk_delivery_person_id');
            $table->date('date');
            $table->string('time', 100);
            $table->string('payment_type');
            $table->text('payment_token')->nullable();
            $table->string('payment_status');
            $table->decimal('amount', 6);
            $table->integer('admin_commission')->nullable();
            $table->integer('vendor_amount')->nullable();
            $table->string('delivery_type');
            $table->unsignedBigInteger('promocode_id')->nullable()->index('fk_promo_code_id');
            $table->decimal('promocode_price', 6)->nullable()->default(0);
            $table->unsignedBigInteger('address_id')->nullable()->index('fk_address_id');
            $table->decimal('delivery_charge', 6)->nullable();
            $table->string('order_status');
            $table->string('cancel_by')->nullable();
            $table->text('cancel_reason')->nullable();
            $table->decimal('tax', 6);
            $table->text('order_start_time')->nullable();
            $table->text('order_end_time')->nullable();
            $table->tinyInteger('printable')->default(1);
            $table->timestamps();
            $table->text('order_data');
            $table->decimal('sub_total', 6);
        });

        Schema::create('order_child', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->index('fk_orderChild_id');
            $table->unsignedBigInteger('item');
            $table->integer('price');
            $table->integer('qty');
            $table->text('custimization')->nullable();
            $table->timestamps();
        });

        Schema::create('order_setting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_order_setting_vendor_id');
            $table->tinyInteger('free_delivery')->nullable();
            $table->unsignedInteger('free_delivery_distance')->nullable();
            $table->unsignedInteger('free_delivery_amount')->nullable();
            $table->string('min_order_value')->nullable();
            $table->string('order_assign_manually')->nullable();
            $table->string('orderRefresh')->nullable();
            $table->integer('order_commission')->nullable();
            $table->string('order_dashboard_default_time')->nullable();
            $table->string('vendor_order_max_time')->nullable();
            $table->string('driver_order_max_time')->nullable();
            $table->string('delivery_charge_type')->nullable();
            $table->text('charges')->nullable();
            $table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('payment_setting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('cod')->default(1);
            $table->tinyInteger('stripe')->nullable();
            $table->tinyInteger('razorpay')->nullable();
            $table->tinyInteger('paypal')->nullable();
            $table->tinyInteger('flutterwave')->nullable();
            $table->tinyInteger('wallet')->nullable();
            $table->string('stripe_publish_key')->nullable();
            $table->string('stripe_secret_key')->nullable();
            $table->string('paypal_production')->nullable();
            $table->string('paypal_sendbox')->nullable();
            $table->text('paypal_client_id')->nullable();
            $table->text('paypal_secret_key')->nullable();
            $table->string('razorpay_publish_key')->nullable();
            $table->text('public_key')->nullable();
            $table->timestamps();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('permission_id');
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });

        Schema::create('promo_code', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('promo_code');
            $table->string('image')->nullable();
            $table->tinyInteger('display_customer_app');
            $table->text('vendor_id')->nullable();
            $table->text('customer_id')->nullable();
            $table->tinyInteger('isFlat');
            $table->string('max_user');
            $table->integer('count_max_user')->nullable()->default(0);
            $table->string('flatDiscount')->nullable();
            $table->string('discountType', 100);
            $table->integer('discount')->nullable();
            $table->string('max_disc_amount')->nullable();
            $table->string('min_order_amount');
            $table->integer('max_count');
            $table->integer('count_max_count')->nullable()->default(0);
            $table->string('max_order');
            $table->integer('count_max_order')->nullable()->default(0);
            $table->string('coupen_type');
            $table->text('description');
            $table->text('start_end_date');
            $table->text('display_text')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
        });

        Schema::create('refaund', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->index('fk_refaund_order_id');
            $table->unsignedBigInteger('user_id')->index('fk_refaund_user_id');
            $table->text('refund_reason');
            $table->string('refund_status');
            $table->string('payment_type')->nullable();
            $table->text('payment_token')->nullable();
            $table->timestamps();
        });

        Schema::create('review', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('rate')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('order_id')->index('fk_review_order_id');
            $table->unsignedBigInteger('user_id')->index('fk_review_user_id');
            $table->string('contact', 100)->nullable();
            $table->text('image')->nullable();
            $table->unsignedBigInteger('vendor_id')->index('fk_review_vendor_id');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('role_id');
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::create('settlements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_settlement_vendor_id');
            $table->unsignedBigInteger('order_id')->index('fk_settlement_order_id');
            $table->unsignedBigInteger('driver_id')->nullable()->index('fk_settlement_delivery_boy_id');
            $table->integer('driver_earning')->nullable();
            $table->integer('payment');
            $table->integer('admin_earning');
            $table->integer('vendor_earning');
            $table->integer('vendor_status');
            $table->integer('driver_status')->nullable();
            $table->text('payment_token')->nullable();
            $table->text('payment_type')->nullable();
            $table->string('driver_payment_type', 100)->nullable();
            $table->text('driver_payment_token')->nullable();
            $table->timestamps();
        });

        Schema::create('single_menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_vendor_id');
            $table->unsignedBigInteger('menu_category_id')->index('fk_menu_category_id');
            $table->unsignedBigInteger('menu_id')->index('fk_menu_id');
            $table->tinyInteger('status')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('single_menu_item_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_vendor_id');
            $table->unsignedBigInteger('single_menu_id')->index('fk_single_menu_id');
            $table->unsignedBigInteger('item_category_id')->index('fk_item_category_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('submenu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_submenu_menu_id');
            $table->unsignedBigInteger('menu_id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('price', 100);
            $table->text('description');
            $table->string('type');
            $table->string('qty_reset');
            $table->tinyInteger('status');
            $table->integer('item_reset_value')->nullable();
            $table->integer('is_excel')->default(0);
            $table->timestamps();
        });

        Schema::create('submenu_cutsomization_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('vendor_id')->index('fk_custimization_type_vendor_id');
            $table->unsignedBigInteger('submenu_id');
            $table->integer('menu_id');
            $table->string('type');
            $table->integer('min_item_selection');
            $table->integer('max_item_selection');
            $table->text('custimazation_item')->nullable();
            $table->timestamps();
        });

        Schema::create('tax', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('tax');
            $table->text('name');
            $table->text('type');
            $table->tinyInteger('status');
            $table->timestamps();
        });

        Schema::create('timezones', function (Blueprint $table) {
            $table->char('CountryCode', 2);
            $table->char('Coordinates', 15);
            $table->char('TimeZone', 32)->primary();
            $table->string('Comments', 85);
            $table->char('UTC_offset', 8);
            $table->char('UTC_DST_offset', 8);
            $table->string('Notes', 79)->nullable();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payable_type');
            $table->unsignedBigInteger('payable_id');
            $table->unsignedBigInteger('wallet_id')->nullable()->index('transactions_wallet_id_foreign');
            $table->enum('type', ['deposit', 'withdraw'])->index();
            $table->decimal('amount', 64, 0);
            $table->tinyInteger('confirmed');
            $table->longText('meta')->nullable();
            $table->char('uuid', 36)->unique();
            $table->timestamps();

            $table->index(['payable_type', 'payable_id']);
            $table->index(['payable_type', 'payable_id', 'type', 'confirmed'], 'payable_type_confirmed_ind');
            $table->index(['payable_type', 'payable_id', 'confirmed'], 'payable_confirmed_ind');
            $table->index(['payable_type', 'payable_id', 'type'], 'payable_type_ind');
        });

        Schema::create('transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('from_type');
            $table->unsignedBigInteger('from_id');
            $table->string('to_type');
            $table->unsignedBigInteger('to_id');
            $table->enum('status', ['exchange', 'transfer', 'paid', 'refund', 'gift'])->default('transfer');
            $table->enum('status_last', ['exchange', 'transfer', 'paid', 'refund', 'gift'])->nullable();
            $table->unsignedBigInteger('deposit_id')->index('transfers_deposit_id_foreign');
            $table->unsignedBigInteger('withdraw_id')->index('transfers_withdraw_id_foreign');
            $table->decimal('discount', 64, 0)->default(0);
            $table->decimal('fee', 64, 0)->default(0);
            $table->char('uuid', 36)->unique();
            $table->timestamps();

            $table->index(['from_type', 'from_id']);
            $table->index(['to_type', 'to_id']);
        });

        Schema::create('user_address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('fk_user_address_id');
            $table->string('lat');
            $table->string('lang');
            $table->unsignedBigInteger('zone_id')->index('fk_user_address_zone_id');
            $table->string('address');
            $table->string('type')->nullable();
            $table->tinyInteger('selected')->default(1);
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('email_id')->unique('users_email_unique');
            $table->timestamp('email_verified_at')->nullable();
            $table->text('device_token')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('phone_code', 100)->nullable();
            $table->tinyInteger('is_verified');
            $table->tinyInteger('status');
            $table->integer('otp')->nullable();
            $table->text('faviroute')->nullable();
            $table->rememberToken();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->string('language')->nullable();
            $table->text('ifsc_code')->nullable();
            $table->text('account_name')->nullable();
            $table->text('account_number')->nullable();
            $table->text('micr_code')->nullable();
            $table->text('provider_type')->nullable();
            $table->text('provider_token')->nullable();
            $table->timestamps();
        });

        Schema::create('vendor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('fk_vendor_user_id');
            $table->string('name');
            $table->string('vendor_logo')->nullable();
            $table->string('email_id')->unique('vendor_email_unique');
            $table->string('image');
            $table->string('password')->nullable();
            $table->string('contact')->nullable();
            $table->string('cuisine_id')->nullable();
            $table->string('address')->nullable();
            $table->string('lat')->nullable();
            $table->string('lang')->nullable();
            $table->string('map_address')->nullable();
            $table->string('min_order_amount')->nullable();
            $table->string('for_two_person')->nullable();
            $table->string('avg_delivery_time')->nullable();
            $table->string('license_number')->nullable();
            $table->string('admin_comission_type')->nullable();
            $table->string('admin_comission_value')->nullable();
            $table->string('vendor_type')->nullable();
            $table->string('time_slot')->nullable();
            $table->tinyInteger('tax_type')->default(1);
            $table->string('tax')->nullable();
            $table->string('delivery_type_timeSlot')->nullable();
            $table->tinyInteger('isExplorer');
            $table->tinyInteger('isTop');
            $table->integer('vendor_own_driver')->nullable();
            $table->string('payment_option')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('vendor_language')->nullable();
            $table->text('connector_type')->nullable();
            $table->text('connector_descriptor')->nullable();
            $table->text('connector_port')->nullable();
            $table->timestamps();
        });

        Schema::create('vendor_bank_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_bank_details_vendor_id');
            $table->string('bank_name');
            $table->string('branch_name');
            $table->string('account_number');
            $table->string('ifsc_code');
            $table->text('clabe');
            $table->timestamps();
        });

        Schema::create('vendor_discount', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image');
            $table->unsignedBigInteger('vendor_id')->index('fk_vendor_discount_vendor_id');
            $table->string('type');
            $table->integer('discount');
            $table->string('min_item_amount');
            $table->string('max_discount_amount');
            $table->string('start_end_date');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('wallet_payment', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedBigInteger('transaction_id')->index('transaction_id');
            $table->text('payment_type');
            $table->text('payment_token')->nullable();
            $table->string('added_by')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('wallets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('holder_type');
            $table->unsignedBigInteger('holder_id');
            $table->string('name');
            $table->string('slug')->index();
            $table->string('description')->nullable();
            $table->longText('meta')->nullable();
            $table->decimal('balance', 64, 0)->default(0);
            $table->smallInteger('decimal_places')->default(2);
            $table->timestamps();

            $table->index(['holder_type', 'holder_id']);
            $table->unique(['holder_type', 'holder_id', 'slug']);
        });

        Schema::create('working_hours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_working_vendor_id');
            $table->string('day_index');
            $table->text('period_list');
            $table->string('type');
            $table->tinyInteger('status');
            $table->timestamps();
        });

        Schema::table('addon', function (Blueprint $table) {
            $table->foreign(['addon_category_id'], 'fk_addon_category_id')->references(['id'])->on('addon_category')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });

        Schema::table('deals_items', function (Blueprint $table) {
            $table->foreign(['deals_menu_id'], 'fk_deals_menu_id')->references(['id'])->on('deals_menu')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });

        Schema::table('deals_menu', function (Blueprint $table) {
            $table->foreign(['menu_category_id'], 'fk_deals_menu_menu_category_id')->references(['id'])->on('menu_category')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });

        Schema::table('delivery_person', function (Blueprint $table) {
            $table->foreign(['delivery_zone_id'], 'fk_delivery_person_delivery_zone_id')->references(['id'])->on('delivery_zone')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['vendor_id'], 'fk_delivery_person_vendor_id')->references(['id'])->on('vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('delivery_zone_area', function (Blueprint $table) {
            $table->foreign(['delivery_zone_id'], 'fk_delivery_zone_id')->references(['id'])->on('delivery_zone')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('feedback', function (Blueprint $table) {
            $table->foreign(['user_id'], 'fk_feedback_user_id')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('half_n_half_menu', function (Blueprint $table) {
            $table->foreign(['menu_category_id'], 'fk_half_n_half_menu_menu_category_id')->references(['id'])->on('menu_category')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });

        Schema::table('menu_addon', function (Blueprint $table) {
            $table->foreign(['menu_id'], 'fk_menu_addon_menu_id')->references(['id'])->on('menu')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['menu_size_id'], 'fk_menu_size_id')->references(['id'])->on('menu_size')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });

        Schema::table('menu_size', function (Blueprint $table) {
            $table->foreign(['menu_id'], 'fk_menu_id')->references(['id'])->on('menu')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });

        Schema::table('order', function (Blueprint $table) {
            $table->foreign(['address_id'], 'fk_address_id')->references(['id'])->on('user_address')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['delivery_person_id'], 'fk_delivery_person_id')->references(['id'])->on('delivery_person')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['user_id'], 'fk_order_user_id')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['vendor_id'], 'fk_order_vendor_id')->references(['id'])->on('vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['promocode_id'], 'fk_promo_code_id')->references(['id'])->on('promo_code')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('order_child', function (Blueprint $table) {
            $table->foreign(['order_id'], 'fk_orderChild_id')->references(['id'])->on('order')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('order_setting', function (Blueprint $table) {
            $table->foreign(['vendor_id'], 'fk_order_setting_vendor_id')->references(['id'])->on('vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('refaund', function (Blueprint $table) {
            $table->foreign(['order_id'], 'fk_refaund_order_id')->references(['id'])->on('order')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['user_id'], 'fk_refaund_user_id')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('review', function (Blueprint $table) {
            $table->foreign(['order_id'], 'fk_review_order_id')->references(['id'])->on('order')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['user_id'], 'fk_review_user_id')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['vendor_id'], 'fk_review_vendor_id')->references(['id'])->on('vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('settlements', function (Blueprint $table) {
            $table->foreign(['driver_id'], 'fk_settlement_delivery_boy_id')->references(['id'])->on('delivery_person')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['order_id'], 'fk_settlement_order_id')->references(['id'])->on('order')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['vendor_id'], 'fk_settlement_vendor_id')->references(['id'])->on('vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('single_menu', function (Blueprint $table) {
            $table->foreign(['menu_category_id'], 'fk_single_menu_menu_category_id')->references(['id'])->on('menu_category')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });

        Schema::table('single_menu_item_category', function (Blueprint $table) {
            $table->foreign(['single_menu_id'], 'fk_single_menu_id')->references(['id'])->on('single_menu')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });

        Schema::table('submenu', function (Blueprint $table) {
            $table->foreign(['vendor_id'], 'fk_submenu_menu_id')->references(['id'])->on('vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['vendor_id'], 'fk_submenu_vendor_id')->references(['id'])->on('vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('submenu_cutsomization_type', function (Blueprint $table) {
            $table->foreign(['vendor_id'], 'fk_custimization_type_vendor_id')->references(['id'])->on('vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign(['wallet_id'])->references(['id'])->on('wallets')->onDelete('CASCADE');
        });

        Schema::table('transfers', function (Blueprint $table) {
            $table->foreign(['deposit_id'])->references(['id'])->on('transactions')->onDelete('CASCADE');
            $table->foreign(['withdraw_id'])->references(['id'])->on('transactions')->onDelete('CASCADE');
        });

        Schema::table('user_address', function (Blueprint $table) {
            $table->foreign(['user_id'], 'fk_user_address_id')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('vendor', function (Blueprint $table) {
            $table->foreign(['user_id'], 'fk_vendor_user_id')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('vendor_bank_details', function (Blueprint $table) {
            $table->foreign(['vendor_id'], 'fk_bank_details_vendor_id')->references(['id'])->on('vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('vendor_discount', function (Blueprint $table) {
            $table->foreign(['vendor_id'], 'fk_vendor_discount_vendor_id')->references(['id'])->on('vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('wallet_payment', function (Blueprint $table) {
            $table->foreign(['transaction_id'], 'wallet_payment_ibfk_1')->references(['id'])->on('transactions')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('working_hours', function (Blueprint $table) {
            $table->foreign(['vendor_id'], 'fk_working_vendor_id')->references(['id'])->on('vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('working_hours', function (Blueprint $table) {
            $table->dropForeign('fk_working_vendor_id');
        });

        Schema::table('wallet_payment', function (Blueprint $table) {
            $table->dropForeign('wallet_payment_ibfk_1');
        });

        Schema::table('vendor_discount', function (Blueprint $table) {
            $table->dropForeign('fk_vendor_discount_vendor_id');
        });

        Schema::table('vendor_bank_details', function (Blueprint $table) {
            $table->dropForeign('fk_bank_details_vendor_id');
        });

        Schema::table('vendor', function (Blueprint $table) {
            $table->dropForeign('fk_vendor_user_id');
        });

        Schema::table('user_address', function (Blueprint $table) {
            $table->dropForeign('fk_user_address_id');
        });

        Schema::table('transfers', function (Blueprint $table) {
            $table->dropForeign('transfers_deposit_id_foreign');
            $table->dropForeign('transfers_withdraw_id_foreign');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign('transactions_wallet_id_foreign');
        });

        Schema::table('submenu_cutsomization_type', function (Blueprint $table) {
            $table->dropForeign('fk_custimization_type_vendor_id');
        });

        Schema::table('submenu', function (Blueprint $table) {
            $table->dropForeign('fk_submenu_menu_id');
            $table->dropForeign('fk_submenu_vendor_id');
        });

        Schema::table('single_menu_item_category', function (Blueprint $table) {
            $table->dropForeign('fk_single_menu_id');
        });

        Schema::table('single_menu', function (Blueprint $table) {
            $table->dropForeign('fk_single_menu_menu_category_id');
        });

        Schema::table('settlements', function (Blueprint $table) {
            $table->dropForeign('fk_settlement_delivery_boy_id');
            $table->dropForeign('fk_settlement_order_id');
            $table->dropForeign('fk_settlement_vendor_id');
        });

        Schema::table('review', function (Blueprint $table) {
            $table->dropForeign('fk_review_order_id');
            $table->dropForeign('fk_review_user_id');
            $table->dropForeign('fk_review_vendor_id');
        });

        Schema::table('refaund', function (Blueprint $table) {
            $table->dropForeign('fk_refaund_order_id');
            $table->dropForeign('fk_refaund_user_id');
        });

        Schema::table('order_setting', function (Blueprint $table) {
            $table->dropForeign('fk_order_setting_vendor_id');
        });

        Schema::table('order_child', function (Blueprint $table) {
            $table->dropForeign('fk_orderChild_id');
        });

        Schema::table('order', function (Blueprint $table) {
            $table->dropForeign('fk_address_id');
            $table->dropForeign('fk_delivery_person_id');
            $table->dropForeign('fk_order_user_id');
            $table->dropForeign('fk_order_vendor_id');
            $table->dropForeign('fk_promo_code_id');
        });

        Schema::table('menu_size', function (Blueprint $table) {
            $table->dropForeign('fk_menu_id');
        });

        Schema::table('menu_addon', function (Blueprint $table) {
            $table->dropForeign('fk_menu_addon_menu_id');
            $table->dropForeign('fk_menu_size_id');
        });

        Schema::table('half_n_half_menu', function (Blueprint $table) {
            $table->dropForeign('fk_half_n_half_menu_menu_category_id');
        });

        Schema::table('feedback', function (Blueprint $table) {
            $table->dropForeign('fk_feedback_user_id');
        });

        Schema::table('delivery_zone_area', function (Blueprint $table) {
            $table->dropForeign('fk_delivery_zone_id');
        });

        Schema::table('delivery_person', function (Blueprint $table) {
            $table->dropForeign('fk_delivery_person_delivery_zone_id');
            $table->dropForeign('fk_delivery_person_vendor_id');
        });

        Schema::table('deals_menu', function (Blueprint $table) {
            $table->dropForeign('fk_deals_menu_menu_category_id');
        });

        Schema::table('deals_items', function (Blueprint $table) {
            $table->dropForeign('fk_deals_menu_id');
        });

        Schema::table('addon', function (Blueprint $table) {
            $table->dropForeign('fk_addon_category_id');
        });

        Schema::dropIfExists('working_hours');

        Schema::dropIfExists('wallets');

        Schema::dropIfExists('wallet_payment');

        Schema::dropIfExists('vendor_discount');

        Schema::dropIfExists('vendor_bank_details');

        Schema::dropIfExists('vendor');

        Schema::dropIfExists('users');

        Schema::dropIfExists('user_address');

        Schema::dropIfExists('transfers');

        Schema::dropIfExists('transactions');

        Schema::dropIfExists('timezones');

        Schema::dropIfExists('tax');

        Schema::dropIfExists('submenu_cutsomization_type');

        Schema::dropIfExists('submenu');

        Schema::dropIfExists('single_menu_item_category');

        Schema::dropIfExists('single_menu');

        Schema::dropIfExists('settlements');

        Schema::dropIfExists('roles');

        Schema::dropIfExists('role_user');

        Schema::dropIfExists('review');

        Schema::dropIfExists('refaund');

        Schema::dropIfExists('promo_code');

        Schema::dropIfExists('permissions');

        Schema::dropIfExists('permission_role');

        Schema::dropIfExists('payment_setting');

        Schema::dropIfExists('password_resets');

        Schema::dropIfExists('order_setting');

        Schema::dropIfExists('order_child');

        Schema::dropIfExists('order');

        Schema::dropIfExists('oauth_refresh_tokens');

        Schema::dropIfExists('oauth_personal_access_clients');

        Schema::dropIfExists('oauth_clients');

        Schema::dropIfExists('oauth_auth_codes');

        Schema::dropIfExists('oauth_access_tokens');

        Schema::dropIfExists('notification_template');

        Schema::dropIfExists('notification');

        Schema::dropIfExists('menu_size');

        Schema::dropIfExists('menu_category');

        Schema::dropIfExists('menu_addon');

        Schema::dropIfExists('menu');

        Schema::dropIfExists('language');

        Schema::dropIfExists('item_size');

        Schema::dropIfExists('item_category');

        Schema::dropIfExists('half_n_half_menu');

        Schema::dropIfExists('general_setting');

        Schema::dropIfExists('feedback');

        Schema::dropIfExists('faq');

        Schema::dropIfExists('failed_jobs');

        Schema::dropIfExists('delivery_zone_news');

        Schema::dropIfExists('delivery_zone_area');

        Schema::dropIfExists('delivery_zone');

        Schema::dropIfExists('delivery_person');

        Schema::dropIfExists('deals_menu');

        Schema::dropIfExists('deals_items');

        Schema::dropIfExists('currency');

        Schema::dropIfExists('cuisine');

        Schema::dropIfExists('country');

        Schema::dropIfExists('banner');

        Schema::dropIfExists('addon_category');

        Schema::dropIfExists('addon');
    }
}
