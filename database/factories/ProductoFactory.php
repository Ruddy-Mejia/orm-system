<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categoria;

class ProductoFactory extends Factory
{
    protected static $contador = 0;
    
    public function definition(): array
    {
        self::$contador++;
        
        $categoria = Categoria::inRandomOrder()->first();
        $nombreCategoria = $categoria ? $categoria->nombre : 'Insumos Mineros';
        
        $productosBase = [
            'Insumos Mineros' => [
                'Bola de Molienda', 'Forro de Molino', 'Cal Viva', 'Carbón Activado',
                'Cianuro de Sodio', 'Ácido Sulfúrico', 'Floculante', 'Reactivo',
                'Malla Zaranda', 'Cinta Transportadora', 'Bomba de Lodos'
            ],
            'Herramientas Industriales' => [
                'Taladro Percutor', 'Amoladora Angular', 'Sierra Circular', 
                'Compresor de Aire', 'Hidrolavadora', 'Soldadora Inverter',
                'Andamio', 'Polipasto Eléctrico', 'Motobomba'
            ],
            'Equipos de Seguridad' => [
                'Casco Industrial', 'Lente de Seguridad', 'Guante de Cuero',
                'Chaleco Reflectante', 'Arnés de Seguridad', 'Extintor PQS',
                'Mascarilla 3M', 'Botín de Seguridad', 'Señalética'
            ],
            'Materiales de Construcción' => [
                'Cemento', 'Hierro Corrugado', 'Ladrillo', 'Bloque de Hormigón',
                'Grava', 'Arena Fina', 'Yeso', 'Mortero', 'Pintura Látex',
                'Cerámica', 'Aislante Térmico', 'Viga de Acero'
            ],
            'Equipos Eléctricos' => [
                'Cable THHN', 'Interruptor Termomagnético', 'Tablero Eléctrico',
                'Transformador', 'Generador', 'Lámpara LED', 'Sensor de Movimiento',
                'Variador de Velocidad', 'Contactor', 'Relé Térmico'
            ],
            'Lubricantes y Combustibles' => [
                'Aceite Hidráulico', 'Grasa Litio', 'Combustible Diésel',
                'Aceite de Motor', 'Lubricante Industrial', 'Refrigerante',
                'Queroseno', 'Solvente', 'Petróleo'
            ],
            'Oficina y Administración' => [
                'Resma de Papel', 'Tóner Impresora', 'Carpeta Oficio',
                'Silla Ergonómica', 'Escritorio Ejecutivo', 'Archivador',
                'Perforadora', 'Grapadora', 'Calculadora', 'Pizarra'
            ]
        ];
        
        $lista = $productosBase[$nombreCategoria] ?? $productosBase['Insumos Mineros'];
        $base = $this->faker->randomElement($lista);
        
        // Agregar variantes para hacerlo único
        $variantes = [
            '',
            ' ' . $this->faker->randomElement(['Industrial', 'Premium', 'Pro', 'Plus', 'Eco']),
            ' ' . $this->faker->randomElement(['1/2"', '1"', '2"', '100mm', '200mm']),
            ' ' . $this->faker->randomElement(['Serie A', 'Serie B', 'HD', 'Xtreme']),
            ' ' . $this->faker->randomNumber(3)
        ];
        
        $nombre = $base . $this->faker->randomElement($variantes);
        
        // Asegurar unicidad
        $nombre = $nombre . ' ' . self::$contador;
        
        $unidades = ['Bola' => 'TON', 'Forro' => 'UND', 'Cal' => 'TON', 'Carbón' => 'KG',
            'Cianuro' => 'KG', 'Ácido' => 'LTS', 'Floculante' => 'KG', 'Malla' => 'MTS',
            'Cinta' => 'MTS', 'Bomba' => 'UND', 'Taladro' => 'UND', 'Amoladora' => 'UND',
            'Sierra' => 'UND', 'Compresor' => 'UND', 'Hidrolavadora' => 'UND', 
            'Soldadora' => 'UND', 'Andamio' => 'UND', 'Polipasto' => 'UND',
            'Casco' => 'UND', 'Lente' => 'PAR', 'Guante' => 'PAR', 'Chaleco' => 'UND',
            'Arnés' => 'UND', 'Extintor' => 'UND', 'Mascarilla' => 'UND', 'Botín' => 'PAR',
            'Cemento' => 'BOLSA', 'Hierro' => 'BARRA', 'Ladrillo' => 'UND', 
            'Bloque' => 'UND', 'Grava' => 'TON', 'Arena' => 'TON', 'Yeso' => 'BOLSA',
            'Mortero' => 'BOLSA', 'Pintura' => 'GAL', 'Cerámica' => 'M2', 
            'Aislante' => 'M2', 'Viga' => 'UND', 'Cable' => 'MTS', 
            'Interruptor' => 'UND', 'Tablero' => 'UND', 'Transformador' => 'UND',
            'Generador' => 'UND', 'Lámpara' => 'UND', 'Sensor' => 'UND',
            'Variador' => 'UND', 'Contactor' => 'UND', 'Relé' => 'UND',
            'Aceite' => 'LTS', 'Grasa' => 'KG', 'Combustible' => 'LTS',
            'Lubricante' => 'LTS', 'Refrigerante' => 'LTS', 'Queroseno' => 'LTS',
            'Solvente' => 'LTS', 'Petróleo' => 'LTS', 'Resma' => 'RESMA',
            'Tóner' => 'UND', 'Carpeta' => 'UND', 'Silla' => 'UND', 
            'Escritorio' => 'UND', 'Archivador' => 'UND', 'Perforadora' => 'UND',
            'Grapadora' => 'UND', 'Calculadora' => 'UND', 'Pizarra' => 'UND'
        ];
        
        $unidad = 'UND';
        foreach ($unidades as $clave => $u) {
            if (stripos($nombre, $clave) !== false) {
                $unidad = $u;
                break;
            }
        }
        
        return [
            'nombre' => $nombre,
            'unidad' => $unidad,
            'categoria' => $categoria ? $categoria->id : 1,
            'status' => $this->faker->boolean(90),
        ];
    }
}