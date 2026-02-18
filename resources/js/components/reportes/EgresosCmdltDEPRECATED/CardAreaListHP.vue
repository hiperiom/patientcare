<template>
    <div class="mb-1 rounded-pill-1 text-white text-center text-shadow">
        <ul class="list-group">
            <li @click="handleCard('hospitalizacion_hp2','Hospitalización')" class=" glassmod-effect d-flex align-items-center rounded-pill-1 mb-1">
                <div class="mx-2 flex-fill text-left">
                    HP2
                </div>
                <h1 class="mb-0">
                    {{dataset.piso_2}}
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
            <li @click="handleCard('hospitalizacion_hp3','Hospitalización')" class=" glassmod-effect d-flex align-items-center rounded-pill-1 mb-1">
                <div class="mx-2 flex-fill text-left">
                    HP3
                </div>
                <h1 class="mb-0">
                    {{dataset.piso_3}}
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
            <li @click="handleCard('hospitalizacion_hp4','Hospitalización')" class=" glassmod-effect d-flex align-items-center rounded-pill-1 mb-1">
                <div class="mx-2 flex-fill text-left">
                    HP4
                </div>
                <h1 class="mb-0">
                    {{dataset.piso_4}}
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
            <li @click="handleCard('hospitalizacion_hp5','Hospitalización')" class=" glassmod-effect d-flex align-items-center rounded-pill-1 mb-1">
                <div class="mx-2 flex-fill text-left">
                    HP5
                </div>
                <h1 class="mb-0">
                    {{dataset.piso_5}}
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
            <li @click="handleCard('hospitalizacion_hp6','Hospitalización')" class=" glassmod-effect d-flex align-items-center rounded-pill-1 mb-1">
                <div class="mx-2 flex-fill text-left">
                    HP6
                </div>
                <h1 class="mb-0">
                    {{dataset.piso_6}}
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
            <li @click="handleCard('hospitalizacion_hcep','Hospitalización')" class=" glassmod-effect d-flex align-items-center rounded-pill-1 mb-1">
                <div class="mx-2 flex-fill text-left">
                    HCEP
                </div>
                <h1 class="mb-0">
                    {{dataset.hcep}}
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
        name:"CardAreaListHP",
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
