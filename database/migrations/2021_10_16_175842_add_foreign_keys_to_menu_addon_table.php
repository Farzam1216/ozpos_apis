<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMenuAddonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_addon', function (Blueprint $table) {
            $table->foreign(['menu_id'], 'fk_menu_addon_menu_id')->references(['id'])->on('menu')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['menu_size_id'], 'fk_menu_size_id')->references(['id'])->on('menu_size')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_addon', function (Blueprint $table) {
            $table->dropForeign('fk_menu_addon_menu_id');
            $table->dropForeign('fk_menu_size_id');
        });
    }
}
