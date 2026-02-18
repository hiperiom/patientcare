<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCuestMonitoreo;
use App\Models\UserCuestAntecedente;
use App\Models\UserCuestComorbilidad;
use App\Models\UserCuestEgreso;
use App\Models\UserCuestEstudio;
use App\Models\UserCuestGlic;
use App\Models\UserCuestImpresionDiagnostica;
use App\Models\UserCuestInforme;
use App\Models\UserCuestLaboratorio;
use App\Models\UserCuestMedicoPaciente;
use App\Models\UserCuestObservacion;
use App\Models\UserCuestOtroArchivo;
use App\Models\UserCuestOximetria;
use App\Models\UserCuestPlan;
use App\Models\UserCuestPruebaCovid;
use App\Models\UserCuestRecipe;
use App\Models\UserCuestSintoma;
use App\Models\UserCuestTa;
use App\Models\UserCuestTac;
use App\Models\UserCuestTemperatura;
use Illuminate\Support\Facades\DB;

class UserCuestMonitoreoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $r= UserCuestMonitoreo::store($request);
        if ($r) {echo "Paciente Monitoreo OK<br>";}


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy(Request $request)
    {
        return UserCuestMonitoreo::eliminar($request);
    }

    public function getAllOximetria(Request $request)
    {
        return UserCuestMonitoreo::getAllOximetria($request->user_id);
    }
    public function getAllOxigenoterapia(Request $request)
    {
        return UserCuestMonitoreo::getAllOxigenoterapia($request->user_id);
    }
    public function getAllSintomas(Request $request)
    {
        return UserCuestMonitoreo::getAllSintomas($request->user_id);
    }
    public function getOximetria(Request $request)
    {
        return UserCuestMonitoreo::getOximetria($request->user_id);
    }
    public function getOxigenoterapia(Request $request)
    {
        return UserCuestMonitoreo::getOxigenoterapia($request->user_id);
    }

}
