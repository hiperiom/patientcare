<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Orden Médica</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        body{
            background-color: #f7f7f7;
        }
        .vh-100{
            height: 100vh;
        }
        .vh-90{
            height: 87vh;
        }
        .scale-in-ver-top{-webkit-animation:scale-in-ver-top .5s cubic-bezier(.25,.46,.45,.94) both;animation:scale-in-ver-top .5s cubic-bezier(.25,.46,.45,.94) both}
        @-webkit-keyframes scale-in-ver-top{0%{-webkit-transform:scaleY(0);transform:scaleY(0);-webkit-transform-origin:100% 0;transform-origin:100% 0;opacity:1}100%{-webkit-transform:scaleY(1);transform:scaleY(1);-webkit-transform-origin:100% 0;transform-origin:100% 0;opacity:1}}@keyframes scale-in-ver-top{0%{-webkit-transform:scaleY(0);transform:scaleY(0);-webkit-transform-origin:100% 0;transform-origin:100% 0;opacity:1}100%{-webkit-transform:scaleY(1);transform:scaleY(1);-webkit-transform-origin:100% 0;transform-origin:100% 0;opacity:1}}
    </style>
  </head>
  <body>
    <div class="container p-0 d-flex flex-column vh-100">
      <h1 class="text-primary">Ordenes Médicas</h1>

      <div class="flex-grow-1 container-fluid">

        <div class="row">
          <div class="col-4 d-flex flex-column p-0 vh-90">
            <div class="d-none mb-1">
                <button class="btn mr-1 font-weight-bold btn-primary dropdown-toggle" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                  + Añadir
                </button>

              <div class="d-none dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Plantillas
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </div>
            </div>
            <h6 class="text-primary">Selecciona las ordenes a añadir:</h6>
            <div class="collapse flex-fill  bg-light rounded overflow-auto show" id="collapseExample">
              <div class="card card-body bg-transparent border-0">
                <div class="container-fluid">
                  <div id="itemDropdownList" class="row">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-8 d-flex flex-column p-0 vh-90">
            <h6 class="text-primary">Nueva Orden Médica</h6>
            <div id="form_orden_medica" class="container-fluid  overflow-auto">
              <!-- <section id="form_ubicacion">
                  <div class="d-flex">
                    <h4 class="mr-3 text-primary">1</h4>
                    <h4 class="mr-1 text-secondary">Ubicación</h4>
                </div>
                <div class="input-group mb-3">
                  <textarea class="form-control" id="newTaskInput" placeholder="Nueva tarea"></textarea>
                  <div class="input-group-append">
                    <button class="btn btn-primary" id="addTaskButton">Agregar</button>
                  </div>
                </div>
                <ul class="list-group" id="taskList">
                </ul>
              </section> -->
            </div>
          </div>
        </div>
      </div>
      <div class="flex-shrink-1 mb-3 text-center">
          <button class="btn btn-primary">Guardar</button>

      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script>
        class OrdenesMedicas{
            constructor(){
                let that = this
                this.d = document
                this.selectorForm_orden_medica = document.getElementById( "form_orden_medica")
                this.selectorItemDropdownList = document.getElementById( "itemDropdownList")
                this.clearString= function(cadena){
                return cadena.trim().normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/\s/g, "").toLowerCase();
                }
                this.order = 1
                this.inputList = [
                {
                    "order":this.order++,
                    "description":"Ubicación",
                    "form":function(data){
                    return that.renderForm1( data )
                    },
                    "handleForm":function(data){
                    return that.handleForm1( data )
                    },
                    "subnivel1":false,
                    "sub1":[],
                    "items":[],
                    "active":false,
                },
                {
                    "order":this.order++,
                    "description":"Posición",
                    "form":function(data){
                    return that.renderForm1( data )
                    },
                    "handleForm":function(data){
                    return that.handleForm1( data )
                    },
                    "subnivel1":false,
                    "sub1":[],
                    "items":[],
                    "active":false,
                },
                {
                    "order":this.order++,
                    "description":"Dieta",
                    "form":function(data){
                    return that.renderForm1( data )
                    },
                    "handleForm":function(data){
                    return that.handleForm1( data )
                    },
                    "subnivel1":false,
                    "sub1":[],
                    "items":[],
                    "active":false,
                },
                {
                    "order":this.order++,
                    "description":"Oxígeno",
                    "form":function(data){
                    return that.renderForm1( data )
                    },
                    "handleForm":function(data){
                    return that.handleForm1( data )
                    },
                    "subnivel1":false,
                    "sub1":[],
                    "items":[],
                    "active":false,
                },
                {
                    "order":this.order++,
                    "description":"Hidratación",
                    "form":function(data){
                    return that.renderForm1( data )
                    },
                    "handleForm":function(data){
                    return that.handleForm1( data )
                    },
                    "subnivel1":false,
                    "sub1":[],
                    "items":[],
                    "active":false,
                },
                {
                    "order":this.order++,
                    "description":"Agregados",
                    "form":function(data){
                    return that.renderForm1( data )
                    },
                    "handleForm":function(data){
                    return that.handleForm1( data )
                    },
                    "subnivel1":false,
                    "sub1":[],
                    "items":[],
                    "active":false,
                },
                {
                    "order": this.order++,
                    "description": "Medicamentos",
                    "form":function(data){
                    return that.renderForm1( data )
                    },
                    "handleForm":function(data){
                    return that.handleForm1( data )
                    },
                    "subnivel1": true,
                    "sub1": [
                    {
                        "order": this.order++,
                        "description": "Protector Gástrico",
                        "form":function(data){
                        return that.renderForm1( data )
                        },
                        "handleForm":function(data){
                        return that.handleForm1( data )
                        },
                        "subnivel1": false,
                        "sub1": [],
                        "items": [],
                        "active": false,
                    },
                    {
                        "order": this.order++,
                        "description": "Endovenosos",
                        "form":function(data){
                        return that.renderForm1( data )
                        },
                        "handleForm":function(data){
                        return that.handleForm1( data )
                        },
                        "subnivel1": false,
                        "sub1": [],
                        "items": [],
                        "active": false,
                    },
                    {
                        "order": this.order++,
                        "description": "Inhalatorios",
                        "form":function(data){
                        return that.renderForm1( data )
                        },
                        "handleForm":function(data){
                        return that.handleForm1( data )
                        },
                        "subnivel1": false,
                        "sub1": [],
                        "items": [],
                        "active": false,
                    },
                    {
                        "order": this.order++,
                        "description": "Subcutáneos",
                        "form":function(data){
                        return that.renderForm1( data )
                        },
                        "handleForm":function(data){
                        return that.handleForm1( data )
                        },
                        "subnivel1": false,
                        "sub1": [],
                        "items": [],
                        "active": false,
                    },
                    {
                        "order": this.order++,
                        "description": "Orales",
                        "form":function(data){
                        return that.renderForm1( data )
                        },
                        "handleForm":function(data){
                        return that.handleForm1( data )
                        },
                        "subnivel1": false,
                        "sub1": [],
                        "items": [],
                        "active": false,
                    },
                    {
                        "order": this.order++,
                        "description": "SOS",
                        "form":function(data){
                        return that.renderForm1( data )
                        },
                        "handleForm":function(data){
                        return that.handleForm1( data )
                        },
                        "subnivel1": false,
                        "sub1": [],
                        "items": [],
                        "active": false,
                    },
                    {
                        "order": this.order++,
                        "description": "Otros",
                        "form":function(data){
                        return that.renderForm1( data )
                        },
                        "handleForm":function(data){
                        return that.handleForm1( data )
                        },
                        "subnivel1": false,
                        "sub1": [],
                        "items": [],
                        "active": false,
                    },
                    ],
                    "items":[],
                },
                {
                    "order":this.order++,
                    "description":"Laboratorio",
                    "form":function(data){
                    return that.renderForm1( data )
                    },
                    "handleForm":function(data){
                    return that.handleForm1( data )
                    },
                    "subnivel1":false,
                    "sub1":[],
                    "items":[],
                    "active":false,
                },
                {
                    "order":this.order++,
                    "description":"Estudios de Imagenes",
                    "form":function(data){
                    return that.renderForm1( data )
                    },
                    "handleForm":function(data){
                    return that.handleForm1( data )
                    },
                    "subnivel1":false,
                    "sub1":[],
                    "items":[],
                    "active":false,
                },
                {
                    "order":this.order++,
                    "description":"Interconsultas",
                    "form":function(data){
                    return that.renderForm1( data )
                    },
                    "handleForm":function(data){
                    return that.handleForm1( data )
                    },
                    "subnivel1":false,
                    "sub1":[],
                    "items":[],
                    "active":false,
                },
                {
                    "order":this.order++,
                    "description":"Cuidados de enfermería",
                    "form":function(data){
                    return that.renderForm1( data )
                    },
                    "handleForm":function(data){
                    return that.handleForm1( data )
                    },
                    "subnivel1":false,
                    "sub1":[],
                    "items":[],
                    "active":false,
                },
                {
                    "order":this.order++,
                    "description":"Avisar eventualidad",
                    "form":function(data){
                    return that.renderForm1( data )
                    },
                    "handleForm":function(data){
                    return that.handleForm1( data )
                    },
                    "subnivel1":false,
                    "sub1":[],
                    "items":[],
                    "active":false,
                },


                ].sort(function(a, b) {
                return a.order - b.order;
                });

            }
            renderForm1({item="",index="",indexSub1=""}){

                console.log(item.order)
                return `
                <section id="form_ubicacion" class="scale-in-ver-top">
                    <div class="d-flex">
                        <h4 class="mr-3 text-primary">${item.order}</h4>
                        <h4 class="mr-1 text-secondary">${item.description}</h4>
                    </div>
                    <div class="input-group mb-3">
                    <input data-index="${index}" data-indexSub1="${indexSub1}" class="form-control" id="newTaskInput_${item.order}" placeholder="Escriba su indicación">
                    <div class="input-group-append">
                        <button class="btn btn-primary" id="addTaskButton_${item.order}">Agregar</button>
                    </div>
                    </div>
                    <ul class="list-group bg-light rounded" id="taskList_${item.order}">
                    </ul>
                </section>
                `
            }
            handleListItemsAdd({item="",index="",indexsub1="",resultset=[]}){
                let that= this
                resultset.forEach((x,key)=>{
                let listItem = document.createElement('li');
                    listItem.classList.add('list-group-item');
                    listItem.textContent = x.id + '. ' + x.description;

                let deleteButton = document.createElement('button');
                    deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'float-right', 'ml-2');
                    deleteButton.dataset['id']=x.id
                    deleteButton.dataset['index']=index
                    deleteButton.dataset['indexsub1']=indexsub1
                    deleteButton.dataset['key']=key
                    deleteButton.textContent = 'Eliminar';
                    deleteButton.addEventListener('click', function(e) {
                    let {index,indexsub1,id,key} = this.dataset

                    if( index !== "" && indexsub1 === "" ){
                        console.log(that.inputList[index]['items'])
                        that.inputList[index]['items'].splice(key, 1);

                        console.log(that.inputList[index]['items'])
                    }
                    if( index !== "" && indexsub1 !== "" ){
                        console.log(that.inputList[index]['sub1'][indexsub1]['items'])
                        that.inputList[index]['sub1'][indexsub1]['items'].splice(key, 1);
                        console.log(that.inputList[index]['sub1'][indexsub1]['items'])

                    }
                    this.parentNode.remove();
                    });

                    listItem.appendChild(deleteButton);


                    document.getElementById('taskList_'+item.order).appendChild(listItem);
                })
            }
            handleForm1({item="",index="",indexSub1=""}){
                let that = this
                //console.log("2-->",item)
                let taskCounter = 1;

                // Agregar tarea
                let addTaskButton = document.getElementById('addTaskButton_'+item.order);
                addTaskButton.addEventListener('click', function() {
                    let newTask = document.getElementById('newTaskInput_'+item.order);
                    //var taskTypes = [];



                    if (newTask.value !== '') {
                    let {index,indexsub1=""} = newTask.dataset
                    let resultset
                        if( index !== "" && indexsub1 === "" ){
                            that.inputList[index]['items'].push({
                            "id":taskCounter,
                            "description":newTask.value,
                            })
                            resultset = that.inputList[index]['items']
                            console.log(that.inputList[index]['items'])
                        }
                        if( index !== "" && indexsub1 !== "" ){
                            that.inputList[index]['sub1'][indexsub1]['items'].push({
                            "id":taskCounter,
                            "description":newTask.value,
                            })
                            resultset = that.inputList[index]['sub1'][indexsub1]['items']
                            console.log(that.inputList[index]['sub1'][indexsub1]['items'])
                        }

                        document.getElementById('taskList_'+item.order).innerHTML=null

                        that.handleListItemsAdd({item,index,indexSub1,resultset})



                        document.getElementById('newTaskInput_'+item.order).value = '';


                        taskCounter++;
                    }
                });
            }
            rendersubOption(option,counter,sub=""){
                let index = counter.split(".")
                return `
                <div class="col-12">
                    <div class="d-flex flex-column">
                    <div class="d-flex align-items-center m-1">
                        <input data-index="${index[0]-1}" data-indexSub1="${index[1]-1}" data-itemDescription="${option.description}" data-orderNumber="${counter}" type="checkbox" class="mx-2" name="" id="sub_orden_${counter}">
                        <label data-itemDescription="${option.description}" data-orderNumber="${counter}" class="mb-0" >
                        <b data-itemDescription="${option.description}" data-orderNumber="${counter}" class="text-primary ">${counter}</b>
                        ${option.description}
                        </label>
                    </div>
                    <div class="d-flex align-items-center m-1 pl-1">
                        ${sub}
                    </div>
                    </div>
                </div>

                `
            }
            renderDropdownOption(option,counter,sub){
                return `
                <div class="col-12">
                    <div class="d-flex flex-column">
                    <div class="d-flex align-items-center m-1">
                        <input data-index="${counter-1}" data-indexSub1="" data-itemDescription="${option.description}" data-orderNumber="${counter}" type="checkbox" class="mx-2" name="" id="orden_${counter}">
                        <label data-itemDescription="${option.description}" data-orderNumber="${counter}" class="mb-0" >
                        <b data-itemDescription="${option.description}" data-orderNumber="${counter}" class="text-primary ">${counter}</b>
                        ${option.description}
                        </label>
                    </div>
                    <div class="container-fluid p-0  pl-3">
                        <div class="row">
                        ${sub}
                        </div>
                    </div>
                    </div>
                </div>
                `
            }
            handleItemOption(e){
                let {d}= this
                let that= this
                if(e.target.matches("input[type='checkbox']")){
                this.selectorForm_orden_medica.innerHTML =null

                let {ordernumber,index,indexsub1} = e.target.dataset


                let selectorLevel1Activo = d.querySelector(`#itemDropdownList input[id='orden_${ordernumber}']`)
                    if(selectorLevel1Activo!==null){

                        if( selectorLevel1Activo.checked ){
                            that.inputList[index]['active'] =  true
                        }else{
                        that.inputList[index]['active'] =  false
                        }
                    }
                let selectorLevel2Activo = d.querySelector(`#itemDropdownList input[id='sub_orden_${ordernumber}']`)
                    if(selectorLevel2Activo!==null){
                        if( selectorLevel2Activo.checked ){
                            that.inputList[index]["sub1"][indexsub1]['active'] =  true
                        }else{
                        that.inputList[index]["sub1"][indexsub1]['active'] =  false
                        }
                    }


                    that.inputList.forEach((item,index)=>{
                    if(item.active){
                        that.selectorForm_orden_medica.insertAdjacentHTML("beforeend",item.form( {item,index} ))
                        item.handleForm({item,index})
                    }
                    if(item.subnivel1){
                        item.sub1.forEach((item2,indexSub1)=>{
                        if(item2.active){
                            that.selectorForm_orden_medica.insertAdjacentHTML("beforeend",item2.form( {item:item2,index,indexSub1} ))
                            console.log("1-->",item2)
                            item2.handleForm({item:item2,index,indexSub1})
                        }
                        })
                    }
                    })
                }

            }
            configIemDropdownList(){
                let {d}= this
                let that= this
                //Limpiamos el formulario
                this.selectorItemDropdownList.innerHTML  = null

                //creamos un nuevo objeto de items
                let optionsList = JSON.parse(JSON.stringify(this.inputList))

                //mapeamos el objeto para convertirlo en contenido HTML
                let optionList = optionsList.map((option,counter)=>{
                    let subOptionList = ""
                    if(option.subnivel1){
                        subOptionList = option.sub1.map( (suboption,subcounter)=>{
                            return that.rendersubOption(
                            suboption,
                            `${counter+1}.${subcounter+1}`,
                            subOptionList
                            )
                        }).join(" ")

                    }

                    return that.renderDropdownOption(
                        option,
                        counter+1,
                        subOptionList
                    )
                }).join(" ")

                //asignamos el contenido HTML al contenedor de opciones del menú

                this.selectorItemDropdownList.innerHTML = optionList

                this.selectorItemDropdownList.addEventListener("click",(e)=>{
                    that.handleItemOption(e)
                })
            }
            config(){
                let {d}= this
                this.configIemDropdownList()

            }
        }

        let model = new OrdenesMedicas()
            model.config()

    </script>

</body>
</html>
