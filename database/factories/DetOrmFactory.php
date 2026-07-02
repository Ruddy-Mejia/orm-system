<?php

namespace Database\Factories;

use App\Models\Ciudad;
use App\Models\DetOrm;
use App\Models\Orm;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DetOrm>
 */
class DetOrmFactory extends Factory
{
    protected $model = DetOrm::class;
    
    public function definition(): array
    {
        return [
            // 'orm' => Orm::factory(),
            'orm' => Orm::inRandomOrder()->first()->orm,
            'cantidad' => $this->faker->numberBetween(1,10),
            'detalle' => $this->faker->text(30),
            'producto' => Producto::factory(),
            'procesado' => $this->faker->boolean(80),
            'ciudad' => Ciudad::factory(),            
            'f_estimada' => $this->faker->dateTime(),
            'f_recepcion' => $this->faker->dateTime(),
            'recepcion' => $this->faker->randomElement(['parcial', 'total','S/REC']),
            'cantidad_recepcion' => $this->faker->numberBetween(1,10),  
            'costo' => $this->faker->randomFloat(0,0,200000),  
        ];
    }
}
