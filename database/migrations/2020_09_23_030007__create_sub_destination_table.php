<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubDestinationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_destination', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('promo1')->nullable();
            $table->longText('promo2')->nullable();
            $table->longText('info1')->nullable();
            $table->longText('info2')->nullable();
            $table->integer('region_id');
            $table->integer('main_destination_id');
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
        Schema::dropIfExists('sub_destination');
    }
}
