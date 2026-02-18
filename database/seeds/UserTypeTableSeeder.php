<?php

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $model =[        
            
            "Stefania Robles",
            "Rocnel Amundaray",
            "Nina Blanco",
            "Luis Herrera",
            "Nairobis Godoy Pediatra",
            "Heidy García",
            "Rosana García",
            "Eugenia Díaz",
            "María Zambrano",
            "Wilfredo García",
            "Andreina Putignano",
            "Julio Jaramillo",
            "Miguel Mijares",
        ];

        for ($i=0; $i <count($model) ; $i++) { 
            UserType::create(
                [
                    'user_id' =>$i+1,
                    'cat_user_type_id' =>2
                ]
            );
            UserType::create(
                [
                    'user_id' =>$i+1,
                    'cat_user_type_id' =>1
                ]
            );
        }
        /*UserType::create(
            [
                'user_id' =>2,
                'cat_user_type_id' =>2
            ]
        );
        UserType::create(
            [
                'user_id' =>3,
                'cat_user_type_id' =>2
            ]
        );
        UserType::create(
            [
                'user_id' =>3,
                'cat_user_type_id' =>1
            ]
        );
        UserType::create(
            [
                'user_id' =>4,
                'cat_user_type_id' =>2
            ]
        );
        UserType::create(
            [
                'user_id' =>5,
                'cat_user_type_id' =>2
            ]
        );
        UserType::create(
            [
                'user_id' =>6,
                'cat_user_type_id' =>2
            ]
        );
        UserType::create(
            [
                'user_id' =>7,
                'cat_user_type_id' =>2
            ]
        );
        UserType::create(
            [
                'user_id' =>8,
                'cat_user_type_id' =>2
            ]
        );
        UserType::create(
            [
                'user_id' =>9,
                'cat_user_type_id' =>2
            ]
        );
        UserType::create(
            [
                'user_id' =>10,
                'cat_user_type_id' =>1
            ]
        );
        UserType::create(
            [
                'user_id' =>11,
                'cat_user_type_id' =>2
            ]
        );
        UserType::create(
            [
                'user_id' =>12,
                'cat_user_type_id' =>2
            ]
        );
        UserType::create(
            [
                'user_id' =>13,
                'cat_user_type_id' =>2
            ]
        );*/
    }
}
