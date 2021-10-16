<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_setting');
    }
}
