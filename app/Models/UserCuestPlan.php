<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserCuestPlan extends Model
{
    protected $table = "user_cuest_plan";
    protected $fillable = [
        "id",
        "value",
        "user_id_medico",
        "cat_user_cuestionario_id",
        "user_id",
        "user_cita_id",
        "user_cuest_episodio_id",
        "created_at"
    ];

    static function index_episodio($episodio_id)
    {
        return UserCuestPlan::where('user_cuest_episodio_id',$episodio_id)
        ->select('id', 'value', 'coments','user_id_medico','created_at')
        ->orderBy("id","DESC")
        ->get();
    }

    static function store(Request $request)
    {
        /* $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id); */

           /*  $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id); */
            try {
                UserCuestPlan::where("user_id",$request->user_id)
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);


                $model = new UserCuestPlan();

                $model->cat_user_cuestionario_id = 102;
                $model->value = $request->value;
                $model->coments = null;
                $model->user_id = $request->user_id;

                $model->user_cuest_episodio_id  = $request->episodio_id;
                $model->user_id_medico =Auth::id();
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();
                return $model;
            } catch (\Throwable $th) {
                return $th->errorInfo[2];
            }
            return Response()->json(UserCuestPlan::show($request->user_id));
    }
    static function store2(Request $request)
    {
        $model = UserCuestPlan::updateOrCreate(
                [
                    'user_id'   => $request->user_id,
                    'user_cita_id'   => $request->cita_id
                ],
                [

                    'cat_user_cuestionario_id'   => 102,
                    'value'   => $request->value,
                    'user_cita_id'   => $request->cita_id,
                    'user_id'   => $request->user_id,
                    'user_id_medico' => Auth::id(),
                    "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                ]
            );
        return Response()->json($model);
    }
    static function show($user_id)
    {
        //return UserCuestPlan::where("user_id",$user_id)->where("active",1)->first();
        $episodio_id = UserCuestEpisodio::ultimoEpisodio_id($user_id);
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

                    FROM user_cuest_plan AS tabla
                    INNER JOIN user_profile AS up ON tabla.user_id_medico = up.user_id
                    WHERE tabla.user_id = ".$user_id."
                    AND tabla.user_cuest_episodio_id = ".$episodio_id."
            ", [1]);
        return $model;
    }
    static function actualizar2(Request $request)
    {
            try {

                DB::table('user_cuest_plan')
                ->where('id', $request->id)
                ->update([
                    'value' => $request->value,
                    'user_id_medico'=> Auth::id(),
                    'created_at'=> date('Y-m-d H:i:s', strtotime($request['created_at'])),
                ]);
            } catch (\Throwable $th) {
                return $th;
            }
            $ultima = UserCuestPlan::where("id",$request->id)->get();

            return Response()->json($ultima);
    }
    static function eliminar($id)
    {
        $model = UserCuestPlan::where('id',$id);
        $user_id = $model->value('user_id');
        $model->delete();
        return Response()->json(UserCuestPlan::show($id));
    }
}
