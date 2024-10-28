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
            $table->id();
            $table->foreignId('restaurante_id')->constrained()->onDelete('cascade');
            $table->foreignId('tipo_residuo_id')->constrained()->onDelete('cascade');
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
