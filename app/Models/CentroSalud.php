<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentroSalud extends Model
{
    protected $table = "centro_salud";
    protected $fillable = [
        "id",
        "cat_grupo_centro_salud_id",
        "description",
        "location",
        "user_id_medico",
        "active",
        "created_at",

    ];
    static function index()
    {
        return CentroSalud::where("active",1)->get();
    }
}
