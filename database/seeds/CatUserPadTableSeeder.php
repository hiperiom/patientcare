<?php

use Illuminate\Database\Seeder;
use App\Models\CatUserPad;
class CatUserPadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CatUserPad::create(['description' =>'Covid']);
        CatUserPad::create(['description' =>'Cardio']);
        CatUserPad::create(['description' =>'Oncología']);
    }
}
