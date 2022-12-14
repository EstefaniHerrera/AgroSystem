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
        Schema::create('detalles_productos_nuevos_temporals', function (Blueprint $table) {
            $table->id();
            $table->integer('IdPedido')->nullable();
            $table->string('Producto');
            $table->string('Presentacion');
            $table->integer('Cantidad');
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
        Schema::dropIfExists('detalles_productos_nuevos_temporals');
    }
};
