<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/vistas/tp','VistasController@list_active_patients');
// Route::post('/storeDischaged','DischargedController@store');
// Route::post('/surveys_statistics_ajax', 'SurveyController@getStatisticsAjax');
// Route::post('/surveys_statistics_ajax2', 'SurveyController@getStatisticsAjax2');
// Route::post('/sendSpecificSurvey', 'SurveyController@sendSpecificSurvey');
// Route::post('/surveyInsitu','SurveyController@surveyInsitu');
// Route::post('/getSurveysList','SurveyController@getSurveysList');
// Route::post('/pacientesHospitalizados','SurveyController@pacientesHospitalizados');
// Route::get('/getPatient/{cedula}', 'UserController@getPatient');
// Route::post('/getStatisticsByAreaAjax', 'SurveyController@getStatisticsByAreaAjax');


// Rutas dashboard QX - INICIO
Route::post('/dashboard_qx/total_cirugias_hospitalizacion','AreaQuirurgicaController@totalCirugiasHospitalizacion');
Route::post('/dashboard_qx/total_cirugias_mapm','AreaQuirurgicaController@totalCirugiasMapm');
Route::post('/dashboard_qx/cirugias_ejecutadas_x_mes','AreaQuirurgicaController@cirugiasEjecutadasXMes');
Route::post('/dashboard_qx/cirugias_culminadas_x_medico','AreaQuirurgicaController@cirugiasCulminadasXMedico');
Route::post('/dashboard_qx/turnos_horarios','AreaQuirurgicaController@getTurnosHorarios');
Route::post('/dashboard_qx/proximas_solicitudes','AreaQuirurgicaController@getProximasSolicitudes');
Route::post('/dashboard_qx/equipos_especiales','AreaQuirurgicaController@getEquiposEspeciales');
Route::post('/dashboard_qx/tipo_cirugia','AreaQuirurgicaController@getCirugiasByType');
Route::post('/dashboard_qx/top_intervenciones','AreaQuirurgicaController@getTopIntervenciones');
Route::post('/dashboard_qx/top_especialidades','AreaQuirurgicaController@getTopEspecialidades');
// Rutas dashboard QX - FIN
