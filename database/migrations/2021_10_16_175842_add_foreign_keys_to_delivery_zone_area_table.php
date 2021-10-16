<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDeliveryZoneAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_zone_area', function (Blueprint $table) {
            $table->foreign(['delivery_zone_id'], 'fk_delivery_zone_id')->references(['id'])->on('delivery_zone')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery_zone_area', function (Blueprint $table) {
            $table->dropForeign('fk_delivery_zone_id');
        });
    }
}
