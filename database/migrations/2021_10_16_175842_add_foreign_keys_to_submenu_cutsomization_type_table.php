<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSubmenuCutsomizationTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submenu_cutsomization_type', function (Blueprint $table) {
            $table->foreign(['vendor_id'], 'fk_custimization_type_vendor_id')->references(['id'])->on('vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('submenu_cutsomization_type', function (Blueprint $table) {
            $table->dropForeign('fk_custimization_type_vendor_id');
        });
    }
}
