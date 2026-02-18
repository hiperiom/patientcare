<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatUserCitaStatus extends Model
{
    protected $table = "cat_user_cita_status";
    protected $fillable = [
        "id",
        "description",
        "active",
        "user_id_medico",
        "created_at",
    ];
}
