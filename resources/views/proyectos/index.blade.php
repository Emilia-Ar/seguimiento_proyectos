@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12 px-4">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Gestión de Proyectos</h2>

    <a href="{{ route('proyectos.create') }}" class="mb-6 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Crear Proyecto
    </a>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Título</th>
                    <th class="px-4 py-2 text-left">Fecha de Entrega</th>
                    <th class="px-4 py-2 text-left">Estado</th>
                    <th class="px-4 py-2 text-left">Categorías</th>
                    <th class="px-4 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proyectos as $proyecto)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $proyecto->titulo }}</td>
                        <td class="px-4 py-2">{{ $proyecto->fecha_entrega }}</td>
                        <td class="px-4 py-2">{{ ucfirst($proyecto->estado) }}</td>
                        <td class="px-4 py-2">
                            @foreach ($proyecto->categorias as $categoria)
                                <span>{{ $categoria->nombre }}@if (!$loop->last), @endif</span>
                            @endforeach
                        </td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('proyectos.edit', $proyecto) }}" class="text-blue-600 hover:underline">Editar</a>
                            <form action="{{ route('proyectos.destroy', $proyecto) }}" method="POST" class="inline" onsubmit="return confirm('¿Seguro que quieres eliminar este proyecto?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if (session('mensaje'))
        <div class="mt-4 p-4 bg-green-500 text-white rounded-md">
            {{ session('mensaje') }}
        </div>
    @endif
</div>
@endsection
