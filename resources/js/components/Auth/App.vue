<template>
<div class="d-flex flex-column justify-content-center align-items-center bg-body-primary vh-100">
    <img class="img-fluid h-img-custom-1 my-3" src="https://patientcare.cmdlt.pstelemed.com/image/system/patientcare_bw.svg" alt="Not Logo System Found">

        <router-view></router-view>

    <div class="d-flex align-items-center justify-content-center">
        <img style="height: 3em;" class="img-fluid my-3" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo_sistemas_gestion_medica_blanco.svg" alt="Not Logo System Found">
    </div>

    <div style="bottom:0px" class="position-absolute pr-1 align-self-end justify-content-end text-white">
        v{{ system_version.version_value }}
    </div>
</div>



</template>
<script>
    import { get, is_empty, obtenerVariablesGET, is_null,is_undefined } from '../../helpers/customHelpers';
    export default{
        name:"auth",
        watch: {
            '$route'(to, from) {
                this.$store.commit('updateProperty', {
                    fieldName:'loading',
                    fieldValue:true,
                });
            }
        },
        data() {
            return {
                system_version: "_not_disponible"
            }
        },
        computed:{

            mostrarLoading(){
                return this.$store.state.loading
            },
            getRoute(){
                return location.pathname!=='/auth/equipomedico'
            }

        },
        methods: {
            async forseReloadForEvoidCache(){
                this.system_version = await get("/forseReloadForEvoidCache")
                // Obtiene el valor almacenado en el localStorage


                    if(this.system_version.success){
                        console.log("system_version:",this.system_version.version_value );

                        console.log("El sistema se ha actualizado a una versión más reciente. "+ this.system_version.version_value)
                        const parametroRandomico = Math.random(); // Genera un valor aleatorio
                            const nuevaURL = window.location.href + `?version=${this.system_version.version_value}&force=${parametroRandomico}`;
                            window.location.href = nuevaURL; // Recarga la página con el nuevo parámetro

                    }

            },
        },
        async mounted() {
            await this.forseReloadForEvoidCache()

            this.$store.commit('updateProperty', {
                fieldName:'loading',
                fieldValue:false,
            });
        },
    }
</script>
<style>
    a.btn-exit {
        background-color: var(--gray);
        font-weight: bold;
        color: var(--info) !important;
    }
    .btn-exit:hover{
        background-color: var(--secondary);
        color: var(--white) !important;
    }
    .text-gray{
        color:var(--gray) !important
    }
    .loadingScreen {
        background-color: rgb(0, 0, 0, 0.5);
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: fixed;
        z-index: 1111111111111111;
        height: 100vh;
        width: 100%;
    }
    /*.vh-100 {
        height: 100vh;
    }
    .h-img-custom-1{
        height: 1.8em;
    }
    .h-img-custom-2{
        height: 3em;
    }*/
    .bg-body-primary {
        background-color: var(--primary) !important;
    }

    /*.glassmod-effect {
        background-color: rgb(255 255 255 / 50%);
        backdrop-filter: blur(20px);
    }

    .rounded-pill {
        border-radius: 30px !important
    }*/
    .vh-100 {
        height: 100vh !important;
    }
    .rounded-pill-custom-1{
        border-radius: 1rem;
    }
    .shadow-box {
        box-shadow: inset 0px 0px 3px 0px rgba(0,0,0,0.30);
    }


    .nav-patientcare .card{
        color:var(--secondary);
        border-radius: 1rem;
        overflow: auto;
    }
    .nav-patientcare .card i{
        font-size: 50px;
        color:var(--info);
    }
    .nav-patientcare .card:hover i{
        color:var(--white);
    }
    .nav-patientcare .card .title{
        font-weight: 600;
        text-align: center;
    }
    .nav-patientcare .card.goback {
        background-color: var(--primary);
        height:auto;
        color:var(--white);
    }
    .nav-patientcare .card.goback i {
        color:var(--white);
    }

    .nav-patientcare .card.goback:hover{
        background-color: var(--secondary) !important;
        color: var(--white) !important;

        transition: all 0.30s ease !important;
        cursor:pointer;

    }
    .nav-patientcare .card:not(.title):hover{
        background-color: var(--primary);
        color: var(--white);
        transition: width 1s,opacity 0.5s;
        cursor:pointer;
        transition: all 0.30s ease !important;
    }
    @media (min-width: 0) {
        .shadow-none{
            box-shadow: none !important;
        }
        .nav-patientcare .card.title,
       .nav-patientcare .card.goback{
            margin: 0.5rem;
            padding:0.5rem ;
        }
        .nav-patientcare .card.title{

            color:var(--primary);
        }
        .card-height {
            height: 80px;
        }
    }
    @media (min-width: 576px){
        .card-height {
            height: 140px;
        }
    }
    @media (min-width: 768px) {
        .nav-patientcare .card,
        .nav-patientcare .card.goback {
            height:200px;
        }
        .nav-patientcare .card.goback i{

            font-size: 50px;
        }

        .nav-patientcare .card.goback{
            background-color:var(--primary);
            color:var(--white);
        }
        .nav-patientcare .card.title{
            font-size: 1.5rem;
        }
    }


    @media (min-width: 1200px){
        .container, .container-sm, .container-md, .container-lg, .container-xl {
            max-width: 1140px !important;
        }
    }
</style>
