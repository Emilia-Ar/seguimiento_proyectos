<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Panel de Control
                    </h2>
                    <table class="w-full bg-white shadow-md rounded">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-2 text-left">Proyecto</th>
                                <th class="p-2 text-left">Tarea</th>
                                <th class="p-2 text-left">Entrega</th>
                                <th class="p-2 text-left">Usuario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\App\Models\Proyecto::with('tareas.entregas.user')->get() as $proyecto)
                                @foreach ($proyecto->tareas as $tarea)
                                    @foreach ($tarea->entregas as $entrega)
                                        <tr>
                                            <td class="p-2">{{ $proyecto->nombre }}</td>
                                            <td class="p-2">{{ $tarea->titulo }}</td>
                                            <td class="p-2">{{ \Str::limit($entrega->contenido, 50) }}</td>
                                            <td class="p-2">{{ $entrega->user->name }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
