<?php

use App\Models\CatUserAntecedente;
use Illuminate\Database\Seeder;

class CatUserAntecedenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Hipertensión arterial',
            'Diabetes',
            'Enfermedad Cardiovascular',
            'Enfermedad del sistema respiratorio'
        ];
        for ($i=0; $i < count($data); $i++) {
            CatUserAntecedente::create(['description' =>$data[$i]]);
        }
    }
}
