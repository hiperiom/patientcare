<template>
    <div class="d-flex flex-column vh-100 overflow-auto">
        <div id="loadingScreen" :class="{'loadingScreen':true,'d-none': !mostrarLoading}">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <img loading="lazy" onerror="this.src='/image/system/patient.svg'" src="/image/system/logo-cmdlt-blanco.svg" class="mb-3" alt="Cmdlt" style="width: 140px; height: 80px">
                <div class="d-flex align-items-center  text-white justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden"></span>
                    </div>
                    <h4 class="pl-2 ">Por favor espere un momento...</h4>
                </div>
            </div>
        </div>
        <div class="flex-shrink-1 overflow-auto container-fluid  py-2 text-white d-flex align-items-center justify-content-between">

            <div @click="reloadData" class="cursor-pointer flex flex-shrink-1 px-2">
                <i class="pc-fa-patientcare-logo  h3 mb-0"></i>
            </div>

            <a href="#"  class=" text-white border-0 col py-1 px-2 m-1  d-flex shadow-1 align-items-center rounded-custom-1">
                <i class="pc-ambulatorio h1 mb-0 mr-1"></i>
                <h3 class="mb-0">TORRE<br>MAPM</h3>
            </a>
            <a href="#" @click="handle_fecha_reporte" class="glassmod-effect glassmod-effect-btn text-white border-0 col py-1 px-2 m-1  d-flex shadow-1 flex-column align-items-center rounded-custom-1">
                <div class="d-flex align-items-center">

                    <div id="clock" class="d-flex align-items-center" style="font-size: 45px;">
                        <div class="dia mr-1">{{$store.state.relog_dia}}</div>
                        <div class="mx-1">|</div>
                        <div class="mr-1 mes text-uppercase">{{$store.state.relog_mes}}</div>
                    </div>
                    <div class="d-flex flex-column align-items-start">
                        <div class="anio" style="font-size: 2rem;line-height:1;">{{$store.state.relog_anio}}</div>
                        <div class="hora text-nowrap" style="font-size: 1.3rem;line-height: 1;">{{relog_hora}}</div>
                    </div>
                </div>
                <div id="fechaHoy" class="d-flex"></div>
            </a>
            <a class="glassmod-effect  col py-1 px-2 m-1 rounded-custom-1" to="/areaQuirofanoAmb/externo/iqx">
                <div class="d-flex justify-content-between align-items-center text-white">
                    <div class="shadow-1" style="font-size: 1.5rem; line-height: 1;">
                        Total IQX<br>
                        Programadas
                    </div>
                    <b id="total_cirugias" class="text-white shadow-1 mr-3" style="font-size: 3rem;">
                        <div class="ml-2 px-2 d-flex justify-content-center">
                            <div class="d-flex flex-column align-items-center">
                                <small style="font-size: 14px;" title="Ejecutadas">EJEC</small>
                                <div style="line-height: 1;">{{ $store.state.solicitudes.filter(x => x.h_fin !== null).length }}</div>
                            </div>
                            <div class="mx-1 text-center"><b class=" border-left border-white"></b></div>
                            <div  class="d-flex flex-column align-items-center">
                                <small style="font-size: 14px;" title="Programadas">PROG</small>
                                <div  style="line-height: 1;">{{ $store.state.solicitudes.length }}</div>
                            </div>
                        </div>

                    </b>
                </div>
            </a>
            <a class="glassmod-effect col py-1 px-2 m-1 rounded-custom-1" to="/areaQuirofanoAmb/externo/iqx_hosp">
                <div class="d-flex justify-content-between align-items-center text-white">
                    <div class="shadow-1" style="font-size: 1.5rem; line-height: 1;">
                        Total IQX<br>
                        Oftalmológicas
                    </div>
                    <b id="total_hospitalizacion" class="text-white shadow-1 mr-3" style="font-size: 3rem;">
                        <div class="ml-2 px-2 d-flex justify-content-center">
                            <div class="d-flex flex-column align-items-center">
                                <small style="font-size: 14px;" title="Ejecutadas">EJEC</small>
                                <div style="line-height: 1;">{{ totalEjeOftal }}</div>
                            </div>
                            <div class="mx-1 text-center"><b class=" border-left border-white"></b></div>
                            <div  class="d-flex flex-column align-items-center">
                                <small style="font-size: 14px;" title="Programadas">PROG</small>
                                <div  style="line-height: 1;">{{ $store.state.solicitudes.filter(x=>[
                           424
                            ].includes( Number( x['area_intervencion'] ) )).length }}</div>
                            </div>
                        </div>

                    </b>
                </div>
            </a>
            <a class="glassmod-effect col py-1 px-2 m-1 rounded-custom-1" >
                <div class="d-flex justify-content-between align-items-center text-white">
                    <div class="shadow-1" style="font-size: 1.5rem; line-height: 1;">
                        Total IQX<br>
                        Especialidades
                    </div>
                    <b id="total_ambulatoria" class="text-white shadow-1 mr-3" style="font-size: 3rem;">
                        <div class="ml-2 px-2 d-flex justify-content-center">
                            <div class="d-flex flex-column align-items-center">
                                <small style="font-size: 14px;" title="Ejecutadas">EJEC</small>
                                <div style="line-height: 1;">{{totalEjeEspe}}</div>
                            </div>
                            <div class="mx-1 text-center"><b class=" border-left border-white"></b></div>
                            <div  class="d-flex flex-column align-items-center">
                                <small style="font-size: 14px;" title="Programadas">PROG</small>
                                <div  style="line-height: 1;">{{ $store.state.solicitudes.filter(x=> [

                            , //Obstalmologicas
                            425 //Especialidades
                            ].includes( Number( x['area_intervencion'] ) ) ).length }}</div>
                            </div>
                        </div>

                    </b>
                </div>
            </a>

            <div class="col-1 text-right">
                <img class="img-logo mr-1" style="height: auto;width: 150px;"
                    src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT">
            </div>

        </div>

            <transition name="fade">
                <router-view></router-view>
            </transition>




    </div>

</template>
<script>

import { get, is_null,relog,horaPm,formatAMPM,mesesEnEspanol, fechaAMD } from '../../../helpers/customHelpers';
//import MenuPatientcare from './components/MenuPatientcare.vue';
//import { get } from '../../helpers/customHelpers.js';
export default {
    name: "AreaQuirurgica",
    components: {
        //MenuPatientcare,
    },
    data(){
        return {
            relog_hora:""
        }
    },
    watch: {
          '$route'(to, from) {
            //console.log(to.path)
            this.$store.commit('updateProperty',{
                property:'loading',
                value:true
            })

              // Simulación de una carga, podrías usar una función de retardo o una llamada a una API aquí
              setTimeout(() => {
                    this.$store.commit('updateProperty',{
                        property:'loading',
                        value:false
                    })
              }, 1000); // Cambiar a la duración deseada de la pantalla de carga
          }
    },
    methods: {
        async getOtroPersonalAsistencial(){
                try {
                    /* this.$store.commit('updateProperty',{
                        property:'loading',
                        value:true
                    }) */
                    let model =  await  get( location.origin+"/areaQuirofanoAmb/personal_asistencial/gelAllOtroPersonal")
                        this.$store.commit('updateProperty',{
                            property:'otroPersonalAsistencial',
                            value:model
                        })
                        /* this.$store.commit('updateProperty',{
                            property:'loading',
                            value:false
                        }) */
                } catch (error) {
                    console.error('Error al obtener los datos:', error);
                    return []
                }
        },
        async getPersonalAsistencial(){
                try {
                    /* this.$store.commit('updateProperty',{
                        property:'loading',
                        value:true
                    }) */
                    let model =  await get( location.origin+"/areaQuirofanoAmb/personal_asistencial/gelAll")
                        this.$store.commit('updateProperty',{
                            property:'personalAsistencial',
                            value:model
                        })
                        /* this.$store.commit('updateProperty',{
                            property:'loading',
                            value:false
                        }) */
                } catch (error) {
                    console.error('Error al obtener los datos:', error);
                    return []
                }
        },
        async getSolicitudes(){
                try {
                    /* this.$store.commit('updateProperty',{
                        property:'loading',
                        value:true
                    }) */
                    let model =  await get( location.origin+"/areaQuirofanoAmb/cupo/getAllExterno/"+this.$store.state.fecha_reporte+"?area_intervencion=mapm")   
                        this.$store.commit('updateProperty',{
                            property:'solicitudes',
                            value:model
                        })
                        console.log(this.$store.state.solicitudes);
                        /* this.$store.commit('updateProperty',{
                            property:'loading',
                            value:false
                        }) */
                } catch (error) {
                    console.error('Error al obtener los datos:', error);
                    return []
                }
        },
        async reloadData(){
            await this.handleGetData()
        },
        async handleGetData(){
            //console.log(fechaAMD());
            //console.log(this.$store.state.fecha_reporte);
            await this.getPersonalAsistencial()
            await this.getOtroPersonalAsistencial()

            await this.getSolicitudes()
        },
        handle_fecha_reporte(){
            Swal.fire({
                icon:"warning",
                title: 'Escribe y confirma la fecha del plan quirúrgico a consultar:',
                html:`
                    <input type="date" class="form-control" value="${this.$store.state.fecha_reporte}" id="fecha_reporte">
                `,
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Consultar!',
                denyButtonText: `Cancelar`,
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading()
            }).then( async (result) => {
                let fecha_reporte = document.getElementById("fecha_reporte").value;
                    localStorage.setItem("fecha_reporte_plan_quirurgico",fecha_reporte)
                    this.$store.commit('updateProperty',{
                        property:'fecha_reporte',
                        value:fecha_reporte
                    })
                let fecha = this.$store.state.fecha_reporte.split("-")

                    this.$store.commit('updateProperty',{
                        property:'relog_dia',
                        value:fecha[2].padStart(2, '0')
                    })
                    this.$store.commit('updateProperty',{
                        property:'relog_mes',
                        value:mesesEnEspanol[Number(fecha[1])-1].slice(0,3)
                    })
                    this.$store.commit('updateProperty',{
                        property:'relog_anio',
                        value:fecha[0]
                    })

                    await this.handleGetData()
            })
        },
        async getCatUbicaciones(){
                try {
                    /* this.$store.commit('updateProperty', {
                        property:'loading',
                        value:true,
                    }); */
                   // let model =  await get(location.origin + '/medico/getMedicos' )
                    let model =  await get( location.origin+"/cat_user_ubicacion/getAll");
                        this.$store.commit('updateProperty',{
                            property:'catUbicacion',
                            value:model,
                        })
                        /* this.$store.commit('updateProperty', {
                            property:'loading',
                            value:false,
                        }); */
                } catch (error) {
                    console.error('Error al obtener los datos:', error);
                    /* this.$store.commit('updateProperty', {
                        property:'loading',
                        value:false,
                    }); */
                    return []
                }
            },
        async getEquipoMedico(){
            try {
                this.$store.commit('updateProperty', {
                    fieldName:'loading',
                    fieldValue:true,
                });
                // let model =  await get(location.origin + '/medico/getMedicos' )
                let model =  await get(location.origin + '/user/especialidad/{id}/medicos' )

                    // console.log("equipo_medico",model)
                    //console.log(solicitudesPorDia)
                    //this.$store.commit('updateEquipoMedico',model)
                    this.$store.commit('updateListadoEquipoCirugia',model)
                this.$store.commit('updateProperty', {
                    fieldName:'loading',
                    fieldValue:false,
                });
            } catch (error) {
                console.error('Error al obtener los datos:', error);
                return []
            }
        },
    },
    computed: {
        totalEjeProgramadas(){
            return  this.$store.state.solicitudes.filter(x=>{
                            return ['Suspendida','Alta','UTI','Hospitalización'].includes(x.fase_ubicacion)
                        }).length
        },
        totalEjeOftal(){
            return  this.$store.state.solicitudes.filter(x=>
                            ['Suspendida','Alta','UTI','Hospitalización'].includes(x.fase_ubicacion) &&
                            [424].includes( Number(x['area_intervencion']) )
                        ).length
        },
        totalEjeEspe(){
            return  this.$store.state.solicitudes.filter(x=>
                            ['Suspendida','Alta','UTI','Hospitalización'].includes(x.fase_ubicacion) &&
                            [425].includes( Number(x['area_intervencion']) )
                        ).length
        },
        mostrarLoading(){
            return this.$store.state.loading
        }
    },
    async beforeMount(){
        await this.getCatUbicaciones()
        await this.handleGetData()
    },
    mounted: async function () {

        let that = this
        this.getEquipoMedico()

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
            await that.handleGetData()
        }, 7000)
    },

}

</script>
<style>
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
    .fade-enter-active, .fade-leave-active {
        transition: opacity 0.5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
        opacity: 0;
    }
    .row_counter_user div:nth-child(1){
        width:15px;
        text-align:center;
    }
    .row_counter_user div:nth-child(2){
        width:30px;
        text-align:center;
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
    .total-counter{
        line-height: 1;
    }
    .total-icon {
        font-size: 2em;
    }


    .rounded-custom-1{
        border-radius: 1.25rem;
    }
    :root {
        --radius-table-row: 10px;
        /*  --table-border-row-color:rgb(240, 240, 241); */
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

    body {
        background-color: #233a6d;
       /*  background: url("/image/system/background_quirofano.jpg") no-repeat center center fixed;

        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover; */
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
