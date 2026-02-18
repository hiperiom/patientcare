<?php

use Illuminate\Database\Seeder;
use App\Models\CatEspecialidad;
class CatEspecialidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Cardiología',
            'Alergia, Asma e Inmunología',
            'Anestesiología',
            'Cardiología',
            'Cirugía Bucal y Maxilofacial',
            'Cirugía Cardiovascular',
            'Cirugía de Columna',
            'Cirugía de la Mano',
            'Cirugía del  Tórax',
            'Cirugía Dermatológica',
            'Cirugía General',
            'Cirugía Oncológica',
            'Cirugía Pediátrica ',
            'Cirugía Plástica',
            'Clinica del Dolor ',
            'Coloproctología',
            'COVID-19 Adultos',
            'COVID-19 Pediatría',
            'Cuello y Cabeza ',
            'Dermatología',
            'Dermatopatología',
            'Endocrinología',
            'Fisiatria',
            'Fonoaudiología',
            'Gastroenterología Pediátrica ',
            'Gastroenterología',
            'Ginecología Oncologica',
            'Ginecología y Obstetricia',
            'Infectología Pediátrica',
            'Infectología',
            'Medicina General ',
            'Medicina Interna ',
            'Medicina Nuclear ',
            'Nefrología Pediátrica',
            'Nefrología',
            'Neumonología',
            'Neurocirugía',
            'Neurología Pediatrica',
            'Neurología',
            'Nutrición y Dietética',
            'Obstetricia ',
            'Odontología',
            'Odontopediatría y Ortodoncia',
            'Odontopediatría',
            'Oftalmología',
            'Oncología',
            'Orientación Emergencia Adultos ',
            'Ortopedia Infantil ',
            'Otorrinolaringología',
            'Pediatría',
            'Prueba del Sistema',
            'Psicología Clínica',
            'Psicopedagogía',
            'Psiquiatria Infantil ',
            'Psiquiatría',
            'Radiología e Imágenes ',
            'Radioterapia Oncológica',
            'Terapia Ocupacional',
            'Traumatología',
            'Urología Pediátrica',
            'Urología',
            'Medicina de Emergencia',
            'Innovación',
            'Medico Intensivista',
            'Neonatología',
            "Comité de control de infecciones",
            "Unidad de Rodilla",
            'Sin Especialidad',
            "Endodoncia",
            "Ecosonografia",
            "Inmunología",
            "Odontología general y pediátrica",
            'Psicología Infantil y de Adultos',
            'Mastología',
            'Cirugía Plástica Reconstructiva',
            'Pediatría y Neonatología',
            'Fisioterapia',
           
    
        ];
        for ($i=0; $i < count($data); $i++) {
            CatEspecialidad::create(['description' =>$data[$i]]);
        }
    }
}
