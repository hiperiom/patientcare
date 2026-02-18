<template>
    <div class="col-5 col-sm-4 col-md-3 col-lg-2 col-xl-2 order-4 order-lg-2 p-1">
        <button
            id="btn_paciente_create"
            @click="gotToNewPaciente()"
            class="btn btn-success btn-block text-nowrap rounded font-weight-bold btn-block"
        >
            Nuevo Paciente
        </button>
    </div>
</template>

<script>
    export default {
        name:"BtnNewPatient",
        methods: {
            gotToNewPaciente() {
                window.location='/medico/create_paciente'
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
