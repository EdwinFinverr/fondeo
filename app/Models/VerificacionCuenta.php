<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificacionCuenta extends Model
{
    use HasFactory;

    protected $table = 'verificacion_cuentas';

    protected $fillable = [
        'usuario_id', 'token'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}