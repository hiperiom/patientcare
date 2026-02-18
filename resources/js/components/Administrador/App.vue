<template>

        <div class="d-flex flex-column vh-100">
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
            <main class="p-1 flex-fill d-flex">
                <MenuPatientcare />
                <div class="bg-gray-1 shadow-box flex-fill overflow-auto container-fluid" id="content">
                    <transition name="fade">
                        <router-view></router-view>
                    </transition>
                </div>
                
            </main>
          
        </div>

</template>
<script>
    import Navbar1 from './components/Navbar1.vue';
    import { get, is_null } from '../../helpers/customHelpers';
    import MenuPatientcare from './components/menuPatientcare.vue';

    export default{
        name:"AreaAdministrador",
        components: {
            Navbar1,
            MenuPatientcare,
        },
        watch: {
            '$route'(to, from) {

            }
        },
        methods: {
            /* async getCatUbicaciones(){
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
            async getEquipoMedico(){
                try {

                   // let model =  await get(location.origin + '/medico/getMedicos' )
                    let model =  await get(location.origin + '/user/especialidad/{id}/medicos' )
                    
                       // console.log("equipo_medico",model)
                        //console.log(solicitudesPorDia)
                        //this.$store.commit('updateEquipoMedico',model)
                        this.$store.commit('updateListadoEquipoCirugia',model)
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
            }, */
            
        },
        computed:{

            mostrarLoading(){
                return this.$store.getters.mostrarLoading
            }
        },
        async beforeMount() {
           /*  await this.getCatUbicaciones()
            await this.getPersonalSalud() */
        },
        mounted: async function () {
            

            
        },

    }

</script>
<style>

    .vh-100 {
        height: 100vh;
    }
    .h-img-custom-1 {
        height: 1.8em;
    }
    .h-img-custom-2 {
        height: 3em;
    }
    .glassmod-effect {
        background-color: rgb(255 255 255 / 50%);
        backdrop-filter: blur(20px);
    }
    .rounded-pill {
        border-radius: 30px !important
    }
    .shadow-box{
        -webkit-box-shadow: inset 0px 0px 3px 0px rgba(0,0,0,0.30);
        -moz-box-shadow: inset 0px 0px 3px 0px rgba(0,0,0,0.30);
        box-shadow: inset 0px 0px 3px 0px rgba(0,0,0,0.30);
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
    .img-logo {
        height: 50px;
        width: 120px;
    }
    .shadow-box{
        -webkit-box-shadow: inset 0px 0px 3px 0px rgba(0,0,0,0.30);
        -moz-box-shadow: inset 0px 0px 3px 0px rgba(0,0,0,0.30);
        box-shadow: inset 0px 0px 3px 0px rgba(0,0,0,0.30);
    }
    /*Estilos para el menu principal*/
    .content-box{
        transition: width 0.5s,opacity 0.5s;
        border-radius: 1rem;
        overflow: auto;
        height: 81vh;
    }
    .content-box th{
        text-align:center;
        color: var(--primary);
        top:0px;
        position:sticky !important;
        background-color:whitesmoke;
        z-index: 2;
    }
    .sidebar-right,
    .sidebar-left {
        width:auto;
        visibility: hidden;
        opacity:0;
        transition: width 0.5s,opacity 0.5s;
        border-radius:1rem;
        background-color: #F6F8FC !important;
    }
    .sidebar-right.show,
    .sidebar-left.show {
        visibility: visible;
        transition: width 0.5s,opacity 0.5s;
        width:auto;
        opacity:1;
        padding: 0.5rem;
        margin: 0px 0.5rem
    }



    
    /*Estilos para el menu principal*/
    .sticky{
        position: sticky;
        top: 0px;
    }
    .valign-center{
        vertical-align: middle;
    }
    .bg-body-gray {
        background-color: #6c6c6d !important;
    }
    .bg-gray-1 {
        background-color: #F6F8FC !important;
    }
    .btn-rounded-pill-custom {
        border-radius: 19px !important;
    }
    .bg-primary {
        background-color: var(--primary) !important;
    }
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        color: #fff;
        background-color: var(--primary);
    }
    a {
        color: var(--primary);
        text-decoration: none;
        background-color: transparent;
    }
    a:hover {
        background-color:whitesmoke;
        color: var(--primary);
        text-decoration: none;
        
    }
    .badge-white {
        color: var(--primary);
        background-color: var(--white);
    }
    #list_areas .nav-link .badge {
        display:none;
    }
    #list_areas .nav-link.active .badge {
        display:block;
    }
    .btn-outline-primary {
        color: var(--primary);
        border-color: var(--primary);
    }
    .btn-outline-primary:hover {
        color: #fff;
        background-color: var(--primary);
        border-color: var(--primary);
    }
    .text-primary {
        color: var(--primary) !important;
    }
</style>
