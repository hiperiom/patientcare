/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../../../bootstrap.js');

window.Vue = require('vue');

import App from './App.vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex';
import {routes} from './router.js'
import Vue from 'vue'

Vue.use(VueRouter)
Vue.use(Vuex)


const store = new Vuex.Store({
    state: {
        
        loading:true,
        catUbicacion:[],
        pacientes_activos:[],
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
