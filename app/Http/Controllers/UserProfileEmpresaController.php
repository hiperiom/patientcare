<?php

namespace App\Http\Controllers;

use App\Models\UserProfileEmpresa;
use App\Models\UserEmpresa;
use App\Models\UserOrientacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserProfileEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getByCedula($cedula)
    {
        $model = new UserProfileEmpresa();
        $model = $model->where("cedula",$cedula);
        $model = $model->select(
            DB::raw("user_profile_empresa.id AS user_id_paciente"),
            DB::raw("user_profile_empresa.cedula AS cedula"),
            DB::raw("user_profile_empresa.nombres AS nombres"),
            DB::raw("user_profile_empresa.apellidos AS apellidos"),
            DB::raw("user_profile_empresa.genero AS genero"),
            DB::raw("user_profile_empresa.telefono_movil AS telefono_movil"),
            DB::raw("user_profile_empresa.correo AS correo"),
        );
        $model = $model->first()->toArray();
        //dd($model);
        $model2 = new UserOrientacion();
        $model2 = $model2->leftJoin("cat_empresa","user_orientacion.cat_empresa_id","cat_empresa.id");
        $model2 = $model2->leftJoin("user_profile","user_orientacion.user_id_medico","user_profile.user_id");

        $model2 = $model2->select(
            DB::raw("user_orientacion.id AS orientacion_id"),
            DB::raw("user_orientacion.fecha_orientacion"),
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
            DB::raw("cat_empresa.rif AS rif"),
            DB::raw("user_profile.nombres AS nombre_medico"),
            DB::raw("user_profile.apellidos AS apellido_medico"),
            DB::raw("user_profile.genero AS genero_medico"),
            DB::raw("user_profile.user_id")

        );
        $model2 = $model2->where("user_id_paciente", $model['user_id_paciente']);
        $model2 = $model2->get()->toArray();

        $model['orientaciones'] = $model2;

        // dd( $model);
        return Response()->json($model);
    }
    public function index($fecha_desde,$fecha_hasta)
    {
        return UserProfileEmpresa::where("user_profile_empresa.active",1)
        ->join("user_empresa","user_profile_empresa.id","user_empresa.user_id_paciente")
        ->join("cat_empresa","user_empresa.cat_empresa_id","cat_empresa.id")
        ->select(
            DB::raw("CONCAT(user_profile_empresa.nombres,' ',user_profile_empresa.apellidos) AS paciente"),
            "user_profile_empresa.*",
            DB::raw("cat_empresa.id AS cat_empresa_id"),
            DB::raw("cat_empresa.razon_social")
        )
        //->whereBetween("user_profile_empresa.created_at", [$fecha_desde.' 00:00:00', $fecha_hasta.' 23:59:59'])
        //->whereBetween("created_at", [date("Y-m-d H:i:s",strtotime($fecha_desde.' 00:00:00')), date("Y-m-d H:i:s",strtotime( $fecha_hasta.' 23:59:59'))])
        ->orderBy("user_profile_empresa.id","DESC")
        ->get();

    }
    public function showByCedula($cedula)
    {
        $model = UserProfileEmpresa::where("user_profile_empresa.active",1)
        ->where("user_profile_empresa.cedula",$cedula)
        ->join("user_empresa","user_profile_empresa.id","user_empresa.user_id_paciente")
        ->join("cat_empresa","user_empresa.cat_empresa_id","cat_empresa.id")
        ->select(
            DB::raw("CONCAT(user_profile_empresa.nombres,' ',user_profile_empresa.apellidos) AS paciente"),
            "user_profile_empresa.*",
            DB::raw("cat_empresa.id AS cat_empresa_id"),
            DB::raw("cat_empresa.razon_social")
        )
        ->orderBy("user_profile_empresa.id","DESC")
        ->first();
        return response()->json($model);
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
        //dd($request->all());
        $model = UserProfileEmpresa::firstOrCreate(
            [
                'cedula' => $request->cedula
            ],
            [
                'cedula' => $request->cedula,
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'genero' => $request->genero,
                'correo' => $request->correo,
                'cedula' => $request->cedula,
                'telefono_movil' => $request->telefono_movil,
                'created_at' => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
            ]
        );

        $user_id_paciente = $model->id;

        $model2 = UserEmpresa::firstOrCreate(
            [
                'cat_empresa_id' => $request->cat_empresa_id,
                'user_id_paciente' => $user_id_paciente,
            ],
            [
                'cat_empresa_id' => $request->cat_empresa_id,
                'user_id_paciente' => $user_id_paciente,
                'created_at' => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
            ]
        );

        return $model->fresh()->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserProfileEmpresa  $userProfileEmpresa
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfileEmpresa $userProfileEmpresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserProfileEmpresa  $userProfileEmpresa
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfileEmpresa $userProfileEmpresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserProfileEmpresa  $userProfileEmpresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //dd($request->all());
        UserProfileEmpresa::where('id', $id)
        ->update([
            'cedula' => $request->cedula,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'genero' => $request->genero,
            'correo' => $request->correo,
            'cedula' => $request->cedula,
            'telefono_movil' => $request->telefono_movil,
            'updated_at' => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
        ]);
        $user_id_paciente = $id;

        UserEmpresa::where('cat_empresa_id', $request->cat_empresa_id )
        ->where('user_id_paciente',$user_id_paciente)
        ->update( [
            'cat_empresa_id' => $request->cat_empresa_id,
            'user_id_paciente' => $user_id_paciente,
            'updated_at' => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
        ]);
        $model = $this->showByCedula($request->cedula);
        return $model;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserProfileEmpresa  $userProfileEmpresa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = UserProfileEmpresa::find($id);
        $model->delete();
        $model = UserOrientacion::where("user_id_paciente",$id);
        $model->delete();
        return response()->json($model);
    }
}
