<?php

namespace App\Http\Controllers;

use App\Models\UserOrientacion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use SplFileInfo;
class UserOrientacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($fecha_desde,$fecha_hasta)
    {
        return UserOrientacion::where("active",1)

            ->whereBetween("created_at", [$fecha_desde.' 00:00:00', $fecha_hasta.' 23:59:59'])
            ->orderBy("created_at","DESC")
            ->get();
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
    public function getByRango($fecha_desde,$fecha_hasta)
    {
        $model = new UserOrientacion();
        $model = $model->leftJoin("cat_empresa","user_orientacion.cat_empresa_id","cat_empresa.id");
        $model = $model->leftJoin("user_profile_empresa","user_orientacion.user_id_paciente","user_profile_empresa.id");
        $model = $model->leftJoin("user_profile","user_orientacion.user_id_medico","user_profile.user_id");
        $model = $model->select(
            DB::raw("user_orientacion.id AS orientacion_id"),
            DB::raw("user_orientacion.user_id_paciente AS user_id_paciente"),
            DB::raw("user_profile_empresa.cedula AS cedula"),
            DB::raw("user_profile_empresa.nombres AS nombres"),
            DB::raw("user_profile_empresa.apellidos AS apellidos"),
            DB::raw("user_profile_empresa.genero AS genero"),
            DB::raw("user_profile_empresa.telefono_movil AS telefono_movil"),
            DB::raw("user_profile_empresa.correo AS correo"),
            DB::raw("user_orientacion.fecha_orientacion"),
            DB::raw("user_profile.nombres AS nombre_medico"),
            DB::raw("user_profile.apellidos AS apellido_medico"),
            DB::raw("user_profile.genero AS genero_medico"),
            DB::raw("user_orientacion.user_id_medico"),
            DB::raw("
                CASE
                    WHEN cat_tipo_orientacion = 1 THEN 'Crecimiento Personal'
                    WHEN cat_tipo_orientacion = 2 THEN 'Salud'
                    ELSE NULL
                END as tipo_orientacion
            "),
            DB::raw("
                CASE
                    WHEN cat_tipo_comunicacion = 1 THEN 'Videollamada Pstelemed'
                    WHEN cat_tipo_comunicacion = 2 THEN 'Chat Motivapp'
                    WHEN cat_tipo_comunicacion = 3 THEN 'Chat Whatsapp'
                    WHEN cat_tipo_comunicacion = 4 THEN 'Llamada Telefónica'
                    WHEN cat_tipo_comunicacion = 5 THEN 'Llamada Whatsapp'
                    ELSE NULL
                END as tipo_comunicacion
            "),
            DB::raw("cat_empresa.razon_social AS empresa"),
            DB::raw("cat_empresa.rif AS rif")

        );
        $model = $model->whereBetween("fecha_orientacion", [$fecha_desde, $fecha_hasta]);
        $model = $model->get()->toArray();

        //dd( $model);
        return Response()->json($model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $model = new UserOrientacion();
        $model->cat_empresa_id = $request->cat_empresa_id;
        $model->user_id_medico = $request->user_id_medico;
        $model->user_id_paciente = $request->user_id_paciente;
        $model->cat_tipo_orientacion = $request->cat_tipo_orientacion;
        $model->cat_tipo_comunicacion = $request->cat_tipo_comunicacion;
        $model->chat = $request->chat;
        $model->comentarios = $request->comentarios;



        $files_rutas = [];
        if ($request->total_files > 0) {
            for ($i=0; $i < $request->total_files; $i++) {
                $nombre = null;
                $extension = null;
                $file = $request->file("file_".$i);
                $aleatotio = Str::random(6);
                $nombre = "img_".$aleatotio. $request->user_id_paciente . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                if (file_exists('image/user/chat_empresarial/'.$nombre)) {
                    return "archivo existe";
                }
                $file->move('image/user/chat_empresarial/', $nombre);
                $nombre ='image/user/chat_empresarial/'. $nombre;
                $extension = $file->getClientOriginalExtension();
                $public_path = public_path();
                $info = new SplFileInfo($file->getClientOriginalName());
                $files_rutas[]= json_encode(['ruta'=>$nombre,'filename'=>$file->getClientOriginalName()]);
            }
        }
        $files_rutas = json_encode($files_rutas);





        $model->files = $files_rutas;
        $model->fecha_orientacion = date('Y-m-d', strtotime(  $request->fecha_orientacion ) );
        $model->created_at = date('Y-m-d H:i:s', strtotime( $request->created_at ) );
        $model->save();
        return $model->fresh()->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserOrientacion  $userOrientacion
     * @return \Illuminate\Http\Response
     */
    public function show(UserOrientacion $userOrientacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserOrientacion  $userOrientacion
     * @return \Illuminate\Http\Response
     */
    public function edit(UserOrientacion $userOrientacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserOrientacion  $userOrientacion
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $orientacion_id)
    {

        $model = UserOrientacion::find($orientacion_id);
        $model->cat_empresa_id = $request->cat_empresa_id;
        $model->user_id_medico = $request->user_id_medico;
        $model->user_id_paciente = $request->user_id_paciente;
        $model->cat_tipo_orientacion = $request->cat_tipo_orientacion;
        $model->cat_tipo_comunicacion = $request->cat_tipo_comunicacion;
        $model->chat = $request->chat;
        $model->comentarios = $request->comentarios;



        $files_rutas = [];
        if ($request->total_files > 0) {
            for ($i=0; $i < $request->total_files; $i++) {
                $nombre = null;
                $extension = null;
                $file = $request->file("file_".$i);
                $aleatotio = Str::random(6);
                $nombre = "img_".$aleatotio. $request->user_id_paciente . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                if (file_exists('image/user/chat_empresarial/'.$nombre)) {
                    return "archivo existe";
                }
                $file->move('image/user/chat_empresarial/', $nombre);
                $nombre ='image/user/chat_empresarial/'. $nombre;
                $extension = $file->getClientOriginalExtension();
                $public_path = public_path();
                $info = new SplFileInfo($file->getClientOriginalName());
                $files_rutas[]= json_encode(['ruta'=>$nombre,'filename'=>$file->getClientOriginalName()]);
            }
        }
        $files_rutas = json_encode($files_rutas);





        $model->files = $files_rutas;
        $model->fecha_orientacion = date('Y-m-d', strtotime(  $request->fecha_orientacion ) );
        $model->created_at = date('Y-m-d H:i:s', strtotime( $request->created_at ) );
        $model->save();
        return $model->fresh()->toArray();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserOrientacion  $userOrientacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = UserOrientacion::find($id);
        $model->delete();
        return response()->json($model);
    }
}
