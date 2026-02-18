<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use App\Models\UserCuestImagen;
use Illuminate\Http\Request;

class UserCuestImagenController extends Controller
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
        return UserCuestImagen::store($request);
    }
    public function store_cita(Request $request)
    {
        return UserCuestImagen::store_cita($request);
    }
    public function index_by_cita($cita_id)
    {
        return UserCuestImagen::index_by_cita($cita_id);
    }
    public function update(Request $request, $id)
    {

        return UserCuestImagen::actualizar($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return UserCuestImagen::eliminar($id);
    }
}
