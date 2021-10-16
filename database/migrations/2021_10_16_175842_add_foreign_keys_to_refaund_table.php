<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRefaundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('refaund', function (Blueprint $table) {
            $table->foreign(['order_id'], 'fk_refaund_order_id')->references(['id'])->on('order')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['user_id'], 'fk_refaund_user_id')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('refaund', function (Blueprint $table) {
            $table->dropForeign('fk_refaund_order_id');
            $table->dropForeign('fk_refaund_user_id');
        });
    }
}
