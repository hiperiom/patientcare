<template>
    <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 p-1 orden-1 overflow-auto" id="cat_user_ubicacion_menu">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li
                v-for="(item,index) in getItems"
                :key="'area_option_'+index"
                class="nav-item"
                :title="item.description"
                role="presentation"
            >
                <a
                    @click="handleAreaOption(item.siglas)"
                    :class="['font-weight-bold text-uppercase nav-link',{'active':item.siglas===areaSiglas}]"
                    :href="'#pills-'+item.siglas"
                    role="tab"
                    :aria-controls="'pills-'+item.siglas"
                    aria-selected="false"
                >
                    {{item.siglas}}
                </a>
            </li>
            <li
                class="nav-item"
                title="Pad"
                role="presentation"
            >
                <a
                    @click="handleMenuPad"
                    :class="['font-weight-bold text-uppercase nav-link',{'active':['pad','alta','traslado','contraopinion','fallecido','otro','pad','pad_emergencia_adulto','pad_emergencia_pediatrica','pad_postquirurgico_amb','pad_postquirurgico_hosp','pad_medico'].includes(areaSiglas)}]"

                    href="#pills-pad"
                    role="tab"
                    aria-controls="pills-pad"
                    aria-selected="false"
                >
                    PAD
                </a>
            </li>
            <li
                class="nav-item"
                title="Altas"
                role="presentation"
            >
                <a
                    @click="handleMenuEgresos"
                    :class="['font-weight-bold text-uppercase nav-link',{'active':['alta','traslado','contraopinion','fallecido','otro'].includes(areaSiglas)}]"

                    href="#pills-TP"
                    role="tab"
                    aria-controls="pills-TP"
                    aria-selected="false"
                >
                    ALTA
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
    import { get, is_empty, obtenerVariablesGET, is_null,is_undefined } from '../../../../helpers/customHelpers';
    export default {
        name:"ListAreaOptions",
        data() {
            return {
                areaSiglas:"tp",
                areaName:"Todos los Pacientes",
                selectorAreaName:document.getElementById('areaName'),
                loading:document.getElementById('loadingScreen'),
                items:[
                    {
                        name:"Todos los Pacientes",
                        siglas:"tp",
                    },
                    {
                        name:"Emergencia Adulto",
                        siglas:"ea",
                    },
                    {
                        name:"Emergencia Pediátrica",
                        siglas:"ep",
                    },
                    {
                        name:"Área Quirúrgica",
                        siglas:"aq",
                    },
                    {
                        name:"Hospitalización Corta Estancia Pediátrica",
                        siglas:"hcep",
                    },
                    {
                        name:"Hospitalización Piso 2",
                        siglas:"hp2",
                    },
                    {
                        name:"Hospitalización Piso 3",
                        siglas:"hp3",
                    },
                    {
                        name:"Hospitalización Piso 4",
                        siglas:"hp4",
                    },
                    {
                        name:"Hospitalización Piso 5",
                        siglas:"hp5",
                    },
                    {
                        name:"Hospitalización Piso 6",
                        siglas:"hp6",
                    },
                    {
                        name:"Unidad de Terapia Intensiva Adulto",
                        siglas:"utia",
                    },
                    {
                        name:"Unidad de Terapia Intensiva Pediátrica",
                        siglas:"utip",
                    },
                    {
                        name:"Unidad de Terapia Intensiva Neonatal",
                        siglas:"utin",
                    },
                    {
                        name:"Prorama de Atención Domiciliaria",
                        siglas:"pad",
                    },
                    {
                        name:"PAD Emergencia Adulto",
                        siglas:"pad_emergencia_adulto",
                    },
                    {
                        name:"PAD Emergencia Pediátrica",
                        siglas:"pad_emergencia_pediatrica",
                    },
                    {
                        name:"PAD Postquirúrgico Ambulatorio",
                        siglas:"pad_postquirurgico_amb",
                    },
                    {
                        name:"PAD Postquirúrgico Hospitalización",
                        siglas:"pad_postquirurgico_hosp",
                    },
                    {
                        name:"PAD Médico",
                        siglas:"pad_medico",
                    },
                    {
                        name:"Altas médicas",
                        siglas:"alta",
                    },
                    {
                        name:"Traslados a otra institución",
                        siglas:"traslado",
                    },
                    {
                        name:"Contraopinión médica",
                        siglas:"contraopinion",
                    },
                    {
                        name:"Contraopinión médica",
                        siglas:"fallecido",
                    },
                    {
                        name:"Otro concepto de egreso",
                        siglas:"otro",
                    },
                ]
            }
        },
        components:{

        },
        computed: {
            getItems(){
                return this.items.filter(item => !['alta','traslado','contraopinion','fallecido','otro','pad','pad_emergencia_adulto','pad_emergencia_pediatrica','pad_postquirurgico_amb','pad_postquirurgico_hosp','pad_medico',].includes(item.siglas) )
            }
        },
        methods: {
            actualizarMensaje(nuevoMensaje) {
                this.areaSiglas = nuevoMensaje;
            },
            getRouteParams(){
                // Crear un objeto URLSearchParams a partir de la parte de consulta de la URL
                const params = new URLSearchParams(window.location.search);

                // Crear un objeto vacío para almacenar los parámetros
                const queryParams = {};

                // Iterar sobre los parámetros y agregarlos al objeto
                params.forEach((value, key) => {
                    queryParams[key] = value;
                });

                // Imprimir los parámetros obtenidos
                //console.log('Parámetros de consulta:', queryParams);

                // Puedes acceder a un parámetro específico usando su clave
                // Por ejemplo, si tienes un parámetro 'nombre' en la URL, puedes obtener su valor así:
                this.areaSiglas = queryParams['area'];
                //console.log('Valor de "area":', this.areaSiglas);
            },
            async getAreaData(){

                this.$store.commit('updateProperty', {
                    fieldName:'selectorAreaName',
                    fieldValue: this.items.find(x=>x.siglas === this.areaSiglas).name ,
                });
                this.$store.commit('updateProperty', {
                    fieldName:'loading',
                    fieldValue:true,
                });

                this.$store.commit('updateProperty', {
                    fieldName:'pacientes_datos',
                    fieldValue: await get( location.origin+"/vistas/" + this.$store.state.areaSiglas ),
                });
                this.$store.commit('updateProperty', {
                    fieldName:'loading',
                    fieldValue:false,
                });

            },
            handleMenuPad(){

               /*  $("#messageModal").modal("show")
                this.areaSiglas =  [null,undefined,'undefined'].includes(localStorage.getItem('area')) ? 'tp': localStorage.getItem('area')
                localStorage.setItem("area",this.areaSiglas)
                let App = d.querySelector("#messageModal .modal-body")
                    App.innerHTML =null
                    App.innerHTML = `
                        <div id="AppMenuPad">
                        </div>
                    `
                let app = new Vue( that.AppMenuPad() );
                    app._props.areaSiglas = this.areaSiglas
                    app._props.FnAreaSiglas = this.actualizarMensaje
                    console.log(app); */
            },
            handleMenuEgresos(){
               /*  $("#messageModal").modal("show")
                this.areaSiglas =  [null,undefined,'undefined'].includes(localStorage.getItem('area')) ? 'tp': localStorage.getItem('area')
                localStorage.setItem("area",this.areaSiglas)
                let App = d.querySelector("#messageModal .modal-body")
                    App.innerHTML =null
                    App.innerHTML = `
                        <div id="AppMenuEgresos">
                        </div>
                    `
                let app = new Vue( that.AppMenuEgresos() );
                    app._props.areaSiglas = this.areaSiglas
                    app._props.FnAreaSiglas = this.actualizarMensaje
                    console.log(app); */
            },

            handleAreaOption(areaSiglas){
                //console.log(areaSiglas)
                this.areaSiglas = areaSiglas
                localStorage.setItem("area",this.areaSiglas)
                this.$store.commit('updateProperty', {
                    fieldName:'areaSiglas',
                    fieldValue: this.areaSiglas,
                });
               this.getAreaData()



            },
            async getAreaTitle(){
                this.areaSiglas =  [null,undefined,'undefined'].includes(localStorage.getItem('area')) ? 'tp': localStorage.getItem('area')
                this.$store.commit('updateProperty', {
                    fieldName:'areaSiglas',
                    fieldValue: this.areaSiglas,
                });
                await this.getAreaData()
            }
        },
        mounted () {
            this.getAreaTitle()
            //console.log(this.areaSiglas);
            //this.selectorAreaName.textContent = this.items.find(x=>x.siglas === this.areaSiglas).name
            /* if(this.areaSiglas === "pad"){
                this.handleMenuPad()
                return false
            } */
            //this.getAreaData();

        },
    }
</script>

<style lang="scss" scoped>

</style>
