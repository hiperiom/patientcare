/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../../../bootstrap.js');

window.Vue = require('vue');

import { get, is_null, is_empty, fechaHoy, horaIntervencion } from '../../../helpers/customHelpers.js';
import App from './App.vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex';
import {routes} from './router.js'
import Vue from 'vue'

Vue.use(VueRouter)
Vue.use(Vuex)
let ls = localStorage.getItem('showMenu')
    if (is_null(ls)) {
        localStorage.setItem('showMenu',"true")
    }
    ls = localStorage.getItem('showMenuRight')
    if (is_null(ls)) {
        localStorage.setItem('showMenuRight',"true")
    }
    ls = localStorage.getItem('maximize')
    if (is_null(ls)) {
        localStorage.setItem('maximize',"true")
    }
let originalIntervencionItem = JSON.stringify({
        description:"",
        cirujano_principal:[],
        ayudante_1:[],
        ayudante_2:[],
        ayudante_3:[],
        anestesiologo:[],
        equipos_especiales:[],
        deleted:false,
    })
let arrayOriginalIntervencionItem=[]
    arrayOriginalIntervencionItem.push( JSON.parse(originalIntervencionItem) )

let originalFormReservacionQuirofano = JSON.stringify({
    solicitud_id:null,
    nacionalidad:'V',
    cedula:"",
    email:"",
    nombres:"",
    apellidos:"",
    genero:"m",
    fnacimiento:fechaHoy(),
    telefono_movil:"",
    telefono_hogar:"",
    user_id:"",

    area_intervencion:"",
    n_presupuesto:"",
    anestesia_sugerida:"General",
    dias_hospitalizacion:0,
    dias_uti:0,

    n_quirofano:1,
    tipo_reservacion:"Emergencia",
    tipo_cupo:"Quirúrgico",
    h_inicio:horaIntervencion(),
    h_fin:"1",
    destino:null,
    cat_user_ubicacion_id:418,
    fecha_reservacion:fechaHoy(),


    fase_ubicacion:"En espera",
    diagnostico_preoperatorio:"",

    intervencion: arrayOriginalIntervencionItem,

    uploadedFile: [],



})

const store = new Vuex.Store({
    state: {
        userData: {
            user_id_medico: userIdMedico,
            userEspecialidad:"Sin Especialidad",
            username: userNombres+" "+userApellidos,
            nombres:userNombres,
            apellidos:userApellidos,
            genero: userGenero,
            prefijo: userPrefijo,
            userImage: 'https://placehold.co/100x100',
        },
        originalIntervencionItem: JSON.parse(originalIntervencionItem),
        messageWellcome: (userGenero === "m") ? '¡Bienvenido!':'¡Bienvenida!',
        sidebarLeft: "false",
        maximize: localStorage.getItem('maximize'),
        catUbicacion:[],
        catUbicacionTemp2:[],
        catUbicacionTemp3:[],
        catUbicacionTemp4:[],
        lv2SelectUbicacion:true,
        lv3SelectUbicacion:false,
        lv4SelectUbicacion:false,
        //showMenu:localStorage.getItem('showMenu'),
        listadoSolicitudeanestesia_sugeridasQx:[],
        formReservacionQuirofano: JSON.parse(originalFormReservacionQuirofano),
        searchCedula:false,
        loading:true,
        personal_salud:[],
        otros_equipos_especiales:false,
        personalAsistencial:[],
        otroPersonalAsistencial:[],
        edit_solicitud_id:null,

        equipo_medico:[],
        listadoAnestesiologos:[],
        listadoEquipoCirugia:[],
        especialidadesUnicas:[],
        listadoSolicitudesQx:[],
        listadoQuirofanos:[],
        equipos_especiales_options:[
            'Argon Plasma',
            'Bisturi Armonico',
            'BOMBA ERBEJET',
            'CELL SAVER',
            'DERMATOMO',
            'ECO TRANSESOFAGICO',
            'ELECTROBISTURI',
            'EQUIPO ARCO PARA ANESTESIA',
            'EQUIPO ARCO SIMPATICOTOMIA TORAXICA',
            'EQUIPO CRANEOTOMO PARA CRANEO Y COLUMNA',
            //'EQUIPO CRIOSTATO',
            'EQUIPO DE RADIOFRECUENCIA SIMPLE',
            'EQUIPO DE RADIOFRECUENCIA MULTIPLE',
            'EQUIPO LAPAROSCOPIO OLYMPUS',
            'EQUIPO LASER DIODO CHEESE',
            'EQUIPO LIGASURE',


            'GREEN LIGHT EQUIPO LASER VERDE P/VAP(prest)',
            'HEATER COOLER',
            'INSTRUMENTAL DE LAPAROSCOPIA',
            'KIT PARA CRANEOTOMO  (midas rex / anspach)',
            'LAPAROSCOPIO STORZ',
            'MANIPULADOR UTERINO',
            'MARCAPASOS EXTERNO/DIA',
            'MARCO DE ESTEROTAXIA',
            'MAXCESS III',
            'MEDICO NEONATOLOGO',
            'MICROSCOPIO DE NEUROCIRUGIA* (KINEVO 900) NUEVO ',
            'MICROSCOPIO NEUROCIRUGIA (MÖLLER) VIEJO',
            'MICROSCOPIO OFTALMOLOGICO',
            'MICROSCOPIO ORL',
            'MINIDRIVER',
            'MONITOR DE TRASLADO',
            'MONITOREO FETAL',
            'NEURONAVEGADOR RESECC DE TUMOR',
            'PIEZA DE MANO ARMONICO',
            'SALA DE ESTUDIOS ESPECIALES',
            'SIERRA ESTERNON',
            'SISTEMA DE ASPIRACION (CUSA)',
            'SISTEMA DE MALLAS DE ELECTROCORTICOGRAFIA',
            'SISTEMA DRILL QUIRURGICO',
            'SISTEMA PRONO',
            'SISTEMA RETRACTOR BOOKWALKER',
            'SISTEMAS DE EXTRAPROTECCION',
            'KIT BIOSEGURIDAD QUIROFANO',
            'TORNIQUETE NEUMATICO',
            'USO DE EQUIPO LASER',
            'USO DE FIBRA VIDEO LASER',
            'EQUIPO VIDEOFIBROBRONCOSCOPIO',
            'EQUIPO COLANGIOSCOPIO',
            'TORRE STRYKER',
            'INSTRUMENTAL ESPECIAL CCV MINIMAMENTE INVASIVA',
            'Arco de Ste',
            'Banco de Sangre',
            'Craneotomo',
            'Craneotomo Kinevo',
            'Cusa',
            'Equipo criostático',
            'Flowtron',
            'Frontoluz',
            'Fuente de poder',
            'Intensif 1',
            'Intensif 2',
            'Kit de Laparoscopia',
            'Ligasure',
            'Marco estereotaxia',
            'Maxcess',
            'Microscopio',
            'Pierneras',
            'Robot Da Vinci',
            'Torre Olympus',
            'Torre Storz',
            'Otros',
        ],
        inputLv0:false,
        inputLv1:false,
        inputLv2:false,
        inputLv3:false,
        inputLv4:false,
        inputLv5:false,
        inputLv6:false,
        inputLv7:false,
        ubicaciones_level1:[],
        ubicaciones_level2:[],
        ubicaciones_level3:[],
        ubicaciones_level4:[],
        ubicaciones_level5:[],
        ubicaciones_level6:[],
        ubicaciones_level7:[],
    },
    mutations: {
        updateProperty(state,form){
            state[ form.fieldName ] = form.fieldValue;
        },
        updateFormField(state, form) {
            return state[ form.formName ][ form.fieldName ] = form.fieldValue;
        },
        SET_FILE(state, file) {
            state.formReservacionQuirofano.uploadedFile = file;
        },
        resetForm(state){
            state.formReservacionQuirofano = JSON.parse(originalFormReservacionQuirofano);
        },
        editFormReservacionQuirofano(state, form) {
            let temp = JSON.parse(originalFormReservacionQuirofano);

                temp['nacionalidad'] = form.nacionalidad;
                temp['cedula'] = form.documento_identidad;
                temp['email'] = form.email;
                temp['nombres'] = form.nombres;
                temp['apellidos'] = form.apellidos;
                temp['genero'] = form.genero;
                temp['fnacimiento'] = form.fnacimiento;
                temp['telefono_movil'] = form.telefono_movil;
                temp['telefono_hogar'] = form.telefono_hogar;

                temp['n_presupuesto'] = form.n_presupuesto;
                temp['h_inicio'] = form.hora_inicio_formated;
                temp['h_fin'] = form.h_aprox_fin;
                temp['fecha_reservacion'] = form.fecha_reservacion;
                temp['dias_hospitalizacion'] = form.dias_hospitalizacion;
                temp['dias_uti'] = form.dias_uti;
                temp['diagnostico_preoperatorio'] = !is_null(form.diagnostico_preoperatorio) ? form.diagnostico_preoperatorio : ""

                temp['n_quirofano'] = form.n_quirofano;
                temp['anestesia_sugerida'] = form.anestesia_sugerida;
            let tempIntervencion = JSON.parse(form.intervencion).filter(x=>{
                    if(
                        x.hasOwnProperty('description') &&
                        x.hasOwnProperty('cirujano_principal') &&
                        x.hasOwnProperty('ayudante_1') &&
                        x.hasOwnProperty('ayudante_2') &&
                        x.hasOwnProperty('ayudante_3') &&
                        x.hasOwnProperty('anestesiologo') &&
                        x.hasOwnProperty('equipos_especiales') &&
                        x.hasOwnProperty('deleted')
                    ){
                        return x
                    }
                })
                //console.log(tempIntervencion)
                temp['intervencion'] = is_empty(tempIntervencion) || form.intervencion==="[]"  ? arrayOriginalIntervencionItem : tempIntervencion;

                temp['destino'] = form.destino;
                temp['solicitud_id'] = form.id;
                temp['tipo_cupo'] = form.tipo_cupo;
                temp['tipo_reservacion'] = form.tipo_reservacion;

            let tempArreglo = []

                // Función recursiva para buscar el parent a partir de un ID
            let buscarParent = (id,key=true) =>{
                    //Si el id es menor 418 o 2 no filtrar
                    if (key) {
                        if(id < 418 ){
                            return null
                        }
                    }
                    if(id < 2 ){
                        return null
                    }
                    // Buscar el objeto con el ID dado
                    let ubicacionActual = state['catUbicacion'].find(ubicacion => ubicacion.id === id);

                    // Si no se encuentra la ubicación con el ID, devolver null
                    if (!ubicacionActual) {
                        return null;
                    }
                    tempArreglo.push(id)

                    // Obtener el parent ID de la ubicación actual
                    let parentId = ubicacionActual.parent_cat_user_ubicacion_id;

                    // Si no hay un parent ID, devolver la ubicación actual
                    if (parentId === null) {
                        return ubicacionActual;
                    }

                    // Llamada recursiva para buscar en el parent
                    return buscarParent(parentId,key);
                }
            let ubicaciones = [];
            let idBuscado = form.area_intervencion ==="" ? "" :  Number(form.area_intervencion); // Puedes cambiar este valor al ID que desees buscar
                if (!is_empty(idBuscado)) {
                    buscarParent(idBuscado);
                    ubicaciones = tempArreglo
                }


                if (ubicaciones.length > 0) {
                    ubicaciones = ubicaciones.sort()
                    console.log("ubicaciones",ubicaciones)
                    let lv = 4
                        ubicaciones.forEach(item=>{
                            state['ubicaciones_level'+(lv+1)  ] = state.catUbicacion
                            .filter(item2=>  Number(item2['parent_cat_user_ubicacion_id']) === item )
                            .map(item3=>{
                                return {
                                "id":item3.id,
                                "description":item3.description+" "+item3.coments,
                                "parent_id":item3.parent_cat_user_ubicacion_id
                                }
                            })
                            lv++

                        })
                        setTimeout(() => {
                            let index = 0
                            let lv = 4
                            ubicaciones.forEach(item=>{
                                if (index < ubicaciones.length) {
                                    console.log('level'+lv)
                                    document.getElementById('level'+lv).value = item
                                    state['inputLv'+(lv) ] = true
                                    temp['area_intervencion'] = item;
                                }

                                lv++
                                index++
                            })
                        }, 1000);
                }else{
                    temp['area_intervencion'] = "";
                }
                tempArreglo = []
            let destinos = [];
                idBuscado = form.destino ==="" ? "" :  Number(form.destino);
                if (!is_empty(idBuscado)) {
                    buscarParent(idBuscado,false);
                    destinos = tempArreglo
                }

                if (destinos.length > 0) {
                    destinos = destinos.sort()
                    console.log("destinos",destinos)
                    let lv = 0
                        destinos.forEach(item=>{
                            state['ubicaciones_level'+(lv+1)  ] = state.catUbicacion
                            .filter(item2=>  Number(item2['parent_cat_user_ubicacion_id']) === item )
                            .map(item3=>{
                                return {
                                "id":item3.id,
                                "description":item3.description+" "+item3.coments,
                                "parent_id":item3.parent_cat_user_ubicacion_id
                                }
                            })
                            lv++

                        })
                        setTimeout(() => {
                            let lv = 0
                            destinos.forEach(item=>{
                                if (lv < destinos.length) {
                                    console.log('level'+lv)
                                    document.getElementById('level'+lv).value = item
                                    state['inputLv'+(lv) ] = true
                                    temp['destino'] = item;
                                }

                                lv++
                            })
                        }, 1000);
                }else{
                    temp['destino'] = "";
                }



                state['loading' ] = false


                return state['formReservacionQuirofano' ] = temp;
        },
        editSolicitud(state, form) {
            return state[ 'edit_solicitud_id' ] = form;
        },
        updateFormFiles(state, form) {
            return state[ 'formReservacionQuirofano' ][ form.fieldName ] = form.fieldValue;
        },
        updateFormFieldFile(state, form) {
            return state[ 'formReservacionQuirofano' ][ 'uploadedFile' ][form.index]['coments'] = form.fieldValue;
        },
        updatePersonalAsistencialQx(state, form) {
            return state[ 'personalAsistencial' ][form.index]['personal_asistencial'] = form.value;
        },
        updatePersonalAsistencialEnfermeria(state, form) {
            return state[ 'personalAsistencial' ][form.index]['personal_asistencial'].push(form.value);
        },
        destroyPersonalAsistencialEnfermeria(state, form) {
            return state[ 'personalAsistencial' ][form.index]['personal_asistencial'] = state[ 'personalAsistencial' ][form.index]['personal_asistencial'].map(x=>{
                if(x['id'] === form.id && x['tipo_personal']===form.tipo_personal){
                    x[form.field] = form.value
                }
                return x
            })
        },
        destroyOtroPersonalAsistencialEnfermeria(state, form) {
            return state[ 'otroPersonalAsistencial' ] = state[ 'otroPersonalAsistencial' ].map(x=>{
                if(x['id'] === form.id && x['tipo_personal']===form.tipo_personal){
                    x[form.field] = form.value
                }
                return x
            })
        },
        updateOtroPersonalAsistencialEnfermeria(state, form) {
            return state[ 'otroPersonalAsistencial' ].push(form);
        },
        updateEquipoMedico( state,model){
            return state.equipo_medico = model;
        },
        updatePersonalAsistencial( state,model){
            return state.personalAsistencial = model;
        },
        updateOtroPersonalAsistencial( state,model){
            return state.otroPersonalAsistencial = model;
        },
        updateListadoSolicitudesQx( state,model){
            return state.listadoSolicitudesQx = model;
        },
        updateshowMenu( state,model){
            return state.showMenu = model;
        },
        updatePersonalSalud( state,model){
            return state.personal_salud = model;
        },

        updateSolicitudQx2( state,index){
           // console.log(index)
            return state.listadoSolicitudesQx[ index[0] ]['dias'][ index[1] ][ index[2] ] = index[3];
        },
        updateSolicitudQxFinalizar( state,index){
            return state.listadoSolicitudesQx[ index[0] ]['dias'][ index[1] ]['status_id'] = 3;
        },
        updateLoading(state,mostrar){
            return state.loading = mostrar
        },
        searchCedula(state,mostrar){
            return state.searchCedula = mostrar
        },

        updateQuirofanos( state,model){
            return state.listadoQuirofanos = model;
        },
        updateListadoAnestesiologos( state,model){
            return state.listadoAnestesiologos = model;
        },
        updateListadoEquipoCirugia( state,model){
            return state.listadoEquipoCirugia = model;
        },
        updateEspecialidadesUnicas(state) {
            return state.especialidadesUnicas = [...new Set( state.personal_salud.map(item => item.especialidad ))].sort();
        },
    },
    getters: {

        existenSolicitudesQx(state){
            return  state.listadoSolicitudesQx.length > 0 ? true : false
        },
        listadoSolicitudesQx(state){
            return  state.listadoSolicitudesQx
        },
        mostrarLoading(state){
            return  state.loading
        },
        searchingCedula(state){
            return  state.searchCedula
        },
        uploadedFile(state){
            return  state.formReservacionQuirofano.uploadedFile
        },


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
