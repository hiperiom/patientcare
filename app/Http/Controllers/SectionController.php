<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    public function index(Request $request){
        $sections = Section::where("survey_id",$request->survey_id)->get();
        return $sections->toJson();
    }

    public function store(Request $request){

    }

    public function update(Request $request, $id){

    }

    public function destroy($id){
    }
}
