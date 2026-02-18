class CatUserCondicionMedica{
    static index(){
        let count = 1                                                         
            return [
                {"id":count++,"active":true,"description":"Cáncer"},
                {"id":count++,"active":true,"description":"Diábetes"},
                {"id":count++,"active":true,"description":"Enfermedad Cardiovascular"},
                {"id":count++,"active":true,"description":"Hipertensión Arterial"},
                {"id":count++,"active":true,"description":"EPOC (Enfermedad Pulmonar Obstructiva Crónica)"},
                {"id":count++,"active":true,"description":"Alcoholismo"},
                {"id":count++,"active":true,"description":"Tabaco"},
                {"id":count++,"active":true,"description":"Obesidad"},
            ]
    }
    static getItem(id){
        return first( CatUserCondicionMedica.index().filter(x=> equalsInt(x.id, id) ) )
    }
}