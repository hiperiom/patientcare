/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../../../bootstrap.js');

window.Vue = require('vue');
import { get, is_null,fechaHoy,getQueryVariable,mesesEnEspanol, is_undefined } from '../../../helpers/customHelpers.js';

import App from './App.vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex';
import {routes} from './router.js'
import Vue from 'vue'

Vue.use(VueRouter)
Vue.use(Vuex)
/* let ls = localStorage.getItem('showMenu')
    if (is_null(ls)) {
        localStorage.setItem('showMenu',"true")
    }
    ls = localStorage.getItem('showMenuRight')
    if (is_null(ls)) {
        localStorage.setItem('showMenuRight',"true")
    }
    ls = localStorage.getItem('maximize')
    if (is_null(ls)) {
        localStorage.setItem('maximize',"false")
    } */
/* let originalIntervencionItem = JSON.stringify({
        description:"",
        cirujano_principal:[],
        ayudante_1:[],
        ayudante_2:[],
        ayudante_3:[],
        anestesiologo:[],
        equipos_especiales:[],
        deleted:false,
    }) */
/* let arrayOriginalIntervencionItem=[]
    arrayOriginalIntervencionItem.push( JSON.parse(originalIntervencionItem) )

let originalFormReservacionQuirofano = JSON.stringify({
    solicitud_id:null,
    nacionalidad:'V',
    cedula:"",
    email:"",
    nombres:"",
    apellidos:"",
    genero:"m",
    fnacimiento:fechaHoy(),
    telefono_movil:"",
    telefono_hogar:"",
    user_id:"",

    area_intervencion:"",
    n_presupuesto:"",
    anestesia_sugerida:"General",
    dias_hospitalizacion:0,
    dias_uti:0,

    n_quirofano:1,
    tipo_reservacion:"Emergencia",
    tipo_cupo:"Quirúrgico",
    h_inicio:horaIntervencion(),
    h_fin:"1",
    destino:null,
    cat_user_ubicacion_id:418,
    fecha_reservacion:fechaHoy(),


    fase_ubicacion:"En espera",
    diagnostico_preoperatorio:"",

    intervencion: arrayOriginalIntervencionItem,

    uploadedFile: [],



}) */

const store = new Vuex.Store({
    state: {
        /* userData: {
            user_id_medico: userIdMedico,
            userEspecialidad:"Sin Especialidad",
            username: userNombres+" "+userApellidos,
            nombres:userNombres,
            apellidos:userApellidos,
            genero: userGenero,
            prefijo: userPrefijo,
            userImage: 'https://placehold.co/100x100',
        }, */
        //messageWellcome: (userGenero === "m") ? '¡Bienvenido!':'¡Bienvenida!',
        //sidebarLeft: "false",
        //catUbicacion:[],
        loading:true,
        //personal_salud:[],
        //pacientes_activos:[],
        relog_dia:null,
        relog_mes:null,
        relog_anio:null,
        relog_hora:"",
    },
    mutations: {
        updateProperty(state,form){
            state[ form.fieldName ] = form.fieldValue;
        },
        updateFormField(state, form) {
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
    store,
    router:router,
    store,
    render:h=>h(App)
});
