<?php

namespace App\Http\Controllers;

use App\Models\TarjetaSoyChacao;
use Illuminate\Http\Request;

class TarjetaSoyChacaoController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TargetaSoyChacao  $targetaSoyChacao
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $model = TarjetaSoyChacao::where("user_id_paciente",$user_id)->first();
        if (is_null($model['description']) || $model['description']=="undefined" || $model['description']=="null" ) {
            $model['description']="";
        }
        //dd($model);
        return Response()->json( $model  );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TargetaSoyChacao  $targetaSoyChacao
     * @return \Illuminate\Http\Response
     */
    public function edit(TarjetaSoyChacao $targetaSoyChacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TargetaSoyChacao  $targetaSoyChacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TarjetaSoyChacao $targetaSoyChacao)
    {
        //
    }
    public function update_item(Request $request)
    {
        return Response()->json(TarjetaSoyChacao::update_item($request) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TargetaSoyChacao  $targetaSoyChacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(TarjetaSoyChacao $targetaSoyChacao)
    {
        //
    }
}
