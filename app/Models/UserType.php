<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserType extends Model
{
    protected $table = "user_type";
    protected $fillable = [
        "user_id","cat_user_type_id","created_at","user_id_medico","deleted_at",
    ];
    static function store(Request $request)
    {



            //$model = new UserType();
            $model=UserType::updateOrCreate([
                'user_id'   => $request->user_id,
                'cat_user_type_id' => 1,
            ],[
                'user_id' => $request->user_id,
                'cat_user_type_id' => 1,
                'user_id_medico' => Auth::id(),
                'created_at' => date('Y-m-d H:i:s', strtotime($request['created_at']))
            ]);

            $model=UserType::updateOrCreate([
                'user_id'   => $request->user_id,
                'cat_user_type_id' => 2,
            ],[
                'user_id' => $request->user_id,
                'cat_user_type_id' => 2,
                'user_id_medico' => Auth::id(),
                'created_at' => date('Y-m-d H:i:s', strtotime($request['created_at']))
            ]);
            return UserType::show($request);


    }
    static function show(Request $request)
    {
        return UserType::where("user_id",$request->user_id)->where("cat_user_type_id",$request->cat_user_type_id)->first();
    }
     //relationships
    /* public function description()
    {
        //roles del usuario
        return $this->hasOne('App\Models\CatUserType', 'cat_user_type_id', 'id');
    } */
    public function type()
    {
        return $this->belongsTo('App\Models\CatUserType', 'cat_user_type_id', 'id');
    }
    

}
