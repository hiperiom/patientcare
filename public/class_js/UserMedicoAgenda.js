class UserMedicoAgenda {
    constructor(){

    }
    static async getAll() {

       return await get( location.origin+"/medico/agenda/getAll")
   }
}
