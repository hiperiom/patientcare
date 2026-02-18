<?php

namespace App\Models;

use App\Models\UserProfile;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserCuestHistoriaMedica extends Model
{
    protected $table ="user_cuest_historia_medica";
    protected $fillable = [
        "episode",
        "inicio_episodio",
        "fin_episodio",
        "i_motivo_consulta",
        "i_enfermedad_actual",
        "i_examen_fisico",
        "i_diagnostico",
        "i_plan_trabajo",
        "cat_user_especialidad_id",
        "user_id_medico_tratante",
        "user_id_medico",
        "created_at",
        "user_id",
        "user_cuest_episodio_id",
    ];

    static function index_episodio($episodio_id)
    {
        return UserCuestHistoriaMedica::where('user_cuest_episodio_id',$episodio_id)
        ->select('id', 'value', 'coments', 'file_type')
        ->orderBy("id","DESC")
        ->get();
    }

    static function index(Request $request)
    {

        return UserCuestHistoriaMedica::where("user_cuest_historia_medica.user_id",$request->user_id)
        ->join("user_profile","user_cuest_historia_medica.user_id","user_profile.user_id")
            ->select(
                "user_cuest_historia_medica.id",
                "user_cuest_historia_medica.episode",
                DB::raw("DATE_FORMAT(user_cuest_historia_medica.inicio_episodio, '%d/%m/%Y') AS inicio_episodio"),
                DB::raw("
                    CASE
                        WHEN ISNULL(user_cuest_historia_medica.fin_episodio) THEN 'Activo'
                    ELSE
                        DATE_FORMAT(user_cuest_historia_medica.fin_episodio, '%d/%m/%Y')
                    END AS fin_episodio
                "),
                DB::raw("
                    CASE
                        WHEN ISNULL(user_cuest_historia_medica.user_id_medico_tratante) THEN 'No indicado'
                    ELSE
                        CONCAT(
                            user_profile.nombres,
                            ' ',
                            user_profile.apellidos
                        )
                    END AS medico_tratante
                ")


            )
            ->orderBy("user_cuest_historia_medica.id","DESC")
            ->get();

    }
    static function store(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);

        $model = new UserCuestHistoriaMedica();
        $model->user_cuest_episodio_id = $episode_id;
        $model::updateOrCreate([
            'episode'   => $request->episode,
            'user_id'   => $request->user_id,
            'fin_episodio'   => NULL,
            'active'   => 1,
        ],[
            'episode'     => $request->episode,
            'inicio_episodio' =>date('Y-m-d H:i:s', strtotime($request->inicio_episodio)),
            'i_motivo_consulta' => $request->i_motivo_consulta,
            'i_enfermedad_actual' => $request->i_enfermedad_actual,
            'i_examen_fisico' => $request->i_examen_fisico,
            'i_diagnostico' => $request->i_diagnostico,
            'i_plan_trabajo' => $request->i_plan_trabajo,
            'cat_user_especialidad_id' => $request->cat_user_especialidad_id,
            'user_id_medico_tratante' => $request->user_id_medico_tratante,
            'user_id' => $request->user_id,
            'user_id_medico' => Auth::id(),
            "created_at"=>date('Y-m-d H:i:s', strtotime($request->created_at))
        ]);
        return UserCuestHistoriaMedica::show($request);
    }
    static function show(Request $request)
    {
        return UserCuestHistoriaMedica::whereNull("fin_episodio")->where("active",1)->where("user_id",$request->user_id)->first();
    }
    static function eliminar(Request $request)
    {
        UserCuestHistoriaMedica::whereNull("fin_episodio")->where("id",$request->user_cuest_historia_medica_id)->where("active",1)
        ->update([
            "fin_episodio"=>date('Y-m-d H:i:s', strtotime($request->fin_episodio)),
            "active"=>0
        ]);
        return UserCuestHistoriaMedica::where("id",$request->user_cuest_historia_medica_id)->first();
    }
    static function create(Request $request)
    {
        $model = [];
        $model['fecha_registro'] =  User::getCreatedAt($request);
        $model['historia_id'] =  UserCuestHistoriaMedica::getHistory($request->user_id);
        $model['episodio_id'] =  UserCuestHistoriaMedica::getEpisodio($request->user_id);
        $model['paciente'] =  UserProfile::getPaciente($request->user_id);
        $model['paciente_edad'] =  UserProfile::getPacienteEdad($request->user_id);
        return $model;
    }
    static function getHistory($user_id)
    {
        //el numero de historia sera el id del usuario
        return $user_id;
    }
    static function getEpisodio($user_id)
    {
        //el numero de historia sera el id del usuario
        $model =  UserCuestHistoriaMedica::where("user_id",$user_id)->select("episode","fin_episodio")->orderby('created_at','DESC')->take(1)->get();
        //dd(count($model));
        if(count($model)>0){
            if(is_null($model[0]->fin_episodio)){
                return $model[0]->episode;
            }else{
                return $model[0]->episode+1;
            }
        }else{
            return 1;
        }

    }
    static function getIdUltimoEpisodio($user_id)
    {
        //el numero de historia sera el id del usuario
        $model =  UserCuestHistoriaMedica::where("user_id",$user_id)->select("id","fin_episodio")->orderby('created_at','DESC')->take(1)->get();
        if(count($model)>0){
            if(is_null($model[0]->fin_episodio)){
                return $model[0]->id;
            }else{
                return null;
            }
        }else{
            return null;
        }

    }
    static function getId($user_id)
    {
        //el numero de historia sera el id del usuario
        $model =  UserCuestHistoriaMedica::where("user_id",$user_id)->select("id")->orderby('created_at','DESC')->take(1)->get();
        if(count($model)>0){
            return $model[0]->id;
        }else{
            return NULL;
        }

    }
    static function getHistorial($user_id)
    {
        $episodio_id = UserCuestEpisodio::ultimoEpisodio_id($user_id);
        $model =
            DB::select(
            "
                #UNION ALL
                    SELECT
                        user_cuest_imp_diagn.id,
                        cat_user_cuestionario.description,
                        user_cuest_imp_diagn.created_at,
                        DATE_FORMAT(user_cuest_imp_diagn.created_at, '%h:%i %p') AS hora,
                        user_cuest_imp_diagn.value,
                        user_cuest_imp_diagn.user_id AS user_id_paciente,
                        user_cuest_imp_diagn.coments,
                        user_cuest_imp_diagn.user_id_medico,
                        CONCAT(
                            CASE
                                WHEN tbl_medico.prefijo IS NOT NULL AND tbl_medico.prefijo != 'null' THEN CONCAT(tbl_medico.prefijo,' ')
                                ELSE ''
                            END,

                            tbl_medico.apellidos,
                            ' ',
                            tbl_medico.nombres
                        ) AS medico,
                        CONCAT(
                            tbl_medico.nacionalidad,
                            ' ',
                            tbl_medico.cedula
                        ) AS medico_cedula,
                        tbl_medico.extension_telefonica,
                        tbl_medico.mpps,
                        tbl_medico.colegio_medico,
                        tbl_medico.firma,
                        tbl_medico.sello,
                        (
                            SELECT GROUP_CONCAT(cat_user_especialidad.description)
                            FROM user_especialidad AS ue
                            JOIN cat_user_especialidad ON ue.cat_user_especialidad_id = cat_user_especialidad.id
                            WHERE ue.user_id = tbl_medico.user_id
                        ) medico_especialidades,
                        CONCAT(
                            tbl_paciente.nombres,
                            ' ',
                            tbl_paciente.apellidos
                        ) AS paciente
                        

                    FROM user_cuest_imp_diagn
                    INNER JOIN user_profile AS tbl_medico ON  user_cuest_imp_diagn.user_id_medico = tbl_medico.user_id
                    INNER JOIN user_profile AS tbl_paciente ON  user_cuest_imp_diagn.user_id = tbl_paciente.user_id
                    INNER JOIN cat_user_cuestionario ON  user_cuest_imp_diagn.cat_user_cuestionario_id = cat_user_cuestionario.id
                    WHERE user_cuest_imp_diagn.user_id = ".$user_id."
                    AND user_cuest_imp_diagn.user_cuest_episodio_id = ".$episodio_id."
                UNION ALL
                    SELECT
                        user_cuest_evolucion.id,
                        cat_user_cuestionario.description,
                        user_cuest_evolucion.created_at,
                        DATE_FORMAT(user_cuest_evolucion.created_at, '%h:%i %p') AS hora,
                        user_cuest_evolucion.value,
                        user_cuest_evolucion.user_id AS user_id_paciente,
                        user_cuest_evolucion.coments,
                        user_cuest_evolucion.user_id_medico,
                        CONCAT(
                            CASE
                                WHEN tbl_medico.prefijo IS NOT NULL AND tbl_medico.prefijo != 'null' THEN CONCAT(tbl_medico.prefijo,' ')
                                ELSE ''
                            END,

                            tbl_medico.apellidos,
                            ' ',
                            tbl_medico.nombres
                        ) AS medico,
                         CONCAT(
                            tbl_medico.nacionalidad,
                            ' ',
                            tbl_medico.cedula
                        ) AS medico_cedula,
                        tbl_medico.extension_telefonica,
                        tbl_medico.mpps,
                        tbl_medico.colegio_medico,
                        tbl_medico.firma,
                        tbl_medico.sello,
                        (
                            SELECT GROUP_CONCAT(cat_user_especialidad.description)
                            FROM user_especialidad AS ue
                            JOIN cat_user_especialidad ON ue.cat_user_especialidad_id = cat_user_especialidad.id
                            WHERE ue.user_id = tbl_medico.user_id
                        ) medico_especialidades,
                        CONCAT(
                            tbl_paciente.nombres,
                            ' ',
                            tbl_paciente.apellidos
                        ) AS paciente

                    FROM user_cuest_evolucion
                    INNER JOIN user_profile AS tbl_medico ON  user_cuest_evolucion.user_id_medico = tbl_medico.user_id
                    INNER JOIN user_profile AS tbl_paciente ON  user_cuest_evolucion.user_id = tbl_paciente.user_id
                    INNER JOIN cat_user_cuestionario ON  user_cuest_evolucion.cat_user_cuestionario_id = cat_user_cuestionario.id
                    WHERE user_cuest_evolucion.user_id = ".$user_id."
                    AND user_cuest_evolucion.user_cuest_episodio_id = ".$episodio_id."
                UNION ALL
                    SELECT
                        user_cuest_plan.id,
                        cat_user_cuestionario.description,
                        user_cuest_plan.created_at,
                        DATE_FORMAT(user_cuest_plan.created_at, '%h:%i %p') AS hora,
                        user_cuest_plan.value,
                        user_cuest_plan.user_id AS user_id_paciente,
                        user_cuest_plan.coments,
                        user_cuest_plan.user_id_medico,
                        CONCAT(
                            CASE
                                WHEN tbl_medico.prefijo IS NOT NULL AND tbl_medico.prefijo != 'null' THEN CONCAT(tbl_medico.prefijo,' ')
                                ELSE ''
                            END,

                            tbl_medico.apellidos,
                            ' ',
                            tbl_medico.nombres
                        ) AS medico,
                         CONCAT(
                            tbl_medico.nacionalidad,
                            ' ',
                            tbl_medico.cedula
                        ) AS medico_cedula,
                        tbl_medico.extension_telefonica,
                        tbl_medico.mpps,
                        tbl_medico.colegio_medico,
                        tbl_medico.firma,
                        tbl_medico.sello,
                        (
                            SELECT GROUP_CONCAT(cat_user_especialidad.description)
                            FROM user_especialidad AS ue
                            JOIN cat_user_especialidad ON ue.cat_user_especialidad_id = cat_user_especialidad.id
                            WHERE ue.user_id = tbl_medico.user_id
                        ) medico_especialidades,
                        CONCAT(
                            tbl_paciente.nombres,
                            ' ',
                            tbl_paciente.apellidos
                        ) AS paciente

                    FROM user_cuest_plan
                    INNER JOIN user_profile AS tbl_medico ON  user_cuest_plan.user_id_medico = tbl_medico.user_id
                    INNER JOIN user_profile AS tbl_paciente ON  user_cuest_plan.user_id = tbl_paciente.user_id
                    INNER JOIN cat_user_cuestionario ON  user_cuest_plan.cat_user_cuestionario_id = cat_user_cuestionario.id
                    WHERE user_cuest_plan.user_id = ".$user_id."
                    AND user_cuest_plan.user_cuest_episodio_id = ".$episodio_id."
                UNION ALL
                    SELECT
                        user_cuest_observacion.id,
                        cat_user_cuestionario.description,
                        user_cuest_observacion.created_at,
                        DATE_FORMAT(user_cuest_observacion.created_at, '%h:%i %p') AS hora,
                        user_cuest_observacion.value,
                        user_cuest_observacion.user_id AS user_id_paciente,
                        user_cuest_observacion.coments,
                        user_cuest_observacion.user_id_medico,
                        CONCAT(
                            CASE
                                WHEN tbl_medico.prefijo IS NOT NULL AND tbl_medico.prefijo != 'null' THEN CONCAT(tbl_medico.prefijo,' ')
                                ELSE ''
                            END,

                            tbl_medico.apellidos,
                            ' ',
                            tbl_medico.nombres
                        ) AS medico,
                         CONCAT(
                            tbl_medico.nacionalidad,
                            ' ',
                            tbl_medico.cedula
                        ) AS medico_cedula,
                        tbl_medico.extension_telefonica,
                        tbl_medico.mpps,
                        tbl_medico.colegio_medico,
                        tbl_medico.firma,
                        tbl_medico.sello,
                        (
                            SELECT GROUP_CONCAT(cat_user_especialidad.description)
                            FROM user_especialidad AS ue
                            JOIN cat_user_especialidad ON ue.cat_user_especialidad_id = cat_user_especialidad.id
                            WHERE ue.user_id = tbl_medico.user_id
                        ) medico_especialidades,
                        CONCAT(
                            tbl_paciente.nombres,
                            ' ',
                            tbl_paciente.apellidos
                        ) AS paciente

                    FROM user_cuest_observacion
                    INNER JOIN user_profile AS tbl_medico ON  user_cuest_observacion.user_id_medico = tbl_medico.user_id
                    INNER JOIN user_profile AS tbl_paciente ON  user_cuest_observacion.user_id = tbl_paciente.user_id
                    INNER JOIN cat_user_cuestionario ON  user_cuest_observacion.cat_user_cuestionario_id = cat_user_cuestionario.id
                    WHERE user_cuest_observacion.user_id = ".$user_id."
                    AND user_cuest_observacion.user_cuest_episodio_id = ".$episodio_id."


                UNION ALL
                    SELECT
                        user_cuest_recipe.id,
                        cat_user_cuestionario.description,
                        user_cuest_recipe.created_at,
                        DATE_FORMAT(user_cuest_recipe.created_at, '%h:%i %p') AS hora,
                        user_cuest_recipe.value,
                        user_cuest_recipe.user_id AS user_id_paciente,
                        user_cuest_recipe.coments,
                        user_cuest_recipe.user_id_medico,
                        CONCAT(
                            CASE
                                WHEN tbl_medico.prefijo IS NOT NULL AND tbl_medico.prefijo != 'null' THEN CONCAT(tbl_medico.prefijo,' ')
                                ELSE ''
                            END,

                            tbl_medico.apellidos,
                            ' ',
                            tbl_medico.nombres
                        ) AS medico,
                         CONCAT(
                            tbl_medico.nacionalidad,
                            ' ',
                            tbl_medico.cedula
                        ) AS medico_cedula,
                        tbl_medico.extension_telefonica,
                        tbl_medico.mpps,
                        tbl_medico.colegio_medico,
                        tbl_medico.firma,
                        tbl_medico.sello,
                        (
                            SELECT GROUP_CONCAT(cat_user_especialidad.description)
                            FROM user_especialidad AS ue
                            JOIN cat_user_especialidad ON ue.cat_user_especialidad_id = cat_user_especialidad.id
                            WHERE ue.user_id = tbl_medico.user_id
                        ) medico_especialidades,
                        CONCAT(
                            tbl_paciente.nombres,
                            ' ',
                            tbl_paciente.apellidos
                        ) AS paciente

                    FROM user_cuest_recipe
                    INNER JOIN user_profile AS tbl_medico ON  user_cuest_recipe.user_id_medico = tbl_medico.user_id
                    INNER JOIN user_profile AS tbl_paciente ON  user_cuest_recipe.user_id = tbl_paciente.user_id
                    INNER JOIN cat_user_cuestionario ON  user_cuest_recipe.cat_user_cuestionario_id = cat_user_cuestionario.id
                    WHERE user_cuest_recipe.user_id = ".$user_id."
                    AND user_cuest_recipe.user_cuest_episodio_id = ".$episodio_id."


                UNION ALL
                    SELECT
                        user_cuest_estudio.id,
                        cat_user_cuestionario.description,
                        user_cuest_estudio.created_at,
                        DATE_FORMAT(user_cuest_estudio.created_at, '%h:%i %p') AS hora,
                        user_cuest_estudio.value,
                        user_cuest_estudio.user_id AS user_id_paciente,
                        user_cuest_estudio.coments,
                        user_cuest_estudio.user_id_medico,
                        CONCAT(
                            CASE
                                WHEN tbl_medico.prefijo IS NOT NULL AND tbl_medico.prefijo != 'null' THEN CONCAT(tbl_medico.prefijo,' ')
                                ELSE ''
                            END,

                            tbl_medico.apellidos,
                            ' ',
                            tbl_medico.nombres
                        ) AS medico,
                         CONCAT(
                            tbl_medico.nacionalidad,
                            ' ',
                            tbl_medico.cedula
                        ) AS medico_cedula,
                        tbl_medico.extension_telefonica,
                        tbl_medico.mpps,
                        tbl_medico.colegio_medico,
                        tbl_medico.firma,
                        tbl_medico.sello,
                        (
                            SELECT GROUP_CONCAT(cat_user_especialidad.description)
                            FROM user_especialidad AS ue
                            JOIN cat_user_especialidad ON ue.cat_user_especialidad_id = cat_user_especialidad.id
                            WHERE ue.user_id = tbl_medico.user_id
                        ) medico_especialidades,
                        CONCAT(
                            tbl_paciente.nombres,
                            ' ',
                            tbl_paciente.apellidos
                        ) AS paciente

                    FROM user_cuest_estudio
                    INNER JOIN user_profile AS tbl_medico ON  user_cuest_estudio.user_id_medico = tbl_medico.user_id
                    INNER JOIN user_profile AS tbl_paciente ON  user_cuest_estudio.user_id = tbl_paciente.user_id
                    INNER JOIN cat_user_cuestionario ON  user_cuest_estudio.cat_user_cuestionario_id = cat_user_cuestionario.id
                    WHERE user_cuest_estudio.user_id = ".$user_id."
                    AND user_cuest_estudio.user_cuest_episodio_id = ".$episodio_id."


                UNION ALL
                    SELECT
                        user_cuest_laboratorio.id,
                        cat_user_cuestionario.description,
                        user_cuest_laboratorio.created_at,
                        DATE_FORMAT(user_cuest_laboratorio.created_at, '%h:%i %p') AS hora,
                        user_cuest_laboratorio.value,
                        user_cuest_laboratorio.user_id AS user_id_paciente,
                        user_cuest_laboratorio.coments,
                        user_cuest_laboratorio.user_id_medico,
                        CONCAT(
                            CASE
                                WHEN tbl_medico.prefijo IS NOT NULL AND tbl_medico.prefijo != 'null' THEN CONCAT(tbl_medico.prefijo,' ')
                                ELSE ''
                            END,

                            tbl_medico.apellidos,
                            ' ',
                            tbl_medico.nombres
                        ) AS medico,
                         CONCAT(
                            tbl_medico.nacionalidad,
                            ' ',
                            tbl_medico.cedula
                        ) AS medico_cedula,
                        tbl_medico.extension_telefonica,
                        tbl_medico.mpps,
                        tbl_medico.colegio_medico,
                        tbl_medico.firma,
                        tbl_medico.sello,
                        (
                            SELECT GROUP_CONCAT(cat_user_especialidad.description)
                            FROM user_especialidad AS ue
                            JOIN cat_user_especialidad ON ue.cat_user_especialidad_id = cat_user_especialidad.id
                            WHERE ue.user_id = tbl_medico.user_id
                        ) medico_especialidades,
                        CONCAT(
                            tbl_paciente.nombres,
                            ' ',
                            tbl_paciente.apellidos
                        ) AS paciente

                    FROM user_cuest_laboratorio
                    INNER JOIN user_profile AS tbl_medico ON  user_cuest_laboratorio.user_id_medico = tbl_medico.user_id
                    INNER JOIN user_profile AS tbl_paciente ON  user_cuest_laboratorio.user_id = tbl_paciente.user_id
                    INNER JOIN cat_user_cuestionario ON  user_cuest_laboratorio.cat_user_cuestionario_id = cat_user_cuestionario.id
                    WHERE user_cuest_laboratorio.user_id = ".$user_id."
                    AND user_cuest_laboratorio.user_cuest_episodio_id = ".$episodio_id."


                UNION ALL
                    SELECT
                        user_cuest_fotografia.id,
                        cat_user_cuestionario.description,
                        user_cuest_fotografia.created_at,
                        DATE_FORMAT(user_cuest_fotografia.created_at, '%h:%i %p') AS hora,
                        user_cuest_fotografia.value,
                        user_cuest_fotografia.user_id AS user_id_paciente,
                        user_cuest_fotografia.coments,
                        user_cuest_fotografia.user_id_medico,
                        CONCAT(
                            CASE
                                WHEN tbl_medico.prefijo IS NOT NULL AND tbl_medico.prefijo != 'null' THEN CONCAT(tbl_medico.prefijo,' ')
                                ELSE ''
                            END,

                            tbl_medico.apellidos,
                            ' ',
                            tbl_medico.nombres
                        ) AS medico,
                         CONCAT(
                            tbl_medico.nacionalidad,
                            ' ',
                            tbl_medico.cedula
                        ) AS medico_cedula,
                        tbl_medico.extension_telefonica,
                        tbl_medico.mpps,
                        tbl_medico.colegio_medico,
                        tbl_medico.firma,
                        tbl_medico.sello,
                        (
                            SELECT GROUP_CONCAT(cat_user_especialidad.description)
                            FROM user_especialidad AS ue
                            JOIN cat_user_especialidad ON ue.cat_user_especialidad_id = cat_user_especialidad.id
                            WHERE ue.user_id = tbl_medico.user_id
                        ) medico_especialidades,
                        CONCAT(
                            tbl_paciente.nombres,
                            ' ',
                            tbl_paciente.apellidos
                        ) AS paciente

                    FROM user_cuest_fotografia
                    INNER JOIN user_profile AS tbl_medico ON  user_cuest_fotografia.user_id_medico = tbl_medico.user_id
                    INNER JOIN user_profile AS tbl_paciente ON  user_cuest_fotografia.user_id = tbl_paciente.user_id
                    INNER JOIN cat_user_cuestionario ON  user_cuest_fotografia.cat_user_cuestionario_id = cat_user_cuestionario.id
                    WHERE user_cuest_fotografia.user_id = ".$user_id."
                    AND user_cuest_fotografia.user_cuest_episodio_id = ".$episodio_id."


                UNION ALL
                    SELECT
                        user_cuest_otro_archivo.id,
                        cat_user_cuestionario.description,
                        user_cuest_otro_archivo.created_at,
                        DATE_FORMAT(user_cuest_otro_archivo.created_at, '%h:%i %p') AS hora,
                        user_cuest_otro_archivo.value,
                        user_cuest_otro_archivo.user_id AS user_id_paciente,
                        user_cuest_otro_archivo.coments,
                        user_cuest_otro_archivo.user_id_medico,
                        CONCAT(
                            CASE
                                WHEN tbl_medico.prefijo IS NOT NULL AND tbl_medico.prefijo != 'null' THEN CONCAT(tbl_medico.prefijo,' ')
                                ELSE ''
                            END,

                            tbl_medico.apellidos,
                            ' ',
                            tbl_medico.nombres
                        ) AS medico,
                         CONCAT(
                            tbl_medico.nacionalidad,
                            ' ',
                            tbl_medico.cedula
                        ) AS medico_cedula,
                        tbl_medico.extension_telefonica,
                        tbl_medico.mpps,
                        tbl_medico.colegio_medico,
                        tbl_medico.firma,
                        tbl_medico.sello,
                        (
                            SELECT GROUP_CONCAT(cat_user_especialidad.description)
                            FROM user_especialidad AS ue
                            JOIN cat_user_especialidad ON ue.cat_user_especialidad_id = cat_user_especialidad.id
                            WHERE ue.user_id = tbl_medico.user_id
                        ) medico_especialidades,
                        CONCAT(
                            tbl_paciente.nombres,
                            ' ',
                            tbl_paciente.apellidos
                        ) AS paciente

                    FROM user_cuest_otro_archivo
                    INNER JOIN user_profile AS tbl_medico ON  user_cuest_otro_archivo.user_id_medico = tbl_medico.user_id
                    INNER JOIN user_profile AS tbl_paciente ON  user_cuest_otro_archivo.user_id = tbl_paciente.user_id
                    INNER JOIN cat_user_cuestionario ON  user_cuest_otro_archivo.cat_user_cuestionario_id = cat_user_cuestionario.id
                    WHERE user_cuest_otro_archivo.user_id = ".$user_id."
                    AND user_cuest_otro_archivo.user_cuest_episodio_id = ".$episodio_id."
                UNION ALL
                    SELECT
                        user_cuest_pendiente.id,
                        'Pendiente' AS description,
                        user_cuest_pendiente.created_at AS created_at_default,
                        DATE_FORMAT(user_cuest_pendiente.created_at, '%h:%i %p') AS hora,
                        user_cuest_pendiente.value,
                        user_cuest_pendiente.user_id AS user_id_paciente,
                        user_cuest_pendiente.coments,
                        user_cuest_pendiente.user_id_medico,
                        CONCAT(
                            CASE
                                WHEN tbl_medico.prefijo IS NOT NULL AND tbl_medico.prefijo != 'null' THEN CONCAT(tbl_medico.prefijo,' ')
                                ELSE ''
                            END,

                            tbl_medico.apellidos,
                            ' ',
                            tbl_medico.nombres
                        ) AS medico,
                         CONCAT(
                            tbl_medico.nacionalidad,
                            ' ',
                            tbl_medico.cedula
                        ) AS medico_cedula,
                        tbl_medico.extension_telefonica,
                        tbl_medico.mpps,
                        tbl_medico.colegio_medico,
                        tbl_medico.firma,
                        tbl_medico.sello,
                        (
                            SELECT GROUP_CONCAT(cat_user_especialidad.description)
                            FROM user_especialidad AS ue
                            JOIN cat_user_especialidad ON ue.cat_user_especialidad_id = cat_user_especialidad.id
                            WHERE ue.user_id = tbl_medico.user_id
                        ) medico_especialidades,
                        CONCAT(
                            tbl_paciente.nombres,
                            ' ',
                            tbl_paciente.apellidos
                        ) AS paciente

                    FROM user_cuest_pendiente
                    INNER JOIN user_profile AS tbl_medico ON  user_cuest_pendiente.user_id_medico = tbl_medico.user_id
                    INNER JOIN user_profile AS tbl_paciente ON  user_cuest_pendiente.user_id = tbl_paciente.user_id
                    WHERE user_cuest_pendiente.user_id = ".$user_id."
                    AND user_cuest_pendiente.active = 1
                    AND user_cuest_pendiente.user_cuest_episodio_id = ".$episodio_id."
                    
                UNION ALL
                    SELECT
                        user_cuest_orden_medica.id,
                        'Orden Médica' AS description,
                        user_cuest_orden_medica.created_at AS created_at_default,
                        DATE_FORMAT(user_cuest_orden_medica.created_at, '%h:%i %p') AS hora,
                        user_cuest_orden_medica.value,
                        user_cuest_orden_medica.user_id AS user_id_paciente,
                        user_cuest_orden_medica.coments,
                        user_cuest_orden_medica.user_id_medico,
                        CONCAT(
                            CASE
                                WHEN tbl_medico.prefijo IS NOT NULL AND tbl_medico.prefijo != 'null' THEN CONCAT(tbl_medico.prefijo,' ')
                                ELSE ''
                            END,

                            tbl_medico.apellidos,
                            ' ',
                            tbl_medico.nombres
                        ) AS medico,
                         CONCAT(
                            tbl_medico.nacionalidad,
                            ' ',
                            tbl_medico.cedula
                        ) AS medico_cedula,
                        tbl_medico.extension_telefonica,
                        tbl_medico.mpps,
                        tbl_medico.colegio_medico,
                        tbl_medico.firma,
                        tbl_medico.sello,
                        (
                            SELECT GROUP_CONCAT(cat_user_especialidad.description)
                            FROM user_especialidad AS ue
                            JOIN cat_user_especialidad ON ue.cat_user_especialidad_id = cat_user_especialidad.id
                            WHERE ue.user_id = tbl_medico.user_id
                        ) medico_especialidades,
                        CONCAT(
                            tbl_paciente.nombres,
                            ' ',
                            tbl_paciente.apellidos
                        ) AS paciente

                    FROM user_cuest_orden_medica
                    INNER JOIN user_profile AS tbl_medico ON  user_cuest_orden_medica.user_id_medico = tbl_medico.user_id
                    INNER JOIN user_profile AS tbl_paciente ON  user_cuest_orden_medica.user_id = tbl_paciente.user_id
                    WHERE user_cuest_orden_medica.user_id = ".$user_id."
                    AND user_cuest_orden_medica.user_cuest_episodio_id = ".$episodio_id."

                ORDER BY created_at DESC

            ",
            [1]);

        return $model;
    }
}
