<?php

use Illuminate\Database\Seeder;
use App\Models\CatUserEquipoSalud;
class CatUserEquipoSaludTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Médico(a)',
            'Enfermero(a)',
            'Estudiante de medicina',
            'Estudiante de enfermería',
            'Atención al paciente',
            'Residentes de Postgrado de Medicina Interna I',
            'Residentes de Postgrado de Medicina Interna II',
            'Residentes de Postgrado de Medicina Interna III',

        ];
        for ($i=0; $i < count($data); $i++) {
            CatUserEquipoSalud::create(['description' =>$data[$i]]);
        }
    }
}
