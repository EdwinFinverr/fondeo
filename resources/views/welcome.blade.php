<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido | Finverr</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-100 text-gray-800">
    
    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 flex justify-between items-center shadow-md">
    <a href="/" class="text-white font-bold text-2xl">Finverr</a>
        <div class="space-x-4">
            <a href="{{ route('register') }}" class="text-white hover:bg-blue-500 px-4 py-2 rounded">Registrarse</a>
            <a href="{{ route('login') }}" class="text-white hover:bg-blue-500 px-4 py-2 rounded">Iniciar sesión</a>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="flex flex-col items-center justify-center flex-1 px-6 py-10 text-center">
        <h1 class="text-4xl font-bold text-blue-600 mb-4">¡Finverr te Fondea!</h1>
        <p class="text-lg text-gray-600 mb-6">Tu mejor opción para gestionar tus créditos de manera fácil y segura.</p>
        <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg text-lg shadow-md transition transform hover:scale-105">Comenzar</a>
    </main>

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
