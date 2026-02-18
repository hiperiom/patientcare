<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCuestTa extends Model
{
    protected $table="user_cuest_ta";
    protected $fillable = [
        "user_cuest_cuestionario_id",
        "value",
        "value2",
        "coments",
        "user_id",
        "user_id_paciente",
        "user_cita_id",
        "user_id_medico",
        "active",
        "user_medico",
        "user_cuest_episodio_id",

    ];
    static function store(Request $request)
    {
        //dd($request->all());
        try {
            UserCuestTa::where("user_id_paciente",$request->user_id)
            ->where("active",1)
            ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

            $ultima_toma_nro =  UserCuestTa::where("user_cuest_episodio_id",$request->episodio_id)
            ->orderBy("id","DESC")
            ->get()
            ->take(1);
            if (count($ultima_toma_nro) == 0) {
                $ultima_toma_nro = 1;
            }else{
                $ultima_toma_nro = $ultima_toma_nro->toArray();
                $ultima_toma_nro = $ultima_toma_nro[0]['toma_nro'] +1;
            }

            $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
            $model = new UserCuestTa();
            $model->value = $request->value;
            $model->value2 = $request->value2;
            $model->toma_nro = $ultima_toma_nro;
            $model->media = isset($request->media) ? $request->media: NULL;
            $model->coments = $request->sintoma_observacion;
            $model->user_id_paciente = $request->user_id;
            $model->user_id_medico = Auth::id();
            $model->user_cuest_episodio_id = $episode_id;
            $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
            $model->save();

            return Response()->json(UserCuestTa::show($model->id));
        } catch (\Throwable $th) {
            return $th->errorInfo[2];
        }
    }

    static function index_episodio($episodio_id)
    {
        return UserCuestTa::where('user_cuest_episodio_id',$episodio_id)
        ->select('id','value','value2', 'coments','user_id_medico','created_at')
        ->orderBy("id","DESC")
        ->get();
    }
    static function store_cita(Request $request){
        $model = UserCuestTa::updateOrCreate(
                [
                    'user_id_paciente'   => $request->user_id_paciente,
                    'user_cita_id'   => $request->user_cita_id,
                    'value2'   => NULL,
                ],
                [
                    'value'   => $request->value,
                    'value2'   => $request->value2,
                    'user_id_paciente'   => $request->user_id_paciente,
                    'user_cita_id'   => $request->user_cita_id,
                    'user_id_medico' => Auth::id(),
                    "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                ]
            );
            return $model;
    }
    static function show($user_id)
    {
        return UserCuestTa::where("user_id_paciente",$user_id)
        ->orderBy("created_at", "DESC")
        ->get();
    }
    static function getTa($user_id)
    {
        return UserCuestTa::where("user_id_paciente",$user_id)
        ->where("active", 1)
        ->first();
    }
    static function eliminar(Request $request)
    {
        $model = UserCuestTa::where('id',$request->id);
        $user_id = $model->value('user_id_paciente');
        $model->delete();
        $model = UserCuestTa::where('user_id_paciente',$user_id)->orderBy("id","DESC")->take(1)->get();
        if(count($model)>0){
            UserCuestTa::where('id', $model[0]->id)
            ->update(['active' => 1]);
        }
        return $model;
    }
}
