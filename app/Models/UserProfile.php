<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SplFileInfo;
use Illuminate\Support\Str;

class UserProfile extends Model
{
    protected $table = "user_profile";
    protected $fillable = [
        "user_id",
        "especialidad_id",
        "nombres",
        "apellidos",
        "nacionalidad",
        "cedula",
        "genero",
        "imagen",
        "prefijo",
        "extension_telefonica",
        "firma",
        "sello",
        "colegio_medico",
        "mpps",
        "tipo_sangre",
        "fnacimiento",
        "user_id_medico",
        "tipo_sangre",
        "telefono_movil",
        "telefono_hogar",
        "exonerado",
        "created_at"

    ];
    static function getPaciente($user_id)
    {
        return UserProfile::where("user_id",$user_id)
        ->select(
            DB::raw("
                CONCAT(
                    nombres,
                    ' ',
                    apellidos
                ) AS paciente
            ")
        )
        ->value("paciente");
    }
    static function getPacienteEdad($user_id)
    {
        return UserProfile::where("user_id",$user_id)
        ->select(
            DB::raw("
            YEAR(CURDATE())-YEAR(fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(fnacimiento,'%m-%d'), 0 , -1 )  AS edad
            ")
        )
        ->value("edad");
    }
    // static function store(Request $request)
    // {


    //     $existeCedula= UserProfile::getCedula($request->cedula);

    //     $nombre ="/image/system/patient.svg";
    //     $file = $request->file('imagen');
    //     //dd($file);
    //     if (!is_null($file)) {
    //         $aleatotio = Str::random(6);
    //         $nombre = "fp_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
    //         if (file_exists('image/user/foto_perfil/'.$nombre)) {
    //             return "imagen existe";
    //         }
    //         $file->move('image/user/foto_perfil/', $nombre);
    //         $nombre ='/image/user/foto_perfil/'. $nombre;

    //         $public_path = public_path();
    //         $info = new SplFileInfo($file->getClientOriginalName());
    //     }

    //     $firma ="image/system/firma_patientcare_default.png";
    //     $file = $request->file('firma');
    //     //dd($file);
    //     if (!is_null($file)) {
    //         $aleatotio = Str::random(6);
    //         $firma = "firma_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
    //         if (file_exists('image/user/firma/'.$firma)) {
    //             return "imagen existe";
    //         }
    //         $file->move('image/user/firma/', $firma);
    //         $firma ='image/user/firma/'. $firma;

    //         $public_path = public_path();
    //         $info = new SplFileInfo($file->getClientOriginalName());
    //     }

    //     $sello ="image/system/sello_patientcare_default.png";
    //     $file = $request->file('sello');
    //     //dd($request->all());
    //     if (!is_null($file)) {
    //         $aleatotio = Str::random(6);
    //         $sello = "sello_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
    //         if (file_exists('image/user/sello/'.$sello)) {
    //             return "imagen existe";
    //         }
    //         $file->move('image/user/sello/', $sello);
    //         $sello ='image/user/sello/'. $sello;

    //         $public_path = public_path();
    //         $info = new SplFileInfo($file->getClientOriginalName());
    //     }

    //     //if (is_null($existeCedula)) {
    //         //try {
    //             //$model = new UserProfile();
    //             $model = UserProfile::updateOrCreate([
    //                 "user_id"=>$request->user_id,
    //                 //"nacionalidad"=>$request->nacionalidad,
    //                 //"cedula"=>$request->cedula,
    //             ],[
    //                 "nombres"=>!is_null($request->nombres)?$request->nombres:"",
    //                 "apellidos"=>!is_null($request->apellidos)?$request->apellidos:"",
    //                 "cedula"=>$request->cedula,
    //                 "nacionalidad"=>$request->nacionalidad,
    //                 "genero"=>$request->genero,
    //                 "fnacimiento"=>$request->fnacimiento,
    //                 "prefijo"=>isset($request->prefijo) && $request->prefijo != "undefined" ? $request->prefijo:NULL,
    //                 "telefono_movil"=>$request->telefono_movil,
    //                 "imagen"=>$nombre,
    //                 "firma"=>$firma,
    //                 "sello"=>$sello,
    //                 "colegio_medico"=>$request->colegio_medico,
    //                 "mpps"=>$request->mpps,
    //                 "tipo_sangre"=>$request->tipo_sangre,
    //                 "user_id"=>$request->user_id,
    //                 "tipo_sangre"=>isset($request->tipo_sangre)?$request->tipo_sangre:null,
    //                 "user_id_medico"=>Auth::id(),
    //                 "created_at"=>date('Y-m-d H:i:s', strtotime($request['created_at'])),
    //             ]);

    //             /* $model->nombres = !is_null($request->nombres)?$request->nombres:"";
    //             $model->apellidos = !is_null($request->apellidos)?$request->apellidos:"";
    //             $model->cedula = $request->cedula;
    //             $model->nacionalidad = $request->nacionalidad;
    //             $model->genero = $request->genero;
    //             $model->fnacimiento = $request->fnacimiento;
    //             $model->prefijo = isset($request->prefijo) && $request->prefijo != "undefined" ? $request->prefijo:NULL;
    //             $model->telefono_movil = $request->telefono_movil;
    //             $model->imagen = $nombre;
    //             $model->firma = $firma;
    //             $model->sello = $sello;
    //             $model->colegio_medico = $request->colegio_medico;
    //             $model->mpps = $request->mpps;
    //             $model->tipo_sangre = $request->tipo_sangre;
    //             $model->user_id = $request->user_id;
    //             $model->tipo_sangre = isset($request->tipo_sangre)?$request->tipo_sangre:null;
    //             $model->user_id_medico = Auth::id();
    //             $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
    //             $model->save(); */
    //         /* } catch (\Throwable $th) {
    //             $model = UserProfile::where("user_id",$request->user_id)->where("cedula",$request->cedula)
    //             ->update([
    //                 'nombres' => !is_null($request->nombres)?$request->nombres:"",
    //                 'apellidos' => !is_null($request->apellidos)?$request->apellidos:"",
    //                 'nacionalidad' => $request->nacionalidad,
    //                 'genero' => $request->genero,
    //                 'fnacimiento' => $request->fnacimiento,
    //                 'telefono_movil' => $request->telefono_movil,
    //                 'firma' => $request->firma,
    //                 'sello' => $request->sello,
    //                 'mpps' => $request->mpps,
    //                 'colegio_medico' => $request->colegio_medico,
    //                 'imagen' => $nombre,
    //                 'user_id_medico' => Auth::id(),
    //                 'created_at' => date('Y-m-d H:i:s', strtotime($request['created_at']))
    //             ]);

    //         } */


    //     /* }else{


    //             $model = UserProfile::where("user_id",$request->user_id)->where("cedula",$request->cedula)
    //             ->update([
    //                 'nombres' => !is_null($request->nombres)?$request->nombres:"",
    //                 'apellidos' => !is_null($request->apellidos)?$request->apellidos:"",
    //                 'nacionalidad' => $request->nacionalidad,
    //                 'genero' => $request->genero,
    //                 'fnacimiento' => $request->fnacimiento,
    //                 'telefono_movil' => $request->telefono_movil,
    //                 'firma' => $request->firma,
    //                 'sello' => $request->sello,
    //                 'colegio_medico' => $request->colegio_medico,
    //                 'tipo_sangre' => $request->tipo_sangre,
    //                 'imagen' => $nombre,
    //                 'user_id_medico' => Auth::id(),
    //                 'created_at' => date('Y-m-d H:i:s', strtotime($request['created_at']))
    //             ]);

    //     } */
    //     return response()->json($model); //UserProfile::show($request->user_id);

    // }
    static function store(Request $request)
    {

        //dd($request->all());
        try {


            $existeCedula= UserProfile::getCedula($request->cedula);

            $nombre ="/image/system/patient.svg";
            $file = $request->file('imagen');
            //dd($file);
            if (!is_null($file)) {
                $aleatotio = Str::random(6);
                $nombre = "fp_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                if (file_exists('image/user/foto_perfil/'.$nombre)) {
                    return "imagen existe";
                }
                $file->move('image/user/foto_perfil/', $nombre);
                $nombre ='/image/user/foto_perfil/'. $nombre;

                $public_path = public_path();
                $info = new SplFileInfo($file->getClientOriginalName());
            }/* else{
                if (isset($request->temp_imagen)) {
                    $nombre = $request->temp_imagen;
                }
            } */



            $firma ="/image/system/firma_patientcare_default.png";
            $file = $request->file('firma');
            //dd($file);
            if (!is_null($file)) {
                $aleatotio = Str::random(6);
                $firma = "firma_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                if (file_exists('image/user/firma/'.$firma)) {
                    return "imagen existe";
                }
                $file->move('image/user/firma/', $firma);
                $firma ='/image/user/firma/'. $firma;

                $public_path = public_path();
                $info = new SplFileInfo($file->getClientOriginalName());
            }/* else{
                if (isset($request->temp_firma)) {
                    $firma = $request->temp_firma;
                }
            } */

            $sello ="/image/system/sello_patientcare_default.png";
            $file = $request->file('sello');
            //dd($file);
            if (!is_null($file)) {
                $aleatotio = Str::random(6);
                $sello = "sello_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                if (file_exists('image/user/sello/'.$sello)) {
                    return "imagen existe";
                }
                $file->move('image/user/sello/', $sello);
                $sello ='/image/user/sello/'. $sello;

                $public_path = public_path();
                $info = new SplFileInfo($file->getClientOriginalName());
            }/* else{
                if (isset($request->temp_sello)) {
                    $sello = $request->temp_sello;
                }
            } */
            if (isset($request->temp_imagen) && !is_null($request->temp_imagen) && is_null($request->file('imagen'))) {
                $nombre = $request->temp_imagen;
            }
            if (isset($request->temp_firma) && !is_null($request->temp_firma) && is_null($request->file('firma'))) {
                $firma = $request->temp_firma;
            }
            if (isset($request->temp_sello) && !is_null($request->temp_sello) && is_null($request->file('sello'))) {
                $sello = $request->temp_sello;
            }

            $user = UserProfile::updateOrCreate(
                [
                    "user_id"=>$request->user_id,
                ],
                [
                    'nombres' => !is_null($request->nombres)?$request->nombres:"",
                    'apellidos' => !is_null($request->apellidos)?$request->apellidos:"",
                    'nacionalidad' => $request->nacionalidad,
                    'cedula' => str_replace(",",".", $request->cedula),
                    'genero' => $request->genero,
                    'fnacimiento' => $request->fnacimiento,
                    'telefono_movil' => $request->telefono_movil,
                    'prefijo' => isset($request->prefijo) && $request->prefijo != "undefined" ? $request->prefijo:NULL,
                    'extension_telefonica' => isset($request->extension_telefonica) ? $request->extension_telefonica:NULL,
                    'firma' => $firma,
                    'sello' => $sello,
                    'mpps' => $request->mpps,
                    'colegio_medico' => $request->colegio_medico,
                    'imagen' => $nombre,
                    "user_id"=>$request->user_id,
                    'user_id_medico' => Auth::id(),
                    'created_at' => date('Y-m-d H:i:s', strtotime($request['created_at']))
                ]
                );
            return $user;
        } catch (\Throwable $th) {
            dd($th);
        }
        //return UserProfile::show($request->user_id);

    }
    static function getPacientes()
    {
        return UserProfile::where("user_type.cat_user_type_id",1)
                    ->where("user_cuest_ubicacion.active",1)
                    ->whereNotBetween("user_cuest_ubicacion.cat_user_ubicacion_id",[246,251])
                    ->whereNotNull("user_profile.nombres")
                    ->whereNotNull("user_profile.apellidos")
                    ->whereNotNull("user_profile.fnacimiento")
                    ->whereNotNull("user_profile.genero")
                    ->join('user_type', 'user_profile.user_id', '=', 'user_type.user_id')
                    ->join('user_cuest_ubicacion', 'user_profile.user_id', '=', 'user_cuest_ubicacion.user_id_paciente')
                    ->join('cat_user_ubicacion', 'user_cuest_ubicacion.cat_user_ubicacion_id', '=', 'cat_user_ubicacion.id')

                    ->select(
                        "user_type.user_id as id",
                        "cat_user_ubicacion.description",
                        "cat_user_ubicacion.coments AS ubicacion",
                        "user_profile.user_id",
                        "user_profile.nombres",
                        "user_profile.apellidos",
                        "user_profile.nacionalidad",
                        "user_profile.cedula",
                        "user_profile.genero",
                        "user_profile.fnacimiento",
                        "user_profile.telefono_movil"

                    )
                    ->orderBy("ubicacion","ASC")
                    ->get();
    }
    static function getCedula($cedula)
    {
        return UserProfile::where("cedula",$cedula)->first();
    }
    static function cedulaExiste(Request $request)
    {
        // return $request->cedula;
        $model  = UserProfile::where("cedula",$request->cedula)->first();
        // echo $model;
        if(is_null($model)){
            return Response()->json(false);
        }else{
            return Response()->json("cedula_existe");
        }
    }
    static function show($id)
    {
        return Response()->json(DB::table('user_profile')
        ->where("user_id",$id)
        ->first());
    }
    //UPDATE USER GENERAL
    static function update_item(Request $request){

        $model = [];

        if ($request->field=="cedula") {
            $model  = UserProfile::where( $request->field , $request->value )->first();
            if(!is_null($model)){
                return Response()->json("cedula_existe");
            }
        }
        if (
            in_array(
                $request->field,
                [
                    "especialidad_id",
                    "nombres",
                    "apellidos",
                    "nacionalidad",
                    "cedula",
                    "genero",
                    "imagen",
                    "prefijo",
                    "firma",
                    "sello",
                    "colegio_medico",
                    "mpps",
                    "tipo_sangre",
                    "fnacimiento",
                    "user_id_medico",
                    "tipo_sangre",
                    "telefono_movil"
                ]
            )
        ) {
            $model = UserProfile::updateOrCreate(
                ["user_id" => $request->user_id],
                [
                    $request->field => $request->value
                ]
            );

           $model = User::getUser($request->user_id);
        }

        return $model;

    }
    static function update_item_file(Request $request){
        //dd($request);
        $nombre ="/image/system/patient.svg";
        $file = $request->file( "value" );
        $field = $request->field;
        if (!is_null($file)) {

            $aleatotio = Str::random(6);
            if ($field=="imagen") {
                $nombre = "fp_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                if (file_exists('image/user/foto_perfil/'.$nombre)) {
                    return "imagen existe";
                }
                $file->move('image/user/foto_perfil/', $nombre);
                $nombre ='/image/user/foto_perfil/'. $nombre;
            }
            if ($field=="firma") {
                $nombre = "firma_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                if (file_exists('image/user/firma/'.$nombre)) {
                    return "imagen existe";
                }
                $file->move('image/user/firma/', $nombre);
                $nombre ='/image/user/firma/'. $nombre;
            }
            if ($field=="sello") {
                $nombre = "sello_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                if (file_exists('image/user/sello/'.$nombre)) {
                    return "imagen existe";
                }
                $file->move('image/user/sello/', $nombre);
                $nombre ='/image/user/sello/'. $nombre;
            }


            $public_path = public_path();
            $info = new SplFileInfo($file->getClientOriginalName());
        }


        $model = UserProfile::updateOrCreate(
            ["user_id" => $request->user_id],
            [
                $field => $nombre
            ]
        );




        return $model;

    }
    static function actualizar(Request $request){

        $nombre ="/image/system/patient.svg";
        //dd($request->all());
        $file = $request->file('imagen');
        //dd($request->all());
        if($request->imagen != "undefined"){
            if (!is_null($file)) {
                $aleatotio = Str::random(6);
                $nombre = "fp_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                if (file_exists('image/user/foto_perfil/'.$nombre)) {
                    return "imagen existe";
                }
                $file->move('image/user/foto_perfil/', $nombre);
                $nombre ='/image/user/foto_perfil/'. $nombre;

                $public_path = public_path();
                $info = new SplFileInfo($file->getClientOriginalName());
            }
        }else{

                $nombre = $request->temp_imagen;

        }

        if($request->firma != "undefined"){
            $firma ="image/system/firma_patientcare_default.png";
            $file = $request->file('firma');
            //dd($file);
            if (!is_null($file)) {
                $aleatotio = Str::random(6);
                $firma = "firma_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                if (file_exists('image/user/firma/'.$firma)) {
                    return "imagen existe";
                }
                $file->move('image/user/firma/', $firma);
                $firma ='image/user/firma/'. $firma;

                $public_path = public_path();
                $info = new SplFileInfo($file->getClientOriginalName());
            }
        }else{
            $firma = $request->temp_firma;
        }

        if ($request->sello != "undefined") {
            $sello ="image/system/sello_patientcare_default.png";
            $file = $request->file('sello');
            //dd($request->all());
            if (!is_null($file)) {
                $aleatotio = Str::random(6);
                $sello = "sello_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                if (file_exists('image/user/sello/'.$sello)) {
                    return "imagen existe";
                }
                $file->move('image/user/sello/', $sello);
                $sello ='image/user/sello/'. $sello;

                $public_path = public_path();
                $info = new SplFileInfo($file->getClientOriginalName());
            }
        }else{
            $sello = $request->temp_sello;
        }

        $model = UserProfile::where("user_id",$request->user_id)
        ->update([
            'nacionalidad' => !is_null($request->nacionalidad)?$request->nacionalidad:"",
            'cedula' => !is_null($request->cedula)?$request->cedula:"",
            'nombres' => !is_null($request->nombres)?$request->nombres:"",
            'apellidos' => !is_null($request->apellidos)?$request->apellidos:"",
            'genero' => $request->genero,
            'fnacimiento' => $request->fnacimiento,
            'telefono_movil' => $request->telefono_movil,
            'prefijo' => isset($request->prefijo) && !empty($request->prefijo) && !is_null($request->prefijo)?$request->prefijo:NULL,
            'imagen' => $nombre,
            'extension_telefonica' => isset($request->extension_telefonica) ? $request->extension_telefonica:NULL,
            'firma' => $firma,
            'sello' => $sello,
            'mpps' => $request->mpps,
            'colegio_medico' => $request->colegio_medico,
            'user_id_medico' => Auth::id(),
            'updated_at' => date('Y-m-d H:i:s', strtotime($request['updated_at']))
        ]);
        if (isset($request->prefijo) && Auth::id() ==$request->user_id) {

            session(['userData.prefijo'=>$request->prefijo]);


        }
        return UserProfile::show($request->user_id);
    }
    //relationships
    public function user()
    {
        /*
            Obtener todos los roles del usuario
        */
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
