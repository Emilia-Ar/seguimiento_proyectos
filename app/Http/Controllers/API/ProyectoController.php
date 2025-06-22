<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProyectoRequest;
use App\Http\Resources\ProyectoResource;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $proyectos = Proyecto::where('usuario_id', auth()->id())->with('categorias')->get();
        return ProyectoResource::collection($proyectos);
    }

    public function store(ProyectoRequest $request)
    {
        $proyecto = Proyecto::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_entrega' => $request->fecha_entrega,
            'estado' => $request->estado,
            'usuario_id' => auth()->id(),
        ]);
        $proyecto->categorias()->sync($request->categorias);
        return new ProyectoResource($proyecto);
    }

    public function show(Proyecto $proyecto)
    {
        $this->authorize('view', $proyecto);
        return new ProyectoResource($proyecto->load('categorias'));
    }

    public function update(ProyectoRequest $request, Proyecto $proyecto)
    {
        $this->authorize('update', $proyecto);
        $proyecto->update($request->validated());
        $proyecto->categorias()->sync($request->categorias);
        return new ProyectoResource($proyecto);
    }

    public function destroy(Proyecto $proyecto)
    {
        $this->authorize('delete', $proyecto);
        $proyecto->delete();
        return response()->json(['mensaje' => 'Proyecto eliminado con éxito.'], 200);
    }
}
