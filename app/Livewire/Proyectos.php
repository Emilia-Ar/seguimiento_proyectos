<?php
namespace App\Livewire;

use App\Models\Proyecto;
use Livewire\Component;
use Livewire\WithPagination;

class Proyectos extends Component
{
    use WithPagination;

    public $nombre, $descripcion, $fecha_inicio, $fecha_fin, $proyecto_id;
    public $isOpen = false;

    public function render()
    {
        return view('livewire.proyectos', [
            'proyectos' => Proyecto::latest()->paginate(10),
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_fin.required' => 'La fecha de fin es obligatoria.',
            'fecha_fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
        ]);

        Proyecto::updateOrCreate(['id' => $this->proyecto_id], [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
        ]);

        session()->flash('message', $this->proyecto_id ? 'Proyecto actualizado correctamente.' : 'Proyecto creado correctamente.');
        $this->closeModal();
    }

    public function edit($id)
    {
        try {
            $proyecto = Proyecto::findOrFail($id);
            $this->proyecto_id = $id;
            $this->nombre = $proyecto->nombre;
            $this->descripcion = $proyecto->descripcion;
            $this->fecha_inicio = $proyecto->fecha_inicio->format('Y-m-d');
            $this->fecha_fin = $proyecto->fecha_fin->format('Y-m-d');
            $this->isOpen = true;
        } catch (\Exception $e) {
            session()->flash('error', 'Error al cargar el proyecto: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            Proyecto::findOrFail($id)->delete();
            session()->flash('message', 'Proyecto eliminado correctamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar el proyecto: ' . $e->getMessage());
        }
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->nombre = '';
        $this->descripcion = '';
        $this->fecha_inicio = '';
        $this->fecha_fin = '';
        $this->proyecto_id = null;
    }
}