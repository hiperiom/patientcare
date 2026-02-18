<?php

use App\Models\CatUserHistorial;
use Illuminate\Database\Seeder;

class CatUserHistorialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Cuenta creada',
            'Datos del paciente',
            'Datos del Familiar',
            'Vínculo con la institución',
            'Cuestionario DE riesgo COVID-19',
            'Ficha Médica',
            'Ubicación',
            'Programa de atención doliciliaria',
            'Observaciones',
            'Temperatura',
            'Oximetria',
            'Oxigenoterapia',
            'Sintomas',
            'PCR',
            'PDR',
            'TAC',
            'Chat',
        ];
        foreach ($data as $key => $value) {

            CatUserHistorial::create(['description' =>$value]);
        }
    }
}
