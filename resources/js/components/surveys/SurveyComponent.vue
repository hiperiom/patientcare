<template>
    <div class="container">
        <ul style="padding-inline-start: 10px;">
            <!-- Título de la sección -->
            <li v-for="(section,index) in survey.sections" :key="index" class="my-2 titulo-section" style="list-style-type: none;">
                <span style="color: var(--secondary); font-weight: bold; font-size: 1.5em;">{{ index+1 }} |</span>
                <!-- <a data-toggle="collapse" :href="'#seccion_'+section.id" role="button" aria-expanded="true" aria-controls="seccion_1" class="text-primary h4 font-weight-bold" > {{section.name}} | {{ section.id }}</a> -->
                <a data-toggle="collapse" :href="'#seccion_'+section.id" role="button" aria-expanded="true" aria-controls="seccion_1" class="text-primary h4 font-weight-bold" > {{section.name}}</a>
                <div class="pl-3 collapse show" :id="'seccion_'+section.id" style="">
                    <div class="container-fluid scale-up-ver-top" id="1_preg_1">
                        <!-- Lista de preguntas de la sección  -->
                        <div v-for="(question,index) in section.questions" :key="index" class="row">
                            <div class="col-12 p-0 bd-callout bd-callout-primary">
                                <div class="d-flex align-item mr-3" style="width: fit-content; background-color: #f3eeee !important;border-radius: 0rem 50rem 50rem 0rem !important;">
                                    <!-- <div role="pregunta" class="encuesta-pregunta ml-2">{{ question.description }} | {{ question.id }}</div> -->
                                    <div role="pregunta" class="encuesta-pregunta ml-2">{{ question.description }}</div>
                                </div>
                                <!-- Posibles respuestas a la pregunta -->
                                <div v-if="question.answers.length === 1">
                                    <div class="form-group mx-2 mt-2" >
                                        <textarea
                                            class="form-control"
                                            placeholder="Ingresa tu respuesta..."
                                            style="background-color: #f3eeee !important;color:var(--secondary)"
                                            :id="'answer_question_'+question.id"
                                            @keyup="setAnswer(question.id, question.answers[0].id,'answer_question_'+question.id, '', true)"
                                            rows="2"
                                            maxlength="250">
                                        </textarea>
                                    </div>
                                </div>
                                <!-- setAnswer(question_id, answer_id, comment = "", answerHaveComment = false, desarrollo = false, text = "", multiple = false) -->
                                <div v-else>
                                    <div v-if="question.multiple === 1" class="d-flex flex-row flex-wrap">

                                        <div v-for="(answer,index) in question.answers" :key="index" class="mt-3 pt-1 mx-1">
                                            <a :id="answer.id" class="px-3 py-2 icono-mano text-center" style="font-weight: bold; color:gray"
                                            @click="setAnswer(question.id, answer.id,'',answer.comment,'',answer.text, true)">
                                                <!-- {{ answer.description }} | {{ answer.id }} -->
                                                {{ answer.description }}
                                            </a>
                                        </div>

                                    </div>
                                    <div v-else>
                                        <ul class="nav nav-pills mt-2 flex-row align-items-center font-weight-bold" id="lista_respuesta1" role="lista-respuestas">
                                            <li v-for="(answer,index) in question.answers" :key="index"
                                            class="nav-item pl-2"
                                            role="presentation">
                                                <a  class="nav-link rounded-pill cursor-pointer text-center"
                                                data-toggle="pill"
                                                role="respuesta"
                                                :data-value="answer.value"
                                                :data-pregunta_id="answer.id"
                                                @click="setAnswer(question.id, answer.id,'',answer.comment,'',answer.text, false)"
                                                >
                                                    <!-- {{ answer.description }} | {{ answer.id }} -->
                                                    {{ answer.description }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center text-secondary">
                    <p>Le agradecemos mucho el tiempo que ha dedicado para darnos sus opiniones, las cuales son de mucha importancia para mejorar nuestros servicios.</p>
                    <p>De igual manera, <b>si desea hacer cualquier comentario adicional o darnos cualquier opinión o recomendación, puede hacerlo a continuación.</b></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="label-text text-primary text-center h1 w-100" for="coment">Comentarios personales
                        <small class="text-gray">(opcional)</small></label>
                    <textarea v-model="surveyComment" name="coment" id="coment" class="form-control form-control-lg bg-gray-footer-parodi" placeholder="" aria-describedby="helpComent"></textarea>
                    <small id="helpComent" class="text-muted"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button @click="sentSurvey" id="submit" class="btn btn-success btn-block btn-lg font-weight-bold h3">Enviar
                    encuesta</button>
            </div>
        </div>

<!-- Comienzo del modal de bienvenida -->
        <div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="welcomeModalLabel" data-backdrop="static" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-light">
                    <div class="modal-header">
                        <img src="/image/system/logo-cmdlt_color.svg" style="height: 3em;" class="img-fluid float-right" alt="Imagen CMDLT">
                        <button type="button" class="close btn-close-modal" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="container-fluid bg-primary p-3">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <h3 class="display-4" style="font-size: 2.5em;">
                                        <div class="text-center">
                                            <i style="font-size: 0.8em;">Bienvenido a la</i><br>
                                            {{ survey.description }}
                                        </div>
                                    </h3>
                                    <p class="lead" style="font-size: 1.4em;font-style: italic;"></p>
                                    <div class="h5 text-center">
                                        Gracias por preferirnos y considerarnos<br>
                                        <i><b>el aliado de su salud</b>.<br>
                                        Nuestro propósito<br>
                                        es ofrecerle un excelente servicio<br>
                                        para lo cual sus sugerencias<br>
                                        son muy importantes.<br><br>
                                        Muchas gracias por su tiempo y colaboración.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-2">
                                    <button id="empezarcuestionario" data-dismiss="modal" type="button" class="btn btn-light btn-block btn-lg text-primary"><i>De acuerdo, continuar</i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- Fin del modal de bienvenida -->

    </div>
</template>

<script>

    export default {
        props: ["survey","base_url", "discharged", "platform", "logged"],
        data(){
            return {
                surveyComment:'',
                answers:[],
            }
        },
        methods: {
            setAnswer(question_id, answer_id, comment = "", answerHaveComment = false, desarrollo = false, text = "", multiple = false){

                var flag = false;
                var borrarPregunta = false;

                if(desarrollo){
                    this.answers = this.answers.map(x => {
                        if(x.question === question_id){
                            x.answer = answer_id;
                            x.comment = document.getElementById(comment).value;
                            flag = true;
                        }
                        return x;
                    })
                    if(flag === false && document.getElementById(comment).value != ""){
                        this.answers.push({question:question_id,answer:answer_id, comment:document.getElementById(comment).value})
                    }
                }else{
                    if(answerHaveComment){
                        let mensaje = text === null ? 'Describe, el por qué de tu respuesta...' : text
                        Swal.fire({
                            //title: 'Describe, el por qué de tu respuesta...',
                            title: mensaje,
                            input: 'textarea',
                            inputAttributes: {
                                autocapitalize: 'off'
                            },
                            confirmButtonText: 'Enviar',
                            confirmButtonColor: '#185ba9',
                            showLoaderOnConfirm: true,
                            preConfirm: (res) => {
                                if(multiple === false){
                                    this.answers = this.answers.map(x => {
                                        if(x.question === question_id){
                                            x.answer = answer_id;
                                            x.comment = res;
                                            flag = true;
                                        }
                                        return x;
                                    })
                                    if(flag === false){
                                        this.answers.push({question:question_id,answer:answer_id, comment:res})
                                    }
                                }else{
                                    $('#'+answer_id).toggleClass('back-pill') //marcamos o desmarcamos la respuesta
                                    this.answers = this.answers.map(x => { // recorremos el arreglo de las respuestas
                                        if(x.question === question_id){ // búscamos si ya existe respuestas para la pregunta
                                            if(x.answer.length !== 0){ // verificamos si ya hay respuestas para esa pregunta
                                                if(x.answer.find( y => y === answer_id) !== undefined){ // verificamos si la respuesta a existe entre las existentes
                                                    // console.log('existe en el arreglo!')
                                                    x.answer.splice(x.answer.findIndex((z) => z === answer_id),1) // borramos la respuesta
                                                    if(x.answer.length === 0){ // si la pregunta queda sin respuestas la eliminamos
                                                        console.log('No hay respuestas para la pregunta',question_id)
                                                        borrarPregunta = true
                                                    }
                                                }else{ // si no la respuesta no existe entre las existentes
                                                    // console.log('No existe en el arreglo!')
                                                    x.answer.push(answer_id) // agregamos la respuesta
                                                }
                                            }else{ // no hay respuestas para la pregunta
                                                x.answer.push(answer_id)  // agregamos la respuesta
                                            }
                                            x.comment = res; // agregamos el comentario
                                            flag =true;
                                        }
                                        return x;
                                    })
                                    if(flag === false){
                                        this.answers.push({question:question_id,answer:[answer_id], comment:res}) // agregamos la pregunta con su respuesta
                                    }
                                }
                            }
                        })
                    }else{
                        if(multiple === false){
                            this.answers = this.answers.map(x => {
                                if(x.question === question_id){
                                    x.answer = answer_id;
                                    x.comment = comment;
                                    flag = true;
                                }
                                return x;
                            })
                            if(flag === false){
                                this.answers.push({question:question_id,answer:answer_id, comment:comment})
                            }
                        }else{ // si la pregunta es de selección múltiple
                            $('#'+answer_id).toggleClass('back-pill') //marcamos o desmarcamos la respuesta
                            this.answers = this.answers.map(x => { // recorremos el arreglo de las respuestas
                                if(x.question === question_id){ // búscamos si ya existe respuestas para la pregunta
                                    if(x.answer.length !== 0){ // verificamos si ya hay respuestas para esa pregunta
                                        if(x.answer.find( y => y === answer_id) !== undefined){ // verificamos si la respuesta a existe entre las existentes
                                            // console.log('existe en el arreglo!')
                                            x.answer.splice(x.answer.findIndex((z) => z === answer_id),1) // borramos la respuesta
                                            if(x.answer.length === 0){ // si la pregunta queda sin respuestas la eliminamos
                                                console.log('No hay respuestas para la pregunta',question_id)
                                                borrarPregunta = true
                                            }
                                        }else{ // si no la respuesta no existe entre las existentes
                                            // console.log('No existe en el arreglo!')
                                            x.answer.push(answer_id) // agregamos la respuesta
                                        }
                                    }else{ // no hay respuestas para la pregunta
                                        x.answer.push(answer_id)  // agregamos la respuesta
                                    }
                                    x.comment += comment; // agregamos el comentario
                                    flag =true;
                                }
                                return x;
                            })
                            if(flag === false){
                                this.answers.push({question:question_id,answer:[answer_id], comment:comment}) // agregamos la pregunta con su respuesta
                            }
                        }
                    }
                }
                if(borrarPregunta){
                    this.answers.splice(this.answers.findIndex((z) => z === question_id),1) // borramos la pregunta
                }
            },
            sentSurvey(){
                // console.log("Ruta --> " + this.base_url+"sendAnswers");
                // console.log("Ruta con JavaScript --> " + window.location.origin + "/sendAnswers")
                // axios.post(this.base_url+"sendAnswers", {
                axios.post(window.location.origin+"/sendAnswers", {
                    token: this.discharged.token,
                    survey_id: this.survey.id,
                    answers: this.answers,
                    comment: this.surveyComment,
                    platform: this.platform
                }).then(res => {
                    Swal.fire({
                        title: 'Gracias!',
                        text: "Sus respuestas son de mucha ayuda para nosotros!",
                        icon: 'success',
                        showCancelButton: true,
                        cancelButtonColor: '#009933',
                        cancelButtonText: 'Revisar mis respuestas',
                        confirmButtonColor: '#185ba9',
                        confirmButtonText: 'Continuar'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            if(this.logged){
                                // alert("El usuario isLogged")
                                window.location.href = location.origin +"/surveyInsituIndex";
                            }else{
                                // alert("El usuario dontisLogged")
                                window.location.href = "https://www.cmdlt.edu.ve/";
                            }
                        }
                    })
                }).catch(e => {
                    Swal.fire({
                        title: 'Mmm...',
                        text: "Algo salió mal, intentalo nuevamente!",
                        icon: 'error',
                        showCancelButton: true,
                        cancelButtonColor: '#3085d6',
                        cancelButtonText: 'Intentar de nuevo',
                        confirmButtonColor: '#185ba9',
                        confirmButtonText: 'Cancelar'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "https://www.cmdlt.edu.ve/";
                        }
                    })
                })
            }
        },
        mounted() {
            $('#welcomeModal').modal('toggle');
            document.getElementById('loadingScreen').classList.add("d-none");
        }
    }
</script>

<style scoped>
.back-pill {
    background-color: var(--success);
    color: white !important;
    /* border-radius: 1.5rem 0.25rem 0.25rem 1.5rem; */
    border-radius: 1.5rem;
}
.icono-mano:hover {
  cursor: pointer;
  color:var(--primary) !important;
  font-weight: bold;
}
</style>
