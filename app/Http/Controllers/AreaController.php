<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Area::orderBy('name')->get();
    }
    public function app()
    {
        if (is_null(Auth()->user())) {
            return redirect('/');
        }
        return view("medico.app");
    }


}
