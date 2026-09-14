<?php

namespace App\Livewire\RRHH\Person;

use App\Models\Person;
use App\Helpers\HistorialHelper;
use Livewire\Component;
use App\Rules\RutChileno;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class PersonEdit extends Component
{
    public $personId;
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

    protected function rules()
    {
        return [
            'rut' => ['required', new RutChileno, 'unique:tbl_person,rut,' . $this->personId],
            'nombres' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'required|string|max:50',
            'fecha_nacimiento' => 'required|date|before:today',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'nacionalidad' => 'required|string|max:50',
            'estado_civil' => 'required|in:casado,soltero',
            'email' => 'required|email|unique:tbl_person,email,' . $this->personId,
            'telefono' => 'required|string|max:15',
            'cargo' => 'required|string|max:100',
            'fecha_ingreso' => 'required|date',
            'empresa' => 'required|in:Empresa1,Empresa2',
            'sitio' => 'required',
        ];
    }

    public function mount($id)
    {
        $this->personId = $id;
        $this->loadPerson();
    }

    public function loadPerson()
    {
        $person = Person::findOrFail($this->personId);
        $this->rut = $person->rut;
        $this->nombres = $person->nombres;
        $this->apellido_paterno = $person->apellido_paterno;
        $this->apellido_materno = $person->apellido_materno;
        $this->fecha_nacimiento = $person->fecha_nacimiento;
        $this->genero = $person->genero;
        $this->direccion = $person->direccion;
        $this->ciudad = $person->ciudad;
        $this->nacionalidad = $person->nacionalidad;
        $this->estado_civil = $person->estado_civil;
        $this->email = $person->email;
        $this->telefono = $person->telefono;
        $this->cargo = $person->cargo;
        $this->fecha_ingreso = $person->fecha_ingreso;
        $this->empresa = $person->empresa;
        $this->sitio = $person->sitio;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // public function update()
    // {
    //     $validatedData = $this->validate();

    //     $person = Person::findOrFail($this->personId);
    //     $person->update($validatedData);

    //     session()->flash('success', 'Persona actualizada exitosamente.');

    //     return redirect()->route('personas.index');
    // }
    public function update()
    {
        $validatedData = $this->validate();

        try {
            // Obtener la persona antes de actualizar
            $person = Person::findOrFail($this->personId);
            $oldData = $person->toArray();

            // Actualizar la persona
            $person->update($validatedData);

            // Obtener la persona actualizada
            $personUpdated = Person::findOrFail($this->personId);
            $newData = $personUpdated->toArray();

            // Detectar qué campos cambiaron
            $camposCambiados = [];
            $descripcionCampos = [];
            foreach ($oldData as $key => $value) {
                if (isset($newData[$key]) && $value != $newData[$key]) {
                    $camposCambiados[] = $key;
                    $descripcionCampos[] = $key . ' (' . (is_null($value) ? 'NULL' : $value) . ' → ' . (is_null($newData[$key]) ? 'NULL' : $newData[$key]) . ')';
                }
            }

            // Construir descripción detallada
            $nombreCompleto = $newData['nombres'] . ' ' . $newData['apellido_paterno'] . ' ' . $newData['apellido_materno'];
            $descripcion = 'Se actualizó la persona: ' . $nombreCompleto . ' (RUT: ' . $newData['rut'] . ')';
            if (!empty($descripcionCampos)) {
                $descripcion .= ' - Campos modificados: ' . implode(', ', $descripcionCampos);
            }

            // Registrar en el historial - ACTUALIZACIÓN
            HistorialHelper::updated(
                'tbl_person',
                $this->personId,
                $oldData,
                $newData,
                $descripcion
            );

            session()->flash('success', 'Persona actualizada exitosamente.');
            return redirect()->route('personas.index');
        } catch (\Exception $e) {
            // Registrar el error en el historial
            HistorialHelper::error(
                'Error al actualizar persona: ' . $e->getMessage(),
                'tbl_person',
                $this->personId,
                [
                    'error' => $e->getMessage(),
                    'person_id' => $this->personId,
                    'datos_intentados' => $validatedData ?? null,
                ]
            );

            session()->flash('error', 'Error al actualizar la persona: ' . $e->getMessage());
            return redirect()->route('personas.index');
        }
    }

    public function cancel()
    {
        return redirect()->route('personas.index');
    }

    public function render()
    {
        return view('livewire.rrhh.person.person-edit');
    }
}
