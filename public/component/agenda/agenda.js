import { $qs, $qsa, $select, $selectCustom, first, last, is_empty } from '../../helpers/helpers.js'
import * as ComponentMedico from '../medico/medico_home.js'
import * as Componentmedico from '../../component/medico/medico.js'

let d = document
export let get_all = (attr) => {
	return useState[attr]
}
export let get_index = (attr, key, value) => {
	return useState[attr].findIndex(index => equalsInt(index[key], value))
}
export let get_one = (attr, key, value) => {
	return useState[attr].find(index => equalsInt(index[key], value))
}
export let get_one_by_index = (index, attr, key, value) => {
	return useState[index][attr].filter(index => equalsInt(index[key], value))
}
export let add_row = (attr, value, position = "first") => {
	if (position === "first") {
		useState[attr].unshift(value)
	}
	if (position === "last") {
		useState[attr].push(value)
	}
}
export let add_row_by_index = (index, attr, value, position = "first") => {
	if (position === "first") {
		useState[index][attr].unshift(value)
	}
	if (position === "last") {
		useState[index][attr].push(value)
	}
}
export let delete_one = ({ attr, index, item_id }) => {
	useState['formAgendaCreate'][attr][get_index(item_id)].splice(index, 1);
}
let $comboEspecialidades = (especialidades,especialidades_del_medico)=>{
	let $fragment = document.createDocumentFragment()

	let $option

		$option = document.createElement("option")
		$option.value = ""
		$option.textContent = "Seleccione"
		$fragment.appendChild($option)

		especialidades.forEach(x=>{

			$option = document.createElement("option")

			$option.value =x.id
			$option.textContent =x.description
			if (!especialidades_del_medico.includes(x.cat_especialidad_id)) {
				$option.style.color="rgb(164, 178, 189)"
				$option.disabled=true
				$option.textContent =x.description
			}
			$fragment.appendChild($option)
		})
	return $fragment;
}

export let create = async (items, all=true) => {
	await init(items)
	console.log(useState)
	let $model = d.querySelector(`${useState['tab']} #form_agenda_create`)
        useState['cat_especialidad_id'] = await get("/consultaexterna/cat_user_especialidad/index");
	let $form = entById("artefacto_0036").content.cloneNode(true)
		$model.innerHTML = null
		$model.append($form)

		d.querySelector(`.cat-cita-status-title`).textContent = "Nueva Agenda"



	//1 datos del medico a mostrar
	let medicos =[]
	let temp_medico = get_one("medicos","user_id",useState['user_id_medico'])

	//2 especialidades del medico
	let especialidades_del_medico = temp_medico.map(x=>x.cat_user_especialidad_id)

		temp_medico = temp_medico.length > 1 ? temp_medico[0] : temp_medico
		medicos.push(temp_medico)
		console.log("1 medicos->",medicos)

	/*** */
	//let medico_centros_de_salud_asociado = temp_medico.centro_salud_id_asignado.split(",").map(x=> parseInt(x) )
	//console.log("medico_centros_de_salud_asociado->",medico_centros_de_salud_asociado)
	let centro_salud = useState['centro_salud']
	let cat_especialidad_id = useState['cat_especialidad_id']
    /* .filter(centro =>{
			if (medico_centros_de_salud_asociado.includes(centro.id)) {
				return centro
			}
		}) */
        $model.querySelector(`select[name='centro_salud_id']`).innerHTML = null
		$model.querySelector(`select[name='centro_salud_id']`).append( $select( centro_salud ) )
        $model.querySelector(`select[name='cat_especialidad_id']`).innerHTML=null;
		$model.querySelector(`select[name='cat_especialidad_id']`).append( $select( cat_especialidad_id ) )
		//$model.querySelector(`select[name='user_id_medico']`).innerHTML = `<option disabled >Sin resultados</option>`
	/*** */

		console.log("4 centro_salud->",centro_salud )
	//INIT VALUES
	let date = new Date()
	useState['formAgendaCreate']['agenda_year'] = date.getFullYear()
	useState['formAgendaCreate']['centro_salud_id'] = parseInt($model.querySelector(`select[name='centro_salud_id']`).value)
	useState['formAgendaCreate']['cat_especialidad_id'] = parseInt($model.querySelector(`select[name='cat_especialidad_id']`).value)
	useState['formAgendaCreate']['user_id_medico'] = parseInt(  useState['user_id_medico'] )

	$model.querySelectorAll(`input[name='agenda_day_week']`).forEach($input2 => {
		if ($input2.checked === true) {
			add_row_by_index(
				"formAgendaCreate",
				"agenda_day_week",
				parseInt($input2.value),
				"last"
			)
		}
	})
	$model.querySelectorAll(`input[name='agenda_month']`).forEach(($input2, key) => {
		if (key !== 0) {
			if ($input2.checked === true) {
				add_row_by_index(
					"formAgendaCreate",
					"agenda_month",
					parseInt($input2.value) + 1,
					"last"
				)

			}
		}
	})
	useState['formAgendaCreate']['agenda_month'] = useState['formAgendaCreate']['agenda_month'].sort(function (a, b) { return a - b })
	//useState['formAgendaCreate']['agenda_hour'] = $model.querySelectorAll(`input[name='agenda_hour']`)[0].value.split("-")

	console.log(useState)

	//EVENTS
	//CENTRO_SALUD_ID
	$model.querySelector(`select[name='centro_salud_id']`).addEventListener("change", function (e) {
		//d.querySelector(`${useState['tab']} select[name='cat_especialidad_id']`).innerHTML = `<option disabled>Sin resultados</option>`
		//d.querySelector(`${useState['tab']} select[name='user_id_medico']`).innerHTML = `<option disabled >Sin resultados</option>`
		if (!is_empty(e.target.value) ) {
			useState['formAgendaCreate']['centro_salud_id'] = parseInt(e.target.value)
			useState['formAgendaCreate']['cat_especialidad_id'] = ""
			//useState['formAgendaCreate']['user_id_medico'] = ""
			/* let model = get_one('centro_salud', 'id', e.target.value)
			let cat_especialidades = first(model).especialidades
				if (cat_especialidades.length > 0) {
					d.querySelector(`${useState['tab']} select[name='cat_especialidad_id']`).innerHTML = null
					d.querySelector(`${useState['tab']} select[name='cat_especialidad_id']`).append($comboEspecialidades(cat_especialidades,especialidades_del_medico))
				} else {
					d.querySelector(`${useState['tab']} select[name='cat_especialidad_id']`).innerHTML = `<option disabled>Sin resultados</option>`
				} */
		}else{
			useState['formAgendaCreate']['centro_salud_id'] = ""
		}
		console.log(useState['formAgendaCreate'])
	})
	//CAT_ESPECIALIDAD_ID
	$model.querySelector(`select[name='cat_especialidad_id']`).addEventListener("change", function (e) {
		//d.querySelector(`${useState['tab']} select[name='user_id_medico']`).innerHTML = `<option disabled >Sin resultados</option>`
		//useState['formAgendaCreate']['user_id_medico'] = ""
		if (!is_empty(e.target.value) ) {
			useState['formAgendaCreate']['cat_especialidad_id'] = parseInt(e.target.value)
		}else{
			useState['formAgendaCreate']['cat_especialidad_id'] = ""
		}
		console.log(useState['formAgendaCreate'])
	})
	/* $model.querySelector(`select[name='user_id_medico']`).addEventListener("change", function (e) {
		useState['formAgendaCreate']['user_id_medico'] = parseInt(e.target.value)

		console.log("user_id_medico->", useState['formAgendaCreate']['user_id_medico'])
	}) */
	$model.querySelectorAll(`input[name='agenda_month']`).forEach(($input, key) => {
		if (
			key !== 0
		) {
			$input.addEventListener("click", function (e) {
				useState['formAgendaCreate']['agenda_month'] = []
				d.querySelectorAll(`input[name='agenda_month']`)[0].checked = false

				d.querySelectorAll(`input[name='agenda_month']`).forEach($input2 => {
					if ($input2.checked === true) {

						add_row_by_index(
							"formAgendaCreate",
							"agenda_month",
							parseInt($input2.value) + 1,
							"last"
						)
					}
				})
				useState['formAgendaCreate']['agenda_month'] = useState['formAgendaCreate']['agenda_month'].sort(function (a, b) { return a - b })


				console.log(useState['formAgendaCreate'])
			})
		}
	})
	$model.querySelectorAll(`input[name='agenda_month']`)[0].addEventListener("click", function (e) {
		useState['formAgendaCreate']['agenda_month'] = []
		if (e.target.checked === false) {

			d.querySelectorAll(`input[name='agenda_month']`).forEach(($input2, key) => {
				if (
					key !== 0
				) {

					$input2.checked = false
				}
			})
		} else {
			d.querySelectorAll(`input[name='agenda_month']`).forEach(($input2, key) => {
				if (
					key !== 0
				) {
					add_row_by_index(
						"formAgendaCreate",
						"agenda_month",
						parseInt($input2.value) + 1,
						"last"
					)

					$input2.checked = true
				}
			})
			useState['formAgendaCreate']['agenda_month'] = useState['formAgendaCreate']['agenda_month'].sort(function (a, b) { return a - b })
		}
		console.log(useState['formAgendaCreate'])
	})
	$model.querySelectorAll(`input[name='agenda_hour']`).forEach($input => {
		$input.addEventListener("click", function (e) {

			if (e.target.checked === true) {
				useState['formAgendaCreate']['agenda_hour'] = []
				useState['formAgendaCreate']['agenda_hour'] = e.target.value.split("-")
			}
			console.log("agenda_hour->", useState['formAgendaCreate']['agenda_hour'])
		})
	})
	$model.querySelectorAll(`input[name='agenda_day_week']`).forEach(($input, key) => {
		if (
			key !== 0
		) {
			$input.addEventListener("click", function (e) {
                if (e.target.checked === false) {
                    $model.querySelectorAll(`input[name='agenda_hour_${e.target.value}']`).forEach(x => {
                        x.checked = false
                    })
                }else{
                    $model.querySelector(`input[name='agenda_hour_${e.target.value}']`).checked = true
                }
				useState['formAgendaCreate']['agenda_day_week'] = []
				$model.querySelectorAll(`input[name='agenda_day_week']`)[0].checked = false

				$model.querySelectorAll(`input[name='agenda_day_week']`).forEach($input2 => {
					if ($input2.checked === true) {

						add_row_by_index(
							"formAgendaCreate",
							"agenda_day_week",
							parseInt($input2.value),
							"last"
						)
					}
				})



				console.log("agenda_day_week->", useState['formAgendaCreate']['agenda_day_week'])
			})
		}
	})
	$model.querySelectorAll(`input[name='agenda_day_week']`)[0].addEventListener("click", function (e) {

        console.log(e.target.value)
		useState['formAgendaCreate']['agenda_day_week'] = []
		if (e.target.checked === false) {

			$model.querySelectorAll(`input[name='agenda_day_week']`).forEach(($input2, key) => {
				if (
					key !== 0
				) {
                    $model.querySelectorAll(`input[name='agenda_hour_${$input2.value}']`).forEach(x => {
                        x.checked = false
                    })
					$input2.checked = false
				}
			})
		} else {
            $model.querySelectorAll(`input[name='agenda_hour_${e.target.value}']`).forEach(x => {
                x.checked = true
            })
			$model.querySelectorAll(`input[name='agenda_day_week']`).forEach(($input2, key) => {
				if (
					key !== 0
				) {

					add_row_by_index(
						"formAgendaCreate",
						"agenda_day_week",
						parseInt($input2.value),
						"last"
					)
					$input2.checked = true
                    $model.querySelectorAll(`input[name='agenda_hour_${$input2.value}']`).forEach(x => {
                        x.checked = true
                    })

				}
			})
		}
		console.log(useState['formAgendaCreate'])
	})
	$model.querySelector("#submit").addEventListener("click", async function (e) {
		e.preventDefault()
        //console.log( document.querySelectorAll(".agenda_hour:checked") )


		useState['formAgendaCreate']['agenda'] = []
		//console.log( useState['formAgendaCreate'] )
		useState['formAgendaCreate']['agenda_month'].forEach(month => {
			let days_week = []

				useState['formAgendaCreate']['agenda_day_week'].forEach(day_week => {
                    let agenda_hour = document.querySelector(`input[name='agenda_hour_${day_week}']:checked` )

                        if (!is_null(agenda_hour)) {
                            agenda_hour =   agenda_hour.value.split("-")
                        }else {
                            agenda_hour = []
                           // document.querySelector(`input[name='agenda_hour_${day_week}']` ).focus()
                           // alert("Selecciona un horario válido.")

                        }
                    let dia_nombre = ""
                        switch (day_week) {
                            case 1: dia_nombre="Lunes"; break;
                            case 2: dia_nombre="Martes"; break;
                            case 3: dia_nombre="Miércoles"; break;
                            case 4: dia_nombre="Jueves"; break;
                            case 5: dia_nombre="Viernes"; break;
                            case 6: dia_nombre="Sábado"; break;
                            case 7: dia_nombre="Domingo"; break;

                        }
                        days_week.push({
                            "dia_semana": day_week,
                            "dia_nombre": dia_nombre,
                            "horas": agenda_hour
                        })
				})
                let mes_nombre = ""
                    switch (month) {
                        case 1: mes_nombre="Enero"; break;
                        case 2: mes_nombre="Febrero"; break;
                        case 3: mes_nombre="Marzo"; break;
                        case 4: mes_nombre="Abril"; break;
                        case 5: mes_nombre="Mayo"; break;
                        case 6: mes_nombre="Junio"; break;
                        case 7: mes_nombre="Julio"; break;
                        case 8: mes_nombre="Agosto"; break;
                        case 9: mes_nombre="Septiembre"; break;
                        case 10: mes_nombre="Octubre"; break;
                        case 11: mes_nombre="Noviembre"; break;
                        case 12: mes_nombre="Diciembre"; break;

                    }
				add_row_by_index(
					"formAgendaCreate",
					"agenda",
					{
						"mes_numero": month,
						"mes_nombre": mes_nombre,
						"horario": days_week
					},
					"last"
				)

		})
        let input = d.querySelector(`select[name='cat_especialidad_id']`)
        if (is_null(input.value )) {

            Toast.fire({
                icon: "warning",
                title: "Seleccione una opción válida.",
                text: nacionalidad.val() + cedula.val() + message['message'],
                didClose: () => {
                    setTimeout(() =>  { input.focus();}, 110);
                }
            })
            return false
        }
		useState['formAgendaCreate']['agenda'] = JSON.stringify(useState['formAgendaCreate']['agenda'])
		let resultset = await store()


            Toast.fire({
                icon: "success",
                title: "Agenda guardada correctamente.",
                text: "",
                didClose: () => {
                    setTimeout(() =>  { }, 110);
                }
            })
			//localStorage.setItem("agenda_create", JSON.stringify( first(resultset) ))
			//console.log("nueva_agenda->", useState['formAgendaCreate']['agenda'])
			console.log("resultset->", resultset)

	})




}
export let handle_cat_especialidad = ()=>{

    let $form = d.querySelector(`#App`)
    let temp_medico = get_one("medicos","user_id",useState['formAgendaCreate']['user_id_medico'])
    let especialidades_del_medico = temp_medico['especialidad'].map(x=>x['cat_user_especialidad_id'])
    // let centros_de_salud = useState['cat_centro_salud'].find(x=> equalsInt(x['id'],useState['formAgendaCreate']['centro_salud_id'] ))
    let centros_de_salud = useState['cat_centro_salud'].find(x=> equalsInt(x['id'],1))
    console.log('Centros de salud --> ',centros_de_salud)
    centros_de_salud = centros_de_salud['centro_salud_especialidades_id'].split(",").map(z=>Number(z))
    //let especialidades_del_centro_salud = useState['cat_especialidad'].filter(z=> centros_de_salud.includes( z['id'] ) )
    let especialidades_del_centro_salud = useState['cat_especialidad'].filter(z=> especialidades_del_medico.includes( z['id'] ) )
        select2(especialidades_del_centro_salud,$form.querySelector("#cat_especialidad_id"))
        useState['formAgendaCreate']['cat_especialidad_id']  = Number($form.querySelector("#cat_especialidad_id").value)
}
/* export let agenda_edit = (e)=>{

    useState['formAgendaCreate']["dias_excluidos"] =[
        "Domingo",
        "Lunes",
        "Martes",
        "Miércoles",
        "Jueves",
        "Viernes",
        "Sábado"
    ]
    useState['formAgendaCreate']["meses_excluidos"] =[
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
    ]
    useState['formAgendaCreate']["semanas_excluidas"] ={
            "Enero": [1,2,3,4,5,6],
            "Febrero": [1,2,3,4,5,6],
            "Marzo":  [1,2,3,4,5,6],
            "Abril": [1,2,3,4,5,6],
            "Mayo":  [1,2,3,4,5,6],
            "Junio":  [1,2,3,4,5,6],
            "Julio":  [1,2,3,4,5,6],
            "Agosto":  [1,2,3,4,5,6],
            "Septiembre":  [1,2,3,4,5,6],
            "Octubre":  [1,2,3,4,5,6],
            "Noviembre":  [1,2,3,4,5,6],
            "Diciembre":  [1,2,3,4,5,6],
        }
    useState['formAgendaCreate']["agenda_month"] =[]
    useState['formAgendaCreate']["resultset"] =[]

    handle_todo_el_anio(false)

    let {agenda_id} = e.dataset
    let agenda = useState['formAgendaCreate']['agenda_registradas'].find(agenda=>equalsInt(agenda['agenda_id'],agenda_id))

        useState['formAgendaCreate']['centro_salud_id'] = agenda['centro_salud_id']
        useState['formAgendaCreate']['cat_especialidad_id'] = agenda['cat_especialidad_id']
        agenda = JSON.parse(agenda['agenda'])

        for (const key in agenda) {
            if (Object.hasOwnProperty.call(useState['formAgendaCreate'], key)) {
                useState['formAgendaCreate'][key] = agenda[key]
                //const element = object[key];
            }
        }
        //console.log(agenda)
    let {cat_especialidad_id,centro_salud_id} = useState['formAgendaCreate']

        d.querySelector(`#centro_salud_id`).value=centro_salud_id
        d.querySelector(`#cat_especialidad_id`).value=cat_especialidad_id


    let meses = useState['formAgendaCreate']['agenda_month']
    //let mesObject
    let semanas
        meses.forEach((mes,mes_number)=>{
            d.querySelector(`.agenda_month[value='${mes_number}']`).checked=true
            semanas = mes['weeks']
            for (const semana in semanas) {
                d.querySelectorAll(`.month_semana_${mes['name']+semana}`).forEach(sem=>{
                    sem.checked=true
                })

                //console.log(key)

            }
            dias_nombres.forEach((dia,key)=>{
                if (!useState['formAgendaCreate']['dias_excluidos'].includes(dia)) {
                    d.querySelector(`#agenda_day_week_${key}`).checked=true

                }
            })

        })
        //console.log(agenda);
        $('a[href="#pills-crear-agenda"]').tab('show')
        //configMesObject()
} */
export let getDatesOfWeekWithHours = (weekNumber, year, dayOfWeek, hour)=> {
    // Obtenemos la fecha del primer día del año
    const firstDayOfYear = new Date(year, 0, 1);
    // Calculamos el número de milisegundos desde el primer día del año hasta el primer día de la semana actual
    const pastDaysOfYear = (weekNumber - 1) * 7;
    // Añadimos los milisegundos al primer día del año para obtener el primer día de la semana especificada
    const firstDayOfWeek = new Date(firstDayOfYear.getTime() + (pastDaysOfYear * 24 * 60 * 60 * 1000));

    // Calculamos el número de días hasta el día de la semana especificado
    const pastDaysOfWeek = (dayOfWeek - firstDayOfWeek.getUTCDay() + 7) % 7;
    // Obtenemos la fecha del día de la semana especificado sumando los días al primer día de la semana
    const dateOfWeek = new Date(firstDayOfWeek.getTime() + (pastDaysOfWeek * 24 * 60 * 60 * 1000));

    // Creamos un array para guardar las fechas con las horas especificadas
    //const datesWithHours = [];
    // Recorremos el arreglo de horas
    //for (const hour of hours) {
    // Separamos la hora y los minutos
    const [hourStr, minuteStr] = hour['hora'].split(":");
    // Convertimos las horas y minutos a números
    const hourNum = parseInt(hourStr, 10);
    const minuteNum = parseInt(minuteStr, 10);
    // Creamos una fecha con la fecha y hora especificadas
    const dateWithHour = new Date(dateOfWeek.getFullYear(), dateOfWeek.getMonth(), dateOfWeek.getDate(), hourNum, minuteNum);
    // Añadimos la fecha con la hora especificada al array de fechas con horas
    //datesWithHours.push(dateWithHour);
    //}

    // Devolvemos el array de fechas con horas
    return {"day":local_timestamps2(dateWithHour),"visibilidad":hour['visibilidad']};
    //return datesWithHours;
}
export let mis_agendas = async ()=>{
    let $form = d.querySelector(`#App`)
    $('a[href="#pills-index-agenda').tab('show')
    d.querySelector(".overlay").classList.remove("d-none")
    useState['formAgendaCreate']['agenda_registradas'] = await get(location.origin+`/consultaexterna/user/medico/agenda/show/${useState['formAgendaCreate']['user_id_medico']}`)
    d.querySelector(".overlay").classList.add("d-none")

    $form.querySelector("#mis_agendas").innerHTML=null

    if(!is_empty(useState['formAgendaCreate']['agenda_registradas'])){
        //Consulta de agendas guardadas
        //console.log("agendas registradas: ",useState['formAgendaCreate']['agenda_registradas'])
        let agendas = useState['formAgendaCreate']['agenda_registradas'].filter(misAgendas=>
                equalsInt(misAgendas['centro_salud_id'],$form.querySelector("#centro_salud_id").value) &&
                equalsInt(misAgendas['cat_especialidad_id'],$form.querySelector("#cat_especialidad_id").value)
            );

            console.log("agendas registradas: ",agendas)
            if(!is_empty(agendas)){

                agendas.forEach(misAgendas=>{

                    d.querySelector('#datepicker').innerHTML=null

                    let agenda = JSON.parse(misAgendas['agenda'])

                    if (agenda.hasOwnProperty("agenda_month")) {

                        d.querySelector('#datepicker').dataset['agenda_id'] = misAgendas['agenda_id']
                        let dias = []
                            for (const mes in agenda['agenda_month']) {
                                for (const semana in agenda['agenda_month'][mes]['weeks']) {
                                    for (let dia in agenda['agenda_month'][mes]['weeks'][semana]) {
                                        dia = agenda['agenda_month'][mes]['weeks'][semana][dia]
                                        let temp = JSON.stringify({
                                                    "dia_nombre":dia['day'],
                                                    "turno":dia['turno']
                                                })
                                            if (!dias.includes(temp)) {
                                                dias.push(temp)
                                            }

                                    }
                                }
                            }
                            console.log(dias);
                        let turno = []
                            dias.forEach(diaJSON=>{
                                let diaObject = JSON.parse(diaJSON)
                                let colorTurno = "dia"

                                    if (diaObject['turno']['horario'] == "Tarde") {
                                        colorTurno = "tarde"
                                    }
                                    if (diaObject['turno']['horario'] == "Todo el dia") {
                                        colorTurno = "todo-el-dia"
                                    }
                                    turno +=`
                                        <div class="col-6 col-sm-6 col-lg-4">
                                            <div class="dia-horario dia-horario-${colorTurno}">
                                                <b>
                                                    ${diaObject['dia_nombre'].toUpperCase()}
                                                </b>
                                                <div class="d-flex text-nowrap">
                                                    <div class="text-center" style="width: 10px">
                                                        <b title="Inicio" class="text-success">I</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                        ${diaObject['turno']['I']}
                                                    </div>
                                                </div>
                                                <div class="d-flex text-nowrap">
                                                    <div class=" text-center" style="width: 10px">
                                                        <b title="Fín" class="text-info">F</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                        ${diaObject['turno']['F']}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    `
                            })
                            $form.querySelector("#mis_agendas").insertAdjacentHTML("beforeend", `
                                <div id="agenda_row_${misAgendas['agenda_id']}" data-agenda_id="${misAgendas['agenda_id']}" class="agenda-row row mb-1 py-1 mes-hover cursor-pointer">
                                    <div class="col-9">
                                        <img onerror="reemplaza_imagen(this)" src="${misAgendas['especialidad_imagen']}"
                                            style="height: 1.5rem;width:1.5rem;">
                                        <b>${misAgendas['cat_especialidad_description']}</b>
                                    </div>
                                    <div class="col-3 text-right">
                                        <!--<button data-agenda_id="${misAgendas['agenda_id']}" data-user_id_medico="${useState['formAgendaCreate']['user_id_medico']}" class="agenda-edit btn btn-default"><i data-agenda_id="${misAgendas['agenda_id']}" class="agenda-edit fa fa-edit text-primary"></i></button>-->
                                        <button data-agenda_id="${misAgendas['agenda_id']}" data-user_id_medico="${useState['formAgendaCreate']['user_id_medico']}" class="agenda-destroy btn btn-default">
                                            <i data-agenda_id="${misAgendas['agenda_id']}" data-user_id_medico="${useState['formAgendaCreate']['user_id_medico']}" class="agenda-destroy fa fa-trash text-primary"></i>
                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <b class="p-0 text-secondary text-nowrap" style="font-size:0.8rem;">
                                            ${misAgendas['centro_salud_description']}
                                        </b>
                                    </div>
                                    ${turno}

                                </div>
                            `)


                            for (const key in agenda) {
                                if (Object.hasOwnProperty.call(useState['formAgendaCreate'], key)) {
                                    useState['formAgendaCreate'][key] = agenda[key]
                                    //const element = object[key];
                                }
                            }
                            handle_resultset()
                            activarCalendario()
                            handle_datepiker()
                           //configMesObject()
                    }else{
                        d.querySelector('#datepicker').innerHTML=`
                            <div class="row">
                                <div class="col-12 text-center text-secondary">
                                    No posee agenda de citas
                                </div>
                            </div>
                        `
                        $form.querySelector("#mis_agendas").innerHTML=`
                            <div class="row">
                                <div class="col-12 text-center text-secondary">
                                    No posees agendas
                                </div>
                            </div>
                        `
                    }

                })
            }else{
                $form.querySelector("#mis_agendas").innerHTML=`
                    <div class="row">
                        <div class="col-12 text-center text-secondary">
                            No posees agendas
                        </div>
                    </div>
                `
            }
    }
}
export let horas_generate = (turno,total_pacientes_por_horas,visibilidad,horas_privadas=[]) => {
    let horas = []
    let horaMilisegundo = 3600000
    let hoy = new Date()
    let inicio
    let fin
    let maxHora
        if (turno === "Mañana") {
            inicio = new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 8, 0, 0)
            maxHora = (new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 11, 0, 0)).getTime()
            fin = new Date(inicio.getTime() + (horaMilisegundo * 4))
        }
        if (turno === "Tarde") {
            inicio = new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 13, 0, 0)
            maxHora = (new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 16, 0, 0)).getTime()
            fin = new Date(inicio.getTime() + (horaMilisegundo * 4))
        }
        if (turno === "Todo el dia") {
            inicio = new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 8, 0, 0)
            maxHora = (new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 16, 0, 0)).getTime()
            fin = new Date(inicio.getTime() + (horaMilisegundo * 9))
        }
    let keyArray = 0
    let index = inicio.getTime();
    let tarde = false;
    let temp_visibilidad = "publica"
        while (index < fin.getTime()) {

            if (
                index > (new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 11, 0, 0)).getTime() &&
                index < (new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 13, 0, 0)).getTime()
            ) {
                index = index + horaMilisegundo
            } else {
                if (index >= (new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 13, 0, 0)).getTime() && !tarde) {
                    tarde = true
                    index = (new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 13, 0, 0)).getTime()
                }
                if (visibilidad === "todo_el_dia_privado") {
                    temp_visibilidad = "privada"
                }
                if (visibilidad === "manana_publica_tarde_privada") {
                    if (index <= (new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 11, 0, 0)).getTime()) {
                        temp_visibilidad = "publica"
                    } else {
                        temp_visibilidad = "privada"
                    }
                }
                if (visibilidad === "tarde_publica_manana_privada") {
                    if (index >= (new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 13, 0, 0)).getTime()) {
                        temp_visibilidad = "publica"
                    } else {
                        temp_visibilidad = "privada"
                    }
                }

                let evaluate = index <= maxHora
                if (["Tarde","Todo el dia"].includes(turno)) {
                    evaluate = index < maxHora
                }
                if (evaluate) {
                    let fecha = new Date(index)
                    let hora = String(fecha.getHours()).padStart(2, '0')+":"+String(fecha.getMinutes()).padStart(2, '0')

                        if ( horas_privadas.includes(hora) ) {
                            horas.push({
                                turno,
                                hora,
                                "visibilidad": "privada",
                            })
                        }else{
                            horas.push({
                                turno,
                                hora,
                                "visibilidad": temp_visibilidad,
                            })
                        }


                }

                index = index + (horaMilisegundo / total_pacientes_por_horas)
                keyArray++
            }
        }


        return horas
}
export let getWeek = (date) => {
    var d = new Date(Date.UTC(date.getFullYear(), date.getMonth(), date.getDate()));
    var dayNum = d.getUTCDay() || 7;
    d.setUTCDate(d.getUTCDate() + 4 - dayNum);
    var yearStart = new Date(Date.UTC(d.getUTCFullYear(), 0, 1));
    return Math.ceil((((d - yearStart) / 86400000) + 1) / 7)
};
export let local_timestamps2=(date) =>{
    var hoy = new Date(date);
    return hoy.getFullYear() + "-" + String(hoy.getMonth() + 1).padStart(2, '0') + "-" + String(hoy.getDate()).padStart(2, '0') + " " +  String(hoy.getHours()).padStart(2, '0')+":"+String(hoy.getMinutes()).padStart(2, '0')
}
export let getWeeksInMonth = (month) => {
  let weeks = [];
  let f = new Date()
  let firstDayOfMonth = new Date(f.getFullYear(), month, 1);
  let lastDayOfMonth = new Date(f.getFullYear(), month + 1, 0);
  let numberOfDays = lastDayOfMonth.getDate();

  let firstDayOfWeek = firstDayOfMonth.getDate() - firstDayOfMonth.getDay();
  let lastDayOfWeek = firstDayOfWeek + 6;

  while (lastDayOfWeek < numberOfDays) {
      weeks.push(getWeek(new Date(f.getFullYear(), month, lastDayOfWeek)));
      firstDayOfWeek += 7;
      lastDayOfWeek += 7;
  }
  if (lastDayOfWeek > 31) {
      lastDayOfWeek = 31;
  }
  weeks.push(getWeek(new Date(f.getFullYear(), month, lastDayOfWeek)));

  return weeks;
}
export let week_remove = (mes_number,week_to_remove)=>{
    useState['formAgendaCreate'][ "agenda_month" ].forEach((mes,mes_key)=>{
      if(Number(mes_number)===Number(mes['number']) ){
        let weeks_disponibles=[]
        for(let week_number in mes["weeks"]){
          if(Number(week_number) !== Number(week_to_remove)){
            weeks_disponibles[week_number] = mes["weeks"][week_number]
          }else{
            useState['formAgendaCreate'][ "semanas_excluidos" ].push(Number(week_to_remove))
          }
        }
        useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"] = null
        useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"] = weeks_disponibles
      }
    })
}
export let week_add = (mes_number,week_to_add)=>{
    //console.log("week_to_add",week_to_add)
            //AÑADIMOS LAS SEMANAS
            //let weeks_numbers = getWeeksInMonth(mes_number)
    useState['formAgendaCreate'][ "semanas_excluidos" ] = useState['formAgendaCreate'][ "semanas_excluidos" ].filter(semana=> Number(semana) !== Number(week_to_add) )
    let mes_index = useState['formAgendaCreate'][ "agenda_month" ].findIndex(mes=>equalsInt(mes_number,mes['number']))
        useState['formAgendaCreate'][ "agenda_month" ][mes_index]['weeks'][week_to_add] =[]


    let checked = d.querySelectorAll(`.agenda-dia:checked`)
    console.log("dias",checked.length)
        if (checked.length === 0) {
            useState['formAgendaCreate'][ "dias_excluidos" ] =["Sábado","Domingo"]
            let turno = []
                for(let key in useState['formAgendaCreate'][ "turno" ]){
                    if (!useState['formAgendaCreate'][ "dias_excluidos" ].includes(useState['formAgendaCreate'][ "turno" ][key]["day"])) {
                        turno.push(useState['formAgendaCreate'][ "turno" ][key])
                    }
                }
                d.querySelectorAll(`.agenda-dia`).forEach(dia=>{
                    let {dia_name,dia_number} = dia.dataset
                        if (!useState['formAgendaCreate'][ "dias_excluidos" ].includes(dia_name)) {
                            dia.checked = true
                            d.querySelector(`.horas-dia-${dia_number}`).checked = true
                        }
                })
                for(let key in  useState['formAgendaCreate'][ "agenda_month" ][mes_index]['weeks']){
                    useState['formAgendaCreate'][ "agenda_month" ][mes_index]['weeks'][key] = turno
                }
        }else{
            let turno = []
                for(let key in useState['formAgendaCreate'][ "turno" ]){
                    if (!useState['formAgendaCreate'][ "dias_excluidos" ].includes(useState['formAgendaCreate'][ "turno" ][key]["day"])) {
                        turno.push(useState['formAgendaCreate'][ "turno" ][key])
                    }
                }
                for(let key2 in  useState['formAgendaCreate'][ "agenda_month" ][mes_index]['weeks']){
                    //console.log("semana->",key2)
                    useState['formAgendaCreate'][ "agenda_month" ][mes_index]['weeks'][key2] = turno
                }
        }


    console.log(useState['formAgendaCreate'])
}
export let day_turno_update = (day_to_update=[],turno,total_pacientes_por_horas=1,horas,visibilidad)=>{
   // console.log(horas)
    useState['formAgendaCreate'][ "agenda_month" ].forEach((mes,mes_key)=>{
      for(let week_number in mes["weeks"]){
        for(let day_key in mes["weeks"][week_number]){
         /*  let horas = horas_generate(
              turno,
              total_pacientes_por_horas,
              turno
            ) */
            for(let day_hour in useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number]){
              let {day} = useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][day_hour]
                if( day_to_update.includes(day) ){
                  useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][day_hour]['turno_name'] = turno
                  useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][day_hour]['visibilidad'] = visibilidad
                  useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][day_hour]['total_pacientes_por_horas'] = total_pacientes_por_horas
                  useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][day_hour]['hours'] = horas
                  useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][day_hour]["turno"]={
                    "horario":turno,
                    "I": horaAMPM(first(horas)['hora']),
                    "F": horaAMPM(last(horas)['hora']),
                  }
                }

                //console.log(useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][day_hour])
            }
        }
      }
    })
}
export let day_turno_hour_visibility_update = (day_week,hour,visibility)=>{
    useState['formAgendaCreate'][ "turno" ][day_week]['hours'].forEach((h,h_key)=>{
        if( h['hora'] === hour ){
            console.log(useState['formAgendaCreate'][ "turno" ][day_week]['hours'][h_key])
            useState['formAgendaCreate'][ "turno" ][day_week]['hours'][h_key]['visibilidad'] = visibility
            console.log(useState['formAgendaCreate'][ "turno" ][day_week]['hours'][h_key])
        }
    })
    useState['formAgendaCreate'][ "agenda_month" ].forEach((mes,mes_key)=>{
      for(let week_number in mes["weeks"]){
        for(let day_key in mes["weeks"][week_number]){

            for(let day_hour in useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number]){
              let {day_value} = useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][day_hour]

                if( Number(day_value) === Number(day_week) ){
                  let key = useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][day_hour]['hours'].findIndex(hora=>hora['hora']===hour)
                    useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][day_hour]['hours'][key]['visibilidad'] = visibility


                }


            }
        }
      }
    })
}
export let day_remove = (day_to_remove)=>{
    useState['formAgendaCreate'][ "agenda_month" ].forEach((mes,mes_key)=>{
      for(let week_number in mes["weeks"]){
        let days_disponibles=[]
        for(let day_key in mes["weeks"][week_number]){

          //console.log(mes["weeks"][week_number][day_key])
          if(Number(mes["weeks"][week_number][day_key]['day_value'])!==Number(day_to_remove)){
            days_disponibles.push(mes["weeks"][week_number][day_key])
          }else{
            let day_exist = useState['formAgendaCreate'][ "dias_excluidos" ].some(day=>day===mes["weeks"][week_number][day_key]['day'])
            if(!day_exist){
              useState['formAgendaCreate'][ "dias_excluidos" ].push( mes["weeks"][week_number][day_key]['day'] )
            }
          }

        }
        useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number] = null
        useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number] = days_disponibles

      }
    })
    console.log(useState['formAgendaCreate'])
}
export let day_add = (day_to_add)=>{
    useState['formAgendaCreate'][ "agenda_month" ].forEach((mes,mes_key)=>{
        for(let week_number in mes["weeks"]){
          //console.log(mes["weeks"][week_number])
            if (!is_empty( mes["weeks"][week_number] )) {
                let day_exist = Array.from(mes["weeks"][week_number]).some(d=>Number(d['day_value'])===Number(day_to_add) )

                    if(!day_exist){
                        let total = Object.keys(useState['formAgendaCreate'][ "agenda_month" ][ mes_key ]["weeks"][ week_number ]).length

                        useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][total] = useState['formAgendaCreate'][ "turno" ][day_to_add]
                    }
            }else{
                useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number].push(useState['formAgendaCreate'][ "turno" ][day_to_add])
            }



        }
    })
      useState['formAgendaCreate'][ "dias_excluidos" ] = useState['formAgendaCreate'][ "dias_excluidos" ].filter(day_excluded=>day_excluded!==dias_nombres[day_to_add])

      console.log(useState['formAgendaCreate'])
}
export let mes_remove = (mes_to_remove)=>{

  let mes_exist = useState['formAgendaCreate'][ "agenda_month" ].some(mes=>mes['name']===mes_to_remove)

    if(mes_exist){
      useState['formAgendaCreate'][ "meses_excluidos" ].push(mes_to_remove)
      let meses_disponibles=[]
      for( let key in useState['formAgendaCreate'][ "agenda_month" ] ){
        if(mes_to_remove !== useState['formAgendaCreate'][ "agenda_month" ][key]['name']){
          meses_disponibles.push(useState['formAgendaCreate'][ "agenda_month" ][key])
        }
      }
      useState['formAgendaCreate'][ "agenda_month" ] = meses_disponibles
    }

}
export let mes_add = (mes_to_add)=>{

  let mes_exist = useState['formAgendaCreate'][ "agenda_month" ].some(mes=>mes['name']===mes_to_add)

    if(!mes_exist){
        //ELIMINAR DE LOS MESES EXCLUIDOS EL MES QUE QUEREMOS INCLUIR
        useState['formAgendaCreate'][ "meses_excluidos" ] = useState['formAgendaCreate'][ "meses_excluidos" ].filter(mes=> mes !==mes_to_add)

        //AÑADIMOS EL MES
        let mes_number = mesesEnEspanol.findIndex(mes=>mes===mes_to_add)
            useState['formAgendaCreate'][ "agenda_month" ].push({
                "number":mes_number,
                "name": mes_to_add,
                "weeks": {},
            })
            //SI NO HAY SEMANAS ACTIVAS, ACTIVARLAS TODAS
        let mes_index = useState['formAgendaCreate'][ "agenda_month" ].findIndex(mes=>equalsInt(mes_number,mes['number']))
        let checked = d.querySelectorAll(`.mes-${mes_number}:checked`)
            console.log(checked.length)
            if (checked.length === 0) {
                d.querySelectorAll(`.mes-${mes_number}`).forEach(semana=>{
                    semana.checked = true
                    let {semana_number} = semana.dataset
                        useState['formAgendaCreate'][ "semanas_excluidos" ] = useState['formAgendaCreate'][ "semanas_excluidos" ].filter(semana=> Number(semana) !== Number(semana_number) )

                        useState['formAgendaCreate'][ "agenda_month" ][mes_index]['weeks'][semana_number] =[]
                })
                let checked = d.querySelectorAll(`.agenda-dia:checked`)
                    if (checked.length === 0) {
                        useState['formAgendaCreate'][ "dias_excluidos" ] =["Sábado","Domingo"]
                        let turno = []
                            for(let key in useState['formAgendaCreate'][ "turno" ]){
                                if (!useState['formAgendaCreate'][ "dias_excluidos" ].includes(useState['formAgendaCreate'][ "turno" ][key]["day"])) {
                                    turno.push(useState['formAgendaCreate'][ "turno" ][key])
                                }
                            }
                            d.querySelectorAll(`.agenda-dia`).forEach(dia=>{
                                let {dia_name,dia_number} = dia.dataset
                                    if (!useState['formAgendaCreate'][ "dias_excluidos" ].includes(dia_name)) {
                                        dia.checked = true
                                        d.querySelector(`.horas-dia-${dia_number}`).checked = true
                                    }
                            })
                            for(let key in  useState['formAgendaCreate'][ "agenda_month" ][mes_index]['weeks']){
                                useState['formAgendaCreate'][ "agenda_month" ][mes_index]['weeks'][key] = turno
                            }
                    }else{
                        let turno = []
                            for(let key in useState['formAgendaCreate'][ "turno" ]){
                                if (!useState['formAgendaCreate'][ "dias_excluidos" ].includes(useState['formAgendaCreate'][ "turno" ][key]["day"])) {
                                    turno.push(useState['formAgendaCreate'][ "turno" ][key])
                                }
                            }
                            for(let key2 in  useState['formAgendaCreate'][ "agenda_month" ][mes_index]['weeks']){
                                //console.log("semana->",key2)
                                useState['formAgendaCreate'][ "agenda_month" ][mes_index]['weeks'][key2] = turno
                            }
                    }
            }
            console.log(useState['formAgendaCreate'])
    }

}
export let turno_horas_update = (day_key,turno,total_pacientes_por_horas,tipo_turnos)=>{
    console.log("turno_horas_update() ",day_key,turno,total_pacientes_por_horas,tipo_turnos)
  let horas = horas_generate(
                turno,
                total_pacientes_por_horas,
                tipo_turnos
              )
              console.log({horas})
      useState['formAgendaCreate'][ "turno" ][day_key]["hours"] = horas
      useState['formAgendaCreate'][ "turno" ][day_key]["turno"]={
        "horario":turno,
        "I": horaAMPM(first(horas)['hora']),
        "F": horaAMPM(last(horas)['hora']),
      }
}
export let semana_init = (mes_number)=>{
    //useState['formAgendaCreate'][ "semanas_excluidos" ] = []
    let weeks_numbers = getWeeksInMonth(mes_number)
    let turno = []
        for(let key in useState['formAgendaCreate'][ "turno" ]){
            if (!["Sábado","Domingo"].includes(useState['formAgendaCreate'][ "turno" ][key]["day"])) {
                turno.push(useState['formAgendaCreate'][ "turno" ][key])
            }
        }
        weeks_numbers.forEach(week_number=>{
            useState['formAgendaCreate'][ "agenda_month" ][ mes_number ]["weeks"][ week_number ] = turno
        })
}
export let handle_agenda_month = (e)=>{
    let {mes_number,mes_name} = e.target.dataset
    let checkActive = d.querySelector(`input[name='agenda_month_${mes_number}']`).checked

    if(checkActive){
        mes_add(mes_name)
    }else{
        mes_remove(mes_name)
    }
    d.querySelectorAll(`.mes-${mes_number}`).forEach(mes=>{
        mes.checked = checkActive
    })
    handle_resultset()
    console.log(useState['formAgendaCreate'])
}
export let handle_agenda_semana = (e)=>{
    let {mes_number,mes_name,num_seman_mes,semana_number} = e.target.dataset
    let checkActive = d.querySelector(`input[name='agenda_month_${mes_number}']`)
        if(!checkActive.checked){
            checkActive.checked = true
            let mes_exist = useState['formAgendaCreate'][ "agenda_month" ].some(mes=>mes['name']===mes_number)
            if(!mes_exist){
                //ELIMINAR DE LOS MESES EXCLUIDOS EL MES QUE QUEREMOS INCLUIR
                useState['formAgendaCreate'][ "meses_excluidos" ] = useState['formAgendaCreate'][ "meses_excluidos" ].filter(mes=> mes !==mes_number)
                //AÑADIMOS EL MES
                //let mes_number = meses.findIndex(mes=>mes===mes_to_add)
                    useState['formAgendaCreate'][ "agenda_month" ].push({
                        "number":mes_number,
                        "name": mes_name,
                        "weeks": {},
                    })
            }
            console.log("Se Activó el mes de "+ mes_name)
        }
    let checkActive2 = d.querySelector(`#month_semana_${mes_number}_${num_seman_mes}`)
        console.log("checkActive",checkActive2.checked)
        if(checkActive2.checked){
            week_add(mes_number,semana_number)
        }else{
            week_remove(mes_number,semana_number)
        }
        //handle_resultset()
        console.log(useState['formAgendaCreate'])
}
export let handle_agenda_dia = (e)=>{
    let {dia_name,dia_number} = e.target.dataset
    let checkActive = d.querySelector(`#agenda_day_week_${dia_number}`).checked

    if(checkActive){
        day_add(dia_number)
        d.querySelector(`.horas-dia-${dia_number}`).checked = checkActive
    }else{
        day_remove(dia_number)
        d.querySelectorAll(`.horas-dia-${dia_number}`).forEach(mes=>{
            mes.checked = checkActive
        })
    }
    handle_resultset()
    console.log(useState['formAgendaCreate'])
}
export let handle_agenda_turno = (e)=>{
    let {
            dia_name,
            turno,
            dia_number
        } = e.target.dataset
        console.log(turno)
    let checkActive = d.querySelector(`#agenda_day_week_${dia_number}`).checked
        if(!checkActive){
            d.querySelector(`#agenda_day_week_${dia_number}`).checked =true
            handle_agenda_dia(e)
        }



        useState['formAgendaCreate']['turno'][dia_number]['total_pacientes_por_horas'] = 1
        useState['formAgendaCreate']['turno'][dia_number]['turno_name'] = turno
        useState['formAgendaCreate']['turno'][dia_number]['visibilidad'] = "todo_el_dia_publico"
        useState['formAgendaCreate']['turno'][dia_number]['hours'] = horas_generate(turno,1,"todo_el_dia_publico")
        container_horas(dia_number,dia_name)
        handle_resultset()
        console.log(useState['formAgendaCreate'])
}
export let handle_configurar_horas = (e)=>{

    let {dia_name,turno,dia_number} = e.target.dataset
    let checkboxes = document.querySelectorAll(`.horas-dia-${dia_number}`);
        for (const checkbox of checkboxes) {
            let temp_turno = checkbox.dataset['turno']
            if (temp_turno === turno) {
                checkbox.checked = true
            }
        }
        d.querySelector(`#agenda_day_week_${dia_number}`).checked =true
    let {visibilidad,total_pacientes_por_horas,hours} = useState['formAgendaCreate']["turno"][dia_number]
    //console.log("horas_privadas",hours.filter(hour=>hour['visibilidad']==="privada").map(hour=>hour['hora']))
    let horas_privadas = hours.filter(hour=>hour['visibilidad']==="privada").map(hour=>hour['hora'])
        useState['formAgendaCreate']['turno'][dia_number]['total_pacientes_por_horas'] = total_pacientes_por_horas
        useState['formAgendaCreate']['turno'][dia_number]['visibilidad'] = horas_privadas.length > 0 ? 'personalizado':visibilidad
        useState['formAgendaCreate']['turno'][dia_number]['hours'] = horas_generate(turno,total_pacientes_por_horas,visibilidad,horas_privadas)

        container_horas(dia_number,dia_name)

        $("#modelId").modal("show")
    let $modal = d.querySelector("#modelId")
        $modal.querySelector(".modal-title").textContent = `Configuración del dia ${dia_name} (${turno})`
        $modal.querySelector("select[name='visibilidad']").value = visibilidad
        $modal.querySelector("select[name='visibilidad']").dataset['dia_name'] = dia_name
        $modal.querySelector("select[name='visibilidad']").dataset['dia_number'] = dia_number
        $modal.querySelector("select[name='visibilidad']").dataset['turno'] = turno

        $modal.querySelector("select[name='pacientes_por_horas']").value = total_pacientes_por_horas
        $modal.querySelector("select[name='pacientes_por_horas']").dataset['dia_name'] = dia_name
        $modal.querySelector("select[name='pacientes_por_horas']").dataset['dia_number'] = dia_number
        $modal.querySelector("select[name='pacientes_por_horas']").dataset['turno'] = turno

        handle_resultset()
        console.log(useState['formAgendaCreate'])
}
export let handle_agenda_dia_horario = (e)=>{

    let {dia_name,turno,dia_number,hora,visibilidad} = e.target.dataset
        if(visibilidad==="privada"){
            d.querySelector("#visibilidad").value ="personalizado"
        }
        day_turno_hour_visibility_update(dia_number,hora,visibilidad)
        handle_resultset()
        console.log(useState['formAgendaCreate'])
}
export let reset_form_agenda_create = (e)=>{
    useState['formAgendaCreate']['agenda_desde'] = null
    useState['formAgendaCreate']['agenda_hasta'] = null
    useState['formAgendaCreate']['agenda'] = null
    useState['formAgendaCreate']['agenda_month'] = []
    useState['formAgendaCreate']['meses_excluidos'] = mesesEnEspanol
    useState['formAgendaCreate']['dias_excluidos']= dias_nombres
    useState['formAgendaCreate']['semanas_excluidos'] = []
    for (let semana_number = 1; semana_number <= 52; semana_number++) {
        useState['formAgendaCreate']['semanas_excluidos'].push(semana_number)
    }
    for (let index = 0; index <= 11; index++) {
        d.querySelector(`input[name='agenda_month_${index}']`).checked = false
        d.querySelectorAll(`.mes-${index}`).forEach(semana => {
            semana.checked = false
        })
    }
    for (let index = 1; index <= 6; index++) {
        d.querySelector(`input[name='month_semana_${index}']`).checked = false
    }
    d.querySelectorAll(`.agenda-dia`).forEach($check=>{
        $check.checked = false
    })
    d.querySelectorAll(`.agenda_turno`).forEach($radio=>{
        $radio.checked = false
    })
    d.querySelector("#agenda_desde").value=""
    d.querySelector("#agenda_hasta").value=""
}
export let handle_todo_el_anio = (checked) =>{
    //console.log(checked)
    if (checked) {
        entById("container_dias").innerHTML=null

        useState['formAgendaCreate']['meses_excluidos'] = []
        useState['formAgendaCreate']['dias_excluidos']= ["Sábado","Domingo"]
        useState['formAgendaCreate']['semanas_excluidos'] = []
        turno_init()
        mes_init()
        container_meses()
        container_dias()
        handle_resultset()


    } else {
        reset_form_agenda_create()
    }
    //handle_resultset()
    //configMesObject()
    console.log(useState['formAgendaCreate'])
}
export let handle_todos_los_dias = (e)=>{
    //console.log(is_empty(useState['formAgendaCreate']['agenda_month']))
    if(is_empty(useState['formAgendaCreate']['agenda_month'])){
        d.querySelector(`#todo_el_anio`).checked = true
        handle_todo_el_anio( true )
    }
    console.log(e.target.checked)


    if (e.target.checked) {
        d.querySelectorAll(`.agenda-dia`).forEach(dia => {
            dia.checked = true
            let {dia_name,dia_number} = dia.dataset
            day_add(dia_number)
        })
        d.querySelectorAll(`.agenda_turno`).forEach(turno => {
            if (turno.dataset['turno'] === "Mañana") {
                turno.checked = true
            }
        })
    } else {
        d.querySelectorAll(`.agenda-dia`).forEach(dia => {
            dia.checked = false
            let {dia_name,dia_number} = dia.dataset
            day_remove(dia_number)
        })
        d.querySelectorAll(`.agenda_turno`).forEach(turno => {
            turno.checked = false
        })


    }
    handle_resultset()
    console.log(useState['formAgendaCreate'])
}
export let handle_switch_semana = (e)=>{

    let num_seman_mes= e.target.value
    if (e.target.checked) {

        let $inputs= d.querySelectorAll(`.num-seman-mes-${num_seman_mes}`)
            $inputs.forEach($input=>{
                $input.checked=true
                let {mes_number,mes_name,semana_number} = $input.dataset
                week_remove(mes_number,semana_number)
            })
    } else {

        //let semana_n = d.querySelector(`input[name='month_semana_${num_seman_mes}']`).value
        let $inputs= d.querySelectorAll(`.num-seman-mes-${num_seman_mes}`)
            $inputs.forEach($input=>{
                $input.checked=false
                let {mes_number,mes_name,semana_number} = $input.dataset
                week_remove(mes_number,semana_number)
            })

    }
    //configMesObject()
    console.log(useState['formAgendaCreate'])
}
export let container_horas = (dia_number,dia_name)=>{

    let {total_pacientes_por_horas,turno_name,visibilidad,hours} = useState['formAgendaCreate']["turno"][dia_number]
        //console.log("hours",hours)
    let container_horas = d.querySelector("#modelId #container_horas")
        container_horas.innerHTML = null;

    let template = (data,hora_key,dia_name,day_number) => {

            let { hora, visibilidad,turno } = data
            let fecha = new Date();
                fecha = new Date( fecha.getFullYear+"-"+fecha.getMonth()+"-"+fecha.getDate()+" "+hora )

            console.log(visibilidad)
            return  `
            <div class="col-6 col-sm-6 col-lg-4">
                <div
                    class="dia-horario d-flex justify-content-between align-items-center ${(fecha.getHours() >= 13) ? 'hora-tarde dia-horario-tarde' : 'hora-dia dia-horario-dia'}">
                    <h6 class="m-0 pl-2">
                        ${horaAMPM(fecha.getHours() + ":" + String(fecha.getMinutes()).padStart(2, "0"))}
                    </h6>
                    <div class="d-flex flex-column text-nowrap">
                        <div class="text-right" title="Pública">
                            <label
                                class="cursor-pointer m-0"
                                for="hora_${hora_key}_publica"
                            >
                                <i
                                    data-visibilidad="publica"
                                    data-dia_name="${dia_name}"
                                    data-hora_key="${hora_key}"
                                    data-hora="${String(fecha.getHours()).padStart(2, "0") + ":" + String(fecha.getMinutes()).padStart(2, "0")}"
                                    data-turno="${turno}"
                                    data-dia_number="${dia_number}"
                                    class="dia-horario fas fa-lock-open cursor-pointer hora-${turno}"
                                    style="color:#a4c9a4"
                                ></i>
                            </label>
                            <input
                                id="hora_${hora_key}_publica"
                                type="radio"
                                data-visibilidad="publica"
                                data-dia_name="${dia_name}"
                                data-hora_key="${hora_key}"
                                data-hora="${String(fecha.getHours()).padStart(2, "0") + ":" + String(fecha.getMinutes()).padStart(2, "0")}"
                                data-turno="${turno}"
                                data-dia_number="${dia_number}"
                                class="dia-horario cursor-pointer"
                                ${visibilidad === "publica" ? 'checked' : ''}
                                value="publica"
                                name="hora_${hora_key}"
                            >
                        </div>
                        <div class="text-right" title="Privada">
                            <label
                                class="cursor-pointer m-0"
                                for="hora_${hora_key}_privada"
                            >
                                <i
                                    data-visibilidad="privada"
                                    data-dia_name="${dia_name}"
                                    data-hora_key="${hora_key}"
                                    data-hora="${String(fecha.getHours()).padStart(2, "0") + ":" + String(fecha.getMinutes()).padStart(2, "0")}"
                                    data-turno="${turno}"
                                    data-dia_number="${dia_number}"
                                    class="dia-horario fas fa-lock cursor-pointer hora-${turno}"
                                    style="color:#957878"
                                ></i>
                            </label>
                            <input
                                id="hora_${hora_key}_privada"
                                type="radio"
                                data-visibilidad="privada"
                                data-dia_name="${dia_name}"
                                data-hora_key="${hora_key}"
                                data-hora="${String(fecha.getHours()).padStart(2, "0") + ":" + String(fecha.getMinutes()).padStart(2, "0")}"
                                data-turno="${turno}"
                                data-dia_number="${dia_number}"
                                class="dia-horario cursor-pointer"
                                ${visibilidad === "privada" ? 'checked' : ''}
                                value="privada"
                                name="hora_${hora_key}"
                            >

                        </div>
                    </div>
                </div>
            </div>
        `;
        }


        hours.forEach( (hora,hora_key) => {
            container_horas.insertAdjacentHTML("beforeend", template(hora,hora_key,dia_name))
        })

        day_turno_update(
            [dia_name],
            turno_name,
            total_pacientes_por_horas,
            hours,
            visibilidad,
        )
}
export let mes_init = ()=>{
    useState['formAgendaCreate']['meses_excluidos'] = []
    useState['formAgendaCreate'][ "agenda_month" ] = []
    mesesEnEspanol.forEach( (mes,mes_number)=>{
        useState['formAgendaCreate'][ "agenda_month" ][mes_number] = {
            "number":mes_number,
            "name": mes,
            "weeks": {},
        }
        semana_init(mes_number)
    })
}
export let turno_init = ()=>{
    useState['formAgendaCreate'][ "dias_excluidos" ] = []
    useState['formAgendaCreate'][ "dias_excluidos" ].push("Domingo")
    useState['formAgendaCreate'][ "dias_excluidos" ].push("Sábado")
    dias_nombres.forEach( (day,day_key)=>{
        useState['formAgendaCreate'][ "turno" ][day_key] = {}
        useState['formAgendaCreate'][ "turno" ][day_key]["day"] = day
        useState['formAgendaCreate'][ "turno" ][day_key]["visibilidad"] = "todo_el_dia_publico"
        useState['formAgendaCreate'][ "turno" ][day_key]["day_value"] = day_key
        useState['formAgendaCreate'][ "turno" ][day_key]["turno_name"] = turnos[0]
        useState['formAgendaCreate'][ "turno" ][day_key]["total_pacientes_por_horas"] = 1
        useState['formAgendaCreate'][ "turno" ][day_key]["hours"] = null

        turno_horas_update(
            day_key,
            turnos[0],
            1,
            tipo_turnos[0]
        )

    })
}
export let handle_datepiker = ()=>{
    useState['datepicker'].on("changeDate", async function (e) {
        let fecha = new Date(e.date)
        //console.log(fecha.getFullYear(), fecha.getMonth(), fecha.getDate())
        //let hora = String(fecha.getHours()).padStart(2, "0")+":"+String(fecha.getMinutes()).padStart(2, "0")

        let data = {
                agenda_id          : Number(d.querySelector("#datepicker").dataset['agenda_id']),
                user_id_medico     : Number(useState['formAgendaCreate']['user_id_medico']),
                cat_especialidad_id: Number(useState['formAgendaCreate']['cat_especialidad_id']),
                centro_salud_id    : Number(useState['formAgendaCreate']['centro_salud_id']),
                year               : Number(fecha.getFullYear()),
                month              : String((fecha.getMonth()+1)).padStart(2, "0"),
                day                : String(fecha.getDate()).padStart(2, "0"),
                semana_number      : getWeek(fecha),
                dia_number         : fecha.getDay(),
            }
            let formData = new FormData()
                formData.append("data", JSON.stringify(data) )
                formData.append("_token",d.querySelector("#_token").value)
                d.querySelector(".overlay").classList.remove("d-none")
                data['citas_creadas'] = await post(location.origin+`/consultaexterna/user/medico/cita/getCitasByDay`,formData)
                console.log(data['citas_creadas'] )
                d.querySelector(".overlay").classList.add("d-none")

            d.querySelector(".fecha-hoy").textContent= `Citas del ${data['day']} de ${ meses( fecha.getMonth() ) } de ${fecha.getFullYear()}`
        let mes =  useState['formAgendaCreate']['agenda_month'].find(mes=>equalsInt(mes['number'],fecha.getMonth()))
            //console.log(mes);
        let semana = mes['weeks'][ data['semana_number'] ]
            //console.log(semana);
        let day = semana.find(dia=>equalsInt(dia['day_value'], data['dia_number']) )
            console.log(day);
        let hours = day['hours']
        let $horas = entById('listado_horas-calendario')
            $horas.innerHTML=null
            //console.log(hours)
        let $template_hora = ""
            hours.forEach(hour=>{
                let horaColor = "dia"
                    if (hour['turno']==="Tarde") {
                        horaColor = "tarde"
                    }
                    if (hour['turno']==="Todo el día") {
                        horaColor = "todo-el-dia"
                    }
                let card_paciente = (cita)=>{
                    if (!is_null(cita['telefono_movil'])) {
                        if (cita['telefono_movil'].charAt(0) === "+") {
                            cita['telefono_movil'] = cita['telefono_movil'].substring(1);
                        }
                    }
                    return /*html */`
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <img onerror="reemplaza_imagen(this)" loading="lazy" class="profile-user-img preconsulta-paciente-imagen img-fluid img-circle" src="${cita['imagen']}" style="width: 30px;height: 30px;object-fit: cover;" alt="User profile picture">
                                        </div>
                                        <h3 class="profile-username text-primary">${cita['paciente']}</h3>
                                        <i class="ml-auto mr-2 h5 text-${cita['cat_user_cita_status_id_color']}">${cita['cat_user_cita_status_description']}</i>
                                        <i class="h3 ${cita['cat_user_cita_status_id_icono']} text-${cita['cat_user_cita_status_id_color']}"></i>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class=" bg-white p-1"  style="border-radius: 10px;min-height: 112px;">
                                        <div class="p-1 text-left">
                                            <b class="text-secondary">Cédula:</b>
                                            <span class="float-right preconsulta-paciente-cedula">${cita['cedula']}</span>
                                        </div>
                                        <div class="p-1 text-left">
                                            <b class="text-secondary">Edad:</b>
                                            <span class="float-right preconsulta-paciente-edad">${cita['edad']} años</span>
                                        </div>
                                        <div class="p-1 text-left">
                                            <b class="text-secondary">Género:</b>
                                            <span class="float-right preconsulta-paciente-genero">${cita['genero'].toUpperCase()}</span>
                                        </div>
                                        <div class="p-1 text-left">
                                            <b class="text-secondary">Teléfono:</b>
                                            <a target="_blank" href="https://api.whatsapp.com/send?phone=${cita['telefono_movil']}" style="font-size: 0.7rem;padding: 0.1rem;" class="enlace-whatsapp btn btn-default btn-sm border-0 float-right preconsulta-paciente-telefono-movil">
                                                <i class="enlace-whatsapp fab fa-whatsapp text-success"></i> <span class="enlace-whatsapp">${cita['telefono_movil']}</span>
                                            </a>
                                        </div>
                                        <div class="p-1 text-left">
                                            <b class="text-secondary">Correo:</b>
                                            <span class="float-right text-wrap preconsulta-paciente-correo" style="text-overflow: ellipsis;overflow: hidden;width: 130px;">${cita['email_paciente']}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="text-left bg-white p-1" style="border-radius: 10px;min-height: 112px;">
                                        <b class="text-secondary">Motivo de consulta:</b>
                                        <p class="m-0 mt-2">${is_null(cita['cita_motivo']) ? '': cita['cita_motivo']}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `
                }
                let cita =  data['citas_creadas'].find(cita=>
                                cita['hour'] === hour['hora'] &&
                                cita['cat_especialidad_id'] === data['cat_especialidad_id'] &&
                                cita['centro_salud_id'] === data['centro_salud_id']
                            )
                    let paciente = "<div class='p-3'></div>"
                        if (!is_undefined(cita)) {
                            paciente = card_paciente(cita)
                        }
                $template_hora += /*html */ `
                    <div class="dia-horario dia-horario-${horaColor} d-flex align-items-center p-2">
                        <b class="text-nowrap">
                            ${horaAMPM(hour['hora'])} <i data-visibilidad="privada" class="${(hour['visibilidad']==="publica")?'d-none':''} dia-horario fas fa-lock" style="color:#957878"></i>
                        </b>

                        <div class="flex-grow-1  text-center p-1">
                            <!-- description -->
                            ${paciente}
                        </div>
                        <!--<div class="btn-group ${is_undefined(cita)?'d-none':''} ">
                            <button type="button" class="btn btn-default bg-transparent font-weight-bold border-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ⁞
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <button class="dropdown-item" type="button">Reprogramar</button>
                                <button class="dropdown-item" type="button">Cancelar</button>
                            </div>
                        </div>-->
                    </div>
                `
            })
            $horas.innerHTML = $template_hora
            //console.log(semana_number)
            $('a[href="#pills-horas-calendario"]').tab('show')
    })
}
export let handle_resultset = ()=>{
    useState['formAgendaCreate']['resultset'] = []
    let year = useState['formAgendaCreate']['agenda_year']
        useState['formAgendaCreate']['agenda_month'].forEach(mes=>{
                for (const weekNumber in mes['weeks']) {
                    for (const keyWeek in mes['weeks'][weekNumber]) {
                        let {day_value,hours} = mes['weeks'][weekNumber][keyWeek]
                            for (const key_hours in hours) {
                                useState['formAgendaCreate']['resultset'].push(
                                    getDatesOfWeekWithHours(
                                        weekNumber,
                                        year,
                                        day_value,
                                        hours[key_hours]
                                    )
                                )
                            }
                    }
                }
        })
    let agenda_desde = fechaAMD( first( useState['formAgendaCreate']['resultset'].map(x=>x['day'])) )
    let agenda_hasta = fechaAMD( last( useState['formAgendaCreate']['resultset'].map(x=>x['day'])) )

        entById(`agenda_desde`).value = agenda_desde
        entById(`agenda_hasta`).value = agenda_hasta

        useState['formAgendaCreate'][`agenda_desde`] = agenda_desde
        useState['formAgendaCreate'][`agenda_hasta`] = agenda_hasta

        useState['formAgendaCreate']['agenda'] = JSON.stringify({
            "turno":useState['formAgendaCreate']["turno"],
            "agenda_month":useState['formAgendaCreate']['agenda_month'],
            "dias_excluidos":useState['formAgendaCreate']['dias_excluidos'],
            "meses_excluidos":useState['formAgendaCreate']['meses_excluidos'],
            "semanas_excluidas":useState['formAgendaCreate']['semanas_excluidas'],
        })


}
function obtenerRangoSemana(año, numeroSemana) {
    const primerDiaAño = new Date(año, 0, 1);
    const diaSemanaPrimerDia = primerDiaAño.getDay(); // 0 = domingo, 1 = lunes, ..., 6 = sábado
    const diaSemanaInicioSemana = (numeroSemana - 1) * 7 + 1 - diaSemanaPrimerDia;

    const fechaInicioSemana = new Date(año, 0, diaSemanaInicioSemana);
    const fechaFinSemana = new Date(fechaInicioSemana);
    fechaFinSemana.setDate(fechaInicioSemana.getDate() + 6);

    return { inicio: fechaInicioSemana, fin: fechaFinSemana };
}
function formatearFecha(fecha) {
    const diasSemana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

    const partesFecha = fecha.split('/'); // Divide la fecha en día, mes y año
    const dia = parseInt(partesFecha[0], 10);
    const mes = parseInt(partesFecha[1], 10) - 1; // Restamos 1 porque los meses en JavaScript son base 0
    const anio = parseInt(partesFecha[2], 10);

    const fechaObjeto = new Date(anio, mes, dia);
    const diaSemana = diasSemana[fechaObjeto.getDay()];
    const nombreMes = meses[mes];

    return `${diaSemana} ${dia} de ${nombreMes}`;
}
export let container_meses = () => {

    const currentYear = new Date().getFullYear();
    let $container = entById("container_meses");
        $container.innerHTML = null;
        d.querySelector(`#todo_el_anio`).checked = true
        useState['formAgendaCreate'][ "agenda_month"].forEach(mes=>{
            let $checkBoxSemanas = ""
            let semanas = mes['weeks']
            let key_semana = 0;
            let contador= 1;
                for(let semana_number in semanas){
                    const rangoSemana = obtenerRangoSemana(currentYear, semana_number);
                    key_semana++
                    $checkBoxSemanas += `
                        <div class="mes-hover d-flex mr-2 px-2 mb-1" data-toggle="tooltip" data-placement="top" title="Semana del ${formatearFecha(rangoSemana.inicio.toLocaleDateString())} al ${formatearFecha(rangoSemana.fin.toLocaleDateString())}.">
                            <input
                                id="month_semana_${mes['number']}_${contador}"
                                style="cursor: pointer"
                                type="checkbox"
                                data-mes_number="${mes['number']}"
                                data-mes_name="${mes['name']}"
                                data-semana_number="${semana_number}"
                                data-num_seman_mes="${contador}"
                                class="input-semana mes-${mes['number']} num-seman-mes-${contador} semana-${semana_number}"
                                name="month_semana_${mes['number']}_${contador}" value="${semana_number}"
                                checked
                            >
                            <label
                                for="month_semana_${mes['number']}_${contador}"
                                style="cursor: pointer"
                                data-mes_number="${mes['number']}"
                                data-mes_name="${mes['name']}"
                                data-semana_number="${semana_number}"
                                data-num_seman_mes="${contador}"
                                class="font-weight-normal pl-1 pt-1 mb-0"
                            >
                                S${key_semana}
                            </label>
                        </div>
                    `;
                    contador++;

                }
                $container.insertAdjacentHTML("beforeend", `
                    <div class="col-3 mes-hover">
                        <input
                            id="agenda_month_${mes['number']}"
                            type="checkbox"
                            data-mes_name="${mes['name']}"
                            data-mes_number="${mes['number']}"
                            class="ml-2 cursor-pointer agenda_month"
                            name="agenda_month_${mes['number']}"
                            value="${mes['number']}"
                            checked
                        >
                        <label
                            data-mes_name="${mes['name']}"
                            data-mes_number="${mes['number']}"
                            class="cursor-pointer font-weight-normal"
                            for="agenda_month_${mes['number']}"
                        >
                            ${mes['name']}
                        </label>
                    </div>
                    <div class="col-9">
                        <div class="mes-hover d-flex flex-wrap">
                        ${$checkBoxSemanas}
                        </div>
                    </div>
                `)
        })
        for (let index = 1; index <= 7; index++) {
            let temp_imput = d.querySelector(`input[name='month_semana_${index}']`)
                if (!is_null(temp_imput)) {
                    temp_imput.checked = true
                }
        }
}
export let container_dias = () => {
    let $container = import { $qs, $qsa, $select, $selectCustom, first, last, is_empty } from '../../helpers/helpers.js'
import * as ComponentMedico from '../medico/medico_home.js'
import * as Componentmedico from '../../component/medico/medico.js'

let d = document
export let get_all = (attr) => {
	return useState[attr]
}
export let get_index = (attr, key, value) => {
	return useState[attr].findIndex(index => equalsInt(index[key], value))
}
export let get_one = (attr, key, value) => {
	return useState[attr].find(index => equalsInt(index[key], value))
}
export let get_one_by_index = (index, attr, key, value) => {
	return useState[index][attr].filter(index => equalsInt(index[key], value))
}
export let add_row = (attr, value, position = "first") => {
	if (position === "first") {
		useState[attr].unshift(value)
	}
	if (position === "last") {
		useState[attr].push(value)
	}
}
export let add_row_by_index = (index, attr, value, position = "first") => {
	if (position === "first") {
		useState[index][attr].unshift(value)
	}
	if (position === "last") {
		useState[index][attr].push(value)
	}
}
export let delete_one = ({ attr, index, item_id }) => {
	useState['formAgendaCreate'][attr][get_index(item_id)].splice(index, 1);
}
let $comboEspecialidades = (especialidades,especialidades_del_medico)=>{
	let $fragment = document.createDocumentFragment()

	let $option

		$option = document.createElement("option")
		$option.value = ""
		$option.textContent = "Seleccione"
		$fragment.appendChild($option)

		especialidades.forEach(x=>{

			$option = document.createElement("option")

			$option.value =x.id
			$option.textContent =x.description
			if (!especialidades_del_medico.includes(x.cat_especialidad_id)) {
				$option.style.color="rgb(164, 178, 189)"
				$option.disabled=true
				$option.textContent =x.description
			}
			$fragment.appendChild($option)
		})
	return $fragment;
}

export let create = async (items, all=true) => {
	await init(items)
	console.log(useState)
	let $model = d.querySelector(`${useState['tab']} #form_agenda_create`)
        useState['cat_especialidad_id'] = await get("/consultaexterna/cat_user_especialidad/index");
	let $form = document.getElementById("artefacto_0036").content.cloneNode(true)
		$model.innerHTML = null
		$model.append($form)

		d.querySelector(`.cat-cita-status-title`).textContent = "Nueva Agenda"



	//1 datos del medico a mostrar
	let medicos =[]
	let temp_medico = get_one("medicos","user_id",useState['user_id_medico'])

	//2 especialidades del medico
	let especialidades_del_medico = temp_medico.map(x=>x.cat_user_especialidad_id)

		temp_medico = temp_medico.length > 1 ? temp_medico[0] : temp_medico
		medicos.push(temp_medico)
		console.log("1 medicos->",medicos)

	/*** */
	//let medico_centros_de_salud_asociado = temp_medico.centro_salud_id_asignado.split(",").map(x=> parseInt(x) )
	//console.log("medico_centros_de_salud_asociado->",medico_centros_de_salud_asociado)
	let centro_salud = useState['centro_salud']
	let cat_especialidad_id = useState['cat_especialidad_id']
    /* .filter(centro =>{
			if (medico_centros_de_salud_asociado.includes(centro.id)) {
				return centro
			}
		}) */
        $model.querySelector(`select[name='centro_salud_id']`).innerHTML = null
		$model.querySelector(`select[name='centro_salud_id']`).append( $select( centro_salud ) )
        $model.querySelector(`select[name='cat_especialidad_id']`).innerHTML=null;
		$model.querySelector(`select[name='cat_especialidad_id']`).append( $select( cat_especialidad_id ) )
		//$model.querySelector(`select[name='user_id_medico']`).innerHTML = `<option disabled >Sin resultados</option>`
	/*** */

		console.log("4 centro_salud->",centro_salud )
	//INIT VALUES
	let date = new Date()
	useState['formAgendaCreate']['agenda_year'] = date.getFullYear()
	useState['formAgendaCreate']['centro_salud_id'] = parseInt($model.querySelector(`select[name='centro_salud_id']`).value)
	useState['formAgendaCreate']['cat_especialidad_id'] = parseInt($model.querySelector(`select[name='cat_especialidad_id']`).value)
	useState['formAgendaCreate']['user_id_medico'] = parseInt(  useState['user_id_medico'] )

	$model.querySelectorAll(`input[name='agenda_day_week']`).forEach($input2 => {
		if ($input2.checked === true) {
			add_row_by_index(
				"formAgendaCreate",
				"agenda_day_week",
				parseInt($input2.value),
				"last"
			)
		}
	})
	$model.querySelectorAll(`input[name='agenda_month']`).forEach(($input2, key) => {
		if (key !== 0) {
			if ($input2.checked === true) {
				add_row_by_index(
					"formAgendaCreate",
					"agenda_month",
					parseInt($input2.value) + 1,
					"last"
				)

			}
		}
	})
	useState['formAgendaCreate']['agenda_month'] = useState['formAgendaCreate']['agenda_month'].sort(function (a, b) { return a - b })
	//useState['formAgendaCreate']['agenda_hour'] = $model.querySelectorAll(`input[name='agenda_hour']`)[0].value.split("-")

	console.log(useState)

	//EVENTS
	//CENTRO_SALUD_ID
	$model.querySelector(`select[name='centro_salud_id']`).addEventListener("change", function (e) {
		//d.querySelector(`${useState['tab']} select[name='cat_especialidad_id']`).innerHTML = `<option disabled>Sin resultados</option>`
		//d.querySelector(`${useState['tab']} select[name='user_id_medico']`).innerHTML = `<option disabled >Sin resultados</option>`
		if (!is_empty(e.target.value) ) {
			useState['formAgendaCreate']['centro_salud_id'] = parseInt(e.target.value)
			useState['formAgendaCreate']['cat_especialidad_id'] = ""
			//useState['formAgendaCreate']['user_id_medico'] = ""
			/* let model = get_one('centro_salud', 'id', e.target.value)
			let cat_especialidades = first(model).especialidades
				if (cat_especialidades.length > 0) {
					d.querySelector(`${useState['tab']} select[name='cat_especialidad_id']`).innerHTML = null
					d.querySelector(`${useState['tab']} select[name='cat_especialidad_id']`).append($comboEspecialidades(cat_especialidades,especialidades_del_medico))
				} else {
					d.querySelector(`${useState['tab']} select[name='cat_especialidad_id']`).innerHTML = `<option disabled>Sin resultados</option>`
				} */
		}else{
			useState['formAgendaCreate']['centro_salud_id'] = ""
		}
		console.log(useState['formAgendaCreate'])
	})
	//CAT_ESPECIALIDAD_ID
	$model.querySelector(`select[name='cat_especialidad_id']`).addEventListener("change", function (e) {
		//d.querySelector(`${useState['tab']} select[name='user_id_medico']`).innerHTML = `<option disabled >Sin resultados</option>`
		//useState['formAgendaCreate']['user_id_medico'] = ""
		if (!is_empty(e.target.value) ) {
			useState['formAgendaCreate']['cat_especialidad_id'] = parseInt(e.target.value)
		}else{
			useState['formAgendaCreate']['cat_especialidad_id'] = ""
		}
		console.log(useState['formAgendaCreate'])
	})
	/* $model.querySelector(`select[name='user_id_medico']`).addEventListener("change", function (e) {
		useState['formAgendaCreate']['user_id_medico'] = parseInt(e.target.value)

		console.log("user_id_medico->", useState['formAgendaCreate']['user_id_medico'])
	}) */
	$model.querySelectorAll(`input[name='agenda_month']`).forEach(($input, key) => {
		if (
			key !== 0
		) {
			$input.addEventListener("click", function (e) {
				useState['formAgendaCreate']['agenda_month'] = []
				d.querySelectorAll(`input[name='agenda_month']`)[0].checked = false

				d.querySelectorAll(`input[name='agenda_month']`).forEach($input2 => {
					if ($input2.checked === true) {

						add_row_by_index(
							"formAgendaCreate",
							"agenda_month",
							parseInt($input2.value) + 1,
							"last"
						)
					}
				})
				useState['formAgendaCreate']['agenda_month'] = useState['formAgendaCreate']['agenda_month'].sort(function (a, b) { return a - b })


				console.log(useState['formAgendaCreate'])
			})
		}
	})
	$model.querySelectorAll(`input[name='agenda_month']`)[0].addEventListener("click", function (e) {
		useState['formAgendaCreate']['agenda_month'] = []
		if (e.target.checked === false) {

			d.querySelectorAll(`input[name='agenda_month']`).forEach(($input2, key) => {
				if (
					key !== 0
				) {

					$input2.checked = false
				}
			})
		} else {
			d.querySelectorAll(`input[name='agenda_month']`).forEach(($input2, key) => {
				if (
					key !== 0
				) {
					add_row_by_index(
						"formAgendaCreate",
						"agenda_month",
						parseInt($input2.value) + 1,
						"last"
					)

					$input2.checked = true
				}
			})
			useState['formAgendaCreate']['agenda_month'] = useState['formAgendaCreate']['agenda_month'].sort(function (a, b) { return a - b })
		}
		console.log(useState['formAgendaCreate'])
	})
	$model.querySelectorAll(`input[name='agenda_hour']`).forEach($input => {
		$input.addEventListener("click", function (e) {

			if (e.target.checked === true) {
				useState['formAgendaCreate']['agenda_hour'] = []
				useState['formAgendaCreate']['agenda_hour'] = e.target.value.split("-")
			}
			console.log("agenda_hour->", useState['formAgendaCreate']['agenda_hour'])
		})
	})
	$model.querySelectorAll(`input[name='agenda_day_week']`).forEach(($input, key) => {
		if (
			key !== 0
		) {
			$input.addEventListener("click", function (e) {
                if (e.target.checked === false) {
                    $model.querySelectorAll(`input[name='agenda_hour_${e.target.value}']`).forEach(x => {
                        x.checked = false
                    })
                }else{
                    $model.querySelector(`input[name='agenda_hour_${e.target.value}']`).checked = true
                }
				useState['formAgendaCreate']['agenda_day_week'] = []
				$model.querySelectorAll(`input[name='agenda_day_week']`)[0].checked = false

				$model.querySelectorAll(`input[name='agenda_day_week']`).forEach($input2 => {
					if ($input2.checked === true) {

						add_row_by_index(
							"formAgendaCreate",
							"agenda_day_week",
							parseInt($input2.value),
							"last"
						)
					}
				})



				console.log("agenda_day_week->", useState['formAgendaCreate']['agenda_day_week'])
			})
		}
	})
	$model.querySelectorAll(`input[name='agenda_day_week']`)[0].addEventListener("click", function (e) {

        console.log(e.target.value)
		useState['formAgendaCreate']['agenda_day_week'] = []
		if (e.target.checked === false) {

			$model.querySelectorAll(`input[name='agenda_day_week']`).forEach(($input2, key) => {
				if (
					key !== 0
				) {
                    $model.querySelectorAll(`input[name='agenda_hour_${$input2.value}']`).forEach(x => {
                        x.checked = false
                    })
					$input2.checked = false
				}
			})
		} else {
            $model.querySelectorAll(`input[name='agenda_hour_${e.target.value}']`).forEach(x => {
                x.checked = true
            })
			$model.querySelectorAll(`input[name='agenda_day_week']`).forEach(($input2, key) => {
				if (
					key !== 0
				) {

					add_row_by_index(
						"formAgendaCreate",
						"agenda_day_week",
						parseInt($input2.value),
						"last"
					)
					$input2.checked = true
                    $model.querySelectorAll(`input[name='agenda_hour_${$input2.value}']`).forEach(x => {
                        x.checked = true
                    })

				}
			})
		}
		console.log(useState['formAgendaCreate'])
	})
	$model.querySelector("#submit").addEventListener("click", async function (e) {
		e.preventDefault()
        //console.log( document.querySelectorAll(".agenda_hour:checked") )


		useState['formAgendaCreate']['agenda'] = []
		//console.log( useState['formAgendaCreate'] )
		useState['formAgendaCreate']['agenda_month'].forEach(month => {
			let days_week = []

				useState['formAgendaCreate']['agenda_day_week'].forEach(day_week => {
                    let agenda_hour = document.querySelector(`input[name='agenda_hour_${day_week}']:checked` )

                        if (!is_null(agenda_hour)) {
                            agenda_hour =   agenda_hour.value.split("-")
                        }else {
                            agenda_hour = []
                           // document.querySelector(`input[name='agenda_hour_${day_week}']` ).focus()
                           // alert("Selecciona un horario válido.")

                        }
                    let dia_nombre = ""
                        switch (day_week) {
                            case 1: dia_nombre="Lunes"; break;
                            case 2: dia_nombre="Martes"; break;
                            case 3: dia_nombre="Miércoles"; break;
                            case 4: dia_nombre="Jueves"; break;
                            case 5: dia_nombre="Viernes"; break;
                            case 6: dia_nombre="Sábado"; break;
                            case 7: dia_nombre="Domingo"; break;

                        }
                        days_week.push({
                            "dia_semana": day_week,
                            "dia_nombre": dia_nombre,
                            "horas": agenda_hour
                        })
				})
                let mes_nombre = ""
                    switch (month) {
                        case 1: mes_nombre="Enero"; break;
                        case 2: mes_nombre="Febrero"; break;
                        case 3: mes_nombre="Marzo"; break;
                        case 4: mes_nombre="Abril"; break;
                        case 5: mes_nombre="Mayo"; break;
                        case 6: mes_nombre="Junio"; break;
                        case 7: mes_nombre="Julio"; break;
                        case 8: mes_nombre="Agosto"; break;
                        case 9: mes_nombre="Septiembre"; break;
                        case 10: mes_nombre="Octubre"; break;
                        case 11: mes_nombre="Noviembre"; break;
                        case 12: mes_nombre="Diciembre"; break;

                    }
				add_row_by_index(
					"formAgendaCreate",
					"agenda",
					{
						"mes_numero": month,
						"mes_nombre": mes_nombre,
						"horario": days_week
					},
					"last"
				)

		})
        let input = d.querySelector(`select[name='cat_especialidad_id']`)
        if (is_null(input.value )) {

            Toast.fire({
                icon: "warning",
                title: "Seleccione una opción válida.",
                text: nacionalidad.val() + cedula.val() + message['message'],
                didClose: () => {
                    setTimeout(() =>  { input.focus();}, 110);
                }
            })
            return false
        }
		useState['formAgendaCreate']['agenda'] = JSON.stringify(useState['formAgendaCreate']['agenda'])
		let resultset = await store()


            Toast.fire({
                icon: "success",
                title: "Agenda guardada correctamente.",
                text: "",
                didClose: () => {
                    setTimeout(() =>  { }, 110);
                }
            })
			//localStorage.setItem("agenda_create", JSON.stringify( first(resultset) ))
			//console.log("nueva_agenda->", useState['formAgendaCreate']['agenda'])
			console.log("resultset->", resultset)

	})




}
export let handle_cat_especialidad = ()=>{

    let $form = d.querySelector(`#App`)
    let temp_medico = get_one("medicos","user_id",useState['formAgendaCreate']['user_id_medico'])
    let especialidades_del_medico = temp_medico['especialidad'].map(x=>x['cat_user_especialidad_id'])
    // let centros_de_salud = useState['cat_centro_salud'].find(x=> equalsInt(x['id'],useState['formAgendaCreate']['centro_salud_id'] ))
    let centros_de_salud = useState['cat_centro_salud'].find(x=> equalsInt(x['id'],1))
    console.log('Centros de salud --> ',centros_de_salud)
    centros_de_salud = centros_de_salud['centro_salud_especialidades_id'].split(",").map(z=>Number(z))
    //let especialidades_del_centro_salud = useState['cat_especialidad'].filter(z=> centros_de_salud.includes( z['id'] ) )
    let especialidades_del_centro_salud = useState['cat_especialidad'].filter(z=> especialidades_del_medico.includes( z['id'] ) )
        select2(especialidades_del_centro_salud,$form.querySelector("#cat_especialidad_id"))
        useState['formAgendaCreate']['cat_especialidad_id']  = Number($form.querySelector("#cat_especialidad_id").value)
}
/* export let agenda_edit = (e)=>{

    useState['formAgendaCreate']["dias_excluidos"] =[
        "Domingo",
        "Lunes",
        "Martes",
        "Miércoles",
        "Jueves",
        "Viernes",
        "Sábado"
    ]
    useState['formAgendaCreate']["meses_excluidos"] =[
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
    ]
    useState['formAgendaCreate']["semanas_excluidas"] ={
            "Enero": [1,2,3,4,5,6],
            "Febrero": [1,2,3,4,5,6],
            "Marzo":  [1,2,3,4,5,6],
            "Abril": [1,2,3,4,5,6],
            "Mayo":  [1,2,3,4,5,6],
            "Junio":  [1,2,3,4,5,6],
            "Julio":  [1,2,3,4,5,6],
            "Agosto":  [1,2,3,4,5,6],
            "Septiembre":  [1,2,3,4,5,6],
            "Octubre":  [1,2,3,4,5,6],
            "Noviembre":  [1,2,3,4,5,6],
            "Diciembre":  [1,2,3,4,5,6],
        }
    useState['formAgendaCreate']["agenda_month"] =[]
    useState['formAgendaCreate']["resultset"] =[]

    handle_todo_el_anio(false)

    let {agenda_id} = e.dataset
    let agenda = useState['formAgendaCreate']['agenda_registradas'].find(agenda=>equalsInt(agenda['agenda_id'],agenda_id))

        useState['formAgendaCreate']['centro_salud_id'] = agenda['centro_salud_id']
        useState['formAgendaCreate']['cat_especialidad_id'] = agenda['cat_especialidad_id']
        agenda = JSON.parse(agenda['agenda'])

        for (const key in agenda) {
            if (Object.hasOwnProperty.call(useState['formAgendaCreate'], key)) {
                useState['formAgendaCreate'][key] = agenda[key]
                //const element = object[key];
            }
        }
        //console.log(agenda)
    let {cat_especialidad_id,centro_salud_id} = useState['formAgendaCreate']

        d.querySelector(`#centro_salud_id`).value=centro_salud_id
        d.querySelector(`#cat_especialidad_id`).value=cat_especialidad_id


    let meses = useState['formAgendaCreate']['agenda_month']
    //let mesObject
    let semanas
        meses.forEach((mes,mes_number)=>{
            d.querySelector(`.agenda_month[value='${mes_number}']`).checked=true
            semanas = mes['weeks']
            for (const semana in semanas) {
                d.querySelectorAll(`.month_semana_${mes['name']+semana}`).forEach(sem=>{
                    sem.checked=true
                })

                //console.log(key)

            }
            dias_nombres.forEach((dia,key)=>{
                if (!useState['formAgendaCreate']['dias_excluidos'].includes(dia)) {
                    d.querySelector(`#agenda_day_week_${key}`).checked=true

                }
            })

        })
        //console.log(agenda);
        $('a[href="#pills-crear-agenda"]').tab('show')
        //configMesObject()
} */
export let getDatesOfWeekWithHours = (weekNumber, year, dayOfWeek, hour)=> {
    // Obtenemos la fecha del primer día del año
    const firstDayOfYear = new Date(year, 0, 1);
    // Calculamos el número de milisegundos desde el primer día del año hasta el primer día de la semana actual
    const pastDaysOfYear = (weekNumber - 1) * 7;
    // Añadimos los milisegundos al primer día del año para obtener el primer día de la semana especificada
    const firstDayOfWeek = new Date(firstDayOfYear.getTime() + (pastDaysOfYear * 24 * 60 * 60 * 1000));

    // Calculamos el número de días hasta el día de la semana especificado
    const pastDaysOfWeek = (dayOfWeek - firstDayOfWeek.getUTCDay() + 7) % 7;
    // Obtenemos la fecha del día de la semana especificado sumando los días al primer día de la semana
    const dateOfWeek = new Date(firstDayOfWeek.getTime() + (pastDaysOfWeek * 24 * 60 * 60 * 1000));

    // Creamos un array para guardar las fechas con las horas especificadas
    //const datesWithHours = [];
    // Recorremos el arreglo de horas
    //for (const hour of hours) {
    // Separamos la hora y los minutos
    const [hourStr, minuteStr] = hour['hora'].split(":");
    // Convertimos las horas y minutos a números
    const hourNum = parseInt(hourStr, 10);
    const minuteNum = parseInt(minuteStr, 10);
    // Creamos una fecha con la fecha y hora especificadas
    const dateWithHour = new Date(dateOfWeek.getFullYear(), dateOfWeek.getMonth(), dateOfWeek.getDate(), hourNum, minuteNum);
    // Añadimos la fecha con la hora especificada al array de fechas con horas
    //datesWithHours.push(dateWithHour);
    //}

    // Devolvemos el array de fechas con horas
    return {"day":local_timestamps2(dateWithHour),"visibilidad":hour['visibilidad']};
    //return datesWithHours;
}
export let mis_agendas = async ()=>{
    let $form = d.querySelector(`#App`)
    $('a[href="#pills-index-agenda').tab('show')
    d.querySelector(".overlay").classList.remove("d-none")
    useState['formAgendaCreate']['agenda_registradas'] = await get(location.origin+`/consultaexterna/user/medico/agenda/show/${useState['formAgendaCreate']['user_id_medico']}`)
    d.querySelector(".overlay").classList.add("d-none")

    $form.querySelector("#mis_agendas").innerHTML=null

    if(!is_empty(useState['formAgendaCreate']['agenda_registradas'])){
        //Consulta de agendas guardadas
        //console.log("agendas registradas: ",useState['formAgendaCreate']['agenda_registradas'])
        let agendas = useState['formAgendaCreate']['agenda_registradas'].filter(misAgendas=>
                equalsInt(misAgendas['centro_salud_id'],$form.querySelector("#centro_salud_id").value) &&
                equalsInt(misAgendas['cat_especialidad_id'],$form.querySelector("#cat_especialidad_id").value)
            );

            console.log("agendas registradas: ",agendas)
            if(!is_empty(agendas)){

                agendas.forEach(misAgendas=>{

                    d.querySelector('#datepicker').innerHTML=null

                    let agenda = JSON.parse(misAgendas['agenda'])

                    if (agenda.hasOwnProperty("agenda_month")) {

                        d.querySelector('#datepicker').dataset['agenda_id'] = misAgendas['agenda_id']
                        let dias = []
                            for (const mes in agenda['agenda_month']) {
                                for (const semana in agenda['agenda_month'][mes]['weeks']) {
                                    for (let dia in agenda['agenda_month'][mes]['weeks'][semana]) {
                                        dia = agenda['agenda_month'][mes]['weeks'][semana][dia]
                                        let temp = JSON.stringify({
                                                    "dia_nombre":dia['day'],
                                                    "turno":dia['turno']
                                                })
                                            if (!dias.includes(temp)) {
                                                dias.push(temp)
                                            }

                                    }
                                }
                            }
                            console.log(dias);
                        let turno = []
                            dias.forEach(diaJSON=>{
                                let diaObject = JSON.parse(diaJSON)
                                let colorTurno = "dia"

                                    if (diaObject['turno']['horario'] == "Tarde") {
                                        colorTurno = "tarde"
                                    }
                                    if (diaObject['turno']['horario'] == "Todo el dia") {
                                        colorTurno = "todo-el-dia"
                                    }
                                    turno +=`
                                        <div class="col-6 col-sm-6 col-lg-4">
                                            <div class="dia-horario dia-horario-${colorTurno}">
                                                <b>
                                                    ${diaObject['dia_nombre'].toUpperCase()}
                                                </b>
                                                <div class="d-flex text-nowrap">
                                                    <div class="text-center" style="width: 10px">
                                                        <b title="Inicio" class="text-success">I</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                        ${diaObject['turno']['I']}
                                                    </div>
                                                </div>
                                                <div class="d-flex text-nowrap">
                                                    <div class=" text-center" style="width: 10px">
                                                        <b title="Fín" class="text-info">F</b>
                                                    </div>
                                                    <div class="flex-grow-1 ">
                                                        ${diaObject['turno']['F']}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    `
                            })
                            $form.querySelector("#mis_agendas").insertAdjacentHTML("beforeend", `
                                <div id="agenda_row_${misAgendas['agenda_id']}" data-agenda_id="${misAgendas['agenda_id']}" class="agenda-row row mb-1 py-1 mes-hover cursor-pointer">
                                    <div class="col-9">
                                        <img onerror="reemplaza_imagen(this)" src="${misAgendas['especialidad_imagen']}"
                                            style="height: 1.5rem;width:1.5rem;">
                                        <b>${misAgendas['cat_especialidad_description']}</b>
                                    </div>
                                    <div class="col-3 text-right">
                                        <!--<button data-agenda_id="${misAgendas['agenda_id']}" data-user_id_medico="${useState['formAgendaCreate']['user_id_medico']}" class="agenda-edit btn btn-default"><i data-agenda_id="${misAgendas['agenda_id']}" class="agenda-edit fa fa-edit text-primary"></i></button>-->
                                        <button data-agenda_id="${misAgendas['agenda_id']}" data-user_id_medico="${useState['formAgendaCreate']['user_id_medico']}" class="agenda-destroy btn btn-default">
                                            <i data-agenda_id="${misAgendas['agenda_id']}" data-user_id_medico="${useState['formAgendaCreate']['user_id_medico']}" class="agenda-destroy fa fa-trash text-primary"></i>
                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <b class="p-0 text-secondary text-nowrap" style="font-size:0.8rem;">
                                            ${misAgendas['centro_salud_description']}
                                        </b>
                                    </div>
                                    ${turno}

                                </div>
                            `)


                            for (const key in agenda) {
                                if (Object.hasOwnProperty.call(useState['formAgendaCreate'], key)) {
                                    useState['formAgendaCreate'][key] = agenda[key]
                                    //const element = object[key];
                                }
                            }
                            handle_resultset()
                            activarCalendario()
                            handle_datepiker()
                           //configMesObject()
                    }else{
                        d.querySelector('#datepicker').innerHTML=`
                            <div class="row">
                                <div class="col-12 text-center text-secondary">
                                    No posee agenda de citas
                                </div>
                            </div>
                        `
                        $form.querySelector("#mis_agendas").innerHTML=`
                            <div class="row">
                                <div class="col-12 text-center text-secondary">
                                    No posees agendas
                                </div>
                            </div>
                        `
                    }

                })
            }else{
                $form.querySelector("#mis_agendas").innerHTML=`
                    <div class="row">
                        <div class="col-12 text-center text-secondary">
                            No posees agendas
                        </div>
                    </div>
                `
            }
    }
}
export let horas_generate = (turno,total_pacientes_por_horas,visibilidad,horas_privadas=[]) => {
    let horas = []
    let horaMilisegundo = 3600000
    let hoy = new Date()
    let inicio
    let fin
    let maxHora
        if (turno === "Mañana") {
            inicio = new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 8, 0, 0)
            maxHora = (new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 11, 0, 0)).getTime()
            fin = new Date(inicio.getTime() + (horaMilisegundo * 4))
        }
        if (turno === "Tarde") {
            inicio = new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 13, 0, 0)
            maxHora = (new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 16, 0, 0)).getTime()
            fin = new Date(inicio.getTime() + (horaMilisegundo * 4))
        }
        if (turno === "Todo el dia") {
            inicio = new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 8, 0, 0)
            maxHora = (new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 16, 0, 0)).getTime()
            fin = new Date(inicio.getTime() + (horaMilisegundo * 9))
        }
    let keyArray = 0
    let index = inicio.getTime();
    let tarde = false;
    let temp_visibilidad = "publica"
        while (index < fin.getTime()) {

            if (
                index > (new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 11, 0, 0)).getTime() &&
                index < (new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 13, 0, 0)).getTime()
            ) {
                index = index + horaMilisegundo
            } else {
                if (index >= (new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 13, 0, 0)).getTime() && !tarde) {
                    tarde = true
                    index = (new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 13, 0, 0)).getTime()
                }
                if (visibilidad === "todo_el_dia_privado") {
                    temp_visibilidad = "privada"
                }
                if (visibilidad === "manana_publica_tarde_privada") {
                    if (index <= (new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 11, 0, 0)).getTime()) {
                        temp_visibilidad = "publica"
                    } else {
                        temp_visibilidad = "privada"
                    }
                }
                if (visibilidad === "tarde_publica_manana_privada") {
                    if (index >= (new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 13, 0, 0)).getTime()) {
                        temp_visibilidad = "publica"
                    } else {
                        temp_visibilidad = "privada"
                    }
                }

                let evaluate = index <= maxHora
                if (["Tarde","Todo el dia"].includes(turno)) {
                    evaluate = index < maxHora
                }
                if (evaluate) {
                    let fecha = new Date(index)
                    let hora = String(fecha.getHours()).padStart(2, '0')+":"+String(fecha.getMinutes()).padStart(2, '0')

                        if ( horas_privadas.includes(hora) ) {
                            horas.push({
                                turno,
                                hora,
                                "visibilidad": "privada",
                            })
                        }else{
                            horas.push({
                                turno,
                                hora,
                                "visibilidad": temp_visibilidad,
                            })
                        }


                }

                index = index + (horaMilisegundo / total_pacientes_por_horas)
                keyArray++
            }
        }


        return horas
}
export let getWeek = (date) => {
    var d = new Date(Date.UTC(date.getFullYear(), date.getMonth(), date.getDate()));
    var dayNum = d.getUTCDay() || 7;
    d.setUTCDate(d.getUTCDate() + 4 - dayNum);
    var yearStart = new Date(Date.UTC(d.getUTCFullYear(), 0, 1));
    return Math.ceil((((d - yearStart) / 86400000) + 1) / 7)
};
export let local_timestamps2=(date) =>{
    var hoy = new Date(date);
    return hoy.getFullYear() + "-" + String(hoy.getMonth() + 1).padStart(2, '0') + "-" + String(hoy.getDate()).padStart(2, '0') + " " +  String(hoy.getHours()).padStart(2, '0')+":"+String(hoy.getMinutes()).padStart(2, '0')
}
export let getWeeksInMonth = (month) => {
  let weeks = [];
  let f = new Date()
  let firstDayOfMonth = new Date(f.getFullYear(), month, 1);
  let lastDayOfMonth = new Date(f.getFullYear(), month + 1, 0);
  let numberOfDays = lastDayOfMonth.getDate();

  let firstDayOfWeek = firstDayOfMonth.getDate() - firstDayOfMonth.getDay();
  let lastDayOfWeek = firstDayOfWeek + 6;

  while (lastDayOfWeek < numberOfDays) {
      weeks.push(getWeek(new Date(f.getFullYear(), month, lastDayOfWeek)));
      firstDayOfWeek += 7;
      lastDayOfWeek += 7;
  }
  if (lastDayOfWeek > 31) {
      lastDayOfWeek = 31;
  }
  weeks.push(getWeek(new Date(f.getFullYear(), month, lastDayOfWeek)));

  return weeks;
}
export let week_remove = (mes_number,week_to_remove)=>{
    useState['formAgendaCreate'][ "agenda_month" ].forEach((mes,mes_key)=>{
      if(Number(mes_number)===Number(mes['number']) ){
        let weeks_disponibles=[]
        for(let week_number in mes["weeks"]){
          if(Number(week_number) !== Number(week_to_remove)){
            weeks_disponibles[week_number] = mes["weeks"][week_number]
          }else{
            useState['formAgendaCreate'][ "semanas_excluidos" ].push(Number(week_to_remove))
          }
        }
        useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"] = null
        useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"] = weeks_disponibles
      }
    })
}
export let week_add = (mes_number,week_to_add)=>{
    //console.log("week_to_add",week_to_add)
            //AÑADIMOS LAS SEMANAS
            //let weeks_numbers = getWeeksInMonth(mes_number)
    useState['formAgendaCreate'][ "semanas_excluidos" ] = useState['formAgendaCreate'][ "semanas_excluidos" ].filter(semana=> Number(semana) !== Number(week_to_add) )
    let mes_index = useState['formAgendaCreate'][ "agenda_month" ].findIndex(mes=>equalsInt(mes_number,mes['number']))
        useState['formAgendaCreate'][ "agenda_month" ][mes_index]['weeks'][week_to_add] =[]


    let checked = d.querySelectorAll(`.agenda-dia:checked`)
    console.log("dias",checked.length)
        if (checked.length === 0) {
            useState['formAgendaCreate'][ "dias_excluidos" ] =["Sábado","Domingo"]
            let turno = []
                for(let key in useState['formAgendaCreate'][ "turno" ]){
                    if (!useState['formAgendaCreate'][ "dias_excluidos" ].includes(useState['formAgendaCreate'][ "turno" ][key]["day"])) {
                        turno.push(useState['formAgendaCreate'][ "turno" ][key])
                    }
                }
                d.querySelectorAll(`.agenda-dia`).forEach(dia=>{
                    let {dia_name,dia_number} = dia.dataset
                        if (!useState['formAgendaCreate'][ "dias_excluidos" ].includes(dia_name)) {
                            dia.checked = true
                            d.querySelector(`.horas-dia-${dia_number}`).checked = true
                        }
                })
                for(let key in  useState['formAgendaCreate'][ "agenda_month" ][mes_index]['weeks']){
                    useState['formAgendaCreate'][ "agenda_month" ][mes_index]['weeks'][key] = turno
                }
        }else{
            let turno = []
                for(let key in useState['formAgendaCreate'][ "turno" ]){
                    if (!useState['formAgendaCreate'][ "dias_excluidos" ].includes(useState['formAgendaCreate'][ "turno" ][key]["day"])) {
                        turno.push(useState['formAgendaCreate'][ "turno" ][key])
                    }
                }
                for(let key2 in  useState['formAgendaCreate'][ "agenda_month" ][mes_index]['weeks']){
                    //console.log("semana->",key2)
                    useState['formAgendaCreate'][ "agenda_month" ][mes_index]['weeks'][key2] = turno
                }
        }


    console.log(useState['formAgendaCreate'])
}
export let day_turno_update = (day_to_update=[],turno,total_pacientes_por_horas=1,horas,visibilidad)=>{
   // console.log(horas)
    useState['formAgendaCreate'][ "agenda_month" ].forEach((mes,mes_key)=>{
      for(let week_number in mes["weeks"]){
        for(let day_key in mes["weeks"][week_number]){
         /*  let horas = horas_generate(
              turno,
              total_pacientes_por_horas,
              turno
            ) */
            for(let day_hour in useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number]){
              let {day} = useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][day_hour]
                if( day_to_update.includes(day) ){
                  useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][day_hour]['turno_name'] = turno
                  useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][day_hour]['visibilidad'] = visibilidad
                  useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][day_hour]['total_pacientes_por_horas'] = total_pacientes_por_horas
                  useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][day_hour]['hours'] = horas
                  useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][day_hour]["turno"]={
                    "horario":turno,
                    "I": horaAMPM(first(horas)['hora']),
                    "F": horaAMPM(last(horas)['hora']),
                  }
                }

                //console.log(useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][day_hour])
            }
        }
      }
    })
}
export let day_turno_hour_visibility_update = (day_week,hour,visibility)=>{
    useState['formAgendaCreate'][ "turno" ][day_week]['hours'].forEach((h,h_key)=>{
        if( h['hora'] === hour ){
            console.log(useState['formAgendaCreate'][ "turno" ][day_week]['hours'][h_key])
            useState['formAgendaCreate'][ "turno" ][day_week]['hours'][h_key]['visibilidad'] = visibility
            console.log(useState['formAgendaCreate'][ "turno" ][day_week]['hours'][h_key])
        }
    })
    useState['formAgendaCreate'][ "agenda_month" ].forEach((mes,mes_key)=>{
      for(let week_number in mes["weeks"]){
        for(let day_key in mes["weeks"][week_number]){

            for(let day_hour in useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number]){
              let {day_value} = useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][day_hour]

                if( Number(day_value) === Number(day_week) ){
                  let key = useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][day_hour]['hours'].findIndex(hora=>hora['hora']===hour)
                    useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][day_hour]['hours'][key]['visibilidad'] = visibility


                }


            }
        }
      }
    })
}
export let day_remove = (day_to_remove)=>{
    useState['formAgendaCreate'][ "agenda_month" ].forEach((mes,mes_key)=>{
      for(let week_number in mes["weeks"]){
        let days_disponibles=[]
        for(let day_key in mes["weeks"][week_number]){

          //console.log(mes["weeks"][week_number][day_key])
          if(Number(mes["weeks"][week_number][day_key]['day_value'])!==Number(day_to_remove)){
            days_disponibles.push(mes["weeks"][week_number][day_key])
          }else{
            let day_exist = useState['formAgendaCreate'][ "dias_excluidos" ].some(day=>day===mes["weeks"][week_number][day_key]['day'])
            if(!day_exist){
              useState['formAgendaCreate'][ "dias_excluidos" ].push( mes["weeks"][week_number][day_key]['day'] )
            }
          }

        }
        useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number] = null
        useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number] = days_disponibles

      }
    })
    console.log(useState['formAgendaCreate'])
}
export let day_add = (day_to_add)=>{
    useState['formAgendaCreate'][ "agenda_month" ].forEach((mes,mes_key)=>{
        for(let week_number in mes["weeks"]){
          //console.log(mes["weeks"][week_number])
            if (!is_empty( mes["weeks"][week_number] )) {
                let day_exist = Array.from(mes["weeks"][week_number]).some(d=>Number(d['day_value'])===Number(day_to_add) )

                    if(!day_exist){
                        let total = Object.keys(useState['formAgendaCreate'][ "agenda_month" ][ mes_key ]["weeks"][ week_number ]).length

                        useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number][total] = useState['formAgendaCreate'][ "turno" ][day_to_add]
                    }
            }else{
                useState['formAgendaCreate'][ "agenda_month" ][mes_key]["weeks"][week_number].push(useState['formAgendaCreate'][ "turno" ][day_to_add])
            }



        }
    })
      useState['formAgendaCreate'][ "dias_excluidos" ] = useState['formAgendaCreate'][ "dias_excluidos" ].filter(day_excluded=>day_excluded!==dias_nombres[day_to_add])

      console.log(useState['formAgendaCreate'])
}
export let mes_remove = (mes_to_remove)=>{

  let mes_exist = useState['formAgendaCreate'][ "agenda_month" ].some(mes=>mes['name']===mes_to_remove)

    if(mes_exist){
      useState['formAgendaCreate'][ "meses_excluidos" ].push(mes_to_remove)
      let meses_disponibles=[]
      for( let key in useState['formAgendaCreate'][ "agenda_month" ] ){
        if(mes_to_remove !== useState['formAgendaCreate'][ "agenda_month" ][key]['name']){
          meses_disponibles.push(useState['formAgendaCreate'][ "agenda_month" ][key])
        }
      }
      useState['formAgendaCreate'][ "agenda_month" ] = meses_disponibles
    }

}
export let mes_add = (mes_to_add)=>{

  let mes_exist = useState['formAgendaCreate'][ "agenda_month" ].some(mes=>mes['name']===mes_to_add)

    if(!mes_exist){
        //ELIMINAR DE LOS MESES EXCLUIDOS EL MES QUE QUEREMOS INCLUIR
        useState['formAgendaCreate'][ "meses_excluidos" ] = useState['formAgendaCreate'][ "meses_excluidos" ].filter(mes=> mes !==mes_to_add)

        //AÑADIMOS EL MES
        let mes_number = mesesEnEspanol.findIndex(mes=>mes===mes_to_add)
            useState['formAgendaCreate'][ "agenda_month" ].push({
                "number":mes_number,
                "name": mes_to_add,
                "weeks": {},
            })
            //SI NO HAY SEMANAS ACTIVAS, ACTIVARLAS TODAS
        let mes_index = useState['formAgendaCreate'][ "agenda_month" ].findIndex(mes=>equalsInt(mes_number,mes['number']))
        let checked = d.querySelectorAll(`.mes-${mes_number}:checked`)
            console.log(checked.length)
            if (checked.length === 0) {
                d.querySelectorAll(`.mes-${mes_number}`).forEach(semana=>{
                    semana.checked = true
                    let {semana_number} = semana.dataset
                        useState['formAgendaCreate'][ "semanas_excluidos" ] = useState['formAgendaCreate'][ "semanas_excluidos" ].filter(semana=> Number(semana) !== Number(semana_number) )

                        useState['formAgendaCreate'][ "agenda_month" ][mes_index]['weeks'][semana_number] =[]
                })
                let checked = d.querySelectorAll(`.agenda-dia:checked`)
                    if (checked.length === 0) {
                        useState['formAgendaCreate'][ "dias_excluidos" ] =["Sábado","Domingo"]
                        let turno = []
                            for(let key in useState['formAgendaCreate'][ "turno" ]){
                                if (!useState['formAgendaCreate'][ "dias_excluidos" ].includes(useState['formAgendaCreate'][ "turno" ][key]["day"])) {
                                    turno.push(useState['formAgendaCreate'][ "turno" ][key])
                                }
                            }
                            d.querySelectorAll(`.agenda-dia`).forEach(dia=>{
                                let {dia_name,dia_number} = dia.dataset
                                    if (!useState['formAgendaCreate'][ "dias_excluidos" ].includes(dia_name)) {
                                        dia.checked = true
                                        d.querySelector(`.horas-dia-${dia_number}`).checked = true
                                    }
                            })
                            for(let key in  useState['formAgendaCreate'][ "agenda_month" ][mes_index]['weeks']){
                                useState['formAgendaCreate'][ "agenda_month" ][mes_index]['weeks'][key] = turno
                            }
                    }else{
                        let turno = []
                            for(let key in useState['formAgendaCreate'][ "turno" ]){
                                if (!useState['formAgendaCreate'][ "dias_excluidos" ].includes(useState['formAgendaCreate'][ "turno" ][key]["day"])) {
                                    turno.push(useState['formAgendaCreate'][ "turno" ][key])
                                }
                            }
                            for(let key2 in  useState['formAgendaCreate'][ "agenda_month" ][mes_index]['weeks']){
                                //console.log("semana->",key2)
                                useState['formAgendaCreate'][ "agenda_month" ][mes_index]['weeks'][key2] = turno
                            }
                    }
            }
            console.log(useState['formAgendaCreate'])
    }

}
export let turno_horas_update = (day_key,turno,total_pacientes_por_horas,tipo_turnos)=>{
    console.log("turno_horas_update() ",day_key,turno,total_pacientes_por_horas,tipo_turnos)
  let horas = horas_generate(
                turno,
                total_pacientes_por_horas,
                tipo_turnos
              )
              console.log({horas})
      useState['formAgendaCreate'][ "turno" ][day_key]["hours"] = horas
      useState['formAgendaCreate'][ "turno" ][day_key]["turno"]={
        "horario":turno,
        "I": horaAMPM(first(horas)['hora']),
        "F": horaAMPM(last(horas)['hora']),
      }
}
export let semana_init = (mes_number)=>{
    //useState['formAgendaCreate'][ "semanas_excluidos" ] = []
    let weeks_numbers = getWeeksInMonth(mes_number)
    let turno = []
        for(let key in useState['formAgendaCreate'][ "turno" ]){
            if (!["Sábado","Domingo"].includes(useState['formAgendaCreate'][ "turno" ][key]["day"])) {
                turno.push(useState['formAgendaCreate'][ "turno" ][key])
            }
        }
        weeks_numbers.forEach(week_number=>{
            useState['formAgendaCreate'][ "agenda_month" ][ mes_number ]["weeks"][ week_number ] = turno
        })
}
export let handle_agenda_month = (e)=>{
    let {mes_number,mes_name} = e.target.dataset
    let checkActive = d.querySelector(`input[name='agenda_month_${mes_number}']`).checked

    if(checkActive){
        mes_add(mes_name)
    }else{
        mes_remove(mes_name)
    }
    d.querySelectorAll(`.mes-${mes_number}`).forEach(mes=>{
        mes.checked = checkActive
    })
    handle_resultset()
    console.log(useState['formAgendaCreate'])
}
export let handle_agenda_semana = (e)=>{
    let {mes_number,mes_name,num_seman_mes,semana_number} = e.target.dataset
    let checkActive = d.querySelector(`input[name='agenda_month_${mes_number}']`)
        if(!checkActive.checked){
            checkActive.checked = true
            let mes_exist = useState['formAgendaCreate'][ "agenda_month" ].some(mes=>mes['name']===mes_number)
            if(!mes_exist){
                //ELIMINAR DE LOS MESES EXCLUIDOS EL MES QUE QUEREMOS INCLUIR
                useState['formAgendaCreate'][ "meses_excluidos" ] = useState['formAgendaCreate'][ "meses_excluidos" ].filter(mes=> mes !==mes_number)
                //AÑADIMOS EL MES
                //let mes_number = meses.findIndex(mes=>mes===mes_to_add)
                    useState['formAgendaCreate'][ "agenda_month" ].push({
                        "number":mes_number,
                        "name": mes_name,
                        "weeks": {},
                    })
            }
            console.log("Se Activó el mes de "+ mes_name)
        }
    let checkActive2 = d.querySelector(`#month_semana_${mes_number}_${num_seman_mes}`)
        console.log("checkActive",checkActive2.checked)
        if(checkActive2.checked){
            week_add(mes_number,semana_number)
        }else{
            week_remove(mes_number,semana_number)
        }
        //handle_resultset()
        console.log(useState['formAgendaCreate'])
}
export let handle_agenda_dia = (e)=>{
    let {dia_name,dia_number} = e.target.dataset
    let checkActive = d.querySelector(`#agenda_day_week_${dia_number}`).checked

    if(checkActive){
        day_add(dia_number)
        d.querySelector(`.horas-dia-${dia_number}`).checked = checkActive
    }else{
        day_remove(dia_number)
        d.querySelectorAll(`.horas-dia-${dia_number}`).forEach(mes=>{
            mes.checked = checkActive
        })
    }
    handle_resultset()
    console.log(useState['formAgendaCreate'])
}
export let handle_agenda_turno = (e)=>{
    let {
            dia_name,
            turno,
            dia_number
        } = e.target.dataset
        console.log(turno)
    let checkActive = d.querySelector(`#agenda_day_week_${dia_number}`).checked
        if(!checkActive){
            d.querySelector(`#agenda_day_week_${dia_number}`).checked =true
            handle_agenda_dia(e)
        }



        useState['formAgendaCreate']['turno'][dia_number]['total_pacientes_por_horas'] = 1
        useState['formAgendaCreate']['turno'][dia_number]['turno_name'] = turno
        useState['formAgendaCreate']['turno'][dia_number]['visibilidad'] = "todo_el_dia_publico"
        useState['formAgendaCreate']['turno'][dia_number]['hours'] = horas_generate(turno,1,"todo_el_dia_publico")
        container_horas(dia_number,dia_name)
        handle_resultset()
        console.log(useState['formAgendaCreate'])
}
export let handle_configurar_horas = (e)=>{

    let {dia_name,turno,dia_number} = e.target.dataset
    let checkboxes = document.querySelectorAll(`.horas-dia-${dia_number}`);
        for (const checkbox of checkboxes) {
            let temp_turno = checkbox.dataset['turno']
            if (temp_turno === turno) {
                checkbox.checked = true
            }
        }
        d.querySelector(`#agenda_day_week_${dia_number}`).checked =true
    let {visibilidad,total_pacientes_por_horas,hours} = useState['formAgendaCreate']["turno"][dia_number]
    //console.log("horas_privadas",hours.filter(hour=>hour['visibilidad']==="privada").map(hour=>hour['hora']))
    let horas_privadas = hours.filter(hour=>hour['visibilidad']==="privada").map(hour=>hour['hora'])
        useState['formAgendaCreate']['turno'][dia_number]['total_pacientes_por_horas'] = total_pacientes_por_horas
        useState['formAgendaCreate']['turno'][dia_number]['visibilidad'] = horas_privadas.length > 0 ? 'personalizado':visibilidad
        useState['formAgendaCreate']['turno'][dia_number]['hours'] = horas_generate(turno,total_pacientes_por_horas,visibilidad,horas_privadas)

        container_horas(dia_number,dia_name)

        $("#modelId").modal("show")
    let $modal = d.querySelector("#modelId")
        $modal.querySelector(".modal-title").textContent = `Configuración del dia ${dia_name} (${turno})`
        $modal.querySelector("select[name='visibilidad']").value = visibilidad
        $modal.querySelector("select[name='visibilidad']").dataset['dia_name'] = dia_name
        $modal.querySelector("select[name='visibilidad']").dataset['dia_number'] = dia_number
        $modal.querySelector("select[name='visibilidad']").dataset['turno'] = turno

        $modal.querySelector("select[name='pacientes_por_horas']").value = total_pacientes_por_horas
        $modal.querySelector("select[name='pacientes_por_horas']").dataset['dia_name'] = dia_name
        $modal.querySelector("select[name='pacientes_por_horas']").dataset['dia_number'] = dia_number
        $modal.querySelector("select[name='pacientes_por_horas']").dataset['turno'] = turno

        handle_resultset()
        console.log(useState['formAgendaCreate'])
}
export let handle_agenda_dia_horario = (e)=>{

    let {dia_name,turno,dia_number,hora,visibilidad} = e.target.dataset
        if(visibilidad==="privada"){
            d.querySelector("#visibilidad").value ="personalizado"
        }
        day_turno_hour_visibility_update(dia_number,hora,visibilidad)
        handle_resultset()
        console.log(useState['formAgendaCreate'])
}
export let reset_form_agenda_create = (e)=>{
    useState['formAgendaCreate']['agenda_desde'] = null
    useState['formAgendaCreate']['agenda_hasta'] = null
    useState['formAgendaCreate']['agenda'] = null
    useState['formAgendaCreate']['agenda_month'] = []
    useState['formAgendaCreate']['meses_excluidos'] = mesesEnEspanol
    useState['formAgendaCreate']['dias_excluidos']= dias_nombres
    useState['formAgendaCreate']['semanas_excluidos'] = []
    for (let semana_number = 1; semana_number <= 52; semana_number++) {
        useState['formAgendaCreate']['semanas_excluidos'].push(semana_number)
    }
    for (let index = 0; index <= 11; index++) {
        d.querySelector(`input[name='agenda_month_${index}']`).checked = false
        d.querySelectorAll(`.mes-${index}`).forEach(semana => {
            semana.checked = false
        })
    }
    for (let index = 1; index <= 6; index++) {
        d.querySelector(`input[name='month_semana_${index}']`).checked = false
    }
    d.querySelectorAll(`.agenda-dia`).forEach($check=>{
        $check.checked = false
    })
    d.querySelectorAll(`.agenda_turno`).forEach($radio=>{
        $radio.checked = false
    })
    d.querySelector("#agenda_desde").value=""
    d.querySelector("#agenda_hasta").value=""
}
export let handle_todo_el_anio = (checked) =>{
    //console.log(checked)
    if (checked) {
        document.getElementById("container_dias").innerHTML=null

        useState['formAgendaCreate']['meses_excluidos'] = []
        useState['formAgendaCreate']['dias_excluidos']= ["Sábado","Domingo"]
        useState['formAgendaCreate']['semanas_excluidos'] = []
        turno_init()
        mes_init()
        container_meses()
        container_dias()
        handle_resultset()


    } else {
        reset_form_agenda_create()
    }
    //handle_resultset()
    //configMesObject()
    console.log(useState['formAgendaCreate'])
}
export let handle_todos_los_dias = (e)=>{
    //console.log(is_empty(useState['formAgendaCreate']['agenda_month']))
    if(is_empty(useState['formAgendaCreate']['agenda_month'])){
        d.querySelector(`#todo_el_anio`).checked = true
        handle_todo_el_anio( true )
    }
    console.log(e.target.checked)


    if (e.target.checked) {
        d.querySelectorAll(`.agenda-dia`).forEach(dia => {
            dia.checked = true
            let {dia_name,dia_number} = dia.dataset
            day_add(dia_number)
        })
        d.querySelectorAll(`.agenda_turno`).forEach(turno => {
            if (turno.dataset['turno'] === "Mañana") {
                turno.checked = true
            }
        })
    } else {
        d.querySelectorAll(`.agenda-dia`).forEach(dia => {
            dia.checked = false
            let {dia_name,dia_number} = dia.dataset
            day_remove(dia_number)
        })
        d.querySelectorAll(`.agenda_turno`).forEach(turno => {
            turno.checked = false
        })


    }
    handle_resultset()
    console.log(useState['formAgendaCreate'])
}
export let handle_switch_semana = (e)=>{

    let num_seman_mes= e.target.value
    if (e.target.checked) {

        let $inputs= d.querySelectorAll(`.num-seman-mes-${num_seman_mes}`)
            $inputs.forEach($input=>{
                $input.checked=true
                let {mes_number,mes_name,semana_number} = $input.dataset
                week_remove(mes_number,semana_number)
            })
    } else {

        //let semana_n = d.querySelector(`input[name='month_semana_${num_seman_mes}']`).value
        let $inputs= d.querySelectorAll(`.num-seman-mes-${num_seman_mes}`)
            $inputs.forEach($input=>{
                $input.checked=false
                let {mes_number,mes_name,semana_number} = $input.dataset
                week_remove(mes_number,semana_number)
            })

    }
    //configMesObject()
    console.log(useState['formAgendaCreate'])
}
export let container_horas = (dia_number,dia_name)=>{

    let {total_pacientes_por_horas,turno_name,visibilidad,hours} = useState['formAgendaCreate']["turno"][dia_number]
        //console.log("hours",hours)
    let container_horas = d.querySelector("#modelId #container_horas")
        container_horas.innerHTML = null;

    let template = (data,hora_key,dia_name,day_number) => {

            let { hora, visibilidad,turno } = data
            let fecha = new Date();
                fecha = new Date( fecha.getFullYear+"-"+fecha.getMonth()+"-"+fecha.getDate()+" "+hora )

            console.log(visibilidad)
            return  `
            <div class="col-6 col-sm-6 col-lg-4">
                <div
                    class="dia-horario d-flex justify-content-between align-items-center ${(fecha.getHours() >= 13) ? 'hora-tarde dia-horario-tarde' : 'hora-dia dia-horario-dia'}">
                    <h6 class="m-0 pl-2">
                        ${horaAMPM(fecha.getHours() + ":" + String(fecha.getMinutes()).padStart(2, "0"))}
                    </h6>
                    <div class="d-flex flex-column text-nowrap">
                        <div class="text-right" title="Pública">
                            <label
                                class="cursor-pointer m-0"
                                for="hora_${hora_key}_publica"
                            >
                                <i
                                    data-visibilidad="publica"
                                    data-dia_name="${dia_name}"
                                    data-hora_key="${hora_key}"
                                    data-hora="${String(fecha.getHours()).padStart(2, "0") + ":" + String(fecha.getMinutes()).padStart(2, "0")}"
                                    data-turno="${turno}"
                                    data-dia_number="${dia_number}"
                                    class="dia-horario fas fa-lock-open cursor-pointer hora-${turno}"
                                    style="color:#a4c9a4"
                                ></i>
                            </label>
                            <input
                                id="hora_${hora_key}_publica"
                                type="radio"
                                data-visibilidad="publica"
                                data-dia_name="${dia_name}"
                                data-hora_key="${hora_key}"
                                data-hora="${String(fecha.getHours()).padStart(2, "0") + ":" + String(fecha.getMinutes()).padStart(2, "0")}"
                                data-turno="${turno}"
                                data-dia_number="${dia_number}"
                                class="dia-horario cursor-pointer"
                                ${visibilidad === "publica" ? 'checked' : ''}
                                value="publica"
                                name="hora_${hora_key}"
                            >
                        </div>
                        <div class="text-right" title="Privada">
                            <label
                                class="cursor-pointer m-0"
                                for="hora_${hora_key}_privada"
                            >
                                <i
                                    data-visibilidad="privada"
                                    data-dia_name="${dia_name}"
                                    data-hora_key="${hora_key}"
                                    data-hora="${String(fecha.getHours()).padStart(2, "0") + ":" + String(fecha.getMinutes()).padStart(2, "0")}"
                                    data-turno="${turno}"
                                    data-dia_number="${dia_number}"
                                    class="dia-horario fas fa-lock cursor-pointer hora-${turno}"
                                    style="color:#957878"
                                ></i>
                            </label>
                            <input
                                id="hora_${hora_key}_privada"
                                type="radio"
                                data-visibilidad="privada"
                                data-dia_name="${dia_name}"
                                data-hora_key="${hora_key}"
                                data-hora="${String(fecha.getHours()).padStart(2, "0") + ":" + String(fecha.getMinutes()).padStart(2, "0")}"
                                data-turno="${turno}"
                                data-dia_number="${dia_number}"
                                class="dia-horario cursor-pointer"
                                ${visibilidad === "privada" ? 'checked' : ''}
                                value="privada"
                                name="hora_${hora_key}"
                            >

                        </div>
                    </div>
                </div>
            </div>
        `;
        }


        hours.forEach( (hora,hora_key) => {
            container_horas.insertAdjacentHTML("beforeend", template(hora,hora_key,dia_name))
        })

        day_turno_update(
            [dia_name],
            turno_name,
            total_pacientes_por_horas,
            hours,
            visibilidad,
        )
}
export let mes_init = ()=>{
    useState['formAgendaCreate']['meses_excluidos'] = []
    useState['formAgendaCreate'][ "agenda_month" ] = []
    mesesEnEspanol.forEach( (mes,mes_number)=>{
        useState['formAgendaCreate'][ "agenda_month" ][mes_number] = {
            "number":mes_number,
            "name": mes,
            "weeks": {},
        }
        semana_init(mes_number)
    })
}
export let turno_init = ()=>{
    useState['formAgendaCreate'][ "dias_excluidos" ] = []
    useState['formAgendaCreate'][ "dias_excluidos" ].push("Domingo")
    useState['formAgendaCreate'][ "dias_excluidos" ].push("Sábado")
    dias_nombres.forEach( (day,day_key)=>{
        useState['formAgendaCreate'][ "turno" ][day_key] = {}
        useState['formAgendaCreate'][ "turno" ][day_key]["day"] = day
        useState['formAgendaCreate'][ "turno" ][day_key]["visibilidad"] = "todo_el_dia_publico"
        useState['formAgendaCreate'][ "turno" ][day_key]["day_value"] = day_key
        useState['formAgendaCreate'][ "turno" ][day_key]["turno_name"] = turnos[0]
        useState['formAgendaCreate'][ "turno" ][day_key]["total_pacientes_por_horas"] = 1
        useState['formAgendaCreate'][ "turno" ][day_key]["hours"] = null

        turno_horas_update(
            day_key,
            turnos[0],
            1,
            tipo_turnos[0]
        )

    })
}
export let handle_datepiker = ()=>{
    useState['datepicker'].on("changeDate", async function (e) {
        let fecha = new Date(e.date)
        //console.log(fecha.getFullYear(), fecha.getMonth(), fecha.getDate())
        //let hora = String(fecha.getHours()).padStart(2, "0")+":"+String(fecha.getMinutes()).padStart(2, "0")

        let data = {
                agenda_id          : Number(d.querySelector("#datepicker").dataset['agenda_id']),
                user_id_medico     : Number(useState['formAgendaCreate']['user_id_medico']),
                cat_especialidad_id: Number(useState['formAgendaCreate']['cat_especialidad_id']),
                centro_salud_id    : Number(useState['formAgendaCreate']['centro_salud_id']),
                year               : Number(fecha.getFullYear()),
                month              : String((fecha.getMonth()+1)).padStart(2, "0"),
                day                : String(fecha.getDate()).padStart(2, "0"),
                semana_number      : getWeek(fecha),
                dia_number         : fecha.getDay(),
            }
            let formData = new FormData()
                formData.append("data", JSON.stringify(data) )
                formData.append("_token",d.querySelector("#_token").value)
                d.querySelector(".overlay").classList.remove("d-none")
                data['citas_creadas'] = await post(location.origin+`/consultaexterna/user/medico/cita/getCitasByDay`,formData)
                console.log(data['citas_creadas'] )
                d.querySelector(".overlay").classList.add("d-none")

            d.querySelector(".fecha-hoy").textContent= `Citas del ${data['day']} de ${ meses( fecha.getMonth() ) } de ${fecha.getFullYear()}`
        let mes =  useState['formAgendaCreate']['agenda_month'].find(mes=>equalsInt(mes['number'],fecha.getMonth()))
            //console.log(mes);
        let semana = mes['weeks'][ data['semana_number'] ]
            //console.log(semana);
        let day = semana.find(dia=>equalsInt(dia['day_value'], data['dia_number']) )
            console.log(day);
        let hours = day['hours']
        let $horas = document.getElementById('listado_horas-calendario')
            $horas.innerHTML=null
            //console.log(hours)
        let $template_hora = ""
            hours.forEach(hour=>{
                let horaColor = "dia"
                    if (hour['turno']==="Tarde") {
                        horaColor = "tarde"
                    }
                    if (hour['turno']==="Todo el día") {
                        horaColor = "todo-el-dia"
                    }
                let card_paciente = (cita)=>{
                    if (!is_null(cita['telefono_movil'])) {
                        if (cita['telefono_movil'].charAt(0) === "+") {
                            cita['telefono_movil'] = cita['telefono_movil'].substring(1);
                        }
                    }
                    return /*html */`
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <img onerror="reemplaza_imagen(this)" loading="lazy" class="profile-user-img preconsulta-paciente-imagen img-fluid img-circle" src="${cita['imagen']}" style="width: 30px;height: 30px;object-fit: cover;" alt="User profile picture">
                                        </div>
                                        <h3 class="profile-username text-primary">${cita['paciente']}</h3>
                                        <i class="ml-auto mr-2 h5 text-${cita['cat_user_cita_status_id_color']}">${cita['cat_user_cita_status_description']}</i>
                                        <i class="h3 ${cita['cat_user_cita_status_id_icono']} text-${cita['cat_user_cita_status_id_color']}"></i>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class=" bg-white p-1"  style="border-radius: 10px;min-height: 112px;">
                                        <div class="p-1 text-left">
                                            <b class="text-secondary">Cédula:</b>
                                            <span class="float-right preconsulta-paciente-cedula">${cita['cedula']}</span>
                                        </div>
                                        <div class="p-1 text-left">
                                            <b class="text-secondary">Edad:</b>
                                            <span class="float-right preconsulta-paciente-edad">${cita['edad']} años</span>
                                        </div>
                                        <div class="p-1 text-left">
                                            <b class="text-secondary">Género:</b>
                                            <span class="float-right preconsulta-paciente-genero">${cita['genero'].toUpperCase()}</span>
                                        </div>
                                        <div class="p-1 text-left">
                                            <b class="text-secondary">Teléfono:</b>
                                            <a target="_blank" href="https://api.whatsapp.com/send?phone=${cita['telefono_movil']}" style="font-size: 0.7rem;padding: 0.1rem;" class="enlace-whatsapp btn btn-default btn-sm border-0 float-right preconsulta-paciente-telefono-movil">
                                                <i class="enlace-whatsapp fab fa-whatsapp text-success"></i> <span class="enlace-whatsapp">${cita['telefono_movil']}</span>
                                            </a>
                                        </div>
                                        <div class="p-1 text-left">
                                            <b class="text-secondary">Correo:</b>
                                            <span class="float-right text-wrap preconsulta-paciente-correo" style="text-overflow: ellipsis;overflow: hidden;width: 130px;">${cita['email_paciente']}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="text-left bg-white p-1" style="border-radius: 10px;min-height: 112px;">
                                        <b class="text-secondary">Motivo de consulta:</b>
                                        <p class="m-0 mt-2">${is_null(cita['cita_motivo']) ? '': cita['cita_motivo']}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `
                }
                let cita =  data['citas_creadas'].find(cita=>
                                cita['hour'] === hour['hora'] &&
                                cita['cat_especialidad_id'] === data['cat_especialidad_id'] &&
                                cita['centro_salud_id'] === data['centro_salud_id']
                            )
                    let paciente = "<div class='p-3'></div>"
                        if (!is_undefined(cita)) {
                            paciente = card_paciente(cita)
                        }
                $template_hora += /*html */ `
                    <div class="dia-horario dia-horario-${horaColor} d-flex align-items-center p-2">
                        <b class="text-nowrap">
                            ${horaAMPM(hour['hora'])} <i data-visibilidad="privada" class="${(hour['visibilidad']==="publica")?'d-none':''} dia-horario fas fa-lock" style="color:#957878"></i>
                        </b>

                        <div class="flex-grow-1  text-center p-1">
                            <!-- description -->
                            ${paciente}
                        </div>
                        <!--<div class="btn-group ${is_undefined(cita)?'d-none':''} ">
                            <button type="button" class="btn btn-default bg-transparent font-weight-bold border-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ⁞
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <button class="dropdown-item" type="button">Reprogramar</button>
                                <button class="dropdown-item" type="button">Cancelar</button>
                            </div>
                        </div>-->
                    </div>
                `
            })
            $horas.innerHTML = $template_hora
            //console.log(semana_number)
            $('a[href="#pills-horas-calendario"]').tab('show')
    })
}
export let handle_resultset = ()=>{
    useState['formAgendaCreate']['resultset'] = []
    let year = useState['formAgendaCreate']['agenda_year']
        useState['formAgendaCreate']['agenda_month'].forEach(mes=>{
                for (const weekNumber in mes['weeks']) {
                    for (const keyWeek in mes['weeks'][weekNumber]) {
                        let {day_value,hours} = mes['weeks'][weekNumber][keyWeek]
                            for (const key_hours in hours) {
                                useState['formAgendaCreate']['resultset'].push(
                                    getDatesOfWeekWithHours(
                                        weekNumber,
                                        year,
                                        day_value,
                                        hours[key_hours]
                                    )
                                )
                            }
                    }
                }
        })
    let agenda_desde = fechaAMD( first( useState['formAgendaCreate']['resultset'].map(x=>x['day'])) )
    let agenda_hasta = fechaAMD( last( useState['formAgendaCreate']['resultset'].map(x=>x['day'])) )

        document.getElementById(`agenda_desde`).value = agenda_desde
        document.getElementById(`agenda_hasta`).value = agenda_hasta

        useState['formAgendaCreate'][`agenda_desde`] = agenda_desde
        useState['formAgendaCreate'][`agenda_hasta`] = agenda_hasta

        useState['formAgendaCreate']['agenda'] = JSON.stringify({
            "turno":useState['formAgendaCreate']["turno"],
            "agenda_month":useState['formAgendaCreate']['agenda_month'],
            "dias_excluidos":useState['formAgendaCreate']['dias_excluidos'],
            "meses_excluidos":useState['formAgendaCreate']['meses_excluidos'],
            "semanas_excluidas":useState['formAgendaCreate']['semanas_excluidas'],
        })


}
function obtenerRangoSemana(año, numeroSemana) {
    const primerDiaAño = new Date(año, 0, 1);
    const diaSemanaPrimerDia = primerDiaAño.getDay(); // 0 = domingo, 1 = lunes, ..., 6 = sábado
    const diaSemanaInicioSemana = (numeroSemana - 1) * 7 + 1 - diaSemanaPrimerDia;

    const fechaInicioSemana = new Date(año, 0, diaSemanaInicioSemana);
    const fechaFinSemana = new Date(fechaInicioSemana);
    fechaFinSemana.setDate(fechaInicioSemana.getDate() + 6);

    return { inicio: fechaInicioSemana, fin: fechaFinSemana };
}
function formatearFecha(fecha) {
    const diasSemana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

    const partesFecha = fecha.split('/'); // Divide la fecha en día, mes y año
    const dia = parseInt(partesFecha[0], 10);
    const mes = parseInt(partesFecha[1], 10) - 1; // Restamos 1 porque los meses en JavaScript son base 0
    const anio = parseInt(partesFecha[2], 10);

    const fechaObjeto = new Date(anio, mes, dia);
    const diaSemana = diasSemana[fechaObjeto.getDay()];
    const nombreMes = meses[mes];

    return `${diaSemana} ${dia} de ${nombreMes}`;
}
export let container_meses = () => {

    const currentYear = new Date().getFullYear();
    let $container = document.getElementById("container_meses");
        $container.innerHTML = null;
        d.querySelector(`#todo_el_anio`).checked = true
        useState['formAgendaCreate'][ "agenda_month"].forEach(mes=>{
            let $checkBoxSemanas = ""
            let semanas = mes['weeks']
            let key_semana = 0;
            let contador= 1;
                for(let semana_number in semanas){
                    const rangoSemana = obtenerRangoSemana(currentYear, semana_number);
                    key_semana++
                    $checkBoxSemanas += `
                        <div class="mes-hover d-flex mr-2 px-2 mb-1" data-toggle="tooltip" data-placement="top" title="Semana del ${formatearFecha(rangoSemana.inicio.toLocaleDateString())} al ${formatearFecha(rangoSemana.fin.toLocaleDateString())}.">
                            <input
                                id="month_semana_${mes['number']}_${contador}"
                                style="cursor: pointer"
                                type="checkbox"
                                data-mes_number="${mes['number']}"
                                data-mes_name="${mes['name']}"
                                data-semana_number="${semana_number}"
                                data-num_seman_mes="${contador}"
                                class="input-semana mes-${mes['number']} num-seman-mes-${contador} semana-${semana_number}"
                                name="month_semana_${mes['number']}_${contador}" value="${semana_number}"
                                checked
                            >
                            <label
                                for="month_semana_${mes['number']}_${contador}"
                                style="cursor: pointer"
                                data-mes_number="${mes['number']}"
                                data-mes_name="${mes['name']}"
                                data-semana_number="${semana_number}"
                                data-num_seman_mes="${contador}"
                                class="font-weight-normal pl-1 pt-1 mb-0"
                            >
                                S${key_semana}
                            </label>
                        </div>
                    `;
                    contador++;

                }
                $container.insertAdjacentHTML("beforeend", `
                    <div class="col-3 mes-hover">
                        <input
                            id="agenda_month_${mes['number']}"
                            type="checkbox"
                            data-mes_name="${mes['name']}"
                            data-mes_number="${mes['number']}"
                            class="ml-2 cursor-pointer agenda_month"
                            name="agenda_month_${mes['number']}"
                            value="${mes['number']}"
                            checked
                        >
                        <label
                            data-mes_name="${mes['name']}"
                            data-mes_number="${mes['number']}"
                            class="cursor-pointer font-weight-normal"
                            for="agenda_month_${mes['number']}"
                        >
                            ${mes['name']}
                        </label>
                    </div>
                    <div class="col-9">
                        <div class="mes-hover d-flex flex-wrap">
                        ${$checkBoxSemanas}
                        </div>
                    </div>
                `)
        })
        for (let index = 1; index <= 7; index++) {
            let temp_imput = d.querySelector(`input[name='month_semana_${index}']`)
                if (!is_null(temp_imput)) {
                    temp_imput.checked = true
                }
        }
}
export let container_dias = () => {
    let $container = document.getElem