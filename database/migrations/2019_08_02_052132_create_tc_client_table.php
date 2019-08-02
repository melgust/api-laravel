<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTcClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tc_client', function (Blueprint $table) {
            $table->bigIncrements('client_id');
            $table->string('client_name')->nullable(false);
            $table->string('address')->nullable(false);
            $table->string('nit')->nullable(false);
            $table->integer('status')->nullable(false)->default(1);            
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
        Schema::dropIfExists('tc_client');
    }
}
