export async function show(user_id){

    return await get("/consultaexterna/user_tarjeta_soy_chacao/show/"+user_id)
}
