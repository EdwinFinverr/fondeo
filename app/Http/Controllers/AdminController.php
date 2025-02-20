<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SolicitudCredito;

class AdminController extends Controller
{
    public function index()
    {
        $solicitudes = SolicitudCredito::all();
        return view('admin.index', compact('solicitudes'));
    }
}
