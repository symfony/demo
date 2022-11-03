(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.(j%7Ct)sx?$":
/*!*******************************************************************************************************************!*\
  !*** ./assets/controllers/ sync ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \.(j%7Ct)sx?$ ***!
  \*******************************************************************************************************************/
/***/ ((module) => {

function webpackEmptyContext(req) {
	var e = new Error("Cannot find module '" + req + "'");
	e.code = 'MODULE_NOT_FOUND';
	throw e;
}
webpackEmptyContext.keys = () => ([]);
webpackEmptyContext.resolve = webpackEmptyContext;
webpackEmptyContext.id = "./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.(j%7Ct)sx?$";
module.exports = webpackEmptyContext;

/***/ }),

/***/ "./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js!./assets/controllers.json":
/*!************************************************************************************************!*\
  !*** ./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js!./assets/controllers.json ***!
  \************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
});

/***/ }),

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _styles_app_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./styles/app.scss */ "./assets/styles/app.scss");
/* harmony import */ var bootstrap_sass_assets_javascripts_bootstrap_transition_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! bootstrap-sass/assets/javascripts/bootstrap/transition.js */ "./node_modules/bootstrap-sass/assets/javascripts/bootstrap/transition.js");
/* harmony import */ var bootstrap_sass_assets_javascripts_bootstrap_transition_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(bootstrap_sass_assets_javascripts_bootstrap_transition_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var bootstrap_sass_assets_javascripts_bootstrap_alert_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! bootstrap-sass/assets/javascripts/bootstrap/alert.js */ "./node_modules/bootstrap-sass/assets/javascripts/bootstrap/alert.js");
/* harmony import */ var bootstrap_sass_assets_javascripts_bootstrap_alert_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(bootstrap_sass_assets_javascripts_bootstrap_alert_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var bootstrap_sass_assets_javascripts_bootstrap_collapse_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! bootstrap-sass/assets/javascripts/bootstrap/collapse.js */ "./node_modules/bootstrap-sass/assets/javascripts/bootstrap/collapse.js");
/* harmony import */ var bootstrap_sass_assets_javascripts_bootstrap_collapse_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(bootstrap_sass_assets_javascripts_bootstrap_collapse_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var bootstrap_sass_assets_javascripts_bootstrap_dropdown_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! bootstrap-sass/assets/javascripts/bootstrap/dropdown.js */ "./node_modules/bootstrap-sass/assets/javascripts/bootstrap/dropdown.js");
/* harmony import */ var bootstrap_sass_assets_javascripts_bootstrap_dropdown_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(bootstrap_sass_assets_javascripts_bootstrap_dropdown_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var bootstrap_sass_assets_javascripts_bootstrap_modal_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! bootstrap-sass/assets/javascripts/bootstrap/modal.js */ "./node_modules/bootstrap-sass/assets/javascripts/bootstrap/modal.js");
/* harmony import */ var bootstrap_sass_assets_javascripts_bootstrap_modal_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(bootstrap_sass_assets_javascripts_bootstrap_modal_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var _js_highlight_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./js/highlight.js */ "./assets/js/highlight.js");
/* harmony import */ var _js_doclinks_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./js/doclinks.js */ "./assets/js/doclinks.js");
/* harmony import */ var _js_doclinks_js__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(_js_doclinks_js__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var _bootstrap__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./bootstrap */ "./assets/bootstrap.js");
 // loads the Bootstrap jQuery plugins






 // loads the code syntax highlighting library

 // Creates links to the Symfony documentation

 // start the Stimulus application



/***/ }),

/***/ "./assets/bootstrap.js":
/*!*****************************!*\
  !*** ./assets/bootstrap.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "app": () => (/* binding */ app)
/* harmony export */ });
/* harmony import */ var _symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @symfony/stimulus-bridge */ "./node_modules/@symfony/stimulus-bridge/dist/index.js");
 // Registers Stimulus controllers from controllers.json and in the controllers/ directory

var app = (0,_symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_0__.startStimulusApp)(__webpack_require__("./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.(j%7Ct)sx?$")); // register any custom, 3rd party controllers here
// app.register('some_controller_name', SomeImportedController);

/***/ }),

/***/ "./assets/js/doclinks.js":
/*!*******************************!*\
  !*** ./assets/js/doclinks.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

"use strict";
/* provided dependency */ var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
 // Wraps some elements in anchor tags referencing to the Symfony documentation

__webpack_require__(/*! core-js/modules/es.array.find.js */ "./node_modules/core-js/modules/es.array.find.js");

__webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");

__webpack_require__(/*! core-js/modules/es.regexp.exec.js */ "./node_modules/core-js/modules/es.regexp.exec.js");

__webpack_require__(/*! core-js/modules/es.string.replace.js */ "./node_modules/core-js/modules/es.string.replace.js");

__webpack_require__(/*! core-js/modules/es.regexp.constructor.js */ "./node_modules/core-js/modules/es.regexp.constructor.js");

__webpack_require__(/*! core-js/modules/es.regexp.to-string.js */ "./node_modules/core-js/modules/es.regexp.to-string.js");

__webpack_require__(/*! core-js/modules/es.array.join.js */ "./node_modules/core-js/modules/es.array.join.js");

__webpack_require__(/*! core-js/modules/es.object.keys.js */ "./node_modules/core-js/modules/es.object.keys.js");

__webpack_require__(/*! core-js/modules/es.string.match.js */ "./node_modules/core-js/modules/es.string.match.js");

$(function () {
  var $modal = $('#sourceCodeModal');
  var $controllerCode = $modal.find('code.php');
  var $templateCode = $modal.find('code.twig');

  function anchor(url, content) {
    return '<a class="doclink" target="_blank" href="' + url + '">' + content + '</a>';
  }

  ;

  function wrap(content, links) {
    return content.replace(new RegExp(Object.keys(links).join('|'), 'g'), function (token) {
      return anchor(links[token], token);
    });
  }

  ; // Wraps links to the Symfony documentation

  $modal.find('.hljs-comment').each(function () {
    $(this).html($(this).html().replace(/https:\/\/symfony.com\/doc\/[\w/.#-]+/g, function (url) {
      return anchor(url, url);
    }));
  }); // Wraps Symfony's attributes

  var attributes = {
    'Cache': 'https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/cache.html',
    'IsGranted': 'https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/security.html#isgranted',
    'ParamConverter': 'https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html',
    'Route': 'https://symfony.com/doc/current/routing.html#creating-routes-as-attributes-or-annotations',
    'Security': 'https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/security.html#security'
  };
  $controllerCode.find('.hljs-meta').each(function () {
    var src = $(this).text();
    $(this).html(wrap(src, attributes));
  }); // Wraps Twig's tags

  $templateCode.find('.hljs-template-tag + .hljs-name').each(function () {
    var tag = $(this).text();

    if ('else' === tag || tag.match(/^end/)) {
      return;
    }

    var url = 'https://twig.symfony.com/doc/3.x/tags/' + tag + '.html#' + tag;
    $(this).html(anchor(url, tag));
  }); // Wraps Twig's functions

  $templateCode.find('.hljs-template-variable > .hljs-name').each(function () {
    var func = $(this).text();
    var url = 'https://twig.symfony.com/doc/3.x/functions/' + func + '.html#' + func;
    $(this).html(anchor(url, func));
  });
});

/***/ }),

/***/ "./assets/js/highlight.js":
/*!********************************!*\
  !*** ./assets/js/highlight.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var highlight_js_lib_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! highlight.js/lib/core */ "./node_modules/highlight.js/es/core.js");
/* harmony import */ var highlight_js_lib_languages_php__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! highlight.js/lib/languages/php */ "./node_modules/highlight.js/es/languages/php.js");
/* harmony import */ var highlight_js_lib_languages_twig__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! highlight.js/lib/languages/twig */ "./node_modules/highlight.js/es/languages/twig.js");



highlight_js_lib_core__WEBPACK_IMPORTED_MODULE_0__["default"].registerLanguage('php', highlight_js_lib_languages_php__WEBPACK_IMPORTED_MODULE_1__["default"]);
highlight_js_lib_core__WEBPACK_IMPORTED_MODULE_0__["default"].registerLanguage('twig', highlight_js_lib_languages_twig__WEBPACK_IMPORTED_MODULE_2__["default"]);
highlight_js_lib_core__WEBPACK_IMPORTED_MODULE_0__["default"].highlightAll();

/***/ }),

/***/ "./assets/styles/app.scss":
/*!********************************!*\
  !*** ./assets/styles/app.scss ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_jquery_dist_jquery_js","vendors-node_modules_core-js_internals_add-to-unscopables_js-node_modules_core-js_internals_a-dd2802","vendors-node_modules_core-js_internals_object-set-prototype-of_js-node_modules_core-js_module-345aa2","vendors-node_modules_symfony_stimulus-bridge_dist_index_js-node_modules_bootstrap-sass_assets-04d151"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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LENBQUNDLEdBQUQsRUFBTWUsR0FBTixDQUFuQjtFQUNILENBVkQsRUF2Q1MsQ0FtRFQ7O0VBQ0FqQixhQUFhLENBQUNELElBQWQsQ0FBbUIsc0NBQW5CLEVBQTJEYSxJQUEzRCxDQUFnRSxZQUFXO0lBQ3ZFLElBQUlPLElBQUksR0FBR3ZCLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUW9CLElBQVIsRUFBWDtJQUVBLElBQUlkLEdBQUcsR0FBRyxnREFBZ0RpQixJQUFoRCxHQUF1RCxRQUF2RCxHQUFrRUEsSUFBNUU7SUFFQXZCLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUWlCLElBQVIsQ0FBYVosTUFBTSxDQUFDQyxHQUFELEVBQU1pQixJQUFOLENBQW5CO0VBQ0gsQ0FORDtBQU9ILENBM0RBLENBQUQ7Ozs7Ozs7Ozs7Ozs7OztBQ0hBO0FBQ0E7QUFDQTtBQUVBQyw4RUFBQSxDQUFzQixLQUF0QixFQUE2QkMsc0VBQTdCO0FBQ0FELDhFQUFBLENBQXNCLE1BQXRCLEVBQThCRSx1RUFBOUI7QUFFQUYsMEVBQUE7Ozs7Ozs7Ozs7OztBQ1BBIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLyBcXC4oaiU3Q3Qpc3giLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2NvbnRyb2xsZXJzLmpzb24iLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2FwcC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvYm9vdHN0cmFwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9kb2NsaW5rcy5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvaGlnaGxpZ2h0LmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9zdHlsZXMvYXBwLnNjc3MiXSwic291cmNlc0NvbnRlbnQiOlsiZnVuY3Rpb24gd2VicGFja0VtcHR5Q29udGV4dChyZXEpIHtcblx0dmFyIGUgPSBuZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiICsgcmVxICsgXCInXCIpO1xuXHRlLmNvZGUgPSAnTU9EVUxFX05PVF9GT1VORCc7XG5cdHRocm93IGU7XG59XG53ZWJwYWNrRW1wdHlDb250ZXh0LmtleXMgPSAoKSA9PiAoW10pO1xud2VicGFja0VtcHR5Q29udGV4dC5yZXNvbHZlID0gd2VicGFja0VtcHR5Q29udGV4dDtcbndlYnBhY2tFbXB0eUNvbnRleHQuaWQgPSBcIi4vYXNzZXRzL2NvbnRyb2xsZXJzIHN5bmMgcmVjdXJzaXZlIC4vbm9kZV9tb2R1bGVzL0BzeW1mb255L3N0aW11bHVzLWJyaWRnZS9sYXp5LWNvbnRyb2xsZXItbG9hZGVyLmpzISBcXFxcLihqJTdDdClzeD8kXCI7XG5tb2R1bGUuZXhwb3J0cyA9IHdlYnBhY2tFbXB0eUNvbnRleHQ7IiwiZXhwb3J0IGRlZmF1bHQge1xufTsiLCJpbXBvcnQgJy4vc3R5bGVzL2FwcC5zY3NzJztcclxuXHJcbi8vIGxvYWRzIHRoZSBCb290c3RyYXAgalF1ZXJ5IHBsdWdpbnNcclxuaW1wb3J0ICdib290c3RyYXAtc2Fzcy9hc3NldHMvamF2YXNjcmlwdHMvYm9vdHN0cmFwL3RyYW5zaXRpb24uanMnO1xyXG5pbXBvcnQgJ2Jvb3RzdHJhcC1zYXNzL2Fzc2V0cy9qYXZhc2NyaXB0cy9ib290c3RyYXAvYWxlcnQuanMnO1xyXG5pbXBvcnQgJ2Jvb3RzdHJhcC1zYXNzL2Fzc2V0cy9qYXZhc2NyaXB0cy9ib290c3RyYXAvY29sbGFwc2UuanMnO1xyXG5pbXBvcnQgJ2Jvb3RzdHJhcC1zYXNzL2Fzc2V0cy9qYXZhc2NyaXB0cy9ib290c3RyYXAvZHJvcGRvd24uanMnO1xyXG5pbXBvcnQgJ2Jvb3RzdHJhcC1zYXNzL2Fzc2V0cy9qYXZhc2NyaXB0cy9ib290c3RyYXAvbW9kYWwuanMnO1xyXG5pbXBvcnQgJ2pxdWVyeSdcclxuXHJcbi8vIGxvYWRzIHRoZSBjb2RlIHN5bnRheCBoaWdobGlnaHRpbmcgbGlicmFyeVxyXG5pbXBvcnQgJy4vanMvaGlnaGxpZ2h0LmpzJztcclxuXHJcbi8vIENyZWF0ZXMgbGlua3MgdG8gdGhlIFN5bWZvbnkgZG9jdW1lbnRhdGlvblxyXG5pbXBvcnQgJy4vanMvZG9jbGlua3MuanMnO1xyXG5cclxuLy8gc3RhcnQgdGhlIFN0aW11bHVzIGFwcGxpY2F0aW9uXHJcbmltcG9ydCAnLi9ib290c3RyYXAnO1xyXG4iLCJpbXBvcnQgeyBzdGFydFN0aW11bHVzQXBwIH0gZnJvbSAnQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlJztcclxuXHJcbi8vIFJlZ2lzdGVycyBTdGltdWx1cyBjb250cm9sbGVycyBmcm9tIGNvbnRyb2xsZXJzLmpzb24gYW5kIGluIHRoZSBjb250cm9sbGVycy8gZGlyZWN0b3J5XHJcbmV4cG9ydCBjb25zdCBhcHAgPSBzdGFydFN0aW11bHVzQXBwKHJlcXVpcmUuY29udGV4dChcclxuICAgICdAc3ltZm9ueS9zdGltdWx1cy1icmlkZ2UvbGF6eS1jb250cm9sbGVyLWxvYWRlciEuL2NvbnRyb2xsZXJzJyxcclxuICAgIHRydWUsXHJcbiAgICAvXFwuKGp8dClzeD8kL1xyXG4pKTtcclxuXHJcbi8vIHJlZ2lzdGVyIGFueSBjdXN0b20sIDNyZCBwYXJ0eSBjb250cm9sbGVycyBoZXJlXHJcbi8vIGFwcC5yZWdpc3Rlcignc29tZV9jb250cm9sbGVyX25hbWUnLCBTb21lSW1wb3J0ZWRDb250cm9sbGVyKTtcclxuIiwiJ3VzZSBzdHJpY3QnO1xyXG5cclxuLy8gV3JhcHMgc29tZSBlbGVtZW50cyBpbiBhbmNob3IgdGFncyByZWZlcmVuY2luZyB0byB0aGUgU3ltZm9ueSBkb2N1bWVudGF0aW9uXHJcbiQoZnVuY3Rpb24oKSB7XHJcbiAgICB2YXIgJG1vZGFsID0gJCgnI3NvdXJjZUNvZGVNb2RhbCcpO1xyXG4gICAgdmFyICRjb250cm9sbGVyQ29kZSA9ICRtb2RhbC5maW5kKCdjb2RlLnBocCcpO1xyXG4gICAgdmFyICR0ZW1wbGF0ZUNvZGUgPSAkbW9kYWwuZmluZCgnY29kZS50d2lnJyk7XHJcblxyXG4gICAgZnVuY3Rpb24gYW5jaG9yKHVybCwgY29udGVudCkge1xyXG4gICAgICAgIHJldHVybiAnPGEgY2xhc3M9XCJkb2NsaW5rXCIgdGFyZ2V0PVwiX2JsYW5rXCIgaHJlZj1cIicgKyB1cmwgKyAnXCI+JyArIGNvbnRlbnQgKyAnPC9hPic7XHJcbiAgICB9O1xyXG5cclxuICAgIGZ1bmN0aW9uIHdyYXAoY29udGVudCwgbGlua3MpIHtcclxuICAgICAgICByZXR1cm4gY29udGVudC5yZXBsYWNlKFxyXG4gICAgICAgICAgICBuZXcgUmVnRXhwKE9iamVjdC5rZXlzKGxpbmtzKS5qb2luKCd8JyksICdnJyksXHJcbiAgICAgICAgICAgIHRva2VuID0+IGFuY2hvcihsaW5rc1t0b2tlbl0sIHRva2VuKVxyXG4gICAgICAgICk7XHJcbiAgICB9O1xyXG5cclxuICAgIC8vIFdyYXBzIGxpbmtzIHRvIHRoZSBTeW1mb255IGRvY3VtZW50YXRpb25cclxuICAgICRtb2RhbC5maW5kKCcuaGxqcy1jb21tZW50JykuZWFjaChmdW5jdGlvbigpIHtcclxuICAgICAgICAkKHRoaXMpLmh0bWwoJCh0aGlzKS5odG1sKCkucmVwbGFjZSgvaHR0cHM6XFwvXFwvc3ltZm9ueS5jb21cXC9kb2NcXC9bXFx3Ly4jLV0rL2csIGZ1bmN0aW9uKHVybCkge1xyXG4gICAgICAgICAgICByZXR1cm4gYW5jaG9yKHVybCwgdXJsKTtcclxuICAgICAgICB9KSk7XHJcbiAgICB9KTtcclxuXHJcbiAgICAvLyBXcmFwcyBTeW1mb255J3MgYXR0cmlidXRlc1xyXG4gICAgdmFyIGF0dHJpYnV0ZXMgPSB7XHJcbiAgICAgICAgJ0NhY2hlJzogJ2h0dHBzOi8vc3ltZm9ueS5jb20vZG9jL2N1cnJlbnQvYnVuZGxlcy9TZW5zaW9GcmFtZXdvcmtFeHRyYUJ1bmRsZS9hbm5vdGF0aW9ucy9jYWNoZS5odG1sJyxcclxuICAgICAgICAnSXNHcmFudGVkJzogJ2h0dHBzOi8vc3ltZm9ueS5jb20vZG9jL2N1cnJlbnQvYnVuZGxlcy9TZW5zaW9GcmFtZXdvcmtFeHRyYUJ1bmRsZS9hbm5vdGF0aW9ucy9zZWN1cml0eS5odG1sI2lzZ3JhbnRlZCcsXHJcbiAgICAgICAgJ1BhcmFtQ29udmVydGVyJzogJ2h0dHBzOi8vc3ltZm9ueS5jb20vZG9jL2N1cnJlbnQvYnVuZGxlcy9TZW5zaW9GcmFtZXdvcmtFeHRyYUJ1bmRsZS9hbm5vdGF0aW9ucy9jb252ZXJ0ZXJzLmh0bWwnLFxyXG4gICAgICAgICdSb3V0ZSc6ICdodHRwczovL3N5bWZvbnkuY29tL2RvYy9jdXJyZW50L3JvdXRpbmcuaHRtbCNjcmVhdGluZy1yb3V0ZXMtYXMtYXR0cmlidXRlcy1vci1hbm5vdGF0aW9ucycsXHJcbiAgICAgICAgJ1NlY3VyaXR5JzogJ2h0dHBzOi8vc3ltZm9ueS5jb20vZG9jL2N1cnJlbnQvYnVuZGxlcy9TZW5zaW9GcmFtZXdvcmtFeHRyYUJ1bmRsZS9hbm5vdGF0aW9ucy9zZWN1cml0eS5odG1sI3NlY3VyaXR5J1xyXG4gICAgfTtcclxuXHJcbiAgICAkY29udHJvbGxlckNvZGUuZmluZCgnLmhsanMtbWV0YScpLmVhY2goZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgdmFyIHNyYyA9ICQodGhpcykudGV4dCgpO1xyXG5cclxuICAgICAgICAkKHRoaXMpLmh0bWwod3JhcChzcmMsIGF0dHJpYnV0ZXMpKTtcclxuICAgIH0pO1xyXG5cclxuICAgIC8vIFdyYXBzIFR3aWcncyB0YWdzXHJcbiAgICAkdGVtcGxhdGVDb2RlLmZpbmQoJy5obGpzLXRlbXBsYXRlLXRhZyArIC5obGpzLW5hbWUnKS5lYWNoKGZ1bmN0aW9uKCkge1xyXG4gICAgICAgIHZhciB0YWcgPSAkKHRoaXMpLnRleHQoKTtcclxuXHJcbiAgICAgICAgaWYgKCdlbHNlJyA9PT0gdGFnIHx8IHRhZy5tYXRjaCgvXmVuZC8pKSB7XHJcbiAgICAgICAgICAgIHJldHVybjtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIHZhciB1cmwgPSAnaHR0cHM6Ly90d2lnLnN5bWZvbnkuY29tL2RvYy8zLngvdGFncy8nICsgdGFnICsgJy5odG1sIycgKyB0YWc7XHJcblxyXG4gICAgICAgICQodGhpcykuaHRtbChhbmNob3IodXJsLCB0YWcpKTtcclxuICAgIH0pO1xyXG5cclxuICAgIC8vIFdyYXBzIFR3aWcncyBmdW5jdGlvbnNcclxuICAgICR0ZW1wbGF0ZUNvZGUuZmluZCgnLmhsanMtdGVtcGxhdGUtdmFyaWFibGUgPiAuaGxqcy1uYW1lJykuZWFjaChmdW5jdGlvbigpIHtcclxuICAgICAgICB2YXIgZnVuYyA9ICQodGhpcykudGV4dCgpO1xyXG5cclxuICAgICAgICB2YXIgdXJsID0gJ2h0dHBzOi8vdHdpZy5zeW1mb255LmNvbS9kb2MvMy54L2Z1bmN0aW9ucy8nICsgZnVuYyArICcuaHRtbCMnICsgZnVuYztcclxuXHJcbiAgICAgICAgJCh0aGlzKS5odG1sKGFuY2hvcih1cmwsIGZ1bmMpKTtcclxuICAgIH0pO1xyXG59KTtcclxuIiwiaW1wb3J0IGhsanMgZnJvbSAnaGlnaGxpZ2h0LmpzL2xpYi9jb3JlJztcclxuaW1wb3J0IHBocCBmcm9tICdoaWdobGlnaHQuanMvbGliL2xhbmd1YWdlcy9waHAnO1xyXG5pbXBvcnQgdHdpZyBmcm9tICdoaWdobGlnaHQuanMvbGliL2xhbmd1YWdlcy90d2lnJztcclxuXHJcbmhsanMucmVnaXN0ZXJMYW5ndWFnZSgncGhwJywgcGhwKTtcclxuaGxqcy5yZWdpc3Rlckxhbmd1YWdlKCd0d2lnJywgdHdpZyk7XHJcblxyXG5obGpzLmhpZ2hsaWdodEFsbCgpO1xyXG4iLCIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiXSwibmFtZXMiOlsic3RhcnRTdGltdWx1c0FwcCIsImFwcCIsInJlcXVpcmUiLCJjb250ZXh0IiwiJCIsIiRtb2RhbCIsIiRjb250cm9sbGVyQ29kZSIsImZpbmQiLCIkdGVtcGxhdGVDb2RlIiwiYW5jaG9yIiwidXJsIiwiY29udGVudCIsIndyYXAiLCJsaW5rcyIsInJlcGxhY2UiLCJSZWdFeHAiLCJPYmplY3QiLCJrZXlzIiwiam9pbiIsInRva2VuIiwiZWFjaCIsImh0bWwiLCJhdHRyaWJ1dGVzIiwic3JjIiwidGV4dCIsInRhZyIsIm1hdGNoIiwiZnVuYyIsImhsanMiLCJwaHAiLCJ0d2lnIiwicmVnaXN0ZXJMYW5ndWFnZSIsImhpZ2hsaWdodEFsbCJdLCJzb3VyY2VSb290IjoiIn0=