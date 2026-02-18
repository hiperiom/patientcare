class UserCuestValoracion {
    static store(data) {
        let formdata = new FormData();
        formdata.append("email", data.email)
        formdata.append("type", data.type)
        formdata.append("value", data.value == undefined ? 1 : data.value)
        formdata.append("coments", data.coments)
        formdata.append("cat_user_cuestionario_id", 193)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_cuest_valoracion/store", formdata)
    }
    static show() {

    }
}
