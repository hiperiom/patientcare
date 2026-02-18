(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["index-statistics-component"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);


function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

/* harmony default export */ __webpack_exports__["default"] = ({
  props: ["base_url"],
  data: function data() {
    return {
      surveys: [],
      surveysPad: [],
      areas: [],
      currentArea: [],
      // date_start:"2024-01-01",
      date_start: new Date(new Date().getTime() - 7 * 86400000).toISOString().slice(0, 10),
      // hace 7 dias continuos
      date_end: new Date().toLocaleDateString('en-CA'),
      totalSurveys: 0,
      totalSurveysSent: 0,
      totalSurveysViewed: 0,
      totalSurveysAnswered: 0,
      area: false,
      survey: false,
      surveyPAD: {
        name: 'PAD',
        description: 'Programa de Atención Domiciliaria',
        totalTimeToAnswered: 0,
        totalSurvey: 0,
        totalSurveySent: 0,
        totalSurveyViewed: 0,
        totalSurveyAnswered: 0,
        puntuacion: {
          puntuacion: 0,
          maxPuntuacion: 0
        }
      }
    };
  },
  methods: {
    setCurrentArea: function setCurrentArea(currentArea) {
      this.currentArea = currentArea;
      $('#areaModal').modal('toggle');
    },
    closeAreaModal: function closeAreaModal() {
      this.currentArea = [];
      $('#areaModal').modal('toggle');
    },
    openClosePadModal: function openClosePadModal() {
      $('#padModal').modal('toggle');
    },
    setBySurveys: function setBySurveys() {
      this.area = false;
      this.survey = true;
    },
    setByAreas: function setByAreas() {
      this.survey = false;
      this.area = true;
    },
    showSurvey: function showSurvey(surveyId) {
      //redirigir a la encuesta específica
      window.location.href = location.origin + "/surveys_statistics/" + surveyId + "/" + this.date_start + "/" + this.date_end;
    },
    // ORIGINAL
    getSurveys: function getSurveys() {
      var _this = this;

      document.getElementById('loadingScreen').classList.remove("d-none");
      this.survey = false;
      this.area = false;
      this.surveyPAD = {
        name: 'PAD',
        description: 'Programa de Atención Domiciliaria',
        totalTimeToAnswered: 0,
        totalSurvey: 0,
        totalSurveySent: 0,
        totalSurveyViewed: 0,
        totalSurveyAnswered: 0,
        puntuacion: {
          puntuacion: 0,
          maxPuntuacion: 0
        }
      };
      axios.post(window.location.origin + "/getSurveys", {
        dateInit: this.date_start,
        dateEnd: this.date_end // }).then(async res => {

      }).then( /*#__PURE__*/function () {
        var _ref = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(res) {
          var x, _iterator, _step, _loop;

          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
            while (1) {
              switch (_context.prev = _context.next) {
                case 0:
                  _this.surveys = [];
                  _this.surveysPad = [];
                  _this.totalSurveys = 0;
                  _this.totalSurveysSent = 0;
                  _this.totalSurveysViewed = 0;
                  _this.totalSurveysAnswered = 0;
                  x = [];
                  _iterator = _createForOfIteratorHelper(res.data.surveys);

                  try {
                    _loop = function _loop() {
                      var survey = _step.value;
                      _this.totalSurveys += survey.totalSurvey;
                      _this.totalSurveysSent += survey.totalSurveySent;
                      _this.totalSurveysViewed += survey.totalSurveyViewed;
                      _this.totalSurveysAnswered += survey.totalSurveyAnswered; // nos traemos las estadisticas de cada encuesta
                      // let x = await axios.post(window.location.origin+"/surveys_statistics_ajax", {

                      x.push(axios.post(window.location.origin + "/surveys_statistics_ajax", {
                        survey_id: survey.id,
                        dateEnd: _this.date_end,
                        dateInit: _this.date_start
                      }).then(function (res) {
                        // 'survey', 'totalSurveys', 'totalSurveysSent', 'commentsSurvey', 'maxPuntuacionGlobal', 'puntuacionGlobal'
                        survey.puntuacion = {
                          survey_id: res.data.survey.id,
                          puntuacion: res.data.puntuacionGlobal,
                          maxPuntuacion: res.data.maxPuntuacionGlobal
                        };

                        if (survey.pad === 0) {
                          _this.surveys.push(survey);
                        } else {
                          _this.surveysPad.push(survey);
                        }
                      })["catch"](function (e) {
                        console.log('Error(surveys_statistics_ajax): ', e);
                      }));
                    };

                    for (_iterator.s(); !(_step = _iterator.n()).done;) {
                      _loop();
                    }
                  } catch (err) {
                    _iterator.e(err);
                  } finally {
                    _iterator.f();
                  }

                  ;

                  _this.getAreas(); // Espero todas las encuestas


                  _context.next = 13;
                  return Promise.all(x).then(function (res) {
                    _this.surveys.sort(function (a, b) {
                      return a.order - b.order;
                    });

                    _this.surveysPad.sort(function (a, b) {
                      return a.order - b.order;
                    });
                  });

                case 13:
                  // armo la tarjeta global del pad
                  _this.surveysPad.forEach(function (survey) {
                    _this.surveyPAD.totalTimeToAnswered += survey.totalTimeToAnswered;
                    _this.surveyPAD.totalSurvey += survey.totalSurvey;
                    _this.surveyPAD.totalSurveySent += survey.totalSurveySent;
                    _this.surveyPAD.totalSurveyViewed += survey.totalSurveyViewed;
                    _this.surveyPAD.totalSurveyAnswered += survey.totalSurveyAnswered;
                    _this.surveyPAD.puntuacion.puntuacion += survey.puntuacion.puntuacion;
                    _this.surveyPAD.puntuacion.maxPuntuacion += survey.puntuacion.maxPuntuacion;
                  });

                  _this.surveyPAD.totalTimeToAnswered = _this.surveyPAD.totalTimeToAnswered / _this.surveysPad.length;
                  _this.survey = true;
                  document.getElementById('loadingScreen').classList.add("d-none");

                case 17:
                case "end":
                  return _context.stop();
              }
            }
          }, _callee);
        }));

        return function (_x) {
          return _ref.apply(this, arguments);
        };
      }())["catch"](function (e) {
        console.log('Error(getSurveys): ', e);
      });
    },
    //ORIGINAL
    getAreas: function getAreas() {
      var _this2 = this;

      // document.getElementById('loadingScreen').classList.remove("d-none")
      this.areas = [];
      axios.get(window.location.origin + "/getAreas").then( /*#__PURE__*/function () {
        var _ref2 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3(res) {
          var x, _iterator2, _step2, _loop2;

          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {
            while (1) {
              switch (_context3.prev = _context3.next) {
                case 0:
                  // console.log(res.data)
                  x = [];
                  _iterator2 = _createForOfIteratorHelper(res.data);

                  try {
                    _loop2 = function _loop2() {
                      var area = _step2.value;
                      x.push(axios.post(window.location.origin + "/getStatisticsByAreaAjax", {
                        //area_id, dateEnd, dateInit
                        area_id: area.id,
                        dateEnd: _this2.date_end,
                        dateInit: _this2.date_start
                      }).then( /*#__PURE__*/function () {
                        var _ref3 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2(res) {
                          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
                            while (1) {
                              switch (_context2.prev = _context2.next) {
                                case 0:
                                  // console.log("getStatisticsByAreaAjax --> ",res.data)
                                  if (res.data.puntuacionGlobal !== 0) {
                                    area.puntuacion = {
                                      maxPuntuacionGlobal: res.data.maxPuntuacionGlobal,
                                      puntuacionGlobal: res.data.puntuacionGlobal,
                                      sections: res.data.sections
                                    };

                                    _this2.areas.push(area);
                                  } // console.log(this.areas)


                                case 1:
                                case "end":
                                  return _context2.stop();
                              }
                            }
                          }, _callee2);
                        }));

                        return function (_x3) {
                          return _ref3.apply(this, arguments);
                        };
                      }())["catch"](function (e) {
                        console.log('Error(getStatisticsByAreaAjax): ', e);
                      }));
                    };

                    for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
                      _loop2();
                    }
                  } catch (err) {
                    _iterator2.e(err);
                  } finally {
                    _iterator2.f();
                  }

                  _context3.next = 5;
                  return Promise.all(x);

                case 5:
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
    }
  },
  mounted: function mounted() {
    this.getSurveys(); // setInterval(this.getSurveys,600000)
  },
  created: function created() {}
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=template&id=5055216e&scoped=true&":
/*!*****************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=template&id=5055216e&scoped=true& ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************/
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
    staticClass: "container"
  }, [_c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-3"
  }, [_c("div", {
    staticClass: "info-box bg-primary text-white"
  }, [_vm._m(0), _vm._v(" "), _c("div", {
    staticClass: "info-box-content"
  }, [_vm._m(1), _vm._v(" "), _c("span", {
    staticClass: "info-box-number text-white"
  }, [_vm._v(_vm._s(_vm.totalSurveysAnswered) + " - "), _c("span", {
    staticClass: "badge badge-info",
    staticStyle: {
      background: "white",
      "font-size": "1rem",
      padding: "0 0.2em",
      "letter-spacing": "1.1pt",
      color: "var(--primary)"
    }
  }, [_c("b", [_vm._v(_vm._s(Math.round(_vm.totalSurveysAnswered * 100 / _vm.totalSurveysSent)) + "%")])])])])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-3"
  }, [_c("div", {
    staticClass: "info-box"
  }, [_vm._m(2), _vm._v(" "), _c("div", {
    staticClass: "info-box-content"
  }, [_vm._m(3), _vm._v(" "), _c("span", {
    staticClass: "info-box-number text-secondary"
  }, [_vm._v(_vm._s(_vm.totalSurveysSent))])])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-3"
  }, [_c("div", {
    staticClass: "info-box"
  }, [_vm._m(4), _vm._v(" "), _c("div", {
    staticClass: "info-box-content"
  }, [_c("div", {
    staticClass: "row"
  }, [_vm._m(5), _vm._v(" "), _c("div", {
    staticClass: "col-md-6 text-right text-primary"
  }, [_c("i", {
    staticClass: "fa fa-search",
    staticStyle: {
      cursor: "pointer"
    },
    on: {
      click: _vm.getSurveys
    }
  })])]), _vm._v(" "), _c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.date_start,
      expression: "date_start"
    }],
    staticClass: "border-0 text-secondary input-date font-weight-bold",
    attrs: {
      id: "date_start",
      type: "date"
    },
    domProps: {
      value: _vm.date_start
    },
    on: {
      keyup: function keyup($event) {
        if (!$event.type.indexOf("key") && _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")) return null;
        return _vm.getSurveys.apply(null, arguments);
      },
      input: function input($event) {
        if ($event.target.composing) return;
        _vm.date_start = $event.target.value;
      }
    }
  })])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-3"
  }, [_c("div", {
    staticClass: "info-box"
  }, [_vm._m(6), _vm._v(" "), _c("div", {
    staticClass: "info-box-content"
  }, [_c("div", {
    staticClass: "row"
  }, [_vm._m(7), _vm._v(" "), _c("div", {
    staticClass: "col-md-6 text-right text-primary"
  }, [_c("i", {
    staticClass: "fa fa-search",
    staticStyle: {
      cursor: "pointer"
    },
    on: {
      click: _vm.getSurveys
    }
  })])]), _vm._v(" "), _c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.date_end,
      expression: "date_end"
    }],
    staticClass: "border-0 text-secondary input-date font-weight-bold",
    attrs: {
      id: "date_end",
      type: "date"
    },
    domProps: {
      value: _vm.date_end
    },
    on: {
      keyup: function keyup($event) {
        if (!$event.type.indexOf("key") && _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")) return null;
        return _vm.getSurveys.apply(null, arguments);
      },
      input: function input($event) {
        if ($event.target.composing) return;
        _vm.date_end = $event.target.value;
      }
    }
  })])])])]), _vm._v(" "), _c("div", {
    staticClass: "bd-highlight mb-3"
  }, [_c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-6"
  }, [_c("button", {
    staticClass: "btn mt-2 btn-block",
    "class": {
      "btn-primary": _vm.survey === true ? true : false,
      "btn-grisclaro": _vm.survey === false ? true : false
    },
    attrs: {
      type: "button"
    },
    on: {
      click: _vm.setBySurveys
    }
  }, [_vm._v("\n                        FILTRAR POR ENCUESTAS\n                    ")])]), _vm._v(" "), _c("div", {
    staticClass: "col-6"
  }, [_c("button", {
    staticClass: "btn mt-2 btn-block",
    "class": {
      "btn-primary": _vm.area === true ? true : false,
      "btn-grisclaro": _vm.area === false ? true : false
    },
    attrs: {
      type: "button"
    },
    on: {
      click: _vm.setByAreas
    }
  }, [_vm._v("\n                        FILTRAR POR ÁREAS\n                    ")])])])]), _vm._v(" "), _c("div", {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: _vm.survey === true,
      expression: "survey === true"
    }],
    staticClass: "row"
  }, [_vm._l(_vm.surveys, function (survey, index) {
    return _c("div", {
      key: index,
      staticClass: "col-lg-3 col-md-6"
    }, [survey.totalSurvey !== 0 ? _c("div", {
      staticClass: "info-box text-secondary bg-gradient-gris-claro icono-mano",
      on: {
        click: function click($event) {
          return _vm.showSurvey(survey.id);
        }
      }
    }, [survey.totalSurvey !== 0 ? _c("div", {
      staticClass: "big-icon-envelope",
      "class": {
        "tooltip-success": survey.totalSurveyAnswered * 100 / survey.totalSurveySent >= 80 ? true : false,
        "tooltip-warning": survey.totalSurveyAnswered * 100 / survey.totalSurveySent < 80 && survey.totalSurveyAnswered * 100 / survey.totalSurveySent > 49 ? true : false,
        "tooltip-danger": survey.totalSurveyAnswered * 100 / survey.totalSurveySent < 50 ? true : false
      },
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: (survey.totalSurveyAnswered * 100 / survey.totalSurveySent).toFixed() + "% de respuesta."
      }
    }, [survey.totalSurveyAnswered * 100 / survey.totalSurveySent >= 80 ? _c("i", {
      staticClass: "far fa-envelope text-success"
    }) : _vm._e(), _vm._v(" "), survey.totalSurveyAnswered * 100 / survey.totalSurveySent < 80 && survey.totalSurveyAnswered * 100 / survey.totalSurveySent > 49 ? _c("i", {
      staticClass: "far fa-envelope text-warning"
    }) : _vm._e(), _vm._v(" "), survey.totalSurveyAnswered * 100 / survey.totalSurveySent < 50 ? _c("i", {
      staticClass: "far fa-envelope text-danger"
    }) : _vm._e()]) : _vm._e(), _vm._v(" "), survey.puntuacion.maxPuntuacion !== 0 ? _c("div", {
      staticClass: "big-icon-face",
      "class": {
        "tooltip-success": survey.puntuacion.puntuacion * 100 / survey.puntuacion.maxPuntuacion >= 80 ? true : false,
        "tooltip-warning": survey.puntuacion.puntuacion * 100 / survey.puntuacion.maxPuntuacion < 80 && survey.puntuacion.puntuacion * 100 / survey.puntuacion.maxPuntuacion > 49 ? true : false,
        "tooltip-danger": survey.puntuacion.puntuacion * 100 / survey.puntuacion.maxPuntuacion < 50 ? true : false
      },
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: (survey.puntuacion.puntuacion * 100 / survey.puntuacion.maxPuntuacion).toFixed() + "% de satisfacción."
      }
    }, [survey.puntuacion.puntuacion * 100 / survey.puntuacion.maxPuntuacion >= 80 ? _c("i", {
      staticClass: "far fa-smile text-success"
    }) : _vm._e(), _vm._v(" "), survey.puntuacion.puntuacion * 100 / survey.puntuacion.maxPuntuacion < 80 && survey.puntuacion.puntuacion * 100 / survey.puntuacion.maxPuntuacion > 49 ? _c("i", {
      staticClass: "far fa-meh text-warning"
    }) : _vm._e(), _vm._v(" "), survey.puntuacion.puntuacion * 100 / survey.puntuacion.maxPuntuacion < 50 ? _c("i", {
      staticClass: "far fa-frown text-danger"
    }) : _vm._e()]) : _vm._e(), _vm._v(" "), _c("div", {
      staticClass: "info-box-content"
    }, [_c("span", {
      staticClass: "info-box-text h5",
      staticStyle: {
        "z-index": "1001"
      }
    }, [_vm._v(_vm._s(survey.name.charAt(0).toUpperCase() + survey.name.slice(1)))]), _vm._v(" "), _c("p", {
      staticClass: "info-box-number"
    }, [_c("span", {
      staticClass: "big-text"
    }, [_vm._v(_vm._s(survey.totalSurvey))]), _vm._v(" encuesta" + _vm._s(survey.totalSurvey !== 1 ? "s" : "") + " en total.")]), _vm._v(" "), _c("multiple-progress-bar", {
      attrs: {
        surveyp: survey
      }
    }), _vm._v(" "), _c("div", {
      staticClass: "row justify-content-end pt-2 pr-3"
    }, [isNaN(new Date(survey.totalTimeToAnswered * 60000 / survey.totalSurveyAnswered).getUTCMinutes()) || isNaN(new Date(survey.totalTimeToAnswered * 60000 / survey.totalSurveyAnswered).getUTCSeconds()) ? _c("div", {
      staticClass: "col-1"
    }, [_c("i", {
      staticClass: "fas fa-stopwatch tooltip-primary",
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: "Sin datos para calcular el tiempo promedio de respuesta."
      }
    })]) : _c("div", {
      staticClass: "col-1"
    }, [_c("i", {
      staticClass: "fas fa-stopwatch tooltip-primary",
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: "Tiempo promedio de respuesta " + new Date(survey.totalTimeToAnswered * 60000 / survey.totalSurveyAnswered).getUTCMinutes() + " minutos y " + new Date(survey.totalTimeToAnswered * 60000 / survey.totalSurveyAnswered).getUTCSeconds() + " segundos"
      }
    })])])], 1)]) : _c("div", {
      staticClass: "info-box text-secondary bg-gradient-gris-claro"
    }, [_c("div", {
      staticClass: "info-box-content"
    }, [_c("span", {
      staticClass: "info-box-text h5",
      staticStyle: {
        "z-index": "1001"
      }
    }, [_vm._v(_vm._s(survey.name.charAt(0).toUpperCase() + survey.name.slice(1)))]), _vm._v(" "), _c("p", {
      staticClass: "info-box-number"
    }, [_c("span", {
      staticClass: "big-text"
    }, [_vm._v(_vm._s(survey.totalSurvey))]), _vm._v(" encuesta" + _vm._s(survey.totalSurvey !== 1 ? "s" : "") + " en total.")]), _vm._v(" "), _c("multiple-progress-bar", {
      attrs: {
        surveyp: survey
      }
    }), _vm._v(" "), _c("div", {
      staticClass: "row justify-content-end pt-2 pr-3"
    }, [isNaN(new Date(survey.totalTimeToAnswered * 60000 / survey.totalSurveyAnswered).getUTCMinutes()) || isNaN(new Date(survey.totalTimeToAnswered * 60000 / survey.totalSurveyAnswered).getUTCSeconds()) ? _c("div", {
      staticClass: "col-1"
    }, [_c("i", {
      staticClass: "fas fa-stopwatch tooltip-primary",
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: "Sin datos para calcular el tiempo promedio de respuesta."
      }
    })]) : _c("div", {
      staticClass: "col-1"
    }, [_c("i", {
      staticClass: "fas fa-stopwatch tooltip-primary",
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: "Tiempo promedio de respuesta " + new Date(survey.totalTimeToAnswered * 60000 / survey.totalSurveyAnswered).getUTCMinutes() + " minutos y " + new Date(survey.totalTimeToAnswered * 60000 / survey.totalSurveyAnswered).getUTCSeconds() + " segundos"
      }
    })])])], 1)])]);
  }), _vm._v(" "), _c("div", {
    staticClass: "col-lg-3 col-md-6"
  }, [_vm.surveyPAD.totalSurvey !== 0 ? _c("div", {
    staticClass: "info-box text-secondary bg-gradient-gris-claro icono-mano",
    on: {
      click: _vm.openClosePadModal
    }
  }, [_vm.surveyPAD.totalSurvey !== 0 ? _c("div", {
    staticClass: "big-icon-envelope",
    "class": {
      "tooltip-success": _vm.surveyPAD.totalSurveyAnswered * 100 / _vm.surveyPAD.totalSurveySent >= 80 ? true : false,
      "tooltip-warning": _vm.surveyPAD.totalSurveyAnswered * 100 / _vm.surveyPAD.totalSurveySent < 80 && _vm.surveyPAD.totalSurveyAnswered * 100 / _vm.surveyPAD.totalSurveySent > 49 ? true : false,
      "tooltip-danger": _vm.surveyPAD.totalSurveyAnswered * 100 / _vm.surveyPAD.totalSurveySent < 50 ? true : false
    },
    attrs: {
      "data-toggle": "tooltip",
      "data-placement": "top",
      title: (_vm.surveyPAD.totalSurveyAnswered * 100 / _vm.surveyPAD.totalSurveySent).toFixed() + "% de respuesta."
    }
  }, [_vm.surveyPAD.totalSurveyAnswered * 100 / _vm.surveyPAD.totalSurveySent >= 80 ? _c("i", {
    staticClass: "far fa-envelope text-success"
  }) : _vm._e(), _vm._v(" "), _vm.surveyPAD.totalSurveyAnswered * 100 / _vm.surveyPAD.totalSurveySent < 80 && _vm.surveyPAD.totalSurveyAnswered * 100 / _vm.surveyPAD.totalSurveySent > 49 ? _c("i", {
    staticClass: "far fa-envelope text-warning"
  }) : _vm._e(), _vm._v(" "), _vm.surveyPAD.totalSurveyAnswered * 100 / _vm.surveyPAD.totalSurveySent < 50 ? _c("i", {
    staticClass: "far fa-envelope text-danger"
  }) : _vm._e()]) : _vm._e(), _vm._v(" "), _vm.surveyPAD.puntuacion.maxPuntuacion !== 0 ? _c("div", {
    staticClass: "big-icon-face",
    "class": {
      "tooltip-success": _vm.surveyPAD.puntuacion.puntuacion * 100 / _vm.surveyPAD.puntuacion.maxPuntuacion >= 80 ? true : false,
      "tooltip-warning": _vm.surveyPAD.puntuacion.puntuacion * 100 / _vm.surveyPAD.puntuacion.maxPuntuacion < 80 && _vm.surveyPAD.puntuacion.puntuacion * 100 / _vm.surveyPAD.puntuacion.maxPuntuacion > 49 ? true : false,
      "tooltip-danger": _vm.surveyPAD.puntuacion.puntuacion * 100 / _vm.surveyPAD.puntuacion.maxPuntuacion < 50 ? true : false
    },
    attrs: {
      "data-toggle": "tooltip",
      "data-placement": "top",
      title: (_vm.surveyPAD.puntuacion.puntuacion * 100 / _vm.surveyPAD.puntuacion.maxPuntuacion).toFixed() + "% de satisfacción."
    }
  }, [_vm.surveyPAD.puntuacion.puntuacion * 100 / _vm.surveyPAD.puntuacion.maxPuntuacion >= 80 ? _c("i", {
    staticClass: "far fa-smile text-success"
  }) : _vm._e(), _vm._v(" "), _vm.surveyPAD.puntuacion.puntuacion * 100 / _vm.surveyPAD.puntuacion.maxPuntuacion < 80 && _vm.surveyPAD.puntuacion.puntuacion * 100 / _vm.surveyPAD.puntuacion.maxPuntuacion > 49 ? _c("i", {
    staticClass: "far fa-meh text-warning"
  }) : _vm._e(), _vm._v(" "), _vm.surveyPAD.puntuacion.puntuacion * 100 / _vm.surveyPAD.puntuacion.maxPuntuacion < 50 ? _c("i", {
    staticClass: "far fa-frown text-danger"
  }) : _vm._e()]) : _vm._e(), _vm._v(" "), _c("div", {
    staticClass: "info-box-content"
  }, [_c("span", {
    staticClass: "info-box-text h5",
    staticStyle: {
      "z-index": "1001"
    }
  }, [_vm._v(_vm._s(_vm.surveyPAD.name.charAt(0).toUpperCase() + _vm.surveyPAD.name.slice(1)))]), _vm._v(" "), _c("p", {
    staticClass: "info-box-number"
  }, [_c("span", {
    staticClass: "big-text"
  }, [_vm._v(_vm._s(_vm.surveyPAD.totalSurvey))]), _vm._v(" encuesta" + _vm._s(_vm.surveyPAD.totalSurvey !== 1 ? "s" : "") + " en total.")]), _vm._v(" "), _c("multiple-progress-bar", {
    attrs: {
      surveyp: _vm.surveyPAD
    }
  }), _vm._v(" "), _c("div", {
    staticClass: "row justify-content-end pt-2 pr-3"
  }, [isNaN(new Date(_vm.surveyPAD.totalTimeToAnswered * 60000 / _vm.surveyPAD.totalSurveyAnswered).getUTCMinutes()) || isNaN(new Date(_vm.surveyPAD.totalTimeToAnswered * 60000 / _vm.surveyPAD.totalSurveyAnswered).getUTCSeconds()) ? _c("div", {
    staticClass: "col-1"
  }, [_c("i", {
    staticClass: "fas fa-stopwatch tooltip-primary",
    attrs: {
      "data-toggle": "tooltip",
      "data-placement": "top",
      title: "Sin datos para calcular el tiempo promedio de respuesta."
    }
  })]) : _c("div", {
    staticClass: "col-1"
  }, [_c("i", {
    staticClass: "fas fa-stopwatch tooltip-primary",
    attrs: {
      "data-toggle": "tooltip",
      "data-placement": "top",
      title: "Tiempo promedio de respuesta " + new Date(_vm.surveyPAD.totalTimeToAnswered * 60000 / _vm.surveyPAD.totalSurveyAnswered).getUTCMinutes() + " minutos y " + new Date(_vm.surveyPAD.totalTimeToAnswered * 60000 / _vm.surveyPAD.totalSurveyAnswered).getUTCSeconds() + " segundos"
    }
  })])])], 1)]) : _c("div", {
    staticClass: "info-box text-secondary bg-gradient-gris-claro"
  }, [_c("div", {
    staticClass: "info-box-content"
  }, [_c("span", {
    staticClass: "info-box-text h5",
    staticStyle: {
      "z-index": "1001"
    }
  }, [_vm._v(_vm._s(_vm.surveyPAD.name.charAt(0).toUpperCase() + _vm.surveyPAD.name.slice(1)))]), _vm._v(" "), _c("p", {
    staticClass: "info-box-number"
  }, [_c("span", {
    staticClass: "big-text"
  }, [_vm._v(_vm._s(_vm.surveyPAD.totalSurvey))]), _vm._v(" encuesta" + _vm._s(_vm.surveyPAD.totalSurvey !== 1 ? "s" : "") + " en total.")]), _vm._v(" "), _c("multiple-progress-bar", {
    attrs: {
      surveyp: _vm.surveyPAD
    }
  }), _vm._v(" "), _c("div", {
    staticClass: "row justify-content-end pt-2 pr-3"
  }, [isNaN(new Date(_vm.surveyPAD.totalTimeToAnswered * 60000 / _vm.surveyPAD.totalSurveyAnswered).getUTCMinutes()) || isNaN(new Date(_vm.surveyPAD.totalTimeToAnswered * 60000 / _vm.surveyPAD.totalSurveyAnswered).getUTCSeconds()) ? _c("div", {
    staticClass: "col-1"
  }, [_c("i", {
    staticClass: "fas fa-stopwatch tooltip-primary",
    attrs: {
      "data-toggle": "tooltip",
      "data-placement": "top",
      title: "Sin datos para calcular el tiempo promedio de respuesta."
    }
  })]) : _c("div", {
    staticClass: "col-1"
  }, [_c("i", {
    staticClass: "fas fa-stopwatch tooltip-primary",
    attrs: {
      "data-toggle": "tooltip",
      "data-placement": "top",
      title: "Tiempo promedio de respuesta " + new Date(_vm.surveyPAD.totalTimeToAnswered * 60000 / _vm.surveyPAD.totalSurveyAnswered).getUTCMinutes() + " minutos y " + new Date(_vm.surveyPAD.totalTimeToAnswered * 60000 / _vm.surveyPAD.totalSurveyAnswered).getUTCSeconds() + " segundos"
    }
  })])])], 1)])])], 2), _vm._v(" "), _c("div", {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: _vm.area === true,
      expression: "area === true"
    }],
    staticClass: "row"
  }, _vm._l(_vm.areas, function (area) {
    return _c("div", {
      key: area.name,
      staticClass: "col-lg-3 col-md-6"
    }, [area.puntuacion.maxPuntuacionGlobal !== 0 ? _c("div", {
      staticClass: "info-box text-secondary bg-gradient-gris-claro icono-mano",
      on: {
        click: function click($event) {
          return _vm.setCurrentArea(area);
        }
      }
    }, [_c("div", {
      staticClass: "big-icon-face",
      "class": {
        "tooltip-success": area.puntuacion.puntuacionGlobal * 100 / area.puntuacion.maxPuntuacionGlobal >= 80 ? true : false,
        "tooltip-warning": area.puntuacion.puntuacionGlobal * 100 / area.puntuacion.maxPuntuacionGlobal < 80 && area.puntuacion.puntuacionGlobal * 100 / area.puntuacion.maxPuntuacionGlobal > 49 ? true : false,
        "tooltip-danger": area.puntuacion.puntuacionGlobal * 100 / area.puntuacion.maxPuntuacionGlobal < 50 ? true : false
      },
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: (area.puntuacion.puntuacionGlobal * 100 / area.puntuacion.maxPuntuacionGlobal).toFixed() + "% de satisfacción."
      }
    }, [area.puntuacion.puntuacionGlobal * 100 / area.puntuacion.maxPuntuacionGlobal >= 80 ? _c("i", {
      staticClass: "far fa-smile text-success"
    }) : _vm._e(), _vm._v(" "), area.puntuacion.puntuacionGlobal * 100 / area.puntuacion.maxPuntuacionGlobal < 80 && area.puntuacion.puntuacionGlobal * 100 / area.puntuacion.maxPuntuacionGlobal > 49 ? _c("i", {
      staticClass: "far fa-meh text-warning"
    }) : _vm._e(), _vm._v(" "), area.puntuacion.puntuacionGlobal * 100 / area.puntuacion.maxPuntuacionGlobal < 50 ? _c("i", {
      staticClass: "far fa-frown text-danger"
    }) : _vm._e()]), _vm._v(" "), _c("div", {
      staticClass: "info-box-content"
    }, [_c("div", {
      staticClass: "row"
    }, [_c("div", {
      staticClass: "col-12"
    }, [_c("span", {
      staticClass: "info-box-text h5",
      staticStyle: {
        "z-index": "1001"
      }
    }, [_vm._v(_vm._s(area.name.charAt(0).toUpperCase() + area.name.slice(1)))]), _vm._v(" "), _c("p", {
      staticClass: "info-box-number"
    }, [_c("span", {
      staticClass: "big-text"
    }, [_vm._v(_vm._s((area.puntuacion.puntuacionGlobal * 100 / area.puntuacion.maxPuntuacionGlobal).toFixed()) + "%")]), _vm._v(" de satisfacción.")]), _vm._v(" "), _c("div", {
      staticClass: "progress",
      staticStyle: {
        height: "25px",
        "border-radius": "0px 12.5px 12.5px 0px",
        width: "100%"
      }
    }, [_c("div", {
      staticClass: "progress-bar progress-bar-striped",
      "class": {
        "bg-success": area.puntuacion.puntuacionGlobal * 100 / area.puntuacion.maxPuntuacionGlobal >= 80 ? true : false,
        "bg-warning": area.puntuacion.puntuacionGlobal * 100 / area.puntuacion.maxPuntuacionGlobal < 80 && area.puntuacion.puntuacionGlobal * 100 / area.puntuacion.maxPuntuacionGlobal > 49 ? true : false,
        "bg-danger": area.puntuacion.puntuacionGlobal * 100 / area.puntuacion.maxPuntuacionGlobal < 50 ? true : false
      },
      staticStyle: {
        height: "25px",
        "border-radius": "0px 12.5px 12.5px 0px"
      },
      style: {
        width: (area.puntuacion.puntuacionGlobal * 100 / area.puntuacion.maxPuntuacionGlobal).toFixed() + "%"
      },
      attrs: {
        role: "progressbar",
        "aria-valuenow": (area.puntuacion.puntuacionGlobal * 100 / area.puntuacion.maxPuntuacionGlobal).toFixed(),
        "aria-valuemin": "0",
        "aria-valuemax": "100"
      }
    }, [_vm._v(_vm._s((area.puntuacion.puntuacionGlobal * 100 / area.puntuacion.maxPuntuacionGlobal).toFixed()) + "%")])])])])])]) : _vm._e()]);
  }), 0), _vm._v(" "), _c("div", {
    staticClass: "modal fade",
    attrs: {
      id: "areaModal",
      tabindex: "-1",
      "aria-labelledby": "areaModalLabel",
      "aria-hidden": "true"
    }
  }, [_c("div", {
    staticClass: "modal-dialog modal-dialog-centered"
  }, [_vm.currentArea.length !== 0 ? _c("div", {
    staticClass: "modal-content"
  }, [_vm._m(8), _vm._v(" "), _c("div", {
    staticClass: "modal-body"
  }, _vm._l(_vm.currentArea.puntuacion.sections, function (section, index) {
    return _c("div", {
      key: index,
      staticClass: "col-12",
      staticStyle: {
        "margin-top": "5px",
        "margin-bottom": "5px"
      }
    }, [section.maxPuntuacion !== 0 ? _c("span", [_c("span", {
      staticClass: "info-box-text h6",
      staticStyle: {
        "z-index": "1001"
      }
    }, [_vm._v(_vm._s(section.name) + " ("), _c("strong", [_vm._v(_vm._s(section.survey.name.charAt(0).toUpperCase() + section.survey.name.slice(1)))]), _vm._v(")")]), _vm._v(" "), _c("div", {
      staticClass: "progress",
      staticStyle: {
        height: "20px",
        "border-radius": "0px 10px 10px 0px",
        width: "100%"
      }
    }, [_c("div", {
      staticClass: "progress-bar progress-bar-striped",
      "class": {
        "bg-success": section.puntuacion * 100 / section.maxPuntuacion >= 80 ? true : false,
        "bg-warning": section.puntuacion * 100 / section.maxPuntuacion < 80 && section.puntuacion * 100 / section.maxPuntuacion > 49 ? true : false,
        "bg-danger": section.puntuacion * 100 / section.maxPuntuacion < 50 ? true : false
      },
      staticStyle: {
        height: "20px",
        "border-radius": "0px 10px 10px 0px"
      },
      style: {
        width: section.puntuacion * 100 / section.maxPuntuacion + "%"
      },
      attrs: {
        role: "progressbar",
        "aria-valuenow": section.puntuacion * 100 / section.maxPuntuacion,
        "aria-valuemin": "0",
        "aria-valuemax": "100"
      }
    }, [_vm._v(_vm._s((section.puntuacion * 100 / section.maxPuntuacion).toFixed()) + "%")])])]) : _vm._e()]);
  }), 0), _vm._v(" "), _c("div", {
    staticClass: "modal-footer"
  }, [_c("button", {
    staticClass: "btn btn-primary btn-sm",
    attrs: {
      type: "button"
    },
    on: {
      click: _vm.closeAreaModal
    }
  }, [_vm._v("Regresar")])])]) : _vm._e()])]), _vm._v(" "), _c("div", {
    staticClass: "modal fade",
    attrs: {
      id: "padModal",
      tabindex: "-1",
      "aria-labelledby": "padModalLabel",
      "aria-hidden": "true"
    }
  }, [_c("div", {
    staticClass: "modal-dialog modal-lg modal-dialog-centered"
  }, [_c("div", {
    staticClass: "modal-content"
  }, [_vm._m(9), _vm._v(" "), _c("div", {
    staticClass: "modal-body"
  }, [_c("div", {
    staticClass: "row"
  }, _vm._l(_vm.surveysPad, function (survey, index) {
    return _c("div", {
      key: index,
      staticClass: "col-lg-4 col-md-6"
    }, [survey.totalSurvey !== 0 ? _c("div", {
      staticClass: "info-box text-secondary bg-gradient-gris-claro icono-mano",
      on: {
        click: function click($event) {
          return _vm.showSurvey(survey.id);
        }
      }
    }, [survey.totalSurvey !== 0 ? _c("div", {
      staticClass: "big-icon-envelope",
      "class": {
        "tooltip-success": survey.totalSurveyAnswered * 100 / survey.totalSurveySent >= 80 ? true : false,
        "tooltip-warning": survey.totalSurveyAnswered * 100 / survey.totalSurveySent < 80 && survey.totalSurveyAnswered * 100 / survey.totalSurveySent > 49 ? true : false,
        "tooltip-danger": survey.totalSurveyAnswered * 100 / survey.totalSurveySent < 50 ? true : false
      },
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: (survey.totalSurveyAnswered * 100 / survey.totalSurveySent).toFixed() + "% de respuesta."
      }
    }, [survey.totalSurveyAnswered * 100 / survey.totalSurveySent >= 80 ? _c("i", {
      staticClass: "far fa-envelope text-success"
    }) : _vm._e(), _vm._v(" "), survey.totalSurveyAnswered * 100 / survey.totalSurveySent < 80 && survey.totalSurveyAnswered * 100 / survey.totalSurveySent > 49 ? _c("i", {
      staticClass: "far fa-envelope text-warning"
    }) : _vm._e(), _vm._v(" "), survey.totalSurveyAnswered * 100 / survey.totalSurveySent < 50 ? _c("i", {
      staticClass: "far fa-envelope text-danger"
    }) : _vm._e()]) : _vm._e(), _vm._v(" "), survey.puntuacion.maxPuntuacion !== 0 ? _c("div", {
      staticClass: "big-icon-face",
      "class": {
        "tooltip-success": survey.puntuacion.puntuacion * 100 / survey.puntuacion.maxPuntuacion >= 80 ? true : false,
        "tooltip-warning": survey.puntuacion.puntuacion * 100 / survey.puntuacion.maxPuntuacion < 80 && survey.puntuacion.puntuacion * 100 / survey.puntuacion.maxPuntuacion > 49 ? true : false,
        "tooltip-danger": survey.puntuacion.puntuacion * 100 / survey.puntuacion.maxPuntuacion < 50 ? true : false
      },
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: (survey.puntuacion.puntuacion * 100 / survey.puntuacion.maxPuntuacion).toFixed() + "% de satisfacción."
      }
    }, [survey.puntuacion.puntuacion * 100 / survey.puntuacion.maxPuntuacion >= 80 ? _c("i", {
      staticClass: "far fa-smile text-success"
    }) : _vm._e(), _vm._v(" "), survey.puntuacion.puntuacion * 100 / survey.puntuacion.maxPuntuacion < 80 && survey.puntuacion.puntuacion * 100 / survey.puntuacion.maxPuntuacion > 49 ? _c("i", {
      staticClass: "far fa-meh text-warning"
    }) : _vm._e(), _vm._v(" "), survey.puntuacion.puntuacion * 100 / survey.puntuacion.maxPuntuacion < 50 ? _c("i", {
      staticClass: "far fa-frown text-danger"
    }) : _vm._e()]) : _vm._e(), _vm._v(" "), _c("div", {
      staticClass: "info-box-content"
    }, [_c("span", {
      staticClass: "info-box-text h5",
      staticStyle: {
        "z-index": "1001"
      }
    }, [_vm._v(_vm._s(survey.name.charAt(0).toUpperCase() + survey.name.slice(1)))]), _vm._v(" "), _c("p", {
      staticClass: "info-box-number"
    }, [_c("span", {
      staticClass: "big-text"
    }, [_vm._v(_vm._s(survey.totalSurvey))]), _vm._v(" encuesta" + _vm._s(survey.totalSurvey !== 1 ? "s" : "") + " en total.")]), _vm._v(" "), _c("multiple-progress-bar", {
      attrs: {
        surveyp: survey
      }
    }), _vm._v(" "), _c("div", {
      staticClass: "row justify-content-end pt-2 pr-3"
    }, [isNaN(new Date(survey.totalTimeToAnswered * 60000 / survey.totalSurveyAnswered).getUTCMinutes()) || isNaN(new Date(survey.totalTimeToAnswered * 60000 / survey.totalSurveyAnswered).getUTCSeconds()) ? _c("div", {
      staticClass: "col-1"
    }, [_c("i", {
      staticClass: "fas fa-stopwatch tooltip-primary",
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: "Sin datos para calcular el tiempo promedio de respuesta."
      }
    })]) : _c("div", {
      staticClass: "col-1"
    }, [_c("i", {
      staticClass: "fas fa-stopwatch tooltip-primary",
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: "Tiempo promedio de respuesta " + new Date(survey.totalTimeToAnswered * 60000 / survey.totalSurveyAnswered).getUTCMinutes() + " minutos y " + new Date(survey.totalTimeToAnswered * 60000 / survey.totalSurveyAnswered).getUTCSeconds() + " segundos"
      }
    })])])], 1)]) : _c("div", {
      staticClass: "info-box text-secondary bg-gradient-gris-claro"
    }, [_c("div", {
      staticClass: "info-box-content"
    }, [_c("span", {
      staticClass: "info-box-text h5",
      staticStyle: {
        "z-index": "1001"
      }
    }, [_vm._v(_vm._s(survey.name.charAt(0).toUpperCase() + survey.name.slice(1)))]), _vm._v(" "), _c("p", {
      staticClass: "info-box-number"
    }, [_c("span", {
      staticClass: "big-text"
    }, [_vm._v(_vm._s(survey.totalSurvey))]), _vm._v(" encuesta" + _vm._s(survey.totalSurvey !== 1 ? "s" : "") + " en total.")]), _vm._v(" "), _c("multiple-progress-bar", {
      attrs: {
        surveyp: survey
      }
    }), _vm._v(" "), _c("div", {
      staticClass: "row justify-content-end pt-2 pr-3"
    }, [isNaN(new Date(survey.totalTimeToAnswered * 60000 / survey.totalSurveyAnswered).getUTCMinutes()) || isNaN(new Date(survey.totalTimeToAnswered * 60000 / survey.totalSurveyAnswered).getUTCSeconds()) ? _c("div", {
      staticClass: "col-1"
    }, [_c("i", {
      staticClass: "fas fa-stopwatch tooltip-primary",
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: "Sin datos para calcular el tiempo promedio de respuesta."
      }
    })]) : _c("div", {
      staticClass: "col-1"
    }, [_c("i", {
      staticClass: "fas fa-stopwatch tooltip-primary",
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: "Tiempo promedio de respuesta " + new Date(survey.totalTimeToAnswered * 60000 / survey.totalSurveyAnswered).getUTCMinutes() + " minutos y " + new Date(survey.totalTimeToAnswered * 60000 / survey.totalSurveyAnswered).getUTCSeconds() + " segundos"
      }
    })])])], 1)])]);
  }), 0)]), _vm._v(" "), _c("div", {
    staticClass: "modal-footer"
  }, [_c("button", {
    staticClass: "btn btn-primary btn-sm",
    attrs: {
      type: "button"
    },
    on: {
      click: _vm.openClosePadModal
    }
  }, [_vm._v("Regresar")])])])])])]);
};

var staticRenderFns = [function () {
  var _vm = this,
      _c = _vm._self._c;

  return _c("span", {
    staticClass: "info-box-icon bg-primary"
  }, [_c("i", {
    staticClass: "far fa-file-alt"
  })]);
}, function () {
  var _vm = this,
      _c = _vm._self._c;

  return _c("span", {
    staticClass: "info-box-text font-weight-bold text-white"
  }, [_vm._v("Total de"), _c("br"), _vm._v("encuestas contestadas")]);
}, function () {
  var _vm = this,
      _c = _vm._self._c;

  return _c("span", {
    staticClass: "info-box-icon bg-primary"
  }, [_c("i", {
    staticClass: "far fa-paper-plane"
  })]);
}, function () {
  var _vm = this,
      _c = _vm._self._c;

  return _c("span", {
    staticClass: "info-box-text text-primary font-weight-bold"
  }, [_vm._v("Total de"), _c("br"), _vm._v("encuestas enviadas")]);
}, function () {
  var _vm = this,
      _c = _vm._self._c;

  return _c("span", {
    staticClass: "info-box-icon bg-primary"
  }, [_c("i", {
    staticClass: "far fa-calendar-alt"
  })]);
}, function () {
  var _vm = this,
      _c = _vm._self._c;

  return _c("div", {
    staticClass: "col-md-6"
  }, [_c("label", {
    staticClass: "info-box-text text-primary",
    attrs: {
      "for": "date_start"
    }
  }, [_vm._v("Desde")])]);
}, function () {
  var _vm = this,
      _c = _vm._self._c;

  return _c("span", {
    staticClass: "info-box-icon bg-primary"
  }, [_c("i", {
    staticClass: "far fa-calendar-alt"
  })]);
}, function () {
  var _vm = this,
      _c = _vm._self._c;

  return _c("div", {
    staticClass: "col-md-6"
  }, [_c("label", {
    staticClass: "info-box-text text-primary",
    attrs: {
      "for": "date_end"
    }
  }, [_vm._v("Hasta")])]);
}, function () {
  var _vm = this,
      _c = _vm._self._c;

  return _c("div", {
    staticClass: "modal-header"
  }, [_c("span", {
    staticClass: "info-box-text h5 modal-title",
    staticStyle: {
      "z-index": "1001"
    },
    attrs: {
      id: "areaModalLabel"
    }
  }, [_vm._v("Satisfacción de las secciones relacionadas")])]);
}, function () {
  var _vm = this,
      _c = _vm._self._c;

  return _c("div", {
    staticClass: "modal-header"
  }, [_c("span", {
    staticClass: "info-box-text h5 modal-title",
    staticStyle: {
      "z-index": "1001"
    },
    attrs: {
      id: "padModalLabel"
    }
  }, [_vm._v("Encuestas relacionadas al PAD")])]);
}];
render._withStripped = true;


/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=style&index=0&id=5055216e&scoped=true&lang=css&":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=style&index=0&id=5055216e&scoped=true&lang=css& ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.progress[data-v-5055216e]{\r\n    height: 15px;\n}\n.nav-link[data-v-5055216e]{\r\n    background-color:rgb(0,0,0,0.3) ;\r\n    border-radius: 0px;\r\n    color: white;\n}\n.nav-link.active[data-v-5055216e]{\r\n    background-color: var(--primary);\r\n    border-radius: 0px;\r\n    color: white;\n}\n.btn-grisclaro[data-v-5055216e]{\r\n    background-color:rgb(0,0,0,0.3) ;\r\n    color: white;\n}\n.info-box[data-v-5055216e]{\r\n    border-radius: 1.5rem;\n}\n.info-box .info-box-icon[data-v-5055216e]{\r\n    border-radius: 1.5rem 0.25rem 0.25rem 1.5rem;\n}\n.icono-mano[data-v-5055216e]:hover {\r\n  cursor: pointer;\n}\n.big-icon-envelope[data-v-5055216e] {\r\n    position:absolute;\r\n    top: 40px;\r\n    right: 20px;\r\n    z-index:1000;\r\n    font-size:2rem;\r\n    opacity: 0.75;\n}\n.big-icon-face[data-v-5055216e] {\r\n    position:absolute;\r\n    top: 7px;\r\n    right: 20px;\r\n    z-index:1000;\r\n    font-size:2rem;\r\n    opacity: 0.75;\n}\n.bg-gradient-gris-claro[data-v-5055216e] {\r\n    background-color: rgb(181, 180, 177,0.25);\n}\n.big-text[data-v-5055216e]{\r\n    font-size: 1.5rem;\n}\r\n\r\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=style&index=0&id=5055216e&scoped=true&lang=css&":
/*!******************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=style&index=0&id=5055216e&scoped=true&lang=css& ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader??ref--6-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./IndexStatisticsComponent.vue?vue&type=style&index=0&id=5055216e&scoped=true&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=style&index=0&id=5055216e&scoped=true&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./resources/js/components/surveys/IndexStatisticsComponent.vue":
/*!**********************************************************************!*\
  !*** ./resources/js/components/surveys/IndexStatisticsComponent.vue ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _IndexStatisticsComponent_vue_vue_type_template_id_5055216e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./IndexStatisticsComponent.vue?vue&type=template&id=5055216e&scoped=true& */ "./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=template&id=5055216e&scoped=true&");
/* harmony import */ var _IndexStatisticsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./IndexStatisticsComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _IndexStatisticsComponent_vue_vue_type_style_index_0_id_5055216e_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./IndexStatisticsComponent.vue?vue&type=style&index=0&id=5055216e&scoped=true&lang=css& */ "./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=style&index=0&id=5055216e&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _IndexStatisticsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _IndexStatisticsComponent_vue_vue_type_template_id_5055216e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _IndexStatisticsComponent_vue_vue_type_template_id_5055216e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "5055216e",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/surveys/IndexStatisticsComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_IndexStatisticsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./IndexStatisticsComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_IndexStatisticsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=style&index=0&id=5055216e&scoped=true&lang=css&":
/*!*******************************************************************************************************************************!*\
  !*** ./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=style&index=0&id=5055216e&scoped=true&lang=css& ***!
  \*******************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_IndexStatisticsComponent_vue_vue_type_style_index_0_id_5055216e_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader??ref--6-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./IndexStatisticsComponent.vue?vue&type=style&index=0&id=5055216e&scoped=true&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=style&index=0&id=5055216e&scoped=true&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_IndexStatisticsComponent_vue_vue_type_style_index_0_id_5055216e_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_IndexStatisticsComponent_vue_vue_type_style_index_0_id_5055216e_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_IndexStatisticsComponent_vue_vue_type_style_index_0_id_5055216e_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_IndexStatisticsComponent_vue_vue_type_style_index_0_id_5055216e_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=template&id=5055216e&scoped=true&":
/*!*****************************************************************************************************************!*\
  !*** ./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=template&id=5055216e&scoped=true& ***!
  \*****************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_IndexStatisticsComponent_vue_vue_type_template_id_5055216e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../node_modules/vue-loader/lib??vue-loader-options!./IndexStatisticsComponent.vue?vue&type=template&id=5055216e&scoped=true& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/surveys/IndexStatisticsComponent.vue?vue&type=template&id=5055216e&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_IndexStatisticsComponent_vue_vue_type_template_id_5055216e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_IndexStatisticsComponent_vue_vue_type_template_id_5055216e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);