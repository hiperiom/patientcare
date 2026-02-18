<template>
    <div class="container-fluid d-flex text-white align-items-center justify-content-between overflow-auto">
        <div class="flex-fill cursor-pointer px-2">
            <i class="pc-fa-patientcare-logo h3 mb-0"></i>
        </div>

        <div 
            @click="getPacientesActivos()" 
            data-toggle="modal" 
            data-target="#modelId" 
            class="miModal-options d-flex align-items-center justify-content-center  cursor-pointer flex-fill text-uppercase p-2 shadow-1" 
            style="font-size: 3rem; line-height: 1;"
        >
            <span :class="['ml-3']">
                {{uti.find(x=>x.uti ===$route.query.uti)?.name}}
            </span>

            <div id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" class="modal fade">
                <div role="document" class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white d-flex">
                            <h4 class="modal-title flex-grow-1 text-center text-white font-weight-bold mb-0">
                                Pulsa en un área
                            </h4>
                            <button type="button" data-dismiss="modal" aria-label="Close"
                                class="border-0 text-secondary h4 text-white mb-0 bg-transparent"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body d-flex flex-column container-fluid">
                            <a
                                href="/areaUti/pantalla_uti?uti=a"
                                class="card-piso d-flex align-items-center  justify-content-between btn">
                                
                                <h3 class=" text-primary">
                                    UTI ADULTO
                                </h3>
                                <div class="badge badge-primary">{{ pacientes_activos.filter(x=>Number(x["parent_cat_user_ubicacion_id"]) === 182).length}}</div>
                            </a>
                            <a
                                href="/areaUti/pantalla_uti?uti=p"
                                class="card-piso d-flex align-items-center  justify-content-between btn">
                                
                                <h3 class=" text-primary">
                                    UTI PEDIÁTRICO
                                </h3>
                                <div class="badge badge-primary">{{ pacientes_activos.filter(x=>Number(x["parent_cat_user_ubicacion_id"]) === 211).length}}</div>
                            </a>
                            <a
                                href="/areaUti/pantalla_uti?uti=n"
                                class="card-piso d-flex align-items-center  justify-content-between btn">
                                
                                <h3 class=" text-primary">
                                    UTI NEONATAL
                                </h3>
                                <div class="badge badge-primary">{{ pacientes_activos.filter(x=>Number(x["cat_user_ubicacion_id"]) === 391).length}}</div>
                            </a>
                            
                    
                        
                            <a
                                href="/finalizarSesion"
                                class="d-flex align-items-center text-info btn btn-default w-100">
                                Salir
                            </a>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="shadow-1">
            <div style="font-size: 3rem; line-height: 1;" class="glassmod-effect  p-2 rounded-custom-1 d-flex m-1 justify-content-between align-items-center "
                >

                <b id="total_cirugias" :class="{'mr-3':total_habitaciones}">
                   {{ total_habitaciones_ocupadas }}<span v-if="total_habitaciones">/</span>{{ total_habitaciones }} 
                </b>
                <span v-if="!total_habitaciones" style="font-size: 1rem;margin-bottom:1rem;margin-left:0.3rem">PAC</span>
            </div>
        </div>

        <div class=" shadow-1">
            <div class="glassmod-effect p-2 rounded-custom-1 d-flex m-1 justify-content-between align-items-center "
                style="font-size: 3rem; line-height: 1;">
                <div class="d-flex align-items-center">

                <div id="clock" class="d-flex align-items-center" style="font-size: 45px;">
                    <div class="dia mr-1">{{$store.state.relog_dia}}</div>
                    <div class="mx-1">|</div>
                    <div class="mr-1 mes text-uppercase">{{$store.state.relog_mes}}</div>
                </div>
                <div class="d-flex flex-column align-items-start">
                    <div class="anio" style="font-size: 2rem;line-height:1;">{{$store.state.relog_anio}}</div>
                    <div class="hora text-nowrap" style="font-size: 1.1rem;line-height: 1;">{{relog_hora}}</div>
                </div>
                </div>
                <div id="fechaHoy" class="d-flex"></div>
            </div>
        </div>

        <div class="ml-4 d-flex align-items-center justify-content-end text-right">
            <img src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT"
                class=" img-logo mr-1" style="height: auto; width: 150px;">
        </div>
       
    </div>
</template>

<script>
    import { get, is_null,horaPm,meses ,fechaHoy,mesesEnEspanol,formatAMPM,obtenerVariablesGET} from '../../../../helpers/customHelpers?00001';
    export default {
        name:"CintilloSuperior",
        props:[
            "total_habitaciones",
            "total_habitaciones_ocupadas",
            "relog_hora",
            "uti",
        ],
        data(){
            return {
                pacientes_activos:[],
                
            }
        },
        methods:{
            async getPacientesActivos() {
                try {
                    this.$store.commit('updateProperty', {
                        fieldName: 'loading',
                        fieldValue: true,
                    });
                    this.pacientes_activos = await get(location.origin + "/episodio/pacientes_activos/uti");
         
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
            getFechaActual(){
                let fecha = fechaHoy();
                    localStorage.setItem('fecha_reporte_pantalla_piso',fecha)
                let fechaSplit = fecha.split("-")
                this.$store.commit('updateProperty', {
                    fieldName: 'relog_dia',
                    fieldValue: fechaSplit[2].padStart(2, '0'),
                });
                this.$store.commit('updateProperty', {
                    fieldName: 'relog_mes',
                    fieldValue: mesesEnEspanol[Number(fechaSplit[1])-1].slice(0,3),
                });
                this.$store.commit('updateProperty', {
                    fieldName: 'relog_anio',
                    fieldValue: fechaSplit[0],
                });
            },
        },
        mounted () {
            let that = this
                that.getFechaActual()
                setInterval(() => {
                    that.getFechaActual()
                }, 60000);
        },
    }
</script>

<style lang="scss" scoped>
    .btn-info-ala {
        color: #ffffff;
        background-color: var(--info);
        border-color: var(--info);
        box-shadow: none;
    }
    .btn-warning-ala {
        color: #ffffff;
        background-color: #ffc107;
        border-color: #ffc107;
        box-shadow: none;
    }
    .badge-warning-ala {
        color: #ffffff;
        background-color: #ffc107;
    }
</style>
