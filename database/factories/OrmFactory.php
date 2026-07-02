<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Orm;
use App\Models\User;
use App\Models\Cdc;
use App\Models\Adn;
use App\Models\Sitio;

class OrmFactory extends Factory
{
    protected $model = Orm::class;
    protected static $secuencia = 0;
    public function definition(): array
    {
        $year = date('Y');
        self::$secuencia++;
        
        // Obtener el último ID usado
        $ultimo = Orm::orderBy('id', 'desc')->first();
        $ultimoId = $ultimo ? $ultimo->id : 0;
        $nuevoId = $ultimoId + self::$secuencia;
        
        return [
            'orm' => 'ORM' . $nuevoId . '-' . $year,
            'responsable' => User::factory(),
            'comprador' => User::factory(),
            'cdc' => Cdc::factory(),
            'adn' => Adn::factory(),
            'sitio' => Sitio::factory(),
            'status' => $this->faker->boolean(80),
            'terceros' => $this->faker->boolean(30),
            'tipo' => $this->faker->randomElement(['Administrativa', 'OTI', 'Faena', 'Mantenimiento']),
            'prioridad' => $this->faker->randomElement(['sin prioridad', 'normal', 'emergencia']),
            'descripcion' => $this->faker->text(40),
            'patente' => $this->faker->optional(0.3)->regexify('[A-Z]{2}-[A-Z]{2}-[0-9]{2}'),
            'archivo' => $this->faker->optional(0.2)->filePath(),
            'obs_costos' => $this->faker->optional(0.5)->sentence(),
            'obs_orm' => $this->faker->optional(0.7)->paragraph(),
            'obs_bodega' => $this->faker->optional(0.4)->sentence(),
        ];
    }
}