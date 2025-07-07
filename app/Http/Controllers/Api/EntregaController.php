<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Entrega;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EntregaController extends Controller
{
    /**
     * @group Entregas
     * Listar todas las entregas
     * @authenticated
     * @response 200 [{"id":1,"tarea_id":1,"archivo":"archivo.pdf","estado":"pendiente","fecha_entrega":"2025-07-07","created_at":"2025-07-07T09:00:00.000000Z","updated_at":"2025-07-07T09:00:00.000000Z"}]
     */
    public function index(): JsonResponse
    {
        $entregas = Entrega::where('user_id', auth()->id())->get();
        return response()->json($entregas);
    }

    /**
     * @group Entregas
     * Crear una nueva entrega
     * @authenticated
     * @bodyParam tarea_id integer required El ID de la tarea asociada. Example: 1
     * @bodyParam archivo string required El nombre del archivo subido. Example: archivo.pdf
     * @bodyParam estado string required El estado de la entrega (pendiente, aprobada, rechazada). Example: pendiente
     * @bodyParam fecha_entrega date required La fecha de entrega. Example: 2025-07-07
     * @response 201 {"id":1,"tarea_id":1,"archivo":"archivo.pdf","estado":"pendiente","fecha_entrega":"2025-07-07","user_id":1,"created_at":"2025-07-07T09:00:00.000000Z","updated_at":"2025-07-07T09:00:00.000000Z"}
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'tarea_id' => 'required|exists:tareas,id',
            'archivo' => 'required|string|max:255',
            'estado' => 'required|in:pendiente,aprobada,rechazada',
            'fecha_entrega' => 'required|date',
        ]);

        $entrega = Entrega::create([
            'tarea_id' => $request->tarea_id,
            'archivo' => $request->archivo,
            'estado' => $request->estado,
            'fecha_entrega' => $request->fecha_entrega,
            'user_id' => auth()->id(),
        ]);

        return response()->json($entrega, 201);
    }

    /**
     * @group Entregas
     * Mostrar una entrega específica
     * @authenticated
     * @urlParam id integer required El ID de la entrega. Example: 1
     * @response 200 {"id":1,"tarea_id":1,"archivo":"archivo.pdf","estado":"pendiente","fecha_entrega":"2025-07-07","user_id":1,"created_at":"2025-07-07T09:00:00.000000Z","updated_at":"2025-07-07T09:00:00.000000Z"}
     */
    public function show(Entrega $entrega): JsonResponse
    {
        if ($entrega->user_id !== auth()->id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }
        return response()->json($entrega);
    }

    /**
     * @group Entregas
     * Actualizar una entrega
     * @authenticated
     * @urlParam id integer required El ID de la entrega. Example: 1
     * @bodyParam tarea_id integer required El ID de la tarea asociada. Example: 1
     * @bodyParam archivo string required El nombre del archivo subido. Example: archivo.pdf
     * @bodyParam estado string required El estado de la entrega (pendiente, aprobada, rechazada). Example: aprobada
     * @bodyParam fecha_entrega date required La fecha de entrega. Example: 2025-07-07
     * @response 200 {"id":1,"tarea_id":1,"archivo":"archivo.pdf","estado":"aprobada","fecha_entrega":"2025-07-07","user_id":1,"created_at":"2025-07-07T09:00:00.000000Z","updated_at":"2025-07-07T09:00:00.000000Z"}
     */
    public function update(Request $request, Entrega $entrega): JsonResponse
    {
        if ($entrega->user_id !== auth()->id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $request->validate([
            'tarea_id' => 'required|exists:tareas,id',
            'archivo' => 'required|string|max:255',
            'estado' => 'required|in:pendiente,aprobada,rechazada',
            'fecha_entrega' => 'required|date',
        ]);

        $entrega->update($request->only(['tarea_id', 'archivo', 'estado', 'fecha_entrega']));
        return response()->json($entrega);
    }

    /**
     * @group Entregas
     * Eliminar una entrega
     * @authenticated
     * @urlParam id integer required El ID de la entrega. Example: 1
     * @response 204 {}
     */
    public function destroy(Entrega $entrega): JsonResponse
    {
        if ($entrega->user_id !== auth()->id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $entrega->delete();
        return response()->json(null, 204);
    }
}