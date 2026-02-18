(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[44],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ConsultaExterna/components/PacienteCreate.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ConsultaExterna/components/PacienteCreate.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "PacienteCreate"
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ConsultaExterna/components/PacienteCreate.vue?vue&type=template&id=71770968&scoped=true&":
/*!**************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ConsultaExterna/components/PacienteCreate.vue?vue&type=template&id=71770968&scoped=true& ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function render() {
  var _vm = this,
      _c = _vm._self._c;

  return _vm._m(0);
};

var staticRenderFns = [function () {
  var _vm = this,
      _c = _vm._self._c;

  return _c("div", {
    staticClass: "container"
  }, [_c("div", {
    staticClass: "row justify-content-center"
  }, [_c("div", {
    staticClass: "col-12"
  }, [_c("form", [_c("div", {
    staticClass: "container"
  }, [_c("div", {
    staticClass: "overlay-wrapper pb-5"
  }, [_c("div", {
    staticClass: "overlay d-none"
  }, [_c("i", {
    staticClass: "fas fa-3x fa-sync-alt text-primary fa-spin"
  }), _vm._v(" "), _c("div", {
    staticClass: "text-bold text-primary pt-2"
  }, [_vm._v("Por favor espere...")])]), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-12 text-center"
  }, [_c("h3", {
    staticClass: "text-primary font-weight-bold d-none"
  }, [_vm._v("Nuevo Paciente")])])]), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-2"
  }, [_c("label", {
    staticClass: "text-primary",
    attrs: {
      "for": "cedula"
    }
  }, [_vm._v("Foto")]), _vm._v(" "), _c("div", {
    staticClass: "d-flex items-align-center"
  }, [_c("div", {
    staticClass: "fileImageInput"
  }, [_c("label", {
    staticClass: "heartbeat cursor-pointer",
    staticStyle: {
      display: "flex",
      "align-items": "center",
      border: "2px dashed rgb(190, 189, 189)",
      height: "100px",
      width: "100%"
    },
    attrs: {
      "for": "userImage"
    }
  }, [_c("img", {
    staticStyle: {
      height: "100%",
      width: "inherit"
    },
    attrs: {
      onerror: "reemplaza_imagen(this)",
      id: "userImagePreview",
      src: "/image/system/patient.svg",
      alt: "User Avatar"
    }
  })]), _vm._v(" "), _c("input", {
    staticStyle: {
      display: "none"
    },
    attrs: {
      id: "userImage",
      name: "imagen",
      type: "file",
      accept: "image/jpg, jpeg, bmp, png"
    }
  }), _vm._v(" "), _c("span", {
    staticClass: "filename"
  })])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-5"
  }, [_c("div", {
    staticClass: "form-group mt-xs-6"
  }, [_c("label", {
    staticClass: "text-primary",
    attrs: {
      "for": "cedula"
    }
  }, [_vm._v("Documento de identidad")]), _vm._v(" "), _c("div", {
    attrs: {
      id: "no_edit_cedula"
    }
  }), _vm._v(" "), _c("table", {
    staticClass: "w-100"
  }, [_c("tbody", [_c("tr", [_c("td", {
    staticStyle: {
      width: "20%"
    }
  }, [_c("select", {
    staticClass: "form-control",
    attrs: {
      title: "Seleccione una nacionalidad",
      name: "nacionalidad",
      id: "nacionalidad"
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
  }, [_vm._v("P")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "J"
    }
  }, [_vm._v("J")])]), _vm._v(" "), _c("small", {
    staticClass: "notification",
    attrs: {
      id: "help_nacionalidad"
    }
  })]), _vm._v(" "), _c("td", [_c("input", {
    staticClass: "form-control",
    attrs: {
      required: "",
      title: "Un Documento de identidad es requerido",
      type: "text",
      name: "cedula",
      id: "cedula",
      "aria-describedby": "helpId",
      placeholder: ""
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "notification",
    attrs: {
      id: "help_cedula"
    }
  })])])])])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-5"
  }, [_c("div", {
    staticClass: "form-group mt-xs-6"
  }, [_c("label", {
    staticClass: "text-primary",
    attrs: {
      "for": "email"
    }
  }, [_vm._v("Correo Electrónico")]), _vm._v(" "), _c("div", {
    attrs: {
      id: "no_edit_email"
    }
  }), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      type: "text",
      required: "",
      title: "Un Correo Electrónico es requerido",
      name: "email",
      id: "email",
      "aria-describedby": "helpEmail"
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "notification",
    attrs: {
      id: "help_email"
    }
  })])])]), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "text-primary",
    attrs: {
      "for": "nombre"
    }
  }, [_vm._v("Nombres")]), _vm._v(" "), _c("div", {
    attrs: {
      id: "no_edit_nombres"
    }
  }), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      type: "text",
      required: "",
      title: "Tu primer y segundo nombre son requeridos",
      name: "nombres",
      id: "nombres",
      "aria-describedby": "helpId",
      placeholder: ""
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "notification",
    attrs: {
      id: "help_nombres"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "text-primary",
    attrs: {
      "for": "apellido"
    }
  }, [_vm._v("Apellidos")]), _vm._v(" "), _c("div", {
    attrs: {
      id: "no_edit_apellidos"
    }
  }), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      type: "text",
      title: "Tu primer y segundo apellido son requeridos",
      required: "",
      name: "apellidos",
      id: "apellidos",
      "aria-describedby": "helpId",
      placeholder: ""
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "notification",
    attrs: {
      id: "help_apellidos"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "text-primary",
    attrs: {
      "for": "genero"
    }
  }, [_vm._v("Género")]), _vm._v(" "), _c("div", {
    attrs: {
      id: "no_edit_genero"
    }
  }), _vm._v(" "), _c("select", {
    staticClass: "form-control required",
    attrs: {
      name: "genero",
      id: "genero",
      "aria-describedby": "helpId",
      placeholder: ""
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
    staticClass: "notification",
    attrs: {
      id: "help_genero"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "text-primary",
    attrs: {
      "for": "fnacimiento"
    }
  }, [_vm._v("Fecha de nacimiento")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      type: "date",
      required: "",
      title: "Tu Fecha de nacimiento es requerida",
      name: "fnacimiento",
      id: "fnacimiento",
      "aria-describedby": "helpId",
      placeholder: ""
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "notification",
    attrs: {
      id: "help_fnacimiento"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "text-primary",
    attrs: {
      "for": "telefono_movil"
    }
  }, [_vm._v("Teléfono Contacto")]), _vm._v(" "), _c("div", {
    staticClass: "iti iti--allow-dropdown iti--separate-dial-code"
  }, [_c("div", {
    staticClass: "iti__flag-container"
  }, [_c("div", {
    staticClass: "iti__selected-flag",
    attrs: {
      role: "combobox",
      "aria-controls": "iti-0__country-listbox",
      "aria-owns": "iti-0__country-listbox",
      "aria-expanded": "false",
      tabindex: "0",
      title: "Venezuela: +58",
      "aria-activedescendant": "iti-0__item-ve-preferred"
    }
  }, [_c("div", {
    staticClass: "iti__flag iti__ve"
  }), _c("div", {
    staticClass: "iti__selected-dial-code"
  }, [_vm._v("+58")]), _c("div", {
    staticClass: "iti__arrow"
  })]), _c("ul", {
    staticClass: "iti__country-list iti__hide",
    attrs: {
      id: "iti-0__country-listbox",
      role: "listbox",
      "aria-label": "List of countries"
    }
  }, [_c("li", {
    staticClass: "iti__country iti__preferred iti__active",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ve-preferred",
      role: "option",
      "data-dial-code": "58",
      "data-country-code": "ve",
      "aria-selected": "true"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ve"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Venezuela")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+58")])]), _c("li", {
    staticClass: "iti__divider",
    attrs: {
      role: "separator",
      "aria-disabled": "true"
    }
  }), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-af",
      role: "option",
      "data-dial-code": "93",
      "data-country-code": "af",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__af"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Afghanistan (‫افغانستان‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+93")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-al",
      role: "option",
      "data-dial-code": "355",
      "data-country-code": "al",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__al"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Albania (Shqipëri)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+355")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-dz",
      role: "option",
      "data-dial-code": "213",
      "data-country-code": "dz",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__dz"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Algeria (‫الجزائر‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+213")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-as",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "as",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__as"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("American Samoa")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ad",
      role: "option",
      "data-dial-code": "376",
      "data-country-code": "ad",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ad"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Andorra")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+376")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ao",
      role: "option",
      "data-dial-code": "244",
      "data-country-code": "ao",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ao"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Angola")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+244")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ai",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "ai",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ai"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Anguilla")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ag",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "ag",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ag"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Antigua and Barbuda")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ar",
      role: "option",
      "data-dial-code": "54",
      "data-country-code": "ar",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ar"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Argentina")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+54")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-am",
      role: "option",
      "data-dial-code": "374",
      "data-country-code": "am",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__am"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Armenia (Հայաստան)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+374")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-aw",
      role: "option",
      "data-dial-code": "297",
      "data-country-code": "aw",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__aw"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Aruba")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+297")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ac",
      role: "option",
      "data-dial-code": "247",
      "data-country-code": "ac",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ac"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Ascension Island")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+247")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-au",
      role: "option",
      "data-dial-code": "61",
      "data-country-code": "au",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__au"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Australia")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+61")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-at",
      role: "option",
      "data-dial-code": "43",
      "data-country-code": "at",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__at"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Austria (Österreich)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+43")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-az",
      role: "option",
      "data-dial-code": "994",
      "data-country-code": "az",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__az"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Azerbaijan (Azərbaycan)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+994")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-bs",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "bs",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__bs"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Bahamas")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-bh",
      role: "option",
      "data-dial-code": "973",
      "data-country-code": "bh",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__bh"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Bahrain (‫البحرين‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+973")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-bd",
      role: "option",
      "data-dial-code": "880",
      "data-country-code": "bd",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__bd"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Bangladesh (বাংলাদেশ)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+880")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-bb",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "bb",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__bb"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Barbados")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-by",
      role: "option",
      "data-dial-code": "375",
      "data-country-code": "by",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__by"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Belarus (Беларусь)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+375")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-be",
      role: "option",
      "data-dial-code": "32",
      "data-country-code": "be",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__be"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Belgium (België)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+32")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-bz",
      role: "option",
      "data-dial-code": "501",
      "data-country-code": "bz",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__bz"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Belize")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+501")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-bj",
      role: "option",
      "data-dial-code": "229",
      "data-country-code": "bj",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__bj"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Benin (Bénin)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+229")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-bm",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "bm",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__bm"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Bermuda")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-bt",
      role: "option",
      "data-dial-code": "975",
      "data-country-code": "bt",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__bt"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Bhutan (འབྲུག)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+975")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-bo",
      role: "option",
      "data-dial-code": "591",
      "data-country-code": "bo",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__bo"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Bolivia")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+591")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ba",
      role: "option",
      "data-dial-code": "387",
      "data-country-code": "ba",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ba"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Bosnia and Herzegovina (Босна и Херцеговина)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+387")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-bw",
      role: "option",
      "data-dial-code": "267",
      "data-country-code": "bw",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__bw"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Botswana")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+267")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-br",
      role: "option",
      "data-dial-code": "55",
      "data-country-code": "br",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__br"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Brazil (Brasil)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+55")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-io",
      role: "option",
      "data-dial-code": "246",
      "data-country-code": "io",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__io"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("British Indian Ocean Territory")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+246")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-vg",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "vg",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__vg"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("British Virgin Islands")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-bn",
      role: "option",
      "data-dial-code": "673",
      "data-country-code": "bn",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__bn"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Brunei")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+673")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-bg",
      role: "option",
      "data-dial-code": "359",
      "data-country-code": "bg",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__bg"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Bulgaria (България)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+359")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-bf",
      role: "option",
      "data-dial-code": "226",
      "data-country-code": "bf",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__bf"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Burkina Faso")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+226")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-bi",
      role: "option",
      "data-dial-code": "257",
      "data-country-code": "bi",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__bi"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Burundi (Uburundi)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+257")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-kh",
      role: "option",
      "data-dial-code": "855",
      "data-country-code": "kh",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__kh"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Cambodia (កម្ពុជា)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+855")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-cm",
      role: "option",
      "data-dial-code": "237",
      "data-country-code": "cm",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__cm"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Cameroon (Cameroun)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+237")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ca",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "ca",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ca"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Canada")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-cv",
      role: "option",
      "data-dial-code": "238",
      "data-country-code": "cv",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__cv"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Cape Verde (Kabu Verdi)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+238")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-bq",
      role: "option",
      "data-dial-code": "599",
      "data-country-code": "bq",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__bq"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Caribbean Netherlands")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+599")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ky",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "ky",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ky"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Cayman Islands")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-cf",
      role: "option",
      "data-dial-code": "236",
      "data-country-code": "cf",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__cf"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Central African Republic (République centrafricaine)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+236")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-td",
      role: "option",
      "data-dial-code": "235",
      "data-country-code": "td",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__td"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Chad (Tchad)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+235")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-cl",
      role: "option",
      "data-dial-code": "56",
      "data-country-code": "cl",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__cl"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Chile")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+56")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-cn",
      role: "option",
      "data-dial-code": "86",
      "data-country-code": "cn",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__cn"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("China (中国)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+86")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-cx",
      role: "option",
      "data-dial-code": "61",
      "data-country-code": "cx",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__cx"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Christmas Island")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+61")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-cc",
      role: "option",
      "data-dial-code": "61",
      "data-country-code": "cc",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__cc"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Cocos (Keeling) Islands")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+61")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-co",
      role: "option",
      "data-dial-code": "57",
      "data-country-code": "co",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__co"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Colombia")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+57")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-km",
      role: "option",
      "data-dial-code": "269",
      "data-country-code": "km",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__km"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Comoros (‫جزر القمر‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+269")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-cd",
      role: "option",
      "data-dial-code": "243",
      "data-country-code": "cd",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__cd"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+243")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-cg",
      role: "option",
      "data-dial-code": "242",
      "data-country-code": "cg",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__cg"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Congo (Republic) (Congo-Brazzaville)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+242")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ck",
      role: "option",
      "data-dial-code": "682",
      "data-country-code": "ck",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ck"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Cook Islands")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+682")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-cr",
      role: "option",
      "data-dial-code": "506",
      "data-country-code": "cr",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__cr"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Costa Rica")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+506")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ci",
      role: "option",
      "data-dial-code": "225",
      "data-country-code": "ci",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ci"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Côte d’Ivoire")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+225")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-hr",
      role: "option",
      "data-dial-code": "385",
      "data-country-code": "hr",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__hr"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Croatia (Hrvatska)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+385")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-cu",
      role: "option",
      "data-dial-code": "53",
      "data-country-code": "cu",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__cu"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Cuba")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+53")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-cw",
      role: "option",
      "data-dial-code": "599",
      "data-country-code": "cw",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__cw"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Curaçao")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+599")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-cy",
      role: "option",
      "data-dial-code": "357",
      "data-country-code": "cy",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__cy"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Cyprus (Κύπρος)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+357")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-cz",
      role: "option",
      "data-dial-code": "420",
      "data-country-code": "cz",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__cz"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Czech Republic (Česká republika)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+420")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-dk",
      role: "option",
      "data-dial-code": "45",
      "data-country-code": "dk",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__dk"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Denmark (Danmark)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+45")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-dj",
      role: "option",
      "data-dial-code": "253",
      "data-country-code": "dj",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__dj"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Djibouti")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+253")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-dm",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "dm",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__dm"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Dominica")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-do",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "do",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__do"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Dominican Republic (República Dominicana)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ec",
      role: "option",
      "data-dial-code": "593",
      "data-country-code": "ec",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ec"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Ecuador")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+593")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-eg",
      role: "option",
      "data-dial-code": "20",
      "data-country-code": "eg",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__eg"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Egypt (‫مصر‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+20")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-sv",
      role: "option",
      "data-dial-code": "503",
      "data-country-code": "sv",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__sv"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("El Salvador")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+503")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-gq",
      role: "option",
      "data-dial-code": "240",
      "data-country-code": "gq",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__gq"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Equatorial Guinea (Guinea Ecuatorial)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+240")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-er",
      role: "option",
      "data-dial-code": "291",
      "data-country-code": "er",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__er"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Eritrea")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+291")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ee",
      role: "option",
      "data-dial-code": "372",
      "data-country-code": "ee",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ee"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Estonia (Eesti)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+372")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-sz",
      role: "option",
      "data-dial-code": "268",
      "data-country-code": "sz",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__sz"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Eswatini")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+268")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-et",
      role: "option",
      "data-dial-code": "251",
      "data-country-code": "et",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__et"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Ethiopia")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+251")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-fk",
      role: "option",
      "data-dial-code": "500",
      "data-country-code": "fk",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__fk"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Falkland Islands (Islas Malvinas)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+500")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-fo",
      role: "option",
      "data-dial-code": "298",
      "data-country-code": "fo",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__fo"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Faroe Islands (Føroyar)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+298")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-fj",
      role: "option",
      "data-dial-code": "679",
      "data-country-code": "fj",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__fj"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Fiji")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+679")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-fi",
      role: "option",
      "data-dial-code": "358",
      "data-country-code": "fi",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__fi"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Finland (Suomi)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+358")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-fr",
      role: "option",
      "data-dial-code": "33",
      "data-country-code": "fr",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__fr"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("France")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+33")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-gf",
      role: "option",
      "data-dial-code": "594",
      "data-country-code": "gf",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__gf"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("French Guiana (Guyane française)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+594")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-pf",
      role: "option",
      "data-dial-code": "689",
      "data-country-code": "pf",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__pf"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("French Polynesia (Polynésie française)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+689")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ga",
      role: "option",
      "data-dial-code": "241",
      "data-country-code": "ga",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ga"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Gabon")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+241")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-gm",
      role: "option",
      "data-dial-code": "220",
      "data-country-code": "gm",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__gm"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Gambia")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+220")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ge",
      role: "option",
      "data-dial-code": "995",
      "data-country-code": "ge",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ge"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Georgia (საქართველო)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+995")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-de",
      role: "option",
      "data-dial-code": "49",
      "data-country-code": "de",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__de"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Germany (Deutschland)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+49")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-gh",
      role: "option",
      "data-dial-code": "233",
      "data-country-code": "gh",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__gh"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Ghana (Gaana)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+233")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-gi",
      role: "option",
      "data-dial-code": "350",
      "data-country-code": "gi",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__gi"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Gibraltar")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+350")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-gr",
      role: "option",
      "data-dial-code": "30",
      "data-country-code": "gr",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__gr"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Greece (Ελλάδα)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+30")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-gl",
      role: "option",
      "data-dial-code": "299",
      "data-country-code": "gl",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__gl"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Greenland (Kalaallit Nunaat)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+299")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-gd",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "gd",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__gd"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Grenada")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-gp",
      role: "option",
      "data-dial-code": "590",
      "data-country-code": "gp",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__gp"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Guadeloupe")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+590")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-gu",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "gu",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__gu"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Guam")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-gt",
      role: "option",
      "data-dial-code": "502",
      "data-country-code": "gt",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__gt"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Guatemala")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+502")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-gg",
      role: "option",
      "data-dial-code": "44",
      "data-country-code": "gg",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__gg"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Guernsey")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+44")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-gn",
      role: "option",
      "data-dial-code": "224",
      "data-country-code": "gn",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__gn"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Guinea (Guinée)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+224")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-gw",
      role: "option",
      "data-dial-code": "245",
      "data-country-code": "gw",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__gw"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Guinea-Bissau (Guiné Bissau)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+245")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-gy",
      role: "option",
      "data-dial-code": "592",
      "data-country-code": "gy",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__gy"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Guyana")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+592")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ht",
      role: "option",
      "data-dial-code": "509",
      "data-country-code": "ht",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ht"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Haiti")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+509")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-hn",
      role: "option",
      "data-dial-code": "504",
      "data-country-code": "hn",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__hn"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Honduras")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+504")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-hk",
      role: "option",
      "data-dial-code": "852",
      "data-country-code": "hk",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__hk"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Hong Kong (香港)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+852")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-hu",
      role: "option",
      "data-dial-code": "36",
      "data-country-code": "hu",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__hu"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Hungary (Magyarország)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+36")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-is",
      role: "option",
      "data-dial-code": "354",
      "data-country-code": "is",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__is"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Iceland (Ísland)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+354")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-in",
      role: "option",
      "data-dial-code": "91",
      "data-country-code": "in",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__in"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("India (भारत)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+91")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-id",
      role: "option",
      "data-dial-code": "62",
      "data-country-code": "id",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__id"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Indonesia")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+62")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ir",
      role: "option",
      "data-dial-code": "98",
      "data-country-code": "ir",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ir"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Iran (‫ایران‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+98")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-iq",
      role: "option",
      "data-dial-code": "964",
      "data-country-code": "iq",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__iq"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Iraq (‫العراق‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+964")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ie",
      role: "option",
      "data-dial-code": "353",
      "data-country-code": "ie",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ie"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Ireland")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+353")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-im",
      role: "option",
      "data-dial-code": "44",
      "data-country-code": "im",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__im"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Isle of Man")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+44")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-il",
      role: "option",
      "data-dial-code": "972",
      "data-country-code": "il",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__il"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Israel (‫ישראל‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+972")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-it",
      role: "option",
      "data-dial-code": "39",
      "data-country-code": "it",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__it"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Italy (Italia)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+39")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-jm",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "jm",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__jm"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Jamaica")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-jp",
      role: "option",
      "data-dial-code": "81",
      "data-country-code": "jp",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__jp"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Japan (日本)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+81")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-je",
      role: "option",
      "data-dial-code": "44",
      "data-country-code": "je",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__je"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Jersey")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+44")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-jo",
      role: "option",
      "data-dial-code": "962",
      "data-country-code": "jo",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__jo"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Jordan (‫الأردن‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+962")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-kz",
      role: "option",
      "data-dial-code": "7",
      "data-country-code": "kz",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__kz"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Kazakhstan (Казахстан)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+7")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ke",
      role: "option",
      "data-dial-code": "254",
      "data-country-code": "ke",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ke"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Kenya")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+254")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ki",
      role: "option",
      "data-dial-code": "686",
      "data-country-code": "ki",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ki"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Kiribati")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+686")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-xk",
      role: "option",
      "data-dial-code": "383",
      "data-country-code": "xk",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__xk"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Kosovo")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+383")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-kw",
      role: "option",
      "data-dial-code": "965",
      "data-country-code": "kw",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__kw"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Kuwait (‫الكويت‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+965")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-kg",
      role: "option",
      "data-dial-code": "996",
      "data-country-code": "kg",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__kg"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Kyrgyzstan (Кыргызстан)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+996")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-la",
      role: "option",
      "data-dial-code": "856",
      "data-country-code": "la",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__la"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Laos (ລາວ)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+856")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-lv",
      role: "option",
      "data-dial-code": "371",
      "data-country-code": "lv",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__lv"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Latvia (Latvija)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+371")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-lb",
      role: "option",
      "data-dial-code": "961",
      "data-country-code": "lb",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__lb"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Lebanon (‫لبنان‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+961")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ls",
      role: "option",
      "data-dial-code": "266",
      "data-country-code": "ls",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ls"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Lesotho")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+266")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-lr",
      role: "option",
      "data-dial-code": "231",
      "data-country-code": "lr",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__lr"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Liberia")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+231")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ly",
      role: "option",
      "data-dial-code": "218",
      "data-country-code": "ly",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ly"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Libya (‫ليبيا‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+218")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-li",
      role: "option",
      "data-dial-code": "423",
      "data-country-code": "li",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__li"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Liechtenstein")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+423")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-lt",
      role: "option",
      "data-dial-code": "370",
      "data-country-code": "lt",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__lt"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Lithuania (Lietuva)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+370")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-lu",
      role: "option",
      "data-dial-code": "352",
      "data-country-code": "lu",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__lu"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Luxembourg")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+352")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-mo",
      role: "option",
      "data-dial-code": "853",
      "data-country-code": "mo",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__mo"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Macau (澳門)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+853")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-mk",
      role: "option",
      "data-dial-code": "389",
      "data-country-code": "mk",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__mk"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Macedonia (FYROM) (Македонија)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+389")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-mg",
      role: "option",
      "data-dial-code": "261",
      "data-country-code": "mg",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__mg"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Madagascar (Madagasikara)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+261")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-mw",
      role: "option",
      "data-dial-code": "265",
      "data-country-code": "mw",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__mw"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Malawi")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+265")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-my",
      role: "option",
      "data-dial-code": "60",
      "data-country-code": "my",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__my"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Malaysia")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+60")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-mv",
      role: "option",
      "data-dial-code": "960",
      "data-country-code": "mv",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__mv"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Maldives")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+960")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ml",
      role: "option",
      "data-dial-code": "223",
      "data-country-code": "ml",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ml"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Mali")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+223")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-mt",
      role: "option",
      "data-dial-code": "356",
      "data-country-code": "mt",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__mt"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Malta")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+356")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-mh",
      role: "option",
      "data-dial-code": "692",
      "data-country-code": "mh",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__mh"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Marshall Islands")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+692")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-mq",
      role: "option",
      "data-dial-code": "596",
      "data-country-code": "mq",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__mq"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Martinique")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+596")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-mr",
      role: "option",
      "data-dial-code": "222",
      "data-country-code": "mr",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__mr"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Mauritania (‫موريتانيا‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+222")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-mu",
      role: "option",
      "data-dial-code": "230",
      "data-country-code": "mu",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__mu"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Mauritius (Moris)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+230")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-yt",
      role: "option",
      "data-dial-code": "262",
      "data-country-code": "yt",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__yt"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Mayotte")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+262")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-mx",
      role: "option",
      "data-dial-code": "52",
      "data-country-code": "mx",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__mx"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Mexico (México)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+52")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-fm",
      role: "option",
      "data-dial-code": "691",
      "data-country-code": "fm",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__fm"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Micronesia")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+691")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-md",
      role: "option",
      "data-dial-code": "373",
      "data-country-code": "md",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__md"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Moldova (Republica Moldova)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+373")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-mc",
      role: "option",
      "data-dial-code": "377",
      "data-country-code": "mc",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__mc"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Monaco")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+377")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-mn",
      role: "option",
      "data-dial-code": "976",
      "data-country-code": "mn",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__mn"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Mongolia (Монгол)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+976")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-me",
      role: "option",
      "data-dial-code": "382",
      "data-country-code": "me",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__me"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Montenegro (Crna Gora)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+382")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ms",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "ms",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ms"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Montserrat")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ma",
      role: "option",
      "data-dial-code": "212",
      "data-country-code": "ma",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ma"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Morocco (‫المغرب‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+212")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-mz",
      role: "option",
      "data-dial-code": "258",
      "data-country-code": "mz",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__mz"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Mozambique (Moçambique)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+258")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-mm",
      role: "option",
      "data-dial-code": "95",
      "data-country-code": "mm",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__mm"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Myanmar (Burma) (မြန်မာ)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+95")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-na",
      role: "option",
      "data-dial-code": "264",
      "data-country-code": "na",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__na"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Namibia (Namibië)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+264")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-nr",
      role: "option",
      "data-dial-code": "674",
      "data-country-code": "nr",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__nr"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Nauru")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+674")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-np",
      role: "option",
      "data-dial-code": "977",
      "data-country-code": "np",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__np"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Nepal (नेपाल)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+977")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-nl",
      role: "option",
      "data-dial-code": "31",
      "data-country-code": "nl",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__nl"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Netherlands (Nederland)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+31")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-nc",
      role: "option",
      "data-dial-code": "687",
      "data-country-code": "nc",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__nc"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("New Caledonia (Nouvelle-Calédonie)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+687")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-nz",
      role: "option",
      "data-dial-code": "64",
      "data-country-code": "nz",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__nz"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("New Zealand")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+64")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ni",
      role: "option",
      "data-dial-code": "505",
      "data-country-code": "ni",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ni"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Nicaragua")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+505")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ne",
      role: "option",
      "data-dial-code": "227",
      "data-country-code": "ne",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ne"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Niger (Nijar)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+227")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ng",
      role: "option",
      "data-dial-code": "234",
      "data-country-code": "ng",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ng"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Nigeria")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+234")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-nu",
      role: "option",
      "data-dial-code": "683",
      "data-country-code": "nu",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__nu"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Niue")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+683")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-nf",
      role: "option",
      "data-dial-code": "672",
      "data-country-code": "nf",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__nf"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Norfolk Island")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+672")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-kp",
      role: "option",
      "data-dial-code": "850",
      "data-country-code": "kp",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__kp"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("North Korea (조선 민주주의 인민 공화국)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+850")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-mp",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "mp",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__mp"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Northern Mariana Islands")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-no",
      role: "option",
      "data-dial-code": "47",
      "data-country-code": "no",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__no"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Norway (Norge)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+47")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-om",
      role: "option",
      "data-dial-code": "968",
      "data-country-code": "om",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__om"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Oman (‫عُمان‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+968")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-pk",
      role: "option",
      "data-dial-code": "92",
      "data-country-code": "pk",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__pk"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Pakistan (‫پاکستان‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+92")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-pw",
      role: "option",
      "data-dial-code": "680",
      "data-country-code": "pw",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__pw"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Palau")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+680")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ps",
      role: "option",
      "data-dial-code": "970",
      "data-country-code": "ps",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ps"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Palestine (‫فلسطين‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+970")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-pa",
      role: "option",
      "data-dial-code": "507",
      "data-country-code": "pa",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__pa"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Panama (Panamá)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+507")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-pg",
      role: "option",
      "data-dial-code": "675",
      "data-country-code": "pg",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__pg"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Papua New Guinea")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+675")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-py",
      role: "option",
      "data-dial-code": "595",
      "data-country-code": "py",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__py"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Paraguay")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+595")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-pe",
      role: "option",
      "data-dial-code": "51",
      "data-country-code": "pe",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__pe"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Peru (Perú)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+51")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ph",
      role: "option",
      "data-dial-code": "63",
      "data-country-code": "ph",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ph"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Philippines")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+63")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-pl",
      role: "option",
      "data-dial-code": "48",
      "data-country-code": "pl",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__pl"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Poland (Polska)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+48")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-pt",
      role: "option",
      "data-dial-code": "351",
      "data-country-code": "pt",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__pt"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Portugal")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+351")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-pr",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "pr",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__pr"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Puerto Rico")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-qa",
      role: "option",
      "data-dial-code": "974",
      "data-country-code": "qa",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__qa"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Qatar (‫قطر‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+974")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-re",
      role: "option",
      "data-dial-code": "262",
      "data-country-code": "re",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__re"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Réunion (La Réunion)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+262")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ro",
      role: "option",
      "data-dial-code": "40",
      "data-country-code": "ro",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ro"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Romania (România)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+40")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ru",
      role: "option",
      "data-dial-code": "7",
      "data-country-code": "ru",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ru"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Russia (Россия)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+7")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-rw",
      role: "option",
      "data-dial-code": "250",
      "data-country-code": "rw",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__rw"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Rwanda")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+250")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-bl",
      role: "option",
      "data-dial-code": "590",
      "data-country-code": "bl",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__bl"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Saint Barthélemy")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+590")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-sh",
      role: "option",
      "data-dial-code": "290",
      "data-country-code": "sh",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__sh"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Saint Helena")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+290")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-kn",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "kn",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__kn"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Saint Kitts and Nevis")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-lc",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "lc",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__lc"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Saint Lucia")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-mf",
      role: "option",
      "data-dial-code": "590",
      "data-country-code": "mf",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__mf"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Saint Martin (Saint-Martin (partie française))")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+590")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-pm",
      role: "option",
      "data-dial-code": "508",
      "data-country-code": "pm",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__pm"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+508")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-vc",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "vc",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__vc"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Saint Vincent and the Grenadines")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ws",
      role: "option",
      "data-dial-code": "685",
      "data-country-code": "ws",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ws"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Samoa")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+685")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-sm",
      role: "option",
      "data-dial-code": "378",
      "data-country-code": "sm",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__sm"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("San Marino")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+378")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-st",
      role: "option",
      "data-dial-code": "239",
      "data-country-code": "st",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__st"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("São Tomé and Príncipe (São Tomé e Príncipe)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+239")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-sa",
      role: "option",
      "data-dial-code": "966",
      "data-country-code": "sa",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__sa"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Saudi Arabia (‫المملكة العربية السعودية‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+966")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-sn",
      role: "option",
      "data-dial-code": "221",
      "data-country-code": "sn",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__sn"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Senegal (Sénégal)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+221")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-rs",
      role: "option",
      "data-dial-code": "381",
      "data-country-code": "rs",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__rs"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Serbia (Србија)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+381")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-sc",
      role: "option",
      "data-dial-code": "248",
      "data-country-code": "sc",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__sc"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Seychelles")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+248")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-sl",
      role: "option",
      "data-dial-code": "232",
      "data-country-code": "sl",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__sl"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Sierra Leone")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+232")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-sg",
      role: "option",
      "data-dial-code": "65",
      "data-country-code": "sg",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__sg"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Singapore")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+65")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-sx",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "sx",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__sx"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Sint Maarten")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-sk",
      role: "option",
      "data-dial-code": "421",
      "data-country-code": "sk",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__sk"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Slovakia (Slovensko)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+421")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-si",
      role: "option",
      "data-dial-code": "386",
      "data-country-code": "si",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__si"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Slovenia (Slovenija)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+386")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-sb",
      role: "option",
      "data-dial-code": "677",
      "data-country-code": "sb",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__sb"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Solomon Islands")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+677")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-so",
      role: "option",
      "data-dial-code": "252",
      "data-country-code": "so",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__so"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Somalia (Soomaaliya)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+252")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-za",
      role: "option",
      "data-dial-code": "27",
      "data-country-code": "za",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__za"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("South Africa")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+27")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-kr",
      role: "option",
      "data-dial-code": "82",
      "data-country-code": "kr",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__kr"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("South Korea (대한민국)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+82")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ss",
      role: "option",
      "data-dial-code": "211",
      "data-country-code": "ss",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ss"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("South Sudan (‫جنوب السودان‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+211")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-es",
      role: "option",
      "data-dial-code": "34",
      "data-country-code": "es",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__es"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Spain (España)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+34")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-lk",
      role: "option",
      "data-dial-code": "94",
      "data-country-code": "lk",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__lk"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Sri Lanka (ශ්‍රී ලංකාව)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+94")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-sd",
      role: "option",
      "data-dial-code": "249",
      "data-country-code": "sd",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__sd"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Sudan (‫السودان‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+249")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-sr",
      role: "option",
      "data-dial-code": "597",
      "data-country-code": "sr",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__sr"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Suriname")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+597")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-sj",
      role: "option",
      "data-dial-code": "47",
      "data-country-code": "sj",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__sj"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Svalbard and Jan Mayen")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+47")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-se",
      role: "option",
      "data-dial-code": "46",
      "data-country-code": "se",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__se"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Sweden (Sverige)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+46")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ch",
      role: "option",
      "data-dial-code": "41",
      "data-country-code": "ch",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ch"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Switzerland (Schweiz)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+41")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-sy",
      role: "option",
      "data-dial-code": "963",
      "data-country-code": "sy",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__sy"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Syria (‫سوريا‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+963")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-tw",
      role: "option",
      "data-dial-code": "886",
      "data-country-code": "tw",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__tw"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Taiwan (台灣)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+886")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-tj",
      role: "option",
      "data-dial-code": "992",
      "data-country-code": "tj",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__tj"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Tajikistan")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+992")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-tz",
      role: "option",
      "data-dial-code": "255",
      "data-country-code": "tz",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__tz"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Tanzania")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+255")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-th",
      role: "option",
      "data-dial-code": "66",
      "data-country-code": "th",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__th"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Thailand (ไทย)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+66")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-tl",
      role: "option",
      "data-dial-code": "670",
      "data-country-code": "tl",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__tl"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Timor-Leste")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+670")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-tg",
      role: "option",
      "data-dial-code": "228",
      "data-country-code": "tg",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__tg"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Togo")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+228")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-tk",
      role: "option",
      "data-dial-code": "690",
      "data-country-code": "tk",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__tk"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Tokelau")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+690")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-to",
      role: "option",
      "data-dial-code": "676",
      "data-country-code": "to",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__to"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Tonga")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+676")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-tt",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "tt",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__tt"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Trinidad and Tobago")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-tn",
      role: "option",
      "data-dial-code": "216",
      "data-country-code": "tn",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__tn"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Tunisia (‫تونس‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+216")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-tr",
      role: "option",
      "data-dial-code": "90",
      "data-country-code": "tr",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__tr"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Turkey (Türkiye)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+90")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-tm",
      role: "option",
      "data-dial-code": "993",
      "data-country-code": "tm",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__tm"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Turkmenistan")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+993")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-tc",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "tc",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__tc"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Turks and Caicos Islands")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-tv",
      role: "option",
      "data-dial-code": "688",
      "data-country-code": "tv",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__tv"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Tuvalu")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+688")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-vi",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "vi",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__vi"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("U.S. Virgin Islands")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ug",
      role: "option",
      "data-dial-code": "256",
      "data-country-code": "ug",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ug"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Uganda")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+256")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ua",
      role: "option",
      "data-dial-code": "380",
      "data-country-code": "ua",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ua"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Ukraine (Україна)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+380")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ae",
      role: "option",
      "data-dial-code": "971",
      "data-country-code": "ae",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ae"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("United Arab Emirates (‫الإمارات العربية المتحدة‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+971")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-gb",
      role: "option",
      "data-dial-code": "44",
      "data-country-code": "gb",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__gb"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("United Kingdom")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+44")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-us",
      role: "option",
      "data-dial-code": "1",
      "data-country-code": "us",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__us"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("United States")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+1")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-uy",
      role: "option",
      "data-dial-code": "598",
      "data-country-code": "uy",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__uy"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Uruguay")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+598")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-uz",
      role: "option",
      "data-dial-code": "998",
      "data-country-code": "uz",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__uz"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Uzbekistan (Oʻzbekiston)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+998")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-vu",
      role: "option",
      "data-dial-code": "678",
      "data-country-code": "vu",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__vu"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Vanuatu")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+678")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-va",
      role: "option",
      "data-dial-code": "39",
      "data-country-code": "va",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__va"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Vatican City (Città del Vaticano)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+39")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ve",
      role: "option",
      "data-dial-code": "58",
      "data-country-code": "ve",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ve"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Venezuela")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+58")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-vn",
      role: "option",
      "data-dial-code": "84",
      "data-country-code": "vn",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__vn"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Vietnam (Việt Nam)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+84")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-wf",
      role: "option",
      "data-dial-code": "681",
      "data-country-code": "wf",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__wf"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Wallis and Futuna (Wallis-et-Futuna)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+681")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-eh",
      role: "option",
      "data-dial-code": "212",
      "data-country-code": "eh",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__eh"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Western Sahara (‫الصحراء الغربية‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+212")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ye",
      role: "option",
      "data-dial-code": "967",
      "data-country-code": "ye",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ye"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Yemen (‫اليمن‬‎)")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+967")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-zm",
      role: "option",
      "data-dial-code": "260",
      "data-country-code": "zm",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__zm"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Zambia")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+260")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-zw",
      role: "option",
      "data-dial-code": "263",
      "data-country-code": "zw",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__zw"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Zimbabwe")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+263")])]), _c("li", {
    staticClass: "iti__country iti__standard",
    attrs: {
      tabindex: "-1",
      id: "iti-0__item-ax",
      role: "option",
      "data-dial-code": "358",
      "data-country-code": "ax",
      "aria-selected": "false"
    }
  }, [_c("div", {
    staticClass: "iti__flag-box"
  }, [_c("div", {
    staticClass: "iti__flag iti__ax"
  })]), _c("span", {
    staticClass: "iti__country-name"
  }, [_vm._v("Åland Islands")]), _c("span", {
    staticClass: "iti__dial-code"
  }, [_vm._v("+358")])])])]), _c("input", {
    staticClass: "form-control",
    staticStyle: {
      "padding-left": "85px"
    },
    attrs: {
      type: "tel",
      required: "",
      title: "Un teléfono de contacto es requerido",
      onkeyup: "validarPrimerDigito('telefono_movil')",
      name: "telefono_movil",
      id: "telefono_movil",
      "aria-describedby": "helpId",
      placeholder: "412-1234567",
      autocomplete: "off",
      "data-intl-tel-input-id": "0"
    }
  })]), _vm._v(" "), _c("small", {
    staticClass: "notification",
    attrs: {
      id: "help_telefono_movil"
    }
  }, [_vm._v("(preferiblemente\n                                        vinculado a\n                                        "), _c("i", {
    staticClass: "text-success"
  }, [_vm._v("Whatsapp")]), _vm._v(")")])])])]), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-6"
  }, [_c("div", {
    staticClass: "form-group box-cat_estado_id"
  }, [_c("label", {
    staticClass: "text-primary",
    attrs: {
      "for": "cat_estado_id"
    }
  }, [_vm._v("Estado")]), _c("br"), _vm._v(" "), _c("select", {
    staticClass: "form-control select2 select2-hidden-accessible",
    attrs: {
      required: "",
      title: "Un Estado es requerido",
      name: "cat_estado_id",
      id: "cat_estado_id",
      "aria-describedby": "helpId",
      placeholder: "",
      "data-select2-id": "select2-data-cat_estado_id",
      tabindex: "-1",
      "aria-hidden": "true"
    }
  }, [_c("option", {
    attrs: {
      value: "1"
    }
  }, [_vm._v("\n                        Amazonas\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "2"
    }
  }, [_vm._v("\n                        Anzoategui\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "3"
    }
  }, [_vm._v("\n                        Apure\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "4"
    }
  }, [_vm._v("\n                        Aragua\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "5"
    }
  }, [_vm._v("\n                        Barinas\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "6"
    }
  }, [_vm._v("\n                        Bolívar\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "7"
    }
  }, [_vm._v("\n                        Carabobo\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "8"
    }
  }, [_vm._v("\n                        Cojedes\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "9"
    }
  }, [_vm._v("\n                        Delta Amacuro\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "10"
    }
  }, [_vm._v("\n                        Falcón\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "11"
    }
  }, [_vm._v("\n                        Guárico\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "12"
    }
  }, [_vm._v("\n                        Lara\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "13"
    }
  }, [_vm._v("\n                        Mérida\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      selected: "",
      value: "14",
      "data-select2-id": "select2-data-2-zyvh"
    }
  }, [_vm._v("\n                        Miranda\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "15"
    }
  }, [_vm._v("\n                        Monagas\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "16"
    }
  }, [_vm._v("\n                        Nueva Esparta\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "17"
    }
  }, [_vm._v("\n                        Portuguesa\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "18"
    }
  }, [_vm._v("\n                        Sucre\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "19"
    }
  }, [_vm._v("\n                        Táchira\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "20"
    }
  }, [_vm._v("\n                        Trujillo\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "21"
    }
  }, [_vm._v("\n                        Yaracuy\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "22"
    }
  }, [_vm._v("\n                        Zulia\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "23"
    }
  }, [_vm._v("\n                        Dependencias Federales\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "24"
    }
  }, [_vm._v("\n                        Distrito Capital\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "25"
    }
  }, [_vm._v("\n                        La Guaira\n                    ")])]), _c("span", {
    staticClass: "select2 select2-container select2-container--default",
    staticStyle: {
      width: "555px"
    },
    attrs: {
      dir: "ltr",
      "data-select2-id": "select2-data-1-4ouv"
    }
  }, [_c("span", {
    staticClass: "selection"
  }, [_c("span", {
    staticClass: "select2-selection select2-selection--single",
    attrs: {
      role: "combobox",
      "aria-haspopup": "true",
      "aria-expanded": "false",
      title: "Un Estado es requerido",
      tabindex: "0",
      "aria-disabled": "false",
      "aria-labelledby": "select2-cat_estado_id-container",
      "aria-controls": "select2-cat_estado_id-container"
    }
  }, [_c("span", {
    staticClass: "select2-selection__rendered",
    attrs: {
      id: "select2-cat_estado_id-container",
      role: "textbox",
      "aria-readonly": "true",
      title: "\n                        Miranda\n                    "
    }
  }, [_vm._v("\n                        Miranda\n                    ")]), _c("span", {
    staticClass: "select2-selection__arrow",
    attrs: {
      role: "presentation"
    }
  }, [_c("b", {
    attrs: {
      role: "presentation"
    }
  })])])]), _c("span", {
    staticClass: "dropdown-wrapper",
    attrs: {
      "aria-hidden": "true"
    }
  })]), _vm._v(" "), _c("small", {
    staticClass: "notification",
    attrs: {
      id: "help_cat_estado_id"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-6"
  }, [_c("div", {
    staticClass: "form-group box-cat_municipio_id"
  }, [_c("label", {
    staticClass: "text-primary",
    attrs: {
      "for": "cat_municipio_id"
    }
  }, [_vm._v("Municipio")]), _c("br"), _vm._v(" "), _c("select", {
    staticClass: "form-control select2 select2-hidden-accessible",
    attrs: {
      required: "",
      title: "Un Municipio es requerido",
      name: "cat_municipio_id",
      id: "cat_municipio_id",
      "aria-describedby": "helpId",
      placeholder: "",
      "data-select2-id": "select2-data-cat_municipio_id",
      tabindex: "-1",
      "aria-hidden": "true"
    }
  }, [_c("option", {
    attrs: {
      value: "174"
    }
  }, [_vm._v("\n                        Acevedo\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "175"
    }
  }, [_vm._v("\n                        Andres Bello\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "176"
    }
  }, [_vm._v("\n                        Baruta\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "177"
    }
  }, [_vm._v("\n                        Brion\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "178"
    }
  }, [_vm._v("\n                        Buroz\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "179"
    }
  }, [_vm._v("\n                        Carrizal\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      selected: "",
      value: "180",
      "data-select2-id": "select2-data-4-kws8"
    }
  }, [_vm._v("\n                        Chacao\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "181"
    }
  }, [_vm._v("\n                        Cristobal Rojas\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "182"
    }
  }, [_vm._v("\n                        El Hatillo\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "183"
    }
  }, [_vm._v("\n                        Guaicaipuro\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "184"
    }
  }, [_vm._v("\n                        Independencia\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "185"
    }
  }, [_vm._v("\n                        Lander\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "186"
    }
  }, [_vm._v("\n                        Los Salias\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "187"
    }
  }, [_vm._v("\n                        Paez\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "188"
    }
  }, [_vm._v("\n                        Paz Castillo\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "189"
    }
  }, [_vm._v("\n                        Pedro Gual\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "190"
    }
  }, [_vm._v("\n                        Plaza\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "191"
    }
  }, [_vm._v("\n                        Simon Bolivar\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "192"
    }
  }, [_vm._v("\n                        Sucre\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "193"
    }
  }, [_vm._v("\n                        Urdaneta\n                    ")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "194"
    }
  }, [_vm._v("\n                        Zamora\n                    ")])]), _c("span", {
    staticClass: "select2 select2-container select2-container--default",
    staticStyle: {
      width: "555px"
    },
    attrs: {
      dir: "ltr",
      "data-select2-id": "select2-data-3-n0zq"
    }
  }, [_c("span", {
    staticClass: "selection"
  }, [_c("span", {
    staticClass: "select2-selection select2-selection--single",
    attrs: {
      role: "combobox",
      "aria-haspopup": "true",
      "aria-expanded": "false",
      title: "Un Municipio es requerido",
      tabindex: "0",
      "aria-disabled": "false",
      "aria-labelledby": "select2-cat_municipio_id-container",
      "aria-controls": "select2-cat_municipio_id-container"
    }
  }, [_c("span", {
    staticClass: "select2-selection__rendered",
    attrs: {
      id: "select2-cat_municipio_id-container",
      role: "textbox",
      "aria-readonly": "true",
      title: "\n                        Chacao\n                    "
    }
  }, [_vm._v("\n                        Chacao\n                    ")]), _c("span", {
    staticClass: "select2-selection__arrow",
    attrs: {
      role: "presentation"
    }
  }, [_c("b", {
    attrs: {
      role: "presentation"
    }
  })])])]), _c("span", {
    staticClass: "dropdown-wrapper",
    attrs: {
      "aria-hidden": "true"
    }
  })]), _vm._v(" "), _c("small", {
    staticClass: "notification",
    attrs: {
      id: "help_cat_municipio_id"
    }
  })])])]), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "text-primary",
    attrs: {
      "for": "description"
    }
  }, [_vm._v("Ciudad")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      required: "",
      title: "Una Ciudad es requerida",
      type: "text",
      name: "description",
      id: "description",
      "aria-describedby": "helpId",
      placeholder: ""
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "notification",
    attrs: {
      id: "help_description"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "text-primary",
    attrs: {
      "for": "domicilio"
    }
  }, [_vm._v("Domicilio")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      required: "",
      title: "Tu domicilio es requerido",
      name: "domicilio",
      id: "domicilio"
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "notification",
    attrs: {
      id: "help_domicilio"
    }
  })])])]), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "d-none col-6"
  }, [_c("label", {
    staticClass: "text-primary",
    attrs: {
      "for": "cedula"
    }
  }, [_vm._v("Foto de Tarjeta Soy CMDLT")]), _vm._v(" "), _c("div", {
    staticClass: "d-flex items-align-center"
  }, [_c("div", {
    staticClass: "fileImageInput"
  }, [_c("label", {
    staticClass: "heartbeat cursor-pointer",
    staticStyle: {
      display: "flex",
      "align-items": "center",
      border: "2px dashed rgb(190, 189, 189)",
      height: "100px",
      width: "100%"
    },
    attrs: {
      "for": "imgSoyChacao"
    }
  }, [_c("img", {
    staticStyle: {
      height: "100%",
      width: "inherit"
    },
    attrs: {
      onerror: "reemplaza_imagen(this)",
      id: "imgSoyChacaoPreview",
      src: "/image/system/card.svg",
      alt: "User Avatar"
    }
  })]), _vm._v(" "), _c("input", {
    staticStyle: {
      display: "none"
    },
    attrs: {
      id: "imgSoyChacao",
      name: "imgSoyChacao",
      type: "file",
      accept: "image/jpg, jpeg, bmp, png"
    }
  }), _vm._v(" "), _c("span", {
    staticClass: "filename"
  })])])]), _vm._v(" "), _c("div", {
    staticClass: "col-6"
  }, [_c("label", {
    staticClass: "text-primary",
    attrs: {
      "for": "cedula"
    }
  }, [_vm._v("Foto de Documento de Identidad")]), _vm._v(" "), _c("div", {
    staticClass: "d-flex items-align-center"
  }, [_c("div", {
    staticClass: "fileImageInput"
  }, [_c("label", {
    staticClass: "heartbeat cursor-pointer",
    staticStyle: {
      display: "flex",
      "align-items": "center",
      border: "2px dashed rgb(190, 189, 189)",
      height: "100px",
      width: "100%"
    },
    attrs: {
      "for": "imgDocIdentidad"
    }
  }, [_c("img", {
    staticStyle: {
      height: "100%",
      width: "inherit"
    },
    attrs: {
      onerror: "reemplaza_imagen(this)",
      id: "imgDocIdentidadPreview",
      src: "/image/system/card.svg",
      alt: "User Avatar"
    }
  })]), _vm._v(" "), _c("input", {
    staticStyle: {
      display: "none"
    },
    attrs: {
      id: "imgDocIdentidad",
      name: "imgDocIdentidad",
      type: "file",
      accept: "image/jpg, jpeg, bmp, png"
    }
  }), _vm._v(" "), _c("span", {
    staticClass: "filename"
  })])])])]), _vm._v(" "), _c("div", {
    staticClass: "row my-2 justify-content-center"
  }, [_c("div", {
    staticClass: "col-6"
  }, [_c("button", {
    staticClass: "btn btn-success btn-block",
    attrs: {
      id: "submit",
      type: "submit"
    }
  }, [_vm._v("Registrar")])])]), _vm._v(" "), _c("br"), _vm._v(" "), _c("br"), _vm._v(" "), _c("br")])])])])])]);
}];
render._withStripped = true;


/***/ }),

/***/ "./resources/js/components/ConsultaExterna/components/PacienteCreate.vue":
/*!*******************************************************************************!*\
  !*** ./resources/js/components/ConsultaExterna/components/PacienteCreate.vue ***!
  \*******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PacienteCreate_vue_vue_type_template_id_71770968_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PacienteCreate.vue?vue&type=template&id=71770968&scoped=true& */ "./resources/js/components/ConsultaExterna/components/PacienteCreate.vue?vue&type=template&id=71770968&scoped=true&");
/* harmony import */ var _PacienteCreate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PacienteCreate.vue?vue&type=script&lang=js& */ "./resources/js/components/ConsultaExterna/components/PacienteCreate.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _PacienteCreate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _PacienteCreate_vue_vue_type_template_id_71770968_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _PacienteCreate_vue_vue_type_template_id_71770968_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "71770968",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/ConsultaExterna/components/PacienteCreate.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/ConsultaExterna/components/PacienteCreate.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************!*\
  !*** ./resources/js/components/ConsultaExterna/components/PacienteCreate.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PacienteCreate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./PacienteCreate.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ConsultaExterna/components/PacienteCreate.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PacienteCreate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/ConsultaExterna/components/PacienteCreate.vue?vue&type=template&id=71770968&scoped=true&":
/*!**************************************************************************************************************************!*\
  !*** ./resources/js/components/ConsultaExterna/components/PacienteCreate.vue?vue&type=template&id=71770968&scoped=true& ***!
  \**************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_PacienteCreate_vue_vue_type_template_id_71770968_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../../node_modules/vue-loader/lib??vue-loader-options!./PacienteCreate.vue?vue&type=template&id=71770968&scoped=true& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ConsultaExterna/components/PacienteCreate.vue?vue&type=template&id=71770968&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_PacienteCreate_vue_vue_type_template_id_71770968_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_PacienteCreate_vue_vue_type_template_id_71770968_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);