<?php

namespace App\Http\Controllers;

use App\Models\CatUserUbicacion;
use App\Models\Clasificadorcie11;
use App\Models\UserCuestComorbilidad;
use App\Models\UserCuestEgreso;
use App\Models\UserCuestEpisodio;
use App\Models\UserCuestImpresionDiagnostica;
use App\Models\UserPaciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Clasificadorcie11Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id,$user_cuest_episodio_id)
    {
        $ultimo_egreso = UserCuestEpisodio::where('id',$user_cuest_episodio_id)->first();
        //dd($ultimo_egreso);
        if (is_null($ultimo_egreso)) {
            echo "<script>alert('No se encontró registro de egreso');close();</script>";
        }
        $ubicacion_actual = CatUserUbicacion::where('id',$ultimo_egreso->cat_user_ubicacion_id)
                            ->select(DB::raw("CONCAT(description,' | ',coments) AS ubicacion"))
                            ->value('ubicacion');

        $ubicacion_destino =    CatUserUbicacion::where('id',$ultimo_egreso->cat_user_ubicacion_id_destino)
                            ->select( DB::raw("CONCAT(description,' | ',coments) AS ubicacion"))->value('ubicacion');


        $paciente = UserPaciente::getInfoPaciente($user_id);
        if (count($paciente) >0) {
            $paciente = $paciente[0];
        }
        //dd($paciente);
        $impDiag = UserCuestImpresionDiagnostica::where('user_id',$user_id)->where('user_cuest_episodio_id',$ultimo_egreso->id)->get();
        $diagn_egre = UserCuestEgreso::where('user_id',$user_id)->where('user_cuest_episodio_id',$ultimo_egreso->id)->get();
        $comorbilidad = UserCuestComorbilidad::show($user_id);
        $comorbilidad = $comorbilidad->original;
        return view("component.clasificadorcie11",
            compact(
                'user_id',
                'user_cuest_episodio_id',
                'paciente',
                'impDiag',
                'comorbilidad',
                'ultimo_egreso',
                'diagn_egre',
                'ubicacion_actual',
                'ubicacion_destino',
                'ubicacion_destino'
            )
        );
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clasificadorcie11  $clasificadorcie11
     * @return \Illuminate\Http\Response
     */
    public function show(Clasificadorcie11 $clasificadorcie11)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clasificadorcie11  $clasificadorcie11
     * @return \Illuminate\Http\Response
     */
    public function edit(Clasificadorcie11 $clasificadorcie11)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clasificadorcie11  $clasificadorcie11
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clasificadorcie11 $clasificadorcie11)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clasificadorcie11  $clasificadorcie11
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clasificadorcie11 $clasificadorcie11)
    {
        //
    }
}
