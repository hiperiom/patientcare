<template>
    <div class="flex-fill d-flex overflow-auto">

        <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-light">
                    <div class="modal-header">
                        <img src="/image/system/logo-cmdlt_color.svg" style="height: 3em;" class="img-fluid float-right"
                            alt="Imagen CMDLT">
                        <button type="button" class="close btn-close-modal" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <component
                            :is="getComponenteDinamico.customComponent2"
                            :index_row="getComponenteDinamico.index_row"
                            :dataPaciente="getComponenteDinamico.dataPaciente"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fullscreen-modal fade" style="z-index: 10000;" id="exampleModal" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content d-flex flex-column overflow-auto vh-100">
                    <div class="modal-header p-0">
                        <nav class="d-flex justify-content-between align-items-center bg-primary rounded-pill m-1 ">
                            <i id="close_modal" data-dismiss="modal" aria-label="Close"
                                class="ml-3 fas fa-times text-white heartbeat" style="font-size: 2em;cursor:pointer;"
                                aria-hidden="true"></i>

                            <img class="img-logo m-1 d-block"
                                src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg"
                                alt="Logo CMDLT">
                        </nav>
                    </div>
                    <div class="modal-body p-0 container-fluid fullscreen d-flex flex-column overflow-auto">
                        <component
                            :is="getComponenteDinamico.customComponent"
                            :index_row="getComponenteDinamico.index_row"
                            :dataPaciente="getComponenteDinamico.dataPaciente"
                        />
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="doctorsListModal" style="z-index: 100000;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content d-flex flex-column vh-100">
                    <div class="modal-header d-flex align-items-center justify-content-between text-white">
                        <h5 class="modal-title" id="doctorsListModalLabel">Modal title</h5>
                        <button type="button" class="btn bg-transparent p-1" data-dismiss="modal" aria-label="Close">
                            <span class="text-white" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="flex-fill modal-body-3 container-fluid p-0 d-flex flex-column overflow-auto">
                        <component
                            :is="getComponenteDinamico.customComponent2"
                            :dataGrupoMedico="getComponenteDinamico.dataGrupoMedico"

                        />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="nav-patientcare flex-fill m-1 d-flex flex-column overflow-auto shadow-box rounded-pill-custom-1"
            style="background-color: #fafdff;">
            <div>

            </div>
            <!--  -->
            <table id="myTable" ref="myTable"  class="table table-bordered">
                <thead>
                    <tr>
                        <th content="Ubicación del paciente" v-tippy="{ arrow : true, theme : 'tooltip-primary' }">UBI</th>
                        <th content="Días desde el ingreso" v-tippy="{ arrow : true, theme : 'tooltip-primary' }">DÍAS</th>
                        <th content="Información del paciente" v-tippy="{ arrow : true, theme : 'tooltip-primary' }">PACIENTE</th>
                        <th content="Género" v-tippy="{ arrow : true, theme : 'tooltip-primary' }">SEXO</th>
                        <th content="Edad"  v-tippy="{ arrow : true, theme : 'tooltip-primary' }">EDAD</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody v-if="getListPacientes.length > 0">
                    <tr :class="handleActivePrealta(item)['effectRowPrealta']" :id="'col_1_'+item.user_id" v-for="(item, index) in $store.state.pacientes_datos" :key="index">
                        <td style="width: 10%;" >
                            <input type="hidden" :id="'fecha_prealta_'+item.user_id" :value="item.prealta">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <button @click="handleHistorialUbicaciones(index, item)"
                                        class="btn btn-default-custom text-secondary text-uppercase flex-nowrap"
                                        data-tippy-content="Historial de ubicaciones del paciente">
                                        {{ item.ubicacion }}
                                    </button>

                                    <div
                                        :id="'card_prealta_'+item.user_id"
                                        content="Fecha Probable de Alta"
                                        v-tippy="{ arrow : true, theme : 'tooltip-'+item['prealta_color'] }"

                                        :class="[
                                            'text-white cursor-pointer rounded mx-1 px-1 text-center',
                                            {

                                                'd-none':item['prealta']===null
                                            },
                                            handleActivePrealta(item)['effectCardPrealta'],
                                            handleActivePrealta(item)['bgColor']
                                        ]
                                            ">
                                        <div class="font-weight-bold" style="font-size: 0.8em;">
                                            <i class="fas fa-stopwatch"></i> <span :id="'title_prealta_'+item.user_id"> ALTA</span>
                                        </div>
                                        <div>
                                            {{ handleActivePrealta(item)['fechaPrealta']}}
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <button @click="handle_PrealtaPaciente(index, item)"
                                        data-tippy-content="Agregar Fecha Probable de Alta"
                                        class="btn btn-block"
                                        style="background-color: #eeefef;border-color: #ddd;color: #444;">
                                        <i :class="['far calendar-prealta',handleActivePrealta(item)['icon'],handleActivePrealta(item)['textColor']]"></i>
                                    </button>
                                    <button @click="handle_TrasladoAmbulanciaPaciente(index, item)"
                                        id="btn_traslado_ambulancia"
                                        :content="item['traslado_ambulancia']!==null ? getFechaTrasladoAmbulancia(item):'Traslados en ambulancia'"
                                        v-tippy="{ arrow : true, theme : 'tooltip-'+(item['traslado_ambulancia']!==null ? 'danger':'gray') }"
                                        class="btn btn-block"
                                        style="background-color: #eeefef;border-color: #ddd;color: #444;">
                                        <i :class="['fas fa-ambulance',{'text-danger':item['traslado_ambulancia']!==null},{'text-secondary':item['traslado_ambulancia']===null}]"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="text-secondary" style="width: 1%;vertical-align: middle;text-align: center;">
                            {{ item.dias }}
                        </td>
                        <td style="width: fit-content !important;">
                            <CardPaciente :index_row="index" :dataPaciente="item" />
                        </td>
                        <td class="text-secondary text-uppercase"
                            style="width: 1%;vertical-align: middle;text-align: center;">
                            {{ item.sexo }}
                        </td>
                        <td class="text-secondary" style="width: 1%;vertical-align: middle;text-align: center;">
                            {{ item.edad }}
                        </td>
                        <td></td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td class="p-4 text-center text-primary" colspan="6">No se encontraron pacientes en esta ubicación
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import { get, is_empty,capitalize,meses, is_null,horaAMPM, is_undefined } from '../../../helpers/customHelpers';
    import CardPaciente from './CardPaciente.vue';
    import BtnWidgetHistorialUbicaciones from './BtnWidgetHistorialUbicaciones.vue';
    import BtnWidgetTrasladoAmbulancia from './BtnWidgetTrasladoAmbulancia.vue';
    import BtnWidgetPrealtaPaciente from './BtnWidgetPrealtaPaciente.vue';
    export default {
        name: "PatientList",
        components: {
            CardPaciente,
            BtnWidgetHistorialUbicaciones,
            BtnWidgetTrasladoAmbulancia,
            BtnWidgetPrealtaPaciente,
        },
        data() {
            return {

            }
        },
        computed: {
            getComponenteDinamico() {
                return this.$store.state.componenteDinamico
            },
            getListPacientes() {
                return this.$store.state.pacientes_datos
            }
        },
        methods: {
            getFechaTrasladoAmbulancia(valueOfElement){
                let f = null;
                let fecha = null;
               /*  if (
                    !is_null(valueOfElement['traslado_ambulancia']) &&
                    !is_undefined(valueOfElement['traslado_ambulancia'])
                ) { */
                    console.log("----->",valueOfElement['traslado_ambulancia'])
                    let fechaTimestamp = valueOfElement['traslado_ambulancia']['fecha_traslado']
                    let hora = fechaTimestamp.split(" ")
                    f =new Date(fechaTimestamp);
                    fecha = f.getDate() + " de " + meses(f.getMonth()) + " "+ f.getFullYear()+ ", a las " + horaAMPM(hora[1]);
                    return fecha
                /* } */
            },
            handleActivePrealta(valueOfElement){
                if (!is_null(valueOfElement['prealta']) && valueOfElement['prealta'] !== undefined) {
                    let d = document;
                    let fecha = valueOfElement['prealta'].split("-")
                    let f = new Date(fecha[0],(parseInt(fecha[1])-1),fecha[2]);
                    let effectCardPrealta = ['danger','warning'].includes(valueOfElement['prealta_color'])  ? 'heartbeat_infinity' : ''
                    let effectRowPrealta = ['danger','warning'].includes(valueOfElement['prealta_color'])  ? 'prealta' : ''
                        return {
                            effectRowPrealta,
                            effectCardPrealta,
                            bgColor:"bg-"+valueOfElement['prealta_color'],
                            textColor:"text-"+valueOfElement['prealta_color'],
                            icon:"fa-calendar-check",
                            fechaPrealta: f.getDate() + "/" + String(meses(f.getMonth()).slice(0,3)).toUpperCase()  + "/" +  f.getFullYear()
                        }
            }else{
                    return {
                        effectRowPrealta:"",
                        effectCardPrealta:"",
                        bgColor:"",
                        textColor:"text-gray",
                        icon:"fa-calendar",
                        fechaPrealta: "00/00/0000"
                    }
                }
            },
            handleHistorialUbicaciones(index_row, dataPaciente) {
                this.$store.commit('updateProperty', {
                    fieldName: 'componenteDinamico',
                    fieldValue: {
                        customComponent: this.$options.components.BtnWidgetHistorialUbicaciones,
                        index_row: index_row,
                        dataPaciente: dataPaciente
                    }
                });

                $("#exampleModal").modal("show")
            },
            handle_TrasladoAmbulanciaPaciente(index_row, dataPaciente) {
                this.$store.commit('updateProperty', {
                    fieldName: 'componenteDinamico',
                    fieldValue: {
                        customComponent: this.$options.components.BtnWidgetTrasladoAmbulancia,
                        index_row: index_row,
                        dataPaciente: dataPaciente
                    }
                });

                $("#exampleModal").modal("show")
            },
            handle_PrealtaPaciente(index_row, dataPaciente) {
                this.$store.commit('updateProperty', {
                    fieldName: 'componenteDinamico',
                    fieldValue: {
                        customComponent2: this.$options.components.BtnWidgetPrealtaPaciente,
                        index_row: index_row,
                        dataPaciente: dataPaciente
                    }
                });

                $("#messageModal").modal("show")
            },

        },
        mounted() {
            //$("#doctorsListModal").modal("show")
            //this.filtroTabla()
        },
        updated() {

        }
    }
</script>

<style lang="scss" scoped>
/* // Medium devices (tablets, 768px and up) */
@media (min-width: 768px) {
    .overflow-md-auto{
        overflow:auto !important;
    }
}
.btn-orange {
    color: #ffffff;
    background-color: var(--orange);
    border-color: var(--orange);
    box-shadow: none;
}
.btn-purple {
    color: #ffffff;
    background-color: var(--purple);
    border-color: var(--purple);
    box-shadow: none;
}
#myTable td {
    padding: 0px;
}
#myTable td:nth-child(odd) {
    background-color: #e7e8e8b3 !important;
}
#myTable thead tr th {
    position: -webkit-sticky;
    position: sticky;
    top: -1px;
    z-index: 1;
    color:var(--secondary);
    background-color: var(--gray);
    text-align: center;
}
.btn-default-custom {
    background-color: transparent;
}

.btn-default-custom:hover {
    background-color: #e2e2e2;
}
.heartbeat_infinity {
    -webkit-animation: heartbeat2 1.5s ease-in-out infinite both;
    animation: heartbeat2 1.5s ease-in-out infinite both
}

@-webkit-keyframes heartbeat2 {
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

@keyframes  heartbeat2 {
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
.prealta {

-webkit-animation: mymove 2s infinite;
/* Chrome, Safari, Opera */
animation: mymove 2s infinite;
}

/* Chrome, Safari, Opera */
@-webkit-keyframes mymove {
from {
    background-color: #e7e8e8b3;
    color: var(--color-esperanza-light)
}

to {
    background-color: white;
    color: var(--color-custom-primary)
}
}

/* Standard syntax */
@keyframes  mymove {
from {
    background-color: #e7e8e8b3;
    color: var(--color-esperanza-light)
}

to {
    background-color: white;
    color: var(--color-custom-primary)
}
}

</style>
