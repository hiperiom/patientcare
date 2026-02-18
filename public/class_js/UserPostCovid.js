class UserPostCovid{
    static async store(user_id) {
        // let message;
        let formdata = new FormData();

        let inicio_sintomas = document.getElementById('inicio_sintomas');
        let hospitalizacion = document.getElementById('hospitalizacion');
        let atencion_med = document.getElementById('atencion_med');
        let oxigenoterapia = document.getElementById('oxigenoterapia');
        let sintomatologia = document.getElementById('sintomatologia');
        let created_at = timestamps();


        formdata.append("hospitalizacion", hospitalizacion.value)
        formdata.append("inicio_sintomas", inicio_sintomas.value)
        formdata.append("atencion_med", atencion_med.value)
        formdata.append("oxigenoterapia", oxigenoterapia.value)
        formdata.append("sintomatologia", sintomatologia.value)
        formdata.append("user_id", user_id)

        formdata.append("created_at", created_at)
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_post_covid/store", formdata)
    }
    static async getAll(){
        let formdata = new FormData();
        formdata.append("_token", $("#_token").val())
        return await post( location.origin+"/user_post_covid/getAll", formdata)
    }
}
