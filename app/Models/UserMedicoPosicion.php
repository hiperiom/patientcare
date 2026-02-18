<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMedicoPosicion extends Model
{
    protected $table = "user_medico_posicion";
    protected $fillable = [
        "user_id",
        "user_id_medico",
        "active",
        "cat_user_medico_posicion_id",
        "created_at",
    ];
    static  function store(Request $request)
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        $model =    UserMedicoPosicion::where("user_id", $request->user_id_medico)
                    ->where("active",1)
                    ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

        $model = new UserMedicoPosicion();
        $model::create([
                    'cat_user_medico_posicion_id' => $request->cat_user_medico_posicion_id,
                    'user_id' => $request->user_id_medico,
                    'user_id_medico' => Auth::id(),
                    'active' => 1,
                    'created_at' => date('Y-m-d H:i:s', strtotime($request['created_at']))
                ]);
        return Response()->json(UserMedicoPosicion::showByMedico($request->user_id_medico));
    }
    static  function actualizar(Request $request)
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        $model =    UserMedicoPosicion::where("user_id", $request->user_id_medico)
        ->where("active",1)
        ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

        $model = new UserMedicoPosicion();
        $model::updateOrCreate([
                    'user_id_medico'   => $request->user_id_medico
                ],[
                    'cat_user_medico_posicion_id' => $request->cat_user_medico_posicion_id,
                    'user_id' => $request->user_id_medico,
                    'user_id_medico' => Auth::id(),
                    'active' => 1,
                    'created_at' => date('Y-m-d H:i:s', strtotime($request['created_at']))
                ]);

        return Response()->json(UserMedicoPosicion::show($request->user_id_medico));
    }
    static function show($id)
    {
        return UserMedicoPosicion::where("user_id",$id)->where("active",1)->first();
    }
    static function showByMedico($user_id_medico)
    {
        return UserMedicoPosicion::where("user_id",$user_id_medico)->first();
    }
}
