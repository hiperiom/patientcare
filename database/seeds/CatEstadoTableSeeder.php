<?php

use Illuminate\Database\Seeder;
use App\Models\CatEstado;


class CatEstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Amazonas',
            'Anzoategui',
            'Apure',
            'Aragua',
            'Barinas',
            'Bolívar',
            'Carabobo',
            'Cojedes',
            'Delta Amacuro',
            'Falcón',
            'Guárico',
            'Lara',
            'Mérida',
            'Miranda',
            'Monagas',
            'Nueva Esparta',
            'Portuguesa',
            'Sucre',
            'Táchira',
            'Trujillo',
            'Yaracuy',
            'Zulia',
            'Dependencias Federales',
            'Distrito Capital',
            'La Guaira'
        ];
        for ($i=0; $i < count($data); $i++) {
            CatEstado::create(['description' =>$data[$i]]);
        }
    }
}
