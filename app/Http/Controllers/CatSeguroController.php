<?php

namespace App\Http\Controllers;

use App\Models\CatSeguro;
use Illuminate\Http\Request;

class CatSeguroController extends Controller
{
    public function getById(Request $request){
        // dd($request);
        return CatSeguro::where( 'id',$request->id)->first();
    }

    public function getAll(){
        return CatSeguro::where('active', 1)->orderBy('name', 'asc')->get();
    }
}
