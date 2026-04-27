<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alertas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evento_id')->constrained('eventos')->onDelete('cascade');
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->enum('nivel', ['baja', 'media', 'alta', 'critica']);
            $table->enum('estado', ['pendiente', 'atendida', 'descartada'])->default('pendiente');
            $table->text('mensaje');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alertas');
    }
};