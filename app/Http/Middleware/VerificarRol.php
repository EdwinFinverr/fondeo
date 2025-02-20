<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarRol
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->tipo_usuario !== 'administrador') {
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
