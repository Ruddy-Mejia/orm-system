<?php

namespace App\Livewire\Productos;

use App\Models\Producto;
use App\Models\Categoria;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ProductCreate extends Component
{
    public $nombre = '';
    public $unidad = '';
    public $categoria = '';

    protected $rules = [
        'nombre' => 'required|string|max:200|unique:tbl_productos,nombre',
        'unidad' => 'required|string|max:20',
        'categoria' => 'required|exists:tbl_categorias,id',
    ];

    protected $messages = [
        'nombre.required' => 'El nombre del producto es obligatorio',
        'nombre.unique' => 'Ya existe un producto con este nombre',
        'unidad.required' => 'La unidad de medida es obligatoria',
        'categoria.required' => 'Debe seleccionar una categoría',
    ];

    public function save()
    {
        $this->validate();

        Producto::create([
            'nombre' => $this->nombre,
            'unidad' => $this->unidad,
            'categoria' => $this->categoria,
            'status' => true,
        ]);

        $this->dispatch('toast', type: 'success', message: 'Producto creado exitosamente');
        
        return redirect()->route('products.index');
    }

    public function render()
    {
        return view('livewire.productos.product-create', [
            'categories' => Categoria::orderBy('nombre')->get(),
        ]);
    }
}