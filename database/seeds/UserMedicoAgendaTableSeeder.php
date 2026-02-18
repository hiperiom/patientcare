<?php

use Illuminate\Database\Seeder;
use App\Models\UserMedicoAgenda;
class UserMedicoAgendaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medicos = DB::table("user")
            ->join("user_type","user.id","user_type.user_id")
            ->join("user_especialidad","user.id","user_especialidad.user_id")
            ->where("user_type.cat_user_type_id",2)
            ->select("user.id","user_especialidad.cat_user_especialidad_id")
            ->get();
        
        foreach ($medicos as $key => $value) {
            $agenda = [];
            $model = new UserMedicoAgenda();
            for ($i=0; $i <= 11 ; $i++) { 


                $agenda[] = [
                    "mes_numero"=>$i+1,
                    "mes_nombre"=>date("F"),
                    "horario"=>
                    [
                        [
                            "dia_semana"=>3,
                            "dia_nombre"=> "No Indicado",
                            "horas"=>["13:00","14:00","15:00","16:00"]
                        ],
                        [
                            "dia_semana"=>3,
                            "dia_nombre"=> "No Indicado",
                            "horas"=>["13:00","14:00","15:00","16:00"]
                        ],
                    ]
                ];  
            }
            
            $model->agenda = json_encode( $agenda );
            $model->agenda_year = date("Y");
            $model->cat_especialidad_id = $value->cat_user_especialidad_id;
            $model->user_id_medico = $value->id;

            $model->save();
        }
        
    }
}
