<?php
namespace App\Http\Controllers;

use App\Http\Requests\TareaRequest;
use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tareas = Tarea::where('usuario_id', auth()->id())->get();
        return view('tareas.index', compact('tareas'));
    }

    public function create()
    {
        return view('tareas.create');
    }

    public function store(TareaRequest $request)
    {
        Tarea::create($request->validated() + ['usuario_id' => auth()->id()]);
        return redirect()->route('tareas.index')->with('mensaje', 'Tarea creada con éxito.');
    }

    public function edit(Tarea $tarea)
    {
        $this->authorize('update', $tarea);
        return view('tareas.edit', compact('tarea'));
    }

    public function update(TareaRequest $request, Tarea $tarea)
    {
        $this->authorize('update', $tarea);
        $tarea->update($request->validated());
        return redirect()->route('tareas.index')->with('mensaje', 'Tarea actualizada con éxito.');
    }

    public function destroy(Tarea $tarea)
    {
        $this->authorize('delete', $tarea);
        $tarea->delete();
        return redirect()->route('tareas.index')->with('mensaje', 'Tarea eliminada con éxito.');
    }
}