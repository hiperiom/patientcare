<?php

use App\Http\Controllers\UserCuestEpisodioController;
use App\Http\Controllers\UserCuestAntecedenteController;


use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

Route::get('/health', function () {
    // Leer el contenido del archivo package.json
    $packageJsonPath = base_path('package.json');
    $packageJsonContent = json_decode(file_get_contents($packageJsonPath), true);

    // Obtener el número de versión
    $version = $packageJsonContent['version'] ?? 'unknown';
    //dd($version);
    // Desloguear al usuario si está autenticado
    if (Auth::check()) {
        Auth::logout();
        // Forzar el refresco del navegador después de desloguear
        return redirect('/')->with('message', 'Logged out successfully. Refreshing page... Version: ' . $version);
    }

    // Retornar el número de versión
    return response()->json(['version' => $version]);
});
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




//Route::get('/', 'AuthController@index')->name("/");
Route::get('/', 'AuthController@app')->name("/");
Route::get('/forseReloadForEvoidCache', 'AuthController@forseReloadForEvoidCache');



Route::get('/readExcelTemp', 'Controller@readExcelTemp');

Route::get('/authcie11', 'AuthController@authcie11');
Route::get('sessionExist', 'AuthController@sessionExist')->name("sessionExist");
//Route::get('auth/login/{cat_user_type_id}', 'AuthController@index')->name("auth/login");
//Route::get('auth/{any}', 'AuthController@app');

Route::prefix('/auth')->group(function () {
    Route:: post('/validateUser',      "AuthController@validateUser" );
    Route:: get('/areaequiposalud',      "AuthController@AuthAreaEquiposalud" );
    Route:: get('/areaplanificacionguardia',      "AuthController@AuthAreaPlanificacionGuardias" );
    Route:: get('/areahomecare',      "AuthController@AuthAreaHomeCare" );
    Route:: get('/areaequipoEnfermeria',      "AuthController@AuthEquipoEnfermeria" );
    Route:: get('/arearesumenclinico',      "AuthController@AuthResumenClinico" );
    Route:: get('/areaequiposalud2',      "AuthController@AuthAreaEquiposalud2" );
    Route:: get('/authlistmedicos',      "AuthController@AuthListMedicos" );
    Route:: get('/areaadministrador',      "AuthController@AuthAreaAdministrador" );
    Route:: get('/areaquirurgica',      "AuthController@AuthAreaQuirurgica" );
    Route:: get('/areaquirurgicatablero',      "AuthController@AuthAreaQuirurgicaTablero" );
    Route:: get('/areaquirurgicaamb',      "AuthController@AuthAreaQuirurgicaAmb" );
    Route:: get('/areahospitalizacion',      "AuthController@AuthAreaHospitalizacion" );
    Route:: get('/areauti',      "AuthController@AuthAreaUti" );
    Route:: get('/telesaludempresarial',      "AuthController@AuthTelesaludEmpresarial" );
    Route:: get('/hoteleria',      "AuthController@AuthAreaHoteleria" );
    Route:: post('/getUserRoles',      "AuthController@getUserRoles" );

    Route::get('/{any}','AuthController@app');

    Route::prefix('/passwordreset')->group(function () {
        $model = "ResetPassword";
        Route::post('/store', $model.'Controller@resetPassword');
        Route::post('/storeconfirm', $model.'Controller@resetPasswordConfirm');
    });
});
Route::prefix('/areaHospitalizacion')->group(function () {
    $model = "AreaHospitalizacion";
    Route:: get('/{any}', $model."Controller@index" );
    Route:: get('/{any1}/{any2}', $model."Controller@index" );
});
Route::prefix('/seguimientomedico')->group(function () {
    $model = "SeguimientoPacientes";
    Route:: get('/{any}', $model."Controller@index" );
    //Route:: get('/{any1}/{any2}', $model."Controller@index" );
});
Route::prefix('/areaUti')->group(function () {
    $model = "AreaUti";
    Route:: get('/{any}', $model."Controller@index" );
    Route:: get('/{any1}/{any2}', $model."Controller@index" );
});


Route::get('/clasificador_cie11/{user_id}/{user_cuest_episodio_id}', 'Clasificadorcie11Controller@index');

Route::get('user_cuest_comorbilidad/create', 'UserCuestComorbilidadController@create');
Route::post('user_cuest_comorbilidad/store', 'UserCuestComorbilidadController@store');
Route::post('user_cuest_comorbilidad/store2', 'UserCuestComorbilidadController@store2');
Route::post('user_cuest_comorbilidad/update2', 'UserCuestComorbilidadController@update2');
Route::post('user_cuest_comorbilidad/show/{id}', 'UserCuestComorbilidadController@show');
Route::post('user_cuest_comorbilidad/destroy/{id}', 'UserCuestComorbilidadController@destroy');

Route::post('user_cuest_egreso/destroy/{id}', 'UserCuestEgresoController@destroy');
Route::post('user_cuest_egreso/store2', 'UserCuestEgresoController@store2');
Route::post('user_cuest_egreso/update/{id}', 'UserCuestEgresoController@update');

Route::post('user_cuest_prueba_covid/store', 'UserCuestPruebaCovidController@store')->name("user_cuest_prueba_covid/store");
Route::post('user_cuest_prueba_covid/sendEmailCuestionario', 'UserCuestPruebaCovidController@sendEmailCuestionario')->name("user_cuest_prueba_covid/sendEmailCuestionario");

Route::post('cat_encuesta_update/1', 'CatEncuestaController@update');
Route::post('cat/encuesta/{id}/sumarEncuesta', 'CatEncuestaController@sumarEncuesta');
Route::get('user_especialidad/index', 'UserEspecialidadController@index')->name("user_especialidad/index");
Route::post('user_especialidad/index', 'UserEspecialidadController@index')->name("user_especialidad/index");
Route::get('user_especialidad/show/{user_id}', 'UserEspecialidadController@show')->name("user_especialidad/show/{user_id}");
Route::post('/user_especialidad/store', 'UserEspecialidadController@store')->name("/user_especialidad/store");
Route::post('/user_especialidad/update', 'UserEspecialidadController@update')->name("/user_especialidad/update");
Route::post('/user_cuest_evolucion/store', 'UserCuestEvolucionController@store')->name("/user_cuest_evolucion/store");

Route::post('/user_cuest_orden_medica/store', 'UserCuestOrdenMedicaController@store');
Route::get('/user_cuest_orden_medica/destroy/{id}', 'UserCuestOrdenMedicaController@destroy');


Route::post('cat_user_antecedente/index', 'CatUserAntecedenteController@index')->name("cat_user_antecedente/index");

Route::post('user_cuest_antecedente/show', 'UserCuestAntecedenteController@show')->name("user_cuest_antecedente/show");
Route::post('user_cuest_antecedente/store', 'UserCuestAntecedenteController@store');
Route::post('user_cuest_antecedente/store2', 'UserCuestAntecedenteController@store2')->name("user_cuest_antecedente/store2");

Route::post('user_cuest_historia_medica/index', 'UserCuestHistoriaMedicaController@index')->name("user_cuest_historia_medica/index");
Route::post('user_cuest_historia_medica/show', 'UserCuestHistoriaMedicaController@show')->name("user_cuest_historia_medica/show");
Route::post('user_cuest_historia_medica/create', 'UserCuestHistoriaMedicaController@create')->name("user_cuest_historia_medica/create");
Route::post('user_cuest_historia_medica/store', 'UserCuestHistoriaMedicaController@store')->name("user_cuest_historia_medica/store");
Route::post('user_cuest_historia_medica/destroy', 'UserCuestHistoriaMedicaController@destroy')->name("user_cuest_historia_medica/destroy");


Route::post('user_cuest_informe/destroy', 'UserCuestInformeController@destroy')->name("user_cuest_informe/destroy");
Route::post('user_cuest_informe/index', 'UserCuestInformeController@index')->name("user_cuest_informe/index");
Route::post('user_cuest_informe/store', 'UserCuestInformeController@store')->name("user_cuest_informe/store");
Route::post('verificarCredenciales', 'AuthController@verificarCredenciales')->name("verificarCredenciales");
Route::get('finalizarSesion', 'AuthController@finalizarSesion')->name("finalizarSesion");


Route::post('user_type/store', 'UserTypeController@store')->name("user_type/store");
Route::post('user_type/update', 'UserTypeController@update');

Route::get('reset', 'UserController@reset')->name("reset");
Route::get('user/create/{cat_user_type_id}', 'UserController@create')->name("user/create");
Route::get('user/show/{user_id}', 'UserController@show')->name("user/show/{user_id");

Route::post('user/store', 'UserController@store')->name("user/store");
Route::post('user/update', 'UserController@update');

Route::get('user/store2', 'UserController@store2')->name("user/store2");
Route::post('user/show', 'UserController@show')->name("user/show");
Route::get('user/emailExist', 'UserController@emailExist')->name("user/emailExist");
Route::post('user/emailExist', 'UserController@emailExist')->name("user/emailExist");
Route::post('user/getByEmail', 'UserController@getByEmail');


Route::post('user_profile/cedulaExiste', 'UserProfileController@cedulaExiste')->name("user_profile/cedulaExiste");
Route::post('user_profile/getCedula', 'UserProfileController@getCedula')->name("user_profile/getCedula");
Route::post('user_profile/store', 'UserProfileController@store')->name("user_profile/store");
Route::post('user_profile/update', 'UserProfileController@update')->name("user_profile/update");
Route::get('userProfile/store', 'UserProfileController@store')->name("userProfile/store");
Route::get('userProfile/show', 'UserProfileController@show')->name("userProfile/show");
Route::post('user_profile/show', 'UserProfileController@show')->name("user_profile/show");

Route::post('userDirection/show', 'UserCuestDireccionController@show')->name("userDirection/show");
Route::get('userDirection/show', 'UserCuestDireccionController@show')->name("userDirection/show");
Route::get('userDirection/store', 'UserCuestDireccionController@store')->name("userDirection/store");

Route::get('userFamily/show', 'UserCuestFamilyController@show')->name("userFamily/show");
Route::get('userFamily/store', 'UserCuestFamilyController@store')->name("userFamily/store");

Route::get('userInstitucion/show', 'UserCuestVinculoInstitucionController@show')->name("userInstitucion/show");
Route::get('userInstitucion/store', 'UserCuestVinculoInstitucionController@store')->name("userInstitucion/store");


Route::get('paciente', 'UserPacienteController@index')->name("paciente");
Route::get('paciente/pendiente', 'UserPacienteController@pendiente')->name("paciente/pendiente");
Route::get('paciente/create', 'UserPacienteController@create')->name("paciente/create");
Route::get('paciente/create2', 'UserPacienteController@create2');
Route::get('paciente/store', 'UserPacienteController@store')->name("paciente/store");
Route::get('paciente/show', 'UserPacienteController@show')->name("paciente/show");
Route::get('paciente/solicitar_servicio', 'UserPacienteController@solicitarservicio')->name("paciente/solicitar_servicio");
Route::post('user_cuest_historia_medica/getHistorial', 'UserCuestHistoriaMedicaController@getHistorial')->name("user_cuest_historia_medica/getHistorial");


Route::post('user_post_covid/store', 'UserPostCovidController@store');
Route::post('user_post_covid/getAll', 'UserPostCovidController@getAll');

Route::get('catUserFamily/getAll', 'CatUserFamilyController@getAll')->name("catUserFamily/getAll");
Route::get('cat_user_estado/index', 'CatEstadoController@index')->name("cat_user_estado/index");
Route::get('cat_user_municipio/show/{id}', 'CatMunicipioController@show')->name("cat_user_municipio/show/{id}");
Route::get('cat_user_municipio/getAll', 'CatMunicipioController@getAll');
Route::post('catEspecialidad/index', 'CatEspecialidadController@getAll');
Route::get('cat_user_especialidad/index', 'CatEspecialidadController@index');
Route::get('cat_user_especialidad/index2', 'CatEspecialidadController@index2');

Route::get('catEspecialidad', 'CatEspecialidadController@getAll')->name("catEspecialidad");
Route::get('catUserEquipoSalud', 'CatUserEquipoSaludController@getAll')->name("catUserEquipoSalud");

Route::post('user_cuest_oxigenoterapia/index', 'UserCuestOxigenoterapiaController@index')->name("user_cuest_oxigenoterapia/index");
Route::post('user_cuest_oxigenoterapia/show', 'UserCuestOxigenoterapiaController@show')->name("user_cuest_oxigenoterapia/show");
Route::post('user_cuest_oxigenoterapia/store', 'UserCuestOxigenoterapiaController@store')->name("user_cuest_oxigenoterapia/store");
Route::post('user_cuest_oxigenoterapia/destroy', 'UserCuestOxigenoterapiaController@destroy')->name("user_cuest_oxigenoterapia/destroy");

Route::post('user_cuest_temperatura/index', 'UserCuestTemperaturaController@index')->name("user_cuest_temperatura/index");
Route::post('user_cuest_temperatura/show', 'UserCuestTemperaturaController@show')->name("user_cuest_temperatura/show");
Route::post('user_cuest_temperatura/store', 'UserCuestTemperaturaController@store')->name("user_cuest_temperatura/store");
Route::post('user_cuest_temperatura/destroy', 'UserCuestTemperaturaController@destroy')->name("user_cuest_temperatura/destroy");

Route::post('user_cuest_oximetria/index', 'UserCuestOximetriaController@index')->name("user_cuest_oximetria/index");
Route::post('user_cuest_oximetria/show', 'UserCuestOximetriaController@show')->name("user_cuest_oximetria/show");
Route::post('user_cuest_oximetria/store', 'UserCuestOximetriaController@store')->name("user_cuest_oximetria/store");
Route::post('user_cuest_oximetria/destroy', 'UserCuestOximetriaController@destroy')->name("user_cuest_oximetria/destroy");


Route::post('user_cuest_sintoma/index', 'UserCuestSintomaController@index')->name("user_cuest_sintoma/index");
Route::post('user_cuest_sintoma/destroy', 'UserCuestSintomaController@destroy')->name("user_cuest_sintoma/destroy");
Route::post('user_cuest_sintoma/destroy2', 'UserCuestSintomaController@destroy2');
Route::post('user_cuest_sintoma/show', 'UserCuestSintomaController@show')->name("user_cuest_sintoma/show");
Route::post('user_cuest_sintoma/store', 'UserCuestSintomaController@store')->name("user_cuest_sintoma/store");

Route::get('monitoreo/tac/store', 'UserCuestTacController@store')->name("monitoreo/tac/store");


Route::get('cat_user_cuestionario/show/{parent_cat_user_cuestionario_id}', 'CatUserCuestionarioController@show')->name("cat_user_cuestionario/show/{parent_cat_user_cuestionario_id}");

Route::post('cat_user_cuestionario/sintomas', 'CatUserCuestionarioController@getSintomas')->name("cat_user_cuestionario/sintomas");
Route::get('pruebacovid/store', 'UserCuestPruebaCovidController@store')->name("pruebacovid/store");
Route::get('pruebacovid/getAllPcr', 'UserCuestPruebaCovidController@getAllPcr')->name("pruebacovid/getAllPcr");
Route::get('pruebacovid/getAllPdr', 'UserCuestPruebaCovidController@getAllPdr')->name("pruebacovid/getAllPdr");
Route::post('/user_equipo_salud/store', 'UserEquipoSaludController@store')->name("/user_equipo_salud/store");
Route::post('/user_equipo_salud/update', 'UserEquipoSaludController@update')->name("/user_equipo_salud/update");
Route::post('/user_equipo_salud/medicosByArea', 'UserEquipoSaludController@medicosByArea')->name("/user_equipo_salud/medicosByArea");
Route::post('/user_equipo_salud/medicosByEspecialidad', 'UserEquipoSaludController@medicosByEspecialidad');
Route::get('user_equipo_salud/show/{user_id}', 'UserEquipoSaludController@show')->name("/user_equipo_salud/show/{user_id}");

Route::post('user_cuest_pcr/index', 'UserCuestPcrController@index')->name("user_cuest_pcr/index");
Route::post('user_cuest_pcr/store', 'UserCuestPcrController@store')->name("user_cuest_pcr/store");
Route::post('user_cuest_pcr/destroy', 'UserCuestPcrController@destroy')->name("user_cuest_pcr/destroy");

Route::post('user_cuest_pdr/index', 'UserCuestPdrController@index')->name("user_cuest_pdr/index");
Route::post('user_cuest_pdr/store', 'UserCuestPdrController@store')->name("user_cuest_pdr/store");
Route::post('user_cuest_pdr/destroy', 'UserCuestPdrController@destroy')->name("user_cuest_pdr/destroy");

Route::post('user_cuest_antg/index', 'UserCuestAntgController@index')->name("user_cuest_antg/index");
Route::post('user_cuest_antg/store', 'UserCuestAntgController@store')->name("user_cuest_antg/store");
Route::post('user_cuest_antg/destroy', 'UserCuestAntgController@destroy')->name("user_cuest_antg/destroy");

Route::post('user_cuest_tac/index', 'UserCuestTacController@index')->name("user_cuest_tac/index");
Route::post('user_cuest_tac/store', 'UserCuestTacController@store')->name("user_cuest_tac/store");
Route::post('user_cuest_tac/destroy', 'UserCuestTacController@destroy')->name("user_cuest_tac/destroy");



Route::get('cat_user_cuestionario/tac', 'CatUserCuestionarioController@getTac')->name("cat_user_cuestionario/tac");
//Route::get('user_cuest_tac/show', 'UserCuestTacController@show')->name("user_cuest_tac/show");
//Route::get('user_cuest_tac/store', 'UserCuestTacController@store')->name("user_cuest_tac/store");
Route::post('user_cuest_chat/store', 'UserCuestChatController@store')->name("user_cuest_chat/store");
Route::post('user_cuest_chat/index', 'UserCuestChatController@index')->name("user_cuest_chat/index");

Route::get('user_cuest_ubicacion/show', 'UserCuestUbicacionController@show')->name("user_cuest_ubicacion/show");
Route::post('user_cuest_ubicacion/show', 'UserCuestUbicacionController@show')->name("user_cuest_ubicacion/show");
Route::post('user_cuest_ubicacion/store2', 'UserCuestUbicacionController@store2')->name("user_cuest_ubicacion/store2");
Route::post('/user_cuest_ubicacion/storeReingreso', 'UserCuestUbicacionController@storeReingreso');
Route::get('user_cuest_ubicacion/store', 'UserCuestUbicacionController@store')->name("user_cuest_ubicacion/store");
Route::post('user_cuest_ubicacion/store', 'UserCuestUbicacionController@store2');
Route::get('user_cuest_ubicacion/store2', 'UserCuestUbicacionController@store2')->name("user_cuest_ubicacion/store2");
Route::get('user_cuest_ubicacion/getAllPad', 'UserCuestUbicacionController@getAllPad')->name("user_cuest_ubicacion/getAllPad");
Route::post('user_cuest_ubicacion/historialUbiEpisodio/{id}', 'UserCuestUbicacionController@historialUbiEpisodio');
Route::post('user_cuest_ubicacion/historialAltas/{id}', 'UserCuestUbicacionController@historialAltas');

Route::get('cat_user_ubicacion/showSubUbicacion', 'CatUserUbicacionController@showSubUbicacion')->name("cat_user_ubicacion/showSubUbicacion");
Route::get('cat_user_ubicacion/index', 'CatUserUbicacionController@index')->name("cat_user_ubicacion/index");
Route::get('/cat_user_ubicacion/getAll', 'CatUserUbicacionController@getAll');
Route::get('cat_user_ubicacion/show/{id}', 'CatUserUbicacionController@show')->name("cat_user_ubicacion/show/{id}");
//Route::post('cat_user_ubicacion/show', 'CatUserUbicacionController@show')->name("cat_user_ubicacion/show");
Route::post('cat_user_ubicacion/show/menu', 'CatUserUbicacionController@showMenu')->name("cat_user_ubicacion/show/menu");
Route::get('user_cuest_pad/store', 'UserCuestPadController@store')->name("user_cuest_pad/store");
Route::post('user_cuest_pad/updateDateIngreso', 'UserCuestPadController@updateDateIngreso')->name("user_cuest_pad/updateDateIngreso");
Route::post('user_cuest_pad/store', 'UserCuestPadController@store')->name("user_cuest_pad/store");
Route::get('user_cuest_pad/show/{user_id}', 'UserCuestPadController@show')->name("user_cuest_pad/show/{user_id}");
Route::post('user_cuest_pad/update', 'UserCuestPadController@update')->name("user_cuest_pad/update");
Route::post('user_cuest_pad/alta', 'UserCuestPadController@alta')->name("user_cuest_pad/alta");
Route::get('user_cuest_pad/destroy/{id}', 'UserCuestPadController@destroy')->name("user_cuest_pad/destroy/{id}");
Route::get('user_cuest_pad/show2/{pad_id}', 'UserCuestPadController@show2')->name("user_cuest_pad/show/{pad_id}");

Route::post('user_cuest_direccion/store', 'UserCuestDireccionController@store')->name("user_cuest_direccion/store");
Route::post('user_cuest_direccion/update', 'UserCuestDireccionController@update')->name("user_cuest_direccion/update");

Route::get('user_cuest_observacion/destroy/{id}', 'UserCuestObservacionController@destroy')->name("user_cuest_observacion/destroy/{id}");
Route::post('user_cuest_observacion/store', 'UserCuestObservacionController@store')->name("user_cuest_observacion/store");


Route::get('medico/rowPacienteCovid/{filtro}', 'UserMedicoController@rowPacienteCovid')->name("medico/rowPacienteCovid/{filtro}");
Route::get('medico/addSeguimiento', 'UserMedicoController@addSeguimiento')->name("medico/addSeguimiento");
Route::get('medico', 'UserMedicoController@index')->name("medico");
Route::get('medico/tp', 'UserMedicoController@indexnuevo');
Route::get('medico/create/externo', 'UserMedicoController@create_externo');
Route::get('medico/create', 'UserMedicoController@create')->name("medico/create");
Route::get('medico/create_monitoreo', 'UserMedicoController@create_monitoreo')->name("medico/create_monitoreo");
Route::get('medico/create_paciente', 'UserMedicoController@create_paciente')->name("medico/create_paciente");
Route::get('medico/edit/{user_id}', 'UserMedicoController@edit')->name("medico/edit/{user_id}");
Route::get('medico/getMedicos', 'UserMedicoController@getMedicos');
Route::post('medico/updateRol', 'UserMedicoController@updateRol');
Route::get('medico/guardias', 'UserMedicoController@guardias');
Route::get('medico/copia', 'UserMedicoController@copia');


Route::post('user_cuest_medico_paciente/destroy', 'UserCuestMedicoPacienteController@destroy');
Route::post('user_cuest_medico_paciente/eliminarById', 'UserCuestMedicoPacienteController@eliminarById');
Route::post('user_cuest_medico_paciente/store', 'UserCuestMedicoPacienteController@store');
Route::post('user_cuest_medico_paciente/show/{user_id}/{tipo_medico}', 'UserCuestMedicoPacienteController@show');
Route::post('user_cuest_medico_paciente/fixed_medico_paciente', 'UserCuestMedicoPacienteController@fixed_medico_paciente');


Route::get('medico/index_medicos', 'UserMedicoController@index_medicos')->name("medico/index_medicos");
Route::get('medico/alta', 'UserMedicoController@alta')->name("medico/alta");
Route::post('medico/store_monitoreo/{id}', 'UserMedicoController@store_monitoreo')->name("medico/store_monitoreo/{id}");
//Route::post('medico/store', 'UserMedicoController@store')->name("medico/store");
Route::post('medico/store_paciente', 'UserMedicoController@store_paciente')->name("medico/store_paciente");



Route::post('user_cuest_resbalar/store', 'UserCuestResbalarController@store');
Route::post('user_cuest_riesgo_quirurgico/store', 'UserCuestRiesgoQuirurgicoController@store');
Route::post('user_cuest_alert/store', 'UserCuestAlertController@store');
Route::get('user_cuest_cal/store', 'UserCuestCalController@store')->name("user_cuest_cal/store");


Route::post('user_cuest_fc/show', 'UserCuestFcController@show')->name("user_cuest_fc/show");
Route::post('user_cuest_fc/store', 'UserCuestFcController@store')->name("user_cuest_fc/store");
Route::post('user_cuest_fc/destroy', 'UserCuestFcController@destroy')->name("user_cuest_fc/destroy");

Route::post('user_cuest_fr/show', 'UserCuestFrController@show')->name("user_cuest_fr/show");
Route::post('user_cuest_fr/store', 'UserCuestFrController@store')->name("user_cuest_fr/store");
Route::post('user_cuest_fr/destroy', 'UserCuestFrController@destroy')->name("user_cuest_fr/destroy");

Route::post('user_cuest_ta/show', 'UserCuestTaController@show')->name("user_cuest_ta/show");
Route::post('user_cuest_ta/store', 'UserCuestTaController@store')->name("user_cuest_ta/store");
Route::post('user_cuest_ta/destroy', 'UserCuestTaController@destroy')->name("user_cuest_ta/destroy");

Route::post('user_cuest_gl/show', 'UserCuestGlicController@show')->name("user_cuest_gl/show");
Route::post('user_cuest_gl/store', 'UserCuestGlicController@store')->name("user_cuest_gl/store");
Route::post('user_cuest_gl/destroy', 'UserCuestGlicController@destroy')->name("user_cuest_gl/destroy");

Route::post('cat_user_sintoma/index', 'UserCuestGlicController@index')->name("cat_user_sintoma/index");
Route::post('cat_user_sintoma/store', 'UserCuestGlicController@store')->name("cat_user_sintoma/store");
Route::post('cat_user_sintoma/destroy', 'UserCuestGlicController@destroy')->name("cat_user_sintoma/destroy");



Route::post('user_cuest_ficha_medica/store', 'UserCuestFichaMedicaController@store')->name("user_cuest_ficha_medica/store");
Route::post('user_cuest_ficha_medica/getLastFichaMedica', 'UserCuestFichaMedicaController@getLastFichaMedica')->name("user_cuest_ficha_medica/getLastFichaMedica");


Route::post('user_cuest_plan/store', 'UserCuestPlanController@store')->name("user_cuest_plan/store");
Route::get('user_cuest_plan/destroy/{id}', 'UserCuestPlanController@destroy')->name("user_cuest_plan/destroy/{id}");

Route::get('user_cuest_impresion_diagnostica/destroy/{id}', 'UserCuestImpresionDiagnosticaController@destroy')->name("user_cuest_impresion_diagnostica/destroy/{id}");
Route::post('user_cuest_impresion_diagnostica/update', 'UserCuestImpresionDiagnosticaController@update')->name("user_cuest_impresion_diagnostica/store");
Route::post('user_cuest_plan/update2', 'UserCuestPlanController@update2');
Route::post('user_cuest_impresion_diagnostica/update2', 'UserCuestImpresionDiagnosticaController@update2');
Route::post('user_cuest_impresion_diagnostica/store', 'UserCuestImpresionDiagnosticaController@store')->name("user_cuest_impresion_diagnostica/store");
Route::post('user_cuest_impresion_diagnostica/store2', 'UserCuestImpresionDiagnosticaController@store2');
Route::post('user_cuest_impresion_diagnostica/show/{user_id}', 'UserCuestImpresionDiagnosticaController@show');

Route::post('user_cuest_laboratorio/store', 'UserCuestLaboratorioController@store')->name("user_cuest_laboratorio/store");
Route::get('user_cuest_laboratorio/destroy/{id}', 'UserCuestLaboratorioController@destroy')->name("user_cuest_laboratorio/destroy/{id}");

Route::post('user_cuest_fotografia/store', 'UserCuestFotografiaController@store')->name("user_cuest_fotografia/store");
Route::get('user_cuest_fotografia/destroy/{id}', 'UserCuestFotografiaController@destroy')->name("user_cuest_fotografia/destroy/{id}");

Route::post('user_cuest_imagen/store', 'UserCuestImagenController@store')->name("user_cuest_imagen/store");
Route::get('user_cuest_imagen/destroy/{id}', 'UserCuestImagenController@destroy')->name("user_cuest_imagen/destroy/{id}");

Route::post('user_cuest_otro_archivo/store', 'UserCuestOtroArchivoController@store')->name("user_cuest_otro_archivo/store");
Route::get('user_cuest_otro_archivo/destroy/{id}', 'UserCuestOtroArchivoController@destroy')->name("user_cuest_otro_archivo/destroy/{id}");

Route::post('user_cuest_recipe/store', 'UserCuestRecipeController@store')->name("user_cuest_recipe/store");
Route::get('user_cuest_recipe/destroy/{id}', 'UserCuestRecipeController@destroy')->name("user_cuest_recipe/destroy/{id}");

Route::post('user_cuest_episodio/restablecer_episodio', 'UserCuestEpisodioController@restablecer_episodio');
Route::post('user_cuest_episodio/episodioPendiente', 'UserCuestEpisodioController@episodioPendiente');
Route::post('user_cuest_episodio/store', 'UserCuestEpisodioController@store');
Route::post('user_cuest_episodio/update', 'UserCuestEpisodioController@update');
Route::post('user_cuest_episodio/update2', 'UserCuestEpisodioController@update2');
Route::post('user_cuest_episodio/get_historiaIngreso', 'UserCuestEpisodioController@get_historiaIngreso');
Route::post('user_cuest_episodio/prealta', 'UserCuestEpisodioController@prealta');
Route::post('user_cuest_estudio/store', 'UserCuestEstudioController@store')->name("user_cuest_estudio/store");

Route::get('user_cuest_episodio/blue_code/{user_id}/{result}', 'UserCuestEpisodioController@blue_code');

Route::get('user_cuest_estudio/destroy/{id}', 'UserCuestEstudioController@destroy')->name("user_cuest_estudio/destroy/{id}");

Route::post('user_family/store', 'UserFamilyController@store')->name("user_family/store");
Route::get('user_family/destroy/{id}', 'UserFamilyController@destroy')->name("user_family/destroy/{id}");

Route::get('user_cuest_evolucion/destroy/{id}', 'UserCuestEvolucionController@destroy')->name("user_cuest_evolucion/destroy/{id}");
//Route::post('user_cuest_laboratorio/subirImagen', 'UserCuestLaboratorioController@subirImagen')->name("user_cuest_laboratorio/subirImagen");
Route::post('user_cuest_fotografia/subirFotografia', 'UserCuestFotografiaController@subirImagen')->name("user_cuest_fotografia/subirFotografia");
Route::post('user_cuest_estudio/subirEstudio', 'UserCuestEstudioController@subirImagen')->name("user_cuest_estudio/subirEstudio");
Route::post('user_cuest_otroArchivo/subirArchivo', 'UserCuestOtroArchivoController@subirImagen')->name("user_cuest_otroArchivo/subirArchivo");


Route::get('user_paciente/getdatapaciente/{user_id_paciente}', 'UserPacienteController@getDataPaciente');
Route::post('user_paciente/getInfoPaciente', 'UserPacienteController@getInfoPaciente')->name("user_paciente/getInfoPaciente");
Route::post('user_paciente/update', 'UserPacienteController@update');
Route::post('user_cuest_valoracion/store', 'UserCuestValoracionController@store')->name("user_cuest_valoracion/store");
Route::get('user_cuest_valoracion/show/{user_id}/{type}', 'UserCuestValoracionController@show')->name("user_cuest_valoracion/show/{user_id}/{type}");

Route::post('user_medico_posicion/store', 'UserMedicoPosicionController@store');
Route::post('user_medico_posicion/update', 'UserMedicoPosicionController@update');
Route::post('user_medico_posicion/show/{id}', 'UserMedicoPosicionController@show');

Route::post('cat_user_medico_posicion/getAll', 'CatUserMedicoPosicionController@getAll');

Route::post('system_incidencia/index', 'SystemIncidenciaController@index');
Route::post('user_encuesta/store', 'UserEncuestaController@store');
Route::post('user_encuesta/getAll', 'UserEncuestaController@getAll');
Route::get('user_encuesta/getAll/{rango}', 'UserEncuestaController@getAll');


Route::post('user_cuest_pendiente/update2', 'UserCuestPendienteController@update2');
Route::post('user_cuest_pendiente/update', 'UserCuestPendienteController@update')->name("user_cuest_pendiente/update");
Route::post('user_cuest_pendiente/destroy', 'UserCuestPendienteController@destroy')->name("user_cuest_pendiente/destroy");
Route::post('user_cuest_pendiente/show', 'UserCuestPendienteController@show')->name("user_cuest_pendiente/show");
Route::post('user_cuest_pendiente/store', 'UserCuestPendienteController@store')->name("user_cuest_pendiente/store");
Route::post('user_cuest_pendiente/store2', 'UserCuestPendienteController@store2');


Route::post('user_vip/store', 'UserVipController@store');

Route::post('user_motivo_consulta/store2', 'MotivoConsultaController@store2');
Route::post('user_enfermedad_actual/store2', 'EnfermedadActualController@store2');
Route::post('user_examen_fisico/store2', 'ExamenFisicoController@store2');
Route::post('user_examen_fisico/store2', 'ExamenFisicoController@store2');
Route::post('user_impresion_diagnostica/store3', 'UserCuestImpresionDiagnosticaController@store3');


Route::get('pdf/informeEgreso', 'Controller@informeEgreso')->name("pdf/informeEgreso");
Route::get('pdf/informeSeguro/{user_id}', 'Controller@informeSeguro');
Route::get('pdf/enviarInformeSeguro/{user_id}', 'Controller@enviarInformeSeguro');
Route::get('pdf/evolucion/{user_id}/{name}/{impresion}', 'Controller@informeEvolucion');

Route::get('informe/pad', 'UserInformeController@pad');

Route::get('mensaje', function () {
    return view('component.menu_mensaje');
});

Route::get('notificacion', function () {
    return view('component.menu_notificacion');
});


/*eliminar estas rutas al actualizar las vistas a nueva version*/
Route::get('passwordReset', function () {
    return view('auth.password_reset');
});
Route::post('passwordResetStore', 'ResetPasswordController@resetPassword');
Route::post('passwordResetStoreConfirm', 'ResetPasswordController@resetPasswordConfirm');
/*eliminar estas rutas al actualizar las vistas a nueva version*/

//vistas
Route::get('/reportes/emergencia/resumen', function () {
    return view('reportes.emergencia');
});
Route::get('/reportes/hospitalizacion/resumen', function () {
    return view('reportes.hospitalizacion');
});
Route::get('/reportes/ee/resumen', function () {
    return view('reportes.eventos_especiales');
});
Route::get('/reportes/ee2/resumen', function () {
    return view('reportes.eventos_especiales2');
});
Route::get('/reportes/ee3/resumen', function () {
    return view('reportes.eventos_especiales3');
});
Route::get('/reportes/egresoscmdlt', function () {
    return view('reportes.app_egresos_cmdlt');
});
Route::get('/reportes/ingresoscmdlt', function () {
    return view('reportes.app_ingresos_cmdlt');
});
Route::get('/quirurgico/solicitud/presupuesto', function () {
    return view('plan_quirurgico.solicitud_presupuesto');
});
Route::get('/enfermeria/kardex', function () {
    return view('enfermeria.kardex');
});


Route::get('/altas', 'VistasController@list_altas_patients');
Route::get('/vistas/v_emergencia_reporte_diario', 'VistasController@v_emergencia_reporte_diario');
Route::get('/vistas/v_hospitalizacion_reporte_diario', 'VistasController@v_hospitalizacion_reporte_diario');
Route::get('/vistas/v_ee_reporte_diario', 'VistasController@v_ee_reporte_diario');
Route::get('/vistas/v_ee2_reporte_diario', 'VistasController@v_ee_reporte_diario2');
Route::get('/vistas/v_ee3_reporte_diario', 'VistasController@v_ee3_reporte_diario');
Route::get('/vistas/v_pad_reporte_diario', 'VistasController@v_pad_reporte_diario');
Route::get('vistas/v_prioridad_spo2', 'VistasController@v_prioridad_spo2')->name("medico/v_prioridad_spo2");
Route::get('vistas/v_prioridad_2', 'VistasController@v_prioridad_2')->name("medico/v_prioridad_2");
Route::get('vistas/v_prioridad_1', 'VistasController@v_prioridad_1')->name("medico/v_prioridad_1");
//Route::get('vistas/v_totales', 'VistasController@v_totales')->name("medico/v_totales");
Route::get('vistas/v_totales/{pad}', 'VistasController@v_totales');
Route::get('vistas/v_medicos', 'VistasController@v_medicos')->name("medico/v_medicos");
Route::get('vistas/v_hospitalizados', 'VistasController@v_hospitalizados')->name("medico/v_hospitalizados");
Route::get('vistas/lts_oxit', 'VistasController@v_lts_oxit')->name("medico/luisparodi");
Route::get('medico/luisparodi', 'UserMedicoController@luisparodi')->name("medico/luisparodi");

Route::get('/vistas/{area}', 'VistasController@list_active_patients');
//Route::get('vistas/{area}', 'VistasController@paciente_covid')->name("vistas/{area}");
Route::get('viewbyespecialidad/{cat_user_especialidad_id}', 'VistasController@paciente_especialidad');
Route::get('viewbymedico/{medico_id}', 'VistasController@medico_paciente');

Route::post('/solicitud_interconsulta/store', 'InterconsultationRequestController@store');
Route::post('/solicitud_interconsulta/update/{id}', 'InterconsultationRequestController@update');


Route::get('temp/{vista}', function ($vista) {
    return view('templates.'.$vista);
});
Route::get('medico/resumen_pacientes', function () {
    if(is_null(Auth()->user())){
        return redirect()->route('/');
    }
    return view('medico.index_resumen_paciente');
});
Route::get('paciente/post_covid_create', function () {

    return view('paciente.create_post_covid');
});
Route::get('paciente/cita', function () {

    return view('paciente.solicitud_cita/create');
});

Route::get('medico/cita/nuevasCitas', 'UserMedicoController@nuevasCitas');
Route::get('medico/cita/tablero', 'UserMedicoController@tablero_cita');
/*inicio encuestas */
Route::get('encuesta/hospitalizacion/nueva', function () {
    return view('paciente.encuesta1.create');
});
Route::get('encuesta/hospitalizacion/tablero', function () {
    return view('paciente.encuesta1.index');
});
Route::get('encuesta/consultaexterna/nueva', function () {
    return view('paciente.encuesta2.create');
});
Route::get('encuesta/consultaexterna/tablero', function () {
    return view('paciente.encuesta2.index');
});
Route::get('encuesta/emergencia/nueva', function () {
    return view('paciente.encuesta3.create');
});
Route::get('encuesta/emergencia/tablero', function () {
    return view('paciente.encuesta3.index');
});
/*fin encuestas */
Route::get('paciente/post_covid_index', function () {
    if(is_null(Auth()->user())){
        return redirect()->route('/');
    }
    return view('paciente.index_post_covid');
});
Route::get('/reportes/pad/resumen', function () {
    return view('reportes.index');
});

Route::prefix('/episodio')->group(function () {
    Route::get('/historial/{user_id}', [UserCuestEpisodioController::class, 'historial'])->name('episodio.historial');
    Route:: get('/pacientes_activos/{area}', [UserCuestEpisodioController::class, 'pacientes_activos']);

    Route::prefix('/antecedente')->group(function () {
        Route:: get('/index/{user_id_paciente}', [UserCuestAntecedenteController::class, 'index']);
        Route:: get('/index/{episodio_id}', [UserCuestAntecedenteController::class, 'index_episodio']);
        Route:: get('/show/{user_id_paciente}', [UserCuestAntecedenteController::class, 'show']);
        Route:: get('/store/{id}', [UserCuestAntecedenteController::class, 'store']);
        Route:: get('/destroy/{id}', [UserCuestAntecedenteController::class, 'destroy']);
    });
});

Route::get('centro_salud', 'CentroDeSaludController@index')->name('centro_salud.index');
Route::get('centro_salud/crear', 'CentroDeSaludController@create')->name('centro_salud.create');
Route::post('/centro_salud', 'CentroDeSaludController@store')->name('centro_salud.store');
Route::get('centro_salud/{id}', 'CentroDeSaludController@show')->name('centro_salud.show');
Route::get('centro_salud/{id}/edit', 'CentroDeSaludController@edit')->name('centro_salud.edit');
Route::put('centro_salud/{id}', 'CentroDeSaludController@update')->name('centro_salud.update');
Route::delete('centro_salud/{id}', 'CentroDeSaludController@destroy')->name('centro_salud.destroy');


Route::get('medico/agenda/create', 'AgendaController@create');
Route::get('medico/agenda/getAll', 'AgendaController@getAll');
Route::post('medico/agenda/store', 'AgendaController@store');
Route::post('medico/cita/status', 'CitaController@status');
Route::post('medico/cita/reprogramar', 'CitaController@reprogramar');
Route::post('paciente/cita/store', 'CitaController@store');
// Route::resource('agenda', AgendaController::class)->names('agenda');
// Route::resource('cita', CitaController::class)->names('cita');

//user/encuesta/send/hospitalizacion
//user/reporte/evolucion/1/null/color
//user/reporte/evolucion/1/null/color
/* Route::prefix('/user')->group(function () {

}); */
Route::prefix('/telesalud/empresarial')->group(function () {
    $model = "TelesaludEmpresarialController";
    Route:: get('/index', $model."@index" );
    Route:: get('/getAll/{area}', $model."@getAll" );


});
Route:: get('/send-message', "TestController@sendMessage" );

Route::get('vistas/paciente/quirurgico', function () {
    return view('vistas.paciente_quirurgico');
});
Route::get('vistas/paciente/quirurgico2', function () {
    return view('vistas.paciente_quirurgico2');
});
Route::get('vistas/plan/quirurgico', function () {
    return view('vistas.plan_quirurgico');
});
Route::get('ordenmedica', function () {
    return view('medico.ordenmedica');
});
/* Route:: get('/areaquirurgica/cupo/create',"SolicitudQuirofanoController@create" ); */
/* Route:: get('/areaquirurgica/cupo/index',"SolicitudQuirofanoController@create" ); */
/* Route:: get('/areaquirurgica/cupo/getAll',"SolicitudQuirofanoController@getAll" ); */

Route:: get('/getProcedimientos', "AreaQuirurgicaController@getProcedimientos" );
Route:: get('/getProcedimientosMAPM', "AreaQuirurgicaController@getProcedimientosMAPM" );
Route::get('tableroAqx', function () {
    if(is_null(Auth()->user())){
        return redirect()->route('/');
    }
    return view("area_quirurgica.indexTablero");
});
Route::get('tableroplanificacionguardias', function () {
    if(is_null(Auth()->user())){
        return redirect()->route('/');
    }
    return view("planificacion_guardia.app");
});
Route::prefix('/areaQuirofano')->group(function () {
    $model = "AreaQuirurgica";
    Route:: get('/{any}', $model."Controller@index" );
    Route:: get('/enfermeria/{any}', $model."Controller@index2" );
    Route:: get('/tablero', $model."Controller@tablero" );
    //Route:: get('/amb/{any}', $model."Controller@index" );
    Route:: get('/externo/{any}', $model."Controller@indexExterno" );
    Route:: post('/store', $model."Controller@store" );
    Route:: post('/update', $model."Controller@update" );
    Route:: post('/destroy', $model."Controller@destroy" );
    Route:: post('/updateForm', $model."Controller@updateForm" );

    Route:: get('/visibilidadReservacion/{reservacion_id}/{status_id}',"SolicitudQuirofanoController@visibilidadReservacion" );

    Route::prefix('/cupo')->group(function () {
        $model = "SolicitudQuirofano";
        Route:: get('/create', $model."Controller@create" );
        Route:: post('/store', $model."Controller@store" );
        Route:: post('/storecupo', $model."Controller@storecupo" );
        Route:: get('/familiar', $model."Controller@index_familiar" );
        Route:: get('/familiar2', $model."Controller@index_familiar2" );
        Route:: get('/index', $model."Controller@index" );

        Route:: get('/edit/{solicitud_id}', $model."Controller@edit" );
        Route:: get('/getAllInterno', "SolicitudQuirofanoController@getAllInterno" );
        Route:: get('/getAllExterno/{fecha_reporte}', $model."Controller@getAllExterno" );
        Route:: get('/getAllFinalizadas', $model."Controller@getAllFinalizadas" );
    });
    Route::prefix('/personal_asistencial')->group(function () {
        $model = "PersonalAsistencial";
        Route:: get('/gelAll', $model."Controller@gelAll" );
        Route:: get('/gelAllOtroPersonal', $model."Controller@gelAllOtroPersonal" );
        Route:: post('/create', $model."Controller@create" );
        Route:: post('/destroy', $model."Controller@destroy" );

    });
    Route::prefix('/cat_quirofano')->group(function () {
        $model = "CatQuirofano";
        Route:: get('/getAll', $model."Controller@getAll" );
        Route:: post('/update', $model."Controller@update" );
    });

    //Route:: get('/index', $model."Controller@index_quirurgico" );
});
Route::prefix('/areaQuirofanoAmb')->group(function () {
    $model = "AreaQuirurgica";
    Route:: get('/{any}', $model."Controller@indexAmb" );
    Route:: get('/enfermeria/{any}', $model."Controller@index2" );
    //Route:: get('/amb/{any}', $model."Controller@index" );
    Route:: get('/externo/{any}', $model."Controller@indexExternoMAPM" );
    Route:: post('/store', $model."Controller@store" );
    Route:: post('/update', $model."Controller@update" );
    Route:: post('/destroy', $model."Controller@destroy" );
    Route:: post('/updateForm', $model."Controller@updateForm" );

    Route:: get('/visibilidadReservacion/{reservacion_id}/{status_id}',"SolicitudQuirofanoController@visibilidadReservacion" );

    Route::prefix('/cupo')->group(function () {
        $model = "SolicitudQuirofano";
        Route:: get('/create', $model."Controller@create" );
        Route:: post('/store', $model."Controller@store" );
        Route:: post('/storecupo', $model."Controller@storecupo" );
        Route:: get('/familiar', $model."Controller@index_familiar" );
        Route:: get('/familiar2', $model."Controller@index_familiar2" );
        Route:: get('/index', $model."Controller@index" );

        Route:: get('/edit/{solicitud_id}', $model."Controller@edit" );
        Route:: get('/getAllInterno', $model."Controller@getAllInterno" );
        Route:: get('/getAllExterno/{fecha_reporte}', $model."Controller@getAllExterno" );
        Route:: get('/getAllFinalizadas', $model."Controller@getAllFinalizadas" );
    });
    Route::prefix('/personal_asistencial')->group(function () {
        $model = "PersonalAsistencial";
        Route:: get('/gelAll', $model."Controller@gelAll" );
        Route:: get('/gelAllOtroPersonal', $model."Controller@gelAllOtroPersonal" );
        Route:: post('/create', $model."Controller@create" );
        Route:: post('/destroy', $model."Controller@destroy" );

    });
    Route::prefix('/cat_quirofano')->group(function () {
        $model = "CatQuirofano";
        Route:: get('/getAll', $model."Controller@getAll" );
        Route:: post('/update', $model."Controller@update" );
    });

    //Route:: get('/index', $model."Controller@index_quirurgico" );
});
Route::prefix('/plan')->group(function () {

    Route::prefix('/cirugia')->group(function () {
        $model = "PlanesInstitucion";
        Route:: get('/getAll', $model."Controller@getAll" );
        Route:: post('/updateField', $model."Controller@updateField" );
        Route:: post('/store', $model."Controller@store_quirurgico" );
        Route:: get('/create', $model."Controller@create_quirurgico" );
        Route:: get('/index', $model."Controller@index_quirurgico" );
    });

});
Route::prefix('/cat')->group(function () {

    Route::prefix('/empresa')->group(function () {
        $model = "CatEmpresa";
        Route:: get('/index', $model."Controller@index" );
        Route:: get('/store', $model."Controller@store" );
        Route:: get('/edit', $model."Controller@edit" );
        Route:: get('/show/{id}', $model."Controller@show" );
        Route:: get('/update/{id}', $model."Controller@update" );
        Route:: get('/destroy/{id}', $model."Controller@destroy" );
    });
});
Route:: get('/homecare', "UserMedicoController@appHomecare" );
Route::prefix('/user')->group(function () {
    Route:: get('/index',"UserController@index" );
    Route:: get('/destroy/{id}',"UserController@destroy" );
    Route:: get('/cerrarepisodios/{id}',"UserController@cerrarEpisodiosPaciente" );

    $model = "User";
    Route:: get('/relationshipsbycedula/{user_id}', $model."Controller@relationshipsbycedula" );

    Route::prefix('/traslado_ambulancia')->group(function () {
        $model = "UserTrasladoAmbulancia";
        Route:: post('/store', $model."Controller@store" );
        Route:: get('/show/{user_id_paciente}', $model."Controller@show" );

    });
    Route::prefix('/aseguradoras')->group(function () {
        Route:: post('/store', "UserAdministrativoController@storeAseguradora" );
        //Route:: post('/destroy', "UserAdministrativoController@destroyWalkin" );
    });
    Route::prefix('/servicios')->group(function () {
        Route::prefix('/emergencia')->group(function () {
            Route:: post('/store', "UserAdministrativoController@store_servicioEmergencia" );
            Route:: post('/destroy', "UserAdministrativoController@destroy_servicioEmergencia" );
        });

    });
    Route::prefix('/tipopaciente')->group(function () {
        Route:: post('/store', "UserAdministrativoController@store_tipoPaciente" );
        //Route:: post('/destroy', "UserAdministrativoController@destroy_tipoPaciente" );
    });
    Route::prefix('/area')->group(function () {
        Route:: get('/{any}', "AreaController@app" );
        Route:: get('/hospitalizacion/{any}', "AreaController@app" );
    });
    Route::prefix('/admin')->group(function () {
        $model = "UserAdministrador";
        Route:: get('/{any}', "UserAdministradorController@app" );
        Route:: get('/dataegresostotales/{desde}/{hasta}', "UserAdministradorController@getEgresosTotales" );
        Route:: get('/dataingresostotales/{desde}/{hasta}', "UserAdministradorController@getIngresosTotales" );
        Route:: get('/dataegresosdatospacientes/{area}/{desde}/{hasta}', "UserAdministradorController@getEgresosDatosPacientes" );
        Route:: get('/dataingresosdatospacientes/{area}', "UserAdministradorController@getIngresosDatosPacientes" );
        Route:: get('/dataingresosqxdatospacientes/{area}', "UserAdministradorController@getIngresosQxDatosPacientes" );
        Route:: get('/dataegresosqxdatospacientes/{area}/{desde}/{hasta}', "UserAdministradorController@getEgresosQxDatosPacientes" );
    });

    Route::prefix('/medico')->group(function () {
       // dd("Aaa");
        $model = "UserMedico";
        Route:: get('/{any}', $model."Controller@app" );
        Route:: get('/{any1}/{any2}', $model."Controller@app" );
        Route:: get('/{any1}/{any2}/{any3}', $model."Controller@app" );
        Route:: post('/paciente/store', $model."Controller@store" );
    });
    Route::prefix('/enfermeria')->group(function () {
       // dd("Aaa");
        $model = "UserEnfermeria";
        Route:: get('', $model."Controller@app" );
        //Route:: get('/{any}', $model."Controller@app" );
        /* Route:: get('/{any1}/{any2}', $model."Controller@app" );
        Route:: get('/{any1}/{any2}/{any3}', $model."Controller@app" );
        Route:: post('/paciente/store', $model."Controller@store" ); */
    });
    Route::prefix('/profile')->group(function () {
        $model = "UserProfile";
        Route:: get('/getByCedula/{cedula}', $model."Controller@getByCedula" );
        Route:: get('/index', $model."Controller@index" );
        Route:: post('/store', $model."Controller@store" );
        Route:: get('/edit', $model."Controller@edit" );
        Route:: get('/show/{id}', $model."Controller@show" );
        Route:: get('/update/{id}', $model."Controller@update" );
        Route:: get('/destroy/{id}', $model."Controller@destroy" );
    });
    Route::prefix('/episode')->group(function () {
        $model = "UserCuestEpisodio";
        Route:: get('/active', $model."Controller@active" );
        Route:: get('/index', $model."Controller@index" );
        Route:: post('/store', $model."Controller@store" );
        Route:: get('/edit', $model."Controller@edit" );
        Route:: get('/show/{id}', $model."Controller@show" );
        Route:: get('/update/{id}', $model."Controller@update" );
        Route:: get('/destroy/{id}', $model."Controller@destroy" );
        Route:: get('/pacientes_activos', $model."Controller@pacientes_activos" );
    });

    Route::prefix('/reporte')->group(function () {
        $model = "Controller";
        Route:: get('/evolucion/{episodio_id}/{type}/{print}', $model."@reporte_evolucion" );
        Route:: get('/orden_medica/{episodio_id}/{type}/{print}', $model."@reporte_orden_medica" );
        Route:: get('/probabilidad_diagnostica/{episodio_id}/{type}/{print}', $model."@reporte_probabilidad_diagnostica" );
        Route:: get('/plan/{episodio_id}/{type}/{print}', $model."@reporte_plan" );
        Route:: get('/recipe/{episodio_id}/{type}/{print}', $model."@reporte_recipe" );
        Route:: get('/estudio_diagnostico/{episodio_id}/{type}/{print}', $model."@reporte_estudio_diagnostico" );
        Route:: get('/observacion/{episodio_id}/{type}/{print}', $model."@reporte_observacion" );
        Route:: get('/comorbilidad/{episodio_id}/{type}/{print}', $model."@reporte_comorbilidad" );
    });
    Route::prefix('/reportes')->group(function () {
        $model = "UserCuestInforme";
        Route:: get('/hospitalizacion/egresados/{fecha_inicio}', $model."Controller@hospitalizacion_egresados" );
        Route:: get('/evoluciones/ramh', $model."Controller@evoluciones_ramh" );

    });
    Route::prefix('/informe')->group(function () {
        $model = "UserCuestInforme";
        Route:: get('/nde/{nombre_documento}/{episodio}/{item_id}', $model."Controller@evolucion_medica" );
        Route:: get('/signos_vitales/{episodio}', $model."Controller@signos_vitales" );
        Route:: get('/omed/{nombre_documento}/{episodio}/{item_id}', $model."Controller@orden_medica" );
        Route:: get('/recmed/{nombre_documento}/{episodio}/{item_id}', $model."Controller@recipe_medico" );
        //Route:: get('/{nombre_documento}/{episodio}/{item_id}', $model."Controller@evolucion_medica" );
    });
    Route::prefix('/empresa')->group(function () {
        $model = "UserEmpresa";
        Route:: get('/index', $model."Controller@index" );
        Route:: post('/store', $model."Controller@store" );
        Route:: get('/edit', $model."Controller@edit" );
        Route:: get('/show/{id}', $model."Controller@show" );
        Route:: get('/update/{id}', $model."Controller@update" );
        Route:: get('/destroy/{id}', $model."Controller@destroy" );
    });
    Route::prefix('/profile/empresa')->group(function () {
        $model = "UserProfileEmpresa";
        Route:: get('/index/{fecha_desde}/{fecha_hasta}', $model."Controller@index" );
        Route:: post('/store', $model."Controller@store" );
        Route:: get('/edit', $model."Controller@edit" );
        Route:: get('/show/{id}', $model."Controller@show" );
        Route:: get('/show/byCedula/{cedula}', $model."Controller@showByCedula" );
        Route:: post('/update/{id}', $model."Controller@update" );
        Route:: get('/destroy/{id}', $model."Controller@destroy" );
        Route:: get('/getByCedula/{cedula}', $model."Controller@getByCedula" );
    });
    Route::prefix('/orientacion')->group(function () {
        $model = "UserOrientacion";
        Route:: get('/index/{fecha_desde}/{fecha_hasta}', $model."Controller@index" );
        Route:: get('/getByRango/{inicio}/{fin}', $model."Controller@getByRango" );
        Route:: post('/store', $model."Controller@store" );
        Route:: get('/edit', $model."Controller@edit" );
        Route:: get('/show/{id}', $model."Controller@show" );
        Route:: post('/update/{id}', $model."Controller@update" );
        Route:: get('/destroy/{id}', $model."Controller@destroy" );
    });
    Route::prefix('/especialidad')->group(function () {
        $model = "UserEspecialidad";
        Route:: get('/{id}/medicos', $model."Controller@medicos" );
        Route:: get('/{id}/anestesiologo', $model."Controller@anestesiologos" );
        Route:: get('/personalAsistencial', $model."Controller@personalAsistencial" );

    });
    Route::prefix('/encuesta')->group(function () {
        Route::prefix('/send')->group(function () {
            $model = "UserEncuesta";
            Route:: get('/hospitalizacion', $model."Controller@send_hospitalizacion" );
        });
    });
    Route::prefix('/tipo_documento')->group(function () {
        $model = "UserTipoDocumento";
        Route:: get('/show/{episodio_id}', $model."Controller@show" );
        Route:: post('/store', $model."Controller@store" );
    });
    Route::prefix('/paciente')->group(function () {
        $model = "UserPaciente";
        Route:: post('/storePaciente', $model."Controller@storePaciente" );
        Route:: post('/recortarimagen', $model."Controller@recortarimagen" );
    });
});
Route::prefix('/telesalud/empresarial')->group(function () {
    $model = "TelesaludEmpresarialController";
    Route:: get('/index', $model."@index" );
    Route:: get('/getAll/{area}', $model."@getAll" );

});
Route:: get('/send-message', "TestController@sendMessage" );
Route::post('/user_peso/store2', 'UserCuestPesoController@store2');
Route::post('/user_talla/store', 'UserTallaController@store');

// Rutas de encuestas
Route::get('/surveys/{survey_id}/{token}/{platform}', 'SurveyController@getSurvey')->name('surveys');
Route::get('/sections/{survey_id}', 'SectionController@index');
Route::post('/sendAnswers', 'DischargedController@sendAnswers');
Route::get('/dischargeds/sendSurveyList', 'DischargedController@showListToSend');
Route::post('dischargeds/updateSendSurveyList', 'DischargedController@updateListToSend');
Route::post('/dischargeds/rollbackEmail','DischargedController@rollbackEmail');
Route::post('/dischargeds/rollbackWhatsapp','DischargedController@rollbackWhatsapp');
ROute::post('/updateEmail', 'UserController@updateEmail');
Route::post('/reSendEmailWhatsapp', 'DischargedController@reSendEmailWhatsapp');
Route::post('/updateWhatsapp', 'UserProfileController@updateWhatsapp');
Route::get('/discharged/store/{user_id_paciente}', 'DischargedController@store');
Route::post('/updateDischargerStatus', 'DischargedController@updateStatus');
Route::get('/surveyInsituIndex','SurveyController@surveyInsituIndex');
Route::post('/surveyInsitu','SurveyController@surveyInsitu');
Route::post('/discharged/storeInsitu', 'DischargedController@storeInsitu');
Route::post('/pacientesHospitalizados', 'SurveyController@pacientesHospitalizados');
Route::post('/setDischargedToday','UserCuestEpisodioController@setDischargedToday');
Route::get('/getAreas', 'AreaController@index');
Route::post('/getStatisticsByAreaAjax', 'SurveyController@getStatisticsByAreaAjax');

//Rutas de estadísticas de las encuestas
Route::get('/surveys_index', 'SurveyController@index');
Route::post('/surveys_statistics_ajax', 'SurveyController@getStatisticsAjax');

// Route::get('/surveys_statistics/{survey_id}', 'SurveyController@getStatistics');
Route::get('/surveys_statistics/{survey_id}/{date_start}/{date_end}', 'SurveyController@getStatistics');

Route::post('/getSurveys','SurveyController@getSurveys');
Route::get('/getListSurveys','SurveyController@getListSurveys');

// Función que consume la cédula del paciente y devuelve si ya fue paciente, su usuario y su perfil y los episodios activos
Route::get('/getPatient/{cedula}', 'UserController@getPatient');

// Devuelve las ultimas ubicaciones en orden descendente del paciente
Route::get('/getIdUltimasUbicaciones/{user_id}', 'UserCuestUbicacionController@getUbicacionIdByUserId');

// Inicio de rutas relacionadas al módulo de consulta externa

Route::prefix('/consultaexterna')->group(function () {
    $model = "ConsultaExterna";
    Route:: get('/', $model."Controller@index" );
    Route:: get('/app/citalistado/{any}', $model."Controller@app" );
    Route:: get('/app/{any}', $model."Controller@app" );
    Route::post('/verificarCredenciales', $model."Controller@verificarCredenciales");
    Route::get('/initSession', $model."Controller@initSession");
    Route::get('/paciente/home', $model."Controller@consultaExternaHome");
    Route::post('/citas_activas', $model."Controller@citas_activas");
    Route::post('/citas_historial', $model."Controller@citas_historial");
    Route::get('/familiar/show/{user_id_paciente}/{cedula}', $model."Controller@get_familiares");
    Route::get('/finalizarSesion', $model."Controller@finalizarSesion");
    Route::post('/cat/centro_salud/getAll', $model."Controller@getAll_centros_salud");
    Route::get('/cat/centro_salud/getAll', $model."Controller@getAllCentroSalud");
    Route::post('/cat/centro_salud/getAll', $model."Controller@getAllCentroSalud");
    Route::post('/medicos/getAllCitas', $model."Controller@get_medicos");
    Route::get('/medico/tablero', $model."Controller@tablero_cita");
    Route::post('/medico/especialidad/getAll', $model."Controller@get_especialidades");
    Route::post('/medico/cita/status', 'UserCitaController@status');
    // Route::post('/user/medico/agenda/medicos', $model."Controller@getAllByMedicos");
    Route::get('/user/profile/show_by_cedula/{cedula}', $model."Controller@show_by_cedula");
    Route::post('/user/paciente/cita/existeCita', $model."Controller@existeCita");
    Route::post('/user/paciente/cita/store', $model."Controller@storeUserCita");
    Route::post('/user/paciente/storeFamiliar', $model."Controller@storeFamiliar");
    Route::get('/user/paciente/show2/{id}', $model."Controller@show2Paciente");
    Route::get("/user/familiar/por_revisar", "UserFamilyController@por_revisar");
    Route::post('/user/medico/activo/store', 'UserMedicoActivoController@store');
    Route::get('/user/medico/especialidad/destroy/{id}', "UserEspecialidadController@destroy");
    Route::get('/user/paciente/cita/reporteCitas/{startDate}/{endDate}', "UserCitaController@reporteCitas");
    Route::get('/user/paciente/cita/reporteCitasCreadas/{startDate}/{endDate}', "UserCitaController@reporteCitasCreadas");
    Route::get('/user/paciente/reportePacientes/{startDate}/{endDate}', "UserPacienteController@reportePacientes");
    Route::post('/user/medico/home/consultaExterna/store', 'UserMedicoController@consultaExternaStore');
    Route::post('/user/medico/home/consultaExterna/update', 'UserMedicoController@consultaExternaUpdate');
    Route::post('user/familiar/store_from_cita', "UserFamilyController@store_from_cita");
    Route::get('/user/medico/home/removeRol/{user_id}', "UserMedicoController@removeRol");
    Route::get('/user/medico/home/addRol/{user_id}', "UserMedicoController@addRol");
    Route::get('/user/paciente/removeRol/{user_id}/{rol}', "UserPacienteController@removeRol");
    Route::get('/user/paciente/addRol/{user_id}/{rol}', "UserPacienteController@addRol");
    Route::get('/cat/municipio/getAll','CatMunicipioController@getAll');
    Route::get('/cat/estado/getAll','CatEstadoController@getAll');
    Route::post('/paciente/consultaExternaStore/store', 'UserPacienteController@consultaExternaStore');
    Route::post('/paciente/consultaExternaStore/update', 'UserPacienteController@consultaExternaUpdate');
    Route::get('/cat/especialidad/getAll', "CatEspecialidadController@getAll");
    Route::get('/admin/getDataIndex/{dateStart}/{dateEnd}', 'AdminController@getDataIndex');
    Route::get('/cat/medico/getPersonalSalud', "UserMedicoController@getPersonalSalud");
    Route::post('/user/familiar/updateRevisado', "UserFamilyController@update_revisado");
    Route::get('/user/medico/agenda/destroy/{id}', "UserMedicoAgendaController@destroy");
    Route::get('/user/medico/agenda/show/{id}', "UserMedicoAgendaController@show");
    Route::get('/cat_user_especialidad/index', 'CatEspecialidadController@index');
    Route::get('/cat_user_especialidad/index2', 'CatEspecialidadController@index2');
    Route::post('/user/medico/cita/getCitasByDay', "UserCitaController@getCitasByDay");
    Route::get('/user/medico/agenda/show/{id}', "UserMedicoAgendaController@show");
    Route::post('/user/medico/agenda/store', 'UserMedicoAgendaController@store');
    Route::get('/user/medico/agenda/store', 'UserMedicoAgendaController@store');
    Route::get('/cat/especialidad/index', "CatEspecialidadController@index");
    Route::get('/cat/centro_salud/default', "CentroSaludController@default");
    Route::post('/user/paciente/motivo_consulta/store', "MotivoConsultaController@store");
    Route::post('/user/paciente/impresion_diagnostica/store4', "UserCuestImpresionDiagnosticaController@store4");
    Route::post('/user/paciente/examen_fisico/store', "ExamenFisicoController@store");
    Route::post('/user/paciente/enfermedad_actual/store', "EnfermedadActualController@store");
    Route::post('/user/paciente/plan/store2', "UserCuestPlanController@store2");
    Route::post('/user/paciente/cita/update/{id}', "UserCitaController@update");
    Route::get('/user/profile/searchUser/{search_params}', "UserProfileController@searchUser");
    Route::get('/user/medico/home/citas/update/one/{user_cita_id}', "UserMedicoController@nuevasCitasOne");
    Route::post('/user/medico/especialidad/getAll', "UserEspecialidadController@getAll");
    Route::post('/user/medico/agenda/medicos', "UserMedicoAgendaController@getAllByMedicos");
    Route::post('/paciente/cita/store', 'UserCitaController@store');
    Route::post('/user/paciente/cita/referencia/store', "UserCitaController@referencia_store");
    Route::get('/pdf/informeCita/enviar_y_finalizar/{user_centro_salud_id}/{user_medico_id}/{user_cita_id}/{user_id_paciente}/{print}', 'Controller@enviarinformeCitaByCorreo');
    Route::get('/user/paciente/cita/reporteCitasCreadasGerentes/{startDate}/{endDate}', "UserCitaController@reporteCitasCreadasGerentes");

    Route::post('/user_altura/store', 'UserCuestAlturaController@store');
    Route::post('/user_peso/store', 'UserCuestPesoController@store');
    Route::post('/user_temp/store', 'UserCuestTemperaturaController@store_cita');
    Route::post('/user_spo2/store', 'UserCuestOximetriaController@store_cita');
    Route::post('/user_fc/store', 'UserCuestFcController@store_cita');
    Route::post('/user_fr/store', 'UserCuestFrController@store_cita');
    Route::post('/user_glic/store', 'UserCuestGlicController@store_cita');
    Route::post('/user_ta_sis/store', 'UserCuestTaController@store_cita');
    Route::post('/user_ta_dia/store', 'UserCuestTaController@store_cita');

    Route::get('/user/paciente/recipe/index_by_cita/{cita_id}', "UserCuestRecipeController@index_by_cita");
    Route::get('/user/paciente/estudio/index_by_cita/{cita_id}', "UserCuestEstudioController@index_by_cita");
    Route::get('/user/paciente/cita/getDataPaciente2/{user_id_paciente}', "UserCitaController@getDataPaciente2");
    Route::get('/user/paciente/cita/getDataPaciente/{user_cita_id}', "UserCitaController@getDataPaciente");
    Route::get('/user/userCita/{user_id}', "UserController@userCita");
    Route::get('/user/medico/home/historial/citas/{user_id}', "UserMedicoController@citasCompletadas_paciente");
    Route::get('/user/medico/home/historial/citas', "UserMedicoController@citasCompletadas");
    Route::get('/pdf/historia/{user_cita_id}/{user_id_paciente}/{print}', 'Controller@historialinformeCita');
    Route::post('/medico/cita/reprogramar', 'UserCitaController@reprogramar');
    Route::post('/user/cortesia/store', "UserCortesiaController@store");
    Route::post('/user_profile/cedulaExiste', 'UserProfileController@cedulaExiste')->name("user_profile/cedulaExiste");
    Route::post('/user/paciente/storeExterno', "UserPacienteController@storeExterno");
    Route::post('paciente/emergenciaStore/store', 'UserPacienteController@emergenciaStore');
    Route::get('/user/emailExist', 'UserController@emailExist')->name("user/emailExist");
    Route::post('/user/emailExist', 'UserController@emailExist')->name("user/emailExist");
    Route::get('/medico/index_medicos', 'UserMedicoController@index_medicos')->name("medico/index_medicos");
    Route::get('/user/medico/especialidad/destroy2/{cat_especialidad_id}/{user_id_medico}', "UserEspecialidadController@destroy2");
    Route::get('/user/medico/getMedico/{id}', "UserMedicoController@getMedico");
    Route::post('/user/update_item', "UserController@update_item");
    Route::post('/user/direction/update_item', "UserCuestDireccionController@update_item");
    Route::post('/user/profile/update_item', "UserProfileController@update_item");
    Route::post('/user/profile/update_item_file', "UserProfileController@update_item_file");
    Route::post('/user/profile_images/update_item_file/{type}', "UserProfileImageController@update_item_file");
    Route::post('/user/paciente/tarjeta_soy_chacao/update_item', "TarjetaSoyChacaoController@update_item");
    Route::post('/user/profile/update_field/{id}', "UserProfileController@update_field");
    Route::get('/user/profile/exonerado', "UserProfileController@exonerado");
    Route::get('/user/login/resetPassword/AtencionPaciente/{cedula}', "ResetPasswordController@resetPasswordAtencionPaciente");

    Route::prefix('/pdf')->group(function () {
        Route::prefix('/recipe')->group(function () {
            Route::get('/preview/{centro_salud_id}/{episodio_id}/{medico_id}/{user_id_paciente}/{print}', 'Controller@recipe_preview');
            Route::get('/ws/{centro_salud_id}/{episodio_id}/{medico_id}/{user_id_paciente}/{print}', 'Controller@recipe_preview');
            Route::get('/email/{centro_salud_id}/{episodio_id}/{medico_id}/{user_id_paciente}/{print}', 'Controller@enviarRecipeByCorreo');

            Route::get('/cita/preview/{user_centro_salud_id}/{user_cita_id}/{recipe_num}/{user_id_paciente}/{user_id_medico}/{print}', 'Controller@recipe_cita_preview');
            Route::get('/cita/email/{user_centro_salud_id}/{user_cita_id}/{recipe_num}/{user_id_paciente}/{user_id_medico}/{print}', 'Controller@enviarRecipeByCorreoCita');
        });
        Route::prefix('/estudio')->group(function () {
            Route::get('/preview/{centro_salud_id}/{episodio_id}/{medico_id}/{user_id_paciente}/{print}', 'Controller@estudio_preview');
            Route::get('/ws/{centro_salud_id}/{episodio_id}/{medico_id}/{user_id_paciente}/{print}', 'Controller@estudio_preview');
            Route::get('/email/{centro_salud_id}/{episodio_id}/{medico_id}/{user_id_paciente}/{print}', 'Controller@enviarEstudioByCorreo');

            Route::get('/cita/preview/{user_centro_salud_id}/{user_cita_id}/{recipe_num}/{user_id_paciente}/{user_id_medico}/{print}', 'Controller@estudio_cita_preview');
            Route::get('/cita/email/{user_centro_salud_id}/{user_cita_id}/{estudio_num}/{user_id_paciente}/{user_id_medico}/{print}', 'Controller@enviarEstudioByCorreoCita');

        });
    });

    Route:: post('/user/paciente/estudio/store', "UserCuestEstudioController@store");
    Route:: post('/user/paciente/estudio/store_cita', "UserCuestEstudioController@store_cita");
    Route:: post('/user/paciente/estudio/update/{id}', "UserCuestEstudioController@update");
    Route:: post('/user/paciente/estudio/destroy/{id}', "UserCuestEstudioController@destroy");

    Route:: post('/user/paciente/fotografia/store_cita', "UserCuestFotografiaController@store_cita");
    Route:: post('/user/paciente/fotografia/update/{id}', "UserCuestFotografiaController@update");
    Route:: post('/user/paciente/fotografia/destroy/{id}', "UserCuestFotografiaController@destroy");
    Route:: get('/user/paciente/fotografia/index_by_cita/{user_id}', "UserCuestFotografiaController@index_by_cita");

    Route:: post('/user/paciente/imagenes/store_cita', "UserCuestImagenController@store_cita");
    Route:: post('/user/paciente/imagenes/update/{id}', "UserCuestImagenController@update");
    Route:: post('/user/paciente/imagenes/destroy/{id}', "UserCuestImagenController@destroy");
    Route:: get('/user/paciente/imagenes/index_by_cita/{user_id}', "UserCuestImagenController@index_by_cita");

    Route:: post('/user/paciente/laboratorio/store_cita', "UserCuestLaboratorioController@store_cita");
    Route:: post('/user/paciente/laboratorio/update/{id}', "UserCuestLaboratorioController@update");
    Route:: post('/user/paciente/laboratorio/destroy/{id}', "UserCuestLaboratorioController@destroy");
    Route:: get('/user/paciente/laboratorio/index_by_cita/{user_id}', "UserCuestLaboratorioController@index_by_cita");

    Route:: post('/user/paciente/otro_archivo/store_cita', "UserCuestOtroArchivoController@store_cita");
    Route:: post('/user/paciente/otro_archivo/update/{id}', "UserCuestOtroArchivoController@update");
    Route:: post('/user/paciente/otro_archivo/destroy/{id}', "UserCuestOtroArchivoController@destroy");
    Route:: get('/user/paciente/otro_archivo/index_by_cita/{cita_id}', "UserCuestOtroArchivoController@index_by_cita");

    Route:: post('/user/paciente/recipe/store_cita', "UserCuestRecipeController@store_cita");
    Route:: post('/user/paciente/recipe/update/{id}', "UserCuestRecipeController@update");
    Route:: post('/user/paciente/recipe/destroy/{id}', "UserCuestRecipeController@destroy");
    Route:: get('/user/paciente/recipe/index_by_cita/{cita_id}', "UserCuestRecipeController@index_by_cita");

    Route::post('/user_profile_images/getAll', 'UserProfileImageController@getAll');
    Route::post('/passwordResetStore', 'ResetPasswordController@resetPassword');
    Route::post('/passwordResetStoreConfirm', 'ResetPasswordController@resetPasswordConfirm');
    Route::get('/user_tarjeta_soy_chacao/show/{user_id}', 'TarjetaSoyChacaoController@show');


    Route::get('/user/paciente/antecedente/getByPaciente/{id}', "UserCuestAntecedenteController@getByPaciente");
    Route::post('/user/paciente/antecedente/store', "UserCuestAntecedenteController@store");

    Route::get('/user/paciente/condicion_medica/getByPaciente/{id}', "UserCondicionMedicaController@getByPaciente");
    Route::post('/user/paciente/condicion_medica/store', "UserCondicionMedicaController@store");

    Route::get('/user/paciente/alergia/getByPaciente/{id}', "UserCuestAlergiaController@getByPaciente");
    Route::post('/user/paciente/alergia/store', "UserCuestAlergiaController@store");

    Route::get('/user/paciente/medicamento/getByPaciente/{id}', "UserCuestMedicamentoController@getByPaciente");
    Route::post('/user/paciente/medicamento/store', "UserCuestMedicamentoController@store");

    Route::post('/user/paciente/enfermedad_actual/store', "EnfermedadActualController@store");
    Route::post('/user/paciente/examen_fisico/store', 'ExamenFisicoController@store');

    Route::get('/pdf/informeCita/{user_centro_salud_id}/{user_medico_id}/{user_cita_id}/{user_id_paciente}/{print}', 'Controller@enviarinformeCita');

    Route::get('/medico/cita/tablero', 'ConsultaExternaController@tablero_cita');

    Route::get('/admin/reportes', 'AdminController@reportes');

    Route::get('/user/paciente/impresion_diagnostica/getByCita/{user_cita_id}', 'UserCuestImpresionDiagnosticaController@getByCita');
    Route::get('/user/paciente/enfermedad_actual/getByCita/{user_cita_id}', 'EnfermedadActualController@getByCita');
    Route::get('/user/paciente/examen_fisico/getByCita/{user_cita_id}', 'ExamenFisicoController@getByCita');
    Route::get('/user/paciente/user_plan/getByCita/{user_cita_id}', 'UserCuestPlanController@getByCita');

    Route::get('/pdf/recipe/cita/email/{user_centro_salud_id}/{user_cita_id}/{recipe_num}/{user_id_paciente}/{user_id_medico}/{print}', 'Controller@enviarRecipeByCorreoCita');

    Route::get('/cat_empresa/get_by_id/{id}', 'CatEmpresaController@getById');
    Route::get('/cat_seguro/get_by_id/{id}', 'CatSeguroController@getById');
    Route::get('/department/get_by_id/{id}', 'DepartmentController@getById');
    Route::get('/cat_seguro/all', 'CatSeguroController@getAll');
    Route::get('/cat_empresa/all', 'CatEmpresaController@getAll');
    Route::get('/department/all', 'DepartmentController@getAll');
    Route::get('/department/all_by_shortname', 'DepartmentController@getAllByShortname');
});
Route:: get('/user/profile/searchUser/{search_params}', "UserProfileController@searchUser");
Route::get('/admin/index', 'AdminController@index');
// Fin de rutas relacionadas al módulo de consulta externa

// Rutas menú inicial - INICIO
/* Route::get('/menu_inicial_principal',function () {
    return view('auth.menuPrincipal');
}); */
/* Route::get('/menu_inicial_aq',function () {
    return view('auth.menuAreaQuirurgica');
}); */
Route::get('/menu_inicial_uti',function () {
    return view('auth.menu_inicial_uti');
});
/* Route::get('/menu_inicial_telesalud',function () {
    return view('auth.menuTelesalud');
}); */
/* Route::get('/menu_inicial_dashboards',function () {
    return view('auth.menuDashboardsSeguimiento');
}); */
/* Route::get('/menu_inicial_hospitalizacion',function () {
    return view('auth.menuHospitalizacion');
});
Route::get('/menu_inicial_pacientes_piso',function () {
    return view('auth.menuPacientesPiso');
}); */
Route::get('/menu_inicial_eventos_especiales',function () {
    return view('auth.menuEventosEspeciales');
});
Route::get('/menu_inicial_administrador',function () {
    return view('auth.menuAdministrador');
});
Route::get('/menu_inicial_administrador_reportes',function () {
    return view('auth.menuAdministradorReportes');
});
/* Route::get('/menu_inicial_satisfaccion',function () {
    return view('auth.menuSatisfaccion');
}); */
// Rutas menú inicial - FIN

// Rutas dashboard QX - INICIO
Route::post('/dashboard_qx/total_cirugias_hospitalizacion','AreaQuirurgicaController@totalCirugiasHospitalizacion');
Route::post('/dashboard_qx/total_cirugias_mapm','AreaQuirurgicaController@totalCirugiasMapm');
Route::post('/dashboard_qx/cirugias_ejecutadas_x_mes','AreaQuirurgicaController@cirugiasEjecutadasXMes');
Route::get('/dashboard_qx/cirugias_culminadas_x_medico','AreaQuirurgicaController@cirugiasCulminadasXMedico');
Route::post('/dashboard_qx/cirugias_culminadas_x_medico','AreaQuirurgicaController@cirugiasCulminadasXMedico');
Route::get('/dashboard_qx/cirugiasCulminadasXAnestesiologo','AreaQuirurgicaController@cirugiasCulminadasXAnestesiologo');
Route::post('/dashboard_qx/cirugiasCulminadasXAnestesiologo','AreaQuirurgicaController@cirugiasCulminadasXAnestesiologo');
Route::post('/dashboard_qx/turnos_horarios','AreaQuirurgicaController@getTurnosHorarios');
Route::post('/dashboard_qx/proximas_solicitudes','AreaQuirurgicaController@getProximasSolicitudes');
Route::post('/dashboard_qx/equipos_especiales','AreaQuirurgicaController@getEquiposEspeciales');
Route::post('/dashboard_qx/tipo_cirugia','AreaQuirurgicaController@getCirugiasByType');
Route::post('/dashboard_qx/top_intervenciones','AreaQuirurgicaController@getTopIntervenciones');
Route::post('/dashboard_qx/top_especialidades','AreaQuirurgicaController@getTopEspecialidades');
Route::get('/dashboard_qx/top_especialidades','AreaQuirurgicaController@getTopEspecialidades');
Route::get('/dashboard_qx/totales_resumen','AreaQuirurgicaController@getTotalesResumen');
Route::post('/dashboard_qx/totales_resumen','AreaQuirurgicaController@getTotalesResumen');
// Rutas dashboard QX - FIN

Route::post('/guardias/store','UserGuardiasController@store');
Route::post('/guardias/show','UserGuardiasController@show');
Route::post('/guardias/updatefield','UserGuardiasController@updatefield');
Route::post('/guardias/today_list','UserGuardiasController@today_list');
