<template>
    <div class="modal fade"
        id="modalPrealta" tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div v-if="$store.state.configModal.header" class="modal-header p-0">
                    <nav class="d-flex justify-content-between align-items-center bg-primary rounded-pill m-1 ">
                        <i
                            id="close_modal"
                            data-dismiss="modal"
                            aria-label="Close"
                            class="ml-3 fas fa-times text-white heartbeat"
                            style="font-size: 2em;cursor:pointer;"
                            aria-hidden="true"
                        ></i>

                        <img class="img-logo m-1 d-block" src="/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT">
                    </nav>
                </div>
                <div class="modal-body-2 container-fluid fullscreen d-flex flex-column">
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
                idModal: "#modalPrealta"
            }
        },
        props: {

        },
        created () {

        },
        mounted () {
            $(this.idModal).modal("show")
        },
    }
</script>

<style lang="scss" scoped>

</style>
