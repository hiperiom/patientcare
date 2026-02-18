<template>
    <div style="height: 400px;" class="overflow-auto flex-fill glassmod-effect rounded-custom-1 d-flex flex-column">
            <div class="font-weight-bold h5 pl-3 mt-1 text-uppercase">
                Especialidades con más IQX Ejecutadas
            </div>
            <div class=" px-1" >
                <table class=" w-100">
                    <thead>
                        <tr style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
                            <th style="width: 70%;">Especialidad</th>
                            <th class="text-center">Total IXQ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item,index) in dataset" :key="'medicolist_'+index" style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
                            <td>
                                <div class="ml-1 d-flex flex-column" style="line-height: 1.1;">
                                    {{ item.especialidad }}

                                </div>
                            </td>
                            <td class="text-center h4">
                                {{ item.total }}
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
</template>

<script>
export default {
    name: "AppEspecialidadesConMasIQXCompletadas",
    props: {
        dataset: Array,
    },
    mounted() {

    },
}
</script>

<style lang="scss" scoped></style>
