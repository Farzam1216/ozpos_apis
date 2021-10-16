<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor');
    }
}
