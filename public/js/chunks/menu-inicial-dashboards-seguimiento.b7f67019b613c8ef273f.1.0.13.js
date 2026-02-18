(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["menu-inicial-dashboards-seguimiento"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/MenuInicial/MenuDashboardsSeguimiento.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/MenuInicial/MenuDashboardsSeguimiento.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  props: [],
  data: function data() {
    return {
      menu_tableros_seguimiento: {
        goback: {
          title: "Dashboards de Seguimiento",
          icon: "pc-tablero",
          href: location.origin + '/menu_inicial_principal',
          active: true
        },
        menu: [{
          title: "PAD",
          icon: "pc-light-homecare",
          href: location.origin + "/reportes/pad/resumen",
          active: true
        }, {
          title: "Censo Diario",
          icon: "pc-cita_confirmada",
          href: location.origin + "/reportes/ingresoscmdlt",
          active: true
        }, {
          title: "Egresos",
          icon: "pc-cita_confirmada",
          href: location.origin + "/reportes/egresoscmdlt",
          active: true
        }, {
          title: "Plan Quirúrgico MAPM",
          icon: "pc-ambulatorio",
          href: location.origin + "/areaQuirofanoAmb/externo/iqx",
          active: true
        }, {
          title: "Plan Quirúrgico Hospitalización",
          icon: "pc-light-hospital",
          href: location.origin + "/areaQuirofano/externo/iqx",
          active: true
        }, {
          title: "Hospitalización",
          icon: "pc-light-pisos",
          href: location.origin + '/menu_inicial_hospitalizacion',
          active: true
        }, {
          title: "Emergencia",
          icon: "pc-emergencia",
          href: '#',
          active: false
        }]
      }
    };
  },
  methods: {},
  mounted: function mounted() {}
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/MenuInicial/MenuDashboardsSeguimiento.vue?vue&type=template&id=f5854a92&scoped=true&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/MenuInicial/MenuDashboardsSeguimiento.vue?vue&type=template&id=f5854a92&scoped=true& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************/
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
  }, [_vm._v("\r\n        Selecciona el área a la que quieres ingresar\r\n    ")]), _vm._v(" "), _c("div", {
    staticClass: "flex-fill nav-patientcare d-flex flex-column flex-md-row justify-content-center p-1 overflow-auto"
  }, [_c("div", {
    staticClass: "flex-shrink-1 mt-auto mt-md-0 order-2 order-md-1 col-md-3 d-flex flex-wrap overflow-auto"
  }, [_c("div", {
    staticClass: "flex-fill p-0 d-flex flex-column justify-content-center rounded-pill-custom-1"
  }, [_c("a", {
    attrs: {
      href: _vm.menu_tableros_seguimiento.goback.href
    }
  }, [_c("div", {
    staticClass: "card goback flex-row flex-md-column m-0 card-height justify-content-center align-items-center"
  }, [_c("i", {
    "class": _vm.menu_tableros_seguimiento.goback.icon
  }), _vm._v(" "), _c("div", {
    staticClass: "title text-uppercase mt-1"
  }, [_vm._v("\r\n                            " + _vm._s(_vm.menu_tableros_seguimiento.goback.title) + "\r\n                            ")])])])])]), _vm._v(" "), _c("div", {
    "class": ["order-1 order-md-2 d-flex flex-wrap pt-1 flex-md-fill overflow-auto", {
      "align-content-md-center": _vm.menu_tableros_seguimiento.menu.length <= 6
    }, {
      "align-content-md-start": _vm.menu_tableros_seguimiento.menu.length > 6
    }]
  }, _vm._l(_vm.menu_tableros_seguimiento.menu, function (item, index) {
    return _c("div", {
      key: index,
      staticClass: "col-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4"
    }, [_c("a", {
      attrs: {
        href: item.href
      }
    }, [_c("div", {
      "class": [{
        "bg-light": !item.active
      }, "card mb-2 justify-content-center align-items-center card-height"]
    }, [_c("i", {
      "class": [item.icon, {
        "text-gray": !item.active
      }]
    }), _vm._v(" "), _c("div", {
      "class": [{
        "text-gray": !item.active
      }, "title text-uppercase mt-1"]
    }, [_vm._v("\r\n                            " + _vm._s(item.title) + "\r\n                          ")])])])]);
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

/***/ "./resources/js/components/MenuInicial/MenuDashboardsSeguimiento.vue":
/*!***************************************************************************!*\
  !*** ./resources/js/components/MenuInicial/MenuDashboardsSeguimiento.vue ***!
  \***************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _MenuDashboardsSeguimiento_vue_vue_type_template_id_f5854a92_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./MenuDashboardsSeguimiento.vue?vue&type=template&id=f5854a92&scoped=true& */ "./resources/js/components/MenuInicial/MenuDashboardsSeguimiento.vue?vue&type=template&id=f5854a92&scoped=true&");
/* harmony import */ var _MenuDashboardsSeguimiento_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./MenuDashboardsSeguimiento.vue?vue&type=script&lang=js& */ "./resources/js/components/MenuInicial/MenuDashboardsSeguimiento.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _MenuDashboardsSeguimiento_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _MenuDashboardsSeguimiento_vue_vue_type_template_id_f5854a92_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _MenuDashboardsSeguimiento_vue_vue_type_template_id_f5854a92_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "f5854a92",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/MenuInicial/MenuDashboardsSeguimiento.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/MenuInicial/MenuDashboardsSeguimiento.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************!*\
  !*** ./resources/js/components/MenuInicial/MenuDashboardsSeguimiento.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_MenuDashboardsSeguimiento_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./MenuDashboardsSeguimiento.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/MenuInicial/MenuDashboardsSeguimiento.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_MenuDashboardsSeguimiento_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/MenuInicial/MenuDashboardsSeguimiento.vue?vue&type=template&id=f5854a92&scoped=true&":
/*!**********************************************************************************************************************!*\
  !*** ./resources/js/components/MenuInicial/MenuDashboardsSeguimiento.vue?vue&type=template&id=f5854a92&scoped=true& ***!
  \**********************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_MenuDashboardsSeguimiento_vue_vue_type_template_id_f5854a92_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../node_modules/vue-loader/lib??vue-loader-options!./MenuDashboardsSeguimiento.vue?vue&type=template&id=f5854a92&scoped=true& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/MenuInicial/MenuDashboardsSeguimiento.vue?vue&type=template&id=f5854a92&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_MenuDashboardsSeguimiento_vue_vue_type_template_id_f5854a92_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_MenuDashboardsSeguimiento_vue_vue_type_template_id_f5854a92_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);