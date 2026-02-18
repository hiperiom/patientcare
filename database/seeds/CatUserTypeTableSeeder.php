<?php

use Illuminate\Database\Seeder;
use App\Models\CatUserType;
class CatUserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CatUserType::create(['description' =>'Paciente']);//1
        CatUserType::create(['description' =>'Médico']);//2
        CatUserType::create(['description' =>'Familiar']);//3
        CatUserType::create(['description' =>'Administrador']);//4
        CatUserType::create(['description' =>'Inactivo']);//5
        CatUserType::create(['description' =>'Atención al Paciente']);//6
       
    }
}
