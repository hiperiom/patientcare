/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../../bootstrap');

window.Vue = require('vue');

import App from './App.vue'
import VueRouter from 'vue-router'
import {routes} from './router.js'
import {navegationMenu} from './navegationMenu.js'
import Vue from 'vue'
import Vuex from 'vuex';
Vue.use(VueRouter)
Vue.use(Vuex)



const store = new Vuex.Store({
    state: {
        loading:true,
        user_profile:[],
        id:null,
        email:"",
        password:"",
        navegationMenu:navegationMenu
    },
    mutations: {
        updateProperty(state,form){
            state[ form.fieldName ] = form.fieldValue;
        },
        updateFormField(state, form) {
            return state[ form.formName ][ form.fieldName ] = form.fieldValue;
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


