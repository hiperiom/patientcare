<template>
    <!-- ENFERMERIA -->
    <td :style="'width:10% !important;height:'+height" class="glassmod-effect tbl-row-radius-right  text-left p-1">

        <div v-if="patient && medic_team"
            style="width:100%;"
            class="text-left d-flex flex-wrap align-items-center">
            <div class="d-flex align-items-center">
                <img loading="lazy" onerror="this.src='/image/system/patient.svg'"
                    :src="medic_team['imagen']"
                    class="img-doctor mr-1" style="width: 35px; height: 35px; border-radius: 20px;">
                <div class="d-flex flex-column" style="line-height:1.5rem;">
                    <div class="text-nowrap overflow-hidden"
                        style="width:auto !important;text-transform: capitalize !important;">

                        {{ formatearNombrePacienteEnfermeria(
                            medic_team) }}
                        <div :class="['badge ml-1', { ' badge-warning': true }]">EN</div>

                    </div>
                    <div class="d-flex">
                        
                        <div style="font-size:0.7rem;padding:0.2rem;font-weight:400"
                            :class="['mr-1 badge badge-warning', { 'd-none': medic_team['extension_telefonica'] === null || medic_team['extension_telefonica'] === 'Sin extensión' }]">
                            <i class="fas fa-phone-alt"></i>
                            {{ medic_team['extension_telefonica'] }}
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
        name:"Column9",
        data() {
            return {
                patient: {},
                medic_team: null,
                
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
                this.medic_team =   this.patient 
                                    ? this.patient['equipo_medico_paciente'] 
                                        ? this.patient['equipo_medico_paciente'].enfermeria : null
                                    : null

            }
        },
        methods: {
            
            formatearNombrePacienteEnfermeria() {

                let temp_nombres = ""
                let temp_apellidos = ""
                let temp_prefijo = ""

                if (this.medic_team) {
                    temp_nombres = ((this.medic_team['nombres'].split(" "))[0]).toLowerCase()
                    temp_apellidos = (this.medic_team['apellidos'].split(" "))[0]
                    if (temp_apellidos.length <= 3) {
                        if (this.medic_team['apellidos'].split(" ")[1] !== undefined) {
                            temp_apellidos = (this.medic_team['apellidos'].split(" ")[0] + " " + this.medic_team['apellidos'].split(" ")[1]).toLowerCase()
                        }

                    }

                    if (this.medic_team['prefijo']) {
                        temp_prefijo = (this.medic_team['prefijo'] + ' ').toLowerCase()
                    }    
                }

                
          
                
                

                return `${temp_prefijo} ${temp_nombres} ${temp_apellidos} `
            },

    
        },
        mounted () {
            
            if(this.ubication.cat_user_ubicacion_id === 391){
                    this.patient = this.ubication
                }else{
                    this.patient = this.pacientes_activos.find(x => x.cat_user_ubicacion_id === this.ubication.id)
                };
                this.medic_team =   this.patient 
                ? this.patient['equipo_medico_paciente'] 
                    ? this.patient['equipo_medico_paciente'].enfermeria : null
                : null
        },
        
    }
</script>

<style lang="scss" scoped>

</style>