/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************************!*\
  !*** ./resources/js/application/customers/index.js ***!
  \*****************************************************/
$(document).ready(function () {
  $(".btn-delete").on("click", function () {
    var form = $(this).closest("form");
    Swal.fire({
      title: 'Are you sure want to delete the unit ?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then(function (result) {
      if (result.isConfirmed) {
        form.submit();
      }
    });
  });
});
/******/ })()
;