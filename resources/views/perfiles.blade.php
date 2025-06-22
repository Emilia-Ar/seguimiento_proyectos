<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Perfiles de Desarrolladores
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Desarrollador 1 -->
                        <div class="bg-white rounded-lg shadow-md p-6 text-center">
                            <div class="w-24 h-24 mx-auto rounded-full bg-gray-200 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h3 class="mt-4 text-lg font-semibold">Nombre Desarrollador 1</h3>
                            <p class="text-gray-600">Rol: Desarrollador Backend</p>
                            <p class="mt-2 text-sm text-gray-500">Responsable del desarrollo de la API y la lógica del servidor.</p>
                        </div>
                        <!-- Desarrollador 2 -->
                        <div class="bg-white rounded-lg shadow-md p-6 text-center">
                            <div class="w-24 h-24 mx-auto rounded-full bg-gray-200 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h3 class="mt-4 text-lg font-semibold">Nombre Desarrollador 2</h3>
                            <p class="text-gray-600">Rol: Desarrollador Frontend</p>
                            <p class="mt-2 text-sm text-gray-500">Encargado del diseño responsive y componentes Livewire.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>