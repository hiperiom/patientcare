class UserEncuesta{
    static async store(cat_encuesta_id){
        let formdata = new FormData();
        formdata.append("user_encuesta_pregunta",JSON.stringify(encuesta))
        formdata.append("cat_encuesta_id", cat_encuesta_id)
        formdata.append("nacionalidad", document.getElementById(`nacionalidad`).value)
        formdata.append("nombres", document.getElementById(`nombres`).value)
        formdata.append("apellidos", document.getElementById(`apellidos`).value)
        formdata.append("cedula", document.getElementById(`cedula`).value)
        formdata.append("email", document.getElementById(`email`).value)
        formdata.append("coment", document.getElementById(`coment`).value)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return await post( location.origin+"/user_encuesta/store", formdata)
    }
}
