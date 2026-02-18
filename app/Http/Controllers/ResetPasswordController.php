<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\MessageReceived;
use App\Mail\PasswordReset;
use App\Mail\PasswordActualizado;
use App\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Crypt;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    protected function resetPassword(Request $request)
    {
        $status = false;
        $response = [];
        $user = User::where("email",$request->email)->first();

        if(is_null($user)){
            $status = "data_not_found";
        }else{
            $status = true;
            $password = rand(6,999999);
            $user->password = $password;
            $user->save();

            $email = $user->email;
            $message = $password;
            $response['token'] = $password;


            try {
                //Mail::to("hiperiom412@gmail.com")->queue(new MessageReceived(['email'=>$email,'message'=>$message]));
                Mail::to($email)->queue(new MessageReceived(['email'=>$email,'message'=>$message]));
            } catch (\Exception $e) {
                $status = "error_send_email";
            }
        }

        return [
            "status"=>$status,
            "data"=>$response,
            "email"=>$request->email,
            "token"=>$password
        ];
    }

    protected function resetPasswordConfirm(Request $request)
    {


        $status = false;
        $response = [];
        $user = User::where("password",$request->password_token)->where("email",$request->email)->first();
        $email = $request->email;
        $message = $request->password;
        if(is_null($user)){
           $status = "token_not_found";
        }else{
            $status = true;
            $user->password = $request->password;
            $user->save();
            try {
               // new PasswordReset($user);
            } catch (\Exception $e) {
                //dd($e);
            }
        }
        try {
                //Mail::to("hiperiom412@gmail.com")->queue(new PasswordActualizado(['email'=>$email,'message'=>$message]));
                //Mail::to($email)->queue(new PasswordActualizado(['email'=>$email,'message'=>$message]));
        } catch (\Exception $e) {
            //dd($e);
            $status = "error_send_email";
        }
        return [
            "status"=>$status,
            "data"=>$message,
            "email"=>$request->email,

        ];
        //return ["status"=>$status,"data"=>$response];
    }
    protected function resetPasswordAtencionPaciente($cedula)
    {

        $response = [];
        $email = NULL;
        $password = 123456;
        $model = UserProfile::where("cedula",$cedula)->orderBy("id","DESC")->get()->take(1);
        if(count($model)==0){
            return Response()->json("cedula_no_encontrada");
        }else{
            $model = User::where("id",$model[0]->user_id)->first();
            $email = $model->email;
            $model->password = $password;
            $model->save();
            try {
                Mail::to("hiperiom412@gmail.com")->queue(new PasswordActualizado(['email'=>$email,'message'=>"Viene de ResetPasswordController -> resetPasswordAtencionPAciente($cedula)"]));
                // Mail::to("hiperiom412@gmail.com")->queue(new PasswordActualizado(['email'=>$email,'message'=>$message]));
                //Mail::to($email)->queue(new PasswordActualizado(['email'=>$email,'message'=>$password]));
            } catch (\Exception $e) {
                //dd($e);
            }
        }

        return Response()->json("cedula_restablecida");
    }
}
