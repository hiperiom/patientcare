<?php

namespace App;


use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserCuestCormorbilidad;
use App\Models\UserCuestFichaMedica;
use App\Models\UserCuestMonitoreo;
use App\Models\UserCuestPruebaCovid;
use App\Models\UserCuestPruebasCovid;
use App\Models\UserCuestSintoma;
use App\Models\UserCuestVinculoInstitucion;
use App\Models\UserDireccion;
use App\Models\UserEquipoSalud;
use App\Models\UserEspecialidad;
use App\Models\UserFamily;
use App\Models\UserPacienteCondicion;
use App\Models\UserProfile;
use App\Models\UserType;
use App\Models\UserCuestConsulta;

use App\Models\UserPacienteFichaMedica;
use App\Models\UserPacienteSintoma;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;
    protected $table ="user";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','email_alternativo', 'password','user_id_medico',"created_at"
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    static function getCreatedAt(Request $request)
    {
        return User::where('id',$request->user_id)
            ->select(
                DB::raw("DATE_FORMAT(user.created_at,'%d/%m/%Y') AS fecha_registro")
            )
            ->value("fecha_registro");
    }
    public function userType(){
        return $this->hasOne('App\Models\UserType', 'user_id');
    }
    static function userCita($pacientes_ids)
    {
        return User::where("user.active",1)
            ->leftJoin("user_cuest_direction","user.id","user_cuest_direction.user_id")
            ->leftJoin("tarjeta_soy_chacao","user.id","tarjeta_soy_chacao.user_id_paciente")
            ->leftJoin("user_profile","user.id","user_profile.user_id")
            ->select(
                "user_cuest_direction.cat_estado_id",
                "user_cuest_direction.cat_municipio_id",
                "user_cuest_direction.description",
                "user_cuest_direction.domicilio",
                "user_profile.*" ,

                DB::raw("
                    (SELECT COUNT(*) FROM user_cita WHERE user_id_paciente = user.id AND cat_user_cita_status_id = 7) AS citas_completadas
                "),
                DB::raw("
                    (
                        SELECT user_profile_images.value
                        FROM user_profile_images
                        WHERE user_profile_images.user_id_paciente = user.id
                        AND user_profile_images.coments = 'imgSoyChacao'
                        AND user_profile_images.active = 1
                        LIMIT 1
                    ) AS imgSoyChacao
                "),

                DB::raw("
                    (
                        SELECT user_profile_images.value
                        FROM user_profile_images
                        WHERE user_profile_images.user_id_paciente = user.id
                        AND user_profile_images.coments = 'imgDocIdentidad'
                        AND user_profile_images.active = 1
                        LIMIT 1
                    ) AS imgDocIdentidad
                "),

                DB::raw("
                    user.email AS email
                "),
                DB::raw("
                    tarjeta_soy_chacao.description AS tarjeta_soy_chacao
                "),
                DB::raw("
                    CONCAT(
                        nombres,
                        ' ',
                        apellidos
                        ) as paciente
                "),
                "cedula",
                DB::raw("
                    CASE
                        WHEN fnacimiento IS NULL THEN ''
                        ELSE  DATE_FORMAT(fnacimiento, '%d/%m/%Y')
                    END AS nacimiento
                "),
                DB::raw("
                YEAR(CURDATE())-YEAR(upPac.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(upPac.fnacimiento,'%m-%d'), 0 , -1 ) AS edad
                ")
            )
            ->whereIn("user_profile.user_id",$pacientes_ids )
            ->get()
            ->toArray();
    }
    //UPDATE USER GENERAL
    static function update_item(Request $request){


        $model  = User::where( $request->field , $request->value )->first();
        if(!is_null($model)){
            return Response()->json("correo_existe");
        }else{
            $model = User::updateOrCreate(
                ["id" => $request->user_id],
                [
                    $request->field => $request->value
                ]
            );
            return $model;
        }

        return Response()->json($model) ;

    }
    public function getUserTypes()
    {
        //roles del usuario
        return $this->hasMany('App\Models\UserType', 'user_id');
    }
    static function store(Request $request,$caso=0)
    {

        //email = VACIO y cedula= LLENO
        $username = "";
        if (is_null($request->email) && !is_null($request->cedula)) {
            $nacionalidad = $request->nacionalidad;
            $cedula       = $request->cedula;
            $username     = $nacionalidad.$cedula;
            //$emailExists  = User::getByEmail($username);
            //if (is_null($emailExists)) {
                //$model = new User();
                $model = User::updateOrCreate([
                    'email'   => $username,
                ],[
                    'email'     => $username,
                    'email_alternativo'     => $request->email_alternativo,
                    'password' => $request->password,
                    'user_id_medico' => Auth::id(),
                    "created_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))
                ]);
                /* $model = new User();
                $model->email =  $username;
                $model->password = $request->password;
                $model->user_id_medico = Auth::id();
                $model->created_at =date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save(); */
            /*} else{
                return Response()->json("cedula_registrado");
            } */
        }
        //email = LLENO y cedula= VACIO
        if (!is_null($request->email) && is_null($request->cedula)) {
            $username = $request->email;
            //$emailExists  = User::getByEmail($username);
            //if (is_null($emailExists)) {
                $model = User::updateOrCreate([
                    'email'   => $username,
                ],[
                    'email'     => $username,
                    'email_alternativo'     => $request->email_alternativo,
                    'password' => $request->password,
                    'user_id_medico' => Auth::id(),
                    "created_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))
                ]);
                /* $model = new User();
                $model->email =  $username;
                $model->password = $request->password;
                $model->user_id_medico = Auth::id();
                $model->created_at =date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save(); */
            //}else{
            //    return Response()->json("email_registrado");
            //}
        }
        //email = LLENO y cedula= LLENO
        if (!is_null($request->email) && !is_null($request->cedula)) {
            $nacionalidad = $request->nacionalidad;
            $cedula       = $request->cedula;
            $username     = $request->email;
            //$emailExists  = User::getByEmail($username);
            //try {
               // $model = new User();
                $model = User::updateOrCreate([
                    'email'   =>  $username,
                ],[
                    'email'     => $username,
                    'email_alternativo'     => $request->email_alternativo,
                    'password' => $request->password,
                    'user_id_medico' => Auth::id(),
                    "created_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))
                ]);

            //} catch (\Throwable $th) {
                //throw $th;
            //    return Response()->json("email_registrado");
                //dd($th->errorInfo[0]);
            //}
        }
        return response()->json($model);
        //return  User::getByEmail($username);

    }
    static function scstore(Request $request,$caso=0)
    {


        $username = "";
        //email = VACIO y cedula= LLENO
        if (is_null($request->email) && !is_null($request->cedula)) {
            $nacionalidad = $request->nacionalidad;
            $cedula       = $request->cedula;
            $username     = $nacionalidad.$cedula;
            $emailExists  = User::getByEmail($username);
            if (is_null($emailExists)) {
                $model = new User();
                $model->email =  $username;
                $model->password = $request->password;
                $model->user_id_medico = Auth::id();
                $model->created_at =date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();
            }else{
                return Response()->json("cedula_registrado");
            }
        }
        //email = LLENO y cedula= VACIO
        if (!is_null($request->email) && is_null($request->cedula)) {
            $username = $request->email;
            $emailExists  = User::getByEmail($username);
            if (is_null($emailExists)) {
                $model = new User();
                $model->email =  $username;
                $model->password = $request->password;
                $model->user_id_medico = Auth::id();
                $model->created_at =date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();
            }else{
                return Response()->json("email_registrado");
            }
        }
        //email = LLENO y cedula= LLENO
        if (!is_null($request->email) && !is_null($request->cedula)) {
            $nacionalidad = $request->nacionalidad;
            $cedula       = $request->cedula;
            $username     = $request->email;
            $emailExists  = User::getByEmail($username);
            try {
                $model = new User();
                $model::updateOrCreate([
                    'email'   => $nacionalidad.$cedula,
                ],[
                    'email'     => $username,
                    'password' => $request->password,
                    'user_id_medico' => Auth::id(),
                    "created_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))
                ]);
            } catch (\Throwable $th) {
                //throw $th;
                return Response()->json("email_registrado");
                //dd($th->errorInfo[0]);
            }
        }

        return  User::getByEmail($username);

    }
    static function store2(Request $request)
    {


        try {
            $model = new User();
            $model::updateOrCreate([
                //Add unique field combo to match here
                //For example, perhaps you only want one entry per user:
                'email'   => $request->correoElectronico,
            ],[
                'email'     => $request->correoViejo,
                'password' => $request->password,
                "created_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))
            ]);


            return User::where("email",$request->correoElectronico)->select('id','email')->first();

        } catch (\Throwable $th) {

            return dd($th->errorInfo[2]);


        }
    }
    static function getUser($user_id)
    {
        return  User::where("user.active",1)
            ->where("user.id",$user_id)
            ->leftJoin("user_cuest_direction","user.id","user_cuest_direction.user_id")
            ->leftJoin("tarjeta_soy_chacao","user.id","tarjeta_soy_chacao.user_id_paciente")
            ->leftJoin("user_profile","user.id","user_profile.id")
            ->select(
                DB::raw(
                "tarjeta_soy_chacao.description AS tarjeta_soy_chacao
                "),
                "user_cuest_direction.cat_estado_id",
                "user_cuest_direction.cat_municipio_id",
                "user_cuest_direction.description",
                "user_cuest_direction.domicilio",
                "user_profile.*",
                DB::raw("
                    (SELECT COUNT(*) FROM user_cita WHERE user_id_paciente = user.id AND cat_user_cita_status_id = 7) AS citas_completadas
                "),
                DB::raw("
                    user.email AS correo
                "),
                DB::raw("
                    CONCAT(
                        nombres,
                        ' ',
                        apellidos
                        ) as paciente
                "),
                DB::raw("
                    CASE
                        WHEN cedula IS NULL THEN ''
                        ELSE FORMAT(cedula, 0, 'de_DE')
                    END AS cedula
                "),
                DB::raw("
                    CASE
                        WHEN fnacimientO IS NULL THEN ''
                        ELSE  DATE_FORMAT(fnacimiento, '%d/%m/%Y')
                    END AS nacimiento
                "),
                DB::raw("
                YEAR(CURDATE())-YEAR(upPac.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(upPac.fnacimiento,'%m-%d'), 0 , -1 ) AS edad
                ")
            )->get();
    }
    static function emailExist(Request $request)
    {
        $username = "";
        $message = "";
        //email = VACIO y cedula= LLENO
        if (is_null($request->email) && !is_null($request->cedula)) {
            $nacionalidad = $request->nacionalidad;
            $cedula       = $request->cedula;
            $username     = $nacionalidad.$cedula;
            $message = "cedula_existe";
        }
        //email = LLENO y cedula= VACIO
        if (!is_null($request->email) && is_null($request->cedula)) {
            $username = $request->email;
            $message = "email_existe";
        }
        //email = LLENO y cedula= LLENO
        if (!is_null($request->email) && !is_null($request->cedula)) {
            $nacionalidad = $request->nacionalidad;
            $cedula       = $request->cedula;
            $username     = $request->email;
            $message = "email_existe";
        }

        $emailExists  = User::getByEmail($username);

        if(is_null($emailExists)){
            return Response()->json(false);
        }else{
            return Response()->json($message);
        }
    }
    static function diasRegistrado($user_id)
    {

        $model = DB::table('user')
            ->where("id",$user_id)
            ->pluck("created_at")->first();
            $fecha1= new DateTime($model);
            $fecha2= new DateTime(date("Y-m-d H:m:s"));
            $diff = $fecha1->diff($fecha2);

        return $diff->days;

    }
    static function show($user_id)
    {
        return User::where("id",$user_id)->first();
    }
    static function getByEmail($email){
        return User::where("email",$email)->first();
    }
    //relationships
    public function types()
    {
        /*
            Obtener todos los roles del usuario
        */
        return $this->hasMany('App\Models\UserType', 'user_id', 'id');
    }
    public function profile()
    {
        /*
            Obtener el perfil del usuario
        */
        return $this->hasOne('App\Models\UserProfile', 'user_id', 'id');
    }
    public function cargo()
    {
        /*
            Obtener el perfil del usuario
        */
        return $this->hasMany('App\Models\UserMedicoPosicion', 'user_id', 'id');
    }
    public function episodes()
    {
        /*
            Obtener los episodios del usuario
        */
        return $this->hasMany('App\Models\UserCuestEpisodio', 'user_id', 'id');
    }
    public function especialidad()
    {
        /*
            Obtener la especialidad del usuario
        */
        return $this->hasOne('App\Models\UserEspecialidad', 'user_id', 'id');
    }

    public function episodios(){ // Retorna los episodios relacionados al paciente
        return $this->hasMany('App\Models\UserCuestEpisodio', 'user_id', 'id' );
    }


    public function ubicaciones(){ // Retorna las ubicaciones donde ha estado el paciente el paciente en su historia médica en la clínica
        return $this->hasMany('App\Models\UserCuestUbicacion', 'user_id_paciente', 'id' );
    }


}
