<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFamily extends Model
{
    protected $table = "user_family";

    protected $fillable = [
        "id",
        "email",
        "nombres",
        "apellidos",
        "cedula",
        "genero",
        "telefono_movil",
        "cat_user_family_id",
        "user_cuest_historia_medica_id",
        "user_id",
        "active",
        "user_id_medico",
        "created_at",
        "user_id_paciente",
        "user_id_pariente",
        "revisado",
        "revisado_fecha"
    ];

    static function store(Request $request)
    {
        $model = new UserFamily();
        $model->email = $request->familiar_email;
        $model->nombres = $request->familiar_nombre;
        $model->apellidos = $request->familiar_apellido;
        $model->cedula = $request->familiar_cedula;
        $model->genero = $request->familiar_genero;
        $model->cat_user_family_id = $request->cat_user_family_id;
        $model->telefono_movil = $request->familiar_telefono_movil;
        $model->user_id = $request->user_id;
        $model->save();
        return Response()->json(UserFamily::show($model->id));
    }
    static function show($id)
    {
        return UserFamily::where('id',$id)->first();
    }

}
