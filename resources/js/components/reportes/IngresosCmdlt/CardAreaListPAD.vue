<template>
    <div class="mb-1 rounded-pill-1 text-white text-center text-shadow">
        <ul class="list-group">
            <li  @click="handleCard('pad_emergencia_adulto')" class=" glassmod-effect d-flex align-items-center rounded-pill-1 mb-1">
                <div class="mx-2 flex-fill text-left">
                    Emergencia Adulto
                </div>
                <h1 class="mb-0">
                    {{ dataset.emergencia_adulto }}
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
            <li  @click="handleCard('pad_emergencia_pediatrico')" class=" glassmod-effect d-flex align-items-center rounded-pill-1 mb-1">
                <div class="mx-2 flex-fill text-left">
                    Emergencia Pediátrica
                </div>
                <h1 class="mb-0">
                    {{dataset.emergencia_pediatrica}}
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
            <li  @click="handleCard('pad_postquirurgico_ambulatorio')" class=" glassmod-effect d-flex align-items-center rounded-pill-1 mb-1">
                <div class="mx-2 flex-fill text-left">
                    PostQx Ambulatorio
                </div>
                <h1 class="mb-0">
                    {{ dataset.postqx_ambulatorio }}
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
            <li @click="handleCard('pad_postquirurgico_hospitalizacion')" class=" glassmod-effect d-flex align-items-center rounded-pill-1 mb-1">
                <div class="mx-2 flex-fill text-left">
                    PostQx Hospitalización
                </div>
                <h1 class="mb-0">
                   {{ dataset.postqx_hospitalizacion }}
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
            <li @click="handleCard('pad_medico_total')" class=" glassmod-effect d-flex align-items-center rounded-pill-1 mb-1">
                <div class="mx-2 flex-fill text-left">
                    Médico
                </div>
                <h1 class="mb-0">
                    {{ dataset.medico }}
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
        name:"CardAreaListPAD",
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
