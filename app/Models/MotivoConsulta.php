<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class MotivoConsulta extends Model
{
    protected $table = "motivo_consulta";
    protected $fillable = [
        "id",
        "value",
        "user_id_medico",
        "user_id_paciente",
        "cita_id",
        "user_cuest_episodio_id",
        "created_at"
    ];
    // static function store(Request $request)
    // {
    //     $model = MotivoConsulta::updateOrCreate(
    //             [
    //                 'user_id_paciente'   => $request->user_id_paciente,
    //                 'cita_id'   => $request->cita_id
    //             ],
    //             [
    //                 'value'   => $request->value,
    //                 'user_id_paciente'   => $request->user_id_paciente,
    //                 'user_id_medico' => Auth::id(),
    //                 "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
    //             ]
    //         );

    //     return Response()->json($model);
    // }
    static function store(Request $request)
    {
        $model1 = MotivoConsulta::updateOrCreate(
                [
                    'user_id_paciente'   => $request->user_id_paciente,
                    'user_cita_id'   => $request->cita_id
                ],
                [
                    'value'   => $request->value,
                    'user_id_paciente'   => $request->user_id_paciente,
                    'user_id_medico' => Auth::id(),
                    "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                ]
            );

            $model2 = UserCita::updateOrCreate(
            [
                'id'=>$request->cita_id
            ],
            [
                "reason_for_consultation" =>$request->value
            ]);
        return Response()->json($model1);
    }
    static function store2(Request $request)
    {
        $model = MotivoConsulta::updateOrCreate(
                [
                    'user_id_paciente'   => $request->user_id_paciente,
                    'user_cuest_episodio_id'   => $request->episodio_id
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
}
