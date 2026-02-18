<template>
    <main class="flex-fill container-fluid d-flex flex-column justify-content-center align-items-center overflow-auto overflow-auto">

        <div class="h3 mb-5 text-white text-shadow text-center">IQX<br>Hospitalización</div>
        <div class="d-flex">

            <div class="d-flex flex-column">
                <div class="glassmod-effect flex-fill d-flex flex-column justify-content-center align-content-center rounded-pill-1 text-white text-center text-shadow p-2">
                    <div class="total-title text-center">Total IQX<br>Hospitalización</div>
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="total-icon pc-light-patient-copia-3 text-white text-shadow rotate-in-ver "></i>
                        <div class="d-flex justify-content-center align-items-center mx-2">
                            <div title="Total IQX" class="tooltip-primary display-3 total-counter mr-2">{{ $store.state.solicitudes.filter(x=>[420,421].includes( Number( x['area_intervencion'] ) )).length }}</div>
                            <div class="d-none">
                                <!--<div title="Total En Pre-anestesia" class="row_counter_user d-flex flex-row align-items-center">
                                    <div  class="mr-1"><i class="fas fa-syringe"></i></div>
                                    <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [420,421].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="Pre-anestesia"    ).length }}</div>
                                </div>
                                 <div title="Total En Cirugía"  class="row_counter_user d-flex flex-row align-items-center mt-1">
                                    <div class="mr-1"><i class="pc-cirugia"></i></div>
                                    <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [418,420,421].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="En quirófano"    ).length }}</div>
                                </div>
                                <div title="Total En Recuperación" class="row_counter_user d-flex flex-row align-items-center mt-1">
                                    <div class="mr-1"><i class="fas fa-check"></i></div>
                                    <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [418,420,421].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="En Recuperación"    ).length }}</div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ml-3 d-flex flex-column">
                <div class="glassmod-effect rounded-pill-1 text-white text-center text-shadow p-2 mb-2">
                    <div class="total-title text-center">Electivas</div>
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="total-icon pc-light-patient-copia-3 text-white text-shadow rotate-in-ver "></i>
                        <div title="Total IQX" class="tooltip-primary display-3 total-counter mr-2">{{ $store.state.solicitudes.filter(x=>[
                            420, //Electiva
                        ].includes( Number( x['area_intervencion'] ) )).length }}</div>
                            <div class="d-none">
                                <!--<div title="Total En Pre-anestesia" class="row_counter_user d-flex flex-row align-items-center">
                                    <div  class="mr-1"><i class="fas fa-syringe"></i></div>
                                    <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [420].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="Pre-anestesia"    ).length }}</div>
                                </div>
                                 <div title="Total En Cirugía"  class="row_counter_user d-flex flex-row align-items-center mt-1">
                                    <div class="mr-1"><i class="pc-cirugia"></i></div>
                                    <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [420].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="En quirófano"    ).length }}</div>
                                </div>
                                <div title="Total En Recuperación" class="row_counter_user d-flex flex-row align-items-center mt-1">
                                    <div class="mr-1"><i class="fas fa-check"></i></div>
                                    <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [420].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="En Recuperación"    ).length }}</div>
                                </div> -->
                            </div>
                    </div>
                </div>
                <div class="glassmod-effect rounded-pill-1 text-white text-center text-shadow p-2">
                    <div class="total-title text-center">Emergencias</div>
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="total-icon pc-light-patient-copia-3 text-white text-shadow rotate-in-ver "></i>
                        <div title="Total IQX" class="tooltip-primary display-3 total-counter mr-2">{{ $store.state.solicitudes.filter(x=>[
                            421, //Emergencia
                        ].includes( Number( x['area_intervencion'] ) )).length }}</div>
                        <div class="d-none">
                            <!--<div title="Total En Pre-anestesia" class="row_counter_user d-flex flex-row align-items-center">
                                <div  class="mr-1"><i class="fas fa-syringe"></i></div>
                                <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [421].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="Pre-anestesia"    ).length }}</div>
                            </div>
                             <div title="Total En Cirugía"  class="row_counter_user d-flex flex-row align-items-center mt-1">
                                <div class="mr-1"><i class="pc-cirugia"></i></div>
                                <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [421].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="En quirófano"    ).length }}</div>
                            </div>
                            <div title="Total En Recuperación" class="row_counter_user d-flex flex-row align-items-center mt-1">
                                <div class="mr-1"><i class="fas fa-check"></i></div>
                                <div class="tooltip-primary border rounded px-1">{{ $store.state.solicitudes.filter(x=> [421].includes( Number( x['area_intervencion'] ) ) && x['fase_ubicacion'] ==="En Recuperación"    ).length }}</div>
                            </div> -->
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
