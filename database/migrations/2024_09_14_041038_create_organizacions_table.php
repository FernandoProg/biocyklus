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
        Schema::create('organizacions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('password');
            $table->string('ubicacion');
            $table->integer('miembros');
            $table->string('rrss');
            $table->boolean('compostan');
            $table->boolean('reciclan');
            $table->boolean('capacitarse');
            $table->string('asociacion');
            $table->string('representante_nombre');
            $table->integer('representante_telefono');
            $table->string('representante_correo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizacions');
    }
};
