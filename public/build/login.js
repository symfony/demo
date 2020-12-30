(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["login"],{

/***/ "./assets/js/login.js":
/*!****************************!*\
  !*** ./assets/js/login.js ***!
  \****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {$(function () {
  var usernameEl = $('#username');
  var passwordEl = $('#password'); // in a real application, the user/password should never be hardcoded
  // but for the demo application it's very convenient to do so

  if (!usernameEl.val() || 'jane_admin' === usernameEl.val()) {
    usernameEl.val('jane_admin');
    passwordEl.val('kitten');
  }
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ })

},[["./assets/js/login.js","runtime","vendors~admin~app~login~search"]]]);