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
        Schema::create('restaurante_tipo_residuos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_restaurante');
            $table->unsignedBigInteger('id_tipoResiduo');

            $table->primary(['id_restaurante', 'id_tipoResiduo']);

            $table->foreign('id_restaurante')->references('id')->on('restaurantes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_tipoResiduo')->references('id')->on('tipo_residuos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurante_tipo_residuos');
    }
};
