<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_movimientos_bodega', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('bodega_id');
            $table->unsignedBigInteger('producto_id');
            
            $table->enum('tipo', ['ingreso', 'egreso', 'traspaso_salida', 'traspaso_entrada']);
            $table->float('cantidad', 12, 4);
            $table->float('stock_anterior', 12, 4);
            $table->float('stock_nuevo', 12, 4);
            
            $table->string('documento')->nullable();
            $table->string('documento_path')->nullable();
            $table->string('observacion')->nullable();
            $table->unsignedBigInteger('usuario_id')->nullable();
            
            $table->unsignedBigInteger('bodega_origen_id')->nullable();
            $table->unsignedBigInteger('bodega_destino_id')->nullable();
            
            $table->timestamps();
            
            $table->foreign('bodega_id')
                  ->references('id')
                  ->on('tbl_bodegas')
                  ->onDelete('cascade');
                  
            $table->foreign('producto_id')
                  ->references('id')
                  ->on('tbl_productos')
                  ->onDelete('cascade');
                  
            $table->foreign('usuario_id')
                  ->references('id')
                  ->on('tbl_users')
                  ->onDelete('set null');
                  
            $table->foreign('bodega_origen_id')
                  ->references('id')
                  ->on('tbl_bodegas')
                  ->onDelete('set null');
                  
            $table->foreign('bodega_destino_id')
                  ->references('id')
                  ->on('tbl_bodegas')
                  ->onDelete('set null');
            
            $table->index(['bodega_id', 'producto_id']);
            $table->index('tipo');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_movimientos_bodega');
    }
};