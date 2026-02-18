<?php

use Illuminate\Database\Seeder;
use App\Models\UserCentroSalud;
class UserCentroSaludSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserCentroSalud::create(
                [

                    'centro_salud_id' =>2,//celpg
                    'user_id_paciente'=> 1
                ]
            );
        UserCentroSalud::create(
                [

                    'centro_salud_id' =>3,//altamira
                    'user_id_paciente'=> 1
                ]
            );

        UserCentroSalud::create(
                [
                    'centro_salud_id' =>2,//celpg
                    'user_id_paciente'=> 2
                ]
            );
        UserCentroSalud::create(
                [

                    'centro_salud_id' =>3,//altamira
                    'user_id_paciente'=> 3
                ]
            );
        UserCentroSalud::create(
                [

                    'centro_salud_id' =>5,//bello campo
                    'user_id_paciente'=> 3
                ]
            );
        UserCentroSalud::create(
            [

                'centro_salud_id' =>3,//altamira
                'user_id_paciente'=> 4
            ]
        );
        UserCentroSalud::create(
                [

                    'centro_salud_id' =>5,//bello campo
                    'user_id_paciente'=> 4
                ]
            );
       
        UserCentroSalud::create(
                [

                    'centro_salud_id' =>5,//bello campo
                    'user_id_paciente'=> 5
                ]
            );
       
        UserCentroSalud::create(
                [

                    'centro_salud_id' =>2,//celpg
                    'user_id_paciente'=> 6
                ]
            );
        UserCentroSalud::create(
                [

                    'centro_salud_id' =>2,//celpg
                    'user_id_paciente'=> 7
                ]
            );
        UserCentroSalud::create(
                [

                    'centro_salud_id' =>2,//celpg
                    'user_id_paciente'=> 8
                ]
            );
        UserCentroSalud::create(
                [

                    'centro_salud_id' =>2,//celpg
                    'user_id_paciente'=> 9
                ]
            );
        UserCentroSalud::create(
                [

                    'centro_salud_id' =>2,//celpg
                    'user_id_paciente'=> 10
                ]
            );
        UserCentroSalud::create(
                [

                    'centro_salud_id' =>2,//celpg
                    'user_id_paciente'=> 11
                ]
            );
        UserCentroSalud::create(
                [

                    'centro_salud_id' =>2,//celpg
                    'user_id_paciente'=> 12
                ]
            );
        UserCentroSalud::create(
                [

                    'centro_salud_id' =>3,//altamira
                    'user_id_paciente'=> 12
                ]
            );
        UserCentroSalud::create(
                [

                    'centro_salud_id' =>3,//altamira
                    'user_id_paciente'=> 13
                ]
            );
        
    }
}
