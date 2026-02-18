<template>
    <main class="flex-fill container-fluid d-flex flex-column justify-content-center align-items-center overflow-auto">

        <div class="h3 mb-5 text-white text-shadow text-center">IQX<br>Ambulatorias</div>
        <div class="d-flex">
            <div class="d-flex flex-column">
                <div class="glassmod-effect flex-fill d-flex flex-column justify-content-center align-content-center rounded-pill-1 text-white text-center text-shadow p-2">
                    <div class="total-title text-center">Total IQX<br>Ambulatorias</div>
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="total-icon pc-light-patient-copia-3 text-white text-shadow rotate-in-ver "></i>
                        <div title="Total IQX" class="tooltip-primary display-3 total-counter mr-2">{{ $store.state.solicitudes.filter(x=>[
                            /* 419 */,// Ambulatoria
                            422,// Torre
                           /*  423 */,// MAPM
                            424,// Oftalmologica
                            425 // Especialidades
                            ].includes( Number( x['area_intervencion'] ) )).length }}</div>
                        <!-- <div class="d-none">
                            <div title="Total En Pre-anestesia" class="row_counter_user d-flex flex-row align-items-center">
                                <div  class="mr-1"><i class="fas fa-syringe"></i></div>
                                <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [419,422,423,424,425].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="Pre-anestesia"    ).length }}</div>
                            </div>
                            <div title="Total En Cirugía"  class="row_counter_user d-flex flex-row align-items-center mt-1">
                                <div class="mr-1"><i class="pc-cirugia"></i></div>
                                <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [419,422,423,424,425].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="En quirófano"    ).length }}</div>
                            </div>
                            <div title="Total En Recuperación" class="row_counter_user d-flex flex-row align-items-center mt-1">
                                <div class="mr-1"><i class="fas fa-check"></i></div>
                                <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [419,422,423,424,425].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="En Recuperación"    ).length }}</div>
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>
            <div class="ml-3 d-flex flex-column">
                <div class="glassmod-effect rounded-pill-1 text-white text-center text-shadow p-2 mb-2">
                    <div class="total-title text-center">Torre</div>
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="total-icon pc-light-patient-copia-3 text-white text-shadow rotate-in-ver "></i>
                        <div title="Total IQX" class="tooltip-primary display-3 total-counter mr-2">{{ $store.state.solicitudes.filter(x=>[
                            422,// Torre
                        ].includes( Number( x['area_intervencion'] ) )).length }}</div>
                        <!-- <div class="d-none">
                            <div title="Total En Pre-anestesia" class="row_counter_user d-flex flex-row align-items-center">
                                <div  class="mr-1"><i class="fas fa-syringe"></i></div>
                                <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [422].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="Pre-anestesia"    ).length }}</div>
                            </div>
                            <div title="Total En Cirugía"  class="row_counter_user d-flex flex-row align-items-center mt-1">
                                <div class="mr-1"><i class="pc-cirugia"></i></div>
                                <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [422].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="En quirófano"    ).length }}</div>
                            </div>
                            <div title="Total En Recuperación" class="row_counter_user d-flex flex-row align-items-center mt-1">
                                <div class="mr-1"><i class="fas fa-check"></i></div>
                                <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [422].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="En Recuperación"    ).length }}</div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="d-flex">
                    <div class="d-flex flex-column">
                        <div class="glassmod-effect flex-fill d-flex flex-column justify-content-center align-content-center rounded-pill-1 text-white text-center text-shadow p-2">
                            <div class="total-title text-center">MAPM</div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class="total-icon pc-light-patient-copia-3 text-white text-shadow rotate-in-ver "></i>
                                <div title="Total IQX" class="tooltip-primary display-3 total-counter mr-2">{{ $store.state.solicitudes.filter(x=>[
                                    424,// Oftalmologica
                                    425 // Especialidades
                                ].includes( Number( x['area_intervencion'] ) )).length }}</div>
                                <!-- <div class="d-none">
                                    <div title="Total En Pre-anestesia" class="row_counter_user d-flex flex-row align-items-center">
                                        <div  class="mr-1"><i class="fas fa-syringe"></i></div>
                                        <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [423,424].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="Pre-anestesia"    ).length }}</div>
                                    </div>
                                    <div title="Total En Cirugía"  class="row_counter_user d-flex flex-row align-items-center mt-1">
                                        <div class="mr-1"><i class="pc-cirugia"></i></div>
                                        <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [423,424].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="En quirófano"    ).length }}</div>
                                    </div>
                                    <div title="Total En Recuperación" class="row_counter_user d-flex flex-row align-items-center mt-1">
                                        <div class="mr-1"><i class="fas fa-check"></i></div>
                                        <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [423,424].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="En Recuperación"    ).length }}</div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="ml-3 d-flex flex-column">
                        <div class="glassmod-effect rounded-pill-1 text-white text-center text-shadow p-2 mb-2">
                            <div class="total-title text-center">Oftalmológicas</div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class="total-icon pc-light-patient-copia-3 text-white text-shadow rotate-in-ver "></i>
                                <div title="Total IQX" class="tooltip-primary display-3 total-counter mr-2">{{ $store.state.solicitudes.filter(x=>[
                                    424,// Oftalmologica
                                ].includes( Number( x['area_intervencion'] ) )).length }}</div>
                                <!-- <div class="d-none">
                                    <div title="Total En Pre-anestesia" class="row_counter_user d-flex flex-row align-items-center">
                                        <div  class="mr-1"><i class="fas fa-syringe"></i></div>
                                        <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [424].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="Pre-anestesia"    ).length }}</div>
                                    </div>
                                    <div title="Total En Cirugía"  class="row_counter_user d-flex flex-row align-items-center mt-1">
                                        <div class="mr-1"><i class="pc-cirugia"></i></div>
                                        <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [424].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="En quirófano"    ).length }}</div>
                                    </div>
                                    <div title="Total En Recuperación" class="row_counter_user d-flex flex-row align-items-center mt-1">
                                        <div class="mr-1"><i class="fas fa-check"></i></div>
                                        <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [424].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="En Recuperación"    ).length }}</div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="glassmod-effect rounded-pill-1 text-white text-center text-shadow p-2">
                            <div class="total-title text-center">Especialidades</div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class="total-icon pc-light-patient-copia-3 text-white text-shadow rotate-in-ver "></i>
                                <div class="d-flex justify-content-center align-items-center mx-2">
                                    <div title="Total IQX" class="tooltip-primary display-3 total-counter mr-2">{{ $store.state.solicitudes.filter(x=>[
                                        425 // Especialidades
                                    ].includes( Number( x['area_intervencion'] ) )).length }}</div>
                                    <!-- <div class="d-none">
                                        <div title="Total En Pre-anestesia" class="row_counter_user d-flex flex-row align-items-center">
                                            <div  class="mr-1"><i class="fas fa-syringe"></i></div>
                                            <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [425].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="Pre-anestesia"    ).length }}</div>
                                        </div>
                                        <div title="Total En Cirugía"  class="row_counter_user d-flex flex-row align-items-center mt-1">
                                            <div class="mr-1"><i class="pc-cirugia"></i></div>
                                            <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [425].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="En quirófano"    ).length }}</div>
                                        </div>
                                        <div title="Total En Recuperación" class="row_counter_user d-flex flex-row align-items-center mt-1">
                                            <div class="mr-1"><i class="fas fa-check"></i></div>
                                            <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [425].includes( Number( x['destino'] ) ) && x['fase_ubicacion'] ==="En Recuperación"    ).length }}</div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

</template>

<script>
    export default {

    }
</script>

<style lang="scss" scoped>

</style>
