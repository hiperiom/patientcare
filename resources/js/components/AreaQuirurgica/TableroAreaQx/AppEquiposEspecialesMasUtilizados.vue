<template>
    <div style="height: 400px;" class="overflow-auto flex-fill glassmod-effect rounded-custom-1 d-flex flex-column">
        <div class="font-weight-bold h5 pl-3 mt-1 text-uppercase">
            Recursos Especiales Más Utilizados
        </div>
        <div class="px-1">
            <table class=" w-100">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
                        <th class="text-uppercase">Equipo Especial EN IQX</th>

                        <th class="text-uppercase text-center">Total IQX</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item,index) in dataset" :key="index">
                        <td class="text-uppercase">{{ item.equipo_especial }}</td>
                        <td class="text-uppercase text-center">{{ item.cantidad }}</td>

                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
    import { fechaCustom2,horaAMPM } from "../../../helpers/customHelpers.js";
    export default {
        name:"AppEquiposEspecialesMasUtilizados",
        props: {
            dataset: Array,
        },
        methods: {
            getFechaCustom2(fecha) {
                return fechaCustom2(fecha)
            },
            getHoraIQX(fecha){
                let tempFecha = ( fecha.split(" ") )[1]
                return tempFecha
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
