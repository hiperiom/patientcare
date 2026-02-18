<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatUserMedicoPosicion extends Model
{
    protected $table = "cat_user_medico_posicion";
    protected $fillable = [
        'id',
        'description',
        'created_at',
    ];
    static function getAll()
    {
        return Response()->json(CatUserMedicoPosicion::get());

    }
}
