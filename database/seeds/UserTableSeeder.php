<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*User::create(
            [
                'email' =>'test.voja@gmail.com',
                'password' =>'grgu3ky[2Qep!IVF'
            ]
        );*/
        function eliminar_acentos($cadena){
            
            //Reemplazamos la A y a
            $cadena = str_replace(
            array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
            array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
            $cadena
            );

            //Reemplazamos la E y e
            $cadena = str_replace(
            array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
            array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
            $cadena );

            //Reemplazamos la I y i
            $cadena = str_replace(
            array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
            array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
            $cadena );

            //Reemplazamos la O y o
            $cadena = str_replace(
            array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
            array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
            $cadena );

            //Reemplazamos la U y u
            $cadena = str_replace(
            array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
            array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
            $cadena );

            //Reemplazamos la N, n, C y c
            $cadena = str_replace(
            array('Ñ', 'ñ', 'Ç', 'ç'),
            array('N', 'n', 'C', 'c'),
            $cadena
            );
            
            return $cadena;
        }
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
            User::create(
                [
                    'email' => strtolower( eliminar_acentos( str_replace(" ","",$model[$i]) ) ) .  "@schacao.com",
                    'password' =>'123456'
                ]
            );    
        }
        
        
        /*User::create(
            [
                'email' =>'luis.parodi@cmdlt.edu.ve',
                'password' =>'123456'
            ]
        );
        User::create(
            [
                'email' =>'achacon.1986@outlook.com',
                'password' =>'123456'
            ]
        );*/
        /*User::create(
            [
                'email' =>'jacostamd@gmail.com',
                'password' =>'Jya.0411'
            ]
        );*/
        /*User::create(
            [
                'email' =>'maggiecmr@yahoo.com',
                'password' =>'md064000'
            ]
        );


        User::create(
            [
                'email' =>'valentinanegrinperez@gmail.com',
                'password' =>'45tz3474'
            ]
        );
        User::create(
            [
                'email' =>'josedavidrdgz18@gmail.com',
                'password' =>'valentina'
            ]
        );
        User::create(
            [
                'email' =>'omarcs2424@gmail.com',
                'password' =>'valentina'
            ]
        );
        User::create(
            [
                'email' =>'berzedelossantos@gmail.com',
                'password' =>'v24663794'
            ]
        );
        User::create(
            [
                'email' =>'hiperiom412@gmail.com',
                'password' =>'123456'
            ]
        );
        User::create(
            [
                'email' =>'acuna.agustin@gmail.com',
                'password' =>'123456'
            ]
        );
       
        User::create(
            [
                'email' =>'pmolina@parodisolutions.com',
                'password' =>'123456'
            ]
        );
        User::create(
            [
                'email' =>'maggiecmr76@gmail.com',
                'password' =>'123456'
            ]
        );*/

    }
}
