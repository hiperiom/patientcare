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
import {routes} from './router.js'
import Vue from 'vue'
import Vuex from 'vuex';
Vue.use(VueRouter)
Vue.use(Vuex)

//let ls = localStorage.getItem('fecha_reporte_plan_quirurgico')
let fecha = fechaHoy();
    /* if (is_null(ls) || is_undefined(ls) ) { */
        localStorage.setItem('fecha_reporte_plan_quirurgico',fecha)
    /* }else{
        fecha = ls;
    } */
let fechaSplit = fecha.split("-")



const store = new Vuex.Store({
    state: {
        personalAsistencial:[],
        personalAsistensial:[],
        solicitudes:[],
        loading:true,
        catUbicacion:[],
        fecha_reporte: fecha,
        relog_dia:fechaSplit[2].padStart(2, '0'),
        relog_mes:mesesEnEspanol[Number(fechaSplit[1])-1].slice(0,3),
        relog_anio:fechaSplit[0],
        relog_hora:"",
    },
    mutations: {
        updateProperty(state,form){
            return state[form.property] = form.value
        },
        updateListadoEquipoCirugia( state,model){
            return state.listadoEquipoCirugia = model;
        },
    },

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
