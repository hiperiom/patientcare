<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SplFileInfo;
use Illuminate\Support\Str;

class UserCuestTac extends Model
{
    protected $table = "user_cuest_tac";

    static function index_episodio($episodio_id)
    {
        return UserCuestTac::where('user_cuest_episodio_id',$episodio_id)
        ->select('id', 'CAT_USER_CUESTIONARIO_ID', 'VALUE', 'fecha_tac', 'coments', 'file', 'file_type','user_id_medico','created_at')
        ->orderBy("id","DESC")
        ->get();
    }

    protected $fillable = [
        "id",
        "cat_user_cuestionario_id",
        "value",
        "coments",
        "fecha_tac",
        "until",
        "file",
        "file_type",
        "user_cuest_episodio_id",
        "user_id",
        "active",
        "user_id_medico",
        "user_cuest_episodio_id",
        "created_at",
    ];
    static function index($user_id)
    {
        $model_id = Arr::flatten(CatUserCuestionario::where('parent_cat_user_cuestionario_id',100)->select('id')->get()->toArray());
        return UserCuestTac::where('user_cuest_tac.user_id',$user_id)
        ->join("cat_user_cuestionario","user_cuest_tac.cat_user_cuestionario_id","cat_user_cuestionario.id")
        ->leftJoin("user_cuest_episodio","user_cuest_tac.user_cuest_episodio_id","user_cuest_episodio.id")
        ->whereIn('user_cuest_tac.cat_user_cuestionario_id',$model_id)
        ->select(
            "user_cuest_tac.id",
            "cat_user_cuestionario.description AS tac",
            DB::raw('
                CASE
                    WHEN user_cuest_tac.fecha_tac IS NOT NULL THEN DATE_FORMAT(user_cuest_tac.fecha_tac, "%d/%m/%Y")
                    ELSE ""
                END AS since
            '),
            DB::raw('
                CASE
                    WHEN user_cuest_tac.fecha_tac IS NOT NULL THEN DATEDIFF(CURDATE(),user_cuest_tac.fecha_tac)
                    ELSE ""
                END AS dias
            '),
            "user_cuest_tac.created_at AS registro",
            DB::raw('
                CASE
                    WHEN user_cuest_tac.coments IS NOT NULL THEN user_cuest_tac.coments
                    ELSE ""
                END AS observacion
            '),
            DB::raw('
                CASE
                    WHEN user_cuest_tac.user_cuest_episodio_id IS NOT NULL THEN user_cuest_episodio.id
                    ELSE ""
                END AS episodio
            '),
            "user_cuest_tac.file",
            "user_cuest_tac.file_type"
        )
        ->orderBy("user_cuest_tac.created_at","DESC")
        ->get();
    }
    static function store(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);

        //ini_set('memory_limit','488281kib');
        //ini_set('upload_max_filesize', '10M');

        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
        $models = json_decode($request->model);
        $nombre = null;
        $extension = null;
        $file = $request->file('file');
        //dd($request->all());
        if (!is_null($file)) {
            $aleatotio = Str::random(6);
            $nombre = "tac_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
            if (file_exists('image/user/tac/'.$nombre)) {
                return "archivo existe";
            }
            $file->move('image/user/tac/', $nombre);
            $nombre ='/image/user/tac/'. $nombre;
            $extension = $file->getClientOriginalExtension();
            $public_path = public_path();
            $info = new SplFileInfo($file->getClientOriginalName());
        }

        if (count($models) > 0) {
            foreach ($models as $key => $model) {

                $model2 = new UserCuestTac();
                $model2->user_cuest_episodio_id = $episode_id;
                $model2::updateOrCreate([
                    'user_id'   => $request->user_id,
                    'cat_user_cuestionario_id'=>$model->value,
                    'user_cuest_episodio_id' => $episode_id,
                ],[
                    'cat_user_cuestionario_id' => $model->value,
                    'coments' => $request->coments,
                    'file' => $nombre,
                    'file_type' => $extension,
                    'fecha_tac' => date('Y-m-d H:i:s', strtotime($request['since'])),
                    'user_id' => $request->user_id,
                    'user_cuest_episodio_id' => $episode_id,
                    'user_id_medico' => Auth::id(),
                    'created_at' => date('Y-m-d H:i:s', strtotime($request['created_at']))
                ]);

            }
        }else{

            if (!is_null($request->coments)) {
                $model2 = new UserCuestTac();
                $model2->user_cuest_episodio_id = $episode_id;
                $model2->cat_user_cuestionario_id = 122;
                $model2->coments = $request->coments;
                $model2->fecha_tac = date('Y-m-d H:i:s', strtotime($request['since']));
                $model2->user_id = $request->user_id;
                $model2->user_id_medico = Auth::id();
                $model2->user_cuest_episodio_id = $episode_id;
                $model2->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model2->save();
            }
        }

        return UserCuestTac::index($request->user_id);
    }

    static function show(Request $request)
    {
        return UserCuestTac::where("user_id",$request->user_id)->get();
    }
    static function eliminar(Request $request)
    {
        //dd( $request->all());
        $model = UserCuestTac::where('id',$request->id);
        $user_id = $model->value('user_id');
        $model->delete();
        return UserCuestTac::index($user_id);
    }
    static function getActualTac($user_id)
    {
        return  UserCuestTac::where("user_id",$user_id)->where("active",1)->get();

    }
}
