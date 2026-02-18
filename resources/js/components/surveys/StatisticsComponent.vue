<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="info-box bg-primary text-white"><span class="info-box-icon bg-primary"><i class="far fa-file-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text font-weight-bold text-white">Encuestas<br>Contestadas</span>
                        <span class="info-box-number text-white">{{ totalSurveysAnswered }} - <span style="background:white;font-size:1rem;padding: 0 0.2em;letter-spacing: 1.1pt;color:var(--primary);" class="badge badge-info"><b>{{ Math.round((totalSurveysAnswered*100)/totalSurveysSent) }}%</b></span></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box"><span class="info-box-icon bg-primary"><i class="far fa-paper-plane"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text text-primary font-weight-bold">Encuestas<br>Enviadas</span>
                        <span class="info-box-number text-secondary">{{ totalSurveysSent }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box"><span class="info-box-icon bg-primary"><i class="far fa-calendar-alt"></i></span>
                    <!-- <div class="info-box-content">
                        <label for="date_start" class="info-box-text text-primary">Desde</label>
                        <input @input="getStatistics" id="date_start" type="date" v-model="date_start" class="border-0 text-secondary input-date font-weight-bold">
                    </div> -->
                    <div class="info-box-content">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="date_start" class="info-box-text text-primary">Desde</label>
                            </div>
                            <div class="col-md-6 text-right text-primary">
                                <i @click="getStatistics" class="fa fa-search" style="cursor: pointer;"></i>
                            </div>
                        </div>
                        <input @keyup.enter="getStatistics" id="date_start" type="date" v-model="date_start" class="border-0 text-secondary input-date font-weight-bold">
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="info-box"><span class="info-box-icon bg-primary"><i class="far fa-calendar-alt"></i></span>
                    <!-- <div class="info-box-content">
                        <label for="date_end" class="info-box-text text-primary">Hasta</label>
                        <input @input="getStatistics" id="date_end" type="date" v-model="date_end" class="border-0 text-secondary input-date font-weight-bold">
                    </div> -->
                    <div class="info-box-content">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="date_start" class="info-box-text text-primary">Hasta</label>
                            </div>
                            <div class="col-md-6 text-right text-primary">
                                <i @click="getStatistics" class="fa fa-search" style="cursor: pointer;"></i>
                            </div>
                        </div>
                        <input @keyup.enter="getStatistics" id="date_start" type="date" v-model="date_end" class="border-0 text-secondary input-date font-weight-bold">
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div v-for="(section,index) in currentSurvey.sections" :key="index" class="col-lg-3 col-6">
                <a href="#" class="btn-sample" @click="showQuestionStatistics(section)">
                    <div class=" small-box"
                        :class="{
                            'bg-primary': section.maxPuntuacion === 0,
                            'bg-success': (((section.puntuacion*100)/section.maxPuntuacion) >= 80) && section.maxPuntuacion != 0 ? true : false,
                            'bg-warning': (((section.puntuacion*100)/section.maxPuntuacion) < 80) && section.maxPuntuacion != 0 ? true : false,
                            'bg-danger': (((section.puntuacion*100)/section.maxPuntuacion) < 50) && section.maxPuntuacion != 0 ? true : false,
                        }"
                        style="height: 130px;">
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
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="pb-3 pt-2" style="border-top:3px solid #185ba9; border-radius: 0.25em;">
                    <a data-toggle="collapse" href="#collapseOpinions" aria-expanded="false" aria-controls="collapseExample">
                        <h3 class="card-title w-100 text-center text-primary pa-2">Opiniones <span class="badge badge-primary">{{ commentsSurvey.length }}</span></h3>
                    </a>
                </div>
                <div class="collapse card-header" id="collapseOpinions">
                    <div class="card card-body" style="width: 100%; box-shadow: none;">
                        <div v-for="(comment,index) in commentsSurvey" :key="index">
                            <div class="direct-chat-messages" style="">
                                <div class="direct-chat-msg">
                                    <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-timestamp float-right">{{ comment.dateSent }}</span>
                                    </div>
                                        <img class="direct-chat-img" src="/image/system/icono-paciente-blanco.svg">
                                    <div class="direct-chat-text">{{ comment.comment }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal de las estadísticas de la sección  -->


    <section-statistics-component :section="currentSection" :date-start="date_start" :date-end="date_end"></section-statistics-component>

    </div>
</template>

<script>
export default {
    props: ["survey","base_url","date_start","date_end"],
    data(){
        return {
            // date_start:"2023-01-01",
            // date_end: new Date().toLocaleDateString('en-CA'),
            opiniones: false,
            commentsSurvey:[],
            totalSurveys:0,
            totalSurveysSent:0,
            totalSurveysViewed: 0,
            totalSurveysAnswered: 0,
            currentSurvey:[],
            currentSection:[]
        }
    },
    methods: {
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
                this.totalSurveysViewed = res.data.totalSurveysViewed;
                this.totalSurveysAnswered = res.data.totalSurveysAnswered;
                document.getElementById('loadingScreen').classList.add("d-none")
            }).catch(e => {

            })
        },
        showQuestionStatistics(section){
            this.currentSection = section;
            $('#sectionModal').modal('toggle');
        }
    },
    mounted(){
        console.log(`start -> ${this.date_start}`)
        this.getStatistics();
    },
    created() {
        // console.log('survey -> ',this.survey);

        // this.getStatistics();
    }
}

</script>

<style scoped>
.info-box{
    border-radius: 1.5rem;
}
.info-box .info-box-icon{
    border-radius: 1.5rem 0.25rem 0.25rem 1.5rem;
}
</style>
