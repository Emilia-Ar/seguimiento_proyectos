<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proyectos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal min-h-screen">

    <!-- Barra superior -->
    <nav class="bg-white border-b border-gray-200 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="text-xl font-semibold text-gray-800">
                <a href="{{ route('proyectos.index') }}">Inicio</a>
            </div>
            <div>
                {{-- Puedes agregar enlaces o autenticación aquí --}}
                @auth
                    <span class="text-gray-600 mr-4">Hola, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button class="text-red-600 hover:underline" type="submit">Cerrar sesión</button>
                    </form>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Iniciar sesión</a>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="py-8">
        @yield('content')
    </main>

    <!-- Pie de página -->
    <footer class="text-center text-sm text-gray-500 py-4">
        © {{ date('Y') }} Gestión de Proyectos. Todos los derechos reservados.
    </footer>

</body>
</html>
