<template>
    <div>
        <div v-if="$store.state.items_currentResult.length > 0" class="timeline timeline-inverse">
            <!-- FECHA DEL DIA -->
            <div v-for="(item,index) in $store.state.items_currentResult" :key="index">

                <div class="time-label">
                    <span class="bg-primary">
                        {{ item.fechaFormated }}
                    </span>
                </div>
                <!-- EVOLUCIONES DEL DIA -->
                <div v-for="(item2,index2) in item.items" :key="index2">

                    <i
                        :content="'Equipo Médico'"
                        v-tippy="{ arrow : true, placement:'top-end', zIndex:99999, theme : 'tooltip-primary' }"
                        data-tippy-content="Equipo Médico"
                        class="timelime-medic-icon fas fa-user-md"
                        aria-hidden="true">
                    </i>
                    <div class="timeline-item">
                        <!-- FECHA DEL ITEM + BOTON PARA IMPRIMIR -->
                        <span class="time">
                            <i class="far fa-clock"></i>
                            {{ item2.fechaItem }}
                            <span class="text-primary">|</span>
                            {{ item2.hora }}
                            <a
                                class="m-0 p-0 imprimir"
                                type="button"
                                @click="handle_imprimir({'type':'one','name':item2.description,'id':item2.id,'impresion':'color',})"
                                :content="'Imprimir'"
                                v-tippy="{ arrow : true, placement:'top-end', zIndex:99999, theme : 'tooltip-info' }"
                            >
                                <i
                                    class="imprimir m-0 p-0 fas fa-print text-info heartbeat"
                                    style="font-size: 1em;cursor:pointer; margin-left:1em;"
                                    aria-hidden="true">
                                </i>
                            </a>
                        </span>
                        <h3 class="timeline-header">
                            <!-- TIPO DE ITEM + USUARIO -->
                            <b>{{ item2.description }}</b> |
                            <a href="#">{{ item2.dataMedico.prefijo }} {{ item2.dataMedico.medico }}</a>
                            <span
                                :content="'Equipo '+item2.dataMedico_posicion.nombre"
                                v-tippy="{ arrow : true, placement:'top-end', zIndex:99999, theme : 'tooltip-'+item2.dataMedico_posicion.color }"
                                :class="['badge  scale-in-hor-left',('badge-'+item2.dataMedico_posicion.color)]"
                                style="width:2em;">
                                {{ item2.dataMedico_posicion.siglas }}
                            </span>
                        </h3>

                        <div
                            class="timeline-body"
                            v-html="item2.dato"
                        >
                        </div>

                    </div>
                </div>
            </div>
            <div>
                <i class="far fa-clock bg-gray"></i>
            </div>
        </div>
        <div v-else class="timeline timeline-inverse">
            <div>
                <div>
                    <div class="timeline-item">
                        <div class="timeline-body text-secondary text-center">
                            No posee historia este día
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <i class="far fa-clock bg-gray"></i>
            </div>
        </div>
    </div>
</template>

<script>
import { get, is_empty,obtenerVariablesGET,  is_null,is_undefined } from '../../../helpers/customHelpers';
export default {
    name:"ListItemsEvolucion",
    props:{

        index_row:Number,
        dataPaciente:Object
    },
    components: {

    },
    data() {
        return {

        }
    },
    methods:{
        handle_imprimir(object){
            console.log(object);
            let description = "";
                switch(object.name){
                    case "Orden Médica": description = "orden_medica"; break;
                    case "Evolución": description = "evolucion"; break;
                    case "Pendiente": description = "pendiente"; break;
                    case "Probabilidad diagnóstica": description = "probabilidad_diagnostica"; break;
                    case "Plan": description = "plan"; break;
                    case "Observación": description = "observacion"; break;
                    case "Récipe": description = "recipe"; break;
                    case "Estudio Diagnóstico": description = "estudio_diagnostico"; break;
                    case "Laboratorio": description = "laboratorio"; break;
                    case "Imagenes": description = "imagenes"; break;
                    case "Otro": description = "otro"; break;
                    default: alert("Error. Reporte no encotrado"); return false; break;
                }
                if (['Orden Médica'].includes(object.name)) {
                    window.open(location.origin+`/user/informe/omed/orden_medica/${this.dataPaciente.episodio_id}/${object.id}`)
                    return false
                }
                if (['Evolución'].includes(object.name)) {
                    window.open(location.origin+`/user/informe/nde/evolucion_medica/${this.dataPaciente.episodio_id}/${object.id}`)
                    return false
                }
                if (['Récipe'].includes(object.name)) {
                    window.open(location.origin+`/user/informe/recmed/recipe_medico/${this.dataPaciente.episodio_id}/${object.id}`)
                    return false
                }
                if (object.type==="one") {

                    window.open(`/user/reporte/${description}/${this.dataPaciente.episodio_id}/${object.id}/${object.impresion}`)

                }else{
                    window.open(`/user/reporte/${description}/${this.dataPaciente.episodio_id}/all/${object.impresion}`)
                }
        }

    },
    updated(){
        //this.configData()


    },
    mounted(){
        //this.configData()


    }
}
</script>

<style scoped>
    .timeline {
        margin: 0 0 45px;
        padding: 0;
        position: relative;
    }
    .timeline::before {
        border-radius: 0.25rem;
        background: #dee2e6;
        bottom: 0;
        content: '';
        left: 31px;
        margin: 0;
        position: absolute;
        top: 0;
        width: 4px;
    }
    .timeline > div> div {
        margin-bottom: 15px;
        margin-right: 10px;
        position: relative;
    }
    .timeline > div > div .timelime-medic-icon {
        background: var(--primary);
        color: var(--white);
        border-radius: 50%;
        font-size: 15px;
        height: 30px;
        left: 18px;
        line-height: 30px;
        position: absolute;
        text-align: center;
        top: 0;
        width: 30px;
    }
    .timeline > div > div .timelime-enfermeria-icon {
        background: var(--warning);
        color: var(--dark);
        border-radius: 50%;
        font-size: 15px;
        height: 30px;
        left: 18px;
        line-height: 30px;
        position: absolute;
        text-align: center;
        top: 0;
        width: 30px;
    }
    .timeline > div > .time-label > span {
        border-radius: 4px;
        background-color: #ffffff;
        display: inline-block;
        font-weight: 600;
        padding: 5px;
        font-size: 1em;
    }

    .timeline > div > div > .timeline-item {
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
        border-radius: 0.25rem;
        background: #ffffff;
        color: #495057;
        margin-left: 60px;
        margin-right: 15px;
        margin-top: 0;
        padding: 0;
        position: relative;
    }
    .timeline-inverse > div > div >.timeline-item {
        box-shadow: none;
        background: #ffffff;
        border: 1px solid #dee2e6;
        font-size: 1.1rem;
    }
    .timeline > div > div > .timeline-item > .time {
        color: #999;
        float: right;
        font-size: 12px;
        padding: 10px;
    }
    .timeline > div > div > .timeline-item > .timeline-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        color: #495057;
        font-size: 16px;
        line-height: 1.1;
        margin: 0;
        padding: 10px;
    }
    .timeline > div > div > .timeline-item>.timeline-header > a {
        font-weight: 600;
    }
    .timeline > div > div > .timeline-item>.timeline-body,
    .timeline > div > div > .timeline-item>.timeline-footer {
        font-size: 16px;
        padding: 10px;
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
</style>
