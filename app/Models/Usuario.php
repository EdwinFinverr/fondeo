<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Cambiar esta línea
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Authenticatable  // Cambiar Model por Authenticatable
{
    use HasFactory;

    protected $fillable = ['nombre_completo', 'correo_electronico', 'telefono', 'contrasena', 'estado'];

    // Método necesario para que Laravel reconozca el campo de la contraseña
    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}

