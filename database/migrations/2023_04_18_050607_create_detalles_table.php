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
        Schema::create('detallepedidos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('iddetalle');
            $table->integer('cantidad');
            $table->string('descripcion')->nullable();
            $table->integer('idproducto')->unsigned();
            $table->integer('idpedido')->unsigned();
            $table->foreign('idproducto')->references('idproducto')->on('productos');
            $table->foreign('idpedido')->references('idpedido')->on('pedidos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detallepedidos');
    }
};
