<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbpHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abp_history', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->integer('order_id');
            $table->string('from_user');
            $table->string('to_user');
            $table->string('detail');
            $table->float('amount');
            $table->string('product_name');
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
        Schema::dropIfExists('abp_history');
    }
}
