<template>


        <div class="d-flex flex-column vh-100 ">
            <div id="loadingScreen" :class="{'loadingScreen':true,'d-none': !mostrarLoading}">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <img loading="lazy" onerror="this.src='/image/system/patient.svg'" src="/image/system/logo-cmdlt-blanco.svg" class="mb-3" alt="Cmdlt" style="width: 140px; height: 80px">
                    <div class="d-flex align-items-center  text-white justify-content-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden"></span>
                        </div>
                        <h4 class="pl-2 ">Por favor espere un momento...</h4>
                    </div>
                </div>
            </div>
            <div class="p-1">
                <Navbar1 />
            </div>
            <main class="flex-fill d-flex overflow-auto">

                <MenuPatientcare />

                <transition name="fade">
                    <router-view></router-view>
                </transition>


            </main>

        </div>




</template>
<script>

    import { get, is_null } from '../../../helpers/customHelpers?00001';
    import MenuPatientcare from '../../Menus/AreaQuirurgicaAmbMenu.vue?00001';
    import Navbar1 from '../../Navbars/Navbar1.vue?00001';
    //import { get } from '../../helpers/customHelpers.js';
    export default{
        name:"AreaQuirurgica",
        components: {
            MenuPatientcare,
            Navbar1,
        },
        watch: {
            '$route'(to, from) {
            this.$store.commit('updateLoading',true)

                // Simulación de una carga, podrías usar una función de retardo o una llamada a una API aquí
                setTimeout(() => {
                    this.$store.commit('updateLoading',false)
                }, 1000); // Cambiar a la duración deseada de la pantalla de carga
            }
        },
        methods: {
            async getCatUbicaciones(){
                try {
                    this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:true,
                    });
                   // let model =  await get(location.origin + '/medico/getMedicos' )
                    let model =  await get( location.origin+"/cat_user_ubicacion/getAll");
                        this.$store.commit('updateProperty',{
                            fieldName:'catUbicacion',
                            fieldValue:model,
                        })
                        this.$store.commit('updateProperty', {
                            fieldName:'loading',
                            fieldValue:false,
                        });
                } catch (error) {
                    console.error('Error al obtener los datos:', error);
                    this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:false,
                    });
                    return []
                }
            },
            async getProcedimientos(){
                try {
                    this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:true,
                    });
                   // let model =  await get(location.origin + '/medico/getMedicos' )
                    let model =  await get(location.origin + '/getProcedimientosMAPM' )

                       // console.log("equipo_medico",model)
                        //console.log(solicitudesPorDia)
                        //this.$store.commit('updateEquipoMedico',model)
                        //this.$store.commit('updateListadoEquipoCirugia',model)
                    this.$store.commit('updateProperty', {
                        fieldName:'procedimientos',
                        fieldValue:model,
                    });
                    this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:false,
                    });
                } catch (error) {
                    console.error('Error al obtener los datos:', error);
                    return []
                }
            },
            async getEquipoMedico(){
                try {
                    this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:true,
                    });
                   // let model =  await get(location.origin + '/medico/getMedicos' )
                    let model =  await get(location.origin + '/user/especialidad/{id}/medicos' )

                       // console.log("equipo_medico",model)
                        //console.log(solicitudesPorDia)
                        //this.$store.commit('updateEquipoMedico',model)
                        this.$store.commit('updateListadoEquipoCirugia',model)
                    this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:false,
                    });
                } catch (error) {
                    console.error('Error al obtener los datos:', error);
                    return []
                }
            },
            async getPersonalSalud(){
                try {
                    let model =  await get(location.origin + '/medico/getMedicos' )
                        this.$store.commit('updatePersonalSalud',model)
                        this.$store.commit('updateEspecialidadesUnicas')


                } catch (error) {
                    console.error('Error al obtener los datos:', error);
                    return []
                }
            },

        },
        computed:{

            mostrarLoading(){
                return this.$store.getters.mostrarLoading
            }
        },
        async beforeMount() {
            await this.getProcedimientos()
            await this.getCatUbicaciones()
            await this.getPersonalSalud()
        },
        mounted: async function () {



        },

    }

</script>
<style scoped>
    body {
        background-color: #F6F8FC !important;
        color:var(--secondary);
    }
    .rounded-1 {
        border-radius: 1rem
    }
    .img-user-size {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .btn-user-home .username {
        font-weight: bold;
        font-size:1.5rem;
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
    /* Ejemplo de estilos para una transición de desvanecimiento */
    .fade-enter-active, .fade-leave-active {
        transition: opacity 0.5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
        opacity: 0;
    }
    .img-logo {
        height: 50px;
        width: 120px;
    }
    /*.hide{

    }*/
    .btn-primary-custom{
        color: #ffffff;
        background-color: #5b96df !important;
    }
    .swing-in-top-fwd {
        -webkit-animation: swing-in-top-fwd 2s cubic-bezier(.175, .885, .32, 1.275) both;
        animation: swing-in-top-fwd 2s cubic-bezier(.175, .885, .32, 1.275) both
    }

    @-webkit-keyframes swing-in-top-fwd {
        0% {
            -webkit-transform: rotateX(-100deg);
            transform: rotateX(-100deg);
            -webkit-transform-origin: top;
            transform-origin: top;
            opacity: 0
        }

        100% {
            -webkit-transform: rotateX(0deg);
            transform: rotateX(0deg);
            -webkit-transform-origin: top;
            transform-origin: top;
            opacity: 1
        }
    }

    @keyframes  swing-in-top-fwd {
        0% {
            -webkit-transform: rotateX(-100deg);
            transform: rotateX(-100deg);
            -webkit-transform-origin: top;
            transform-origin: top;
            opacity: 0
        }

        100% {
            -webkit-transform: rotateX(0deg);
            transform: rotateX(0deg);
            -webkit-transform-origin: top;
            transform-origin: top;
            opacity: 1
        }
    }
    .sidebar {
        width: 0px;
        transform: translateX(-100%);
        visibility: hidden;
        opacity:0;
        transition: width 0.5s,opacity 0.5s;
        padding-left: 0;
        padding-right: 0;
    }
    .sidebar-right {
        width: 0px;
        transform: translateX(100%);
        visibility: hidden;
        opacity:0;
        transition: width 0.5s,opacity 0.5s;
        padding-left: 0;
        padding-right: 0;
    }
    .sidebar.show {
        visibility: visible;
        width: 250px;
        transform: translateX(0%);
        opacity:1;
    }



    .content{
        border-radius: 1.5rem;
        /*height: 90vh;*/
    }
    .content.hide {

        transition: all 1.5s;
    }

    .shadow-box{
        -webkit-box-shadow: inset 0px 0px 3px 0px rgba(0,0,0,0.30);
        -moz-box-shadow: inset 0px 0px 3px 0px rgba(0,0,0,0.30);
        box-shadow: inset 0px 0px 3px 0px rgba(0,0,0,0.30);
    }
    .bg-body-gray {
        /*background-color: #F6F8FC !important;*/
        background-color: #6c6c6d !important;
    }
    .bg-gray-1 {
        /*background-color: #F6F8FC !important;*/
        background-color: #F6F8FC !important;
    }
    .bg-info-menu {
        /*background-color: #F6F8FC !important;*/
        background-color: #eaf1fb !important;
    }
    table {

        border-collapse: separate !important;
        border-spacing: 0px 10px;
        /* Espaciado vertical entre filas */
    }
    .btn-rounded-pill-custom {
        border-radius: 19px !important;
    }
    .btn-primary-custom{
        color: #ffffff;
        background-color: #5b96df !important;
    }
    .sticky{
        position: sticky;
        top: 0px;
    }
    .valign-center{
        vertical-align: middle;
    }
    .bg-gray-1 {
        /*background-color: #F6F8FC !important;*/
        background-color: #F6F8FC !important;
    }
    .tbl-row-radius-left {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }
    .tbl-row-radius-right {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }
    .corner-radius-top-left {
        border-top-left-radius: 10px;
    }
    .corner-radius-bottom-left {
        border-bottom-left-radius: 10px;
    }
</style>
