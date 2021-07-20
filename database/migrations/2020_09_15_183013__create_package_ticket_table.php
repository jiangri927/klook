<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_ticket', function (Blueprint $table) {
            $table->id();
            $table->integer('package_id');
            $table->string('title');
            $table->float('m_price');
            $table->float('o_price');
            $table->float('o_percent');
            $table->float('abp_price');
            $table->float('abp_amount');
            $table->float('abp_percent');
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
        Schema::dropIfExists('package_ticket');
    }
}
