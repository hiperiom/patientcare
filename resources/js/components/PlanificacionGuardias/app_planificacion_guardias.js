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
Vue.use(VueTippy);
Vue.use(VueRouter);
Vue.component("tippy", TippyComponent);
Vue.use(Vuex);

const store = new Vuex.Store({
    state: {}

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
