<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserCuestAntecedente extends Model
{
    protected $table ="user_cuest_antecedente";
    protected $fillable = [
        "value",
        "description",
        "cat_user_antecedente_id",
        "type",
        "user_id",
        "user_id_paciente",
        "user_id_medico",
        "created_at",
        "user_cuest_episodio_id",
    ];

    static function index($user_id)
    {
        $antecedente_id = Arr::flatten(CatUserAntecedente::where('active',1)->select('id')->get()->toArray());
        return UserCuestAntecedente::where('user_cuest_antecedente.user_id',$user_id)
        ->join("cat_user_antecedente","user_cuest_antecedente.cat_user_antecedente_id","cat_user_antecedente.id")
        ->whereIn('user_cuest_antecedente.cat_user_antecedente_id',$antecedente_id)
        ->select(
            "user_cuest_antecedente.id",
            "cat_user_antecedente.description AS antecedente",
            "user_cuest_antecedente.created_at AS registro",
            DB::raw('
                CASE
                    WHEN user_cuest_antecedente.description IS NOT NULL THEN user_cuest_antecedente.description
                    ELSE ""
                END AS observacion
            ')
        )
        ->orderBy("user_cuest_antecedente.created_at","DESC")
        ->get();
    }

    static function index_episodio($episodio_id)
    {
        return UserCuestAntecedente::where('user_cuest_episodio_id',$episodio_id)
        ->select('id', 'description', 'type','user_id_medico','created_at')
        ->orderBy("id","DESC")
        ->get();
    }

    static function store(Request $request)
    {
        //dd($request->all());
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
/*         $model = new UserCuestAntecedente();
        $model->description = $request->value;
        $model->cat_user_antecedente_id  = NULL;
        $model->user_cuest_episodio_id = $episode_id;
        $model->type  = NULL;
        $model->user_id   = $request['user_id'];
        $model->user_id_medico   = Auth::id();
        $model->created_at   = date('Y-m-d H:i:s', strtotime($request['created_at'])) ;
        $model->save(); */
        $model = new UserCuestAntecedente();
            $model::updateOrCreate([
                'user_cuest_episodio_id'   => $episode_id,
                'user_id'   => $request['user_id'],
            ],[
                'description'   => $request->value,
                'user_id'   => $request['user_id'],
                'user_id_medico' => Auth::id(),
                "created_at"=>date('Y-m-d H:i:s', strtotime($request->created_at))
            ]);

    }
    static function store_ce(Request $request)
    {
        dd($request->all());
        foreach (json_decode($request->user_cuest_antecedente) as $key => $value) {

            $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);

            $model = new UserCuestAntecedente();
            if ($value->name=="quirurgico[]" || $value->name=="hospitalizacion[]") {
                $model->value = $value->value;
                $model->cat_user_antecedente_id  = NULL;
                $model->user_cuest_episodio_id = $episode_id;
                $model->type  = $request['type'];
                $model->user_id_paciente   = $request['user_id_paciente'];
                $model->user_id_medico   = Auth::id();
                $model->created_at   = date('Y-m-d H:i:s', strtotime($request['created_at'])) ;
                $model->save();
            }

            if ($value->name=="personal[]" || $value->name=="familiar[]") {

                $model::updateOrCreate([
                    'cat_user_antecedente_id'   => $value->value,
                    'user_id_paciente'   => $request['user_id'],
                    'type'   => $request['type'],
                ],[
                    'value'   => NULL,
                    'cat_user_antecedente_id'   => $value->value,
                    'user_id_paciente'   => $request['user_id_paciente'],
                    'user_id_medico' => Auth::id(),
                    'type' => $request['type'],
                    "created_at"=>date('Y-m-d H:i:s', strtotime($request->created_at))
                ]);
            }

        }
    }
    static function store2(Request $request)
    {
        foreach (json_decode($request->user_cuest_antecedente_id) as $key => $value) {
            $model = new UserCuestAntecedente();
            $model::updateOrCreate([
                'cat_user_antecedente_id'   => $value->value,
                'user_id'   => $request['user_id'],
                'type'   => "personal",
            ],[
                'description'   => NULL,
                'cat_user_antecedente_id'   => $value->value,
                'user_id'   => $request['user_id'],
                'user_id_medico' => Auth::id(),
                'type' => "personal",
                "created_at"=>date('Y-m-d H:i:s', strtotime($request->created_at))
            ]);
        }
        return UserCuestAntecedente::index($request['user_id']);
    }
    static function store3(Request $request)
    {

        $model = UserCuestAntecedente::updateOrCreate(
                [
                    'user_cuest_episodio_id'   => $request->episodio_id,
                    'user_id_paciente'   => $request->user_id_paciente,
                    'value'   => $request->value,
                ],
                [
                    'value'   => $request->value,
                    'user_cuest_episodio_id'   => $request->episodio_id,
                    'user_id_paciente'   => $request->user_id_paciente,
                    'user_id_medico' => Auth::id(),
                    "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                ]
            );



        return Response()->json($model);
    }
    static function show($user_id)
    {
        return UserCuestAntecedente::where('user_id',$user_id)->where('active',1)->orderby("id","DESC")->get();
    }
}
