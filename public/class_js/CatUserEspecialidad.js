import {get,post,fotoTemporal,is_null,reemplaza_imagen} from "../helpers/helpers.js";


export default class CatUserEspecialidad {
    static index(selector) {
        $(selector).html();
    }
    static create() {

    }
    static store() {

    }
    static show(model_id) {
        return get(location.origin+"/cat_user_especialidad/show/" + model_id)
    }
    static update() {

    }
    static destroy() {

    }
    static create_form() {

    }
    static async getIndex() {
        return await get(location.origin+"/cat_user_especialidad/index")
    }
    static menuEspecialidad(selector) {
        $("#messageModal").modal("show")

        CatUserEspecialidad.getIndex2()
        .then(response=>{
            let html = "";
            $.each(response, function (indexInArray, valueOfElement) {

                if (valueOfElement['total_pacientes']>0) {
                    html +=`
                        <a data-id="${valueOfElement['id']}" data-description="${valueOfElement['description']}" class="menu-especialidad cursor-pointer list-group-item list-group-item-action">

                                <img onerror="reemplaza_imagen(this)" src="${location.origin}/image/system/especialidades/${valueOfElement['image']}.svg" style="width:2em;height:2em;">
                                ${valueOfElement['description']} ${valueOfElement['total_pacientes'] > 0 ?'<span class="badge rounded badge-secondary">'+valueOfElement['total_pacientes']+'</span>':''}

                        </a>
                    `;
                }


            });

            $(selector).html(`

                <div class="list-group">
                    <span class="text-primary font-weight-bold menu-pad-title"">
                        Pacientes por Especialidad
                    </span>
                    <div id="menuPatiencare" style="max-height:75vh;overflow:auto;">
                    ${html}
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-3 pr-3 pt-1 pb-1">
                        <button id="regresar"  data-dismiss="modal" aria-label="Close" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
                    </div>
                </div>
            `);
            $(".menu-especialidad").on("click", function() {

                Component.viewByEspecialidad({
                    'especialidad': $(this).data("description"),
                    'cat_especialidad_id': $(this).data("id")
                });
            });

        })

    }
    static async getIndex2(){
        //return await get( location.origin+"/cat_user_especialidad/index2")
        return [
            {
                "id": 1,
                "description": "Alergia, Asma e Inmunología",
                "image": "inmunologia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 2,
                "description": "Anestesiología",
                "image": "anestesiologia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 3,
                "description": "Cardiología",
                "image": "cardiologia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 2
            },
            {
                "id": 4,
                "description": "Cirugía Bucal y Maxilofacial",
                "image": "cirugia_bucal",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 5,
                "description": "Cirugía Cardiovascular",
                "image": "cirugia_cardiovascular",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 6,
                "description": "Cirugía de Columna",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 2
            },
            {
                "id": 7,
                "description": "Cirugía de la Mano",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 2
            },
            {
                "id": 8,
                "description": "Cirugía del  Tórax",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 9,
                "description": "Cirugía Dermatológica",
                "image": "cirugia_dermatologica",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 10,
                "description": "Cirugía General",
                "image": "cirugia_general",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 8
            },
            {
                "id": 11,
                "description": "Cirugía Oncológica",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 3
            },
            {
                "id": 12,
                "description": "Cirugía Pediátrica ",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 13,
                "description": "Cirugía Plástica",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 1
            },
            {
                "id": 14,
                "description": "Clinica del Dolor ",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 15,
                "description": "Coloproctología",
                "image": "coloproctologia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 2
            },
            {
                "id": 65,
                "description": "Comité de control de infecciones",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2022-02-11 21:23:21",
                "updated_at": "2022-02-11 21:23:21",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 16,
                "description": "COVID-19 Adultos",
                "image": "\t\r\ncovid_adulto",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 16
            },
            {
                "id": 17,
                "description": "COVID-19 Pediatría",
                "image": "\t\r\ncovid_pediatrico",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 18,
                "description": "Cuello y Cabeza ",
                "image": "\t\r\ncuello_cabeza",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 19,
                "description": "Dermatología",
                "image": "dermatologia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 20,
                "description": "Dermatopatología",
                "image": "dermopatologia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 21,
                "description": "Endocrinología",
                "image": "endocrinologia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 22,
                "description": "Fisiatria",
                "image": "fisiatria",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 23,
                "description": "Fonoaudiología",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 25,
                "description": "Gastroenterología",
                "image": "gastroenterologia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 8
            },
            {
                "id": 24,
                "description": "Gastroenterología Pediátrica ",
                "image": "gastroenterologia_pediatrica",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 26,
                "description": "Ginecologia Oncologica",
                "image": "ginecologia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 27,
                "description": "Ginecología y Obstetricia",
                "image": "obstetricia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 29,
                "description": "Infectología",
                "image": "infectologia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 6
            },
            {
                "id": 28,
                "description": "Infectología Pediátrica",
                "image": "infectologia_pediatrica",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 62,
                "description": "Innovación",
                "image": "innovacion",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 8
            },
            {
                "id": 61,
                "description": "Medicina de Emergencia",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 30,
                "description": "Medicina General ",
                "image": "medicina_general",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 29
            },
            {
                "id": 31,
                "description": "Medicina Interna ",
                "image": "medicina_interna",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 16
            },
            {
                "id": 32,
                "description": "Medicina Nuclear ",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 63,
                "description": "Médico Intensivista",
                "image": "medico_intensivista",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2021-06-04 14:07:16",
                "updated_at": "2021-06-04 14:07:16",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 34,
                "description": "Nefrología",
                "image": "nefrologia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 33,
                "description": "Nefrología Pediátrica",
                "image": "nefrologia_pediatrica",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 64,
                "description": "Neonatologia",
                "image": "neonatologia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2021-06-04 14:07:16",
                "updated_at": "2021-06-04 14:07:16",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 35,
                "description": "Neumonología",
                "image": "neumonologia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 10
            },
            {
                "id": 36,
                "description": "Neurocirugía",
                "image": "neurocirugia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 9
            },
            {
                "id": 38,
                "description": "Neurología",
                "image": "neurologia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 3
            },
            {
                "id": 37,
                "description": "Neurología Pediatrica",
                "image": "neurologia_pediatrica",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 39,
                "description": "Nutrición y Dietética",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 40,
                "description": "Obstetricia ",
                "image": "obstetricia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 5
            },
            {
                "id": 41,
                "description": "Odontología",
                "image": "odontologia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 43,
                "description": "Odontopediatría",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 42,
                "description": "Odontopediatría y Ortodoncia",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 44,
                "description": "Oftalmología",
                "image": "oftalmologia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 45,
                "description": "Oncología",
                "image": "oncologia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 7
            },
            {
                "id": 46,
                "description": "Orientación Emergencia Adultos ",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 47,
                "description": "Ortopedia Infantil ",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 48,
                "description": "Otorrinolaringología",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 1
            },
            {
                "id": 49,
                "description": "Pediatría",
                "image": "pediatria",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 5
            },
            {
                "id": 50,
                "description": "Prueba del Sistema",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 51,
                "description": "Psicología Clínica",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 52,
                "description": "Psicopedagogía",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 54,
                "description": "Psiquiatría",
                "image": "psiquiatria",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 53,
                "description": "Psiquiatria Infantil ",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 55,
                "description": "Radiología e Imágenes ",
                "image": "radiologia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 56,
                "description": "Radioterapia Oncológica",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 57,
                "description": "Terapia Ocupacional",
                "image": null,
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            },
            {
                "id": 58,
                "description": "Traumatología",
                "image": "traumatologia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 9
            },
            {
                "id": 60,
                "description": "Urología",
                "image": "urologia",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 2
            },
            {
                "id": 59,
                "description": "Urología Pediátrica",
                "image": "urologia_pediatrica",
                "active": "1",
                "user_id_medico": null,
                "created_at": "2020-09-16 03:37:42",
                "updated_at": "2020-09-16 03:37:42",
                "deleted_at": null,
                "total_pacientes": 0
            }
        ]
    }
}
