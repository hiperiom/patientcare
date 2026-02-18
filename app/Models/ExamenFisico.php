<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ExamenFisico extends Model
{
    protected $table = "examen_fisico";
    protected $fillable = [
        "id",
        "value",
        "user_id_medico",
        "user_id_paciente",
        "user_cita_id",
        "user_cuest_episodio_id",
        "created_at"
    ];
    // static function store(Request $request)
    // {
    //     $model = ExamenFisico::updateOrCreate(
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
        $model = ExamenFisico::updateOrCreate(
                [
                    'user_id_paciente'   => $request->user_id_paciente,
                    'user_cita_id'   => $request->cita_id
                ],
                [
                    'value'   => $request->value,
                    'user_cita_id'   => $request->cita_id,
                    'user_id_paciente'   => $request->user_id_paciente,
                    'user_id_medico' => Auth::id(),
                    "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                ]
            );
        return Response()->json($model);
    }
    static function store2(Request $request)
    {
        $model = ExamenFisico::updateOrCreate(
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
