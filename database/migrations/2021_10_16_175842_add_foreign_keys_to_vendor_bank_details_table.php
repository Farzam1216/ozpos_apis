<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToVendorBankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_bank_details', function (Blueprint $table) {
            $table->foreign(['vendor_id'], 'fk_bank_details_vendor_id')->references(['id'])->on('vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_bank_details', function (Blueprint $table) {
            $table->dropForeign('fk_bank_details_vendor_id');
        });
    }
}
