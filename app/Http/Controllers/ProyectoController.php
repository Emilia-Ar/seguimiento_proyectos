<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProyectoRequest;
use App\Models\Proyecto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $proyectos = Proyecto::where('user_id', auth()->id())->with('categorias')->get();
        return view('proyectos.index', compact('proyectos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('proyectos.create', compact('categorias'));
    }

    public function store(ProyectoRequest $request)
    {
        $proyecto = Proyecto::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_entrega' => $request->fecha_entrega,
            'estado' => $request->estado,
            'user_id' => auth()->id(), // ✅ Corregido aquí
        ]);

        $proyecto->categorias()->sync($request->categorias);

        return redirect()->route('proyectos.index')->with('mensaje', 'Proyecto creado con éxito.');
    }

    public function edit(Proyecto $proyecto)
    {
        $this->authorize('update', $proyecto);
        $categorias = Categoria::all();
        return view('proyectos.edit', compact('proyecto', 'categorias'));
    }

    public function update(ProyectoRequest $request, Proyecto $proyecto)
    {
        $this->authorize('update', $proyecto);
        $proyecto->update($request->validated());
        $proyecto->categorias()->sync($request->categorias);
        return redirect()->route('proyectos.index')->with('mensaje', 'Proyecto actualizado con éxito.');
    }

    public function destroy(Proyecto $proyecto)
    {
        $this->authorize('delete', $proyecto);
        $proyecto->delete();
        return redirect()->route('proyectos.index')->with('mensaje', 'Proyecto eliminado con éxito.');
    }
}
