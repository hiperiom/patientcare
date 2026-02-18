<template>
    <div
        class="modal fullscreen-modal fade"
        style="z-index: 10000;"
        id="modal-traslados"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content d-flex flex-column overflow-auto vh-100">
                <div v-if="$store.state.configModal.header" class="modal-header p-0">
                    <nav class="d-flex justify-content-between align-items-center bg-primary rounded-pill m-1 ">
                        <i
                           @click="closeModal()"
                            aria-label="Close"
                            class="ml-3 fas fa-times text-white heartbeat"
                            style="font-size: 2em;cursor:pointer;"
                            aria-hidden="true"
                        ></i>

                        <img class="img-logo m-1 d-block" src="/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT">
                    </nav>
                </div>
                <div class="modal-body-2 container-fluid fullscreen d-flex flex-column overflow-auto">
                    <slot name="cintillo"></slot>
                    <slot name="title"></slot>
                    <slot name="content"></slot>
                </div>
                <div v-if="$store.state.configModal.footer" class="modal-footer">
                    <slot name="footer"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:"Modal1",
        data() {
            return {
                idModal: "#modal-traslados"
            }
        },
        props: {

        },
        methods: {
            closeModal() {
                this.$store.commit('updateDinamicComponent', {
                    is_dismounted:true,
                    customComponent: null,
                    patient_data: null,
                    index: null
                });
                $("#modal-datos-paciente").modal("hide")
            }
        },
        mounted () {
            $(this.idModal).modal("show")
        },
    }
</script>

<style lang="scss" scoped>

</style>
