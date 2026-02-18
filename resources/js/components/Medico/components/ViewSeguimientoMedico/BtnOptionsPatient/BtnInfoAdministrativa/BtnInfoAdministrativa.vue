<template>
    <div class="flex-fill px-1">
        <div class="btn-group">
            <a @click="handle_info_administrativa()" href="#" class="heartbeat" style="width: 30px;height: 30px;"
                data-display="static" aria-haspopup="true" data-tippy-content="Datos Administrativos"
                aria-expanded="false">
                <i class="pc-info_administracion_solid  text-purple h3 mb-0"></i>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    name: "BtnInfoAdministrativa",
    props: {
        patient_data: Object,
        index: Number,
    },
    methods: {
        handle_info_administrativa() {
            UserCuestAdministracion.index(this.patient_data.episodio_id)
        }
    },
}
</script>

<style lang="scss" scoped></style>
