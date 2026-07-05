<?php

namespace App\Livewire\Productos;

use App\Models\Producto;
use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.app')]
class ProductIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $selectedCategory = '';
    public $statusFilter = '';

    public $showEditModal = false;
    public $editingProductId = null;
    public $editNombre = '';
    public $editUnidad = '';
    public $editCategoria = '';
    public $editStatus = true;

    public $showDeleteModal = false;
    public $deletingProductId = null;
    public $deletingProductName = '';

    protected $rules = [
        'editNombre' => 'required|string|max:200',
        'editUnidad' => 'required|string|max:20',
        'editCategoria' => 'required|exists:tbl_categorias,id',
        'editStatus' => 'boolean',
    ];

    protected $messages = [
        'editNombre.required' => 'El nombre del producto es obligatorio',
        'editUnidad.required' => 'La unidad de medida es obligatoria',
        'editCategoria.required' => 'Debe seleccionar una categoría',
    ];

    public function mount()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedCategory()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function openEditModal($id)
    {
        $product = Producto::with('categoriaRel')->findOrFail($id);
        
        $this->editingProductId = $id;
        $this->editNombre = $product->nombre;
        $this->editUnidad = $product->unidad;
        $this->editCategoria = $product->categoria;
        $this->editStatus = $product->status;
        
        $this->showEditModal = true;
    }

    public function updateProduct()
    {
        $this->validate();

        $product = Producto::findOrFail($this->editingProductId);
        
        $product->update([
            'nombre' => $this->editNombre,
            'unidad' => $this->editUnidad,
            'categoria' => $this->editCategoria,
            'status' => $this->editStatus,
        ]);

        $this->showEditModal = false;
        $this->resetEditForm();
        
        $this->dispatch('toast', type: 'success', message: 'Producto actualizado exitosamente');
    }

    public function confirmDelete($id)
    {
        $product = Producto::findOrFail($id);
        $this->deletingProductId = $id;
        $this->deletingProductName = $product->nombre;
        $this->showDeleteModal = true;
    }

    public function deleteProduct()
    {
        $product = Producto::findOrFail($this->deletingProductId);
        $product->delete();

        $this->showDeleteModal = false;
        $this->deletingProductId = null;
        $this->deletingProductName = '';
        
        $this->dispatch('toast', type: 'success', message: 'Producto eliminado exitosamente');
        $this->resetPage();
    }

    public function toggleStatus($id)
    {
        $product = Producto::findOrFail($id);
        $product->status = !$product->status;
        $product->save();

        $statusText = $product->status ? 'activado' : 'desactivado';
        $this->dispatch('toast', type: 'success', message: "Producto {$statusText} exitosamente");
    }

    public function resetEditForm()
    {
        $this->editingProductId = null;
        $this->editNombre = '';
        $this->editUnidad = '';
        $this->editCategoria = '';
        $this->editStatus = true;
    }

    public function render()
    {
        $query = Producto::with('categoriaRel');

        if (!empty($this->search)) {
            $query->where('nombre', 'like', '%' . $this->search . '%');
        }

        if (!empty($this->selectedCategory)) {
            $query->where('categoria', $this->selectedCategory);
        }
        
        if ($this->statusFilter !== '') {
            $query->where('status', $this->statusFilter);
        }

        $products = $query->orderBy('nombre')->paginate($this->perPage);
        
        $categories = Categoria::orderBy('nombre')->get();

        return view('livewire.productos.product-index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}