<?php

use App\Models\CatUserLaboratorio;
use Illuminate\Database\Seeder;

class CatUserLaboratorioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CatUserLaboratorio::create(['description' =>'Especiales']);
        CatUserLaboratorio::create(['description' =>'Hematología']);
        CatUserLaboratorio::create(['description' =>'Inmunoquímica']);
        CatUserLaboratorio::create(['description' =>'Serología']);
    }
}
