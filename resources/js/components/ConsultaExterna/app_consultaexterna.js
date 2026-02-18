/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../../bootstrap.js');

window.Vue = require('vue');

import { get, is_null,  fechaHoy, horaIntervencion } from '../../helpers/customHelpers.js';
import {getAll as CatEstado} from '../Catalogos/CatEstado.js'
import {getAll as CatMunicipio} from '../Catalogos/CatMunicipio.js'
import App from './App.vue'
import VueRouter from 'vue-router'
import {routes} from './router.js'
import Vue from 'vue'
import Vuex from 'vuex';
Vue.use(VueRouter)
Vue.use(Vuex)


let originalformRegistroPacienteInterno = JSON.stringify({
    nacionalidad:'V',
    cedula:"",
    email:"",
    nombres:"",
    apellidos:"",
    genero:"m",
    fnacimiento:fechaHoy(),
    telefono_movil:"",
    telefono_hogar:"",
    cat_estado_id:1,
    cat_municipio_id:1,
    description:"",
    domicilio:"",
    imagen:"/image/user/foto_perfil/doc_id.svg",
    cat_user_ubicacion_id:245,
    ingreso:fechaHoy(),
    formFamiliar:{
        id:"",
        nacionalidad:'V',
        cedula:"",
        email:"",
        nombres:"",
        apellidos:"",
        genero:"m",
        fnacimiento:fechaHoy(),
        telefono_movil:"",
        cat_user_family_id:"",
        user_id :"",
        user_id_familiar :"",
    }

})
const store = new Vuex.Store({
    state: {
        tippyInstances:[],
        loading:false,
        formRegistroPacienteInterno: JSON.parse(originalformRegistroPacienteInterno),
        catEstado: CatEstado(),
        catMunicipio: CatMunicipio(),
        catUbicacion:[],
       
      
        sidebarLeft: "false",
        messageWellcome: "¡Bienvenido!" /* (userGenero === "m") ? '¡Bienvenido!':'¡Bienvenida!' */,
        userData: {
            user_id_medico: "",
            userEspecialidad:"Sin Especialidad",
            username: "Nombre temporal",
            nombres:"Ranses",
            apellidos:"Jimenez",
            genero: "m",
            prefijo: "Dr.",
            userImage: 'https://placehold.co/100x100',
        }

    },
    mutations: {
        updateProperty(state,form){
            state[ form.fieldName ] = form.fieldValue;
        },
        updateObjectValue(state, form) {
            return state[ form.formName ][ form.fieldName ] = form.fieldValue;
        },
        
        

    },
    getters: {
        

    }
});

const router = new VueRouter({
    mode:'history',
    routes:routes
})
const app = new Vue({
    el: '#app',
    router:router,
    store,
    render:h=>h(App)
});
