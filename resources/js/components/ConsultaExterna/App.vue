<template>
    <div class="d-flex flex-column vh-100 bg-gray-1">
        <Loading />
        <Navbar1 />
        <h4 class="text-primary px-1">{{$route.name}}</h4>
        
        <div class="flex-fill d-flex overflow-auto">
            <MenuPatientcare />
            <div class="nav-patientcare  flex-fill d-flex flex-column overflow-auto  rounded-pill-custom-1"
                style="background-color: #fafdff;">
                <!-- contenido inicio -->
                <transition name="fade">
                    <router-view></router-view>
                </transition>
              <!-- contenido fin -->
            </div>
        </div>

    </div>
</template>
<script>

    import { get, is_empty, is_null, is_undefined } from '../../helpers/customHelpers';
    import Loading from './components/Loading.vue';
    import MenuPatientcare from '../Menus/ConsultaExternaMenu.vue';
    import Navbar1 from '../Navbars/NavbarConsultaExterna.vue';
    /* import Navbar2 from './components/Navbar2.vue';
    import Navbar3 from './components/Navbar3.vue';

    import CardPaciente from './components/CardPaciente.vue'; */
    //import tippy from 'tippy.js'; // Importa Tippy.js
    //import 'tippy.js/dist/tippy.css'; // Importa los estilos de Tippy.js
    export default {
        name: "ConsultaExterna",
        data() {
            return {

            }
        },
        components: {
            Navbar1,
            MenuPatientcare,
            Loading,
    
        },
        
        computed: {

        },
        methods: {


        },
        async created() {

        },
        async mounted() {
            //CARGAR Ubicaciones de areas
            //await this.getCatUbicaciones()

            //OBTENER BOTONES DE ACCESO A AREAS
            //this.getMenuAreas()

            //ACTIVAR menus laterales
            //this.getLocalStorageSidebar();
            this.$store.commit('updateProperty', {
                fieldName: 'loading',
                fieldValue: false,
            });
            this.$store.commit('updateProperty', {
                fieldName: 'sidebarLeft',
                fieldValue: false,
            });



        },
        updated() {

            //this.initTooltips()
        }



    }

</script>
<style>
.bg-light>a.navbar-brand {
    color: var(--primary) !important;
}

.shadow-inset-sm {
    box-shadow: 1px 1px 25px -16px rgba(0, 0, 0, 1) inset;
    -webkit-box-shadow: 1px 1px 25px -16px rgba(0, 0, 0, 1) inset;
    -moz-box-shadow: 1px 1px 25px -16px rgba(0, 0, 0, 1) inset;
}

/***********/
.rounded-pill-custom-1 {
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

.shadow-box {
    -webkit-box-shadow: inset 0px 0px 3px 0px rgba(0, 0, 0, 0.30);
    -moz-box-shadow: inset 0px 0px 3px 0px rgba(0, 0, 0, 0.30);
    box-shadow: inset 0px 0px 3px 0px rgba(0, 0, 0, 0.30);
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

.shadow-box {
    -webkit-box-shadow: inset 0px 0px 3px 0px rgba(0, 0, 0, 0.30);
    -moz-box-shadow: inset 0px 0px 3px 0px rgba(0, 0, 0, 0.30);
    box-shadow: inset 0px 0px 3px 0px rgba(0, 0, 0, 0.30);
}

/*Estilos para el menu principal*/
.content-box {
    transition: width 0.5s, opacity 0.5s;
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
.sticky {
    position: sticky;
    top: 0px;
}

.valign-center {
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

.nav-pills .nav-link.active,
.nav-pills .show>.nav-link {
    color: #fff;
    background-color: var(--primary);
}

a {
    color: var(--primary);
    text-decoration: none;
    background-color: transparent;
}

a:hover {
    background-color: whitesmoke;
    color: var(--primary);
    text-decoration: none;

}

.badge-white {
    color: var(--primary);
    background-color: var(--white);
}

#list_areas .nav-link .badge {
    display: none;
}

#list_areas .nav-link.active .badge {
    display: block;
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
.tippy-box[data-theme~='tooltip-primary'] {
    background-color: var(--primary);
    color: white;
}

.tippy-box[data-theme~='tooltip-primary'][data-placement^='top']>.tippy-arrow::before {
    border-top-color: var(--primary);
}

.tippy-box[data-theme~='tooltip-primary'][data-placement^='bottom']>.tippy-arrow::before {
    border-bottom-color: var(--primary);
}

.tippy-box[data-theme~='tooltip-primary'][data-placement^='left']>.tippy-arrow::before {
    border-left-color: var(--primary);
}

.tippy-box[data-theme~='tooltip-primary'][data-placement^='right']>.tippy-arrow::before {
    border-right-color: var(--primary);
}

/*TOOLTIP SUCCESS*/
.tippy-box[data-theme~='tooltip-success'] {
    background-color: var(--success);
    color: white;
}

.tippy-box[data-theme~='tooltip-success'][data-placement^='top']>.tippy-arrow::before {
    border-top-color: var(--success);
}

.tippy-box[data-theme~='tooltip-success'][data-placement^='bottom']>.tippy-arrow::before {
    border-bottom-color: var(--success);
}

.tippy-box[data-theme~='tooltip-success'][data-placement^='left']>.tippy-arrow::before {
    border-left-color: var(--success);
}

.tippy-box[data-theme~='tooltip-success'][data-placement^='right']>.tippy-arrow::before {
    border-right-color: var(--success);
}

/*TOOLTIP DANGER*/
.tippy-box[data-theme~='tooltip-danger'] {
    background-color: var(--danger);
    color: white;
}

.tippy-box[data-theme~='tooltip-danger'][data-placement^='top']>.tippy-arrow::before {
    border-top-color: var(--danger);
}

.tippy-box[data-theme~='tooltip-danger'][data-placement^='bottom']>.tippy-arrow::before {
    border-bottom-color: var(--danger);
}

.tippy-box[data-theme~='tooltip-danger'][data-placement^='left']>.tippy-arrow::before {
    border-left-color: var(--danger);
}

.tippy-box[data-theme~='tooltip-danger'][data-placement^='right']>.tippy-arrow::before {
    border-right-color: var(--danger);
}

/*TOOLTIP DANGER 2*/
.tippy-box[data-theme~='tooltip-danger-2'] {
    background-color: #F78181;
    color: white;
}

.tippy-box[data-theme~='tooltip-danger-2'][data-placement^='top']>.tippy-arrow::before {
    border-top-color: #F78181;
}

.tippy-box[data-theme~='tooltip-danger-2'][data-placement^='bottom']>.tippy-arrow::before {
    border-bottom-color: #F78181;
}

.tippy-box[data-theme~='tooltip-danger-2'][data-placement^='left']>.tippy-arrow::before {
    border-left-color: #F78181;
}

.tippy-box[data-theme~='tooltip-danger-2'][data-placement^='right']>.tippy-arrow::before {
    border-right-color: #F78181;
}

/*TOOLTIP GRAY*/
.tippy-box[data-theme~='tooltip-gray'] {
    background-color: #C4C4C4;
    color: white;
}

.tippy-box[data-theme~='tooltip-gray'][data-placement^='top']>.tippy-arrow::before {
    border-top-color: #C4C4C4;
}

.tippy-box[data-theme~='tooltip-gray'][data-placement^='bottom']>.tippy-arrow::before {
    border-bottom-color: #C4C4C4;
}

.tippy-box[data-theme~='tooltip-gray'][data-placement^='left']>.tippy-arrow::before {
    border-left-color: #C4C4C4;
}

.tippy-box[data-theme~='tooltip-gray'][data-placement^='right']>.tippy-arrow::before {
    border-right-color: #C4C4C4;
}

/*TOOLTIP GRAY TEXT PRIMARY*/
.tippy-box[data-theme~='tooltip-gray-primary'] {
    background-color: #C4C4C4;
    color: var(--primary);
}

.tippy-box[data-theme~='tooltip-gray-primary'][data-placement^='top']>.tippy-arrow::before {
    border-top-color: #C4C4C4;
}

.tippy-box[data-theme~='tooltip-gray-primary'][data-placement^='bottom']>.tippy-arrow::before {
    border-bottom-color: #C4C4C4;
}

.tippy-box[data-theme~='tooltip-gray-primary'][data-placement^='left']>.tippy-arrow::before {
    border-left-color: #C4C4C4;
}

.tippy-box[data-theme~='tooltip-gray-primary'][data-placement^='right']>.tippy-arrow::before {
    border-right-color: #C4C4C4;
}

/*TOOLTIP CYAN*/
.tippy-box[data-theme~='tooltip-cyan'] {
    background-color: #00AAFF;
    color: white;
}

.tippy-box[data-theme~='tooltip-cyan'][data-placement^='top']>.tippy-arrow::before {
    border-top-color: #00AAFF;
}

.tippy-box[data-theme~='tooltip-cyan'][data-placement^='bottom']>.tippy-arrow::before {
    border-bottom-color: #00AAFF;
}

.tippy-box[data-theme~='tooltip-cyan'][data-placement^='left']>.tippy-arrow::before {
    border-left-color: #00AAFF;
}

.tippy-box[data-theme~='tooltip-cyan'][data-placement^='right']>.tippy-arrow::before {
    border-right-color: #00AAFF;
}

/*TOOLTIP WARNING*/
.tippy-box[data-theme~='tooltip-warning'] {
    background-color: var(--warning);
    color: white;
}

.tippy-box[data-theme~='tooltip-warning'][data-placement^='top']>.tippy-arrow::before {
    border-top-color: var(--warning);
}

.tippy-box[data-theme~='tooltip-warning'][data-placement^='bottom']>.tippy-arrow::before {
    border-bottom-color: var(--warning);
}

.tippy-box[data-theme~='tooltip-warning'][data-placement^='left']>.tippy-arrow::before {
    border-left-color: var(--warning);
}

.tippy-box[data-theme~='tooltip-warning'][data-placement^='right']>.tippy-arrow::before {
    border-right-color: var(--warning);
}

/*TOOLTIP SECONDARY*/
.tippy-box[data-theme~='tooltip-secondary'] {
    background-color: var(--secondary);
    color: white;
}

.tippy-box[data-theme~='tooltip-secondary'][data-placement^='top']>.tippy-arrow::before {
    border-top-color: var(--secondary);
}

.tippy-box[data-theme~='tooltip-secondary'][data-placement^='bottom']>.tippy-arrow::before {
    border-bottom-color: var(--secondary);
}

.tippy-box[data-theme~='tooltip-secondary'][data-placement^='left']>.tippy-arrow::before {
    border-left-color: var(--secondary);
}

.tippy-box[data-theme~='tooltip-secondary'][data-placement^='right']>.tippy-arrow::before {
    border-right-color: var(--secondary);
}

/*TOOLTIP INFO*/
.tippy-box[data-theme~='tooltip-info'] {
    background-color: var(--info);
    color: white;
}

.tippy-box[data-theme~='tooltip-info'][data-placement^='top']>.tippy-arrow::before {
    border-top-color: var(--info);
}

.tippy-box[data-theme~='tooltip-info'][data-placement^='bottom']>.tippy-arrow::before {
    border-bottom-color: var(--info);
}

.tippy-box[data-theme~='tooltip-info'][data-placement^='left']>.tippy-arrow::before {
    border-left-color: var(--info);
}

.tippy-box[data-theme~='tooltip-info'][data-placement^='right']>.tippy-arrow::before {
    border-right-color: var(--info);
}

/*TOOLTIP PURPLE*/
.tippy-box[data-theme~='tooltip-purple'] {
    background-color: var(--purple);
    color: white;
}

.tippy-box[data-theme~='tooltip-purple'][data-placement^='top']>.tippy-arrow::before {
    border-top-color: var(--purple);
}

.tippy-box[data-theme~='tooltip-purple'][data-placement^='bottom']>.tippy-arrow::before {
    border-bottom-color: var(--purple);
}

.tippy-box[data-theme~='tooltip-purple'][data-placement^='left']>.tippy-arrow::before {
    border-left-color: var(--purple);
}

.tippy-box[data-theme~='tooltip-purple'][data-placement^='right']>.tippy-arrow::before {
    border-right-color: var(--purple);
}

/*TOOLTIP ORANGE*/
.tippy-box[data-theme~='tooltip-orange'] {
    background-color: var(--orange);
    color: white;
}

.tippy-box[data-theme~='tooltip-orange'][data-placement^='top']>.tippy-arrow::before {
    border-top-color: var(--orange);
}

.tippy-box[data-theme~='tooltip-orange'][data-placement^='bottom']>.tippy-arrow::before {
    border-bottom-color: var(--orange);
}

.tippy-box[data-theme~='tooltip-orange'][data-placement^='left']>.tippy-arrow::before {
    border-left-color: var(--orange);
}

.tippy-box[data-theme~='tooltip-orange'][data-placement^='right']>.tippy-arrow::before {
    border-right-color: var(--orange);
}

@media (min-width: 576px) {}



@media (min-width: 992px) {}

@media (min-width: 1200px) {}

@media (min-width: 768px) {

    .nav-patientcare .card.title {
        font-size: 1.5rem;
    }

}</style>
