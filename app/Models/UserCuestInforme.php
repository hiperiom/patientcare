<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserCuestInforme extends Model
{
    protected $table ="user_cuest_informe";
    protected $fillable = [
        'id',
        'cat_user_informe_id',
        'value',
        'coments',
        'since',
        'enviado',
        'user_id',
        'active',
        'until',
        'id',
        "user_cuest_episodio_id",
    ];

    static function index_episodio($episodio_id)
    {
        return UserCuestInforme::where('user_cuest_episodio_id',$episodio_id)
        ->select('id', 'cat_user_informe_id', 'value', 'coments', 'since', 'until', 'enviado','user_id_medico','created_at')
        ->orderBy("id","DESC")
        ->get();
    }

    static function index(Request $request)
    {
        return UserCuestInforme::where("user_cuest_informe.user_id",$request->user_id)
        //->join('user_cuest_episodio', 'user_cuest_informe.user_id', '=', 'user_cuest_episodio.user_id')
        ->join('user_profile', 'user_cuest_informe.user_id_medico', '=', 'user_profile.user_id')
        ->select(
            "user_cuest_informe.*",
            "user_cuest_informe.cat_user_informe_id",
            "user_cuest_informe.value",
            "user_cuest_informe.coments",
            "user_cuest_informe.enviado",
            "user_cuest_informe.user_id",
            "user_cuest_informe.user_id_medico",
            DB::raw("DATE_FORMAT(user_cuest_informe.since, '%d-%m-%Y') AS since"),
            DB::raw("DATE_FORMAT(user_cuest_informe.until, '%d-%m-%Y') AS until"),
            "user_profile.nombres",
            "user_profile.apellidos"
        )
        ->orderBy("user_cuest_informe.created_at","DESC")
        ->get();

    }
    static function store(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
        $model= new UserCuestInforme();
        $model->user_cuest_episodio_id = $episode_id;
        $model->cat_user_informe_id = $request->cat_user_informe_id;
        if (isset($request->value)) {
            $model->value= $request->value;
        }
        $model->user_cuest_episodio_id = $episode_id;
        $model->coments= $request->coment;
        $model->since=  date('Y-m-d H:i:s', strtotime($request['since']));
        $model->until=  date('Y-m-d H:i:s', strtotime($request['until']));
        $model->user_id = $request->user_id;

        $model->user_id_medico= Auth::id();

        $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
        $model->save();

        $model= new UserCuestEpisodio();


        return UserCuestInforme::show($model->id);
    }
    static function show($user_cuest_informe_id)
    {
        return UserCuestInforme::where("user_cuest_informe.id",$user_cuest_informe_id)
        ->join('user_profile', 'user_cuest_informe.user_id_medico', '=', 'user_profile.user_id')
        ->select(
            "user_cuest_informe.id as id",
            "user_cuest_informe.cat_user_informe_id",
            "user_cuest_informe.coments",
            "user_cuest_informe.enviado",
            "user_cuest_informe.user_id",
            "user_cuest_informe.user_id_medico",
            DB::raw("DATE_FORMAT(user_cuest_informe.since, '%d-%m-%Y') AS since"),
            DB::raw("DATE_FORMAT(user_cuest_informe.until, '%d-%m-%Y') AS until"),
            "user_profile.nombres",
            "user_profile.apellidos"

        )
        ->orderBy("user_cuest_informe.created_at","DESC")
        ->first();
    }
    static function eliminar(Request $request)
    {
        $model = UserCuestInforme::where("user_cuest_informe.id",$request->user_cuest_informe_id);
        $user_id = $model->value('user_id');
        $model->delete();
        return UserCuestInforme::where("user_id",$request->user_id)
        //->where("active",1)
        ->count();
    }

}
