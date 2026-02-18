<template>
    <div class="d-flex rounded align-items-center shadow-sm mb-1">
        <div class="flex-shrink-1  btn-group">
            <button 
                v-if="!h_fin" 
                :title="title"
                :class="['btn  mr-1 btn-outline-' + color + ' text-nowrap font-weight-bold border-0 btn-sm px-1']"
                type="button" :id="'triggerId' + name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                style="font-size: 1rem;">
                <i class="pc-medico"></i>
            </button>
            <div @click="dropdownStop" class="dropdown-menu dropdown-menu-left p-1"
                :aria-labelledby="'triggerId' + name">
                <h6 :style="{ 'color': 'var(--' + color + ')' }" class="dropdown-header">
                    <i class="pc-medico"></i> {{ title }}
                </h6>
                <div class="d-flex flex-column">
                    <input @keypress="filterValues()" :ref="'searchInput' + user_id_paciente" type="text"
                        class="form-control mb-1">
                    <div class="list-group overflow-auto" :ref="'myList' + user_id_paciente" style="max-height:200px">

                        <a href="#" v-for="(item, index) in $store.state.personal_salud" :key="index + name"
                            :data-user_id="item.user_id" @click="handleAddPersonal(item.user_id)"
                            :class="['list-group-item p-1 list-group-item-action', getActiveColor(item)]">
                            {{ item.medico }}
                        </a>

                    </div>

                </div>
            </div>
        </div>
        <div class="flex-grow-1 pr-1">

            <ul class="list-group  list-group-flush p-0">
                <!-- CUANDO ESTA LLENO -->
                <li v-if="getPersonal(name) !== undefined"
                    :title="'Registrado por: ' + getPersonal(name).registrado_por"
                    class="list-group-item  text-nowrap d-flex justify-content-between align-items-center p-0">
                    <div class="text-secondary">
                        <span :class="['font-weight-bold mr-1 text-' + color]" style="font-size: 1rem;">{{ siglas
                            }}</span>
                        {{ getPersonal(name).personal }}
                    </div>
                    <!--  :data-id="item.id" :data-index="index" -->
                    <button 
                        v-if="!h_fin" 
                        @click="handleDestroyPersonal()"
                        class="btn btn-default btn-sm ml-1 border-0 text-secondary"
                    >
                        <i class="fas fa-times"></i>
                    </button>
                </li>
                <!-- CUANDO ESTA VACIO -->
                <li v-else class="list-group-item  text-nowrap d-flex align-items-center p-0" style="width: 200px;">
                    <div :class="['text-' + color]">
                        <span class="font-weight-bold mr-1" style="font-size: 1rem;">{{ siglas }}</span>
                    </div>

                </li>
            </ul>

        </div>
    </div>
</template>

<script>
    import { is_empty, is_undefined, post } from '../../../../../helpers/customHelpers';
    export default {
        props: [
            'index_dia',
            'index_solicitud',
            'h_fin',
            'n_quirofano',
            'user_id_paciente',
            'solicitud_quirofano_id',
            'personal_asistencial',
            'siglas',
            'color',
            'title',
            'name',
        ],
        name: "TodolistDropdownWithFilter2",
        methods: {
            getActiveColor(item) {
                let result = this.personal_asistencial.some(x => x?.user_id === Number(item.user_id) && x?.tipo_personal === this.name)
                return result ? 'active-' + this.color : ''
            },
            filterValues() {
                let searchInput = this.$refs["searchInput" + this.user_id_paciente];

                let searchText = searchInput.value.toLowerCase();
                let listItems = this.$refs[`myList${this.user_id_paciente}`].querySelectorAll("a");
                listItems.forEach(function (item) {
                    let itemText = item.textContent.toLowerCase();
                    item.style.display = itemText.includes(searchText) ? "block" : "none";
                });

            },
            getPersonal(tipo_personal) {

                return this.personal_asistencial.find(x => x?.tipo_personal === tipo_personal)
            },
            async handleDestroyPersonal() {
                let id = this.getPersonal(this.name).id
                let formData = new FormData();
                formData.append("id", id)
                formData.append("field", 'active')
                formData.append("value", 0)
                formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'))

                let result = await post(location.origin + `/areaQuirofano/personal_asistencial/destroy`, formData)

                let newData = this.$store.state.listadoSolicitudesQx[this.index_dia].dias[this.index_solicitud].personal_asistencial.filter(x => x.tipo_personal !== this.name)
                this.$store.commit(
                    'updateSolicitudQx2',
                    [
                        this.index_dia,
                        this.index_solicitud,
                        'personal_asistencial',
                        newData
                    ]
                )

            },
            async handleAddPersonal(user_id_medico) {
                this.user_id_medico = user_id_medico
                if (
                    this.personal_asistencial.some(x => x?.user_id === Number(this.user_id_medico) && x?.tipo_personal === this.name)
                ) {
                    alert("Ya has seleccionado a esta persona")
                    this.user_id_medico = ""
                    return false
                }

                try {
                    let formData = new FormData();
                    formData.append("cat_quirofano_id", this.n_quirofano)
                    formData.append("user_id", this.user_id_medico)
                    formData.append("tipo_personal", this.name)
                    formData.append("solicitud_quirofano_id", this.solicitud_quirofano_id)
                    formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'))

                    let result = await post(location.origin + `/areaQuirofano/personal_asistencial/create`, formData)

                    let newData = this.$store.state.listadoSolicitudesQx[this.index_dia].dias[this.index_solicitud].personal_asistencial.filter(x => x?.tipo_personal !== this.name)

                    newData.push(result)

                    this.$store.commit(
                        'updateSolicitudQx2',
                        [
                            this.index_dia,
                            this.index_solicitud,
                            'personal_asistencial',
                            newData
                        ]
                    )
                    this.user_id_medico = ""

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Personal asignado exitosamente.',
                        showConfirmButton: false,
                        timer: 1500
                    })

                } catch (error) {
                    console.log(error)
                }



            },

            dropdownStop(e) {
                e.stopPropagation();
            },


        },
        mounted() {

        }
    }
</script>

<style lang="scss" scoped>

    .list-group>a.active-success {
        z-index: 2;
        color: #ffffff;
        background-color: var(--success);
        border-color: var(--success);
    }

    .list-group>a.active-primary {
        z-index: 2;
        color: #ffffff;
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .list-group>a.active-secondary {
        z-index: 2;
        color: #ffffff;
        background-color: var(--secondary);
        border-color: var(--secondary);
    }

    .btn-link:hover {
        background-color: rgb(236, 236, 236);
    }

    .btn-purple {
        color: white;
        background-color: var(--purple);
        border-color: var(--purple);
        box-shadow: none;
    }

    .list-group-item-empty {
        position: relative;
        display: block;
        background-color: transparent;
        /*border: 2px dashed rgba(0, 0, 0, 0.125);*/
        text-align: center;
        color: var(--secondary);
        border-radius: 0.25rem;
    }
</style>
