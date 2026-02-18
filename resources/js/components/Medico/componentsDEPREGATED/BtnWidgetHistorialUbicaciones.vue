<template>
    <div class="flex-fill p-1 d-flex flex-column overflow-auto" >
        <CintilloModal :index_row="index_row" :dataPaciente="dataPaciente" />
        <div class="flex-fill mt-1 rounded bg-danger overflow-auto">
            {{ index_row }}
            {{ dataPaciente }}
        </div>
        <div class="rounded mt-1">
            <button class="btn btn-primary w-100"   data-dismiss="modal" aria-label="Close">
                Regresar
            </button>
        </div>

    </div>
</template>

<script>
import CintilloModal from './CintilloModal.vue';
export default {
    name:"BtnWidgetHistorialUbicaciones",
    props:{
        index_row:Number,
        dataPaciente:Object
    },
    components: {
        CintilloModal,
    },
    data() {
        return {

        }
    },
    methods: {

    },
    mounted() {

        }
}
</script>

<style scoped>
</style>
