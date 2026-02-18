<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfileEmpresa extends Model
{
    protected $table = 'user_profile_empresa';
    protected $fillable = [
        'id',
        'cedula',
        'nombres',
        'apellidos',
        'genero',
        'correo',
        'cedula',
        'telefono_movil',
        'created_at'
    ];
}
