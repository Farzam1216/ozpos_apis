<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('email_id')->unique('users_email_unique');
            $table->timestamp('email_verified_at')->nullable();
            $table->text('device_token')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('phone_code', 100)->nullable();
            $table->tinyInteger('is_verified');
            $table->tinyInteger('status');
            $table->integer('otp')->nullable();
            $table->text('faviroute')->nullable();
            $table->rememberToken();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->string('language')->nullable();
            $table->text('ifsc_code')->nullable();
            $table->text('account_name')->nullable();
            $table->text('account_number')->nullable();
            $table->text('micr_code')->nullable();
            $table->text('provider_type')->nullable();
            $table->text('provider_token')->nullable();
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
        Schema::dropIfExists('users');
    }
}
