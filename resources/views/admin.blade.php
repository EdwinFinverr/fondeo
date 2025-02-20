<!-- resources/views/admin/index.blade.php -->
<h1>Solicitudes de Crédito</h1>
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Monto</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach($solicitudes as $solicitud)
        <tr>
            <td>{{ $solicitud->usuario->nombre_completo }}</td>
            <td>{{ $solicitud->monto }}</td>
            <td>{{ $solicitud->estado }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
