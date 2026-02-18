import { timestamps,post } from "../helpers/helpers.js";

export default class UserType {
    async store(user_id) {
        let formdata = new FormData();
        formdata.append("cat_user_type_id", 1)
        formdata.append("user_id", user_id)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return await post( location.origin+"/user_type/store", formdata)
    }
    store2(data) {
        let formdata = new FormData();
        formdata.append("cat_user_type_id", data.cat_user_type_id)
        formdata.append("user_id", data.user_id)
        formdata.append("created_at", timestamps())
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_type/store", formdata)
    }
    update(user_id,cat_user_type_id,new_cat_user_type_id) {
        let formdata = new FormData();
        formdata.append("user_id", user_id)
        formdata.append("cat_user_type_id", cat_user_type_id)
        formdata.append("new_cat_user_type_id", new_cat_user_type_id)
        formdata.append("_token", $("#_token").val())
        return post( location.origin+"/user_type/update", formdata)
    }

}
