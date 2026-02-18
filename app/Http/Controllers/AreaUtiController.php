<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AreaUtiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        return view("area_uti.app");
    }
}
