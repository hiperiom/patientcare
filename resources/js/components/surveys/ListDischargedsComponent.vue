<template>
    <div class="mx-2">
        <!-- El ancho de tu ventana es: {{anchoVentana}} -->

<!-- comienzo de los filtros  -->

    <div class="row">
        <div class="col-12 text-right">
            <div class="d-inline-flex p-1">
                <button class="btn btn-sm btn-outline-secondary rounded-xl ma-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDate" aria-expanded="false" aria-controls="collapseSurveys collapseDate" @click="hideCollapseSurveys()">
                    <span><i class="far fa-calendar-alt"></i></span> {{textFilterDate}}
                </button>
            </div>
            <div class="d-inline-flex p-1">
                <button class="btn btn-sm btn-outline-secondary rounded-xl ma-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSurveys" aria-expanded="false" aria-controls="collapseDate collapseSurveys" @click="hideCollapseDate()">
                    <span><i class="fas fa-poll-h"></i></span> {{textFilterSurvey}}
                </button>
            </div>
        </div>
        <div class="col-12 text-right mb-2">
            <div class="collapse" id="collapseDate">
                <div class="d-inline-flex p-1">
                    <button type="buttom" class="btn btn-sm btn-outline-secondary rounded-xl ma-2" @click="getFromTo(7,'Últimos siete días')">
                        Últimos siete días
                    </button>
                </div>
                <div class="d-inline-flex p-1">
                    <button type="buttom" class="btn btn-sm btn-outline-secondary rounded-xl ma-2" @click="getFromTo(30,'Último mes')">
                        Último mes
                    </button>
                </div>
                <div class="d-inline-flex p-1">
                    <button type="buttom" class="btn btn-sm btn-outline-secondary rounded-xl ma-2" @click="getFromTo(91,'Último trimestre')">
                        Último trimestre
                    </button>
                </div>
                <div class="d-inline-flex p-1">
                    <button type="buttom" class="btn btn-sm btn-outline-secondary rounded-xl ma-2" @click="getFromTo(182,'Último semestre')">
                        Último semestre
                    </button>
                </div>
                <div class="d-inline-flex p-1">
                    <button type="buttom" class="btn btn-sm btn-outline-secondary rounded-xl ma-2" @click="getFromTo(365,'Último año')">
                        Último año
                    </button>
                </div>
                <div class="d-inline-flex p-1">
                    <button type="buttom" class="btn btn-sm btn-outline-secondary rounded-xl ma-2" @click="getFromTo(null,'Todo el tiempo')">
                        Todo el tiempo
                    </button>
                </div>
            </div>
            <div class="collapse" id="collapseSurveys">
                <div v-for="(survey,index) in surveys" :key="index" class="d-inline-flex p-1">
                    <button  type="buttom" class="btn btn-sm btn-outline-secondary rounded-xl" @click="filterBySurvey(index)">
                        {{ survey.name.charAt(0).toUpperCase() + survey.name.slice(1) }}
                    </button>
                </div>
                <div class="d-inline-flex">
                    <button type="buttom" class="btn btn-sm btn-outline-secondary rounded-xl" @click="filterBySurvey(99)">
                        Todas
                    </button>
                </div>
            </div>
        </div>
    </div>

<!-- fin de los filtros -->

        <div class="row g-1 justify-content-end ">
            <stadistics-box
                big_icon="fas fa-hospital"
                sent_icon="fas fa-check"
                :sent="sentByInsitu"
                answered_icon="fas fa-check-double"
                :answered="answeredByInsitu"
            ></stadistics-box>
            <stadistics-box
                big_icon="far fa-envelope"
                sent_icon="fas fa-check"
                :sent="sentByEmail"
                answered_icon="fas fa-check-double"
                :answered="answeredByEmail"
            ></stadistics-box>
            <stadistics-box
                big_icon="fab fa-whatsapp"
                sent_icon="fas fa-check"
                :sent="sentByWhatsapp"
                answered_icon="fas fa-check-double"
                :answered="answeredByWhatsapp"
            ></stadistics-box>
        </div>
        <ul class="nav nav-tabs justify-content-center m-2 " id="myTab" role="tablist">
            <li class="nav-item">
                <a
                    class="nav-link active"
                    id="por-enviar-tab-2"
                    data-toggle="tab"
                    href="#por-enviar-2"
                    role="tab"
                    aria-controls="enviados-2"
                    aria-selected="true"
                    ><i class="far fa-clock text-danger"></i> <span v-show="anchoVentana > 576">Por enviar </span><span class="badge rounded-pill bg-danger">{{ toSend.length }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link"
                    id="enviados-tab"
                    data-toggle="tab"
                    href="#enviados"
                    role="tab"
                    aria-controls="enviados"
                    aria-selected="false"
                    ><i class="fas fa-check" style="color: darkorange;"></i> <span v-show="anchoVentana > 576">Enviadas </span> <span class="badge rounded-pill" style="background-color: darkorange;">{{ send.length }}</span></a
                >
            </li>
            <li class="nav-item">
                <a
                    class="nav-link"
                    id="respondidos-tab"
                    data-toggle="tab"
                    href="#respondidos"
                    role="tab"
                    aria-controls="respondidos"
                    aria-selected="false"
                    ><i class="fas fa-check-double text-success"></i> <span v-show="anchoVentana > 576">Contestadas </span> <span class="badge rounded-pill bg-success">{{ sent.length }}</span></a
                >
            </li>
            <li class="nav-item">
                <a
                    class="nav-link"
                    id="no-enviados-tab"
                    data-toggle="tab"
                    href="#no-enviados"
                    role="tab"
                    aria-controls="no-enviados"
                    aria-selected="false"
                    ><i class="fas fa-times text-secondary"></i> <span v-show="anchoVentana > 576">No enviadas </span> <span class="badge rounded-pill bg-secondary">{{ noSend.length }}</span></a
                >
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div
                class="tab-pane fade show active"
                id="por-enviar-2"
                role="tabpanel"
                aria-labelledby="por-enviar-tab-2"
            >
                <div class="row mt-2 g-1" v-if="toSend.length !== 0">
                    <send-survey-card v-for="(item, index) in toSend" :key="index"
                    :discharged="item"
                    big_icon="fas fa-hospital-user"
                    :send_survey="sendSurvey"
                    :update_send_survey_list="updateSendSurveyList"
                    ></send-survey-card>
                </div>
                <div class="row text-center mt-3" v-else>
                    <h5><i class="far fa-smile"></i> No hay datos que mostrar.</h5>
                </div>

            </div>
            <div
                class="tab-pane fade"
                id="enviados"
                role="tabpanel"
                aria-labelledby="enviados-tab"
            >
            <div v-if="send.length !== 0">
                <div class="row mt-2 g-1">
                    <send-survey-card v-for="(item, index) in send" :key="index"
                    :discharged="item"
                    big_icon="fas fa-hospital-user"
                    :send_survey="sendSurvey"
                    :update_send_survey_list="updateSendSurveyList"
                    ></send-survey-card>
                </div>
            </div>
            <div class="row text-center mt-3" v-else>
                <h5><i class="far fa-smile"></i> No hay datos que mostrar.</h5>
            </div>
            </div>
            <div
                class="tab-pane fade"
                id="respondidos"
                role="tabpanel"
                aria-labelledby="respondidos-tab"
            >
            <div class="row mt-2 g-1" v-if="sent.length !== 0">
                <send-survey-card v-for="(item, index) in sent" :key="index"
                :discharged="item"
                big_icon="fas fa-hospital-user"
                :send_survey="sendSurvey"
                :update_send_survey_list="updateSendSurveyList"
                ></send-survey-card>
            </div>
            <div class="row text-center mt-3" v-else>
                <h5><i class="far fa-smile"></i> No hay datos que mostrar.</h5>
            </div>
            </div>
            <div
                class="tab-pane fade"
                id="no-enviados"
                role="tabpanel"
                aria-labelledby="no-enviados-tab"
            >
            <div class="row mt-2 g-1" v-if="noSend.length !== 0">
                <send-survey-card v-for="(item, index) in noSend" :key="index"
                :discharged="item"
                big_icon="fas fa-hospital-user"
                :send_survey="sendSurvey"
                :update_send_survey_list="updateSendSurveyList"
                ></send-survey-card>
            </div>
            <div class="row text-center mt-3" v-else>
                <h5><i class="far fa-smile"></i> No hay datos que mostrar.</h5>
            </div>
            </div>
        </div>

    </div>
</template>

<script>
import {phone} from 'phone';
export default {
    // props: ["to_send","send","no_send","sent"],
    data() {
        return {
            date_start:'',
            date_end: '',
            survey_id: 99,
            toSend: [],
            send: [],
            noSend: [],
            sent: [],
            surveys: [],
            sentByEmail: 0,
            sentByWhatsapp: 0,
            answeredByEmail: 0,
            answeredByWhatsapp: 0,
            answeredByInsitu:0,
            sentByInsitu:0,
            anchoVentana: window.innerWidth,
            textFilterDate: '',
            textFilterSurvey: 'Todas'
        };

    },
    methods: {

        updateSendSurveyList(){
            axios.post(window.location.origin+"/dischargeds/updateSendSurveyList", {
                from: this.date_start,
                to: this.date_end,
            }).then(async res => {
                console.log(res.data);
                console.log(`this.survey_id is ${this.survey_id}`)
                if(this.survey_id === 99){
                    this.toSend = await res.data.toSend;
                    this.send = await res.data.send;
                    this.noSend = await res.data.noSend;
                    this.sent = await res.data.sent;
                }else{
                    this.toSend = await res.data.toSend.filter(x => {
                        if(x.episodio.ubicacion !== null){
                            // return x.episodio.ubicacion.survey_id === this.survey_id
                            return x.surveys[0].pivot.survey_id === this.survey_id
                        }
                    });
                    this.send = await res.data.send.filter(x => {
                        if(x.episodio.ubicacion !== null){
                            // return x.episodio.ubicacion.survey_id === this.survey_id
                            return x.surveys[0].pivot.survey_id === this.survey_id
                        }
                    });
                    this.noSend = await res.data.noSend.filter(x => {
                        if(x.episodio.ubicacion !== null){
                            // return x.episodio.ubicacion.survey_id === this.survey_id
                            return x.surveys[0].pivot.survey_id === this.survey_id
                        }
                    });
                    this.sent = await res.data.sent.filter(x => {
                        if(x.episodio.ubicacion !== null){
                            // return x.episodio.ubicacion.survey_id === this.survey_id
                            return x.surveys[0].pivot.survey_id === this.survey_id
                        }
                    });
                }

                const all = this.sent.concat(this.send,this.noSend,this.toSend)

                let aByEmail = all.filter(x => x.sent_email === 2)
                this.answeredByEmail = aByEmail.length
                let sByEmail = all.filter(x => x.sent_email === 1)
                this.sentByEmail = sByEmail.length + this.answeredByEmail
                let aByWhatsApp = all.filter(x => x.sent_whatsapp === 2)
                this.answeredByWhatsapp = aByWhatsApp.length
                let sByWhatsApp = all.filter(x => x.sent_whatsapp === 1)
                this.sentByWhatsapp = sByWhatsApp.length + this.answeredByWhatsapp
                let aByInsitu = all.filter(x => x.sent_insitu === 2)
                this.answeredByInsitu = aByInsitu.length
                let sByInsitu = all.filter(x => x.sent_insitu === 1)
                this.sentByInsitu = sByInsitu.length + this.answeredByInsitu

                document.getElementById('loadingScreen').classList.add("d-none")

            }).catch(e => {
                console.log('Ocurrió el siguiente error -->'+e);
            })
        },

        async sendSurvey(item){
            // Verifica si la encuesta es emergencia adultos PAD (id===7), si lo es evalúa la edad del paciente, de ser menor de 18 años se envía la  encuesta de emergencia pediátrica (id===5)
            let survey_id = item.episodio.ubicacion.survey_id;
            if (survey_id === 7){ // si la encuesta es PAD Emergencia Adultos
                let fecha_nacimiento_paciente = item.episodio.paciente.profile.fnacimiento
                let date = new Date(fecha_nacimiento_paciente).getTime()
                let today = new Date().getTime();
                if((today - date)/(1000*60*60*24*365) < 18 ){ // verifica que el paciente sea menor de edad
                    survey_id = 5
                    // console.log('es menor de edad')
                }
            }
            // abre whatsapp para el envío de la invitación
            if(item.sent_whatsapp === 0 && phone(item.episodio.paciente.profile.telefono_movil).isValid){
                // let text = 'Bienvenido%20a%20la%20Encuesta%20de%20Atenci%C3%B3n%20del%20Centro%20M%C3%A9dico%20Docente%20La%20Trinidad.%0A%0AGracias%20por%20preferirnos%20y%20considerarnos%20el%20aliado%20de%20tu%20salud.%20Nuestro%20prop%C3%B3sito%20es%20ofrecerte%20un%20excelente%20servicio%2C%20para%20lo%20cual%20tus%20sugerencias%20son%20muy%20importantes.%0A%0AMuchas%20gracias%20por%20tu%20tiempo%20y%20colaboraci%C3%B3n.%20%0A%0AIngresa%20al%20siguiente%20enlace%20y%20d%C3%A9janos%20saber%20tu%20opini%C3%B3n.%20%0A%0A'+window.location.origin+'/surveys/'+survey_id+'/'+item.token+'/2'
                let text = '%C2%A1Saludos%20desde%20el%20Centro%20M%C3%A9dico%20Docente%20La%20Trinidad%21%0A%0AGracias%20por%20preferirnos%20y%20considerarnos%20el%20aliado%20de%20tu%20salud.%0A%0ANuestro%20prop%C3%B3sito%20es%20ofrecerte%20un%20excelente%20servicio%2C%20para%20lo%20cual%20tus%20sugerencias%20son%20muy%20importantes.%0A%0ATe%20invitamos%20a%20participar%20en%20nuestra%20Encuesta%20de%20Atenci%C3%B3n.%0A%0AAgrega%20nuestro%20n%C3%BAmero%20de%20contacto%20a%20tu%20lista%20de%20WhatsApp%20para%20acceder%20al%20enlace%20y%20d%C3%A9janos%20saber%20tu%20opini%C3%B3n%3A%0A%0A'+window.location.origin+'/surveys/'+survey_id+'/'+item.token+'/2'
                let link = 'https://api.whatsapp.com/send?phone='+item.episodio.paciente.profile.telefono_movil+'&text='+text
                window.open(link, '_blank');
            }
            await axios.post(window.location.origin+"/reSendEmailWhatsapp", {
                    discharged_id: item.id,
                    isPhone: phone(item.episodio.paciente.profile.telefono_movil).isValid
                }).then(res => {
                    console.log(res.data)
                    if(res.data.errorMessage.length > 0){
                        Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: res.data.errorMessage,
                                showConfirmButton: false,
                                timer: 2500
                            })
                    }
                    if(res.data.successMessage.length > 0){
                        Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: res.data.successMessage,
                                showConfirmButton: false,
                                timer: 2500
                            })
                    }
                }).catch(e => {
                    console.log('Ocurrió el siguiente error -->'+e);
                })
            // renueva la lista
            this.updateSendSurveyList()
        },
        getFromTo(days, text){
            $("#collapseDate").collapse('hide')
            document.getElementById('loadingScreen').classList.remove("d-none")
            this.date_end = new Date(new Date().getTime() + (1000*60*60*24)).toISOString().substring(0, 10)
            if (days !== null){
                this.date_start = new Date(new Date().getTime() - (1000*60*60*24*days)).toISOString().substring(0, 10)
            }else{
                this.date_start = new Date(0).toISOString().substring(0, 10)
            }
            this.textFilterDate = text
            this.updateSendSurveyList()
        },
        filterBySurvey(index){
            $("#collapseSurveys").collapse('hide')
            document.getElementById('loadingScreen').classList.remove("d-none")
            if(index !== 99){
                this.textFilterSurvey = this.surveys[index].name.charAt(0).toUpperCase() + this.surveys[index].name.slice(1)
                this.survey_id = this.surveys[index].id
            }else{
                this.textFilterSurvey = 'Todas'
                this.survey_id = 99
            }

            // console.log(`survey_id ${this.survey_id}, textFilterSurvey ${this.textFilterSurvey}`)

            this.updateSendSurveyList()
        },
        getListSurveys(){
            axios.get(window.location.origin+"/getListSurveys").then(res => {
                    // console.log(res.data)
                    this.surveys = res.data
                }).catch(e => {
                    console.log('Ocurrió el siguiente error -->'+e);
                })
        },
        hideCollapseSurveys(){
            $("#collapseSurveys").collapse('hide')
        },
        hideCollapseDate(){
            $('#collapseDate').collapse('hide');
        }
    },
    created() {
        document.getElementById('loadingScreen').classList.remove("d-none")
        this.getListSurveys()
        this.getFromTo(7,'Últimos siete días')
        setInterval(() => this.updateSendSurveyList(), 60000); // recarga cada minuto (60.000 milisegundos)
    },
};
</script>

<style>
.rounded-xl {
    border-radius: 2rem;
}
.icono-mano:hover {
  cursor: pointer;
}
</style>
