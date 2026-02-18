<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\UserCuestDireccion;
use App\Models\UserCuestEpisodio;
use App\Models\UserCuestMedicoPaciente;
use App\Models\UserCuestUbicacion;
use App\Models\UserEspecialidad;
use App\Models\UserProfile;
use App\Models\UserCuestAlert;
use App\Models\UserType;
use App\Models\UserVip;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CitaController extends Controller
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
    public function status(Request $request)
    {
        // dd($request->all());

        $model = Cita::find($request->cita_id);

        // $model->status = $request->status;
        $model->status = $request->cat_user_cita_status_id;

        $model->save();

       return Response()->json($model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reprogramar(Request $request){
        $model = Cita::find($request->cita_id);

        $model->status = $request->status;

        $model->save();

        return Response()->json($model);
    }
    public function store(Request $request)
    {

        $model = new User();
        $model::updateOrCreate([
            'email'   => $request->email,
        ],[
            'email'     => $request->email,
            'password' => "123456",
            'user_id_medico' => Auth::id(),
            "created_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))
        ]);

        $user_id = User::where("email",$request->email)->value('id');
        $request->merge(["user_id_paciente"=>$user_id]);
        $request->merge(["user_id"=>$user_id]);

        $model = new UserType();
        $model::updateOrCreate([
            'user_id'   => $user_id,
        ],[
            'user_id'     => $user_id,
            'cat_user_type_id' => 1,
            'user_id_medico' => Auth::id(),
            "created_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))
        ]);

        $model = new UserCuestEpisodio();
        $request->merge(["value"=>"Ingreso"]);
        $model::store($request);

        $episodio_id = UserCuestEpisodio::ultimoEpisodio_id($user_id);

        $model = new UserVip();
        $request->merge(["value"=>0]);
        $model::store($request);

        $model = new UserCuestAlert();
        $request->merge(["alert"=>1]);
        $model::store($request);

        $model = new UserProfile();
        $model::store($request);

        $model = new UserCuestDireccion();
        $model::store($request);

        $request->merge(["cat_user_especialidad_id"=>67]);
        $model = new UserEspecialidad();
        $model::store($request);

        $request->merge(["position_id"=>1]);

        $model = new UserCuestMedicoPaciente();
        $model::store($request);

        $request->merge(["value"=>"Ingreso Consulta Externa"]);
        $request->merge(["cat_user_ubicacion_id"=>387]);
        $model = new UserCuestUbicacion();
        $model::store2($request);


        $model = new Cita();
        $model::store($request);


        return Response()->json(true);
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
}
