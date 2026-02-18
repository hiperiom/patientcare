<template>
    <div class="h-100">
        <div ref="loadingScreen" class="loadingScreen d-none">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <img loading="lazy" onerror="this.src='/image/system/patient.svg'"
                    src="/image/system/logo-cmdlt-blanco.svg" alt="Cmdlt" class="mb-3"
                    style="width: 140px; height: 80px;">
                <div class="d-flex align-items-center text-white justify-content-center">
                    <div role="status" class="spinner-border">
                        <span class="visually-hidden"></span>
                    </div>
                    <h4 class="pl-2">Por favor espere un momento...</h4>
                </div>
            </div>
        </div>
        <div class="flex-fill container-xl d-flex flex-column overflow-auto">
            <nav class="d-flex flex-wrap align-items-center bg-transparent my-2">
                <button onclick="location.href='/auth/menu_inicial_aq'"
                    class="btn-patientcare btn bg-transparent order-1 col-1 col-sm d-flex pl-0 h3 col-sm-4 align-items-center text-white">
                    <i class="fas fa-bars text-white mr-2"></i><i
                        class="d-none d-sm-flex pc-fa-patientcare-logo text-white h3 mb-0"></i>

                </button>
                <div class="order-1 col-6 col-sm-4 text-left  text-center text-uppercase text-white title-dashboard">
                    MOVIMIENTO QUIRÚRGICO EN TORRE HOSPITALIZACIÓN
                </div>
                <div class="order-2 col-5 col-sm-4 pr-0 text-right">
                    <img
                        src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg"
                        alt="Logo CMDLT"
                        class="img-logo"
                    >
                </div>
            </nav>
            <div class="container-fluid px-0 pb-1  ">
                <div class="row justify-content-center">
                    <div class="col-6 col-md-6 col-lg-4 col-xl-3 d-flex flex-column flex-sm-row align-items-center">
                        <div class="mr-1 text-white">Desde:</div>
                        <input v-model="fecha_desde" @keyup.enter="handle_consultar()" type="date" name="desde"
                            id="desde" class="form-control-custom-1">
                    </div>
                    <div class="col-6 col-md-6 col-lg-4 col-xl-3 d-flex flex-column flex-sm-row align-items-center">
                        <div class="mr-1 text-white">
                            Hasta:
                        </div> <input v-model="fecha_hasta" @keyup.enter="handle_consultar()" type="date" name="hasta" id="hasta"
                            class="form-control-custom-1">
                    </div>
                    <div class="col-12 col-md-6 col-lg-2 col-xl-2 mt-1 mt-lg-0">
                        <button @click="handle_consultar()" class="btn btn-success w-100">Consultar</button>
                    </div>
                </div>
            </div>
            <div class="flex-fill d-flex flex-column overflow-auto">
                <div class="d-flex flex-wrap mb-1">
                    <div class="col-6 col-sm px-0 d-flex flex-column">
                        <AppTotalProgramadas
                            title="IQX PROGRAMADAS"
                            :item_total="total_programadas_actual"
                            :item_total_adulto="item_total_adulto"
                            :item_total_pediatrico="item_total_pediatrico"
                        />
                    </div>
                    <div class="col-6 col-sm d-flex flex-column px-0">
                        <AppTotalEjecutadas
                            title="IQX EJECUTADAS"
                            :item_total="item_ejecutado_total"
                            :item_total_adulto="item_ejecutado_total_adulto"
                            :item_total_pediatrico="item_ejecutado_total_pediatrico"
                        />
                    </div>
                    <div class="col-6 col-sm d-flex flex-column px-0">
                        <AppTotalEjecutadasSub2
                            title="IQX HOSPITALIZACION"
                            :item_total="total_hospitalizacion_hosp"
                            :item_total2="item_ejecutado_total"
                            :item_total_adulto="total_hospitalizacion_hosp_adulto"
                            :item_total_pediatrico="total_hospitalizacion_hosp_pediatrico"
                        />
                    </div>
                    <div class="col-6 col-sm px-0">

                        <AppTotalEjecutadasSub1
                            title="IQX AMBULATORIAS"
                            :item_total="total_hospitalizacion_torre"
                            :item_total2="item_ejecutado_total"
                            :item_total_adulto="total_hospitalizacion_torre_adulto"
                            :item_total_pediatrico="total_hospitalizacion_torre_pediatrico"
                        />
                    </div>
                </div>
                <div class="d-flex flex-wrap mb-1">
                    <div class="col-12 col-md-4 mb-1 mb-md-0 pr-0 pr-md-1 pl-0 d-flex flex-wrap">
                        <AppResumenIqxHospitalizacion
                            :periodo_fecha_actual="periodo_fecha_actual"
                            :total_programadas_variacion_actual="total_programadas_variacion_actual"
                            :total_programadas_actual="total_programadas_actual"
                            :total_ejecutadas_actual="total_ejecutadas_actual"
                            :total_programadas_variacion_anterior="total_programadas_variacion_anterior"
                            :total_programadas_anterior="total_programadas_anterior"
                            :total_ejecutadas_anterior="total_ejecutadas_anterior"
                            :periodo_fecha_anterior="periodo_fecha_anterior"

                        />
                    </div>
                    <div class="col-12 col-sm-8 px-0 pr-md-1 d-flex">
                        <AppCirugiasXmes
                            :dataset="cirugias_por_mes"
                            :fecha_desde="fecha_desde"
                            :fecha_hasta="fecha_hasta"
                        />
                    </div>
                </div>
                <div class="d-flex flex-wrap mb-1">
                    <div class="col-12 col-md-4 pr-0 pr-md-1 pl-0 d-flex mb-1 mb-md-0">
                        <AppIQXprogramadas_vs_ejecutadas
                            :fecha_desde="getFechaDMA(fecha_desde)"
                            :fecha_hasta="getFechaDMA(fecha_hasta)"
                            :item_ejecutado_total="item_ejecutado_total"
                            :total_por_ejecutar_hospitalizacion="total_por_ejecutar_hospitalizacion + item_ejecutado_total"
                        />
                    </div>
                    <div class="col-12 col-md-4 pr-0 pr-md-1 pl-0 d-flex flex-wrap mb-1 mb-md-0">
                        <AppTiposCirugias
                            :fecha_desde="getFechaDMA(fecha_desde)"
                            :fecha_hasta="getFechaDMA(fecha_hasta)"
                            :dataset="[total_cirugias_emergencias,total_cirugias_electivas]"

                        />
                    </div>
                    <div class="col-12 col-sm-4 pr-0 pr-md-1 pl-0 d-flex">
                        <AppTurnosHorariosMasUtilizados
                            :dataset="turnos_horarios_mas_utilizados"
                        />
                    </div>
                </div>
                <div class="d-flex flex-wrap mb-1">
                    <div class="col-12 col-sm-6 mb-1 pr-0 pr-md-1 pl-0 d-flex">
                        <AppMedicosConMasIQXCompletadas
                            :dataset="medicos_con_mas_iqx_completadas"
                        />
                    </div>
                    <div class="col-12 col-sm-6 mb-1 pr-0 pr-md-1 pl-0 d-flex">
                        <AppEspecialidadesConMasIQXCompletadas
                            :dataset="especialidades_con_mas_iqx_completadas"
                        />

                    </div>
                    <div class="col-12 col-sm-6 mb-1 pr-0 pr-md-1 pl-0 d-flex">
                        <AppAnestesiologosConMasIQXCompletadas
                            :dataset="anestesiologos_con_mas_iqx_completadas"
                        />
                    </div>

                    <div class="col-12 col-sm-6 mb-1 pr-0 pr-md-1 pl-0 d-flex">
                        <AppEquiposEspecialesMasUtilizados
                            :dataset="equipos_especiales_mas_utilizados"
                        />
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
    import { post,fechaAMD,fechaDMA, fechaCustom2, timestamps, fechaHoy } from "../../../helpers/customHelpers.js"
    import AppIQXprogramadas_vs_ejecutadas from "./AppIQXprogramadas_vs_ejecutadas.vue"
    import AppTiposCirugias from "./AppTiposCirugias.vue"
    import AppTotalProgramadas from "./AppTotalProgramadas.vue"
    import AppTotalEjecutadas from "./AppTotalEjecutadas.vue"
    import AppTotalEjecutadasSub1 from "./AppTotalEjecutadasSub1.vue"
    import AppTotalEjecutadasSub2 from "./AppTotalEjecutadasSub2.vue"
    import AppMedicosConMasIQXCompletadas from "./AppMedicosConMasIQXCompletadas.vue";
    import AppEspecialidadesConMasIQXCompletadas from "./AppEspecialidadesConMasIQXCompletadas.vue";
    import AppTurnosHorariosMasUtilizados from "./AppTurnosHorariosMasUtilizados.vue";
    import AppCirugiasXmes from "./AppCirugiasXmes.vue";
    //import AppProximasSolicitudes from "./AppProximasSolicitudes.vue";
    import AppEquiposEspecialesMasUtilizados from "./AppEquiposEspecialesMasUtilizados.vue";
    import AppResumenIqxHospitalizacion from "./AppResumenIqxHospitalizacion.vue";
    import AppAnestesiologosConMasIQXCompletadas from "./AppAnestesiologosConMasIQXCompletadas.vue";
    export default {
        name: "TableroAreaQx",
        data() {
            let date = new Date()

            return {
                fecha_desde:`${date.getFullYear()}-${String(date.getMonth()+1).padStart(2, '0') }-01`,
                fecha_hasta:`${date.getFullYear()}-${String(date.getMonth()+1).padStart(2, '0') }-${String(date.getDate()).padStart(2, '0') }`,
                loading: document.getElementById('loadingScreen'),
                periodo_fecha_actual:0,
                periodo_fecha_anterior:0,
                total_programadas_variacion_anterior:0,
                total_programadas_anterior:0,
                total_ejecutadas_anterior:0,
                total_programadas_variacion_actual:0,
                total_programadas_actual:0,
                total_ejecutadas_actual:0,
                item_total: 0,
                item_total_adulto: 0,
                item_total_pediatrico: 0,
                anestesiologos_con_mas_iqx_completadas: 0,

                item_ejecutado_total: 0,
                item_ejecutado_total_adulto: 0,
                item_ejecutado_total_pediatrico: 0,

                total_por_ejecutar_hospitalizacion: 0,
                total_por_ejecutar_adulto: 0,
                total_por_ejecutar_hospitalizacion_pediatrico: 0,

                total_hospitalizacion_torre: 0,
                total_hospitalizacion_torre_adulto: 0,
                total_hospitalizacion_torre_pediatrico: 0,

                total_hospitalizacion_hosp: 0,
                total_hospitalizacion_hosp_adulto: 0,
                total_hospitalizacion_hosp_pediatrico: 0,
                total_cirugias_electivas:0,
                total_cirugias_emergencias:0,

                medicos_con_mas_iqx_completadas:[],

                especialidades_con_mas_iqx_completadas:[],

                turnos_horarios_mas_utilizados:[],

                cirugias_por_mes:[],

                proximas_solicitudes:[],

                equipos_especiales_mas_utilizados:[],

                intervenciones_mas_solicitadas: [],
            }
        },
        computed: {

            getFechaDesde(){
                return fechaDMA(this.fecha_desde)
            },
            getFechaHasta(){
                return fechaDMA(this.fecha_hasta)
            },
            calcularFechas() {
                const fechaInicioActual = new Date(this.fecha_desde);
                const fechaFinActual = new Date(this.fecha_hasta);

                const diasARestar = Math.floor((fechaFinActual - fechaInicioActual) / (1000 * 60 * 60 * 24));

                const fechaInicioAnterior = new Date(fechaInicioActual);
                fechaInicioAnterior.setDate(fechaInicioActual.getDate() - diasARestar);
                const fechaInicioAnteriorStr = fechaInicioAnterior.toISOString().split('T')[0];

                const fechaFinAnterior = new Date(fechaInicioActual);
                fechaFinAnterior.setDate(fechaInicioActual.getDate() - 1);
                const fechaFinAnteriorStr = fechaFinAnterior.toISOString().split('T')[0];

                return {
                    fechaInicioAnterior: fechaInicioAnteriorStr,
                    fechaFinAnterior: fechaFinAnteriorStr
                };
            },
        },
        components: {
            AppTiposCirugias,
            AppTotalProgramadas,
            AppTotalEjecutadas,
            AppTotalEjecutadasSub1,
            AppTotalEjecutadasSub2,
            AppIQXprogramadas_vs_ejecutadas,
            AppMedicosConMasIQXCompletadas,
            AppEspecialidadesConMasIQXCompletadas,
            AppTurnosHorariosMasUtilizados,
            AppCirugiasXmes,
            AppResumenIqxHospitalizacion,
            AppEquiposEspecialesMasUtilizados,
            AppAnestesiologosConMasIQXCompletadas,
        },
        methods: {

            getFechaDMA(fecha){
                return fechaCustom2(fecha)
            },
            async getAllEndPoints() {
                //this.loading.classList.remove("d-none")
                let formData = new FormData();
                    formData.append("fecha_inicial",this.fecha_desde)
                    formData.append("fecha_final", this.fecha_hasta)
                    formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'))

                let result = await post(location.origin + `/dashboard_qx/total_cirugias_hospitalizacion`, formData)

                    this.item_total = result.total_hospitalizacion
                    this.item_total_adulto = result.total_hospitalizacion_adulto
                    this.item_total_pediatrico = result.total_hospitalizacion_pediatrico

                    this.item_ejecutado_total = result.total_ejecutadas_hospitalizacion
                    this.item_ejecutado_total_adulto = result.total_ejecutadas_hospitalizacion_adultos
                    this.item_ejecutado_total_pediatrico = result.total_ejecutadas_hospitalizacion_pediatrico

                    this.total_por_ejecutar_hospitalizacion = result.total_por_ejecutar_hospitalizacion
                    this.total_por_ejecutar_adulto = result.total_por_ejecutar_hospitalizacion_adulto
                    this.total_por_ejecutar_hospitalizacion_pediatrico = result.total_por_ejecutar_hospitalizacion_pediatrico

                    this.total_hospitalizacion_torre = result.total_hospitalizacion_torre
                    this.total_hospitalizacion_torre_adulto = result.total_hospitalizacion_torre_adulto
                    this.total_hospitalizacion_torre_pediatrico = result.total_hospitalizacion_torre_pediatrico

                    this.total_hospitalizacion_hosp = result.total_hospitalizacion_hosp
                    this.total_hospitalizacion_hosp_adulto = result.total_hospitalizacion_hosp_adulto
                    this.total_hospitalizacion_hosp_pediatrico = result.total_hospitalizacion_hosp_pediatrico

                    /****************************** */

                    result = await post(location.origin + `/dashboard_qx/totales_resumen`, formData)

                    this.total_programadas_variacion_actual = result.total_programadas_variacion_actual
                    this.total_programadas_actual = result.total_programadas_actual
                    this.total_ejecutadas_actual = result.total_ejecutadas_actual

                    this.total_programadas_variacion_anterior = result.total_programadas_variacion_anterior
                    this.total_programadas_anterior = result.total_programadas_anterior
                    this.total_ejecutadas_anterior = result.total_ejecutadas_anterior

                    this.periodo_fecha_actual = result.periodo_fecha_actual
                    this.periodo_fecha_anterior = result.periodo_fecha_anterior

                    /****************************** */

                    let formData2 = new FormData();
                    formData2.append("delay", 5)
                    //formData2.append("limit", 6)
                    formData2.append("area", "Hospitalizacion")
                    formData2.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'))

                    result = await post(location.origin + `/dashboard_qx/cirugias_ejecutadas_x_mes`, formData2)
                    this.cirugias_por_mes = result

                    /****************************** */

                    result = await post(location.origin + `/dashboard_qx/tipo_cirugia`, formData)
                    this.total_cirugias_electivas = result.cirugias_electivas
                    this.total_cirugias_emergencias = result.cirugias_emergencias

                    /****************************** */
                    formData.append("limit", 1000)
                    result = await post(location.origin + `/dashboard_qx/cirugiasCulminadasXAnestesiologo`, formData)
                    this.anestesiologos_con_mas_iqx_completadas = result.resultado
                    /****************************** */

                    result = await post(location.origin + `/dashboard_qx/cirugias_culminadas_x_medico`, formData)
                    this.medicos_con_mas_iqx_completadas = result
                    /****************************** */
                    result = await post(location.origin + `/dashboard_qx/top_especialidades`, formData)
                    this.especialidades_con_mas_iqx_completadas = result
                    /****************************** */
                    result = await post(location.origin + `/dashboard_qx/turnos_horarios`, formData)
                    this.turnos_horarios_mas_utilizados = result







                    formData2.append("fecha", fechaHoy() )

                    //result = await post(location.origin + `/dashboard_qx/proximas_solicitudes`, formData2)
                    //this.proximas_solicitudes = result.proximas_solicitudes

                let formData3 = new FormData();
                    formData3.append("limit", 6)
                    formData3.append("fecha_inicial",this.fecha_desde)
                    formData3.append("fecha_final", this.fecha_hasta)
                    formData3.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'))
                    result = await post(location.origin + `/dashboard_qx/equipos_especiales`, formData3)
                    this.equipos_especiales_mas_utilizados = Array.from(result.lista_equipos_especiales)


                    console.log(this.equipos_especiales_mas_utilizados);
            },
            async handle_consultar() {
                await this.getAllEndPoints()
            }
        },
        async created() {
            await this.getAllEndPoints()
        },
        async mounted() {

        },
    }
</script>

<style >
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

.btn-patientcare:hover {
    background-color: rgb(255, 255, 255, 0.1) !important;
}

body {
    background-color: #233a6d !important
        /*  background: url(https://patientcare.cmdlt.pstelemed.com/image/system/background_quirofano.jpg) no-repeat  center center fixed;
        -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover; */
}

.font-weight-bold {
    font-weight: 500 !important;
}

body {
    margin: 0;
    font-family: 'Titillium Web';
    font-style: normal;
    font-weight: 400;
    src: url('/fonts/titillium-web-v8-latin-regular.eot');
    src: local('Titillium Web Regular'), local('TitilliumWeb-Regular'), url('/fonts/titillium-web-v8-latin-regular.eot?#iefix') format('embedded-opentype'),
        /* IE6-IE8 */
        url('/fonts/titillium-web-v8-latin-regular.woff2') format('woff2'),
        /* Super Modern Browsers */
        url('/fonts/titillium-web-v8-latin-regular.woff') format('woff'),
        /* Modern Browsers */
        url('/fonts/titillium-web-v8-latin-regular.ttf') format('truetype'),
        /* Safari, Android, iOS */
        url('/fonts/titillium-web-v8-latin-regular.svg#TitilliumWeb') format('svg');
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: left;

}

.h-100 {
    height: 100vh !important;
}

.bg-secondary {
    background-color: var(--gray) !important;
}

.btn-glassmod-effect {
    background-color: hsla(0, 0%, 100%, .3);
    -webkit-backdrop-filter: blur(20px);
    backdrop-filter: blur(20px);
    color: #fff;
    opacity: 1;
    transition: opacity .5s ease;
}

.glassmod-effect {
    background-color: hsla(0, 0%, 100%, .3);
    -webkit-backdrop-filter: blur(20px);
    backdrop-filter: blur(20px);
    color: #fff;
    opacity: 1;
    transition: opacity .5s ease;
}

.btn-glassmod-effect:hover {
    background-color: #fff;
    cursor: pointer;
    color: var(--primary);
    opacity: .8;
}

.line-height-1 {
    line-height: 1.01;
}

.line-height-2 {
    line-height: 1.2;
}



.rounded-custom-1 {
    border-radius: 15px;
}

.f-size-total {
    font-size: 50px;
}

.img-logo {
    height: 50px;
    width: 120px;
}

.form-control-custom-1 {
    display: block;
    width: 100%;
    height: calc(2.25rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #fff;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    box-shadow: inset 0 0 0 transparent;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    background-color: hsla(0, 0%, 100%, .3);
    -webkit-backdrop-filter: blur(20px);
    backdrop-filter: blur(20px);
}

.overflow-custom-auto {
    /*  overflow: auto; */
}

.title-dashboard {
    font-size: 1rem;
    line-height: 1;
    font-weight: 600;
}

/* // Small devices (landscape phones, 576px and up) */
@media (min-width: 576px) {}

/* // Medium devices (tablets, 768px and up) */
@media (min-width: 768px) {
    .rounded-custom-left {
        border-top-left-radius: 15px;
        border-bottom-left-radius: 15px;
    }

    .rounded-custom-right {
        border-top-right-radius: 15px;
        border-bottom-right-radius: 15px;
    }
}

/* // Large devices (desktops, 992px and up) */
@media (min-width: 992px) {
    .title-dashboard {
        font-size: 1.5rem !important;
    }
}

/* // Extra large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) {

    /*  .overflow-custom-auto {
        overflow: hidden;
      } */
}
</style>
