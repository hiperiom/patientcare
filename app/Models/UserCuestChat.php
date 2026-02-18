<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SplFileInfo;
use Illuminate\Support\Facades\Auth;
class UserCuestChat extends Model
{
    protected $table = "user_cuest_chat";

    static function store(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id_paciente);
        $nombres_files = [];
        if($request->cant_files > 0){
            for ($i=0; $i < $request->cant_files; $i++) {
                $file = $request->file('files')[$i];
                $aleatotio = str_random(6);
                $nombre = "cP_".$aleatotio. $request->user_id_paciente . '-' . $file->getClientOriginalName();
                if (file_exists('image/user/chatPaciente/'.$nombre)) {
                    return "imagen existe";
                }
                $file->move('image/user/chatPaciente/', $nombre);
                $public_path = public_path();
                $info = new SplFileInfo($file->getClientOriginalName());
                $nombres_files[$i] = $nombre;
            }

        }
        $model                   = new UserCuestChat();
        $model->user_id_paciente = $request->user_id_paciente;
        $model->user_id_medico   = Auth::id();
        $model->chat_con          = $request->chat_con;
        $model->message          = str_replace("\n","&#013; &#010",$request->chat_mensaje);
        $model->coments          = str_replace("\n","&#013; &#010",$request->chat_observacion);
        $model->user_cuest_episodio_id = $episode_id;
        if ($request->files!="undefined") {
            $model->image      = utf8_encode(json_encode($nombres_files));
        }
        $model->created_at       = date('Y-m-d H:i:s', strtotime($request['created_at']));
        $model->save();




        return "true";

    }
    static function getChat(Request $request)
    {
        $episodio_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id_paciente);
        return UserCuestChat::where("user_id_paciente",$request->user_id_paciente)
            ->join("user_profile","user_cuest_chat.user_id_medico","user_profile.user_id")
            ->select(
                "user_cuest_chat.id",
                "user_cuest_chat.chat_con",
                DB::raw('CONCAT(user_profile.nombres, " ", user_profile.apellidos) AS medico'),
                DB::raw('TRIM(user_cuest_chat.message) AS message'),

                "user_cuest_chat.image",
                "user_cuest_chat.coments",
                "user_cuest_chat.created_at"

            )
            ->where("user_cuest_chat.user_cuest_episodio_id",$episodio_id)
            ->orderBy("user_cuest_chat.created_at","DESC")
            ->get();
    }
    static function index_episodio($episodio_id)
    {
        return UserCuestChat::where('user_cuest_episodio_id',$episodio_id)
        //->select('id', 'description', 'coment', 'cod_cie', 'cod_cie_description','user_id_medico','created_at')
        ->orderBy("id","DESC")
        ->get();
    }
}
