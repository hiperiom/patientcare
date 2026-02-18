<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserCuestEpisodio extends Model
{
    protected $table = "user_cuest_episodio";
    protected $fillable = [
        'id',
        'ingreso',
        'egreso',
        'cat_user_ubicacion_id',
        'dia_hos',
        'user_cuest_imp_diagn_id',
        'uti',
        'cat_user_ubicacion_id_destino',
        'uti_causa',
        'user_id_med_esp',
        'user_id_med_res',
        'pre_alta',
        'created_at',
        'codigo_azul',
        'atencion_emergencia',
        'hospitalizacion',
        'terapia_intensiva',
        'caso_tipo_medico',
        'cirugia',
        'nivel_triaje',
        'active',
        'user_id',
        'created_at',
        'requiere_intersonsulta',
        'realizar_procedimiento',
        'cantidad_especialistas',
        'procedimiento_complejidad',
    ];

    public function discharged(){
        return $this->hasOne('App\Models\Discharged','user_cuest_episodio_id','id');
    }

    public function ubicacion() // Retorna la última ubicación del paciente antes del alta médica
    {
        return $this->belongsTo('App\Models\CatUserUbicacion','cat_user_ubicacion_id', 'id');
    }

    public function paciente(){ // Retorna el paciente relacionado al episodio
        return $this->belongsTo('App\User','user_id','id');
    }

    static function store(Request $request)
    {

        if (
            $request->value=="Ingreso" ||
            $request->value=="Reingreso" ||
            $request->value=="episodio_null"
        ) {
            $episode = DB::table('user_cuest_episodio')
            ->where("user_id",$request->user_id)
            ->where("egreso",NULL)
            ->orderBy("id","DESC")
            ->get()->take(1);

            $episode_id = count($episode) > 0 ? $episode[0]->id : NULL;

            if (is_null($episode_id)) {

                $model = new UserCuestEpisodio();
                $ingreso = date('Y-m-d H:i:s', strtotime($request['created_at']));
                if (isset($request->ingreso) && $request->ingreso != "undefined") {
                    $ingreso = $request->ingreso.' '.date('H:i:s');
                }
                $model->ingreso = $ingreso;
                $model->user_id = $request->user_id;
                $model->user_id_med_esp = Auth::id();
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();
            }else{
                //Fecha del ingreso
                $startDate = strtotime($episode[0]->ingreso);

                //Fecha actual
                $currentDate = time();

                // Comparar las fechas
                if (
                    $startDate > $currentDate && $episode[0]->active == 0 ||
                    $startDate == $currentDate && $episode[0]->active == 0
                ) {
                    $startDate = date('Y-m-d H:i:s', strtotime($request['created_at']));
                    if (isset($request->ingreso) && $request->ingreso != "undefined") {
                        $startDate = $request->ingreso.' '.date('H:i:s');
                    }
                    UserCuestEpisodio::where("id",$episode_id)
                    ->update([
                        'ingreso' => $startDate,
                        'active' => 1,
                        'created_at' => date('Y-m-d H:i:s', strtotime($startDate))
                    ]);
                }
            }

        }
        if ($request->value=="Egreso") {
            //1 CERRAMOS EL EPISODIO
                $user_cuest_episodio_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
                $request->merge(['user_cuest_episodio_id'=>$user_cuest_episodio_id]);

                if (UserCuestImpresionDiagnostica::totalEpisodio($request)==0) {
                    return Response()->json("imp_diagn_not_found");
                }

                $actualizar = [
                    'egreso' => date('Y-m-d H:i:s', strtotime($request['created_at'])),
                    'cat_user_ubicacion_id' => $request->cat_user_ubicacion_id,
                    'cat_user_ubicacion_id_destino' => $request->cat_user_ubicacion_id_destino,
                    'uti' => $request->uti,
                    'uti_causa' => $request->uti_causa,
                    'user_id' => $request->user_id,
                    'user_id_med_esp' => Auth::id(),
                    "active"=>0
                ];

                $ingreso =  UserCuestEpisodio::where("active",1)
                            ->where("user_id",$request->user_id)
                            ->first();

                if (is_null($ingreso)) {
                    $temp = UserCuestUbicacion::ultimoIngreso($request->user_id);
                    $actualizar['ingreso'] = date('Y-m-d H:i:s', strtotime($temp[0]->ingreso));
                    $request->merge(['since'=>$actualizar['ingreso']]);
                    $dias = $temp[0]->dias;
                }else{
                    $request->merge(['since'=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);
                    $date1 = new DateTime(date('Y-m-d H:i:s', strtotime($request['created_at'])));
                    $date2 = new DateTime(date('Y-m-d H:i:s', strtotime($ingreso->ingreso)));
                    $diff = $date1->diff($date2);
                    $dias = $diff->days;
                }
                $actualizar['dia_hos'] = $dias;

                $model = UserCuestEpisodio::updateOrCreate([
                    "active"=>1,
                    "user_id"=>$request->user_id,
                ],$actualizar);

                $request->merge(['value'=>$model->id]);
                $request->merge(['until'=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);



            //3 AÑADIMOS EL DIAGNOSTIGO DE EGRESO
            UserCuestEgreso::store($request);

            //2 CREAMOS EL INFORME
            UserCuestInforme::store($request);


        }
        if ($request->value=="cie11") {
            UserCuestEpisodio::where("user_id",$request->user_id)
            ->where("id",$request->id)
            ->update([
                'uti' => $request->uti,
                'uti_causa' => $request->uti_causa,
                'user_id_med_esp' => Auth::id()
            ]);
        }
        return Response()->json(UserCuestEpisodio::show($request->user_id));
    }
    static function ultimoEpisodio_id($user_id){
        return  DB::table('user_cuest_episodio')
                ->where("user_id",$user_id)
                ->where("egreso",NULL)
                ->select("id")
                ->orderBy("id","DESC")
                ->value('id');
    }
    static function totalEpisodios($user_id)
    {
        return UserCuestEpisodio::where ('user_id',$user_id)
        ->whereNotNull ('egreso') //el episodio debe tener una fecha de egreso
        ->count();
    }
    static function ultimoEpisodioNoActivo_id($user_id){
        return  DB::table('user_cuest_episodio')
                ->where("user_id",$user_id)
                ->take(1)
                ->orderBy("id","DESC")
                ->value('id');
    }

    static function blue_code($user_id,$result)
    {
        $episodio_id = UserCuestEpisodio::ultimoEpisodio_id($user_id);

        UserCuestEpisodio::where('id', $episodio_id)
        ->update(['codigo_azul' => $result]);

        return Response()->json(UserCuestEpisodio::show($user_id));
    }
    static function actualizar(Request $request)
    {

        $model = new UserCuestEpisodio();
        $model::updateOrCreate(
        [
            'id'=>$request->user_cuest_episodio_id
        ],
        [
            'uti'=>$request->uti,
            'uti_causa'=>$request->uti_causa,
            //'diag_egreso_cod_cie'=>$request->diag_egreso_cod_cie,
            //'diag_egreso_cod_cie_description'=>$request->diag_egreso_cod_cie_description
        ]);



        return Response()->json(UserCuestEpisodio::show($request->user_id));
    }
    static function actualizar2(Request $request)
    {
        $campo = $request->campo;
        //dump($request->all());
        $model = new UserCuestEpisodio();
        $model::updateOrCreate(
        [
            'id'=>$request->user_cuest_episodio_id
        ],
        [
            $campo =>$request->valor
        ]);



        return Response()->json(UserCuestEpisodio::show($request->user_id));
    }
    static function prealta(Request $request)
    {
        $user_cuest_episodio_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
        $campo = $request->campo;
        //dump($request->all());
        $model = new UserCuestEpisodio();
        $model::updateOrCreate(
        [
            'id'=>$user_cuest_episodio_id,
            'user_id'=>$request->user_id
        ],
        [
            "pre_alta" =>$request->valor=="null" ? NULL : $request->valor
        ]);



        return Response()->json(UserCuestEpisodio::show($request->user_id));
    }
    static function show($user_id)
    {
        $model = UserCuestEpisodio::where("user_id",$user_id)->where("active",1)->orderBy("id","DESC")->get()->take(1);
        if(count($model)==1){
            return $model[0];
        }else{
            return null;
        }
    }
    static function episodioPendiente()
    {

        return Response()->json(DB::table('user_cuest_episodio AS epi')
        ->join("user_profile AS up","epi.user_id","up.user_id")
        ->join("user_cuest_imp_diagn AS ucid","epi.id","ucid.user_cuest_episodio_id")
        ->join("user_cuest_egreso AS uce","epi.id","uce.user_cuest_episodio_id")
        ->leftJoin("user_cuest_comorbilidad AS ucco","epi.user_id","ucco.user_id")
        ->whereNotNull('epi.egreso')
        //->where('epi.active',1)
        ->whereNull('ucid.cod_cie')
        ->orWhereNull('uce.cod_cie')
        ->select(
            DB::raw("
                DISTINCT epi.id
            "),
            "epi.id",
            DB::raw("
                CONCAT(
                    up.nacionalidad,
                    FORMAT(up.cedula, 0, 'de_DE')
                ) AS cedula
            "),
            "up.cedula AS cedula_original",
            "epi.user_id",
            "epi.dia_hos",
            DB::raw("
                CONCAT(
                    up.nombres,
                    ' ',
                    up.apellidos
                ) AS paciente
            "),
            DB::raw("
                DATE_FORMAT(epi.ingreso, '%d/%m/%Y') AS ingreso
            "),
            DB::raw("
                DATE_FORMAT(epi.egreso, '%d/%m/%Y') AS egreso
            ")
        )
        //->orderBy("epi.egreso","DESC")
        ->get());


    }
    static function eliminar($id)
    {
        $model = UserCuestEpisodio::where('id',$id);
        //$user_id = $model->value('user_id');
        $model->delete();
        return Response()->json(UserCuestEpisodio::show($id));
    }
    //relationships
    public function profile()
    {
        /*
            Obtener todos los roles del usuario
        */
        return $this->hasOne('App\Models\UserProfile', 'user_id', 'user_id');
    }
    public function reubicacion()
    {
        /*
            Obtener todas las reubicaciones (anteriormente traslados) del usuario durante el episodio
        */
        return $this->hasMany('App\Models\UserCuestUbicacion', 'user_cuest_episodio_id', 'id');
    }
    public function antecedente()
    {
        /*
            Obtener todas las antecedentes del usuario durante el episodio
        */
        return $this->hasMany('App\Models\UserCuestAntecedente', 'user_cuest_episodio_id', 'id');
    }
    public function comorbilidad()
    {
        /*
            Obtener todas las comorbilidades del usuario durante el episodio
        */
        return $this->hasMany('App\Models\UserCuestComorbilidad', 'user_cuest_episodio_id', 'id');
    }
    public function egresoDescription()
    {
        /*
            Obtener todas las comorbilidades del usuario durante el episodio
        */
        return $this->hasOne('App\Models\UserCuestEgreso', 'user_cuest_episodio_id', 'id');
    }
    public function evolucion()
    {
        /*
            Obtener todas las evoluciones del usuario durante el episodio
        */
        return $this->hasMany('App\Models\UserCuestEvolucion', 'user_cuest_episodio_id', 'id');
    }
    public function estudioDiagnostico()
    {
        /*
            Obtener todas las estudios diagnosticos del usuario durante el episodio
        */
        return $this->hasMany('App\Models\UserCuestEstudio', 'user_cuest_episodio_id', 'id');
    }
    public function fotografia()
    {
        /*
            Obtener todas las fotografias del usuario durante el episodio
        */
        return $this->hasMany('App\Models\UserCuestFotografia', 'user_cuest_episodio_id', 'id');
    }
    public function imagen()
    {
        /*
            Obtener todas las imagenes del usuario durante el episodio
        */
        return $this->hasMany('App\Models\UserCuestImagen', 'user_cuest_episodio_id', 'id');
    }
    public function impresionDiagnostica()
    {
        /*
            Obtener todas las Impresiones diagnosticas del usuario durante el episodio
        */
        return $this->hasMany('App\Models\UserCuestImpresionDiagnostica', 'user_cuest_episodio_id', 'id');
    }
    public function informe()
    {
        /*
            Obtener todos los informes del usuario durante el episodio
        */
        return $this->hasMany('App\Models\UserCuestInforme', 'user_cuest_episodio_id', 'id');
    }
    public function laboratorio()
    {
        /*
            Obtener todos los laboratorios del usuario durante el episodio
        */
        return $this->hasMany('App\Models\UserCuestLaboratorio', 'user_cuest_episodio_id', 'id');
    }
    public function equipoMedico()
    {
        /*
            Obtener todo el equipo medico que atiende al usuario durante el episodio
        */
        return $this->hasMany('App\Models\UserCuestMedicoPaciente', 'user_cuest_episodio_id', 'id');
    }
    public function observacion()
    {
        /*
            Obtener todas las observaciones al usuario durante el episodio
        */
        return $this->hasMany('App\Models\UserCuestObservacion', 'user_cuest_episodio_id', 'id');
    }
    public function otroArchivo()
    {
        /*
            Obtener todas los otros archivos adjuntados al usuario durante el episodio
        */
        return $this->hasMany('App\Models\UserCuestOtroArchivo', 'user_cuest_episodio_id', 'id');
    }
    public function plan()
    {
        /*
            Obtener todos los planes del usuario durante el episodio
        */
        return $this->hasMany('App\Models\UserCuestPlan', 'user_cuest_episodio_id', 'id');
    }
    public function recipe()
    {
        /*
            Obtener todos los récipes del usuario durante el episodio
        */
        return $this->hasMany('App\Models\UserCuestRecipe', 'user_cuest_episodio_id', 'id');
    }
    public function glicemia()
    {
        /*
            Obtener todos el monitoreo de glicemia del usuario durante el episodio
        */
        return $this->hasMany('App\Models\UserCuestGlic', 'user_cuest_episodio_id', 'id');
    }
    public function oximetria()
    {
        /*
            Obtener todos el monitoreo de glicemia del usuario durante el episodio
        */
        return $this->hasMany('App\Models\UserCuestOximetria', 'user_cuest_episodio_id', 'id');
    }
    public function temperatura()
    {
        /*
            Obtener todos el monitoreo de temperatura del usuario durante el episodio
        */
        return $this->hasMany('App\Models\UserCuestTemperatura', 'user_cuest_episodio_id', 'id');
    }
    public function tensionArterial()
    {
        /*
            Obtener todos el monitoreo de tensión arterial del usuario durante el episodio
        */
        return $this->hasMany('App\Models\UserCuestTa', 'user_cuest_episodio_id', 'id');
    }
    public function sintomas()
    {
        /*
            Obtener todos el monitoreo de sintomas del usuario durante el episodio
        */
        return $this->hasMany('App\Models\UserCuestSintoma', 'user_cuest_episodio_id', 'id');
    }

}
