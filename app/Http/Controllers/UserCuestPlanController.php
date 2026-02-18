<?php

namespace App\Http\Controllers;

use App\Models\UserCuestPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserCuestPlanController extends Controller
{
    public function store(Request $request)
    {
        return UserCuestPlan::store($request);
    }
    public function getByCita($user_cita_id)
    {
        return UserCuestPlan::where("user_cita_id",$user_cita_id)->first();
    }
    public function store2(Request $request)
    {
        return UserCuestPlan::store2($request);
    }
    public function destroy($id)
    {
        return UserCuestPlan::eliminar($id);
    }
    public function temporal()
    {
        # BORRAR DESPUES DE USAR 06-09-2021
        $model = DB::select("
            SELECT
                user_cuest_plan.id,
            user_cuest_plan.user_id
            #user_cuest_plan.value
            FROM user_cuest_plan
            WHERE user_cuest_plan.user_id IN (
                SELECT
                    user.id
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
            )
            AND user_cuest_plan.created_at = (
                SELECT
                max(ucp.created_at)
                FROM user_cuest_plan as ucp
                WHERE ucp.user_id = user_cuest_plan.user_id
            )
        ", [1]);
        foreach ($model as $key => $value) {
            $episodio_id = DB::table('user_cuest_episodio')
            ->where('user_id',$value->user_id)
            ->orderBy("created_at","DESC")
            ->take(1)
            ->value('id');
         //dump($episodio_id);

            DB::table('user_cuest_plan')
            ->where('id',$value->id)
           ->update([
               'user_cuest_episodio_id'=>$episodio_id
           ]);
        }
    }
    public function update2(Request $request)
    {
        return UserCuestPlan::actualizar2($request);
    }
}
