@extends('component.template')

@section('title')
    CMDLT | Patientcare
@endsection
@section('header')
    @include('component.menu_principal')
@endsection
@section('menu_2')
    {{--@include('component.menu_paciente')--}}
@endsection
@section('content')
<div class="content-wrapper">
    <div class="wrapper" style="min-height: calc(100vh - 123px) !important;">
            <div id="content_1" >
                @yield('menu_2')
                <div class="container">
                    <div class="row justify-content-center">

                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div class="p-3 mt-5">
                                <form id="form1" autocomplete="off">
                                    <div class="label-text text-primary text-center h1 mb-3" for="email">Recuperar contraseña</div>

                                    <div class="form-group">
                                        <input name="email" id="email" type="email" placeholder="Escribe tu Correo Electrónico" class="form-control text-center form-control-lg bg-gray-footer-parodi" aria-describedby="helpEmail">
                                        <small id="helpEmail" class="form-text text-muted"></small>
                                    </div>
                                    <button type="submit" class="btn btn-primary form-control-lg btn-block mb-3">Resetear contraseña</button>

                                </form>
                                <form id="form2" class="d-none" autocomplete="off">
                                    <div class="label-text text-primary text-center h1 mb-3" for="email">Cambie su contraseña</div>

                                    <div class="text-center text-secondary d-none">
                                        Por favor, verifique en su correo <b id="email_to_reset"></b> haber recibido un token de reseteo de contraseña y escribelo en el siguiente campo:
                                    </div>
                                    <div class="text-center text-secondary mb-2">
                                        Por favor escriba, y luego confirme, su nueva contraseña.
                                    </div>

                                    <div class="form-group">
                                        <input name="password" id="password" type="password" placeholder="Escribe Nueva contraseña" class="form-control text-center form-control-lg bg-gray-footer-parodi" aria-describedby="helpPassword">
                                        <small id="helpPassword" class="form-text text-muted"></small>
                                    </div>
                                    <div class="form-group">
                                        <input name="password_confirm" id="password_confirm" type="password" placeholder="Confirma Nueva contraseña" class="form-control text-center form-control-lg bg-gray-footer-parodi" aria-describedby="helpPasswordConfirm">
                                        <small id="helpPasswordConfirm" class="form-text text-muted"></small>
                                    </div>

                                    <div class="d-none text-center text-secondary mb-2">
                                        Escriba el código de verificación enviado a: <b class id="sms_email"></b>
                                    </div>

                                    <div class="form-group d-none">
                                        <input name="password_token" id="password_token" type="text" placeholder="Código de verificación" class="form-control text-center form-control-lg" value="" aria-describedby="helpPassword">
                                        <small id="helpPassword" class="form-text text-muted"></small>
                                    </div>

                                    <button type="submit" class="btn btn-success form-control-lg btn-block mb-3">Confirmar cambio de contraseña</button>

                                </form>
                                <a class="btn btn-default bg-secondary btn-block" href="/">Regresar</a>
                                <div id="token_recibido" class="text-center text-white">

                                </div>
                                <script>
                                    var _token = document.getElementById('_token').value;

                                    let useState ={
                                            email:null,
                                            password:null,
                                            password_confirm:null,
                                            password_token:null,
                                            _token,

                                        }
                                        document.addEventListener("change",(e)=>{
                                            useState[e.target.name] = e.target.value
                                            if (e.target.name === "email") {
                                                document.getElementById('email_to_reset').innerHTML= useState[e.target.name]
                                            }
                                        })
                                        document.querySelector("#form2").addEventListener("submit",async (e)=>{
                                            e.preventDefault();
                                            let {password_token,password,password_confirm} = useState;

                                            if (!password_token) {
                                                Toast.fire({
                                                    icon: "warning",
                                                    title: "Atención",
                                                    text: "El campo no puede estar vacio",
                                                    didClose: () => {
                                                        setTimeout(() => document.getElementById("password_token").focus(), 110);
                                                    }
                                                })
                                                return false;
                                            }
                                            if (!password) {
                                                Toast.fire({
                                                    icon: "warning",
                                                    title: "Atención",
                                                    text: "El campo no puede estar vacio",
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
                                                    text: "El campo no puede estar vacio",
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
                                                    text: "Las contraseñas no son iguales",
                                                    didClose: () => {
                                                        setTimeout(() => document.getElementById("password_confirm").focus(), 110);
                                                    }
                                                })
                                                return false;
                                            }
                                            
                                            let formdata = new FormData();
                                                for (let prop in useState){
                                                    formdata.append( prop , useState[prop] )
                                                }
                                            let response = await post("/passwordResetStoreConfirm",formdata)
                                            
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
                                                            setTimeout(() => window.location.href="/", 110);
                                                        }
                                                    })
                                                }
                                        })
                                        document.querySelector("#form1").addEventListener("submit",async (e)=>{
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
                                            let response = await post("/passwordResetStore",formdata)
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
                                                    useState.password_token=response.data.token
                                                    document.querySelector("#password_token").value=response.data.token
                                                    document.querySelector("#password").value=""
                                                    document.querySelector("#token_recibido").innerHTML=response.data.token
                                                }

                                        })
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('component.menu_footer')
@endsection
@section('script')

@endsection
@section('css')

@endsection
