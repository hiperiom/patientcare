import UserCuestPaciente from "./UserCuestPaciente.js";
import UserMedico from "./UserMedico.js";
import {get} from "../helpers/helpers.js";

//INSTANCIAS DE CLASE
let userCuestPaciente = new UserCuestPaciente()
//let component = new UserMedico()
/************* */


    d.addEventListener("DOMContentLoaded", async () => {
        //userCuestPaciente.create2("#content_1")
        UserMedico.getMedicosByCargo();
    })



/************* */

