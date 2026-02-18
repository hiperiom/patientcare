/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('../../../bootstrap');
window.Vue = require('vue');
import Vuex from 'vuex';

Vue.use(Vuex);

import App from './AppIngresosCmdlt.vue'
// Aquí puedes configurar tu store Vuex si es necesario
const store = new Vuex.Store({
    state: {


    },
    mutations: {


    },
    actions:{

    },
});
const app = new Vue({
    el: '#app',
    store,
    render:h=>h(App)
});
