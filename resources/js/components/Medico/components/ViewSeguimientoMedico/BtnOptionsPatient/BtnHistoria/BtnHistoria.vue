<template>
    <div class="flex-fill px-1">
        <div class="btn-group">
            <a href="#" data-toggle="dropdown" data-display="static" aria-haspopup="true"
                data-tippy-content="Historia del Paciente" aria-expanded="false" class="d-flex ">
                <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;"
                    src="/image/system/icono-new-historia.png">
                <span v-if="containEpisodes" title="Total Episodios"
                    class="badge rounded-circle badge-info align-self-start" style="font-size: 0.6rem;">
                    {{ patient_data.total_episodios }}
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg-right">
                <a @click="handle_historia_inicial()" data-tippy-content="Historia de Ingreso"
                    class="dropdown-item cursor-pointer">
                    <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;"
                        src="/image/system/h_inicial.svg"> Historia Inicial
                </a>
                <a @click="handle_episodios_anteriores()" data-tippy-content="Historias anteriores"
                    class="dropdown-item cursor-pointer">
                    <img loading="lazy" class="heartbeat" style="width: 30px;height: 30px;"
                        src="/image/system/h_episodios.svg"> Episodios anteriores
                    <span v-if="containEpisodes" title="Total Episodios"
                        class="badge rounded-circle badge-info align-self-start" style="font-size: 0.6rem;">
                        {{ patient_data.total_episodios }}
                    </span>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "BtnHistoria",
    props: {
        patient_data: Object,
        index: Number,
    },
    computed: {
        containEpisodes() {
            return this.patient_data.total_episodios > 0 ? true : false
        }
    },
    methods: {
        handle_historia_inicial() {
            UserCuestHistoria.indexHistoria({ user_id: this.patient_data.user_id, episodio_id: this.patient_data.episodio_id })
        },
        handle_episodios_anteriores() {
            UserCuestEpisodio.historialEpisodios({ user_id: this.patient_data.user_id })
        },
    },
}
</script>

<style lang="scss" scoped></style>
