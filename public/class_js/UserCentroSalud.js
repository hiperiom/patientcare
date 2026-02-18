class UserCentroSalud{
    static async store(user_id_paciente){
        let formdata = new FormData();
        formdata.append("user_id_paciente",user_id_paciente)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return await post(location.origin+"/user_centro_salud/store", formdata)
    }
}
