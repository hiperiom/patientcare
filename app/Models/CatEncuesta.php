<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CatEncuesta extends Model
{
    protected $table = "cat_encuesta";

    public function index()
    {
        # code...
    }
    public function store(Request $request)
    {
       $model = new CatEncuesta();
       $model->description = $request->description;
       $model->save();
       return $model;
    }
    public function show($id)
    {
        $model = CatEncuesta::where("id",$id);
        return Response()->json($model);
    }
    public function actualizar($request, $id)
    {


        foreach ($request as $key => $value) {
            if ($key !=="_token") {
                CatEncuesta::where("id",$id)
                ->update([$key => $value]);
            }
        }
        return $this->show($id);
    }
    public function eliminar($id)
    {
        $model = CatEncuesta::where("id",$id);
        $model->delete();
        return $model;
    }
}
