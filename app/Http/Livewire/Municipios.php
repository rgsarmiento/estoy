<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\Municipalitie;
use Livewire\Component;

class Municipios extends Component
{

    public $departamento=null, $ciudad=null;
    public $ciudades=null;

    public function render()
    {
        
        return view('livewire.municipios', [
            'departamentos' => Department::orderBy('name', 'asc')->get()
        ]);
    }
    //se usa updated + la propiedad
    public function updateddepartamento($id)
    {
        $this->ciudades = Municipalitie::where('department_id', $id)->get();
    }

}
