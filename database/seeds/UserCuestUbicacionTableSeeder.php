<?php

use App\Models\UserCuestUbicacion;
use App\Models\UserCuestEpisodio;
use Illuminate\Database\Seeder;

class UserCuestUbicacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 1; $i++) {
            UserCuestUbicacion::create(
            [
                    'user_id_paciente' =>$i,
                    'cat_user_ubicacion_id' =>1,
                    'value' =>'Ingreso',
                    'user_cuest_episodio_id' => UserCuestEpisodio::ultimoEpisodio_id($i),
                ]
            );
        }
       
    }
}
