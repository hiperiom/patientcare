<template>
    <div class="container-fluid">
        <div class="d-flex bd-highlight mb-3">
            <div>
                <button type="button" class="btn mt-2" :class="{
                    'btn-primary': today === true ? true : false,
                    'btn-grisclaro': today === false ? true : false,
                    }"
                    @click="setAlta">
                    PACIENTES CON ALTA MÉDICA <span class="badge bg-white text-black">{{ pacientesAlta }}</span>
                </button>
                <button type="button" class="btn mt-2" :class="{
                    'btn-primary': tomorrow === true ? true : false,
                    'btn-grisclaro': tomorrow === false ? true : false,
                    }"
                    @click="setPreAlta">
                    PACIENTES CON PRE-ALTA <span class="badge bg-white text-black">{{ pacientesPreAlta }}</span>
                </button>
            </div>
            <div class="ms-auto">
                <button type="button" class="btn mt-2 btn-primary"
                    data-bs-toggle="modal" data-bs-target="#hospitalizadosModal">
                    AGREGAR PACIENTE <i class="fas fa-user-plus"></i>
                </button>
            </div>
        </div>
        <div v-if="today">
            <ul
                class="nav nav-pills nav-justified mt-4"
                id="pills-tab"
                role="tablist"
            >
                <li
                    v-for="(alta, index) in listaAlta"
                    :key="index"
                    class="nav-item"
                    role="presentation"
                >
                    <button
                        class="nav-link"
                        :class="{ active: index === 0 ? true : false }"
                        :id="'pills-' + pisos[index] + '-tab'"
                        data-bs-toggle="pill"
                        :data-bs-target="'#pills-' + pisos[index]"
                        type="button"
                        role="tab"
                        :aria-controls="'pills-' + pisos[index]"
                        aria-selected="true"
                    >
                       <h4>{{ pisos[index] }}</h4>

                        <span
                            class="badge bg-white text-black"
                            >{{ alta.length }}
                        </span>
                    </button>
                </li>
            </ul>
            <div class="tab-content mt-3" id="pills-tabContent">
                <div
                    v-for="(alta, index) in listaAlta"
                    :key="index"
                    class="tab-pane fade"
                    :class="{ 'show active': index === 0 ? true : false }"
                    :id="'pills-' + pisos[index]"
                    role="tabpanel"
                    :aria-labelledby="'pills-' + pisos[index] + '-tab'"
                >
                    <div class="row mt-2 g-1" v-if="alta.length !== 0">
                        <pre-alta-card
                            v-for="(item, index) in alta"
                            :key="index"
                            :predischarged="item"
                            alta="true"
                            big_icon="fas fa-procedures"
                        ></pre-alta-card>
                    </div>
                    <div class="row text-center text-secondary mt-3" v-else>
                        <h5>
                            No hay pacientes con alta médica en este piso.
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="tomorrow">
            <ul
                class="nav nav-pills nav-justified mt-4"
                id="pills-tab"
                role="tablist"
            >
                <li
                    v-for="(preAlta, index) in listaPreAlta"
                    :key="index"
                    class="nav-item"
                    role="presentation"
                >
                    <button
                        class="nav-link"
                        :class="{ active: index === 0 ? true : false }"
                        :id="'pills-' + pisos[index] + '-tab'"
                        data-bs-toggle="pill"
                        :data-bs-target="'#pills-' + pisos[index]"
                        type="button"
                        role="tab"
                        :aria-controls="'pills-' + pisos[index]"
                        aria-selected="true"
                    >
                        <h4>{{ pisos[index] }}</h4>

                        <span
                            class="badge bg-white text-black"
                            >{{ preAlta.length }}
                        </span>
                    </button>
                </li>
            </ul>
            <div class="tab-content mt-3" id="pills-tabContent">
                <div
                    v-for="(preAlta, index) in listaPreAlta"
                    :key="index"
                    class="tab-pane fade"
                    :class="{ 'show active': index === 0 ? true : false }"
                    :id="'pills-' + pisos[index]"
                    role="tabpanel"
                    :aria-labelledby="'pills-' + pisos[index] + '-tab'"
                >
                    <div class="row mt-2 g-1" v-if="preAlta.length !== 0">
                        <pre-alta-card
                            v-for="(item, index) in preAlta"
                            :key="index"
                            :predischarged="item"
                            alta="false"
                            big_icon="fas fa-procedures"
                        ></pre-alta-card>
                    </div>
                    <div class="row text-center text-secondary mt-3" v-else>
                        <h5>
                            No hay pacientes con pre-alta médica en este piso.
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal lista hospitalizados-->
        <div class="modal fade" id="hospitalizadosModal" tabindex="-1" aria-labelledby="hospitalizadosModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="hospitalizadosModalLabel">Pacientes hospitalizados actualmente <span class="badge bg-primary">{{ pacientesHospitalizados }}</span></h4>
            </div>
            <div class="modal-body">
                <div>
                    <ul
                    class="nav nav-pills nav-justified mt-4"
                    id="pills-tab"
                    role="tablist"
                    >
                        <li
                            v-for="(hospitalizados, index) in listaHospitalizados"
                            :key="index"
                            class="nav-item"
                            role="presentation"
                        >
                            <button
                                class="nav-link"
                                :class="{ active: index === 0 ? true : false }"
                                :id="'pills-' + pisos[index] + '-hos-tab'"
                                data-bs-toggle="pill"
                                :data-bs-target="'#pills-' + pisos[index] + '-hos'"
                                type="button"
                                role="tab"
                                :aria-controls="'pills-' + pisos[index]"
                                aria-selected="true"
                            >
                               <h4>{{ pisos[index] }}</h4>

                                <span
                                    class="badge bg-white text-black"
                                    >{{ hospitalizados.length }}
                                </span>
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content mt-3" id="pills-tabContent">
                        <div
                            v-for="(hospitalizados, index) in listaHospitalizados"
                            :key="index"
                            class="tab-pane fade"
                            :class="{ 'show active': index === 0 ? true : false }"
                            :id="'pills-' + pisos[index] + '-hos'"
                            role="tabpanel"
                            :aria-labelledby="'pills-' + pisos[index] + '-hos-tab'"
                        >
                            <div class="row mt-2 g-1" v-if="hospitalizados.length !== 0">
                                <alta-card
                                    v-for="(item, index) in hospitalizados"
                                    :key="index"
                                    :predischarged="item"
                                    big_icon="fas fa-procedures"
                                    :today="hoy"
                                    :tomorrow="manana"
                                    :get_pre_alta="getPreAlta"
                                    :get_hospitalizados="getHospitalizados"
                                ></alta-card>
                            </div>
                            <div class="row text-center text-secondary mt-3" v-else>
                                <h5>
                                    No hay pacientes hospitalizados en este piso.
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Regresar</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>

<style scoped>
.nav-link{
    background-color:rgb(0,0,0,0.3) ;
    border-radius: 0px;
    color: white;
}
.nav-link.active{
    background-color: var(--primary);
    border-radius: 0px;
    color: white;
}
.btn-grisclaro{
    background-color:rgb(0,0,0,0.3) ;
    color: white;
}
</style>

<script>
export default {
    props: [],
    data() {
        return {
            today: true,
            listaAlta: [],
            pacientesAlta: 0,
            tomorrow: false,
            listaPreAlta: [],
            pacientesPreAlta: 0,
            listaHospitalizados: [],
            pacientesHospitalizados: 0,
            hoy: `${new Date().getFullYear()}-${new Date().getMonth() + 1}-${new Date().getDate() < 10 ? '0'+ new Date().getDate() : new Date().getDate()} 00:00:00`,
            manana: `${new Date().getFullYear()}-${new Date().getMonth() + 1}-${new Date().getDate()+1 < 10 ? '0'+ (new Date().getDate()+1) : new Date().getDate()+1} 00:00:00`,
            pisos: ["HP2", "HP3", "HP4", "HP5", "HP6"],
        };
    },
    methods: {
        setAlta(){
            this.today = true
            this.tomorrow = false

        },
        setPreAlta(){
            this.today = false
            this.tomorrow = true
        },
        getPreAlta() {
            axios
                .post(window.location.origin + "/surveyInsitu", {})
                .then((res) => {
                    this.listaAlta = [];
                    this.pacientesAlta = 0
                    this.listaPreAlta = [];
                    this.pacientesPreAlta = 0;

                    // lleno la lista de alta (salen hoy)
                    this.listaAlta.push(res.data.alta.HP2);
                    this.listaAlta.push(res.data.alta.HP3);
                    this.listaAlta.push(res.data.alta.HP4);
                    this.listaAlta.push(res.data.alta.HP5);
                    this.listaAlta.push(res.data.alta.HP6);
                    // lleno la lista de prealta (salen mañana)
                    this.listaPreAlta.push(res.data.pre_alta.HP2);
                    this.listaPreAlta.push(res.data.pre_alta.HP3);
                    this.listaPreAlta.push(res.data.pre_alta.HP4);
                    this.listaPreAlta.push(res.data.pre_alta.HP5);
                    this.listaPreAlta.push(res.data.pre_alta.HP6);
                    // cuento los pacientes en alta
                    this.pacientesAlta += res.data.alta.HP2.length;
                    this.pacientesAlta += res.data.alta.HP3.length;
                    this.pacientesAlta += res.data.alta.HP4.length;
                    this.pacientesAlta += res.data.alta.HP5.length;
                    this.pacientesAlta += res.data.alta.HP6.length;
                    //cuento los pacientes en pre-alta
                    this.pacientesPreAlta += res.data.pre_alta.HP2.length;
                    this.pacientesPreAlta += res.data.pre_alta.HP3.length;
                    this.pacientesPreAlta += res.data.pre_alta.HP4.length;
                    this.pacientesPreAlta += res.data.pre_alta.HP5.length;
                    this.pacientesPreAlta += res.data.pre_alta.HP6.length;

                    document
                        .getElementById("loadingScreen")
                        .classList.add("d-none");
                })
                .catch((error) => {
                    console.log(
                        `Hubo algún error cargando los pacientes... `,error
                    );
                    document
                        .getElementById("loadingScreen")
                        .classList.add("d-none");
                });
        },
        getHospitalizados() {
            axios
                .post(window.location.origin + "/pacientesHospitalizados", {})
                .then((res) => {
                    // console.log(res)
                    this.listaHospitalizados = []
                    this.pacientesHospitalizados = 0

                    // lleno la lista de pacientes hospitalizados
                    this.listaHospitalizados.push(res.data.HP2);
                    this.listaHospitalizados.push(res.data.HP3);
                    this.listaHospitalizados.push(res.data.HP4);
                    this.listaHospitalizados.push(res.data.HP5);
                    this.listaHospitalizados.push(res.data.HP6);
                    // cuento los pacientes hospitalizados
                    this.pacientesHospitalizados += res.data.HP2.length;
                    this.pacientesHospitalizados += res.data.HP3.length;
                    this.pacientesHospitalizados += res.data.HP4.length;
                    this.pacientesHospitalizados += res.data.HP5.length;
                    this.pacientesHospitalizados += res.data.HP6.length;
                })
                .catch((error) => {
                    console.log(
                        `Hubo algún error cargando los pacientes hospitalizados... `,error
                    );
                    document
                        .getElementById("loadingScreen")
                        .classList.add("d-none");
                });
        },
    },
    mounted() {
        this.getPreAlta();
        this.getHospitalizados();
    },
};
</script>
