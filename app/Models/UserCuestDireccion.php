<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserCuestDireccion extends Model
{
    protected $table ="user_cuest_direction";
    protected $fillable = [
        "cat_estado_id",
        "cat_municipio_id",
        "description",
        "domicilio",
        "user_id",
    ];
    static function store(Request $request)
    {
        $model = new UserCuestDireccion();
        $model::updateOrCreate(
            [
                'user_id'=>$request->user_id
            ],
            [
                'cat_estado_id'=> isset($request->cat_estado_id)?$request->cat_estado_id:null,
                'cat_municipio_id'=> isset($request->cat_municipio_id)?$request->cat_municipio_id:null,
                'description'=> isset($request->description)?$request->description:null,
                'domicilio'=> isset($request->domicilio)?$request->domicilio:null,
                'user_id'=> isset($request->user_id)?$request->user_id:null,
            ]);

        return UserCuestDireccion::show($request->user_id);
    }
    static function update_item(Request $request){
        $model = UserCuestDireccion::updateOrCreate(
            ["user_id" => $request->user_id],
            [
                $request->field => $request->value,
                "user_id" => $request->user_id
            ]
        );
        return Response()->json($model) ;

    }
    static function actualizar(Request $request)
    {
        $model = new UserCuestDireccion();
        $model::updateOrCreate(
            [
                'user_id'=>$request->user_id
            ],
            [
                'cat_estado_id'=> isset($request->cat_estado_id)?$request->cat_estado_id:null,
                'cat_municipio_id'=> isset($request->cat_municipio_id)?$request->cat_municipio_id:null,
                'description'=> isset($request->description)?$request->description:null,
                'domicilio'=> isset($request->domicilio)?$request->domicilio:null,
                'user_id'=> isset($request->user_id)?$request->user_id:null,
            ]);

        return UserCuestDireccion::show($request->user_id);
    }
    static function show($user_id)
    {
        return UserCuestDireccion::where('user_id',$user_id)->first();
    }
}
