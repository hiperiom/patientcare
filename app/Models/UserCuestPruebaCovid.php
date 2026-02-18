<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class UserCuestPruebaCovid extends Model
{
    protected $table = "user_cuest_prueba_covid";
    protected $fillable = [
        "cat_user_cuestionario_id",
        "user_cuest_episodio_id",
        "id",
        "value",
        "value2",
        "fecha_prueba",
        "user_cuest_episodio_id",
        "user_id",
        "created_at",
        "user_id_medico",
    ];

    static function index_episodio($episodio_id)
    {
        return UserCuestPruebaCovid::where('user_cuest_episodio_id',$episodio_id)
        ->select('id', 'cat_user_cuestionario_id', 'value', 'VALUE2', 'IGM', 'IGG', 'coments','user_id_medico','created_at')
        ->orderBy("id","DESC")
        ->get();
    }

    static function store(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
        //dd($request->all());
        UserCuestPruebaCovid::where("user_id",$request->user_id)
        ->where("cat_user_cuestionario_id",$request['cat_user_cuestionario_id'])
        ->where("active",1)
        ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);
        $model = new UserCuestPruebaCovid();
        try {
            $model->user_cuest_episodio_id = $episode_id;
            $model->value   = $request['value'];
            $model->value2   = isset($request['value2'])?$request['value2']:NULL;
            $model->cat_user_cuestionario_id   = $request['cat_user_cuestionario_id'];
            $model->user_id   = $request['user_id'];
            $model->user_cuest_episodio_id   = $episode_id;
            $model->created_at= date('Y-m-d H:i:s', strtotime($request->created_at));
            $model->save();
        } catch (\Throwable $th) {
            return dd($th);
        }
        return UserCuestPruebaCovid::show($request);
    }
    static function show(Request $request)
    {
        return UserCuestPruebaCovid::where("cat_user_cuestionario_id",$request->cat_user_cuestionario_id)->where("user_id",$request->user_id)->where("active",1)->first();
    }
    static function getPcr($user_id)
    {
       return UserCuestPruebaCovid::where("user_id",$user_id)
                                    ->where("cat_user_cuestionario_id",96)
                                    ->where("active",1)
                                    ->first();
    }
    static function getPdr($user_id)
    {
       return UserCuestPruebaCovid::where("user_id",$user_id)
                                    ->where("cat_user_cuestionario_id",91)
                                    ->where("active",1)
                                    ->first();
    }
    static function template(Request $request,$coment=null)
    {
        if(isset($request['cat_user_cuestionario_91'])){
            UserCuestPruebaCovid::where("user_id",$request->user_id)
            ->where("cat_user_cuestionario_id",91)
            ->where("active",1)
            ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

            $model = new UserCuestPruebaCovid();

            $model->cat_user_cuestionario_id = 91;
            $model->value = $request['cat_user_cuestionario_93'];
            $model->value2 = $request['cat_user_cuestionario_123'];
            $model->fecha_prueba = $request['cat_user_cuestionario_92'];
            $model->igm = ($request['cat_user_cuestionario_94']=="true")?1:0;
            $model->igg = ($request['cat_user_cuestionario_95']=="true")?1:0;

            $model->coments = $coment;
            $model->user_id = $request->user_id;
            $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
            $model->save();
        }
        if(isset($request['cat_user_cuestionario_96'])){
            UserCuestPruebaCovid::where("user_id",$request->user_id)
            ->where("cat_user_cuestionario_id",96)
            ->where("active",1)
            ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

            $model = new UserCuestPruebaCovid();

            $model->cat_user_cuestionario_id = 96;
            $model->value = $request['cat_user_cuestionario_98'];
            $model->value2 = null;
            $model->fecha_prueba = $request['cat_user_cuestionario_97'];


            $model->coments = $coment;
            $model->user_id = $request->user_id;
            $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
            $model->save();
        }

    }
    static function getPcrActual($user_id)
    {
        return UserCuestPruebaCovid::where("user_id",$user_id)
        ->whereIn("cat_user_cuestionario_id",[96,97,98])
        ->where("active",1)
        ->get();
    }
    static function getAllPcr($user_id)
    {
        return UserCuestPruebaCovid::where("user_id",$user_id)
        ->whereIn("cat_user_cuestionario_id",[96])
        ->get();
    }
    static function getAllPdr($user_id)
    {
        return UserCuestPruebaCovid::where("user_id",$user_id)
        ->whereIn("cat_user_cuestionario_id",[91])
        ->get();
    }
    static function getPdrActual($user_id)
    {
        $response = "";
        $key1 = false;
        $key2 = false;
        $model =  UserCuestPruebaCovid::where("user_id",$user_id)
        ->whereIn("cat_user_cuestionario_id",[91])
        ->where("active",1)
        ->first();
        if(!is_null($model)){
            if(
                !is_null($model->value) &&
                $model->value == "Positivo" &&
                $model->igm==0 &&
                !$key1
            ){
                $response .= "IgM <span style='font-size: 20px;color:red'></span><br>";
                $key1=true;
            }

            if(
                !is_null($model->value) &&
                $model->value == "Positivo" &&
                $model->igm==1 &&
                !$key1
            ){
                $response .= "IgM <span style='font-size: 20px;color:red'>+</span><br>";
                $key1=true;
            }


            if(
                !is_null($model->value) &&
                $model->value == "Negativo" &&
                $model->igm==0 &&
                !$key1
            ){
                $response .= "IgM <span style='font-size: 20px;color:red'></span><br>";
                $key1=true;
            }

            if(
                !is_null($model->value) &&
                $model->value == "Negativo" &&
                $model->igm==1 &&
                !$key1
            ){
                $response .= "IgM <span style='font-size: 20px;color:green'>-</span><br>";
                $key1=true;
            }

            if(
                !is_null($model->value) &&
                $model->value == "Indeterminado" &&
                $model->igm==0 &&
                !$key1
            ){
                $response .= "IgM <span style='font-size: 20px;color:green'></span><br>";
                $key1=true;
            }

            if(
                !is_null($model->value) &&
                $model->value == "Indeterminado" &&
                $model->igm==1 &&
                !$key1
            ){
                $response .= "IgM <span style='font-size: 20px;color:green'></span><br>";
                $key1=true;
            }

            if(
                !is_null($model->value) &&
                $model->value == "No sabe" &&
                $model->igm==0 &&
                !$key1
            ){
                $response .= "IgM <span style='font-size: 20px;color:green'></span><br>";
                $key1=true;
            }

            if(
                !is_null($model->value) &&
                $model->value == "No sabe" &&
                $model->igm==1 &&
                !$key1
            ){
                $response .= "IgM <span style='font-size: 20px;color:green'></span><br>";
                $key1=true;
            }
            //----------

            if(
                !is_null($model->value2) &&
                $model->value2 == "Positivo" &&
                $model->igg==0 &&
                !$key2
            ){
                $response .= "IgG <span style='font-size: 20px;color:red'></span><br>";
                $key2=true;
            }

            if(
                !is_null($model->value2) &&
                $model->value2 == "Positivo" &&
                $model->igg==1 &&
                !$key2
            ){
                $response .= "IgG <span style='font-size: 20px;color:red'>+</span><br>";
                $key2=true;
            }
            if(
                !is_null($model->value2) &&
                $model->value2 == "Negativo" &&
                $model->igg==0 &&
                !$key2
            ){
                $response .= "IgG <span style='font-size: 20px;color:red'></span><br>";
                $key2=true;
            }

            if(
                !is_null($model->value2) &&
                $model->value2 == "Negativo" &&
                $model->igg==1 &&
                !$key2
            ){
                $response .= "IgG <span style='font-size: 20px;color:green'>-</span><br>";
                $key2=true;
            }

            if(
                !is_null($model->value) &&
                $model->value2 == "Indeterminado" &&
                $model->igg==0 &&
                !$key2
            ){
                $response .= "IgG <span style='font-size: 20px;color:green'></span><br>";
                $key2=true;
            }

            if(
                !is_null($model->value2) &&
                $model->value2 == "Indeterminado" &&
                $model->igg==1 &&
                !$key2
            ){
                $response .= "IgG <span style='font-size: 20px;color:green'></span><br>";
                $key2=true;
            }

            if(
                !is_null($model->value2) &&
                $model->value2 == "No sabe" &&
                $model->igg==0 &&
                !$key2
            ){
                $response .= "IgG <span style='font-size: 20px;color:green'></span><br>";
                $key2=true;
            }

            if(
                !is_null($model->value2) &&
                $model->value2 == "No sabe" &&
                $model->igg==1 &&
                !$key2
            ){
                $response .= "IgG <span style='font-size: 20px;color:green'></span><br>";
                $key2=true;
            }
        }

        return $response;

    }
}
