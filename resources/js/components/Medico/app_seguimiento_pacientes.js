/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("../../bootstrap.js");

window.Vue = require("vue");
import VueTippy, { TippyComponent } from "vue-tippy";
import {
    get,
    is_null,
    fechaHoy,
    horaIntervencion,
    getUbicaciones,
} from "../../helpers/customHelpers.js";

import App from "./App.vue";
import VueRouter from "vue-router";
import { routes } from "./router.js";
import Vue from "vue";
import Vuex from "vuex";

import 'bootstrap-datepicker/dist/css/bootstrap-datepicker.css';

import jQuery from 'jquery';
global.jQuery = jQuery;
global.$ = jQuery;
import 'bootstrap';
import 'bootstrap-datepicker';

Vue.use(VueTippy);
Vue.use(VueRouter);
Vue.component("tippy", TippyComponent);
Vue.use(Vuex);
Vue.config.productionTip = false;
/* let ls = localStorage.getItem("area_siglas");
if (is_null(ls)) {
    localStorage.setItem("area_siglas", "tp");
}
if (is_null(ls)) {
    localStorage.setItem("area_description", "Todos los pacientes");
} */
const store = new Vuex.Store({
    state: {
        loading: false,
        componenteDinamico:{
            is_dismounted:true,
            customComponent: null,
            patient_data: null,
            index: null
        },
        configModal:{
            titleModal:"",
            header:true,
            footer:true,
        },
        editDataPaciente:{},
        historialTrasladosAmbulanciaPaciente:[],
        historialUbicacionesPaciente:[],
        pacientes_datos:[],
        cat_ubicaciones:[],
        selectorAreaName: 'Todos los pacientes',
        areaSiglas: 'tp',
        messageWellcome: userGenero === "m" ? "¡Bienvenido!" : "¡Bienvenida!",
        userData: {
            user_id_medico: userIdMedico,
            userEspecialidad: "Sin Especialidad",
            username: userNombres + " " + userApellidos,
            nombres: userNombres,
            apellidos: userApellidos,
            genero: userGenero,
            prefijo: userPrefijo,
            imagen: userImage,
        },
        menuAreas: [
            {
                group_id: 1,
                area_name: "Todos los pacientes",
                area_description: "Todos los pacientes",
                area_siglas: "tp",
            },
            {
                group_id: 2,
                area_name: "Emergencia",
                area_description: "Emergencia Adulto",
                area_siglas: "ea",
            },
            {
                group_id: 2,
                area_name: "Emergencia",
                area_description: "Emergencia Pediátrica",
                area_siglas: "ep",
            },
            {
                group_id: 3,
                area_name: "Área Quirúrgica",
                area_description: "Área Quirúrgica",
                area_siglas: "aq",
            },
            {
                group_id: 4,
                area_name: "Hospitalización",
                area_description: "Hospitalización corta Estancia Pediátrica",
                area_siglas: "hcep",
            },
            {
                group_id: 4,
                area_name: "Hospitalización",
                area_description: "Hospitalización Piso 2",
                area_siglas: "hp2",
            },
            {
                group_id: 4,
                area_name: "Hospitalización",
                area_description: "Hospitalización Piso 3",
                area_siglas: "hp3",
            },
            {
                group_id: 4,
                area_name: "Hospitalización",
                area_description: "Hospitalización Piso 4",
                area_siglas: "hp4",
            },
            {
                group_id: 4,
                area_name: "Hospitalización",
                area_description: "Hospitalización Piso 5",
                area_siglas: "hp5",
            },
            {
                group_id: 4,
                area_name: "Hospitalización",
                area_description: "Hospitalización Piso 6",
                area_siglas: "hp6",
            },
            {
                group_id: 5,
                area_name: "Unidad de Tratamiento Intensivo",
                area_description: "Unidad de Tratamiento Intensivo Adulto",
                area_siglas: "utia",
            },
            {
                group_id: 5,
                area_name: "Unidad de Tratamiento Intensivo",
                area_description: "Unidad de Tratamiento Intensivo Pediátrico",
                area_siglas: "utip",
            },
            {
                group_id: 5,
                area_name: "Unidad de Tratamiento Intensivo Neonatal",
                area_description: "Unidad de Tratamiento Intensivo Neonatal",
                area_siglas: "utin",
            },
            {
                group_id: 6,
                area_name: "PAD Emergencia Adulto",
                area_description: "PAD Emergencia Adulto",
                area_siglas: "pad_emergencia_adulto",
            },
            {
                group_id: 6,
                area_name: "PAD Emergencia Pediátrica",
                area_description: "PAD Emergencia Pediátrica",
                area_siglas: "pad_emergencia_pediatrica",
            },
            {
                group_id: 6,
                area_name: "PAD Postquirúrgico Ambulatorio",
                area_description: "PAD Postquirúrgico Ambulatorio",
                area_siglas: "pad_postquirurgico_amb",
            },
            {
                group_id: 6,
                area_name: "PAD Postquirúrgico Hospitalización",
                area_description: "PAD Postquirúrgico Hospitalización",
                area_siglas: "pad_postquirurgico_hosp",
            },
            {
                group_id: 6,
                area_name: "PAD Médico",
                area_description: "PAD Médico",
                area_siglas: "pad_medico",
            },
        ],
    },
    mutations: {
        updateProperty(state, form) {
            state[form.fieldName] = form.fieldValue;
        },
        updateDinamicComponent(state, form) {
            state['componenteDinamico'] = {
                is_dismounted: true,
                customComponent: null,
                patient_data: null,
                index: null
            };
            state['componenteDinamico'] = {
                is_dismounted:form.is_dismounted,
                customComponent: form.customComponent,
                patient_data: form.patient_data,
                index: form.index
            };
        },
        updateModalProperty(state, form) {
            state['configModal'] = form;
        },
        updateObjectValue(state, form) {
            return (state[form.formName][form.fieldName] = form.fieldValue);
        },
        updateEpisodio(state, form) {
            return (state["pacientes_datos"][form.index] =
                form.fieldValue);
        },
        /* formRegistroPacienteInterno(state) {
            state.formRegistroPacienteInterno = JSON.parse(
                originalformRegistroPacienteInterno
            );
        }, */
    },
});

const router = new VueRouter({
    mode: "history",
    routes: routes,
});
const app = new Vue({
    el: "#app",
    router: router,
    store,
    render: (h) => h(App),
});
