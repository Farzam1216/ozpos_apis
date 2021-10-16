<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_setting');
    }
}
