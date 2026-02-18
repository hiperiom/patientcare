<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CatUserAntecedente extends Model
{
    protected $table ="cat_user_antecedente";
    static function index()
    {
        return CatUserAntecedente::where("active",1)->orderBy("description","ASC")->get();
    }
}
