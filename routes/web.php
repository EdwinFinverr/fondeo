
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

// Página de inicio - Redirige al formulario de registro
Route::get('/', function () {
    return view('welcome');
});


Route::get('/solicitante', [AuthController::class, 'showSolicitarCreditoPage'])->middleware('auth')->name('solicitante');

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// Rutas de verificación de correo
Route::get('/verify/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');

// Dashboard - solo para usuarios autenticados
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/simulador', function () {
        return view('simulador');
    })->name('simulador.credito');
    
    Route::get('/simulador', [AuthController::class, 'simulador'])->name('simulador.credito');
    Route::post('/simular-credito', [AuthController::class, 'simularCredito'])->name('credito.simular');
    Route::post('/credito/solicitud', [AuthController::class, 'solicitud'])->name('credito.solicitud');
    Route::post('/credito', [AuthController::class, 'credito'])->name('credito.enviar');
    Route::view('credito', 'credito')->name('credito');
});

// Rutas para el administrador - solo para administradores autenticados
Route::middleware(['auth', 'verificar.rol:administrador'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/solicitudes', [AdminController::class, 'verSolicitudes'])->name('admin.solicitudes');
    Route::get('/admin/solicitud/{id}', [AdminController::class, 'verSolicitudDetalle'])->name('admin.solicitud.detalle');
    Route::post('/admin/actualizar-solicitud/{id}', [AdminController::class, 'actualizarSolicitud'])->name('admin.actualizar.solicitud');
});

// Registrar nuevo usuario - registro y verificación
Route::get('/registro', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/registro', [AuthController::class, 'register'])->name('register.submit');


