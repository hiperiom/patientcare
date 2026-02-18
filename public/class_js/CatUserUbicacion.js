import {get,post,loading} from "../helpers/helpers.js";

export default class CatUserUbicacion {
   getIndex() {
        return get( location.origin+"/cat_user_ubicacion/index");
    }
   showMenu() {
        let formdata = new FormData();
        formdata.append("cat_user_ubicacion_id", 1)
        formdata.append("_token", $("#_token").val())
        return post(location.origin+"/cat_user_ubicacion/show/menu", formdata)
    }
   show(parent_cat_user_ubicacion_id) {
        //let formdata = new FormData();
        //formdata.append("parent_cat_user_ubicacion_id", parent_cat_user_ubicacion_id)
        //formdata.append("_token", $("#_token").val())

        return get(location.origin+'/cat_user_ubicacion/show/' + parent_cat_user_ubicacion_id);
    }
}
