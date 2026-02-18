<template>
    <div class="flex-fill p-1 d-flex flex-column overflow-auto">
        <!-- <CintilloModal :index_row="index_row" :dataPaciente="dataPaciente" /> -->
        <div class="flex-fill mt-1 d-flex flex-column justify-content-center rounded overflow-auto">
            <div class="container">
                <h3 class="text-primary">Reingreso del Paciente</h3>
                <div class="row">
                    <div class="col-12 d-flex flex-column">
                        <div class="flex-fill mb-1 p-1 card">
                            <div class="d-flex align-items-center">
                                <img onerror="this.src='/image/system/icono-paciente-blanco.svg';"
                                    :src="dataPaciente.imagen" data-tippy-content="Imagen del paciente" alt="..."
                                    class="tooltip-primary border border-primary rounded-circle m-1 d-block"
                                    style="width: 1.5cm; height: 1.5cm;">
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
                                    <div class="text-secondary">{{ dataPaciente.genero.toUpperCase() }}</div>
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
                            <select @change="updateCatUbicacion('cat_user_ubicacion_id', 'catUbicacionTemp2')"
                                ref="cat_user_ubicacion_id" name="cat_user_ubicacion_id"
                                class="form-control bg-gray-footer-parodi">
                                <option value="245">Sala de Espera (SE)</option>
                                <option v-for="(item, index) in getCatUbicacionAreas" :key="index" :value="item.id">{{
                                    item.description }}</option>
                            </select>
                        </div>
                    </div>
                    <div :class="['col-12', { 'd-none': catUbicacionTemp2.length === 0 }]">
                        <div class="form-group">
                            <select @change="updateCatUbicacion('cat_user_ubicacion_id_2', 'catUbicacionTemp3')"
                                ref="cat_user_ubicacion_id_2" class="form-control bg-gray-footer-parodi">
                                <!-- <option value="">Seleccione</option> -->
                                <option v-for="(item, index) in getCatUbicacionAreas2" :key="index" :value="item.id">{{
                                    item.coments }}</option>
                            </select>
                        </div>
                    </div>
                    <div :class="['col-12', { 'd-none': catUbicacionTemp3.length === 0 }]">
                        <div class="form-group">
                            <select @change="updateCatUbicacion('cat_user_ubicacion_id_3', 'catUbicacionTemp4')"
                                ref="cat_user_ubicacion_id_3" class="form-control bg-gray-footer-parodi">
                                <!-- <option value="">Seleccione</option> -->
                                <option v-for="(item, index) in getCatUbicacionAreas3" :key="index" :value="item.id">{{
                                    item.coments }}</option>
                            </select>
                        </div>
                    </div>
                    <div :class="['col-12', { 'd-none': catUbicacionTemp4.length === 0 }]">
                        <div class="form-group">
                            <select @change="updateCatUbicacion('cat_user_ubicacion_id_4', null)"
                                ref="cat_user_ubicacion_id_4" class="form-control bg-gray-footer-parodi">
                                <!-- <option value="">Seleccione</option> -->
                                <option v-for="(item, index) in getCatUbicacionAreas4" :key="index" :value="item.id">{{
                                    item.coments }}</option>
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
</template>

<script>
import { fechaHoy, timestamps, get, post, calcularEdad } from '../../../helpers/customHelpers';
import CintilloModal from './CintilloModal.vue';
export default {
    name: "FormReingresoPaciente",
    props: {
        index_row: Number,
        dataPaciente: Object
    },
    components: {
        CintilloModal,
    },
    data() {
        return {
            user_id_paciente: null,
            ingreso: fechaHoy(),
            cat_user_ubicacion_id: 245,
            catUbicacionTemp2: [],
            catUbicacionTemp3: [],
            catUbicacionTemp4: [],
        }
    },
    methods: {
        getEdad() {
            return calcularEdad(this.dataPaciente.fnacimiento)
        },
        async submit() {

            let formdata = new FormData();
            formdata.append("cat_user_ubicacion_id", this.cat_user_ubicacion_id)
            formdata.append("ingreso", this.ingreso)
            formdata.append("value", 'Reingreso')
            formdata.append("user_id", this.user_id_paciente)
            formdata.append("user_id_paciente", this.user_id_paciente)
            formdata.append("created_at", timestamps())
            formdata.append("_token", $("#_token").val())

            await post(location.origin + "/user_cuest_ubicacion/storeReingreso", formdata)
            this.getPacientesActivos()
            $("#exampleModal").modal("hide")
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
        async updateCatUbicacion(param) {

            if (param === 'cat_user_ubicacion_id') {
                this.cat_user_ubicacion_id = Number(this.$refs[param].value)
                this['catUbicacionTemp2'] = (await get(location.origin + '/cat_user_ubicacion/show/' + this.cat_user_ubicacion_id)).sort((a, b) => a.orden - b.orden);

                setTimeout(async () => {
                    this.cat_user_ubicacion_id = Number(this.$refs['cat_user_ubicacion_id_2'].value)
                    this['catUbicacionTemp3'] = (await get(location.origin + '/cat_user_ubicacion/show/' + this.cat_user_ubicacion_id)).sort((a, b) => a.orden - b.orden);
                }, 500);

                setTimeout(async () => {
                    this.cat_user_ubicacion_id = Number(this.$refs['cat_user_ubicacion_id_3'].value)
                    this['catUbicacionTemp4'] = (await get(location.origin + '/cat_user_ubicacion/show/' + this.cat_user_ubicacion_id)).sort((a, b) => a.orden - b.orden);

                }, 500);

            }
            if (param === 'cat_user_ubicacion_id_2') {
                this.cat_user_ubicacion_id = Number(this.$refs[param].value)
                this['catUbicacionTemp3'] = (await get(location.origin + '/cat_user_ubicacion/show/' + this.cat_user_ubicacion_id)).sort((a, b) => a.orden - b.orden);
                setTimeout(async () => {
                    this.cat_user_ubicacion_id = Number(this.$refs['cat_user_ubicacion_id_3'].value)
                    this['catUbicacionTemp4'] = (await get(location.origin + '/cat_user_ubicacion/show/' + this.cat_user_ubicacion_id)).sort((a, b) => a.orden - b.orden);
                }, 500);
            }
            if (param === 'cat_user_ubicacion_id_3') {
                this.cat_user_ubicacion_id = Number(this.$refs[param].value)
                this['catUbicacionTemp4'] = (await get(location.origin + '/cat_user_ubicacion/show/' + this.cat_user_ubicacion_id)).sort((a, b) => a.orden - b.orden);

            }


        },
    },
    computed: {

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
    mounted() {
        this.user_id_paciente = this.dataPaciente.user_id
    }
}
</script>

<style scoped></style>
