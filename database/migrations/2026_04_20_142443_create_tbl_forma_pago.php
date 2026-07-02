<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_forma_pago', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 255);
            $table->boolean('status')->default(true);
            $table->boolean('autopago')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_forma_pago');
    }
};