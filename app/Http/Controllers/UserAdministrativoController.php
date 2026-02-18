<?php

namespace App\Http\Controllers;

use App\Models\UserAdministrador;
use App\Models\UserCuestEpisodio;
use App\Models\CatUserUbicacion;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
class UserAdministrativoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function app()
    {
        return view("Admin.app");
    }

    public function store_tipoPaciente(Request $request)
    {
        //dd($request->all());
        $model = DB::table("user_tipo_paciente")->where('user_cuest_episodio_id',$request->episodio_id)->first();

        if(empty($model)){
            $model = DB::table('user_tipo_paciente')->insert([
                'tipo_paciente' => !is_null($request->tipo_paciente) ? $request->tipo_paciente : 'Particular',
                'cat_empresa_id' => $request->cat_empresa_id ==="null" || is_null($request->cat_empresa_id)  ? NULL : $request->cat_empresa_id,
                'autorizado_por_id' => $request->autorizado_por_id ==="null" || is_null($request->autorizado_por_id)  ? NULL : $request->autorizado_por_id,
                'cat_aseguradora_id' => $request->cat_aseguradora_id ==="null" || is_null($request->cat_aseguradora_id)  ? NULL : $request->cat_aseguradora_id,
                'directorio_organizacional_id' => $request->directorio_organizacional_id ==="null" || is_null($request->directorio_organizacional_id)  ? NULL : $request->directorio_organizacional_id,
                'value1' =>$request->observaciones ==="null" || is_null($request->observaciones)  ? NULL : $request->observaciones,
                'value2' => $request->n_poliza ==="null" || is_null($request->n_poliza)  ? NULL : $request->n_poliza,
                'user_id' => $request->user_id_paciente,
                'user_id_medico' => Auth::id(),
                'user_cuest_episodio_id' => $request->episodio_id,
                'created_at' => $request->created_at
            ]);
        }else{
            $model = DB::table('user_tipo_paciente')
                ->where('user_cuest_episodio_id',$request->episodio_id)
                ->update([
                    'tipo_paciente' => !is_null($request->tipo_paciente) ? $request->tipo_paciente : 'Particular',
                    'cat_empresa_id' => $request->cat_empresa_id ==="null" || is_null($request->cat_empresa_id)  ? NULL : $request->cat_empresa_id,
                    'autorizado_por_id' => $request->autorizado_por_id ==="null" || is_null($request->autorizado_por_id)  ? NULL : $request->autorizado_por_id,
                    'cat_aseguradora_id' => $request->cat_aseguradora_id ==="null" || is_null($request->cat_aseguradora_id)  ? NULL : $request->cat_aseguradora_id,
                    'directorio_organizacional_id' => $request->directorio_organizacional_id ==="null" || is_null($request->directorio_organizacional_id)  ? NULL : $request->directorio_organizacional_id,
                    'value1' =>$request->observaciones ==="null" || is_null($request->observaciones)  ? NULL : $request->observaciones,
                    'value2' => $request->n_poliza ==="null" || is_null($request->n_poliza)  ? NULL : $request->n_poliza,

                ]);
        }
        $model = DB::table('user_tipo_paciente')->where('user_cuest_episodio_id',$request->episodio_id)->first();

        return Response()->json($model);
    }
    public function store_servicioEmergencia(Request $request)
    {
        $model = DB::table("servicio_emergencia")->where('user_cuest_episodio_id',$request->episodio_id)->first();
        //dd($model);
        if(empty($model)){
            $model = DB::table('servicio_emergencia')->insert([
                'tipo_emergencia' => $request->tipo_emergencia,
                'description' => $request->description,
                'value' => $request->value,
                'user_id_paciente' => $request->user_id_paciente,
                'user_id_medico' => Auth::id(),
                'user_cuest_episodio_id' => $request->episodio_id,
                'created_at' => $request->created_at
            ]);
        }else{
            $model = DB::table('servicio_emergencia')
                ->where('user_cuest_episodio_id',$request->episodio_id)
                ->update([
                    'tipo_emergencia' => $request->tipo_emergencia,
                    'description' => $request->description,
                    'value' => $request->value,
                ]);
        }

        $model = DB::table("servicio_emergencia")->where('user_cuest_episodio_id',$request->episodio_id)->first();
        if ($model->value == 1) {
            $model->description = "Walk in A";
            $model->color = "info";
        }
        if ($model->value == 2) {
            $model->description = "Walk in A +";
            $model->color = "info";
        }
        if ($model->value == 3) {
            $model->description = "Walk in B";
            $model->color = "success";
        }
        if ($model->value == 4) {
            $model->description = "Walk in B +";
            $model->color = "success";
        }
        if ($model->value == 5) {
            $model->description = "No Walk in";
            $model->color = "secondary";
        }
        if ($model->value == 6) {
            $model->description = "E. Conv.";
            $model->color = "gray";
        }
        return Response()->json($model);
    }
    public function destroy_servicioEmergencia(Request $request)
    {
        $model = DB::table("servicio_emergencia")->where('user_cuest_episodio_id',$request->episodio_id)->first();
        //dd($model);
        if(!empty($model)){

            $model = DB::table('servicio_emergencia')
                ->where('user_cuest_episodio_id',$request->episodio_id)
                ->delete();
        }


        return Response()->json([
            "tipo_emergencia"=>NULL,
            "description"=>NULL,
            "value"=>NULL,
            "active"=>NULL,
            "user_id_medico"=>NULL,
            "user_cuest_episodio_id"=>NULL,
            "user_id_paciente"=>NULL,
            'id'=>NULL,
            'color'=>'secondary',
        ]);
    }

}
