<?php

namespace App\Http\Controllers;

use App\Models\UserCita;

use App\Models\UserCuestDireccion;
use App\Models\UserCuestEpisodio;
use App\Models\UserCuestMedicoPaciente;
use App\Models\UserCuestUbicacion;
use App\Models\UserEspecialidad;
use App\Models\UserProfile;
use App\Models\UserCuestAlert;
use App\Models\UserType;
use App\Models\UserVip;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CatEspecialidad;
use App\Models\CentroSalud;
use App\Models\UserFamily;
use App\Models\UserCuestPeso;
use App\Models\UserCuestAltura;
use App\Models\UserCuestTemperatura AS UserTemp;
use App\Models\UserCuestOximetria AS UserOxi;
use App\Models\UserCuestFc AS UserFc;
use App\Models\UserCuestFr AS UserFr;
use App\Models\UserCuestTa AS UserTa;
use App\Models\UserCuestGlic AS UserGlic;
use App\Models\MotivoConsulta;
use App\Models\UserCuestImpresionDiagnostica;
use App\Models\ExamenFisico;
use App\Models\EnfermedadActual;
use App\Models\UserCuestPlan;
use App\Models\UserCuestRecipe;
use App\Models\UserCuestEstudio;
use App\Models\UserCuestLaboratorio;
use App\Models\UserCuestFotografia;
use App\Models\UserCuestImagen;
use App\Models\UserCuestOtroArchivo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use App\Http\Controllers\UserMedicoAgendaController;

class UserCitaController extends Controller
{
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
    public function status(Request $request)
    {
       // dd($request->all());
            $model = UserCita::find($request->cita_id);
            $email_paciente = User::where("id",$model->user_id_paciente)->value("email");
            $email_medico = User::where("id",$model->user_id_medico)->value("email");
            if ($request->cat_user_cita_status_id == 3) {
                if (isset($request->cancelada_por)) {
                    if ($request->cancelada_por=="paciente") {
                        $model->cancelada_paciente = true;
                    }
                    if ($request->cancelada_por=="atencion_al_paciente") {
                        $model->cancelada_medico = false;
                    }
                }
            }
            $model->cat_user_cita_status_id = (int) $request->cat_user_cita_status_id;
            if ($request->cat_user_cita_status_id == 3) {
                $model->coments2 = $request->coments2;
            }
            $model->save();
            $model = UserCita::find($request->cita_id);
        //if ( config("app.APP_SEND_EMAILS") ) {
            $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

            if ($request->cat_user_cita_status_id == 3) {

                $model['subject']= "Cita Cancelada";
                $model['case']=6;//cita cancelada

            }
            if ($request->cat_user_cita_status_id == 4) {
                $model['subject']= "Cita Confirmada";
                $model['case']=5;//cita confirmada

            }
            if ($request->cat_user_cita_status_id == 7) {
                $model['subject']= "Cita Atendida";
                $model['case']=7;//cita atendida

            }


            if ( in_array($request->cat_user_cita_status_id,[3,4,7]) ) {

                $model['especialidad']= CatEspecialidad::where("id",$model->cat_especialidad_id)->value("description");
                $model['medico']= UserProfile::where("user_id",$model->user_id_medico)
                                    ->select(
                                        DB::raw("
                                            CONCAT(
                                                CASE
                                                    WHEN prefijo IS NOT NULL THEN prefijo
                                                    ELSE ''
                                                END,
                                                ' ',
                                                nombres,
                                                ' ',
                                                apellidos
                                                ) as medico
                                        ")
                                    )->value('medico');

                //$model['year']=$request->year;
                $model['month']= $mes[ (int) $request->month ] ;
                //$model['day']=$request->day;
                //$model['hour']=$request->hour;
                $centro_salud = CentroSalud::where("id",$model->centro_salud_id )->first();
                $model['centro_salud']= $centro_salud->description;
                $model['address']= $centro_salud->coments;
                $model['location_link']= $centro_salud->location_link;
                $model['cat_user_cita_status_id']= $request->cat_user_cita_status_id;
                if ($request->cat_user_cita_status_id == 3) {//cita cancelada
                    $model['motivo_cancelacion'] = $request->coments2;
                }
                $model['logo'] = config('app.url')."/image/system/".config('app.APP_LOGO_VERSION_REPORTS_COLOR') ;

                /* if (config("app.APP_TEST_MODE") ) {
                    $team_test = explode(",",config("app.APP_ADDRESS_TEAM_TEST"));
                    $model['emails'] = $team_test;
                }else{ */
                    $model['emails'] = $email_paciente;
                /* } */
                try {
                    Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {

                        //foreach ($model['emails'] as $key => $correo) {
                            $message->to( $model['emails'] )
                            ->subject($model['subject']);
                        //}
                    });
                } catch (\Throwable $th) {
                    dd($th);
                }


            }
        /* }else{
            //dump("El envio de correos está desabilitado.") ;
        } */
       return Response()->json($model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function reprogramar(Request $request){
    //     $model = UserCita::find($request->cita_id);

    //     $model->cat_user_cita_status_id = $request->cat_user_cita_status_id;
    //     $model->year = $request->year;
    //     $model->month = $request->month;
    //     $model->day = $request->day;
    //     $model->hour = $request->hour;
    //     $model->coments = $request->coments;

    //     $model->save();

    //     return Response()->json($model);
    // }

    public function reprogramar(Request $request){
        $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $model = UserCita::find($request->cita_id);

        $fecha_anterior = $model->day." de ".$mes[ (int) $model->month-1 ]." de ".$model->year." a las ".date("h:i A",strtotime(date('Y-m-d '. $model->hour)));
        $model->cat_user_cita_status_id = $request->cat_user_cita_status_id;
        $model->year = $request->year;
        $model->month = $request->month;
        $model->day = $request->day;
        $model->hour = $request->hour;
        $model->reprogramada = true;

        $coment = "$request->coments\n La cita fue reprogramada para el ".$request->day."/".$request->month."/".$request->year." a las $request->hour";
        $model->coments = $coment;

        $model->save();
        //if ( config("app.APP_SEND_EMAILS") ) {
        $model['case']=4;
        $model['especialidad']= CatEspecialidad::where("id",$model->cat_especialidad_id)->value("description");
        $model['medico']= UserProfile::where("user_id",$model->user_id_medico)
                            ->select(
                                DB::raw("
                                    CONCAT(
                                        CASE
                                            WHEN prefijo IS NOT NULL THEN prefijo
                                            ELSE ''
                                        END,
                                        ' ',
                                        nombres,
                                        ' ',
                                        apellidos
                                        ) as medico
                                ")
                            )->value('medico');

        $model['fecha_anterior']=$fecha_anterior;
        $model['year']=$request->year;
        $model['month']= $mes[ (int) $request->month-1 ] ;
        $model['day']=$request->day;
        $model['coments']=$request->coments;
        $model['hour']= date("h:i A",strtotime(date("Y-m-d ". $request->hour)));
        $centro_salud = CentroSalud::where("id",$model->centro_salud_id )->first();
        $model['centro_salud']= $centro_salud->description;
        $model['address']= $centro_salud->coments;
        $model['location_link']= $centro_salud->location_link;
        $model['cat_user_cita_status_id']= $request->cat_user_cita_status_id; //CatUserCitaStatus::where("id", $request->cat_user_cita_status_id)->value("description");


        $model['logo'] = config('app.url')."/image/system/".config('app.APP_LOGO_VERSION_REPORTS_COLOR') ;
        $model['subject']= "Cita reprogramada";

        try {
            $model['emails'] = User::where("id",$model->user_id_paciente)->value("email");

            Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                $message->to( $model['emails'] )
                ->subject($model['subject']);
            });
           /*  Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                $message->to( "hiperiom412@gmail.com" )
                ->subject($model['subject']);
            }); */
        } catch (\Throwable $th) {
            dd($th);
        }

        return Response()->json($model);
    }

    public function store(Request $request)
    {
        $model = UserCita::store($request);



        return Response()->json( $model ) ;



    }
    public function store2(Request $request)
    {
        $model = new UserCita();
        return $model::store($request);


        //return Response()->json(true);

        $model = new User();
        $model::updateOrCreate([
            'email'   => $request->email,
        ],[
            'email'     => $request->email,
            'password' => "123456",
            'user_id_medico' => Auth::id(),
            "created_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))
        ]);

        $user_id = User::where("email",$request->email)->value('id');
        $request->merge(["user_id_paciente"=>$user_id]);
        $request->merge(["user_id"=>$user_id]);

        $model = new UserType();
        $model::updateOrCreate([
            'user_id'   => $user_id,
        ],[
            'user_id'     => $user_id,
            'cat_user_type_id' => 1,
            'user_id_medico' => Auth::id(),
            "created_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))
        ]);

        UserCuestEpisodio::where("user_id",$user_id)
                ->where("active",1)
                ->update(["active"=>0,"egreso"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

        $model = new UserCuestEpisodio();
        $request->merge(["value"=>"Ingreso"]);
        $model::store($request);

        $episodio_id = UserCuestEpisodio::ultimoEpisodio_id($user_id);

        $model = new UserVip();
        $request->merge(["value"=>0]);
        $model::store($request);

        $model = new UserCuestAlert();
        $request->merge(["alert"=>1]);
        $model::store($request);

        $model = new UserProfile();
        $model::store($request);

        $model = new UserCuestDireccion();
        $model::store($request);

        $request->merge(["cat_user_especialidad_id"=>67]);
        $model = new UserEspecialidad();
        $model::store($request);

        $request->merge(["position_id"=>1]);

        $model = new UserCuestMedicoPaciente();
        $model::store($request);

        $request->merge(["value"=>"Ingreso Consulta Externa"]);
        $request->merge(["cat_user_ubicacion_id"=>387]);
        UserCuestUbicacion::where("user_id",$user_id)
                ->where("active",1)
                ->update([
                    "active"=>0,
                    "value"=>"Nuevo Registro Consulta Externa",
                    "created_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']) ),
                    ]);
        $model = new UserCuestUbicacion();
        $model::store2($request);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return UserCita::where("user_id_paciente",$id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return UserCita::actualizar($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function reporteCitasCreadasGerentes($startDate,$endDate)
    {

        $spreadsheet = new Spreadsheet();
        $titulo_reporte = 'SOLICITUD DE CITAS';
        /* ;
        $spreadsheet = $this->reporte_citas(
            $spreadsheet,
            $startDate,
            $endDate,
            $titulo_reporte
        ); */
        $spreadsheet = $this->reporteCitas_detalle_totalCitasCreadasGerentes(
            $spreadsheet,
            $startDate,
            $endDate
        );

        $sheet = $spreadsheet->getActiveSheet();




        //GUARDAR EL DOCUMENTO
        $writer = new Xlsx($spreadsheet);
        $fileName = str_replace(" ","_",$titulo_reporte).'_del_'.$startDate."_al_".$endDate.'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        //$writer->save($filename);
        $writer->save('php://output');
        exit();
       // return $model;
    }

    public function reporteCitasCreadas($startDate,$endDate)
    {

        $spreadsheet = new Spreadsheet();
        $titulo_reporte = 'SOLICITUD DE CITAS';
        /* ;
        $spreadsheet = $this->reporte_citas(
            $spreadsheet,
            $startDate,
            $endDate,
            $titulo_reporte
        ); */
        $spreadsheet = $this->reporteCitas_detalle_totalCitasCreadas(
            $spreadsheet,
            $startDate,
            $endDate
        );

        $sheet = $spreadsheet->getActiveSheet();




        //GUARDAR EL DOCUMENTO
        $writer = new Xlsx($spreadsheet);
        $fileName = str_replace(" ","_",$titulo_reporte).'_del_'.$startDate."_al_".$endDate.'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        //$writer->save($filename);
        $writer->save('php://output');
        exit();
       // return $model;
    }

    public function reporteCitas($startDate,$endDate)
    {

        $spreadsheet = new Spreadsheet();
        $titulo_reporte = 'REPORTE DE CITAS';
        /* ;
        $spreadsheet = $this->reporte_citas(
            $spreadsheet,
            $startDate,
            $endDate,
            $titulo_reporte
        ); */
        $spreadsheet = $this->reporteCitas_resumen_totalCitasXMedico(
            $spreadsheet,
            $startDate,
            $endDate
        );
        $spreadsheet->createSheet(1);
        $spreadsheet->setActiveSheetIndex(1);
        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet = $this->reporteCitas_detalle_totalCitasXMedico(
            $spreadsheet,
            $startDate,
            $endDate
        );
        $spreadsheet->setActiveSheetIndex(0);
        $sheet = $spreadsheet->getActiveSheet();


        //GUARDAR EL DOCUMENTO
        $writer = new Xlsx($spreadsheet);
        $fileName = str_replace(" ","_",$titulo_reporte).'_del_'.$startDate."_al_".$endDate.'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        //$writer->save($filename);
        $writer->save('php://output');
        exit();
       // return $model;
    }

    public function reporte_citas($spreadsheet,$startDate,$endDate, $titulo_reporte )
    {
        $institucion = 'CMDLT';
        $fechaInicio = explode("-",$startDate);
        $fechaFin = explode("-",$endDate);
        $diaInicio = $fechaInicio[2];
        $mesInicio = $fechaInicio[1];
        $anioInicio = $fechaInicio[0];

        $diaFin = $fechaFin[2];
        $mesFin = $fechaFin[1];
        $anioFin = $fechaFin[0];
        $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


        //COLOR DE FONDO
        $spreadsheet->getActiveSheet()->getStyle('A1:H4')->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB( config("app.APP_BS_PRIMARY_ARGB") );

        //COLOR DE LETRA
        $spreadsheet->getActiveSheet()->getStyle('A1:H4')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

        $spreadsheet->getActiveSheet()->getStyle('A5:H5')
        ->getFont()->getColor()->setARGB( config("app.APP_BS_PRIMARY_ARGB") );
        //IMAGEN LOGO
        $drawing = new Drawing();
        $drawing->setWidth(3);
        $drawing->setHeight(50);
        $drawing->setPath('image/system/logo-cmdlt-blanco.png');
        $drawing->setCoordinates('H1');

        $drawing->setOffsetY(10);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        //NEGRITAS
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getStyle('A1:H3' )->getFont()->setBold(true);
        $sheet->getStyle('A5:H5' )->getFont()->setBold(true);


        //CABECERA
        $sheet->setCellValue('A1', $institucion);
        $sheet->setCellValue('A2', $titulo_reporte);
        $sheet->setCellValue('A3', 'DESDE EL '.$diaInicio.'-'.strtoupper( $mes[ (int) $mesInicio-1 ] ).'-'.$anioInicio.' HASTA '.$diaFin.'-'.strtoupper( $mes[ (int) $mesFin-1 ] ).'-'.$anioFin);
        //COMBINAR CELDAS
        $spreadsheet->getActiveSheet()->mergeCells('A4:H4');

        $sheet->setCellValue('A4', 'CREACIÓN: '.date("d").' DE '.strtoupper( $mes[ (int) date("m")-1 ] ).' DE '.date("Y").' A LAS '.date("g:i:s A"));

        $spreadsheet->getActiveSheet()->getStyle("H4")->getFont()->setSize(5);
        $spreadsheet->getActiveSheet()->getStyle("A2")->getFont()->setSize(16);
        $sheet->getStyle('A4')->getAlignment()->setHorizontal('right');





        /* $model =  DB::select('
            SELECT
                uc.user_id_medico,
                CONCAT(upm.apellidos,", ",upm.nombres) AS medico,
                CONCAT(upp.apellidos,", ",upp.nombres) AS paciente,
                cs.description AS centro_salud,
                cue.description AS especialidad,
                uc.year,
                uc.month,
                uc.day,
                uc.hour
            FROM user_cita AS uc
            INNER JOIN user_profile AS upm ON uc.user_id_medico = upm.user_id
            INNER JOIN user_profile AS upp ON uc.user_id_medico = upp.user_id
            INNER JOIN centro_salud AS cs ON uc.centro_salud_id = cs.id
            INNER JOIN cat_user_especialidad AS cue ON uc.cat_especialidad_id = cue.id

            WHERE STR_TO_DATE( CONCAT(uc.year,",",uc.month,",",uc.day ), "%Y,%m,%d" ) BETWEEN ? AND ?
            ORDER BY medico
        ', [$startDate, $endDate ]); */
        /* $model =  DB::select('
            SELECT
                uma.*,
                upm.user_id_medico,
                upm.nombres AS medico_nombre,
                upm.apellidos AS medico_apellido
                #CONCAT(upp.apellidos,", ",upp.nombres) AS paciente,
                #cs.description AS centro_salud,
                #cue.description AS especialidad,
                #uc.year,
                #uc.month,
                #uc.day,
                #uc.hour
            FROM user_medico_agenda AS uma
            INNER JOIN user_profile AS upm ON uma.user_id_medico = upm.user_id

            INNER JOIN user_profile AS upp ON uc.user_id_medico = upp.user_id
            INNER JOIN centro_salud AS cs ON uc.centro_salud_id = cs.id
            INNER JOIN cat_user_especialidad AS cue ON uc.cat_especialidad_id = cue.id

            #WHERE STR_TO_DATE( CONCAT(uc.year,",",uc.month,",",uc.day ), "%Y,%m,%d" ) BETWEEN ? AND ?
            #ORDER BY medico
        ', [$startDate, $endDate ]); */
        $model = new UserMedicoAgendaController();
        $model = $model->getAll();
        //NOMBRE DE LA PESTAÑA
        $spreadsheet->getActiveSheet()->setTitle($titulo_reporte);




        //TITULOS
        $sheet->setCellValue('A5', 'UBICACIÓN');
        $sheet->setCellValue('B5', 'SERVICIO');

        /* $sheet->setCellValue('A5', 'MÉDICO');

        $sheet->setCellValue('D5', 'PACIENTE');
        $sheet->setCellValue('E5', 'DIA');
        $sheet->setCellValue('F5', 'MES');
        $sheet->setCellValue('G5', 'AÑO');
        $sheet->setCellValue('H5', 'HORA'); */


        dd($model);
        //REGISTROS
        $row = 6;
        foreach ($model as $key => $value) {
            $agenda = json_decode($value->agenda);
            $anio = $value->year;
            dd(json_decode($value->agenda));//
            //$sheet->setCellValue('A'.$row, $value->centro_salud);
            //$sheet->setCellValue('B'.$row, $value->especialidad);
            /* $sheet->setCellValue('A'.$row, $value->medico);
             */

            /* $sheet->setCellValue('D'.$row, $value->paciente);
            $sheet->setCellValue('E'.$row, (int) $value->day);
            $sheet->setCellValue('F'.$row,  $mes[ (int) $value->month-1 ]);
            $sheet->setCellValue('G'.$row, (int) $value->year);
            $sheet->setCellValue('H'.$row, date("g:i A", strtotime( date("Y-m-d")." ".$value->hour )) ); */
            //COLOR DE FONDO
            /* if (date("A", strtotime( date("Y-m-d")." ".$value->hour )) =="AM") {
                $spreadsheet->getActiveSheet()->getStyle('H'.$row)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB( "ffaed0b8" );
            }else {
                $spreadsheet->getActiveSheet()->getStyle('H'.$row)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB( "fffcb44c" );
            } */


            $row++;
        }

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth('30');
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth('30');
        //$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        //$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        //$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $colWidth = $sheet->getColumnDimension('H')->getWidth();
        if ($colWidth == -1) { //not defined which means we have the standard width
            $colWidthPixels = 60; //pixels, this is the standard width of an Excel cell in pixels = 9.140625 char units outer size
        } /* else {                  //innner width is 8.43 char units
            $colWidthPixels = $colWidth * 14.0017094; //colwidht in Char Units * Pixels per CharUnit
        } */
        $offsetX = $colWidthPixels - $drawing->getWidth(); //pixels
        $drawing->setOffsetX($offsetX); //pixels
        return $spreadsheet;
    }

    public function reporteCitas_resumen_totalCitasXMedico($spreadsheet,$startDate,$endDate)
    {
        $fechaInicio = explode("-",$startDate);
        $fechaFin = explode("-",$endDate);
        $diaInicio = $fechaInicio[2];
        $mesInicio = $fechaInicio[1];
        $anioInicio = $fechaInicio[0];

        $diaFin = $fechaFin[2];
        $mesFin = $fechaFin[1];
        $anioFin = $fechaFin[0];
        $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


        //COLOR DE FONDO
        $spreadsheet->getActiveSheet()->getStyle('A1:B4')->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB( config("app.APP_BS_PRIMARY_ARGB") );

        //COLOR DE LETRA
        $spreadsheet->getActiveSheet()->getStyle('A1:B4')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

        $spreadsheet->getActiveSheet()->getStyle('A5:B5')
        ->getFont()->getColor()->setARGB( config("app.APP_BS_PRIMARY_ARGB") );
        //IMAGEN LOGO
        $drawing = new Drawing();
        $drawing->setWidth(3);
        $drawing->setHeight(50);
        $drawing->setPath('image/system/logo-cmdlt-blanco.png');
        $drawing->setCoordinates('B1');

        //$drawing->setOffsetX(40);
        $drawing->setOffsetY(10);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        //NEGRITAS
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getStyle('A1:B3' )->getFont()->setBold(true);
        $sheet->getStyle('A5:B5' )->getFont()->setBold(true);




        //CABECERA
        $sheet->setCellValue('A1', 'CMDLT');
        $sheet->setCellValue('A2', 'RESUMEN TOTAL DE CITAS COMPLETADAS POR MÉDICO');
        $sheet->setCellValue('A3', 'DESDE EL '.$diaInicio.'-'.strtoupper( $mes[ (int) $mesInicio-1 ] ).'-'.$anioInicio.' HASTA '.$diaFin.'-'.strtoupper( $mes[ (int) $mesFin-1 ] ).'-'.$anioFin);
        //COMBINAR CELDAS
        $spreadsheet->getActiveSheet()->mergeCells('A4:B4');

        $sheet->setCellValue('A4', 'CREACIÓN: '.date("d").' DE '.strtoupper( $mes[ (int) date("m")-1 ] ).' DE '.date("Y").' A LAS '.date("H:m:s A"));

        $spreadsheet->getActiveSheet()->getStyle("B4")->getFont()->setSize(5);
        $spreadsheet->getActiveSheet()->getStyle("A2")->getFont()->setSize(16);
        $sheet->getStyle('A4')->getAlignment()->setHorizontal('right');





        $model =  DB::select('
            SELECT
                uc.user_id_medico,
                COUNT(uc.user_id_medico) AS total_citas,
                uprofile.apellidos,
                uprofile.nombres

            FROM user_cita AS uc
            INNER JOIN user_profile AS uprofile ON uc.user_id_medico = uprofile.user_id
            WHERE STR_TO_DATE( CONCAT(uc.year,",",uc.month,",",uc.day ), "%Y,%m,%d" ) BETWEEN ? AND ?
            AND uc.cat_user_cita_status_id IN (7)
            GROUP BY uc.user_id_medico
        ', [$startDate, $endDate ]);
        //NOMBRE DE LA PESTAÑA
        $spreadsheet->getActiveSheet()->setTitle("Resumen Citas por Médico");




        //TITULOS
        $sheet->setCellValue('A5', 'MÉDICO');
        $sheet->setCellValue('B5', 'TOTAL CITAS');



        //REGISTROS
        $row = 6;
        foreach ($model as $key => $value) {
            $sheet->setCellValue('A'.$row, $value->nombres." ".$value->apellidos);
            $sheet->setCellValue('B'.$row, $value->total_citas);
            $row++;
        }

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth('100');
        //$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        //$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $colWidth = $sheet->getColumnDimension('B')->getWidth();
        if ($colWidth == -1) { //not defined which means we have the standard width
            $colWidthPixels = 90; //pixels, this is the standard width of an Excel cell in pixels = 9.140625 char units outer size
        }
        $offsetX = $colWidthPixels - $drawing->getWidth(); //pixels
        $drawing->setOffsetX($offsetX); //pixels
        return $spreadsheet;
    }

    public function reporteCitas_detalle_totalCitasXMedico($spreadsheet,$startDate,$endDate)
    {
        $fechaInicio = explode("-",$startDate);
        $fechaFin = explode("-",$endDate);
        $diaInicio = $fechaInicio[2];
        $mesInicio = $fechaInicio[1];
        $anioInicio = $fechaInicio[0];

        $diaFin = $fechaFin[2];
        $mesFin = $fechaFin[1];
        $anioFin = $fechaFin[0];
        $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


        //COLOR DE FONDO
        $spreadsheet->getActiveSheet()->getStyle('A1:H4')->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB( config("app.APP_BS_PRIMARY_ARGB") );

        //COLOR DE LETRA
        $spreadsheet->getActiveSheet()->getStyle('A1:H4')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

        $spreadsheet->getActiveSheet()->getStyle('A5:H5')
        ->getFont()->getColor()->setARGB( config("app.APP_BS_PRIMARY_ARGB") );
        //IMAGEN LOGO
        $drawing = new Drawing();
        $drawing->setWidth(3);
        $drawing->setHeight(50);
        $drawing->setPath('image/system/logo-cmdlt-blanco.png');
        $drawing->setCoordinates('H1');

        $drawing->setOffsetY(10);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        //NEGRITAS
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getStyle('A1:H3' )->getFont()->setBold(true);
        $sheet->getStyle('A5:H5' )->getFont()->setBold(true);




        //CABECERA
        $sheet->setCellValue('A1', 'CMDLT');
        $sheet->setCellValue('A2', 'DETALLE TOTAL DE CITAS COMPLETADAS POR MÉDICO');
        $sheet->setCellValue('A3', 'DESDE EL '.$diaInicio.'-'.strtoupper( $mes[ (int) $mesInicio-1 ] ).'-'.$anioInicio.' HASTA '.$diaFin.'-'.strtoupper( $mes[ (int) $mesFin-1 ] ).'-'.$anioFin);
        //COMBINAR CELDAS
        $spreadsheet->getActiveSheet()->mergeCells('A4:H4');

        $sheet->setCellValue('A4', 'CREACIÓN: '.date("d").' DE '.strtoupper( $mes[ (int) date("m")-1 ] ).' DE '.date("Y").' A LAS '.date("g:i:s A"));

        $spreadsheet->getActiveSheet()->getStyle("H4")->getFont()->setSize(5);
        $spreadsheet->getActiveSheet()->getStyle("A2")->getFont()->setSize(16);
        $sheet->getStyle('A4')->getAlignment()->setHorizontal('right');





        $model =  DB::select('
            SELECT
                uc.user_id_medico,
                CONCAT(upm.apellidos,", ",upm.nombres) AS medico,
                CONCAT(upp.apellidos,", ",upp.nombres) AS paciente,
                cs.description AS centro_salud,
                cue.description AS especialidad,
                uc.year,
                uc.month,
                uc.day,
                uc.hour
            FROM user_cita AS uc
            INNER JOIN user_profile AS upm ON uc.user_id_medico = upm.user_id
            INNER JOIN user_profile AS upp ON uc.user_id_medico = upp.user_id
            INNER JOIN centro_salud AS cs ON uc.centro_salud_id = cs.id
            INNER JOIN cat_user_especialidad AS cue ON uc.cat_especialidad_id = cue.id

            WHERE STR_TO_DATE( CONCAT(uc.year,",",uc.month,",",uc.day ), "%Y,%m,%d" ) BETWEEN ? AND ?
            AND uc.cat_user_cita_status_id IN (7)
            ORDER BY medico
        ', [$startDate, $endDate ]);
        //NOMBRE DE LA PESTAÑA
        $spreadsheet->getActiveSheet()->setTitle("Detalle Citas por Médico");




        //TITULOS
        $sheet->setCellValue('A5', 'MÉDICO');
        $sheet->setCellValue('B5', 'ESPECIALIDAD');
        $sheet->setCellValue('C5', 'CENTRO DE SALUD');
        $sheet->setCellValue('D5', 'PACIENTE');
        $sheet->setCellValue('E5', 'DIA');
        $sheet->setCellValue('F5', 'MES');
        $sheet->setCellValue('G5', 'AÑO');
        $sheet->setCellValue('H5', 'HORA');



        //REGISTROS
        $row = 6;
        foreach ($model as $key => $value) {
            $sheet->setCellValue('A'.$row, $value->medico);
            $sheet->setCellValue('B'.$row, $value->especialidad);
            $sheet->setCellValue('C'.$row, $value->centro_salud);
            $sheet->setCellValue('D'.$row, $value->paciente);
            $sheet->setCellValue('E'.$row, (int) $value->day);
            $sheet->setCellValue('F'.$row,  $mes[ (int) $value->month-1 ]);
            $sheet->setCellValue('G'.$row, (int) $value->year);
            $sheet->setCellValue('H'.$row, date("g:i A", strtotime( date("Y-m-d")." ".$value->hour )) );
            //COLOR DE FONDO
            if (date("A", strtotime( date("Y-m-d")." ".$value->hour )) =="AM") {
                $spreadsheet->getActiveSheet()->getStyle('H'.$row)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB( "ffaed0b8" );
            }else {
                $spreadsheet->getActiveSheet()->getStyle('H'.$row)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB( "fffcb44c" );
            }


            $row++;
        }

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth('80');
        //$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        //$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $colWidth = $sheet->getColumnDimension('H')->getWidth();
        if ($colWidth == -1) { //not defined which means we have the standard width
            $colWidthPixels = 60; //pixels, this is the standard width of an Excel cell in pixels = 9.140625 char units outer size
        } /* else {                  //innner width is 8.43 char units
            $colWidthPixels = $colWidth * 14.0017094; //colwidht in Char Units * Pixels per CharUnit
        } */
        $offsetX = $colWidthPixels - $drawing->getWidth(); //pixels
        $drawing->setOffsetX($offsetX); //pixels
        return $spreadsheet;
    }

    public function reporteCitas_detalle_totalCitasCreadas($spreadsheet,$startDate,$endDate)
    {
        $abc = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
        $fechaInicio = explode("-",$startDate);
        $fechaFin = explode("-",$endDate);
        $diaInicio = $fechaInicio[2];
        $mesInicio = $fechaInicio[1];
        $anioInicio = $fechaInicio[0];
        $LETRA_ULTIMA_COLUMNA = $abc[16];
        $diaFin = $fechaFin[2];
        $mesFin = $fechaFin[1];
        $anioFin = $fechaFin[0];
        $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        //COLOR DE FONDO
        $spreadsheet->getActiveSheet()->getStyle($abc[0].'1:'.$LETRA_ULTIMA_COLUMNA.'4')->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB( config("app.APP_BS_PRIMARY_ARGB") );

        //COLOR DE LETRA
        $spreadsheet->getActiveSheet()->getStyle($abc[0].'1:'.$LETRA_ULTIMA_COLUMNA.'4')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

        $spreadsheet->getActiveSheet()->getStyle($abc[0].'5:'.$LETRA_ULTIMA_COLUMNA.'5')
        ->getFont()->getColor()->setARGB( config("app.APP_BS_PRIMARY_ARGB") );
        //IMAGEN LOGO
        $drawing = new Drawing();
        $drawing->setWidth(3);
        $drawing->setHeight(50);
        $drawing->setPath('image/system/logo-cmdlt-blanco.png');
        $drawing->setCoordinates($LETRA_ULTIMA_COLUMNA.'1');

        $drawing->setOffsetY(10);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        //NEGRITAS
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getStyle($abc[0].'1:'.$LETRA_ULTIMA_COLUMNA.'3' )->getFont()->setBold(true);
        $sheet->getStyle($abc[0].'5:'.$LETRA_ULTIMA_COLUMNA.'5' )->getFont()->setBold(true);




        //CABECERA
        $sheet->setCellValue($abc[0].'1', 'CMDLT');
        $sheet->setCellValue($abc[0].'2', 'SOLICITUD DE CITAS');
        $sheet->setCellValue($abc[0].'3', 'DESDE EL '.$diaInicio.'-'.strtoupper( $mes[ (int) $mesInicio-1 ] ).'-'.$anioInicio.' HASTA '.$diaFin.'-'.strtoupper( $mes[ (int) $mesFin-1 ] ).'-'.$anioFin);
        //COMBINAR CELDAS
        $spreadsheet->getActiveSheet()->mergeCells($abc[0].'4:'.$LETRA_ULTIMA_COLUMNA.'4');

        $sheet->setCellValue($abc[0].'4', 'CREACIÓN: '.date("d").' DE '.strtoupper( $mes[ (int) date("m")-1 ] ).' DE '.date("Y").' A LAS '.date("g:i:s A"));

        $spreadsheet->getActiveSheet()->getStyle($LETRA_ULTIMA_COLUMNA."4")->getFont()->setSize(5);
        $spreadsheet->getActiveSheet()->getStyle($abc[0]."2")->getFont()->setSize(16);
        $sheet->getStyle($abc[0].'4')->getAlignment()->setHorizontal('right');

        try {
            $model =  DB::select('
                    SELECT
                        uc.user_id_medico,
                        CONCAT(upm.apellidos,", ",upm.nombres) AS medico,
                        CONCAT(upp.apellidos,", ",upp.nombres) AS paciente,
                        upp.cedula AS cedula_paciente,
                        upp.telefono_movil AS telefono_paciente,
                        userPac.email AS correo_paciente,
                        cs.description AS centro_salud,
                        cue.description AS especialidad,
                        uc.year,
                        uc.month,
                        uc.day,
                        uc.hour,
                        uc.created_at AS fecha_solicitud,
                        uc.coments2 AS motivo_cancelacion,
                        cucs.description AS status_cita,
                        uc.reason_for_consultation AS motivo_consulta
                    FROM user_cita AS uc
                    INNER JOIN cat_user_cita_status AS cucs ON uc.cat_user_cita_status_id = cucs.id
                    INNER JOIN user_profile AS upm ON uc.user_id_medico = upm.user_id
                    INNER JOIN user_profile AS upp ON uc.user_id_paciente = upp.user_id
                    INNER JOIN user AS userPac ON uc.user_id_paciente = userPac.id
                    INNER JOIN centro_salud AS cs ON uc.centro_salud_id = cs.id
                    INNER JOIN cat_user_especialidad AS cue ON uc.cat_especialidad_id = cue.id

                    WHERE uc.created_at BETWEEN ? AND ?
                    AND cue.active = 1

                ', [$startDate." 00:00:00", $endDate." 23:59:59" ]);
        } catch (\Throwable $th) {
            throw $th;
        }


        //NOMBRE DE LA PESTAÑA
        $spreadsheet->getActiveSheet()->setTitle("Solicitud de citas");

        //http://127.0.0.1:8000/user/paciente/cita/reporteCitasCreadas/2022-01-01/2023-01-09

        //TITULOS
        $sheet->setCellValue( $abc[0].'5', '#');
        $sheet->setCellValue( $abc[1].'5', 'ESTATUS');
        $sheet->setCellValue( $abc[2].'5', 'PACIENTE');
        $sheet->setCellValue( $abc[3].'5', 'CEDULA');
        $sheet->setCellValue( $abc[4].'5', 'TELEFONO');
        $sheet->setCellValue( $abc[5].'5', 'CORREO');
        $sheet->setCellValue( $abc[6].'5', 'ESPECIALIDAD');
        $sheet->setCellValue( $abc[7].'5', 'CENTRO DE SALUD');
        $sheet->setCellValue( $abc[8].'5', 'MÉDICO');
        $sheet->setCellValue( $abc[9].'5', 'DIA');
        $sheet->setCellValue($abc[10].'5', 'MES');
        $sheet->setCellValue($abc[11].'5', 'AÑO');
        $sheet->setCellValue($abc[12].'5', 'HORA');
        $sheet->setCellValue($abc[13].'5', 'MOTIVO DE CONSULTA');
        $sheet->setCellValue($abc[14].'5', 'MOTIVO DE CANCELACIÓN');
        $sheet->setCellValue($abc[15].'5', 'FECHA DE CREACIÓN');



        //REGISTROS
        $row = 6;
        foreach ($model as $key => $value) {

            $sheet->setCellValue( $abc[0].$row, ($key + 1) );
            $sheet->setCellValue( $abc[1].$row, $value->status_cita);
            $sheet->setCellValue( $abc[2].$row, $value->paciente);
            $sheet->setCellValue( $abc[3].$row, $value->cedula_paciente);
            $sheet->setCellValue( $abc[4].$row, (String) $value->telefono_paciente);
            $sheet->setCellValue( $abc[5].$row, $value->correo_paciente);
            $sheet->setCellValue( $abc[6].$row, $value->especialidad);
            $sheet->setCellValue( $abc[7].$row, $value->centro_salud);
            $sheet->setCellValue( $abc[8].$row, $value->medico);
            $sheet->setCellValue( $abc[9].$row, (int) $value->day);
            $sheet->setCellValue($abc[10].$row,  $mes[ (int) $value->month-1 ]);
            $sheet->setCellValue($abc[11].$row, (int) $value->year);
            $sheet->setCellValue($abc[12].$row, date("g:i A", strtotime( date("Y-m-d")." ".$value->hour )) );
            $sheet->setCellValue($abc[13].$row, $value->motivo_consulta);
            $sheet->setCellValue($abc[14].$row, $value->motivo_cancelacion);
            $sheet->setCellValue($abc[15].$row, $value->fecha_solicitud);

            $sheet->getStyle( $abc[4].$row)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
            //COLOR DE FONDO
            if ($value->status_cita =="Creada") {
                $spreadsheet->getActiveSheet()->getStyle($abc[1].$row)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB( "ffaed0b8" );
            }
            if ($value->status_cita =="Cancelada") {
                $spreadsheet->getActiveSheet()->getStyle($abc[1].$row)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB( "fffdafaf" );
            }

            if (date("A", strtotime( date("Y-m-d")." ".$value->hour )) =="AM") {
                $spreadsheet->getActiveSheet()->getStyle($abc[12].$row)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB( "ffaed0b8" );
            }else {
                $spreadsheet->getActiveSheet()->getStyle($abc[12].$row)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB( "fffcb44c" );
            }


            $row++;
        }


        //$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        //$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        for ($i=1; $i < 16 ; $i++) {
            $spreadsheet->getActiveSheet()->getColumnDimension($abc[$i])->setWidth('30');
            //$spreadsheet->getActiveSheet()->getColumnDimension($abc[$i])->setAutoSize(true);
        }
        $spreadsheet->getActiveSheet()->getColumnDimension($abc[0])->setWidth('8');
        $spreadsheet->getActiveSheet()->getColumnDimension($abc[1])->setWidth('12');
        $spreadsheet->getActiveSheet()->getColumnDimension($abc[3])->setWidth('12');
        $spreadsheet->getActiveSheet()->getColumnDimension($abc[4])->setWidth('20');
        $spreadsheet->getActiveSheet()->getColumnDimension($abc[9])->setWidth('8');
        $spreadsheet->getActiveSheet()->getColumnDimension($abc[10])->setWidth('8');
        $spreadsheet->getActiveSheet()->getColumnDimension($abc[11])->setWidth('8');

        /* */

        $colWidth = $sheet->getColumnDimension($LETRA_ULTIMA_COLUMNA)->getWidth();
        if ($colWidth == -1) { //not defined which means we have the standard width
            $colWidthPixels = 60; //pixels, this is the standard width of an Excel cell in pixels = 9.140625 char units outer size
        }
        $offsetX = $colWidthPixels - $drawing->getWidth(); //pixels
        $drawing->setOffsetX($offsetX); //pixels
        return $spreadsheet;
    }

    public function reporteCitas_detalle_totalCitasCreadasGerentes($spreadsheet,$startDate,$endDate)
    {
        $abc = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
        $fechaInicio = explode("-",$startDate);
        $fechaFin = explode("-",$endDate);
        $diaInicio = $fechaInicio[2];
        $mesInicio = $fechaInicio[1];
        $anioInicio = $fechaInicio[0];
        $LETRA_ULTIMA_COLUMNA = $abc[16];
        $diaFin = $fechaFin[2];
        $mesFin = $fechaFin[1];
        $anioFin = $fechaFin[0];
        $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        //COLOR DE FONDO
        $spreadsheet->getActiveSheet()->getStyle($abc[0].'1:'.$LETRA_ULTIMA_COLUMNA.'4')->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB( config("app.APP_BS_PRIMARY_ARGB") );

        //COLOR DE LETRA
        $spreadsheet->getActiveSheet()->getStyle($abc[0].'1:'.$LETRA_ULTIMA_COLUMNA.'4')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

        $spreadsheet->getActiveSheet()->getStyle($abc[0].'5:'.$LETRA_ULTIMA_COLUMNA.'5')
        ->getFont()->getColor()->setARGB( config("app.APP_BS_PRIMARY_ARGB") );
        //IMAGEN LOGO
        $drawing = new Drawing();
        $drawing->setWidth(3);
        $drawing->setHeight(50);
        $drawing->setPath('image/system/logo-cmdlt-blanco.png');
        $drawing->setCoordinates($LETRA_ULTIMA_COLUMNA.'1');

        $drawing->setOffsetY(10);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        //NEGRITAS
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getStyle($abc[0].'1:'.$LETRA_ULTIMA_COLUMNA.'3' )->getFont()->setBold(true);
        $sheet->getStyle($abc[0].'5:'.$LETRA_ULTIMA_COLUMNA.'5' )->getFont()->setBold(true);




        //CABECERA
        $sheet->setCellValue($abc[0].'1', 'CMDLT');
        $sheet->setCellValue($abc[0].'2', 'SOLICITUD DE CITAS');
        $sheet->setCellValue($abc[0].'3', 'DESDE EL '.$diaInicio.'-'.strtoupper( $mes[ (int) $mesInicio-1 ] ).'-'.$anioInicio.' HASTA '.$diaFin.'-'.strtoupper( $mes[ (int) $mesFin-1 ] ).'-'.$anioFin);
        //COMBINAR CELDAS
        $spreadsheet->getActiveSheet()->mergeCells($abc[0].'4:'.$LETRA_ULTIMA_COLUMNA.'4');

        $sheet->setCellValue($abc[0].'4', 'CREACIÓN: '.date("d").' DE '.strtoupper( $mes[ (int) date("m")-1 ] ).' DE '.date("Y").' A LAS '.date("g:i:s A"));

        $spreadsheet->getActiveSheet()->getStyle($LETRA_ULTIMA_COLUMNA."4")->getFont()->setSize(5);
        $spreadsheet->getActiveSheet()->getStyle($abc[0]."2")->getFont()->setSize(16);
        $sheet->getStyle($abc[0].'4')->getAlignment()->setHorizontal('right');

        try {
            $model =  DB::select('
                    SELECT
                        uc.user_id_medico,
                        CONCAT(upm.apellidos,", ",upm.nombres) AS medico,
                        CONCAT(upp.apellidos,", ",upp.nombres) AS paciente,
                        upp.cedula AS cedula_paciente,
                        upp.telefono_movil AS telefono_paciente,
                        userPac.email AS correo_paciente,
                        cs.description AS centro_salud,
                        cue.description AS especialidad,
                        uc.year,
                        uc.month,
                        uc.day,
                        uc.hour,
                        uc.created_at AS fecha_solicitud,
                        uc.coments2 AS motivo_cancelacion,
                        cucs.description AS status_cita,
                        uc.reason_for_consultation AS motivo_consulta
                    FROM user_cita AS uc
                    INNER JOIN cat_user_cita_status AS cucs ON uc.cat_user_cita_status_id = cucs.id
                    INNER JOIN user_profile AS upm ON uc.user_id_medico = upm.user_id
                    INNER JOIN user_profile AS upp ON uc.user_id_paciente = upp.user_id
                    INNER JOIN user AS userPac ON uc.user_id_paciente = userPac.id
                    INNER JOIN centro_salud AS cs ON uc.centro_salud_id = cs.id
                    INNER JOIN cat_user_especialidad AS cue ON uc.cat_especialidad_id = cue.id

                    WHERE uc.created_at BETWEEN ? AND ?
                    AND cue.active = 1
                    AND uc.centro_salud_id = '.session("user_centro_salud_id").'

                ', [$startDate." 00:00:00", $endDate." 23:59:59" ]);
        } catch (\Throwable $th) {
            throw $th;
        }


        //NOMBRE DE LA PESTAÑA
        $spreadsheet->getActiveSheet()->setTitle("Solicitud de citas");

        //http://127.0.0.1:8000/user/paciente/cita/reporteCitasCreadas/2022-01-01/2023-01-09

        //TITULOS
        $sheet->setCellValue( $abc[0].'5', '#');
        $sheet->setCellValue( $abc[1].'5', 'ESTATUS');
        $sheet->setCellValue( $abc[2].'5', 'PACIENTE');
        $sheet->setCellValue( $abc[3].'5', 'CEDULA');
        $sheet->setCellValue( $abc[4].'5', 'TELEFONO');
        $sheet->setCellValue( $abc[5].'5', 'CORREO');
        $sheet->setCellValue( $abc[6].'5', 'ESPECIALIDAD');
        $sheet->setCellValue( $abc[7].'5', 'CENTRO DE SALUD');
        $sheet->setCellValue( $abc[8].'5', 'MÉDICO');
        $sheet->setCellValue( $abc[9].'5', 'DIA');
        $sheet->setCellValue($abc[10].'5', 'MES');
        $sheet->setCellValue($abc[11].'5', 'AÑO');
        $sheet->setCellValue($abc[12].'5', 'HORA');
        $sheet->setCellValue($abc[13].'5', 'MOTIVO DE CONSULTA');
        $sheet->setCellValue($abc[14].'5', 'MOTIVO DE CANCELACIÓN');
        $sheet->setCellValue($abc[15].'5', 'FECHA DE CREACIÓN');



        //REGISTROS
        $row = 6;
        foreach ($model as $key => $value) {

            $sheet->setCellValue( $abc[0].$row, ($key + 1) );
            $sheet->setCellValue( $abc[1].$row, $value->status_cita);
            $sheet->setCellValue( $abc[2].$row, $value->paciente);
            $sheet->setCellValue( $abc[3].$row, $value->cedula_paciente);
            $sheet->setCellValue( $abc[4].$row, $value->telefono_paciente);
            $sheet->setCellValue( $abc[5].$row, $value->correo_paciente);
            $sheet->setCellValue( $abc[6].$row, $value->especialidad);
            $sheet->setCellValue( $abc[7].$row, $value->centro_salud);
            $sheet->setCellValue( $abc[8].$row, $value->medico);
            $sheet->setCellValue( $abc[9].$row, (int) $value->day);
            $sheet->setCellValue($abc[10].$row,  $mes[ (int) $value->month-1 ]);
            $sheet->setCellValue($abc[11].$row, (int) $value->year);
            $sheet->setCellValue($abc[12].$row, date("g:i A", strtotime( date("Y-m-d")." ".$value->hour )) );
            $sheet->setCellValue($abc[13].$row, $value->motivo_consulta);
            $sheet->setCellValue($abc[14].$row, $value->motivo_cancelacion);
            $sheet->setCellValue($abc[15].$row, $value->fecha_solicitud);


            //COLOR DE FONDO
            if ($value->status_cita =="Creada") {
                $spreadsheet->getActiveSheet()->getStyle($abc[1].$row)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB( "ffaed0b8" );
            }
            if ($value->status_cita =="Cancelada") {
                $spreadsheet->getActiveSheet()->getStyle($abc[1].$row)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB( "fffdafaf" );
            }

            if (date("A", strtotime( date("Y-m-d")." ".$value->hour )) =="AM") {
                $spreadsheet->getActiveSheet()->getStyle($abc[12].$row)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB( "ffaed0b8" );
            }else {
                $spreadsheet->getActiveSheet()->getStyle($abc[12].$row)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB( "fffcb44c" );
            }


            $row++;
        }


        //$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        //$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        for ($i=1; $i < 16 ; $i++) {
            $spreadsheet->getActiveSheet()->getColumnDimension($abc[$i])->setWidth('30');
            //$spreadsheet->getActiveSheet()->getColumnDimension($abc[$i])->setAutoSize(true);
        }
        $spreadsheet->getActiveSheet()->getColumnDimension($abc[0])->setWidth('8');
        $spreadsheet->getActiveSheet()->getColumnDimension($abc[1])->setWidth('12');
        $spreadsheet->getActiveSheet()->getColumnDimension($abc[3])->setWidth('12');
        $spreadsheet->getActiveSheet()->getColumnDimension($abc[4])->setWidth('20');
        $spreadsheet->getActiveSheet()->getColumnDimension($abc[9])->setWidth('8');
        $spreadsheet->getActiveSheet()->getColumnDimension($abc[10])->setWidth('8');
        $spreadsheet->getActiveSheet()->getColumnDimension($abc[11])->setWidth('8');

        /* */

        $colWidth = $sheet->getColumnDimension($LETRA_ULTIMA_COLUMNA)->getWidth();
        if ($colWidth == -1) { //not defined which means we have the standard width
            $colWidthPixels = 60; //pixels, this is the standard width of an Excel cell in pixels = 9.140625 char units outer size
        }
        $offsetX = $colWidthPixels - $drawing->getWidth(); //pixels
        $drawing->setOffsetX($offsetX); //pixels
        return $spreadsheet;
    }
    public function getCitasByDay(Request $request)
    {
        $data = (array) json_decode($request->data);
       /*  echo "<pre>";
        echo   $request->data;
        echo "</pre>"; */
        $model = new UserCita();
        $model = $model->join("user_profile AS upPac","user_cita.user_id_paciente","upPac.user_id");
        $model = $model->whereNotIn("cat_user_cita_status_id",[3,7,8,9]);
        $model = $model->join("user AS userPac","user_cita.user_id_paciente","userPac.id");
        $model = $model->join("cat_user_cita_status AS cuce","user_cita.cat_user_cita_status_id","cuce.id");

        $model = $model->where("centro_salud_id",$data['centro_salud_id']);
        $model = $model->where("cat_especialidad_id",$data['cat_especialidad_id']);
        $model = $model->where("year", $data['year'] );
        $model = $model->where("month", $data['month'] );
        $model = $model->where("day", $data['day'] );

        $model = $model->select(
                "userPac.email as email_paciente",
                "user_cita.*",
                "upPac.*",
                DB::raw("
                    user_cita.id AS user_cita_id
                "),
                DB::raw("
                    user_cita.reason_for_consultation AS cita_motivo
                "),
                DB::raw("
                    CONCAT(
                        upPac.nombres,
                        ' ' ,
                        upPac.apellidos
                    ) AS paciente
                "),
                DB::raw("
                    cuce.description AS cat_user_cita_status_description
                "),
                DB::raw("
                YEAR(CURDATE())-YEAR(upPac.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(upPac.fnacimiento,'%m-%d'), 0 , -1 ) AS edad
                "),
                DB::raw("

                    CONCAT(
                        user_cita.year,'-',
                        user_cita.month,'-',
                        user_cita.day,' ',
                        user_cita.hour
                    ) AS fecha_cita
                "),
                DB::raw("
                    CASE
                        WHEN user_cita.cat_user_cita_status_id = 1 THEN 'info'
                        WHEN user_cita.cat_user_cita_status_id = 2 THEN 'warning'
                        WHEN user_cita.cat_user_cita_status_id = 3 THEN 'danger'
                        WHEN user_cita.cat_user_cita_status_id = 4 THEN 'success'
                        WHEN user_cita.cat_user_cita_status_id = 5 THEN 'warning'
                        WHEN user_cita.cat_user_cita_status_id = 6 THEN 'success'
                        WHEN user_cita.cat_user_cita_status_id = 7 THEN 'success'
                        WHEN user_cita.cat_user_cita_status_id = 8 THEN 'secondary'
                        WHEN user_cita.cat_user_cita_status_id = 9 THEN 'danger'
                        ELSE 'info'
                    END AS cat_user_cita_status_id_color
                "),
                DB::raw("
                    CASE
                        WHEN user_cita.cat_user_cita_status_id = 1 THEN 'pc-cita_por_confirmar'
                        WHEN user_cita.cat_user_cita_status_id = 2 THEN 'pc-cita_reprogramada'
                        WHEN user_cita.cat_user_cita_status_id = 3 THEN 'pc-cita_cancelada'
                        WHEN user_cita.cat_user_cita_status_id = 4 THEN 'pc-cita_confirmada'
                        WHEN user_cita.cat_user_cita_status_id = 5 THEN 'pc-preconsulta'
                        WHEN user_cita.cat_user_cita_status_id = 6 THEN 'pc-consulta'
                        WHEN user_cita.cat_user_cita_status_id = 7 THEN 'pc-check'
                        WHEN user_cita.cat_user_cita_status_id = 8 THEN 'pc-check'
                        WHEN user_cita.cat_user_cita_status_id = 9 THEN 'pc-check'
                        ELSE 'pc-cita_por_confirmar'
                        END AS cat_user_cita_status_id_icono
                ")
            );
        return $model = $model->get()->toArray();

    }

    public function existeCita(Request $request)
    {
        //dd($request->all());
        //VALIDAR SI YA EXISTE UNA CITA EL DIA Y HORA A REGISTRAR
        return Response()->json(UserCita::where("user_id_medico",$request->user_id_medico)
        //->whereNotIn("cat_user_cita_status_id",[3,7,8,9])
        ->where("centro_salud_id",$request->centro_salud_id)
        ->where("cat_especialidad_id",$request->cat_especialidad_id)
        ->where("year", date("Y",strtotime($request->cita_hora)) )
        ->where("month", date("m",strtotime($request->cita_hora)) )
        ->where("day", date("d",strtotime($request->cita_hora)) )
        ->where("hour", date("H:i",strtotime($request->cita_hora)) )
        ->where("cancelada_paciente",0)
        ->whereIn('cancelada_medico', [0,1])
        ->whereIn('reprogramada', [0,1])
        ->count());
    }

    public function historial(Request $request)
    {
        $model = new UserCita();
        $model = $model->whereIn("cat_user_cita_status_id",[3,7,8,9]);
        $model = $model->where("user_id_paciente", $request->user_id_paciente);
        $model = $model->join("user_profile AS upPac","user_cita.user_id_paciente","upPac.user_id");
        $model = $model->join("user_profile AS upMed","user_cita.user_id_medico","upMed.user_id");
        $model = $model->join("centro_salud AS cs","user_cita.centro_salud_id","cs.id");
        $model = $model->join("cat_user_especialidad AS cue","user_cita.cat_especialidad_id","cue.id");
        $model = $model->join("cat_user_cita_status AS cuce","user_cita.cat_user_cita_status_id","cuce.id");
        $model = $model->select(
            "user_cita.*",
            DB::raw("
                CONCAT(
                    upPac.nombres,
                    ' ' ,
                    upPac.apellidos
                ) AS paciente
            "),
            DB::raw("
                CONCAT(
                    upMed.nombres,
                    ' ',
                    upMed.apellidos
                ) AS medico
            "),
            DB::raw("
                upMed.imagen AS medico_imagen
            "),
            DB::raw("
                cs.description AS centro_salud_description
            "),
            DB::raw("
                cue.description AS especialidad_description
            "),
            DB::raw("
                cue.image AS especialidad_imagen
            "),
            DB::raw("
                cuce.description AS cat_user_cita_status_description
            "),
            DB::raw("

                CONCAT(
                    user_cita.year,'-',
                    user_cita.month,'-',
                    user_cita.day,' ',
                    user_cita.hour
                ) AS fecha_cita
            "),
            DB::raw("
                CASE
                    WHEN user_cita.cat_user_cita_status_id = 1 THEN 'info'
                    WHEN user_cita.cat_user_cita_status_id = 2 THEN 'warning'
                    WHEN user_cita.cat_user_cita_status_id = 3 THEN 'danger'
                    WHEN user_cita.cat_user_cita_status_id = 4 THEN 'success'
                    WHEN user_cita.cat_user_cita_status_id = 5 THEN 'warning'
                    WHEN user_cita.cat_user_cita_status_id = 6 THEN 'success'
                    WHEN user_cita.cat_user_cita_status_id = 7 THEN 'success'
                    WHEN user_cita.cat_user_cita_status_id = 8 THEN 'secondary'
                    WHEN user_cita.cat_user_cita_status_id = 9 THEN 'danger'
                    ELSE 'info'
                END AS cat_user_cita_status_id_color
            "),
            DB::raw("
                CASE
                    WHEN user_cita.cat_user_cita_status_id = 1 THEN 'pc-cita_por_confirmar'
                    WHEN user_cita.cat_user_cita_status_id = 2 THEN 'pc-cita_reprogramada'
                    WHEN user_cita.cat_user_cita_status_id = 3 THEN 'pc-cita_cancelada'
                    WHEN user_cita.cat_user_cita_status_id = 4 THEN 'pc-cita_confirmada'
                    WHEN user_cita.cat_user_cita_status_id = 5 THEN 'pc-preconsulta'
                    WHEN user_cita.cat_user_cita_status_id = 6 THEN 'pc-consulta'
                    WHEN user_cita.cat_user_cita_status_id = 7 THEN 'pc-check'
                    WHEN user_cita.cat_user_cita_status_id = 8 THEN 'pc-check'
                    WHEN user_cita.cat_user_cita_status_id = 9 THEN 'pc-check'
                    ELSE 'pc-cita_por_confirmar'
                    END AS cat_user_cita_status_id_icono
            ")
        );
        $model = $model->get();
        return $model;
    }

    public function getDataPaciente($user_cita_id)
    {
        $cita = [];
        $cita["user_peso"]                  = UserCuestPeso::where("user_cita_id",$user_cita_id)->first();
        $cita["user_altura"]                = UserCuestAltura::where("user_cita_id",$user_cita_id)->first();
        $cita["user_temp"]                  = UserTemp::where("user_cita_id",$user_cita_id)->first();
        $cita["user_spo2"]                  = UserOxi::where("user_cita_id",$user_cita_id)->first();
        $cita["user_fc"]                    = UserFc::where("user_cita_id",$user_cita_id)->first();
        $cita["user_fr"]                    = UserFr::where("user_cita_id",$user_cita_id)->first();
        $cita["user_glic"]                  = UserGlic::where("user_cita_id",$user_cita_id)->first();
        $cita["user_ta"]                    = UserTa::where("user_cita_id",$user_cita_id)->first();
        $cita["user_motivo_consulta"]       = MotivoConsulta::where("user_cita_id",$user_cita_id)->first();
        $cita["user_impresion_diagnostica"] = UserCuestImpresionDiagnostica::where("user_cita_id",$user_cita_id)->first();
        $cita["user_examen_fisico"]         = ExamenFisico::where("user_cita_id",$user_cita_id)->first();
        $cita["user_enfermedad_actual"]     = EnfermedadActual::where("user_cita_id",$user_cita_id)->first();
        $cita["user_plan"]                  = UserCuestPlan::where("user_cita_id",$user_cita_id)->first();
        return $cita;
    }
    public function getDataPaciente2($user_id_paciente)
    {
        $model = [];
        $model["user_recipe"]               = UserCuestRecipe::where("user_id",$user_id_paciente )->orderBy("id","DESC")->get()->toArray();
        $model["user_estudio"]              = UserCuestEstudio::where("user_id",$user_id_paciente )->orderBy("id","DESC")->get()->toArray();
        $model["user_laboratorio"]          = UserCuestLaboratorio::where("user_id",$user_id_paciente )->orderBy("id","DESC")->get()->toArray();
        $model["user_fotografia"]           = UserCuestFotografia::where("user_id",$user_id_paciente )->orderBy("id","DESC")->get()->toArray();
        $model["user_imagenes"]             = UserCuestImagen::where("user_id",$user_id_paciente )->orderBy("id","DESC")->get()->toArray();
        $model["user_otro_archivo"]         = UserCuestOtroArchivo::where("user_id",$user_id_paciente )->orderBy("id","DESC")->get()->toArray();
        return $model;
    }
    public function activa(Request $request)
    {
        $familiar = UserFamily::where("user_id_paciente",$request->user_id_paciente)
            ->pluck("user_id_pariente");
        if(!empty($familiar)){
            $familiar = $familiar->toArray();
        }else{
            $familiar = [];
        }

        $model = new UserCita();
        $model = $model->whereNotIn("cat_user_cita_status_id",[3,7,8,9]);
        $model = $model->whereIn("user_id_paciente", array_merge($familiar,[$request->user_id_paciente]) );
        $model = $model->join("user_profile AS upPac","user_cita.user_id_paciente","upPac.user_id");
        $model = $model->join("user_profile AS upMed","user_cita.user_id_medico","upMed.user_id");
        $model = $model->join("centro_salud AS cs","user_cita.centro_salud_id","cs.id");
        $model = $model->join("cat_user_especialidad AS cue","user_cita.cat_especialidad_id","cue.id");
        $model = $model->join("cat_user_cita_status AS cuce","user_cita.cat_user_cita_status_id","cuce.id");
        $model = $model->select(
            "user_cita.*",
            DB::raw("
                CONCAT(
                    upPac.nombres,
                    ' ' ,
                    upPac.apellidos
                ) AS paciente
            "),
            DB::raw("
                CONCAT(
                    upMed.nombres,
                    ' ',
                    upMed.apellidos
                ) AS medico
            "),
            DB::raw("
                upMed.imagen AS medico_imagen
            "),
            DB::raw("
                cs.description AS centro_salud_description
            "),
            DB::raw("
                cue.description AS especialidad_description
            "),
            DB::raw("
                cue.image AS especialidad_imagen
            "),
            DB::raw("
                cuce.description AS cat_user_cita_status_description
            "),
            DB::raw("

                CONCAT(
                    user_cita.year,'-',
                    user_cita.month,'-',
                    user_cita.day,' ',
                    user_cita.hour
                ) AS fecha_cita
            "),
            DB::raw("
                CASE
                    WHEN user_cita.cat_user_cita_status_id = 1 THEN 'info'
                    WHEN user_cita.cat_user_cita_status_id = 2 THEN 'warning'
                    WHEN user_cita.cat_user_cita_status_id = 3 THEN 'danger'
                    WHEN user_cita.cat_user_cita_status_id = 4 THEN 'success'
                    WHEN user_cita.cat_user_cita_status_id = 5 THEN 'warning'
                    WHEN user_cita.cat_user_cita_status_id = 6 THEN 'success'
                    WHEN user_cita.cat_user_cita_status_id = 7 THEN 'success'
                    WHEN user_cita.cat_user_cita_status_id = 8 THEN 'secondary'
                    WHEN user_cita.cat_user_cita_status_id = 9 THEN 'danger'
                    ELSE 'info'
                END AS cat_user_cita_status_id_color
            "),
            DB::raw("
                CASE
                    WHEN user_cita.cat_user_cita_status_id = 1 THEN 'pc-cita_por_confirmar'
                    WHEN user_cita.cat_user_cita_status_id = 2 THEN 'pc-cita_reprogramada'
                    WHEN user_cita.cat_user_cita_status_id = 3 THEN 'pc-cita_cancelada'
                    WHEN user_cita.cat_user_cita_status_id = 4 THEN 'pc-cita_confirmada'
                    WHEN user_cita.cat_user_cita_status_id = 5 THEN 'pc-preconsulta'
                    WHEN user_cita.cat_user_cita_status_id = 6 THEN 'pc-consulta'
                    WHEN user_cita.cat_user_cita_status_id = 7 THEN 'pc-check'
                    WHEN user_cita.cat_user_cita_status_id = 8 THEN 'pc-check'
                    WHEN user_cita.cat_user_cita_status_id = 9 THEN 'pc-check'
                    ELSE 'pc-cita_por_confirmar'
                    END AS cat_user_cita_status_id_icono
            ")
        );
        $model = $model->get();


        return $model;
    }

    public function referencia_store(Request $request)
    {
        $model = UserCita::referencia_store($request);



        return Response()->json( $model ) ;



    }

    public function getCitasByMedico(Request $request)
    {
        return UserCita::index_medico();
    }

    public function getAllByMedico(Request $request)
    {
        $model = new UserCita();
        $model = $model->join("cat_user_especialidad AS cue","user_cita.cat_especialidad_id","cue.id");
        $model = $model->leftJoin("user_cuest_direction AS ucd","user_cita.user_id_paciente","ucd.user_id");
        $model = $model->join("centro_salud","user_cita.centro_salud_id","centro_salud.id");
        $model = $model->leftJoin("user_profile AS upAuto","user_cita.user_id_autorizacion","upAuto.user_id");
        $model = $model->join("user_profile AS upMed","user_cita.user_id_medico","upMed.user_id");
        $model = $model->join("user_profile AS upPac","user_cita.user_id_paciente","upPac.user_id");
        $model = $model->join("user","user_cita.user_id_paciente","user.id");
        $model = $model->leftJoin("tarjeta_soy_chacao","user_cita.user_id_paciente","tarjeta_soy_chacao.user_id_paciente");
        $model = $model->whereIn("cat_user_cita_status_id",[1,2,4,5,6]);
        $model = $model->where("user_id_medico",$request->user_id_medico);
        $model = $model->where("year",date("Y"));
        $model = $model->where("month",">=",date("m"));
        $model = $model->where("day",">=",date("d"));
        $model = $model->select(
            "user_cita.*",
            "ucd.cat_estado_id",
            "ucd.cat_municipio_id",
            "ucd.description",
            "ucd.domicilio",
            DB::raw("
                centro_salud.description AS centro_salud_description
            "),
            DB::raw("
                user.email
            "),
            DB::raw("
                tarjeta_soy_chacao.description AS tarjeta_soy_chacao
            "),
            DB::raw("
                CASE
                    WHEN upPac.fnacimiento IS NULL THEN ''
                    ELSE  DATE_FORMAT(upPac.fnacimiento, '%d/%m/%Y')
                END AS nacimiento
            "),
            DB::raw("
                upPac.imagen AS imagen_paciente
            "),
            DB::raw("
                upPac.telefono_movil
            "),
            DB::raw("
                CONCAT(
                    upPac.nacionalidad,
                    upPac.cedula
                ) AS cedula_paciente
            "),
            DB::raw("
                upPac.genero AS genero_paciente
            "),
            DB::raw("
                upMed.imagen AS imagen_medico
            "),
            DB::raw("
            YEAR(CURDATE())-YEAR(upPac.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(upPac.fnacimiento,'%m-%d'), 0 , -1 ) AS edad
            "),
            DB::raw("
                cue.description AS especialidad_nombre
            "),
            DB::raw("
                CONCAT(
                    upMed.nombres,
                    ' ',
                    upMed.apellidos
                ) AS medico
            "),
            DB::raw("
                CONCAT(
                    upPac.nombres,
                    ' ',
                    upPac.apellidos
                ) AS paciente
            "),
            DB::raw("
                CONCAT(
                    upAuto.nombres,
                    ' ',
                    upAuto.apellidos
                ) as user_autorizacion
            "),
            DB::raw("
                STR_TO_DATE(
                    CONCAT(
                        user_cita.year,'/',
                        user_cita.month,'/',
                        user_cita.day,' ',
                        user_cita.hour
                    ),
                    '%Y/%m/%d %T'
                ) AS fecha_cita
            ")
        );
        $model =    $model->orderBy('fecha_cita',"ASC");
        $model =    $model->get();

        return $model;
    }



}
