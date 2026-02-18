<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatUserCuestionario extends Model
{
    protected $table = "cat_user_cuestionario";
    protected $fillable = [
        "id",
        "description",
        "user_id_medico",
        "parent_cat_user_cuestionario_id",
        "created_at",
    ];


    static function getSintomas()
    {
        return CatUserCuestionario::where("parent_cat_user_cuestionario_id",11)->get();
    }
    static function show($parent_cat_user_cuestionario_id)
    {
        return CatUserCuestionario::where("parent_cat_user_cuestionario_id",$parent_cat_user_cuestionario_id)->get();
    }
    static function getCormorbilidades()
    {
        return CatUserCuestionario::where("parent_cat_user_cuestionario_id",38)->orderBy("description","ASC")->get();
    }
    static function getMedicacionPrevia()
    {
        return CatUserCuestionario::where("parent_cat_user_cuestionario_id",63)->orderBy("description","ASC")->get();
    }
    static function getImagenologia()
    {
        return CatUserCuestionario::where("parent_cat_user_cuestionario_id",100)->get();
    }
    static function getTac()
    {
        return CatUserCuestionario::where("parent_cat_user_cuestionario_id",100)->get();
    }
}
