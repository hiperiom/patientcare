
import { computed } from "vue";
import {get,post,fotoTemporal,loading,meses,fechaAMD2,is_null,activarTooltip,is_empty, timestamps, is_undefined} from "../helpers/helpers.js";
import UserCuestPaciente from "./UserCuestPaciente.js";
import UserCuestUbicacion from "./UserCuestUbicacion.js";
let userCuestPaciente = new UserCuestPaciente();


let listTemplate1 = /*html */`
    <div class="flex-fill d-flex flex-column overflow-auto">
        <ul class="nav bg-light justify-content-between nav-pills" id="pills-tab" role="tablist">

            <app-filter
                :tipo_filtro="tipo_filtro"
                :filtro_valor="filtro_valor"
                @update-filtro="updateFiltro"
                :currentItem="currentItem"
                :dataEpisodio="dataEpisodio"
            />
            <li
                v-if="index !== 0"
                class="nav-item" role="presentation"
                @click="sendDataToParent"
            >
                <a

                    class="nav-link currentItem"
                    id="pills-createItem-tab"
                    data-toggle="pill"
                    href="#pills-createItem"
                    role="tab"
                    aria-controls="pills-createItem"
                    aria-selected="false"
                >
                    <h3 class="mb-0">Agregar {{currentItem}}</h3>
                </a>
            </li>
        </ul>
        <div class="flex-fill tab-content d-flex flex-column overflow-auto" id="pills-tabContent">
            <div
                class="tab-pane overflow-auto fade show active"
                id="pills-listItems"
                role="tabpanel"
                aria-labelledby="pills-listItems-tab"
            >
                <app-list-items-historia
                    :patient_data="patient_data"
                    :dataEpisodio="dataEpisodio"
                    :index="index"
                />
            </div>
            <div class="tab-pane fade flex-fill flex-column" id="pills-createItem" role="tabpanel" aria-labelledby="pills-profile-tab">
                <component
                    :is="currentComponent"
                    :currentItem="currentItem"
                ></component>

            </div>
        </div>
        <div class="d-none bg-danger p-4"></div>
    </div>
`;

let listTemplate2 = /*html */`
    <div class="flex-fill d-flex flex-column overflow-auto">
        <ul class="nav bg-light justify-content-between nav-pills" id="pills-tab" role="tablist">

            <app-filter
                :tipo_filtro="tipo_filtro"
                :filtro_valor="filtro_valor"
                @update-filtro="updateFiltro"
                :currentItem="currentItem"
                :dataEpisodio="dataEpisodio"
            />
            <li
                v-if="index !== 0"
                class="nav-item" role="presentation"
                @click="sendDataToParent"
            >
                <a

                    class="nav-link currentItem"
                    id="pills-createItem-tab"
                    data-toggle="pill"
                    href="#pills-createItem"
                    role="tab"
                    aria-controls="pills-createItem"
                    aria-selected="false"
                >
                    <h3 class="mb-0">Agregar {{currentItem}}</h3>
                </a>
            </li>
        </ul>
        <div class="flex-fill tab-content d-flex flex-column overflow-auto" id="pills-tabContent">
            <div
                class="tab-pane overflow-auto fade show active"
                id="pills-listItems"
                role="tabpanel"
                aria-labelledby="pills-listItems-tab"
            >
            <div class="table-responsive">
            <table class="table table-bordered mb-3">
                <thead>
                    <tr>
                        <th class="text-primary text-center">
                            #
                        </th>
                        <th class="text-primary text-center">Antecedentes/Comorbilidad de Egreso</th>
                        <th class="d-none text-primary text-center">Acción</th>

                    </tr>
                </thead>
                <!--<tbody v-if="items.length > 0">
                    <tr v-for="(item,index) in items" :key="index">
                        <td style="width: 20px;" class="text-right text-secondary" id="modal-793">
                            {{ index+1 }}
                        </td>
                        <td class="text-secondary" id="modal-793">
                            {{ item.description }}
                        </td>
                        <td class="d-none" style="width: 60px;" align="center">
                            <button  data-tippy-content="Eliminar valor" class="delete-row btn btn-danger" data-id="793"><i class="fa fa-minus" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                </tbody>-->
                <tbody v-else>
                    <tr>
                        <td colspan="3" class="text-center text-primary">
                            No se encontraron resultados
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
            </div>
            <div class="tab-pane fade flex-fill flex-column" id="pills-createItem" role="tabpanel" aria-labelledby="pills-profile-tab">
                <component
                    :is="currentComponent"
                    :currentItem="currentItem"
                ></component>

            </div>
        </div>
        <div class="d-none bg-danger p-4"></div>
    </div>
`;
let ApphistoriaInicialSignosVitales = ()=>{
    return {
        name:"ApphistoriaInicialSignosVitales",
        props:{
            parentForm:Object,
            patient_data:Object,
        },
        template:/*html */`
            <div class="card card-outline collapsed-card card-primary" style="background-color: rgba(0, 0, 0, 0.03);">
                <div class="card-header cursor-pointer" data-card-widget="collapse">
                    <h3 class="card-title text-primary font-weight-bold">Signos Vitales</h3>
                </div>
                <div id="signosVitales" class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-0">

                            <div class="input-group m-0 rounded-0 border-0">
                                <div class="input-group-prepend rounded-0 border-0">
                                    <span class="input-group-text rounded-0 border-0" style="width: 60px;">PESO</span>
                                </div>
                                <input v-model="form.peso" @keyup="updateParentForm()"  name="user_peso" type="text" aria-label="First name" class="form-control rounded-0 border-0">
                                <div class="input-group-prepend rounded-0 border-0">
                                    <span class="input-group-text rounded-0 border-0" style="width: 75px;">Kg.</span>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item p-0">

                            <div class="input-group m-0 rounded-0 border-0">
                                <div class="input-group-prepend rounded-0 border-0">
                                    <span class="input-group-text rounded-0 border-0" style="width: 60px;">TALLA</span>
                                </div>
                                <input v-model="form.talla" @keyup="updateParentForm()" name="user_talla" type="text" aria-label="First name" class="form-control rounded-0 border-0">
                                <div class="input-group-prepend rounded-0 border-0">
                                    <span class="input-group-text rounded-0 border-0" style="width: 75px;">Cm.</span>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item p-0">

                            <div class="input-group m-0 rounded-0 border-0">
                                <div class="input-group-prepend rounded-0 border-0">
                                    <span class="input-group-text rounded-0 border-0" style="width: 60px;">TEMP.</span>
                                </div>
                                <input v-model="form.temp" @keyup="updateParentForm()" name="user_temperatura" type="text" aria-label="First name" class="form-control rounded-0 border-0">
                                <div class="input-group-prepend rounded-0 border-0">
                                    <span class="input-group-text rounded-0 border-0" style="width: 75px;">°C</span>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item p-0">

                            <div class="input-group m-0 rounded-0 border-0">
                                <div class="input-group-prepend rounded-0 border-0">
                                    <span class="input-group-text rounded-0 border-0" style="width: 60px;">OXI</span>
                                </div>
                                <input v-model="form.oxi" @keyup="updateParentForm()" name="user_oximetria" type="text" aria-label="First name" class="form-control rounded-0 border-0">
                                <div class="input-group-prepend rounded-0 border-0">
                                    <span class="input-group-text rounded-0 border-0" style="width: 75px;">%</span>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item p-0">

                            <div class="input-group m-0 rounded-0 border-0">
                                <div class="input-group-prepend rounded-0 border-0">
                                    <span class="input-group-text rounded-0 border-0" style="width: 60px;">F.C.</span>
                                </div>
                                <input v-model="form.fc" @keyup="updateParentForm()" name="user_fc" type="text" aria-label="First name" class="form-control rounded-0 border-0">
                                <div class="input-group-prepend rounded-0 border-0">
                                    <span class="input-group-text rounded-0 border-0" style="width: 75px;">lat/min</span>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item p-0">

                            <div class="input-group m-0 rounded-0 border-0">
                                <div class="input-group-prepend rounded-0 border-0">
                                    <span class="input-group-text rounded-0 border-0" style="width: 60px;">F.R.</span>
                                </div>
                                <input v-model="form.fr" @keyup="updateParentForm()" name="user_fr" type="text" aria-label="First name" class="form-control rounded-0 border-0">
                                <div class="input-group-prepend rounded-0 border-0">
                                    <span class="input-group-text rounded-0 border-0" style="width: 75px;">resp/min</span>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item p-0">

                            <div class="input-group m-0 rounded-0 border-0">
                                <div class="input-group-prepend rounded-0 border-0">
                                    <span class="input-group-text rounded-0 border-0" style="width: 60px;">GL.</span>
                                </div>
                                <input v-model="form.gl" @keyup="updateParentForm()" name="user_glic" type="text" aria-label="First name" class="form-control rounded-0 border-0">
                                <div class="input-group-prepend rounded-0 border-0">
                                    <span class="input-group-text rounded-0 border-0" style="width: 75px;">mg/dL</span>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item p-0">
                            <div class="input-group m-0">
                                <div class="input-group-prepend rounded-0 border-0">
                                <span class="input-group-text rounded-0 border-0" style="width: 60px;">T.A.</span>
                                </div>
                                <input v-model="form.ta_sis" @keyup="updateParentForm" name="user_ta_sis" placeholder="Sistólica" type="text" aria-label="First name" class="form-control rounded-0 border-0">
                                <input v-model="form.ta_dia" @keyup="updateParentForm" name="user_ta_dia" placeholder="Diastólica" type="text" aria-label="Last name" class="form-control rounded-0 border-0">
                                <div class="input-group-prepend rounded-0 border-0">
                                    <span class="input-group-text rounded-0 border-0" style="width: 75px;">mmHg</span>
                                </div>
                            </div>

                        </li>


                    </ul>
                </div>
            </div>
        `,
        components:{

        },
        data() {
            return {
                form:{
                    peso:"",
                    talla:"",
                    temp:"",
                    oxi:"",
                    fc:"",
                    fr:"",
                    gl:"",
                    ta_sis:"",
                    ta_dia:"",
                }
            }
        },
        methods: {
            updateParentForm(){
                this.$emit('formupdate', this.form);
            },

        },
        async mounted () {
            this.form = this.parentForm
        },
    }
}
let ApphistoriaInicialSospechas = ()=>{
    return {
        name:"ApphistoriaInicialSospechas",
        props:{
            parentForm:Object,
            patient_data:Object,
        },
        template:/*html */`
            <div class="card card-outline collapsed-card card-primary" style="background-color: rgba(0, 0, 0, 0.03);">
                <div class="card-header cursor-pointer" data-card-widget="collapse">
                    <h3 class="card-title text-primary font-weight-bold">Sospecho que el paciente requerirá:</h3>
                    <div class="card-tools">

                    </div>
                </div>
                <div id="evaluacionIngreso" class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                    <ul class="list-group list-group-flush">
             
                        <li class="list-group-item p-1">
                            <div class="form-group mb-0">
                                <label class="text-gray mb-0" for="">Interconsulta con médico especialista:</label>
                                <select v-model="form.requiere_intersonsulta" @change="req_interconsulta()" class="form-control border-0" name="requiere_intersonsulta" id="requiere_intersonsulta">
                                    <option value="0" selected>No</option>
                                    <option value="1">Si</option>
                                </select>
                            
                            </div>
                        </li>
                        <li  v-if="Number(form.requiere_intersonsulta) === 1" class="list-group-item p-1">
                            <div class="form-group mb-0">
               
                                <label>Seleccione una opción:</label>
                                <select v-model="form.cantidad_especialistas" class="form-control border-0" style="background-color: #f9f9f9;" @change="updateParentForm()" name="cantidad_especialistas" id="cantidad_especialistas">
                                    <option value="1">1 especialistas</option>
                                    <option value="2">2 especialistas</option>
                                    <option value="3">+2 especialistas</option>
                                </select>
                                
                            </div>
                        </li>
                        <li class="list-group-item p-1">
                            <div class="form-group mb-0">
                                <label class="text-gray mb-0" for="">¿Realizar procedimiento?</label>
                                <select v-model="form.realizar_procedimiento" @change="rea_procedimiento()" class="form-control border-0" name="realizar_procedimiento" id="realizar_procedimiento">
                                    <option value="0" selected>No</option>
                                    <option value="1">Si</option>
                                </select>
                            
                            </div>
                        </li>
                        <li v-if="Number(form.realizar_procedimiento) === 1" class="list-group-item p-1">
                            <div class="form-group mb-0">
                                <label class="text-gray mb-0" for="">Complejidad</label>
                                <select v-model="form.procedimiento_complejidad" @change="updateParentForm()" class="form-control border-0" name="procedimiento_complejidad" id="procedimiento_complejidad">
                                    <option value="">Seleccione</option>
                                    <option value="Procedimiento de baja complejidad" selected>Procedimiento de baja complejidad</option>
                                    <option value="Procedimiento de alta complejidad">Procedimiento de alta complejidad</option>
                                </select>
                            
                            </div>
                        </li>
                        <li class="list-group-item p-1">
                            <div class="form-group mb-0">
                                <label class="text-gray mb-0" for="">Hospitalización:</label>
                                <select v-model="form.requiere_hospitalizacion" @change="updateParentForm()" class="form-control border-0" name="hospitalizacion" id="hospitalizacion">
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                            </div>
                        </li>
                        <li class="list-group-item p-1">
                            <div class="form-group mb-0">
                                <label class="text-gray mb-0" for="">Terapia Intensiva:</label>
                                <select v-model="form.requiere_uti" @change="updateParentForm()" class="form-control border-0" name="terapia_intensiva" id="terapia_intensiva">
                                    <option value="0">No</option>
                                    <option value="1">Si</option>

                                </select>
                            </div>
                        </li>
                        <li class="list-group-item p-1">
                            <div class="form-group mb-0">
                                <label class="text-gray mb-0" for="">Cirugía:</label>
                                <select v-model="form.requiere_cirugia" class="form-control border-0" @change="updateParentForm()" name="caso_tipo_medico" id="caso_tipo_medico">
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                            </div>
                        </li>
                        <li class="list-group-item p-1">
                            <div class="form-group mb-0">
                                <label class="text-gray mb-0" for="">Clasificación del Triaje:</label>
                                <select v-model="form.nivel_triaje" class="form-control border-0" @change="updateParentForm()" name="nivel_triaje" id="nivel_triaje">
                                    <option value="null">Seleccione</option>
                                    <option value="1">Nivel 1</option>
                                    <option value="2">Nivel 2</option>
                                    <option value="3">Nivel 3</option>
                                    <option value="4">Nivel 4</option>
                                    <option value="5">Nivel 5</option>
                                </select>
                            </div>
                        </li>


                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        `,
        components:{

        },
        data() {
            return {
                filtro: '',
                form:{
                    requiere_intersonsulta:"0",
                    realizar_procedimiento:"0",
                    cantidad_especialistas:"0",
                    procedimiento_complejidad: "",
                    requiere_hospitalizacion:"0",
                    requiere_uti:"0",
                    requiere_cirugia:"0",
                    nivel_triaje:"null",
                }
            }
        },
        methods: {
            req_interconsulta(){
                if(this.form.requiere_intersonsulta === "0"){
                    this.form.doctor_id = null
                }
            },
            rea_procedimiento(){
                if(this.form.requiere_hospitalizacion === "0"){
                    this.form.procedimiento_complejidad = ""
                }
            },
            updateParentForm(){
                this.$emit('formupdate', this.form);
            },

        },
        
        async mounted () {
            this.form = this.parentForm
        },
    }
}
export let create_historia_inicial = async (patient_data,episodio_index)=> {
    $("#modal-patient-item").modal("show");
    document.querySelector("#modal-patient-item .modal-body-2").innerHTML = /*html */`
        <div id="AppHistoriaInicial"></div>
    `;
    let app1 = new Vue({
        name:"AppHistoriaInicial",
        el: '#AppHistoriaInicial',
        template: /*html */ `
            <div class="d-flex flex-column flex-fill overflow-auto">
                <div id="infoPaciente"></div>
                <div class="flex-fill d-flex flex-md-row flex-column overflow-auto">
                    <div  class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <h3 class="text-primary">Historia Preliminar de Emergencia</h3>
                            </div>
                            <div class="col-md-4">
                                <app-historia-inicial-signos-vitales
                                    :parentForm="form"
                                    @formupdate="formUpdate"
                                />
                                <br>
                                <app-sospechas-triaje
                                    :parentForm="form"
                                    @formupdate="formUpdate"
                                >
                            </div>
                            <div id="datos_ingreso" class="col-md-8">


                                <div class="card card-outline collapsed-card card-primary"
                                    style="background-color: rgba(0, 0, 0, 0.03);">
                                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                                        <h3 class="card-title text-primary font-weight-bold">Motivo de consulta</h3>
                                        <div class="card-tools">

                                        </div>
                                    </div>
                                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                                        <textarea v-model="form.motivo_consulta" class="form-control textarea" placeholder="Escriba aquí por qué el paciente acudió a la emergencia" name="user_motivo_consulta" id="user_problema_salud"
                                            rows="3"></textarea>

                                    </div>
                                </div>
                                <br>
                                <div class="card card-outline collapsed-card card-primary"
                                    style="background-color: rgba(0, 0, 0, 0.03);">
                                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                                        <h3 class="card-title text-primary font-weight-bold">Antecedentes
                                        </h3>
                                        <div class="card-tools">

                                        </div>
                                    </div>
                                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                                        <textarea v-model="form.antecedentes" class="form-control textarea" placeholder="Escriba aquí los antecedentes del paciente" name="user_antecedentes" id="user_antecedentes"
                                            rows="3"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="card card-outline collapsed-card card-primary"
                                    style="background-color: rgba(0, 0, 0, 0.03);">
                                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                                        <h3 class="card-title text-primary font-weight-bold">Enfermedad Actual</h3>
                                        <div class="card-tools">

                                        </div>
                                    </div>
                                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                                        <textarea v-model="form.enfermedad_actual" class="form-control textarea" placeholder="Describa aquí el problema de salud actual" name="user_enfermedad_actual" id="user_problema_salud"
                                            rows="3"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="card card-outline collapsed-card card-primary"
                                    style="background-color: rgba(0, 0, 0, 0.03);">
                                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                                        <h3 class="card-title text-primary font-weight-bold">Examen Físico</h3>
                                        <div class="card-tools">

                                        </div>
                                    </div>
                                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                                        <textarea v-model="form.examen_fisico" class="form-control textarea" placeholder="Describa brevemente los hallazgos positivos del examen físico realizado." name="user_examen_fisico" id="user_examen_fisico"
                                            rows="3"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="card card-outline collapsed-card card-primary"
                                    style="background-color: rgba(0, 0, 0, 0.03);">
                                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                                        <h3 class="card-title text-primary font-weight-bold">Problema de ingreso
                                        </h3>
                                        <div class="card-tools">

                                        </div>
                                    </div>
                                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                                        <textarea v-model="form.problema_de_ingreso" class="form-control textarea" placeholder="Escriba aquí el diagnóstico presuntivo del paciente" name="user_diagnostico_presuntivo" id="user_diagnostico_presuntivo"
                                            rows="3"></textarea>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
                <div  class="container-fluid mt-1">
                    <div :class="['row',{'justify-content-center':!informeGenerado}]">
                        <div v-if="informeGenerado" class="col-12 col-md-4 mb-1 order-3 order-md-1">
                            <button  @click="openInformeEmergencia()" class="w-100 btn btn-info">Informe Preliminar de Emergencia</button>
                        </div>
                        <div class="col-6 col-md-4 mb-1 order-1 order-md-2">
                            <button @click="handle_store()" class="w-100 btn btn-success">Guardar</button>
                        </div>
                        <div class="col-6 mb-1 col-md-4 order-2 ">
                            <button data-dismiss="modal" class="w-100 btn btn-primary">Regresar</button>
                        </div>


                    </div>
                </div>
            </div>
        `,
        components: {
            'app-historia-inicial-signos-vitales':ApphistoriaInicialSignosVitales(),
            'app-sospechas-triaje':ApphistoriaInicialSospechas()
        },
        computed: {

        },
        data() {
            return {
                patient_data:patient_data,
                index:episodio_index,
                loading:document.getElementById('loadingScreen'),
                informeGenerado:false,
                form:{
                    peso:"",
                    talla:"",
                    temp:"",
                    oxi:"",
                    fc:"",
                    fr:"",
                    gl:"",
                    ta_sis:"",
                    ta_dia:"",
                    //
                    requiere_intersonsulta:"0",
                    realizar_procedimiento:"0",
                    cantidad_especialistas:"0",
                    procedimiento_complejidad: "",
                    requiere_hospitalizacion:"0",
                    requiere_uti:"0",
                    requiere_cirugia:"0",
                    nivel_triaje:"null",
                    //
                    motivo_consulta:"",
                    antecedentes:"",
                    enfermedad_actual:"",
                    examen_fisico:"",
                    problema_de_ingreso:"",
               }

            }
        },
        methods: {
            formUpdate(data){
                for (const key in this.form) {
                    if (Object.hasOwnProperty.call(data, key)) {
                        this.form[key] = data[key];

                    }
                }
            },
            async get_historiaIngreso() {
                this.loading.classList.remove("d-none")
                let formdata = new FormData();
                    formdata.append("user_id", this.patient_data.user_id)
                    formdata.append("_token", $("#_token").val())
                let result = await post( location.origin+"/user_cuest_episodio/get_historiaIngreso", formdata)
                let {TEMP,OXI,FC,FR,GLIC,TA,TALLA,PESO} = result.episodio.SIGNOS
                let {HOSPITALIZACION,TERAPIA_INTENSIVA,NIVEL_TRIAJE,IMP_DIAG,CIRUGIA,MOTIVO_CONSULTA,ENFERMEDAD_ACTUAL,ANTECEDENTES,EXAMEN_FISICO, 
                    REQUIERE_INTERCONSULTA,REALIZAR_PROCEDIMIENTO,CANTIDAD_ESPECIALISTAS,PROCEDIMIENTO_COMPLEJIDAD} = result.episodio
                    this.form.temp = TEMP !== null ? TEMP.value :""
                    this.form.oxi = OXI !== null ? OXI.value :""
                    this.form.fc = FC !== null ? FC.value :""
                    this.form.fr = FR !== null ? FR.value :""
                    this.form.gl = GLIC !== null ? GLIC.value :""
                    this.form.ta_sis = TA !== null ? TA.value :""
                    this.form.ta_dia = TA !== null ? TA.value2 :""
                    this.form.peso = PESO !== null ? PESO.value :""
                    this.form.talla = TALLA !== null ? TALLA.value :""
                    this.form.requiere_intersonsulta = [null,0].includes(REQUIERE_INTERCONSULTA) ? 0 :1
                    this.form.realizar_procedimiento = [null,0].includes(REALIZAR_PROCEDIMIENTO) ? 0 :1
                    this.form.cantidad_especialistas = CANTIDAD_ESPECIALISTAS === null ? null : CANTIDAD_ESPECIALISTAS
                    this.form.procedimiento_complejidad = PROCEDIMIENTO_COMPLEJIDAD === null ? "" :PROCEDIMIENTO_COMPLEJIDAD

                    this.form.requiere_hospitalizacion = [null,0].includes(HOSPITALIZACION) ? 0 :1
                    this.form.requiere_uti = [null,0].includes(TERAPIA_INTENSIVA) ? 0 :1
                    this.form.requiere_cirugia = [null,0].includes(CIRUGIA) ? 0 :1
                    this.form.nivel_triaje = [null,'null'].includes(NIVEL_TRIAJE) ? 0 :NIVEL_TRIAJE

                    this.form.motivo_consulta = MOTIVO_CONSULTA === null ? "" :MOTIVO_CONSULTA
                    this.form.antecedentes = ANTECEDENTES === null ? "" :ANTECEDENTES
                    this.form.enfermedad_actual = ENFERMEDAD_ACTUAL === null ? "" :ENFERMEDAD_ACTUAL
                    this.form.examen_fisico = EXAMEN_FISICO === null ? "" :EXAMEN_FISICO
                    this.form.problema_de_ingreso = IMP_DIAG === null ? "" :IMP_DIAG.value

                let existeInforme = await this.existInformeEmergencia()
                    if(existeInforme !== undefined){
                        this.informeGenerado = true
                    }
                    //console.log(existeInforme)
                    this.loading.classList.add("d-none")
            },
            async storeMotivoConsulta(){

                let formdata = new FormData();
                    formdata.append("value", this.form.motivo_consulta )
                    formdata.append("episodio_id", this.patient_data.episodio_id)
                    formdata.append("user_id", this.patient_data.user_id)
                    formdata.append("created_at", timestamps())
                    formdata.append("_token", $("#_token").val())
                    return await post( location.origin+"/user_motivo_consulta/store2", formdata)

            },
            async storeAntecedentes(){

                let formdata = new FormData();
                    formdata.append("value", this.form.antecedentes )
                    formdata.append("episodio_id", this.patient_data.episodio_id)
                    formdata.append("user_id", this.patient_data.user_id)
                    formdata.append("created_at", timestamps())
                    formdata.append("_token", $("#_token").val())
                    return await post( location.origin+"/user_cuest_antecedente/store", formdata)

            },
            async storeEnfermedadActual(){

                let formdata = new FormData();
                    formdata.append("value", this.form.enfermedad_actual )
                    formdata.append("episodio_id", this.patient_data.episodio_id)
                    formdata.append("user_id", this.patient_data.user_id)
                    formdata.append("created_at", timestamps())
                    formdata.append("_token", $("#_token").val())
                    return await post( location.origin+"/user_enfermedad_actual/store2", formdata)

            },
            async storeExamenFisico(){

                let formdata = new FormData();
                    formdata.append("value", this.form.examen_fisico )
                    formdata.append("episodio_id", this.patient_data.episodio_id)
                    formdata.append("user_id", this.patient_data.user_id)
                    formdata.append("created_at", timestamps())
                    formdata.append("_token", $("#_token").val())
                    return await post( location.origin+"/user_examen_fisico/store2", formdata)

            },
            async storeProblemaDeIngreso(){

                let formdata = new FormData();
                    formdata.append("value", this.form.problema_de_ingreso )
                    formdata.append("episodio_id", this.patient_data.episodio_id)
                    formdata.append("user_id", this.patient_data.user_id)
                    formdata.append("created_at", timestamps())
                    formdata.append("_token", $("#_token").val())
                    return await post( location.origin+"/user_cuest_impresion_diagnostica/store", formdata)

            },
            async existInformeEmergencia(){
                return await get(`/user/tipo_documento/show/${this.patient_data.episodio_id}`);
            },
            openInformeEmergencia(){
                window.open(  `/pdf/informeSeguro/${this.patient_data.user_id}` )
            },
            async informePreliminarDeEmergencia(){

                let formdata = new FormData();
                    formdata.append("_token", $("#_token").val())
                    formdata.append("episodio_id",this.patient_data.episodio_id)
                    formdata.append("user_id_paciente",this.patient_data.user_id)
                let firma_sello = await post(`/user/tipo_documento/store`,formdata)

                let existeInforme = await this.existInformeEmergencia()
                    if(existeInforme  !== undefined){
                        this.informeGenerado = true
                    }
            },
            async storeSospechasEpisodio(data) {
                let formdata = new FormData();
                    formdata.append('campo',data.name);
                    formdata.append('valor',data.value);
                    formdata.append('user_cuest_episodio_id',this.patient_data.episodio_id);
                    formdata.append("user_id", this.patient_data.user_id)
                    formdata.append("_token", $("#_token").val())
                    formdata.append("created_at", timestamps())
                    return await post( location.origin+"/user_cuest_episodio/update2", formdata)
            },
            async storeSignos({route,value,value2=null}) {
                let formdata = new FormData();
                    formdata.append("user_id", this.patient_data.user_id)
                    formdata.append("user_id_paciente", patient_data.user_id)
                    formdata.append("episodio_id", patient_data.episodio_id)
                    formdata.append("cat_user_cuestionario_84", value)
                    formdata.append("cat_user_cuestionario_73", value)
                    formdata.append("cat_user_cuestionario_185", value)
                    formdata.append("value", value)
                    formdata.append("value2", value2)
                    formdata.append("created_at", timestamps())
                    formdata.append("sintoma_observacion", "")
                    formdata.append("_token", $("#_token").val())
                    return await post( location.origin+route, formdata)
            },
            async store(){
                let that = this

                    that.loading.classList.remove("d-none")

                    if (that.form.motivo_consulta !== "") {
                        await that.storeMotivoConsulta()
                    }
                    if (that.form.antecedentes!== "") {
                        await that.storeAntecedentes()
                    }
                    if (that.form.enfermedad_actual!== "") {
                        await that.storeEnfermedadActual()
                    }
                    if (that.form.examen_fisico!== "") {
                        await that.storeExamenFisico()
                    }
                    if (that.form.problema_de_ingreso!== "") {
                        await that.storeProblemaDeIngreso()
                    }
                    if (that.form.peso!== "") {
                        await this.storeSignos({
                            route:"/user_peso/store2",
                            value: this.form.peso
                        })
                    }
                    if (that.form.talla!== "") {
                        await this.storeSignos({
                            route:"/user_talla/store",
                            value: this.form.talla
                        })
                    }
                    if (that.form.temp!== "") {
                        await this.storeSignos({
                            route:"/user_cuest_temperatura/store",
                            value: this.form.temp
                        })
                    }
                    if (that.form.oxi!== "") {
                        await this.storeSignos({
                            route:"/user_cuest_oximetria/store",
                            value: this.form.oxi
                        })
                    }
                    if (that.form.fc!== "") {
                        await this.storeSignos({
                            route:"/user_cuest_fc/store",
                            value: this.form.fc
                        })
                    }
                    if (that.form.fr!== "") {
                        await this.storeSignos({
                            route:"/user_cuest_fr/store",
                            value: this.form.fr
                        })
                    }
                    if (that.form.gl!== "") {
                        await this.storeSignos({
                            route:"/user_cuest_gl/store",
                            value: this.form.gl
                        })
                    }
                    if (that.form.ta_sis!== "" && that.form.ta_dia!== "") {
                        await this.storeSignos({
                            route:"/user_cuest_ta/store",
                            value: this.form.ta_sis,
                            value2: this.form.ta_dia
                        })
                    }
                    this.storeSospechasEpisodio(
                        {
                            "name":"requiere_intersonsulta",
                            "value":this.form.requiere_intersonsulta,
                        }
                    )
                    this.storeSospechasEpisodio(
                        {
                            "name":"realizar_procedimiento",
                            "value":this.form.realizar_procedimiento,
                        }
                    )
                    this.storeSospechasEpisodio(
                        {
                            "name":"cantidad_especialistas",
                            "value":this.form.cantidad_especialistas,
                        }
                    )
                    this.storeSospechasEpisodio(
                        {
                            "name":"procedimiento_complejidad",
                            "value":this.form.procedimiento_complejidad,
                        }
                    )
                    this.storeSospechasEpisodio(
                        {
                            "name":"hospitalizacion",
                            "value":this.form.requiere_hospitalizacion,
                        }
                    )
                    this.storeSospechasEpisodio(
                        {
                            "name":"terapia_intensiva",
                            "value":this.form.requiere_uti,
                        }
                    )
                    this.storeSospechasEpisodio(
                        {
                            "name":"cirugia",
                            "value":this.form.requiere_cirugia,
                        }
                    )
                    if (that.form.nivel_triaje!== "null") {
                        this.storeSospechasEpisodio(
                            {
                                "name":"nivel_triaje",
                                "value":this.form.nivel_triaje,
                            }
                        )
                    }
                    that.informePreliminarDeEmergencia()


                    that.loading.classList.add("d-none")

                return true
            },
            async handle_store(){
                //that.informeGenerado = true

                let that = this
                Swal.fire({
                    icon: "info",
                    title: "¿Quieres guardar la Historia Inicial?",
                    text: "Esta acción habilitará el informe preliminar de emergencia.",
                    showCancelButton: true,
                    confirmButtonText: `Si, guardar`,
                    cancelButtonText: `No, aún no.`,
                })
                .then( async (result) => {
                    //console.log(result)
                    if (result.isConfirmed) {
                        await that.store()
                        Swal.fire({
                            icon: "success",
                            title: "Historia Inicial Guardada",
                            text: "Pulse en continuar para cerrar esta ventana, o pulse en Informe Preliminar de Emergencia para abrirlo.",
                            showDenyButton: true,
                            //showCancelButton: true,
                            confirmButtonText: `Continuar`,
                            denyButtonText: `Informe Preliminar de Emergencia`,
                            //cancelButtonText: `Abrir Informe Preliminar de Emergencia`,

                        })
                        .then( async (result) => {
                            if (result.isConfirmed) {
                                $("#modal-patient-item").modal("hide");
                            }
                            if (result.isDenied) {
                                that.openInformeEmergencia()
                            }
                        })
                    }
                })
                /*
                $("#modal-patient-item").modal("hide"); */
            }
        },
        async mounted () {
            await this.get_historiaIngreso()

            userCuestPaciente.infoPaciente("#infoPaciente", this.patient_data.user_id)
        },
    })
}
let AppListItemsHistoria = ()=>{
    return {
        props:{
            currentItem:String,
            patient_data:Object,
            dataEpisodio:Array,
            index:Number,
        },
        template:/*html */`
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 p-1">
                        <div
                            v-if="dataEpisodio.length > 0"
                            class="timeline timeline-inverse"
                        >
                            <!-- FECHA DEL DIA -->
                            <div v-for="(item,index) in dataEpisodio" :key="index">

                                <div v-if="item.items.length !== item.items.filter(x=>!x.active).length" class="time-label">
                                    <span class="bg-primary">
                                        {{ item.fechaFormated }}
                                    </span>
                                </div>

                                <div
                                    v-for="(item2,index2) in item.items"
                                    :key="index2"
                                    v-show="item2.active"
                                >

                                    <i
                                        :content="'Equipo Médico'"

                                        data-tippy-content="Equipo Médico"
                                        class="timelime-medic-icon fas fa-user-md"
                                        aria-hidden="true">
                                    </i>
                                    <div class="timeline-item">
                                        <span class="time">
                                            <i class="far fa-clock"></i>
                                            {{ item2.fechaItem }}
                                            <span class="text-primary">|</span>
                                            {{ item2.hora }}
                                            <a
                                                @click="imprimir(item2)"
                                                class="m-0 p-0 imprimir"
                                                type="button"

                                                :content="'Imprimir'"

                                            >
                                                <i

                                                    class="imprimir m-0 p-0 fas fa-print text-info heartbeat"
                                                    style="font-size: 1em;cursor:pointer; margin-left:1em;"
                                                    aria-hidden="true">
                                                </i>
                                            </a>
                                        </span>
                                        <h3
                                            data-toggle="collapse"
                                            :href="'#collapseExample'+index2"
                                            role="button"
                                            aria-expanded="false"
                                            aria-controls="collapseExample"
                                            class="timeline-header"
                                        >
                                            <b>{{ item2.description }}</b> |
                                            <b class="text-primary">{{ item2.dataMedico.prefijo }} {{ item2.dataMedico.medico }}</b>
                                            <span
                                                :content="'Equipo '+item2.dataMedico_posicion.nombre"

                                                :class="['badge  scale-in-hor-left',('badge-'+item2.dataMedico_posicion.color)]"
                                                style="width:2em;">
                                                {{ item2.dataMedico_posicion.siglas }}
                                            </span>


                                        </h3>
                                        <div
                                            :id="'collapseExample'+index2"
                                            class="collapse show timeline-body"
                                            v-html="item2.dato"
                                        >
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <i class="far fa-clock bg-secondary rounded-circle text-white"></i>
                            </div>
                        </div>
                        <div v-else class="timeline timeline-inverse">
                            <div>
                                <div>
                                    <div class="timeline-item">
                                        <div class="timeline-body text-secondary text-center">
                                            No posee historia este día
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <i class="far fa-clock bg-gray"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        `,
        data() {
            return {

            }
        },
        computed: {
        },
        methods: {
            imprimir(item){
            //imprimir(name,id){
                const {description:name,id} = item
                let description = "";
                let type = "one"
                switch(name){
                    case "Orden Médica": description = "orden_medica"; break;
                    case "Evolución": description = "evolucion"; break;
                    case "Pendiente": description = "pendiente"; break;
                    case "Probabilidad diagnóstica": description = "probabilidad_diagnostica"; break;
                    case "Plan": description = "plan"; break;
                    case "Observación": description = "observacion"; break;
                    case "Récipe": description = "recipe"; break;
                    case "Estudio Diagnóstico": description = "estudio_diagnostico"; break;
                    case "Laboratorio": description = "laboratorio"; break;
                    case "Imagenes": description = "imagenes"; break;
                    case "Otro": description = "otro"; break;
                    default: alert("Error. Reporte no encotrado"); return false; break;
                }
                if (['Orden Médica'].includes(name)) {
                    window.open(location.origin+`/user/informe/omed/orden_medica/${this.patient_data.episodio_id}/${id}`)
                    return false
                }
                if (['Evolución'].includes(name)) {
                    window.open(location.origin+`/user/informe/nde/evolucion_medica/${this.patient_data.episodio_id}/${id}`)
                    return false
                }
                if (['Récipe'].includes(name)) {
                    if (this.esArrayDeObjetos(item.dato)) {
                        
                        this.printPdf( item )
    
                    }
                    /* else{
                       window.open(location.origin+`/user/informe/recmed/recipe_medico/${this.patient_data.episodio_id}/${id}`)
                    } */
                    
                    return false
                }
                if (type==="one") {

                    window.open(`/user/reporte/${description}/${this.patient_data.episodio_id}/${id}/${$(this).data('impresion')}`)

                }else{
                    window.open(`/user/reporte/${description}/${$(this).data('episodio_id')}/all/${$(this).data('impresion')}`)
                }
            },
        },
        async mounted () {
        },
    }
}
let AppCreateItemFile = ()=>{
    return {
        name:"AppCreateLaboratorio",
        props:{
            updateComponentToReturn:Function,
            componentToReturn:String,
            returnTo:String,
            currentItem:String,
            patient_data:Object,
            dataEpisodio:Array,
            index:Number,
        },
        template: /*html */ `
            <div class="flex-fill p-1 d-flex flex-column overflow-auto" >

                <div class="flex-fill overflow-auto mb-1">
                    <textarea
                        class="form-control bg-gray-footer-parodi "
                        :placeholder="'Escriba un comentario'"
                        name="value"
                        ref="value"
                        style=" width: 100%;height: 100%;resize: none;"
                        v-model="form.value"
                    ></textarea>
                </div>
                <div v-if="fileActive()" class="input-group my-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">
                            <img style="width: 2em;height: 2em;" :src="[imagenes[ currentItem ]]">
                        </span>
                    </div>
                    <div class="custom-file">
                        <input
                            type="file"
                            class="custom-file-input"
                            id="file"
                            aria-describedby="file"
                            @change="handle_upload_files()"

                        >
                        <label

                            class="custom-file-label"
                            style="height: calc(2.7rem + 3px);"
                            for="inputGroupFile01"
                        >
                            {{this.form.files !== null ? this.form.files.name : 'Pulsa aquí para subir archivos'}}
                        </label>
                    </div>
                </div>
                <div v-if="this.form.files !== null" class="w-100" id="file_temp">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 text-center">
                        <img
                            class="img-fluid"
                            style="height: 4em;width: 4em;margin: 0.5em;"
                            src="/image/system/icono_fotografia.svg"
                        >
                    </div>
                </div>
                <div class="rounded d-flex mt-1">
                    <button @click="submit()" class="flex-fill btn btn-success mr-1">
                        Agregar
                    </button>
                    <button @click="regresar()" class="flex-fill btn btn-primary"   >
                        Regresar
                    </button>

                </div>

            </div>
        `,
        data() {
            return {
                loading:document.getElementById('loadingScreen'),
                prefixRoute:{
                    "Laboratorio":"user_cuest_laboratorio",
                    "Imagenes":"user_cuest_imagen",
                    "Fotografías":"user_cuest_fotografia",
                    "Otros Archivos":"user_cuest_otro_archivo",
                    "Probabilidad diagnóstica":"user_cuest_impresion_diagnostica",
                    "Evolución":"user_cuest_evolucion",
                    "Orden Médica":"user_cuest_orden_medica",
                    "Plan":"user_cuest_plan",
                    "Récipe":"user_cuest_recipe",
                    "Observación":"user_cuest_observacion",
                    "Estudio Diagnóstico":"user_cuest_estudio",
                    "Antecedentes/Comorbilidad de Egreso":"user_cuest_comorbilidad",
                },
                imagenes:{
                    "Laboratorio":"/image/system/carga1-success.svg",
                    "Imagenes":"/image/system/carga2-success.svg",
                    "Fotografías":"/image/system/carga3-success.svg",
                    "Otros Archivos":"/image/system/carga5-success.svg",
                },
                form:{
                    value:"",
                    files:null
                }
            }
        },

        methods: {
            fileActive(){
                let componentWithFiles =[
                    "Laboratorio",
                    "Imagenes",
                    "Fotografías",
                    "Otros Archivos",
                ]
                return componentWithFiles.includes(this.currentItem)
            },
            handle_upload_files(){
                this.form.files = document.getElementById(`file`).files[0];
            },
            regresar(){
                $("#modal-patient-item").modal("hide")
            },
            async submit(){
                let that = this
                    if (this.form.value === "") {
                        Swal.fire({
                            icon: "success",
                            title: "Campo obligatorio",
                            text: `Un comentario es requerido.`,
                            didClose: () => {
                                setTimeout(() => this.$refs.value.focus(), 110);

                            }
                        })
                        return false;
                    }
                    this.loading.classList.remove("d-none")
                let formdata = new FormData();
                    formdata.append("description", this.form.value)
                    formdata.append("value", this.form.value)
                    formdata.append("coments", this.form.value)
                    formdata.append("user_id", this.patient_data.user_id)
                    formdata.append("episodio_id", this.patient_data.episodio_id)
                    formdata.append("file", this.form.files)
                    formdata.append("_token", $("#_token").val())
                    formdata.append("created_at", timestamps())
                let result = await post(location.origin+"/"+this.prefixRoute[this.currentItem]+"/store", formdata)
                let temp = this.dataEpisodio
                    that.currentComponent = that.updateComponentToReturn
                    that.updateComponentToReturn()
                    this.loading.classList.add("d-none")
                    userCuestPaciente.infoPaciente("#infoPaciente", this.patient_data.user_id)
                    /* Swal.fire({
                        icon: "warning",
                        title: "Datos guardados",
                        text: "El registro se ha guardado exitosamente.",
                        didClose: () => {
                            that.currentComponent = that.updateComponentToReturn
                            that.updateComponentToReturn()
                        }
                    }) */
            }
        },
    }
}
let AppCreateRecipe = ()=>{
    return {
        name:"AppCreateRecipe",
        props:{
            updateComponentToReturn:Function,
            componentToReturn:String,
            returnTo:String,
            currentItem:String,
            patient_data:Object,
            dataEpisodio:Array,
            index:Number,
        },
        template: /*html */ `
            <div class="flex-fill p-1 d-flex flex-column overflow-auto" >
            <div class="flex-fill d-flex flex-column overflow-auto">
     
                <div v-for="(item,index) in medications" :key="index" class="d-flex mb-3">
                    <div v-if="medications.length > 1">{{index+1}}</div>
                    <div class="d-flex flex-wrap flex-fill">
                        <div class="col-6 p-1">
                        <input
                            :ref="'name'+index"
                            v-model="item.name"
                            type="text"
                            class="form-control bg-gray-footer-parodi"
                            placeholder="Medicamento"
                        >
                        </div>
                        <div class="col-3 p-1">
                        <input
                            :ref="'presentation'+index"
                            v-model="item.presentation"
                            type="text"
                            class="form-control bg-gray-footer-parodi"
                            placeholder="Presentación"
                        >
                        </div>
                        <div class="col-3 p-1">


                        <input v-model="item.units" type="text" list="Nums_controls" placeholder="Unidades" class="form-control bg-gray-footer-parodi" >
                        <datalist id="Nums_controls">
                            <option value="cc">
                            <option value="mg">
                            <option value="gr">
                            <option value="UI">
                            <option value="gotas">
                        </datalist>


                        </div>
                        <div class="col-12 p-1">
                        <textarea :ref="'indications'+index" v-model="item.indications" placeholder="Indicaciones" style="resize: none; overflow: hidden;" class="form-control bg-gray-footer-parodi auto-resize-textarea" rows="1"></textarea>
                        </div>
                    </div>
                    <div v-if="medications.length > 1">
                        <button @click="destroyItem(index)" class="btn btn-default">
                            <i class="fa fa-times text-primary"></i>
                        </button>
                    </div>

                    </div>
                    <button
                    @click="addItem"

                    class="btn btn-default border w-100 mb-0"
                    >
                    + Agregar Medicamento
                    </button>
                </div>
               
                
                
                <div class="rounded d-flex mt-1">
                    <button @click="submit()" class="flex-fill btn btn-success mr-1">
                        Agregar
                    </button>
                    <button @click="regresar()" class="flex-fill btn btn-primary"   >
                        Regresar
                    </button>

                </div>

            </div>
        `,
        data() {
            return {
                loading:document.getElementById('loadingScreen'),
                
                medication:{ //formulario de medicacion
                    name:"",
                    presentation:"",
                    units:"",
                    indications:"",
                },
                medications:[],//medicaciones
                episode_id:null, //id del episodio
                created_at:null, //fecha de creacion
                creator_id:null, //id del creador
  
            }
        },

        methods: {
            addItem(p_index){
                this.medications.push(JSON.parse(JSON.stringify(this.medication)))
            },
            destroyItem(p_index){
                this.medications = this.medications.filter((item,index)=>index !== p_index)
            },
        
            regresar(){
                $("#modal-patient-item").modal("hide")
            },
            validations(){
                let result = true
                let input = null
                this.medications.forEach((x,index)=>{
                  
                  if(x.name==="" && result){
                    Swal.fire({
                        icon: "warning",
                        title: "Atención",
                        text: `El campo medicamento no puede estar vacío`,
                        didClose: () => {
                            this.$refs['name'+index][0].focus()
                        }
                    })
                    result = false
                    
                  }
                  if(x.presentation==="" && result){
                    Swal.fire({
                        icon: "warning",
                        title: "Atención",
                        text: `El campo presentación no puede estar vacío`,
                        didClose: () => {
                            this.$refs['presentation'+index][0].focus()
                        }
                    })
                    result = false
                  }
                  if(x.indications==="" && result){
                    Swal.fire({
                        icon: "warning",
                        title: "Atención",
                        text: `El campo indicaciones no puede estar vacío`,
                        didClose: () => {
                            this.$refs['indications'+index][0].focus()
                        }
                    })
                    result = false

                  }
                })
               
                return result
              },
              
            async submit(){
                if(this.validations()){
                let that = this

                this.loading.classList.remove("d-none")
                let formdata = new FormData();

                    formdata.append("description", null)
                    formdata.append("value", JSON.stringify(this.medications))
                    formdata.append("coments",null)
                    formdata.append("user_id", this.patient_data.user_id)
                    formdata.append("episodio_id", this.patient_data.episodio_id)
                    formdata.append("file", null)
                    formdata.append("_token", $("#_token").val())
                    formdata.append("created_at", timestamps())
                let result = await post(location.origin+"/user_cuest_recipe/store", formdata)


                let temp = this.dataEpisodio
                    that.currentComponent = that.updateComponentToReturn
                    that.updateComponentToReturn()
                    this.loading.classList.add("d-none")
                    userCuestPaciente.infoPaciente("#infoPaciente", this.patient_data.user_id)
                }
                
            }
        },
        created () {
            this.medications.push(JSON.parse(JSON.stringify(this.medication)))

        },
    }
}
let AppRowTimeline = ()=>{
    return {
        name:"AppRowTimeline",
        props:{
            currentItem:String,
            patient_data:Object,
            item:Object,
            index:Number,
        },
        template:/*HTML */ `
            <div class="fade-in">
                <i data-tippy-content="Equipo Médico" class="tooltip-primary fas fa-user-md bg-primary text-white" aria-hidden="true"></i>
                <div class="timeline-item">
                    <span class="time">

                        <i class="far fa-clock"></i>
                        18 Junio, 2024
                        <span class="text-primary">|</span>
                        8:03:53 PM
                        <a class="m-0 p-0 imprimir" type="button" id="triggerIdObservación5737" data-type="one" data-name="Observación" data-id="5737" data-episodio_id="31172" data-impresion="color">
                            <i data-tippy-content="Imprimir" class="tooltip-info imprimir m-0 p-0 fas fa-print text-info heartbeat" style="font-size: 1em;cursor:pointer; margin-left:1em;" data-type="one" data-name="Observación" data-id="5737" data-episodio_id="31172" data-impresion="color" aria-hidden="true"></i>
                        </a>
                    </span>


                    <h3 class="timeline-header">
                        <b>{{item.description}}</b> | <a href="#">{{item.medico}}</a> <span data-tippy-content="Equipo Tratante" class="badge tooltip-success bg-success scale-in-hor-left" style="width:2em;">TR</span></h3>

                    <div class="timeline-body" style="font-size: 0.5em;    white-space: pre-line;">

                        {{item}}

                    </div>
                    <div class="timeline-footer">

                    </div>
                </div>
            </div>
        `
    }
}
let AppFilter = ()=>{
    return {
        name:"AppFilter",
        props:{
            currentItem:String,
            patient_data:Object,
            dataEpisodio:Array,
            index:Number,
        },
        data(){
            return {
                filterActive:false,
                tipo_filtro:"",
                filtro_valor:"",
                medicosOptions:[],
            }
        },
        template: /*html */ `
            <li class="nav-item dropdown" role="presentation">
                <a
                    :class="[{'nav-link':!filterActive},{'btn btn-info':filterActive}]"
                    data-toggle="dropdown"
                    href="#"
                    role="button"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <h3 class="mb-0">
                    {{currentItem ==="Ver Todo" ? "":currentItem}}
                        <i style="font-size:1.2rem" class="fas fa-filter"></i>
                    </h3>
                </a>
                <div  class="dropdown-menu p-1">

                    <h6 class="dropdown-header text-center text-primary">Ver por equipo de salud</h6>

                    <div class="container-fluid overflow-auto" >
                        <ul style="max-height: 10rem;" class="list-group list-group-flush overflow-auto">
                            <li
                                @click="handleFilter({tipo_filtro:'medico',filtro_valor:item.medico})"
                                class="cursor-pointer list-group-item text-nowrap py-1 d-flex align-items-center justify-content-between list-group-item-action"
                                v-for="(item,index) in getMedicosOptions.orderByTeem['Tratante']"
                                :key="'filter_' + item.posicion.siglas + index"
                                data-value="item"
                            >
                                <div class="d-flex align-items-center">
                                    <span :class="['mr-1 badge','badge-'+item.posicion.color]">{{item.posicion.siglas}}</span>
                                    <div class="ml-1">
                                        {{item.medico}}
                                    </div>
                                </div>
                                <div>
                                    <span class="mr-1 badge badge-counter">{{counterRow(item.medico)}}</span>
                                </div>
                            </li>
                            <li
                                @click="handleFilter({tipo_filtro:'medico',filtro_valor:item.medico})"
                                class="cursor-pointer list-group-item text-nowrap py-1 d-flex align-items-center justify-content-between list-group-item-action"
                                v-for="(item,index) in getMedicosOptions.orderByTeem['Interconsultante']"
                                :key="'filter_' + item.posicion.siglas + index"
                                data-value="item"
                            >
                                <div class="d-flex align-items-center">
                                    <span :class="['mr-1 badge','badge-'+item.posicion.color]">{{item.posicion.siglas}}</span>
                                    <div class="ml-1">
                                        {{item.medico}}
                                    </div>
                                </div>

                                <div>
                                    <span class="ml-1 badge badge-counter">{{counterRow(item.medico)}}</span>
                                </div>
                            </li>
                            <li
                                @click="handleFilter({tipo_filtro:'medico',filtro_valor:item.medico})"
                                class="cursor-pointer list-group-item text-nowrap py-1 d-flex align-items-center justify-content-between list-group-item-action"
                                v-for="(item,index) in getMedicosOptions.orderByTeem['Fellows']"
                                :key="'filter_' + item.posicion.siglas + index"
                                data-value="item"
                            >
                                <div class="d-flex align-items-center">
                                    <span :class="['mr-1 badge','badge-'+item.posicion.color]">{{item.posicion.siglas}}</span>
                                    <div class="ml-1">
                                        {{item.medico}}
                                    </div>
                                </div>

                                <div>
                                    <span class="ml-1 badge badge-counter">{{counterRow(item.medico)}}</span>
                                </div>
                            </li>
                            <li
                                @click="handleFilter({tipo_filtro:'medico',filtro_valor:item.medico})"
                                class="cursor-pointer list-group-item text-nowrap py-1 d-flex align-items-center justify-content-between list-group-item-action"
                                v-for="(item,index) in getMedicosOptions.orderByTeem['Residentes']"
                                :key="'filter_' + item.posicion.siglas + index"
                                data-value="item"
                            >
                                <div class="d-flex align-items-center">
                                    <span :class="['mr-1 badge','badge-'+item.posicion.color]">{{item.posicion.siglas}}</span>
                                    <div class="ml-1">
                                        {{item.medico}}
                                    </div>
                                </div>

                                <div>
                                    <span class="ml-1 badge badge-counter">{{counterRow(item.medico)}}</span>
                                </div>
                            </li>
                            <li
                                @click="handleFilter({tipo_filtro:'medico',filtro_valor:item.medico})"
                                class="cursor-pointer list-group-item text-nowrap py-1 d-flex align-items-center justify-content-between list-group-item-action"
                                v-for="(item,index) in getMedicosOptions.orderByTeem['RAMH']"
                                :key="'filter_' + item.posicion.siglas + index"
                                data-value="item"
                            >
                                <div class="d-flex align-items-center">
                                    <span :class="['mr-1 badge','badge-'+item.posicion.color]">{{item.posicion.siglas}}</span>
                                    <div class="ml-1">
                                        {{item.medico}}
                                    </div>
                                </div>

                                <div>
                                    <span class="ml-1 badge badge-counter">{{counterRow(item.medico)}}</span>
                                </div>
                            </li>
                            <li
                                @click="handleFilter({tipo_filtro:'medico',filtro_valor:item.medico})"
                                class="cursor-pointer list-group-item text-nowrap py-1 d-flex align-items-center justify-content-between list-group-item-action"
                                v-for="(item,index) in getMedicosOptions.orderByTeem['Enfermería']"
                                :key="'filter_' + item.posicion.siglas + index"
                                data-value="item"
                            >
                                <div class="d-flex align-items-center">
                                    <span :class="['mr-1 badge','badge-'+item.posicion.color]">{{item.posicion.siglas}}</span>
                                    <div class="ml-1">
                                        {{item.medico}}
                                    </div>
                                </div>
                                <div>
                                    <span class="ml-1 badge badge-counter">{{counterRow(item.medico)}}</span>
                                </div>
                            </li>


                        </ul>
                    </div>

                    <h6 class="dropdown-header text-center text-primary">Ver por Día</h6>
                    <div class="container-fluid overflow-auto" >
                        <ul style="max-height: 10rem;" class="list-group list-group-flush">
                            <li
                                @click="handleFilter({tipo_filtro:'fecha',filtro_valor:item})"
                                class="cursor-pointer list-group-item py-1 d-flex align-items-center justify-content-between list-group-item-action"
                                v-for="(item,index) in getFechasOptions"
                                :key="'filter_fec_'+index"
                                data-value="item"
                            >

                                <div>
                                    {{item}}
                                </div>

                                <div>
                                    <span class="ml-1 badge badge-counter">{{counterRow2(item)}}</span>
                                </div>
                            </li>

                        </ul>
                    </div>

                </div>
            </li>
        `,
        /** */
        computed:{
            getFechasOptions(){
                //console.log(this.dataEpisodio);
                return new Set( this.dataEpisodio.map(x=> {
                   /*  let fecha = (x.created_at.split(" "))[0]
                        fecha = (fecha.split("-"))[2]+"-"+(fecha.split("-"))[1]+"-"+(fecha.split("-"))[0] */
                    return x.fechaFormated
                }) )
            },
            getMedicosOptions(){
                //console.log("1---->",this.dataEpisodio[0].items);
                let that = this
                let equipoMedico = new Set(this.dataEpisodio.map(x=>x.items ).flat().map(x=>x.medico) )
                let tempEquipoMedico = {
                    orderByTeem:{
                        'Tratante':[],
                        'Interconsultante':[],
                        'Fellows':[],
                        'Residentes':[],
                        'RAMH':[],
                        'Enfermería':[],
                    },
                    orderByName:[

                    ],

                }
                    equipoMedico.forEach(x=>{
                        let temp = that.dataEpisodio.map(z=>z.items ).flat().find(z=>z.medico === x )


                            if(['Residentes'].includes(temp.dataMedico_posicion.nombre)){
                                tempEquipoMedico.orderByTeem[ 'Residentes' ].push({
                                    'medico': temp.medico,
                                    'posicion': temp.dataMedico_posicion,
                                })
                            }
                            if(['Fellow'].includes(temp.dataMedico_posicion.nombre)){
                                tempEquipoMedico.orderByTeem[ 'Fellows' ].push({
                                    'medico': temp.medico,
                                    'posicion': temp.dataMedico_posicion,
                                })
                            }
                            if(['RAMH',"Tratante","Enfermería","Interconsultante"].includes(temp.dataMedico_posicion.nombre)){
                                tempEquipoMedico.orderByTeem[ temp.dataMedico_posicion.nombre ].push({
                                    'medico': temp.medico,
                                    'posicion': temp.dataMedico_posicion,
                                })
                            }

                            tempEquipoMedico.orderByName.push({
                                'medico': temp.medico,
                                'posicion': temp.dataMedico_posicion,
                            })
                    })
          

                    tempEquipoMedico.orderByTeem[ 'Tratante' ] = tempEquipoMedico.orderByTeem[ 'Tratante' ].sort((a, b) => a.medico.length - b.medico.length);
                    tempEquipoMedico.orderByTeem[ 'Interconsultante' ] = tempEquipoMedico.orderByTeem[ 'Interconsultante' ].sort((a, b) => a.medico.length - b.medico.length);
                    tempEquipoMedico.orderByTeem[ 'Residentes' ] = tempEquipoMedico.orderByTeem[ 'Residentes' ].sort((a, b) => a.medico.length - b.medico.length);
                    tempEquipoMedico.orderByTeem[ 'Fellows' ] = tempEquipoMedico.orderByTeem[ 'Fellows' ].sort((a, b) => a.medico.length - b.medico.length);
                    tempEquipoMedico.orderByTeem[ 'Residentes' ] = tempEquipoMedico.orderByTeem[ 'Residentes' ].sort((a, b) => a.medico.length - b.medico.length);
                    tempEquipoMedico.orderByTeem[ 'RAMH' ] = tempEquipoMedico.orderByTeem[ 'RAMH' ].sort((a, b) => a.medico.length - b.medico.length);
                    tempEquipoMedico.orderByTeem[ 'Enfermería' ] = tempEquipoMedico.orderByTeem[ 'Enfermería' ].sort((a, b) => a.medico.length - b.medico.length);

                    tempEquipoMedico.orderByName = tempEquipoMedico.orderByName.sort((a, b) => a.medico.length - b.medico.length);

               return tempEquipoMedico
            }
        },
        methods:{
            counterRow(medico){
                return this.dataEpisodio.map(x=>x.items ).flat().filter(x=> x.medico === medico ).length
            },
            counterRow2(fechaFormated){
                return this.dataEpisodio.filter(x=>x.fechaFormated === fechaFormated ).map(x=>x.items).flat().length
            },
            handleFilter(data){

                this.filterActive =true
                let {tipo_filtro,filtro_valor} = data
                this.tipo_filtro = tipo_filtro
                this.filtro_valor = filtro_valor
                this.$emit('update-filtro', {tipo_filtro: this.tipo_filtro, itemName:this.currentItem,  filtro_valor: this.filtro_valor});
            },
            /* dropdownStop(e){
                 e.stopPropagation();
            }, */

        }
    }
}
let AppLaboratorio = ()=>{
    let newAppTemplate = AppTemplate1ForFiles
        newAppTemplate.name = "AppLaboratorio"
    return newAppTemplate
}
let AppImagenes = ()=>{
    let newAppTemplate = AppTemplate1ForFiles
        newAppTemplate.name = "AppImagenes"
    return newAppTemplate
}
let AppFotografias = ()=>{
    let newAppTemplate = AppTemplate1ForFiles
        newAppTemplate.name = "AppFotografias"
    return newAppTemplate
}
let AppOtrosArchivos = ()=>{
    let newAppTemplate = AppTemplate1ForFiles
        newAppTemplate.name = "AppOtrosArchivos"
    return newAppTemplate
}
let AppProbabilidadDiagnostica = ()=>{
    let newAppTemplate = AppTemplate1ForFiles
        newAppTemplate.name = "AppProbabilidadDiagnostica"
    return newAppTemplate
}
let AppEvolucion = ()=>{
    let newAppTemplate = AppTemplate1ForFiles
        newAppTemplate.name = "AppEvolucion"
    return newAppTemplate
}
let AppOrdenMedica = ()=>{
    let newAppTemplate = AppTemplate1ForFiles
        newAppTemplate.name = "AppOrdenMedica"
    return newAppTemplate
}
let AppPlan = ()=>{
    let newAppTemplate = AppTemplate1ForFiles
        newAppTemplate.name = "AppPlan"
    return newAppTemplate
}
let AppRecipe = ()=>{
    let newAppTemplate = AppTemplate1ForFiles
        newAppTemplate.name = "AppRecipe"
    return newAppTemplate
}
let AppObservacion = ()=>{
    let newAppTemplate = AppTemplate1ForFiles
        newAppTemplate.name = "AppObservacion"
    return newAppTemplate
}
let AppEstudioDiagnostico = ()=>{
    let newAppTemplate = AppTemplate1ForFiles
        newAppTemplate.name = "AppEstudioDiagnostico"
    return newAppTemplate
}
let AppAntecedenteComorbilidad = ()=>{
    let newAppTemplate = AppTemplate2ForFiles
        newAppTemplate.name = "AppAntecedenteComorbilidad"
    return newAppTemplate
}


let AppListAll = ()=>{

    return {
        name:"AppListAll",
        props:{

            currentItem:String,
            patient_data:Object,
            dataEpisodio:Array,
            index:Number,
        },
        template:/*html */`
            <div class="flex-fill d-flex flex-column overflow-auto">
                <ul class="nav bg-light justify-content-between nav-pills" id="pills-tab" role="tablist">

                    <app-filter
                        :tipo_filtro="tipo_filtro"
                        :filtro_valor="filtro_valor"
                        @update-filtro="updateFiltro"
                        :currentItem="currentItem"
                        :dataEpisodio="dataEpisodio"
                    />
                    <li
                        v-if="index !== 0"
                        class="d-none nav-item" role="presentation"

                    >
                        <a
                            class="nav-link currentItem"
                            id="pills-createItem-tab"
                            data-toggle="pill"
                            href="#pills-createItem"
                            role="tab"
                            aria-controls="pills-createItem"
                            aria-selected="false"

                        >
                            <h3 class="mb-0">Agregar {{currentItem}}</h3>
                        </a>
                    </li>
                </ul>
                <div class="flex-fill tab-content d-flex flex-column overflow-auto" id="pills-tabContent">
                    <div
                        class="tab-pane overflow-auto fade show active"
                        id="pills-listItems"
                        role="tabpanel"
                        aria-labelledby="pills-listItems-tab"
                    >
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 p-1">
                                    <div
                                        v-if="dataEpisodio.length > 0"
                                        class="timeline timeline-inverse"
                                    >
                                        <!-- FECHA DEL DIA -->
                                        <div v-for="(item,index) in dataEpisodio" :key="index">

                                            <div
                                                v-if="item.items.length !== item.items.filter(x=>!x.active).length"
                                                class="time-label">
                                                <span class="bg-primary"
                                            >
                                                    {{ item.fechaFormated }}
                                                </span>
                                            </div>

                                            <div
                                                v-for="(item2,index2) in item.items"
                                                :key="index2"
                                                v-show="item2.active"
                                            >

                                                <i
                                                    :class="['timelime-medic-icon fas fa-user-md',{'bg-primary text-white':medicOrEnfermery(item2)==='medic'},{'bg-warning text-dark':medicOrEnfermery(item2)==='enfermery'}]"
                                                    aria-hidden="true">
                                                </i>
                                                <div class="timeline-item">
                                                    <span class="time">
                                                        <i class="far fa-clock"></i>
                                                        {{ item2.fechaItem }}
                                                        <span class="text-primary">|</span>
                                                        {{ item2.hora }}
                                                        <a
                                                            :class="['m-0 p-0',{'d-none':noImprimir(item2.description)}]"
                                                            type="button"
                                                            @click="imprimir(item2)"
                                                            :content="'Imprimir'"

                                                        >
                                                            <i

                                                                class="imprimir m-0 p-0 fas fa-print text-info heartbeat"
                                                                style="font-size: 1em;cursor:pointer; margin-left:1em;"
                                                                aria-hidden="true">
                                                            </i>
                                                        </a>
                                                    </span>
                                                    <h3
                                                        data-toggle="collapse"
                                                        :href="'#collapseExample'+index2"
                                                        role="button"
                                                        aria-expanded="false"
                                                        aria-controls="collapseExample"
                                                        class="timeline-header"
                                                    >
                                                        <b>{{ item2.description }}</b> |
                                                        <b class="text-primary">{{ item2.dataMedico  !== undefined ? item2.dataMedico.prefijo : '' }} {{ item2.dataMedico !== undefined  ? item2.dataMedico.medico : '' }}</b>
                                                        <span
                                                            :content="'Equipo '+item2.dataMedico_posicion.nombre"

                                                            :class="['badge  scale-in-hor-left',('badge-'+item2.dataMedico_posicion.color)]"
                                                            style="width:2em;">
                                                            {{ item2.dataMedico_posicion.siglas }}
                                                        </span>


                                                    </h3>
                                                    <div
                                                        v-if="!['Récipe'].includes(item2.description)"
                                                        :id="'collapseExample'+index2"
                                                        class="collapse show timeline-body"
                                                        v-html="item2.dato"
                                                    >
                                                    </div>
                                                    <div 
                                                        v-else
                                                        :id="'collapseExample'+index2"
                                                        class="collapse show timeline-body">
                                                        {{validateRecipeData(item2.dato)}}
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="far fa-clock bg-secondary rounded-circle text-white"></i>
                                        </div>
                                    </div>
                                    <div v-else class="timeline timeline-inverse">
                                        <div>
                                            <div>
                                                <div class="timeline-item">
                                                    <div class="timeline-body text-secondary text-center">
                                                        No posee historia este día
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="tab-pane fade flex-fill flex-column" id="pills-createItem" role="tabpanel" aria-labelledby="pills-profile-tab">                        Formulario
                    </div>
                </div>
                <div class="d-none bg-danger p-4"></div>
            </div>



        `,
        components:{
            "app-filter":AppFilter(),
            //"app-row-timeline":AppRowTimeline()
        },
        data() {
            return {
                logoURL:'../image/system/logo-cmdlt-color.png', //logo CMDLT
                pdfData:{ //datos del pdf
                    pdfName:"recipe",
                    created_at:null, //fecha de creacion
                    
                    medicExt:null, // extencion telefonica del medico
                    medicName:null, // nombre del medico
                    medicCI:null, // cedula del medico
                    medicMPPS:null, // MPPS del medico
                    medicSchoolNumber:null, // numero de colegio del medico
                    medicSignatureURL:null, //firma
                    medicStampURL:null, //sello
                    medicEspecialities: null, //especialidades
    
                    patientAge:null, //edad del paciente
                    patientCI:null, //CI del paciente
                    patientName:null, //nombre del paciente
                    
                    medications:[], //medicaciones
                    
                },
                tipo_filtro:"",
                filtro_valor:"",
                registros:[]
            }
        },
        methods: {
            //init pdf
            getFooterDirection( pageSize) {
                return [
                        {
                            canvas: [
                            {
                                type: 'rect',
                                x: 0,
                                y: 60,
                                w: pageSize.width,
                                h: 40,
                                color: '#1c71ce',
                            },
                            ],
                        },
                        {
                            alignment: 'justify',
                            fontSize: 5,
                            absolutePosition: { x: 0, y: 53 },
                            padding: [0, 0, 0, 30],
                            columns: [
                            'leftSide',
                            'rightSide',
                            ].map((h) => {
                            return {
                                lineHeight: 0.5,
                                color: '#fff',
                                margin: [10, 10, 0, 20],
                                columns: [
                                {
                                    text: [
                                    `
                                    Avenida intercomunal La Trinidad El Hatillo,\n 
                                    Apartado postal 80474 Caracas 1080-A\n 
                                    Teléfonos: (+58) 0212 -949.6411 (central)\n 
                                    Fax: (+58) 0212 -945.6346\n 
                                    Rif: J-00058551-2
                                `,
                                    ],
                                    alignment: 'left',
                                },
                                {
                                    text: [`www.cmdlt.edu.ve`],
                                    alignment: 'right',
                                    marginRight: 10,
                                },
                                ],
                            };
                            }),
                        },
                    ];
            },

            async getImageBase64(imgURL){
                const response = await fetch(imgURL);

                if(response.status !== 200){
                    return undefined;
                }

                const blob = await response.blob();

                // Verificar si el archivo es PNG o JPG
                if (blob.type !== 'image/png' && blob.type !== 'image/jpeg') {
                    console.error('El archivo no es un PNG o JPG');
                    return undefined;
                }

                const reader = new FileReader();

                const logoDataURL = await new Promise((resolve, reject) => {
                    reader.onload = () => resolve(reader.result);
                    reader.onerror = () => reject(reader.error);
                    reader.readAsDataURL(blob);
                });

                return logoDataURL;
                },

            async getSignatureAndStamp(xPosition) {
                this.signature = '../'+this.pdfData.medicSignatureURL
                this.stamp = '../'+this.pdfData.medicStampURL
                const signatureBase64 = this.signature
                    ? await this.getImageBase64(this.signature)
                    : undefined;
                const stampBase64 = this.stamp
                    ? await await this.getImageBase64(this.stamp)
                    : undefined;
                
                const signatureAndStamp = [];

                if (signatureBase64) {
                    signatureAndStamp.push({
                    image: signatureBase64,
                    fit: [100, 80],
                    absolutePosition: { x: xPosition, y: -25 },
                    });
                }

                if (stampBase64) {
                    signatureAndStamp.push({
                    image: stampBase64,
                    fit: [100, 80],
                    absolutePosition: { x: xPosition, y: 0 },
                    });
                }

                return signatureAndStamp;
            },

            getRecipeIndications(counter,indications,) {
                return {
                color: '#000',
                width: '48%',
                text: (counter && counter + '. ') + indications,
                fontSize: 10,
                margin: [ 20, 15, 30, 0],
                };
            },

            async getMedicData(recipe){
                
                const getSignatureAndStampL = await this.getSignatureAndStamp(280);

                const getSignatureAndStampR = await this.getSignatureAndStamp(700);

                const createdUserL = this.getCreatedUser();

                const createdUserR = this.getCreatedUser();

                return [
                {
                    alignment: 'justify',
                    fontSize: 8,
                    absolutePosition: { x: 0, y: -7 },
                    padding: [0, 0, 0, 30],
                    columns: [
                    {
                        lineHeight: 0.9,
                        color: '#000',
                        margin: [10, 10, 0, 20],
                        columns: [
                        createdUserL,
                        {
                            text: 'Firma y sello',
                            columns: getSignatureAndStampL,
                        },
                        ],
                    },
                    {
                        lineHeight: 0.9,
                        color: '#000',
                        margin: [10, 10, 0, 20],
                        columns: [
                        createdUserR,
                        {
                            text: 'Firma y sello',
                            columns: getSignatureAndStampR,
                        },
                        ],
                    },
                    ],
                },
                ];
            },
            
            getRecipeMedications(number, recipe) {
                return {
                margin: [0, 15, 0, 0],
                color: '#000',
                width: '48%',
                stack: [
                    {
                    text: number + '. ' + recipe.name,
                    },
                    {
                    text: [
                        { text: ` ` },
                        { text: `        ${recipe.presentation ? recipe.presentation : ''}` },
                        { text: ` ` },
                        { text: `${recipe.units ? recipe.units : ''}` },
                    ],
                    },
                ],
                };
            },

            getCreatedUser() {
            
                const speciality = this.pdfData.medicEspecialities
                    ? '/ ' + this.pdfData.medicEspecialities.map((us) => us).join(', ')
                    : '';
    
                return {
                    text: 'Datos del médico',
                    columns: [
                        {
                            stack: [
                            { text: 'Datos del médico', bold: true },
                            {
                                text: `${this.pdfData.medicExt ? '(' + this.pdfData.medicExt + ') ' : ''}${this.pdfData.medicName} ${speciality}`,
                            },
                            {
                                text: [
                                { text: 'C.I.: ' },
                                {
                                    text: this.pdfData.medicCI || '',
                                },
                                ],
                            },
                            {
                                text: [
                                { text: 'Colegio de Médicos: ' },
                                { text: this.pdfData.medicSchoolNumber || '' },
                                ],
                            },
                            {
                                text: [{ text: 'MPPS: ' }, { text: this.pdfData.medicMPPS || '' }],
                            },
                            ],
                            unbreakable: true,
                        },
                    ],
                };
            },
            dateFormat(dateStr) {
                const date = new Date(dateStr); 
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0'); 
                const day = String(date.getDate()).padStart(2, '0');

                return `${day}/${month}/${year}`;
            },    
            async printPdf(item){
                
                this.pdfData.created_at = this.dateFormat(item.created_at)
                this.pdfData.patientAge = this.patient_data.edad
                this.pdfData.patientCI = this.patient_data.cedula_formated
                this.pdfData.patientName = this.patient_data.paciente
                if (this.esArrayDeObjetos(item.dato)) {
                    this.pdfData.medications = JSON.parse(item.value)
                }else{
                    this.pdfData.medications = [{
                        presentation:'',
                        name:item.value,
                        indications:'',
                        unit:''
                    }]
                }
                this.pdfData.medicExt = item.extencion_telefonica
                this.pdfData.medicName = item.medico
                this.pdfData.medicCI = item.medico_cedula
                this.pdfData.medicMPPS = item.mpps
                this.pdfData.medicSchoolNumber = item.colegio_medico
                this.pdfData.medicSignatureURL = item.firma
                this.pdfData.medicStampURL = item.sello
                this.pdfData.medicEspecialities = item.medico_especialidades ? item.medico_especialidades.split(',') : []
             
                
                //Logo cmdlt
                const logoBase64 = await this.getImageBase64(this.logoURL); 
                
                //cintillo inferior del recipe
                const footerDirection = this.getFooterDirection;
            
                //datos del medico / sello / firma
                const medicData =  await this.getMedicData();

                const docDefinition = {
                    pageSize: 'A4',
                    pageOrientation: 'landscape',
                    pageMargins: [20, 120, 20, 100],
                    header: {
                    stack: [
                        {
                        margin: [0, 10, 0, 0],
                        alignment: 'justify',
                        columns: [
                            {
                            marginRight: 10,
                            image: logoBase64,
                            fit: [120, 80],
                            alignment: 'right',
                            },
                            {
                            marginRight: 10,
                            image: logoBase64,
                            fit: [120, 80],
                            alignment: 'right',
                            }
                        ],
                        },
                        {
                        alignment: 'justify',
                        columns: ['leftSide', 'rightSide'].map((h, index) => {
                            return {
                            margin: [20, 10, 20, 10],
                            columns: [
                                {
                                fontSize: 12,
                                text: h === 'leftSide'
                                ? 'Récipe'
                                : 'Indicaciones',
                                bold: true,
                                },
                                {
                                margin: [0, 0, 3, 0],
                                alignment: 'right',
                                text: [
                                    {
                                    text: 'Fecha: ',
                                    bold: true,
                                    },
                                    {
                                    color: '#000',
                                    text: this.pdfData.created_at ? this.pdfData.created_at : 'No disponible',
                                    },
                                ],
                                },
                            ],
                            };
                        }),
                        },
                        {
                        alignment: 'justify',
                        columns: [
                            'leftSide',
                            'rightSide',
                        ]
                            .filter(Boolean)
                            .map((h) => {
                            return {
                                margin: [20, 0, 10, 5],
                                text: [
                                {
                                    text: 'Nombre y apellido: ',
                                    bold: true,
                                },
                                {
                                    color: '#000',
                                    text: this.pdfData.patientName ? this.pdfData.patientName : 'No disponible',
                                },
                                ],
                            };
                            }),
                        },
                        {
                        alignment: 'justify',
                        columns: [
                            'leftSide',
                            'rightSide',
                        ]
                            .filter(Boolean)
                            .map((h) => {
                            return {
                                margin: [20, 0, 20, 0],
                                text: [
                                {
                                    text: 'C.I: ',
                                    bold: true,
                                },
                                {
                                    color: '#000',
                                    text: this.pdfData.patientCI ? this.pdfData.patientCI : 'No disponible',
                                },
                                {
                                    text: '    ',
                                },
                                {
                                    text: 'Edad: ',
                                    bold: true,
                                },
                                {
                                    color: '#000',
                                    text: this.pdfData.patientAge + ' año' +
                                    (this.pdfData.patientAge !== 1
                                        ? 's'
                                        : ''),
                                },
                                ],
                            };
                            }),
                        },
                    ],
                    },
                    content: this.pdfData.medications.map((item, index) => {
                    return {
                        margin: [0, 10, 0, 0],
                        alignment: 'justify',
                        unbreakable: true,
                        columns: [
                        this.getRecipeMedications(index + 1, item) ,
                        { width: '4%', text: ' ' },
                        this.getRecipeIndications(index + 1, item.indications),
                        ],
                    };
                    }) ,
                    footer: function (currentPage, pageCount, pageSize) {
                    return [...medicData, ...footerDirection( pageSize)];
                    }, 
                    styles: {
                    header: {
                        fontSize: 12,
                        bold: true,
                    },
                    },
                    defaultStyle: {
                    fontSize: 10,
                    color: '#1c71ce',
                    },
                };
                //datos del paciente
                


                
                pdfMake.createPdf(docDefinition).download(
                    this.pdfData.pdfName + 
                    '-' +
                    (this.pdfData.patientName ? (this.pdfData.patientName).replace(/ /g, "") : 'patientName') + 
                    '-' +
                    (this.pdfData.created_at ? ((this.pdfData.created_at).split(' '))[0] : 'created_at') + 
                    '.pdf');

            },
            esArrayDeObjetos(str) {
                try {
                // Intentamos convertir el string en JSON
                const json = JSON.parse(str);
                
                // Verificamos que sea un array
                if (Array.isArray(json)) {
                    // Verificamos que todos los elementos del array sean objetos
                    return json.every(item => typeof item === 'object' && item !== null);
                }
                
                return false;
                } catch (e) {
                // Si ocurre un error al parsear, no es un JSON válido
                return false;
                }
            },
            //end pdf
         
            validateRecipeData(item){
            
                if (this.esArrayDeObjetos(item)) {
                    return JSON.parse(item).map(x=>x.name).join(", ")
                }else{
                    return item
                }
               
            },
            medicOrEnfermery(item){
              
                try {


                    if([1,2,3,4,5,6,7,8,9].includes(Number(item.dataMedico.posicion_id))){
                        return "medic"
                    }
                    if([10].includes(Number(item.dataMedico.posicion_id))){
                        return "enfermery"
                    }
                } catch (error) {
                     console.log("data medico: ",item)
                }
                return "not-found"
            },
            noImprimir(description){
                if([
                    "Fotografías",
                    "Pendiente",
                    "Probabilidad diagnóstica",
                    "Plan",
                    "Observación",
                    "Laboratorio",
                    "Imagenes",
                    "Otro",

                ].includes(description)){
                    return true
                }else{
                    return false
                }
            },
            imprimir(item){
            //imprimir(name,id){
                const {description:name,id} = item
                let description = "";
                let type = "one"
                switch(name){
                    case "Orden Médica": description = "orden_medica"; break;
                    case "Evolución": description = "evolucion"; break;
                    case "Pendiente": description = "pendiente"; break;
                    case "Probabilidad diagnóstica": description = "probabilidad_diagnostica"; break;
                    case "Plan": description = "plan"; break;
                    case "Observación": description = "observacion"; break;
                    case "Récipe": description = "recipe"; break;
                    case "Estudio Diagnóstico": description = "estudio_diagnostico"; break;
                    case "Laboratorio": description = "laboratorio"; break;
                    case "Imagenes": description = "imagenes"; break;
                    case "Otro": description = "otro"; break;
                    default: alert("Error. Reporte no encotrado"); return false; break;
                }
                //Los siguientes informes no se imprimen

                if (['Orden Médica'].includes(name)) {
                    window.open(location.origin+`/user/informe/omed/orden_medica/${this.patient_data.episodio_id}/${id}`)
                    return false
                }
                if (['Evolución'].includes(name)) {
                    window.open(location.origin+`/user/informe/nde/evolucion_medica/${this.patient_data.episodio_id}/${id}`)
                    return false
                }
                
                if (['Récipe'].includes(name)) {
                        this.printPdf( item )
                    return false
                }
                if (type==="one") {

                    window.open(`/user/reporte/${description}/${this.patient_data.episodio_id}/${id}/mono`)

                }else{
                    window.open(`/user/reporte/${description}/${this.patient_data.episodio_id}/all/mono`)
                }
            },
            updateFiltro(data) {

                this.tipo_filtro = data.tipo_filtro;
                this.filtro_valor = data.filtro_valor;
                this.showRow()

            },
            showRow(){
                if(this.filtro_valor === null){
                    this.registros.map(x=>{
                        x.active = true
                    })
                    return false
                }
                if (this.tipo_filtro==="medico") {
                    this.registros.map(x=>{
                        if(x.medico === this.filtro_valor){
                            x.active = true
                        }else{
                            x.active = false
                        }
                        return x
                    })
                }
                if (this.tipo_filtro==="fecha") {
                    this.registros.map(x=>{
                        if(x.fechaItem === this.filtro_valor){
                            x.active = true
                        }else{
                            x.active = false
                        }
                        return x
                    })
                }

            },
            getAllByDay(fecha){

                return this.registros.filter(x=> x.fechaFormated === fecha).map(x=>x.items ).flat()
            },
        },
        async mounted () {
            this.registros = this.dataEpisodio.map(x=>x.items ).flat()


        },
    }
}
let AppTemplate1ForFiles = {
    name:"App",
    props:{
        updateParentData:Function,
        buttonsState:Boolean,
        updateComponentToReturn:Function,
        currentItem:String,
        patient_data:Object,
        dataEpisodio:Array,
        index:Number,
        currentComponent: Function,
    },
    template:/*html */`
            <div class="flex-fill d-flex flex-column overflow-auto">
                <ul class="nav bg-light justify-content-between nav-pills" id="pills-tab" role="tablist">

                    <app-filter
                        :tipo_filtro="tipo_filtro"
                        :filtro_valor="filtro_valor"
                        @update-filtro="updateFiltro"
                        :currentItem="currentItem"
                        :dataEpisodio="dataEpisodio"
                    />
                    <li

                        class="nav-item" role="presentation"
                        @click="sendDataToParent"
                    >
                        <a

                            class="nav-link currentItem"
                            id="pills-createItem-tab"
                            data-toggle="pill"
                            href="#pills-createItem"
                            role="tab"
                            aria-controls="pills-createItem"
                            aria-selected="false"
                        >
                            <h3 class="mb-0">Agregar {{currentItem}}</h3>
                        </a>
                    </li>
                </ul>
                <div class="flex-fill tab-content d-flex flex-column overflow-auto" id="pills-tabContent">
                    <div
                        class="tab-pane overflow-auto fade show active"
                        id="pills-listItems"
                        role="tabpanel"
                        aria-labelledby="pills-listItems-tab"
                    >
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 p-1">
                                    <div
                                        v-if="dataEpisodio.length > 0"
                                        class="timeline timeline-inverse"
                                    >
                                        <!-- FECHA DEL DIA -->
                                        <div v-for="(item,index) in dataEpisodio" :key="index">

                                            <div
                                                v-if="item.items.length !== item.items.filter(x=>!x.active).length"
                                                class="time-label">
                                                <span class="bg-primary"
                                            >
                                                    {{ item.fechaFormated }}
                                                </span>
                                            </div>

                                            <div
                                                v-for="(item2,index2) in item.items"
                                                :key="index2"
                                                v-show="item2.active"
                                            >

                                                <i
                                                    :class="['timelime-medic-icon fas fa-user-md',{'bg-primary text-white':medicOrEnfermery(item2)==='medic'},{'bg-warning text-dark':medicOrEnfermery(item2)==='enfermery'}]"
                                                    aria-hidden="true">
                                                </i>
                                                <div class="timeline-item">
                                                    <span class="time">
                                                        <i class="far fa-clock"></i>
                                                        {{ item2.fechaItem }}
                                                        <span class="text-primary">|</span>
                                                        {{ item2.hora }}
                                                        <a
                                                            :class="['m-0 p-0',{'d-none':noImprimir(item2.description)}]"
                                                            type="button"
                                                            @click="imprimir(item2)"
                                                            :content="'Imprimir'"

                                                        >
                                                            <i

                                                                class="imprimir m-0 p-0 fas fa-print text-info heartbeat"
                                                                style="font-size: 1em;cursor:pointer; margin-left:1em;"
                                                                aria-hidden="true">
                                                            </i>
                                                        </a>
                                                    </span>
                                                    <h3
                                                        data-toggle="collapse"
                                                        :href="'#collapseExample'+index2"
                                                        role="button"
                                                        aria-expanded="false"
                                                        aria-controls="collapseExample"
                                                        class="timeline-header"
                                                    >
                                                        <b>{{ item2.description }}</b> |
                                                        <b class="text-primary">{{ item2.dataMedico !== undefined ? item2.dataMedico.prefijo : '' }} {{ item2.dataMedico !== undefined ? item2.dataMedico.medico : '' }}</b>
                                                        <span
                                                            :content="'Equipo '+item2.dataMedico_posicion.nombre"

                                                            :class="['badge  scale-in-hor-left',('badge-'+item2.dataMedico_posicion.color)]"
                                                            style="width:2em;">
                                                            {{ item2.dataMedico_posicion.siglas }}
                                                        </span>


                                                    </h3>
                                                    <div
                                                        v-if="!['Récipe'].includes(item2.description)"
                                                        :id="'collapseExample'+index2"
                                                        class="collapse show timeline-body"
                                                        v-html="item2.dato"
                                                    >
                                                    </div>
                                                    <div 
                                                        v-else
                                                        :id="'collapseExample'+index2"
                                                        class="collapse show timeline-body">
                                                        {{validateRecipeData(item2.dato)}}
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="far fa-clock bg-secondary rounded-circle text-white"></i>
                                        </div>
                                    </div>
                                    <div v-else class="timeline timeline-inverse">
                                        <div>
                                            <div>
                                                <div class="timeline-item">
                                                    <div class="timeline-body text-secondary text-center">
                                                        No posee historia este día
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="tab-pane fade flex-fill flex-column" id="pills-createItem" role="tabpanel" aria-labelledby="pills-profile-tab">

                        <component
                            :is="currentComponent"
                            :currentItem="currentItem"
                        ></component>
                    </div>
                </div>
                <div class="d-none bg-danger p-4"></div>
            </div>



        `,
    components:{
        "app-list-items-historia":AppListItemsHistoria(),
        "app-create-item-file":AppCreateItemFile(),
        "app-create-recipe":AppCreateRecipe(),
        "app-filter":AppFilter(),
        "app-row-timeline":AppRowTimeline()
    },
    data() {
        return {
            logoURL:'../image/system/logo-cmdlt-color.png', //logo CMDLT
            pdfData:{ //datos del pdf
                pdfName:"recipe",
                created_at:null, //fecha de creacion
                
                medicExt:null, // extencion telefonica del medico
                medicName:null, // nombre del medico
                medicCI:null, // cedula del medico
                medicMPPS:null, // MPPS del medico
                medicSchoolNumber:null, // numero de colegio del medico
                medicSignatureURL:null, //firma
                medicStampURL:null, //sello
                medicEspecialities: null, //especialidades
  
                patientAge:null, //edad del paciente
                patientCI:null, //CI del paciente
                patientName:null, //nombre del paciente
                
                medications:[], //medicaciones
                
            },
            currentComponent:null,
            tipo_filtro:"",
            filtro_valor:"",
            registros:[]
        }
    },
    methods: {
        //init pdf
        getFooterDirection( pageSize) {
            return [
                    {
                        canvas: [
                        {
                            type: 'rect',
                            x: 0,
                            y: 60,
                            w: pageSize.width,
                            h: 40,
                            color: '#1c71ce',
                        },
                        ],
                    },
                    {
                        alignment: 'justify',
                        fontSize: 5,
                        absolutePosition: { x: 0, y: 53 },
                        padding: [0, 0, 0, 30],
                        columns: [
                        'leftSide',
                        'rightSide',
                        ].map((h) => {
                        return {
                            lineHeight: 0.5,
                            color: '#fff',
                            margin: [10, 10, 0, 20],
                            columns: [
                            {
                                text: [
                                `
                                Avenida intercomunal La Trinidad El Hatillo,\n 
                                Apartado postal 80474 Caracas 1080-A\n 
                                Teléfonos: (+58) 0212 -949.6411 (central)\n 
                                Fax: (+58) 0212 -945.6346\n 
                                Rif: J-00058551-2
                            `,
                                ],
                                alignment: 'left',
                            },
                            {
                                text: [`www.cmdlt.edu.ve`],
                                alignment: 'right',
                                marginRight: 10,
                            },
                            ],
                        };
                        }),
                    },
                ];
        },

        async getImageBase64(imgURL){
            const response = await fetch(imgURL);

            if(response.status !== 200){
                return undefined;
            }

            const blob = await response.blob();

            // Verificar si el archivo es PNG o JPG
            if (blob.type !== 'image/png' && blob.type !== 'image/jpeg') {
                console.error('El archivo no es un PNG o JPG');
                return undefined;
            }

            const reader = new FileReader();

            const logoDataURL = await new Promise((resolve, reject) => {
                console.log(reader);
                reader.onload = () => resolve(reader.result);
                reader.onerror = () => reject(reader.error);
                reader.readAsDataURL(blob);
            });

            return logoDataURL;
        },

        async getSignatureAndStamp(xPosition) {
            this.signature = '../'+this.pdfData.medicSignatureURL
            this.stamp = '../'+this.pdfData.medicStampURL
            const signatureBase64 = this.signature
                ? await this.getImageBase64(this.signature)
                : undefined;
            const stampBase64 = this.stamp
                ? await await this.getImageBase64(this.stamp)
                : undefined;

            const signatureAndStamp = [];

            if (signatureBase64) {
                signatureAndStamp.push({
                image: signatureBase64,
                fit: [100, 80],
                absolutePosition: { x: xPosition, y: -25 },
                });
            }

            if (stampBase64) {
                signatureAndStamp.push({
                image: stampBase64,
                fit: [100, 80],
                absolutePosition: { x: xPosition, y: 0 },
                });
            }

            return signatureAndStamp;
        },

        getRecipeIndications(counter,indications,) {
            return {
            color: '#000',
            width: '48%',
            text: (counter && counter + '. ') + indications,
            fontSize: 10,
            margin: [ 20, 15, 30, 0],
            };
        },

        async getMedicData(recipe){
            
            const getSignatureAndStampL = await this.getSignatureAndStamp(280);

            const getSignatureAndStampR = await this.getSignatureAndStamp(700);

            const createdUserL = this.getCreatedUser();

            const createdUserR = this.getCreatedUser();

            return [
            {
                alignment: 'justify',
                fontSize: 8,
                absolutePosition: { x: 0, y: -7 },
                padding: [0, 0, 0, 30],
                columns: [
                {
                    lineHeight: 0.9,
                    color: '#000',
                    margin: [10, 10, 0, 20],
                    columns: [
                    createdUserL,
                    {
                        text: 'Firma y sello',
                        columns: getSignatureAndStampL,
                    },
                    ],
                },
                {
                    lineHeight: 0.9,
                    color: '#000',
                    margin: [10, 10, 0, 20],
                    columns: [
                    createdUserR,
                    {
                        text: 'Firma y sello',
                        columns: getSignatureAndStampR,
                    },
                    ],
                },
                ],
            },
            ];
        },
        
        getRecipeMedications(number, recipe) {
            return {
            margin: [0, 15, 0, 0],
            color: '#000',
            width: '48%',
            stack: [
                {
                text: number + '. ' + recipe.name,
                },
                {
                text: [
                    { text: ` ` },
                    { text: `        ${recipe.presentation ? recipe.presentation : ''}` },
                    { text: ` ` },
                    { text: `${recipe.units ? recipe.units : ''}` },
                ],
                },
            ],
            };
        },

        getCreatedUser() {
            
            const speciality = this.pdfData.medicEspecialities
                ? '/ ' + this.pdfData.medicEspecialities.map((us) => us).join(', ')
                : '';

            return {
                text: 'Datos del médico',
                columns: [
                    {
                        stack: [
                        { text: 'Datos del médico', bold: true },
                        {
                            text: `${this.pdfData.medicExt ? '(' + this.pdfData.medicExt + ') ' : ''}${this.pdfData.medicName} ${speciality}`,
                        },
                        {
                            text: [
                            { text: 'C.I.: ' },
                            {
                                text: this.pdfData.medicCI || '',
                            },
                            ],
                        },
                        {
                            text: [
                            { text: 'Colegio de Médicos: ' },
                            { text: this.pdfData.medicSchoolNumber || '' },
                            ],
                        },
                        {
                            text: [{ text: 'MPPS: ' }, { text: this.pdfData.medicMPPS || '' }],
                        },
                        ],
                        unbreakable: true,
                    },
                ],
            };
        },
        dateFormat(dateStr) {
            const date = new Date(dateStr); 
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0'); 
            const day = String(date.getDate()).padStart(2, '0');

            return `${day}/${month}/${year}`;
        },    
        async printPdf(item){
           
            this.pdfData.created_at = this.dateFormat(item.created_at)
            this.pdfData.patientAge = this.patient_data.edad
            this.pdfData.patientCI = this.patient_data.cedula_formated
            this.pdfData.patientName = this.patient_data.paciente
            if (this.esArrayDeObjetos(item.dato)) {
                this.pdfData.medications = JSON.parse(item.value)
            }else{
                this.pdfData.medications = [{
                    presentation:'',
                    name:item.value,
                    indications:'',
                    unit:''
                }]
            }
            
            this.pdfData.medicExt = item.extencion_telefonica
            this.pdfData.medicName = item.medico
            this.pdfData.medicCI = item.medico_cedula
            this.pdfData.medicMPPS = item.mpps
            this.pdfData.medicSchoolNumber = item.colegio_medico
            this.pdfData.medicSignatureURL = item.firma
            this.pdfData.medicStampURL = item.sello
            this.pdfData.medicEspecialities = item.medico_especialidades ? item.medico_especialidades.split(',') : []
            console.log("2", this.pdfData);
            
            //Logo cmdlt
            const logoBase64 = await this.getImageBase64(this.logoURL); 
            
            //cintillo inferior del recipe
            const footerDirection = this.getFooterDirection;
        
            //datos del medico / sello / firma
            const medicData =  await this.getMedicData();

            const docDefinition = {
                pageSize: 'A4',
                pageOrientation: 'landscape',
                pageMargins: [20, 120, 20, 100],
                header: {
                stack: [
                    {
                    margin: [0, 10, 0, 0],
                    alignment: 'justify',
                    columns: [
                        {
                        marginRight: 10,
                        image: logoBase64,
                        fit: [120, 80],
                        alignment: 'right',
                        },
                        {
                        marginRight: 10,
                        image: logoBase64,
                        fit: [120, 80],
                        alignment: 'right',
                        }
                    ],
                    },
                    {
                    alignment: 'justify',
                    columns: ['leftSide', 'rightSide'].map((h, index) => {
                        return {
                        margin: [20, 10, 20, 10],
                        columns: [
                            {
                            fontSize: 12,
                            text: h === 'leftSide'
                            ? 'Récipe'
                            : 'Indicaciones',
                            bold: true,
                            },
                            {
                            margin: [0, 0, 3, 0],
                            alignment: 'right',
                            text: [
                                {
                                text: 'Fecha: ',
                                bold: true,
                                },
                                {
                                color: '#000',
                                text: this.pdfData.created_at ? this.pdfData.created_at : 'No disponible',
                                },
                            ],
                            },
                        ],
                        };
                    }),
                    },
                    {
                    alignment: 'justify',
                    columns: [
                        'leftSide',
                        'rightSide',
                    ]
                        .filter(Boolean)
                        .map((h) => {
                        return {
                            margin: [20, 0, 10, 5],
                            text: [
                            {
                                text: 'Nombre y apellido: ',
                                bold: true,
                            },
                            {
                                color: '#000',
                                text: this.pdfData.patientName ? this.pdfData.patientName : 'No disponible',
                            },
                            ],
                        };
                        }),
                    },
                    {
                    alignment: 'justify',
                    columns: [
                        'leftSide',
                        'rightSide',
                    ]
                        .filter(Boolean)
                        .map((h) => {
                        return {
                            margin: [20, 0, 20, 0],
                            text: [
                            {
                                text: 'C.I: ',
                                bold: true,
                            },
                            {
                                color: '#000',
                                text: this.pdfData.patientCI ? this.pdfData.patientCI : 'No disponible',
                            },
                            {
                                text: '    ',
                            },
                            {
                                text: 'Edad: ',
                                bold: true,
                            },
                            {
                                color: '#000',
                                text: this.pdfData.patientAge + ' año' +
                                (this.pdfData.patientAge !== 1
                                    ? 's'
                                    : ''),
                            },
                            ],
                        };
                        }),
                    },
                ],
                },
                content: this.pdfData.medications.map((item, index) => {
                return {
                    margin: [0, 10, 0, 0],
                    alignment: 'justify',
                    unbreakable: true,
                    columns: [
                    this.getRecipeMedications(index + 1, item) ,
                    { width: '4%', text: ' ' },
                    this.getRecipeIndications(index + 1, item.indications),
                    ],
                };
                }) ,
                footer: function (currentPage, pageCount, pageSize) {
                return [...medicData, ...footerDirection( pageSize)];
                }, 
                styles: {
                header: {
                    fontSize: 12,
                    bold: true,
                },
                },
                defaultStyle: {
                fontSize: 10,
                color: '#1c71ce',
                },
            };
            //datos del paciente
            


            
            pdfMake.createPdf(docDefinition).download(
                this.pdfData.pdfName + 
                '-' +
                (this.pdfData.patientName ? (this.pdfData.patientName).replace(/ /g, "") : 'patientName') + 
                '-' +
                (this.pdfData.created_at ? ((this.pdfData.created_at).split(' '))[0] : 'created_at') + 
                '.pdf');

        },
        esArrayDeObjetos(str) {
            try {
              // Intentamos convertir el string en JSON
              const json = JSON.parse(str);
              
              // Verificamos que sea un array
              if (Array.isArray(json)) {
                // Verificamos que todos los elementos del array sean objetos
                return json.every(item => typeof item === 'object' && item !== null);
              }
              
              return false;
            } catch (e) {
              // Si ocurre un error al parsear, no es un JSON válido
              return false;
            }
        },
        //end pdf
    
        
        validateRecipeData(item){
          
            if (this.esArrayDeObjetos(item)) {
                return JSON.parse(item).map(x=>x.name).join(", ")
            }else{
                return item
            }
           
        },
        medicOrEnfermery(item){
    

            try {


                if([1,2,3,4,5,6,7,8,9].includes(Number(item.dataMedico.posicion_id))){
                    return "medic"
                }
                if([10].includes(Number(item.dataMedico.posicion_id))){
                    return "enfermery"
                }
            } catch (error) {
                 console.log("data medico: ",item)
            }
            return "not-found"
        },
        imprimir(item){
            const {description:name,id} = item
            
           
            let description = "";
            let type = "one"
            switch(name){
                case "Orden Médica": description = "orden_medica"; break;
                case "Evolución": description = "evolucion"; break;
                case "Pendiente": description = "pendiente"; break;
                case "Probabilidad diagnóstica": description = "probabilidad_diagnostica"; break;
                case "Plan": description = "plan"; break;
                case "Observación": description = "observacion"; break;
                case "Récipe": description = "recipe"; break;
                case "Estudio Diagnóstico": description = "estudio_diagnostico"; break;
                case "Laboratorio": description = "laboratorio"; break;
                case "Imagenes": description = "imagenes"; break;
                case "Otro": description = "otro"; break;
                default: alert("Error. Reporte no encotrado"); return false; break;
            }
            //Los siguientes informes no se imprimen

            if (['Orden Médica'].includes(name)) {
                window.open(location.origin+`/user/informe/omed/orden_medica/${this.patient_data.episodio_id}/${id}`)
                return false
            }
            if (['Evolución'].includes(name)) {
                window.open(location.origin+`/user/informe/nde/evolucion_medica/${this.patient_data.episodio_id}/${id}`)
                return false
                            }
            if (['Récipe'].includes(name)) {
                
                this.printPdf( item )
                return false
            }
            if (type==="one") {

                window.open(`/user/reporte/${description}/${this.patient_data.episodio_id}/${id}/mono`)

            }else{
                window.open(`/user/reporte/${description}/${this.patient_data.episodio_id}/all/mono`)
            }
        },
        noImprimir(description){
            if([
                "Fotografías",
                "Pendiente",
                "Probabilidad diagnóstica",
                "Plan",
                "Observación",
                "Laboratorio",
                "Imagenes",
                "Otro",

            ].includes(description)){
                return true
            }else{
                return false
            }
        },

        sendDataToParent() {
            let that = this
                this.buttonsState=false
                this.updateParentData( this.buttonsState );

                let component = "app-create-item-file"

                //aqui capturo si es un récipe y lo cambio a app-create-recipe
                if (that.currentItem === "Récipe") {
                    component = "app-create-recipe"
                }
                this.currentComponent = {
                    extends: this.$options.components[ component ],
                    props: {
                        currentComponent: {
                            type: Function,
                            default: that.currentComponent
                        },
                        updateComponentToReturn: {
                            type: Function,
                            default: that.updateComponentToReturn
                        },
                        currentItem: {
                            type: String,
                            default: that.currentItem
                        },
                        dataEpisodio: {
                            type: Array,
                            default: function(){
                                return that.dataEpisodio
                            }
                        },
                        patient_data: {
                            type: Object,
                            default: that.patient_data
                        },
                    }
                };
        },
        updateFiltro(data) {
            //alert(data)
            this.tipo_filtro = data.tipo_filtro;
            this.filtro_valor = data.filtro_valor;
            this.showRow()

        },
        showRow(){
            if(this.filtro_valor === null){
                this.registros.map(x=>{
                    x.active = true
                })
                return false
            }
            if (this.tipo_filtro==="medico") {
                this.registros.map(x=>{
                    if(x.medico === this.filtro_valor){
                        x.active = true
                    }else{
                        x.active = false
                    }
                    return x
                })
            }
            if (this.tipo_filtro==="fecha") {
                this.registros.map(x=>{
                    if(x.fechaItem === this.filtro_valor){
                        x.active = true
                    }else{
                        x.active = false
                    }
                    return x
                })
            }

        },
        getAllByDay(fecha){

            return this.registros.filter(x=> x.fechaFormated === fecha).map(x=>x.items ).flat()
        },
    },
    async mounted () {
        this.registros = this.dataEpisodio.map(x=>x.items ).flat()
    },
}
let AppTemplate2ForFiles = {
    name:"App",
    props:{
        updateParentData:Function,
        buttonsState:Boolean,
        updateComponentToReturn:Function,
        currentItem:String,
        patient_data:Object,
        dataEpisodio:Array,
        index:Number,
        currentComponent: Function,
    },
    template:/*html */`
        <div class="flex-fill d-flex flex-column overflow-auto">
            <ul class="nav bg-light justify-content-between nav-pills" id="pills-tab" role="tablist">

                <app-filter
                    :tipo_filtro="tipo_filtro"
                    :filtro_valor="filtro_valor"
                    @update-filtro="updateFiltro"
                    :currentItem="currentItem"
                    :dataEpisodio="dataEpisodio"
                />
                <li

                    class="nav-item" role="presentation"
                    @click="sendDataToParent"
                >
                    <a

                        class="nav-link currentItem"
                        id="pills-createItem-tab"
                        data-toggle="pill"
                        href="#pills-createItem"
                        role="tab"
                        aria-controls="pills-createItem"
                        aria-selected="false"
                    >
                        <h3 class="mb-0">Agregar {{currentItem}}</h3>
                    </a>
                </li>
            </ul>
            <div class="flex-fill tab-content d-flex flex-column overflow-auto" id="pills-tabContent">
                <div
                    class="tab-pane overflow-auto fade show active"
                    id="pills-listItems"
                    role="tabpanel"
                    aria-labelledby="pills-listItems-tab"
                >

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 p-1">

                                <div
                                    v-if="dataEpisodio.length > 0"
                                    class="timeline timeline-inverse"
                                >
                                    <!-- FECHA DEL DIA -->
                                    <div v-for="(item,index) in dataEpisodio" :key="index">

                                        <div
                                            v-if="item.items.length !== item.items.filter(x=>!x.active).length"
                                            class="time-label"

                                        >
                                            <span class="bg-primary">
                                                {{ item.fechaFormated }}
                                            </span>
                                        </div>

                                        <div
                                            v-for="(item2,index2) in item.items"
                                            :key="index2"
                                            v-show="item2.active"
                                        >

                                            <i
                                                :class="['timelime-medic-icon fas fa-user-md',{'bg-primary text-white':medicOrEnfermery(item2)==='medic'},{'bg-warning text-dark':medicOrEnfermery(item2)==='enfermery'}]"
                                                aria-hidden="true">
                                            </i>
                                            <div class="timeline-item">
                                                <span class="time">
                                                    <i class="far fa-clock"></i>
                                                    {{ item2.fechaItem }}
                                                    <span class="text-primary">|</span>
                                                    {{ item2.hora }}
                                                    <a
                                                        :class="['m-0 p-0',{'d-none':noImprimir(item2.description)}]"
                                                        type="button"
                                                        @click="imprimir(item2)"
                                                        :content="'Imprimir'"

                                                    >
                                                        <i

                                                            class="imprimir m-0 p-0 fas fa-print text-info heartbeat"
                                                            style="font-size: 1em;cursor:pointer; margin-left:1em;"
                                                            aria-hidden="true">
                                                        </i>
                                                    </a>
                                                </span>
                                                <h3
                                                    data-toggle="collapse"
                                                    :href="'#collapseExample'+index2"
                                                    role="button"
                                                    aria-expanded="false"
                                                    aria-controls="collapseExample"
                                                    class="timeline-header"
                                                >
                                                    <b>{{ item2.description }}</b> |
                                                    <b class="text-primary">{{ item2.dataMedico !== undefined ? item2.dataMedico.prefijo : '' }} {{ item2.dataMedico !== undefined ? item2.dataMedico.medico : '' }}</b>
                                                    <span
                                                        :content="'Equipo '+item2.dataMedico_posicion.nombre"

                                                        :class="['badge  scale-in-hor-left',('badge-'+item2.dataMedico_posicion.color)]"
                                                        style="width:2em;">
                                                        {{ item2.dataMedico_posicion.siglas }}
                                                    </span>


                                                </h3>
                                                <div
                                                    :id="'collapseExample'+index2"
                                                    class="collapse show timeline-body"
                                                    v-html="item2.dato"
                                                >
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="far fa-clock bg-secondary rounded-circle text-white"></i>
                                    </div>
                                </div>
                                <div v-else class="timeline timeline-inverse">
                                    <div>
                                        <div>
                                            <div class="timeline-item">
                                                <div class="timeline-body text-secondary text-center">
                                                    No posee historia este día
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="tab-pane fade d-flex flex-fill flex-column" id="pills-createItem" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <component
                        :is="currentComponent"
                        :currentItem="currentItem"
                    ></component>
                </div>
            </div>
            <div class="d-none bg-danger p-4"></div>
        </div>



    `,
    components:{
        /* "app-list-items-historia":AppListItemsHistoria(), */
        "app-create-item-file":AppCreateItemFile(),
       /*  "app-filter":AppFilter(), */
        /* "app-row-timeline":AppRowTimeline() */
    },
    data() {
        return {
            logoURL:'../image/system/logo-cmdlt-color.png', //logo CMDLT
            pdfData:{ //datos del pdf
                pdfName:"recipe",
                created_at:null, //fecha de creacion
                
                medicExt:null, // extencion telefonica del medico
                medicName:null, // nombre del medico
                medicCI:null, // cedula del medico
                medicMPPS:null, // MPPS del medico
                medicSchoolNumber:null, // numero de colegio del medico
                medicSignatureURL:null, //firma
                medicStampURL:null, //sello
                medicEspecialities: null, //especialidades
  
                patientAge:null, //edad del paciente
                patientCI:null, //CI del paciente
                patientName:null, //nombre del paciente
                
                medications:[], //medicaciones
                
            },
            currentComponent:null,
            tipo_filtro:"",
            filtro_valor:"",
            registros:[]
        }
    },
    methods: {
        //init pdf
        getFooterDirection( pageSize) {
            return [
                    {
                        canvas: [
                        {
                            type: 'rect',
                            x: 0,
                            y: 60,
                            w: pageSize.width,
                            h: 40,
                            color: '#1c71ce',
                        },
                        ],
                    },
                    {
                        alignment: 'justify',
                        fontSize: 5,
                        absolutePosition: { x: 0, y: 53 },
                        padding: [0, 0, 0, 30],
                        columns: [
                        'leftSide',
                        'rightSide',
                        ].map((h) => {
                        return {
                            lineHeight: 0.5,
                            color: '#fff',
                            margin: [10, 10, 0, 20],
                            columns: [
                            {
                                text: [
                                `
                                Avenida intercomunal La Trinidad El Hatillo,\n 
                                Apartado postal 80474 Caracas 1080-A\n 
                                Teléfonos: (+58) 0212 -949.6411 (central)\n 
                                Fax: (+58) 0212 -945.6346\n 
                                Rif: J-00058551-2
                            `,
                                ],
                                alignment: 'left',
                            },
                            {
                                text: [`www.cmdlt.edu.ve`],
                                alignment: 'right',
                                marginRight: 10,
                            },
                            ],
                        };
                        }),
                    },
                ];
        },

        async getImageBase64(imgURL){
            const response = await fetch(imgURL);

            if(response.status !== 200){
                return undefined;
            }

            const blob = await response.blob();

            // Verificar si el archivo es PNG o JPG
            if (blob.type !== 'image/png' && blob.type !== 'image/jpeg') {
                console.error('El archivo no es un PNG o JPG');
                return undefined;
            }

            const reader = new FileReader();

            const logoDataURL = await new Promise((resolve, reject) => {
                reader.onload = () => resolve(reader.result);
                reader.onerror = () => reject(reader.error);
                reader.readAsDataURL(blob);
            });

            return logoDataURL;
            },

        async getSignatureAndStamp(xPosition) {
            this.signature = '../'+this.pdfData.medicSignatureURL
            this.stamp = '../'+this.pdfData.medicStampURL
            const signatureBase64 = this.signature
                ? await this.getImageBase64(this.signature)
                : undefined;
            const stampBase64 = this.stamp
                ? await await this.getImageBase64(this.stamp)
                : undefined;

            const signatureAndStamp = [];

            if (signatureBase64) {
                signatureAndStamp.push({
                image: signatureBase64,
                fit: [100, 80],
                absolutePosition: { x: xPosition, y: -25 },
                });
            }

            if (stampBase64) {
                signatureAndStamp.push({
                image: stampBase64,
                fit: [100, 80],
                absolutePosition: { x: xPosition, y: 0 },
                });
            }

            return signatureAndStamp;
        },

        getRecipeIndications(counter,indications,) {
            return {
            color: '#000',
            width: '48%',
            text: (counter && counter + '. ') + indications,
            fontSize: 10,
            margin: [ 20, 15, 30, 0],
            };
        },

        async getMedicData(recipe){
            
            const getSignatureAndStampL = await this.getSignatureAndStamp(280);

            const getSignatureAndStampR = await this.getSignatureAndStamp(700);

            const createdUserL = this.getCreatedUser();

            const createdUserR = this.getCreatedUser();

            return [
            {
                alignment: 'justify',
                fontSize: 8,
                absolutePosition: { x: 0, y: -7 },
                padding: [0, 0, 0, 30],
                columns: [
                {
                    lineHeight: 0.9,
                    color: '#000',
                    margin: [10, 10, 0, 20],
                    columns: [
                    createdUserL,
                    {
                        text: 'Firma y sello',
                        columns: getSignatureAndStampL,
                    },
                    ],
                },
                {
                    lineHeight: 0.9,
                    color: '#000',
                    margin: [10, 10, 0, 20],
                    columns: [
                    createdUserR,
                    {
                        text: 'Firma y sello',
                        columns: getSignatureAndStampR,
                    },
                    ],
                },
                ],
            },
            ];
        },
        
        getRecipeMedications(number, recipe) {
            return {
            margin: [0, 15, 0, 0],
            color: '#000',
            width: '48%',
            stack: [
                {
                text: number + '. ' + recipe.name,
                },
                {
                text: [
                    { text: ` ` },
                    { text: `        ${recipe.presentation ? recipe.presentation : ''}` },
                    { text: ` ` },
                    { text: `${recipe.units ? recipe.units : ''}` },
                ],
                },
            ],
            };
        },

        getCreatedUser() {
            
            const speciality = this.pdfData.medicEspecialities
                ? '/ ' + this.pdfData.medicEspecialities.map((us) => us).join(', ')
                : '';

            return {
                text: 'Datos del médico',
                columns: [
                    {
                        stack: [
                        { text: 'Datos del médico', bold: true },
                        {
                            text: `${this.pdfData.medicExt ? '(' + this.pdfData.medicExt + ') ' : ''}${this.pdfData.medicName} ${speciality}`,
                        },
                        {
                            text: [
                            { text: 'C.I.: ' },
                            {
                                text: this.pdfData.medicCI || '',
                            },
                            ],
                        },
                        {
                            text: [
                            { text: 'Colegio de Médicos: ' },
                            { text: this.pdfData.medicSchoolNumber || '' },
                            ],
                        },
                        {
                            text: [{ text: 'MPPS: ' }, { text: this.pdfData.medicMPPS || '' }],
                        },
                        ],
                        unbreakable: true,
                    },
                ],
            };
        },
        dateFormat(dateStr) {
            const date = new Date(dateStr); 
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0'); 
            const day = String(date.getDate()).padStart(2, '0');

            return `${day}/${month}/${year}`;
        },    
        async printPdf(item){
            
            this.pdfData.created_at = this.dateFormat(item.created_at)
            this.pdfData.patientAge = this.patient_data.edad
            this.pdfData.patientCI = this.patient_data.cedula_formated
            this.pdfData.patientName = this.patient_data.paciente
            if (this.esArrayDeObjetos(item.dato)) {
                this.pdfData.medications = JSON.parse(item.value)
            }else{
                this.pdfData.medications = [{
                    presentation:'',
                    name:item.value,
                    indications:'',
                    unit:''
                }]
            }
            this.pdfData.medicExt = item.extencion_telefonica
            this.pdfData.medicName = item.medico
            this.pdfData.medicCI = item.medico_cedula
            this.pdfData.medicMPPS = item.mpps
            this.pdfData.medicSchoolNumber = item.colegio_medico
            this.pdfData.medicSignatureURL = item.firma
            this.pdfData.medicStampURL = item.sello
            this.pdfData.medicEspecialities = item.medico_especialidades ? item.medico_especialidades.split(',') : []
            console.log("3", this.pdfData);
           
            //Logo cmdlt
            const logoBase64 = await this.getImageBase64(this.logoURL); 
            
            //cintillo inferior del recipe
            const footerDirection = this.getFooterDirection;
        
            //datos del medico / sello / firma
            const medicData =  await this.getMedicData();

            const docDefinition = {
                pageSize: 'A4',
                pageOrientation: 'landscape',
                pageMargins: [20, 120, 20, 100],
                header: {
                stack: [
                    {
                    margin: [0, 10, 0, 0],
                    alignment: 'justify',
                    columns: [
                        {
                        marginRight: 10,
                        image: logoBase64,
                        fit: [120, 80],
                        alignment: 'right',
                        },
                        {
                        marginRight: 10,
                        image: logoBase64,
                        fit: [120, 80],
                        alignment: 'right',
                        }
                    ],
                    },
                    {
                    alignment: 'justify',
                    columns: ['leftSide', 'rightSide'].map((h, index) => {
                        return {
                        margin: [20, 10, 20, 10],
                        columns: [
                            {
                            fontSize: 12,
                            text: h === 'leftSide'
                            ? 'Récipe'
                            : 'Indicaciones',
                            bold: true,
                            },
                            {
                            margin: [0, 0, 3, 0],
                            alignment: 'right',
                            text: [
                                {
                                text: 'Fecha: ',
                                bold: true,
                                },
                                {
                                color: '#000',
                                text: this.pdfData.created_at ? this.pdfData.created_at : 'No disponible',
                                },
                            ],
                            },
                        ],
                        };
                    }),
                    },
                    {
                    alignment: 'justify',
                    columns: [
                        'leftSide',
                        'rightSide',
                    ]
                        .filter(Boolean)
                        .map((h) => {
                        return {
                            margin: [20, 0, 10, 5],
                            text: [
                            {
                                text: 'Nombre y apellido: ',
                                bold: true,
                            },
                            {
                                color: '#000',
                                text: this.pdfData.patientName ? this.pdfData.patientName : 'No disponible',
                            },
                            ],
                        };
                        }),
                    },
                    {
                    alignment: 'justify',
                    columns: [
                        'leftSide',
                        'rightSide',
                    ]
                        .filter(Boolean)
                        .map((h) => {
                        return {
                            margin: [20, 0, 20, 0],
                            text: [
                            {
                                text: 'C.I: ',
                                bold: true,
                            },
                            {
                                color: '#000',
                                text: this.pdfData.patientCI ? this.pdfData.patientCI : 'No disponible',
                            },
                            {
                                text: '    ',
                            },
                            {
                                text: 'Edad: ',
                                bold: true,
                            },
                            {
                                color: '#000',
                                text: this.pdfData.patientAge + ' año' +
                                (this.pdfData.patientAge !== 1
                                    ? 's'
                                    : ''),
                            },
                            ],
                        };
                        }),
                    },
                ],
                },
                content: this.pdfData.medications.map((item, index) => {
                return {
                    margin: [0, 10, 0, 0],
                    alignment: 'justify',
                    unbreakable: true,
                    columns: [
                    this.getRecipeMedications(index + 1, item) ,
                    { width: '4%', text: ' ' },
                    this.getRecipeIndications(index + 1, item.indications),
                    ],
                };
                }) ,
                footer: function (currentPage, pageCount, pageSize) {
                return [...medicData, ...footerDirection( pageSize)];
                }, 
                styles: {
                header: {
                    fontSize: 12,
                    bold: true,
                },
                },
                defaultStyle: {
                fontSize: 10,
                color: '#1c71ce',
                },
            };
            //datos del paciente
            


            
            pdfMake.createPdf(docDefinition).download(
                this.pdfData.pdfName + 
                '-' +
                (this.pdfData.patientName ? (this.pdfData.patientName).replace(/ /g, "") : 'patientName') + 
                '-' +
                (this.pdfData.created_at ? ((this.pdfData.created_at).split(' '))[0] : 'created_at') + 
                '.pdf');

        },
        esArrayDeObjetos(str) {
            try {
              // Intentamos convertir el string en JSON
              const json = JSON.parse(str);
              
              // Verificamos que sea un array
              if (Array.isArray(json)) {
                // Verificamos que todos los elementos del array sean objetos
                return json.every(item => typeof item === 'object' && item !== null);
              }
              
              return false;
            } catch (e) {
              // Si ocurre un error al parsear, no es un JSON válido
              return false;
            }
        },
        //end pdf
        medicOrEnfermery(item){
    

            try {


                if([1,2,3,4,5,6,7,8,9].includes(Number(item.dataMedico.posicion_id))){
                    return "medic"
                }
                if([10].includes(Number(item.dataMedico.posicion_id))){
                    return "enfermery"
                }
            } catch (error) {
                 console.log("data medico: ",item)
            }
            return "not-found"
        },
        noImprimir(description){
            if([
                "Fotografías",
                "Pendiente",
                "Probabilidad diagnóstica",
                "Plan",
                "Observación",
                "Laboratorio",
                "Imagenes",
                "Otro",

            ].includes(description)){
                return true
            }else{
                return false
            }
        },
        sendDataToParent() {
            let that = this
                this.buttonsState=false
                this.updateParentData( this.buttonsState );

                this.currentComponent = {
                    extends: this.$options.components[ "app-create-item-file" ],
                    props: {
                        currentComponent: {
                            type: Function,
                            default: that.currentComponent
                        },
                        updateComponentToReturn: {
                            type: Function,
                            default: that.updateComponentToReturn
                        },
                        currentItem: {
                            type: String,
                            default: that.currentItem
                        },
                        dataEpisodio: {
                            type: Array,
                            default: function(){
                                return that.dataEpisodio
                            }
                        },
                        patient_data: {
                            type: Object,
                            default: that.patient_data
                        },
                    }
                };
        },
        updateFiltro(data) {
            this.tipo_filtro = data.tipo_filtro;
            this.filtro_valor = data.filtro_valor;
            this.showRow()
        },
        showRow(){
            if(this.filtro_valor === null){
                this.registros.map(x=>{
                    x.active = true
                })
                return false
            }
            if (this.tipo_filtro==="medico") {
                this.registros.map(x=>{
                    if(x.medico === this.filtro_valor){
                        x.active = true
                    }else{
                        x.active = false
                    }
                    return x
                })
            }
            if (this.tipo_filtro==="fecha") {
                this.registros.map(x=>{
                    if(x.fechaItem === this.filtro_valor){
                        x.active = true
                    }else{
                        x.active = false
                    }
                    return x
                })
            }
        },
        getAllByDay(fecha){
            return this.registros.filter(x=> x.fechaFormated === fecha).map(x=>x.items ).flat()
        },
    },
    async mounted () {
        this.registros = this.dataEpisodio.map(x=>x.items ).flat()
    },
}

export default class UserCuestHistoria {
    index(patient_data, index_episodio) {

        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="AppEvolucion">Cargando...</div>
        `);

        let app1 = new Vue({
            name:"AppHistoriaPaciente",
            el: '#AppEvolucion',
            data() {
                return {
                    currentIndex:localStorage.getItem("currentIndex") !== null ? localStorage.getItem("currentIndex"):0,
                    patient_data:patient_data,
                    index:index_episodio,
                    btnReingreso:false,
                    counterDataEpisodio:[],
                    buttonsState:true,
                    currentComponent:null,
                    dataEpisodio:[],
                    currentItem:"Ver Todo",
                    items:[
                        {
                            name:"Ver Todo",
                            icon:null,
                            cat_user_cuestionario_id:null,
                            active:true,
                            component:"app-list-all",
                            totalItems:0,
                        },
                        {
                            name:"Laboratorio",
                            icon:"pc-laboratorio1",
                            cat_user_cuestionario_id:90,
                            active:false,
                            component:"app-laboratorio",
                            totalItems:0,
                        },
                        {
                            name:"Imagenes",
                            icon:"pc-imagenes",
                            cat_user_cuestionario_id:100,
                            active:false,
                            component:"app-imagenes",
                            totalItems:0,
                        },
                        {
                            name:"Fotografías",
                            icon:"pc-fotografia",
                            cat_user_cuestionario_id:191,
                            active:false,
                            component:"app-fotografias",
                            totalItems:0,
                        },
                        {
                            name:"Otros Archivos",
                            icon:"pc-otros-archivos",
                            cat_user_cuestionario_id:122,
                            active:false,
                            component:"app-otros-archivos",
                            totalItems:0,
                        },
                        {
                            name:"Probabilidad diagnóstica",
                            icon:"pc-observacion",
                            cat_user_cuestionario_id:101,
                            active:false,
                            component:"app-probabilidad-diagnostica",
                            totalItems:0,
                        },
                        {
                            name:"Evolución",
                            icon:"pc-evolucion",
                            cat_user_cuestionario_id:175,
                            active:false,
                            component:"app-evolucion",
                            totalItems:0,
                        },
                        {
                            name:"Orden Médica",
                            icon:"pc-orden_medica",
                            cat_user_cuestionario_id:175,
                            active:false,
                            component:"app-orden-medica",
                            totalItems:0,
                        },
                        {
                            name:"Plan",
                            icon:"pc-plan",
                            cat_user_cuestionario_id:102,
                            active:false,
                            component:"app-plan",
                            totalItems:0,
                        },

                        {
                            name:"Récipe",
                            icon:"pc-recipe1",
                            cat_user_cuestionario_id:177,
                            active:false,
                            component:"app-recipe",
                            totalItems:0,
                        },
                        {
                            name:"Observación",
                            icon:"pc-buscar",
                            cat_user_cuestionario_id:176,
                            active:false,
                            component:"app-observacion",
                            totalItems:0,
                        },
                        {
                            name:"Estudio Diagnóstico",
                            icon:"pc-estudio-diagnostico",
                            cat_user_cuestionario_id:178,
                            active:false,
                            component:"app-estudio-diagnostico",
                            totalItems:0,
                        },
                        /* {
                            name:"Antecedentes/Comorbilidad de Egreso",
                            icon:"pc-antecedentes ",
                            cat_user_cuestionario_id:178,
                            active:false,
                            component:"app-antecedente-cormorbilidad",
                            totalItems:0,
                        }, */
                        /* {
                            name:"Antecedentes",
                            icon:"pc-antecedentes",
                            cat_user_cuestionario_id:189,
                        }, */
                    ],

                }
            },
            template: /*html */ `
                <div class="d-flex flex-column flex-fill overflow-auto">
                    <div id="infoPaciente"></div>
                    <div class="flex-fill d-flex flex-md-row flex-column overflow-auto">
                        <div class="flex-md-fill d-flex flex-column col-md-4 col-lg-3 col-xl-2 p-1 p-md-0  overflow-md-auto">

                            <ul id="menuEvolucion" class="mt-1 pr-1 nav nav-pills flex-md-column flex-nowrap overflow-auto" role="tablist">

                                <li
                                    v-for="(item,index) in getItems"
                                    :key="index"
                                    class="nav-item"
                                    role="presentation"
                                >
                                    <a
                                        @click="handle_option(item,index)"
                                        :class="['nav-link d-flex align-items-center',{'active':Number(currentIndex)===Number(index)}]"
                                        :id="'pills-'+(index+1)+'-tab'"
                                        :href="'#pills-'+(index+1)"
                                        :aria-controls="'pills-'+(index+1)"
                                        role="tab"
                                        data-toggle="pill"
                                        aria-selected="true"
                                    >
                                        <div class="d-flex flex-sm-row align-items-center mr-1">
                                            <i :class="['icon-option h3 mb-0 mr-1 fas fa-list',item.icon]"></i>
                                            <span class="text-option text-left text-custom-wrap">{{ item.name }}</span>
                                        </div>
                                        <div :class="['ml-auto badge badge-counter',{'d-none':item.totalItems == 0 }]">{{ (index===0) ? getItems.length : item.totalItems }}</div>
                                    </a>
                                </li>


                            </ul>
                        </div>
                        <div class="bg-light rounded flex-fill d-flex flex-column overflow-auto rounded col-md-10 col-lg-10 col-xl-10 tab-content" id="pills-tabContent">

                            <component
                                :is="currentComponent"
                                :currentItem="currentItem"
                                :patient_data="patient_data"
                                :index="index"
                            ></component>

                        </div>
                    </div>
                    <div v-if="buttonsState" class="container-fluid mt-1">
                        <div class="row">
                            <div v-if="btnReingreso" @click="handleBtnReingreso()" class="btn btn-success btn-block mt-1">Reingresar</div>
                            <div v-if="!btnReingreso" @click="handle_alta()" class="button btn rounded-0 btn-success col">Alta</div>
                            <div v-if="!btnReingreso" @click="handle_traslado()" class="button btn rounded-0 btn-secondary col">Traslado</div>
                        </div>
                    </div>
                </div>
            `,
            components: {
                'app-list-all':AppListAll(),
                'app-laboratorio':AppLaboratorio(),
                'app-imagenes':AppImagenes(),
                'app-fotografias':AppFotografias(),
                'app-otros-archivos':AppOtrosArchivos(),
                'app-probabilidad-diagnostica':AppProbabilidadDiagnostica(),
                'app-evolucion':AppEvolucion(),
                'app-orden-medica':AppOrdenMedica(),
                'app-plan':AppPlan(),
                'app-recipe':AppRecipe(),
                'app-observacion':AppObservacion(),
                'app-estudio-diagnostico':AppEstudioDiagnostico(),
                //'app-antecedente-cormorbilidad':AppAntecedenteComorbilidad(),
            },
            computed: {

                getItems(){

                    let that = this
                    if ( ![
                        'Antecedentes/Comorbilidad de Egreso'].includes(this.currentItem)
                    ) {
                        return that.items.map(x=>{
                            
                              x.totalItems = that.counterDataEpisodio.filter(z=> {

                                  if( z.hasOwnProperty('description') ){
                                    let title = z.description
                                        if(title==="Otro"){
                                            title = "Otros Archivos"
                                        }
                                        if( title === x.name ){
                                            return z
                                        }
                                  }

                              } ).length


                              return x
                          })
                    } else {
                        return []
                    }


                },

            },
            watch: {
                currentIndex(newValue, oldValue) {
               
                    this.currentIndex = newValue
                   
                }
            },
            methods: {
                showBtnReingreso(){
                    if (
                        location.pathname === "/medico/create_paciente" ||
                        localStorage.getItem('area') === "alta"

                    ) {
                        this.btnReingreso = true
                    }
                },
                handleBtnReingreso(){
                    UserCuestUbicacion.reingreso('.modal-body',this.patient_data.user_id)
                },
                handle_alta(){
                    UserCuestUbicacion.egreso('.modal-body',this.patient_data.user_id)
                },
                handle_traslado(){
                    UserCuestUbicacion.create('.modal-body',this.patient_data.user_id)
                },
                meses(p) {
                    let mes = [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre",
                        "Enero"
                    ]
                    return mes[p];
                },
                fechaCortaAPPLE(param) {
                 
                    var hoy = param.split(" ");
                    let fecha = hoy[0].split("-")
                    let fullHora = hoy[1].split(":")
                    //2022-03-24 00:12:26
                    let anio = fecha[0]
                    let mes = parseInt(fecha[1])
                    let dia = fecha[2]

                    let hora = fullHora[0];
                    let minutos = fullHora[1];
                    let segundos = fullHora[2];
                    let horario = "AM"
                        if (parseInt(hora) >= 12 && parseInt(hora) <= 23) {
                            horario = "PM"
                        }
                        switch(hora){
                            case "13": hora = 1; break
                            case "14": hora = 2; break
                            case "15": hora = 3; break
                            case "16": hora = 4; break
                            case "17": hora = 5; break
                            case "18": hora = 6; break
                            case "19": hora = 7; break
                            case "20": hora = 8; break
                            case "21": hora = 9; break
                            case "22": hora = 10; break
                            case "23": hora = 11; break
                            case "00": hora = 12; break
                        }


                    return dia + " de " + ( this.meses( mes -1 ) ) + ", " + anio
                },
                configData(){
                    let tempFecha = []
                        this.dataEpisodio.forEach(element => {
                            let f1 = ( element.created_at.split(" ") )[0]
                                tempFecha.push(f1)
                        });
                    let myData =[]

                        Array.from(new Set(tempFecha)).forEach((item,index)=>{
                            myData.push({
                                fecha:item,
                                fechaFormated: this.fechaCortaAPPLE(item+" 00:00:00"),
                                /* items:[] */
                                items:  this.dataEpisodio.filter(element=>{

                                            let medico = medicos_datos.find( medico => Number(medico.user_id) === element.user_id_medico )
                                             //this.$store.state.medicos_datos.find( medico => medico.user_id === element.user_id_medico )
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
                                                            <img onclick="window.open('/${element.value}', '_blank')" onerror="this.src='https://placehold.co/600x400'" style="cursor:pointer;width: 50px;" class="ampliar zoom img-fluid" src='${imageIcon}'>
                                                            <br>`;
                                                    }
                                                    dato = `
                                                        ${valor}
                                                        ${coments}
                                                    `;
                                                }
                                             
                                                if (!is_undefined(medico)) {

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
                                                    } /* */
                                                }
                                                element.fechaItem = this.fechaCortaAPPLE( element.created_at )
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
                        this.dataEpisodio = myData
                },
                async getHistoriaPaciente(){
                    let formdata = new FormData();
                        formdata.append("user_id", this.patient_data.user_id)
                        formdata.append("_token", $("#_token").val())
                        formdata.append("created_at", timestamps() )
                        //formdata.append("created_at", "2021-04-1")
                        this.dataEpisodio = await post( location.origin+"/user_cuest_historia_medica/getHistorial", formdata)
                        this.dataEpisodio = this.dataEpisodio.map(x=>{
                            x.active = true
                            return x
                        })
                        this.counterDataEpisodio =this.dataEpisodio

                        this.configData()
                },
                async getAntecedenteComorbilidad(){
                    let formdata = new FormData();
                        formdata.append("user_id", this.patient_data.user_id)
                        formdata.append("_token", $("#_token").val())
                        formdata.append("created_at", timestamps() )
                        //formdata.append("created_at", "2021-04-1")
                        //this.dataEpisodio = await post( location.origin+"/user_cuest_historia_medica/getHistorial", formdata)
                        this.dataEpisodio =  await post(location.origin+"/user_cuest_comorbilidad/show/"+user_id, formdata)
                        this.dataEpisodio = this.dataEpisodio.map(x=>{
                            x.active = true
                            return x
                        })
                        this.configData()
                },
                async defaultComponent(){

                    let that = this
                        this.buttonsState = true
                        await this.getHistoriaPaciente()

                    this.currentComponent = {
                        extends: this.$options.components[ 'app-list-all' ],
                        props: {
                            currentItem: {
                                type: String,
                                default: this.currentItem
                            },
                            patient_data: {
                                type: Object,
                                default: pacientes_datos.find(x=>x.user_id === this.patient_data.user_id)
                            },
                            dataEpisodio: {
                                type: Array,
                                default: function(){
                                    return that.dataEpisodio
                                }
                            },
                            buttonsState: {
                                type: Boolean,
                                default: function(){
                                    return that.buttonsState
                                }
                            },

                            updateParentData: {
                                type: Function,
                                default: that.updateParentData
                            },

                        }
                    };
                },
                updateParentData(newData) {
                    this.buttonsState = newData;
                },
                openDinamicComponent(item,index){
                    let that = this
                    //filtro todos los registros por el nombre a mostrar actual
                    that.dataEpisodio = that.dataEpisodio.map(x=>{
                        let title = that.currentItem
                        
                        if(title==="Otros Archivos"){
                            title = "Otro"
                        }
                        x.items = x.items.filter(x=>x.description === title)
                        return x
                    })
                    //cargo el componente actual
                    this.currentComponent = {
                        extends: this.$options.components[ this.items[index].component ],
                        props: {
                            //guarda el componente a cargarse dinamicamente
                            currentComponent: {
                                type: Function,
                                default: this.currentComponent
                            },
                            //guarda el nombre actual del componente
                            currentItem: {
                                type: String,
                                default: this.currentItem
                            },
                            //contiene toda la data del episodio del paciente
                            patient_data: {
                                type: Object,
                                default: pacientes_datos.find(x=>x.user_id === this.patient_data.user_id)
                            },

                            dataEpisodio: {
                                type: Array,
                                default: function(){
                                    return that.dataEpisodio
                                }
                            },
                            //boton para actualizar la visibilidad de los botones inferiores de la modal
                            buttonsState: {
                                type: Boolean,
                                default: function(){
                                    return that.buttonsState
                                }
                            },
                            updateComponentToReturn: {
                                type: Function,
                                default: async ()=>{

                                    that.buttonsState = true
                                    await that.getHistoriaPaciente()
                                    that.dataEpisodio = that.dataEpisodio.map(x=>{
                                        let title = that.currentItem
                                        if(title==="Otros Archivos"){
                                            title = "Otro"
                                        }
                                        x.items = x.items.filter(x=>x.description === title)
                                        return x
                                    })
                                    that.currentComponent = {
                                        extends: that.$options.components[ 'app-list-all' ],
                                        props: {
                                            currentItem: {
                                                type: String,
                                                default: that.currentItem
                                            },
                                            patient_data: {
                                                type: Object,
                                                default: pacientes_datos.find(x=>x.user_id === this.patient_data.user_id)
                                            },
                                            dataEpisodio: {
                                                type: Array,
                                                default: function(){
                                                    return that.dataEpisodio
                                                }
                                            },
                                            buttonsState: {
                                                type: Boolean,
                                                default: function(){
                                                    return that.buttonsState
                                                }
                                            },
                                            updateParentData: {
                                                type: Function,
                                                default: that.updateParentData
                                            },

                                        }
                                    };
                                }
                            },
                            updateParentData: {
                                type: Function,
                                default: that.updateParentData
                            },

                        }
                    };
                },
                async handle_option(item,index){

                    localStorage.setItem("currentIndex",index)
                    let that = this
                        //Habilito los botones inferiores de la modal
                        this.buttonsState = true

                        //consulto la historia del paciente
                        await this.getHistoriaPaciente()
                        //await this.getAntecedenteComorbilidad()

                        //asigno el nombre del item actual a mostrar
                        that.currentItem = item.name

                        //actualizo la visibilidad de todos los registros de la historia
                        this.dataEpisodio = this.dataEpisodio.map(x=>{
                            x.items.map(x=>{
                                x.active = true
                                return x
                            })
                            return x
                        })
                        //si el item pulsado es Ver todo
                        if(Number(index) ===0){
                            this.defaultComponent()
                            return false
                        }

                        //alert(this.items[index].component)
                        that.openDinamicComponent(item,index)
                },
            },
            async mounted () {

                this.showBtnReingreso()
                userCuestPaciente.infoPaciente("#infoPaciente", this.patient_data.user_id)

                let item =this.getItems[ this.currentIndex ]
                //this.defaultComponent()
                this.handle_option(item,this.currentIndex)
            },
        })
    }

    indexHistoria_datos_pacientes($node,user_id){
        let model = pacientes_datos.filter(x =>x.user_id ==user_id)[0];
        let f = null;
        let ingreso;
        if (model.hasOwnProperty('ingreso_episodio')) {
            f = new Date(model.ingreso_episodio);
            ingreso = f.getDate() + " " + meses(f.getMonth()) + ", " + f.getFullYear();
        }

        let $nodo = $node.querySelectorAll('.col-md-4 .card')[0]
            //imagen
            $nodo.querySelector('.widget-user-image img').src = model.imagen
            //nombre
            $nodo.querySelector('.widget-user-username').textContent = model.paciente
            //cedula
            $nodo.querySelector('.widget-user-desc').textContent = model.cedula

        let $nodo_item =$nodo.querySelectorAll('span')
            //edad
            $nodo_item[0].textContent = model.edad
            //SEXO
            $nodo_item[1].textContent = model.sexo.toUpperCase()
            //telefono
            $nodo_item[2].innerHTML = `<i class="fab fa-whatsapp text-success"></i> ${model.telefono_movil}`
            //numero de historia
            $nodo_item[3].textContent = `# ${model.total_episodios+1}`
            //fecha de historia
            $nodo_item[4].textContent = ingreso
    }
    historiaIngreso($node,user_id){
        let model = pacientes_datos.filter(x =>x.user_id ==user_id)[0];
        let f = null;
        let ingreso;
        if (model.hasOwnProperty('ingreso_episodio')) {
            f = new Date(model.ingreso_episodio);
            ingreso = f.getDate() + " " + meses(f.getMonth()) + ", " + f.getFullYear();
        }

        let $nodo = $node.querySelectorAll('.col-md-4 .card')[0]
            //imagen
            $nodo.querySelector('.widget-user-image img').src = model.imagen
            //nombre
            $nodo.querySelector('.widget-user-username').textContent = model.paciente
            //cedula
            $nodo.querySelector('.widget-user-desc').textContent = model.cedula

        let $nodo_item =$nodo.querySelectorAll('span')
            //edad
            $nodo_item[0].textContent = model.edad
            //SEXO
            $nodo_item[1].textContent = model.sexo.toUpperCase()
            //telefono
            $nodo_item[2].innerHTML = `<i class="fab fa-whatsapp text-success"></i> ${model.telefono_movil}`
            //numero de historia
            $nodo_item[3].textContent = `# ${model.total_episodios+1}`
            //fecha de historia
            $nodo_item[4].textContent = ingreso
    }
    indexHistoria_exp_fisica($node,user_id){
        let $nodo = $node.querySelectorAll('.col-md-4 .card')[1]
        console.log($nodo)

    }
    async indexHistoria_comorbilidad($node,user_id,data){

        let $nodo = $node.querySelectorAll('.col-md-4 .card')[2]
        let $cardBody = $nodo.querySelector('.card-body')
        let dp = [{text:"aaa"},{text:"bbb"}]
            $cardBody.innerHTML=""
            $cardBody.appendChild(newTable({tbody:dp}))

        let $form = $cardBody.querySelector("form")
            $form.querySelector("button").addEventListener("click", async e => {
                e.preventDefault()
                let input = $form.querySelector("input")
                    if (input.value === "") {
                        alert("El el campo está vacio")
                        input.focus()
                    } else {
                        dp.push({ "text": input.value })
                        input.value = ""
                        let tbody = dp

                        let $table = $cardBody.querySelector("tbody")
                        cl($table)
                            //$table.querySelector("tbody").innerHTML = ""
                            $table.append(newTableRow(tbody))
                    }
            })
       // console.log($botones)
    }
    async indexHistoria(data) {
        $("#modal-patient-item").modal("show");
            //cl(data)
            data = pacientes_datos.find(x=>equalsInt(x['user_id'],data.user_id))
        let {user_id,episodio} = data
        let episodio_id = episodio;
        let d = document;
        let $modal = byId('modal-patient-item')


        let ingreso = await UserCuestEpisodio.get_historiaIngreso(user_id)
            cl(ingreso)
        let {
            FC,
            FR,
            GLIC,
            OXI,
            TA,
            TEMP,
            PESO,
            TALLA
            } = ingreso['episodio']['SIGNOS'];



        let useState ={}


        let $cabecera = document.getElementById(`historia_inicial`).content
            $cabecera = document.importNode($cabecera,true);
        let $signos = $cabecera.querySelectorAll("#signosVitales input")
        let $btn_guardar = $cabecera.querySelector("button#guardarHistoriaInicial")
            $btn_guardar.addEventListener("click", function(e){
                Toast.fire({
                    icon: "info",
                    title: "¿Desea guardar la historia preliminar de emergencia?",
                    text: "Esta acción quedará firmada y sellada por el médico.",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: `Si`,
                    /* didClose: () => {
                        setTimeout(() => { email.val('');email.trigger("focus");}, 110);
                    } */
                })
                .then( async (result) => {
                    console.log(result)
                    let formdata = new FormData();
                        formdata.append("_token", $("#_token").val())
                        formdata.append("episodio_id",episodio_id)
                        formdata.append("user_id_paciente",user_id)



                    let firma_sello = await post(`/user/tipo_documento/store`,formdata)
                        console.log(firma_sello)
                        Swal.fire(
                            'Envío exitoso.',
                            `
                                Se ha enviado este informe a las direcciones:
                                <ul class='text-left'>
                                    <li class='text-left'>luisa.lira@cmdlt.edu.ve</li>
                                    <li class='text-left'>cmdlt.pe@gmail.com</li>
                                    <li class='text-left'>admision.seguros@cmdlt.edu.ve</li>
                                    <li class='text-left'>emergencia.seguros@cmdlt.edu.ve</li>
                                </ul>
                            `,
                            'success'
                            ).then((result) => {
                                $("#modelId").modal("hide")
                            })

                    return false //RETIRAR ESTA LINEA CUANDO EL INFORME SE QUIERA ENVIAR POR CORREO
                   /*  if (result.isConfirmed) {
                        let email = await get(`/pdf/enviarInformeSeguro/${user_id}`)
                            if(email){
                                Swal.fire(
                                'Envío exitoso.',
                                `
                                    Se ha enviado este informe a las direcciones:
                                    <ul class='text-left'>
                                        <li class='text-left'>luisa.lira@cmdlt.edu.ve</li>
                                        <li class='text-left'>cmdlt.pe@gmail.com</li>
                                        <li class='text-left'>admision.seguros@cmdlt.edu.ve</li>
                                        <li class='text-left'>emergencia.seguros@cmdlt.edu.ve</li>
                                    </ul>
                                `,
                                'success'
                                ).then((result) => {
                                    $("#modelId").modal("hide")
                                })
                            }

                    } */
                })
            })

            $signos[0].value = !is_null(PESO) ? PESO.value : ''
            $signos[1].value = !is_null(TALLA) ? TALLA.value : ''
            $signos[2].value = !is_null(TEMP) ? TEMP.value : ''
            $signos[3].value = !is_null(OXI) ? OXI.value : ''
            $signos[4].value = !is_null(FC) ? FC.value : ''
            $signos[5].value = !is_null(FR) ? FR.value : ''

            $signos[6].value = !is_null(GLIC) ? GLIC.value : ''
            $signos[7].value = !is_null(TA) ? TA.value : ''
            $signos[8].value = !is_null(TA) ? TA.value2 : ''
            //console.log($signos)
        let $evaluacion = $cabecera.querySelectorAll("#evaluacionIngreso select")
        //e.target.options[ e.target.selectedIndex ].value
            $evaluacion[0].value= !is_null( ingreso['episodio']['ATENCION_EMERGENCIA'] ) ? ingreso['episodio']['ATENCION_EMERGENCIA'] : ""
            $evaluacion[0].dataset.episodio_id= episodio_id

            $evaluacion[1].value=!is_null( ingreso['episodio']['HOSPITALIZACION'] ) ? ingreso['episodio']['HOSPITALIZACION'] : ""
            $evaluacion[1].dataset.episodio_id= episodio_id

            $evaluacion[2].value=!is_null( ingreso['episodio']['TERAPIA_INTENSIVA'] ) ? ingreso['episodio']['TERAPIA_INTENSIVA'] : ""
            $evaluacion[2].dataset.episodio_id= episodio_id

            $evaluacion[3].value=!is_null( ingreso['episodio']['CASO_TIPO_MEDICO'] ) ? ingreso['episodio']['CASO_TIPO_MEDICO'] : ""
            $evaluacion[3].dataset.episodio_id= episodio_id

            $evaluacion[4].value=!is_null( ingreso['episodio']['NIVEL_TRIAJE'] ) ? ingreso['episodio']['NIVEL_TRIAJE'] : ""
            $evaluacion[4].dataset.episodio_id= episodio_id

            //console.log($signos)
        let $datosingreso = $cabecera.querySelectorAll("#datos_ingreso textarea")
            $datosingreso[0].dataset.episodio_id= episodio_id
            $datosingreso[0].value= !is_null(ingreso['episodio']['MOTIVO_CONSULTA']) ? ingreso['episodio']['MOTIVO_CONSULTA']:""

            $datosingreso[1].dataset.episodio_id= episodio_id
            $datosingreso[1].dataset.user_id_paciente= user_id
            $datosingreso[1].value=!is_null(ingreso['episodio']['ANTECEDENTES']) ? ingreso['episodio']['ANTECEDENTES']:""

            $datosingreso[2].dataset.episodio_id= episodio_id
            $datosingreso[2].value= !is_null(ingreso['episodio']['ENFERMEDAD_ACTUAL']) ? ingreso['episodio']['ENFERMEDAD_ACTUAL']:""

            $datosingreso[3].dataset.episodio_id= episodio_id
            $datosingreso[3].value= !is_null(ingreso['episodio']['EXAMEN_FISICO']) ? ingreso['episodio']['EXAMEN_FISICO']:""

            $datosingreso[4].dataset.episodio_id= episodio_id
            $datosingreso[4].dataset.user_id_paciente= user_id
            $datosingreso[4].value=!is_null(ingreso['episodio']['IMP_DIAG']) ? ingreso['episodio']['IMP_DIAG'].value:""












        let modalBody = document.querySelector("#modal-patient-item .modal-body-2")
       /*  let modalFooter = document.querySelector("#modelId div.modal-footer")
            modalFooter.classList.add("d-none") */
            modalBody.innerHTML="";
            modalBody.appendChild($cabecera)



            UserCuestPaciente.infoPaciente("#infoPaciente", user_id)

        /*
            modalFooter.innerHTML=`
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <button type="button" class="btn btn-success btn-block mb-1" data-dismiss="modal">Guardar</button>
                        </div>
                        <div class="col-md-8">
                            <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            `; */
        /*       $('.textarea').summernote({
            placeholder: 'Escribe el texto aquí.',
            toolbar: [
              // [groupName, [list of button]]
              ['style', ['bold', 'italic', 'underline']],
              ['fontsize', ['fontsize']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['table', ['table']],
              ['view', ['fullscreen']],
            ]
          })   */
        //UserCuestHistoria.munecoAcciones()

        document.querySelector('#datos_ingreso').addEventListener("change", function(e){
            if (e.target.matches("textarea[name='user_motivo_consulta']")) {
                 UserProblemaSalud.store(
                    user_id,
                    {
                        "value":e.target.value,
                        "episodio_id":e.target.dataset.episodio_id,
                    }
                 )
             }
             if (e.target.matches("textarea[name='user_enfermedad_actual']")) {
                 UserEnfermedadActual.store(
                    user_id,
                    {
                        "value":e.target.value,
                        "episodio_id":e.target.dataset.episodio_id,
                    }
                  )
             }
             if (e.target.matches("textarea[name='user_examen_fisico']")) {
                 UserExamenFisico.store(
                    user_id,
                    {
                        "value":e.target.value,
                        "episodio_id":e.target.dataset.episodio_id,
                    }
                  )
             }
             if (e.target.matches("textarea[name='user_diagnostico_presuntivo']")) {
                 UserCuestImpresionDiagnostica.store3(
                    user_id,
                    {
                        "value":e.target.value,
                        "user_id_paciente":e.target.dataset.user_id_paciente,
                        "episodio_id":e.target.dataset.episodio_id,
                    }
                  )
             }
             if (e.target.matches("textarea[name='user_antecedentes']")) {
                 console.log(e.target.value)
                UserCuestAntecedente.store(
                    user_id,
                    {
                        "value":e.target.value,
                        "user_id_paciente":e.target.dataset.user_id_paciente,
                        "episodio_id":e.target.dataset.episodio_id,
                    }
                )
             }
        })
        document.querySelector('#signosVitales').addEventListener("change", async function(e){

            if (e.target.matches("input[name='user_peso']")) {
                let value1 = e.target
                if(!is_empty(value1.value)){
                    let formdata = new FormData();
                        formdata.append("episodio_id", episodio_id)
                        formdata.append("value", value1.value)
                        formdata.append("user_id_paciente", user_id)
                        formdata.append("sintoma_observacion", "")
                        formdata.append("created_at", timestamps() )
                        formdata.append("_token", $("#_token").val())
                    let result = await post( location.origin+"/user_peso/store2", formdata)
                }
            }
            if (e.target.matches("input[name='user_talla']")) {
                let value1 = e.target
                if(!is_empty(value1.value)){
                    let formdata = new FormData();
                        formdata.append("episodio_id", episodio_id)
                        formdata.append("value", value1.value)
                        formdata.append("user_id_paciente", user_id)
                        formdata.append("sintoma_observacion", "")
                        formdata.append("created_at", timestamps() )
                        formdata.append("_token", $("#_token").val())
                    let result = await post( location.origin+"/user_talla/store", formdata)
               }
            }
            if (e.target.matches("input[name='user_temperatura']")) {
                //alert(e.target.value)
                UserCuestTemperatura.store3( user_id, e.target.value )
            }
            if (e.target.matches("input[name='user_oximetria']")) {
                //alert(e.target.value)
                UserCuestOximetria.store3( user_id, e.target.value )
            }
            if (e.target.matches("input[name='user_fc']")) {
                //alert(e.target.value)
                UserCuestFc.store3( user_id, e.target.value )
            }
            if (e.target.matches("input[name='user_fr']")) {
                //alert(e.target.value)
                UserCuestFr.store3( user_id, e.target.value )
            }
            if ( e.target.matches("input[name='user_ta_sis']") ) {
                UserCuestTa.store3( user_id, e.target.value, d.querySelector("input[name='user_ta_dia']").value )
            }
            if (e.target.matches("input[name='user_ta_dia']")) {
                UserCuestTa.store3( user_id, d.querySelector("input[name='user_ta_sis']").value , e.target.value )
            }
            if (e.target.matches("input[name='user_glic']")) {
                //alert(e.target.value)
                UserCuestGl.store3( user_id, e.target.value )
            }

        })
        document.querySelector('#evaluacionIngreso').addEventListener("change", function(e){
            //console.log(e.target.name)
            //console.log(e.target.options[ e.target.selectedIndex ].value)


            if (e.target.matches("select[name='atencion_emergencia']")) {
                UserCuestEpisodio.store3(
                    user_id,
                    {
                        "name":e.target.name,
                        "value":e.target.options[ e.target.selectedIndex ].value,
                        "episodio_id":e.target.dataset.episodio_id,
                    }
                )
            }
            if (e.target.matches("select[name='hospitalizacion']")) {
                UserCuestEpisodio.store3(
                    user_id,
                    {
                        "name":e.target.name,
                        "value":e.target.options[ e.target.selectedIndex ].value,
                        "episodio_id":e.target.dataset.episodio_id,
                    }
                )
            }
            if (e.target.matches("select[name='terapia_intensiva']")) {
                UserCuestEpisodio.store3(
                    user_id,
                    {
                        "name":e.target.name,
                        "value":e.target.options[ e.target.selectedIndex ].value,
                        "episodio_id":e.target.dataset.episodio_id,
                    }
                )
            }
            if (e.target.matches("select[name='caso_tipo_medico']")) {
                UserCuestEpisodio.store3(
                    user_id,
                    {
                        "name":e.target.name,
                        "value":e.target.options[ e.target.selectedIndex ].value,
                        "episodio_id":e.target.dataset.episodio_id,
                    }
                )
            }
            if (e.target.matches("select[name='nivel_triaje']")) {
                UserCuestEpisodio.store3(
                    user_id,
                    {
                        "name":e.target.name,
                        "value":e.target.options[ e.target.selectedIndex ].value,
                        "episodio_id":e.target.dataset.episodio_id,
                    }
                )
            }

        })


        /* document.getElementById('model_historia_store').addEventListener("click", function(e){
            alert("aaaa")
            //UserCuestHistoria.create({user_id})
        }) */


    }
    async indexHistoriaTriaje(episodio_id) {
        $("#modal-patient-item").modal("show");
        let d = document
        let selector = d.querySelector("#modal-patient-item .modal-body-2")
            selector.innerHTML = null
            let App = d.createElement('div')
                App.setAttribute("id","App")
                App.classList.add("d-flex","flex-column","h-100")
                selector.insertAdjacentElement("afterBegin",App)

        let colorValidationsTemperatura = (value) => {
                if (value <= 30.4) {
                    return "text-danger";
                } else if (value >= 30.5 && value <= 37.5) {
                    return "text-success";
                } else if (value >= 37.6 && value <= 37.9) {
                    return "text-warning";
                } else if (value >= 38) {
                    return "text-danger";
                } else {

                }
            }


            App.innerHTML= /*html */ `
                <div class="container flex-fill d-flex">
                    <div class="col-12 col-xl-4">
                       <!--  <div class="d-flex flex-wrap">
                            <div class="col-12 p-0 rounded d-flex border">
                            <div class="w-custom-1 btn btn-outline-gray border-0">
                                PESO
                            </div>
                            <input id="peso_19404" data-user_id_paciente="19404" data-episodio_id="27625" data-arrayindex="undefined" type="text" class="sv-peso w-100 text-center input-full-height border-0">
                            <div class="actual_peso_value_19404 height-100 last-result-box w-last-result-box d-flex align-items-center justify-content-center text-secondary">
                                <span class="text-secondary">11 Kg</span>
                            </div>
                        </div>
                        <div class="col-12 p-0 rounded d-flex border">
                            <div class="w-custom-1 btn btn-outline-gray border-0">
                                TALLA
                            </div>
                            <input id="talla_19404" data-user_id_paciente="19404" data-episodio_id="27625" data-arrayindex="undefined" type="text" class="sv-talla w-100 text-center input-full-height border-0">
                            <div class="actual_talla_value_19404 height-100 last-result-box w-last-result-box d-flex align-items-center justify-content-center text-secondary">
                                <span class="text-secondary">10 cm</span>
                            </div>
                        </div>


                        <div class="col-12 p-0 rounded d-flex border">
                            <div onclick="UserCuestTemperatura.index('.modal-body',19404,27625)" class="w-custom-1 btn btn-outline-gray border-0">
                                TEMP
                            </div>
                            <input id="dropdown_pac_temp_19404" data-user_id_paciente="19404" data-episodio_id="27625" data-arrayindex="undefined" type="text" class="sv-temp w-100 text-center input-full-height border-0">
                            <div onclick="UserCuestTemperatura.index('.modal-body',19404,27625)" class="actual_temp_value_19404 height-100 last-result-box w-last-result-box d-flex align-items-center justify-content-center">
                                <span class="text-cyan">9°C</span>
                            </div>
                        </div>


                        <div class="col-12 p-0 rounded d-flex border">
                            <div onclick="UserCuestOximetria.index('.modal-body',19404,27625)" class="w-custom-1 btn btn-outline-gray border-0">
                                OXI
                            </div>
                            <input id="dropdown_pac_oxi_19404" data-user_id_paciente="19404" data-episodio_id="27625" data-arrayindex="undefined" type="text" class="sv-oxi w-100 text-center input-full-height border-0">
                            <div onclick="UserCuestOximetria.index('.modal-body',19404,27625)" class="actual_oxi_value_19404 height-100 last-result-box w-last-result-box d-flex align-items-center justify-content-center">
                                <span class="text-danger">8%</span>
                            </div>
                        </div>


                        <div class="col-12 p-0 rounded d-flex border">
                            <div onclick="UserCuestFc.index('.modal-body',19404,27625)" class="w-custom-1 btn btn-outline-gray border-0">FC</div>
                            <input id="dropdown_pac_fc_19404" data-user_id_paciente="19404" data-episodio_id="27625" data-arrayindex="undefined" type="text" class="sv-fc w-100 text-center input-full-height border-0">
                            <div onclick="UserCuestFc.index('.modal-body',19404,27625)" class="actual_fc_value_19404 height-100 last-result-box w-last-result-box d-flex align-items-center justify-content-center">
                                <span class="text-danger">7 lat/min</span>
                            </div>
                        </div>


                        <div class="col-12 p-0 rounded d-flex border">
                            <button onclick="UserCuestFr.index('.modal-body',19404,27625)" class="w-custom-1 btn btn-outline-gray border-0">FR</button>
                            <input id="dropdown_pac_fr_19404" data-user_id_paciente="19404" data-episodio_id="27625" data-arrayindex="undefined" type="text" class="sv-fr w-100 text-center input-full-height border-0">
                            <div onclick="UserCuestFr.index('.modal-body',19404,27625)" class="actual_fr_value_19404 height-100 last-result-box w-last-result-box d-flex align-items-center justify-content-center">
                                <span class="text-danger text-nowrap">6 resp/min</span>
                            </div>
                        </div>


                        <div class="col-12 p-0 rounded d-flex border">
                            <div onclick="UserCuestGl.index('.modal-body',19404,27625)" class="w-custom-1 btn btn-outline-gray border-0">
                                GL
                            </div>
                            <div class="w-100 flex-lg-fill d-flex flex-column flex-lg-row bg-warning">

                                <input id="dropdown_pac_gl_19404" data-user_id_paciente="19404" data-episodio_id="27625" data-arrayindex="undefined" type="text" placeholder="mg/dl" class="sv-gl w-100 text-center input-full-height border-0">
                                <input id="dropdown_pac_gl_ui_19404" data-user_id_paciente="19404" data-episodio_id="27625" data-arrayindex="undefined" type="text" placeholder="Insulina" class="sv-gl w-100 text-center input-full-height border-0">

                            </div>
                            <div onclick="UserCuestGl.index('.modal-body',19404,27625)" class="w-100 d-flex">
                                <div class="actual_gl_value_19404 height-100 last-result-box w-last-result-box d-flex align-items-center justify-content-center">
                                    <span class="text-danger text-nowrap">5 mg/dl</span>
                                </div>
                                <div class="actual_gl_value_ui_19404 height-100 last-result-box w-last-result-box d-flex align-items-center justify-content-center">
                                    <span class="text-secondary text-nowrap">5 UL</span>
                                </div>
                            </div>

                        </div>


                        <div class="col-12 p-0 rounded d-flex border">
                            <div onclick="UserCuestTa.index('.modal-body',19404,27625)" class="w-custom-1 btn btn-outline-gray border-0">
                                TA
                            </div>
                            <div class="w-100 flex-lg-fill d-flex flex-column flex-lg-row bg-warning">
                                <input id="ta_sis19404" data-user_id_paciente="19404" data-episodio_id="27625" data-arrayindex="undefined" type="text" placeholder="Sis" class="sv-ta w-100 text-center input-full-height border-0">
                                <input id="ta_dia19404" data-user_id_paciente="19404" data-episodio_id="27625" data-arrayindex="undefined" type="text" placeholder="Dia" class="sv-ta w-100 text-center input-full-height border-0">
                                <input id="ta_media19404" data-user_id_paciente="19404" data-episodio_id="27625" data-arrayindex="undefined" type="text" placeholder="Media" class="sv-ta w-100 text-center input-full-height border-0">


                            </div>
                            <div onclick="UserCuestTa.index('.modal-body',19404,27625)" class="height-100 last-result-box w-last-result-box d-flex  flex-column flex-lg-row align-items-center justify-content-center">
                                <div class="actual_ta_value_19404 w-100 text-center">
                                    <span class="text-success">3/2 mmHg</span>
                                </div>
                                <div class="actual_ta_media_value_19404 w-100 text-center">
                                    <span class="text-secondary">1</span>
                                </div>
                            </div>
                        </div> -->
                            <vital-sign
                                title="Temp"
                                attribute="temp"
                                form_data_key="cat_user_cuestionario_84"
                                :episodio_id="${episodio_id}"
                                siglas="°C"
                                miruta="/user_cuest_temperatura/store"
                            ></vital-sign>
                            <vital-sign
                                title="Oxi"
                                attribute="oxi"
                                form_data_key="cat_user_cuestionario_73"
                                :episodio_id="${episodio_id}"
                                siglas="%"
                                miruta="/user_cuest_oximetria/store"
                            ></vital-sign>
                            <vital-sign
                                title="Fc"
                                attribute="fc"
                                form_data_key="cat_user_cuestionario_185"
                                :episodio_id="${episodio_id}"
                                siglas="lat/min"
                                miruta="/user_cuest_fc/store"
                            ></vital-sign>
                            <vital-sign
                                title="Fr"
                                attribute="fr"
                                form_data_key="value"
                                :episodio_id="${episodio_id}"
                                siglas="resp/min"
                                miruta="/user_cuest_fr/store"
                            ></vital-sign>


                    </div>
                    <div class="col-xl-8 p-4">

cljclkjlcxkjaslkdjklas
                    </div>
                </div>
            `


            Vue.component('vital-sign', {
                props: {
                    'title': String,
                    'form_data_key': String,
                    'miruta': String,
                    'episodio_id': Number,
                    'siglas': String,
                    'attribute': String,
                    //'colorvalidation':Function,

                },
                data() {
                    return {
                        loading: false,
                        inputValue: "",
                        observaciones: "",
                        paciente_index: 0,
                        paciente: {},
                        //episodio_id: null,

                    }
                },
                template: /*html*/ `
                    <div class="col-12 p-0 rounded d-flex border mt-1">
                        <div class="w-custom-1 btn btn-outline-gray border-0">
                            {{title.toUpperCase()}}
                        </div>
                        <input
                            v-model="inputValue"
                            @keyup.enter="handleEnter"
                            ref="this.attribute"
                            type="text"
                            class="w-100 text-center input-full-height border-0"
                        >
                        <div class="px-1 height-100 last-result-box w-last-result-box d-flex align-items-center justify-content-center text-secondary">
                            <span v-if="loading" class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </span>
                            <span v-else
                                :class="['text-nowrap',this.getColor]"
                            >
                                {{this.paciente[this.attribute]}} {{this.siglas}}

                            </span>
                        </div>
                    </div>
                `,
                computed:{
                    getColor() {
                        if (this.attribute === "temp") {
                            return colorValidationsTemperatura(this.paciente[this.attribute])
                        }
                    },
                },
                methods: {


                    async store() {
                        console.log(this.form_data_key);
                        this.loading = true
                        let formdata = new FormData();
                            formdata.append("episodio_id", this.episodio_id)
                            formdata.append("user_id", this.paciente.user_id)
                            formdata.append(this.form_data_key, this.inputValue)
                            formdata.append("sintoma_observacion", this.observaciones)
                            formdata.append("created_at", timestamps())
                            formdata.append("_token", $("#_token").val())
                        let result = await post( location.origin+this.miruta, formdata)
                            this.loading = false
                            return true


                    },
                    async handleEnter() {
                        if (this.inputValue !== "") {
                            let result = await this.store()
                                if (result) {
                                    this.paciente[this.attribute] = this.inputValue
                                    pacientes_datos[this.paciente_index] = this.paciente
                                    this.inputValue = ""
                                }

                        } else {
                            alert("Escribe un valor")
                            //this.$refs[this.attribute].focus()
                        }


                    }
                },

                mounted() {
                    //this.episodio_id = episodio_id
                    this.paciente_index = pacientes_datos.findIndex(item => Number(item.episodio_id) === Number(this.episodio_id))
                    this.paciente = pacientes_datos[this.paciente_index]

                },

            })

        let app = new Vue({
                el: '#App',
            })
            //console.log(app);
    }

    munecoAcciones(){

        var sound = new Audio("click_muneco.mp3");
        var bg_success = '#2FA600';
        var bg_primary = '#185BA9';
        var contenedor = document.getElementById('figurahumana');
            contenedor.innerHTML=null;
        //Medidas contenedor 300:ancho 400:alto
        var rsr = Raphael(contenedor, 300, 400);

        //inicio muñeco frontal
        var cabezaCuelloAnterior = rsr.set();
        var cabezaCuelloAnterior_1 = rsr.path("M64,19c0,0,8,4,15,3s8-1,13-4c0,0,4,7,3,13c0,0,2,1,2,3c0,0,5-1,3,6s-3,6-3,6s1,2-2,3c0,0-10,10-14,10 s-8,1-16-10c0,0-3-1-3-3s-3-3-3-5c0,0-3-4,1-7c0,0,0.3-0.5,0.7-1.4C62.1,29.4,65.6,21.4,64,19z").attr({
            class: 'cursor-pointer',
            parent: 'cabezaCuelloAnterior',
            'stroke-width': '0',
            'stroke-opacity': '1',
            'fill': bg_primary
        }).data('id', 'cabezaCuelloAnterior_1');
        var cabezaCuelloAnterior_2 = rsr.path("M81,38l17-4V21c0,0-1-14.5-19-14C62.5,7.5,60,19,60,19v16L81,38z").attr({
            class: 'st1',
            parent: 'cabezaCuelloAnterior',
            'fill': 'none',
            'stroke': bg_primary,
            'stroke-miterlimit': '10'
        }).data('id', 'cabezaCuelloAnterior_2');
        var cabezaCuelloAnterior_3 = rsr.path("M63.5,70.3c0,0,3.5-6.3,2.5-17.3c0,0,5,7,13,8s14-10,14-10s-1.8,11.6,2.1,18.8L63.5,70.3z");
        cabezaCuelloAnterior_3.attr({
            class: 'st1',
            parent: 'cabezaCuelloAnterior',
            'stroke-width': '0',
            'stroke-opacity': '1',
            'fill': bg_primary
        }).data('id', 'cabezaCuelloAnterior_3');
        cabezaCuelloAnterior.attr({
            'name': 'cabezaCuelloAnterior'
        });

        var mienbroInferiorDerechoAnterior = rsr.set();
        var mienbroInferiorDerechoAnterior_1 = rsr.path("M27,395c0-0.7,0-1.3,0-2c5.6-12.8,6.8-26.3,6-40.1c-0.8-14.8-3.3-29.4-1.4-44.4c1.5-11.2,7.1-21.2,8.5-32.6 c1.1-8.8,1.7-17.4,1.1-26.2c-1.2-17.3-2.8-34.6,0.7-51.8c0.7,0,1.3,0,2,0c11.4,5.4,21.1,12.9,29.2,22.6c1.3,1.5,2.9,2.8,4.8,3.4 c0,0.7,0,1.3,0,2c-5.8,17.8-10.8,33.8-13.7,48.4c-1.2,6.2-3,12.2-6.6,17.6c-1.9,2.8-2.5,6.1-2.4,9.5c0.2,7.8-1.5,15.2-3.7,22.5 c-1.8,6.1-4.1,12.1-4.5,18.4c-0.6,9.7-2.5,19.1-0.2,29.1c1.7,7.3,0.6,15.5-0.6,23.2c-0.3,2-1.3,4.4-3.6,4C37.4,398,31.5,399,27,395 z").attr({
            class: 'cursor-pointer',
            parent: 'mienbroInferiorDerechoAnterior',
            'stroke-width': '0',
            'stroke-opacity': '1',
            'fill': bg_primary
        }).data('id', 'mienbroInferiorDerechoAnterior_1');
        mienbroInferiorDerechoAnterior.attr({
            'name': 'mienbroInferiorDerechoAnterior'
        });

        var toraxAnterior = rsr.set();
        var toraxAnterior_1 = rsr.path("M117,74c0,12.8,0,25.7,0,38.5c0,1.3,0.5,2.6-2,2.6c-24.3-0.1-48.7-0.1-73-0.1c-0.9,0-1.2-0.2-1-1 c0.2-2,0.7-3.9,0.7-5.9c0.1-9.8,0.2-19.7,0.1-29.5c-0.1-3.7,1.1-5.4,4.8-6.1c4.9-0.8,10-1.8,14.1-4.7c4-2.7,8.1-3.4,12.7-3.2 c5.5,0.2,11,0,16.5,0.1c1.5,0,3.4-0.3,4.4,0.5C101.1,70.3,109.2,71.6,117,74z").attr({
            class: 'cursor-pointer',
            parent: 'toraxAnterior',
            'stroke-width': '0',
            'stroke-opacity': '1',
            'fill': bg_primary
        }).data('id', 'toraxAnterior_1');
        toraxAnterior.attr({
            'name': 'toraxAnterior'
        });

        var mienbroInferiorIzquierdoAnterior = rsr.set();
        var mienbroInferiorIzquierdoAnterior_1 = rsr.path("M116,198c2.2,21,1.3,41.9-0.8,62.8c-0.4,4,0.7,7.8,1.4,11.8c1.9,11.1,6.1,21.6,8.4,32.6 c2.9,14,1.2,28.2-0.2,42.3c-1.4,13.9-0.9,27.5,3.8,40.8c2.7,7.4,1.3,9.2-6.4,9.8c-0.3,0-0.7,0-1,0c-9.9,0.7-10.9-0.2-10.5-10.2 c0.1-3.7,0.2-7.3-0.6-10.9c-0.3-1.6-0.4-3.4,0-5c3.7-13.8,1.4-27.4-2.2-40.7c-3-10.8-5.4-21.6-5.8-32.8c-0.1-2-0.5-4-1.7-5.7 c-5.3-7.8-6.9-16.9-8.8-25.8c-3.1-14.3-7.9-28.2-12.5-42c0-0.3,0-0.7,0-1c2.1-0.4,3.8-1.4,5.1-3c7.7-10.2,17.9-17.1,28.9-23 C114,198,115,198,116,198z").attr({
            class: 'cursor-pointer',
            parent: 'mienbroInferiorIzquierdoAnterior',
            'stroke-width': '0',
            'stroke-opacity': '1',
            'fill': bg_primary
        }).data('id', 'mienbroInferiorIzquierdoAnterior_1');
        mienbroInferiorIzquierdoAnterior.attr({
            'name': 'mienbroInferiorIzquierdoAnterior'
        });

        var abdomenAnterior = rsr.set();
        var abdomenAnterior_1 = rsr.path("M41,121c0-1.7,0-3.3,0-5c25.3-0.5,50.7-0.5,76,0c0,1.7,0,3.3,0,5c-5.1,15.2-8.3,30.5-4,46.5 c1.2,4.2-0.5,5.7-4.7,5.6c-19.5-0.1-39-0.1-58.5,0c-4.2,0-5.9-1.4-4.7-5.6C49.3,151.5,46.1,136.2,41,121z").attr({
            class: 'cursor-pointer',
            parent: 'abdomenAnterior',
            'stroke-width': '0',
            'stroke-opacity': '1',
            'fill': bg_primary
        }).data('id', 'abdomenAnterior_1');
        abdomenAnterior.attr({
            'name': 'abdomenAnterior'
        });

        var mienbroSuperiorIzquierdoAnterior = rsr.set();
        var mienbroSuperiorIzquierdoAnterior_1 = rsr.path("M118,116c0-12.7,0-25.3,0-38c0-1.3-1.1-3.6,2-3c11.8,5.4,16.1,15.2,17.4,27.5c1.6,16-0.7,32.1,3.7,48.1 c3.6,13.4,2.5,27.8,3.1,41.7c0.3,6.7,1,13.3,2.8,19.7c0,4.7,1.8,11.2-0.5,13.5c-2.3,2.3-8.8,0.5-13.5,0.5c-0.3,0-0.7,0-1,0 c-1.3-2.1-3.9-4.3-3-6.6c2.1-4.9,0.3-10.2,2.1-15.1c2.8-7.2,1.8-14.2-0.9-21.4c-6.1-15.9-10.5-32.3-10.6-49.6 C119.7,127.6,118.6,121.8,118,116z").attr({
            class: 'cursor-pointer',
            parent: 'mienbroSuperiorIzquierdoAnterior',
            'stroke-width': '0',
            'stroke-opacity': '1',
            'fill': bg_primary
        }).data('id', 'mienbroSuperiorIzquierdoAnterior_1');
        mienbroSuperiorIzquierdoAnterior.attr({
            'name': 'mienbroSuperiorIzquierdoAnterior'
        });

        var genitalesAnterior = rsr.set();
        var genitalesAnterior_1 = rsr.path("M80,222c-1,0-2,0-3,0c-2.4-1.2-4.6-2.6-6.3-4.8c-7.4-9-16.2-16.2-26.9-21c-2.1-0.9-3.2-2.3-2.8-4.6 c1-5.9,1-11.9,3-17.6c23.3,0,46.7,0,70,0c0.7,5.3,1.3,10.5,2,15.8c0.4,3.1-0.1,5.4-3.4,6.8c-9.6,4.2-17.3,10.9-24.2,18.6 C86,217.9,83.3,220.3,80,222z").attr({
            class: 'cursor-pointer',
            parent: 'genitalesAnterior',
            'stroke-width': '0',
            'stroke-opacity': '1',
            'fill': bg_primary
        }).data('id', 'genitalesAnterior_1');
        genitalesAnterior.attr({
            'name': 'genitalesAnterior'
        });

        var mienbroSuperiorDerechoAnterior = rsr.set();
        var mienbroSuperiorDerechoAnterior_1 = rsr.path("M26,226c-4.7,0-11.2,1.8-13.5-0.5c-2.3-2.3-0.5-8.8-0.5-13.5c0-1,0-2,0-3c1.3-3.8,1.6-7.8,1.9-11.8 c1.1-15.4,0.4-31.1,3.2-46.3c2.2-11.5,4.3-22.8,3.6-34.6c-0.3-4.1,0-8.3,0.2-12.5C21.7,91.4,25.7,80.7,38,75c1.7,0,3.3-0.6,3.1,2.5 C40.7,85,41,92.5,41,100c-0.6,9.3-1.5,18.6-1.8,27.9c-0.5,17.6-2.3,35.4-9.9,51.2c-6.1,12.6-1.9,24.2-0.8,36 C29,219.7,28.8,222.8,26,226z").attr({
            class: 'cursor-pointer',
            parent: 'mienbroSuperiorDerechoAnterior',
            'stroke-width': '0',
            'stroke-opacity': '1',
            'fill': bg_primary
        }).data('id', 'mienbroSuperiorDerechoAnterior_1');
        mienbroSuperiorDerechoAnterior.attr({
            'name': 'mienbroSuperiorDerechoAnterior'
        });
        //fin muñeco frontal


        //inicio muñeco posterior
        var regionDorsalPosterior = rsr.set();
        var regionDorsalPosterior_1 = rsr.path("M257.9,122c-26.1,0-52.1,0-78.2,0c0.2-2,0.7-4,0.7-6c0.1-10.3,0.2-20.6,0.1-31c-0.1-3.7,1.1-5.6,4.9-6.1 c4.2-0.6,8.7-1.2,12.1-3.7c6.4-4.7,13.6-4.5,20.8-4.3c3.9,0.1,7.8,0,11.7,0.1c1.5,0,3.3-0.1,4.4,0.7c6.1,4.3,13,6.3,20.2,7.8 c1.8,0.4,3.2,1.3,3,3.5C256.3,96,258.3,109,257.9,122z").attr({
            class: 'cursor-pointer',
            parent: 'regionDorsalPosterior',
            'stroke-width': '0',
            'stroke-opacity': '1',
            'fill': bg_primary
        }).data('id', 'regionDorsalPosterior_1');
        regionDorsalPosterior.attr({
            'name': 'regionDorsalPosterior'
        });

        var regionLumbarPosterior = rsr.set();
        var regionLumbarPosterior_1 = rsr.path("M257.9,123c0,1.7,0,3.4,0,5.1c-5.2,15.4-8.5,31-4.1,47.2c1.2,4.3-0.4,5.8-4.8,5.8c-19.6-0.1-39.2,0-58.9-0.1 c-6,0-6.3-0.5-5.2-6.6c2.3-11.9,3-23.8-1.3-35.5c-1.3-3.6-1.7-7.6-2.6-11.4c-0.8-3.2,0.3-4.8,3.7-4.8 C209.2,122.8,233.6,122.9,257.9,123z").attr({
            class: 'cursor-pointer',
            parent: 'regionLumbarPosterior',
            'stroke-width': '0',
            'stroke-opacity': '1',
            'fill': bg_primary
        }).data('id', 'regionLumbarPosterior_1');
        regionLumbarPosterior.attr({
            'name': 'regionLumbarPosterior'
        });

        var cabezaCuelloPosterior = rsr.set();
        var cabezaCuelloPosterior_1 = rsr.path("M205.1,70.2c0.3-3.2,0.6-6.4,0.8-9.6c0.3-5.3-0.6-10.1-3.3-15c-3.6-6.6-4.7-14.2-3.5-21.7 c1.7-10.5,8.6-16.5,22.4-15.4c15,1.2,20.7,10.5,18,27.2c-0.8,4.6-2.3,9-4.7,13.2c-3.9,6.8-1.9,14.1-0.3,21.2 C224.8,70.2,214.9,70.2,205.1,70.2z M201,28.1c0.1,12.2,1.7,15.1,9.9,21.6c2.4,1.9,5.4,0.8,7.6,2.2c4.9,3.1,8.7,0.3,11.9-2.4 c7.5-6,8-14.7,7.5-23.5c-0.2-4.3-1.1-8.6-4.7-11.3c-7.5-5.5-15.8-5.5-24-2C202.2,15.6,200.8,21.9,201,28.1z").attr({
            class: 'cursor-pointer',
            parent: 'cabezaCuelloPosterior',
            'stroke-width': '0',
            'stroke-opacity': '1',
            'fill': bg_primary
        }).data('id', 'cabezaCuelloPosterior_1');
        cabezaCuelloPosterior.attr({
            'name': 'cabezaCuelloPosterior'
        });

        var miembroInferiorDerechoPosterior = rsr.set();
        var miembroinferiorderechoposterior_1 = rsr.path("M259,399.2c-3-1.3-4.3-3.7-4.1-6.9c0.2-4.2,0.5-8.4,0.9-12.6c1.1-13.4-1.8-26.3-5.3-39 c-2.2-8-3.3-16.2-3.6-24.5c-0.1-2.2,0-4.5-1.2-6.4c-6.9-10.8-8.3-23.2-10.6-35.2c-2-10.5-6.5-20.3-8.6-30.8 c-3-14.9-4.2-13.4,10.4-14.4c10.2-0.6,17.4-5.8,21.1-15.6c0.5-1.3,1-2.5,1.6-3.7c0.1-0.1,0.3-0.2,1.2-0.6c0.5,4.5,1.3,8.7,1.5,12.9 c0.6,15.2,0.1,30.5-1.8,45.6c-1.3,10.2,1.9,19.7,3.2,29.5c0.6,4.6,1.9,8.8,3.7,13c5.3,13.1,4.7,26.9,3.8,40.6 c-0.6,8.8-1.4,17.5-1.8,26.3c-0.4,7.3,1.6,12.5,8.2,15.8c1.1,5.2-0.8,6.9-6.1,6.2C267.1,398.8,263,399.2,259,399.2z").attr({
            class: 'cursor-pointer',
            parent: 'miembroInferiorDerechoPosterior',
            'stroke-width': '0',
            'stroke-opacity': '1',
            'fill': bg_primary
        }).data('id', 'miembroinferiorderechoposterior_1');
        miembroInferiorDerechoPosterior.attr({
            'name': 'miembroInferiorDerechoPosterior'
        });
        var miembroInferiorIzquierdoPosterior = rsr.set();
        var miembroInferiorIzquierdoPosterior_1 = rsr.path("M214.3,230.6c0,2,0,4.1,0,6.1c-4.2,17.6-9.8,34.8-13.6,52.5c-3.2,15-8.4,29.5-11.1,44.8 c-3.3,18.8-8.5,37.2-5.7,56.6c0.5,3.3-0.2,6.4-3.2,8.6c-1,0-2,0-3,0c-3.8-0.6-7.7-1.2-11.5-1.8c-1.8-0.3-4-0.4-4.4-2.6 c-0.4-2,1.3-3,2.8-3.8c3.8-2.2,5.1-5.6,5.1-9.8c-0.1-6.9-0.2-13.8-0.8-20.7c-1.4-14.3-3.2-28.7,0.7-42.8c2.6-9.3,6.1-18.3,7.4-28.1 c0.7-5.3,2-10.5,1.7-16c-0.7-16.4-2.9-32.7-2-49.1c0.3-4.8,0.3-9.8,2.4-15.5c0.8,1.9,1.2,2.6,1.5,3.4c3.8,11.3,11.9,16.7,23.7,17.2 C207.6,229.7,210.9,230.3,214.3,230.6z").attr({
            class: 'cursor-pointer',
            parent: 'miembroInferiorIzquierdoPosterior',
            'stroke-width': '0',
            'stroke-opacity': '1',
            'fill': bg_primary
        }).data('id', 'miembroInferiorIzquierdoPosterior_1');
        miembroInferiorIzquierdoPosterior.attr({
            'name': 'miembroInferiorIzquierdoPosterior'
        });
        var regionLumboSacraPosterior = rsr.set();
        var regionLumboSacraPosterior_1 = rsr.path("M259,199.2c0,3.4,0,6.8,0,10.2c-4,9.8-10.2,17.3-21.3,19.3c-10.5,0-21,0-31.5,0c-3-0.7-6-1.1-8.9-2 c-10-3.1-17.4-12.9-16.7-22.8c0.4-5.9,1.7-11.7,2.5-17.5c0.5-3.1,2-4.7,5.4-4.7c20.8,0.1,41.5,0.1,62.3,0c3.4,0,4.8,1.7,5.3,4.7 C257,190.6,258,194.9,259,199.2z").attr({
            class: 'cursor-pointer',
            parent: 'regionLumboSacraPosterior',
            'stroke-width': '0',
            'stroke-opacity': '1',
            'fill': bg_primary
        }).data('id', 'regionLumboSacraPosterior_1');
        regionLumboSacraPosterior.attr({
            'name': 'regionLumboSacraPosterior'
        });

        var miembroSuperiorDerechoPosterior = rsr.set();
        var miembroSuperiorDerechoPosterior_1 = rsr.path("M258,121c0-12.7,0-25.3,0-38c0-1.3-1.1-3.6,2-3c11.8,5.4,16.1,15.2,17.4,27.5c1.6,16-0.7,32.1,3.7,48.1 c3.6,13.4,2.5,27.8,3.1,41.7c0.3,6.7,1,13.3,2.8,19.7c0,4.7,1.8,11.2-0.5,13.5c-2.3,2.3-8.8,0.5-13.5,0.5c-0.3,0-0.7,0-1,0 c-1.3-2.1-3.9-4.3-3-6.6c2.1-4.9,0.3-10.2,2.1-15.1c2.8-7.2,1.8-14.2-0.9-21.4c-6.1-15.9-10.5-32.3-10.6-49.6 C259.7,132.6,258.6,126.8,258,121z").attr({
            class: 'cursor-pointer',
            parent: 'miembroSuperiorDerechoPosterior',
            'stroke-width': '0',
            'stroke-opacity': '1',
            'fill': bg_primary
        }).data('id', 'miembroSuperiorDerechoPosterior_1');
        miembroSuperiorDerechoPosterior.attr({
            'name': 'miembroSuperiorDerechoPosterior'
        });

        var miembroSuperiorIzquierdoPosterior = rsr.set();
        var miembroSuperiorIzquierdoPosterior_1 = rsr.path("M165,231c-4.7,0-11.2,1.8-13.5-0.5c-2.3-2.3-0.5-8.8-0.5-13.5c0-1,0-2,0-3c1.3-3.8,1.6-7.8,1.9-11.8 c1.1-15.4,0.4-31.1,3.2-46.3c2.2-11.5,4.3-22.8,3.6-34.6c-0.3-4.1,0-8.3,0.2-12.5c0.8-12.5,4.7-23.2,17.1-28.9 c1.7,0,3.3-0.6,3.1,2.5c-0.4,7.5-0.1,15-0.1,22.5c-0.6,9.3-1.5,18.6-1.8,27.9c-0.5,17.6-2.3,35.4-9.9,51.2 c-6.1,12.6-1.9,24.2-0.8,36C168,224.7,167.8,227.8,165,231z").attr({
            class: 'cursor-pointer',
            parent: 'miembroSuperiorIzquierdoPosterior',
            'stroke-width': '0',
            'stroke-opacity': '1',
            'fill': bg_primary
        }).data('id', 'miembroSuperiorIzquierdoPosterior_1');
        miembroSuperiorIzquierdoPosterior_1.attr({
            'name': 'miembroSuperiorIzquierdoPosterior'
        });
        //fin muñeco posterior



        var rsrGroups = [toraxAnterior, mienbroInferiorDerechoAnterior, mienbroInferiorIzquierdoAnterior, abdomenAnterior, mienbroSuperiorIzquierdoAnterior, genitalesAnterior, mienbroSuperiorDerechoAnterior, cabezaCuelloAnterior, regionDorsalPosterior, regionLumbarPosterior, cabezaCuelloPosterior, miembroInferiorDerechoPosterior, miembroInferiorIzquierdoPosterior, regionLumboSacraPosterior, miembroSuperiorDerechoPosterior, miembroSuperiorIzquierdoPosterior];
        toraxAnterior.push(toraxAnterior_1);
        mienbroInferiorDerechoAnterior.push(mienbroInferiorDerechoAnterior_1);
        mienbroInferiorIzquierdoAnterior.push(mienbroInferiorIzquierdoAnterior_1);
        abdomenAnterior.push(abdomenAnterior_1);
        mienbroSuperiorIzquierdoAnterior.push(mienbroSuperiorIzquierdoAnterior_1);
        genitalesAnterior.push(genitalesAnterior_1);
        mienbroSuperiorDerechoAnterior.push(mienbroSuperiorDerechoAnterior_1);
        cabezaCuelloAnterior.push(cabezaCuelloAnterior_1, cabezaCuelloAnterior_2, cabezaCuelloAnterior_3);
        regionDorsalPosterior.push(regionDorsalPosterior_1);
        regionLumbarPosterior.push(regionLumbarPosterior_1);
        cabezaCuelloPosterior.push(cabezaCuelloPosterior_1);
        miembroInferiorDerechoPosterior.push(miembroinferiorderechoposterior_1);
        miembroInferiorIzquierdoPosterior.push(miembroInferiorIzquierdoPosterior_1);
        regionLumboSacraPosterior.push(regionLumboSacraPosterior_1);
        miembroSuperiorDerechoPosterior.push(miembroSuperiorDerechoPosterior_1);
        miembroSuperiorIzquierdoPosterior.push(miembroSuperiorIzquierdoPosterior_1);

        //eventos inicio muñeco frontal
        cabezaCuelloAnterior.click(function() {
            //alert("Cabeza y cuello anterior")
            cabezaCuelloAnterior_1.attr({
                'fill': bg_success
            })
            cabezaCuelloAnterior_2.attr({
                'stroke': bg_success,
                'stroke-miterlimit': '10'
            })
            cabezaCuelloAnterior_3.attr({
                'fill': bg_success
            })
        });
        mienbroInferiorDerechoAnterior.click(function() {
            //alert("Cabeza y cuello anterior")
            mienbroInferiorDerechoAnterior_1.attr({
                'fill': bg_success
            })
        });
        toraxAnterior.click(function() {
            //alert("Cabeza y cuello anterior")
            toraxAnterior_1.attr({
                'fill': bg_success
            })
        });
        mienbroInferiorIzquierdoAnterior.click(function() {
            //alert("Cabeza y cuello anterior")
            mienbroInferiorIzquierdoAnterior_1.attr({
                'fill': bg_success
            })
        });
        abdomenAnterior.click(function() {
            //alert("Cabeza y cuello anterior")
            abdomenAnterior_1.attr({
                'fill': bg_success
            })
        });
        mienbroSuperiorIzquierdoAnterior.click(function() {
            //alert("Cabeza y cuello anterior")
            mienbroSuperiorIzquierdoAnterior_1.attr({
                'fill': bg_success
            })
        });
        genitalesAnterior.click(function() {
            //alert("Cabeza y cuello anterior")
            genitalesAnterior_1.attr({
                'fill': bg_success
            })
        });
        mienbroSuperiorDerechoAnterior.click(function() {
            //alert("Cabeza y cuello anterior")
            mienbroSuperiorDerechoAnterior_1.attr({
                'fill': bg_success
            })
        });
        //eventos fin muñeco frontal

        //eventos inicio muñeco posterior
        regionDorsalPosterior.click(function() {
            sound.play()
                //alert("Cabeza y cuello anterior")
            regionDorsalPosterior_1.attr({
                'fill': bg_success
            })
        });
        regionLumbarPosterior.click(function() {
            sound.play()
                //alert("Cabeza y cuello anterior")
            regionLumbarPosterior_1.attr({
                'fill': bg_success
            })
        });
        cabezaCuelloPosterior.click(function() {
            //alert("Cabeza y cuello anterior")
            sound.play()
            cabezaCuelloPosterior_1.attr({
                'fill': bg_success
            })
        });
        miembroInferiorDerechoPosterior.click(function() {
            //alert("Cabeza y cuello anterior")
            sound.play()
            miembroinferiorderechoposterior_1.attr({
                'fill': bg_success
            })
        });
        miembroInferiorIzquierdoPosterior.click(function() {
            //alert("Cabeza y cuello anterior")
            sound.play()
            miembroInferiorIzquierdoPosterior_1.attr({
                'fill': bg_success
            })
        });
        regionLumboSacraPosterior.click(function() {
            //alert("Cabeza y cuello anterior")
            sound.play()
            regionLumboSacraPosterior_1.attr({
                'fill': bg_success
            })
        });
        miembroSuperiorDerechoPosterior.click(function() {
            //alert("Cabeza y cuello anterior")
            sound.play()
            miembroSuperiorDerechoPosterior_1.attr({
                'fill': bg_success
            })
        });
        miembroSuperiorIzquierdoPosterior.click(function() {
            //alert("Cabeza y cuello anterior")
            sound.play()
            miembroSuperiorIzquierdoPosterior_1.attr({
                'fill': bg_success
            })
        });
        //eventos fin muñeco posterior

    }
    getAll(selector, data) {
        loading("#user_cuest_model_all");
        let formdata = new FormData();
        formdata.append("user_id", data.user_id)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", data.fecha)
            //formdata.append("created_at", "2021-04-1")
        post( location.origin+"/user_cuest_historia_medica/getHistorial", formdata)
            .then(response => {
                let chat = "";
                let fecha;
                let tempFecha;
                let f;
                $(selector).html(`
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 p-1">
                                <div class="timeline timeline-inverse">
                                </div>
                            </div>
                        </div>
                    </div>
                `).slideDown("slow");

                if (response.length > 0) {
                    $.each(response, function(indexInArray, value) {
                        let medico = first(medicos_datos.filter(medico => equalsInt(medico.user_id, value.user_id_medico) ) )
                            if (is_null(medico)) {
                                medico = {
                                    "user_id":  value.user_id_medico,
                                    "prefijo": "",
                                    "medico": "No Disponible",
                                    "posicion_id": 1,
                                    "posicion": "No disponible",
                                    "telefono_movil": "+584125963376",
                                    "cat_user_especialidad_id": 67,
                                    "especialidad": "Sin Especialidad",
                                    "genero": "F",

                                }
                            }

                        let episodio_id = pacientes_datos.find(x=> equalsInt(x['user_id'], data.user_id) )['episodio']
                            if (Object.keys(response).length >0) {
                                pacientes_datos.map(x=>{
                                    if (x.user_id == first(response).user_id) {
                                        x.resultados = response;
                                    }
                                });
                            }else{
                                pacientes_datos.map(x=>{
                                    if (x.user_id == data.user_id) {
                                        x.resultados = [];
                                    }
                                });
                            }
                        let imprimir = false

                        if ([
                            "Orden Médica",
                            "Evolución",
                            "Probabilidad diagnóstica",
                            "Plan",
                            "Observación",
                            "Récipe",
                            "Evolución",
                            "Estudio Diagnóstico",
                        ].includes(value.description)) {
                            imprimir = true
                        }
                        fecha = fechaAPPLE(value.created_at)
                        let fecha_grupo = fechaCortaAPPLE(value.created_at)
                        let f1 = value.created_at.split(" ")
                            if ( tempFecha != f1[0] ) {
                                $(".timeline").append(`
                                    <div class="time-label">
                                        <span class="bg-primary">
                                            ${fecha_grupo}
                                        </span>
                                    </div>
                                `);
                                tempFecha = f1[0]
                            }

                            if (tempFecha == f1[0]) {
                                let dato = ``;
                                let coments = "";
                                let valor = "";

                                if (
                                    value.description == "Orden Médica" ||
                                    value.description == "Evolución" ||
                                    value.description == "Pendiente" ||
                                    value.description == "Probabilidad diagnóstica" ||
                                    value.description == "Plan" ||
                                    value.description == "Observación" ||
                                    value.description == "Récipe" ||
                                    value.description == "Estudio Diagnóstico"
                                ) {
                                    if (value.value != null) {
                                        valor = value.value.replace(/\n/g, "<br />");
                                    }
                                    dato = `
                                        ${valor}
                                    `;
                                }
                                if (
                                    value.description == "Laboratorio" ||
                                    value.description == "Imagenes" ||
                                    value.description == "Fotografías" ||
                                    value.description == "Otro"

                                ) {
                                    if (value.coments != null) {
                                        coments = value.coments.replace(/\n/g, "<br />");
                                    }
                                    let imageIcon = "";
                                    if (value.description == "Laboratorio") {
                                        imageIcon = "image/system/icono_laboratorio.svg";
                                    }
                                    if (value.description == "Imagenes") {
                                        imageIcon = `${value.value}`;
                                    }
                                    if (value.description == "Fotografías") {
                                        imageIcon = `${value.value}`;
                                    }
                                    if (value.description == "Otro") {
                                        imageIcon = "image/system/icono_archivo.svg";
                                    }

                                    if (value.value != null) {
                                        valor = `
                                            <img onclick="window.open('${value.value}', '_blank')" style="cursor:pointer;width: 50px;" class="ampliar zoom img-fluid" src='${imageIcon}'>
                                            <br>`;
                                    }
                                    dato = `
                                        ${valor}
                                        ${coments}
                                    `;
                                }
                                let medico_posicion ={
                                    "nombre":"Tratante",
                                    "siglas":"TR",
                                    "color":"success",
                                }
                                try {

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

                                } catch (error) {
                                    console.log("medico:",medico)
                                }

                        let icono_medico = {
                                "icono":"md",
                                "name":"Equipo Médico",
                                "color":"primary",
                            }
                            if ( equalsInt( medico.equipo_salud_id , 2) ) {
                                //console.log("-->", first(medicos_datos.filter(medico => equalsInt(medico.user_id, value.user_id_medico) ) ))
                                icono_medico = {
                                    "icono":"nurse",
                                    "name":"Equipo Enfermeria",
                                    "color":"warning",
                                }
                            }



                                $(".timeline").append(/*html */ `
                                    <div>
                                        <i data-tippy-content="${icono_medico.name}" class="tooltip-${icono_medico.color} fas fa-user-${icono_medico.icono} bg-${icono_medico.color} text-white" aria-hidden="true"></i>
                                        <div class="timeline-item">
                                            <span class="time">

                                            <i class="far fa-clock"></i>
                                            ${fecha}
                                            <a class="m-0 p-0 imprimir"  type="button" id="triggerId${value.description+value.id}" data-type="one" data-name="${value.description}" data-id="${value.id}" data-episodio_id="${episodio_id}" data-impresion="color" >
                                                <i data-tippy-content="Imprimir" class="tooltip-info imprimir m-0 p-0 fas fa-print text-info heartbeat"
                                                style="font-size: 1em;cursor:pointer; margin-left:1em;" data-type="one" data-name="${value.description}" data-id="${value.id}" data-episodio_id="${episodio_id}" data-impresion="color" aria-hidden="true"></i>
                                            </a>
                                            <!-- <div class="btn-group ${imprimir ?'':'d-none'}" style="margin-left:0.5em;">

                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId${value.description+value.id}">
                                                    <a class="dropdown-item imprimir" data-type="one" data-name="${value.description}" data-id="${value.id}" data-episodio_id="${episodio_id}" data-impresion="color" href="#" style="display:none">Color</a>
                                                    <a class="dropdown-item imprimir" data-type="one" data-name="${value.description}" data-id="${value.id}" data-episodio_id="${episodio_id}" data-impresion="bw" href="#">Blanco y negro</a>
                                                    <a class="dropdown-item imprimir" data-type="all" data-name="${value.description}" data-id="${value.id}" data-episodio_id="${episodio_id}" data-impresion="color" href="#">Todos los ${value.description}</a>
                                                </div>
                                            </div> -->

                                            <!--
                                            <i class="fas fa-times text-primary heartbeat delete" data-id="${value.id}" data-delete="${value.description}" style="font-size: 1em;cursor:pointer; margin-left:0.5em;" aria-hidden="true"></i> -->
                                            </span>


                                            <h3 class="timeline-header">
                                            <b>${value.description}</b> | <a href="#">${value.medico}</a> <span data-tippy-content="Equipo ${medico_posicion.nombre}" class="badge tooltip-${medico_posicion.color} bg-${medico_posicion.color} scale-in-hor-left" style="width:2em;">${medico_posicion.siglas}</span></h3>

                                            <div class="timeline-body" style="font-size: 0.5em;    white-space: pre-line;">
                                                    ${dato}
                                            </div>
                                            <div class="timeline-footer">

                                            </div>
                                        </div>
                                    </div>
                                `);


                            }
                    })
                    $(".imprimir").on("click", function() {
                        let description = "";
                            switch(name){
                                case "Orden Médica": description = "orden_medica"; break;
                                case "Evolución": description = "evolucion"; break;
                                case "Pendiente": description = "pendiente"; break;
                                case "Probabilidad diagnóstica": description = "probabilidad_diagnostica"; break;
                                case "Plan": description = "plan"; break;
                                case "Observación": description = "observacion"; break;
                                case "Récipe": description = "recipe"; break;
                                case "Estudio Diagnóstico": description = "estudio_diagnostico"; break;
                                case "Laboratorio": description = "laboratorio"; break;
                                case "Imagenes": description = "imagenes"; break;
                                case "Otro": description = "otro"; break;
                                default: alert("Error. Reporte no encotrado"); return false; break;
                            }
                            if (['Orden Médica'].includes($(this).data('name'))) {
                                window.open(location.origin+`/user/informe/omed/orden_medica/${$(this).data('episodio_id')}/${$(this).data('id')}`)
                                return false
                            }
                            if (['Evolución'].includes($(this).data('name'))) {
                                window.open(location.origin+`/user/informe/nde/evolucion_medica/${$(this).data('episodio_id')}/${$(this).data('id')}`)
                                return false
                            }
                            if (['Récipe'].includes($(this).data('name'))) {
                                window.open(location.origin+`/user/informe/recmed/recipe_medico/${$(this).data('episodio_id')}/${$(this).data('id')}`)
                                return false
                            }
                            if ($(this).data('type')==="one") {

                                window.open(`/user/reporte/${description}/${$(this).data('episodio_id')}/${$(this).data('id')}/${$(this).data('impresion')}`)

                            }else{
                                window.open(`/user/reporte/${description}/${$(this).data('episodio_id')}/all/${$(this).data('impresion')}`)
                            }

                    })
                    $(".delete").on("click", function() {
                        if ($(this).data('delete') == "Laboratorio") {
                            UserCuestLaboratorio.destroy($(this).data('id'), data.user_id)
                        }
                        if ($(this).data('delete') == "Evolución") {
                            UserCuestEvolucion.destroy($(this).data('id'), data.user_id)
                        }
                        if ($(this).data('delete') == "Orden Médica") {
                            UserCuestOrdenMedica.destroy($(this).data('id'), data.user_id)
                        }
                        if ($(this).data('delete') == "Probabilidad diagnóstica") {
                            UserCuestImpresionDiagnostica.destroy($(this).data('id'), data.user_id)
                        }
                        if ($(this).data('delete') == "Plan") {
                            UserCuestPlan.destroy($(this).data('id'), data.user_id)
                        }
                        if ($(this).data('delete') == "Observación") {
                            UserCuestObservacion.destroy($(this).data('id'), data.user_id)
                        }
                        if ($(this).data('delete') == "Imagenes") {
                            UserCuestImagen.destroy($(this).data('id'), data.user_id)
                        }
                        if ($(this).data('delete') == "Fotografías") {
                            UserCuestFotografia.destroy($(this).data('id'), data.user_id)
                        }
                        if ($(this).data('delete') == "Otro") {
                            UserCuestOtroArchivo.destroy($(this).data('id'), data.user_id)
                        }
                        if ($(this).data('delete') == "Récipe") {
                            UserCuestRecipe.destroy($(this).data('id'), data.user_id)
                        }
                        if ($(this).data('delete') == "Estudio Diagnóstico") {
                            UserCuestEstudioDiagnostico.destroy($(this).data('id'), data.user_id)
                        }
                    });
                    activarTooltip()
                } else {
                    $(".timeline").append(`
                        <div>
                            <div class="timeline-item">
                                <div class="timeline-body text-center text-primary font-weight-bold" style="font-size: 0.5em;    white-space: pre-line;">
                                    No posee historia este día
                                </div>
                            </div>
                        </div>
                    `);
                }
                $(".timeline").append(`
                        <div>
                        <i class="far fa-clock bg-gray"></i>
                    </div>
                `)

            });


    }
    async create2(selector, user_id, user_cuest_historia_medica_id) {
        var episode;
        var formdata;
        var option;
        $("#modelId").modal("show")
        $(selector).html(`
            <div>
                <h1 class="text-primary">
                    Historia Médica | Egreso
                </h1>
            </div>
            <div id="model" style="display:none" class="container-fluid">
                <div class="alert bg-gray" role="alert">
                    <div class="row mt-2 mb-2">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 text-center">
                            <b class="text-light h4">N° Historia</b>:<br>
                            <span class="text-primary font-weight-bold" id="hm_historia_id"></span>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 text-center">
                            <b class="text-light h4">N° Episodio</b>:<br>
                            <span class="text-primary font-weight-bold" id="hm_episodio_id"></span>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 text-center">
                            <b class="text-light h4">Paciente</b>:<br>
                            <span class="text-primary font-weight-bold" id="hm_paciente"></span>
                        </div>
                        <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1 col-xl-1 text-center">
                            <b class="text-light h4">Edad</b>:<br>
                            <span class="text-primary font-weight-bold" id="hm_paciente_edad"></span>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 text-center">
                            <b class="text-light h4">Registrado desde </b>:<br>
                            <span class="text-primary font-weight-bold" id="hm_fecha_registro"></span>
                        </div>
                    </div>
                </div>





                <div class="row mt-2">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <button id="btn_submit_historia" class="btn btn-primary btn-block">Finalizar episodio</button>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <button id="regresar" class="btn btn-light text-primary btn-block">Regresar</button>
                    </div>
                </div>
            </div>

        `);
        $("#model").slideDown("slow")
        formdata = new FormData();
        formdata.append("_token", $("#_token").val())
        formdata.append("user_id", user_id)
        post( location.origin+"/user_cuest_historia_medica/create", formdata)
            .then(response => {
                $.each(response, function(indexInArray, valueOfElement) {
                    $("#hm_" + indexInArray).html(valueOfElement)
                    if (indexInArray == "episodio_id") {
                        episode = valueOfElement;
                    }
                });
            });
        post("catEspecialidad/index", formdata)
            .then(response => {
                option = "<option value=''>Seleccione Especialidad</option>";
                $.each(response, function(indexInArray, valueOfElement) {
                    option += `<option value='${valueOfElement.id}'>${valueOfElement.description}</option>`;
                });
                $("#cat_user_especialidad_id").html(option)
            });
        $("#cat_user_especialidad_id").on("change", function() {
            formdata.append("cat_user_especialidad_id", $(this).val())
            post( location.origin+"/user_especialidad/index", formdata)
                .then(response => {
                    option = "<option value=''>Seleccione Médico Tratante</option>";
                    $.each(response, function(indexInArray, valueOfElement) {
                        option += `<option value='${valueOfElement.id}'>${valueOfElement.nombres} ${valueOfElement.apellidos}</option>`;
                    });
                    $("#user_id_medico_tratante").html(option)
                });
        });
        $("#btn_submit_historia").on("click", function() {
            UserCuestHistoria.destroy(user_cuest_historia_medica_id)
                .then(response => {
                    console.log()
                    if (response != undefined) {
                        UserCuestHistoria.index('.modal-body', user_id)
                    }
                })
        });
        $("#regresar").on("click", function() {
            UserCuestHistoria.index('.modal-body', user_id)
        });
        UserCuestAntecedente.create("#antecedente_personal", user_id, "personal")
        UserCuestAntecedente.create("#antecedente_familiar", user_id, "familiar")
        UserCuestAntecedente.create("#antecedente_quirurgico", user_id, "quirurgico")
        UserCuestAntecedente.create("#antecedente_hospitalizacion", user_id, "hospitalizacion")
        UserCuestAntecedente.index("#antecedente_quirurgico_show", user_id, "quirurgico")
        UserCuestAntecedente.index("#antecedente_hospitalizacion_show", user_id, "hospitalizacion")
        return true;
    }
    create(data) {
        const {user_id} = data
        $("#modelId").modal("show")

        $(".modal-body").html(`
            <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
            <div  class="row pt-6" style=" margin-top: 7.5rem !important;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 text-primary">
                    Temperatura  <span id="info" title="Ayuda" class="c-pointer text-success heartbeat float-right h5"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                </div>
            </div>
            <div id="form" class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <input type="number" class="form-control form-control-lg bg-gray-footer-parodi" name="value" id="value" aria-describedby="helpId" placeholder="Nuevo valor">
                    <small id="helpId1" class="form-text text-muted notification"></small>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <input type="datetime-local" class="form-control form-control-lg bg-gray-footer-parodi" name="created_at" id="created_at" aria-describedby="helpId">
                    <small id="helpId1" class="form-text text-muted notification"></small>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <textarea class="form-control form-control-lg bg-gray-footer-parodi mb-3" name="sintoma_observacion" id="sintoma_observacion" rows="2" placeholder="Observación"></textarea>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                </div>


            </div>
            </div>

            <div class="botones-bottom-modal">
                <button id="user_cuest_temperatura_store" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Agregar</button>
                <button id="regresar" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>

            </div>
        `);
        UserCuestPaciente.infoPaciente("#infoPaciente", user_id)
        $("#regresar").on("click", function() {
            UserCuestHistoria.indexHistoria({user_id:user_id})
        });
        $("#user_cuest_temperatura_store").on("click", function() {
           alert("aaaa")
        });

    }
    async edit(selector, user_id, episode) {
        let formdata = new FormData();
        let option_user_id_medico_tratante;
        formdata.append("user_id", user_id);
        formdata.append("episode", episode);
        formdata.append("_token", $("#_token").val())
        post( location.origin+"/user_cuest_ficha_medica/getLastFichaMedica", formdata)
            .then(response => {
                if (response.length > 0) {
                    $("#grupo_sanguineo").val(response[0]['grupo_sanguineo'])
                    $("#peso").val(response[0]['peso'])
                    $("#talla").val(response[0]['talla'])
                    $("#estatura").val(response[0]['estatura'])
                }


            });
        post( location.origin+"/user_cuest_historia_medica/show", formdata)
            .then(user_cuest_historia_medica => {
                $.each(user_cuest_historia_medica, function(indexInArray, valueOfElement) {
                        $(`#${indexInArray}`).val(valueOfElement)
                        if (indexInArray == "cat_user_especialidad_id") {


                            formdata.append("cat_user_especialidad_id", valueOfElement)
                            post( location.origin+"/user_especialidad/index", formdata)
                                .then(user_especialidad => {


                                    let option = "<option value=''>Seleccione Médico Tratante</option>";
                                    $.each(user_especialidad, function(indexInArray, medico) {
                                        option += `<option  ${medico.id==user_cuest_historia_medica['user_id_medico_tratante']?'selected':''} value='${medico.id}'>${medico.nombres} ${medico.apellidos}</option>`;
                                    });
                                    $("#user_id_medico_tratante").html(option)
                                });

                        }

                    })
                    //return response;
            });

    }
    show(selector, user_id, episode) {

        UserCuestHistoria.create(selector, user_id)
            .then(response => {
                UserCuestHistoria.edit(selector, user_id)
            })

    }
    store(user_id, episode) {
        if (UserCuestHistoria.store_validate()) {
            let formdata = new FormData();
            /*
            formdata.append("episode", episode)
            formdata.append("inicio_episodio", timestamps())
                //ingreso
            formdata.append("i_motivo_consulta", $("#i_motivo_consulta").val())
            formdata.append("i_enfermedad_actual", $("#i_enfermedad_actual").val())
            formdata.append("i_examen_fisico", $("#i_examen_fisico").val())
            formdata.append("i_diagnostico", $("#i_diagnostico").val())
            formdata.append("i_plan_trabajo", $("#i_plan_trabajo").val())

            formdata.append("cat_antecedente_personal_id", JSON.stringify($('[name="cat_ant_personal_id[]"]').serializeArray()))
            formdata.append("cat_antecedente_familiar_id", JSON.stringify($('[name="cat_ant_familiar_id[]"]').serializeArray()))


            formdata.append("user_id_medico_tratante", $("#user_id_medico_tratante").val())
            formdata.append("cat_user_especialidad_id", $("#cat_user_especialidad_id").val())*/
            formdata.append("user_id", user_id)
            formdata.append("_token", $("#_token").val())
            formdata.append("created_at", timestamps())
            return post("user_cuest_historia_medica/store", formdata)
        } else {
            return false;
        }
    }
    destroy(user_cuest_historia_medica_id) {
            let formdata = new FormData();
            formdata.append("_token", $("#_token").val())
            formdata.append("user_cuest_historia_medica_id", user_cuest_historia_medica_id)
            return post("/user_cuest_historia_medica/destroy", formdata)
        }
        /*
        getAll(user_id, selector) {
            let formdata = new FormData();
            formdata.append("user_id", user_id);
            formdata.append("_token", $("#_token").val());
            let result = post("user_cuest_historia_medica/index", formdata)
            result.then(response => {
                let row;
                if (response.length == 0) {
                    row += `
                        <tr>
                            <td colspan="5" class="text-center">
                                No existen Episodios
                            </td>
                        </tr>
                    `;
                } else {
                    $.each(response, function(indexInArray, valueOfElement) {
                        if (valueOfElement['fin_episodio'] == "Activo") {
                            $("#user_cuest_historia_medica_create").slideUp('slow')
                        }
                        row += UserCuestHistoria.rowTableIndex(valueOfElement);
                    });
                }

                $(selector).html(row);

            })
            return result;
        }*/
    rowTableIndex(valueOfElement) {

        return `
            <tr id="row_index${valueOfElement.id}">
                <td class="text-center">
                    ${valueOfElement.episode}
                </td>
                <td class="text-center">
                    ${valueOfElement.inicio_episodio}
                </td>
                <td class="text-center">
                    ${valueOfElement.fin_episodio}
                </td>
                <td class="text-center">
                    ${valueOfElement.medico_tratante}
                </td>
                <td >
                    <button data-option="${valueOfElement.episode}" title="Editar ingreso" class="btn btn-primary user_cuest_historia_medica_edit ${valueOfElement.fin_episodio!="Activo"?'d-none':''}"><i class="fa fa-edit" aria-hidden="true"></i></button>
                    <!--<button data-option="${valueOfElement.id}" title="Finalizar Episodio" class="btn btn-success user_cuest_historia_medica_destroy ${valueOfElement.fin_episodio!="Activo"?'d-none':''}"><i class="fa fa-plus" aria-hidden="true"></i></button>-->
                    <button data-option="${valueOfElement.id}" title="Finalizar Episodio" class="btn btn-success user_cuest_historia_medica_egreso ${valueOfElement.fin_episodio!="Activo"?'d-none':''}"><i class="fas fa-sign-out-alt"></i></button>
                    <button data-option="${valueOfElement.id}" title="Informe Egreso" class="btn btn-outline-danger ${valueOfElement.fin_episodio=="Activo"?'d-none':''}"><i class="far fa-file-pdf"></i></button>
                </td>
            </tr>
        `;
    }
    store_validate() {
        let message;
        let model1 = $("#cat_user_especialidad_id");
        let model2 = $("#user_id_medico_tratante");
        let model3 = $("#i_motivo_consulta");
        let model4 = $("#i_enfermedad_actual");
        let model5 = $("#i_examen_fisico");
        let model6 = $("#i_diagnostico");
        let model7 = $("#i_plan_trabajo");
        if (model1.val() == "") {
            message = Component.alertMessage('input_select_empty')
            alert(message['message'])
            model1.focus();
            return false;
        }
        if (model2.val() == "") {
            message = Component.alertMessage('input_select_empty')
            alert(message['message'])
            model2.focus();
            return false;
        }
        if (model3.val() == "") {
            message = Component.alertMessage('input_text_empty')
            alert(message['message'])
            model3.focus();
            return false;
        }
        if (model4.val() == "") {
            message = Component.alertMessage('input_text_empty')
            alert(message['message'])
            model4.focus();
            return false;
        }
        if (model5.val() == "") {
            message = Component.alertMessage('input_text_empty')
            alert(message['message'])
            model5.focus();
            return false;
        }
        if (model6.val() == "") {
            message = Component.alertMessage('input_text_empty')
            alert(message['message'])
            model6.focus();
            return false;
        }
        if (model7.val() == "") {
            message = Component.alertMessage('input_text_empty')
            alert(message['message'])
            model7.focus();
            return false;
        }



        return true;
    }
    async getHistorial(user_id){
        let formdata = new FormData();
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        return await post( location.origin+"/user_cuest_historia_medica/getHistorial", formdata)
    }
    regresar({user_id, selector='#modalTemplate_2_footer'}){
    Component.btn_regresar({
            selector,
            eventModel:"UserCuestHistoria.index('.modal-body',"+user_id+")"
        })
    }
}
