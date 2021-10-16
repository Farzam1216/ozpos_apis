<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToHalfNHalfMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('half_n_half_menu', function (Blueprint $table) {
            $table->foreign(['menu_category_id'], 'fk_half_n_half_menu_menu_category_id')->references(['id'])->on('menu_category')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('half_n_half_menu', function (Blueprint $table) {
            $table->dropForeign('fk_half_n_half_menu_menu_category_id');
        });
    }
}
