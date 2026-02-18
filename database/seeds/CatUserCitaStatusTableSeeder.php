<?php

use Illuminate\Database\Seeder;
use App\Models\CatUserCitaStatus;


class CatUserCitaStatusTableSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Creada',//1
            'Reprogramada',//2
            'Cancelada',//3
            'Aprobada',//4
            'Preconsulta',//5
            'Consulta',//6
            'Finalizada'//5
        ];
        for ($i=0; $i < count($data); $i++) {
            CatUserCitaStatus::create(['description' =>$data[$i]]);
        }
    }
}
