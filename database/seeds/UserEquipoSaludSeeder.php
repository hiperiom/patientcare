<?php

use App\Models\UserEquipoSalud;
use Illuminate\Database\Seeder;

class UserEquipoSaludSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        for ($i=1; $i <= 1; $i++) {
            UserEquipoSalud::create(['cat_user_equipo_salud_id' =>1,'user_id'=>$i]);
        }





    }
}
