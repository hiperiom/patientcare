<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEmpresa extends Model
{
    protected $table ="user_empresa";
    protected $fillable = [
        'id',
        'cat_empresa_id',
        'user_id_paciente',
        'created_at',
    ];

}
