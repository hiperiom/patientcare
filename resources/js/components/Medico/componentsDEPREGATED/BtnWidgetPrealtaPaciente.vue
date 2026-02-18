<template>
    <div class="flex-fill p-1 d-flex flex-column overflow-auto">

        <!--  <CintilloModal :index_row="index_row" :dataPaciente="dataPaciente" /> -->
        <div class="flex-fill mt-1 rounded overflow-auto">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 h3 text-primary font-weight-bold text-center">
                        Fecha Probable de Alta
                    </div>
                    <div id="calendar" :data-user_id="dataPaciente.user_id" class="col-12 daterange" style="width: 100%">
                    </div>
                    <div class="col-6">
                        <button @click="store()" :data-user_id="dataPaciente.user_id"
                            class="btn btn-success btn-block my-1">Confirmar Prealta</button>
                    </div>
                    <div class="col-6">
                        <button @click="destroy()" class="btn btn-danger btn-block my-1">Cancelar Prealta</button>
                    </div>
                </div>
            </div>



        </div>
        <div class="rounded mt-1">
            <button class="btn btn-primary w-100" data-dismiss="modal" aria-label="Close">
                Regresar
            </button>
        </div>

    </div>
</template>

<script>
import { get,post, is_empty,meses, capitalize, is_null, is_undefined } from '../../../helpers/customHelpers';
import CintilloModal from './CintilloModal.vue';
import 'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css';

import 'bootstrap-datepicker';
export default {
    name: "BtnWidgetPrealtaPaciente",
    props: {
        index_row: Number,
        dataPaciente: Object
    },
    components: {
        CintilloModal
    },
    data() {
        return {

        }
    },
    methods: {
        prefixRoute(){
            return "user_cuest_episodio";
        },
        async updatePrealta(valor){

            let formdata = new FormData();
            formdata.append("user_id", this.dataPaciente.user_id)
            formdata.append("_token", $("#_token").val())
            formdata.append("valor", valor)
            return await post( location.origin+"/"+this.prefixRoute() +"/prealta", formdata)

        },
        destroy(){
            this.updatePrealta(null)
                .then(response => {
                    let d = document;
                        entById(`fecha_prealta_${this.dataPaciente.user_id}`).value = ""
                    let btn = d.querySelector(`#col_1_${this.dataPaciente.user_id} .calendar-prealta`)
                        btn.classList.replace("fa-calendar-check","fa-calendar");

                        ["info","danger","warning","success"].forEach(x=>btn.classList.remove("text-"+x))
                        btn.classList.add("text-gray")
                    let card = d.querySelector(`#col_1_${this.dataPaciente.user_id} #card_prealta_${this.dataPaciente.user_id}`)
                        card.classList.add("d-none");
                        ["info","danger","warning","success"].forEach(x=>{
                            card.classList.remove("tooltip-"+x)
                            card.classList.remove("bg-"+x)
                        })
                        card.classList.add("tooltip-info")
                        card.classList.add("bg-info")
                        this.dataPaciente.prealta = null;
                        this.dataPaciente.prealta_color = "info";
                        let newRow = this.dataPaciente
                        this.$store.commit('updateEpisodio', {
                            index:this.index_row,
                            fieldValue:newRow,
                        });

                        d.querySelectorAll(`.row_${this.dataPaciente.user_id} > td`).forEach(x=>{x.classList.replace("prealta","bg-gray-2");})
                        //activarTooltip()
                        $("#messageModal").modal("hide")
                })
        },
        store(){
            let d = document;
            let fecha = entById(`fecha_prealta_${ this.dataPaciente.user_id}`).value
                if (fecha !== "") {
                    let date_1 = new Date(fecha);
                    let date_1N = new Date(date_1.getFullYear() , (date_1.getMonth()+1) , date_1.getDate()+1)
                    let date_2 = new Date(Date.now());
                    let date_2N = new Date(date_2.getFullYear() , (date_2.getMonth()+1) , date_2.getDate());

                    if (date_1N.getTime() < date_2N.getTime()) {
                        alert("La fecha ingresada no puede ser anterior a hoy.");

                    }else{
                        this.updatePrealta(fecha)
                        .then(response => {
                            let btn = d.querySelector(`#col_1_${ this.dataPaciente.user_id} .calendar-prealta`)
                                btn.classList.replace("fa-calendar","fa-calendar-check");
                                ["info","danger","warning","success","gray"].forEach(x=>btn.classList.remove("text-"+x))
                                btn.classList.add("text-"+this.prealtaColor(fecha))
                            let card = d.querySelector(`#col_1_${ this.dataPaciente.user_id} #card_prealta_${ this.dataPaciente.user_id}`)
                                card.classList.remove("d-none");
                                card.classList.add("bg-"+this.prealtaColor(fecha))
                                if(
                                    this.prealtaColor(fecha) !== "danger" &&
                                    this.prealtaColor(fecha) !== "warning"
                                ) {
                                    card.classList.remove('heartbeat_infinity');
                                }else{
                                    card.classList.add('heartbeat_infinity')

                                }

                                if(
                                    this.prealtaColor(fecha) === "danger"
                                ) entById('title_prealta_'+ this.dataPaciente.user_id).innerHTML="ALTA";
                                if(
                                    this.prealtaColor(fecha) === "warning"
                                ) entById('title_prealta_'+ this.dataPaciente.user_id).innerHTML="PRE-ALTA";
                                if(
                                    this.prealtaColor(fecha) === "success"
                                ) entById('title_prealta_'+ this.dataPaciente.user_id).innerHTML="PRE-ALTA";


                                //console.log("prealta:",this.prealtaColor(fecha));
                                if(this.prealtaColor(fecha) !== "success"){
                                    d.querySelectorAll(`.row_${ this.dataPaciente.user_id} > td`).forEach(x=>{x.classList.replace("bg-gray-2","prealta");})
                                }else{
                                    d.querySelectorAll(`.row_${ this.dataPaciente.user_id} > td`).forEach(x=>{x.classList.replace("prealta","bg-gray-2");})
                                }
                                this.dataPaciente.prealta = fecha;
                                this.dataPaciente.prealta_color = this.prealtaColor(fecha);
                                let newRow = this.dataPaciente
                                this.$store.commit('updateEpisodio', {
                                    index:this.index_row,
                                    fieldValue:newRow,
                                });

                                //activarTooltip()
                                $("#messageModal").modal("hide")
                        })
                    }
                }else{
                    alert("No has seleccionado un día")
                }
        },

        prealtaColor(fecha){
            let date_1 = new Date(fecha);
            let date_1N = new Date(date_1.getFullYear() , (date_1.getMonth()+1) , date_1.getDate()+1)
            let date_2 = new Date(Date.now());
            let date_2N = new Date(date_2.getFullYear() , (date_2.getMonth()+1) , date_2.getDate());

            //console.log(date_1N.getTime(),date_2N.getTime())

            let day_as_milliseconds = 86400000;
            let diff_in_millisenconds = date_1N.getTime() - date_2N.getTime();
            let diff_in_days = diff_in_millisenconds / day_as_milliseconds;
console.log("diff_in_days",diff_in_days)
            if (parseInt(diff_in_days) < 0) {
                diff_in_days = 0;
            }
            //console.log(diff_in_days)
            if (parseInt(diff_in_days) >= 2) {
                return "success"
            }
            if (parseInt(diff_in_days) === 1) {
                return "warning"
            }
            if (parseInt(diff_in_days) === 0) {
                return "danger"
            }
            return  false ;
        }
    },
    mounted() {
        !function(a){a.fn.datepicker.dates.es={days:["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"],daysShort:["Dom","Lun","Mar","Mié","Jue","Vie","Sáb"],daysMin:["Do","Lu","Ma","Mi","Ju","Vi","Sa"],months:["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],monthsShort:["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"],today:"Hoy",monthsTitle:"Meses",clear:"Borrar",weekStart:1,format:"dd/mm/yyyy"}}(jQuery);
        console.log($('#calendar'));
        $('#calendar').datepicker({
            language: "es",
            toggleActive: true,
            todayHighlight: true,
        });
        let that = this
        $('#calendar').datepicker().on("changeDate", function(e) {
            let d = document;
            let f = new Date(e.date);
            let fechaIngreso = f.getFullYear() + "-" + String((f.getMonth()+1)).padStart(2, '0') + "-" + String(f.getDate()).padStart(2, '0');
                document.getElementById(`fecha_prealta_${that.dataPaciente.user_id}`).value=fechaIngreso
            let btn = d.querySelector(`#col_1_${that.dataPaciente.user_id} .calendar-prealta`);


                ["info","danger","warning","success"].forEach(x=>btn.classList.remove("text-"+x))
                btn.classList.add("text-"+that.prealtaColor(fechaIngreso))
                let card = d.querySelector(`#col_1_${that.dataPaciente.user_id} #card_prealta_${that.dataPaciente.user_id}`);
                    console.log(card);
                ["info","danger","warning","success"].forEach(x=>{
                    card.classList.remove("tooltip-"+x)
                    card.classList.remove("bg-"+x)
                })
                console.log('prealtaColor',that.prealtaColor(fechaIngreso));
                if(
                    that.prealtaColor(fechaIngreso) === "danger"
                ) entById('title_prealta_'+that.dataPaciente.user_id).innerHTML="ALTA";
                if(
                    that.prealtaColor(fechaIngreso) === "warning"
                ) entById('title_prealta_'+that.dataPaciente.user_id).innerHTML="PRE-ALTA";
                if(
                    that.prealtaColor(fechaIngreso) === "success"
                ) entById('title_prealta_'+that.dataPaciente.user_id).innerHTML="PRE-ALTA";


                card.classList.add("tooltip-"+that.prealtaColor(fechaIngreso))
                card.classList.add("bg-"+that.prealtaColor(fechaIngreso))
                fechaIngreso =  f.getDate() + "/" + String(meses(f.getMonth()).slice(0,3)).toUpperCase()  + "/" +  f.getFullYear();
                card.querySelectorAll("div")[1].textContent=fechaIngreso
        });
    }
}
</script>

<style scoped>
.bg-transparent {
    background-color: transparent !important;
    border: 0px !important
}

.btn-default-custom {
    background-color: transparent;
}

.btn-default-custom:hover {
    background-color: #e2e2e2;
}

.heartbeat:hover {
    -webkit-animation: heartbeat 1.5s ease-in-out infinite both;
    animation: heartbeat 1.5s ease-in-out infinite both
}

@-webkit-keyframes heartbeat {
    from {
        -webkit-transform: scale(1);
        transform: scale(1);
        -webkit-transform-origin: center center;
        transform-origin: center center;
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out
    }

    10% {
        -webkit-transform: scale(.91);
        transform: scale(.91);
        -webkit-animation-timing-function: ease-in;
        animation-timing-function: ease-in
    }

    17% {
        -webkit-transform: scale(.98);
        transform: scale(.98);
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out
    }

    33% {
        -webkit-transform: scale(.87);
        transform: scale(.87);
        -webkit-animation-timing-function: ease-in;
        animation-timing-function: ease-in
    }

    45% {
        -webkit-transform: scale(1);
        transform: scale(1);
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out
    }
}

@keyframes heartbeat {
    from {
        -webkit-transform: scale(1);
        transform: scale(1);
        -webkit-transform-origin: center center;
        transform-origin: center center;
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out
    }

    10% {
        -webkit-transform: scale(.91);
        transform: scale(.91);
        -webkit-animation-timing-function: ease-in;
        animation-timing-function: ease-in
    }

    17% {
        -webkit-transform: scale(.98);
        transform: scale(.98);
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out
    }

    33% {
        -webkit-transform: scale(.87);
        transform: scale(.87);
        -webkit-animation-timing-function: ease-in;
        animation-timing-function: ease-in
    }

    45% {
        -webkit-transform: scale(1);
        transform: scale(1);
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out
    }
}


</style>
