<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToWalletPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wallet_payment', function (Blueprint $table) {
            $table->foreign(['transaction_id'], 'wallet_payment_ibfk_1')->references(['id'])->on('transactions')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wallet_payment', function (Blueprint $table) {
            $table->dropForeign('wallet_payment_ibfk_1');
        });
    }
}
