<template>
    <Modal :idModal="idModal">
        <!-- cintillo -->
        <template v-slot:cintillo>
            <CintilloModal
                :patient_data="patient_data"
                :index="index"
            />
        </template>
         <!-- title -->
        <template v-slot:title>

            <div class="d-flex align-items-center justify-content-between">
                <h3 class="text-primary">
                    {{ title }}
                </h3>
                <button
                    @click="handleCreate()"
                    v-if="showListItem"
                    class="btn btn-default text-primary"
                    style="float:right; "
                >
                    Nuevo traslado
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
            </div>
        </template>
        <!-- content -->
        <template v-slot:content>
            <div class="flex-fill d-flex flex-column  overflow-auto">
                <div v-if="showListItem" class="flex-fill d-flex flex-column overflow-auto">
                    <ListTrasladosAmbulancia
                        :patient_data="patient_data"
                        :index="index"

                    />
                </div>
                <div v-else class="flex-fill d-flex flex-column overflow-auto">
                    <CreateTrasladoAmbulancia
                        :patient_data="patient_data"
                        :index="index"
                        @regresar="showListItem = $event"
                    />
                </div>
            </div>
        </template>
        <!-- footer -->
        <template v-slot:footer>


        </template>

    </Modal>
</template>

<script>


    import {  post } from '../../../../../helpers/customHelpers';
    import CintilloModal from '../Modals/CintilloModal.vue';
    import Modal from './Modal.vue';
    import ListTrasladosAmbulancia from './ListTrasladosAmbulancia.vue'
    import CreateTrasladoAmbulancia from './CreateTrasladoAmbulancia.vue'
    export default {
        name:"ModalTraslados",
        data() {
            return {
                title: "Traslados en ambulancia",
                idModal:"modaltrasladosAmbulancia",
                items:[],
                showListItem:true,
            }
        },
        props:{
            patient_data:Object,
            index:Number,
        },
        computed: {
            getUbicaciones(){
                //return this.$store.state.historialUbicacionesPaciente
            }
        },
        components: {
            Modal,
            CintilloModal,
            ListTrasladosAmbulancia,
            CreateTrasladoAmbulancia,
        },
        methods: {
            handleCreate(){
                if (this.showListItem) {
                    this.showListItem = false
                }else{
                    this.showListItem = true
                }
            },
            configModal(){
                this.$store.commit('updateModalProperty', {
                    header:true,
                    footer:false,
                });
            },
        },
        mounted () {
            this.configModal()
            //this.gethistorialUbiEpisodio()
        },

    }
</script>

<style lang="scss" scoped>

</style>
