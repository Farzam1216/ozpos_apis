<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->foreign(['address_id'], 'fk_address_id')->references(['id'])->on('user_address')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['delivery_person_id'], 'fk_delivery_person_id')->references(['id'])->on('delivery_person')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['user_id'], 'fk_order_user_id')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['vendor_id'], 'fk_order_vendor_id')->references(['id'])->on('vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['promocode_id'], 'fk_promo_code_id')->references(['id'])->on('promo_code')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->dropForeign('fk_address_id');
            $table->dropForeign('fk_delivery_person_id');
            $table->dropForeign('fk_order_user_id');
            $table->dropForeign('fk_order_vendor_id');
            $table->dropForeign('fk_promo_code_id');
        });
    }
}
