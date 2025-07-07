<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index()
    {
        return Proyecto::with('profesor', 'estudiantes')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after:fecha_inicio',
            'profesor_id' => 'required|exists:profesores,id',
        ]);

        $proyecto = Proyecto::create($request->all());
        return response()->json($proyecto, 201);
    }

    public function show(Proyecto $proyecto) {
        return $proyecto->load('profesor', 'estudiantes');
    }

    public function update(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after:fecha_inicio',
            'profesor_id' => 'required|exists:profesores,id',
        ]);

        $proyecto->update($request->all());
        return response()->json($proyecto, 200);
    }

    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();
        return response()->json(null, 204);
    }
}