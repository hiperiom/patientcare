<template>
    <!-- modal estadísticas de las secciones  INICIO -->
    <div class="modal fade" id="sectionModal" tabindex="-1" aria-labelledby="sectionModalLabel" data-backdrop="static" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <div class="sticky-top" style="padding-right: 15px; margin-right: -15px;">
                        <img aria-label="Close" src="/image/system/logo-cmdlt-blanco.svg" class="img-fluid pr-2" style="float: right !important; height: 3em !important; width: 120px;">
                        <i id="close_modal" @click="closeModal" aria-label="Close" aria-hidden="true" class="fas fa-times text-white position-fixed zoom" style="z-index: 1000 !important; font-size: 3em; right: 5%; cursor: pointer;"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="small-box" :class="{
                            'bg-primary': section.maxPuntuacion === 0,
                            'bg-success': (((section.puntuacion*100)/section.maxPuntuacion) >= 80) && section.maxPuntuacion != 0 ? true : false,
                            'bg-warning': (((section.puntuacion*100)/section.maxPuntuacion) < 80) && section.maxPuntuacion != 0 ? true : false,
                            'bg-danger': (((section.puntuacion*100)/section.maxPuntuacion) < 50) && section.maxPuntuacion != 0 ? true : false,
                        }">
                        <div class="inner">
                            <h3 v-if="section.maxPuntuacion != 0" >{{ Math.round((section.puntuacion*100)/section.maxPuntuacion) }}<sup style="font-size: 20px">%</sup></h3>
                            <h3 v-else >0<sup style="font-size: 20px">%</sup></h3>
                            <p>{{ section.name }}</p>
                        </div>
                        <div class="icon">
                            <i :class="section.icon"></i>
                        </div>
                        <!-- <div class="small-box-footer d-flex justify-content-center align-items-center h3 invisible">
                            Más información <i class="fas fa-arrow-circle-right"></i>
                        </div> -->
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="carouselExampleControls" class="carousel slide overflow-auto" data-interval="false" data-ride="carousel" style="height: fit-content;">
                                    <div class="carousel-inner">
                                        <div v-for="(question, index) in section.questions" :key="index" class="carousel-item" :class="{'active': index === 0 ? true : false}">
<!-- área de fechas  -->
                                            <span class="d-flex justify-content-center rounded-pill p-1 my-1 bg-gray">
                                                <div class=" text-primary" style="letter-spacing: 2px;">
                                                    Desde: {{ dateStart }} - Hasta: {{ dateEnd }}
                                                </div>
                                            </span>
<!-- área de la pregunta  -->
                                            <span>
                                                <h4 class="text-center text-gray"><b>{{ question.description }}</b></h4>
                                                <div class="text-primary text-center" style="font-size:0.8em !important;">
                                                    <h5><b><span class="badge badge-gray text-primary">{{ question.responses }}</span> Respuestas encontradas</b></h5>
                                                </div>
                                            </span>
<!-- comienzo de las opiniones de la pregunta  -->
                                            <div class="mb-3">
                                                <div v-if="question.comments.length > 0" class="pb-3 pt-2" style="border-top:3px solid #185ba9; border-radius: 0.25em;">
                                                    <a data-toggle="collapse" href="#collapseOpinionsQuestion" aria-expanded="false" aria-controls="collapseExample">
                                                    <h3 class="card-title w-100 text-center text-primary pa-2">Opiniones <span class="badge badge-primary">{{ question.comments.length }}</span></h3>
                                                </a>
                                                </div>
                                                <div class="collapse card-header" id="collapseOpinionsQuestion">
                                                    <div class="card card-body" style="width: 100%; box-shadow: none;">
                                                        <div v-for="(comment, index) in question.comments" :key="index">
                                                            <div class="direct-chat-messages" style="">
                                                                <div class="direct-chat-msg">
                                                                    <div class="direct-chat-infos clearfix">
                                                                        <span class="direct-chat-timestamp float-right">{{ new Date(comment.date).toLocaleDateString('en-CA') }}</span>
                                                                    </div>
                                                                        <img class="direct-chat-img" src="/image/system/icono-paciente-blanco.svg">
                                                                    <div class="direct-chat-text">{{ comment.comment }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
<!-- fin de la opiniones de la pregunta  -->
                                            <div v-if="question.totalResponses != 1" class="table-responsive">
                                                <table class="table table-striped text-gray" style="font-size:1.5em;">
                                                    <!-- <thead>
                                                        <tr>
                                                            <th colspan="3" class="text-center">
                                                                {{ question.description }}
                                                                <div class="text-primary text-center" style="font-size:0.8em !important;">
                                                                    <span class="badge badge-gray text-primary">{{ question.responses }}</span> Respuestas encontradas
                                                                </div>
                                                            </th>
                                                        </tr>
                                                    </thead> -->
                                                    <tbody>
                                                        <!-- estadisticas de las respuestas  -->
                                                        <tr v-if="10 <= question.totalResponses" :key="question.answers[9].id" class="tooltip-primary" data-toggle="tooltip" data-placement="top" :title="question.responses10+' respuesta'+((question.responses10!==1)?'s':'')+' representa'+((question.responses10!==1)?'n':'')+' el '+ (question.responses === 0 ? '0' : (((question.responses10*100)/question.responses)).toFixed()) + '% de las '+question.responses+' respuestas encontradas.'">
                                                            <td>{{ question.answers[9].description }}</td>
                                                            <td style="vertical-align: middle;width: 40%;">
                                                                <div class="progress progress-lg">
                                                                    <div class="progress-bar bg-warning"  :style="{ width: ((question.responses10*100)/question.responses) + '%' }"></div>
                                                                </div>
                                                            </td>
                                                            <td style="width: 15%;"><span class="text-primary">{{ question.responses === 0 ? '0' : ((question.responses10*100)/question.responses).toFixed() }} %</span></td>
                                                        </tr>
                                                        <tr v-if="9 <= question.totalResponses" :key="question.answers[8].id" class="tooltip-primary" data-toggle="tooltip" data-placement="top" :title="question.responses9+' respuesta'+((question.responses9!==1)?'s':'')+' representa'+((question.responses9!==1)?'n':'')+' el '+ (question.responses === 0 ? '0' : (((question.responses9*100)/question.responses)).toFixed()) + '% de las '+question.responses+' respuestas encontradas.'">
                                                            <td>{{ question.answers[8].description }}</td>
                                                            <td style="vertical-align: middle;width: 40%;">
                                                                <div class="progress progress-lg">
                                                                    <div class="progress-bar bg-warning"  :style="{ width: ((question.responses9*100)/question.responses) + '%' }"></div>
                                                                </div>
                                                            </td>
                                                            <td style="width: 15%;"><span class="text-primary">{{ question.responses === 0 ? '0' : ((question.responses9*100)/question.responses).toFixed() }} %</span></td>
                                                        </tr>
                                                        <tr v-if="8 <= question.totalResponses" :key="question.answers[7].id" class="tooltip-primary" data-toggle="tooltip" data-placement="top" :title="question.responses8+' respuesta'+((question.responses8!==1)?'s':'')+' representa'+((question.responses8!==1)?'n':'')+' el '+ (question.responses === 0 ? '0' : (((question.responses8*100)/question.responses)).toFixed()) + '% de las '+question.responses+' respuestas encontradas.'">
                                                            <td>{{ question.answers[7].description }}</td>
                                                            <td style="vertical-align: middle;width: 40%;">
                                                                <div class="progress progress-lg">
                                                                    <div class="progress-bar bg-warning"  :style="{ width: ((question.responses8*100)/question.responses) + '%' }"></div>
                                                                </div>
                                                            </td>
                                                            <td style="width: 15%;"><span class="text-primary">{{ question.responses === 0 ? '0' : ((question.responses8*100)/question.responses).toFixed() }} %</span></td>
                                                        </tr>
                                                        <tr v-if="7 <= question.totalResponses" :key="question.answers[6].id" class="tooltip-primary" data-toggle="tooltip" data-placement="top" :title="question.responses7+' respuesta'+((question.responses7!==1)?'s':'')+' representa'+((question.responses7!==1)?'n':'')+' el '+ (question.responses === 0 ? '0' : (((question.responses7*100)/question.responses)).toFixed()) + '% de las '+question.responses+' respuestas encontradas.'">
                                                            <td>{{ question.answers[6].description }}</td>
                                                            <td style="vertical-align: middle;width: 40%;">
                                                                <div class="progress progress-lg">
                                                                    <div class="progress-bar bg-warning"  :style="{ width: ((question.responses7*100)/question.responses) + '%' }"></div>
                                                                </div>
                                                            </td>
                                                            <td style="width: 15%;"><span class="text-primary">{{ question.responses === 0 ? '0' : ((question.responses7*100)/question.responses).toFixed() }} %</span></td>
                                                        </tr>
                                                        <tr v-if="6 <= question.totalResponses" :key="question.answers[5].id" class="tooltip-primary" data-toggle="tooltip" data-placement="top" :title="question.responses6+' respuesta'+((question.responses6!==1)?'s':'')+' representa'+((question.responses6!==1)?'n':'')+' el '+ (question.responses === 0 ? '0' : (((question.responses6*100)/question.responses)).toFixed()) + '% de las '+question.responses+' respuestas encontradas.'">
                                                            <td>{{ question.answers[5].description }}</td>
                                                            <td style="vertical-align: middle;width: 40%;">
                                                                <div class="progress progress-lg">
                                                                    <div class="progress-bar bg-warning"  :style="{ width: ((question.responses6*100)/question.responses) + '%' }"></div>
                                                                </div>
                                                            </td>
                                                            <td style="width: 15%;"><span class="text-primary">{{ question.responses === 0 ? '0' : ((question.responses6*100)/question.responses).toFixed() }} %</span></td>
                                                        </tr>
                                                        <tr v-if="5 <= question.totalResponses" :key="question.answers[4].id" class="tooltip-primary" data-toggle="tooltip" data-placement="top" :title="question.responses5+' respuesta'+((question.responses5!==1)?'s':'')+' representa'+((question.responses5!==1)?'n':'')+' el '+ (question.responses === 0 ? '0' : (((question.responses5*100)/question.responses)).toFixed()) + '% de las '+question.responses+' respuestas encontradas.'">
                                                            <td>{{ question.answers[4].description }}</td>
                                                            <td style="vertical-align: middle;width: 40%;">
                                                                <div class="progress progress-lg">
                                                                    <div class="progress-bar bg-warning"  :style="{ width: ((question.responses5*100)/question.responses) + '%' }"></div>
                                                                </div>
                                                            </td>
                                                            <td style="width: 15%;"><span class="text-primary">{{ question.responses === 0 ? '0' : ((question.responses5*100)/question.responses).toFixed() }} %</span></td>
                                                        </tr>
                                                        <tr v-if="4 <= question.totalResponses" :key="question.answers[3].id" class="tooltip-primary" data-toggle="tooltip" data-placement="top" :title="question.responses4+' respuesta'+((question.responses4!==1)?'s':'')+' representa'+((question.responses4!==1)?'n':'')+' el '+ (question.responses === 0 ? '0' : (((question.responses4*100)/question.responses)).toFixed()) + '% de las '+question.responses+' respuestas encontradas.'">
                                                            <td>{{ question.answers[3].description }}</td>
                                                            <td style="vertical-align: middle;width: 40%;">
                                                                <div class="progress progress-lg">
                                                                    <div class="progress-bar bg-warning"  :style="{ width: ((question.responses4*100)/question.responses) + '%' }"></div>
                                                                </div>
                                                            </td>
                                                            <td style="width: 15%;"><span class="text-primary">{{ question.responses === 0 ? '0' : ((question.responses4*100)/question.responses).toFixed() }} %</span></td>
                                                        </tr>
                                                        <tr v-if="3 <= question.totalResponses" :key="question.answers[2].id" class="tooltip-primary" data-toggle="tooltip" data-placement="top" :title="question.responses3+' respuesta'+((question.responses3!==1)?'s':'')+' representa'+((question.responses3!==1)?'n':'')+' el '+ (question.responses === 0 ? '0' : (((question.responses3*100)/question.responses)).toFixed()) + '% de las '+question.responses+' respuestas encontradas.'">
                                                            <td>{{ question.answers[2].description }}</td>
                                                            <td style="vertical-align: middle;width: 40%;">
                                                                <div class="progress progress-lg">
                                                                    <div class="progress-bar bg-warning"  :style="{ width: ((question.responses3*100)/question.responses) + '%' }"></div>
                                                                </div>
                                                            </td>
                                                            <td style="width: 15%;"><span class="text-primary">{{ question.responses === 0 ? '0' : ((question.responses3*100)/question.responses).toFixed() }} %</span></td>
                                                        </tr>
                                                        <tr v-if="2 <= question.totalResponses" :key="question.answers[1].id" class="tooltip-primary" data-toggle="tooltip" data-placement="top" :title="question.responses2+' respuesta'+((question.responses2!==1)?'s':'')+' representa'+((question.responses2!==1)?'n':'')+' el '+ (question.responses === 0 ? '0' : (((question.responses2*100)/question.responses)).toFixed()) + '% de las '+question.responses+' respuestas encontradas.'">
                                                            <td>{{ question.answers[1].description }}</td>
                                                            <td style="vertical-align: middle;width: 40%;">
                                                                <div class="progress progress-lg">
                                                                    <div class="progress-bar bg-warning"  :style="{ width: ((question.responses2*100)/question.responses) + '%' }"></div>
                                                                </div>
                                                            </td>
                                                            <td style="width: 15%;"><span class="text-primary">{{ question.responses === 0 ? '0' : ((question.responses2*100)/question.responses).toFixed() }} %</span></td>
                                                        </tr>
                                                        <tr v-if="1 <= question.totalResponses" :key="question.answers[0].id" class="tooltip-primary" data-toggle="tooltip" data-placement="top" :title="question.responses1+' respuesta'+((question.responses1!==1)?'s':'')+' representa'+((question.responses1!==1)?'n':'')+' el '+ (question.responses === 0 ? '0' : (((question.responses1*100)/question.responses)).toFixed()) + '% de las '+question.responses+' respuestas encontradas.'">
                                                            <td>{{ question.answers[0].description }}</td>
                                                            <td style="vertical-align: middle;width: 40%;">
                                                                <div class="progress progress-lg">
                                                                    <div class="progress-bar bg-warning"  :style="{ width: ((question.responses1*100)/question.responses) + '%' }"></div>
                                                                </div>
                                                            </td>
                                                            <td style="width: 15%;"><span class="text-primary">{{ question.responses === 0 ? '0' : ((question.responses1*100)/question.responses).toFixed() }} %</span></td>
                                                        </tr>
                                                        <!-- <tr class="tooltip-primary" data-tippy-content="17 respuestas de 4 Estrellas representan el 80.95% de las 21 respuestas encontradas">
                                                            <td>5 Estrellas</td>
                                                            <td style="vertical-align: middle;width: 40%;">
                                                                <div class="progress progress-lg">
                                                                    <div class="progress-bar bg-warning" style="width: 80.95%"></div>
                                                                </div>
                                                            </td>
                                                            <td style="width: 15%;"><span class="text-primary">80.95 %</span></td>
                                                        </tr> -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <i class="fas fa-chevron-left text-gray"></i>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <i class="fas fa-chevron-right text-gray"></i>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal estadísticas de las secciones  FIN -->
</template>

<script>
export default {
    props: ["section","base_url", "date-start", "date-end"],
    data(){
        return {

        }
    },

    methods: {
        closeModal(){
            $('.carousel').carousel(0);
            $('#sectionModal').modal('toggle');
        },
        getStatistics(){
            axios.post(window.location.origin+"/surveys_statistics_ajax", {
                dateInit: this.date_start,
                dateEnd: this.date_end,
                survey_id: this.survey.id
            }).then(res => {
                console.log(res.data);
                this.currentSurvey = res.data.survey;
                this.commentsSurvey = res.data.commentsSurvey;
                this.totalSurveys = res.data.totalSurveys;
                this.totalSurveysSent = res.data.totalSurveysSent;
            }).catch(e => {

            })
        },
    },
    created() {
        $(document).ready(function() {
            $("body").tooltip({ selector: '[data-toggle=tooltip].tooltip-primary', customClass:'tooltip-primary' });
        });
    }
}
</script>
