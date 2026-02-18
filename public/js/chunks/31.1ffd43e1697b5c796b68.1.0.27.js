(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[31],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ConsultaExterna/components/CitasPorConfirmar.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ConsultaExterna/components/CitasPorConfirmar.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }
function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "CitasPorConfirmar",
  methods: {
    handleCitaReferenciaMedica: function handleCitaReferenciaMedica() {},
    handle_atender_hoy: function handle_atender_hoy(e, cita_id, cat_user_cita_status_id) {
      return _asyncToGenerator(/*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                /* let date = new Date()
                useState.formReprogramar = {
                    "cat_user_cita_status_id": 5,
                    "year": date.getFullYear(),
                    "month": (date.getMonth() + 1),
                    "day": date.getDate(),
                    "hour": date.getHours() + ":" + date.getMinutes(),
                    "coments": "Cita cambiada para hoy",
                    "cita_id": cita_id
                }
                */

                Swal.fire({
                  title: '¿Deseas atender esta cita hoy?',
                  text: "El paciente debe estar al tanto, antes de adelantar la fecha",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#2FA600',
                  cancelButtonColor: '#d33',
                  cancelButtonText: 'Aún no!',
                  confirmButtonText: 'Si, Atender!'
                }).then(/*#__PURE__*/function () {
                  var _ref = _asyncToGenerator(/*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(result) {
                    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
                      while (1) {
                        switch (_context.prev = _context.next) {
                          case 0:
                            if (result.isConfirmed) {
                              /* d.querySelector(".overlay").classList.remove("d-none")
                              let model = store_reprogramar()
                              set_item_cita(cita_id, "cat_user_cita_status_id", useState.formReprogramar['cat_user_cita_status_id'])
                              set_item_cita(cita_id, "year", useState.formReprogramar['year'])
                              set_item_cita(cita_id, "month", useState.formReprogramar['month'])
                              set_item_cita(cita_id, "day", useState.formReprogramar['day'])
                              Swal.fire(
                                  'Cita Actualizada para hoy!',
                                  "Notifique al paciente el momento del día en que será atendido",
                                  'success'
                              )
                                  handle_tablaCitas(useState.status_current_tab)
                              await updateTotales()
                              console.log(useState.citas)
                              d.querySelector(".overlay").classList.add("d-none") */
                            }
                          case 1:
                          case "end":
                            return _context.stop();
                        }
                      }
                    }, _callee);
                  }));
                  return function (_x) {
                    return _ref.apply(this, arguments);
                  };
                }());
              case 1:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2);
      }))();
    },
    handle_citas_confirmadas: function handle_citas_confirmadas(e) {
      return _asyncToGenerator(/*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee4() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee4$(_context4) {
          while (1) {
            switch (_context4.prev = _context4.next) {
              case 0:
                /*   d.querySelector("#tab_citas").classList.remove("d-none")
                  d.querySelector("#tab_preconsulta").classList.add("d-none")
                  let { cita_id, cat_user_cita_status_id } = e.target.dataset */

                Swal.fire({
                  title: '¿Desea confirmar esta cita?',
                  //text: "Esta acción no se puede revertir!",
                  iconHtml: '<i class="pc-warning text-warning" style="font-size:100px"></i>',
                  customClass: {
                    icon: 'border-0'
                  },
                  //icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#2FA600',
                  cancelButtonColor: '#d33',
                  cancelButtonText: 'Aún no!',
                  confirmButtonText: 'Si, Confirmar!'
                }).then(/*#__PURE__*/function () {
                  var _ref2 = _asyncToGenerator(/*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3(result) {
                    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {
                      while (1) {
                        switch (_context3.prev = _context3.next) {
                          case 0:
                          case "end":
                            return _context3.stop();
                        }
                      }
                    }, _callee3);
                  }));
                  return function (_x2) {
                    return _ref2.apply(this, arguments);
                  };
                }());
              case 1:
              case "end":
                return _context4.stop();
            }
          }
        }, _callee4);
      }))();
    },
    handle_cita_reprogramar: function handle_cita_reprogramar(e, cita_id) {
      return _asyncToGenerator(/*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee6() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee6$(_context6) {
          while (1) {
            switch (_context6.prev = _context6.next) {
              case 0:
                /* let cita = await get_cita(cita_id)
                    console.log("cita",cita)
                    useState['formReprogramar'] = {
                        "cat_user_cita_status_id": 2,
                        "year"                   : cita['year'],
                        "month"                  : null,
                        "day"                    : null,
                        "hour"                   : null,
                        "coments"                : "",
                        "cita_id"                : cita_id,
                        "agenda"                 : null,
                        "user_id_medico"         : cita['user_id_medico'],
                    }
                let medicos_id = await solicitud_cita_select_CENTRO_SALUD(cita['centro_salud_id'])
                let temp_medicos =  await solicitud_cita_select_MEDICO({
                medicos_id,
                "cat_especialidad_id":cita['cat_especialidad_id'],
                "centro_salud_id":cita['centro_salud_id']
                })
                useState['formReprogramar']['agendas'] = temp_medicos
                useState['formReprogramar']['agenda'] = useState['formReprogramar']['agendas'].find(x=>equalsInt(x['id'],cita['user_id_medico']))
                //console.log("temp_medicos",temp_medicos)
                let $modal = d.querySelector(`#exampleModal`)
                $modal.querySelector(".modal-body").innerHTML = null
                let dia_agendado = new Date(`${cita.year}-${cita.month}-${cita.day} ${cita.hour}`)
                let header =   `
                <div class="bg-light p-2">
                <h3 class="exampleModal_title text-primary">Reprogramar Cita</h3>
                <table class="w-100">
                <tr>
                    <th class="pr-1 text-secondary">Paciente:</th>
                    <td class="exampleModal_paciente">${cita['paciente']}</td>
                </tr>
                <tr>
                    <th class="pr-1 text-secondary">Especialidad:</th>
                    <td>${cita['especialidad_nombre']}</td>
                </tr>
                <tr>
                    <th class="pr-1 text-secondary">Centro de Salud:</th>
                    <td>${cita['centro_salud_description']}</td>
                </tr>
                <tr>
                    <th class="pr-1 text-secondary">Médico:</th>
                    <td class="exampleModal_medico">
                        <select name="user_id_medico" class="form-control border-0">
                            ${selectCustom(temp_medicos,cita['user_id_medico'])}
                        </select>
                    </td>
                </tr>
                <tr class="bg-secondary text-primary">
                    <th class="pr-1">Fecha agendada:</th>
                    <td>${ fechaCortaCustom3( dia_agendado )}</td>
                </tr>
                </table>
                </div>
                `
                $modal.querySelector(".modal-body").insertAdjacentHTML("beforeend",header)
                $modal.querySelector(".modal-body").insertAdjacentHTML("beforeend", `
                <div class="h4 text-center text-primary">Selecciona un dia del calendario</div>
                <div id="calendar" class="daterange" style="width: 100%"></div>
                <div id="mensaje_dia_seleccionado" class="rounded text-center"></div>
                <div class="h4 text-center text-primary">Selecciona una hora</div>
                <ul class="nav justify-content-center nav-pills horas-tab mb-3" id="horas-tab" role="tablist">
                <div class="flex-fill text-center text-secondary" style="font-size:15px">
                Sin Horas disponibles
                </div>
                </ul>
                <div class="h4 text-center text-primary">Motivo de reprogramación <span class="text-gray">(Opcional)</span></div>
                <div class="container-fluid">
                <textarea name="coments" id="coments" class="form-reprogramar form-control" cols="3" aria-describedby="helpId" rows="3"></textarea>
                </div>
                `)
                d.querySelector(`textarea[name='coments']`).addEventListener("change",async (e)=>{
                useState['formReprogramar']['coments'] = e.target.value
                console.log(useState['formReprogramar'])
                })
                d.querySelector(`select[name='user_id_medico']`).addEventListener("change",async (e)=>{
                let cita = await get_cita(cita_id)
                let temp_medicos =  await solicitud_cita_select_MEDICO({
                medicos_id,
                "cat_especialidad_id":cita['cat_especialidad_id'],
                "centro_salud_id":cita['centro_salud_id']
                })
                useState['formReprogramar']['agendas'] = temp_medicos
                useState['formReprogramar']['agenda'] = useState['formReprogramar']['agendas'].find(x=>equalsInt(x['id'],e.target.value))
                useState['formReprogramar']['user_id_medico'] = e.target.value
                //console.log(e.target.selectedOptions)
                console.log(useState['formReprogramar'])
                activarAgenda()
                })
                d.addEventListener("click",(e)=>{ */
                /* if (e.target.matches(".cita-hora")) {
                      useState['formReprogramar']['hour'] = e.target.dataset.hora
                      console.log(useState['formReprogramar'])
                }
                if (e.target.matches("#reprogramacion_store")) {
                      let mes_value = useState['formReprogramar']['month']
                        if (
                            is_null(mes_value) ||
                            is_empty(mes_value)
                        ) {
                            Toast.fire({
                                icon: 'warning',
                                title: 'Atención',
                                text: "Debe seleccionar una fecha disponible en el calendario",
                              })
                            return false
                        }
                    let hour_value = useState['formReprogramar']['hour']
                        if (
                            is_null(hour_value) ||
                            is_empty(hour_value)
                        ) {
                            Toast.fire({
                                icon: 'warning',
                                title: 'Atención',
                                text: "Debe seleccionar una hora disponible",
                              })
                            return false
                        } */
                Swal.fire({
                  title: "¿Deseas reprogramar esta cita?",
                  text: "El paciente decidirá, si acepta o no la nueva fecha propuesta.",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#2FA600',
                  cancelButtonColor: '#d33',
                  cancelButtonText: 'Aún no!',
                  confirmButtonText: 'Si, reprogramar!'
                }).then(/*#__PURE__*/function () {
                  var _ref3 = _asyncToGenerator(/*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee5(result) {
                    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee5$(_context5) {
                      while (1) {
                        switch (_context5.prev = _context5.next) {
                          case 0:
                            if (result.isConfirmed) {

                              /*  let ahora = new Date();
                                  let ahoraMilisegundos = ahora.getTime();
                                      let fechaActualizada = new Date(useState.formReprogramar['fechacompleta'] )
                                      fechaActualizada = fechaActualizada.getTime()
                                      if (fechaActualizada < ahoraMilisegundos) {
                                          Toast.fire({
                                              icon: 'warning',
                                              title: 'Atención',
                                              text: "Verifique la fecha y hora de la reprogramación",
                                          })
                                          return false
                                      }
                                      d.querySelector(".overlay").classList.remove("d-none")
                                  let model = store_reprogramar()
                                      d.querySelector(".overlay").classList.add("d-none")
                                      set_item_cita(cita_id, "cat_user_cita_status_id", useState.formReprogramar['cat_user_cita_status_id'])
                                      set_item_cita(cita_id, "year", useState.formReprogramar['year'])
                                      set_item_cita(cita_id, "month", useState.formReprogramar['month'])
                                      set_item_cita(cita_id, "day", useState.formReprogramar['day'])
                                      set_item_cita(cita_id, "hour", useState.formReprogramar['hour'])
                                      Swal.fire(
                                          'Cita reprogramada!',
                                          message.final_message,
                                          'success'
                                      )
                                          handle_tablaCitas(useState.status_current_tab)
                                      await updateTotales()
                                      console.log(useState.citas)
                                      $("#exampleModal").modal("hide") */
                            }
                          case 1:
                          case "end":
                            return _context5.stop();
                        }
                      }
                    }, _callee5);
                  }));
                  return function (_x3) {
                    return _ref3.apply(this, arguments);
                  };
                }());
                /* } */
                /* }) */
                /* activarAgenda()
                $("#exampleModal").modal("show") */
              case 1:
              case "end":
                return _context6.stop();
            }
          }
        }, _callee6);
      }))();
    },
    handle_cancelar: function handle_cancelar(e, cita_id, cat_user_cita_status_id) {
      return _asyncToGenerator(/*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee8() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee8$(_context8) {
          while (1) {
            switch (_context8.prev = _context8.next) {
              case 0:
                /*
                $("#exampleModalCancelar").modal("show")
                useState.formReprogramar = {
                    "cat_user_cita_status_id": 2,
                    "coments2": "",
                    "cita_id": cita_id
                }
                let cita = await get_cita(cita_id)
                let hora = new Date(`${cita.year}-${cita.month}-${cita.day} ${cita.hour}`)
                    let $modal = d.querySelector(`#exampleModalCancelar`)
                    $modal.querySelector(".modal-body form").innerHTML = null
                    $modal.querySelector(".modal-body form").innerHTML = `
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <b class="text-primary h3">Cancelar Cita</b>
                                </div>
                                <div class="col-md-12">
                                    <b class="text-secondary">Fecha Agendada:</b> <span>${fechaCortaCustom3(hora)}</span>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <h5 class="text-primary">Mótivo para cancelar:</h5>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                          <textarea name="coments" id="coments" class="form-reprogramar form-control" cols="3"
                                            aria-describedby="helpId" rows="3"></textarea>
                                        <small id="helpId" class="text-muted"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `
                    $modal.addEventListener("change", async function (e) {
                        //console.log(e.target.name)
                          if (e.target.name === "coments") {
                            useState.formReprogramar["coments2"] = e.target.value
                        }
                      })
                    $modal.querySelector("button.btn.btn-primary").addEventListener("click", e => { */
                Swal.fire({
                  title: '¿Deseas cancelar esta cita?',
                  text: "Esta acción no se puede revertir!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#2FA600',
                  cancelButtonColor: '#d33',
                  cancelButtonText: 'Aún no!',
                  confirmButtonText: 'Si, Cancelar!'
                }).then(/*#__PURE__*/function () {
                  var _ref4 = _asyncToGenerator(/*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee7(result) {
                    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee7$(_context7) {
                      while (1) {
                        switch (_context7.prev = _context7.next) {
                          case 0:
                            if (result.isConfirmed) {
                              /* d.querySelector(".overlay").classList.remove("d-none")
                              let index_cita = useState.citas.findIndex(x => equalsInt(x.user_cita_id, cita_id))
                              //console.log("Estado antes Cancelar", useState['citas'][index_cita])
                              let model = await store_cita_status(cita_id, cat_user_cita_status_id, d.querySelector("textarea[name='coments']").value)
                              //delete_cita(cita_id)
                              useState['citas'][index_cita]['cat_user_cita_status_id'] = cat_user_cita_status_id
                              //console.log("Estado despues Cancelar", useState['citas'][index_cita])
                                handle_tablaCitas(useState.status_current_tab)
                              await updateTotales()
                              Swal.fire(
                                  'Cita Cancelada!',
                                  'El paciente será notificado de esta acción',
                                  'success'
                              )
                              $("#exampleModalCancelar").modal("hide")
                              d.querySelector(".overlay").classList.add("d-none") */
                            }
                          case 1:
                          case "end":
                            return _context7.stop();
                        }
                      }
                    }, _callee7);
                  }));
                  return function (_x4) {
                    return _ref4.apply(this, arguments);
                  };
                }());

                /*  }) */

                //},
              case 1:
              case "end":
                return _context8.stop();
            }
          }
        }, _callee8);
      }))();
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ConsultaExterna/components/CitasPorConfirmar.vue?vue&type=template&id=e7c8129a&scoped=true&":
/*!***********************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ConsultaExterna/components/CitasPorConfirmar.vue?vue&type=template&id=e7c8129a&scoped=true& ***!
  \***********************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "flex-fill px-2 d-flex flex-column overflow-auto" },
    [
      _vm._m(0),
      _vm._v(" "),
      _c("div", { staticClass: "table-responsive" }, [
        _c(
          "table",
          { staticClass: "table bg-white table-bordered table-hover" },
          [
            _vm._m(1),
            _vm._v(" "),
            _c("tbody", [
              _c("tr", { staticClass: "text-secondary" }, [
                _c(
                  "td",
                  {
                    staticClass: "p-0 text-center",
                    attrs: { title: "Día en que se solicitó la cita" },
                  },
                  [_vm._v("Fecha")]
                ),
                _vm._v(" "),
                _vm._m(2),
                _vm._v(" "),
                _c("td", { staticClass: "p-0" }, [_vm._v("Medico")]),
                _vm._v(" "),
                _c("td", { staticClass: "p-0" }, [_vm._v("Especialidad")]),
                _vm._v(" "),
                _c("td", { staticClass: "p-0" }, [_vm._v("Fecha Cita")]),
                _vm._v(" "),
                _c("td", { staticClass: "p-0" }, [_vm._v("Hora")]),
                _vm._v(" "),
                _c(
                  "td",
                  {
                    staticClass: "p-1 botones-fila",
                    staticStyle: { width: "160px" },
                  },
                  [
                    _c(
                      "a",
                      {
                        staticClass:
                          "btn btn-info btn-block btn-sm cita-referencia",
                        attrs: {
                          "data-btn-id": "9",
                          "data-cat_user_cita_status_id": "4",
                          href: "#",
                          role: "button",
                          title: "Referencia NO DISPONIBLE",
                          "data-cita_id": "27248",
                          "data-user_id_paciente": "358171",
                        },
                        on: {
                          click: function ($event) {
                            return _vm.handleCitaReferenciaMedica()
                          },
                        },
                      },
                      [
                        _c("i", {
                          staticClass: "fas fa-file-alt cita-referencia",
                          staticStyle: { width: "15px", height: "15px" },
                          attrs: { title: "Referencia NO DISPONIBLE" },
                        }),
                        _vm._v(
                          "\n                            Referencia\n                        "
                        ),
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "a",
                      {
                        staticClass:
                          "btn btn-success btn-block btn-sm atender-hoy-cita",
                        attrs: {
                          "data-btn-id": "7",
                          "data-cat_user_cita_status_id": "4",
                          href: "#",
                          role: "button",
                          "data-cita_id": "27248",
                          "data-user_id_paciente": "358171",
                        },
                        on: {
                          click: function ($event) {
                            return _vm.handle_atender_hoy()
                          },
                        },
                      },
                      [
                        _c("img", {
                          staticClass: "atender-hoy-cita",
                          staticStyle: { width: "15px", height: "15px" },
                          attrs: {
                            src: "/image/system/calendar-check.svg",
                            alt: "Not Image Found",
                            "data-cita_id": "27248",
                            "data-user_id_paciente": "358171",
                          },
                        }),
                        _vm._v(" Atender Hoy\n                        "),
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "a",
                      {
                        staticClass:
                          "btn btn-primary btn-block btn-sm aprobar-cita",
                        attrs: {
                          "data-btn-id": "0",
                          "data-cat_user_cita_status_id": "4",
                          href: "#",
                          role: "button",
                          "data-cita_id": "27248",
                          "data-user_id_paciente": "358171",
                        },
                        on: {
                          click: function ($event) {
                            return _vm.handle_citas_confirmadas()
                          },
                        },
                      },
                      [
                        _c("img", {
                          staticClass: "aprobar-cita",
                          staticStyle: { width: "15px", height: "15px" },
                          attrs: {
                            "data-cat_user_cita_status_id": "4",
                            src: "/image/system/calendar-check.svg",
                            alt: "Not Image Found",
                            "data-cita_id": "27248",
                            "data-user_id_paciente": "358171",
                          },
                        }),
                        _vm._v(
                          "\n                            Confirmar\n                        "
                        ),
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "a",
                      {
                        staticClass:
                          "btn btn-warning btn-block btn-sm cita-reprogramar",
                        attrs: {
                          "data-btn-id": "1",
                          "data-cat_user_cita_status_id": "2",
                          href: "#",
                          role: "button",
                          "data-cita_id": "27248",
                          "data-user_id_paciente": "358171",
                        },
                        on: {
                          click: function ($event) {
                            return _vm.handle_cita_reprogramar()
                          },
                        },
                      },
                      [
                        _c("img", {
                          staticClass: "cita-reprogramar",
                          staticStyle: { width: "15px", height: "15px" },
                          attrs: {
                            "data-cat_user_cita_status_id": "2",
                            src: "/image/system/calendar-exclamation.svg",
                            alt: "Not Image Found",
                            "data-cita_id": "27248",
                            "data-user_id_paciente": "358171",
                          },
                        }),
                        _vm._v(
                          "\n                            Reprogramar\n                        "
                        ),
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "a",
                      {
                        staticClass:
                          "btn btn-danger btn-block btn-sm cancelar-cita",
                        attrs: {
                          "data-btn-id": "6",
                          "data-cat_user_cita_status_id": "3",
                          href: "#",
                          role: "button",
                          "data-cita_id": "27248",
                          "data-user_id_paciente": "358171",
                        },
                        on: {
                          click: function ($event) {
                            return _vm.handle_cancelar()
                          },
                        },
                      },
                      [
                        _c("img", {
                          staticClass: "cancelar-cita",
                          staticStyle: { width: "15px", height: "15px" },
                          attrs: {
                            "data-cat_user_cita_status_id": "3",
                            src: "/image/system/calendar-cancel.svg",
                            alt: "Not Image Found",
                            "data-cita_id": "27248",
                            "data-user_id_paciente": "358171",
                          },
                        }),
                        _vm._v(
                          "\n                            Cancelar\n                        "
                        ),
                      ]
                    ),
                  ]
                ),
              ]),
            ]),
          ]
        ),
      ]),
    ]
  )
}
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-flex flex-wrap mb-2" }, [
      _c("div", { staticClass: "col-12 col-sm-6 pl-0" }, [
        _c("h4", { staticClass: "text-primary px-1" }, [
          _vm._v("Por confirmar"),
        ]),
      ]),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "col-12 col-sm-6 pr-0 d-flex align-items-center" },
        [
          _c(
            "label",
            { staticClass: "text-primary mb-0 mr-1", attrs: { for: "" } },
            [_vm._v("Buscar:")]
          ),
          _vm._v(" "),
          _c("input", {
            staticClass: "form-control",
            attrs: {
              type: "search",
              placeholder: "Escribe el texto a buscar",
              id: "buscar_cita_listado",
            },
          }),
        ]
      ),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", { staticStyle: { "font-size": "1.2em" } }, [
      _c("tr", [
        _c(
          "th",
          {
            staticClass: "bg-white text-primary sticky-header text-center",
            attrs: { title: "Día en que se solicitó la cita" },
          },
          [_vm._v("Fecha")]
        ),
        _vm._v(" "),
        _c(
          "th",
          { staticClass: "bg-white text-primary sticky-header text-center" },
          [_vm._v("Paciente")]
        ),
        _vm._v(" "),
        _c("th", { staticClass: "bg-white text-primary sticky-header" }, [
          _vm._v("Medico"),
        ]),
        _vm._v(" "),
        _c("th", { staticClass: "bg-white text-primary sticky-header" }, [
          _vm._v("Especialidad"),
        ]),
        _vm._v(" "),
        _c("th", { staticClass: "bg-white text-primary sticky-header" }, [
          _vm._v("Fecha Cita"),
        ]),
        _vm._v(" "),
        _c("th", { staticClass: "bg-white text-primary sticky-header" }, [
          _vm._v("Hora"),
        ]),
        _vm._v(" "),
        _c("th", { staticClass: "bg-white text-primary sticky-header" }, [
          _vm._v("Acciones"),
        ]),
      ]),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("td", { staticClass: "p-0 text-center" }, [
      _c("div", { staticClass: "container-fluid p-0 m-0" }, [
        _c("div", { staticClass: "d-flex justify-content-between" }, [
          _c(
            "div",
            {
              staticClass: "d-flex flex-column",
              staticStyle: { width: "fit-content" },
            },
            [
              _c(
                "i",
                {
                  staticClass:
                    "tag-exonerado d-none text-right font-weight-bold px-3 align-items-center",
                  staticStyle: { "border-bottom-right-radius": "20px" },
                },
                [
                  _c("i", { staticClass: "fas fa-check-double" }),
                  _vm._v("\n                                        Exonerado"),
                ]
              ),
            ]
          ),
          _vm._v(" "),
          _c(
            "div",
            {
              staticClass: "d-flex flex-column justify-content-end",
              staticStyle: { width: "fit-content" },
            },
            [
              _c("div", {
                staticClass:
                  "d-none tag-condicion-cortesia-referido text-right font-weight-bold px-3 border",
              }),
              _vm._v(" "),
              _c(
                "div",
                {
                  staticClass:
                    "tag-condicion-cortesia text-right font-weight-bold px-3 bg-success",
                  staticStyle: { "border-bottom-left-radius": "20px" },
                },
                [_vm._v("Cita Particular")]
              ),
            ]
          ),
        ]),
        _vm._v(" "),
        _c(
          "div",
          { staticClass: "d-flex flex-row", staticStyle: { height: "100%" } },
          [
            _c(
              "div",
              {
                staticClass:
                  "flex-fill align-self-start flex-grow-1 border-right",
              },
              [
                _c(
                  "div",
                  {
                    staticClass:
                      "d-flex flex-row justify-content-center border-bottom",
                  },
                  [
                    _c(
                      "div",
                      {
                        staticClass: "d-flex paciente-edit cursor-pointer",
                        staticStyle: { "align-items": "center" },
                        attrs: { "data-user_id_paciente": "358171" },
                      },
                      [
                        _c(
                          "div",
                          {
                            staticClass: "m-1 paciente-edit",
                            attrs: { "data-user_id_paciente": "358171" },
                          },
                          [
                            _c("img", {
                              staticClass:
                                "paciente-edit card-item-paciente-imagen tooltip-primary border border-primary card-item-paciente-image rounded-circle mx-auto d-block",
                              staticStyle: { width: "1.5cm", height: "1.5cm" },
                              attrs: {
                                onerror:
                                  "this.src='/image/system/icono-paciente-blanco.svg';",
                                loading: "lazy",
                                src: "/image/system/patient.svg",
                                "data-tippy-content": "Imagen del paciente",
                                alt: "...",
                                "data-user_id_paciente": "358171",
                              },
                            }),
                          ]
                        ),
                        _vm._v(" "),
                        _c("div", [
                          _c(
                            "div",
                            {
                              staticClass: "paciente-edit",
                              attrs: { "data-user_id_paciente": "358171" },
                            },
                            [
                              _c(
                                "h4",
                                {
                                  staticClass:
                                    "paciente-edit tooltip-primary card-item-paciente-fullname text-primary",
                                  staticStyle: {
                                    "margin-bottom": "0",
                                    "white-space": "normal",
                                  },
                                  attrs: {
                                    "data-tippy-content": "Nombre del paciente",
                                    "data-user_id_paciente": "358171",
                                  },
                                },
                                [_vm._v("Adalgiza Suárez")]
                              ),
                            ]
                          ),
                        ]),
                      ]
                    ),
                  ]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "d-flex justify-content-center" }, [
                  _c(
                    "div",
                    { staticClass: "d-flex flex-fill align-self-start" },
                    [
                      _c(
                        "div",
                        {
                          staticClass:
                            "d-flex flex-column flex-fill align-items-center",
                        },
                        [
                          _c(
                            "div",
                            {
                              staticClass:
                                "tooltip-primary d-flex flex-fill justify-content-center",
                              attrs: {
                                "data-tippy-content":
                                  "Documento de identidad del paciente",
                              },
                            },
                            [
                              _c(
                                "b",
                                {
                                  staticClass: "text-primary",
                                  staticStyle: { "font-size": "0.8em" },
                                },
                                [_vm._v("Cédula")]
                              ),
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            {
                              staticClass:
                                "d-flex flex-fill justify-content-center",
                            },
                            [
                              _c(
                                "div",
                                {
                                  staticClass:
                                    "text-gray text-nowrap overflow-hidden card-item-paciente-cedula",
                                },
                                [_vm._v("V12667255")]
                              ),
                            ]
                          ),
                        ]
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        {
                          staticClass:
                            "tooltip-primary d-flex flex-column flex-fill align-items-center border-left border-right",
                          attrs: { "data-tippy-content": "Edad del paciente" },
                        },
                        [
                          _c(
                            "div",
                            {
                              staticClass:
                                "d-flex flex-fill justify-content-center",
                            },
                            [
                              _c(
                                "b",
                                {
                                  staticClass: "text-primary",
                                  staticStyle: { "font-size": "0.8em" },
                                },
                                [_vm._v("Edad")]
                              ),
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            {
                              staticClass:
                                "d-flex flex-fill justify-content-center",
                            },
                            [
                              _c(
                                "div",
                                {
                                  staticClass:
                                    "text-gray card-item-paciente-edad",
                                },
                                [_vm._v("70")]
                              ),
                            ]
                          ),
                        ]
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        {
                          staticClass:
                            "tooltip-primary d-flex flex-column flex-fill align-items-center",
                          attrs: {
                            "data-tippy-content": "Genero del paciente",
                          },
                        },
                        [
                          _c(
                            "div",
                            {
                              staticClass:
                                "d-flex flex-fill justify-content-center",
                            },
                            [
                              _c(
                                "b",
                                {
                                  staticClass: "text-primary",
                                  staticStyle: { "font-size": "0.8em" },
                                },
                                [_vm._v("Sexo")]
                              ),
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            {
                              staticClass:
                                "d-flex p-1 flex-fill justify-content-center",
                            },
                            [
                              _c(
                                "div",
                                {
                                  staticClass:
                                    "text-gray card-item-paciente-genero",
                                },
                                [_vm._v("F")]
                              ),
                            ]
                          ),
                        ]
                      ),
                    ]
                  ),
                ]),
              ]
            ),
            _vm._v(" "),
            _c("div", { staticClass: "flex-fill align-self-start p-1" }, [
              _c(
                "div",
                {
                  staticClass: "d-flex flex-column",
                  staticStyle: { width: "200px" },
                },
                [
                  _c(
                    "div",
                    { staticClass: "tarjeta-salud-chacao pb-1 bg-chacao" },
                    [
                      _c("div", { staticClass: "text-center" }, [
                        _c(
                          "b",
                          {
                            staticClass: "text-white",
                            staticStyle: { "font-size": "0.9em" },
                          },
                          [_vm._v("Soy CMDLT")]
                        ),
                      ]),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "d-flex justify-content-center w-100" },
                        [
                          _c(
                            "div",
                            {
                              staticClass:
                                "badge text-black badge-gray card-item-paciente-tarjeta-chacao",
                            },
                            [_vm._v("023548")]
                          ),
                        ]
                      ),
                    ]
                  ),
                  _vm._v(" "),
                  _c("div", [
                    _c("div", { staticClass: "text-center" }, [
                      _c(
                        "b",
                        {
                          staticClass: "text-primary",
                          staticStyle: { "font-size": "0.9em" },
                        },
                        [
                          _vm._v(
                            "\n                                                    Teléfono Contacto\n                                                "
                          ),
                        ]
                      ),
                    ]),
                    _vm._v(" "),
                    _c(
                      "div",
                      {
                        staticClass:
                          "d-flex flex-fill mb-1 justify-content-center",
                      },
                      [
                        _c(
                          "a",
                          {
                            staticClass:
                              "enlace-whatsapp btn btn-default mx-1 btn-block text-nowrap btn-sm tooltip-primary",
                            attrs: {
                              "data-tippy-content":
                                "Teléfono contacto del paciente: +No Indicado",
                              "data-telefono_movil": "+584241816596",
                            },
                          },
                          [
                            _c("i", {
                              staticClass:
                                "fab fa-whatsapp enlace-whatsapp text-success",
                              attrs: {
                                "aria-hidden": "true",
                                "data-telefono_movil": "+584241816596",
                              },
                            }),
                            _vm._v(" "),
                            _c(
                              "span",
                              {
                                staticClass:
                                  "enlace-whatsapp card-item-paciente-telefono-movil",
                                attrs: {
                                  "data-telefono_movil": "+584241816596",
                                },
                              },
                              [_vm._v("+584241816596")]
                            ),
                          ]
                        ),
                      ]
                    ),
                  ]),
                ]
              ),
            ]),
          ]
        ),
      ]),
    ])
  },
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/ConsultaExterna/components/CitasPorConfirmar.vue":
/*!**********************************************************************************!*\
  !*** ./resources/js/components/ConsultaExterna/components/CitasPorConfirmar.vue ***!
  \**********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CitasPorConfirmar_vue_vue_type_template_id_e7c8129a_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CitasPorConfirmar.vue?vue&type=template&id=e7c8129a&scoped=true& */ "./resources/js/components/ConsultaExterna/components/CitasPorConfirmar.vue?vue&type=template&id=e7c8129a&scoped=true&");
/* harmony import */ var _CitasPorConfirmar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CitasPorConfirmar.vue?vue&type=script&lang=js& */ "./resources/js/components/ConsultaExterna/components/CitasPorConfirmar.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _CitasPorConfirmar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _CitasPorConfirmar_vue_vue_type_template_id_e7c8129a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _CitasPorConfirmar_vue_vue_type_template_id_e7c8129a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "e7c8129a",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/ConsultaExterna/components/CitasPorConfirmar.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/ConsultaExterna/components/CitasPorConfirmar.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************!*\
  !*** ./resources/js/components/ConsultaExterna/components/CitasPorConfirmar.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CitasPorConfirmar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./CitasPorConfirmar.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ConsultaExterna/components/CitasPorConfirmar.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CitasPorConfirmar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/ConsultaExterna/components/CitasPorConfirmar.vue?vue&type=template&id=e7c8129a&scoped=true&":
/*!*****************************************************************************************************************************!*\
  !*** ./resources/js/components/ConsultaExterna/components/CitasPorConfirmar.vue?vue&type=template&id=e7c8129a&scoped=true& ***!
  \*****************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CitasPorConfirmar_vue_vue_type_template_id_e7c8129a_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./CitasPorConfirmar.vue?vue&type=template&id=e7c8129a&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ConsultaExterna/components/CitasPorConfirmar.vue?vue&type=template&id=e7c8129a&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CitasPorConfirmar_vue_vue_type_template_id_e7c8129a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CitasPorConfirmar_vue_vue_type_template_id_e7c8129a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);