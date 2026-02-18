<?php

namespace App\Http\Controllers;

use App\Models\UserCuestPruebaCovid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserCuestPruebaCovidController extends Controller
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

        return UserCuestPruebaCovid::store($request);

    }
    public function store2(Request $request)
    {

        return UserCuestPruebaCovid::store2($request);

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
    public function getAllPcr(Request $request)
    {
        return UserCuestPruebaCovid::getAllPcr($request->user_id);
    }
    public function getAllPdr(Request $request)
    {
        return UserCuestPruebaCovid::getAllPdr($request->user_id);
    }
    public function sendEmailCuestionario(Request $request)
    {

        //$letra = "D";
        //$pdf = PDF::loadView('pdf', ['letra'=>$letra])->setPaper('a4', 'landscape')->setWarnings(false);
        //return $pdf->stream("hola.pdf");
        $url='pdfgenerado/'.$userPaciente->id.date('YmdHs').'.pdf';
        Storage::disk('local')->put($url, $out->output());
        //dd($tipo);
        Mail::to("hiperiom412@gmail.com")->send(new RecipesMail($recipes->consulta->paciente->profile,$url, $medico,$tipo));


        try {
            //code...
            $subject = env("APP_NAME");
            $for = $request['email'];
            Mail::send('component.email',['request' => $request], function($msj) use($subject,$for,$request){
                $msj->from(env('MAIL_NAME'),env('MAIL_FROM_NAME'));
                $msj->subject($subject);
                $msj->to($for);

                //$time = time();
                //$fecha=  date("dmYHis", $time);
                //$codigo = $this->generateRandomString();
                //$file = "covid19-".md5($for).$fecha.$codigo.".pdf";

                //$dompdf = PDF::loadView('pdf', ['letra'=>$request['recomendacion']])->setPaper('a4', 'landscape')->setWarnings(false)->save($file);
                //$pdf = $dompdf->output();

                //file_put_contents($file, $pdf);
                //$msj->attachData($pdf->output(), "filename.pdf");
                // $msj->AddAttachment($file,"Cuestionario de Riesgo COVID-19.pdf");

                $msj->attach(asset("pdf/covid19-".$request['recomendacion'].".pdf"));

            });
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
