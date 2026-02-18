<?php

namespace App\Http\Controllers;

use App\Models\UserCuestEvolucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserCuestEvolucionController extends Controller
{
    public function store(Request $request)
    {
        return UserCuestEvolucion::store($request);
    }
    public function destroy($id)
    {
        return UserCuestEvolucion::eliminar($id);
    }

}
