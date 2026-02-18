<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserCuestComorbilidad extends Model
{
    protected $table ="user_cuest_comorbilidad";
    protected $fillable = [
        "id",
        "description",
        "coments",
        "cod_cie",
        "user_cuest_episodio_id",
        "cod_cie_description",
        "coments",
        "user_id_medico",
        "user_id",
        "created_at",
    ];

    static function index_episodio($episodio_id)
    {
        return UserCuestComorbilidad::where('user_cuest_episodio_id',$episodio_id)
        ->select('id', 'description', 'coment', 'cod_cie', 'cod_cie_description','user_id_medico','created_at')
        ->orderBy("id","DESC")
        ->get();
    }

    static function store(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
        
        if(is_null(Auth()->user())){
            return null;
        }
        $ingreso = DB::table('user_cuest_episodio')
        ->where("user_id",$request->user_id)
        ->where("active",1)
        ->select("id")
        ->orderBy("id","DESC")
        ->value('id');

        $model = new UserCuestComorbilidad();
        $model->user_cuest_episodio_id = $episode_id;
        $model::updateOrCreate([

            'description'   =>$request->description,
            'user_id_medico'   =>Auth::id(),
            'user_id'   =>$request->user_id,
        ],[
            'user_cuest_episodio_id'   =>$ingreso,
            'description'   =>$request->description,
            'user_id_medico'   =>Auth::id(),
            'user_id'   =>$request->user_id,
            'created_at' => date('Y-m-d H:i:s', strtotime($request['created_at']))
        ]);

        return Response()->json(UserCuestComorbilidad::show($request->user_id));
    }

    static function store2(Request $request)
    {
        //dd($request);
        foreach (json_decode($request->model) as $value) {
            if ($value->id != "add") {

                $model = new UserCuestComorbilidad();
                $model::updateOrCreate(
                [
                    'id'=>$value->id
                ],
                [
                    'description'=> $value->value,
                    'cod_cie'=> $value->cod_cie,
                    'cod_cie_description'=> $value->cod_cie_description
                ]);
            }else{
                $model = new UserCuestComorbilidad();
                $model->description = $value->value;
                $model->coment = null;
                $model->cod_cie = $value->cod_cie;
                $model->cod_cie_description = $value->cod_cie_description;
                $model->user_cuest_episodio_id = $request->user_cuest_episodio_id;
                $model->user_id = $request->user_id;
                $model->user_id_medico = Auth::id();
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();
            }
        }


        return Response()->json(UserCuestComorbilidad::show($request->user_id));
    }
    static function actualizar(Request $request)
    {
        $model = new UserCuestComorbilidad();
        $model::updateOrCreate(
            [
                'user_id'=>$request->user_id
            ],
            [
                'coment'=> isset($request->coment)?$request->coment:null,
                'created_at'=> date('Y-m-d H:i:s', strtotime($request['created_at'])),
                'user_id'=> isset($request->user_id)?$request->user_id:null,
            ]);

            return Response()->json(UserCuestComorbilidad::show($request->user_id));
    }
    static function actualizar2(Request $request)
    {
        $id = $request->user_cuest_comorbilidad_id=="add"?0:$request->user_cuest_comorbilidad_id;
        $model = new UserCuestComorbilidad();
        $model::updateOrCreate(
            [

                'id'=>$id,

            ],
            [
                'user_cuest_episodio_id'=> $request->user_cuest_episodio_id,
                'description'=> $request->description,
                'cod_cie'=> $request->cod_cie,
                'cod_cie_description'=> $request->cod_cie_description,
                'user_id'=> $request->user_id,
                'user_id_medico'=> Auth::id(),
                'created_at'=> date('Y-m-d H:i:s', strtotime($request['created_at'])),
                'user_id'=> isset($request->user_id)?$request->user_id:null,
            ]);

            return Response()->json(UserCuestComorbilidad::show($request->user_id));
    }
    static function show($user_id)
    {
        return Response()->json(UserCuestComorbilidad::where("user_id",$user_id)->orderBy("created_at","DESC")->get());
    }
    static function eliminar($id)
    {
        $model = UserCuestComorbilidad::where('id',$id);
        $user_id = $model->value('user_id');
        $model->delete();

        return Response()->json(UserCuestComorbilidad::show($user_id));

    }
}
