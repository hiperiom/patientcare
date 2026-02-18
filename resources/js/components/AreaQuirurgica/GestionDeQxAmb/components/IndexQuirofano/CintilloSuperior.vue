<template>
    <div ref="cintillo_superior" :class="['container-fluid px-0 mb-1 ',getMaximize]">
        <div class="col-12 col-md-4 mx-auto">
            <date-picker

                style="text-align: center !important;"
                v-model="rango"
                placeholder="Pulse aquí para buscar por rango de fechas"
                range
                :language="'spanish'"
                @change="fetchData"
            >
            </date-picker>

        </div>
        <div class="d-flex justify-content-end mt-1">
            <!-- ,'d-block':getMaximize -->
            <div class="col-4 px-0">
                <div class="card py-1 px-2  p-md-3 m-1" style="border-radius:1.25rem;">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-primary">
                        <div class="card-title text-center text-md-left">
                            Total IQX<br>
                            Programadas
                        </div>
                        <b class="card-title-total">
                            <div class="ml-2 d-flex justify-content-center">
                                <div class="d-flex px-2 flex-column align-items-center">
                                    <small style="font-size: 14px;" title="Ejecutadas">EJEC</small>
                                    <div style="line-height: 1;">{{$store.state.listadoSolicitudesQx.map(x=>x['dias']).flat().filter(x=>x.h_fin !== null).length}}</div>
                                </div>
                                <div class="mx-1 text-center"><b class=" border-left border-white"></b></div>
                                <div  class="d-flex px-2 flex-column align-items-center">
                                    <small  style="font-size: 14px;" title="Programadas">PROG</small>
                                    <div  style="line-height: 1;">{{$store.state.listadoSolicitudesQx.map(x=>x['dias']).flat().length}}</div>
                                </div>
                            </div>
                        </b>
                    </div>
                </div>
            </div>
            <div class="col-4 px-0">
                <div class="card py-1 px-2  p-md-3 m-1" style="border-radius:1.25rem;">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-primary">
                        <div class="card-title text-center text-md-left">
                            Total IQX<br>
                            Oftalmológicas
                        </div>
                        <b class="card-title-total">
                            <div class="ml-2 d-flex justify-content-center">
                                <div class="d-flex px-2 flex-column align-items-center">
                                    <small style="font-size: 14px;" title="Ejecutadas">EJEC</small>
                                    <div style="line-height: 1;">{{$store.state.listadoSolicitudesQx.map(x=>x['dias']).flat().filter(x=>x.h_fin !== null && [424].includes( Number( x['area_intervencion'] ) ) ).length}}</div>
                                </div>
                                <div class="mx-1 text-center"><b class=" border-left border-white"></b></div>
                                <div  class="d-flex px-2 flex-column align-items-center">
                                    <small  style="font-size: 14px;" title="Programadas">PROG</small>
                                    <div  style="line-height: 1;">{{$store.state.listadoSolicitudesQx.map(x=>x['dias']).flat().filter(x=> [424].includes( Number( x['area_intervencion'] ) ) ).length}}</div>
                                </div>
                            </div>

                        </b>
                    </div>
                </div>
            </div>
            <div class="col-4 px-0">
                <div class="card py-1 px-2  p-md-3 m-1" style="border-radius:1.25rem;">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-primary">
                        <div class="card-title text-center text-md-left">
                            Total IQX<br>
                            Especialidades
                        </div> <!--418,420,421,425-->
                        <b class="card-title-total">
                            <div class="ml-2 d-flex justify-content-center">
                                <div class="d-flex px-2 flex-column align-items-center">
                                    <small style="font-size: 14px;" title="Ejecutadas">EJEC</small>
                                    <div style="line-height: 1;">{{$store.state.listadoSolicitudesQx.map(x=>x['dias']).flat().filter(x=>x.h_fin !== null && [425].includes( Number( x['area_intervencion'] ) ) ).length}}</div>
                                </div>
                                <div class="mx-1 text-center"><b class=" border-left border-white"></b></div>
                                <div  class="d-flex px-2 flex-column align-items-center">
                                    <small  style="font-size: 14px;" title="Programadas">PROG</small>
                                    <div  style="line-height: 1;">{{$store.state.listadoSolicitudesQx.map(x=>x['dias']).flat().filter(x=> [425].includes( Number( x['area_intervencion'] ) ) ).length}}</div>
                                </div>
                            </div>
                        </b>
                    </div>
                </div>
            </div>


        </div>

    </div>
</template>

<script>
import { fechaAMD, fechaAMD2,get ,mesesEnEspanol} from "../../../../../helpers/customHelpers.js";
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    export default {
        components: { DatePicker },
        props: {
            FnGetSolicitudesQx: {
                type: Function,
            },
        },
        data() {
            const hoy = new Date();
            const unaSemanaDespues = new Date();
            unaSemanaDespues.setDate(hoy.getDate() + 60);
            return {

                rango: {
                    start: hoy, // Fecha de inicio
                    end: hoy.getFullYear()+"-12-31" // Fecha de fin
                }

            };
        },
        computed:{
            /* getfecha(){
                if (cadena === "desde") {
                    return mesesEnEspanol[this.]
                }
            }, */

            getMaximize(){
                return this.$store.state.maximize ==="true" ? 'fade-in-top ' : 'fade-out-top '
            }
        },
        methods: {
            /* getfecha(cadena){
                if (cadena === "desde") {
                    return mesesEnEspanol[this.rango.start.getDate() ].slice(0,3)
                }
            }, */
            async getSolicitudesQx(){
                try {
                    this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:true,
                    });
                    let model
                    let [ startDate, endDate] = this.$store.state.rango
                    if(this.$route.path=="/areaQuirofanoAmb/index_quirofano"){
                        model =  await get(location.origin + `/areaQuirofanoAmb/cupo/getAllInterno?startDate=${fechaAMD2(startDate)}&endDate=${fechaAMD2(endDate)}&area_intervencion=mapm` )
                    }else{
                        model =  await get(location.origin + `/areaQuirofanoAmb/cupo/getAllFinalizadas?startDate=${fechaAMD2(startDate)}&endDate=${fechaAMD2(endDate)}&area_intervencion=mapm` )
                    }
                    if(model.length === 0){
                        this.listadoSolicitudesEstaVacio =true
                    }else{
                        this.listadoSolicitudesEstaVacio =false
                    }

                    let solicitudesPorDia = []
                        //obtenemos las fechas unicas
                    let fechas_unicas = Array.from( new Set(model.map(item=>{
                            let h_inicio = item['h_inicio'].split(" ")
                            return h_inicio[0]
                        }) ) )
                        //eliminamos los valores null
                        .filter(item=>item !== null)

                        //convertimos las fechas a milisegunsos para luego poderlas ordenar
                        fechas_unicas = fechas_unicas.map(item=>{
                            let fecha = new Date(item)
                            return {"milisegundos":fecha.getTime(),"original":item}
                        })
                        //las ordenamos
                        if(this.$route.path=="/areaQuirofanoAmb/index_quirofano"){
                            fechas_unicas = fechas_unicas.sort((a, b) => a.milisegundos - b.milisegundos)
                        }else{
                            fechas_unicas = fechas_unicas.sort((a, b) => b.milisegundos - a.milisegundos)
                        }

                        //console.log("--->",fechas_unicas)
                        //la volvemos a convertir a formato fecha
                       /*  fechas_unicas = fechas_unicas.map(item=>{
                            return item //fechaAMD( item )
                        }) */



                        fechas_unicas.forEach(item=>{
                            solicitudesPorDia.push({
                                fecha:item.original,
                                dias:model.filter(item2=>{
                                    let h_inicio = item2['h_inicio'].split(" ")
                                        if(h_inicio[0] === item.original){
                                            return item2
                                        }

                                })
                                //.sort((a, b) => Date.parse(b.h_inicio) - Date.parse(a.h_inicio)),
                            })
                        })
                        //console.log("solicitudesPorDia",solicitudesPorDia)
                        //console.log(solicitudesPorDia)
                        this.$store.commit('updateListadoSolicitudesQx',solicitudesPorDia)

                        this.$store.commit('updateProperty', {
                            fieldName:'loading',
                            fieldValue:false,
                        });
                } catch (error) {
                    this.$store.commit('updateProperty', {
                        fieldName:'loading',
                        fieldValue:false,
                    });
                    console.error('Error al obtener los datos:', error);
                    return []
                }
            },
            async fetchData() {
                let [start, end] = this.rango
                let rango = [start, end];
                this.$store.commit('updateProperty', {
                    fieldName:'rango',
                    fieldValue:rango,
                });
                this.$store.commit('updateProperty', {
                    fieldName:'fechadesde',
                    fieldValue:  start,
                });
                this.$store.commit('updateProperty', {
                    fieldName:'fechahasta',
                    fieldValue:end,
                });
                await this.getSolicitudesQx()
            },

        },
        async mounted () {
                this.$store.commit('updateProperty', {
                    fieldName:'fechadesde',
                    fieldValue:  this.rango.start,
                });
                this.$store.commit('updateProperty', {
                    fieldName:'fechahasta',
                    fieldValue:this.rango.end,
                });
           /*  const startDate = new Date();
            const endDate = new Date(new Date().setDate(startDate.getDate() + 1));

            this.rango.start = startDate
            this.rango.end = "1999-01-01" */

            //await this.getSolicitudesQx()
            console.log(this.rango);
        },
    }
</script>

<style  scoped>

.mx-datepicker-range {
    width: 100%;
}
    .fade-in-top {
        -webkit-animation: fade-in-top 0.6s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
        animation: fade-in-top 0.6s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
    }
    @-webkit-keyframes fade-in-top {
        0% {
            -webkit-transform: translateY(-50px);
            transform: translateY(-50px);
             opacity: 0;
            display: none;
        }
        100% {
            -webkit-transform: translateY(0);
            transform: translateY(0);
            opacity: 1;
            display: block;
        }
    }
    @keyframes fade-in-top {
        0% {
            -webkit-transform: translateY(-50px);
            transform: translateY(-50px);
            opacity: 0;
            display: none;
        }
        100% {
            -webkit-transform: translateY(0);
            transform: translateY(0);
            opacity: 1;
            display: block;
        }
    }
    .fade-out-top {
        -webkit-animation: fade-out-top 0.7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
                animation: fade-out-top 0.7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
    }
    @-webkit-keyframes fade-out-top {
        0% {
            -webkit-transform: translateY(0);
                    transform: translateY(0);
                     opacity: 1;
             display: block;
        }
        100% {
            -webkit-transform: translateY(-50px);
                    transform: translateY(-50px);
                    opacity: 0;
            display: none;
        }
    }
    @keyframes fade-out-top {
        0% {
            -webkit-transform: translateY(0);
                    transform: translateY(0);
                     opacity: 1;
             display: block;
        }
        100% {
            -webkit-transform: translateY(-50px);
                    transform: translateY(-50px);
                    opacity: 0;
            display: none;
        }
    }





    .fade-in-bottom {
        -webkit-animation: fade-in-bottom 0.6s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
                animation: fade-in-bottom 0.6s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
    }

    @-webkit-keyframes fade-in-bottom {
        0% {
            -webkit-transform: translateY(50px);
                    transform: translateY(50px);
            opacity: 0;
        }
        100% {
            -webkit-transform: translateY(0);
                    transform: translateY(0);
            opacity: 1;
        }
    }
    @keyframes fade-in-bottom {
        0% {
            -webkit-transform: translateY(50px);
                    transform: translateY(50px);
            opacity: 0;
        }
        100% {
            -webkit-transform: translateY(0);
                    transform: translateY(0);
            opacity: 1;
        }
    }

    .card-title{
        font-size: 1rem;
        line-height: 1;
    }
    .card-title-total{
        font-size: 3rem;
        line-height: 1;
    }
    /*// Small devices (landscape phones, 576px and up)*/
    @media (min-width: 576px) {

    }

    /*// Medium devices (tablets, 768px and up)*/
    @media (min-width: 768px) {
        .card-title{
            font-size: 1.5rem;
        }
    }

    /*// Large devices (desktops, 992px and up)*/
    @media (min-width: 992px) {

    }

    /*// Extra large devices (large desktops, 1200px and up)*/
    @media (min-width: 1200px) {

    }
</style>
