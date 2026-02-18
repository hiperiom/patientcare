<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function sendMessage()
    {

        try {

            //TOKEN QUE NOS DA FACEBOOK
            $token = 'EABUQI9BmFCgBAAZC0ZAWSHzFu6WBPGKY8YRJT6atRTSPOkE5dbWjmpcfSZATaNyhgRsnuaP3CdTgugyf7IyCh2LR5oJqZAz1rvZC6yi3LGnnntmXk6Ycyzbo6oSSmut6eNdRBT532vY4p6h4dFc20HSnkJvHOGfQFFGYlWHpG2dMWP8KxXv5MJooZAZCrZBgYZBL4q3tZCCywiKAZDZD';

            //NUESTRO TELEFONO
            $telefono ="584149320905";

            //URL A DONDE SE MANDARA EL MENSAJE
            $url = "https://graph.facebook.com/v15.0/102664579401769/messages";

            //CONFIGURACION DEL MENSAJE
            $mensaje =  ''
                    .   '{'
                    .   '"messaging_product": "whatsapp", '
                    .   '"to": "'.$telefono.'", '
                    .   '"type": "template", '
                    .   '"template": '
                    .   '   {'
                    .   '       "name": "hello_world", '
                    .   '       "language":{ "code": "en_US" } '
                    .   '   }'
                    .   '}';


            //DECLARAMOS LAS CABECERAS
            $header = array("Authorization: Bearer " . $token, "Content-Type: application/json",);

            //INICIAMOS EL CURL
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            //OBTENEMOS LA RESPUESTA DE ENVIO DE INFORMACION
            $response = json_decode(curl_exec($curl), true);

            //IMPRIMIMOS LA RESPUESTA
            print_r($response);

            //OBTENEMOS EL CODIGO DE LA RESPUESTA
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            //CERRAMOS EL CURL
            curl_close($curl);

        } catch (\Throwable $th) {
            dd($th);
        }

    }
}
