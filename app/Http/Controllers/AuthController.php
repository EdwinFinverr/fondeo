<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\VerificacionCuenta;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificacionCorreo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function showRegistrationForm()
{
    return view('registrarse');
}

public function register(Request $request)
{
    $request->validate([
        'nombre_completo' => 'required|string|max:255',
        'correo_electronico' => 'required|email|unique:usuarios',
        'telefono' => 'required|string|max:20',
        'contrasena' => 'required|string|min:8|confirmed',
    ]);

    $usuario = Usuario::create([
        'nombre_completo' => $request->nombre_completo,
        'correo_electronico' => $request->correo_electronico,
        'telefono' => $request->telefono,
        'contrasena' => bcrypt($request->contrasena),
        'estado' => 'pendiente', // Estado inicial
    ]);

    $token = Str::random(60);
    VerificacionCuenta::create([
        'usuario_id' => $usuario->id,
        'token' => $token,
    ]);

    Mail::to($usuario->correo_electronico)->send(new VerificacionCorreo($token));

    return redirect()->route('login')->with('status', 'Verifica tu correo antes de iniciar sesión.');
}
public function verifyEmail($token)
{
    $verificacion = VerificacionCuenta::where('token', $token)->first();

    if (!$verificacion) {
        return redirect()->route('login')->with('error', 'Token no válido o ya expirado.');
    }

    $usuario = Usuario::find($verificacion->usuario_id);
    $usuario->estado = 'activo';
    $usuario->save();

    $verificacion->delete();

    return redirect()->route('login')->with('status', 'Tu cuenta ha sido verificada. Ahora puedes iniciar sesión.');
}

public function logout()
{
    Auth::logout(); // Cierra la sesión del usuario
    return redirect()->route('login')->with('status', 'Has cerrado sesión con éxito.');
}
public function showLoginForm()
    {
        return view('login'); // Esto asume que tienes una vista llamada 'login.blade.php' en la carpeta 'resources/views/auth'
    }

    public function login(Request $request)
{
    $request->validate([
        'correo_electronico' => 'required|email',
        'contrasena' => 'required'
    ]);

    // Buscar usuario por correo
    $usuario = Usuario::where('correo_electronico', $request->correo_electronico)->first();

    if (!$usuario) {
        return redirect()->route('login')->with('error', 'Las credenciales no son válidas.');
    }

    // Verificar si la cuenta está activa
    if ($usuario->estado !== 'activo') {
        return redirect()->route('login')->with('error', 'Debes verificar tu correo antes de iniciar sesión.');
    }

    // Validar la contraseña con Hash::check
    if (!Hash::check($request->contrasena, $usuario->contrasena)) {
        return redirect()->route('login')->with('error', 'Las credenciales no son válidas.');
    }

    // Autenticar usuario manualmente
    Auth::login($usuario);

    // Redirigir a home y pasar el nombre del usuario
    if (Auth::check()) {
        return redirect()->route('solicitante')->with('nombre', Auth::user()->nombre_completo);  
    }

    // Si no está autenticado, redirige a la vista del dashboard
    return redirect()->route('dashboard');
}

public function showSolicitarCreditoPage()
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            // Obtener el usuario autenticado
            $usuario = Auth::user();
            // Pasar el usuario a la vista
            return view('solicitante', ['usuario' => $usuario]);
        }

        // Si el usuario no está autenticado, redirigir a la página de login
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para continuar.');
    }

    public function simulador()
    {
        return view('simulador');
    }
    

    public function simularCredito(Request $request)
    {
        $monto = $request->input('monto');
        $plazo = $request->input('plazo');
        $tasaAnual = $request->input('tasa') / 100;
        $tasaMensual = $tasaAnual / 12;
        $pagoMensual = $monto * ($tasaMensual / (1 - pow(1 + $tasaMensual, -$plazo)));

        $saldo = $monto;
        $tabla = [];

        for ($i = 1; $i <= $plazo; $i++) {
            $interes = $saldo * $tasaMensual;
            $amortizacion = $pagoMensual - $interes;
            $nuevoSaldo = $saldo - $amortizacion;

            $tabla[] = [
                'num' => $i,
                'cap_inicial' => number_format($saldo, 2),
                'interes' => number_format($interes, 2),
                'amortizacion' => number_format($amortizacion, 2),
                'pago_total' => number_format($pagoMensual, 2),
                'cap_final' => number_format($nuevoSaldo, 2),
            ];
            
            $saldo = $nuevoSaldo;
        }

        return response()->json($tabla);
    }

    public function solicitud(Request $request)
{
    // Aquí puedes manejar la solicitud de crédito
    return redirect()->route('credito')->with('success', 'Simulación confirmada');
}

public function credito(Request $request)
{
    
}



}


