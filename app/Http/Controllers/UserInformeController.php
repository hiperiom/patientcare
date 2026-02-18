<?php

namespace App\Http\Controllers;

use App\Models\UserCuestInforme;
use App\Models\UserInforme;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
class UserInformeController extends Controller
{
    public function pad()
    {

        $informe = UserCuestInforme::show($_GET['user_cuest_informe_id']);
        $user_id = $informe['user_id'];
        $rango = [
            "finicio"=>date("Y-m-d",strtotime($informe['since'])),
            "ffin"=>date("Y-m-d",strtotime($informe['until']))
        ];
        $fechas = [
            "finicio"=>date("d-m-Y",strtotime($informe['since'])),
            "ffin"=>date("d-m-Y",strtotime($informe['until']))
        ];

        $rangos =  $this->getRangos($rango);
        $user = $this->user_profile($user_id);
        $temp = [];
        $oxi = [];
        $fc = [];
        $g1 = [];
        $g2 = [];
        $g3 = [];
        $dia=1;
        $colorBar =[
            ['#FFFF00','#FFFF55'],
            ['#FFAA00','#FFAA55'],
            ['#007FFF','#FFFF7F'],
        ];
        foreach ($rangos as $key => $value) {

            $temp[$key] = $this->dataset($this->model("t1",$user_id,$value),$rangos[$key],$dia);
            $oxi[$key] = $this->dataset($this->model("t2",$user_id,$value),$rangos[$key],$dia);
            $fc[$key] = $this->dataset($this->model("t3",$user_id,$value),$rangos[$key],$dia);
            $g1[$key] = $this->grafico($temp[$key],$colorBar[0]);
            $g2[$key] = $this->grafico($oxi[$key],$colorBar[1]);
            $g3[$key] = $this->grafico($fc[$key],$colorBar[2]);
            $dia= $dia+14;
        }


        $pdf = PDF::loadView('pdf.informePad',
                [
                    "fecha"=>$fechas,
                    "user" =>$user,
                    "dias_pad"=> $this->getDiasPad($rango),
                    "temp"=> $temp,
                    "oxi"=> $oxi,
                    "fc"=> $fc,
                    "g1"=>$g1,
                    "g2"=>$g2,
                    "g3"=>$g3,
                    "observaciones"=>$informe['coments'],
                ]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream("Informe de Egreso.pdf");
    }
    public function getRangos($rango)
    {
        $fecha_inicio = date("Y-m-d",strtotime($rango['finicio']));
        $fecha_fin = date("Y-m-d",strtotime($rango['ffin']));
        $date1 = new DateTime($fecha_inicio);
        $date2 = new DateTime($fecha_fin);
        $diff = $date1->diff($date2);
        $rangos = [];
        $i=1;
        $ff =$fecha_inicio;
        $z = 0;

        while ($i <= $diff->days) {
            $fi = $ff;
            $ff = date("Y-m-d",strtotime($ff."+ 14 days"));
            $rangos[]=[
                "finicio"=>$fi,
                "ffin"=>$ff,
            ];
            $i = $i+14;
            $z = $diff->days-$i;

            if($diff->days > 14){
                //dd($diff->days);
                $rangos[]=[
                    "finicio"=> $ff,
                    "ffin"=>$fecha_fin,
                ];
                break;
            }
        }
        return $rangos;
    }
    public function getDiasPad($rango)
    {
        $date1 = new DateTime($rango['finicio']);
        $date2 = new DateTime($rango['ffin']);
        $diff = $date1->diff($date2);
        return $diff->days;
    }
    public function user_profile($user_id)
    {

        return DB::table('user_profile AS t')
            ->where("t.user_id",$user_id)
            ->select(
                "t.*",
                DB::raw("YEAR(CURDATE())-YEAR(t.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(t.fnacimiento,'%m-%d'), 0 , -1 ) AS edad")
            )
            ->first();
    }
    public function grafico($dataset,$color)
    {
        $grafico1 = json_encode([
            "type" => 'bar',
                "data" => [
                "labels" => $dataset['label'],
                "datasets" => [
                    [
                        "label" => "T1",
                        "data" => $dataset['datosInicio'],
                        "backgroundColor"=> $color[0]
                    ],
                    [
                        "label" => "T2",
                        "data" => $dataset['datosFin'],
                        "backgroundColor"=> $color[1]
                    ],
                ],
                ],

                "options"=> [
                    "legend"=> [
                        "display"=> false
                    ],
                    "scales"=> [
                        "yAxes"=> [[
                            "ticks"=> [
                                "fontSize"=> 4
                            ]
                        ]],
                        "xAxes"=> [[
                            "ticks"=> [
                                "fontSize"=> 4
                            ]
                        ]]
                            ],

                        "labels"=> [
                            "fontSize"=> "5"

                    /*
                    "plugins"=> [
                        "barlabel"=> [
                            "labels"=>[
                                [
                                    "text"=>'100',
                                    "font"=>[
                                        "size"=>10
                                    ]
                                ]

                            ]
                        ],

                        "datalabels"=> [
                            "anchor"=> 'center',
                            "align"=> 'center',
                            "color"=> 'black',
                            "font"=> [
                                "resizable"=> true,
                                "size"=> 10,
                            ],
                        ],*/
                    ],
                ],

            ]);

        $chartData = file_get_contents("https://quickchart.io/chart?width=180&height=80&c=".urlencode($grafico1));
        return 'data:image/png;base64, '.base64_encode($chartData);
    }

    public function dataSet($model,$rangos,$contador)
    {
        $dataset= [];
        $fecha_fin = date("Y-m-d",strtotime($rangos['ffin']."+ 1 days"));
        $fecha_inicio = $rangos['finicio'];
        $label = [];
        $datosInicio = [];
        $datosFin = [];
        $date1 = new DateTime($fecha_inicio);
        $date2 = new DateTime($fecha_fin );
        $diff = $date1->diff($date2);

        for ($i=0; $i <14 ; $i++) {
            $dia=date("d",strtotime($fecha_inicio));
            $temp=array();
            foreach ($model as $key => $value) {
                if($value->dia == $dia){
                    array_push($temp, $value->value);
                }
            }
            $dataset[$i]["label"]=$contador;
            $dataset[$i]["data"]=$temp;
            $fecha_inicio = date("Y-m-d",strtotime($fecha_inicio."+ 1 days"));
            array_push($label, "Día ".$contador);
            $contador++;
            $temp1=count($dataset[$i]["data"])>0? $dataset[$i]["data"][array_key_first($dataset[$i]["data"])]:0;
            if(count($dataset[$i]["data"])>1){
                $temp2 = $dataset[$i]["data"][array_key_last($dataset[$i]["data"])];
            }else{
                $temp2="";
            }

            array_push($datosInicio, $temp1);
            array_push($datosFin, $temp2);
            /*
            if(strtotime($fecha_inicio)==strtotime(date('Y-m-d'))){
                break;
            }*/
        }
        return [
            "label" => $label,
            "datosInicio" => $datosInicio,
            "datosFin" => $datosFin,
        ];
    }
    public function model($case,$user_id,$rangos)
    {

        switch ($case) {
            case 't1':
                return DB::select("
                    SELECT
                        t.value,
                        DATE_FORMAT(t.created_at,'%d') AS dia
                    FROM user_cuest_monitoreo AS t
                    WHERE t.cat_user_cuestionario_id = 84
                    AND t.user_id = ".$user_id."
                    AND t.created_at BETWEEN '".$rangos['finicio']." 00:00:00' AND '".$rangos['ffin']." 23:59:59'
                ", [1]);
            break;
            case 't2':
                return DB::select("
                    SELECT
                        t.value,
                        DATE_FORMAT(t.created_at,'%d') AS dia
                    FROM user_cuest_monitoreo AS t
                    WHERE t.cat_user_cuestionario_id = 73
                    AND t.user_id = ".$user_id."
                    AND t.created_at BETWEEN '".$rangos['finicio']." 00:00:00' AND '".$rangos['ffin']." 23:59:59'
                ", [1]);
            break;
            case 't3':
                return DB::select("
                    SELECT
                        t.value,
                        DATE_FORMAT(t.created_at,'%d') AS dia
                    FROM user_cuest_fc AS t
                    WHERE t.user_id_paciente = ".$user_id."
                    AND t.created_at BETWEEN '".$rangos['finicio']." 00:00:00' AND '".$rangos['ffin']." 23:59:59'
                ", [1]);
            break;
        }
    }











    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserInforme  $userInforme
     * @return \Illuminate\Http\Response
     */
    public function show(UserInforme $userInforme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserInforme  $userInforme
     * @return \Illuminate\Http\Response
     */
    public function edit(UserInforme $userInforme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserInforme  $userInforme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserInforme $userInforme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserInforme  $userInforme
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserInforme $userInforme)
    {
        //
    }
}
