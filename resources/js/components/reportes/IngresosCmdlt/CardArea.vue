<template>
    <div @click="handleCard()" class="glassmod-effect py-2 mb-1 rounded-pill-1 text-white text-center text-shadow">
        <div class="total-title text-center text-uppercase">{{ title_area }}</div>
        <div class="d-flex align-items-center justify-content-center">
            <i :class="['total-icon rotate-in-ver mb-1',icon]"></i>
            <div class="d-flex justify-content-center align-items-center mx-2">
                <div class="tooltip-primary total-counter mr-2">{{ total_area }}</div>
                <div>
                    <div class="row_counter_user d-flex flex-row align-items-center">
                        <div class="mr-1"><i class="fas fa-user"></i></div>
                        <div class="tooltip-primary border rounded px-1">{{ total_adulto }}</div>
                    </div>
                    <div class="row_counter_user d-flex flex-row align-items-center mt-1">
                        <div class="mr-1"><i class="fas fa-child"></i></div>
                        <div class="tooltip-primary border rounded px-1">{{ total_pediatrico }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:"CardArea",
        props:{
            'icon':{

            },
            'title_area':{

            },
            'total_area':{

            },
            'total_adulto':{

            },
            'total_pediatrico':{

            },
            'paramFuncion':{

            },
            'handleActionCard':{
                type: Function
            }
        },
        methods:{
            handleCard(){
                this.handleActionCard(this.paramFuncion)
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
