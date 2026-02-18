<template>
    <div class="container-fluid d-flex flex-column py-2 overflow-auto flex-fill">
        <div data-toggle="modal" data-target="#modelId" class="miModal-options cursor-pointer h3 my-2 text-white text-center font-weight-bold text-uppercase">
            PACIENTES EN {{ titleArea }}
        </div>
        <div class="container-fluid d-flex py-2 overflow-auto flex-fill">
            <table class="w-100">
                <thead>
                    <tr class="text-center text-white">
                        <th class="sticky-top">HAB</th>
                        <th class="sticky-top">PACIENTE</th>
                        <th class="sticky-top">MÉDICO TRATANTE</th>
                        <th class="sticky-top">RESIDENTE</th>
                        <th class="sticky-top">ENFERMERA</th>
                        <th class="sticky-top">RIESGOS / ALERTAS</th>
                        <th class="sticky-top">OBSERVACIONES / PENDIENTES</th>
                    </tr>
                </thead>
                <tbody>

                    <tr v-for="(item,index) in $store.state.pacientes_activos" :key="index" class="text-white text-center swing-in-top-fwd shadow-sm">
                        <!-- HABITACION -->
                        <td class="tbl-row-radius-left bg-info-piso h3 font-weight-bold">
                            {{item.cat_user_ubicacion_coments.replace("Hab. ","")}}
                        </td>
                        <!-- PACIENTE -->
                        <td class="glassmod-effect text-left">
                            <h4>{{ formatearNombrePaciente(item) }}</h4>
                            <div class="d-flex">
                                <div class="text-uppercase d-flex align-items-center text-nowrap">
                                    <i class="fas fa-id-card mr-1" style="font-size: 0.8rem; color: #c2c2cc;"></i>
                                    <div class="h5 mb-0">
                                        {{ item.nacionalidad + item.cedula }}
                                    </div>
                                </div>
                                <div class="border-right px-0 py-1 mx-1 border-white"></div>
                                <div class="text-uppercase d-flex align-items-center text-nowrap">
                                    <i class="fas fa-venus-mars mr-1" style="font-size: 0.8rem; color: #c2c2cc;"></i>
                                    <div class="h5 mb-0">
                                        {{ item.genero }}
                                    </div>
                                </div>
                                <div class="border-right px-0 py-1 mx-1 border-white"></div>
                                <div class="text-uppercase d-flex align-items-center text-nowrap">
                                    <i class="fas fa-birthday-cake mr-1" style="font-size: 0.8rem; color: #c2c2cc;"></i>
                                    <div class="h5 mb-0">
                                        {{ item.edad }} A
                                    </div>
                                </div>

                            </div>
                        </td>
                        <!-- TRATANTE -->
                        <td class="glassmod-effect">

                            <div class="text-left mb-1"  v-for="(medico, index_medico) in item.equipo_medico_paciente.filter(x=>[1,2].includes(Number(x['cat_user_medico_posicion_id'])))" :key="index_medico">
                                <div class="d-flex align-items-center">
                                    <img loading="lazy" style="width:30px;height:30px;border-radius:20px;object-fit: fill !important;" class="img-doctor mr-1" onerror="this.src='/image/system/patient.svg'" :src="medico.imagen">
                                    <div>{{ formatearNombrePaciente(medico) }}</div>
                                </div>
                                <div :class="['badge badge-primary',{'d-none':medico.especialidad ===null || medico.especialidad ==='Sin Especialidad'}]">
                                    <i class="pc-medico"></i>
                                    {{medico.especialidad}}
                                </div>
                                <div :class="['badge badge-warning',{'d-none':medico.extension_telefonica ===null || medico.extension_telefonica ==='Sin extensión'}]">
                                    <i class="fas fa-phone-alt"></i>
                                    {{medico.extension_telefonica}}
                                </div>
                                <div :class="['badge badge-info',{'d-none':medico.telefono_movil ===null }]">
                                    <i class="fab fa-whatsapp"></i>
                                    {{medico.telefono_movil.replace("+", "")}}
                                </div>
                            </div>

                        </td>
                        <!-- RESIDENTES -->
                        <td class="glassmod-effect">
                            <div class="text-left mb-1"  v-for="(medico, index_medico) in item.equipo_medico_paciente.filter(x=>[5,6,7,8].includes(Number(x['cat_user_medico_posicion_id'])))" :key="index_medico">
                                <div class="d-flex align-items-center">
                                    <img loading="lazy" style="width:30px;height:30px;border-radius:20px;object-fit: fill !important;" class="img-doctor mr-1" onerror="this.src='/image/system/patient.svg'" :src="medico.imagen">
                                    <div>{{ formatearNombrePaciente(medico) }}</div>
                                </div>
                                <div :class="['badge badge-primary',{'d-none':medico.especialidad ===null || medico.especialidad ==='Sin Especialidad'}]">
                                    <i class="pc-medico"></i>
                                    {{medico.especialidad}}
                                </div>
                                <div :class="['badge badge-warning',{'d-none':medico.extension_telefonica ===null || medico.extension_telefonica ==='Sin extensión'}]">
                                    <i class="fas fa-phone-alt"></i>
                                    {{medico.extension_telefonica}}
                                </div>
                                <div :class="['badge badge-info',{'d-none':medico.telefono_movil ===null }]">
                                    <i class="fab fa-whatsapp"></i>
                                    {{medico.telefono_movil.replace("+", "")}}
                                </div>
                            </div>

                        </td>
                        <!-- ENFERMERÍA -->
                        <td class="glassmod-effect">
                            <div class="text-left mb-1"  v-for="(medico, index_medico) in item.equipo_medico_paciente.filter(x=>[10].includes(Number(x['cat_user_medico_posicion_id'])))" :key="index_medico">
                                <div class="d-flex align-items-center">
                                    <img loading="lazy" style="width:30px;height:30px;border-radius:20px;object-fit: fill !important;" class="img-doctor mr-1" onerror="this.src='/image/system/patient.svg'" :src="medico.imagen">
                                    <div>{{ formatearNombrePaciente(medico) }}</div>
                                </div>
                                <div :class="['badge badge-primary',{'d-none':medico.especialidad ===null || medico.especialidad ==='Sin Especialidad'}]">
                                    <i class="pc-medico"></i>
                                    {{medico.especialidad}}
                                </div>
                                <div :class="['badge badge-warning',{'d-none':medico.extension_telefonica ===null || medico.extension_telefonica ==='Sin extensión'}]">
                                    <i class="fas fa-phone-alt"></i>
                                    {{medico.extension_telefonica}}
                                </div>
                                <div :class="['badge badge-info',{'d-none':medico.telefono_movil ===null }]">
                                    <i class="fab fa-whatsapp"></i>
                                    {{medico.telefono_movil.replace("+", "")}}
                                </div>
                            </div>

                        </td>
                        <!-- RIESGOS/ALERTAS -->
                        <td class="glassmod-effect">

                            <div class="d-flex justify-content-around align-items-center">
                                <i :class="['pc-cirugia',{'text-danger heartbeat-2':item.cirugia_riesgo_value===1},{'text-warning heartbeat ':item.cirugia_riesgo_value===2},{'text-white':item.cirugia_riesgo_value===3},]" ></i>
                                <i :class="['pc-resbalar',{'text-danger heartbeat-2':item.resbalar_riesgo_value===1},{'text-warning heartbeat ':item.resbalar_riesgo_value===2},{'text-white':item.resbalar_riesgo_value===3},]" ></i>
                                <i :class="[{'pc-alerta_alta text-danger heartbeat-2':item.alerta_riesgo_value===1},{'pc-alerta_intermedia heartbeat  text-warning':item.alerta_riesgo_value===2},{'pc-alerta_estable text-white':item.alerta_riesgo_value===3},]"></i>
                                <i :class="['pc-paciente_vip',{'text-info':item.user_vip_value===1}]"></i>
                            </div>
                        </td>
                        <!-- OBSERVACIONES/PENDIENTES -->
                        <td class="glassmod-effect tbl-row-radius-right" style="font-size: 0.9rem;">
                            <!-- {{ item }} -->

                            <div v-for="(pendiente,index) in item.pendientes" :key="index" class="d-flex text-left align-items-center">
                                <span :class="['badge badge-info mr-1']">
                                    <i :class="['pc-pendiente_paciente']"></i>
                                </span>
                                <div class="d-flex flex-column align-items-start">
                                    <b>{{ pendiente.title }}</b>
                                    <div>{{ pendiente.description }}</div>
                                </div>


                            </div>
                            <div v-if="item.user_vip_description !==null" class="d-flex text-left align-items-center">
                                <span :class="['badge badge-info mr-1']">
                                    <i :class="['pc-paciente_vip']"></i>
                                <!--  VIP: -->
                                </span>
                                {{ item.user_vip_description }}
                            </div>
                            <div v-if="item.alerta_riesgo_description !==null" class="d-flex text-left align-items-center">
                                <span :class="['badge mr-1',{'badge-danger':item.alerta_riesgo_value===1},{'badge-warning':item.alerta_riesgo_value===2},{'badge-success':item.alerta_riesgo_value===3},]">
                                    <i :class="[{'pc-alerta_alta':item.alerta_riesgo_value===1},{'pc-alerta_intermedia':item.alerta_riesgo_value===2},{'pc-alerta_estable':item.alerta_riesgo_value===3},]"></i>
                                    <!-- Riesgo: -->
                                </span>
                                {{ item.alerta_riesgo_description }}
                            </div>
                            <div v-if="item.resbalar_riesgo_description !==null" class="d-flex text-left align-items-center">
                                <span :class="['badge mr-1',{'badge-success':item.resbalar_riesgo_value===3},{'badge-warning':item.resbalar_riesgo_value===2},{'badge-danger':item.resbalar_riesgo_value===1},]">
                                    <i :class="['pc-resbalar']"></i>
                                    <!-- Riesgo Caida: -->
                                </span>
                                {{ item.resbalar_riesgo_description }}
                            </div>
                            <div v-if="item.resbalar_riesgo_description !==null" class="d-flex text-left align-items-center">
                                <span :class="['badge mr-1',{'badge-success':item.cirugia_riesgo_value===3},{'badge-warning':item.cirugia_riesgo_value===2},{'badge-danger':item.cirugia_riesgo_value===1},]">
                                    <i :class="['pc-cirugia']"></i>
                                    <!-- Riesgo Cirugía: -->
                                </span>
                                {{ item.resbalar_riesgo_description }}
                            </div>


                        </td>
                        <!-- <td class="glassmod-effect text-danger">
                            UCI
                        </td>
                        <td class="glassmod-effect">
                            <i class="pc-warning h2 text-danger"></i>
                        </td> -->

                        <!-- <td class="glassmod-effect">
                            <div class="badge badge-danger">Dolor</div>
                        </td>
                        -->
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import { get,timestamps,obtenerVariablesGET, fechaHoy,formatFecha,is_null,relog,horaPm,formatAMPM,mesesEnEspanol,is_undefined } from '../../../../helpers/customHelpers.js';

    export default {
        name:"IndexPantallaPiso",
        titleArea:"",
        data(){
            return {
                title:"",
                pisos:[
                    {
                        piso:2,
                        ala:"a",
                        name:"Piso 2 A",
                        cat_ubicaciones_id:[],
                    },
                    {
                        piso:2,
                        ala:"b",
                        name:"Piso 2 B",
                        cat_ubicaciones_id:[],
                    },
                    {
                        piso:3,
                        ala:"a",
                        name:"Piso 3 A",
                        cat_ubicaciones_id:[],
                    },
                    {
                        piso:3,
                        ala:"b",
                        name:"Piso 3 B",
                        cat_ubicaciones_id:[],
                    },
                    {
                        piso:4,
                        ala:"a",
                        name:"Piso 4 A",
                        cat_ubicaciones_id:[],
                    },
                    {
                        piso:4,
                        ala:"b",
                        name:"Piso 4 B",
                        cat_ubicaciones_id:[],
                    },
                    {
                        piso:5,
                        ala:"a",
                        name:"Piso 5 A",
                        cat_ubicaciones_id:[],
                    },
                    {
                        piso:5,
                        ala:"b",
                        name:"Piso 5 B",
                        cat_ubicaciones_id:[],
                    },
                    {
                        piso:6,
                        ala:"a",
                        name:"Piso 6 A",
                        cat_ubicaciones_id:[],
                    },
                    {
                        piso:6,
                        ala:"b",
                        name:"Piso 6 B",
                        cat_ubicaciones_id:[],
                    },
                ]
            }
        },
        methods: {
            formatearNombrePaciente(item){
                let temp_nombres = item['nombres'].split(" ")
                let temp_apellidos = item['apellidos'].split(" ")
                if(temp_apellidos.length < 4){
                    temp_apellidos = temp_apellidos[0] + ' ' + temp_apellidos[1]
                }
                return `${temp_nombres[0]} ${temp_apellidos[0]}`
            },
        },
        mounted(){
            let ruta = obtenerVariablesGET( location.href )
            let area = this.pisos.find(x=> Number(x['piso']) === Number(ruta.piso) &&  x['ala'] === ruta.ala )
                this.titleArea = area.name
        }
    }
</script>

<style >
    .heartbeat {
        -webkit-animation: heartbeat 1.5s ease-in-out infinite both;
        animation: heartbeat 1.5s ease-in-out infinite both
    }
    .heartbeat-2 {
        -webkit-animation: heartbeat 1s ease-in-out infinite both;
        animation: heartbeat 1s ease-in-out infinite both
    }

    @-webkit-keyframes heartbeat {
        from {
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-transform-origin: center center;
            transform-origin: center center;
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out
        }
        10% {
            -webkit-transform: scale(.91);
            transform: scale(.91);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in
        }
        17% {
            -webkit-transform: scale(.98);
            transform: scale(.98);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out
        }
        33% {
            -webkit-transform: scale(.87);
            transform: scale(.87);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in
        }
        45% {
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out
        }
    }

    @keyframes heartbeat {
        from {
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-transform-origin: center center;
            transform-origin: center center;
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out
        }
        10% {
            -webkit-transform: scale(.91);
            transform: scale(.91);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in
        }
        17% {
            -webkit-transform: scale(.98);
            transform: scale(.98);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out
        }
        33% {
            -webkit-transform: scale(.87);
            transform: scale(.87);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in
        }
        45% {
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out
        }
    }

    .ping {
        -webkit-animation: ping 2s ease-in-out infinite both;
        animation: ping 2s ease-in-out infinite both
    }

    @-webkit-keyframes ping {
        0% {
            -webkit-transform: scale(.2);
            transform: scale(.2);
            opacity: .8
        }
        80% {
            -webkit-transform: scale(1.2);
            transform: scale(1.2);
            opacity: 0
        }
        100% {
            -webkit-transform: scale(2.2);
            transform: scale(2.2);
            opacity: 0
        }
    }

    @keyframes ping {
        0% {
            -webkit-transform: scale(.2);
            transform: scale(.2);
            opacity: .8
        }
        80% {
            -webkit-transform: scale(1.2);
            transform: scale(1.2);
            opacity: 0
        }
        100% {
            -webkit-transform: scale(2.2);
            transform: scale(2.2);
            opacity: 0
        }
    }
    .ping-2 {
        -webkit-animation: ping .5s ease-in-out infinite both;
        animation: ping .5s ease-in-out infinite both
    }
    @-webkit-keyframes ping {
        0% {
            -webkit-transform: scale(.2);
            transform: scale(.2);
            opacity: .8
        }
        80% {
            -webkit-transform: scale(1.2);
            transform: scale(1.2);
            opacity: 0
        }
        100% {
            -webkit-transform: scale(2.2);
            transform: scale(2.2);
            opacity: 0
        }
    }
    @keyframes ping {
        0% {
            -webkit-transform: scale(.2);
            transform: scale(.2);
            opacity: .8
        }
        80% {
            -webkit-transform: scale(1.2);
            transform: scale(1.2);
            opacity: 0
        }
        100% {
            -webkit-transform: scale(2.2);
            transform: scale(2.2);
            opacity: 0
        }
    }

    .badge {
        display: inline-block;
        padding: 0.25em 0.4em;
        font-size: 75%;
        font-weight: 500;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    table {
        width: 100%;
        border-collapse: separate !important;
        /* border-spacing: 4px 10px; */
        /* Espaciado vertical entre filas */
    }

    tr {
        font-size: 1.1rem;
    }

    th,
    td {
        padding: 5px;
    }

    td {
        /* height: 80px; */
        height: fit-content;
    }
    .bg-info-piso {
        background-color: rgb(0 170 255 / 50%) !important;
    }
    .text-success-custom-1 {
        color: #05f33c !important;
    }
    .bg-success {
        background-color: #05f33c !important;
    }
    .sticky-top{
        position:sticky;
        top:-8px;
        background-color: #233a6d !important;
    }
    /*.badge-success {
        color: #ffffff;
        background-color: #05f33c;
    }*/
</style>
