<template>
    <div :class="['loadingScreen',{'d-none': !mostrarLoading}]">
        <div class="d-flex flex-column align-items-center justify-content-center">
            <img
                loading="lazy"
                onerror="this.src='/image/system/patient.svg'"
                :src="icon"
                class="mb-3"
                alt="Cmdlt"
                style="width: 140px; height: 80px"
            >
            <div class="d-flex align-items-center  text-white justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden"></span>
                </div>
                <h4 class="pl-2 ">{{message}}</h4>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                icon:"/image/system/logo-cmdlt-blanco.svg",
                message:"Por favor espere un momento...",
            }
        },
        computed: {
            mostrarLoading(){
                return this.$store.state.loading
            },
        },
        mounted() {
            this.$store.commit('updateProperty', {
                fieldName:'loading',
                fieldValue:true,
            });
        },
    }
</script>

<style scoped>
    .loadingScreen {
        background-color: rgb(0, 0, 0, 0.5);
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: fixed;
        z-index: 1111111111111111;
        height: 100vh;
        width: 100%;
        top: 0;
        -webkit-animation: fade-in-fwd 0.6s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
	        animation: fade-in-fwd 0.6s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
    }


    @-webkit-keyframes fade-in-fwd {
  0% {
    -webkit-transform: translateZ(-80px);
            transform: translateZ(-80px);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateZ(0);
            transform: translateZ(0);
    opacity: 1;
  }
}
@keyframes fade-in-fwd {
  0% {
    -webkit-transform: translateZ(-80px);
            transform: translateZ(-80px);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateZ(0);
            transform: translateZ(0);
    opacity: 1;
  }
}


</style>
