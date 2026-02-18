<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserCuestPad extends Model
{
    protected $table = "user_cuest_pad";
    protected $fillable = [
        "user_id",
        "ofrecer",
        "aceptar",
        "cat_fuente_f_id",
        "cat_user_pad_id",
        "ingreso",
        "egreso",
        "cat_aseguradora_id",
        "user_cuest_episodio_id",
        "pago_valido",
        "value1",
        "value2",
        "active",
        "user_id_medico",
        "created_at",
    ];
    static function store(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
        try {
            UserCuestPad::where("user_id",$request->user_id)
            ->where("cat_user_pad_id",$request->cat_user_pad_id)
            ->where("active",1)
            ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

            $model = new UserCuestPad();

                $model->pago_valido = isset($request->pago_valido)?$request->pago_valido:0;
                $model->user_cuest_episodio_id = $episode_id;
                $model->user_id = $request->user_id;
                $model->cat_user_pad_id = $request->cat_user_pad_id;
                $model->ofrecer = $request->ofrecer;
                $model->aceptar = $request->aceptar;
                $model->ingreso = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->cat_fuente_f_id = isset($request->cat_fuente_f_id)?$request->cat_fuente_f_id:null;
                $model->cat_aseguradora_id = isset($request->cat_aseguradora_id) && $request->cat_fuente_f_id== 2?$request->cat_aseguradora_id:null;
                $model->value1 = isset($request->value1) && $request->cat_fuente_f_id==2?$request->value1:null;
                $model->value2 = isset($request->value2)?$request->value2:null;
                $model->user_id_medico = Auth::id();
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();
        } catch (\Throwable $th) {
            return dd($th);
        }
        return UserCuestPad::show($request->user_id);
    }
    static function alta(Request $request)
    {
        try {
            UserCuestPad::where("id",$request->pad_id)
            ->update([
                "egreso"=> date('Y-m-d H:i:s', strtotime($request['created_at']))
            ]);
        } catch (\Throwable $th) {
            return dd($th);
        }
        return UserCuestPad::show($request->user_id);
    }
    static function updateDateIngreso(Request $request)
    {
        try {
            UserCuestPad::where("id",$request->pad_id)
            ->update([
                "ingreso"=> date('Y-m-d H:i:s', strtotime($request['ingreso']))
            ]);
        } catch (\Throwable $th) {
            return dd($th);
        }
        return UserCuestPad::show($request->user_id);
    }
    static function actualizar(Request $request)
    {
        //dd($request->all());
        try {
            UserCuestPad::where("id",$request->pad_id)
            ->where("active",1)
            ->update([
                "cat_user_pad_id"=>$request->cat_user_pad_id,
                "ofrecer"=>$request->ofrecer,
                "aceptar"=>$request->aceptar,
                "pago_valido"=>$request->pago_valido,
                "cat_fuente_f_id"=>$request->cat_fuente_f_id,
                "cat_aseguradora_id"=>isset($request->cat_aseguradora_id) && $request->cat_fuente_f_id== 2?$request->cat_aseguradora_id:null,
                "value1"=>isset($request->value1) && $request->cat_fuente_f_id== 2?$request->value1:null,
                "value2"=>$request->value2
            ]);
        } catch (\Throwable $th) {
            return dd($th);
        }
        return UserCuestPad::show($request->user_id);
    }
    static function show($user_id)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($user_id);
        return  DB::table('user_cuest_pad AS ucp')
        ->where("user_id",$user_id)
        ->where("user_cuest_episodio_id",$episode_id)
        ->join("cat_user_pad","ucp.cat_user_pad_id","cat_user_pad.id")
        ->select(
            "ucp.id AS pad_id",
            "cat_user_pad.description AS pad",
            DB::raw("DATE_FORMAT(ucp.ingreso, '%d/%m/%Y') AS ingreso"),
            DB::raw("
                    CASE
                        WHEN ucp.egreso IS NOT NULL THEN DATE_FORMAT(ucp.egreso, '%d/%m/%Y')
                        ELSE ''
                    END AS egreso"),
            "ucp.pago_valido AS pv",
            DB::raw("
                    CASE
                        WHEN ucp.pago_valido = 0 THEN 'Por validar'
                        WHEN ucp.pago_valido = 1 THEN 'Validado'
                        WHEN ucp.pago_valido = 2 THEN 'No valido'
                        ELSE ''
                    END AS pago_valido"),
            DB::raw("
                CASE
                    WHEN
                        ucp.ofrecer = 0 AND
                        ucp.aceptar = 0 AND
                        ucp.pago_valido IN (0,NULL)
                    THEN 0
                    WHEN
                        ucp.ofrecer = 1 AND
                        ucp.aceptar = 0 AND
                        ucp.pago_valido IN (0,NULL)
                    THEN 1
                    WHEN
                        ucp.ofrecer = 1 AND
                        ucp.aceptar = 1 AND
                        ucp.cat_fuente_f_id IS NULL AND
                        ucp.cat_aseguradora_id IS NULL AND
                        ucp.pago_valido IN (0,NULL)
                    THEN 2
                    WHEN
                        ucp.ofrecer = 1 AND
                        ucp.aceptar = 1 AND
                        ucp.cat_fuente_f_id != 2 AND
                        ucp.pago_valido IN (0,NULL)
                    THEN 2
                    WHEN
                        ucp.ofrecer = 1 AND
                        ucp.aceptar = 1 AND
                        ucp.cat_fuente_f_id = 2 AND
                        ucp.cat_aseguradora_id IS NOT NULL AND
                        ucp.pago_valido IN (0,NULL)
                    THEN 3
                    WHEN
                        ucp.ofrecer = 1 AND
                        ucp.aceptar = 1 AND
                        ucp.cat_fuente_f_id != 2 AND
                        ucp.pago_valido = 1
                    THEN 4
                    WHEN ucp.cat_fuente_f_id IS NOT NULL
                        AND ucp.pago_valido = 1 THEN 4
                    ELSE 5

                END AS img"),
            DB::raw("
                CASE
                    WHEN
                        ucp.ofrecer = 0 AND
                        ucp.aceptar = 0 AND
                        ucp.pago_valido IN (0,NULL)
                    THEN 'PAD por ofrecer'
                    WHEN
                        ucp.ofrecer = 1 AND
                        ucp.aceptar = 0 AND
                        ucp.pago_valido IN (0,NULL)
                    THEN 'PAD ofrecido'
                    WHEN
                        ucp.ofrecer = 1 AND
                        ucp.aceptar = 1 AND
                        ucp.cat_fuente_f_id IS NULL AND
                        ucp.cat_aseguradora_id IS NULL AND
                        ucp.pago_valido IN (0,NULL)
                    THEN 'PAD Aceptado'
                    WHEN
                        ucp.ofrecer = 1 AND
                        ucp.aceptar = 1 AND
                        ucp.cat_fuente_f_id != 2 AND
                        ucp.pago_valido IN (0,NULL)
                    THEN 'PAD Aceptado'
                    WHEN
                        ucp.ofrecer = 1 AND
                        ucp.aceptar = 1 AND
                        ucp.cat_fuente_f_id = 2 AND
                        ucp.cat_aseguradora_id IS NOT NULL AND
                        ucp.pago_valido IN (0,NULL)
                    THEN 'PAD en espera de validación'
                    WHEN
                        ucp.ofrecer = 1 AND
                        ucp.aceptar = 1 AND
                        ucp.cat_fuente_f_id != 2 AND
                        ucp.pago_valido = 1
                    THEN 'PAD validado'
                    WHEN ucp.cat_fuente_f_id IS NOT NULL  AND ucp.pago_valido = 1
                    THEN 'PAD validado'
                    ELSE 'Falta información por confirmar'

                END AS img_description"),
            DB::raw("
                    CASE
                        WHEN ucp.value2 IS NOT NULL THEN ucp.value2
                        ELSE ''
                    END AS observacion")
        )
                ->whereNotNull("cat_user_pad_id")
                //->where("user_cuest_pad.egreso",null)
                //->where("user_cuest_pad.active",1)
                ->get();
    }
    static function show2($pad_id)
    {
        //dd($request->all());
        try {
            return UserCuestPad::where("user_cuest_pad.id",$pad_id)
                ->join("cat_user_pad","user_cuest_pad.cat_user_pad_id","cat_user_pad.id")
                ->select(
                    "user_cuest_pad.*",
                    "cat_user_pad.description"
                )
                ->first();
        } catch (\Throwable $th) {
            return dd($th);
        }
    }
    static function eliminar($id)
    {
        $model = UserCuestPad::where('id',$id);
        $model->delete();
        return $model;
    }
}
