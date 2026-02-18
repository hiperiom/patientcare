export async function getAll(user_id){
    let formdata = new FormData();
        formdata.append("user_id", user_id)
        formdata.append("_token", $("#_token").val())
        return await post("/consultaexterna/user_profile_images/getAll", formdata)
}
