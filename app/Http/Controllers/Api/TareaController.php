<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TareaController extends Controller
{
    /**
     * @group Tareas
     * Listar todas las tareas
     * @authenticated
     * @response 200 [{"id":1,"nombre":"Tarea 1","descripcion":"Descripción","estado":"pendiente","proyecto_id":1,"created_at":"2025-07-07T09:00:00.000000Z","updated_at":"2025-07-07T09:00:00.000000Z"}]
     */
    public function index(): JsonResponse
    {
        $tareas = Tarea::where('user_id', auth()->id())->get();
        return response()->json($tareas);
    }

    /**
     * @group Tareas
     * Crear una nueva tarea
     * @authenticated
     * @bodyParam nombre string required El nombre de la tarea. Example: Tarea 1
     * @bodyParam descripcion string La descripción de la tarea. Example: Descripción de la tarea
     * @bodyParam estado string required El estado de la tarea (pendiente, en_progreso, completada). Example: pendiente
     * @bodyParam proyecto_id integer required El ID del proyecto asociado. Example: 1
     * @response 201 {"id":1,"nombre":"Tarea 1","descripcion":"Descripción","estado":"pendiente","proyecto_id":1,"user_id":1,"created_at":"2025-07-07T09:00:00.000000Z","updated_at":"2025-07-07T09:00:00.000000Z"}
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:pendiente,en_progreso,completada',
            'proyecto_id' => 'required|exists:proyectos,id',
        ]);

        $tarea = Tarea::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
            'proyecto_id' => $request->proyecto_id,
            'user_id' => auth()->id(),
        ]);

        return response()->json($tarea, 201);
    }

    /**
     * @group Tareas
     * Mostrar una tarea específica
     * @authenticated
     * @urlParam id integer required El ID de la tarea. Example: 1
     * @response 200 {"id":1,"nombre":"Tarea 1","descripcion":"Descripción","estado":"pendiente","proyecto_id":1,"user_id":1,"created_at":"2025-07-07T09:00:00.000000Z","updated_at":"2025-07-07T09:00:00.000000Z"}
     */
    public function show(Tarea $tarea): JsonResponse
    {
        if ($tarea->user_id !== auth()->id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }
        return response()->json($tarea);
    }

    /**
     * @group Tareas
     * Actualizar una tarea
     * @authenticated
     * @urlParam id integer required El ID de la tarea. Example: 1
     * @bodyParam nombre string required El nombre de la tarea. Example: Tarea Actualizada
     * @bodyParam descripcion string La descripción de la tarea. Example: Nueva descripción
     * @bodyParam estado string required El estado de la tarea (pendiente, en_progreso, completada). Example: completada
     * @bodyParam proyecto_id integer required El ID del proyecto asociado. Example: 1
     * @response 200 {"id":1,"nombre":"Tarea Actualizada","descripcion":"Nueva descripción","estado":"completada","proyecto_id":1,"user_id":1,"created_at":"2025-07-07T09:00:00.000000Z","updated_at":"2025-07-07T09:00:00.000000Z"}
     */
    public function update(Request $request, Tarea $tarea): JsonResponse
    {
        if ($tarea->user_id !== auth()->id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:pendiente,en_progreso,completada',
            'proyecto_id' => 'required|exists:proyectos,id',
        ]);

        $tarea->update($request->only(['nombre', 'descripcion', 'estado', 'proyecto_id']));
        return response()->json($tarea);
    }

    /**
     * @group Tareas
     * Eliminar una tarea
     * @authenticated
     * @urlParam id integer required El ID de la tarea. Example: 1
     * @response 204 {}
     */
    public function destroy(Tarea $tarea): JsonResponse
    {
        if ($tarea->user_id !== auth()->id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $tarea->delete();
        return response()->json(null, 204);
    }
}