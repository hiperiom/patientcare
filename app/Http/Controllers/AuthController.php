<?php

namespace App\Http\Controllers;

use App\Models\UserEspecialidad;
use App\Models\UserProfile;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Crypt;
use App\Models\AreaQuirurgica;
use App\Models\UserType;
use Illuminate\Support\Facades\DB;
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forseReloadForEvoidCache() {
        $success = false;
        $DB_VERSION = NULL;

        $query_system_version = DB::select("SELECT value FROM systemconfig WHERE id = 1");

        if ( count($query_system_version) > 0 ) {
            if ( !empty($query_system_version) ) {
                $DB_VERSION = $query_system_version[0]->value;

            }
        }
        //dd($system_version);
        // Leer el contenido del archivo package.json
        $packageJsonPath = base_path('package.json');
        $packageJsonContent = json_decode(file_get_contents($packageJsonPath), true);

        // Obtener el número de versión
        $versionPackageJSON = $packageJsonContent['version'] ?? 'unknown';

        // Desloguear al usuario si está autenticado
        if ( $versionPackageJSON  !== $DB_VERSION) {
            $success= true;
            DB::select("UPDATE systemconfig SET value = '".$versionPackageJSON."' WHERE id = 1");
        }

        // Retornar el número de versión
        //return response()->json(['version' => $version,'success'=>$success]);





        //dd($version);
        return Response()->json(['success'=>$success,'version_value'=>$versionPackageJSON]);

    }
    public function index($cat_user_type_id=2, Request $request)
    {
        //dd(Auth::check());

        if (Auth::check()) {
           return redirect("/medico");
        }
        $message = $this->valida_tipoUsuario($cat_user_type_id);
        return view("auth.login",compact("message"));
    }
    public function app()
    {
        /* if (Auth::check()) {
           return redirect("/medico");
        } */

        return view("auth.app");
    }

    public function validateUser(Request $request){


        $model = new User();
        $model = $model->join("user_profile",'user.id','user_profile.user_id');
        $model = $model->select(
            "user.email",
            "user_profile.*"
        );

        $model = $model->where("email",$request->email);
        $model = $model->where("password",$request->password);
        $model = $model->first();

        $data = [];
        $exists = $model->exists;

        if($model->exists){
            //Auth::login($model);
            $model = $model->toArray();

            $model2 = new UserType();
            $model2 = $model2->where("user_id",$model['user_id']);
            $model2 = $model2->select(
                "cat_user_type_id"
            );
            $model2 = $model2->get();
            $model2 = $model2->toArray();

            $data = [

                "user_id"=>$model['user_id'],
                "nombres"=>$model['nombres'],
                "apellidos"=>$model['apellidos'],
                "roles"=> array_values($model2)
            ];
        }

        //dd($model->toArray());
        return Response()->json(['status'=>$exists,'data'=>$data]);
    }
    public function getUserRoles(Request $request){
        return UserType::where('user_id',$request->user_id)->select("cat_user_type_id")->get()->pluck("cat_user_type_id")->toArray();
    }
    public function AuthAreaEquiposalud(Request $request)
    {
        $this->getAuthData($request);

        return redirect('/medico');

    }
    /* public function AuthAreaHospitalizacion(Request $request)
    {
        dd( $request);
        $this->getAuthData($request);

        $piso = $_GET['piso'];
        $ala = $_GET['ala'];


        return redirect('/areaHospitalizacion/pantalla_piso?piso='.$piso.'&ala='.$ala.'');

    } */
    public function AuthAreaHomeCare(Request $request)
    {
        $this->getAuthData($request);

        return redirect('/homecare');

    }
    public function AuthAreaHospitalizacion(Request $request)
    {
        $this->getAuthData($request);
        $piso = $_GET['piso'];
        $ala = $_GET['ala'];


        return redirect('/areaHospitalizacion/pantalla_piso?piso='.$piso.'&ala='.$ala.'');


    }
    public function AuthAreaUti(Request $request)
    {
        $this->getAuthData($request);
        $uti = $_GET['uti'];


        return redirect('/areaUti/pantalla_uti?uti='.$uti);


    }
    public function AuthAreaEquiposalud2(Request $request)
    {
        $this->getAuthData($request);
        $area = $_GET['area'];
        return redirect('/user/medico/seguimiento_medico/'.$area);

    }
    public function AuthAreaHoteleria(Request $request)
    {
        $this->getAuthData($request);
        // $area = $_GET['area'];
        return redirect('/surveyInsituIndex');
    }
    public function getAuthData($request){
        $user_id = $_GET['user_id'];

        $model = new User();
        $model = $model->where("id",$user_id);
        $model = $model->first();

        Auth::login($model);

        $user = Auth()->user();

        $userData = $user->profile;

        $userData = [

            "user_id"=>$userData->user_id,
            "prefijo"=>$userData->prefijo,
            "nombre"=>$userData->nombres,
            "apellido"=>$userData->apellidos,
            "cedula"=>$userData->cedula,
            "telefono_movil"=>$userData->telefono_movil,
            "genero"=>$userData->genero,
            "especialidad_id"=> 1, //$especialidad->cat_user_especialidad_id,
            "especialidad"=> "error", //$especialidad->description,
            "imagen"=>$userData->imagen
        ];
        Session::put('email', $user->email);
        Session::put('cat_user_type_id', $user->userType->cat_user_type_id);

        Session::put('userData', $userData);
        $query_system_version = DB::select("SELECT value FROM systemconfig WHERE id = 1");

        if ( count($query_system_version) > 0 ) {
            if ( !empty($query_system_version) ) {
                $system_version = $query_system_version[0]->value;
                $success= true;
            }
        }
        Session::put('APP_VERSION', $system_version );

        return $user;
    }
    public function AuthAreaAdministrador(Request $request)
    {
        $this->getAuthData($request);

        return redirect('/user/admin/index');

    }
    public function AuthResumenClinico(Request $request)
    {
        $this->getAuthData($request);

        return redirect('/medico/resumen_pacientes?area=tp');

    }
    public function AuthEquipoEnfermeria(Request $request)
    {
        $this->getAuthData($request);

        return redirect('/user/enfermeria/');

    }
    public function AuthPaciente(Request $request)
    {

    }
    public function AuthAreaQuirurgicaTablero(Request $request)
    {
        $user = $this->getAuthData($request);

        return redirect('/tableroAqx');
    }
    public function AuthAreaPlanificacionGuardias(Request $request)
    {
        $user = $this->getAuthData($request);

        return redirect('/tableroplanificacionguardias');
    }
    public function AuthAreaQuirurgica(Request $request)
    {
        $user = $this->getAuthData($request);
        $is_enfermero = in_array(6, $user->getUserTypes->pluck('cat_user_type_id')->toArray());
        //dd( $is_enfermero);
        if ($is_enfermero) {
            return redirect('/areaQuirofano/enfermeria/index_enfermeria');
        }
        return redirect('/areaQuirofano/index_quirofano');
    }
    public function AuthAreaQuirurgicaAmb(Request $request)
    {
        $user = $this->getAuthData($request);
        /* $is_enfermero = in_array(6, $user->getUserTypes->pluck('cat_user_type_id')->toArray());
        //dd( $is_enfermero);
        if ($is_enfermero) {
            return redirect('/areaQuirofano/enfermeria/index_enfermeria');
        } */
        return redirect('/areaQuirofanoAmb/index_quirofano');
    }
    public function AuthTelesaludEmpresarial(Request $request)
    {
        $this->getAuthData($request);

        return redirect('/telesalud/empresarial/index');
    }
    public function AuthListMedicos(Request $request)
    {
        $this->getAuthData($request);

        return redirect('/medico/index_medicos');
    }
    public function AuthEnfermeria(Request $request)
    {

    }


    public function verificarCredenciales(Request $request)
    {

        //1 valido si los datos estan registrados

        $user1 = User::where("email",$request->email)->pluck('password')->implode('password');

        // $decrypted = Crypt::decryptString($user1);

        if ($request->password == $user1) {
            $user = User::where("email",$request->email)->first();
        }else{
            $user = User::where("email",$request->email)->where("password",$request->password)->first();
        }

        if(is_null($user)){
            //2si no existen regreso a la pantalla de login
            $message = "user-register-no-found";
            return redirect()->route('auth/login',['cat_user_type_id'=>$request->cat_user_type_id,'message'=>$message]);
        }else {
            //3 si existe inicializo sesion
            Auth::login($user);
            Session::put('email', $user->email);
            Session::put('cat_user_type_id', $user->userType->cat_user_type_id);

            //4 si el usuario tiene el id paciente
            /* if ($user->userType->cat_user_type_id == 1) {

                //5 consulto los datos del paciente
                $paciente =UserProfile::where("user_id",$user->id)->first();

                //6 si no existe el paciente lo llevo a la pantalla de registro
                if(is_null($paciente)){
                    $message = "paciente-register-no-found";
                    return redirect()->route('paciente/create',['cat_user_type_id'=>$request->cat_user_type_id,'message'=>$message]);
                }else{
                    //dd($medico->nombre);
                    $pacienteData = [
                        "nombre"=>$paciente->nombre,
                        "apellido"=>$paciente->apellido,
                        "cedula"=>$paciente->cedula,
                        "telefono_movil"=>$paciente->telefono_movil,
                        "genero"=>$paciente->genero,
                        "imagen"=>$paciente->imagen
                    ];
                    Session::put('userData', $pacienteData);
                    //si existe el paciente lo llevo a su pantalla principal de sesion
                    return redirect()->route('paciente');
                }
            } */
            //dump( $user->userType->cat_user_type_id);
            //4 si el usuario tiene el id medico
            if ($user->userType->cat_user_type_id == 2 || $user->userType->cat_user_type_id == 1 || $user->userType->cat_user_type_id == 4) {

                //5 consulto los datos del medico
                $medico =UserProfile::where("user_id",$user->id)->first();
                $especialidad = UserEspecialidad::show($user->id);
                //6 si no existe el medico lo llevo a la pantalla de registro
                if(is_null($medico)){
                    $message = "medico-register-no-found";
                    return redirect()->route('medico/create',['cat_user_type_id'=>$request->cat_user_type_id,'message'=>$message]);
                }else{
                    //dd($medico);
                    $medicoData = [
                        "user_id"=>$medico->user_id,
                        "prefijo"=>$medico->prefijo,
                        "nombre"=>$medico->nombres,
                        "apellido"=>$medico->apellidos,
                        "cedula"=>$medico->cedula,
                        "telefono_movil"=>$medico->telefono_movil,
                        "genero"=>$medico->genero,
                        "especialidad_id"=>$especialidad->cat_user_especialidad_id,
                        "especialidad"=>$especialidad->description,
                        "imagen"=>$medico->imagen
                    ];

                    Session::put('userData', $medicoData);
                    //si existe el medico lo llevo a su pantalla principal de sesion
                    return redirect()->route('medico');
                }
            }


        }

        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        //session(['admin_user_id' => $request->admin_user_id]);


        //return view("medico.index",compact("message"));
    }
    public function finalizarSesion(Request $request)
    {

        Auth::logout();
        return redirect()->route('/')->with("l",1);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return redirect()->route('user/create');
    }
    public function tipousuario()
    {
        return view("auth.tipousuario");
    }
    public function sessionExist()
    {
        @session_start();

        //true = sesion finalizada
        //false = sesion activa
        return Response()->json(is_null(Auth::user()));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->tipo_cuenta == 1){ //paciente
            return redirect()->route('paciente/create');
        }
        if($request->tipo_cuenta == 2){ //medico
            return redirect()->route('medico/create');
        }
        if($request->tipo_cuenta == 3){ //familiar
            return redirect()->route('familiar/index');
        }
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
    public function destroy($id)
    {
        //
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

    public function authcie11()
    {

        $tokenEndpoint = "https://icdaccessmanagement.who.int/connect/token";
        $clientId = "7719d23e-b6f8-42e8-b01c-e60d92304095_425bd72e-c85a-4dec-9711-7306b4ca022d"; //of course not a good idea to put id and secret in the source code
        $clientSecret = "xI50zJk0kQy1Au/fYpdDD7BdyCbCF3FCLQ1GC60PU4A="; //you could read from an encyrpted source in the production
        $grant_type = "client_credentials";
        $scope = "icdapi_access";


        // create curl resource to get the OAUTH2 token
        $ch = curl_init();

        // set URL to fetch
        curl_setopt($ch, CURLOPT_URL, $tokenEndpoint);

        // set HTTP POST
        curl_setopt($ch, CURLOPT_POST, TRUE);

        // set data to post
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                    'scope' => $scope,
                    'grant_type' => $grant_type
        ));

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        $json_array = (json_decode($result, true));
        $token = $json_array['access_token'];

        // close curl resource
        curl_close($ch);



        // create curl resource to access ICD API
        $ch = curl_init();

        // set URL to fetch
        curl_setopt($ch, CURLOPT_URL, 'https://id.who.int/icd/entity');

        // HTTP header fields to set
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization: Bearer '.$token,
                    'Accept: application/json',
                    'Accept-Language: es',
                    'API-Version: v2'
        ));

        // grab URL and pass it to the browser
        curl_exec($ch);

        // close curl resource
        curl_close($ch);


    }
}
