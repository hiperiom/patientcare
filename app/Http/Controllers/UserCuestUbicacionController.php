<?php

namespace App\Http\Controllers;

use App\Models\UserCuestUbicacion;
use App\Models\UserCuestEpisodio;
use App\Models\UserCuestImpresionDiagnostica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class UserCuestUbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return CatUserCuestionario::getTac();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return UserCuestUbicacion::store($request);
    }
    public function storeReingreso(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);

        //PARA EL REGISTRO DE PACIENTES EXTERNO

        if ($request->value== "Ingreso" || $request->value== "Reingreso") {
            UserCuestEpisodio::store($request);
            UserCuestImpresionDiagnostica::where("user_id",$request->user_id)
            ->where("active",1)
            ->update(["active"=>0]);
        }

        $ubicacion = $request['cat_user_ubicacion_id'];

        UserCuestUbicacion::where("user_id_paciente",$request->user_id_paciente)
        ->where("active",1)
        ->update([
            "active"=>0,
            "deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))
        ]);


        $model = new UserCuestUbicacion();
        $model->user_cuest_episodio_id = $episode_id;
        $model->cat_user_ubicacion_id = $ubicacion;
        $model->active = 1;
        $model->user_id_paciente = $request->user_id_paciente;
        $model->user_id_medico = Auth::id();

        if ($request->value== "Egreso") {
            $penultimo_episode_id = UserCuestEpisodio::ultimoEpisodioNoActivo_id($request->user_id_paciente);
            $model->user_cuest_episodio_id= $penultimo_episode_id;
        }else{
            $model->user_cuest_episodio_id= UserCuestEpisodio::ultimoEpisodio_id($request->user_id_paciente);
        }
        $model->value = isset($request->value)?$request->value:NULL;
        $model->prioridad = isset($request->prioridad_lista)?$request->prioridad_lista:0;
        if(isset($request->coment)){
            $model->coments = $request->coment;
        }

        $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
        $model->save();





        //dd(UserCuestUbicacion::show($request->user_id_paciente));
        return UserCuestUbicacion::show($request->user_id_paciente);
    }
    public function store2(Request $request)
    {
        return Response()->json(UserCuestUbicacion::store2($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        return UserCuestUbicacion::show($request->user_id);
    }
    public function getAllPad(Request $request)
    {
        UserCuestUbicacion::getAllPad();

    }
    public function getAllHospitalizados(Request $request)
    {
        UserCuestUbicacion::getAllPad();

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function historialUbiEpisodio($id)
    {
        return Response()->json(UserCuestUbicacion::historialUbiEpisodio($id));
    }
    public function historialAltas($id)
    {
        return Response()->json(UserCuestUbicacion::historialAltas($id));
    }
    public function ultimoIngreso($user_id)
    {
        return Response()->json(UserCuestUbicacion::ultimoIngreso($user_id));
    }
    public function getUbicacionIdByUserId(Request $request){
        $ultimasUbicaciones = UserCuestUbicacion::where('user_id_paciente', $request->user_id)->orderBy('id', 'DESC')->get();
        return $ultimasUbicaciones;
    }
}
