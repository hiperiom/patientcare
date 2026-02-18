<template>
    <!-- RESIDENTES -->
    <td :style="'width:10% !important;height:'+height" class="glassmod-effect text-left p-1">


        <div v-if="patient && medic_team.length > 0"
            style="width:100%;"
            :class="['text-left d-flex flex-wrap', { 'flex-column':patient && medic_team.length > 0 }]">

            <div v-for="(item2, index2) in medic_team" :key="index2"
                class="d-flex align-items-center">
                <img loading="lazy" onerror="this.src='/image/system/patient.svg'" :src="item2.imagen"
                    class="img-doctor mr-1"
                    :style="medic_team.length === 1 ? 'width: 35px; height: 35px; border-radius: 20px;' : 'width: 15px; height: 15px; border-radius: 20px;'">
                <div :class="['d-flex', (medic_team.length === 1 ? 'flex-column' : 'flex-row align-items-center')]"
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
                            :class="['mr-1 mt-1 badge badge-primary nowrap', { 'd-none': medic_team.length > 0 }, { 'd-none': item2.especialidad === null || item2.especialidad === 'Sin Especialidad' }]">
                            <i class="pc-medico"></i>
                            {{ item2.especialidad }}
                        </div>
                        <div style="font-size:0.7rem;padding:0.2rem;font-weight:400"
                            :class="['mr-1 mt-1 badge badge-warning', { 'd-none': item2.extension_telefonica === null || item2.extension_telefonica === 'Sin extensión' }]">
                            <i class="fas fa-phone-alt"></i>
                            {{ item2.extension_telefonica }}
                        </div>

                     

                    </div>
                </div>
            </div> 
        </div>
    </td>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        name: "Column8",
        data() {
            return {
                patient: {},
                medic_team: [],

            }
        },
        props: {
            ubication: Object,
            index: Number,
            height:{
                type: String,
                required: true,
                default: "auto",
            },
        },

        computed: {
            ...mapState(['pacientes_activos']),

        },
        watch: {
            pacientes_activos(newValue, oldValue) {
                if(this.ubication.cat_user_ubicacion_id === 391){
                    this.patient = this.ubication
                }else{
                    this.patient = this.pacientes_activos.find(x => x.cat_user_ubicacion_id === this.ubication.id)
                };
                this.medic_team = this.patient
                ? this.patient['equipo_medico_paciente'].residente && this.patient['equipo_medico_paciente'].residente.length > 0
                    ? this.patient['equipo_medico_paciente'].residente
                    : []
                : [] 



                
            }
        },
        methods: {
            formatearNombrePaciente2(medic_team) {

                let temp_nombres = ""
                let temp_apellidos = ""
                let temp_prefijo = ""
                if (medic_team) {
                    temp_nombres = ((medic_team['nombres'].split(" "))[0]).toLowerCase()

                    temp_apellidos = ((medic_team['apellidos'].split(" "))[0]).toLowerCase()
                    if (temp_apellidos.length <= 3) {
                        if (medic_team['apellidos'].split(" ")[1] !== undefined) {
                            temp_apellidos = (medic_team['apellidos'].split(" ")[0] + " " + medic_team['apellidos'].split(" ")[1]).toLowerCase()
                        }

                    }

                    temp_prefijo = (medic_team['prefijo'] + ' ').toLowerCase()
                }

                return `${temp_prefijo}${temp_apellidos}, ${temp_nombres.slice(0, 1)}.`
            },
        },
        mounted () {
            if(this.ubication.cat_user_ubicacion_id === 391){
                    this.patient = this.ubication
            }else{
                this.patient = this.pacientes_activos.find(x => x.cat_user_ubicacion_id === this.ubication.id)
            };
            this.medic_team = this.patient
            ? this.patient['equipo_medico_paciente'].residente && this.patient['equipo_medico_paciente'].residente.length > 0
                ? this.patient['equipo_medico_paciente'].residente
                : []
            : [] 


        },

    }
</script>

<style lang="scss" scoped></style>