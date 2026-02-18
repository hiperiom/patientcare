<?php

namespace App\Models;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserEspecialidad extends Model
{
    protected $table = "user_especialidad";
    protected $fillable=[
        "user_id",
        "cat_user_especialidad_id",
        "user_id_medico",
        "created_at",
        "updated_at",
    ];

    static function index(Request $request)
    {
        return UserEspecialidad::where("user_especialidad.cat_user_especialidad_id",$request->cat_user_especialidad_id)
        ->join("user_profile","user_especialidad.user_id","user_profile.user_id")
        ->get();
    }
    static function store(Request $request)
    {


            $model = new UserEspecialidad();
            $model->user_id = $request->user_id;
            $model->cat_user_especialidad_id = $request->cat_user_especialidad_id;
            $model->created_at = $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
            $model->user_id_medico = Auth::id();
            $model->save();

        return Response()->json(UserEspecialidad::show($request->user_id));
    }
    static function show($user_id)
    {
        return UserEspecialidad::where("user_id",$user_id)
        ->join("cat_user_especialidad","user_especialidad.cat_user_especialidad_id","cat_user_especialidad.id")
        ->select(
            "user_especialidad.*",
            DB::raw("cat_user_especialidad.id as cat_user_especialidad_id"),
            "cat_user_especialidad.description"
        )
        ->first();
    }
    static function actualizar(Request $request)
    {

        $model = new UserEspecialidad();
        $model::updateOrCreate([
                    'user_id'   => $request->user_id
                ],[
                    "cat_user_especialidad_id"=>$request->cat_user_especialidad_id,
                    "updated_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))
                ]);
        return UserEspecialidad::show($request->user_id);
    }
    //relationship
    public function userprofile()
    {
        /*
            Obtener los episodios del usuario
        */
        return $this->belongsToMany('App\Models\UserProfile', 'user_id', 'user_id');
    }
}
