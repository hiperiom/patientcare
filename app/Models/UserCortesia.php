<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCortesia extends Model
{
    protected $table = "user_cortesia";
    protected $fillable = [
        "id",
        "value",
        "created_at",
        "description",
        "updated_at",
        "user_id_medico",
        "user_id_paciente",
        "user_cita_id",
        "user_cuest_episodio_id",
    ];
}
