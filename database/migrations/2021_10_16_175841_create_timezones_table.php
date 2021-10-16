<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimezonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timezones', function (Blueprint $table) {
            $table->char('CountryCode', 2);
            $table->char('Coordinates', 15);
            $table->char('TimeZone', 32)->primary();
            $table->string('Comments', 85);
            $table->char('UTC_offset', 8);
            $table->char('UTC_DST_offset', 8);
            $table->string('Notes', 79)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timezones');
    }
}
