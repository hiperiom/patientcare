<template>
    <div class="dropdown">
        <button
            :id="propName + '_' + patient_data.user_id"
            class="btn btn-default p-1 "
            type="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
        >
            <i
                :class="[icon, ('text-' + getColor), { 'ping-2': riesgo_value == 1 }, { 'ping': riesgo_value == 2 }]"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a @click="create(3)" href="#" :class="[{ 'active': riesgo_value == 3 }, 'dropdown-item']">
                <span :class="[icon, 'text-success']"></span>
                Estable
            </a>
            <a @click="create(2)" href="#" :class="[{ 'active': riesgo_value == 2 }, 'dropdown-item']">
                <span :class="[icon, 'text-warning']"></span>
                Intermedio
            </a>
            <a @click="create(1)" href="#" :class="[{ 'active': riesgo_value == 1 }, 'dropdown-item']">
                <span :class="[icon, 'text-danger']"></span>
                De cuidado
            </a>
        </div>
    </div>
</template>

<script>
export default {
    name: "RiesgoResbalarDropdown",
    props:{
        patient_data:Object,
        index:Number,
    },
    data() {
        return {
            //index: null,
            icon: "pc-resbalar",
            title: "Riesgo de caida",
            propName: "resbalar",
            riesgo_coment: "",
            riesgo_value: 3,
            riesgo_color: "success",
            item: []
        }
    },
    computed: {
        getTooltipMessage() {

            let riesgo = ""
            if (this.patient_data[this.propName] == "3" || this.patient_data[this.propName] === null) {
                riesgo = 'Estable'
            }
            if (this.patient_data[this.propName] == "2") {
                riesgo = 'Intermedio'
            }
            if (this.patient_data[this.propName] == "1") {
                riesgo = 'De cuidado'
            }
            return /*html*/`
                        <b>
                            <i class='${this.icon}'></i>
                            ${this.title}:
                        </b>
                        ${riesgo}
                        <small class="${[null, 'null', undefined, 'undefined', ''].includes(this.patient_data[this.propName]) || [null, 'null', undefined, 'undefined', ''].includes(this.patient_data[this.propName + '_description']) ? 'd-none' : ''}">
                            <br>
                            ${this.patient_data[this.propName + '_description']}
                        </small>
                    `
        },
        getColor() {
            if (this.patient_data[this.propName] == "3" || this.patient_data[this.propName] === null) {
                return 'success'
            }
            if (this.patient_data[this.propName] == "2") {
                return 'warning'
            }
            if (this.patient_data[this.propName] == "1") {
                return 'danger'
            }

        },
    },
    methods: {

        have_item() {
            if (this.patient_data[this.propName] !== null) {
                this.riesgo_value = Number(this.patient_data[this.propName])
                this.riesgo_coment = this.patient_data[this.propName + '_description']
            } else {
                this.riesgo_value = "3"
                this.riesgo_coment = null
            }
            this.activateTooltip()
        },
        view1() {
            return /*html */`
                        <div class="container-fluid py-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea
                                        class="form-control"
                                        placeholder="Escribe un comentario sobre tu selección. (Opcional)"
                                        rows="3"
                                        id="coment"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pt-3">
                                    <a id="submit" class="btn btn-block btn-primary"  href="#" role="button">Guardar</a>
                                </div>
                            </div>
                        </div>
                    `;
        },
        destroyTooltip() {
            let btn = document.querySelector('#' + this.propName + '_' + this.patient_data.user_id);
            if (btn._tippy !== undefined) {

                const instance = btn._tippy;
                instance.destroy()
            }
        },
        activateTooltip() {
            this.destroyTooltip()
            tippy('#' + this.propName + '_' + this.patient_data.user_id, {
                content: this.getTooltipMessage,
                theme: 'tooltip-cmdlt-' + this.getColor,
                zIndex: 200000,
                allowHTML: true,
            });
        },
        async store(value) {


            this.riesgo_value = Number(value)
            this.riesgo_coment = document.getElementById('coment').value
            let formData = new FormData();
            formData.append("episodio_id", this.patient_data.episodio_id)
            formData.append("value", this.riesgo_value)
            formData.append("user_id_paciente", this.patient_data.user_id)
            formData.append("description", !is_empty(this.riesgo_coment) ? this.riesgo_coment : null)
            formData.append("created_at", timestamps())
            formData.append("_token", $("#_token").val())
            let model = await post(location.origin + "/user_cuest_resbalar/store", formData)

            this.patient_data[this.propName] = Number(this.riesgo_value)
            this.patient_data[this.propName + '_description'] = this.riesgo_coment
            this.$store.commit('updateEpisodio',{
                index:this.index,
                fieldValue: this.patient_data,
            })
            //pacientes_datos[this.index] = this.patient_data[this.propName]
            this.have_item()
            /* Swal.fire(
                `Riesgo actualizado!`,
                `La registro se hizo correctamente.`,
                'success'
            ) */


            $("#messageModal").modal("hide")



        },
        create(value) {
            let that = this
            $("#messageModal").modal("show")
            $("#messageModal .modal-body").html(this.view1());
            document.getElementById('submit').addEventListener("click", (e) => {
                that.store(value)
            })
        },
    },
    mounted() {

        this.have_item()

    },
}
</script>

<style lang="scss" scoped>
.btn-default {
    background-color: #f8f9fa;
    border: 0px !important;
    color: #444;
}
</style>
