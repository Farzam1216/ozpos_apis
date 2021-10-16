<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_code', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('promo_code');
            $table->string('image')->nullable();
            $table->tinyInteger('display_customer_app');
            $table->text('vendor_id')->nullable();
            $table->text('customer_id')->nullable();
            $table->tinyInteger('isFlat');
            $table->string('max_user');
            $table->integer('count_max_user')->nullable()->default(0);
            $table->string('flatDiscount')->nullable();
            $table->string('discountType', 100);
            $table->integer('discount')->nullable();
            $table->string('max_disc_amount')->nullable();
            $table->string('min_order_amount');
            $table->integer('max_count');
            $table->integer('count_max_count')->nullable()->default(0);
            $table->string('max_order');
            $table->integer('count_max_order')->nullable()->default(0);
            $table->string('coupen_type');
            $table->text('description');
            $table->text('start_end_date');
            $table->text('display_text')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('promo_code');
    }
}
