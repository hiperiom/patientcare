<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserCuestImpresionDiagnostica extends Model
{
    protected $table = "user_cuest_imp_diagn";
    protected $fillable = [
        'id',
        'value',
        'coments',
        'cod_cie',
        'user_id',
        'user_id_medico',
        'user_cita_id',
        'cod_cie_description',
        'cat_user_cuestionario_id',
        'user_cuest_episodio_id',
        'description',
        'created_at'
    ];

    static function index_episodio($episodio_id)
    {
        return UserCuestImpresionDiagnostica::where('user_cuest_episodio_id',$episodio_id)
        ->select('id', 'value', 'coments', 'cod_cie', 'cod_cie_description', 'cod_cie_description','user_id_medico','created_at')
        ->orderBy("id","DESC")
        ->get();
    }

    static function store(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
            try {

                $ingreso = DB::table('user_cuest_episodio')
                    ->where("user_id",$request->user_id)
                    ->where("active",1)
                    ->select("id")
                    ->orderBy("id","DESC")
                    ->value('id');

                if (is_null($ingreso)) {
                    $temp = UserCuestUbicacion::ultimoIngreso($request->user_id);

                    $model = new UserCuestEpisodio();
                    $model->user_cuest_episodio_id = $episode_id;
                    $model->ingreso = date('Y-m-d H:i:s', strtotime($temp[0]->ingreso));
                    $model->user_id = $request->user_id;
                    $model->user_id_med_esp = Auth::id();
                    $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                    $model->save();
                    $user_cuest_episodio_id = $model->id;
                }else{
                    $user_cuest_episodio_id = $ingreso;
                }

                UserCuestImpresionDiagnostica::where("user_id",$request->user_id)
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);


                $model = new UserCuestImpresionDiagnostica();
                $model->user_cuest_episodio_id = $episode_id;
                $model::updateOrCreate([
                    'cat_user_cuestionario_id'   => 101,
                    'value'   => $request->value,
                    'coments'   => null,
                    'user_cuest_episodio_id'   => $user_cuest_episodio_id,
                    'user_id'   => $request->user_id
                ],[
                    'cat_user_cuestionario_id'   => 101,
                    'value'   => $request->value,
                    'coments'   => null,
                    'user_cuest_episodio_id'   => $user_cuest_episodio_id,
                    'user_id'   => $request->user_id,
                    'user_id_medico'   => Auth::id(),
                    'created_at'   => date('Y-m-d H:i:s', strtotime($request['created_at'])),

                ]);

                return UserCuestImpresionDiagnostica::where( 'user_cuest_episodio_id', $user_cuest_episodio_id)
                    ->where( 'cat_user_cuestionario_id', 101 )
                    ->where( 'user_id', $request->user_id )
                    ->where( 'active', 1 )
                    ->first();


            } catch (\Throwable $th) {
                return $th->errorInfo[2];
            }
            return Response()->json(UserCuestImpresionDiagnostica::show($request->user_id));
    }
    static function store3(Request $request)
    {
        $model = UserCuestImpresionDiagnostica::updateOrCreate(
                [
                    'user_id'   => $request->user_id_paciente,
                    'user_cuest_episodio_id'   => $request->episodio_id
                ],
                [
                    'value'   => $request->value,
                    'cat_user_cuestionario_id'   => 101,
                    'user_cuest_episodio_id'   => $request->episodio_id,
                    'user_id'   => $request->user_id_paciente,
                    'user_id_medico' => Auth::id(),
                    "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                ]
            );
        return Response()->json($model);
    }
    static function totalEpisodio(Request $request)
    {
        return DB::table('user_cuest_imp_diagn')
            ->where("user_cuest_episodio_id",$request->user_cuest_episodio_id)
            ->where("user_id",$request->user_id)
            ->count();
    }
    static function store2(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
        //dd($request->all());
        foreach (json_decode($request->model) as $value) {
            if ($value->id != "add") {

                $model = new UserCuestImpresionDiagnostica();
                $model->user_cuest_episodio_id = $episode_id;
                $model::updateOrCreate(
                [
                    'user_cuest_episodio_id'=>$value->user_cuest_episodio_id,
                    'id'=>$value->id
                ],
                [
                    'value'=> $value->value,
                    'cod_cie'=> $value->cod_cie,
                    'cod_cie_description'=> $value->cod_cie_description
                ]);
            }else{
                $model = new UserCuestImpresionDiagnostica();
                $model->cat_user_cuestionario_id = 101;
                $model->value = $value->value;
                $model->coments = null;
                $model->cod_cie = $value->cod_cie;
                $model->cod_cie_description = $value->cod_cie_description;
                $model->user_cuest_episodio_id = $value->user_cuest_episodio_id;
                $model->user_id = $request->user_id;
                $model->user_id_medico = Auth::id();
                $model->active = 0;
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();
            }
        }


        return Response()->json(UserCuestImpresionDiagnostica::show($request->user_id));
    }
    static function actualizar(Request $request)
    {
        //dd($request->all());
            try {
                /*
                UserCuestImpresionDiagnostica::where("id",$request->user_cuest_imp_diagn_id)
                ->where("user_id",$request->user_id)
                ->where("active",1)
                ->update([
                   "cod_cie"=>$request['cod_cie'],
                   "cod_cie_description"=>$request['cod_cie_descripcion'],
                ]);*/
                $id = $request->user_cuest_imp_diagn_id=="add"?0:$request->user_cuest_imp_diagn_id;
                $model = new UserCuestImpresionDiagnostica();
                $model::updateOrCreate(
                [
                    //'user_cuest_episodio_id'=>$request->user_cuest_episodio_id,
                    'id'=>$id,
                    //'value'=> $request->value,
                ],
                [

                    'cod_cie'=> $request->cod_cie,
                    'cat_user_cuestionario_id'=> 101,
                    'value'=> $request->value,
                    'cod_cie_description'=> $request->cod_cie_description,
                    'user_cuest_episodio_id'=> $request->user_cuest_episodio_id,
                    'user_id_medico'=> Auth::id(),
                    'user_id'=> $request->user_id,
                    'created_at'=> date('Y-m-d H:i:s', strtotime($request['created_at'])),
                ]);


            } catch (\Throwable $th) {
                return $th;
            }
            $ultima = UserCuestImpresionDiagnostica::where("user_cuest_episodio_id",$request->user_cuest_episodio_id)
                        ->where("user_id",$request->user_id)
                        ->orderBy("created_at", "DESC")
                        ->take(1)
                        ->get();

            return Response()->json($ultima[0]->attributesToArray());
    }
    static function actualizar2(Request $request)
    {
            try {

                DB::table('user_cuest_imp_diagn')
                ->where('id', $request->id)
                ->update([
                    'value' => $request->value,
                    'user_id_medico'=> Auth::id(),
                    'created_at'=> date('Y-m-d H:i:s', strtotime($request['created_at'])),
                ]);
            } catch (\Throwable $th) {
                return $th;
            }
            $ultima = UserCuestImpresionDiagnostica::where("id",$request->id)->get();

            return Response()->json($ultima);
    }
    static function show($user_id)
    {
        //dump($user_id);
        $episodio_id = UserCuestEpisodio::ultimoEpisodio_id($user_id);
        /*
        return UserCuestImpresionDiagnostica::where("user_id",$user_id)
        ->where("user_cuest_episodio_id",$episodio_id)

        ->get();*/
        $model ="";
        try {
            $model = DB::select("
                SELECT
                    tabla.id,
                    tabla.value,
                    tabla.created_at AS created_at_default,
                    DATE_FORMAT(tabla.created_at, '%d/%m/%Y') AS created_at,
                    DATE_FORMAT(tabla.created_at, '%h:%i %p') AS hora,
                    CONCAT(
                        CASE
                            WHEN up.prefijo IS NOT NULL AND up.prefijo != 'null' THEN CONCAT(up.prefijo,' ')
                            ELSE ''
                        END,

                        up.apellidos,
                        ' ',
                        up.nombres
                    ) AS medico
                    FROM user_cuest_imp_diagn AS tabla
                    INNER JOIN user_profile AS up ON tabla.user_id_medico = up.user_id
                    WHERE tabla.user_id = ".$user_id."
                    AND tabla.user_cuest_episodio_id = ".$episodio_id."
                    ORDER BY tabla.created_at DESC
            ", [1]);
        } catch (\Throwable $th) {
            dd($th);
        }
        return  $model;
    }
    static function eliminar($user_cuest_imp_diagn_id)
    {
        //dump($user_cuest_imp_diagn_id);
        $model = UserCuestImpresionDiagnostica::where('id',$user_cuest_imp_diagn_id);
        $user_id = $model->value('user_id');
        $model->delete();
        //dump($user_id);
        return Response()->json(UserCuestImpresionDiagnostica::show($user_id));
    }
    static function store4(Request $request)
    {
        $model = UserCuestImpresionDiagnostica::updateOrCreate([


                   'user_cita_id'   => $request->cita_id,
                   'user_id'   => $request->user_id
               ],[
                   'cat_user_cuestionario_id'   => 101,
                   'value'   => $request->value,
                   'coments'   => null,
                   'user_cita_id'   => $request->cita_id,
                   'user_id'   => $request->user_id,
                   'user_id_medico'   => Auth::id(),
                   'created_at'   => date('Y-m-d H:i:s', strtotime($request['created_at'])),

               ]);
        return Response()->json($model);
    }
}
