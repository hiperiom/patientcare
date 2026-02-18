<template>
    <div class="flex-fill p-1 d-flex flex-column overflow-auto">
        <!-- <CintilloModal :index_row="index_row" :dataPaciente="dataPaciente" /> -->

        <div class="flex-fill mt-1 rounded overflow-auto">
            <div class="container">
                <h3 class="text-primary">Nuevo Paciente</h3>
                <ul class="collapse-list">
                    <li>
                        <input class="collapse-open" type="checkbox" checked id="collapse-1">
                        <label class="collapse-btn h5 text-primary font-weight-bold" for="collapse-1">Datos del
                            Paciente</label>
                        <div class="collapse-painel">
                            <div class="collapse-inner">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="label-text text-secondary" for="cedula">Documento de
                                                identidad</label>
                                            <div class="d-flex align-items-center">
                                                <select ref="nacionalidad"
                                                    class="flex-shrink-1 form-control bg-gray-footer-parodi"
                                                    style="width: fit-content;" v-model="form.nacionalidad">
                                                    <option value="V">V</option>
                                                    <option value="E">E</option>
                                                    <option value="P">P</option>
                                                </select>

                                                <div class="input-group">

                                                    <input v-model="form.cedula" ref="cedula" @change="validateCedula()"
                                                        type="number"
                                                        class="ml-1 flex-grow-1 form-control bg-gray-footer-parodi">
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
                                            <small ref="sms_cedula" id="sms_cedula"
                                                class="form-text text-danger notification">
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div v-if="!emailAlternativo" class="form-group">
                                            <label class="label-text text-secondary" for="email">Correo electrónico</label>
                                            <input ref="email" v-model="form.email" type="email"
                                                class="form-control bg-gray-footer-parodi">
                                            <small id="sms_email" class="form-text text-danger notification"></small>
                                        </div>
                                        <div v-if="emailAlternativo" class="form-group">
                                            <label class="label-text text-secondary" for="email_alternativo">Correo
                                                electrónico <span class="font-weight-bold">(del
                                                    representante)</span></label>
                                            <input v-model="form.email_alternativo" type="email"
                                                class="form-control bg-gray-footer-parodi" name="email_alternativo"
                                                id="email_alternativo" aria-describedby="helpId">
                                            <small id="sms_email_alternativo"
                                                class="form-text text-danger notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="label-text text-secondary" for="nombre">Nombres</label>
                                            <input ref="nombres" v-model="form.nombres" type="text"
                                                class="form-control bg-gray-footer-parodi">
                                            <small id="helpId1" class="form-text text-muted notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="label-text text-secondary" for="apellido">Apellidos</label>
                                            <input ref="apellidos" v-model="form.apellidos" type="text"
                                                class="form-control bg-gray-footer-parodi">
                                            <small id="helpId1" class="form-text text-muted notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="label-text text-secondary" for="genero">Género</label>
                                            <select ref="genero" v-model="form.genero" type="text"
                                                class="form-control bg-gray-footer-parodi">
                                                <option value="m">Masculino</option>
                                                <option value="f">Femenino</option>
                                            </select>
                                            <small id="helpId1" class="form-text text-muted notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="label-text text-secondary" for="fnacimiento">Fecha de
                                                nacimiento</label>
                                            <div class="input-group mb-3">
                                                <input ref="fnacimiento" v-model="form.fnacimiento" type="date"
                                                    class="form-control bg-gray-footer-parodi">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2"><i
                                                            class="fas fa-birthday-cake mr-2"></i> {{ calcularEdad() }}
                                                        años</span>
                                                </div>
                                            </div>


                                            <small id="helpId1" class="form-text text-muted notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="label-text text-secondary" for="telefono_movil">Teléfono
                                                contacto</label> <br>
                                            <input id="telefono_movil"
                                                @keyup="handleTelefono('help_telefono_movil', 'telefono_movil')"
                                                ref="telefono_movil" type="number"
                                                class="form-control bg-gray-footer-parodi">
                                            <small ref="help_telefono_movil"
                                                class="form-text text-muted notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="label-text text-secondary" for="telefono_hogar">Teléfono
                                                secundario</label>
                                            <input id="telefono_hogar" ref="telefono_hogar" v-model="form.telefono_hogar"
                                                type="number" class="form-control bg-gray-footer-parodi">
                                            <small id="help_telefono_hogar"
                                                class="form-text text-muted notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex flex-column">
                                            <label class="label-text text-secondary" for="imagen">Foto
                                                identificación</label>
                                            <div class="d-flex align-items-center mb-1">
                                                <img id="imagen_perfil"
                                                    onerror="this.src='/image/user/foto_perfil/doc_id.svg'" src="#"
                                                    style="width: 80px; height:80px" class="imagen-perfil"
                                                    alt="Medic default">
                                                <input @change="handleImagenPaciente" type="file" style="height: 44px;"
                                                    class=" ml-2 form-control bg-gray-footer-parodi" name="imagen"
                                                    ref="imagen" aria-describedby="helpId">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <input class="collapse-open" type="checkbox" checked id="collapse-2">
                        <label class="collapse-btn h5 text-primary font-weight-bold" for="collapse-2">Dirección de
                            habitación</label>
                        <div class="collapse-painel">
                            <div class="collapse-inner">
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label class="label-text text-secondary" for="">Estado:</label>
                                            <select ref="cat_estado_id" v-model="form.cat_estado_id" type="date"
                                                class="form-control bg-gray-footer-parodi">
                                                <option v-for="(item, index) in $store.state.catEstado" :key="index"
                                                    :value="item.id">{{ item.description }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label class="label-text text-secondary" for="">Municipio:</label>
                                            <select ref="cat_municipio_id" name="cat_municipio_id"
                                                class="form-control bg-gray-footer-parodi" v-model="form.cat_municipio_id">
                                                <option v-for="(item, index) in getCatMunicipio" :key="index"
                                                    :value="item.id">{{ item.description }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label class="label-text text-secondary" for="">Ciudad:</label>
                                            <input ref="description" type="text" class="form-control bg-gray-footer-parodi"
                                                name="description" id="description" v-model="form.description">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="label-text text-secondary" for="">Domicilio:</label>
                                            <textarea class="form-control form-control-lg bg-gray-footer-parodi"
                                                name="domicilio" ref="domicilio" v-model="form.domicilio"
                                                rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <input class="collapse-open" type="checkbox" checked id="collapse-3">
                        <label class="collapse-btn h5 text-primary font-weight-bold" for="collapse-3">Área de
                            ubicación</label>
                        <div class="collapse-painel">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="label-text text-secondary" for="">Fecha de ingreso:</label>
                                        <input ref="ingreso" type="date" class="form-control bg-gray-footer-parodi"
                                            v-model="form.ingreso">
                                    </div>

                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="label-text text-secondary" for="cat_user_ubicacion_id">Nueva
                                            Ubicación:</label>
                                        <select @change="updateCatUbicacion('cat_user_ubicacion_id', 'catUbicacionTemp2')"
                                            ref="cat_user_ubicacion_id" name="cat_user_ubicacion_id"
                                            class="form-control bg-gray-footer-parodi">
                                            <option value="245">Sala de Espera (SE)</option>
                                            <option v-for="(item, index) in getCatUbicacionAreas" :key="index"
                                                :value="item.id">{{ item.description }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div :class="['col-12', { 'd-none': catUbicacionTemp2.length === 0 }]">
                                    <div class="form-group">
                                        <select @change="updateCatUbicacion('cat_user_ubicacion_id_2', 'catUbicacionTemp3')"
                                            ref="cat_user_ubicacion_id_2" class="form-control bg-gray-footer-parodi">
                                            <!-- <option value="">Seleccione</option> -->
                                            <option v-for="(item, index) in getCatUbicacionAreas2" :key="index"
                                                :value="item.id">{{ item.coments }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div :class="['col-12', { 'd-none': catUbicacionTemp3.length === 0 }]">
                                    <div class="form-group">
                                        <select @change="updateCatUbicacion('cat_user_ubicacion_id_3', 'catUbicacionTemp4')"
                                            ref="cat_user_ubicacion_id_3" class="form-control bg-gray-footer-parodi">
                                            <!-- <option value="">Seleccione</option> -->
                                            <option v-for="(item, index) in getCatUbicacionAreas3" :key="index"
                                                :value="item.id">{{ item.coments }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div :class="['col-12', { 'd-none': catUbicacionTemp4.length === 0 }]">
                                    <div class="form-group">
                                        <select @change="updateCatUbicacion('cat_user_ubicacion_id_4', null)"
                                            ref="cat_user_ubicacion_id_4" class="form-control bg-gray-footer-parodi">
                                            <!-- <option value="">Seleccione</option> -->
                                            <option v-for="(item, index) in getCatUbicacionAreas4" :key="index"
                                                :value="item.id">{{ item.coments }}</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </li>
                    <li>
                        <input class="collapse-open" type="checkbox" id="collapse-4">
                        <label class="collapse-btn h5 text-primary font-weight-bold" for="collapse-4">Datos del
                            Familiar</label>
                        <div class="collapse-painel">
                            <div class="collapse-inner">
                                <div class="row">
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
                                                <option value="m">Masculino</option>
                                                <option value="f">Femenino</option>
                                            </select>
                                            <small id="helpId1" class="form-text text-muted notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="label-text text-secondary"
                                                for="cat_user_family_id">Vínculo</label>
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
                                            <label class="label-text text-secondary" for="telefono_movil_familiar">Teléfono
                                                contacto</label> <br>
                                            <input id="telefono_movil_familiar"
                                                @keyup="handleTelefono('help_telefono_movil_familiar', 'telefono_movil_familiar')"
                                                ref="telefono_movil_familiar" type="number"
                                                class="form-control bg-gray-footer-parodi">
                                            <small ref="help_telefono_movil_familiar"
                                                class="form-text text-muted notification"></small>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="rounded container mt-1">
            <div class="row">
                <div class="col-6">
                    <button @click="submitForm()" class="w-100 btn btn-success">
                        Registrar Paciente
                    </button>
                </div>
                <div class="col-6">
                    <!-- data-dismiss="modal" aria-label="Close" -->
                    <button @click="closeForm()" class="w-100 btn btn-primary">
                        Cancelar
                    </button>
                </div>


            </div>
        </div>

    </div>
</template>

<script>
import { get, emptyObj, post, calcularEdad, timestamps, fechaHoy, is_empty, obtenerVariablesGET, is_null, is_undefined } from '../../../helpers/customHelpers';
import FormReingresoPaciente from './FormReingresoPaciente.vue';
export default {
    name: "FormPacienteCreate",
    data() {
        return {
            iti_telefono_movil: null,
            iti_telefono_movil_familiar: null,
            is_formValidate: true,
            loadingSearchCedula: false,
            emailAlternativo: false,
            catUbicacionTemp2: [],
            catUbicacionTemp3: [],
            catUbicacionTemp4: [],
            formTemp: {
                nacionalidad: "V",
                cedula: "",
                email: "",
                nombres: "",
                apellidos: "",
                genero: "m",
                fnacimiento: fechaHoy(),
                telefono_movil: "",
                telefono_hogar: "",
                cat_estado_id: 1,
                cat_municipio_id: 1,
                description: "",
                domicilio: "",
                firma: null,
                sello: null,
                ingreso: fechaHoy(),
                imagen: null,
                email_alternativo: "",
                password: 123456,
                created_at: timestamps(),
                cat_user_ubicacion_id: 245,

            },
            form: {
                nacionalidad: "V",
                cedula: "",
                email: "",
                nombres: "",
                apellidos: "",
                genero: "m",
                fnacimiento: fechaHoy(),
                telefono_movil: "",
                telefono_hogar: "",
                cat_estado_id: 1,
                cat_municipio_id: 1,
                description: "",
                domicilio: "",
                firma: null,
                sello: null,
                ingreso: fechaHoy(),
                imagen: null,
                email_alternativo: "",
                password: 123456,
                created_at: timestamps(),
                cat_user_ubicacion_id: 245,

                nombre_familiar: "",
                apellido_familiar: "",
                email_familiar: "",
                cedula_familiar: "",
                cat_user_family_id: "",
                genero_familiar: "m",
                telefono_movil_familiar: "",

            },
        }
    },
    props: {
        index_row: Number,
        dataPaciente: Object
    },
    components: {
        FormReingresoPaciente,
    },
    computed: {
        getCatMunicipio() {
            return this.$store.state.catMunicipio.filter(item => Number(item['cat_estado_id']) === Number(this.form.cat_estado_id))
        },
        getCatUbicacionAreas() {
            return this.$store.state.catUbicacion.filter(item => item['parent_cat_user_ubicacion_id'] === 1 && ![246].includes(item['id'])).sort((a, b) => a.orden - b.orden);
        },
        getCatUbicacionAreas2() {
            return this.catUbicacionTemp2.sort((a, b) => a.orden - b.orden);
        },
        getCatUbicacionAreas3() {
            return this.catUbicacionTemp3.sort((a, b) => a.orden - b.orden);
        },
        getCatUbicacionAreas4() {
            return this.catUbicacionTemp4.sort((a, b) => a.orden - b.orden);
        },
    },

    methods: {
        async updateCatUbicacion(param) {

            if (param === 'cat_user_ubicacion_id') {
                this.form.cat_user_ubicacion_id = Number(this.$refs[param].value)
                this['catUbicacionTemp2'] = (await get(location.origin + '/cat_user_ubicacion/show/' + this.form.cat_user_ubicacion_id)).sort((a, b) => a.orden - b.orden);

                setTimeout(async () => {
                    this.form.cat_user_ubicacion_id = Number(this.$refs['cat_user_ubicacion_id_2'].value)
                    this['catUbicacionTemp3'] = (await get(location.origin + '/cat_user_ubicacion/show/' + this.form.cat_user_ubicacion_id)).sort((a, b) => a.orden - b.orden);
                }, 500);

                setTimeout(async () => {
                    this.form.cat_user_ubicacion_id = Number(this.$refs['cat_user_ubicacion_id_3'].value)
                    this['catUbicacionTemp4'] = (await get(location.origin + '/cat_user_ubicacion/show/' + this.form.cat_user_ubicacion_id)).sort((a, b) => a.orden - b.orden);

                }, 500);

            }
            if (param === 'cat_user_ubicacion_id_2') {
                this.form.cat_user_ubicacion_id = Number(this.$refs[param].value)
                this['catUbicacionTemp3'] = (await get(location.origin + '/cat_user_ubicacion/show/' + this.form.cat_user_ubicacion_id)).sort((a, b) => a.orden - b.orden);
                setTimeout(async () => {
                    this.form.cat_user_ubicacion_id = Number(this.$refs['cat_user_ubicacion_id_3'].value)
                    this['catUbicacionTemp4'] = (await get(location.origin + '/cat_user_ubicacion/show/' + this.form.cat_user_ubicacion_id)).sort((a, b) => a.orden - b.orden);
                }, 500);
            }
            if (param === 'cat_user_ubicacion_id_3') {
                this.form.cat_user_ubicacion_id = Number(this.$refs[param].value)
                this['catUbicacionTemp4'] = (await get(location.origin + '/cat_user_ubicacion/show/' + this.form.cat_user_ubicacion_id)).sort((a, b) => a.orden - b.orden);

            }


        },
        async validateForm() {
            if (is_empty(this.form.cedula)) {
                Swal.fire({
                    icon: "error",
                    title: "Campo vacio.",
                    text: "El campo Documento de identidad no puede estar vacio.",
                    didClose: () => {
                        setTimeout(() => { this.$refs.cedula.focus(); }, 110);
                    }

                })
                this.is_formValidate = false
                return false
            }
            if (is_empty(this.form.email)) {
                /* Swal.fire({
                    icon: "error",
                    title: "Campo vacio.",
                    text: "El campo Correo Electrónico no puede estar vacio.",
                    didClose: () => {
                        setTimeout(() => { this.$refs.email.focus();}, 110);
                    }

                })
                this.is_formValidate =false
                return false */
            }
            if (is_empty(this.form.nombres)) {
                Swal.fire({
                    icon: "error",
                    title: "Campo vacio.",
                    text: "El campo Nombres no puede estar vacio.",
                    didClose: () => {
                        setTimeout(() => { this.$refs.nombres.focus(); }, 110);
                    }

                })
                this.is_formValidate = false
                return false
            }
            if (is_empty(this.form.apellidos)) {
                Swal.fire({
                    icon: "error",
                    title: "Campo vacio.",
                    text: "El campo Apellidos no puede estar vacio.",
                    didClose: () => {
                        setTimeout(() => { this.$refs.apellidos.focus(); }, 110);
                    }

                })
                this.is_formValidate = false
                return false
            }
            if (is_empty(this.form.telefono_movil)) {
                Swal.fire({
                    icon: "error",
                    title: "Campo vacio.",
                    text: "El campo Teléfono contacto no puede estar vacio.",
                    didClose: () => {
                        setTimeout(() => { this.$refs.telefono_movil.focus(); }, 110);
                    }

                })
                this.is_formValidate = false
                return false
            }
            if (is_empty(this.form.cat_estado_id)) {
                Swal.fire({
                    icon: "error",
                    title: "Campo vacio.",
                    text: "El campo Estado debe estar seleccionado.",
                    didClose: () => {
                        setTimeout(() => { this.$refs.cat_estado_id.focus(); }, 110);
                    }

                })
                this.is_formValidate = false
                return false
            }
            if (is_empty(this.form.cat_municipio_id)) {
                Swal.fire({
                    icon: "error",
                    title: "Campo vacio.",
                    text: "El campo Municipio debe estar seleccionado.",
                    didClose: () => {
                        setTimeout(() => { this.$refs.cat_municipio_id.focus(); }, 110);
                    }

                })
                this.is_formValidate = false
                return false
            }
            if (is_empty(this.form.description)) {
                Swal.fire({
                    icon: "error",
                    title: "Campo vacio.",
                    text: "El campo Ciudad no debe estar vacio.",
                    didClose: () => {
                        setTimeout(() => { this.$refs.description.focus(); }, 110);
                    }

                })
                this.is_formValidate = false
                return false
            }
            if (is_empty(this.form.domicilio)) {
                Swal.fire({
                    icon: "error",
                    title: "Campo vacio.",
                    text: "El campo Domicilio no debe estar vacio.",
                    didClose: () => {
                        setTimeout(() => { this.$refs.domicilio.focus(); }, 110);
                    }

                })
                this.is_formValidate = false
                return false
            }



        },
        closeForm() {
            for (const key in this.formTemp) {
                if (Object.hasOwnProperty.call(this.form, key)) {
                    this.form[key] = this.formTemp[key];
                }
            }
            $("#exampleModal").modal("hide")
        },
        async submitForm() {
            //if (true ) {
            this.is_formValidate = true
            this.validateForm()

            if (this.is_formValidate) {
                let formData = new FormData()
                for (const key in this.form) {
                    if (Object.hasOwnProperty.call(this.form, key)) {
                        const element = this.form[key];
                        console.log(key, element)
                        if (key === "email") {
                            if (this.form[key] === "") {
                                formData.append("email", this.form['cedula'] + "@correotemporal.com")
                            } else {
                                formData.append("email", this.form['cedula'])
                            }
                        } else {
                            formData.append(key, element)
                        }

                    }
                }


                formData.append("_token", $("#_token").val())
                let resultset = await post(location.origin + "/user/paciente/storePaciente", formData)
                if (resultset.success) {
                    this.closeForm()
                    await this.getPacientesActivos()

                    Swal.fire({
                        icon: "success",
                        title: "Paciente Registrado",
                        text: "El paciente ya puede visualizarse desde el area indicada.",
                        didClose: () => {
                            setTimeout(() => { this.$refs.cedula.focus(); }, 110);
                            $("#exampleModal").modal("hide")
                        }

                    })
                } else {

                }
            }
        },

        async validateCedula() {

            const numeroValido = this.validarNumeroConDosDecimales(this.form.cedula)
            if (numeroValido) {
                this.form.email = `${this.form.cedula}@correotemporal.com`
                this.emailAlternativo = true
            } else {
                this.emailAlternativo = false
                this.form.email = ``
            }
            try {
                this.loadingSearchCedula = true

                let response = await get(location.origin + "/getPatient/" + this.form.cedula)
                console.log(response)
                this.loadingSearchCedula = false
                if (response.exist) {
                    this.$refs.sms_cedula.innerHTML = "<i class='fas fa-exclamation-triangle'></i> La cédula está registrada"

                    if (response.episodesOpen.length === 0) {
                        Swal.fire({
                            title: "Cédula registrada!",
                            html: `
                                        La cédula <b>${this.form.cedula}</b> está asociada al paciente:
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Nombres:</th>
                                                <th>Apellidos:</th>
                                                <th>Ubicación actual:</th>
                                            </tr>
                                            <tr>
                                                <td>${response.user.profile.nombres}</td>
                                                <td>${response.user.profile.apellidos}</td>
                                                <td>${is_undefined(response.episodesOpen.ubicacion_description) ? '' : response.episodesOpen.ubicacion_description}</td>
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
                            cancelButtonText: "No!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.handle_ReingresoPaciente(response.user.profile)
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
                                        La cédula <b>${this.form.cedula}</b> está asociada al paciente:
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Nombres:</th>
                                                <th>Apellidos:</th>
                                                <th>Ubicación actual:</th>
                                            </tr>
                                            <tr>
                                                <td>${response.user.profile.nombres}</td>
                                                <td>${response.user.profile.apellidos}</td>
                                                <td>${is_undefined(response.episodesOpen.ubicacion_description) ? '' : response.episodesOpen.ubicacion_description}</td>
                                            </tr>
                                        </table>

                                    `,
                            allowOutsideClick: false,
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Ir a la ubicación actual del paciente",
                            cancelButtonText: "Cancelar!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                let ubicacion_description = this.$store.state.catUbicacion.find(x => x['id'] === response.episodesOpen.ubicacion_id)
                                let nuevoId = ubicacion_description.description.toLowerCase()
                                this.$router.push({ path: location.pathname + `?route=${nuevoId}` }); // O $router.replace() si deseas reemplazar la historia de navegación
                                this.$store.commit('updateProperty', {
                                    fieldName: 'ruta',
                                    fieldValue: obtenerVariablesGET(location.href).route,
                                });
                                let { area_description } = this.$store.state.menuAreas.find(item => item['area_siglas'] === this.$store.state.ruta)
                                this.$store.commit('updateProperty', {
                                    fieldName: 'area_description',
                                    fieldValue: area_description,
                                });

                                localStorage.setItem('area_siglas', this.$store.state.ruta)
                                localStorage.setItem('area_description', this.$store.state.area_description)
                                this.getPacientesActivos()
                                $("#exampleModal").modal("hide")

                            }
                        });
                    }

                } else {
                    this.$refs.sms_cedula.innerHTML = "<i class='fas fa-check-circle text-success'></i><span class='text-success'> Cédula no registrada</span>"
                }

                return false
            } catch (error) {
                console.log(error)
                this.loadingSearchCedula = false
            }

        },
        handleImagenPaciente(event) {
            const file = event.target.files[0]; // Obtenemos el archivo seleccionado
            //this.imageUrl = URL.createObjectURL(file); // Creamos una URL de objeto para mostrar la imagen
            this.form.imagen = file;
        },
        handle_ReingresoPaciente(dataPaciente) {
            this.$store.commit('updateProperty', {
                fieldName: 'componenteDinamico',
                fieldValue: {
                    customComponent: this.$options.components.FormReingresoPaciente,
                    index_row: 0,
                    dataPaciente: dataPaciente
                }
            });

            $("#exampleModal").modal("show")
        },
        async getPacientesActivos() {
            try {
                this.$store.commit('updateProperty', {
                    fieldName: 'loading',
                    fieldValue: true,
                });
                let model = await get(location.origin + "/vistas/" + this.$store.state.ruta);
                this.$store.commit('updateProperty', {
                    fieldName: 'pacientes_datos',
                    fieldValue: model,
                })
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
        validarNumeroConDosDecimales(inputValue) {
            const regex = /^\d+\.\d{2}$/;
            return regex.test(inputValue);
        },
        calcularEdad() {
            return calcularEdad(this.form.fnacimiento)
        },
        handleTelefono(selector, input) {
            //.log(this.$refs[input].value.length)
            if (this.$refs[input].value.length === 1) {
                if (this.$refs[input].value == 0) {
                    this.$refs[input].value = ""
                    return false
                }
            }
            console.log("International: " + this['iti_' + input].getNumber())
            this.form[input] = this['iti_' + input].getNumber()
            this.$refs[selector].innerHTML = (this['iti_' + input].isValidNumber())
                ? `
                <span class='text-success'>
                <i class='far fa-check-circle'></i> Formato correcto</span>
            `
                : `
                <span class='text-danger'>
                    <i class='fas fa-exclamation-circle'></i> Formato incorrecto
                </span>
            `;

            //console.log(this.form[input])

        },
        telefonoConfig(inputNew) {
            var input = this.$refs[inputNew];
            this['iti_' + inputNew] = window.intlTelInput(input, {
                //customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                //    return "4141235555";
                //  },
                // allowDropdown: false,
                // autoPlaceholder: "off",
                // dropdownContainer: document.body,
                // excludeCountries: ["us"],
                // formatOnDisplay: false,
                // geoIpLookup: function(callback) {
                //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                //     var countryCode = (resp && resp.country) ? resp.country : "";
                //     callback(countryCode);
                //   });
                // },
                // hiddenInput: "full_number",
                // initialCountry: "auto",
                // localizedCountries: { 'de': 'Deutschland' },
                // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
                // placeholderNumberType: "MOBILE",
                autoHideDialCode: true,
                nationalMode: false,
                preferredCountries: ['ve'],
                separateDialCode: true,
                utilsScript: "/plugin/intl-tel-input/build/js/utils.js",
            });


        },

    },
    mounted() {


        this.telefonoConfig("telefono_movil_familiar")
        this.telefonoConfig("telefono_movil")
    }
}
</script>

<style scoped>
.iti {
    display: block !important;
}

.collapse-list {
    margin-bottom: 0;
    padding-left: 0;
    list-style: none;
    border-bottom: 1px solid #e0e0e0;
}

.collapse-open {
    display: none;
}

.collapse-painel {
    visibility: hidden;
    max-height: 0;
    opacity: 0;
    transition: max-height .1s,
        visibility .3s,
        opacity .3s;
}

.collapse-open:checked~.collapse-painel {
    max-height: 100%;
    opacity: 100;
    visibility: visible
}

.collapse-list li {
    margin-bottom: 0;
}

.collapse-list .collapse-btn {
    border-top: 1px solid #e0e0e0;
    cursor: pointer;
    display: block;
    padding: 15px 10px;
    margin-bottom: 0;
    color: #4285f4;
    font-weight: normal;
    transition: background-color .2s ease;
}

.collapse-list .collapse-btn:hover {
    background: #eee;
}

.collapse-open~.collapse-btn:before {
    content: "↓";
    float: right;
}

.collapse-open:checked~.collapse-btn:before {
    content: "↑";
}
</style>
