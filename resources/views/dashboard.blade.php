<!-- resources/views/dashboard/index.blade.php -->
<h1>Bienvenido, {{ auth()->user()->nombre_completo }}</h1>
<a href="{{ route('solicitar_credito') }}">Solicitar Crédito</a>
