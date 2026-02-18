@extends('component.template')

@section('title')
    CMDLT | PatientCare
@endsection
@section('header')
    @include('component.menu_principal')
@endsection
@section('menu_2')
    @if (!is_null(session('userData')))
        @include('component.menu_user')
    @endif
@endsection
@section('content')
        @yield('menu_2')
        <div class="content-wrapper">
            <div class="wrapper">
                <div class="container-fluid">
                    <div id="content_1" >
                        <div class="d-flex m-4 justify-content-center text-primary">
                            Cargando...
                            <div class="spinner-border" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->
       {{--  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelIdEditFoto">
          Launch
        </button> --}}

        <!-- Modal -->
        {{-- <div class="modal fullscreen-modal fade" style="z-index: 10000;" id="modelIdEditFoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    <div class="modal-header p-0">
                        <nav class="d-flex justify-content-between align-items-center bg-primary rounded-pill m-1 ">
                            <i id="close_modal" data-dismiss="modal" aria-label="Close" class="ml-3 fas fa-times text-white heartbeat" style="font-size: 2em;cursor:pointer;" aria-hidden="true"></i>

                            <img class="img-logo m-1 d-block" src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT">
                        </nav>
                    </div>
                    <div class="modal-body-2 overflow-auto">
                        <div id="editFotoBox" class="">
                            <img id="imageTemp" src="/image/user/foto_perfil/fp_pLj0za18819-ImagendeWhatsApp2024-02-16alas09.23.18_4175f3b6.jpg">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button onclick="guardarImgActualizada()" type="button" class="btn btn-primary">Recortar y Guardar</button>
                    </div>
                </div>
            </div>
        </div> --}}

@endsection
@section('footer')
    @include('component.menu_footer')
@endsection
@section('script')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js" integrity="sha512-9KkIqdfN7ipEW6B6k+Aq20PV31bjODg4AA52W+tYtAE0jE0kMx49bjJ3FgvS56wzmyfMUHbQ4Km2b7l9+Y/+Eg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        // let cropper;
        // function EditImage(user_id,urlImg) {
        //     $("#modelIdEditFoto").modal('show')
        //     let image = document.querySelector('#imageTemp')
        //         image.src = urlImg
        //         image.dataset.imgName = urlImg
        //         image.dataset.user_id = user_id


        //         cropper = new Cropper(image, {
        //             //minContainerWidth:"100%",
        //             //minContainerHeight:"100%",
        //             viewMode: 1, // Vista de recorte: solo recorte, sin zoom
        //             aspectRatio: 1, // Aspect ratio 1:1
        //             autoCropArea: 1, // Área de recorte automático con aspect ratio fijo
        //             //minCanvasWidth:"100%",
        //             //minCanvasHeight:"100%",
        //             //minCropBoxWidth: "100%", // Ancho mínimo de la caja de recorte
        //             //minCropBoxHeight: "100%", // Alto mínimo de la caja de recorte
        //             //maxCropBoxWidth: "100%", // Ancho máximo de la caja de recorte
        //             //maxCropBoxHeight: "100%", // Alto máximo de la caja de recorte



        //             //scalable:false,
        //             rounded: true, // Imagen redondeada
        //             dragMode: 'none', // Modo de arrastre deshabilitado
        //             crop: event => {
        //                 // Manejar el evento de recorte si es necesario
        //                 console.log('Recorte:', event.detail);
        //             }


        //         });
        // }

       /*  function EditImage(user_id, urlImg) {

            Swal.fire({
                html: `
                    <img id="preview" src="${urlImg}">
                    <div>
                    <img id="cropperjs" src="${urlImg}">
                    </div>
                `,
                willOpen: () => {
                    const image = Swal.getPopup().querySelector('#cropperjs')
                    const cropper = new Cropper(image, {
                        aspectRatio: 1,
                        viewMode: 1,
                        crop: function () {
                            const croppedCanvas = cropper.getCroppedCanvas()
                            const preview = Swal.getPopup().querySelector('#preview')
                            preview.src = croppedCanvas.toDataURL('image/jpeg')
                            let imagenRecortadaBase64 = croppedCanvas.toDataURL('image/jpeg');
                            // Guarda la imagen recortada temporalmente en el almacenamiento local del navegador
                            sessionStorage.setItem('imagenRecortada', imagenRecortadaBase64);
                        },
                    })
                },
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: `Recortar`,
                cancelButtonText: `Cancelar`,
                preConfirm: async () => {
                    let formdata = new FormData();
                    formdata.append("user_id", user_id)
                    formdata.append("nombreImagen", urlImg)
                    formdata.append("imagenBase64", sessionStorage.getItem('imagenRecortada'))
                    formdata.append("_token", $("#_token").val())
                    let result = await post( location.origin+"/user/paciente/recortarimagen",formdata)
                    let imageUser = document.querySelector('#image-perfil_'+user_id)
                    imageUser.src = sessionStorage.getItem('imagenRecortada')
                },
            });
        } */

        // async function guardarImgActualizada(){
        //     // Obtiene la imagen recortada como base64

        //     let image = document.querySelector('#imageTemp')
        //     let imagePerfil = document.querySelector('#imageTemp')
        //     let nombreImagen = image.dataset.imgName
        //     let user_id = image.dataset.user_id


        //     console.log(nombreImagen)
        //     let imagenRecortadaBase64 = cropper.getCroppedCanvas().toDataURL('image/jpeg');


        //         // Guarda la imagen recortada temporalmente en el almacenamiento local del navegador
        //         localStorage.setItem('imagenRecortada', imagenRecortadaBase64);
        //         cropper.destroy()
        //         image.src = imagenRecortadaBase64
        //     let formdata = new FormData();
        //         formdata.append("user_id", user_id)
        //         formdata.append("nombreImagen", nombreImagen)
        //         formdata.append("imagenBase64", localStorage.getItem('imagenRecortada'))
        //         formdata.append("_token", $("#_token").val())
        //     let result = await post( location.origin+"/user/paciente/recortarimagen",formdata)
        //     let imageUser = document.querySelector('#image-perfil_'+user_id);
        //         imageUser.src=localStorage.getItem('imagenRecortada')
        //         $("#modelIdEditFoto").modal('hide')
        //         // Enviar la imagen recortada al servidor cuando sea necesario
        //         // Aquí puedes hacer una solicitud HTTP al servidor para enviar la imagen
        //         // Ejemplo: fetch('https://tu-servidor.com/subir-imagen', { method: 'POST', body: imagenRecortadaBase64 })
        // }
        /* $(document).ready( function () {
            UserMedico.index("#content_1")
            //EditImage()
        }); */
    </script>
    <script src="{{ mix('js/app_gestion_medicos.js') }}" type="text/javascript"></script>

@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.css" integrity="sha512-bs9fAcCAeaDfA4A+NiShWR886eClUcBtqhipoY5DM60Y1V3BbVQlabthUBal5bq8Z8nnxxiyb1wfGX2n76N1Mw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>

        #cropperjs {
        display: block;
        max-width: 100%;
        }

        #preview {
        width: 200px;
        height: 200px;
        margin-bottom: 10px;
        border-radius: 100%;
        }

        #editFotoBox{


                /* This rule is very important, please don't ignore this */
               /*  width: 50%; */
        }
        #editFotoBox img {
                display: block;

                /* This rule is very important, please don't ignore this */
                max-width: 100%;
        }
        /* .cropper-container {
            direction: ltr;
            font-size: 0;
            line-height: 0;
            position: relative;
            -ms-touch-action: none;
            touch-action: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            width: auto !important;
            height: 70vh !important;
        } */
       /*  .cropper-container {

        } */
    </style>
@endsection
