<?php

use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class UserProfileTableSeeder extends Seeder
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
            $fullName = explode(" ",$model[$i]);
            UserProfile::create(
                [
                    'nombres' =>$fullName[0],
                    'apellidos' =>$fullName[1],
                    'cedula' =>$i+1,
                    'fnacimiento' =>'2000-01-01',
                    'genero' =>'m',
                    'telefono_movil' =>'04122331040',
                    'user_id'=> $i+1
                ]
            );
        }


        
         /*UserProfile::create(
            [
                'nombres' =>'Luis',
                'apellidos' =>'Parodi',
                'cedula' =>'775864',
                'fnacimiento' =>'1964-09-25',
                'genero' =>'m',
                'telefono_movil' =>'04122331040',
                'user_id'=> 2
            ]
        );
       UserProfile::create(
            [
                'nombres' =>'Avimar',
                'apellidos' =>'Chacón',
                'cedula' =>'18001064',
                'fnacimiento' =>'1986-05-19',
                'genero' =>'f',
                'telefono_movil' =>'584122846272',
                'user_id'=> 3
            ]
        );*/
        /*UserProfile::create(
            [
                'nombres' =>'Juan',
                'apellidos' =>'Acosta',
                'cedula' =>'7758648',
                'fnacimiento' =>'1964-09-25',
                'genero' =>'m',
                'telefono_movil' =>'04122331040',
                'user_id'=> 4
            ]
        );*/
        /*UserProfile::create(
            [
                'nombres' =>'Maggie',
                'apellidos' =>'Machado Rodríguez',
                'cedula' =>'12297242',
                'fnacimiento' =>'1976-03-23',
                'genero' =>'f',
                'telefono_movil' =>'04142022544',
                'user_id'=> 5
            ]
        );
        UserProfile::create(
            [
                'nombres' =>'Valentina Del Carmen',
                'apellidos' =>'Negrin Perez',
                'cedula' =>'27670307',
                'fnacimiento' =>'2000-10-20',
                'genero' =>'f',
                'telefono_movil' =>'04242181883',
                'user_id'=> 6
            ]
        );
        UserProfile::create(
            [
                'nombres' =>'Jose David',
                'apellidos' =>'Rodriguez Delgado',
                'cedula' =>'29551494',
                'fnacimiento' =>'2001-01-18',
                'genero' =>'m',
                'telefono_movil' =>'04125724000',
                'user_id'=> 7
            ]
        );
        UserProfile::create(
            [
                'nombres' =>'Omar Augustu',
                'apellidos' =>'Contreras Sánchez',
                'cedula' =>'28015787',
                'fnacimiento' =>'1999-02-22',
                'genero' =>'m',
                'telefono_movil' =>'04242902049',
                'user_id'=> 8
            ]
        );
        UserProfile::create(
            [
                'nombres' =>'Berzeliuz',
                'apellidos' =>'Fajardo',
                'cedula' =>'24663794',
                'fnacimiento' =>'1995-12-06',
                'genero' =>'f',
                'telefono_movil' =>'04141416782',
                'user_id'=> 9
            ]
        );
        UserProfile::create(
            [
                'nombres' =>'Ranses',
                'apellidos' =>'Jimenez Domínguez',
                'cedula' =>'22014778',
                'fnacimiento' =>'1984-10-06',
                'genero' =>'m',
                'telefono_movil' =>'04149320905',
                'user_id'=> 10
            ]
        );
        UserProfile::create(
            [
                'nombres' =>'Agustin',
                'apellidos' =>'Acuña',
                'cedula' =>'500000000',
                'fnacimiento' =>'1984-10-06',
                'genero' =>'m',
                'telefono_movil' =>'04149320905',
                'user_id'=> 11
            ]
        );
        UserProfile::create(
            [
                'nombres' =>'Patricia',
                'apellidos' =>'Molina',
                'cedula' =>'500000001',
                'fnacimiento' =>'1984-10-06',
                'genero' =>'f',
                'telefono_movil' =>'04149320905',
                'user_id'=> 12
            ]
        );
        UserProfile::create(
            [
                'nombres' =>'Maggie',
                'apellidos' =>'Machado Rodríguez',
                'cedula' =>'12297241',
                'fnacimiento' =>'1976-03-23',
                'genero' =>'f',
                'telefono_movil' =>'04142022544',
                'user_id'=> 13
            ]
        );*/
    }
}
