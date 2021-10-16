<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settlements');
    }
}
