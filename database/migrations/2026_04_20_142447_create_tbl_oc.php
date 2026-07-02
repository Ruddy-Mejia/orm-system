<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_oc', function (Blueprint $table) {
            $table->id();
            $table->string('oc', 50);
            $table->index('oc'); 
            $table->foreignId('proveedor')->constrained('tbl_proveedores')->onDelete('restrict');
            $table->foreignId('forma_pago')->constrained('tbl_forma_pago')->onDelete('restrict');
            $table->foreignId('convenio')->constrained('tbl_convenio')->onDelete('restrict')->nullable();
            $table->integer('plazo_entrega');
            $table->json('det_orm')->nullable();
            $table->string('orm', 15);
            $table->foreign('orm')->references('orm')->on('tbl_orm')->onDelete('cascade');
            $table->decimal('monto_parcial', 15, 2)->default(0);
            $table->decimal('monto_iva', 15, 2)->default(0);
            $table->decimal('monto_total', 15, 2)->default(0);
            $table->decimal('presupuesto', 15, 2)->nullable();
            $table->string('factura', 100)->nullable();
            $table->text('observacion')->nullable();
            $table->decimal('descuentos', 15, 2)->default(0);
            $table->decimal('impuestos', 15, 2)->default(0);
            $table->boolean('status')->default(true);
            $table->integer('cuotas')->default(1);
            $table->boolean('terceros')->default(false);
            $table->string('path_factura', 500)->nullable();
            $table->string('path_pago', 500)->nullable();
            $table->json('autorizaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_oc');
    }
};