<template>
    <div class="d-flex flex-column vh-100 overflow-auto">
        <CintilloSuperior :relog_hora="relog_hora" :total_habitaciones_ocupadas="total_habitaciones_ocupadas"
            :total_habitaciones="total_habitaciones" :ala="ala" :piso="piso" :pacientes_activos="pacientes_activos" />

        <div class="container-fluid d-flex overflow-auto flex-fill pb-2">
            <table class="w-100">
                <thead>
                    <tr class="text-center text-white">
                        <th class="sticky-top">HAB</th>
                        <th class="sticky-top">PACIENTE</th>
                        <th class="sticky-top">DÍAS</th>
                        <th class="sticky-top">RIESGOS</th>
                        <th class="sticky-top">PENDIENTES</th>
                        <th class="sticky-top">OBSERVACIONES</th>
                        <th class="sticky-top">TRATANTES</th>
                        <th class="sticky-top">RESIDENTES</th>
                        <th class="sticky-top">ENFERMERÍA</th>
                    </tr>
                </thead>
                <tbody>

                    <tr v-for="item in getHabitaciones" :key="item.id"
                        class="text-white text-center swing-in-top-fwd shadow-sm" style="height:40px">
                        <!-- HABITACIÓN -->
                        <td style="font-size: 1.1rem;width:6% !important;line-height:1rem !important"
                            class="tbl-row-radius-left bg-info-piso p-0">

                            <div class="d-flex flex-column">
                                <b style="font-size: 1.8rem;">{{ item.coments.replace("Hab. ", "") }}</b>
                                <div v-if="getPaciente(item.id) !== undefined"
                                    :class="['text-uppercase p-1 mt-2 text-nowrap rounded mx-2 text-center', { 'd-none': getPaciente(item.id)['pre_alta'] === null }, getColorPrealta(item)]"
                                    style="font-size: 0.8em;">
                                    <i class="fas fa-stopwatch"></i> {{ getFechaPreAlta(item) }}
                                </div>
                            </div>
                        </td>
                        <!-- PACIENTE -->
                        <td style="width:8% !important" class="glassmod-effect text-left p-0 pl-1">
                            <div v-if="getPaciente(item.id) !== undefined" class="d-flex align-items-center">

                                <div class="d-flex flex-column" style="font-size: 1.8rem;">
                                    <div class="text-nowrap overflow-hidden mb-1"
                                        style="width:auto !important;text-transform: capitalize !important; ">
                                        {{ formatearNombrePaciente2(getPaciente(item.id)) }}
                                    </div>
                                    <div class="d-flex  align-items-center">
                                        <!-- CEDULA -->
                                        <!-- <div class="badge d-flex align-items-center badge-primary mr-1" style="font-size:0.6rem;padding:0.1rem;">
                                                <i class="mx-1 fas fa-id-card"></i> <span style="font-size:0.9rem;font-weight:500">{{ getPaciente(item.id)['nacionalidad']+getPaciente(item.id)['cedula'] }}</span>
                                            </div> -->
                                        <!-- GENERO -->
                                        <div :class="['badge d-flex align-items-center px-2 mr-2 text-uppercase', { 'badge-info': getPaciente(item.id)['genero'] === 'm' }, , { 'badge-pink': getPaciente(item.id)['genero'] === 'f' }]"
                                            style="font-size:0.6rem;padding:0.1rem;">
                                            <i class="fas fa-venus-mars mr-2"></i> <span
                                                style="font-size:0.9rem;font-weight:500">{{
            getPaciente(item.id)['genero'] }}</span>
                                        </div>
                                        <!-- EDAD -->
                                        <div class="badge d-flex align-items-center px-2 badge-warning mr-2"
                                            style="font-size:0.6rem;padding:0.1rem;">
                                            <i class="fas fa-birthday-cake mr-2"></i> <span
                                                style="font-size:0.9rem;font-weight:500">{{ getPaciente(item.id)['edad']
                                                }} A</span>
                                        </div>
                                        <!-- VIP -->
                                        <div v-if="getPaciente(item.id)['user_vip_value'] === 1" class="mr-2"
                                            style="font-size:1rem;padding:0.1rem;font-weight:400">
                                            <i :class="['pc-paciente_vip text-info']"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <!-- DIAS -->
                        <td style="width:2% !important;font-size: 1.8rem;" class="glassmod-effect text-center ">
                            <div v-if="getPaciente(item.id) !== undefined">
                                {{ getPaciente(item.id)['dias'] }}
                            </div>

                        </td>
                        <!-- RIESGOS-->
                        <td style="width:5% !important" class="glassmod-effect text-center p-0">
                            <div v-if="getPaciente(item.id) !== undefined" class="d-flex justify-content-around">
                                <div style="font-size: 1.5rem;">
                                    <i
                                        :class="[{ 'pc-alerta_alta text-danger heartbeat-2': getPaciente(item.id)['alerta_riesgo_value'] === 1 }, { 'pc-alerta_intermedia heartbeat text-warning': getPaciente(item.id)['alerta_riesgo_value'] === 2 }, { 'pc-alerta_estable text-success-alert': getPaciente(item.id)['alerta_riesgo_value'] === 3 },]"></i>
                                </div>

                                <!-- Riesgo Caida: -->
                                <div style="font-size: 1.5rem;">
                                    <i
                                        :class="['pc-resbalar', { 'text-danger heartbeat-2': getPaciente(item.id)['resbalar_riesgo_value'] === 1 }, { 'text-warning heartbeat ': getPaciente(item.id)['resbalar_riesgo_value'] === 2 }, { 'text-success-resbalar': getPaciente(item.id)['resbalar_riesgo_value'] === 3 },]"></i>
                                </div>

                                <!-- Riesgo Cirugía: -->
                                <div style="font-size: 1.5rem;">
                                    <i
                                        :class="['pc-cirugia', { 'text-danger heartbeat-2': getPaciente(item.id)['cirugia_riesgo_value'] === 3 }, { 'heartbeat  text-warning': getPaciente(item.id)['cirugia_riesgo_value'] === 2 }, { 'text-success-cirugia': getPaciente(item.id)['cirugia_riesgo_value'] === 1 },]"></i>
                                </div>

                            </div>
                        </td>
                        <!-- PENDIENTES -->
                        <td style="width:10% !important;font-size: 0.9rem;line-height:0.8rem !important"
                            class="glassmod-effect text-left p-1">
                            <div v-if="getPaciente(item.id) !== undefined">
                                <div v-for="(pendiente, index) in getPaciente(item.id)['pendientes']" :key="index"
                                    class="d-flex mb-1 text-left align-items-start">
                                    <span :class="['badge badge-info mr-1']">
                                        <i :class="['pc-pendiente_paciente']"></i>
                                    </span>
                                    <div class="d-flex flex-column align-items-start">

                                        <b>{{ pendiente.value }}</b>
                                        <div class="mt-1">{{ pendiente.description }}</div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <!-- OBSERVACIONES -->
                        <td style="width:10% !important;font-size: 0.9rem;line-height:0.8rem !important"
                            class="glassmod-effect text-left p-1">
                            <div v-if="getPaciente(item.id) !== undefined && ![null, 'null'].includes(getPaciente(item.id)['user_vip_description'])"
                                class="d-flex text-left align-items-center">
                                <span :class="['badge badge-info mr-1 mb-1']">
                                    <i :class="['pc-paciente_vip']"></i>
                                    <!--  VIP: -->
                                </span>
                                {{ getPaciente(item.id)['user_vip_description'] }}
                            </div>
                            <div v-if="getPaciente(item.id) !== undefined && ![null, 'null'].includes(getPaciente(item.id)['alerta_riesgo_description'])"
                                class="d-flex text-left align-items-center">
                                <span
                                    :class="['badge mr-1 mb-1', { 'badge-danger': getPaciente(item.id)['alerta_riesgo_value'] === 1 }, { 'badge-warning': getPaciente(item.id)['alerta_riesgo_value'] === 2 }, { 'badge-success': getPaciente(item.id)['alerta_riesgo_value'] === 3 },]">
                                    <i
                                        :class="['text-white ', { 'pc-alerta_alta heartbeat-2': getPaciente(item.id)['alerta_riesgo_value'] === 1 }, { 'pc-alerta_intermedia heartbeat': getPaciente(item.id)['alerta_riesgo_value'] === 2 }, { 'pc-alerta_estable': getPaciente(item.id)['alerta_riesgo_value'] === 3 },]"></i>
                                    <!-- Riesgo: -->
                                </span>
                                {{ getPaciente(item.id)['alerta_riesgo_description'] }}
                            </div>
                            <div v-if="getPaciente(item.id) !== undefined && ![null, 'null'].includes(getPaciente(item.id)['resbalar_riesgo_description'])"
                                class="d-flex text-left align-items-center">
                                <span
                                    :class="['badge mr-1 mb-1', { 'badge-success': getPaciente(item.id)['resbalar_riesgo_value'] === 3 }, { 'badge-warning': getPaciente(item.id)['resbalar_riesgo_value'] === 2 }, { 'badge-danger': getPaciente(item.id)['resbalar_riesgo_value'] === 1 },]">
                                    <i
                                        :class="['pc-resbalar text-white', { 'heartbeat-2': getPaciente(item.id)['resbalar_riesgo_value'] === 1 }, { 'heartbeat ': getPaciente(item.id)['resbalar_riesgo_value'] === 2 }]"></i>
                                    <!-- Riesgo Caida: -->
                                </span>
                                {{ getPaciente(item.id)['resbalar_riesgo_description'] }}
                            </div>
                            <div v-if="getPaciente(item.id) !== undefined && ![null, 'null'].includes(getPaciente(item.id)['cirugia_riesgo_description'])"
                                class="d-flex text-left align-items-center">
                                <span
                                    :class="['badge mr-1 mb-1', { 'badge-success': getPaciente(item.id)['cirugia_riesgo_value'] === 3 }, { 'badge-warning': getPaciente(item.id)['cirugia_riesgo_value'] === 2 }, { 'badge-danger': getPaciente(item.id)['cirugia_riesgo_value'] === 1 },]">
                                    <i
                                        :class="['pc-cirugia text-white', { 'heartbeat-2': getPaciente(item.id)['cirugia_riesgo_value'] === 3 }, { 'heartbeat': getPaciente(item.id)['cirugia_riesgo_value'] === 2 }]"></i>
                                    <!-- Riesgo Cirugía: -->
                                </span>
                                {{ getPaciente(item.id)['cirugia_riesgo_description'] }}
                            </div>
                        </td>
                        <!-- TRATANTE -->
                        <td style="width:10% !important" class="glassmod-effect text-left p-1">
                            <div v-if="getPaciente(item.id) !== undefined && getPaciente(item.id)['equipo_medico_paciente']['tratante'] !== null"
                                class="text-left d-flex flex-wrap align-items-center">
                                <div class="d-flex align-items-center">
                                    <img loading="lazy" onerror="this.src='/image/system/patient.svg'"
                                        :src="getPaciente(item.id)['equipo_medico_paciente']['tratante']['imagen']"
                                        class="img-doctor mr-1"
                                        style="width: 35px; height: 35px; border-radius: 20px;">
                                    <div class="d-flex flex-column" style="line-height:1.5rem;">
                                        <div class="text-nowrap py-1 d-flex align-items-center overflow-hidden"
                                            style="width:auto !important;text-transform: capitalize !important;">
                                            {{
            formatearNombrePaciente2(getPaciente(item.id)['equipo_medico_paciente']['tratante'])
        }} <div class="badge badge-success  ml-1">TR</div>
                                        </div>
                                        <div class="d-flex">
                                            <div style="font-size:0.7rem;padding:0.2rem;font-weight:400"
                                                :class="['mr-2 mt-1 px-2 badge badge-primary nowrap', { 'd-none': getPaciente(item.id)['equipo_medico_paciente']['tratante']['especialidad'] === null || getPaciente(item.id)['equipo_medico_paciente']['tratante']['especialidad'] === 'Sin Especialidad' }]">
                                                <i class="pc-medico"></i>
                                                {{
            getPaciente(item.id)['equipo_medico_paciente']['tratante']['especialidad']
        }}
                                            </div>
                                            <div style="font-size:0.7rem;padding:0.2rem;font-weight:400"
                                                :class="['mr-2 mt-1 px-2 badge badge-warning', { 'd-none': getPaciente(item.id)['equipo_medico_paciente']['tratante']['extension_telefonica'] === null || getPaciente(item.id)['equipo_medico_paciente']['tratante']['extension_telefonica'] === 'Sin extensión' }]">
                                                <i class="fas fa-phone-alt"></i>
                                                {{
            getPaciente(item.id)['equipo_medico_paciente']['tratante']['extension_telefonica']
        }}
                                            </div>
                                            <!-- <div style="font-size:0.7rem;padding:0.1rem;font-weight:400" :class="['mr-1 badge badge-info',{'d-none':getPaciente(item.id)['equipo_medico_paciente']['tratante']['telefono_movil'] ===null }]">
                                                    <i class="fab fa-whatsapp"></i>
                                                    {{getPaciente(item.id)['equipo_medico_paciente']['tratante']['telefono_movil'].replace("+", "")}}
                                                </div> -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <!-- RESIDENTES -->
                        <td style="width:10% !important" class="glassmod-effect text-left p-1">
                            <!-- {{ getPaciente(item.id) !== undefined ? getPaciente(item.id)['equipo_medico_paciente']['residente'] :''  }} -->

                            <div v-if="getPaciente(item.id) !== undefined && getPaciente(item.id)['equipo_medico_paciente']['residente'] !== null"
                                :class="['text-left d-flex flex-wrap', { 'flex-column': getPaciente(item.id)['equipo_medico_paciente']['residente'].length > 1 }]">

                                <div v-for="(item2, index2) in getPaciente(item.id)['equipo_medico_paciente']['residente']"
                                    class="d-flex align-items-center">
                                    <img loading="lazy"
                                        onerror="this.src='/image/system/patient.svg'" :src="item2.imagen"
                                        class="img-doctor mr-1"
                                        :style="getPaciente(item.id)['equipo_medico_paciente']['residente'].length === 1 ? 'width: 35px; height: 35px; border-radius: 20px;' : 'width: 15px; height: 15px; border-radius: 20px;'">
                                    <div :class="['d-flex', (getPaciente(item.id)['equipo_medico_paciente']['residente'].length === 1 ? 'flex-column' : 'flex-row align-items-center')]"
                                        style="line-height:1.5rem;">
                                        <div class="text-nowrap overflow-hidden mr-1"
                                            style="width:auto !important;text-transform: capitalize !important;">

                                            {{ formatearNombrePaciente2(item2) }} <div
                                                :class="['badge mr-1', { ' badge-purple': item2.cat_user_medico_posicion_id === 9 }, { ' badge-secondary': [4, 5, 6, 7, 8].includes(item2.cat_user_medico_posicion_id) }]">
                                                {{ item2.cat_user_medico_posicion_id === 9 ? 'RA' : '' }}{{
            [4, 5, 6, 7, 8].includes(item2.cat_user_medico_posicion_id) ? 'RE' : ''
        }}
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div style="font-size:0.7rem;padding:0.2rem;font-weight:400"
                                                :class="['mr-1 mt-1 badge badge-primary nowrap', { 'd-none': getPaciente(item.id)['equipo_medico_paciente']['residente'].length > 1 }, { 'd-none': item2.especialidad === null || item2.especialidad === 'Sin Especialidad' }]">
                                                <i class="pc-medico"></i>
                                                {{ item2.especialidad }}
                                            </div>
                                            <div style="font-size:0.7rem;padding:0.2rem;font-weight:400"
                                                :class="['mr-1 mt-1 badge badge-warning', { 'd-none': item2.extension_telefonica === null || item2.extension_telefonica === 'Sin extensión' }]">
                                                <i class="fas fa-phone-alt"></i>
                                                {{ item2.extension_telefonica }}
                                            </div>

                                            <!-- <div style="font-size:0.7rem;padding:0.1rem;font-weight:400" :class="['mr-1 badge badge-info',{'d-none':getPaciente(item.id)['equipo_medico_paciente']['residente']['telefono_movil'] ===null }]">
                                                    <i class="fab fa-whatsapp"></i>
                                                    {{getPaciente(item.id)['equipo_medico_paciente']['residente']['telefono_movil'].replace("+", "")}}
                                                </div> -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <!-- ENFERMERIA -->
                        <td style="width:10% !important" class="glassmod-effect tbl-row-radius-right  text-left p-1">
                            <div v-if="getPaciente(item.id) !== undefined && getPaciente(item.id)['equipo_medico_paciente']['enfermeria'] !== null"
                                class="text-left d-flex flex-wrap align-items-center">
                                <div class="d-flex align-items-center">
                                    <img loading="lazy" onerror="this.src='/image/system/patient.svg'"
                                        :src="getPaciente(item.id)['equipo_medico_paciente']['enfermeria']['imagen']"
                                        class="img-doctor mr-1"
                                        style="width: 35px; height: 35px; border-radius: 20px;">
                                    <div class="d-flex flex-column" style="line-height:1.5rem;">
                                        <div class="text-nowrap overflow-hidden"
                                            style="width:auto !important;text-transform: capitalize !important;">

                                            {{ formatearNombrePacienteEnfermeria(
            getPaciente(item.id)['equipo_medico_paciente']['enfermeria']) }}
                                            <div :class="['badge ml-1', { ' badge-warning': true }]">EN</div>

                                        </div>
                                        <div class="d-flex">
                                            <!-- <div style="font-size:0.7rem;padding:0.1rem;font-weight:400" :class="['mr-1 badge badge-primary nowrap',{'d-none':getPaciente(item.id)['equipo_medico_paciente']['enfermeria']['especialidad'] ===null || getPaciente(item.id)['equipo_medico_paciente']['enfermeria']['especialidad'] ==='Sin Especialidad'}]">
                                                    <i class="pc-medico"></i>
                                                    {{getPaciente(item.id)['equipo_medico_paciente']['enfermeria']['especialidad'] }}
                                                </div> -->
                                            <div style="font-size:0.7rem;padding:0.2rem;font-weight:400"
                                                :class="['mr-1 badge badge-warning', { 'd-none': getPaciente(item.id)['equipo_medico_paciente']['enfermeria']['extension_telefonica'] ===null || getPaciente(item.id)['equipo_medico_paciente']['enfermeria']['extension_telefonica'] ==='Sin extensión'}]">
                                                <i class="fas fa-phone-alt"></i>
                                                {{getPaciente(item.id)['equipo_medico_paciente']['enfermeria']['extension_telefonica']}}
                                            </div>
                                            <!-- <div style="font-size:0.7rem;padding:0.1rem;font-weight:400" :class="['mr-1 badge badge-info',{'d-none':getPaciente(item.id)['equipo_medico_paciente']['enfermeria']['telefono_movil'] ===null }]">
                                                    <i class="fab fa-whatsapp"></i>
                                                    {{getPaciente(item.id)['equipo_medico_paciente']['enfermeria']['telefono_movil'].replace("+", "")}}
                                                </div> -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>





                </tbody>
            </table>
        </div>
        <GuardiasList />
    </div>

</template>
<script>

    import { get, is_null, horaPm, meses, is_undefined, formatAMPM, obtenerVariablesGET } from '../../../helpers/customHelpers?00001';
    import MenuPatientcare from '../../Menus/AreaHospitalizacionMenu.vue?00001';
    import Navbar1 from '../../Navbars/Navbar1.vue?00001';
    import CintilloSuperior from './components/CintilloSuperior.vue';
    //import CintilloInferior from './components/CintilloInferior.vue';
    import IndexPantallaPiso from './components/Index.vue';
    import GuardiasList from './components/GuardiasList.vue';

    //import { get } from '../../helpers/customHelpers.js';
    export default {
        name: "AppPantallaPisos",
        components: {
            MenuPatientcare,
            Navbar1,
            IndexPantallaPiso,
            CintilloSuperior,
            GuardiasList,
        },
        data() {
            return {
                relog_hora: "",
                catUbicacion: [],
                pacientes_activos: [],
                piso: "",
                ala: "",
                total_habitaciones_ocupadas: 0,
                total_habitaciones: 0,
                pisos: [
                    {
                        piso: 2,
                        ala: "a",
                        name: "Piso 2 A",
                        cat_ubicaciones_id: () => {
                            return this.catUbicacion.filter(x => Number(x["parent_cat_user_ubicacion_id"]) === 42)
                        },

                    },
                    {
                        piso: 2,
                        ala: "b",
                        name: "Piso 2 B",
                        cat_ubicaciones_id: () => {
                            return this.catUbicacion.filter(x => Number(x["parent_cat_user_ubicacion_id"]) === 42)
                        },
                    },
                    {
                        piso: 3,
                        ala: "a",
                        name: "Piso 3 A",
                        cat_ubicaciones_id: () => {
                            return this.catUbicacion.filter(x => Number(x["parent_cat_user_ubicacion_id"]) === 71)
                        },
                    },
                    {
                        piso: 3,
                        ala: "b",
                        name: "Piso 3 B",
                        cat_ubicaciones_id: () => {
                            return this.catUbicacion.filter(x => Number(x["parent_cat_user_ubicacion_id"]) === 235)
                        },
                    },
                    {
                        piso: 4,
                        ala: "a",
                        name: "Piso 4 A",
                        cat_ubicaciones_id: () => {
                            return this.catUbicacion.filter(x => Number(x["parent_cat_user_ubicacion_id"]) === 236)
                        },
                    },
                    {
                        piso: 4,
                        ala: "b",
                        name: "Piso 4 B",
                        cat_ubicaciones_id: () => {
                            return this.catUbicacion.filter(x => Number(x["parent_cat_user_ubicacion_id"]) === 99)
                        },
                    },
                    {
                        piso: 5,
                        ala: "a",
                        name: "Piso 5 A",
                        cat_ubicaciones_id: () => {
                            return this.catUbicacion.filter(x => Number(x["parent_cat_user_ubicacion_id"]) === 127)
                        },
                    },
                    {
                        piso: 5,
                        ala: "b",
                        name: "Piso 5 B",
                        cat_ubicaciones_id: () => {
                            return this.catUbicacion.filter(x => Number(x["parent_cat_user_ubicacion_id"]) === 234)
                        },
                    },
                    {
                        piso: 6,
                        ala: "a",
                        name: "Piso 6 A",
                        cat_ubicaciones_id: () => {
                            return this.catUbicacion.filter(x => Number(x["parent_cat_user_ubicacion_id"]) === 155)
                        },
                    },
                    {
                        piso: 6,
                        ala: "b",
                        name: "Piso 6 B",
                        cat_ubicaciones_id: () => {
                            return this.catUbicacion.filter(x => Number(x["parent_cat_user_ubicacion_id"]) === 155)
                        },
                    },
                ]
            }
        },
        methods: {
            formatearNombrePaciente(item) {
                //console.log("--->",item);
                let temp_nombres = item['nombres'].split(" ")
                let temp_apellidos = item['apellidos'].split(" ")
                return `${temp_apellidos[0]}. ${temp_nombres[0].slice(0, 1)}. `
            },
            /* formatearNombrePaciente2(item){
                //console.log("--->",item);
                    let temp_nombres = item['nombres'].split(" ")
                    let temp_apellidos = item['apellidos'].split(" ")
                    let temp_prefijo =  [null,undefined,'null','undefined',""].includes(item['prefijo']) ? '' : item['prefijo']+' ';
                    return `${temp_prefijo}${temp_apellidos[0]} ${temp_nombres[0].slice(0,1)}. `
            }, */
            formatearNombrePacienteEnfermeria(item) {

                let temp_nombres = ""
                if (!is_undefined(item)) {
                    temp_nombres = ((item['nombres'].split(" "))[0]).toLowerCase()
                }

                let temp_apellidos = ""
                if (!is_undefined(item)) {
                    temp_apellidos = (item['apellidos'].split(" "))[0]
                    if (temp_apellidos.length <= 3) {
                        if (item['apellidos'].split(" ")[1] !== undefined) {
                            temp_apellidos = (item['apellidos'].split(" ")[0] + " " + item['apellidos'].split(" ")[1]).toLowerCase()
                        }
                        // temp_apellidos = ((item['apellidos'].split(" "))[0] + " "+ ((item['apellidos'].split(" "))[1] !== 'undefined' ? item['apellidos'].split(" ")[1] : '')).toLowerCase()

                    }
                }
                let temp_prefijo = ""
                if (![null, undefined, 'null', 'undefined', ""].includes(item['prefijo'])) {
                    temp_prefijo = (item['prefijo'] + ' ').toLowerCase()
                }

                return `${temp_prefijo} ${temp_nombres} ${temp_apellidos} `
            },
            formatearNombrePaciente2(item) {

                let temp_nombres = ""
                if (!is_undefined(item)) {
                    temp_nombres = ((item['nombres'].split(" "))[0]).toLowerCase()
                }

                let temp_apellidos = ""
                if (!is_undefined(item)) {
                    temp_apellidos = ((item['apellidos'].split(" "))[0]).toLowerCase()
                    if (temp_apellidos.length <= 3) {
                        if (item['apellidos'].split(" ")[1] !== undefined) {
                            temp_apellidos = (item['apellidos'].split(" ")[0] + " " + item['apellidos'].split(" ")[1]).toLowerCase()
                        }
                        // temp_apellidos = ((item['apellidos'].split(" "))[0] + " "+ ((item['apellidos'].split(" "))[1] !== 'undefined' ? item['apellidos'].split(" ")[1] : '')).toLowerCase()

                    }
                }
                let temp_prefijo = ""
                if (![null, undefined, 'null', 'undefined', ""].includes(item['prefijo'])) {
                    temp_prefijo = (item['prefijo'] + ' ').toLowerCase()
                }

                return `${temp_prefijo}${temp_apellidos}, ${temp_nombres.slice(0, 1)}.`
            },
            getFechaPreAlta(item) {
                let prealta = this.getPaciente(item.id)['pre_alta']
                if (!is_null(prealta)) {
                    let fecha = prealta.split(" ")
                    fecha = fecha[0].split("-")
                    //console.log(fecha);
                    let f = new Date(fecha[0], (parseInt(fecha[1]) - 1), fecha[2]);
                    let fechaIngreso = f.getFullYear() + "-" + (f.getMonth()) + "-" + f.getDate();
                    fechaIngreso = f.getDate() + "-" + meses(f.getMonth()).slice(0, 3)  /* + "-" +  f.getFullYear() */;
                    return fechaIngreso

                } else {
                    return ""
                }

            },
            getColorPrealta(item) {
                console.log(item)
                return 'bg-' + this.getPaciente(item.id)['pre_alta_color']
            },
            getPaciente(habId) {
                return this.pacientes_activos.find(x => Number(x["cat_user_ubicacion_id"]) === Number(habId))
            },
            async getPacientesActivos() {
                try {
                    this.$store.commit('updateProperty', {
                        fieldName: 'loading',
                        fieldValue: true,
                    });
                    // let model =  await get(location.origin + '/medico/getMedicos' )
                    this.pacientes_activos = await get(location.origin + "/episodio/pacientes_activos/hospitalizacion");
                    /* this.$store.commit('updateProperty', {
                        fieldName: 'pacientes_activos',
                        fieldValue: model,
                    }) */
                    this.$store.commit('updateProperty', {
                        fieldName: 'loading',
                        fieldValue: false,
                    });
                } catch (error) {
                    console.error('Error al obtener los datos:', error);
                    this.$store.commit('updateProperty', {
                        fieldName: 'loading',
                        fieldValue: false,
                    });
                    return []
                }
            },
            async getCatUbicaciones() {
                try {
                    this.$store.commit('updateProperty', {
                        fieldName: 'loading',
                        fieldValue: true,
                    });
                    // let model =  await get(location.origin + '/medico/getMedicos' )
                    this.catUbicacion = await get(location.origin + "/cat_user_ubicacion/getAll");
                    /* this.$store.commit('updateProperty', {
                        fieldName: 'catUbicacion',
                        fieldValue: model,
                    }) */
                    this.$store.commit('updateProperty', {
                        fieldName: 'loading',
                        fieldValue: false,
                    });
                } catch (error) {
                    console.error('Error al obtener los datos:', error);
                    this.$store.commit('updateProperty', {
                        fieldName: 'loading',
                        fieldValue: false,
                    });
                    return []
                }
            },
        },
        computed: {
            getTitleArea() {
                return this.titleArea
            },
            mostrarLoading() {
                return this.$store.getters.mostrarLoading
            },
            getHabitaciones() {
                let ruta = obtenerVariablesGET(location.href)
                let area = this.pisos.find(x => Number(x['piso']) === Number(ruta.piso) && x['ala'] === ruta.ala)
                let ubicaciones = this.catUbicacion.filter(x => area.cat_ubicaciones_id().map(x => Number(x['id'])).includes(Number(x["id"])))
                this.total_habitaciones_ocupadas = ubicaciones.filter(x => {
                    if (this.getPaciente(x.id) !== undefined) {
                        return x
                    }
                }).length
                this.total_habitaciones = ubicaciones.length
                return ubicaciones
            },
        },
        mounted: async function () {
            await this.getCatUbicaciones()
            await this.getPacientesActivos()
            let that = this
            let ruta = obtenerVariablesGET(location.href)
            let area = this.pisos.find(x => Number(x['piso']) === Number(ruta.piso) && x['ala'] === ruta.ala)
            this.piso = Number(ruta.piso)
            this.ala = ruta.ala
            setInterval(() => {
                let date = new Date()
                let hora = date.getHours()
                let ampm = hora > 12 ? 'PM' : 'AM'
                hora = horaPm[String(hora)]
                that.relog_hora = formatAMPM(date)
                /* this.$store.commit('updateProperty',{
                    property:'relog_hora',
                    value:
                }) */
            }, 1000)
            setInterval(async () => {
                await this.getPacientesActivos()
            }, 10000);
        },

    }

</script>
<style>
    .bg-success {
        background-color: var(--success) !important;
    }

    .badge-pink {
        color: #ffffff;
        background-color: #f278b0;
    }

    .text-success-cirugia,
    .text-success-resbalar,
    .text-success-alert {
        color: #06ff3f !important;
    }

    .miModal-options:hover {

        background-color: rgb(0 0 0 / 20%);
        cursor: pointer;
        border-radius: 10px;

    }

    body {
        background-color: #233a6d !important;
        /*background-color: #185ba9;*/
        /*  background: url("/image/system/background_quirofano.jpg") no-repeat center center fixed;

            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover; */
    }

    /*body {
        background-color: #F6F8FC !important;
        color:var(--secondary);
    }*/
    .rounded-1 {
        border-radius: 1rem
    }

    .img-user-size {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .btn-user-home .username {
        font-weight: bold;
        font-size: 1.5rem;
    }

    .loadingScreen {
        background-color: rgb(0, 0, 0, 0.5);
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: fixed;
        z-index: 1111111111111111;
        height: 100vh;
        width: 100%;
    }

    /* Ejemplo de estilos para una transición de desvanecimiento */
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.5s;
    }

    .fade-enter,
    .fade-leave-to

    /* .fade-leave-active in <2.1.8 */
        {
        opacity: 0;
    }

    .img-logo {
        height: 50px;
        width: 120px;
    }

    /*.hide{

    }*/
    .btn-primary-custom {
        color: #ffffff;
        background-color: #5b96df !important;
    }

    .swing-in-top-fwd {
        -webkit-animation: swing-in-top-fwd 2s cubic-bezier(.175, .885, .32, 1.275) both;
        animation: swing-in-top-fwd 2s cubic-bezier(.175, .885, .32, 1.275) both
    }

    @-webkit-keyframes swing-in-top-fwd {
        0% {
            -webkit-transform: rotateX(-100deg);
            transform: rotateX(-100deg);
            -webkit-transform-origin: top;
            transform-origin: top;
            opacity: 0
        }

        100% {
            -webkit-transform: rotateX(0deg);
            transform: rotateX(0deg);
            -webkit-transform-origin: top;
            transform-origin: top;
            opacity: 1
        }
    }

    @keyframes swing-in-top-fwd {
        0% {
            -webkit-transform: rotateX(-100deg);
            transform: rotateX(-100deg);
            -webkit-transform-origin: top;
            transform-origin: top;
            opacity: 0
        }

        100% {
            -webkit-transform: rotateX(0deg);
            transform: rotateX(0deg);
            -webkit-transform-origin: top;
            transform-origin: top;
            opacity: 1
        }
    }

    .sidebar {
        width: 0px;
        transform: translateX(-100%);
        visibility: hidden;
        opacity: 0;
        transition: width 0.5s, opacity 0.5s;
        padding-left: 0;
        padding-right: 0;
    }

    .sidebar-right {
        width: 0px;
        transform: translateX(100%);
        visibility: hidden;
        opacity: 0;
        transition: width 0.5s, opacity 0.5s;
        padding-left: 0;
        padding-right: 0;
    }

    .sidebar.show {
        visibility: visible;
        width: 250px;
        transform: translateX(0%);
        opacity: 1;
    }

    .content {
        border-radius: 1.5rem;
        /*height: 90vh;*/
    }

    .content.hide {

        transition: all 1.5s;
    }

    .shadow-box {
        -webkit-box-shadow: inset 0px 0px 3px 0px rgba(0, 0, 0, 0.30);
        -moz-box-shadow: inset 0px 0px 3px 0px rgba(0, 0, 0, 0.30);
        box-shadow: inset 0px 0px 3px 0px rgba(0, 0, 0, 0.30);
    }

    .bg-body-gray {
        /*background-color: #F6F8FC !important;*/
        background-color: #6c6c6d !important;
    }

    .bg-gray-1 {
        /*background-color: #F6F8FC !important;*/
        background-color: #F6F8FC !important;
    }

    .bg-info-menu {
        /*background-color: #F6F8FC !important;*/
        background-color: #eaf1fb !important;
    }

    .btn-rounded-pill-custom {
        border-radius: 19px !important;
    }

    .btn-primary-custom {
        color: #ffffff;
        background-color: #5b96df !important;
    }

    .sticky {
        position: sticky;
        top: 0px;
    }

    .valign-center {
        vertical-align: middle;
    }

    .bg-gray-1 {
        /*background-color: #F6F8FC !important;*/
        background-color: #F6F8FC !important;
    }

    .tbl-row-radius-left {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }

    .tbl-row-radius-right {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .corner-radius-top-left {
        border-top-left-radius: 10px;
    }

    .corner-radius-bottom-left {
        border-bottom-left-radius: 10px;
    }

    .loadingScreen {
        background-color: rgb(0, 0, 0, 0.5);
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: fixed;
        z-index: 1111111111111111;
        height: 100vh;
        width: 100%;
    }

    /* Ejemplo de estilos para una transición de desvanecimiento */
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.5s;
    }

    .fade-enter,
    .fade-leave-to

    /* .fade-leave-active in <2.1.8 */
        {
        opacity: 0;
    }

    .row_counter_user div:nth-child(1) {
        width: 15px;
        text-align: center;
    }

    .row_counter_user div:nth-child(2) {
        width: 30px;
        text-align: center;
    }

    .rounded-pill-1 {
        border-radius: 20px;
    }

    .rounded-top-pill {
        border-top-right-radius: 20px;
        border-top-left-radius: 20px;
    }

    .rounded-bottom-pill {
        border-bottom-right-radius: 20px;
        border-bottom-left-radius: 20px;
    }

    .total-title {
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .total-counter {
        line-height: 1;
    }

    .total-icon {
        font-size: 2em;
    }


    .rounded-custom-1 {
        border-radius: 1.25rem;
    }

    :root {
        --radius-table-row: 10px;
        /*  --table-border-row-color:rgb(240, 240, 241); */
    }



    .shadow-1 {
        text-shadow: 1px 1px 2px rgb(0 0 0 / 100%);
    }

    .glassmod-effect {
        background-color: rgb(255 255 255 / 30%);
        backdrop-filter: blur(20px);
    }

    .router-link-active,
    .glassmod-effect-btn:hover {
        background-color: rgb(255 255 255 / 59%);
    }

    .corner-radius-top-left {
        border-top-left-radius: var(--radius-table-row);
    }

    .corner-radius-bottom-left {
        border-bottom-left-radius: var(--radius-table-row);
    }

    .tbl-row-radius-left {
        border-top-left-radius: var(--radius-table-row);
        border-bottom-left-radius: var(--radius-table-row);
        border-left: 1px solid var(--table-border-row-color);
        border-top: 1px solid var(--table-border-row-color);
        border-bottom: 1px solid var(--table-border-row-color);
    }

    .tbl-row-radius-right {
        border-top-right-radius: var(--radius-table-row);
        border-bottom-right-radius: var(--radius-table-row);
        border-right: 1px solid var(--table-border-row-color);
        border-top: 1px solid var(--table-border-row-color);
        border-bottom: 1px solid var(--table-border-row-color);
    }

    .sticky-top {
        position: sticky;
    }

    .text-shadow {
        text-shadow: 2px 2px 5px rgba(43, 19, 12, 0.50);
    }



    .img-logo {
        height: 50px;
        width: 120px;
    }

    .swing-in-top-fwd {
        -webkit-animation: swing-in-top-fwd 2s cubic-bezier(.175, .885, .32, 1.275) both;
        animation: swing-in-top-fwd 2s cubic-bezier(.175, .885, .32, 1.275) both
    }

    @-webkit-keyframes swing-in-top-fwd {
        0% {
            -webkit-transform: rotateX(-100deg);
            transform: rotateX(-100deg);
            -webkit-transform-origin: top;
            transform-origin: top;
            opacity: 0
        }

        100% {
            -webkit-transform: rotateX(0deg);
            transform: rotateX(0deg);
            -webkit-transform-origin: top;
            transform-origin: top;
            opacity: 1
        }
    }

    @keyframes swing-in-top-fwd {
        0% {
            -webkit-transform: rotateX(-100deg);
            transform: rotateX(-100deg);
            -webkit-transform-origin: top;
            transform-origin: top;
            opacity: 0
        }

        100% {
            -webkit-transform: rotateX(0deg);
            transform: rotateX(0deg);
            -webkit-transform-origin: top;
            transform-origin: top;
            opacity: 1
        }
    }

    .h-100 {
        height: 100vh;
    }

    ul,
    li {
        margin: 0 0 0 0;
        padding: 0 0 0 0;
    }

    .blink-2 {
        -webkit-animation: blink-2 1s infinite both;
        animation: blink-2 1s infinite both
    }

    @-webkit-keyframes blink-2 {
        0% {
            opacity: 1
        }

        50% {
            opacity: .2
        }

        100% {
            opacity: 1
        }
    }

    @keyframes blink-2 {
        0% {
            opacity: 1
        }

        50% {
            opacity: .2
        }

        100% {
            opacity: 1
        }
    }

    .rotate-in-ver {
        -webkit-animation: rotate-in-ver .5s cubic-bezier(.25, .46, .45, .94) both;
        animation: rotate-in-ver .5s cubic-bezier(.25, .46, .45, .94) both
    }

    @-webkit-keyframes rotate-in-ver {
        0% {
            -webkit-transform: rotateY(-360deg);
            transform: rotateY(-360deg);
            opacity: 0
        }

        100% {
            -webkit-transform: rotateY(0deg);
            transform: rotateY(0deg);
            opacity: 1
        }
    }

    @keyframes rotate-in-ver {
        0% {
            -webkit-transform: rotateY(-360deg);
            transform: rotateY(-360deg);
            opacity: 0
        }

        100% {
            -webkit-transform: rotateY(0deg);
            transform: rotateY(0deg);
            opacity: 1
        }
    }
</style>
