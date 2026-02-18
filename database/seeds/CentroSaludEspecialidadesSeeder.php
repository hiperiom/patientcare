<?php

use Illuminate\Database\Seeder;
use App\Models\CentroSaludEspecialidades;
class CentroSaludEspecialidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $centro_salud_id = config("app.APP_GRUPO_CENTRO_SALUD_ID");
        if ($centro_salud_id == 2) {
            $data = [
                //CELPG
                [$centro_salud_id,32],//medicina interna
                [$centro_salud_id,28],//Ginecología y Obstetricia
                [$centro_salud_id,45],//Oftalmología
                [$centro_salud_id,55],//Psiquiatría
                [$centro_salud_id,73],//Psicologia infantil y Adultos
                [$centro_salud_id,26],//Gastroenterología
                [$centro_salud_id,72],//Odontología general y pediátrica
                [$centro_salud_id,23],// Fisiatría
                [$centro_salud_id,70],// Ecosonografía
                [$centro_salud_id,71],//Inmunología*/

                //ALTAMIRA
                [3,32],//medicina interna
                [3,28],//Ginecología y Obstetricia
                [3,50],//Pediatría
                [3,45],//Oftalmología
                [3,55],//Psiquiatría
                [3,73],//Psicologia infantil y Adultos
                [3,26],//Gastroenterología
                [3,74],//Mastología
                [3,59],//Traumatología
                [3,42],//Odontología

                //VISITECA
                [4,32],//medicina interna
                [4,28],//Ginecología y Obstetricia
                [4,11],//Cirugía General
                [4,75],//Cirugia Plastica Reconstructiva
                [4,61],//Urologia
                [4,49],//Otorrinolaringologia
                [4,22],//Endocrinologia
                [4,76],//Pediatria y Neonatologia

                //BELLO CAMPO
                [5,32],//medicina interna
                [5,28],//Ginecología y Obstetricia
                [5,50],//Pediatría
                [5,26],//Gastroenterología
                [5,59],//Traumatología
                [5,42],//Odontología
                [5,69],//Endodoncia
                [5,77],//Fisioterapia

                //PEDREGAL
                [7,32],//medicina interna
                [7,28],//Ginecología y Obstetricia

                //EL BOSQUE
                [6,31],//medicina General

                //SALUD CHACAO
                [8,50],//medicina General

            ];
        }

        if ($centro_salud_id == 1) {
            $data = [
            
                //CMDLT
                [$centro_salud_id,1],  
                [$centro_salud_id,2],  
                [$centro_salud_id,3],  
                [$centro_salud_id,4],  
                [$centro_salud_id,5],  
                [$centro_salud_id,6],  
                [$centro_salud_id,7],  
                [$centro_salud_id,8],  
                [$centro_salud_id,9],  
                [$centro_salud_id,10],  
                [$centro_salud_id,11],  
                [$centro_salud_id,12],  
                [$centro_salud_id,13],  
                [$centro_salud_id,14],  
                [$centro_salud_id,15],  
                [$centro_salud_id,16],  
                [$centro_salud_id,17],  
                [$centro_salud_id,18],  
                [$centro_salud_id,19],  
                [$centro_salud_id,20],  
                [$centro_salud_id,21],  
                [$centro_salud_id,22],  
                [$centro_salud_id,23],  
                [$centro_salud_id,24],  
                [$centro_salud_id,25],  
                [$centro_salud_id,26],  
                [$centro_salud_id,27],  
                [$centro_salud_id,28],  
                [$centro_salud_id,29],  
                [$centro_salud_id,30],  
                [$centro_salud_id,31],  
                [$centro_salud_id,32],  
                [$centro_salud_id,33],  
                [$centro_salud_id,34],  
                [$centro_salud_id,35],  
                [$centro_salud_id,36],  
                [$centro_salud_id,37],  
                [$centro_salud_id,38],  
                [$centro_salud_id,39],  
                [$centro_salud_id,40],  
                [$centro_salud_id,41],  
                [$centro_salud_id,42],  
                [$centro_salud_id,43],  
                [$centro_salud_id,44],  
                [$centro_salud_id,45],  
                [$centro_salud_id,46],  
                [$centro_salud_id,47],  
                [$centro_salud_id,48],  
                [$centro_salud_id,49],  
                [$centro_salud_id,50],  
                [$centro_salud_id,51],  
                [$centro_salud_id,52],  
                [$centro_salud_id,53],  
                [$centro_salud_id,54],  
                [$centro_salud_id,55],  
                [$centro_salud_id,56],  
                [$centro_salud_id,57],  
                [$centro_salud_id,58],  
                [$centro_salud_id,59],  
                [$centro_salud_id,60],  
                [$centro_salud_id,61],  
                [$centro_salud_id,62],  
                [$centro_salud_id,63],  
                [$centro_salud_id,64],  
                [$centro_salud_id,65],  
                [$centro_salud_id,66],  
                [$centro_salud_id,67],  
                [$centro_salud_id,68],  
            
            
            ];
        }
        for ($i=0; $i < count($data); $i++) {
            CentroSaludEspecialidades::create(['centro_salud_id' =>$data[$i][0],"cat_especialidad_id"=>$data[$i][1]]);
        }
    }
}
