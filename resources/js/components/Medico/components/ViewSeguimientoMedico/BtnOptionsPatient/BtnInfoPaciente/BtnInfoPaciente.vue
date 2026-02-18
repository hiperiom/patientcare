<template>
    <div class="flex-fill px-1">
        <a
            :id="'btn_infoPaciente_' + patient_data.user_id"
            :content="getTolltipContent()"
            v-tippy="{ arrow : true, allowHTML:true, theme : 'tooltip-success' }"
            @click="handle_button()" class="h4 cursor-pointer"
        >
            <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;" src="/image/system/info.svg">
        </a>
    </div>
</template>

<script>
    import {  get } from '../../../../../../helpers/customHelpers.js';
    import ModalFormEditPaciente from './ModalFormEditPaciente.vue';

    export default {
        name: "BtnInfoPaciente",
        props: {
            patient_data: Object,
            index: Number,
        },
        components: {
            ModalFormEditPaciente,
        },
        methods: {
            getTolltipContent(){
                return `Datos del Paciente`
            },
            async getItem(){
                return await get("/user_paciente/getdatapaciente/" + this.patient_data.user_id)
            },
            async handle_button() {
                let result = await this.getItem()
                    this.$store.commit('updateProperty', {
                        fieldName:'editDataPaciente',
                        fieldValue: result,
                    });
                    this.$store.commit('updateDinamicComponent', {
                        is_dismounted:false,
                        customComponent: this.$options.components.ModalFormEditPaciente,
                        patient_data: this.patient_data,
                        index: this.index
                    });
                    $("#modal-datos-paciente").modal("show")
            }
        },
    }
</script>

<style lang="scss" scoped>
</style>
