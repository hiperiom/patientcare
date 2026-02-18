<?php

namespace App\Http\Controllers;

use App\Models\UserAdministrador;
use App\Models\UserCuestEpisodio;
use App\Models\CatUserUbicacion;
use App\Models\SolicitudQuirofano;
use App\Models\UserCuestImpresionDiagnostica;
use App\Models\UserCuestMedicoPaciente;
use App\Models\UserCuestPendiente;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Arr;
class UserAdministradorController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAdministrador  $userAdministrador
     * @return \Illuminate\Http\Response
     */
    public function show(UserAdministrador $userAdministrador)
    {
        //
    }
    public function solicitudes($model){
        $model2 = $model->select(
            DB::raw("DATE_FORMAT( solicitud_quirofano.h_inicio,'%Y-%m-%d' ) AS fecha_reservacion"),
            "solicitud_quirofano.active",
            "solicitud_quirofano.id",
            "solicitud_quirofano.status_id",
            "solicitud_quirofano.tipo_reservacion",
            "solicitud_quirofano.destino",
            "solicitud_quirofano.anestesiologo",
            "solicitud_quirofano.tipo_cupo",
            "solicitud_quirofano.fase_ubicacion",
            "solicitud_quirofano.cirujano_principal",
            "solicitud_quirofano.ayudante_1",
            "solicitud_quirofano.ayudante_2",
            "solicitud_quirofano.ayudante_3",
            "solicitud_quirofano.n_quirofano",
            "solicitud_quirofano.intervencion",
            "solicitud_quirofano.equipos_especiales",
            "solicitud_quirofano.h_inicio",
            "solicitud_quirofano.h_real_inicio",
            "solicitud_quirofano.h_fin",
            "solicitud_quirofano.h_aprox_fin",
            "solicitud_quirofano.circulante_anestesia",
            "solicitud_quirofano.circulante_cirugia",
            "solicitud_quirofano.instrumentista",
            "solicitud_quirofano.n_presupuesto",
            "solicitud_quirofano.dias_hospitalizacion",
            "solicitud_quirofano.anestesia_sugerida",
            "solicitud_quirofano.diagnostico_preoperatorio",
            "solicitud_quirofano.dias_uti",
            "solicitud_quirofano.area_intervencion",
            "user_profile.nacionalidad",
            "user_profile.nombres",
            "user_profile.apellidos",
            "user_profile.genero",
            "user_profile.fnacimiento",
            "user_profile.telefono_movil",
            "user_profile.telefono_hogar",

            "user.email",
            DB::raw("
                user_profile.user_id AS user_id_paciente
            "),
            DB::raw("
                (
                    YEAR( CURDATE() ) -
                    YEAR( user_profile.fnacimiento ) +
                    IF(
                        DATE_FORMAT( CURDATE() ,'%m-%d' ) >
                        DATE_FORMAT( user_profile.fnacimiento,'%m-%d' ), 0 , -1
                    )
                ) AS 'edad'
            "),

            DB::raw("
                DATE_FORMAT(h_inicio, '%h:%i') AS hora_inicio_formated
            "),
            DB::raw("
                user_profile.cedula AS documento_identidad
            "),
            DB::raw("
                CONCAT(
                    user_profile.nacionalidad,
                    ' ',
                    user_profile.cedula
                ) AS cedula
            "),
            DB::raw("
                CONCAT(
                    SUBSTRING_INDEX( user_profile.nombres, ' ', 1),
                    ' ',
                    SUBSTRING_INDEX( user_profile.apellidos, ' ', 1)
                ) AS paciente
            "),

            DB::raw("
                CASE WHEN solicitud_quirofano.h_aprox_fin < 1 THEN
                CONCAT(  (solicitud_quirofano.h_aprox_fin  *60) ,'min' )
                ELSE CONCAT(solicitud_quirofano.h_aprox_fin,'h') END AS horas_intervencion
            ")
        );
        return $model2;
    }
    public function getIngresosTotales( $desde,$hasta)
    {

        $condition1 = " AND uce.egreso IS NULL AND uce.active = 1  AND uce.ingreso < DATE_ADD(CURDATE(), INTERVAL 1 DAY) ";
        $limit = "";
        //dd($desde." " .$hasta);

        $model = DB::select("
            SELECT
                DISTINCT  uce.user_id,
                uce.*,
                ucu.cat_user_ubicacion_id,
                up.genero AS sexo,
                (
                    IF(
                        year(curdate()) > year(up.fnacimiento),
                        (year(curdate()) - year(up.fnacimiento)),
                        0
                    )
                ) AS edad
            FROM user_cuest_episodio AS uce
            INNER JOIN user ON uce.user_id = user.id
            INNER JOIN user_profile AS up ON uce.user_id = up.user_id
            INNER JOIN user_type AS ut ON up.user_id = ut.user_id
            INNER JOIN user_cuest_ubicacion AS ucu ON up.user_id = ucu.user_id_paciente
            INNER JOIN cat_user_ubicacion AS cuu ON ucu.cat_user_ubicacion_id = cuu.id
            WHERE up.nombres IS NOT NULL
            #AND uce.ingreso BETWEEN '". $desde ." 00:00:00' AND '". $hasta ." 23:59:59'
            AND ucu.cat_user_ubicacion_id NOT IN (429,245,246,247,248,249,250,251,364,365,366,367,371,386,387)
            AND up.apellidos IS NOT NULL
            AND up.fnacimiento IS NOT NULL
            AND up.genero IS NOT NULL
            AND up.cedula IS NOT NULL
            ".$condition1."
            AND ut.cat_user_type_id = 1
            AND ucu.active = 1
            ".$limit ."
            #LIMIT 1
        ");
        $newModel =[];
        //TRANSFORMAR CONSULTA EN ARRAY
        foreach ($model as $key => $value) {
            $newModel[$key] = (array) $value;
        }
        //dd($newModel);
        $resultset = [];

        $area_qx = new SolicitudQuirofano();
        $area_qx = $area_qx->whereDate('solicitud_quirofano.fecha_reservacion', date('Y-m-d'));
        $area_qx = $area_qx->whereIn('solicitud_quirofano.area_intervencion', 
        [
            418,//hospitalizacion
            422,//ambulatoria torre
            424,//oftalmologica
            425,//especialidades

        ] );
        $area_qx = $area_qx->join("user_profile","solicitud_quirofano.user_id_paciente","user_profile.user_id");
        $area_qx = $area_qx->join("user","solicitud_quirofano.user_id_paciente","user.id");
        $area_qx = $this->solicitudes($area_qx);
        $area_qx = $area_qx->orderBy("solicitud_quirofano.n_quirofano","ASC");
        $area_qx = $area_qx->orderBy("solicitud_quirofano.h_inicio","ASC");
        $area_qx = $area_qx->get()->toArray();
        //aq_total
        $resultset['area_qx']['total'] = count($area_qx);
        $resultset['area_qx']['programadas']['total'] = count($area_qx);
        //aq_total_adultos
        $resultset['area_qx']['programadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return $qx['edad'] > 17;
        }));
        //aq_total_pediatrico
        $resultset['area_qx']['programadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return $qx['edad'] < 18;
        }));
        $resultset['area_qx']['ejecutadas']['total'] = count(array_filter($area_qx, function($qx){
            return $qx['h_fin'] != NULL;
        }));
        //aq_total_adultos
        $resultset['area_qx']['ejecutadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return $qx['edad'] > 17 && $qx['h_fin'] != NULL;
        }));
        //aq_total_pediatrico
        $resultset['area_qx']['ejecutadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return $qx['edad'] < 18 && $qx['h_fin'] != NULL;
        }));

        //aq_torre_hospitalizacion_total
        $resultset['area_qx']['hospitalizacion']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418,422]);
        }));
        
        //aq_torre_hospitalizacion_programadas_total
        $resultset['area_qx']['hospitalizacion']['programadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418,422]);
        }));
        //aq_torre_hospitalizacion_programadas_adultos
        $resultset['area_qx']['hospitalizacion']['programadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418,422]) && $qx['edad'] > 17;
        }));
        //aq_torre_hospitalizacion_programadas_pediatrico
        $resultset['area_qx']['hospitalizacion']['programadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418,422]) && $qx['edad'] < 18;
        }));

        //aq_torre_hospitalizacion_ejecutadas_total
        $resultset['area_qx']['hospitalizacion']['ejecutadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418,422]) && $qx['h_fin'] != NULL;
        }));
        //aq_torre_hospitalizacion_ejecutadas_adulto
        $resultset['area_qx']['hospitalizacion']['ejecutadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418,422]) && $qx['edad'] > 17 && $qx['h_fin'] != NULL;
        }));
        //aq_torre_hospitalizacion_ejecutadas_pediatrico
        $resultset['area_qx']['hospitalizacion']['ejecutadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418,422]) && $qx['edad'] < 18 && $qx['h_fin'] != NULL;
        }));

        //aq_torre_mapm_total
        $resultset['area_qx']['mapm']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424,425]);
        }));
        
        //aq_torre_mapm_programadas_total
        $resultset['area_qx']['mapm']['programadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424,425]);
        }));
        //aq_torre_mapm_programadas_adultos
        $resultset['area_qx']['mapm']['programadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424,425]) && $qx['edad'] > 17;
        }));
        //aq_torre_mapm_programadas_pediatrico
        $resultset['area_qx']['mapm']['programadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424,425]) && $qx['edad'] < 18;
        }));

        //aq_torre_mapm_ejecutadas_total
        $resultset['area_qx']['mapm']['ejecutadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424,425]) && $qx['h_fin'] != NULL;
        }));
        //aq_torre_mapm_ejecutadas_adulto
        $resultset['area_qx']['mapm']['ejecutadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424,425]) && $qx['edad'] > 17 && $qx['h_fin'] != NULL;
        }));
        //aq_torre_mapm_ejecutadas_pediatrico
        $resultset['area_qx']['mapm']['ejecutadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424,425]) && $qx['edad'] < 18 && $qx['h_fin'] != NULL;
        }));

        //aq_torre_hospitalizacion_total
        $resultset['area_qx']['hospitalizacion']['ambulatoria_torre']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[422]);
        }));
        
        //aq_torre_hospitalizacion_programadas_total
        $resultset['area_qx']['hospitalizacion']['ambulatoria_torre']['programadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[422]);
        }));
        //aq_torre_hospitalizacion_programadas_adultos
        $resultset['area_qx']['hospitalizacion']['ambulatoria_torre']['programadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[422]) && $qx['edad'] > 17;
        }));
        //aq_torre_hospitalizacion_programadas_pediatrico
        $resultset['area_qx']['hospitalizacion']['ambulatoria_torre']['programadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[422]) && $qx['edad'] < 18;
        }));

        //aq_torre_hospitalizacion_ejecutadas_total
        $resultset['area_qx']['hospitalizacion']['ambulatoria_torre']['ejecutadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[422]) && $qx['h_fin'] != NULL;
        }));
        //aq_torre_hospitalizacion_ejecutadas_adulto
        $resultset['area_qx']['hospitalizacion']['ambulatoria_torre']['ejecutadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[422]) && $qx['edad'] > 17 && $qx['h_fin'] != NULL;
        }));
        //aq_torre_hospitalizacion_ejecutadas_pediatrico
        $resultset['area_qx']['hospitalizacion']['ambulatoria_torre']['ejecutadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[422]) && $qx['edad'] < 18 && $qx['h_fin'] != NULL;
        }));

        //aq_torre_hospitalizacion_total
        $resultset['area_qx']['hospitalizacion']['hospitalizacion_torre']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418]);
        }));
        
        //aq_torre_hospitalizacion_programadas_total
        $resultset['area_qx']['hospitalizacion']['hospitalizacion_torre']['programadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418]);
        }));
        //aq_torre_hospitalizacion_programadas_adultos
        $resultset['area_qx']['hospitalizacion']['hospitalizacion_torre']['programadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418]) && $qx['edad'] > 17;
        }));
        //aq_torre_hospitalizacion_programadas_pediatrico
        $resultset['area_qx']['hospitalizacion']['hospitalizacion_torre']['programadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418]) && $qx['edad'] < 18;
        }));

        //aq_torre_hospitalizacion_ejecutadas_total
        $resultset['area_qx']['hospitalizacion']['hospitalizacion_torre']['ejecutadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418]) && $qx['h_fin'] != NULL;
        }));
        //aq_torre_hospitalizacion_ejecutadas_adulto
        $resultset['area_qx']['hospitalizacion']['hospitalizacion_torre']['ejecutadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418]) && $qx['edad'] > 17 && $qx['h_fin'] != NULL;
        }));
        //aq_torre_hospitalizacion_ejecutadas_pediatrico
        $resultset['area_qx']['hospitalizacion']['hospitalizacion_torre']['ejecutadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418]) && $qx['edad'] < 18 && $qx['h_fin'] != NULL;
        }));

        //aq_torre_hospitalizacion_total
        $resultset['area_qx']['mapm']['oftalmologicas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424]);
        }));
        
        //aq_torre_hospitalizacion_programadas_total
        $resultset['area_qx']['mapm']['oftalmologicas']['programadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424]);
        }));
        //aq_torre_hospitalizacion_programadas_adultos
        $resultset['area_qx']['mapm']['oftalmologicas']['programadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424]) && $qx['edad'] > 17;
        }));
        //aq_torre_hospitalizacion_programadas_pediatrico
        $resultset['area_qx']['mapm']['oftalmologicas']['programadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424]) && $qx['edad'] < 18;
        }));

        //aq_torre_hospitalizacion_ejecutadas_total
        $resultset['area_qx']['mapm']['oftalmologicas']['ejecutadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424]) && $qx['h_fin'] != NULL;
        }));
        //aq_torre_hospitalizacion_ejecutadas_adulto
        $resultset['area_qx']['mapm']['oftalmologicas']['ejecutadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424]) && $qx['edad'] > 17 && $qx['h_fin'] != NULL;
        }));
        //aq_torre_hospitalizacion_ejecutadas_pediatrico
        $resultset['area_qx']['mapm']['oftalmologicas']['ejecutadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424]) && $qx['edad'] < 18 && $qx['h_fin'] != NULL;
        }));

        /************ */
        //aq_torre_hospitalizacion_total
        $resultset['area_qx']['mapm']['especialidades']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[425]);
        }));
        
        //aq_torre_hospitalizacion_programadas_total
        $resultset['area_qx']['mapm']['especialidades']['programadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[425]);
        }));
        //aq_torre_hospitalizacion_programadas_adultos
        $resultset['area_qx']['mapm']['especialidades']['programadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[425]) && $qx['edad'] > 17;
        }));
        //aq_torre_hospitalizacion_programadas_pediatrico
        $resultset['area_qx']['mapm']['especialidades']['programadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[425]) && $qx['edad'] < 18;
        }));

        //aq_torre_hospitalizacion_ejecutadas_total
        $resultset['area_qx']['mapm']['especialidades']['ejecutadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[425]) && $qx['h_fin'] != NULL;
        }));
        //aq_torre_hospitalizacion_ejecutadas_adulto
        $resultset['area_qx']['mapm']['especialidades']['ejecutadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[425]) && $qx['edad'] > 17 && $qx['h_fin'] != NULL;
        }));
        //aq_torre_hospitalizacion_ejecutadas_pediatrico
        $resultset['area_qx']['mapm']['especialidades']['ejecutadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[425]) && $qx['edad'] < 18 && $qx['h_fin'] != NULL;
        }));
        //EMERGENCIA ADULTO
        $resultset['emergencia_adulto']['a'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[4]);
        }));

        $resultset['emergencia_adulto']['b'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[5]);
        }));
        $resultset['emergencia_adulto']['triaje'] =  $resultset['emergencia_adulto']['a'] + $resultset['emergencia_adulto']['b'];

        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[270])->where("active",1)->select('id')->get()->toArray());
        $resultset['emergencia_adulto']['observacion'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));

        $resultset['emergencia_adulto']['traumashock'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[405]);
        }));
        $resultset['emergencia_adulto']['total'] =
            $resultset['emergencia_adulto']['triaje']+
            $resultset['emergencia_adulto']['observacion']+
            $resultset['emergencia_adulto']['traumashock']
        ;
        //EMERGENCIA PEDIATRICA
        $resultset['emergencia_pediatrica']['a'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[30]);
        }));

        $resultset['emergencia_pediatrica']['b'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[31]);
        }));
        $resultset['emergencia_pediatrica']['triaje'] =
            $resultset['emergencia_pediatrica']['a']+
            $resultset['emergencia_pediatrica']['b']
        ;

        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[32])->where("active",1)->select('id')->get()->toArray());
        $resultset['emergencia_pediatrica']['observacion'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));

        $resultset['emergencia_pediatrica']['traumashock'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[406]);
        }));
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[392])->where("active",1)->select('id')->get()->toArray());
        $resultset['emergencia_pediatrica']['nebulizacion'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));


        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[390])->where("active",1)->select('id')->get()->toArray());
        $resultset['emergencia_pediatrica']['hcep'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        $resultset['emergencia_pediatrica']['total'] =
            $resultset['emergencia_pediatrica']['triaje']+
            $resultset['emergencia_pediatrica']['observacion']+
            $resultset['emergencia_pediatrica']['traumashock']+
            $resultset['emergencia_pediatrica']['nebulizacion']+
            $resultset['emergencia_pediatrica']['hcep']
        ;
        $resultset['emergencia']['total'] =
            $resultset['emergencia_pediatrica']['total']+
            $resultset['emergencia_adulto']['total']
        ;
        //HOSPITALIZACION
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[42,71,235,236,99,127,234,155])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        $resultset['hospitalizacion']['pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));


        //PISO 2
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[42])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_2'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 2 ADULTO
        $resultset['hospitalizacion']['piso_2_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 2 PEDIATRICO
        $resultset['hospitalizacion']['piso_2_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));
        //PISO 2 A
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[42])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_2A'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 2 A ADULTO
        $resultset['hospitalizacion']['piso_2A_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 2 A PEDIATRICO
        $resultset['hospitalizacion']['piso_2A_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));
        //PISO 2 B
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_2B'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 2 B ADULTO
        $resultset['hospitalizacion']['piso_2B_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 2 B PEDIATRICO
        $resultset['hospitalizacion']['piso_2B_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));


        //PISO 3
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[71,235])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_3'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 3 ADULTO
        $resultset['hospitalizacion']['piso_3_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 3 PEDIATRICO
        $resultset['hospitalizacion']['piso_3_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));
        //PISO 3 A
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[71])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_3A'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 3 A ADULTO
        $resultset['hospitalizacion']['piso_3A_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 3 A PEDIATRICO
        $resultset['hospitalizacion']['piso_3A_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));
        //PISO 3 B
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[235])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_3B'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 3 B ADULTO
        $resultset['hospitalizacion']['piso_3B_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 3 B PEDIATRICO
        $resultset['hospitalizacion']['piso_3B_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));

        //PISO 4
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[236,99])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_4'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 4 ADULTO
        $resultset['hospitalizacion']['piso_4_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 4 PEDIATRICO
        $resultset['hospitalizacion']['piso_4_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));
        //PISO 4 A
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[236])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_4A'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 4 A ADULTO
        $resultset['hospitalizacion']['piso_4A_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 4 A PEDIATRICO
        $resultset['hospitalizacion']['piso_4A_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));
        //PISO 4 B
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[99])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_4B'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 4 B ADULTO
        $resultset['hospitalizacion']['piso_4B_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 4 B PEDIATRICO
        $resultset['hospitalizacion']['piso_4B_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));


        //PISO 5
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[127,234])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_5'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 5 ADULTO
        $resultset['hospitalizacion']['piso_5_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 5 PEDIATRICO
        $resultset['hospitalizacion']['piso_5_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));
        //PISO 5 A
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[127])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_5A'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 5 A ADULTO
        $resultset['hospitalizacion']['piso_5A_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 5 A PEDIATRICO
        $resultset['hospitalizacion']['piso_5A_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));
        //PISO 5 B
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[234])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_5B'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 5 B ADULTO
        $resultset['hospitalizacion']['piso_5B_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 5 B PEDIATRICO
        $resultset['hospitalizacion']['piso_5B_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));

        //PISO 6
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[155])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_6'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 6 ADULTO
        $resultset['hospitalizacion']['piso_6_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 6 PEDIATRICO
        $resultset['hospitalizacion']['piso_6_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));
        //PISO 6 A
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[155])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_6A'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 6 A ADULTO
        $resultset['hospitalizacion']['piso_6A_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 6 A PEDIATRICO
        $resultset['hospitalizacion']['piso_6A_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));
        //PISO 6 B
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_6B'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 6 B ADULTO
        $resultset['hospitalizacion']['piso_6B_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 6 B PEDIATRICO
        $resultset['hospitalizacion']['piso_6B_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));



        $resultset['hospitalizacion']['total'] =
            $resultset['hospitalizacion']['piso_2']+
            $resultset['hospitalizacion']['piso_3']+
            $resultset['hospitalizacion']['piso_4']+
            $resultset['hospitalizacion']['piso_5']+
            $resultset['hospitalizacion']['piso_6']
        ;

        //UTI
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[182])->where("active",1)->select('id')->get()->toArray());
        $resultset['uti']['adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[211])->where("active",1)->select('id')->get()->toArray());
        $resultset['uti']['pediatrica'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[391])->where("active",1)->select('id')->get()->toArray());
        $resultset['uti']['utin'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        $resultset['uti']['total'] =
            $resultset['uti']['adulto']+
            $resultset['uti']['pediatrica']+
            $resultset['uti']['utin'];
        //PAD


        $resultset['pad']['emergencia']['adulto'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[229]);
        }));
        $resultset['pad']['emergencia']['pediatrico'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[228]);
        }));
        $resultset['pad']['emergencia']['total'] =
            $resultset['pad']['emergencia']['adulto']+
            $resultset['pad']['emergencia']['pediatrico']
        ;
        $resultset['pad']['postquirurgico']['ambulatorio']['total'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[373]);
        }));
        $resultset['pad']['postquirurgico']['ambulatorio']['adulto'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[373]) && $episodio['edad'] > 17;;
        }));
        $resultset['pad']['postquirurgico']['ambulatorio']['pediatrico'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[373]) && $episodio['edad'] < 18;;
        }));

        $resultset['pad']['postquirurgico']['hospitalizacion']['total'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[374]);
        }));
        $resultset['pad']['postquirurgico']['hospitalizacion']['adulto'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[374]) && $episodio['edad'] > 17;;
        }));
        $resultset['pad']['postquirurgico']['hospitalizacion']['pediatrico'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[374]) && $episodio['edad'] < 18;;
        }));

        $resultset['pad']['postquirurgico']['total'] =
            $resultset['pad']['postquirurgico']['ambulatorio']['total']+
            $resultset['pad']['postquirurgico']['hospitalizacion']['total']
        ;
        $resultset['pad']['postquirurgico']['adulto'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[373,374]) && $episodio['edad'] > 17;;
        }));
        $resultset['pad']['postquirurgico']['pediatrico'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[373,374]) && $episodio['edad'] < 18;;
        }));


        $resultset['pad']['medico']['total'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[382]);
        }));
        $resultset['pad']['medico']['adulto'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[382]) && $episodio['edad'] > 17;;
        }));
        $resultset['pad']['medico']['pediatrico'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[382]) && $episodio['edad'] < 18;;
        }));

        $resultset['pad']['adulto'] = count(array_filter($newModel, function($episodio) {
            return in_array($episodio['cat_user_ubicacion_id'],[229,228,373,374,382]) && $episodio['edad'] > 17;
        }));
        $resultset['pad']['pediatrico'] = count(array_filter($newModel, function($episodio) {
            return in_array($episodio['cat_user_ubicacion_id'],[229,228,373,374,382]) && $episodio['edad'] < 18;
        }));
        $resultset['telesalud']['adulto'] = count(array_filter($newModel, function($episodio) {
            return in_array($episodio['cat_user_ubicacion_id'],[229,228,373,374,382]) && $episodio['edad'] > 17;
        }));
        $resultset['telesalud']['pediatrico'] = count(array_filter($newModel, function($episodio) {
            return in_array($episodio['cat_user_ubicacion_id'],[229,228,373,374,382]) && $episodio['edad'] < 18;
        }));


        $resultset['pad']['total'] =
            $resultset['pad']['emergencia']['total']+
            $resultset['pad']['postquirurgico']['total']+
            $resultset['pad']['medico']['total']
        ;
        $resultset['telesalud']['total'] =
            $resultset['pad']['total']
        ;
        $resultset['cmdlt']['adulto']=
            $resultset['emergencia_adulto']['total']+
            $resultset['area_qx']['programadas']['adulto']+
            $resultset['hospitalizacion']['adulto']+
            $resultset['uti']['adulto']
        ;

        $resultset['cmdlt']['pediatrico']=
            $resultset['emergencia_pediatrica']['total']+
            $resultset['area_qx']['programadas']['pediatrico']+
            $resultset['hospitalizacion']['pediatrico']+
            $resultset['uti']['pediatrica']
        ;

        $resultset['cmdlt']['total'] =
            $resultset['area_qx']['total']+
            $resultset['uti']['total']+
            $resultset['hospitalizacion']['total']+
            $resultset['emergencia']['total']
        ;

        //dd($resultset);
        return $resultset ;
    }
    public function getEgresosTotales( $desde,$hasta)
    {

        $condition1 = " AND uce.egreso IS NOT NULL AND uce.active = 0";
        $limit = "";
        //dd($desde." " .$hasta);

        $model = DB::select("
            SELECT
                DISTINCT  uce.user_id,
                uce.*,
                uce.cat_user_ubicacion_id,
                up.genero AS sexo,
                (
                    IF(
                        year(curdate()) > year(up.fnacimiento),
                        (year(curdate()) - year(up.fnacimiento)),
                        0
                    )
                ) AS edad
            FROM user_cuest_episodio AS uce
            INNER JOIN user ON uce.user_id = user.id
            INNER JOIN user_profile AS up ON uce.user_id = up.user_id
            INNER JOIN user_type AS ut ON up.user_id = ut.user_id
            WHERE up.nombres IS NOT NULL
            AND uce.egreso BETWEEN '". $desde ." 00:00:00' AND '". $hasta ." 23:59:59'
            AND uce.cat_user_ubicacion_id NOT IN (429)
            AND up.apellidos IS NOT NULL
            AND up.fnacimiento IS NOT NULL
            AND up.genero IS NOT NULL
            AND up.cedula IS NOT NULL
            ".$condition1."
            AND ut.cat_user_type_id = 1
            ".$limit ."
            #LIMIT 1
        ");
        $newModel =[];
        //TRANSFORMAR CONSULTA EN ARRAY
        foreach ($model as $key => $value) {
            $newModel[$key] = (array) $value;
        }
        //dd($newModel);
        $resultset = [];

        $area_qx = new SolicitudQuirofano();
        $area_qx = $area_qx->whereBetween("solicitud_quirofano.fecha_reservacion",[ $desde." 00:00:00",$hasta." 23:59:59"]);
        $area_qx = $area_qx->whereIn('solicitud_quirofano.area_intervencion', 
        [
            418,//hospitalizacion
            422,//ambulatoria torre
            424,//oftalmologica
            425,//especialidades

        ] );
        $area_qx = $area_qx->join("user_profile","solicitud_quirofano.user_id_paciente","user_profile.user_id");
        $area_qx = $area_qx->join("user","solicitud_quirofano.user_id_paciente","user.id");
        $area_qx = $this->solicitudes($area_qx);
        $area_qx = $area_qx->orderBy("solicitud_quirofano.n_quirofano","ASC");
        $area_qx = $area_qx->orderBy("solicitud_quirofano.h_inicio","ASC");
        $area_qx = $area_qx->get()->toArray();
        //aq_total
        $resultset['area_qx']['total'] = count($area_qx);
        $resultset['area_qx']['programadas']['total'] = count($area_qx);
        //aq_total_adultos
        $resultset['area_qx']['programadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return $qx['edad'] > 17;
        }));
        //aq_total_pediatrico
        $resultset['area_qx']['programadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return $qx['edad'] < 18;
        }));
        $resultset['area_qx']['ejecutadas']['total'] = count(array_filter($area_qx, function($qx){
            return $qx['h_fin'] != NULL;
        }));
        //aq_total_adultos
        $resultset['area_qx']['ejecutadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return $qx['edad'] > 17 && $qx['h_fin'] != NULL;
        }));
        //aq_total_pediatrico
        $resultset['area_qx']['ejecutadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return $qx['edad'] < 18 && $qx['h_fin'] != NULL;
        }));

        //aq_torre_hospitalizacion_total
        $resultset['area_qx']['hospitalizacion']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418,422]);
        }));
        
        //aq_torre_hospitalizacion_programadas_total
        $resultset['area_qx']['hospitalizacion']['programadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418,422]);
        }));
        //aq_torre_hospitalizacion_programadas_adultos
        $resultset['area_qx']['hospitalizacion']['programadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418,422]) && $qx['edad'] > 17;
        }));
        //aq_torre_hospitalizacion_programadas_pediatrico
        $resultset['area_qx']['hospitalizacion']['programadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418,422]) && $qx['edad'] < 18;
        }));

        //aq_torre_hospitalizacion_ejecutadas_total
        $resultset['area_qx']['hospitalizacion']['ejecutadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418,422]) && $qx['h_fin'] != NULL;
        }));
        //aq_torre_hospitalizacion_ejecutadas_adulto
        $resultset['area_qx']['hospitalizacion']['ejecutadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418,422]) && $qx['edad'] > 17 && $qx['h_fin'] != NULL;
        }));
        //aq_torre_hospitalizacion_ejecutadas_pediatrico
        $resultset['area_qx']['hospitalizacion']['ejecutadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418,422]) && $qx['edad'] < 18 && $qx['h_fin'] != NULL;
        }));

        //aq_torre_mapm_total
        $resultset['area_qx']['mapm']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424,425]);
        }));
        
        //aq_torre_mapm_programadas_total
        $resultset['area_qx']['mapm']['programadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424,425]);
        }));
        //aq_torre_mapm_programadas_adultos
        $resultset['area_qx']['mapm']['programadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424,425]) && $qx['edad'] > 17;
        }));
        //aq_torre_mapm_programadas_pediatrico
        $resultset['area_qx']['mapm']['programadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424,425]) && $qx['edad'] < 18;
        }));

        //aq_torre_mapm_ejecutadas_total
        $resultset['area_qx']['mapm']['ejecutadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424,425]) && $qx['h_fin'] != NULL;
        }));
        //aq_torre_mapm_ejecutadas_adulto
        $resultset['area_qx']['mapm']['ejecutadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424,425]) && $qx['edad'] > 17 && $qx['h_fin'] != NULL;
        }));
        //aq_torre_mapm_ejecutadas_pediatrico
        $resultset['area_qx']['mapm']['ejecutadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424,425]) && $qx['edad'] < 18 && $qx['h_fin'] != NULL;
        }));

        //aq_torre_hospitalizacion_total
        $resultset['area_qx']['hospitalizacion']['ambulatoria_torre']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[422]);
        }));
        
        //aq_torre_hospitalizacion_programadas_total
        $resultset['area_qx']['hospitalizacion']['ambulatoria_torre']['programadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[422]);
        }));
        //aq_torre_hospitalizacion_programadas_adultos
        $resultset['area_qx']['hospitalizacion']['ambulatoria_torre']['programadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[422]) && $qx['edad'] > 17;
        }));
        //aq_torre_hospitalizacion_programadas_pediatrico
        $resultset['area_qx']['hospitalizacion']['ambulatoria_torre']['programadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[422]) && $qx['edad'] < 18;
        }));

        //aq_torre_hospitalizacion_ejecutadas_total
        $resultset['area_qx']['hospitalizacion']['ambulatoria_torre']['ejecutadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[422]) && $qx['h_fin'] != NULL;
        }));
        //aq_torre_hospitalizacion_ejecutadas_adulto
        $resultset['area_qx']['hospitalizacion']['ambulatoria_torre']['ejecutadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[422]) && $qx['edad'] > 17 && $qx['h_fin'] != NULL;
        }));
        //aq_torre_hospitalizacion_ejecutadas_pediatrico
        $resultset['area_qx']['hospitalizacion']['ambulatoria_torre']['ejecutadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[422]) && $qx['edad'] < 18 && $qx['h_fin'] != NULL;
        }));

        //aq_torre_hospitalizacion_total
        $resultset['area_qx']['hospitalizacion']['hospitalizacion_torre']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418]);
        }));
        
        //aq_torre_hospitalizacion_programadas_total
        $resultset['area_qx']['hospitalizacion']['hospitalizacion_torre']['programadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418]);
        }));
        //aq_torre_hospitalizacion_programadas_adultos
        $resultset['area_qx']['hospitalizacion']['hospitalizacion_torre']['programadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418]) && $qx['edad'] > 17;
        }));
        //aq_torre_hospitalizacion_programadas_pediatrico
        $resultset['area_qx']['hospitalizacion']['hospitalizacion_torre']['programadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418]) && $qx['edad'] < 18;
        }));

        //aq_torre_hospitalizacion_ejecutadas_total
        $resultset['area_qx']['hospitalizacion']['hospitalizacion_torre']['ejecutadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418]) && $qx['h_fin'] != NULL;
        }));
        //aq_torre_hospitalizacion_ejecutadas_adulto
        $resultset['area_qx']['hospitalizacion']['hospitalizacion_torre']['ejecutadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418]) && $qx['edad'] > 17 && $qx['h_fin'] != NULL;
        }));
        //aq_torre_hospitalizacion_ejecutadas_pediatrico
        $resultset['area_qx']['hospitalizacion']['hospitalizacion_torre']['ejecutadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[418]) && $qx['edad'] < 18 && $qx['h_fin'] != NULL;
        }));

        //aq_torre_hospitalizacion_total
        $resultset['area_qx']['mapm']['oftalmologicas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424]);
        }));
        
        //aq_torre_hospitalizacion_programadas_total
        $resultset['area_qx']['mapm']['oftalmologicas']['programadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424]);
        }));
        //aq_torre_hospitalizacion_programadas_adultos
        $resultset['area_qx']['mapm']['oftalmologicas']['programadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424]) && $qx['edad'] > 17;
        }));
        //aq_torre_hospitalizacion_programadas_pediatrico
        $resultset['area_qx']['mapm']['oftalmologicas']['programadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424]) && $qx['edad'] < 18;
        }));

        //aq_torre_hospitalizacion_ejecutadas_total
        $resultset['area_qx']['mapm']['oftalmologicas']['ejecutadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424]) && $qx['h_fin'] != NULL;
        }));
        //aq_torre_hospitalizacion_ejecutadas_adulto
        $resultset['area_qx']['mapm']['oftalmologicas']['ejecutadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424]) && $qx['edad'] > 17 && $qx['h_fin'] != NULL;
        }));
        //aq_torre_hospitalizacion_ejecutadas_pediatrico
        $resultset['area_qx']['mapm']['oftalmologicas']['ejecutadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[424]) && $qx['edad'] < 18 && $qx['h_fin'] != NULL;
        }));

        /************ */
        //aq_torre_hospitalizacion_total
        $resultset['area_qx']['mapm']['especialidades']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[425]);
        }));
        
        //aq_torre_hospitalizacion_programadas_total
        $resultset['area_qx']['mapm']['especialidades']['programadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[425]);
        }));
        //aq_torre_hospitalizacion_programadas_adultos
        $resultset['area_qx']['mapm']['especialidades']['programadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[425]) && $qx['edad'] > 17;
        }));
        //aq_torre_hospitalizacion_programadas_pediatrico
        $resultset['area_qx']['mapm']['especialidades']['programadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[425]) && $qx['edad'] < 18;
        }));

        //aq_torre_hospitalizacion_ejecutadas_total
        $resultset['area_qx']['mapm']['especialidades']['ejecutadas']['total'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[425]) && $qx['h_fin'] != NULL;
        }));
        //aq_torre_hospitalizacion_ejecutadas_adulto
        $resultset['area_qx']['mapm']['especialidades']['ejecutadas']['adulto'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[425]) && $qx['edad'] > 17 && $qx['h_fin'] != NULL;
        }));
        //aq_torre_hospitalizacion_ejecutadas_pediatrico
        $resultset['area_qx']['mapm']['especialidades']['ejecutadas']['pediatrico'] = count(array_filter($area_qx, function($qx){
            return in_array($qx['area_intervencion'],[425]) && $qx['edad'] < 18 && $qx['h_fin'] != NULL;
        }));




        //EMERGENCIA ADULTO
        $resultset['emergencia_adulto']['a'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[4]);
        }));

        $resultset['emergencia_adulto']['b'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[5]);
        }));
        $resultset['emergencia_adulto']['triaje'] =  $resultset['emergencia_adulto']['a'] + $resultset['emergencia_adulto']['b'];

        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[270])->where("active",1)->select('id')->get()->toArray());
        $resultset['emergencia_adulto']['observacion'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));

        $resultset['emergencia_adulto']['traumashock'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[405]);
        }));
        $resultset['emergencia_adulto']['total'] =
            $resultset['emergencia_adulto']['triaje']+
            $resultset['emergencia_adulto']['observacion']+
            $resultset['emergencia_adulto']['traumashock']
        ;
        //EMERGENCIA PEDIATRICA
        $resultset['emergencia_pediatrica']['a'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[30]);
        }));

        $resultset['emergencia_pediatrica']['b'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[31]);
        }));
        $resultset['emergencia_pediatrica']['triaje'] =
            $resultset['emergencia_pediatrica']['a']+
            $resultset['emergencia_pediatrica']['b']
        ;

        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[32])->where("active",1)->select('id')->get()->toArray());
        $resultset['emergencia_pediatrica']['observacion'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));

        $resultset['emergencia_pediatrica']['traumashock'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[406]);
        }));
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[392])->where("active",1)->select('id')->get()->toArray());
        $resultset['emergencia_pediatrica']['nebulizacion'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));


        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[390])->where("active",1)->select('id')->get()->toArray());
        $resultset['emergencia_pediatrica']['hcep'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        $resultset['emergencia_pediatrica']['total'] =
            $resultset['emergencia_pediatrica']['triaje']+
            $resultset['emergencia_pediatrica']['observacion']+
            $resultset['emergencia_pediatrica']['traumashock']+
            $resultset['emergencia_pediatrica']['nebulizacion']+
            $resultset['emergencia_pediatrica']['hcep']
        ;
        $resultset['emergencia']['total'] =
            $resultset['emergencia_pediatrica']['total']+
            $resultset['emergencia_adulto']['total']
        ;
        //HOSPITALIZACION
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[42,71,235,236,99,127,234,155])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        $resultset['hospitalizacion']['pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));


        //PISO 2
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[42])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_2'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 2 ADULTO
        $resultset['hospitalizacion']['piso_2_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 2 PEDIATRICO
        $resultset['hospitalizacion']['piso_2_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));
        //PISO 2 A
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[42])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_2A'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 2 A ADULTO
        $resultset['hospitalizacion']['piso_2A_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 2 A PEDIATRICO
        $resultset['hospitalizacion']['piso_2A_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));
        //PISO 2 B
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_2B'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 2 B ADULTO
        $resultset['hospitalizacion']['piso_2B_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 2 B PEDIATRICO
        $resultset['hospitalizacion']['piso_2B_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));


        //PISO 3
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[71,235])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_3'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 3 ADULTO
        $resultset['hospitalizacion']['piso_3_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 3 PEDIATRICO
        $resultset['hospitalizacion']['piso_3_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));
        //PISO 3 A
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[71])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_3A'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 3 A ADULTO
        $resultset['hospitalizacion']['piso_3A_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 3 A PEDIATRICO
        $resultset['hospitalizacion']['piso_3A_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));
        //PISO 3 B
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[235])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_3B'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 3 B ADULTO
        $resultset['hospitalizacion']['piso_3B_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 3 B PEDIATRICO
        $resultset['hospitalizacion']['piso_3B_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));

        //PISO 4
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[236,99])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_4'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 4 ADULTO
        $resultset['hospitalizacion']['piso_4_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 4 PEDIATRICO
        $resultset['hospitalizacion']['piso_4_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));
        //PISO 4 A
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[236])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_4A'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 4 A ADULTO
        $resultset['hospitalizacion']['piso_4A_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 4 A PEDIATRICO
        $resultset['hospitalizacion']['piso_4A_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));
        //PISO 4 B
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[99])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_4B'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 4 B ADULTO
        $resultset['hospitalizacion']['piso_4B_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 4 B PEDIATRICO
        $resultset['hospitalizacion']['piso_4B_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));


        //PISO 5
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[127,234])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_5'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 5 ADULTO
        $resultset['hospitalizacion']['piso_5_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 5 PEDIATRICO
        $resultset['hospitalizacion']['piso_5_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));
        //PISO 5 A
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[127])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_5A'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 5 A ADULTO
        $resultset['hospitalizacion']['piso_5A_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 5 A PEDIATRICO
        $resultset['hospitalizacion']['piso_5A_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));
        //PISO 5 B
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[234])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_5B'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 5 B ADULTO
        $resultset['hospitalizacion']['piso_5B_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 5 B PEDIATRICO
        $resultset['hospitalizacion']['piso_5B_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));

        //PISO 6
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[155])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_6'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 6 ADULTO
        $resultset['hospitalizacion']['piso_6_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 6 PEDIATRICO
        $resultset['hospitalizacion']['piso_6_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));
        //PISO 6 A
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[155])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_6A'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 6 A ADULTO
        $resultset['hospitalizacion']['piso_6A_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 6 A PEDIATRICO
        $resultset['hospitalizacion']['piso_6A_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));
        //PISO 6 B
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_6B'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        //PISO 6 B ADULTO
        $resultset['hospitalizacion']['piso_6B_adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] > 17;
        }));
        //PISO 6 B PEDIATRICO
        $resultset['hospitalizacion']['piso_6B_pediatrico'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id) && $episodio['edad'] < 18;
        }));



        $resultset['hospitalizacion']['total'] =
            $resultset['hospitalizacion']['piso_2']+
            $resultset['hospitalizacion']['piso_3']+
            $resultset['hospitalizacion']['piso_4']+
            $resultset['hospitalizacion']['piso_5']+
            $resultset['hospitalizacion']['piso_6']
        ;

        //UTI
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[182])->where("active",1)->select('id')->get()->toArray());
        $resultset['uti']['adulto'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[211])->where("active",1)->select('id')->get()->toArray());
        $resultset['uti']['pediatrica'] = count(array_filter($newModel, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        $resultset['uti']['utin'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[391]);
        }));
        $resultset['uti']['total'] =
            $resultset['uti']['adulto']+
            $resultset['uti']['pediatrica']+
            $resultset['uti']['utin'];
        //PAD


        $resultset['pad']['emergencia']['adulto'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[229]);
        }));
        $resultset['pad']['emergencia']['pediatrico'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[228]);
        }));
        $resultset['pad']['emergencia']['total'] =
            $resultset['pad']['emergencia']['adulto']+
            $resultset['pad']['emergencia']['pediatrico']
        ;
        $resultset['pad']['postquirurgico']['ambulatorio']['total'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[373]);
        }));
        $resultset['pad']['postquirurgico']['ambulatorio']['adulto'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[373]) && $episodio['edad'] > 17;;
        }));
        $resultset['pad']['postquirurgico']['ambulatorio']['pediatrico'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[373]) && $episodio['edad'] < 18;;
        }));

        $resultset['pad']['postquirurgico']['hospitalizacion']['total'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[374]);
        }));
        $resultset['pad']['postquirurgico']['hospitalizacion']['adulto'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[374]) && $episodio['edad'] > 17;;
        }));
        $resultset['pad']['postquirurgico']['hospitalizacion']['pediatrico'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[374]) && $episodio['edad'] < 18;;
        }));

        $resultset['pad']['postquirurgico']['total'] =
            $resultset['pad']['postquirurgico']['ambulatorio']['total']+
            $resultset['pad']['postquirurgico']['hospitalizacion']['total']
        ;
        $resultset['pad']['postquirurgico']['adulto'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[373,374]) && $episodio['edad'] > 17;;
        }));
        $resultset['pad']['postquirurgico']['pediatrico'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[373,374]) && $episodio['edad'] < 18;;
        }));


        $resultset['pad']['medico']['total'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[382]);
        }));
        $resultset['pad']['medico']['adulto'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[382]) && $episodio['edad'] > 17;;
        }));
        $resultset['pad']['medico']['pediatrico'] = count(array_filter($newModel, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[382]) && $episodio['edad'] < 18;;
        }));

        $resultset['pad']['adulto'] = count(array_filter($newModel, function($episodio) {
            return in_array($episodio['cat_user_ubicacion_id'],[229,228,373,374,382]) && $episodio['edad'] > 17;
        }));
        $resultset['pad']['pediatrico'] = count(array_filter($newModel, function($episodio) {
            return in_array($episodio['cat_user_ubicacion_id'],[229,228,373,374,382]) && $episodio['edad'] < 18;
        }));
        $resultset['telesalud']['adulto'] = count(array_filter($newModel, function($episodio) {
            return in_array($episodio['cat_user_ubicacion_id'],[229,228,373,374,382]) && $episodio['edad'] > 17;
        }));
        $resultset['telesalud']['pediatrico'] = count(array_filter($newModel, function($episodio) {
            return in_array($episodio['cat_user_ubicacion_id'],[229,228,373,374,382]) && $episodio['edad'] < 18;
        }));


        $resultset['pad']['total'] =
            $resultset['pad']['emergencia']['total']+
            $resultset['pad']['postquirurgico']['total']+
            $resultset['pad']['medico']['total']
        ;
        $resultset['telesalud']['total'] =
            $resultset['pad']['total']
        ;
        $resultset['cmdlt']['total'] =

            $resultset['area_qx']['total']+
            $resultset['uti']['total']+
            $resultset['hospitalizacion']['total']+
            $resultset['emergencia']['total']
        ;

        //dd($resultset);
        return $resultset ;
    }
    /* public function getEgresosTotales( $desde,$hasta)
    {
        $model = new UserCuestEpisodio();
        $model = $model->where("active",0);
        $model = $model->whereNotNull("cat_user_ubicacion_id");
        $model = $model->whereNotNull("egreso");
        $model = $model->whereBetween("egreso",[ $desde." 00:00:00",$hasta." 23:59:59"]);
        $model = $model->get()->toArray();

        $resultset = [];
        //EMERGENCIA ADULTO
        $resultset['emergencia_adulto']['a'] = count(array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[4]);
        }));

        $resultset['emergencia_adulto']['b'] = count(array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[5]);
        }));
        $resultset['emergencia_adulto']['triaje'] =  $resultset['emergencia_adulto']['a'] + $resultset['emergencia_adulto']['b'];

        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[270])->where("active",1)->select('id')->get()->toArray());
        $resultset['emergencia_adulto']['observacion'] = count(array_filter($model, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));

        $resultset['emergencia_adulto']['traumashock'] = count(array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[405]);
        }));
        $resultset['emergencia_adulto']['total'] =
            $resultset['emergencia_adulto']['triaje']+
            $resultset['emergencia_adulto']['observacion']+
            $resultset['emergencia_adulto']['traumashock']
        ;
        //EMERGENCIA PEDIATRICA
        $resultset['emergencia_pediatrica']['a'] = count(array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[30]);
        }));

        $resultset['emergencia_pediatrica']['b'] = count(array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[31]);
        }));
        $resultset['emergencia_pediatrica']['triaje'] =
            $resultset['emergencia_pediatrica']['a']+
            $resultset['emergencia_pediatrica']['b']
        ;

        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[32])->where("active",1)->select('id')->get()->toArray());
        $resultset['emergencia_pediatrica']['observacion'] = count(array_filter($model, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));

        $resultset['emergencia_pediatrica']['traumashock'] = count(array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[406]);
        }));
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[392])->where("active",1)->select('id')->get()->toArray());
        $resultset['emergencia_pediatrica']['nebulizacion'] = count(array_filter($model, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        $resultset['emergencia_pediatrica']['total'] =
            $resultset['emergencia_pediatrica']['triaje']+
            $resultset['emergencia_pediatrica']['observacion']+
            $resultset['emergencia_pediatrica']['traumashock']+
            $resultset['emergencia_pediatrica']['nebulizacion']
        ;
        $resultset['emergencia']['total'] =
            $resultset['emergencia_pediatrica']['total']+
            $resultset['emergencia_adulto']['total']
        ;
        //HOSPITALIZACION
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[42])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_2'] = count(array_filter($model, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[70,235])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_3'] = count(array_filter($model, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[236,99])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_4'] = count(array_filter($model, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[127,234])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_5'] = count(array_filter($model, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[155])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_6'] = count(array_filter($model, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        $resultset['hospitalizacion']['hcep'] = count(array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[390]);
        }));
        $resultset['hospitalizacion']['total'] =
            $resultset['hospitalizacion']['piso_2']+
            $resultset['hospitalizacion']['piso_3']+
            $resultset['hospitalizacion']['piso_4']+
            $resultset['hospitalizacion']['piso_5']+
            $resultset['hospitalizacion']['piso_6']+
            $resultset['hospitalizacion']['hcep']
        ;
        //UTI
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[182])->where("active",1)->select('id')->get()->toArray());
        $resultset['uti']['adulto'] = count(array_filter($model, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[211])->where("active",1)->select('id')->get()->toArray());
        $resultset['uti']['pediatrica'] = count(array_filter($model, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }));
        $resultset['uti']['utin'] = count(array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[391]);
        }));
        $resultset['uti']['total'] =
            $resultset['uti']['adulto']+
            $resultset['uti']['pediatrica']+
            $resultset['uti']['utin'];
        //PAD
        $resultset['pad_emergencia']['adulto'] = count(array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[229]);
        }));
        $resultset['pad_emergencia']['pediatrico'] = count(array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[228]);
        }));
        $resultset['pad_emergencia']['total'] =
            $resultset['pad_emergencia']['adulto']+
            $resultset['pad_emergencia']['pediatrico']
        ;
        $resultset['pad_postquirurgico']['ambulatorio'] = count(array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[373]);
        }));
        $resultset['pad_postquirurgico']['hospitalizacion'] = count(array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[374]);
        }));
        $resultset['pad_postquirurgico']['total'] =
            $resultset['pad_postquirurgico']['ambulatorio']+
            $resultset['pad_postquirurgico']['hospitalizacion']
        ;
        $resultset['pad_medico']['total'] = count(array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[382]);
        }));
        $resultset['pad']['total'] =
            $resultset['pad_emergencia']['total']+
            $resultset['pad_postquirurgico']['total']+
            $resultset['pad_medico']['total']
        ;
        $resultset['cmdlt']['total'] =
            $resultset['pad']['total']+
            $resultset['uti']['total']+
            $resultset['hospitalizacion']['total']+
            $resultset['emergencia']['total']
        ;

        //dd($resultset);
        return $resultset ;
    } 
          [
            418,//hospitalizacion
            422,//ambulatoria torre
            424,//oftalmologica
            425,//especialidades

        ] );
    */
    public function getIngresosQxDatosPacientes( $area){
        $area_qx = new SolicitudQuirofano();
        //$area_qx = $area_qx->whereDate('solicitud_quirofano.h_inicio', '=', date('Y-m-d'));
        //$area_qx = $area_qx->where('solicitud_quirofano.n_quirofano', '!=', 1000);
        $area_qx = $area_qx->whereDate('solicitud_quirofano.fecha_reservacion', date('Y-m-d'));
     
        $area_qx = $area_qx->join("user_profile","solicitud_quirofano.user_id_paciente","user_profile.user_id");
        $area_qx = $area_qx->join("user","solicitud_quirofano.user_id_paciente","user.id");

        $area_qx = $this->solicitudes($area_qx);
        switch ($area) {
            case 'qx_torre_hospitalizacion':
                $area_qx = $area_qx->whereIn("area_intervencion",[418,422]);
            break;
            case 'qx_torre_hospitalizacion_hospitalizacion':
                $area_qx = $area_qx->whereIn("area_intervencion",[418]);
            break;
            case 'qx_torre_hospitalizacion_ambulatorias':
                $area_qx = $area_qx->whereIn("area_intervencion",[422]);
            break;
            case 'qx_mapm':
                $area_qx = $area_qx->whereIn("area_intervencion",[424,425]);
            break;
            case 'qx_mapm_oftalmologicas':
                $area_qx = $area_qx->whereIn("area_intervencion",[424]);
            break;
            case 'qx_mapm_especialidades':
                $area_qx = $area_qx->whereIn("area_intervencion",[425]);
            break;
            default:
                $area_qx = $area_qx->whereIn("area_intervencion",[
                    418,//hospitalizacion
                    422,//ambulatoria torre
                    424,//oftalmologica
                    425,//especialidades

                ]);
            break;
            
        }

        $area_qx = $area_qx->orderBy("solicitud_quirofano.n_quirofano","ASC");
        $area_qx = $area_qx->orderBy("solicitud_quirofano.h_inicio","ASC");
        $area_qx = $area_qx->get()->toArray();
        return $area_qx;

    }
    public function getEgresosQxDatosPacientes( $area,$desde,$hasta){
        $area_qx = new SolicitudQuirofano();
        $area_qx = $area_qx->whereBetween("solicitud_quirofano.h_inicio",[ $desde." 00:00:00",$hasta." 23:59:59"]);
        $area_qx = $area_qx->where('solicitud_quirofano.n_quirofano', '!=', 1000);
        $area_qx = $area_qx->where('solicitud_quirofano.fase_ubicacion',  "Alta");
        $area_qx = $area_qx->join("user_profile","solicitud_quirofano.user_id_paciente","user_profile.user_id");
        $area_qx = $area_qx->join("user","solicitud_quirofano.user_id_paciente","user.id");
        $area_qx = $this->solicitudes($area_qx);
        switch ($area) {
            case 'qx_hospitalizacion':
                $area_qx = $area_qx->whereIn("area_intervencion",[418,420,421]);
            break;
            case 'qx_hospitalizacion_electiva':
                $area_qx = $area_qx->whereIn("area_intervencion",[420]);
            break;
            case 'qx_hospitalizacion_emergencia':
                $area_qx = $area_qx->whereIn("area_intervencion",[421]);
            break;
            case 'qx_ambulatoria':
                $area_qx = $area_qx->whereIn("area_intervencion",[419,422,423]);
            break;
            case 'qx_ambulatoria_torre':
                $area_qx = $area_qx->whereIn("area_intervencion",[422]);
            break;
            case 'qx_ambulatoria_mapm':
                $area_qx = $area_qx->whereIn("area_intervencion",[423,424,425]);
            break;
            case 'qx_ambulatoria_mapm_oftalmologica':
                $area_qx = $area_qx->whereIn("area_intervencion",[424]);
            break;
            case 'qx_ambulatoria_mapm_especialidades':
                $area_qx = $area_qx->whereIn("area_intervencion",[425]);
            break;
        }

        $area_qx = $area_qx->orderBy("solicitud_quirofano.n_quirofano","ASC");
        $area_qx = $area_qx->orderBy("solicitud_quirofano.h_inicio","ASC");
        $area_qx = $area_qx->get()->toArray();
        return $area_qx;

    }
    public function getIngresosDatosPacientes( $area)
    {

        $model = new UserCuestEpisodio();
        $model = $model->join("user_profile AS up_paciente","user_cuest_episodio.user_id","up_paciente.user_id");
        $model = $model->join("user_type AS ut","user_cuest_episodio.user_id","ut.user_id");

        $model = $model->join("user_cuest_ubicacion AS ucu","user_cuest_episodio.user_id","ucu.user_id_paciente");
        $model = $model->join("cat_user_ubicacion AS cuu","ucu.cat_user_ubicacion_id","cuu.id");

        $model = $model->where("user_cuest_episodio.active",1);
        $model = $model->where("ucu.active",1);

        $model = $model->where("user_cuest_episodio.egreso",NULL);
        $model = $model->whereNull("user_cuest_episodio.cat_user_ubicacion_id");
        $model = $model->whereNull("user_cuest_episodio.egreso");

        $model = $model->where("up_paciente.nombres","!=",NULL);
        $model = $model->where("up_paciente.apellidos","!=",NULL);
        $model = $model->where("up_paciente.fnacimiento","!=",NULL);
        $model = $model->where("up_paciente.genero","!=",NULL);
        $model = $model->where("up_paciente.cedula","!=",NULL);
        $model = $model->where("ut.cat_user_type_id",1);

        switch ($area) {
            //EMERGENCIA ADULTO
            case 'emergencia':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[270,32])->where("active",1)->select('id')->get()->toArray());
                $cat_user_ubicacion_id =  array_merge($cat_user_ubicacion_id,[4,5,405,30,31,406,392,390]);
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'emergencia_adulto':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[270])->where("active",1)->select('id')->get()->toArray());
                $cat_user_ubicacion_id =  array_merge($cat_user_ubicacion_id,[4,5,405]);
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'emergencia_adulto_triaje_a':
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",[4]);
            break;
            case 'emergencia_adulto_triaje_b':
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",[5]);
            break;
            case 'emergencia_adulto_observacion':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[270])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'emergencia_adulto_traumashock':
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",[405]);
            break;

            //EMERGENCIA PEDIATRICO
            case 'emergencia_pediatrico':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[32,392,390])->where("active",1)->select('id')->get()->toArray());
                $cat_user_ubicacion_id =  array_merge($cat_user_ubicacion_id,[30,31,406,]);
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'emergencia_pediatrico_triaje_a':
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",[30]);
            break;
            case 'emergencia_pediatrico_triaje_b':
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",[31]);
            break;
            case 'emergencia_pediatrico_observacion':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[32])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'emergencia_pediatrico_traumashock':
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",[406]);
            break;
            case 'emergencia_pediatrico_nebulizacion':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[392])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'emergencia_pediatrico_hcep':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[390])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;

            //HOSPITALIZACION
            case 'hospitalizacion':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[42,71,235,236,99,127,234,155])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso2':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[42])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso2_a':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[42])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso2_b':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso3':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[71,235])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso3_a':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[71])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso3_b':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[235])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso4':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[236,99])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso4_a':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[236])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso4_b':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[99])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso5':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[127,234])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso5_a':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[127])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso5_b':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[234])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso6':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[155])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso6_a':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[155])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso6_b':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;

            //UTI
            case 'uti':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[182,211])->where("active",1)->select('id')->get()->toArray());
                $cat_user_ubicacion_id =  array_merge($cat_user_ubicacion_id,[391]);
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'uti_adulto':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[182])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'uti_pediatrico':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[211])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'utin':
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",[391]);
            break;

            //PAD
            case 'pad':
                $cat_user_ubicacion_id =  [229,228,373,374,382];
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'pad_emergencia':
                $cat_user_ubicacion_id =  [229,228];
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'pad_emergencia_adulto':
                $cat_user_ubicacion_id =  [229];
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'pad_emergencia_pediatrico':
                $cat_user_ubicacion_id =  [228];
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'pad_postqx':
                $cat_user_ubicacion_id =  [374,373];
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'pad_postqx_hospitalizacion':
                $cat_user_ubicacion_id =  [374];
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'pad_postqx_ambulatorio':
                $cat_user_ubicacion_id =  [373];
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'pad_medico':
                $cat_user_ubicacion_id =  [382];
                $model = $model->whereIn("ucu.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            default:
                $model = $model->whereNotIn("ucu.cat_user_ubicacion_id",[429,229,228,373,374,382,245,246,247,248,249,250,251,364,365,366,367,371,386,387]);
            break;
        }

        $model = $model->select(
            DB::raw("user_cuest_episodio.id AS episodio_id"),
            "user_cuest_episodio.*",
            DB::raw("up_paciente.nombres AS nombres_paciente"),
            DB::raw("up_paciente.apellidos AS apellidos_paciente"),
            DB::raw("up_paciente.genero AS genero_paciente"),
            DB::raw("up_paciente.cedula AS cedula_paciente"),
            DB::raw("up_paciente.fnacimiento AS fnacimiento_paciente"),
            DB::raw("cuu.id AS ubicacion_id"),
            DB::raw("(
                TIMESTAMPDIFF(YEAR, up_paciente.fnacimiento, CURDATE())
            ) AS edad"),
            DB::raw("(
                TO_DAYS( NOW() ) - TO_DAYS( user_cuest_episodio.ingreso)
            ) AS dias"),
            DB::raw("CONCAT(
                cuu.description,
                ' | ',
                cuu.coments
            ) AS ubicacion"),
        );
        $model = $model->orderBy("ubicacion","ASC");
        $model = $model->get();

        $resultset = [];
        if (count($model) > 0 ) {
            $model = $model->toArray();
            foreach ($model as $key => $episodio) {
                $resultset[$key] = $episodio;
                $resultset[$key]['probabilidad_diagnostica'] = UserCuestImpresionDiagnostica::where("user_cuest_episodio_id",$episodio['episodio_id'])->get();
                $resultset[$key]['pendientes'] = UserCuestPendiente::where("user_cuest_episodio_id",$episodio['episodio_id'])->where("active",1)->get();
                //EQUIPO MEDICO QUE ATIENDE AL PACIENTE
                $temp = UserCuestMedicoPaciente::show($episodio['user_id']);
                $resultset[$key]['equipo_medico'] = $temp;
            }

        }
        return $resultset;






    }
    public function getEgresosDatosPacientes( $area,$desde,$hasta)
    {

        $model = new UserCuestEpisodio();
        $model = $model->join("user_profile AS up_paciente","user_cuest_episodio.user_id","up_paciente.user_id");
        $model = $model->join("user_type AS ut","user_cuest_episodio.user_id","ut.user_id");

        $model = $model->join("user_cuest_ubicacion AS ucu","user_cuest_episodio.user_id","ucu.user_id_paciente");
        $model = $model->join("cat_user_ubicacion AS cuu","user_cuest_episodio.cat_user_ubicacion_id","cuu.id");

        $model = $model->where("user_cuest_episodio.active",0);
        $model = $model->join("user_profile AS up_egreso_por","ucu.user_id_medico","up_egreso_por.user_id");

        $model = $model->where("ucu.active",1);
        $model = $model->where("user_cuest_episodio.egreso","!=",NULL);
        $model = $model->whereBetween("user_cuest_episodio.egreso",[ $desde." 00:00:00",$hasta." 23:59:59"]);
        $model = $model->where("up_paciente.nombres","!=",NULL);
        $model = $model->where("up_paciente.apellidos","!=",NULL);
        $model = $model->where("up_paciente.fnacimiento","!=",NULL);
        $model = $model->where("up_paciente.genero","!=",NULL);
        $model = $model->where("up_paciente.cedula","!=",NULL);
        $model = $model->where("ut.cat_user_type_id",1);

        switch ($area) {
            //EMERGENCIA ADULTO
            case 'emergencia':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[270,32])->where("active",1)->select('id')->get()->toArray());
                $cat_user_ubicacion_id =  array_merge($cat_user_ubicacion_id,[4,5,405,30,31,406,392,390]);
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'emergencia_adulto':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[270])->where("active",1)->select('id')->get()->toArray());
                $cat_user_ubicacion_id =  array_merge($cat_user_ubicacion_id,[4,5,405]);
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'emergencia_adulto_triaje_a':
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[4]);
            break;
            case 'emergencia_adulto_triaje_b':
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[5]);
            break;
            case 'emergencia_adulto_observacion':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[270])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'emergencia_adulto_traumashock':
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[405]);
            break;

            //EMERGENCIA PEDIATRICO
            case 'emergencia_pediatrico':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[32,392,390])->where("active",1)->select('id')->get()->toArray());
                $cat_user_ubicacion_id =  array_merge($cat_user_ubicacion_id,[30,31,406,]);
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'emergencia_pediatrico_triaje_a':
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[30]);
            break;
            case 'emergencia_pediatrico_triaje_b':
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[31]);
            break;
            case 'emergencia_pediatrico_observacion':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[32])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'emergencia_pediatrico_traumashock':
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[406]);
            break;
            case 'emergencia_pediatrico_nebulizacion':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[392])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'emergencia_pediatrico_hcep':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[390])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;

            //HOSPITALIZACION
            case 'hospitalizacion':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[42,71,235,236,99,127,234,155])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso2':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[42])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso2_a':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[42])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso2_b':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso3':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[71,235])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso3_a':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[71])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso3_b':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[235])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso4':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[236,99])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso4_a':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[236])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso4_b':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[99])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso5':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[127,234])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso5_a':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[127])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso5_b':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[234])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso6':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[155])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso6_a':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[155])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'hospitalizacion_piso6_b':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;

            //UTI
            case 'uti':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[182,211])->where("active",1)->select('id')->get()->toArray());
                $cat_user_ubicacion_id =  array_merge($cat_user_ubicacion_id,[391]);
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'uti_adulto':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[182])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'uti_pediatrico':
                $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[211])->where("active",1)->select('id')->get()->toArray());
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'utin':
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[391]);
            break;

            //PAD
            case 'pad':
                $cat_user_ubicacion_id =  [229,228,373,374,382];
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'pad_emergencia':
                $cat_user_ubicacion_id =  [229,228];
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'pad_emergencia_adulto':
                $cat_user_ubicacion_id =  [229];
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'pad_emergencia_pediatrico':
                $cat_user_ubicacion_id =  [228];
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'pad_postqx':
                $cat_user_ubicacion_id =  [374,373];
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'pad_postqx_hospitalizacion':
                $cat_user_ubicacion_id =  [374];
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'pad_postqx_ambulatorio':
                $cat_user_ubicacion_id =  [373];
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            case 'pad_medico':
                $cat_user_ubicacion_id =  [382];
                $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
            break;
            default:
                $model = $model->whereNotIn("user_cuest_episodio.cat_user_ubicacion_id",[229,228,373,374,382,245,246,247,248,249,250,251,364,365,366,367,371,386,387]);
            break;
        }

        $model = $model->select(
            DB::raw("user_cuest_episodio.id AS episodio_id"),
            "user_cuest_episodio.*",
            DB::raw("up_paciente.nombres AS nombres_paciente"),
            DB::raw("up_paciente.apellidos AS apellidos_paciente"),
            DB::raw("up_paciente.genero AS genero_paciente"),
            DB::raw("up_paciente.cedula AS cedula_paciente"),
            DB::raw("up_paciente.fnacimiento AS fnacimiento_paciente"),
            DB::raw("CONCAT(cuu.description,' ',cuu.coments) AS area_egreso"),
            DB::raw("(
                TIMESTAMPDIFF(YEAR, up_paciente.fnacimiento, CURDATE())
            ) AS edad"),
            DB::raw("(
                TO_DAYS( NOW() ) - TO_DAYS( user_cuest_episodio.ingreso)
            ) AS dias"),
            DB::raw("CONCAT(
                cuu.description,
                ' | ',
                cuu.coments
            ) AS ubicacion"),
            DB::raw("up_egreso_por.nombres AS nombres_medico"),
            DB::raw("up_egreso_por.apellidos AS apellidos_medico"),
            DB::raw("up_egreso_por.genero AS genero_medico"),
            DB::raw("up_egreso_por.cedula AS cedula_medico"),
            DB::raw("up_egreso_por.fnacimiento AS fnacimiento_medico"),
        );
        $model = $model->orderBy("ubicacion","ASC");
        $model = $model->get();

        $resultset = [];
        if (count($model) > 0 ) {
            $model = $model->toArray();
            foreach ($model as $key => $episodio) {
                $resultset[$key] = $episodio;
                $resultset[$key]['probabilidad_diagnostica'] = UserCuestImpresionDiagnostica::where("user_cuest_episodio_id",$episodio['episodio_id'])->get();
                //EQUIPO MEDICO QUE ATIENDE AL PACIENTE
                $temp = UserCuestMedicoPaciente::show($episodio['user_id']);
                $resultset[$key]['equipo_medico'] = $temp;
            }

        }
        return $resultset;






    }
    /* public function getEgresosDatosPacientes( $area,$desde,$hasta)
    {
        $model = new UserCuestEpisodio();
        $model = $model->where("user_cuest_episodio.active",0);
        $model = $model->where("user_cuest_ubicacion.active",1);
        $model = $model->join("user_profile AS up_paciente","user_cuest_episodio.user_id","up_paciente.user_id");
        $model = $model->join("cat_user_ubicacion","user_cuest_episodio.cat_user_ubicacion_id","cat_user_ubicacion.id");
        $model = $model->join("user_cuest_ubicacion","user_cuest_episodio.user_id","user_cuest_ubicacion.user_id_paciente");
        $model = $model->join("user_profile AS up_egreso_por","user_cuest_ubicacion.user_id_medico","up_egreso_por.user_id");

        $model = $model->whereNotNull("user_cuest_episodio.cat_user_ubicacion_id");
        $model = $model->whereNotNull("user_cuest_episodio.egreso");
        $model = $model->whereBetween("user_cuest_episodio.egreso",[ $desde." 00:00:00",$hasta." 23:59:59"]);

        if($area ==="emergencia_adulto_a"){
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[4]);
        }
        if($area ==="emergencia_adulto_b"){
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[5]);
        }
        if($area ==="emergencia_adulto_triaje"){
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[4,5]);
        }
        if($area ==="emergencia_adulto_observacion"){
            $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[270])->where("active",1)->select('id')->get()->toArray());
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
        }
        if($area ==="emergencia_adulto_traumashock"){
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[405]);
        }
        if($area ==="emergencia_adulto_total"){
            $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[2,3,270])->where("active",1)->select('id')->get()->toArray());
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
        }
        if($area ==="pad_emergencia_adulto"){
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[229]);
        }
        if($area ==="pad_emergencia_pediatrico"){
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[228]);
        }
        if($area ==="pad_emergencia_total"){
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[228,229]);
        }

        if($area ==="pad_postquirurgico_ambulatorio"){
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[373]);
        }
        if($area ==="pad_postquirurgico_hospitalizacion"){
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[374]);
        }
        if($area ==="pad_postquirurgico_total"){
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[373,374]);
        }
        if($area ==="pad_medico_total"){
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[382]);
        }
        if($area ==="pad_total"){
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[228,229, 373,374, 382]);
        }

        if($area ==="hospitalizacion_hp2"){
            $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[42])->where("active",1)->select('id')->get()->toArray());
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
        }
        if($area ==="hospitalizacion_hp3"){
            $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[70,235])->where("active",1)->select('id')->get()->toArray());
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
        }
        if($area ==="hospitalizacion_hp4"){
            $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[236,99])->where("active",1)->select('id')->get()->toArray());
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
        }
        if($area ==="hospitalizacion_hp5"){
            $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[127,234])->where("active",1)->select('id')->get()->toArray());
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
        }
        if($area ==="hospitalizacion_hp6"){
            $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[154])->where("active",1)->select('id')->get()->toArray());
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
        }
        if($area ==="hospitalizacion_hcep"){
            //$cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[390])->where("active",1)->select('id')->get()->toArray());
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[390]);
        }
        if($area ==="hospitalizacion_total"){
            $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[42,70,235,236,99,127,234,154])->where("active",1)->select('id')->get()->toArray());
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",array_merge($cat_user_ubicacion_id,[390]));
        }

        if($area ==="uti_adulto"){
            $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[182])->where("active",1)->select('id')->get()->toArray());
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
        }
        if($area ==="uti_pediatrico"){
            $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[211])->where("active",1)->select('id')->get()->toArray());
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",$cat_user_ubicacion_id);
        }
        if($area ==="uti_utin"){
            //$cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[211])->where("active",1)->select('id')->get()->toArray());
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",[391]);
        }
        if($area ==="uti_total"){
            $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[182,211])->where("active",1)->select('id')->get()->toArray());
            $model = $model->whereIn("user_cuest_episodio.cat_user_ubicacion_id",array_merge($cat_user_ubicacion_id,[391]));
        }

        $model = $model->select(
            DB::raw("CONCAT(cat_user_ubicacion.description,' ',cat_user_ubicacion.coments) AS egresado_por"),
            DB::raw("CONCAT(cat_user_ubicacion.description,' ',cat_user_ubicacion.coments) AS area_egreso"),
            DB::raw("user_cuest_episodio.id AS episodio_id"),
            "user_cuest_episodio.*",
            DB::raw("up_paciente.nombres AS nombres_paciente"),
            DB::raw("up_paciente.apellidos AS apellidos_paciente"),
            DB::raw("up_paciente.genero AS genero_paciente"),
            DB::raw("up_paciente.cedula AS cedula_paciente"),
            DB::raw("up_paciente.fnacimiento AS fnacimiento_paciente"),

            DB::raw("up_egreso_por.nombres AS nombres_medico"),
            DB::raw("up_egreso_por.apellidos AS apellidos_medico"),
            DB::raw("up_egreso_por.genero AS genero_medico"),
            DB::raw("up_egreso_por.cedula AS cedula_medico"),
            DB::raw("up_egreso_por.fnacimiento AS fnacimiento_medico"),

        );
        $model = $model->get();
        if (count($model) > 0 ) {
            $model = $model->toArray();
        }
        return $model;
        //dd( $model);
        //$resultset = [];

        //EMERGENCIA ADULTO
       /*  $resultset['emergencia_adulto']['a'] = array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[4]);
        });

        $resultset['emergencia_adulto']['b'] = array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[5]);
        }); */
        //$resultset['emergencia_adulto']['triaje'] =  array_merge($resultset['emergencia_adulto']['a'],$resultset['emergencia_adulto']['b']);

        /* $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[270])->where("active",1)->select('id')->get()->toArray());
        $resultset['emergencia_adulto']['observacion'] = array_filter($model, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        }); */

        /* $resultset['emergencia_adulto']['traumashock'] = array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[405]);
        }); */
        /* $resultset['emergencia_adulto']['total'] = array_merge(
            $resultset['emergencia_adulto']['triaje'],
            $resultset['emergencia_adulto']['observacion'],
            $resultset['emergencia_adulto']['traumashock']
        );
        //EMERGENCIA PEDIATRICA
        $resultset['emergencia_pediatrica']['a'] = array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[30]);
        });

        $resultset['emergencia_pediatrica']['b'] = array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[31]);
        });
        $resultset['emergencia_pediatrica']['triaje'] =  array_merge($resultset['emergencia_pediatrica']['a'],$resultset['emergencia_pediatrica']['b']);

        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[32])->where("active",1)->select('id')->get()->toArray());
        $resultset['emergencia_pediatrica']['observacion'] = array_filter($model, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        });

        $resultset['emergencia_pediatrica']['traumashock'] = array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[406]);
        });
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[392])->where("active",1)->select('id')->get()->toArray());
        $resultset['emergencia_pediatrica']['nebulizacion'] = array_filter($model, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        });
        $resultset['emergencia_pediatrica']['total'] = array_merge(
            $resultset['emergencia_pediatrica']['triaje'],
            $resultset['emergencia_pediatrica']['observacion'],
            $resultset['emergencia_pediatrica']['traumashock'],
            $resultset['emergencia_pediatrica']['nebulizacion']
        );
        //HOSPITALIZACION
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[42])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_2'] = array_filter($model, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        });
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[70,235])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_3'] = array_filter($model, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        });
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[236,99])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_4'] = array_filter($model, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        });
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[127,234])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_5'] = array_filter($model, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        });
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[154])->where("active",1)->select('id')->get()->toArray());
        $resultset['hospitalizacion']['piso_6'] = array_filter($model, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        });
        $resultset['hospitalizacion']['hcep'] = array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[390]);
        });
        $resultset['hospitalizacion']['total'] = array_merge(
            $resultset['hospitalizacion']['piso_2'],
            $resultset['hospitalizacion']['piso_3'],
            $resultset['hospitalizacion']['piso_4'],
            $resultset['hospitalizacion']['piso_5'],
            $resultset['hospitalizacion']['piso_6'],
            $resultset['hospitalizacion']['hcep']
        );
        //UTI
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[182])->where("active",1)->select('id')->get()->toArray());
        $resultset['uti']['adulto'] = array_filter($model, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        });
        $cat_user_ubicacion_id = Arr::flatten(CatUserUbicacion::whereIn('parent_cat_user_ubicacion_id',[211])->where("active",1)->select('id')->get()->toArray());
        $resultset['uti']['pediatrica'] = array_filter($model, function($episodio) use ($cat_user_ubicacion_id) {
            return in_array($episodio['cat_user_ubicacion_id'],$cat_user_ubicacion_id);
        });
        $resultset['uti']['utin'] = array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[391]);
        });
        $resultset['uti']['total'] = array_merge(
            $resultset['uti']['adulto'],
            $resultset['uti']['pediatrica'],
            $resultset['uti']['utin']
        );
        //PAD
        $resultset['pad_emergencia']['adulto'] = array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[229]);
        });
        $resultset['pad_emergencia']['pediatrico'] = array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[228]);
        });
        $resultset['pad_emergencia']['total'] = array_merge(
            $resultset['pad_emergencia']['adulto'],
            $resultset['pad_emergencia']['pediatrico']
        );
        $resultset['pad_postquirurgico']['ambulatorio'] = array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[373]);
        });
        $resultset['pad_postquirurgico']['hospitalizacion'] = array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[374]);
        });
        $resultset['pad_postquirurgico']['total'] = array_merge(
            $resultset['pad_postquirurgico']['ambulatorio'],
            $resultset['pad_postquirurgico']['hospitalizacion']
        );
        $resultset['pad_medico']['total'] = array_filter($model, function($episodio){
            return in_array($episodio['cat_user_ubicacion_id'],[382]);
        });


        //dd($resultset);
        return $resultset ;
    } */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserAdministrador  $userAdministrador
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAdministrador $userAdministrador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserAdministrador  $userAdministrador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserAdministrador $userAdministrador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAdministrador  $userAdministrador
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAdministrador $userAdministrador)
    {
        //
    }
}
