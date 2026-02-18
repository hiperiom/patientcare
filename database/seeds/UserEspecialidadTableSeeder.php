<?php

use App\Models\UserEspecialidad;
use Illuminate\Database\Seeder;

class UserEspecialidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        UserEspecialidad::create(
                [

                    'cat_user_especialidad_id' =>28,
                    'user_id'=> 1
                ]
            );
        UserEspecialidad::create(
                [

                    'cat_user_especialidad_id' =>28,
                    'user_id'=> 2
                ]
            );
        UserEspecialidad::create(
                [

                    'cat_user_especialidad_id' =>28,
                    'user_id'=> 3
                ]
            );
        UserEspecialidad::create(
                [

                    'cat_user_especialidad_id' =>28,
                    'user_id'=> 4
                ]
            );
        UserEspecialidad::create(
                [

                    'cat_user_especialidad_id' =>50,
                    'user_id'=> 5
                ]
            );
        UserEspecialidad::create(
                [

                    'cat_user_especialidad_id' =>50,
                    'user_id'=> 5
                ]
            );
        UserEspecialidad::create(
                [

                    'cat_user_especialidad_id' =>76,
                    'user_id'=> 6
                ]
            );
        UserEspecialidad::create(
                [

                    'cat_user_especialidad_id' =>38,
                    'user_id'=> 7
                ]
            );
        UserEspecialidad::create(
                [

                    'cat_user_especialidad_id' =>61,
                    'user_id'=> 8
                ]
            );
        UserEspecialidad::create(
                [

                    'cat_user_especialidad_id' =>38,
                    'user_id'=> 9
                ]
            );
        UserEspecialidad::create(
                [

                    'cat_user_especialidad_id' =>11,
                    'user_id'=> 10
                ]
            );
        UserEspecialidad::create(
                [

                    'cat_user_especialidad_id' =>11,
                    'user_id'=> 11
                ]
            );
        UserEspecialidad::create(
                [

                    'cat_user_especialidad_id' =>28,
                    'user_id'=> 12
                ]
            );
        UserEspecialidad::create(
                [

                    'cat_user_especialidad_id' =>28,
                    'user_id'=> 13
                ]
            );
    }
}
