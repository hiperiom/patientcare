<?php

namespace App\Http\Controllers;

use App\Models\UserEncuesta;
use App\Models\CentroSalud;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class UserEncuestaController extends Controller
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
    public function getAll(Request $request)
    {
        return UserEncuesta::getAll($request);
    }
    public function send_hospitalizacion(){

        $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $user = User::where("user.id",1000)
                ->join("user_profile","user.id","user_profile.user_id")
                ->select(
                    "user.email",
                    "user_profile.*"
                )
                ->first()
                ->toArray();
        $model['user'] = $user;
        $model["centro_salud"] = CentroSalud::where("id",1)->first()->toArray();
        $model["APP_URL"] = config("APP_URL");

        /* Mail::send('emails.mensaje_encuesta_hospitalizacion', ["model"=>$model], function ($message) {
            $message->to( "hiperiom412@gmail.com" )
            ->subject( "Encuesta de Hospitalización CMDLT" );
            //->attachData($pdf->output(), $model['subject'].".pdf");
        }); */
        return view("emails.mensaje_encuesta_hospitalizacion", compact('model'));

        /* $pdf = PDF::loadView('pdf.encuesta_egreso',["model"=>[]]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream("Informe_Preliminar_seguro.pdf"); */


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
        return UserEncuesta::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserEncuesta  $userEncuesta
     * @return \Illuminate\Http\Response
     */
    public function show(UserEncuesta $userEncuesta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserEncuesta  $userEncuesta
     * @return \Illuminate\Http\Response
     */
    public function edit(UserEncuesta $userEncuesta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserEncuesta  $userEncuesta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserEncuesta $userEncuesta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserEncuesta  $userEncuesta
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserEncuesta $userEncuesta)
    {
        //
    }
}
