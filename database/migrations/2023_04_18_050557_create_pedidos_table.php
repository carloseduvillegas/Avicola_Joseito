<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idcliente');
            $table->integer('codcliente')->nullable();
            $table->string('nombrecliente');
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->integer('celular')->nullable();
            $table->string('puesto')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('estado');
            $table->integer('idpromotor')->unsigned();
            $table->integer('idmercado')->unsigned();
            $table->timestamps();
        });

        Schema::table('clientes',function ($table)
        {
            $table->foreign('idpromotor')->references('idpromotor')->on('promotores');
            $table->foreign('idmercado')->references('idmercado')->on('mercados');
        });
        Schema::create('pedidos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idpedido');
            $table->integer('idcliente')->unsigned();
            $table->integer('idpromotor')->unsigned();
            $table->string('observacion')->nullable();
            $table->foreign('idcliente')->references('idcliente')->on('clientes');
            $table->foreign('idpromotor')->references('idpromotor')->on('promotores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
