<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_setting');
    }
}
