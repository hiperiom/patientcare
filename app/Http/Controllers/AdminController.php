<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use App\Models\UserCuestInforme;
use App\Models\UserCuestEpisodio;
use App\Models\UserCuestTemperatura;
use App\Models\UserCuestOximetria;
use App\Models\UserCuestFc;
use App\Models\UserCuestFr;
use App\Models\UserCuestTa;
use App\Models\UserCuestGlic;
use App\Models\UserCuestTac;
use App\Models\UserCuestSintoma;
use App\Models\UserCuestMonitoreo;
use App\Models\UserCuestLaboratorio;
use App\Models\CatUserCuestionario;
use App\Models\UserCuestImpresionDiagnostica;
use App\Models\MotivoConsulta;
use App\Models\EnfermedadActual;
use App\Models\UserCuestAntecedente;
use App\Models\UserCondicionMedica;
use App\Models\UserAlergia;
use App\Models\UserCuestMedicamento;
use App\Models\UserCuestPlan;
use App\Models\UserCuestUbicacion;
use App\Models\UserCuestRecipe;
use App\Models\ExamenFisico;
use App\Models\UserProfile;
use App\Models\CentroSalud;
use App\Models\UserCuestImagen;
use App\Models\UserCuestFotografia;
use App\Models\UserCuestOtroArchivo;
use App\Models\UserCita;
use App\Models\UserCuestEstudio;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Barryvdh\DomPDF\Facade as PDF;
use DateTime;
use Illuminate\Support\Facades\DB;
use App\Mail\MessageReceived;
use App\Mail\MessageRecipe;
use App\Mail\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataIndex($dateStart,$dateEnd)
    {
        $response=[];
        //$dateStart = (date("Y")."-".(date("m")-1)."-01 00:00:00");
        //$dateEnd = date("Y-m-d ")."23:59:59" ;



        $emergencias = new UserCuestUbicacion();
        $emergencias = $emergencias->join("user_type","user_cuest_ubicacion.user_id_paciente","user_type.user_id");
        $emergencias = $emergencias->join("user_profile","user_cuest_ubicacion.user_id_paciente","user_profile.user_id");
        $emergencias = $emergencias->join("user_cuest_episodio","user_cuest_ubicacion.user_cuest_episodio_id","user_cuest_episodio.id");
        $emergencias = $emergencias->where("user_type.cat_user_type_id",1);
        //$emergencias = $emergencias->where("user_cuest_ubicacion.active",1);
        $emergencias = $emergencias->whereNotIn("user_cuest_ubicacion.cat_user_ubicacion_id",[246,251,247,248,249,250,387]);
        $emergencias = $emergencias->whereBetween("user_cuest_episodio.ingreso",[ $dateStart." 00:00:00" , $dateEnd." 23:59:59" ] );
        $emergencias = $emergencias->whereNotNull("user_profile.nacionalidad");
        $emergencias = $emergencias->whereNotNull("user_profile.cedula");
        $emergencias = $emergencias->whereNotNull("user_profile.nombres");
        $emergencias = $emergencias->whereNotNull("user_profile.apellidos");
        $emergencias = $emergencias->whereNotNull("user_profile.fnacimiento");
        $emergencias = $emergencias->whereNotNull("user_profile.genero");
        $emergencias = $emergencias->select(
            DB::raw("
                DISTINCT user_profile.cedula
            "),
            "user_cuest_ubicacion.cat_user_ubicacion_id",
            "user_profile.user_id",
            "user_profile.nombres",
            "user_profile.apellidos",
            "user_profile.genero",
            "user_profile.imagen",
            "user_profile.nacionalidad",
            "user_profile.created_at",

            "user_cuest_ubicacion.user_id_paciente",
            "user_cuest_ubicacion.user_id_medico AS user_cuest_ubicacion_user_id_medico",
            "user_cuest_ubicacion.value AS description_ingreso",
            "user_cuest_ubicacion.user_cuest_episodio_id AS episodio_id",
            "user_cuest_ubicacion.active AS user_cuest_ubicacion_active",
            "user_cuest_ubicacion.created_at AS user_cuest_ubicacion_create_at",

            "user_cuest_episodio.id AS episodio_id",
            "user_cuest_episodio.ingreso AS episodio_ingreso",
            "user_cuest_episodio.egreso AS episodio_egreso",
            "user_cuest_episodio.active AS episodio_active",
            "user_cuest_episodio.dia_hos",
            "user_cuest_episodio.cat_user_ubicacion_id AS episodio_ultima_ubicacion_id"
        );
        $emergencias = $emergencias->get();
        $emergencias = $emergencias->toArray();
        //dd($emergencias);
        $laboratorios = new UserCuestLaboratorio();
        $laboratorios = $laboratorios->whereBetween("user_cuest_laboratorio.created_at",[ $dateStart." 00:00:00" , $dateEnd." 23:59:59" ] );
        $laboratorios = $laboratorios->get();
        $laboratorios = $laboratorios->toArray();

        $imagenes = new UserCuestFotografia();
        $imagenes = $imagenes->whereBetween("user_cuest_fotografia.created_at",[ $dateStart." 00:00:00" , $dateEnd." 23:59:59" ] );
        $imagenes = $imagenes->get();
        $imagenes = $imagenes->toArray();
        $dstart = explode("-",$dateStart);
        $dEnd = explode("-",$dateEnd);
        // $citas = UserCita::whereBetween("fecha_cita",[ $dateStart." 00:00:00" , $dateEnd." 23:59:59" ])
        //         ->get()
        //         ->toArray();
        $citas = new UserCita();
        // $citas = $citas->join("user_type","user_cita.user_id_paciente","user_type.user_id");
        // $citas = $citas->join("user_profile","user_cita.user_id_paciente","user_profile.user_id");
        // $citas = $citas->where("user_type.cat_user_type_id",1);
        // $citas = $citas->whereNotNull("user_profile.nacionalidad");
        // $citas = $citas->whereNotNull("user_profile.cedula");
        // $citas = $citas->whereNotNull("user_profile.nombres");
        // $citas = $citas->whereNotNull("user_profile.apellidos");
        // $citas = $citas->whereNotNull("user_profile.fnacimiento");
        // $citas = $citas->whereNotNull("user_profile.genero");
        $citas = $citas->select(
            "user_cita.*",
            DB::raw("
                STR_TO_DATE(
                    CONCAT(
                        user_cita.year,'/',
                        user_cita.month,'/',
                        user_cita.day,' ',
                        user_cita.hour
                    ),
                    '%Y/%m/%d %T'
                ) AS fecha_cita
            ")
        );
        $citas = $citas->get();
        $citas = $citas->whereBetween("fecha_cita",[ $dateStart." 00:00:00" , $dateEnd." 23:59:59" ] );
        $citas = $citas->toArray();
        // dd($citas);

        $response['total_emergencia'] = count(array_filter($emergencias, function($v, $k) {
                                                        return  !in_array($v['cat_user_ubicacion_id'],[389,388]);
                                                    }, ARRAY_FILTER_USE_BOTH));

        $response['total_emergencia_adulto'] =     count(array_filter($emergencias, function($v, $k) {
                                                        return $v['cat_user_ubicacion_id'] == 2;
                                                    }, ARRAY_FILTER_USE_BOTH));
        $response['total_emergencia_pediatrico'] =     count(array_filter($emergencias, function($v, $k) {
                                                        return $v['cat_user_ubicacion_id'] == 28;
                                                    }, ARRAY_FILTER_USE_BOTH));
        $response['total_emergencia_covid'] =     count(array_filter($emergencias, function($v, $k) {
                                                        return $v['cat_user_ubicacion_id'] == 6;
                                                    }, ARRAY_FILTER_USE_BOTH));
        $response['total_atencion_domiciliaria'] =     count(array_filter($emergencias, function($v, $k) {
                                                        return in_array($v['cat_user_ubicacion_id'],[388,389]);
                                                    }, ARRAY_FILTER_USE_BOTH));
        $response['total_traslados'] =     count(array_filter($emergencias, function($v, $k) {
                                                        return $v['cat_user_ubicacion_id'] == 389;
                                                    }, ARRAY_FILTER_USE_BOTH));
        $response['total_ad'] =     count(array_filter($emergencias, function($v, $k) {
                                                        return $v['cat_user_ubicacion_id'] == 388;
                                                    }, ARRAY_FILTER_USE_BOTH));
        $response['total_laboratorios'] = count($laboratorios);
        $response['total_imagenes'] = count($imagenes);

        $response['total_apoyo_diagnostico'] = count($imagenes) + count($laboratorios);

        // $response['total_citas_aprobadas'] =  count(array_filter($citas, function($v, $k) {
        //     return $v['cat_user_cita_status_id'] == 4;
        // }, ARRAY_FILTER_USE_BOTH));

        // $response['total_citas_presconsulta'] =  count(array_filter($citas, function($v, $k) {
        //     return $v['cat_user_cita_status_id'] == 5;
        // }, ARRAY_FILTER_USE_BOTH));

        $response['total_citas_consulta'] =  count(array_filter($citas, function($v, $k) {
            return $v['cat_user_cita_status_id'] == 6;
        }, ARRAY_FILTER_USE_BOTH));

        $response['total_citas_finalizada'] =  count(array_filter($citas, function($v, $k) {
            return $v['cat_user_cita_status_id'] == 7;
        }, ARRAY_FILTER_USE_BOTH));

        $response['total_citas'] = $response['total_citas_consulta'] + $response['total_citas_finalizada'];

        /*         $response['total_citas_creada'] =  count(array_filter($citas, function($v, $k) {
                                                        return $v['cat_user_cita_status_id'] == 1;
                                                    }, ARRAY_FILTER_USE_BOTH));
                $response['total_citas_reprogramada'] =  count(array_filter($citas, function($v, $k) {
                                                        return $v['cat_user_cita_status_id'] == 2;
                                                    }, ARRAY_FILTER_USE_BOTH));
                $response['total_citas_cancelada'] =  count(array_filter($citas, function($v, $k) {
                                                        return $v['cat_user_cita_status_id'] == 3;
                                                    }, ARRAY_FILTER_USE_BOTH));
                $response['total_citas_aprobada'] =  count(array_filter($citas, function($v, $k) {
                                                        return $v['cat_user_cita_status_id'] == 4;
                                                    }, ARRAY_FILTER_USE_BOTH));
                $response['total_citas_preconsulta'] =  count(array_filter($citas, function($v, $k) {
                                                        return $v['cat_user_cita_status_id'] == 5;
                                                    }, ARRAY_FILTER_USE_BOTH));


                $response['total_citas_atendido'] =  count(array_filter($citas, function($v, $k) {
                                                        return $v['cat_user_cita_status_id'] == 8;
                                                    }, ARRAY_FILTER_USE_BOTH));
                $response['total_citas_no_asistio'] =  count(array_filter($citas, function($v, $k) {
                                                        return $v['cat_user_cita_status_id'] == 9;
                                                    }, ARRAY_FILTER_USE_BOTH));
        */
        // foreach ([1,2,3,4,5,6,7,8,11,13] as $key => $value) {
            foreach ([1] as $key => $value) {
// dd($citas);
            $response['centro_salud_'. $value .'_total_citas_consulta'] =  count(array_filter($citas, function($v, $k) use ($value) {
                return $v['centro_salud_id'] == $value &&  in_array($v['cat_user_cita_status_id'],[5,6]);
            }, ARRAY_FILTER_USE_BOTH));

            $response['centro_salud_'. $value .'_total_citas_finalizada'] =  count(array_filter($citas, function($v, $k) use ($value) {
                return $v['centro_salud_id'] == $value && $v['cat_user_cita_status_id'] == 7;
            }, ARRAY_FILTER_USE_BOTH));

            $response['centro_salud_'. $value .'_total_citas'] = (int) $response['centro_salud_'. $value .'_total_citas_consulta'] + $response['centro_salud_'. $value .'_total_citas_finalizada'];
        }
        return $response;
    }
    public function index()
    {

        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        return view("Admin.admin");
    }
    public function reportes()
    {

        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        return view("admin.reportes");
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
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
