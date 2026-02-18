import { } from "../../helpers/helpers.js"
import { configPage as configPageUserCreate } from "./user_create.js"
import { configPage as configPageResetPassword } from "../user/user_reset_password.js"
let d = document
let useState = {
    "success": false,
    "user_centro_salud": [],
    "centro_salud_id": null,
    "user_type": [],
    "user_type_routes": {},
    "formLogin": {
        "email": null,
        "password": null,
        "cat_user_type_id": null,
        "centro_salud_id": null,
        "cat_area_atencion_route": null,
    }
}
export let $App = entById("App")
let irA = (response) => {
    switch (parseInt(response.cat_user_type_id)) {
        case 1://paciente
            //console.log(response.user_type_routes[ parseInt(response.cat_user_type_id) ])
            //location.href= response.user_type_routes[ parseInt(response.cat_user_type_id) ]
            handleForm()
            break;
        case 2://medico
            step_3(response)
            break;
        case 3://familiar
            step_3(response)
            break;
        case 4://administrador
            handleForm()
            break;
        case 6://enfermeria
            step_3(response)
            break;
        case 7://atención al paciente
            step_3(response)
            break;
        case 9://reportes
            handleForm()
            break;
        default:
            Toast.fire({
                icon: 'warning',
                title: 'Atención',
                text: `${useState.formLogin.email} no posee roles asignados.`,
                didClose: () => {
                    setTimeout(() => step_1(), 110);
                }
            })
            break;
    }
}
let handleForm = () => {
    location.href = `/consultaexterna/initSession?data=${JSON.stringify(get_formLogin())}`
}
let formFields_validate = async (response) => {
    let { email, password } = useState.formLogin
    if (is_empty(email)) {
        let input = d.querySelector(`input[name='email']`)
        Toast.fire({
            icon: 'warning',
            title: 'Atención',
            text: input.title,
            didClose: () => {
                setTimeout(() => input.focus(), 110);
            }
        })
        return false
    }
    if (is_empty(password)) {
        let input = d.querySelector(`input[name='password']`)
        Toast.fire({
            icon: 'warning',
            title: 'Atención',
            text: input.title,
            didClose: () => {
                setTimeout(() => input.focus(), 110);
            }
        })
        return false
    }


    return true
}
let formUser_validate = async () => {
    let formData = new FormData();
        for (const key in useState.formLogin) {
            formData.append(key, useState.formLogin[key])
        }
        formData.append("_token", entById('_token').value)
    let model = await post("/consultaexterna/verificarCredenciales", formData)
        console.log("verificarCredenciales-->", model)
        if (!is_undefined(model)) {
            if (!model.success) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: 'Los datos ingresados no son válidos o no están registrados.',
                    footer: '<a id="passwordReset3" class="passwordReset text-center h5" href="#">¿No puedes ingresar? Pulsa aquí para restaurar o actualizar tu contraseña</a>'
                })
                d.querySelector("input[name='email']").value = ""
                d.querySelector("input[name='password']").value = ""
                /* Toast.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: "Los datos ingresados no se encuentraron registrados.",
                    didClose: () => {
                        setTimeout(() => {
                            d.querySelector("input[name='email']").value = ""
                            d.querySelector("input[name='password']").value = ""
                        } , 110);
                    }
                }) */
            } else {
                if (
                    !is_empty(model.fnacimiento) ||
                    !is_null(model.fnacimiento)
                ) {
                    let date = new Date(model.fnacimiento)
                    if (date.getFullYear() < 1900) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Atención',
                            text: `El paciente no posee una fecha de nacimiento válida`,
                            didClose: () => {
                                setTimeout(() => {
                                    document.querySelector("input[name='email']").value = ""
                                    document.querySelector("input[name='password']").value = ""
                                    document.querySelector("input[name='email']").focus()
                                }, 110);
                            }
                        })
                        return false
                    }
                    let edad = calcularEdad(date)
                    if (edad < 0) {
                        edad = 0;
                    }
                    if (edad < 18) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Atención',
                            text: `Solo pacientes mayores de edad pueden autenticarse en el sistema`,
                            didClose: () => {
                                setTimeout(() => {
                                    document.querySelector("input[name='email']").value = ""
                                    document.querySelector("input[name='password']").value = ""
                                    document.querySelector("input[name='email']").focus()
                                }, 110);
                            }
                        })
                        return false
                    }

                }





                for (const key in model) {
                    useState[key] = model[key]
                }


                step_2()
            }
        } else {
            /*  Toast.fire({
                icon: 'info',
                title: 'Atención',
                text: "Reiniciando la aplicación por inactividad...",
                didClose: () => {
                    setTimeout(() =>{
                        location.reload()
                    } , 110);
                }
            }) */
        }


    return true
}
let set_formLogin = (e) => {
    useState.formLogin[e.target.name] = e.target.value
}
let set_formLogin2 = (response) => {
    useState.formLogin[Object.keys(response)] = first(Object.values(response))
}
let get_formLogin = (response) => {
    return useState.formLogin
}
export let mensajeInicioLogin = ()=>{

    modalMensaje({
        title:`
        <p class="text-center">
            Estimado Usuario<br>
        </p>
        `,
        content:`
            <div class="modal-font-size text-center">
                <p>
                    Le damos la más cordial bienvenida<br>
                    a nuestro sistema de solicitud de citas.<br>
                </p>
                <p>
                    Si está registrado, por favor pulse en <a  data-dismiss="modal" class="text-white font-weight-bold"  href="#">continuar</a><br>
                    y luego ingrese con su<br>
                    cédula de identidad y contraseña.
                </p>
                <p>
                    Si deseas registrarse, pulse aquí:<br>
                    <a id="modal_userCreate" data-dismiss="modal" class="btn btn-outline-white mt-3 rounded-pill" href="#">Registrar</a><br>
                </p>
                <p>
                    Si no recuerda su contraseña,<br>
                    puede recuperarla o actualizarla pulsando aquí:<br>
                    <a id="modal_passwordReset"  data-dismiss="modal" class="modal_passwordReset btn btn-outline-white mt-3 rounded-pill" href="#">Recuperar o actualizar mi contraseña</a><br>
                </p>

                <p>
                    Muchas gracias por su tiempo y colaboración.
                </p>
            </div>
        `,
        action:`
            <button data-dismiss="modal" type="button" class="btn btn-light btn-block btn-lg text-primary">Continuar</button>
        `,
    })

}
//pantalla formunario inicio
export let step_1 = async () => {
    $App.innerHTML = ""
    let $form = entById("artefacto_0001").content
    $form = d.importNode($form, true)
    if (
        localStorage.getItem("email") != null &&
        localStorage.getItem("password") != null
    ) {
        $form.querySelector("input[name='email']").value = localStorage.getItem("email")
        $form.querySelector("input[name='password']").value = localStorage.getItem("password")
        useState.formLogin["email"] = localStorage.getItem("email")
        useState.formLogin["password"] = localStorage.getItem("password")
        localStorage.removeItem("email")
        localStorage.removeItem("password")

    }
    $App.append($form)


    entById("passwordReset").addEventListener("click", function (e) {
        configPageResetPassword()
    })
    d.addEventListener("click", function (e) {
        if(e.target.classList.contains("passwordReset")){
            Swal.close()
            configPageResetPassword()
        }
    })
    entById("user_create").addEventListener("click", function (e) {
        configPageUserCreate()
    })
    d.querySelector("form").addEventListener("change", e => {
        set_formLogin(e)
    })
    d.querySelector("#submit").addEventListener("click", async e => {
        e.preventDefault()

        if (await formFields_validate()) {
            await formUser_validate()
        }
    })
    d.querySelector("form").addEventListener("submit", async function (e) {
        e.preventDefault()
    })
    d.querySelector("form").addEventListener("keyup", async function (e) {
        //  console.log(e.keyCode)
        if (e.keyCode === 13) {
            if (await formFields_validate()) {
                await formUser_validate()
            }
        }
    })
}
//pantalla seleccion de rol
let step_2 = () => {
    console.log("useState",useState)
    //si tiene mas de un rol
    if (useState.user_type.length > 1) {
        $App.innerHTML = ""
        let $form = entById("artefacto_0006").content
            $form = d.importNode($form, true)
            $form.querySelectorAll("div.row").forEach(x => {
                let { cat_user_type_id } = x.dataset

                if (useState.user_type.includes(parseInt(cat_user_type_id))) {
                    x.style.opacity = 1
                    x.addEventListener("click", function (e) {
                        console.log("cat_user_type_id_selected->", e.currentTarget.dataset.cat_user_type_id)
                        useState['user_type_selected'] = parseInt(e.currentTarget.dataset.cat_user_type_id)
                        set_formLogin2({ "cat_user_type_id": parseInt(cat_user_type_id) })
                        Object.assign(useState, { "cat_user_type_id": parseInt(cat_user_type_id) })
                        console.log(useState)
                        irA(useState)
                    })
                }
            })
            $App.append($form)
            $App.querySelector("#regresar").addEventListener("click", function (e) {
                step_1()
            })
    } else {
        Object.assign(useState, { "cat_user_type_id": first(useState.user_type) })
        console.log("useState",useState)
        set_formLogin2({ "cat_user_type_id": first(useState.user_type) })
        irA(useState)
    }

}
//pantalla seleccion de centro de salud
let step_3 = (response) => {

    let $form = entById("artefacto_0007").content.cloneNode(true)
    //$form = d.importNode($form, true)
    console.log("centros de salud a los que puede acceder segun su rol------>", response.user_centro_salud)
    if (response.user_centro_salud[useState['user_type_selected']].length === 0) {
        Toast.fire({
            icon: 'warning',
            title: 'Atención',
            text: `${useState.formLogin.email} no posee Centros de salud asignados.`,
            didClose: () => {
                setTimeout(() => configPage(), 110);
            }
        })
        return false
    }
    set_formLogin2({ "centro_salud_id": 1 })
    Object.assign(response, { "cat_area_atencion_id": 1 })
    step_4(response)
    /* */
    /* if (response.user_centro_salud[useState['user_type_selected']].length > 1) {
        $App.innerHTML = ""
        let $form = entById("artefacto_0007").content.cloneNode(true)
        //$form = d.importNode($form,true)

        $form.querySelectorAll("div.row").forEach(x => {
            let {
                    cat_centro_salud_id,
                    cat_area_atencion_id
                } = x.dataset
                console.log(parseInt(cat_centro_salud_id));
                console.log( response.user_centro_salud[useState['user_type_selected']] )
                if (response.user_centro_salud[useState['user_type_selected']].includes(parseInt(cat_centro_salud_id))) {
                    x.style.opacity = 1

                    x.classList.remove("d-none")

                    x.addEventListener("click", function (e) {


                    })
                }
        })
        $App.append($form)
        $App.querySelector("#regresar").addEventListener("click", function (e) {
            step_2()
        })
        activarTooltip()
    } else { */


        /* $form.querySelectorAll("div.row").forEach(x => {

            let { cat_centro_salud_id, cat_area_atencion_id } = x.dataset
            //console.log(cat_centro_salud_id)
            //console.log(response.user_centro_salud)
            //if (response.user_centro_salud[useState['user_type_selected']].includes(parseInt(cat_centro_salud_id))) {
                set_formLogin2({ "centro_salud_id": 1 })
                Object.assign(response, { "cat_area_atencion_id": 1 })
                step_4(response)
            //}
        }) */
    /* } */
}
let step_4 = (response) => {
    if (response.cat_area_atencion_id > 2) {
        let $form = entById("artefacto_0008").content
        $form = d.importNode($form, true)
        $App.innerHTML = ""
        $form.querySelectorAll("div.row").forEach(x => {
            if (equalsInt(x.dataset.area_atencion, response.cat_area_atencion_id) || equalsInt(response.cat_area_atencion_id, 3)) //cat_area_atencion_id = 1,2,3
            {
                x.style.opacity = 1
                x.addEventListener("click", function (e) {
                    set_formLogin2({ "cat_area_atencion_route": x.dataset.route })
                    handleForm()
                })
            }
        })
        $App.append($form)
        $App.querySelector("#regresar").addEventListener("click", function (e) {
            step_3(useState)
        })
    } else {

        set_formLogin2({ "cat_area_atencion_route": response.user_type_routes[useState['user_type_selected']] })
        handleForm()


    }
}
