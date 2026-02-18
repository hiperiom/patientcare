<?php

use App\Models\CatSystemIncidenciaType;
use Illuminate\Database\Seeder;

class CatSystemIncidenciaTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CatSystemIncidenciaType::create(['description' =>'Actualización']);
        CatSystemIncidenciaType::create(['description' =>'Error']);
        CatSystemIncidenciaType::create(['description' =>'Información']);
        CatSystemIncidenciaType::create(['description' =>'Mejora']);
        CatSystemIncidenciaType::create(['description' =>'Novedad']);
        CatSystemIncidenciaType::create(['description' =>'Recomendación']);
        CatSystemIncidenciaType::create(['description' =>'Solicitud']);
        CatSystemIncidenciaType::create(['description' =>'Sugerencia']);
    }
}
