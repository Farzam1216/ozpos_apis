<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_person');
    }
}
