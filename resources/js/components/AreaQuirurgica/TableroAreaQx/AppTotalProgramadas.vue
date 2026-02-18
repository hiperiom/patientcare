<template>
    <button
        class="flex-fill d-flex pt-1 mb-1 mb-md-0 line-height-1 shadow-sm flex-column align-items-center justify-content-center btn-glassmod-effect w-100 border-0 rounded-custom-left">
        <div class="font-weight-bold text-uppercase">
            {{ title }}
        </div>
        <div class="d-flex align-items-center">
            <i class="fas fa-hospital h3 mb-0 mr-2"></i>
            <div class="f-size-total">
                {{ item_total }}
            </div>
            <div class="line-height-2 flex-fill ml-1 d-flex flex-column">
                <div class="d-flex align-items-center">
                    <i style="width: 20px;" class="fas fa-user w-icon-user-type"></i>
                    <div>
                        {{ item_total_adulto }} ({{ getPorcentaje(item_total_adulto) }})%
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <i style="width: 20px;" class="fas fa-child w-icon-user-type"></i>
                    <div>
                        {{ item_total_pediatrico }} ({{ getPorcentaje(item_total_pediatrico) }})%
                    </div>
                </div>
            </div>
        </div>
    </button>
</template>

<script>
export default {
    name: "AppTotalProgramadas",
    props: {
        title: {
            type: String,
            default:"Sin Titulo"
        },
        item_total: {
            type: Number,
            default:0
        },
        item_total_adulto: {
            type: Number,
            default:0
        },
        item_total_pediatrico: {
            type: Number,
            default:0
        },
    },
    methods: {
        getPorcentaje(item){
            let result = item * 100 / this.item_total
                result = !Number.isNaN( result )
                    ? result.toFixed(0)
                    : 0
            return result
        },
    },
}
</script>

<style lang="scss" scoped>
.f-size-total {
    font-size: 50px;
}

</style>
