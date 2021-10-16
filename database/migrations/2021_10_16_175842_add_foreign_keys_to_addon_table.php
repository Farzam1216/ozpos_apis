<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAddonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addon', function (Blueprint $table) {
            $table->foreign(['addon_category_id'], 'fk_addon_category_id')->references(['id'])->on('addon_category')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addon', function (Blueprint $table) {
            $table->dropForeign('fk_addon_category_id');
        });
    }
}
