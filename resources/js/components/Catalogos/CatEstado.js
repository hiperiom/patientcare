export let getAll = ()=> {
    //return await get( location.origin+"/cat_user_estado/index")
    return [
        {
            "id": 1,
            "description": "Amazonas",
            "active": 1,
        },
        {
            "id": 2,
            "description": "Anzoategui",
            "active": 1,
        },
        {
            "id": 3,
            "description": "Apure",
            "active": 1,
        },
        {
            "id": 4,
            "description": "Aragua",
            "active": 1,
        },
        {
            "id": 5,
            "description": "Barinas",
            "active": 1,
        },
        {
            "id": 6,
            "description": "Bolívar",
            "active": 1,
        },
        {
            "id": 7,
            "description": "Carabobo",
            "active": 1,
        },
        {
            "id": 8,
            "description": "Cojedes",
            "active": 1,
        },
        {
            "id": 9,
            "description": "Delta Amacuro",
            "active": 1,
        },
        {
            "id": 10,
            "description": "Falcón",
            "active": 1,
        },
        {
            "id": 11,
            "description": "Guárico",
            "active": 1,
        },
        {
            "id": 12,
            "description": "Lara",
            "active": 1,
        },
        {
            "id": 13,
            "description": "Mérida",
            "active": 1,
        },
        {
            "id": 14,
            "description": "Miranda",
            "active": 1,
        },
        {
            "id": 15,
            "description": "Monagas",
            "active": 1,
        },
        {
            "id": 16,
            "description": "Nueva Esparta",
            "active": 1,
        },
        {
            "id": 17,
            "description": "Portuguesa",
            "active": 1,
        },
        {
            "id": 18,
            "description": "Sucre",
            "active": 1,
        },
        {
            "id": 19,
            "description": "Táchira",
            "active": 1,
        },
        {
            "id": 20,
            "description": "Trujillo",
            "active": 1,
        },
        {
            "id": 21,
            "description": "Yaracuy",
            "active": 1,
        },
        {
            "id": 22,
            "description": "Zulia",
            "active": 1,
        },
        {
            "id": 23,
            "description": "Dependencias Federales",
            "active": 1,
        },
        {
            "id": 24,
            "description": "Distrito Capital",
            "active": 1,
        },
        {
            "id": 25,
            "description": "La Guaira",
            "active": 1,
        }
    ]
}
export let getOne = (id)=> {
    return getAll().find(item=>Number(item.id) === Number(id))
}