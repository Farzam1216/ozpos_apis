<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('rate')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('order_id')->index('fk_review_order_id');
            $table->unsignedBigInteger('user_id')->index('fk_review_user_id');
            $table->string('contact', 100)->nullable();
            $table->text('image')->nullable();
            $table->unsignedBigInteger('vendor_id')->index('fk_review_vendor_id');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review');
    }
}
