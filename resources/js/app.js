/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('survey-component', require(/* webpackChunkName: "survey-component" */ './components/surveys/SurveyComponent.vue').default);
Vue.component('statistics-component', require(/* webpackChunkName: "statistics-component" */ './components/surveys/StatisticsComponent.vue').default);
Vue.component('section-statistics-component', require(/* webpackChunkName: "section-statistics-component" */ './components/surveys/SectionStatisticsComponent.vue').default);
Vue.component('index-statistics-component', require(/* webpackChunkName: "index-statistics-component" */ './components/surveys/IndexStatisticsComponent.vue').default);
Vue.component('list-dischargeds-component', require(/* webpackChunkName: "list-dischargeds-component" */ './components/surveys/ListDischargedsComponent.vue').default);
Vue.component('stadistics-box', require(/* webpackChunkName: "stadistics-box" */ './components/surveys/StadisticsBox.vue').default);
Vue.component('send-survey-card', require(/* webpackChunkName: "send-survey-card" */ './components/surveys/SendSurveyCard.vue').default);
Vue.component('multiple-progress-bar', require(/* webpackChunkName: "multiple-progress-bar" */ './components/surveys/MultipleProgressBar.vue').default);
Vue.component('list-surveys-insitu', require(/* webpackChunkName: "list-surveys-insitu" */ './components/surveys/ListSurveysInsitu.vue').default);
Vue.component('pre-alta-card', require(/* webpackChunkName: "pre-alta-card" */ './components/surveys/PreAltaCard.vue').default);
Vue.component('alta-card', require(/* webpackChunkName: "alta-card" */ './components/surveys/AltaCard.vue').default);

// Componentes del menú principal
Vue.component('menu-inicial-principal', require(/* webpackChunkName: "menu-inicial-principal" */ './components/MenuInicial/MenuPrincipal.vue').default);
Vue.component('menu-inicial-area-quirurgica', require(/* webpackChunkName: "menu-inicial-area-quirurgica" */ './components/MenuInicial/MenuAreaQuirurgica.vue').default);
Vue.component('menu-inicial-telesalud', require(/* webpackChunkName: "menu-inicial-telesalud" */ './components/MenuInicial/MenuTelesalud.vue').default);
Vue.component('menu-inicial-dashboards-seguimiento', require(/* webpackChunkName: "menu-inicial-dashboards-seguimiento" */ './components/MenuInicial/MenuDashboardsSeguimiento.vue').default);
Vue.component('menu-inicial-hospitalizacion', require(/* webpackChunkName: "menu-inicial-hospitalizacion" */ './components/MenuInicial/MenuHospitalizacion.vue').default);
Vue.component('menu-inicial-uti', require(/* webpackChunkName: "menu-inicial-uti" */ './components/MenuInicial/MenuUti.vue').default);
Vue.component('menu-inicial-pacientes-piso', require(/* webpackChunkName: "menu-inicial-pacientes-piso" */ './components/MenuInicial/MenuPacientesPiso.vue').default);
Vue.component('menu-inicial-eventos-especiales', require(/* webpackChunkName: "menu-inicial-eventos-especiales" */ './components/MenuInicial/MenuEventosEspeciales.vue').default);
Vue.component('menu-inicial-administrador', require(/* webpackChunkName: "menu-inicial-administrador" */ './components/MenuInicial/MenuAdministrador.vue').default);
Vue.component('menu-inicial-administrador-reportes', require(/* webpackChunkName: "menu-inicial-administrador-reportes" */ './components/MenuInicial/MenuAdministradorReportes.vue').default);
Vue.component('menu-inicial-satisfaccion', require(/* webpackChunkName: "menu-inicial-satisfaccion" */ './components/MenuInicial/MenuSatisfaccion.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
