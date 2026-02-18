<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatUserType;
class CatUserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paciente_id = CatUserType::paciente_id();
        $medico_id = CatUserType::medico_id();
        $familiar_id = CatUserType::familiar_id();
        return view("cat_user_type.index",compact("paciente_id","medico_id","familiar_id"));
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
    public function valida_tipoUsuario($tipousuario)
    {
        if (isset($tipousuario)) {
            if(
                $tipousuario >= 1 ||
                $tipousuario <= 3
            ){
                return $tipousuario;
            }else{
                return null;
            }
        }
        else{
            return null;
        }
    }
}
