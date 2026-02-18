<template>
    <div class="d-flex mt-1" style="width: fit-content !important;">
        <div class="flex-shrink-1 d-flex flex-column mx-1">
            <img
                loading="lazy"
                :src="dataPaciente.imagen"
                onerror="this.src ='https://placehold.co/100x100'"
                style="width: 1cm; height: 1cm;object-fit: cover;"
                class="border border-primary rounded-circle mx-auto d-block"
            />
            <small style="font-size: 60%;color:#e7e8e8b3">id#{{ dataPaciente.user_id }}</small>
            <small style="font-size: 60%;color:#e7e8e8b3">epi#{{ dataPaciente.episodio_id }}</small>
        </div>
        <div class=" d-flex flex-column">
            <div class="d-flex">
                <div class="d-flex flex-grow-1 align-items-center flex-sm-row">
                    <div class="flex-grow-1 d-flex flex-column order-2 order-sm-1">
                        <h4 data-tippy-content="Nombre del paciente" class="flex-grow-1 text-primary text-wrap"
                            style="margin-bottom: 0; max-width: 230px">
                            {{ dataPaciente.nombres }} {{ dataPaciente.apellidos}}<br>
                            <small class="badge text-secondary" style="background-color: #dbdbdb; font-size: 0.8rem;">
                                {{ dataPaciente.nacionalidad }}{{ dataPaciente.cedula }}
                            </small>

                        </h4>
                    </div>
                </div>
                <div class="flex-shrink-1 d-flex order-1 order-sm-2">


                    <BtnGroupRiesgoCirugia
                        :index_row="index_row"
                        :dataPaciente="dataPaciente"
                    />
                    <BtnGroupRiesgoResbalar
                        :index_row="index_row"
                        :dataPaciente="dataPaciente"
                    />
                    <BtnGroupRiesgoAlerta
                        :index_row="index_row"
                        :dataPaciente="dataPaciente"
                    />
                    <BtnVIP
                        :index_row="index_row"
                        :dataPaciente="dataPaciente"
                    />


                </div>
            </div>
            <div class="d-flex">
                <div class="dropdown">
                    <button
                        content="Información del paciente"
                        v-tippy="{ arrow : true, theme : 'tooltip-success' }"
                        type="button"
                        class="btn btn-default-custom border-0"
                        :id="'InfoPacienteMenuButton'+dataPaciente.episodio" data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i class="pc-paciente-info-solid text-success heartbeat h3 mb-0" ></i>
                    </button>
                    <div class="dropdown-menu" :aria-labelledby="'InfoPacienteMenuButton'+dataPaciente.episodio" >
                        <button
                            content="Información del paciente"
                            v-tippy="{ arrow : true, theme : 'tooltip-success' }"
                            @click="handle_InfoPaciente()"  class="dropdown-item" href="#">
                            <i class="pc-paciente-info-solid text-success heartbeat h3 mb-0" ></i>
                            Información del paciente
                        </button>
                        <button
                            content="Información administrativa"
                            v-tippy="{ arrow : true, theme : 'tooltip-purple' }"
                            @click="handle_InfoAdministrativaPaciente()"  class="dropdown-item" href="#">
                            <i class="pc-info_administracion_solid text-purple heartbeat h3 mb-0" ></i>
                            Información administrativa
                        </button>
                    </div>
                </div>
                <div class="dropdown">
                    <button
                        content="Triaje"
                        v-tippy="{ arrow : true, theme : 'tooltip-primary' }"
                        @click="handle_TriajePaciente()"
                        type="button"
                        class="btn btn-default-custom border-0"
                        :id="'EmergenciaMenuButton'+dataPaciente.episodio"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i class="pc-triaje1 text-primary heartbeat h3 mb-0" ></i>
                    </button>
                    <div class="d-none dropdown-menu" :aria-labelledby="'InfoAdministrativaMenuButton'+dataPaciente.episodio" >
                        <button  class="dropdown-item" href="#">Informe Preliminar de Emergencia</button>
                    </div>
                </div>
                <div class="dropdown">
                    <button @click="handle_InformePreliminarEmergenciaPaciente()" type="button" class="btn btn-default-custom border-0" :id="'InformePreliminarEmergenciaPacienteMenuButton'+dataPaciente.episodio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="pc-folder_informes text-primary heartbeat h3 mb-0" ></i>
                    </button>
                    <div class="d-none dropdown-menu" :aria-labelledby="'InformePreliminarEmergenciaPacienteMenuButton'+dataPaciente.episodio" >
                        <button  class="dropdown-item" href="#">Informe Preliminar de Emergencia</button>
                    </div>
                </div>

                <div class="dropdown">
                    <button type="button" class="btn btn-default-custom border-0" :id="'HistoriaPacienteMenuButton'+dataPaciente.episodio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="pc-solid-history-folder text-secondary heartbeat h3 mb-0" ></i>
                    </button>
                    <div class="dropdown-menu" :aria-labelledby="'HistoriaPacienteMenuButton'+dataPaciente.episodio" >
                        <button @click="handle_HistoriaInicialPaciente()" class="dropdown-item" href="#">
                            <i class="pc-historia-inicial-solid text-success heartbeat h3 mb-0" ></i> Historia Inicial
                        </button>
                        <button @click="handle_EpisodiosAnterioresPaciente()" class="dropdown-item" href="#">
                            <i class="pc-historial-episodios-solid text-success heartbeat h3 mb-0" ></i> Episodios anteriores
                        </button>
                    </div>
                </div>
                <div class="dropdown">
                    <button @click="handle_EvolucionEquipoMedico()" type="button" class="btn btn-default-custom border-0" :id="'EvolucionEquipoMedicoMenuButton'+dataPaciente.episodio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="pc-solid-evolucion text-primary heartbeat h3 mb-0" ></i>
                    </button>
                    <div class="d-none dropdown-menu" :aria-labelledby="'EvolucionEquipoMedicoMenuButton'+dataPaciente.episodio" >
                        <button  class="dropdown-item" href="#"></button>
                    </div>
                </div>
                <div class="dropdown">
                    <button @click="handle_PendientesPaciente()" type="button" class="btn btn-default-custom border-0" :id="'PendientesPacienteMenuButton'+dataPaciente.episodio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="pc-pendiente_paciente text-primary heartbeat h3 mb-0" ></i>
                    </button>
                    <div class="d-none dropdown-menu" :aria-labelledby="'PendientesPacienteMenuButton'+dataPaciente.episodio" >
                        <button  class="dropdown-item" href="#"></button>
                    </div>
                </div>
                <div class="dropdown">
                    <button @click="handle_WhatsappPaciente()" type="button" class="btn btn-default-custom border-0" :id="'WhatsappPacienteMenuButton'+dataPaciente.episodio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="pc-whatsapp-solid text-success heartbeat h3 mb-0" ></i>
                    </button>
                    <div class="d-none dropdown-menu" :aria-labelledby="'WhatsappPacienteMenuButton'+dataPaciente.episodio" >
                        <button  class="dropdown-item" href="#"></button>
                    </div>
                </div>



            </div>
        </div>

    </div>
</template>

<script>
    import { get, is_empty, is_null,is_undefined } from '../../../helpers/customHelpers';
    import BtnGroup from './BtnGroup.vue';
    import BtnGroupRiesgoCirugia from './BtnGroupRiesgoCirugia.vue';
    import BtnGroupRiesgoResbalar from './BtnGroupRiesgoResbalar.vue';
    import BtnGroupRiesgoAlerta from './BtnGroupRiesgoAlerta.vue';

    import BtnWidgetPatientInfo from './BtnWidgetPatientInfo.vue';
    import BtnWidgetInformePreliminarEmergencia from './BtnWidgetInformePreliminarEmergencia.vue';
    import BtnWidgetInfoAdministrativaPaciente from './BtnWidgetInfoAdministrativaPaciente.vue';
    import BtnWidgetHistoriaInicialPaciente from './BtnWidgetHistoriaInicialPaciente.vue';
    import BtnWidgetEpisodiosAnterioresPaciente from './BtnWidgetEpisodiosAnterioresPaciente.vue';
    import BtnWidgetEvolucionEquipoMedico from './BtnWidgetEvolucionEquipoMedico.vue';
    import BtnWidgetPendientesPaciente from './BtnWidgetPendientesPaciente.vue';
    import BtnWidgetWhatsappPaciente from './BtnWidgetWhatsappPaciente.vue';
    import BtnWidgetTriaje from './BtnWidgetTriaje.vue';
    import BtnVIP from './BtnVIP.vue';



    export default {
        name:"CardPaciente",
        data() {
            return {

            }
        },
        components:{
            BtnWidgetPatientInfo,
            BtnWidgetInformePreliminarEmergencia,
            BtnWidgetInfoAdministrativaPaciente,
            BtnWidgetHistoriaInicialPaciente,
            BtnWidgetEpisodiosAnterioresPaciente,
            BtnWidgetEvolucionEquipoMedico,
            BtnWidgetPendientesPaciente,
            BtnWidgetWhatsappPaciente,
            BtnGroup,
            BtnVIP,
            BtnGroupRiesgoCirugia,
            BtnGroupRiesgoResbalar,
            BtnGroupRiesgoAlerta,
            BtnWidgetTriaje,


        },
        props:{
            index_row:Number,
            dataPaciente:Object
        },
        methods:{
            primeraLetra(str) {
                return str[0].toUpperCase() + str.slice(1);
            },
            handle_InfoPaciente(){
                this.$store.commit('updateProperty', {
                    fieldName:'componenteDinamico',
                    fieldValue: {
                        customComponent: this.$options.components.BtnWidgetPatientInfo,
                        customComponent2: null,
                        index_row:this.index_row,
                        dataPaciente:this.dataPaciente
                    }
                });

                $("#exampleModal").modal("show")
            },
            handle_TriajePaciente(){
                this.$store.commit('updateProperty', {
                    fieldName:'componenteDinamico',
                    fieldValue: {
                        customComponent: this.$options.components.BtnWidgetTriaje,
                        customComponent2: null,
                        index_row:this.index_row,
                        dataPaciente:this.dataPaciente
                    }
                });

                $("#exampleModal").modal("show")
            },
            handle_historiaInicial(){
                this.$store.commit('updateProperty', {
                    fieldName:'componenteDinamico',
                    fieldValue: {
                        customComponent: this.$options.components.BtnWidgetHistoriaInicial,
                        customComponent2: null,
                        index_row:this.index_row,
                        dataPaciente:this.dataPaciente
                    }
                });

                $("#exampleModal").modal("show")
            },
            handle_InformePreliminarEmergenciaPaciente(){
                this.$store.commit('updateProperty', {
                    fieldName:'componenteDinamico',
                    fieldValue: {
                        customComponent: this.$options.components.BtnWidgetInformePreliminarEmergencia,
                        customComponent2: null,
                        index_row:this.index_row,
                        dataPaciente:this.dataPaciente
                    }
                });

                $("#exampleModal").modal("show")
            },
            handle_InfoAdministrativaPaciente(){
                this.$store.commit('updateProperty', {
                    fieldName:'componenteDinamico',
                    fieldValue: {
                        customComponent: this.$options.components.BtnWidgetInfoAdministrativaPaciente,
                        customComponent2: null,
                        index_row:this.index_row,
                        dataPaciente:this.dataPaciente
                    }
                });


                $("#exampleModal").modal("show")
            },
            handle_HistoriaInicialPaciente(){
                this.$store.commit('updateProperty', {
                    fieldName:'componenteDinamico',
                    fieldValue: {
                        customComponent: this.$options.components.BtnWidgetHistoriaInicialPaciente,
                        customComponent2: null,
                        index_row:this.index_row,
                        dataPaciente:this.dataPaciente
                    }
                });

                $("#exampleModal").modal("show")
            },
            handle_EpisodiosAnterioresPaciente(){
                this.$store.commit('updateProperty', {
                    fieldName:'componenteDinamico',
                    fieldValue: {
                        customComponent: this.$options.components.BtnWidgetEpisodiosAnterioresPaciente,
                        customComponent2: null,
                        index_row:this.index_row,
                        dataPaciente:this.dataPaciente
                    }
                });

                $("#exampleModal").modal("show")
            },
            handle_EvolucionEquipoMedico(){
                this.$store.commit('updateProperty', {
                    fieldName:'componenteDinamico',
                    fieldValue: {
                        customComponent: this.$options.components.BtnWidgetEvolucionEquipoMedico,
                        customComponent2: this.$options.components.BtnWidgetEvolucionEquipoMedico,
                        index_row:this.index_row,
                        dataPaciente:this.dataPaciente
                    }
                });

                $("#exampleModal").modal("show")
            },
            handle_WhatsappPaciente(){
                this.$store.commit('updateProperty', {
                    fieldName:'componenteDinamico',
                    fieldValue: {
                        customComponent: this.$options.components.BtnWidgetWhatsappPaciente,
                        index_row:this.index_row,
                        dataPaciente:this.dataPaciente
                    }
                });

                $("#exampleModal").modal("show")
            },
            handle_PendientesPaciente(){
                this.$store.commit('updateProperty', {
                    fieldName:'componenteDinamico',
                    fieldValue: {
                        customComponent: this.$options.components.BtnWidgetPendientesPaciente,
                        customComponent2: null,
                        index_row:this.index_row,
                        dataPaciente:this.dataPaciente
                    }
                });

                $("#exampleModal").modal("show")
            },


            getFullName(item){

                let temp1 = is_null( item.nombres) ? [''] : item.nombres.split(" ")
                let temp2 = is_null( item.apellidos) ? [''] : item.apellidos.split(" ")
                    return `${temp1[0]} ${temp2[0]}`
            },
        },
    }
</script>

<style lang="scss" scoped>
.btn-default-custom {
    background-color: transparent;
}
.btn-default-custom:hover {
    background-color: #e2e2e2;
}
.tippy-tooltip {
    position: relative;
    color: #fff;
    border-radius: 0.25rem;
    font-size: .875rem;
    padding: 0px !important;
    line-height: 1.4;
    text-align: center;
    background-color: #333;
}
.tippy-content {
    position: relative;
    padding: 0px !important;
    z-index: 1;
}
</style>
