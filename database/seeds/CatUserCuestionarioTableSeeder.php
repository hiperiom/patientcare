<?php

use Illuminate\Database\Seeder;
use App\Models\CatUserCuestionario;
class CatUserCuestionarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['¿Es usted paciente del CMDLT?', null],
            ['¿Conoce usted algún especialista en la institución?', null],
            ['¿Tiene usted un médico tratante en la institución?', null],
            ['Nombres y Apellidos', 3],
            ['Teléfono de contácto', 3],
            ['Correo Electrónico', 3],
            ['¿Tiene usted un médico tratante en la institución?', null],
            ['Nombres y Apellidos', 7],
            ['Teléfono de contácto', 7],
            ['Correo Electrónico', 7],
            ['¿Has presentado alguno de los siguientes síntomas?', null],
            ['Adenopatias',11],
            ['Altralgia',11],
            ['Anosmia',11],
            ['Asintomático',11],
            ['Cansancio',11],
            ['Cefalea',11],
            ['Diarrea',11],
            ['Disfagia',11],
            ['Disnea',11],
            ['Dolor abdominal',11],
            ['Dolor Toracico',11],
            ['Esplenomegalia',11],
            ['Fatiga',11],
            ['Fiebre',11],
            ['Hemoptisis',11],
            ['Hepatomegalia',11],
            ['Hipo',11],
            ['Mialgia',11],
            ['Nausea',11],
            ['Odinofagia',11],
            ['Perdida del gusto',11],
            ['Rinorrea',11],
            ['Tos Productiva',11],
            ['Tos seca',11],
            ['Otros',11],
            ['¿En qué fecha iniciaron los síntomas?',null],
            ['¿Sufres de alguna de las siguientes condiciones de salud?',null],
            ['Apnea del sueño',38],
            ['Asma',38],
            ['Cáncer',38],
            ['Cardiopatía isquémica',38],
            ['Cirrosis',38],
            ['Diabetes tipo 1',38],
            ['Enfermedad Renal',38],
            ['Enfermedad reumatológica',38],
            ['EPOC',38],
            ['Exfumador',38],
            ['Hepatitis B',38],
            ['Hepatitis C',38],
            ['Hipertensión arterial',38],
            ['Insuficiencia Cardíaca',38],
            ['IRA Tipo 1',38],
            ['IRA Tipo 2',38],
            ['Miocardiopatías',38],
            ['Obesidad',38],
            ['Tabaquismo activo',38],
            ['VIH',38],
            ['Otras',38],
            ['¿Has tenido contácto con alguna persona positiva para Coronavirus COVID-19?',null],
            ['¿Está usted tomando algún medicamento de forma permanente?',null],
            ['¿Es usted alergico?',null],
            ['¿Está usted tomando algún medicamento en este momento?',null],
            ['AINES',63],
            ['Anticoagulación',63],
            ['Anti-hipertensivos',63],
            ['Estatinas',63],
            ['Esteroides Inahalados',63],
            ['Esteroids Sistémicos',63],
            ['Hipoglicemiantes/Insulina',63],
            ['Otros',63],
            ['Peso',null],
            ['Oximetría',null],
            ['FC',null],
            ['Escala de glasgow',null],
            ['Talla',null],
            ['TA (sistólica)',null],
            ['SpO2',null],
            ['SOFA',null],
            ['IMC',null],
            ['TA (diastólica)',null],
            ['FIO2',null],
            ['Grupo sanguineo',null],
            ['Temperatura',null],
            ['FR',null],
            ['SpO2/FIO2',null],
            ['Motivo de la contulta',null],
            ['Enfermedad Actual',null],
            ['Examen físico',null],
            ['Laboratorio',null],
            ['¿Le realizaron prueba PDR?',null],
            ['Fecha',91],
            ['Resultado',91],
            ['Igm',null],
            ['IgG',null],
            ['¿Le realizaron prueba PCR?',null],
            ['Fecha',96],
            ['Resultado',96],
            ['Otras pruebas',null],
            ['Imagenes',null],
            ['Probabilidad diagnóstica',null],
            ['Plan',null],
            ['Oxigenoterapia',null],
            ['Aire Ambiente',103],
            ['BIPAP',103],
            ['Canula Nasal',103],
            ['CNAF',103],
            ['CPAP',103],
            ['Mascara con reservorio',103],
            ['Mascara Simple',103],
            ['VMI',103],
            ['Otros',103],
            ['Normal',100],
            ['Vidrio esmerilado',100],
            ['Consolidación neumónica',100],
            ['Quistes',100],
            ['Patrón empedrado',100],
            ['Mosaico de Perfusión',100],
            ['Neumotórax',100],
            ['Derrame Pleural',100],
            ['Halo invertido',100],
            ['Otro',100],
            ['Resultado',91],
            ['Leucocitos x 1000 /mm3',90],
            ['LINFOCITOS %',90],
            ['Linfocitosx 1000 /mm3',90],
            ['NEUTROFILOS %',90],
            ['HEMOGLOBINA (g/dl)',90],
            ['Plaquetas x 1000',90],
            ['VSG',90],
            ['PCR mg/dl',90],
            ['LDH U/I',90],
            ['Ferritina ng/ml',90],
            ['Procalcitonina (ng/ml)',90],
            ['Glicemia mg/dl',90],
            ['Urea',90],
            ['BUN mg/dl',90],
            ['Creatinina mg/dl',90],
            ['Calcio mg/dl',90],
            ['Fósforo mg/dl',90],
            ['Proteínas totales gr/dl',90],
            ['Albúmina gr/dl',90],
            ['Globulina gr/dl',90],
            ['SGOT U/l',90],
            ['SGPT U/l',90],
            ['Bilirrubina t mg/dl',90],
            ['Biirrubina d mg/dl',90],
            ['Fosfatasa Alcalina U/l',90],
            ['Dímero D mcg/ml',90],
            ['PT C/P',90],
            ['PTT C/P',90],
            ['Ck U/l',90],
            ['CkMb U/l',90],
            ['Troponina ng/ml',90],
            ['Sodio mEq/L',90],
            ['Potasio mEq/L',90],
            ['Cloro mEq/L',90],
            ['pH',90],
            ['PCO2',90],
            ['PO2',90],
            ['SaO2',90],
            ['HCO3',90],
            ['Imagenología torácica',null],
            ['Normal',163],
            ['Vidrio esmerilado',163],
            ['Consolidación neumónica',163],
            ['Quistes',163],
            ['Patrón empedrado',163],
            ['Mosaico de Perfusión',163],
            ['Neumotórax',163],
            ['Derrame Pleural',163],
            ['Halo invertido',163],
            ['Otro',163],
            ['Diabetes tipo 2',38],
            ['Evolución',null],
            ['Observación',null],
            ['Récipe',null],//177
            ['Estudio Diagnóstico',null],//178
            ['¿Se ofreció servicio domiciliario?',null],//179
            ['¿Aceptó el servicio?',null],//180
            ['Fuente de financiamiento',null],//181
            ['Aseguradora',null],//182
            ['Número de Poliza',null],//183
            ['Observaciones',null],//184
            ['Frecuencia Cardíaca',null],//185
            ['Frecuencia Respiratoria',null],//186
            ['Tensión Arterial',null],//187
            ['Glisemia',null],//188
            ['Antecedentes',null],//189
            ['Antecedentes Familiares',null],//190
            ['Fotografías',null],//191
            ['¿Le realizaron prueba Antg?',null],//192
            ['¿Te fue útil el Cuestionario de Riesgo COVID-19?',null],//193












        ];
        foreach ($data as $key => $value) {
            CatUserCuestionario::create(['description' =>$data[$key][0],'parent_cat_user_cuestionario_id' =>$data[$key][1]]);
        }
    }
}
