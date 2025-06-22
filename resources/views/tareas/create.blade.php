<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Tarea
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('tareas.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                                <input id="nombre" name="nombre" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('nombre') }}">
                                @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="proyecto_id" class="block text-sm font-medium text-gray-700">Proyecto</label>
                                <select id="proyecto_id" name="proyecto_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    @foreach ($proyectos as $proyecto)
                                        <option value="{{ $proyecto->id }}" {{ old('proyecto_id') == $proyecto->id ? 'selected' : '' }}>{{ $proyecto->titulo }}</option>
                                    @endforeach
                                </select>
                                @error('proyecto_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea id="descripcion" name="descripcion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('descripcion') }}</textarea>
                            @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mt-4">
                            <label for="prioridad" class="block text-sm font-medium text-gray-700">Prioridad</label>
                            <select id="prioridad" name="prioridad" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="baja" {{ old('prioridad') == 'baja' ? 'selected' : '' }}>Baja</option>
                                <option value="media" {{ old('prioridad') == 'media' ? 'selected' : '' }}>Media</option>
                                <option value="alta" {{ old('prioridad') == 'alta' ? 'selected' : '' }}>Alta</option>
                            </select>
                            @error('prioridad') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mt-4">
                            <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                            <select id="estado" name="estado" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="en_progreso" {{ old('estado') == 'en_progreso' ? 'selected' : '' }}>En Progreso</option>
                                <option value="completado" {{ old('estado') == 'completado' ? 'selected' : '' }}>Completado</option>
                            </select>
                            @error('estado') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="mt-4 bg-school-blue text-white px-4 py-2 rounded-md hover:bg-blue-600">Guardar Tarea</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>