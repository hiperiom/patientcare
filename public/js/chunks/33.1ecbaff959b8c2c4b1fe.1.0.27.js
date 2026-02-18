(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[33],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Auth/components/MenuPrincipal.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Auth/components/MenuPrincipal.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _helpers_customHelpers_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../helpers/customHelpers.js */ "./resources/js/helpers/customHelpers.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }


/* harmony default export */ __webpack_exports__["default"] = ({
  props: [],
  data: function data() {
    return {
      roles: [2],
      navegationHome: {
        menu: [{
          title: "Seguimiento de Pacientes",
          icon: "pc-paciente",
          href: location.origin + "/auth/areaequiposalud?user_id=" + JSON.parse(localStorage.getItem("user_profile"))['user_id'],
          active: true,
          roles: [2, 4, 6]
        }, {
          title: "Resumen Clínico",
          icon: "pc-resumen_clinico",
          href: location.origin + "/auth/arearesumenclinico?user_id=" + JSON.parse(localStorage.getItem("user_profile"))['user_id'],
          active: true,
          roles: [2, 4, 6]
        }, {
          title: "Área Quirúrgica",
          icon: "pc-cirugia-light",
          href: location.origin + '/auth/menu_inicial_aq',
          active: true,
          roles: [2, 4]
        }, {
          title: "Dashboards de Seguimiento",
          icon: "pc-tablero",
          href: location.origin + '/auth/menu_inicial_dashboards',
          active: true,
          roles: [2, 6, 4]
        }, {
          title: "Hotelería",
          icon: "pc-hoteleria",
          href: location.origin + "/auth/hoteleria?user_id=" + JSON.parse(localStorage.getItem("user_profile"))['user_id'],
          active: true,
          roles: [2, 4, 6]
        }, {
          title: "Satisfacción",
          icon: "pc-light-satisfation",
          href: '/auth/menu_inicial_satisfaccion',
          active: true,
          roles: [2, 4, 6]
        }, {
          title: "Administrador",
          icon: "pc-administrador",
          href: '/auth/menu_inicial_administrador',
          active: true,
          roles: [4]
        }, {
          title: "Eventos Especiales",
          icon: "pc-cita_favorita",
          href: location.origin + '/auth/menu_inicial_eventos_especiales',
          active: true,
          roles: [2, 4, 6]
        }, {
          title: "Planificación de guardias",
          icon: "pc-seguro_medico",
          href: location.origin + "/auth/areaplanificacionguardia?user_id=" + JSON.parse(localStorage.getItem("user_profile"))['user_id'],
          active: true,
          roles: [2, 4, 6]
        }]
      }
    };
  },
  computed: {
    getNavegationFilter: function getNavegationFilter() {
      this.navegationFilter();
    }
  },
  methods: {
    navegationFilter: function navegationFilter() {
      var roles = this.roles;
      return this.navegationHome.menu.filter(function (item) {
        if (item.roles.length === 0) {
          return item;
        } else {
          var exist = false;
          roles.forEach(function (role) {
            if (item.roles.includes(role)) {
              exist = true;
            }
          });

          if (exist) {
            return item;
          }
        }
      });
    },
    getUserRoles: function getUserRoles() {
      var _this = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
        var formdata;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                formdata = new FormData();
                formdata.append("user_id", JSON.parse(localStorage.getItem("user_profile"))['user_id']);
                formdata.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                _context.next = 5;
                return Object(_helpers_customHelpers_js__WEBPACK_IMPORTED_MODULE_1__["post"])(location.origin + "/auth/getUserRoles", formdata);

              case 5:
                _this.roles = _context.sent;

              case 6:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }))();
    }
  },
  mounted: function mounted() {
    this.getUserRoles();
    this.navegationFilter();
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Auth/components/MenuPrincipal.vue?vue&type=template&id=b1d6483c&scoped=true&":
/*!**************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Auth/components/MenuPrincipal.vue?vue&type=template&id=b1d6483c&scoped=true& ***!
  \**************************************************************************************************************************************************************************************************************************************************************************/
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
    staticClass: "flex-fill bg-white rounded-pill col-10 col-sm-8 col-md-10 col-lg-10 col-xl-10 d-flex flex-column p-0 justify-content-center overflow-auto container"
  }, [_c("h4", {
    staticClass: "text-center text-secondary mt-3"
  }, [_vm._v("Áreas de atención")]), _vm._v(" "), _c("div", {
    staticClass: "text-center text-secondary my-1"
  }, [_vm._v("\n        Selecciona el área a la que quieres ingresar\n        \n    ")]), _vm._v(" "), _c("div", {
    staticClass: "flex-fill nav-patientcare d-flex flex-column justify-content-center p-1 overflow-auto"
  }, [_c("div", {
    staticClass: "d-flex flex-wrap pt-1 overflow-auto"
  }, _vm._l(_vm.navegationFilter, function (item, index) {
    return _c("div", {
      key: index,
      staticClass: "col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4"
    }, [_c("a", {
      attrs: {
        href: item.href
      }
    }, [_c("div", {
      "class": [{
        "bg-light": !item.active
      }, "card flex-row flex-sm-column mb-2 card-height justify-content-start justify-content-sm-center align-items-center"],
      attrs: {
        href: item.href
      }
    }, [_c("i", {
      "class": [item.icon, "ml-1 ml-sm-0", {
        "text-gray": !item.active
      }]
    }), _vm._v(" "), _c("div", {
      "class": [{
        "text-gray": !item.active
      }, "ml-2 ml-sm-0 title text-uppercase mt-1 text-left text-sm-center"]
    }, [_vm._v("\n                        " + _vm._s(item.title) + "\n                      ")])])])]);
  }), 0)]), _vm._v(" "), _c("a", {
    staticClass: "btn btn-exit mt-2",
    attrs: {
      href: "/finalizarSesion"
    }
  }, [_vm._v("Salir del sistema")])]);
};

var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./resources/js/components/Auth/components/MenuPrincipal.vue":
/*!*******************************************************************!*\
  !*** ./resources/js/components/Auth/components/MenuPrincipal.vue ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _MenuPrincipal_vue_vue_type_template_id_b1d6483c_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./MenuPrincipal.vue?vue&type=template&id=b1d6483c&scoped=true& */ "./resources/js/components/Auth/components/MenuPrincipal.vue?vue&type=template&id=b1d6483c&scoped=true&");
/* harmony import */ var _MenuPrincipal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./MenuPrincipal.vue?vue&type=script&lang=js& */ "./resources/js/components/Auth/components/MenuPrincipal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _MenuPrincipal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _MenuPrincipal_vue_vue_type_template_id_b1d6483c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _MenuPrincipal_vue_vue_type_template_id_b1d6483c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "b1d6483c",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Auth/components/MenuPrincipal.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Auth/components/MenuPrincipal.vue?vue&type=script&lang=js&":
/*!********************************************************************************************!*\
  !*** ./resources/js/components/Auth/components/MenuPrincipal.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_MenuPrincipal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./MenuPrincipal.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Auth/components/MenuPrincipal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_MenuPrincipal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Auth/components/MenuPrincipal.vue?vue&type=template&id=b1d6483c&scoped=true&":
/*!**************************************************************************************************************!*\
  !*** ./resources/js/components/Auth/components/MenuPrincipal.vue?vue&type=template&id=b1d6483c&scoped=true& ***!
  \**************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_MenuPrincipal_vue_vue_type_template_id_b1d6483c_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../../node_modules/vue-loader/lib??vue-loader-options!./MenuPrincipal.vue?vue&type=template&id=b1d6483c&scoped=true& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Auth/components/MenuPrincipal.vue?vue&type=template&id=b1d6483c&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_MenuPrincipal_vue_vue_type_template_id_b1d6483c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_MenuPrincipal_vue_vue_type_template_id_b1d6483c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);