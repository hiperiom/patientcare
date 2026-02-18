<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCuestOximetria extends Model
{
    protected $table = "user_cuest_monitoreo";
    protected $fillable = [
        "value",
        "coments",
        "user_cita_id",
        "user_id_paciente",
        "user_id",
        "active",
        "user_id_medico",
        "cat_user_cuestionario_id",
        "user_cuest_episodio_id",

    ];
    static function index($user_id,$episodio_id)
    {
        return UserCuestOximetria::where('user_id',$user_id)
        ->where('cat_user_cuestionario_id',73)
        ->where('user_cuest_episodio_id',$episodio_id)
        ->orderBy("id","DESC")
        ->get();
    }

    static function index_episodio($episodio_id)
    {
        return UserCuestOximetria::where('user_cuest_episodio_id',$episodio_id)
        ->select('id','value','coments','user_id_medico','created_at')
        ->where('cat_user_cuestionario_id',73)
        ->orderBy("id","DESC")
        ->get();
    }

    static function store(Request $request)
    {
        //$episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);

        UserCuestOximetria::where("user_id",$request->user_id)
        ->where("cat_user_cuestionario_id",73)
        ->where("active",1)
        ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

        $ultima_toma_nro =  UserCuestOximetria::where("user_cuest_episodio_id",$request->episodio_id)
        ->where("cat_user_cuestionario_id",73)
        ->orderBy("id","DESC")
        ->get()
        ->take(1);
        if (count($ultima_toma_nro) == 0) {
            $ultima_toma_nro = 1;
        }else{
            $ultima_toma_nro = $ultima_toma_nro->toArray();
            $ultima_toma_nro = $ultima_toma_nro[0]['toma_nro'] +1;
        }
        $model = new UserCuestOximetria();
        $model->cat_user_cuestionario_id = 73;
        $model->value = $request['cat_user_cuestionario_73'];
        $model->toma_nro = $ultima_toma_nro;
        $model->user_cuest_episodio_id = $request->episodio_id;
        $model->coments = (isset($request['sintoma_observacion']))?$request['sintoma_observacion']:null;
        $model->user_id = $request['user_id'];
        $model->user_id_medico =  Auth::id();
        $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
        $model->save();
        return UserCuestOximetria::show($model->id);
    }
    static function store_cita(Request $request){
        $model = UserCuestOximetria::updateOrCreate(
                [
                    'cat_user_cuestionario_id'   => 73,
                    'user_id'   => $request->user_id_paciente,
                    'user_cita_id'   => $request->user_cita_id
                ],
                [
                    'cat_user_cuestionario_id'   => 73,
                    'value'   => $request->value,
                    'user_id'   => $request->user_id_paciente,
                    'user_cita_id'   => $request->user_cita_id,
                    'user_id_medico' => Auth::id(),
                    "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                ]
            );
            return $model;
    }
    static function show($id)
    {
        return UserCuestOximetria::where('user_id',$id)
        ->where('cat_user_cuestionario_id',73)->where("active",1)
        ->first();
    }
    static function eliminar(Request $request)
    {
        $model = UserCuestOximetria::where('id',$request->id);
        $user_id = $model->value('user_id');
        $model->delete();
        $model = UserCuestOximetria::where('user_id',$user_id)->orderBy("id","DESC")->take(1)->get();
        if(count($model)>0){
            UserCuestOximetria::where('id', $model[0]->id)
            ->where('cat_user_cuestionario_id', 73)
            ->update(['active' => 1]);
        }
        return $model;
    }
    static function actualizar(Request $request)
    {

    }
}
