<?php

use Illuminate\Database\Seeder;
use App\Models\CentroSalud;
class CentroSaludSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["Centro Medico Docente La Trinidad",1,"Av. Principal de El Hatillo, Caracas 1080, Distrito Metropolitano de Caracas","https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3923.878958410231!2d-66.85781458255614!3d10.431178800000009!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2af7cab47b2545%3A0x633eed20b60e339e!2sCentro%20M%C3%A9dico%20Docente%20La%20Trinidad!5e0!3m2!1ses!2sve!4v1647056909277!5m2!1ses!2sve"],
            // ["Centro de Especialidadess los Palos Grande (CELPG)",2,"Av 3 con transversal 2. Los palos grande.","https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d980.7533037856193!2d-66.8438452!3d10.499624!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2a59ae294177cd%3A0x7d32f4376b9c20ba!2sAmbulatorio%20Salud%20Chacao!5e0!3m2!1ses!2sve!4v1647056658715!5m2!1ses!2sve"],
            // ["Ambulatorio Altamira",2,"Plaza miranda Av San juan bosco.","https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3298.811147230178!2d-66.85256727199287!3d10.503053639687643!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2a59a6405d300f%3A0x781314c186e81d2a!2sSalud%20Chacao%20Sede%20Altamira!5e0!3m2!1ses!2sve!4v1647057079544!5m2!1ses!2sve"],
            // ["Ambulatorio Viseteca",2,"Final av Avila Edf. Viseteca, urb Bello Campo. Fte a la torre Xerox.","https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3923.1282154899127!2d-66.85279278488365!3d10.49055756727284!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2a5854858de5c9%3A0xc4f094163c525809!2sSalud%20Chacao.%20Sede%20Principal!5e0!3m2!1ses!2sve!4v1647057133867!5m2!1ses!2sve"],
            // ["Ambulatorio Chacao Bello Campo",2,"Av. Santa Ana. Bello Campo","https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d583.1732742925003!2d-66.85140737525103!3d10.492268075782933!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2a5854adfb815d%3A0xb24166c3bf0ae2a2!2sSalud%20Chacao!5e0!3m2!1ses!2sve!4v1647057394657!5m2!1ses!2sve"],
            // ["Ambulatorio Salud Chacao el bosque",2,"Av principal el bosque , dentro del parque Centeno Vallenilla.","https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1387.0206450404714!2d-66.86786143036718!3d10.493822402874178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2a58fd52319bf1%3A0xc4f832918782589f!2sParque%20Pedro%20Centeno%20Vallenilla!5e0!3m2!1ses!2sve!4v1647057649813!5m2!1ses!2sve"],
            // ["Ambulatorio Chacao El Pedregal",2,"2da transversal de la castellana con Av. principal el pedregal","https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d980.7384835080642!2d-66.8590001138289!3d10.504294600000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2a59087c15cdf7%3A0xf683bc503658fbff!2sAmbulatorio%20El%20Pedregal%20(Salud%20Chacao)!5e0!3m2!1ses!2sve!4v1647057714709!5m2!1ses!2sve"],
            // ["Ambulatorio Salud Chacao Bucaral",2,"Actualmente cerrado","https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31384.050761799237!2d-66.88215665962232!3d10.500165367652196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2a592150deac71%3A0xb35c7b247417d42!2sGrupo%20M%C3%A9dico%20Bucaral!5e0!3m2!1ses!2sve!4v1647057939604!5m2!1ses!2sve"],
            // ["MyCare",3,"C. Pablo Pumarol 2, Santo Domingo 10131, República Dominicana","https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7568.200866387605!2d-69.9594162651123!3d18.4791094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8eaf8b2236f350f3%3A0x65a1a09a3cc00062!2sMyCare%20RD!5e0!3m2!1ses!2sve!4v1647058714872!5m2!1ses!2sve"],

        ];
        for ($i=0; $i < count($data); $i++) {
            CentroSalud::create([
                'description' =>$data[$i][0],
                "cat_grupo_centro_salud_id"=>$data[$i][1] ,
                "coments"=>$data[$i][2],
                "location"=>$data[$i][3]
            ]);
        }
    }
}
