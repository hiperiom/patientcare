<?php

use Illuminate\Database\Seeder;
use App\Models\CatUserFamily;
class CatUserFamilyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CatUserFamily::create(['description' =>'Abuelo(a)']);
        CatUserFamily::create(['description' =>'Amigo(a)']);
        CatUserFamily::create(['description' =>'Esposo(a)']);
        CatUserFamily::create(['description' =>'Hermano(a)']);
        CatUserFamily::create(['description' =>'Hijo(a)']);
        CatUserFamily::create(['description' =>'Madre']);
        CatUserFamily::create(['description' =>'Padre']);
        CatUserFamily::create(['description' =>'Pareja']);
        CatUserFamily::create(['description' =>'Sobrino(a)']);

    }
}
