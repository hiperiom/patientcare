<?php

use App\Models\CatUserMedicoPosicion;
use Illuminate\Database\Seeder;

class CatUserMedicoPosicionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Médico Tratante',
            'Médico Interconsultante',
            'Médico Fellow I',
            'Médico Fellow II',
            'Médico Residente I',
            'Médico Residente II',
            'Médico Residente III',
            'Médico Residente IV',
            'Médico RAMH',//Residencia Asistencial en Medicina Hospitalaria
        ];
        for ($i=0; $i < count($data); $i++) {
            CatUserMedicoPosicion::create(['description' =>$data[$i]]);
        }
    }
}
