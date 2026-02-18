<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function getById(Request $request){
        // dd($request);
        return Department::where( 'id',$request->id)->first();
    }

    public function getAll(){
        return Department::where('active', 1)->orderBy('name', 'asc')->get();
    }

    public function getAllByShortname(){
        return Department::where('active', 1)->orderBy('shortname', 'asc')->get();
    }
}
