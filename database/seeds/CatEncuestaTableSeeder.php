<?php

use App\Models\CatEncuesta;
use Illuminate\Database\Seeder;

class CatEncuestaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Hospitalización',
            'Consulta Externa',
            'Emergencia',

        ];
        for ($i=0; $i < count($data); $i++) {
            CatEncuesta::create(['description' =>$data[$i]]);
        }
    }
}
