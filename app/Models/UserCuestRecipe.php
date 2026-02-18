<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \App\Models\UserTipoDocumento;
use \App\Models\CatTipoDocumento;
class UserCuestRecipe extends Model
{
    protected $table = "user_cuest_recipe";

    static function index($user_id)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($user_id);
        return UserCuestRecipe::where("user_id",$user_id)
            ->where("user_cuest_episodio_id",$episode_id)
            //->orWhere("user_cita_id",$cita_id)
            ->orderBy("id","DESC")
            ->get();
    }
    static function index_by_cita($cita_id)
    {
        return UserCuestRecipe::where("user_cita_id",$cita_id)
            ->orderBy("id","DESC")
            ->get();
    }
    static function index_episodio($episodio_id)
    {
        return UserCuestRecipe::where('user_cuest_episodio_id',$episodio_id)
        ->select('id', 'value', 'coments','user_id_medico','created_at')
        ->orderBy("id","DESC")
        ->get();
    }

    static function store(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
            try {
                UserCuestRecipe::where("user_id",$request->user_id_paciente)
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

                $model = new UserCuestRecipe();
                $model->user_cuest_episodio_id = $episode_id;
                $model->cat_user_cuestionario_id = 177;
                $model->value = $request->value;
                $episodio_id = DB::table('user_cuest_episodio')
                    ->where("user_id",$request->user_id)
                    ->where("active",1)
                    ->select("id")
                    ->orderBy("id","DESC")
                    ->value('id');
                $model->user_cuest_episodio_id = $episodio_id;
                $model->coments = null;
                $model->user_id = $request->user_id;
                $model->user_id_medico =Auth::id();
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();

            } catch (\Throwable $th) {
                return $th->errorInfo[2];
            }
            return Response()->json(UserCuestRecipe::show($request->user_id));
    }

    static function scstore(Request $request)
    {
        $episodio_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);

        $model = new UserCuestRecipe();
        $model->cat_user_cuestionario_id = 177;
        $model->value = $request->value;
        $model->value2 = $request->value2;
        $model->value3 = $request->value3;
        $model->value4 = $request->value4;

        $model->user_cuest_episodio_id = $episodio_id;
        $model->coments = null;
        $model->user_id = $request->user_id;
        $model->user_id_medico =Auth::id();
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();

        return Response()->json($model);
    }
    static function store_cita(Request $request)
    {

        $model = new UserCuestRecipe();
        $model->cat_user_cuestionario_id = 177;
        $model->value = $request->value;
        $model->value2 = $request->value2;
        $model->value3 = $request->value3;
        $model->value4 = $request->value4;
        $model->recipe_num = $request->recipe_num;

        $model->user_cita_id = $request->user_cita_id;
        $model->coments = null;
        $model->user_id = $request->user_id;
        $model->user_id_medico =Auth::id();
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();

        $medico = UserProfile::where("user_profile.user_id", Auth::id() )
            ->first()
            ->toArray();

        $userTipoDocumento =    UserTipoDocumento::firstOrCreate([
            "user_cita_id"=> $request->user_cita_id,
            "recipe_num"=> $request->recipe_num,
            "user_id_paciente"=> $request->user_id,
            //"user_cuest_recipe_id"=> $model->id,
            "user_id_medico"=> Auth::id(),
            "cat_tipo_documento_id"=> CatTipoDocumento::where("description","Récipe Médico")->value("id"),
            "active"=>1,
        ],[
            "user_cita_id"=> $request->user_cita_id,
            "recipe_num"=> $request->recipe_num,
            "user_id_paciente"=> $request->user_id,
            //"user_cuest_recipe_id"=> $model->id,
            "user_id_medico"=> Auth::id(),
            "cat_tipo_documento_id"=> CatTipoDocumento::where("description","Récipe Médico")->value("id"),
            "sello"=>$medico['sello'],
            "firma"=>$medico['firma'],
        ]);


        return Response()->json($model);
    }
    static function actualizar(Request $request)
    {
        $model = UserCuestRecipe::where("id",$request->recipe_id);
        $model->value = $request->value;
        $model->value2 = $request->value2;
        $model->value3 = $request->value3;
        $model->value4 = $request->value4;
        $model->user_id_medico =Auth::id();
        $model->updated_at = date('Y-m-d H:i:s');
        $model->save();
        return Response()->json($model);
    }
    static function show($user_id)
    {
        return UserCuestRecipe::where("user_id",$user_id)->where("active",1)->first();
    }
    static function scshow($user_id)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($user_id);
        return UserCuestRecipe::where("user_id",$user_id)->where("user_cuest_episodio_id",$episode_id)->where("active",1)->first();
    }
    static function eliminar($id)
    {
        $model = UserCuestRecipe::where('id',$id);
        $user_id = $model->value('user_id');
        $model->delete();
        return Response()->json(UserCuestRecipe::show($id));
    }
    static function sceliminar(Request $request)
    {
        //dd($request->all());
        if($request->all){
            $ids =  array_unique (
                        array_column(
                            UserCuestRecipe::where('recipe_num',$request->recipe_num)
                            ->where("user_cita_id",$request->user_cita_id)
                            ->select("id")
                            ->get()
                            ->toArray(),
                            "id"
                        )
                    );
           //dd($ids);
            $model = UserCuestRecipe::whereIn('id',$ids)->delete();
        }else{
            $model = UserCuestRecipe::where('id',$request->id)->where("user_cita_id",$request->user_cita_id);
            $user_id = $model->value('user_id');
            $model->delete();
        }



        return Response()->json(true);
    }

}
