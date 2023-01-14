/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************************!*\
  !*** ./resources/js/application/rolls/index.js ***!
  \*************************************************/
$(document).ready(function () {
  $(".btn-print-qrcode").on("click", function () {
    var id = $(this).data("id");
    var qrcodeImage = $(this).data("qrcode-image");
    var name = $(this).data("name");
    var code = $(this).data("code");
    var qrcode = $(this).data("qrcode");
    $("#qrcode-image-modal").attr("src", "storage/images/qrcode/".concat(qrcodeImage));
    $("#roll-id-modal").val(id);
    $("#roll-name-modal").text(name);
    $("#roll-code-modal").text(code);
    $("#roll-qrcode-modal").text(qrcode);
    $("#roll-qrcode-filename-modal").text(qrcodeImage);
  });
});
/******/ })()
;