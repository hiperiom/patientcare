<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeguimientoPacientesController extends Controller
{
    public function index()
    {

        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        return view("area_seguimiento_paciente.app");
    }
}
