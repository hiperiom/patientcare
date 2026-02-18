
import {get,post,select,fotoTemporal,is_null,timestamps,reemplaza_imagen} from "../helpers/helpers.js";

export default class UserEspecialidad {
    static store(user_id) {
        if ($("#cat_user_especialidad_id").val() == "") {
            $("#cat_user_especialidad_id").val(1)
        }
        let formdata = new FormData();
        formdata.append("cat_user_especialidad_id", $("#cat_user_especialidad_id").val())
        formdata.append("user_id", user_id)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_especialidad/store", formdata)
    }
    static update(user_id) {
        let formdata = new FormData();
        formdata.append("cat_user_especialidad_id", $("#cat_user_especialidad_id").val())
        formdata.append("user_id", user_id)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_especialidad/update", formdata)
    }
    static async show(user_id) {
        return await get( location.origin+"/user_especialidad/show/" + user_id);
    }
    static index_medico_especialidad(){
        return get( location.origin+"/user_especialidad/index_medico_especialidad");
    }
}
