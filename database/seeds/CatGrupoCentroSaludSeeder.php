<?php

use Illuminate\Database\Seeder;
use App\Models\CatGrupoCentroSalud;
class CatGrupoCentroSaludSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "Centro Medico Docente La Trinidad",
            "Salud Chacao",
            "MyCare",
        ];
        for ($i=0; $i < count($data); $i++) {
            CatGrupoCentroSalud::create(['description' =>$data[$i]]);
        }
    }
}
