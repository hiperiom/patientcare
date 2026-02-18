<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserCuestPendiente extends Model
{
    protected $table = "user_cuest_pendiente";
    protected $fillable=[
        'user_id',
        'created_at',
        'user_cuest_episodio_id',
        'updated_at',
        'privado',
        'active',
        'id',
        'user_id_medico',

    ];
    static function store(Request $request)
    {
        $model = new UserCuestPendiente();
        $model->value = $request->value;
        $model->coments = $request->coments;
        $episodio_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
        $model->user_cuest_episodio_id = $episodio_id;
        $model->user_id = $request->user_id;
        $model->user_id_medico = Auth::id();
        $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
        $model->save();
        return UserCuestPendiente::show($request->user_id);
    }
    static function store2(Request $request)
    {
        $model = new UserCuestPendiente();
        $model->value = $request->value;
        $model->privado = $request->privado;
        $model->coments = $request->coments;

        $episodio_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);

        $model->user_cuest_episodio_id = $episodio_id;
        $model->user_id = $request->user_id;
        $model->user_id_medico = Auth::id();
        $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
        $model->save();

        return DB::select("
                    SELECT
                        id,
                        value,
                        privado,
                        active,
                        coments,
                        created_at AS created_at_default,
                        DATE_FORMAT(created_at, '%d/%m/%Y') AS created_at,
                        DATE_FORMAT(created_at, '%h:%i %p') AS hora
                        FROM user_cuest_pendiente AS tabla
                        WHERE tabla.user_id = ".$request->user_id."
                        AND tabla.user_cuest_episodio_id = ".$episodio_id."
                        ORDER BY tabla.created_at DESC
                ", [1]);
    }
    static function show($user_id){
        $episodio_id = UserCuestEpisodio::ultimoEpisodio_id($user_id);
        return UserCuestPendiente::where('user_cuest_pendiente.user_id',$user_id)
        ->join("user_profile", "user_cuest_pendiente.user_id_medico","user_profile.user_id")
        ->select(
            'user_cuest_pendiente.id',
            'user_cuest_pendiente.active',
            'user_cuest_pendiente.value AS title',
            DB::raw("
                DATE_FORMAT(user_cuest_pendiente.created_at, '%d/%m/%Y') AS fecha
            "),
            DB::raw("
                CONCAT(
                    CASE
                        WHEN user_profile.prefijo IS NOT NULL THEN CONCAT(user_profile.prefijo,' ')
                        ELSE ''
                    END,
                    user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) AS medico
            "),
            'user_profile.imagen',
            'user_cuest_pendiente.coments AS description',
            DB::raw("DATEDIFF(NOW(), user_cuest_pendiente.created_at) AS dias")
        )
        ->where('user_cuest_pendiente.user_cuest_episodio_id',$episodio_id)
        ->orderBy("user_cuest_pendiente.created_at","DESC")
        ->get();
    }
    static function actualizar(Request $request)
    {
        $models = json_decode($request->model);
     
        if (count($models) > 0) {
            foreach ($models as $key => $model) {
                $m = UserCuestPendiente::where('id',$model);
                $m->update([
                    'active' => 0,
                    'user_id_medico' => Auth::id(),
                    'updated_at' => date('Y-m-d H:i:s', strtotime($request['created_at']))
                ]);

            }
        }
        return UserCuestPendiente::show($request->user_id);
    }
    static function actualizar2(Request $request)
    {
        $m = UserCuestPendiente::where('id',$request->id);
        $user_id = $m->value('user_id');
        $m->update([
            'active' => 0,
            'user_id_medico' => Auth::id(),
            'updated_at' => date('Y-m-d H:i:s', strtotime($request['created_at']))
        ]);
        return UserCuestPendiente::where('user_id',$user_id)->where('active',1)->get();
    }
    static function eliminar(Request $request)
    {
        $model = UserCuestPendiente::where('id',$request->id);
        $user_id = $model->value('user_id');
        $model->delete();
        return UserCuestPendiente::show($user_id);
    }
}
