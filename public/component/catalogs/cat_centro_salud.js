import {} from '../../helpers/helpers.js'
let useState = {
    "centro_salud":[
        {id: 1, description: 'Centro Médico Docente La Trinidad', coments: 'Av. Principal de El Hatillo, Caracas 1083, Distrito Capital', image: null, location: "https://www.google.com/maps/place/Centro+Médico+Docente+La+Trinidad/@10.4325927,-66.8586836,17z/data=!4m6!3m5!1s0x8c2af7cab47b2545:0x633eed20b60e339e!8m2!3d10.4311788!4d-66.8556259!16s%2Fg%2F11b6bd_9sg?hl=es&entry=ttu"},
        // {id: 3, description: 'Ambulatorio Altamira', coments: 'Plaza miranda Av San juan bosco.', image: null, location: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m…a!5e0!3m2!1ses!2sve!4v1647057079544!5m2!1ses!2sve', location: ""},
        // {id: 4, description: 'CEQ Viseteca - Av Avila', coments: 'Final av Avila Edf. Viseteca, urb Bello Campo. Fte a la torre Xerox.', image: null, location: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m…l!5e0!3m2!1ses!2sve!4v1647057133867!5m2!1ses!2sve', location: ""},
        // {id: 5, description: 'Ambulatorio Chacao - Bello Campo', coments: 'Av. Santa Ana. Bello Campo', image: null, location: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m…o!5e0!3m2!1ses!2sve!4v1647057394657!5m2!1ses!2sve', location: ""},
        // {id: 6, description: 'Ambulatorio Salud Chacao - El Bosque', coments: 'Av principal el bosque , dentro del parque Centeno Vallenilla.', image: null, location: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m…a!5e0!3m2!1ses!2sve!4v1647057649813!5m2!1ses!2sve',location: ""},
        // {id: 7, description: 'Ambulatorio Chacao - El Pedregal', coments: '2da transversal de la castellana con Av. principal el pedregal', image: null, location: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m…)!5e0!3m2!1ses!2sve!4v1647057714709!5m2!1ses!2sve', location: ""},
        // {id: 8, description: 'Ambulatorio Salud Chacao - Bucaral', coments: 'Actualmente cerrado', image: null, location: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m…l!5e0!3m2!1ses!2sve!4v1647057939604!5m2!1ses!2sve',location: ""},
        // {id: 10, description: 'Emergencia Salud Chacao', coments: 'Prolong. Av. Libertador, con, Av. Sorocaima, Caracas', image: null, location: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m…)!5e0!3m2!1ses!2sve!4v1647057714709!5m2!1ses!2sve', location: ""},

    ]
}
export let get_all = (attr) => {
    return useState[attr]
}
export let get_by = (attr,key,value) => {
    return useState[attr].filter(item=> equalsInt(item[key],value) )
}
export let get_index = (attr,key,value) => {
    return useState[ attr ].findIndex( index => equalsInt(index[key]), value )
}
export let get_one = (attr,key,value) => {
    return useState[ attr ].map( index => equalsInt( index[key] ), value )
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


export let index = async ()=>{
        return await get("/consultaexterna/cat/centro_salud/getAll");
    }
let show = async ()=>{

    }
let store = async ()=>{

    }
let destroy = async ()=>{

    }
let update = async ()=>{

    }
