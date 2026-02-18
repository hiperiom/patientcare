import {} from '../../helpers/helpers.js'
let d = document

export let get_all = (attr) => {
        return useState[attr]
    }
export let get_index = (attr,key,value) => {
        return useState[ attr ].findIndex( index => equalsInt(index[key], value ))
    }
export let get_one = (attr,key,value) => {
        return useState[ attr ].map( index => equalsInt( index[key] , value ))
    }
export let add_row = (attr,value,position="first") => {
        if (position === "first") {
            useState[ attr ].unshift(value)
        }
        if (position === "last") {
            useState[ attr ].push(value)
        }
    }
export let delete_one = ({attr,index,item_id}) => {
        useState[ attr ][ get_index(item_id) ].splice(index,1);
    }

export let create = async () => {
       
    }
export let store = async (item_id) => {
       
    }
export let show = async (item_id) => {
       
    }
export let update = async (item_id) => {
       
    }
export let destroy = async (item_id) => {
       
    }
export let form_create = async (item_id) => {
       
    }
export let init = async () => {
       
    }
