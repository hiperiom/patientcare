<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserCuestSintoma extends Model
{
    protected $table ="user_cuest_sintoma";
    protected $fillable = [
        'id',
        'cat_user_cuestionario_id',
        'value',
        'coments',
        'since',
        'until',
        'user_cuest_episodio_id',
        'user_id',
        'active',
        'user_id_medico',
        "user_cuest_episodio_id",
        'created_at'
    ];

    static function index_episodio($episodio_id)
    {
        return UserCuestSintoma::where('user_cuest_episodio_id',$episodio_id)
        ->select('id', 'cat_user_cuestionario_id', 'value', 'coments', 'since','user_id_medico','created_at')
        ->orderBy("id","DESC")
        ->get();
    }

    static function index($user_id,$episodio_id)
    {
        $sintoma_id = Arr::flatten(CatUserCuestionario::where('parent_cat_user_cuestionario_id',11)->select('id')->get()->toArray());
        return UserCuestSintoma::where('user_cuest_sintoma.user_id',$user_id)
        ->join("cat_user_cuestionario","user_cuest_sintoma.cat_user_cuestionario_id","cat_user_cuestionario.id")
        ->leftJoin("user_cuest_episodio","user_cuest_sintoma.user_cuest_episodio_id","user_cuest_episodio.id")
        ->whereIn('user_cuest_sintoma.cat_user_cuestionario_id',$sintoma_id)
        ->where('user_cuest_sintoma.user_cuest_episodio_id',$episodio_id)
        ->select(
            "user_cuest_sintoma.id",
            "cat_user_cuestionario.description AS sintoma",
            DB::raw('
                CASE
                    WHEN user_cuest_sintoma.since IS NOT NULL THEN DATE_FORMAT(user_cuest_sintoma.since, "%d/%m/%Y")
                    ELSE ""
                END AS since
            '),
            DB::raw('
                CASE
                    WHEN user_cuest_sintoma.since IS NOT NULL THEN DATEDIFF(CURDATE(),user_cuest_sintoma.since)
                    ELSE ""
                END AS dias
            '),
            "user_cuest_sintoma.created_at AS registro",
            DB::raw('
                CASE
                    WHEN user_cuest_sintoma.coments IS NOT NULL THEN user_cuest_sintoma.coments
                    ELSE ""
                END AS observacion
            '),
            DB::raw('
                CASE
                    WHEN user_cuest_sintoma.user_cuest_episodio_id IS NOT NULL THEN user_cuest_episodio.id
                    ELSE ""
                END AS episodio
            ')

        )
        ->orderBy("user_cuest_sintoma.created_at","DESC")
        ->get();
    }
    static function store(Request $request)
    {
        //$episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);

        //$episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
        $sintomas = json_decode($request->model);

        if (count($sintomas) > 0) {
            foreach ($sintomas as $key => $sintoma) {
                //dd($sintoma->value);
                /* if ($sintoma->value == 36) {
                    $model = new CatUserCuestionario();
                    //$model->user_cuest_episodio_id = $request->episodio_id;
                    $model->description = $request->sintoma_nuevo;
                    $model->parent_cat_user_cuestionario_id = 11;
                    //$model->user_cuest_episodio_id = $episode_id;
                    $model->user_id_medico = Auth::id();
                    $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                    $model->save();
                    $sintoma->value = $model->id;
                } */
                $model = new UserCuestSintoma();
                $model::updateOrCreate([
                    'user_id'   => $request->user_id,
                    'cat_user_cuestionario_id'=>$sintoma->value,
                    'user_cuest_episodio_id' => $request->episodio_id,
                ],[
                    'cat_user_cuestionario_id' => $sintoma->value,
                    'coments' => $request->sintoma_observacion,
                    'since' => date('Y-m-d H:i:s', strtotime($request['since'])),
                    'user_id' => $request->user_id,
                    'user_cuest_episodio_id' => $request->episodio_id,
                    'user_id_medico' => Auth::id(),
                    'created_at' => date('Y-m-d H:i:s', strtotime($request['created_at']))
                ]);
            }
        }else{

            if (!is_null($request->sintoma_observacion)) {
                $model = new UserCuestSintoma();
                $model->user_cuest_episodio_id = $request->episodio_id;
                $model->cat_user_cuestionario_id = 36;
                $model->coments = $request->sintoma_observacion;
                $model->since = date('Y-m-d H:i:s', strtotime($request['since']));
                $model->user_id = $request->user_id;
                $model->user_id_medico = Auth::id();
                $model->user_cuest_episodio_id = $request->episodio_id;
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();
            }
        }

        return UserCuestSintoma::index($request->user_id,$request->episodio_id);
    }
    static function show($user_id)
    {
        return UserCuestSintoma::where("user_cuest_sintoma.user_id",$user_id)
        ->join("cat_user_cuestionario","user_cuest_sintoma.cat_user_cuestionario_id","cat_user_cuestionario.id")
        ->leftJoin("user_cuest_episodio","user_cuest_sintoma.user_cuest_episodio_id","user_cuest_episodio.id")
        ->whereBetween("user_cuest_sintoma.cat_user_cuestionario_id",[12,36])
        //->where("user_cuest_sintoma.active",1)
        ->select(
            "user_cuest_sintoma.created_at AS registro",
            "cat_user_cuestionario.description AS sintoma",
            DB::raw('
                CASE
                    WHEN user_cuest_sintoma.since IS NOT NULL THEN DATEDIFF(CURDATE(),user_cuest_sintoma.since)
                    ELSE ""
                END AS dias
            '),
            DB::raw('
                CASE
                    WHEN user_cuest_sintoma.coments IS NOT NULL THEN user_cuest_sintoma.coments
                    ELSE ""
                END AS observacion
            '),
            DB::raw('
                CASE
                    WHEN user_cuest_sintoma.user_cuest_episodio_id IS NOT NULL THEN user_cuest_episodio.episode
                    ELSE ""
                END AS episodio
            '),
            "user_cuest_sintoma.id"


        )
        ->orderBy("user_cuest_sintoma.created_at","DESC")
        ->get();
    }
    static function getAllSintomas($user_id)
    {

        return UserCuestSintoma::where("user_id",$user_id)
        ->join("cat_user_cuestionario","user_cuest_sintoma.cat_user_cuestionario_id","cat_user_cuestionario.id")
        ->whereBetween("user_cuest_sintoma.cat_user_cuestionario_id",[12,36])
        //->where("user_cuest_sintoma.active",1)
        ->select(
            "cat_user_cuestionario.description AS value",
            "user_cuest_sintoma.created_at",
            "user_cuest_sintoma.since",
            "user_cuest_sintoma.id",
            "user_cuest_sintoma.coments"

        )
        ->orderBy("user_cuest_sintoma.created_at","desc")
        ->get();
    }
    static function getActualSintomas($user_id)
    {

        return UserCuestSintoma::where("user_id",$user_id)
        ->join("cat_user_cuestionario","user_cuest_sintoma.cat_user_cuestionario_id","cat_user_cuestionario.id")
        ->whereBetween("user_cuest_sintoma.cat_user_cuestionario_id",[12,36])
        ->where("user_cuest_sintoma.active",1)
        ->select(
            "cat_user_cuestionario.description AS value",
            "user_cuest_sintoma.created_at",
            "user_cuest_sintoma.id",
            "user_cuest_sintoma.coments"

        )
        ->orderBy("user_cuest_sintoma.created_at","desc")
        ->get();
    }
    static function getDiasSintomas($user_id)
    {

        $fechaSintomas = DB::table('user_cuest_sintoma')
            ->where("user_id",$user_id)
            ->pluck("created_at")->first();
            $fecha1= new DateTime($fechaSintomas);
            $fecha2= new DateTime(date("Y-m-d H:m:s"));
            $diff = $fecha1->diff($fecha2);

        return $diff->days;
    }
    static function eliminar(Request $request)
    {
        //dd( $request->all());
        $model = UserCuestSintoma::where('id',$request->id);
        $user_id = $model->value('user_id');
        $model->delete();
        return UserCuestSintoma::index($user_id);
    }
}
