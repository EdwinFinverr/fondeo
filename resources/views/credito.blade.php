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
        <div class="text-white text-xl font-bold">Finverr</div>
        <div class="space-x-4">
            <a href="{{ route('solicitante') }}" class="text-white hover:bg-blue-500 px-4 py-2 rounded">Inicio</a>
            <a href="{{ route('logout') }}" class="text-white hover:bg-blue-500 px-4 py-2 rounded">Cerrar sesión</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-2xl max-w-4xl">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Solicitud de Crédito</h2>

    <form action="{{ route('credito.enviar') }}" method="POST" enctype="multipart/form-data" id="solicitudForm">
        @csrf

        <!-- Sección A: Datos Personales -->
        <h3 class="text-lg font-semibold text-gray-700">A) Datos Personales</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="nombre" placeholder="Nombre Completo" class="input-field" required>
            <input type="text" name="rfc" placeholder="RFC" class="input-field" required>
            <input type="text" name="curp" placeholder="CURP" class="input-field" required>
            <input type="tel" name="telefono" placeholder="Teléfono de Contacto" class="input-field" required>
            <input type="email" name="email" placeholder="Correo Electrónico" class="input-field" required>
            <select name="estado_civil" class="input-field" required>
                <option value="">Estado Civil</option>
                <option value="Soltero">Soltero</option>
                <option value="Casado">Casado</option>
                <option value="Divorciado">Divorciado</option>
            </select>
        </div>

        <!-- Sección B: Datos del Terreno -->
        <h3 class="text-lg font-semibold text-gray-700 mt-6">B) Datos del Terreno</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="ubicacion" placeholder="Ubicación Exacta" class="input-field" required>
            <input type="number" name="superficie" placeholder="Superficie del Terreno (m²)" class="input-field" required>
            <input type="text" name="uso_suelo" placeholder="Uso de Suelo" class="input-field" required>
            <input type="number" name="valor_comercial" placeholder="Valor Comercial ($)" class="input-field" required>
            <input type="text" name="propietario" placeholder="Propietario en Escrituras" class="input-field" required>
        </div>

        <!-- Subida de Documentos -->
        <div class="mt-4">
            <label class="block font-semibold text-gray-700">Escrituras del terreno:</label>
            <input type="file" name="escrituras" accept=".pdf,.jpg,.png" class="file-input" required>

            <label class="block font-semibold text-gray-700 mt-4">Avalúo reciente:</label>
            <input type="file" name="avaluo" accept=".pdf,.jpg,.png" class="file-input" required>

            <label class="block font-semibold text-gray-700 mt-4">Comprobante de domicilio:</label>
            <input type="file" name="comprobante_domicilio" accept=".pdf,.jpg,.png" class="file-input" required>
        </div>

        <!-- Sección C: Información del Crédito -->
        <h3 class="text-lg font-semibold text-gray-700 mt-6">C) Información del Crédito</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="number" name="monto_solicitado"  class="input-field " placeholder="Monto solicitado "  >
            <input type="number" name="plazo"  class="input-field "placeholder="Destino del financiamiento "  >
            <input type="text" name="fuente_pago" placeholder="Fuente de Pago" class="input-field" required>
            <textarea name="destino" placeholder="Destino del Financiamiento" class="input-field" rows="2" required></textarea>
        </div>

        <!-- Sección D: Documentación Adicional -->
        <h3 class="text-lg font-semibold text-gray-700 mt-6">D) Documentación Adicional</h3>
        <div class="mt-4">
            <label class="block font-semibold text-gray-700">Identificación oficial (INE o pasaporte):</label>
            <input type="file" name="ine_pasaporte" accept=".pdf,.jpg,.png" class="file-input" required>

            <label class="block font-semibold text-gray-700 mt-4">Comprobante de ingresos:</label>
            <input type="file" name="comprobante_ingresos" accept=".pdf,.jpg,.png" class="file-input" required>

            <label class="block font-semibold text-gray-700 mt-4">Declaración de impuestos (si aplica):</label>
            <input type="file" name="declaracion_impuestos" accept=".pdf,.jpg,.png" class="file-input">
        </div>

        <!-- Sección E: Confirmación y Envío -->
        <h3 class="text-lg font-semibold text-gray-700 mt-6">E) Confirmación y Envío</h3>
        <div class="mt-4">
            <label class="flex items-center">
                <input type="checkbox" id="terminos" class="mr-2">
                <span>Acepto los términos y condiciones</span>
            </label>
        </div>

        <button type="submit" class="w-full p-3 mt-4 bg-green-600 text-white rounded-lg hover:bg-green-700 transition" disabled id="enviarBtn">
            Enviar Solicitud
        </button>
    </form>
</div>

<!-- Estilos -->
<style>
    .input-field { @apply w-full p-2 border rounded-lg focus:ring focus:ring-blue-300; }
    .file-input { @apply block w-full p-2 border rounded-lg mt-2 bg-gray-100; }
</style>

<!-- Script para activar el botón de envío -->
<script>
    document.getElementById("terminos").addEventListener("change", function() {
        document.getElementById("enviarBtn").disabled = !this.checked;
    });
</script>

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
