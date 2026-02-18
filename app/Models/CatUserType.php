<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatUserType extends Model
{
    protected $table = "cat_user_type";
    static function paciente_id()
    {
        return CatUserType::where("description","Paciente")->value("id");
    }
    static function medico_id()
    {
        return CatUserType::where("description","Médico")->value("id");
    }
    static function familiar_id()
    {
        return CatUserType::where("description","Familiar")->value("id");
    }
}
