<?php

namespace App\Http\Controllers;

use App\Models\UserCuestVinculoInstitucion;
use Illuminate\Http\Request;

class UserCuestVinculoInstitucionController extends Controller
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
        if ($request->cat_user_cuestionario_1=="Si") {
            if(empty(UserCuestVinculoInstitucion::where('cat_user_cuestionario_id',1)->where('user_id',$request->user_id)->count()))
            {
                $model = new UserCuestVinculoInstitucion();
                $model->cat_user_cuestionario_id = 1;
                $model->user_id = $request->user_id;
                $model->save();
            }
        }

        if ($request->cat_user_cuestionario_2=="Si") {
            if(!empty(UserCuestVinculoInstitucion::where('cat_user_cuestionario_id',2)->where('user_id',$request->user_id)->count()))
            {
                $model           = UserCuestVinculoInstitucion::where('cat_user_cuestionario_id',2)->where('user_id',$request->user_id);
                $model->update(
                    [
                        'nombre' => $request->cat_user_cuestionario_4,
                        'telefono' => $request->cat_user_cuestionario_5,
                        'correo' => $request->cat_user_cuestionario_6,

                    ]);
            }else
            {
                $model = new UserCuestVinculoInstitucion();
                $model->cat_user_cuestionario_id = 2;
                $model->nombre                   = $request->cat_user_cuestionario_4;
                $model->telefono                 = $request->cat_user_cuestionario_5;
                $model->correo                   = $request->cat_user_cuestionario_6;
                $model->user_id                  = $request->user_id;
                $model->save();
            }
        }
        if ($request->cat_user_cuestionario_3=="Si") {
            if(!empty(UserCuestVinculoInstitucion::where('cat_user_cuestionario_id',3)->where('user_id',$request->user_id)->count()))
            {
                $model           = UserCuestVinculoInstitucion::where('cat_user_cuestionario_id',3)->where('user_id',$request->user_id);
                $model->update(
                    [
                        'nombre' => $request->cat_user_cuestionario_8,
                        'telefono' => $request->cat_user_cuestionario_9,
                        'correo' => $request->cat_user_cuestionario_10,

                    ]);
            }else
            {
                $model = new UserCuestVinculoInstitucion();
                $model->cat_user_cuestionario_id = 3;
                $model->nombre                   = $request->cat_user_cuestionario_8;
                $model->telefono                 = $request->cat_user_cuestionario_9;
                $model->correo                   = $request->cat_user_cuestionario_10;
                $model->user_id                  = $request->user_id;
                $model->save();
            }
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return UserCuestVinculoInstitucion::show($request);
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
