<template>
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" style="z-index: 100000;"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document" style="height: 90vh;">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class=" sticky-top">
                        <img class="img-fluid" style="float:right !important;height: 3em !important;width: 120px;"
                            aria-label="Close" data-dismiss="modal" src="/image/system/logo-cmdlt-blanco.png">
                        <i id="close_modal" data-dismiss="modal" aria-label="Close"
                            class="fas fa-times text-white position-fixed zoom"
                            style="z-index:1000 !important; font-size: 3em;right: 5%;cursor:pointer;"
                            aria-hidden="true"></i>
                    </div>
                </div>
                <!-- style="height: 80vh;" -->
                <div class="modal-body">
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:"Modal2"
    }
</script>

<style lang="scss" scoped>

</style>
