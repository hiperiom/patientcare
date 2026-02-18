import UserMedico from "./UserMedico.js";
import Component from "./Component.js";
import UserCuestPaciente from "./UserCuestPaciente.js";
import UserCuestHistoria from "./UserCuestHistoria.js";
import {get} from "../helpers/helpers.js";

//INSTANCIAS DE CLASE
let userCuestPaciente = new UserCuestPaciente()
let userMedico = new UserMedico()
let userCuestHistoria = new UserCuestHistoria()
let component = new Component()
/************* */

let forseReloadForEvoidCache = async ()=>{
    let system_version = await get("/forseReloadForEvoidCache")
    // Obtiene el valor almacenado en el localStorage
    console.log("system_version:",system_version.version_value );


        if(system_version.success){

            console.log("El sistema se ha actualizado a una versión más reciente. "+ system_version.version_value)
            const parametroRandomico = Math.random(); // Genera un valor aleatorio
                const nuevaURL = location.origin + `/medico?version=${system_version.version_value}&force=${parametroRandomico}`;
                window.location.href = nuevaURL; // Recarga la página con el nuevo parámetro

        }

}
let handleInactiveTime = ()=>{
    // Define una variable para almacenar el tiempo de inactividad (en milisegundos)
        let inactivityTimeout = 60000; // 1 minuto

        // Define una función para manejar la inactividad
        function handleInactivity() {
            // Aquí puedes realizar acciones cuando se detecta inactividad
            console.log("El usuario está inactivo. ¡Haz algo!");
            forseReloadForEvoidCache()
        }

        // Reinicia el temporizador cuando se detecta movimiento del mouse
        function resetInactivityTimer() {
            clearTimeout(inactivityTimer);
            inactivityTimer = setTimeout(handleInactivity, inactivityTimeout);
        }

        // Agrega el evento 'mousemove' al documento
        document.addEventListener("mousemove", resetInactivityTimer);

        // Inicia el temporizador al cargar la página
        let inactivityTimer = setTimeout(handleInactivity, inactivityTimeout);

}
let validateActiveSesion = async ()=>{
    let minutos = 1; //valor a cambiar
    const tiempoInicial = Date.now();
    let milisegundos = minutos * 60000;
    //let milisegundos = minutos * 10000;
        setInterval( async function() {
            const tiempoActual = Date.now();
            const tiempoTranscurrido = ((tiempoActual - tiempoInicial) / 1000).toFixed(0);
            //console.log(`Tiempo transcurrido: ${tiempoTranscurrido} seg`);
            //await forseReloadForEvoidCache()
            handleInactiveTime()
            let response = await get('/sessionExist')
                if (response) {
                    message = Component.alertMessage("expire_sesion");
                    Swal.fire({
                        icon: message['imagen'],
                        title: message['title'],
                        text: message['message'],
                        timer: 15000,
                        didOpen: () => {
                            setTimeout(() => {
                                location.href = '/finalizarSesion'
                            }, 14000)
                        },
                    }).then((result) => {

                        if (result.isConfirmed) {
                            location.href = '/finalizarSesion'
                        }
                        if (result.dismiss === Swal.DismissReason.timer) {
                            location.href = '/finalizarSesion'
                        }
                    })
                }

        }, milisegundos);
    }



let handleCintilloPacienteVisibility = ()=>{
    let visibility = localStorage.getItem('cintilloVisibility')

        if (visibility ==='true') {
            localStorage.setItem('cintilloVisibility',false)
        }else{
            localStorage.setItem('cintilloVisibility',true)
        }
}
    /*
        let loading2 = () => {
            return `
                <div class="scale-up-hor-left my-1 d-flex justify-content-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            `
        } */

    d.addEventListener("click", async (e) => {
        if (e.target.matches(".handleCintilloPacienteVisibility")) {
            handleCintilloPacienteVisibility()
        }
        if (e.target.matches(".user-paciente-create")) {
            userCuestPaciente.createPaciente()
        }
        if (e.target.matches(".menu-emergencia")) {
            UserCuestPad.menuAccionEnfermeria(e.target.dataset.area, e.target.dataset.titlearea)
        }
        if (e.target.matches(".menu-postquirurgico")) {
            UserCuestPad.menuAccionEnfermeria(e.target.dataset.area, e.target.dataset.titlearea)
        }
        if (e.target.matches(".menu-medico")) {
            UserCuestPad.menuAccionEnfermeria(e.target.dataset.area, e.target.dataset.titlearea)
        }
        if (e.target.matches(".btn-cintillo-imp-diag")) {
            let patient_data = pacientes_datos[ e.target.dataset.index ]
                userCuestHistoria.index(patient_data,e.target.dataset.index)
        }
        if (e.target.matches(".btn-alert")) {
            let model = new UserCuestAlert({
                "value": e.target.dataset['value'],
                "episodio_id": e.target.dataset['episodio_id'],
                "user_id_paciente": e.target.dataset['user_id_paciente']
            });
            model.create()
        }
        if (e.target.matches(".btn-resbalar")) {
            let model = new UserCuestResbalar({
                "value": e.target.dataset['value'],
                "episodio_id": e.target.dataset['episodio_id'],
                "user_id_paciente": e.target.dataset['user_id_paciente']
            });
            model.create()
        }
        if (e.target.matches(".btn-cirugia")) {
            let model = new UserCuestRiesgoQuirurgico({
                "value": e.target.dataset['value'],
                "episodio_id": e.target.dataset['episodio_id'],
                "user_id_paciente": e.target.dataset['user_id_paciente']
            });
            model.create()
        }
        if (e.target.matches(".btn-vip")) {
            let model = new UserVIP({
                "value": e.target.dataset['value'],
                "episodio_id": e.target.dataset['episodio_id'],
                "user_id_paciente": e.target.dataset['user_id_paciente']
            });
            model.create()
        }
        if (e.target.matches("#submit_vip")) {
            let model = new UserVIP({
                "value": e.target.dataset['value'],
                "episodio_id": e.target.dataset['episodio_id'],
                "user_id_paciente": e.target.dataset['user_id_paciente']
            });
            model.store()
        }
        if (e.target.matches("#submit_alert")) {
            let model = new UserCuestAlert({
                "value": e.target.dataset['value'],
                "episodio_id": e.target.dataset['episodio_id'],
                "user_id_paciente": e.target.dataset['user_id_paciente']
            });
            model.store()
        }
        if (e.target.matches("#submit_resbalar")) {
            let model = new UserCuestResbalar({
                "value": e.target.dataset['value'],
                "episodio_id": e.target.dataset['episodio_id'],
                "user_id_paciente": e.target.dataset['user_id_paciente']
            });
            model.store()
        }
        if (e.target.matches("#submit_cirugia")) {
            let model = new UserCuestRiesgoQuirurgico({
                "value": e.target.dataset['value'],
                "episodio_id": e.target.dataset['episodio_id'],
                "user_id_paciente": e.target.dataset['user_id_paciente']
            });
            model.store()
        }

    })
    d.addEventListener("DOMContentLoaded", async () => {
        let visibility = localStorage.getItem('cintilloVisibility')
            //console.log(visibility);
            if (visibility ===null) {
                localStorage.setItem('cintilloVisibility',true)
            }
        component.ViewEnfermeria()
        handleInactiveTime()
        localStorage.setItem("current_route",location.pathname)
        cat_ubicaciones = await get("/cat_user_ubicacion/getAll")
        userMedico.getMedicosByCargo();
        validateActiveSesion()
    })



/************* */

