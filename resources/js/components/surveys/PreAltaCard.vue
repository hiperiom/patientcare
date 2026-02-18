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
            <div class="row">
                <div v-if="alta === 'false'" class="col-12 text-center text-secondary">
                    <h6>Fecha posible del alta | {{new Date(predischarged.fecha_del_alta).toLocaleDateString('es-VE')}}</h6>
                </div>
            </div>

            <div v-if="alta === 'true'" class="row align-items-end">
                <!-- <button
                    type="button"
                    class="btn btn-flat btn-block buttom-rounded-xl"
                    :class="{
                        'btn-primary': surveyAnswered(predischarged) ? false : true,
                        'btn-secondary': surveyAnswered(predischarged) ? true : false,
                    }"
                    :disabled="surveyAnswered(predischarged)"
                    @click="answer_survey(predischarged)"
                >
                <span v-show="!surveyAnswered(predischarged)">Responder encuesta</span>
                <span v-show="surveyAnswered(predischarged)">Encuesta respondida</span>
                </button> -->
                <button
                    type="button"
                    :class="['btn btn-flat btn-block buttom-rounded-xl btn-primary']"
                    @click="answer_survey(predischarged)"
                >
                <span>Responder encuesta</span>

                </button>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    props: ["predischarged","big_icon","alta"],
    data() {
        return {
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
        answer_survey(currentPredischarged){
            // creo el discharged y la relación con la encuesta

            Swal.fire({
                title: '¿'+currentPredischarged.paciente+' está de acuerdo a responder la encuesta en este momento?',
                text: "debe preguntar al paciente si está de acuerdo de responder la encuesta de inmediato...",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Sí, está de acuerdo!',
                showDenyButton: true,
                denyButtonText: `Código QR`,
                denyButtonColor: 'green',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                cancelButtonText: 'No está de acuerdo',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                    .post(window.location.origin + "/discharged/storeInsitu", {
                        episodio_id: currentPredischarged.episodio_id,
                        fecha_del_alta: currentPredischarged.fecha_del_alta
                    })
                    .then((res) => {
                        // se envía la encuesta
                        window.location.replace(window.location.origin+'/surveys/'+res.data.survey_id+'/'+res.data.token+'/3');
                    })
                    .catch((error) => {
                        Swal.showValidationMessage(
                            `Hubo algún error creando el Discharged.`
                        );
                    });
                } else if(result.isDenied){
                    axios
                    .post(window.location.origin + "/discharged/storeInsitu", {
                            episodio_id: currentPredischarged.episodio_id,
                            fecha_del_alta: currentPredischarged.fecha_del_alta
                        })
                        .then((res) => {
                            // se muestra el QR de la encuesta
                            Swal.fire({
                                html: "<div class='d-flex justify-content-center align-items-center pt-3' id='qrcode'></div> <br> <span>El paciente debe escanear el código QR para comenzar la encuesta.</span>",
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Volver al listado',
                                didRender: () => {new QRCode(document.getElementById("qrcode"), {
                                    text: window.location.origin+'/surveys/'+res.data.survey_id+'/'+res.data.token+'/3',
                                    width: 150,
                                    height: 150,
                                    colorDark : "#3085d6",
                                    colorLight : "#ffffff",
                                    correctLevel : QRCode.CorrectLevel.H
                                });},
                                didClose: () => {
                                    currentPredischarged.discharged_id = res.data.discharged_id
                                }
                            });
                        })
                        .catch((error) => {
                            Swal.showValidationMessage(
                                `Hubo algún error creando el Discharged.`
                            );
                        });
                }
            })

        }
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
