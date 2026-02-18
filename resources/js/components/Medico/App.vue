<template>
    <div class="d-flex flex-column vh-100">
        <Loading />
        <UserNavBar />
        <MenuAreas />
        <BtnTotales />
        <NavbarNotifications />
        <ListSeguimientoPacientes />

        <component
            v-if="!$store.state.componenteDinamico.is_dismounted"
            :is="$store.state.componenteDinamico.customComponent"
            :index="$store.state.componenteDinamico.index"
            :patient_data="$store.state.componenteDinamico.patient_data"
        />
        <!--
            <div id="AppRowVitalSign" class="d-flex flex-wrap rounded border mx-1 overflow-auto"><div class="row-paciente col-12 mt-3 col-sm-12 col-md-6 col-lg-6 col-xl-12"><div class="d-flex flex-column flex-xl-row shadow-sm rounded bg-light"><div class="col col-md col-xl-1 d-flex flex-xl-wrap p-1"><button class="w-100 mr-1 mr-xl-0 order-1 order-1 btn btn-outline-gray p-1 d-flex flex-column justify-content-center align-items-center text-uppercase rounded"><b class="small-title text-primary">Ubicación</b> <div class="flex-fill d-flex justify-content-center align-items-end">
                        EP | Cub. 6
                    </div></button> <div class="col-xl-6 mr-1 mr-xl-0 my-xl-1 order-2 btn btn-outline-gray p-1 d-flex flex-column justify-content-center align-items-center text-uppercase rounded"><b class="small-title text-primary">Días</b> <div class="text-secondary mt-auto">
                       1
                    </div></div> <button class="btn-outline-gray col-xl d-flex order-4 btn p-1 flex-column justify-content-center align-items-center text-uppercase rounded"><b class="small-title text-primary">PREALTA</b> <i class="far fa-calendar text-gray mt-auto"></i></button> <button id="btn_traslado_ambulancia_30679" class="col-xl-6 mr-1 my-xl-1 mr-xl-0 order-3 btn btn-outline-gray p-1 d-flex flex-column justify-content-center align-items-center text-uppercase rounded"><b class="small-title text-primary">Traslado</b> <div class="mt-auto"><i class="fas fa-ambulance text-gray"></i></div></button></div> <div class="col px-1 d-flex flex-column"><div class="rounded d-flex flex-column flex-xl-row my-1" style="height: 100% !important; gap: 4px;"><div class="rounded width-custom d-flex flex-column justify-content-between border"><div class="d-flex flex-column"><div class="order-1 d-flex justify-content-end"><div class="dropdown"><button id="cirugia_20739" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-default p-1 dropdown-toggle"><i class="pc-cirugia text-success"></i></button> <div aria-labelledby="dropdownMenuButton" class="dropdown-menu"><a href="#" class="dropdown-item"><span class="pc-cirugia text-success"></span>
                            Estable
                        </a> <a href="#" class="dropdown-item"><span class="pc-cirugia text-warning"></span>
                            Intermedio
                        </a> <a href="#" class="active dropdown-item"><span class="pc-cirugia text-danger"></span>
                            De cuidado
                        </a></div></div> <div class="dropdown"><button id="resbalar_20739" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-default p-1 dropdown-toggle"><i class="pc-resbalar text-success"></i></button> <div aria-labelledby="dropdownMenuButton" class="dropdown-menu"><a href="#" class="active dropdown-item"><span class="pc-resbalar text-success"></span>
                            Estable
                        </a> <a href="#" class="dropdown-item"><span class="pc-resbalar text-warning"></span>
                            Intermedio
                        </a> <a href="#" class="dropdown-item"><span class="pc-resbalar text-danger"></span>
                            De cuidado
                        </a></div></div> <div class="dropdown"><button id="alert_20739" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-default p-1 dropdown-toggle"><i class="pc-alerta_estable text-success"></i></button> <div aria-labelledby="dropdownMenuButton" class="dropdown-menu"><a href="#" class="active dropdown-item"><span class="pc-alerta_estable text-success"></span>
                            Estable
                        </a> <a href="#" class="dropdown-item"><span class="pc-alerta_intermedia text-warning"></span>
                            Intermedio
                        </a> <a href="#" class="dropdown-item"><span class="pc-alerta_alta text-danger"></span>
                            De cuidado
                        </a></div></div> <div class="dropdown"><button id="vip_20739" type="button" aria-haspopup="true" aria-expanded="false" class="btn btn-default p-1"><i class="pc-paciente_vip text-info text-info-disabled"></i></button></div></div> <div class="order-2 w-100 d-flex align-items-center"><img src="/image/system/patient.svg" onerror="this.src='/image/system/icono-paciente-blanco.svg'" loading="lazy" alt="Imagen No Encontrada" class="align-self-start ml-1 mt-1 img-user-circle"> <div class="text-user-name text-primary text-uppercase pl-1">
                        Kothan Rangel Alliegro
                    </div></div> <div class="order-3 d-flex flex-column"><div class="tag-box px-1 d-flex align-items-center flex-wrap pb-1 text-uppercase"><div class="mt-1 badge d-flex align-items-center badge-primary mr-1" style="font-size: 0.6rem; padding: 0.1rem;"><i class="mx-1 fas fa-id-card"></i> <span style="font-size: 0.9rem; font-weight: 500;">V16069527.03</span></div> <div class="mt-1 badge d-flex align-items-center badge-warning mr-1" style="font-size: 0.6rem; padding: 0.1rem;"><i class="mx-1 fas fa-birthday-cake"></i> <span style="font-size: 0.9rem; font-weight: 500;">5 A</span></div> <div class="mt-1 badge d-flex align-items-center mr-1 text-uppercase badge-primary" style="font-size: 0.6rem; padding: 0.1rem;"><i class="mx-1 fas fa-venus-mars"></i> <span style="font-size: 0.9rem; font-weight: 500;">m</span></div> <div id="badge_walkin_20739" class="d-none mt-1 mr-1 badge font-italic badge-secondary" style="font-size: 0.8rem;"><i class="pc-servicio_walkin  text-secondary"></i>
                </div> <div id="badge_padel_20739" class="d-none mt-1 mr-1 badge font-italic badge-orange text-white" style="font-size: 0.8rem;"><i class="pc-padel"></i> Padel Fest 2024
                </div></div></div></div> <div class="d-flex flex-nowrap align-items-center mb-2 text-center justify-content-around"><button data-toggle="collapse" href="#collapse0" role="button" aria-expanded="false" aria-controls="collapseExample" class="d-xl-none btn btn-default btn-sm collapsed"><i class="pc-signos_vitales1 h3 text-danger"></i></button> <div class="flex-fill px-1"><a id="btn_infoPaciente_20739" data-tippy-content="Datos del Paciente" class="h4 cursor-pointer"><img loading="lazy" src="/image/system/info.svg" class="heartbeat" style="width: 30px; height: 30px;"></a></div> <div class="flex-fill px-1"><div class="btn-group"><a href="#" data-display="static" aria-haspopup="true" data-tippy-content="Datos Administrativos" aria-expanded="false" class="heartbeat" style="width: 30px; height: 30px;"><i class="pc-info_administracion_solid text-purple h3 mb-0"></i></a></div></div> <div class="flex-fill px-1"><div class="btn-group"><a href="#" data-toggle="dropdown" data-display="static" aria-haspopup="true" data-tippy-content="Historia del Paciente" aria-expanded="false" class="d-flex"><img loading="lazy" src="/image/system/icono-new-historia.png" class="heartbeat" style="width: 30px; height: 30px;"> </a> <div class="dropdown-menu dropdown-menu-lg-right"><a data-tippy-content="Historia de Ingreso" class="dropdown-item cursor-pointer"><img loading="lazy" src="/image/system/h_inicial.svg" class="heartbeat" style="width: 30px; height: 30px;"> Historia Inicial
                            </a> <a data-tippy-content="Historias anteriores" class="dropdown-item cursor-pointer"><img loading="lazy" src="/image/system/h_episodios.svg" class="heartbeat" style="width: 30px; height: 30px;"> Episodios anteriores
                                </a></div></div></div> <div class="flex-fill px-1"><a id="btn_evolucion_20739" data-tippy-content="Evoluciones" class="h4 cursor-pointer"><img loading="lazy" src="/image/system/icono-new-evolucion.svg" class="heartbeat" style="width: 30px; height: 30px;"></a></div> <div class="flex-fill px-1"><div data-tippy-content="Pendientes" class="heartbeat d-flex" style="position: relative; cursor: pointer;"><img src="/image/system/todolist.svg" style="height: 35px; width: 33px;"> </div></div> <div class="flex-fill px-1"><div data-tippy-content="Pendientes" class="heartbeat" style="position: relative; cursor: pointer;"><img src="/image/system/ws.png" style="height: 35px; width: 35px;"></div></div></div></div> <div id="collapse0" class="collapseVitalsign p-1 collapse col align-content-center"><div class="d-flex flex-wrap flex-xl-nowrap" style="height: 100%; gap: 4px;"><div class="col-12 p-0 col-xl rounded d-flex flex-xl-column border" value=""><div class="w-custom-1 text-uppercase btn btn-outline-gray border-0">
                        temp
                    </div> <input id="temp_20739" type="text" class="shadow-inset-center w-100 text-center input-full-height border-0"> <div class="p-0 btn btn-outline-gray border-0 font-weight-bold height-100 last-result-box w-last-result-box d-flex align-items-center justify-content-center"><span class="text-success text-nowrap">36.9 °C
                        </span></div></div> <div class="col-12 p-0 col-xl rounded d-flex flex-xl-column border" value=""><div class="w-custom-1 text-uppercase btn btn-outline-gray border-0">
                        fr
                    </div> <input id="fr_20739" type="text" class="shadow-inset-center w-100 text-center input-full-height border-0"> <div class="p-0 btn btn-outline-gray border-0 font-weight-bold height-100 last-result-box w-last-result-box d-flex align-items-center justify-content-center"><span class="text-nowrap">nc resp/min
                        </span></div></div> <div class="col-12 p-0 col-xl rounded d-flex flex-xl-column border" value=""><div class="w-custom-1 text-uppercase btn btn-outline-gray border-0">
                        fc
                    </div> <input id="fc_20739" type="text" class="shadow-inset-center w-100 text-center input-full-height border-0"> <div class="p-0 btn btn-outline-gray border-0 font-weight-bold height-100 last-result-box w-last-result-box d-flex align-items-center justify-content-center"><span class="text-danger text-nowrap">140 lat/min
                        </span></div></div> <div class="col-12 p-0 col-xl-2 rounded d-flex flex-xl-column border"><div class="w-custom-1 text-uppercase btn btn-outline-gray border-0">
                        ta
                    </div> <div class="w-100 flex-lg-fill d-flex flex-column"><input id="tasis_20739" type="text" placeholder="Sis" class="shadow-inset-center w-100 text-center input-full-height border-0"> <hr class="border-top m-0"> <input id="tadia_20739" type="text" placeholder="Dia" class="shadow-inset-center w-100 text-center input-full-height border-0"> <div class="flex-fill flex-column d-flex justify-content-center align-items-center text-secondary bg-light px-1"><div>

                            </div> <div class="mt-auto" style="font-size: 0.7rem;">
                                Media
                            </div></div></div> <div class="p-0 btn btn-outline-gray border-0 font-weight-bold height-100 last-result-box w-last-result-box d-flex align-items-center justify-content-center"><span class="text-success text-nowrap">112/61 mmHg
                        </span></div></div> <div class="col-12 p-0 col-xl rounded d-flex flex-xl-column border" value=""><div class="w-custom-1 text-uppercase btn btn-outline-gray border-0">
                        oxi
                    </div> <input id="oxi_20739" type="text" class="shadow-inset-center w-100 text-center input-full-height border-0"> <div class="p-0 btn btn-outline-gray border-0 font-weight-bold height-100 last-result-box w-last-result-box d-flex align-items-center justify-content-center"><span class="text-success text-nowrap">96 %
                        </span></div></div> <div class="col-12 p-0 col-xl-2 rounded d-flex flex-xl-column border"><div class="w-custom-1 text-uppercase btn btn-outline-gray border-0">
                        gl
                    </div> <div class="w-100 flex-lg-fill d-flex flex-column"><input id="gl_20739" type="text" placeholder="mg/dL" class="shadow-inset-center w-100 text-center input-full-height border-0"> <hr class="border-top m-0"> <input id="insulina_20739" type="text" placeholder="Insulina" class="shadow-inset-center w-100 text-center input-full-height border-0"></div> <div class="p-0 btn btn-outline-gray border-0 font-weight-bold height-100 last-result-box w-last-result-box d-flex align-items-center"></div></div> <div class="col-12 p-0 col-xl rounded d-flex flex-column border"><div class="d-flex justify-content-between"><div class="w-custom-1 text-uppercase btn btn-outline-gray border-0">
                            Síntomas
                        </div> <div class="dropdown"><button type="button" data-toggle="dropdown" aria-expanded="false" class="btn btn-default dropdown-toggle"><i class="fas fa-bars"></i></button> <div class="dropdown-menu py-0"><input placeholder="Escribe un sintoma" type="text" class="form-control rounded-0 border-0 bg-light"> <div class="overflow-auto" style="max-height: 200px;"><a href="#" class="dropdown-item">
                                        Adenopatias
                                    </a><a href="#" class="dropdown-item">
                                        Anosmia
                                    </a><a href="#" class="dropdown-item">
                                        Artralgias
                                    </a><a href="#" class="dropdown-item">
                                        Cefalea
                                    </a><a href="#" class="dropdown-item">
                                        Diaforesis
                                    </a><a href="#" class="dropdown-item">
                                        Diarrea
                                    </a><a href="#" class="dropdown-item">
                                        Disfagia
                                    </a><a href="#" class="dropdown-item">
                                        Disfonia
                                    </a><a href="#" class="dropdown-item">
                                        Dolor cervical
                                    </a><a href="#" class="dropdown-item">
                                        Dolor lumbar
                                    </a><a href="#" class="dropdown-item">
                                        Eritema
                                    </a><a href="#" class="dropdown-item">
                                        Epistaxis
                                    </a><a href="#" class="dropdown-item">
                                        Disgeusia
                                    </a><a href="#" class="dropdown-item">
                                        Palidez
                                    </a><a href="#" class="dropdown-item">
                                        Vómitos
                                    </a><a href="#" class="dropdown-item">
                                        Disnea
                                    </a><a href="#" class="dropdown-item">
                                        Dolor abdominal
                                    </a><a href="#" class="dropdown-item">
                                        Dolor torácico
                                    </a><a href="#" class="dropdown-item">
                                        Edema MI
                                    </a><a href="#" class="dropdown-item">
                                        Fatiga
                                    </a><a href="#" class="dropdown-item">
                                        Fiebre
                                    </a><a href="#" class="dropdown-item">
                                        Hemoptisis
                                    </a><a href="#" class="dropdown-item">
                                        Hipo
                                    </a><a href="#" class="dropdown-item">
                                        Mialgias
                                    </a><a href="#" class="dropdown-item">
                                        Náuseas
                                    </a><a href="#" class="dropdown-item">
                                        Odinofagia
                                    </a><a href="#" class="dropdown-item">
                                        Rinorrea
                                    </a><a href="#" class="dropdown-item">
                                        Tos Productiva
                                    </a><a href="#" class="dropdown-item">
                                        Tos seca
                                    </a><a href="#" class="dropdown-item">
                                        Otros
                                    </a></div></div></div></div> <div class="d-flex flex-fill bg-white flex-wrap align-items-center p-1 rounded my-1" style="overflow: auto; max-height: 108px;"></div></div> <div class="col-12 col-sm col-xl p-0 rounded d-flex justify-content-between flex-column"><input id="created_at_20739" type="date" class="form-control text-center input-full-height"> <input id="time_20739" type="time" class="form-control mt-1 text-center input-full-height"> <button id="submit_20739" class="btn btn-outline-success mt-1 w-100 btn-sm">
                            Guardar todo
                        </button> <a href="/user/informe/signos_vitales/30679" target="_blank" class="btn btn-outline-primary mt-1 w-100 btn-sm">
                            Imprimir Signos Vitales
                        </a></div></div></div></div></div></div></div></div>
        -->



    </div>

</template>
<script>

    import { get, is_empty, obtenerVariablesGET, is_null,is_undefined } from '../../helpers/customHelpers';
    import BtnTotales from './components/BtnTotales/BtnTotales.vue';
    import Loading from './components/Loading.vue';
    import MenuAreas from './components/MenuAreas/MenuAreas.vue';
    import NavbarNotifications from './components/NavbarNotifications/NavbarNotifications.vue';
    import UserNavBar from './components/UserNavBar/UserNavBar.vue';
    import ListSeguimientoPacientes from './components/ViewSeguimientoMedico/ListSeguimientoPacientes.vue';

    /* import Modal1 from './components/ViewSeguimientoMedico/Modals/Modal1.vue';
    import Modal2 from './components/ViewSeguimientoMedico/Modals/Modal2.vue';
    import Modal3 from './components/ViewSeguimientoMedico/Modals/Modal3.vue'; */



    export default{
        name:"SeguimientoMedico",
        data() {
            return {

            }
        },
        components: {
            Loading,
            MenuAreas,
            UserNavBar,
            BtnTotales,
            NavbarNotifications,
            ListSeguimientoPacientes,

            /* Modal1,
            Modal2,
            Modal3, */
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
                            fieldName:'cat_ubicaciones',
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
            /* async getPacientesActivos(){
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
            }, */
        },
        /* async created(){
            this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:false,
                    });
        }, */
        async created () {
             //CARGAR Ubicaciones de areas
             await this.getCatUbicaciones();
        },
        async mounted(){


            /* await this.getEquipoMedico()

            await this.getPacientesActivos()
            this.$store.commit('updateProperty', {
                fieldName:'ruta',
                fieldValue:obtenerVariablesGET( location.href ).route,
            }); */
            //this.activarTooltips()
        },
        updated(){
            //this.ruta = obtenerVariablesGET( location.href ).route

            //this.initTooltips()
        }



    }

</script>
<style>
    .fade-in{-webkit-animation:fade-in 1.2s cubic-bezier(.39,.575,.565,1.000) both;animation:fade-in 1.2s cubic-bezier(.39,.575,.565,1.000) both}
    @-webkit-keyframes fade-in{0%{opacity:0}100%{opacity:1}}@keyframes fade-in{0%{opacity:0}100%{opacity:1}}
    /* li.menuArea a {
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
            font-size: 1.5rem;
            text-wrap: nowrap;
            overflow: hidden;
            width: auto;
            border: 1px solid red;
        }
    } */

   /*  .bg-light>a.navbar-brand {
        color: var(--primary) !important;
    }
    .shadow-inset-sm{
        box-shadow: 1px 1px 25px -16px rgba(0,0,0,1) inset;
        -webkit-box-shadow: 1px 1px 25px -16px rgba(0,0,0,1) inset;
        -moz-box-shadow: 1px 1px 25px -16px rgba(0,0,0,1) inset;
    } */

    /***********/
    /* .rounded-pill-custom-1{
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
    } */
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
    /* .content-box{
        transition: width 0.5s,opacity 0.5s;
        border-radius: 1rem;
        overflow: auto;
        height: 81vh;
    } */
    /* .content-box th{
        text-align:center;
        color: var(--primary);
        top:0px;
        position:sticky !important;
        background-color:whitesmoke;
        z-index: 2;
    }*/





    /*Estilos para el menu principal*/
    /* .sticky{
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
    } */
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



    }
</style>
