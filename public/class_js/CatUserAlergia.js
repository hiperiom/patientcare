class CatUserAlergia{
    static index(){
        let count = 1                                                            
        return [
                {"id":count++,"active":true,"description":"Cereales que contengan gluten, a saber trigo (como espelta y trigo Khorasan), centeno, cebada, avena o sus variedades híbridas y productos derivados"},
                {"id":count++,"active":true,"description":"Crustáceos y productos a base de crustáceos"},
                {"id":count++,"active":true,"description":"Huevos y productos a base de huevo"},
                {"id":count++,"active":true,"description":"Pescado y productos a base de pescado"},
                {"id":count++,"active":true,"description":"Cacahuetes y productos a base de cacahuetes"},
                {"id":count++,"active":true,"description":"Soja y productos a base de soja"},
                {"id":count++,"active":true,"description":"Leche y sus derivados (incluyendo la lactosa)"},
                {"id":count++,"active":true,"description":"Frutos de cáscara"},
                {"id":count++,"active":true,"description":"Apio y productos derivados"},
                {"id":count++,"active":true,"description":"Mostaza y productos derivados"},
                {"id":count++,"active":true,"description":"Granos de sésamo y productos a base de granos de sésamo"},
                {"id":count++,"active":true,"description":"Dióxido de azufre y sulfitos en concentraciones superiores a 10 mg / kg o 10 mg /litro en términos de SO2 total"},
                {"id":count++,"active":true,"description":"Altramuces y productos a base de altramuces"},
                {"id":count++,"active":true,"description":"Moluscos y productos a base de moluscos"},
            ]
    }
    static getItem(id){
        return first( CatUserAlergia.index().filter(x=> equalsInt(x.id, id) ) )
    }
}