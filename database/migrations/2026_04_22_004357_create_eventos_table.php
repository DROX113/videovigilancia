<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('camara_id')->constrained('camaras')->onDelete('cascade');
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->enum('tipo', ['movimiento', 'intrusion', 'sabotaje', 'otro']);
            $table->text('descripcion');
            $table->dateTime('fecha_hora');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};