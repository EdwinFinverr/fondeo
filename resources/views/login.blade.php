<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - Finverr</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 flex justify-between items-center shadow-md">
    <a href="/" class="text-white font-bold text-2xl">Finverr</a>
        <div class="space-x-4">
            <a href="{{ route('register') }}" class="text-white hover:bg-blue-500 px-4 py-2 rounded">Registrarse</a>
            <a href="{{ route('login') }}" class="text-white hover:bg-blue-500 px-4 py-2 rounded">Iniciar sesión</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex flex-grow items-center justify-center">
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg transform transition hover:-translate-y-2">
            <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Iniciar sesión</h2>

            <!-- Mostrar mensaje de error si existe -->
            @if(session('error'))
                <div class="text-red-600 bg-red-100 p-3 mb-4 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">Correo electrónico</label>
                    <input type="email" name="correo_electronico" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Correo electrónico" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Contraseña</label>
                    <input type="password" name="contrasena" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contraseña" required>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">Iniciar sesión</button>
            </form>

            <div class="text-center text-gray-600 text-sm mt-4">
                ¿No tienes cuenta? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Regístrate aquí</a>.
            </div>
        </div>
    </div>

    <!-- Footer -->
    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2025 Finverr. Todos los derechos reservados.</p>
        <p>
            <a href="#" class="text-yellow-400 hover:underline">Términos y Condiciones</a> | 
            <a href="#" class="text-yellow-400 hover:underline">Política de Privacidad</a>
        </p>
    </footer>
    
</body>
</html>
