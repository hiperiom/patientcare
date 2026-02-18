<?php

use App\Models\UserCuestEpisodio;
use Illuminate\Database\Seeder;

class UserCuestEpisodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 1; $i++) {
            $model = new UserCuestEpisodio();


                $model->ingreso = date('Y-m-d H:i:s');
                $model->user_id = $i;

                $model->created_at = date('Y-m-d H:i:s');
                $model->save();
        }


    }
}
