<template>
	<div class="d-flex flex-column vh-100 overflow-auto p-2 p-md-4">
		<header>
			<nav class="d-flex justify-content-bewteen">
				<div class="col-8 col-md-4 col-lg-3 d-flex flex-column glassmod-effect rounded-pill px-4 mr-2 justify-content-center h1 mb-0">
					<div class="d-flex flex-column">
						<div class="d-flex flex-column align-items-start">
							<div class="text-white" style="font-size: 1rem;">
								EVENTOS ESPECIALES
							</div>
							<div class="header-titles text-warning">
								PÁDEL FABRICE PASTOR CUP
							</div>
						</div>
					</div>

				</div>
				<div class="flex-grow-1 d-flex justify-content-end">
					<img  class="img-logo"  src="https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg" alt="Logo CMDLT">
				</div>
			</nav>
			<div class=" p-0">
				<div class="col-12 col-md-4 col-lg-3 header-date pl-4 mt-1 mb-1 mb-sm-3 text-white text-nowrap rounded-pill glassmod-effect p-1">
					{{ formattedDate }}
				</div>
			</div>


		</header>
		<div class="flex-fill d-flex justify-content-center align-items-md-center">
			<div class="container p-sm-0">

				<div class="row justify-content-center align-items-center">

					<div class="col-12 col-sm-12 col-md-6 p-0 p-sm-0">
						<div class="text-white text-center text-shadow">
							<div class="d-none d-block d-sm-block d-md-block h5">
								Atención al paciente
							</div>
							<div class="glassmod-effect rounded-pill-1 p-1">
							  <div data-tippy-content="Total Pacientes Atendidos desde el inicio del evento especial." class="tooltip-primary d-flex align-items-center justify-content-center">
								<i class="d-none d-md-block pc-paciente display-4 mr-2"></i>
								<div class="display-3 ">
								  {{ pacientes['total'] }}
								</div>  
							  </div>
							  <div class="d-flex  justify-content-center align-items-center mx-2">
								<div class="d-flex flex-column align-items-center pr-3 pr-sm-0">
									<div class="mr-1">Hoy</div>
									<div data-tippy-content="Total de Pacientes Atendidos hoy en el evento especial." class="tooltip-primary font-weight px-1 display-4">{{ pacientes['hoy'] }}</div>
								</div>
								<div class="d-flex flex-column align-items-center pl-3 pr-sm-0">
									<div class="mr-1">Promedio Pac/dia</div>
									<div data-tippy-content="Promedio de Pacientes Atendidos por dia en el evento especial." class="tooltip-primary font-weight px-1 display-4">{{ pacientes['promedio']() }}</div>
								</div>
							  </div>

							</div>
						</div>
					</div>

					
					<!-- <div class="col-12 p-0">
						<div class="text-white  text-shadow mt-2">
							<div class="d-none text-center d-block d-sm-block d-md-block h5">
							  Totales por día
							</div>
							<div class="glassmod-effect table-responsive rounded-pill-1 p-2">
							  <table class="table table-bordered mb-0 text-white">
								<tr class="rounded-top-pill">
								  <th class="text-center ">AREAS</th>
								  <td v-for="(item,index) in $store.state.nuevosGroup_pacientesPorDia" class="text-center">
									<div class="d-flex justify-content-center">
									  <b class="mr-2">{{item.dia_nombre}}</b>
									  <div>{{item.dia_mes}}</div>
									</div>
								  </td>
								  
								</tr>
								<tr>
								  <th class="text-nowrap">Atención al paciente</th>
								  <td v-for="(item,index) in $store.state.nuevosGroup_pacientesPorDia" class="text-center">
									{{item.total_atencionPaciente.length}}
								  </td>
								</tr>
								<tr>
								  <th class="text-nowrap">Stand</th>
								  <td v-for="(item,index) in $store.state.nuevosGroup_pacientesPorDia" class="text-center">
									{{item.total_stand.length}}
								  </td>
								</tr>
							  </table>

							</div>
						</div>
					</div> -->
				</div>

			</div>
		</div>
	</div>
</template>

<script scoped>
	let meses= (p)=>{
			let mes = [
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
				"Diciembre",
				"Enero"
			]
			return mes[p];
		}
	let is_null= (params)=>{
			return (params === null || params === "null") ? true : false
		}
	let is_empty= (params)=>{
			return (params === "") || (params.length === 0) ? true : false
		}
	let is_undefined= (params)=>{
			return (params === undefined || params === "undefined") ? true : false
		}
	let activarTooltip =()=>{
            let array = ['primary','danger','success','info','warning','secondary','cyan','gray','purple','orange']
            for (let index = 0; index <= array.length; index++) {
                let element = array[index];
                tippy('.tooltip-'+element, {
                    allowHTML: true,
                    theme: 'tooltip-cmdlt-'+element,
                    zIndex: 200000
                })
            }
        }		
	let formatAMPM= (date)=>{

			let hours = date.getHours();
			let minutes = date.getMinutes();
			let seconds = date.getSeconds();
			let ampm = hours >= 12 ? 'PM' : 'AM';
				hours = hours % 12;
				hours = hours ? hours : 12; // the hour '0' should be '12'
				minutes = minutes < 10 ? '0' + minutes : minutes;
			let strTime = hours.toString().padStart(2,'0') + ':' + minutes.toString().padStart(2,'0')  + ' '+ampm; //+ ':'+ seconds.toString().padStart(2,'0') + ' ' + ampm;

			return strTime;
		}
	export default {
		name:"AppEventoEspecial2",
		methods: {
			fechaAMD: ()=> {
				let hoy = new Date();
				return   hoy.getDate().toString().padStart(2,'0') + "-" + (hoy.getMonth()+1).toString().padStart(2,'0') + "-" + hoy.getFullYear() 
			},
			
			formatDate: (f)=>{
				return meses(f.getMonth()).toUpperCase()+ " " + f.getDate().toString().padStart(2,'0') + ", DE " + f.getFullYear()  ;
			},
			numberToStr: (number)=>{
				return number.toString().padStart(2,'0')
			},
			fetchData: async () => {
				try {
					const response = await fetch('/vistas/v_ee_reporte_diario');
					const responseData = await response.json();
					return responseData;
				} catch (error) {
					console.error('Error al obtener los datos:', error);
				}
				return false
			},
			diasEventos: function(){
				return Array.from(new Set(this.$store.state.pacientes.map(x=>x.ingreso)))
			},
			nuevosPacientesHoy:function(){
				return this.$store.state.pacientes.filter(x=>x.ingreso === this.fechaAMD())
			},
			total_pacientes_por_dia:function(data){
				return data.map(x=>x.total.length)
			},
			suma_total:function(data){
				return data.reduce((total, valor) => total + valor, 0);
			},
			promedio:function(){
				return this.$store.state.sumaTotal / this.$store.state.total_pacientes_por_dia.length;
			},
			getPacientes: async function(){
				this.$store.state.nuevosPacientes =  await this.fetchData()
				this.$store.dispatch("updatePacientes")
				activarTooltip()

				this.$store.state.nuevosDiasEventos = this.diasEventos()
				this.$store.dispatch("updateDiasEventos")

				this.$store.state.nuevosGroup_pacientesPorDia = this.group_pacientesPorDia()
				this.$store.dispatch("updateGroupPacientesPorDia")

				this.$store.state.nuevosPacientesHoy = this.nuevosPacientesHoy()
				this.$store.dispatch("updateNuevosPacientesHoy")

				this.$store.state.nuevosTotal_pacientes_por_dia = this.total_pacientes_por_dia(this.$store.state.group_pacientesPorDia)
				this.$store.dispatch("updateTotal_pacientes_por_dia")

				this.$store.state.nuevosSumaTotal = this.suma_total(this.$store.state.total_pacientes_por_dia)
				this.$store.dispatch("updateSumaTotal")

				this.$store.state.nuevosPromedio = this.promedio()
				this.$store.dispatch("updatePromedio")
			},
			group_pacientesPorDia:function(){
				return this.$store.state.diasEventos.map(x=>{
					let f = x.split("-")
					const fecha = new Date(`${f[2]}-${f[1]}-${String(Number(f[0]))}`);

					const numeroDiaSemana = fecha.getDay();
					
					return this.$store.state.nuevosPacientesPorDia[x]= {
						"total": this.$store.state.pacientes.filter(z=>z.ingreso === x),
						"dia_nombre": this.$store.state.nombresDiasSemana[ numeroDiaSemana ].slice(0,3).toUpperCase(),
						"dia_mes": fecha.getDate().toString().padStart(2,'0'),
						"total_atencionPaciente": this.$store.state.pacientes.filter(z=>z.ingreso === x && z.cat_user_ubicacion_id===this.$store.state.ubicacion_id_ap),
						"total_stand": this.$store.state.pacientes.filter(z=>z.ingreso === x && z.cat_user_ubicacion_id===this.$store.state.ubicacion_id_stand),
					}
				})
			},
			getPromedio:(pacientes)=>{
				//console.log(pacientes   )
				//let pacientes = this.$store.state.pacientes
				let dias_eventos = Array.from(new Set(pacientes.map(x=>x.ingreso)))
				let pacientesPorDia = []
				let group_pacientesPorDia = dias_eventos.map(x=>{
						let f = x.split("-")
						const fecha = new Date(`${f[2]}-${f[1]}-${String(Number(f[0]))}`);

						const numeroDiaSemana = fecha.getDay();
						return pacientesPorDia[x]= {
						"total": pacientes.filter(z=>z.ingreso === x),
						"dia_nombre": nombresDiasSemana[ numeroDiaSemana ].slice(0,3).toUpperCase(),
						"dia_mes": fecha.getDate().toString().padStart(2,'0'),
						"total_atencionPaciente": pacientes.filter(z=>z.ingreso === x && z.cat_user_ubicacion_id===233),
						"total_stand": response.filter(z=>z.ingreso === x && z.cat_user_ubicacion_id===232),
						}
					})
				let pacientesHoy = pacientes.filter(x=>x.ingreso === fechaAMD())
				let total_pacientes_por_dia = group_pacientesPorDia.map(x=>x.total.length)
				let sumaTotal = total_pacientes_por_dia.reduce((total, valor) => total + valor, 0);
				let promedio = sumaTotal / total_pacientes_por_dia.length;

				return promedio
			}
		},
		computed: {
			formattedDate () {
				return is_null(this.$store.state.fechaActual ) ? '':this.formatDate( this.$store.state.fechaActual )
			},
			pacientes(){
				return {
					total: this.$store.state.pacientes.length,
					hoy:  this.$store.state.pacientes.filter(x=>x.ingreso === this.fechaAMD()).length,
					promedio: ()=>{
						return Math.round(this.$store.state.pacientes.length / this.$store.state.diasEventos.length)
					} 
				}
			},
			stand(){
				return {
					total:  this.$store.state.pacientes.filter(x=>x['cat_user_ubicacion_id'] === this.$store.state.ubicacion_id_stand).length,
					hoy:  this.$store.state.pacientes.filter(x=>x.ingreso === this.fechaAMD() && x['cat_user_ubicacion_id'] === this.$store.state.ubicacion_id_stand ).length,
					promedio: ()=>{
						return Math.round(this.$store.state.pacientes.filter(x=>x['cat_user_ubicacion_id'] === this.$store.state.ubicacion_id_stand).length / this.$store.state.diasEventos.length)
					} 
				} 
			},
			atencionPaciente(){
				return {
					total:  this.$store.state.pacientes.filter(x=>x['cat_user_ubicacion_id'] === this.$store.state.ubicacion_id_ap ).length,
					hoy:  this.$store.state.pacientes.filter(x=>x.ingreso === this.fechaAMD() && x['cat_user_ubicacion_id'] === this.$store.state.ubicacion_id_ap ).length,
					promedio: ()=>{
						return Math.round(this.$store.state.pacientes.filter(x=>x['cat_user_ubicacion_id'] === this.$store.state.ubicacion_id_ap ).length / this.$store.state.diasEventos.length)
					} 
				} 
			},
			
		
		
		},
		mounted: async function () {
			this.getPacientes()
			
			const intervalId = setInterval(() => {
				this.$store.state.nuevaFecha =  new Date()
				this.$store.dispatch("updateFechaActual")
			}, 1000);
			
			const intervalId2 = setInterval( async () => {
				this.getPacientes()

			}, 10000);

		}
	};
</script>
<style>
.tippy-box[data-theme~='tooltip-cmdlt-primary'] {
	background-color: var(--primary);
	color: white;
}

.tippy-box[data-theme~='tooltip-cmdlt-primary'][data-placement^='top']>.tippy-arrow::before {
	border-top-color: var(--primary);
}

.tippy-box[data-theme~='tooltip-cmdlt-primary'][data-placement^='bottom']>.tippy-arrow::before {
	border-bottom-color: var(--primary);
}

.tippy-box[data-theme~='tooltip-cmdlt-primary'][data-placement^='left']>.tippy-arrow::before {
	border-left-color: var(--primary);
}

.tippy-box[data-theme~='tooltip-cmdlt-primary'][data-placement^='right']>.tippy-arrow::before {
	border-right-color: var(--primary);
}

.piso {
	display: flex;
	justify-content: betwen;
	align-items: center;
	position: relative;
	/* margin: 2px 0 2px 0; */
	padding: 0.3rem 0.3rem 0.3rem 0.3rem;
	text-shadow: 2px 2px 5px rgba(43, 19, 12, 0.50);
	box-shadow: 0px 23px 12px -20px rgb(255 255 255 / 20%);
	;
	-webkit-box-shadow: 0px 23px 12px -20px rgb(255 255 255 / 20%);
	-moz-box-shadow: 0px 23px 12px -20px rgb(255 255 255 / 20%);
}

.text-shadow {
	text-shadow: 2px 2px 5px rgba(43, 19, 12, 0.50);
}

.column-1 {
	min-width: 90px;
	font-size: 1.5rem;
	font-weight: 500;

}

.column-2 {
	font-size: 2rem;
	font-weight: 500;
	display: flex;
	align-items: center;
	justify-content: center;
	height: 100%;
	width: 70px;

}

/* .column-3 {

            } */
.shadow-bottom {
	box-shadow: 0px 23px 12px -20px rgba(107, 107, 107, 1);
	-webkit-box-shadow: 0px 23px 12px -20px rgba(107, 107, 107, 1);
	-moz-box-shadow: 0px 23px 12px -20px rgba(107, 107, 107, 1);
}


.arrow-right {
	width: 0;
	height: 0;
	border-top: 15px solid transparent;
	border-bottom: 15px solid transparent;
	border-left: 15px solid rgb(255 255 255 / 30%);
}


.bed-on {
	opacity: 1
}

.bed-off {
	opacity: 0.1
}

.badge {
	width: 40px;
	color: white;
	border: 1px solid #ffffff;
	font-size: 1rem;
}

body {

	/*https://www.cmdlt.edu.ve/wp-content/uploads/2020/01/medicina-cmdlt.jpg*/
	/* background: url("http://drive.google.com/uc?export=view&id=1lOnAmjJm26ZhK9j0ERYKlSv58rInMWjG") no-repeat center center fixed; */
	/*  background: url("https://patientcare.cmdlt.pstelemed.com/image/system/background_hosp.jpg") no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover; */

	/* background: rgb(0,58,126);
                            background: linear-gradient(269deg, rgb(24 84 155) 0%, rgb(10 62 135) 60%) rgb(255 58 58) 52%; */
							background: rgb(24,91,169);
							background: radial-gradient(circle, rgba(24,91,169,1) 0%, rgba(160,204,255,1) 0%, rgba(24,91,169,1) 100%);
	/*background: rgb(18, 71, 133);*/
	/*background: linear-gradient(90deg, rgba(24, 91, 169, 1) 0%, rgba(108, 175, 247, 1) 48%, rgba(24, 91, 169, 1) 100%);
		*/
}


.glassmod-effect {
	background-color: rgb(255 255 255 / 30%);
	backdrop-filter: blur(20px);
}

.rotate-in-ver {
	-webkit-animation: rotate-in-ver .5s cubic-bezier(.25, .46, .45, .94) both;
	animation: rotate-in-ver .5s cubic-bezier(.25, .46, .45, .94) both
}

@-webkit-keyframes rotate-in-ver {
	0% {
		-webkit-transform: rotateY(-360deg);
		transform: rotateY(-360deg);
		opacity: 0
	}

	100% {
		-webkit-transform: rotateY(0deg);
		transform: rotateY(0deg);
		opacity: 1
	}
}

@keyframes rotate-in-ver {
	0% {
		-webkit-transform: rotateY(-360deg);
		transform: rotateY(-360deg);
		opacity: 0
	}

	100% {
		-webkit-transform: rotateY(0deg);
		transform: rotateY(0deg);
		opacity: 1
	}
}

.scale-in-ver-top {
	-webkit-animation: scale-in-ver-top .5s cubic-bezier(.25, .46, .45, .94) both;
	animation: scale-in-ver-top .5s cubic-bezier(.25, .46, .45, .94) both
}

@-webkit-keyframes scale-in-ver-top {
	0% {
		-webkit-transform: scaleY(0);
		transform: scaleY(0);
		-webkit-transform-origin: 100% 0;
		transform-origin: 100% 0;
		opacity: 1
	}

	100% {
		-webkit-transform: scaleY(1);
		transform: scaleY(1);
		-webkit-transform-origin: 100% 0;
		transform-origin: 100% 0;
		opacity: 1
	}
}

@keyframes scale-in-ver-top {
	0% {
		-webkit-transform: scaleY(0);
		transform: scaleY(0);
		-webkit-transform-origin: 100% 0;
		transform-origin: 100% 0;
		opacity: 1
	}

	100% {
		-webkit-transform: scaleY(1);
		transform: scaleY(1);
		-webkit-transform-origin: 100% 0;
		transform-origin: 100% 0;
		opacity: 1
	}
}

.scale-in-hor-left {
	-webkit-animation: scale-in-hor-left .5s cubic-bezier(.25, .46, .45, .94) both;
	animation: scale-in-hor-left .5s cubic-bezier(.25, .46, .45, .94) both
}

@-webkit-keyframes scale-in-hor-left {
	0% {
		-webkit-transform: scaleX(0);
		transform: scaleX(0);
		-webkit-transform-origin: 0 0;
		transform-origin: 0 0;
		opacity: 1
	}

	100% {
		-webkit-transform: scaleX(1);
		transform: scaleX(1);
		-webkit-transform-origin: 0 0;
		transform-origin: 0 0;
		opacity: 1
	}
}

@keyframes scale-in-hor-left {
	0% {
		-webkit-transform: scaleX(0);
		transform: scaleX(0);
		-webkit-transform-origin: 0 0;
		transform-origin: 0 0;
		opacity: 1
	}

	100% {
		-webkit-transform: scaleX(1);
		transform: scaleX(1);
		-webkit-transform-origin: 0 0;
		transform-origin: 0 0;
		opacity: 1
	}
}

.vh-100 {
	height: 100vh;
}

.row_counter_user div:nth-child(1) {
	width: 15px;
	text-align: center;
}

.row_counter_user div:nth-child(2) {
	width: 30px;
	text-align: center;
}

.rounded-pill-1 {
	border-radius: 20px;
}

.rounded-top-pill {
	border-top-right-radius: 20px;
	border-top-left-radius: 20px;
}

.rounded-bottom-pill {
	border-bottom-right-radius: 20px;
	border-bottom-left-radius: 20px;
}



/*****/
.total-title {
	font-size: 1rem;
	font-weight: 700;
}

.total-counter {
	line-height: 1;
}

/*****/
.total-counter,
.total-counter-hp,
.total-counter-uti {
	min-width: 70px;
}

@media (max-width: 576px) {
	header .img-logo {
		height: 40px;
		width: auto;
	}

	.header-titles {
		font-size: 1rem;
	}

	.piso-height {
		height: auto;
	}

	.total-icon {
		font-size: 3rem !important;
	}

	.total-counter,
	.total-counter-hp,
	.total-counter-uti {
		font-size: 4rem;
		line-height: 1;
	}

	header .h1 {
		font-size: 1rem !important;
	}

	header .h3 {
		font-size: 1rem !important;
	}


}

@media (min-width: 576px) {
	header .img-logo {
		height: 40px;
		width: 120px;
	}

	.piso-height {
		height: auto;
	}

	.header-titles {
		font-size: 1.5rem;
	}


	.total-icon {
		font-size: 4em;
	}

	.total-title {
		font-size: 1rem;
		font-weight: 700;
	}

	.total-counter,
	.total-counter-hp,
	.total-counter-uti {
		font-size: 4rem;

	}

	.pc-cama_ocupada,
	.fa-bed {
		font-size: 0.6rem;
	}

	header .h1 {
		font-size: 2rem !important;
	}

	header .h3 {
		font-size: 2rem !important;
	}
}

@media (min-width: 992px) {
	.total-icon {
		font-size: 5em;
	}

	.header-titles {
		font-size: 1.5rem;
	}
}</style>
