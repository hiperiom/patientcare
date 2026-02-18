<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SystemIncidencia extends Model
{
    protected $table = "system_incidencia";

    protected $fillable = [


    ];
    static function store(Request $request)
    {
        //dd($request->finalizacion." 00:00:00");
        $model = new SystemIncidencia();
        $model->titulo = $request->titulo;
        $model->cat_system_incidencia_type_id = $request->cat_tipo_incidencia_id;
        $model->description = $request->coments;
        $model->cat_tipo_prioridad_id = $request->cat_tipo_prioridad_id;
        $model->carpeta = $request->carpeta;
        $model->finalizacion = date('Y-m-d H:i:s', strtotime($request->finalizacion." 00:00:00"));
        $model->created_at =  date('Y-m-d H:i:s', strtotime($request->created_at));
        $model->user_id_medico = Auth::id();
        $model->save();

        return Response()->json(SystemIncidencia::show($model->id));
    }
    static function show($id){
        return SystemIncidencia::where("id",$id)->first();
    }
    static function index(){
        return DB::table('system_incidencia')
        ->join("cat_system_incidencia_type", "system_incidencia.cat_system_incidencia_type_id","cat_system_incidencia_type.id")
        ->get();
    }
}


