import {
    get,
    post,
    fotoTemporal,
    loading,
    meses,
    fechaAMD2,
    is_null,
    activarTooltip,
    is_empty,
    timestamps,
    calcularEdad,
    telefonoConfig,
    is_undefined,
    fechaCortaCustom1,
    select,
    validarNumeroConDosDecimales,
    fechaAMD,
    validarPrimerDigito,
} from "../helpers/helpers.js";
import MedicosPaciente from "./MedicosPaciente.js";
import UserProfile from "./UserProfile.js";
import User from "./User.js";
import UserCuestDireccion from "./UserCuestDireccion.js";
import CatUserMunicipio from "./CatUserMunicipio.js";
import CatUserEstado from "./CatUserEstado.js";
import UserCuestUbicacion from "./UserCuestUbicacion.js";
import component from "./Component.js";

import UserType from "./UserType.js";
import UserFamily from "./UserFamily.js";
let userProfile = new UserProfile();
let user = new User();
let userCuestDireccion = new UserCuestDireccion();
//let userCuestUbicacion = new UserCuestUbicacion();
let userType = new UserType();
let userFamily = new UserFamily();
let catUserEstado = new CatUserEstado();
let catUserMunicipio = new CatUserMunicipio();
export default class UserCuestPaciente {
    createPaciente() {
        let clase = this;
        //let index_episodio = pacientes_datos.findIndex(paciente=>paciente.user_id === user_id)
        //let episodio = pacientes_datos[index_episodio]
        $("#modal-patient-item").modal("show");
        document.querySelector(
            "#modal-patient-item .modal-body-2"
        ).innerHTML = /*html */ `

            <div id='AppCreatetPatient' class="fade-in flex-fill d-flex flex-column  overflow-auto">
                <div class="container p-0">
                    <h3 class="text-primary">
                        Datos del Paciente
                    </h3>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label class="label-text text-secondary" for="cedula">Documento de identidad</label>


                                <div class="d-flex align-items-center">
                                    <select ref="nacionalidad"
                                        class="flex-shrink-1 form-control bg-gray-footer-parodi"
                                        style="width: fit-content;" v-model="form.nacionalidad">
                                        <option value="">Seleccione</option>
                                        <option value="V">V</option>
                                        <option value="E">E</option>
                                        <option value="P">P</option>
                                    </select>

                                    <div class="input-group">

                                        <input
                                            v-model="form.cedula"
                                            ref="cedula"
                                            @change="validateCedula()"
                                            type="number"
                                            class="ml-1 flex-grow-1 form-control bg-gray-footer-parodi"
                                        >
                                        <div class="input-group-prepend">
                                            <div
                                                :class="{ 'input-group-text p-0 ml-2 border-0 bg-transparent': true, 'd-none': !loadingSearchCedula }">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                <small v-if="isValidateCedula" :class="['form-text notification',( cedulaExiste ? 'text-danger': 'text-success')]">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Cédula {{cedulaExiste ? ' no disponible para registrar': 'no registrada'}}</span>
                                </small>
                            </div>

                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">

                            <div id="emailAlternativo" class="form-group">
                                <label class="label-text text-secondary" for="email_alternativo">Correo electrónico
                                <span v-if="is_child" class="font-weight-bold">(del representante)</span></label>
                                <input
                                    @change="updateField('email_alternativo')"
                                    v-model="form.email_alternativo"
                                    type="email"
                                    :class="['form-control bg-gray-footer-parodi',{'d-none':!is_child}]"
                                    name="email_alternativo"
                                    id="email_alternativo"
                                    ref="email_alternativo"
                                    required
                                >
                                <input
                                    @change="updateField('email')"
                                    v-model="form.email"
                                    type="email"
                                    :class="['form-control bg-gray-footer-parodi',{'d-none':is_child}]"
                                    name="email"
                                    id="email"
                                    ref="email"
                                    required
                                >

                                <small id="sms_email_alternativo" class="form-text text-danger notification"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label class="label-text text-secondary" for="nombre">Nombres</label>
                                <input v-model="form.nombres" type="text" class="form-control bg-gray-footer-parodi"
                                    name="nombres" id="nombres" aria-describedby="helpId" ref="nombres" required>
                                <small id="helpId1" class="form-text text-muted notification"></small>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label class="label-text text-secondary" for="apellido">Apellidos</label>
                                <input v-model="form.apellidos" type="text" class="form-control bg-gray-footer-parodi"
                                    name="apellidos" id="apellidos" aria-describedby="helpId" ref="apellidos" required>
                                <small id="helpId1" class="form-text text-muted notification"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label class="label-text text-secondary" for="genero">Género</label>
                                <select v-model="form.genero" class="form-control bg-gray-footer-parodi" name="genero"
                                    id="genero" aria-describedby="helpId" ref="genero" required>
                                    <option value="">Seleccione</option>
                                    <option value="m">Masculino</option>
                                    <option value="f">Femenino</option>
                                </select>
                                <small id="helpId1" class="form-text text-muted notification"></small>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">


                            <div class="form-group">
                                <label class="label-text text-secondary" for="fnacimiento">Fecha de nacimiento</label>
                                <div class="input-group mb-3">
                                    <input
                                        ref="fnacimiento"
                                        v-model="form.fnacimiento"
                                        type="date"
                                        class="form-control bg-gray-footer-parodi"
                                    >
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">
                                        <i  class="fas fa-birthday-cake mr-2"></i> {{ calcularEdad() }} años</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label class="label-text text-secondary" for="telefono_movil">Teléfono
                                    Contacto</label>
                                <input id="telefono_movil"
                                    v-model="form.telefono_movil"
                                    ref="telefono_movil"
                                    required type="text"
                                    class="form-control bg-gray-footer-parodi"
                                    @keyup="vPrimerDigito('telefono_movil')"
                                >
                                <small id="help_telefono_movil" class="form-text text-muted notification"></small>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">

                                <label class="label-text text-secondary" for="telefono_hogar">Teléfono
                                    Secundario</label>
                                <input
                                    v-model="form.telefono_hogar"
                                    id="telefono_hogar"
                                    ref="telefono_hogar"
                                    type="text"
                                    class="form-control bg-gray-footer-parodi"
                                    @keyup="vPrimerDigito('telefono_hogar')"
                                >
                                <small id="help_telefono_hogar" class="form-text text-muted notification"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-primary">
                            <div class="h3">
                                Dirección
                            </div>
                        </div>
                    </div>
                    <div id="user_cuest_direccion_create">

                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="cat_estado_id">Estado</label>
                                    <select v-model="form.cat_estado_id" class="form-control bg-gray-footer-parodi"
                                        name="cat_estado_id" id="cat_estado_id" aria-describedby="helpId"
                                        ref="cat_estado_id" required>
                                        <option value="null">Seleccione</option>
                                        <option v-for="(item, index) in cat_estados" :key="index" :value="item.id">
                                            {{ item.description }}</option>
                                    </select>
                                    <small id="helpId1" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="cat_municipio_id">Municipio</label>
                                    <select v-model="form.cat_municipio_id" class="form-control bg-gray-footer-parodi"
                                        name="cat_municipio_id" id="cat_municipio_id" aria-describedby="helpId"
                                        ref="cat_municipio_id" required>
                                        <option value="null">Seleccione</option>
                                        <option v-for="(item, index) in getCatMunicipio" :key="index" :value="item.id">
                                            {{ item.description }}</option>
                                    </select>
                                    <small id="helpId1" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="description">Ciudad</label>
                                    <input v-model="form.description" type="text"
                                        class="form-control bg-gray-footer-parodi" name="description" id="description"
                                        aria-describedby="helpId" ref="description" required>
                                    <small id="helpId1" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="domicilio">Domicilio</label>
                                    <textarea v-model="form.domicilio" class="form-control bg-gray-footer-parodi"
                                        name="domicilio" id="domicilio" rows="2" ref="domicilio" required></textarea>
                                    <small id="helpId1" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">

                            <div class="d-flex align-items-center">
                                <div class="text-center">

                                    <img
                                        onerror="this.src='/image/system/icono-paciente-blanco.svg'"
                                        id="imagen_perfil"
                                        style="width: 80px; height:80px"
                                        :src="form.imagen"
                                        class="imagen-perfil"
                                        alt="Medic default"
                                    >

                                    <br>
                                   <!--<i id="ampliar"
                                        class="heartbeat cursor-pointer mt-1 fas fa-search-plus text-primary mr-1"
                                        style="font-size:1.3em;"></i>
                                    <i id="reducir" class="heartbeat cursor-pointer mt-1 fas fa-search-minus text-primary"
                                        style="font-size:1.3em;"></i>-->
                                </div>
                                <div class="ml-1 flex-fill form-group text-center">
                                    <label class="label-text text-secondary" for="imagen">
                                        Foto

                                    </label>
                                    <input
                                        @change="validarArchivoImagen('imagen')"
                                        type="file"
                                        class="form-control bg-gray-footer-parodi"
                                        name="imagen"
                                        id="imagen"
                                        aria-describedby="helpId"
                                        accept="image/png, image/gif, image/jpeg"
                                    >
                                    <h6>Solo archivos (.jpg o .png)</h6>
                                    <small id="helpId1" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label class="label-text text-secondary" for="">Fecha de ingreso:</label>
                                <input
                                    ref="ingreso"
                                    type="date"
                                    class="form-control bg-gray-footer-parodi"
                                    v-model="form.ingreso">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-primary">
                            <div class="h3">
                                Traslado
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12">
                            <div class="form-group">
                                <label class="label-text text-secondary" for="cat_user_ubicacion_id">
                                    Ubicación Actual:
                                </label>
                                <select @change="updateCatUbicacion1()"
                                    ref="cat_user_ubicacion_id"
                                    name="cat_user_ubicacion_id"
                                    class="form-control bg-gray-footer-parodi"
                                >
                                    <option value="245">Sala de Espera (SE)</option>
                                    <option v-for="(item, index) in getCatUbicacionAreas" :key="index"
                                        :value="item.id">{{ item.description }}</option>
                                </select>
                            </div>
                        </div>
                        <div :class="['col-12', { 'd-none': catUbicacionTemp2.length === 0 }]">
                            <div class="form-group">
                                <select @change="updateCatUbicacion2()"
                                    ref="cat_user_ubicacion_id_2" class="form-control bg-gray-footer-parodi">
                                     <option value="">Seleccione</option>
                                    <option v-for="(item, index) in getCatUbicacionAreas2" :key="index"
                                        :value="item.id">{{ item.coments }}</option>
                                </select>
                            </div>
                        </div>
                        <div :class="['col-12', { 'd-none': catUbicacionTemp3.length === 0 }]">
                            <div class="form-group">
                                <select @change="updateCatUbicacion3()"
                                    ref="cat_user_ubicacion_id_3" class="form-control bg-gray-footer-parodi">
                                    <option value="">Seleccione</option>
                                    <option v-for="(item, index) in getCatUbicacionAreas3" :key="index"
                                        :value="item.id">{{ item.coments }}</option>
                                </select>
                            </div>
                        </div>
                        <div :class="['col-12', { 'd-none': catUbicacionTemp4.length === 0 }]">
                            <div class="form-group">
                                <select @change="updateCatUbicacion4()"
                                    ref="cat_user_ubicacion_id_4" class="form-control bg-gray-footer-parodi">
                                    <option value="">Seleccione</option>
                                    <option v-for="(item, index) in getCatUbicacionAreas4" :key="index"
                                        :value="item.id">{{ item.coments }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div
                        class="row cursor-pointer"
                        data-toggle="collapse"
                        href="#collapseFamiliar"
                        role="button"
                        aria-expanded="false"
                        aria-controls="collapseFamiliar"
                    >
                        <div class="col-12 text-primary">
                            <div class="h3">
                                Familiar
                            </div>
                        </div>
                    </div>
                    <div id="collapseFamiliar" class="collapse row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label class="label-text text-secondary" for="cedula_familiar">Documento de
                                    identidad</label>

                                <input v-model="form.cedula_familiar" ref="cedula_familiar" type="number"
                                    class="ml-1 flex-grow-1 form-control bg-gray-footer-parodi">
                                <small ref="sms_cedula_familiar" id="sms_cedula_familiar"
                                    class="form-text text-danger notification">
                                </small>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label class="label-text text-secondary" for="email_familiar">Correo
                                    electrónico</label>
                                <input ref="email_familiar" v-model="form.email_familiar" type="email"
                                    class="form-control bg-gray-footer-parodi">
                                <small id="sms_email_familiar"
                                    class="form-text text-danger notification"></small>
                            </div>

                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label class="label-text text-secondary" for="nombre_familiar">Nombres</label>
                                <input ref="nombres_familiar" v-model="form.nombres_familiar" type="text"
                                    class="form-control bg-gray-footer-parodi">
                                <small id="helpId1" class="form-text text-muted notification"></small>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label class="label-text text-secondary"
                                    for="apellido_familiar">Apellidos</label>
                                <input ref="apellidos_familiar" v-model="form.apellidos_familiar" type="text"
                                    class="form-control bg-gray-footer-parodi">
                                <small id="helpId1" class="form-text text-muted notification"></small>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label class="label-text text-secondary" for="genero_familiar">Género</label>
                                <select ref="genero_familiar" v-model="form.genero_familiar" type="text"
                                    class="form-control bg-gray-footer-parodi">
                                    <option value="">Seleccione</option>
                                    <option value="m">Masculino</option>
                                    <option value="f">Femenino</option>
                                </select>
                                <small id="helpId1" class="form-text text-muted notification"></small>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label class="label-text text-secondary"
                                    for="cat_user_family_id"
                                >
                                    Vínculo
                                </label>
                                <select ref="cat_user_family_id" v-model="form.cat_user_family_id" type="text"
                                    class="form-control bg-gray-footer-parodi">
                                    <option value="">Seleccione</option>
                                    <option value="1">Abuelo(a)</option>
                                    <option value="2">Amigo(a)</option>
                                    <option value="3">Esposo(a)</option>
                                    <option value="4">Hermano(a)</option>
                                    <option value="5">Hijo(a)</option>
                                    <option value="6">Madre</option>
                                    <option value="7">Padre</option>
                                    <option value="8">Pareja</option>
                                    <option value="9">Sobrino(a)</option>
                                </select>
                                <small id="helpId1" class="form-text text-muted notification"></small>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label
                                    class="label-text text-secondary"
                                    for="telefono_movil_familiar"
                                >
                                    Teléfono
                                    Contacto
                                </label><br>
                                <input
                                    v-model="form.telefono_movil_familiar"
                                    id="telefono_movil_familiar"
                                    ref="telefono_movil_familiar"
                                    type="number"
                                    class="form-control bg-gray-footer-parodi"
                                >
                                <small ref="help_telefono_movil_familiar"
                                    class="form-text text-muted notification"></small>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <button @click="handle_store()" id="user_cuest_model_update"
                                class="font-weight-bold btn btn-success w-100">Registrar Paciente</button>
                        </div>
                        <div class="col-6">
                            <button id="regresar" @click="closeModal()" aria-label="Close"
                                class="font-weight-bold btn btn-primary w-100">Regresar</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        let app = new Vue({
            el: "#AppCreatetPatient",
            data() {
                return {
                    loadingSearchCedula: false,
                    catUbicacionTemp2: [],
                    catUbicacionTemp3: [],
                    catUbicacionTemp4: [],
                    items: pacientes_datos,
                    is_child: false,
                    loading: document.getElementById("loadingScreen"),
                    cat_estados: Array.from(catUserEstado.getAll()),
                    telefonoConfig1: null,
                    telefonoConfig2: null,
                    telefonoConfig3: null,
                    dataPaciente: null,
                    isValidateCedula: false,
                    cedulaExiste: false,
                    formPRUEBA: {
                        email: null,
                        email_alternativo: null,
                        nacionalidad: "V",
                        cedula: null,
                        telefono_movil: "+582126720356",
                        imagen: "/image/system/icono-paciente-blanco.svg",
                        nombres: "ranses",
                        apellidos: "Jimenez",
                        genero: "m",
                        ingreso: fechaAMD(),
                        fnacimiento: fechaAMD(),
                        telefono_hogar: "+582126720356",
                        cat_user_type_id: 1,
                        cat_estado_id: 1,
                        cat_municipio_id: 1,
                        description: "Caracas",
                        domicilio: "Chacaito",
                        cat_user_ubicacion_id:245,
                        nombres_familiar: "Ramon",
                        apellidos_familiar: "Perez",
                        email_familiar: "a@a.com",
                        cedula_familiar: "123456",
                        cat_user_family_id: 1,
                        genero_familiar: "f",
                        telefono_movil_familiar: "+582126720356",
                    },
                    form: {
                        email: null,
                        email_alternativo: null,
                        nacionalidad: "",
                        cedula: null,
                        telefono_movil: null,
                        imagen: "/image/system/icono-paciente-blanco.svg",
                        nombres: null,
                        apellidos: null,
                        genero: "",
                        ingreso: fechaAMD(),
                        fnacimiento: "",
                        telefono_hogar: null,
                        cat_user_type_id: null,
                        cat_estado_id: null,
                        cat_municipio_id: null,
                        description: null,
                        domicilio: null,
                        cat_user_ubicacion_id:245,
                        nombre_familiar: "",
                        apellido_familiar: "",
                        email_familiar: "",
                        cedula_familiar: "",
                        cat_user_family_id: "",
                        genero_familiar: "m",
                        telefono_movil_familiar: "",
                    },
                };
            },
            props: {
                //patient_data: Object,
                //index: Number,
            },
            computed: {
                getCatMunicipio() {
                    this.form.cat_municipio_id = 1;
                    return Array.from(catUserMunicipio.getAll()).filter(
                        (item) =>
                            item["cat_estado_id"] === this.form.cat_estado_id
                    );
                },
                getCatUbicacionAreas() {

                    return cat_ubicaciones
                        .filter(
                            (item) =>
                            [2, 28, 41, 42, 70, 98, 126, 154, 182, 211, 223, 390, 391,237,230].includes(item["id"])
                        )
                        .sort((a, b) => a.orden - b.orden);
                },
                getCatUbicacionAreas2() {
                    return this.catUbicacionTemp2.sort(
                        (a, b) => a.orden - b.orden
                    );
                },
                getCatUbicacionAreas3() {
                    return this.catUbicacionTemp3.sort(
                        (a, b) => a.orden - b.orden
                    );
                },
                getCatUbicacionAreas4() {
                    return this.catUbicacionTemp4.sort(
                        (a, b) => a.orden - b.orden
                    );
                },
            },
            methods: {
                imagePreview(archivo, selector, showImageName = false) {
                    // We create the object of the FileReader class
                    let reader = new FileReader();
                    // We read the uploaded file and pass it to our fileReader.
                    reader.readAsDataURL(archivo);

                    let file = archivo;
                    //We look for the following element where we will show the name of the uploaded file.

                    let { name, size, type } = file;
                    if (showImageName) {
                        //e.target.nextElementSibling.textContent= name
                    }

                    // We tell it that when it is ready, run the internal code.
                    reader.onload = function (load) {
                        document
                            .getElementById(selector)
                            .setAttribute("src", reader.result);
                    };
                },
                validarArchivoImagen(id) {
                    const archivoInput = document.getElementById(id);
                    const archivo = archivoInput.files[0];
                    console.log(archivo);
                    if (archivo) {
                        const extension = archivo.name
                            .split(".")
                            .pop()
                            .toLowerCase();
                        if (
                            !(
                                extension === "jpg" ||
                                extension === "jpeg" ||
                                extension === "png"
                            )
                        ) {
                            Swal.fire({
                                icon: "error",
                                title: "Hubo un error...",
                                text: "Solo se permiten archivos .jpg o .png.",
                            });
                            archivoInput.value = ""; // Limpiar el campo de entrada
                        }
                        this.imagePreview(archivo, "imagen_perfil");
                    }
                },
                async updateCatUbicacion1() {
                    let that = this
                        that.form.cat_user_ubicacion_id = 245
                        that["catUbicacionTemp2"] = []
                        that["catUbicacionTemp3"] = []
                        that["catUbicacionTemp4"] = []
                        if (![null,""].includes(that.$refs["cat_user_ubicacion_id"].value)) {

                            that.form.cat_user_ubicacion_id = Number(
                                that.$refs["cat_user_ubicacion_id"].value
                            );

                            that["catUbicacionTemp2"] = (
                                await get(
                                    location.origin +
                                        "/cat_user_ubicacion/show/" +
                                        that.form.cat_user_ubicacion_id
                                )
                            ).sort((a, b) => a.orden - b.orden);
                        }

                        console.log({
                            "catUbicacionTemp2":that["catUbicacionTemp2"],
                            "catUbicacionTemp3":that["catUbicacionTemp3"],
                            "catUbicacionTemp4":that["catUbicacionTemp4"],
                            "cat_user_ubicacion_id":that.form.cat_user_ubicacion_id
                        });
                },
                async updateCatUbicacion2() {
                    let that = this
                        that.form.cat_user_ubicacion_id = 245
                        that["catUbicacionTemp3"] = []
                        that["catUbicacionTemp4"] = []
                        if (![null,""].includes(that.$refs["cat_user_ubicacion_id_2"].value)) {

                            that.form.cat_user_ubicacion_id = Number(
                                that.$refs["cat_user_ubicacion_id_2"].value
                            );

                            that["catUbicacionTemp3"] = (
                                await get(
                                    location.origin +
                                        "/cat_user_ubicacion/show/" +
                                        that.form.cat_user_ubicacion_id
                                )
                            ).sort((a, b) => a.orden - b.orden);
                        }

                        console.log({
                            "catUbicacionTemp2":that["catUbicacionTemp2"],
                            "catUbicacionTemp3":that["catUbicacionTemp3"],
                            "catUbicacionTemp4":that["catUbicacionTemp4"],
                            "cat_user_ubicacion_id":that.form.cat_user_ubicacion_id
                        });
                },
                async updateCatUbicacion3() {
                    let that = this
                        that.form.cat_user_ubicacion_id = Number(
                            that.$refs["cat_user_ubicacion_id_2"].value
                        );
                        that["catUbicacionTemp4"] = []
                        if (![null,""].includes(that.$refs["cat_user_ubicacion_id_3"].value)) {

                            that.form.cat_user_ubicacion_id = Number(
                                that.$refs["cat_user_ubicacion_id_3"].value
                            );

                            that["catUbicacionTemp4"] = (
                                await get(
                                    location.origin +
                                        "/cat_user_ubicacion/show/" +
                                        that.form.cat_user_ubicacion_id
                                )
                            ).sort((a, b) => a.orden - b.orden);
                        }

                        console.log({
                            "catUbicacionTemp2":that["catUbicacionTemp2"],
                            "catUbicacionTemp3":that["catUbicacionTemp3"],
                            "catUbicacionTemp4":that["catUbicacionTemp4"],
                            "cat_user_ubicacion_id":that.form.cat_user_ubicacion_id
                        });
                },
                async updateCatUbicacion4() {
                    let that = this
                        that.form.cat_user_ubicacion_id = Number(
                            that.$refs["cat_user_ubicacion_id_3"].value
                        );
                        if (![null,""].includes(that.$refs["cat_user_ubicacion_id_4"].value)) {

                            that.form.cat_user_ubicacion_id = Number(
                                that.$refs["cat_user_ubicacion_id_4"].value
                            );
                        }

                        console.log({
                            "catUbicacionTemp2":that["catUbicacionTemp2"],
                            "catUbicacionTemp3":that["catUbicacionTemp3"],
                            "catUbicacionTemp4":that["catUbicacionTemp4"],
                            "cat_user_ubicacion_id":that.form.cat_user_ubicacion_id
                        });
                },

                calcularEdad() {
                    const fechaNacimiento = new Date(this.form.fnacimiento);
                    const fechaActual = new Date();

                    const diferencia = fechaActual - fechaNacimiento;
                    const edadEnMilisegundos = new Date(diferencia);

                    // Extraer el año de la fecha de nacimiento
                    const edad = Math.abs(
                        edadEnMilisegundos.getUTCFullYear() - 1970
                    );
                    //console.log(`Edad --> ${edad} años`);
                    // alert(edad)
                    return String(edad) === "NaN" ? 0 : edad;
                },
                validateForm() {
                    let formNotValidate = true;

                    let inputName = "nacionalidad";
                    let input = this.$refs[inputName];
                    if ([null,""].includes(this.form[inputName]) && formNotValidate) {
                        alert("Una Nacionalidad debe estar seleccionada.");
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "cedula";
                    input = this.$refs[inputName];
                    if ([null,""].includes(this.form[inputName]) && formNotValidate) {
                        alert("El campo cédula no puede estar vacio.");
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "email";
                    input = this.$refs[inputName];
                    if ([null,""].includes(this.form[inputName]) && formNotValidate) {
                        alert(
                            "El campo Correo electrónico no puede estar vacio."
                        );
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "nombres";
                    input = this.$refs[inputName];
                    if (is_empty(this.form[inputName]) && formNotValidate) {
                        alert("El campo Nombres no puede estar vacio.");
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "apellidos";
                    input = this.$refs[inputName];
                    if (is_empty(this.form[inputName]) && formNotValidate) {
                        alert("El campo Apellidos no puede estar vacio.");
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "genero";
                    input = this.$refs[inputName];
                    if (is_empty(this.form[inputName]) && formNotValidate) {
                        alert("El campo Género no puede estar vacio.");
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "fnacimiento";
                    input = this.$refs[inputName];
                    if (is_empty(this.form[inputName]) && formNotValidate) {
                        alert(
                            "El campo Fecha de Nacimiento no puede estar vacio."
                        );
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "telefono_movil";
                    input = this.$refs[inputName];
                    if (is_empty(this.form[inputName]) && formNotValidate) {
                        alert(
                            "El campo Teléfono Contacto no puede estar vacio."
                        );
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "cat_estado_id";
                    input = this.$refs[inputName];
                    console.log(this.form[inputName]);
                    if (is_null(this.form[inputName]) && formNotValidate) {
                        alert("El campo Estado no puede estar vacio.");
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "cat_municipio_id";
                    input = this.$refs[inputName];
                    if (is_null(this.form[inputName]) && formNotValidate) {
                        alert("El campo Municipio no puede estar vacio.");
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "description";
                    input = this.$refs[inputName];
                    if (is_null(this.form[inputName]) && formNotValidate) {
                        alert("El campo Ciudad no puede estar vacio.");
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "domicilio";
                    input = this.$refs[inputName];
                    if (is_null(this.form[inputName]) && formNotValidate) {
                        alert("El campo Domicilio no puede estar vacio.");
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }

                    if (formNotValidate) {
                        return true;
                    } else {
                        return false;
                    }
                },
                async store() {
                    let formData = new FormData();
                    for (const key in this.form) {
                        if (Object.hasOwnProperty.call(this.form, key)) {
                            const element = this.form[key];
                            console.log(key,this.form[key]);
                            if (key === "email") {
                                if (["", null].includes(this.form[key])) {
                                    formData.append(
                                        "email",
                                        this.form["cedula"] +
                                            "@correotemporal.com"
                                    );
                                } else {
                                    //if (["", null].includes(this.form[key])) {
                                        formData.append(
                                            "email",
                                            this.form["email"]
                                        );

                                    //}
                                }
                            } else {
                                formData.append(key, element);
                            }
                        }
                    }
                    formData.append("created_at", timestamps() );
                    formData.append("_token", $("#_token").val());

                    let resultset = await post(
                        location.origin + "/user/paciente/storePaciente",
                        formData
                    );
                    if (resultset.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Paciente Registrado",
                            /* text: "El paciente ya puede visualizarse desde el area indicada.", */
                            didClose: () => {
                                setTimeout(() => {
                                    this.$refs.cedula.focus();
                                }, 110);
                                $("#modal-patient-item").modal("hide");
                            },
                        });
                    }else{
                        console.log(resultset);
                    }
                },
                async updateField(fieldName) {
                    if (fieldName === "cedula") {
                        let result = await this.validateCedula();
                        if (!result.exist) {
                            this.is_a_child();
                        }
                    }
                    if (fieldName === "email") {
                        let result = await this.validateEmail();
                        if (result) {
                            let inputName = "email";
                            let input = this.$refs[inputName];

                            alert(
                                this.form.email +
                                    " ya se encuentra asociado a otro paciente."
                            );
                            this.form.email = this.originalEmail;
                            input.focus();
                        }
                        return false;
                    }
                    if (fieldName === "telefono_movil") {
                       /*  this.form.telefono_movil =
                            this.telefonoConfig1.getNumber();
                        return false; */
                    }
                    if (fieldName === "telefono_hogar") {
                      /*   this.form.telefono_hogar =
                            this.telefonoConfig2.getNumber();
                        return false; */
                    }
                },
                is_a_child() {
                    if (this.form.cedula !== null) {
                        let numeroValido = validarNumeroConDosDecimales(
                            this.form.cedula
                        );
                        if (numeroValido) {
                            this.is_child = true;
                        } else {
                            this.is_child = false;
                        }
                    }
                },
                async validateEmail() {
                    if (this.form.cedula !== "") {
                        let formdata = new FormData();
                        formdata.append("nacionalidad", this.form.nacionalidad);
                        formdata.append("cedula", this.form.cedula);
                        formdata.append("email", this.form.email);
                        formdata.append("_token", $("#_token").val());
                        let result = await post(
                            location.origin + "/user/emailExist",
                            formdata
                        );
                        return result;
                    } else {
                        return {
                            exist: false,
                        };
                    }
                },
                async getDataPaciente() {
                    this.dataPaciente = await get(
                        `user_paciente/getdatapaciente/${user_id}`
                    );
                },
                validarNumeroConDosDecimales(inputValue) {
                    const regex = /^\d+\.\d{2}$/;
                    return regex.test(inputValue);
                },
                async validateCedula() {
                    const numeroValido = this.validarNumeroConDosDecimales(
                        this.form.cedula
                    );
                    if (numeroValido) {
                        this.form.email = `${this.form.cedula}@correotemporal.com`;
                        this.is_child = true;
                    } else {
                        this.is_child = false;
                        this.form.email = ``;
                    }
                    try {
                        this.loadingSearchCedula = true;

                        let response = await get(
                            location.origin + "/getPatient/" + this.form.cedula
                        );
                        console.log(response);
                        this.loadingSearchCedula = false;
                        if (response.exist) {
                            //this.$refs.sms_cedula.innerHTML = "<i class='fas fa-exclamation-triangle'></i> La cédula está registrada"

                            if (response.episodesOpen.length === 0) {
                                Swal.fire({
                                    title: "Cédula registrada!",
                                    html: `
                                                La cédula <b>${
                                                    this.form.cedula
                                                }</b> está asociada al paciente:
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Nombres:</th>
                                                        <th>Apellidos:</th>
                                                        <th>Ubicación actual:</th>
                                                    </tr>
                                                    <tr>
                                                        <td>${
                                                            response.user
                                                                .profile.nombres
                                                        }</td>
                                                        <td>${
                                                            response.user
                                                                .profile
                                                                .apellidos
                                                        }</td>
                                                        <td>${
                                                            is_undefined(
                                                                response
                                                                    .episodesOpen
                                                                    .ubicacion_description
                                                            )
                                                                ? ""
                                                                : response
                                                                      .episodesOpen
                                                                      .ubicacion_description
                                                        }</td>
                                                    </tr>
                                                </table>
                                                <h4>¿Quieres reingresarlo? </h4>
                                                Esta acción creará un nuevo episodio.
                                            `,
                                    allowOutsideClick: false,
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "De acuerdo!",
                                    cancelButtonText: "No!",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        clase.handle_ReingresoPaciente(
                                            response.user.profile
                                        );
                                    } else {
                                        setTimeout(() => {
                                            this.form.cedula = "";
                                            this.$refs.cedula.focus();
                                        }, 110);
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: "¡Episodio activo!",
                                    html: `
                                                La cédula <b>${
                                                    this.form.cedula
                                                }</b> está asociada al paciente:
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Nombres:</th>
                                                        <th>Apellidos:</th>
                                                        <th>Ubicación actual:</th>
                                                    </tr>
                                                    <tr>
                                                        <td>${
                                                            response.user
                                                                .profile.nombres
                                                        }</td>
                                                        <td>${
                                                            response.user
                                                                .profile
                                                                .apellidos
                                                        }</td>
                                                        <td>${
                                                            is_undefined(
                                                                response
                                                                    .episodesOpen
                                                                    .ubicacion_description
                                                            )
                                                                ? ""
                                                                : response
                                                                      .episodesOpen
                                                                      .ubicacion_description
                                                        }</td>
                                                    </tr>
                                                </table>

                                            `,
                                    allowOutsideClick: false,
                                    icon: "warning",
                                    showCancelButton: false,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Ok!",
                                    cancelButtonText: "Cancelar!",
                                }); /* .then(async (result) => {
                                    if (result.isConfirmed) {
                                        //this.areaSiglas =  [null,undefined,'undefined'].includes(localStorage.getItem('area')) ? 'tp': localStorage.getItem('area')
                                        //this.selectorAreaName.textContent = this.items.find(x=>x.siglas === this.areaSiglas).name
                                        this.loading.classList.remove("d-none")
                                        pacientes_datos = await get( location.origin+"/vistas/" + this.areaSiglas )
                                        EventBus.$emit('externalVarChanged', pacientes_datos);
                                        //that.AppBtnTotales(pacientes_datos)
                                        this.loading.classList.add("d-none")


                                        $("#exampleModal").modal("hide")

                                    }
                                }); */
                            }
                        } else {
                            //this.$refs.sms_cedula.innerHTML = "<i class='fas fa-check-circle text-success'></i><span class='text-success'> Cédula no registrada</span>"
                        }

                        return false;
                    } catch (error) {
                        console.log(error);
                        this.loadingSearchCedula = false;
                    }
                },
                /* async validateCedula() {
                    let that = this
                    if (this.form.cedula !== "") {
                        let formdata = new FormData();
                        formdata.append("nacionalidad", this.form.nacionalidad)
                        formdata.append("cedula", this.form.cedula)
                        formdata.append("_token", $("#_token").val())
                        let result = await get(location.origin + "/getPatient/" + this.form.cedula)
                        this.isValidateCedula=true
                        if (result.exist) {

                            this.cedulaExiste=true
                            alert("La cédula "+this.form.cedula+" ya se encuentra asociada a un paciente.")
                            this.form['cedula'] = this.originalCedula
                        }else{
                            this.cedulaExiste=false
                        }
                        console.log("cedula_encontrada->", result)

                        return result
                    } else {
                        return {
                            exist: false
                        }
                    }
                }, */
                vPrimerDigito(param) {
                    validarPrimerDigito(param);
                },
                async handle_store() {
                    let that = this;
                    if (that.validateForm()) {
                        let response = await that.store();
                        if (response.success) {
                            that.items[index_episodio].nombres =
                                response.data.nombres;
                            that.items[index_episodio].apellidos =
                                response.data.apellidos;
                            that.items[index_episodio].cedula =
                                response.data.cedula;
                            that.items[index_episodio].email =
                                response.data.email;
                            that.items[index_episodio].genero =
                                response.data.genero;
                            that.items[index_episodio].sexo =
                                response.data.genero;
                            that.items[index_episodio].imagen =
                                response.data.new_imagen;
                            that.items[index_episodio].nacionalidad =
                                response.data.nacionalidad;
                            that.items[index_episodio].telefono_movil =
                                response.data.telefono_movil;
                            that.items[index_episodio].telefono_hogar =
                                response.data.telefono_hogar;
                            that.items[
                                index_episodio
                            ].paciente = `${response.data.nombres} ${response.apellidos}`;
                            console.log(that.items);

                            // Escuchar cambios en el bus de eventos
                            EventBus.$on("externalVarChanged", (newValue) => {
                                that.items = newValue;
                            });
                            alert(
                                "Datos Actualizados. Los datos fueron actualizados correctamente."
                            );
                            that.closeModal();
                        } else {
                            alert(
                                "Error. Ocurrió un error al guardar los datos."
                            );
                        }
                    }
                },
                async handle_create() {
                    let that = this
                        this.is_a_child();
                        telefonoConfig("#telefono_movil",this.telefonoConfig1, (itiNumber,isValidNumber) => {
                            that.form.telefono_movil = itiNumber;
                            let text = (isValidNumber) ? "<span class='text-success'><i class='far fa-check-circle'></i> Formato correcto</span>" : "<span class='text-danger'><i class='fas fa-exclamation-circle'></i> Formato incorrecto</span>";
                            $("#help_telefono_movil").html(text)
                        });
                        telefonoConfig("#telefono_hogar",this.telefonoConfig2, (itiNumber,isValidNumber) => {
                            that.form.telefono_hogar = itiNumber;
                            let text = (isValidNumber) ? "<span class='text-success'><i class='far fa-check-circle'></i> Formato correcto</span>" : "<span class='text-danger'><i class='fas fa-exclamation-circle'></i> Formato incorrecto</span>";
                            $("#help_telefono_hogar").html(text)
                        });
                        telefonoConfig("#telefono_movil_familiar",this.telefonoConfig3, (itiNumber,isValidNumber) => {
                            that.form.telefono_movil_familiar = itiNumber;
                            let text = (isValidNumber) ? "<span class='text-success'><i class='far fa-check-circle'></i> Formato correcto</span>" : "<span class='text-danger'><i class='fas fa-exclamation-circle'></i> Formato incorrecto</span>";
                            $("#help_telefono_movil_familiar").html(text)
                        });

                },
                closeModal() {
                    /* this.$store.commit('updateDinamicComponent', {
                        is_dismounted: true,
                        customComponent: null,
                        patient_data: null,
                        index: null
                    }); */

                    $("#modal-patient-item").modal("hide");
                },
            },
            mounted() {
                this.handle_create();
                //console.log(this.dataPaciente);
                /* let that = this
                let { editDataPaciente } = this.$store.state
                 */
                //console.log(this.$refs.cedula);
            },
        });
    }
    handle_ReingresoPaciente(profile) {
        console.log(profile);
        $("#modal-patient-item").modal("show");
        document.querySelector(
            "#modal-patient-item .modal-body-2"
        ).innerHTML = /*html */ `
            <div id="AppReingresoPaciente" class="flex-fill p-1 d-flex flex-column overflow-auto">

                <div class="flex-fill mt-1 d-flex flex-column rounded overflow-auto">
                    <div class="container">
                        <h3 class="text-primary">Reingreso del Paciente</h3>
                        <div class="row">
                            <div class="col-12 d-flex flex-column">
                                <div class="flex-fill mb-1 p-1 card">
                                    <div class="d-flex align-items-center">
                                        <img onerror="this.src='/image/system/icono-paciente-blanco.svg';"
                                            :src="dataPaciente.imagen"
                                            data-tippy-content="Imagen del paciente" alt="..."
                                            class="tooltip-primary border border-primary rounded-circle m-1 d-block"
                                            style="width: 1.5cm; height: 1.5cm;"
                                        >
                                        <div data-tippy-content="Nombre del paciente"
                                            class="tooltip-primary ml-1 text-primary flex-grow-1 h4 mb-0">
                                            {{ dataPaciente.nombres }} {{ dataPaciente.apellidos }}
                                            <small class="text-light" style="font-size: 0.7em;">#{{ dataPaciente.user_id }}</small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div data-tippy-content="Cédula del paciente" class="tooltip-primary flex-fill pl-1">
                                            <b class="text-primary" style="font-size: 0.8rem;">Cédula</b>
                                            <div class="text-secondary">
                                                {{ dataPaciente.nacionalidad + dataPaciente.cedula }}
                                            </div>
                                        </div>
                                        <div data-tippy-content="Edad"
                                            class="tooltip-primary flex-fill pl-1 border-left border-right">
                                            <b class="text-primary" style="font-size: 0.8rem;">Edad</b>
                                            <div class="text-secondary">{{ getEdad() }}</div>
                                        </div>
                                        <div data-tippy-content="Sexo" class="tooltip-primary flex-fill pl-1">
                                            <b class="text-primary" style="font-size: 0.8rem;">Sexo</b>
                                            <div class="text-secondary text-uppercase">{{ dataPaciente.genero }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="">Fecha de ingreso:</label>
                                    <input ref="ingreso" v-model="ingreso" type="date" class="form-control bg-gray-footer-parodi">
                                </div>

                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="cat_user_ubicacion_id">Nueva
                                        Ubicación:</label>
                                    <select
                                        @change="updateCatUbicacion1()"
                                        ref="cat_user_ubicacion_id"
                                        name="cat_user_ubicacion_id"
                                        class="form-control bg-gray-footer-parodi"
                                    >
                                        <option value="245">Sala de Espera (SE)</option>
                                        <option v-for="(item, index) in getCatUbicacionAreas" :key="index" :value="item.id">{{
                                            item.description }}</option>
                                    </select>
                                </div>
                            </div>
                            <div :class="['col-12', { 'd-none': catUbicacionTemp2.length === 0 }]">
                                <div class="form-group">
                                    <select
                                        @change="updateCatUbicacion2()"
                                        ref="cat_user_ubicacion_id_2"
                                        class="form-control bg-gray-footer-parodi"
                                    >
                                        <option value="">Seleccione</option>
                                        <option
                                            v-for="(item, index) in getCatUbicacionAreas2"
                                            :key="index"
                                            :value="item.id">
                                            {{item.coments }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div :class="['col-12', { 'd-none': catUbicacionTemp3.length === 0 }]">
                                <div class="form-group">
                                    <select
                                        @change="updateCatUbicacion3()"
                                        ref="cat_user_ubicacion_id_3"
                                        class="form-control bg-gray-footer-parodi"
                                    >
                                        <option value="">Seleccione</option>
                                        <option
                                            v-for="(item, index) in getCatUbicacionAreas3"
                                            :key="index"
                                            :value="item.id">
                                            {{item.coments }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div :class="['col-12', { 'd-none': catUbicacionTemp4.length === 0 }]">
                                <div class="form-group">
                                    <select
                                        @change="updateCatUbicacion4()"
                                        ref="cat_user_ubicacion_id_4"
                                        class="form-control bg-gray-footer-parodi"
                                    >
                                        <option value="">Seleccione</option>
                                        <option
                                            v-for="(item, index) in getCatUbicacionAreas4"
                                            :key="index" :value="item.id"
                                        >
                                            {{item.coments }}
                                        </option>
                                    </select>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="rounded d-flex mt-1">
                    <button @click="submit()" id="submit" class="flex-fill btn btn-success mr-1">
                        Reingresar paciente
                    </button>
                    <button class="flex-fill btn btn-primary" data-dismiss="modal" aria-label="Close">
                        Cancelar
                    </button>

                </div>

            </div>
        `;
        let app = new Vue({
            el: "#AppReingresoPaciente",
            name: "FormReingresoPaciente",
            props: {
                /*   index_row: Number,
                    dataPaciente: Object */
            },
            components: {
                //CintilloModal,
            },
            data() {
                return {
                    pacientes: pacientes_datos,
                    loading: document.getElementById("loadingScreen"),
                    user_id_paciente: null,
                    ingreso: fechaAMD(),
                    dataPaciente: [],
                    areaSiglas: "",
                    cat_user_ubicacion_id: 245,
                    catUbicacionTemp2: [],
                    catUbicacionTemp3: [],
                    catUbicacionTemp4: [],
                };
            },
            methods: {
                getEdad() {
                    return calcularEdad(this.dataPaciente.fnacimiento);
                },
                async getAreaData() {
                    this.areaSiglas = [null, undefined, "undefined"].includes(
                        localStorage.getItem("area")
                    )
                        ? "tp"
                        : localStorage.getItem("area");
                    //this.selectorAreaName.textContent = this.items.find(x=>x.siglas === this.areaSiglas).name
                    this.loading.classList.remove("d-none");
                    pacientes_datos = await get(
                        location.origin + "/vistas/" + this.areaSiglas
                    );
                    EventBus.$emit("externalVarChanged", pacientes_datos);
                    //that.AppBtnTotales(pacientes_datos)
                    this.loading.classList.add("d-none");
                },
                async submit() {
                    let formdata = new FormData();
                    formdata.append(
                        "cat_user_ubicacion_id",
                        this.cat_user_ubicacion_id
                    );
                    formdata.append("ingreso", this.ingreso);
                    formdata.append("value", "Reingreso");
                    formdata.append("user_id", this.user_id_paciente);
                    formdata.append("user_id_paciente", this.user_id_paciente);
                    formdata.append("created_at", timestamps());
                    formdata.append("_token", $("#_token").val());

                    await post(
                        location.origin +
                            "/user_cuest_ubicacion/storeReingreso",
                        formdata
                    );
                    this.getAreaData();
                    $("#modal-patient-item").modal("hide");
                },
                async getPacientesActivos() {
                    try {
                        let model = await get(
                            location.origin +
                                "/vistas/" +
                                this.$store.state.ruta
                        );

                        $("#modal-patient-item").modal("hide");
                    } catch (error) {
                        console.error("Error al obtener los datos:", error);

                        return [];
                    }
                },
                async updateCatUbicacion1() {
                    let that = this
                        that.cat_user_ubicacion_id = 245
                        that["catUbicacionTemp2"] = []
                        that["catUbicacionTemp3"] = []
                        that["catUbicacionTemp4"] = []
                        if (![null,""].includes(that.$refs["cat_user_ubicacion_id"].value)) {

                            that.cat_user_ubicacion_id = Number(
                                that.$refs["cat_user_ubicacion_id"].value
                            );

                            that["catUbicacionTemp2"] = (
                                await get(
                                    location.origin +
                                        "/cat_user_ubicacion/show/" +
                                        that.cat_user_ubicacion_id
                                )
                            ).sort((a, b) => a.orden - b.orden);
                        }

                        console.log({
                            "catUbicacionTemp2":that["catUbicacionTemp2"],
                            "catUbicacionTemp3":that["catUbicacionTemp3"],
                            "catUbicacionTemp4":that["catUbicacionTemp4"],
                            "cat_user_ubicacion_id":that.cat_user_ubicacion_id
                        });
                },
                async updateCatUbicacion2() {
                    let that = this
                        that.cat_user_ubicacion_id = 245
                        that["catUbicacionTemp3"] = []
                        that["catUbicacionTemp4"] = []
                        if (![null,""].includes(that.$refs["cat_user_ubicacion_id_2"].value)) {

                            that.cat_user_ubicacion_id = Number(
                                that.$refs["cat_user_ubicacion_id_2"].value
                            );

                            that["catUbicacionTemp3"] = (
                                await get(
                                    location.origin +
                                        "/cat_user_ubicacion/show/" +
                                        that.cat_user_ubicacion_id
                                )
                            ).sort((a, b) => a.orden - b.orden);
                        }

                        console.log({
                            "catUbicacionTemp2":that["catUbicacionTemp2"],
                            "catUbicacionTemp3":that["catUbicacionTemp3"],
                            "catUbicacionTemp4":that["catUbicacionTemp4"],
                            "cat_user_ubicacion_id":that.cat_user_ubicacion_id
                        });
                },
                async updateCatUbicacion3() {
                    let that = this
                        that.cat_user_ubicacion_id = Number(
                            that.$refs["cat_user_ubicacion_id_2"].value
                        );
                        that["catUbicacionTemp4"] = []
                        if (![null,""].includes(that.$refs["cat_user_ubicacion_id_3"].value)) {

                            that.cat_user_ubicacion_id = Number(
                                that.$refs["cat_user_ubicacion_id_3"].value
                            );

                            that["catUbicacionTemp4"] = (
                                await get(
                                    location.origin +
                                        "/cat_user_ubicacion/show/" +
                                        that.cat_user_ubicacion_id
                                )
                            ).sort((a, b) => a.orden - b.orden);
                        }

                        console.log({
                            "catUbicacionTemp2":that["catUbicacionTemp2"],
                            "catUbicacionTemp3":that["catUbicacionTemp3"],
                            "catUbicacionTemp4":that["catUbicacionTemp4"],
                            "cat_user_ubicacion_id":that.cat_user_ubicacion_id
                        });
                },
                async updateCatUbicacion4() {
                    let that = this
                        that.cat_user_ubicacion_id = Number(
                            that.$refs["cat_user_ubicacion_id_3"].value
                        );
                        if (![null,""].includes(that.$refs["cat_user_ubicacion_id_4"].value)) {

                            that.cat_user_ubicacion_id = Number(
                                that.$refs["cat_user_ubicacion_id_4"].value
                            );
                        }

                        console.log({
                            "catUbicacionTemp2":that["catUbicacionTemp2"],
                            "catUbicacionTemp3":that["catUbicacionTemp3"],
                            "catUbicacionTemp4":that["catUbicacionTemp4"],
                            "cat_user_ubicacion_id":that.cat_user_ubicacion_id
                        });
                },
            },
            computed: {
                getCatUbicacionAreas() {

                    return cat_ubicaciones
                    .filter(
                        (item) =>
                        [2, 28, 41, 42, 70, 98, 126, 154, 182, 211, 223, 390, 391,237,230].includes(item["id"])
                    )
                    .sort((a, b) => a.orden - b.orden);
                },
                getCatUbicacionAreas2() {
                    return this.catUbicacionTemp2.sort(
                        (a, b) => a.orden - b.orden
                    );
                },
                getCatUbicacionAreas3() {
                    return this.catUbicacionTemp3.sort(
                        (a, b) => a.orden - b.orden
                    );
                },
                getCatUbicacionAreas4() {
                    return this.catUbicacionTemp4.sort(
                        (a, b) => a.orden - b.orden
                    );
                },
            },
            mounted() {
                this.dataPaciente = profile;
                this.user_id_paciente = profile.user_id;
            },
        });
    }
    index(selector, user_id) {
        $("#modelId").modal("show");
        $(selector).html(`

        `);
    }
    async create(selector, user_id) {
        //CREATE PARA REGISTRO PACIENTE EXTERNO
        $(selector).html(`
            <div class="container">
                <div class="row mt-3">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-primary">
                        <div class="h3">
                            Datos del paciente
                        </div>
                    </div>
                </div>

                <div id="user_create" ></div>

                <div id="user_profile_create" ></div>
                <input style="display:none" type="file" class="form-control form-control-lg bg-gray-footer-parodi" name="imagen" id="imagen" aria-describedby="helpId" placeholder="">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-primary">
                        <div class="h3">
                            Dirección
                        </div>
                    </div>
                </div>
                <div id="user_cuest_direccion_create" ></div>

                <div id="user_cuest_pruebaCovid_create"></div>

                <div id="user_cuest_ubicacion_create"></div>

                <div class="row mb-3">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-1">
                        <button id="user_cuest_paciente_store" class="btn btn-success btn-lg btn-block">Continuar</button>
                    </div>
                </div>

            </div>
        `);
        //VISTAS
        user.create2("#user_create");
        userProfile.create("#user_profile_create");
        userCuestDireccion.create("#user_cuest_direccion_create");
        //UserCuestPruebaCovid.create("#user_cuest_pruebaCovid_create")
        //UserCuestPruebaCovid.resultadoCuestionarioCovid("#paso2_recomendacion")
        this.bienvenidaPaciente();
        telefonoConfig("#telefono_movil");
        //ACCIONES
        $("#user_cuest_paciente_store").on("click", function () {
            if (user.validate2()) {
                if (userProfile.validate()) {
                    if (userCuestDireccion.validate()) {
                        //if (UserCuestPruebaCovid.validate()) {
                        if (userCuestUbicacion.validate()) {
                            user.store()
                                .then((response) => {
                                    //console.log("User:", response)
                                    let email = $("#email");
                                    let cedula = $("#cedula");
                                    if (response == "cedula_registrado") {
                                        message =
                                            component.alertMessage(
                                                "cedula_registrado"
                                            );
                                        alert(message["message"]);
                                        cedula.trigger("focus");
                                        return false;
                                    }
                                    if (response == "email_registrado") {
                                        message =
                                            Component.alertMessage(
                                                "email_registrado"
                                            );
                                        alert(message["message"]);
                                        email.trigger("focus");
                                        return false;
                                    }
                                    return response.id;
                                })
                                .then((response) => {
                                    if (response != false) {
                                        userType
                                            .store(response)
                                            .then((response) => {
                                                //console.log("UserType:", response)
                                                return response.user_id;
                                            })
                                            .then((response) => {
                                                userProfile
                                                    .store(response)
                                                    .then((response) => {
                                                        //console.log("UserProfile:", response);
                                                        return response.user_id;
                                                    })
                                                    .then((response) => {
                                                        userCuestDireccion
                                                            .store(response)
                                                            .then(
                                                                (response) => {
                                                                    //console.log("UserCuestDireccion:", response)
                                                                    return response.user_id;
                                                                }
                                                            )
                                                            .then(
                                                                (response) => {
                                                                    userCuestUbicacion
                                                                        .store(
                                                                            response
                                                                        )
                                                                        .then(
                                                                            (
                                                                                response
                                                                            ) => {
                                                                                //console.log("UserCuestUbicacion:", response)
                                                                                return response.user_id;
                                                                            }
                                                                        );
                                                                    /* .then(response => {
                                                                            UserCuestPruebaCovid.store(response)
                                                                                .then(response => {
                                                                                    console.log("Resultado del Cuestionario:", response)
                                                                                })
                                                                        }) */
                                                                }
                                                            );
                                                    });
                                            });
                                    }
                                });
                        }
                        //}
                    }
                }
            }
        });
    }
    async create2(selector, user_id) {
        //CREATE PARA REGISTRO PACIENTE INTERNO
        let f = new Date();
        let fechaIngreso =
            f.getFullYear() +
            "-" +
            ("0" + (f.getMonth() + 1)).slice(-2) +
            "-" +
            ("0" + f.getDate()).slice(-2);

        $(selector).html(`
            <div class="container">
                <div class="row mt-3">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-primary">
                        <div class="h3">
                            Datos del paciente
                        </div>
                    </div>
                </div>

                <input id="cat_user_type_id" type="hidden">
                <div id="user_create" ></div>

                <div id="user_profile_create" ></div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-primary">
                        <div class="h3">
                            Dirección
                        </div>
                    </div>
                </div>
                <div id="user_cuest_direccion_create" ></div>

                <div id="user_cuest_pruebaCovid_create"></div>

                <div id="user_cuest_direccion_create"></div>

                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">

                        <table class="w-100">
                            <tr>
                                <td>
                                    <div  class="text-center" >
                                        <img onerror="this.src='/image/system/icono-paciente-blanco.svg'" id="imagen_perfil" style="width: 10%; height:10%" src="/image/system/patient.svg" class="imagen-perfil" alt="Medic default">
                                        <br/>
                                        <i id="ampliar" class="heartbeat cursor-pointer mt-1 fas fa-search-plus text-primary mr-1" style="font-size:1.3em;"></i>
                                        <i id="reducir" class="heartbeat cursor-pointer mt-1 fas fa-search-minus text-primary" style="font-size:1.3em;"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group text-center">
                                        <label class="label-text text-secondary" for="imagen">Foto <h6>solo archivos (.jpg o .png)</h6></label>
                                        <input type="file" accept="image/png, image/gif, image/jpeg" oninput="validarArchivoImagen(this.id)" class="form-control form-control-lg bg-gray-footer-parodi" name="imagen" id="imagen" aria-describedby="helpId" placeholder="">
                                        <small id="helpId1" class="form-text text-muted"></small>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label class="label-text text-secondary" for="nombre">Fecha de ingreso</label>
                            <input type="date" value="${fechaIngreso}" class="form-control form-control-lg bg-gray-footer-parodi" name="ingreso" id="ingreso" aria-describedby="helpId" placeholder="">
                            <small id="helpId1" class="form-text text-muted notification"></small>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-primary">
                        <div class="h3">
                            Traslado
                        </div>
                    </div>
                </div>
                <div id="user_cuest_ubicacion_create"></div>


                <div data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" class="row cursor-pointer mt-3">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-primary">
                        <div class="h3">
                            Datos del Familiar <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>

                <div class="collapse  mb-5" id="collapseExample">
                    <div id="user_cuest_familiar_create"></div>
                </div>



                <div class="row mt-5">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <button id="user_cuest_paciente_store" style="font-size: 1.5em;" class="btn btn-success btn-block">Registrar paciente</button>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <button onclick="history.back()" style="font-size: 1.5em;" class="btn btn-primary mt-1 btn-block">Cancelar</button>
                    </div>
                </div>

            </div>
        `);
        document.getElementById("cat_user_type_id").value = 1;
        fotoTemporal("imagen", ".imagen-perfil");

        $("#ampliar").on("click", function () {
            $("#imagen_perfil").animate({ width: "80%" }, 500);
        });

        $("#reducir").on("click", function () {
            $("#imagen_perfil").animate({ width: "10%" }, 500);
        });

        //VISTAS
        user.create2("#user_create");
        userProfile.create("#user_profile_create");
        userCuestDireccion.create("#user_cuest_direccion_create");
        userCuestUbicacion.create2("#user_cuest_ubicacion_create");
        userFamily.create("#user_cuest_familiar_create");
        telefonoConfig("#telefono_movil");
        $("html, body").animate({ scrollTop: 0 }, "slow");
        //ACCIONES
        $("#user_cuest_paciente_store").on("click", function () {
            if (user.validate2()) {
                if (userProfile.validate()) {
                    if (userCuestDireccion.validate()) {
                        if (userCuestUbicacion.validate2()) {
                            // let email = $("#email");
                            //let cedula = $("#cedula");

                            userCuestPaciente.guardarNuevoPaciente();
                        }
                    }
                }
            }
        });
    }
    async guardarNuevoPaciente() {
        let user_id = null;
        let cedula = null;
        let model;
        let cedulaExiste = await userProfile.validateCedula();
        //console.log("guardarNuevoPaciente->",cedulaExiste)
        if (cedulaExiste.exist) {
            user_id = cedulaExiste.user.profile.user_id;
            cedula = cedulaExiste.user.profile.cedula;
            //if(cedulaExiste.episodesOpen.length === undefined){
            //document.querySelector("#content_1").style.visibility = 'hidden'
            $("#content_1").slideDown();
            $("#loading").slideUp("slow");
            Swal.fire({
                title: "¡Paciente ya registrado!",
                html: `
                        La cédula <b>${cedula}</b> está asociada al paciente:
                        <table class="table table-bordered">
                            <tr>
                                <th>Nombres:</th>
                                <th>Apellidos:</th>
                                <th>Ubicación actual:</th>
                            </tr>
                            <tr>
                                <td>${cedulaExiste.user.profile.nombres}</td>
                                <td>${cedulaExiste.user.profile.apellidos}</td>
                                <td>${
                                    is_undefined(
                                        cedulaExiste.episodesOpen
                                            .ubicacion_description
                                    )
                                        ? ""
                                        : cedulaExiste.episodesOpen
                                              .ubicacion_description
                                }</td>
                            </tr>
                        </table>
                        <h4>Para ingresarlo, debe escribir la cédula nuevamente, y pulsar en el botón reingresar.</h4>
                    `,
                allowOutsideClick: false,
                icon: "error",
                showCancelButton: false,
                confirmButtonColor: "#3085d6",
                //cancelButtonColor: "#d33",
                confirmButtonText: "De acuerdo!",
                //cancelButtonText: "No!"
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = "/medico/create_paciente";
                    document.querySelector("#content_1").style.visibility =
                        "visible";
                    cedula.val("");
                    cedula.trigger("focus");
                }
            });

            return false;
            //}
        } else {
            model = await User.store();
            //console.log("model",model)
            if (model === "cedula_existe") {
                Swal.fire({
                    title: "¡Paciente ya registrado!",
                    html: `
                        La cédula <b>${cedula}</b> está asociada al paciente:
                        <table class="table table-bordered">
                            <tr>
                                <th>Nombres:</th>
                                <th>Apellidos:</th>
                                <th>Ubicación actual:</th>
                            </tr>
                            <tr>
                                <td>${cedulaExiste.user.profile.nombres}</td>
                                <td>${cedulaExiste.user.profile.apellidos}</td>
                                <td>${
                                    is_undefined(
                                        cedulaExiste.episodesOpen
                                            .ubicacion_description
                                    )
                                        ? ""
                                        : cedulaExiste.episodesOpen
                                              .ubicacion_description
                                }</td>
                            </tr>
                        </table>
                        <h4>Para ingresarlo, debe escribir la cédula nuevamente, y pulsar en el botón reingresar.</h4>
                    `,
                    allowOutsideClick: false,
                    icon: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    //cancelButtonColor: "#d33",
                    confirmButtonText: "De acuerdo!",
                    //cancelButtonText: "No!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = "/medico/create_paciente";
                        document.querySelector("#content_1").style.visibility =
                            "visible";
                        cedula.val("");
                        cedula.trigger("focus");
                    }
                });
                return false;
            }
            $("#content_1").slideUp();
            $("#loading").slideDown("slow");
            user_id = model.id;
            model = await userType.store(user_id);
            model = await userProfile.store(user_id);
            model = await userCuestDireccion.store(user_id);
            model = await userFamily.store(user_id);
            ingreso = "Ingreso";
            model = await userCuestUbicacion.store2(user_id);
            message = component.alertMessage("send_success");
            Toast.fire({
                icon: message["image"],
                title: message["title"],
                text: message["message"],
                didClose: () => {
                    setTimeout(() => {
                        if (
                            document.getElementById("cat_user_ubicacion_id")
                                .value == 388
                        ) {
                            window.location = "/telesalud/empresarial/index";
                        } else {
                            //window.location = "/medico";
                            console.log(
                                location.origin +
                                    localStorage.getItem("current_route")
                            );
                            window.location =
                                location.origin +
                                localStorage.getItem("current_route");
                        }
                        //console.log('%cUserCuestPaciente.js line:298 object', 'color: #007acc;', document.getElementById('cat_user_ubicacion_id').value);
                    }, 110);
                },
            });
        }
    }
    async create3(selector, user_id) {
        //DESPISTAJE COVID
        //CREATE PARA REGISTRO PACIENTE EXTERNO
        $(selector).html(`
            <div class="container">
                <div class="row mt-3">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-primary">
                        <div class="h3">
                            Datos del paciente
                        </div>
                    </div>
                </div>

                <div id="user_create" ></div>

                <div id="user_profile_create" ></div>
                <input style="display:none" type="file" class="form-control form-control-lg bg-gray-footer-parodi" name="imagen" id="imagen" aria-describedby="helpId" placeholder="">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-primary">
                        <div class="h3">
                            Dirección
                        </div>
                    </div>
                </div>
                <div id="user_cuest_direccion_create" ></div>

                <div id="user_cuest_pruebaCovid_create"></div>

                <div id="user_cuest_ubicacion_create"></div>

                <div class="row mb-3">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-1">
                        <button id="user_cuest_paciente_store" class="btn btn-success btn-lg btn-block">Registrar</button>
                    </div>
                </div>

            </div>
        `);
        //VISTAS
        user.create2("#user_create");
        userProfile.create("#user_profile_create");
        userCuestDireccion.create("#user_cuest_direccion_create");
        //UserCuestPruebaCovid.create("#user_cuest_pruebaCovid_create")
        //UserCuestPruebaCovid.resultadoCuestionarioCovid("#paso2_recomendacion")
        userCuestPaciente.bienvenidaPaciente2();
        telefonoConfig("#telefono_movil");
        //ACCIONES
        $("#user_cuest_paciente_store").on("click", async function () {
            if (user.validate2()) {
                if (userProfile.validate()) {
                    if (userCuestDireccion.validate()) {
                        let model = await User.store();

                        let user_id = model.id;

                        ingreso = "Ingreso";

                        model = await userType.store(user_id);

                        model = await userProfile.store(user_id);

                        model = await userCuestDireccion.store(user_id);

                        //model = await UserFamily.store(user_id);

                        model = await userCuestUbicacion.store2(user_id);

                        modalMensaje({
                            static: true,
                            title: `
                                    <i >Gracias por completar su registro.</i>

                                `,
                            content: `
                                    Esto nos permitirá brindarle el mejor servicio posible.

                                    <p>
                                        El equipo de salud del Centro Médico Docente La Trinidad le agradece que nos haya escogido como el aliado de su Salud !
                                    </p>
                                `,
                            action: `
                                    <button id="salir" onclick="window.location = 'https://www.cmdlt.edu.ve/';" data-dismiss="modal" type="button" class="btn btn-light btn-block btn-lg text-primary">Finalizar</button>
                            `,
                        });
                    }
                }
            }
        });
    }
    store(user_id) {
        // let message;
        let formdata = new FormData();
        let nacionalidad = $("#nacionalidad");
        let cedula = $("#cedula");
        let email = $("#email");
        User.store({
            email: emaio.val,
            cedula: nacionalidad.val() + "-" + cedula.val(),
        });

        /****** */
        let nombres = $("#nombres");
        let apellidos = $("#apellidos");
        let genero = $("#genero");
        let fnacimiento = $("#fnacimiento");
        let telefono_movil = $("#telefono_movil");
        let estado_id = $("#estado_id");
        let municipio_id = $("#municipio_id");
        let ciudad = $("#ciudad");
        let domicilio = $("#domicilio");
        let temp_actual = $("#temp_actual");
        let oxi_actual = $("#oxi_actual");
        let created_at = timestamps();
        let caso = $("#caso");

        formdata.append("nacionalidad", nacionalidad.val());
        formdata.append("cedula", cedula.val());
        formdata.append("email", email.val());

        formdata.append("created_at", created_at);
        formdata.append("_token", $("#_token").val());
        return post(
            location.origin + "/user_cuest_temperatura/store",
            formdata
        );
    }
    destroy(id) {
        let formdata = new FormData();
        formdata.append("id", id);
        formdata.append("_token", $("#_token").val());
        formdata.append("created_at", timestamps());
        return post(
            location.origin + "/user_cuest_temperatura/destroy",
            formdata
        );
    }
    eliminar(row_id, user_id) {
        var message = component.alertMessage("destroy_row_cuestion");
        var r = confirm(message["message"]);
        if (r == true) {
            userCuestPaciente.destroy(row_id).then((response) => {
                let temp = $("#value").val();
                if (response.length > 0) {
                    userCuestPaciente.columnaValor(`#col_6_${user_id}`, {
                        user_id: user_id,
                        valor: response[0].value,
                    });
                } else {
                    $("#modelId").modal("hide");
                    userCuestPaciente.columnaValor(`#col_6_${user_id}`, {
                        user_id: user_id,
                        valor: null,
                    });
                }
                userCuestPaciente.index(".modal-body", user_id);
            });
        }
    }
    colorTemp(temp) {
        //$(selector).removeClass(["text-secondary", "text-cyan", "text-success", "text-danger"])
        if (temp <= 30.4) {
            return "text-cyan";
        } else if (temp >= 30.5 && temp <= 37.5) {
            return "text-success";
        } else if (temp >= 37.6 && temp <= 37.9) {
            return "text-warning";
        } else if (temp >= 38) {
            return "text-danger";
        } else {
        }
    }
    columnaValor(selector, data) {
        $(selector).html(`
            <div onclick="UserCuestPaciente.index('.modal-body',${
                data.user_id
            })" class="text-center text-secondary font-weight-bold cursor-pointer">
                <div class="text-center text-gray w-100 title-columna">
                    TEMP
                </div>
                ${
                    data.valor == "" || data.valor == null
                        ? "<a class='btn btn-light btn-block' data-tippy-content='Pulse para añadir nuevo valor'>Añadir</a>"
                        : "<span class='" +
                          UserCuestPaciente.colorTemp(data.valor) +
                          "'>" +
                          data.valor +
                          "°C</span>"
                }
            </div>
        `);
    }
    help(selector, user_id) {
        $(selector).html(`
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1 class="text-primary">
                        Manual operativo de usuario
                    </h1>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <object id="pdfHolder" data="/help/temperatura.pdf" type="application/pdf" style="width:100%;height:500px;">
                        <a title="Pulse para descargar" href="/help/temperatura.pdf" download ><img src="/image/system/icono_archivo2.svg" ></a>
                    </object>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button id="regresar" class="font-weight-bold btn btn-primary mb-1 btn-block btn-lg">Regresar</button>
                </div>
            </div>

        `);
        $("#regresar").on("click", function () {
            userCuestPaciente.index(selector, user_id);
        });
    }
    async handle_peso(item) {
        let index = pacientes_datos.findIndex(
            (x) => x["user_id"] === item.user_id
        );
        let d = document;
        let App = d.querySelector("#app_peso_" + item.user_id);
        App.innerHTML = /*html*/ `
                <div class="d-flex flex-column">
                    <b class="text-primary" style="font-size:0.8rem">{{title}}</b>
                    <div class="input-group">
                        <input  v-model="value" @keyup.enter="store()" type="text" class="form-control" placeholder="Peso" aria-label="Peso" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button @click="store()" class="btn btn-outline-success" type="button" id="button-addon2">Guardar</button>
                        </div>
                    </div>

                </div>
            `;
        let app = new Vue({
            el: "#app_peso_" + item.user_id,
            data() {
                return {
                    index: null,
                    title: "Peso",
                    value: "",
                    item: [],
                };
            },
            methods: {
                have_item() {
                    let { peso } = this.item;
                    if (peso !== null) {
                        this.value = peso;
                    } else {
                        this.value = "";
                    }
                },
                async store() {
                    if (!is_empty(this.value)) {
                        let formdata = new FormData();
                        formdata.append("episodio_id", this.item.episodio_id);
                        formdata.append("value", this.value);
                        formdata.append("user_id_paciente", this.item.user_id);
                        formdata.append("sintoma_observacion", "");
                        formdata.append("created_at", timestamps());
                        formdata.append("_token", $("#_token").val());
                        let result = await post(
                            location.origin + "/user_peso/store2",
                            formdata
                        );
                        this.item.peso = this.value;
                        pacientes_datos[this.index] = this.item;
                        this.have_item();
                        Swal.fire(
                            `Peso agregado!`,
                            `El peso se registró correctamente.`,
                            "success"
                        );
                    }
                },
            },
            mounted() {
                this.item = item;
                this.index = index;
                this.have_item();
            },
        });
    }
    async handle_talla(item) {
        let index = pacientes_datos.findIndex(
            (x) => x["user_id"] === item.user_id
        );
        let d = document;
        let App = d.querySelector("#app_talla_" + item.user_id);
        App.innerHTML = /*html*/ `
                <div class="d-flex flex-column">
                    <b class="text-primary" style="font-size:0.8rem">{{title}}</b>
                    <div class="input-group">
                        <input  v-model="value" @keyup.enter="store()" type="text" class="form-control" placeholder="Talla" aria-label="Peso" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button @click="store()" class="btn btn-outline-success" type="button" id="button-addon2">Guardar</button>
                        </div>
                    </div>

                </div>
            `;
        let app = new Vue({
            el: "#app_talla_" + item.user_id,
            data() {
                return {
                    index: null,
                    title: "Talla",
                    value: "",
                    item: [],
                };
            },
            methods: {
                have_item() {
                    let { talla } = this.item;
                    if (talla !== null) {
                        this.value = talla;
                    } else {
                        this.value = "";
                    }
                },
                async store() {
                    if (!is_empty(this.value)) {
                        let formdata = new FormData();
                        formdata.append("episodio_id", this.item.episodio_id);
                        formdata.append("value", this.value);
                        formdata.append("user_id_paciente", this.item.user_id);
                        formdata.append("sintoma_observacion", "");
                        formdata.append("created_at", timestamps());
                        formdata.append("_token", $("#_token").val());
                        let result = await post(
                            location.origin + "/user_talla/store",
                            formdata
                        );
                        this.item.talla = this.value;
                        pacientes_datos[this.index] = this.item;
                        this.have_item();
                        Swal.fire(
                            `Talla agregada!`,
                            `La talla se registró correctamente.`,
                            "success"
                        );
                    }
                },
            },
            mounted() {
                this.item = item;
                this.index = index;
                this.have_item();
            },
        });
    }
    static async showImpDiagnostica(user_id) {
        let formdata = new FormData();
            formdata.append("_token", $("#_token").val())
            return post( location.origin+"/user_cuest_impresion_diagnostica/show/" + user_id, formdata)
    }
    async infoPaciente(selector, user_id) {
        let index = pacientes_datos.findIndex((x) => x.user_id == user_id);
        let model = pacientes_datos.filter((x) => x.user_id == user_id)[0];
        let imp_diagn = "";
        let f = null;
        let fecha = null;
        let contImpDiagn = 0;
        let resultImpDiag = await UserCuestPaciente.showImpDiagnostica(user_id)
            //console.log(resultImpDiag);
        if (resultImpDiag.length > 0) {
            resultImpDiag.forEach((row) => {

                    f = new Date(row.created_at);
                    fecha =
                        f.getDate() +
                        " " +
                        meses(f.getMonth()) +
                        ", " +
                        f.getFullYear();
                    imp_diagn += `
                        <li class="list-group-item p-1 bg-light text-gray">
                            <div class="d-flex flex-column justify-content-start">
                                ${row.value}
                            </div>
                            <div class="d-flex flex-colum justify-content-end">
                                <span class="badge badge-gray rounded-custom text-secondary">
                                <i class="far fa-clock"></i> ${row.medico}
                                <span class="text-primary">|</span> ${fechaCortaCustom1(row.created_at_default)} <span class="text-primary">|</span> ${row.hora}</span>
                            </div>

                        </li>
                    `;
                    contImpDiagn++;

            });
        }

        if (contImpDiagn === 0) {
            imp_diagn = /*html */ `
                <li class="list-group-item p-1 bg-light text-gray">
                <div class="text-center">Sin Probabilidad Diagnóstica</div>
                <a data-index="${index}" onclick=" localStorage.setItem('currentIndex',5)"  class='${
                is_null(model.episodio) ? "d-none" : ""
            } btn-cintillo-imp-diag btn btn-light btn-block'>Agregar</a>
                </li>
            `;
        }

        ingreso = "";
        if (model.hasOwnProperty("ingreso_episodio")) {
            f = new Date(model.ingreso_episodio);
            ingreso =
                f.getDate() +
                " " +
                meses(f.getMonth()) +
                ", " +
                f.getFullYear();
        }

        let fechaIngreso = "";
        fechaIngreso = fechaAMD2(model.ingreso_episodio);
        let cintilloVisibility = localStorage.getItem("cintilloVisibility");
        //console.log('cintilloVisibility',cintilloVisibility);
        document.getElementById("infoPaciente").innerHTML = /*html */ `
            <nav class="d-flex align-items-start">
                <button
                    class="ml-2 handleCintilloPacienteVisibility btn btn-default"
                    type="button"
                    data-toggle="collapse"
                    data-target="#collapseExample"
                    aria-expanded="${cintilloVisibility}"
                    aria-controls="collapseExample"
                >
                    <i  class="fas fa-ellipsis-v text-primary"></i>
                </button>
                <div id="collapseExample" class="${
                    cintilloVisibility === "true" ? "show" : "collapse"
                } flex-column overflow-auto shadow-sm container-fluid bg-light">
                    <div class="row flex-nowrap">
                        <div class="col-12 col-sm-6 col-md-3 col-lg-2 col-xl-3 px-1 d-flex flex-column">
                            <div class="flex-fill mb-1 p-1 card">
                                <div class="d-flex align-items-center">
                                    <img onerror="this.src='/image/system/icono-paciente-blanco.svg';" src="${
                                        model.imagen
                                    }" style="width:1.5cm;height:1.5cm" data-tippy-content="Imagen del paciente" class="tooltip-primary border border-primary rounded-circle m-1 d-block" alt="...">
                                    <div data-tippy-content="Nombre del paciente" class="tooltip-primary ml-1 text-primary flex-grow-1 h4 mb-0">
                                        ${
                                            model.paciente
                                        } <small class="text-light" style="font-size:0.7em;">#${
            model.user_id
        }</small >
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div data-tippy-content="Cédula del paciente" class="tooltip-primary flex-fill pl-1">
                                        <b class="text-primary" style="font-size:0.8rem">Cédula</b>
                                        <div class="text-secondary">${
                                            model.cedula
                                        }</div>
                                    </div>
                                    <div data-tippy-content="Edad" class="tooltip-primary flex-fill pl-1 border-left border-right">
                                        <b class="text-primary" style="font-size:0.8rem">Edad</b>
                                        <div class="text-secondary">${
                                            model.edad
                                        }</div>
                                    </div>
                                    <div data-tippy-content="Sexo" class="tooltip-primary flex-fill pl-1">
                                        <b class="text-primary" style="font-size:0.8rem">Sexo</b>
                                        <div class="text-secondary">${model.sexo.toUpperCase()}</div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">

                                    <div id="app_peso_${
                                        model.user_id
                                    }" class="flex-fill">

                                    </div>
                                    <div id="app_talla_${
                                        model.user_id
                                    }" class="flex-fill ml-1">

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-md-2 col-lg-2 col-xl-1 px-0 d-flex flex-column">
                            <div class="flex-fill mb-1 p-1 card ">
                                <b class="text-primary" style="font-size:0.8rem">Fecha Ingreso</b>
                                <div class="text-secondary ">
                                    <input
                                    class="cursor-pointer"
                                    onchange="UserCuestEpisodio.update3(this.id,${
                                        model.episodio
                                    },${user_id})"
                                    id="ingreso${model.user_id}"
                                    style="
                                        width: 100%;
                                        border: 1px solid var(--gray);
                                        background-color: transparent;
                                        color: var( --secondary);
                                        text-align: center;
                                        border-radius: 50px;
                                    "
                                    type="date"
                                    value="${fechaIngreso}">
                                </div>
                            </div>
                            <div onclick="userCuestUbicacion.historialUbiEpisodio('.modal-body',${
                                model.user_id
                            })" data-tippy-content="Ubicación Actual | Días desde el ingreso" class="tooltip-primary flex-fill mb-1 p-1 card ">
                                <b class="text-primary" style="font-size:0.8rem">Ubicación actual</b>
                                <div class="text-secondary">
                                ${
                                    model.ubicacion
                                } <span class="badge badge-secondary">${
            model.dias
        }</span>
                                </div>
                            </div>
                            <div class="flex-fill mb-1 p-1 card ">
                                <b class="text-primary" style="font-size:0.8rem">Teléfono contacto</b>
                                <div class="text-secondary">
                                    <a  target="_blank"
                                        href="https://api.whatsapp.com/send?phone=${
                                            !is_null(model.telefono_movil)
                                                ? model.telefono_movil.replace(
                                                      "+",
                                                      ""
                                                  )
                                                : ""
                                        }"
                                        style="padding: 0% 3% 3% 3%;border: 0;line-height: 1.4;"
                                        class="btn btn-default btn-block">
                                        <div class="text-gray text-nowrap overflow-hidden">
                                            <i class="fab fa-whatsapp text-success"></i> ${
                                                !is_null(model.telefono_movil)
                                                    ? model.telefono_movil.replace(
                                                          "+",
                                                          ""
                                                      )
                                                    : ""
                                            }
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-5 px-1 d-flex flex-column overflow-auto">
                            <div class="flex-fill d-flex flex-column overflow-auto mb-1 p-1 card">
                                <b class="text-primary" style="font-size:0.8rem">Probabilidad Diagnóstica <span class="badge badge-secondary">${contImpDiagn}</span></b>
                                <div class="flex-fill d-flex align-items-start justify-content-center overflow-auto" style="height:100px">
                                    <ul class="list-group w-100 list-group-flush ${
                                        location.pathname ==
                                        "/medico/create_paciente"
                                            ? "d-none"
                                            : ""
                                    }">
                                        ${imp_diagn}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-xl-2 col-xl-3 px-1 d-flex flex-column">
                            <div id="AppResumeHealthTeam" ></div>
                           
                        </div>
                    </div>
                </div>
            </nav>

        `;
        this.handle_peso(model);
        this.handle_talla(model);
        MedicosPaciente(model.episodio_id)                   
        // $("#fecha_ingreso").val(fechaIngreso);
        /* let doctoresPaciente = new MedicosPaciente({
            interconsultations:model.interconsultation_request,
            episode_id: model.episodio,
            attrSelectorId: `doctoresPaciente`,
            medic_teem_to_show: [1, 2, 3, 7, 9],
        });
        doctoresPaciente.deployMedicoPacienteList();

        let enfermerosPaciente = new MedicosPaciente({
            interconsultations:model.interconsultation_request,
            episode_id: model.episodio,
            attrSelectorId: `enfermerosPaciente`,
            medic_teem_to_show: [10],
        });
        enfermerosPaciente.deployMedicoPacienteList(); */

        activarTooltip();
    }
    async infoPacienteRESPALDO28022025(selector, user_id) {
        let index = pacientes_datos.findIndex((x) => x.user_id == user_id);
        let model = pacientes_datos.filter((x) => x.user_id == user_id)[0];
        let imp_diagn = "";
        let f = null;
        let fecha = null;
        let contImpDiagn = 0;
        let resultImpDiag = await UserCuestPaciente.showImpDiagnostica(user_id)
            //console.log(resultImpDiag);
        if (resultImpDiag.length > 0) {
            resultImpDiag.forEach((row) => {

                    f = new Date(row.created_at);
                    fecha =
                        f.getDate() +
                        " " +
                        meses(f.getMonth()) +
                        ", " +
                        f.getFullYear();
                    imp_diagn += `
                        <li class="list-group-item p-1 bg-light text-gray">
                            <div class="d-flex flex-column justify-content-start">
                                ${row.value}
                            </div>
                            <div class="d-flex flex-colum justify-content-end">
                                <span class="badge badge-gray rounded-custom text-secondary">
                                <i class="far fa-clock"></i> ${row.medico}
                                <span class="text-primary">|</span> ${fechaCortaCustom1(row.created_at_default)} <span class="text-primary">|</span> ${row.hora}</span>
                            </div>

                        </li>
                    `;
                    contImpDiagn++;

            });
        }

        if (contImpDiagn === 0) {
            imp_diagn = /*html */ `
                <li class="list-group-item p-1 bg-light text-gray">
                <div class="text-center">Sin Probabilidad Diagnóstica</div>
                <a data-index="${index}" onclick=" localStorage.setItem('currentIndex',5)"  class='${
                is_null(model.episodio) ? "d-none" : ""
            } btn-cintillo-imp-diag btn btn-light btn-block'>Agregar</a>
                </li>
            `;
        }

        ingreso = "";
        if (model.hasOwnProperty("ingreso_episodio")) {
            f = new Date(model.ingreso_episodio);
            ingreso =
                f.getDate() +
                " " +
                meses(f.getMonth()) +
                ", " +
                f.getFullYear();
        }

        let fechaIngreso = "";
        fechaIngreso = fechaAMD2(model.ingreso_episodio);
        let cintilloVisibility = localStorage.getItem("cintilloVisibility");
        //console.log('cintilloVisibility',cintilloVisibility);
        document.getElementById("infoPaciente").innerHTML = /*html */ `
            <nav class="d-flex align-items-start">
                <button
                    class="ml-2 handleCintilloPacienteVisibility btn btn-default"
                    type="button"
                    data-toggle="collapse"
                    data-target="#collapseExample"
                    aria-expanded="${cintilloVisibility}"
                    aria-controls="collapseExample"
                >
                    <i  class="fas fa-ellipsis-v text-primary"></i>
                </button>
                <div id="collapseExample" class="${
                    cintilloVisibility === "true" ? "show" : "collapse"
                } flex-column overflow-auto shadow-sm container-fluid bg-light">
                    <div class="row flex-nowrap">
                        <div class="col-12 col-sm-6 col-md-3 col-lg-2 col-xl-3 px-1 d-flex flex-column">
                            <div class="flex-fill mb-1 p-1 card">
                                <div class="d-flex align-items-center">
                                    <img onerror="this.src='/image/system/icono-paciente-blanco.svg';" src="${
                                        model.imagen
                                    }" style="width:1.5cm;height:1.5cm" data-tippy-content="Imagen del paciente" class="tooltip-primary border border-primary rounded-circle m-1 d-block" alt="...">
                                    <div data-tippy-content="Nombre del paciente" class="tooltip-primary ml-1 text-primary flex-grow-1 h4 mb-0">
                                        ${
                                            model.paciente
                                        } <small class="text-light" style="font-size:0.7em;">#${
            model.user_id
        }</small >
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div data-tippy-content="Cédula del paciente" class="tooltip-primary flex-fill pl-1">
                                        <b class="text-primary" style="font-size:0.8rem">Cédula</b>
                                        <div class="text-secondary">${
                                            model.cedula
                                        }</div>
                                    </div>
                                    <div data-tippy-content="Edad" class="tooltip-primary flex-fill pl-1 border-left border-right">
                                        <b class="text-primary" style="font-size:0.8rem">Edad</b>
                                        <div class="text-secondary">${
                                            model.edad
                                        }</div>
                                    </div>
                                    <div data-tippy-content="Sexo" class="tooltip-primary flex-fill pl-1">
                                        <b class="text-primary" style="font-size:0.8rem">Sexo</b>
                                        <div class="text-secondary">${model.sexo.toUpperCase()}</div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">

                                    <div id="app_peso_${
                                        model.user_id
                                    }" class="flex-fill">

                                    </div>
                                    <div id="app_talla_${
                                        model.user_id
                                    }" class="flex-fill ml-1">

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-md-2 col-lg-2 col-xl-1 px-0 d-flex flex-column">
                            <div class="flex-fill mb-1 p-1 card ">
                                <b class="text-primary" style="font-size:0.8rem">Fecha Ingreso</b>
                                <div class="text-secondary ">
                                    <input
                                    class="cursor-pointer"
                                    onchange="UserCuestEpisodio.update3(this.id,${
                                        model.episodio
                                    },${user_id})"
                                    id="ingreso${model.user_id}"
                                    style="
                                        width: 100%;
                                        border: 1px solid var(--gray);
                                        background-color: transparent;
                                        color: var( --secondary);
                                        text-align: center;
                                        border-radius: 50px;
                                    "
                                    type="date"
                                    value="${fechaIngreso}">
                                </div>
                            </div>
                            <div onclick="userCuestUbicacion.historialUbiEpisodio('.modal-body',${
                                model.user_id
                            })" data-tippy-content="Ubicación Actual | Días desde el ingreso" class="tooltip-primary flex-fill mb-1 p-1 card ">
                                <b class="text-primary" style="font-size:0.8rem">Ubicación actual</b>
                                <div class="text-secondary">
                                ${
                                    model.ubicacion
                                } <span class="badge badge-secondary">${
            model.dias
        }</span>
                                </div>
                            </div>
                            <div class="flex-fill mb-1 p-1 card ">
                                <b class="text-primary" style="font-size:0.8rem">Teléfono contacto</b>
                                <div class="text-secondary">
                                    <a  target="_blank"
                                        href="https://api.whatsapp.com/send?phone=${
                                            !is_null(model.telefono_movil)
                                                ? model.telefono_movil.replace(
                                                      "+",
                                                      ""
                                                  )
                                                : ""
                                        }"
                                        style="padding: 0% 3% 3% 3%;border: 0;line-height: 1.4;"
                                        class="btn btn-default btn-block">
                                        <div class="text-gray text-nowrap overflow-hidden">
                                            <i class="fab fa-whatsapp text-success"></i> ${
                                                !is_null(model.telefono_movil)
                                                    ? model.telefono_movil.replace(
                                                          "+",
                                                          ""
                                                      )
                                                    : ""
                                            }
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-5 px-1 d-flex flex-column overflow-auto">
                            <div class="flex-fill d-flex flex-column overflow-auto mb-1 p-1 card">
                                <b class="text-primary" style="font-size:0.8rem">Probabilidad Diagnóstica <span class="badge badge-secondary">${contImpDiagn}</span></b>
                                <div class="flex-fill d-flex align-items-start justify-content-center overflow-auto" style="height:100px">
                                    <ul class="list-group w-100 list-group-flush ${
                                        location.pathname ==
                                        "/medico/create_paciente"
                                            ? "d-none"
                                            : ""
                                    }">
                                        ${imp_diagn}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-xl-2 col-xl-3 px-1 d-flex flex-column">
                            <div class="flex-fill mb-1 p-1 card">
                                <ul class="nav nav-tabs p-0 m-0 flex-nowrap" id="myTab" role="tablist">
                                    <li class="nav-item p-0 m-0" role="presentation">
                                        <a class="nav-link p-0 m-0 px-2 active" id="equipoEspecialistas-tab" data-toggle="tab" href="#equipoEspecialistas" role="tab" aria-controls="equipoEspecialistas" aria-selected="true">
                                            <b class="text-center text-primary" style="font-size:0.8em;">Médicos</b>
                                        </a>
                                    </li>
                                    <li class="nav-item p-0 m-0" role="presentation">
                                        <a class="nav-link p-0 px-2 m-0" id="equipoEnfermeria-tab" data-toggle="tab" href="#equipoEnfermeria" role="tab" aria-controls="equipoEnfermeria" aria-selected="false">
                                            <b class="text-center text-warning" style="font-size:0.8em;">Enfermería</b>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content ${
                                    location.pathname ==
                                    "/medico/create_paciente"
                                        ? "d-none"
                                        : ""
                                }" id="myTabContent">
                                    <div class="tab-pane fade show active" id="equipoEspecialistas" role="tabpanel" aria-labelledby="equipoEspecialistas-tab">
                                        <div id="doctoresPaciente" class="p-0 pb-1" scope="row">

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="equipoEnfermeria" role="tabpanel" aria-labelledby="equipoEnfermeria-tab">
                                        <div id="enfermerosPaciente" class="p-0 pb-1" scope="row">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

        `;
        this.handle_peso(model);
        this.handle_talla(model);

        // $("#fecha_ingreso").val(fechaIngreso);
        let doctoresPaciente = new MedicosPaciente({
            interconsultations:model.interconsultation_request,
            episode_id: model.episodio,
            attrSelectorId: `doctoresPaciente`,
            medic_teem_to_show: [1, 2, 3, 7, 9],
        });
        doctoresPaciente.deployMedicoPacienteList();

        let enfermerosPaciente = new MedicosPaciente({
            interconsultations:model.interconsultation_request,
            episode_id: model.episodio,
            attrSelectorId: `enfermerosPaciente`,
            medic_teem_to_show: [10],
        });
        enfermerosPaciente.deployMedicoPacienteList();

        activarTooltip();
    }
    async infoPacienteHistorial(user_id) {
        let $header = $modal.querySelector("#modal-header-info-user");
        let imp_diagn = "";
        let f = null;
        let fecha = null;
        let contImpDiagn = 0;
        let $navInfoPaciente = byId(`nav_info_paciente`).content;
        let paciente = first(
            pacientes_datos.filter((x) => x.user_id == user_id)
        );
        let ingreso_episodio = "";
        if (paciente.hasOwnProperty("ingreso_episodio")) {
            f = new Date(paciente.ingreso_episodio);
            ingreso_episodio =
                f.getFullYear() +
                "-" +
                ("0" + (f.getMonth() + 1)).slice(-2) +
                "-" +
                ("0" + f.getDate()).slice(-2);
        }
        let $info = $navInfoPaciente.querySelectorAll("div");
        //console.log($info)
        $info[4].querySelector("img").setAttribute("src", paciente.imagen);
        $info[7].querySelector("h4").textContent = paciente.paciente;
        $info[11].textContent = paciente.cedula;
        $info[14].textContent = paciente.edad;
        $info[17].textContent = paciente.sexo;
        $info[18].querySelector("input").value = ingreso_episodio;
        $info[19].querySelector("span").textContent = paciente.dias;
        $info[21].textContent = paciente.ubicacion;
        $info[22]
            .querySelector("a")
            .setAttribute(
                "href",
                `https://api.whatsapp.com/send?phone=${paciente.telefono_movil.replace(
                    "+",
                    ""
                )}`
            );
        $info[22].querySelector(
            "a"
        ).innerHTML = `<i class="fab fa-whatsapp text-success"></i> ${paciente.telefono_movil.replace(
            "+",
            ""
        )}`;

        if (paciente.hasOwnProperty("resultados")) {
            paciente.resultados.forEach((row) => {
                if (row.description === "Probabilidad diagnóstica") {
                    f = new Date(row.created_at);
                    fecha =
                        f.getDate() +
                        " " +
                        meses(parseInt(f.getMonth())) +
                        ", " +
                        f.getFullYear();
                    imp_diagn += `
                            <li class="list-group-item p-1 bg-light text-gray">
                                <div class="d-flex flex-column justify-content-start">
                                    ${row.value}
                                </div>
                                <div class="d-flex flex-colum justify-content-end">
                                    <span class="badge badge-gray rounded-custom text-secondary"><i class="far fa-clock"></i> ${row.medico} <span class="text-primary">|</span> ${fecha} <span class="text-primary">|</span> ${row.hora}</span>
                                </div>

                            </li>
                        `;
                    contImpDiagn++;
                }
            });
        }
        if (contImpDiagn === 0) {
            imp_diagn = `
                    <li class="list-group-item p-1 bg-light text-gray">
                    <div class="text-center">Sin Probabilidad Diagnóstica</div>
                    <a data-user_id_paciente="${user_id}"  class='${
                is_null(model.episodio) ? "d-none" : ""
            } btn btn-light btn-block'>Agregar</a>
                    </li>
                `;
        }
        $info[23].querySelector("#impresion_diagnostica ul").innerHTML =
            imp_diagn;
        $header.innerHTML = "";
        $header.append($navInfoPaciente);

        if (!paciente.hasOwnProperty("medico_paciente")) {
            paciente.medico_paciente = [];
        }

        const configMedicos = [
            {
                selector: "#lista_tratante",
                grupo_medico_id: 1,
                color: "success",
                name: "Tratante",
                medicosByPaciente: filtroMedico(paciente.medico_paciente, 1),
                user_id,
            },
            {
                selector: "#lista_interconsultante",
                grupo_medico_id: 2,
                color: "info",
                name: "Interconsultante",
                medicosByPaciente: filtroMedico(paciente.medico_paciente, 2),
                user_id,
            },
            {
                selector: "#lista_felow",
                grupo_medico_id: 3,
                color: "orange",
                name: "Fellow",
                medicosByPaciente: filtroMedico(paciente.medico_paciente, 3),
                user_id,
            },
            {
                selector: "#lista_residente",
                grupo_medico_id: 4,
                color: "secondary",
                name: "Residente",
                medicosByPaciente: filtroMedico(paciente.medico_paciente, 4),
                user_id,
            },
            {
                selector: "#lista_ramh",
                grupo_medico_id: 5,
                color: "purple",
                name: "RAMH",
                medicosByPaciente: filtroMedico(paciente.medico_paciente, 5),
                user_id,
            },
        ];
        configMedicos.forEach((x) => {
            UserCuestMedicoPaciente.listadoMedicoPaciente(x);
        });

        activarTooltip();
    }
    bienvenidaPaciente() {
        $("#messageModal").modal("show");
        $(".modal-body").html(`
            <div class="bg-primary p-3">
                <h3 class="display-4" style="font-size: 2.5em;">
                    <i style="font-size: 0.8em;">Bienvenido al</i><br>
                    Programa de Atención Domiciliaria<br>
                    <span style="overflow-wrap: normal;font-weight:400">COVID-19</span>
                </h3>
                <p class="lead" style="font-size: 1.4em;font-style: italic;">
                    Monitoreo a distancia para apoyarte en tu recuperación
                    de síntomas relacionados al <br>COVID-19.<br>
                    <br>
                    Por favor, completa la información, del siguiente cuestionario.<br><br>
                    Te daremos las recomendaciones de qué hacer al momento de completar la información solicitada.<br>
                    <br>
                </p>
                <small class="lead text-justify" style="font-size: 1em;">
                    Este cuestionario no sustituye el examen médico;
                    sin embargo, permite evaluar tu riesgo y ofrecerte las recomendaciones
                    acorde a tus respuestas.
                    <br><br>
                </small>



                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-2">
                        <button id="empezarcuestionario" data-dismiss="modal" type="button" class="btn btn-light btn-block btn-lg text-primary">De acuerdo, comenzar</button>
                    </div>
                    <!--
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-2">
                        <button id="yacontestada" type="button" class="btn btn-danger btn-block btn-lg">No, requiero atención de emergencia</button>
                    </div>
                    -->
                </div>

            </div>
        `);
    }
    bienvenidaPaciente2() {
        $("#messageModal").modal("show");
        $(".modal-body").html(`
            <div class="bg-primary p-3">
                <h3 class="display-4" style="font-size: 2.5em;">
                    <i style="font-size: 0.8em;">
                        Bienvenido al<br>
                        <span style="font-size: 0.8em;">Programa de Atención Domiciliaria:</span>
                    </i>

                    <br>
                    <span style="overflow-wrap: normal;font-weight:400">Despistaje + Seguimiento COVID</span>
                </h3>
                <p class="lead" style="font-size: 1.4em;font-style: italic;">
                    Monitoreo a distancia para apoyarte en tu recuperación
                    de síntomas relacionados al <br>COVID-19.
                    <br>
                    Por favor, completa la información, del siguiente cuestionario.<br>
                </p>




                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                        <button id="empezarcuestionario" data-dismiss="modal" type="button" class="btn btn-light btn-block btn-lg text-primary">De acuerdo, comenzar</button>
                    </div>
                    <!--
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-2">
                        <button id="yacontestada" type="button" class="btn btn-danger btn-block btn-lg">No, requiero atención de emergencia</button>
                    </div>
                    -->
                </div>

            </div>
        `);
    }

    /* formPaciente() {

    } */
    edit(selector, user_id) {
        let index_episodio = pacientes_datos.findIndex(
            (paciente) => paciente.user_id === user_id
        );
        let episodio = pacientes_datos[index_episodio];
        $("#modal-patient-item").modal("show");
        document.querySelector(
            "#modal-patient-item .modal-body-2"
        ).innerHTML = /*html */ `

            <div id='AppEditPacient' class="fade-in flex-fill d-flex flex-column  overflow-auto">
                <div class="container p-0">
                    <h3 class="text-primary">
                        Datos del Paciente
                    </h3>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label class="label-text text-secondary" for="cedula">Documento de identidad</label>
                                <table class="w-100">
                                    <tbody>
                                        <tr>
                                            <td style="width: 30%">
                                                <select v-model="form.nacionalidad"
                                                    class="form-control bg-gray-footer-parodi" name="nacionalidad"
                                                    id="nacionalidad">
                                                    <option value="V">V</option>
                                                    <option value="E">E</option>
                                                    <option value="P">P</option>
                                                    <option value="J">J</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input @change="updateField('cedula')" v-model="form.cedula" type="text"
                                                    max="9" class="form-control bg-gray-footer-parodi" name="cedula"
                                                    id="cedula" ref="cedula" required aria-describedby="helpId">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <small v-if="isValidateCedula" :class="['form-text notification',( cedulaExiste ? 'text-danger': 'text-success')]">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Cédula {{cedulaExiste ? ' no disponible para registrar': 'no registrada'}}</span>
                                </small>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">

                            <div id="emailAlternativo" class="form-group">
                                <label class="label-text text-secondary" for="email_alternativo">Correo electrónico
                                    <span v-if="is_child" class="font-weight-bold">(del representante)</span></label>
                                <input @change="updateField('email')" v-model="form.email" type="email"
                                    class="form-control bg-gray-footer-parodi" name="email" id="email" ref="email"
                                    required>
                                <small id="sms_email_alternativo" class="form-text text-danger notification"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label class="label-text text-secondary" for="nombre">Nombres</label>
                                <input v-model="form.nombres" type="text" class="form-control bg-gray-footer-parodi"
                                    name="nombres" id="nombres" aria-describedby="helpId" ref="nombres" required>
                                <small id="helpId1" class="form-text text-muted notification"></small>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label class="label-text text-secondary" for="apellido">Apellidos</label>
                                <input v-model="form.apellidos" type="text" class="form-control bg-gray-footer-parodi"
                                    name="apellidos" id="apellidos" aria-describedby="helpId" ref="apellidos" required>
                                <small id="helpId1" class="form-text text-muted notification"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label class="label-text text-secondary" for="genero">Género</label>
                                <select v-model="form.genero" class="form-control bg-gray-footer-parodi" name="genero"
                                    id="genero" aria-describedby="helpId" ref="genero" required>
                                    <option value="m">Masculino</option>
                                    <option value="f">Femenino</option>
                                </select>
                                <small id="helpId1" class="form-text text-muted notification"></small>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label class="label-text text-secondary" for="fnacimiento">Fecha de
                                    nacimiento</label>
                                <input v-model="form.fnacimiento" type="date" class="form-control bg-gray-footer-parodi"
                                    name="fnacimiento" id="fnacimiento" aria-describedby="helpId" ref="fnacimiento"
                                    required>
                                <small id="helpId1" class="form-text text-muted notification"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label class="label-text text-secondary" for="telefono_movil">Teléfono
                                    Contacto</label>
                                <input v-model="form.telefono_movil" id="telefono_movil"
                                    @change="updateField('telefono_movil')" ref="telefono_movil" required type="text"
                                    class="form-control bg-gray-footer-parodi" @keyup="vPrimerDigito('telefono_movil')">
                                <small id="help_telefono_movil" class="form-text text-muted notification"></small>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label class="label-text text-secondary" for="telefono_hogar">Teléfono
                                    Secundario</label>
                                <input v-model="form.telefono_hogar" id="telefono_hogar"
                                    @change="updateField('telefono_hogar')" ref="telefono_hogar" type="text"
                                    class="form-control bg-gray-footer-parodi" @keyup="vPrimerDigito('telefono_hogar')">
                                <small id="help_telefono_hogar" class="form-text text-muted notification"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-primary">
                            <div class="h3">
                                Dirección
                            </div>
                        </div>
                    </div>
                    <div id="user_cuest_direccion_create">

                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="cat_estado_id">Estado</label>
                                    <select v-model="form.cat_estado_id" class="form-control bg-gray-footer-parodi"
                                        name="cat_estado_id" id="cat_estado_id" aria-describedby="helpId"
                                        ref="cat_estado_id" required>
                                        <option value="null">Seleccione</option>
                                        <option v-for="(item, index) in cat_estados" :key="index" :value="item.id">
                                            {{ item.description }}</option>
                                    </select>
                                    <small id="helpId1" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="cat_municipio_id">Municipio</label>
                                    <select v-model="form.cat_municipio_id" class="form-control bg-gray-footer-parodi"
                                        name="cat_municipio_id" id="cat_municipio_id" aria-describedby="helpId"
                                        ref="cat_municipio_id" required>
                                        <option value="">Seleccione</option>
                                        <option v-for="(item, index) in getCatMunicipio" :key="index" :value="item.id">
                                            {{ item.description }}</option>
                                    </select>
                                    <small id="helpId1" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="description">Ciudad</label>
                                    <input v-model="form.description" type="text"
                                        class="form-control bg-gray-footer-parodi" name="description" id="description"
                                        aria-describedby="helpId" ref="description" required>
                                    <small id="helpId1" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label class="label-text text-secondary" for="domicilio">Domicilio</label>
                                    <textarea v-model="form.domicilio" class="form-control bg-gray-footer-parodi"
                                        name="domicilio" id="domicilio" rows="2" ref="domicilio" required></textarea>
                                    <small id="helpId1" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="text-center">

                                <img
                                    onerror="this.src='/image/system/icono-paciente-blanco.svg'"
                                    id="imagen_perfil"
                                    style="width: 10%; height:10%"
                                    :src="form.imagen"
                                    class="imagen-perfil"
                                    alt="Medic default"
                                >

                                <br>
                                <i id="ampliar"
                                    class="heartbeat cursor-pointer mt-1 fas fa-search-plus text-primary mr-1"
                                    style="font-size:1.3em;"></i>
                                <i id="reducir" class="heartbeat cursor-pointer mt-1 fas fa-search-minus text-primary"
                                    style="font-size:1.3em;"></i>
                            </div>
                            <div class="form-group text-center">
                                <label class="label-text text-secondary" for="imagen">Subir Documento de idendidad del
                                    Paciente</label>
                                <input
                                    @change="validarArchivoImagen('imagen')"
                                    type="file"
                                    class="form-control bg-gray-footer-parodi"
                                    name="imagen"
                                    id="imagen"
                                    aria-describedby="helpId"
                                >
                                <small id="helpId1" class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <button @click="handle_store()" id="user_cuest_model_update"
                                class="font-weight-bold btn btn-success w-100">Guardar</button>
                        </div>
                        <div class="col-6">
                            <button id="regresar" @click="closeModal()" aria-label="Close"
                                class="font-weight-bold btn btn-primary w-100">Regresar</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        let app = new Vue({
            el: "#AppEditPacient",
            data() {
                return {
                    items: pacientes_datos,
                    is_child: false,
                    cat_estados: Array.from(catUserEstado.getAll()),
                    telefonoConfig1: null,
                    telefonoConfig2: null,
                    dataPaciente: null,
                    isValidateCedula: false,
                    cedulaExiste: true,
                    form: {
                        id: null,
                        email: null,
                        email_alternativo: null,
                        nacionalidad: null,
                        cedula: null,
                        telefono_movil: null,
                        new_imagen: null,
                        imagen: null,
                        nombres: null,
                        apellidos: null,
                        genero: null,
                        fnacimiento: null,
                        telefono_hogar: null,
                        cat_user_type_id: null,
                        cat_estado_id: null,
                        cat_municipio_id: null,
                        description: null,
                        domicilio: null,
                    },
                };
            },
            props: {
                //patient_data: Object,
                //index: Number,
            },
            computed: {
                getCatMunicipio() {
                    return Array.from(catUserMunicipio.getAll()).filter(
                        (item) =>
                            item["cat_estado_id"] === this.form.cat_estado_id
                    );
                },
            },
            methods: {
                validateForm() {
                    let formNotValidate = true;

                    let inputName = "cedula";
                    let input = this.$refs[inputName];
                    if ([null,""].includes(this.form[inputName]) && formNotValidate) {
                        alert("El campo cédula no puede estar vacio.");
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "email";
                    input = this.$refs[inputName];
                    if ([null,""].includes(this.form[inputName]) && formNotValidate) {
                        alert(
                            "El campo Correo electrónico no puede estar vacio."
                        );
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "nombres";
                    input = this.$refs[inputName];
                    if (is_empty(this.form[inputName]) && formNotValidate) {
                        alert("El campo Nombres no puede estar vacio.");
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "apellidos";
                    input = this.$refs[inputName];
                    if (is_empty(this.form[inputName]) && formNotValidate) {
                        alert("El campo Apellidos no puede estar vacio.");
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "genero";
                    input = this.$refs[inputName];
                    if (is_empty(this.form[inputName]) && formNotValidate) {
                        alert("El campo Género no puede estar vacio.");
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "fnacimiento";
                    input = this.$refs[inputName];
                    if (is_empty(this.form[inputName]) && formNotValidate) {
                        alert(
                            "El campo Fecha de Nacimiento no puede estar vacio."
                        );
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "telefono_movil";
                    input = this.$refs[inputName];
                    if (is_empty(this.form[inputName]) && formNotValidate) {
                        alert(
                            "El campo Teléfono Contacto no puede estar vacio."
                        );
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "cat_estado_id";
                    input = this.$refs[inputName];
                    console.log(this.form[inputName]);
                    if (is_null(this.form[inputName]) && formNotValidate) {
                        alert("El campo Estado no puede estar vacio.");
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "cat_municipio_id";
                    input = this.$refs[inputName];
                    if (is_null(this.form[inputName]) && formNotValidate) {
                        alert("El campo Municipio no puede estar vacio.");
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "description";
                    input = this.$refs[inputName];
                    if (is_null(this.form[inputName]) && formNotValidate) {
                        alert("El campo Ciudad no puede estar vacio.");
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }
                    inputName = "domicilio";
                    input = this.$refs[inputName];
                    if (is_null(this.form[inputName]) && formNotValidate) {
                        alert("El campo Domicilio no puede estar vacio.");
                        input.focus();
                        formNotValidate = false;
                        return false;
                    }

                    if (formNotValidate) {
                        return true;
                    } else {
                        return false;
                    }
                },
                async store() {
                    this.form.new_imagen =
                        document.getElementById(`imagen`).files[0];
                    let formdata = new FormData();
                    for (const key in this.form) {
                        if (Object.hasOwnProperty.call(this.form, key)) {
                            let element = this.form[key];
                            formdata.append(key, element);
                        }
                    }

                    formdata.append(
                        "user_cuest_episodio_id",
                        episodio.episodio_id
                    );
                    formdata.append("user_id_paciente", episodio.user_id);
                    formdata.append("created_at", timestamps());
                    formdata.append("_token", $("#_token").val());
                    return await post(
                        location.origin + "/user_paciente/update",
                        formdata
                    );
                },
                imagePreview(archivo, selector, showImageName = false) {
                    // We create the object of the FileReader class
                    let reader = new FileReader();
                    // We read the uploaded file and pass it to our fileReader.
                    reader.readAsDataURL(archivo);

                    let file = archivo;
                    //We look for the following element where we will show the name of the uploaded file.

                    let { name, size, type } = file;
                    if (showImageName) {
                        //e.target.nextElementSibling.textContent= name
                    }

                    // We tell it that when it is ready, run the internal code.
                    reader.onload = function (load) {
                        document
                            .getElementById(selector)
                            .setAttribute("src", reader.result);
                    };
                },
                validarArchivoImagen(id) {
                    const archivoInput = document.getElementById(id);
                    const archivo = archivoInput.files[0];
                    console.log(archivo.name);
                    if (archivo) {
                        const extension = archivo.name
                            .split(".")
                            .pop()
                            .toLowerCase();
                        if (
                            !(
                                extension === "jpg" ||
                                extension === "jpeg" ||
                                extension === "png"
                            )
                        ) {
                            Swal.fire({
                                icon: "error",
                                title: "Hubo un error...",
                                text: "Solo se permiten archivos .jpg o .png.",
                            });
                            archivoInput.value = ""; // Limpiar el campo de entrada
                        }
                        this.imagePreview(archivo, "imagen_perfil");
                    }
                },
                async updateField(fieldName) {
                    if (fieldName === "cedula") {
                        let result = await this.validateCedula();
                        if (!result.exist) {
                            this.is_a_child();
                        }
                    }
                    if (fieldName === "email") {
                        let result = await this.validateEmail();
                        if (!result.exist) {
                            let inputName = "email";
                            let input = this.$refs[inputName];

                            alert(
                                this.form.email +
                                    " ya se encuentra asociado a otro paciente."
                            );
                            this.form.email = this.originalEmail;
                            input.focus();
                        }
                        return false;
                    }
                    if (fieldName === "telefono_movil") {
                        this.form.telefono_movil =
                            this.telefonoConfig1.getNumber();
                        return false;
                    }
                    if (fieldName === "telefono_hogar") {
                        this.form.telefono_hogar =
                            this.telefonoConfig2.getNumber();
                        return false;
                    }
                    /* if (imagen === "imagen") {
                        this.form.imagen = document
                        return false
                    } */
                },
                is_a_child() {
                    if (this.form.cedula !== null) {
                        let numeroValido = validarNumeroConDosDecimales(
                            this.form.cedula
                        );
                        if (numeroValido) {
                            this.is_child = true;
                        } else {
                            this.is_child = false;
                        }
                    }
                },
                async validateEmail() {
                    if (this.form.cedula !== "") {
                        let formdata = new FormData();
                        formdata.append("nacionalidad", this.form.nacionalidad);
                        formdata.append("cedula", this.originalCedula);
                        formdata.append("email", this.form.email);
                        formdata.append("_token", $("#_token").val());
                        let result = await post(
                            location.origin + "/user/emailExist",
                            formdata
                        );
                        return result;
                    } else {
                        return {
                            exist: false,
                        };
                    }
                },
                async getDataPaciente() {
                    this.dataPaciente = await get(
                        `user_paciente/getdatapaciente/${user_id}`
                    );
                },
                async validateCedula() {
                    let that = this;
                    if (this.form.cedula !== "") {
                        let formdata = new FormData();
                        formdata.append("nacionalidad", this.form.nacionalidad);
                        formdata.append("cedula", this.form.cedula);
                        formdata.append("_token", $("#_token").val());
                        let result = await get(
                            location.origin + "/getPatient/" + this.form.cedula
                        );
                        this.isValidateCedula = true;
                        if (result.exist) {
                            this.cedulaExiste = true;
                            alert(
                                "La cédula " +
                                    this.form.cedula +
                                    " ya se encuentra asociada a un paciente."
                            );
                            this.form["cedula"] = this.originalCedula;
                        } else {
                            this.cedulaExiste = false;
                        }
                        console.log("cedula_encontrada->", result);

                        return result;
                    } else {
                        return {
                            exist: false,
                        };
                    }
                },
                vPrimerDigito(param) {
                    validarPrimerDigito(param);
                },
                async handle_store() {
                    let that = this;
                    if (that.validateForm()) {
                        let response = await that.store();
                        if (response.success) {
                            //console.log("----->",that.form);
                            that.items[index_episodio].nombres =
                                that.form.nombres;
                            that.items[index_episodio].apellidos =
                                that.form.apellidos;
                            that.items[index_episodio].cedula =
                                that.form.cedula;
                            that.items[index_episodio].email = that.form.email;
                            that.items[index_episodio].genero =
                                that.form.genero;
                            that.items[index_episodio].sexo = that.form.genero;
                            if (response.data.new_imagen === null) {
                                that.items[index_episodio].imagen =
                                    that.form.imagen;
                            } else {
                                that.items[index_episodio].imagen =
                                    response.data.new_imagen;
                            }

                            that.items[index_episodio].nacionalidad =
                                that.form.nacionalidad;
                            that.items[index_episodio].telefono_movil =
                                that.form.telefono_movil;
                            that.items[index_episodio].telefono_hogar =
                                that.form.telefono_hogar;
                            that.items[
                                index_episodio
                            ].paciente = `${that.form.nombres} ${that.form.apellidos}`;
                            //console.log(that.items[index_episodio]);

                            // Escuchar cambios en el bus de eventos
                            EventBus.$on("externalVarChanged", (newValue) => {
                                that.items = newValue;
                            });
                            //alert("Datos Actualizados. Los datos fueron actualizados correctamente.")
                            that.closeModal();
                        } else {
                            alert(
                                "Error. Ocurrió un error al guardar los datos."
                            );
                        }
                    }
                },
                async handle_edit() {
                    await this.getDataPaciente();
                    for (const key in this.dataPaciente) {
                        if (
                            Object.hasOwnProperty.call(this.dataPaciente, key)
                        ) {
                            let element = this.dataPaciente[key];
                            if (key == "cedula") {
                                this.originalCedula = element;
                            }
                            if (key == "email") {
                                this.originalEmail = element;
                            }
                            this.form[key] = element;


                        }
                    }
                    if(this.form.cat_estado_id ===null){
                        this.form.cat_estado_id = 1
                    }
                    if(this.form.cat_municipio_id ===null){
                        this.form.cat_municipio_id = 1
                    }
                    if(this.form.description ===null){
                        this.form.description = "No Indicado"
                    }
                    if(this.form.domicilio ===null){
                        this.form.domicilio = "No Indicado"
                    }
                    console.log(this.form)
                    this.is_a_child();
                    telefonoConfig("#telefono_movil", (iti, input) => {
                        that.telefonoConfig1 = iti;
                        // Manejar el evento countrychange
                        input.addEventListener("countrychange", function () {
                            const selectedCountryData =
                                iti.getSelectedCountryData();
                            //console.log("País seleccionado:", selectedCountryData.name);
                            //console.log("Código de país seleccionado:", selectedCountryData.dialCode);
                            that.updateField("telefono_movil");
                        });
                    });
                    telefonoConfig("#telefono_hogar", (iti, input) => {
                        that.telefonoConfig2 = iti;
                        // Manejar el evento countrychange
                        input.addEventListener("countrychange", function () {
                            const selectedCountryData =
                                iti.getSelectedCountryData();
                            //console.log("País seleccionado:", selectedCountryData.name);
                            //console.log("Código de país seleccionado:", selectedCountryData.dialCode);
                            that.updateField("telefono_hogar");
                        });
                    });
                },
                closeModal() {
                    /* this.$store.commit('updateDinamicComponent', {
                        is_dismounted: true,
                        customComponent: null,
                        patient_data: null,
                        index: null
                    }); */

                    $("#modal-patient-item").modal("hide");
                },
            },
            mounted() {
                this.handle_edit();
                ///console.log(this.dataPaciente);
                /* let that = this
                let { editDataPaciente } = this.$store.state
                 */
            },
        });
    }
    editDEPRECATED20240704(selector, user_id) {
        $("#modal-patient-item").modal("show");

        //CREATE PARA REGISTRO PACIENTE INTERNO
        $("#modal-patient-item .modal-body-2").html(/*html */ `

            <div class="container">
                <div class="row mt-3">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-primary">
                        <div class="h3">
                            Datos del paciente
                        </div>
                    </div>
                </div>

                <div id="user_create" ></div>
                <!--<div class="p-3 mb-2 bg-light text-dark text-center">
                    Para actualizar el <b>Correo Electrónico</b> o el <b>Documento de identidad</b>, comunicarse con el administrador del sistema.
                </div>-->
                <div id="user_profile_create" ></div>
                <input id="cat_user_type_id" type="hidden">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-primary">
                        <div class="h3">
                            Dirección
                        </div>
                    </div>
                </div>
                <div id="user_cuest_direccion_create" ></div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div  class="text-center" >
                            <img onerror="this.src='/image/system/icono-paciente-blanco.svg'"  id="imagen_perfil" style="width: 10%; height:10%" src="/image/user/foto_perfil/doc_id.svg" class="imagen-perfil" alt="Medic default">
                            <br/>
                            <i id="ampliar" class="heartbeat cursor-pointer mt-1 fas fa-search-plus text-primary mr-1" style="font-size:1.3em;"></i>
                            <i id="reducir" class="heartbeat cursor-pointer mt-1 fas fa-search-minus text-primary" style="font-size:1.3em;"></i>
                        </div>
                        <div class="form-group text-center">
                            <label class="label-text text-secondary" for="imagen">Subir Documento de identidad del Paciente</label>
                            <input type="file" class="form-control form-control-lg bg-gray-footer-parodi" name="imagen" id="imagen" aria-describedby="helpId" placeholder="">
                            <small id="helpId1" class="form-text text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <button id="user_cuest_model_update" class="font-weight-bold btn btn-success w-100">Guardar</button>
                    </div>
                    <div class="col-6">
                        <button id="regresar"  data-dismiss="modal" aria-label="Close" class="font-weight-bold btn btn-primary w-100">Regresar</button>
                    </div>
                </div>
            </div>
        `);

        document.getElementById("cat_user_type_id").value = 1;
        fotoTemporal("imagen", ".imagen-perfil");

        $("#ampliar").on("click", function () {
            $("#imagen_perfil").animate({ width: "80%" }, 500);
        });
        $("#reducir").on("click", function () {
            $("#imagen_perfil").animate({ width: "10%" }, 500);
        });
        function validarNumeroConDosDecimales(inputValue) {
            const regex = /^\d+\.\d{2}$/;
            return regex.test(inputValue);
        }
        //VISTAS
        user.create2("#user_create");
        userProfile.create("#user_profile_create");
        userCuestDireccion.create("#user_cuest_direccion_create");
        //$("#nacionalidad,#cedula, #email").css("border", 0);
        let tempCedula = "";
        let tempEmail = "";
        user.show(user_id)
            .then((response) => {
                console.log("User/show: ", response);
                tempEmail = response.email;

                document.getElementById("email").dataset.user_id = user_id;
                document.getElementById("email").dataset.email = response.email;
                $("#email").val(response.email); //.attr("readonly", true)
                $("#email_alternativo").val(response.email_alternativo); //.attr("readonly", true)
                return response.id;
            })
            .then((response) => {
                userProfile
                    .show(response)
                    .then((response) => {
                        console.log("UserProfile/show: ", response);
                        tempCedula = response.cedula;

                        $("#nacionalidad").val(response.nacionalidad); //.attr("disabled", true)
                        $("#cedula").val(response.cedula); //.attr("readonly", true)

                        const numeroValido = validarNumeroConDosDecimales(
                            response.cedula
                        );
                        if (numeroValido) {
                            document
                                .querySelector("#correoAdulto")
                                .classList.add("d-none");
                            document
                                .querySelector("#emailAlternativo")
                                .classList.remove("d-none");
                        } else {
                            document
                                .querySelector("#correoAdulto")
                                .classList.remove("d-none");
                            document
                                .querySelector("#emailAlternativo")
                                .classList.add("d-none");
                        }

                        //$("#cedula").data("cedula",response.cedula)
                        document.getElementById("cedula").dataset.cedula =
                            response.cedula;
                        $("#nombres").val(response.nombres);
                        $("#apellidos").val(response.apellidos);
                        $("#fnacimiento").val(response.fnacimiento);
                        $("#genero").val(response.genero);
                        $("#telefono_movil").val(response.telefono_movil);
                        $(".imagen-perfil").attr(
                            "src",
                            response.imagen == "patient.svg"
                                ? "/image/user/foto_perfil/doc_id.svg"
                                : response.imagen
                        );
                        return response.user_id;
                    })
                    .then((response) => {
                        userCuestDireccion.show(response).then((response) => {
                            console.log("UserCuestDireccion/show: ", response);
                            $("#cat_estado_id").val(response.cat_estado_id);
                            $("#description").val(response.description);
                            $("#domicilio").val(response.domicilio);
                            let municipio_id = response.cat_municipio_id;
                            catUserMunicipio
                                .show($("#cat_estado_id").val())
                                .then((response) => {
                                    $("#cat_municipio_id").html(
                                        select(response, municipio_id)
                                    );
                                    return response;
                                })
                                .then((response) => {
                                    telefonoConfig("#telefono_movil");
                                    let text = iti.isValidNumber()
                                        ? "<span class='text-success'><i class='far fa-check-circle'></i> Formato correcto</span>"
                                        : "<span class='text-danger'><i class='fas fa-exclamation-circle'></i> Formato incorrecto</span>";
                                    $("#help_telefonomovil").html(text);
                                    // $("#messageModal").modal('hide')
                                    //loadingModal("hide")
                                });

                            return response.user_id;
                        });
                    });
            });
        $("#user_cuest_model_update").on("click", function () {
            if (userser.validate2()) {
                if (userProfile.validate()) {
                    if (userCuestDireccion.validate()) {
                        if (userCuestUbicacion.validate2()) {
                            let model = user.update();
                            model.then((response) => {
                                let model = userProfile.update(user_id);
                                model
                                    .then((response) => {
                                        //console.log("UserProfile:", response);
                                        pacientes_datos.map((x) => {
                                            //console.log(x.user_id)
                                            if (x.user_id == response.user_id) {
                                                x.telefono_movil =
                                                    response.telefono_movil;
                                            }
                                            return x;
                                        });
                                        return response.user_id;
                                    })
                                    .then((response) => {
                                        model =
                                            userCuestDireccion.update(response);
                                        model
                                            .then((response) => {
                                                console.log(
                                                    "UserCuestDireccion:",
                                                    response
                                                );
                                                return response.user_id;
                                            })
                                            .then((response) => {
                                                //alert("Información actualizada")
                                                message =
                                                    Component.alertMessage(
                                                        "update_success"
                                                    );
                                                Toast.fire({
                                                    icon: message["image"],
                                                    title: message["title"],
                                                    text: message["message"],
                                                    didClose: () => {
                                                        setTimeout(() => {
                                                            $("#modelId").modal(
                                                                "hide"
                                                            );
                                                        }, 110);
                                                    },
                                                });
                                            });
                                    });
                            });
                        }
                    }
                }
            }
        });
    }
    show1(selector, user_id) {
        $("#modelId").modal("show");
        $(selector).html(`
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg12 ">
                        <div class="table-responsive-md">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td style="color:var(--primary)!important" colspan="5" class="text-center bg-gray text-uppercaser text-primary font-weight-bold text-uppercase">Información del paciente</td>
                                    </tr>
                                    <tr>
                                        <td style="color:var(--primary)!important" class="text-center text-primary font-weight-bold bg-light">Nombres</td>
                                        <td style="color:var(--primary)!important" class="text-center text-primary font-weight-bold bg-light">Apellidos</td>
                                        <td style="color:var(--primary)!important" class="text-center text-primary font-weight-bold bg-light">Cédula</td>
                                        <td style="color:var(--primary)!important" class="text-center text-primary font-weight-bold bg-light">Edad</td>
                                    </tr>
                                    <tr>
                                        <td class="text-secondary text-center">Ranses Alejandro</td>
                                        <td class="text-secondary text-center">Jimenez dominguez</td>
                                        <td class="text-secondary text-center">22.014.778</td>
                                        <td class="text-secondary text-center">22</td>

                                    </tr>
                                    <tr>
                                        <td colspan="2" style="color:var(--primary)!important" class="text-center text-primary font-weight-bold bg-light">Sexo</td>
                                        <td colspan="2" style="color:var(--primary)!important" class="text-center text-primary font-weight-bold bg-light">Dirección</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-secondary text-center">M</td>
                                        <td colspan="2" class="text-secondary text-center">Distrito capital, Municipio libertador, Caracas</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="color:var(--primary)!important" class="text-center text-primary font-weight-bold bg-light">Síntomas</td>
                                        <td colspan="2" style="color:var(--primary)!important" class="text-center text-primary font-weight-bold bg-light">Antecedentes</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-secondary text-center">Temperatura mayor a 38°</td>
                                        <td colspan="2" class="text-secondary text-center">Enfermedad cardiovascular</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="color:var(--primary)!important" class="text-center text-primary font-weight-bold bg-light">Temperatura</td>
                                        <td colspan="2" style="color:var(--primary)!important" class="text-center text-primary font-weight-bold bg-light">Oximetría</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-secondary text-center text-danger font-weight-bold">38°C</td>
                                        <td colspan="2" class="text-secondary text-center text-danger font-weight-bold">90%</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="color:var(--primary)!important" class="text-center text-primary font-weight-bold bg-light h3">OBSERVACIONES</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-secondary text-center h3">
                                            <div class="form-group">
                                            <textarea class="form-control" name="" id="" rows="3"></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg12 ">
                        <button class="btn btn-success btn-block btn-lg">Guardar</button>
                    </div>
                </div>
            </div>
        `);
    }
}
