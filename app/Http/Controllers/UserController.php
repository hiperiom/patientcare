<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\UserType;
use App\Models\UserProfile;
use App\Models\CatUserType;
use App\Models\UserCuestEpisodio;
use App\Models\UserCuestPad;
use App\Models\UserCuestUbicacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function userCita($pacientes_id)
    {
        return User::userCita( [ $pacientes_id ] );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $params =" ";

        if (isset($_GET['cedula'])) {
            $params = "where user_profile.cedula=".$_GET['cedula'];
        }
        $model = DB::select("
            select group_concat(
                user_profile.user_id) AS 'user_id',
                count(user_profile.cedula) AS 'total_repetido'

            from user_profile
            ".$params."
            group by user_profile.cedula having (total_repetido > 1)
            #order by count(user_profile.cedula) desc
            LIMIT 1
        ");
        $model2 = DB::select("
            select group_concat(
                user_profile.user_id) AS 'user_id',
                count(user_profile.cedula) AS 'total_repetido'

            from user_profile
            ".$params."
            group by user_profile.cedula having (total_repetido > 1)
            #order by count(user_profile.cedula) desc

        ");
        echo "Total Repetidos:".count($model2);
        $resulset = [];
        foreach ($model as $key => $value) {
            $group_user_id = explode( ",",$value->user_id);
            $resulset[$key] =[];
            foreach ($group_user_id as $key2 => $value2) {
                $resulset[$key][$key2]['user_id'] =$value2;
                $resulset[$key][$key2]['user'] = DB::select("SELECT * FROM user where id=".$value2);
                $resulset[$key][$key2]['user_type'] = DB::select("SELECT cat_user_type_id FROM user_type where user_id=".$value2);
                $resulset[$key][$key2]['user_profile'] = DB::select("SELECT * FROM user_profile where user_id=".$value2);
                $resulset[$key][$key2]['user_cuest_direction'] = DB::select("SELECT * FROM user_cuest_direction where user_id=".$value2);
                $resulset[$key][$key2]['user_cuest_episodio'] = DB::select("SELECT * FROM user_cuest_episodio where user_id=".$value2);

                $resulset[$key][$key2]['user_cuest_evolucion'] = DB::select("SELECT * FROM user_cuest_evolucion where user_id=".$value2);
                $resulset[$key][$key2]['user_cuest_imp_diagn'] = DB::select("SELECT * FROM user_cuest_imp_diagn where user_id=".$value2);

                $resulset[$key][$key2]['enfermedad_actual'] = DB::select("SELECT * FROM enfermedad_actual where user_id_paciente=".$value2);
                $resulset[$key][$key2]['examen_fisico'] = DB::select("SELECT * FROM examen_fisico where user_id_paciente=".$value2);
                $resulset[$key][$key2]['motivo_consulta'] = DB::select("SELECT * FROM motivo_consulta where user_id_paciente=".$value2);
                $resulset[$key][$key2]['solicitud_quirofano'] = DB::select("SELECT * FROM solicitud_quirofano where user_id_paciente=".$value2);
                $resulset[$key][$key2]['user_cuest_alert'] = DB::select("SELECT * FROM user_cuest_alert where user_id_paciente=".$value2);
                $resulset[$key][$key2]['user_cuest_antecedente'] = DB::select("SELECT * FROM user_cuest_antecedente where user_id=".$value2);
                $resulset[$key][$key2]['user_cuest_cal'] = DB::select("SELECT * FROM user_cuest_cal where user_id_paciente=".$value2);
                $resulset[$key][$key2]['user_cuest_chat'] = DB::select("SELECT * FROM user_cuest_chat where user_id_paciente=".$value2);
                $resulset[$key][$key2]['user_cuest_comorbilidad'] = DB::select("SELECT * FROM user_cuest_comorbilidad where user_id=".$value2);
                $resulset[$key][$key2]['user_cuest_egreso'] = DB::select("SELECT * FROM user_cuest_egreso where user_id=".$value2);
                $resulset[$key][$key2]['user_cuest_estudio'] = DB::select("SELECT * FROM user_cuest_estudio where user_id=".$value2);

                $resulset[$key][$key2]['user_cuest_pendiente'] = DB::select("SELECT * FROM user_cuest_pendiente where user_id=".$value2);
                $resulset[$key][$key2]['user_cuest_plan'] = DB::select("SELECT * FROM user_cuest_plan where user_id=".$value2);
                $resulset[$key][$key2]['user_vip'] = DB::select("SELECT * FROM user_vip where user_id_paciente=".$value2);

                $resulset[$key][$key2]['user_cuest_fc'] = DB::select("SELECT * FROM user_cuest_fc where user_id_paciente=".$value2);
                $resulset[$key][$key2]['user_cuest_fr'] = DB::select("SELECT * FROM user_cuest_fr where user_id_paciente=".$value2);
                $resulset[$key][$key2]['user_cuest_glic'] = DB::select("SELECT * FROM user_cuest_glic where user_id_paciente=".$value2);
                $resulset[$key][$key2]['user_cuest_monitoreo'] = DB::select("SELECT * FROM user_cuest_monitoreo where user_id=".$value2);
                $resulset[$key][$key2]['user_cuest_ta'] = DB::select("SELECT * FROM user_cuest_ta where user_id_paciente=".$value2);
                $resulset[$key][$key2]['user_cuest_tac'] = DB::select("SELECT * FROM user_cuest_tac where user_id=".$value2);



                $resulset[$key][$key2]['user_cuest_informe'] = DB::select("SELECT * FROM user_cuest_informe where user_id=".$value2);
                $resulset[$key][$key2]['user_cuest_medico_paciente'] = DB::select("SELECT * FROM user_cuest_medico_paciente where user_id=".$value2);
                $resulset[$key][$key2]['user_cuest_observacion'] = DB::select("SELECT * FROM user_cuest_observacion where user_id=".$value2);
                $resulset[$key][$key2]['user_cuest_orden_medica'] = DB::select("SELECT * FROM user_cuest_orden_medica where user_id=".$value2);
                $resulset[$key][$key2]['user_cuest_pad'] = DB::select("SELECT * FROM user_cuest_pad where user_id=".$value2);
                $resulset[$key][$key2]['user_cuest_prueba_covid'] = DB::select("SELECT * FROM user_cuest_prueba_covid where user_id=".$value2);
                $resulset[$key][$key2]['user_cuest_recipe'] = DB::select("SELECT * FROM user_cuest_recipe where user_id=".$value2);
                $resulset[$key][$key2]['user_cuest_resbalar'] = DB::select("SELECT * FROM user_cuest_resbalar where user_id_paciente=".$value2);
                $resulset[$key][$key2]['user_cuest_riesgo_quirurgico'] = DB::select("SELECT * FROM user_cuest_riesgo_quirurgico where user_id_paciente=".$value2);
                $resulset[$key][$key2]['user_cuest_sintoma'] = DB::select("SELECT * FROM user_cuest_sintoma where user_id=".$value2);
                $resulset[$key][$key2]['user_cuest_ubicacion'] = DB::select("SELECT * FROM user_cuest_ubicacion where user_id_paciente=".$value2);
                $resulset[$key][$key2]['user_cuest_vinculo_institucion'] = DB::select("SELECT * FROM user_cuest_vinculo_institucion where user_id=".$value2);
                $resulset[$key][$key2]['user_encuesta'] = DB::select("SELECT * FROM user_encuesta where user_id=".$value2);
                $resulset[$key][$key2]['user_encuesta_pregunta'] = DB::select("SELECT * FROM user_encuesta_pregunta where user_id=".$value2);
                $resulset[$key][$key2]['user_equipo_salud'] = DB::select("SELECT * FROM user_equipo_salud where user_id=".$value2);
                $resulset[$key][$key2]['user_especialidad'] = DB::select("SELECT * FROM user_especialidad where user_id=".$value2);
                $resulset[$key][$key2]['user_medico_posicion'] = DB::select("SELECT * FROM user_medico_posicion where user_id=".$value2);
                $resulset[$key][$key2]['user_orientacion'] = DB::select("SELECT * FROM user_orientacion where user_id_paciente=".$value2);


                $resulset[$key][$key2]['user_cuest_otro_archivo'] = DB::select("SELECT * FROM user_cuest_otro_archivo where user_id=".$value2);
                $resulset[$key][$key2]['user_cuest_fotografia'] = DB::select("SELECT * FROM user_cuest_fotografia where user_id=".$value2);
                $resulset[$key][$key2]['user_cuest_laboratorio'] = DB::select("SELECT * FROM user_cuest_laboratorio where user_id=".$value2);
                $resulset[$key][$key2]['user_family'] = DB::select("SELECT * FROM user_family where user_id=".$value2);

            }
            //dd($resulset);
        }
            //dd($resulset);
        return view('user.pacientesduplicados',compact("resulset"));
    }
    public function cerrarEpisodiosPaciente($user_id){
        return DB::select("
            UPDATE user_cuest_episodio AS t1
            INNER JOIN (
                SELECT id, user_id
                FROM user_cuest_episodio
                WHERE user_id = ".$user_id."
                ORDER BY id DESC
                LIMIT 1 OFFSET 1
            ) AS t2
            ON t1.id = t2.id
            SET egreso = curdate(), active = 0
            WHERE t1.user_id = ".$user_id.";
        ");
    }
    public function relationshipsById($user_id){
        $model = User::find($user_id);
        $this->callAction("relationships",[$model,$user_id]);
    }
    public function relationshipsbycedula($cedula){
        $model = UserProfile::where("cedula",$cedula)->first();
        //dd($model->user);
        $user_id = $model->user->id;
        $this->callAction("relationships",[$model->user,$user_id]);
    }
    public function relationships($model,$user_id)
    {

        echo "¿TIENE PERFIL?";
        dump($model->profile->exists());

        echo "TOTAL ROLES";
        dump(
            count(
                $model->types->map(function ($model) {
                    return $model->toArray();
                })
                ->pluck("cat_user_type_id")
                ->toArray()
            )
        );


        /* dump(
            $model->types->map(function ($model) {
                return $model->type->toArray();
            })
            ->pluck("description")
            ->toArray()
        ); */

        echo "¿ES PACIENTE?";
        dump( $this->callAction("is_patient",[$user_id]) );

        echo "¿ES MEDICO?";
        dump( $this->callAction("is_medic",[$user_id]) );

        echo "CARGOS";
        dump( $model->cargos );

        echo "TOTAL EPISODIOS";
        dump(
            count(
                $model->episodes
                ->toArray()
            )
        );

    }
    public function is_medic($user_id)
    {
        //Obtener si el usuario es médico
        $model = User::find($user_id)->types->where("cat_user_type_id",2)->count();
        return    $model ? true :false;
    }
    public function is_patient($user_id)
    {
        //Obtener si el usuario es paciente
        $model = User::find($user_id)->types->where("cat_user_type_id",1)->count();
        return    $model ? true :false;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $message = $this->valida_tipoUsuario($request->cat_user_type_id);
        return view("user.create",compact("message"));
    }
    public function scstore(Request $request)
    {
        return User::scstore($request);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cedulaExiste = UserProfile::where("cedula",$request->cedula)->first();
        //dd($cedulaExiste);
        if(!is_null($cedulaExiste)){

            return "cedula_existe";
        }
        //dd($request->all());
        return User::store($request);

    }
    public function store2(Request $request)
    {
        $model = new User();
        $model::updateOrCreate([
            //Add unique field combo to match here
            //For example, perhaps you only want one entry per user:
            'email'   => $request->correoElectronico,
        ],[
            'email'     => $request->correoElectronico,
            'password' => $request->password
        ]);
        dd($model->id);
    }
    public function updateEmail(Request $request){ //user_id, newEmail
        $validator = Validator::make(['email' => $request->newEmail], [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response('El correo electrónico no puede ser nulo y debe tener un formato válido.', 200);
        }

        $user = User::where('email', $request->newEmail)->where('id','<>',$request->user_id)->first();

        if(!$user){
            $user = User::find($request->user_id);
            $user->email = $request->newEmail;
            $user->save();

            return response('El correo electrónico fue modificado con éxito.', 200);
        }

        // echo $user;
        return response('El correo '.$user->email.' ya está registrado en el sistema. Debe usar uno distinto.', 200);
        // return response('El correo electrónico está siendo usado por el paciente '.$user->profile->nombres.' '.$user->profile->apellidos.'.', 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return User::show($request->user_id);
    }
    public function getByEmail(Request $request)
    {
        return User::getByEmail($request->email);
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
    public function update(Request $request)
    {
        $model = User::find($request->user_id);
        $model->email = $request->email;
        $model->email_alternativo = $request->email_alternativo;
        $model->save();
        return $model;
    }
    public function update_item(Request $request)
    {
        return User::update_item($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {


            DB::select("SET FOREIGN_KEY_CHECKS = 0;");
            DB::select("DELETE FROM enfermedad_actual where user_id_paciente=".$id);
            DB::select("DELETE FROM examen_fisico where user_id_paciente=".$id);
            DB::select("DELETE FROM motivo_consulta where user_id_paciente=".$id);
            DB::select("DELETE FROM solicitud_quirofano where user_id_paciente=".$id);
            DB::select("DELETE FROM user_cuest_alert where user_id_paciente=".$id);
            DB::select("DELETE FROM user_cuest_antecedente where user_id=".$id);
            DB::select("DELETE FROM user_cuest_cal where user_id_paciente=".$id);
            DB::select("DELETE FROM user_cuest_chat where user_id_paciente=".$id);
            DB::select("DELETE FROM user_cuest_comorbilidad where user_id=".$id);
            DB::select("DELETE FROM user_cuest_egreso where user_id=".$id);
            DB::select("DELETE FROM user_cuest_episodio where user_id=".$id);
            DB::select("DELETE FROM user_cuest_estudio where user_id=".$id);
            DB::select("DELETE FROM user_cuest_evolucion where user_id=".$id);
            DB::select("DELETE FROM user_cuest_imp_diagn where user_id=".$id);
            DB::select("DELETE FROM user_cuest_pendiente where user_id=".$id);
            DB::select("DELETE FROM user_cuest_plan where user_id=".$id);
            DB::select("DELETE FROM user_vip where user_id_paciente=".$id);

            DB::select("DELETE FROM user_cuest_fc where user_id_paciente=".$id);
            DB::select("DELETE FROM user_cuest_fr where user_id_paciente=".$id);
            DB::select("DELETE FROM user_cuest_glic where user_id_paciente=".$id);
            DB::select("DELETE FROM user_cuest_monitoreo where user_id=".$id);
            DB::select("DELETE FROM user_cuest_ta where user_id_paciente=".$id);
            DB::select("DELETE FROM user_cuest_tac where user_id=".$id);



            DB::select("DELETE FROM user_cuest_informe where user_id=".$id);
            DB::select("DELETE FROM user_cuest_medico_paciente where user_id=".$id);
            DB::select("DELETE FROM user_cuest_observacion where user_id=".$id);
            DB::select("DELETE FROM user_cuest_orden_medica where user_id=".$id);
            DB::select("DELETE FROM user_cuest_pad where user_id=".$id);
            DB::select("DELETE FROM user_cuest_prueba_covid where user_id=".$id);
            DB::select("DELETE FROM user_cuest_recipe where user_id=".$id);
            DB::select("DELETE FROM user_cuest_resbalar where user_id_paciente=".$id);
            DB::select("DELETE FROM user_cuest_riesgo_quirurgico where user_id_paciente=".$id);
            DB::select("DELETE FROM user_cuest_sintoma where user_id=".$id);
            DB::select("DELETE FROM user_cuest_ubicacion where user_id_paciente=".$id);
            DB::select("DELETE FROM user_cuest_vinculo_institucion where user_id=".$id);
            DB::select("DELETE FROM user_encuesta where user_id=".$id);
            DB::select("DELETE FROM user_encuesta_pregunta where user_id=".$id);
            DB::select("DELETE FROM user_equipo_salud where user_id=".$id);
            DB::select("DELETE FROM user_especialidad where user_id=".$id);
            DB::select("DELETE FROM user_medico_posicion where user_id=".$id);
            DB::select("DELETE FROM user_orientacion where user_id_paciente=".$id);


            DB::select("DELETE FROM user_cuest_otro_archivo where user_id=".$id);
            DB::select("DELETE FROM user_cuest_fotografia where user_id=".$id);
            DB::select("DELETE FROM user_cuest_laboratorio where user_id=".$id);
            DB::select("DELETE FROM user_family where user_id=".$id);

            DB::select("DELETE FROM user_type where user_id=".$id);
            DB::select("DELETE FROM user_profile where user_id=".$id);
            DB::select("DELETE FROM user_cuest_direction where user_id=".$id);
            DB::select("DELETE FROM user where id=".$id);
            DB::select("SET FOREIGN_KEY_CHECKS = 1;");
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function valida_tipoUsuario($tipousuario)
    {
        if (isset($tipousuario)) {
            if(
                $tipousuario >= 1 ||
                $tipousuario <= 3
            ){
                return $tipousuario;
            }else{
                return null;
            }
        }
        else{
            return null;
        }
    }
    public function emailExist(Request $request)
    {
        return User::emailExist($request);

        /*
        User::store($request,1);

        $user = User::emailExist($request);

        $request->merge(['user_id' =>$user['id']]);
        $request->merge(['user_id_paciente' =>$user['id']]);

        if(
            !is_null($request->cedula) &&
            is_null($request->correoElectronico)
        ){
            $request->merge(['cedula' =>$request->cedula]);
            //dd($request->all());
        }


        if(
            is_null($request->cedula) &&
            !is_null($request->correoElectronico)
        ){
            $request->merge(['cedula' =>rand(500000000,900000000 )]);
        }

        try {
            UserType::store($request);
            UserProfile::store($request);
            UserCuestPad::store($request);
            UserCuestUbicacion::store2($request);//el created_at es el que me indicará los ingresos y egresos
        } catch (\Throwable $th) {
            throw $th;
        }




        return $user;
        /*
        if($request->claveReg=="correo"){
            $user = User::emailExist($request);
            if(!$user){
                $user = User::store2($request);
            }
            $request->merge(['user_id' =>$user['id']]);
            $request->merge(['user_id_paciente' =>$user['id']]);
            $request->merge(['cedula' =>$user['email']]);

            if(empty(UserType::where("user_id",$user['id'])->where("cat_user_type_id",1)->first())){
                UserType::store($request);
            }
            if(is_null(UserCuestUbicacion::where("user_id_paciente",$user['id'])->first())){
                UserCuestUbicacion::store2($request);
            }
            if(is_null(UserCuestPad::where("user_id",$user['id'])->first())){
                UserCuestPad::store($request);
            }
            return $user;
        }

        if($request->claveReg=="cedula"){
            $user = User::emailExist($request);


            if(is_null($user2= UserProfile::where("cedula",$request->correoElectronico)->first())){

                if(!$user){
                    $user = User::store2($request);
                }
                $request->merge(['user_id' =>$user['id']]);
                $request->merge(['user_id_paciente' =>$user['id']]);
                $request->merge(['cedula' =>$user['email']]);

                if(empty(UserType::where("user_id",$user['id'])->where("cat_user_type_id",1)->first())){
                    UserType::store($request);
                }
                if(is_null(UserCuestUbicacion::where("user_id_paciente",$user['id'])->first())){
                    UserCuestUbicacion::store2($request);
                }
                if(is_null(UserProfile::where("user_id",$user['id'])->first())){
                    UserProfile::store($request);
                }
                if(is_null(UserCuestPad::where("user_id",$user['id'])->first())){
                    UserCuestPad::store($request);
                }
                return $user;
            }else{

                return User::where("id",$user2->user_id)->select("id","email")->first();
            }

            return $user;

        }*/

    }
    public function reset()
    {
        $db_host = '167.99.109.84'; //Host del Servidor MySQL
        $db_name = 'qdvkztswjy'; //Nombre de la Base de datos
        $db_user = 'usuario'; //Usuario de MySQL
        $db_pass = 'BjJ9T4pbkP'; //Password de Usuario MySQL

        $fecha = date("Ymd-His"); //Obtenemos la fecha y hora para identificar el respaldo

        // Construimos el nombre de archivo SQL Ejemplo: mibase_20170101-081120.sql
        $salida_sql = $db_name.'_'.$fecha.'.sql';

        //Comando para genera respaldo de MySQL, enviamos las variales de conexion y el destino
        $dump = "mysqldump --h$db_host -u$db_user -p$db_pass --opt $db_name > $salida_sql";
        $salida = system($dump, $output); //Ejecutamos el comando para respaldo

        header ("Location: $salida"); // Redireccionamos para descargar el Arcivo ZIP

        /*
        $zip = new ZipArchive(); //Objeto de Libreria ZipArchive

        //Construimos el nombre del archivo ZIP Ejemplo: mibase_20160101-081120.zip
        $salida_zip = $db_name.'_'.$fecha.'.zip';

        if($zip->open($salida_zip,ZIPARCHIVE::CREATE)===true) { //Creamos y abrimos el archivo ZIP
            $zip->addFile($salida_sql); //Agregamos el archivo SQL a ZIP
            $zip->close(); //Cerramos el ZIP
            unlink($salida_sql); //Eliminamos el archivo temporal SQL
            header ("Location: $salida_zip"); // Redireccionamos para descargar el Arcivo ZIP
            } else {
            echo 'Error'; //Enviamos el mensaje de error
        }*/
    }
    // Función que consume la cédula del paciente y devuelve si ya fue paciente, su usuario y su perfil y los episodios activos
    public function getPatient(Request $request){

        $exist = false;
        $user = null;
        $episodesOpen = [];

        $paciente = UserProfile::where('cedula',$request->cedula)
        ->with('user.profile')
        ->first();

        if($paciente){
            $exist = true;
            $user = $paciente->user;

            $episodios =    UserCuestEpisodio::where('user_id',$user->id)
                            ->leftJoin("user_cuest_ubicacion","user_cuest_episodio.id","user_cuest_ubicacion.user_cuest_episodio_id")
                            ->leftJoin("cat_user_ubicacion","user_cuest_ubicacion.cat_user_ubicacion_id","cat_user_ubicacion.id")
                            ->select(
                                DB::raw("user_cuest_episodio.id AS episodio_id"),
                                DB::raw("cat_user_ubicacion.id AS ubicacion_id"),
                                DB::raw("
                                    CONCAT(
                                        cat_user_ubicacion.description,
                                        ' | ',
                                        cat_user_ubicacion.coments
                                    ) AS ubicacion_description"
                                )
                            )
                            ->whereNotIn("user_cuest_ubicacion.cat_user_ubicacion_id",[246,247,248,249,251])
                            ->where("user_cuest_episodio.active",1)
                            ->where("user_cuest_ubicacion.active",1)
                            ->orderBy("user_cuest_episodio.id","DESC")
                            ->get();
            //dd($episodios->count());
            if( $episodios->count() > 0) {
                $episodios = $episodios->take(1)->toArray();
                foreach($episodios as $episodio){

                    $episodesOpen['episodio_id'] = $episodio['episodio_id'];
                    $episodesOpen['ubicacion_id'] = $episodio['ubicacion_id'];
                    $episodesOpen['ubicacion_description'] = $episodio['ubicacion_description'];

                }
            }

        }

        return response([
            'exist' => $exist,
            'user' => $user,
            'episodesOpen' => $episodesOpen
        ],200);

    }
}
