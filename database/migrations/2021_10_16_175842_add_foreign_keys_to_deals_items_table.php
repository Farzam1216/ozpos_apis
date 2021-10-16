<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDealsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deals_items', function (Blueprint $table) {
            $table->foreign(['deals_menu_id'], 'fk_deals_menu_id')->references(['id'])->on('deals_menu')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deals_items', function (Blueprint $table) {
            $table->dropForeign('fk_deals_menu_id');
        });
    }
}
