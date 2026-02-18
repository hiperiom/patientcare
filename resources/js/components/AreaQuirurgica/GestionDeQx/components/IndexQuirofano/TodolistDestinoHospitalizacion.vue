<template>
    <div>
        <div v-if="Number(area_intervencion) === 418" class="btn-group">
            <br>

            <button
                v-if="!h_fin"
                :class="['btn-link rounded bg-transparent font-weight-bold border-0']"
                type="button"
                :id="'triggerIdDestino'"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                style="font-size: 1.2rem;"
            >
                <div :class="['text-'+textColor]" >
                   {{ getCurrentArea() }}
                </div>


            </button>
            <div v-else :class="['text-'+textColor, 'text-center font-weight-bold']">
                {{ getCurrentArea() }}
            </div>
            <div @click="dropdownStop" class="dropdown-menu dropdown-menu-right"
                :aria-labelledby="'triggerIdDestino'">

                <div class="dropdown-item">
                    <div class="d-flex flex-column">
                        <!--   @change="handleDestino('destino_' + index2)" -->
                        <select
                            class="form-control bg-gray-footer-parodi mb-1"
                            @change="handleDestino(1)"
                            v-model="value1"
                        >
                            <option value="">Seleccione</option>
                            <option
                                v-for="(ubicacion, indexUbicacion) in selectOptions1"
                                :key="'sol_' + indexUbicacion" :value="ubicacion.id">
                                {{ ubicacion.description }}
                            </option>
                        </select>
                        <select
                            v-if="selectOptions2.length > 0"
                            @change="handleDestino(2)"
                            class="form-control bg-gray-footer-parodi mb-1"
                            v-model="value2"
                        >
                            <option value="">Seleccione</option>
                            <option
                                v-for="(ubicacion, indexUbicacion) in selectOptions2"
                                :key="'sol_' + indexUbicacion" :value="ubicacion.id">
                                {{ ubicacion.description }} | {{ ubicacion.coments }}
                            </option>
                        </select>
                        <select
                            v-if="selectOptions3.length > 0"
                            @change="handleDestino(3)"
                            class="form-control bg-gray-footer-parodi mb-1"
                            v-model="value3"
                        >
                            <option value="">Seleccione</option>
                            <option
                                v-for="(ubicacion, indexUbicacion) in selectOptions3"
                                :key="'sol_' + indexUbicacion" :value="ubicacion.id">
                                {{ ubicacion.description }} | {{ ubicacion.coments }}
                            </option>
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </div>



</template>

<script>
import { is_empty, is_undefined, post } from '../../../../../helpers/customHelpers';


export default {
    props: [
        'destino_id',
        'h_fin',
        'fieldName',
        'reservacion_id',
        'area_intervencion',
        'index',
        'index2',
        'destino',
    ],
    name: "TodoListDestinoHospitalizacion",
    data() {
        return {
            textColor:"secondary",
            selectOptions1: this.$store.state['catUbicacion'].filter(item => ![ 390, 246, 223, 41, 2, 28].includes(item['id']) && item['parent_cat_user_ubicacion_id'] === 1) ,
            selectOptions2:"",
            selectOptions3:"",
            defaultValue:0,
            value1:0,
            value2:0,
            value3:0,

        }
    },

    computed: {

    },
    methods: {
        getCurrentArea(){
            let ubication = this.$store.state['catUbicacion'].find(item => Number(item.id) === Number(this.destino_id) )
            //console.log(ubication);
            if (ubication !== undefined) {
                this.textColor = 'primary'
                return `${ubication.description} | ${ubication.coments}`

            }else{
                this.textColor = 'secondary'
                return 'Seleccionar'
            }
        },
        handleDestino(level){

            if (Number(level) === 1) {
                this.selectOptions2 = this.$store.state['catUbicacion'].filter(item => item.parent_cat_user_ubicacion_id === this.value1 )
                this.selectOptions3 = []
                this.value2=0
                this.value3=0
                if (this.selectOptions2.length ===0) {
                    this.storeDestino(1)
                }
            }
            if (Number(level) === 2) {
                this.selectOptions3 = this.$store.state['catUbicacion'].filter(item => item.parent_cat_user_ubicacion_id === this.value2 )
                this.value3=0
                if (this.selectOptions3.length ===0) {
                    this.storeDestino(2)
                }
            }
            if (Number(level) === 3 ) {
                this.storeDestino(3)
            }

        },
        async storeDestino(level){

                let input_value = null
                    if (level===1) {
                        input_value = this.value1
                    }
                    if (level===2) {
                        input_value = this.value2
                    }
                    if (level===3) {
                        input_value = this.value3
                    }
                let formData = new FormData();
                    formData.append("id",this.reservacion_id)
                    formData.append("field",this.fieldName)
                    formData.append("value",input_value)
                    formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content') )

                let result2 = await post(location.origin + `/areaQuirofano/update`,formData)
                  
                this.$store.commit('updateSolicitudQx2',[this.index,this.index2,this.fieldName,input_value])



                //actualizar en la vista la fecha
                //await this.getSolicitudesQx()

                    Swal.fire({
                        icon: "success",
                        title: "Programación actualizada",
                        text:"Los datos de la solicitud han sido actualizados correctamente.",

                    })


        },
        dropdownStop(e) {
            e.stopPropagation();
            // console.log(`${e.target.textContent} clicado!`);
        },
        childRef() {
            return this.$refs['input_' + this.tagValueText];
        },
        updateFormField(event) {
            this.$store.commit('updateFormField', {
                formName: "formReservacionQuirofano",
                fieldName: event.currentTarget.name,
                fieldValue: event.currentTarget.value,
            });
        },

    },
    mounted() {

    }
}
</script>

<style lang="scss" scoped>
.btn-link:hover {
    background-color: rgb(236, 236, 236);
}

.list-group-item-empty {
    position: relative;
    display: block;
    background-color: transparent;
    /*border: 2px dashed rgba(0, 0, 0, 0.125);*/
    text-align: center;
    color: var(--secondary);
    border-radius: 0.25rem;
}
</style>
