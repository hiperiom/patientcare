<template>
    <Modal>
        <!-- cintillo -->
        <template v-slot:cintillo>
            <div class="d-flex justify-content-end w-100">
                <img
                    src="/image/system/logo-cmdlt_color.svg"
                    style="height: 3em;"
                    class="img-fluid"
                    alt="Imagen CMDLT"
                >
                <button
                    type="button"
                    class="close btn-close-modal"
                    data-dismiss="modal"
                    aria-label="Close"
                    @click="closeModal()"
                >
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </template>
         <!-- title -->
        <template v-slot:title>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 h3 text-primary font-weight-bold text-center">
                        Fecha Probable de Alta
                    </div>
                </div>
            </div>
        </template>
        <!-- content -->
        <template v-slot:content>
            <div ref="datepicker" class="daterange" style="width: 100%"></div>

        </template>
        <!-- footer -->
        <template v-slot:footer>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <button @click="storePrealta()" class="btn btn-success btn-block my-1">Confirmar</button>
                    </div>
                    <div class="col-12 col-sm-6">
                        <button @click="destroyPrealta()" class="btn btn-primary btn-block my-1">Cancelar Prealta</button>
                    </div>
                </div>
            </div>

        </template>
    </Modal>
</template>

<script>
    import { post } from '../../../../../helpers/customHelpers';
import Modal from './Modal.vue';
    //import 'bootstrap-datepicker/js/locales/bootstrap-datepicker.es'; // Importar el archivo de localización

    export default {
        name:"ModalPrealta",
        props:{
            idModal:String,
            patient_data:Object,
            index:Number,
        },
        components: {
            Modal,
        },

        methods: {
            async updatePrealta(){
                let formdata = new FormData();
                    formdata.append("user_id", this.patient_data.user_id)
                    formdata.append("_token", $("#_token").val())
                    formdata.append("valor", this.patient_data.pre_alta)
                    return await post( location.origin+"/user_cuest_episodio/prealta", formdata)
            },
            async storePrealta(){
                let result = await this.updatePrealta()
                    this.closeModal()

            },
            async destroyPrealta(){
                this.patient_data.pre_alta = null;
                let result = await this.updatePrealta()

                    this.$store.commit('updateEpisodio', {
                        index: this.index,
                        fieldName:'pre_alta',
                        fieldValue: this.patient_data,
                    });

                    this.closeModal()
            },
            handleDaySelected(e){
                //Obtener dia actual
                let currentDay = new Date()
                //obtener dia actual en formato milisegundos
                let currentDayMilisecons = new Date(currentDay.getFullYear() , (currentDay.getMonth()+1) , currentDay.getDate()+1)
                //Obtener dia seleccionado en el calendario
                let selectedDay = new Date(e.date)
                //Obtener el dia seleccionado en milisegundos
                let selectedDayMilisecons = new Date(selectedDay.getFullYear() , (selectedDay.getMonth()+1) , selectedDay.getDate()+1)
                    if(selectedDayMilisecons.getTime() < currentDayMilisecons.getTime()){
                        alert("La fecha ingresada no puede ser anterior a hoy.");
                        return false
                    }else{
                        this.patient_data.pre_alta = selectedDay.getFullYear() +'-'+ (selectedDay.getMonth()+1).toString().padStart(2, '0') +'-'+ selectedDay.getDate().toString().padStart(2, '0')
                        //console.log(this.patient.prealta);
                    }
            },
            closeModal() {
                this.$store.commit('updateDinamicComponent', {
                    is_dismounted: true,
                    customComponent: null,
                    patient_data: null,
                    index: null
                });
                $("#modalPrealta").modal("hide")
            },
            configModal(){
                this.$store.commit('updateModalProperty', {
                    header:false,
                    footer:true,
                });
            },
        },

        mounted () {
            this.configModal();
            let that = this
            let calendar = $(this.$refs.datepicker)
                calendar.datepicker({
                    /* format: 'mm/dd/yyyy', */
                    todayHighlight: true,
                    autoclose: true,
                    toggleActive: true,
                    language: 'es',
                });
                calendar.datepicker().on("changeDate", function(e) {
                    that.handleDaySelected(e)
                })

        },

    }
</script>

<style lang="scss" scoped>
    .btn-close-modal {
        position: absolute;
        right: -45px;
        font-size: 4em;
        color: var(--white);
        top: -15px;
    }
</style>
