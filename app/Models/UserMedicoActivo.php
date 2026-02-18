<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMedicoActivo extends Model
{
    protected $table = "user_medico_activo";
    protected $fillable = [
        "user_id_medico",
        "active"
    ];
}
