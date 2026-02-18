<template>
    <!-- control -->
    <span style="position:relative;">
        <div class="progress" style="height:15px; z-index: 1000; position: absolute; background:none;" :style="'width: '+ Math.round((surveyp.totalSurveyAnswered*100)/surveyp.totalSurvey) +'%;'">
            <div class="progress-bar bg-success progress-bar-striped tooltip-success" style="border-radius: 0px 7.5px 7.5px 0px; width: 100%;"  role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" :title="surveyp.totalSurveyAnswered+' encuesta'+((surveyp.totalSurveyAnswered!==1)?'s':'')+' contestada'+((surveyp.totalSurveyAnswered!==1)?'s':'')"></div>
        </div>
        <div class="progress" style="height:20px; z-index: 900; position: absolute; background:none;" :style="'width: '+ Math.round((surveyp.totalSurveyViewed*100)/surveyp.totalSurvey) +'%;'">
            <div class="progress-bar bg-warning progress-bar-striped tooltip-warning" style="border-radius: 0px 10px 10px 0px; width: 100%; " role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" :title="surveyp.totalSurveyViewed+' encuesta'+((surveyp.totalSurveyViewed!==1)?'s':'')+' visualizada'+((surveyp.totalSurveyViewed!==1)?'s':'')"></div>
        </div>
        <div class="progress" style="height:25px; z-index: 800; border-radius: 0px 12.5px 12.5px 0px;">
            <div class="progress-bar bg-secondary progress-bar-striped tooltip-secondary" :style="'width: '+ Math.round((surveyp.totalSurveySent*100)/surveyp.totalSurvey) +'%; border-radius: 0px 12.5px 12.5px 0px;'" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" :title="surveyp.totalSurveySent+' encuesta'+((surveyp.totalSurveySent!==1)?'s':'')+' enviada'+((surveyp.totalSurveySent!==1)?'s':'')"></div>
        </div>
    </span>
    <!-- fin de control -->
</template>

<script>
export default {
    props: ["surveyp"],
    data() {
        return {
            // survey:{}
            // titleSecondary: this.surveyp.totalSurveySent+' encuesta'+((this.surveyp.totalSurveySent!==1)?'s':'')+' enviada'+((this.surveyp.totalSurveySent!==1)?'s':'')
        };
    },

    methods: {},
    updated(){
    },
    created() {
        // this.survey = this.surveyp
        $(document).ready(function () { //activa los tooltips (hay que desactivar las que no se estén usando en el componente)
            $('[data-toggle="tooltip"].tooltip-primary').tooltip({customClass:'tooltip-primary'})
            $('[data-toggle="tooltip"].tooltip-warning').tooltip({customClass:'tooltip-warning'})
            $('[data-toggle="tooltip"].tooltip-secondary').tooltip({customClass:'tooltip-secondary'})
            $('[data-toggle="tooltip"].tooltip-success').tooltip({customClass:'tooltip-success'})
            // $('[data-toggle="tooltip"].tooltip-info').tooltip({customClass:'tooltip-info'})
            $('[data-toggle="tooltip"].tooltip-danger').tooltip({customClass:'tooltip-danger'})
        });
    },
};
</script>
<style scoped>

</style>
