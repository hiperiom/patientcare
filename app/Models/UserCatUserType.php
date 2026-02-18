<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class UserCatUserType extends Model
{
    protected $table = "user_cat_user_type";
    static function store(Request $request)
    {

        try {

            $model = new UserCatUserType();
            $model->user_id = $request->user_id;
            $model->cat_user_type_id = $request->cat_user_type_id;
            $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
            $model->save();
            return true;
        } catch (\Throwable $th) {
            return $th->errorInfo[2];
            //throw $th;
        }

    }
}
