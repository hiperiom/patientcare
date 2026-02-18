<template>

    <div class="flex-fill p-1 d-flex flex-column overflow-auto" >


        <CintilloModal :index_row="$store.state.componenteDinamico.index_row" :dataPaciente="$store.state.componenteDinamico.dataPaciente" />


        <div ref="contentEvolution" class="flex-fill d-flex  overflow-auto rounded border mt-1">
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2 overflow-auto overflow-md-auto" >

                <div id="menuEvolucion" class="nav flex-column nav-pills mt-1 overflow-auto" role="tablist" aria-orientation="vertical">
                    <a
                        :class="['d-flex align-items-center border-0 btn btn-default mr-1 mr-md-0 mb-0 mb-md-1 nav-link active']"
                        data-toggle="pill"
                        href="#"
                        role="tab"
                        aria-controls="v-pills-#"
                        aria-selected="true"
                        @click="getAllItems()"
                    >
                        <div class="d-flex flex-sm-row align-items-center mr-1">
                            <i :class="['icon-option h3 mb-0 mr-1']"></i>
                            <span class="text-option text-left">Ver Todo</span>
                        </div>
                        <div class="ml-auto badge badge-counter">{{ getTotalItems() }}</div>
                    </a>
                    <a
                        v-for="(item,index) in options" :key="index"
                        :class="['d-flex align-items-center border-0 btn btn-default mr-1 mr-md-0 mb-0 mb-md-1 nav-link']"
                        data-toggle="pill"
                        href="#"
                        role="tab"
                        aria-controls="v-pills-#"
                        aria-selected="true"
                        @click="handle_option(index)"
                    >
                        <div class="d-flex flex-sm-row align-items-center mr-1">
                            <i :class="['icon-option h3 mb-0 mr-1',item.icon]"></i>
                            <span class="text-option text-left">{{ item.name }}</span>
                        </div>
                        <div :class="['ml-auto badge badge-counter',{'d-none':getTotalItems(item.name) == 0}]">{{ getTotalItems(item.name) }}</div>
                    </a>
                    <a

                        :class="['d-flex align-items-center border-0 btn btn-default mr-1 mr-md-0 mb-0 mb-md-1 nav-link']"
                        data-toggle="pill"
                        href="#"
                        role="tab"
                        aria-controls="v-pills-#"
                        aria-selected="true"
                        @click="handle_option('Antecedentes')"
                    >
                        <div class="d-flex flex-sm-row align-items-center mr-1">
                            <i :class="['icon-option h3 mb-0 mr-1 pc-antecedentes']"></i>
                            <span class="text-option text-left">Antecedentes/Comorbilidad</span>
                        </div>
                        <div :class="['ml-auto badge badge-counter',{'d-none':totalComorbilidad == 0}]">{{ totalComorbilidad }}</div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-8 col-xl-10 mt-1 mt-md-0 d-flex flex-column flex-md-fill overflow-auto" >
                <div class="flex-fill d-flex flex-column overflow-auto" >
                    <div class="p-1 my-1 bg-light rounded-pill d-flex justify-content-between">
                        <button
                            @click="scrollTo('left')"
                            v-if="getBtnScroll"
                            type="button"
                            class="d-block d-md-none btn btn-primary"
                        >
                            <i class="fas fa-arrow-left"></i>
                        </button>
                        <h3 class="mb-0 ml-2 text-primary">{{ currentOptiontitle }}</h3>
                        <button
                            @click="addItem()"
                            v-if="botonAgregarVisible"
                            type="button"
                            class="btn btn-success ml-auto"
                        >
                            <i class="fas fa-plus"></i> Agregar
                        </button>
                    </div>
                    <div class="flex-fill bg-light d-flex flex-md-column overflow-auto mb-1 rounded-pill-custom p-1">
                       <!--  <div v-for="(item,index) in currentResult" :key="index">
                            {{ item }}
                        </div> -->
                        <div v-if="!['Antecedentes'].includes(currentOptiontitle)">
                            <ListItemsEvolucion

                                :index_row="index_row"
                                :dataPaciente="dataPaciente"
                            />
                        </div>
                        <div v-if="['Antecedentes'].includes(currentOptiontitle)">
                            <ListItemsAntecedentes

                                :index_row="index_row"
                                :dataPaciente="dataPaciente"
                            />

                        </div>
                    </div>
                    <div class="d-none bg-info"></div>
                </div>
            </div>

        </div>
        <div class="rounded d-flex mt-1">
            <button @click="handle_altaPaciente()" class="flex-fill btn btn-success mr-1">
                Alta
            </button>
            <button class="flex-fill btn btn-secondary">
                Traslado
            </button>

        </div>

    </div>
</template>

<script>
import { get, post,is_empty,obtenerVariablesGET, fechaCortaAPPLE,  is_null,is_undefined } from '../../../helpers/customHelpers';
import CintilloModal from './CintilloModal.vue';
import ListItemsEvolucion from './ListItemsEvolucion.vue';
import ListItemsAntecedentes from './ListItemsAntecedentes.vue';
import FormAltaPaciente from './FormAltaPaciente.vue';
import FormProbalilidadDiagnostica from './FormProbalilidadDiagnostica.vue';
import FormOrdenMedica from './FormOrdenMedica.vue';
import FormEvolucion from './FormEvolucion.vue';
import FormPlan from './FormPlan.vue';
import FormRecipe from './FormRecipe.vue';
import FormLaboratorio from './FormLaboratorio.vue';
import FormImagenes from './FormImagenes.vue';
import FormFotografias from './FormFotografias.vue';
import FormObservacion from './FormObservacion.vue';
import FormEstudioDiagnostico from './FormEstudioDiagnostico.vue';
import FormComorbilidad from './FormComorbilidad.vue';
import FormOtroArchivo from './FormOtroArchivo.vue';
export default {
    name:"BtnWidgetEvolucionEquipoMedico",
    props:{
        index_row:Number,
        dataPaciente:Object
    },
    components: {
        FormProbalilidadDiagnostica,
        FormEvolucion,
        FormLaboratorio,
        FormComorbilidad,
        FormImagenes,
        FormFotografias,
        FormEstudioDiagnostico,
        FormPlan,
        FormOtroArchivo,
        FormObservacion,
        FormRecipe,
        FormOrdenMedica,
        CintilloModal,
        FormAltaPaciente,
        ListItemsEvolucion,
        ListItemsAntecedentes,
    },
    data() {
        return {
            myData:[],
            botonAgregarVisible:false,
            componenteDinamico:null,
            /* componenteParams: {}, */
            currentOptiontitle:"",
            currentResult:[],
            btnScroll:false,
            totalComorbilidad:0,
            options:[
                {
                    name:"Laboratorio",
                    icon:"pc-laboratorio1",
                    cat_user_cuestionario_id:90,
                },
                {
                    name:"Imagenes",
                    icon:"pc-imagenes",
                    cat_user_cuestionario_id:100,
                },
                {
                    name:"Fotografías",
                    icon:"pc-fotografia",
                    cat_user_cuestionario_id:191,
                },
                {
                    name:"Otros Archivos",
                    icon:"pc-otros-archivos",
                    cat_user_cuestionario_id:122,
                },
                {
                    name:"Probabilidad diagnóstica",
                    icon:"pc-observacion",
                    cat_user_cuestionario_id:101,
                },
                {
                    name:"Evolución",
                    icon:"pc-evolucion",
                    cat_user_cuestionario_id:175,
                },
                {
                    name:"Orden Médica",
                    icon:"pc-orden_medica",
                    cat_user_cuestionario_id:175,
                },
                {
                    name:"Plan",
                    icon:"pc-plan",
                    cat_user_cuestionario_id:102,
                },

                {
                    name:"Récipe",
                    icon:"pc-recipe1",
                    cat_user_cuestionario_id:177,
                },
                {
                    name:"Observación",
                    icon:"pc-buscar",
                    cat_user_cuestionario_id:176,
                },
                {
                    name:"Estudio Diagnóstico",
                    icon:"pc-estudio-diagnostico",
                    cat_user_cuestionario_id:178,
                },
                /* {
                    name:"Antecedentes",
                    icon:"pc-antecedentes",
                    cat_user_cuestionario_id:189,
                }, */
            ],
        }
    },
    methods: {
        getComponent(){
            let models = {
                    "Estudio Diagnóstico": this.$options.components.FormEstudioDiagnostico,
                    "Antecedentes": this.$options.components.FormComorbilidad,
                    "Observación": this.$options.components.FormObservacion,
                    "Récipe": this.$options.components.FormRecipe,
                    "Orden Médica": this.$options.components.FormOrdenMedica,
                    "Plan": this.$options.components.FormPlan,
                    "Evolución": this.$options.components.FormEvolucion,
                    "Probabilidad diagnóstica": this.$options.components.FormProbalilidadDiagnostica,
                    "Laboratorio": this.$options.components.FormLaboratorio,
                    "Imagenes": this.$options.components.FormImagenes,
                    "Fotografías": this.$options.components.FormFotografias,
                    "Otros Archivos": this.$options.components.FormOtroArchivo,
                }
                return models[ this.currentOptiontitle ]
        },
        addItem(){

            this.$store.commit('updateProperty', {
                fieldName: 'componenteDinamico',
                fieldValue: {
                    customComponent: this.getComponent(),
                    customComponent2: this.$store.state.componenteDinamico.customComponent2,
                    index_row: this.index_row,
                    dataPaciente: this.dataPaciente
                }
            });

        },
        async getTotalComorbilidad(){
            let that = this
            if (!is_undefined(that.dataPaciente)) {

                let formdata = new FormData();
                    formdata.append("user_id", that.dataPaciente.user_id)
                    formdata.append("_token", $("#_token").val())
                let result = await post(location.origin+"/user_cuest_comorbilidad/show/" + that.dataPaciente.user_id, formdata)
                    that.totalComorbilidad= result.length
            }else{
                return 0
            }

        },
        getTotalItems(name=null){
            let that = this
            if (!is_undefined(that.dataPaciente)) {
                return is_null(name) ? that.dataPaciente.resultados.length : that.dataPaciente.resultados.filter(x=>x.description === name).length
            }else{
                return 0
            }

        },
        getAllItems(name=null){
            this.scrollTo('right')
            let that = this
            this.currentOptiontitle = name
            //setTimeout(() => {
                try {

                    if ( is_null(name) ) {

                        if (!is_undefined(that.dataPaciente)) {
                            that.botonAgregarVisible =false
                            this.$store.commit('updateProperty', {
                                fieldName: 'items_currentResult',
                                fieldValue: that.configData( that.dataPaciente.resultados )
                            });

                        }else{
                            return []
                        }

                    }else{

                        if (!is_undefined(that.dataPaciente)) {
                            that.botonAgregarVisible =true
                            this.$store.commit('updateProperty', {
                                fieldName: 'items_currentResult',
                                fieldValue: that.configData( that.dataPaciente.resultados.filter(x=>x.description === this.currentOptiontitle) )
                            });

                        }else{
                            return []
                        }

                    }
                } catch (error) {
                    console.log(error)
                }
            //}, 1000);
        },
        configData(currentResult){
            let tempFecha = []
            currentResult.forEach(element => {
                let f1 = ( element.created_at.split(" ") )[0]
                    tempFecha.push(f1)
            });
            this.myData =[]
            Array.from(new Set(tempFecha)).forEach((item,index)=>{
                this.myData.push({
                    fecha:item,
                    fechaFormated:fechaCortaAPPLE(item+" 00:00:00"),
                    items:  currentResult.filter(element=>{
                                let medico = this.$store.state.medicos_datos.find( medico => medico.user_id === element.user_id_medico )
                                let dato = ``;
                                let coments = "";
                                let valor = "";
                                let medico_posicion ={
                                        "nombre":"Tratante",
                                        "siglas":"TR",
                                        "color":"success",
                                    }
                                    if (
                                        element.description == "Orden Médica" ||
                                        element.description == "Evolución" ||
                                        element.description == "Pendiente" ||
                                        element.description == "Probabilidad diagnóstica" ||
                                        element.description == "Plan" ||
                                        element.description == "Observación" ||
                                        element.description == "Récipe" ||
                                        element.description == "Estudio Diagnóstico"
                                    ) {
                                        if (element.value != null) {
                                            valor = element.value.replace(/\n/g, "<br />");
                                            //valor = valor.replace(/<[^>]*>/g, '');
                                            // Remover estilos de Word
                                            valor = valor.replace(/\s*style=("|\')[^"\']*("|\')/gi, '');
                                        }
                                        dato = `
                                            ${valor}
                                        `;
                                    }
                                    if (
                                        element.description == "Laboratorio" ||
                                        element.description == "Imagenes" ||
                                        element.description == "Fotografías" ||
                                        element.description == "Otro"

                                    ) {
                                        if (element.coments != null) {
                                            coments = element.coments.replace(/\n/g, "<br />");
                                            //coments = coments.replace(/<[^>]*>/g, '');
                                            // Remover estilos de Word
                                            coments = coments.replace(/\s*style=("|\')[^"\']*("|\')/gi, '');
                                        }

                                        let imageIcon = "";
                                        if (element.description == "Laboratorio") {
                                            imageIcon = "/image/system/icono_laboratorio.svg";
                                        }
                                        if (element.description == "Imagenes") {
                                            imageIcon = `/${element.value}`;
                                        }
                                        if (element.description == "Fotografías") {
                                            imageIcon = `/${element.value}`;
                                        }
                                        if (element.description == "Otro") {
                                            imageIcon = "/image/system/icono_archivo.svg";
                                        }

                                        if (element.value != null) {
                                            valor = `
                                                <img onclick="window.open('/${element.value}', '_blank')" style="cursor:pointer;width: 50px;" class="ampliar zoom img-fluid" src='${imageIcon}'>
                                                <br>`;
                                        }
                                        dato = `
                                            ${valor}
                                            ${coments}
                                        `;
                                    }

                                    if ([2].includes(medico.posicion_id)) {
                                        medico_posicion ={
                                            "nombre":"Interconsultante",
                                            "siglas":"IN",
                                            "color":"info",
                                        }
                                    }
                                    if ([3,4].includes(medico.posicion_id)) {
                                        medico_posicion ={
                                            "nombre":"Fellow",
                                            "siglas":"FE",
                                            "color":"orange",
                                        }
                                    }
                                    if ([5,6,7,8].includes(medico.posicion_id)) {
                                        medico_posicion ={
                                            "nombre":"Residentes",
                                            "siglas":"RE",
                                            "color":"secondary",
                                        }
                                    }
                                    if ([9].includes(medico.posicion_id)) {
                                        medico_posicion ={
                                            "nombre":"RAMH",
                                            "siglas":"RA",
                                            "color":"purple",
                                        }
                                    }
                                    if ([10].includes(medico.posicion_id)) {
                                        medico_posicion ={
                                            "nombre":"Enfermería",
                                            "siglas":"EN",
                                            "color":"warning",
                                        }
                                    }

                                    element.fechaItem = fechaCortaAPPLE( element.created_at )
                                    element.dataMedico_posicion = medico_posicion
                                    element.dataMedico = medico
                                    element.dato = dato
                                let f1 = ( element.created_at.split(" ") )[0]
                                    if (f1 === item) {

                                        return element
                                    }
                            })
                })
            })
            return this.myData
        },
        handle_option(index){
            this.scrollTo('right')
            if (['Antecedentes'].includes(index)) {
                this.currentOptiontitle = index
                this.getAllItems(index)
                return false
            }

            let option = this.options[index]

                this.currentOptiontitle = option.name
                //this.currentOptionItems
                this.getAllItems(option.name)
        },
        scrollTo(side) {
            // Obtener el elemento contenedor que tiene el desplazamiento horizontal
            var container = this.$refs.contentEvolution; // Cambia 'container' por el ID de tu elemento contenedor
            let that = this
            // Definir la cantidad de píxeles a desplazar en cada iteración (ajusta según necesites)
            var scrollStep = 10;


            if (side==="left") {
                that.btnScroll = false
                if (container.scrollLeft > 0) {
                    container.scrollLeft -= scrollStep; // Desplazar hacia la izquierda
                    setTimeout(smoothScroll, 10); // Llamar a la función nuevamente después de un pequeño intervalo
                }
            }
            if (side==="right") {
                that.btnScroll = true
                if (container.scrollLeft < container.scrollWidth - container.clientWidth) {
                    container.scrollLeft += scrollStep; // Desplazar hacia la derecha
                    setTimeout(smoothScroll, 10); // Llamar a la función nuevamente después de un pequeño intervalo
                }
            }

        },
        handle_altaPaciente() {

            this.$store.commit('updateProperty', {
                fieldName: 'componenteDinamico',
                fieldValue: {
                    customComponent: this.$options.components.FormAltaPaciente,
                    customComponent2: this.$store.state.componenteDinamico.customComponent2,
                    index_row: this.index_row,
                    dataPaciente: this.dataPaciente
                }
            });

            $("#exampleModal").modal("show")
        },
    },
    computed: {
        getBtnScroll() {
            return this.btnScroll
        }
    },
    async mounted() {
        this.getAllItems()
        await this.getTotalComorbilidad()
    }
}
</script>

<style scoped>
.rounded-pill-custom{
    border-radius:15px !important;
}
#menuEvolucion .nav-link.active {
    color: var(--white) !important;
    background-color: var(--primary) !important;
}
.icon-option{
    color:var(--info);
}
.text-option{
    font-weight: 500;
    color:var(--secondary);
}
.badge-counter {
    color: #ffffff;
    background-color: var(--primary);
}
#menuEvolucion .nav-link.active .icon-option{
    color: var(--white) !important;
}
#menuEvolucion .nav-link.active .text-option{
    color: var(--white) !important;
}
#menuEvolucion .nav-link.active .badge-counter{
    color: var(--primary) !important;
    background-color: var(--white);
}
/* // Small devices (landscape phones, 576px and up) */
@media (min-width: 576px) {
    .overflow-sm-auto{
        overflow:auto !important;
    }
}

/* // Medium devices (tablets, 768px and up) */
@media (min-width: 768px) {
    .overflow-md-auto{
        overflow:auto !important;
    }
}

/* // Large devices (desktops, 992px and up) */
@media (min-width: 992px) {

}

/* // Extra large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) {

}
</style>
