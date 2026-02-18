<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class UserCuestMedicamento extends Model
{
    protected $table = "medicamento_permanente";
    protected $fillable = [
        "id",
        "medicamento",
        "user_id_medico",
        "user_id_paciente",
        "user_cita_id",
        "user_cuest_episodio_id",
        "created_at"
    ];
    static function store(Request $request)
    {

        $model = UserCuestMedicamento::updateOrCreate(
                [
                    'user_id_paciente'   => $request->user_id_paciente,
                    'medicamento' => $request->value,
                    'user_cita_id'   => $request->user_cita_id
                ],
                [
                    'medicamento'   => $request->value,
                    'user_cita_id'   => $request->user_cita_id,
                    'user_id_paciente'   => $request->user_id_paciente,
                    'user_id_medico' => Auth::id(),
                    "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                ]
            );



        return Response()->json($model);
    }
}

