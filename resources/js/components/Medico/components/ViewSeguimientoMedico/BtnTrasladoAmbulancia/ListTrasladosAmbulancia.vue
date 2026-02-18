<template>
    <div class="fade-in flex-fill container-fluid d-flex flex-column">
        <div class="flex-fill">
            <table class="table table-bordered mb-3">
                <tbody>
                    <tr>
                        <th class="text-primary text-center">Fecha</th>
                        <th class="text-primary text-center">Hora</th>
                        <th class="text-primary text-center">Origen</th>
                        <th class="text-primary text-center">Destino</th>
                        <th class="text-primary text-center">Observación</th>
                    </tr>
                </tbody>

                <tbody v-if="$store.state.historialTrasladosAmbulanciaPaciente.length > 0">
                    <tr v-for="(item,index) in $store.state.historialTrasladosAmbulanciaPaciente" :key="'tpa_'+index">
                        <td>{{ getFechaTraslado(item)['fecha'] }}</td>
                        <td>{{ getFechaTraslado(item)['hora'] }}</td>
                        <td>{{ item['origen_traslado'] }}</td>
                        <td>{{ item['destino_traslado'] }}</td>
                        <td>{{ item['observacion'] }}</td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr >
                        <td colspan="5" class="text-center text-primary">No posee traslados</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <button id="regresar" class="font-weight-bold btn btn-primary w-100 mb-1" @click="closeModal()">
                Cerrar
            </button>
        </div>
    </div>
</template>

<script>
import { meses } from '../../../../../helpers/customHelpers';

export default {
    name: "ListTrasladosAmbulancia",
    data() {
        return {
            idModal: "#modal-trasladosAmbulancia",
            items: [],
        }
    },
    props: {
        patient_data: Object,
        index: Number,
    },
    methods: {
        getFechaTraslado(x){
            let f = null;

            let fecha_traslado = (x['fecha_traslado'].split(" "))[0]

                f =new Date(fecha_traslado);
                return {
                    'fecha':  f.getDate() + " de " + meses(f.getMonth()) + " "+ f.getFullYear(),
                    'hora': (x['fecha_traslado'].split(" "))[1]
                }
        },
        closeModal() {
            this.$store.commit('updateDinamicComponent', {
                is_dismounted: true,
                customComponent: null,
                patient_data: null,
                index: null
            });
            $(this.idModal).modal("hide")
        }
    },
    beforeDestroy() {
    },
    mounted() {
    },
}
</script>

<style lang="scss" scoped></style>
