<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historial_movimientos', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')->constrained('tbl_users')->onDelete('cascade');
            
            // Tipo de acción (create, update, delete, restore, login, logout, etc.)
            $table->string('accion', 50);
            
            // Tabla afectada
            $table->string('tabla', 100);
            
            // ID del registro afectado
            $table->unsignedBigInteger('registro_id')->nullable();
            
            // Descripción legible de lo que se hizo
            $table->text('descripcion')->nullable();
            
            // Datos antes del cambio (JSON)
            $table->json('datos_anteriores')->nullable();
            
            // Datos después del cambio (JSON)
            $table->json('datos_nuevos')->nullable();
            
            // IP del usuario
            $table->string('ip', 45)->nullable();
            
            // User Agent del navegador
            $table->text('user_agent')->nullable();
            
            // URL donde se realizó la acción
            $table->string('url')->nullable();
            
            // Estado de la operación (success, error, warning)
            $table->string('estado', 20)->default('success');
            
            // Mensaje de error si ocurrió
            $table->text('mensaje_error')->nullable();
            
            // Campos de auditoría
            $table->timestamps();
            
            // Índices para búsquedas rápidas
            $table->index(['user_id', 'accion']);
            $table->index(['tabla', 'registro_id']);
            $table->index('created_at');
            $table->index('accion');
            $table->index('estado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_movimientos');
    }
};