class UserProblemaSalud{
    static async store(user_id,data) {
        let formdata = new FormData();

        formdata.append("value", data.value)
        formdata.append("episodio_id", data.episodio_id)
        formdata.append("user_id", user_id)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return await post( location.origin+"/user_motivo_consulta/store2", formdata)
    }
}
