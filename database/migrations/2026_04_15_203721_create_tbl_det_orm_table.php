<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_det_orm', function (Blueprint $table) {
            $table->id();
            $table->string('orm', 15);
            $table->foreign('orm')->references('orm')->on('tbl_orm')->onDelete('cascade');
            $table->decimal('cantidad', 12, 2);
            $table->string('detalle', 200)->nullable();
            $table->foreignId('producto')->constrained('tbl_productos');
            $table->boolean('procesado')->default(false);                        
            $table->boolean('bodega')->default(false);
            $table->foreignId('ciudad')->nullable()->constrained('tbl_ciudades');
            $table->date('f_estimada')->nullable();
            $table->date('f_recepcion')->nullable();
            $table->enum('recepcion', ['parcial', 'total', 'S/REC'])->default('S/REC');
            $table->decimal('cantidad_recepcion', 12, 2)->default(0);
            $table->decimal('costo', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_det_orm');
    }
};