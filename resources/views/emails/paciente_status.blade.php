<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="color-scheme" content="light">
            <meta name="supported-color-schemes" content="light">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
            <style>
                body{
                    box-sizing: border-box;
                    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
                    position: relative;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                    -premailer-width: 100%;
                    background-color: #edf2f7;
                    border-bottom: 1px solid #edf2f7;
                    border-top: 1px solid #edf2f7;
                    margin: 0;
                    padding: 0;
                    width: 100%;
                }
                @media  only screen and (max-width: 600px) {
                    .inner-body {
                        width: 100% !important;
                    }

                    .footer {
                        width: 100% !important;
                    }
                }

                @media  only screen and (max-width: 500px) {
                    .button {
                        width: 100% !important;
                    }
                }
                .btn.btn-flat {
                    border-radius: 0;
                    border-width: 1px;
                    box-shadow: none;
                }
                .btn-default {
                    background-color: #f8f9fa;
                    border-color: #ddd;
                    color: #444;
                }
                .text-primary {
                    color: #185ba9 !important;
                }
                .btn-block {
                    display: block;
                    width: 100%;
                }
                .btn {
                    display: inline-block;
                    font-weight: 400;
                    color: #212529;
                    text-align: center;
                    vertical-align: middle;
                    cursor: pointer;
                    -webkit-user-select: none;
                    -moz-user-select: none;
                    -ms-user-select: none;
                    user-select: none;
                    background-color: transparent;
                    border: 1px solid transparent;
                    padding: 0.375rem 0.75rem;
                    font-size: 1rem;
                    line-height: 1.5;
                    border-radius: 0.25rem;
                    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                }
                .w-100{
                    width: 100%;
                }

                .text-info{
                    color:#00AAFF;
                }
                .bg-info{
                    color:#00AAFF;
                }
                .text-warning{
                    color:#ffc107;
                }
                .bg-warning{
                    color:#ffc107;
                }
                .text-danger{
                    color:#dc3545;
                }
                .bg-danger{
                    color:#dc3545;
                }
                .text-success{
                    color:#2FA600;
                }
                .bg-success{
                    color:#2FA600
                }
                .text-secondary{
                    color:#6c757d;
                }
                .bg-secondary{
                    color:#6c757d
                }
                .text-center {
                    text-align: center !important;
                }
            </style>
        </head>
    <body>
        <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: 100%;">
            <tr>
                <td align="center" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative;">
                    <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;">
                        <tr>
                            <td class="header" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; padding: 25px 0; text-align: center;">
                                <a href="{{ config('app.APP_URL') }}" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; color: #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; display: inline-block;">
                                    <img class="img-fluid" loading="lazy" style="height: 3em;" src="{{ config('app.url')."/image/system/".config('app.APP_LOGO_VERSION_REPORTS_COLOR') }}">
                                </a>
                            </td>
                        </tr>
                        <!-- Email Body -->
                        <tr>
                            <td class="body" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px solid #edf2f7; margin: 0; padding: 0; width: 100%;">
                                <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius: 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;">
                                    <!-- Body content -->
                                    <tr>
                                        <td class="content-cell" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; max-width: 100vw; padding: 32px;">
                                            <h1 style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; color: #3d4852; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;">¡Hola!</h1>
                                            <p style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                                                @switch($model['case'])
                                                    @case(1) <!-- create user -->
                                                        <p>
                                                            Recibe un cordial saludo del equipo de <b>{{ config('app.APP_NAME_VERSION') }}</b>,
                                                        </p>
                                                        <p>
                                                            Te has registrado en nuestra plataforma de citas médicas con los siguientes datos de acceso:<br>
                                                            <b>Usuario:</b> {{ $model['email'] }}<br>
                                                            <b>Contraseña:</b> {{ $model['password'] }}<br>

                                                            Puedes autenticarte pulsando en el siguiente enlace:<br>
                                                            <a href="{{ config('app.APP_URL_LOGIN_CONSULTA_EXTERNA') }}" style="text-transform: uppercase">{{ config('app.APP_NAME_VERSION') }}</a>
                                                        </p>
                                                    @break
                                                    @case(2) <!-- update user -->
                                                        <p>
                                                            Recibe un cordial saludo del equipo de <b>{{ config('app.APP_NAME_VERSION') }}</b>,
                                                        </p>
                                                        <p>
                                                            Tus datos de registro en nuestra plataforma de citas médicas han sido actualizados.<br>

                                                            Puedes verificarlos, autenticandote con tu usuario y contraseña en el siguiente enlace:<br>
                                                            <a href="{{ config('app.APP_URL_LOGIN_CONSULTA_EXTERNA') }}" style="text-transform: uppercase">{{ config('app.APP_NAME_VERSION') }}</a>
                                                        </p>
                                                    @break
                                                    @case(3) <!-- create cita -->
                                                        <div>
                                                            Recibe un cordial saludo del equipo de <b>{{ config('app.APP_NAME_VERSION') }}</b>,
                                                        </div>
                                                        <div>
                                                            <div style="margin:5px 0px 5px 0px;background-color: #f7f4f4;
                                                                padding: 2%;
                                                                border-radius: 20px;">
                                                                <div class="text-center">
                                                                    <h3>Tienes una nueva cita médica:</h3>
                                                                </div>
                                                                <b><i class="fa-solid fa-calendar-day"></i> Especialidad:</b>  {{ $model['especialidad'] }}<br>
                                                                <b><i class="fa-solid fa-calendar-day"></i> Médico:</b> {{ $model['medico'] }}<br>
                                                                <b><i class="fa-solid fa-calendar-day"></i> Día:</b> {{ $model['day'] }} <br>
                                                                <b><i class="fa-solid fa-calendar-days"></i> Mes:</b> {{ $model['month_nombre'] }} <br>
                                                                <b><i class="fa-solid fa-calendar"></i> Año:</b> {{ $model['year'] }} <br>
                                                                <b><i class="fa-solid fa-clock"></i> Hora:</b> {{ $model['hour'] }} <br>
                                                                <b><i class="fa-solid fa-location-dot"></i> Centro de Salud:</b> {{ $model['centro_salud'] }} <br>
                                                                <b><i class="fa-solid fa-map-pin"></i> Dirección:</b> {{ $model['address'] }} <br>
                                                                <b><i class="fa-solid fa-map-pin"></i> Motivo de consulta:</b> {{ $model['cita_motivo'] }} <br>
                                                            </div>
                                                            <div class="text-center">
                                                                <b><i class="fa-solid fa-map-pin"></i> Estatus:</b>
                                                                <h2><b class="text-info" style="background-color: #f7f4f4;
                                                                    padding: 2%;">Por Confirmar</b></h2>
                                                            </div>
                                                            <p>
                                                                Recibirás un nuevo mensaje una vez tu cita haya sido confirmada por el equipo de salud.
                                                            </p>
                                                            <a href="{{ $model['location_link'] }}" target="_blank" class="btn btn-default text-primary btn-block btn-lg btn-flat btn-nueva-cita">
                                                                <b class="btn-nueva-cita">Ver en Google Maps</b>
                                                            </a>

                                                            <br>
                                                            Puedes verificarlos, autenticandote con tu usuario y contraseña en el siguiente enlace:<br>
                                                            <a href="{{ config('app.APP_URL_LOGIN_CONSULTA_EXTERNA') }}" style="text-transform: uppercase">{{ config('app.APP_NAME_VERSION') }}</a>
                                                        </div>
                                                    @break
                                                    @case(4) <!-- reprogramada cita -->
                                                        <div>
                                                            Recibe un cordial saludo del equipo de <b>{{ config('app.APP_NAME_VERSION') }}</b>,
                                                        </div>
                                                        <div>
                                                            <div style="margin:5px 0px 5px 0px;background-color: #f7f4f4;
                                                                padding: 2%;
                                                                border-radius: 20px;">
                                                                <div class="text-center">
                                                                    <h3>Tu cita médica, agendada para el {{ $model['fecha_anterior'] }} , ha sido reprogramada para el:</h3>
                                                                </div>
                                                                <b><i class="fa-solid fa-calendar-day"></i> Día:</b> {{ $model['day'] }} <br>
                                                                <b><i class="fa-solid fa-calendar-days"></i> Mes:</b> {{ $model['month'] }} <br>
                                                                <b><i class="fa-solid fa-calendar"></i> Año:</b> {{ $model['year'] }} <br>
                                                                <b><i class="fa-solid fa-clock"></i> Hora:</b> {{ $model['hour'] }} <br>
                                                                <b><i class="fa-solid fa-calendar-day"></i> Especialidad:</b>  {{ $model['especialidad'] }}<br>
                                                                <b><i class="fa-solid fa-calendar-day"></i> Médico:</b> {{ $model['medico'] }}<br>
                                                                <b><i class="fa-solid fa-calendar-day"></i> Motivo de reprogramación:</b> {{ $model['coments'] }}<br>
                                                                <b><i class="fa-solid fa-location-dot"></i> Centro de Salud:</b> {{ $model['centro_salud'] }} <br>
                                                                <b><i class="fa-solid fa-map-pin"></i> Dirección:</b> {{ $model['address'] }} <br>
                                                            </div>
                                                            <div class="text-center">
                                                                <b><i class="fa-solid fa-map-pin"></i> Estatus:</b>
                                                                <h2><b class="text-warning" style="background-color: #f7f4f4;
                                                                    padding: 2%;">Reprogramada</b></h2>
                                                            </div>
                                                            <p>
                                                                Para confirmar la nueva fecha, ingresa en nuestra plataforma en línea y pulsa en el boton <b class="bg-warning" style="padding:1%">Confirmar</b>
                                                            </p>
                                                            <a href="{{ $model['location_link'] }}" target="_blank" class="btn btn-default text-primary btn-block btn-lg btn-flat btn-nueva-cita">
                                                                <b class="btn-nueva-cita">Ver en Google Maps</b>
                                                            </a>

                                                            <br>
                                                            Puedes verificarlos, autenticandote con tu usuario y contraseña en el siguiente enlace:<br>
                                                            <a href="{{ config('app.APP_URL_LOGIN_CONSULTA_EXTERNA') }}" style="text-transform: uppercase">{{ config('app.APP_NAME_VERSION') }}</a>
                                                        </div>
                                                    @break
                                                    @case(5) <!-- confirmada cita -->
                                                        <div>
                                                            Recibe un cordial saludo del equipo de <b>{{ config('app.APP_NAME_VERSION') }}</b>,
                                                        </div>
                                                        <div>
                                                            <div style="margin:5px 0px 5px 0px;background-color: #f7f4f4;
                                                                padding: 2%;
                                                                border-radius: 20px;">
                                                                <div class="text-center">
                                                                    <h3>Tu cita medica, ha sido confirmada por nuestro equipo médico para el:</h3>
                                                                </div>

                                                                <b><i class="fa-solid fa-calendar-day"></i> Día:</b> {{ $model->day }} <br>
                                                                <b><i class="fa-solid fa-calendar-days"></i> Mes:</b> {{ $model['month'] }} <br>
                                                                <b><i class="fa-solid fa-calendar"></i> Año:</b> {{ $model->year }} <br>
                                                                <b><i class="fa-solid fa-clock"></i> Hora:</b> {{ $model->hour }} <br>
                                                                <b><i class="fa-solid fa-calendar-day"></i> Especialidad:</b>  {{ $model['especialidad'] }}<br>
                                                                <b><i class="fa-solid fa-calendar-day"></i> Médico:</b> {{ $model['medico'] }}<br>
                                                                <b><i class="fa-solid fa-location-dot"></i> Centro de Salud:</b> {{ $model['centro_salud'] }} <br>
                                                                <b><i class="fa-solid fa-map-pin"></i> Dirección:</b> {{ $model['address'] }} <br>
                                                            </div>
                                                            <div class="text-center">
                                                                <b><i class="fa-solid fa-map-pin"></i> Estatus:</b>
                                                                <h2><b class="text-success" style="background-color: #f7f4f4;
                                                                    padding: 2%;">Confirmada</b></h2>
                                                            </div>
                                                            <p>
                                                                Recibirás un recordatorio un dia antes de la fecha agendada.
                                                            </p>
                                                            <a href="{{ $model['location_link'] }}" target="_blank" class="btn btn-default text-primary btn-block btn-lg btn-flat btn-nueva-cita">
                                                                <b class="btn-nueva-cita">Ver en Google Maps</b>
                                                            </a>

                                                            <br>
                                                            Puedes verificarlos, autenticandote con tu usuario y contraseña en el siguiente enlace:<br>
                                                            <a href="{{ config('app.APP_URL_LOGIN_CONSULTA_EXTERNA') }}" style="text-transform: uppercase">{{ config('app.APP_NAME_VERSION') }}</a>
                                                        </div>
                                                    @break
                                                    @case(6) <!-- cancelada cita -->
                                                        <div>
                                                            Recibe un cordial saludo del equipo de <b>{{ config('app.APP_NAME_VERSION') }}</b>,
                                                        </div>
                                                        <div>
                                                            <div style="margin:5px 0px 5px 0px;background-color: #f7f4f4;
                                                                padding: 2%;
                                                                border-radius: 20px;">
                                                                <div class="text-center">
                                                                    <h3>Tu cita medica, ha sido cancelada:</h3>
                                                                </div>
                                                                <b><i class="fa-solid fa-calendar-day"></i> Especialidad:</b>  {{ $model['especialidad'] }}<br>
                                                                <b><i class="fa-solid fa-calendar-day"></i> Médico:</b> {{ $model['medico'] }}<br>
                                                                <b><i class="fa-solid fa-calendar-day"></i> Día:</b> {{ $model['day'] }} <br>
                                                                <b><i class="fa-solid fa-calendar-days"></i> Mes:</b> {{ $model['month'] }} <br>
                                                                <b><i class="fa-solid fa-calendar"></i> Año:</b> {{ $model['year'] }} <br>
                                                                <b><i class="fa-solid fa-clock"></i> Hora:</b> {{ $model['hour'] }} <br>
                                                                <b><i class="fa-solid fa-location-dot"></i> Centro de Salud:</b> {{ $model['centro_salud'] }} <br>
                                                                <b><i class="fa-solid fa-map-pin"></i> Dirección:</b> {{ $model['address'] }} <br>
                                                                <b><i class="fa-solid fa-map-pin"></i> Motivo de cancelación:</b> {{ $model['motivo_cancelacion'] }} <br>
                                                            </div>
                                                            <div class="text-center">
                                                                <b><i class="fa-solid fa-map-pin"></i> Estatus:</b>
                                                                <h2><b class="text-danger" style="background-color: #f7f4f4;
                                                                    padding: 2%;">Cancelada</b></h2>
                                                            </div>
                                                            <p>
                                                                {{-- Recibirás un recordatorio un dia antes de la fecha agendada. --}}
                                                            </p>
                                                            <a href="{{ $model['location_link'] }}" target="_blank" class="btn btn-default text-primary btn-block btn-lg btn-flat btn-nueva-cita">
                                                                <b class="btn-nueva-cita">Ver en Google Maps</b>
                                                            </a>

                                                            <br>
                                                            Puedes verificarlos, autenticandote con tu usuario y contraseña en el siguiente enlace:<br>
                                                            <a href="{{ config('app.APP_URL_LOGIN_CONSULTA_EXTERNA') }}" style="text-transform: uppercase">{{ config('app.APP_NAME_VERSION') }}</a>
                                                        </div>
                                                    @break
                                                    @case(7) <!-- update user -->
                                                        <p>
                                                            Recibe un cordial saludo del equipo de <b>{{ config('app.APP_NAME_VERSION') }}</b>,
                                                        </p>
                                                        <p>
                                                            Tu cita médica, ha sido atendida y completada satisfactoriamente el dia de hoy.
                                                            Esperamos haberte brindado la mejor de las atenciones y calidad de servicio
                                                            en el examen, diagnóstico y solución de tu situación de salud.<br>




                                                        </p>
                                                    @break
                                                    @case(8) <!-- create cita -->
                                                        <div>
                                                            Recibe un cordial saludo del equipo de <b>{{ config('app.APP_NAME_VERSION') }}</b>,
                                                        </div>
                                                        <div>
                                                            <div style="margin:5px 0px 5px 0px;background-color: #f7f4f4;
                                                                padding: 2%;
                                                                border-radius: 20px;">
                                                                <div class="text-center">
                                                                    <h3>Has autorizado una cita de cortesía para {{ $model['paciente']['genero'] =="f" ? 'la':'el' }} paciente: </h3>
                                                                    <h2>{{ $model['paciente']['nombre'] }}, cédula: {{ $model['paciente']['cedula'] }}</h2>
                                                                    <h3>Los datos de la Cita son los siguientes:</h3>

                                                                </div>
                                                                <b><i class="fa-solid fa-calendar-day"></i> Especialidad:</b>  {{ $model['especialidad'] }}<br>
                                                                <b><i class="fa-solid fa-calendar-day"></i> Médico:</b> {{ $model['medico'] }}<br>
                                                                <b><i class="fa-solid fa-calendar-day"></i> Día:</b> {{ $model['day'] }} <br>
                                                                <b><i class="fa-solid fa-calendar-days"></i> Mes:</b> {{ $model['month'] }} <br>
                                                                <b><i class="fa-solid fa-calendar"></i> Año:</b> {{ $model['year'] }} <br>
                                                                <b><i class="fa-solid fa-clock"></i> Hora:</b> {{ $model['hour'] }} <br>
                                                                <b><i class="fa-solid fa-location-dot"></i> Centro de Salud:</b> {{ $model['centro_salud'] }} <br>
                                                                <b><i class="fa-solid fa-map-pin"></i> Dirección:</b> {{ $model['address'] }} <br>
                                                                <b><i class="fa-solid fa-map-pin"></i> Modalidad de cita:</b> Cortesía <br>
                                                                <b><i class="fa-solid fa-map-pin"></i> Convenio:</b> {{ $model['condicion_descripcion'] }}<br>
                                                                <b><i class="fa-solid fa-map-pin"></i> Autorizado por:</b> {{ $model['user_autorizacion'] }}<br>
                                                            </div>

                                                        </div>
                                                    @break
                                                @endswitch
                                            </p>
                                            {{-- <p>Atentamente,<br></p>
                                            <p style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                                                Equipo Médico <b>{{ config('app.APP_NAME_VERSION') }}</b>
                                            </p> --}}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative;">
                                <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; margin: 0 auto; padding: 0; text-align: center; width: 570px;">
                                    <tr>
                                        <td class="content-cell" align="center" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; max-width: 100vw; padding: 32px;">
                                            <p style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; line-height: 1.5em; margin-top: 0; color: #b0adc5; font-size: 12px; text-align: center;">
                                                ©{{ date("Y") }} {{ config('app.APP_NAME') }}. Todos los derechos reservados.
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
