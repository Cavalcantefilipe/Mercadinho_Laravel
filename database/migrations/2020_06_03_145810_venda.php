<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Venda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venda', function (Blueprint $table) {
            $table->bigIncrements('idVenda');
            $table->double('total');
            $table->unsignedBigInteger('idCliente');
            $table->foreign('idCliente')->references('idCliente')->on('cliente');
            $table->dateTime('finalizado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('venda');
    }
}
