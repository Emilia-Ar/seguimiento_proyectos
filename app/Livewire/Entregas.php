<?php
namespace App\Livewire;

use App\Models\Entrega;
use App\Models\Tarea;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Entregas extends Component
{
    use WithPagination;

    public $contenido, $fecha_entrega, $tarea_id, $entrega_id;
    public $isOpen = false;

    public function render()
    {
        return view('livewire.entregas', [
            'entregas' => Entrega::where('user_id', Auth::id())->latest()->paginate(10),
            'tareas' => Tarea::all(),
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
            'contenido' => 'required',
            'fecha_entrega' => 'required|date',
            'tarea_id' => 'required|exists:tareas,id',
        ]);

        Entrega::updateOrCreate(['id' => $this->entrega_id], [
            'contenido' => $this->contenido,
            'fecha_entrega' => $this->fecha_entrega,
            'tarea_id' => $this->tarea_id,
            'user_id' => Auth::id(),
        ]);

        session()->flash('message', $this->entrega_id ? 'Entrega actualizada.' : 'Entrega creada.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $entrega = Entrega::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $this->entrega_id = $id;
        $this->contenido = $entrega->contenido;
        $this->fecha_entrega = $entrega->fecha_entrega;
        $this->tarea_id = $entrega->tarea_id;
        $this->isOpen = true;
    }

    public function delete($id)
    {
        $entrega = Entrega::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $entrega->delete();
        session()->flash('message', 'Entrega eliminada.');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->contenido = '';
        $this->fecha_entrega = '';
        $this->tarea_id = null;
        $this->entrega_id = null;
    }
}