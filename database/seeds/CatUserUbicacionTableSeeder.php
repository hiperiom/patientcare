<?php

use App\Models\CatUserUbicacion;
use Illuminate\Database\Seeder;

class CatUserUbicacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //NO SE PUEDE ELIMINAR NINGUNO PORQUE SE PIERDE LA SECUENCIA
        CatUserUbicacion::create(['name'=>'Todos los Pacientes','description' =>'TP','parent_cat_user_ubicacion_id'=>null,'coments'=>'TP','orden'=>1,'route'=>'medico/tp']);//1

        CatUserUbicacion::create(['name'=>'Emergencia Adulto','description' =>'EA','parent_cat_user_ubicacion_id'=>1, 'coments'=>'EA','orden'=>2,'route'=>'medico/ea']);//2
            CatUserUbicacion::create(['name'=>'EA Triaje','description' =>'EA','parent_cat_user_ubicacion_id'=>2, 'coments'=>"Triaje"]);//3
                CatUserUbicacion::create(['name'=>'EA Triaje A','description' =>'EA Triaje','parent_cat_user_ubicacion_id'=>3, 'coments'=>'A']);//4
                CatUserUbicacion::create(['name'=>'EA Triaje B','description' =>'EA Triaje','parent_cat_user_ubicacion_id'=>3, 'coments'=>'B']);//5
        //NO SE PUEDE ELIMINAR NINGUNO PORQUE SE PIERDE LA SECUENCIA
        CatUserUbicacion::create(['name'=>'Emergencia COVID','description' =>'ECvd','parent_cat_user_ubicacion_id'=>1, 'coments'=>'ECvd','orden'=>3,'route'=>'medico/ecvd']);//6
            CatUserUbicacion::create(['name'=>'ECvd Triaje','description' =>'ECvd','parent_cat_user_ubicacion_id'=>6, 'coments'=>"Triaje"]);//7
                CatUserUbicacion::create(['name'=>'Ecvd Triaje A','description' =>'ECvd','parent_cat_user_ubicacion_id'=>7, 'coments'=>'A']);//8
                CatUserUbicacion::create(['name'=>'Ecvd Triaje B','description' =>'ECvd','parent_cat_user_ubicacion_id'=>7, 'coments'=>'B']);//9

            CatUserUbicacion::create(['name'=>'Ecvd Obs','description' =>'Ecvd','parent_cat_user_ubicacion_id'=>6, 'coments'=>"Obs"]);//10
                for ($i=1; $i <= 17 ; $i++) {
                    CatUserUbicacion::create(['name'=>'Ecvd Obs | Cub. '.$i,'description' =>"Ecvd",'parent_cat_user_ubicacion_id'=>10, 'coments'=>"Cub. ".$i]);//11
                }//27

        CatUserUbicacion::create(['name'=>'Emergencia Pediátrica','description' =>'EP','parent_cat_user_ubicacion_id'=>1, 'coments'=>'EP','orden'=>3,'route'=>'medico/ep']);//28
            CatUserUbicacion::create(['name'=>'EP Triaje','description' =>'EP','parent_cat_user_ubicacion_id'=>28, 'coments'=>"Triaje"]);//29
                CatUserUbicacion::create(['name'=>'EP Triaje A','description' =>'EP','parent_cat_user_ubicacion_id'=>29, 'coments'=>'Ubi A']);//30
                CatUserUbicacion::create(['name'=>'EP Triaje B','description' =>'EP','parent_cat_user_ubicacion_id'=>29, 'coments'=>'Ubi B']);//31

            CatUserUbicacion::create(['name'=>'EP Obs','description' =>'EP','parent_cat_user_ubicacion_id'=>28, 'coments'=>"Obs"]);//32
                for ($i=1; $i <= 8 ; $i++) {
                    CatUserUbicacion::create(['name'=>'EP | Cub. '.$i,'description' =>"EP",'parent_cat_user_ubicacion_id'=>32, 'coments'=>"Cub. ".$i]);//33
                }//40
        //NO SE PUEDE ELIMINAR NINGUNO PORQUE SE PIERDE LA SECUENCIA
        CatUserUbicacion::create(['name'=>'Área Quirúrgica','description' =>'AQ','parent_cat_user_ubicacion_id'=>1, 'coments'=>'AQ','orden'=>4,'route'=>'medico/aq']);//41

        CatUserUbicacion::create(['name'=>'Hospitalización Piso 2','description' =>'HP2','parent_cat_user_ubicacion_id'=>1, 'coments'=>'HP2','orden'=>5,'route'=>'medico/aq']);//42
            CatUserUbicacion::create(['name'=>'HP2','description' =>'HP2','parent_cat_user_ubicacion_id'=>42, 'coments'=>"Piso 2"]);//43
                for ($i=2201; $i <= 2226 ; $i++) {
                    CatUserUbicacion::create(['name'=>'HP2 | Hab. '.$i,'description' =>"HP2",'parent_cat_user_ubicacion_id'=>43, 'coments'=>"Hab. ".$i]);//44
                }//69

        CatUserUbicacion::create(['name'=>'Hospitalización Piso 3','description' =>'HP3','parent_cat_user_ubicacion_id'=>1, 'coments'=>'HP3','orden'=>6,'route'=>'medico/hp3']);//70
            CatUserUbicacion::create(['name'=>'HP3','description' =>'HP3','parent_cat_user_ubicacion_id'=>70, 'coments'=>"Piso 3"]);//71
                for ($i=2301; $i <= 2326 ; $i++) {
                    CatUserUbicacion::create(['name'=>'HP3 | Hab. '.$i,'description' =>"HP3",'parent_cat_user_ubicacion_id'=>71, 'coments'=>"Hab. ".$i]);//72
                }//97

        CatUserUbicacion::create(['name'=>'Hospitalización Piso 4','description' =>'HP4','parent_cat_user_ubicacion_id'=>1, 'coments'=>'HP4','orden'=>7,'route'=>'medico/hp4']);//98
            CatUserUbicacion::create(['name'=>'HP4','description' =>'HP4','parent_cat_user_ubicacion_id'=>98, 'coments'=>"Piso 4"]);//99
                for ($i=2401; $i <= 2426 ; $i++) {
                    CatUserUbicacion::create(['name'=>'HP4 | Hab. '.$i,'description' =>"HP4",'parent_cat_user_ubicacion_id'=>99, 'coments'=>"Hab. ".$i]);//100
                }//125
        //NO SE PUEDE ELIMINAR NINGUNO PORQUE SE PIERDE LA SECUENCIA
        CatUserUbicacion::create(['name'=>'Hospitalización Piso 5','description' =>'HP5','parent_cat_user_ubicacion_id'=>1, 'coments'=>'HP5','orden'=>8,'route'=>'medico/hp5']);//126
            CatUserUbicacion::create(['name'=>'HP5','description' =>'HP5','parent_cat_user_ubicacion_id'=>126, 'coments'=>"Piso 5"]);//127
                for ($i=2501; $i <= 2526 ; $i++) {
                    CatUserUbicacion::create(['name'=>'HP5 | Hab. '.$i,'description' =>"HP5",'parent_cat_user_ubicacion_id'=>127, 'coments'=>"Hab. ".$i]);//128
                }//153

        CatUserUbicacion::create(['name'=>'Hospitalización Piso 6','description' =>'HP6','parent_cat_user_ubicacion_id'=>1, 'coments'=>'HP6','orden'=>9,'route'=>'medico/hp6']);//154
            CatUserUbicacion::create(['name'=>'HP6','description' =>'HP6','parent_cat_user_ubicacion_id'=>154, 'coments'=>"Piso 6"]);//155
                for ($i=2601; $i <= 2626 ; $i++) {
                    CatUserUbicacion::create(['name'=>'HP6 | Hab. '.$i,'description' =>"HP6",'parent_cat_user_ubicacion_id'=>155, 'coments'=>"Hab. ".$i]);//156
                }//181

        CatUserUbicacion::create(['name'=>'Unidad de Terapia Intensiva Adulto','description' =>'UTIA','parent_cat_user_ubicacion_id'=>1, 'coments'=>'UTIA','orden'=>10,'route'=>'medico/ucia']);//182
            CatUserUbicacion::create(['name'=>'UTIA','description' =>'UTIA','parent_cat_user_ubicacion_id'=>182, 'coments'=>"UTIA"]);//183
                for ($i=1; $i <= 10 ; $i++) {
                    CatUserUbicacion::create(['name'=>'UTIA | Cama. '.$i,'description' =>"UTIA",'parent_cat_user_ubicacion_id'=>183, 'coments'=>"Cama. ".$i]);//184
                }//193
        //NO SE PUEDE ELIMINAR NINGUNO PORQUE SE PIERDE LA SECUENCIA
        CatUserUbicacion::create(['name'=>'Unidad de Terapia Intensiva COVID','description' =>'UTICvd','parent_cat_user_ubicacion_id'=>1, 'coments'=>'UTICvd','orden'=>11,'route'=>'medico/ucicvd']);//194
            CatUserUbicacion::create(['name'=>'UTICVD','description' =>'UTICvd','parent_cat_user_ubicacion_id'=>194, 'coments'=>"UTICvd"]);//195
                for ($i=1; $i <= 15 ; $i++) {
                    CatUserUbicacion::create(['name'=>'UTICvd | Cama. '.$i,'description' =>"UTICvd",'parent_cat_user_ubicacion_id'=>195, 'coments'=>"Cama. ".$i]);//196
                }//210

        CatUserUbicacion::create(['name'=>'Unidad de Terapia Intensiva Pediátrica','description' =>'UTIP','parent_cat_user_ubicacion_id'=>1, 'coments'=>'UTIP','orden'=>12,'route'=>'medico/ucip']);//211
            CatUserUbicacion::create(['name'=>'UTIP','description' =>'UTIP','parent_cat_user_ubicacion_id'=>211, 'coments'=>"UTIP"]);//212
                for ($i=1; $i <= 10 ; $i++) {
                    CatUserUbicacion::create(['name'=>'UTIP | Cama. '.$i,'description' =>"UTIP",'parent_cat_user_ubicacion_id'=>212, 'coments'=>"Cama. ".$i]);//213
                }//222

        CatUserUbicacion::create(['name'=>'Programa de Atensión Domiciliaria','description' =>'PAD','parent_cat_user_ubicacion_id'=>1, 'coments'=>'PAD','orden'=>13,'route'=>'medico/pad']);//223
            CatUserUbicacion::create(['name'=>'PAD Covid-19','description' =>'Covid-19','parent_cat_user_ubicacion_id'=>223, 'coments'=>"PAD Covid-19"]);//224
                for ($i=1; $i <= 5 ; $i++) {
                    CatUserUbicacion::create(['name'=>'PAD | '.$i,'description' =>"PAD",'parent_cat_user_ubicacion_id'=>224, 'coments'=>"PAD | ".$i]);//225
                }//229
                for ($i=6; $i <= 20; $i++) {
                    CatUserUbicacion::create(['name'=>'PAD | '.$i,'description' =>"PAD",'parent_cat_user_ubicacion_id'=>224, 'coments'=>"PAD | ".$i,'active'=>0]);//229
                }//244

        //NO SE PUEDE ELIMINAR NINGUNO PORQUE SE PIERDE LA SECUENCIA
        CatUserUbicacion::create(["name"=>"Sala de Espera",'description' =>'SE','parent_cat_user_ubicacion_id'=>null,'coments'=>'Sala de Espera']);//245
        CatUserUbicacion::create(['name'=>'Alta Médica','description' =>'ALTA','parent_cat_user_ubicacion_id'=>1,'coments'=>'ALTA','orden'=>50,'route'=>'medico/alta']);//246
        CatUserUbicacion::create(['name'=>'Contraopinión médica','description' =>'Contraopinión médica','parent_cat_user_ubicacion_id'=>null,'coments'=>'Contraopinión médica']);//247
        CatUserUbicacion::create(['name'=>'Fallecido','description' =>'Fallecido','parent_cat_user_ubicacion_id'=>null,'coments'=>'Fallecido']);//248
        CatUserUbicacion::create(['name'=>'Otra','description' =>'Otra','parent_cat_user_ubicacion_id'=>null,'coments'=>'Otra']);//249
        CatUserUbicacion::create(['name'=>'Reingreso','description' =>'Reingreso','parent_cat_user_ubicacion_id'=>null,'coments'=>'Reingreso']);//250
        CatUserUbicacion::create(['name'=>'Traslado a otra Institución','description' =>'Traslado a otra Institución','parent_cat_user_ubicacion_id'=>null,'coments'=>'Traslado a otra Institución']);//251

        //continuacion habitaciones piso5
        for ($i=2527; $i <= 2535 ; $i++) {
            CatUserUbicacion::create(['name'=>'HP5 | Hab. '.$i,'description' =>"HP5",'parent_cat_user_ubicacion_id'=>127, 'coments'=>"Hab. ".$i]);//128
        }//153
        //continuacion habitaciones piso6
        for ($i=2627; $i <= 2635 ; $i++) {
            CatUserUbicacion::create(['name'=>'HP6 | Hab. '.$i,'description' =>"HP5",'parent_cat_user_ubicacion_id'=>155, 'coments'=>"Hab. ".$i]);//156
        }//276

        CatUserUbicacion::create(['name'=>'EA Obs','description' =>'EA','parent_cat_user_ubicacion_id'=>2, 'coments'=>"Obs"]);//270
                for ($i=1; $i <= 6 ; $i++) {
                    CatUserUbicacion::create(['name'=>'EA Obs | Cama '.$i,'description' =>"EA",'parent_cat_user_ubicacion_id'=>270, 'coments'=>"Cama. ".$i]);//278
                }//276

        //NO SE PUEDE ELIMINAR NINGUNO PORQUE SE PIERDE LA SECUENCIA

        //INICIO HUC------------------------------------------------------------------------

            CatUserUbicacion::create(['name'=>'','description' =>'PISO 2','parent_cat_user_ubicacion_id'=>1, 'coments'=>'PISO 2','orden'=>1,'route'=>'medico/piso2']);//277
            CatUserUbicacion::create(['name'=>'','description' =>'Infectología','parent_cat_user_ubicacion_id'=>277, 'coments'=>"Infectología"]);//278
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 16A"]);//279
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 16B"]);//280
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 17A"]);//281
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 17B"]);//282
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 19A"]);//283
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 19B"]);//284
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 19C"]);//285
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 19D"]);//286
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 19E"]);//287
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 19F"]);//288
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 19G"]);//289
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 19H"]);//290
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 19I"]);//291
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 25A"]);//292
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 25B"]);//293
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 26A"]);//294
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 26B"]);//295
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 26C"]);//296
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 26D"]);//297
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 27A"]);//298
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 27B"]);//299
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 28A"]);//300
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 28B"]);//301
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 29A"]);//302
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 29B"]);//303
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 30"]);//304
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 35A"]);//305
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 35B"]);//306
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 35C"]);//307
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 35D"]);//308
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 35E"]);//309
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 35F"]);//310
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 35G"]);//311
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 35H"]);//312
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 35I"]);//313
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 37"]);//314
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 38A"]);//315
                CatUserUbicacion::create(['name'=>'','description' =>"Infectología",'parent_cat_user_ubicacion_id'=>278, 'coments'=>"Cama 38B"]);//316

             CatUserUbicacion::create(['name'=>'PISO 8','description' =>'PISO 8','parent_cat_user_ubicacion_id'=>1, 'coments'=>'PISO 8','orden'=>2,'route'=>'medico/piso8']);//317
             CatUserUbicacion::create(['name'=>'Neumonología','description' =>'Neumonología','parent_cat_user_ubicacion_id'=>317, 'coments'=>"Neumonología"]);//318
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 16A','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 16A"]);//319
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 16B','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 16B"]);//320
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 17A','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 17A"]);//321
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 17B','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 17B"]);//322
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 19A','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 19A"]);//323
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 19B','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 19B"]);//324
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 19C','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 19C"]);//325
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 19D','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 19D"]);//326
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 19E','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 19E"]);//327
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 19F','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 19F"]);//328
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 19G','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 19G"]);//329
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 19H','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 19H"]);//330
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 19I','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 19I"]);//331
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 25A','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 25A"]);//332
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 25B','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 25B"]);//333
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 26A','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 26A"]);//334
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 26B','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 26B"]);//335
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 26C','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 26C"]);//336
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 26D','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 26D"]);//337
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 27A','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 27A"]);//338
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 27B','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 27B"]);//339
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 28A','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 28A"]);//340
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 28B','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 28B"]);//341
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 29A','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 29A"]);//342
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 29B','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 29B"]);//343
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 30','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 30"]);//344
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 35A','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 35A"]);//345
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 35B','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 35B"]);//346
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 35C','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 35C"]);//347
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 35D','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 35D"]);//348
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 35E','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 35E"]);//349
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 35F','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 35F"]);//350
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 35G','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 35G"]);//351
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 35H','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 35H"]);//352
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 35I','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 35I"]);//353
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 37','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 37"]);//354
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 38A','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 38A"]);//355
                CatUserUbicacion::create(['name'=>'Neumonologia | Cama 38B','description' =>"Neumonología",'parent_cat_user_ubicacion_id'=>318, 'coments'=>"Cama 38B"]);//356
             //NO SE PUEDE ELIMINAR NINGUNO PORQUE SE PIERDE LA SECUENCIA
        //FIN HUC------------------------------------------------------------------------
        CatUserUbicacion::create(['name'=>'PAD - Empleados','description' =>"PAD",'parent_cat_user_ubicacion_id'=>224, 'coments'=>"PAD - Empleados"]);//357
        for ($i=2427; $i <= 2432 ; $i++) {
            CatUserUbicacion::create(['name'=>'HP4 | Hab. '.$i,'description' =>"HP4",'parent_cat_user_ubicacion_id'=>99, 'coments'=>"Hab. ".$i]);//100
        }//363
        CatUserUbicacion::create(['name'=>'WhatsApp','description' =>'WhatsApp','parent_cat_user_ubicacion_id'=>null,'coments'=>'WhatsApp']);//364
        CatUserUbicacion::create(['name'=>'Telefono Convencional','description' =>'Telefono Convencional','parent_cat_user_ubicacion_id'=>null,'coments'=>'Telefono Convencional']);//365
        CatUserUbicacion::create(['name'=>'Web','description' =>'Web','parent_cat_user_ubicacion_id'=>null,'coments'=>'Web']);//366
        CatUserUbicacion::create(['name'=>'Instagram','description' =>'Instagram','parent_cat_user_ubicacion_id'=>null,'coments'=>'Instagram']);//367
        //NO SE PUEDE ELIMINAR NINGUNO PORQUE SE PIERDE LA SECUENCIA

        CatUserUbicacion::create(['name'=>'PAD Cardio','description' =>'Cardio','parent_cat_user_ubicacion_id'=>223, 'coments'=>"PAD Cardio"]);//368
        CatUserUbicacion::create(['name'=>'PAD Oncología','description' =>'Cardio','parent_cat_user_ubicacion_id'=>223, 'coments'=>"PAD Oncología"]);//369
        CatUserUbicacion::create(['name'=>'PAD Endocrino','description' =>'Endocrino','parent_cat_user_ubicacion_id'=>223, 'coments'=>"PAD Endocrino"]);//370
        CatUserUbicacion::create(['name'=>'Clínica Post Covid','description' =>'Sala de espera','parent_cat_user_ubicacion_id'=>null, 'coments'=>"Post Covid | Sala de Espera"]);//371
        CatUserUbicacion::create(['name'=>'PAD Post Quirúrgico','description' =>'Quirúrgico','parent_cat_user_ubicacion_id'=>223, 'coments'=>"PAD Post Quirúrgico"]);//372
        for ($i=1; $i <= 5 ; $i++) {
            CatUserUbicacion::create(['name'=>'PAD | '.$i,'description' =>"PAD",'parent_cat_user_ubicacion_id'=>372, 'coments'=>"PAD | ".$i]);//373
        }//377
        CatUserUbicacion::create(['name'=>'PAD - Empleados','description' =>"PAD",'parent_cat_user_ubicacion_id'=>372, 'coments'=>"PAD - Empleados"]);//378
        CatUserUbicacion::create(['name'=>'PAD Médico','description' =>'Medico','parent_cat_user_ubicacion_id'=>223, 'coments'=>"PAD Médico"]);//379
        for ($i=1; $i <= 5 ; $i++) {
            CatUserUbicacion::create(['name'=>'PAD | '.$i,'description' =>"PAD",'parent_cat_user_ubicacion_id'=>379, 'coments'=>"PAD | ".$i]);//385
        }//385
        CatUserUbicacion::create(['name'=>'PAD - Empleados','description' =>"PAD",'parent_cat_user_ubicacion_id'=>379, 'coments'=>"PAD - Empleados"]);//385

        CatUserUbicacion::create(['name'=>'PAD - Despistaje + Seguimiento','description' =>"PAD",'parent_cat_user_ubicacion_id'=>223, 'coments'=>"PAD - Despistaje + Seguimiento"]);//386
        CatUserUbicacion::create(['name'=>'Consulta Externa','description' =>"Servicio",'parent_cat_user_ubicacion_id'=>null, 'coments'=>"Consulta Externa"]);//387
    }
}
