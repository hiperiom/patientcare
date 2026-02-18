<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserCuestMedicoPaciente extends Model
{
    protected $table = "user_cuest_medico_paciente";
    protected $fillable = [
        'id',
        "user_id",
        "user_id_medico",
        "cargo",
        "cat_user_medico_posicion_id",
        "user_cuest_episodio_id",
        "created_at",
    ];

    static function index_episodio($episodio_id)
    {
        return UserCuestMedicoPaciente::where('user_cuest_episodio_id',$episodio_id)
        ->select('id', 'cat_user_medico_posicion_id', 'user_id', 'user_id_medico','user_id_medico','created_at')
        ->orderBy("id","DESC")
        ->get();
    }

    static function store(Request $request)
    {
        //dd($request->all());
       // $medico_cargo = UserMedicoPosicion::show($request->user_id_medico);

        //dd($medico_cargo->cat_user_medico_posicion_id);
        $episodio_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id_paciente);

        if (is_null($episodio_id)) {
            $request->merge(['value'=>'Ingreso']);
            $request->merge(['user_id'=>$request->user_id_paciente]);
            UserCuestEpisodio::store($request);
            $episodio_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
            //dd($episodio_id);
        }
        //desactivar todos los medicos que pertenezcan al episodio actual

        UserCuestMedicoPaciente::where("user_id",$request->user_id_paciente)
            ->whereNotIn("user_cuest_episodio_id",[$episodio_id])
            ->where("cat_user_medico_posicion_id",$request->position_id)
            ->where("active",1)
            ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);
        //dd($request->all());



            $model = new UserCuestMedicoPaciente();
            $model::updateOrCreate([
                'user_id'   => $request->user_id_paciente,
                'user_id_medico'   => $request->user_id_medico,
                'user_cuest_episodio_id'   => $episodio_id,
                'cat_user_medico_posicion_id'   => $request->position_id
            ],[
                'user_id'   => $request->user_id_paciente,
                'user_id_medico'   => $request->user_id_medico,
                'user_cuest_episodio_id'   => $episodio_id,
                'cat_user_medico_posicion_id'   => $request->position_id,
                "created_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))
            ]);

        return UserCuestMedicoPaciente::show($request->user_id_paciente);
    }
    static function show($user_id)
    {

        $episodio_id = UserCuestEpisodio::ultimoEpisodio_id($user_id);

        return UserCuestMedicoPaciente::where("user_cuest_medico_paciente.user_id",$user_id)
                //->where("user_cuest_medico_paciente.cat_user_medico_posicion_id",$tipo_medico)
                ->where("user_cuest_medico_paciente.user_cuest_episodio_id",$episodio_id)

                ->join("cat_user_medico_posicion","user_cuest_medico_paciente.cat_user_medico_posicion_id","cat_user_medico_posicion.id")
                ->join("user_profile","user_cuest_medico_paciente.user_id_medico","user_profile.user_id")
                //->join("user_especialidad","user_profile.user_id","user_especialidad.user_id")
                //->join("cat_user_especialidad","user_especialidad.cat_user_especialidad_id","cat_user_especialidad.id")

                ->select(

                    DB::raw("
                        CONCAT(
                            CASE
                                WHEN user_profile.prefijo IS NOT NULL AND user_profile.prefijo != 'null' THEN CONCAT(user_profile.prefijo,' ')
                                ELSE ''
                            END,

                            user_profile.apellidos,
                            ' ',
                            user_profile.nombres
                        ) AS medico
                    "),
                    DB::raw("
                        CASE WHEN cat_user_medico_posicion.id = 1 THEN 'success'
                            WHEN cat_user_medico_posicion.id = 2 THEN 'info'
                            WHEN cat_user_medico_posicion.id IN (3,4) THEN 'orange'
                            WHEN cat_user_medico_posicion.id IN (5,6,7,8) THEN 'secondary'
                            WHEN cat_user_medico_posicion.id = 9 THEN 'purple'
                            WHEN cat_user_medico_posicion.id = 10 THEN 'warning'
                            ELSE 'default'
                        END AS tagColor
                    "),
                    "user_profile.extension_telefonica",
                    "user_profile.imagen AS medico_img",
                    DB::raw("
                        (
                            SELECT GROUP_CONCAT(cat_user_especialidad.description SEPARATOR ', ') AS especialidad
                            FROM user_especialidad 
                            JOIN cat_user_especialidad ON user_especialidad.cat_user_especialidad_id = cat_user_especialidad.id
                            WHERE user_especialidad.user_id = user_profile.user_id
                        ) AS especialidad
                    "),
                    DB::raw("
                        (
                            SELECT cat_user_especialidad.id AS especialidad_id
                            FROM user_especialidad 
                            JOIN cat_user_especialidad ON user_especialidad.cat_user_especialidad_id = cat_user_especialidad.id
                            WHERE user_especialidad.user_id = user_profile.user_id
                            LIMIT 1
                        ) AS especialidad_id
                    "),
                    //"cat_user_especialidad.id AS especialidad_id",
                    //"cat_user_especialidad.description AS especialidad",
                    "user_profile.telefono_movil",
                    "cat_user_medico_posicion.id AS user_cuest_medico_posicion_id",
                    "cat_user_medico_posicion.description AS posicion",
                    "user_cuest_medico_paciente.id AS medico_paciente_id",
                    "user_cuest_medico_paciente.*"
                )
                ->orderBy("user_cuest_medico_paciente.created_at", "DESC")
                ->get();
    }
    static function show2($user_id,$tipo_medico)
    {
        $episodio_id = UserCuestEpisodio::ultimoEpisodio_id($user_id);
        return DB::select("
            SELECT
                GROUP_CONCAT(med_pac.user_id_medico) as grupo
            FROM user_cuest_medico_paciente AS med_pac
            WHERE med_pac.user_id = ".$user_id."
            AND med_pac.cat_user_medico_posicion_id = ".$tipo_medico."
            AND med_pac.user_cuest_episodio_id = ".$episodio_id."
        ", [1]);
    }

    static function fixed_medico_paciente(Request $request)
    {
        //FUNCION ESPECIAL PARA LOS MEDICOS TRATANTES ACTUALES QUE NO TIENEN EPISODIO ACTUAL
        //dump($request->all());


        //actualizar el episodio
        UserCuestMedicoPaciente::where('cat_user_medico_posicion_id', 1)
            ->where('user_id',$request->user_id_paciente)
            ->where('user_cuest_episodio_id',NULL)
            ->where("active",1)
            ->update([
                'user_cuest_episodio_id'=>$request->user_cuest_episodio_id
            ]);

        //selecciona pacientes con episodio
        $model = UserCuestMedicoPaciente::where('user_id',$request->user_id_paciente)
                ->where('cat_user_medico_posicion_id', 1)
                ->where("user_cuest_episodio_id",$request->user_cuest_episodio_id)
                ->get();

        foreach($model as $value){
            //dd($value->all());
            //dump($value);
            $r = new Request([
                'cat_user_medico_posicion_id'=>$value->cat_user_medico_posicion_id,
                'user_id_medico'=>$value->user_id_medico,
                'created_at'=>$request->created_at
            ]);
            UserMedicoPosicion::store($r);
        }
        return UserCuestMedicoPaciente::show2($request->user_id_paciente,1);
    }
    static function eliminar(Request $request)
    {
        $episodio_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id_paciente);

        $model =  UserCuestMedicoPaciente::where('user_id_medico',$request->user_id_medico)
                ->where('user_cuest_episodio_id',$episodio_id);

        $user_id = $model->value('user_id');
        $cat_user_medico_posicion_id = $model->value('cat_user_medico_posicion_id');

        $model->delete();

        $model =  UserCuestMedicoPaciente::where('user_id',$request->user_id_paciente)
                ->where('cat_user_medico_posicion_id',$cat_user_medico_posicion_id)
                ->where('user_cuest_episodio_id',$episodio_id)
                ->get();
        return $model;
    }
    static function eliminarById(Request $request)
    {

        //dd($request->id);
        $model =  UserCuestMedicoPaciente::where('id',$request->id);

        $user_id = $model->value('user_id');
        $model->delete();
        /*
        $episodio_id = UserCuestEpisodio::ultimoEpisodio_id($user_id);

        $model =  UserCuestMedicoPaciente::where('user_id',$user_id)
                ->where('user_cuest_episodio_id',$episodio_id)
                ->get();*/
        return UserCuestMedicoPaciente::show($user_id);
    }
}
