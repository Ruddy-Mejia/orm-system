<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 200);
            $table->string('unidad', 20);
            $table->foreignId('categoria')->constrained('tbl_categorias');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_productos');
    }
};