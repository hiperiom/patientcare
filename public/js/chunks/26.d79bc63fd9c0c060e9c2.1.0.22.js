(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[26],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Auth/components/ForgotPassword.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Auth/components/ForgotPassword.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************************/
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
  name: "ResetPassword",
  data: function data() {
    return {
      form: {
        email: ''
      }
    };
  },
  methods: {
    procesar: function procesar() {
      var _this = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
        var formdata, resultset;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                if (!_this.validations()) {
                  _context.next = 18;
                  break;
                }

                _this.$store.commit('updateProperty', {
                  fieldName: 'loading',
                  fieldValue: true
                });

                formdata = new FormData();
                formdata.append("email", _this.form.email);
                formdata.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                _context.next = 7;
                return Object(_helpers_customHelpers_js__WEBPACK_IMPORTED_MODULE_1__["post"])(location.origin + "/auth/passwordreset/store", formdata);

              case 7:
                resultset = _context.sent;
                console.log(resultset);

                if (resultset.status === "error_send_email") {
                  localStorage.setItem('email', resultset.email);
                  localStorage.setItem('token', resultset.token);
                  Swal.fire({
                    icon: "error",
                    title: "Código de validación no enviado",
                    text: "Ha ocurrido un error al enviar el c\xF3digo de validaci\xF3n a ".concat(resultset.email, ". Por favor, comunicarse con el administrador del sistema."),
                    didClose: function didClose() {
                      window.location.href = '/auth/recuperarcontrasena';
                    }
                  });
                }

                if (!(resultset.status === "data_not_found")) {
                  _context.next = 13;
                  break;
                }

                Swal.fire({
                  icon: "error",
                  title: "Datos incorrectos",
                  text: "El Correo electrónico no es correcto o no está registrado. Verifique.",
                  didClose: function didClose() {
                    setTimeout(function () {
                      return _this.$refs.email.focus();
                    }, 110);
                  }
                });
                return _context.abrupt("return", false);

              case 13:
                if (!(resultset.status === "email_not_found")) {
                  _context.next = 16;
                  break;
                }

                Swal.fire({
                  icon: "error",
                  title: "Correo no enviado",
                  text: "Disculpe, ha ocurrido un inconveniente en el envio del código de validación a su correo. Intente nuevamente o pongase en contacto con el administrador del sistema.",
                  didClose: function didClose() {
                    setTimeout(function () {
                      return _this.$refs.email.focus();
                    }, 110);
                  }
                });
                return _context.abrupt("return", false);

              case 16:
                /* if (resultset.status ==="email_send") {
                      Swal.fire({
                        icon: "success",
                        title: "Contraseña reiniciada",
                        text: `Por favor, verifique el correo ${resultset.email} para obtener el código enviado.`,
                    })
                } */
                if (resultset.status) {
                  Swal.fire({
                    icon: "success",
                    title: "Contraseña reiniciada",
                    text: "Por favor, verifique el correo ".concat(resultset.email, " para obtener el c\xF3digo enviado.")
                  });
                  localStorage.setItem('email', resultset.email);
                  localStorage.setItem('token', resultset.token);
                  window.location.href = '/auth/recuperarcontrasena';
                }

                _this.$store.commit('updateProperty', {
                  fieldName: 'loading',
                  fieldValue: false
                });

              case 18:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }))();
    },
    validations: function validations() {
      var _this2 = this;

      if (Object(_helpers_customHelpers_js__WEBPACK_IMPORTED_MODULE_1__["is_empty"])(this.form.email)) {
        Swal.fire({
          icon: "warning",
          title: "Campo vacio",
          text: "Por favor, escribe una cédula o correo electrónico válido.",
          didClose: function didClose() {
            setTimeout(function () {
              return _this2.$refs.email.focus();
            }, 110);
          }
        });
        return false;
      }

      return true;
    }
  },
  mounted: function mounted() {
    this.$store.commit('updateProperty', {
      fieldName: 'loading',
      fieldValue: false
    });
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Auth/components/ForgotPassword.vue?vue&type=template&id=5d77369b&":
/*!***************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Auth/components/ForgotPassword.vue?vue&type=template&id=5d77369b& ***!
  \***************************************************************************************************************************************************************************************************************************************************************/
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
    staticClass: "bg-white col-10 col-sm-6 col-md-6 col-lg-4 col-xl-4 text-center p-4 rounded-pill"
  }, [_c("img", {
    staticClass: "img-fluid",
    staticStyle: {
      height: "3.5em"
    },
    attrs: {
      src: "https://patientcare.cmdlt.pstelemed.com/image/system/logo-cmdlt-color.svg",
      alt: "Not Logo System Found"
    }
  }), _vm._v(" "), _vm._m(0), _vm._v(" "), _c("div", {
    staticClass: "text-center text-secondary my-3"
  }, [_vm._v("\n        Escribe tu correo electrónico\n    ")]), _vm._v(" "), _c("form", {
    on: {
      submit: function submit($event) {
        $event.preventDefault();
        return _vm.procesar();
      }
    }
  }, [_c("div", {
    staticClass: "input-group mb-3"
  }, [_c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.form.email,
      expression: "form.email"
    }],
    ref: "email",
    staticClass: "form-control",
    attrs: {
      type: "text",
      name: "email",
      autocomplete: "off",
      placeholder: "Escriba cédula o correo"
    },
    domProps: {
      value: _vm.form.email
    },
    on: {
      input: function input($event) {
        if ($event.target.composing) return;

        _vm.$set(_vm.form, "email", $event.target.value);
      }
    }
  }), _vm._v(" "), _vm._m(1)]), _vm._v(" "), _c("button", {
    staticClass: "btn btn-primary mb-3 w-100",
    attrs: {
      type: "submit"
    }
  }, [_vm._v("\n            Resetear contraseña\n        ")])]), _vm._v(" "), _c("router-link", {
    staticClass: "btn btn-default w-100 font-weight-bold text-secondary",
    attrs: {
      to: "/"
    }
  }, [_vm._v("Regresar")])], 1);
};

var staticRenderFns = [function () {
  var _vm = this,
      _c = _vm._self._c;

  return _c("h4", {
    staticClass: "text-center text-secondary mt-3"
  }, [_vm._v("Actualizar o recuperar"), _c("br"), _vm._v("datos de acceso")]);
}, function () {
  var _vm = this,
      _c = _vm._self._c;

  return _c("div", {
    staticClass: "input-group-append"
  }, [_c("div", {
    staticClass: "input-group-text"
  }, [_c("span", {
    staticClass: "fas fa-envelope"
  })])]);
}];
render._withStripped = true;


/***/ }),

/***/ "./resources/js/components/Auth/components/ForgotPassword.vue":
/*!********************************************************************!*\
  !*** ./resources/js/components/Auth/components/ForgotPassword.vue ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ForgotPassword_vue_vue_type_template_id_5d77369b___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ForgotPassword.vue?vue&type=template&id=5d77369b& */ "./resources/js/components/Auth/components/ForgotPassword.vue?vue&type=template&id=5d77369b&");
/* harmony import */ var _ForgotPassword_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ForgotPassword.vue?vue&type=script&lang=js& */ "./resources/js/components/Auth/components/ForgotPassword.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ForgotPassword_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ForgotPassword_vue_vue_type_template_id_5d77369b___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ForgotPassword_vue_vue_type_template_id_5d77369b___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Auth/components/ForgotPassword.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Auth/components/ForgotPassword.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************!*\
  !*** ./resources/js/components/Auth/components/ForgotPassword.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ForgotPassword.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Auth/components/ForgotPassword.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Auth/components/ForgotPassword.vue?vue&type=template&id=5d77369b&":
/*!***************************************************************************************************!*\
  !*** ./resources/js/components/Auth/components/ForgotPassword.vue?vue&type=template&id=5d77369b& ***!
  \***************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_template_id_5d77369b___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ForgotPassword.vue?vue&type=template&id=5d77369b& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Auth/components/ForgotPassword.vue?vue&type=template&id=5d77369b&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_template_id_5d77369b___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_template_id_5d77369b___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);