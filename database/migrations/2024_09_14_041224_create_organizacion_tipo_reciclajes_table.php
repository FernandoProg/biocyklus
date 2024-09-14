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
        Schema::create('organizacion_tipo_reciclajes', function (Blueprint $table) {
            $table->unsignedBigInteger('id_organizacion');
            $table->unsignedBigInteger('tipoReciclaje');

            $table->primary(['id_organizacion', 'tipoReciclaje']);

            $table->foreign('id_organizacion')->references('id')->on('organizacions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tipoReciclaje')->references('id')->on('tipo_reciclajes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizacion_tipo_reciclajes');
    }
};
