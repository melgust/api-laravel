<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTcProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tc_product', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            $table->string('product_name')->nullable(false);
            $table->integer('status')->nullable(false)->default(1);
            $table->bigInteger('provider_id')->unsigned();
            $table->foreign('provider_id')->references('provider_id')->on('tc_provider');
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
        Schema::dropIfExists('tc_product');
    }
}