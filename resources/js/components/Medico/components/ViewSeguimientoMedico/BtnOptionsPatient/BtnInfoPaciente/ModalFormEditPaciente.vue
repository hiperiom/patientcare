<template>
    <Modal>
        <!-- cintillo -->
        <template v-slot:cintillo>
            <CintilloModal :patient_data="patient_data" :index="index" />
        </template>
        <!-- title -->
        <template v-slot:title>
            <div class="container p-0">
                <h3 class="text-primary">
                    Datos del Paciente
                </h3>
            </div>
        </template>
        <!-- content -->
        <template v-slot:content>
            <div class="fade-in flex-fill d-flex flex-column  overflow-auto">

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
                                <small id="sms_cedula" class="form-text text-danger notification"></small>
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
                                    secundario</label>
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
                                <img onerror="this.src='/image/system/icono-paciente-blanco.svg';" id="imagen_perfil"
                                    style="width: 10%; height:10%" :src="form.imagen" class="imagen-perfil"
                                    alt="Medic default">
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
                                <input type="file" class="form-control bg-gray-footer-parodi" name="imagen" id="imagen"
                                    aria-describedby="helpId" placeholder="">
                                <small id="helpId1" class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </template>
        <!-- footer -->
        <template v-slot:footer>
            <div class="container-fluid">
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

        </template>

    </Modal>
</template>

<script>
import Modal from './Modal.vue';
import CintilloModal from '../../Modals/CintilloModal.vue';
import { cat_estados } from "../../../../../../helpers/cat_estados.js"
import { cat_municipios } from "../../../../../../helpers/cat_municipios.js"
import { telefonoConfig, validarPrimerDigito, validarNumeroConDosDecimales, is_null, timestamps } from '../../../../../../helpers/customHelpers';
import { get } from '../../../../../../helpers/customHelpers';
import { is_empty } from '../../../../../../helpers/customHelpers';
import { post } from '../../../../../../helpers/customHelpers';
export default {
    name: "ModalFormEditPaciente",
    components: {
        Modal,
        CintilloModal,
    },
    data() {
        return {
            is_child: false,
            cat_estados: cat_estados,
            telefonoConfig1: null,
            telefonoConfig2: null,
            form: {
                "id": null,
                "email": null,
                "email_alternativo": null,
                "nacionalidad": null,
                "cedula": null,
                "telefono_movil": null,
                "imagen": null,
                "nombres": null,
                "apellidos": null,
                "genero": null,
                "fnacimiento": null,
                "telefono_hogar": null,
                "cat_user_type_id": null,
                "cat_estado_id": null,
                "cat_municipio_id": null,
                "description": null,
                "domicilio": null,
            }
        }
    },
    props: {
        patient_data: Object,
        index: Number,
    },
    computed: {

        getCatMunicipio() {
            return cat_municipios.filter(item => item['cat_estado_id'] === this.form.cat_estado_id)
        },
    },
    methods: {
        validateForm() {
            let formNotValidate = true

            let inputName = 'cedula'
            let input = this.$refs[inputName]
            if (is_empty(this.form[inputName]) && formNotValidate) {
                alert("El campo cédula no puede estar vacio.")
                input.focus()
                formNotValidate = false
                return false
            }
            inputName = 'email'
            input = this.$refs[inputName]
            if (is_empty(this.form[inputName]) && formNotValidate) {
                alert("El campo Correo electrónico no puede estar vacio.")
                input.focus()
                formNotValidate = false
                return false
            }
            inputName = 'nombres'
            input = this.$refs[inputName]
            if (is_empty(this.form[inputName]) && formNotValidate) {
                alert("El campo Nombres no puede estar vacio.")
                input.focus()
                formNotValidate = false
                return false
            }
            inputName = 'apellidos'
            input = this.$refs[inputName]
            if (is_empty(this.form[inputName]) && formNotValidate) {
                alert("El campo Apellidos no puede estar vacio.")
                input.focus()
                formNotValidate = false
                return false
            }
            inputName = 'genero'
            input = this.$refs[inputName]
            if (is_empty(this.form[inputName]) && formNotValidate) {
                alert("El campo Género no puede estar vacio.")
                input.focus()
                formNotValidate = false
                return false
            }
            inputName = 'fnacimiento'
            input = this.$refs[inputName]
            if (is_empty(this.form[inputName]) && formNotValidate) {
                alert("El campo Fecha de Nacimiento no puede estar vacio.")
                input.focus()
                formNotValidate = false
                return false
            }
            inputName = 'telefono_movil'
            input = this.$refs[inputName]
            if (is_empty(this.form[inputName]) && formNotValidate) {
                alert("El campo Teléfono Contacto no puede estar vacio.")
                input.focus()
                formNotValidate = false
                return false
            }
            inputName = 'cat_estado_id'
            input = this.$refs[inputName]
            console.log(this.form[inputName]);
            if (is_null(this.form[inputName]) && formNotValidate) {
                alert("El campo Estado no puede estar vacio.")
                input.focus()
                formNotValidate = false
                return false
            }
            inputName = 'cat_municipio_id'
            input = this.$refs[inputName]
            if (is_null(this.form[inputName]) && formNotValidate) {
                alert("El campo Municipio no puede estar vacio.")
                input.focus()
                formNotValidate = false
                return false
            }
            inputName = 'description'
            input = this.$refs[inputName]
            if (is_null(this.form[inputName]) && formNotValidate) {
                alert("El campo Ciudad no puede estar vacio.")
                input.focus()
                formNotValidate = false
                return false
            }
            inputName = 'domicilio'
            input = this.$refs[inputName]
            if (is_null(this.form[inputName]) && formNotValidate) {
                alert("El campo Domicilio no puede estar vacio.")
                input.focus()
                formNotValidate = false
                return false
            }

            if (formNotValidate) {
                return true
            } else {
                return false
            }

        },
        async store() {
            let formdata = new FormData();
            for (const key in this.form) {
                if (Object.hasOwnProperty.call(this.form, key)) {
                    let element = this.form[key];
                    formdata.append(key, element)
                }
            }
            formdata.append("user_cuest_episodio_id", this.patient_data.episodio_id)
            formdata.append("user_id_paciente", this.patient_data.user_id)
            formdata.append("created_at", timestamps())
            formdata.append("_token", $("#_token").val())
            await post(location.origin + "/user_paciente/update", formdata)
            return true
        },
        async updateField(fieldName) {
            if (fieldName === "cedula") {
                let result = await this.validateCedula()
                if (!result.exist) {
                    this.is_a_child()
                }
            }
            if (fieldName === "email") {
                let result = await this.validateEmail()
                if (!result.exist) {
                    let inputName = 'email'
                    let input = this.$refs[inputName]

                    alert("El campo Correo electrónico ya se encuentra asociado a otro paciente.")
                    this.form.email = this.originalEmail
                    input.focus()
                }
                return false
            }
            if (fieldName === "telefono_movil") {
                this.form.telefono_movil = this.telefonoConfig1.getNumber()
                return false
            }
            if (fieldName === "telefono_hogar") {
                this.form.telefono_hogar = this.telefonoConfig2.getNumber()
                return false
            }
        },
        is_a_child() {
            if (this.form.cedula !== null) {
                let numeroValido = validarNumeroConDosDecimales(this.form.cedula)
                if (numeroValido) {
                    this.is_child = true
                } else {
                    this.is_child = false
                }
            }
        },
        async validateEmail() {
            if (this.form.cedula !== "") {
                let formdata = new FormData();
                formdata.append("nacionalidad", this.form.nacionalidad)
                formdata.append("cedula", this.originalCedula)
                formdata.append("email", this.form.email)
                formdata.append("_token", $("#_token").val())
                let result = await post(location.origin + "/user/emailExist", formdata)
                return result
            } else {
                return {
                    exist: false
                }
            }
        },
        async validateCedula() {
            if (this.form.cedula !== "") {
                let formdata = new FormData();
                formdata.append("nacionalidad", this.form.nacionalidad)
                formdata.append("cedula", this.form.cedula)
                formdata.append("_token", $("#_token").val())
                let result = await get(location.origin + "/getPatient/" + this.form.cedula)
                if (result.exist) {
                    alert("La cédula escrita ya se encuentra asociada a un paciente.")
                    this.form['cedula'] = this.originalCedula
                }
                console.log("cedula_encontrada->", result)

                return result
            } else {
                return {
                    exist: false
                }
            }
        },
        vPrimerDigito(param) {
            validarPrimerDigito(param)
        },
        async handle_store() {
            if (this.validateForm()) {
                if (await this.store()) {
                    this.patient_data.nombres = this.form.nombres
                    this.patient_data.apellidos = this.form.apellidos
                    this.patient_data.cedula = this.form.cedula
                    this.patient_data.cedula = this.form.cedula
                    this.patient_data.email = this.form.email
                    this.patient_data.genero = this.form.genero
                    this.patient_data.sexo = this.form.genero
                    this.patient_data.imagen = this.form.imagen
                    this.patient_data.nacionalidad = this.form.nacionalidad
                    this.patient_data.telefono_movil = this.form.telefono_movil
                    this.patient_data.telefono_hogar = this.form.telefono_hogar
                    this.patient_data.paciente = `${this.form.nombres} ${this.form.apellidos}`
                    alert("registrado")
                    this.closeModal()
                }
            }
        },
        closeModal() {
            this.$store.commit('updateDinamicComponent', {
                is_dismounted: true,
                customComponent: null,
                patient_data: null,
                index: null
            });
            $("#modal-datos-paciente").modal("hide")
        },
    },
    mounted() {
        let that = this
        let { editDataPaciente } = this.$store.state
        for (const key in editDataPaciente) {
            if (Object.hasOwnProperty.call(editDataPaciente, key)) {
                let element = editDataPaciente[key];
                if (key == "cedula") {
                    this.originalCedula = element
                }
                if (key == "email") {
                    this.originalEmail = element
                }
                this.form[key] = element
            }
        }
        this.is_a_child()
        telefonoConfig("#telefono_movil", (iti, input) => {
            that.telefonoConfig1 = iti
            // Manejar el evento countrychange
            input.addEventListener('countrychange', function () {
                const selectedCountryData = iti.getSelectedCountryData();
                //console.log("País seleccionado:", selectedCountryData.name);
                //console.log("Código de país seleccionado:", selectedCountryData.dialCode);
                that.updateField("telefono_movil")
            });
        })
        telefonoConfig("#telefono_hogar", (iti, input) => {
            that.telefonoConfig2 = iti
            // Manejar el evento countrychange
            input.addEventListener('countrychange', function () {
                const selectedCountryData = iti.getSelectedCountryData();
                //console.log("País seleccionado:", selectedCountryData.name);
                //console.log("Código de país seleccionado:", selectedCountryData.dialCode);
                that.updateField("telefono_hogar")
            });
        })

    },
}
</script>

<style lang="scss" scoped></style>
