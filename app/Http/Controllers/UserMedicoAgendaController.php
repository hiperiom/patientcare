<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\UserMedicoAgenda;
class UserMedicoAgendaController extends Controller
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
    public function getAll()
    {
        return UserMedicoAgenda::getAll();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("medico.create_agenda");
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
    public function getCitasMedico(Request $request)
    {
        //return UseCita
    }
    public function getAllByEspecialidad($cat_especialidad_id)
    {
        return UserMedicoAgenda::getAllByEspecialidad($cat_especialidad_id);
    }
    public function getAllByMedicos(Request $request)
    {

        return UserMedicoAgenda::getAllByMedicos( $request );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return UserMedicoAgenda::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return UserMedicoAgenda::getOne( $id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = UserMedicoAgenda::find($id);
        $model->delete();

        return $model;
    }
}
