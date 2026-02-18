<template>
    <div class="mb-1 rounded-pill-1 text-white text-center text-shadow">
        <ul class="list-group">
            <li @click="handleCard('uti_adulto')" class=" glassmod-effect d-flex align-items-center rounded-pill-1 mb-1">
                <div class="mx-2 flex-fill text-left">
                    UTI Adulto
                </div>
                <h1 class="mb-0">
                    {{ dataset.uti_adulto}}
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
            <li @click="handleCard('uti_pediatrico')" class=" glassmod-effect d-flex align-items-center rounded-pill-1 mb-1">
                <div class="mx-2 flex-fill text-left">
                    UTI Pediátrica
                </div>
                <h1 class="mb-0">
                    {{ dataset.uti_pediatrica}}
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
            <li @click="handleCard('uti_utin')" class=" glassmod-effect d-flex align-items-center rounded-pill-1 mb-1">
                <div class="mx-2 flex-fill text-left">
                    UTIN
                </div>
                <h1 class="mb-0">
                    {{ dataset.utin}}
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
        name:"CardAreaListUTI",
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
