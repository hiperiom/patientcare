<?php

namespace App\Http\Controllers;

use App\Models\UserFamily;
use Illuminate\Http\Request;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class UserFamilyController extends Controller
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
        return UserFamily::store($request);
    }
    public function store_from_cita(Request $request)
    {
        $model = new UserFamily();
        $model->user_id_paciente = $request->user_id_paciente;
        $model->user_id_pariente = $request->user_id_pariente;
        $model->cat_user_family_id = $request->cat_user_family_id;
        $model->active = 1;
        $model->created_at = date("Y-m-d h:i:s");
        $model->save();

        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserFamily  $userFamily
     * @return \Illuminate\Http\Response
     */
    public function show($user_id,$cedula)
    {
        $familiares = UserFamily::where('user_family.user_id_paciente',$user_id)
            ->join("user_profile","user_family.user_id_pariente","user_profile.user_id")
            ->join("cat_user_family","user_family.cat_user_family_id","cat_user_family.id")
            ->select(
                "user_profile.cedula",
                DB::raw("user_family.active"),
                DB::raw("user_family.revisado"),
                DB::raw("user_family.revisado_fecha"),
                DB::raw("user_family.coments"),
                DB::raw("cat_user_family.id AS cat_user_family_id"),
                DB::raw("cat_user_family.description AS cat_user_family_description"),
                DB::raw("user_family.id AS user_family_id")
            )
            ->get()->toArray();

        $user_profile = new UserProfileController();
        foreach($familiares as $key => $value){

            $familiares[$key] = array_merge(
                $value,
                $user_profile->show_by_cedula($value['cedula'])[0]
            );
        }


        return $familiares;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserFamily  $userFamily
     * @return \Illuminate\Http\Response
     */
    public function edit(UserFamily $userFamily)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserFamily  $userFamily
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserFamily $userFamily)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserFamily  $userFamily
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       return  Response()->json(UserFamily::destroy($id));


    }
    public function por_revisar()
    {
        $model = new UserFamily();

        $model = $model->join("user_profile AS upPac", 'user_family.user_id_paciente','upPac.user_id');
        $model = $model->join("user_profile AS upPaR", 'user_family.user_id_pariente','upPaR.user_id');
        $model = $model->join("cat_user_family AS cuf", 'user_family.cat_user_family_id','cuf.id');



        $model = $model->where('user_family.revisado',0);
        $model = $model->where('user_family.active',1);

        $model = $model->select(
            DB::raw("
                (
                    SELECT upi.value
                    FROM user_profile_images AS upi
                    WHERE upi.user_id_paciente = user_family.user_id_pariente
                    AND upi.coments = 'partidaNacimiento'
                    AND upi.active = 1
                ) AS partidaNacimiento_pariente
            "),
            DB::raw("
                (
                    SELECT upi.value
                    FROM user_profile_images AS upi
                    WHERE upi.user_id_paciente = user_family.user_id_pariente
                    AND upi.coments = 'imgSoyChacao'
                    AND upi.active = 1
                ) AS imgSoyChacao_pariente
            "),
            DB::raw("
                (
                    SELECT upi.value
                    FROM user_profile_images AS upi
                    WHERE upi.user_id_paciente = user_family.user_id_pariente
                    AND upi.coments = 'imgDocIdentidad'
                    AND upi.active = 1
                ) AS imgDocIdentidad_pariente
            "),
            DB::raw("
                (
                    SELECT upi.value
                    FROM user_profile_images AS upi
                    WHERE upi.user_id_paciente = user_family.user_id_paciente
                    AND upi.coments = 'partidaNacimiento'
                    AND upi.active = 1
                ) AS partidaNacimiento_paciente
            "),
            DB::raw("
                (
                    SELECT upi.value
                    FROM user_profile_images AS upi
                    WHERE upi.user_id_paciente = user_family.user_id_paciente
                    AND upi.coments = 'imgSoyChacao'
                    AND upi.active = 1
                ) AS imgSoyChacao_paciente
            "),
            DB::raw("
                (
                    SELECT upi.value
                    FROM user_profile_images AS upi
                    WHERE upi.user_id_paciente = user_family.user_id_paciente
                    AND upi.coments = 'imgDocIdentidad'
                    AND upi.active = 1
                ) AS imgDocIdentidad_paciente
            "),
            DB::raw("
            YEAR(CURDATE())-YEAR(upPaR.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(upPaR.fnacimiento,'%m-%d'), 0 , -1 ) AS edad
            "),
            DB::raw("
                CONCAT(
                    upPac.nombres,
                    ' ',
                    upPac.apellidos
                ) AS paciente
            "),
            DB::raw("
                CONCAT(upPac.nacionalidad,'',FORMAT(upPac.cedula, 0, 'de_DE') ) AS cedula_paciente
            "),
            DB::raw("
                CONCAT(
                    upPaR.nombres,
                    ' ',
                    upPaR.apellidos
                ) AS pariente
            "),
            DB::raw("
                CONCAT(upPaR.nacionalidad,'',FORMAT(upPaR.cedula, 0, 'de_DE')) AS cedula_pariente
            "),
            DB::raw("cuf.description AS cat_user_family_description"),
            "user_family.id",
            "user_family.user_id_pariente",
            "user_family.user_id_paciente",
            "user_family.revisado",
            "user_family.cat_user_family_id",
            "user_family.user_id_medico",
            DB::raw("CONVERT(user_family.active, UNSIGNED INTEGER) AS active"),
            "user_family.created_at",
            "user_family.updated_at",
            "user_family.deleted_at"
        );

        $model = $model->get();

        return $model;
    }
    public function update_revisado(Request $request)
    {
        $model = UserFamily::find($request->user_family_id);
        $model->coments = $request->coments;
        $model->revisado = $request->revisado;
        $model->revisado_fecha = date("Y-m-d h:i:s");
        $model->user_id_revisado_por = Auth::id();
        $model->active = $request->active;
        $model->save();
        return $model;
    }
}
