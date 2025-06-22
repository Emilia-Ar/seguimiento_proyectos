<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProyectoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_entrega' => 'required|date|after:today',
            'estado' => 'required|in:pendiente,en_progreso,completado',
            'categorias' => 'nullable|array|exists:categorias,id',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.max' => 'El título no puede exceder 255 caracteres.',
            'fecha_entrega.required' => 'La fecha de entrega es obligatoria.',
            'fecha_entrega.after' => 'La fecha debe ser posterior a hoy.',
            'estado.required' => 'El estado es obligatorio.',
            'categorias.exists' => 'Las categorías seleccionadas no son válidas.',
        ];
    }
}