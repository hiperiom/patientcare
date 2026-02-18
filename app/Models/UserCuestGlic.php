<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCuestGlic extends Model
{
    protected $table="user_cuest_glic";
    protected $fillable = [
        "id",
        "value",
        "user_id",
        "user_id_paciente",
        "user_cita_id",
        "user_id_medico",
        "created_at",
];
    static function store(Request $request)
    {
        //$episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
        //dd($request->all());
        try {
            UserCuestGlic::where("user_id_paciente",$request->user_id)
            ->where("active",1)
            ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

            $ultima_toma_nro =  UserCuestGlic::where("user_cuest_episodio_id",$request->episodio_id)
            ->orderBy("id","DESC")
            ->get()
            ->take(1);
            if (count($ultima_toma_nro) == 0) {
                $ultima_toma_nro = 1;
            }else{
                $ultima_toma_nro = $ultima_toma_nro->toArray();
                $ultima_toma_nro = $ultima_toma_nro[0]['toma_nro'] +1;
            }

            $model = new UserCuestGlic();
            $model->user_cuest_episodio_id = $request->episodio_id;
            $model->value = $request->value;
            $model->toma_nro = $ultima_toma_nro;
            $model->unidades_insulina = isset($request->unidades_insulina) ? $request->unidades_insulina: NULL;
            $model->coments = $request->sintoma_observacion;
            $model->user_id_paciente = $request->user_id;
            $model->user_id_medico = $request->user_id_medico;
            //$model->user_cuest_episodio_id = $episode_id;
            $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
            $model->save();

            return $model;
        } catch (\Throwable $th) {
            return $th->errorInfo[2];
        }
    }

    static function store_cita(Request $request){
        $model = UserCuestGlic::updateOrCreate(
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
            return $model;
    }
    static function index_episodio($episodio_id)
    {
        return UserCuestGlic::where('user_cuest_episodio_id',$episodio_id)
        ->select('id', 'value', 'coments','user_id_medico','created_at')
        ->orderBy("id","DESC")
        ->get();
    }

    static function show($user_id)
    {
        return UserCuestGlic::where("user_id_paciente",$user_id)
        ->orderBy("created_at", "DESC")
        ->get();
    }
    static function getGlic($user_id)
    {
       return UserCuestGlic::where("user_id_paciente",$user_id)
                                    ->where("active",1)
                                    ->value('value');
    }
    static function show2($user_id)
    {
        return UserCuestGlic::where("user_id_paciente",$user_id)
        ->where("active", 1)
        ->first();
    }
    static function eliminar(Request $request)
    {
        $model = UserCuestGlic::where('id',$request->id);
        $user_id = $model->value('user_id_paciente');
        $model->delete();
        $model = UserCuestGlic::where('user_id_paciente',$user_id)->orderBy("id","DESC")->take(1)->get();
        if(count($model)>0){
            UserCuestGlic::where('id', $model[0]->id)
            ->update(['active' => 1]);
        }
        return $model;
    }
}
