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
import { getAll as CatEstado } from "../Catalogos/CatEstado.js";
import { getAll as CatMunicipio } from "../Catalogos/CatMunicipio.js";
import App from "./App.vue";
import VueRouter from "vue-router";
import { routes } from "./router.js";
import Vue from "vue";
import Vuex from "vuex";
Vue.use(VueTippy);
Vue.use(VueRouter);
Vue.component("tippy", TippyComponent);
Vue.use(Vuex);
let ls = localStorage.getItem("area_siglas");
if (is_null(ls)) {
    localStorage.setItem("area_siglas", "tp");
}
if (is_null(ls)) {
    localStorage.setItem("area_description", "Todos los pacientes");
}
const store = new Vuex.Store({
    state: {
        loading: false,
        catEstado: CatEstado(),
        catMunicipio: CatMunicipio(),
        catUbicacion: [],
        pacientes_datos: [],
        items_currentResult:[],
        medicos_datos: [],
        componenteDinamico: {
            customComponent2: null,
            customComponent: null,
            params: {},
        },
        total_pacientes: function(){
            return this.pacientes_datos.length
        },
        total_pacientes_emergencia: function(){

            return this.pacientes_datos.filter(x=>{
                let ubicaciones = [
                    ...getUbicaciones(2,this.catUbicacion),//ea
                    ...getUbicaciones(28,this.catUbicacion)//ep
                ]
                //console.log(ubicaciones)
                if(ubicaciones.includes(Number(x.cat_user_ubicacion_id))){
                    return x
                }
            }).length
        },
        total_pacientes_hospitalizacion: function(){

            return this.pacientes_datos.filter(x=>{
                let ubicaciones = [
                    ...getUbicaciones(390,this.catUbicacion),//hcep
                    ...getUbicaciones(42,this.catUbicacion),//hp2
                    ...getUbicaciones(70,this.catUbicacion),//hp3
                    ...getUbicaciones(98,this.catUbicacion),//hp4
                    ...getUbicaciones(126,this.catUbicacion),//hp5
                    ...getUbicaciones(154,this.catUbicacion),//hp6
                ]
                //console.log(ubicaciones)
                if(ubicaciones.includes(Number(x.cat_user_ubicacion_id))){
                    return x
                }
            }).length
        },
        total_pacientes_uti: function(){

            return this.pacientes_datos.filter(x=>{
                let ubicaciones = [
                    ...getUbicaciones(182,this.catUbicacion),//utia
                    ...getUbicaciones(194,this.catUbicacion),//utip
                    391,//utin

                ]
                //console.log(ubicaciones)
                if(ubicaciones.includes(Number(x.cat_user_ubicacion_id))){
                    return x
                }
            }).length
        },
        total_pacientes_aq: function(){

            return this.pacientes_datos.filter(x=>{
                let ubicaciones = [
                    ...getUbicaciones(41,this.catUbicacion),

                ]
                //console.log(ubicaciones)
                if(ubicaciones.includes(Number(x.cat_user_ubicacion_id))){
                    return x
                }
            }).length
        },
        total_pacientes_pad: function(){

            return this.pacientes_datos.filter(x=>{
                let ubicaciones = [
                    ...getUbicaciones(223,this.catUbicacion),//todos los pad
                   /*  ...getUbicaciones(224,this.catUbicacion),//emergencia
                    ...getUbicaciones(372,this.catUbicacion),//postqx
                    ...getUbicaciones(379,this.catUbicacion),//medico */

                ]
                //console.log(ubicaciones)
                if(ubicaciones.includes(Number(x.cat_user_ubicacion_id))){
                    return x
                }
            }).length
        },
        ruta: localStorage.getItem("area_siglas"),
        area_description: localStorage.getItem("area_description"),
        messageWellcome: userGenero === "m" ? "¡Bienvenido!" : "¡Bienvenida!",
        userData: {
            user_id_medico: userIdMedico,
            userEspecialidad: "Sin Especialidad",
            username: userNombres + " " + userApellidos,
            nombres: userNombres,
            apellidos: userApellidos,
            genero: userGenero,
            prefijo: userPrefijo,
            userImage: "https://placehold.co/100x100",
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
        updateObjectValue(state, form) {
            return (state[form.formName][form.fieldName] = form.fieldValue);
        },
        updateEpisodio(state, form) {
            return (state["pacientes_datos"][form.index] =
                form.fieldValue);
        },
        formRegistroPacienteInterno(state) {
            state.formRegistroPacienteInterno = JSON.parse(
                originalformRegistroPacienteInterno
            );
        },
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
