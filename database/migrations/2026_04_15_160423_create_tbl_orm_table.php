<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_orm', function (Blueprint $table) {
            $table->id();
            $table->string('orm', 15)->unique();
            $table->foreignId('responsable')->constrained('tbl_users');
            $table->foreignId('comprador')->nullable()->constrained('tbl_users');
            $table->foreignId('cdc')->constrained('tbl_cdc');
            $table->foreignId('adn')->constrained('tbl_adn');
            $table->foreignId('sitio')->constrained('tbl_sitios');
            $table->boolean('status')->default(false);
            $table->boolean('terceros')->default(false);
            $table->enum('tipo', ['Administrativa', 'OTI', 'Faena', 'Mantenimiento'])->default(null)->nullable();
            $table->enum('prioridad', ['sin prioridad', 'normal', 'emergencia'])->default('sin prioridad');
            $table->string('descripcion', 255)->nullable();
            $table->string('patente', 20)->nullable();
            $table->string('archivo')->nullable();
            $table->text('obs_costos')->nullable();
            $table->text('obs_orm')->nullable();
            $table->text('obs_bodega')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_orm');
    }
};