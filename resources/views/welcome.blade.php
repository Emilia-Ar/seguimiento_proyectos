<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistema de Seguimiento de Proyectos Escolares">
    <title>Sistema de Proyectos Escolares</title>
    <!-- Tailwind CSS desde CDN para simplicidad -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Opcional: Estilos personalizados -->
    <style>
        .bg-school {
            background: linear-gradient(135deg, #1E40AF 0%, #10B981 100%);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex items-center justify-center bg-school">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Bienvenido al Sistema de Proyectos Escolares</h1>
            <p class="text-gray-600 mb-6">Gestiona tus proyectos y tareas escolares de manera eficiente.</p>

            <!-- Mostrar opciones según el estado de autenticación -->
            @auth
                <a href="{{ route('dashboard') }}" class="bg-school-blue text-white px-4 py-2 rounded-md hover:bg-blue-600 mb-2 inline-block w-full">Ir al Panel</a>
                <a href="{{ route('proyectos.index') }}" class="bg-school-green text-white px-4 py-2 rounded-md hover:bg-green-600 mb-2 inline-block w-full">Ver Proyectos</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 w-full">Cerrar Sesión</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="bg-school-blue text-white px-4 py-2 rounded-md hover:bg-blue-600 mb-2 inline-block w-full">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="bg-school-green text-white px-4 py-2 rounded-md hover:bg-green-600 mb-2 inline-block w-full">Registrarse</a>
            @endauth

            <p class="text-sm text-gray-500 mt-4">© {{ date('Y') }} Sistema de Proyectos Escolares. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>