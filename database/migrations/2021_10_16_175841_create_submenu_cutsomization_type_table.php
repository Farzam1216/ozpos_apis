<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmenuCutsomizationTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submenu_cutsomization_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('vendor_id')->index('fk_custimization_type_vendor_id');
            $table->unsignedBigInteger('submenu_id');
            $table->integer('menu_id');
            $table->string('type');
            $table->integer('min_item_selection');
            $table->integer('max_item_selection');
            $table->text('custimazation_item')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submenu_cutsomization_type');
    }
}
