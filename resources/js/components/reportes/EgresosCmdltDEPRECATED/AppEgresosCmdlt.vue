<template>
    <div class="d-flex flex-column overflow-auto h-100">
        <nav class="d-flex align-items-center bg-transparent rounded-pill m-1">
            <div class="col col-sm-4 d-none d-sm-block">
                <i class="pc-fa-patientcare-logo text-white h3 mb-0"></i>
            </div>
            <div class="col-7 col-sm-4 h3 text-center text-uppercase text-white">
                EGRESOS EN ÁREAS CMDLT
            </div>
            <div class="col-5 col-sm-4 text-right">
                <img class="img-logo m-1" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT">
            </div>
        </nav>

        <div class="container-fluid pb-1">
            <div class="row justify-content-center">
                <div class="col-6  col-md-6 col-lg-4 col-xl-2 d-flex flex-column flex-sm-row align-items-center">
                    <div class="mr-1 text-white">
                    Desde:
                    </div>
                    <input @keyup.enter="getNewData()" class="form-control-custom-1" type="date" name="desde" v-model="desde" id="desde">
                </div>
                <div class="col-6  col-md-6 col-lg-4 col-xl-2 d-flex flex-column flex-sm-row align-items-center">
                  <div class="mr-1 text-white">
                    Hasta:
                  </div>
                  <input @keyup.enter="getNewData()" class="form-control-custom-1" type="date" name="hasta" v-model="hasta" id="hasta">
                </div>
                <div class="col-12  col-md-6 col-lg-2 col-xl-1 mt-1 mt-lg-0">
                    <button @click="getNewData()" class="btn btn-success w-100">Consultar</button>
                </div>
            </div>
        </div>

      <!-- INICIO -->
        <div class="flex-fill d-flex justify-content-center align-items-md-center overflow-auto">
            <div class="container-fluid">

                <div class="row mb-1 justify-content-center">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        <CardArea
                            icon="pc-light-patient-copia-3"
                            title_area="CMDLT"
                            :total_area="getTotales.cmdlt.total "
                            total_adulto="0"
                            total_pediatrico="0"
                            paramFuncion="cmdlt_total"
                            :handleActionCard="getNewDataPaciente"
                        />
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <CardArea
                            icon="pc-emergencia"
                            title_area="Emergencia"
                            :total_area="getTotales.emergencia.total "
                            total_adulto="0"
                            total_pediatrico="0"
                            paramFuncion="emergencia_total"
                            :handleActionCard="getNewDataPaciente"
                        />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <CardArea
                                        icon="pc-emergencia"
                                        title_area="EA ADULTO"
                                        :total_area="getTotales.emergencia_adulto.total "
                                        total_adulto="0"
                                        total_pediatrico="0"
                                        paramFuncion="emergencia_adulto_total"
                                        :handleActionCard="getNewDataPaciente"
                                    />
                                    <CardAreaListEA
                                        icon="pc-light-patient-copia-3"
                                        title_area="UTI"
                                        total_area="0"
                                        total_adulto="0"
                                        total_pediatrico="0"
                                        :handleActionCard="getNewDataPaciente"
                                        :dataset="{
                                            triaje_a: getTotales.emergencia_adulto.b,
                                            triaje_b: getTotales.emergencia_adulto.observacion,
                                            observacion: getTotales.emergencia_adulto.observacion,
                                            traumashock: getTotales.emergencia_adulto.traumashock,
                                        }"
                                    />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <CardArea
                                        icon="pc-emergencia"
                                        title_area="EA Pediátrica"
                                        :total_area="getTotales.emergencia_pediatrica.total "
                                        total_adulto="0"
                                        total_pediatrico="0"
                                        paramFuncion="emergencia_pediatrica_total"
                                        :handleActionCard="getNewDataPaciente"
                                    />
                                    <CardAreaListEP
                                        icon="pc-light-patient-copia-3"
                                        title_area="UTI"
                                        total_area="0"
                                        total_adulto="0"
                                        total_pediatrico="0"
                                        :handleActionCard="getNewDataPaciente"
                                        :dataset="{
                                            triaje_a: getTotales.emergencia_pediatrica.a,
                                            triaje_b: getTotales.emergencia_pediatrica.b,
                                            observacion: getTotales.emergencia_pediatrica.observacion,
                                            traumashock: getTotales.emergencia_pediatrica.traumashock,
                                            nebulizacion: getTotales.emergencia_pediatrica.nebulizacion,
                                        }"
                                    />
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-2">
                        <CardArea
                            icon="pc-light-pisos"
                            title_area="Hospitalización"
                            :total_area="getTotales.hospitalizacion.total "
                            total_adulto="0"
                            total_pediatrico="0"
                            paramFuncion="hospitalizacion_total"
                            :handleActionCard="getNewDataPaciente"
                        />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <CardAreaListHP
                                        icon="pc-light-patient-copia-3"
                                        title_area="UTI"
                                        total_area="0"
                                        total_adulto="0"
                                        total_pediatrico="0"
                                        :handleActionCard="getNewDataPaciente"
                                        :dataset="{
                                            piso_2: getTotales.hospitalizacion.piso_2,
                                            piso_3: getTotales.hospitalizacion.piso_3,
                                            piso_4: getTotales.hospitalizacion.piso_4,
                                            piso_5: getTotales.hospitalizacion.piso_5,
                                            piso_6: getTotales.hospitalizacion.piso_6,
                                            hcep:getTotales.hospitalizacion.hcep,

                                        }"
                                    />
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-2">
                        <CardArea
                            icon="pc-uti-light"
                            title_area="UTI"
                            :total_area="getTotales.uti.total"
                            total_adulto="0"
                            total_pediatrico="0"
                            paramFuncion="uti_total"
                            :handleActionCard="getNewDataPaciente"
                        />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <CardAreaListUTI
                                        icon="pc-light-patient-copia-3"
                                        title_area="UTI"
                                        total_area="0"
                                        total_adulto="0"
                                        total_pediatrico="0"
                                        :handleActionCard="getNewDataPaciente"
                                        :dataset="{
                                            uti_adulto:getTotales.uti.adulto ,
                                            uti_pediatrica: getTotales.uti.pediatrica,
                                            utin:getTotales.uti.utin,

                                        }"
                                    />
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">
                        <CardArea
                            icon="pc-pad_emergencia"
                            title_area="PAD"
                            :total_area="getTotales.pad.total"
                            total_adulto="0"
                            total_pediatrico="0"
                            paramFuncion="pad_total"
                            :handleActionCard="getNewDataPaciente"
                        />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <CardAreaListPAD
                                        icon="pc-light-patient-copia-3"
                                        title_area="UTI"
                                        total_area="0"
                                        total_adulto="0"
                                        total_pediatrico="0"
                                        :handleActionCard="getNewDataPaciente"
                                        :dataset="{
                                            emergencia_adulto:getTotales.pad_emergencia.adulto ,
                                            emergencia_pediatrica: getTotales.pad_emergencia.pediatrico,
                                            postqx_ambulatorio:getTotales.pad_postquirurgico.ambulatorio,
                                            postqx_hospitalizacion:getTotales.pad_postquirurgico.hospitalizacion,
                                            medico:getTotales.pad_medico.total
                                        }"
                                    />
                                </div>

                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
      <!-- FIN -->
      <div class="modal fullscreen-modal fade" style="z-index: 10000;" id="modal-patient-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content d-flex flex-column overflow-auto vh-100">
                    <div class="modal-header p-0">
                        <nav class="d-flex justify-content-between align-items-center bg-primary rounded-pill m-1 ">
                            <i id="close_modal" data-dismiss="modal" aria-label="Close" class="ml-3 fas fa-times text-white heartbeat" style="font-size: 2em;cursor:pointer;" aria-hidden="true"></i>

                            <img class="img-logo m-1 d-block" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT">
                        </nav>
                    </div>
                    <div class="modal-body-2 container-fluid  fullscreen d-flex flex-column overflow-auto">
                        <!-- <div class="text-primary h3 font-weight-bold text-center text-uppercase">
                            Pacientes Egresados de PAD Emergencia
                        </div> -->
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-primary">
                                    <th>#</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Género</th>
                                    <th>Cédula</th>
                                    <th>Fecha Ingreso</th>
                                    <th>Fecha Egreso</th>
                                    <th>Días</th>
                                    <th>Área de egreso</th>
                                    <th>Egresado por</th>
                                </tr>
                            </thead>
                            <tbody v-if="lista_pacientes_area.length > 0">
                                <tr  v-for="(item,index) in lista_pacientes_area" :key="item.id">
                                    <td>
                                        {{ index = index+1 }}
                                    </td>
                                    <td>
                                        {{ item.nombres_paciente }}
                                        <small class="text-white">#{{ item.user_id }}</small>
                                        <small class="text-white">epi#{{ item.episodio_id }}</small>
                                    </td>
                                    <td>
                                        {{ item.apellidos_paciente }}
                                    </td>
                                    <td class="text-uppercase">
                                        {{ item.genero_paciente }}
                                    </td>
                                    <td class="text-right">
                                        {{ item.cedula_paciente }}
                                    </td>
                                    <td>
                                        {{ fechaFormated(item.ingreso)['dia'] }} <span class="text-primary">|</span> {{ fechaFormated(item.ingreso)['hora'] }}
                                    </td>
                                    <td>
                                        {{ fechaFormated(item.egreso)['dia'] }} <span class="text-primary">|</span> {{ fechaFormated(item.egreso)['hora'] }}
                                    </td>
                                    <td>
                                        {{ item.dia_hos }}
                                    </td>
                                    <td>
                                        {{ item.area_egreso }}
                                    </td>
                                    <td>
                                        {{ item.nombres_medico }} {{ item.apellidos_medico }}
                                    </td>

                                </tr>
                            </tbody>
                            <tbody v-else>
                                <td colspan="10" class="text-center text-primary">
                                    No se encontraron registros
                                </td>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>

<script scoped>
    import { fechaHoy,fechaCortaCustom2,meses,formatAMPM } from "../../../helpers/customHelpers.js";
    import CardArea from "./CardArea.vue";
    import CardAreaListEA from "./CardAreaListEA.vue";
    import CardAreaListEP from "./CardAreaListEP.vue";
    import CardAreaListHP from "./CardAreaListHP.vue";
    import CardAreaListUTI from "./CardAreaListUTI.vue";
    import CardAreaListPAD from "./CardAreaListPAD.vue";
	export default {
		name:"EgresosCmdlt",
        components:{
            CardArea,
            CardAreaListEA,
            CardAreaListEP,
            CardAreaListHP,
            CardAreaListUTI,
            CardAreaListPAD,
        },
        data(){
            return {
                lista_pacientes_area:[],
                datos:{
                    "emergencia_adulto": {
                        "a": 0,
                        "b": 0,
                        "triaje": 0,
                        "observacion": 0,
                        "traumashock": 0,
                        "total": 0
                    },
                    "emergencia_pediatrica": {
                        "a": 0,
                        "b": 0,
                        "triaje": 0,
                        "observacion": 0,
                        "traumashock": 0,
                        "nebulizacion": 0,
                        "total": 0
                    },
                    "hospitalizacion": {
                        "piso_2": 0,
                        "piso_3": 0,
                        "piso_4": 0,
                        "piso_5": 0,
                        "piso_6": 0,
                        "hcep": 0,
                        "total": 0
                    },
                    "uti": {
                        "adulto": 0,
                        "pediatrica": 0,
                        "utin": 0,
                        "total": 0
                    },
                    "pad_emergencia": {
                        "adulto": 0,
                        "pediatrico": 0,
                        "total": 0
                    },
                    "pad_postquirurgico": {
                        "ambulatorio": 0,
                        "hospitalizacion": 0,
                        "total": 0
                    },
                    "pad_medico": {
                        "total": 0
                    },
                    "pad": {
                        "total": 0
                    }
                },
                desde:fechaHoy(),
                hasta:fechaHoy(),
            }
        },
		methods: {
            fechaFormated(param){
                let hoy = new Date(param);
                return {
                    dia: hoy.getDate() + " " + ( meses( hoy.getMonth() ).slice(0,3).toUpperCase() ) + ", " + hoy.getFullYear(),
                    hora:formatAMPM(hoy)
                }
            },
            async getNewData(){
                this.datos = await this.getData()
            },
            async getNewDataPaciente(area){
                $("#modal-patient-item").modal("show");
                this.lista_pacientes_area = await this.getDataPacientes(area)
            },
			async getData() {
                console.log(fechaHoy());
				try {
					const response = await fetch(`/user/admin/dataegresostotales/${this.desde}/${this.hasta}`);
					const responseData = await response.json();
					return responseData;
				} catch (error) {
					console.error('Error al obtener los datos:', error);
				}
				return false
			},
			async getDataPacientes(area) {
                //console.log(fechaHoy());
				try {
					const response = await fetch(`/user/admin/dataegresosdatospacientes/${area}/${this.desde}/${this.hasta}`);
					const responseData = await response.json();
					return responseData;
				} catch (error) {
					console.error('Error al obtener los datos:', error);
				}
				return false
			},


		},
		computed: {

            getTotales(){
                return this.datos
            }



		},
		mounted: async function () {


            this.datos = await this.getData()
            console.log(this.datos)
            setInterval( async () => {
                this.datos = await this.getData()
            }, 10000);
		}
	};
</script>
<style>
    .form-control-custom-1 {
        display: block;
        width: 100%;
        height: calc(2.25rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #ffffff;
        background-color: #ffffff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        box-shadow: inset 0 0 0 rgba(0, 0, 0, 0);
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        background-color: rgb(255 255 255 / 30%);
        -webkit-backdrop-filter: blur(20px);
        backdrop-filter: blur(20px);
    }
    .tippy-box[data-theme~='tooltip-cmdlt-primary'] {
        background-color: var(--primary);
        color: white;
    }

    .tippy-box[data-theme~='tooltip-cmdlt-primary'][data-placement^='top']>.tippy-arrow::before {
        border-top-color: var(--primary);
    }

    .tippy-box[data-theme~='tooltip-cmdlt-primary'][data-placement^='bottom']>.tippy-arrow::before {
        border-bottom-color: var(--primary);
    }

    .tippy-box[data-theme~='tooltip-cmdlt-primary'][data-placement^='left']>.tippy-arrow::before {
        border-left-color: var(--primary);
    }

    .tippy-box[data-theme~='tooltip-cmdlt-primary'][data-placement^='right']>.tippy-arrow::before {
        border-right-color: var(--primary);
    }
    .piso {
        display: flex;
        justify-content: betwen;
        align-items: center;
        position: relative;
        /* margin: 2px 0 2px 0; */
        padding: 0.3rem 0.3rem 0.3rem 0.3rem;
        text-shadow: 2px 2px 5px rgba(43, 19, 12, 0.50);
        box-shadow: 0px 23px 12px -20px rgb(255 255 255 / 20%);
        ;
        -webkit-box-shadow: 0px 23px 12px -20px rgb(255 255 255 / 20%);
        -moz-box-shadow: 0px 23px 12px -20px rgb(255 255 255 / 20%);
    }

    .text-shadow {
        text-shadow: 2px 2px 5px rgba(43, 19, 12, 0.50);
    }

    .column-1 {
        min-width: 90px;
        font-size: 1.5rem;
            font-weight: 500;

    }

    .column-2 {
        font-size: 2rem;
            font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        width: 70px;

    }
    /* .column-3 {

    } */
    .shadow-bottom {
        box-shadow: 0px 23px 12px -20px rgba(107, 107, 107, 1);
        -webkit-box-shadow: 0px 23px 12px -20px rgba(107, 107, 107, 1);
        -moz-box-shadow: 0px 23px 12px -20px rgba(107, 107, 107, 1);
    }


    .arrow-right {
        width: 0;
        height: 0;
        border-top: 15px solid transparent;
        border-bottom: 15px solid transparent;
        border-left: 15px solid rgb(255 255 255 / 30%);
    }


    .bed-on {
        opacity: 1
    }

    .bed-off {
        opacity: 0.1
    }

    .badge {
        width: 40px;
        color: white;
        border: 1px solid #ffffff;
        font-size: 1rem;
    }

    body {

        /*https://www.cmdlt.edu.ve/wp-content/uploads/2020/01/medicina-cmdlt.jpg*/
        /* background: url("http://drive.google.com/uc?export=view&id=1lOnAmjJm26ZhK9j0ERYKlSv58rInMWjG") no-repeat center center fixed; */
       /*  background: url("/image/system/background_hosp.jpg") no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover; */
        background-color: var(--primary);
        /* background: rgb(0,58,126);
                    background: linear-gradient(269deg, rgb(24 84 155) 0%, rgb(10 62 135) 60%) rgb(255 58 58) 52%; */

        /*background: rgb(24,91,169);
                    background: linear-gradient(90deg, rgba(24,91,169,1) 0%, rgba(108,175,247,1) 48%, rgba(24,91,169,1) 100%);*/

    }


    .glassmod-effect {
        background-color: rgb(255 255 255 / 30%);
        backdrop-filter: blur(20px);
    }
    .glassmod-effect:hover {
        background-color: rgb(82 82 82 / 30%);
        -webkit-backdrop-filter: blur(20px);
        backdrop-filter: blur(20px);
        cursor:pointer;
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

    .scale-in-ver-top {
        -webkit-animation: scale-in-ver-top .5s cubic-bezier(.25, .46, .45, .94) both;
        animation: scale-in-ver-top .5s cubic-bezier(.25, .46, .45, .94) both
    }

    @-webkit-keyframes scale-in-ver-top {
        0% {
            -webkit-transform: scaleY(0);
            transform: scaleY(0);
            -webkit-transform-origin: 100% 0;
            transform-origin: 100% 0;
            opacity: 1
        }

        100% {
            -webkit-transform: scaleY(1);
            transform: scaleY(1);
            -webkit-transform-origin: 100% 0;
            transform-origin: 100% 0;
            opacity: 1
        }
    }

    @keyframes scale-in-ver-top {
        0% {
            -webkit-transform: scaleY(0);
            transform: scaleY(0);
            -webkit-transform-origin: 100% 0;
            transform-origin: 100% 0;
            opacity: 1
        }

        100% {
            -webkit-transform: scaleY(1);
            transform: scaleY(1);
            -webkit-transform-origin: 100% 0;
            transform-origin: 100% 0;
            opacity: 1
        }
    }

    .scale-in-hor-left {
        -webkit-animation: scale-in-hor-left .5s cubic-bezier(.25, .46, .45, .94) both;
        animation: scale-in-hor-left .5s cubic-bezier(.25, .46, .45, .94) both
    }

    @-webkit-keyframes scale-in-hor-left {
        0% {
            -webkit-transform: scaleX(0);
            transform: scaleX(0);
            -webkit-transform-origin: 0 0;
            transform-origin: 0 0;
            opacity: 1
        }

        100% {
            -webkit-transform: scaleX(1);
            transform: scaleX(1);
            -webkit-transform-origin: 0 0;
            transform-origin: 0 0;
            opacity: 1
        }
    }

    @keyframes scale-in-hor-left {
        0% {
            -webkit-transform: scaleX(0);
            transform: scaleX(0);
            -webkit-transform-origin: 0 0;
            transform-origin: 0 0;
            opacity: 1
        }

        100% {
            -webkit-transform: scaleX(1);
            transform: scaleX(1);
            -webkit-transform-origin: 0 0;
            transform-origin: 0 0;
            opacity: 1
        }
    }

    .vh-100 {
        height: 100vh;
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
    .total-icon {
        font-size: 3em;
    }


    /*****/
        .total-title {
            font-size: 1rem;
            font-weight: 700;
        }
        .total-counter{
            line-height: 1;
        }
    /*****/
    .total-counter,
    .total-counter-hp,
    .total-counter-uti {
        min-width: 70px;
    }
    @media (max-width: 576px) {
        header .img-logo {
            height: 40px;
            width: auto;
        }
        .header-titles {
            font-size: 1rem;
        }

        .piso-height {
            height: auto;
        }

        /* .total-icon {
            font-size: 2rem !important;
        } */

        .total-counter,
        .total-counter-hp,
        .total-counter-uti {
            font-size: 4rem;
            line-height: 1;
        }

        header .h1 {
            font-size: 1rem !important;
        }

        header .h3 {
            font-size: 1rem !important;
        }


    }

    @media (min-width: 576px) {
        header .img-logo {
            height: 60px;
                width: 130px;
        }
        .piso-height {
            height: auto;
        }
        .header-titles {
            font-size: 1.5rem;
        }


        /* .total-icon {
            font-size: 3em;
        } */

        .total-title {
            font-size: 1rem;
            font-weight: 700;
        }

        .total-counter,
        .total-counter-hp,
        .total-counter-uti {
            font-size: 4rem;

        }
        .pc-cama_ocupada,
        .fa-bed {
            font-size: 0.6rem;
        }
        header .h1 {
            font-size: 2rem !important;
        }

        header .h3 {
            font-size: 2rem !important;
        }
    }

    @media (min-width: 992px) {

        .header-titles {
            font-size: 1.5rem;
        }
    }

    .total-btn:hover{
        background-color: var(--gray);
        color:var(--primary);
        cursor:pointer;
    }
      .valign-middle {
        vertical-align: middle !important;
      }
      .h-100{
        height:100vh !important;
      }
      .img-user-size {
          width: 40px;
          height: 40px;
          border-radius: 50%;
      }
      .img-logo {
          height: 60px;
          width: 130px;
      }
      .btn-user-home button {
        background-color: transparent;
        display: flex;
        color: white;
        align-items: center;
        border: 0px;
      }
    </style>
