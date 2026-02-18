<template>
    <nav class="row bg-light rounded border-0 mx-1 mb-1">

        <div class="col-12 col-sm-12 col-md-5 col-lg-8 col-xl-8 d-flex justify-content-md-end overflow-auto order-2 order-lg-2 p-1">
            <div id="btnNotificaciones" class="d-flex justify-content-end">
                <button v-if="getArea() == 'tp'" type="button" class="text-uppercase d-flex flex-nowrap align-items-center text-primary font-weight-bold btn btn-gray mr-1">
                    <span class="mr-1 d-flex align-items-center"><i class="pc-paciente text-info mr-1"></i> <span class="d-none d-md-block">TP</span></span>
                    <span class="badge badge-light text-primary" style="font-size: 1rem;font-weight: 600;">{{getTotalPacientes()}}</span>
                </button>
                <button v-if="!['tp'].includes( getArea() )" type="button" class="text-uppercase d-flex flex-nowrap align-items-center text-primary font-weight-bold btn btn-gray mr-1">
                    <span class="mr-1 d-flex align-items-center"><i class="pc-paciente text-info mr-1"></i> <span class="d-none d-md-block">Total Pacientes</span></span>
                    <span class="badge badge-light text-primary" style="font-size: 1rem;font-weight: 600;">{{getTotalPacientes()}}{{getTotalPacienteArea()}}</span>
                </button>
                <button v-if="getArea() == 'tp'" type="button" class="text-uppercase d-flex flex-nowrap align-items-center text-primary font-weight-bold btn btn-gray mr-1">
                    <span class="mr-1 d-flex align-items-center"><i class="pc-emergencia text-info mr-1"></i> <span class="d-none d-md-block">EMER</span></span>
                    <span class="badge badge-light text-primary" style="font-size: 1rem;font-weight: 600;">{{getTotalEmergencia()}}</span>
                </button>
                <!--<button type="button" class="text-uppercase d-flex flex-nowrap align-items-center text-primary font-weight-bold btn btn-gray mr-1">
                    <span class="mr-1"><i class="pc-cirugia-light text-info mr-1"></i> <span class="d-none d-md-block">QX</span></span>
                    <span class="badge badge-light text-primary" style="font-size: 1rem;font-weight: 600;">0</span>
                </button>-->
                <button v-if="getArea() == 'tp'" type="button" class="text-uppercase d-flex flex-nowrap align-items-center text-primary font-weight-bold btn btn-gray mr-1">
                    <span class="mr-1 d-flex align-items-center"><i class="pc-light-pisos  text-info mr-1"></i> <span class="d-none d-md-block">HOSP</span></span>
                    <span class="badge badge-light text-primary" style="font-size: 1rem;font-weight: 600;">{{getTotalHospitalizacion()}}</span>
                </button>
                <button v-if="getArea() == 'tp'" type="button" class="text-uppercase d-flex flex-nowrap align-items-center text-primary font-weight-bold btn btn-gray mr-1">
                    <span class="mr-1 d-flex align-items-center"><i class="pc-uti-light text-info mr-1"></i> <span class="d-none d-md-block">UTI</span></span>
                    <span class="badge badge-light text-primary" style="font-size: 1rem;font-weight: 600;">{{getTotalUti()}}</span>
                </button>
                <button v-if="getArea() == 'tp'" type="button" class="text-uppercase d-flex flex-nowrap align-items-center text-primary font-weight-bold btn btn-gray mr-1">
                    <span class="mr-1 d-flex align-items-center"><i class="pc-light-homecare text-info mr-1"></i> <span class="d-none d-md-block">PAD</span></span>
                    <span class="badge badge-light text-primary" style="font-size: 1rem;font-weight: 600;">{{getTotalPad()}}</span>
                </button>
            </div>
        </div>
        <div class="col-7 col-sm-8 col-md-4 col-lg-4 col-xl-4 p-1 order-2 d-flex">

            <input type="search" class="form-control" id="busquedapaciente" placeholder="Buscar paciente..." aria-label="Buscar paciente..." aria-describedby="button-addon2">
        </div>
    </nav>
</template>

<script>
    export default {
        name:"BtnTotales",
        props:{
            patient_data:Object,
            index:Number,
        },

        data() {
            return {
                hospitalizacion_parent_id:[42,235,236,99,71,234,127,155],
                emergencia_parent_id:[2,3,270,28,29,32,392],
                uti_parent_id:[182,211],
                pad_parent_id:[229,228,373,374,382],
                //loading:document.getElementById('loadingScreen'),
            }
        },
        computed: {


        },
        methods: {
            getArea(){
                return localStorage.getItem("area")
            },
            getTotalPacientes(){
                let area = this.getArea()
                    if(['tp'].includes(area) ){
                        return this.getTotalHospitalizacion() + this.getTotalEmergencia() + this.getTotalUti() + this.getTotalPad()
                    }
                    if(['ea'].includes(area) ){
                        return  this.$store.state.pacientes_datos.filter(x=>
                            [4,5,405].includes( Number(x.cat_user_ubicacion_id) ) ||
                            [270].includes( Number(x.parent_cat_user_ubicacion_id) )
                        ).length
                    }
                    if(['ep'].includes(area) ){
                        return  this.$store.state.pacientes_datos.filter(x=>
                            [30,31,406].includes( Number(x.cat_user_ubicacion_id) ) ||
                            [32].includes( Number(x.parent_cat_user_ubicacion_id) )
                        ).length
                    }
                    if(['hcep'].includes(area) ){
                        return  this.$store.state.pacientes_datos.filter(x=>
                            [390].includes( Number(x.parent_cat_user_ubicacion_id) )
                        ).length
                    }
                    if(['hp2'].includes(area) ){
                        return  this.$store.state.pacientes_datos.filter(x=>
                            [42].includes( Number(x.parent_cat_user_ubicacion_id) )
                        ).length
                    }
                    if(['hp3'].includes(area) ){
                        return  this.$store.state.pacientes_datos.filter(x=>
                            [71,235].includes( Number(x.parent_cat_user_ubicacion_id) )
                        ).length
                    }
                    if(['hp4'].includes(area) ){
                        return  this.$store.state.pacientes_datos.filter(x=>
                            [42].includes( Number(x.parent_cat_user_ubicacion_id) )
                        ).length
                    }
                    if(['hp5'].includes(area) ){
                        return  this.$store.state.pacientes_datos.filter(x=>
                            [127,234].includes( Number(x.parent_cat_user_ubicacion_id) )
                        ).length
                    }
                    if(['hp6'].includes(area) ){
                        return  this.$store.state.pacientes_datos.filter(x=>
                            [155].includes( Number(x.parent_cat_user_ubicacion_id) )
                        ).length
                    }
                    if(['utia'].includes(area) ){
                        return  this.$store.state.pacientes_datos.filter(x=>
                            [182].includes( Number(x.parent_cat_user_ubicacion_id) )
                        ).length
                    }
                    if(['utip'].includes(area) ){
                        return  this.$store.state.pacientes_datos.filter(x=>
                            [211].includes( Number(x.parent_cat_user_ubicacion_id) )
                        ).length
                    }
                    if(['pad_emergencia_adulto'].includes(area) ){
                        return  this.$store.state.pacientes_datos.filter(x=>
                            [229].includes( Number(x.cat_user_ubicacion_id) )
                        ).length
                    }
                    if(['pad_emergencia_pediatrica'].includes(area) ){
                        return  this.$store.state.pacientes_datos.filter(x=>
                            [228].includes( Number(x.cat_user_ubicacion_id) )
                        ).length
                    }
                    if(['pad_postquirurgico_amb'].includes(area) ){
                        return  this.$store.state.pacientes_datos.filter(x=>
                            [373].includes( Number(x.cat_user_ubicacion_id) )
                        ).length
                    }
                    if(['pad_postquirurgico_hosp'].includes(area) ){
                        return  this.$store.state.pacientes_datos.filter(x=>
                            [374].includes( Number(x.cat_user_ubicacion_id) )
                        ).length
                    }
                    if(['pad_medico'].includes(area) ){
                        return  this.$store.state.pacientes_datos.filter(x=>
                            [382].includes( Number(x.cat_user_ubicacion_id) )
                        ).length
                    }
            },
            getTotalPacienteArea(){
                let a = this.getArea()

                let area = {
                    'ea':17,
                    'ep':8,
                    'hp2':26,
                    'hp3':26,
                    'hp4':32,
                    'hp5':35,
                    'hp6':35,
                    'utia':10,
                    'utip':8,

                }
                let exclude = [
                        'hcep',
                        'utin',
                        'aq',
                        'pad_emergencia_adulto',
                        'pad_emergencia_pediatrica',
                        'pad_postquirurgico_amb',
                        'pad_postquirurgico_hosp',
                        'pad_medico'
                    ]
                    return !exclude.includes( a ) ? '/'+area[ a ] : ''
            },
            getTotalHospitalizacion(){
                return this.$store.state.pacientes_datos.filter(x=>this.hospitalizacion_parent_id.includes( Number(x.parent_cat_user_ubicacion_id) ) ).length
            },
            getTotalEmergencia(){
                return this.$store.state.pacientes_datos.filter(x=>this.emergencia_parent_id.includes( Number(x.parent_cat_user_ubicacion_id) ) ).length
            },
            getTotalPad(){
                return this.$store.state.pacientes_datos.filter(x=>this.pad_parent_id.includes( Number(x.cat_user_ubicacion_id) ) ).length
            },
            getTotalUti(){
                return this.$store.state.pacientes_datos.filter(x=>
                    this.uti_parent_id.includes( Number(x.parent_cat_user_ubicacion_id) ) ||
                    [391].includes( Number(x.cat_user_ubicacion_id) )
                ).length
            }
        },
        async mounted () {

        },
    }
</script>

<style lang="scss" scoped>

</style>
