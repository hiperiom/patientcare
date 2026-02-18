/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('../../../../bootstrap');
window.Vue = require('vue');
import Vuex from 'vuex';

Vue.use(Vuex);

import App from './AppEventoEspecial2.vue'
// Aquí puedes configurar tu store Vuex si es necesario
const store = new Vuex.Store({
    state: {
        nombresDiasSemana : ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        ubicacion_id_stand:232,
        ubicacion_id_ap:233,
        pacientesHoy:[],
        pacientesPorDia:[],
        diasEventos:[],
        pacientes:[],
        total_pacientes_por_dia:[],
        group_pacientesPorDia:[],
        fechaActual:  null ,
        sumaTotal:0,
        promedio:0,
        nuevaFecha: new Date(),
        nuevosPacientes: [],
        nuevosPacientesPorDia: [],
        nuevosDiasEventos: [],
        nuevosGroup_pacientesPorDia: [],
        nuevosPacientesHoy: [],
        nuevosTotal_pacientes_por_dia: [],
        nuevosSumaTotal: 0,
        nuevosPromedio: 0,
        
    },
    mutations: {
        currentDate( state){
            return state.fechaActual = state.nuevaFecha;
        },
        currentsPacientes( state){
            return state.pacientes = state.nuevosPacientes;
        },
        currentsPacientesPorDia( state){
            return state.pacientesPorDia = state.nuevosPacientesPorDia;
        },
        currentsDiasEventos( state){
            return state.diasEventos = state.nuevosDiasEventos;
        },
        currentsGroupPacientesPorDia( state){
            return state.group_pacientesPorDia = state.nuevosGroup_pacientesPorDia;
        },
        currentsNuevosPacientesHoy( state){
            return state.pacientesHoy = state.nuevosPacientesHoy;
        },
        currentsTotal_pacientes_por_dia( state){
            return state.total_pacientes_por_dia = state.nuevosTotal_pacientes_por_dia;
        },
        currentsSumaTotal( state){
            return state.sumaTotal = state.nuevosSumaTotal;
        },
        currentsPromedio( state){
            return state.promedio = state.nuevosPromedio;
        },
        
    },
    actions:{
        updateFechaActual( context){
            return context.commit("currentDate")
        },
        updatePacientes( context){
            return context.commit("currentsPacientes")
        },
        updatePacientesPorDia( context){
            return context.commit("currentsPacientesPorDia")
        },
        updateDiasEventos( context){
            return context.commit("currentsDiasEventos")
        },
        updateGroupPacientesPorDia( context){
            return context.commit("currentsGroupPacientesPorDia")
        },
        updateNuevosPacientesHoy( context){
            return context.commit("currentsNuevosPacientesHoy")
        },
        updateTotal_pacientes_por_dia( context){
            return context.commit("currentsTotal_pacientes_por_dia")
        },
        updateSumaTotal( context){
            return context.commit("currentsSumaTotal")
        },
        updatePromedio( context){
            return context.commit("currentsPromedio")
        },
    },
});
const app = new Vue({
    el: '#app',
    store,
    render:h=>h(App)
});
