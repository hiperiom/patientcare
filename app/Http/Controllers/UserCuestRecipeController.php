<?php

namespace App\Http\Controllers;

use App\Models\UserCuestRecipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserCuestRecipeController extends Controller
{
    public function store(Request $request)
    {
        return UserCuestRecipe::store($request);
    }
    public function store_cita(Request $request)
    {
        return UserCuestRecipe::store_cita($request);
    }
    public function index_by_cita($cita_id)
    {
        return UserCuestRecipe::index_by_cita($cita_id);
    }
    public function update(Request $request,$id)
    {
        return UserCuestRecipe::actualizar($request);
    }
    public function destroy($id)
    {
        return UserCuestRecipe::eliminar($id);
    }
    public function temporal()
    {
        # BORRAR DESPUES DE USAR 06-09-2021


        $model = DB::select("
            SELECT
                user.id as user_id,
                user_cuest_episodio.id as episodio_id,
                user_cuest_episodio.ingreso as ingreso
            FROM user
            JOIN user_profile ON user.id = user_profile.user_id
            JOIN user_cuest_episodio ON user.id = user_cuest_episodio.user_id
            JOIN user_type ON user_profile.user_id = user_type.user_id
            JOIN user_cuest_ubicacion ON user_profile.user_id = user_cuest_ubicacion.user_id_paciente
            JOIN cat_user_ubicacion ON user_cuest_ubicacion.cat_user_ubicacion_id = cat_user_ubicacion.id
            WHERE user_profile.nombres IS NOT NULL
            AND user_cuest_ubicacion.cat_user_ubicacion_id NOT IN (246,247,248,249,250,251,364,365,366,367)
            AND user_profile.apellidos IS NOT NULL
            AND user_profile.fnacimiento IS NOT NULL
            AND user_profile.genero IS NOT NULL
            AND user_cuest_ubicacion.active = 1
            AND user_cuest_episodio.active = 1
        ", [1]);

        foreach ($model as $key => $value) {
            DB::table('user_cuest_recipe')
            ->where('user_id',$value->user_id)
            ->where('created_at','>=',$value->ingreso)
           ->update([
               'user_cuest_episodio_id'=>$value->episodio_id
           ]);
        }
    }
}
