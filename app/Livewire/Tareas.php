<?php
namespace App\Livewire;

use App\Models\Proyecto;
use App\Models\Tarea;
use Livewire\Component;
use Livewire\WithPagination;

class Tareas extends Component
{
    use WithPagination;

    public $titulo, $descripcion, $fecha_limite, $proyecto_id, $tarea_id;
    public $isOpen = false;

    public function render()
    {
        return view('livewire.tareas', [
            'tareas' => Tarea::latest()->paginate(10),
            'proyectos' => Proyecto::all(),
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
            'titulo' => 'required|string|max:255',
            'fecha_limite' => 'required|date',
            'proyecto_id' => 'required|exists:proyectos,id',
        ]);

        Tarea::updateOrCreate(['id' => $this->tarea_id], [
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'fecha_limite' => $this->fecha_limite,
            'proyecto_id' => $this->proyecto_id,
        ]);

        session()->flash('message', $this->tarea_id ? 'Tarea actualizada.' : 'Tarea creada.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $tarea = Tarea::findOrFail($id);
        $this->tarea_id = $id;
        $this->titulo = $tarea->titulo;
        $this->descripcion = $tarea->descripcion;
        $this->fecha_limite = $tarea->fecha_limite;
        $this->proyecto_id = $tarea->proyecto_id;
        $this->isOpen = true;
    }

    public function delete($id)
    {
        Tarea::find($id)->delete();
        session()->flash('message', 'Tarea eliminada.');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->titulo = '';
        $this->descripcion = '';
        $this->fecha_limite = '';
        $this->proyecto_id = null;
        $this->tarea_id = null;
    }
}