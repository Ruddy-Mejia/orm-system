<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_bodega_producto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bodega')->constrained('tbl_bodegas');
            $table->foreignId('producto')->constrained('tbl_productos');
            $table->float('cantidad', 12, 4);
            $table->timestamps();
            
            $table->unique(['bodega', 'producto']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_bodega_producto');
    }
};