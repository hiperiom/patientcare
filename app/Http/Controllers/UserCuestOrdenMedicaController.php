<?php

namespace App\Http\Controllers;

use App\Models\UserCuestOrdenMedica;
use Illuminate\Http\Request;

class UserCuestOrdenMedicaController extends Controller
{
    public function store(Request $request)
    {
        return UserCuestOrdenMedica::store($request);
    }
    public function destroy($id)
    {
        return UserCuestOrdenMedica::eliminar($id);
    }
   
}
