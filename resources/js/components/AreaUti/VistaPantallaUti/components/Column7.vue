<template>
    <!-- TRATANTE -->
    <td :style="'width:10% !important;height:'+height" class="glassmod-effect text-left p-1">
    
        <div v-if="patient && medic_team"
            style="width:100%;"
            class="text-left d-flex flex-wrap align-items-center">
            <div class="d-flex align-items-center">
                <img loading="lazy" onerror="this.src='/image/system/patient.svg'"
                    :src="medic_team['imagen']" class="img-doctor mr-1"
                    style="width: 35px; height: 35px; border-radius: 20px;">
                <div class="d-flex flex-column" style="line-height:1.5rem;">
                    <div class="text-nowrap py-1 d-flex align-items-center overflow-hidden"
                        style="width:auto !important;text-transform: capitalize !important;">
                        {{
                            formatearNombrePaciente2()
                        }} <div class="badge badge-success  ml-1">TR</div>
                    </div>
                    <div class="d-flex">
                        <div style="font-size:0.7rem;padding:0.2rem;font-weight:400"
                            :class="['mr-2 mt-1 px-2 badge badge-primary nowrap', { 'd-none': medic_team['especialidad'] === null || medic_team['especialidad'] === 'Sin Especialidad' }]">
                            <i class="pc-medico"></i>
                            {{
                                medic_team['especialidad']
                            }}
                        </div>
                        <div style="font-size:0.7rem;padding:0.2rem;font-weight:400"
                            :class="['mr-2 mt-1 px-2 badge badge-warning', { 'd-none': medic_team['extension_telefonica'] === null || medic_team['extension_telefonica'] === 'Sin extensión' }]">
                            <i class="fas fa-phone-alt"></i>
                            {{
                                medic_team['extension_telefonica']
                            }}
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
        name:"Column7",
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
                    ? this.patient['equipo_medico_paciente'].tratante : null
                : null

            }
        },
        methods: {
            formatearNombrePaciente2() {

                let temp_nombres = ""
                let temp_apellidos = ""
                let temp_prefijo = ""
                if (this.medic_team) {
                    temp_nombres = ((this.medic_team['nombres'].split(" "))[0]).toLowerCase()
                
                    temp_apellidos = ((this.medic_team['apellidos'].split(" "))[0]).toLowerCase()
                    if (temp_apellidos.length <= 3) {
                        if (this.medic_team['apellidos'].split(" ")[1] !== undefined) {
                            temp_apellidos = (this.medic_team['apellidos'].split(" ")[0] + " " + this.medic_team['apellidos'].split(" ")[1]).toLowerCase()
                        }

                    }
            
                    temp_prefijo = (this.medic_team['prefijo'] + ' ').toLowerCase()
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
            this.medic_team =   this.patient 
            ? this.patient['equipo_medico_paciente'] 
                ? this.patient['equipo_medico_paciente'].tratante : null
            : null
        },
    }
</script>

<style lang="scss" scoped>

</style>