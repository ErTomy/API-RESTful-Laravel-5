<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('cliente_id')->unsigned();
            $table->integer('conductor_id')->unsigned();
            $table->date('fecha_entrega');
            $table->integer('hora_desde');
            $table->integer('hora_hasta');
            $table->string('direccion', 250);
            
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('conductor_id')->references('id')->on('conductores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
