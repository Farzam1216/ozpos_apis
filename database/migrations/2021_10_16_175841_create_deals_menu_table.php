<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals_menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_vendor_id');
            $table->unsignedBigInteger('menu_category_id')->index('fk_menu_category_id');
            $table->string('name');
            $table->text('image');
            $table->string('description');
            $table->decimal('price', 6);
            $table->decimal('display_price', 6)->nullable();
            $table->decimal('display_discount_price', 6)->nullable();
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
        Schema::dropIfExists('deals_menu');
    }
}
