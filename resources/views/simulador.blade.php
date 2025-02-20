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
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-2xl max-w-3xl">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">Simulador de Crédito</h2>
    <form id="simuladorForm" class="space-y-4">
        @csrf
        <div>
            <label for="monto" class="font-semibold text-gray-700">Monto del Crédito</label>
            <input type="number" id="monto" name="monto" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required min="1000000" max="4000000">
            <p class="text-sm text-gray-500">Monto entre 1,000,000 y 4,000,000</p>
        </div>
        <div>
            <label for="plazo" class="font-semibold text-gray-700">Plazo (meses)</label>
            <input type="number" id="plazo" name="plazo" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required min="1" max="60">
            <p class="text-sm text-gray-500">Plazo entre 1 y 60 meses</p>
        </div>
        <div>
            <label for="tasa" class="font-semibold text-gray-700">Tasa de Interés Anual (%)</label>
            <input type="number" id="tasa" name="tasa" class="w-full p-2 border rounded-lg bg-gray-100" value="24.00" readonly>
        </div>
        <div>
            <label for="tasa_mensual" class="font-semibold text-gray-700">Tasa de Interés Mensual (%)</label>
            <input type="text" id="tasa_mensual" class="w-full p-2 border rounded-lg bg-gray-100" value="2.00 %" readonly>
        </div>
        <button type="button" class="w-full p-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition" onclick="calcularSimulacion()">Calcular</button>
    </form>

    <h3 class="text-xl font-bold text-gray-800 mt-6 text-center">Resultado de la Simulación</h3>
    <div class="overflow-x-auto mt-4">
        <table class="w-full table-auto border-collapse bg-white shadow-md rounded-lg">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="p-2">No.</th>
                    <th class="p-2">Cap. Inicial</th>
                    <th class="p-2">Interés</th>
                    <th class="p-2">Amortización</th>
                    <th class="p-2">Pago Total</th>
                    <th class="p-2">Cap. Final</th>
                </tr>
            </thead>
            <tbody id="tablaResultados" class="text-center text-gray-700"></tbody>
        </table>
    </div>

    <form action="{{ route('credito.solicitud') }}" method="POST" id="creditoForm" class="hidden mt-6">
        @csrf
        <input type="hidden" name="monto" id="montoCredito">
        <input type="hidden" name="plazo" id="plazoCredito">
        <input type="hidden" name="tasa" id="tasaCredito">
        <button type="submit" class="w-full p-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Confirmar Simulación y Continuar</button>
    </form>
</div>

<script>
    function calcularSimulacion() {
        let monto = document.getElementById('monto').value;
        let plazo = document.getElementById('plazo').value;
        let tasa = 24.00; // Fijo en 24%
        
        // Validar monto
        if (monto < 1000000 || monto > 4000000) {
            alert("El monto debe estar entre 1,000,000 y 4,000,000.");
            return;
        }

        // Validar plazo
        if (plazo < 1 || plazo > 60) {
            alert("El plazo debe estar entre 1 y 60 meses.");
            return;
        }

        fetch("{{ route('credito.simular') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({ monto, plazo, tasa })
        })
        .then(response => response.json())
        .then(data => {
            let tabla = document.querySelector('#tablaResultados');
            tabla.innerHTML = '';

            data.forEach(row => {
                let fila = `<tr class="border-b">
                    <td class="p-2">${row.num}</td>
                    <td class="p-2">$${row.cap_inicial}</td>
                    <td class="p-2">$${row.interes}</td>
                    <td class="p-2">$${row.amortizacion}</td>
                    <td class="p-2">$${row.pago_total}</td>
                    <td class="p-2">$${row.cap_final}</td>
                </tr>`;
                tabla.innerHTML += fila;
            });

            document.getElementById('montoCredito').value = monto;
            document.getElementById('plazoCredito').value = plazo;
            document.getElementById('tasaCredito').value = tasa;
            document.getElementById('creditoForm').classList.remove('hidden');
        })
        .catch(error => console.error('Error:', error));
    }
</script>



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


