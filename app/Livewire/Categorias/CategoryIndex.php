<?php

namespace App\Livewire\Categorias;

use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class CategoryIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    // Propiedades para el modal de edición
    public $showEditModal = false;
    public $editingCategoryId = null;
    public $editNombre = '';
    public $editDescripcion = '';

    // Propiedades para el modal de creación
    public $showCreateModal = false;
    public $createNombre = '';
    public $createDescripcion = '';

    // Propiedades para el modal de eliminación
    public $showDeleteModal = false;
    public $deletingCategoryId = null;
    public $deletingCategoryName = '';

    protected $rules = [
        'editNombre' => 'required|string|max:100',
        'editDescripcion' => 'nullable|string',
    ];

    protected $rulesCreate = [
        'createNombre' => 'required|string|max:100|unique:tbl_categorias,nombre',
        'createDescripcion' => 'nullable|string',
    ];

    protected $messages = [
        'editNombre.required' => 'El nombre de la categoría es obligatorio',
        'createNombre.required' => 'El nombre de la categoría es obligatorio',
        'createNombre.unique' => 'Ya existe una categoría con este nombre',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->showCreateModal = true;
        $this->createNombre = '';
        $this->createDescripcion = '';
    }

    public function createCategory()
    {
        $this->validate($this->rulesCreate);

        Categoria::create([
            'nombre' => $this->createNombre,
            'descripcion' => $this->createDescripcion,
        ]);

        $this->showCreateModal = false;
        $this->resetCreateForm();
        $this->dispatch('toast', type: 'success', message: 'Categoría creada exitosamente');
        $this->resetPage();
    }

    public function openEditModal($id)
    {
        $category = Categoria::findOrFail($id);
        
        $this->editingCategoryId = $id;
        $this->editNombre = $category->nombre;
        $this->editDescripcion = $category->descripcion;
        
        $this->showEditModal = true;
    }

    public function updateCategory()
    {
        $this->validate([
            'editNombre' => 'required|string|max:100|unique:tbl_categorias,nombre,' . $this->editingCategoryId,
            'editDescripcion' => 'nullable|string',
        ]);

        $category = Categoria::findOrFail($this->editingCategoryId);
        
        $category->update([
            'nombre' => $this->editNombre,
            'descripcion' => $this->editDescripcion,
        ]);

        $this->showEditModal = false;
        $this->resetEditForm();
        $this->dispatch('toast', type: 'success', message: 'Categoría actualizada exitosamente');
    }

    public function confirmDelete($id)
    {
        $category = Categoria::findOrFail($id);
        $this->deletingCategoryId = $id;
        $this->deletingCategoryName = $category->nombre;
        $this->showDeleteModal = true;
    }

    public function deleteCategory()
    {
        $category = Categoria::findOrFail($this->deletingCategoryId);
        
        // Verificar si tiene productos asociados
        if ($category->productos()->count() > 0) {
            $this->dispatch('toast', type: 'error', message: 'No se puede eliminar la categoría porque tiene productos asociados');
            $this->showDeleteModal = false;
            return;
        }

        $category->delete();

        $this->showDeleteModal = false;
        $this->deletingCategoryId = null;
        $this->deletingCategoryName = '';
        
        $this->dispatch('toast', type: 'success', message: 'Categoría eliminada exitosamente');
        $this->resetPage();
    }

    public function resetCreateForm()
    {
        $this->createNombre = '';
        $this->createDescripcion = '';
    }

    public function resetEditForm()
    {
        $this->editingCategoryId = null;
        $this->editNombre = '';
        $this->editDescripcion = '';
    }

    public function render()
    {
        $query = Categoria::query();

        if (!empty($this->search)) {
            $query->where('nombre', 'like', '%' . $this->search . '%')
                  ->orWhere('descripcion', 'like', '%' . $this->search . '%');
        }

        $categories = $query->orderBy('nombre')->paginate($this->perPage);

        return view('livewire.categorias.category-index', [
            'categories' => $categories,
        ]);
    }
}