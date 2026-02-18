<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SplFileInfo;

class UserCuestFotografia extends Model
{
    protected $table = "user_cuest_fotografia";
    protected $fillable = [
        "id",
        "user_id",
        "value",
        "coments",
        "user_id",
        "file_type",
        "user_id_medico",
        "user_cuest_episodio_id",
        "cat_user_cuestionario_id",
        "created_at",
    ];
    static function index_episodio($episodio_id)
    {
        return UserCuestFotografia::where('user_cuest_episodio_id',$episodio_id)
        ->where("cat_user_cuestionario_id",191)
        ->select('id', 'value', 'coments', 'file_type','user_id_medico','created_at')
        ->orderBy("id","DESC")
        ->get();
    }
    static function store (Request $request)
    {
        /* $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id); */

        $nombre = null;
        $extension = null;
        $file = $request->file('file');
        if (!is_null($file)) {
            $aleatotio = Str::random(6);
            $nombre = "img_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
            if (file_exists('image/user/fotografia/'.$nombre)) {
                return "archivo existe";
            }
            $file->move('image/user/fotografia/', $nombre);
            $nombre ='image/user/fotografia/'. $nombre;
            $extension = $file->getClientOriginalExtension();
            $public_path = public_path();
            $info = new SplFileInfo($file->getClientOriginalName());
        }

                try {


                    $model = new UserCuestFotografia();
                    $model->cat_user_cuestionario_id = 191;
                    $model->value = $nombre;
                    $model->file_type = $extension;
                    // inicio de descomentado ya que en salud chacao está así (verificar que no falle acá)
                    $episodio_id = DB::table('user_cuest_episodio')
                        ->where("user_id",$request->user_id)
                        ->where("active",1)
                        ->select("id")
                        ->orderBy("id","DESC")
                        ->value('id');
                    if($episodio_id != null){
                        $model->user_cuest_episodio_id = $episodio_id;
                    }else{
                        $model->user_cuest_episodio_id = $request->episodio_id;
                    }
                    // Fin de descomentado
                    // $model->user_cuest_episodio_id = $request->episodio_id;
                    $model->coments = $request->coments;
                    $model->user_id = $request->user_id;
                    $model->user_id_medico = Auth::id();
                    $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                    $model->save();
                    return $model;
                } catch (\Throwable $th) {
                    return $th->errorInfo[2];
                }



            return Response()->json(UserCuestFotografia::show($request->user_id));
    }
    static function store_cita (Request $request)
    {
        //dd($request);

        $nombre = null;
        $extension = null;
        //$file = $request->file('files');
        $response =[];
        try {
            //if (!is_null($file)) {
                //foreach ($request->file() as $key => $file) {

                for ($i=0; $i < $request->total_archivos ; $i++) {

                    $file = $request->file('file_'.$i);
                    $aleatotio = Str::random(6);
                    $nombre = "img_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                    if (file_exists('image/user/fotografia/'.$nombre)) {
                        return "archivo existe";
                    }
                    $file->move('image/user/fotografia/', $nombre);
                    $nombre ='image/user/fotografia/'. $nombre;
                    $extension = $file->getClientOriginalExtension();
                    $public_path = public_path();
                    $info = new SplFileInfo($file->getClientOriginalName());


                    $model = new UserCuestFotografia();
                    $model->user_cita_id = $request->user_cita_id;
                    $model->cat_user_cuestionario_id = 90;
                    $model->value = $nombre;
                    $model->file_type = $extension;
                    $model->coments = $request->coments;
                    $model->user_id = $request->user_id;
                    $model->user_id_medico = Auth::id();
                    $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                    $model->save();

                    $response[$i] = $model;
                }
                //}
            //}
            return Response()->json($response);
        } catch (\Throwable $th) {
            dd( $th);
        }


    }
    static function actualizar(Request $request)
    {
        $model = UserCuestFotografia::find($request->id);
            $model->coments = $request->coments;
            $model->user_id_medico =Auth::id();
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();
            return Response()->json($model);
    }
    static function show($user_id)
    {
        return UserCuestFotografia::where("user_id",$user_id)->get();
    }
    static function index_by_cita($user_id)
    {
        return UserCuestFotografia::where("user_id",$user_id)->get();
    }
    static function eliminar($id)
    {
        $model = UserCuestFotografia::where('id',$id);
        if (!is_null($model->value('value'))) {
            if (file_exists($model->value('value'))) {
                unlink($model->value('value'));
            }
        }
        $user_id = $model->value('user_id');
        $model->delete();
        return Response()->json(UserCuestFotografia::show($id));
    }
}
