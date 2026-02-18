import {step_1 as PageLogin} from './login.js'

let d = document
var _token = document.getElementById('_token').value;

let useState ={
        email:null,
        password:null,
        password_confirm:null,
        password_token:null,
        _token,

    }


export  let $App = entById("App")

export function configPage(){
        $App.innerHTML=""
        let $form = entById("artefacto_0005").content
            $form = d.importNode($form,true)
            $form.querySelector("#btn_form1").addEventListener("click",async (e)=>{
                e.preventDefault();

                let {email} = useState;
                document.getElementById('sms_email').innerHTML=email
                if (!email) {
                    Toast.fire({
                        icon: "warning",
                        title: "Atención",
                        text: "El campo no puede estar vacio",
                        didClose: () => {
                            setTimeout(() => document.getElementById("email").focus(), 110);
                        }
                    })
                    return false;
                }
                let formdata = new FormData();
                    for (let prop in useState){
                        formdata.append( prop , useState[prop] )
                    }
                let response = await post("/consultaexterna/passwordResetStore",formdata)
                    if (response.status==="data_not_found") {
                        Toast.fire({
                            icon: "warning",
                            title: "Atención",
                            text: "El Correo Electrónico no existe en el sistema, verifique",
                            didClose: () => {
                                setTimeout(() => document.getElementById("email").focus(), 110);
                            }
                        })
                        document.querySelector("#form2").reset()
                        document.querySelector("#form1").classList.remove("d-none")
                        document.querySelector("#form2").classList.add("d-none")
                        return false;
                    }
                    if(response.status){
                        document.querySelector("#form1").classList.add("d-none")
                        document.querySelector("#form2").classList.remove("d-none")
                        //useState.password_token=response.data.token
                        /* document.querySelector("#password_token").value=response.data.token */
                        /* document.querySelector("#password").value="" */
                       /*  document.querySelector("#token_recibido").innerHTML=response.data.token */
                    }

            })
            $form.querySelector("#btn_form2").addEventListener("click",async (e)=>{
                //e.preventDefault();
                let {password_token,password,password_confirm} = useState;


                if (!password) {
                    Toast.fire({
                        icon: "warning",
                        title: "Atención",
                        text: "El campo Nueva contraseña no puede estar vacio",
                        didClose: () => {
                            setTimeout(() => document.getElementById("password").focus(), 110);
                        }
                    })
                    return false;
                }
                if (!password_confirm) {
                    Toast.fire({
                        icon: "warning",
                        title: "Atención",
                        text: "El campo Confirma nueva contraseña no puede estar vacio",
                        didClose: () => {
                            setTimeout(() => document.getElementById("password_confirm").focus(), 110);
                        }
                    })
                    return false;
                }
                if (password !== password_confirm) {
                    Toast.fire({
                        icon: "warning",
                        title: "Atención",
                        text: "Las nuevas contraseñas no son iguales",
                        didClose: () => {
                            setTimeout(() => document.getElementById("password_confirm").focus(), 110);
                        }
                    })
                    return false;
                }
                if (!password_token) {
                    Toast.fire({
                        icon: "warning",
                        title: "Atención",
                        text: "No has ingresado el token enviado al correo indicado.",
                        didClose: () => {
                            setTimeout(() => document.getElementById("password_token").focus(), 110);
                        }
                    })
                    return false;
                }
                let formdata = new FormData();
                    for (let prop in useState){
                        formdata.append( prop , useState[prop] )
                    }
                let response = await post("/consultaexterna/passwordResetStoreConfirm",formdata)

                    if (response.status==="token_not_found") {

                        Toast.fire({
                            icon: "warning",
                            title: "Atención",
                            text: "El Token escrito no es correcto, verifique",
                            didClose: () => {
                                setTimeout(() => document.getElementById("email").focus(), 110);
                            }
                        })
                        document.querySelector("#form2").reset()
                        document.querySelector("#form1").classList.remove("d-none")
                        document.querySelector("#form2").classList.add("d-none")
                        return false;
                    }
                    if(response.status){
                        Toast.fire({
                            icon: "success",
                            title: "Cambio Exitoso",
                            text: "La contraseña se ha actualizado correctamente.",
                            didClose: () => {
                                setTimeout(() => PageLogin() , 110);
                            }
                        })
                    }
            })
        $App.append( $form )
        document.addEventListener("change",(e)=>{
            useState[e.target.name] = e.target.value
        })


        //$App.querySelector("input[name='email']").value=" "

        /* $App.querySelector("#reset_password").addEventListener( "click",function(e){
            configPageConfirm()
        } ) */
        $App.querySelector("#login").addEventListener( "click",function(e){
            PageLogin()
        } )
    }
/* export function configPageConfirm(){
        $App.innerHTML=""
        let $form = entById("artefacto_0006").content
            $form = d.importNode($form,true)

        $App.append( $form )
        //$App.querySelector("input[name='email']").value=" "
        $App.querySelector("#login").addEventListener( "click",function(e){
            PageLogin()
        } )
    } */
