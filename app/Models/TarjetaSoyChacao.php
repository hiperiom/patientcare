<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TarjetaSoyChacao extends Model
{
    protected $table = "tarjeta_soy_chacao";
    protected $fillable = [
        "id",
        "active",
        "description",
        "user_id_medico",
        "user_id_paciente",
        "created_at",
    ];

    static function update_item(Request $request){
        $model = TarjetaSoyChacao::updateOrCreate(
            [
                "user_id_paciente" => $request->user_id],
            [
                "description" => $request->value,
                "user_id" => $request->user_id
            ]
        );
        return Response()->json($model) ;

    }
}
