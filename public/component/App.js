
import {

} from '../helpers/helpers.js'
import {get_default_grupo_salud_id as grupo_salud_id} from './catalogs/cat_grupo_centro_salud.js'
import {} from './catalogs/cat_centro_salud.js'
import {renderHtml as PacienteRecipe} from './paciente/user_recipe_hospitalizacion.js'
import {init as PacienteHome} from './user/user_home.js'
import {init as MedicoHome} from './medico/medico_home.js'
import * as ComponentMedico from './medico/medico.js'
import * as ComponentAdmin from './admin/admin.js'
import {renderHtml as PacienteEstudioDiagnostico} from './paciente/user_estudio_diagnostico.js'
import {step_1 as PageLogin, mensajeInicioLogin } from './user/login.js'
import { configPage as configPageResetPassword } from "./user/user_reset_password.js"
import { configPage as configPageUserCreate } from "./user/user_create.js"
import {
    configPage as configPageCreate,
    configPageEdit as PacienteEdit,
    user_edit as mi_informacion,
    emergencia_pacienteSearch as PacienteSearch,
    createInternoEmergencia,
    get_id,
} from './user/user_create.js'


let d = document;
let route = location.pathname;
//console.log(route)
    switch (route) {
        case '/medico':

            d.querySelector('body').addEventListener("click", function(e){

                if (e.target.matches(".card-paciente-edit")) {
                    PacienteEdit(e.target.dataset.user_id_paciente)
                }
                if (e.target.matches(".episodio-recipe")) {
                    PacienteRecipe(e.target.dataset.user_id_paciente)
                }
                if (e.target.matches(".episodio-estudio-diagnostico")) {
                    PacienteEstudioDiagnostico(e.target.dataset.user_id_paciente)
                }
                /* if (e.target.matches(".tablero-administrador")) {
                    ComponentAdmin.index("level_1")
                } */
            })
            d.querySelector('#buscarPaciente').addEventListener("click", function(e){
                PacienteSearch()
            })
            d.addEventListener("DOMContentLoaded",async function(e){


            })
        break;
        case '/consultaexterna/medico/cita/tablero':

            d.addEventListener("DOMContentLoaded",async function(e){

                await MedicoHome()
            })
        break;
        // case '/medico/cita/tablero':
        case '/consultaexterna/medico/tablero':

            d.addEventListener("DOMContentLoaded",async function(e){

                await MedicoHome()
            })
        break;
        case '/medico/create_paciente':
            d.addEventListener("DOMContentLoaded",async function(e){
                await createInternoEmergencia()
            })
        break;
        case '/medico/create':
            ComponentMedico.create_emergencia()
        break;
        case '/medico/create':
            //$("#fullscreen").modal('show')
            //let $App = d.querySelector('#fullscreen .modal-body-2')
            ComponentMedico.create_emergencia()
        break;
        case '/admin/index':
            d.addEventListener("DOMContentLoaded",async function(e){

                //useState['pacientes'] = await get(`${location.origin}/user/profile/getAll`)
                await ComponentAdmin.index({})
            })
            /* setInterval(async() => {
                useState['menu']['data'] = await get("/admin/getDataIndex")
                ComponentAdmin.index({})
            }, 10000); */
        break;
        case '/consultaexterna/admin/reportes':


            d.addEventListener("DOMContentLoaded",async function(e){
                await ComponentAdmin.index_reportes({})
            })

        break;
        case '/paciente/home':
            d.addEventListener("DOMContentLoaded",async function(e){
                //await PacienteHome()
            })
        break;
        case 'administrador':

        break;
        case 'enfermeria':

        break;
        default:
            d.addEventListener("DOMContentLoaded",async function(e){
                d.addEventListener("click",async function(e){
                    if(e.target.matches("#modal_passwordReset")){
                        configPageResetPassword()
                    }
                    if(e.target.matches("#modal_userCreate")){
                        configPageUserCreate()
                    }
                })
                await PageLogin()
                mensajeInicioLogin()
            })
        break;
    }
