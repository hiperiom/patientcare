<?php

namespace App\Http\Controllers;

use App\Models\PlanesInstitucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\PlanesCirugia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
class PlanesInstitucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_quirurgico()
    {
        return view("plan_quirurgico.index");
    }

    public function email_planes_cirugia()
    {
        return view("emails.plan_cirugia");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_quirurgico()
    {
        return view("plan_quirurgico.create");
    }
    public function getAll()
    {
        return PlanesInstitucion::where("active",1)
        ->select(
            "*",
            DB::raw("
                date_format(created_at ,'%d/%m/%Y') AS 'fecha_creacion'
            "),
            DB::raw("
                YEAR(CURDATE())-YEAR(fecha_nacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(fecha_nacimiento,'%m-%d'), 0 , -1 ) AS 'edad'
            ")
        )
        ->orderBy("id","DESC")
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_quirurgico(Request $request)
    {
        //dd($request->all());
        $model = new PlanesInstitucion();
        $model->via_comunicacion = $request->via_comunicacion;
        $model->genero = $request->genero;
        $model->nombres = $request->nombres;
        $model->apellidos = $request->apellidos;
        $model->cedula = $request->cedula;
        $model->fecha_nacimiento = $request->fecha_nacimiento;
        $model->telefono_contacto = $request->telefono_contacto;
        $model->telefono_contacto_alternativo = $request->telefono_contacto_alternativo;
        $model->email = $request->email;
        $model->tipo_procedimiento = $request->tipo_procedimiento;
        $model->medico_paciente_cmdlt = $request->medico_paciente_cmdlt;
        $model->pre_otra_inst = $request->pre_otra_inst;
        $model->nombre_especialista = $request->nombre_especialista;
        $model->presupuesto_total = (Double) $request->presupuesto_total;
        $model->detail_via_comunicacion_otra = $request->detail_via_comunicacion_otra;
        $model->save();

        Mail::to("hiperiom412@gmail.com")->queue(new PlanesCirugia( $request->all() ) );

        try {
            Mail::to($request->email)->queue(new PlanesCirugia( $request->all() ) );
        } catch (\Exception $e) {
            dd($e);
        }


        return $model;
    }
    public function updateField(Request $request)
    {
        try {
            //dd($request->all());
            $model =    PlanesInstitucion::where("id",$request->plan_id)
                        ->update([
                            $request->property => $request->value
                        ]);


            return Response()->json($model);




        } catch (\Exception $e) {
            dd($e);
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanesInstitucion  $planesInstitucion
     * @return \Illuminate\Http\Response
     */
    public function show(PlanesInstitucion $planesInstitucion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanesInstitucion  $planesInstitucion
     * @return \Illuminate\Http\Response
     */
    public function edit(PlanesInstitucion $planesInstitucion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlanesInstitucion  $planesInstitucion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlanesInstitucion $planesInstitucion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanesInstitucion  $planesInstitucion
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlanesInstitucion $planesInstitucion)
    {
        //
    }
}
