<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTipoDocumento extends Model
{
    protected $table = "user_tipo_documento";
    protected $fillable = [
        "user_cuest_episodio_id",
        "cat_tipo_documento_id",
        "nro_documento",
        "user_id_paciente",
        "user_id_medico",
        "sello",
        "recipe_num",
        "user_cuest_recipe_id",
        "user_cuest_estudio_id",
        "user_cita_id",
        "firma",
        "created_at",
        "updated_at",
    ];

}
