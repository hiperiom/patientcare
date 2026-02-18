<template>
    <div style="height: 400px;" class="overflow-auto flex-fill glassmod-effect rounded-custom-1 d-flex flex-column">
        <div class="font-weight-bold h5 pl-3 mt-1 text-uppercase">
            Anestesiologos con más IQX Ejecutadas
        </div>
        <div class="px-1">
            <table class=" w-100">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
                        <th style="width: 70%;">Anestesiologo</th>
                        <th class="text-center">Total IXQ</th>
                    </tr>
                </thead>
                <tbody v-if="dataset.length > 0">
                    <tr v-for="(item, index) in dataset" :key="'medicolist_' + index"
                        style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
                        <td>
                            <div class="d-flex align-items-center my-1">
                                <img onerror="this.src='https://placehold.co/600x600'" alt=""
                                    style="width: 30px; height: 30px; border-radius: 50px;" :src="item.imagen">
                                <div class="ml-1 d-flex flex-column" style="line-height: 1.1;">
                                    <b>{{ item.name_medico }}</b>
                                    <!-- <div>{{ item.especialidad }}</div> -->
                                </div>
                            </div>
                        </td>
                        <td class="text-center h4">
                            {{ item.cirugias_culminadas }}
                        </td>
                    </tr>

                </tbody>
                <tbody v-else>
                    <tr style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
                        <td colspan="2">
                            No se encontraron médicos en este rango.
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
export default {
    name: "AppAnestesiologosConMasIQXCompletadas",
    props: {
        dataset: Array,
    },
    mounted() {

    },
}
</script>

<style lang="scss" scoped></style>
