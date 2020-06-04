<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItensVenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itensVenda', function (Blueprint $table) {
            $table->bigIncrements('idItemVenda');
            $table->unsignedBigInteger('idVenda');
            $table->foreign('idVenda')->references('idVenda')->on('venda');
            $table->unsignedBigInteger('idProduto');
            $table->foreign('idProduto')->references('idProduto')->on('produto');
            $table->integer('quantidadeProduto');
            $table->double('ValorProduto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('itensVenda');
    }
}
