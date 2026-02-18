<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCuestFc extends Model
{
    protected $table="user_cuest_fc";
    protected $fillable = [
        //"user_cuest_cuestionario_id",
        "value",
        "coments",
        "user_cita_id",
        "user_id_paciente",
        "active",
        "user_id_medico",
        "user_cuest_episodio_id",

    ];
    static function index_episodio($episodio_id)
    {
        return UserCuestFc::where('user_cuest_episodio_id',$episodio_id)
        ->orderBy("id","DESC")
        ->get();
    }/*
    static function store(Request $request)
    {
        //$episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);

        //dd($request->all());
        try {
            UserCuestFc::where("user_id_paciente",$request->user_id)
            ->where("active",1)
            ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

            $model = new UserCuestFc();
            $model->user_cuest_episodio_id = $request->episodio_id;
            $model->value = $request->cat_user_cuestionario_185;
            $model->coments = $request->sintoma_observacion;

            $model->user_id_paciente = $request->user_id;
            $model->user_id_medico = Auth::id();
            $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
            $model->save();

            return Response()->json(UserCuestFc::show($model->id));
        } catch (\Throwable $th) {
            return $th->errorInfo[2];
        }
    } */
    static function store(Request $request)
    {
        //$episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);

        //dd($request->all());
        try {
            UserCuestFc::where("user_cuest_episodio_id",$request['episodio_id'])
            ->where("active",1)
            ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

            $ultima_toma_nro =  UserCuestFc::where("user_cuest_episodio_id",$request->episodio_id)
            ->orderBy("id","DESC")
            ->get()
            ->take(1);
            if (count($ultima_toma_nro) == 0) {
                $ultima_toma_nro = 1;
            }else{
                $ultima_toma_nro = $ultima_toma_nro->toArray();
                $ultima_toma_nro = $ultima_toma_nro[0]['toma_nro'] +1;
            }

            $model = new UserCuestFc();
            $model->value = $request->cat_user_cuestionario_185;
            $model->coments = $request->sintoma_observacion;
            $model->toma_nro = $ultima_toma_nro;
            $model->user_cuest_episodio_id = $request['episodio_id'];
            $model->user_id_paciente = $request->user_id;
            $model->user_id_medico = Auth::id();
            $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
            $model->save();

            return Response()->json(UserCuestFc::show($model->id,$request['episodio_id']));
        } catch (\Throwable $th) {
            dd($th);
            //return $th->errorInfo[2];
        }
    }
    static function show($user_id,$episodio_id)
    {
        return UserCuestFc::where("user_id_paciente",$user_id)
        ->where('user_cuest_episodio_id',$episodio_id)
        ->orderBy("created_at", "DESC")
        ->get();
    }
    static function getFc($user_id)
    {
       return UserCuestFc::where("user_id_paciente",$user_id)
                                    ->where("active",1)
                                    ->value('value');
    }
    static function show2($user_id)
    {
        return UserCuestFc::where("user_id_paciente",$user_id)
        ->where("active", 1)
        ->first();
    }
    static function eliminar(Request $request)
    {
        $model = UserCuestFc::where('id',$request->id);
        $user_id = $model->value('user_id_paciente');
        $model->delete();
        $model = UserCuestFc::where('user_id_paciente',$user_id)->orderBy("id","DESC")->take(1)->get();
        if(count($model)>0){
            UserCuestFc::where('id', $model[0]->id)
            ->update(['active' => 1]);
        }
        return $model;
    }
    static function store_cita(Request $request)
    {
        $model = UserCuestFc::updateOrCreate(
                [
                    'user_id_paciente'   => $request->user_id_paciente,
                    'user_cita_id'   => $request->user_cita_id
                ],
                [
                    'value'   => $request->value,
                    'user_id_paciente'   => $request->user_id_paciente,
                    'user_cita_id'   => $request->user_cita_id,
                    'user_id_medico' => Auth::id(),
                    "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                ]
            );
        return Response()->json($model);
    }
}
