/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/module/helper.js":
/*!***************************************!*\
  !*** ./resources/js/module/helper.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  formatIntToRupiah: function formatIntToRupiah(number) {
    return "Rp " + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ",00";
  },
  formatRupiahToInt: function formatRupiahToInt(rupiah) {
    var rupiahInt = rupiah.split(" ");
    rupiahInt = rupiahInt[1];
    rupiahInt = rupiahInt.replaceAll(".", "");
    rupiahInt = rupiahInt.split(" ")[0];
    rupiahInt = parseInt(rupiahInt);
    return rupiahInt;
  },
  preventEnter: function preventEnter(context, event) {
    if (event.key == "Enter") {
      event.preventDefault();
      $(context).blur();
    }
  },
  prenvetNonNumeric: function prenvetNonNumeric(event) {
    if (event.which < 48 || event.which > 57) {
      event.preventDefault();
    }
  },
  preventTab: function preventTab(context, event) {
    if (event.which == 9) {
      event.preventDefault();
      $(context).next().focus();
    }
  }
});

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!*******************************************************!*\
  !*** ./resources/js/application/search-roll/index.js ***!
  \*******************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _module_helper__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../module/helper */ "./resources/js/module/helper.js");

$(document).ready(function () {
  /**
   * Description : selectize option configuration
   */
  var selectizeOption = {
    create: false,
    sortField: "text",
    openOnFocus: false,
    render: {
      option: function option(data, escape) {
        return "<div class=\"item-roll-selectized\"\n                        data-id=\"".concat(escape(data.data.id), "\"\n                        data-data=\"").concat(escape(JSON.stringify(data.data)), "\">\n                        ").concat(escape(data.text), "\n                    </div>");
      }
    },
    onChange: function onChange(value) {
      onChangeSelectize(value);
    }
  };
  /**
  * Description : use to clear and always focus on selectize
  * 
  * @param {object} selectized initialize of selectize
  */
  function selectizedFocusAndClear(selectized) {
    selectized = selectized[0].selectize;
    selectized.focus();
    selectized.off();
    selectized.clear();
    selectized.on("change", function (value) {
      onChangeSelectize(value);
    });
  }
  var selectized = $("#select-roll").selectize(selectizeOption);
  selectizedFocusAndClear(selectized);

  /**
   * Description : function that will execute on change selectize
   * 
   * @param {int} value 
   */
  function onChangeSelectize(value) {
    var rollId = value;
    var dataSet = $(".item-roll-selectized[data-id=\"".concat(rollId, "\"]")).data("data");
    selectizedFocusAndClear(selectized);
    $.ajax({
      url: "/ajax/search-roll/" + rollId,
      context: document.body,
      method: "GET"
    }).done(function (response) {
      if (response.status == 200) {
        console.log(response);
        console.log(response.data.created_at);
        var data = response.data;
        $("#roll-name").text(data.name);
        $("#roll-code").text(data.code);
        $("#roll-quantity-roll").text(data.quantity_roll);
        $("#roll-quantity-unit").text(data.quantity_unit + " " + data.unit.name);
        $("#roll-qrcode").text(data.qrcode);
        $("#roll-basic-price").text(_module_helper__WEBPACK_IMPORTED_MODULE_0__["default"].formatIntToRupiah(data.basic_price));
        $("#roll-selling-price").text(_module_helper__WEBPACK_IMPORTED_MODULE_0__["default"].formatIntToRupiah(data.selling_price));
        $("#roll-last-update").text(data.updated_at);
        var timerInterval;
        return Swal.fire({
          title: 'Roll found !',
          text: "Search roll ".concat(data.name, " successfully !"),
          timer: 1500,
          icon: "success"
        });
      }
    }).fail(function (response) {
      console.log(response);
    });
  }
});
})();

/******/ })()
;