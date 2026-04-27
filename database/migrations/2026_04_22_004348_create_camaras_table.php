<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('camaras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ubicacion');
            $table->string('ip')->unique();
            $table->enum('estado', ['activa', 'inactiva', 'falla'])->default('activa');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('camaras');
    }
};