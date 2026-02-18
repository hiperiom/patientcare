<?php

namespace App\Http\Controllers;

use App\Models\TelesaludEmpresarial;
use App\Models\UserVip;
use App\Models\UserCuestAlert;
use App\Models\UserCuestResbalar;
use App\Models\UserCuestRiesgoQuirurgico;
use App\Models\UserCuestEpisodio;
use App\Models\UserCuestHistoriaMedica;
use App\Models\UserCuestMedicoPaciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TelesaludEmpresarialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        //$userInfo = UserProfile::where("user_id",Auth::id())->first();

        //$hospitalizados = UserCuestUbicacion::getAllHospitalizados();
        //$pad = UserCuestUbicacion::getAllPad();
        return view("medico.index_telesalud_empresarial2");
        //return view("paciente.index_nose");
    }
    public function getAll($area)
    {

        $model = DB::select("CALL paciente_covid_area('".$area."');", [1]);
        //dd($model);
        foreach ($model as $key => $value) {
            $model[$key]->total_episodios = UserCuestEpisodio::totalEpisodios($value->user_id);

            if (
                $value->cat_user_ubicacion_id != 246 &&
                $value->cat_user_ubicacion_id != 247 &&
                $value->cat_user_ubicacion_id != 248 &&
                $value->cat_user_ubicacion_id != 249 &&
                $value->cat_user_ubicacion_id != 251

                ) {

                $temp = UserCuestMedicoPaciente::show($value->user_id);

                $model[$key]->medico_paciente = $temp;
                if (!empty($value->episodio)) {
                    $temp = DB::select("
                        SELECT
                            id,
                            value,
                            privado,
                            active,
                            coments,
                            created_at AS created_at_default,
                            DATE_FORMAT(created_at, '%d/%m/%Y') AS created_at,
                            DATE_FORMAT(created_at, '%h:%i %p') AS hora
                            FROM user_cuest_pendiente AS tabla
                            WHERE tabla.user_id = ".$value->user_id."
                            AND tabla.user_cuest_episodio_id = ".$value->episodio."
                    ", [1]);
                    $model[$key]->pendiente = $temp;
                }else{
                    $model[$key]->pendiente = [];
                }
                //$model[$key]->vip = UserVip::show($value->user_id);
                $vip = UserVip::where("user_id_paciente",$value->user_id)->where("active",1)->select('description','value')->first();

                $model[$key]->vip = isset($vip->value) ?$vip->value:NULL;
                $model[$key]->vip_description = isset($vip->description) ?$vip->description:NULL;

                $alert = UserCuestAlert::where("user_id_paciente",$value->user_id)->where("active",1)->select('description','value')->first();
                $model[$key]->alert = isset($alert->value) ?$alert->value:NULL;
                $model[$key]->alert_description = isset($alert->description) ?$alert->description:NULL;

                $resbalar = UserCuestResbalar::where("user_id_paciente",$value->user_id)->where("active",1)->select('description','value')->first();
                $model[$key]->resbalar = isset($resbalar->value) ?$resbalar->value:NULL;
                $model[$key]->resbalar_description = isset($resbalar->description) ?$resbalar->description:NULL;

                $cirugia = UserCuestRiesgoQuirurgico::where("user_id_paciente",$value->user_id)->where("active",1)->select('description','value')->first();
                $model[$key]->cirugia = isset($cirugia->value) ?$cirugia->value:NULL;
                $model[$key]->cirugia_description = isset($cirugia->description) ?$cirugia->description:NULL;



                $prealta = UserCuestEpisodio::show($value->user_id)->pre_alta;
                $prealta =  !is_null($prealta) ? (new DateTime($prealta))->format('Y-m-d') : $prealta ;
                $model[$key]->prealta = $prealta;
                $model[$key]->prealta_color  = "info";
                if (!is_null($prealta)) {
                    date_default_timezone_set("America/Caracas");
                    $hoy = date("Y-m-d");
                    $fechaAnterior = (new DateTime($prealta))->format('Y-m-d');
                    $fecha1= new DateTime($hoy);
                    $fecha2= new DateTime($fechaAnterior);
                    $diff = $fecha1->diff($fecha2);


                    if ($diff->days < 0) {
                        $diff->days = 0;
                    }
                    if ($diff->days >= 2) {
                        $model[$key]->prealta_color = "success";
                    }
                    if ($diff->days == 1) {
                        $model[$key]->prealta_color = "warning";
                    }
                    if ($diff->days == 0) {
                        $model[$key]->prealta_color = "danger";
                    }
                }


                $temp = UserCuestHistoriaMedica::getHistorial($value->user_id);
                $model[$key]->resultados = $temp;
            }
        }
        //dd($model);
        return $model;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TelesaludEmpresarial  $telesaludEmpresarial
     * @return \Illuminate\Http\Response
     */
    public function show(TelesaludEmpresarial $telesaludEmpresarial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TelesaludEmpresarial  $telesaludEmpresarial
     * @return \Illuminate\Http\Response
     */
    public function edit(TelesaludEmpresarial $telesaludEmpresarial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TelesaludEmpresarial  $telesaludEmpresarial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TelesaludEmpresarial $telesaludEmpresarial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TelesaludEmpresarial  $telesaludEmpresarial
     * @return \Illuminate\Http\Response
     */
    public function destroy(TelesaludEmpresarial $telesaludEmpresarial)
    {
        //
    }
}
