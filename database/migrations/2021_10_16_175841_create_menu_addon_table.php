<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuAddonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_addon', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index('fk_vendor_id');
            $table->unsignedBigInteger('menu_id')->nullable()->index('fk_menu_id');
            $table->unsignedBigInteger('menu_size_id')->nullable()->index('fk_menu_size_id');
            $table->unsignedBigInteger('addon_category_id')->index('fk_addon_category_id');
            $table->unsignedBigInteger('addon_id')->index('fk_addon_id');
            $table->decimal('price', 6);
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
        Schema::dropIfExists('menu_addon');
    }
}
