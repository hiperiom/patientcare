<?php

namespace App\Http\Controllers;

use App\Models\CentroSalud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CentroDeSaludController extends Controller
{
    public function index()
    {
        $centro_salud = CentroSalud::all();
        return view('centro_salud.index', compact('centro_salud'));
    }

    public function create()
    {
        return view('centro_salud.create');
    }

    public function store(Request $request)
    {

        $request['created_at']= "2022-02-16";
        $request['updated_at']= "2022-02-16";

        CentroSalud::create($request->all());
        return redirect('centro_salud')->with('mensaje', 'Centro de Salud creada con éxito');
    }

    public function show($id)
    {
        $centro_salud = CentroSalud::find($id);
        return view('centro_salud.show', compact('centro_salud'));
    }

    public function edit($id)
    {
        $data = CentroSalud::findOrFail($id);
        return view('centro_salud.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        CentroSalud::findOrFail($id)->update($request->all());
        return redirect('centro_salud')->with('mensaje', 'Centro de salud se actualizo con éxito');
    }

    public function destroy(CentroSalud $id)
    {        
        $id->delete();

        Cache::flush();

        return redirect()->route('centro_salud.index')->with('eliminar', 'ok');
    }
}
