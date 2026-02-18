<?php

use App\Models\CatUserSintoma;
use Illuminate\Database\Seeder;

class CatUserSintomaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Adenopatias',
            'Altralgia',
            'Anosmia',
            'Asintomático',
            'Cansancio',
            'Cefalea',
            'Diarrea',
            'Disfagia',
            'Disnea',

            'Dolor abdominal',
            'Dolor Toracico',
            'Esplenomegalia',
            'Fatiga',
            'Fiebre',
            'Hemoptisis',
            'Hepatomegalia',
            'Hipo',
            'Mialgia',

            'Nausea',
            'Odinofagia',
            'Perdida del gusto',
            'Rinorrea',
            'Tos Productiva',
            'Tos seca',
            'Otros',
        ];
        for ($i=0; $i < count($data); $i++) {
            CatUserSintoma::create(['description' =>$data[$i]]);
        }
    }
}
