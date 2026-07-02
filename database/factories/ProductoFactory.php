<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categoria;

class ProductoFactory extends Factory
{
    public function definition(): array
    {
        // Lista de productos realistas por categoría
        $productosPorCategoria = [
            'Insumos Mineros' => [
                'Bolas de Molienda', 'Forros de Molino', 'Cal viva', 'Cal hidratada',
                'Cianuro de sodio', 'Carbón activado', 'Floculante', 'Ácido sulfúrico',
                'Reactivos de flotación', 'Espumante', 'Colector', 'Depresor',
                'Malla zaranda', 'Celdas de flotación', 'Cinta transportadora'
            ],
            'Herramientas Industriales' => [
                'Taladro percutor', 'Amoladora angular', 'Sierra circular', 'Compresor de aire',
                'Hidrolavadora', 'Soldadora inverter', 'Andamio industrial', 'Escalera telescópica',
                'Gata hidráulica', 'Polipasto eléctrico', 'Lima rotativa', 'Cepillo eléctrico'
            ],
            'Equipos de Seguridad' => [
                'Casco industrial', 'Lentes de seguridad', 'Guantes de cuero', 'Guantes de nitrilo',
                'Chaleco reflectante', 'Arnés de seguridad', 'Línea de vida', 'Cono de seguridad',
                'Extintor PQS', 'Señalética', 'Tapones auditivos', 'Mascarilla 3M', 'Botín de seguridad'
            ],
            'Materiales de Construcción' => [
                'Cemento', 'Hierro corrugado', 'Ladrillos', 'Bloques de hormigón',
                'Grava', 'Arena fina', 'Yeso', 'Mortero preparado', 'Pintura látex',
                'Cerámica piso', 'Cerámica muro', 'Aislante térmico', 'Vigas de acero'
            ],
            'Equipos Eléctricos' => [
                'Cable THHN 12 AWG', 'Interruptor termomagnético', 'Tablero eléctrico', 'Transformador',
                'Generador eléctrico', 'Medidor de energía', 'Protector de tensión', 'Contacto inteligente',
                'Lámpara LED', 'Tubo fluorescente', 'Balasto electrónico', 'Sensor de movimiento'
            ],
            'Lubricantes y Combustibles' => [
                'Aceite hidráulico ISO 46', 'Grasa litio', 'Combustible diésel', 'Gasolina 93',
                'Aceite de motor 15W40', 'Lubricante industrial', 'Refrigerante', 'Biodiésel',
                'Queroseno', 'Solvente industrial', 'Petróleo crudo'
            ],
            'Servicios Técnicos' => [
                'Mantenimiento preventivo', 'Calibración instrumentos', 'Análisis de aceite',
                'Certificación equipos', 'Inspección técnica', 'Pruebas de carga', 'Muestreo de fluidos'
            ],
            'Oficina y Administración' => [
                'Resma de papel', 'Tóner impresora', 'Carpetas oficio', 'Notas adhesivas',
                'Silla ergonómica', 'Escritorio ejecutivo', 'Archivador', 'Perforadora',
                'Grapadora industrial', 'Calculadora científica', 'Pizarra acrílica'
            ]
        ];
        
        // Obtener categoría aleatoria
        $categoria = Categoria::inRandomOrder()->first();
        $nombreCategoria = $categoria ? $categoria->nombre : 'Insumos Mineros';
        
        // Obtener lista de productos de esa categoría o usar genérico
        $listaProductos = $productosPorCategoria[$nombreCategoria] ?? $productosPorCategoria['Insumos Mineros'];
        
        // Unidades por tipo de producto
        $unidades = [
            'Bolas de Molienda' => 'TON',
            'Forros de Molino' => 'UND',
            'Cal viva' => 'TON',
            'Cianuro de sodio' => 'KG',
            'Carbón activado' => 'KG',
            'Taladro percutor' => 'UND',
            'Casco industrial' => 'UND',
            'Cemento' => 'BOLSA',
            'Cable THHN 12 AWG' => 'MTS',
            'Aceite hidráulico ISO 46' => 'LTS',
            'Resma de papel' => 'RESMA',
            'default' => 'UND'
        ];
        
        $productoBase = $this->faker->randomElement($listaProductos);
        $unidad = $unidades[$productoBase] ?? $unidades['default'];
        
        // Agregar variantes (medida, color, especificación)
        $especificaciones = [
            'Industrial', 'Pro', 'Plus', 'Eco', 'Premium', 'Standard',
            'Alta resistencia', 'Grado alimenticio', 'Antiácido', 'Reforzado'
        ];
        
        $nombreCompleto = $productoBase;
        if ($this->faker->boolean(40)) {
            $nombreCompleto .= ' ' . $this->faker->randomElement($especificaciones);
        }
        
        // Agregar medida si aplica
        $medidas = ['1/2"', '1"', '2"', '5/8"', '3/4"', '100mm', '150mm', '200mm'];
        if ($this->faker->boolean(30)) {
            $nombreCompleto .= ' ' . $this->faker->randomElement($medidas);
        }
        
        return [
            'nombre' => $nombreCompleto,
            'unidad' => $unidad,
            'categoria' => $categoria ? $categoria->id : 1,
            'status' => $this->faker->boolean(90),
        ];
    }
}