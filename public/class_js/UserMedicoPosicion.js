import {get,post,select,fotoTemporal,is_null,timestamps,reemplaza_imagen} from "../helpers/helpers.js";

export default class UserMedicoPosicion {
    static store(user_id) {
        let cat_medico_posicion_id = $("#cat_medico_posicion_id");

        let formdata = new FormData();
        formdata.append("user_id_medico", user_id)
        formdata.append("cat_user_medico_posicion_id", cat_medico_posicion_id.val())
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_medico_posicion/store", formdata)
    }
    static update(user_id) {
        let cat_medico_posicion_id = $("#cat_medico_posicion_id");

        let formdata = new FormData();
        formdata.append("user_id_medico", user_id)
        formdata.append("cat_user_medico_posicion_id", cat_medico_posicion_id.val())
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_medico_posicion/update", formdata)
    }
    static show(user_id) {
        let formdata = new FormData();
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_medico_posicion/show/"+user_id, formdata)
    }
}
