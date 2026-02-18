<?php

namespace App\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SplFileInfo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class UserProfileImages extends Model
{
    protected $table = "user_profile_images";
    protected $fillable = [
        "id",
        "value",
        "user_id_medico",
        "user_id_paciente",
        "cita_id",
        "coments",
        "user_cuest_episodio_id",
        "created_at",
        "active",
        "file_type"
    ];
    // static function store(Request $request)
    // {


    //     $nombre = null;
    //     $extension = null;


    //     foreach ($request->file() as $key => $file) {

    //         if ($key != "imagen") {

    //             $aleatotio = Str::random(6);
    //             $nombre = "upi_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
    //             $dir = "image/user/userProfileImage/";
    //             if (file_exists( $dir.$nombre)) {
    //                 return "archivo existe";
    //             }
    //             $file->move( $dir, $nombre);
    //             $nombre = $dir. $nombre;
    //             $extension = $file->getClientOriginalExtension();
    //             $public_path = public_path();
    //             $info = new SplFileInfo($file->getClientOriginalName());

    //             try {

    //                 $model = new UserProfileImages();
    //                 $model->value = $nombre;
    //                 $model->user_id_paciente = $request->user_id_paciente;
    //                 $model->file_type = $extension;
    //                 $model->coments = $key;
    //                 $model->user_id_medico = Auth::id();
    //                 $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
    //                 $model->save();


    //             } catch (\Throwable $th) {
    //                 dd( $th->errorInfo[2]);
    //             }
    //         }
    //     }
    //     return Response()->json(true);
    // }

    static function store(Request $request)
    {


        $nombre = null;
        $extension = null;
        //dd( $request->file() );

        foreach ($request->file() as $key => $file) {

            if ($key != "imagen") {
                if (!is_null($file)) {

                   if (
                        $key == "partidaNacimiento" ||
                        $key == "imgSoyChacao" ||
                        $key == "imgDocIdentidad"


                    ) {

                        $aleatotio = Str::random(6);
                        $nombre = "upi_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                        $dir = "/image/user/userProfileImage/";
                        if (file_exists( $dir.$nombre)) {
                            return "archivo existe";
                        }
                        $file->move( "image/user/userProfileImage/", $nombre);
                        $nombre = $dir. $nombre;
                        $extension = $file->getClientOriginalExtension();
                        $public_path = public_path();
                        $info = new SplFileInfo($file->getClientOriginalName());

                        try {
                            $user_type = UserProfileImages::updateOrCreate(
                                [
                                    'user_id_paciente'   => $request->user_id,
                                    'coments'     => $key,
                                ],
                                [
                                    'value'     => $nombre,
                                    'user_id_paciente'     => $request->user_id,
                                    'file_type'     => $extension,
                                    'coments'     => $key,
                                    'user_id_medico'     => Auth::id(),
                                    'created_at'     => date('Y-m-d H:i:s', strtotime($request['created_at']) ),
                                ]
                            );
                            //dump($user_type);

                        } catch (\Throwable $th) {
                            dd($file);
                            dd( $th->errorInfo[2]);
                        }
                    }
                }
            }
        }
        return Response()->json(true);
    }
    static function update_item_file(Request $request,$type){
        //dd($request);
        $nombre ="/image/system/patient.svg";
        $file = $request->file( "value" );
        $field = $request->field;
        if (!is_null($file)) {

            $aleatotio = Str::random(6);

            $nombre = "upi_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
            if (file_exists('/image/user/userProfileImage/'.$nombre)) {
                return "imagen existe";
            }
            $file->move('image/user/userProfileImage/', $nombre);
            $nombre ='/image/user/userProfileImage/'. $nombre;
            $extension = $file->getClientOriginalExtension();



            $public_path = public_path();
            $info = new SplFileInfo($file->getClientOriginalName());
        }


        $model = UserProfileImages::updateOrCreate(
            [
                'user_id_paciente'   => $request->user_id,
                'coments'     => $type,
            ],
            [
                'value'     => $nombre,
                'user_id_paciente'     => $request->user_id,
                'file_type'     => $extension,
                'coments'     => $type,
                //'user_id_medico'     => Auth::id(),
                //'created_at'     => date('Y-m-d H:i:s', strtotime($request['created_at']) ),
            ]
        );




        return $model;

    }
}
