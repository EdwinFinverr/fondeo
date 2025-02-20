<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Crédito - Finverr</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 flex justify-between items-center shadow-md">
        <div class="text-white text-xl font-bold">Finverr</div>
        <div class="space-x-4">
            <a href="{{ route('solicitante') }}" class="text-white hover:bg-blue-500 px-4 py-2 rounded">Inicio</a>
            <a href="{{ route('logout') }}" class="text-white hover:bg-blue-500 px-4 py-2 rounded">Cerrar sesión</a>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="flex flex-col items-center justify-center flex-1 px-6 py-10 text-center">
        <h1 class="text-3xl font-semibold text-blue-600 mb-4">Bienvenido, {{ Auth::user()->nombre_completo }}!</h1>
        <p class="text-lg text-gray-600 mb-6">¿Listo para solicitar tu crédito? Presiona el botón para empezar.</p>
        <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg text-lg shadow-md transition transform hover:scale-105" onclick="openModal()">Solicitar Crédito</button>
    </main>

    <!-- Modal de Requisitos -->
    <div id="requisitosModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 max-w-md text-center">
            <h2 class="text-2xl text-blue-600 font-semibold mb-4">Requisitos para Solicitar Crédito</h2>
            <p class="text-gray-700 mb-4">Debes cumplir con los siguientes requisitos:</p>
            <ul class="text-left text-gray-600 space-y-2 mb-4">
                <li>✅ Un terreno cuyo valor sea el doble del crédito solicitado.</li>
                <li>✅ Documentación requerida:</li>
                <ul class="ml-5 list-disc">
                    <li>Escrituras del terreno a tu nombre.</li>
                    <li>Avalúo reciente del terreno.</li>
                    <li>Identificación oficial.</li>
                    <li>Comprobante de domicilio.</li>
                </ul>
            </ul>
            <div class="flex justify-around mt-6">
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition transform hover:scale-105" onclick="confirmarRequisitos()">Cumplo con los requisitos</button>
                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition transform hover:scale-105" onclick="salir()">No cumplo, salir</button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2025 Finverr. Todos los derechos reservados.</p>
        <p>
            <a href="#" class="text-yellow-400 hover:underline">Términos y Condiciones</a> | 
            <a href="#" class="text-yellow-400 hover:underline">Política de Privacidad</a>
        </p>
    </footer>

    <script>
        function openModal() {
            document.getElementById('requisitosModal').classList.remove('hidden');
        }

        function confirmarRequisitos() {
            window.location.href = "{{ route('simulador.credito') }}"; 
        }

        function salir() {
            window.location.href = "{{ route('solicitante') }}";
        }
    </script>

</body>
</html>
