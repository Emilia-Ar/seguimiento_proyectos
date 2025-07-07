<div>
    <div class="mb-4">
        <button wire:click="create" class="bg-blue-500 text-white px-4 py-2 rounded flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nuevo Proyecto
        </button>
    </div>
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif
    <table class="w-full bg-white shadow-md rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 text-left">Nombre</th>
                <th class="p-2 text-left">Descripción</th>
                <th class="p-2 text-left">Fecha Inicio</th>
                <th class="p-2 text-left">Fecha Fin</th>
                <th class="p-2 text-left">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyectos as $proyecto)
                <tr>
                    <td class="p-2">{{ $proyecto->nombre }}</td>
                    <td class="p-2">{{ \Str::limit($proyecto->descripcion, 50) }}</td>
                    <td class="p-2">{{ $proyecto->fecha_inicio }}</td>
                    <td class="p-2">{{ $proyecto->fecha_fin ?? 'No definida' }}</td>
                    <td class="p-2">
                        <button wire:click="edit({{ $proyecto->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Editar
                        </button>
                        <button wire:click="delete({{ $proyecto->id }})" class="bg-red-500 text-white px-2 py-1 rounded flex items-center mt-1">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            Eliminar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $proyectos->links() }}
    </div>
    @if ($isOpen)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
                <h2 class="text-lg font-bold mb-4">{{ $proyecto_id ? 'Editar Proyecto' : 'Nuevo Proyecto' }}</h2>
                <form wire:submit.prevent="store">
                    <div class="mb-4">
                        <label class="block">Nombre</label>
                        <input type="text" wire:model="nombre" class="w-full p-2 border rounded">
                        @error('nombre') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block">Descripción</label>
                        <textarea wire:model="descripcion" class="w-full p-2 border rounded"></textarea>
                        @error('descripcion') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block">Fecha de Inicio</label>
                        <input type="date" wire:model="fecha_inicio" class="w-full p-2 border rounded">
                        @error('fecha_inicio') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block">Fecha de Fin</label>
                        <input type="date" wire:model="fecha_fin" class="w-full p-2 border rounded">
                        @error('fecha_fin') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
