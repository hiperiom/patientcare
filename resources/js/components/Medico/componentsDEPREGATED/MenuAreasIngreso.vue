<template>
    <nav class="row bg-light rounded border mx-1 mb-1">
        <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 p-1 orden-1 overflow-auto" id="cat_user_ubicacion_menu">
            <ul class="nav nav-pills flex-nowrap" role="tablist">

                <li

                    class="menuArea nav-item"
                    role="presentation"
                    v-for="(item,index) in this.$store.state.menuAreas.filter(x=>![6].includes(x.group_id))" :key="index"
                >
                    <a
                        @click="getArea(item.area_siglas)"
                        :class="['nav-link',{'active':getAreaSiglas() === item.area_siglas}]"
                        data-toggle="pill"
                        href="#"
                        role="tab"
                        :aria-controls="'pills-'+item.area_siglas"
                        aria-selected="false"
                        :content="'Área '+item.area_description"
                        v-tippy="{ arrow : false,animateFill:false,touch:false,flipBehavior:['top'], distance:-80, placement:'top', theme : 'tooltip-primary' }"
                    >

                        {{ item.area_siglas.toUpperCase() }}
                    </a>
                </li>
                <li

                    class="menuArea nav-item"
                    role="presentation"

                >
                    <a
                        @click="handle_PrealtaPaciente()"
                        :class="['nav-link',{'active': ['pad_emergencia_adulto','pad_emergencia_pediatrica','pad_medico','pad_postquirurgico_amb','pad_postquirurgico_hosp'].includes(getAreaSiglas())}]"
                        data-toggle="pill"
                        href="#"
                        role="tab"
                        :aria-controls="'pills-pad'"
                        aria-selected="false"
                        :content="'Área PAD'"
                        v-tippy="{ arrow : false,animateFill:false,touch:false,flipBehavior:['top'], distance:-80, placement:'top', theme : 'tooltip-primary' }"
                    >

                       PAD
                    </a>
                </li>


               <!--  <li class="menuArea nav-item" data-titlearea="Programa de Atención domicialiaria" data-area="PAD" role="presentation" onclick="">
                    <a class="nav-link" id="pills-PAD-tab" data-toggle="pill" href="#pills-PAD" role="tab" aria-controls="pills-PAD" aria-selected="false">PAD</a>
                </li>

                <li class="menuArea nav-item" data-titlearea="Alta Médica" data-area="ALTA" role="presentation" onclick="">
                    <a class="nav-link" id="pills-ALTA-tab" data-toggle="pill" href="#pills-ALTA" role="tab" aria-controls="pills-ALTA" aria-selected="false">ALTA</a>
                </li> -->

            </ul>
        </div>
        <div class="col-5 col-sm-4 col-md-3 col-lg-2 col-xl-2 order-4 order-lg-2 p-1">
            <button @click="handlePacienteCreate()" id="btn_paciente_create" class="btn btn-success btn-block text-nowrap rounded font-weight-bold btn-block">Nuevo Paciente</button>
        </div>
        <div class="col-12 col-sm-12 col-md-5 col-lg-8 col-xl-8 d-none d-md-block order-2 order-lg-2 p-1">
            <div class="d-flex justify-content-end" id="btnNotificaciones">

                <button
                    content="Total Pacientes"
                    v-tippy="{ arrow : true, touch:false, theme : 'tooltip-primary' }"
                    type="button"
                    class="btnNotification text-uppercase text-primary font-weight-bold btn btn-gray float-right mr-1">
                    <i class="pc-paciente text-info"></i> TOTAL PACIENTES <span style="font-size: 96%;" class="badge badge-light text-secondary">{{ $store.state.total_pacientes() }}</span>
                </button>
                <button
                    v-if="this.$store.state.ruta === 'tp'"
                    content="Total Pacientes en Emergencia"
                    v-tippy="{ arrow : true, touch:false, theme : 'tooltip-primary' }"
                    type="button"
                    class="btnNotification text-uppercase text-primary font-weight-bold btn btn-gray float-right mr-1">
                    <i class="pc-emergencia text-info"></i> EME <span style="font-size: 96%;" class="badge badge-light text-secondary">{{ $store.state.total_pacientes_emergencia() }}</span>
                </button>
                <button
                    v-if="this.$store.state.ruta === 'tp'"
                    content="Total Pacientes en área quirúrgica"
                    v-tippy="{ arrow : true, touch:false, theme : 'tooltip-primary' }"
                    type="button"
                    class="btnNotification text-uppercase text-primary font-weight-bold btn btn-gray float-right mr-1">
                    <i class="pc-cirugia-light text-info"></i> QX <span style="font-size: 96%;" class="badge badge-light text-secondary">{{ $store.state.total_pacientes_aq() }}</span>
                </button>
                <button
                    v-if="this.$store.state.ruta === 'tp'"
                    content="Total Pacientes en Hospitalización"
                    v-tippy="{ arrow : true, touch:false, theme : 'tooltip-primary' }"
                    type="button"
                    class="btnNotification text-uppercase text-primary font-weight-bold btn btn-gray float-right mr-1">
                    <i class="pc-light-pisos text-info"></i> HOSP <span style="font-size: 96%;" class="badge badge-light text-secondary">{{ $store.state.total_pacientes_hospitalizacion() }}</span>
                </button>
                <button
                    v-if="this.$store.state.ruta === 'tp'"
                    content="Total Pacientes en Unidad de Tratamiento Intensivo"
                    v-tippy="{ arrow : true, touch:false, theme : 'tooltip-primary' }"
                    type="button"
                    class="btnNotification text-uppercase text-primary font-weight-bold btn btn-gray float-right mr-1">
                    <i class="pc-uti-light text-info"></i> UTI <span style="font-size: 96%;" class="badge badge-light text-secondary">{{ $store.state.total_pacientes_uti() }}</span>
                </button>
                <button
                    v-if="areaActual === 'tp'"
                    content="Total Pacientes en Programa de Atención Domiciliaria"
                    v-tippy="{ arrow : true, touch:false, theme : 'tooltip-primary' }"
                    type="button"
                    class="btnNotification text-uppercase text-primary font-weight-bold btn btn-gray float-right mr-1">
                    <i class="pc-light-homecare text-info"></i> PAD <span style="font-size: 96%;" class="badge badge-light text-secondary">{{ $store.state.total_pacientes_pad() }}</span>
                </button>

            </div>
        </div>
        <div class="col-7 col-sm-8 col-md-4 col-lg-4 col-xl-4 p-1 order-2 ">
            <input type="search" class="form-control" id="busquedapaciente" ref="busquedapaciente" placeholder="Buscar paciente..." aria-label="Buscar paciente..." aria-describedby="button-addon2">
        </div>
        <div class="col-12 row order-4 align-items-center">
            <div id="titleArea" class="mx-2 text-primary font-weight-bold text-nowrap">
                <button
                    @click="handleEquipoMedicoEnArea()"
                    data-tippy-content="Pulse para ver el Equipo Médico en el área"
                    type="button" class="btn btn-light btn-block"
                >
                    <span class="h5 text-uppercase mb-0 font-weight-bold text-primary">
                        {{ $store.state.area_description }}
                    </span>
                </button>
            </div>
            <div id="signosP" class="col marquee-with-options" style="height: 30px;">
                <marquee class="cursor-pointer" onmouseout="this.start()" onmouseover="this.stop()" scrollamount="5" style="width:600">
                    <span
                        v-for="(item,index) in getAlertOxp2()" :key="'a'+index"
                        :class="{'text-warning':(item.oxi >= 91 && item.oxi <= 93.9),'text-danger':(item.oxi <= 90)}" >
                        <span class="font-weight-bold">SPO2</span> -
                        <span class="font-weight-bold">{{item.oxi}}%</span> |
                        <span class="font-weight-bold text-gray">{{ item.paciente }}</span> |
                        <span class="font-weight-bold text-gray">{{ item.ubicacion }}</span>
                        <span v-if="getAlertOxp2().length > (index +1)">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </span>
                    <span v-if="getAlertTemp().length > 0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <span
                        v-for="(item,index) in getAlertTemp()" :key="'b'+index"
                        :class="{'text-warning':(item.temp >= 37.6 && item.temp <= 37.9),'text-danger':(item.temp >= 38),'text-danger':(item.temp <= 30.4) }" >
                        <span class="font-weight-bold">TEMP</span> -
                        <span class="font-weight-bold">{{item.temp}}º</span>
                        <span class="font-weight-bold text-gray">{{ item.paciente }}</span> |
                        <span class="font-weight-bold text-gray">{{ item.ubicacion }}</span>
                        <span v-if="getAlertTemp().length > (index +1)">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </span>
                    <span v-if="getAlertVIP().length > 0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <span
                        v-for="(item,index) in getAlertVIP()" :key="'c'+index"
                        :class="'text-info'" >
                        <span class="font-weight-bold"><i class="pc-paciente_vip text-info"></i></span> -
                        <span class="font-weight-bold"></span>
                        <span class="font-weight-bold text-gray">{{ item.paciente }}</span> |
                        <span class="font-weight-bold text-gray">{{ item.ubicacion }}</span>
                        <span v-if="getAlertVIP().length > (index +1)">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </span>



                </marquee>
            </div>
        </div>

    </nav>
</template>
<script>

    import { get, is_empty,obtenerVariablesGET,  is_null,is_undefined } from '../../../helpers/customHelpers';
    import BtnWidgetEquipoMedicoEnArea from './BtnWidgetEquipoMedicoEnArea.vue';
    import BtnWidgetPadMenu from './BtnWidgetPadMenu.vue';
    import FormPacienteCreate from './FormPacienteCreate.vue';
    export default{
        name:"MenuAreasIngreso",
        data() {
            return {
                areaActual:null

            }
        },
        props: {
            getPacientesActivos:{
                type:Function
            }
        },
        components: {
            BtnWidgetPadMenu,
            BtnWidgetEquipoMedicoEnArea,
            FormPacienteCreate,

        },
        watch: {
            '$route'(to, from) {

            }
        },
        computed:{

        },
        methods:{
            getAlertOxp2(){
                return this.$store.state.pacientes_datos.filter(x=> (x.oxi <= 93.9 && x.oxi !== "") )
            },
            getAlertTemp(){
                return this.$store.state.pacientes_datos.filter(x=> (x.temp <= 30.4 || x.temp >= 37.6) &&  x.temp !== "" )
            },
            getAlertVIP(){
                return this.$store.state.pacientes_datos.filter(x=> Number(x.vip) === 1 )
            },
            handle_PrealtaPaciente() {
                this.$store.commit('updateProperty', {
                    fieldName: 'componenteDinamico',
                    fieldValue: {
                        customComponent2: this.$options.components.BtnWidgetPadMenu,
                        index_row: 0,
                        dataPaciente: []
                    }
                });

                $("#messageModal").modal("show")
            },
            handleEquipoMedicoEnArea(){
                this.$store.commit('updateProperty', {
                    fieldName:'componenteDinamico',
                    fieldValue: {
                        customComponent: this.$options.components.BtnWidgetEquipoMedicoEnArea,
                        index_row:0,
                        dataPaciente:{}
                    }
                });

                $("#exampleModal").modal("show")
            },
            handlePacienteCreate(){
                this.$store.commit('updateProperty', {
                    fieldName:'componenteDinamico',
                    fieldValue: {
                        customComponent: this.$options.components.FormPacienteCreate,
                        index_row:1111,
                        dataPaciente:{}
                    }
                });

                $("#exampleModal").modal("show")
            },
            handleMenuPad(){
                this.$store.commit('updateProperty', {
                    fieldName:'componenteDinamico',
                    fieldValue: {
                        customComponent2: this.$options.components.ListOptionsPAD,
                        index_row:1111,
                        dataPaciente:{}
                    }
                });

                $("#messageModal").modal("show")
            },
            getAreaSiglas(){
                return localStorage.getItem('area_siglas')
            },
            getArea(nuevoId){
                this.areaActual =nuevoId
                if ( (location.origin +location.pathname+ `?route=${nuevoId}`) !== location.href) {
                    this.$router.push({ path: location.pathname+ `?route=${nuevoId}` }); // O $router.replace() si deseas reemplazar la historia de navegación
                    this.$store.commit('updateProperty', {
                        fieldName:'ruta',
                        fieldValue:obtenerVariablesGET( location.href ).route,
                    });
                    let {area_description} = this.$store.state.menuAreas.find(item=>item['area_siglas']===this.$store.state.ruta)
                    this.$store.commit('updateProperty', {
                        fieldName:'area_description',
                        fieldValue: area_description,
                    });

                        localStorage.setItem('area_siglas',this.$store.state.ruta)
                        localStorage.setItem('area_description',this.$store.state.area_description)

                    this.getPacientesActivos()
                }else{
                    location.reload();
                }
            },
            filtroTabla() {
                var busqueda = document.getElementById('busquedapaciente');
                var table = document.getElementById("myTable").tBodies[0];
                //console.log(busqueda);
                let buscaTabla = function() {
                    let texto = busqueda.value.toLowerCase();
                    var r = 0;
                    let row
                    while (row = table.rows[r++]) {
                        if (row.innerText.toLowerCase().indexOf(texto) !== -1)
                            row.style.display = null;
                        else
                            row.style.display = 'none';
                    }
                }

                busqueda.addEventListener('change', buscaTabla);

            }
        },

        async mounted(){
            this.filtroTabla()
            //let area = localStorage.getItem('area_siglas')
            //this.getArea(area)

           /*  this.menuActive = this.navMenuPatientcare.cmdlt.next
            this.gobackActive = this.navMenuPatientcare.cmdlt.goback */
        },
        updated(){

            //this.initTooltips()
        }



    }

</script>
<style scoped>






</style>
