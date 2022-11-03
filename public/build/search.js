(self["webpackChunk"] = self["webpackChunk"] || []).push([["search"],{

/***/ "./assets/js/jquery.instantSearch.js":
/*!*******************************************!*\
  !*** ./assets/js/jquery.instantSearch.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

/* provided dependency */ var __webpack_provided_window_dot_jQuery = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

__webpack_require__(/*! core-js/modules/es.regexp.exec.js */ "./node_modules/core-js/modules/es.regexp.exec.js");

__webpack_require__(/*! core-js/modules/es.string.replace.js */ "./node_modules/core-js/modules/es.string.replace.js");

__webpack_require__(/*! core-js/modules/es.string.search.js */ "./node_modules/core-js/modules/es.string.search.js");

__webpack_require__(/*! core-js/modules/web.timers.js */ "./node_modules/core-js/modules/web.timers.js");

__webpack_require__(/*! core-js/modules/es.string.trim.js */ "./node_modules/core-js/modules/es.string.trim.js");

__webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");

__webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");

__webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");

__webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");

__webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");

__webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");

__webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");

/**
 * jQuery plugin for an instant searching.
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
(function ($) {
  'use strict';

  String.prototype.render = function (parameters) {
    return this.replace(/({{ (\w+) }})/g, function (match, pattern, name) {
      return parameters[name];
    });
  }; // INSTANTS SEARCH PUBLIC CLASS DEFINITION
  // =======================================


  var InstantSearch = function InstantSearch(element, options) {
    this.$input = $(element);
    this.$form = this.$input.closest('form');
    this.$preview = $('<ul class="search-preview list-group">').appendTo(this.$form);
    this.options = $.extend({}, InstantSearch.DEFAULTS, this.$input.data(), options);
    this.$input.keyup(this.debounce());
  };

  InstantSearch.DEFAULTS = {
    minQueryLength: 2,
    limit: 10,
    delay: 500,
    noResultsMessage: 'No results found',
    itemTemplate: '\
                <article class="post">\
                    <h2><a href="{{ url }}">{{ title }}</a></h2>\
                    <p class="post-metadata">\
                       <span class="metadata"><i class="fa fa-calendar"></i> {{ date }}</span>\
                       <span class="metadata"><i class="fa fa-user"></i> {{ author }}</span>\
                    </p>\
                    <p>{{ summary }}</p>\
                </article>'
  };

  InstantSearch.prototype.debounce = function () {
    var delay = this.options.delay;
    var search = this.search;
    var timer = null;
    var self = this;
    return function () {
      clearTimeout(timer);
      timer = setTimeout(function () {
        search.apply(self);
      }, delay);
    };
  };

  InstantSearch.prototype.search = function () {
    var query = $.trim(this.$input.val()).replace(/\s{2,}/g, ' ');

    if (query.length < this.options.minQueryLength) {
      this.$preview.empty();
      return;
    }

    var self = this;
    var data = this.$form.serializeArray();
    data['l'] = this.limit;
    $.getJSON(this.$form.attr('action'), data, function (items) {
      self.show(items);
    });
  };

  InstantSearch.prototype.show = function (items) {
    var $preview = this.$preview;
    var itemTemplate = this.options.itemTemplate;

    if (0 === items.length) {
      $preview.html(this.options.noResultsMessage);
    } else {
      $preview.empty();
      $.each(items, function (index, item) {
        $preview.append(itemTemplate.render(item));
      });
    }
  }; // INSTANTS SEARCH PLUGIN DEFINITION
  // =================================


  function Plugin(option) {
    return this.each(function () {
      var $this = $(this);
      var instance = $this.data('instantSearch');
      var options = _typeof(option) === 'object' && option;
      if (!instance) $this.data('instantSearch', instance = new InstantSearch(this, options));
      if (option === 'search') instance.search();
    });
  }

  $.fn.instantSearch = Plugin;
  $.fn.instantSearch.Constructor = InstantSearch;
})(__webpack_provided_window_dot_jQuery);

/***/ }),

/***/ "./assets/search.js":
/*!**************************!*\
  !*** ./assets/search.js ***!
  \**************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _js_jquery_instantSearch_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./js/jquery.instantSearch.js */ "./assets/js/jquery.instantSearch.js");
/* harmony import */ var _js_jquery_instantSearch_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_js_jquery_instantSearch_js__WEBPACK_IMPORTED_MODULE_0__);
/* provided dependency */ var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

$(function () {
  $('.search-field').instantSearch({
    delay: 100
  }).keyup();
});

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_jquery_dist_jquery_js","vendors-node_modules_core-js_internals_add-to-unscopables_js-node_modules_core-js_internals_a-dd2802","vendors-node_modules_core-js_internals_object-set-prototype-of_js-node_modules_core-js_module-345aa2","vendors-node_modules_core-js_modules_es_string_iterator_js-node_modules_core-js_modules_es_st-a38065"], () => (__webpack_exec__("./assets/search.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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QUFRLENBQUN4QixNQUFUO0lBQzVCLENBUk0sQ0FBUDtFQVNIOztFQUVEM0IsQ0FBQyxDQUFDb0QsRUFBRixDQUFLQyxhQUFMLEdBQXFCTCxNQUFyQjtFQUNBaEQsQ0FBQyxDQUFDb0QsRUFBRixDQUFLQyxhQUFMLENBQW1CQyxXQUFuQixHQUFpQzdDLGFBQWpDO0FBRUgsQ0FuR0QsRUFtR0c4QyxvQ0FuR0g7Ozs7Ozs7Ozs7Ozs7OztBQ05BO0FBRUF2RCxDQUFDLENBQUMsWUFBVztFQUNUQSxDQUFDLENBQUMsZUFBRCxDQUFELENBQ0txRCxhQURMLENBQ21CO0lBQ1g3QixLQUFLLEVBQUU7RUFESSxDQURuQixFQUlLSixLQUpMO0FBS0gsQ0FOQSxDQUFEIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2pxdWVyeS5pbnN0YW50U2VhcmNoLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9zZWFyY2guanMiXSwic291cmNlc0NvbnRlbnQiOlsiLyoqXHJcbiAqIGpRdWVyeSBwbHVnaW4gZm9yIGFuIGluc3RhbnQgc2VhcmNoaW5nLlxyXG4gKlxyXG4gKiBAYXV0aG9yIE9sZWcgVm9yb25rb3ZpY2ggPG9sZWctdm9yb25rb3ZpY2hAeWFuZGV4LnJ1PlxyXG4gKiBAYXV0aG9yIFlvbmVsIENlcnV0byA8eW9uZWxjZXJ1dG9AZ21haWwuY29tPlxyXG4gKi9cclxuKGZ1bmN0aW9uICgkKSB7XHJcbiAgICAndXNlIHN0cmljdCc7XHJcblxyXG4gICAgU3RyaW5nLnByb3RvdHlwZS5yZW5kZXIgPSBmdW5jdGlvbiAocGFyYW1ldGVycykge1xyXG4gICAgICAgIHJldHVybiB0aGlzLnJlcGxhY2UoLyh7eyAoXFx3KykgfX0pL2csIGZ1bmN0aW9uIChtYXRjaCwgcGF0dGVybiwgbmFtZSkge1xyXG4gICAgICAgICAgICByZXR1cm4gcGFyYW1ldGVyc1tuYW1lXTtcclxuICAgICAgICB9KVxyXG4gICAgfTtcclxuXHJcbiAgICAvLyBJTlNUQU5UUyBTRUFSQ0ggUFVCTElDIENMQVNTIERFRklOSVRJT05cclxuICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG5cclxuICAgIHZhciBJbnN0YW50U2VhcmNoID0gZnVuY3Rpb24gKGVsZW1lbnQsIG9wdGlvbnMpIHtcclxuICAgICAgICB0aGlzLiRpbnB1dCA9ICQoZWxlbWVudCk7XHJcbiAgICAgICAgdGhpcy4kZm9ybSA9IHRoaXMuJGlucHV0LmNsb3Nlc3QoJ2Zvcm0nKTtcclxuICAgICAgICB0aGlzLiRwcmV2aWV3ID0gJCgnPHVsIGNsYXNzPVwic2VhcmNoLXByZXZpZXcgbGlzdC1ncm91cFwiPicpLmFwcGVuZFRvKHRoaXMuJGZvcm0pO1xyXG4gICAgICAgIHRoaXMub3B0aW9ucyA9ICQuZXh0ZW5kKHt9LCBJbnN0YW50U2VhcmNoLkRFRkFVTFRTLCB0aGlzLiRpbnB1dC5kYXRhKCksIG9wdGlvbnMpO1xyXG5cclxuICAgICAgICB0aGlzLiRpbnB1dC5rZXl1cCh0aGlzLmRlYm91bmNlKCkpO1xyXG4gICAgfTtcclxuXHJcbiAgICBJbnN0YW50U2VhcmNoLkRFRkFVTFRTID0ge1xyXG4gICAgICAgIG1pblF1ZXJ5TGVuZ3RoOiAyLFxyXG4gICAgICAgIGxpbWl0OiAxMCxcclxuICAgICAgICBkZWxheTogNTAwLFxyXG4gICAgICAgIG5vUmVzdWx0c01lc3NhZ2U6ICdObyByZXN1bHRzIGZvdW5kJyxcclxuICAgICAgICBpdGVtVGVtcGxhdGU6ICdcXFxyXG4gICAgICAgICAgICAgICAgPGFydGljbGUgY2xhc3M9XCJwb3N0XCI+XFxcclxuICAgICAgICAgICAgICAgICAgICA8aDI+PGEgaHJlZj1cInt7IHVybCB9fVwiPnt7IHRpdGxlIH19PC9hPjwvaDI+XFxcclxuICAgICAgICAgICAgICAgICAgICA8cCBjbGFzcz1cInBvc3QtbWV0YWRhdGFcIj5cXFxyXG4gICAgICAgICAgICAgICAgICAgICAgIDxzcGFuIGNsYXNzPVwibWV0YWRhdGFcIj48aSBjbGFzcz1cImZhIGZhLWNhbGVuZGFyXCI+PC9pPiB7eyBkYXRlIH19PC9zcGFuPlxcXHJcbiAgICAgICAgICAgICAgICAgICAgICAgPHNwYW4gY2xhc3M9XCJtZXRhZGF0YVwiPjxpIGNsYXNzPVwiZmEgZmEtdXNlclwiPjwvaT4ge3sgYXV0aG9yIH19PC9zcGFuPlxcXHJcbiAgICAgICAgICAgICAgICAgICAgPC9wPlxcXHJcbiAgICAgICAgICAgICAgICAgICAgPHA+e3sgc3VtbWFyeSB9fTwvcD5cXFxyXG4gICAgICAgICAgICAgICAgPC9hcnRpY2xlPidcclxuICAgIH07XHJcblxyXG4gICAgSW5zdGFudFNlYXJjaC5wcm90b3R5cGUuZGVib3VuY2UgPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgdmFyIGRlbGF5ID0gdGhpcy5vcHRpb25zLmRlbGF5O1xyXG4gICAgICAgIHZhciBzZWFyY2ggPSB0aGlzLnNlYXJjaDtcclxuICAgICAgICB2YXIgdGltZXIgPSBudWxsO1xyXG4gICAgICAgIHZhciBzZWxmID0gdGhpcztcclxuXHJcbiAgICAgICAgcmV0dXJuIGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgY2xlYXJUaW1lb3V0KHRpbWVyKTtcclxuICAgICAgICAgICAgdGltZXIgPSBzZXRUaW1lb3V0KGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgICAgIHNlYXJjaC5hcHBseShzZWxmKTtcclxuICAgICAgICAgICAgfSwgZGVsYXkpO1xyXG4gICAgICAgIH07XHJcbiAgICB9O1xyXG5cclxuICAgIEluc3RhbnRTZWFyY2gucHJvdG90eXBlLnNlYXJjaCA9IGZ1bmN0aW9uICgpIHtcclxuICAgICAgICB2YXIgcXVlcnkgPSAkLnRyaW0odGhpcy4kaW5wdXQudmFsKCkpLnJlcGxhY2UoL1xcc3syLH0vZywgJyAnKTtcclxuICAgICAgICBpZiAocXVlcnkubGVuZ3RoIDwgdGhpcy5vcHRpb25zLm1pblF1ZXJ5TGVuZ3RoKSB7XHJcbiAgICAgICAgICAgIHRoaXMuJHByZXZpZXcuZW1wdHkoKTtcclxuICAgICAgICAgICAgcmV0dXJuO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgdmFyIHNlbGYgPSB0aGlzO1xyXG4gICAgICAgIHZhciBkYXRhID0gdGhpcy4kZm9ybS5zZXJpYWxpemVBcnJheSgpO1xyXG4gICAgICAgIGRhdGFbJ2wnXSA9IHRoaXMubGltaXQ7XHJcblxyXG4gICAgICAgICQuZ2V0SlNPTih0aGlzLiRmb3JtLmF0dHIoJ2FjdGlvbicpLCBkYXRhLCBmdW5jdGlvbiAoaXRlbXMpIHtcclxuICAgICAgICAgICAgc2VsZi5zaG93KGl0ZW1zKTtcclxuICAgICAgICB9KTtcclxuICAgIH07XHJcblxyXG4gICAgSW5zdGFudFNlYXJjaC5wcm90b3R5cGUuc2hvdyA9IGZ1bmN0aW9uIChpdGVtcykge1xyXG4gICAgICAgIHZhciAkcHJldmlldyA9IHRoaXMuJHByZXZpZXc7XHJcbiAgICAgICAgdmFyIGl0ZW1UZW1wbGF0ZSA9IHRoaXMub3B0aW9ucy5pdGVtVGVtcGxhdGU7XHJcblxyXG4gICAgICAgIGlmICgwID09PSBpdGVtcy5sZW5ndGgpIHtcclxuICAgICAgICAgICAgJHByZXZpZXcuaHRtbCh0aGlzLm9wdGlvbnMubm9SZXN1bHRzTWVzc2FnZSk7XHJcbiAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgJHByZXZpZXcuZW1wdHkoKTtcclxuICAgICAgICAgICAgJC5lYWNoKGl0ZW1zLCBmdW5jdGlvbiAoaW5kZXgsIGl0ZW0pIHtcclxuICAgICAgICAgICAgICAgICRwcmV2aWV3LmFwcGVuZChpdGVtVGVtcGxhdGUucmVuZGVyKGl0ZW0pKTtcclxuICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgfVxyXG4gICAgfTtcclxuXHJcbiAgICAvLyBJTlNUQU5UUyBTRUFSQ0ggUExVR0lOIERFRklOSVRJT05cclxuICAgIC8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG5cclxuICAgIGZ1bmN0aW9uIFBsdWdpbihvcHRpb24pIHtcclxuICAgICAgICByZXR1cm4gdGhpcy5lYWNoKGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgdmFyICR0aGlzID0gJCh0aGlzKTtcclxuICAgICAgICAgICAgdmFyIGluc3RhbmNlID0gJHRoaXMuZGF0YSgnaW5zdGFudFNlYXJjaCcpO1xyXG4gICAgICAgICAgICB2YXIgb3B0aW9ucyA9IHR5cGVvZiBvcHRpb24gPT09ICdvYmplY3QnICYmIG9wdGlvbjtcclxuXHJcbiAgICAgICAgICAgIGlmICghaW5zdGFuY2UpICR0aGlzLmRhdGEoJ2luc3RhbnRTZWFyY2gnLCAoaW5zdGFuY2UgPSBuZXcgSW5zdGFudFNlYXJjaCh0aGlzLCBvcHRpb25zKSkpO1xyXG5cclxuICAgICAgICAgICAgaWYgKG9wdGlvbiA9PT0gJ3NlYXJjaCcpIGluc3RhbmNlLnNlYXJjaCgpO1xyXG4gICAgICAgIH0pXHJcbiAgICB9XHJcblxyXG4gICAgJC5mbi5pbnN0YW50U2VhcmNoID0gUGx1Z2luO1xyXG4gICAgJC5mbi5pbnN0YW50U2VhcmNoLkNvbnN0cnVjdG9yID0gSW5zdGFudFNlYXJjaDtcclxuXHJcbn0pKHdpbmRvdy5qUXVlcnkpO1xyXG4iLCJpbXBvcnQgJy4vanMvanF1ZXJ5Lmluc3RhbnRTZWFyY2guanMnO1xyXG5cclxuJChmdW5jdGlvbigpIHtcclxuICAgICQoJy5zZWFyY2gtZmllbGQnKVxyXG4gICAgICAgIC5pbnN0YW50U2VhcmNoKHtcclxuICAgICAgICAgICAgZGVsYXk6IDEwMCxcclxuICAgICAgICB9KVxyXG4gICAgICAgIC5rZXl1cCgpO1xyXG59KTtcclxuIl0sIm5hbWVzIjpbIiQiLCJTdHJpbmciLCJwcm90b3R5cGUiLCJyZW5kZXIiLCJwYXJhbWV0ZXJzIiwicmVwbGFjZSIsIm1hdGNoIiwicGF0dGVybiIsIm5hbWUiLCJJbnN0YW50U2VhcmNoIiwiZWxlbWVudCIsIm9wdGlvbnMiLCIkaW5wdXQiLCIkZm9ybSIsImNsb3Nlc3QiLCIkcHJldmlldyIsImFwcGVuZFRvIiwiZXh0ZW5kIiwiREVGQVVMVFMiLCJkYXRhIiwia2V5dXAiLCJkZWJvdW5jZSIsIm1pblF1ZXJ5TGVuZ3RoIiwibGltaXQiLCJkZWxheSIsIm5vUmVzdWx0c01lc3NhZ2UiLCJpdGVtVGVtcGxhdGUiLCJzZWFyY2giLCJ0aW1lciIsInNlbGYiLCJjbGVhclRpbWVvdXQiLCJzZXRUaW1lb3V0IiwiYXBwbHkiLCJxdWVyeSIsInRyaW0iLCJ2YWwiLCJsZW5ndGgiLCJlbXB0eSIsInNlcmlhbGl6ZUFycmF5IiwiZ2V0SlNPTiIsImF0dHIiLCJpdGVtcyIsInNob3ciLCJodG1sIiwiZWFjaCIsImluZGV4IiwiaXRlbSIsImFwcGVuZCIsIlBsdWdpbiIsIm9wdGlvbiIsIiR0aGlzIiwiaW5zdGFuY2UiLCJmbiIsImluc3RhbnRTZWFyY2giLCJDb25zdHJ1Y3RvciIsIndpbmRvdyIsImpRdWVyeSJdLCJzb3VyY2VSb290IjoiIn0=