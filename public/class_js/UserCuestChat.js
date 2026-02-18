import {get,post,meses,is_null,activarTooltip,getFileExtension2, timestamps} from "../helpers/helpers.js";
import UserCuestPaciente from "./UserCuestPaciente.js";
let userCuestPaciente = new UserCuestPaciente()
/*



*/
/*


*/
let AppCreateChat = ()=>{
    return {
        name:"AppListChats",
        template: /*html */ `
            <div class="d-flex flex-column overflow-auto">
                <div class="form-group">
                    <label class="text-secondary">Chat con:</label>
                    <select
                        v-model="form.chat_con"
                        class="form-control-lg border border-gray w-100 bg-light"
                        name="chat_con"
                        id="chat_con"
                    >
                        <option value="paciente">Paciente</option>
                        <option value="medico">Médico</option>
                    </select>
                </div>
                <div class="flex-fill mb-1">
                    <textarea
                        v-model="form.chat_mensaje"
                        class="form-control bg-gray-footer-parodi "
                        name="chat_mensaje"
                        id="chat_mensaje"
                        rows="2"
                        style=" width: 100%;height: 100%;resize: none;"
                        placeholder="Ingrese chat"
                    ></textarea>
                </div>
                <div class="mb-1">
                    <textarea
                        v-model="form.chat_observacion"
                        class="form-control bg-gray-footer-parodi "
                        name="chat_observacion"
                        id="chat_observacion"
                        rows="2"
                        style=" width: 100%;height: 100%;resize: none;"
                        placeholder="Observación"
                    ></textarea>
                </div>
                <div class="mb-1">
                    <input
                        type="file"
                        style="height: calc(2.25rem + 8px);"
                        id="user_file"
                        multiple
                        class="form-control input-lg"
                        >
                </div>

            </div>
        `,

        props: {
            patient_data:Object,
            index:Number,
            form:Object,
            store:Function,
        },
    }
}
let AppChats = ()=>{
    return {
        name:"AppListChats",
        template: /*html */ `
            <div>

                <div v-if="fechas.length > 0" class="timeline timeline-inverse">
                    <div v-for="(item,index) in fechas" :key="index">

                        <div class="time-label">
                            <span :class="'bg-'+color">
                                {{item.fecha}}
                            </span>
                        </div>

                        <div v-for="(item2,index2) in item.items.filter(x=>x.chat_con ===chat_con)" :key="index2">
                            <i :class="'fas fa-comments bg-'+color" style="font-size: 1.2rem;color: white;"></i>
                            <div class="timeline-item">
                                <span class="time">
                                    <i class="far fa-clock"></i>
                                    {{( item2.created_at.split(" ") )[1]}}
                                </span>
                                <h3
                                    data-toggle="collapse"
                                    :href="'#collapseExample'+index2"
                                    role="button"
                                    aria-expanded="false"
                                    aria-controls="collapseExample"
                                    class="timeline-header"
                                >
                                    <b class="text-primary">{{item2.medico}}</b> envió nuevo chat.
                                </h3>
                                <div :id="'collapseExample'+index2" style="white-space: break-spaces;" class="collapse show timeline-body">
                                    <div  v-html="item2.message">

                                    </div>
                                    <div v-if="item2.coments != null && item2.coments != ''">
                                        <b>Observaciones:</b><br>{{item2.coments}}
                                    </div>
                                    <div v-if="!['undefined',undefined,null,'null'].includes(item2.image) && validateFile(item2.image)==='image'"  >
                                        <span v-for="(item3,index3 ) in Array.from(JSON.parse(item2.image))" :key="index3" >
                                            <img
                                                title="Formato de archivo no reconocido"
                                                @click="window.open('image/user/chatPaciente/'+item3, '_blank')"
                                                style="cursor:pointer;width: 100px; height:100px;"
                                                class="img-thumbnail ampliar zoom img-fluid"
                                                src='/image/system/nofound.png'
                                            >

                                        </span>
                                    </div>
                                    <div v-if="!['undefined',undefined,null,'null'].includes(item2.image) && validateFile(item2.image)==='audio'"  >
                                        <span v-for="(item3,index3 ) in Array.from(JSON.parse(item2.image))" :key="index3" >
                                            <audio
                                                controls
                                                :src="'image/user/chatPaciente/'+item3"
                                            >
                                                {{item3}}
                                            </audio>
                                        </span>
                                    </div>
                                    <div v-if="!['undefined',undefined,null,'null'].includes(item2.image) && !['audio','image'].includes(validateFile(item2.image))"  >
                                        <span v-for="(item3,index3 ) in Array.from(JSON.parse(item2.image))" :key="index3" >
                                            <img
                                                onerror="this.src='/image/system/nofound.png';"
                                                @click="window.open('image/user/chatPaciente/'+item3, '_blank')"
                                                style="cursor:pointer;width: 100px; height:100px;"
                                                class="img-thumbnail ampliar zoom img-fluid"
                                                :src="'image/user/chatPaciente/'+item3"
                                            >
                                        </span>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>



                    <div>
                        <i
                            style="font-size: 1.2rem;"
                            class="far fa-clock border border-circle bg-gray"
                        ></i>
                    </div>
                </div>
                <div v-else class="timeline timeline-inverse">
                    <div>
                        <div>
                            <i aria-hidden="true" class="timelime-medic-icon fas fa-comments bg-success text-white"></i>
                            <div class="timeline-item">
                                <div
                                    :class="['text-secondary timeline-body text-center font-weight-bold']"
                                    style="font-size: 1.2rem;"
                                >
                                    No existe historial
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <i
                            style="font-size: 1.2rem;"
                            class="far fa-clock border border-circle bg-gray"
                        ></i>
                    </div>
                </div>
            </div>

        `,
        props: {
            patient_data:Object,
            index:Number,
            getChats:Function,
            chat_row:Function,
            chat_con:String,
            fechas: {
                type: Array,
                default: []
            },
            chats: {
                type: Array,
                default: []
            },
            color: {
                type: String,
                default: "primary"
            },
        },

        methods: {
            validateFile(file){
                Array.from(JSON.parse(file)).forEach(valueOfElement=>{
                    if (
                        ["jpg","jpeg","pbg","bmp"].includes( getFileExtension2(valueOfElement))
                    ) {
                        return 'image'
                    }
                    if (
                        ["mp3","ogg","wav","opus","flac","aac"].includes( getFileExtension2(valueOfElement))
                    ) {
                        return 'audio'
                    }
                })
                return null



            },

        },
        async mounted () {

        },
    }
}
export let index = (patient_data,index_episodio)=>{
    let that = this


    $("#modal-patient-item").modal("show");
    $("#modal-patient-item .modal-body-2").html( /*html */`
        <div id="AppChatWhatsapp" class="flex-fill d-flex flex-column overflow-auto">Cargando...</div>
    `);
    let app = new Vue({
        el:"#AppChatWhatsapp",
        name:"AppChatWhatsapp",
        template: /*html */`
            <div class="flex-fill d-flex flex-column overflow-auto">
                <div id="infoPaciente"></div>
                <div class="d-flex justify-content-between">
                    <h1 class="h1 text-primary">
                        Chat WhatsApp
                    </h1>
                </div>
                <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
                    <li @click="create_active=false" class="nav-item" role="presentation">
                        <a class="nav-link h4 text-success active" id="pills-paciente-tab" data-toggle="pill" href="#pills-paciente" role="tab" aria-controls="pills-paciente" aria-selected="true">Paciente</a>
                    </li>
                    <li @click="create_active=false" class="nav-item" role="presentation">
                        <a class="nav-link h4 text-primary" id="pills-medico-tab" data-toggle="pill" href="#pills-medico" role="tab" aria-controls="pills-medico" aria-selected="false">Médico</a>
                    </li>
                    <li class="ml-auto nav-item" role="presentation">
                        <a @click="create_active=true" class="nav-link h4 text-primary" id="pills-createchat-tab" data-toggle="pill" href="#pills-createchat" role="tab" aria-controls="pills-createchat" aria-selected="false">
                            Nuevo Chat
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
                <div class="flex-fill overflow-auto d-flex flex-column tab-content mb-1" id="nav-tabContent">

                    <div
                        class="flex-fill tab-pane fade show active"
                        id="pills-paciente"
                        role="tabpanel"
                        aria-labelledby="pills-paciente-tab"
                    >
                        <app-list-chats
                            :chats="chats"
                            :patient_data="patient_data"
                            :fechas="fechas"
                            index="index"
                            chat_con="paciente"
                            color="success"
                        />
                    </div>
                    <div
                        class="flex-fill tab-pane fade"
                        id="pills-medico"
                        role="tabpanel"
                        aria-labelledby="pills-medico-tab"
                    >
                        <app-list-chats
                            :chats="chats"
                            :patient_data="patient_data"
                            :fechas="fechas"
                            index="index"
                            chat_con="medico"
                            color="primary"
                        />
                    </div>
                    <div
                        class="flex-fill tab-pane fade"
                        id="pills-createchat"
                        role="tabpanel"
                        aria-labelledby="pills-createchat-tab"
                    >
                        <app-create-chat
                            :form="form"
                            :patient_data="patient_data"
                            index="index"

                        />
                    </div>
                </div>

                <div class="d-flex">
                    <div :class="[{'d-none':!create_active},{'col-12 col-md-6 px-0 pl-md-0 pr-md-1':create_active}]">
                        <button @click="handle_store()"  class="btn btn-success w-100">Agregar</button>
                    </div>
                    <div :class="[{'col-12':!create_active},{'col-12 col-md-6 px-0 pl-md-1 pr-md-0':create_active}]">
                        <button data-dismiss="modal" aria-label="Close"  class="btn btn-primary w-100">Regresar</button>
                    </div>
                </div>
            </div>
        `,
        components: {
            'app-list-chats':AppChats(),
            'app-create-chat':AppCreateChat(),
        },
        data() {
            return {
                create_active:false,
                patient_data: patient_data,
                index:index_episodio,
                chats:[],
                fechas:[],
                form:{
                    files:null,
                    chat_observacion:"",
                    chat_mensaje:"",
                    chat_con:"paciente",
                },

            }
        },
        computed: {

        },
        methods: {

            async chat_row(){

                this.fechas = Array.from( new Set( this.chats.map(x=>{
                    return  ( x.created_at.split(" ") )[0]
                }) ) )
                this.fechas = this.fechas.map(x=>{
                    //console.log("----->",x)
                    let [anio,mes,dia] = x.split("-");
                    //console.log(anio,mes,dia);

                    let fecha = dia + " " + meses(Number(mes)-1).slice(0, 3) + ", " + anio
                    let items = this.chats.filter(y=>{
                            let fecha = ( y.created_at.split(" ") )[0]
                            if(fecha === x){
                                return y
                            }
                        })
                        return  {
                            fecha,
                            items
                        }
                })
            },
            async handle_store(){
                if (this.validate()) {
                    let formData = new FormData();
                    let cant_files = document.getElementById(`user_file`).files.length;
                        //console.log(cant_files);
                        if (cant_files > 0) {
                            for (var i = 0; i < cant_files; i++) {
                                formData.append("files[]", document.getElementById(`user_file`).files[i]);
                            }

                        }else{
                            formData.append("files[]", null);
                        }

                        formData.append('cant_files', cant_files);
                        formData.append('chat_mensaje', this.form.chat_mensaje.trim());
                        formData.append('chat_con',this.form.chat_con  );
                        formData.append('chat_observacion', this.form.chat_observacion.trim());
                        formData.append('user_id_paciente', this.patient_data.user_id);
                        formData.append('created_at', timestamps());
                        formData.append("_token", $("#_token").val())
                        await post(location.origin+"/user_cuest_chat/store", formData);

                        await this.getChats();
                        await this.chat_row();
                    /* let miDivciente = document.getElementById('pills-paciente'); // Reemplaza 'miDiv' con el ID de tu div
                    let miDivmedico = document.getElementById('pills-medico'); // Reemplaza 'miDiv' con el ID de tu div
                        miDivciente.scrollIntoView({ behavior: 'smooth' });
                        miDivmedico.scrollIntoView({ behavior: 'smooth' }); */

                        $('a[href="#pills-'+this.form.chat_con+'"]').tab('show')
                        this.form = {
                            files:null,
                            chat_observacion:"",
                            chat_mensaje:"",
                            chat_con:"paciente",

                        }
                }
            },

            validate() {
                if (this.form.chat_mensaje == "") {
                    alert("El campo Chat no puede estar vacio.")
                    return false;
                }
                return true;
            },


            async getChats(){
                let formdata = new FormData();
                    formdata.append("user_id_paciente", this.patient_data.user_id)
                    formdata.append("_token", $("#_token").val())
                this.chats = await post(location.origin+"/user_cuest_chat/index", formdata)
            },


        },
        async mounted () {
            await this.getChats();
            await this.chat_row();
            userCuestPaciente.infoPaciente("#infoPaciente", this.patient_data.user_id)
        },
    })
}

class UserCuestChat {
    async index(selector, user_id) {

        let formdata = new FormData();
            formdata.append("user_id_paciente", user_id)
            formdata.append("_token", $("#_token").val())
        let response = await post(location.origin+"/user_cuest_chat/index", formdata)

        let chat_paciente
        let chat_medico

        let chat_row = (response,color="primary")=>{
            let fecha;
            let tempFecha;
            let f;
            let chat = "";
                if (response.length > 0) {
                    $.each(response, function(indexInArray, value) {
                        //console.log(response)
                        let image = "";
                        f = new Date(value.created_at);
                        fecha = f.getDate() + " " + meses(f.getMonth()).substr(0, 3) + ", " + f.getFullYear();
                        if (tempFecha != fecha) {
                            chat += `
                                <div class="time-label">
                                    <span class="bg-${color}">
                                        ${fecha}
                                    </span>
                                </div>
                            `;
                            tempFecha = fecha
                        }
                        let comentario = "";
                        if (value.coments != null && value.coments != '') {
                            comentario = "Observaciones: \n" + value.coments;
                        }


                        if (tempFecha == fecha) {
                            if (value.image != "undefined" && value.image != "" && value.image != "null" && value.image != null) {
                                $.each(JSON.parse(value.image), function(indexInArray, valueOfElement) {
                                    if (
                                        getFileExtension2(valueOfElement)=="jpg" ||
                                        getFileExtension2(valueOfElement)=="jpeg" ||
                                        getFileExtension2(valueOfElement)=="png" ||
                                        getFileExtension2(valueOfElement)=="bmp"
                                    ) {
                                        image += `
                                            <img onerror="this.src='/image/system/nofound.png';" onclick="window.open('image/user/chatPaciente/${valueOfElement}', '_blank')" style="cursor:pointer;width: 100px; height:100px;" class="img-thumbnail ampliar zoom img-fluid" src='image/user/chatPaciente/${valueOfElement}'>
                                        `;
                                    }
                                    if (
                                        getFileExtension2(valueOfElement)=="mp3" ||
                                        getFileExtension2(valueOfElement)=="ogg" ||
                                        getFileExtension2(valueOfElement)=="wav" ||
                                        getFileExtension2(valueOfElement)=="opus" ||
                                        getFileExtension2(valueOfElement)=="flac" ||
                                        getFileExtension2(valueOfElement)=="aac"
                                    ) {
                                        image += `
                                            <audio controls src='image/user/chatPaciente/${valueOfElement}'>${valueOfElement}</audio>
                                        `;
                                    }
                                    if (
                                        getFileExtension2(valueOfElement)!="jpg" &&
                                        getFileExtension2(valueOfElement)!="jpeg" &&
                                        getFileExtension2(valueOfElement)!="png" &&
                                        getFileExtension2(valueOfElement)!="bmp" &&
                                        getFileExtension2(valueOfElement)!="mp3" &&
                                        getFileExtension2(valueOfElement)!="ogg" &&
                                        getFileExtension2(valueOfElement)!="wav" &&
                                        getFileExtension2(valueOfElement)!="opus" &&
                                        getFileExtension2(valueOfElement)!="flac" &&
                                        getFileExtension2(valueOfElement)!="aac"
                                    ) {
                                        image += `
                                            <img title="Formato de archivo no reconocido" onclick="window.open('image/user/chatPaciente/${valueOfElement}', '_blank')" style="cursor:pointer;width: 100px; height:100px;" class="img-thumbnail ampliar zoom img-fluid"  src='/image/system/nofound.png'>
                                        `;
                                    }
                                    //console.log(getFileExtension2(valueOfElement));
                                });

                            }

                            chat += /*html */`
                                <div>
                                    <i
                                        class="fas fa-comments bg-${color}"
                                        style="font-size: 1.2rem;color: white;"
                                    ></i>
                                    <div class="timeline-item">
                                        <span class="time">
                                            <i class="far fa-clock"></i>
                                            ${f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds()}
                                        </span>
                                        <h3
                                            data-toggle="collapse"
                                            href="#collapseExample0"
                                            role="button"
                                            aria-expanded="false"
                                            aria-controls="collapseExample"
                                            class="timeline-header"
                                        >
                                            <b class="text-primary">Dr ${value.medico}</b> envió nuevo chat.
                                        </h3>
                                        <div id="collapseExample0" class="collapse show timeline-body">
                                            ${(value.message!=null)?value.message.replace(/\n/g, "<br />"):''}\n\n${comentario.replace(/\n/g, "<br />")}
                                            <br>
                                            ${image}
                                        </div>
                                    </div>
                                </div>
                            `;
                        }



                    });
                } else {
                    chat += /*html */ `
                        <div>
                            <i aria-hidden="true" class="timelime-medic-icon fas fa-comments bg-success text-white"></i>
                            <div class="timeline-item">
                                <div class="timeline-body text-center text-${color} font-weight-bold" style="font-size: 1.2rem;">
                                    No existe historial
                                </div>
                            </div>
                        </div>
                    `;
                }
                return chat;
            }
        let paciente = response.filter(x=>x.chat_con==="paciente")
        let medico = response.filter(x=>x.chat_con==="medico")
            chat_paciente = chat_row( paciente , "success" )
            chat_medico = chat_row( medico, "primary" )
        let that = this
            $("#modal-patient-item").modal("show");
            $("#modal-patient-item .modal-body-2").html(/*html */ `
                <div id="infoPaciente"></div>
                <div class="d-flex justify-content-between">
                    <h1 class="h1 text-primary">
                        Chat WhatsApp
                    </h1>
                    <span id="user_cuest_model_create" onclick="that.create('.modal-body',${user_id})" class="float-right text-shadow-drop-tl text-primary text-right" style="font-size: 2rem !important; cursor:pointer;">
                        Nuevo chat
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </span>
                </div>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link h4 text-success active" id="pills-paciente-tab" data-toggle="pill" href="#pills-paciente" role="tab" aria-controls="pills-paciente" aria-selected="true">Paciente</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link h4 text-primary" id="pills-medico-tab" data-toggle="pill" href="#pills-medico" role="tab" aria-controls="pills-medico" aria-selected="false">Médico</a>
                    </li>
                </ul>

                <div class="tab-content flex-fill overflow-auto mb-1" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="pills-paciente" role="tabpanel" aria-labelledby="pills-paciente-tab">
                        <div style="/* height: 38vh;overflow: auto; */margin-bottom: 1em;">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 text-primary">
                                        <div class="timeline timeline-inverse">
                                            <div>
                                                ${chat_paciente}
                                                <div>
                                                    <i style="font-size: 1.2rem;" class="far fa-clock bg-gray"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-medico" role="tabpanel" aria-labelledby="pills-medico-tab">
                        <div style="/* height: 38vh;overflow: auto; */margin-bottom: 1em;">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 h1 text-primary">
                                        <div class="timeline timeline-inverse">
                                            <div>
                                                ${chat_medico}
                                                <div>
                                                    <i style="font-size: 1.2rem;" class="far fa-clock bg-gray"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <button data-dismiss="modal" aria-label="Close"  class="font-weight-bold btn btn-primary w-100">Regresar</button>
                </div>

            `);






            userCuestPaciente.infoPaciente("#infoPaciente", user_id)


    }
    create(selector, user_id) {
        $("#modal-patient-item").modal("show");
        $("#modal-patient-item .modal-body-2").html( /*html */`
            <div id="infoPaciente"></div>
            <div class="d-flex justify-content-between">
                <h1 class="h1 text-primary">
                    Chat WhatsApp
                </h1>
                <span id="user_cuest_model_create" onclick="this.create('.modal-body',${user_id})" class="float-right text-shadow-drop-tl text-primary text-right" style="font-size: 2rem !important; cursor:pointer;">
                    Nuevo chat
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </span>
            </div>

            <div class="form-group">
                <label class="text-secondary">Chat con:</label>
                <select class="form-control-lg border border-gray w-100 bg-light" name="chat_con" id="chat_con">
                    <option value="paciente">Paciente</option>
                    <option value="medico">Médico</option>
                </select>
            </div>
            <div class="flex-fill mb-1">
                <textarea class="form-control bg-gray-footer-parodi " name="chat_mensaje" id="chat_mensaje" rows="2" style=" width: 100%;height: 100%;resize: none;" placeholder="Ingrese chat"></textarea>
            </div>
            <div class="mb-1">
                <textarea class="form-control bg-gray-footer-parodi " name="chat_observacion" id="chat_observacion" rows="2" style=" width: 100%;height: 100%;resize: none;" placeholder="Observación"></textarea>
            </div>
            <div class="mb-1">
                <input type="file" style="height: calc(2.25rem + 8px);" id="user_file${user_id}" multiple class="form-control input-lg">
            </div>
            <div class="d-flex">
                <button id="user_cuest_model_store" class="font-weight-bold btn btn-success w-100">Agregar</button>
                <button id="regresar" onclick="this.index('.modal-body',${user_id})" class="font-weight-bold btn btn-primary mb-1 w-100">Regresar</button>
            </div>

        `);





        userCuestPaciente.infoPaciente("#infoPaciente", user_id)
        $("#user_cuest_model_store").on("click", function() {
            if (this.validate()) {
                this.store(user_id)
                    .then(response => {
                        console.log("this:", response)
                        this.index('.modal-body', user_id)
                    })
            }

        });
    }
    store(user_id) {
        let formData = new FormData();
        let cant_files = document.getElementById(`user_file${user_id}`).files.length;
        for (var i = 0; i < cant_files; i++) {
            formData.append("files[]", document.getElementById(`user_file${user_id}`).files[i]);
        }

        formData.append('cant_files', cant_files);
        formData.append('chat_mensaje', $("#chat_mensaje").val().trim());
        formData.append('chat_con', $("#chat_con").val() );
        formData.append('chat_observacion', $("#chat_observacion").val().trim());
        formData.append('user_id_paciente', user_id);
        formData.append('created_at', timestamps());
        formData.append("_token", $("#_token").val())
        return post(location.origin+"/user_cuest_chat/store", formData);
    }
    validate() {
        let chat_mensaje = $("#chat_mensaje");
        if (chat_mensaje.val() == "") {
            message = Component.alertMessage("input_text_empty");
            alert(message['message'])
            chat_mensaje.trigger("focus")
            return false;
        }
        return true;
    }
}
