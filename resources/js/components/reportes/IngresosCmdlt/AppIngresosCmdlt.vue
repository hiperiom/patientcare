<template>
    <div class="d-flex flex-column overflow-auto h-100">
        <div v-if="searchigResults" class="loading">
            <div class="text-primary d-flex justify-content-center align-items-center text-center">
                <div class="mr-1">Por favor espere un momento...</div>
                <div class="spinner-border m-5" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <nav class="d-flex align-items-center bg-transparent rounded-pill m-1">
            <div class="col col-sm-4 d-none d-sm-block">
                <i class="pc-fa-patientcare-logo text-white h3 mb-0"></i>
            </div>
            <div class="col-7 col-sm-4 h2 text-center text-uppercase text-white">
                CENSO DIARIO
            </div>
            <div class="col-5 col-sm-4 text-right">
                <img class="img-logo m-1"
                    src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT">
            </div>
        </nav>

        <div class="container-fluid pb-1">
            <div class="row justify-content-center">
                <!-- <div class="col-12 text-center h3 text-white text-uppercase">
                    {{ currentDate() }}
                </div> -->
                <div class="col-6 col-md-6 col-lg-4 col-xl-2 d-flex flex-column flex-sm-row align-items-center">
                    <div class="mr-1 text-white">Desde:</div>
                    <input v-model="desde" type="date" name="desde" id="desde" class="form-control-custom-1">
                </div>
                <div class="col-6 col-md-6 col-lg-4 col-xl-2 d-flex flex-column flex-sm-row align-items-center">
                    <div class="mr-1 text-white">
                        Hasta:
                    </div>
                    <input v-model="hasta" type="date" name="hasta" id="hasta" class="form-control-custom-1">
                </div>
                <div class="col-12 col-md-6 col-lg-2 col-xl-1 mt-1 mt-lg-0">
                    <button @click="getNewData()" class="btn btn-success w-100">Consultar</button>
                </div>
            </div>
        </div>

        <!-- INICIO -->
        <div :class="['flex-fill container-fluid p- d-flex flex-column overflow-auto pb-5',{'justify-content-center':!level1Open},{'justify-content-start':level1Open}]">
            <div id="level_1" class="row justify-content-center align-items-start">
                <div class="col-12 col-sm col-md flex-column ">
                    <div class="mt-1 d-flex justify-content-end">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="d-flex">
                                <button  @click="handleLevel1()"  data-toggle="collapse" data-target="#collapseCMDLT" aria-expanded="false"
                                    aria-controls="collapseCMDLT"
                                    class="d-flex shadow-sm flex-column align-items-center justify-content-center glassmod-effect group w-100 border-0 group rounded-custom-left">
                                    <b class="text-uppercase">CMDLT</b>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-hospital h3 mb-0 mr-2"></i>
                                        <div class="f-size-total">{{ datos.cmdlt.total }}</div>
                                        <div class="flex-fill ml-1 d-flex flex-column">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-user w-icon-user-type"></i>
                                                <div>{{ datos.cmdlt.adulto }}</div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-child w-icon-user-type"></i>
                                                <div>{{ datos.cmdlt.pediatrico }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                                <button @click="getNewDataPaciente('cmdlt')" type="button" class="glassmod-effect group border-0 rounded-custom-right"><i class="pc-paciente h5 mb-0"></i></button>
                            </div>
                        </div>
                    </div>
                    <div ref="collapseCMDLT" id="collapseCMDLT" class="collapse col">
                        <div class="container-fluid p-0">
                            <div class="row justify-content-center align-items-start">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                    <div class="d-flex">
                                        <button data-toggle="collapse" data-target="#collapseEMERGENCIA" aria-expanded="false"
                                            aria-controls="collapseEMERGENCIA"
                                            class="mt-1 d-flex shadow-sm flex-column align-items-center justify-content-center glassmod-effect group w-100 border-0 group rounded-custom-left">
                                            <b class="text-uppercase">EMERGENCIA</b>
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-hospital h3 mb-0 mr-2"></i>
                                                <div class="f-size-total">{{ datos.emergencia.total }}</div>
                                                <div class="flex-fill ml-1 d-flex flex-column">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-user w-icon-user-type"></i>
                                                        <div>{{ datos.emergencia_adulto.total }}</div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-child w-icon-user-type"></i>
                                                        <div>{{ datos.emergencia_pediatrica.total }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                        <button @click="getNewDataPaciente('emergencia')" type="button" class="mt-1 glassmod-effect group border-0 rounded-custom-right"><i class="pc-paciente h5 mb-0"></i></button>
                                    </div>
                                    <div id="collapseEMERGENCIA" class="collapse mt-1">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-12">
                                                <div class="d-flex">
                                                    <button
                                                        data-toggle="collapse"
                                                        data-target="#collapseEA"
                                                        aria-expanded="false"
                                                        aria-controls="collapseEA"
                                                        class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom-left">
                                                        <b class="flex-fill text-left text-uppercase">
                                                            E. Adulto
                                                        </b>
                                                        <h1 class="mb-0">{{ datos.emergencia_adulto.total }}</h1>
                                                    </button>
                                                    <button @click="getNewDataPaciente('emergencia_adulto')" type="button" class="glassmod-effect group border-0 mb-1 rounded-custom-right"><i class="pc-paciente h5 mb-0"></i></button>
                                                </div>
                                                <div id="collapseEA" class="collapse">

                                                    <button
                                                        @click="getNewDataPaciente('emergencia_adulto_triaje_a')"
                                                        class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                                        <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                            EA Triaje A
                                                        </b>
                                                        <h1 class="mb-0">{{ datos.emergencia_adulto.a }}</h1>
                                                    </button>
                                                    <button
                                                        @click="getNewDataPaciente('emergencia_adulto_triaje_b')"
                                                        class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                                        <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                            EA Triaje B
                                                        </b>
                                                        <h1 class="mb-0">{{ datos.emergencia_adulto.b }}</h1>
                                                    </button>
                                                    <button
                                                        @click="getNewDataPaciente('emergencia_adulto_observacion')"
                                                        class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                                        <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                            EA Observación
                                                        </b>
                                                        <h1 class="mb-0">{{ datos.emergencia_adulto.observacion }}</h1>
                                                    </button>
                                                    <button
                                                        @click="getNewDataPaciente('emergencia_adulto_traumashock')"
                                                        class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                                        <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                            EA Traumashock
                                                        </b>
                                                        <h1 class="mb-0">{{ datos.emergencia_adulto.traumashock }}</h1>
                                                    </button>

                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="d-flex">
                                                    <button data-toggle="collapse" data-target="#collapseEP"
                                                        aria-expanded="false" aria-controls="collapseEP"
                                                        class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom-left">
                                                        <b class="flex-fill text-left text-uppercase">
                                                            E. Pediátrica
                                                        </b>
                                                        <h1 class="mb-0">{{ datos.emergencia_pediatrica.total }}</h1>
                                                    </button>
                                                    <button @click="getNewDataPaciente('emergencia_pediatrico')" type="button" class="glassmod-effect group border-0 mb-1 rounded-custom-right"><i class="pc-paciente h5 mb-0"></i></button>
                                                </div>
                                                <div id="collapseEP" class="collapse">
                                                    <button
                                                        @click="getNewDataPaciente('emergencia_pediatrico_triaje_a')"
                                                        class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                                        <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                            EP Triaje A
                                                        </b>
                                                        <h1 class="mb-0">{{ datos.emergencia_pediatrica.a }}</h1>
                                                    </button>
                                                    <button
                                                        @click="getNewDataPaciente('emergencia_pediatrico_triaje_b')"
                                                        class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                                        <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                            EP Triaje B
                                                        </b>
                                                        <h1 class="mb-0">{{ datos.emergencia_pediatrica.b }}</h1>
                                                    </button>
                                                    <button
                                                        @click="getNewDataPaciente('emergencia_pediatrico_observacion')"
                                                        class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                                        <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                            EP Observación
                                                        </b>
                                                        <h1 class="mb-0">{{ datos.emergencia_pediatrica.observacion }}</h1>
                                                    </button>
                                                    <button
                                                        @click="getNewDataPaciente('emergencia_pediatrico_traumashock')"
                                                        class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                                        <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                            EP Traumashock
                                                        </b>
                                                        <h1 class="mb-0">{{ datos.emergencia_pediatrica.traumashock }}</h1>
                                                    </button>
                                                    <button
                                                    @click="getNewDataPaciente('emergencia_pediatrico_nebulizacion')"
                                                        class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                                        <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                            EP Nebulización
                                                        </b>
                                                        <h1 class="mb-0">{{ datos.emergencia_pediatrica.nebulizacion }}</h1>
                                                    </button>
                                                    <button
                                                        @click="getNewDataPaciente('emergencia_pediatrico_hcep')"
                                                        class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom-left">
                                                        <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                            EP Corta Estancia
                                                        </b>
                                                        <h1 class="mb-0">{{ datos.emergencia_pediatrica.hcep }}</h1>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                    <div class="d-flex">
                                        <button data-toggle="collapse" data-target="#collapseHOSPITALIZACION"
                                            aria-expanded="false" aria-controls="collapseHOSPITALIZACION"
                                            class="mt-1 d-flex shadow-sm flex-column align-items-center justify-content-center glassmod-effect group w-100 border-0 rounded-custom-left">
                                            <b class="text-uppercase">HOSPITALIZACIÓN</b>
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-hospital h3 mb-0 mr-2"></i>
                                                <div class="f-size-total">{{ datos.hospitalizacion.total }}</div>
                                                <div class="flex-fill ml-1 d-flex flex-column">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-user w-icon-user-type"></i>
                                                        <div>{{ datos.hospitalizacion.adulto }}</div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-child w-icon-user-type"></i>
                                                        <div>{{ datos.hospitalizacion.pediatrico }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                        <button @click="getNewDataPaciente('hospitalizacion')" type="button" class="mt-1 glassmod-effect group border-0 rounded-custom-right"><i class="pc-paciente h5 mb-0"></i></button>
                                    </div>
                                    <div id="collapseHOSPITALIZACION" class="collapse mt-1">
                                        <div class="d-flex">
                                            <button
                                                data-toggle="collapse"
                                                data-target="#collapseHP2SUB"
                                                aria-expanded="false"
                                                aria-controls="collapseHP2SUB"
                                                class="glassmod-effect group w-100 border-0 d-flex pl-3 mb-1 align-items-center rounded-custom-left">
                                                <b class="flex-fill text-left text-uppercase">
                                                    HP2
                                                </b>
                                                <h1 class="mb-0">{{ datos.hospitalizacion.piso_2 }}</h1>
                                                <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                    <div class="mb-1 d-flex align-items-center">
                                                        <div class="mr-1" style="width: 15px;">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                        <div class="rounded px-1">{{ datos.hospitalizacion.piso_2_adulto }}</div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="mr-1" style="width: 15px;">
                                                            <i class="fas fa-child"></i>
                                                        </div>
                                                        <div class="rounded px-1">{{ datos.hospitalizacion.piso_2_pediatrico }}</div>
                                                    </div>
                                                </div>
                                            </button>
                                            <button  @click="getNewDataPaciente('hospitalizacion_piso2')" type="button" class="glassmod-effect group border-0 mb-1 rounded-custom-right"><i class="pc-paciente h5 mb-0"></i></button>
                                        </div>
                                        <div id="collapseHP2SUB" class="collapse rounded-custom" style="list-style:none">
                                            <div class="d-flex flex-column">
                                                <button
                                                    @click="getNewDataPaciente('hospitalizacion_piso2_a')"
                                                    class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                                    <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                        HP2 A
                                                    </b>
                                                    <h1 class="mb-0">{{ datos.hospitalizacion.piso_2A }}</h1>
                                                    <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                        <div class="mb-1 d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-user"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.hospitalizacion.piso_2A_adulto }}</div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-child"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.hospitalizacion.piso_2A_pediatrico }}</div>
                                                        </div>
                                                    </div>
                                                </button>
                                                <button
                                                    @click="getNewDataPaciente('hospitalizacion_piso2_b')"
                                                    class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom-left">
                                                    <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                        HP2 B
                                                    </b>
                                                    <h1 class="mb-0">{{ datos.hospitalizacion.piso_2B }}</h1>
                                                    <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                        <div class="mb-1 d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-user"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.hospitalizacion.piso_2B_adulto }}</div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-child"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.hospitalizacion.piso_2B_pediatrico }}</div>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <button
                                                data-toggle="collapse"
                                                data-target="#collapseHP3SUB"
                                                aria-expanded="false"
                                                aria-controls="collapseHP3SUB"
                                                class="glassmod-effect group w-100 border-0 d-flex pl-3 mb-1 align-items-center rounded-custom-left">
                                                <b class="flex-fill text-left text-uppercase">
                                                    HP3
                                                </b>
                                                <h1 class="mb-0">{{ datos.hospitalizacion.piso_3 }}</h1>
                                                <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                    <div class="mb-1 d-flex align-items-center">
                                                        <div class="mr-1" style="width: 15px;">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                        <div class="rounded px-1">{{ datos.hospitalizacion.piso_3_adulto }}</div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="mr-1" style="width: 15px;">
                                                            <i class="fas fa-child"></i>
                                                        </div>
                                                        <div class="rounded px-1">{{ datos.hospitalizacion.piso_3_pediatrico }}</div>
                                                    </div>
                                                </div>
                                            </button>
                                            <button @click="getNewDataPaciente('hospitalizacion_piso3')" type="button" class="glassmod-effect group border-0 mb-1 rounded-custom-right"><i class="pc-paciente h5 mb-0"></i></button>
                                        </div>
                                        <div id="collapseHP3SUB" class="collapse rounded-custom" style="list-style:none">
                                            <div class="d-flex flex-column">
                                                <button
                                                    @click="getNewDataPaciente('hospitalizacion_piso3_a')"
                                                    class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                                    <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                        HP3 A
                                                    </b>
                                                    <h1 class="mb-0">{{ datos.hospitalizacion.piso_3A }}</h1>
                                                    <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                        <div class="mb-1 d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-user"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.hospitalizacion.piso_3A_adulto }}</div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-child"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.hospitalizacion.piso_3A_pediatrico }}</div>
                                                        </div>
                                                    </div>
                                                </button>
                                                <button
                                                    @click="getNewDataPaciente('hospitalizacion_piso3_b')"
                                                    class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                                    <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                        HP3 B
                                                    </b>
                                                    <h1 class="mb-0">{{ datos.hospitalizacion.piso_3B }}</h1>
                                                    <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                        <div class="mb-1 d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-user"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.hospitalizacion.piso_3B_adulto }}</div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-child"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.hospitalizacion.piso_3B_pediatrico }}</div>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <button
                                                data-toggle="collapse"
                                                data-target="#collapseHP4SUB"
                                                aria-expanded="false"
                                                aria-controls="collapseHP4SUB"
                                                class="glassmod-effect group w-100 border-0 d-flex pl-3 mb-1 align-items-center rounded-custom-left">
                                                <b class="flex-fill text-left text-uppercase">
                                                    HP4
                                                </b>
                                                <h1 class="mb-0">{{ datos.hospitalizacion.piso_4 }}</h1>
                                                <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                    <div class="mb-1 d-flex align-items-center">
                                                        <div class="mr-1" style="width: 15px;">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                        <div class="rounded px-1">{{ datos.hospitalizacion.piso_4_adulto }}</div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="mr-1" style="width: 15px;">
                                                            <i class="fas fa-child"></i>
                                                        </div>
                                                        <div class="rounded px-1">{{ datos.hospitalizacion.piso_4_pediatrico }}</div>
                                                    </div>
                                                </div>
                                            </button>
                                            <button @click="getNewDataPaciente('hospitalizacion_piso4')" type="button" class="glassmod-effect group border-0 mb-1 rounded-custom-right"><i class="pc-paciente h5 mb-0"></i></button>
                                        </div>
                                        <div id="collapseHP4SUB" class="collapse rounded-custom" style="list-style:none">
                                            <div class="d-flex flex-column">
                                                <button
                                                    @click="getNewDataPaciente('hospitalizacion_piso4_a')"
                                                    class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                                    <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                        HP4 A
                                                    </b>
                                                    <h1 class="mb-0">{{ datos.hospitalizacion.piso_4A }}</h1>
                                                    <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                        <div class="mb-1 d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-user"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.hospitalizacion.piso_4A_adulto }}</div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-child"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.hospitalizacion.piso_4A_pediatrico }}</div>
                                                        </div>
                                                    </div>
                                                </button>
                                                <button
                                                    @click="getNewDataPaciente('hospitalizacion_piso4_b')"
                                                    class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                                    <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                        HP4 B
                                                    </b>
                                                    <h1 class="mb-0">{{ datos.hospitalizacion.piso_4B }}</h1>
                                                    <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                        <div class="mb-1 d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-user"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.hospitalizacion.piso_4B_adulto }}</div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-child"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.hospitalizacion.piso_4B_pediatrico }}</div>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <button
                                                data-toggle="collapse"
                                                data-target="#collapseHP5SUB"
                                                aria-expanded="false"
                                                aria-controls="collapseHP5SUB"
                                                class="glassmod-effect group w-100 border-0 d-flex pl-3 mb-1 align-items-center rounded-custom-left">
                                                <b class="flex-fill text-left text-uppercase">
                                                    HP5
                                                </b>
                                                <h1 class="mb-0">{{ datos.hospitalizacion.piso_5 }}</h1>
                                                <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                    <div class="mb-1 d-flex align-items-center">
                                                        <div class="mr-1" style="width: 15px;">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                        <div class="rounded px-1">{{ datos.hospitalizacion.piso_5_adulto }}</div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="mr-1" style="width: 15px;">
                                                            <i class="fas fa-child"></i>
                                                        </div>
                                                        <div class="rounded px-1">{{ datos.hospitalizacion.piso_5_pediatrico }}</div>
                                                    </div>
                                                </div>
                                            </button>
                                            <button @click="getNewDataPaciente('hospitalizacion_piso5')" type="button" class="glassmod-effect group border-0 mb-1 rounded-custom-right"><i class="pc-paciente h5 mb-0"></i></button>
                                        </div>
                                        <div id="collapseHP5SUB" class="collapse rounded-custom" style="list-style:none">
                                            <div class="d-flex flex-column">
                                                <button
                                                    @click="getNewDataPaciente('hospitalizacion_piso5_a')"
                                                    class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                                    <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                        HP5 A
                                                    </b>
                                                    <h1 class="mb-0">{{ datos.hospitalizacion.piso_5A }}</h1>
                                                    <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                        <div class="mb-1 d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-user"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.hospitalizacion.piso_5A_adulto }}</div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-child"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.hospitalizacion.piso_5A_pediatrico }}</div>
                                                        </div>
                                                    </div>
                                                </button>
                                                <button
                                                    @click="getNewDataPaciente('hospitalizacion_piso5_b')"
                                                    class="glassmod-effect group w-100 border-0 d-flex pl-3 mb-1 align-items-center rounded-custom">
                                                    <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                        HP5 B
                                                    </b>
                                                    <h1 class="mb-0">{{ datos.hospitalizacion.piso_5B }}</h1>
                                                    <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                        <div class="mb-1 d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-user"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.hospitalizacion.piso_5B_adulto }}</div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-child"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.hospitalizacion.piso_5B_pediatrico }}</div>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <button
                                                data-toggle="collapse"
                                                data-target="#collapseHP6SUB"
                                                aria-expanded="false"
                                                aria-controls="collapseHP6SUB"
                                                class="glassmod-effect group w-100 border-0 d-flex pl-3 mb-1 align-items-center rounded-custom-left">
                                                <b class="flex-fill text-left text-uppercase">
                                                    HP6
                                                </b>
                                                <h1 class="mb-0">{{ datos.hospitalizacion.piso_6 }}</h1>
                                                <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                    <div class="mb-1 d-flex align-items-center">
                                                        <div class="mr-1" style="width: 15px;">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                        <div class="rounded px-1">{{ datos.hospitalizacion.piso_6_adulto }}</div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="mr-1" style="width: 15px;">
                                                            <i class="fas fa-child"></i>
                                                        </div>
                                                        <div class="rounded px-1">{{ datos.hospitalizacion.piso_6_pediatrico }}</div>
                                                    </div>
                                                </div>
                                            </button>
                                            <button @click="getNewDataPaciente('hospitalizacion_piso6')" type="button" class="glassmod-effect group border-0 mb-1 rounded-custom-right"><i class="pc-paciente h5 mb-0"></i></button>
                                        </div>
                                        <div id="collapseHP6SUB" class="collapse rounded-custom" style="list-style:none">
                                            <div class="d-flex flex-column">
                                                <button
                                                    @click="getNewDataPaciente('hospitalizacion_piso6_a')"
                                                    class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                                    <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                        HP6 A
                                                    </b>
                                                    <h1 class="mb-0">{{ datos.hospitalizacion.piso_6A }}</h1>
                                                    <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                        <div class="mb-1 d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-user"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.hospitalizacion.piso_6A_adulto }}</div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-child"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.hospitalizacion.piso_6A_pediatrico }}</div>
                                                        </div>
                                                    </div>
                                                </button>
                                                <button
                                                    @click="getNewDataPaciente('hospitalizacion_piso6_b')"
                                                    class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                                    <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                        HP6 B
                                                    </b>
                                                    <h1 class="mb-0">{{ datos.hospitalizacion.piso_6B }}</h1>
                                                    <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                        <div class="mb-1 d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-user"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.hospitalizacion.piso_6B_adulto }}</div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-child"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.hospitalizacion.piso_6B_pediatrico }}</div>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                    <div class="d-flex">
                                        <button data-toggle="collapse" data-target="#collapseUTI" aria-expanded="false"
                                            aria-controls="collapseUTI"
                                            class="mt-1 d-flex shadow-sm flex-column align-items-center justify-content-center glassmod-effect group w-100 border-0 group rounded-custom-left">
                                            <b class="text-uppercase">TERAPIA INTENSIVA</b>
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-hospital h3 mb-0 mr-2"></i>
                                                <div class="f-size-total">{{ datos.uti.total }}</div>
                                                <div class="flex-fill ml-1 d-flex flex-column">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-user w-icon-user-type"></i>
                                                        <div>{{ datos.uti.adulto }}</div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-child w-icon-user-type"></i>
                                                        <div>{{ datos.uti.pediatrica + datos.uti.utin }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                        <button @click="getNewDataPaciente('uti')" type="button" class="glassmod-effect group border-0 mt-1 rounded-custom-right"><i class="pc-paciente h5 mb-0"></i></button>
                                    </div>
                                    <div id="collapseUTI" class="collapse mt-1">
                                        <button
                                            @click="getNewDataPaciente('uti_adulto')"
                                            class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                            <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                UTI Adulto
                                            </b>
                                            <h1 class="mb-0">{{ datos.uti.adulto }}</h1>
                                        </button>
                                        <button
                                            @click="getNewDataPaciente('uti_pediatrico')"
                                            class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                            <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                UTI Pediatrico
                                            </b>
                                            <h1 class="mb-0">{{ datos.uti.pediatrica }}</h1>
                                        </button>
                                        <button
                                            @click="getNewDataPaciente('utin')"
                                            class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                            <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                UTI Neonatal
                                            </b>
                                            <h1 class="mb-0">{{ datos.uti.utin }}</h1>
                                        </button>


                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                    <div class="d-flex">
                                        <button data-toggle="collapse" data-target="#collapseAREAQX"
                                            aria-expanded="false" aria-controls="collapseAREAQX"
                                            class="mt-1 d-flex shadow-sm flex-column align-items-center justify-content-center glassmod-effect group w-100 border-0 rounded-custom-left">
                                            <b class="text-uppercase">AREA QUIRÚRGICA</b>
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-hospital h3 mb-0 mr-2"></i>
                                                <div class="f-size-total">{{ datos.area_qx.programadas.total }}</div>
                                                <div class="flex-fill ml-1 d-flex flex-column">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-user w-icon-user-type"></i>
                                                        <div>{{ datos.area_qx.programadas.adulto }}</div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-child w-icon-user-type"></i>
                                                        <div>{{ datos.area_qx.programadas.pediatrico }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </button>
                                        <button @click="getNewDataPacienteQx('area_qx')" type="button" class="glassmod-effect group border-0 mt-1 rounded-custom-right"><i class="pc-paciente h5 mb-0"></i></button>
                                    </div>
                                    <div id="collapseAREAQX" class="collapse mt-1">
                                        <div class="d-flex">
                                            <button
                                                data-toggle="collapse"
                                                data-target="#collapseEHOSPITALIZACION"
                                                aria-expanded="false"
                                                aria-controls="collapseEHOSPITALIZACION"
                                                class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom-left">
                                                <b class="flex-fill text-left text-uppercase">
                                                    TORRE HOSPITALIZACIÓN
                                                </b>
                                                <h1 class="mb-0">{{ datos.area_qx.hospitalizacion.programadas.total }}</h1>
                                                <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                    <div class="mb-1 d-flex align-items-center">
                                                        <div class="mr-1" style="width: 15px;">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                        <div class="rounded px-1">{{ datos.area_qx.hospitalizacion.programadas.adulto }}</div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="mr-1" style="width: 15px;">
                                                            <i class="fas fa-child"></i>
                                                        </div>
                                                        <div class="rounded px-1">{{ datos.area_qx.hospitalizacion.programadas.pediatrico }}</div>
                                                    </div>
                                                </div>
                                               
                                            </button>
                                            <button @click="getNewDataPacienteQx('qx_torre_hospitalizacion')" type="button" class="glassmod-effect group mb-1 border-0 rounded-custom-right"><i class="pc-paciente h5 mb-0"></i></button>
                                        </div>
                                        <div id="collapseEHOSPITALIZACION" class="collapse  rounded-custom">
                                            <button
                                                @click="getNewDataPacienteQx('qx_torre_hospitalizacion_ambulatorias')"
                                                class="glassmod-effect group w-100 border-0 mb-1 d-flex px-3 align-items-center rounded-custom">
                                                <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                    AMBULATORIA TORRE
                                                </b>
                                                <h1 class="mb-0">{{ datos.area_qx.hospitalizacion.ambulatoria_torre.programadas.total }}</h1>
                                                <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                    <div class="mb-1 d-flex align-items-center">
                                                        <div class="mr-1" style="width: 15px;">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                        <div class="rounded px-1">{{ datos.area_qx.hospitalizacion.ambulatoria_torre.programadas.adulto }}</div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="mr-1" style="width: 15px;">
                                                            <i class="fas fa-child"></i>
                                                        </div>
                                                        <div class="rounded px-1">{{ datos.area_qx.hospitalizacion.ambulatoria_torre.programadas.pediatrico }}</div>
                                                    </div>
                                                </div>
                                            </button>
                                            <button
                                                @click="getNewDataPacienteQx('qx_torre_hospitalizacion_hospitalizacion')"
                                                class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                                <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                    HOSPITALIZACIÓN
                                                </b>
                                                <h1 class="mb-0">{{ datos.area_qx.hospitalizacion.hospitalizacion_torre.programadas.total }}</h1>
                                                <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                    <div class="mb-1 d-flex align-items-center">
                                                        <div class="mr-1" style="width: 15px;">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                        <div class="rounded px-1">{{ datos.area_qx.hospitalizacion.hospitalizacion_torre.programadas.adulto }}</div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="mr-1" style="width: 15px;">
                                                            <i class="fas fa-child"></i>
                                                        </div>
                                                        <div class="rounded px-1">{{ datos.area_qx.hospitalizacion.hospitalizacion_torre.programadas.pediatrico }}</div>
                                                    </div>
                                                </div>
                                         
                                            </button>
                                        </div>
                                        <div class="d-flex">
                                            <button
                                                data-toggle="collapse"
                                                data-target="#collapseEAMBULATORIA"
                                                aria-expanded="false"
                                                aria-controls="collapseEAMBULATORIA"
                                                class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom-left"
                                            >
                                                <b class="flex-fill text-left text-uppercase">
                                                    TORRE MAPM
                                                </b>
                                                <h1 class="mb-0">{{ datos.area_qx.mapm.programadas.total }}</h1>
                                                <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                    <div class="mb-1 d-flex align-items-center">
                                                        <div class="mr-1" style="width: 15px;">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                        <div class="rounded px-1">{{ datos.area_qx.mapm.programadas.adulto }}</div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="mr-1" style="width: 15px;">
                                                            <i class="fas fa-child"></i>
                                                        </div>
                                                        <div class="rounded px-1">{{ datos.area_qx.mapm.programadas.pediatrico }}</div>
                                                    </div>
                                                </div>
                                          
                                            </button>
                                            <button @click="getNewDataPacienteQx('qx_mapm')" type="button" class="glassmod-effect group mb-1 border-0 rounded-custom-right"><i class="pc-paciente h5 mb-0"></i></button>
                                        </div>
                                        <div id="collapseEAMBULATORIA" class="collapse  rounded-custom">
                                            <div class="d-flex">
                                                <button
                                                    @click="getNewDataPacienteQx('qx_mapm_oftalmologica')"
                                                    class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                                    <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                        OFTALMOLOGICAS
                                                    </b>
                                                    <h1 class="mb-0">{{ datos.area_qx.mapm.oftalmologicas.programadas.total }}</h1>
                                                    <div class="mx-2 d-flex flex-column justify-content-center"
                                                            style="line-height: 1rem;">
                                                        <div class="mb-1 d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-user"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.area_qx.mapm.oftalmologicas.programadas.adulto }}</div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-child"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.area_qx.mapm.oftalmologicas.programadas.pediatrico }}</div>
                                                        </div>
                                                    </div>
                                                    
                                                </button>
                                            </div>
                                            <div class="d-flex">
                                                <button
                                                    @click="getNewDataPacienteQx('qx_mapm_especialidades')"
                                                    class="glassmod-effect group w-100 border-0 d-flex px-3 mb-1 align-items-center rounded-custom">
                                                    <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                        ESPECIALIDADES
                                                    </b>
                                                    <h1 class="mb-0">{{ datos.area_qx.mapm.especialidades.programadas.total }}</h1>
                                                    <div class="mx-2 d-flex flex-column justify-content-center"
                                                            style="line-height: 1rem;">
                                                        <div class="mb-1 d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-user"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.area_qx.mapm.especialidades.programadas.adulto }}</div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-child"></i>
                                                            </div>
                                                            <div class="rounded px-1">{{ datos.area_qx.mapm.especialidades.programadas.pediatrico }}</div>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                            
                                            <div id="collapseEMAPM" class="collapse  rounded-custom">
                                                <button
                                                    @click="getNewDataPacienteQx('qx_ambulatoria_mapm_oftalmologica')"
                                                    class="glassmod-effect group w-100 border-0 d-flex pl-5 pr-3 mb-1 align-items-center rounded-custom">
                                                    <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                        OFTALMOLÓGICAS
                                                    </b>
                                                    <h1 class="mb-0"><!-- {{ datos.area_qx.ambulatorias.mapm.oftalmologicas.total }} -->00</h1>
                                                    <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                        <div class="mb-1 d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-user"></i>
                                                            </div>
                                                            <div class="rounded px-1"><!-- {{ datos.area_qx.ambulatorias.mapm.oftalmologicas.adulto }} -->00</div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-child"></i>
                                                            </div>
                                                            <div class="rounded px-1"><!-- {{ datos.area_qx.ambulatorias.mapm.oftalmologicas.pediatrico }} -->00</div>
                                                        </div>
                                                    </div>
                                                </button>
                                                <button
                                                    @click="getNewDataPacienteQx('qx_ambulatoria_mapm_especialidades')"
                                                    class="glassmod-effect group w-100 border-0 d-flex pl-5 pr-3 mb-1 align-items-center rounded-custom">
                                                    <b class="ml-4 mr-2 flex-fill text-left text-uppercase">
                                                        ESPECIALIDADES
                                                    </b>
                                                    <h1 class="mb-0"><!-- {{ datos.area_qx.ambulatorias.mapm.especialidades.total }} -->00</h1>
                                                    <div class="mx-2 d-flex flex-column justify-content-center"
                                                        style="line-height: 1rem;">
                                                        <div class="mb-1 d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-user"></i>
                                                            </div>
                                                            <div class="rounded px-1"><!-- {{ datos.area_qx.ambulatorias.mapm.especialidades.adulto }} -->00</div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-1" style="width: 15px;">
                                                                <i class="fas fa-child"></i>
                                                            </div>
                                                            <div class="rounded px-1"><!-- {{ datos.area_qx.ambulatorias.mapm.especialidades.pediatrico }} -->00</div>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                    <div
                                        class="mt-1 d-flex shadow-sm flex-column align-items-center justify-content-center glassmod-effect rounded-custom">
                                        <b class="text-uppercase">CONSULTA EXTERNA</b>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-hospital h3 mb-0 mr-2"></i>
                                            <div class="f-size-total">00</div>
                                            <div class="flex-fill ml-1 d-flex flex-column">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-user w-icon-user-type"></i>
                                                    <div>00</div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-child w-icon-user-type"></i>
                                                    <div>00</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm col-md flex-column ">
                    <div class="d-flex flex-column justify-content-start">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="mt-1 d-flex">
                                <button  @click="handleLevel1()" data-toggle="collapse" data-target="#collapsePAD" aria-expanded="false"
                                    aria-controls="collapsePAD"
                                    class="d-flex shadow-sm flex-column align-items-center justify-content-center glassmod-effect group w-100 border-0 group rounded-custom-left">
                                    <b class="text-uppercase">PAD</b>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-hospital h3 mb-0 mr-2"></i>
                                        <div class="f-size-total">{{ datos.pad.total }}</div>
                                        <div class="flex-fill ml-1 d-flex flex-column">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-user w-icon-user-type"></i>
                                                <div>{{datos.pad.adulto}}</div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-child w-icon-user-type"></i>
                                                <div>{{datos.pad.pediatrico}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                                <button @click="getNewDataPaciente('pad')" type="button" class="glassmod-effect group border-0 rounded-custom-right"><i class="pc-paciente h5 mb-0"></i></button>
                            </div>
                            <div ref="collapsePAD" id="collapsePAD" class="collapse">
                                <div class="container-fluid p-0">
                                    <div class="row justify-content-center align-items-start">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                            <div class="mt-1 d-flex">
                                                <button data-toggle="collapse" data-target="#collapsePADEMERGENCIA"
                                                    aria-expanded="false" aria-controls="collapsePADEMERGENCIA"
                                                    class="d-flex shadow-sm flex-column align-items-center justify-content-center glassmod-effect group w-100 border-0 group rounded-custom-left">
                                                    <b class="text-uppercase">PAD EMERGENCIA</b>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-hospital h3 mb-0 mr-2"></i>
                                                        <div class="f-size-total">{{ datos.pad.emergencia.total }}</div>
                                                        <div class="flex-fill ml-1 d-flex flex-column">
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-user w-icon-user-type"></i>
                                                                <div>{{ datos.pad.emergencia.adulto }}</div>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-child w-icon-user-type"></i>
                                                                <div>{{ datos.pad.emergencia.pediatrico }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </button>
                                                <button  @click="getNewDataPaciente('pad_emergencia')" type="button" class="glassmod-effect group border-0 rounded-custom-right"><i class="pc-paciente h5 mb-0"></i></button>
                                            </div>
                                            <div id="collapsePADEMERGENCIA" class="collapse container-fluid">
                                                <div class="row ">
                                                    <button
                                                        @click="getNewDataPaciente('pad_emergencia_adulto')"
                                                        class="d-flex mt-1 shadow-sm align-items-center justify-content-center glassmod-effect group w-100 border-0 group rounded-custom">
                                                        <b class="mx-2 flex-fill text-left text-uppercase">
                                                            PAD EMERGENCIA ADULTO
                                                        </b>
                                                        <h1 class="mb-0">{{ datos.pad.emergencia.adulto }}</h1>
                                                    </button>
                                                    <button
                                                        @click="getNewDataPaciente('pad_emergencia_pediatrico')"
                                                        class="d-flex mt-1 shadow-sm align-items-center justify-content-center glassmod-effect group w-100 border-0 group rounded-custom">
                                                        <b class="mx-2 flex-fill text-left text-uppercase">
                                                            PAD EMERGENCIA PEDIÁTRICA
                                                        </b>
                                                        <h1 class="mb-0">{{ datos.pad.emergencia.pediatrico }}</h1>
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                            <div class="mt-1 d-flex">
                                                <button data-toggle="collapse" data-target="#collapsePADPOSTQX"
                                                    aria-expanded="false" aria-controls="collapsePADPOSTQX"
                                                    class="d-flex shadow-sm flex-column align-items-center justify-content-center glassmod-effect group w-100 border-0 group rounded-custom-left">
                                                    <b class="text-uppercase">PAD POSTQUIRÚRGICO</b>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-hospital h3 mb-0 mr-2"></i>
                                                        <div class="f-size-total">{{ datos.pad.postquirurgico.total }}</div>
                                                        <div class="flex-fill ml-1 d-flex flex-column">
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-user w-icon-user-type"></i>
                                                                <div>{{ datos.pad.postquirurgico.adulto }}</div>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-child w-icon-user-type"></i>
                                                                <div>{{ datos.pad.postquirurgico.pediatrico }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </button>
                                                <button @click="getNewDataPaciente('pad_postqx')" type="button" class="glassmod-effect group border-0 rounded-custom-right"><i class="pc-paciente h5 mb-0"></i></button>
                                            </div>
                                            <div id="collapsePADPOSTQX" class="collapse container-fluid">
                                                <div class="row ">
                                                    <button
                                                        @click="getNewDataPaciente('pad_postqx_ambulatorio')"
                                                        class="d-flex mt-1 shadow-sm align-items-center justify-content-center glassmod-effect group w-100 border-0 group rounded-custom">
                                                        <b class="mx-2 flex-fill text-left text-uppercase">
                                                            PAD POST QX AMBULATORIO
                                                        </b>
                                                        <h1 class="mb-0">{{ datos.pad.postquirurgico.ambulatorio.total }}</h1>
                                                        <div class="flex-fill ml-1 d-flex flex-column">
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-user w-icon-user-type"></i>
                                                                <div>{{ datos.pad.postquirurgico.ambulatorio.adulto }}</div>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-child w-icon-user-type"></i>
                                                                <div>{{ datos.pad.postquirurgico.ambulatorio.pediatrico }}</div>
                                                            </div>
                                                        </div>
                                                    </button>
                                                    <button
                                                        @click="getNewDataPaciente('pad_postqx_hospitalizacion')"
                                                        class="d-flex mt-1 shadow-sm align-items-center justify-content-center glassmod-effect group w-100 border-0 group rounded-custom">
                                                        <b class="mx-2 flex-fill text-left text-uppercase">
                                                            PAD POST QX HOSPITALIZACIÓN
                                                        </b>
                                                        <h1 class="mb-0">{{ datos.pad.postquirurgico.hospitalizacion.total }}</h1>
                                                        <div class="flex-fill ml-1 d-flex flex-column">
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-user w-icon-user-type"></i>
                                                                <div>{{ datos.pad.postquirurgico.hospitalizacion.adulto }}</div>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-child w-icon-user-type"></i>
                                                                <div>{{ datos.pad.postquirurgico.hospitalizacion.pediatrico }}</div>
                                                            </div>
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6">

                                                <button
                                                @click="getNewDataPaciente('pad_medico')"
                                                class="d-flex shadow-sm mt-1 flex-column align-items-center justify-content-center glassmod-effect group w-100 border-0 group rounded-custom">
                                                    <b class="text-uppercase">PAD MÉDICO</b>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-hospital h3 mb-0 mr-2"></i>
                                                        <div class="f-size-total">{{ datos.pad.medico.total }}</div>
                                                        <div class="flex-fill ml-1 d-flex flex-column">
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-user w-icon-user-type"></i>
                                                                <div>{{ datos.pad.medico.adulto }}</div>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-child w-icon-user-type"></i>
                                                                <div>{{ datos.pad.medico.pediatrico }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </button>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- FIN -->
        <div class="modal fullscreen-modal fade" style="z-index: 10000;" id="modal-patient-item" tabindex="-1"
            role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content d-flex flex-column overflow-auto vh-100">
                    <div class="modal-header p-0">
                        <nav class="d-flex justify-content-between align-items-center bg-primary rounded-pill m-1 ">
                            <i id="close_modal" data-dismiss="modal" aria-label="Close"
                                class="ml-3 fas fa-times text-white heartbeat" style="font-size: 2em;cursor:pointer;"
                                aria-hidden="true"></i>

                            <img class="img-logo m-1 d-block"
                                src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg"
                                alt="Logo CMDLT">
                        </nav>
                    </div>
                    <div class="modal-body-2 container-fluid  fullscreen d-flex flex-column overflow-auto">
                        <div class="d-flex justify-content-end">
                            <div class="col-12 col-sm-4 text-primary h3 font-weight-bold text-center text-uppercase">
                                PACIENTES EN {{currentTitle}}
                            </div>
                            <div class="col-12 col-sm-4">
                                <input v-model="inputSearch" type="search" placeholder="Buscar un Paciente" class="form-control">
                            </div>
                        </div>
                        <div class="flex-fill overflow-auto">
                            <table ref="tableToSearch" class="table table-bordered">
                                <thead>
                                    <tr class="text-primary">
                                        <th class="sticky">#</th>
                                        <th class="sticky">Ubicación actual</th>
                                        <th class="sticky">Paciente</th>
                                        <th class="sticky">Fecha Ingreso</th>
                                        <th class="sticky">Días</th>
                                        <th class="sticky">Probabilidad Diagnóstica</th>
                                        <th class="sticky">Pendientes</th>
                                        <th class="sticky">Equipo Médico</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr v-for="(item, index) in lista_pacientes_area" :key="item.id">
                                        <td>
                                            {{ index = index + 1 }}
                                            <small class="text-white">#{{ item.user_id }}</small>
                                            <small class="text-white">epi#{{ item.episodio_id }}</small>
                                        </td>
                                        <td>
                                            {{ item.ubicacion }}
                                            <small class="text-white">id_ubi#{{ item.ubicacion_id }}</small>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <h5 class="text-secondary">
                                                    {{ item.nombres_paciente }} {{ item.apellidos_paciente }}
                                                    <span class="text-white">#{{item.user_id}}</span>
                                                </h5>
                                                <div class="d-flex" style="gap:10px;">
                                                    <span class="badge badge-gray text-primary text-uppercase">CI. {{ item.cedula_paciente }}</span>
                                                    <span class="badge badge-gray text-primary text-uppercase">{{ item.genero_paciente }}</span>
                                                    <span class="badge badge-gray text-primary text-uppercase">{{ item.edad }} A</span>

                                                </div>
                                            </div>


                                        </td>

                                        <td>
                                            <div class="text-nowrap">
                                                {{ fechaFormated(item.ingreso)['dia'] }}
                                            </div>

                                        </td>

                                        <td>
                                            {{ item.dias }}
                                        </td>
                                        <td class="p-0">
                                            <ul class="list-group list-group-flush">
                                                <li
                                                    v-for="(item2,index) in item.probabilidad_diagnostica"
                                                    :key="'prob_diagnostica_'+index+item2.id"
                                                    class="list-group-item p-1"
                                                >
                                                    {{ item2.value }}
                                                </li>

                                            </ul>
                                        </td>
                                        <td class="p-0">
                                            <ul class="list-group list-group-flush">
                                                <li
                                                    v-for="(item2,index) in item.pendientes"
                                                    :key="'prob_diagnostica_'+index+item2.id"
                                                    class="list-group-item p-1"
                                                >
                                                    <b>{{ item2.value }}</b><br>
                                                    {{ item2.coments }}
                                                </li>

                                            </ul>
                                        </td>
                                        <td>
                                            <div v-if="item.equipo_medico.length > 0 ">
                                                <ul class="list-group list-group-flush">
                                                    <li
                                                        v-for="(item2, index) in item.equipo_medico"
                                                        :key="'equi_medico_'+index+item2.id"
                                                        class="list-group-item p-1"
                                                    >
                                                    <span :class="['badge','badge-'+item2.tagColor]">{{item2.posicion}}</span> {{ item2.medico }}
                                                    <span class="text-white">#{{item2.user_id_medico}}</span>
                                                    </li>

                                                </ul>

                                            </div>
                                        </td>



                                    </tr>

                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fullscreen-modal fade" style="z-index: 10000;" id="modal-patient-item2" tabindex="-1"
            role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content d-flex flex-column overflow-auto vh-100">
                    <div class="modal-header p-0">
                        <nav class="d-flex justify-content-between align-items-center bg-primary rounded-pill m-1 ">
                            <i id="close_modal" data-dismiss="modal" aria-label="Close"
                                class="ml-3 fas fa-times text-white heartbeat" style="font-size: 2em;cursor:pointer;"
                                aria-hidden="true"></i>

                            <img class="img-logo m-1 d-block"
                                src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg"
                                alt="Logo CMDLT">
                        </nav>
                    </div>
                    <div class="modal-body-2 container-fluid  fullscreen d-flex flex-column overflow-auto">
                        <div class="d-flex justify-content-end">
                            <div class="col-12 col-sm-4 text-primary h3 font-weight-bold text-center text-uppercase">
                                PACIENTES EN {{currentTitle}}
                            </div>
                            <div class="col-12 col-sm-4">
                                <input v-model="inputSearch_qx" type="search" placeholder="Buscar un Paciente" class="form-control">
                            </div>
                        </div>
                        <div class="flex-fill overflow-auto">
                            <table ref="tableToSearch_qx" class="table table-bordered">
                                <thead>
                                    <tr class="text-primary">
                                        <th class="sticky">QX</th>
                                        <th class="sticky">Paciente</th>
                                        <th class="sticky">Intervención</th>
                                        <th class="sticky">Hora Inicio IQX</th>
                                        <th class="sticky">Crirujano principal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in lista_pacientes_area_qx" :key="'aq_'+item.id">
                                        <td>
                                            QX{{ item.n_quirofano }}
                                            <small class="text-white">#{{ item.id }}</small>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <h5 class="text-secondary">
                                                    {{ item.nombres }} {{ item.apellidos }}
                                                    <span class="text-white">#{{item.user_id_paciente}}</span>
                                                </h5>
                                                <div class="d-flex" style="gap:10px;">
                                                    <span class="badge badge-gray text-primary text-uppercase">CI. {{ item.cedula }}</span>
                                                    <span class="badge badge-gray text-primary text-uppercase">{{ item.genero }}</span>
                                                    <span class="badge badge-gray text-primary text-uppercase">{{ item.edad }} A</span>

                                                </div>
                                            </div>


                                        </td>
                                        <td class="p-0">
                                            <ul class="list-group list-group-flush">
                                                <li
                                                    v-for="(item2,index) in Array.from(JSON.parse(item.intervencion))"
                                                    :key="'intervencion_'+index+item2.id"
                                                    class="list-group-item p-1"
                                                >
                                                    {{ item2.description.description }}
                                                </li>

                                            </ul>
                                        </td>
                                        <td>
                                            {{item.h_inicio}}
                                        </td>
                                        <td class="p-0">

                                            <ul class="list-group list-group-flush">
                                                <li
                                                    v-for="(item2,index) in Array.from(JSON.parse(item.intervencion))"
                                                    :key="'cirujano_'+index+item2.id"
                                                    class="list-group-item p-1"
                                                >
                                                    {{ item2.cirujano_principal[0].description }}
                                                </li>

                                            </ul>
                                        </td>
                                    </tr>

                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>

<script scoped>
    import { fechaHoy, fechaCortaCustom2, meses, formatAMPM } from "../../../helpers/customHelpers.js";
    import CardArea from "./CardArea.vue";
    import CardAreaListEA from "./CardAreaListEA.vue";
    import CardAreaListEP from "./CardAreaListEP.vue";
    import CardAreaListHP from "./CardAreaListHP.vue";
    import CardAreaListUTI from "./CardAreaListUTI.vue";
    import CardAreaListPAD from "./CardAreaListPAD.vue";
    export default {
        name: "IngresosCmdlt",
        components: {
            CardArea,
            CardAreaListEA,
            CardAreaListEP,
            CardAreaListHP,
            CardAreaListUTI,
            CardAreaListPAD,
        },
        data() {
            return {
                currentTitle:"",
                searchigResults:true,
                inputSearch_qx:"",
                inputSearch:"",
                tableToSearch:"tableToSearch",
                tableToSearch_qx:"tableToSearchQX",
                level1Open:false,
                lista_pacientes_area_qx: [],
                lista_pacientes_area: [],
                titlesModal:{
                    'cmdlt': "CMDLT",
                    'telemedicina': "TELESALUD",
                    'proyectos_especiales': "PROYECTOS ESPECIALES",
                    'emergencia': "EMERGENCIA",
                    'emergencia_adulto': "EMERGENCIA ADULTO",
                    'emergencia_adulto_triaje_a': "EA TRIAJE A",
                    'emergencia_adulto_triaje_b': "EA TRIAJE b",
                    'emergencia_adulto_observacion': "EA OBSERVACIÓN",
                    'emergencia_adulto_traumashock': "EA TRAUMASHOCK",
                    'emergencia_pediatrico': "EMERGENCIA PEDIÁTRICA",
                    'emergencia_pediatrico_triaje_a': "EP TRIAJE A",
                    'emergencia_pediatrico_triaje_b': "EP TRIAJE b",
                    'emergencia_pediatrico_observacion': "EP OBSERVACIÓN",
                    'emergencia_pediatrico_traumashock': "EP TRAUMASHOCK",
                    'emergencia_pediatrico_nebulizacion': "EP NEBULIZACIÓN",
                    'emergencia_pediatrico_hcep': "EP CORTA ESTANCIA",
                    'hospitalizacion': "HOSPITALIZACIÓN",
                    'hospitalizacion_piso2': "HOSPITALIZACIÓN PISO 2",
                    'hospitalizacion_piso2_a': "HOSPITALIZACIÓN PISO 2 A",
                    'hospitalizacion_piso2_b': "HOSPITALIZACIÓN PISO 2 B",
                    'hospitalizacion_piso3': "HOSPITALIZACIÓN PISO 3",
                    'hospitalizacion_piso3_a': "HOSPITALIZACIÓN PISO 3 A",
                    'hospitalizacion_piso3_b': "HOSPITALIZACIÓN PISO 3 B",
                    'hospitalizacion_piso4': "HOSPITALIZACIÓN PISO 4",
                    'hospitalizacion_piso4_a': "HOSPITALIZACIÓN PISO 4 A",
                    'hospitalizacion_piso4_b': "HOSPITALIZACIÓN PISO 4 B",
                    'hospitalizacion_piso5': "HOSPITALIZACIÓN PISO 5",
                    'hospitalizacion_piso5_a': "HOSPITALIZACIÓN PISO 5 A",
                    'hospitalizacion_piso5_b': "HOSPITALIZACIÓN PISO 5 B",
                    'hospitalizacion_piso6': "HOSPITALIZACIÓN PISO 6",
                    'hospitalizacion_piso6_a': "HOSPITALIZACIÓN PISO 6 A",
                    'hospitalizacion_piso6_b': "HOSPITALIZACIÓN PISO 6 B",
                    'uti': "TERAPIA INTENSIVO",
                    'uti_adulto': "UTI ADULTO",
                    'uti_pediatrico': "UTI PEDIÁTRICO",
                    'utin': "UTI NEONATAL",
                    'area_qx': "ÁREA DE QUIRÓFANO",
                    'qx_torre_hospitalizacion': "TORRE HOSPITALIZACIÓN",
                    'qx_torre_ambulatoria': "TORRE AMBULATORIAS",
                    'qx_mapm': "AQ MAPM",
                    'qx_mapm_oftalmologica': "AMB OFTALMOLÓGICA",
                    'qx_mapm_especialidades': "AMB ESPECIALIDADES",
                    /* 'qx_ambulatoria_mapm_oftalmologica': "MAPM OFTALMOLÓGICA",
                    'qx_ambulatoria_mapm_especialidades': "MAPM ESPECIALIDADES", */
                    'pad': "PAD",
                    'pad_emergencia': "PAD EMERGENCIA",
                    'pad_emergencia_adulto': "PAD EMERGENCIA ADULTO",
                    'pad_emergencia_pediatrico': "PAD EMERGENCIA PEDIATRICA",
                    'pad_postqx': "PAD POSTQUIRÚRGICO",
                    'pad_postqx_hospitalizacion': "POSTQX HOSPITALIZACIÓN",
                    'pad_postqx_ambulatorio': "POSTQX AMBULATORIO",
                    'pad_medico': "PAD MÉDICOS",
                },
                datos: {
                    "cmdlt": {
                        "total": 0,
                        "adulto": 0,
                        "pediatrico": 0,
                    },
                    "telemedicina": {
                        "total": 0
                    },
                    "emergencia": {
                        "total": 0
                    },
                    "emergencia_adulto": {
                        "a": 0,
                        "b": 0,
                        "triaje": 0,
                        "observacion": 0,
                        "traumashock": 0,
                        "total": 0
                    },
                    "emergencia_pediatrica": {
                        "a": 0,
                        "b": 0,
                        "triaje": 0,
                        "observacion": 0,
                        "traumashock": 0,
                        "nebulizacion": 0,
                        "hcep": 0,
                        "total": 0
                    },
                    "hospitalizacion": {
                        "adulto": 0,
                        "pediatrico": 0,
                        "piso_2": 0,
                        "piso_2_adulto": 0,
                        "piso_2_pediatrico": 0,
                        "piso_2A": 0,
                        "piso_2A_adulto": 0,
                        "piso_2A_pediatrico": 0,
                        "piso_2B": 0,
                        "piso_2B_adulto": 0,
                        "piso_2B_pediatrico": 0,
                        "piso_3": 0,
                        "piso_3_adulto": 0,
                        "piso_3_pediatrico": 0,
                        "piso_3A": 0,
                        "piso_3A_adulto": 0,
                        "piso_3A_pediatrico": 0,
                        "piso_3B": 0,
                        "piso_3B_adulto": 0,
                        "piso_3B_pediatrico": 0,
                        "piso_4": 0,
                        "piso_4_adulto": 0,
                        "piso_4_pediatrico": 0,
                        "piso_4A": 0,
                        "piso_4A_adulto": 0,
                        "piso_4A_pediatrico": 0,
                        "piso_4B": 0,
                        "piso_4B_adulto": 0,
                        "piso_4B_pediatrico": 0,
                        "piso_5": 0,
                        "piso_5_adulto": 0,
                        "piso_5_pediatrico": 0,
                        "piso_5A": 0,
                        "piso_5A_adulto": 0,
                        "piso_5A_pediatrico": 0,
                        "piso_5B": 0,
                        "piso_6": 0,
                        "piso_6_adulto": 0,
                        "piso_6_pediatrico": 0,
                        "piso_6A": 0,
                        "piso_6A_adulto": 0,
                        "piso_6A_pediatrico": 0,
                        "piso_6B": 0,
                        "piso_6B_adulto": 0,
                        "piso_6B_pediatrico": 0,
                        "total": 0
                    },
                    "area_qx": {
                        "total": 0,
                        "programadas": {
                            "total": 0,
                            "adulto": 0,
                            "pediatrico": 0
                        },
                        "ejecutadas": {
                            "total": 0,
                            "adulto": 0,
                            "pediatrico": 0
                        },
                        "hospitalizacion": {
                            "total": 0,
                            "programadas": {
                                "total": 0,
                                "adulto": 0,
                                "pediatrico": 0
                            },
                            "ejecutadas": {
                                "total": 0,
                                "adulto": 0,
                                "pediatrico": 0
                            },
                            "ambulatoria_torre": {
                                "total": 0,
                                "programadas": {
                                    "total": 0,
                                    "adulto": 0,
                                    "pediatrico": 0
                                },
                                "ejecutadas": {
                                    "total": 0,
                                    "adulto": 0,
                                    "pediatrico": 0
                                },
                            },
                            "hospitalizacion_torre": {
                                "total": 0,
                                "programadas": {
                                    "total": 0,
                                    "adulto": 0,
                                    "pediatrico": 0
                                },
                                "ejecutadas": {
                                    "total": 0,
                                    "adulto": 0,
                                    "pediatrico": 0
                                },
                            },
                        },
                        "mapm": {
                            "total": 0,
                            "programadas": {
                                "total": 0,
                                "adulto": 0,
                                "pediatrico": 0
                            },
                            "ejecutadas": {
                                "total": 0,
                                "adulto": 0,
                                "pediatrico": 0
                            },
                            "oftalmologicas": {
                                "total": 0,
                                "programadas": {
                                    "total": 0,
                                    "adulto": 0,
                                    "pediatrico": 0
                                },
                                "ejecutadas": {
                                    "total": 0,
                                    "adulto": 0,
                                    "pediatrico": 0
                                },
                            },
                            "especialidades": {
                                "total": 0,
                                "programadas": {
                                    "total": 0,
                                    "adulto": 0,
                                    "pediatrico": 0
                                },
                                "ejecutadas": {
                                    "total": 0,
                                    "adulto": 0,
                                    "pediatrico": 0
                                },
                            },
                        },
                     
                    },
                    "uti": {
                        "adulto": 0,
                        "pediatrica": 0,
                        "utin": 0,
                        "total": 0
                    },
                    "pad": {
                        "emergencia": {
                            "adulto": 0,
                            "pediatrico": 0,
                            "total": 0
                        },
                        "postquirurgico": {
                            "ambulatorio": {
                                "total": 0,
                                "adulto": 0,
                                "pediatrico": 0
                            },
                            "hospitalizacion": {
                                "total": 0,
                                "adulto": 0,
                                "pediatrico": 0
                            },
                            "total": 0,
                            "adulto": 0,
                            "pediatrico": 0
                        },
                        "medico": {
                            "total": 0,
                            "adulto": 0,
                            "pediatrico": 0
                        },
                        "adulto": 0,
                        "pediatrico": 0,
                        "total": 0
                    }
                },
                desde: fechaHoy(),
                hasta: fechaHoy(),
            }
        },
        watch: {
            // Observa cambios en la propiedad 'inputSearch'
            inputSearch(nuevoValor, valorAnterior) {
                setTimeout(() => {
                    this.filterTable(); // Llama a la función cada vez que 'inputSearch' cambie
                }, 500);

            }
        },
        methods: {
            filterTable() {

                let table = this.$refs[this.tableToSearch].tBodies[0];

                let text = this.inputSearch.toLowerCase();
                let r = 0;

                let row = []
                    while (row = table.rows[r++]) {
                        if (row.innerText.toLowerCase().indexOf(text) !== -1){
                            row.style.display = null;
                        }else{
                            row.style.display = 'none';
                        }
                    }


            },
            handleLevel1(){
                let group1 = this.$refs['collapseCMDLT'].classList.contains("show")
                let group2 = this.$refs['collapsePAD'].classList.contains("show")
                //let group2 = this.$refs['collapseTELEMEDICINA'].classList.contains("show")
                //console.log(group1,group2)
                this.level1Open = false
                if (group1==false || group2==false) {
                    this.level1Open = true
                }

            },
            fechaFormated(param) {
                let hoy = new Date(param);
                return {
                    dia: hoy.getDate() + " DE " + (meses(hoy.getMonth()).toUpperCase()),
                    hora: formatAMPM(hoy)
                }
            },
            currentDate() {
                let hoy = new Date();
                    return hoy.getDate() + " " +  meses( hoy.getMonth() )  + " " + hoy.getFullYear()
            },
            async getNewData() {
                this.datos = await this.getData()
            },
            async getNewDataPaciente(area) {
                $("#modal-patient-item").modal("show");
                this.inputSearch = ""
                this.currentTitle = this.titlesModal[area]
                this.lista_pacientes_area = []
                this.lista_pacientes_area = await this.getDataPacientes(area)
            },
            async getNewDataPacienteQx(area) {
                $("#modal-patient-item2").modal("show");
                this.inputSearch_qx = ""
                this.currentTitle = this.titlesModal[area]
                this.lista_pacientes_area_qx = []
                this.lista_pacientes_area_qx = await this.getDataPacientesQx(area)
            },
            async getData() {
                console.log(fechaHoy());
                try {

                    const response = await fetch(`/user/admin/dataingresostotales/${this.desde}/${this.hasta}`);
                    const responseData = await response.json();

                    return responseData;
                } catch (error) {
                    console.error('Error al obtener los datos:', error);
                }
                return false
            },
            async getDataPacientes(area) {

                try {
                    this.searchigResults= true
                    const response = await fetch(`/user/admin/dataingresosdatospacientes/${area}`);
                    const responseData = await response.json();
                    this.searchigResults= false
                    return responseData;
                } catch (error) {
                    this.searchigResults= false
                    console.error('Error al obtener los datos:', error);
                }
                return false
            },
            async getDataPacientesQx(area) {

                try {
                    this.searchigResults= true
                    const response = await fetch(`/user/admin/dataingresosqxdatospacientes/${area}`);
                    const responseData = await response.json();
                    this.searchigResults= false
                    return responseData;
                } catch (error) {
                    this.searchigResults= false
                    console.error('Error al obtener los datos:', error);
                }
                return false
            },


        },
        computed: {
            getTotales() {
                return this.datos
            }



        },
        mounted: async function () {
            this.searchigResults= true
            this.datos = await this.getData()
            this.searchigResults= false
            console.log(this.datos)
            setInterval(async () => {
                this.datos = await this.getData()
            }, 10000);
            /*
            */
        }
    };
</script>
<style>
    .loading{
        position: fixed;
        width: 100vw;
        height: 100vh;
        background-color: rgb(0 0 0 / 25%);
        z-index: 1000000;
        display: flex;
        justify-content: center;
    }
    body {
        background-color: #1f2d3d;
        /* background: url(http://drive.google.com/uc?export=view&id=1lOnAmjJm26ZhK9j0ERYKlSv58rInMWjG) no-repeat center center fixed;*/
        background: url('https://patientcare.cmdlt.pstelemed.com/image/system/background_hosp.jpg') no-repeat center center fixed;
        /* -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover; */
    }

    .h-100 {
        height: 100vh !important;
    }

    .h-card {
        height: 150px !important
    }

    .rounded-custom {
        border-radius: 15px
    }
    .rounded-custom-left {
        border-top-left-radius: 15px;
        border-bottom-left-radius: 15px;
    }
    .rounded-custom-right {
        border-top-right-radius: 15px;
        border-bottom-right-radius: 15px;
    }

    .glassmod-effect {
        background-color: rgb(255 255 255 / 30%);
        backdrop-filter: blur(20px);
        color: white;
        opacity: 1;
        /* Inicialmente visible */
        transition: opacity 0.5s ease;
        /* Transición suave durante 0.5 segundos */
    }

    .glassmod-effect:hover {
        background-color: white;
        cursor: pointer;
        color: var(--primary);
        opacity: 0.5;

    }
    .glassmod-effect.group:focus {
        background-color: white !important;
        cursor: pointer !important;
        color: var(--primary) !important;
        opacity: 0.8 !important;
        outline: 0px !important; /*borde externo de boton*/
    }

    .f-size-total {
        font-size: 60px;
    }

    .w-icon-user-type {
        width: 20px;
    }

    #multiCollapseExample1.collapse.show {
        display: flex !important;
    }

    .img-logo {
        height: 50px;
        width: 120px;
    }
    .sticky{
        position: sticky;
        background: white;
        top: -2px;
        z-index: 2;
    }
    .form-control-custom-1 {
        display: block;
        width: 100%;
        height: calc(2.25rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #ffffff;
        background-color: #ffffff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        box-shadow: inset 0 0 0 rgba(0, 0, 0, 0);
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        background-color: rgb(255 255 255 / 30%);
        -webkit-backdrop-filter: blur(20px);
        backdrop-filter: blur(20px);
    }





/*
    .form-control-custom-1 {
        display: block;
        width: 100%;
        height: calc(2.25rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #ffffff;
        background-color: #ffffff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        box-shadow: inset 0 0 0 rgba(0, 0, 0, 0);
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        background-color: rgb(255 255 255 / 30%);
        -webkit-backdrop-filter: blur(20px);
        backdrop-filter: blur(20px);
    }
    .tippy-box[data-theme~='tooltip-cmdlt-primary'] {
        background-color: var(--primary);
        color: white;
    }

    .tippy-box[data-theme~='tooltip-cmdlt-primary'][data-placement^='top']>.tippy-arrow::before {
        border-top-color: var(--primary);
    }

    .tippy-box[data-theme~='tooltip-cmdlt-primary'][data-placement^='bottom']>.tippy-arrow::before {
        border-bottom-color: var(--primary);
    }

    .tippy-box[data-theme~='tooltip-cmdlt-primary'][data-placement^='left']>.tippy-arrow::before {
        border-left-color: var(--primary);
    }

    .tippy-box[data-theme~='tooltip-cmdlt-primary'][data-placement^='right']>.tippy-arrow::before {
        border-right-color: var(--primary);
    }


    .text-shadow {
        text-shadow: 2px 2px 5px rgba(43, 19, 12, 0.50);
    }

    .column-1 {
        min-width: 90px;
        font-size: 1.5rem;
            font-weight: 500;

    }

    .column-2 {
        font-size: 2rem;
            font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        width: 70px;

    }

    .shadow-bottom {
        box-shadow: 0px 23px 12px -20px rgba(107, 107, 107, 1);
        -webkit-box-shadow: 0px 23px 12px -20px rgba(107, 107, 107, 1);
        -moz-box-shadow: 0px 23px 12px -20px rgba(107, 107, 107, 1);
    }


    .arrow-right {
        width: 0;
        height: 0;
        border-top: 15px solid transparent;
        border-bottom: 15px solid transparent;
        border-left: 15px solid rgb(255 255 255 / 30%);
    }


    .bed-on {
        opacity: 1
    }

    .bed-off {
        opacity: 0.1
    }

    .badge {
        width: 40px;
        color: white;
        border: 1px solid #ffffff;
        font-size: 1rem;
    }




    .glassmod-effect {
        background-color: rgb(255 255 255 / 30%);
        backdrop-filter: blur(20px);
    }
    .glassmod-effect:hover {
        background-color: rgb(82 82 82 / 30%);
        -webkit-backdrop-filter: blur(20px);
        backdrop-filter: blur(20px);
        cursor:pointer;
    }
    .rotate-in-ver {
        -webkit-animation: rotate-in-ver .5s cubic-bezier(.25, .46, .45, .94) both;
        animation: rotate-in-ver .5s cubic-bezier(.25, .46, .45, .94) both
    }

    @-webkit-keyframes rotate-in-ver {
        0% {
            -webkit-transform: rotateY(-360deg);
            transform: rotateY(-360deg);
            opacity: 0
        }

        100% {
            -webkit-transform: rotateY(0deg);
            transform: rotateY(0deg);
            opacity: 1
        }
    }

    @keyframes rotate-in-ver {
        0% {
            -webkit-transform: rotateY(-360deg);
            transform: rotateY(-360deg);
            opacity: 0
        }

        100% {
            -webkit-transform: rotateY(0deg);
            transform: rotateY(0deg);
            opacity: 1
        }
    }

    .scale-in-ver-top {
        -webkit-animation: scale-in-ver-top .5s cubic-bezier(.25, .46, .45, .94) both;
        animation: scale-in-ver-top .5s cubic-bezier(.25, .46, .45, .94) both
    }

    @-webkit-keyframes scale-in-ver-top {
        0% {
            -webkit-transform: scaleY(0);
            transform: scaleY(0);
            -webkit-transform-origin: 100% 0;
            transform-origin: 100% 0;
            opacity: 1
        }

        100% {
            -webkit-transform: scaleY(1);
            transform: scaleY(1);
            -webkit-transform-origin: 100% 0;
            transform-origin: 100% 0;
            opacity: 1
        }
    }

    @keyframes scale-in-ver-top {
        0% {
            -webkit-transform: scaleY(0);
            transform: scaleY(0);
            -webkit-transform-origin: 100% 0;
            transform-origin: 100% 0;
            opacity: 1
        }

        100% {
            -webkit-transform: scaleY(1);
            transform: scaleY(1);
            -webkit-transform-origin: 100% 0;
            transform-origin: 100% 0;
            opacity: 1
        }
    }

    .scale-in-hor-left {
        -webkit-animation: scale-in-hor-left .5s cubic-bezier(.25, .46, .45, .94) both;
        animation: scale-in-hor-left .5s cubic-bezier(.25, .46, .45, .94) both
    }

    @-webkit-keyframes scale-in-hor-left {
        0% {
            -webkit-transform: scaleX(0);
            transform: scaleX(0);
            -webkit-transform-origin: 0 0;
            transform-origin: 0 0;
            opacity: 1
        }

        100% {
            -webkit-transform: scaleX(1);
            transform: scaleX(1);
            -webkit-transform-origin: 0 0;
            transform-origin: 0 0;
            opacity: 1
        }
    }

    @keyframes scale-in-hor-left {
        0% {
            -webkit-transform: scaleX(0);
            transform: scaleX(0);
            -webkit-transform-origin: 0 0;
            transform-origin: 0 0;
            opacity: 1
        }

        100% {
            -webkit-transform: scaleX(1);
            transform: scaleX(1);
            -webkit-transform-origin: 0 0;
            transform-origin: 0 0;
            opacity: 1
        }
    }

    .vh-100 {
        height: 100vh;
    }
    .row_counter_user div:nth-child(1){
        width:15px;
        text-align:center;
    }
    .row_counter_user div:nth-child(2){
        width:30px;
        text-align:center;
    }
    .rounded-pill-1 {
        border-radius: 20px;
    }
    .rounded-top-pill {
        border-top-right-radius: 20px;
        border-top-left-radius: 20px;
    }

    .rounded-bottom-pill {
        border-bottom-right-radius: 20px;
        border-bottom-left-radius: 20px;
    }
    .total-icon {
        font-size: 3em;
    }



        .total-title {
            font-size: 1rem;
            font-weight: 700;
        }
        .total-counter{
            line-height: 1;
        }

    .total-counter,
    .total-counter-hp,
    .total-counter-uti {
        min-width: 70px;
    }
    @media (max-width: 576px) {
        header .img-logo {
            height: 40px;
            width: auto;
        }
        .header-titles {
            font-size: 1rem;
        }

        .piso-height {
            height: auto;
        }



        .total-counter,
        .total-counter-hp,
        .total-counter-uti {
            font-size: 4rem;
            line-height: 1;
        }

        header .h1 {
            font-size: 1rem !important;
        }

        header .h3 {
            font-size: 1rem !important;
        }


    }

    @media (min-width: 576px) {
        header .img-logo {
            height: 60px;
                width: 130px;
        }
        .piso-height {
            height: auto;
        }
        .header-titles {
            font-size: 1.5rem;
        }




        .total-title {
            font-size: 1rem;
            font-weight: 700;
        }

        .total-counter,
        .total-counter-hp,
        .total-counter-uti {
            font-size: 4rem;

        }
        .pc-cama_ocupada,
        .fa-bed {
            font-size: 0.6rem;
        }
        header .h1 {
            font-size: 2rem !important;
        }

        header .h3 {
            font-size: 2rem !important;
        }
    }

    @media (min-width: 992px) {

        .header-titles {
            font-size: 1.5rem;
        }
    }

    .total-btn:hover{
        background-color: var(--gray);
        color:var(--primary);
        cursor:pointer;
    }
      .valign-middle {
        vertical-align: middle !important;
      }
      .h-100{
        height:100vh !important;
      }
      .img-user-size {
          width: 40px;
          height: 40px;
          border-radius: 50%;
      }
      .img-logo {
          height: 60px;
          width: 130px;
      }
      .btn-user-home button {
        background-color: transparent;
        display: flex;
        color: white;
        align-items: center;
        border: 0px;
      }*/
</style>
