<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submenu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_submenu_menu_id');
            $table->unsignedBigInteger('menu_id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('price', 100);
            $table->text('description');
            $table->string('type');
            $table->string('qty_reset');
            $table->tinyInteger('status');
            $table->integer('item_reset_value')->nullable();
            $table->integer('is_excel')->default(0);
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
        Schema::dropIfExists('submenu');
    }
}
