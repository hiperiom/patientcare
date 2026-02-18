(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["default~/js/myChunks/app_area_quirurgica~/js/myChunks/app_area_quirurgica2~/js/myChunks/app_area_qui~d2731f4d"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Navbars/Navbar1.vue?vue&type=script&lang=js&00001":
/*!*******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Navbars/Navbar1.vue?vue&type=script&lang=js&00001 ***!
  \*******************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _helpers_customHelpers_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../helpers/customHelpers.js */ "./resources/js/helpers/customHelpers.js");

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "Navbar1",
  computed: {
    getFullName: function getFullName() {
      var item = this.$store.state.userData;
      var temp1 = Object(_helpers_customHelpers_js__WEBPACK_IMPORTED_MODULE_0__["is_null"])(item.nombres) ? [''] : item.nombres.split(" ");
      var temp2 = Object(_helpers_customHelpers_js__WEBPACK_IMPORTED_MODULE_0__["is_null"])(item.apellidos) ? [''] : item.apellidos.split(" ");
      return "".concat(temp1[0], " ").concat(temp2[0]);
    }
  },
  methods: {
    goToAreaMedico: function goToAreaMedico() {
      location.href = "/menu_inicial_aq";
    },
    btn_sidebarLeft: function btn_sidebarLeft() {
      if (localStorage.getItem('sidebarLeft') === "true") {
        localStorage.setItem('sidebarLeft', "false");
      } else {
        localStorage.setItem('sidebarLeft', "true");
      }

      this.$store.commit('updateProperty', {
        fieldName: 'sidebarLeft',
        fieldValue: JSON.parse(localStorage.getItem('sidebarLeft'))
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Navbars/Navbar1.vue?vue&type=template&id=1b54683a&scoped=true&00001":
/*!*****************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Navbars/Navbar1.vue?vue&type=template&id=1b54683a&scoped=true&00001 ***!
  \*****************************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function render() {
  var _vm = this,
      _c = _vm._self._c;

  return _c("nav", {
    staticClass: "d-flex justify-content-between bg-primary rounded-pill m-1"
  }, [_c("div", {
    staticClass: "btn-user-home d-flex align-items-center"
  }, [_c("button", {
    ref: "btn_home_sidebar",
    on: {
      click: _vm.goToAreaMedico
    }
  }, [_vm._m(0), _vm._v(" "), _c("div", {
    staticClass: "d-none d-sm-flex"
  }, [_c("img", {
    staticClass: "img-user-size",
    attrs: {
      onerror: "this.src='/image/system/icono-paciente-blanco.svg'",
      src: _vm.$store.state.userData.userImage
    }
  }), _vm._v(" "), _c("span", {
    staticClass: "ml-1 align-items-start d-flex flex-column",
    staticStyle: {
      "line-height": "1.1"
    }
  }, [_c("i", {
    staticClass: "message-wellcome"
  }, [_vm._v(_vm._s(_vm.$store.state.messageWellcome))]), _vm._v(" "), _c("div", {
    staticClass: "username"
  }, [_vm._v(_vm._s(_vm.getFullName))])])])]), _vm._v(" "), _c("span", {
    staticClass: "principal-menu-toggle btn",
    attrs: {
      id: "menu-toggle-right"
    }
  })]), _vm._v(" "), _c("img", {
    staticClass: "img-logo m-1 d-block",
    attrs: {
      src: "https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-blanco.svg",
      alt: "Logo CMDLT"
    }
  })]);
};

var staticRenderFns = [function () {
  var _vm = this,
      _c = _vm._self._c;

  return _c("span", {
    staticClass: "principal-menu-toggle btn",
    attrs: {
      id: "menu-toggle-left"
    }
  }, [_c("i", {
    staticClass: "fas fa-bars text-white"
  })]);
}];
render._withStripped = true;


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Navbars/Navbar1.vue?vue&type=style&index=0&id=1b54683a&lang=scss&scoped=true&00001":
/*!******************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Navbars/Navbar1.vue?vue&type=style&index=0&id=1b54683a&lang=scss&scoped=true&00001 ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".img-logo[data-v-1b54683a] {\n  height: 50px;\n  width: 120px;\n}\n.img-user-size[data-v-1b54683a] {\n  width: 40px;\n  height: 40px;\n  border-radius: 50%;\n}\n.btn-user-home button[data-v-1b54683a] {\n  background-color: transparent;\n  display: flex;\n  color: white;\n  align-items: center;\n  border: 0px;\n}\n.btn-user-home button[data-v-1b54683a]:focus {\n  outline: 1px dotted;\n  outline: 0px !important;\n}\n.btn-user-home .username[data-v-1b54683a] {\n  font-weight: bold;\n  font-size: 1rem;\n  text-wrap: nowrap;\n  overflow: hidden;\n  width: 117px;\n  /*border: 1px solid red;*/\n}\n@media (min-width: 576px) {\n.btn-user-home .username[data-v-1b54683a] {\n    font-weight: bold;\n    font-size: 1.5rem;\n    text-wrap: nowrap;\n    overflow: hidden;\n    width: auto;\n    /*border: 1px solid red;*/\n}\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Navbars/Navbar1.vue?vue&type=style&index=0&id=1b54683a&lang=scss&scoped=true&00001":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Navbars/Navbar1.vue?vue&type=style&index=0&id=1b54683a&lang=scss&scoped=true&00001 ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--7-2!../../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../../node_modules/vue-loader/lib??vue-loader-options!./Navbar1.vue?vue&type=style&index=0&id=1b54683a&lang=scss&scoped=true&00001 */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Navbars/Navbar1.vue?vue&type=style&index=0&id=1b54683a&lang=scss&scoped=true&00001");

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

/***/ "./resources/js/components/Navbars/Navbar1.vue?00001":
/*!***********************************************************!*\
  !*** ./resources/js/components/Navbars/Navbar1.vue?00001 ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Navbar1_vue_vue_type_template_id_1b54683a_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Navbar1.vue?vue&type=template&id=1b54683a&scoped=true&00001 */ "./resources/js/components/Navbars/Navbar1.vue?vue&type=template&id=1b54683a&scoped=true&00001");
/* harmony import */ var _Navbar1_vue_vue_type_script_lang_js_00001__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Navbar1.vue?vue&type=script&lang=js&00001 */ "./resources/js/components/Navbars/Navbar1.vue?vue&type=script&lang=js&00001");
/* empty/unused harmony star reexport *//* harmony import */ var _Navbar1_vue_vue_type_style_index_0_id_1b54683a_lang_scss_scoped_true_00001__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Navbar1.vue?vue&type=style&index=0&id=1b54683a&lang=scss&scoped=true&00001 */ "./resources/js/components/Navbars/Navbar1.vue?vue&type=style&index=0&id=1b54683a&lang=scss&scoped=true&00001");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Navbar1_vue_vue_type_script_lang_js_00001__WEBPACK_IMPORTED_MODULE_1__["default"],
  _Navbar1_vue_vue_type_template_id_1b54683a_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0__["render"],
  _Navbar1_vue_vue_type_template_id_1b54683a_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "1b54683a",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Navbars/Navbar1.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Navbars/Navbar1.vue?vue&type=script&lang=js&00001":
/*!***********************************************************************************!*\
  !*** ./resources/js/components/Navbars/Navbar1.vue?vue&type=script&lang=js&00001 ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Navbar1_vue_vue_type_script_lang_js_00001__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Navbar1.vue?vue&type=script&lang=js&00001 */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Navbars/Navbar1.vue?vue&type=script&lang=js&00001");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Navbar1_vue_vue_type_script_lang_js_00001__WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Navbars/Navbar1.vue?vue&type=style&index=0&id=1b54683a&lang=scss&scoped=true&00001":
/*!********************************************************************************************************************!*\
  !*** ./resources/js/components/Navbars/Navbar1.vue?vue&type=style&index=0&id=1b54683a&lang=scss&scoped=true&00001 ***!
  \********************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Navbar1_vue_vue_type_style_index_0_id_1b54683a_lang_scss_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--7-2!../../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../../node_modules/vue-loader/lib??vue-loader-options!./Navbar1.vue?vue&type=style&index=0&id=1b54683a&lang=scss&scoped=true&00001 */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Navbars/Navbar1.vue?vue&type=style&index=0&id=1b54683a&lang=scss&scoped=true&00001");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Navbar1_vue_vue_type_style_index_0_id_1b54683a_lang_scss_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Navbar1_vue_vue_type_style_index_0_id_1b54683a_lang_scss_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Navbar1_vue_vue_type_style_index_0_id_1b54683a_lang_scss_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Navbar1_vue_vue_type_style_index_0_id_1b54683a_lang_scss_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "./resources/js/components/Navbars/Navbar1.vue?vue&type=template&id=1b54683a&scoped=true&00001":
/*!*****************************************************************************************************!*\
  !*** ./resources/js/components/Navbars/Navbar1.vue?vue&type=template&id=1b54683a&scoped=true&00001 ***!
  \*****************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_Navbar1_vue_vue_type_template_id_1b54683a_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../node_modules/vue-loader/lib??vue-loader-options!./Navbar1.vue?vue&type=template&id=1b54683a&scoped=true&00001 */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Navbars/Navbar1.vue?vue&type=template&id=1b54683a&scoped=true&00001");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_Navbar1_vue_vue_type_template_id_1b54683a_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_Navbar1_vue_vue_type_template_id_1b54683a_scoped_true_00001__WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/helpers/customHelpers.js?00001":
/*!*****************************************************!*\
  !*** ./resources/js/helpers/customHelpers.js?00001 ***!
  \*****************************************************/
/*! exports provided: horaPm, mesesEnEspanol, meses, limpiarTexto, fechaCortaAPPLE, horaAMPM, getSelectorText, capitalize, obtenerVariablesGET, obtenerIdsPorParentId, getUbicaciones, emptyObj, post, clone, imagePreview, is_null, is_empty, is_undefined, first, last, byId, $qs, $qsa, validarPrimerDigito, formatAMPM, getQueryVariable, telefonoConfig, validarNumeroConDosDecimales, activarTooltips, timestamps, calcularEdad, fechaHoy, horaIntervencion, calcularTiempoRestante, formatFecha, fechaAMD, fechaAMD2, fechaCustom1, fechaDMA, get, ucwords, alertMessage, emptyItem, jsUcfirst, jsUclast, fileType, removeAccents, $select, $selectCustom, recalcularAltoPagina, store_field, selectOptions, dia_semana, fechaUserCita, mes, item_historial_cita, item_historial_cita2, active_form, cargandoModal, get_index, get_one, get_all, get_one_by_index, add_row, delete_row, update_row, add_row_by_index */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "horaPm", function() { return horaPm; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "mesesEnEspanol", function() { return mesesEnEspanol; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "meses", function() { return meses; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "limpiarTexto", function() { return limpiarTexto; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "fechaCortaAPPLE", function() { return fechaCortaAPPLE; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "horaAMPM", function() { return horaAMPM; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getSelectorText", function() { return getSelectorText; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "capitalize", function() { return capitalize; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "obtenerVariablesGET", function() { return obtenerVariablesGET; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "obtenerIdsPorParentId", function() { return obtenerIdsPorParentId; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getUbicaciones", function() { return getUbicaciones; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "emptyObj", function() { return emptyObj; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "post", function() { return post; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "clone", function() { return clone; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "imagePreview", function() { return imagePreview; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "is_null", function() { return is_null; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "is_empty", function() { return is_empty; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "is_undefined", function() { return is_undefined; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "first", function() { return first; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "last", function() { return last; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "byId", function() { return byId; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "$qs", function() { return $qs; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "$qsa", function() { return $qsa; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validarPrimerDigito", function() { return validarPrimerDigito; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "formatAMPM", function() { return formatAMPM; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getQueryVariable", function() { return getQueryVariable; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "telefonoConfig", function() { return telefonoConfig; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validarNumeroConDosDecimales", function() { return validarNumeroConDosDecimales; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "activarTooltips", function() { return activarTooltips; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "timestamps", function() { return timestamps; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "calcularEdad", function() { return calcularEdad; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "fechaHoy", function() { return fechaHoy; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "horaIntervencion", function() { return horaIntervencion; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "calcularTiempoRestante", function() { return calcularTiempoRestante; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "formatFecha", function() { return formatFecha; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "fechaAMD", function() { return fechaAMD; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "fechaAMD2", function() { return fechaAMD2; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "fechaCustom1", function() { return fechaCustom1; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "fechaDMA", function() { return fechaDMA; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "get", function() { return get; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ucwords", function() { return ucwords; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "alertMessage", function() { return alertMessage; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "emptyItem", function() { return emptyItem; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "jsUcfirst", function() { return jsUcfirst; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "jsUclast", function() { return jsUclast; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "fileType", function() { return fileType; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "removeAccents", function() { return removeAccents; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "$select", function() { return $select; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "$selectCustom", function() { return $selectCustom; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "recalcularAltoPagina", function() { return recalcularAltoPagina; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "store_field", function() { return store_field; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "selectOptions", function() { return selectOptions; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "dia_semana", function() { return dia_semana; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "fechaUserCita", function() { return fechaUserCita; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "mes", function() { return mes; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "item_historial_cita", function() { return item_historial_cita; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "item_historial_cita2", function() { return item_historial_cita2; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "active_form", function() { return active_form; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "cargandoModal", function() { return cargandoModal; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "get_index", function() { return get_index; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "get_one", function() { return get_one; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "get_all", function() { return get_all; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "get_one_by_index", function() { return get_one_by_index; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "add_row", function() { return add_row; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "delete_row", function() { return delete_row; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "update_row", function() { return update_row; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "add_row_by_index", function() { return add_row_by_index; });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

//import intlTelInput from 'intl-tel-input';
var d = document;
var horaPm = {
  '1': '01',
  '2': '02',
  '3': '03',
  '4': '04',
  '5': '05',
  '6': '06',
  '7': '07',
  '8': '08',
  '9': '09',
  '10': '10',
  '11': '11',
  '12': '12',
  '13': '01',
  '14': '02',
  '15': '03',
  '16': '04',
  '17': '05',
  '18': '06',
  '19': '07',
  '20': '08',
  '21': '09',
  '22': '10',
  '23': '11',
  '0': '12'
};
var mesesEnEspanol = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
var meses = function meses(p) {
  var mes = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre", "Enero"];
  return mes[p];
};
var limpiarTexto = function limpiarTexto(texto) {
  // Remover etiquetas HTML
  texto = texto.replace(/<[^>]*>/g, ''); // Remover estilos de Word

  texto = texto.replace(/\s*style=("|\')[^"\']*("|\')/gi, ''); // Otros reemplazos de formato no deseado
  // Agregar más según sea necesario

  return texto;
};
var fechaCortaAPPLE = function fechaCortaAPPLE(param) {
  //console.log(param)
  var hoy = param.split(" ");
  var fecha = hoy[0].split("-");
  var fullHora = hoy[1].split(":"); //2022-03-24 00:12:26

  var anio = fecha[0];
  var mes = parseInt(fecha[1]);
  var dia = fecha[2];
  var hora = fullHora[0];
  var minutos = fullHora[1];
  var segundos = fullHora[2];
  var horario = "AM";

  if (parseInt(hora) >= 12 && parseInt(hora) <= 23) {
    horario = "PM";
  }

  switch (hora) {
    case "13":
      hora = 1;
      break;

    case "14":
      hora = 2;
      break;

    case "15":
      hora = 3;
      break;

    case "16":
      hora = 4;
      break;

    case "17":
      hora = 5;
      break;

    case "18":
      hora = 6;
      break;

    case "19":
      hora = 7;
      break;

    case "20":
      hora = 8;
      break;

    case "21":
      hora = 9;
      break;

    case "22":
      hora = 10;
      break;

    case "23":
      hora = 11;
      break;

    case "00":
      hora = 12;
      break;
  }

  return dia + " de " + meses(mes - 1) + ", " + anio;
};
var horaAMPM = function horaAMPM(param) {
  var m = "AM";
  var p = param.split(":");
  var hora = p[0];

  if (parseInt(p[0]) > 12) {
    m = "PM";

    switch (p[0]) {
      case "13":
        hora = "1";
        break;

      case "14":
        hora = "2";
        break;

      case "15":
        hora = "3";
        break;

      case "16":
        hora = "4";
        break;

      case "17":
        hora = "5";
        break;

      case "18":
        hora = "6";
        break;

      case "19":
        hora = "7";
        break;

      case "20":
        hora = "8";
        break;

      case "21":
        hora = "9";
        break;

      case "22":
        hora = "10";
        break;

      case "23":
        hora = "11";
        break;

      case "00":
        hora = "12";
        break;
    }
  }

  return "".concat(hora.toString().padStart(2, '0'), ":").concat(p[1].toString().padStart(2, '0'), " ").concat(m);
};
var getSelectorText = function getSelectorText(description) {
  return description.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
};
var capitalize = function capitalize(word) {
  return word[0].toUpperCase() + word.slice(1);
};
function obtenerVariablesGET(url) {
  var urlObj = new URL(url);
  var variablesGET = {};
  urlObj.searchParams.forEach(function (valor, clave) {
    variablesGET[clave] = valor;
  });
  return variablesGET;
}
var obtenerIdsPorParentId = function obtenerIdsPorParentId(data, parentId) {
  // Filtrar el array de objetos para encontrar los objetos con el parentId proporcionado
  var objetosFiltrados = data.filter(function (objeto) {
    return objeto.parent_cat_user_ubicacion_id === parentId && Number(objeto.active) === 1;
  }); // Mapear los objetos filtrados para obtener solo sus ids

  var ids = objetosFiltrados.map(function (objeto) {
    return {
      id: objeto.id,
      coments: objeto.coments,
      parent_cat_user_ubicacion_id: objeto.parent_cat_user_ubicacion_id,
      description: objeto.description,
      name: objeto.name
    };
  }); // Retornar los ids encontrados

  return ids;
};
var getUbicaciones = function getUbicaciones(id) {
  var param_ubi = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : [];
  var onlyID = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;
  var tempUbicaciones = param_ubi.length > 0 ? param_ubi : [];
  var resultset = [];
  var temp = obtenerIdsPorParentId(tempUbicaciones, id);

  if (temp.length > 0) {
    resultset = [].concat(_toConsumableArray(resultset), _toConsumableArray(temp));
  }

  temp = resultset.map(function (x) {
    return obtenerIdsPorParentId(tempUbicaciones, x.id);
  }).flat();

  if (temp.length > 0) {
    resultset = [].concat(_toConsumableArray(resultset), _toConsumableArray(temp));
  }

  if (onlyID) {
    return resultset.map(function (x) {
      return Number(x.id);
    });
  } else {
    return resultset;
  }
};
var emptyObj = function emptyObj(objeto) {
  return Object.keys(objeto).length === 0;
};
function post(_x, _x2) {
  return _post.apply(this, arguments);
}

function _post() {
  _post = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2(url, data) {
    var response;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
      while (1) {
        switch (_context2.prev = _context2.next) {
          case 0:
            _context2.prev = 0;
            _context2.next = 3;
            return fetch(url, {
              method: 'POST',
              body: data
            });

          case 3:
            response = _context2.sent;
            _context2.next = 6;
            return response.json();

          case 6:
            return _context2.abrupt("return", _context2.sent);

          case 9:
            _context2.prev = 9;
            _context2.t0 = _context2["catch"](0);
            console.error(_context2.t0.message);

          case 12:
          case "end":
            return _context2.stop();
        }
      }
    }, _callee2, null, [[0, 9]]);
  }));
  return _post.apply(this, arguments);
}

var clone = function clone(selector) {
  return document.getElementById(selector).content.cloneNode(true);
};
var imagePreview = function imagePreview(e, selector) {
  var showImageName = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
  // We create the object of the FileReader class
  var reader = new FileReader(); // We read the uploaded file and pass it to our fileReader.

  reader.readAsDataURL(e.target.files[0]);
  var file = e.target.files[0]; //We look for the following element where we will show the name of the uploaded file.

  var name = file.name,
      size = file.size,
      type = file.type;

  if (showImageName) {
    e.target.nextElementSibling.textContent = name;
  } // We tell it that when it is ready, run the internal code.


  reader.onload = function (load) {
    document.getElementById(selector).setAttribute("src", reader.result);
  };
};
var is_null = function is_null(params) {
  return params === null || params === "null" ? true : false;
};
var is_empty = function is_empty(params) {
  return params === "" ? true : false;
};
var is_undefined = function is_undefined(params) {
  return params === undefined || params === "undefined" ? true : false;
};
var first = function first(arr) {
  return arr.length > 0 ? arr[0] : null;
};
var last = function last(arr) {
  return arr.length > 0 ? arr[arr.length - 1] : null;
};
var byId = function byId(selector) {
  return entById(selector);
};
var $qs = function $qs(selector) {
  return d.querySelector(selector);
};
var $qsa = function $qsa(selector) {
  return d.querySelectorAll(selector);
};
var validarPrimerDigito = function validarPrimerDigito(value) {
  if (document.querySelector("#" + value).value.length == 1) {
    if (document.querySelector("#" + value).value == 0) {
      document.querySelector("#" + value).value = '';
    }
  }
};
var formatAMPM = function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var seconds = date.getSeconds();
  var ampm = hours >= 12 ? 'PM' : 'AM';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'

  minutes = minutes < 10 ? '0' + minutes : minutes;
  var strTime = hours.toString().padStart(2, '0') + ':' + minutes.toString().padStart(2, '0') + ' ' + ampm;
  return strTime;
};
/* let tempFn = ""
export let relog = (fn)=>{
    tempFn = fn
    setInterval(() => {
        let date = new Date()
        let hora = date.getHours()
        let ampm = hora > 12 ? 'PM' : 'AM'
            hora = horaPm[String(hora)]
            tempFn( formatAMPM(date) );
        //let fechaHoy = `${date.getDate()} de ${mesesEnEspanol[date.getMonth()]} de ${date.getFullYear()}`
    }, 1000)
} */

var getQueryVariable = function getQueryVariable(variable) {
  var query = window.location.search.substring(1); // Obtén la cadena de consulta excluyendo el "?".

  var vars = query.split('&'); // Separa las variables en un array.

  for (var i = 0; i < vars.length; i++) {
    var pair = vars[i].split('=');

    if (pair[0] === variable) {
      return decodeURIComponent(pair[1]); // Devuelve el valor decodificado de la variable.
    }
  }

  return null; // La variable no se encontró en la URL.
};
var telefonoConfig = function telefonoConfig(param, fn) {
  var input = document.querySelector(param);
  var iti = intlTelInput(input, {
    autoHideDialCode: true,
    nationalMode: false,
    preferredCountries: ['ve'],
    separateDialCode: true,
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js" //utilsScript: "/plugin/intl-tel-input/build/js/utils.js",

  });
  fn(iti, input);
};
var validarNumeroConDosDecimales = function validarNumeroConDosDecimales(inputValue) {
  var regex = /^\d+\.\d{2}$/;
  return regex.test(inputValue);
};
var activarTooltips = function activarTooltips() {
  var array = ['primary', 'danger', 'success', 'info', 'warning', 'secondary', 'cyan', 'gray', 'purple', 'orange'];

  for (var index = 0; index <= array.length; index++) {
    var element = array[index]; // Configura los tooltips en los elementos

    tippy('.tooltip-' + element, {
      allowHTML: true,
      theme: 'tooltip-' + element,
      zIndex: 200000
    });
  }
};
var timestamps = function timestamps() {
  var hoy = new Date();
  return hoy.getFullYear() + "-" + (hoy.getMonth() + 1).toString().padStart(2, '0') + "-" + hoy.getDate().toString().padStart(2, '0') + " " + hoy.getHours().toString().padStart(2, '0') + ':' + hoy.getMinutes().toString().padStart(2, '0') + ':' + hoy.getSeconds().toString().padStart(2, '0');
};
var calcularEdad = function calcularEdad(fnacimiento) {
  var fechaNacimiento = new Date(fnacimiento);
  var fechaActual = new Date();
  var diferencia = fechaActual - fechaNacimiento;
  var edadEnMilisegundos = new Date(diferencia); // Extraer el año de la fecha de nacimiento

  var edad = Math.abs(edadEnMilisegundos.getUTCFullYear() - 1970);
  console.log("Edad --> ".concat(edad, " a\xF1os")); // alert(edad)

  return String(edad) === "NaN" ? 0 : edad;
};
var fechaHoy = function fechaHoy() {
  var hoy = new Date(); //console.log(hoy)

  return hoy.getFullYear() + "-" + (hoy.getMonth() + 1).toString().padStart(2, '0') + "-" + hoy.getDate().toString().padStart(2, '0');
};
var horaIntervencion = function horaIntervencion() {
  var hoy = new Date(); //console.log(hoy)

  return hoy.getHours().toString().padStart(2, '0') + ":00";
};
var calcularTiempoRestante = function calcularTiempoRestante(timestampInicio, horasASumar, selector) {
  //console.log(timestampInicio, horasASumar, selector);
  var intervalo = 1000; // Intervalo de 1 segundo en milisegundos

  var fechaInicio = new Date(timestampInicio); // Convierte el timestamp en milisegundos
  // Calcula la fecha final sumando las horas

  var fechaFinal = new Date(fechaInicio.getTime() + horasASumar * 60 * 60 * 1000); // Crea un temporizador que se ejecutará cada segundo

  var temporizador = setInterval(function () {
    var ahora = new Date();
    var tiempoRestante = fechaFinal - ahora; // Comprueba si el tiempo restante es menor o igual a cero

    if (tiempoRestante <= 0) {
      clearInterval(temporizador); // Detiene el temporizador cuando ha transcurrido todo el tiempo
      //console.log("Tiempo agotado");
    } else {
      var segundosRestantes = Math.floor(tiempoRestante / 1000 % 60);
      var minutosRestantes = Math.floor(tiempoRestante / (1000 * 60) % 60);
      var horasRestantes = Math.floor(tiempoRestante / (1000 * 60 * 60)); // Verifica si el tiempo restante es mayor que cero antes de actualizar el contenido
      //console.log(fechaInicio.getTime() , ahora.getTime());
      //console.log(fechaInicio.getTime() >= ahora.getTime());

      if (tiempoRestante > 0 && fechaInicio.getTime() >= ahora.getTime()) {} else {
        document.querySelector(selector).innerHTML = "<span class=\"badge badge-success font-weight-normal\">\n                        <i class=\"far fa-clock\"></i> ".concat(horasRestantes.toString().padStart(2, "0"), ":").concat(minutosRestantes.toString().padStart(2, "0"), ":").concat(segundosRestantes.toString().padStart(2, "0"), "\n                        </span>");
      }
    }
  }, intervalo);
};
var formatFecha = function formatFecha(param) {
  var hoy = new Date(param); //console.log(hoy)

  return hoy.getFullYear() + "-" + (hoy.getMonth() + 1).toString().padStart(2, '0') + "-" + hoy.getDate().toString().padStart(2, '0') + " " + hoy.getHours().toString().padStart(2, '0') + ":" + hoy.getMinutes().toString().padStart(2, '0');
};
var fechaAMD = function fechaAMD(param) {
  var hoy = new Date(param); //console.log(hoy)

  return hoy.getFullYear() + "-" + (hoy.getMonth() + 1).toString().padStart(2, '0') + "-" + hoy.getDate().toString().padStart(2, '0');
};
var fechaAMD2 = function fechaAMD2(param) {
  var hoy = new Date(param); //console.log(hoy)

  return hoy.getFullYear() + "-" + (hoy.getMonth() + 1).toString().padStart(2, '0') + "-" + hoy.getDate().toString().padStart(2, '0');
};
var fechaCustom1 = function fechaCustom1(fecha) {
  var f = new Date(fecha);
  return f.getDate() + " " + meses(f.getMonth()) + ", " + f.getFullYear();
};
var fechaDMA = function fechaDMA(param) {
  var divider = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "/";
  var hoy = new Date(param); //console.log(hoy)

  return hoy.getDate().toString().padStart(2, '0') + divider + (hoy.getMonth() + 1).toString().padStart(2, '0') + divider + hoy.getFullYear();
};
function get(_x3) {
  return _get.apply(this, arguments);
}

function _get() {
  _get = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3(url) {
    var response;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {
      while (1) {
        switch (_context3.prev = _context3.next) {
          case 0:
            _context3.prev = 0;
            _context3.next = 3;
            return fetch(url, {
              method: 'GET',
              headers: {
                'Content-Type': 'application/json'
              }
            });

          case 3:
            response = _context3.sent;
            _context3.next = 6;
            return response.json();

          case 6:
            return _context3.abrupt("return", _context3.sent);

          case 9:
            _context3.prev = 9;
            _context3.t0 = _context3["catch"](0);
            console.error(_context3.t0.message);

          case 12:
          case "end":
            return _context3.stop();
        }
      }
    }, _callee3, null, [[0, 9]]);
  }));
  return _get.apply(this, arguments);
}

function ucwords(string) {
  return string.charAt(0).toUpperCase();
}
function alertMessage(caso) {
  switch (caso) {
    case 'expire_sesion':
      return {
        'title': 'Atención',
        'message': 'Su sesión ha finalizado por inactividad.',
        'image': 'success'
      };
      break;

    case 'input_text_empty':
      return {
        'title': 'Atención',
        'message': 'El campo no puede estar vacio.',
        'image': 'warning'
      };
      break;

    case 'input_select_empty':
      return {
        'title': 'Atención',
        'message': 'Debe seleccionar una opción válida.',
        'image': 'warning'
      };
      break;

    case 'input_datetime_empty':
      return {
        'title': 'Atención',
        'message': 'Debe seleccionar una fecha y hora válida.',
        'image': 'warning'
      };
      break;

    case 'input_date_empty':
      return {
        'title': 'Atención',
        'message': 'Debe seleccionar una fecha válida.',
        'image': 'warning'
      };
      break;

    case 'input_checkbox_empty':
      return {
        'title': 'Atención',
        'message': 'Debe seleccionar al menos una opción.',
        'image': 'warning'
      };
      break;

    case 'destroy_row_cuestion':
      return {
        'title': 'Atención',
        'message': '¿Seguro que desea eliminar este registro?',
        'image': 'warning'
      };
      break;

    case 'update_row_cuestion':
      return {
        'title': 'Atención',
        'message': '¿Seguro que desea actualizar este registro?',
        'image': 'warning'
      };
      break;

    case 'user_no_valid':
      return {
        'title': 'Atención',
        'message': 'Ingrese un Documento de identidad ó un Correo Electrónico para continuar',
        'image': 'warning'
      };
      break;

    case 'close_cie11':
      return {
        'title': 'Atención',
        'message': '¿Desea cerrar el clasificador CIE11?',
        'image': 'warning'
      };
      break;

    case 'cedula_registrado':
      return {
        'title': 'Atención',
        'message': 'El Documento de identidad ya se encuentra asociado a un paciente. Ingrese uno distinto.',
        'image': 'warning'
      };
      break;

    case 'email_registrado':
      return {
        'title': 'Atención',
        'message': 'El Correo Electrónico ya se encuentra asociado a un paciente. Ingrese uno distinto.',
        'image': 'warning'
      };
      break;

    case 'send_success':
      return {
        'title': 'Completado',
        'message': 'Registro creado exitosamente',
        'image': 'success'
      };
      break;

    case 'error':
      return {
        'title': 'Error',
        'message': 'Ha ocurrido un error',
        'image': 'error'
      };
      break;

    case 'update_success':
      return {
        'title': 'Completado',
        'message': 'Registro actualizado exitosamente',
        'image': 'success'
      };
      break;

    case 'cedula_asignada':
      return {
        'title': 'Atención',
        'message': ' ya se encuentra asignado a un paciente, ¿desea reingresarlo?.',
        'image': 'warning'
      };
      break;

    case 'cedula_asignada2':
      return {
        'title': 'Atención',
        'message': ' ya se encuentra asignada a un paciente registrado.',
        'image': 'warning'
      };
      break;

    default:
      console.log("error_menssage");
      break;
  }
}
var emptyItem = function emptyItem() {
  var message = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'Sin Registros';
  var positions = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;
  return "\n                <tr>\n                    <td colspan=\"".concat(positions, "\"class=\"text-center text-primary\">\n                        ").concat(message, "\n                    </td>\n                </tr>\n            ");
};
var jsUcfirst = function jsUcfirst(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
};
var jsUclast = function jsUclast(string) {
  return string.substring(0, string.length - 1);
};
var fileType = function fileType($html, file_type) {
  if (["png", "jpg", "jpeg", "bmp"].includes(file_type)) {
    $html.classList.add("fas", "fa-file-image", "text-gray");
  }

  if (["mp3", "ogg", "wav"].includes(file_type)) {
    $html.classList.add("fas", "fa-file-audio", "text-gray");
  }

  if (["doc", "docx", "txt"].includes(file_type)) {
    $html.classList.add("fas", "fa-file-word", "text-gray");
  }

  if (["ppt", "pptx"].includes(file_type)) {
    $html.classList.add("fas", "fa-file-powerpoint", "text-gray");
  }

  if (["xls", "xlsx"].includes(file_type)) {
    $html.classList.add("fas", "fa-file-excel", "text-gray");
  }

  if (["pdf"].includes(file_type)) {
    $html.classList.add("fas", "fa-file-pdf", "text-gray");
  }

  if (["gif"].includes(file_type)) {
    $html.classList.add("fas", "fa-film", "text-gray");
  }

  if (!["gif", "gif", "pdf", "xls", "xlsx", "ppt", "pptx", "doc", "docx", "txt", "png", "jpg", "jpeg", "bmp", "mp3", "ogg", "wav"].includes(file_type)) {
    $html.classList.add("fas", "fa-question-circle", "text-danger");
  }
};
var removeAccents = function removeAccents(cadena) {
  var acentos = {
    'á': 'a',
    'é': 'e',
    'í': 'i',
    'ó': 'o',
    'ú': 'u',
    'Á': 'A',
    'É': 'E',
    'Í': 'I',
    'Ó': 'O',
    'Ú': 'U'
  };
  return cadena.split('').map(function (letra) {
    return acentos[letra] || letra;
  }).join('').toString();
};
var $select = function $select(data) {
  var selectoption = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
  var $fragment = document.createDocumentFragment();
  var $option;

  if (selectoption) {
    $option = document.createElement("option");
    $option.value = "";
    $option.textContent = "Seleccione";
    $fragment.appendChild($option);
  }

  data.forEach(function (x) {
    $option = document.createElement("option");
    $option.value = x.id;
    $option.textContent = x.description;
    $fragment.appendChild($option);
  });
  return $fragment;
};
var $selectCustom = function $selectCustom(data) {
  var attr = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : [];
  var selectoption = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;
  var $fragment = document.createDocumentFragment();
  var $option;

  if (selectoption) {
    $option = document.createElement("option");
    $option.value = "";
    $option.textContent = "Seleccione";
    $fragment.appendChild($option);
  }

  data.forEach(function (x) {
    $option = document.createElement("option");
    $option.value = x[attr[0]];
    $option.textContent = x[attr[1]];
    $fragment.appendChild($option);
  });
  return $fragment;
};
var recalcularAltoPagina = function recalcularAltoPagina() {
  var alto_pantalla = screen.height;
  Array.from(["#tab_preconsulta", "#tab_consulta", "#tab_citas"]).forEach(function (tab) {
    //d.querySelector(tab).style.border="1px solid red"
    // d.querySelector(tab).style.height=alto_pantalla - 425 + "px"
    d.querySelector(tab).style.height = alto_pantalla - 425 + "px";
  });
};
var store_field = /*#__PURE__*/function () {
  var _ref = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(name, value, user_id, route) {
    var formdata;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            formdata = new FormData();
            formdata.append("field", name);
            formdata.append("value", value);
            formdata.append("user_id", user_id);
            formdata.append("_token", document.querySelector("#_token").value);
            _context.next = 7;
            return post(route, formdata);

          case 7:
            return _context.abrupt("return", _context.sent);

          case 8:
          case "end":
            return _context.stop();
        }
      }
    }, _callee);
  }));

  return function store_field(_x4, _x5, _x6, _x7) {
    return _ref.apply(this, arguments);
  };
}();
var selectOptions = function selectOptions(model, param) {
  var fields = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : ['id', 'description'];
  var id = param != undefined ? param : "";
  var selected = ''; //<option value=''>Seleccione</option>

  var data = "";
  model.forEach(function (option) {
    if (equalsInt(option[fields[0]], id)) {
      //console.log(valueOfElement.id+"=="+id)
      selected = 'selected';
    } else {
      selected = '';
    }

    data += "\n                    <option ".concat(selected, " value=\"").concat(option[fields[0]], "\">\n                        ").concat(option[fields[1]], "\n                    </option>\n                ");
  });
  return data;
};
var dia_semana = function dia_semana(date) {
  var abr = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
  var maysc = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
  var fecha = new Date(date);
  var response = "";
  console.log(date); //console.log("dia_semana->",parseInt( fecha.getDay() ))

  switch (parseInt(fecha.getDay())) {
    case 1:
      response = "Domingo";
      break;

    case 2:
      response = "Lunes";
      break;

    case 3:
      response = "Martes";
      break;

    case 4:
      response = "Miércoles";
      break;

    case 5:
      response = "Jueves";
      break;

    case 6:
      response = "Viernes";
      break;

    case 7:
      response = "Sábado";
      break;
  }

  if (abr) {
    response = response.slice(0, 3);
  }

  if (maysc) {
    response = response.toUpperCase();
  }

  return response;
};
var fechaUserCita = function fechaUserCita(cita) {
  //console.log(param)
  var fullHora = cita.hour.split(":"); //2022-03-24 00:12:26

  var anio = cita.year;
  var mes = parseInt(cita.month);
  var dia = cita.day;
  var hora = fullHora[0];
  var minutos = fullHora[1];
  var segundos = fullHora[2];
  var horario = "AM";

  if (parseInt(hora) > 12 && parseInt(hora) <= 23) {
    horario = "PM";
  }

  switch (hora) {
    case "13":
      hora = 1;
      break;

    case "14":
      hora = 2;
      break;

    case "15":
      hora = 3;
      break;

    case "16":
      hora = 4;
      break;

    case "17":
      hora = 5;
      break;

    case "18":
      hora = 6;
      break;

    case "19":
      hora = 7;
      break;

    case "20":
      hora = 8;
      break;

    case "21":
      hora = 9;
      break;

    case "22":
      hora = 10;
      break;

    case "23":
      hora = 11;
      break;

    case "00":
      hora = 12;
      break;
  } //console.log(`${anio}-${mes}-${dia} ${hora}:${minutos}:${is_undefined(segundos)?'00':segundos}`)


  return "".concat(anio, "-").concat(mes, "-").concat(dia, " ").concat(hora, ":").concat(minutos, ":").concat(is_undefined(segundos) ? '00' : segundos);
};
var mes = function mes(date) {
  var abr = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
  var maysc = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
  var fecha = new Date(date);
  var response = "";

  switch (parseInt(fecha.getMonth())) {
    case 0:
      response = "Enero";
      break;

    case 1:
      response = "Febrero";
      break;

    case 2:
      response = "Marzo";
      break;

    case 3:
      response = "Abril";
      break;

    case 4:
      response = "Mayo";
      break;

    case 5:
      response = "Junio";
      break;

    case 6:
      response = "Julio";
      break;

    case 7:
      response = "Agosto";
      break;

    case 8:
      response = "Septiembre";
      break;

    case 9:
      response = "Octubre";
      break;

    case 10:
      response = "Noviembre";
      break;

    case 11:
      response = "Diciembre";
      break;
  }

  if (abr) {
    response = response.slice(0, 3);
  }

  if (maysc) {
    response = response.toUpperCase();
  }

  return response;
};
var item_historial_cita = function item_historial_cita(cita, centro_salud) {
  //console.log(centro_salud)
  var $item = entById('artefacto_0031').content.cloneNode(true);
  $item.querySelector(".header-historia-day").textContent = dia_semana(fechaUserCita(cita), true, true);
  $item.querySelector(".header-historia-day-month").textContent = parseInt(cita.day);
  $item.querySelector(".header-historia-month").textContent = mes(fechaUserCita(cita), true, true);
  $item.querySelector(".header-historia-year").textContent = cita.year;
  $item.querySelector(".header-historia-doctor").textContent = cita.medico;
  $item.querySelector(".header-historia-especiality").textContent = cita.especialidad_nombre;
  $item.querySelector(".header-historia-address").textContent = first(centro_salud.filter(function (x) {
    return equalsInt(x.id, cita.centro_salud_id);
  })).description;
  $item.querySelector("li").dataset.cat_user_cita_status_id = 6;
  $item.querySelector("li").dataset.user_cita_id = cita.user_cita_id;
  return $item;
};
var item_historial_cita2 = function item_historial_cita2(cita, centro_salud) {
  //console.log("🚀 ~ file: helpers.js ~ line 396 ~ cita", cita)
  //console.log(centro_salud)
  var $item = entById('artefacto_0034').content.cloneNode(true);
  $item.querySelector(".header-historia-day").textContent = dia_semana(fechaUserCita(cita), false, true);
  $item.querySelector(".header-historia-day-month").textContent = parseInt(cita.day);
  $item.querySelector(".header-historia-month").textContent = mes(fechaUserCita(cita), false, true);
  $item.querySelector(".header-historia-year").textContent = cita.year;
  $item.querySelector(".header-historia-doctor").textContent = cita.medico;
  $item.querySelector(".header-historia-especiality").textContent = cita.especialidad_nombre;
  $item.querySelector(".header-historia-address").textContent = first(centro_salud.filter(function (x) {
    return equalsInt(x.id, cita.centro_salud_id);
  })).description;
  $item.querySelector("tr").dataset.cat_user_cita_status_id = 7;
  $item.querySelector("tr").dataset.user_cita_id = cita.user_cita_id;
  $item.querySelector("tr").dataset.user_id_paciente = cita.user_id_paciente;
  var reason_for_consultation = cita.reason_for_consultation,
      user_motivo_consulta = cita.user_motivo_consulta;
  var motivo = "";

  if (!is_null(reason_for_consultation)) {
    motivo = reason_for_consultation;
  }

  if (!is_null(user_motivo_consulta)) {
    motivo = user_motivo_consulta.value;
  }

  console.log(motivo);

  if (!is_null(motivo) && !is_empty(motivo) && !is_undefined(motivo)) {
    $item.querySelector(".header-historia-motivo_consulta").textContent = motivo;
  } else {
    $item.querySelector(".header-historia-motivo_consulta").textContent = "No indicado";
  }

  return $item;
};
var active_form = function active_form(tab) {
  var readonly = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;

  if (readonly) {
    d.querySelectorAll("".concat(tab, " textarea")).forEach(function (x) {
      return x.readOnly = true;
    });
    d.querySelectorAll("".concat(tab, " textarea")).forEach(function (x) {
      return x.classList.add("bg-gray");
    });
    d.querySelectorAll("".concat(tab, " input")).forEach(function (x) {
      return x.readOnly = true;
    });
    d.querySelectorAll("".concat(tab, " input")).forEach(function (x) {
      return x.classList.add("bg-gray");
    });
    d.querySelectorAll("".concat(tab, " select")).forEach(function (x) {
      return x.disabled = true;
    });
    d.querySelectorAll("".concat(tab, " select")).forEach(function (x) {
      return x.classList.add("bg-gray");
    });
  } else {
    d.querySelectorAll("".concat(tab, " textarea")).forEach(function (x) {
      return x.readOnly = false;
    });
    d.querySelectorAll("".concat(tab, " textarea")).forEach(function (x) {
      return x.classList.remove("bg-gray");
    });
    d.querySelectorAll("".concat(tab, " input")).forEach(function (x) {
      return x.readOnly = false;
    });
    d.querySelectorAll("".concat(tab, " input")).forEach(function (x) {
      return x.classList.remove("bg-gray");
    });
    d.querySelectorAll("".concat(tab, " select")).forEach(function (x) {
      return x.disabled = false;
    });
    d.querySelectorAll("".concat(tab, " select")).forEach(function (x) {
      return x.classList.remove("bg-gray");
    });
  }
};
var cargandoModal = function cargandoModal() {
  var message = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : "Espere un momento por favor...";
  return (
    /*html */
    "\n            <div class=\"bg-primary p-3\">\n                <div class=\"d-flex justify-content-between text-white\">\n                    <span class=\"float-left font-weight-bold\">\n                        ".concat(message, "\n                    </span>\n                    <span class=\"spinner-border float-right\" role=\"status\">\n                        <span class=\"sr-only\"></span>\n                    </span>\n                </div>\n            </div>\n        ")
  );
};
var get_index = function get_index(attr, key, value) {
  return useState[attr].findIndex(function (index) {
    return equalsInt(index[key], value);
  });
};
var get_one = function get_one(attr, key, value) {
  return useState[attr].filter(function (index) {
    return equalsInt(index[key], value);
  });
};
var get_all = function get_all(attr, key, value) {
  return useState[attr].filter(function (index) {
    return equalsInt(index[key], value);
  });
};
var get_one_by_index = function get_one_by_index(index, attr, key, value) {
  return useState[index][attr].filter(function (index) {
    return equalsInt(index[key], value);
  });
};
var add_row = function add_row(attr, value) {
  var position = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : "first";

  if (position === "first") {
    useState[attr].unshift(value);
  }

  if (position === "last") {
    useState[attr].push(value);
  }
};
var delete_row = function delete_row(_ref2) {
  var attr = _ref2.attr,
      key = _ref2.key,
      value = _ref2.value;
  var resultset = useState[attr].filter(function (row) {
    if (parseInt(row[key]) !== parseInt(value)) {
      return row;
    }
  });
  useState[attr] = resultset;
};
var update_row = function update_row(_ref3) {
  var attr = _ref3.attr,
      key = _ref3.key,
      value = _ref3.value,
      resultset = _ref3.resultset;
  var index = get_index(attr, key, value);
  useState[attr][index] = resultset;
};
var add_row_by_index = function add_row_by_index(index, attr, value) {
  var position = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : "first";

  if (position === "first") {
    useState[index][attr].unshift(value);
  }

  if (position === "last") {
    useState[index][attr].push(value);
  }
};

/***/ })

}]);