<template>
    <div class="d-flex flex-column vh-100 overflow-auto">
        <CintilloSuperior 
            :relog_hora="relog_hora" 
            :total_habitaciones_ocupadas="total_habitaciones_ocupadas"
            :total_habitaciones="total_habitaciones" 
            :pacientes_activos="pacientes_activos" 
            :uti="uti"
        />
        <div class="container-fluid d-flex flex-column overflow-auto flex-fill pb-2">
            <table class="w-100 h-100" style="  border-collapse: separate;border-spacing: 1px 2px;">
                <thead>
                    <tr class="text-center text-white">
                        <th class="sticky-top">HAB</th>
                        <th class="sticky-top">PACIENTE</th>
                        <th class="sticky-top">DÍAS</th>
                        <th class="sticky-top">RIESGOS</th>
                        <th class="sticky-top">PENDIENTES</th>
                        <th class="sticky-top">OBSERVACIONES</th>
                        <th class="sticky-top">TRATANTES</th>
                        <th class="sticky-top">RESIDENTES</th>
                        <th class="sticky-top">ENFERMERÍA</th>
                    </tr>
                </thead>
                <tbody> 
                    <tr 
                        v-for="(item,index) in getHabitaciones" 
                        :key="item.id"
                        class="text-white text-center " style="height:40px"
                    >
                        
                        <Column1 :ubication="item" :height="'auto'" :index="index" />
                        <Column2 :ubication="item" :height="'auto'" :index="index" />
                        <Column3 :ubication="item" :height="'auto'" :index="index" />
                        <Column4 :ubication="item" :height="'auto'" :index="index" />
                        <Column5 :ubication="item" :height="'auto'" :index="index" />
                        <Column6 :ubication="item" :height="'auto'" :index="index" />
                        <Column7 :ubication="item" :height="'auto'" :index="index" />
                        <Column8 :ubication="item" :height="'auto'" :index="index" />
                        <Column9 :ubication="item" :height="'auto'" :index="index" />
                        
                        
                        
                        
                        
                    </tr>
                </tbody>
            </table>
            <!-- <div class="flex-fill d-flex flex-column overflow-auto">
                    <div class=" d-flex align-items-center sticky-top" style="gap:5px; color:white;font-weight: bold;">
                        <div style="text-align: center;width:10%" >CAMA</div>
                        <div style="text-align: center;width: 15%" class="pl-1" >PACIENTE</div>
                        <div style="text-align: center;width: 5% !important;" >DÍAS</div>
                        <div style="text-align: center;width:10%;" >RIESGOS</div>
                        <div style="text-align: center;width:15%;" >PENDIENTES</div>
                        <div style="text-align: center;width:15%;" >OBSERVACIONES</div>
                        <div style="text-align: center;width:15%;" >TRATANTES</div>
                        <div style="text-align: center;width:15%;" >RESIDENTES</div>
                        <div style="text-align: center;width:15%;" >ENFERMERÍA</div>
                    </div>
              
                    <div 
                        v-for="(item,index) in getHabitaciones" 
                        :key="item.id"
                        class="flex-fill d-flex  swing-in-top-fwd shadow-sm" 
                        style=" margin-bottom:2px; gap:2px; text-align: center;color:white;"
                    >
                        
                        
                        <Column2 :ubication="item" :index="index" />
                        <Column3 :ubication="item" :index="index" />
                        <Column4 :ubication="item" :index="index" />
                        <Column5 :ubication="item" :index="index" />
                        <Column6 :ubication="item" :index="index" />
                        <Column7 :ubication="item" :index="index" />
                        <Column8 :ubication="item" :index="index" />
                        <Column9 :ubication="item" :index="index" />
                    </div>
            </div> -->
        </div>
    </div>

</template>
<script>

    import { get, is_null, horaPm, meses, is_undefined, formatAMPM, obtenerVariablesGET } from '../../../helpers/customHelpers';
    import Navbar1 from '../../Navbars/Navbar1.vue';
    import CintilloSuperior from './components/CintilloSuperior.vue';
    import Column1 from './components/Column1.vue';
    import Column2 from './components/Column2.vue';
    import Column3 from './components/Column3.vue';
    import Column4 from './components/Column4.vue';
    import Column5 from './components/Column5.vue';
    import Column6 from './components/Column6.vue';
    import Column7 from './components/Column7.vue';
    import Column8 from './components/Column8.vue';
    import Column9 from './components/Column9.vue';

    export default {
        name: "AppPantallaUTI",
        components: {
            Navbar1,
            CintilloSuperior,
            Column1,
            Column2,
            Column3,
            Column4,
            Column5,
            Column6,
            Column7,
            Column8,
            Column9,
        },
        data() {
            return {
                relog_hora: "",
                catUbicacion: [],
                pacientes_activos: [],
                
                total_habitaciones_ocupadas: 0,
                total_habitaciones: 0,

                uti: [
                    {
                       
                        uti: "a",
                        name: "UTI ADULTO",
                        parent_ubicacion_id:[182],
                        ubicacion_id: null,

                    },
                    {
                        uti: "p",
                        name: "UTI PEDIÁTRICO",
                        parent_ubicacion_id:[211],
                        ubicacion_id: null,
                    },
                    {
                        uti: "n",
                        name: "UTI NEONATAL",
                        parent_ubicacion_id:[391],
                        ubicacion_id:null ,
                    },
                    
                    
                ]
            }
        },
        methods: {
            async getPacientesActivos() {
                try {
                    this.$store.commit('updateProperty', {
                        fieldName: 'loading',
                        fieldValue: true,
                    });
                    let model = await get(location.origin + "/episodio/pacientes_activos/uti");
                    this.$store.commit('updateProperty', {
                        fieldName: 'pacientes_activos',
                        fieldValue: model,
                    })
                    //console.log(model);

                    this.$store.commit('updateProperty', {
                        fieldName: 'loading',
                        fieldValue: false,
                    });
                } catch (error) {
                    console.error('Error al obtener los datos:', error);
                    this.$store.commit('updateProperty', {
                        fieldName: 'loading',
                        fieldValue: false,
                    });
                    return []
                }
            },
            async getCatUbicaciones() {
                try {
                    this.$store.commit('updateProperty', {
                        fieldName: 'loading',
                        fieldValue: true,
                    });
                   let model = await get(location.origin + "/cat_user_ubicacion/getAll");
                    this.$store.commit('updateProperty', {
                        fieldName: 'catUbicacion',
                        fieldValue: model,
                    })
                    this.$store.commit('updateProperty', {
                        fieldName: 'loading',
                        fieldValue: false,
                    });
                } catch (error) {
                    console.error('Error al obtener los datos:', error);
                    this.$store.commit('updateProperty', {
                        fieldName: 'loading',
                        fieldValue: false,
                    });
                    return []
                }
            },
        },
        computed: {
            getHabitaciones() {
                let ubicaciones = []
                let area = this.uti.find(x => x.uti === this.$route.query.uti)
                if (area) {

                    if (area.parent_ubicacion_id) {
                        this.total_habitaciones = this.$store.state.catUbicacion.filter(x=>area.parent_ubicacion_id.includes(x.parent_cat_user_ubicacion_id)).length

                        ubicaciones =  this.$store.state.catUbicacion.filter(x=>area.parent_ubicacion_id.includes(x.parent_cat_user_ubicacion_id))
                        this.total_habitaciones_ocupadas = this.$store.state.pacientes_activos.filter(x=>ubicaciones.map(x=>x.id).includes(x.cat_user_ubicacion_id)).length

                    }
                    if (area.ubicacion_id) {
                      
                        ubicaciones = this.$store.state.pacientes_activos.filter(x=>area.ubicacion_id.includes(x.cat_user_ubicacion_id))
                        this.total_habitaciones_ocupadas = ubicaciones.length
                        this.total_habitaciones = ''
                        
                    }

                    
                }
                
                return ubicaciones
                
            },

          
        },

        async created () {
        
            await this.getCatUbicaciones()
            await this.getPacientesActivos()
            const that = this
            
            
            setInterval(() => {
                let date = new Date()
                let hora = date.getHours()
                let ampm = hora > 12 ? 'PM' : 'AM'
                hora = horaPm[String(hora)]
                that.relog_hora = formatAMPM(date)
              
            }, 1000)
            setInterval(async () => {
                await this.getPacientesActivos()
            }, 10000);
        },

    }

</script>
<style>
    .bg-success {
        background-color: var(--success) !important;
    }
    .bg-info-piso {
        background-color: rgba(0, 170, 255, .5) !important;
    }
    .badge-pink {
        color: #ffffff;
        background-color: #f278b0;
    }

    .text-success-cirugia,
    .text-success-resbalar,
    .text-success-alert {
        color: #06ff3f !important;
    }

    .miModal-options:hover {

        background-color: rgb(0 0 0 / 20%);
        cursor: pointer;
        border-radius: 10px;

    }

    body {
        background-color: #233a6d !important;

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
        font-size: 1.5rem;
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
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.5s;
    }

    .fade-enter,
    .fade-leave-to

    /* .fade-leave-active in <2.1.8 */
        {
        opacity: 0;
    }

    .img-logo {
        height: 50px;
        width: 120px;
    }


    .btn-primary-custom {
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

    @keyframes swing-in-top-fwd {
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
        opacity: 0;
        transition: width 0.5s, opacity 0.5s;
        padding-left: 0;
        padding-right: 0;
    }

    .sidebar-right {
        width: 0px;
        transform: translateX(100%);
        visibility: hidden;
        opacity: 0;
        transition: width 0.5s, opacity 0.5s;
        padding-left: 0;
        padding-right: 0;
    }

    .sidebar.show {
        visibility: visible;
        width: 250px;
        transform: translateX(0%);
        opacity: 1;
    }

    .content {
        border-radius: 1.5rem;
        /*height: 90vh;*/
    }

    .content.hide {

        transition: all 1.5s;
    }

    .shadow-box {
        -webkit-box-shadow: inset 0px 0px 3px 0px rgba(0, 0, 0, 0.30);
        -moz-box-shadow: inset 0px 0px 3px 0px rgba(0, 0, 0, 0.30);
        box-shadow: inset 0px 0px 3px 0px rgba(0, 0, 0, 0.30);
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

    .btn-rounded-pill-custom {
        border-radius: 19px !important;
    }

    .btn-primary-custom {
        color: #ffffff;
        background-color: #5b96df !important;
    }

    .sticky {
        position: sticky;
        top: 0px;
    }

    .valign-center {
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
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.5s;
    }

    .fade-enter,
    .fade-leave-to

    /* .fade-leave-active in <2.1.8 */
        {
        opacity: 0;
    }

    .row_counter_user div:nth-child(1) {
        width: 15px;
        text-align: center;
    }

    .row_counter_user div:nth-child(2) {
        width: 30px;
        text-align: center;
    }

    .rounded-pill-1 {
        border-radius: 20px;
    }

    .rounded-top-pill {
        border-top-right-radius: 20px;
        border-top-left-radius: 20px;
    }

    .rounded-bottom-pill {
        border-bottom-right-radius: 20px;
        border-bottom-left-radius: 20px;
    }

    .total-title {
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .total-counter {
        line-height: 1;
    }

    .total-icon {
        font-size: 2em;
    }


    .rounded-custom-1 {
        border-radius: 1.25rem;
    }

    :root {
        --radius-table-row: 10px;
        /*  --table-border-row-color:rgb(240, 240, 241); */
    }



    .shadow-1 {
        text-shadow: 1px 1px 2px rgb(0 0 0 / 100%);
    }

    .glassmod-effect {
        background-color: rgb(255 255 255 / 30%);
        backdrop-filter: blur(20px);
    }

    .router-link-active,
    .glassmod-effect-btn:hover {
        background-color: rgb(255 255 255 / 59%);
    }

    .corner-radius-top-left {
        border-top-left-radius: var(--radius-table-row);
    }

    .corner-radius-bottom-left {
        border-bottom-left-radius: var(--radius-table-row);
    }

    .tbl-row-radius-left {
        border-top-left-radius: var(--radius-table-row);
        border-bottom-left-radius: var(--radius-table-row);
        border-left: 1px solid var(--table-border-row-color);
        border-top: 1px solid var(--table-border-row-color);
        border-bottom: 1px solid var(--table-border-row-color);
    }

    .tbl-row-radius-right {
        border-top-right-radius: var(--radius-table-row);
        border-bottom-right-radius: var(--radius-table-row);
        border-right: 1px solid var(--table-border-row-color);
        border-top: 1px solid var(--table-border-row-color);
        border-bottom: 1px solid var(--table-border-row-color);
    }

    .sticky-top {
        position: sticky;
    }

    .text-shadow {
        text-shadow: 2px 2px 5px rgba(43, 19, 12, 0.50);
    }



    .img-logo {
        height: 50px;
        width: 120px;
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

    @keyframes swing-in-top-fwd {
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

    .h-100 {
        height: 100vh;
    }

    ul,
    li {
        margin: 0 0 0 0;
        padding: 0 0 0 0;
    }

    .blink-2 {
        -webkit-animation: blink-2 1s infinite both;
        animation: blink-2 1s infinite both
    }

    @-webkit-keyframes blink-2 {
        0% {
            opacity: 1
        }

        50% {
            opacity: .2
        }

        100% {
            opacity: 1
        }
    }

    @keyframes blink-2 {
        0% {
            opacity: 1
        }

        50% {
            opacity: .2
        }

        100% {
            opacity: 1
        }
    }

    .rotate-in-ver {
        -webkit-animation: rotate-in-ver .5s cubic-bezier(.25, .46, .45, .94) both;
        animation: rotate-in-ver .5s cubic-bezier(.25, .46, .45, .94) both
    }

    @-webkit-keyframes rotate-in-ver {
        0% {
            -webkit-transform: rotateY(-360deg);
            transform: rotateY(-360deg);
            opacity: 0
        }

        100% {
            -webkit-transform: rotateY(0deg);
            transform: rotateY(0deg);
            opacity: 1
        }
    }

    @keyframes rotate-in-ver {
        0% {
            -webkit-transform: rotateY(-360deg);
            transform: rotateY(-360deg);
            opacity: 0
        }

        100% {
            -webkit-transform: rotateY(0deg);
            transform: rotateY(0deg);
            opacity: 1
        }
    }
</style>
