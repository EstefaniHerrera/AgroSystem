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
        Schema::create('detalles_temporals', function (Blueprint $table) {
            $table->id();
            $table->integer('IdVenta')->nullable();
            $table->unsignedBigInteger('IdProducto');
            $table->foreign('IdProducto')->references('id')->on('productos');
            $table->unsignedBigInteger('IdPresentacion');
            $table->foreign('IdPresentacion')->references('id')->on('presentacions');
            $table->integer('Cantidad');
            $table->float('Precio_venta');
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
        Schema::dropIfExists('detalles_temporals');
    }
};
