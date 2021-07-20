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
            $table->id();
            $table->string('username',100)->unique();
            $table->string('email',100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',100);
            $table->string('title',100)->nullable();
            $table->string('first_name',100)->nullable();
            $table->string('second_name',100)->nullable();
            $table->string('country',100)->nullable();
            $table->string('state',100)->nullable();
            $table->string('city',100)->nullable();
            $table->string('address',100)->nullable();
            $table->string('postcode',100)->nullable();
            $table->string('countryCode',100)->nullable();
            $table->string('number',100)->nullable();
            $table->string('avatar',100)->nullable();
            $table->integer('user_role')->nullable();
            $table->string('birthday',100)->nullable();
            $table->string('aiva_username',100)->nullable();
            $table->string('am_status',100)->nullable();
            $table->string('status',100)->nullable();
            $table->float('credits')->nullable();
            $table->float('abp')->nullable();
            $table->rememberToken();
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
