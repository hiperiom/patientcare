<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use \App\Models\UserCuestUbicacion;
use \App\Models\UserCuestEpisodio;
use Illuminate\Support\Arr;
class CatUserUbicacion extends Model
{
    protected $table = 'cat_user_ubicacion';

    static function index()
    {
        return CatUserUbicacion::whereIn('id', [245, 2, 28, 41, 42, 70, 98, 126, 154, 182, 211, 223, 230, 246, 390,391,237])
            ->orderBy('orden', 'ASC')
            ->get();
    }
    static function show($cat_user_ubicacion_id)
    {
        if (in_array($cat_user_ubicacion_id,[71,235,99,127,234])) {
            $ubicacionesActivas = Arr::flatten(
                UserCuestEpisodio::where('user_cuest_episodio.active',1)
                ->where('user_cuest_episodio.egreso',NULL)
                ->where('user_cuest_ubicacion.active',1)
                ->whereNotIn('user_cuest_ubicacion.cat_user_ubicacion_id',[245,246,247,248,249,250,251])
                ->select('user_cuest_ubicacion.cat_user_ubicacion_id')
                ->join("user_cuest_ubicacion","user_cuest_episodio.id","user_cuest_ubicacion.user_cuest_episodio_id")
                ->get()->toArray()
            );
            //dd($ubicacionesActivas);
            $model = CatUserUbicacion::where('parent_cat_user_ubicacion_id', $cat_user_ubicacion_id)
                ->where('active', 1)
                ->whereNotIn('id',$ubicacionesActivas)
                ->get();
        } else {
            $model = CatUserUbicacion::where('parent_cat_user_ubicacion_id', $cat_user_ubicacion_id)
            ->where('active', 1)
            ->get();
        }



        return $model;
    }
    static function showMenu($cat_user_ubicacion_id)
    {
        return CatUserUbicacion::where('parent_cat_user_ubicacion_id', $cat_user_ubicacion_id)
            ->select('id', 'name', 'description', 'orden', 'route')
            ->where('active', 1)
            ->whereNotIn('id', [317, 277]) //HUC CODICOS
            ->orderBy('orden', 'ASC')
            ->get();
    }

    static function totalCupos($param)
    {
        return CatUserUbicacion::where('parent_cat_user_ubicacion_id', $param)->count();
    }

    public function episodios(){
        return $this->hasMany('App\Models\UserCuestEpisodio','user_cuest_episodio_id','id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id_paciente','id');
    }

}
