(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["section-statistics-component"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/surveys/SectionStatisticsComponent.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/surveys/SectionStatisticsComponent.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ["section", "base_url", "date-start", "date-end"],
  data: function data() {
    return {};
  },
  methods: {
    closeModal: function closeModal() {
      $('.carousel').carousel(0);
      $('#sectionModal').modal('toggle');
    },
    getStatistics: function getStatistics() {
      var _this = this;

      axios.post(window.location.origin + "/surveys_statistics_ajax", {
        dateInit: this.date_start,
        dateEnd: this.date_end,
        survey_id: this.survey.id
      }).then(function (res) {
        console.log(res.data);
        _this.currentSurvey = res.data.survey;
        _this.commentsSurvey = res.data.commentsSurvey;
        _this.totalSurveys = res.data.totalSurveys;
        _this.totalSurveysSent = res.data.totalSurveysSent;
      })["catch"](function (e) {});
    }
  },
  created: function created() {
    $(document).ready(function () {
      $("body").tooltip({
        selector: '[data-toggle=tooltip].tooltip-primary',
        customClass: 'tooltip-primary'
      });
    });
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/surveys/SectionStatisticsComponent.vue?vue&type=template&id=154fb4d4&":
/*!*******************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/surveys/SectionStatisticsComponent.vue?vue&type=template&id=154fb4d4& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************/
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
    staticClass: "modal fade",
    staticStyle: {
      display: "none"
    },
    attrs: {
      id: "sectionModal",
      tabindex: "-1",
      "aria-labelledby": "sectionModalLabel",
      "data-backdrop": "static",
      "aria-hidden": "true"
    }
  }, [_c("div", {
    staticClass: "modal-dialog modal-dialog-centered modal-lg"
  }, [_c("div", {
    staticClass: "modal-content"
  }, [_c("div", {
    staticClass: "modal-header bg-primary"
  }, [_c("div", {
    staticClass: "sticky-top",
    staticStyle: {
      "padding-right": "15px",
      "margin-right": "-15px"
    }
  }, [_c("img", {
    staticClass: "img-fluid pr-2",
    staticStyle: {
      "float": "right !important",
      height: "3em !important",
      width: "120px"
    },
    attrs: {
      "aria-label": "Close",
      src: "/image/system/logo-cmdlt-blanco.svg"
    }
  }), _vm._v(" "), _c("i", {
    staticClass: "fas fa-times text-white position-fixed zoom",
    staticStyle: {
      "z-index": "1000 !important",
      "font-size": "3em",
      right: "5%",
      cursor: "pointer"
    },
    attrs: {
      id: "close_modal",
      "aria-label": "Close",
      "aria-hidden": "true"
    },
    on: {
      click: _vm.closeModal
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "modal-body"
  }, [_c("div", {
    staticClass: "small-box",
    "class": {
      "bg-primary": _vm.section.maxPuntuacion === 0,
      "bg-success": _vm.section.puntuacion * 100 / _vm.section.maxPuntuacion >= 80 && _vm.section.maxPuntuacion != 0 ? true : false,
      "bg-warning": _vm.section.puntuacion * 100 / _vm.section.maxPuntuacion < 80 && _vm.section.maxPuntuacion != 0 ? true : false,
      "bg-danger": _vm.section.puntuacion * 100 / _vm.section.maxPuntuacion < 50 && _vm.section.maxPuntuacion != 0 ? true : false
    }
  }, [_c("div", {
    staticClass: "inner"
  }, [_vm.section.maxPuntuacion != 0 ? _c("h3", [_vm._v(_vm._s(Math.round(_vm.section.puntuacion * 100 / _vm.section.maxPuntuacion))), _c("sup", {
    staticStyle: {
      "font-size": "20px"
    }
  }, [_vm._v("%")])]) : _c("h3", [_vm._v("0"), _c("sup", {
    staticStyle: {
      "font-size": "20px"
    }
  }, [_vm._v("%")])]), _vm._v(" "), _c("p", [_vm._v(_vm._s(_vm.section.name))])]), _vm._v(" "), _c("div", {
    staticClass: "icon"
  }, [_c("i", {
    "class": _vm.section.icon
  })])]), _vm._v(" "), _c("div", {
    staticClass: "container-fluid"
  }, [_c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-12"
  }, [_c("div", {
    staticClass: "carousel slide overflow-auto",
    staticStyle: {
      height: "fit-content"
    },
    attrs: {
      id: "carouselExampleControls",
      "data-interval": "false",
      "data-ride": "carousel"
    }
  }, [_c("div", {
    staticClass: "carousel-inner"
  }, _vm._l(_vm.section.questions, function (question, index) {
    return _c("div", {
      key: index,
      staticClass: "carousel-item",
      "class": {
        active: index === 0 ? true : false
      }
    }, [_c("span", {
      staticClass: "d-flex justify-content-center rounded-pill p-1 my-1 bg-gray"
    }, [_c("div", {
      staticClass: "text-primary",
      staticStyle: {
        "letter-spacing": "2px"
      }
    }, [_vm._v("\n                                                    Desde: " + _vm._s(_vm.dateStart) + " - Hasta: " + _vm._s(_vm.dateEnd) + "\n                                                ")])]), _vm._v(" "), _c("span", [_c("h4", {
      staticClass: "text-center text-gray"
    }, [_c("b", [_vm._v(_vm._s(question.description))])]), _vm._v(" "), _c("div", {
      staticClass: "text-primary text-center",
      staticStyle: {
        "font-size": "0.8em !important"
      }
    }, [_c("h5", [_c("b", [_c("span", {
      staticClass: "badge badge-gray text-primary"
    }, [_vm._v(_vm._s(question.responses))]), _vm._v(" Respuestas encontradas")])])])]), _vm._v(" "), _c("div", {
      staticClass: "mb-3"
    }, [question.comments.length > 0 ? _c("div", {
      staticClass: "pb-3 pt-2",
      staticStyle: {
        "border-top": "3px solid #185ba9",
        "border-radius": "0.25em"
      }
    }, [_c("a", {
      attrs: {
        "data-toggle": "collapse",
        href: "#collapseOpinionsQuestion",
        "aria-expanded": "false",
        "aria-controls": "collapseExample"
      }
    }, [_c("h3", {
      staticClass: "card-title w-100 text-center text-primary pa-2"
    }, [_vm._v("Opiniones "), _c("span", {
      staticClass: "badge badge-primary"
    }, [_vm._v(_vm._s(question.comments.length))])])])]) : _vm._e(), _vm._v(" "), _c("div", {
      staticClass: "collapse card-header",
      attrs: {
        id: "collapseOpinionsQuestion"
      }
    }, [_c("div", {
      staticClass: "card card-body",
      staticStyle: {
        width: "100%",
        "box-shadow": "none"
      }
    }, _vm._l(question.comments, function (comment, index) {
      return _c("div", {
        key: index
      }, [_c("div", {
        staticClass: "direct-chat-messages"
      }, [_c("div", {
        staticClass: "direct-chat-msg"
      }, [_c("div", {
        staticClass: "direct-chat-infos clearfix"
      }, [_c("span", {
        staticClass: "direct-chat-timestamp float-right"
      }, [_vm._v(_vm._s(new Date(comment.date).toLocaleDateString("en-CA")))])]), _vm._v(" "), _c("img", {
        staticClass: "direct-chat-img",
        attrs: {
          src: "/image/system/icono-paciente-blanco.svg"
        }
      }), _vm._v(" "), _c("div", {
        staticClass: "direct-chat-text"
      }, [_vm._v(_vm._s(comment.comment))])])])]);
    }), 0)])]), _vm._v(" "), question.totalResponses != 1 ? _c("div", {
      staticClass: "table-responsive"
    }, [_c("table", {
      staticClass: "table table-striped text-gray",
      staticStyle: {
        "font-size": "1.5em"
      }
    }, [_c("tbody", [10 <= question.totalResponses ? _c("tr", {
      key: question.answers[9].id,
      staticClass: "tooltip-primary",
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: question.responses10 + " respuesta" + (question.responses10 !== 1 ? "s" : "") + " representa" + (question.responses10 !== 1 ? "n" : "") + " el " + (question.responses === 0 ? "0" : (question.responses10 * 100 / question.responses).toFixed()) + "% de las " + question.responses + " respuestas encontradas."
      }
    }, [_c("td", [_vm._v(_vm._s(question.answers[9].description))]), _vm._v(" "), _c("td", {
      staticStyle: {
        "vertical-align": "middle",
        width: "40%"
      }
    }, [_c("div", {
      staticClass: "progress progress-lg"
    }, [_c("div", {
      staticClass: "progress-bar bg-warning",
      style: {
        width: question.responses10 * 100 / question.responses + "%"
      }
    })])]), _vm._v(" "), _c("td", {
      staticStyle: {
        width: "15%"
      }
    }, [_c("span", {
      staticClass: "text-primary"
    }, [_vm._v(_vm._s(question.responses === 0 ? "0" : (question.responses10 * 100 / question.responses).toFixed()) + " %")])])]) : _vm._e(), _vm._v(" "), 9 <= question.totalResponses ? _c("tr", {
      key: question.answers[8].id,
      staticClass: "tooltip-primary",
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: question.responses9 + " respuesta" + (question.responses9 !== 1 ? "s" : "") + " representa" + (question.responses9 !== 1 ? "n" : "") + " el " + (question.responses === 0 ? "0" : (question.responses9 * 100 / question.responses).toFixed()) + "% de las " + question.responses + " respuestas encontradas."
      }
    }, [_c("td", [_vm._v(_vm._s(question.answers[8].description))]), _vm._v(" "), _c("td", {
      staticStyle: {
        "vertical-align": "middle",
        width: "40%"
      }
    }, [_c("div", {
      staticClass: "progress progress-lg"
    }, [_c("div", {
      staticClass: "progress-bar bg-warning",
      style: {
        width: question.responses9 * 100 / question.responses + "%"
      }
    })])]), _vm._v(" "), _c("td", {
      staticStyle: {
        width: "15%"
      }
    }, [_c("span", {
      staticClass: "text-primary"
    }, [_vm._v(_vm._s(question.responses === 0 ? "0" : (question.responses9 * 100 / question.responses).toFixed()) + " %")])])]) : _vm._e(), _vm._v(" "), 8 <= question.totalResponses ? _c("tr", {
      key: question.answers[7].id,
      staticClass: "tooltip-primary",
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: question.responses8 + " respuesta" + (question.responses8 !== 1 ? "s" : "") + " representa" + (question.responses8 !== 1 ? "n" : "") + " el " + (question.responses === 0 ? "0" : (question.responses8 * 100 / question.responses).toFixed()) + "% de las " + question.responses + " respuestas encontradas."
      }
    }, [_c("td", [_vm._v(_vm._s(question.answers[7].description))]), _vm._v(" "), _c("td", {
      staticStyle: {
        "vertical-align": "middle",
        width: "40%"
      }
    }, [_c("div", {
      staticClass: "progress progress-lg"
    }, [_c("div", {
      staticClass: "progress-bar bg-warning",
      style: {
        width: question.responses8 * 100 / question.responses + "%"
      }
    })])]), _vm._v(" "), _c("td", {
      staticStyle: {
        width: "15%"
      }
    }, [_c("span", {
      staticClass: "text-primary"
    }, [_vm._v(_vm._s(question.responses === 0 ? "0" : (question.responses8 * 100 / question.responses).toFixed()) + " %")])])]) : _vm._e(), _vm._v(" "), 7 <= question.totalResponses ? _c("tr", {
      key: question.answers[6].id,
      staticClass: "tooltip-primary",
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: question.responses7 + " respuesta" + (question.responses7 !== 1 ? "s" : "") + " representa" + (question.responses7 !== 1 ? "n" : "") + " el " + (question.responses === 0 ? "0" : (question.responses7 * 100 / question.responses).toFixed()) + "% de las " + question.responses + " respuestas encontradas."
      }
    }, [_c("td", [_vm._v(_vm._s(question.answers[6].description))]), _vm._v(" "), _c("td", {
      staticStyle: {
        "vertical-align": "middle",
        width: "40%"
      }
    }, [_c("div", {
      staticClass: "progress progress-lg"
    }, [_c("div", {
      staticClass: "progress-bar bg-warning",
      style: {
        width: question.responses7 * 100 / question.responses + "%"
      }
    })])]), _vm._v(" "), _c("td", {
      staticStyle: {
        width: "15%"
      }
    }, [_c("span", {
      staticClass: "text-primary"
    }, [_vm._v(_vm._s(question.responses === 0 ? "0" : (question.responses7 * 100 / question.responses).toFixed()) + " %")])])]) : _vm._e(), _vm._v(" "), 6 <= question.totalResponses ? _c("tr", {
      key: question.answers[5].id,
      staticClass: "tooltip-primary",
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: question.responses6 + " respuesta" + (question.responses6 !== 1 ? "s" : "") + " representa" + (question.responses6 !== 1 ? "n" : "") + " el " + (question.responses === 0 ? "0" : (question.responses6 * 100 / question.responses).toFixed()) + "% de las " + question.responses + " respuestas encontradas."
      }
    }, [_c("td", [_vm._v(_vm._s(question.answers[5].description))]), _vm._v(" "), _c("td", {
      staticStyle: {
        "vertical-align": "middle",
        width: "40%"
      }
    }, [_c("div", {
      staticClass: "progress progress-lg"
    }, [_c("div", {
      staticClass: "progress-bar bg-warning",
      style: {
        width: question.responses6 * 100 / question.responses + "%"
      }
    })])]), _vm._v(" "), _c("td", {
      staticStyle: {
        width: "15%"
      }
    }, [_c("span", {
      staticClass: "text-primary"
    }, [_vm._v(_vm._s(question.responses === 0 ? "0" : (question.responses6 * 100 / question.responses).toFixed()) + " %")])])]) : _vm._e(), _vm._v(" "), 5 <= question.totalResponses ? _c("tr", {
      key: question.answers[4].id,
      staticClass: "tooltip-primary",
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: question.responses5 + " respuesta" + (question.responses5 !== 1 ? "s" : "") + " representa" + (question.responses5 !== 1 ? "n" : "") + " el " + (question.responses === 0 ? "0" : (question.responses5 * 100 / question.responses).toFixed()) + "% de las " + question.responses + " respuestas encontradas."
      }
    }, [_c("td", [_vm._v(_vm._s(question.answers[4].description))]), _vm._v(" "), _c("td", {
      staticStyle: {
        "vertical-align": "middle",
        width: "40%"
      }
    }, [_c("div", {
      staticClass: "progress progress-lg"
    }, [_c("div", {
      staticClass: "progress-bar bg-warning",
      style: {
        width: question.responses5 * 100 / question.responses + "%"
      }
    })])]), _vm._v(" "), _c("td", {
      staticStyle: {
        width: "15%"
      }
    }, [_c("span", {
      staticClass: "text-primary"
    }, [_vm._v(_vm._s(question.responses === 0 ? "0" : (question.responses5 * 100 / question.responses).toFixed()) + " %")])])]) : _vm._e(), _vm._v(" "), 4 <= question.totalResponses ? _c("tr", {
      key: question.answers[3].id,
      staticClass: "tooltip-primary",
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: question.responses4 + " respuesta" + (question.responses4 !== 1 ? "s" : "") + " representa" + (question.responses4 !== 1 ? "n" : "") + " el " + (question.responses === 0 ? "0" : (question.responses4 * 100 / question.responses).toFixed()) + "% de las " + question.responses + " respuestas encontradas."
      }
    }, [_c("td", [_vm._v(_vm._s(question.answers[3].description))]), _vm._v(" "), _c("td", {
      staticStyle: {
        "vertical-align": "middle",
        width: "40%"
      }
    }, [_c("div", {
      staticClass: "progress progress-lg"
    }, [_c("div", {
      staticClass: "progress-bar bg-warning",
      style: {
        width: question.responses4 * 100 / question.responses + "%"
      }
    })])]), _vm._v(" "), _c("td", {
      staticStyle: {
        width: "15%"
      }
    }, [_c("span", {
      staticClass: "text-primary"
    }, [_vm._v(_vm._s(question.responses === 0 ? "0" : (question.responses4 * 100 / question.responses).toFixed()) + " %")])])]) : _vm._e(), _vm._v(" "), 3 <= question.totalResponses ? _c("tr", {
      key: question.answers[2].id,
      staticClass: "tooltip-primary",
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: question.responses3 + " respuesta" + (question.responses3 !== 1 ? "s" : "") + " representa" + (question.responses3 !== 1 ? "n" : "") + " el " + (question.responses === 0 ? "0" : (question.responses3 * 100 / question.responses).toFixed()) + "% de las " + question.responses + " respuestas encontradas."
      }
    }, [_c("td", [_vm._v(_vm._s(question.answers[2].description))]), _vm._v(" "), _c("td", {
      staticStyle: {
        "vertical-align": "middle",
        width: "40%"
      }
    }, [_c("div", {
      staticClass: "progress progress-lg"
    }, [_c("div", {
      staticClass: "progress-bar bg-warning",
      style: {
        width: question.responses3 * 100 / question.responses + "%"
      }
    })])]), _vm._v(" "), _c("td", {
      staticStyle: {
        width: "15%"
      }
    }, [_c("span", {
      staticClass: "text-primary"
    }, [_vm._v(_vm._s(question.responses === 0 ? "0" : (question.responses3 * 100 / question.responses).toFixed()) + " %")])])]) : _vm._e(), _vm._v(" "), 2 <= question.totalResponses ? _c("tr", {
      key: question.answers[1].id,
      staticClass: "tooltip-primary",
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: question.responses2 + " respuesta" + (question.responses2 !== 1 ? "s" : "") + " representa" + (question.responses2 !== 1 ? "n" : "") + " el " + (question.responses === 0 ? "0" : (question.responses2 * 100 / question.responses).toFixed()) + "% de las " + question.responses + " respuestas encontradas."
      }
    }, [_c("td", [_vm._v(_vm._s(question.answers[1].description))]), _vm._v(" "), _c("td", {
      staticStyle: {
        "vertical-align": "middle",
        width: "40%"
      }
    }, [_c("div", {
      staticClass: "progress progress-lg"
    }, [_c("div", {
      staticClass: "progress-bar bg-warning",
      style: {
        width: question.responses2 * 100 / question.responses + "%"
      }
    })])]), _vm._v(" "), _c("td", {
      staticStyle: {
        width: "15%"
      }
    }, [_c("span", {
      staticClass: "text-primary"
    }, [_vm._v(_vm._s(question.responses === 0 ? "0" : (question.responses2 * 100 / question.responses).toFixed()) + " %")])])]) : _vm._e(), _vm._v(" "), 1 <= question.totalResponses ? _c("tr", {
      key: question.answers[0].id,
      staticClass: "tooltip-primary",
      attrs: {
        "data-toggle": "tooltip",
        "data-placement": "top",
        title: question.responses1 + " respuesta" + (question.responses1 !== 1 ? "s" : "") + " representa" + (question.responses1 !== 1 ? "n" : "") + " el " + (question.responses === 0 ? "0" : (question.responses1 * 100 / question.responses).toFixed()) + "% de las " + question.responses + " respuestas encontradas."
      }
    }, [_c("td", [_vm._v(_vm._s(question.answers[0].description))]), _vm._v(" "), _c("td", {
      staticStyle: {
        "vertical-align": "middle",
        width: "40%"
      }
    }, [_c("div", {
      staticClass: "progress progress-lg"
    }, [_c("div", {
      staticClass: "progress-bar bg-warning",
      style: {
        width: question.responses1 * 100 / question.responses + "%"
      }
    })])]), _vm._v(" "), _c("td", {
      staticStyle: {
        width: "15%"
      }
    }, [_c("span", {
      staticClass: "text-primary"
    }, [_vm._v(_vm._s(question.responses === 0 ? "0" : (question.responses1 * 100 / question.responses).toFixed()) + " %")])])]) : _vm._e()])])]) : _vm._e()]);
  }), 0)]), _vm._v(" "), _vm._m(0), _vm._v(" "), _vm._m(1)])])])])])])]);
};

var staticRenderFns = [function () {
  var _vm = this,
      _c = _vm._self._c;

  return _c("a", {
    staticClass: "carousel-control-prev",
    attrs: {
      href: "#carouselExampleControls",
      role: "button",
      "data-slide": "prev"
    }
  }, [_c("i", {
    staticClass: "fas fa-chevron-left text-gray"
  }), _vm._v(" "), _c("span", {
    staticClass: "sr-only"
  }, [_vm._v("Previous")])]);
}, function () {
  var _vm = this,
      _c = _vm._self._c;

  return _c("a", {
    staticClass: "carousel-control-next",
    attrs: {
      href: "#carouselExampleControls",
      role: "button",
      "data-slide": "next"
    }
  }, [_c("i", {
    staticClass: "fas fa-chevron-right text-gray"
  }), _vm._v(" "), _c("span", {
    staticClass: "sr-only"
  }, [_vm._v("Next")])]);
}];
render._withStripped = true;


/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return normalizeComponent; });
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent(
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */,
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options =
    typeof scriptExports === 'function' ? scriptExports.options : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) {
    // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = shadowMode
      ? function () {
          injectStyles.call(
            this,
            (options.functional ? this.parent : this).$root.$options.shadowRoot
          )
        }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functional component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection(h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing ? [].concat(existing, hook) : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ "./resources/js/components/surveys/SectionStatisticsComponent.vue":
/*!************************************************************************!*\
  !*** ./resources/js/components/surveys/SectionStatisticsComponent.vue ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SectionStatisticsComponent_vue_vue_type_template_id_154fb4d4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SectionStatisticsComponent.vue?vue&type=template&id=154fb4d4& */ "./resources/js/components/surveys/SectionStatisticsComponent.vue?vue&type=template&id=154fb4d4&");
/* harmony import */ var _SectionStatisticsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SectionStatisticsComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/surveys/SectionStatisticsComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _SectionStatisticsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _SectionStatisticsComponent_vue_vue_type_template_id_154fb4d4___WEBPACK_IMPORTED_MODULE_0__["render"],
  _SectionStatisticsComponent_vue_vue_type_template_id_154fb4d4___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/surveys/SectionStatisticsComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/surveys/SectionStatisticsComponent.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************!*\
  !*** ./resources/js/components/surveys/SectionStatisticsComponent.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SectionStatisticsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./SectionStatisticsComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/surveys/SectionStatisticsComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SectionStatisticsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/surveys/SectionStatisticsComponent.vue?vue&type=template&id=154fb4d4&":
/*!*******************************************************************************************************!*\
  !*** ./resources/js/components/surveys/SectionStatisticsComponent.vue?vue&type=template&id=154fb4d4& ***!
  \*******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_SectionStatisticsComponent_vue_vue_type_template_id_154fb4d4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../node_modules/vue-loader/lib??vue-loader-options!./SectionStatisticsComponent.vue?vue&type=template&id=154fb4d4& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/surveys/SectionStatisticsComponent.vue?vue&type=template&id=154fb4d4&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_SectionStatisticsComponent_vue_vue_type_template_id_154fb4d4___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_SectionStatisticsComponent_vue_vue_type_template_id_154fb4d4___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);