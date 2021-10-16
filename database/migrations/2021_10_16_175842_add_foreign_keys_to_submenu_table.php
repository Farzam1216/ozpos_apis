<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSubmenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submenu', function (Blueprint $table) {
            $table->foreign(['vendor_id'], 'fk_submenu_menu_id')->references(['id'])->on('vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['vendor_id'], 'fk_submenu_vendor_id')->references(['id'])->on('vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('submenu', function (Blueprint $table) {
            $table->dropForeign('fk_submenu_menu_id');
            $table->dropForeign('fk_submenu_vendor_id');
        });
    }
}
