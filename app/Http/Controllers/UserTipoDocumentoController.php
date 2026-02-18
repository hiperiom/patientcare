<?php

namespace App\Http\Controllers;

use App\Models\UserTipoDocumento;
use App\Models\CatTipoDocumento;;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class UserTipoDocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $medico = UserProfile::where("user_profile.user_id",Auth::id())
                ->join("user_especialidad","user_profile.user_id","user_especialidad.user_id")
                ->join("cat_user_especialidad","user_especialidad.cat_user_especialidad_id","cat_user_especialidad.id")
                ->select(

                DB::raw("
                    CONCAT(
                        user_profile.nombres,
                        ' ',
                        user_profile.apellidos
                    ) AS 'MEDICO'
                "),
                DB::raw("
                    CONCAT(
                        user_profile.nacionalidad,
                        '-',
                        FORMAT(user_profile.cedula, 0, 'de_DE')
                    ) AS 'CEDULA'
                "),
                "user_profile.*"
            )
            ->first()
            ->toArray();

        return UserTipoDocumento::firstOrCreate([
            "user_cuest_episodio_id"=> $request->episodio_id,
            "cat_tipo_documento_id"=> CatTipoDocumento::where("description","Informe Preliminar de Emergencia")->value("id"),
            "active"=>1
        ],[
            "user_cuest_episodio_id"=> $request->episodio_id,
            "cat_tipo_documento_id"=> CatTipoDocumento::where("description","Informe Preliminar de Emergencia")->value("id"),
            "user_id_paciente"=>$request->user_id_paciente,
            "user_id_medico"=>Auth::id(),
            "sello"=>$medico['sello'],
            "firma"=>$medico['firma']
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserTipoDocumento  $userTipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function show($episodio_id)
    {
        return UserTipoDocumento::where("user_cuest_episodio_id", $episodio_id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserTipoDocumento  $userTipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function edit(UserTipoDocumento $userTipoDocumento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserTipoDocumento  $userTipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserTipoDocumento $userTipoDocumento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserTipoDocumento  $userTipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTipoDocumento $userTipoDocumento)
    {
        //
    }
}
