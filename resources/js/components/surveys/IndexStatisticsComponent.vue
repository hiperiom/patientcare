<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="info-box bg-primary text-white"><span class="info-box-icon bg-primary"><i class="far fa-file-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text font-weight-bold text-white">Total de<br>encuestas contestadas</span>
                        <span class="info-box-number text-white">{{ totalSurveysAnswered }} - <span style="background:white;font-size:1rem;padding: 0 0.2em;letter-spacing: 1.1pt;color:var(--primary);" class="badge badge-info"><b>{{ Math.round((totalSurveysAnswered*100)/totalSurveysSent) }}%</b></span></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box"><span class="info-box-icon bg-primary"><i class="far fa-paper-plane"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text text-primary font-weight-bold">Total de<br>encuestas enviadas</span>
                        <span class="info-box-number text-secondary">{{ totalSurveysSent }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box"><span class="info-box-icon bg-primary"><i class="far fa-calendar-alt"></i></span>
                    <div class="info-box-content">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="date_start" class="info-box-text text-primary">Desde</label>
                            </div>
                            <div class="col-md-6 text-right text-primary">
                                <i @click="getSurveys" class="fa fa-search" style="cursor: pointer;"></i>
                            </div>
                        </div>
                        <input @keyup.enter="getSurveys" id="date_start" type="date" v-model="date_start" class="border-0 text-secondary input-date font-weight-bold">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box"><span class="info-box-icon bg-primary"><i class="far fa-calendar-alt"></i></span>
                    <div class="info-box-content">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="date_end" class="info-box-text text-primary">Hasta</label>
                            </div>
                            <div class="col-md-6 text-right text-primary">
                                <i @click="getSurveys" class="fa fa-search" style="cursor: pointer;"></i>
                            </div>
                        </div>
                        <input @keyup.enter="getSurveys" id="date_end" type="date" v-model="date_end" class="border-0 text-secondary input-date font-weight-bold">
                    </div>
                </div>
            </div>
        </div>

        <div class=" bd-highlight mb-3">
            <div class="row">
                <div class="col-6">
                    <button type="button" class="btn mt-2 btn-block" :class="{
                        'btn-primary': survey === true ? true : false,
                        'btn-grisclaro': survey === false ? true : false,
                        }"
                        @click="setBySurveys">
                        FILTRAR POR ENCUESTAS
                    </button>
                </div>
                <div class="col-6">
                    <button type="button" class="btn mt-2 btn-block" :class="{
                        'btn-primary': area === true ? true : false,
                        'btn-grisclaro': area === false ? true : false,
                        }"
                        @click="setByAreas">
                        FILTRAR POR ÁREAS
                    </button>
                </div>
            </div>
        </div>

        <div v-show="survey === true" class="row">
            <!-- <pre>{{ surveyPAD }}</pre> -->
            <div v-for="(survey,index) in surveys" :key="index" class="col-lg-3 col-md-6">

                <div v-if="survey.totalSurvey !== 0" class="info-box text-secondary bg-gradient-gris-claro icono-mano" @click="showSurvey(survey.id)">
                    <div v-if="survey.totalSurvey !== 0"
                    class="big-icon-envelope"
                    data-toggle="tooltip"
                    data-placement="top"
                    :title="((survey.totalSurveyAnswered*100)/survey.totalSurveySent).toFixed() + '% de respuesta.'"
                    :class="{
                        'tooltip-success': (((survey.totalSurveyAnswered*100)/survey.totalSurveySent) >= 80) ? true : false,
                        'tooltip-warning': (((survey.totalSurveyAnswered*100)/survey.totalSurveySent) < 80 && ((survey.totalSurveyAnswered*100)/survey.totalSurveySent) > 49) ? true : false,
                        'tooltip-danger' : (((survey.totalSurveyAnswered*100)/survey.totalSurveySent) < 50) ? true : false
                    }">
                        <i v-if="(((survey.totalSurveyAnswered*100)/survey.totalSurveySent) >= 80)" class="far fa-envelope text-success"></i>
                        <i v-if="(((survey.totalSurveyAnswered*100)/survey.totalSurveySent) < 80 && ((survey.totalSurveyAnswered*100)/survey.totalSurveySent) > 49)" class="far fa-envelope text-warning"></i>
                        <i v-if="(((survey.totalSurveyAnswered*100)/survey.totalSurveySent) < 50)" class="far fa-envelope text-danger"></i>
                    </div>
                    <div v-if="survey.puntuacion.maxPuntuacion !== 0"
                    class="big-icon-face"
                    data-toggle="tooltip"
                    data-placement="top"
                    :title="((survey.puntuacion.puntuacion*100)/survey.puntuacion.maxPuntuacion).toFixed() + '% de satisfacción.'"
                    :class="{
                        'tooltip-success': (((survey.puntuacion.puntuacion*100)/survey.puntuacion.maxPuntuacion) >= 80) ? true : false,
                        'tooltip-warning': (((survey.puntuacion.puntuacion*100)/survey.puntuacion.maxPuntuacion) < 80 && ((survey.puntuacion.puntuacion*100)/survey.puntuacion.maxPuntuacion) > 49) ? true : false,
                        'tooltip-danger' : (((survey.puntuacion.puntuacion*100)/survey.puntuacion.maxPuntuacion) < 50) ? true : false
                    }">
                        <i v-if="(((survey.puntuacion.puntuacion*100)/survey.puntuacion.maxPuntuacion) >= 80)" class="far fa-smile text-success"></i>
                        <i v-if="(((survey.puntuacion.puntuacion*100)/survey.puntuacion.maxPuntuacion) < 80 && ((survey.puntuacion.puntuacion*100)/survey.puntuacion.maxPuntuacion) > 49)" class="far fa-meh text-warning"></i>
                        <i v-if="(((survey.puntuacion.puntuacion*100)/survey.puntuacion.maxPuntuacion) < 50)" class="far fa-frown text-danger"></i>
                    </div>
                    <!-- <span class="info-box-icon"><i class="fas fa-poll"></i></span> -->
                    <div class="info-box-content">
                        <span class="info-box-text h5" style="z-index:1001;">{{ survey.name.charAt(0).toUpperCase() + survey.name.slice(1) }}</span>

                        <p class="info-box-number"><span class="big-text">{{ survey.totalSurvey }}</span> encuesta{{ ((survey.totalSurvey!==1)?'s':'') }} en total.</p>

                        <!-- control -->
                        <multiple-progress-bar :surveyp="survey"></multiple-progress-bar>
                        <!-- fin de control -->
                        <div class="row justify-content-end pt-2 pr-3">
                            <div class="col-1" v-if="isNaN( new Date((survey.totalTimeToAnswered)*60000/survey.totalSurveyAnswered).getUTCMinutes()) || isNaN(new Date((survey.totalTimeToAnswered)*60000/survey.totalSurveyAnswered).getUTCSeconds())">
                                <i class="fas fa-stopwatch tooltip-primary" data-toggle="tooltip" data-placement="top" title="Sin datos para calcular el tiempo promedio de respuesta."></i>
                            </div>
                            <div v-else class="col-1">
                                <i class="fas fa-stopwatch tooltip-primary" data-toggle="tooltip" data-placement="top" :title="'Tiempo promedio de respuesta ' + new Date((survey.totalTimeToAnswered)*60000/survey.totalSurveyAnswered).getUTCMinutes() + ' minutos y ' + new Date((survey.totalTimeToAnswered)*60000/survey.totalSurveyAnswered).getUTCSeconds() + ' segundos'"></i>
                            </div>
                            <!-- <div class="col-1 pr-4 icono-mano">
                                <i class="fas fa-chart-line" @click="showSurvey(survey.id)"></i>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div v-else class="info-box text-secondary bg-gradient-gris-claro">
                    <!-- <span class="info-box-icon"><i class="fas fa-poll"></i></span> -->
                    <div class="info-box-content">
                        <span class="info-box-text h5" style="z-index:1001;">{{ survey.name.charAt(0).toUpperCase() + survey.name.slice(1) }}</span>

                        <p class="info-box-number"><span class="big-text">{{ survey.totalSurvey }}</span> encuesta{{ ((survey.totalSurvey!==1)?'s':'') }} en total.</p>

                        <!-- control -->
                        <multiple-progress-bar :surveyp="survey"></multiple-progress-bar>
                        <!-- fin de control -->
                        <div class="row justify-content-end pt-2 pr-3">
                            <div class="col-1" v-if="isNaN( new Date((survey.totalTimeToAnswered)*60000/survey.totalSurveyAnswered).getUTCMinutes()) || isNaN(new Date((survey.totalTimeToAnswered)*60000/survey.totalSurveyAnswered).getUTCSeconds())">
                                <i class="fas fa-stopwatch tooltip-primary" data-toggle="tooltip" data-placement="top" title="Sin datos para calcular el tiempo promedio de respuesta."></i>
                            </div>
                            <div v-else class="col-1">
                                <i class="fas fa-stopwatch tooltip-primary" data-toggle="tooltip" data-placement="top" :title="'Tiempo promedio de respuesta ' + new Date((survey.totalTimeToAnswered)*60000/survey.totalSurveyAnswered).getUTCMinutes() + ' minutos y ' + new Date((survey.totalTimeToAnswered)*60000/survey.totalSurveyAnswered).getUTCSeconds() + ' segundos'"></i>
                            </div>
                            <!-- <div class="col-1 pr-4 icono-mano">
                                <i class="fas fa-chart-line" @click="showSurvey(survey.id)"></i>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

<!-- tarjeta del PAD  -->

            <div class="col-lg-3 col-md-6">
                <div v-if="surveyPAD.totalSurvey !== 0" class="info-box text-secondary bg-gradient-gris-claro icono-mano" @click="openClosePadModal">
                    <div v-if="surveyPAD.totalSurvey !== 0"
                    class="big-icon-envelope"
                    data-toggle="tooltip"
                    data-placement="top"
                    :title="((surveyPAD.totalSurveyAnswered*100)/surveyPAD.totalSurveySent).toFixed() + '% de respuesta.'"
                    :class="{
                        'tooltip-success': (((surveyPAD.totalSurveyAnswered*100)/surveyPAD.totalSurveySent) >= 80) ? true : false,
                        'tooltip-warning': (((surveyPAD.totalSurveyAnswered*100)/surveyPAD.totalSurveySent) < 80 && ((surveyPAD.totalSurveyAnswered*100)/surveyPAD.totalSurveySent) > 49) ? true : false,
                        'tooltip-danger' : (((surveyPAD.totalSurveyAnswered*100)/surveyPAD.totalSurveySent) < 50) ? true : false
                    }">
                        <i v-if="(((surveyPAD.totalSurveyAnswered*100)/surveyPAD.totalSurveySent) >= 80)" class="far fa-envelope text-success"></i>
                        <i v-if="(((surveyPAD.totalSurveyAnswered*100)/surveyPAD.totalSurveySent) < 80 && ((surveyPAD.totalSurveyAnswered*100)/surveyPAD.totalSurveySent) > 49)" class="far fa-envelope text-warning"></i>
                        <i v-if="(((surveyPAD.totalSurveyAnswered*100)/surveyPAD.totalSurveySent) < 50)" class="far fa-envelope text-danger"></i>
                    </div>
                    <div v-if="surveyPAD.puntuacion.maxPuntuacion !== 0"
                    class="big-icon-face"
                    data-toggle="tooltip"
                    data-placement="top"
                    :title="((surveyPAD.puntuacion.puntuacion*100)/surveyPAD.puntuacion.maxPuntuacion).toFixed() + '% de satisfacción.'"
                    :class="{
                        'tooltip-success': (((surveyPAD.puntuacion.puntuacion*100)/surveyPAD.puntuacion.maxPuntuacion) >= 80) ? true : false,
                        'tooltip-warning': (((surveyPAD.puntuacion.puntuacion*100)/surveyPAD.puntuacion.maxPuntuacion) < 80 && ((surveyPAD.puntuacion.puntuacion*100)/surveyPAD.puntuacion.maxPuntuacion) > 49) ? true : false,
                        'tooltip-danger' : (((surveyPAD.puntuacion.puntuacion*100)/surveyPAD.puntuacion.maxPuntuacion) < 50) ? true : false
                    }">
                        <i v-if="(((surveyPAD.puntuacion.puntuacion*100)/surveyPAD.puntuacion.maxPuntuacion) >= 80)" class="far fa-smile text-success"></i>
                        <i v-if="(((surveyPAD.puntuacion.puntuacion*100)/surveyPAD.puntuacion.maxPuntuacion) < 80 && ((surveyPAD.puntuacion.puntuacion*100)/surveyPAD.puntuacion.maxPuntuacion) > 49)" class="far fa-meh text-warning"></i>
                        <i v-if="(((surveyPAD.puntuacion.puntuacion*100)/surveyPAD.puntuacion.maxPuntuacion) < 50)" class="far fa-frown text-danger"></i>
                    </div>
                    <!-- <span class="info-box-icon"><i class="fas fa-poll"></i></span> -->
                    <div class="info-box-content">
                        <span class="info-box-text h5" style="z-index:1001;">{{ surveyPAD.name.charAt(0).toUpperCase() + surveyPAD.name.slice(1) }}</span>

                        <p class="info-box-number"><span class="big-text">{{ surveyPAD.totalSurvey }}</span> encuesta{{ ((surveyPAD.totalSurvey!==1)?'s':'') }} en total.</p>

                        <!-- control -->
                        <multiple-progress-bar :surveyp="surveyPAD"></multiple-progress-bar>
                        <!-- fin de control -->
                        <div class="row justify-content-end pt-2 pr-3">
                            <div class="col-1" v-if="isNaN( new Date((surveyPAD.totalTimeToAnswered)*60000/surveyPAD.totalSurveyAnswered).getUTCMinutes()) || isNaN(new Date((surveyPAD.totalTimeToAnswered)*60000/surveyPAD.totalSurveyAnswered).getUTCSeconds())">
                                <i class="fas fa-stopwatch tooltip-primary" data-toggle="tooltip" data-placement="top" title="Sin datos para calcular el tiempo promedio de respuesta."></i>
                            </div>
                            <div v-else class="col-1">
                                <i class="fas fa-stopwatch tooltip-primary" data-toggle="tooltip" data-placement="top" :title="'Tiempo promedio de respuesta ' + new Date((surveyPAD.totalTimeToAnswered)*60000/surveyPAD.totalSurveyAnswered).getUTCMinutes() + ' minutos y ' + new Date((surveyPAD.totalTimeToAnswered)*60000/surveyPAD.totalSurveyAnswered).getUTCSeconds() + ' segundos'"></i>
                            </div>
                            <!-- <div class="col-1 pr-4 icono-mano">
                                <i class="fas fa-chart-line" @click="showSurvey(survey.id)"></i>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div v-else class="info-box text-secondary bg-gradient-gris-claro">
                    <!-- <span class="info-box-icon"><i class="fas fa-poll"></i></span> -->
                    <div class="info-box-content">
                        <span class="info-box-text h5" style="z-index:1001;">{{ surveyPAD.name.charAt(0).toUpperCase() + surveyPAD.name.slice(1) }}</span>

                        <p class="info-box-number"><span class="big-text">{{ surveyPAD.totalSurvey }}</span> encuesta{{ ((surveyPAD.totalSurvey!==1)?'s':'') }} en total.</p>

                        <!-- control -->
                        <multiple-progress-bar :surveyp="surveyPAD"></multiple-progress-bar>
                        <!-- fin de control -->
                        <div class="row justify-content-end pt-2 pr-3">
                            <div class="col-1" v-if="isNaN( new Date((surveyPAD.totalTimeToAnswered)*60000/surveyPAD.totalSurveyAnswered).getUTCMinutes()) || isNaN(new Date((surveyPAD.totalTimeToAnswered)*60000/surveyPAD.totalSurveyAnswered).getUTCSeconds())">
                                <i class="fas fa-stopwatch tooltip-primary" data-toggle="tooltip" data-placement="top" title="Sin datos para calcular el tiempo promedio de respuesta."></i>
                            </div>
                            <div v-else class="col-1">
                                <i class="fas fa-stopwatch tooltip-primary" data-toggle="tooltip" data-placement="top" :title="'Tiempo promedio de respuesta ' + new Date((surveyPAD.totalTimeToAnswered)*60000/surveyPAD.totalSurveyAnswered).getUTCMinutes() + ' minutos y ' + new Date((surveyPAD.totalTimeToAnswered)*60000/surveyPAD.totalSurveyAnswered).getUTCSeconds() + ' segundos'"></i>
                            </div>
                            <!-- <div class="col-1 pr-4 icono-mano">
                                <i class="fas fa-chart-line" @click="showSurvey(survey.id)"></i>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div v-show="area === true" class="row">
            <div v-for="(area) in areas" :key="area.name" class="col-lg-3 col-md-6">
                <div v-if="area.puntuacion.maxPuntuacionGlobal !== 0" class="info-box text-secondary bg-gradient-gris-claro icono-mano" @click="setCurrentArea(area)">
                    <div
                    class="big-icon-face"
                    data-toggle="tooltip"
                    data-placement="top"
                    :title="((area.puntuacion.puntuacionGlobal*100)/area.puntuacion.maxPuntuacionGlobal).toFixed() + '% de satisfacción.'"
                    :class="{
                        'tooltip-success': (((area.puntuacion.puntuacionGlobal*100)/area.puntuacion.maxPuntuacionGlobal) >= 80) ? true : false,
                        'tooltip-warning': (((area.puntuacion.puntuacionGlobal*100)/area.puntuacion.maxPuntuacionGlobal) < 80 && ((area.puntuacion.puntuacionGlobal*100)/area.puntuacion.maxPuntuacionGlobal) > 49) ? true : false,
                        'tooltip-danger' : (((area.puntuacion.puntuacionGlobal*100)/area.puntuacion.maxPuntuacionGlobal) < 50) ? true : false
                    }">
                        <i v-if="(((area.puntuacion.puntuacionGlobal*100)/area.puntuacion.maxPuntuacionGlobal) >= 80)" class="far fa-smile text-success"></i>
                        <i v-if="(((area.puntuacion.puntuacionGlobal*100)/area.puntuacion.maxPuntuacionGlobal) < 80 && ((area.puntuacion.puntuacionGlobal*100)/area.puntuacion.maxPuntuacionGlobal) > 49)" class="far fa-meh text-warning"></i>
                        <i v-if="(((area.puntuacion.puntuacionGlobal*100)/area.puntuacion.maxPuntuacionGlobal) < 50)" class="far fa-frown text-danger"></i>
                    </div>
                    <div class="info-box-content">
                        <div class="row">
                            <div class="col-12">
                                <span class="info-box-text h5" style="z-index:1001;">{{area.name.charAt(0).toUpperCase() + area.name.slice(1)}}</span>
                                <p class="info-box-number"><span class="big-text">{{ ((area.puntuacion.puntuacionGlobal*100)/area.puntuacion.maxPuntuacionGlobal).toFixed() }}%</span> de satisfacción.</p>
                                <div class="progress" style="height:25px; border-radius: 0px 12.5px 12.5px 0px; width: 100%;">
                                    <div class="progress-bar progress-bar-striped" role="progressbar" style="height:25px; border-radius: 0px 12.5px 12.5px 0px;" :style="{ width: ((area.puntuacion.puntuacionGlobal*100)/area.puntuacion.maxPuntuacionGlobal).toFixed() + '%' }" :aria-valuenow="((area.puntuacion.puntuacionGlobal*100)/area.puntuacion.maxPuntuacionGlobal).toFixed()" aria-valuemin="0" aria-valuemax="100"
                                    :class="{
                                        'bg-success': (((area.puntuacion.puntuacionGlobal*100)/area.puntuacion.maxPuntuacionGlobal) >= 80) ? true : false,
                                        'bg-warning': (((area.puntuacion.puntuacionGlobal*100)/area.puntuacion.maxPuntuacionGlobal) < 80 && ((area.puntuacion.puntuacionGlobal*100)/area.puntuacion.maxPuntuacionGlobal) > 49) ? true : false,
                                        'bg-danger' : (((area.puntuacion.puntuacionGlobal*100)/area.puntuacion.maxPuntuacionGlobal) < 50) ? true : false
                                    }">{{ ((area.puntuacion.puntuacionGlobal*100)/area.puntuacion.maxPuntuacionGlobal).toFixed() }}%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- Modal estadística de áreas  -->

        <div class="modal fade" id="areaModal" tabindex="-1" aria-labelledby="areaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div v-if="currentArea.length !== 0" class="modal-content">
                    <div class="modal-header">
                        <span class="info-box-text h5 modal-title" style="z-index:1001;" id="areaModalLabel">Satisfacción de las secciones relacionadas</span>
                    </div>
                    <div class="modal-body">
                        <div class="col-12" v-for="(section,index) in currentArea.puntuacion.sections" :key="index" style="margin-top:5px; margin-bottom:5px;">
                            <span v-if="section.maxPuntuacion !== 0">
                                <span class="info-box-text h6" style="z-index:1001;">{{ section.name }} (<strong>{{ section.survey.name.charAt(0).toUpperCase() + section.survey.name.slice(1) }}</strong>)</span>

                                <div class="progress" style="height:20px; border-radius: 0px 10px 10px 0px; width: 100%;">
                                    <div class="progress-bar progress-bar-striped" role="progressbar" style="height:20px; border-radius: 0px 10px 10px 0px;" :style="{ width: (section.puntuacion*100/section.maxPuntuacion) + '%' }" :aria-valuenow="(section.puntuacion*100/section.maxPuntuacion)" aria-valuemin="0" aria-valuemax="100"
                                    :class="{
                                        'bg-success': ((section.puntuacion*100/section.maxPuntuacion) >= 80) ? true : false,
                                        'bg-warning': ((section.puntuacion*100/section.maxPuntuacion) < 80 && (section.puntuacion*100/section.maxPuntuacion) > 49) ? true : false,
                                        'bg-danger' : ((section.puntuacion*100/section.maxPuntuacion) < 50) ? true : false
                                    }">{{ (section.puntuacion*100/section.maxPuntuacion).toFixed() }}%</div>
                                </div>
                                <!-- Caras de satisfacción  -->
                                <!-- <i v-if="((section.puntuacion*100/section.maxPuntuacion) >= 80)" class="far fa-smile text-success"></i>
                                <i v-if="((section.puntuacion*100/section.maxPuntuacion) < 80) && ((section.puntuacion*100/section.maxPuntuacion) > 49)" class="far fa-meh text-warning"></i>
                                <i v-if="((section.puntuacion*100/section.maxPuntuacion) < 50)" class="far fa-frown text-danger"></i> -->
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" @click="closeAreaModal">Regresar</button>
                    </div>
                </div>
            </div>
        </div>

 <!-- Modal tarjetas del PAD  -->

        <div class="modal fade" id="padModal" tabindex="-1" aria-labelledby="padModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="info-box-text h5 modal-title" style="z-index:1001;" id="padModalLabel">Encuestas relacionadas al PAD</span>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div v-for="(survey,index) in surveysPad" :key="index" class="col-lg-4 col-md-6">
                                <div v-if="survey.totalSurvey !== 0" class="info-box text-secondary bg-gradient-gris-claro icono-mano" @click="showSurvey(survey.id)">
                                    <div v-if="survey.totalSurvey !== 0"
                                    class="big-icon-envelope"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    :title="((survey.totalSurveyAnswered*100)/survey.totalSurveySent).toFixed() + '% de respuesta.'"
                                    :class="{
                                        'tooltip-success': (((survey.totalSurveyAnswered*100)/survey.totalSurveySent) >= 80) ? true : false,
                                        'tooltip-warning': (((survey.totalSurveyAnswered*100)/survey.totalSurveySent) < 80 && ((survey.totalSurveyAnswered*100)/survey.totalSurveySent) > 49) ? true : false,
                                        'tooltip-danger' : (((survey.totalSurveyAnswered*100)/survey.totalSurveySent) < 50) ? true : false
                                    }">
                                        <i v-if="(((survey.totalSurveyAnswered*100)/survey.totalSurveySent) >= 80)" class="far fa-envelope text-success"></i>
                                        <i v-if="(((survey.totalSurveyAnswered*100)/survey.totalSurveySent) < 80 && ((survey.totalSurveyAnswered*100)/survey.totalSurveySent) > 49)" class="far fa-envelope text-warning"></i>
                                        <i v-if="(((survey.totalSurveyAnswered*100)/survey.totalSurveySent) < 50)" class="far fa-envelope text-danger"></i>
                                    </div>
                                    <div v-if="survey.puntuacion.maxPuntuacion !== 0"
                                    class="big-icon-face"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    :title="((survey.puntuacion.puntuacion*100)/survey.puntuacion.maxPuntuacion).toFixed() + '% de satisfacción.'"
                                    :class="{
                                        'tooltip-success': (((survey.puntuacion.puntuacion*100)/survey.puntuacion.maxPuntuacion) >= 80) ? true : false,
                                        'tooltip-warning': (((survey.puntuacion.puntuacion*100)/survey.puntuacion.maxPuntuacion) < 80 && ((survey.puntuacion.puntuacion*100)/survey.puntuacion.maxPuntuacion) > 49) ? true : false,
                                        'tooltip-danger' : (((survey.puntuacion.puntuacion*100)/survey.puntuacion.maxPuntuacion) < 50) ? true : false
                                    }">
                                        <i v-if="(((survey.puntuacion.puntuacion*100)/survey.puntuacion.maxPuntuacion) >= 80)" class="far fa-smile text-success"></i>
                                        <i v-if="(((survey.puntuacion.puntuacion*100)/survey.puntuacion.maxPuntuacion) < 80 && ((survey.puntuacion.puntuacion*100)/survey.puntuacion.maxPuntuacion) > 49)" class="far fa-meh text-warning"></i>
                                        <i v-if="(((survey.puntuacion.puntuacion*100)/survey.puntuacion.maxPuntuacion) < 50)" class="far fa-frown text-danger"></i>
                                    </div>
                                    <!-- <span class="info-box-icon"><i class="fas fa-poll"></i></span> -->
                                    <div class="info-box-content">
                                        <span class="info-box-text h5" style="z-index:1001;">{{ survey.name.charAt(0).toUpperCase() + survey.name.slice(1) }}</span>

                                        <p class="info-box-number"><span class="big-text">{{ survey.totalSurvey }}</span> encuesta{{ ((survey.totalSurvey!==1)?'s':'') }} en total.</p>

                                        <!-- control -->
                                        <multiple-progress-bar :surveyp="survey"></multiple-progress-bar>
                                        <!-- fin de control -->
                                        <div class="row justify-content-end pt-2 pr-3">
                                            <div class="col-1" v-if="isNaN( new Date((survey.totalTimeToAnswered)*60000/survey.totalSurveyAnswered).getUTCMinutes()) || isNaN(new Date((survey.totalTimeToAnswered)*60000/survey.totalSurveyAnswered).getUTCSeconds())">
                                                <i class="fas fa-stopwatch tooltip-primary" data-toggle="tooltip" data-placement="top" title="Sin datos para calcular el tiempo promedio de respuesta."></i>
                                            </div>
                                            <div v-else class="col-1">
                                                <i class="fas fa-stopwatch tooltip-primary" data-toggle="tooltip" data-placement="top" :title="'Tiempo promedio de respuesta ' + new Date((survey.totalTimeToAnswered)*60000/survey.totalSurveyAnswered).getUTCMinutes() + ' minutos y ' + new Date((survey.totalTimeToAnswered)*60000/survey.totalSurveyAnswered).getUTCSeconds() + ' segundos'"></i>
                                            </div>
                                            <!-- <div class="col-1 pr-4 icono-mano">
                                                <i class="fas fa-chart-line" @click="showSurvey(survey.id)"></i>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div v-else class="info-box text-secondary bg-gradient-gris-claro">
                                    <!-- <span class="info-box-icon"><i class="fas fa-poll"></i></span> -->
                                    <div class="info-box-content">
                                        <span class="info-box-text h5" style="z-index:1001;">{{ survey.name.charAt(0).toUpperCase() + survey.name.slice(1) }}</span>

                                        <p class="info-box-number"><span class="big-text">{{ survey.totalSurvey }}</span> encuesta{{ ((survey.totalSurvey!==1)?'s':'') }} en total.</p>

                                        <!-- control -->
                                        <multiple-progress-bar :surveyp="survey"></multiple-progress-bar>
                                        <!-- fin de control -->
                                        <div class="row justify-content-end pt-2 pr-3">
                                            <div class="col-1" v-if="isNaN( new Date((survey.totalTimeToAnswered)*60000/survey.totalSurveyAnswered).getUTCMinutes()) || isNaN(new Date((survey.totalTimeToAnswered)*60000/survey.totalSurveyAnswered).getUTCSeconds())">
                                                <i class="fas fa-stopwatch tooltip-primary" data-toggle="tooltip" data-placement="top" title="Sin datos para calcular el tiempo promedio de respuesta."></i>
                                            </div>
                                            <div v-else class="col-1">
                                                <i class="fas fa-stopwatch tooltip-primary" data-toggle="tooltip" data-placement="top" :title="'Tiempo promedio de respuesta ' + new Date((survey.totalTimeToAnswered)*60000/survey.totalSurveyAnswered).getUTCMinutes() + ' minutos y ' + new Date((survey.totalTimeToAnswered)*60000/survey.totalSurveyAnswered).getUTCSeconds() + ' segundos'"></i>
                                            </div>
                                            <!-- <div class="col-1 pr-4 icono-mano">
                                                <i class="fas fa-chart-line" @click="showSurvey(survey.id)"></i>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" @click="openClosePadModal">Regresar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    props: ["base_url"],
    data(){
        return {
            surveys:[],
            surveysPad:[],
            areas:[],
            currentArea:[],
            // date_start:"2024-01-01",
            date_start: new Date(new Date().getTime() - 7 * 86400000).toISOString().slice(0, 10), // hace 7 dias continuos
            date_end: new Date().toLocaleDateString('en-CA'),
            totalSurveys:0,
            totalSurveysSent:0,
            totalSurveysViewed:0,
            totalSurveysAnswered:0,
            area: false,
            survey: false,
            surveyPAD: {
                    name: 'PAD',
                    description: 'Programa de Atención Domiciliaria',
                    totalTimeToAnswered: 0,
                    totalSurvey: 0,
                    totalSurveySent: 0,
                    totalSurveyViewed: 0,
                    totalSurveyAnswered: 0,
                    puntuacion: {
                        puntuacion: 0,
                        maxPuntuacion: 0,
                    }
                }
        }
    },
    methods: {
        setCurrentArea(currentArea){
            this.currentArea = currentArea
            $('#areaModal').modal('toggle');
        },
        closeAreaModal(){
            this.currentArea = []
            $('#areaModal').modal('toggle');
        },
        openClosePadModal(){
            $('#padModal').modal('toggle');
        },
        setBySurveys(){
            this.area = false;
            this.survey = true;
        },
        setByAreas(){
            this.survey = false;
            this.area = true;
        },
        showSurvey(surveyId){ //redirigir a la encuesta específica
            window.location.href = location.origin + "/surveys_statistics/" + surveyId + "/" + this.date_start + "/" + this.date_end;
        },

// ORIGINAL
        getSurveys(){
            document.getElementById('loadingScreen').classList.remove("d-none")
            this.survey = false
            this.area = false
            this.surveyPAD = {
                    name: 'PAD',
                    description: 'Programa de Atención Domiciliaria',
                    totalTimeToAnswered: 0,
                    totalSurvey: 0,
                    totalSurveySent: 0,
                    totalSurveyViewed: 0,
                    totalSurveyAnswered: 0,
                    puntuacion: {
                        puntuacion: 0,
                        maxPuntuacion: 0,
                    }
                }
            axios.post(window.location.origin+"/getSurveys", {
                dateInit: this.date_start,
                dateEnd: this.date_end,
            // }).then(async res => {
            }).then( async res => {
                this.surveys = []
                this.surveysPad = []
                this.totalSurveys = 0;
                this.totalSurveysSent = 0;
                this.totalSurveysViewed = 0;
                this.totalSurveysAnswered = 0;
                let x = []
                for (const survey of res.data.surveys){
                    this.totalSurveys += survey.totalSurvey;
                    this.totalSurveysSent += survey.totalSurveySent;
                    this.totalSurveysViewed += survey.totalSurveyViewed;
                    this.totalSurveysAnswered += survey.totalSurveyAnswered;
                    // nos traemos las estadisticas de cada encuesta
                    // let x = await axios.post(window.location.origin+"/surveys_statistics_ajax", {
                    x.push(axios.post(window.location.origin+"/surveys_statistics_ajax", {
                            survey_id: survey.id,
                            dateEnd: this.date_end,
                            dateInit: this.date_start
                        })
                        .then(res => {// 'survey', 'totalSurveys', 'totalSurveysSent', 'commentsSurvey', 'maxPuntuacionGlobal', 'puntuacionGlobal'
                            survey.puntuacion = {
                                    survey_id: res.data.survey.id,
                                    puntuacion: res.data.puntuacionGlobal,
                                    maxPuntuacion: res.data.maxPuntuacionGlobal
                                }
                            if(survey.pad === 0){
                                this.surveys.push(survey)
                            }else{
                                this.surveysPad.push(survey)
                            }
                        }).catch(e => {
                            console.log('Error(surveys_statistics_ajax): ',e)
                        })
                    )
                };

                this.getAreas()

                // Espero todas las encuestas
                await Promise.all(x).then(res => {
                    this.surveys.sort((a, b) => a.order - b.order);
                    this.surveysPad.sort((a, b) => a.order - b.order);
                })

                // armo la tarjeta global del pad
                this.surveysPad.forEach(survey => {
                    this.surveyPAD.totalTimeToAnswered += survey.totalTimeToAnswered
                    this.surveyPAD.totalSurvey += survey.totalSurvey
                    this.surveyPAD.totalSurveySent += survey.totalSurveySent
                    this.surveyPAD.totalSurveyViewed += survey.totalSurveyViewed
                    this.surveyPAD.totalSurveyAnswered += survey.totalSurveyAnswered
                    this.surveyPAD.puntuacion.puntuacion += survey.puntuacion.puntuacion
                    this.surveyPAD.puntuacion.maxPuntuacion += survey.puntuacion.maxPuntuacion
                });
                this.surveyPAD.totalTimeToAnswered = this.surveyPAD.totalTimeToAnswered / this.surveysPad.length

                this.survey = true
                document.getElementById('loadingScreen').classList.add("d-none")

            }).catch(e => {

                console.log('Error(getSurveys): ',e)

            })
        },

//ORIGINAL
        getAreas(){
            // document.getElementById('loadingScreen').classList.remove("d-none")
            this.areas = []
            axios.get(window.location.origin+"/getAreas").then(async res => {
                // console.log(res.data)
                let x =[]
                for (const area of res.data){
                    x.push(axios.post(window.location.origin+"/getStatisticsByAreaAjax", { //area_id, dateEnd, dateInit
                            area_id: area.id,
                            dateEnd: this.date_end,
                            dateInit: this.date_start
                        }).then(async res => {
                            // console.log("getStatisticsByAreaAjax --> ",res.data)
                            if(res.data.puntuacionGlobal !== 0){
                                area.puntuacion = {
                                    maxPuntuacionGlobal: res.data.maxPuntuacionGlobal,
                                    puntuacionGlobal: res.data.puntuacionGlobal,
                                    sections: res.data.sections
                                }
                                this.areas.push(area)
                            }
                        // console.log(this.areas)
                        }).catch(e => {
                            console.log('Error(getStatisticsByAreaAjax): ',e)
                        })
                    )
                }
                await Promise.all(x)
                // this.survey = true
                // document.getElementById('loadingScreen').classList.add("d-none")
            })
        }
    },

    mounted() {
        this.getSurveys()
        // setInterval(this.getSurveys,600000)
    },
    created() {
    }
}
</script>

<style scoped>
.progress{
    height: 15px;
}
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
.info-box{
    border-radius: 1.5rem;
}
.info-box .info-box-icon{
    border-radius: 1.5rem 0.25rem 0.25rem 1.5rem;
}
.icono-mano:hover {
  cursor: pointer;
}
.big-icon-envelope {
    position:absolute;
    top: 40px;
    right: 20px;
    z-index:1000;
    font-size:2rem;
    opacity: 0.75;
}
.big-icon-face {
    position:absolute;
    top: 7px;
    right: 20px;
    z-index:1000;
    font-size:2rem;
    opacity: 0.75;
}
.bg-gradient-gris-claro {
    background-color: rgb(181, 180, 177,0.25);
}
.big-text{
    font-size: 1.5rem;
}

</style>
