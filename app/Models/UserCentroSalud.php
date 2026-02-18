<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCentroSalud extends Model
{
    protected $table = "user_centro_salud";
    protected $fillable = [
        "id",
        "centro_salud_id",
        'cat_user_type_id',
        "user_id_paciente",
        "user_id_medico",
        "active",
        "created_at",
    ];
}
