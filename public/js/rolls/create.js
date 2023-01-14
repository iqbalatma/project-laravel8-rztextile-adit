/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************************!*\
  !*** ./resources/js/application/rolls/create.js ***!
  \**************************************************/
$(document).ready(function () {
  function getGeneratedRollCode(name) {
    name = name.replace(/\s+/g, '-').replace(/[aeiou]/gi, "").toLowerCase();
    return name;
  }
  $("#name").on("keyup", function () {
    var name = $(this).val();
    name = getGeneratedRollCode(name);
    $("#code").val(name);
  });
});
/******/ })()
;