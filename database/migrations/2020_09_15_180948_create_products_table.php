<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('info');
            $table->longText('faq')->nullable();
            $table->longText('things')->nullable();
            $table->longText('look_for')->nullable();
            $table->string('category');
            $table->string('subcategory');
            $table->string('city');
            $table->string('country');
            $table->string('region');
            $table->string('top_thing');
            $table->string('recommend');
            $table->integer('reviews')->nullable()->default(0);;
            $table->integer('booked')->nullable()->default(0);;
            $table->integer('package')->nullable()->default(0);
            $table->integer('ticket')->nullable()->default(0);
            $table->string('status')->nullable();
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
        Schema::dropIfExists('products');
    }
}
