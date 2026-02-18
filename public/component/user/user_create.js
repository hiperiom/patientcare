import {index as CatUserEstado_index} from '../catalogs/cat_estado.js'
import {index as CatUserMunicipio_index} from '../catalogs/cat_municipio.js'
import {step_1 as PageLogin} from './login.js'
//import {handle_paciente_create_cita, handle_tablaCitas,updateCitas} from '../medico/medico_home.js'
import {getAll as getUserProfileImages} from './user_profile_images.js'
import * as ComponentBuscador from '../medico/search.js'
import {show as getTarjetaSoyChacao} from './user_tarjeta_soy_chacao.js'
import { add_row } from '../../helpers/helpers.js'
let d = document
let $App = entById("App")
let formFields_validate= async (e)=>{
    let
        {
            cedula          ,
            email           ,
            password        ,
            password_repeat ,
            nombres         ,
            apellidos       ,
            genero          ,
            fnacimiento     ,
            telefono_movil  ,
            cat_estado_id   ,
            cat_municipio_id,
            description     ,
            domicilio       ,
            tarjeta_soy_chacao       ,
            cat_user_ubicacion_id       ,
            fecha_ingreso       ,
        } = useState['formCreatePaciente'];
        let input; // = d.querySelector(`select[name='tipo_registro']`)
            /* if (tipo_registro =="Familiar") {
                if (is_empty( cedula_personal )) {
                    input = d.querySelector(`input[name='cedula_personal']`)
                    console.log(input.title)
                    Toast.fire({
                        icon: 'warning',
                        title: 'Atención',
                        text: input.title,
                        didClose: () => {
                            setTimeout(() => input.focus() , 110);
                        }
                    })
                    return false
                }
                if (is_empty( cat_user_family_id )) {
                    input = d.querySelector(`select[name='cat_user_family_id']`)
                    Toast.fire({
                        icon: 'warning',
                        title: 'Atención',
                        text: input.title,
                        didClose: () => {
                            setTimeout(() => input.focus() , 110);
                        }
                    })
                    return false
                }
            } */
        if (is_empty( cedula )) {
                input = d.querySelector(`input[name='cedula']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (!is_empty( cedula )) {
            console.log('Valor del campo cedula',cedula)
            let formData = new FormData();
                formData.append("cedula",cedula)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user_profile/cedulaExiste",formData)
            console.log(`respuesta de la consulta 76 ${JSON.stringify(existeModel)}` )
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El Documento de Identidad ${cedula} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }

        }
        if (is_empty( email )) {
            let input = d.querySelector(`input[name='email']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (!is_empty( email )) {
            let formData = new FormData();
                formData.append("email",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user/emailExist",formData)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El correo ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        }
        if (is_empty( password )) {
            let input = d.querySelector(`input[name='password']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (is_empty( password_repeat )) {
            let input = d.querySelector(`input[name='password_repeat']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (password_repeat !== password) {
            let input = d.querySelector(`input[name='password']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: "Las Contraseñas Ingresadas no son iguales",
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (is_empty( nombres )) {
            let input = d.querySelector(`input[name='nombres']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (is_empty( apellidos )) {
            let input = d.querySelector(`input[name='apellidos']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (is_empty( fnacimiento )) {
            let input = d.querySelector(`input[name='fnacimiento']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        /******** */
        if (!is_empty( fnacimiento )) {
            let date = new Date(fnacimiento)
                if ( date.getFullYear() < 1900 ) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Atención',
                        text: `La fecha ingresada no es válida`,
                        didClose: () => {
                            setTimeout(() => {
                                e.target.value=""
                                e.target.focus()
                            } , 110);
                        }
                    })
                    return false
                }
            let edad = calcularEdad(date)
                if (edad < 0) {
                    edad = 0;
                }
                if ( edad < 18) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Atención',
                        text: `Solo las personas mayor de edad se pueden registrar.`,
                        didClose: () => {
                            setTimeout(() => {
                                document.getElementById('fnacimiento').value=""
                                document.getElementById('fnacimiento').focus()
                                useState['formCreatePaciente']['fnacimiento'] = ""
                            } , 110);
                        }
                    })
                    return false
                }
        }
        /******** */
        if (is_empty( telefono_movil )) {
            let input = d.querySelector(`input[name='telefono_movil']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (is_empty( cat_estado_id )) {
            let input = d.querySelector(`select[name='cat_estado_id']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => {
                            $(".box-cat_estado_id").addClass("border").addClass("border-danger")
                            input.focus()
                        } , 110);
                    }
                })
            return false
        }else{
            $(".box-cat_estado_id").removeClass("border").removeClass("border-danger")
        }
        if (is_empty( cat_municipio_id )) {
            let input = d.querySelector(`select[name='cat_municipio_id']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => {
                            $(".box-cat_municipio_id").addClass("border").addClass("border-danger")
                            input.focus()
                        } , 110);
                    }
                })
            return false
        }else{
            $(".box-cat_municipio_id").removeClass("border").removeClass("border-danger")
        }
        if (is_empty( description )) {
            let input = d.querySelector(`input[name='description']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (is_empty( domicilio )) {
            let input = d.querySelector(`input[name='domicilio']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        /* if (is_empty( tarjeta_soy_chacao )) {
            let input = d.querySelector(`input[name='tarjeta_soy_chacao']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        } */
        /* if (is_empty( domicilio )) {
            let input = d.querySelector(`input[name='domicilio']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        } */


        /* let formData = new FormData();
            formData.append("_token",entById('_token').value)
            formData.append("g-recaptcha-response",entById('g-recaptcha-response').value)
        let catcha = await post("/recaptcha",formData)
        let input = d.querySelector(`#g-recaptcha`)
            if ( !catcha ) {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Atención',
                        text: "No ha pulsado en la casilla de verificación recaptcha",
                        didClose: () => {
                            setTimeout(() => input.classList.add("border","border-danger") , 110);
                        }
                    })
                return false
            }else{
                input.classList.remove("border","border-danger")
            } */
    return true
}
let formFields_validate_reg_interno=  async ($App)=>{
    let $tab = "#App"
    let input = d.querySelector(`${$tab} input[name='cedula']`)
        if (is_empty( input.value )) {

            Toast.fire({
                icon: 'warning',
                title: 'Atención',
                text: input.title,
                didClose: () => {
                    setTimeout(() => input.focus() , 110);
                }
            })
            return false
        }
        /* input = d.querySelector(`${$tab} input[name='email']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        } */
        input = d.querySelector(`${$tab} input[name='nombres']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} input[name='apellidos']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} input[name='fnacimiento']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} input[name='telefono_movil']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} select[name='cat_estado_id']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => {
                            $(".box-cat_estado_id").addClass("border").addClass("border-danger")
                            input.focus()
                        } , 110);
                    }
                })
            return false
        }else{
            $(".box-cat_estado_id").removeClass("border").removeClass("border-danger")
        }
        input = d.querySelector(`${$tab} select[name='cat_municipio_id']`)
        if (is_empty( input.value )) {
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => {
                            $(".box-cat_municipio_id").addClass("border").addClass("border-danger")
                            input.focus()
                        } , 110);
                    }
                })
            return false
        }else{
            $(".box-cat_municipio_id").removeClass("border").removeClass("border-danger")
        }
        input = d.querySelector(`${$tab} input[name='description']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} input[name='domicilio']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }

    return true
}
let get_municipioBy = (cat_estado_id)=>{
    return useState['cat_municipio'].filter(municipio => equalsInt( municipio.cat_estado_id , cat_estado_id ) )
}
let create_fields_validation = async ($tab)=>{

    let input = d.querySelector(`${$tab} input[name='cedula']`)
        if (is_empty( input.value )) {

            Toast.fire({
                icon: 'warning',
                title: 'Atención',
                text: input.title,
                didClose: () => {
                    setTimeout(() => input.focus() , 110);
                }
            })
            return false
        }
        input = d.querySelector(`${$tab} input[name='email']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} input[name='nombres']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} input[name='apellidos']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} input[name='fnacimiento']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} input[name='telefono_movil']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} select[name='cat_estado_id']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => {
                            $(".box-cat_estado_id").addClass("border").addClass("border-danger")
                            input.focus()
                        } , 110);
                    }
                })
            return false
        }else{
            $(".box-cat_estado_id").removeClass("border").removeClass("border-danger")
        }
        input = d.querySelector(`${$tab} select[name='cat_municipio_id']`)
        if (is_empty( input.value )) {
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => {
                            $(".box-cat_municipio_id").addClass("border").addClass("border-danger")
                            input.focus()
                        } , 110);
                    }
                })
            return false
        }else{
            $(".box-cat_municipio_id").removeClass("border").removeClass("border-danger")
        }
        input = d.querySelector(`${$tab} input[name='description']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} input[name='domicilio']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }

    return true
}
let saveDataForm = (e)=>{
        if (e.target?.matches("input") || e.target?.matches("textarea") || e.target?.matches("select") ) {
            if (useState['formCreatePaciente'].hasOwnProperty(e.target.name)) {
                //console.log(e.target.name)
                useState['formCreatePaciente'][e.target.name] = e.target.value

                if ("telefono_movil" === e.target.name) {
                    useState['formCreatePaciente'][e.target.name] = iti.getNumber(intlTelInputUtils.numberFormat.E164);
                }
            }
        }

        if (e.target?.matches(".select2") ) {
            if (useState['formCreatePaciente'].hasOwnProperty(e.target.name)) {
                useState['formCreatePaciente'][e.target.name] = e.target.options[e.target.selectedIndex].value
            }

        }
        if (["cita_dia","cita_hora"].includes(e.name)) {
            useState['formCreatePaciente'][e.name] = e.value
        }
        //console.log(useState['formCreatePaciente'])

    }
let mensajeBienvenida = ()=>{
        modalMensaje({
            title:`
            <div class="text-center">
                <i style="font-size: 0.8em;">Bienvenido al</i><br>
                Registro de Citas<br>
                CMDLT
            </div>
            `,
            content:`
            <div class="h5 text-center">
                Le damos la más cordial bienvenida
                a nuestra plataforma de consulta externa.<br>

                Para que puedas agendar una cita médica
                en nuestra institución, por favor,
                registre sus datos en el siguiente formulario.

                <br><br>
                Muchas gracias por su tiempo y colaboración.
            </div>

            `,
            action:`
                <button id="empezarcuestionario" data-dismiss="modal" type="button" class="btn btn-light btn-block btn-lg text-primary">De acuerdo, continuar</button>
            `,
        })
    }

let mensajeRegistro = () =>
    {
        PageLogin()
        modalMensaje({
            title:`
            <div class="text-center">
                <i style="font-size: 0.8em;">Registro completado</i>
            </div>
            `,
            content:`
            <div class="h5">
                <div class="text-center">
                    Gracias por su tiempo.<br>
                    Para Agendar una cita médica,<br>
                    Ingrese al sistema a traves de nuestra<br>
                    pantalla de inicio.

                </div>
                <br>
            </div>

            `,
            action:`
                <button   data-dismiss="modal" type="button" class="btn btn-light btn-block btn-lg text-primary">Entendido</button>
            `,
        })

    }
export async function get_id(){
        return await get("/user/get_id");
    }
export async function emergencia_pacienteSearch(){
    $("#modelId").modal("show")
        $App = d.querySelector("#modelId .modal-body")
        $App.innerHTML=""
    let $form = entById("artefacto_0003").content
        $form = d.importNode($form,true)

        $App.append( $form )


        $App.querySelector("button").addEventListener("click", async function(e){
            e.preventDefault()
                let input = $App.querySelector("input").value
                if (is_empty(input)) {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Atención',
                        text: `Escriba una cédula válida para hacer la busqueda.`,
                        didClose: () => {
                            setTimeout(() => {
                                $App.querySelector("input").value=""
                                $App.querySelector("input").focus()
                            } , 110);
                        }
                    })
                    return false
                }
                console.log(input)
                let formData = new FormData();
                    formData.append("cedula",input)
                    formData.append("_token",d.querySelector("#_token").value)
                let existeModel = await post("/consultaexterna/user_profile/cedulaExiste",formData)
                console.log(`respuesta 768 ${JSON.stringify(existeModel)}`)
                    if ( existeModel ) {
                        let model = await UserProfile.getCedula(input)
                            UserCuestUbicacion.reingreso('.modal-body',model.user_id)
                        return false
                    }else{

                        Toast.fire({
                            icon: 'info',
                            title: 'Ooops!',
                            text: `El paciente buscado no ha sido encontrado`,
                            didClose: () => {
                                setTimeout(() => {
                                    $App.querySelector("input").value=""
                                    $App.querySelector("input").focus()
                                } , 110);
                            }
                        })


                    }

        })


    }
let selectOptions = (model, param, fields=['id','description'] ) => {
        let id = param != undefined ? param : "";
        let selected = '';
        //<option value=''>Seleccione</option>
        let data = "";
        model.forEach( option => {
            if ( equalsInt( option[ fields[0] ] , id ) ) {
                //console.log(valueOfElement.id+"=="+id)
                selected = 'selected';
            } else {
                selected = '';
            }
            data += `
                <option ${selected} value="${option[ fields[0] ]}">
                    ${option[ fields[1] ]}
                </option>
            `;
        });

        return data;
    }
export async function configPage(){
    $App.innerHTML=""
    let $form = entById("artefacto_0002").content
        $form = d.importNode($form,true)

        $App.append( $form )

        mensajeBienvenida()
        useState.cat_estado       = await CatUserEstado_index()
        useState.cat_municipio    = await CatUserMunicipio_index()

        telefonoConfig("#telefono_movil")

        entById("cat_estado_id").innerHTML= selectOptions(useState.cat_estado, 14)
        entById("cat_municipio_id").innerHTML= selectOptions( useState.cat_municipio.filter( x=>equalsInt( x.cat_estado_id,14 ) ), 180 )
        entById("description").value="Caracas"

        d.querySelector("form").addEventListener("change",e=>{
            saveDataForm(e)
        })
        /* entById("tipo_registro").addEventListener("change",e=>{
            entById("cat_user_family_id").value =""
            if (e.target.value =="Familiar") {
                entById("registro_familiar").classList.remove("d-none")
                entById("cedula_familiar_text").classList.remove("d-none")

            }else{
                entById("registro_familiar").classList.add("d-none")
                entById("cedula_familiar_text").classList.add("d-none")
                entById("cedula_familiar_info").classList.add("d-none")

            }
        })
        entById("cat_user_family_id").addEventListener("change",e=>{
            if (e.target.value == 5) {
                entById("cedula_familiar_info").classList.remove("d-none")
                entById("numero_hijo_td").classList.remove("d-none")
            }else{
                entById("cedula_familiar_info").classList.add("d-none")
                entById("numero_hijo_td").classList.add("d-none")
            }
        }) */
        entById("userImage").addEventListener("change",e=>{
            imagePreview(e,"userImagePreview")
        })

        entById("imgDocIdentidad").addEventListener("change",e=>{
            imagePreview(e,"imgDocIdentidadPreview")
        })
        entById("imgSoyChacao").addEventListener("change",e=>{
            imagePreview(e,"imgSoyChacaoPreview")
        })
        // entById("partidaNacimiento").addEventListener("change",e=>{
        //     //console.log(URL.createObjectURL(e.target.files[0]))
        //     d.querySelector(`#pn_preview iframe`).src=URL.createObjectURL(e.target.files[0])
        //     imagePreview(e,"partidaNacimientoPreview")
        // })
        //validar si existe la cedula
        entById("cedula").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("cedula",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user_profile/cedulaExiste",formData)
            console.log(`artefacto_0002 --> ${existeModel}`)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El Documento de Identidad ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })
        //validar si existe el correo
        entById("email").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("email",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user/emailExist",formData)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El correo ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })

        d.querySelector("#submit").addEventListener("click", async function(e){
            e.preventDefault()

            if (await formFields_validate(e)) {
                d.querySelector(".overlay").classList.remove("d-none")
                let formData = new FormData();

                    for (const key in useState['formCreatePaciente']) {
                        if (Object.hasOwnProperty.call(useState['formCreatePaciente'], key)) {
                            let element = useState['formCreatePaciente'][key];
                                formData.append(key,element)
                        }
                    }
                let file1 = document.getElementById(`userImage`).files[0];
                let file2 = document.getElementById(`imgDocIdentidad`).files[0];
                let file3 = document.getElementById(`imgSoyChacao`).files[0];
                // let file4 = document.getElementById(`partidaNacimiento`).files[0];
                    formData.append("imagen", file1)
                    formData.append("imgDocIdentidad", file2)
                    formData.append("imgSoyChacao", file3)
                    // formData.append("partidaNacimiento", file4)
                    formData.append("created_at",timestamps() );
                    formData.append("_token",d.querySelector("#_token").value)
                let $response = post("/consultaexterna/user/paciente/storeExterno",formData)
                    $response.then(response=>{
                        if($response){
                            d.querySelector(".overlay").classList.add("d-none")
                            localStorage.setItem('email',useState['formCreatePaciente']['email'])
                            localStorage.setItem('password',useState['formCreatePaciente']['password'])
                            mensajeRegistro()
                        }
                    })
            }

        })
        $('#cat_estado_id').on('select2:select', function (e) {
            //console.log("-->",e.params.data.id)
            saveDataForm(e)
            let model = get_municipioBy( e.params.data.id )
            entById("cat_municipio_id").innerHTML=null
            entById("cat_municipio_id").append($select(model))
            //handleItemColor(".item-2",e)
            /*
            final_medico = e.params.data.text
            //console.log(final_medico)
            //let mesesDisponibles = useState.get_MedicoAgenda(e.params.data.id).get_meses()
            //let diasDisponible = useState.get_MedicoAgenda(e.params.data.id).get_agenda_dias()
                entById("cita_dia").value =``
                entById("mensaje_dia_seleccionado").innerHTML =`Solo los días resaltados están disponibles.`
                activarCalendario( e.params.data.id ) */
        });
        $('#cat_municipio_id').on('select2:select', function (e) {
            saveDataForm(e)
        });
        $('.select2').select2()


        $App.querySelector("#login").addEventListener( "click",function(e){
            PageLogin()
        } )
    }

export async function createInternoEmergencia(){

        $App.innerHTML=""
        let $form = entById("artefacto_0010").content
            $form = d.importNode($form,true)

            $App.append( $form )


            useState.cat_estado       = await CatUserEstado.getAll()
            useState.cat_municipio    = await CatUserMunicipio.getAll()
            useState['formCreatePaciente']['cat_user_ubicacion_id'] = 246
            useState['formCreatePaciente']['password'] = "123456"
            useState['formCreatePaciente']['cat_user_ubicacion_id'] = "245"
            useState['formCreatePaciente']['centro_salud_id'] = useState['user_centro_salud_id']


            telefonoConfig("#telefono_movil")

            entById("cat_estado_id").innerHTML= selectOptions(useState.cat_estado, 14)
            entById("cat_municipio_id").innerHTML= selectOptions( useState.cat_municipio.filter( x=>equalsInt( x.cat_estado_id,14 ) ), 180 )
            entById("description").value="Caracas"


            entById("cat_estado_id").append($select(useState.cat_estado))

            d.addEventListener("change",e=>{
                saveDataForm(e)
            })
            entById("userImage").addEventListener("change",e=>{
                imagePreview(e,"userImagePreview")
            })
            entById("imgDocIdentidad").addEventListener("change",e=>{
                imagePreview(e,"imgDocIdentidadPreview")
            })
            entById("imgSoyChacao").addEventListener("change",e=>{
                imagePreview(e,"imgSoyChacaoPreview")
            })
            /* entById("cedula").addEventListener("change", async e=>{
                let formData = new FormData();
                    formData.append("cedula",e.target.value)
                    formData.append("_token",d.querySelector("#_token").value)
                let existeModel = await post("/user_profile/cedulaExiste",formData)
                    if ( existeModel ) {
                        e.target.classList.remove("border-success")
                        e.target.classList.add("border-danger")

                        let cedula = e.target.value
                        let message = Component.alertMessage("cedula_asignada");

                            Toast.fire({
                                icon: 'warning',
                                title: 'Atención',
                                text: `El Documento de Identidad ${cedula} ya está registrado en el sistema. ¿Desea reingresar al paciente?.`,
                                showDenyButton: true,
                                showCancelButton: false,
                                confirmButtonText: `Si`,

                            }).then((result) => {
                                if (result.isConfirmed) {
                                    User.reingresoByCedula(cedula)
                                } else if (result.isDenied) {
                                    e.target.value=""
                                    e.target.focus()
                                }
                                e.target.value=""
                                e.target.focus()
                            })

                                    //registro interno

                        return false
                    }else{
                        e.target.classList.remove("border-danger")
                        e.target.classList.add("border-success")
                    }
            }) */
            /* entById("email").addEventListener("change", async e=>{
                let formData = new FormData();
                    formData.append("email",e.target.value)
                    formData.append("_token",d.querySelector("#_token").value)
                let existeModel = await post("/user/emailExist",formData)
                    if ( existeModel ) {
                        e.target.classList.remove("border-success")
                        e.target.classList.add("border-danger")
                            Toast.fire({
                                icon: 'warning',
                                title: 'Atención',
                                text: `El correo ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                                didClose: () => {
                                    setTimeout(() => {
                                        e.target.value=""
                                        e.target.focus()
                                    } , 110);
                                }
                            })
                        return false
                    }else{
                        e.target.classList.remove("border-danger")
                        e.target.classList.add("border-success")
                    }
            }) */

            $App.querySelector("#submit").addEventListener("click", async function(e){
                e.preventDefault()
                if (await formFields_validate_reg_interno()) {
                    let formData = new FormData();
                        for (const key in useState['formCreatePaciente']) {
                            if (Object.hasOwnProperty.call(useState['formCreatePaciente'], key)) {
                                let element = useState['formCreatePaciente'][key];
                                    formData.append(key,element)
                            }
                        }
                    let file1 = document.getElementById(`userImage`).files[0];
                    let file2 = document.getElementById(`imgDocIdentidad`).files[0];
                    let file3 = document.getElementById(`imgSoyChacao`).files[0];
                        formData.append("imagen", file1)
                        formData.append("imgDocIdentidad", file2)
                        formData.append("imgSoyChacao", file3)
                        formData.append("created_at",timestamps() );
                        formData.append("_token",d.querySelector("#_token").value)
                    let $response = post("/consultaexterna/paciente/emergenciaStore/store",formData)
                        $response.then(response=>{
                            if($response){
                                message = Component.alertMessage("send_success");
                                Toast.fire({
                                    icon: message['image'],
                                    title: message['title'],
                                    text: message['message'],
                                    didClose: () => {
                                        setTimeout(() => { window.location = "/medico";}, 110);
                                    }
                                })
                            }
                        })
                }

            })
            $('#cat_estado_id').on('select2:select', function (e) {
                //console.log("-->",e.params.data.id)
                saveDataForm(e)
                let model = get_municipioBy( e.params.data.id )
                entById("cat_municipio_id").innerHTML=null
                entById("cat_municipio_id").append($select(model))

            });
            $('#cat_municipio_id').on('select2:select', function (e) {
                saveDataForm(e)
            });
            $('.select2').select2()


            $App.querySelector("#regresar").addEventListener( "click",function(e){
                location.href="/medico"
            } )
    }
    /*
        export async function edit($App,paciente){
    console.log("user_id_paciente")
    if ($('select').data('select2')) {
        $('select').select2('destroy');
      }
    console.log(paciente)
    $App.innerHTML=""
    let $form = entById("artefacto_0029").content
        $form = d.importNode($form,true)
       let $tab = "#tab_paciente_create"
        $App.append( $form )
        $App.querySelector("h3").textContent="Editar Paciente"
        d.querySelector(".cat-cita-status-title").textContent="Editar Paciente"
        //mensajeBienvenida()
        useState.cat_estado       = await CatUserEstado_index()
        useState.cat_municipio    = await CatUserMunicipio_index()
        useState['formData']['email']=paciente.email
        useState['formData']['user_id']=paciente.user_id
        useState['formData']['nacionalidad']=paciente.nacionalidad
        useState['formData']['cedula']=paciente.cedula.replace(/\./g, '')
        useState['formData']['nombres']=paciente.nombres
        useState['formData']['apellidos']=paciente.apellidos
        useState['formData']['genero']=paciente.genero
        useState['formData']['fnacimiento']=paciente.fnacimiento
        useState['formData']['telefono_movil']=paciente.telefono_movil
        useState['formData']['cat_estado_id']=paciente.cat_estado_id
        useState['formData']['cat_municipio_id']=paciente.cat_municipio_id
        useState['formData']['description']=paciente.description
        useState['formData']['domicilio']=paciente.domicilio

        telefonoConfig("#telefono_movil")

        //$App.querySelector(`#userImagePreview`).src= paciente.imagen
        $App.querySelector(`input[name='cedula']`).value= paciente.cedula.replace(/\./g, '')
        $App.querySelector(`input[name='email']`).value= paciente.email
        $App.querySelector(`input[name='nombres']`).value= paciente.nombres
        $App.querySelector(`input[name='apellidos']`).value= paciente.apellidos
        $App.querySelector(`select[name='genero']`).value= paciente.genero
        $App.querySelector(`input[name='fnacimiento']`).value= fechaInputDate( paciente.fnacimiento )
        $App.querySelector(`input[name='telefono_movil']`).value=  paciente.telefono_movil
        $App.querySelector(`input[name='description']`).value= paciente.description
        $App.querySelector(`input[name='domicilio']`).value= paciente.domicilio





        entById("cat_estado_id").innerHTML= selectOptions(useState.cat_estado, paciente.cat_estado_id)
        entById("cat_municipio_id").innerHTML= selectOptions( useState.cat_municipio.filter( x=>equalsInt( x.cat_estado_id,paciente.cat_estado_id ) ), paciente.cat_municipio_id )
        //entById("description").value="Caracas"

        d.querySelector("form").addEventListener("change",e=>{
            saveDataForm(e)
        })
        entById("userImage").addEventListener("change",e=>{
            imagePreview(e,"userImagePreview")
        })
        entById("imgDocIdentidad").addEventListener("change",e=>{
            imagePreview(e,"imgDocIdentidadPreview")
        })
        entById("imgSoyChacao").addEventListener("change",e=>{
            imagePreview(e,"imgSoyChacaoPreview")
        })
        //validar si existe la cedula
        entById("cedula").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("cedula",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/user_profile/cedulaExiste",formData)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El Documento de Identidad ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })
        //validar si existe el correo
        entById("email").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("email",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/user/emailExist",formData)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El correo ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })

        d.querySelector("#submit").addEventListener("click", async function(e){
            e.preventDefault()
            if (await create_fields_validation("#tab_paciente_create")) {
                //d.querySelector("#tab_paciente_create_cita .overlay").classList.remove("d-none")
                d.querySelector(`#form_nuevo_paciente .overlay`).classList.remove("d-none")
                let formData = new FormData();

                    for (const key in useState) {
                        if (Object.hasOwnProperty.call(useState, key)) {
                            let element = useState[key];
                                formData.append(key,element)
                        }
                    }
                let file1 = document.getElementById(`userImage`).files[0];
                let file2 = document.getElementById(`imgDocIdentidad`).files[0];
                let file3 = document.getElementById(`imgSoyChacao`).files[0];
                    formData.append("imagen", file1)
                    formData.append("imgDocIdentidad", file2)
                    formData.append("imgSoyChacao", file3)
                    formData.append("created_at",timestamps() );
                    formData.append("_token",d.querySelector("#_token").value)
                let $response = post("/paciente/consultaExternaStore/update",formData)
                    $response.then(response=>{
                        if($response){
                            let cedula = d.querySelector("#tab_paciente_create input[name='cedula']").value
                                get(`/user/profile/show_by_cedula/${cedula}`)
                                .then(response=>{
                                    console.log(response)
                                    localStorage.setItem('update_user', JSON.stringify( first(response) ) );
                                    //localStorage.setItem('paciente_cedula', first(response)['cedula'] );
                                    //localStorage.setItem('paciente_user_id', first(response)['user_id'] );
                                    updateCitas()

                                    Toast.fire({
                                        icon: 'success',
                                        title: '¡Registro Actualizado!',
                                        text: 'Los datos se han actualizado correctamente.',
                                        //footer: '<a class="btn btn-success btn-block paciente_create_cita" href="#"><i class="pc-cita_por_confirmar paciente_create_cita"></i> Nueva Cita</a>',
                                        didClose: () => {
                                            //limpiar formulario

                                            d.querySelector(`#form_nuevo_paciente .overlay`).classList.add("d-none")


                                        }
                                    }).then(result=>{
                                        if (result.isConfirmed) {
                                            /* enrutador("#tab_citas")
                                            useState.status_current_tab = 6
                                                cat_user_cita_status_id = 6
                                                handle_tablaCitas(cat_user_cita_status_id, "Consulta")
                                                await updateTotales()
                                            d.querySelector("#tab_paciente_create_cita .overlay").classList.add("d-none")

                                        }
                                    })
                                })

                        }
                    })
            }

        })
        $('#cat_estado_id').on('select2:select', function (e) {
            //console.log("-->",e.params.data.id)
            saveDataForm(e)
            let model = useState.get_municipioBy( e.params.data.id )
            entById("cat_municipio_id").innerHTML=null
            entById("cat_municipio_id").append($select(model))
            //handleItemColor(".item-2",e)
            /*
            final_medico = e.params.data.text
            //console.log(final_medico)
            //let mesesDisponibles = useState.get_MedicoAgenda(e.params.data.id).get_meses()
            //let diasDisponible = useState.get_MedicoAgenda(e.params.data.id).get_agenda_dias()
                entById("cita_dia").value =``
                entById("mensaje_dia_seleccionado").innerHTML =`Solo los días resaltados están disponibles.`
                activarCalendario( e.params.data.id )
        });
        $('#cat_municipio_id').on('select2:select', function (e) {
            saveDataForm(e)
        });
        $('.select2').select2()


    }*/
export async function create($App){
    $App.innerHTML=""
    let $form = entById("artefacto_0029").content
        $form = d.importNode($form,true)

        $App.append( $form )
        $App.querySelector("h3").textContent="Nuevo Paciente"
        d.querySelector(".cat-cita-status-title").textContent="Nuevo Paciente"
        //mensajeBienvenida()
        useState.cat_estado       = await CatUserEstado_index()
        useState.cat_municipio    = await CatUserMunicipio_index()
        useState['formCreatePaciente']['formData']['password']="123456"
        useState['formCreatePaciente']['formData']['password_repeat']="123456"
        telefonoConfig("#telefono_movil")

        entById("cat_estado_id").innerHTML= selectOptions(useState.cat_estado, 14)
        entById("cat_municipio_id").innerHTML= selectOptions( useState.cat_municipio.filter( x=>equalsInt( x.cat_estado_id,14 ) ), 180 )
        entById("description").value="Caracas"

        d.querySelector("form").addEventListener("change",e=>{
            saveDataForm(e)
        })
        entById("userImage").addEventListener("change",e=>{
            imagePreview(e,"userImagePreview")
        })
        entById("imgDocIdentidad").addEventListener("change",e=>{
            imagePreview(e,"imgDocIdentidadPreview")
        })
        entById("imgSoyChacao").addEventListener("change",e=>{
            imagePreview(e,"imgSoyChacaoPreview")
        })
        //validar si existe la cedula
        entById("cedula").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("cedula",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user_profile/cedulaExiste",formData)
            console.log(`respuesta 1383 ${JSON.stringify(existeModel)}`)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El Documento de Identidad ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })
        //validar si existe el correo
        entById("email").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("email",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user/emailExist",formData)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El correo ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })

        d.querySelector("#submit").addEventListener("click", async function(e){
            e.preventDefault()
            if (await create_fields_validation("#tab_paciente_create")) {
                //d.querySelector("#tab_paciente_create_cita .overlay").classList.remove("d-none")
                d.querySelector(`#form_nuevo_paciente .overlay`).classList.remove("d-none")
                let formData = new FormData();

                    for (const key in useState['formCreatePaciente']) {
                        if (Object.hasOwnProperty.call(useState['formCreatePaciente'], key)) {
                            let element = useState['formCreatePaciente'][key];
                                formData.append(key,element)
                        }
                    }
                let file1 = document.getElementById(`userImage`).files[0];
                let file2 = document.getElementById(`imgDocIdentidad`).files[0];
                let file3 = document.getElementById(`imgSoyChacao`).files[0];
                    formData.append("imagen", file1)
                    formData.append("imgDocIdentidad", file2)
                    formData.append("imgSoyChacao", file3)
                    formData.append("created_at",timestamps() );
                    formData.append("_token",d.querySelector("#_token").value)

                let $response = post("/consultaexterna/paciente/consultaExternaStore/store",formData)
                    $response.then(response=>{
                        if($response){
                            let cedula = d.querySelector("#tab_paciente_create input[name='cedula']").value
                                get(`/consultaexterna/user/profile/show_by_cedula/${cedula}`)
                                .then(response=>{
                                    console.log(response)
                                    console.log("antes->", useState['users'])

                                    add_row("users",response)

                                    console.log("despues->", useState['users'])
                                    //localStorage.setItem('new_user', JSON.stringify( first(response) ) );
                                    //localStorage.setItem('paciente_cedula', first(response)['cedula'] );
                                    //localStorage.setItem('paciente_user_id', first(response)['user_id'] );


                                    Toast.fire({
                                        icon: 'success',
                                        title: '¡Registro creado!',
                                        text: 'El paciente se ha creado correctamente.',
                                        footer: '<a class="btn btn-success btn-block paciente_create_cita" href="#"><i class="pc-cita_por_confirmar paciente_create_cita"></i> Nueva Cita</a>',
                                       /*  didClose: () => {
                                            //limpiar formulario

                                            d.querySelector(`#form_nuevo_paciente .overlay`).classList.add("d-none")


                                        } */
                                    }).then(result=>{
                                        if (result.isConfirmed) {
                                            ComponentBuscador.init()
                                            /* enrutador("#tab_citas")
                                            useState.status_current_tab = 6
                                                cat_user_cita_status_id = 6
                                                handle_tablaCitas(cat_user_cita_status_id, "Consulta")
                                                await updateTotales() */
                                            d.querySelector("#tab_paciente_create_cita .overlay").classList.add("d-none")

                                        }
                                    })
                                })

                        }
                    })
            }

        })
        $('#cat_estado_id').on('select2:select', function (e) {
            //console.log("-->",e.params.data.id)
            saveDataForm(e)
            let model = get_municipioBy( e.params.data.id )
            entById("cat_municipio_id").innerHTML=null
            entById("cat_municipio_id").append($select(model))
            //handleItemColor(".item-2",e)
            /*
            final_medico = e.params.data.text
            //console.log(final_medico)
            //let mesesDisponibles = useState.get_MedicoAgenda(e.params.data.id).get_meses()
            //let diasDisponible = useState.get_MedicoAgenda(e.params.data.id).get_agenda_dias()
                entById("cita_dia").value =``
                entById("mensaje_dia_seleccionado").innerHTML =`Solo los días resaltados están disponibles.`
                activarCalendario( e.params.data.id ) */
        });
        $('#cat_municipio_id').on('select2:select', function (e) {
            saveDataForm(e)
        });
        $('.select2').select2()


    }
export let user_edit = async (selector,user_id)=>{

    $App = d.querySelector( selector )
    $App.innerHTML=""
    let $form = entById("artefacto_0010").content
        console.log($form)
        $form = d.importNode($form,true)
        console.log($form.querySelectorAll('div'))
        $form.querySelectorAll('div')[2].classList.add("d-none")
        $form.querySelectorAll('div')[6].classList.add("d-none")
        $form.querySelectorAll('img')[0].classList.add("d-none")
        $form.querySelectorAll('div')[50].classList.add("d-none")
        $form.querySelectorAll('div')[52].classList.add("d-none")

    let $loading = entById("artefacto_0004").content
        $loading = d.importNode($loading,true)
        $loading.querySelectorAll("div")[5].classList.remove("text-white")
        $loading.querySelectorAll("div")[5].classList.add("text-primary")
        $App.append( $loading )

    let user = await User.show(user_id)
    let user_profile = await UserProfile.show(user_id)
    let user_direction = await UserCuestDireccion.show(user_id)
        useState.cat_estado       = await CatUserEstado.getAll()
        useState.cat_municipio    = await CatUserMunicipio.getAll()
    let user_profile_images = await getUserProfileImages(user_id)
    let user_tarjeta_soy_chacao = await getTarjetaSoyChacao(user_id)


        useState['formCreatePaciente']["email"] = user.email


        useState['formCreatePaciente']["nombres"] = user_profile.nombres
        useState['formCreatePaciente']["apellidos"] = user_profile.apellidos
        useState['formCreatePaciente']["cedula"] = user_profile.cedula
        useState['formCreatePaciente']["fnacimiento"] = user_profile.fnacimiento
        useState['formCreatePaciente']["genero"] = user_profile.genero
        useState['formCreatePaciente']["nacionalidad"] = user_profile.nacionalidad
        useState['formCreatePaciente']["telefono_movil"] = user_profile.telefono_movil
        useState['formCreatePaciente']["temp_imagen"] = user_profile.imagen
        useState['formCreatePaciente']["temp_tarjeta_soy_chacao"] = first( user_profile_images.filter( x=>x.coments==="imgSoyChacao") )?.value
        useState['formCreatePaciente']["temp_imgDocIdentidad"] = first( user_profile_images.filter( x=>x.coments==="imgDocIdentidad") )?.value
        useState['formCreatePaciente']["description"] = user_direction.description
        useState['formCreatePaciente']["domicilio"] = user_direction.domicilio
        useState['formCreatePaciente']["cat_estado_id"] = user_direction.cat_estado_id
        useState['formCreatePaciente']["cat_municipio_id"] = user_direction.cat_municipio_id
        useState['formCreatePaciente']["tarjeta_soy_chacao"] = user_tarjeta_soy_chacao?.description




        $form.querySelectorAll('img')[1].src= useState['formCreatePaciente']["temp_imagen"]
        $form.querySelectorAll('img')[2].src= useState['formCreatePaciente']["temp_tarjeta_soy_chacao"]
        $form.querySelectorAll('img')[3].src= useState['formCreatePaciente']["temp_imgDocIdentidad"]
        $form.querySelector("select[name='cat_estado_id']").append( $select(useState.cat_estado) )
        $form.querySelector("select[name='cat_estado_id']").options[ useState.cat_estado.map(x => x.id).findIndex( x => x === user_direction.cat_estado_id )+1  ].selected=true

        $form.querySelector("input[name='description']").value= useState['formCreatePaciente']["description"]
        $form.querySelector("input[name='domicilio']").value= useState['formCreatePaciente']["domicilio"]

        $form.querySelector("select[name='nacionalidad']").options[ ["V","E","P","J"].findIndex( x => x=== useState["nacionalidad"] )  ].selected=true
        $form.querySelector("input[name='cedula']").value= useState['formCreatePaciente']["cedula"]
        $form.querySelector("input[name='email']").value= useState['formCreatePaciente']["email"]
        $form.querySelector("input[name='nombres']").value= useState['formCreatePaciente']["nombres"]
        $form.querySelector("input[name='apellidos']").value= useState['formCreatePaciente']["apellidos"]
        $form.querySelector("select[name='genero']").options[ ["m","f"].findIndex( x => x=== useState['formCreatePaciente']["genero"] )  ].selected=true
        $form.querySelector("input[name='fnacimiento']").value= useState['formCreatePaciente']["fnacimiento"]
        $form.querySelector("input[name='telefono_movil']").value= useState['formCreatePaciente']["telefono_movil"]
        $form.querySelector("input[name='tarjeta_soy_chacao']").value= useState['formCreatePaciente']["tarjeta_soy_chacao"]



        $App.innerHTML=""
        $App.append( $form )

        $App.querySelectorAll('div')[8].textContent="Datos del Paciente"
        $App.querySelector('button#submit').textContent="Actualizar"



        telefonoConfig("#telefono_movil")
        entById("cat_estado_id").append($select(useState.cat_estado))

        $App.querySelector("form").addEventListener("change",e=>{
            saveDataForm(e)
        })
        entById("userImage").addEventListener("change",e=>{
            imagePreview(e,"userImagePreview")
        })

        entById("imgDocIdentidad").addEventListener("change",e=>{
            imagePreview(e,"imgDocIdentidadPreview")
        })
        entById("imgSoyChacao").addEventListener("change",e=>{
            imagePreview(e,"imgSoyChacaoPreview")
        })
        entById("cedula").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("cedula",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user_profile/cedulaExiste",formData)
            console.log(`respuesta 1625 ${JSON.stringify(existeModel)}`)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El Documento de Identidad ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })
        entById("email").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("email",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user/emailExist",formData)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El correo ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })

        $App.querySelector("#submit").addEventListener("click", async function(e){
            e.preventDefault()
            if (await formFields_validate_reg_interno()) {
                let formData = new FormData();
                    for (const key in useState['formCreatePaciente']) {
                        if (Object.hasOwnProperty.call(useState['formCreatePaciente'], key)) {
                            let element = useState['formCreatePaciente'][key];
                                formData.append(key,element)
                        }
                    }
                let file1 = document.getElementById(`userImage`).files[0];
                let file2 = document.getElementById(`imgDocIdentidad`).files[0];
                let file3 = document.getElementById(`imgSoyChacao`).files[0];
                    formData.append("user_id", user_id)
                    formData.append("imagen", file1)
                    formData.append("telefono_movil", iti.getNumber())
                    formData.append("imgDocIdentidad", file2)
                    formData.append("imgSoyChacao", file3)
                    formData.append("created_at",timestamps() );
                    formData.append("_token",d.querySelector("#_token").value)
                let $response = post("/consultaexterna/paciente/consultaExternaStore/update",formData)
                    $response.then(response=>{
                        if($response){
                            message = Component.alertMessage("send_success");
                            Toast.fire({
                                icon: message['image'],
                                title: message['title'],
                                text: message['message'],
                                didClose: () => {
                                   // setTimeout(() => { }, 110);
                                }
                            })
                        }
                    })
            }

        })

        $('#cat_estado_id').on('select2:select', function (e) {
            saveDataForm(e)
            let model = get_municipioBy( e.params.data.id )
                entById("cat_municipio_id").innerHTML=null
                entById("cat_municipio_id").append($select(model))
        });
        $('#cat_municipio_id').on('select2:select', function (e) {
            saveDataForm(e)
        });


    let model = get_municipioBy( user_direction.cat_estado_id )
        entById("cat_municipio_id").innerHTML=null
        entById("cat_municipio_id").append($select(model))
        d.querySelector("select[name='cat_municipio_id']").options[ model.map(x => x.id).findIndex( x => x === user_direction.cat_municipio_id )+1  ].selected=true

        $('.select2').select2()


       /*  $App.querySelector("#regresar").classList.remove("btn-default","text-primary")
        $App.querySelector("#regresar").classList.add("btn-primary")
        $App.querySelector("#regresar").textContent="Cerrar"
        $App.querySelector("#regresar").addEventListener( "click",function(e){
            $("#modelId").modal("hide")
        } )  */
}
export async function configPageEdit(user_id){
        $("#modelId").modal("show")
        $App = d.querySelector("#modelId .modal-body")
        $App.innerHTML=""
        let $form = entById("artefacto_0010").content
            $form = d.importNode($form,true)
            $form.querySelectorAll('img')[0].classList.add("d-none")
            $form.querySelectorAll('div')[50].classList.add("d-none")
            $form.querySelectorAll('div')[52].classList.add("d-none")

        let $loading = import {index as CatUserEstado_index} from '../catalogs/cat_estado.js'
import {index as CatUserMunicipio_index} from '../catalogs/cat_municipio.js'
import {step_1 as PageLogin} from './login.js'
//import {handle_paciente_create_cita, handle_tablaCitas,updateCitas} from '../medico/medico_home.js'
import {getAll as getUserProfileImages} from './user_profile_images.js'
import * as ComponentBuscador from '../medico/search.js'
import {show as getTarjetaSoyChacao} from './user_tarjeta_soy_chacao.js'
import { add_row } from '../../helpers/helpers.js'
let d = document
let $App = document.getElementById("App")
let formFields_validate= async (e)=>{
    let
        {
            cedula          ,
            email           ,
            password        ,
            password_repeat ,
            nombres         ,
            apellidos       ,
            genero          ,
            fnacimiento     ,
            telefono_movil  ,
            cat_estado_id   ,
            cat_municipio_id,
            description     ,
            domicilio       ,
            tarjeta_soy_chacao       ,
            cat_user_ubicacion_id       ,
            fecha_ingreso       ,
        } = useState['formCreatePaciente'];
        let input; // = d.querySelector(`select[name='tipo_registro']`)
            /* if (tipo_registro =="Familiar") {
                if (is_empty( cedula_personal )) {
                    input = d.querySelector(`input[name='cedula_personal']`)
                    console.log(input.title)
                    Toast.fire({
                        icon: 'warning',
                        title: 'Atención',
                        text: input.title,
                        didClose: () => {
                            setTimeout(() => input.focus() , 110);
                        }
                    })
                    return false
                }
                if (is_empty( cat_user_family_id )) {
                    input = d.querySelector(`select[name='cat_user_family_id']`)
                    Toast.fire({
                        icon: 'warning',
                        title: 'Atención',
                        text: input.title,
                        didClose: () => {
                            setTimeout(() => input.focus() , 110);
                        }
                    })
                    return false
                }
            } */
        if (is_empty( cedula )) {
                input = d.querySelector(`input[name='cedula']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (!is_empty( cedula )) {
            console.log('Valor del campo cedula',cedula)
            let formData = new FormData();
                formData.append("cedula",cedula)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user_profile/cedulaExiste",formData)
            console.log(`respuesta de la consulta 76 ${JSON.stringify(existeModel)}` )
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El Documento de Identidad ${cedula} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }

        }
        if (is_empty( email )) {
            let input = d.querySelector(`input[name='email']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (!is_empty( email )) {
            let formData = new FormData();
                formData.append("email",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user/emailExist",formData)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El correo ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        }
        if (is_empty( password )) {
            let input = d.querySelector(`input[name='password']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (is_empty( password_repeat )) {
            let input = d.querySelector(`input[name='password_repeat']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (password_repeat !== password) {
            let input = d.querySelector(`input[name='password']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: "Las Contraseñas Ingresadas no son iguales",
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (is_empty( nombres )) {
            let input = d.querySelector(`input[name='nombres']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (is_empty( apellidos )) {
            let input = d.querySelector(`input[name='apellidos']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (is_empty( fnacimiento )) {
            let input = d.querySelector(`input[name='fnacimiento']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        /******** */
        if (!is_empty( fnacimiento )) {
            let date = new Date(fnacimiento)
                if ( date.getFullYear() < 1900 ) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Atención',
                        text: `La fecha ingresada no es válida`,
                        didClose: () => {
                            setTimeout(() => {
                                e.target.value=""
                                e.target.focus()
                            } , 110);
                        }
                    })
                    return false
                }
            let edad = calcularEdad(date)
                if (edad < 0) {
                    edad = 0;
                }
                if ( edad < 18) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Atención',
                        text: `Solo las personas mayor de edad se pueden registrar.`,
                        didClose: () => {
                            setTimeout(() => {
                                document.getElementById('fnacimiento').value=""
                                document.getElementById('fnacimiento').focus()
                                useState['formCreatePaciente']['fnacimiento'] = ""
                            } , 110);
                        }
                    })
                    return false
                }
        }
        /******** */
        if (is_empty( telefono_movil )) {
            let input = d.querySelector(`input[name='telefono_movil']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (is_empty( cat_estado_id )) {
            let input = d.querySelector(`select[name='cat_estado_id']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => {
                            $(".box-cat_estado_id").addClass("border").addClass("border-danger")
                            input.focus()
                        } , 110);
                    }
                })
            return false
        }else{
            $(".box-cat_estado_id").removeClass("border").removeClass("border-danger")
        }
        if (is_empty( cat_municipio_id )) {
            let input = d.querySelector(`select[name='cat_municipio_id']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => {
                            $(".box-cat_municipio_id").addClass("border").addClass("border-danger")
                            input.focus()
                        } , 110);
                    }
                })
            return false
        }else{
            $(".box-cat_municipio_id").removeClass("border").removeClass("border-danger")
        }
        if (is_empty( description )) {
            let input = d.querySelector(`input[name='description']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        if (is_empty( domicilio )) {
            let input = d.querySelector(`input[name='domicilio']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        /* if (is_empty( tarjeta_soy_chacao )) {
            let input = d.querySelector(`input[name='tarjeta_soy_chacao']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        } */
        /* if (is_empty( domicilio )) {
            let input = d.querySelector(`input[name='domicilio']`)
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        } */


        /* let formData = new FormData();
            formData.append("_token",document.getElementById('_token').value)
            formData.append("g-recaptcha-response",document.getElementById('g-recaptcha-response').value)
        let catcha = await post("/recaptcha",formData)
        let input = d.querySelector(`#g-recaptcha`)
            if ( !catcha ) {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Atención',
                        text: "No ha pulsado en la casilla de verificación recaptcha",
                        didClose: () => {
                            setTimeout(() => input.classList.add("border","border-danger") , 110);
                        }
                    })
                return false
            }else{
                input.classList.remove("border","border-danger")
            } */
    return true
}
let formFields_validate_reg_interno=  async ($App)=>{
    let $tab = "#App"
    let input = d.querySelector(`${$tab} input[name='cedula']`)
        if (is_empty( input.value )) {

            Toast.fire({
                icon: 'warning',
                title: 'Atención',
                text: input.title,
                didClose: () => {
                    setTimeout(() => input.focus() , 110);
                }
            })
            return false
        }
        /* input = d.querySelector(`${$tab} input[name='email']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        } */
        input = d.querySelector(`${$tab} input[name='nombres']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} input[name='apellidos']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} input[name='fnacimiento']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} input[name='telefono_movil']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} select[name='cat_estado_id']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => {
                            $(".box-cat_estado_id").addClass("border").addClass("border-danger")
                            input.focus()
                        } , 110);
                    }
                })
            return false
        }else{
            $(".box-cat_estado_id").removeClass("border").removeClass("border-danger")
        }
        input = d.querySelector(`${$tab} select[name='cat_municipio_id']`)
        if (is_empty( input.value )) {
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => {
                            $(".box-cat_municipio_id").addClass("border").addClass("border-danger")
                            input.focus()
                        } , 110);
                    }
                })
            return false
        }else{
            $(".box-cat_municipio_id").removeClass("border").removeClass("border-danger")
        }
        input = d.querySelector(`${$tab} input[name='description']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} input[name='domicilio']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }

    return true
}
let get_municipioBy = (cat_estado_id)=>{
    return useState['cat_municipio'].filter(municipio => equalsInt( municipio.cat_estado_id , cat_estado_id ) )
}
let create_fields_validation = async ($tab)=>{

    let input = d.querySelector(`${$tab} input[name='cedula']`)
        if (is_empty( input.value )) {

            Toast.fire({
                icon: 'warning',
                title: 'Atención',
                text: input.title,
                didClose: () => {
                    setTimeout(() => input.focus() , 110);
                }
            })
            return false
        }
        input = d.querySelector(`${$tab} input[name='email']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} input[name='nombres']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} input[name='apellidos']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} input[name='fnacimiento']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} input[name='telefono_movil']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} select[name='cat_estado_id']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => {
                            $(".box-cat_estado_id").addClass("border").addClass("border-danger")
                            input.focus()
                        } , 110);
                    }
                })
            return false
        }else{
            $(".box-cat_estado_id").removeClass("border").removeClass("border-danger")
        }
        input = d.querySelector(`${$tab} select[name='cat_municipio_id']`)
        if (is_empty( input.value )) {
                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => {
                            $(".box-cat_municipio_id").addClass("border").addClass("border-danger")
                            input.focus()
                        } , 110);
                    }
                })
            return false
        }else{
            $(".box-cat_municipio_id").removeClass("border").removeClass("border-danger")
        }
        input = d.querySelector(`${$tab} input[name='description']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }
        input = d.querySelector(`${$tab} input[name='domicilio']`)
        if (is_empty( input.value )) {

                Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: input.title,
                    didClose: () => {
                        setTimeout(() => input.focus() , 110);
                    }
                })
            return false
        }

    return true
}
let saveDataForm = (e)=>{
        if (e.target?.matches("input") || e.target?.matches("textarea") || e.target?.matches("select") ) {
            if (useState['formCreatePaciente'].hasOwnProperty(e.target.name)) {
                //console.log(e.target.name)
                useState['formCreatePaciente'][e.target.name] = e.target.value

                if ("telefono_movil" === e.target.name) {
                    useState['formCreatePaciente'][e.target.name] = iti.getNumber(intlTelInputUtils.numberFormat.E164);
                }
            }
        }

        if (e.target?.matches(".select2") ) {
            if (useState['formCreatePaciente'].hasOwnProperty(e.target.name)) {
                useState['formCreatePaciente'][e.target.name] = e.target.options[e.target.selectedIndex].value
            }

        }
        if (["cita_dia","cita_hora"].includes(e.name)) {
            useState['formCreatePaciente'][e.name] = e.value
        }
        //console.log(useState['formCreatePaciente'])

    }
let mensajeBienvenida = ()=>{
        modalMensaje({
            title:`
            <div class="text-center">
                <i style="font-size: 0.8em;">Bienvenido al</i><br>
                Registro de Citas<br>
                CMDLT
            </div>
            `,
            content:`
            <div class="h5 text-center">
                Le damos la más cordial bienvenida
                a nuestra plataforma de consulta externa.<br>

                Para que puedas agendar una cita médica
                en nuestra institución, por favor,
                registre sus datos en el siguiente formulario.

                <br><br>
                Muchas gracias por su tiempo y colaboración.
            </div>

            `,
            action:`
                <button id="empezarcuestionario" data-dismiss="modal" type="button" class="btn btn-light btn-block btn-lg text-primary">De acuerdo, continuar</button>
            `,
        })
    }

let mensajeRegistro = () =>
    {
        PageLogin()
        modalMensaje({
            title:`
            <div class="text-center">
                <i style="font-size: 0.8em;">Registro completado</i>
            </div>
            `,
            content:`
            <div class="h5">
                <div class="text-center">
                    Gracias por su tiempo.<br>
                    Para Agendar una cita médica,<br>
                    Ingrese al sistema a traves de nuestra<br>
                    pantalla de inicio.

                </div>
                <br>
            </div>

            `,
            action:`
                <button   data-dismiss="modal" type="button" class="btn btn-light btn-block btn-lg text-primary">Entendido</button>
            `,
        })

    }
export async function get_id(){
        return await get("/user/get_id");
    }
export async function emergencia_pacienteSearch(){
    $("#modelId").modal("show")
        $App = d.querySelector("#modelId .modal-body")
        $App.innerHTML=""
    let $form = document.getElementById("artefacto_0003").content
        $form = d.importNode($form,true)

        $App.append( $form )


        $App.querySelector("button").addEventListener("click", async function(e){
            e.preventDefault()
                let input = $App.querySelector("input").value
                if (is_empty(input)) {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Atención',
                        text: `Escriba una cédula válida para hacer la busqueda.`,
                        didClose: () => {
                            setTimeout(() => {
                                $App.querySelector("input").value=""
                                $App.querySelector("input").focus()
                            } , 110);
                        }
                    })
                    return false
                }
                console.log(input)
                let formData = new FormData();
                    formData.append("cedula",input)
                    formData.append("_token",d.querySelector("#_token").value)
                let existeModel = await post("/consultaexterna/user_profile/cedulaExiste",formData)
                console.log(`respuesta 768 ${JSON.stringify(existeModel)}`)
                    if ( existeModel ) {
                        let model = await UserProfile.getCedula(input)
                            UserCuestUbicacion.reingreso('.modal-body',model.user_id)
                        return false
                    }else{

                        Toast.fire({
                            icon: 'info',
                            title: 'Ooops!',
                            text: `El paciente buscado no ha sido encontrado`,
                            didClose: () => {
                                setTimeout(() => {
                                    $App.querySelector("input").value=""
                                    $App.querySelector("input").focus()
                                } , 110);
                            }
                        })


                    }

        })


    }
let selectOptions = (model, param, fields=['id','description'] ) => {
        let id = param != undefined ? param : "";
        let selected = '';
        //<option value=''>Seleccione</option>
        let data = "";
        model.forEach( option => {
            if ( equalsInt( option[ fields[0] ] , id ) ) {
                //console.log(valueOfElement.id+"=="+id)
                selected = 'selected';
            } else {
                selected = '';
            }
            data += `
                <option ${selected} value="${option[ fields[0] ]}">
                    ${option[ fields[1] ]}
                </option>
            `;
        });

        return data;
    }
export async function configPage(){
    $App.innerHTML=""
    let $form = document.getElementById("artefacto_0002").content
        $form = d.importNode($form,true)

        $App.append( $form )

        mensajeBienvenida()
        useState.cat_estado       = await CatUserEstado_index()
        useState.cat_municipio    = await CatUserMunicipio_index()

        telefonoConfig("#telefono_movil")

        document.getElementById("cat_estado_id").innerHTML= selectOptions(useState.cat_estado, 14)
        document.getElementById("cat_municipio_id").innerHTML= selectOptions( useState.cat_municipio.filter( x=>equalsInt( x.cat_estado_id,14 ) ), 180 )
        document.getElementById("description").value="Caracas"

        d.querySelector("form").addEventListener("change",e=>{
            saveDataForm(e)
        })
        /* document.getElementById("tipo_registro").addEventListener("change",e=>{
            document.getElementById("cat_user_family_id").value =""
            if (e.target.value =="Familiar") {
                document.getElementById("registro_familiar").classList.remove("d-none")
                document.getElementById("cedula_familiar_text").classList.remove("d-none")

            }else{
                document.getElementById("registro_familiar").classList.add("d-none")
                document.getElementById("cedula_familiar_text").classList.add("d-none")
                document.getElementById("cedula_familiar_info").classList.add("d-none")

            }
        })
        document.getElementById("cat_user_family_id").addEventListener("change",e=>{
            if (e.target.value == 5) {
                document.getElementById("cedula_familiar_info").classList.remove("d-none")
                document.getElementById("numero_hijo_td").classList.remove("d-none")
            }else{
                document.getElementById("cedula_familiar_info").classList.add("d-none")
                document.getElementById("numero_hijo_td").classList.add("d-none")
            }
        }) */
        document.getElementById("userImage").addEventListener("change",e=>{
            imagePreview(e,"userImagePreview")
        })

        document.getElementById("imgDocIdentidad").addEventListener("change",e=>{
            imagePreview(e,"imgDocIdentidadPreview")
        })
        document.getElementById("imgSoyChacao").addEventListener("change",e=>{
            imagePreview(e,"imgSoyChacaoPreview")
        })
        // document.getElementById("partidaNacimiento").addEventListener("change",e=>{
        //     //console.log(URL.createObjectURL(e.target.files[0]))
        //     d.querySelector(`#pn_preview iframe`).src=URL.createObjectURL(e.target.files[0])
        //     imagePreview(e,"partidaNacimientoPreview")
        // })
        //validar si existe la cedula
        document.getElementById("cedula").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("cedula",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user_profile/cedulaExiste",formData)
            console.log(`artefacto_0002 --> ${existeModel}`)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El Documento de Identidad ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })
        //validar si existe el correo
        document.getElementById("email").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("email",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user/emailExist",formData)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El correo ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })

        d.querySelector("#submit").addEventListener("click", async function(e){
            e.preventDefault()

            if (await formFields_validate(e)) {
                d.querySelector(".overlay").classList.remove("d-none")
                let formData = new FormData();

                    for (const key in useState['formCreatePaciente']) {
                        if (Object.hasOwnProperty.call(useState['formCreatePaciente'], key)) {
                            let element = useState['formCreatePaciente'][key];
                                formData.append(key,element)
                        }
                    }
                let file1 = document.getElementById(`userImage`).files[0];
                let file2 = document.getElementById(`imgDocIdentidad`).files[0];
                let file3 = document.getElementById(`imgSoyChacao`).files[0];
                // let file4 = document.getElementById(`partidaNacimiento`).files[0];
                    formData.append("imagen", file1)
                    formData.append("imgDocIdentidad", file2)
                    formData.append("imgSoyChacao", file3)
                    // formData.append("partidaNacimiento", file4)
                    formData.append("created_at",timestamps() );
                    formData.append("_token",d.querySelector("#_token").value)
                let $response = post("/consultaexterna/user/paciente/storeExterno",formData)
                    $response.then(response=>{
                        if($response){
                            d.querySelector(".overlay").classList.add("d-none")
                            localStorage.setItem('email',useState['formCreatePaciente']['email'])
                            localStorage.setItem('password',useState['formCreatePaciente']['password'])
                            mensajeRegistro()
                        }
                    })
            }

        })
        $('#cat_estado_id').on('select2:select', function (e) {
            //console.log("-->",e.params.data.id)
            saveDataForm(e)
            let model = get_municipioBy( e.params.data.id )
            document.getElementById("cat_municipio_id").innerHTML=null
            document.getElementById("cat_municipio_id").append($select(model))
            //handleItemColor(".item-2",e)
            /*
            final_medico = e.params.data.text
            //console.log(final_medico)
            //let mesesDisponibles = useState.get_MedicoAgenda(e.params.data.id).get_meses()
            //let diasDisponible = useState.get_MedicoAgenda(e.params.data.id).get_agenda_dias()
                document.getElementById("cita_dia").value =``
                document.getElementById("mensaje_dia_seleccionado").innerHTML =`Solo los días resaltados están disponibles.`
                activarCalendario( e.params.data.id ) */
        });
        $('#cat_municipio_id').on('select2:select', function (e) {
            saveDataForm(e)
        });
        $('.select2').select2()


        $App.querySelector("#login").addEventListener( "click",function(e){
            PageLogin()
        } )
    }

export async function createInternoEmergencia(){

        $App.innerHTML=""
        let $form = document.getElementById("artefacto_0010").content
            $form = d.importNode($form,true)

            $App.append( $form )


            useState.cat_estado       = await CatUserEstado.getAll()
            useState.cat_municipio    = await CatUserMunicipio.getAll()
            useState['formCreatePaciente']['cat_user_ubicacion_id'] = 246
            useState['formCreatePaciente']['password'] = "123456"
            useState['formCreatePaciente']['cat_user_ubicacion_id'] = "245"
            useState['formCreatePaciente']['centro_salud_id'] = useState['user_centro_salud_id']


            telefonoConfig("#telefono_movil")

            document.getElementById("cat_estado_id").innerHTML= selectOptions(useState.cat_estado, 14)
            document.getElementById("cat_municipio_id").innerHTML= selectOptions( useState.cat_municipio.filter( x=>equalsInt( x.cat_estado_id,14 ) ), 180 )
            document.getElementById("description").value="Caracas"


            document.getElementById("cat_estado_id").append($select(useState.cat_estado))

            d.addEventListener("change",e=>{
                saveDataForm(e)
            })
            document.getElementById("userImage").addEventListener("change",e=>{
                imagePreview(e,"userImagePreview")
            })
            document.getElementById("imgDocIdentidad").addEventListener("change",e=>{
                imagePreview(e,"imgDocIdentidadPreview")
            })
            document.getElementById("imgSoyChacao").addEventListener("change",e=>{
                imagePreview(e,"imgSoyChacaoPreview")
            })
            /* document.getElementById("cedula").addEventListener("change", async e=>{
                let formData = new FormData();
                    formData.append("cedula",e.target.value)
                    formData.append("_token",d.querySelector("#_token").value)
                let existeModel = await post("/user_profile/cedulaExiste",formData)
                    if ( existeModel ) {
                        e.target.classList.remove("border-success")
                        e.target.classList.add("border-danger")

                        let cedula = e.target.value
                        let message = Component.alertMessage("cedula_asignada");

                            Toast.fire({
                                icon: 'warning',
                                title: 'Atención',
                                text: `El Documento de Identidad ${cedula} ya está registrado en el sistema. ¿Desea reingresar al paciente?.`,
                                showDenyButton: true,
                                showCancelButton: false,
                                confirmButtonText: `Si`,

                            }).then((result) => {
                                if (result.isConfirmed) {
                                    User.reingresoByCedula(cedula)
                                } else if (result.isDenied) {
                                    e.target.value=""
                                    e.target.focus()
                                }
                                e.target.value=""
                                e.target.focus()
                            })

                                    //registro interno

                        return false
                    }else{
                        e.target.classList.remove("border-danger")
                        e.target.classList.add("border-success")
                    }
            }) */
            /* document.getElementById("email").addEventListener("change", async e=>{
                let formData = new FormData();
                    formData.append("email",e.target.value)
                    formData.append("_token",d.querySelector("#_token").value)
                let existeModel = await post("/user/emailExist",formData)
                    if ( existeModel ) {
                        e.target.classList.remove("border-success")
                        e.target.classList.add("border-danger")
                            Toast.fire({
                                icon: 'warning',
                                title: 'Atención',
                                text: `El correo ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                                didClose: () => {
                                    setTimeout(() => {
                                        e.target.value=""
                                        e.target.focus()
                                    } , 110);
                                }
                            })
                        return false
                    }else{
                        e.target.classList.remove("border-danger")
                        e.target.classList.add("border-success")
                    }
            }) */

            $App.querySelector("#submit").addEventListener("click", async function(e){
                e.preventDefault()
                if (await formFields_validate_reg_interno()) {
                    let formData = new FormData();
                        for (const key in useState['formCreatePaciente']) {
                            if (Object.hasOwnProperty.call(useState['formCreatePaciente'], key)) {
                                let element = useState['formCreatePaciente'][key];
                                    formData.append(key,element)
                            }
                        }
                    let file1 = document.getElementById(`userImage`).files[0];
                    let file2 = document.getElementById(`imgDocIdentidad`).files[0];
                    let file3 = document.getElementById(`imgSoyChacao`).files[0];
                        formData.append("imagen", file1)
                        formData.append("imgDocIdentidad", file2)
                        formData.append("imgSoyChacao", file3)
                        formData.append("created_at",timestamps() );
                        formData.append("_token",d.querySelector("#_token").value)
                    let $response = post("/consultaexterna/paciente/emergenciaStore/store",formData)
                        $response.then(response=>{
                            if($response){
                                message = Component.alertMessage("send_success");
                                Toast.fire({
                                    icon: message['image'],
                                    title: message['title'],
                                    text: message['message'],
                                    didClose: () => {
                                        setTimeout(() => { window.location = "/medico";}, 110);
                                    }
                                })
                            }
                        })
                }

            })
            $('#cat_estado_id').on('select2:select', function (e) {
                //console.log("-->",e.params.data.id)
                saveDataForm(e)
                let model = get_municipioBy( e.params.data.id )
                document.getElementById("cat_municipio_id").innerHTML=null
                document.getElementById("cat_municipio_id").append($select(model))

            });
            $('#cat_municipio_id').on('select2:select', function (e) {
                saveDataForm(e)
            });
            $('.select2').select2()


            $App.querySelector("#regresar").addEventListener( "click",function(e){
                location.href="/medico"
            } )
    }
    /*
        export async function edit($App,paciente){
    console.log("user_id_paciente")
    if ($('select').data('select2')) {
        $('select').select2('destroy');
      }
    console.log(paciente)
    $App.innerHTML=""
    let $form = document.getElementById("artefacto_0029").content
        $form = d.importNode($form,true)
       let $tab = "#tab_paciente_create"
        $App.append( $form )
        $App.querySelector("h3").textContent="Editar Paciente"
        d.querySelector(".cat-cita-status-title").textContent="Editar Paciente"
        //mensajeBienvenida()
        useState.cat_estado       = await CatUserEstado_index()
        useState.cat_municipio    = await CatUserMunicipio_index()
        useState['formData']['email']=paciente.email
        useState['formData']['user_id']=paciente.user_id
        useState['formData']['nacionalidad']=paciente.nacionalidad
        useState['formData']['cedula']=paciente.cedula.replace(/\./g, '')
        useState['formData']['nombres']=paciente.nombres
        useState['formData']['apellidos']=paciente.apellidos
        useState['formData']['genero']=paciente.genero
        useState['formData']['fnacimiento']=paciente.fnacimiento
        useState['formData']['telefono_movil']=paciente.telefono_movil
        useState['formData']['cat_estado_id']=paciente.cat_estado_id
        useState['formData']['cat_municipio_id']=paciente.cat_municipio_id
        useState['formData']['description']=paciente.description
        useState['formData']['domicilio']=paciente.domicilio

        telefonoConfig("#telefono_movil")

        //$App.querySelector(`#userImagePreview`).src= paciente.imagen
        $App.querySelector(`input[name='cedula']`).value= paciente.cedula.replace(/\./g, '')
        $App.querySelector(`input[name='email']`).value= paciente.email
        $App.querySelector(`input[name='nombres']`).value= paciente.nombres
        $App.querySelector(`input[name='apellidos']`).value= paciente.apellidos
        $App.querySelector(`select[name='genero']`).value= paciente.genero
        $App.querySelector(`input[name='fnacimiento']`).value= fechaInputDate( paciente.fnacimiento )
        $App.querySelector(`input[name='telefono_movil']`).value=  paciente.telefono_movil
        $App.querySelector(`input[name='description']`).value= paciente.description
        $App.querySelector(`input[name='domicilio']`).value= paciente.domicilio





        document.getElementById("cat_estado_id").innerHTML= selectOptions(useState.cat_estado, paciente.cat_estado_id)
        document.getElementById("cat_municipio_id").innerHTML= selectOptions( useState.cat_municipio.filter( x=>equalsInt( x.cat_estado_id,paciente.cat_estado_id ) ), paciente.cat_municipio_id )
        //document.getElementById("description").value="Caracas"

        d.querySelector("form").addEventListener("change",e=>{
            saveDataForm(e)
        })
        document.getElementById("userImage").addEventListener("change",e=>{
            imagePreview(e,"userImagePreview")
        })
        document.getElementById("imgDocIdentidad").addEventListener("change",e=>{
            imagePreview(e,"imgDocIdentidadPreview")
        })
        document.getElementById("imgSoyChacao").addEventListener("change",e=>{
            imagePreview(e,"imgSoyChacaoPreview")
        })
        //validar si existe la cedula
        document.getElementById("cedula").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("cedula",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/user_profile/cedulaExiste",formData)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El Documento de Identidad ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })
        //validar si existe el correo
        document.getElementById("email").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("email",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/user/emailExist",formData)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El correo ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })

        d.querySelector("#submit").addEventListener("click", async function(e){
            e.preventDefault()
            if (await create_fields_validation("#tab_paciente_create")) {
                //d.querySelector("#tab_paciente_create_cita .overlay").classList.remove("d-none")
                d.querySelector(`#form_nuevo_paciente .overlay`).classList.remove("d-none")
                let formData = new FormData();

                    for (const key in useState) {
                        if (Object.hasOwnProperty.call(useState, key)) {
                            let element = useState[key];
                                formData.append(key,element)
                        }
                    }
                let file1 = document.getElementById(`userImage`).files[0];
                let file2 = document.getElementById(`imgDocIdentidad`).files[0];
                let file3 = document.getElementById(`imgSoyChacao`).files[0];
                    formData.append("imagen", file1)
                    formData.append("imgDocIdentidad", file2)
                    formData.append("imgSoyChacao", file3)
                    formData.append("created_at",timestamps() );
                    formData.append("_token",d.querySelector("#_token").value)
                let $response = post("/paciente/consultaExternaStore/update",formData)
                    $response.then(response=>{
                        if($response){
                            let cedula = d.querySelector("#tab_paciente_create input[name='cedula']").value
                                get(`/user/profile/show_by_cedula/${cedula}`)
                                .then(response=>{
                                    console.log(response)
                                    localStorage.setItem('update_user', JSON.stringify( first(response) ) );
                                    //localStorage.setItem('paciente_cedula', first(response)['cedula'] );
                                    //localStorage.setItem('paciente_user_id', first(response)['user_id'] );
                                    updateCitas()

                                    Toast.fire({
                                        icon: 'success',
                                        title: '¡Registro Actualizado!',
                                        text: 'Los datos se han actualizado correctamente.',
                                        //footer: '<a class="btn btn-success btn-block paciente_create_cita" href="#"><i class="pc-cita_por_confirmar paciente_create_cita"></i> Nueva Cita</a>',
                                        didClose: () => {
                                            //limpiar formulario

                                            d.querySelector(`#form_nuevo_paciente .overlay`).classList.add("d-none")


                                        }
                                    }).then(result=>{
                                        if (result.isConfirmed) {
                                            /* enrutador("#tab_citas")
                                            useState.status_current_tab = 6
                                                cat_user_cita_status_id = 6
                                                handle_tablaCitas(cat_user_cita_status_id, "Consulta")
                                                await updateTotales()
                                            d.querySelector("#tab_paciente_create_cita .overlay").classList.add("d-none")

                                        }
                                    })
                                })

                        }
                    })
            }

        })
        $('#cat_estado_id').on('select2:select', function (e) {
            //console.log("-->",e.params.data.id)
            saveDataForm(e)
            let model = useState.get_municipioBy( e.params.data.id )
            document.getElementById("cat_municipio_id").innerHTML=null
            document.getElementById("cat_municipio_id").append($select(model))
            //handleItemColor(".item-2",e)
            /*
            final_medico = e.params.data.text
            //console.log(final_medico)
            //let mesesDisponibles = useState.get_MedicoAgenda(e.params.data.id).get_meses()
            //let diasDisponible = useState.get_MedicoAgenda(e.params.data.id).get_agenda_dias()
                document.getElementById("cita_dia").value =``
                document.getElementById("mensaje_dia_seleccionado").innerHTML =`Solo los días resaltados están disponibles.`
                activarCalendario( e.params.data.id )
        });
        $('#cat_municipio_id').on('select2:select', function (e) {
            saveDataForm(e)
        });
        $('.select2').select2()


    }*/
export async function create($App){
    $App.innerHTML=""
    let $form = document.getElementById("artefacto_0029").content
        $form = d.importNode($form,true)

        $App.append( $form )
        $App.querySelector("h3").textContent="Nuevo Paciente"
        d.querySelector(".cat-cita-status-title").textContent="Nuevo Paciente"
        //mensajeBienvenida()
        useState.cat_estado       = await CatUserEstado_index()
        useState.cat_municipio    = await CatUserMunicipio_index()
        useState['formCreatePaciente']['formData']['password']="123456"
        useState['formCreatePaciente']['formData']['password_repeat']="123456"
        telefonoConfig("#telefono_movil")

        document.getElementById("cat_estado_id").innerHTML= selectOptions(useState.cat_estado, 14)
        document.getElementById("cat_municipio_id").innerHTML= selectOptions( useState.cat_municipio.filter( x=>equalsInt( x.cat_estado_id,14 ) ), 180 )
        document.getElementById("description").value="Caracas"

        d.querySelector("form").addEventListener("change",e=>{
            saveDataForm(e)
        })
        document.getElementById("userImage").addEventListener("change",e=>{
            imagePreview(e,"userImagePreview")
        })
        document.getElementById("imgDocIdentidad").addEventListener("change",e=>{
            imagePreview(e,"imgDocIdentidadPreview")
        })
        document.getElementById("imgSoyChacao").addEventListener("change",e=>{
            imagePreview(e,"imgSoyChacaoPreview")
        })
        //validar si existe la cedula
        document.getElementById("cedula").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("cedula",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user_profile/cedulaExiste",formData)
            console.log(`respuesta 1383 ${JSON.stringify(existeModel)}`)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El Documento de Identidad ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })
        //validar si existe el correo
        document.getElementById("email").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("email",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user/emailExist",formData)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El correo ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })

        d.querySelector("#submit").addEventListener("click", async function(e){
            e.preventDefault()
            if (await create_fields_validation("#tab_paciente_create")) {
                //d.querySelector("#tab_paciente_create_cita .overlay").classList.remove("d-none")
                d.querySelector(`#form_nuevo_paciente .overlay`).classList.remove("d-none")
                let formData = new FormData();

                    for (const key in useState['formCreatePaciente']) {
                        if (Object.hasOwnProperty.call(useState['formCreatePaciente'], key)) {
                            let element = useState['formCreatePaciente'][key];
                                formData.append(key,element)
                        }
                    }
                let file1 = document.getElementById(`userImage`).files[0];
                let file2 = document.getElementById(`imgDocIdentidad`).files[0];
                let file3 = document.getElementById(`imgSoyChacao`).files[0];
                    formData.append("imagen", file1)
                    formData.append("imgDocIdentidad", file2)
                    formData.append("imgSoyChacao", file3)
                    formData.append("created_at",timestamps() );
                    formData.append("_token",d.querySelector("#_token").value)

                let $response = post("/consultaexterna/paciente/consultaExternaStore/store",formData)
                    $response.then(response=>{
                        if($response){
                            let cedula = d.querySelector("#tab_paciente_create input[name='cedula']").value
                                get(`/consultaexterna/user/profile/show_by_cedula/${cedula}`)
                                .then(response=>{
                                    console.log(response)
                                    console.log("antes->", useState['users'])

                                    add_row("users",response)

                                    console.log("despues->", useState['users'])
                                    //localStorage.setItem('new_user', JSON.stringify( first(response) ) );
                                    //localStorage.setItem('paciente_cedula', first(response)['cedula'] );
                                    //localStorage.setItem('paciente_user_id', first(response)['user_id'] );


                                    Toast.fire({
                                        icon: 'success',
                                        title: '¡Registro creado!',
                                        text: 'El paciente se ha creado correctamente.',
                                        footer: '<a class="btn btn-success btn-block paciente_create_cita" href="#"><i class="pc-cita_por_confirmar paciente_create_cita"></i> Nueva Cita</a>',
                                       /*  didClose: () => {
                                            //limpiar formulario

                                            d.querySelector(`#form_nuevo_paciente .overlay`).classList.add("d-none")


                                        } */
                                    }).then(result=>{
                                        if (result.isConfirmed) {
                                            ComponentBuscador.init()
                                            /* enrutador("#tab_citas")
                                            useState.status_current_tab = 6
                                                cat_user_cita_status_id = 6
                                                handle_tablaCitas(cat_user_cita_status_id, "Consulta")
                                                await updateTotales() */
                                            d.querySelector("#tab_paciente_create_cita .overlay").classList.add("d-none")

                                        }
                                    })
                                })

                        }
                    })
            }

        })
        $('#cat_estado_id').on('select2:select', function (e) {
            //console.log("-->",e.params.data.id)
            saveDataForm(e)
            let model = get_municipioBy( e.params.data.id )
            document.getElementById("cat_municipio_id").innerHTML=null
            document.getElementById("cat_municipio_id").append($select(model))
            //handleItemColor(".item-2",e)
            /*
            final_medico = e.params.data.text
            //console.log(final_medico)
            //let mesesDisponibles = useState.get_MedicoAgenda(e.params.data.id).get_meses()
            //let diasDisponible = useState.get_MedicoAgenda(e.params.data.id).get_agenda_dias()
                document.getElementById("cita_dia").value =``
                document.getElementById("mensaje_dia_seleccionado").innerHTML =`Solo los días resaltados están disponibles.`
                activarCalendario( e.params.data.id ) */
        });
        $('#cat_municipio_id').on('select2:select', function (e) {
            saveDataForm(e)
        });
        $('.select2').select2()


    }
export let user_edit = async (selector,user_id)=>{

    $App = d.querySelector( selector )
    $App.innerHTML=""
    let $form = document.getElementById("artefacto_0010").content
        console.log($form)
        $form = d.importNode($form,true)
        console.log($form.querySelectorAll('div'))
        $form.querySelectorAll('div')[2].classList.add("d-none")
        $form.querySelectorAll('div')[6].classList.add("d-none")
        $form.querySelectorAll('img')[0].classList.add("d-none")
        $form.querySelectorAll('div')[50].classList.add("d-none")
        $form.querySelectorAll('div')[52].classList.add("d-none")

    let $loading = document.getElementById("artefacto_0004").content
        $loading = d.importNode($loading,true)
        $loading.querySelectorAll("div")[5].classList.remove("text-white")
        $loading.querySelectorAll("div")[5].classList.add("text-primary")
        $App.append( $loading )

    let user = await User.show(user_id)
    let user_profile = await UserProfile.show(user_id)
    let user_direction = await UserCuestDireccion.show(user_id)
        useState.cat_estado       = await CatUserEstado.getAll()
        useState.cat_municipio    = await CatUserMunicipio.getAll()
    let user_profile_images = await getUserProfileImages(user_id)
    let user_tarjeta_soy_chacao = await getTarjetaSoyChacao(user_id)


        useState['formCreatePaciente']["email"] = user.email


        useState['formCreatePaciente']["nombres"] = user_profile.nombres
        useState['formCreatePaciente']["apellidos"] = user_profile.apellidos
        useState['formCreatePaciente']["cedula"] = user_profile.cedula
        useState['formCreatePaciente']["fnacimiento"] = user_profile.fnacimiento
        useState['formCreatePaciente']["genero"] = user_profile.genero
        useState['formCreatePaciente']["nacionalidad"] = user_profile.nacionalidad
        useState['formCreatePaciente']["telefono_movil"] = user_profile.telefono_movil
        useState['formCreatePaciente']["temp_imagen"] = user_profile.imagen
        useState['formCreatePaciente']["temp_tarjeta_soy_chacao"] = first( user_profile_images.filter( x=>x.coments==="imgSoyChacao") )?.value
        useState['formCreatePaciente']["temp_imgDocIdentidad"] = first( user_profile_images.filter( x=>x.coments==="imgDocIdentidad") )?.value
        useState['formCreatePaciente']["description"] = user_direction.description
        useState['formCreatePaciente']["domicilio"] = user_direction.domicilio
        useState['formCreatePaciente']["cat_estado_id"] = user_direction.cat_estado_id
        useState['formCreatePaciente']["cat_municipio_id"] = user_direction.cat_municipio_id
        useState['formCreatePaciente']["tarjeta_soy_chacao"] = user_tarjeta_soy_chacao?.description




        $form.querySelectorAll('img')[1].src= useState['formCreatePaciente']["temp_imagen"]
        $form.querySelectorAll('img')[2].src= useState['formCreatePaciente']["temp_tarjeta_soy_chacao"]
        $form.querySelectorAll('img')[3].src= useState['formCreatePaciente']["temp_imgDocIdentidad"]
        $form.querySelector("select[name='cat_estado_id']").append( $select(useState.cat_estado) )
        $form.querySelector("select[name='cat_estado_id']").options[ useState.cat_estado.map(x => x.id).findIndex( x => x === user_direction.cat_estado_id )+1  ].selected=true

        $form.querySelector("input[name='description']").value= useState['formCreatePaciente']["description"]
        $form.querySelector("input[name='domicilio']").value= useState['formCreatePaciente']["domicilio"]

        $form.querySelector("select[name='nacionalidad']").options[ ["V","E","P","J"].findIndex( x => x=== useState["nacionalidad"] )  ].selected=true
        $form.querySelector("input[name='cedula']").value= useState['formCreatePaciente']["cedula"]
        $form.querySelector("input[name='email']").value= useState['formCreatePaciente']["email"]
        $form.querySelector("input[name='nombres']").value= useState['formCreatePaciente']["nombres"]
        $form.querySelector("input[name='apellidos']").value= useState['formCreatePaciente']["apellidos"]
        $form.querySelector("select[name='genero']").options[ ["m","f"].findIndex( x => x=== useState['formCreatePaciente']["genero"] )  ].selected=true
        $form.querySelector("input[name='fnacimiento']").value= useState['formCreatePaciente']["fnacimiento"]
        $form.querySelector("input[name='telefono_movil']").value= useState['formCreatePaciente']["telefono_movil"]
        $form.querySelector("input[name='tarjeta_soy_chacao']").value= useState['formCreatePaciente']["tarjeta_soy_chacao"]



        $App.innerHTML=""
        $App.append( $form )

        $App.querySelectorAll('div')[8].textContent="Datos del Paciente"
        $App.querySelector('button#submit').textContent="Actualizar"



        telefonoConfig("#telefono_movil")
        document.getElementById("cat_estado_id").append($select(useState.cat_estado))

        $App.querySelector("form").addEventListener("change",e=>{
            saveDataForm(e)
        })
        document.getElementById("userImage").addEventListener("change",e=>{
            imagePreview(e,"userImagePreview")
        })

        document.getElementById("imgDocIdentidad").addEventListener("change",e=>{
            imagePreview(e,"imgDocIdentidadPreview")
        })
        document.getElementById("imgSoyChacao").addEventListener("change",e=>{
            imagePreview(e,"imgSoyChacaoPreview")
        })
        document.getElementById("cedula").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("cedula",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user_profile/cedulaExiste",formData)
            console.log(`respuesta 1625 ${JSON.stringify(existeModel)}`)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El Documento de Identidad ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })
        document.getElementById("email").addEventListener("change", async e=>{
            let formData = new FormData();
                formData.append("email",e.target.value)
                formData.append("_token",d.querySelector("#_token").value)
            let existeModel = await post("/consultaexterna/user/emailExist",formData)
                if ( existeModel ) {
                    e.target.classList.remove("border-success")
                    e.target.classList.add("border-danger")
                        Toast.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: `El correo ${e.target.value} ya está registrado en el sistema. Debe usar uno distinto.`,
                            didClose: () => {
                                setTimeout(() => {
                                    e.target.value=""
                                    e.target.focus()
                                } , 110);
                            }
                        })
                    return false
                }else{
                    e.target.classList.remove("border-danger")
                    e.target.classList.add("border-success")
                }
        })

        $App.querySelector("#submit").addEventListener("click", async function(e){
            e.preventDefault()
            if (await formFields_validate_reg_interno()) {
                let formData = new FormData();
                    for (const key in useState['formCreatePaciente']) {
                        if (Object.hasOwnProperty.call(useState['formCreatePaciente'], key)) {
                            let element = useState['formCreatePaciente'][key];
                                formData.append(key,element)
                        }
                    }
                let file1 = document.getElementById(`userImage`).files[0];
                let file2 = document.getElementById(`imgDocIdentidad`).files[0];
                let file3 = document.getElementById(`imgSoyChacao`).files[0];
                    formData.append("user_id", user_id)
                    formData.append("imagen", file1)
                    formData.append("telefono_movil", iti.getNumber())
                    formData.append("imgDocIdentidad", file2)
                    formData.append("imgSoyChacao", file3)
                    formData.append("created_at",timestamps() );
                    formData.append("_token",d.querySelector("#_token").value)
                let $response = post("/consultaexterna/paciente/consultaExternaStore/update",formData)
                    $response.then(response=>{
                        if($response){
                            message = Component.alertMessage("send_success");
                            Toast.fire({
                                icon: message['image'],
                                title: message['title'],
                                text: message['message'],
                                didClose: () => {
                                   // setTimeout(() => { }, 110);
                                }
                            })
                        }
                    })
            }

        })

        $('#cat_estado_id').on('select2:select', function (e) {
            saveDataForm(e)
            let model = get_municipioBy( e.params.data.id )
                document.getElementById("cat_municipio_id").innerHTML=null
                document.getElementById("cat_municipio_id").append($select(model))
        });
        $('#cat_municipio_id').on('select2:select', function (e) {
            saveDataForm(e)
        });


    let model = get_municipioBy( user_direction.cat_estado_id )
        document.getElementById("cat_municipio_id").innerHTML=null
        document.getElementById("cat_municipio_id").append($select(model))
        d.querySelector("select[name='cat_municipio_id']").options[ model.map(x => x.id).findIndex( x => x === user_direction.cat_municipio_id )+1  ].selected=true

        $('.select2').select2()


       /*  $App.querySelector("#regresar").classList.remove("btn-default","text-primary")
        $App.querySelector("#regresar").classList.add("btn-primary")
        $App.querySelector("#regresar").textContent="Cerrar"
        $App.querySelector("#regresar").addEventListener( "click",function(e){
            $("#modelId").modal("hide")
        } )  */
}
export async function configPageEdit(user_id){
        $("#modelId").modal("show")
        $App = d.querySelector("#modelId .modal-body")
        $App.innerHTML=""
        let $form = document.getElementById("artefacto_0010").content
            $form = d.importNode($form,true)
            $form.querySelectorAll('img')[0].classList.add("d-none")
            $form.querySelectorAll('div')[50].classList.add("d-none")
            $form.querySelectorAll('div')[52].classList.add("d-none")

        let $loading = document.getElem