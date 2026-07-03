<?php
// database/factories/MovimientoBodegaFactory.php

namespace Database\Factories;

use App\Models\Bodega;
use App\Models\MovimientoBodega;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovimientoBodegaFactory extends Factory
{
    protected $model = MovimientoBodega::class;

    public function definition(): array
    {
        // Obtener una bodega y producto existentes o crearlos
        $bodega = Bodega::inRandomOrder()->first() ?? Bodega::factory()->create();
        $producto = Producto::inRandomOrder()->first() ?? Producto::factory()->create();
        $usuario = User::inRandomOrder()->first() ?? User::factory()->create();
        
        // Tipos de movimiento
        $tipos = ['ingreso', 'egreso', 'traspaso_salida', 'traspaso_entrada'];
        $tipo = $this->faker->randomElement($tipos);
        
        // Determinar bodegas origen/destino según el tipo
        $bodegaOrigenId = null;
        $bodegaDestinoId = null;
        
        if ($tipo === 'traspaso_salida') {
            $bodegaOrigenId = $bodega->id;
            $bodegaDestinoId = Bodega::where('id', '!=', $bodega->id)
                ->inRandomOrder()
                ->first()?->id ?? Bodega::factory()->create()->id;
        } elseif ($tipo === 'traspaso_entrada') {
            $bodegaDestinoId = $bodega->id;
            $bodegaOrigenId = Bodega::where('id', '!=', $bodega->id)
                ->inRandomOrder()
                ->first()?->id ?? Bodega::factory()->create()->id;
        }
        
        // Cantidades (stock anterior y nuevo)
        $stockAnterior = $this->faker->randomFloat(2, 0, 500);
        $cantidad = $this->faker->randomFloat(2, 1, 100);
        
        // Calcular stock nuevo según el tipo
        $stockNuevo = match($tipo) {
            'ingreso' => $stockAnterior + $cantidad,
            'egreso' => max(0, $stockAnterior - $cantidad),
            'traspaso_salida' => max(0, $stockAnterior - $cantidad),
            'traspaso_entrada' => $stockAnterior + $cantidad,
            default => $stockAnterior + $cantidad,
        };
        
        return [
            'bodega_id' => $bodega->id,
            'producto_id' => $producto->id,
            'tipo' => $tipo,
            'cantidad' => $cantidad,
            'stock_anterior' => $stockAnterior,
            'stock_nuevo' => $stockNuevo,
            'documento' => $this->faker->optional(0.6)->bothify('DOC-####-??'),
            'observacion' => $this->faker->optional(0.4)->sentence(5),
            'usuario_id' => $usuario->id,
            'bodega_origen_id' => $bodegaOrigenId,
            'bodega_destino_id' => $bodegaDestinoId,
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }

    /**
     * Estado para movimientos de ingreso
     */
    public function ingreso(): self
    {
        return $this->state(function (array $attributes) {
            $bodega = Bodega::inRandomOrder()->first() ?? Bodega::factory()->create();
            $producto = Producto::inRandomOrder()->first() ?? Producto::factory()->create();
            $stockAnterior = $this->faker->randomFloat(2, 0, 500);
            $cantidad = $this->faker->randomFloat(2, 1, 100);
            
            return [
                'bodega_id' => $bodega->id,
                'producto_id' => $producto->id,
                'tipo' => 'ingreso',
                'cantidad' => $cantidad,
                'stock_anterior' => $stockAnterior,
                'stock_nuevo' => $stockAnterior + $cantidad,
                'bodega_origen_id' => null,
                'bodega_destino_id' => null,
            ];
        });
    }

    /**
     * Estado para movimientos de egreso
     */
    public function egreso(): self
    {
        return $this->state(function (array $attributes) {
            $bodega = Bodega::inRandomOrder()->first() ?? Bodega::factory()->create();
            $producto = Producto::inRandomOrder()->first() ?? Producto::factory()->create();
            $stockAnterior = $this->faker->randomFloat(2, 10, 500);
            $cantidad = $this->faker->randomFloat(2, 1, min(100, $stockAnterior));
            
            return [
                'bodega_id' => $bodega->id,
                'producto_id' => $producto->id,
                'tipo' => 'egreso',
                'cantidad' => $cantidad,
                'stock_anterior' => $stockAnterior,
                'stock_nuevo' => max(0, $stockAnterior - $cantidad),
                'bodega_origen_id' => null,
                'bodega_destino_id' => null,
            ];
        });
    }

    /**
     * Estado para movimientos de traspaso
     */
    public function traspaso(): self
    {
        return $this->state(function (array $attributes) {
            $bodegaOrigen = Bodega::inRandomOrder()->first() ?? Bodega::factory()->create();
            $bodegaDestino = Bodega::where('id', '!=', $bodegaOrigen->id)
                ->inRandomOrder()
                ->first() ?? Bodega::factory()->create();
            $producto = Producto::inRandomOrder()->first() ?? Producto::factory()->create();
            $stockAnterior = $this->faker->randomFloat(2, 10, 500);
            $cantidad = $this->faker->randomFloat(2, 1, min(100, $stockAnterior));
            
            return [
                'bodega_id' => $bodegaOrigen->id,
                'producto_id' => $producto->id,
                'tipo' => 'traspaso_salida',
                'cantidad' => $cantidad,
                'stock_anterior' => $stockAnterior,
                'stock_nuevo' => max(0, $stockAnterior - $cantidad),
                'bodega_origen_id' => $bodegaOrigen->id,
                'bodega_destino_id' => $bodegaDestino->id,
            ];
        });
    }

    /**
     * Estado para movimientos de traspaso entrada
     */
    public function traspasoEntrada(): self
    {
        return $this->state(function (array $attributes) {
            $bodegaOrigen = Bodega::inRandomOrder()->first() ?? Bodega::factory()->create();
            $bodegaDestino = Bodega::where('id', '!=', $bodegaOrigen->id)
                ->inRandomOrder()
                ->first() ?? Bodega::factory()->create();
            $producto = Producto::inRandomOrder()->first() ?? Producto::factory()->create();
            $stockAnterior = $this->faker->randomFloat(2, 0, 500);
            $cantidad = $this->faker->randomFloat(2, 1, 100);
            
            return [
                'bodega_id' => $bodegaDestino->id,
                'producto_id' => $producto->id,
                'tipo' => 'traspaso_entrada',
                'cantidad' => $cantidad,
                'stock_anterior' => $stockAnterior,
                'stock_nuevo' => $stockAnterior + $cantidad,
                'bodega_origen_id' => $bodegaOrigen->id,
                'bodega_destino_id' => $bodegaDestino->id,
            ];
        });
    }

    /**
     * Estado para un usuario específico
     */
    public function paraUsuario($usuarioId): self
    {
        return $this->state(function (array $attributes) use ($usuarioId) {
            return [
                'usuario_id' => $usuarioId,
            ];
        });
    }

    /**
     * Estado para una bodega específica
     */
    public function paraBodega($bodegaId): self
    {
        return $this->state(function (array $attributes) use ($bodegaId) {
            return [
                'bodega_id' => $bodegaId,
            ];
        });
    }

    /**
     * Estado para un producto específico
     */
    public function paraProducto($productoId): self
    {
        return $this->state(function (array $attributes) use ($productoId) {
            return [
                'producto_id' => $productoId,
            ];
        });
    }

    /**
     * Estado para movimiento con documento
     */
    public function conDocumento(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'documento' => $this->faker->bothify('FAC-####-??'),
            ];
        });
    }

    /**
     * Estado para movimiento sin documento
     */
    public function sinDocumento(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'documento' => null,
            ];
        });
    }
}