<?php

namespace App\Livewire\RRHH\Person;

use App\Models\Person;
use App\Models\Sitio;
use Livewire\Component;
use App\Rules\RutChileno;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class PersonCreate extends Component
{
    public $rut = '';
    public $nombres = '';
    public $apellido_paterno = '';
    public $apellido_materno = '';
    public $fecha_nacimiento = '';
    public $genero = '';
    public $direccion = '';
    public $ciudad = '';
    public $nacionalidad = '';
    public $estado_civil = '';
    public $email = '';
    public $telefono = '';
    public $cargo = '';
    public $fecha_ingreso = '';
    public $empresa = '';
    public $sitio = '';
    public $sitios = [];

    protected $rules = [
        // 'rut' => ['required', new RutChileno, 'unique:tbl_person,rut'],
        'nombres' => 'required|string|max:100',
        'apellido_paterno' => 'required|string|max:50',
        'apellido_materno' => 'required|string|max:50',
        'fecha_nacimiento' => 'required|date|before:today',
        'genero' => 'required|in:Masculino,Femenino,Otro',
        'direccion' => 'required|string|max:255',
        'ciudad' => 'required|string|max:100',
        'nacionalidad' => 'required|string|max:50',
        'estado_civil' => 'required|in:casado,soltero',
        'email' => 'required|email|unique:tbl_person,email',
        'telefono' => 'required|string|max:15',
        'cargo' => 'required|string|max:100',
        'fecha_ingreso' => 'required|date',
        'empresa' => 'required|in:,Empresa2',
        'sitio' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validatedData = $this->validate();
        
        Person::create($validatedData);
        
        session()->flash('success', 'Persona creada exitosamente.');
        
        return redirect()->route('personas.index');
    }

    public function cancel()
    {
        return redirect()->route('personas.index');
    }

    public function render()
    {
        $this->sitios = Sitio::all();
        return view('livewire.rrhh.person.person-create');
    }
}