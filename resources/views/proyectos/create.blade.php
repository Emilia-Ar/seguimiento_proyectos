@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-semibold mb-6">Crear Proyecto</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('proyectos.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="titulo" class="block font-medium text-gray-700">Título</label>
            <input type="text" name="titulo" id="titulo" class="w-full border rounded px-3 py-2" value="{{ old('titulo') }}" required>
        </div>

        <div>
            <label for="fecha_entrega" class="block font-medium text-gray-700">Fecha de entrega</label>
            <input type="date" name="fecha_entrega" id="fecha_entrega" class="w-full border rounded px-3 py-2" value="{{ old('fecha_entrega') }}" required>
        </div>

        <div>
            <label for="descripcion" class="block font-medium text-gray-700">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="4" class="w-full border rounded px-3 py-2">{{ old('descripcion') }}</textarea>
        </div>

        <div>
            <label for="estado" class="block font-medium text-gray-700">Estado</label>
            <select name="estado" id="estado" class="w-full border rounded px-3 py-2" required>
                <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="en progreso" {{ old('estado') == 'en progreso' ? 'selected' : '' }}>En progreso</option>
                <option value="completado" {{ old('estado') == 'completado' ? 'selected' : '' }}>Completado</option>
            </select>
        </div>

        <div>
            <label class="block font-medium text-gray-700 mb-2">Categorías</label>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                @foreach ($categorias as $categoria)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="categorias[]" value="{{ $categoria->id }}" class="form-checkbox"
                            {{ in_array($categoria->id, old('categorias', [])) ? 'checked' : '' }}>
                        <span class="ml-2">{{ $categoria->nombre }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="flex flex-wrap gap-4 pt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Crear Proyecto</button>
            <a href="{{ route('proyectos.index') }}" class="text-gray-700 hover:underline">Cancelar</a>
        </div>
    </form>
</div>
@endsection

