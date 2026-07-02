<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_cdc', function (Blueprint $table) {
            $table->id();
            $table->string('cdc', 20);
            $table->string('descripcion')->nullable();
            $table->string('banco')->nullable();
            $table->string('tipo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_cdc');
    }
};