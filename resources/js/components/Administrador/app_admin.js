/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../../bootstrap.js');

window.Vue = require('vue');

import { get, is_null,  fechaHoy, } from '../../helpers/customHelpers.js';
import {getAll as CatEstado} from '../Catalogos/CatEstado.js'
import {getAll as CatMunicipio} from '../Catalogos/CatMunicipio.js'
import App from './App.vue'
import VueRouter from 'vue-router'
import {routes} from './router.js'
import Vue from 'vue'
import Vuex from 'vuex';
Vue.use(VueRouter)
Vue.use(Vuex)


const store = new Vuex.Store({
    state: {
        loading:true,
        catEstado: CatEstado(),
        catMunicipio: CatMunicipio(),
        catUbicacion:[],
        episodios:[],
        sidebarLeft: "false",
        sidebarRight: "false",
        messageWellcome: (userGenero === "m") ? '¡Bienvenido!':'¡Bienvenida!',
        titleAreaActual:"Todos los Pacientes",
        groupBtnTotales:[],
        userData: {
            user_id_medico: userIdMedico,
            userEspecialidad:"Sin Especialidad",
            username: userNombres+" "+userApellidos,
            nombres:userNombres,
            apellidos:userApellidos,
            genero: userGenero,
            prefijo: userPrefijo,
            userImage: 'https://placehold.co/100x100',
        }
    },
    mutations: {
        updateProperty(state,form){
            state[ form.fieldName ] = form.fieldValue;
        },
        updateArrayItem(state, form) {
            return state[ form.item ][ form.index ] = form.value;
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
