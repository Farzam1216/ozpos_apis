<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settlements', function (Blueprint $table) {
            $table->foreign(['driver_id'], 'fk_settlement_delivery_boy_id')->references(['id'])->on('delivery_person')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['order_id'], 'fk_settlement_order_id')->references(['id'])->on('order')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['vendor_id'], 'fk_settlement_vendor_id')->references(['id'])->on('vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settlements', function (Blueprint $table) {
            $table->dropForeign('fk_settlement_delivery_boy_id');
            $table->dropForeign('fk_settlement_order_id');
            $table->dropForeign('fk_settlement_vendor_id');
        });
    }
}
