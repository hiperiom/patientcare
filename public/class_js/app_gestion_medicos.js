//import UserCuestPaciente from "./UserCuestPaciente.js";
import UserMedico from "./UserMedico.js";
import {get,post} from "../helpers/helpers.js";
let cropper;
let iti
//INSTANCIAS DE CLASE
//let userCuestPaciente = new UserCuestPaciente()


    function EditImage(user_id, urlImg) {

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
    }
    async function guardarImgActualizada(){
        // Obtiene la imagen recortada como base64

        let image = document.querySelector('#imageTemp')
        let imagePerfil = document.querySelector('#imageTemp')
        let nombreImagen = image.dataset.imgName
        let user_id = image.dataset.user_id


        console.log(nombreImagen)
        let imagenRecortadaBase64 = cropper.getCroppedCanvas().toDataURL('image/jpeg');


            // Guarda la imagen recortada temporalmente en el almacenamiento local del navegador
            localStorage.setItem('imagenRecortada', imagenRecortadaBase64);
            cropper.destroy()
            image.src = imagenRecortadaBase64
        let formdata = new FormData();
            formdata.append("user_id", user_id)
            formdata.append("nombreImagen", nombreImagen)
            formdata.append("imagenBase64", localStorage.getItem('imagenRecortada'))
            formdata.append("_token", $("#_token").val())
        let result = await post( location.origin+"/user/paciente/recortarimagen",formdata)
        let imageUser = document.querySelector('#image-perfil_'+user_id);
            imageUser.src=localStorage.getItem('imagenRecortada')
            $("#modelIdEditFoto").modal('hide')
            // Enviar la imagen recortada al servidor cuando sea necesario
            // Aquí puedes hacer una solicitud HTTP al servidor para enviar la imagen
            // Ejemplo: fetch('https://tu-servidor.com/subir-imagen', { method: 'POST', body: imagenRecortadaBase64 })
    }

    document.addEventListener("click", async (e) => {
        if (e.target.matches(".image-perfil")) {
            //console.log(e.target.dataset.user_id, e.target.dataset.urlImg);
            //that.show(user_id)
            EditImage(e.target.dataset.user_id, e.target.dataset.urlimg)
        }
        if (e.target.matches(".guardarImgActualizada")) {

            guardarImgActualizada()

        }
    })


    /* d.addEventListener("click", async (e) => {
        if (e.target.matches(".handleCintilloPacienteVisibility")) {
            handleCintilloPacienteVisibility()
        }



    }) */





    document.addEventListener("DOMContentLoaded", async () => {

        if (location.pathname==="/medico/create") {
            UserMedico.create("#content_1")
        }
        if (location.pathname==="/medico/index_medicos") {
            UserMedico.index("#content_1")
        }
        if ( location.pathname.includes("/medico/edit") ) {

            UserMedico.edit("#content_1",user_id)
        }

    })



/************* */

