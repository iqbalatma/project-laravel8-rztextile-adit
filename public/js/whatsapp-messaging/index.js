/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************************************!*\
  !*** ./resources/js/application/whatsapp-messaging/index.js ***!
  \**************************************************************/
$(document).ready(function () {
  function escape(htmlStr) {
    return htmlStr.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#39;");
  }
  $("#promotion").on("change", function () {
    var promotionId = $(this).val();
    $.ajax({
      method: "GET",
      url: "/ajax/promotion-messages/".concat(promotionId)
    }).done(function (response) {
      $("#message").html(response.data.message);
      $("#message-input").val(response.data.message);
    }).fail();
  });
});
/******/ })()
;