<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devolucion_clientes', function (Blueprint $table) {
            $table->id();
            $table->string('NumFactura',16);
            $table->unsignedBigInteger('vendedor_id');
            $table->foreign('vendedor_id')->references('id')->on('personals');
            $table->integer('cliente_id')->nullable();
            $table->unsignedBigInteger('devolucion_personal_id');
            $table->foreign('devolucion_personal_id')->references('id')->on('personals');
            $table->date('FechaDevolucion')->format('%d/%m/%Y');
            $table->string('descripcion');
            $table->float('TotalVenta');
            $table->float('TotalImpuesto');
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
        Schema::dropIfExists('devolucion_clientes');
    }
};
