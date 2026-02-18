(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[10],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _FormSolicitud_vue_00001__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./FormSolicitud.vue?00001 */ "./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?00001");
 // Importa la biblioteca Select2

/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    FormSolicitud: _FormSolicitud_vue_00001__WEBPACK_IMPORTED_MODULE_0__["default"]
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=script&lang=js&00001":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=script&lang=js&00001 ***!
  \**********************************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _helpers_customHelpers_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../helpers/customHelpers.js */ "./resources/js/helpers/customHelpers.js");
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var select2_dist_css_select2_min_css__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! select2/dist/css/select2.min.css */ "./node_modules/select2/dist/css/select2.min.css");
/* harmony import */ var select2_dist_css_select2_min_css__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(select2_dist_css_select2_min_css__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var select2__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! select2 */ "./node_modules/select2/dist/js/select2.js");
/* harmony import */ var select2__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(select2__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _Todolist_vue__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./Todolist.vue */ "./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Todolist.vue");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }



 // Importa los estilos CSS de Select2
//import TodolistDropdownWithFilter from './IndexQuirofano/TodolistDropdownWithFilter.vue'

 // Importa la biblioteca Select2
//import Multiselect from 'vue-multiselect';
//import 'vue-multiselect/dist/vue-multiselect.min.css'; // Importa los estilos CSS

 // Importa la biblioteca Select2

/* harmony default export */ __webpack_exports__["default"] = ({
  props: {
    edit_solicitudaaaaa: {
      type: Boolean,
      "default": false
    }
  },
  data: function data() {
    return {
      edad: 0,

      /* numeroSeleccionado: null, */
      numeros: Array.from({
        length: 24
      }, function (_, index) {
        return index + 1;
      }) // Genera un arreglo con números del 1 al 24

    };
  },
  components: {
    Todolist: _Todolist_vue__WEBPACK_IMPORTED_MODULE_5__["default"] //TodolistDropdownWithFilter,
    //Multiselect

  },
  computed: {
    is_hospitalizacion: function is_hospitalizacion() {
      console.log("1---->", this.$store.state.formReservacionQuirofano.cat_user_ubicacion_id);
      return this.$store.state.formReservacionQuirofano.area_intervencion === 418 ? true : false;
    },
    getComputedIntervenciones: function getComputedIntervenciones() {
      var model = this.$store.state.formReservacionQuirofano.intervencion; //console.log("intervenciones",model)

      return model;
    },
    getCatUbicacionAreas: function getCatUbicacionAreas() {
      return this.$store.state.catUbicacion.filter(function (item) {
        return [418, 419].includes(item['id']);
      }).sort(function (a, b) {
        return a.orden - b.orden;
      });
    },
    getCatUbicacionAreas2: function getCatUbicacionAreas2() {
      return this.$store.state.catUbicacionTemp2.sort(function (a, b) {
        return a.orden - b.orden;
      });
    },
    getCatUbicacionAreas3: function getCatUbicacionAreas3() {
      return this.$store.state.catUbicacionTemp3.sort(function (a, b) {
        return a.orden - b.orden;
      });
    },
    getCatUbicacionAreas4: function getCatUbicacionAreas4() {
      return this.$store.state.catUbicacionTemp4.sort(function (a, b) {
        return a.orden - b.orden;
      });
    },
    calcularEdad: function calcularEdad() {
      var fechaNacimiento = new Date(this.$store.state.formReservacionQuirofano.fnacimiento);
      var fechaActual = new Date();
      var diferencia = fechaActual - fechaNacimiento;
      var edadEnMilisegundos = new Date(diferencia); // Extraer el año de la fecha de nacimiento

      var edad = Math.abs(edadEnMilisegundos.getUTCFullYear() - 1970); //console.log(edad)

      return String(edad) === "NaN" ? 0 : edad;
    },
    equipoCirugiaPrincipales: function equipoCirugiaPrincipales() {
      return this.$store.state.listadoEquipoCirugia;
    },
    equipoAnestesiologos: function equipoAnestesiologos() {
      return this.$store.state.listadoAnestesiologos;
    },
    uploadedFile: function uploadedFile() {
      return this.$store.state.formReservacionQuirofano.uploadedFile;
    },
    searchingCedula: function searchingCedula() {
      return this.$store.getters.searchingCedula;
    }
  },
  methods: {
    getProced: function getProced(filter, index) {
      var stringSearch = this.$store.state.formReservacionQuirofano.intervencion[index]['description'][filter].toLowerCase().trim();
      var results = this.$store.state.procedimientos.filter(function (x) {
        if (x[filter].toLowerCase().trim().match(stringSearch)) {
          return x;
        }
      }); //console.log(results)
      //this.inputIntervencion.resultset = results

      this.$store.state.formReservacionQuirofano.intervencion[index]['description']['resultset'] = results; //this.$store.state.formReservacionQuirofano.intervencion[index][filter]=""
    },
    getGrupoEquipoSalud: function getGrupoEquipoSalud(especialidad) {
      var result = this.$store.state.personal_salud.filter(function (x) {
        return x['especialidad'] === especialidad;
      });
      return Object(_helpers_customHelpers_js__WEBPACK_IMPORTED_MODULE_1__["is_empty"])(result) ? [] : result.map(function (x) {
        return {
          id: x['user_id'],
          description: x['medico']
        };
      }).sort(function (a, b) {
        return a.description - b.description;
      });
    },
    addIntervencion: function addIntervencion() {
      var intervencion = this.$store.state.formReservacionQuirofano.intervencion;
      console.log(intervencion);
      var index = intervencion.length - 1;
      /* if (is_empty(intervencion[index]['description'])) {
          alert("Escribe una descripción de la Intervención, procedimiento o estudio a realizar.")
          //$(this.$refs['description_'+index]).next('.select2').find('.select2-selection').focus()
          console.log( this.$refs)
          this.$refs['description_'+index][0].focus()
          return false
      } */
      //console.log(intervencion[index]['cirujano_principal'])

      /* if (intervencion[index]['cirujano_principal'].length === 0) {
          alert("Selecciona al menos un Cirujano principal.")
          console.log(  $(this.$refs['cirujano_principal_'+index][0] ) )
          //$(this.$refs['cirujano_principal_'+index][0] ).focus()
          //this.$refs['cirujano_principal_'+index].focus()
          return false
      } */
      //console.log(intervencion)

      intervencion.push({
        description: {
          codigo: '',
          description: '',
          kitsum_asociado: '',
          resultset: []
        },
        cirujano_principal: [],
        ayudante_1: [],
        ayudante_2: [],
        ayudante_3: [],
        anestesiologo: [],
        equipos_especiales: [],
        deleted: false
      });
      this.$store.commit('updateFormField', {
        formName: 'formReservacionQuirofano',
        fieldName: "intervencion",
        fieldValue: intervencion
      });
      intervencion = this.$store.state.formReservacionQuirofano.intervencion;
      index = intervencion.length - 1; //console.log("--->",index)

      this.initSelect2(index);
    },
    destroyItem: function destroyItem(item_index) {
      var intervencion = this.$store.state.formReservacionQuirofano.intervencion;
      var newItems = intervencion.filter(function (item, index) {
        if (Number(item_index) === Number(index)) {
          item['deleted'] = true;
        }

        return item;
      });
      this.$store.commit('updateFormField', {
        formName: 'formReservacionQuirofano',
        fieldName: "intervencion",
        fieldValue: newItems
      });
    },
    addIntervencionItem: function addIntervencionItem(intervencion_index, item) {
      var codigo = item.codigo,
          description = item.description,
          kitsum_asociado = item.kitsum_asociado; //let newArray =
      //this.$store.state.formReservacionQuirofano.intervencion['description'][intervencion_index]['description']['codigo']=item['codigo']
      //this.$store.state.formReservacionQuirofano.intervencion['description'][intervencion_index]['description']['description']=item['description']
      //this.$store.state.formReservacionQuirofano.intervencion['description'][intervencion_index]['description']['kitsum_asociado']=item['kitsum_asociado']
      //let intervencion = this.$store.state.formReservacionQuirofano.intervencion
      //let selected = this.$refs[ref]

      /* if(is_empty(selected[0].options[ selected[0].options.selectedIndex ].value)){
          alert("Selecciona una opción")
          selected[0].focus()
          return false
      } */
      //console.log(selected[0].options[ selected[0].options.selectedIndex ].value)

      /* intervencion[intervencion_index][ref].push({
          id:Number(selected[0].options[ selected[0].options.selectedIndex ].value),
          description:selected[0].options[ selected[0].options.selectedIndex ].text
      }) */

      this.$store.commit('updateItemFormField', {
        index: intervencion_index,
        formName: 'formReservacionQuirofano',
        fieldName: "description",
        fieldValue: {
          codigo: codigo,
          description: description,
          kitsum_asociado: kitsum_asociado,
          resultset: []
        }
      });
    },
    destroyIntervencionItem: function destroyIntervencionItem(intervencion_index, ref, item_index) {
      var intervencion = this.$store.state.formReservacionQuirofano.intervencion;
      var newItems = intervencion[intervencion_index][ref].filter(function (item, index) {
        if (Number(item_index) !== Number(index)) {
          return item;
        }
      });
      intervencion[intervencion_index][ref] = newItems;
      this.$store.commit('updateFormField', {
        formName: 'formReservacionQuirofano',
        fieldName: "intervencion",
        fieldValue: intervencion
      });
    },
    updateIntervencionDescription: function updateIntervencionDescription(intervencion_index, ref) {
      var intervencion = this.$store.state.formReservacionQuirofano.intervencion;
      var input = this.$refs[ref + '_' + intervencion_index][0]; //console.log(intervencion_index,ref,input)

      intervencion[intervencion_index][ref] = input.value;
      this.$store.commit('updateFormField', {
        formName: 'formReservacionQuirofano',
        fieldName: "intervencion",
        fieldValue: intervencion
      });
    },
    handleDestino: function handleDestino(param) {
      console.log(param);
      var resultA = [];
      var resultB = false;
      var ubicaciones_level = this.$refs['level' + param].value;
      console.log("--->" + ubicaciones_level);
      var value = Number(ubicaciones_level);
      var fieldName = this.$refs['level' + param].dataset['fieldname']; //console.log("value",value)

      ubicaciones_level = ubicaciones_level !== "" && ubicaciones_level !== "418" ? ubicaciones_level.split(",").map(function (item) {
        return Number(item);
      }) : [];
      console.log(ubicaciones_level);

      if (Number(param) === 0) {
        for (var index = Number(param); index <= 4; index++) {
          this.$store.commit("updateProperty", {
            fieldName: "ubicaciones_level" + index,
            fieldValue: resultA
          });
          this.$store.commit("updateProperty", {
            fieldName: "inputLv" + index,
            fieldValue: resultB
          });
        }
      }

      if (ubicaciones_level.length > 0) {
        resultA = this.$store.state.catUbicacion.filter(function (item) {
          return ubicaciones_level.includes(Number(item['parent_cat_user_ubicacion_id']));
        }).map(function (item) {
          return {
            "id": item.id,
            "description": item.description + " " + item.coments,
            "parent_id": item.parent_cat_user_ubicacion_id
          };
        });

        if (resultA.length > 0) {
          resultB = true;
        }
      } else {
        for (var _index = Number(param) + 1; _index <= 3; _index++) {
          resultA = [];
          resultB = false;

          for (var _index2 = Number(param); _index2 <= 4; _index2++) {
            this.$store.commit("updateProperty", {
              fieldName: "ubicaciones_level" + _index2,
              fieldValue: resultA
            });
            this.$store.commit("updateProperty", {
              fieldName: "inputLv" + _index2,
              fieldValue: resultB
            });
          }
        }
      }

      console.log(fieldName, value);
      this.$store.commit('updateFormField', {
        formName: 'formReservacionQuirofano',
        fieldName: fieldName,
        fieldValue: value
      });
      this.$store.commit("updateProperty", {
        fieldName: "ubicaciones_level" + (Number(param) + 1),
        fieldValue: resultA
      });
      this.$store.commit("updateProperty", {
        fieldName: "inputLv" + (Number(param) + 1),
        fieldValue: resultB
      });
      console.log("2---->", this.$store.state.formReservacionQuirofano.cat_user_ubicacion_id);
      console.log(this.$store.state["ubicaciones_level" + (Number(param) + 1)]);
    },
    updateCatUbicacionSub: function updateCatUbicacionSub(param) {
      var cat_ubicacion_id = Number(this.$refs[param].value);
      return this.$store.state.catUbicacion.filter(function (item) {
        return item['parent_cat_user_ubicacion_id'] === cat_ubicacion_id;
      }).sort(function (a, b) {
        return a.orden - b.orden;
      });
    },
    updateCatUbicacion: function updateCatUbicacion(param, nextLevel) {
      var _this = this;

      var cat_ubicacion_id = Number(this.$refs[param].value);
      this.$store.commit('updateFormField', {
        formName: 'formReservacionQuirofano',
        fieldName: 'destino',
        fieldValue: cat_ubicacion_id
      });
      var subNivel = this.$store.state.catUbicacion.filter(function (item) {
        return item['parent_cat_user_ubicacion_id'] === _this.$store.state.formReservacionQuirofano.destino;
      });
      this.$store.commit('updateProperty', {
        fieldName: "catUbicacionTemp".concat(nextLevel),
        fieldValue: subNivel
      });

      for (var index = nextLevel + 1; index <= 4; index++) {
        this.$store.commit('updateProperty', {
          fieldName: "catUbicacionTemp".concat(index),
          fieldValue: []
        });
        this.$store.commit('updateProperty', {
          fieldName: "lv".concat(index, "SelectUbicacion"),
          fieldValue: false
        });
      }

      if (nextLevel < 5) {
        var containItems = subNivel.length > 0;
        var result = false;

        if (containItems) {
          result = true;
        }

        this.$store.commit('updateProperty', {
          fieldName: "lv".concat(nextLevel, "SelectUbicacion"),
          fieldValue: result
        });
      }
    },
    editForm: function editForm() {
      var _this2 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
        var edit_solicitud_id, solicitud;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                edit_solicitud_id = localStorage.getItem("editSolicitud");

                if (_this2.$route.path !== "/areaQuirofanoAmb/edit_quirofano") {
                  localStorage.removeItem("editSolicitud");
                }

                if (!_this2.edit_solicitudaaaaa) {
                  _context.next = 11;
                  break;
                }

                _this2.listadoSolicitudesEstaCargando = true;
                _context.next = 6;
                return Object(_helpers_customHelpers_js__WEBPACK_IMPORTED_MODULE_1__["get"])("/areaQuirofanoAmb/cupo/edit/" + edit_solicitud_id);

              case 6:
                solicitud = _context.sent;
                console.log("solicitud", solicitud);

                if (!Object(_helpers_customHelpers_js__WEBPACK_IMPORTED_MODULE_1__["is_undefined"])(solicitud)) {
                  _this2.$store.commit('editFormReservacionQuirofano', solicitud);
                }

                _this2.listadoSolicitudesEstaCargando = false;

                _this2.$store.commit('updateProperty', {
                  fieldName: 'loading',
                  fieldValue: false
                }); //


              case 11:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }))();
    },
    searchCedula: function searchCedula() {
      var _this3 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2() {
        var cedula, result, key;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                //alert("sss")
                cedula = _this3.$store.state.formReservacionQuirofano.cedula;

                if (Object(_helpers_customHelpers_js__WEBPACK_IMPORTED_MODULE_1__["is_empty"])(cedula)) {
                  _context2.next = 17;
                  break;
                }

                _this3.$store.commit('searchCedula', true);

                _context2.prev = 3;
                _context2.next = 6;
                return Object(_helpers_customHelpers_js__WEBPACK_IMPORTED_MODULE_1__["get"])(location.origin + "/user/profile/getByCedula/" + cedula);

              case 6:
                result = _context2.sent;

                //console.log( result)
                if (Object.values(result).length > 0) {
                  for (key in result) {
                    if (Object.hasOwnProperty.call(_this3.$store.state.formReservacionQuirofano, key)) {
                      _this3.$store.commit('updateFormField', {
                        formName: "formReservacionQuirofano",
                        fieldName: key,
                        fieldValue: result[key]
                      });
                    }
                  }
                } else {
                  _this3.resetForm();
                }

                _context2.next = 15;
                break;

              case 10:
                _context2.prev = 10;
                _context2.t0 = _context2["catch"](3);

                _this3.$store.commit('searchCedula', false);

                _this3.resetForm();

                console.log(_context2.t0);

              case 15:
                _context2.next = 19;
                break;

              case 17:
                _this3.$store.commit('searchCedula', false);

                _this3.resetForm();

              case 19:
                _this3.$store.commit('updateFormField', {
                  formName: "formReservacionQuirofano",
                  fieldName: 'cedula',
                  fieldValue: cedula
                }); // Simulación de una carga, podrías usar una función de retardo o una llamada a una API aquí


                setTimeout(function () {
                  _this3.$store.commit('searchCedula', false);
                }, 1000); // Cambiar a

              case 21:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2, null, [[3, 10]]);
      }))();
    },
    handleFileChange: function handleFileChange(event) {
      var files = event.target.files;
      var fileArray = []; //let temp_files = this.$store.state.formReservacionQuirofano.uploadedFile
      //let result = files.map(x=>Array.from(x))

      for (var index = 0; index < files.length; index++) {
        //console.log(element)
        fileArray.push({
          id: index,
          coments: "",
          name: files[index].name,
          typeFile: files[index].type,
          file: files[index]
        });
      } // console.log("2--->",fileArray)


      this.$store.commit('SET_FILE', fileArray); // Llama a la mutación para almacenar el archivo en Vuex
    },
    getAnestesiologos: function getAnestesiologos() {
      var _this4 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3() {
        var model;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {
          while (1) {
            switch (_context3.prev = _context3.next) {
              case 0:
                _context3.prev = 0;
                _context3.next = 3;
                return Object(_helpers_customHelpers_js__WEBPACK_IMPORTED_MODULE_1__["get"])(location.origin + '/user/especialidad/{id}/anestesiologo');

              case 3:
                model = _context3.sent;

                _this4.$store.commit('updateListadoAnestesiologos', model);

                _context3.next = 11;
                break;

              case 7:
                _context3.prev = 7;
                _context3.t0 = _context3["catch"](0);
                console.error('Error al obtener los datos:', _context3.t0);
                return _context3.abrupt("return", []);

              case 11:
              case "end":
                return _context3.stop();
            }
          }
        }, _callee3, null, [[0, 7]]);
      }))();
    },
    getEquipoCirugia: function getEquipoCirugia() {
      var _this5 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee4() {
        var model;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee4$(_context4) {
          while (1) {
            switch (_context4.prev = _context4.next) {
              case 0:
                _context4.prev = 0;
                _context4.next = 3;
                return Object(_helpers_customHelpers_js__WEBPACK_IMPORTED_MODULE_1__["get"])(location.origin + '/user/especialidad/{id}/medicos');

              case 3:
                model = _context4.sent;

                _this5.$store.commit('updateListadoEquipoCirugia', model);

                _this5.$store.commit('updateProperty', {
                  fieldName: 'loading',
                  fieldValue: false
                });

                _context4.next = 12;
                break;

              case 8:
                _context4.prev = 8;
                _context4.t0 = _context4["catch"](0);
                console.error('Error al obtener los datos:', _context4.t0);
                return _context4.abrupt("return", []);

              case 12:
              case "end":
                return _context4.stop();
            }
          }
        }, _callee4, null, [[0, 8]]);
      }))();
    },
    updateFormField: function updateFormField(event) {
      this.$store.commit('updateFormField', {
        formName: "formReservacionQuirofano",
        fieldName: event.currentTarget.name,
        fieldValue: event.currentTarget.value
      });
    },
    updateFormFieldFile: function updateFormFieldFile(event) {
      this.$store.commit('updateFormFieldFile', {
        index: event.currentTarget.dataset.index,
        fieldValue: event.currentTarget.value
      });
    },
    destroyFile: function destroyFile(index) {
      //console.log(index)
      var indiceAEliminar = index; // Índice del objeto que deseas eliminar

      var temp_object = this.$store.state.formReservacionQuirofano.uploadedFile; //console.log(temp_object)

      temp_object = temp_object.filter(function (item, key) {
        return item.id === Number(indiceAEliminar);
      }); //temp_object = JSON.stringify(temp_object)

      this.$store.commit('updateFormFiles', {
        fieldName: 'uploadedFile',
        fieldValue: temp_object
      });
    },
    validate: function validate() {
      var _this6 = this;

      if (['', null].includes(this.$store.state.formReservacionQuirofano['cedula'])) {
        Swal.fire({
          icon: "warning",
          title: "Una cédula es requerida.",
          didClose: function didClose() {
            setTimeout(function () {
              return _this6.$refs['cedula'].focus();
            }, 110);
          }
        });
        return false;
      }

      if (['', null].includes(this.$store.state.formReservacionQuirofano['nombres'])) {
        Swal.fire({
          icon: "warning",
          title: "Los nombres del paciente son requeridos.",
          didClose: function didClose() {
            setTimeout(function () {
              return _this6.$refs['nombres'].focus();
            }, 110);
          }
        });
        return false;
      }

      if (['', null].includes(this.$store.state.formReservacionQuirofano['apellidos'])) {
        Swal.fire({
          icon: "warning",
          title: "Los apellidos del paciente son requeridos.",
          didClose: function didClose() {
            setTimeout(function () {
              return _this6.$refs['apellidos'].focus();
            }, 110);
          }
        });
        return false;
      }

      if (['', null].includes(this.$store.state.formReservacionQuirofano['fnacimiento'])) {
        Swal.fire({
          icon: "warning",
          title: "La fecha de nacimiento del paciente es requerida.",
          didClose: function didClose() {
            setTimeout(function () {
              return _this6.$refs['fnacimiento'].focus();
            }, 110);
          }
        });
        return false;
      }

      if (['', null].includes(this.$store.state.formReservacionQuirofano['n_presupuesto'])) {
        Swal.fire({
          icon: "warning",
          title: "Un número de presupuesto es requerido.",
          didClose: function didClose() {
            setTimeout(function () {
              return _this6.$refs['n_presupuesto'].focus();
            }, 110);
          }
        });
        return false;
      }

      if (['', null].includes(this.$store.state.formReservacionQuirofano['fecha_reservacion'])) {
        Swal.fire({
          icon: "warning",
          title: "La fecha programada es requerida.",
          didClose: function didClose() {
            setTimeout(function () {
              return _this6.$refs['fecha_reservacion'].focus();
            }, 110);
          }
        });
        return false;
      }

      if (['', null].includes(this.$store.state.formReservacionQuirofano['h_inicio'])) {
        Swal.fire({
          icon: "warning",
          title: "La hora de inicio de la programación es requerida.",
          didClose: function didClose() {
            setTimeout(function () {
              return _this6.$refs['h_inicio'].focus();
            }, 110);
          }
        });
        return false;
      }

      if ([, '', null].includes(this.$store.state.formReservacionQuirofano['h_fin'])) {
        Swal.fire({
          icon: "warning",
          title: "La hora estimada de fin de la programación es requerida.",
          didClose: function didClose() {
            setTimeout(function () {
              return _this6.$refs['h_fin'].focus();
            }, 110);
          }
        });
        return false;
      }

      if (this.$store.state.formReservacionQuirofano['intervencion'].length === 0) {
        Swal.fire({
          icon: "warning",
          title: "Escribe y confirma, al menos una intervención a realizar.",
          didClose: function didClose() {
            setTimeout(function () {
              return _this6.$refs['intervencion'].childRef().focus();
            }, 110);
          }
        });
      } else {
        var key = true;
        var alerta = {
          icon: "warning",
          title: "",
          retorna: true
        };
        var intervenciones = this.$store.state.formReservacionQuirofano['intervencion'];
        intervenciones.forEach(function (intervencion) {
          for (var _key in intervencion) {
            console.log(_key);
            /*  if (key === 'description' && alerta.retorna) {
                 if (intervencion[key] ==="") {
                     alerta.title ="Escribe y confirma, al menos una Intervención, procedimiento o estudio a realizar.",
                     alerta.retorna = false
                 }
             }
             if (key === 'cirujano_principal' && alerta.retorna) {
                 if (intervencion[key].length ===0) {
                     alerta.title ="Selecciona y confirma, al menos un cirujano principal",
                     alerta.retorna = false
                 }
             } */
          }
        });

        if (!alerta.retorna) {
          Swal.fire({
            icon: alerta.icon,
            title: alerta.title
          });
          return false;
        } else {
          if (['', null].includes(this.$store.state.formReservacionQuirofano['area_intervencion'])) {
            Swal.fire({
              icon: "warning",
              title: "Un área de intervención es requerida.",
              didClose: function didClose() {
                setTimeout(function () {
                  return _this6.$refs['area_intervencion'].focus();
                }, 110);
              }
            });
            return false;
          }

          return true;
        }
      }
    },
    resetForm: function resetForm() {
      this.$store.commit('resetForm');
    },
    submitForm: function submitForm() {
      var _this7 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee5() {
        var formulario, formdata, key, element, user_id, result;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee5$(_context5) {
          while (1) {
            switch (_context5.prev = _context5.next) {
              case 0:
                if (!_this7.validate()) {
                  _context5.next = 24;
                  break;
                }

                if (['', null, "[]"].includes(_this7.$store.state.formReservacionQuirofano['anestesiologo'])) {
                  _this7.$store.commit('updateFormFiles', {
                    fieldName: 'anestesiologo',
                    fieldValue: JSON.stringify([{
                      "id": "0",
                      "description": "SERVICIO DE ANESTESIA"
                    }])
                  });
                }

                formulario = _this7.$store.state.formReservacionQuirofano;
                console.log(formulario);
                formdata = new FormData();

                for (key in _this7.$store.state.formReservacionQuirofano) {
                  element = _this7.$store.state.formReservacionQuirofano[key];

                  if (key === "intervencion") {
                    element = JSON.stringify(_this7.$store.state.formReservacionQuirofano[key].filter(function (x) {
                      return !x['deleted'];
                    }));
                  }

                  formdata.append(key, element);
                }

                console.log(formulario);
                /* formdata.append("user_id_paciente", 22) */

                user_id = _this7.$store.state.formReservacionQuirofano['user_id'];
                formdata.append("user_id", Object(_helpers_customHelpers_js__WEBPACK_IMPORTED_MODULE_1__["is_null"])(user_id) ? null : Number(user_id)); //formdata.append("user_id_medico", 22)

                formdata.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content')); //console.log(formdata)

                result = "";

                _this7.$store.commit('updateProperty', {
                  fieldName: 'loading',
                  fieldValue: true
                });

                if (!(_this7.$route.path == "/areaQuirofanoAmb/edit_quirofano")) {
                  _context5.next = 18;
                  break;
                }

                _context5.next = 15;
                return Object(_helpers_customHelpers_js__WEBPACK_IMPORTED_MODULE_1__["post"])(location.origin + "/areaQuirofanoAmb/updateForm", formdata);

              case 15:
                result = _context5.sent;
                _context5.next = 21;
                break;

              case 18:
                _context5.next = 20;
                return Object(_helpers_customHelpers_js__WEBPACK_IMPORTED_MODULE_1__["post"])(location.origin + "/areaQuirofanoAmb/store", formdata);

              case 20:
                result = _context5.sent;

              case 21:
                _this7.$store.commit('updateProperty', {
                  fieldName: 'loading',
                  fieldValue: false
                });

                _this7.resetForm();

                Swal.fire({
                  icon: "success",
                  title: "Programación guardada",
                  text: "Los datos de la nueva programación pueden verse en la pantalla del Plan quirúrgico Programado.",
                  didClose: function didClose() {
                    _this7.$store.commit('updateProperty', {
                      fieldName: 'loading',
                      fieldValue: false
                    });

                    localStorage.removeItem("editSolicitud");
                    setTimeout(function () {
                      return _this7.$router.push('/areaQuirofanoAmb/index_quirofano');
                    }
                    /*location.href = location.origin + "/areaQuirofano/index_quirofano"*/
                    , 110);
                  }
                }); //console.log(result)

              case 24:
                // Aquí podrías realizar acciones adicionales, como enviar datos a un servidor
                console.log('Form submitted:', _this7.formData); //this.resetForm();

              case 25:
              case "end":
                return _context5.stop();
            }
          }
        }, _callee5);
      }))();
    },
    initSelect2: function initSelect2(id) {
      var _this8 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee6() {
        var miFuncion;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee6$(_context6) {
          while (1) {
            switch (_context6.prev = _context6.next) {
              case 0:
                miFuncion = function miFuncion(selected) {
                  var selectedValue = selected.val();
                  var selectedText = selected.find('option:selected').text();
                  var ref = selected.data('ref');
                  var index = selected.data('index');
                  var intervencion = _this8.$store.state.formReservacionQuirofano.intervencion; //console.log(selectedValue)
                  //console.log(selectedText)

                  if (Object(_helpers_customHelpers_js__WEBPACK_IMPORTED_MODULE_1__["is_empty"])(selectedValue)) {
                    alert("Selecciona una opción");
                    selected.focus();
                    return false;
                  } //console.log(selected[0].options[ selected[0].options.selectedIndex ].value)


                  intervencion[index][ref].push({
                    id: Number(selectedValue),
                    description: selectedText
                  });

                  _this8.$store.commit('updateFormField', {
                    formName: 'formReservacionQuirofano',
                    fieldName: "intervencion",
                    fieldValue: intervencion
                  });
                };

                setTimeout(function () {
                  var array = ['cirujano_principal_' + id, 'anestesiologo_' + id, 'equipos_especiales_' + id, 'ayudante_1_' + id, 'ayudante_2_' + id, 'ayudante_3_' + id];
                  array.forEach(function (element) {
                    $(_this8.$refs[element]).select2();
                    $(_this8.$refs[element]).on('change', function () {
                      miFuncion($(this));
                    });
                  });
                }, 1000);

              case 2:
              case "end":
                return _context6.stop();
            }
          }
        }, _callee6);
      }))();
    }
  },

  /* created() {
    }, */
  mounted: function () {
    var _mounted = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee7() {
      var that;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee7$(_context7) {
        while (1) {
          switch (_context7.prev = _context7.next) {
            case 0:
              _context7.next = 2;
              return this.getAnestesiologos();

            case 2:
              _context7.next = 4;
              return this.getEquipoCirugia();

            case 4:
              this.$store.commit('updateEspecialidadesUnicas'); // Inicializa Select2 en el elemento ref "selectElement"

              this.initSelect2(0);
              /*
              $( this.$refs['anestesiologo'].childRef() ).select2();
              $( this.$refs['equipos_especiales'].childRef() ).select2();
              $( this.$refs['ayudante_1'].childRef() ).select2();
              $( this.$refs['ayudante_2'].childRef() ).select2();
              $( this.$refs['ayudante_3'].childRef() ).select2(); */

              /* $(this.$refs['equipos_especiales'].childRef()).on('select2:select', function (e) {
                  //console.log(e.target.value)
                    let otroInput = document.querySelector("#otros_equipos_especiales")
                      if (e.target.value ==="Otros") {
                          otroInput.classList.replace("d-none","d-block")
                      }else{
                          otroInput.classList.replace("d-block","d-none")
                      }
                }); */

              that = this;
              /*  $(this.$refs['cirujano_principal'].childRef()).on('select2:select', function (e) {
                  let {tagValueText,messageAlert} = that.$refs['cirujano_principal'].childRef().dataset
                  that.executeHandleInput(tagValueText,messageAlert)
              }); */

              this.$refs['cedula'].focus();
              this.editForm();

            case 9:
            case "end":
              return _context7.stop();
          }
        }
      }, _callee7, this);
    }));

    function mounted() {
      return _mounted.apply(this, arguments);
    }

    return mounted;
  }(),
  updated: function updated() {
    /*   let intervencion = this.$store.state.formReservacionQuirofano.intervencion
      let index = intervencion.length -1
            console.log(index)
          this.initSelect2(index) */

    /* this.$forceUpdate(); */
  },
  beforeDestroy: function beforeDestroy() {// Destruye Select2 al desmontar el componente
    //$( this.$refs['cirujano_principal'].childRef() ).select2('destroy');
    //$( this.$refs['anestesiologo'].childRef() ).select2('destroy');
    //$( this.$refs['equipos_especiales'].childRef() ).select2('destroy');
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=template&id=ebf9bb72&scoped=true&":
/*!******************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=template&id=ebf9bb72&scoped=true& ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function render() {
  var _vm = this,
      _c = _vm._self._c;

  return _c("FormSolicitud", {
    attrs: {
      edit_solicitudaaaaa: false
    }
  });
};

var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=template&id=1ea671b8&scoped=true&00001":
/*!********************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=template&id=1ea671b8&scoped=true&00001 ***!
  \********************************************************************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function render() {
  var _vm = this,
      _c = _vm._self._c;

  return _c("div", {
    staticClass: "flex-grow-1 d-flex flex-column overflow-auto",
    attrs: {
      id: "content"
    }
  }, [_c("div", {
    staticClass: "flex-fill container-fluid d-flex flex-column overflow-auto"
  }, [_c("div", {
    staticClass: "d-flex py-2 flex-column flex-sm-row align-items-center align-items-sm-center justify-content-center justify-content-sm-between"
  }, [_c("div", {
    staticClass: "title-option-page text-primary mb-0"
  }, [_vm._v("\n                " + _vm._s(_vm.$route.name)), _c("br"), _vm._v("MAPM\n            ")]), _vm._v(" "), _c("div", {
    staticClass: "d-flex"
  }, [_c("router-link", {
    staticClass: "btn btn-success mt-1 mr-1 mt-sm-0",
    attrs: {
      target: "_blank",
      to: "/areaQuirofanoAmb/externo/iqx"
    }
  }, [_vm._v("Plan Quirúrgico")]), _vm._v(" "), _c("router-link", {
    staticClass: "btn btn-primary-custom mt-1 mt-sm-0",
    attrs: {
      to: "/areaQuirofanoAmb/index_quirofano"
    }
  }, [_vm._v("Regresar")])], 1)]), _vm._v(" "), _c("div", {
    staticClass: "flex-fill d-flex flex-column overflow-auto"
  }, [_c("div", {
    staticClass: "overflow-auto mb-4 pb-4"
  }, [_c("div", {
    staticClass: "form container mb-4 pb-4"
  }, [_c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-12 h5 text-primary font-weight-bold"
  }, [_vm._v("\n                            Servicio médico soliciante\n                        ")]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-sm-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "tipo_cupo"
    }
  }, [_vm._v("Tipo de cupo:")]), _vm._v(" "), _c("select", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.tipo_cupo,
      expression: "$store.state.formReservacionQuirofano.tipo_cupo"
    }],
    ref: "tipo_cupo",
    staticClass: "form-control bg-gray-footer-parodi mr-1",
    attrs: {
      type: "text",
      name: "tipo_cupo",
      id: "tipo_cupo"
    },
    on: {
      input: _vm.updateFormField,
      change: function change($event) {
        var $$selectedVal = Array.prototype.filter.call($event.target.options, function (o) {
          return o.selected;
        }).map(function (o) {
          var val = "_value" in o ? o._value : o.value;
          return val;
        });

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "tipo_cupo", $event.target.multiple ? $$selectedVal : $$selectedVal[0]);
      }
    }
  }, [_c("option", {
    attrs: {
      value: "Quirúrgico"
    }
  }, [_vm._v("Quirúrgico")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Procedimiento"
    }
  }, [_vm._v("Procedimiento")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Estudio"
    }
  }, [_vm._v("Estudio")])])])]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-sm-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "tipo_cupo"
    }
  }, [_vm._v("Motivo de asignación de quirófano:")]), _vm._v(" "), _c("select", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.tipo_reservacion,
      expression: "$store.state.formReservacionQuirofano.tipo_reservacion"
    }],
    ref: "tipo_reservacion",
    staticClass: "form-control bg-gray-footer-parodi mr-1",
    attrs: {
      name: "tipo_reservacion",
      id: "tipo_reservacion"
    },
    on: {
      input: _vm.updateFormField,
      change: function change($event) {
        var $$selectedVal = Array.prototype.filter.call($event.target.options, function (o) {
          return o.selected;
        }).map(function (o) {
          var val = "_value" in o ? o._value : o.value;
          return val;
        });

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "tipo_reservacion", $event.target.multiple ? $$selectedVal : $$selectedVal[0]);
      }
    }
  }, [_c("option", {
    attrs: {
      value: "Emergencia"
    }
  }, [_vm._v("Emergencia")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Electiva"
    }
  }, [_vm._v("Electiva")])])])]), _vm._v(" "), _c("div", {
    staticClass: "col-12 h5 text-primary font-weight-bold"
  }, [_vm._v("\n                            Datos del paciente\n                        ")]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-sm-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "cedula"
    }
  }, [_vm._v("Documento de identidad")]), _vm._v(" "), _c("div", {
    staticClass: "d-flex align-items-center"
  }, [_c("select", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.nacionalidad,
      expression: "$store.state.formReservacionQuirofano.nacionalidad"
    }],
    staticClass: "flex-shrink-1 form-control bg-gray-footer-parodi",
    staticStyle: {
      width: "fit-content"
    },
    attrs: {
      id: "nacionalidad",
      name: "nacionalidad"
    },
    on: {
      input: _vm.updateFormField,
      change: function change($event) {
        var $$selectedVal = Array.prototype.filter.call($event.target.options, function (o) {
          return o.selected;
        }).map(function (o) {
          var val = "_value" in o ? o._value : o.value;
          return val;
        });

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "nacionalidad", $event.target.multiple ? $$selectedVal : $$selectedVal[0]);
      }
    }
  }, [_c("option", {
    attrs: {
      value: "V"
    }
  }, [_vm._v("V")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "E"
    }
  }, [_vm._v("E")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "P"
    }
  }, [_vm._v("P")])]), _vm._v(" "), _c("div", {
    staticClass: "input-group"
  }, [_c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.cedula,
      expression: "$store.state.formReservacionQuirofano.cedula"
    }],
    ref: "cedula",
    staticClass: "ml-1 flex-grow-1 form-control bg-gray-footer-parodi",
    attrs: {
      id: "cedula",
      type: "number",
      name: "cedula",
      "aria-describedby": "helpcedula"
    },
    domProps: {
      value: _vm.$store.state.formReservacionQuirofano.cedula
    },
    on: {
      change: _vm.searchCedula,
      input: [function ($event) {
        if ($event.target.composing) return;

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "cedula", $event.target.value);
      }, _vm.updateFormField]
    }
  }), _vm._v(" "), _c("div", {
    staticClass: "input-group-prepend"
  }, [_c("div", {
    "class": {
      "input-group-text p-0 ml-2 border-0 bg-transparent": true,
      "d-none": !_vm.searchingCedula
    }
  }, [_vm._m(0)])])])]), _vm._v(" "), _c("small", {
    staticClass: "form-text text-danger notification",
    attrs: {
      id: "sms_cedula"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-sm-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "email"
    }
  }, [_vm._v("Correo electrónico")]), _vm._v(" "), _c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.email,
      expression: "$store.state.formReservacionQuirofano.email"
    }],
    ref: "email",
    staticClass: "form-control bg-gray-footer-parodi",
    attrs: {
      id: "email",
      type: "email",
      name: "email",
      "aria-describedby": "helpId",
      placeholder: ""
    },
    domProps: {
      value: _vm.$store.state.formReservacionQuirofano.email
    },
    on: {
      input: [function ($event) {
        if ($event.target.composing) return;

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "email", $event.target.value);
      }, _vm.updateFormField]
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "form-text text-danger notification",
    attrs: {
      id: "sms_email"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-sm-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "nombre"
    }
  }, [_vm._v("Nombres")]), _vm._v(" "), _c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.nombres,
      expression: "$store.state.formReservacionQuirofano.nombres"
    }],
    ref: "nombres",
    staticClass: "form-control bg-gray-footer-parodi",
    attrs: {
      id: "nombres",
      type: "text",
      name: "nombres",
      "aria-describedby": "helpId",
      placeholder: ""
    },
    domProps: {
      value: _vm.$store.state.formReservacionQuirofano.nombres
    },
    on: {
      input: [function ($event) {
        if ($event.target.composing) return;

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "nombres", $event.target.value);
      }, _vm.updateFormField]
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "form-text text-muted notification",
    attrs: {
      id: "helpId1"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-sm-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "apellido"
    }
  }, [_vm._v("Apellidos")]), _vm._v(" "), _c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.apellidos,
      expression: "$store.state.formReservacionQuirofano.apellidos"
    }],
    ref: "apellidos",
    staticClass: "form-control bg-gray-footer-parodi",
    attrs: {
      id: "apellidos",
      type: "text",
      name: "apellidos",
      "aria-describedby": "helpId",
      placeholder: ""
    },
    domProps: {
      value: _vm.$store.state.formReservacionQuirofano.apellidos
    },
    on: {
      input: [function ($event) {
        if ($event.target.composing) return;

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "apellidos", $event.target.value);
      }, _vm.updateFormField]
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "form-text text-muted notification",
    attrs: {
      id: "helpId1"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-sm-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "genero"
    }
  }, [_vm._v("Género")]), _vm._v(" "), _c("select", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.genero,
      expression: "$store.state.formReservacionQuirofano.genero"
    }],
    ref: "genero",
    staticClass: "form-control bg-gray-footer-parodi",
    attrs: {
      id: "genero",
      name: "genero",
      "aria-describedby": "helpId",
      placeholder: ""
    },
    on: {
      input: _vm.updateFormField,
      change: function change($event) {
        var $$selectedVal = Array.prototype.filter.call($event.target.options, function (o) {
          return o.selected;
        }).map(function (o) {
          var val = "_value" in o ? o._value : o.value;
          return val;
        });

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "genero", $event.target.multiple ? $$selectedVal : $$selectedVal[0]);
      }
    }
  }, [_c("option", {
    attrs: {
      value: "m"
    }
  }, [_vm._v("Masculino")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "f"
    }
  }, [_vm._v("Femenino")])]), _vm._v(" "), _c("small", {
    staticClass: "form-text text-muted notification",
    attrs: {
      id: "helpId1"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-sm-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "fnacimiento"
    }
  }, [_vm._v("Fecha de nacimiento")]), _vm._v(" "), _c("div", {
    staticClass: "input-group mb-3"
  }, [_c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.fnacimiento,
      expression: "$store.state.formReservacionQuirofano.fnacimiento"
    }],
    ref: "fnacimiento",
    staticClass: "form-control bg-gray-footer-parodi",
    attrs: {
      type: "date",
      name: "fnacimiento",
      id: "fnacimiento",
      "aria-describedby": "helpId",
      placeholder: ""
    },
    domProps: {
      value: _vm.$store.state.formReservacionQuirofano.fnacimiento
    },
    on: {
      input: [function ($event) {
        if ($event.target.composing) return;

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "fnacimiento", $event.target.value);
      }, _vm.updateFormField]
    }
  }), _vm._v(" "), _c("div", {
    staticClass: "input-group-append"
  }, [_c("span", {
    staticClass: "input-group-text",
    attrs: {
      id: "basic-addon2"
    }
  }, [_c("i", {
    staticClass: "fas fa-birthday-cake mr-2"
  }), _vm._v("  " + _vm._s(_vm.calcularEdad) + " años")])])]), _vm._v(" "), _c("small", {
    staticClass: "form-text text-muted notification",
    attrs: {
      id: "helpId1"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-sm-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "telefono_movil"
    }
  }, [_vm._v("Teléfono contacto")]), _vm._v(" "), _c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.telefono_movil,
      expression: "$store.state.formReservacionQuirofano.telefono_movil"
    }],
    ref: "telefono_movil",
    staticClass: "form-control bg-gray-footer-parodi",
    attrs: {
      type: "number",
      name: "telefono_movil",
      id: "telefono_movil",
      "aria-describedby": "helpId",
      placeholder: ""
    },
    domProps: {
      value: _vm.$store.state.formReservacionQuirofano.telefono_movil
    },
    on: {
      input: [function ($event) {
        if ($event.target.composing) return;

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "telefono_movil", $event.target.value);
      }, _vm.updateFormField]
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "form-text text-muted notification",
    attrs: {
      id: "help_telefono_movil"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-sm-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "telefono_hogar"
    }
  }, [_vm._v("Teléfono secundario")]), _vm._v(" "), _c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.telefono_hogar,
      expression: "$store.state.formReservacionQuirofano.telefono_hogar"
    }],
    ref: "telefono_hogar",
    staticClass: "form-control bg-gray-footer-parodi",
    attrs: {
      type: "number",
      name: "telefono_hogar",
      id: "telefono_hogar",
      "aria-describedby": "helpId",
      placeholder: ""
    },
    domProps: {
      value: _vm.$store.state.formReservacionQuirofano.telefono_hogar
    },
    on: {
      input: [function ($event) {
        if ($event.target.composing) return;

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "telefono_hogar", $event.target.value);
      }, _vm.updateFormField]
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "form-text text-muted notification",
    attrs: {
      id: "help_telefono_hogar"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-12 my-3 h5 text-primary font-weight-bold"
  }, [_vm._v("\n                            Datos de la intervención, procedimiento o estudio\n                        ")]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-sm-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "n_presupuesto"
    }
  }, [_vm._v("Presupuesto nro:")]), _vm._v(" "), _c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.n_presupuesto,
      expression: "$store.state.formReservacionQuirofano.n_presupuesto"
    }],
    ref: "n_presupuesto",
    staticClass: "form-control bg-gray-footer-parodi",
    attrs: {
      type: "number",
      name: "n_presupuesto",
      id: "n_presupuesto"
    },
    domProps: {
      value: _vm.$store.state.formReservacionQuirofano.n_presupuesto
    },
    on: {
      input: [function ($event) {
        if ($event.target.composing) return;

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "n_presupuesto", $event.target.value);
      }, _vm.updateFormField]
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-sm-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "fecha_reservacion"
    }
  }, [_vm._v("Día de la círugía o estudio:")]), _vm._v(" "), _c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.fecha_reservacion,
      expression: "$store.state.formReservacionQuirofano.fecha_reservacion"
    }],
    ref: "fecha_reservacion",
    staticClass: "form-control bg-gray-footer-parodi",
    attrs: {
      type: "date",
      name: "fecha_reservacion",
      id: "fecha_reservacion"
    },
    domProps: {
      value: _vm.$store.state.formReservacionQuirofano.fecha_reservacion
    },
    on: {
      input: [function ($event) {
        if ($event.target.composing) return;

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "fecha_reservacion", $event.target.value);
      }, _vm.updateFormField]
    }
  })])]), _vm._v(" "), _c("div", {
    "class": ["col-12 col-sm-6", {
      "d-none": _vm.edit_solicitudaaaaa
    }]
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "h_inicio"
    }
  }, [_vm._v("Hora de inicio:")]), _vm._v(" "), _c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.h_inicio,
      expression: "$store.state.formReservacionQuirofano.h_inicio"
    }],
    ref: "h_inicio",
    staticClass: "form-control bg-gray-footer-parodi",
    attrs: {
      type: "time",
      name: "h_inicio",
      id: "h_inicio"
    },
    domProps: {
      value: _vm.$store.state.formReservacionQuirofano.h_inicio
    },
    on: {
      input: [function ($event) {
        if ($event.target.composing) return;

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "h_inicio", $event.target.value);
      }, _vm.updateFormField]
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-sm-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "h_fin"
    }
  }, [_vm._v("Horas (estimadas) de duración:")]), _vm._v(" "), _c("select", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.h_fin,
      expression: "$store.state.formReservacionQuirofano.h_fin"
    }],
    ref: "h_fin",
    staticClass: "form-control bg-gray-footer-parodi",
    attrs: {
      name: "h_fin",
      id: "h_fin"
    },
    on: {
      input: _vm.updateFormField,
      change: function change($event) {
        var $$selectedVal = Array.prototype.filter.call($event.target.options, function (o) {
          return o.selected;
        }).map(function (o) {
          var val = "_value" in o ? o._value : o.value;
          return val;
        });

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "h_fin", $event.target.multiple ? $$selectedVal : $$selectedVal[0]);
      }
    }
  }, [_c("option", {
    attrs: {
      value: "0.25"
    }
  }, [_vm._v("15 min")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "0.50"
    }
  }, [_vm._v("30 min")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "0.75"
    }
  }, [_vm._v("45 min")]), _vm._v(" "), _vm._l(_vm.numeros, function (numero) {
    return _c("option", {
      key: numero,
      domProps: {
        value: numero
      }
    }, [_vm._v(_vm._s(numero))]);
  })], 2)])]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-sm-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "dias_hospitalizacion"
    }
  }, [_vm._v("Días de Hospitalización:")]), _vm._v(" "), _c("div", {
    staticClass: "d-flex align-items-center"
  }, [_c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.dias_hospitalizacion,
      expression: "$store.state.formReservacionQuirofano.dias_hospitalizacion"
    }],
    ref: "dias_hospitalizacion",
    staticClass: "form-control bg-gray-footer-parodi",
    attrs: {
      type: "number",
      name: "dias_hospitalizacion",
      id: "dias_hospitalizacion"
    },
    domProps: {
      value: _vm.$store.state.formReservacionQuirofano.dias_hospitalizacion
    },
    on: {
      input: [function ($event) {
        if ($event.target.composing) return;

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "dias_hospitalizacion", $event.target.value);
      }, _vm.updateFormField]
    }
  })])])]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-sm-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "dias_hospitalizacion"
    }
  }, [_vm._v("Días en UTI:")]), _vm._v(" "), _c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.dias_uti,
      expression: "$store.state.formReservacionQuirofano.dias_uti"
    }],
    ref: "dias_uti",
    staticClass: "form-control bg-gray-footer-parodi",
    attrs: {
      type: "number",
      name: "dias_uti",
      id: "dias_uti"
    },
    domProps: {
      value: _vm.$store.state.formReservacionQuirofano.dias_uti
    },
    on: {
      input: [function ($event) {
        if ($event.target.composing) return;

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "dias_uti", $event.target.value);
      }, _vm.updateFormField]
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "convenio"
    }
  }, [_vm._v("Convenio:")]), _vm._v(" "), _c("select", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.convenio,
      expression: "$store.state.formReservacionQuirofano.convenio"
    }],
    ref: "convenio",
    staticClass: "form-control bg-gray-footer-parodi mr-1",
    attrs: {
      name: "convenio",
      id: "convenio"
    },
    on: {
      input: _vm.updateFormField,
      change: function change($event) {
        var $$selectedVal = Array.prototype.filter.call($event.target.options, function (o) {
          return o.selected;
        }).map(function (o) {
          var val = "_value" in o ? o._value : o.value;
          return val;
        });

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "convenio", $event.target.multiple ? $$selectedVal : $$selectedVal[0]);
      }
    }
  }, [_c("option", {
    attrs: {
      value: ""
    }
  }, [_vm._v("Seleccione")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Particular"
    }
  }, [_vm._v("Particular")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "VUMI"
    }
  }, [_vm._v("VUMI")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Best Doctor"
    }
  }, [_vm._v("Best Doctor")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Mercantil"
    }
  }, [_vm._v("Mercantil")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Mapfre"
    }
  }, [_vm._v("Mapfre")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Oceanica De Seguros"
    }
  }, [_vm._v("Oceanica De Seguros")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "BMI"
    }
  }, [_vm._v("BMI")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Banco Central De Venezuela"
    }
  }, [_vm._v("Banco Central De Venezuela")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Banesco"
    }
  }, [_vm._v("Banesco")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Caracas"
    }
  }, [_vm._v("Caracas")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "GBG"
    }
  }, [_vm._v("GBG")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Humanitas"
    }
  }, [_vm._v("Humanitas")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Hispana De Seguros"
    }
  }, [_vm._v("Hispana De Seguros")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Multinacional De Seguros"
    }
  }, [_vm._v("Multinacional De Seguros")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Piramide"
    }
  }, [_vm._v("Piramide")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Par Salud"
    }
  }, [_vm._v("Par Salud")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Universitas"
    }
  }, [_vm._v("Universitas")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Samhoi"
    }
  }, [_vm._v("Samhoi")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Bupa"
    }
  }, [_vm._v("Bupa")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Seguros Venezuela"
    }
  }, [_vm._v("Seguros Venezuela")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Redbrid"
    }
  }, [_vm._v("Redbrid")])])])]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-sm-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "n_quirofano"
    }
  }, [_vm._v("Quirófano:")]), _vm._v(" "), _c("select", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.n_quirofano,
      expression: "$store.state.formReservacionQuirofano.n_quirofano"
    }],
    ref: "n_quirofano",
    staticClass: "form-control bg-gray-footer-parodi mr-1",
    attrs: {
      name: "n_quirofano",
      id: "n_quirofano"
    },
    on: {
      input: _vm.updateFormField,
      change: function change($event) {
        var $$selectedVal = Array.prototype.filter.call($event.target.options, function (o) {
          return o.selected;
        }).map(function (o) {
          var val = "_value" in o ? o._value : o.value;
          return val;
        });

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "n_quirofano", $event.target.multiple ? $$selectedVal : $$selectedVal[0]);
      }
    }
  }, [_c("option", {
    attrs: {
      value: "1000"
    }
  }, [_vm._v("Pendiente")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "1"
    }
  }, [_vm._v("1")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "2"
    }
  }, [_vm._v("2")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "3"
    }
  }, [_vm._v("3")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "4"
    }
  }, [_vm._v("4")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "5"
    }
  }, [_vm._v("5")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "6"
    }
  }, [_vm._v("6")])])])]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-sm-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "anestesia_sugerida"
    }
  }, [_vm._v("Anestesia sugerida:")]), _vm._v(" "), _c("select", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.anestesia_sugerida,
      expression: "$store.state.formReservacionQuirofano.anestesia_sugerida"
    }],
    ref: "anestesia_sugerida",
    staticClass: "form-control bg-gray-footer-parodi mr-1",
    attrs: {
      name: "anestesia_sugerida",
      id: "anestesia_sugerida"
    },
    on: {
      input: _vm.updateFormField,
      change: function change($event) {
        var $$selectedVal = Array.prototype.filter.call($event.target.options, function (o) {
          return o.selected;
        }).map(function (o) {
          var val = "_value" in o ? o._value : o.value;
          return val;
        });

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "anestesia_sugerida", $event.target.multiple ? $$selectedVal : $$selectedVal[0]);
      }
    }
  }, [_c("option", {
    attrs: {
      value: "General"
    }
  }, [_vm._v("General")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Local con anestesiólogo"
    }
  }, [_vm._v("Local con anestesiólogo (Loccan)")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Local sin anestesiólogo"
    }
  }, [_vm._v("Local sin anestesiólogo (Locsan)")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Topica"
    }
  }, [_vm._v("Topica")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Sedación"
    }
  }, [_vm._v("Sedación")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "Otro"
    }
  }, [_vm._v("Otro")])])])]), _vm._v(" "), _c("div", {
    staticClass: "container p-1 mb-3"
  }, [_c("div", {
    attrs: {
      id: "contenedor_intervencion"
    }
  }, _vm._l(_vm.$store.state.formReservacionQuirofano.intervencion, function (item, index) {
    return _c("div", {
      key: index,
      ref: "item_" + index,
      refInFor: true,
      staticClass: "container p-0 mb-2 align-items-center d-flex"
    }, [_c("div", {
      staticClass: "row bg-light shadow-sm mt-2 rounded-custom-1"
    }, [_c("div", {
      staticClass: "col-12"
    }, [_c("label", {
      staticClass: "label-text text-secondary",
      attrs: {
        "for": "intervencion"
      }
    }, [_vm.$store.state.formReservacionQuirofano.intervencion.length > 1 ? _c("b", {
      staticClass: "text-primary h3"
    }, [_vm._v(_vm._s(index + 1))]) : _vm._e(), _vm._v(" Intervención, procedimiento o estudio a realizar:")])]), _vm._v(" "), _c("div", {
      staticClass: "col-4 pb-1"
    }, [_c("label", {
      staticClass: "label-text text-secondary",
      attrs: {
        "for": "codigo" + index
      }
    }, [_vm._v("Proced")]), _vm._v(" "), _c("input", {
      directives: [{
        name: "model",
        rawName: "v-model",
        value: item.description.codigo,
        expression: "item.description.codigo"
      }],
      staticClass: "form-control",
      attrs: {
        placeholder: "Buscar por Código",
        type: "text"
      },
      domProps: {
        value: item.description.codigo
      },
      on: {
        keyup: function keyup($event) {
          if (!$event.type.indexOf("key") && _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")) return null;
          return _vm.getProced("codigo", index);
        },
        change: function change($event) {
          return _vm.getProced("codigo", index);
        },
        input: function input($event) {
          if ($event.target.composing) return;

          _vm.$set(item.description, "codigo", $event.target.value);
        }
      }
    })]), _vm._v(" "), _c("div", {
      staticClass: "col-4 pb-1"
    }, [_c("label", {
      staticClass: "label-text text-secondary",
      attrs: {
        "for": "description" + index
      }
    }, [_vm._v("Descripción")]), _vm._v(" "), _c("input", {
      directives: [{
        name: "model",
        rawName: "v-model",
        value: item.description.description,
        expression: "item.description.description"
      }],
      staticClass: "form-control",
      attrs: {
        placeholder: "Buscar por Descripción",
        type: "text"
      },
      domProps: {
        value: item.description.description
      },
      on: {
        keyup: function keyup($event) {
          if (!$event.type.indexOf("key") && _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")) return null;
          return _vm.getProced("description", index);
        },
        change: function change($event) {
          return _vm.getProced("description", index);
        },
        input: function input($event) {
          if ($event.target.composing) return;

          _vm.$set(item.description, "description", $event.target.value);
        }
      }
    })]), _vm._v(" "), _c("div", {
      staticClass: "col-4 pb-1"
    }, [_c("label", {
      staticClass: "label-text text-secondary",
      attrs: {
        "for": "description" + index
      }
    }, [_vm._v("Kitsum asociado")]), _vm._v(" "), _c("input", {
      directives: [{
        name: "model",
        rawName: "v-model",
        value: item.description.kitsum_asociado,
        expression: "item.description.kitsum_asociado"
      }],
      staticClass: "form-control",
      attrs: {
        placeholder: "Buscar por Kitsum",
        type: "text"
      },
      domProps: {
        value: item.description.kitsum_asociado
      },
      on: {
        keyup: function keyup($event) {
          if (!$event.type.indexOf("key") && _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")) return null;
          return _vm.getProced("kitsum_asociado", index);
        },
        change: function change($event) {
          return _vm.getProced("kitsum_asociado", index);
        },
        input: function input($event) {
          if ($event.target.composing) return;

          _vm.$set(item.description, "kitsum_asociado", $event.target.value);
        }
      }
    })]), _vm._v(" "), _c("div", {
      staticClass: "col-12"
    }, [item.description.resultset.length > 0 ? _c("div", {
      staticClass: "table-responsive mt-1 table-hover",
      staticStyle: {
        "max-height": "200px"
      }
    }, [_c("table", {
      staticClass: "table table-bordered"
    }, [_c("tbody", _vm._l(item.description.resultset, function (item2, index2) {
      return _c("tr", {
        key: index2,
        staticClass: "text-secondary proced-found",
        on: {
          click: function click($event) {
            return _vm.addIntervencionItem(index, item2);
          }
        }
      }, [_c("td", {
        staticClass: "p-1",
        attrs: {
          scope: "row"
        }
      }, [_vm._v(_vm._s(item2.codigo))]), _vm._v(" "), _c("td", {
        staticClass: "p-1"
      }, [_vm._v(_vm._s(item2.description))]), _vm._v(" "), _c("td", {
        staticClass: "p-1"
      }, [_vm._v(_vm._s(item2.kitsum_asociado))])]);
    }), 0)])]) : _vm._e()]), _vm._v(" "), _c("div", {
      staticClass: "col-12 col-sm-4 col-md-3 col-lg-4 d-flex flex-column p-0 pb-1 px-1"
    }, [_vm._m(1, true), _vm._v(" "), _c("div", {
      staticClass: "d-flex flex-column"
    }, [_c("select", {
      ref: "cirujano_principal_" + index,
      refInFor: true,
      "class": ["form-control bg-gray-footer-parodi"],
      attrs: {
        "data-index": index,
        "data-ref": "cirujano_principal"
      }
    }, [_c("option", {
      attrs: {
        value: ""
      }
    }, [_vm._v("Seleccione")]), _vm._v(" "), _vm._l(_vm.$store.state.especialidadesUnicas, function (grupoEspecialidad, indexEsp) {
      return _c("optgroup", {
        key: indexEsp,
        staticClass: "text-primary",
        attrs: {
          label: grupoEspecialidad
        }
      }, _vm._l(_vm.getGrupoEquipoSalud(grupoEspecialidad), function (item3, index3) {
        return _c("option", {
          key: index3,
          staticClass: "text-secondary",
          domProps: {
            value: item3["id"]
          }
        }, [_vm._v(_vm._s(item3["description"]))]);
      }), 0);
    })], 2), _vm._v(" "), _c("div", {
      staticClass: "rounded-custom-1 mb-auto mt-1",
      staticStyle: {
        "background-color": "#efefef !important"
      }
    }, [_vm._l(item.hasOwnProperty("cirujano_principal") ? item["cirujano_principal"] : [], function (item2, index2) {
      return _c("div", {
        key: index2,
        staticClass: "d-flex align-items-center mt-1"
      }, [_c("span", {
        staticClass: "text-secondary mx-1"
      }, [_vm._v(_vm._s(index2 + 1))]), _vm._v(" "), _c("div", {
        "class": ["flex-fill"]
      }, [_vm._v("\n                                                            " + _vm._s(item2.description) + "\n                                                        ")]), _vm._v(" "), _c("button", {
        staticClass: "ml-1 text-primary btn border-0",
        on: {
          click: function click($event) {
            return _vm.destroyIntervencionItem(index, "cirujano_principal", index2);
          }
        }
      }, [_c("i", {
        staticClass: "fa fa-times"
      })])]);
    }), _vm._v(" "), item["cirujano_principal"].length === 0 ? _c("div", {
      staticClass: "text-center text-secondary rounded p-2 d-flex justify-content-center align-items-center"
    }, [_vm._v("\n                                                        Seleccione Cirujano Prin"), _c("span", {
      staticClass: "d-sm-block d-none"
    }, [_vm._v(".")]), _c("span", {
      staticClass: "d-sm-none"
    }, [_vm._v("cipal")])]) : _vm._e()], 2)])]), _vm._v(" "), _c("div", {
      staticClass: "col-12 col-sm-4 col-md-3 col-lg-4 d-flex flex-column p-0 pb-1 pr-1"
    }, [_c("label", {
      staticClass: "label-text text-secondary d-flex",
      attrs: {
        "for": ""
      }
    }, [_vm._v("\n                                                Ayudante 1\n                                            ")]), _vm._v(" "), _c("div", {
      staticClass: "d-flex flex-column"
    }, [_c("select", {
      ref: "ayudante_1_" + index,
      refInFor: true,
      "class": ["form-control bg-gray-footer-parodi"],
      attrs: {
        "data-index": index,
        "data-ref": "ayudante_1"
      }
    }, [_c("option", {
      attrs: {
        value: ""
      }
    }, [_vm._v("Seleccione")]), _vm._v(" "), _vm._l(_vm.$store.state.especialidadesUnicas, function (grupoEspecialidad, indexEsp) {
      return _c("optgroup", {
        key: indexEsp,
        staticClass: "text-primary",
        attrs: {
          label: grupoEspecialidad
        }
      }, _vm._l(_vm.getGrupoEquipoSalud(grupoEspecialidad), function (item3, index3) {
        return _c("option", {
          key: index3,
          staticClass: "text-secondary",
          domProps: {
            value: item3["id"]
          }
        }, [_vm._v(_vm._s(item3["description"]))]);
      }), 0);
    })], 2), _vm._v(" "), _c("div", {
      staticClass: "rounded-custom-1 mb-auto mt-1",
      staticStyle: {
        "background-color": "#efefef !important"
      }
    }, [_vm._l(item["ayudante_1"], function (item2, index2) {
      return _c("div", {
        key: index2,
        staticClass: "d-flex align-items-center mt-1"
      }, [_c("span", {
        staticClass: "text-secondary mx-1"
      }, [_vm._v(_vm._s(index2 + 1))]), _vm._v(" "), _c("div", {
        "class": ["flex-fill"]
      }, [_vm._v("\n                                                            " + _vm._s(item2.description) + "\n                                                        ")]), _vm._v(" "), _c("button", {
        staticClass: "ml-1 text-primary btn border-0",
        on: {
          click: function click($event) {
            return _vm.destroyIntervencionItem(index, "ayudante_1", index2);
          }
        }
      }, [_c("i", {
        staticClass: "fa fa-times"
      })])]);
    }), _vm._v(" "), item["ayudante_1"].length === 0 ? _c("div", {
      staticClass: "text-center text-secondary rounded p-2 d-flex justify-content-center align-items-center"
    }, [_vm._v("\n                                                        Seleccione Ayudante 1\n                                                    ")]) : _vm._e()], 2)])]), _vm._v(" "), _c("div", {
      staticClass: "col-12 col-sm-4 col-md-3 col-lg-4 d-flex flex-column p-0 pb-1 pr-1"
    }, [_c("label", {
      staticClass: "label-text text-secondary d-flex",
      attrs: {
        "for": ""
      }
    }, [_vm._v("\n                                                Ayudante 2\n                                            ")]), _vm._v(" "), _c("div", {
      staticClass: "d-flex flex-column"
    }, [_c("select", {
      ref: "ayudante_2_" + index,
      refInFor: true,
      "class": ["form-control bg-gray-footer-parodi"],
      attrs: {
        "data-index": index,
        "data-ref": "ayudante_2"
      }
    }, [_c("option", {
      attrs: {
        value: ""
      }
    }, [_vm._v("Seleccione")]), _vm._v(" "), _vm._l(_vm.$store.state.especialidadesUnicas, function (grupoEspecialidad, indexEsp) {
      return _c("optgroup", {
        key: indexEsp,
        staticClass: "text-primary",
        attrs: {
          label: grupoEspecialidad
        }
      }, _vm._l(_vm.getGrupoEquipoSalud(grupoEspecialidad), function (item3, index3) {
        return _c("option", {
          key: index3,
          staticClass: "text-secondary",
          domProps: {
            value: item3["id"]
          }
        }, [_vm._v(_vm._s(item3["description"]))]);
      }), 0);
    })], 2), _vm._v(" "), _c("div", {
      staticClass: "rounded-custom-1 mb-auto mt-1",
      staticStyle: {
        "background-color": "#efefef !important"
      }
    }, [_vm._l(item["ayudante_2"], function (item2, index2) {
      return _c("div", {
        key: index2,
        staticClass: "d-flex align-items-center mt-1"
      }, [_c("span", {
        staticClass: "text-secondary mx-1"
      }, [_vm._v(_vm._s(index2 + 1))]), _vm._v(" "), _c("div", {
        "class": ["flex-fill"]
      }, [_vm._v("\n                                                            " + _vm._s(item2.description) + "\n                                                        ")]), _vm._v(" "), _c("button", {
        staticClass: "ml-1 text-primary btn border-0",
        on: {
          click: function click($event) {
            return _vm.destroyIntervencionItem(index, "ayudante_2", index2);
          }
        }
      }, [_c("i", {
        staticClass: "fa fa-times"
      })])]);
    }), _vm._v(" "), item["ayudante_2"].length === 0 ? _c("div", {
      staticClass: "text-center text-secondary rounded p-2 d-flex justify-content-center align-items-center"
    }, [_vm._v("\n                                                        Seleccione Ayudante 2\n                                                    ")]) : _vm._e()], 2)])]), _vm._v(" "), _c("div", {
      staticClass: "col-12 col-sm-4 col-md-3 col-lg-4 d-flex flex-column p-0 pb-1 pr-1"
    }, [_c("label", {
      staticClass: "label-text text-secondary d-flex",
      attrs: {
        "for": ""
      }
    }, [_vm._v("\n                                                Ayudante 3\n                                            ")]), _vm._v(" "), _c("div", {
      staticClass: "d-flex flex-column"
    }, [_c("select", {
      ref: "ayudante_3_" + index,
      refInFor: true,
      "class": ["form-control bg-gray-footer-parodi"],
      attrs: {
        "data-index": index,
        "data-ref": "ayudante_3"
      }
    }, [_c("option", {
      attrs: {
        value: ""
      }
    }, [_vm._v("Seleccione")]), _vm._v(" "), _vm._l(_vm.$store.state.especialidadesUnicas, function (grupoEspecialidad, indexEsp) {
      return _c("optgroup", {
        key: indexEsp,
        staticClass: "text-primary",
        attrs: {
          label: grupoEspecialidad
        }
      }, _vm._l(_vm.getGrupoEquipoSalud(grupoEspecialidad), function (item3, index3) {
        return _c("option", {
          key: index3,
          staticClass: "text-secondary",
          domProps: {
            value: item3["id"]
          }
        }, [_vm._v(_vm._s(item3["description"]))]);
      }), 0);
    })], 2), _vm._v(" "), _c("div", {
      staticClass: "rounded-custom-1 mb-auto mt-1",
      staticStyle: {
        "background-color": "#efefef !important"
      }
    }, [_vm._l(item["ayudante_3"], function (item2, index2) {
      return _c("div", {
        key: index2,
        staticClass: "d-flex align-items-center mt-1"
      }, [_c("span", {
        staticClass: "text-secondary mx-1"
      }, [_vm._v(_vm._s(index2 + 1))]), _vm._v(" "), _c("div", {
        "class": ["flex-fill"]
      }, [_vm._v("\n                                                            " + _vm._s(item2.description) + "\n                                                        ")]), _vm._v(" "), _c("button", {
        staticClass: "ml-1 text-primary btn border-0",
        on: {
          click: function click($event) {
            return _vm.destroyIntervencionItem(index, "ayudante_3", index2);
          }
        }
      }, [_c("i", {
        staticClass: "fa fa-times"
      })])]);
    }), _vm._v(" "), item["ayudante_3"].length === 0 ? _c("div", {
      staticClass: "text-center text-secondary rounded p-2 d-flex justify-content-center align-items-center"
    }, [_vm._v("\n                                                        Seleccione Ayudante 3\n                                                    ")]) : _vm._e()], 2)])]), _vm._v(" "), _c("div", {
      staticClass: "col-12 col-sm-4 col-md-3 col-lg-4 d-flex flex-column p-0 pb-1 pr-1"
    }, [_c("label", {
      staticClass: "label-text text-secondary d-flex",
      attrs: {
        "for": ""
      }
    }, [_vm._v("\n                                                Anestesiologo\n                                            ")]), _vm._v(" "), _c("div", {
      staticClass: "d-flex flex-column"
    }, [_c("select", {
      ref: "anestesiologo_" + index,
      refInFor: true,
      "class": ["form-control bg-gray-footer-parodi"],
      attrs: {
        "data-index": index,
        "data-ref": "anestesiologo"
      }
    }, [_c("option", {
      attrs: {
        value: ""
      }
    }, [_vm._v("Seleccione")]), _vm._v(" "), _vm._l(_vm.$store.state.especialidadesUnicas.filter(function (x) {
      return x === "Anestesiología";
    }), function (grupoEspecialidad, indexEsp) {
      return _c("optgroup", {
        key: indexEsp,
        staticClass: "text-primary",
        attrs: {
          label: grupoEspecialidad
        }
      }, _vm._l(_vm.getGrupoEquipoSalud(grupoEspecialidad), function (item3, index3) {
        return _c("option", {
          key: index3,
          staticClass: "text-secondary",
          domProps: {
            value: item3["id"]
          }
        }, [_vm._v(_vm._s(item3["description"]))]);
      }), 0);
    })], 2), _vm._v(" "), _c("div", {
      staticClass: "rounded-custom-1 mb-auto mt-1",
      staticStyle: {
        "background-color": "#efefef !important"
      }
    }, [_vm._l(item["anestesiologo"], function (item2, index2) {
      return _c("div", {
        key: index2,
        staticClass: "d-flex align-items-center mt-1"
      }, [_c("span", {
        staticClass: "text-secondary mx-1"
      }, [_vm._v(_vm._s(index2 + 1))]), _vm._v(" "), _c("div", {
        "class": ["flex-fill"]
      }, [_vm._v("\n                                                            " + _vm._s(item2.description) + "\n                                                        ")]), _vm._v(" "), _c("button", {
        staticClass: "ml-1 text-primary btn border-0",
        on: {
          click: function click($event) {
            return _vm.destroyIntervencionItem(index, "anestesiologo", index2);
          }
        }
      }, [_c("i", {
        staticClass: "fa fa-times"
      })])]);
    }), _vm._v(" "), item["anestesiologo"].length === 0 ? _c("div", {
      staticClass: "text-center text-secondary rounded p-2 d-flex justify-content-center align-items-center"
    }, [_vm._v("\n                                                        Seleccione Anestesiologo\n                                                    ")]) : _vm._e()], 2)])]), _vm._v(" "), _c("div", {
      staticClass: "col-12 col-sm-4 col-md-3 col-lg-4 d-flex flex-column p-0 pb-1 pr-1"
    }, [_vm._m(2, true), _vm._v(" "), _c("div", {
      staticClass: "d-flex flex-column"
    }, [_c("select", {
      ref: "equipos_especiales_" + index,
      refInFor: true,
      "class": ["form-control bg-gray-footer-parodi"],
      attrs: {
        "data-index": index,
        "data-ref": "equipos_especiales"
      }
    }, [_c("option", {
      attrs: {
        value: ""
      }
    }, [_vm._v("Seleccione")]), _vm._v(" "), _vm._l(_vm.$store.state.equipos_especiales_options, function (item3, index3) {
      return _c("option", {
        key: index3,
        staticClass: "text-secondary",
        domProps: {
          value: item3
        }
      }, [_vm._v(_vm._s(item3))]);
    })], 2), _vm._v(" "), _c("div", {
      staticClass: "rounded-custom-1 mb-auto mt-1",
      staticStyle: {
        "background-color": "#efefef !important"
      }
    }, [_vm._l(item["equipos_especiales"], function (item2, index2) {
      return _c("div", {
        key: index2,
        staticClass: "d-flex align-items-center mt-1"
      }, [_c("span", {
        staticClass: "text-secondary mx-1"
      }, [_vm._v(_vm._s(index2 + 1))]), _vm._v(" "), _c("div", {
        "class": ["flex-fill"]
      }, [_vm._v("\n                                                            " + _vm._s(item2.description) + "\n                                                        ")]), _vm._v(" "), _c("button", {
        staticClass: "ml-1 text-primary btn border-0",
        on: {
          click: function click($event) {
            return _vm.destroyIntervencionItem(index, "equipos_especiales", index2);
          }
        }
      }, [_c("i", {
        staticClass: "fa fa-times"
      })])]);
    }), _vm._v(" "), item["equipos_especiales"].length === 0 ? _c("div", {
      staticClass: "text-center text-secondary rounded p-2 d-flex justify-content-center align-items-center"
    }, [_vm._v("\n                                                        Seleccione Equipos Esp"), _c("span", {
      staticClass: "d-sm-block d-none"
    }, [_vm._v(".")]), _c("span", {
      staticClass: "d-sm-none"
    }, [_vm._v("eciales")])]) : _vm._e()], 2)])])])]);
  }), 0), _vm._v(" "), _c("button", {
    staticClass: "btn btn-primary mt-2 btn-block",
    on: {
      click: function click($event) {
        return _vm.addIntervencion();
      }
    }
  }, [_c("i", {
    staticClass: "fa fa-plus"
  }), _vm._v(" Añadir otra intervención")])]), _vm._v(" "), _c("div", {
    staticClass: "col-12"
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "cat_user_ubicacion_id"
    }
  }, [_vm._v("Tipo de intervención:")]), _vm._v(" "), _c("div", [_c("select", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.$store.state.formReservacionQuirofano.area_intervencion,
      expression: "$store.state.formReservacionQuirofano.area_intervencion"
    }],
    ref: "level4",
    staticClass: "form-control bg-gray-footer-parodi mb-1",
    attrs: {
      id: "level4",
      "data-fieldName": "area_intervencion"
    },
    on: {
      change: [function ($event) {
        var $$selectedVal = Array.prototype.filter.call($event.target.options, function (o) {
          return o.selected;
        }).map(function (o) {
          var val = "_value" in o ? o._value : o.value;
          return val;
        });

        _vm.$set(_vm.$store.state.formReservacionQuirofano, "area_intervencion", $event.target.multiple ? $$selectedVal : $$selectedVal[0]);
      }, function ($event) {
        return _vm.handleDestino(4);
      }]
    }
  }, [_c("option", {
    attrs: {
      value: ""
    }
  }, [_vm._v("Seleccione")]), _vm._v(" "), _c("option", {
    staticClass: "text-success",
    attrs: {
      value: "424"
    }
  }, [_vm._v("MAPM Oftalmológica")]), _vm._v(" "), _c("option", {
    staticClass: "text-success",
    attrs: {
      value: "425"
    }
  }, [_vm._v("MAPM Especialidades")])])])]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-sm-6"
  }, [_c("div", {
    "class": {
      "d-none": !_vm.is_hospitalizacion
    }
  }, [_c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "cat_user_ubicacion_id"
    }
  }, [_vm._v("Destino:")]), _vm._v(" "), _c("select", {
    ref: "level0",
    staticClass: "form-control bg-gray-footer-parodi mb-1",
    attrs: {
      id: "level0",
      "data-fieldName": "destino"
    },
    on: {
      change: function change($event) {
        return _vm.handleDestino(0);
      }
    }
  }, [_c("option", {
    attrs: {
      value: ""
    }
  }, [_vm._v("Seleccione")]), _vm._v(" "), _vm._l(_vm.$store.state["catUbicacion"].filter(function (item) {
    return ![391, 390, 246, 223, 41, 2, 28, 182, 211, 391].includes(item["id"]) && item["parent_cat_user_ubicacion_id"] === 1;
  }), function (item, index) {
    return _c("option", {
      key: index,
      domProps: {
        value: item.id
      }
    }, [_vm._v(_vm._s(item.description))]);
  })], 2)]), _vm._v(" "), _c("div", {
    "class": {
      "d-none": !_vm.$store.state.inputLv1
    }
  }, [_c("select", {
    ref: "level1",
    staticClass: "form-control bg-gray-footer-parodi mb-1",
    attrs: {
      id: "level1",
      "data-fieldName": "destino"
    },
    on: {
      change: function change($event) {
        return _vm.handleDestino(1);
      }
    }
  }, [_c("option", {
    attrs: {
      value: ""
    }
  }, [_vm._v("Seleccione")]), _vm._v(" "), _vm._l(_vm.$store.state["ubicaciones_level1"], function (item, index) {
    return _c("option", {
      key: index,
      domProps: {
        value: item.id
      }
    }, [_vm._v(_vm._s(item.description))]);
  })], 2)]), _vm._v(" "), _c("div", {
    "class": {
      "d-none": !_vm.$store.state.inputLv2
    }
  }, [_c("select", {
    ref: "level2",
    staticClass: "form-control bg-gray-footer-parodi mb-1",
    attrs: {
      id: "level2",
      "data-fieldName": "destino"
    },
    on: {
      change: function change($event) {
        return _vm.handleDestino(2);
      }
    }
  }, [_c("option", {
    attrs: {
      value: ""
    }
  }, [_vm._v("Seleccione")]), _vm._v(" "), _vm._l(_vm.$store.state["ubicaciones_level2"], function (item, index) {
    return _c("option", {
      key: index,
      domProps: {
        value: item.id
      }
    }, [_vm._v(_vm._s(item.description))]);
  })], 2)]), _vm._v(" "), _c("div", {
    "class": {
      "d-none": !_vm.$store.state.inputLv3
    }
  }, [_c("select", {
    ref: "level3",
    staticClass: "form-control bg-gray-footer-parodi mb-1",
    attrs: {
      id: "level3",
      "data-fieldName": "destino"
    },
    on: {
      change: function change($event) {
        return _vm.handleDestino(3);
      }
    }
  }, [_c("option", {
    attrs: {
      value: ""
    }
  }, [_vm._v("Seleccione")]), _vm._v(" "), _vm._l(_vm.$store.state["ubicaciones_level3"], function (item, index) {
    return _c("option", {
      key: index,
      domProps: {
        value: item.id
      }
    }, [_vm._v(_vm._s(item.description))]);
  })], 2)])]), _vm._v(" "), _c("div", {
    staticClass: "col-12 d-none"
  }, [_c("div", {
    staticClass: "form-group"
  }), _vm._v(" "), _c("label", {
    staticClass: "label-text text-secondary",
    attrs: {
      "for": "aa"
    }
  }, [_vm._v("Documentos asociados:")]), _vm._v(" "), _c("div", {
    staticClass: "d-flex"
  }, [_c("input", {
    ref: "input_",
    staticClass: "form-control bg-gray-footer-parodi mr-1",
    staticStyle: {
      height: "43px"
    },
    attrs: {
      multiple: "",
      type: "file",
      name: "input_"
    },
    on: {
      change: _vm.handleFileChange
    }
  }), _vm._v(" "), _c("button", {
    staticClass: "btn btn-primary font-weight-bold",
    attrs: {
      type: "button"
    }
  }, [_vm._v("\n                                    +\n                                    ")])])]), _vm._v(" "), _c("div", {
    staticClass: "container-fluid"
  }, [_c("div", {
    staticClass: "row"
  }, _vm._l(_vm.uploadedFile, function (item, index) {
    return _c("div", {
      key: index,
      staticClass: "col-12 col-sm-6"
    }, [_c("div", {
      staticClass: "list-group-item-input-file my-1 overflow-auto d-flex justify-content-between align-items-center"
    }, [_c("div", {
      staticClass: "flex-fill d-flex align-items-center"
    }, [_c("i", {
      "class": {
        "pc-pdf text-danger": item.typeFile == "application/pdf",
        "pc-imagenes text-info": item.typeFile == "image/jpeg",
        " m-1 display-3": true
      }
    }), _vm._v(" "), _c("div", {
      staticClass: "flex-fill align-items-start d-flex flex-column"
    }, [_c("input", {
      directives: [{
        name: "model",
        rawName: "v-model",
        value: _vm.$store.state.formReservacionQuirofano.uploadedFile[index].coments,
        expression: "$store.state.formReservacionQuirofano.uploadedFile[index].coments"
      }],
      staticClass: "form-control",
      attrs: {
        "data-index": index,
        type: "text",
        placeholder: "Describe tu archivo aquí"
      },
      domProps: {
        value: _vm.$store.state.formReservacionQuirofano.uploadedFile[index].coments
      },
      on: {
        input: [function ($event) {
          if ($event.target.composing) return;

          _vm.$set(_vm.$store.state.formReservacionQuirofano.uploadedFile[index], "coments", $event.target.value);
        }, _vm.updateFormFieldFile]
      }
    }), _vm._v(" "), _c("b", {
      staticClass: "text-secondary d-flex align-items-center text-left overflow-hidden"
    }, [_c("i", {
      staticClass: "fas fa-paperclip mr-1"
    }), _vm._v(" "), _c("span", [_vm._v("\n                                                            " + _vm._s(item.name) + "\n                                                        ")])])])]), _vm._v(" "), _c("button", {
      staticClass: "btn btn-danger mx-1 font-weight-bold",
      on: {
        click: function click($event) {
          return _vm.destroyFile(index);
        }
      }
    }, [_vm._v("-")])])]);
  }), 0)])])]), _vm._v(" "), _c("div", {
    staticClass: "p-1 text-center"
  }, [!_vm.edit_solicitudaaaaa ? _c("button", {
    staticClass: "btn btn-success mt-1",
    attrs: {
      id: "submit"
    },
    on: {
      click: _vm.submitForm
    }
  }, [_vm._v("Crear solicitud")]) : _vm._e(), _vm._v(" "), _vm.edit_solicitudaaaaa ? _c("button", {
    staticClass: "btn btn-primary mt-1",
    attrs: {
      id: "submit"
    },
    on: {
      click: _vm.submitForm
    }
  }, [_vm._v("Actualizar solicitud")]) : _vm._e(), _vm._v(" "), !_vm.edit_solicitudaaaaa ? _c("button", {
    staticClass: "btn btn-info mt-1",
    attrs: {
      type: "button"
    },
    on: {
      click: _vm.resetForm
    }
  }, [_vm._v("Limpiar Campos")]) : _vm._e()])])])])]);
};

var staticRenderFns = [function () {
  var _vm = this,
      _c = _vm._self._c;

  return _c("div", {
    staticClass: "spinner-border text-primary",
    attrs: {
      role: "status"
    }
  }, [_c("span", {
    staticClass: "sr-only"
  }, [_vm._v("Loading...")])]);
}, function () {
  var _vm = this,
      _c = _vm._self._c;

  return _c("label", {
    staticClass: "label-text text-secondary d-flex",
    attrs: {
      "for": ""
    }
  }, [_vm._v("\n                                                Cirujano Prin"), _c("span", {
    staticClass: "d-sm-block d-none d-lg-none"
  }, [_vm._v(".")]), _c("span", {
    staticClass: "d-sm-none d-lg-block"
  }, [_vm._v("cipal")])]);
}, function () {
  var _vm = this,
      _c = _vm._self._c;

  return _c("label", {
    staticClass: "mt-auto label-text text-secondary d-flex",
    attrs: {
      "for": ""
    }
  }, [_vm._v("\n                                                Equipos Esp"), _c("span", {
    staticClass: "d-sm-block d-none d-lg-none"
  }, [_vm._v(".")]), _c("span", {
    staticClass: "d-sm-none d-lg-block"
  }, [_vm._v("eciales")])]);
}];
render._withStripped = true;


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=style&index=0&id=ebf9bb72&lang=scss&scoped=true&":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=style&index=0&id=ebf9bb72&lang=scss&scoped=true& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".vh-90[data-v-ebf9bb72] {\n  height: 90vh;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=style&index=0&id=1ea671b8&lang=scss&scoped=true&00001":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=style&index=0&id=1ea671b8&lang=scss&scoped=true&00001 ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "@charset \"UTF-8\";\ntable[data-v-1ea671b8] {\n  border-collapse: collapse !important;\n  border-spacing: 0 !important;\n}\n.position-sticky[data-v-1ea671b8] {\n  background-color: white;\n  position: sticky;\n  top: -1px;\n}\n.title-option-page[data-v-1ea671b8] {\n  font-size: 1.2rem;\n  font-weight: 600;\n}\n.btn-primary-custom[data-v-1ea671b8] {\n  color: #ffffff;\n  background-color: #5b96df !important;\n}\n.list-group-item-input-file[data-v-1ea671b8],\n.list-group-item-empty[data-v-1ea671b8] {\n  position: relative;\n  display: block;\n  background-color: transparent;\n  border: 2px dashed rgba(0, 0, 0, 0.125);\n  text-align: center;\n  color: var(--secondary);\n  border-radius: 0.25rem;\n}\n.proced-found[data-v-1ea671b8]:hover {\n  background-color: var(--primary);\n  color: white !important;\n  transition: all 0.5s;\n  /* Duración de la animación */\n  cursor: pointer;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=style&index=0&id=ebf9bb72&lang=scss&scoped=true&":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=style&index=0&id=ebf9bb72&lang=scss&scoped=true& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../../node_modules/css-loader!../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Create_quirofano.vue?vue&type=style&index=0&id=ebf9bb72&lang=scss&scoped=true& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=style&index=0&id=ebf9bb72&lang=scss&scoped=true&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=style&index=0&id=1ea671b8&lang=scss&scoped=true&00001":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=style&index=0&id=1ea671b8&lang=scss&scoped=true&00001 ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../../node_modules/css-loader!../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./FormSolicitud.vue?vue&type=style&index=0&id=1ea671b8&lang=scss&scoped=true&00001 */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=style&index=0&id=1ea671b8&lang=scss&scoped=true&00001");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue":
/*!***********************************************************************************************!*\
  !*** ./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue ***!
  \***********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Create_quirofano_vue_vue_type_template_id_ebf9bb72_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Create_quirofano.vue?vue&type=template&id=ebf9bb72&scoped=true& */ "./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=template&id=ebf9bb72&scoped=true&");
/* harmony import */ var _Create_quirofano_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Create_quirofano.vue?vue&type=script&lang=js& */ "./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _Create_quirofano_vue_vue_type_style_index_0_id_ebf9bb72_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Create_quirofano.vue?vue&type=style&index=0&id=ebf9bb72&lang=scss&scoped=true& */ "./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=style&index=0&id=ebf9bb72&lang=scss&scoped=true&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Create_quirofano_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Create_quirofano_vue_vue_type_template_id_ebf9bb72_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Create_quirofano_vue_vue_type_template_id_ebf9bb72_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "ebf9bb72",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************!*\
  !*** ./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_quirofano_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Create_quirofano.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_quirofano_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=style&index=0&id=ebf9bb72&lang=scss&scoped=true&":
/*!*********************************************************************************************************************************************************!*\
  !*** ./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=style&index=0&id=ebf9bb72&lang=scss&scoped=true& ***!
  \*********************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_quirofano_vue_vue_type_style_index_0_id_ebf9bb72_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/style-loader!../../../../../../node_modules/css-loader!../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Create_quirofano.vue?vue&type=style&index=0&id=ebf9bb72&lang=scss&scoped=true& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=style&index=0&id=ebf9bb72&lang=scss&scoped=true&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_quirofano_vue_vue_type_style_index_0_id_ebf9bb72_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_quirofano_vue_vue_type_style_index_0_id_ebf9bb72_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_quirofano_vue_vue_type_style_index_0_id_ebf9bb72_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_quirofano_vue_vue_type_style_index_0_id_ebf9bb72_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=template&id=ebf9bb72&scoped=true&":
/*!******************************************************************************************************************************************!*\
  !*** ./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=template&id=ebf9bb72&scoped=true& ***!
  \******************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_quirofano_vue_vue_type_template_id_ebf9bb72_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Create_quirofano.vue?vue&type=template&id=ebf9bb72&scoped=true& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/Create_quirofano.vue?vue&type=template&id=ebf9bb72&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_quirofano_vue_vue_type_template_id_ebf9bb72_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_quirofano_vue_vue_type_template_id_ebf9bb72_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?00001":
/*!**************************************************************************************************!*\
  !*** ./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?00001 ***!
  \**************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _FormSolicitud_vue_vue_type_template_id_1ea671b8_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./FormSolicitud.vue?vue&type=template&id=1ea671b8&scoped=true&00001 */ "./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=template&id=1ea671b8&scoped=true&00001");
/* harmony import */ var _FormSolicitud_vue_vue_type_script_lang_js_00001__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./FormSolicitud.vue?vue&type=script&lang=js&00001 */ "./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=script&lang=js&00001");
/* empty/unused harmony star reexport *//* harmony import */ var _FormSolicitud_vue_vue_type_style_index_0_id_1ea671b8_lang_scss_scoped_true_00001__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./FormSolicitud.vue?vue&type=style&index=0&id=1ea671b8&lang=scss&scoped=true&00001 */ "./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=style&index=0&id=1ea671b8&lang=scss&scoped=true&00001");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _FormSolicitud_vue_vue_type_script_lang_js_00001__WEBPACK_IMPORTED_MODULE_1__["default"],
  _FormSolicitud_vue_vue_type_template_id_1ea671b8_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0__["render"],
  _FormSolicitud_vue_vue_type_template_id_1ea671b8_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "1ea671b8",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=script&lang=js&00001":
/*!**************************************************************************************************************************!*\
  !*** ./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=script&lang=js&00001 ***!
  \**************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_FormSolicitud_vue_vue_type_script_lang_js_00001__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./FormSolicitud.vue?vue&type=script&lang=js&00001 */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=script&lang=js&00001");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_FormSolicitud_vue_vue_type_script_lang_js_00001__WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=style&index=0&id=1ea671b8&lang=scss&scoped=true&00001":
/*!***********************************************************************************************************************************************************!*\
  !*** ./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=style&index=0&id=1ea671b8&lang=scss&scoped=true&00001 ***!
  \***********************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_FormSolicitud_vue_vue_type_style_index_0_id_1ea671b8_lang_scss_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/style-loader!../../../../../../node_modules/css-loader!../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./FormSolicitud.vue?vue&type=style&index=0&id=1ea671b8&lang=scss&scoped=true&00001 */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=style&index=0&id=1ea671b8&lang=scss&scoped=true&00001");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_FormSolicitud_vue_vue_type_style_index_0_id_1ea671b8_lang_scss_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_FormSolicitud_vue_vue_type_style_index_0_id_1ea671b8_lang_scss_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_FormSolicitud_vue_vue_type_style_index_0_id_1ea671b8_lang_scss_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_FormSolicitud_vue_vue_type_style_index_0_id_1ea671b8_lang_scss_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=template&id=1ea671b8&scoped=true&00001":
/*!********************************************************************************************************************************************!*\
  !*** ./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=template&id=1ea671b8&scoped=true&00001 ***!
  \********************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_FormSolicitud_vue_vue_type_template_id_1ea671b8_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./FormSolicitud.vue?vue&type=template&id=1ea671b8&scoped=true&00001 */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AreaQuirurgica/GestionDeQxAmb/components/FormSolicitud.vue?vue&type=template&id=1ea671b8&scoped=true&00001");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_FormSolicitud_vue_vue_type_template_id_1ea671b8_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_FormSolicitud_vue_vue_type_template_id_1ea671b8_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);