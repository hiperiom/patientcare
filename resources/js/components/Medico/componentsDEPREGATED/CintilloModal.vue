<template>
    <div class="rounded d-flex">
        <button type="button" data-toggle="collapse" data-target="#collapseWidthExample" aria-expanded="true" aria-controls="collapseWidthExample" class="d-block d-md-none btn btn-default border-0 text-primary align-self-start">
            <i class="fas fa-ellipsis-v"></i>
        </button>
        <div id="collapseWidthExample" class="flex-grow-1 overflow-auto width collapse show">
            <nav class="flex-fill d-flex flex-column overflow-auto shadow-sm container-fluid bg-light">
                <div class="row flex-nowrap">
                    <div class="col-12 col-sm-6 col-md-3 col-lg-2  col-xl-3 px-1 d-flex flex-column">
                        <div class="flex-fill mb-1 p-1 card">
                            <div class="d-flex align-items-center">
                                <img
                                    onerror="this.src='/image/system/icono-paciente-blanco.svg';"
                                    :src="dataPaciente.imagen"
                                    data-tippy-content="Imagen del paciente"
                                    alt="..."
                                    class="tooltip-primary border border-primary rounded-circle m-1 d-block"
                                    style="width: 1.5cm; height: 1.5cm;"
                                >
                                <div data-tippy-content="Nombre del paciente" class="tooltip-primary ml-1 text-primary flex-grow-1 h4 mb-0">
                                    {{ dataPaciente.paciente }}

                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div data-tippy-content="Cédula del paciente" class="tooltip-primary flex-fill pl-1">
                                    <b class="text-primary" style="font-size: 0.8rem;">Cédula</b>
                                    <div class="text-secondary">
                                        {{ dataPaciente.nacionalidad+dataPaciente.cedula }}
                                    </div>
                                </div>
                                <div data-tippy-content="Edad" class="tooltip-primary flex-fill pl-1 border-left border-right">
                                    <b class="text-primary" style="font-size: 0.8rem;">Edad</b>
                                    <div class="text-secondary">{{ dataPaciente.edad }}</div>
                                </div>
                                <div data-tippy-content="Sexo" class="tooltip-primary flex-fill pl-1">
                                    <b class="text-primary" style="font-size: 0.8rem;">Sexo</b>
                                    <div class="text-secondary">{{ dataPaciente.genero.toUpperCase() }}</div>
                                </div>
                            </div>
                            <small class="text-light" style="font-size: 0.7em;">#{{ dataPaciente.user_id }}</small>
                        </div>

                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-lg-2 col-xl-1  px-0 d-flex flex-column">
                        <div class="flex-fill mb-1 p-1 card">
                            <b class="text-primary" style="font-size: 0.8rem;">Fecha Ingreso</b>
                            <div class="text-secondary">
                                <input
                                    :id="'ingreso'+dataPaciente.user_id"
                                    type="date"
                                    :value="getFechaIngreso()"
                                    class="cursor-pointer"
                                    style="
                                        width: 100%;
                                        border: 1px solid var(--gray);
                                        background-color: transparent;
                                        color: var( --secondary);
                                        text-align: center;
                                        border-radius: 50px;
                                    "
                                >
                            </div>
                        </div>
                        <div data-tippy-content="Ubicación Actual | Días desde el ingreso" class="tooltip-primary flex-fill mb-1 p-1 card">
                            <b class="text-primary" style="font-size: 0.8rem;">Ubicación actual</b>
                            <div class="text-secondary text-center">
                                {{ dataPaciente.ubicacion }}
                                <span class="badge badge-secondary">{{ dataPaciente.dias }}</span>

                            </div>
                        </div>
                        <div class="flex-fill mb-1 p-1 card">
                            <b class="text-primary" style="font-size: 0.8rem;">Teléfono contacto</b>
                            <div class="text-secondary">
                                <a
                                    target="_blank"
                                    :href="'https://api.whatsapp.com/send?phone='+ (!['null',null].includes(dataPaciente.telefono_movil) ? dataPaciente.telefono_movil.replace('+', '') : '')"
                                    class="btn btn-default btn-block"
                                    style="padding: 0% 3% 3%; border: 0px; line-height: 1.4;">
                                    <div class="text-gray text-nowrap overflow-hidden">
                                        <i class="fab fa-whatsapp text-success"></i> {{ !['null',null].includes(dataPaciente.telefono_movil) ? dataPaciente.telefono_movil.replace('+', '') : '' }}
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-5 px-1 d-flex flex-column overflow-auto">
                        <div class="flex-fill d-flex flex-column overflow-auto mb-1 p-1 card">
                            <b class="text-primary" style="font-size: 0.8rem;">
                                Probabilidad Diagnóstica
                                <span class="badge badge-secondary">{{ getProbDiagnostica().length }}</span>
                            </b>
                            <div class="flex-fill d-flex align-items-start justify-content-center overflow-auto" style="height: 100px;">
                                <ul class="list-group w-100 list-group-flush">
                                    <li v-for="(item,index) in getProbDiagnostica()" class="list-group-item p-1 bg-light text-gray">
                                        <div class="d-flex flex-column justify-content-start">
                                            {{item.value}}
                                        </div>
                                        <div class="d-flex flex-colum justify-content-end">
                                            <span class="badge badge-gray rounded-custom text-secondary"><i class="far fa-clock"></i> {{ item.medico }} <span class="text-primary">|</span> {{ getFechaCustom1(item.created_at) }} <span class="text-primary">|</span> {{ item.hora }}</span>
                                        </div>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-xl-2 col-xl-3 px-1 d-flex flex-column">
                        <div class="flex-fill mb-1 p-1 card">
                            <ul id="myTab" role="tablist" class="nav nav-tabs p-0 m-0 flex-nowrap">
                                <li role="presentation" class="nav-item p-0 m-0">
                                    <a id="equipoEspecialistas-tab" data-toggle="tab" href="#equipoEspecialistas" role="tab" aria-controls="equipoEspecialistas" aria-selected="true" class="nav-link p-0 m-0 px-2 active">
                                        <b class="text-center text-primary" style="font-size: 0.8em;">Médicos</b>
                                    </a>
                                </li>
                                <li role="presentation" class="nav-item p-0 m-0">
                                    <a id="equipoEnfermeria-tab" data-toggle="tab" href="#equipoEnfermeria" role="tab" aria-controls="equipoEnfermeria" aria-selected="false" class="nav-link p-0 px-2 m-0"><b class="text-center text-warning" style="font-size: 0.8em;">Enfermería</b>
                                    </a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div id="equipoEspecialistas" role="tabpanel" aria-labelledby="equipoEspecialistas-tab" class="tab-pane fade show active">
                                    <div id="doctoresPaciente" scope="row" class="p-0 pb-1">
                                        <ListEquipoMedico
                                            :medic_teem_patient="dataPaciente.medico_paciente"
                                            :episodio_id="dataPaciente.episodio_id"
                                            :medic_teem_to_show="[1,2,3,7,9]"
                                        />
                                    </div>
                                </div>
                                <div id="equipoEnfermeria" role="tabpanel" aria-labelledby="equipoEnfermeria-tab" class="tab-pane fade">
                                    <div id="enfermerosPaciente" scope="row" class="p-0 pb-1">
                                        <ListEquipoMedico
                                            :medic_teem_patient="dataPaciente.medico_paciente"
                                            :episodio_id="dataPaciente.episodio_id"
                                            :medic_teem_to_show="[10]"
                                        />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <ul class="list-group flex-grow-1 flex-nowrap flex-row overflow-auto mini-cintillo">
            <li class="list-group-item p-1 mr-1 text-nowrap">
                <img
                    onerror="this.src='/image/system/icono-paciente-blanco.svg';"
                    :src="dataPaciente.imagen"
                    data-tippy-content="Imagen del paciente"
                    alt="..."
                    class="tooltip-primary border border-primary rounded-circle m-1 d-block"
                    style="width: 1cm; height: 1cm;"
                >
            </li>
            <li class="list-group-item p-1 mr-1 text-nowrap">
                <div class="d-flex flex-column">
                    <b class="text-primary">Paciente</b>
                    <div class="overflow-hidden" >
                        {{ dataPaciente.paciente }}
                    </div>
                </div>
            </li>
            <li class="list-group-item p-1 mr-1 text-nowrap">
                <div class="d-flex flex-column">
                    <b class="text-primary">Cédula</b>
                    <div class="overflow-hidden" >
                        {{ dataPaciente.nacionalidad+dataPaciente.cedula }}
                    </div>
                </div>
            </li>
            <li class="list-group-item p-1 mr-1 text-nowrap">
                <div class="d-flex flex-column">
                    <b class="text-primary">Edad</b>
                    <div class="overflow-hidden" >
                        {{ dataPaciente.edad }}
                    </div>
                </div>
            </li>
            <li class="list-group-item p-1 mr-1 text-nowrap">
                <div class="d-flex flex-column">
                    <b class="text-primary">Sexo</b>
                    <div class="overflow-hidden" >
                        {{ dataPaciente.genero }}
                    </div>
                </div>
            </li>
            <li class="list-group-item p-1 mr-1 text-nowrap">
                <div class="d-flex flex-column">
                    <b class="text-primary">Fecha Ingreso</b>
                    <div class="overflow-hidden" >
                        <input
                            :id="'ingreso2'+dataPaciente.user_id"
                            type="date"
                            :value="getFechaIngreso()"
                            class="cursor-pointer"
                            style="
                                width: 100%;
                                border: 1px solid var(--gray);
                                background-color: transparent;
                                color: var( --secondary);
                                text-align: center;
                                border-radius: 50px;
                            "
                        >
                    </div>
                </div>
            </li>
            <li class="list-group-item p-1 mr-1 text-nowrap">
                <div class="d-flex flex-column">
                    <b class="text-primary">Ubicación actual</b>
                    <div class="overflow-hidden" >
                        {{ dataPaciente.ubicacion }}
                        <span class="badge badge-secondary">{{ dataPaciente.dias }}</span>
                    </div>
                </div>
            </li>
            <li class="list-group-item p-1 mr-1 text-nowrap">
                <div class="d-flex flex-column">
                    <b class="text-primary">Teléfono contacto</b>
                    <div class="overflow-hidden" >
                        <a
                            target="_blank"
                            :href="'https://api.whatsapp.com/send?phone='+ (!['null',null].includes(dataPaciente.telefono_movil) ? dataPaciente.telefono_movil.replace('+', '') : '')"
                            class="btn btn-default btn-block"
                            style="padding: 0% 3% 3%; border: 0px; line-height: 1.4;">
                            <div class="text-gray text-nowrap overflow-hidden">
                                <i class="fab fa-whatsapp text-success"></i> {{ !['null',null].includes(dataPaciente.telefono_movil) ? dataPaciente.telefono_movil.replace('+', '') : '' }}
                            </div>
                        </a>
                    </div>
                </div>
            </li>


        </ul>
    </div>
</template>

<script>
import { fechaAMD,fechaCustom1 } from '../../../helpers/customHelpers';
import ListEquipoMedico from './ListEquipoMedico.vue';
    export default {
        name:"CintilloModal",
        components:{
            ListEquipoMedico
        },
        props:{
            index_row:Number,
            dataPaciente:Object
        },
        methods: {
            getFechaCustom1(item){
                return fechaCustom1(item)
            },
            getFechaIngreso() {
                return fechaAMD(this.dataPaciente.ingreso_episodio)
            },
            getProbDiagnostica(){
                return this.dataPaciente.resultados.filter(item=>{
                    if (item.description ==="Probabilidad diagnóstica") {
                        return item
                    }
                })
            },
        },
    }
</script>

<style lang="scss" scoped>
    #collapseWidthExample.collapse.show{
        display:flex;
        flex-direction: column;
    }
    .mini-cintillo{
        display:flex;
    }
    #collapseWidthExample.collapse.show + .mini-cintillo {
      display: none;
    }
</style>
