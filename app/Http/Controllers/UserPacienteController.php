<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\UserPaciente;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserType;
use App\Models\UserProfileImages;
use App\Models\UserCuestDireccion;
use App\Models\TarjetaSoyChacao;
use App\Models\UserFamily;
use App\Models\UserCuestEpisodio;
use App\Models\UserCuestUbicacion;
use App\Models\UserMedicoPosicion;
use App\Models\UserEquipoSalud;
use App\Models\UserEspecialidad;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use SplFileInfo;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class UserPacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("paciente.index");
    }
    public function recortarimagen(Request $request)
    {

        // Obtén la imagen en formato base64 desde la solicitud HTTP
        $imagenBase64 = $_POST['imagenBase64'];
        $nombreImagen = $_POST['nombreImagen'];

        // Decodifica la imagen base64
        $imagenDecodificada = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagenBase64));
        // Ruta donde deseas guardar la imagen
        $rutaImagen = 'image/user/foto_perfil/';

        // Guarda la imagen decodificada en un archivo .jpg en el servidor
        Storage::put("temporalimagenrecortada.jpg", $imagenDecodificada);
        // Obtener el contenido del archivo del almacenamiento
        $contenidoArchivo = Storage::get("temporalimagenrecortada.jpg");
        // Ruta de destino en la carpeta pública
        $rutaDestinoPublico = public_path(ltrim($nombreImagen, '/'));
        echo $rutaDestinoPublico;
        // Mover el archivo a la carpeta pública
        file_put_contents($rutaDestinoPublico, $contenidoArchivo);
        Storage::delete("temporalimagenrecortada.jpg");

        // Devuelve una respuesta al cliente si es necesario
        //echo "Imagen guardada correctamente en $rutaImagen";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("paciente.create");
    }
    public function create2()
    {
        return view("paciente.create2");
    }

    public function create3()
    {
        return view("nv.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if(session('cat_user_type_id') == 2){
            $request->merge(['user_id' =>User::store($request,1)]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return UserProfile::show($request->user_id);
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
    public function solicitarservicio(Request $request)
    {
        # code...
    }
    public function pendiente(Request $request)
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        return view("paciente.pendiente");
    }

    public function getHistorial(Request $request)
    {

        $model =
            DB::select(
            "



                #UNION ALL
                    SELECT
                        user_cuest_imp_diagn.id,
                        cat_user_cuestionario.description,
                        user_cuest_imp_diagn.created_at,
                        user_cuest_imp_diagn.value,
                        user_cuest_imp_diagn.coments,
                        CONCAT(
                            tbl_medico.nombres,
                            ' ',
                            tbl_medico.apellidos
                        ) AS medico,
                        CONCAT(
                            tbl_paciente.nombres,
                            ' ',
                            tbl_paciente.apellidos
                        ) AS paciente

                    FROM user_cuest_imp_diagn
                    INNER JOIN user_profile AS tbl_medico ON  user_cuest_imp_diagn.user_id_medico = tbl_medico.user_id
                    INNER JOIN user_profile AS tbl_paciente ON  user_cuest_imp_diagn.user_id = tbl_paciente.user_id
                    INNER JOIN cat_user_cuestionario ON  user_cuest_imp_diagn.cat_user_cuestionario_id = cat_user_cuestionario.id
                    WHERE user_cuest_imp_diagn.user_id = ".$request->user_id."
                UNION ALL
                    SELECT
                        user_cuest_evolucion.id,
                        cat_user_cuestionario.description,
                        user_cuest_evolucion.created_at,
                        user_cuest_evolucion.value,
                        user_cuest_evolucion.coments,
                        CONCAT(
                            tbl_medico.nombres,
                            ' ',
                            tbl_medico.apellidos
                        ) AS medico,
                        CONCAT(
                            tbl_paciente.nombres,
                            ' ',
                            tbl_paciente.apellidos
                        ) AS paciente

                    FROM user_cuest_evolucion
                    INNER JOIN user_profile AS tbl_medico ON  user_cuest_evolucion.user_id_medico = tbl_medico.user_id
                    INNER JOIN user_profile AS tbl_paciente ON  user_cuest_evolucion.user_id = tbl_paciente.user_id
                    INNER JOIN cat_user_cuestionario ON  user_cuest_evolucion.cat_user_cuestionario_id = cat_user_cuestionario.id
                    WHERE user_cuest_evolucion.user_id = ".$request->user_id."
                UNION ALL
                    SELECT
                        user_cuest_plan.id,
                        cat_user_cuestionario.description,
                        user_cuest_plan.created_at,
                        user_cuest_plan.value,
                        user_cuest_plan.coments,
                        CONCAT(
                            tbl_medico.nombres,
                            ' ',
                            tbl_medico.apellidos
                        ) AS medico,
                        CONCAT(
                            tbl_paciente.nombres,
                            ' ',
                            tbl_paciente.apellidos
                        ) AS paciente

                    FROM user_cuest_plan
                    INNER JOIN user_profile AS tbl_medico ON  user_cuest_plan.user_id_medico = tbl_medico.user_id
                    INNER JOIN user_profile AS tbl_paciente ON  user_cuest_plan.user_id = tbl_paciente.user_id
                    INNER JOIN cat_user_cuestionario ON  user_cuest_plan.cat_user_cuestionario_id = cat_user_cuestionario.id
                    WHERE user_cuest_plan.user_id = ".$request->user_id."
                UNION ALL
                    SELECT
                        user_cuest_observacion.id,
                        cat_user_cuestionario.description,
                        user_cuest_observacion.created_at,
                        user_cuest_observacion.value,
                        user_cuest_observacion.coments,
                        CONCAT(
                            tbl_medico.nombres,
                            ' ',
                            tbl_medico.apellidos
                        ) AS medico,
                        CONCAT(
                            tbl_paciente.nombres,
                            ' ',
                            tbl_paciente.apellidos
                        ) AS paciente

                    FROM user_cuest_observacion
                    INNER JOIN user_profile AS tbl_medico ON  user_cuest_observacion.user_id_medico = tbl_medico.user_id
                    INNER JOIN user_profile AS tbl_paciente ON  user_cuest_observacion.user_id = tbl_paciente.user_id
                    INNER JOIN cat_user_cuestionario ON  user_cuest_observacion.cat_user_cuestionario_id = cat_user_cuestionario.id
                    WHERE user_cuest_observacion.user_id = ".$request->user_id."
                UNION ALL
                    SELECT
                        user_cuest_recipe.id,
                        cat_user_cuestionario.description,
                        user_cuest_recipe.created_at,
                        user_cuest_recipe.value,
                        user_cuest_recipe.coments,
                        CONCAT(
                            tbl_medico.nombres,
                            ' ',
                            tbl_medico.apellidos
                        ) AS medico,
                        CONCAT(
                            tbl_paciente.nombres,
                            ' ',
                            tbl_paciente.apellidos
                        ) AS paciente

                    FROM user_cuest_recipe
                    INNER JOIN user_profile AS tbl_medico ON  user_cuest_recipe.user_id_medico = tbl_medico.user_id
                    INNER JOIN user_profile AS tbl_paciente ON  user_cuest_recipe.user_id = tbl_paciente.user_id
                    INNER JOIN cat_user_cuestionario ON  user_cuest_recipe.cat_user_cuestionario_id = cat_user_cuestionario.id
                    WHERE user_cuest_recipe.user_id = ".$request->user_id."
                UNION ALL
                    SELECT
                        user_cuest_estudio.id,
                        cat_user_cuestionario.description,
                        user_cuest_estudio.created_at,
                        user_cuest_estudio.value,
                        user_cuest_estudio.coments,
                        CONCAT(
                            tbl_medico.nombres,
                            ' ',
                            tbl_medico.apellidos
                        ) AS medico,
                        CONCAT(
                            tbl_paciente.nombres,
                            ' ',
                            tbl_paciente.apellidos
                        ) AS paciente

                    FROM user_cuest_estudio
                    INNER JOIN user_profile AS tbl_medico ON  user_cuest_estudio.user_id_medico = tbl_medico.user_id
                    INNER JOIN user_profile AS tbl_paciente ON  user_cuest_estudio.user_id = tbl_paciente.user_id
                    INNER JOIN cat_user_cuestionario ON  user_cuest_estudio.cat_user_cuestionario_id = cat_user_cuestionario.id
                    WHERE user_cuest_estudio.user_id = ".$request->user_id."
                UNION ALL
                    SELECT
                        user_cuest_laboratorio.id,
                        cat_user_cuestionario.description,
                        user_cuest_laboratorio.created_at,
                        user_cuest_laboratorio.value,
                        user_cuest_laboratorio.coments,
                        CONCAT(
                            tbl_medico.nombres,
                            ' ',
                            tbl_medico.apellidos
                        ) AS medico,
                        CONCAT(
                            tbl_paciente.nombres,
                            ' ',
                            tbl_paciente.apellidos
                        ) AS paciente

                    FROM user_cuest_laboratorio
                    INNER JOIN user_profile AS tbl_medico ON  user_cuest_laboratorio.user_id_medico = tbl_medico.user_id
                    INNER JOIN user_profile AS tbl_paciente ON  user_cuest_laboratorio.user_id = tbl_paciente.user_id
                    INNER JOIN cat_user_cuestionario ON  user_cuest_laboratorio.cat_user_cuestionario_id = cat_user_cuestionario.id
                    WHERE user_cuest_laboratorio.user_id = ".$request->user_id."
                UNION ALL
                    SELECT
                        user_cuest_fotografia.id,
                        cat_user_cuestionario.description,
                        user_cuest_fotografia.created_at,
                        user_cuest_fotografia.value,
                        user_cuest_fotografia.coments,
                        CONCAT(
                            tbl_medico.nombres,
                            ' ',
                            tbl_medico.apellidos
                        ) AS medico,
                        CONCAT(
                            tbl_paciente.nombres,
                            ' ',
                            tbl_paciente.apellidos
                        ) AS paciente

                    FROM user_cuest_fotografia
                    INNER JOIN user_profile AS tbl_medico ON  user_cuest_fotografia.user_id_medico = tbl_medico.user_id
                    INNER JOIN user_profile AS tbl_paciente ON  user_cuest_fotografia.user_id = tbl_paciente.user_id
                    INNER JOIN cat_user_cuestionario ON  user_cuest_fotografia.cat_user_cuestionario_id = cat_user_cuestionario.id
                    WHERE user_cuest_fotografia.user_id = ".$request->user_id."
                UNION ALL
                    SELECT
                        user_cuest_otro_archivo.id,
                        cat_user_cuestionario.description,
                        user_cuest_otro_archivo.created_at,
                        user_cuest_otro_archivo.value,
                        user_cuest_otro_archivo.coments,
                        CONCAT(
                            tbl_medico.nombres,
                            ' ',
                            tbl_medico.apellidos
                        ) AS medico,
                        CONCAT(
                            tbl_paciente.nombres,
                            ' ',
                            tbl_paciente.apellidos
                        ) AS paciente

                    FROM user_cuest_otro_archivo
                    INNER JOIN user_profile AS tbl_medico ON  user_cuest_otro_archivo.user_id_medico = tbl_medico.user_id
                    INNER JOIN user_profile AS tbl_paciente ON  user_cuest_otro_archivo.user_id = tbl_paciente.user_id
                    INNER JOIN cat_user_cuestionario ON  user_cuest_otro_archivo.cat_user_cuestionario_id = cat_user_cuestionario.id
                    WHERE user_cuest_otro_archivo.user_id = ".$request->user_id."

                ORDER BY created_at DESC

            ",
            [1]);

        return $model;
    }

    public function getDataPaciente($user_id_paciente)
    {
        $model = DB::select("
            SELECT
                user.id,
                user.email,
                user.email_alternativo,
                user_profile.nacionalidad,
                user_profile.cedula,
                user_profile.telefono_movil,
                user_profile.imagen,
                user_profile.nombres,
                user_profile.apellidos,
                user_profile.genero,
                user_profile.fnacimiento,
                user_profile.telefono_movil,
                user_profile.telefono_hogar,
                (
                    SELECT GROUP_CONCAT(cat_user_type_id)
                    FROM user_type
                    WHERE user_type.user_id = user.id
                ) AS cat_user_type_id,
                user_cuest_direction.cat_estado_id,
                user_cuest_direction.cat_municipio_id,
                user_cuest_direction.description,
                user_cuest_direction.domicilio
            FROM user
            LEFT JOIN user_profile ON user.id = user_profile.user_id
            LEFT JOIN user_cuest_direction ON user.id = user_cuest_direction.user_id
            LEFT JOIN user_type ON user_profile.user_id = user_type.user_id
            WHERE user_profile.nombres IS NOT NULL
            AND user_profile.apellidos IS NOT NULL
            AND user_profile.fnacimiento IS NOT NULL
            AND user_profile.genero IS NOT NULL
            AND user.id = ".$user_id_paciente."
            LIMIT 1
        ", [1]);

        if (count($model) > 0) {
            return Response()->json( $model[0]);
        }else{
            return Response()->json( []);
        }

    }




    public function getInfoPaciente(Request $request)
    {
        return UserPaciente::getInfoPaciente($request->user_id);

    }
    public function update(Request $request)
    {
        //dd($request->all());
        $response = [

        ];
        //1 USER
            $existeCorreo = User::where("email",$request->email)->first();
            if( is_null($existeCorreo) ){
                $model = User::where("id",$request->user_id_paciente);

                $model = $model->update([
                    'email'        => $request->email,
                ]);
                $model = User::where("id",$request->user_id_paciente);
                $response['email']= $model->value('email');
            }else{
                $response['email']= $request->email;
            }

        //2 USER_TYPE
        //3 USER_PROFILE
            $file = $request->file('new_imagen');
            if($request->new_imagen != "undefined"){
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
                    $model = UserProfile::where("user_id",$request->user_id_paciente);
                    $model = $model->update([
                        'imagen'         => $nombre,
                    ]);
                    $model = UserProfile::where("user_id",$request->user_id_paciente);
                    $response['new_imagen']= $model->value('imagen');
                }else{}
            }else{
                $nombre = $request->temp_imagen;
                $response['new_imagen']= $nombre;
            }

            $existeCedula = UserProfile::where("cedula",$request->cedula)->first();
            $model = UserProfile::where("user_id",$request->user_id_paciente);
            if(is_null($existeCedula)){
                $model = $model->update([
                    'nombres'        => !is_null($request->nombres)?$request->nombres:"",
                    'apellidos'      => !is_null($request->apellidos)?$request->apellidos:"",
                    'cedula'      => !is_null($request->cedula)?$request->cedula:"",
                    'nacionalidad'   => $request->nacionalidad,
                    'genero'         => $request->genero,
                    'genero'         => $request->genero,
                    'fnacimiento'    => $request->fnacimiento,
                    'telefono_movil' => $request->telefono_movil,
                    'telefono_hogar' => $request->telefono_hogar,
                    //'imagen'         => $nombre,

                ]);
            }else{
                $model = $model->update([
                    'nombres'        => !is_null($request->nombres)?$request->nombres:"",
                    'apellidos'      => !is_null($request->apellidos)?$request->apellidos:"",
                    'nacionalidad'   => $request->nacionalidad,
                    'genero'         => $request->genero,
                    'genero'         => $request->genero,
                    'fnacimiento'    => $request->fnacimiento,
                    'telefono_movil' => $request->telefono_movil,
                    'telefono_hogar' => $request->telefono_hogar,
                    //'imagen'         => $nombre,

                ]);
            }



        //4 USER_IMAGES_FILES

        //5 USER_DIRECCION
            $model = UserCuestDireccion::updateOrCreate(
                [
                    'user_id' => $request->user_id_paciente
                ],
                [
                    'cat_estado_id'    => isset($request->cat_estado_id)?$request->cat_estado_id:null,
                    'cat_municipio_id' => isset($request->cat_municipio_id)?$request->cat_municipio_id:null,
                    'description'      => isset($request->description)?$request->description:null,
                    'domicilio'        => isset($request->domicilio)?$request->domicilio:null,
                    'user_id'          => isset($request->user_id_paciente)?$request->user_id_paciente:null,
                ]
            );
            return Response()->json(['success'=>true,'data'=>$response]);
    }
    public function storePaciente(Request $request)
    {
        //dd($request->all());
        $resultSet = [];
        try {

            DB::beginTransaction();
                //1 USER
                   /*  $model = User::firstOrCreate(
                        ['email' => is_null($request->email) ? $request->cedula."@correotemporal.com" : $request->email ],
                        [
                            'email'          => is_null($request->email) ? $request->cedula."@correotemporal.com" : $request->email,
                            'password'       => isset( $request->password ) ? $request->password : "123456",
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );

                    $user_id = $model->id;
                    $request->merge(["user_id_paciente"=>$user_id]);
                    $request->merge(["user_id"=>$user_id]);
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    } */


                    //VERIFICAR SI LA CEDULA EXISTE
                    $user_id =NULL;
                    $email = NULL;
                    $existe_cedula =    UserProfile::where("cedula",$request->cedula)
                                        ->leftJoin("user", "user_profile.user_id", "user.id")
                                        ->select("user.email","user_profile.user_id")
                                        ->orderBy("user_profile.user_id","DESC")->get()->take(1)->toArray();
                    if ( !empty($existe_cedula) ) {
                        $user_id = $existe_cedula[0]['user_id'];
                        $email =  $existe_cedula[0]['email'];
                    }
                    if ($email != $request->email) {
                        $email = $request->email;
                    }
                    $existe_email = User::where("email",$request->email)->first();
                    if (is_null($existe_email)) {
                        $email = $request->email;

                    }else{
                        $user_id = $existe_email->id;
                        $email = $request->cedula."@correotemporal.com";
                    }
                    //dd($existe_cedula);

                    //-----------
                //1 USER
                    if ( !empty($existe_cedula) ) {
                        $email =  $existe_cedula[0]['email'];
                        if ($existe_cedula[0]['email']!= $request->email) {
                            $email = $request->email;
                        }
                        $model = User::firstOrCreate(
                            ['id' => $user_id],
                            [
                                'email'          => $email,
                                'email_alternativo'          => $request->email_alternativo,
                                'password'       => isset( $request->password ) ? $request->password : "123456",
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );
                        $user_id = $model->id;
                    }else{
                        $model = User::firstOrCreate(
                            ['email' => $email],
                            [
                                'email'          => $email,
                                'email_alternativo'          => $request->email_alternativo,
                                'password'       => isset( $request->password ) ? $request->password : "123456",
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );
                        $user_id = $model->id;
                    }
                    $request->merge(["user_id_paciente"=>$user_id]);
                    $request->merge(["user_id"=>$user_id]);
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //2 USER_TYPE
                    $model = UserType::updateOrCreate(
                        [
                        'user_id'   => $user_id,
                        ],
                        [
                            'user_id'          => $user_id,
                            'cat_user_type_id' => 1,
                            'user_id_medico'   => Auth::id(),
                            "created_at"       => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //3 USER_PROFILE
                    $nombre ="/image/system/patient.svg";
                    $file = $request->file('imagen');
                    if (!is_null($file)) {
                        $aleatotio = Str::random(6);
                        $ruta = 'image/user/foto_perfil/';
                        $nombre = "fp_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                        $extension = $file->getClientOriginalExtension();

                        if (!file_exists($ruta.$nombre)) {
                            //dd($nombre);
                            $file->move($ruta , $nombre);
                            $nombre ='/'. $ruta . $nombre;
                        }
                    }
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



                    $existe_cedula =    UserProfile::where("cedula",$request->cedula)->first() ;
                    //dd($existe_cedula);
                    if ( !is_null($existe_cedula) ) {
                        $model = UserProfile::where("cedula",$request->cedula)
                        ->update([
                            'nombres'        => !is_null($request->nombres)?$request->nombres:"",
                            'apellidos'      => !is_null($request->apellidos)?$request->apellidos:"",
                            'nacionalidad'   => $request->nacionalidad,

                            'genero'         => $request->genero,
                            'fnacimiento'    => $request->fnacimiento,
                            'telefono_movil' => $request->telefono_movil,
                            'imagen'         => $nombre,
                            'firma'         => $firma,
                            'sello'         => $sello
                        ]);
                        if ($existe_cedula->exists) {
                            $resultSet[ $existe_cedula->getTable() ] = $existe_cedula->toArray();
                        }

                    }else{
                        $model = UserProfile::create(
                            [
                                'nombres'        => !is_null($request->nombres)?$request->nombres:"",
                                'apellidos'      => !is_null($request->apellidos)?$request->apellidos:"",
                                'nacionalidad'   => $request->nacionalidad,
                                'cedula'         => $request->cedula,
                                'genero'         => $request->genero,
                                'fnacimiento'    => $request->fnacimiento,
                                'telefono_movil' => $request->telefono_movil,
                                'imagen'         => $nombre,
                                "user_id"        => $request->user_id,
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );
                        if ($model->exists) {
                            $resultSet[ $model->getTable() ] = $model->toArray();
                        }

                    }




                //4 USER_IMAGES_FILES
                    $imagenesDefault = [
                        "partidaNacimiento" =>"/image/system/fnacimiento.svg",
                        "imgSoyChacao" =>"/image/system/card.svg",
                        "imgDocIdentidad" =>"/image/system/card.svg",
                    ];

                    foreach ($request->file() as $key => $file) {
                        $nombre    = null;
                        $extension = null;
                        if ($key != "imagen") {
                            if (!is_null($file)) {

                                if (
                                    $key == "partidaNacimiento" ||
                                    $key == "imgSoyChacao" ||
                                    $key == "imgDocIdentidad"
                                ) {
                                    $nombre = $imagenesDefault [ $key ];
                                    $aleatotio = Str::random(6);
                                    $ruta = 'image/user/userProfileImage/';
                                    $nombre = "upi_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                                    $extension = $file->getClientOriginalExtension();
                                    if (!file_exists($ruta.$nombre)) {
                                        $file->move($ruta , $nombre);
                                        $nombre ='/'. $ruta . $nombre;
                                    }

                                    $model = UserProfileImages::updateOrCreate(
                                        [
                                            'user_id_paciente'   => $request->user_id,
                                            'coments'     => $key,
                                        ],
                                        [
                                            'value'     => $nombre,
                                            'user_id_paciente'     => $request->user_id,
                                            'file_type'     => $extension,
                                            'coments'     => $key,
                                            'user_id_medico'     => Auth::id(),
                                            'created_at'     => date('Y-m-d H:i:s', strtotime($request['created_at']) ),
                                        ]
                                    );
                                    if ($model->exists) {
                                        $resultSet[ $model->getTable() ."_". $key ] = $model->toArray();
                                    }





                                }
                            }
                        }
                    }

                //5 USER_DIRECCION
                    $model = UserCuestDireccion::updateOrCreate(
                        [
                            'user_id' => $request->user_id
                        ],
                        [
                            'cat_estado_id'    => isset($request->cat_estado_id)?$request->cat_estado_id:null,
                            'cat_municipio_id' => isset($request->cat_municipio_id)?$request->cat_municipio_id:null,
                            'description'      => isset($request->description)?$request->description:null,
                            'domicilio'        => isset($request->domicilio)?$request->domicilio:null,
                            'user_id'          => isset($request->user_id)?$request->user_id:null,
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //6 TARJETA SOYCHACAO
                    $model = TarjetaSoyChacao::updateOrCreate(
                        [
                        'user_id_paciente'   => $user_id,
                        ],
                        [
                            'description'   =>  isset($request->tarjeta_soy_chacao)?$request->tarjeta_soy_chacao:NULL ,
                            'user_id_paciente'   => $user_id,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //7 REGISTRO FAMILIAR
                    $model = UserFamily::updateOrCreate(
                        [
                            'cedula'   => $request->cedula_familiar,
                            'user_id'   => $user_id
                        ],
                        [
                            'email'   => $request->email_familiar,
                            'nombres'   => $request->nombres_familiar,
                            'apellidos'   => $request->apellidos_familiar,
                            'cedula'   => $request->cedula_familiar,
                            'genero'   => $request->genero_familiar,
                            'cat_user_family_id'   => $request->cat_user_family_id,
                            'telefono_movil'   => $request->telefono_movil_familiar,
                            'user_id'   => $user_id,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }
                    /* if (isset($request->registro_familiar) && $request->registro_familiar) {
                        $model = UserFamily::updateOrCreate(
                            [
                                'user_id_paciente'   => $request->user_id_pariente,
                                'user_id_pariente'   => $user_id
                            ],
                            [
                                'user_id_paciente'   => $request->user_id_pariente,
                                'user_id_pariente'   => $user_id,
                                'cat_user_family_id'   => $request->cat_user_family_id_pariente,
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );
                        $model = UserFamily::updateOrCreate(
                            [
                                'user_id_paciente'   => $user_id,
                                'user_id_pariente'   => $request->user_id_pariente
                            ],
                            [
                                'user_id_paciente'   => $user_id,
                                'user_id_pariente'   => $request->user_id_pariente,
                                'cat_user_family_id'   => $request->cat_user_family_id,
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );


                    } */

                //8 EPISODIO
                    $model =  UserCuestEpisodio::firstOrCreate(
                        [
                            'user_id'=> $request->user_id,
                            'egreso' =>  NULL,
                            'active' =>  1,
                        ],
                        [
                            'user_id'=> $request->user_id,
                            'user_id_medico' => Auth::id(),
                            "ingreso"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) ),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //9 UBICACIÓN EN AREA
                    UserCuestUbicacion::where("user_cuest_episodio_id",$model->id)
                    ->where("user_id_paciente",$request->user_id)
                    #->where("id","!=",$model->id)
                    ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

                    $model =  UserCuestUbicacion::firstOrCreate(
                        [
                            'user_cuest_episodio_id'=> $model->id,
                            'user_id_paciente' =>  $request->user_id,
                            'active' =>  1,
                            'cat_user_ubicacion_id'=> isset($request->cat_user_ubicacion_id) ? $request->cat_user_ubicacion_id : 245,

                        ],
                        [
                            'cat_user_ubicacion_id'=> isset($request->cat_user_ubicacion_id) ? $request->cat_user_ubicacion_id : 245,
                            'user_cuest_episodio_id'   => $model->id,
                            'value'=> isset($request->value) ? $request->value : NULL,
                            'user_id_paciente'=> $request->user_id,
                            'value'=> "Ingreso",
                            'active' =>  1,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }
                    
                //10 MEDICO POSICION

                    $model =  UserMedicoPosicion::firstOrCreate(
                        [
                            'user_id' =>  $request->user_id,
                            'active' =>  1,
                            'cat_user_medico_posicion_id'=> isset($request->cat_user_medico_posicion_id) ? $request->cat_user_medico_posicion_id : 23,

                        ],
                        [
                            'user_id' =>  $request->user_id,
                            'active' =>  1,
                            'cat_user_medico_posicion_id'=> isset($request->cat_user_medico_posicion_id) ? $request->cat_user_medico_posicion_id : 23,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }
                //11 MEDICO ESPECIALIDAD

                    $model =  UserEspecialidad::firstOrCreate(
                        [
                            'user_id' =>  $request->user_id,
                            'cat_user_especialidad_id'=> isset($request->cat_user_especialidad_id ) ? $request->cat_user_especialidad_id  : 67,

                        ],
                        [
                            'user_id' =>  $request->user_id,
                            'cat_user_especialidad_id'=> isset($request->cat_user_especialidad_id) ? $request->cat_user_especialidad_id : 67,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }
                //12 EQUIPO SALUD

                    $model =  UserEquipoSalud::firstOrCreate(
                        [
                            'user_id' =>  $request->user_id,
                            'cat_user_equipo_salud_id'=> isset($request->cat_user_equipo_salud_id ) ? $request->cat_user_equipo_salud_id  : 11,

                        ],
                        [
                            'user_id' =>  $request->user_id,
                            'cat_user_equipo_salud_id'=> isset($request->cat_user_equipo_salud_id) ? $request->cat_user_equipo_salud_id : 11,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }





            DB::commit();
                    
            $resultSet[ "success" ] = true;
            //ENVIAR EMAIL DE REGISTRO
            /* if ($resultSet[ "success" ]) {
                if ( config("app.APP_SEND_EMAILS") ) {
                    $model['case']=1;
                    $model['email']=$request->email;
                    $model['password']=$request->password;

                    $model['logo'] = config('app.url')."/image/system/".config('app.APP_LOGO_VERSION_REPORTS_COLOR') ;
                    $model['subject']= "Bienvenido al sistema.";

                    if ( config("app.APP_TEST_MODE") ) {
                        $team_test = explode(",",config("app.APP_ADDRESS_TEAM_TEST"));
                        $model['emails'] = $team_test;
                    }else{
                        $model['emails'] = $request->email;
                    }


                    Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                        foreach ($model['emails'] as $key => $correo) {
                            $message->to( $correo )
                            ->subject($model['subject']);
                        }
                    });
                }
            } */
            return Response()->json($resultSet);
        } catch (\Throwable $th) {

            DB::rollBack();
            $resultSet = [];
            $resultSet[ "success" ] = false;
            $resultSet[ "message" ] = $th;
            return Response()->json($resultSet);
        }

        //return Response()->json(true);
    }
    public function consultaExternaStore(Request $request)
    {
        $resultSet = [];
        try {

            DB::beginTransaction();
                //1 USER
                   /*  $model = User::firstOrCreate(
                        ['email' => is_null($request->email) ? $request->cedula."@correotemporal.com" : $request->email ],
                        [
                            'email'          => is_null($request->email) ? $request->cedula."@correotemporal.com" : $request->email,
                            'password'       => isset( $request->password ) ? $request->password : "123456",
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );

                    $user_id = $model->id;
                    $request->merge(["user_id_paciente"=>$user_id]);
                    $request->merge(["user_id"=>$user_id]);
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    } */


                    //VERIFICAR SI LA CEDULA EXISTE
                    $user_id =NULL;
                    $email = NULL;
                    $existe_cedula =    UserProfile::where("cedula",$request->cedula)
                                        ->leftJoin("user", "user_profile.user_id", "user.id")
                                        ->select("user.email","user_profile.user_id")
                                        ->orderBy("user_profile.user_id","DESC")->get()->take(1)->toArray();
                    if ( !empty($existe_cedula) ) {
                        $user_id = $existe_cedula[0]['user_id'];
                        $email =  $existe_cedula[0]['email'];
                    }
                    if ($email != $request->email) {
                        $email = $request->email;
                    }
                    $existe_email = User::where("email",$request->email)->first();
                    if (is_null($existe_email)) {
                        $email = $request->email;

                    }else{
                        $user_id = $existe_email->id;
                        $email = $request->cedula."@correotemporal.com";
                    }
                    // dd($existe_cedula);

                    //-----------
                    if ( !empty($existe_cedula) ) {
                        $email =  $existe_cedula[0]['email'];
                        if ($existe_cedula[0]['email']!= $request->email) {
                            $email = $request->email;
                        }
                        $model = User::firstOrCreate(
                            ['id' => $user_id],
                            [
                                'email'          => $email,
                                'password'       => isset( $request->password ) ? $request->password : "123456",
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );
                        $user_id = $model->id;

                    }else{
                        $model = User::firstOrCreate(
                            ['email' => $email],
                            [
                                'email'          => $email,
                                'password'       => isset( $request->password ) ? $request->password : "123456",
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );
                        $user_id = $model->id;
                    }
                    $request->merge(["user_id_paciente"=>$user_id]);
                    $request->merge(["user_id"=>$user_id]);
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //2 USER_TYPE
                    $model = UserType::updateOrCreate(
                        [
                        'user_id'   => $user_id,
                        ],
                        [
                            'user_id'          => $user_id,
                            'cat_user_type_id' => 1,
                            'user_id_medico'   => Auth::id(),
                            "created_at"       => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //3 USER_PROFILE
                    // $nombre ="/image/system/patient.svg";
                    $file = $request->file('imagen');

                    if (!is_null($file)) {
                        $aleatotio = Str::random(6);
                        $ruta = 'image/user/foto_perfil/';
                        $nombre = "fp_p".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                        $extension = $file->getClientOriginalExtension();
                        if (!file_exists($ruta.$nombre)) {
                            $file->move($ruta , $nombre);
                            $nombre ='/'. $ruta . $nombre;
                        }
                    }
                    $model = UserProfile::where('user_id',$request->user_id)->first();
                    if (is_null($model)){
                        $isNewUser = true;
                        $model = UserProfile::create(
                            [
                                'nombres'        => !is_null($request->nombres)?$request->nombres:"",
                                'apellidos'      => !is_null($request->apellidos)?$request->apellidos:"",
                                'nacionalidad'   => $request->nacionalidad,
                                'cedula'         => $request->cedula,
                                'genero'         => $request->genero,
                                'fnacimiento'    => $request->fnacimiento,
                                'telefono_movil' => $request->telefono_movil,
                                'imagen'         => !is_null($file)?$nombre:"/image/system/patient.svg",
                                "user_id"        => $request->user_id,
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                            );
                    }else{
                        $isNewUser = false;
                        $model->nombres = !is_null($request->nombres)?$request->nombres:"";
                        $model->apellidos = !is_null($request->apellidos)?$request->apellidos:"";
                        $model->nacionalidad = $request->nacionalidad;
                        $model->cedula = $request->cedula;
                        $model->genero = $request->genero;
                        $model->fnacimiento = $request->fnacimiento;
                        $model->telefono_movil = $request->telefono_movil;
                        $model->user_id = $request->user_id;
                        $model->user_id_medico = Auth::id();
                        $model->created_at = date('Y-m-d H:i:s', strtotime( $request->created_at ) );
                        if (!is_null($file)){
                            $model->imagen = $nombre;
                        }
                        $model->save();
                    }
                    // $model = UserProfile::updateOrCreate(
                    //     [
                    //         "user_id"=>$request->user_id,
                    //     ],
                    //     [
                    //         'nombres'        => !is_null($request->nombres)?$request->nombres:"",
                    //         'apellidos'      => !is_null($request->apellidos)?$request->apellidos:"",
                    //         'nacionalidad'   => $request->nacionalidad,
                    //         'cedula'         => $request->cedula,
                    //         'genero'         => $request->genero,
                    //         'fnacimiento'    => $request->fnacimiento,
                    //         'telefono_movil' => $request->telefono_movil,
                    //         // 'imagen'         => $nombre,
                    //         "user_id"        => $request->user_id,
                    //         'user_id_medico' => Auth::id(),
                    //         "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                    //     ]
                    // );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //4 USER_IMAGES_FILES
                    $imagenesDefault = [
                        "partidaNacimiento" =>"/image/system/fnacimiento.svg",
                        "imgSoyChacao" =>"/image/system/card.svg",
                        "imgDocIdentidad" =>"/image/system/card.svg",
                    ];

                    foreach ($request->file() as $key => $file) {
                        $nombre    = null;
                        $extension = null;
                        if ($key != "imagen") {
                            if (!is_null($file)) {

                                if (
                                    $key == "partidaNacimiento" ||
                                    $key == "imgSoyChacao" ||
                                    $key == "imgDocIdentidad"
                                ) {
                                    $nombre = $imagenesDefault [ $key ];
                                    $aleatotio = Str::random(6);
                                    $ruta = 'image/user/userProfileImage/';
                                    $nombre = "upi_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                                    $extension = $file->getClientOriginalExtension();
                                    if (!file_exists($ruta.$nombre)) {
                                        $file->move($ruta , $nombre);
                                        $nombre ='/'. $ruta . $nombre;
                                    }

                                    $model = UserProfileImages::updateOrCreate(
                                        [
                                            'user_id_paciente'   => $request->user_id,
                                            'coments'     => $key,
                                        ],
                                        [
                                            'value'     => $nombre,
                                            'user_id_paciente'     => $request->user_id,
                                            'file_type'     => $extension,
                                            'coments'     => $key,
                                            'user_id_medico'     => Auth::id(),
                                            'created_at'     => date('Y-m-d H:i:s', strtotime($request['created_at']) ),
                                        ]
                                    );
                                    if ($model->exists) {
                                        $resultSet[ $model->getTable() ."_". $key ] = $model->toArray();
                                    }

                                }
                            }
                        }
                    }

                //5 USER_DIRECCION
                    $model = UserCuestDireccion::updateOrCreate(
                        [
                            'user_id' => $request->user_id
                        ],
                        [
                            'cat_estado_id'    => isset($request->cat_estado_id)?$request->cat_estado_id:null,
                            'cat_municipio_id' => isset($request->cat_municipio_id)?$request->cat_municipio_id:null,
                            'description'      => isset($request->description)?$request->description:null,
                            'domicilio'        => isset($request->domicilio)?$request->domicilio:null,
                            'user_id'          => isset($request->user_id)?$request->user_id:null,
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //6 TARJETA SOYCHACAO
                    $model = TarjetaSoyChacao::updateOrCreate(
                        [
                        'user_id_paciente'   => $user_id,
                        ],
                        [
                            'description'   =>  isset($request->tarjeta_soy_chacao)?$request->tarjeta_soy_chacao:NULL ,
                            'user_id_paciente'   => $user_id,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //7 REGISTRO FAMILIAR
                    if (isset($request->registro_familiar) && $request->registro_familiar) {
                        $model = UserFamily::updateOrCreate(
                            [
                                'user_id_paciente'   => $request->user_id_pariente,
                                'user_id_pariente'   => $user_id
                            ],
                            [
                                'user_id_paciente'   => $request->user_id_pariente,
                                'user_id_pariente'   => $user_id,
                                'cat_user_family_id'   => $request->cat_user_family_id_pariente,
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );
                        $model = UserFamily::updateOrCreate(
                            [
                                'user_id_paciente'   => $user_id,
                                'user_id_pariente'   => $request->user_id_pariente
                            ],
                            [
                                'user_id_paciente'   => $user_id,
                                'user_id_pariente'   => $request->user_id_pariente,
                                'cat_user_family_id'   => $request->cat_user_family_id,
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );

                        if ($model->exists) {
                            $newFamiliar = $model->toArray();
                            $user_familiar = new UserFamilyController();
                            $resultSet[ $model->getTable() ] = $user_familiar->show($request->user_id_pariente,$request->cedula_pariente)[0];
                        }
                    }

                //8 EPISODIO
                    // $model =  UserCuestEpisodio::firstOrCreate(
                    //     [
                    //         'user_id'=> $request->user_id,
                    //         'egreso' =>  NULL,
                    //         'active' =>  1,
                    //     ],
                    //     [
                    //         'user_id'=> $request->user_id,
                    //         'user_id_medico' => Auth::id(),
                    //         "ingreso"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) ),
                    //         "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                    //     ]
                    // );
                    // if ($model->exists) {
                    //     $resultSet[ $model->getTable() ] = $model->toArray();
                    // }

                //9 UBICACIÓN EN AREA

                    // $model =  UserCuestUbicacion::firstOrCreate(
                    //     [
                    //         'user_cuest_episodio_id'=> $model->id,
                    //         'user_id_paciente' =>  $request->user_id,
                    //         'active' =>  1,
                    //         'cat_user_ubicacion_id'=> isset($request->cat_user_ubicacion_id) ? $request->cat_user_ubicacion_id : 245,

                    //     ],
                    //     [
                    //         'cat_user_ubicacion_id'=> isset($request->cat_user_ubicacion_id) ? $request->cat_user_ubicacion_id : 245,
                    //         'user_cuest_episodio_id'   => $model->id,
                    //         'value'=> isset($request->value) ? $request->value : NULL,
                    //         'user_id_paciente'=> $request->user_id,
                    //         'value'=> "Ingreso Emergencia",
                    //         'user_id_medico' => Auth::id(),
                    //         "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                    //     ]
                    // );
                    // if ($model->exists) {
                    //     $resultSet[ $model->getTable() ] = $model->toArray();
                    // }
                    // UserCuestUbicacion::where("user_cuest_episodio_id",$model->user_cuest_episodio_id)
                    // ->where("user_id_paciente",$model->user_id_paciente)
                    // ->where("id","!=",$model->id)
                    // ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

            DB::commit();

            $resultSet[ "success" ] = true;
            //ENVIAR EMAIL DE REGISTRO
            if ($resultSet[ "success" ] && $isNewUser) {
                if ( config("app.APP_SEND_EMAILS") ) {
                    $model['case']=1;
                    $model['email']=$request->email;
                    $model['password']=$request->password;

                    $model['logo'] = config('app.url')."/image/system/".config('app.APP_LOGO_VERSION_REPORTS_COLOR') ;
                    $model['subject']= "Bienvenido al sistema.";

                    if ( config("app.APP_TEST_MODE") ) {
                        $team_test = explode(",",config("app.APP_ADDRESS_TEAM_TEST"));
                        $model['emails'] = $team_test;
                    }else{
                        $model['emails'][0] = $request->email;
                    }

                    Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                        foreach ($model['emails'] as $key => $correo) {
                            $message->to( $correo )
                            ->subject($model['subject']);
                        }
                    });
                }
            }
            return Response()->json($resultSet);
        } catch (\Throwable $th) {

            DB::rollBack();
            $resultSet = [];
            $resultSet[ "success" ] = false;
            $resultSet[ "message" ] = $th;
            return Response()->json($resultSet);
        }

        return Response()->json(true);
    }

    public function consultaExternaStoreTEMPORAL(Request $request)
    {
        //BORRAR ESTE CONTROLADOR CUANDO HAYA SIDO COMPLETADA LA MIGRACIÓN
        //05/08/2022
        //1 User
        //2 UserType
        //3 Profile
        //4 Direction
        //5 Episodio
        //6 Ubicación en area
        //7 Estatus (alerta)
        //8 Vip
        //9 MedicoEspecialidad

        //10 MedicoPosicion
        //11 Centro Salud
        //11 Equipo salud
        $meta =420000;
        $inicio = isset($_GET['sig']) ? ($_GET['sig']): 1;
        $fin = $inicio + 300;
        $cedulas_duplicadas = [];
        $cedulas_unicas = [];


            $importPacientes = DB::select("SELECT * FROM importpaciente WHERE HistoriaMedica BETWEEN ".$inicio." AND ".$fin." limit 300",[]);
            //dd( $importPacientes);
            foreach ($importPacientes as $key => $value) {
                if ( !in_array($value->Cedula,$cedulas_unicas) ) {
                    array_push($cedulas_unicas,$value->Cedula);
                    $NOMBRES = $value->Pnombre." ".$value->Snombre;
                    $APELLIDOS = $value->Papellido." ".$value->Sapellido;
                    $CEDULA = $value->Cedula;
                    $CORREO = $value->Correo;
                    $DOMICILIO = $value->Direccion_Hab;

                    if ($value->Id_Genero  == 1) {
                        $GENERO = "m";
                    }else{
                        $GENERO = "f";
                    }
                    $FECHA_NACIMIENTO = $value->Fechanac;
                    $TELEFONO_MOVIL = $value->Celular;
                    $TELEFONO_LOCAL = $value->Telefono_Hab;

                    $NACIONALIDAD = "V";
                    if ($value->Id_Nacionalidad == 2 || $value->Id_Nacionalidad == "------") {
                        $NACIONALIDAD = "E";
                    }
                    $anio = date('Y', strtotime( $request->Fecha_Ingreso));
                    if ($anio < 1970) {
                        $hora = date('H:i:s', strtotime( $request->Fecha_Ingreso_SC));
                        $dia = date('d', strtotime( $request->Fecha_Ingreso_SC));
                        $mes = date('m', strtotime( $request->Fecha_Ingreso_SC));
                        $anio =  "1970";
                        $FECHA_INGRESO = date('Y-m-d H:i:s', strtotime( $anio."-".$mes."-".$dia." ".$hora ) );
                    }else{
                        $FECHA_INGRESO = date('Y-m-d H:i:s', strtotime( $request->Fecha_Ingreso_SC ) );
                    }


                    if ( empty($CORREO)) {

                        $CORREO = $CEDULA."@correotemporal.com";
                    }

                    $request->merge(["imgSoyChacao"=>NULL]);
                    $request->merge(["imgDocIdentidad"=>NULL]);
                    $request->merge(["imagen"=>NULL]);
                    $request->merge(["firma"=>NULL]);
                    $request->merge(["sello"=>NULL]);

                    $request->merge(["domicilio"=>$DOMICILIO]);
                    $request->merge(["fnacimiento"=>$FECHA_NACIMIENTO]);
                    $request->merge(["cedula"=>$CEDULA]);
                    $request->merge(["nombres"=>$NOMBRES]);
                    $request->merge(["apellidos"=>$APELLIDOS]);
                    $request->merge(["email"=>$CORREO]);
                    $request->merge(["genero"=>$GENERO]);
                    $request->merge(["nacionalidad"=>$NACIONALIDAD]);
                    $request->merge(["created_at"=>$FECHA_INGRESO]);
                    //--------------------------------------
                    try {

                        //1 USER
                            $user = DB::select("SELECT * FROM user WHERE email = ?",[$request->email]);
                            if ( count($user) == 0) {
                                DB::select("
                                    INSERT INTO
                                    user(email,password,user_id_medico,created_at)
                                    VALUES(?,?,?,?)
                                ",[
                                    $request->email,
                                    "123456" ,
                                    NULL,
                                    $request->created_at
                                ]);
                                $user = DB::select("SELECT id FROM user WHERE email = ? LIMIT 1",[$request->email]);
                                $user_id = $user[0]->id;

                            }else{
                                $user_id = $user[0]->id;
                            }
                            $request->merge(["user_id_paciente"=>$user_id]);
                            $request->merge(["user_id"=>$user_id]);



                        //2 USER_TYPE
                            $user_type = DB::select("SELECT * FROM user_type WHERE user_id = ? AND cat_user_type_id = 1",[$request->user_id]);
                            if ( count($user_type) == 0) {
                                DB::select("
                                    INSERT INTO
                                    user_type (cat_user_type_id,
                                        user_id,
                                        user_id_medico,
                                        created_at
                                    )
                                    VALUES(?,?,?,?)
                                ",[
                                    1,
                                    $request->user_id,
                                    NULL,
                                    $request->created_at
                                ]);
                            }

                        //3 USER_PROFILE
                            $user_profile = DB::select("SELECT * FROM user_profile WHERE user_id = ?",[$request->user_id]);
                            if ( count($user_profile) == 0) {
                                DB::select("
                                    INSERT INTO
                                    user_profile(
                                        nombres,
                                        apellidos,
                                        nacionalidad,
                                        cedula,
                                        genero,
                                        fnacimiento,
                                        telefono_movil,
                                        prefijo,
                                        firma,
                                        sello,
                                        mpps,
                                        colegio_medico,
                                        imagen,
                                        user_id,
                                        user_id_medico,
                                        created_at
                                    )
                                    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
                                ",[
                                    $request->nombres,
                                    $request->apellidos,
                                    $request->nacionalidad,
                                    $request->cedula,
                                    $request->genero,
                                    $request->fnacimiento,
                                    $request->telefono_movil,
                                    NULL,
                                    NULL,
                                    NULL,
                                    NULL,
                                    NULL,
                                    NULL,
                                    $request->user_id,
                                    NULL,
                                    date('Y-m-d H:i:s', strtotime($request['created_at']))
                                ]);
                            }

                            $user_profile = DB::select("SELECT * FROM user_profile_images WHERE file_type='imgSoyChacao' AND user_id_paciente  = ?",[$request->user_id]);
                            if ( count($user_profile) == 0) {
                                DB::select("
                                    INSERT INTO
                                    user_profile_images(
                                        value,
                                        file_type,
                                        user_id_paciente,
                                        user_id_medico,
                                        created_at

                                    )
                                    VALUES(?,?,?,?,?)
                                ",[
                                    NULL,
                                    'imgSoyChacao',
                                    $request->user_id,
                                    NULL,
                                    date('Y-m-d H:i:s', strtotime($request['created_at']))
                                ]);
                            }
                            $user_profile = DB::select("SELECT * FROM user_profile_images WHERE file_type='imgDocIdentidad' AND user_id_paciente  = ?",[$request->user_id]);
                            if ( count($user_profile) == 0) {
                                DB::select("
                                    INSERT INTO
                                    user_profile_images(
                                        value,
                                        file_type,
                                        user_id_paciente,
                                        user_id_medico,
                                        created_at

                                    )
                                    VALUES(?,?,?,?,?)
                                ",[
                                    NULL,
                                    'imgDocIdentidad',
                                    $request->user_id,
                                    NULL,
                                    date('Y-m-d H:i:s', strtotime($request['created_at']))
                                ]);
                            }
                        //4 DIRECTION
                            $direction = DB::select("SELECT * FROM user_cuest_direction WHERE user_id = ?",[$request->user_id]);
                            if ( count($direction) == 0) {
                                DB::select("
                                    INSERT INTO
                                    user_cuest_direction(
                                        cat_estado_id,
                                        cat_municipio_id ,
                                        description,
                                        domicilio,
                                        user_id,
                                        user_id_medico,
                                        created_at
                                    )
                                    VALUES(?,?,?,?,?,?,?)
                                ",[
                                    NULL,
                                    NULL,
                                    NULL,
                                    $request->domicilio,
                                    $request->user_id,
                                    NULL,
                                    date('Y-m-d H:i:s', strtotime($request['created_at']))
                                ]);
                            }
                        //5 EPISODIO
                            /* $episodio=null;
                            $valida_episodio = DB::select("SELECT * FROM user_cuest_episodio WHERE egreso IS NULL AND active = 1 AND user_id = ? ORDER BY created_at DESC LIMIT 1",[$request->user_id]);


                            if ( count($valida_episodio) == 0 ) {
                                DB::select("
                                    INSERT INTO
                                    user_cuest_episodio(
                                        user_id,
                                        user_id_med_esp,
                                        ingreso,
                                        created_at

                                    )
                                    VALUES(?,?,?,?)
                                ",[
                                    $request->user_id,
                                    NULL,
                                    date('Y-m-d H:i:s'),
                                    date('Y-m-d H:i:s')
                                ]);
                                $episodio = DB::select("SELECT id FROM user_cuest_episodio WHERE egreso IS NULL AND active = 1 AND user_id = ? ORDER BY created_at DESC LIMIT 1",[$request->user_id]);
                                $episodio = $episodio[0]->id;
                            }else{
                                $episodio = $valida_episodio[0]->id;
                                $valida_ubi_area = DB::select("SELECT * FROM user_cuest_ubicacion WHERE user_cuest_episodio_id = ? AND active = 1 AND user_id_paciente = ? ORDER BY created_at DESC LIMIT 1",[$episodio,$request->user_id]);

                                if (count($valida_ubi_area) > 0 ) {
                                    $request->merge([ "cat_user_ubicacion_id" => $valida_ubi_area[0]->cat_user_ubicacion_id ]) ;
                                    $request->merge([ "value" => $valida_ubi_area[0]->value ]) ;
                                }
                            }     */
                        //6 UBICACIÓN EN AREA
                            /* $ubi_area = DB::select("SELECT * FROM user_cuest_ubicacion WHERE user_cuest_episodio_id = ? AND user_id_paciente = ? ORDER BY created_at DESC LIMIT 1",[$episodio,$request->user_id]);
                            if ( count($ubi_area) == 0 ) {
                                DB::select("
                                    INSERT INTO
                                    user_cuest_ubicacion(
                                        cat_user_ubicacion_id,
                                        user_cuest_episodio_id ,
                                        value,
                                        user_id_paciente,
                                        user_id_medico,
                                        created_at

                                    )
                                    VALUES(?,?,?,?,?,?)
                                ",[
                                    387,
                                    $episodio,
                                    "Ingreso Emergencia",
                                    $request->user_id,
                                    NULL,
                                    date('Y-m-d H:i:s')
                                ]);

                            } */
                        //7 ESTATUS (ALERTA)
                            /* $prioridad_value=1;
                            $valida_prioridad = DB::select("SELECT * FROM user_cuest_alert WHERE user_cuest_episodio_id = ? AND user_id_paciente = ? ORDER BY created_at DESC LIMIT 1",[$episodio,$request->user_id]);

                            if (count( $valida_prioridad ) > 0 ) {
                                $prioridad_value = $valida_prioridad[0]->value;
                            }
                            DB::select("
                                INSERT INTO
                                user_cuest_alert(
                                    value,
                                    user_cuest_episodio_id ,
                                    user_id_paciente,
                                    user_id_medico,
                                    created_at

                                )
                                VALUES(?,?,?,?,?)
                            ",[
                                $prioridad_value,
                                $episodio,
                                $request->user_id,
                                NULL,
                                date('Y-m-d H:i:s')
                            ]); */
                        //8 VIP
                            /* $vip_value=0;
                            $valida_vip = DB::select("SELECT * FROM user_vip WHERE user_cuest_episodio_id = ? AND user_id_paciente = ? ORDER BY created_at DESC LIMIT 1",[$episodio,$request->user_id]);

                            if (count( $valida_vip ) > 0 ) {
                                $vip_value = $valida_vip[0]->value;
                            }
                            DB::select("
                                INSERT INTO
                                user_vip(
                                    value,
                                    user_cuest_episodio_id ,
                                    user_id_paciente,
                                    user_id_medico,
                                    created_at

                                )
                                VALUES(?,?,?,?,?)
                            ",[
                                $vip_value,
                                $episodio,
                                $request->user_id,
                                NULL,
                                date('Y-m-d H:i:s')
                            ]); */
                        //9 USER CENTRO SALUD (AMBULATORIO)
                            /* $centro_salud_id = CentroSalud::where("active",1)->select("id")->first();
                            $centro_salud_id = $centro_salud_id->id;

                            $user_centro_salud = DB::select("SELECT * FROM user_centro_salud WHERE centro_salud_id = ? AND user_id_paciente = ? ORDER BY created_at DESC LIMIT 1",[$centro_salud_id,$request->user_id]);
                            if (count( $user_centro_salud ) > 0 ) {
                                $centro_salud_id = $user_centro_salud[0]->centro_salud_id;
                            }
                            DB::select("
                                INSERT INTO
                                user_centro_salud(
                                    centro_salud_id,
                                    user_id_paciente ,
                                    user_id_medico,
                                    created_at

                                )
                                VALUES(?,?,?,?)
                            ",[
                                $centro_salud_id,
                                $request->user_id,
                                NULL,
                                date('Y-m-d H:i:s')
                            ]); */
                        //10 TARJETA SOYCHACAO
                        $tarjeta_soy_chacao = NULL;
                        $tarjeta_soy_chacao = DB::select("SELECT * FROM tarjeta_soy_chacao WHERE user_id_paciente = ? ORDER BY created_at DESC LIMIT 1",[$request->user_id]);


                        if ( count($tarjeta_soy_chacao) == 0 ) {
                            DB::select("
                                INSERT INTO
                                tarjeta_soy_chacao(
                                    description,
                                    user_id_paciente ,
                                    user_id_medico,
                                    created_at

                                )
                                VALUES(?,?,?,?)
                            ",[
                                NULL,
                                $request->user_id,
                                NULL,
                                date('Y-m-d H:i:s')
                            ]);
                        }

                    } catch (\Throwable $th) {


                        dd($th);
                    }



                }else{
                    array_push($cedulas_duplicadas,$value->Cedula);
                }

            }
        echo "<div style='font-size:40px'>Registros desde ".$inicio." hasta ".($fin-1).".  <span style='color:green'>COMPLETADO</span><br>";

        $restante = $inicio *100 / $meta;
        echo "REGISTROS RESTANTES: ".($meta-$fin)." (".round($restante,2)."%)<br>";
        echo "Duplicados".print_r($cedulas_duplicadas)."<br>";
        echo "<a  href='https://patientcare.saludchacao.pstelemed.com/importpacientes?sig=".($fin)."'>Siguiente bloque (".($fin)." al ".($fin+299).")</a></div>";
        //header("Location:https://patientcare.saludchacao.pstelemed.com/importpacientes?sig=".($fin) );
        /*  */

                /*

        //dd($request->all());














            //PARA EL MEDICO:

            // MEDICOESPECIALIDAD
            // MEDICOPOSICION
            // EQUIPO SALUD
            if ( config("app.APP_SEND_EMAILS") ) {
                $model['case']=1;
                $model['email']=$request->email;
                $model['password']=$request->password;

                $model['logo'] = config('app.url')."/image/system/".config('app.APP_LOGO_VERSION_REPORTS_COLOR') ;
                $model['subject']= "Bienvenido al sistema.";

                if ( config("app.APP_TEST_MODE") ) {
                    $team_test = explode(",",config("app.APP_ADDRESS_TEAM_TEST"));
                    $model['emails'] = $team_test;
                }else{
                    $model['emails'] = $request->email;
                }


                Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                    foreach ($model['emails'] as $key => $correo) {
                        $message->to( $correo )
                        ->subject($model['subject']);
                    }
                });
            }else{
                //dump("El envio de correos está desabilitado.") ;
            }
        } catch (\Throwable $th) {

            dd($th);
        }
        return Response()->json(true);*/
    }
    public function consultaExternaMasivo(Request $request)
    {
        //1 User
        //2 UserType
        //3 Profile
        //4 Direction
        //5 Tarjeta Soy chacao
        //9 MedicoEspecialidad
        //10 MedicoPosicion
        //11 Centro Salud
        //11 Equipo salud



        //dd($request->all());
        try {
            //1 USER
                $user = User::firstOrCreate(
                    ['email' => $request->email],
                    [
                        'email'          => $request->email,
                        'password'       => isset( $request->password ) ? $request->password : "123456",
                        'user_id_medico' => Auth::id(),
                        "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                    ]
                );
                $user_id = $user->id;
                //dump($user);

                $request->merge(["user_id_paciente"=>$user_id]);
                $request->merge(["user_id"=>$user_id]);
            //2 USER_TYPE
                $user_type = UserType::updateOrCreate(
                    [
                    'user_id'   => $user_id,
                    ],
                    [
                        'user_id'     => $user_id,
                        'cat_user_type_id' => 1,
                        'user_id_medico' => Auth::id(),
                        "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                    ]
                );
            //3 USER_PROFILE

                $user = UserProfile::updateOrCreate(
                [
                    "user_id"=>$request->user_id,
                ],
                [
                    'nombres' => $request->nombres,
                    'apellidos' => $request->apellidos,
                    'nacionalidad' => $request->nacionalidad,
                    'cedula' => $request->cedula,
                    'genero' => $request->genero,
                    'fnacimiento' => $request->fnacimiento,
                    'telefono_movil' => $request->telefono_movil,
                    "user_id"=>$request->user_id,
                    'user_id_medico' => Auth::id(),
                    'created_at' => date('Y-m-d H:i:s', strtotime($request['created_at']))
                ]
                );
                $userImage = UserProfileImages::store($request);

            //4 DIRECTION
                $direction = UserCuestDireccion::store($request);

            //5 TARJETA SOYCHACAO
                $tarjeta_soy_chacao = NULL;
                if (isset($request->tarjeta_soy_chacao)) {
                    $tarjeta_soy_chacao = $request->tarjeta_soy_chacao;
                }else{
                    $tarjeta_soy_chacao = TarjetaSoyChacao::where("user_id_paciente",$user_id)->first();

                    if ( !is_null($tarjeta_soy_chacao) ) {
                        $tarjeta_soy_chacao = $tarjeta_soy_chacao->description;
                    }else{
                        $tarjeta_soy_chacao = NULL;
                    }

                }
                TarjetaSoyChacao::updateOrCreate(
                    [
                    'user_id_paciente'   => $user_id,
                    ],
                    [
                        'description'   => $tarjeta_soy_chacao,
                        'user_id_paciente'   => $user_id,
                        'user_id_medico' => Auth::id(),
                        "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                    ]
                );

            //PARA EL MEDICO:

            // MEDICOESPECIALIDAD
                UserEspecialidad::updateOrCreate(
                    [
                    'user_id'   => $user_id,
                    ],
                    [
                        'cat_user_especialidad_id'   => 68,
                        'user_id_paciente'   => $user_id,
                        'user_id_medico' => Auth::id(),
                        "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                    ]
                );
            // MEDICOPOSICION
                UserMedicoPosicion::updateOrCreate(
                    [
                    'user_id'   => $user_id,
                    ],
                    [
                        'cat_user_medico_posicion_id'   => 10,
                        'user_id_paciente'   => $user_id,
                        'user_id_medico' => Auth::id(),
                        "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                    ]
                );
            // EQUIPO SALUD
                UserEquipoSalud::updateOrCreate(
                    [
                    'user_id'   => $user_id,
                    ],
                    [
                        'cat_user_equipo_salud_id'   => 9,
                        'user_id'   => $user_id,
                        'user_id_medico' => Auth::id(),
                        "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                    ]
                );


        } catch (\Throwable $th) {

            dd($th);
        }
        return Response()->json(true);
    }
    public function storeExterno(Request $request){
        //SAMPLE
       /*  $request = new Request();
        $request->merge(["email"=>"aaaa"]);
        $request->merge(["nombres"=>"Nombre 1"]);
        $request->merge(["apellidos"=>"Apellido 1"]);
        $request->merge(["nacionalidad"=>"V"]);
        $request->merge(["cedula"=>"22014778.01"]);
        $request->merge(["genero"=>"m"]);
        $request->merge(["fnacimiento"=>"1984-10-06"]);
        $request->merge(["telefono_movil"=>"04149320905"]);
        $request->merge(["created_at"=>date('Y-m-d H:i:s')]); */
        $resultSet = [];
        try {

            DB::beginTransaction();
                /* //1 USER
                    $model = User::firstOrCreate(
                        ['email' => $request->email],
                        [
                            'email'          => $request->email,
                            'password'       => isset( $request->password ) ? $request->password : "123456",
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );

                    $user_id = $model->id;
                    $request->merge(["user_id_paciente"=>$user_id]);
                    $request->merge(["user_id"=>$user_id]);
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    } */

                    //VERIFICAR SI LA CEDULA EXISTE
                    $user_id =NULL;
                    $email = NULL;
                    $existe_cedula =    UserProfile::where("cedula",$request->cedula)
                                        ->leftJoin("user", "user_profile.user_id", "user.id")
                                        ->select("user.email","user_profile.user_id")
                                        ->orderBy("user_profile.user_id","DESC")->get()->take(1)->toArray();
                    if ( !empty($existe_cedula) ) {
                        $user_id = $existe_cedula[0]['user_id'];
                        $email =  $existe_cedula[0]['email'];
                    }
                    if ($email != $request->email) {
                        $email = $request->email;
                    }
                    $existe_email = User::where("email",$request->email)->first();
                    if (is_null($existe_email)) {
                        $email = $request->email;

                    }else{
                        $user_id = $existe_email->id;
                        $email = $request->cedula."@correotemporal.com";
                    }
                    //dd($existe_cedula);

                    //-----------
                    if ( !empty($existe_cedula) ) {
                        $email =  $existe_cedula[0]['email'];
                        if ($existe_cedula[0]['email']!= $request->email) {
                            $email = $request->email;
                        }
                        $model = User::firstOrCreate(
                            ['id' => $user_id],
                            [
                                'email'          => $email,
                                'password'       => isset( $request->password ) ? $request->password : "123456",
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );
                        $user_id = $model->id;
                    }else{
                        $model = User::firstOrCreate(
                            ['email' => $email],
                            [
                                'email'          => $email,
                                'password'       => isset( $request->password ) ? $request->password : "123456",
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );
                        $user_id = $model->id;
                    }
                    $request->merge(["user_id_paciente"=>$user_id]);
                    $request->merge(["user_id"=>$user_id]);
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }
                    //-------------


                //2 USER_TYPE
                    $model = UserType::updateOrCreate(
                        [
                        'user_id'   => $user_id,
                        ],
                        [
                            'user_id'          => $user_id,
                            'cat_user_type_id' => 1,
                            'user_id_medico'   => Auth::id(),
                            "created_at"       => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }
                //3 USER_PROFILE
                    $nombre ="/image/system/patient.svg";
                    $file = $request->file('imagen');
                    if (!is_null($file)) {
                        $aleatotio = Str::random(6);
                        $ruta = 'image/user/foto_perfil/';
                        $nombre = "fp_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                        $extension = $file->getClientOriginalExtension();
                        if (!file_exists($ruta.$nombre)) {
                            $file->move($ruta , $nombre);
                            $nombre ='/'. $ruta . $nombre;
                        }
                    }
                    $model = UserProfile::updateOrCreate(
                        [
                            "user_id"=>$request->user_id,
                        ],
                        [
                            'nombres'        => !is_null($request->nombres)?$request->nombres:"",
                            'apellidos'      => !is_null($request->apellidos)?$request->apellidos:"",
                            'nacionalidad'   => $request->nacionalidad,
                            'cedula'         => $request->cedula,
                            'genero'         => $request->genero,
                            'fnacimiento'    => $request->fnacimiento,
                            'telefono_movil' => $request->telefono_movil,
                            'imagen'         => $nombre,
                            "user_id"        => $request->user_id,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }
                //4 USER_IMAGES_FILES
                    $imagenesDefault = [
                        "partidaNacimiento" =>"/image/system/fnacimiento.svg",
                        "imgSoyChacao" =>"/image/system/card.svg",
                        "imgDocIdentidad" =>"/image/system/card.svg",
                    ];

                    foreach ($request->file() as $key => $file) {
                        $nombre    = null;
                        $extension = null;
                        if ($key != "imagen") {
                            if (!is_null($file)) {

                                if (
                                    $key == "partidaNacimiento" ||
                                    $key == "imgSoyChacao" ||
                                    $key == "imgDocIdentidad"
                                ) {
                                    $nombre = $imagenesDefault [ $key ];
                                    $aleatotio = Str::random(6);
                                    $ruta = 'image/user/userProfileImage/';
                                    $nombre = "upi_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                                    $extension = $file->getClientOriginalExtension();
                                    if (!file_exists($ruta.$nombre)) {
                                        $file->move($ruta , $nombre);
                                        $nombre ='/'. $ruta . $nombre;
                                    }

                                    $model = UserProfileImages::updateOrCreate(
                                        [
                                            'user_id_paciente'   => $request->user_id,
                                            'coments'     => $key,
                                            'active'     => 1,
                                        ],
                                        [
                                            'value'     => $nombre,
                                            'user_id_paciente'     => $request->user_id,
                                            'file_type'     => $extension,
                                            'coments'     => $key,
                                            'active'     => 1,
                                            'user_id_medico'     => Auth::id(),
                                            'created_at'     => date('Y-m-d H:i:s', strtotime($request['created_at']) ),
                                        ]
                                    );
                                    if ($model->exists) {
                                        $resultSet[ $model->getTable() ."_". $key ] = $model->toArray();
                                    }





                                }
                            }
                        }
                    }
                //5 USER_DIRECCION
                    $model = UserCuestDireccion::updateOrCreate(
                        [
                            'user_id' => $request->user_id
                        ],
                        [
                            'cat_estado_id'    => isset($request->cat_estado_id)?$request->cat_estado_id:null,
                            'cat_municipio_id' => isset($request->cat_municipio_id)?$request->cat_municipio_id:null,
                            'description'      => isset($request->description)?$request->description:null,
                            'domicilio'        => isset($request->domicilio)?$request->domicilio:null,
                            'user_id'          => isset($request->user_id)?$request->user_id:null,
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }
                //6 TARJETA SOYCHACAO
                    $model = TarjetaSoyChacao::updateOrCreate(
                        [
                        'user_id_paciente'   => $user_id,
                        ],
                        [
                            'description'   =>  isset($request->tarjeta_soy_chacao)?$request->tarjeta_soy_chacao:NULL ,
                            'user_id_paciente'   => $user_id,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }
                //7 REGISTRO FAMILIAR
                    if (isset($request->registro_familiar) && $request->registro_familiar) {
                        $model = UserFamily::updateOrCreate(
                            [
                                'user_id_paciente'   => $request->user_id_pariente,
                                'user_id_pariente'   => $user_id
                            ],
                            [
                                'user_id_paciente'   => $request->user_id_pariente,
                                'user_id_pariente'   => $user_id,
                                'cat_user_family_id'   => $request->cat_user_family_id_pariente,
                                'revisado'=> 0,
                                'active'=> 1,
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );


                        if ($model->exists) {
                            $newFamiliar = $model->toArray();
                            $user_familiar = new UserFamilyController();
                            $resultSet[ $model->getTable() ] = $user_familiar->show($request->user_id_pariente,$request->cedula_pariente)[0]  ;
                        }
                    }
            DB::commit();
            $resultSet[ "success" ] = true;
            if ($resultSet[ "success" ]) {
                /* if ( config("app.APP_SEND_EMAILS") ) { */
                    $model['case']=1;
                    $model['email']=$request->email;
                    $model['password']=$request->password;

                    $model['logo'] = config('app.url')."/image/system/salud_chacao.png" ;
                    $model['subject']= "Bienvenido al sistema.";

                    /* if ( config("app.APP_TEST_MODE") ) {
                        $team_test = explode(",",config("app.APP_ADDRESS_TEAM_TEST"));
                        $model['emails'] = $team_test;
                    }else{ */
                        //$model['emails'] = $request->email;
                    /* } */
                    $model['emails'] = $request->email;
                    Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                            $message->to( "hiperiom412@gmail.com" )
                            ->subject($model['subject']);
                    });
                    Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                            $message->to( $model['emails'] )
                            ->subject($model['subject']);
                    });
                    /* Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                        foreach ($model['emails'] as $key => $correo) {
                            $message->to( $correo )
                            ->subject($model['subject']);
                        }
                    }); */
                /* } */
            }

            return Response()->json($resultSet);
        } catch (\Throwable $th) {

            DB::rollBack();
            $resultSet = [];
            $resultSet[ "success" ] = false;
            $resultSet[ "message" ] = $th;
            return Response()->json($resultSet);
        }

    }
    public function storeFamiliar(Request $request){
        //SAMPLE
       /*  $request = new Request();
        $request->merge(["email"=>"aaaa"]);
        $request->merge(["nombres"=>"Nombre 1"]);
        $request->merge(["apellidos"=>"Apellido 1"]);
        $request->merge(["nacionalidad"=>"V"]);
        $request->merge(["cedula"=>"22014778.01"]);
        $request->merge(["genero"=>"m"]);
        $request->merge(["fnacimiento"=>"1984-10-06"]);
        $request->merge(["telefono_movil"=>"04149320905"]);
        $request->merge(["created_at"=>date('Y-m-d H:i:s')]); */
        //dd($request->all());
        $resultSet = [];
        try {

            DB::beginTransaction();
                /* //1 USER
                    $model = User::firstOrCreate(
                        ['email' => $request->email],
                        [
                            'email'          => $request->email,
                            'password'       => isset( $request->password ) ? $request->password : "123456",
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );

                    $user_id = $model->id;
                    $request->merge(["user_id_paciente"=>$user_id]);
                    $request->merge(["user_id"=>$user_id]);
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    } */

                    //VERIFICAR SI LA CEDULA EXISTE
                    //$user_id =NULL;
                    $email = NULL;

                    //if ($email != $request->email) {
                    $email = $request->email;
                    //}

                    //BUSCAMOS LA CEDULA A VER SI EXISTE
                    $existe_cedula =    UserProfile::where("cedula",$request->cedula)
                                        ->leftJoin("user", "user_profile.user_id", "user.id")
                                        ->select("user.email","user_profile.user_id")
                                        ->orderBy("user_profile.user_id","DESC")->get()->take(1)->toArray();

                    if ( !empty($existe_cedula) ) {
                        $user_id = $existe_cedula[0]['user_id'];
                        $email =  $existe_cedula[0]['email'];

                        if ($email !=  $existe_cedula[0]['email']) {
                            $email = $request->email;
                        }
                    }

                    //dd($existe_cedula);

                    //-----------
                    if ( !empty($existe_cedula) ) {
                        //$email =  $existe_cedula[0]['email'];
                        /* if ($existe_cedula[0]['email']!= $request->email) {
                            $email = $request->email;
                        } */
                        $model = User::firstOrCreate(
                            [
                                'id' => $user_id,

                            ],
                            [
                                'email'          => $email,
                                'password'       => isset( $request->password ) ? $request->password : "123456",
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );
                        $user_id = $model->id;
                    }else{

                        $existe_email = User::where("email",$request->email)->first();
                        if (!is_null($existe_email)) {
                            $temp_email['id'] = $existe_email->id;
                        }else{
                            $temp_email['email'] = $email;
                        }
                        $model = User::firstOrCreate(
                            $temp_email,
                            [
                                'email'          => $email,
                                'password'       => isset( $request->password ) ? $request->password : "123456",
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );
                        $user_id = $model->id;
                    }
                    $request->merge(["user_id_paciente"=>$user_id]);
                    $request->merge(["user_id"=>$user_id]);
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }
                    //-------------


                //2 USER_TYPE
                    $model = UserType::updateOrCreate(
                        [
                        'user_id'   => $user_id,
                        ],
                        [
                            'user_id'          => $user_id,
                            'cat_user_type_id' => 1,
                            'user_id_medico'   => Auth::id(),
                            "created_at"       => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }
                //3 USER_PROFILE
                    $nombre ="/image/system/patient.svg";
                    $file = $request->file('imagen');
                    if (!is_null($file)) {
                        $aleatotio = Str::random(6);
                        $ruta = 'image/user/foto_perfil/';
                        $nombre = "fp_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                        $extension = $file->getClientOriginalExtension();
                        if (!file_exists($ruta.$nombre)) {
                            $file->move($ruta , $nombre);
                            $nombre ='/'. $ruta . $nombre;
                        }
                    }
                    $model = UserProfile::updateOrCreate(
                        [
                            "user_id"=>$request->user_id,
                        ],
                        [
                            'nombres'        => !is_null($request->nombres)?$request->nombres:"",
                            'apellidos'      => !is_null($request->apellidos)?$request->apellidos:"",
                            'nacionalidad'   => $request->nacionalidad,
                            'cedula'         => $request->cedula,
                            'genero'         => $request->genero,
                            'fnacimiento'    => $request->fnacimiento,
                            'telefono_movil' => $request->telefono_movil,
                            'imagen'         => $nombre,
                            "user_id"        => $request->user_id,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }
                //4 USER_IMAGES_FILES
                    $imagenesDefault = [
                        "partidaNacimiento" =>"/image/system/fnacimiento.svg",
                        "imgSoyChacao" =>"/image/system/card.svg",
                        "imgDocIdentidad" =>"/image/system/card.svg",
                    ];

                    foreach ($request->file() as $key => $file) {
                        $nombre    = null;
                        $extension = null;
                        if ($key != "imagen") {
                            if (!is_null($file)) {

                                if (
                                    $key == "partidaNacimiento" ||
                                    $key == "imgSoyChacao" ||
                                    $key == "imgDocIdentidad"
                                ) {
                                    $nombre = $imagenesDefault [ $key ];
                                    $aleatotio = Str::random(6);
                                    $ruta = 'image/user/userProfileImage/';
                                    $nombre = "upi_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                                    $extension = $file->getClientOriginalExtension();
                                    if (!file_exists($ruta.$nombre)) {
                                        $file->move($ruta , $nombre);
                                        $nombre ='/'. $ruta . $nombre;
                                    }

                                    $model = UserProfileImages::updateOrCreate(
                                        [
                                            'user_id_paciente'   => $request->user_id,
                                            'coments'     => $key,
                                            'active'     => 1,
                                        ],
                                        [
                                            'value'     => $nombre,
                                            'user_id_paciente'     => $request->user_id,
                                            'file_type'     => $extension,
                                            'coments'     => $key,
                                            'active'     => 1,
                                            'user_id_medico'     => Auth::id(),
                                            'created_at'     => date('Y-m-d H:i:s', strtotime($request['created_at']) ),
                                        ]
                                    );
                                    if ($model->exists) {
                                        $resultSet[ $model->getTable() ."_". $key ] = $model->toArray();
                                    }





                                }
                            }
                        }
                    }
                //5 USER_DIRECCION
                    $model = UserCuestDireccion::updateOrCreate(
                        [
                            'user_id' => $request->user_id
                        ],
                        [
                            'cat_estado_id'    => isset($request->cat_estado_id)?$request->cat_estado_id:null,
                            'cat_municipio_id' => isset($request->cat_municipio_id)?$request->cat_municipio_id:null,
                            'description'      => isset($request->description)?$request->description:null,
                            'domicilio'        => isset($request->domicilio)?$request->domicilio:null,
                            'user_id'          => isset($request->user_id)?$request->user_id:null,
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }
                //6 TARJETA SOYCHACAO
                    $model = TarjetaSoyChacao::updateOrCreate(
                        [
                        'user_id_paciente'   => $user_id,
                        ],
                        [
                            'description'   =>  isset($request->tarjeta_soy_chacao)?$request->tarjeta_soy_chacao:NULL ,
                            'user_id_paciente'   => $user_id,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }
                //7 REGISTRO FAMILIAR
                    if (isset($request->registro_familiar) && $request->registro_familiar) {
                        $model = UserFamily::updateOrCreate(
                            [
                                'user_id_paciente'   => $request->user_id_pariente,
                                'user_id_pariente'   => $user_id
                            ],
                            [
                                'user_id_paciente'   => $request->user_id_pariente,
                                'user_id_pariente'   => $user_id,
                                'cat_user_family_id'   => $request->cat_user_family_id_pariente,
                                'revisado'=> 0,
                                'active'=> 1,
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );


                        if ($model->exists) {
                            $newFamiliar = $model->toArray();
                            $user_familiar = new UserFamilyController();
                            $resultSet[ $model->getTable() ] = $user_familiar->show($request->user_id_pariente,$request->cedula_pariente)[0]  ;
                        }
                    }
            DB::commit();
            $resultSet[ "success" ] = true;
            if ($resultSet[ "success" ]) {
                /* if ( config("app.APP_SEND_EMAILS") ) { */
                    $model['case']=1;
                    $model['email']=$request->email;
                    $model['password']=$request->password;

                    $model['logo'] = config('app.url')."/image/system/salud_chacao.png" ;
                    $model['subject']= "Bienvenido al sistema.";

                    /* if ( config("app.APP_TEST_MODE") ) {
                        $team_test = explode(",",config("app.APP_ADDRESS_TEAM_TEST"));
                        $model['emails'] = $team_test;
                    }else{ */
                        //$model['emails'] = $request->email;
                    /* } */
                    $model['emails'] = $request->email;
                    /* Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                            $message->to( "hiperiom412@gmail.com" )
                            ->subject($model['subject']);
                    });
                    Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                            $message->to( $model['emails'] )
                            ->subject($model['subject']);
                    }); */
                    /* Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                        foreach ($model['emails'] as $key => $correo) {
                            $message->to( $correo )
                            ->subject($model['subject']);
                        }
                    }); */
                /* } */
            }

            return Response()->json($resultSet);
        } catch (\Throwable $th) {

            DB::rollBack();
            $resultSet = [];
            $resultSet[ "success" ] = false;
            $resultSet[ "message" ] = $th;
            return Response()->json($resultSet);
        }

    }
    public function emergenciaStore(Request $request)
    {


        $resultSet = [];
        try {

            DB::beginTransaction();
                //1 USER
                   /*  $model = User::firstOrCreate(
                        ['email' => is_null($request->email) ? $request->cedula."@correotemporal.com" : $request->email ],
                        [
                            'email'          => is_null($request->email) ? $request->cedula."@correotemporal.com" : $request->email,
                            'password'       => isset( $request->password ) ? $request->password : "123456",
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );

                    $user_id = $model->id;
                    $request->merge(["user_id_paciente"=>$user_id]);
                    $request->merge(["user_id"=>$user_id]);
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    } */


                    //VERIFICAR SI LA CEDULA EXISTE
                    $user_id =NULL;
                    $email = NULL;
                    $existe_cedula =    UserProfile::where("cedula",$request->cedula)
                                        ->leftJoin("user", "user_profile.user_id", "user.id")
                                        ->select("user.email","user_profile.user_id")
                                        ->orderBy("user_profile.user_id","DESC")->get()->take(1)->toArray();


                    if ( !empty($existe_cedula) ) {
                        $user_id = $existe_cedula[0]['user_id'];
                        $email =  $existe_cedula[0]['email'];
                    }
                    /* if ($email != $request->email) {
                        $email = $request->email;
                    } */
                    //dd($email);
                    $existe_email = User::where("email",$request->email)->first();
                    if (is_null($existe_email)) {
                        $email = $request->email;

                    }else{
                        //$user_id = $existe_email->id;
                        $email = $request->cedula."@correotemporal.com";
                    }
                    //dd($existe_cedula);

                    //-----------
                    if ( !empty($existe_cedula) ) {
                        //$email =  $existe_cedula[0]['email'];
                        /* if ($existe_cedula[0]['email']!= $request->email) {
                            $email = $request->email;
                        } */
                        $model = User::firstOrCreate(
                            ['id' => $user_id],
                            [
                                'email'          => $email,
                                'password'       => isset( $request->password ) ? $request->password : "123456",
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );
                        $user_id = $model->id;
                    }else{
                        $model = User::firstOrCreate(
                            ['email' => $email],
                            [
                                'email'          => $email,
                                'password'       => isset( $request->password ) ? $request->password : "123456",
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );
                        $user_id = $model->id;
                    }
                    $request->merge(["user_id_paciente"=>$user_id]);
                    $request->merge(["user_id"=>$user_id]);
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }
                    //-------------






                //2 USER_TYPE
                    $model = UserType::updateOrCreate(
                        [
                        'user_id'   => $user_id,
                        ],
                        [
                            'user_id'          => $user_id,
                            'cat_user_type_id' => 1,
                            'user_id_medico'   => Auth::id(),
                            "created_at"       => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //3 USER_PROFILE
                    $nombre ="/image/system/patient.svg";
                    $file = $request->file('imagen');
                    if (!is_null($file)) {
                        $aleatotio = Str::random(6);
                        $ruta = 'image/user/foto_perfil/';
                        $nombre = "fp_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                        $extension = $file->getClientOriginalExtension();
                        if (!file_exists($ruta.$nombre)) {
                            $file->move($ruta , $nombre);
                            $nombre ='/'. $ruta . $nombre;
                        }
                    }
                    try {
                        //code...

                    $model = UserProfile::firstOrCreate(
                        [
                            "user_id"=>$request->user_id,
                            "cedula"=>$request->cedula,
                        ],
                        [
                            'nombres'        => !is_null($request->nombres)?$request->nombres:"",
                            'apellidos'      => !is_null($request->apellidos)?$request->apellidos:"",
                            'nacionalidad'   => $request->nacionalidad,
                            'cedula'         => $request->cedula,
                            'genero'         => $request->genero,
                            'fnacimiento'    => $request->fnacimiento,
                            'telefono_movil' => $request->telefono_movil,
                            'imagen'         => $nombre,
                            "user_id"        => $request->user_id,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                } catch (\Throwable $th) {
                        dd($th);
                    }
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //4 USER_IMAGES_FILES
                    $imagenesDefault = [
                        "partidaNacimiento" =>"/image/system/fnacimiento.svg",
                        "imgSoyChacao" =>"/image/system/card.svg",
                        "imgDocIdentidad" =>"/image/system/card.svg",
                    ];

                    foreach ($request->file() as $key => $file) {
                        $nombre    = null;
                        $extension = null;
                        if ($key != "imagen") {
                            if (!is_null($file)) {

                                if (
                                    $key == "partidaNacimiento" ||
                                    $key == "imgSoyChacao" ||
                                    $key == "imgDocIdentidad"
                                ) {
                                    $nombre = $imagenesDefault [ $key ];
                                    $aleatotio = Str::random(6);
                                    $ruta = 'image/user/userProfileImage/';
                                    $nombre = "upi_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                                    $extension = $file->getClientOriginalExtension();
                                    if (!file_exists($ruta.$nombre)) {
                                        $file->move($ruta , $nombre);
                                        $nombre ='/'. $ruta . $nombre;
                                    }

                                    $model = UserProfileImages::updateOrCreate(
                                        [
                                            'user_id_paciente'   => $request->user_id,
                                            'coments'     => $key,
                                        ],
                                        [
                                            'value'     => $nombre,
                                            'user_id_paciente'     => $request->user_id,
                                            'file_type'     => $extension,
                                            'coments'     => $key,
                                            'user_id_medico'     => Auth::id(),
                                            'created_at'     => date('Y-m-d H:i:s', strtotime($request['created_at']) ),
                                        ]
                                    );
                                    if ($model->exists) {
                                        $resultSet[ $model->getTable() ."_". $key ] = $model->toArray();
                                    }





                                }
                            }
                        }
                    }

                //5 USER_DIRECCION
                    $model = UserCuestDireccion::updateOrCreate(
                        [
                            'user_id' => $request->user_id
                        ],
                        [
                            'cat_estado_id'    => isset($request->cat_estado_id)?$request->cat_estado_id:null,
                            'cat_municipio_id' => isset($request->cat_municipio_id)?$request->cat_municipio_id:null,
                            'description'      => isset($request->description)?$request->description:null,
                            'domicilio'        => isset($request->domicilio)?$request->domicilio:null,
                            'user_id'          => isset($request->user_id)?$request->user_id:null,
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //6 TARJETA SOYCHACAO
                    $model = TarjetaSoyChacao::updateOrCreate(
                        [
                        'user_id_paciente'   => $user_id,
                        ],
                        [
                            'description'   =>  isset($request->tarjeta_soy_chacao)?$request->tarjeta_soy_chacao:NULL ,
                            'user_id_paciente'   => $user_id,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //7 REGISTRO FAMILIAR
                    if (isset($request->registro_familiar) && $request->registro_familiar) {
                        $model = UserFamily::updateOrCreate(
                            [
                                'user_id_paciente'   => $request->user_id_pariente,
                                'user_id_pariente'   => $user_id
                            ],
                            [
                                'user_id_paciente'   => $request->user_id_pariente,
                                'user_id_pariente'   => $user_id,
                                'cat_user_family_id'   => $request->cat_user_family_id_pariente,
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );
                        $model = UserFamily::updateOrCreate(
                            [
                                'user_id_paciente'   => $user_id,
                                'user_id_pariente'   => $request->user_id_pariente
                            ],
                            [
                                'user_id_paciente'   => $user_id,
                                'user_id_pariente'   => $request->user_id_pariente,
                                'cat_user_family_id'   => $request->cat_user_family_id,
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );

                        if ($model->exists) {
                            $newFamiliar = $model->toArray();
                            $user_familiar = new UserFamilyController();
                            $resultSet[ $model->getTable() ] = $user_familiar->show($request->user_id_pariente,$request->cedula_pariente)[0]  ;
                        }
                    }

                //8 EPISODIO
                    $model =  UserCuestEpisodio::firstOrCreate(
                        [
                            'user_id'=> $request->user_id,
                            'egreso' =>  NULL,
                            'active' =>  1,
                        ],
                        [
                            'user_id'=> $request->user_id,
                            'user_id_medico' => Auth::id(),
                            "ingreso"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) ),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //9 UBICACIÓN EN AREA

                    $model =  UserCuestUbicacion::firstOrCreate(
                        [
                            'user_cuest_episodio_id'=> $model->id,
                            'user_id_paciente' =>  $request->user_id,
                            'active' =>  1,
                            'cat_user_ubicacion_id'=> isset($request->cat_user_ubicacion_id) ? $request->cat_user_ubicacion_id : 245,

                        ],
                        [
                            'cat_user_ubicacion_id'=> isset($request->cat_user_ubicacion_id) ? $request->cat_user_ubicacion_id : 245,
                            'user_cuest_episodio_id'   => $model->id,
                            'value'=> isset($request->value) ? $request->value : NULL,
                            'user_id_paciente'=> $request->user_id,
                            'value'=> "Ingreso Emergencia",
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }
                    UserCuestUbicacion::where("user_cuest_episodio_id",$model->user_cuest_episodio_id)
                    ->where("user_id_paciente",$model->user_id_paciente)
                    ->where("id","!=",$model->id)
                    ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);




            DB::commit();

            $resultSet[ "success" ] = true;
            //ENVIAR EMAIL DE REGISTRO
            if ($resultSet[ "success" ]) {
                if ( config("app.APP_SEND_EMAILS") ) {
                    $model['case']=1;
                    $model['email']=$request->email;
                    $model['password']=$request->password;

                    $model['logo'] = config('app.url')."/image/system/".config('app.APP_LOGO_VERSION_REPORTS_COLOR') ;
                    $model['subject']= "Bienvenido al sistema.";

                    if ( config("app.APP_TEST_MODE") ) {
                        $team_test = explode(",",config("app.APP_ADDRESS_TEAM_TEST"));
                        $model['emails'] = $team_test;
                    }else{
                        $model['emails'] = $request->email;
                    }


                    Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                        foreach ($model['emails'] as $key => $correo) {
                            $message->to( $correo )
                            ->subject($model['subject']);
                        }
                    });
                }
            }
            return Response()->json($resultSet);
        } catch (\Throwable $th) {

            DB::rollBack();
            $resultSet = [];
            $resultSet[ "success" ] = false;
            $resultSet[ "message" ] = $th;
            return Response()->json($resultSet);
        }

        return Response()->json(true);
    }

    public function consultaExternaUpdate(Request $request)
    {
        $resultSet = [];
        try {

            DB::beginTransaction();
                //1 USER
                    $model = User::find($request->user_id);
                    $model->email =$request->email;
                    $model->save();

                    $user_id = $model->id;

                    $request->merge(["user_id_paciente"=>$user_id]);


                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //2 USER_TYPE
                    $model = UserType::updateOrCreate(
                        [
                        'user_id'   => $user_id,
                        ],
                        [
                            'user_id'          => $user_id,
                            'cat_user_type_id' => 1,
                            'user_id_medico'   => Auth::id(),
                            "created_at"       => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //3 USER_PROFILE
                    $nombre ="/image/system/patient.svg";
                    $file = $request->file('imagen');
                    if (!is_null($file)) {
                        $aleatotio = Str::random(6);
                        $ruta = 'image/user/foto_perfil/';
                        $nombre = "fp_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                        $extension = $file->getClientOriginalExtension();
                        if (!file_exists($ruta.$nombre)) {
                            $file->move($ruta , $nombre);
                            $nombre ='/'. $ruta . $nombre;
                        }
                    }
                    $model = UserProfile::updateOrCreate(
                        [
                            "user_id"=>$request->user_id,
                        ],
                        [
                            'nombres'        => !is_null($request->nombres)?$request->nombres:"",
                            'apellidos'      => !is_null($request->apellidos)?$request->apellidos:"",
                            'nacionalidad'   => $request->nacionalidad,
                            'cedula'         => $request->cedula,
                            'genero'         => $request->genero,
                            'fnacimiento'    => $request->fnacimiento,
                            'telefono_movil' => $request->telefono_movil,
                            'imagen'         => $nombre,
                            "user_id"        => $request->user_id,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //4 USER_IMAGES_FILES
                    $imagenesDefault = [
                        "partidaNacimiento" =>"/image/system/fnacimiento.svg",
                        "imgSoyChacao" =>"/image/system/card.svg",
                        "imgDocIdentidad" =>"/image/system/card.svg",
                    ];

                    foreach ($request->file() as $key => $file) {
                        $nombre    = null;
                        $extension = null;
                        if ($key != "imagen") {
                            if (!is_null($file)) {

                                if (
                                    $key == "partidaNacimiento" ||
                                    $key == "imgSoyChacao" ||
                                    $key == "imgDocIdentidad"
                                ) {
                                    $nombre = $imagenesDefault [ $key ];
                                    $aleatotio = Str::random(6);
                                    $ruta = 'image/user/userProfileImage/';
                                    $nombre = "upi_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                                    $extension = $file->getClientOriginalExtension();
                                    if (!file_exists($ruta.$nombre)) {
                                        $file->move($ruta , $nombre);
                                        $nombre ='/'. $ruta . $nombre;
                                    }

                                    $model = UserProfileImages::updateOrCreate(
                                        [
                                            'user_id_paciente'   => $request->user_id,
                                            'coments'     => $key,
                                        ],
                                        [
                                            'value'     => $nombre,
                                            'user_id_paciente'     => $request->user_id,
                                            'file_type'     => $extension,
                                            'coments'     => $key,
                                            'user_id_medico'     => Auth::id(),
                                            'created_at'     => date('Y-m-d H:i:s', strtotime($request['created_at']) ),
                                        ]
                                    );
                                    if ($model->exists) {
                                        $resultSet[ $model->getTable() ."_". $key ] = $model->toArray();
                                    }





                                }
                            }
                        }
                    }

                //5 USER_DIRECCION
                    $model = UserCuestDireccion::updateOrCreate(
                        [
                            'user_id' => $request->user_id
                        ],
                        [
                            'cat_estado_id'    => isset($request->cat_estado_id)?$request->cat_estado_id:null,
                            'cat_municipio_id' => isset($request->cat_municipio_id)?$request->cat_municipio_id:null,
                            'description'      => isset($request->description)?$request->description:null,
                            'domicilio'        => isset($request->domicilio)?$request->domicilio:null,
                            'user_id'          => isset($request->user_id)?$request->user_id:null,
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //6 TARJETA SOYCHACAO
                    $model = TarjetaSoyChacao::updateOrCreate(
                        [
                        'user_id_paciente'   => $user_id,
                        ],
                        [
                            'description'   =>  isset($request->tarjeta_soy_chacao)?$request->tarjeta_soy_chacao:NULL ,
                            'user_id_paciente'   => $user_id,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //7 REGISTRO FAMILIAR
                    if (isset($request->registro_familiar) && $request->registro_familiar) {
                        $model = UserFamily::updateOrCreate(
                            [
                                'user_id_paciente'   => $request->user_id_pariente,
                                'user_id_pariente'   => $user_id
                            ],
                            [
                                'user_id_paciente'   => $request->user_id_pariente,
                                'user_id_pariente'   => $user_id,
                                'cat_user_family_id'   => $request->cat_user_family_id_pariente,
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );
                        $model = UserFamily::updateOrCreate(
                            [
                                'user_id_paciente'   => $user_id,
                                'user_id_pariente'   => $request->user_id_pariente
                            ],
                            [
                                'user_id_paciente'   => $user_id,
                                'user_id_pariente'   => $request->user_id_pariente,
                                'cat_user_family_id'   => $request->cat_user_family_id,
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );

                        if ($model->exists) {
                            $newFamiliar = $model->toArray();
                            $user_familiar = new UserFamilyController();
                            $resultSet[ $model->getTable() ] = $user_familiar->show($request->user_id_pariente,$request->cedula_pariente)[0]  ;
                        }
                    }






            DB::commit();

            $resultSet[ "success" ] = true;
            //ENVIAR EMAIL DE REGISTRO
            if ($resultSet[ "success" ]) {
                if ( config("app.APP_SEND_EMAILS") ) {
                    $model['case']=2;

                    $model['logo'] = config('app.url')."/image/system/".config('app.APP_LOGO_VERSION_REPORTS_COLOR') ;
                    $model['subject']= "Actualización de datos";

                    if ( config("app.APP_TEST_MODE") ) {
                        $team_test = explode(",",config("app.APP_ADDRESS_TEAM_TEST"));
                        $model['emails'] = $team_test;
                    }else{
                        $model['emails'] = $request->email;
                    }


                    Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                        foreach ($model['emails'] as $key => $correo) {
                            $message->to( $correo )
                            ->subject($model['subject']);
                        }
                    });
                }else{
                    //dump("El envio de correos está desabilitado.") ;
                }
            }
            return Response()->json($resultSet);
        } catch (\Throwable $th) {

            DB::rollBack();
            $resultSet = [];
            $resultSet[ "success" ] = false;
            $resultSet[ "message" ] = $th;
            return Response()->json($resultSet);
        }

    }
    public function addRol($user_id,$rol)
    {


        UserType::updateOrCreate(
            [
                "user_id"=>$user_id,
                "cat_user_type_id"=>$rol
            ],
            [
                "user_id"=>$user_id,
                "user_id_medico"=>Auth::id(),
                "cat_user_type_id"=>$rol,
                "created_at"=>date('Y-m-d H:i:s'),
                "active"=>1
            ]
        );
        return $model = UserType::where("user_id",$user_id)->get();
    }
    public function removeRol($user_id,$rol)
    {

        $model = UserType::where("user_id",$user_id)
        ->where("cat_user_type_id",$rol);
        $model->delete();
        return $model = UserType::where("user_id",$user_id)->get();
    }
    public function show2($user_id_paciente)
    {
        try {
            $model = DB::select("
                SELECT

                    upp.id as up_id,
                    upp.user_id,
                    upp.nombres,
                    upp.apellidos,
                    upp.nacionalidad,
                    upp.cedula,
                    upp.fnacimiento,
                    upp.genero,
                    upp.telefono_movil,
                    upp.imagen AS userImagen,

                    user.email,

                    ucd.id AS ucd_id,
                    ucd.cat_estado_id,
                    ucd.cat_municipio_id,
                    ucd.description,
                    ucd.domicilio,
                    (
                        SELECT tsc.description
                        FROM tarjeta_soy_chacao AS tsc
                        WHERE tsc.user_id_paciente = upp.user_id
                        LIMIT 1
                    ) tarjeta_soy_chacao,
                    (
                        SELECT upi.value
                        FROM user_profile_images AS upi
                        WHERE upi.user_id_paciente = upp.user_id
                        AND upi.coments = 'imgDocIdentidad'
                        LIMIT 1
                    ) imgDocIdentidad,
                    (
                        SELECT upi.value
                        FROM user_profile_images AS upi
                        WHERE upi.user_id_paciente = upp.user_id
                        AND upi.coments = 'imgSoyChacao'
                        LIMIT 1
                    ) imgSoyChacao,
                    (
                        SELECT upi.value
                        FROM user_profile_images AS upi
                        WHERE upi.user_id_paciente = upp.user_id
                        AND upi.coments = 'partidaNacimiento'
                        LIMIT 1
                    ) partidaNacimiento,
                    (
                        SELECT GROUP_CONCAT(ut.cat_user_type_id)
                        FROM user_type AS ut
                        WHERE ut.user_id = upp.user_id
                    ) roles

                FROM user_profile AS upp
                LEFT JOIN user ON upp.user_id = user.id
                LEFT JOIN user_cuest_direction  AS ucd ON upp.user_id = ucd.user_id

                WHERE upp.user_id = ".$user_id_paciente."
                AND user.active = 1
            ",[]);
        } catch (\Throwable $th) {
           dd($th);
        }

        return $model;


    }
    public function consultaExternaHome(Request $request)
    {
        //dd(Auth()->user());
        if(is_null(Auth()->user())){
            return redirect("/");
        }
        $cat_grupo_centro_salud_id = config('app.APP_GRUPO_CENTRO_SALUD_ID');

        /* $centro_salud = CentroSalud::where("cat_grupo_centro_salud_id", $cat_grupo_centro_salud_id )->get()->toArray();
        foreach ($centro_salud as $key => $value) {
            $centro_salud[$key]['especialidades'] =  CentroSaludEspecialidades::where("centro_salud_especialidades.active",1 )
                                       ->where("centro_salud_id",$value['id'])
                                       ->select(
                                           "centro_salud_especialidades.id",
                                           "centro_salud_id",
                                           "cat_especialidad_id",
                                           "description",
                                           "image"
                                       )
                                       ->join("cat_user_especialidad","centro_salud_especialidades.cat_especialidad_id","cat_user_especialidad.id")
                                       ->orderBy("cat_user_especialidad.description", "ASC")
                                       ->get()
                                       ->toArray();
        }
        */
       /*  $cat_estado = CatEstado::all()->toArray();
        $cat_municipio = CatMunicipio::all()->toArray(); */
     // dd($cat_municipio);
        $model =[];
        $model['paciente']["correo"] = Auth::user()->email;
            /* $model['paciente'] =    UserProfile::where("user_profile.user_id",Auth::id())
                                    ->where("user.active",1)
                                    ->leftJoin("tarjeta_soy_chacao","user_profile.user_id","tarjeta_soy_chacao.user_id_paciente")
                                    ->leftJoin("user_cuest_direction","user_profile.user_id","user_cuest_direction.user_id")
                                    ->join("user","user_profile.user_id","user.id")
                                    ->select(
                                        "user_cuest_direction.cat_estado_id",
                                        "user_cuest_direction.cat_municipio_id",
                                        "user_cuest_direction.description",
                                        "user_cuest_direction.domicilio",
                                        "user_profile.*",
                                        DB::raw("
                                            user_cuest_direction.description AS ciudad
                                        "),
                                        DB::raw("
                                            user.email
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
                                                WHEN fnacimientO IS NULL THEN ''
                                                ELSE  DATE_FORMAT(fnacimiento, '%d/%m/%Y')
                                            END AS nacimiento
                                        "),
                                        DB::raw("
                                            YEAR(CURDATE())-YEAR(fnacimiento) AS edad
                                        ")
                                    )->first()
                                    ->toArray();



                                //dd($model['paciente']);
                                //->toArray();
                                //

                        //dd(Auth::id());
                        $model['paciente']['imgDocIdentidad'] =    UserProfileImages::where("user_id_paciente",Auth::id())->where("coments","imgDocIdentidad")->value("value");
                        $model['paciente']['imgSoyChacao'] =    UserProfileImages::where("user_id_paciente",Auth::id())->where("coments","imgSoyChacao")->value("value");
                        $model['episodio'] = UserCuestEpisodio::ultimoEpisodio_id(Auth::id());
                        $model['antecedentes'] = UserCuestAntecedente::index(Auth::id())->toArray();
                        $model['recipes'] = UserCuestRecipe::index(Auth::id())->toArray();
                        $model['informes'] = UserCuestInforme::indexByUserId(Auth::id())->toArray();
                        $model['notificaciones'] = [];
                        $model['citas'] = UserCita::index_paciente()->toArray();
                        $model['familiares'] = [];
                        $model['alergias'] = [];
                        $model['archivos'] = [];
                        $model['estudios'] = [];
                        $model['especialidades'] = CatEspecialidad::where("centro_salud_especialidades.active",1)
                                                    ->join("centro_salud_especialidades","cat_user_especialidad.id","centro_salud_especialidades.cat_especialidad_id")
                                                    ->select(
                                                        DB::raw("cat_user_especialidad.id as cat_especialidad_id"),
                                                        "cat_user_especialidad.*",
                                                        "centro_salud_especialidades.centro_salud_id"
                                                    )
                                                    ->get()->toArray();
                    */

        //dd($model);
        return view("nv.home",
            compact(
                'model' /* ,
                'centro_salud',
                'cat_estado',
                'cat_municipio' */

            )
        );

    }
    public function reporteCitas_detalle_totalCitasCreadasGerentes($spreadsheet,$startDate,$endDate)
    {
        $abc = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
        $fechaInicio = explode("-",$startDate);
        $fechaFin = explode("-",$endDate);
        $diaInicio = $fechaInicio[2];
        $mesInicio = $fechaInicio[1];
        $anioInicio = $fechaInicio[0];
        $LETRA_ULTIMA_COLUMNA = $abc[12];
        $diaFin = $fechaFin[2];
        $mesFin = $fechaFin[1];
        $anioFin = $fechaFin[0];
        $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        //COLOR DE FONDO
        $spreadsheet->getActiveSheet()->getStyle($abc[0].'1:'.$LETRA_ULTIMA_COLUMNA.'4')->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB( config("app.APP_BS_PRIMARY_ARGB") );

        //COLOR DE LETRA
        $spreadsheet->getActiveSheet()->getStyle($abc[0].'1:'.$LETRA_ULTIMA_COLUMNA.'4')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

        $spreadsheet->getActiveSheet()->getStyle($abc[0].'5:'.$LETRA_ULTIMA_COLUMNA.'5')
        ->getFont()->getColor()->setARGB( config("app.APP_BS_PRIMARY_ARGB") );
        //IMAGEN LOGO
        $drawing = new Drawing();
        $drawing->setWidth(3);
        $drawing->setHeight(50);
        $drawing->setPath('image/system/logo-cmdlt-blanco.png');
        $drawing->setCoordinates($LETRA_ULTIMA_COLUMNA.'1');

        $drawing->setOffsetY(10);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        //NEGRITAS
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getStyle($abc[0].'1:'.$LETRA_ULTIMA_COLUMNA.'3' )->getFont()->setBold(true);
        $sheet->getStyle($abc[0].'5:'.$LETRA_ULTIMA_COLUMNA.'5' )->getFont()->setBold(true);




        //CABECERA
        $sheet->setCellValue($abc[0].'1', 'CMDLT');
        $sheet->setCellValue($abc[0].'2', 'PACIENTES REGISTRADOS');
        $sheet->setCellValue($abc[0].'3', 'DESDE EL '.$diaInicio.'-'.strtoupper( $mes[ (int) $mesInicio-1 ] ).'-'.$anioInicio.' HASTA '.$diaFin.'-'.strtoupper( $mes[ (int) $mesFin-1 ] ).'-'.$anioFin);
        //COMBINAR CELDAS
        //$spreadsheet->getActiveSheet()->mergeCells($abc[0].'4:'.$LETRA_ULTIMA_COLUMNA.'4');

        $sheet->setCellValue($abc[0].'4', 'CREACIÓN: '.date("d").' DE '.strtoupper( $mes[ (int) date("m")-1 ] ).' DE '.date("Y").' A LAS '.date("g:i:s A"));

        $spreadsheet->getActiveSheet()->getStyle($LETRA_ULTIMA_COLUMNA."4")->getFont()->setSize(5);
        $spreadsheet->getActiveSheet()->getStyle($abc[0]."2")->getFont()->setSize(16);
        $sheet->getStyle($LETRA_ULTIMA_COLUMNA.'4')->getAlignment()->setHorizontal('right');

        try {
            $model =  DB::select("
                SELECT
                    DISTINCT up.cedula AS 'CEDULA',
                    up.nombres AS 'NOMBRES',
                    up.apellidos AS ' APELLIDOS',
                    CASE
                        WHEN up.telefono_movil IS NULL THEN ''
                        WHEN up.telefono_movil = 'undefined' THEN ''
                        ELSE up.telefono_movil
                    END AS 'TELEFONO',
                    CASE
                        WHEN up.genero = 'm' THEN 'M'
                        WHEN up.genero = 'f' THEN 'F'
                        ELSE ''
                    END AS 'GENERO',
                    DATE_FORMAT(up.fnacimiento ,'%d/%m/%Y') AS 'F_NACIMIENTO',
                    YEAR(CURDATE())-YEAR(up.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(up.fnacimiento,'%m-%d'), 0 , -1 ) AS 'EDAD',
                    user.email AS 'CORREO',
                    CASE WHEN ce.description IS NULL THEN '' ELSE ce.description END AS 'ESTADO',
                    CASE WHEN cm.description IS NULL THEN '' ELSE cm.description END AS 'MUNICIPIO',
                    CASE WHEN ucd.description IS NULL THEN '' ELSE ucd.description END AS 'DIRECCION',
                    CASE WHEN ucd.domicilio IS NULL THEN '' ELSE ucd.domicilio END AS 'DOMICILIO',
                    CASE WHEN tsc.description IS NULL THEN '' ELSE tsc.description END AS 'TARJETA_SOY_CHACAO',
                    DATE_FORMAT(user.created_at,'%d/%m/%Y') AS 'FECHA_REGISTRO',
                    user.id AS 'ID',
                    user.created_at
                FROM user_profile AS up
                LEFT JOIN user_cuest_direction AS ucd ON up.user_id = ucd.user_id
                LEFT JOIN cat_estado AS ce ON ucd.cat_estado_id = ce.id
                LEFT JOIN cat_municipio AS cm ON ucd.cat_municipio_id = cm.id
                LEFT JOIN tarjeta_soy_chacao AS tsc ON up.user_id = tsc.user_id_paciente
                LEFT JOIN user ON up.user_id = user.id
                WHERE user.created_at BETWEEN ? AND ?
                ORDER BY user.created_at DESC
            ", [$startDate." 00:00:00", $endDate." 23:59:59" ]);
        } catch (\Throwable $th) {
            throw $th;
        }
        //dd( $model);
        //NOMBRE DE LA PESTAÑA
        $spreadsheet->getActiveSheet()->setTitle("Pacientes CMDLT");

        //http://127.0.0.1:8000/user/paciente/cita/reporteCitasCreadas/2022-01-01/2023-01-09

        //TITULOS
        $i = 0;
        $sheet->setCellValue( $abc[$i++].'5', 'CEDULA');
        $sheet->setCellValue( $abc[$i++].'5', 'NOMBRES');
        $sheet->setCellValue( $abc[$i++].'5', 'APELLIDOS');
        $sheet->setCellValue( $abc[$i++].'5', 'TELEFONO');
        $sheet->setCellValue( $abc[$i++].'5', 'GENERO');
        $sheet->setCellValue( $abc[$i++].'5', 'F_NACIMIENTO');
        $sheet->setCellValue( $abc[$i++].'5', 'EDAD');
        $sheet->setCellValue( $abc[$i++].'5', 'CORREO');
        $sheet->setCellValue( $abc[$i++].'5', 'ESTADO');
        $sheet->setCellValue( $abc[$i++].'5', 'MUNICIPIO');
        $sheet->setCellValue( $abc[$i++].'5', 'DIRECCION');
        $sheet->setCellValue( $abc[$i++].'5', 'DOMICILIO');
        $sheet->setCellValue( $abc[$i++].'5', 'FECHA REGISTRO');
        //$sheet->setCellValue( $abc[9].'5', 'ID');




        //REGISTROS
        $row = 6;

        foreach ($model as $key => $value) {
            $i = 0;
            $sheet->setCellValue( $abc[$i++].$row, $value->CEDULA);
            $sheet->setCellValue( $abc[$i++].$row, $value->NOMBRES);
            $sheet->setCellValue( $abc[$i++].$row, $value->APELLIDOS);
            $sheet->setCellValue( $abc[$i++].$row, (String) $value->TELEFONO);
            $sheet->setCellValue( $abc[$i++].$row, $value->GENERO);
            $sheet->setCellValue( $abc[$i++].$row, $value->F_NACIMIENTO);
            $sheet->setCellValue( $abc[$i++].$row, $value->EDAD);
            $sheet->setCellValue( $abc[$i++].$row, $value->CORREO);
            $sheet->setCellValue( $abc[$i++].$row, $value->ESTADO);
            $sheet->setCellValue( $abc[$i++].$row, $value->MUNICIPIO);
            $sheet->setCellValue( $abc[$i++].$row, $value->DIRECCION);
            $sheet->setCellValue( $abc[$i++].$row, $value->DOMICILIO);
            $sheet->setCellValue( $abc[$i++].$row, $value->FECHA_REGISTRO);
            //$sheet->setCellValue( $abc[9].$row, (int) $value->ID);
           /*  $sheet->setCellValue($abc[10].$row,  $mes[ (int) $value->month-1 ]);
            $sheet->setCellValue($abc[11].$row, (int) $value->year);
            $sheet->setCellValue($abc[12].$row, date("g:i A", strtotime( date("Y-m-d")." ".$value->hour )) );
            $sheet->setCellValue($abc[13].$row, $value->motivo_consulta);
            $sheet->setCellValue($abc[14].$row, $value->motivo_cancelacion);
            $sheet->setCellValue($abc[15].$row, $value->fecha_solicitud); */


            //COLOR DE FONDO


            $sheet->getStyle( $abc[3].$row)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);

            $row++;
        }
        //$spreadsheet->getActiveSheet()->getColumnDimension($abc[3])->setWidth('50');

        //$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        //$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth('30');
        //$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth('30');
        //$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        //$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        for ($i=1; $i < 13 ; $i++) {
            $spreadsheet->getActiveSheet()->getColumnDimension($abc[$i])->setWidth('30');
            //$spreadsheet->getActiveSheet()->getColumnDimension($abc[$i])->setAutoSize(true);
        }
        /* $spreadsheet->getActiveSheet()->getColumnDimension($abc[0])->setWidth('8');
        $spreadsheet->getActiveSheet()->getColumnDimension($abc[1])->setWidth('12');
        $spreadsheet->getActiveSheet()->getColumnDimension($abc[3])->setWidth('12');
        $spreadsheet->getActiveSheet()->getColumnDimension($abc[4])->setWidth('20');
        $spreadsheet->getActiveSheet()->getColumnDimension($abc[9])->setWidth('8');
        $spreadsheet->getActiveSheet()->getColumnDimension($abc[10])->setWidth('8');
        $spreadsheet->getActiveSheet()->getColumnDimension($abc[11])->setWidth('8'); */

        /* */

        //$colWidth = $sheet->getColumnDimension($LETRA_ULTIMA_COLUMNA)->getWidth();
        //if ($colWidth == -1) { //not defined which means we have the standard width
        //    $colWidthPixels = 60; //pixels, this is the standard width of an Excel cell in pixels = 9.140625 char units outer size
        //}
        //$offsetX = $colWidthPixels - $drawing->getWidth(); //pixels
        //$drawing->setOffsetX($offsetX); //pixels
        return $spreadsheet;
    }
    public function reportePacientes($startDate,$endDate)
    {

        $spreadsheet = new Spreadsheet();
        $titulo_reporte = 'REPORTE DE PACIENTES';
        /* ;
        $spreadsheet = $this->reporte_citas(
            $spreadsheet,
            $startDate,
            $endDate,
            $titulo_reporte
        ); */
        $spreadsheet = $this->reporteCitas_detalle_totalCitasCreadasGerentes(
            $spreadsheet,
            $startDate,
            $endDate
        );
        //$spreadsheet->createSheet(1);
        //$spreadsheet->setActiveSheetIndex(1);
        $sheet = $spreadsheet->getActiveSheet();
        /* $spreadsheet = $this->reporteCitas_detalle_totalCitasXMedico(
            $spreadsheet,
            $startDate,
            $endDate
        );
        $spreadsheet->setActiveSheetIndex(0);
        $sheet = $spreadsheet->getActiveSheet(); */


        //GUARDAR EL DOCUMENTO
        $writer = new Xlsx($spreadsheet);
        $fileName = str_replace(" ","_",$titulo_reporte).'_del_'.$startDate."_al_".$endDate.'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        //$writer->save($filename);
        $writer->save('php://output');
        exit();
       // return $model;
    }

}
