<template>
    <Modal>
        <!-- cintillo -->
        <template v-slot:cintillo>
            <CintilloModal
                :patient_data="patient_data"
                :index="index"
            />
        </template>
         <!-- title -->
        <template v-slot:title>
            <h3 class="text-primary">
                {{ title }}
            </h3>
        </template>
        <!-- content -->
        <template v-slot:content>
            <div class="fade-in flex-fill d-flex flex-column  overflow-auto">
                <div class="flex-fill">

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-primary">Área</th>
                                <th class="text-primary">Fecha ingreso</th>
                                <th class="text-primary">Fecha traslado</th>
                                <th class="text-primary">Días en área</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr
                                v-for="(item,index) in getUbicaciones"
                                :key="'ubi_'+index"

                            >
                                <th class="text-gray" scope="row">{{ item.area }}</th>
                                <td class="text-gray">{{item.fecha_ingreso}}</td>
                                <td class="text-gray">{{ item.fecha_traslado }}</td>
                                <td class="text-gray">{{ item.dias_en_area }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </template>
        <!-- footer -->
        <template v-slot:footer>
            <button
                class="font-weight-bold btn btn-primary w-100 mb-1"
                @click="closeModal()"
                aria-label="Close"
            >
                Cerrar
            </button>
        </template>

    </Modal>
</template>

<script>

    import {  post } from '../../../../../helpers/customHelpers';
    import CintilloModal from '../Modals/CintilloModal.vue';
    import Modal from './Modal.vue';

    export default {
        name:"ModalTraslados",
        data() {
            return {
                title: "Traslados",
                idModal: "#modal-traslados",
                items:[],
            }
        },
        props:{
            patient_data:Object,
            index:Number,
        },
        computed: {
            getUbicaciones(){
                return this.$store.state.historialUbicacionesPaciente
            }
        },
        components: {
            Modal,
            CintilloModal,
        },
        methods: {
            closeModal() {
                this.$store.commit('updateDinamicComponent', {
                    is_dismounted:true,
                    customComponent: null,
                    patient_data: null,
                    index: null
                });
                $(this.idModal).modal("hide")
            },
            configModal(){
                this.$store.commit('updateModalProperty', {
                    header:true,
                    footer:true,
                });
            },
        },
        mounted () {
            this.configModal()
            $("#modal-traslados").modal('show')
        },

    }
</script>

<style lang="scss" scoped>

</style>
