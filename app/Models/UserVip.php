<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserVip extends Model
{
    protected $table = "user_vip";
    protected $fillable = [
        "user_id_paciente",
        "value",
        "user_id_medico",
        "description",
        "user_cuest_episodio_id",
        "created_at",
    ];
    static function store(Request $request)
    {

            //$episodio_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);

            $model = new UserVip();
            $model::updateOrCreate([
                'user_id_paciente'   => $request->user_id_paciente,
                'user_cuest_episodio_id' => $request->episodio_id,
            ],[
                'user_id_paciente' => $request->user_id_paciente,
                'value' => $request->value == 1 ? 0 : 1,
                'description' => $request->description,
                'user_cuest_episodio_id' => $request->episodio_id,
                'user_id_medico' => Auth::id(),
                'created_at' => date('Y-m-d H:i:s')
            ]);


            return UserVip::where("user_id_paciente",$request->user_id_paciente)->where("user_cuest_episodio_id",$request->episodio_id)->first() ;


    }
    static function show($user_id)
    {
        $vip = UserVip::where("user_id_paciente",$user_id)->first();
        return is_null($vip) ? 0 : $vip->value;
    }
}
