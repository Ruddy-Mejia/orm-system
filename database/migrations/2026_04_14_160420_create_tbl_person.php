<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_person', function (Blueprint $table) {
            $table->id();
            $table->string('rut', 12)->unique();
            $table->string('nombres', 100);
            $table->string('apellido_paterno', 50);
            $table->string('apellido_materno', 50);
            $table->date('fecha_nacimiento');
            $table->enum('genero', ['Masculino', 'Femenino', 'Otro']);
            $table->string('direccion', 255);
            $table->string('ciudad', 100);
            $table->string('nacionalidad', 50);
            $table->enum('estado_civil', ['casado', 'soltero']);
            $table->string('email', 100)->unique();
            $table->string('telefono', 20);
            $table->string('cargo', 100);
            $table->date('fecha_ingreso');
            $table->enum('empresa', ['Empresa1', 'Empresa2']);
            $table->foreignId('sitio_id')->nullable()->constrained('tbl_sitios')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_person');
    }
};