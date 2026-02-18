<template>
    <div class="flex-fill p-1 d-flex flex-column overflow-auto" >
        <!-- <CintilloModal :index_row="index_row" :dataPaciente="dataPaciente" /> -->
        <div class="flex-fill mt-1 rounded bg-danger overflow-auto">
            <div id="menuPatiencare" class="list-group">
                <span class="text-primary font-weight-bold menu-pad-title">
                    Menú PAD
                </span>
                <a data-toggle="collapse" href="#collapseEmergencia" role="button" aria-expanded="false" aria-controls="collapseEmergencia" class="d-flex align-items-center list-group-item list-group-item-action">
                    <i class="pc-pad_emergencia font-weight-bold text-info mr-1 ml-2 mb-0 h3"></i>
                    PAD Emergencia
                </a>
                <div class="collapse" id="collapseEmergencia">
                    <div class="card mb-0 card-body py-0">
                        <a  @click="getArea('pad_emergencia_adulto')"  data-dismiss="modal" aria-label="Close" id="m_Emergencia_1" href="#" data-area="pad_emergencia_adulto" data-titlearea="PAD Emergencia Adulto" class="border-0 menu-emergencia list-group-item p-2 list-group-item-action">
                            <i class="pc-pad_emergencia text-info"></i> Adulto
                        </a>
                        <a @click="getArea('pad_emergencia_pediatrica')"  data-dismiss="modal" aria-label="Close" id="m_Emergencia_2" href="#" data-area="pad_emergencia_pediatrica" data-titlearea="PAD Emergencia Pediátrica" class="border-0 menu-emergencia list-group-item p-2 list-group-item-action">
                            <i class="pc-pad_emergencia text-info"></i> Pediátrica
                        </a>
                    </div>
                </div>
                <a data-toggle="collapse" href="#collapsequirurgico" role="button" aria-expanded="false" aria-controls="collapsequirurgico" class="d-flex align-items-center list-group-item list-group-item-action">
                    <i class="pc-light-pad-quiru font-weight-bold text-info mr-1 ml-2 mb-0 h3"></i>
                    PAD Postquirúrgico
                </a>
                <div class="collapse" id="collapsequirurgico">
                    <div class="card mb-0 card-body py-0">
                        <a @click="getArea('pad_postquirurgico_amb')"  data-dismiss="modal" aria-label="Close" id="m_quirurgico_1" href="#" data-area="pad_postquirurgico_amb" data-titlearea="PAD Postquirúrgico Ambulatorio" class="border-0 menu-postquirurgico list-group-item p-2 list-group-item-action">
                            <i class="pc-light-pad-quiru text-info"></i> Ambulatorio
                        </a>
                        <a @click="getArea('pad_postquirurgico_hosp')"  data-dismiss="modal" aria-label="Close" id="m_quirurgico_2" href="#" data-area="pad_postquirurgico_hosp" data-titlearea="PAD Postquirúrgico Hospitalización" class="border-0 menu-postquirurgico list-group-item p-2 list-group-item-action">
                            <i class="pc-light-pad-quiru text-info"></i> Hospitalización
                        </a>
                    </div>
                </div>
                <a  @click="getArea('pad_medico')"  data-dismiss="modal" aria-label="Close" id="m_medico" href="#" role="button" data-area="pad_medico" data-titlearea="PAD Medico" aria-expanded="false" aria-controls="collapsemedico" class="menu-medico d-flex align-items-center list-group-item list-group-item-action">
                    <i class="pc-light-pad-medico font-weight-bold text-info mr-1 ml-2 mb-0 h3"></i>
                    Médico
                </a>


            </div>
        </div>
        <div class="rounded mt-1">
            <button class="btn btn-primary w-100"   data-dismiss="modal" aria-label="Close">
                Regresar
            </button>
        </div>

    </div>
</template>

<script>
import { get, is_empty,obtenerVariablesGET,  is_null,is_undefined } from '../../../helpers/customHelpers';
import CintilloModal from './CintilloModal.vue';
export default {
    name:"BtnWidgetPadMenu",
    /* props:{
        index_row:Number,
        dataPaciente:Object
    }, */
    components: {
        CintilloModal,
    },
    data() {
        return {
            areaActual:'tp'
        }
    },
    methods: {
        async getPacientesActivos(){
                try {
                    this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:true,
                    });
                    let model =  await get( location.origin+"/vistas/"+this.$store.state.ruta);
                        this.$store.commit('updateProperty',{
                            fieldName:'pacientes_datos',
                            fieldValue:model,
                        })
                        this.$store.commit('updateProperty', {
                            fieldName:'loading',
                            fieldValue:false,
                        });
                } catch (error) {
                    console.error('Error al obtener los datos:', error);
                    this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:false,
                    });
                    return []
                }
            },
        getArea(nuevoId){
            this.areaActual =nuevoId
            if ( (location.origin +location.pathname+ `?route=${nuevoId}`) !== location.href) {
                this.$router.push({ path: location.pathname+ `?route=${nuevoId}` }); // O $router.replace() si deseas reemplazar la historia de navegación
                this.$store.commit('updateProperty', {
                    fieldName:'ruta',
                    fieldValue:obtenerVariablesGET( location.href ).route,
                });
                let {area_description} = this.$store.state.menuAreas.find(item=>item['area_siglas']===this.$store.state.ruta)
                this.$store.commit('updateProperty', {
                    fieldName:'area_description',
                    fieldValue: area_description,
                });

                    localStorage.setItem('area_siglas',this.$store.state.ruta)
                    localStorage.setItem('area_description',this.$store.state.area_description)

                this.getPacientesActivos()
            }else{
                location.reload();
            }
        },
    },
    mounted() {

        }
}
</script>

<style scoped>
</style>
