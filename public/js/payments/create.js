/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************************!*\
  !*** ./resources/js/application/payments/create.js ***!
  \*****************************************************/
$(document).ready(function () {
  console.log("TES");
  $("#invoice").on("change", function () {
    console.log("change triggered");
    var billLeft = $(this).find(':selected').data('bill-left');
    $("#bill_left").val(billLeft);
  });
});
/******/ })()
;