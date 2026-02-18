<template>
    <div class="fade-in flex-fill container-fluid d-flex flex-column">

        <div class="row">
            <div class="col-6">
                <label class="text-primary" for="fecha">Fecha del Traslado:</label>
                <input ref="fecha_traslado" required type="date" v-model="form.fecha_traslado" name="fecha" class="form-control bg-gray-footer-parodi">
            </div>
            <div class="col-6">
                <label class="text-primary" for="hora">Hora del Traslado:</label>
                <input ref="hora_traslado" required type="time" v-model="form.hora_traslado" name="hora" class="form-control bg-gray-footer-parodi">
            </div>
            <div class="col-6">
                <label class="text-primary" for="origen">Origen del Traslado:</label>
                <input ref="origen_traslado" required type="text" v-model="form.origen_traslado" name="origen" class="form-control bg-gray-footer-parodi">
            </div>
            <div class="col-6">
                <label class="text-primary" for="destino">Destino del Traslado:</label>
                <input ref="destino_traslado" type="text" v-model="form.destino_traslado" name="destino" class="form-control bg-gray-footer-parodi">
            </div>

        </div>

        <div class="flex-fill d-flex flex-column  overflow-auto mb-1">
            <div class="flex-fill mt-1">
                <textarea ref="observacion" required class="form-control bg-gray-footer-parodi " name="observacion" v-model="form.observacion" rows="2" style=" width: 100%;height: 100%;resize: none;" placeholder="Observación"></textarea>
            </div>
        </div>
        <div class="d-flex flex-column flex-md-row w-100">
            <button @click="handleCreate()" id="user_cuest_model_store" class="font-weight-bold btn btn-success w-100 mr-1">Guardar</button>
            <button @click="regresar"  id="user_cuest_model_index" class="font-weight-bold btn btn-primary w-100">Regresar</button>
        </div>
    </div>
</template>

<script>
import { get, is_empty, post, timestamps } from '../../../../../helpers/customHelpers';

    export default {
        name:"CreateTrasladosAmbulancia",
        props:{
            patient_data:Object,
            index:Number,
        },
        data() {
            return {
                form:{
                    fecha_traslado:"",
                    hora_traslado:"",
                    origen_traslado:"",
                    destino_traslado:"",
                    observacion:"",
                }
            }
        },
        methods: {
            validateForm(){
                let formNotValidate = true
                    for (const key in this.form) {
                        if (Object.hasOwnProperty.call(this.form, key)) {
                            let element = this.form[key];

                            let input = this.$refs[key]
                                if (input.required) {
                                    if(is_empty(element) && formNotValidate ){
                                        alert("El campo no puede estar vacio.")
                                        input.focus()
                                        formNotValidate = false
                                        return false
                                    }
                                }
                        }
                    }
                    if (formNotValidate) {
                        return true
                    } else{
                        return false
                    }

            },
            async store(){
                let formdata = new FormData();
                    for (const key in this.form) {
                        if (Object.hasOwnProperty.call(this.form, key)) {
                            let element = this.form[key];
                            formdata.append(key, element )
                        }
                    }
                    formdata.append("user_cuest_episodio_id", this.patient_data.episodio_id)
                    formdata.append("user_id_paciente", this.patient_data.user_id)
                    formdata.append("created_at", timestamps())
                    formdata.append("_token", $("#_token").val())
                    await post( location.origin+"/user/traslado_ambulancia/store", formdata)
                    return true
            },
            async getList() {
                let formdata = new FormData();
                    formdata.append("_token", $("#_token").val())
                let result = await get("/user/traslado_ambulancia/show/" + this.patient_data.user_id)
                    this.$store.commit('updateProperty', {
                        fieldName:'historialTrasladosAmbulanciaPaciente',
                        fieldValue: result,
                    });
            },
            async handleCreate(){
                let that = this
                if ( this.validateForm() ) {
                    let result = await this.store()
                    if (result) {
                        Swal.fire({
                            title: "<strong>Registro completado</strong>",
                            icon: "success",
                            showCloseButton: true,
                            confirmButtonText:'Ok!',
                            timerProgressBar: true,
                        }).then(async () => {
                            that.patient_data.traslado_ambulancia = result
                            that.$store.commit('updateEpisodio', {
                                index: that.index,
                                fieldName:'traslado_ambulancia',
                                fieldValue: that.patient_data,
                            });

                            await that.getList()
                            that.regresar()
                        });
                    }
                }
            },
            regresar() {
                // Emitir un evento personalizado con el nuevo valor
                this.$emit('regresar', true);
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
