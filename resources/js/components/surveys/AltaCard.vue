<template>
    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 col-xxl-2 py-1 d-flex">
        <div class="col-12 rounded-xl" :class="{
            'bg-light-danger': surveyAnswered(predischarged) ? false : true,
            'bg-light-success': surveyAnswered(predischarged) ? true : false
        }">
            <div class="row">
                <div class="col-3 big-icon">
                    <i :class="big_icon"></i>
                </div>
                <div class="col-9 text-center align-self-center text-secondary">
                        <span class="ubicacion" >{{predischarged.habitacion}}</span>
                </div>
            </div>
            <hr class="dropdown-divider">
            <div class="row">
                <div class="col-12 name">
                    {{ predischarged.paciente }}
                </div>
            </div>
            <div class="row">
                <div class="col-12 cedula">
                    {{ predischarged.cedula }}
                </div>
            </div>
            <hr class="dropdown-divider">
            <div class="row align-items-end">
                <button
                    type="button"
                    class="btn btn-flat btn-block buttom-rounded-xl"
                    :class="{
                        'btn-danger': predischarged.fecha_del_alta === today ? true : false,
                        // 'btn-warning': predischarged.fecha_del_alta === tomorrow ? true : false,
                        // 'btn-primary': predischarged.fecha_del_alta !== today && predischarged.fecha_del_alta !== tomorrow ? true : false,
                        'btn-primary': predischarged.fecha_del_alta !== today ? true : false,
                    }"
                    :disabled="predischarged.fecha_del_alta === today ? true : false"
                    @click="setPreAltaToday(predischarged)"
                >
                <span v-if="predischarged.fecha_del_alta === today">Alta programada para hoy</span>
                <!-- <span v-else-if="predischarged.fecha_del_alta === tomorrow">Alta programada para mañana</span> -->
                <span v-else>Programar alta para hoy</span>
                </button>
            </div>
        </div>
    </div>

</template>

<script>

export default {
    props: ["predischarged","big_icon","today","tomorrow","get_pre_alta","get_hospitalizados"],
    data() {
        return {
            disabled: false
        };
    },
    methods: {
        surveyAnswered(currentPredischarged){
            if(currentPredischarged.discharged_id === null){
                return false;
            }else{
                return true;
            }
        },
        setPreAltaToday(currentPredischarged){
            // creo el discharged y la relación con la encuesta
            Swal.fire({
                title: '¿Le fue informado que el paciente '+currentPredischarged.paciente+' se le dará de alta el día de hoy?',
                text: "cambiará el estatus del paciente ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, el paciente saldrá hoy de alta!',
                cancelButtonText: 'No estoy seguro'
                }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .post(window.location.origin + "/setDischargedToday", {
                            episodio_id: currentPredischarged.episodio_id,
                        })
                        .then((res) => {
                            // mensaje de éxito
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: res.data.message,
                                showConfirmButton: false,
                                timer: 2500
                            })
                            this.get_pre_alta()
                            this.get_hospitalizados()
                        })
                        .catch((error) => {
                            Swal.showValidationMessage(
                                `Hubo algún error creando el Discharged.`
                            );
                        });
                }
            })
        },
    },
    mounted() {
    },
};
</script>
<style scoped>
.big-icon {
    font-size: 2.5em;
    text-align: right;
    color: var(--primary);
}
.ubicacion {
    font-size: 1.3em;
    text-align: center;
}
.name {
    font-size: 1.3em;
    font-weight: bold;
    text-align: center;
    color: var(--secondary);
}
.cedula {
    font-size: 1em;
    font-weight: bold;
    text-align: center;
    color: var(--secondary);
}
.rounded-xl {
    border-radius: 1.5rem;
    /* border-radius: 10% / 50%; */
    /* min-height: 310px; */
}
.buttom-rounded-xl{
    /* background-color: rgb(0,0,0,0.15) !important; */
    border-bottom-left-radius: 1.5rem;
    border-bottom-right-radius: 1.5rem;
}
.icono-mano:hover {
  cursor: pointer;
}
.bg-light-success {
    background-color:rgb(0,0,0,0.05) !important ;
    border-left: solid;
    border-left-width: 0.5rem;
    border-left-color: var(--green);
}
.bg-light-danger {
    background-color:rgb(0,0,0,0.05) !important ;
    border-left: solid;
    border-left-width: 0.5rem;
    border-left-color: rgb(255,0,0);
}
.nav-link.active {
  background-color: red !important;
}

</style>
