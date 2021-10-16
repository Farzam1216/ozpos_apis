<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOrderChildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_child', function (Blueprint $table) {
            $table->foreign(['order_id'], 'fk_orderChild_id')->references(['id'])->on('order')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_child', function (Blueprint $table) {
            $table->dropForeign('fk_orderChild_id');
        });
    }
}
