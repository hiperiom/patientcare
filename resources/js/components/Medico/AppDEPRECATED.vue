<template>
    <div class="d-flex flex-column vh-100 bg-gray-1">
        <Loading />
        <Navbar1 />

        <MenuAreasIngreso :getPacientesActivos="getPacientesActivos"/>
        <PatientList />

    </div>

</template>
<script>

    import { get, is_empty, obtenerVariablesGET, is_null,is_undefined } from '../../helpers/customHelpers';
    import Loading from './components/Loading.vue';
    import Navbar1 from './components/Navbar1.vue';
    import MenuAreasIngreso from './components/MenuAreasIngreso.vue';
    import PatientList from './components/PatientList.vue';

    export default{
        name:"EquipoMedico",
        data() {
            return {
                ruta:'tp',
                navMenuPatientcare:{
                    cmdlt:[
                        {
                            title:"Seguimiento Médico",
                            icon:"pc-medico",
                            eventHandle(){
                                location.href='/user/medico/menu_seguimiento_medico'
                            },
                            active:true,
                        },
                        {
                            title:"Emergencia",
                            icon:"pc-light-emergency",
                            eventHandle(){
                                location.href='#'
                            },
                            active:false,
                        },
                        {
                            title:"Hospitalización",
                            icon:"pc-light-pisos",
                            eventHandle(){
                                location.href='#'
                            },
                            active:false,
                        },
                        {
                            title:"UTI",
                            icon:"pc-uti-light",
                            eventHandle(){
                                location.href='#'
                            },
                            active:false,
                        },
                        {
                            title:"Área Quirúrgica",
                            icon:"pc-cirugia-light",
                            eventHandle(){
                                location.href='#'
                            },
                            active:true,
                        },
                        {
                            title:"Consulta Externa",
                            icon:"pc-solid_estetoscopio",
                            eventHandle(){
                                location.href='#'
                            },
                            active:false,
                        },
                        {
                            title:"PAD",
                            icon:"pc-light-homecare",
                            eventHandle(){
                                location.href='#'
                            },
                            active:false,
                        },
                        {
                            title:"Administrador",
                            icon:"pc-administrador",
                            eventHandle(){
                                location.href='#'
                            },
                            active:true,
                        },
                        {
                            title:"Hoteleria",
                            icon:"fas fa-concierge-bell",
                            eventHandle(){
                                location.href='#'
                            },
                            active:true,
                        },
                        {
                            title:"Telesalud Empresarial",
                            icon:"pc-telesalud-empresarial",
                            eventHandle(){
                                location.href='#'
                            },
                            active:true,
                        },
                        {
                            title:"Satisfacción",
                            icon:"pc-light-satisfation",
                            eventHandle(){
                                location.href='#'
                            },
                            active:true,
                        },
                    ],
                }
            }
        },
        components: {
            Navbar1,
            MenuAreasIngreso,
            PatientList,
            //CardPaciente,
            Loading,
           /*  CardNavMenu, */
        },
        watch: {
            '$route'(to, from) {

            }
        },
        computed:{


        },
        methods:{

            async getCatUbicaciones(){
                try {
                    this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:true,
                    });
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
            async getPacientesActivos(){
                try {
                    this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:true,
                    });
                    let model =  await get( location.origin+"/vistas/"+this.$store.state.ruta);
                        this.$store.commit('updateProperty',{
                            fieldName:'pacientes_datos',
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
                    this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:true,
                    });
                    let model =  await get( location.origin+"/medico/getMedicos");
                        this.$store.commit('updateProperty',{
                            fieldName:'medicos_datos',
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
        },
        /* async created(){
            this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:false,
                    });
        }, */
        async mounted(){
            //CARGAR Ubicaciones de areas
            await this.getCatUbicaciones()
            await this.getEquipoMedico()

            await this.getPacientesActivos()
            this.$store.commit('updateProperty', {
                fieldName:'ruta',
                fieldValue:obtenerVariablesGET( location.href ).route,
            });
            //this.activarTooltips()
        },
        updated(){
            //this.ruta = obtenerVariablesGET( location.href ).route

            //this.initTooltips()
        }



    }

</script>
<style>

    li.menuArea a {
        color: var(--secondary);
        text-decoration: none;
        background-color: transparent;
        font-weight: 600;
    }


    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        color: var(--white) !important;
        background-color: var(--success) !important;
    }
    @media (min-width: 576px){
        .btn-user-home .username {
            font-weight: bold;
            /* font-size: 1.5rem; */
            text-wrap: nowrap;
            overflow: hidden;
            width: auto;
            /* border: 1px solid red; */
        }
    }

    .bg-light>a.navbar-brand {
        color: var(--primary) !important;
    }
    .shadow-inset-sm{
        box-shadow: 1px 1px 25px -16px rgba(0,0,0,1) inset;
        -webkit-box-shadow: 1px 1px 25px -16px rgba(0,0,0,1) inset;
        -moz-box-shadow: 1px 1px 25px -16px rgba(0,0,0,1) inset;
    }

    /***********/
    .rounded-pill-custom-1{
        border-radius: 1rem;
    }
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
    /*.loadingScreen {
        background-color: rgb(0, 0, 0, 0.5);
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: fixed;
        z-index: 1111111111111111;
        height: 100vh;
        width: 100%;
    }*/
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
        /*border-radius: 1rem;
        overflow: auto;
        height: 81vh;*/
    }
    /* .content-box th{
        text-align:center;
        color: var(--primary);
        top:0px;
        position:sticky !important;
        background-color:whitesmoke;
        z-index: 2;
    }*/





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
    /*TOOLTIP PRIMARY*/
    .tippy-tooltip.tooltip-primary-theme {
        background-color: var(--primary);
        color: white;
    }
    .tippy-popper[x-placement^=top] .tippy-tooltip.tooltip-primary-theme .tippy-arrow {
        bottom:-15px;
        border-top-color: var(--primary);
    }
    .tippy-popper[x-placement^=bottom] .tippy-tooltip.tooltip-primary-theme .tippy-arrow {
        top:-15px;
        border-bottom-color: var(--primary);
    }
    .tippy-popper[x-placement^=left] .tippy-tooltip.tooltip-primary-theme .tippy-arrow {
        right:-15px;
        border-left-color: var(--primary);
    }
    .tippy-popper[x-placement^=right] .tippy-tooltip.tooltip-primary-theme .tippy-arrow {
        left:-15px;
        border-right-color: var(--primary);
    }
    /*TOOLTIP SUCCESS*/
    .tippy-tooltip.tooltip-success-theme {
        background-color: var(--success);
        color: white;
    }
    .tippy-popper[x-placement^=top] .tippy-tooltip.tooltip-success-theme .tippy-arrow {
        bottom:-15px;
        border-top-color: var(--success);
    }
    .tippy-popper[x-placement^=bottom] .tippy-tooltip.tooltip-success-theme .tippy-arrow {
        top:-15px;
        border-bottom-color: var(--success);
    }
    .tippy-popper[x-placement^=left] .tippy-tooltip.tooltip-success-theme .tippy-arrow {
        right:-15px;
        border-left-color: var(--success);
    }
    .tippy-popper[x-placement^=right] .tippy-tooltip.tooltip-success-theme .tippy-arrow {
        left:-15px;
        border-right-color: var(--success);
    }
    /*TOOLTIP DANGER*/
    .tippy-tooltip.tooltip-danger-theme {
        background-color: var(--danger);
        color: white;
    }
    .tippy-popper[x-placement^=top] .tippy-tooltip.tooltip-danger-theme .tippy-arrow {
        bottom:-15px;
        border-top-color: var(--danger);
    }
    .tippy-popper[x-placement^=bottom] .tippy-tooltip.tooltip-danger-theme .tippy-arrow {
        top:-15px;
        border-bottom-color: var(--danger);
    }
    .tippy-popper[x-placement^=left] .tippy-tooltip.tooltip-danger-theme .tippy-arrow {
        right:-15px;
        border-left-color: var(--danger);
    }
    .tippy-popper[x-placement^=right] .tippy-tooltip.tooltip-danger-theme .tippy-arrow {
        left:-15px;
        border-right-color: var(--danger);
    }
    /*TOOLTIP DANGER 2*/
    .tippy-tooltip.tooltip-danger-2-theme {
        background-color: #F78181;
        color: white;
    }
    .tippy-popper[x-placement^=top] .tippy-tooltip.tooltip-danger-2-theme .tippy-arrow {
        bottom:-15px;
        border-top-color: #F78181;
    }
    .tippy-popper[x-placement^=bottom] .tippy-tooltip.tooltip-danger-2-theme .tippy-arrow {
        top:-15px;
        border-bottom-color: #F78181;
    }
    .tippy-popper[x-placement^=left] .tippy-tooltip.tooltip-danger-2-theme .tippy-arrow {
        right:-15px;
        border-left-color: #F78181;
    }
    .tippy-popper[x-placement^=right] .tippy-tooltip.tooltip-danger-2-theme .tippy-arrow {
        left:-15px;
        border-right-color: #F78181;
    }
    /*TOOLTIP GRAY*/
    .tippy-tooltip.tooltip-gray-theme {
        background-color: #C4C4C4;
        color: white;
    }
    .tippy-popper[x-placement^=top] .tippy-tooltip.tooltip-gray-theme .tippy-arrow {
        bottom:-15px;
        border-top-color: #C4C4C4;
    }
    .tippy-popper[x-placement^=bottom] .tippy-tooltip.tooltip-gray-theme .tippy-arrow {
        top:-15px;
        border-bottom-color: #C4C4C4;
    }
    .tippy-popper[x-placement^=left] .tippy-tooltip.tooltip-gray-theme .tippy-arrow {
        right:-15px;
        border-left-color: #C4C4C4;
    }
    .tippy-popper[x-placement^=right] .tippy-tooltip.tooltip-gray-theme .tippy-arrow {
        left:-15px;
        border-right-color: #C4C4C4;
    }
    /*TOOLTIP GRAY TEXT PRIMARY*/
    .tippy-tooltip.tooltip-gray-primary-theme {
        background-color: #C4C4C4;
        color: var(--primary);
    }
    .tippy-popper[x-placement^=top] .tippy-tooltip.tooltip-gray-primary-theme .tippy-arrow {
        bottom:-15px;
        border-top-color: #C4C4C4;
    }
    .tippy-popper[x-placement^=bottom] .tippy-tooltip.tooltip-gray-primary-theme .tippy-arrow {
        top:-15px;
        border-bottom-color: #C4C4C4;
    }
    .tippy-popper[x-placement^=left] .tippy-tooltip.tooltip-gray-primary-theme .tippy-arrow {
        right:-15px;
        border-left-color: #C4C4C4;
    }
    .tippy-popper[x-placement^=right] .tippy-tooltip.tooltip-gray-primary-theme .tippy-arrow {
        left:-15px;
        border-right-color: #C4C4C4;
    }
    /*TOOLTIP CYAN*/
    .tippy-tooltip.tooltip-cyan-theme {
        background-color: #00AAFF;
        color: white;
    }
    .tippy-popper[x-placement^=top] .tippy-tooltip.tooltip-cyan-theme .tippy-arrow {
        bottom:-15px;
        border-top-color: #00AAFF;
    }
    .tippy-popper[x-placement^=bottom] .tippy-tooltip.tooltip-cyan-theme .tippy-arrow {
        top:-15px;
        border-bottom-color: #00AAFF;
    }
    .tippy-popper[x-placement^=left] .tippy-tooltip.tooltip-cyan-theme .tippy-arrow {
        right:-15px;
        border-left-color: #00AAFF;
    }
    .tippy-popper[x-placement^=right] .tippy-tooltip.tooltip-cyan-theme .tippy-arrow {
        left:-15px;
        border-right-color: #00AAFF;
    }

    /*TOOLTIP WARNING*/
    .tippy-tooltip.tooltip-warning-theme {
        background-color: var(--warning);
        color: white;
    }
    .tippy-popper[x-placement^=top] .tippy-tooltip.tooltip-warning-theme .tippy-arrow {
        bottom:-15px;
        border-top-color: var(--warning);
    }
    .tippy-popper[x-placement^=bottom] .tippy-tooltip.tooltip-warning-theme .tippy-arrow {
        top:-15px;
        border-bottom-color: var(--warning);
    }
    .tippy-popper[x-placement^=left] .tippy-tooltip.tooltip-warning-theme .tippy-arrow {
        right:-15px;
        border-left-color: var(--warning);
    }
    .tippy-popper[x-placement^=right] .tippy-tooltip.tooltip-warning-theme .tippy-arrow {
        left:-15px;
        border-right-color: var(--warning);
    }
    /*TOOLTIP SECONDARY*/
    .tippy-tooltip.tooltip-secondary-theme {
        background-color: var(--secondary);
        color: white;
    }
    .tippy-popper[x-placement^=top] .tippy-tooltip.tooltip-secondary-theme .tippy-arrow {
        bottom:-15px;
        border-top-color: var(--secondary);
    }
    .tippy-popper[x-placement^=bottom] .tippy-tooltip.tooltip-secondary-theme .tippy-arrow {
        top:-15px;
        border-bottom-color: var(--secondary);
    }
    .tippy-popper[x-placement^=left] .tippy-tooltip.tooltip-secondary-theme .tippy-arrow {
        right:-15px;
        border-left-color: var(--secondary);
    }
    .tippy-popper[x-placement^=right] .tippy-tooltip.tooltip-secondary-theme .tippy-arrow {
        left:-15px;
        border-right-color: var(--secondary);
    }

    /*TOOLTIP INFO*/
    .tippy-tooltip.tooltip-info-theme {
        background-color: var(--info);
        color: white;
    }
    .tippy-popper[x-placement^=top] .tippy-tooltip.tooltip-info-theme .tippy-arrow {
        bottom:-15px;
        border-top-color: var(--info);
    }
    .tippy-popper[x-placement^=bottom] .tippy-tooltip.tooltip-info-theme .tippy-arrow {
        top:-15px;
        border-bottom-color: var(--info);
    }
    .tippy-popper[x-placement^=left] .tippy-tooltip.tooltip-info-theme .tippy-arrow {
        right:-15px;
        border-left-color: var(--info);
    }
    .tippy-popper[x-placement^=right] .tippy-tooltip.tooltip-info-theme .tippy-arrow {
        left:-15px;
        border-right-color: var(--info);
    }

    /*TOOLTIP PURPLE*/
    .tippy-tooltip.tooltip-purple-theme {
        background-color: var(--purple);
        color: white;
    }
    .tippy-popper[x-placement^=top] .tippy-tooltip.tooltip-purple-theme .tippy-arrow {
        bottom:-15px;
        border-top-color: var(--purple);
    }
    .tippy-popper[x-placement^=bottom] .tippy-tooltip.tooltip-purple-theme .tippy-arrow {
        top:-15px;
        border-bottom-color: var(--purple);
    }
    .tippy-popper[x-placement^=left] .tippy-tooltip.tooltip-purple-theme .tippy-arrow {
        right:-15px;
        border-left-color: var(--purple);
    }
    .tippy-popper[x-placement^=right] .tippy-tooltip.tooltip-purple-theme .tippy-arrow {
        left:-15px;
        border-right-color: var(--purple);
    }

    /*TOOLTIP ORANGE*/
    .tippy-tooltip.tooltip-orange-theme {
        background-color: var(--orange);
        color: white;
    }
    .tippy-popper[x-placement^=top] .tippy-tooltip.tooltip-orange-theme .tippy-arrow {
        bottom:-15px;
        border-top-color: var(--orange);
    }
    .tippy-popper[x-placement^=bottom] .tippy-tooltip.tooltip-orange-theme .tippy-arrow {
        top:-15px;
        border-bottom-color: var(--orange);
    }
    .tippy-popper[x-placement^=left] .tippy-tooltip.tooltip-orange-theme .tippy-arrow {
        right:-15px;
        border-left-color: var(--orange);
    }
    .tippy-popper[x-placement^=right] .tippy-tooltip.tooltip-orange-theme .tippy-arrow {
        left:-15px;
        border-right-color: var(--orange);
    }



    @media (min-width: 576px) {  }



    @media (min-width: 992px) {  }

    @media (min-width: 1200px) { }
    @media (min-width: 768px) {

        .nav-patientcare .card.title{
            font-size: 1.5rem;
        }

    }
</style>
