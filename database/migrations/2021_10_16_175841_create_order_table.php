<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_id', 11);
            $table->unsignedBigInteger('vendor_id')->index('fk_order_vendor_id');
            $table->unsignedBigInteger('user_id')->index('fk_order_user_id');
            $table->unsignedBigInteger('delivery_person_id')->nullable()->index('fk_delivery_person_id');
            $table->date('date');
            $table->string('time', 100);
            $table->string('payment_type');
            $table->text('payment_token')->nullable();
            $table->string('payment_status');
            $table->decimal('amount', 6);
            $table->integer('admin_commission')->nullable();
            $table->integer('vendor_amount')->nullable();
            $table->string('delivery_type');
            $table->unsignedBigInteger('promocode_id')->nullable()->index('fk_promo_code_id');
            $table->decimal('promocode_price', 6)->nullable()->default(0);
            $table->unsignedBigInteger('address_id')->nullable()->index('fk_address_id');
            $table->decimal('delivery_charge', 6)->nullable();
            $table->string('order_status');
            $table->string('cancel_by')->nullable();
            $table->text('cancel_reason')->nullable();
            $table->decimal('tax', 6);
            $table->text('order_start_time')->nullable();
            $table->text('order_end_time')->nullable();
            $table->tinyInteger('printable')->default(1);
            $table->timestamps();
            $table->text('order_data');
            $table->decimal('sub_total', 6);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
