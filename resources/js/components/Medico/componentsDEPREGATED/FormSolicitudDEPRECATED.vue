<template>
    <div class="d-flex flex-column vh-90">
        <div class="bg-gray-1 sticky flex-shrink-1 p-1">
            <div class="d-flex flex-column align-items-start flex-sm-row align-items-sm-center justify-content-between">
                <h3 class="text-primary mb-0">{{$route.name}}</h3>
                <div class="d-flex">
                    <router-link target="_blank" class="btn btn-success mt-1 mr-1 mt-sm-0"
                        to="/areaQuirofano/cupo/index">Plan Quirúrgico</router-link>
                    <router-link class="btn btn-primary-custom mt-1 mt-sm-0"
                        to="/areaQuirofano/index_quirofano">Regresar</router-link>
                </div>
            </div>
        </div>
        <div class="flex-grow-1 overflow-auto">
            <div class="form container">
                <div class="row">

                    <div class="col-12 h5 text-primary font-weight-bold">
                        Servicio médico soliciante
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text text-secondary" for="tipo_cupo">Tipo de cupo:</label>
                            <select  ref="tipo_cupo" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.tipo_cupo" type="text" class="form-control bg-gray-footer-parodi mr-1" name="tipo_cupo" id="tipo_cupo">
                                <option value="Quirúrgico">Quirúrgico</option>
                                <option value="Procedimiento">Procedimiento</option>
                                <option value="Estudio">Estudio</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text text-secondary" for="tipo_cupo">Motivo de asignación de quirófano:</label>
                            <select  ref="tipo_reservacion" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.tipo_reservacion" class="form-control bg-gray-footer-parodi mr-1" name="tipo_reservacion" id="tipo_reservacion">
                                <option value="Emergencia">Emergencia</option>
                                <option value="Electiva">Electiva</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 h5 text-primary font-weight-bold">
                        Datos del paciente
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text text-secondary" for="cedula">Documento de identidad</label>
                            <div class="d-flex align-items-center">
                                <select  @input="updateFormField" v-model="$store.state.formReservacionQuirofano.nacionalidad" id="nacionalidad" class="flex-shrink-1 form-control bg-gray-footer-parodi" name="nacionalidad"  style="width: fit-content;">
                                    <option value="V">V</option>
                                    <option value="E">E</option>
                                    <option value="P">P</option>
                                </select>

                                <div class="input-group">

                                    <input id="cedula" ref="cedula" @change="searchCedula" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.cedula" type="number" class="ml-1 flex-grow-1 form-control bg-gray-footer-parodi" name="cedula" aria-describedby="helpcedula">
                                    <div class="input-group-prepend">
                                        <div :class="{'input-group-text p-0 ml-2 border-0 bg-transparent':true,'d-none':!searchingCedula}">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                            </div>
                            <small id="sms_cedula" class="form-text text-danger notification"></small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text text-secondary" for="email">Correo electrónico</label>
                            <input id="email"  ref="email" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.email" type="email" class="form-control bg-gray-footer-parodi" name="email"  aria-describedby="helpId" placeholder="">
                            <small id="sms_email" class="form-text text-danger notification"></small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text text-secondary" for="nombre">Nombres</label>
                            <input id="nombres" ref="nombres" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.nombres" type="text" class="form-control bg-gray-footer-parodi" name="nombres"  aria-describedby="helpId" placeholder="">
                            <small id="helpId1" class="form-text text-muted notification"></small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text text-secondary" for="apellido">Apellidos</label>
                            <input id="apellidos" ref="apellidos" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.apellidos" type="text" class="form-control bg-gray-footer-parodi" name="apellidos"  aria-describedby="helpId" placeholder="">
                            <small id="helpId1" class="form-text text-muted notification"></small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text text-secondary" for="genero">Género</label>
                            <select id="genero" ref="genero" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.genero" class="form-control bg-gray-footer-parodi" name="genero"  aria-describedby="helpId" placeholder="">
                                <option value="m">Masculino</option>
                                <option value="f">Femenino</option>
                            </select>
                            <small id="helpId1" class="form-text text-muted notification"></small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text text-secondary" for="fnacimiento">Fecha de nacimiento</label>
                            <div class="input-group mb-3">
                                <input type="date" ref="fnacimiento" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.fnacimiento" class="form-control bg-gray-footer-parodi" name="fnacimiento" id="fnacimiento" aria-describedby="helpId" placeholder="">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><i class="fas fa-birthday-cake mr-2"></i>  {{ calcularEdad }} años</span>
                                </div>
                            </div>


                            <small id="helpId1" class="form-text text-muted notification"></small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text text-secondary" for="telefono_movil">Teléfono contacto</label>
                            <input type="number" ref="telefono_movil" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.telefono_movil" class="form-control bg-gray-footer-parodi" name="telefono_movil" id="telefono_movil" aria-describedby="helpId" placeholder="">
                            <small id="help_telefono_movil" class="form-text text-muted notification"></small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text text-secondary" for="telefono_hogar">Teléfono secundario</label>
                            <input type="number"  ref="telefono_hogar" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.telefono_hogar" class="form-control bg-gray-footer-parodi" name="telefono_hogar" id="telefono_hogar" aria-describedby="helpId" placeholder="">
                            <small id="help_telefono_hogar" class="form-text text-muted notification"></small>
                        </div>
                    </div>
                    <div class="col-12 my-3 h5 text-primary font-weight-bold">
                        Datos de la intervención, procedimiento o estudio
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text text-secondary"  for="n_presupuesto">Presupuesto nro:</label>
                            <input ref="n_presupuesto" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.n_presupuesto" type="number" class="form-control bg-gray-footer-parodi" name="n_presupuesto" id="n_presupuesto">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text text-secondary"  for="fecha_reservacion">Día de la círugía o estudio:</label>
                            <input ref="fecha_reservacion" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.fecha_reservacion" type="date" class="form-control bg-gray-footer-parodi" name="fecha_reservacion" id="fecha_reservacion">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text text-secondary"  for="h_inicio">Hora de inicio:</label>
                            <input ref="h_inicio" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.h_inicio" type="time" class="form-control bg-gray-footer-parodi" name="h_inicio" id="h_inicio">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text text-secondary" for="h_fin">Horas (estimadas) de duración:</label>

                            <select
                            ref="h_fin"
                                @input="updateFormField"
                                v-model="$store.state.formReservacionQuirofano.h_fin"
                                class="form-control bg-gray-footer-parodi"
                                name="h_fin"
                                id="h_fin"
                            >
                                <option value="0.25">15 min</option>
                                <option value="0.50">30 min</option>
                                <option value="0.75">45 min</option>
                                <option v-for="numero in numeros" :key="numero" :value="numero">{{ numero }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text text-secondary"  for="dias_hospitalizacion">Días de Hospitalización:</label>
                            <div class="d-flex align-items-center">
                                <input ref="dias_hospitalizacion" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.dias_hospitalizacion" type="number" class="form-control bg-gray-footer-parodi" name="dias_hospitalizacion" id="dias_hospitalizacion">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text text-secondary"  for="dias_hospitalizacion">Días en UTI:</label>
                            <input ref="dias_uti" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.dias_uti" type="number" class="form-control bg-gray-footer-parodi" name="dias_uti" id="dias_uti">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text text-secondary"  for="diagnostico_preoperatorio">Diagnóstico pre-operatorio:</label>
                            <input ref="diagnostico_preoperatorio" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.diagnostico_preoperatorio" type="text" class="form-control bg-gray-footer-parodi" name="diagnostico_preoperatorio" id="diagnostico_preoperatorio">
                        </div>
                    </div>
                    <div class="col-12">
                        <Todolist
                            ref="intervencion"
                            tagValueText="intervencion"
                            titleLabel="Intervención, procedimiento o estudio a realizar"
                            inputType="text"
                            messageAlert="Escribe y confirma (con tecla Enter), al menos una "
                            :isGroup="false"
                            :groupUnique="false"
                        />

                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text text-secondary" for="n_quirofano">Quirófano:</label>
                            <select ref="n_quirofano" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.n_quirofano" class="form-control bg-gray-footer-parodi mr-1" name="n_quirofano"  id="n_quirofano">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="label-text text-secondary" for="anestesia_sugerida">Anestesia sugerida:</label>
                            <select  ref="anestesia_sugerida" @input="updateFormField" v-model="$store.state.formReservacionQuirofano.anestesia_sugerida" class="form-control bg-gray-footer-parodi mr-1" name="anestesia_sugerida" id="anestesia_sugerida">
                                <option value="General">General</option>
                                <option value="Local">Local</option>
                                <option value="Epidural">Epidural</option>
                                <option value="Troncular">Troncular</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="col-12 h5 text-primary font-weight-bold">
                        Estudios y exámenes
                    </div> -->
                    <div class="col-12 h5 text-primary font-weight-bold">
                        Equipos especiales
                    </div>
                    <div class="col-12">
                        <Todolist
                            ref="equipos_especiales"
                            tagValueText="equipos_especiales"
                            titleLabel="Equipos especiales"
                            inputType="select"
                            :dataset="$store.state.equipos_especiales_options"
                            messageAlert="Seleccione y confirme, al menos un equipo especial"
                            :isGroup="false"
                            :groupUnique="false"
                        />

                    </div>

                    <div class="col-12 h5 text-primary font-weight-bold">
                        Datos del médico
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">

                        <Todolist
                            ref="cirujano_principal"
                            tagValueText="cirujano_principal"
                            titleLabel="Cirujano Principal"
                            inputType="select"
                            :datasetGroup="$store.state.especialidadesUnicas"
                            :dataset="$store.state.listadoEquipoCirugia"
                            messageAlert="Selecciona al menos un "
                            :isGroup="true"
                            :groupUnique="false"
                        />


                    </div>

                    <div class="col-12 col-sm-6 col-lg-3">
                        <Todolist
                            ref="ayudante_1"
                            tagValueText="ayudante_1"
                            titleLabel="Ayudante 1"
                            inputType="select"
                            :datasetGroup="$store.state.especialidadesUnicas"
                            :dataset="$store.state.listadoEquipoCirugia"
                            messageAlert="Selecciona al menos un "
                            :isGroup="true"
                            :groupUnique="false"
                        />
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <Todolist
                            ref="ayudante_2"
                            tagValueText="ayudante_2"
                            titleLabel="Ayudante 2"
                            inputType="select"
                            :datasetGroup="$store.state.especialidadesUnicas"
                            :dataset="$store.state.listadoEquipoCirugia"
                            messageAlert="Selecciona al menos un "
                            :isGroup="true"
                            :groupUnique="false"
                        />
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <Todolist
                            ref="ayudante_3"
                            tagValueText="ayudante_3"
                            titleLabel="Ayudante 3"
                            inputType="select"
                            :datasetGroup="$store.state.especialidadesUnicas"
                            :dataset="$store.state.listadoEquipoCirugia"
                            messageAlert="Selecciona al menos un "
                            :isGroup="true"
                            :groupUnique="false"
                        />
                    </div>
                    <div class="col-12 col-sm-6 col-lg-6">
                        <Todolist
                            ref="anestesiologo"
                            tagValueText="anestesiologo"
                            titleLabel="Anestesiólogo"
                            inputType="select"
                            :datasetGroup="$store.state.especialidadesUnicas"
                            :dataset="$store.state.listadoEquipoCirugia"
                            messageAlert="Selecciona al menos un "
                            :isGroup="true"
                            :groupUnique="false"
                        />
                    </div>
                    <!-- <div class="col-12 col-sm-6 col-lg-6">
                        <Todolist
                            ref="instrumentista"
                            tagValueText="instrumentista"
                            titleLabel="Instrumentista"
                            inputType="select"
                            :datasetGroup="$store.state.especialidadesUnicas"
                            :dataset="$store.state.listadoEquipoCirugia"
                            messageAlert="Selecciona al menos un "
                            :isGroup="true"
                            :groupUnique="false"
                        />
                    </div> -->
                    <!-- <div class="col-12 col-sm-6 col-lg-6">
                        <Todolist
                            ref="circulante_cirugia"
                            tagValueText="circulante_cirugia"
                            titleLabel="Circulante de Cirugia"
                            inputType="select"
                            :datasetGroup="$store.state.especialidadesUnicas"
                            :dataset="$store.state.listadoEquipoCirugia"
                            messageAlert="Selecciona al menos un "
                            :isGroup="true"
                            :groupUnique="false"
                        />
                    </div> -->
                    <!-- <div class="col-12 col-sm-6 col-lg-6">
                        <Todolist
                            ref="circulante_anestesia"
                            tagValueText="circulante_anestesia"
                            titleLabel="Circulante de Anestesia"
                            inputType="select"
                            :datasetGroup="$store.state.especialidadesUnicas"
                            :dataset="$store.state.listadoEquipoCirugia"
                            messageAlert="Selecciona al menos un "
                            :isGroup="true"
                            :groupUnique="false"
                        />
                    </div> -->
                    <div class="col-12">
                        <div class="form-group">
                            <label class="label-text text-secondary" for="destino">Destino:</label>
                            <select class="form-control bg-gray-footer-parodi" id="destino">
                                <option value="Hospitalización">Hospitalización</option>
                                <option value="Ambulatorio">Ambulatorio</option>
                                <option value="Domicilio">Domicilio</option>
                                <option value="UTIA">UTIA</option>
                                <option value="UTIP">UTIP</option>
                                <option value="UTIN">UTIN</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group"></div>
                            <label class="label-text text-secondary"  for="aa">Documentos asociados:</label>
                            <div class="d-flex">

                                <input
                                    @change="handleFileChange"
                                    multiple
                                    type="file"
                                    ref="input_"
                                    class="form-control bg-gray-footer-parodi mr-1"
                                    name="input_"
                                    style="height: 43px;"
                                >
                                <button

                                    type="button"
                                    class="btn btn-primary font-weight-bold"
                                >
                                +
                                </button>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div v-for="(item, index) in uploadedFile" :key="index"  class="col-12 col-sm-6">
                                    <div class="list-group-item-input-file my-1 overflow-auto d-flex justify-content-between align-items-center">
                                        <div class="flex-fill d-flex align-items-center">
                                            <i :class="{'pc-pdf text-danger':item.typeFile=='application/pdf', 'pc-imagenes text-info':item.typeFile=='image/jpeg',   ' m-1 display-3':true}"></i>
                                            <div class="flex-fill align-items-start d-flex flex-column">
                                                <input :data-index="index" @input="updateFormFieldFile" v-model="$store.state.formReservacionQuirofano.uploadedFile[index].coments" type="text" class="form-control" placeholder="Describe tu archivo aquí">
                                                <b class="text-secondary d-flex align-items-center text-left overflow-hidden">
                                                    <i class="fas fa-paperclip mr-1"></i>
                                                    <span>
                                                        {{ item.name }}
                                                    </span>
                                                </b>
                                            </div>
                                        </div>
                                        <button @click="destroyFile(index)" class="btn btn-danger mx-1 font-weight-bold" >-</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="flex-shrink-1  p-1 text-center">
            <button v-if="!edit_solicitud" @click="submitForm" id="submit" class="btn btn-success mt-1">Crear solicitud</button>
            <button v-if="edit_solicitud" @click="submitForm" id="submit" class="btn btn-primary mt-1">Actualizar solicitud</button>
            <button v-if="!edit_solicitud" type="button" class="btn btn-info mt-1" @click="resetForm">Limpiar Campos</button>
        </div>

    </div>
</template>

<script>
import { get,is_empty,is_null,is_undefined,post } from '../../../helpers/customHelpers.js';
import { mapState, mapActions } from 'vuex';
import 'select2/dist/css/select2.min.css'; // Importa los estilos CSS de Select2
import 'select2'; // Importa la biblioteca Select2
//import Multiselect from 'vue-multiselect';
//import 'vue-multiselect/dist/vue-multiselect.min.css'; // Importa los estilos CSS
import Todolist from './Todolist.vue'

// Importa la biblioteca Select2
export default {
    props:[
        'edit_solicitud'
    ],
    data() {
        return {
            edad: 0,
            /* numeroSeleccionado: null, */
            numeros: Array.from({ length: 24 }, (_, index) => index + 1), // Genera un arreglo con números del 1 al 24
        };
    },
    components:{
        Todolist,
        //Multiselect
    },
    computed:{
        calcularEdad(){
            const fechaNacimiento = new Date(this.$store.state.formReservacionQuirofano.fnacimiento);
            const fechaActual = new Date();

            const diferencia = fechaActual - fechaNacimiento;
            const edadEnMilisegundos = new Date(diferencia);

            // Extraer el año de la fecha de nacimiento
            const edad = Math.abs(edadEnMilisegundos.getUTCFullYear() - 1970);
            //console.log(edad)
            return String(edad) === "NaN" ? 0 : edad;
        },
        equipoCirugiaPrincipales(){
            return this.$store.state.listadoEquipoCirugia
        },
        equipoAnestesiologos(){
            return this.$store.state.listadoAnestesiologos
        },
        uploadedFile(){
            return this.$store.state.formReservacionQuirofano.uploadedFile
        },
        searchingCedula(){
            return this.$store.getters.searchingCedula
        },
    },
    methods: {

        editForm(){
            if(this.edit_solicitud){
                //this.listadoSolicitudesEstaCargando = true
                let solicitud = this.$store.state.listadoSolicitudesQx.map(x=>x['dias']).flat().find(x=>x['id'] === this.$store.state.edit_solicitud_id) 
                console.log("-->",solicitud)
                this.$store.commit('editFormReservacionQuirofano', solicitud);
                //this.listadoSolicitudesEstaCargando = false
            }
        },
        async searchCedula(){
            //alert("sss")
            let cedula = this.$store.state.formReservacionQuirofano.cedula
                if (!is_empty(cedula)) {
                    this.$store.commit('searchCedula',true)
                    try {

                        let result = await get(location.origin + "/user/profile/getByCedula/"+ cedula)
                            //console.log( result)
                            if (Object.values(result).length > 0) {
                                for (const key in result) {
                                    if (Object.hasOwnProperty.call(this.$store.state.formReservacionQuirofano, key)) {
                                        this.$store.commit('updateFormField', {
                                            formName:"formReservacionQuirofano",
                                            fieldName:key,
                                            fieldValue:result[key],
                                        });
                                    }
                                }
                            }else{
                                this.resetForm()
                            }
                    } catch (error) {
                        this.$store.commit('searchCedula',false)
                        this.resetForm()
                        console.log(error)
                    }

                }else{
                    this.$store.commit('searchCedula',false)
                    this.resetForm()
                }
                this.$store.commit('updateFormField', {
                    formName:"formReservacionQuirofano",
                    fieldName:'cedula',
                    fieldValue:cedula,
                });
            // Simulación de una carga, podrías usar una función de retardo o una llamada a una API aquí
            setTimeout(() => {
                this.$store.commit('searchCedula',false)
            }, 1000); // Cambiar a
        },
        handleFileChange(event) {
            let files = event.target.files;
            let fileArray = []
            //let temp_files = this.$store.state.formReservacionQuirofano.uploadedFile
            //let result = files.map(x=>Array.from(x))
            for (let index = 0; index < files.length; index++) {
                //console.log(element)
                fileArray.push({
                    id:index,
                    coments:"",
                    name: files[index].name,
                    typeFile:files[index].type,
                    file:files[index]
                })
            }




           // console.log("2--->",fileArray)
            this.$store.commit('SET_FILE', fileArray); // Llama a la mutación para almacenar el archivo en Vuex
        },
        async getAnestesiologos(){
            try {
                let model =  await get(location.origin + '/user/especialidad/{id}/anestesiologo' )
                    this.$store.commit('updateListadoAnestesiologos',model)
            } catch (error) {
                console.error('Error al obtener los datos:', error);
                return []
            }
        },
        async getEquipoCirugia(){
            try {
                //let model =  await get(location.origin + '/medico/getMedicos' )
                let model =  await get(location.origin + '/user/especialidad/{id}/medicos' )
                    this.$store.commit('updateListadoEquipoCirugia',model)
            } catch (error) {
                console.error('Error al obtener los datos:', error);
                return []
            }
        },
        updateFormField(event) {
            this.$store.commit('updateFormField', {
                formName:"formReservacionQuirofano",
                fieldName:event.currentTarget.name,
                fieldValue:event.currentTarget.value,
            });
        },
        updateFormFieldFile(event) {
            this.$store.commit('updateFormFieldFile', {
                index: event.currentTarget.dataset.index,
                fieldValue:event.currentTarget.value,
            });
        },
        destroyFile(index){
            //console.log(index)
            let indiceAEliminar = index; // Índice del objeto que deseas eliminar
            let temp_object = this.$store.state.formReservacionQuirofano.uploadedFile
            //console.log(temp_object)
                temp_object = temp_object.filter((item, key) => item.id === Number(indiceAEliminar))

                //temp_object = JSON.stringify(temp_object)
                this.$store.commit('updateFormFiles', {
                    fieldName:'uploadedFile',
                    fieldValue:temp_object
                });

        },
        validate() {
            if (['',null].includes(this.$store.state.formReservacionQuirofano['cedula'])) {
                Swal.fire({
                    icon: "warning",
                    title: "Una cédula es requerida.",
                    didClose: () => {
                        setTimeout(() => this.$refs[ 'cedula' ].focus(), 110);
                    }
                })
                return false
            }
            if (['',null].includes(this.$store.state.formReservacionQuirofano['nombres'])) {
                Swal.fire({
                    icon: "warning",
                    title: "Los nombres del paciente son requeridos.",
                    didClose: () => {
                        setTimeout(() => this.$refs[ 'nombres' ].focus(), 110);
                    }
                })
                return false
            }
            if (['',null].includes(this.$store.state.formReservacionQuirofano['apellidos'])) {
                Swal.fire({
                    icon: "warning",
                    title: "Los apellidos del paciente son requeridos.",
                    didClose: () => {
                        setTimeout(() => this.$refs[ 'apellidos' ].focus(), 110);
                    }
                })
                return false
            }
            if (['',null].includes(this.$store.state.formReservacionQuirofano['fnacimiento'])) {
                Swal.fire({
                    icon: "warning",
                    title: "La fecha de nacimiento del paciente es requerida.",
                    didClose: () => {
                        setTimeout(() => this.$refs[ 'fnacimiento' ].focus(), 110);
                    }
                })
                return false
            }
            if (['',null].includes(this.$store.state.formReservacionQuirofano['n_presupuesto'])) {
                Swal.fire({
                    icon: "warning",
                    title: "Un número de presupuesto es requerido.",
                    didClose: () => {
                        setTimeout(() => this.$refs[ 'n_presupuesto' ].focus(), 110);
                    }
                })
                return false
            }
            if (['',null].includes(this.$store.state.formReservacionQuirofano['fecha_reservacion'])) {
                Swal.fire({
                    icon: "warning",
                    title: "La fecha programada es requerida.",
                    didClose: () => {
                        setTimeout(() => this.$refs[ 'fecha_reservacion' ].focus(), 110);
                    }
                })
                return false
            }
            if (['',null].includes(this.$store.state.formReservacionQuirofano['h_inicio'])) {
                Swal.fire({
                    icon: "warning",
                    title: "La hora de inicio de la programación es requerida.",
                    didClose: () => {
                        setTimeout(() => this.$refs[ 'h_inicio' ].focus(), 110);
                    }
                })
                return false
            }
            if ([,'',null].includes(this.$store.state.formReservacionQuirofano['h_fin'])) {
                Swal.fire({
                    icon: "warning",
                    title: "La hora estimada de fin de la programación es requerida.",
                    didClose: () => {
                        setTimeout(() => this.$refs[ 'h_fin' ].focus(), 110);
                    }
                })
                return false
            }
            if (['',null,"[]"].includes(this.$store.state.formReservacionQuirofano['intervencion'])) {
                if($(this.$refs['intervencion'].childRef()).val() !== ""){
                    this.$refs['intervencion'].handleInput(
                        'intervencion',
                        "Escribe y confirma (con tecla Enter), al menos una "
                    )
                    //handleInput(tagValueText,messageAlert)
                }else{
                    Swal.fire({
                        icon: "warning",
                        title: "Escribe y confirma, al menos una intervención a realizar.",
                        didClose: () => {
                            setTimeout(() => this.$refs['intervencion'].childRef().focus(), 110);
                        }
                    })
                    return false
                }
            }

            if (['',null,"[]"].includes(this.$store.state.formReservacionQuirofano['cirujano_principal'])) {
                Swal.fire({
                    icon: "warning",
                    title: "Selecciona y confirma, al menos un cirujano principal.",
                    didClose: () => {
                        setTimeout(() => $(this.$refs['cirujano_principal'].childRef()).focus(), 110);
                    }
                })
                return false
            }
            /* if (['',null,"[]"].includes(this.$store.state.formReservacionQuirofano['anestesiologo'])) {
                Swal.fire({
                    icon: "warning",
                    title: "Selecciona y confirma, al menos un anestesiologo.",
                    didClose: () => {
                        setTimeout(() => $(this.$refs['anestesiologo'].childRef()).focus(), 110);
                    }
                })
                return false
            } */
            return true
        },
        resetForm() {
            this.$store.commit('resetForm');
        },
        async submitForm() {
            //console.log(location)
            if (this.validate()) {
                if (['',null,"[]"].includes(this.$store.state.formReservacionQuirofano['anestesiologo'])) {
                    this.$store.commit('updateFormFiles', {
                        fieldName:'anestesiologo',
                        fieldValue: JSON.stringify([{"id":"0","description":"SERVICIO DE ANESTESIA"}])
                    });
                }


                let formdata = new FormData()
                    for (const key in this.$store.state.formReservacionQuirofano) {

                            const element = this.$store.state.formReservacionQuirofano[key];

                            formdata.append(key, element)

                    }
                    /* formdata.append("user_id_paciente", 22) */
                let user_id = this.$store.state.formReservacionQuirofano['user_id']
                    formdata.append("user_id", is_null(user_id) ? null : Number(user_id) )
                    //formdata.append("user_id_medico", 22)
                    formdata.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content') )
                    //console.log(formdata)

                    let result= ""
                        
                        if(this.$route.path=="/areaQuirofano/edit_quirofano"){
                            result = await post(location.origin + "/areaQuirofano/updateForm", formdata)
                        }else{
                            result = await post(location.origin + "/areaQuirofano/store", formdata)
                        }

                

                        this.resetForm()
                    Swal.fire({
                        icon: "success",
                        title: "Programación guardada",
                        text:"Los datos de la nueva programación pueden verse en la pantalla del Plan quirúrgico Programado.",
                        didClose: () => {

                            setTimeout(() => location.href = location.origin + "/areaQuirofano/index_quirofano", 110);
                        }
                    })
                //console.log(result)
            }
            // Aquí podrías realizar acciones adicionales, como enviar datos a un servidor
            console.log('Form submitted:', this.formData);
            //this.resetForm();
        }
    },
    created() {

    },
    mounted: async function () {
        await this.getAnestesiologos()
        await this.getEquipoCirugia()
        this.$store.commit('updateEspecialidadesUnicas')


        // Inicializa Select2 en el elemento ref "selectElement"
/*         $( this.$refs['cirujano_principal'].childRef() ).select2();
        $( this.$refs['anestesiologo'].childRef() ).select2();
        $( this.$refs['equipos_especiales'].childRef() ).select2();
        $( this.$refs['ayudante_1'].childRef() ).select2();
        $( this.$refs['ayudante_2'].childRef() ).select2();
        $( this.$refs['ayudante_3'].childRef() ).select2(); */

        $(this.$refs['equipos_especiales'].childRef()).on('select2:select', function (e) {
            //console.log(e.target.value)

            let otroInput = document.querySelector("#otros_equipos_especiales")
                if (e.target.value ==="Otros") {
                    otroInput.classList.replace("d-none","d-block")
                }else{
                    otroInput.classList.replace("d-block","d-none")
                }

        });
        let that = this
       /*  $(this.$refs['cirujano_principal'].childRef()).on('select2:select', function (e) {
            let {tagValueText,messageAlert} = that.$refs['cirujano_principal'].childRef().dataset
            that.executeHandleInput(tagValueText,messageAlert)
        }); */

        this.$refs[ 'cedula' ].focus()

        this.editForm()
    },
    beforeDestroy() {
        // Destruye Select2 al desmontar el componente
        //$( this.$refs['cirujano_principal'].childRef() ).select2('destroy');
        //$( this.$refs['anestesiologo'].childRef() ).select2('destroy');
        //$( this.$refs['equipos_especiales'].childRef() ).select2('destroy');
    }
}
</script>

<style lang="scss" scoped>

.btn-primary-custom {
    color: #ffffff;
    background-color: #5b96df !important;
}
.list-group-item-input-file,
.list-group-item-empty{
    position: relative;
    display: block;
    background-color: transparent;
    border: 2px dashed rgba(0, 0, 0, 0.125);
    text-align: center;
    color: var(--secondary);
    border-radius: 0.25rem;
}

</style>