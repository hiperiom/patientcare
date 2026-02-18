<?php
use App\Models\CatAreaAtencion;
use Illuminate\Database\Seeder;

class CatAreaAtencionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['Consulta Externa','CE'],
            ['Emergencia','EM'],
            ['Hospitalización','HP'],
            ['Unidad de Terapia Intensiva','UTI'],
            ['Programa de Atención Domiciliaria','PAD'],
            ['Sala de Espera','SE'],
            

        ];
        for ($i=0; $i < count($data); $i++) {
            CatAreaAtencion::create(['description' =>$data[$i][0],'siglas'=> $data[$i][1]]);
        }
    }
}
