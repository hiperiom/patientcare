<!-- Form Login -->
<template id="artefacto_0001">
    <div class="login-box">
        <div class="swing-in-top-fwd">
            <div class="login-logo">
                <img src="/image/system/patientcare_bw.svg" width="200" height="100" alt="Not Logo System Found">
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <div class="login-box-msg mb-2">
                        <img src="/image/system/logo-cmdlt_color.svg" style="height: 4em;"
                            alt="Not Logo System Found">
                    </div>
                    <section id="verify_user">
                        <h3 class=" text-center">¡Bienvenido!</h3>
                        <div class="text-center mb-2">
                            Autenticate para iniciar sesión
                        </div>

                        <form {{-- action="/initSession" --}} method="post">
                            <input type="hidden" name="user_type_id">
                            <input type="hidden" name="user_centro_salud_id">
                            <div class="input-group mb-3">
                                <input type="text" name="email"
                                    title="Debe ingresar una Cédula Correo Electrónico valido" class="form-control"
                                    placeholder="Escriba cédula o correo">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" title="Debe ingresar una Contraseña valida" name="password"
                                    class="form-control" placeholder="Escriba contraseña">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- captcha -->
                            <div class="row">

                                <div class="col-12">
                                    <a id="submit" href="#" class="btn btn-primary btn-block">Iniciar
                                        Sesión</a>
                                    <button id="sendForm" type="submit"
                                        class="btn d-none btn-primary btn-block">Iniciar
                                        Sesión</button>
                                </div>
                            </div>
                        </form>
                        <p class="my-3">
                            <a id="user_create" href="#" class="text-center btn btn-success btn-block">Registrate
                                como
                                paciente</a>
                        </p>
                        <p class="text-center">
                            <a id="passwordReset" href="#" class="text-secondary font-weight-bold">Recuperar mi
                                contraseña</a>
                        </p>

                    </section>

                </div>
            </div>
            <div class="login-logo">
                <div class="d-flex align-items-center justify-content-center">
                    <div style="font-size: 9px;" class="mr-2 text-white">
            Sistemas<br> 
            De Gestión<br>
            Médica
        </div>
                    <img style="height: 2em;" class="img-fluid my-3" src="https://patientcare.cmdlt.pstelemed.com/image/system/isotipo-cmdlt.svg" alt="Not Logo System Found">
                </div>
            </div>
        </div>
    </div>
</template>
<!-- Form User Create externo -->
<template id="artefacto_0002">
    <form>
        <div class="login-page swing-in-top-fwd">
            <div>
                <img src="/image/system/logo-cmdlt_mono.svg" width="200" height="80"
                    alt="Not Logo System Found">
            </div>

            <div class="container rounded" style="overflow: auto;width: 90vw; background-color: #f5f5f5 !important;">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="login-box-msg my-2">
                            <img src="/image/system/logo-cmdlt_color.svg" style="height: 4em;"
                                alt="Not Logo System Found">

                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="container-fluid">
                            <div class="overlay-wrapper">
                                <div class="overlay d-none"><i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                                    <div class="text-bold text-primary pt-2">Por favor espere...</div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-center text-primary font-weight-bold h3">
                                            Registro o actualización de datos
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="text-primary" for="cedula">Foto</label>
                                        <div class="d-flex items-align-center">
                                            <div class="fileImageInput">
                                                <label class="heartbeat cursor-pointer" for="userImage"
                                                    style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                                    <img id="userImagePreview" style="height:100%;width: inherit;"
                                                        src="/image/system/patient.svg" alt="User Avatar">
                                                </label>
                                                <input id="userImage" type="file" style="display:none"
                                                    accept="image/jpg, jpeg, bmp, png">
                                                <span class="filename"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="text-primary" for="cedula">Documento de identidad <span
                                                    id="cedula_familiar_text" class="text-danger d-none">del
                                                    familiar</span></label>
                                            <table class="w-100">
                                                <tr>
                                                    <td style="width: auto;">
                                                        <select class="form-control"
                                                            title="Seleccione una nacionalidad" name="nacionalidad"
                                                            id="nacionalidad">
                                                            <option value="V">V</option>
                                                            <option value="E">E</option>
                                                            <option value="P">P</option>
                                                            <option value="J">J</option>
                                                        </select>
                                                        <small id="help_nacionalidad" class="notification"></small>
                                                    </td>
                                                    <td>
                                                        <input required title="Un Documento de identidad es requerido"
                                                            type="number" class="form-control"
                                                            name="cedula" id="cedula" aria-describedby="helpId"
                                                            placeholder="">
                                                        <small id="help_cedula" class="notification"></small>
                                                    </td>
                                                </tr>

                                            </table>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-primary" for="email">Correo Electrónico</label>
                                            <input type="text" required title="Un Correo Electrónico es requerido"
                                                name="email" id="email" class="form-control"
                                                aria-describedby="helpEmail">
                                            <small id="help_email" class="notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="text-primary" for="password">Contraseña</label>
                                            <input type="password" required title="Una contraseña es requerida"
                                                name="password" id="password" class="form-control"
                                                aria-describedby="helpPassword">
                                            <small id="help_password" class="notification"></small>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-primary" for="password_repeat">Repite tu
                                                contraseña</label>
                                            <input type="password" title="La confirmación de contraseña es requerida"
                                                required name="password_repeat" id="password_repeat"
                                                class="form-control" aria-describedby="helppassword_repeat">
                                            <small id="help_password_repeat" class="notification"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="text-primary" for="nombre">Nombres</label>
                                            <input type="text" required
                                                title="Tu primer y segundo nombre son requeridos" class="form-control"
                                                name="nombres" id="nombres" aria-describedby="helpId"
                                                placeholder="">
                                            <small id="help_nombres" class="notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="text-primary" for="apellido">Apellidos</label>
                                            <input type="text" title="Tu primer y segundo apellido son requeridos"
                                                required class="form-control" name="apellidos" id="apellidos"
                                                aria-describedby="helpId" placeholder="">
                                            <small id="help_apellidos" class="notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="text-primary" for="genero">Género</label>
                                            <select class="form-control required" name="genero" id="genero"
                                                aria-describedby="helpId" placeholder="">
                                                <option value="m">Masculino</option>
                                                <option value="f">Femenino</option>
                                            </select>
                                            <small id="help_genero" class="notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="text-primary" for="fnacimiento">Fecha de nacimiento</label>
                                            <input type="date" required title="Tu Fecha de nacimiento es requerida"
                                                class="form-control" name="fnacimiento" id="fnacimiento"
                                                aria-describedby="helpId" placeholder="">
                                            <small id="help_fnacimiento" class="notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-primary" for="telefono_movil">Teléfono Contacto</label>
                                            <input type="tel" required
                                                title="Un teléfono de contacto es requerido"
                                                onkeyup="validarPrimerDigito('telefono_movil')" class="form-control"
                                                name="telefono_movil" id="telefono_movil" aria-describedby="helpId"
                                                placeholder="">
                                            <small id="help_telefono_movil" class="notification">(preferiblemente
                                                vinculado a
                                                <i class="text-success">Whatsapp</i>)</small>
                                        </div>
                                    </div>
                                    {{-- <div class="col-6">
                                        <label class="text-primary" for="partidaNacimiento">Partida de nacimiento
                                            (PDF)</label>
                                        <div class="d-flex items-align-center">
                                            <div class="fileImageInput">
                                                <label class="heartbeat cursor-pointer" for="partidaNacimiento"
                                                    style="display:flex; align-items:center;padding: 3%;border:2px dashed rgb(190, 189, 189); height:100px;width:5rem">
                                                    <img onerror="this.src='/image/system/fnacimiento.svg';"
                                                        id="partidaNacimientoPreview"
                                                        style="height:100%;width: inherit;"
                                                        src="/image/system/fnacimiento.svg" alt="User Avatar">
                                                </label>
                                                <input id="partidaNacimiento" type="file" style="display:none"
                                                    accept="application/pdf">
                                                <span class="filename"></span>
                                            </div>
                                            <div id="pn_preview">
                                                <iframe src="" frameborder="0" style="height:100px;overflow:auto;"></iframe>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group box-cat_estado_id">
                                            <label class="text-primary" for="cat_estado_id">Estado</label>
                                            <select required title="Un Estado es requerido"
                                                class="form-control select2" name="cat_estado_id" id="cat_estado_id"
                                                aria-describedby="helpId" placeholder=""></select>
                                            <small id="help_cat_estado_id" class="notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group box-cat_municipio_id">
                                            <label class="text-primary" for="cat_municipio_id">Municipio</label>
                                            <select required title="Un Municipio es requerido"
                                                class="form-control select2" name="cat_municipio_id"
                                                id="cat_municipio_id" aria-describedby="helpId"
                                                placeholder=""></select>
                                            <small id="help_cat_municipio_id" class="notification"></small>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="text-primary" for="description">Ciudad</label>
                                            <input required title="Una Ciudad es requerida" type="text"
                                                class="form-control" name="description" id="description"
                                                aria-describedby="helpId" placeholder="">
                                            <small id="help_description" class="notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="text-primary" for="domicilio">Domicilio</label>
                                            <input required title="Tu domicilio es requerido" class="form-control"
                                                name="domicilio" id="domicilio">
                                            <small id="help_domicilio" class="notification"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-none col-6">
                                        <label class="text-primary" for="cedula">Foto de Tarjeta Soy CMDLT</label>
                                        <div class="d-flex items-align-center">
                                            <div class="fileImageInput">
                                                <label class="heartbeat cursor-pointer" for="imgSoyChacao"
                                                    style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                                    <img id="imgSoyChacaoPreview" style="height:100%;width: inherit;"
                                                        src="/image/system/card.svg" alt="User Avatar">
                                                </label>
                                                <input id="imgSoyChacao" type="file" style="display:none"
                                                    accept="image/jpg, jpeg, bmp, png">
                                                <span class="filename"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="text-primary" for="cedula">Foto de Documento de
                                            Identidad</label>
                                        <div class="d-flex items-align-center">
                                            <div class="fileImageInput">
                                                <label class="heartbeat cursor-pointer" for="imgDocIdentidad"
                                                    style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                                    <img id="imgDocIdentidadPreview"
                                                        style="height:100%;width: inherit;"
                                                        src="/image/system/card.svg" alt="User Avatar">
                                                </label>
                                                <input id="imgDocIdentidad" type="file" style="display:none"
                                                    accept="image/jpg, jpeg, bmp, png">
                                                <span class="filename"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row d-none">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="text-primary" for="tarjeta_soy_chacao">Código Tarjeta Soy
                                                Chacao <i class="text-gray">(Opcional)</i></label>
                                            <input
                                                title="Un código de tarjeta Soy CMDLT es requerido. El código de la tarjeta está en la parte posterior de la misma."
                                                class="form-control border-0" readonly name="tarjeta_soy_chacao">
                                            <small id="help_tarjeta_soy_chacao" class="notification"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group d-flex flex-column align-items-center">
                                        <!-- cactcha -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-2 justify-content-center">
                    <div class="col-4">
                        <a id="login" class="btn btn-default text-primary btn-block" href="#"
                            role="button">Regresar</a>
                    </div>
                    <div class="col-4">
                        <button id="submit" type="submit" class="btn btn-success btn-block">Registrar</button>
                    </div>
                </div>
            </div>
            <div class="login-logo">
                <div class="d-flex align-items-center justify-content-center">
                    <div style="font-size: 9px;" class="mr-2 text-white">
            Sistemas<br> 
            De Gestión<br>
            Médica
        </div>
                    <img style="height: 2em;" class="img-fluid my-3" src="https://patientcare.cmdlt.pstelemed.com/image/system/isotipo-cmdlt.svg" alt="Not Logo System Found">
                </div>
            </div>
        </div>
    </form>
</template>
{{-- <template id="artefacto_0002">
    <form>
        <div class="login-page swing-in-top-fwd">
            <div>
                <img src="/image/system/{{ config('app.APP_LOGO_SYSTEM_MONO') }}" width="200" height="80"
                    alt="Not Logo System Found">
            </div>

            <div class="container rounded" style="overflow: auto;width: 90vw; background-color: #f5f5f5 !important;">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="login-box-msg my-2">
                            <img src="/image/system/logo-cmdlt_color.svg" style="height: 4em;"
                                alt="Not Logo System Found">

                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="container-fluid">
                            <div class="overlay-wrapper">
                                <div class="overlay d-none"><i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                                    <div class="text-bold text-primary pt-2">Por favor espere...</div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-center text-primary font-weight-bold h3">
                                            Registro de Paciente
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-primary" for="tipo_registro">Tipo de registro</label>
                                            <select class="form-control" title="Seleccione un tipo de registro"
                                                name="tipo_registro" id="tipo_registro">
                                                <option value="Personal">Personal</option>
                                                <option value="Familiar">Familiar</option>
                                            </select>
                                            <small id="help_nacionalidad" class="notification"></small>
                                        </div>
                                    </div>
                                    <div id="registro_familiar" class="col-md-12 d-none">
                                        <div class="container-fluid px-0 mx-0">
                                            <div class="col-md-12 px-0">
                                                <div class="form-group">
                                                    <label id="cedula_personal_label" class="text-primary"
                                                        for="cedula">Documento de identidad <span
                                                            class="text-danger">personal</span></label>
                                                    <input required
                                                        title="Un Documento de identidad personal es requerido"
                                                        type="number" maxlength="9" class="form-control"
                                                        name="cedula_personal" id="cedula_personal"
                                                        aria-describedby="helpId" placeholder="">
                                                    <small id="help_cedula_personal" class="notification"></small>
                                                </div>
                                            </div>
                                            <div class="col-md-12 px-0">
                                                <div class="form-group">
                                                    <label class="text-primary"
                                                        for="cat_user_family_id">Seleccione un parentesco con el familiar</label>
                                                    <select required title="Un parentesco con el familiar es requerido"
                                                        class="form-control" name="cat_user_family_id"
                                                        id="cat_user_family_id" aria-describedby="helpId">
                                                        <option value="">Seleccione Parentesco</option>
                                                        <option value="5">Hijo(a)</option>
                                                        <option value="6">Madre</option>
                                                        <option value="7">Padre</option>
                                                        <option value="3">Esposo(a)</option>


                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="text-primary" for="cedula">Foto</label>
                                        <div class="d-flex items-align-center">
                                            <div class="fileImageInput">
                                                <label class="heartbeat cursor-pointer" for="userImage"
                                                    style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                                    <img id="userImagePreview" style="height:100%;width: inherit;"
                                                        src="/image/system/patient.svg" alt="User Avatar">
                                                </label>
                                                <input id="userImage" type="file" style="display:none"
                                                    accept="image/jpg, jpeg, bmp, png">
                                                <span class="filename"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="text-primary" for="cedula">Documento de identidad <span
                                                    id="cedula_familiar_text" class="text-danger d-none">del
                                                    familiar</span></label>
                                            <table class="w-100">
                                                <tr>
                                                    <td style="width: 20%">
                                                        <select class="form-control"
                                                            title="Seleccione una nacionalidad" name="nacionalidad"
                                                            id="nacionalidad">
                                                            <option value="V">V</option>
                                                            <option value="E">E</option>
                                                            <option value="P">P</option>
                                                            <option value="J">J</option>
                                                        </select>
                                                        <small id="help_nacionalidad" class="notification"></small>
                                                    </td>
                                                    <td>
                                                        <input required title="Un Documento de identidad es requerido"
                                                            type="number" maxlength="9" class="form-control"
                                                            name="cedula" id="cedula" aria-describedby="helpId"
                                                            placeholder="">
                                                        <small id="help_cedula" class="notification"></small>
                                                    </td>
                                                    <td id="numero_hijo_td" class="d-none" style="width: 20%">
                                                        <select class="form-control"
                                                            title="Seleccione un número" name="numero_hijo"
                                                            id="numero_hijo">
                                                            <option value="01">1</option>
                                                            <option value="02">2</option>
                                                            <option value="03">3</option>
                                                            <option value="04">4</option>
                                                            <option value="05">5</option>
                                                            <option value="06">6</option>
                                                            <option value="07">7</option>
                                                            <option value="08">8</option>
                                                            <option value="09">9</option>
                                                            <option value="10">10</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <div id="cedula_familiar_info" class="d-none alert alert-info p-1 mt-1" style="font-size: 0.8rem" role="alert">
                                                            Si el hijo es menor de edad,
                                                            vuelva a escribír su cédula personal,
                                                            añada un punto, y seguido escriba un número
                                                            por cada hijo que registre.<br>
                                                            <b style="letter-spacing: 0.08rem;">Ejemplo: 123456.01</b>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-primary" for="email">Correo Electrónico</label>
                                            <input type="text" required title="Un Correo Electrónico es requerido"
                                                name="email" id="email" class="form-control"
                                                aria-describedby="helpEmail">
                                            <small id="help_email" class="notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="text-primary" for="password">Contraseña</label>
                                            <input type="password" required title="Una contraseña es requerida"
                                                name="password" id="password" class="form-control"
                                                aria-describedby="helpPassword">
                                            <small id="help_password" class="notification"></small>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-primary" for="password_repeat">Repite tu
                                                contraseña</label>
                                            <input type="password" title="La confirmación de contraseña es requerida"
                                                required name="password_repeat" id="password_repeat"
                                                class="form-control" aria-describedby="helppassword_repeat">
                                            <small id="help_password_repeat" class="notification"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="text-primary" for="nombre">Nombres</label>
                                            <input type="text" required
                                                title="Tu primer y segundo nombre son requeridos" class="form-control"
                                                name="nombres" id="nombres" aria-describedby="helpId"
                                                placeholder="">
                                            <small id="help_nombres" class="notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="text-primary" for="apellido">Apellidos</label>
                                            <input type="text" title="Tu primer y segundo apellido son requeridos"
                                                required class="form-control" name="apellidos" id="apellidos"
                                                aria-describedby="helpId" placeholder="">
                                            <small id="help_apellidos" class="notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="text-primary" for="genero">Género</label>
                                            <select class="form-control required" name="genero" id="genero"
                                                aria-describedby="helpId" placeholder="">
                                                <option value="m">Masculino</option>
                                                <option value="f">Femenino</option>
                                            </select>
                                            <small id="help_genero" class="notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="text-primary" for="fnacimiento">Fecha de nacimiento</label>
                                            <input type="date" required title="Tu Fecha de nacimiento es requerida"
                                                class="form-control" name="fnacimiento" id="fnacimiento"
                                                aria-describedby="helpId" placeholder="">
                                            <small id="help_fnacimiento" class="notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-primary" for="telefono_movil">Teléfono Contacto</label>
                                            <input type="tel" required
                                                title="Un teléfono de contacto es requerido"
                                                onkeyup="validarPrimerDigito('telefono_movil')" class="form-control"
                                                name="telefono_movil" id="telefono_movil" aria-describedby="helpId"
                                                placeholder="">
                                            <small id="help_telefono_movil" class="notification">(preferiblemente
                                                vinculado a
                                                <i class="text-success">Whatsapp</i>)</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group box-cat_estado_id">
                                            <label class="text-primary" for="cat_estado_id">Estado</label>
                                            <select required title="Un Estado es requerido"
                                                class="form-control select2" name="cat_estado_id" id="cat_estado_id"
                                                aria-describedby="helpId" placeholder=""></select>
                                            <small id="help_cat_estado_id" class="notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group box-cat_municipio_id">
                                            <label class="text-primary" for="cat_municipio_id">Municipio</label>
                                            <select required title="Un Municipio es requerido"
                                                class="form-control select2" name="cat_municipio_id"
                                                id="cat_municipio_id" aria-describedby="helpId"
                                                placeholder=""></select>
                                            <small id="help_cat_municipio_id" class="notification"></small>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="text-primary" for="description">Ciudad</label>
                                            <input required title="Una Ciudad es requerida" type="text"
                                                class="form-control" name="description" id="description"
                                                aria-describedby="helpId" placeholder="">
                                            <small id="help_description" class="notification"></small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="text-primary" for="domicilio">Domicilio</label>
                                            <input required title="Tu domicilio es requerido" class="form-control"
                                                name="domicilio" id="domicilio">
                                            <small id="help_domicilio" class="notification"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="text-primary" for="cedula">Foto de Tarjeta Soy CMDLT</label>
                                        <div class="d-flex items-align-center">
                                            <div class="fileImageInput">
                                                <label class="heartbeat cursor-pointer" for="imgSoyChacao"
                                                    style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                                    <img id="imgSoyChacaoPreview" style="height:100%;width: inherit;"
                                                        src="/image/system/card.svg" alt="User Avatar">
                                                </label>
                                                <input id="imgSoyChacao" type="file" style="display:none"
                                                    accept="image/jpg, jpeg, bmp, png">
                                                <span class="filename"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="text-primary" for="cedula">Foto de Documento de
                                            Identidad</label>
                                        <div class="d-flex items-align-center">
                                            <div class="fileImageInput">
                                                <label class="heartbeat cursor-pointer" for="imgDocIdentidad"
                                                    style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                                    <img id="imgDocIdentidadPreview"
                                                        style="height:100%;width: inherit;"
                                                        src="/image/system/card.svg" alt="User Avatar">
                                                </label>
                                                <input id="imgDocIdentidad" type="file" style="display:none"
                                                    accept="image/jpg, jpeg, bmp, png">
                                                <span class="filename"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="text-primary" for="tarjeta_soy_chacao">Código Tarjeta Soy
                                                Chacao <i class="text-gray">(Si tiene la tarjeta)</i></label>
                                            <input required
                                                title="El código de la tarjeta está en la parte posterior de la misma."
                                                class="form-control" name="tarjeta_soy_chacao">
                                            <small id="help_tarjeta_soy_chacao" class="notification"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group d-flex flex-column align-items-center">
                                        <!-- cactcha -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-2 justify-content-center">
                    <div class="col-4">
                        <a id="login" class="btn btn-default text-primary btn-block" href="#"
                            role="button">Regresar</a>
                    </div>
                    <div class="col-4">
                        <button id="submit" type="submit" class="btn btn-success btn-block">Registrar</button>
                    </div>
                </div>
            </div>
            <div class="login-logo">
                <div class="d-flex align-items-center justify-content-center">
        <img style="height: 3em;" class="img-fluid my-3" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo_sistemas_gestion_medica_blanco.svg" alt="Not Logo System Found">
    </div>
            </div>
        </div>
    </form>
</template> --}}
<!-- Form Patient Search -->
<template id="artefacto_0003">
    <section class="content h-100 d-flex align-items-center">
        <div class="container-fluid">
            <h2 class="text-center text-primary display-4">
                <img src="/image/system/logo-cmdlt_color.svg" style="height: 1em;"
                    alt="Not Logo System Found">
                <br>
                Buscar paciente
            </h2>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form>
                        <div class="input-group">
                            <input type="search" class="form-control text-center form-control-lg"
                                placeholder="Escribe una cédula">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search text-primary"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
<!-- Loading Animation -->
<template id="artefacto_0004">
    <div class="loading-box">
        <div id="loading_box" class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="w-100 d-flex  justify-content-center align-items-center">
                        <img class="shake-lr" style="height:5em;"
                            src="/image/system/logo-cmdlt_color.svg" alt="Logo Not Found">
                    </div>
                    <div class="d-flex m-4 justify-content-center text-white">
                        <span>
                            Espere un momento por favor...
                        </span>
                        <div class="spinner-border" role="status">
                            <span class="sr-only"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<!-- Form Password Reset and Recovery -->
<template id="artefacto_0005">
    <div class="login-box swing-in-top-fwd">
        <div class="login-logo">
            <img src="/image/system/patientcare_bw.svg" width="200" height="100" alt="Not Logo System Found">
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <div class="login-box-msg mb-2">
                    <img src="/image/system/logo-cmdlt_color.svg" style="height: 4em;"
                        alt="Not Logo System Found">
                </div>
                <section>



                    <form id="form1" autocomplete="off">
                        <h3 class=" text-center">Recuperar contraseña</h3>
                        <div class="input-group mb-3">
                            <input type="email" name="email" title="Debe ingresar un Correo Electrónico valido"
                                class="form-control" placeholder="Escribe tu Correo Electrónico">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        <p class="my-3">
                            <a id="btn_form1" href="#" class="text-center btn btn-primary btn-block">Resetear
                                contraseña</a>
                        </p>


                    </form>
                    <form id="form2" class="d-none" autocomplete="off">
                        <h3 class=" text-center">Cambie su contraseña</h3>

                        <div class="text-center text-secondary">
                            Por favor, verifique en su correo <b id="email_to_reset"></b> haber recibido un token de
                            reseteo de contraseña, y escribelo en el campo <b>Código de verificación</b>.
                        </div>
                        <div class="text-center text-secondary mb-2">
                            Por favor escriba, y luego confirme, su nueva contraseña.
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" id="password" title="Debe ingresar una Contraseña valida"
                                name="password" class="form-control" placeholder="Escribe Nueva contraseña">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" id="password_confirm" title="Debe ingresar una Contraseña valida"
                                name="password_confirm" class="form-control" placeholder="Confirma Nueva contraseña">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>



                        <div class="text-center text-secondary mb-2">
                            Escriba el código de verificación enviado a: <b class id="sms_email"></b>
                        </div>
                        <div class="form-group">
                            <input name="password_token" id="password_token" type="text"
                                placeholder="Código de verificación" class="form-control text-center form-control-lg"
                                value="" aria-describedby="helpPassword">
                            <small id="helpPassword" class="form-text text-muted"></small>
                        </div>

                        <p class="my-3">
                            <a id="btn_form2" href="#" class="text-center btn btn-success btn-block">Confirmar
                                cambio
                                de contraseña</a>
                        </p>
                    </form>
                    <div id="token_recibido" class="text-center text-white">

                    </div>
                    <p class="my-3 text-center">
                        <a id="login" href="#" class="text-secondary font-weight-bold">Regresar</a>
                    </p>

                </section>
            </div>
        </div>
        <div class="login-logo">
            <div class="d-flex align-items-center justify-content-center">
                <div style="font-size: 9px;" class="mr-2 text-white">
            Sistemas<br> 
            De Gestión<br>
            Médica
        </div>
                <img style="height: 2em;" class="img-fluid my-3" src="https://patientcare.cmdlt.pstelemed.com/image/system/isotipo-cmdlt.svg" alt="Not Logo System Found">
            </div>
        </div>
    </div>
</template>
<!-- Form User Type (Rol) -->
<template id="artefacto_0006">
    <div class="login-box">
        <div>
            <div class="login-logo">
                <img src="/image/system/patientcare_bw.svg" width="200" height="100"
                    alt="Not Logo System Found">
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <div class="login-box-msg mb-2">
                        <img src="/image/system/logo-cmdlt_color.svg" style="height: 4em;"
                            alt="Not Logo System Found">
                    </div>
                    <section>
                        <h5 class=" text-center text-primary font-weight-bold"> Iniciar como:</h5>
                        <div id="user_type" class="container-fluid overflow-auto" style="height:40vh;">
                            <div class="row mb-3 btn-default cursor-pointer align-items-center" style="opacity: 0.1;"
                                data-cat_user_type_id="1">
                                <div class="col-3 text-center">
                                    <i class="pc-paciente h1 text-success"></i>

                                </div>
                                <div class="col-9">
                                    <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">Paciente
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 btn-default cursor-pointer align-items-center" style="opacity: 0.1;"
                                data-cat_user_type_id="2">
                                <div class="col-3 text-center">
                                    <i class="pc-medico h1 text-primary"></i>
                                </div>
                                <div class="col-9">
                                    <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">Médico</div>
                                </div>
                            </div>
                            <div class="row mb-3 btn-default cursor-pointer align-items-center" style="opacity:0.1"
                                data-cat_user_type_id="6">
                                <div class="col-3 text-center">
                                    <i class="pc-enfermeria h1 text-orange"></i>

                                </div>
                                <div class="col-9">
                                    <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">Enfermería
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 btn-default cursor-pointer align-items-center" style="opacity:0.1"
                                data-cat_user_type_id="7">
                                <div class="col-3 text-center">
                                    <i class="pc-atencion_al_paciente h1 text-warning"></i>
                                </div>
                                <div class="col-9">
                                    <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">Atención al
                                        Paciente</div>
                                </div>
                            </div>
                            <div class="row mb-3 btn-default cursor-pointer align-items-center" style="opacity:0.1"
                                data-cat_user_type_id="4">
                                <div class="col-3 text-center">
                                    <i class="pc-administrador h1 text-secondary"></i>
                                </div>
                                <div class="col-9">
                                    <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">Administrador
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 btn-default cursor-pointer align-items-center" style="opacity:0.1"
                                data-cat_user_type_id="9">
                                <div class="col-3 text-center">
                                    <i class="pc-reportes h1 text-purple"></i>
                                </div>
                                <div class="col-9">
                                    <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">Reportes
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div id="user_type" class="container-fluid overflow-auto" style="height:40vh;">
                        @foreach ($cat_user_type as $item)
                            <div class="row mb-1 btn-default cursor-pointer align-items-center" style="opacity:0.1" data-cat_user_type_id="{{ $item->id }}">
                                <div class="col-3 text-center">
                                    <img src="/image/system/{{ $item->imagen }}" style="height:4em" alt="Image Not Found">
                                </div>
                                <div class="col-9">
                                    <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">{{ $item->description }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div> --}}
                    </section>
                    <div id="regresar" class="btn btn-outline-primary btn-block">Regresar</div>
                </div>
            </div>
            <div class="login-logo">
                <div class="d-flex align-items-center justify-content-center">
                    <div style="font-size: 9px;" class="mr-2 text-white">
            Sistemas<br> 
            De Gestión<br>
            Médica
        </div>
                    <img style="height: 2em;" class="img-fluid my-3" src="https://patientcare.cmdlt.pstelemed.com/image/system/isotipo-cmdlt.svg" alt="Not Logo System Found">
                </div>
            </div>
        </div>
    </div>
</template>
<!-- Form Area a atenter -->
<template id="artefacto_0008">
    <div class="login-box">
        <div>
            <div class="login-logo">
                <img src="/image/system/patientcare_bw.svg" width="200" height="100"
                    alt="Not Logo System Found">
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <div class="login-box-msg mb-2">
                        <img src="/image/system/logo-cmdlt_color.svg" style="height: 4em;"
                            alt="Not Logo System Found">
                    </div>
                    <section>
                        <h5 class=" text-center text-primary font-weight-bold"> Área a atender:</h5>
                        <div id="user_type" class="container-fluid overflow-auto" style="height:40vh;">

                            <div class="row mb-1 btn-default cursor-pointer align-items-center" style="opacity:0.1"
                                data-area_atencion="1" data-route="/medico/cita/tablero">
                                <div class="col-3 text-center">
                                    <span class="pc-solid_estetoscopio text-primary"
                                        style="font-size: 3em;margin: 10%;"></span>
                                </div>
                                <div class="col-9">
                                    <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">Consulta
                                        Externa</div>
                                </div>
                            </div>
                            <div class="row mb-1 btn-default cursor-pointer align-items-center" style="opacity:0.1"
                                data-area_atencion="2" data-route="/medico">
                                <div class="col-3 text-center">
                                    <span class="pc-light-emergency text-primary"
                                        style="font-size: 3em;margin: 10%;"></span>
                                </div>
                                <div class="col-9">
                                    <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">Emergencia
                                    </div>
                                </div>
                            </div>
                            @if (config('app.APP_GRUPO_CENTRO_SALUD_ID') == 1)
                                <div class="row mb-1 btn-default cursor-pointer align-items-center"
                                    style="opacity:0.1" data-area_atencion="2" data-route="/medico">
                                    <div class="col-3 text-center">
                                        <span class="pc-light-pisos text-primary"
                                            style="font-size: 3em;margin: 10%;"></span>
                                    </div>
                                    <div class="col-9">
                                        <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">
                                            Hospitalización</div>
                                    </div>
                                </div>
                                <div class="row mb-1 btn-default cursor-pointer align-items-center"
                                    style="opacity:0.1" data-area_atencion="2" data-route="/medico">
                                    <div class="col-3 text-center">
                                        <span class="pc-light-uti text-primary"
                                            style="font-size: 3em;margin: 10%;"></span>
                                    </div>
                                    <div class="col-9">
                                        <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">Uti</div>
                                    </div>
                                </div>
                                <div class="row mb-1 btn-default cursor-pointer align-items-center"
                                    style="opacity:0.1" data-area_atencion="2" data-route="/medico">
                                    <div class="col-3 text-center">
                                        <span class="pc-light-homecare text-primary"
                                            style="font-size: 3em;margin: 10%;"></span>
                                    </div>
                                    <div class="col-9">
                                        <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">Pad</div>
                                    </div>
                                </div>
                            @endif


                        </div>
                    </section>
                    <div id="regresar" class="btn btn-outline-primary btn-block">Regresar</div>
                </div>
            </div>
            <div class="login-logo">
                <div class="d-flex align-items-center justify-content-center">
                    <div style="font-size: 9px;" class="mr-2 text-white">
            Sistemas<br> 
            De Gestión<br>
            Médica
        </div>
                    <img style="height: 2em;" class="img-fluid my-3" src="https://patientcare.cmdlt.pstelemed.com/image/system/isotipo-cmdlt.svg" alt="Not Logo System Found">
                </div>
            </div>
        </div>
    </div>
</template>
<!-- Form User Centro Salud -->
<template id="artefacto_0007">
    <div class="login-box">
        <div>
            <div class="login-logo">
                <img src="/image/system/patientcare_bw.svg" width="200" height="100"
                    alt="Not Logo System Found">
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <div class="login-box-msg mb-2">
                        <img src="/image/system/logo-cmdlt_color.svg" style="height: 4em;"
                            alt="Not Logo System Found">
                    </div>
                    <section>
                        <h5 class=" text-center text-primary font-weight-bold">Seleccione Centro de Salud:</h5>

                        <div class="container-fluid overflow-auto shadow-sm mb-1" style="height:40vh;">
                            <!-- 2 -->
                            <div class="row d-none  mb-1 btn-default cursor-pointer align-items-center"
                                style="opacity:0.1;" data-cat_area_atencion_id="1" data-cat_grupo_centro_salud_id="2"
                                data-cat_centro_salud_id="2">
                                <div class="col-3 text-center">
                                    <img src="/image/system/ambulatorio.svg" alt="">

                                    <div
                                        class="d-flex w-100  border border-gray text-white rounded-pill justify-content-around">
                                        <div>
                                            <span data-tippy-content="Consulta Externa"
                                                class="tooltip-success text-success pc-solid_estetoscopio"
                                                style="font-size: 1em;margin: 10%;"></span>
                                        </div>
                                        <div>
                                            <span data-tippy-content="Emergencia"
                                                class="tooltip-gray text-gray  pc-light-emergency"
                                                style="font-size: 1em;margin: 10%;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">
                                        Centro de Especialidades los Palos Grande (CELPG)

                                    </div>
                                </div>
                            </div>
                            <!-- 3 -->
                            <div class="row d-none  mb-1 btn-default cursor-pointer align-items-center"
                                style="opacity:0.1" data-cat_area_atencion_id="1" data-cat_grupo_centro_salud_id="2"
                                data-cat_centro_salud_id="3">
                                <div class="col-3 text-center">
                                    <img src="/image/system/ambulatorio.svg" alt="">

                                    <div
                                        class="d-flex w-100  border border-gray text-white rounded-pill justify-content-around">
                                        <div>
                                            <span data-tippy-content="Consulta Externa"
                                                class="tooltip-success text-success pc-solid_estetoscopio"
                                                style="font-size: 1em;margin: 10%;"></span>
                                        </div>
                                        <div>
                                            <span data-tippy-content="Emergencia"
                                                class="tooltip-gray text-gray  pc-light-emergency"
                                                style="font-size: 1em;margin: 10%;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">
                                        Altamira

                                    </div>
                                </div>
                            </div>
                            <!-- 4 -->
                            <div class="row d-none  mb-1 btn-default cursor-pointer align-items-center"
                                style="opacity:0.1;" data-cat_area_atencion_id="1" data-cat_grupo_centro_salud_id="2"
                                data-cat_centro_salud_id="4">
                                <div class="col-3 text-center">
                                    <img src="/image/system/ambulatorio.svg" alt="">

                                    <div
                                        class="d-flex w-100  border border-gray text-white rounded-pill justify-content-around">
                                        <div>
                                            <span data-tippy-content="Consulta Externa"
                                                class="tooltip-success text-success pc-solid_estetoscopio"
                                                style="font-size: 1em;margin: 10%;"></span>
                                        </div>
                                        <div>
                                            <span data-tippy-content="Emergencia"
                                                class="tooltip-success text-gray  pc-light-emergency"
                                                style="font-size: 1em;margin: 10%;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">
                                        CEQ Viseteca

                                    </div>
                                </div>
                            </div>
                            <!-- 5 -->
                            <div class="row d-none  mb-1 btn-default cursor-pointer align-items-center"
                                style="opacity:0.1" data-cat_area_atencion_id="1" data-cat_grupo_centro_salud_id="2"
                                data-cat_centro_salud_id="5">
                                <div class="col-3 text-center">
                                    <img src="/image/system/ambulatorio.svg" alt="">
                                    {{-- <span class="pc-light-hospital text-primary"
                                        style="font-size: 3em;margin: 10%;"></span> --}}
                                    <div
                                        class="d-flex w-100  border border-gray text-white rounded-pill justify-content-around">
                                        <div>
                                            <span data-tippy-content="Consulta Externa"
                                                class="tooltip-success text-success pc-solid_estetoscopio"
                                                style="font-size: 1em;margin: 10%;"></span>
                                        </div>
                                        <div>
                                            <span data-tippy-content="Emergencia"
                                                class="tooltip-gray text-gray  pc-light-emergency"
                                                style="font-size: 1em;margin: 10%;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">
                                        Bello Campo

                                    </div>
                                </div>
                            </div>
                            <!-- 6 -->
                            <div class="row d-none  mb-1 btn-default cursor-pointer align-items-center"
                                style="opacity:0.1" data-cat_area_atencion_id="1" data-cat_grupo_centro_salud_id="2"
                                data-cat_centro_salud_id="6">
                                <div class="col-3 text-center">
                                    <img src="/image/system/ambulatorio.svg" alt="">

                                    <div
                                        class="d-flex w-100  border border-gray text-white rounded-pill justify-content-around">
                                        <div>
                                            <span data-tippy-content="Consulta Externa"
                                                class="tooltip-success text-success pc-solid_estetoscopio"
                                                style="font-size: 1em;margin: 10%;"></span>
                                        </div>
                                        <div>
                                            <span data-tippy-content="Emergencia"
                                                class="tooltip-gray text-gray  pc-light-emergency"
                                                style="font-size: 1em;margin: 10%;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">
                                        El bosque

                                    </div>
                                </div>
                            </div>
                            <!-- 7 -->
                            <div class="row d-none  mb-1 btn-default cursor-pointer align-items-center"
                                style="opacity:0.1" data-cat_area_atencion_id="1" data-cat_grupo_centro_salud_id="2"
                                data-cat_centro_salud_id="7">
                                <div class="col-3 text-center">
                                    <img src="/image/system/ambulatorio.svg" alt="">

                                    <div
                                        class="d-flex w-100  border border-gray text-white rounded-pill justify-content-around">
                                        <div>
                                            <span data-tippy-content="Consulta Externa"
                                                class="tooltip-success text-success pc-solid_estetoscopio"
                                                style="font-size: 1em;margin: 10%;"></span>
                                        </div>
                                        <div>
                                            <span data-tippy-content="Emergencia"
                                                class="tooltip-gray text-gray  pc-light-emergency"
                                                style="font-size: 1em;margin: 10%;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">
                                        El Pedregal

                                    </div>
                                </div>
                            </div>
                            <!-- 8 -->
                            <div class="row d-none mb-1 btn-default cursor-pointer align-items-center"
                                style="opacity:0.1" data-cat_area_atencion_id="1" data-cat_grupo_centro_salud_id="2"
                                data-cat_centro_salud_id="8">
                                <div class="col-3 text-center">
                                    <img src="/image/system/ambulatorio.svg" alt="">

                                    <div
                                        class="d-flex w-100  border border-gray text-white rounded-pill justify-content-around">
                                        <div>
                                            <span data-tippy-content="Consulta Externa"
                                                class="tooltip-success  text-success pc-solid_estetoscopio"
                                                style="font-size: 1em;margin: 10%;"></span>
                                        </div>
                                        <div>
                                            <span data-tippy-content="Emergencia"
                                                class="tooltip-gray text-gray  pc-light-emergency"
                                                style="font-size: 1em;margin: 10%;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">
                                        Bucaral

                                    </div>
                                </div>
                            </div>
                            <!-- 11 -->
                            <div class="row d-none  mb-1 btn-default cursor-pointer align-items-center"
                                style="opacity:0.1" data-cat_area_atencion_id="1" data-cat_grupo_centro_salud_id="2"
                                data-cat_centro_salud_id="11">
                                <div class="col-3 text-center">
                                    <img src="/image/system/ambulatorio.svg" alt="">

                                    <div
                                        class="d-flex w-100  border border-gray text-white rounded-pill justify-content-around">
                                        <div>
                                            <span data-tippy-content="Consulta Externa"
                                                class="tooltip-success text-success pc-solid_estetoscopio"
                                                style="font-size: 1em;margin: 10%;"></span>
                                        </div>
                                        <div>
                                            <span data-tippy-content="Emergencia"
                                                class="tooltip-gray text-gray  pc-light-emergency"
                                                style="font-size: 1em;margin: 10%;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">
                                        Centro de Atención Integral a la Comunidad

                                    </div>
                                </div>
                            </div>
                            <!-- 13 -->
                            <div class="row d-none  mb-1 btn-default cursor-pointer align-items-center"
                                style="opacity:0.1" data-cat_area_atencion_id="1" data-cat_grupo_centro_salud_id="2"
                                data-cat_centro_salud_id="13">
                                <div class="col-3 text-center">
                                    <img src="/image/system/ambulatorio.svg" alt="">

                                    <div
                                        class="d-flex w-100  border border-gray text-white rounded-pill justify-content-around">
                                        <div>
                                            <span data-tippy-content="Consulta Externa"
                                                class="tooltip-success text-success pc-solid_estetoscopio"
                                                style="font-size: 1em;margin: 10%;"></span>
                                        </div>
                                        <div>
                                            <span data-tippy-content="Emergencia"
                                                class="tooltip-gray text-gray  pc-light-emergency"
                                                style="font-size: 1em;margin: 10%;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">
                                        Chacao

                                    </div>
                                </div>
                            </div>

                            <!-- 10 EMERGENCIA SALUD CHACAO -->
                            <div class="row d-none  mb-1 btn-default cursor-pointer align-items-center"
                                style="opacity: 0.1;" data-cat_area_atencion_id="2"
                                data-cat_grupo_centro_salud_id="2" data-cat_centro_salud_id="10">
                                <div class="col-3 text-center">
                                    <img src="/image/system/emergencia.svg" alt="">
                                    {{-- <span class="pc-light-hospital text-primary" style="font-size: 3em;margin: 10%;"></span> --}}
                                    <div
                                        class="d-flex w-100  border border-gray text-white rounded-pill justify-content-around">
                                        <div>
                                            <span data-tippy-content="Consulta Externa"
                                                class="tooltip-gray  text-gray pc-solid_estetoscopio"
                                                style="font-size: 1em;margin: 10%;"></span>
                                        </div>
                                        <div>
                                            <span data-tippy-content="Emergencia"
                                                class="tooltip-success  text-success  pc-light-emergency"
                                                style="font-size: 1em;margin: 10%;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-secondary px-1 text-item" style="font-size: 1.5rem">
                                        Emergencia CMDLT
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div id="regresar" class="btn btn-outline-primary btn-block">Regresar</div>
                </div>
            </div>
            <div class="login-logo">
                <div class="d-flex align-items-center justify-content-center">
                    <div style="font-size: 9px;" class="mr-2 text-white">
            Sistemas<br> 
            De Gestión<br>
            Médica
        </div>
                    <img style="height: 2em;" class="img-fluid my-3" src="https://patientcare.cmdlt.pstelemed.com/image/system/isotipo-cmdlt.svg" alt="Not Logo System Found">
                </div>
            </div>
        </div>
    </div>
</template>
<!-- model-modal recipes -->
<template id="artefacto_0009">
    <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
    <div class="row pt-6" style=" margin-top: 7.5rem !important;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h1 id="title_modal" class="text-primary">
                Récipe
            </h1>
        </div>
    </div>
    <ul class="nav nav-pills d-none mb-3 justify-content-end" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-page1-tab" data-toggle="pill" href="#pills-page1" role="tab"
                aria-controls="pills-page1" aria-selected="true">

            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link h3" id="pills-page2-tab" data-toggle="pill" href="#pills-page2" role="tab"
                aria-controls="pills-page2" aria-selected="false">
                Nuevo Récipe
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        </li>

    </ul>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-page1" role="tabpanel" aria-labelledby="pills-page1-tab">
            <a id="item_create" class="h3 cursor-pointer float-right text-primary">
                Añadir Medicamento
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
            <table class="table table-bordered mb-3">
                <thead>
                    <tr>
                        <th class="text-primary text-center">Fecha</th>
                        <th class="text-primary text-center">Récipe</th>
                        <th class="text-primary text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <a id="regresar" class="btn bg-primary text-primary btn-block btn-lg" data-dismiss="modal"
                            aria-label="Close">Regresar</a>
                    </div>
                    <div class="col-6">
                        <div>
                            <div class="dropdown mr-1">
                                <button title="Imprimir Documento"
                                    class="btn btn-success btn-block btn-lg dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu pb-0  animate fade-down"
                                    aria-labelledby="dropdownMenuButton">
                                    <h3 class="dropdown-header text-primary"><b>Enviar por:</b></h3>

                                    <ul class="navbar-nav ms-auto">

                                        <li class="nav-item dropdown">
                                            <ul class="dropdown-menu dropdown-menu-right show" data-bs-popper="none">
                                                <li>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="fas fa-envelope text-primary"></i> Correo » </a>
                                                    <ul class="submenu submenu-left dropdown-menu">
                                                        <li style="display:none"><a id="email_recipe_color" class="dropdown-item"
                                                                href="#">Color</a></li>
                                                        <li><a id="email_recipe_bw" class="dropdown-item"
                                                                href="">Blanco y negro</a></li>

                                                    </ul>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="fab fa-whatsapp text-success"></i> Whatsapp » </a>
                                                    <ul class="submenu submenu-left dropdown-menu">
                                                        <li style="display:none"><a id="whatsapp_recipe_color" class="dropdown-item"
                                                                href="#">Color</a></li>
                                                        <li><a id="whatsapp_recipe_bw" class="dropdown-item"
                                                                href="">Blanco y negro</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="fas fa-file-pdf text-danger"></i> Imprimir PDF »
                                                    </a>
                                                    <ul class="submenu submenu-left dropdown-menu">
                                                        <li style="display:none"><a id="imprimir_recipe_color" class="dropdown-item"
                                                                href="#">Color</a></li>
                                                        <li><a id="imprimir_recipe_bw" class="dropdown-item"
                                                                href="">Blanco y negro</a></li>
                                                    </ul>
                                                </li>

                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-page2" role="tabpanel" aria-labelledby="pills-page2-tab">
            <form>
                <div class="container-fluid">
                    <div id="form" class="row">
                        <div class="col-12 col-sm-4">
                            <input title="Ingrese el nombre de un medicamento" type="text"
                                class="form-control form-control-lg bg-gray-footer-parodi" name="value"
                                aria-describedby="helpId1" placeholder="Medicamento">
                            <small id="helpId1" class="form-text text-muted notification"></small>
                        </div>
                        <div class="col-12 col-sm-4">
                            <input title="Ingrese una presentación del medicamento" type="text"
                                class="form-control form-control-lg bg-gray-footer-parodi" name="value2"
                                aria-describedby="helpId2" placeholder="Presentación">
                            <small id="helpId2" class="form-text text-muted notification"></small>
                        </div>
                        <div class="col-12 col-sm-4">
                            <input title="Ingrese una cantidad del medicamento" type="text"
                                class="form-control form-control-lg bg-gray-footer-parodi" name="value4"
                                aria-describedby="helpId4" placeholder="Cantidad">
                            <small id="helpId4" class="form-text text-muted notification"></small>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <textarea title="Ingrese las indicaciones del medicamento"
                                class="form-control form-control-lg bg-gray-footer-parodi mb-3" name="value3" rows="2"
                                placeholder="Indicaciones"></textarea>
                            <small id="helpId2" class="form-text text-muted notification"></small>
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <button id="regresar2" class="btn btn-primary btn-block btn-lg">Regresar</button>
                        </div>
                        <div class="col-6">
                            <button id="submit_update"
                                class="d-none m-0 btn btn-success btn-block btn-lg">Actualizar</button>
                            <button id="submit_store"
                                class="d-none m-0 btn btn-success btn-block btn-lg">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


</template>
<!-- Form User Create interno -->
<template id="artefacto_0010">

        <div class="container-fluid rounded">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="login-box-msg my-2">
                        <img src="/image/system/logo-cmdlt_color.svg" style="height: 4em;"
                            alt="Not Logo System Found">
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center text-primary font-weight-bold h3">
                                    Registro de Paciente
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label class="text-primary" for="cedula">Foto</label>
                                <div class="d-flex items-align-center">
                                    <div class="fileImageInput">
                                        <label class="heartbeat cursor-pointer" for="userImage"
                                            style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                            <img id="userImagePreview" onerror="reemplaza_imagen(this)"
                                                style="height:100%;width: inherit;" src="/image/system/patient.svg"
                                                alt="User Avatar">
                                        </label>
                                        <input id="userImage" type="file" style="display:none"
                                            accept="image/jpg, jpeg, bmp, png">
                                        <span class="filename"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="d-flex align-items-end h-100">
                                    <div class="form-group flex-fill mb-1">
                                        <label class="text-primary" for="cedula">Documento de identidad</label>
                                        <table class="w-100">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 30%">
                                                        <select class="form-control"
                                                            title="Seleccione una nacionalidad" name="nacionalidad"
                                                            id="nacionalidad">
                                                            <option value="V">V</option>
                                                            <option value="E">E</option>
                                                            <option value="P">P</option>
                                                            <option value="J">J</option>
                                                        </select>
                                                        <small id="help_nacionalidad" class="notification"></small>
                                                    </td>
                                                    <td>
                                                        <input required=""
                                                            title="Un Documento de identidad es requerido"
                                                            type="number" class="form-control"
                                                            name="cedula" id="cedula"
                                                            aria-describedby="helpId" placeholder="">
                                                        <small id="help_cedula" class="notification"></small>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="d-flex align-items-end h-100">
                                    <div class="form-group flex-fill mb-1">
                                        <label class="text-primary" for="email">Correo Electrónico</label>
                                        <input type="text" required title="Un Correo Electrónico es requerido"
                                            name="email" id="email" class="form-control"
                                            aria-describedby="helpEmail">
                                        <small id="help_email" class="notification"></small>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-primary" for="nombre">Nombres</label>
                                    <input type="text" required title="Tu primer y segundo nombre son requeridos"
                                        class="form-control" name="nombres" id="nombres"
                                        aria-describedby="helpId" placeholder="">
                                    <small id="help_nombres" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-primary" for="apellido">Apellidos</label>
                                    <input type="text" title="Tu primer y segundo apellido son requeridos"
                                        required class="form-control" name="apellidos" id="apellidos"
                                        aria-describedby="helpId" placeholder="">
                                    <small id="help_apellidos" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-primary" for="genero">Género</label>
                                    <select class="form-control required" name="genero" id="genero"
                                        aria-describedby="helpId" placeholder="">
                                        <option value="m">Masculino</option>
                                        <option value="f">Femenino</option>
                                    </select>
                                    <small id="help_genero" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-primary" for="fnacimiento">Fecha de nacimiento</label>
                                    <input type="date" required title="Tu Fecha de nacimiento es requerida"
                                        class="form-control" name="fnacimiento" id="fnacimiento"
                                        aria-describedby="helpId" placeholder="">
                                    <small id="help_fnacimiento" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-primary" for="telefono_movil">Teléfono Contacto</label>
                                    <input type="tel" required title="Un teléfono de contacto es requerido"
                                        onkeyup="validarPrimerDigito('telefono_movil')" class="form-control"
                                        name="telefono_movil" id="telefono_movil" aria-describedby="helpId"
                                        placeholder="">
                                    <small id="help_telefono_movil" class="notification">(preferiblemente vinculado
                                        a
                                        <i class="text-success">Whatsapp</i>)</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group box-cat_estado_id">
                                    <label class="text-primary" for="cat_estado_id">Estado</label><br>
                                    <select required title="Un Estado es requerido" class="form-control select2"
                                        name="cat_estado_id" id="cat_estado_id" aria-describedby="helpId"
                                        placeholder=""></select>
                                    <small id="help_cat_estado_id" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group box-cat_municipio_id">
                                    <label class="text-primary" for="cat_municipio_id">Municipio</label><br>
                                    <select required title="Un Municipio es requerido" class="form-control select2"
                                        name="cat_municipio_id" id="cat_municipio_id" aria-describedby="helpId"
                                        placeholder=""></select>
                                    <small id="help_cat_municipio_id" class="notification"></small>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-primary" for="description">Ciudad</label>
                                    <input required title="Una Ciudad es requerida" type="text"
                                        class="form-control" name="description" id="description"
                                        aria-describedby="helpId" placeholder="">
                                    <small id="help_description" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-primary" for="domicilio">Domicilio</label>
                                    <input required title="Tu domicilio es requerido" class="form-control"
                                        name="domicilio" id="domicilio">
                                    <small id="help_domicilio" class="notification"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-none col-6">
                                <label class="text-primary" for="cedula">Foto de Tarjeta Soy CMDLT</label>
                                <div class="d-flex items-align-center">
                                    <div class="fileImageInput">
                                        <label class="heartbeat cursor-pointer" for="imgSoyChacao"
                                            style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                            <img id="imgSoyChacaoPreview"
                                                onerror="this.src='/image/system/card.svg'"
                                                style="height:100%;width: inherit;" src="/image/system/card.svg"
                                                alt="User Avatar">
                                        </label>
                                        <input id="imgSoyChacao" disabled type="file" style="display:none"
                                            accept="image/jpg, jpeg, bmp, png">
                                        <span class="filename"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="text-primary" for="cedula">Foto de Documento de Identidad</label>
                                <div class="d-flex items-align-center">
                                    <div class="fileImageInput">
                                        <label class="heartbeat cursor-pointer" for="imgDocIdentidad"
                                            style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                            <img id="imgDocIdentidadPreview"
                                                onerror="this.src='/image/system/card.svg'"
                                                style="height:100%;width: inherit;" src="/image/system/card.svg"
                                                alt="User Avatar">
                                        </label>
                                        <input id="imgDocIdentidad" type="file" style="display:none"
                                            accept="image/jpg, jpeg, bmp, png">
                                        <span class="filename"></span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            {{-- <div class="col-6">
                                <div class="form-group">
                                    <label class="text-primary" for="tarjeta_soy_chacao">Código Tarjeta Soy CMDLT
                                        <i class="text-gray">(Si tiene la tarjeta)</i></label>
                                    <input required
                                        title="El código de la tarjeta está en la parte posterior de la misma."
                                        class="form-control border-0" readonly name="tarjeta_soy_chacao">
                                    <small id="help_tarjeta_soy_chacao" class="notification"></small>
                                </div>
                            </div> --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-primary" for="tarjeta_soy_chacao">Fecha de ingreso</label>
                                    <input type="date" required title="Fecha de ingreso"
                                        value="{{ date('Y-m-d') }}" class="form-control" name="fecha_ingreso">
                                    <small id="help_tarjeta_soy_chacao" class="notification"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group box-cat_estado_id">
                                    <label class="text-primary" for="cat_estado_id">Ubicacion Actual</label>
                                    <input class="form-control text-center" readonly value="Sala de Espera">
                                    <small class="notification"></small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group box-cat_municipio_id">
                                    <label class="text-primary" for="cat_municipio_id">Ubicar en:</label>
                                    <select required title="Un Municipio es requerido" class="form-control"
                                        name="cat_user_ubicacion_id" id="cat_municipio_id"
                                        aria-describedby="helpId" placeholder="">
                                        <option selected value="245">SE</option>
                                        <option value="2">EA</option>
                                        <option value="6">CARPAS</option>
                                        <option value="28">EP</option>
                                        <option value="389">TRASLADO</option>
                                        <option value="224">AD</option>
                                    </select>

                                    <small id="help_cat_municipio_id" class="notification"></small>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-2 justify-content-center">
                <div class="col-4">
                    <a id="regresar" class="btn btn-default text-primary btn-block" href="#"
                        role="button">Regresar</a>
                </div>
                <div class="col-4">
                    <button id="submit" type="submit" class="btn btn-success btn-block">Registrar</button>
                </div>
            </div>
        </div>

</template>
<!-- row table recipe -->
<template id="artefacto_0011">
    <tr>
        <td class="text-center row-item_fecha">1 Abril, 2022</td>
        <td>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-3">
                        <div class="bg-gray font-weight-bold pl-2">
                            Medicamento
                        </div>
                        <div class="row-item_medicamento">
                            Ibuprofeno
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-3">
                        <div class="bg-gray font-weight-bold pl-2">
                            Presentación
                        </div>
                        <div class="row-item_presentacion">
                            20 mg
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-2">
                        <div class="bg-gray font-weight-bold pl-2">
                            Cantidad
                        </div>
                        <div class="row-item_cantidad text-center">

                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                        <div class="bg-gray font-weight-bold pl-2">
                            Indicación
                        </div>
                        <div class="row-item_indicacion">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos placeat repudiandae
                            assumenda quo modi harum, consequatur itaque earum repellendus maiores eius voluptatem
                            dolorum deserunt ullam totam reiciendis nesciunt ratione. Maiores.
                        </div>
                    </div>
                </div>
            </div>


        </td>
        <td nowrap align="center">
            <button title="Editar valor" class="row-item_edit  btn btn-default text-primary"><i
                    class="row-item_edit fa fa-edit" aria-hidden="true"></i></button>

            <button title="Eliminar valor" class="row-item_delete  btn btn-danger"><i
                    class="row-item_delete fa fa-minus" aria-hidden="true"></i></button>
        </td>
    </tr>
</template>
<!-- model-modal- estudios -->
<template id="artefacto_0012">
    <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
    <div class="row pt-6" style=" margin-top: 7.5rem !important;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h1 id="title_modal" class="text-primary">
                Solicitud de Estudio Diagnóstico
            </h1>
        </div>
    </div>
    <ul class="nav nav-pills d-none mb-3 justify-content-end" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-page1-tab" data-toggle="pill" href="#pills-page1" role="tab"
                aria-controls="pills-page1" aria-selected="true">

            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link h3" id="pills-page2-tab" data-toggle="pill" href="#pills-page2" role="tab"
                aria-controls="pills-page2" aria-selected="false">
                Nuevo Estudio
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        </li>

    </ul>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-page1" role="tabpanel"
            aria-labelledby="pills-page1-tab">
            <a id="item_create" class="h3 cursor-pointer float-right text-primary">
                Añadir Estudio
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
            <table class="table table-bordered mb-3">
                <thead>
                    <tr>
                        <th class="text-primary text-center">Fecha</th>
                        <th class="text-primary text-center">Estudio</th>
                        <th class="text-primary text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <a id="regresar" class="btn bg-primary text-primary btn-block btn-lg"
                            data-dismiss="modal" aria-label="Close">Regresar</a>
                    </div>
                    <div class="col-6">
                        <div>
                            <div class="dropdown mr-1">
                                <button title="Imprimir Documento"
                                    class="btn btn-success btn-block btn-lg dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu pb-0  animate fade-down"
                                    aria-labelledby="dropdownMenuButton">
                                    <h3 class="dropdown-header text-primary"><b>Enviar por:</b></h3>

                                    <ul class="navbar-nav ms-auto">

                                        <li class="nav-item dropdown">
                                            <ul class="dropdown-menu dropdown-menu-right show"
                                                data-bs-popper="none">
                                                <li>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="fas fa-envelope text-primary"></i> Correo » </a>
                                                    <ul class="submenu submenu-left dropdown-menu">
                                                        <li style="display:none"><a id="email_estudio_color" class="dropdown-item"
                                                                href="#">Color</a></li>
                                                        <li><a id="email_estudio_bw" class="dropdown-item"
                                                                href="">Blanco y negro</a></li>

                                                    </ul>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="fab fa-whatsapp text-success"></i> Whatsapp » </a>
                                                    <ul class="submenu submenu-left dropdown-menu">
                                                        <li style="display:none"><a id="whatsapp_estudio_color" class="dropdown-item"
                                                                href="#">Color</a></li>
                                                        <li><a id="whatsapp_estudio_bw" class="dropdown-item"
                                                                href="">Blanco y negro</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="fas fa-file-pdf text-danger"></i> Imprimir PDF »
                                                    </a>
                                                    <ul class="submenu submenu-left dropdown-menu">
                                                        <li style="display:none"><a id="imprimir_estudio_color" class="dropdown-item"
                                                                href="#">Color</a></li>
                                                        <li><a id="imprimir_estudio_bw" class="dropdown-item"
                                                                href="">Blanco y negro</a></li>
                                                    </ul>
                                                </li>

                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-page2" role="tabpanel" aria-labelledby="pills-page2-tab">
            <form>
                <div class="container-fluid">
                    <div id="form" class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="">Unidad</label>
                                <select title="Seleccione una unidad de estudio"
                                    class="form-control form-control-lg bg-gray-footer-parodi" name="value">
                                    <option value="">Seleccione</option>
                                    <option value="Anatomía Patológica">Anatomía Patológica</option>
                                    <option value="Cardiología">Cardiología</option>
                                    <option value="Colonoscopia">Colonoscopia</option>
                                    <option value="Electroencefalografía">Electroencefalografía</option>
                                    <option value="Endoscopia Digestiva Superior (Gastroscopia)">Endoscopia Digestiva Superior (Gastroscopia)</option>
                                    <option value="Estudios Neurológicos">Estudios Neurológicos</option>
                                    <option value="Imágenes">Imágenes</option>
                                    <option value="Laboratorio">Laboratorio</option>
                                    <option value="Laboratorio de Función Pulmonar">Laboratorio de Función Pulmonar</option>
                                    <option value="Mapeo Cerebral">Mapeo Cerebral</option>
                                    <option value="Medicina Nuclear">Medicina Nuclear</option>
                                    <option value="Procedimientos de Neumonología">Procedimientos de Neumonología</option>
                                    <option value="Ultrasonido">Ultrasonido</option>
                                </select>
                            </div>
                            <small id="helpId1" class="form-text text-muted notification"></small>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="">Estudio</label>
                            <input title="Escriba el estudio a realizar"
                                class="form-control form-control-lg bg-gray-footer-parodi mb-3" name="value2"
                                placeholder="Estudio">
                            <small id="helpId2" class="form-text text-muted notification"></small>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <label for="">Notas</label>
                            <textarea title="Ingrese las indicaciones del medicamento"
                                class="form-control form-control-lg bg-gray-footer-parodi mb-3" name="coments" rows="2"
                                placeholder="Notas"></textarea>
                            <small id="helpId2" class="form-text text-muted notification"></small>
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <button id="regresar2" class="btn btn-primary btn-block btn-lg">Regresar</button>
                        </div>
                        <div class="col-6">
                            <button id="submit_update"
                                class="d-none m-0 btn btn-success btn-block btn-lg">Actualizar</button>
                            <button id="submit_store"
                                class="d-none m-0 btn btn-success btn-block btn-lg">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


</template>
<!-- row table estudio -->
<template id="artefacto_0013">
    <tr>
        <td class="text-center row-item_fecha">1 Abril, 2022</td>
        <td>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-3">
                        <div class="bg-gray font-weight-bold pl-2">
                            Unidad
                        </div>
                        <div class="row-item_unidad">
                            Ibuprofeno
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-3">
                        <div class="bg-gray font-weight-bold pl-2">
                            Estudio
                        </div>
                        <div class="row-item_estudio">
                            20 mg
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="bg-gray font-weight-bold pl-2">
                            Notas
                        </div>
                        <div class="row-item_notas">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos placeat repudiandae
                            assumenda quo modi harum, consequatur itaque earum repellendus maiores eius voluptatem
                            dolorum deserunt ullam totam reiciendis nesciunt ratione. Maiores.
                        </div>
                    </div>
                </div>
            </div>


        </td>
        <td nowrap align="center">
            <button title="Editar valor" class="row-item_edit  btn btn-default text-primary"><i
                    class="row-item_edit fa fa-edit" aria-hidden="true"></i></button>

            <button title="Eliminar valor" class="row-item_delete  btn btn-danger"><i
                    class="row-item_delete fa fa-minus" aria-hidden="true"></i></button>
        </td>
    </tr>
</template>
<!-- Loading Animation 2 -->
<template id="artefacto_00014">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="d-flex m-4 justify-content-center text-primary">
                Espere un momento por favor...
                <div class="spinner-border" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
        </div>
    </div>

</template>
<!-- row table cita empty -->
<template id="artefacto_00015">
    <tr>
        <td colspan="6" class="text-center text-secondary">
            No se encontraron nuevas citas <b>por confirmar</b>
        </td>
    </tr>
</template>
<!-- row-new-cita -->
<template id="artefacto_00016">
    <tr>
        <td class="p-0">Paciente</td>
        <td>Medico</td>
        <td>Especialidad</td>
        <td>21 de febrero, 2022</td>
        <td>2:00 PM</td>
        <td style="width: 160px;"></td>
    </tr>
</template>
<!-- row antecedente - alergia - medicamento -->
<template id="artefacto_0017">
    <div class="direct-chat-text-custom m-1">
        <div class="direct-chat-infos clearfix">
            <span class="item-date direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
        </div>
        <div class="d-flex">
            <div class="item-message flex-fill flex-grow-1">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum aliquid earum perferendis aperiam
                aliquam odit quod libero laudantium voluptatibus repudiandae debitis velit deleniti facilis quam,
                magni, eveniet odio eius dolorem.
            </div>
            <div class="flex-fill">
                <i class="item-delete cursor-pointer fa fa-times text-gray"></i>
            </div>
        </div>
    </div>
</template>
<!-- row_item_list_cat-cita-status -->
<template id="artefacto_0018">
    <tr>
        <td class="card-item-paciente-solicitud-fecha"></td>
        <td class="p-0">
            <div class="container-fluid p-0 m-0">

                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-column " style="width: fit-content">
                        <i class="tag-exonerado d-none text-right font-weight-bold px-3 align-items-center"
                            style="border-bottom-right-radius: 20px;"><i class="fas fa-check-double"></i>
                            Exonerado</i>
                    </div>
                    <div class="d-flex flex-column justify-content-end" style="width: fit-content">
                        <div class="d-none tag-condicion-cortesia-referido text-right font-weight-bold px-3 border">
                        </div>
                        <div class="tag-condicion-cortesia text-right font-weight-bold px-3 bg-success"
                            style="border-bottom-left-radius: 20px;">Particular</div>
                    </div>
                </div>


                {{-- <div  data-tippy-content="Organismo o institución asociada al pase de cortesía. Pulsa la estrella amarilla para modificarlo." class="d-none tarjeta-input-cortesia bg-secondary-cortesia tooltip-primary">
                    <div class="font-weight-bold text-primary">
                        Cortesía:
                    </div>
                    <div>

                    </div>
                </div> --}}
                <div class="d-flex flex-row" style="height:100%">

                    <div class="flex-fill align-self-start flex-grow-1 border-right">
                        <div class="d-flex flex-row justify-content-center border-bottom">
                            <div class="d-flex paciente-edit cursor-pointer" style="align-items: center;">
                                <div class="m-1 paciente-edit">
                                    <img onerror="this.src='/image/system/icono-paciente-blanco.svg';"
                                        loading="lazy"
                                        src="/image/system/icono-paciente-blanco.svg"
                                        style="width:1.5cm;height:1.5cm" data-tippy-content="Imagen del paciente"
                                        class="paciente-edit card-item-paciente-imagen tooltip-primary border border-primary card-item-paciente-image rounded-circle mx-auto d-block"
                                        alt="...">
                                </div>
                                <div>
                                    <div class="paciente-edit">
                                        <h4 data-tippy-content="Nombre del paciente"
                                            class="paciente-edit tooltip-primary card-item-paciente-fullname text-primary"
                                            style="margin-bottom: 0;white-space: normal;">Sample Nombre Sample
                                            Apellido</h4>
                                    </div>
                                </div>
                                {{-- <div>
                                    <button class="heartbeat p-1 btn btn-transparent">
                                        <i data-tippy-content="Pase de cortesía DESACTIVADO" class="tooltip-warning tarjeta-cortesia fas fa-star text-warning-disabled"></i>
                                    </button>
                                </div> --}}
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="d-flex flex-fill  align-self-start">
                                <div class="d-flex  flex-column flex-fill align-items-center">
                                    <div data-tippy-content="Documento de identidad del paciente"
                                        class="tooltip-primary d-flex flex-fill justify-content-center">
                                        <b class="text-primary" style="font-size:0.8em;">Cédula</b>
                                    </div>
                                    <div class="d-flex flex-fill justify-content-center">
                                        <div class="text-gray text-nowrap overflow-hidden card-item-paciente-cedula">
                                            0.000.000</div>
                                    </div>
                                </div>
                                <div data-tippy-content="Edad del paciente"
                                    class="tooltip-primary d-flex flex-column  flex-fill align-items-center border-left border-right">
                                    <div class="d-flex flex-fill justify-content-center">
                                        <b class="text-primary" style="font-size:0.8em;">Edad</b>
                                    </div>
                                    <div class="d-flex flex-fill justify-content-center">
                                        <div class="text-gray card-item-paciente-edad">00</div>
                                    </div>
                                </div>
                                <div data-tippy-content="Genero del paciente"
                                    class="tooltip-primary d-flex flex-column flex-fill align-items-center">
                                    <div class="d-flex flex-fill justify-content-center">
                                        <b class="text-primary" style="font-size:0.8em;">Sexo</b>
                                    </div>
                                    <div class="d-flex p-1 flex-fill justify-content-center">
                                        <div class="text-gray card-item-paciente-genero">n/i</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="flex-fill align-self-start p-1">
                        <div class="d-flex flex-column" style="width: 200px;">
                            <div class="tarjeta-salud-chacao pb-1">
                                <div class="text-center">
                                    <b class="text-gray" style="font-size:0.9em;">Soy CMDLT</b>
                                </div>
                                <div class="d-flex justify-content-center w-100">
                                    <div class="badge text-black badge-gray card-item-paciente-tarjeta-chacao">No
                                        posee</div>
                                </div>
                            </div>

                            <div>
                                <div class="text-center">
                                    <b class="text-primary" style="font-size:0.9em;">
                                        Teléfono Contacto
                                    </b>
                                </div>
                                <div class="d-flex flex-fill mb-1 justify-content-center">
                                    <a class="enlace-whatsapp btn btn-default mx-1 btn-block text-nowrap btn-sm tooltip-primary"
                                        data-tippy-content="Teléfono contacto del paciente: +No Indicado">
                                        <i class="fab fa-whatsapp enlace-whatsapp text-success"
                                            aria-hidden="true"></i>
                                        <span
                                            class=" enlace-whatsapp card-item-paciente-telefono-movil">+580000000000</span>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <small class="d-none" style="color:#F4F7F7">#9999</small>
        </td>
        <td class="card-item-paciente-cita-medico">Médico Nombre Medico Apellido</td>
        <td class="card-item-paciente-cita-especialidad">Especialidad</td>
        <td class="card-item-paciente-cita-fecha">00 de Mes, 0000</td>
        <td class="card-item-paciente-cita-hora">00:00</td>
        <td class="botones-fila" style="width: 160px;">
            <a class="btn btn-info btn-block btn-sm cita-referencia mb-1 d-none" data-btn-id="9"
                data-cat_user_cita_status_id="4" href="#" role="button">
                <i class="fas fa-file-alt cita-referencia" style="width:15px;height:15px;"></i>
                Referencia
            </a>
            <a class="btn btn-success btn-block btn-sm asistio-cita mb-1" data-btn-id="8"
                data-cat_user_cita_status_id="4" href="#" role="button">
                <img class="asistio-cita" src="/image/system/calendar-check.svg" style="width:15px;height:15px;"
                    alt="Not Image Found"> ¿Asistió?
            </a>
            <a class="btn btn-success btn-block btn-sm atender-hoy-cita mb-1" data-btn-id="7"
                data-cat_user_cita_status_id="4" href="#" role="button">
                <img class="atender-hoy-cita" src="/image/system/calendar-check.svg"
                    style="width:15px;height:15px;" alt="Not Image Found"> Atender Hoy
            </a>
            <a class="btn btn-primary btn-block btn-sm aprobar-cita mb-1" data-btn-id="0"
                data-cat_user_cita_status_id="4" href="#" role="button">
                <img data-cat_user_cita_status_id="4" class="aprobar-cita" src="/image/system/calendar-check.svg"
                    style="width:15px;height:15px;" alt="Not Image Found"> Confirmar
            </a>

            <a class="btn btn-success btn-block btn-sm preconsulta-cita mb-1" data-btn-id="4"
                data-cat_user_cita_status_id="5" href="#" role="button">
                <img data-cat_user_cita_status_id="5" class="preconsulta-cita"
                    src="/image/system/calendar-check.svg" style="width:15px;height:15px;" alt="Not Image Found">
                Signos vitales
            </a>
            <a class="btn btn-success btn-block btn-sm consulta-cita mb-1" data-btn-id="5"
                data-cat_user_cita_status_id="6" href="#" role="button">
                <img data-cat_user_cita_status_id="6" class="consulta-cita" src="/image/system/calendar-check.svg"
                    style="width:15px;height:15px;" alt="Not Image Found"> Atender Consulta
            </a>
            <a class="btn btn-warning btn-block btn-sm cita-reprogramar mb-1" data-btn-id="1"
                data-cat_user_cita_status_id="2" href="#" role="button">
                <img data-cat_user_cita_status_id="2" class="cita-reprogramar"
                    src="/image/system/calendar-exclamation.svg" style="width:15px;height:15px;"
                    alt="Not Image Found">
                Reprogramar
            </a>

            <a class="btn btn-danger btn-block btn-sm cancelar-cita mb-1" data-btn-id="6"
                data-cat_user_cita_status_id="3" href="#" role="button">
                <img data-cat_user_cita_status_id="3" class="cancelar-cita"
                    src="/image/system/calendar-cancel.svg" style="width:15px;height:15px;" alt="Not Image Found">
                Cancelar
            </a>




        </td>
    </tr>
</template>
<!-- formReprogramar -->
<template id="artefacto_0019">
    <div class="row">
        <div class="col-md-12">
            <b class="text-secondary">Fecha Agendada:</b> <span>17 de febrero, 2022 10:00 AM</span>
        </div>
        <div class="col-md-6 mt-2">
            <h5 class="text-primary">Ingrese nueva fecha:</h5>
        </div>
        <div class="col-md-6 mt-2">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input custom-control-input-success" type="checkbox"
                    id="atencion_inmediata">
                <label for="atencion_inmediata" class="text-danger custom-control-label p-0">Atender hoy</label>
            </div>

        </div>

        <div class="col-md-12">
            <div id="calendar" class="daterange" style="width: 100%"></div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="text-secondary" for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-reprogramar form-control"
                    placeholder="" aria-describedby="helpId">
                <small id="helpId" class="text-muted"></small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="text-secondary" for="hour">Hora</label>
                <input type="time" name="hour" id="hour" class="form-reprogramar form-control"
                    placeholder="" aria-describedby="helpId">
                <small id="helpId" class="text-muted"></small>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="text-secondary" for="coments">Comentarios</label>
                <textarea name="coments" id="coments" class="form-reprogramar form-control" cols="3"
                    aria-describedby="helpId" rows="3"></textarea>
                <small id="helpId" class="text-muted"></small>
            </div>
        </div>
    </div>
</template>
<!-- fila box items presonsulta paciente -->
<template id="artefacto_0020">
    <div class="direct-chat-text-custom m-1">
        <div class="direct-chat-infos clearfix">
            <span class="item-date direct-chat-timestamp float-right">00 de mes, 2020</span>
        </div>
        <div class="d-flex">
            <div class="item-message flex-fill flex-grow-1">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum
                aliquid earum perferendis aperiam aliquam odit quod libero
                laudantium voluptatibus repudiandae debitis velit deleniti
                facilis quam, magni, eveniet odio eius dolorem.
            </div>
            <div class="d-none">
                <i class="item-delete cursor-pointer fa fa-times text-gray"></i>
            </div>
        </div>
    </div>
</template>
<!-- fila vacia box items presonsulta paciente -->
<template id="artefacto_0021">
    <div class="direct-chat-msg">
        <div class="bg-light text-center m-1">
            <div class="d-flex">
                <div class="text-primary flex-fill flex-grow-1">Sin registros</div>
            </div>
        </div>
    </div>
</template>
<!-- formReprogramar -->
<template id="artefacto_0022">
    <div class="row">
        <div class="col-md-12">
            <b class="text-secondary">Fecha Agendada:</b> <span>17 de febrero, 2022 10:00 AM</span>
        </div>
        <div class="col-md-12 mt-2">
            <h5 class="text-primary">Mótivo para cancelar:</h5>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{-- <label class="text-secondary" for="coments">Comentarios</label> --}}
                <textarea name="coments" id="coments" class="form-reprogramar form-control" cols="3"
                    aria-describedby="helpId" rows="3"></textarea>
                <small id="helpId" class="text-muted"></small>
            </div>
        </div>
    </div>
</template>
<!-- caja_item_paciente -->
<template id="artefacto_0023">
    <div class="card direct-chat direct-chat-primary">
        <div class="card-header" data-card-widget="collapse">
            <h3 class="card-title text-primary font-weight-bold">Item</h3>

            <div class="card-tools">
                <span class="item-counter {{-- item-counter-user_antecedente --}} badge badge-gray">0</span>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                </button>


            </div>
        </div>
        <div class="card-footer">
            <form action="#" method="post">
                <div class="input-group">
                    <input type="text" name="{{-- user_antecedente --}}" placeholder="Escribe un texto ..."
                        class="form-control">
                    <span class="input-group-append">
                        <button data-name="{{-- user_antecedente --}}" title="Guardar" type="button"
                            class="submit btn btn-primary">
                            <i data-name="{{-- user_antecedente --}}" class="submit item-save fa fa-plus"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
        <div class="card-body" style="display: none;">
            <div class="overlay-wrapper">
                <div class="overlay d-none"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                    <div class="text-bold pt-2">Guardando...</div>
                </div>
                <div class="items_body direct-chat-messages right" style="height:auto;max-height: 300px;">
                    <div class="direct-chat-msg">
                        <div class="bg-light text-center m-1">

                            <div class="d-flex">
                                <div class="text-primary flex-fill flex-grow-1">Sin registros</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    </div>
</template>
<!-- group_vital-signs -->
<template id="artefacto_0024">
    <div class="card vital-signs">
        <div class="card-header">
            <h3 class="card-title text-primary font-weight-bold">Signos Vitales</h3>
        </div>
        <div class="card-body p-0">
            <div class="overlay-wrapper">
                <div class="overlay d-none"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                    <div class="text-bold pt-2">Guardando...</div>
                </div>

                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <div class="d-flex align-items-center text-gray">
                            <div class="input-group">
                                <div class="input-group-prepend border-0">
                                    <span class="input-group-text border-0 rounded-0"
                                        style="width: 65px;">Peso</span>
                                </div>
                                <input name="user_peso" type="text"
                                    class="form-control  border-0  tooltip-primary" data-tippy-content="Peso"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">

                            </div>
                            <div class="input-group-append border-0">
                                <span class="input-group-text rounded-0 border-0" style="width:90px">Kg.</span>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="d-flex align-items-center text-gray">
                            <div class="input-group">
                                <div class="input-group-prepend border-0">
                                    <span class="input-group-text border-0 rounded-0"
                                        style="width: 65px;">Altura</span>
                                </div>
                                <input name="user_altura" type="text"
                                    class="form-control  border-0 tooltip-primary" data-tippy-content="Altura"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                            <div class="input-group-append border-0">
                                <span class="input-group-text rounded-0 border-0" style="width:90px">Mts.</span>
                            </div>
                        </div>

                    </li>
                    <li class="nav-item">
                        <div class="d-flex align-items-center text-gray">
                            <div class="input-group">
                                <div class="input-group-prepend border-0">
                                    <span class="input-group-text border-0 rounded-0"
                                        style="width: 65px;">Temp</span>
                                </div>
                                <input name="user_temp" type="text"
                                    class="form-control  border-0 tooltip-primary" data-tippy-content="Temperatura"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                <div class="input-group-append border-0">
                                    <span class="input-group-text rounded-0 border-0" style="width:90px">°C</span>
                                </div>
                            </div>

                        </div>

                    </li>
                    <li class="nav-item">
                        <div class="d-flex align-items-center text-gray">
                            <div class="input-group">
                                <div class="input-group-prepend border-0">
                                    <span class="input-group-text border-0 rounded-0"
                                        style="width: 65px;">SpO2</span>
                                </div>
                                <input name="user_spo2" type="text"
                                    class="form-control  border-0 tooltip-primary" data-tippy-content="Oximetria"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                <div class="input-group-append border-0">
                                    <span class="input-group-text rounded-0 border-0" style="width:90px">%</span>
                                </div>
                            </div>

                        </div>

                    </li>
                    <li class="nav-item">
                        <div class="d-flex align-items-center text-gray">
                            <div class="input-group">
                                <div class="input-group-prepend border-0">
                                    <span class="input-group-text border-0 rounded-0" style="width: 65px;">Fc</span>
                                </div>
                                <input name="user_fc" type="text"
                                    class="form-control  border-0 tooltip-primary"
                                    data-tippy-content="Frecuencia Cardiaca" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default">
                                <div class="input-group-append border-0">
                                    <span class="input-group-text rounded-0 border-0"
                                        style="width:90px">lat./min.</span>
                                </div>
                            </div>

                        </div>

                    </li>
                    <li class="nav-item">
                        <div class="d-flex align-items-center text-gray">
                            <div class="input-group">
                                <div class="input-group-prepend border-0">
                                    <span class="input-group-text border-0 rounded-0" style="width: 65px;">Fr</span>
                                </div>
                                <input name="user_fr" type="text"
                                    class="form-control  border-0 tooltip-primary"
                                    data-tippy-content="Frecuencia Respiratoria" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default">
                                <div class="input-group-append border-0">
                                    <span class="input-group-text rounded-0 border-0"
                                        style="width:90px">resp./min.</span>
                                </div>
                            </div>

                        </div>

                    </li>
                    <li class="nav-item">
                        <div class="input-group">
                            <div class="input-group-prepend  border-0 rounded-0">
                                <span class="input-group-text  border-0 rounded-0" style="width: 65px;">Glic.</span>
                            </div>
                            <input name="user_glic" type="text"
                                class="form-control border-0 border-right tooltip-primary"
                                data-tippy-content="Glicemia">

                            <div class="input-group-append border-0">
                                <span class="input-group-text rounded-0 border-0" style="width:90px">mg/dL</span>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <div class="input-group">
                            <div class="input-group-prepend  border-0 rounded-0">
                                <span class="input-group-text  border-0 rounded-0" style="width: 65px;">Ta</span>
                            </div>
                            <input name="user_ta_sis" type="text"
                                class="form-control border-0 border-right tooltip-primary"
                                data-tippy-content="Tensión Arterial Sistolica" placeholder="Sistolica">
                            <input name="user_ta_dia" type="text" class="form-control border-0 tooltip-primary"
                                data-tippy-content="Tensión Arterial Diastólica" placeholder="Diastolica">
                            <div class="input-group-append border-0">
                                <span class="input-group-text rounded-0 border-0" style="width:90px">mmHg</span>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>

    </div>

</template>
<!-- card paciente -->
<template id="artefacto_0025">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-primary font-weight-bold">Datos del paciente</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div id="profile_paciente" class="card-body box-profile p-0">
            <div class="text-center mt-1">
                <img onerror="reemplaza_imagen(this)"
                    class="profile-user-img preconsulta-paciente-imagen img-fluid img-circle"
                    src="/image/system/icono-paciente-blanco.svg"
                    style="width: 90px;height: 90px;object-fit: cover;" alt="User profile picture">
            </div>

            <h3 class="profile-username preconsulta-paciente-name text-center">Sample Name
            </h3>
            <ul class="list-group rounded bg-white list-group-unbordered ">
                <li class="list-group-item bg-transparent border-top-0 px-1">
                    <b class="text-secondary">Cédula</b> <a class="float-right preconsulta-paciente-cedula"></a>
                </li>
                <li class="list-group-item bg-transparent px-1">
                    <b class="text-secondary">Correo</b> <a class="float-right preconsulta-paciente-correo"></a>
                </li>
                <li class="list-group-item bg-transparent px-1">
                    <b class="text-secondary">Edad</b> <a class="float-right preconsulta-paciente-edad"></a>
                </li>
                <li class="list-group-item bg-transparent px-1">
                    <b class="text-secondary">Género</b> <a class="float-right preconsulta-paciente-genero"></a>
                </li>
                <li class="list-group-item bg-transparent px-1">

                    <b class="text-secondary">Teléfono</b>
                    <a target="_blank" href="https://api.whatsapp.com/send?phone=04149320905"
                        class="enlace-whatsapp btn btn-default border-0 float-right preconsulta-paciente-telefono-movil">
                        <i class="enlace-whatsapp fab fa-whatsapp text-success"></i> <span
                            class="enlace-whatsapp">04140000000</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>
<!-- model-modal recipes2 -->
<template id="artefacto_0026">

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h1 id="title_modal" class="text-primary">
                <span class="item-title">Récipe</span> <small
                    class="item-counter d-none badge badge-primary">#1</small>
            </h1>
        </div>
    </div>
    <ul class="nav nav-pills d-none mb-3 justify-content-end" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-page1-tab" data-toggle="pill" href="#pills-page1" role="tab"
                aria-controls="pills-page1" aria-selected="true">

            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link h3" id="pills-page2-tab" data-toggle="pill" href="#pills-page2" role="tab"
                aria-controls="pills-page2" aria-selected="false">
            </a>
        </li>

    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-page1" role="tabpanel"
            aria-labelledby="pills-page1-tab">
            <a id="item_create" class="h3 cursor-pointer float-right text-primary">
                <span class="item-create-name">Añadir Medicamento</span>
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
            <table id="table_index" class="table table-bordered bg-white mb-3">
                <thead>
                    <tr>
                        <th class="text-primary text-center">#</th>
                        <th class="text-primary text-center item-table-column-name">Datos del récipe</th>
                        <th class="text-primary text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6 offset-3">
                        <a id="regresar" class="btn bg-primary text-primary btn-block" data-dismiss="modal"
                            aria-label="Close">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-page2" role="tabpanel" aria-labelledby="pills-page2-tab">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <div id="form" class="row">
                            <div class="col-12">
                                <label class="text-primary" for="value">Medicamento</label>
                                <input autocomplete="off" title="Ingrese el nombre de un medicamento"
                                    type="text" class="form-control" name="value"
                                    aria-describedby="helpId1">
                                <small id="helpId1" class="form-text text-muted notification"></small>
                            </div>
                            <div class="col-12">
                                <label class="text-primary" for="value">Presentación</label>
                                <input autocomplete="off" title="Ingrese una presentación del medicamento"
                                    type="text" class="form-control" name="value2"
                                    aria-describedby="helpId2">
                                <small id="helpId2" class="form-text text-muted notification"></small>
                            </div>
                            <div class="col-12">
                                <label class="text-primary" for="value4">Cantidad</label>
                                <input autocomplete="off" title="Ingrese una cantidad del medicamento"
                                    type="text" class="form-control" name="value4"
                                    aria-describedby="helpId4">
                                <small id="helpId4" class="form-text text-muted notification"></small>
                            </div>
                            <div class="col-12">
                                <label class="text-primary" for="value3">Indicaciones</label>
                                <textarea autocomplete="off" title="Ingrese las indicaciones del medicamento" class="form-control mb-3"
                                    name="value3" rows="2"></textarea>
                                <small id="helpId2" class="form-text text-muted notification"></small>
                            </div>
                            <div class="col-12">
                                <button id="submit_update"
                                    class="m-0 mb-2 btn btn-update btn-success btn-block d-none ">Actualizar</button>
                                <button id="submit_store"
                                    class="m-0 mb-2 btn btn-add btn-success btn-block">Añadir</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-8 p-2 border rounded" style="background-color: #f7f4f4!important;">
                        <div class="overlay-wrapper">
                            <div class="overlay text-primary d-none">
                                <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                                <div class="text-bold pt-2">Por favor espere un momento...</div>
                            </div>
                            <div class="text-center">
                                <h1><i class="pc-success text-success"></i></h1>
                            </div>
                            <div class="table-responsive border rounded bg-white" style="height:100%">
                                <table id="table_create" class="table table-bordered m-0">
                                    <thead>

                                        <tr>
                                            <th style="width: 50px;" class="text-center text-primary">#</th>
                                            <th class="text-center text-primary item-table2-column-name">Medicamento
                                            </th>
                                            <th style="width: 100px;" class="d-none text-center text-primary">Acción
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <!--  <td colspan="3" class="text-center text-primary">
                                                Sin registros
                                            </td> -->
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mt-2">
                    <div class="col-12 col-sm-4">
                        <button id="regresar2"
                            class="btn-index btn btn-default font-weight-bold text-primary btn-block mb-3">Regresar</button>
                    </div>
                    <div class="col-12 col-sm-8 px-0">
                        <button id="guardar" class="btn-index btn btn-primary btn-block mb-3">Guardar</button>
                    </div>
                </div>
            </div>
            {{-- <form>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-sm-4 border-right">
                            <div id="form" class="row">
                                <div class="col-12">
                                    <label class="text-primary" for="value">Medicamento</label>
                                    <input title="Ingrese el nombre de un medicamento" type="text" class="form-control"
                                        name="value" aria-describedby="helpId1">
                                    <small id="helpId1" class="form-text text-muted notification"></small>
                                </div>
                                <div class="col-12">
                                    <label class="text-primary" for="value">Presentación</label>
                                    <input title="Ingrese una presentación del medicamento" type="text" class="form-control"
                                        name="value2" aria-describedby="helpId2">
                                    <small id="helpId2" class="form-text text-muted notification"></small>
                                </div>
                                <div class="col-12">
                                    <label class="text-primary" for="value4">Cantidad</label>
                                    <input title="Ingrese una cantidad del medicamento" type="text" class="form-control"
                                        name="value4" aria-describedby="helpId4">
                                    <small id="helpId4" class="form-text text-muted notification"></small>
                                </div>
                                <div class="col-12">
                                    <label class="text-primary" for="value3">Indicaciones</label>
                                    <textarea title="Ingrese las indicaciones del medicamento" class="form-control mb-3" name="value3" rows="2"></textarea>
                                    <small id="helpId2" class="form-text text-muted notification"></small>
                                </div>
                                <div class="col-12">
                                    <button id="submit_update"
                                        class="d-none m-0 mb-2 btn btn-success btn-block btn-lg">Actualizar</button>
                                    <button id="submit_store"
                                        class="d-none m-0 mb-2 btn btn-success btn-block btn-lg">Añadir</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <table class="table table-bordered bg-white mb-3">
                                <thead>
                                    <tr>
                                        <th class="text-primary text-center">Fecha</th>
                                        <th class="text-primary text-center">Descripción</th>
                                        <th class="text-primary text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3" class="text-center text-primary">
                                            Sin registros
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">

                    <div class="row mt-2">
                        <div class="col-12">
                            <button id="regresar2" class="btn btn-primary btn-block btn-lg">Regresar</button>
                        </div>
                    </div>
                </div>
            </form> --}}
        </div>
    </div>


</template>
<!-- model-modal estudio -->
<template id="artefacto_0027">

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h1 id="title_modal" class="text-primary">
                <span class="item-title">Récipe</span> <small
                    class="item-counter d-none badge badge-primary">#1</small>
            </h1>
        </div>
    </div>
    <ul class="nav nav-pills d-none mb-3 justify-content-end" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-page1-tab" data-toggle="pill" href="#pills-page1" role="tab"
                aria-controls="pills-page1" aria-selected="true">

            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link h3" id="pills-page2-tab" data-toggle="pill" href="#pills-page2" role="tab"
                aria-controls="pills-page2" aria-selected="false">
            </a>
        </li>

    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-page1" role="tabpanel"
            aria-labelledby="pills-page1-tab">
            <a id="item_create" class="h3 cursor-pointer float-right text-primary">
                <span class="item-create-name">Añadir Medicamento</span>
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
            <table id="table_index" class="table table-bordered bg-white mb-3">
                <thead>
                    <tr>
                        <th class="text-primary text-center">#</th>
                        <th class="text-primary text-center item-table-column-name">Datos del récipe</th>
                        <th class="text-primary text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6 offset-3">
                        <a id="regresar" class="btn bg-primary text-primary btn-block" data-dismiss="modal"
                            aria-label="Close">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-page2" role="tabpanel" aria-labelledby="pills-page2-tab">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <div id="form" class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="text-primary" for="">Unidad</label>
                                    <select title="Seleccione una unidad de estudio" class="form-control"
                                        name="value">
                                        <option value="">Seleccione</option>
                                        <option value="Anatomía Patológica">Anatomía Patológica</option>
                                        <option value="Cardiología">Cardiología</option>
                                        <option value="Colonoscopia">Colonoscopia</option>
                                        <option value="Electroencefalografía">Electroencefalografía</option>
                                        <option value="Endoscopia Digestiva Superior (Gastroscopia)">Endoscopia Digestiva Superior (Gastroscopia)</option>
                                        <option value="Estudios Neurológicos">Estudios Neurológicos</option>
                                        <option value="Imágenes">Imágenes</option>
                                        <option value="Laboratorio">Laboratorio</option>
                                        <option value="Laboratorio de Función Pulmonar">Laboratorio de Función Pulmonar</option>
                                        <option value="Mapeo Cerebral">Mapeo Cerebral</option>
                                        <option value="Medicina Nuclear">Medicina Nuclear</option>
                                        <option value="Procedimientos de Neumonología">Procedimientos de Neumonología</option>
                                        <option value="Ultrasonido">Ultrasonido</option>
                                    </select>
                                </div>
                                <small id="helpId1" class="form-text text-muted notification"></small>
                            </div>
                            <div class="col-12">
                                <label class="text-primary" for="">Estudio</label>
                                <input title="Escriba el estudio a realizar" class="form-control mb-3"
                                    name="value2" placeholder="Estudio">
                                <small id="helpId2" class="form-text text-muted notification"></small>
                            </div>
                            <div class="col-12">
                                <label class="text-primary" for="">Notas</label>
                                <textarea title="Ingrese las indicaciones del medicamento" class="form-control mb-3" name="coments"
                                    rows="2" placeholder="Notas"></textarea>
                                <small id="helpId2" class="form-text text-muted notification"></small>
                            </div>

                            <div class="col-12">
                                <button id="submit_update"
                                    class="m-0 mb-2 btn btn-update btn-success btn-block d-none ">Actualizar</button>
                                <button id="submit_store"
                                    class="m-0 mb-2 btn btn-add btn-success btn-block">Añadir</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-8 p-2 border rounded" style="background-color: #f7f4f4!important;">
                        <div class="overlay-wrapper">
                            <div class="overlay text-primary d-none">
                                <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                                <div class="text-bold pt-2">Por favor espere un momento...</div>
                            </div>
                            <div class="text-center">
                                <h1><i class="pc-success text-success"></i></h1>
                            </div>
                            <div class="table-responsive border rounded bg-white" style="height:100%">
                                <table id="table_create" class="table table-bordered m-0">
                                    <thead>

                                        <tr>
                                            <th style="width: 50px;" class="text-center text-primary">#</th>
                                            <th class="text-center text-primary item-table2-column-name">Medicamento
                                            </th>
                                            <th style="width: 100px;" class="text-center text-primary">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <!--  <td colspan="3" class="text-center text-primary">
                                                Sin registros
                                            </td> -->
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mt-2">
                    <div class="col-12 col-sm-4">
                        <button id="regresar2"
                            class="btn-index btn btn-default font-weight-bold text-primary btn-block mb-3">Regresar</button>
                    </div>
                    <div class="col-12 col-sm-8 px-0">
                        <button id="guardar" class="btn-index btn btn-primary btn-block mb-3">Guardar</button>
                    </div>
                </div>
            </div>
            {{-- <form>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-sm-4 border-right">
                            <div id="form" class="row">
                                <div class="col-12">
                                    <label class="text-primary" for="value">Medicamento</label>
                                    <input title="Ingrese el nombre de un medicamento" type="text" class="form-control"
                                        name="value" aria-describedby="helpId1">
                                    <small id="helpId1" class="form-text text-muted notification"></small>
                                </div>
                                <div class="col-12">
                                    <label class="text-primary" for="value">Presentación</label>
                                    <input title="Ingrese una presentación del medicamento" type="text" class="form-control"
                                        name="value2" aria-describedby="helpId2">
                                    <small id="helpId2" class="form-text text-muted notification"></small>
                                </div>
                                <div class="col-12">
                                    <label class="text-primary" for="value4">Cantidad</label>
                                    <input title="Ingrese una cantidad del medicamento" type="text" class="form-control"
                                        name="value4" aria-describedby="helpId4">
                                    <small id="helpId4" class="form-text text-muted notification"></small>
                                </div>
                                <div class="col-12">
                                    <label class="text-primary" for="value3">Indicaciones</label>
                                    <textarea title="Ingrese las indicaciones del medicamento" class="form-control mb-3" name="value3" rows="2"></textarea>
                                    <small id="helpId2" class="form-text text-muted notification"></small>
                                </div>
                                <div class="col-12">
                                    <button id="submit_update"
                                        class="d-none m-0 mb-2 btn btn-success btn-block btn-lg">Actualizar</button>
                                    <button id="submit_store"
                                        class="d-none m-0 mb-2 btn btn-success btn-block btn-lg">Añadir</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <table class="table table-bordered bg-white mb-3">
                                <thead>
                                    <tr>
                                        <th class="text-primary text-center">Fecha</th>
                                        <th class="text-primary text-center">Descripción</th>
                                        <th class="text-primary text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3" class="text-center text-primary">
                                            Sin registros
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">

                    <div class="row mt-2">
                        <div class="col-12">
                            <button id="regresar2" class="btn btn-primary btn-block btn-lg">Regresar</button>
                        </div>
                    </div>
                </div>
            </form> --}}
        </div>
    </div>


</template>
<!-- model-modal- estudios -->
<template id="artefacto_0080">

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h1 id="title_modal" class="text-primary">
                Solicitud de Estudio Diagnóstico
            </h1>
        </div>
    </div>
    <ul class="nav nav-pills d-none mb-3 justify-content-end" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-page1-tab" data-toggle="pill" href="#pills-page1" role="tab"
                aria-controls="pills-page1" aria-selected="true">

            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link h3" id="pills-page2-tab" data-toggle="pill" href="#pills-page2" role="tab"
                aria-controls="pills-page2" aria-selected="false">
                Nuevo Estudio
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        </li>

    </ul>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-page1" role="tabpanel"
            aria-labelledby="pills-page1-tab">
            <a id="item_create" class="h3 cursor-pointer float-right text-primary">
                Añadir Estudio
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
            <table class="table table-bordered bg-white mb-3">
                <thead>
                    <tr>
                        <th class="text-primary text-center">Fecha</th>
                        <th class="text-primary text-center">Estudio</th>
                        <th class="text-primary text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <a id="regresar" class="btn bg-primary text-primary btn-block btn-lg"
                            data-dismiss="modal" aria-label="Close">Regresar</a>
                    </div>
                    <div class="col-6">
                        <div>
                            <div class="dropdown mr-1">
                                <button title="Imprimir Documento"
                                    class="btn btn-success btn-block btn-lg dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu pb-0  animate fade-down"
                                    aria-labelledby="dropdownMenuButton">
                                    <h3 class="dropdown-header text-primary"><b>Enviar por:</b></h3>

                                    <ul class="navbar-nav ms-auto">

                                        <li class="nav-item dropdown">
                                            <ul class="dropdown-menu dropdown-menu-right show"
                                                data-bs-popper="none">
                                                <li>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="fas fa-envelope text-primary"></i> Correo » </a>
                                                    <ul class="submenu submenu-left dropdown-menu">
                                                        <li style="display:none"><a id="email_estudio_color" class="dropdown-item"
                                                                href="#">Color</a></li>
                                                        <li><a id="email_estudio_bw" class="dropdown-item"
                                                                href="">Blanco y negro</a></li>

                                                    </ul>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="fab fa-whatsapp text-success"></i> Whatsapp »
                                                    </a>
                                                    <ul class="submenu submenu-left dropdown-menu">
                                                        <li style="display:none"><a id="whatsapp_estudio_color" class="dropdown-item"
                                                                href="#">Color</a></li>
                                                        <li><a id="whatsapp_estudio_bw" class="dropdown-item"
                                                                href="">Blanco y negro</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="fas fa-file-pdf text-danger"></i> Imprimir PDF »
                                                    </a>
                                                    <ul class="submenu submenu-left dropdown-menu">
                                                        <li style="display:none"><a id="imprimir_estudio_color" class="dropdown-item"
                                                                href="#">Color</a></li>
                                                        <li><a id="imprimir_estudio_bw" class="dropdown-item"
                                                                href="">Blanco y negro</a></li>
                                                    </ul>
                                                </li>

                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-page2" role="tabpanel" aria-labelledby="pills-page2-tab">
            <form>
                <div class="container-fluid">
                    <div id="form" class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label class="text-primary" for="">Unidad</label>
                                <select title="Seleccione una unidad de estudio" class="form-control"
                                    name="value">
                                    <option value="">Seleccione</option>
                                    <option value="Anatomía Patológica">Anatomía Patológica</option>
                                    <option value="Cardiología">Cardiología</option>
                                    <option value="Colonoscopia">Colonoscopia</option>
                                    <option value="Electroencefalografía">Electroencefalografía</option>
                                    <option value="Endoscopia Digestiva Superior (Gastroscopia)">Endoscopia Digestiva Superior (Gastroscopia)</option>
                                    <option value="Estudios Neurológicos">Estudios Neurológicos</option>
                                    <option value="Imágenes">Imágenes</option>
                                    <option value="Laboratorio">Laboratorio</option>
                                    <option value="Laboratorio de Función Pulmonar">Laboratorio de Función Pulmonar</option>
                                    <option value="Mapeo Cerebral">Mapeo Cerebral</option>
                                    <option value="Medicina Nuclear">Medicina Nuclear</option>
                                    <option value="Procedimientos de Neumonología">Procedimientos de Neumonología</option>
                                    <option value="Ultrasonido">Ultrasonido</option>
                                </select>
                            </div>
                            <small id="helpId1" class="form-text text-muted notification"></small>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="text-primary" for="">Estudio</label>
                            <input title="Escriba el estudio a realizar" class="form-control mb-3" name="value2"
                                placeholder="Estudio">
                            <small id="helpId2" class="form-text text-muted notification"></small>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <label class="text-primary" for="">Notas</label>
                            <textarea title="Ingrese las indicaciones del medicamento" class="form-control mb-3" name="coments"
                                rows="2" placeholder="Notas"></textarea>
                            <small id="helpId2" class="form-text text-muted notification"></small>
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <button id="regresar2" class="btn btn-primary btn-block btn-lg">Regresar</button>
                        </div>
                        <div class="col-6">
                            <button id="submit_update"
                                class="d-none m-0 btn btn-success btn-block btn-lg">Actualizar</button>
                            <button id="submit_store"
                                class="d-none m-0 btn btn-success btn-block btn-lg">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


</template>
<!-- model-modal- laboratorios -->
<template id="artefacto_0028">
    <div class="overlay-wrapper">
        <div class="overlay text-primary d-none">
            <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
            <div class="text-bold pt-2"> Por favor espere un momento...</div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <h1 id="title_modal" class="text-primary">
                    <i class="modal-icon"></i> <span class="modal-title">Laboratorios</span>
                </h1>
            </div>
        </div>
        <ul class="nav nav-pills d-none mb-3 justify-content-end" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-page1-tab" data-toggle="pill" href="#pills-page1" role="tab"
                    aria-controls="pills-page1" aria-selected="true">

                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link h3" id="pills-page2-tab" data-toggle="pill" href="#pills-page2"
                    role="tab" aria-controls="pills-page2" aria-selected="false">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
            </li>

        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-page1" role="tabpanel"
                aria-labelledby="pills-page1-tab">
                <a id="item_create" class="h3 cursor-pointer float-right text-primary">
                    Añadir <span class="modal-btn-create">Laboratorio</span>
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a>

                <table class="table table-bordered bg-white mb-3">
                    <thead>
                        <tr>
                            <th class="text-primary text-center">Fecha de Subida</th>
                            <th class="text-primary text-center">Archivo</th>
                            <th class="text-primary text-center">Tipo</th>
                            <th class="text-primary text-center">Comentarios</th>
                            <th class="text-primary text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6 offset-3">
                            <a id="regresar" class="btn bg-primary text-primary btn-block btn-lg"
                                data-dismiss="modal" aria-label="Close">Regresar</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-page2" role="tabpanel" aria-labelledby="pills-page2-tab">
                <form>
                    <div class="container-fluid">
                        <div id="form" class="row">
                            <div class="col-12">
                                <div class="form-group mb-1">
                                    <label class="text-primary cursor-pointer" for="">Seleccione
                                        archivos</label>
                                    <input type="file" name="file" id="file" multiple
                                        class="form-control" style="height: 45px;"
                                        accept=".doc,.docx,.txt,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,audio/.mp3,.ogg,.png, .jpg, .jpeg,.bmp,.pdf,.ppt,.pptx,.gif">
                                </div>
                                <small id="helpId1" class="mb-3 form-text text-muted notification"><b>Formatos
                                        permitidos:</b>.doc, .docx, .txt, .mp3, .ogg, .png, .jpg, .jpeg, .bmp, .pdf,
                                    .ppt, .pptx, .gif</small>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label class="text-primary" for="">Comentarios</label>
                                <textarea class="form-control mb-3" name="coments" rows="2" placeholder="Escribe tus comentarios..."></textarea>
                                <small id="helpId2" class="form-text text-muted notification"></small>
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <button id="regresar2" class="btn btn-primary btn-block btn-lg">Regresar</button>
                            </div>
                            <div class="col-6">
                                <button id="submit_update"
                                    class="d-none m-0 btn btn-success btn-block btn-lg">Actualizar</button>
                                <button id="submit_store"
                                    class="d-none m-0 btn btn-success btn-block btn-lg">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>
<!-- registro paciente medico  gestion de citas -->
<template id="artefacto_0029">
    <!-- Form User Create externo -->
    <div class="row w-100 justify-content-center">
        <div class="col-8">
            <form>
                <div class="container">
                    <div class="overlay-wrapper pb-5">
                        <div class="overlay d-none">
                            <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                            <div class="text-bold text-primary pt-2">Por favor espere...</div>
                        </div>


                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h3 class="text-primary font-weight-bold">Nuevo Paciente</h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <label class="text-primary" for="cedula">Foto</label>
                                <div class="d-flex items-align-center">
                                    <div class="fileImageInput">
                                        <label class="heartbeat cursor-pointer" for="userImage"
                                            style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                            <img onerror="reemplaza_imagen(this)" id="userImagePreview"
                                                style="height:100%;width: inherit;" src="/image/system/patient.svg"
                                                alt="User Avatar">
                                        </label>
                                        <input id="userImage" name="imagen" type="file" style="display:none"
                                            accept="image/jpg, jpeg, bmp, png">
                                        <span class="filename"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group mt-xs-6">
                                    <label class="text-primary" for="cedula">Documento de identidad</label>
                                    <div id="no_edit_cedula"></div>
                                    <table class="w-100">
                                        <tr>
                                            <td style="width: 20%">
                                                <select class="form-control" title="Seleccione una nacionalidad"
                                                    name="nacionalidad" id="nacionalidad">
                                                    <option value="V">V</option>
                                                    <option value="E">E</option>
                                                    <option value="P">P</option>
                                                    <option value="J">J</option>
                                                </select>
                                                <small id="help_nacionalidad" class="notification"></small>
                                            </td>
                                            <td>
                                                <input required title="Un Documento de identidad es requerido"
                                                    type="text" class="form-control"
                                                    name="cedula" id="cedula" aria-describedby="helpId"
                                                    placeholder="">
                                                <small id="help_cedula" class="notification"></small>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <div class="col-md-5">
                                <div class="form-group mt-xs-6">
                                    <label class="text-primary" for="email">Correo Electrónico</label>
                                    <div id="no_edit_email"></div>
                                    <input type="text" required title="Un Correo Electrónico es requerido"
                                        name="email" id="email" class="form-control"
                                        aria-describedby="helpEmail">
                                    <small id="help_email" class="notification"></small>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-primary" for="nombre">Nombres</label>
                                    <div id="no_edit_nombres"></div>
                                    <input type="text" required title="Tu primer y segundo nombre son requeridos"
                                        class="form-control" name="nombres" id="nombres"
                                        aria-describedby="helpId" placeholder="">
                                    <small id="help_nombres" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-primary" for="apellido">Apellidos</label>
                                    <div id="no_edit_apellidos"></div>
                                    <input type="text" title="Tu primer y segundo apellido son requeridos"
                                        required class="form-control" name="apellidos" id="apellidos"
                                        aria-describedby="helpId" placeholder="">
                                    <small id="help_apellidos" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-primary" for="genero">Género</label>
                                    <div id="no_edit_genero"></div>
                                    <select class="form-control required" name="genero" id="genero"
                                        aria-describedby="helpId" placeholder="">
                                        <option value="m">Masculino</option>
                                        <option value="f">Femenino</option>
                                    </select>
                                    <small id="help_genero" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-primary" for="fnacimiento">Fecha de nacimiento</label>
                                    <input type="date" required title="Tu Fecha de nacimiento es requerida"
                                        class="form-control" name="fnacimiento" id="fnacimiento"
                                        aria-describedby="helpId" placeholder="">
                                    <small id="help_fnacimiento" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-primary" for="telefono_movil">Teléfono Contacto</label>
                                    <input type="tel" required title="Un teléfono de contacto es requerido"
                                        onkeyup="validarPrimerDigito('telefono_movil')" class="form-control"
                                        name="telefono_movil" id="telefono_movil" aria-describedby="helpId"
                                        placeholder="">
                                    <small id="help_telefono_movil" class="notification">(preferiblemente
                                        vinculado a
                                        <i class="text-success">Whatsapp</i>)</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group box-cat_estado_id">
                                    <label class="text-primary" for="cat_estado_id">Estado</label><br>
                                    <select required title="Un Estado es requerido" class="form-control select2"
                                        name="cat_estado_id" id="cat_estado_id" aria-describedby="helpId"
                                        placeholder=""></select>
                                    <small id="help_cat_estado_id" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group box-cat_municipio_id">
                                    <label class="text-primary" for="cat_municipio_id">Municipio</label><br>
                                    <select required title="Un Municipio es requerido" class="form-control select2"
                                        name="cat_municipio_id" id="cat_municipio_id" aria-describedby="helpId"
                                        placeholder=""></select>
                                    <small id="help_cat_municipio_id" class="notification"></small>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-primary" for="description">Ciudad</label>
                                    <input required title="Una Ciudad es requerida" type="text"
                                        class="form-control" name="description" id="description"
                                        aria-describedby="helpId" placeholder="">
                                    <small id="help_description" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-primary" for="domicilio">Domicilio</label>
                                    <input required title="Tu domicilio es requerido" class="form-control"
                                        name="domicilio" id="domicilio">
                                    <small id="help_domicilio" class="notification"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-none col-6">
                                <label class="text-primary" for="cedula">Foto de Tarjeta Soy CMDLT</label>
                                <div class="d-flex items-align-center">
                                    <div class="fileImageInput">
                                        <label class="heartbeat cursor-pointer" for="imgSoyChacao"
                                            style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                            <img onerror="reemplaza_imagen(this)" id="imgSoyChacaoPreview"
                                                style="height:100%;width: inherit;" src="/image/system/card.svg"
                                                alt="User Avatar">
                                        </label>
                                        <input id="imgSoyChacao" name="imgSoyChacao" type="file"
                                            style="display:none" accept="image/jpg, jpeg, bmp, png">
                                        <span class="filename"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="text-primary" for="cedula">Foto de Documento de Identidad</label>
                                <div class="d-flex items-align-center">
                                    <div class="fileImageInput">
                                        <label class="heartbeat cursor-pointer" for="imgDocIdentidad"
                                            style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                            <img onerror="reemplaza_imagen(this)" id="imgDocIdentidadPreview"
                                                style="height:100%;width: inherit;" src="/image/system/card.svg"
                                                alt="User Avatar">
                                        </label>
                                        <input id="imgDocIdentidad" name="imgDocIdentidad" type="file"
                                            style="display:none" accept="image/jpg, jpeg, bmp, png">
                                        <span class="filename"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        {{-- <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="text-primary" for="tarjeta_soy_chacao">Código Tarjeta Soy CMDLT <i class="text-gray">(Si tiene la tarjeta)</i></label>
                                    <input title="El código de la tarjeta está en la parte posterior de la misma."
                                        class="form-control border-0" readonly name="tarjeta_soy_chacao">
                                    <small id="help_tarjeta_soy_chacao" class="notification"></small>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row my-2 justify-content-center">

                            <div class="col-6">
                                <button id="submit" type="submit"
                                    class="btn btn-success btn-block">Registrar</button>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
            </form>
        </div>
    </div>

</template>
<!-- row buscador -->
<template id="artefacto_0030">
    <tr>
        <td class="p-0">
            <div class="container-fluid p-0 m-0">
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-column " style="width: fit-content">
                        <i class="tag-exonerado d-none text-right font-weight-bold px-3 align-items-center"
                            style="border-bottom-right-radius: 20px;"><i class="fas fa-check-double"></i>
                            Exonerado</i>
                    </div>
                    <div class="d-flex flex-column justify-content-end" style="width: fit-content">
                        <div class="d-none tag-condicion-cortesia-referido text-right font-weight-bold px-3 border">
                        </div>
                        <div class="d-none tag-condicion-cortesia text-right font-weight-bold px-3 bg-success"
                            style="border-bottom-left-radius: 20px;">Particular</div>
                    </div>
                </div>
                <div class="d-flex flex-row" style="height:100%">
                    <div class="flex-fill align-self-start flex-grow-1 border-right">
                        <div class="d-flex flex-row  border-bottom">
                            <div class="d-flex" style="align-items: center;">
                                <div class="m-1">
                                    <img onerror="this.src='/image/system/icono-paciente-blanco.svg';"
                                        loading="lazy"
                                        src="/image/system/icono-paciente-blanco.svg"
                                        style="width:1.5cm;height:1.5cm" data-tippy-content="Imagen del paciente"
                                        class="card-item-paciente-imagen tooltip-primary border border-primary card-item-paciente-image rounded-circle mx-auto d-block"
                                        alt="...">
                                </div>
                                <div>
                                    <div>
                                        <h4 data-tippy-content="Nombre del paciente"
                                            class="tooltip-primary card-item-paciente-fullname text-primary"
                                            style="margin-bottom: 0;white-space: normal;">Sample Nombre Sample
                                            Apellido</h4>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="d-flex flex-fill  align-self-start">
                                <div class="d-flex  flex-column flex-fill align-items-center">
                                    <div data-tippy-content="Documento de identidad del paciente"
                                        class="tooltip-primary d-flex flex-fill justify-content-center">
                                        <b class="text-primary" style="font-size:0.8em;">Cédula</b>
                                    </div>
                                    <div class="d-flex flex-fill justify-content-center">
                                        <div class="text-gray text-nowrap overflow-hidden card-item-paciente-cedula">
                                            0.000.000</div>
                                    </div>
                                </div>
                                <div data-tippy-content="Edad del paciente"
                                    class="tooltip-primary d-flex flex-column  flex-fill align-items-center border-left border-right">
                                    <div class="d-flex flex-fill justify-content-center">
                                        <b class="text-primary" style="font-size:0.8em;">Edad</b>
                                    </div>
                                    <div class="d-flex flex-fill justify-content-center">
                                        <div class="text-gray card-item-paciente-edad">00</div>
                                    </div>
                                </div>
                                <div data-tippy-content="Genero del paciente"
                                    class="tooltip-primary d-flex flex-column flex-fill align-items-center">
                                    <div class="d-flex flex-fill justify-content-center">
                                        <b class="text-primary" style="font-size:0.8em;">Sexo</b>
                                    </div>
                                    <div class="d-flex p-1 flex-fill justify-content-center">
                                        <div class="text-gray card-item-paciente-genero">n/i</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- <small style="color:#F4F7F7">#9999</small> --}}
        </td>
        <td class="p-0 card-item-tarjeta-soy-chacao text-center">
            <div class="container-fluid p-0 m-0">
                <div class="d-flex flex-column">
                    {{-- <div class="tarjeta-salud-chacao pb-1">
                        <div class="text-center">
                            <b class="text-gray" style="font-size:0.9em;">Soy CMDLT</b>
                        </div>
                        <div class="d-flex justify-content-center w-100">
                            <div class="badge text-black badge-gray card-item-paciente-tarjeta-chacao">No
                                posee</div>
                        </div>
                    </div> --}}
                    <div>
                        <div class="text-center">
                            <b class="text-primary" style="font-size:0.9em;">
                                Teléfono Contacto
                            </b>
                        </div>
                        <div class="d-flex flex-fill mb-1 justify-content-center">
                            <a class="enlace-whatsapp btn btn-default mx-1 btn-block text-nowrap btn-sm tooltip-primary"
                                data-tippy-content="Teléfono contacto del paciente: +No Indicado">
                                <i class="fab fa-whatsapp enlace-whatsapp text-success" aria-hidden="true"></i>
                                <span class=" enlace-whatsapp card-item-paciente-telefono-movil">+580000000000</span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </td>
        <td class="p-0 card-item-total-citas text-center">0</td>
        <td class="botones-fila" style="width: 160px;">

            <a class="btn btn-success btn-block btn-sm buscador_nueva_cita mb-1" href="#" role="button">
                <i class="buscador_nueva_cita"></i> Nueva Cita
            </a>
            <a class="btn btn-info btn-block btn-sm paciente-edit mb-1" href="#" role="button">
                <i class="fas fa-edit paciente-edit"></i> Editar
            </a>
            <a title="Historial de citas completadas"
                class="btn btn-primary btn-block btn-sm paciente-historial-citas mb-1" href="#"
                role="button">
                <i class="fas fa-history paciente-historial-citas"></i> Historial
            </a>
        </td>
    </tr>
</template>
<!-- item historial de citas -->
<template id="artefacto_0031">
    <li class="nav-item " role="presentation">
        <a class="nav-link p-0" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
            aria-controls="pills-home" aria-selected="true">
            <div class="d-flex p-1">
                <div class="header-historia-attr-date mx-2" title="Miercoles 27 de abril, 2022"
                    style="line-height:1">
                    <div class="d-flex p-0 flex-column align-items-center">
                        <div class="p-0 header-historia-day" style="font-size: 0.7rem;">MIE</div>
                        <div class="p-0 font-weight-bold header-historia-day-month" style="font-size:1em">27</div>
                        <div class="p-0 font-weight-bold header-historia-month" style="font-size: 0.7rem;">ABR</div>
                        <div class="p-0 header-historia-year" style="font-size: 0.6rem;">2022</div>
                    </div>
                </div>
                <div class="mx-2 border-left" style="line-height:1">
                    <div class="d-flex px-2 flex-column align-items-left">
                        <div class="cita_actual  p-1 float-right d-none badge badge-info"
                            style="font-size: 0.7rem;">
                            Cita actual</div>
                        <div class="p-0 header-historia-doctor " style="font-size: 0.7rem;">Dra. Nina Blanco</div>
                        <div class="header-historia-especiality p-0 font-weight-bold" style="font-size:1em">
                            Ginecología y obstetricia</div>
                        <div class="header-historia-address p-0" style="font-size: 0.7rem;">Centro de Especialidades
                            los Palos Grande (CELPG)</div>
                    </div>
                </div>

            </div>
        </a>
    </li>
</template>
<!-- row para laboratorios, imagenes, fotografias, otros archivos -->
<template id="artefacto_0032">
    <tr>
        <td valign="middle" align="center">
            14 de Abril, 2022
        </td>
        <td class="p-0">
            <a target="_blank" href="#" class="btn btn-default btn-block border-0">
                <span class="mailbox-attachment-icon heartbeat"><i></i></span>
            </a>
        </td>
        <td valign="middle" class="text-center font-weight-bold text-gray">
            PDF
        </td>
        <td class="p-0">
            <textarea name="" class="border-0 form-control" id="" rows="5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius delectus libero labore ipsam voluptate in? Eligendi, doloremque? Optio quis sequi est tempora. Rem eum at placeat impedit ipsa dolorem a!</textarea>

        </td>
        <td valign="middle" nowrap align="center">
            <button title="Editar valor" class="row-item_edit  btn btn-default text-primary"><i
                    class="row-item_edit fa fa-edit" aria-hidden="true"></i></button>

            <button title="Eliminar valor" class="row-item_delete  btn btn-danger"><i
                    class="row-item_delete fa fa-minus" aria-hidden="true"></i></button>
        </td>
    </tr>
</template>
<!-- item modal citas previas completadas -->
<template id="artefacto_0033">
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="#" data-dismiss="modal" aria-label="Close"
                    class="buscador_nueva_cita btn btn-primary btn-block mb-3" data-cedula="226.955"
                    data-user_id_paciente="19">Nueva Cita</a>
                <div class="card-paciente"></div>


            </div>

            <div class="col-md-9">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title text-primary font-weight-bold">Citas previas completadas</h3>
                        {{-- <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="Search Mail">
                                <div class="input-group-append">
                                    <div class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                    </div>

                    <div class="card-body">

                        <div class="table-responsive mailbox-messages">
                            <div class="overlay-wrapper">
                                <div class="overlay text-primary d-none">
                                    <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                                    <div class="text-bold pt-2"> Por favor espere un momento...</div>
                                </div>
                                <table class="table table-hover table-striped">
                                    <tbody>



                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>


                </div>

            </div>

        </div>

    </section>
</template>
<!-- item modal tabla citas previas completadas -->
<template id="artefacto_0034">
    <tr class="cursor-pointer">
        <td>
            <div class="header-historia-attr-date mx-2" title="Miercoles 27 de abril, 2022" style="line-height:1">
                <div class="d-flex p-0 flex-column align-items-center">
                    <div class="p-0 header-historia-day" style="font-size: 0.7rem;">MARZO</div>
                    <div class="p-0 font-weight-bold header-historia-day-month" style="font-size:1em">4</div>
                    <div class="p-0 font-weight-bold header-historia-month" style="font-size: 0.7rem;">SEPTIEMBRE
                    </div>
                    <div class="p-0 header-historia-year" style="font-size: 0.6rem;">2022</div>
                </div>
            </div>
        </td>

        <td class="mailbox-name">
            <div class="d-flex px-2 flex-column align-items-left">
                <div class="p-0 header-historia-doctor text-primary" style="font-size: 0.7rem;">Stefania Robles
                </div>
                <div class="header-historia-especiality p-0 font-weight-bold" style="font-size:1em">Ginecología y
                    Obstetricia</div>
                <div class="p-0 header-historia-address" style="font-size: 0.7rem;">Centro de Especialidades los
                    Palos
                    Grande (CELPG)</div>

            </div>
        </td>
        <td class="mailbox-name " style="font-size: 0.8rem;">
            <b>Motivo de consulta:</b>
            <div class="header-historia-motivo_consulta">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Velit porro maxime officiis, quo labore et ratione laudantium nesciunt, adipisci debitis hic. Minima in
                qui eius fugit quod possimus magnam eligendi!</div>
        </td>
    </tr>
</template>
<!-- registro medico  -->
<template id="artefacto_0035">
    <!-- Form User Create externo -->
    <div class="row w-100 justify-content-center">
        <div class="col-8">
            <form>
                <div class="container">
                    <div class="overlay-wrapper pb-5">
                        <div class="overlay d-none">
                            <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                            <div class="text-bold text-primary pt-2">Por favor espere...</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h3 class="text-primary font-weight-bold">Nuevo Médico</h3>
                            </div>
                            <div id="btn_regresar" class="d-none col-md-12 text-center">
                                <button class="btn btn-primary btn-medico-index">Regresar</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label class="text-primary" for="cedula">Foto</label>
                                <div class="d-flex items-align-center">
                                    <div class="fileImageInput">
                                        <label class="heartbeat cursor-pointer" for="userImage"
                                            style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                            <img id="userImagePreview" onerror="reemplaza_imagen(this)"
                                                style="height:100%;width: inherit;" src="/image/system/patient.svg"
                                                alt="User Avatar">
                                        </label>
                                        <input id="userImage" accept=".png,.jpg, .jpeg, .bmp" type="file"
                                            style="display:none" accept="image/jpg, jpeg, bmp, png">
                                        <span class="filename"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group mt-xs-6">
                                    <label class="text-primary" for="cedula">Documento de identidad</label>
                                    <table class="w-100">
                                        <tr>
                                            <td style="width: 20%">
                                                <select class="form-control" title="Seleccione una nacionalidad"
                                                    name="nacionalidad" id="nacionalidad">
                                                    <option value="V">V</option>
                                                    <option value="E">E</option>
                                                    <option value="P">P</option>
                                                    <option value="J">J</option>
                                                </select>
                                                <small id="help_nacionalidad" class="notification"></small>
                                            </td>
                                            <td>
                                                <input required title="Un Documento de identidad es requerido"
                                                    type="number" class="form-control"
                                                    name="cedula" id="cedula" aria-describedby="helpId"
                                                    placeholder="">
                                                <small id="help_cedula" class="notification"></small>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <div class="col-md-5">
                                <div class="form-group mt-xs-6">
                                    <label class="text-primary" for="email">Correo Electrónico</label>
                                    <input type="text" required title="Un Correo Electrónico es requerido"
                                        name="email" id="email" class="form-control"
                                        aria-describedby="helpEmail">
                                    <small id="help_email" class="notification"></small>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-primary" for="nombre">Nombres</label>
                                    <input type="text" required title="Tu primer y segundo nombre son requeridos"
                                        class="form-control" name="nombres" id="nombres"
                                        aria-describedby="helpId" placeholder="">
                                    <small id="help_nombres" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-primary" for="apellido">Apellidos</label>
                                    <input type="text" title="Tu primer y segundo apellido son requeridos"
                                        required class="form-control" name="apellidos" id="apellidos"
                                        aria-describedby="helpId" placeholder="">
                                    <small id="help_apellidos" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-primary" for="genero">Género</label>
                                    <select class="form-control required" name="genero" id="genero"
                                        aria-describedby="helpId" placeholder="">
                                        <option value="m">Masculino</option>
                                        <option value="f">Femenino</option>
                                    </select>
                                    <small id="help_genero" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-primary" for="fnacimiento">Fecha de nacimiento</label>
                                    <input type="date" required title="Tu Fecha de nacimiento es requerida"
                                        class="form-control" name="fnacimiento" id="fnacimiento"
                                        aria-describedby="helpId" placeholder="">
                                    <small id="help_fnacimiento" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-primary" for="telefono_movil">Teléfono Contacto</label>
                                    <input type="tel" required title="Un teléfono de contacto es requerido"
                                        onkeyup="validarPrimerDigito('telefono_movil')" class="form-control"
                                        name="telefono_movil" id="telefono_movil" aria-describedby="helpId"
                                        placeholder="">
                                    <small id="help_telefono_movil" class="notification">(preferiblemente
                                        vinculado a
                                        <i class="text-success">Whatsapp</i>)</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group box-cat_estado_id">
                                    <label class="text-primary" for="cat_estado_id">Estado</label><br>
                                    <select required title="Un Estado es requerido" class="form-control select2"
                                        name="cat_estado_id" id="cat_estado_id" aria-describedby="helpId"
                                        placeholder=""></select>
                                    <small id="help_cat_estado_id" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group box-cat_municipio_id">
                                    <label class="text-primary" for="cat_municipio_id">Municipio</label><br>
                                    <select required title="Un Municipio es requerido" class="form-control select2"
                                        name="cat_municipio_id" id="cat_municipio_id" aria-describedby="helpId"
                                        placeholder=""></select>
                                    <small id="help_cat_municipio_id" class="notification"></small>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-primary" for="description">Ciudad</label>
                                    <input required title="Una Ciudad es requerida" type="text"
                                        class="form-control" name="description" id="description"
                                        aria-describedby="helpId" placeholder="">
                                    <small id="help_description" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-primary" for="domicilio">Domicilio</label>
                                    <input required title="Tu domicilio es requerido" class="form-control"
                                        name="domicilio" id="domicilio">
                                    <small id="help_domicilio" class="notification"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-none col-6">
                                <label class="text-primary" for="cedula">Foto de Tarjeta Soy CMDLT</label>
                                <div class="d-flex items-align-center">
                                    <div class="fileImageInput">
                                        <label class="heartbeat cursor-pointer" for="imgSoyChacao"
                                            style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                            <img id="imgSoyChacaoPreview" onerror="reemplaza_imagen(this)"
                                                style="height:100%;width: inherit;" src="/image/system/card.svg"
                                                alt="User Avatar">
                                        </label>
                                        <input id="imgSoyChacao" accept=".png,.jpg, .jpeg, .bmp" type="file"
                                            style="display:none" accept="image/jpg, jpeg, bmp, png">
                                        <span class="filename"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="text-primary" for="cedula">Foto de Documento de Identidad</label>
                                <div class="d-flex items-align-center">
                                    <div class="fileImageInput">
                                        <label class="heartbeat cursor-pointer" for="imgDocIdentidad"
                                            style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                            <img id="imgDocIdentidadPreview" onerror="reemplaza_imagen(this)"
                                                style="height:100%;width: inherit;" src="/image/system/card.svg"
                                                alt="User Avatar">
                                        </label>
                                        <input id="imgDocIdentidad" accept=".png,.jpg, .jpeg, .bmp" type="file"
                                            style="display:none" accept="image/jpg, jpeg, bmp, png">
                                        <span class="filename"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row d-none">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="text-primary" for="tarjeta_soy_chacao">Código Tarjeta Soy
                                        CMDLT <i class="text-gray">(Si tiene la tarjeta)</i></label>
                                    <input required
                                        title="El código de la tarjeta está en la parte posterior de la misma."
                                        class="form-control border-0" name="tarjeta_soy_chacao">
                                    <small id="help_tarjeta_soy_chacao" class="notification"></small>
                                </div>
                            </div>
                        </div>
                        <!-- info del medico -->
                        <div class="info-medico rounded">
                            <div class="row">
                                <div class="col-6">
                                    <label class="text-primary" for="cat_especialidad_id">Miembro del equipo de
                                        salud</label>
                                    <select name="cat_user_equipo_salud_id" id="cat_user_equipo_salud_id"
                                        class="form-control">
                                        <option value="1">Médico(a)</option>
                                        <option value="2">Enfermero(a)</option>
                                        <option value="3">Estudiante de medicina</option>
                                        <option value="4">Estudiante de enfermería</option>
                                        <option value="5">Atención al paciente</option>
                                        <option value="6">Licenciada/o</option>

                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="text-primary" for="cat_especialidad_id">Especialidad</label>
                                    <div class="select2-cat_especialidad_id">
                                        <select class="select2 cat_especialidad_id" id="cat_especialidad_id"
                                            name="cat_especialidad_id" multiple="multiple">

                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="row mt-6">
                                <div class="col-6">
                                    <label class="text-primary" for="cat_medico_posicion_id">Posisión o
                                        cargo</label>
                                    <select name="cat_medico_posicion_id" id="cat_medico_posicion_id"
                                        class="form-control">
                                        <option value="1">Tratante</option>
                                        <option value="2">Interconsultante</option>
                                        <option value="3">Fellow I</option>
                                        <option value="4">Fellow II</option>
                                        <option value="5">Residente I</option>
                                        <option value="6">Residente II</option>
                                        <option value="7">Residente III</option>
                                        <option value="8">Residente IV</option>
                                        <option value="9">RAMH</option>
                                        <option value="10">Enfermería</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="text-primary" for="prefijo">Prefijo</label>
                                    <select name="prefijo" id="prefijo" class="form-control">
                                        <option aria-label="Doctor" value="Dr.">Dr.</option>
                                        <option aria-label="Doctora" value="Dra.">Dra.</option>
                                        <option aria-label="Licenciado" value="Licdo.">Licdo.</option>
                                        <option aria-label="Licenciada" value="Licda.">Licda.</option>
                                        <option aria-label="Bachiller" value="Br.">Br.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="text-primary" for="firma">Subir Firma</label>
                                    <div class="d-flex items-align-center">
                                        <div class="fileImageInput">
                                            <label class="heartbeat cursor-pointer" for="firma"
                                                style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                                <img id="firmaPreview" onerror="reemplaza_imagen(this)"
                                                    style="height:100%;width: inherit;" src="/image/user/firma/firma_patientcare_default.png"
                                                    alt="User Avatar">
                                            </label>
                                            <input id="firma" accept=".png, .jpg, .jpeg, .bmp" type="file"
                                                style="display:none" accept="image/jpg, image/jpeg, image/bmp, image/png">
                                            <span class="filename"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="text-primary" for="sello">Subir Sello</label>
                                    <div class="d-flex items-align-center">
                                        <div class="fileImageInput">
                                            <label class="heartbeat cursor-pointer" for="sello"
                                                style="display:flex; align-items:center;border:2px dashed rgb(190, 189, 189); height:100px;width:100%">
                                                <img id="selloPreview" onerror="reemplaza_imagen(this)"
                                                    style="height:100%;width: inherit;" src="/image/user/sello/sello_patientcare_default.png"
                                                    alt="User Avatar">
                                            </label>
                                            <input id="sello" accept=".png, .jpg, .jpeg, .bmp" type="file"
                                                style="display:none" accept="image/jpg, image/jpeg, image/bmp, image/png">
                                            <span class="filename"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="text-primary" for="colegio_medicos">Colegio de médicos N°</label>
                                    <input title="Un número de colegio médico es requerido." name="colegio_medico"
                                        id="colegio_medico" type="text" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label class="text-primary" for="mpps">MPPS N°</label>
                                    <input title="Un número del MPPS es requerido." name="mpps" id="mpps"
                                        type="text" class="form-control">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label class="text-primary mt-2" for="colegio_medicos">Centros de salud en los
                                        que
                                        dará atención médica</label>
                                    <div class="card">
                                        <div class="card-body">
                                            <table id="list_centros_salud" class="table bg-white table-bordered">
                                                <tbody>
                                                    {{-- <tr>
                                                        <td scope="row">
                                                            <input type="checkbox"
                                                                class="form-control input-centro-salud" value="2"
                                                                name="centro_salud[]">
                                                        </td>
                                                        <td>Ambulatorio Chacao</td>

                                                    </tr>
                                                    <tr>
                                                        <td scope="row">
                                                            <input type="checkbox"
                                                                class="form-control input-centro-salud" value="2"
                                                                name="centro_salud[]">
                                                        </td>
                                                        <td>Centro de Especialidades los Palos Grande (CELPG)</td>

                                                    </tr>
                                                    <tr>
                                                        <td scope="row">
                                                            <input type="checkbox"
                                                                class="form-control input-centro-salud" value="3"
                                                                name="centro_salud[]">
                                                        </td>
                                                        <td>Ambulatorio Altamira</td>

                                                    </tr>
                                                    <tr>
                                                        <td scope="row">
                                                            <input type="checkbox"
                                                                class="form-control input-centro-salud" value="4"
                                                                name="centro_salud[]">
                                                        </td>
                                                        <td>CEQ Viseteca - Av Avila</td>

                                                    </tr>
                                                    <tr>
                                                        <td scope="row">
                                                            <input type="checkbox"
                                                                class="form-control input-centro-salud" value="4"
                                                                name="centro_salud[]">
                                                        </td>
                                                        <td>CEQ Viseteca - Av Avila</td>

                                                    </tr> --}}
                                                    {{-- <tr>
                                                        <td scope="row">
                                                            <input type="checkbox"
                                                                class="form-control input-centro-salud" value="4"
                                                                name="centro_salud[]">
                                                        </td>
                                                        <td>CEQ Viseteca - Av Avila</td>

                                                    </tr> --}}
                                                </tbody>
                                            </table>
                                        </div>


                                    </div>

                                </div>


                            </div>

                        </div>



                        <div class="row my-2 justify-content-center">

                            <div class="col-6">
                                <button id="submit" type="submit"
                                    class="btn btn-success btn-block">Registrar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

</template>
<!-- formunario nueva agenda -->
<template id="artefacto_0036">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12 text-center">
                <h3 class="text-primary font-weight-bold">Nueva Agenda</h3>
            </div>
            <div class="col-12 text-center">
                <button class="btn btn-primary btn-medico-index">Regresar</button>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-8">
                <form action="">
                    <section>
                        <div class="d-flex align-items-center  m-1">
                            <div>
                                <div class="bg-primary rounded-circle float-left p-1 text-center text-white"
                                    style="width:30px">1</div>
                            </div>
                            <div>
                                <label class="text-primary mt-1 ml-1" for="">Seleccione Centro de
                                    salud</label>
                            </div>
                        </div>
                        <select class="ml-5 form-control" name="centro_salud_id" id="centro_salud_id">
                            <option value="1">Centro Salud 1</option>
                            <option value="2">Centro Salud 2</option>
                            <option value="3">Centro Salud 3</option>
                        </select>
                    </section>

                    <section>
                        <div class="d-flex align-items-center  m-1">
                            <div>
                                <div class="bg-primary rounded-circle float-left p-1 text-center text-white"
                                    style="width:30px">2</div>
                            </div>
                            <div>
                                <label class="text-primary mt-1 ml-1" for="">Seleccione Especialidad</label>
                            </div>
                        </div>

                        <select class="ml-5 form-control" name="cat_especialidad_id">
                            <option value="1">Especialidad 1</option>
                            <option value="2">Especialidad 2</option>
                            <option value="3">Especialidad 3</option>
                            <option value="4">Especialidad 4</option>
                        </select>
                    </section>
                    {{-- <section>
                <div class="d-flex align-items-center  m-1">
                  <div>
                    <div class="bg-primary rounded-circle float-left p-1 text-center text-white" style="width:30px">3</div>
                  </div>
                  <div>
                    <label class="text-primary mt-1 ml-1" for="">Seleccione Médico</label>
                  </div>
                </div>
                <select class="ml-5 form-control" name="user_id_medico">
                  <option value="1">Médico 1</option>
                  <option value="2">Médico 2</option>
                  <option value="3">Médico 3</option>
                </select>
              </section> --}}
                    <section>
                        <div class="d-flex align-items-center  m-1">
                            <div>
                                <div class="bg-primary rounded-circle float-left p-1 text-center text-white"
                                    style="width:30px">4</div>
                            </div>
                            <div>
                                <label class="text-primary mt-1 ml-1" for="">Seleccione Mes</label>
                            </div>
                        </div>
                        <div class="ml-5 bg-light mb-2">
                            <input id="todo_el_anio" type="checkbox" name="agenda_month" checked
                                value="12">Todo el año
                            </option>
                        </div>
                        <div class="ml-5 row">
                            <div class="col-3">
                                <input type="checkbox" name="agenda_month" checked value="0">Enero</br>
                                <input type="checkbox" name="agenda_month" checked value="4">Mayo</br>
                                <input type="checkbox" name="agenda_month" checked value="8">Septiembre</br>
                            </div>
                            <div class="col-3">
                                <input type="checkbox" name="agenda_month" checked value="1">Febrero</br>
                                <input type="checkbox" name="agenda_month" checked value="5">Junio</br>
                                <input type="checkbox" name="agenda_month" checked value="9">Octubre</br>

                            </div>
                            <div class="col-3">
                                <input type="checkbox" name="agenda_month" checked value="2">Marzo</br>
                                <input type="checkbox" name="agenda_month" checked value="6">Julio</br>
                                <input type="checkbox" name="agenda_month" checked value="10">Noviembre</br>
                            </div>
                            <div class="col-3">
                                <input type="checkbox" name="agenda_month" checked value="3">Abril</br>
                                <input type="checkbox" name="agenda_month" checked value="7">Agosto</br>
                                <input type="checkbox" name="agenda_month" checked value="11">Diciembre</br>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="d-flex align-items-center  m-1">
                            <div>
                                <div class="bg-primary rounded-circle float-left p-1 text-center text-white"
                                    style="width:30px">5</div>
                            </div>
                            <div>
                                <label class="text-primary mt-1 ml-1" for="">Seleccione Días</label>
                            </div>
                        </div>

                        <div class="ml-5 bg-light mb-2">
                            <input id="todos_los_dias" type="checkbox" name="agenda_day_week"
                                value="7">Todos los días
                            </option> <br>
                        </div>
                        <div class="ml-5 row">
                            <div class="col-12">
                                <table class="table table-bordered bg-white">
                                    <thead>
                                        <tr>
                                            <th>Día</th>
                                            <th class="text-center">
                                                Mañana
                                                <div class="text-gray text-center" style="font-size: 0.8rem;">(8:00
                                                    AM a 12:00 PM)</div>
                                            </th>
                                            <th class="text-center">
                                                Tarde
                                                <div class="text-gray text-center" style="font-size: 0.8rem;">(1:00
                                                    PM a 4:00 PM)</div>
                                            </th>
                                            <th class="text-center">
                                                Todo el día
                                                <div class="text-gray text-center" style="font-size: 0.8rem;">(8:00
                                                    AM a 4:00 PM)</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="agenda_day_week" checked
                                                    value="1"> Lunes
                                            </td>
                                            <td style="text-align:center;">
                                                <input type="radio" class="form-control agenda_hour"
                                                    data-day-week="1" name="agenda_hour_1" style="height: 20px;"
                                                    value="8:00-9:00-10:00-11:00-12:00" checked>
                                            </td>
                                            <td style="text-align:center;">
                                                <input type="radio" class="form-control agenda_hour"
                                                    data-day-week="1" name="agenda_hour_1" style="height: 20px;"
                                                    value="13:00-14:00-15:00-16:00">
                                            </td>
                                            <td style="text-align:center;">
                                                <div class="d-flex justify-content-center">
                                                    <div class="flex-fill" style="line-height: 0.5;">
                                                        <input type="radio" class="form-control agenda_hour"
                                                            data-day-week="1" name="agenda_hour_1"
                                                            style="height: 20px;"
                                                            value="8:00-9:00-10:00-11:00-12:00-13:00-14:00-15:00-16:00">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="agenda_day_week" checked
                                                    value="2"> Martes</td>
                                            <td style="text-align:center;">
                                                <input type="radio" class="form-control agenda_hour"
                                                    data-day-week="2" name="agenda_hour_2" style="height: 20px;"
                                                    value="8:00-9:00-10:00-11:00-12:00" checked>
                                            </td>
                                            <td style="text-align:center;">
                                                <input type="radio" class="form-control agenda_hour"
                                                    data-day-week="2" name="agenda_hour_2" style="height: 20px;"
                                                    value="13:00-14:00-15:00-16:00">
                                            </td>
                                            <td style="text-align:center;">
                                                <div class="d-flex justify-content-center">
                                                    <div class="flex-fill" style="line-height: 0.5;">
                                                        <input type="radio" class="form-control agenda_hour"
                                                            data-day-week="2" name="agenda_hour_2"
                                                            style="height: 20px;"
                                                            value="8:00-9:00-10:00-11:00-12:00-13:00-14:00-15:00-16:00">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="agenda_day_week" checked
                                                    value="3"> Miércoles</td>
                                            <td style="text-align:center;">
                                                <input type="radio" class="form-control agenda_hour"
                                                    data-day-week="3" name="agenda_hour_3" style="height: 20px;"
                                                    value="8:00-9:00-10:00-11:00-12:00" checked>
                                            </td>
                                            <td style="text-align:center;">
                                                <input type="radio" class="form-control agenda_hour"
                                                    data-day-week="3" name="agenda_hour_3" style="height: 20px;"
                                                    value="13:00-14:00-15:00-16:00">
                                            </td>
                                            <td style="text-align:center;">
                                                <div class="d-flex justify-content-center">
                                                    <div class="flex-fill" style="line-height: 0.5;">
                                                        <input type="radio" class="form-control agenda_hour"
                                                            data-day-week="3" name="agenda_hour_3"
                                                            style="height: 20px;"
                                                            value="8:00-9:00-10:00-11:00-12:00-13:00-14:00-15:00-16:00">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="agenda_day_week" checked
                                                    value="4"> Jueves</td>
                                            <td style="text-align:center;">
                                                <input type="radio" class="form-control agenda_hour"
                                                    name="agenda_hour_4" data-day-week="4" style="height: 20px;"
                                                    value="8:00-9:00-10:00-11:00-12:00" checked>
                                            </td>
                                            <td style="text-align:center;">
                                                <input type="radio" class="form-control agenda_hour"
                                                    name="agenda_hour_4" data-day-week="4" style="height: 20px;"
                                                    value="13:00-14:00-15:00-16:00">
                                            </td>
                                            <td style="text-align:center;">
                                                <div class="d-flex justify-content-center">
                                                    <div class="flex-fill" style="line-height: 0.5;">
                                                        <input type="radio" class="form-control agenda_hour"
                                                            name="agenda_hour_4" data-day-week="4"
                                                            style="height: 20px;"
                                                            value="8:00-9:00-10:00-11:00-12:00-13:00-14:00-15:00-16:00">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="agenda_day_week" checked
                                                    value="5"> Viernes</td>
                                            <td style="text-align:center;">
                                                <input type="radio" class="form-control agenda_hour"
                                                    name="agenda_hour_5" data-day-week="5" style="height: 20px;"
                                                    value="8:00-9:00-10:00-11:00-12:00" checked>
                                            </td>
                                            <td style="text-align:center;">
                                                <input type="radio" class="form-control agenda_hour"
                                                    name="agenda_hour_5" data-day-week="5" style="height: 20px;"
                                                    value="13:00-14:00-15:00-16:00">
                                            </td>
                                            <td style="text-align:center;">
                                                <div class="d-flex justify-content-center">
                                                    <div class="flex-fill" style="line-height: 0.5;">
                                                        <input type="radio" class="form-control agenda_hour"
                                                            name="agenda_hour_5" data-day-week="5"
                                                            style="height: 20px;"
                                                            value="8:00-9:00-10:00-11:00-12:00-13:00-14:00-15:00-16:00">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="agenda_day_week" value="6">
                                                Sábado</td>
                                            <td style="text-align:center;">
                                                <input type="radio" class="form-control agenda_hour"
                                                    name="agenda_hour_6" data-day-week="6" style="height: 20px;"
                                                    value="8:00-9:00-10:00-11:00-12:00">
                                            </td>
                                            <td style="text-align:center;">
                                                <input type="radio" class="form-control agenda_hour"
                                                    name="agenda_hour_6" data-day-week="6" style="height: 20px;"
                                                    value="13:00-14:00-15:00-16:00">
                                            </td>
                                            <td style="text-align:center;">
                                                <div class="d-flex justify-content-center">
                                                    <div class="flex-fill" style="line-height: 0.5;">
                                                        <input type="radio" class="form-control agenda_hour"
                                                            name="agenda_hour_6" data-day-week="6"
                                                            style="height: 20px;"
                                                            value="8:00-9:00-10:00-11:00-12:00-13:00-14:00-15:00-16:00">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="agenda_day_week" value="0">
                                                Domingo</td>
                                            <td style="text-align:center;">
                                                <input type="radio" class="form-control agenda_hour"
                                                    name="agenda_hour_0" data-day-week="0" style="height: 20px;"
                                                    value="8:00-9:00-10:00-11:00-12:00">
                                            </td>
                                            <td style="text-align:center;">
                                                <input type="radio" class="form-control agenda_hour"
                                                    name="agenda_hour_0" data-day-week="0" style="height: 20px;"
                                                    value="13:00-14:00-15:00-16:00">
                                            </td>
                                            <td style="text-align:center;">
                                                <div class="d-flex justify-content-center">
                                                    <div class="flex-fill" style="line-height: 0.5;">
                                                        <input type="radio" class="form-control agenda_hour"
                                                            name="agenda_hour_0" data-day-week="0"
                                                            style="height: 20px;"
                                                            value="8:00-9:00-10:00-11:00-12:00-13:00-14:00-15:00-16:00">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>

                    <section class="mt-2">
                        <button id="submit" class="btn btn-success btn-block">Crear Agenda</button>
                    </section>
                </form>
            </div>
        </div>
    </div>
</template>
<!-- card medico -->
<template id="artefacto_0037">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-primary font-weight-bold">Datos del paciente</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div id="profile_paciente" class="card-body box-profile p-0">
            <div class="text-center mt-1">
                <img class="profile-user-img preconsulta-paciente-imagen img-fluid img-circle"
                    src="/image/system/icono-paciente-blanco.svg"
                    style="width: 90px;height: 90px;object-fit: cover;" alt="User profile picture">
            </div>

            <h3 class="profile-username preconsulta-paciente-name text-center">Sample Name
            </h3>
            <ul class="list-group rounded bg-white list-group-unbordered ">
                <li class="list-group-item bg-transparent border-top-0 px-1">
                    <b class="text-secondary">Cédula</b> <a class="float-right preconsulta-paciente-cedula"></a>
                </li>
                <li class="list-group-item bg-transparent px-1">
                    <b class="text-secondary">Correo</b> <a class="float-right preconsulta-paciente-correo"></a>
                </li>
                <li class="list-group-item bg-transparent px-1">
                    <b class="text-secondary">Edad</b> <a class="float-right preconsulta-paciente-edad"></a>
                </li>
                <li class="list-group-item bg-transparent px-1">
                    <b class="text-secondary">Género</b> <a class="float-right preconsulta-paciente-genero"></a>
                </li>
                <li class="list-group-item bg-transparent px-1">

                    <b class="text-secondary">Teléfono</b>
                    <a target="_blank" href="https://api.whatsapp.com/send?phone=04149320905"
                        class="enlace-whatsapp btn btn-default border-0 float-right preconsulta-paciente-telefono-movil">
                        <i class="enlace-whatsapp fab fa-whatsapp text-success"></i> <span
                            class="enlace-whatsapp">04140000000</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>
<!-- listado medicos -->
<template id="artefacto_0038">
    <section class="col-lg-12">
        <div class="card">
            <div class="card-header border-transparent">


            </div>

            <div class="card-body">
                <div class="overlay-wrapper">
                    <div class="overlay text-primary d-none">
                        <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                        <div class="text-bold pt-2"> Por favor espere un momento...</div>
                    </div>

                    <div class="table-responsive">
                        <table id="citas_pacientes" class="table bg-white table-bordered table-hover">
                            <thead style="font-size: 1.2em;">
                                <tr>
                                    <th class="text-primary text-center" title="Día en que se solicitó la cita">
                                        Fecha
                                    </th>
                                    <th class="text-primary text-center">Medico</th>
                                    <th class="text-primary">Medico</th>
                                    <th class="text-primary">Especialidad</th>
                                    <th class="text-primary">Posición/Cargo</th>
                                    <th class="text-primary">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="7" class="text-primary text-center">
                                        Sin pacientes
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<!-- busqueda index -->
<template id="artefacto_0039">
    <section class="content">
        <div class="container-fluid">
            {{-- <h2 class="text-center display-4 text-primary">Buscador</h2> --}}

            <div class="row">

                <div class="col-md-10 offset-md-1">
                    <div class="table-responsive">
                        <table id="citas_pacientes" class="table bg-white table-bordered table-hover">
                            <thead style="font-size: 1.2em;">
                                <tr>
                                    <th colspan="2" class="text-primary text-center">Paciente
                                    </th>

                                    <th class="text-primary">Total Citas</th>
                                    <th class="text-primary">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4" class="text-primary text-center">
                                        Sin pacientes
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
</template>
<!-- create cita -->
<template id="artefacto_0040">
    <div class="container">

        <div class="form-row">
            <!-- cedula paciente -->
            <div class="col-md-8 offset-md-2 mb-3">
                <div
                    class="d-flex my-2 align-items-center">
                    <div>
                        <div class="form-number-input-cat_especialidad_id bg-primary rounded-circle"
                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                            1</div>
                    </div>
                    <div>
                        <!-- is-invalid -->
                        <label class="h5 m-0 text-primary"
                            for="validationServer03">Cédula de identidad del
                            paciente</label>
                            <small
                                title="Escribe un documento de identidad"
                                class="d-none notification cedula badge badge-info font-weight-normal"></small>
                    </div>
                </div>
                <input  name="user_id_paciente" type="hidden">
                <input  name="cedula" type="text" class="form-control">
                <small class="notification"></small>

            </div>
            <!-- especialidad -->
            <div class="col-md-8 offset-md-2 mb-3">
                <div
                    class="d-flex my-2 align-items-center">
                    <div>
                        <div class="form-number-input-cat_especialidad_id bg-primary rounded-circle"
                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                            2</div>
                    </div>
                    <div>
                        <!-- is-invalid -->
                        <label class="h5 m-0 text-primary"
                            for="validationServer03">Selecciona
                            la especialidad</label>
                            <small
                                title="Especialidades disponibles."
                                class="d-none notification cat_especialidad_id badge badge-info font-weight-normal"></small>
                    </div>
                </div>
                <select name="cat_especialidad_id"
                    class="custom-select "
                    id="validationServer03"
                    aria-describedby="validationServer02Feedback"
                    required>
                </select>
                <div id="validationServer03Feedback"
                    class="invalid-feedback cat_especialidad_id">
                    Por favor selecciona una especialidad.
                </div>
            </div>
            <!-- centro de salud -->
            <div class="col-md-8 offset-md-2 mb-3">
                <div
                    class="d-flex my-2 align-items-center">
                    <div>
                        <div class="form-number-input-centro_salud_id bg-primary rounded-circle"
                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                            3</div>
                    </div>
                    <div>
                        <!-- is-invalid -->
                        <label class="h5 m-0 text-primary"
                            for="validationServer03">Selecciona el Centro de Salud</label>
                            <small
                            title="Centros de Salud en donde se atiende esta centro-salud"
                                class="d-none notification centro_salud_id badge badge-info font-weight-normal"></small>
                    </div>
                </div>

                <select name="centro_salud_id"
                    class="custom-select "
                    id="validationServer04"
                    aria-describedby="validationServer04Feedback"
                    required>
                </select>
                <div id="validationServer04Feedback"
                    class="invalid-feedback centro_salud_id">
                    Por favor selecciona un Centro de Salud.
                </div>
            </div>
            <!-- user_id_medico -->
            <div class="col-md-8 offset-md-2 mb-3">
                <div
                    class="d-flex my-2 align-items-center">
                    <div>
                        <div class="form-number-input-user_id_medico bg-primary rounded-circle"
                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                            4</div>
                    </div>
                    <div>
                        <!-- is-invalid -->
                        <label class="h5 m-0 text-primary"
                            for="validationServer03">Selecciona el médico de tu preferencia</label>
                            <small
                            title="Médicos que atienden esta especialidad"
                                class="d-none notification user_id_medico badge badge-info font-weight-normal"></small>
                    </div>
                </div>

                <select name="user_id_medico"
                    class="custom-select "
                    id="validationServer05"
                    aria-describedby="validationServer05Feedback"
                    required>
                </select>
                <div id="validationServer05Feedback"
                    class="invalid-feedback user_id_medico">
                    Por favor selecciona un médico.
                </div>
            </div>
            <!-- calendario -->
            <div class="col-md-8 offset-md-2 mb-3">
                <div
                    class="d-flex my-2 align-items-center">
                    <div>
                        <div class="cita_dia form-number-input-cita_dia bg-primary rounded-circle"
                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                            5</div>
                    </div>
                    <div>
                        <!-- is-invalid -->
                        <label class="cita_dia h5 m-0 text-primary"
                            for="validationServer05">
                            Indica el día de tu conveniencia
                            <small
                                title="Dias en que se atiende este médico."
                                class="d-none notification cita_dia badge badge-info font-weight-normal"><b>0</b></small>
                        </label>
                    </div>
                </div>
                <div id="mensaje_dia_seleccionado" class="text-center text-secondary" style="font-size:20px">
                    Solo los días resaltados en gris están disponibles.
                </div>

                <input required id="cita_dia" name="cita_dia" type="hidden">
                <div id="calendar" class="daterange" style="width: 100%"></div>

                <div id="validationServer06Feedback"
                    class="invalid-feedback cita_dia">
                    Por favor selecciona un día válido.
                </div>
            </div>
            <!-- hora -->
            <div class="col-md-8 offset-md-2 mb-3">
                <div
                    class="d-flex my-2 align-items-center">
                    <div>
                        <div class="cita_hora form-number-input-cita_hora bg-primary rounded-circle"
                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                            6</div>
                    </div>
                    <div>
                        <!-- is-invalid -->
                        <label class="cita_hora h5 m-0 text-primary"
                            for="validationServer05">
                            Escoje una hora
                            <small
                                title="Médicos que atienden esta especialidad"
                                class="d-none notification user_id_medico badge badge-info font-weight-normal"><b>0</b></small>
                        </label>
                    </div>
                </div>
                <input required id="cita_hora" name="cita_hora" type="hidden">
                <ul class="d-none nav justify-content-center  nav-tabs mb-3" id="horarios" role="tablist">
                    <li class="nav-item flex-fill text-center" role="presentation">
                        <a class="nav-link active" id="pills-am-tab" data-cita-horario="am" data-toggle="pill"
                            href="#pills-am" role="tab" aria-controls="pills-am" aria-selected="true">Mañana</a>
                    </li>
                    <li class="nav-item flex-fill text-center" role="presentation">
                        <a class="nav-link" id="pills-pm-tab" data-cita-horario="pm" data-toggle="pill"
                            href="#pills-pm" role="tab" aria-controls="pills-pm" aria-selected="false">Tarde</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContentHoras">
                    <div class="tab-pane fade show active" id="pills-am" role="tabpanel"
                        aria-labelledby="pills-tabContentHoras">
                        <ul class="nav nav-pills horas-tab mb-3" id="horas-tab" role="tablist">
                            <div class="flex-fill text-center text-secondary" style="font-size:15px">
                                Sin Horas disponibles
                            </div>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="pills-pm" role="tabpanel"
                        aria-labelledby="pills-tabContentHoras">
                        <ul class="nav nav-pills horas-tab mb-3" id="horas-tab" role="tablist">


                        </ul>
                    </div>
                </div>
                <div id="validationServer06Feedback"
                    class="invalid-feedback cita_hora">
                    Por favor selecciona una respuesta
                    válida.
                </div>
            </div>
            <!--  -->
            <div class="col-md-8 offset-md-2 mb-3">
                <div
                    class="d-flex my-2 align-items-center">
                    <div>
                        <div class="form-number-input-cat_especialidad_id bg-primary rounded-circle"
                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                            7</div>
                    </div>
                    <div>
                        <!-- is-invalid -->
                        <label class="h5 m-0 text-primary"
                            for="validationServer03">Modalidad de la cita</label>

                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center" style="line-height: 1">
                    <div><input type="radio" value="Particular" class="form-control mx-1"
                            style="width:20px;height:20px; display:inline !important"
                            name="condicion_administrativa" checked> </div>
                    <div>Particular</div>
                    <div><input type="radio" value="Seguro" class="form-control mx-1"
                            style="width:20px;height:20px; display:inline !important"
                            name="condicion_administrativa"> </div>
                    <div>Asegurado</div>
                    <div><input type="radio" value="Empresarial" class="form-control mx-1"
                        style="width:20px;height:20px; display:inline !important"
                        name="condicion_administrativa"> </div>
                    <div>Empresarial</div>
                    <div><input type="radio" value="Cortesía" class="form-control mx-1"
                        style="width:20px;height:20px; display:inline !important"
                        name="condicion_administrativa"> </div>
                    <div>Cortesía</div>
                    <div><input type="radio" value="Empleado" class="form-control mx-1"
                        style="width:20px;height:20px; display:inline !important"
                        name="condicion_administrativa"> </div>
                    <div>Empleado</div>
                    {{-- <div><input type="radio" value="APS" class="form-control mx-1"
                            style="width:20px;height:20px; display:inline !important"
                            name="condicion_administrativa"> </div>
                    <div>APS</div> --}}
                </div>

                <div id="modalidad_cortesia" class="d-none">
                    <input type="text" class="form-control mt-2" name="condicion_descripcion" id="condicion_descripcion"
                        placeholder="Escriba el nombre de la persona que autoriza la cortesía.">
                    <select class="form-control mt-1 d-none" name="user_id_autorizacion">
                        <option value="">Seleccione quién autoriza la cita</option>
                        @if (!is_null(session('user_id_gerente')) && !is_null(session('gerente_nombre')))
                            <option value="{{ session('user_id_gerente') }}">{{ session('gerente_nombre') }}
                                (Gerente)</option>
                        @endif
                        <option value="1">Luis Parodi</option>
                        <option value="2">Giuseppe Rosito</option>
                    </select>
                    {{-- <div class="alert alert-primary mt-1 alert-dismissible fade show" role="alert">
                        <strong>Sobre la modalidad Cortesía:</strong>
                        <ul>
                            <li>Las citas de cortesía obligatoriamente deben ser notificadas y aprobadas por un
                                usuario autorizado.</li>
                            <li>Una vez autorizada la cortesía, escribir <span
                                    class="cursor-pointer condicion_descripcion">a qué convenio
                                    pertenece</span>, y luego, seleccionar el <span
                                    class="cursor-pointer user_id_autorizacion">usuario que autoriza</span>
                                dicha cortesía.</li>
                            <li>Al pulsar en <b class="btn_submit cursor-pointer">Crear cita</b>, el usuario
                                que autoriza, recibirá una notificación por correo electrónico con los datos de
                                dicha solicitud.</li>
                        </ul>
                    </div> --}}
                </div>
                <div id="modalidad_seguro" class="d-none">
                    <div class="d-flex">
                        <div class="flex-fill px-1">
                            <select class="form-control mt-1" name="cat_seguro_id"
                                id="cat_seguro_id">
                                <option value="">Seleccione</option>
                                {{-- <option value="1">VUMI</option>
                                <option value="2">Best Doctors</option>
                                <option value="3">Mercantil</option>
                                <option value="4">Humanitas</option>
                                <option value="5">Caracas</option>
                                <option value="6">Qualitas</option> --}}
                            </select>
                        </div>
                        <div class="flex-fill px-1">
                            <input type="text" class="form-control mt-1" name="poliza_numero" id="poliza_numero"
                                placeholder="Escriba el número de poliza.">
                        </div>
                    </div>
                </div>

                <div id="modalidad_empresarial" class="d-none">
                    <div class="d-flex">
                        <div class="flex-fill px-1">
                            <select class="form-control mt-1" name="cat_empresa_id"
                                id="cat_empresa_id">
                                <option value="">Seleccione</option>
                                {{-- <option value="1">Empresas Polar</option>
                                <option value="2">Farmatodo</option>
                                <option value="3">Excelsior Gama</option> --}}
                            </select>
                        </div>
                    </div>
                </div>

                <div id="modalidad_empleado" class="d-none">
                    <div class="d-flex">
                        <div class="flex-fill px-1">
                            <select class="form-control mt-1" name="directorio_organizacional_id"
                                id="directorio_organizacional_id">
                                <option value="">Seleccione</option>
                                {{-- <option value="1">Presidencia</option>
                                <option value="2">Vicepresidencia</option>
                                <option value="3">Secretaría</option>
                                <option value="4">Dirección Médica</option>
                                <option value="5">Dirección de Educación e Investigación</option>
                                <option value="6">Dirección de Operaciones y Logística</option>
                                <option value="7">Dirección de Comercialización</option>
                                <option value="8">Dirección de Cumplimiento y Apoyo Corporativo</option>
                                <option value="9">Dirección de Administración y Finanzas</option>
                                <option value="10">Dirección de Ingeniería y Proyectos</option>
                                <option value="11">Dirección de Medicina Comunitaria y Programas Sociales</option>
                                <option value="12">Consejo Consultivo</option>
                                <option value="13">Departamento de Cirugía</option>
                                <option value="14">Departamento de Odontología</option>
                                <option value="15">Departamento de Medicina</option>
                                <option value="16">Departamento de Pediatría</option>
                                <option value="17">Departamento de Ginecología y Obstetricia</option>
                                <option value="18">Departamento de Medicina Crítica y Emergencia</option> --}}
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <!-- motivo consulta -->
            <div class="col-md-8 offset-md-2 mb-3">
                <div
                    class="d-flex my-2 align-items-center">
                    <div>
                        <div class="cita_motivo form-number-input-cita_motivo bg-primary rounded-circle"
                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                            8</div>
                    </div>
                    <div>
                        <!-- is-invalid -->
                        <label class="cita_motivo h5 m-0 text-primary"
                            for="validationServer05">
                            Motivo de consulta
                            <small
                                title="Médicos que atienden esta especialidad"
                                class="d-none notification cita_motivo badge badge-info font-weight-normal"><b>0</b></small>
                        </label>
                    </div>
                </div>
                <textarea class="form-control" placeholder="Escribe el motivo" name="cita_motivo" id="cita_motivo" rows="3"></textarea>
                <div id="validationServer06Feedback"
                    class="invalid-feedback cita_motivo">
                    Por favor selecciona una respuesta
                    válida.
                </div>
            </div>
            <div class="col-md-8 offset-md-2 mb-3 d-none">
                <div
                    class="d-flex my-2 align-items-center">
                    <div>
                        <div class="cita_motivo form-number-input-cita_motivo bg-primary rounded-circle"
                            style="width:30px;height:30px;text-align:center;color:var(--white);font-weight:bold;line-height:1.7; margin-right:10px">
                            9</div>
                    </div>
                    <div>
                        <!-- is-invalid -->
                        <label class="cita_motivo h5 m-0 text-primary"
                            for="validationServer05">
                            Informe Médico
                        </label>
                    </div>
                </div>
                <input id="informe_general" style="height: 43px;" name="informe_general" type="file" class="form-control">
            </div>



            <!-- submit -->
            <div class="col-md-6 offset-md-3 mb-3">
                <button id="btn_enviar" class="btn btn-success btn-block"
                type="submit">Enviar datos</button>
            </div>
        </div>



    </div>
   {{--  <form>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3 class="text-primary font-weight-bold">Nueva Cita</h3>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <a data-toggle="collapse" href="#collapseCedula" role="button" aria-expanded="false"
                        aria-controls="collapseCedula">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1 item-1 burble-number">
                                1</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Cédula de identidad del
                                    paciente</b>
                            </div>
                        </div>
                    </a>

                    <div class="collapse p-2 show" id="collapseCedula">
                        <input required name="user_id_paciente" type="hidden">
                        <input required name="cedula" maxlength="9" type="text" class="form-control">
                        <small class="notification"></small>
                    </div>
                </div>
                <div class="col-md-8">
                    <a data-toggle="collapse" href="#collapseAmbulatorio" role="button" aria-expanded="false"
                        aria-controls="collapseAmbulatorio">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1 item-2 burble-number">
                                2</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Selecciona el Centro de
                                    salud</b>

                            </div>
                        </div>
                    </a>

                    <div class="collapse p-2 show" id="collapseAmbulatorio">
                        <select title="Centro de salud (Total de especialidades)" required data-item="item-1"
                            name="centro_salud_id" class="medico-select form-control"
                            id="centro_salud_id"></select>
                        <small class="notification"></small>
                    </div>
                </div>
                <div class="col-md-8">
                    <a data-toggle="collapse" href="#collapseEspecialidad" role="button" aria-expanded="false"
                        aria-controls="collapseEspecialidad">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1 item-3 burble-number">
                                3</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Selecciona la
                                    Especialidad</b>
                                <small title="Total de especialidades que atiende el centro de salud"
                                    class="notification-especialidad badge badge-info font-weight-normal d-none"><b>0</b>
                                    encontradas</small>
                            </div>
                        </div>
                    </a>

                    <div class="collapse p-2 show" id="collapseEspecialidad">
                        <select title="Especialidades (Total de médicos)" required data-item="item-1"
                            name="cat_especialidad_id" class="medico-select form-control"
                            id="cat_especialidad_id"></select>

                    </div>
                </div>
                <div class="col-md-8">

                    <a data-toggle="collapse" href="#collapseMedico" role="button" aria-expanded="false"
                        aria-controls="collapseMedico">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1 item-4 burble-number">
                                4</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Médico de tu
                                    preferencia</b>
                                <small title="Total de médicos disponibles en la especialidad seleccionada"
                                    class="notification-medicos badge badge-info font-weight-normal d-none"><b>0</b>
                                    encontrados</small>
                            </div>
                        </div>
                    </a>
                    <div class="collapse p-2 show" id="collapseMedico">
                        <select required name="user_id_medico" class="medico-select form-control"
                            id="user_id_medico">

                        </select>


                    </div>
                </div>
                <div class="col-md-8">
                    <a data-toggle="collapse" href="#collapseDia" role="button" aria-expanded="false"
                        aria-controls="collapseDia">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1 item-5 burble-number">
                                5</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Indica el día de tu
                                    conveniencia</b>
                            </div>
                        </div>
                    </a>
                    <div class="collapse p-2 show" id="collapseDia">
                        <div id="mensaje_dia_seleccionado" class="text-center text-secondary"
                            style="font-size:15px">
                            Solo los días resaltados están disponibles.
                        </div>
                        <input required id="cita_dia" name="cita_dia" type="hidden">
                        <div id="calendar" class="daterange" style="width: 100%"></div>

                    </div>




                </div>
                <div class="col-md-8">

                    <a data-toggle="collapse" href="#collapseHora" role="button" aria-expanded="false"
                        aria-controls="collapseHora">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1 item-6"
                                style="width: 25px;line-height: 1.5;">6</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Escoje una hora</b>
                            </div>
                        </div>
                    </a>
                    <div class="collapse p-2 show" id="collapseHora">
                        <input required id="cita_hora" name="cita_hora" type="hidden">

                        <div class="tab-content" id="pills-tabContentHoras">
                            <div class="tab-pane fade show active pills-am" id="pills-am" role="tabpanel"
                                aria-labelledby="pills-tabContentHoras">
                                <ul class="nav nav-pills horas-tab mb-3" id="horas-tab" role="tablist">

                                </ul>
                            </div>
                            <div class="tab-pane fade show active pills-pm" id="pills-pm" role="tabpanel"
                                aria-labelledby="pills-tabContentHoras">
                                <ul class="nav nav-pills horas-tab mb-3" id="horas-tab" role="tablist">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <a data-toggle="collapse" href="#collapseMotivo" role="button" aria-expanded="false"
                        aria-controls="collapseMotivo">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1  item-7 burble-number">
                                7</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Indica el motivo de
                                    consulta</b> <span class="text-secondary">(opcional)</span>
                            </div>
                        </div>
                    </a>
                    <div class="collapse show p-2" id="collapseMotivo">
                        <textarea class="form-control" placeholder="Escribe el motivo" name="cita_motivo" id="cita_motivo"
                            rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-8">
                    <a data-toggle="collapse" href="#collapseCondicionAdmin" role="button"
                        aria-expanded="false" aria-controls="collapseCondicionAdmin">
                        <div class="d-flex mb-2">
                            <div class="badge badge-success rounded-circle mr-1  item-8 burble-number">
                                8</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Modalidad de la cita</b></span>
                            </div>
                        </div>
                    </a>
                    <div class="collapse show p-2" id="collapseCondicionAdmin">
                        <div class="d-flex align-items-center justify-content-center" style="line-height: 1">
                            <div><input type="radio" value="Particular" class="form-control mx-1"
                                    style="width:20px;height:20px; display:inline !important"
                                    name="condicion_administrativa" checked> </div>
                            <div>Particular</div>
                            <div><input type="radio" value="Tuvecinoweb" class="form-control mx-1"
                                    style="width:20px;height:20px; display:inline !important"
                                    name="condicion_administrativa"> </div>

                            <div>Cortesía</div>
                            <div><input type="radio" value="APS" class="form-control mx-1"
                                    style="width:20px;height:20px; display:inline !important"
                                    name="condicion_administrativa"> </div>
                            <div>APS</div>
                            <div><input type="radio" value="Seguro" class="form-control mx-1"
                                    style="width:20px;height:20px; display:inline !important"
                                    name="condicion_administrativa"> </div>
                            <div>Seguro</div>
                        </div>

                        <div id="modalidad_cortesia" class="d-none">
                            <input type="text" class="form-control mt-2" name="condicion_descripcion"
                                placeholder="Escriba el convenio por el que se autoriza la Cortesía.">
                            <select class="form-control mt-1" name="user_id_autorizacion">
                                <option value="">Seleccione quién autoriza la cita</option>
                                @if (!is_null(session('user_id_gerente')) && !is_null(session('gerente_nombre')))
                                    <option value="{{ session('user_id_gerente') }}">{{ session('gerente_nombre') }}
                                        (Gerente)</option>
                                @endif
                                <option value="355511">Maggia Santi</option>
                                <option value="96">Luis Giménez</option>
                            </select>
                            <div class="alert alert-primary mt-1 alert-dismissible fade show" role="alert">
                                <strong>Sobre la modalidad Cortesía:</strong>
                                <ul>
                                    <li>Las citas de cortesía obligatoriamente deben ser notificadas y aprobadas por un
                                        usuario autorizado.</li>
                                    <li>Una vez autorizada la cortesía, escribir <span
                                            class="cursor-pointer condicion_descripcion">a qué convenio
                                            pertenece</span>, y luego, seleccionar el <span
                                            class="cursor-pointer user_id_autorizacion">usuario que autoriza</span>
                                        dicha cortesía.</li>
                                    <li>Al pulsar en <b class="btn_submit cursor-pointer">Crear cita</b>, el usuario
                                        que autoriza, recibirá una notificación por correo electrónico con los datos de
                                        dicha solicitud.</li>
                                </ul>
                            </div>
                        </div>
                        <div id="modalidad_seguro" class="d-none">
                            <div class="d-flex">
                                <div class="flex-fill px-1">
                                    <select disabled class="form-control mt-1" name="cat_seguro_id"
                                        id="cat_seguro_id">
                                        <option value="">Seguros no disponible</option>
                                    </select>
                                </div>
                                <div class="flex-fill px-1">
                                    <input disabled type="text" class="form-control mt-1" name="poliza_numero"
                                        placeholder="Escriba el número de poliza.">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <a data-toggle="collapse" href="#collapseInformeGeneral" role="button"
                        aria-expanded="false" aria-controls="collapseInformeGeneral">
                        <div class="d-flex mb-2">

                            <div class="flex-grow-1">
                                <b class="text-primary">Adjunta referencia médica</b> <span
                                    class="text-secondary">(Si la posee)</span>
                            </div>
                        </div>
                    </a>
                    <div class="collapse show p-2" id="collapseInformeGeneral">
                        <input id="informe_general" style="height: 43px;" name="informe_general" type="file"
                            class="form-control">
                        <small class="notification"></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mb-2 justify-content-center">
                <div class="col-sm-6">
                    <button id="submit" type="submit" class="btn btn-success btn-block">Crear cita</button>
                </div>
            </div>
        </div>
    </form> --}}
</template>
<!-- row table recipe-create -->
<template id="artefacto_0041">
    <tr>
        <td class="text-center">
            <div class="value-counter text-secondary"></div>
        </td>
        <td class="text-center">
            <div class="d-flex">
                <div class="value-medicamento mx-1 bg-light text-secondary p-1 rounded">
                    Amoxicilina
                </div>
                <div class="value-presentation mx-1 bg-light text-secondary p-1 rounded">
                    Capsulas 875 mg
                </div>
                <div class="value-cantidad mx-1 bg-light text-secondary p-1 rounded">
                    2 tab
                </div>
                <div class="value-indication mx-1 bg-light text-secondary p-1 rounded">
                    Tomar en ayunas, en la mañana por dos semanas
                </div>
            </div>
        </td>
        <td nowrap valign="middle" align="center" class="d-none text-center">
            <button class="btn btn-edit btn-default text-secondary bg-light"><i
                    class="fas fa-edit text-secondary btn-edit"></i></button>
            <button class="btn btn-delete btn-default text-secondary bg-light"><i
                    class="fas fa-trash text-secondary btn-delete"></i></button>
        </td>
    </tr>
</template>
<!-- row table recipe-index -->
<template id="artefacto_0042">
    <tr>
        <td class="item-counter text-secondary" style="width: 50px;">0</td>
        <td class="text-secondary">
            <div class="d-flex">

                <div class="mx-2 px-2 border-right">
                    <b title="Fecha del documento">Fecha:</b>
                    <div class="item-fecha text-center">0</div>
                </div>
                <div class="mx-2 px-2 border-right">
                    <b title="Cantidad de items">Cantidad de medicamentos:</b>
                    <div class="item-cantidad text-center">1</div>
                </div>
                <div class="mx-2 px-2">
                    <b>Médico:</b>
                    <div class="item-medico">RAÚL Amundaray Echiverria</div>
                </div>
            </div>
        </td>
        <td class="text-secondary" nowrap style="width: 200px;">
            <button class="btn btn-show btn-default text-secondary bg-light"><i
                    class="fas fa-search text-secondary btn-show"></i></button>
            <span class="dropdown">
                <button title="Compartir por correo electrónico" class="btn btn-default" type="button"
                    id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" data-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-envelope text-primary"></i>
                </button>
                <div class="dropdown-menu pb-0  animate fade-down" aria-labelledby="dropdownMenuButton1">
                    <h3 class="dropdown-header text-primary"><b>Enviar correo en:</b></h3>
                    <ul class="navbar-nav ms-auto">
                        <li><a data-print="color" class="btn-email_color dropdown-item" href="#">Color</a>
                        </li>
                        <li><a data-print="bw" class="btn-email_bw dropdown-item" href="">Blanco y
                                negro</a></li>
                    </ul>
                </div>
            </span>
            <span class="dropdown">
                <button title="Compartir por Whatsapp" class="btn btn-default" type="button"
                    id="dropdownMenuButton2" aria-haspopup="true" data-toggle="dropdown" aria-expanded="false">
                    <i class="fab fa-whatsapp text-success"></i>
                </button>
                <div class="dropdown-menu pb-0  animate fade-down" aria-labelledby="dropdownMenuButton2">
                    <h3 class="dropdown-header text-primary"><b>Enviar Whatsapp en:</b></h3>
                    <ul class="navbar-nav ms-auto">
                        <li><a data-print="color" class="btn-whatsapp_color dropdown-item"
                                href="#">Color</a></li>
                        <li><a data-print="bw" class="btn-whatsapp_bw dropdown-item" href="">Blanco y
                                negro</a></li>
                    </ul>
                </div>
            </span>
            <span class="dropdown">
                <button title="Imprimir Documento" class="btn btn-default" type="button"
                    id="dropdownMenuButton3" aria-haspopup="true" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-file-pdf text-danger"></i>
                </button>
                <div class="dropdown-menu pb-0  animate fade-down" aria-labelledby="dropdownMenuButton3">
                    <h3 class="dropdown-header text-primary"><b>Enviar PDF en:</b></h3>
                    <ul class="navbar-nav ms-auto">
                        <li style="display:none"><a data-print="color" class="btn-imprimir_color dropdown-item"
                                href="#">Color</a></li>
                        <li><a data-print="bw" class="btn-imprimir_bw dropdown-item" href="">Blanco y
                                negro</a></li>
                    </ul>
                </div>
            </span>
            <button title="Eliminar este documento"
                class="d-none btn btn-delete btn-default text-secondary bg-light"><i
                    class="fas fa-trash text-secondary btn-delete"></i></button>
        </td>
    </tr>
</template>
<!-- row table recipe-create -->
<template id="artefacto_0043">
    <tr>
        <td class="text-center">
            <div class="value-counter text-secondary"></div>
        </td>
        <td class="text-center">
            <div class="d-flex">
                <div class="value-value1 mx-1 bg-light text-secondary p-1 rounded">

                </div>
                <div class="value-value2 mx-1 bg-light text-secondary p-1 rounded">

                </div>
                <div class="value-coments mx-1 bg-light text-secondary p-1 rounded">

                </div>

            </div>
        </td>
        <td nowrap valign="middle" align="center" class="text-center">
            <button class="btn btn-edit btn-default text-secondary bg-light"><i
                    class="fas fa-edit text-secondary btn-edit"></i></button>
            <button class="d-none btn btn-delete btn-default text-secondary bg-light"><i
                    class="fas fa-trash text-secondary btn-delete"></i></button>
        </td>
    </tr>
</template>
<!-- row table estudio-index -->
<template id="artefacto_0044">
    <tr>
        <td class="item-counter text-secondary" style="width: 50px;">0</td>
        <td class="text-secondary">
            <div class="d-flex">

                <div class="mx-2 px-2 border-right">
                    <b title="Fecha del documento">Fecha:</b>
                    <div class="item-fecha text-center">0</div>
                </div>
                <div class="mx-2 px-2 border-right">
                    <b title="Cantidad de items">Cantidad de Estudios:</b>
                    <div class="item-cantidad text-center">1</div>
                </div>
                <div class="mx-2 px-2">
                    <b>Médico:</b>
                    <div class="item-medico">RAÚL Amundaray Echiverria</div>
                </div>
            </div>
        </td>
        <td class="text-secondary" nowrap style="width: 200px;">
            <button class="btn btn-show btn-default text-secondary bg-light"><i
                    class="fas fa-search text-secondary btn-show"></i></button>
            <span class="dropdown">
                <button title="Compartir por correo electrónico" class="btn btn-default" type="button"
                    id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" data-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-envelope text-primary"></i>
                </button>
                <div class="dropdown-menu pb-0  animate fade-down" aria-labelledby="dropdownMenuButton1">
                    <h3 class="dropdown-header text-primary"><b>Enviar correo en:</b></h3>
                    <ul class="navbar-nav ms-auto">
                        <li><a data-print="color" class="btn-email_color dropdown-item" href="#">Color</a>
                        </li>
                        <li><a data-print="bw" class="btn-email_bw dropdown-item" href="">Blanco y
                                negro</a></li>
                    </ul>
                </div>
            </span>
            <span class="dropdown">
                <button title="Compartir por Whatsapp" class="btn btn-default" type="button"
                    id="dropdownMenuButton2" aria-haspopup="true" data-toggle="dropdown" aria-expanded="false">
                    <i class="fab fa-whatsapp text-success"></i>
                </button>
                <div class="dropdown-menu pb-0  animate fade-down" aria-labelledby="dropdownMenuButton2">
                    <h3 class="dropdown-header text-primary"><b>Enviar Whatsapp en:</b></h3>
                    <ul class="navbar-nav ms-auto">
                        <li><a data-print="color" class="btn-whatsapp_color dropdown-item"
                                href="#">Color</a></li>
                        <li><a data-print="bw" class="btn-whatsapp_bw dropdown-item" href="">Blanco y
                                negro</a></li>
                    </ul>
                </div>
            </span>
            <span class="dropdown">
                <button title="Imprimir Documento" class="btn btn-default" type="button"
                    id="dropdownMenuButton3" aria-haspopup="true" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-file-pdf text-danger"></i>
                </button>
                <div class="dropdown-menu pb-0  animate fade-down" aria-labelledby="dropdownMenuButton3">
                    <h3 class="dropdown-header text-primary"><b>Enviar PDF en:</b></h3>
                    <ul class="navbar-nav ms-auto">
                        <li style="display:none"><a data-print="color" class="btn-imprimir_color dropdown-item"
                                href="#">Color</a></li>
                        <li><a data-print="bw" class="btn-imprimir_bw dropdown-item" href="">Blanco y
                                negro</a></li>
                    </ul>
                </div>
            </span>
            <button title="Eliminar este documento" class="btn btn-delete btn-default text-secondary bg-light"><i
                    class="fas fa-trash text-secondary btn-delete"></i></button>
        </td>
    </tr>
</template>
<!-- row table estudio-create -->
<template id="artefacto_0045">
    <tr>
        <td class="text-center">
            <div class="value-counter text-secondary"></div>
        </td>
        <td class="text-center">
            <div class="d-flex">
                <div class="value-value mx-1 bg-light text-secondary p-1 rounded">

                </div>
                <div class="value-value2 mx-1 bg-light text-secondary p-1 rounded">

                </div>
                <div class="value-coments mx-1 bg-light text-secondary p-1 rounded">

                </div>

            </div>
        </td>
        <td nowrap valign="middle" align="center" class="text-center">
            <button class="btn btn-edit btn-default text-secondary bg-light"><i
                    class="fas fa-edit text-secondary btn-edit"></i></button>
            <button class="btn btn-delete btn-default text-secondary bg-light"><i
                    class="fas fa-trash text-secondary btn-delete"></i></button>
        </td>
    </tr>
</template>
<!-- dashboard menu -->
<template id="artefacto_0046">
    <div class="container justify-content-sm-center align-items-lg-start align-items-xl-start py-5">
        <div id="dashboard" class="menu row justify-content-center">

        </div>
    </div>
</template>
<!-- dashboard menu option -->
<template id="artefacto_0047">

    <!-- start card -->
    <div class=" card-option overflow-auto">
        <div class="card-option jumbotron shadow   py-1 px-2 jumbotron-fluid" style="border-radius:20px">
            <div class="card-option container">
                <div class="card-option row overflow-auto flex-nowrap align-items-center justify-content-between">
                    <div class="card-option p-1 overflow-hidden">
                        <h2 class="font-weight-bold card-option card-title"
                            style="max-height: 80px;font-size: 2rem;">
                            Card<br>
                            Title
                        </h2>
                    </div>
                    <div class="card-option p-1">
                        <h1 class="card-option display-4">
                            <i class="card-option card-icon"></i>
                        </h1>
                    </div>
                </div>
                <div class="card-option row overflow-hidden text-nowrap">
                    <div class="card-option card-content border-top col-12">


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end card -->


</template>
<template id="artefacto_0048">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-primary font-weight-bold">Archivos</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="acceso-archivos card-body p-0">
            <div class="overlay-wrapper">
                <div class="overlay text-primary d-none">
                    <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                    <div class="text-bold pt-2"> Por favor espere un momento...</div>
                </div>
                <ul class="nav bg-white nav-pills flex-column">
                    <li class="handle_recipes link_recipe nav-item active">
                        <a href="#" class="nav-link handle_recipes">
                            <i class="pc-recipe h4 handle_recipes"></i> Récipes
                            <span class="badge badge-gray float-right handle_recipes"
                                title="Cantidad de medicamentos escritos en el récipe">0</span>
                        </a>
                    </li>
                    <li class="handle_estudios link_estudio_diagnostico nav-item">
                        <a href="#" class="nav-link handle_estudios">
                            <i class="pc-estudio h4 handle_estudios"></i> Estudios Diagnósticos
                            <span class="badge badge-gray float-right handle_estudios">0</span>
                        </a>
                    </li>
                    <li class="handle_laboratorios nav-item">
                        <a href="#" class="nav-link handle_laboratorios">
                            <i class="pc-laboratorios h4 handle_laboratorios"></i> Laboratorios
                            <span class="badge badge-gray float-right handle_laboratorios">0</span>
                        </a>
                    </li>
                    <li class="handle_fotografias nav-item">
                        <a href="#" class="nav-link handle_fotografias">
                            <i class="pc-fotografias h4 handle_fotografias"></i> Fotografías
                            <span class="badge badge-gray float-right handle_fotografias">0</span>
                        </a>
                    </li>
                    <li class="handle_imagenes nav-item">
                        <a href="#" class="nav-link handle_imagenes">
                            <i class="pc-estudios_diagnosticos h4 handle_imagenes"></i>
                            Imagenes
                            <span class="badge badge-gray float-right handle_imagenes">0</span>
                        </a>
                    </li>
                    <li class="handle_otro_archivo nav-item">
                        <a href="#" class="nav-link handle_otro_archivo">
                            <i class="pc-otros_archivos h4 handle_otro_archivo"></i> Otros
                            Archivos
                            <span class="badge badge-gray float-right handle_otro_archivo">0</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<!-- formunario nueva agenda -->
<template id="artefacto_0049">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3 class="text-primary font-weight-bold">Nueva Agenda</h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <table class="table table-striped table-responsive">
                    <thead class="thead-default">
                        <tr>
                            <th>Especialidad</th>
                            <th>Mes</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td scope="row"></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<!-- formulario nueva cita actualizado-->
<template id="artefacto_0050">
    <form>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3 class="text-info font-weight-bold">Nueva Cita</h3>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 d-none">
                    <a data-toggle="collapse" href="#collapseCedula" role="button" aria-expanded="false"
                        aria-controls="collapseCedula">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1 item-1 burble-number">
                                1</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Cédula de identidad del
                                    paciente</b>
                            </div>
                        </div>
                    </a>

                    <div class="collapse p-2 show" id="collapseCedula">
                        <input required name="user_id_paciente" type="hidden">
                        <input required name="cedula" type="text" class="form-control">
                        <small class="notification"></small>
                    </div>
                </div>
                <div class="col-md-8">
                    <a data-toggle="collapse" href="#collapseAmbulatorio" role="button" aria-expanded="false"
                        aria-controls="collapseAmbulatorio">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1 item-2 burble-number">
                                1</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Selecciona el Centro de
                                    salud</b>

                            </div>
                        </div>
                    </a>

                    <div class="collapse p-2 show" id="collapseAmbulatorio">
                        <select title="Centro de salud (Total de especialidades)" required data-item="item-1"
                            name="centro_salud_id" class="medico-select form-control"
                            id="centro_salud_id"></select>
                        <small class="notification"></small>
                    </div>
                </div>
                <div class="col-md-8">
                    <a data-toggle="collapse" href="#collapseEspecialidad" role="button" aria-expanded="false"
                        aria-controls="collapseEspecialidad">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1 item-3 burble-number">
                                2</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Selecciona la
                                    Especialidad</b>
                                <small title="Total de especialidades que atiende el centro de salud"
                                    class="notification-especialidad badge badge-info font-weight-normal d-none"><b>0</b>
                                    encontradas</small>
                            </div>
                        </div>
                    </a>

                    <div class="collapse p-2 show" id="collapseEspecialidad">
                        <select title="Especialidades (Total de médicos)" required data-item="item-1"
                            name="cat_especialidad_id" class="medico-select form-control"
                            id="cat_especialidad_id"></select>

                    </div>
                </div>
                <div class="col-md-8">

                    <a data-toggle="collapse" href="#collapseMedico" role="button" aria-expanded="false"
                        aria-controls="collapseMedico">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1 item-4 burble-number">
                                3</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Médico de tu
                                    preferencia</b>
                                <small title="Total de médicos disponibles en la especialidad seleccionada"
                                    class="notification-medicos badge badge-info font-weight-normal d-none"><b>0</b>
                                    encontrados</small>
                            </div>
                        </div>
                    </a>
                    <div class="collapse p-2 show" id="collapseMedico">
                        <select required name="user_id_medico" class="medico-select form-control"
                            id="user_id_medico">

                        </select>
                        {{-- <div class="alert alert-warning mt-2" role="alert">
                            <b>Hora 5:00 am 24/04/2022. NIVEL DE DESARROLLO:</b> falta integrar seleccionar día, hora, y motivo de consulta. Continuación hoy domingo para culminar integración.
                          </div> --}}

                    </div>
                </div>
                <div class="col-md-8">
                    <a data-toggle="collapse" href="#collapseDia" role="button" aria-expanded="false"
                        aria-controls="collapseDia">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1 item-5 burble-number">
                                4</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Indica el día de tu
                                    conveniencia</b>
                            </div>
                        </div>
                    </a>
                    <div class="collapse p-2 show" id="collapseDia">
                        <div id="mensaje_dia_seleccionado" class="text-center text-secondary"
                            style="font-size:15px">
                            Solo los días resaltados están disponibles.
                        </div>
                        <input required id="cita_dia" name="cita_dia" type="hidden">
                        <div id="calendar" class="daterange" style="width: 100%"></div>

                    </div>




                </div>
                <div class="col-md-8">

                    <a data-toggle="collapse" href="#collapseHora" role="button" aria-expanded="false"
                        aria-controls="collapseHora">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1 item-6"
                                style="width: 25px;line-height: 1.5;">5</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Escoje una hora</b>
                            </div>
                        </div>
                    </a>
                    <div class="collapse p-2 show" id="collapseHora">
                        <input required id="cita_hora" name="cita_hora" type="hidden">

                        <div class="tab-content" id="pills-tabContentHoras">
                            <div class="tab-pane fade show active pills-am" id="pills-am" role="tabpanel"
                                aria-labelledby="pills-tabContentHoras">
                                <ul class="nav nav-pills horas-tab mb-3" id="horas-tab" role="tablist">

                                </ul>
                            </div>
                            <div class="tab-pane fade show active pills-pm" id="pills-pm" role="tabpanel"
                                aria-labelledby="pills-tabContentHoras">
                                <ul class="nav nav-pills horas-tab mb-3" id="horas-tab" role="tablist">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <a data-toggle="collapse" href="#collapseMotivo" role="button" aria-expanded="false"
                        aria-controls="collapseMotivo">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1  item-7 burble-number">
                                7</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Indica el motivo de
                                    consulta</b>
                            </div>
                        </div>
                    </a>
                    <div class="collapse show p-2" id="collapseMotivo">
                        <textarea class="form-control" placeholder="Escribe el motivo" name="cita_motivo" id="cita_motivo"
                            rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-8">
                    <a data-toggle="collapse" href="#collapseCondicionAdmin" role="button"
                        aria-expanded="false" aria-controls="collapseCondicionAdmin">
                        <div class="d-flex mb-2">
                            <div class="badge badge-success rounded-circle mr-1  item-8 burble-number">
                                8</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Modalidad de la cita</b></span>
                            </div>
                        </div>
                    </a>
                    <div class="collapse show p-2" id="collapseCondicionAdmin">
                        <div class="d-flex align-items-center justify-content-center" style="line-height: 1">
                            <div><input type="radio" value="Particular" class="form-control mx-1"
                                    style="width:20px;height:20px; display:inline !important"
                                    name="condicion_administrativa" checked> </div>
                            <div>Particular</div>
                            <div><input type="radio" value="Tuvecinoweb" class="form-control mx-1"
                                    style="width:20px;height:20px; display:inline !important"
                                    name="condicion_administrativa"> </div>
                            <div>Tuvecinoweb</div>
                            <div><input type="radio" value="Cortesía" class="form-control mx-1"
                                    style="width:20px;height:20px; display:inline !important"
                                    name="condicion_administrativa"> </div>
                            <div>Cortesía</div>
                            <div><input type="radio" value="APS" class="form-control mx-1"
                                    style="width:20px;height:20px; display:inline !important"
                                    name="condicion_administrativa"> </div>
                            <div>APS</div>
                            <div><input type="radio" value="Seguro" class="form-control mx-1"
                                    style="width:20px;height:20px; display:inline !important"
                                    name="condicion_administrativa"> </div>
                            <div>Seguro</div>
                        </div>

                        <div id="modalidad_cortesia" class="d-none">
                            <input type="text" class="form-control mt-2" name="condicion_descripcion"
                                placeholder="Escriba el convenio por el que se autoriza la Cortesía.">
                            <select class="form-control mt-1" name="user_id_autorizacion">
                                <option value="">Seleccione quién autoriza la cita</option>
                                @if (!is_null(session('user_id_gerente')) && !is_null(session('gerente_nombre')))
                                    <option value="{{ session('user_id_gerente') }}">{{ session('gerente_nombre') }}
                                        (Gerente)</option>
                                @endif
                                <option value="355511">Maggia Santi</option>
                                <option value="96">Luis Giménez</option>
                            </select>
                            <div class="alert alert-primary mt-1 alert-dismissible fade show" role="alert">
                                <strong>Sobre la modalidad Cortesía:</strong>
                                <ul>
                                    <li>Las citas de cortesía obligatoriamente deben ser notificadas y aprobadas por un
                                        usuario autorizado.</li>
                                    <li>Una vez autorizada la cortesía, escribir <span
                                            class="cursor-pointer condicion_descripcion">a qué convenio
                                            pertenece</span>, y luego, seleccionar el <span
                                            class="cursor-pointer user_id_autorizacion">usuario que autoriza</span>
                                        dicha cortesía.</li>
                                    <li>Al pulsar en <b class="btn_submit cursor-pointer">Crear cita</b>, el usuario
                                        que autoriza, recibirá una notificación por correo electrónico con los datos de
                                        dicha solicitud.</li>
                                </ul>
                            </div>
                        </div>
                        <div id="modalidad_seguro" class="d-none">
                            <div class="d-flex">
                                <div class="flex-fill px-1">
                                    <select disabled class="form-control mt-1" name="cat_seguro_id"
                                        id="cat_seguro_id">
                                        <option value="">Seguros no disponible</option>
                                    </select>
                                </div>
                                <div class="flex-fill px-1">
                                    <input disabled type="text" class="form-control mt-1" name="poliza_numero"
                                        placeholder="Escriba el número de poliza.">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-8">
                    <div class="alert text-center" style="    color: #148ea1;
                    background: #17a2b800;
                    border-color: #148ea1;" role="alert">
                        <b>Nota:</b> En esta solicitud, se está adjuntando automaticamente el informe general de la cita actual, para su consulta en la siguiente cita.
                    </div>
                    <ul class="mailbox-attachments d-flex justify-content-center align-items-stretch clearfix">
                        <li>
                            <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
                            <div class="mailbox-attachment-info">
                                <a href="#" class="mailbox-attachment-name archivo_nombre"><i class="fas fa-paperclip"></i> Sep-23-{{date('Y')}}-cita.pdf</a>
                                <span class="mailbox-attachment-size clearfix mt-1">
                                <span class="archivo_especialidad_nombre">Medicina General</span>
                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                                </span>
                            </div>
                        </li>
                    </ul>

                </div> --}}
            </div>
        </div>
        <div class="container-fluid">
            <div class="row my-2 justify-content-center">
                <div class="col-sm-6">
                    <button id="submit" type="submit" class="btn btn-success btn-block">Crear cita</button>
                </div>
            </div>
        </div>
    </form>

</template>
<!-- dashboard admin -->
<template id="artefacto_0051">
    <div class="container-fluid my-1">
        <div class="row">
            <div class="col-12 col-sm-6 text-sm-right"><b>Desde: </b> <input id="dateStart" type="date"
                    class="bg-transparnt mt-1 border-0 shadow-sm" style="border-radius: 10px;padding: 0.4% 1%;"
                    value="{{ date('Y-m') . '-01' }}"></div>
            <div class="col-12 col-sm-6 text-sm-left"><b>Hasta: </b> <input id="dateEnd" type="date"
                    class="bg-transparnt mt-1 border-0 shadow-sm" style="border-radius: 10px;padding: 0.4% 1%;"
                    value="{{ date('Y-m-d') }}"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-header border-0">
                        <h3 class="card-title w-100 text-gray">
                            <div class="d-flex align-items-center">
                                <div><i class="h1 text-info pc-preconsulta"></i></div>
                                <div class="flex-grow-1">Emergencia</div>
                                <div>
                                    <a href="#" class="bg-transparnt border-0"
                                        style="font-size: 1.875rem; margin-top: 0.01rem;">
                                        <i class="far fa-meh text-success"></i>
                                    </a>
                                </div>
                            </div>
                        </h3>
                    </div>
                    <div class="card-body py-1">
                        <div class="d-flex justify-content-between align-items-center ">
                            <div id="total_emergencia" class="text-primary text-xl">
                                0
                            </div>
                            <div class="d-flex flex-column text-right">
                                <div>
                                    <table>
                                        <tr>
                                            <th align="right">Adultos:</th>
                                            <td id="total_emergencia_adulto">0</td>
                                        </tr>
                                        <tr>
                                            <th align="right">Pediátrico:</th>
                                            <td id="total_emergencia_pediatrico"><i
                                                    class="ion ion-android-arrow-down text-danger"></i> 0</td>
                                        </tr>
                                        <tr>
                                            <th align="right">Covid:</th>
                                            <td id="total_emergencia_covid"><i
                                                    class="ion ion-android-arrow-down text-danger"></i> 0</td>
                                        </tr>
                                    </table>

                                </div>



                            </div>
                        </div>

                    </div>
                </div>
                <div class="card" style="border-radius: 15px;">
                    <div class="card-header border-0">
                        <h3 class="card-title w-100 text-gray">
                            <div class="d-flex align-items-center">
                                <div><i class="h1 text-info pc-light-homecare"></i></div>
                                <div class="flex-grow-1">Atención Domiciliaria</div>
                                <div>
                                    <a href="#" class="bg-transparnt border-0"
                                        style="font-size: 1.875rem; margin-top: 0.01rem;">
                                        <i class="far fa-meh text-success"></i>
                                    </a>
                                </div>
                            </div>
                        </h3>
                    </div>

                    <div class="card-body py-1">
                        <div class="d-flex justify-content-between align-items-center ">
                            <div id="total_atencion_domiciliaria" class="text-primary text-xl">
                                0
                            </div>
                            <div class="d-flex flex-column text-right">
                                <div>
                                    <table>
                                        <tr>
                                            <th align="right">Traslados:</th>
                                            <td id="total_traslados">0</td>
                                        </tr>
                                        <tr>
                                            <th align="right">A. Domiciliaria:</th>
                                            <td id="total_ad"><i
                                                    class="ion ion-android-arrow-down text-danger"></i> 5</td>
                                        </tr>

                                    </table>

                                </div>



                            </div>
                        </div>

                    </div>
                </div>
                <div class="card" style="border-radius: 15px;">
                    <div class="card-header border-0">
                        <h3 class="card-title w-100 text-gray">
                            <div class="d-flex align-items-center">
                                <div><i class="h1 text-info pc-atencion_al_paciente"></i></div>
                                <div class="flex-grow-1">Servicios de Apoyo Diagnóstico</div>
                                <div>
                                    <a href="#" class="bg-transparnt border-0"
                                        style="font-size: 1.875rem; margin-top: 0.01rem;">
                                        <i class="far fa-smile text-success"></i>
                                    </a>
                                </div>
                            </div>
                        </h3>
                    </div>

                    <div class="card-body py-1">
                        <div class="d-flex justify-content-between align-items-center ">
                            <div id="total_apoyo_diagnostico" class="text-primary text-xl">
                                0
                            </div>
                            <div class="d-flex flex-column text-right">
                                <div>
                                    <table>
                                        <tr>
                                            <th align="right">Laboratorios:</th>
                                            <td id="total_laboratorios">0</td>
                                        </tr>
                                        <tr>
                                            <th align="right">Imagenes:</th>
                                            <td id="total_imagenes"><i
                                                    class="ion ion-android-arrow-down text-danger"></i> 0</td>
                                        </tr>

                                    </table>

                                </div>



                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-7 col-xl-8">

                <div class="card" style="border-radius: 15px;">
                    <div class="card-header border-0">
                        <h3 class="card-title w-100 text-gray">
                            <div class="d-flex align-items-center">
                                <div><i class="h1 text-info pc-ambulatorio"></i></div>
                                <div class="flex-grow-1">Red Ambulatoria</div>
                                <div>
                                    <a href="#" class="bg-transparnt border-0"
                                        style="font-size: 1.875rem; margin-top: 0.01rem;">
                                        <i class="far fa-frown text-success"></i>
                                    </a>
                                </div>
                            </div>

                        </h3>

                    </div>
                    <div class="card-body p-0">
                        <div class="container-fluid">
                            <div class="row justify-content-between align-items-start ">
                                <div class="col-12 col-sm-3">
                                    <div
                                        class="d-flex mt-4 flex-sm-column justify-content-sm-center justify-content-around align-items-center">

                                        <div class="border-bottom pb-3">

                                            <div id="total_citas_consulta"
                                                class="description-percentage text-center text-primary text-xl">0
                                            </div>
                                            <div class="description-text text-center font-weight-bold">TOTAL
                                                EN PROCESO</div>

                                        </div>
                                        <div class="border-bottom pb-3">
                                            <div id="total_citas_finalizada"
                                                class="description-percentage text-center text-primary text-xl">0
                                            </div>
                                            <div class="description-text text-center font-weight-bold">TOTAL ATENDIDAS
                                            </div>
                                        </div>
                                        <div class="pb-3">

                                            <div id="total_citas"
                                                class="description-percentage text-center text-primary text-xl">0
                                            </div>
                                            <div class="description-text text-center font-weight-bold">TOTAL</div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-9 table-responsive">
                                    <table id="centros_salud" class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th valign="baseline" class="text-center text-primary"
                                                    rowspan="2">Centro de Salud</th>
                                                <th colspan="4" class="text-center h3 text-primary">Citas</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center px-2">En proceso</th>
                                                <th class="text-center px-2">Atendidas</th>
                                                <th class="text-center px-2">Total</th>
                                                {{-- <th class="text-center px-2">Satisfacción</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="px-1">
                                                    <div class="d-flex align-items-center">
                                                        <div><i class="pc-ambulatorio h3 text-secondary"></i></div>
                                                        <div>CMDLT</div>
                                                    </div>
                                                </td>
                                                <td id="centro_salud_1_total_citas_consulta" class="text-center">0
                                                </td>
                                                <td id="centro_salud_1_total_citas_finalizada" class="text-center">0
                                                </td>
                                                <td id="centro_salud_1_total_citas" class="text-center">0</td>
                                                {{-- <td class="text-center"><i class="far fa-frown text-success"></i> --}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</template>
<!-- listado medicos admin -->
<template id="artefacto_0052">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-8 text-center">
                <h3 class="text-primary font-weight-bold">Equipo Médico</h3>
            </div>
            <div class="col-12">
                <div class="table-responsive mb-3">
                    <table id="index_table_medicos" class="table table-bordered bg-white mb-3">
                        <thead>

                            <tr>
                                <th class="text-primary sticky-top text-center">Foto</th>
                                <th class="text-primary sticky-top text-center">Médico</th>
                                <th class="text-primary sticky-top text-center">Sexo</th>
                                <th class="text-primary sticky-top text-center">Cédula</th>
                                <th class="text-primary sticky-top text-center">Teléfono</th>
                                <th class="text-primary sticky-top text-center">Correo</th>
                                <th class="text-primary sticky-top text-center">Especialidad</th>
                                <th class="text-primary sticky-top text-center">Estatus</th>
                                <th class="text-primary sticky-top text-center">Rol</th>
                                <th class="text-primary sticky-top text-center" nowrap>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="filas">
                            <tr>
                                <td colspan="10" class="text-center">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<!-- busqueda paciente admin -->
<template id="artefacto_0053">
    <section class="content">
        <div class="container-fluid">
            {{-- <h2 class="text-center display-4 text-primary">Buscador</h2> --}}

            <div class="row">

                <div class="col-md-10 offset-md-1">
                    <div class="input-group input-group-lg mb-2">
                        <input type="search" name="search_value"
                            class="form-control form-control-lg"placeholder="Escribe las palabras a buscar aquí...">
                        <div class="input-group-append">
                            <button type="button" class="btn-paciente-search btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 offset-md-1">
                    <div class="table-responsive  d-sm-flex justify-content-sm-center">
                        <table id="citas_pacientes" class="w-100 bg-white table-bordered table-hover">
                            <thead style="font-size: 1.2em;">
                                <tr>
                                    <th class="text-primary p-2 text-center" colspan="2">Paciente</th>
                                    <th class="text-primary p-2 text-center">Total Citas</th>
                                    <th class="text-primary p-2 text-center">Exonerado</th>
                                    <th class="text-primary p-2 text-center">Roles</th>
                                    <th class="text-primary p-2 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6" class="text-primary p-2 text-center">
                                        Sin pacientes
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
</template>
<!-- row busqueda paciente admin -->
<template id="artefacto_0054">
    <tr>
        <td>
            <div class="container-fluid p-0 m-0">
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-column " style="width: fit-content">
                        <i class="tag-exonerado d-none text-right font-weight-bold px-3 align-items-center"
                            style="border-bottom-right-radius: 20px;"><i class="fas fa-check-double"></i>
                            Exonerado</i>
                    </div>
                    <div class="d-flex flex-column justify-content-end" style="width: fit-content">
                        <div class="d-none tag-condicion-cortesia-referido text-right font-weight-bold px-3 border">
                        </div>
                        <div class="d-none tag-condicion-cortesia text-right font-weight-bold px-3 bg-success"
                            style="border-bottom-left-radius: 20px;">Particular</div>
                    </div>
                </div>
                <div class="d-flex flex-row" style="height:100%">
                    <div class="flex-fill align-self-start flex-grow-1">
                        <div class="d-flex flex-row  border-bottom">
                            <div class="d-flex" style="align-items: center;">
                                <div class="m-1">
                                    <img onerror="this.src='/image/system/icono-paciente-blanco.svg';"
                                        src="/image/system/icono-paciente-blanco.svg"
                                        style="width:1.5cm;height:1.5cm" data-tippy-content="Imagen del paciente"
                                        class="card-item-paciente-imagen tooltip-primary border border-primary card-item-paciente-image rounded-circle mx-auto d-block"
                                        alt="...">
                                </div>
                                <div>
                                    <div>
                                        <h4 data-tippy-content="Nombre del paciente"
                                            class="tooltip-primary card-item-paciente-fullname text-primary"
                                            style="margin-bottom: 0;white-space: normal;">Sample Nombre Sample
                                            Apellido</h4>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="d-flex flex-fill  align-self-start">
                                <div class="d-flex  flex-column flex-fill align-items-center">
                                    <div data-tippy-content="Documento de identidad del paciente"
                                        class="tooltip-primary d-flex flex-fill justify-content-center">
                                        <b class="text-primary" style="font-size:0.8em;">Cédula</b>
                                    </div>
                                    <div class="d-flex flex-fill justify-content-center">
                                        <div class="text-gray text-nowrap overflow-hidden card-item-paciente-cedula">
                                            0.000.000</div>
                                    </div>
                                </div>
                                <div data-tippy-content="Edad del paciente"
                                    class="tooltip-primary d-flex flex-column  flex-fill align-items-center border-left border-right">
                                    <div class="d-flex flex-fill justify-content-center">
                                        <b class="text-primary" style="font-size:0.8em;">Edad</b>
                                    </div>
                                    <div class="d-flex flex-fill justify-content-center">
                                        <div class="text-gray card-item-paciente-edad">00</div>
                                    </div>
                                </div>
                                <div data-tippy-content="Genero del paciente"
                                    class="tooltip-primary d-flex flex-column flex-fill align-items-center">
                                    <div class="d-flex flex-fill justify-content-center">
                                        <b class="text-primary" style="font-size:0.8em;">Sexo</b>
                                    </div>
                                    <div class="d-flex p-1 flex-fill justify-content-center">
                                        <div class="text-gray card-item-paciente-genero">n/i</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- <small style="color:#F4F7F7">#9999</small> --}}
        </td>
        <td class="card-item-tarjeta-soy-chacao text-center">
            <div class="container-fluid p-0 m-0">
                <div class="d-flex flex-column">
                    <div class="tarjeta-salud-chacao pb-1">
                        <div class="text-center">
                            <b class="text-gray" style="font-size:0.9em;">Soy CMDLT</b>
                        </div>
                        <div class="d-flex justify-content-center w-100">
                            <div class="badge text-black badge-gray card-item-paciente-tarjeta-chacao">No
                                posee</div>
                        </div>
                    </div>
                    <div>
                        <div class="text-center">
                            <b class="text-primary" style="font-size:0.9em;">
                                Teléfono Contacto
                            </b>
                        </div>
                        <div class="d-flex flex-fill mb-1 justify-content-center">
                            <a class="enlace-whatsapp btn btn-default mx-1 btn-block text-nowrap btn-sm tooltip-primary"
                                data-tippy-content="Teléfono contacto del paciente: +No Indicado">
                                <i class="fab fa-whatsapp enlace-whatsapp text-success" aria-hidden="true"></i>
                                <span class=" enlace-whatsapp card-item-paciente-telefono-movil">+580000000000</span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </td>
        <td class="card-item-total-citas text-center">0</td>
        <td class="card-exonerado text-center">
            <div class="dropdown">
                <button class="btn btn-default border-0 btn-block dropdown-toggle" type="button" id="trigger"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    0%
                </button>
                <div id="option_exonerado" class="dropdown-menu" aria-labelledby="trigger">
                    <a data-exonerado="0" class="btn-exonerado-update dropdown-item" href="#">0%</a>
                    <a data-exonerado="25" class="btn-exonerado-update dropdown-item" href="#">25%</a>
                    <a data-exonerado="50" class="btn-exonerado-update dropdown-item" href="#">50%</a>
                    <a data-exonerado="75" class="btn-exonerado-update dropdown-item" href="#">75%</a>
                    <a data-exonerado="100" class="btn-exonerado-update dropdown-item" href="#">100%</a>
                </div>
            </div>
        </td>
        <td class="card-roles text-center">
            <ul class="list-group list-group-horizontal">
                <li data-cat_user_type_id="1" title="Paciente"
                    class="btn-roles rol-paciente list-group-item list-group-item-action flex-fill p-1"><i
                        style="font-size: 1.5rem;" data-cat_user_type_id="1" class="btn-roles pc-paciente"></i>
                </li>
                <li data-cat_user_type_id="2" title="Médico"
                    class="btn-roles rol-medico list-group-item list-group-item-action flex-fill p-1"><i
                        style="font-size: 1.5rem;" data-cat_user_type_id="2" class="btn-roles pc-medico"></i></li>
                <li data-cat_user_type_id="6" title="Enfermero"
                    class="btn-roles rol-enfermeria list-group-item list-group-item-action flex-fill p-1"><i
                        style="font-size: 1.5rem;" data-cat_user_type_id="6" class="btn-roles pc-enfermeria"></i>
                </li>
                <li data-cat_user_type_id="7" title="Atención al Paciente"
                    class="btn-roles rol-atencion-paciente list-group-item list-group-item-action flex-fill p-1"><i
                        style="font-size: 1.5rem;" data-cat_user_type_id="7"
                        class="btn-roles pc-atencion_al_paciente"></i>
                </li>
                <li data-cat_user_type_id="4" title="Administrador"
                    class="btn-roles rol-administrador list-group-item list-group-item-action flex-fill p-1"><i
                        style="font-size: 1.5rem;" data-cat_user_type_id="4"
                        class="btn-roles pc-administrador"></i>
                </li>
                {{-- <li title="Delete"
                    class="btn-roles list-group-item list-group-item-action flex-fill p-1">
                        <i class="fas fa-trash-alt"></i>
                </li>
                <li title="EditPass"
                    class="btn-roles list-group-item list-group-item-action flex-fill p-1">
                    <i class="fas fa-key"></i>
                </li> --}}
            </ul>
        </td>
        <td class="botones-fila" style="width: 160px;">
            <a class="btn btn-info btn-block btn-sm btn-reset-pass-paciente mb-1" href="#" role="button">
                Restablecer contraseña
            </a>
            <a class="btn btn-success btn-block btn-sm btn-edit-paciente mb-1" href="#" role="button">
                Editar
            </a>
            <a class="btn btn-danger btn-block btn-sm btn-delete-paciente mb-1" href="#" role="button">
                Eliminar
            </a>
            {{-- <a class="btn btn-success btn-block btn-sm buscador_nueva_cita mb-1" href="#" role="button">
                <i class="buscador_nueva_cita"></i> Nueva Cita
            </a>
            <a class="btn btn-info btn-block btn-sm paciente-edit mb-1" href="#" role="button">
                <i class="fas fa-edit paciente-edit"></i> Editar
            </a>
            <a title="Historial de citas completadas"
                class="btn btn-primary btn-block btn-sm paciente-historial-citas mb-1" href="#" role="button">
                <i class="fas fa-history paciente-historial-citas"></i> Historial
            </a> --}}
        </td>
    </tr>
</template>
<!-- listado medicos admin -->
<template id="artefacto_0055">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-8 text-center">
                <h3 class="text-primary font-weight-bold">Pacientes Exonerados</h3>
            </div>
            <div class="col-12">
                <div class="table-responsive mb-3">
                    <table id="index_table_medicos" class="table table-bordered bg-white mb-3">
                        <thead>

                            <tr>
                                <th class="text-primary sticky-top text-center">Foto</th>
                                <th class="text-primary sticky-top text-center">Paciente</th>
                                <th class="text-primary sticky-top text-center">Sexo</th>
                                <th class="text-primary sticky-top text-center">Cédula</th>
                                <th class="text-primary sticky-top text-center">Teléfono</th>
                                <th class="text-primary sticky-top text-center">Correo</th>
                                <th class="text-primary sticky-top text-center">Exonerado</th>
                                <th class="text-primary sticky-top text-center">Motivo exoneración</th>
                                <th class="text-primary sticky-top text-center" nowrap>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="filas">
                            <tr>
                                <td colspan="8" class="text-center">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Por favor espere...</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<!--  -->
<template id="artefacto_0056">
</template>
<!-- dashboard reportes -->
<template id="artefacto_0057">
    <div class="container-fluid my-1">
        <div class="row">
            <div class="col-12 col-sm-6 text-sm-right"><b>Desde: </b> <input id="dateStart" type="date"
                    class="bg-transparnt mt-1 border-0 shadow-sm" style="border-radius: 10px;padding: 0.4% 1%;"
                    value="{{ date('Y-m') . '-01' }}"></div>
            <div class="col-12 col-sm-6 text-sm-left"><b>Hasta: </b> <input id="dateEnd" type="date"
                    class="bg-transparnt mt-1 border-0 shadow-sm" style="border-radius: 10px;padding: 0.4% 1%;"
                    value="{{ date('Y-m-d') }}"></div>
        </div>
    </div>
    <div class="container">
        <div id="report_list" class="row">
            <div class="col-2">
                <a href="#" class="btn_reporte card card-reporte-excel">
                    <i class="pc-excel display-3"></i>
                    <small class=" mb-2">
                        Excel
                    </small>
                    <h5 class="font-weight-bold">
                        Total Citas Completadas por Médico
                    </h5>
                    <p class="m-0">
                        Resumen y detalle
                    </p>
                </a>
            </div>
            <div class="col-2">
                <a href="#" class="btn_reporte card card-reporte-excel">
                    <i class="pc-excel display-3"></i>
                    <small class=" mb-2">
                        Excel
                    </small>
                    <h5 class="font-weight-bold">
                        Solicitud de citas
                    </h5>
                    <p class="m-0">
                        Detalle
                    </p>
                </a>
            </div>
            <div class="col-2">
                <a href="#" class="btn_reporte card card-reporte-excel">
                    <i class="pc-excel display-3"></i>
                    <small class=" mb-2">
                        Excel
                    </small>
                    <h5 class="font-weight-bold">
                        Pacientes Registrados
                    </h5>
                    <p class="m-0">
                        Detalle
                    </p>
                </a>
            </div>
        </div>
    </div>
</template>
<!-- listado familiares -->
<template id="artefacto_0058">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-8 text-center">
                <h3 class="text-primary font-weight-bold">Aprobación de Familiar</h3>
            </div>
            <div class="col-12">
                <div class="table-responsive mb-3">
                    <table id="index_table_familiar" class="table table-bordered bg-white mb-3">
                        <thead>
                            <tr>
                                <th class="text-primary sticky-top text-center">Paciente</th>
                                <th class="text-primary sticky-top text-center">Cédula Paciente</th>
                                <th class="text-primary sticky-top text-center">Parentesco</th>
                                <th class="text-primary sticky-top text-center">Familiar</th>
                                <th class="text-primary sticky-top text-center">Cédula Familiar</th>
                                <th class="text-primary sticky-top text-center">¿Verificado?</th>
                            </tr>
                        </thead>
                        <tbody id="filas">
                            <tr>
                                <td colspan="7" class="text-center">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Por favor espere...</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<!-- restablecer contraseña -->
<template id="artefacto_0059">
    <!-- Form User Create externo -->
    <div class="row w-100 justify-content-center">
        <div class="col-8">

                <div class="container">
                    <div class="overlay-wrapper pb-5">
                        <div class="overlay d-none">
                            <i class="fas fa-3x fa-sync-alt text-primary fa-spin"></i>
                            <div class="text-bold text-primary pt-2">Por favor espere...</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-primary text-center font-weight-bold">Restablecer Contraseña</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="form-group mt-3">
                                    <label class="text-primary" for="cedula">Escribe el número de cédula del paciente</label>
                                    <input required title="Un Documento de identidad es requerido"
                                        type="text" class="text-center form-control"
                                        name="cedula" id="cedula" aria-describedby="help_cedula"
                                        >
                                    <small id="help_cedula" class="notification text-gray">Al restablecer la contraseña, la misma volverá a ser: <b style="letter-spacing: 2px;">123456</b></small>
                                </div>
                            </div>
                        </div>
                        <div class="row my-2 justify-content-center">

                            <div class="col-6">
                                <button id="submit" type="submit"
                                    class="btn btn-success btn-block">Restablecer</button>
                            </div>
                        </div>

                    </div>
                </div>

        </div>
    </div>

</template>
<!-- nuevo  módulo agendamiento -->
<template id="artefacto_0060">
    <div class="overlay-wrapper" style="
            overflow: auto;
            height: 83vh;
        ">
        <div class="overlay text-primary d-none">
            <i class="fas fa-3x fa-sync-alt fa-spin text-primary"></i>
            <div class="text-bold pt-2">
                Espere un momento por favor...
            </div>
        </div>
        <div class="container mt-2">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-5 col-lg-5 col-xl-4 overflow-auto">
                    <article class="btn-medico-index">
                        <button class="btn btn-outline-info mb-1 btn-block btn-medico-index" style="position: fixed;top: 97px;width: 365px;border-radius: 15px;font-weight: bold;"><i class="pc-medico"></i> Regresar</button>
                    </article>
                    <article class="d-flex align-items-center area-agenda bg-primary text-white">
                        <img class="rounded-circle medico-imagen" onerror="this.src='/image/system/icono-paciente-blanco.svg';" width="50" height="50" src="https://via.placeholder.com/300.png" alt="">
                        <h4 class="pl-1 medico-fullname"></h4>
                    </article>
                    <article class="area-agenda mt-2">
                        <h4 class="header text-primary">
                            Mis ambulatorios
                        </h4>
                        <div class="body">
                            <section class="d-flex mb-2">
                                <div class="bg-primary rounded-circle text-white" style="line-height: 0.5;text-align: center;width: 30px;height: 30px;padding: 0.7rem;">1</div>
                                <div class="pl-2 flex-grow-1">
                                    <label class="text-primary " for="centro_salud_id">Seleccione Centro de salud</label>
                                    <select class="form-control" name="centro_salud_id" id="centro_salud_id">
                                        <option value="">Seleccione</option>
                                    </select>
                                </div>
                            </section>
                            {{-- <select name="cat_centro_salud_medico" id="cat_centro_salud_medico" class="form-control"></select> --}}
                        </div>
                    </article>
                    <article class="area-agenda mt-2">
                        <h4 class="header text-primary">
                            Mis especialidades
                        </h4>
                        <div class="body">
                            <section class="d-flex mb-2">
                                <div class="bg-primary rounded-circle text-white" style="line-height: 0.5;text-align: center;width: 30px;height: 30px;padding: 0.7rem;">2</div>
                                <div class="pl-2 flex-grow-1">
                                    <label class="text-primary " for="cat_especialidad_id">Seleccione la Especialidad</label>
                                    <select class="form-control" name="cat_especialidad_id" id="cat_especialidad_id">

                                    </select>
                                </div>
                            </section>
                            {{-- <select name="cat_especialidades_medico" id="cat_especialidades_medico" class="form-control"></select> --}}
                        </div>
                    </article>
                    <article class="area-agenda mt-2">
                        <h4 class="header text-primary">
                            Mis citas
                        </h4>
                        <div class="body">
                            <div id="datepicker"></div>
                            <input type="hidden" id="my_hidden_input">
                        </div>
                    </article>

                </div>
                <div class="col-12 col-sm-6 col-md-7 col-lg-7 col-xl-8" style="height:82vh">
                    <!-- <div class="col-12 col-sm-6 col-md-7 col-lg-7 offset-2 col-xl-8" > -->
                    <ul class="area-agenda nav nav-pills mb-3"
                        style="padding:0.8rem" id="pills-tab" role="tablist">
                        <li class="flex-grow-1 nav-item align-content-start" role="presentation">
                            <h3 class="text-primary fecha-hoy"></h3>
                        </li>
                        <li class="d-none nav-item" role="presentation">
                            <a class="nav-link" id="pills-horas-calendario-tab" data-toggle="pill"
                                href="#pills-horas-calendario" role="tab" aria-controls="pills-horas-calendario"
                                aria-selected="true">horas-calendario</a>
                        </li>
                        <li class="nav-item pr-1 active" role="presentation">
                            <a class="btn btn-primary" id="pills-index-agenda-tab" data-toggle="pill"
                                href="#pills-index-agenda" role="tab" aria-controls="pills-index-agenda"
                                aria-selected="false">Mis Agendas</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="btn btn-info" id="pills-crear-agenda-tab" data-toggle="pill"
                                href="#pills-crear-agenda" role="tab" aria-controls="pills-crear-agenda"
                                aria-selected="false">Nueva Agenda</a>
                        </li>
                    </ul>
                    <div class="tab-content pb-5" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-index-agenda" role="tabpanel"
                            aria-labelledby="pills-horas-calendario-tab">
                            <article class="area-agenda mt-2">
                                <h4 class="header text-primary">
                                    Mis agendas
                                </h4>
                                <div id="mis_agendas" class="body">
                                    {{-- <div class="row">
                                        <div class="col-12 text-center text-secondary">
                                            No posees agendas
                                        </div>
                                    </div> --}}
                                    <div class="row d-none">

                                        <div class="col-12">
                                            <img src="http://127.0.0.1:8000/image/system/especialidades/gastroenterologia.svg"
                                                style="height: 1.5rem;width:1.5rem;">
                                            <b>Gastroenterología</b>
                                        </div>
                                        <div class="col-12">
                                            <img src="http://127.0.0.1:8000/image/system/especialidades/gastroenterologia.svg"
                                                style="height: 1.5rem;width:1.5rem;">
                                            <b class="p-0 text-secondary text-nowrap" style="font-size:0.8rem;">
                                                Ambulatorio Bello Campo
                                            </b>
                                        </div>
                                        <!-- <div class="col-6 col-sm-6 col-lg-4">
                                            <div class="dia-horario">
                                                <b>
                                                    LUN
                                                </b>
                                                <div class="d-flex text-nowrap">
                                                    <div class="text-center" style="width: 10px">
                                                    <b title="Inicio" class="text-success">I</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                    00:00 AM
                                                    </div>
                                                </div>
                                                <div class="d-flex text-nowrap">
                                                    <div class=" text-center" style="width: 10px">
                                                    <b title="Fín" class="text-info">F</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                    00:00 AM
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-6 col-lg-4">
                                                <div class="dia-horario">
                                                <b>
                                                    MAR
                                                </b>
                                                <div class="d-flex text-nowrap">
                                                    <div class="text-center" style="width: 10px">
                                                    <b title="Inicio" class="text-success">I</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                    00:00 AM
                                                    </div>
                                                </div>
                                                <div class="d-flex text-nowrap">
                                                    <div class=" text-center" style="width: 10px">
                                                    <b title="Fín" class="text-info">F</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                    00:00 AM
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-6 col-lg-4">
                                                <div class="dia-horario">
                                                <b>
                                                    MIE
                                                </b>
                                                <div class="d-flex text-nowrap">
                                                    <div class="text-center" style="width: 10px">
                                                    <b title="Inicio" class="text-success">I</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                    00:00 AM
                                                    </div>
                                                </div>
                                                <div class="d-flex text-nowrap">
                                                    <div class=" text-center" style="width: 10px">
                                                    <b title="Fín" class="text-info">F</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                    00:00 AM
                                                    </div>
                                                </div>
                                                </div>
                                            </div>

                                        <div class="col-6 col-sm-6 col-lg-4">
                                            <div class="dia-horario dia-horario-tarde">
                                                <b>
                                                    JUE
                                                </b>
                                                <div class="d-flex text-nowrap">
                                                    <div class="text-center" style="width: 10px">
                                                        <b title="Inicio" class="text-success">I</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                        00:00 PM
                                                    </div>
                                                </div>
                                                <div class="d-flex text-nowrap">
                                                    <div class=" text-center" style="width: 10px">
                                                        <b title="Fín" class="text-info">F</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                        00:00 PM
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-6 col-lg-4">
                                            <div class="dia-horario dia-horario-dia">
                                                <b>
                                                    VIE
                                                </b>
                                                <div class="d-flex text-nowrap">
                                                    <div class="text-center" style="width: 10px">
                                                        <b title="Inicio" class="text-success">I</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                        00:00 AM
                                                    </div>
                                                </div>
                                                <div class="d-flex text-nowrap">
                                                    <div class=" text-center" style="width: 10px">
                                                        <b title="Fín" class="text-info">F</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                        00:00 AM
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->
                                    </div>
                                    <hr>
                                    <div class="row d-none">
                                        <div class="col-12">
                                            <img src="http://127.0.0.1:8000/image/system/especialidades/gastroenterologia.svg"
                                                style="height: 1.5rem;width:1.5rem;">
                                            <b>Gastroenterología</b>
                                        </div>
                                        <div class="col-12">
                                            <b class="p-0 text-secondary text-nowrap" style="font-size:0.8rem;">
                                                Ambulatorio Bello Campo
                                            </b>
                                        </div>
                                        <div class="col-6 col-sm-6 col-lg-4">
                                            <div class="dia-horario dia-horario-dia">
                                                <b>
                                                    LUN
                                                </b>
                                                <div class="d-flex text-nowrap">
                                                    <div class="text-center" style="width: 10px">
                                                        <b title="Inicio" class="text-success">I</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                        00:00 AM
                                                    </div>
                                                </div>
                                                <div class="d-flex text-nowrap">
                                                    <div class=" text-center" style="width: 10px">
                                                        <b title="Fín" class="text-info">F</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                        00:00 AM
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-6 col-lg-4">
                                            <div class="dia-horario dia-horario-dia">
                                                <b>
                                                    MAR
                                                </b>
                                                <div class="d-flex text-nowrap">
                                                    <div class="text-center" style="width: 10px">
                                                        <b title="Inicio" class="text-success">I</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                        00:00 AM
                                                    </div>
                                                </div>
                                                <div class="d-flex text-nowrap">
                                                    <div class=" text-center" style="width: 10px">
                                                        <b title="Fín" class="text-info">F</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                        00:00 AM
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-6 col-sm-6 col-lg-4">
                                                <div class="dia-horario">
                                                <b>
                                                    MIE
                                                </b>
                                                <div class="d-flex text-nowrap">
                                                    <div class="text-center" style="width: 10px">
                                                    <b title="Inicio" class="text-success">I</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                    00:00 AM
                                                    </div>
                                                </div>
                                                <div class="d-flex text-nowrap">
                                                    <div class=" text-center" style="width: 10px">
                                                    <b title="Fín" class="text-info">F</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                    00:00 AM
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-6 col-lg-4">
                                                <div class="dia-horario">
                                                <b>
                                                    JUE
                                                </b>
                                                <div class="d-flex text-nowrap">
                                                    <div class="text-center" style="width: 10px">
                                                    <b title="Inicio" class="text-success">I</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                    00:00 AM
                                                    </div>
                                                </div>
                                                <div class="d-flex text-nowrap">
                                                    <div class=" text-center" style="width: 10px">
                                                    <b title="Fín" class="text-info">F</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                    00:00 AM
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-6 col-lg-4">
                                                <div class="dia-horario">
                                                <b>
                                                    VIE
                                                </b>
                                                <div class="d-flex text-nowrap">
                                                    <div class="text-center" style="width: 10px">
                                                    <b title="Inicio" class="text-success">I</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                    00:00 AM
                                                    </div>
                                                </div>
                                                <div class="d-flex text-nowrap">
                                                    <div class=" text-center" style="width: 10px">
                                                    <b title="Fín" class="text-info">F</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                    00:00 AM
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        -->
                                    </div>
                                </div>
                            </article>
                            {{-- <article class="area-agenda mt-2">
                                <h4 class="header text-primary">
                                    Citas para hoy
                                </h4>
                                <div id="mis_agendas" class="body">
                                    <div class="row">
                                        <div class="col-12 text-center text-secondary">
                                            No posees citas para hoy
                                        </div>
                                    </div>
                                </div>
                            </article> --}}

                        </div>
                        <div class="tab-pane fade" id="pills-horas-calendario" role="tabpanel"
                            aria-labelledby="pills-horas-calendario-tab">
                            <div id="listado_horas-calendario">

                            </div>
                        </div>
                        <div class="tab-pane fade  overflow-auto"  style="height:68vh" id="pills-crear-agenda" role="tabpanel"
                            aria-labelledby="pills-crear-agenda-tab">
                            <section class="d-flex mb-2">
                                <div class="bg-primary rounded-circle text-white" style="line-height: 0.5;text-align: center;width: 30px;height: 30px;padding: 0.7rem;">3</div>
                                <div class="pl-2 container-fluid overflow-auto">
                                    <label class="text-primary" for="">Seleccione mes</label>
                                    <div class="row">

                                        <h6 class="col-3 text-primary font-weight-bold">
                                            Mes
                                        </h6>
                                        <h6 class="col-9 text-primary font-weight-bold">
                                            Semanas
                                        </h6>
                                        <div class="col-3 mb-2">
                                            <div class="bg-light pl-2">
                                                <input id="todo_el_anio" checked type="checkbox" name="agenda_month" value="12"> Todo el año
                                            </div>

                                        </div>
                                        <div class="col-8 bg-light mb-2">
                                            <div class="d-flex flex-wrap">
                                                <div class="d-flex mr-2 px-2 bg-light rounded">
                                                    <input id="semana_1" checked type="checkbox" class="switch-semana" name="month_semana_1" value="1">
                                                    <label for="semana_1" style="line-height: 1.9;" class="cursor-pointer pl-1 mb-0 font-weight-normal pl-1">S1</label>
                                                </div>
                                                <div class="d-flex mr-2 px-2 bg-light rounded">
                                                    <input id="semana_2" checked type="checkbox" class="switch-semana" name="month_semana_2" value="2">
                                                    <label for="semana_2" style="line-height: 1.9;" class="cursor-pointer pl-1 mb-0 font-weight-normal pl-1">S2</label>
                                                </div>
                                                <div class="d-flex mr-2 px-2 bg-light rounded">
                                                    <input id="semana_3" checked type="checkbox" class="switch-semana" name="month_semana_3" value="3">
                                                    <label for="semana_3" style="line-height: 1.9;" class="cursor-pointer pl-1 mb-0 font-weight-normal pl-1">S3</label>
                                                </div>
                                                <div class="d-flex mr-2 px-2 bg-light rounded">
                                                    <input id="semana_4" checked type="checkbox" class="switch-semana" name="month_semana_4" value="4">
                                                    <label for="semana_4" style="line-height: 1.9;" class="cursor-pointer pl-1 mb-0 font-weight-normal pl-1">S4</label>
                                                </div>
                                                <div class="d-flex mr-2 px-2 bg-light rounded">
                                                    <input id="semana_5" checked type="checkbox" class="switch-semana" name="month_semana_5" value="5">
                                                    <label for="semana_5" style="line-height: 1.9;" class="cursor-pointer pl-1 mb-0 font-weight-normal pl-1">S5</label>
                                                </div>
                                                <div class="d-flex mr-2 px-2 bg-light rounded">
                                                    <input id="semana_6" checked type="checkbox" class="switch-semana" name="month_semana_6" value="6">
                                                    <label for="semana_6" style="line-height: 1.9;" class="cursor-pointer pl-1 mb-0 font-weight-normal pl-1">S6</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="container_meses" class="row">

                                    </div>
                                </div>
                            </section>

                            <section class="d-flex mb-2">
                                <div class="bg-primary rounded-circle text-white" style="line-height: 0.5;text-align: center;width: 30px;height: 30px;padding: 0.7rem;">4</div>
                                    <div class="pl-2 container-fluid overflow-auto">
                                        <label class="text-primary" for="">Configure días, turno, y horas</label>
                                        <div class="row">
                                            <div class="col-3 text-center font-weight-bold text-primary" style="font-size: 0.8rem;">
                                                Dia<br>
                                            </div>
                                            <div class="col-3 text-center font-weight-bold text-primary" style="font-size: 0.8rem;">
                                                Mañana<br>
                                                (8:00 AM a 11:00 PM)
                                            </div>
                                            <div class="col-3 text-center font-weight-bold text-primary" style="font-size: 0.8rem;">
                                                Tarde<br>
                                                (1:00 PM a 4:00 PM)
                                            </div>
                                            <div class="col-3 text-center font-weight-bold text-primary" style="font-size: 0.8rem;">
                                                Todo el día<br>
                                                (8:00 AM a 4:00 PM)
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3 bg-light mb-2">
                                                <input id="todos_los_dias" type="checkbox"  name="agenda_day_week" value="7"> Todos los días
                                            </div>
                                            <div class="col-3 bg-light mb-2 text-center">
                                                <input type="radio" class="grupo_turno_dia" name="grupo_turno_dia" value="Mañana">
                                                <button data-turno="Mañana" class="cursor-pointer configurar-horas float-right btn btn-outline-primary btn-sm mb-1" style="visibility: hidden;">
                                                    <i data-turno="Mañana" class="configurar-horas agenda_turno fa fa-clock"></i>
                                                </button>
                                            </div>
                                            <div class="col-3 bg-light mb-2 text-center">
                                                <input type="radio" class="grupo_turno_dia" name="grupo_turno_dia" value="Tarde">
                                                <button data-turno="Mañana" class="cursor-pointer configurar-horas float-right btn btn-outline-primary btn-sm mb-1" style="visibility: hidden;">
                                                    <i data-turno="Mañana" class="configurar-horas agenda_turno fa fa-clock"></i>
                                                </button>
                                            </div>
                                            <div class="col-3 bg-light mb-2 text-center">
                                                <input type="radio" class="grupo_turno_dia" name="grupo_turno_dia" value="Todo el dia">
                                                <button data-turno="Mañana" class="cursor-pointer configurar-horas float-right btn btn-outline-primary btn-sm mb-1" style="visibility: hidden;">
                                                    <i data-turno="Mañana" class="configurar-horas agenda_turno fa fa-clock"></i>
                                                </button>
                                            </div>

                                        </div>
                                        <div id="container_dias" class="row">

                                        </div>
                                    </div>

                            </section>
                            <section class="d-none mb-2">
                                <div class="bg-primary rounded-circle text-white" style="line-height: 0.5;text-align: center;width: 30px;height: 30px;padding: 0.7rem;">5</div>
                                <div class="pl-2 container-fluid overflow-auto">
                                    <label class="text-primary" for="">Tiempo de visualización de agenda <span class="text-gray">(Opcional)</span></label>
                                    <div class="row">
                                        <div class="col-6" >
                                            <div class="form-group">
                                                <label for="agenda_desde">Desde</label>
                                                <input type="date" class="form-control" name="agenda_desde" id="agenda_desde" aria-describedby="helpagenda_desde">
                                                <small id="helpagenda_desde" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-6" >
                                            <div class="form-group">
                                                <label for="agenda_hasta">Hasta</label>
                                                <input type="date" class="form-control" name="agenda_hasta" id="agenda_hasta" aria-describedby="helpagenda_hasta">
                                                <small id="helpagenda_hasta" class="form-text text-muted"></small>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </section>
                            <section class="d-flex mb-2">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-6 offset-3">
                                            <button id="submitAgendaCreate" class="btn btn-success btn-block">Añadir a Mis Agendas</button>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<!-- ----------------------------------------------------------------- -->
<template id="nav_info_paciente">
    <nav class="navbar navbar-light bg-light justify-content-around">
        <div class="container-fluid">
            <div class="row">
                <div class="col">

                    <div class="d-flex flex-column">
                        <div class="d-flex cursor-pointer btn-default align-items-center border-bottom"
                            data-toggle="collapse" data-target=".navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <div>
                                <img onerror="this.src='/image/system/icono-paciente-blanco.svg';"
                                    src="/image/system/patient.svg" style="width:1.5cm;height:1.5cm"
                                    data-tippy-content="Imagen del paciente"
                                    class="tooltip-primary border border-primary rounded-circle mx-auto d-block"
                                    alt="Imagen Paciente">
                            </div>
                            <div>
                                <div class="overflow-hidden pl-1">
                                    <h4 data-tippy-content="Nombre del paciente"
                                        class="m-0 p-0 tooltip-primary text-primary" style="white-space: normal;">
                                        Name First name Lastname
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around align-items-center">

                            <div>
                                <div class="px-2 tooltip-primary text-center"
                                    data-tippy-content="Cédula del paciente">
                                    <b class="text-primary" style="font-size:0.8em;">Cédula</b>
                                    <div class="text-gray">
                                        V-00.000.000
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div data-tippy-content="Edad"
                                    class="px-2 tooltip-primary text-center border-left border-right">
                                    <b class="text-primary" style="font-size:0.8em;">Edad</b>
                                    <div class="text-gray">
                                        00
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="px-2 tooltip-primary text-center" data-tippy-content="Sexo">
                                    <b class="text-primary" style="font-size:0.8em;">Sexo</b>
                                    <div class="text-gray">
                                        N/I
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                <div class="col navbar-expand-sm">
                    <div class="collapse navbar-collapse navbarSupportedContent mb-2">
                        <ul class="navbar-nav w-100">
                            <li class="nav-item w-100">
                                <ul class="list-group">
                                    <li class="list-group-item text-center p-1">
                                        <b class="text-primary" style="font-size:0.8em;">Fecha ingreso</b>
                                        <div class="text-center overflow-hidden">
                                            <input type="date" class="border-transparent">
                                        </div>
                                    </li>
                                    <li class="list-group-item text-center p-1">

                                        <b class="text-primary" style="font-size:0.8em;">Ubicación Actual <span
                                                class="badge badge-gray text-primary">0</span></b>
                                        <div class="text-center">
                                            No Indicado
                                        </div>
                                    </li>
                                    <li class="enlace-whatsapp list-group-item text-center p-1">

                                        <b class="text-primary" style="font-size:0.8em;">Teléfono Contacto</b>
                                        <div class="text-center">
                                            <a target="_blank"
                                                href="https://api.whatsapp.com/send?phone=04149320905"
                                                style="line-height: 1.4;"
                                                class="btn btn-default btn-block border-0">
                                                <i class="fab fa-whatsapp text-success"></i> 04140000000
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col navbar-expand-md">
                    <div class="collapse navbar-collapse flex-column navbarSupportedContent mb-2">
                        <ul class="nav nav-pills justify-content-md-center  justify-content-lg-end w-100"
                            id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link py-1 active" id="impresion_diagnostica-tab" data-toggle="tab"
                                    href="#impresion_diagnostica" role="tab"
                                    aria-controls="impresion_diagnostica" aria-selected="true">Prob. Diag.</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-1" id="evolucion-tab" data-toggle="tab" href="#evolucion"
                                    role="tab" aria-controls="evolucion" aria-selected="false">Evolución</a>
                            </li>

                        </ul>
                        <div class="tab-content overflow-auto" id="myTabContent" style="max-height: 135px;">
                            <div class="tab-pane fade show active" id="impresion_diagnostica" role="tabpanel"
                                aria-labelledby="impresion_diagnostica-tab">
                                <ul class="list-group  list-group-flush">

                                </ul>
                            </div>
                            <div class="tab-pane fade" id="evolucion" role="tabpanel"
                                aria-labelledby="evolucion-tab">
                                2Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil distinctio, corrupti
                                neque temporibus sequi harum voluptatibus numquam esse ipsum perferendis expedita
                                possimus ratione consectetur? Voluptas eaque eum culpa fugiat ullam.
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col navbar-expand-lg">
                    <div class="collapse navbar-collapse flex-column navbarSupportedContent mb-2">
                        <b class="text-center text-primary" style="font-size:0.8em;">Médicos</b>
                        <table class="w-100 m-0 p-0">
                            <tbody id="user_medico_paciente_menu">
                                <tr style="border-bottom: 1px solid #efefef;">
                                    <td id="lista_tratante" class="p-0 pb-1" scope="row">

                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid #efefef;">
                                    <td id="lista_interconsultante" class="p-0 pb-1" scope="row">

                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid #efefef;">
                                    <td id="lista_felow" class="p-0 pb-1" scope="row">

                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid #efefef;">
                                    <td id="lista_residente" class="p-0 pb-1" scope="row">

                                    </td>
                                </tr>
                                <tr>
                                    <td id="lista_ramh" class="p-0 pb-1" scope="row">

                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <!--<ul class="list-group">
                            <li class="list-group-item p-0">
                                <div class="btn-group w-100">
                                    <button class="btn btn-outline-success btn-block dropdown-toggle py-1 overflow-hidden" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                                This dropdown's menu is right-aligned
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="triggerId">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item disabled" href="#">Disabled action</a>
                                        <h6 class="dropdown-header">Section header</h6>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">After divider action</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-0">
                                <div class="btn-group w-100">
                                    <button class="btn btn-outline-info btn-block dropdown-toggle py-1 overflow-hidden" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                                This dropdown's menu is right-aligned
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="triggerId">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item disabled" href="#">Disabled action</a>
                                        <h6 class="dropdown-header">Section header</h6>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">After divider action</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-0">
                                <div class="btn-group w-100">
                                    <button class="btn btn-outline-orange btn-block dropdown-toggle py-1 overflow-hidden" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                                This dropdown's menu is right-aligned
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="triggerId">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item disabled" href="#">Disabled action</a>
                                        <h6 class="dropdown-header">Section header</h6>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">After divider action</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-0">
                                <div class="btn-group w-100">
                                    <button class="btn btn-outline-secondary btn-block dropdown-toggle py-1 overflow-hidden" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                                This dropdown's menu is right-aligned
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="triggerId">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item disabled" href="#">Disabled action</a>
                                        <h6 class="dropdown-header">Section header</h6>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">After divider action</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-0">
                                <div class="btn-group w-100">
                                    <button class="btn btn-outline-purple btn-block dropdown-toggle py-1 overflow-hidden" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                                This dropdown's menu is right-aligned
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="triggerId">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item disabled" href="#">Disabled action</a>
                                        <h6 class="dropdown-header">Section header</h6>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">After divider action</a>
                                    </div>
                                </div>
                            </li>

                        </ul>  -->
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>
<template id="card_info_paciente_1">
    <div class="card card-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-primary cursor-pointer" data-card-widget="collapse">

            <div class="widget-user-image">
                <img class="img-circle elevation-2" onerror="this.src='/image/system/icono-paciente-blanco.svg';"
                    src="/image/system/icono-paciente-blanco.svg" src="../dist/img/user1-128x128.jpg"
                    alt="User Avatar">

            </div>
            <!-- /.widget-user-image -->
            <h3 class="widget-user-username">Name Lastname</h3>
            <h5 class="widget-user-desc">00.000.000</h5>

        </div>
        <div class="card-footer p-0">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        Edad <span class="float-right text-secondary font-weight-bold">0 años</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        Sexo <span class="float-right text-secondary font-weight-bold">M</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://api.whatsapp.com/send?phone=584149320905" target="_blank" class="nav-link">
                        Teléfono Contacto <span class="float-right text-secondary font-weight-bold"><i
                                class="fab fa-whatsapp text-success"></i> +584140000000</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        Historia Inicial <span class="float-right text-secondary font-weight-bold">#1</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        Fecha Historia <span class="float-right text-secondary font-weight-bold">00/00/0000</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</template>
<template id="cintillo-table-equipo-medico">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="h5 pl-1 text-secondary">
                    Equipo <span class="grupo-medicos-nombre">Residente</span>
                    {{-- <i data-dismiss="modal" aria-label="Close" class="fas cursor-pointer heartbeat fa-times m-1"
                    style="
                        position: absolute;
                        right: -40px;
                        font-size: 2em;
                        top: -55px;
                        color: var(--primary);
                    "></i> --}}
                </div>
                <div class="d-flex align-items-end">
                    <div class=" flex-grow-1">
                        <div class="form-group">
                            <select class="form-control mySelect2" name="equipo_medico">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <button data-tippy-content="Guardar médico"
                                class="ml-1 tooltip-primary btn btn-outline-primary" type="button">
                                <i class="far fa-save"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
            <hr>
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-primary text-center">
                                Médico
                            </th>
                            <th class="text-primary text-center">
                                Acción
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2" class="text-center text-primary">
                                Sin médico seleccionado
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<template id="historia_inicial">
    <div id="infoPaciente" style="position: absolute;width: 100%;top:0;left:0;z-index: 200000;"></div>
    <div style="margin-top: 190px !important;" class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-primary">Historia Preliminar de Emergencia</h3>
            </div>
            <div class="col-md-4">
                <div id="cardInfoPaciente1"></div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Signos Vitales</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div id="signosVitales" class="card-body p-0"
                        style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item p-0">

                                <div class="input-group m-0 rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0"
                                            style="width: 60px;">TEMP.</span>
                                    </div>
                                    <input name="user_temperatura" type="text" aria-label="First name"
                                        class="form-control rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0"
                                            style="width: 75px;">°C</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-0">

                                <div class="input-group m-0 rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0"
                                            style="width: 60px;">OXI</span>
                                    </div>
                                    <input name="user_oximetria" type="text" aria-label="First name"
                                        class="form-control rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0"
                                            style="width: 75px;">%</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-0">

                                <div class="input-group m-0 rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0"
                                            style="width: 60px;">F.C.</span>
                                    </div>
                                    <input name="user_fc" type="text" aria-label="First name"
                                        class="form-control rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0"
                                            style="width: 75px;">lat/min</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-0">

                                <div class="input-group m-0 rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0"
                                            style="width: 60px;">F.R.</span>
                                    </div>
                                    <input name="user_fr" type="text" aria-label="First name"
                                        class="form-control rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0"
                                            style="width: 75px;">resp/min</span>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item p-0">

                                <div class="input-group m-0 rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0"
                                            style="width: 60px;">GL.</span>
                                    </div>
                                    <input name="user_glic" type="text" aria-label="First name"
                                        class="form-control rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0"
                                            style="width: 75px;">mg/dL</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-0">
                                <div class="input-group m-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0"
                                            style="width: 60px;">T.A.</span>
                                    </div>
                                    <input name="user_ta_sis" placeholder="Sistólica" type="text"
                                        aria-label="First name" class="form-control rounded-0 border-0">
                                    <input name="user_ta_dia" placeholder="Diastólica" type="text"
                                        aria-label="Last name" class="form-control rounded-0 border-0">
                                    <div class="input-group-prepend rounded-0 border-0">
                                        <span class="input-group-text rounded-0 border-0"
                                            style="width: 75px;">mmHg</span>
                                    </div>
                                </div>

                            </li>


                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Sospecho que el paciente requerirá:</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div id="evaluacionIngreso" class="card-body p-0"
                        style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-1 d-none">
                                <div class="form-group mb-0">
                                    <label class="text-gray mb-0" for="">Solo Atención de Emergencia</label>

                                    <select class="form-control border-0" name="atencion_emergencia"
                                        id="atencion_emergencia">
                                        <option value="">Seleccione</option>
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                                </div>
                            </li>
                            <li class="list-group-item p-1">
                                <div class="form-group mb-0">
                                    <label class="text-gray mb-0" for="">Hospitalización:</label>
                                    <select class="form-control border-0" name="hospitalizacion"
                                        id="hospitalizacion">
                                        <option value="">Seleccione</option>
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                                </div>
                            </li>
                            <li class="list-group-item p-1">
                                <div class="form-group mb-0">
                                    <label class="text-gray mb-0" for="">Terapia Intensiva:</label>
                                    <select class="form-control border-0" name="terapia_intensiva"
                                        id="terapia_intensiva">
                                        <option value="">Seleccione</option>
                                        <option value="0">No</option>
                                        <option value="1">Si</option>

                                    </select>
                                </div>
                            </li>
                            <li class="list-group-item p-1">
                                <div class="form-group mb-0">
                                    <label class="text-gray mb-0" for="">Cirugía:</label>
                                    <select class="form-control border-0" name="caso_tipo_medico"
                                        id="caso_tipo_medico">
                                        <option value="">Seleccione</option>
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                                </div>
                            </li>
                            <li class="list-group-item p-1">
                                <div class="form-group mb-0">
                                    <label class="text-gray mb-0" for="">Clasificación del Triaje:</label>
                                    <select class="form-control border-0" name="nivel_triaje" id="nivel_triaje">
                                        <option value="">Seleccione</option>
                                        <option value="1">Nivel 1</option>
                                        <option value="2">Nivel 2</option>
                                        <option value="3">Nivel 3</option>
                                        <option value="4">Nivel 4</option>
                                        <option value="5">Nivel 5</option>
                                    </select>
                                </div>
                            </li>


                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>


            </div>
            <div id="datos_ingreso" class="col-md-8">


                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Motivo de consulta</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus" data-card-widget="collapse"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                        <textarea class="form-control textarea" placeholder="Escriba aquí por qué el paciente acudió a la emergencia"
                            name="user_motivo_consulta" id="user_problema_salud" rows="3"></textarea>

                    </div>
                </div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Enfermedad Actual</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                        <textarea class="form-control textarea" placeholder="Describa aquí el problema de salud actual"
                            name="user_enfermedad_actual" id="user_problema_salud" rows="3"></textarea>
                    </div>
                </div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Examen Físico</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                        <textarea class="form-control textarea"
                            placeholder="Describa brevemente los hallazgos positivos del examen físico realizado." name="user_examen_fisico"
                            id="user_examen_fisico" rows="3"></textarea>
                    </div>
                </div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Problema de ingreso</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03); display: block;">
                        <textarea class="form-control textarea" placeholder="Escriba aquí el problema de ingreso del paciente"
                            name="user_diagnostico_presuntivo" id="user_diagnostico_presuntivo" rows="3"></textarea>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <button type="button" class="btn btn-success btn-block mb-1"
                    data-dismiss="modal">Guardar</button>
            </div>
            <div class="col-md-8">
                <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</template>
<template id="historia_inicial_Original">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div id="cardInfoPaciente1"></div>

                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Exploración Física</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03);">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-1">
                                <input data-type="string" type="number" name="estatura"
                                    class="form-control border-0" id="estatura" placeholder="Estatura">
                            </li>
                            <li class="list-group-item p-1">
                                <input data-type="string" type="number" name="peso"
                                    class="form-control border-0" id="peso" placeholder="Peso">
                            </li>
                            <li class="list-group-item p-1">
                                <input data-type="string" type="number" name="imc"
                                    class="form-control border-0" id="imc" placeholder="IMC">
                            </li>


                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Comorbilidades</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped m-0">
                            <thead>
                                <tr>
                                    <th class="p-0 pb-1">
                                        <input data-type="object" type="text" class="form-control"
                                            name="" id="" aria-describedby="helpId"
                                            placeholder="Escribr aqui una comorbilidad">

                                    </th>
                                    <th class="p-1 " style="width:2em;">
                                        <button name="" id=""
                                            class="btn btn-default text-primary font-weight-bold" href="#"
                                            role="button"><i class="fas fa-plus-circle"></i></button>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td class="p-1">Lorem ipsum dolor sit amet consectetur, adipisicing
                                        elit. Tempora laudantium necessitatibus facilis! At animi dolor reiciendis quam,
                                        debitis repudiandae sed similique obcaecati, nemo nesciunt corrupti, qui neque
                                        quisquam ullam numquam.</td>
                                    <td class="p-1 text-center">
                                        <button type="button" class="btn btn-outline-primary btn-sm"><i
                                                class="fas fa-times"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Alergias</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped m-0">
                            <thead>
                                <tr>
                                    <th class="p-0 pb-1">
                                        <input type="text" class="form-control" name="" id=""
                                            aria-describedby="helpId" placeholder="Escribr aqui una alergia">

                                    </th>
                                    <th class="p-1 " style="width:2em;">
                                        <button name="" id=""
                                            class="btn btn-default text-primary font-weight-bold" href="#"
                                            role="button"><i class="fas fa-plus-circle"></i></button>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-1 text-center text-secondary" colspan="2">
                                        No tiene Alergias
                                    </td>
                                </tr>
                                <!--<tr>
                            <td class="p-1">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora laudantium necessitatibus facilis! At animi dolor reiciendis quam, debitis repudiandae sed similique obcaecati, nemo nesciunt corrupti, qui neque quisquam ullam numquam.</td>
                            <td class="p-1 text-center">
                            <button type="button"  style="width:2em;height:2em;" class="btn btn-outline-primary btn-sm"><i class="fas fa-times"></i></button>
                            </td>
                        </tr>-->
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Medicamentos Permanentes</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-inverse table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                    <th class="p-0 pb-1">
                                        <input type="text" class="form-control" style="width: 130px;"
                                            name="" id="" aria-describedby="helpId"
                                            placeholder="Medicamento">
                                    </th>
                                    <th class="p-1"><input type="text" class="form-control" name=""
                                            id="" aria-describedby="helpId" placeholder="Dosis"></th>
                                    <th class="p-0 pb-1"><input type="text" class="form-control"
                                            name="" id="" aria-describedby="helpId"
                                            placeholder="Indicaciones"></th>
                                    <th class="p-1 " style="width:2em;">
                                        <button name="" id=""
                                            class="btn btn-default text-primary font-weight-bold" href="#"
                                            role="button"><i class="fas fa-plus-circle"></i></button>

                                    </th>
                                </tr>

                            </thead>
                            <tbody>
                                <!--
                        <tr>
                            <td class="border-right">Acetaminofen</td>
                            <td class="border-right">10 mg</td>
                            <td class="border-right">1 cada 10 dias por 2 años</td>
                            <td>
                            <button type="button" style="width:2em;height:2em;" class="btn btn-outline-primary btn-sm"><i class="fas fa-times"></i></button>
                            </td>
                        </tr> -->
                                <tr>
                                    <td class="p-1 text-center text-secondary" colspan="4">
                                        No tiene medicación permanente
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Antecedentes</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-inverse table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                    <th class="p-0 pb-1">
                                        <select name="" class="form-control" id="">
                                            <option value="P">Personal</option>
                                            <option value="P">Familiar</option>
                                            <option value="P">Hospitalización</option>
                                            <option value="P">Quirúrgico</option>
                                        </select>
                                    </th>
                                    <th class="p-1">
                                        <input type="text" class="form-control" name="" id=""
                                            aria-describedby="helpId" placeholder="Escribe antecedente">
                                    </th>

                                    <th class="p-1 " style="width:2em;">
                                        <button name="" id=""
                                            class="btn btn-default text-primary font-weight-bold" href="#"
                                            role="button"><i class="fas fa-plus-circle"></i></button>

                                    </th>
                                </tr>

                            </thead>
                            <tbody>
                                <!--
                        <tr>
                            <td class="border-right">Acetaminofen</td>
                            <td class="border-right">10 mg</td>
                            <td class="border-right">1 cada 10 dias por 2 años</td>
                            <td>
                            <button type="button" style="width:2em;height:2em;" class="btn btn-outline-primary btn-sm"><i class="fas fa-times"></i></button>
                            </td>
                        </tr> -->
                                <tr>
                                    <td class="p-1 text-center text-secondary" colspan="3">
                                        No tiene medicación permanente
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-md-8">


                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Motivo de consulta</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus" data-card-widget="collapse"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03);">
                        <textarea class="form-control textarea" placeholder="Escriba aquí el problema de salud actual" name=""
                            id="" rows="3"></textarea>

                    </div>
                </div>
                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Enfermedad Actual</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03);">
                        <textarea class="form-control textarea" placeholder="Escriba aquí el problema de salud actual" name=""
                            id="" rows="3"></textarea>
                    </div>
                </div>

                <div class="card card-outline collapsed-card card-primary"
                    style="background-color: rgba(0, 0, 0, 0.03);">
                    <div class="card-header cursor-pointer" data-card-widget="collapse">
                        <h3 class="card-title text-primary font-weight-bold">Examen Físico</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0.03);">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 p-1">
                                    <div class="form-group">
                                        <label class="text-secondary" for="">Condiciones generales</label>
                                        <textarea class="form-control" name="" id="" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 p-1">
                                    <div id="figurahumana" style="width:100%;height:400px;"></div>
                                </div>
                                <div class="col-md-6 p-1">
                                    <div style="max-height: 400px;overflow:auto;">
                                        <table class="w-100">
                                            <tr id="area_cuerpo_1" class="scale-in-hor-right">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-success">
                                                    Cabeza y cuello / Anterior
                                                </td>
                                                <td>
                                                    <textarea class="form-control" name="input_area_cuerpo_1" id="input_area_cuerpo_1" placeholder="Escriba "></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_2" class="scale-in-hor-right">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-success">
                                                    Torax / Anterior
                                                </td>
                                                <td>
                                                    <textarea class=" form-control" name="input_area_cuerpo_2" id="input_area_cuerpo_2" placeholder="Escriba "></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_3" class="scale-in-hor-right">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-success">
                                                    Abdomen / Anterior
                                                </td>
                                                <td>
                                                    <textarea class="form-control" name="input_area_cuerpo_3" id="input_area_cuerpo_3" placeholder="Escriba "></textarea>
                                                </td>
                                            </tr>

                                            <tr id="area_cuerpo_4" class="scale-in-hor-right"
                                                style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-success">

                                                    Genitales / Anterior

                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_4" id="input_area_cuerpo_4"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_5" class="scale-in-hor-right"
                                                style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-success">
                                                    Miembro superior izquierdo / Anterior
                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_5" id="input_area_cuerpo_5"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_6" class="scale-in-hor-right"
                                                style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-success">
                                                    Miembro superior derecho / Anterior
                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_6" id="input_area_cuerpo_6"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_7" class="scale-in-hor-right"
                                                style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-success">
                                                    Miembro inferior izquierdo / Anterior
                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_7" id="input_area_cuerpo_7"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_8" class="scale-in-hor-right"
                                                style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-success">
                                                    Miembro inferior derecho / Anterior
                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_8" id="input_area_cuerpo_8"></textarea>
                                                </td>
                                            </tr>



                                            <tr id="area_cuerpo_9" class="scale-in-hor-left" style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-info">

                                                    Cabeza y cuello / Posterior

                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_9" id="input_area_cuerpo_9"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_10" class="scale-in-hor-left"
                                                style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-info">

                                                    Region dorsal / Posterior

                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_10" id="input_area_cuerpo_10"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_11" class="scale-in-hor-left"
                                                style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-info">

                                                    Region lumbar / Posterior

                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_11" id="input_area_cuerpo_11"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_12" class="scale-in-hor-left"
                                                style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-info">

                                                    Region lumbo sacra / Posterior

                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_12" id="input_area_cuerpo_12"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_13" class="scale-in-hor-left"
                                                style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-info">

                                                    Miembro superior izquierdo / Posterior

                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_13" id="input_area_cuerpo_13"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_14" class="scale-in-hor-left"
                                                style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-info">

                                                    Miembro superior derecho / Posterior

                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_14" id="input_area_cuerpo_14"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_15" class="scale-in-hor-left"
                                                style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-info">

                                                    Miembro inferior izquierdo / Posterior

                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_15" id="input_area_cuerpo_15"></textarea>
                                                </td>
                                            </tr>
                                            <tr id="area_cuerpo_16" class="scale-in-hor-left"
                                                style="display:none">
                                                <td
                                                    class="w-30 align-middle text-center align-middle text-white bg-info">

                                                    Miembro inferior derecho / Posterior

                                                </td>
                                                <td>
                                                    <textarea class="bg-gray form-control" name="input_area_cuerpo_16" id="input_area_cuerpo_16"></textarea>
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>

</template>
<template id="historialEpisodios">
    <section class="content my-1">
        <h1 class="text-primary">Historia de Episodios</h1>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overlay-wrapper">
                        <div class="overlay text-primary d-none">
                            <i class="fas fa-3x fa-sync-alt fa-spin text-primary"></i>
                            <div class="text-bold pt-2">
                                Espere un momento por favor...
                            </div>
                        </div>
                        <div id=episodes>
                            <div id="episode_1" class="card card-outline card-primary mb-1 collapsed-card">
                                <div class="card-header cursor-pointer overflow-auto" data-card-widget="collapse">
                                    <div class="user-block">
                                        <div class="d-flex align-items-end">
                                            <div class="px-3 border-right">
                                                <div class="m-0 description">
                                                    Episodio
                                                </div>
                                                <div class="text-center">
                                                    <a id="user_fullname" href="#"
                                                        class="h4 text-primary font-weight-bold">
                                                        1
                                                    </a>
                                                </div>

                                            </div>
                                            <div class="px-1">
                                                <img id="user_image" class="img-circle"
                                                    src="/AdminLTE-3.2.0/dist/img/user1-128x128.jpg"
                                                    alt="User Image">
                                            </div>
                                            <div class="px-1 border-right">
                                                <div>
                                                    <a id="user_fullname" href="#" class="font-weight-bold">
                                                        Jonathan Burke Jr.
                                                    </a>
                                                </div>
                                                <div class="m-0 description">
                                                    <b>Cédula:</b> <span id="user_document_id">00.000.000</span>
                                                </div>
                                            </div>
                                            <div class="px-1 border-right">
                                                <div class="m-0 description">
                                                    <b>Ingreso:</b> <span id="episode_admision_date">01/01/2022</span>
                                                </div>
                                                <div class="m-0 description">
                                                    <b>Egreso:</b> <span id="episode_departure_date">10/01/2022</span>
                                                </div>
                                            </div>
                                            <div class="px-1">
                                                <div class="m-0 description">
                                                    <b>Días de Hospitalización:</b> <span
                                                        id="episode_num_days">8</span>
                                                </div>
                                                <div class="m-0 description">
                                                    <b>Ubicación:</b>
                                                    <span id="episode_num_days">Pad Covid - 1</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool text-primary"
                                            data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body p-2" style="display: none;">

                                    <div class="row">
                                        <div class="col-5 col-sm-3">
                                            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab"
                                                role="tablist" aria-orientation="vertical">
                                                <a class="nav-link active" id="vert-tabs-home-tab"
                                                    data-toggle="pill" href="#vert-tabs-home" role="tab"
                                                    aria-controls="vert-tabs-home"
                                                    aria-selected="true">Laboratorio</a>
                                                <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill"
                                                    href="#vert-tabs-profile" role="tab"
                                                    aria-controls="vert-tabs-profile"
                                                    aria-selected="false">Imagen</a>
                                                <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill"
                                                    href="#vert-tabs-messages" role="tab"
                                                    aria-controls="vert-tabs-messages"
                                                    aria-selected="false">Fotografía
                                                    <span class="badge badge-primary">1</span></a>
                                                <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill"
                                                    href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings" aria-selected="false">Otros
                                                    Archivo <span class="badge badge-primary">4</span></a>
                                                <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill"
                                                    href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings"
                                                    aria-selected="false">Probabilidad Diagnóstica
                                                    <span class="badge badge-primary">1</span></a>
                                                <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill"
                                                    href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings"
                                                    aria-selected="false">Evolución</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill"
                                                    href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings"
                                                    aria-selected="false">Plan</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill"
                                                    href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings"
                                                    aria-selected="false">Récipe</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill"
                                                    href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings" aria-selected="false">Estudio
                                                    Diagnóstico</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill"
                                                    href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings"
                                                    aria-selected="false">Comorbilidad</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill"
                                                    href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings"
                                                    aria-selected="false">Informe</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill"
                                                    href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings" aria-selected="false">Orden
                                                    Médica</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill"
                                                    href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings"
                                                    aria-selected="false">Monitoreo
                                                    indicadores</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill"
                                                    href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings" aria-selected="false">PAD</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill"
                                                    href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings"
                                                    aria-selected="false">Doctores</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill"
                                                    href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings"
                                                    aria-selected="false">Historia
                                                    Inicial</a>
                                                <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill"
                                                    href="#vert-tabs-settings" role="tab"
                                                    aria-controls="vert-tabs-settings"
                                                    aria-selected="false">Ubicaciones</a>
                                            </div>
                                        </div>
                                        <div class="col-7 col-sm-9">
                                            <div class="tab-content" id="vert-tabs-tabContent">
                                                <div class="tab-pane text-left fade active show" id="vert-tabs-home"
                                                    role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                                    <div class="post">
                                                        <div class="user-block">
                                                            <img class="img-circle img-bordered-sm"
                                                                src="/AdminLTE-3.2.0/dist/img/user8-128x128.jpg"
                                                                alt="user-img 128x128">
                                                            <span class="username">
                                                                <a href="#">Jonathan Burke Jr.</a>
                                                                <a href="#" class="float-right btn-tool"><i
                                                                        class="fas fa-times"></i></a>
                                                            </span>
                                                            <span class="description">Shared publicly - 7:30 PM
                                                                today</span>
                                                        </div>
                                                        <!-- /.user-block -->
                                                        <p>
                                                            Lorem ipsum represents a long-held tradition for designers,
                                                            typographers and the like. Some people hate it and argue for
                                                            its demise, but others ignore the hate as they create
                                                            awesome
                                                            tools to help create filler text for everyone from bacon
                                                            lovers
                                                            to Charlie Sheen fans.
                                                        </p>
                                                        <div class="card-footer bg-white">
                                                            <ul
                                                                class="mailbox-attachments d-flex align-items-stretch clearfix">
                                                                <li>
                                                                    <span class="mailbox-attachment-icon"><i
                                                                            class="far fa-file-pdf"></i></span>

                                                                    <div class="mailbox-attachment-info">
                                                                        <a href="#"
                                                                            class="mailbox-attachment-name"><i
                                                                                class="fas fa-paperclip"></i>
                                                                            Sep2014-report.pdf</a>
                                                                        <span
                                                                            class="mailbox-attachment-size clearfix mt-1">
                                                                            <span>1,245 KB</span>
                                                                            <a href="#"
                                                                                class="btn btn-default btn-sm float-right"><i
                                                                                    class="fas fa-cloud-download-alt"></i></a>
                                                                        </span>
                                                                    </div>
                                                                </li>

                                                                <li>
                                                                    <span class="mailbox-attachment-icon has-img"><img
                                                                            src="/AdminLTE-3.2.0/dist/img/photo1.png"
                                                                            alt="Attachment"></span>

                                                                    <div class="mailbox-attachment-info">
                                                                        <a href="#"
                                                                            class="mailbox-attachment-name"><i
                                                                                class="fas fa-camera"></i>
                                                                            photo1.png</a>
                                                                        <span
                                                                            class="mailbox-attachment-size clearfix mt-1">
                                                                            <span>2.67 MB</span>
                                                                            <a href="#"
                                                                                class="btn btn-default btn-sm float-right"><i
                                                                                    class="fas fa-cloud-download-alt"></i></a>
                                                                        </span>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <span class="mailbox-attachment-icon has-img">
                                                                        <img src="/AdminLTE-3.2.0/dist/img/photo2.png"
                                                                            alt="Attachment">
                                                                    </span>

                                                                    <div class="mailbox-attachment-info">
                                                                        <a href="#"
                                                                            class="mailbox-attachment-name">
                                                                            <i class="fas fa-camera"></i>
                                                                            photo2.png
                                                                        </a>
                                                                        <span
                                                                            class="mailbox-attachment-size clearfix mt-1">
                                                                            <span>1.9 MB</span>
                                                                            <a href="#"
                                                                                class="btn btn-default btn-sm float-right"><i
                                                                                    class="fas fa-cloud-download-alt"></i></a>
                                                                        </span>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <span class="mailbox-attachment-icon">
                                                                        <i class="far fa-file-word"></i>
                                                                    </span>

                                                                    <div class="mailbox-attachment-info">
                                                                        <a href="#"
                                                                            class="mailbox-attachment-name"><i
                                                                                class="fas fa-paperclip"></i> App
                                                                            Description.docx</a>
                                                                        <span
                                                                            class="mailbox-attachment-size clearfix mt-1">
                                                                            <span>1,245 KB</span>
                                                                            <a href="#"
                                                                                class="btn btn-default btn-sm float-right"><i
                                                                                    class="fas fa-cloud-download-alt"></i></a>
                                                                        </span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel"
                                                    aria-labelledby="vert-tabs-profile-tab">
                                                    Mauris tincidunt mi at erat gravida, eget tristique urna bibendum.
                                                    Mauris pharetra purus ut
                                                    ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit
                                                    amet, consectetur adipiscing
                                                    elit. Vestibulum ante ipsum primis in faucibus orci luctus et
                                                    ultrices posuere cubilia Curae;
                                                    Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat
                                                    mi, quis posuere purus
                                                    ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies
                                                    at, posuere nec nunc. Nunc
                                                    euismod pellentesque diam.
                                                </div>
                                                <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel"
                                                    aria-labelledby="vert-tabs-messages-tab">
                                                    Morbi turpis dolor, vulputate vitae felis non, tincidunt congue
                                                    mauris. Phasellus volutpat augue
                                                    id mi placerat mollis. Vivamus faucibus eu massa eget condimentum.
                                                    Fusce nec hendrerit sem, ac
                                                    tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum.
                                                    Suspendisse ut velit
                                                    condimentum, mattis urna a, malesuada nunc. Curabitur eleifend
                                                    facilisis velit finibus
                                                    tristique. Nam vulputate, eros non luctus efficitur, ipsum odio
                                                    volutpat massa, sit amet
                                                    sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida
                                                    fermentum, lectus ipsum
                                                    gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem
                                                    eu risus tincidunt eleifend
                                                    ac ornare magna.
                                                </div>
                                                <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel"
                                                    aria-labelledby="vert-tabs-settings-tab">
                                                    Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque
                                                    magna, iaculis tempus turpis
                                                    ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque
                                                    tincidunt venenatis vulputate.
                                                    Morbi euismod molestie tristique. Vestibulum consectetur dolor a
                                                    vestibulum pharetra. Donec
                                                    interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget
                                                    aliquet urna. Nunc at
                                                    consequat diam. Nunc et felis ut nisl commodo dignissim. In hac
                                                    habitasse platea dictumst.
                                                    Praesent imperdiet accumsan ex sit amet facilisis.
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
</template>
<template id="newTable">
    <table class="table">
        <thead>
            <tr>
                <td class="p-0">
                    <form class="form-horizontal">
                        <div class="input-group input-group-md mb-0">
                            <input name="value" class="form-control rounded-0 form-control-md"
                                placeholder="Escribir aquí...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-success btn-flat"><i
                                        class="fas fa-save"></i></button>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</template>
<template id="newTableRowComent">
    <div class="post">
        <div class="user-block">
            <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
            <span class="username">
                <a href="#">Sarah Ross</a>
                <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
            </span>
            <span class="description">
                Sent you a message - 3 days ago
            </span>
        </div>
        <!-- /.user-block -->
        <p>
            Lorem ipsum represents a long-held tradition for designers,
            typographers and the like. Some people hate it and argue for
            its demise, but others ignore the hate as they create awesome
            tools to help create filler text for everyone from bacon lovers
            to Charlie Sheen fans.
        </p>
    </div>
</template>
<template id="boxOpinionesEncuesta">
    <div class="row">
        <div class="col-md-12">
            <div
                class="d-flex card card-primary mb-0 card-header-coments card-outline cursor-pointer direct-chat direct-chat-primary shadow-none collapsed-card">
                <div class="card-header" data-card-widget="collapse">
                    <h3 class="card-title w-100 text-center text-primary">Opiniones <span
                            class="badge badge-primary">0</span></h3>
                </div>
                <div class="card-body" style="display: none;">
                    <div id="opiniones_generales_encuesta" class="direct-chat-messages"
                        style="height: max-content;">

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<template id="opinionEncuesta">
    <div data-coment-id="16" class="direct-chat-msg">
        <div class="direct-chat-infos clearfix">
            <span class="direct-chat-timestamp float-right">00 FEB 2022</span>
        </div>
        <img class="direct-chat-img" src="/image/system/icono-paciente-blanco.svg" alt="Message User Image">
        <div class="direct-chat-text">
            Respuestas comentarios
        </div>
    </div>
</template>
<template id="row-18">
    <tr>
        <td id="" class="border bg-gray-2"></td>
        <td id="" class="border text-center text-secondary"></td>
        <td id="" class="border bg-gray-2"></td>
        <td id="" class="border"></td>
        <td id="" class="border bg-gray-2 border-right-2"></td>
        <td id="" class="border"></td>
        <td id="" class="border bg-gray-2"></td>
        <td id="" class="border"></td>
        <td id="" class="border bg-gray-2"></td>
        <td id="" class="border"></td>
        <td id="" class="border bg-gray-2"></td>
        <td id="" class="border"></td>
        <td id="" class="border bg-gray-2"></td>
        <td id="" class="border"></td>
        <td id="" class="border bg-gray-2"></td>
        <td id="" class="border"></td>
        <td id="" class="border bg-gray-2"></td>
        <td id="" class="border"></td>
    </tr>
</template>
<template id="datos-paciente">
    <article class="text-secondary p-1">
        <div class="d-flex justify-content-evenly">
            <div aria-label="Nombre del paciente" class="h4 pb-2"></div>
            <div aria-label="Botón Estatus"></div>
        </div>
        <div class="d-flex justify-content-evenly align-items-center" aria-label="Accesos rapidos">
            <div aria-label="Botón 1"></div>
            <div aria-label="Botón 2"></div>
            <div aria-label="Botón 3"></div>
            <div aria-label="Botón 4"></div>
            <div aria-label="Botón 5"></div>
        </div>
        <span aria-label="episodio_id" class="filtroBuscador"></span>
        <span aria-label="user_id" class="filtroBuscador"></span>
        <span aria-label="cedula formateada" class="filtroBuscador"></span>
        <span aria-label="cedula" class="filtroBuscador"></span>
        <span aria-label="fecha episodio" class="filtroBuscador"></span>
    </article>
</template>
<template id="form_paciente_1">
    <div class="container">
        <div class="row mt-3">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="h3 text-primary">
                    Datos del paciente
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg62 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="cedula">Documento de identidad</label>
                    <table class="w-100">
                        <tr>
                            <td style="width: 30%">
                                <select class="form-control form-control-lg bg-gray-footer-parodi"
                                    name="nacionalidad" id="nacionalidad">
                                    <option value="">Seleccione</option>
                                    <option value="V">V</option>
                                    <option value="E">E</option>
                                    <option value="P">P</option>
                                    <option value="J">J</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" max="9"
                                    class="form-control form-control-lg bg-gray-footer-parodi" name="cedula"
                                    id="cedula" aria-describedby="helpId" placeholder="">
                            </td>
                        </tr>
                    </table>
                    <small id="help_cedula" class="form-text notification"></small>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg62 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="email">Correo electrónico</label>
                    <input type="email" class="form-control form-control-lg bg-gray-footer-parodi"
                        name="email" id="email" aria-describedby="helpId" placeholder="">
                    <small id="help_email" class="form-text"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="nombre">Nombres</label>
                    <input type="text" class="form-control form-control-lg bg-gray-footer-parodi"
                        name="nombres" id="nombres" aria-describedby="helpId" placeholder="">
                    <small id="help_nombres" class="form-text text-muted notification"></small>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="apellido">Apellidos</label>
                    <input type="text" class="form-control form-control-lg bg-gray-footer-parodi"
                        name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                    <small id="help_apellidos" class="form-text text-muted notification"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="genero">Género</label>
                    <select class="form-control form-control-lg bg-gray-footer-parodi" name="genero"
                        id="genero" aria-describedby="helpId" placeholder="">
                        <option value="">Seleccione</option>
                        <option value="m">Masculino</option>
                        <option value="f">Femenino</option>
                    </select>
                    <small id="help_genero" class="form-text text-muted notification"></small>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="fnacimiento">Fecha de nacimiento</label>
                    <input type="date" class="form-control form-control-lg bg-gray-footer-parodi"
                        name="fnacimiento" id="fnacimiento" aria-describedby="helpId" placeholder="">
                    <small id="help_fnacimiento" class="form-text text-muted notification"></small>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="telefono_movil">Teléfono Contacto</label>
                    <input type="tel" onkeyup="validarPrimerDigito('telefono_movil')"
                        class="form-control form-control-lg bg-gray-footer-parodi" name="telefono_movil"
                        id="telefono_movil" aria-describedby="helpId" placeholder="">
                    <small id="help_telefonomovil" class="form-text text-muted notification"></small>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-primary">
                <div class="h3">
                    Dirección
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <div class="form-group">
                    <label class="label-text text-secondary" for="cat_estado_id">Estado</label>
                    <select class="form-control form-control-lg bg-gray-footer-parodi" name="cat_estado_id"
                        id="cat_estado_id" aria-describedby="helpId" placeholder=""></select>
                    <small id="help_cat_estado_id" class="form-text text-muted"></small>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <div class="form-group">
                    <label class="label-text text-secondary" for="cat_municipio_id">Municipio</label>
                    <select class="form-control form-control-lg bg-gray-footer-parodi" name="cat_municipio_id"
                        id="cat_municipio_id" aria-describedby="helpId" placeholder=""></select>
                    <small id="help_cat_municipio_id" class="form-text text-muted"></small>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <div class="form-group">
                    <label class="label-text text-secondary" for="description">Ciudad</label>
                    <input type="text" class="form-control form-control-lg bg-gray-footer-parodi"
                        name="description" id="description" aria-describedby="helpId" placeholder="">
                    <small id="help_description" class="form-text text-muted"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group">
                    <label class="label-text text-secondary" for="domicilio">Domicilio</label>
                    <textarea class="form-control form-control-lg bg-gray-footer-parodi" name="domicilio" id="domicilio"
                        rows="2"></textarea>
                    <small id="help_domicilio" class="form-text text-muted"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <table class="w-100">
                    <tr>
                        <td>
                            <div class="text-center">
                                <img id="imagen_perfil" style="width: 5em; height:5em"
                                    src="/image/user/foto_perfil/doc_id.svg" class="imagen-perfil"
                                    alt="Medic default">
                                <br />
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label class="label-text text-secondary" for="imagen">Foto del paciente</label>
                                <input type="file" class="form-control form-control-lg bg-gray-footer-parodi"
                                    name="imagen" id="imagen" aria-describedby="helpId" placeholder="">
                                <small id="help_imagen" class="form-text text-muted"></small>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </div>


</template>
<template id="form_post_covid">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-primary">
                <div class="h3">
                    Datos Post Covid
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group">
                    <label class="label-text text-secondary" for="hospitalizacion">
                        ¿En que fecha se iniciaron tus sintomas de covid?
                    </label>
                    <input type="date" class="form-control form-control-lg bg-gray-footer-parodi"
                        name="inicio_sintomas" id="inicio_sintomas" aria-describedby="helpId" placeholder="">

                    <small id="help-hospitalizacion" class="form-text text-muted"></small>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="hospitalizacion">
                        ¿Fuiste hospitalizado en algún centro de salud (Ambulatorio, Clínica u Hospital)?
                    </label>
                    <select class="form-control form-control-lg bg-gray-footer-parodi" name="hospitalizacion"
                        id="hospitalizacion" aria-describedby="helpId" placeholder="">
                        <option value="No">No</option>
                        <option value="Si">Si</option>
                    </select>
                    <small id="help-hospitalizacion" class="form-text text-muted"></small>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="atencion_med">
                        ¿Recibiste atención médica en casa (te valoró algún médico en tu domicilio)?
                    </label>
                    <select class="form-control form-control-lg bg-gray-footer-parodi" name="atencion_med"
                        id="atencion_med" aria-describedby="helpId" placeholder="">
                        <option value="No">No</option>
                        <option value="Si">Si</option>
                    </select>
                    <small id="help-atencion_med" class="form-text text-muted"></small>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="oxigenoterapia">
                        ¿Recibiste Oxigenoterapia?
                    </label>
                    <select class="form-control form-control-lg bg-gray-footer-parodi" name="oxigenoterapia"
                        id="oxigenoterapia" aria-describedby="helpId" placeholder="">
                        <option value="No">No</option>
                        <option value="Si">Si</option>
                    </select>
                    <small id="help-oxigenoterapia" class="form-text text-muted"></small>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label class="label-text text-secondary" for="sintomatologia">
                        ¿Persiste alguna sintomatología respiratoria 1 mes o más después de que te hicieron el
                        diagnóstico de COVID?
                    </label>
                    <select class="form-control form-control-lg bg-gray-footer-parodi" name="sintomatologia"
                        id="sintomatologia" aria-describedby="helpId" placeholder="">
                        <option value="No">No</option>
                        <option value="Si">Si</option>
                    </select>
                    <small id="help-sintomatologia" class="form-text text-muted"></small>
                </div>
            </div>
        </div>
    </div>
</template>
<template id="form_paciente_cita">
    <form class="needs-validation">
        <div class="container" novalidate>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center text-primary font-weight-bold h3">
                                    Ingresa tu información
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-primary" for="cedula">Documento de identidad</label>
                                    <table class="w-100">
                                        <tr>
                                            <td style="width: 40%">
                                                <select class="form-control form-control-lg bg-gray-footer-parodi"
                                                    title="Seleccione una nacionalidad" name="nacionalidad"
                                                    id="nacionalidad">
                                                    <option value="V">V</option>
                                                    <option value="E">E</option>
                                                    <option value="P">P</option>
                                                    <option value="J">J</option>
                                                </select>
                                                <small id="help_nacionalidad" class="notification"></small>
                                            </td>
                                            <td>
                                                <input required type="number"
                                                    title="Documento de identidad es requerido."
                                                    class="form-control form-control-lg bg-gray-footer-parodi"
                                                    name="cedula" id="cedula"
                                                    aria-describedby="helpId" placeholder="">
                                                <small id="help_cedula" class="notification"></small>
                                            </td>
                                        </tr>
                                    </table>


                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-primary" for="email">Correo Electrónico</label>
                                    <input type="text" required name="email" id="email"
                                        class="form-control form-control-lg bg-gray-footer-parodi" placeholder=""
                                        aria-describedby="helpEmail">
                                    <small id="help_email" class="notification"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="text-primary" for="nombre">Nombres</label>
                                    <input type="text" required
                                        class="form-control form-control-lg bg-gray-footer-parodi" name="nombres"
                                        id="nombres" aria-describedby="helpId" placeholder="">
                                    <small id="help_nombres" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="text-primary" for="apellido">Apellidos</label>
                                    <input type="text" required
                                        class="form-control form-control-lg bg-gray-footer-parodi" name="apellidos"
                                        id="apellidos" aria-describedby="helpId" placeholder="">
                                    <small id="help_apellidos" class="notification"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="text-primary" for="genero">Género</label>
                                    <select class="form-control required form-control-lg bg-gray-footer-parodi"
                                        name="genero" id="genero" aria-describedby="helpId" placeholder="">
                                        <option value="m">Masculino</option>
                                        <option value="f">Femenino</option>
                                    </select>
                                    <small id="help_genero" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="text-primary" for="fnacimiento">Fecha de nacimiento</label>
                                    <input type="date" required
                                        class="form-control form-control-lg bg-gray-footer-parodi"
                                        name="fnacimiento" id="fnacimiento" aria-describedby="helpId"
                                        placeholder="">
                                    <small id="help_fnacimiento" class="notification"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="text-primary" for="telefono_movil">Teléfono Contacto</label>
                                    <input type="tel" required onkeyup="validarPrimerDigito('telefono_movil')"
                                        class="form-control form-control-lg bg-gray-footer-parodi"
                                        name="telefono_movil" id="telefono_movil" aria-describedby="helpId"
                                        placeholder="">
                                    <small id="help_telefono_movil" class="notification">(preferiblemente vinculado
                                        a
                                        <i class="text-success">Whatsapp</i>)</small>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <!--
                                <div class="form-group">
                                    <label class="text-primary" for="parentesco">¿Quien es el paciente?</label>
                                    <select class="form-control form-control-lg bg-gray-footer-parodi" name="parentesco" id="parentesco" aria-describedby="helpId" placeholder="">
                                        <option value="0">Soy yo</option>
                                        <option value="1">Hijo(a)</option>
                                        <option value="2">Padre</option>
                                        <option value="3">Conyugue</option>
                                        <option value="4">Nieto(a)</option>
                                        <option value="5">Abuelo(a)</option>
                                        <option value="6">BisaAbuelo(a)</option>
                                        <option value="1000">Otro</option>
                                    </select>
                                    <small id="helpId1" class=""></small>
                                </div> -->
                            </div>
                        </div>
                        <!--
                        <div class="row">
                            <div id="container-parentesco" class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 d-none">
                                <div class="form-group">
                                    <label class="text-primary" for="parentesco_nacionalidad">Documento de identidad <span id="select-parentesco-text" class="text-success font-weight-bold">(Padre)</span></label>
                                    <table class="w-100">
                                        <tr>
                                            <td style="width: 30%">
                                                <select  class="form-control form-control-lg bg-gray-footer-parodi" title="Seleccione una nacionalidad" name="parentesco_nacionalidad" id="parentesco_nacionalidad">
                                                    <option value="V">V</option>
                                                    <option value="E">E</option>
                                                    <option value="P">P</option>
                                                    <option value="J">J</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input  type="number" min=7 max="8" title="Cédula solo acepta 8 dígitos" class="form-control form-control-lg bg-gray-footer-parodi" name="parentesco_cedula" id="parentesco_cedula" aria-describedby="helpId" placeholder="">
                                            </td>
                                        </tr>
                                    </table>
                                    <small class=""></small>
                                </div>
                            </div>
                        </div>  -->
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="text-primary" for="cat_estado_id">Estado</label>
                                    <select required class="form-control form-control-lg bg-gray-footer-parodi"
                                        name="cat_estado_id" id="cat_estado_id" aria-describedby="helpId"
                                        placeholder=""></select>
                                    <small id="help_cat_estado_id" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="text-primary" for="cat_municipio_id">Municipio</label>
                                    <select required class="form-control form-control-lg bg-gray-footer-parodi"
                                        name="cat_municipio_id" id="cat_municipio_id" aria-describedby="helpId"
                                        placeholder=""></select>
                                    <small id="help_cat_municipio_id" class="notification"></small>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="text-primary" for="description">Ciudad</label>
                                    <input required type="text"
                                        class="form-control form-control-lg bg-gray-footer-parodi"
                                        name="description" id="description" aria-describedby="helpId"
                                        placeholder="">
                                    <small id="help_description" class="notification"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label class="text-primary" for="domicilio">Domicilio</label>
                                    <textarea required class="form-control form-control-lg bg-gray-footer-parodi" name="domicilio" id="domicilio"
                                        rows="2"></textarea>
                                    <small id="help_domicilio" class="notification"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <label class="h3 text-primary text-center d-block" for="calendar">Agenda tu cita</label>
                    <!-- ........................ -->

                    <a data-toggle="collapse" href="#collapseEspecialidad" role="button" aria-expanded="false"
                        aria-controls="collapseEspecialidad">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1 item-1"
                                style="width: 25px;line-height: 1.5;">1</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Selecciona la Especialidad</b>
                            </div>
                        </div>
                    </a>

                    <div class="collapse p-2 show" id="collapseEspecialidad">
                        <select required data-item="item-1" name="cat_especialidad_id" class="medico-select"
                            id="cat_especialidad_id"></select>
                        <small class="notification"></small>
                    </div>


                    <a data-toggle="collapse" href="#collapseMedico" role="button" aria-expanded="false"
                        aria-controls="collapseMedico">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1 item-2"
                                style="width: 25px;line-height: 1.5;">2</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Médico de tu preferencia</b>
                            </div>
                        </div>
                    </a>
                    <div class="collapse p-2 show" id="collapseMedico">
                        <select required name="user_id_medico" class="medico-select" id="user_id_medico">

                        </select>
                        <small class="notification"></small>
                    </div>

                    <a data-toggle="collapse" href="#collapseDia" role="button" aria-expanded="false"
                        aria-controls="collapseDia">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1 item-3"
                                style="width: 25px;line-height: 1.5;">3</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Indica el día de tu conveniencia</b>
                            </div>
                        </div>
                    </a>
                    <div class="collapse p-2 show" id="collapseDia">
                        <div id="mensaje_dia_seleccionado" class="text-center text-secondary"
                            style="font-size:15px">
                            Solo los días resaltados están disponibles.
                        </div>
                        <input required id="cita_dia" name="cita_dia" type="hidden">
                        <div id="calendar" class="daterange" style="width: 100%"></div>

                    </div>
                    <a data-toggle="collapse" href="#collapseHora" role="button" aria-expanded="false"
                        aria-controls="collapseHora">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1 item-4"
                                style="width: 25px;line-height: 1.5;">4</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Escoje una hora</b>
                            </div>
                        </div>
                    </a>
                    <div class="collapse p-2 show" id="collapseHora">
                        <input required id="cita_hora" name="cita_hora" type="hidden">
                        <ul class="nav justify-content-center  nav-tabs mb-3" id="horarios" role="tablist">
                            <li class="nav-item flex-fill text-center" role="presentation">
                                <a class="nav-link active" id="pills-am-tab" data-cita-horario="am"
                                    data-toggle="pill" href="#pills-am" role="tab" aria-controls="pills-am"
                                    aria-selected="true">Mañana</a>
                            </li>
                            <li class="nav-item flex-fill text-center" role="presentation">
                                <a class="nav-link" id="pills-pm-tab" data-cita-horario="pm" data-toggle="pill"
                                    href="#pills-pm" role="tab" aria-controls="pills-pm"
                                    aria-selected="false">Tarde</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContentHoras">
                            <div class="tab-pane fade show active" id="pills-am" role="tabpanel"
                                aria-labelledby="pills-tabContentHoras">
                                <ul class="nav nav-pills horas-tab mb-3" id="horas-tab" role="tablist">
                                    Sin Horas Disponibles
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="pills-pm" role="tabpanel"
                                aria-labelledby="pills-tabContentHoras">
                                <ul class="nav nav-pills horas-tab mb-3" id="horas-tab" role="tablist">
                                    Sin Horas Disponibles
                                </ul>
                            </div>
                        </div>
                    </div>

                    <a data-toggle="collapse" href="#collapseMotivo" role="button" aria-expanded="false"
                        aria-controls="collapseMotivo">
                        <div class="d-flex mb-2">
                            <div class="badge badge-primary rounded-circle mr-1"
                                style="width: 25px;line-height: 1.5;">
                                5</div>
                            <div class="flex-grow-1">
                                <b class="text-primary">Indica el motivo de consulta</b>
                            </div>
                        </div>
                    </a>
                    <div class="collapse p-2" id="collapseMotivo">
                        <textarea class="form-control bg-gray-footer-parodi" placeholder="Escribe el motivo" name="cita_motivo"
                            id="cita_motivo" rows="3"></textarea>
                    </div>





                    <!--
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header p-0" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">


                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordionExample">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="headingFive">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseFor" aria-expanded="false"
                                        aria-controls="collapseFor">


                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFor" class="collapse" aria-labelledby="headingFive"
                                data-parent="#accordionExample">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="headingOne">
                                <h2 class="mb-0">

                                    <button class="btn btn-link btn-block text-left" type="button"
                                        data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">


                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">


                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">



                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordionExample">

                                <div class="card-body">

                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header p-0" id="headingFor">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseFive" aria-expanded="false"
                                        aria-controls="collapseFor">

                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                                data-parent="#accordionExample">
                                <div class="card-body py-0">

                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="row fixed-bottom p-1 bg-white">
                <div class="col-md-4 offset-md-4">
                    <button id="submit" type="submit"
                        class="btn btn-success btn-block btn-lg font-weight-bold h3">Crear
                        cíta</button>
                </div>
            </div>
        </div>
    </form>
</template>
<template id="btnGroup-1">
    <div class="fixed-bottom bg-white">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button id="store" class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Completar
                        registro</button>
                </div>
            </div>
        </div>
    </div>
</template>
<template id="btnGroup-2">
    <div class="fixed-bottom bg-white">
        <div class="container">
            <div class="row">
                @if (is_null(Auth::id()))
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <button id="store"
                            class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Completar
                            registro</button>
                    </div>
                @else
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <button onclick="history.back()"
                            class="font-weight-bold btn btn-secondary mb-1 btn-block btn-lg">Regresar</button>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <button id="store"
                            class="font-weight-bold btn btn-success mb-1 btn-block btn-lg">Completar
                            registro</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</template>
<template id="navbar">
    <nav class="navbar navbar-expand navbar-primary navbar-light navbar-v2">
        <div>
            <a id="logoSystem" href="#"><img loading="lazy" style="height: 4em;width: 10em;"
                    src="{{ asset('image/system/patientcare_bw.svg') }}"></a>
        </div>
    </nav>
</template>
<template id="cargando">
    <div id="carga" class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="d-flex m-4 justify-content-center text-primary">
                    Espere un momento por favor...
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<template id="bienvenida1">
    <div class="container-fluid bg-primary p-3">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3 class="display-4" style="font-size: 2.5em;">
                    <i style="font-size: 0.8em;">Bienvenido a la</i><br>
                    Clínica Post Covid<br>
                    <span style="overflow-wrap: normal;font-weight:400">COVID-19</span>
                </h3>
                <p class="lead" style="font-size: 1.4em;font-style: italic;">
                    Para brindarle el mejor servicio posible,<br>
                    le pedimos por favor<br>
                    completar el siguiente formulario.
                </p>

            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-2">
                <button id="empezarcuestionario" data-dismiss="modal" type="button"
                    class="btn btn-light btn-block btn-lg text-primary">De acuerdo, comenzar</button>
            </div>
        </div>
    </div>




</template>
<template id="infoUser">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center text-primary font-weight-bold h3">
                    Información del paciente
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center text-secondary">
                    Le agradecemos mucho el tiempo que nos has dedicado a darnos tus opiniones, las cuales son de mucha
                    importancia para mejorar nuestros servicios.<br>
                    Esta encuesta es anonima, y puedes enviarla en este momento sin identificarse pulsando el Botón
                    <label class="cursor-pointer text-success" for="submit">Enviar encuesta</label>.<br>
                    La decisión de identificarse compartiendo sus datos con nosotros es suya, si lo deseas.<br>
                    De igual manera, <b>si deseas hacer cualquier comentario adicional o darnos cualquier opinión o
                        recomendacion<b>, puedes hacerlo en el campo <label class="cursor-pointer text-primary"
                                for="coment">Comentarios personales</label>.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="label-text text-primary" for="nombre">Nombres</label>
                    <input type="text" class="form-control form-control-lg bg-gray-footer-parodi"
                        name="nombres" id="nombres" aria-describedby="helpId" placeholder="">
                    <small id="help_nombres" class="form-text text-muted notification"></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="label-text text-primary" for="apellido">Apellidos</label>
                    <input type="text" class="form-control form-control-lg bg-gray-footer-parodi"
                        name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                    <small id="help_apellidos" class="form-text text-muted notification"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="label-text text-primary" for="cedula">Documento de identidad</label>
                    <table class="w-100">
                        <tr>
                            <td style="width: 30%">
                                <select class="form-control form-control-lg bg-gray-footer-parodi"
                                    name="nacionalidad" id="nacionalidad">
                                    <option value="">Seleccione</option>
                                    <option value="V">V</option>
                                    <option value="E">E</option>
                                    <option value="P">P</option>
                                    <option value="J">J</option>
                                </select>
                            </td>
                            <td>
                                <input type="number"
                                    class="form-control form-control-lg bg-gray-footer-parodi" name="cedula"
                                    id="cedula" aria-describedby="helpId" placeholder="">
                            </td>
                        </tr>
                    </table>
                    <small id="help_cedula" class="form-text notification"></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="label-text text-primary" for="email">Correo Electrónico</label>
                    <input type="text" name="email" id="email"
                        class="form-control form-control-lg bg-gray-footer-parodi" placeholder=""
                        aria-describedby="helpEmail">
                    <small id="helpEmail" class="text-muted"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="label-text text-primary text-center h1 w-100" for="coment">Comentarios
                        personales
                        <small class="text-gray">(opcional)</small></label>
                    <textarea name="coment" id="coment" class="form-control form-control-lg bg-gray-footer-parodi"
                        placeholder="" aria-describedby="helpComent"></textarea>
                    <small id="helpComent" class="text-muted"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button id="submit" class="btn btn-success btn-block btn-lg font-weight-bold h3">Enviar
                    Encuesta</button>
            </div>
        </div>
    </div>
</template>
<template id="question">
    <div class="container-fluid scale-up-ver-top">
        <div class="row">
            <div class="col-12 p-0 bd-callout bd-callout-primary">
                <div class="d-flex align-item mr-3"
                    style="width: fit-content; background-color: #f3eeee !important;border-radius: 0rem 50rem 50rem 0rem !important;">


                    <div class="bd-callout-number mx-2">99</div>
                    <div role="pregunta" class="encuesta-pregunta">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam, doloremque iste vel amet
                        officia atque temporibus veniam culpa, nobis deleniti labore fugiat odio? Nisi consectetur ad
                        aliquid libero quos hic.
                    </div>
                </div>


                <ul class="nav nav-pills mt-2 flex-row align-items-center  font-weight-bold" id="lista-respuestas"
                    role="lista-respuestas">

                </ul>
                <div class="coments d-none">
                    <div class="form-group mx-1 mt-2">
                        <textarea class="form-control w-50 " placeholder="Describe, el por qué de tu respuesta..."
                            style="background-color: #f3eeee !important;color:var(--secondary)" name="" id=""
                            rows="2"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<template id="badgeContador">
    <div class="badge badge-primary ping"
        style="
        position: fixed;
        z-index: 1;
        right: 2%;
        bottom: 1%;
        font-size: 1rem;
    ">
        0/50
    </div>
</template>
<template id="card1">
    <a href="#">
        <div class="small-box">
            <div class="inner">
                <h3>00<sup style="font-size: 20px">%</sup></h3>
                <p>Title</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-md"></i>
            </div>
            <div class="small-box-footer d-flex justify-content-center align-items-center">
                Más información <i class="fas fa-arrow-circle-right"></i>
            </div>
        </div>
    </a>
</template>
