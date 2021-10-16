<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSingleMenuItemCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('single_menu_item_category', function (Blueprint $table) {
            $table->foreign(['single_menu_id'], 'fk_single_menu_id')->references(['id'])->on('single_menu')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('single_menu_item_category', function (Blueprint $table) {
            $table->dropForeign('fk_single_menu_id');
        });
    }
}
