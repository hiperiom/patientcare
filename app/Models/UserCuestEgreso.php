<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCuestEgreso extends Model
{
    protected $table ="user_cuest_egreso";
    protected $fillable = [
        "id",
        "description",
        "coment",
        "cod_cie",
        "cod_cie_description",
        "user_cuest_episodio_id",
        "user_id",

        "user_id_medico",
        "created_at",
    ];
    static function store(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);

        //dd($request->all());
        UserCuestEgreso::where("user_id",$request->user_id)
            ->where("active",1)
            ->update(["active"=>0]);

        $model = new UserCuestEgreso();

        $model->user_cuest_episodio_id = $episode_id;

        $model::updateOrCreate([
            //'coment'   => $request->coment,
            'user_cuest_episodio_id'   => $request->user_cuest_episodio_id,
            'user_id'   => $request->user_id
        ],[
            'coment'   => $request->coment,
            'user_cuest_episodio_id'   => $request->user_cuest_episodio_id,
            'user_id'   => $request->user_id,
            'user_id_medico'   => Auth::id(),
            'created_at'   => date('Y-m-d H:i:s', strtotime($request['created_at'])),
        ]);
        return Response()->json(UserCuestEgreso::show($request->user_id));
    }

    static function index_episodio($episodio_id)
    {
        return UserCuestEgreso::where('user_cuest_episodio_id',$episodio_id)
        ->select('id', 'description', 'coment', 'cod_cie', 'cod_cie_description','user_id_medico','created_at')
        ->orderBy("id","DESC")
        ->get();
    }

    static function store2(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);

        foreach (json_decode($request->model) as $value) {

            if ($value->id != "add") {

                $model = new UserCuestEgreso();

                $model->user_cuest_episodio_id = $episode_id;

                $model::updateOrCreate(
                [
                    'id'=>$value->id
                ],
                [
                    'user_cuest_episodio_id'=> $value->user_cuest_episodio_id,
                    'coment'=> $value->coment,
                    'cod_cie'=> $value->cod_cie,
                    'cod_cie_description'=> $value->cod_cie_description
                ]);
            }else{
                //$model = new UserCuestEgreso();
                //$model->description = null;
                //$model->coment =  $value->coment;
                //$model->cod_cie = $value->cod_cie;
                //$model->cod_cie_description = $value->cod_cie_description;
                //$model->user_id = $request->user_id;
                //$model->user_cuest_episodio_id  = $value->user_cuest_episodio_id;
                //$model->user_id_medico = Auth::id();
                //$model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                //$model->save();

                $model = new UserCuestEgreso();
                $model::updateOrCreate([
                    'description'   => null,
                    'coment'   => $request->coment,
                    'cod_cie'   => $value->cod_cie,
                    'cod_cie_description'   => $value->cod_cie_description,
                    'user_cuest_episodio_id'   => $value->user_cuest_episodio_id,
                    'user_id'   => $request->user_id
                ],[
                    'description'   => null,
                    'coment'   => $request->coment,
                    'cod_cie'   => $value->cod_cie,
                    'cod_cie_description'   => $value->cod_cie_description,
                    'user_cuest_episodio_id'   => $value->user_cuest_episodio_id,
                    'user_id'   => $request->user_id,
                    'user_id_medico'   => Auth::id(),
                    'created_at'   => date('Y-m-d H:i:s', strtotime($request['created_at'])),
                ]);


            }
        }


        return Response()->json(UserCuestEgreso::show($request->user_id));
    }

    static function actualizar(Request $request)
    {
        $id = $request->user_cuest_egreso_id=="add"?0:$request->user_cuest_egreso_id;
        $model = new UserCuestEgreso();
                $model::updateOrCreate(
                [
                    'id'=>$id,
                ],
                [

                    'cod_cie_description'=> $request->cod_cie_description,
                    'cod_cie'=> $request->cod_cie,
                    'coment'=> $request->coment,
                    'user_cuest_episodio_id'=> $request->user_cuest_episodio_id,
                    'user_id_medico'=> Auth::id(),
                    'user_id'=> $request->user_id,
                    'created_at'=> date('Y-m-d H:i:s', strtotime($request['created_at'])),
                ]);
        $ultima = UserCuestEgreso::where("user_cuest_episodio_id",$request->user_cuest_episodio_id)
                ->where("user_id",$request->user_id)
                ->orderBy("created_at", "DESC")
                ->take(1)
                ->get();

        return Response()->json($ultima[0]->attributesToArray());
    }
    static function show($user_id)
    {
        return Response()->json(UserCuestEgreso::where("user_id",$user_id)->orderBy("created_at","DESC")->get());
    }
    static function eliminar($id)
    {
        $model = UserCuestEgreso::where('id',$id);
        $user_id = $model->value('user_id');
        $model->delete();

        return Response()->json(UserCuestEgreso::show($user_id));

    }
}
