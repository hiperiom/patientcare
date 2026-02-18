<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGuardias extends Model
{
    protected $table="user_guardias";
    protected $fillable = [
        "id",
        "fecha_inicio",
        "fecha_fin",
        "turno_inicio",
        "turno_fin",
        "cargo",
        "h_inicio",
        "h_fin",
        "turno_id",
        "user_id",
        "dayWeek",
        "dayMonth",
        "monthYear",
        "year",
        "dayName",
        "active",
        "comentarios",
        "cumplido"
    ];
}
