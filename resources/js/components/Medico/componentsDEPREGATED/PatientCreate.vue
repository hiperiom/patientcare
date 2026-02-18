<template>
    <div class="d-flex flex-column vh-1">
        <div class="bg-gray-1 sticky flex-shrink-1 p-1">
            <div class="d-flex flex-column align-items-start flex-sm-row align-items-sm-center justify-content-between">
                <h3 class="text-primary mb-0">{{$route.name}}</h3>
            </div>
        </div>
        <div class="container-fluid flex-grow-1 overflow-auto">
            <div class="container">
                <ul class="collapse-list">
                    <li>
                        <input class="collapse-open" type="checkbox" id="collapse-1">
                        <label class="collapse-btn h5 text-primary font-weight-bold" for="collapse-1">Datos del Paciente</label>
                        <div class="collapse-painel">
                            <div class="collapse-inner">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="label-text text-secondary" for="cedula">Documento de identidad</label>
                                            <div class="d-flex align-items-center">
                                                <select
                                                    @change="updateField('nacionalidad')"
                                                    v-model="$store.state.formRegistroPacienteInterno.nacionalidad"
                                                    ref="nacionalidad"
                                                    class="flex-shrink-1 form-control bg-gray-footer-parodi"
                                                    style="width: fit-content;"
                                                    >
                                                    <option value="V">V</option>
                                                    <option value="E">E</option>
                                                    <option value="P">P</option>
                                                </select>

                                                <div class="input-group">

                                                    <input
                                                        @change="searchCedula"
                                                        ref="cedula"
                                                        v-model="$store.state.formRegistroPacienteInterno.cedula"
                                                        type="number"
                                                        class="ml-1 flex-grow-1 form-control bg-gray-footer-parodi"
                                                    >
                                                    <div class="input-group-prepend">
                                                        <div :class="{'input-group-text p-0 ml-2 border-0 bg-transparent':true,'d-none':!loadingSearchCedula}">
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
                                            <input
                                                @change="updateField('email')"
                                                ref="email"
                                                v-model="$store.state.formRegistroPacienteInterno.email"
                                                type="email"
                                                class="form-control bg-gray-footer-parodi"
                                            >
                                            <small id="sms_email" class="form-text text-danger notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="label-text text-secondary" for="nombre">Nombres</label>
                                            <input
                                                @change="updateField('nombres')"
                                                ref="nombres"
                                                v-model="$store.state.formRegistroPacienteInterno.nombres"
                                                type="nombres"
                                                class="form-control bg-gray-footer-parodi"
                                            >
                                            <small id="helpId1" class="form-text text-muted notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="label-text text-secondary" for="apellido">Apellidos</label>
                                            <input
                                                @change="updateField('apellidos')"
                                                ref="apellidos"
                                                v-model="$store.state.formRegistroPacienteInterno.apellidos"
                                                type="text"
                                                class="form-control bg-gray-footer-parodi"
                                            >
                                            <small id="helpId1" class="form-text text-muted notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="label-text text-secondary" for="genero">Género</label>
                                            <select
                                                @change="updateField('genero')"
                                                ref="genero"
                                                v-model="$store.state.formRegistroPacienteInterno.genero"
                                                type="text"
                                                class="form-control bg-gray-footer-parodi"
                                            >
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
                                                <input
                                                    @change="updateField('fnacimiento')"
                                                    ref="fnacimiento"
                                                    v-model="$store.state.formRegistroPacienteInterno.fnacimiento"
                                                    type="date"
                                                    class="form-control bg-gray-footer-parodi"
                                                >
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2"><i class="fas fa-birthday-cake mr-2"></i>  {{ calcularEdad() }} años</span>
                                                </div>
                                            </div>


                                            <small id="helpId1" class="form-text text-muted notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="label-text text-secondary" for="telefono_movil">Teléfono contacto</label>
                                            <input
                                                id="telefono_movil"
                                                @change="updateField('telefono_movil')"
                                                ref="telefono_movil"

                                                type="number"
                                                class="form-control bg-gray-footer-parodi"
                                                @keyup="vPrimerDigito('telefono_movil')"
                                            >
                                            <small id="help_telefono_movil" class="form-text text-muted notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="label-text text-secondary" for="telefono_hogar">Teléfono secundario</label>
                                            <input
                                                id="telefono_hogar"
                                                @change="updateField('telefono_hogar')"
                                                ref="telefono_hogar"

                                                type="number"
                                                class="form-control bg-gray-footer-parodi"
                                                @keyup="vPrimerDigito('telefono_hogar')"
                                            >
                                            <small id="help_telefono_hogar" class="form-text text-muted notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex flex-column">
                                            <label class="label-text text-secondary" for="imagen">Foto identificación</label>
                                            <div class="d-flex align-items-center">
                                                <img id="imagen_perfil" onerror="this.src='/image/user/foto_perfil/doc_id.svg'" style="width: 80px; height:80px" :src="$store.state.formRegistroPacienteInterno.imagen" class="imagen-perfil" alt="Medic default">
                                                <input type="file" style="height: 44px;" class=" ml-2 form-control bg-gray-footer-parodi" name="imagen" id="imagen" aria-describedby="helpId">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <input class="collapse-open" type="checkbox" id="collapse-2">
                        <label class="collapse-btn h5 text-primary font-weight-bold" for="collapse-2">Dirección</label>
                        <div class="collapse-painel">
                            <div class="collapse-inner">
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label class="label-text text-secondary"  for="">Estado:</label>
                                            <select
                                                @change="updateField('cat_estado_id')"
                                                ref="cat_estado_id"
                                                v-model="$store.state.formRegistroPacienteInterno.cat_estado_id"
                                                type="date"
                                                class="form-control bg-gray-footer-parodi"

                                            >
                                                <option v-for="(item, index) in $store.state.catEstado" :key="index" :value="item.id">{{item.description}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label class="label-text text-secondary"  for="">Municipio:</label>
                                            <select ref="cat_municipio_id" v-model="$store.state.formRegistroPacienteInterno.cat_municipio_id" id="cat_municipio_id" name="cat_municipio_id" class="form-control bg-gray-footer-parodi">
                                                <option v-for="(item, index) in getCatMunicipio" :key="index" :value="item.id">{{item.description}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label class="label-text text-secondary"  for="">Ciudad:</label>
                                            <input ref="fecha_reservacion"  v-model="$store.state.formRegistroPacienteInterno.description" type="text" class="form-control bg-gray-footer-parodi" name="fecha_reservacion" id="fecha_reservacion">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="label-text text-secondary"  for="">Domicilio:</label>
                                            <textarea v-model="$store.state.formRegistroPacienteInterno.domicilio" class="form-control form-control-lg bg-gray-footer-parodi" name="domicilio" id="domicilio" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <input class="collapse-open" checked type="checkbox" id="collapse-3">
                        <label class="collapse-btn h5 text-primary font-weight-bold" for="collapse-3">Traslado</label>
                        <div class="collapse-painel">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="label-text text-secondary"  for="">Fecha de ingreso:</label>
                                        <input ref="ingreso"  type="date" v-model="$store.state.formRegistroPacienteInterno.ingreso" class="form-control bg-gray-footer-parodi">
                                    </div>

                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="label-text text-secondary"  for="">Ubicación Actual:</label>
                                        <input ref="ubicacion_actual" style="background-color: var(--gray) !important;" readonly  type="text" :value="getUbicacionActual" class="form-control bg-gray-footer-parodi" >
                                    </div>

                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="label-text text-secondary"  for="cat_user_ubicacion_id">Nueva Ubicación:</label>
                                        <select @change="updateCatUbicacion('cat_user_ubicacion_id',2)" ref="cat_user_ubicacion_id"  id="cat_user_ubicacion_id" name="cat_user_ubicacion_id" class="form-control bg-gray-footer-parodi">
                                            <option value="245">Sala de Espera (SE)</option>
                                            <option v-for="(item, index) in getCatUbicacionAreas" :key="index" :value="item.id">{{item.description}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div v-if="$store.state.lv2SelectUbicacion" class="col-12">
                                    <div class="form-group">
                                        <select  @change="updateCatUbicacion('cat_user_ubicacion_id_2',3)" ref="cat_user_ubicacion_id_2" class="form-control bg-gray-footer-parodi">
                                            <option value="">Seleccione</option>
                                            <option v-for="(item, index) in getCatUbicacionAreas2" :key="index" :value="item.id">{{item.coments}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div v-if="$store.state.lv3SelectUbicacion" class="col-12">
                                    <div class="form-group">
                                        <select  @change="updateCatUbicacion('cat_user_ubicacion_id_3',4)" ref="cat_user_ubicacion_id_3" class="form-control bg-gray-footer-parodi">
                                            <option value="">Seleccione</option>
                                            <option v-for="(item, index) in getCatUbicacionAreas3" :key="index" :value="item.id">{{item.coments}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div v-if="$store.state.lv4SelectUbicacion" class="col-12">
                                    <div class="form-group">
                                        <select  @change="updateCatUbicacion('cat_user_ubicacion_id_4',5)" ref="cat_user_ubicacion_id_4" class="form-control bg-gray-footer-parodi">
                                            <option value="">Seleccione</option>
                                            <option v-for="(item, index) in getCatUbicacionAreas4" :key="index" :value="item.id">{{item.coments}}</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex-shrink-1  p-1 text-center">
            <button  @click="submitForm" id="submit" class="btn btn-success mt-1">Registrar Paciente</button>
            <button  @click="goToAreaMedico" class="btn btn-primary mt-1">Cancelar</button>
        </div>

    </div>
</template>

<script>
    import { get,is_empty,is_null,is_undefined,post,calcularEdad,telefonoConfig,validarPrimerDigito } from '../../../helpers/customHelpers.js';
    import BtnWidgetCreatePaciente from './BtnWidgetCreatePaciente.vue';
    //import intlTelInput from 'intl-tel-input';
    export default {

        name:"PatientCreate",
        methods: {
            updateField(fieldName){
                let fieldValue = this.$refs[fieldName].value

                    if(fieldName ==="telefono_movil"){
                        fieldValue = this.$store.state.telefonoConfig1.getNumber()
                    }
                    if(fieldName ==="telefono_hogar"){
                        fieldValue = this.$store.state.telefonoConfig2.getNumber()
                    }
                    if(fieldName ==="cat_estado_id"){
                        this.updateMunicipio()
                    }

                    this.$store.commit('updateFormField', {
                        formName:"formRegistroPacienteInterno",
                        fieldName:fieldName,
                        fieldValue:fieldValue,
                    });
            },
            vPrimerDigito(param){
                validarPrimerDigito(param)
            },

            updateCatUbicacionSub(param){
                /* let cat_ubicacion_id = Number(this.$refs[param].value)
                    return  this.$store.state.catUbicacion.filter(item=>item['parent_cat_user_ubicacion_id']===cat_ubicacion_id).sort((a, b) => a.orden - b.orden); */
            },
            updateCatUbicacion(param,nextLevel){

                let cat_ubicacion_id = Number(this.$refs[param].value)

                /*     this.$store.commit('updateFormField', {
                        formName:'formReservacionQuirofano',
                        fieldName:'cat_user_ubicacion_id',
                        fieldValue:cat_ubicacion_id,
                    });

                let subNivel = this.$store.state.catUbicacion.filter(item=>item['parent_cat_user_ubicacion_id']===this.$store.state.formReservacionQuirofano.cat_user_ubicacion_id)
                    this.$store.commit('updateProperty', {
                        fieldName: `catUbicacionTemp${nextLevel}` ,
                        fieldValue:subNivel,
                    });
                    for (let index = nextLevel+1; index <= 4; index++) {
                        this.$store.commit('updateProperty', {
                            fieldName: `catUbicacionTemp${index}` ,
                            fieldValue:[],
                        });
                        this.$store.commit('updateProperty', {
                            fieldName: `lv${index}SelectUbicacion`,
                            fieldValue:false,
                        });
                    }

                    if(nextLevel < 5){
                        let containItems = subNivel.length > 0
                        let result = false;
                            if(containItems){
                                result = true
                            }
                            this.$store.commit('updateProperty', {
                                fieldName: `lv${nextLevel}SelectUbicacion`,
                                fieldValue:result,
                            });
                    }    */


            },
            updateMunicipio(){
                let value = this.$store.state.catMunicipio.find(item=>item['cat_estado_id'] === this.$store.state.formRegistroPacienteInterno.cat_estado_id)

                this.$store.commit('updateFormField', {
                    formName:'formRegistroPacienteInterno',
                    fieldName:'cat_municipio_id',
                    fieldValue:value.id,
                });
            },
            goToAreaMedico:()=>{
                location.href="/medico"
            },
            calcularEdad(){
                return calcularEdad(this.$store.state.formRegistroPacienteInterno.fnacimiento)
            },
            submitForm(){

            },
            async searchCedula(){
                let that = this
                //alert("sss")
                let cedula = this.$store.state.formRegistroPacienteInterno.cedula
                    if (!is_empty(cedula)) {
                        this.$store.commit('updateProperty', {
                            fieldName:'searchCedula',
                            fieldValue:true,
                        });

                        try {

                            let result = await get(location.origin + "/user/profile/getByCedula/"+ cedula)
                                //console.log( Object.values(result).length)
                                if (Object.values(result).length > 0) {
                                    for (const key in result) {
                                        if (Object.hasOwnProperty.call(this.$store.state.formRegistroPacienteInterno, key)) {
                                            this.$store.commit('updateFormField', {
                                                formName:"formRegistroPacienteInterno",
                                                fieldName:key,
                                                fieldValue:result[key],
                                            });
                                            if(key ==="telefono_movil"){
                                                    that.$store.state.telefonoConfig1.setNumber(that.$store.state.formRegistroPacienteInterno.telefono_movil)
                                            }
                                            if(key ==="telefono_hogar"){
                                                    that.$store.state.telefonoConfig2.setNumber(that.$store.state.formRegistroPacienteInterno.telefono_hogar)
                                            }

                                        }
                                    }
                                }else{
                                    this.$store.commit('formRegistroPacienteInterno');
                                    this.$store.commit('updateFormField', {
                                        formName:"formRegistroPacienteInterno",
                                        fieldName:'cedula',
                                        fieldValue:cedula,
                                    });
                                }
                        } catch (error) {
                            this.$store.commit('updateProperty', {
                                fieldName:'searchCedula',
                                fieldValue:false,
                            });
                            //this.resetForm()
                            //console.log(error)
                        }

                    }else{
                        this.$store.commit('updateProperty', {
                            fieldName:'searchCedula',
                            fieldValue:false,
                        });
                        this.$store.commit('formRegistroPacienteInterno');
                    }
                    /* this.$store.commit('updateFormField', {
                        formName:"formReservacionQuirofano",
                        fieldName:'cedula',
                        fieldValue:cedula,
                    }); */
                // Simulación de una carga, podrías usar una función de retardo o una llamada a una API aquí
                setTimeout(() => {
                    this.$store.commit('updateProperty', {
                        fieldName:'searchCedula',
                        fieldValue:false,
                    });
                }, 1000); // Cambiar a
            },
            getTelefonoMovil(){

            },
        },
        computed:{

            getUbicacionActual(){
                let model = this.$store.state.catUbicacion.find(item=>item['id']===this.$store.state.formRegistroPacienteInterno.cat_user_ubicacion_id)
                console.log(model)
                return `${is_undefined(model) ? 'SE' : model['coments']}`
            },//cat_user_ubicacion_id
            getCatUbicacionAreas(){
                return  this.$store.state.catUbicacion.filter(item=>item['parent_cat_user_ubicacion_id']===1).sort((a, b) => a.orden - b.orden);
            },
            getCatUbicacionAreas2(){
                return  this.$store.state.catUbicacionTemp2.sort((a, b) => a.orden - b.orden);
            },
            getCatUbicacionAreas3(){
                return  this.$store.state.catUbicacionTemp3.sort((a, b) => a.orden - b.orden);
            },
            getCatUbicacionAreas4(){
                return  this.$store.state.catUbicacionTemp4.sort((a, b) => a.orden - b.orden);
            },
            getCatMunicipio(){
                return this.$store.state.catMunicipio.filter(item=>item['cat_estado_id'] === this.$store.state.formRegistroPacienteInterno.cat_estado_id)
            },
            loadingSearchCedula(){
                return this.$store.state.searchCedula
            }
        },
        mounted: async function () {
            let that = this
            this.$store.commit('updateProperty', {
                fieldName:'loading',
                fieldValue:false,
            });
            telefonoConfig("#telefono_movil",(iti)=>{
                that.$store.state.telefonoConfig1 = iti
            })
            telefonoConfig("#telefono_hogar",(iti)=>{
                that.$store.state.telefonoConfig2 = iti
            })


        },
    }
</script>

<style lang="scss" scoped>
    .iti {
        width: 100% !important;
    }
    .vh-1{
        height: 92vh;
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
    .collapse-open:checked ~ .collapse-painel {
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
    .collapse-open ~ .collapse-btn:before {
        content: "↓";
        float: right;
    }
    .collapse-open:checked ~ .collapse-btn:before {
        content: "↑";
    }


</style>
