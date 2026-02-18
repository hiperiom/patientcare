<?php

namespace App\Http\Controllers;

use App\Models\CatEmpresa;
use Illuminate\Http\Request;

class CatEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CatEmpresa::where("active",1)->get();
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
        $model = new CatEmpresa();
        $model->razon_social = $request->razon_social;
        $model->rif = $request->rif;
        $model->imagen = $request->razon_social;
        $model->razon_social = $request->razon_social;
        $model->created_at = date('Y-m-d H:i');
        $model->save();
        return $model->fresh();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CatEmpresa  $catEmpresa
     * @return \Illuminate\Http\Response
     */
    public function show(CatEmpresa $catEmpresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CatEmpresa  $catEmpresa
     * @return \Illuminate\Http\Response
     */
    public function edit(CatEmpresa $catEmpresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CatEmpresa  $catEmpresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CatEmpresa $catEmpresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CatEmpresa  $catEmpresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatEmpresa $catEmpresa)
    {
        //
    }

    public function getById(Request $request){
        // dd($request);
        return CatEmpresa::where( 'id',$request->id)->first();
    }

    public function getAll(){
        return CatEmpresa::where('active', 1)->orderBy('razon_social', 'asc')->get();
    }
}
