<?php

use App\Models\UserMedicoPosicion;
use Illuminate\Database\Seeder;

class UserMedicoPosicionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 13; $i++) {
            UserMedicoposicion::create(
                [

                    'cat_user_medico_posicion_id' =>1,
                    'user_id'=> $i
                ]
            );
        }
    }
}
