<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Gestión de Proyectos</h1>

    <!-- Formulario -->
    <form wire:submit.prevent="guardar" class="mb-6 bg-white p-6 rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                <input wire:model="titulo" id="titulo" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('titulo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="fecha_entrega" class="block text-sm font-medium text-gray-700">Fecha de Entrega</label>
                <input wire:model="fecha_entrega" id="fecha_entrega" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('fecha_entrega') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mt-4">
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea wire:model="descripcion" id="descripcion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
            @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
            <select wire:model="estado" id="estado" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="pendiente">Pendiente</option>
                <option value="en_progreso">En Progreso</option>
                <option value="completado">Completado</option>
            </select>
            @error('estado') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="mt-4 bg-school-blue text-white px-4 py-2 rounded-md hover:bg-blue-600">Guardar Proyecto</button>
    </form>

    <!-- Tabla de Proyectos -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">Título</th>
                    <th class="px-4 py-2 text-left">Fecha de Entrega</th>
                    <th class="px-4 py-2 text-left">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proyectos as $proyecto)
                    <tr>
                        <td class="border px-4 py-2">{{ $proyecto->titulo }}</td>
                        <td class="border px-4 py-2">{{ $proyecto->fecha_entrega }}</td>
                        <td class="border px-4 py-2">{{ $proyecto->estado }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if (session('mensaje'))
        <div class="mt-4 p-4 bg-school-green text-white rounded-md">
            {{ session('mensaje') }}
        </div>
    @endif
</div>
