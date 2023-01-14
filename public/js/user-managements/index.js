/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************************!*\
  !*** ./resources/js/application/user-managements/index.js ***!
  \************************************************************/
$(".btn-delete").on("click", function (event) {
  event.preventDefault();
  var form = $(this).closest("form");
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then(function (result) {
    if (result.isConfirmed) {
      form.trigger("submit");
      event.Swal.fire("Deleted!", "Your file has been deleted.", "success");
    }
  });
});
/******/ })()
;