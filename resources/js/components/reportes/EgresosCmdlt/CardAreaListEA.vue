<template>
    <div class="mb-1 rounded-pill-1 text-white text-center text-shadow">
        <ul class="list-group">
            <li @click="handleCard('emergencia_adulto_a','Hospitalización')" class=" glassmod-effect d-flex align-items-center rounded-pill-1 mb-1">
                <div class="mx-2 flex-fill text-left">
                    EA Triaje A
                </div>
                <h1 class="mb-0">
                    {{ dataset.triaje_a }}
                </h1>
                <div class="mx-2 d-flex flex-column justify-content-center" style="line-height: 1rem;">
                    <div class="mb-1 d-flex align-items-center">
                        <div class="mr-1" style="width: 15px;"><i class="fas fa-user"></i></div>
                        <div class="border rounded px-1">00</div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="mr-1" style="width: 15px;"><i class="fas fa-child"></i></div>
                        <div class="border rounded px-1">00</div>
                    </div>
                </div>
            </li>
            <li @click="handleCard('emergencia_adulto_b','Hospitalización')" class=" glassmod-effect d-flex align-items-center rounded-pill-1 mb-1">
                <div class="mx-2 flex-fill text-left">
                    EA Triaje B
                </div>
                <h1 class="mb-0">
                    {{dataset.triaje_b}}
                </h1>
                <div class="mx-2 d-flex flex-column justify-content-center" style="line-height: 1rem;">
                    <div class="mb-1 d-flex align-items-center">
                        <div class="mr-1" style="width: 15px;"><i class="fas fa-user"></i></div>
                        <div class="border rounded px-1">00</div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="mr-1" style="width: 15px;"><i class="fas fa-child"></i></div>
                        <div class="border rounded px-1">00</div>
                    </div>
                </div>
            </li>
            <li @click="handleCard('emergencia_adulto_observacion','Hospitalización')" class=" glassmod-effect d-flex align-items-center rounded-pill-1 mb-1">
                <div class="mx-2 flex-fill text-left">
                    EA Observación
                </div>
                <h1 class="mb-0">
                    {{dataset.observacion}}
                </h1>
                <div class="mx-2 d-flex flex-column justify-content-center" style="line-height: 1rem;">
                    <div class="mb-1 d-flex align-items-center">
                        <div class="mr-1" style="width: 15px;"><i class="fas fa-user"></i></div>
                        <div class="border rounded px-1">00</div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="mr-1" style="width: 15px;"><i class="fas fa-child"></i></div>
                        <div class="border rounded px-1">00</div>
                    </div>
                </div>
            </li>
            <li @click="handleCard('emergencia_adulto_traumashock','Hospitalización')" class=" glassmod-effect d-flex align-items-center rounded-pill-1 mb-1">
                <div class="mx-2 flex-fill text-left">
                    EA Traumashock
                </div>
                <h1 class="mb-0">
                    {{dataset.traumashock}}
                </h1>
                <div class="mx-2 d-flex flex-column justify-content-center" style="line-height: 1rem;">
                    <div class="mb-1 d-flex align-items-center">
                        <div class="mr-1" style="width: 15px;"><i class="fas fa-user"></i></div>
                        <div class="border rounded px-1">00</div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="mr-1" style="width: 15px;"><i class="fas fa-child"></i></div>
                        <div class="border rounded px-1">00</div>
                    </div>
                </div>
            </li>



        </ul>
    </div>
</template>

<script>
    export default {
        name:"CardAreaListEA",
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
            },
            'dataset':{
                type: Object
            },
        },
        methods:{
            handleCard(param){
                this.handleActionCard(param)
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
