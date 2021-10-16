<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHalfNHalfMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('half_n_half_menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_vendor_id');
            $table->unsignedBigInteger('menu_category_id')->index('fk_menu_category_id');
            $table->unsignedBigInteger('item_category_id')->index('fk_item_category_id');
            $table->string('name');
            $table->text('image');
            $table->string('description');
            $table->tinyInteger('status')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('half_n_half_menu');
    }
}
