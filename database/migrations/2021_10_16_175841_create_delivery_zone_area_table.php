<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryZoneAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_zone_area');
    }
}
