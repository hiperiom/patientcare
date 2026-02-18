<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SplFileInfo;
use Illuminate\Support\Str;
class UserCuestLaboratorio extends Model
{
    protected $table = "user_cuest_laboratorio";
    protected $fillable = [
        "id",
        "user_id",
        "value",
        "coments",
        "user_id",
        "file_type",
        "user_cita_id",
        "user_id_medico",
        "cat_user_episodio_id",
        "cat_user_cuestionario_id",
        "created_at",
        "user_cuest_episodio_id",
    ];

    static function index_episodio($episodio_id)
    {
        return UserCuestLaboratorio::where('user_cuest_episodio_id',$episodio_id)
        ->select('id', 'value', 'coments', 'file_type','user_id_medico','created_at')
        ->orderBy("id","DESC")
        ->get();
    }

    static function store (Request $request)
    {
        //$episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);

        $nombre = null;
        $extension = null;
        $file = $request->file('file');
        if (!is_null($file)) {
            $aleatotio = Str::random(6);
            $nombre = "lab_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
            if (file_exists('image/user/laboratorio/'.$nombre)) {
                return "archivo existe";
            }
            $file->move('image/user/laboratorio/', $nombre);
            $nombre ='image/user/laboratorio/'. $nombre;
            $extension = $file->getClientOriginalExtension();
            $public_path = public_path();
            $info = new SplFileInfo($file->getClientOriginalName());
        }

                try {


                    $model = new UserCuestLaboratorio();
                    $model->cat_user_cuestionario_id = 90;
                    $model->value = $nombre;
                    $model->file_type = $extension;

                    $episodio_id = DB::table('user_cuest_episodio')
                    ->where("user_id",$request->user_id)
                    ->where("active",1)
                    ->select("id")
                    ->orderBy("id","DESC")
                    ->value('id');
                    $model->user_cuest_episodio_id = $episodio_id;
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



            return UserCuestLaboratorio::show($request->user_id);
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
                    $nombre = "lab_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                    if (file_exists('image/user/laboratorio/'.$nombre)) {
                        return "archivo existe";
                    }
                    $file->move('image/user/laboratorio/', $nombre);
                    $nombre ='image/user/laboratorio/'. $nombre;
                    $extension = $file->getClientOriginalExtension();
                    $public_path = public_path();
                    $info = new SplFileInfo($file->getClientOriginalName());


                    $model = new UserCuestLaboratorio();
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
        $model = UserCuestLaboratorio::find($request->id);
            $model->coments = $request->coments;
            $model->user_id_medico =Auth::id();
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();
            return Response()->json($model);
    }
    static function show($user_id)
    {
        return UserCuestLaboratorio::where("user_id",$user_id)->get();
    }
    static function index_by_cita($user_id)
    {
        return UserCuestLaboratorio::where("user_id",$user_id)->get();
    }
    static function eliminar($id)
    {
        $model = UserCuestLaboratorio::where('id',$id);
        if (!is_null($model->value('value'))) {
            if (file_exists($model->value('value'))) {
                unlink($model->value('value'));
            }
        }
        $user_id = $model->value('user_id');
        $model->delete();
        return Response()->json(UserCuestLaboratorio::show($id));
    }
}
