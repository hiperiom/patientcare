<template>
    <div class="dropdown">
        <button @click="create()" :id="propName + '_' + patient_data.user_id" class="btn btn-default p-1" type="button"
            aria-haspopup="true" aria-expanded="false">
            <i
                :class="[icon, ('text-' + getColor), { 'text-info': Number(riesgo_value) === 1 }, { 'text-info-disabled': Number(riesgo_value) === 0 }]"></i>
        </button>

    </div>
</template>

<script>
export default {
    name: "RiesgoVipDropdown",
    props: {
        patient_data: Object,
        index: Number,
    },
    data() {
        return {
            //index: null,
            icon: "pc-paciente_vip",
            title: "VIP",
            propName: "vip",
            riesgo_coment: "",
            riesgo_value: 0,
            riesgo_color: "",
            item: []
        }
    },
    computed: {
        getTooltipMessage() {
            return /*html*/`
                        <b>
                            <i class='${this.icon}'></i>
                            ${this.title}:
                        </b>
                        <small class="${[null, 'null', undefined, 'undefined', ''].includes(this.patient_data[this.propName]) || [null, 'null', undefined, 'undefined', ''].includes(this.patient_data[this.propName + '_description']) ? 'd-none' : ''}">
                            <br>
                            ${this.patient_data[this.propName + '_description']}
                        </small>
                    `
        },
        getColor() {
            return 'info'
            /* if (Number(this.patient_data[this.propName]) === 3 || this.patient_data[this.propName] === null) {
                return 'success'
            }
            if (Number(this.patient_data[this.propName]) === 2) {
                return 'warning'
            }
            if (Number(this.patient_data[this.propName]) === 1) {
                return 'danger'
            } */

        },

    },
    methods: {

        have_item() {
            if (this.patient_data[this.propName] !== null) {
                this.riesgo_value = Number(this.patient_data[this.propName])
                this.riesgo_coment = this.patient_data[this.propName + '_description']
            } else {
                this.riesgo_value = 0
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
        async store() {



            this.riesgo_coment = document.getElementById('coment').value
            let formData = new FormData();
            formData.append("episodio_id", this.patient_data.episodio_id)
            formData.append("value", this.riesgo_value)
            formData.append("user_id_paciente", this.patient_data.user_id)
            formData.append("description", !is_empty(this.riesgo_coment) ? this.riesgo_coment : null)
            formData.append("created_at", timestamps())
            formData.append("_token", $("#_token").val())
            let model = await post(location.origin + "/user_vip/store", formData)
            this.riesgo_value = Number(model.value)
            console.log(model);
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
        create() {
            let that = this
            $("#messageModal").modal("show")
            $("#messageModal .modal-body").html(this.view1());
            document.getElementById('submit').addEventListener("click", (e) => {
                that.store()
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
