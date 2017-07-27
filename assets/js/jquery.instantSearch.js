/**
 * jQuery plugin for an instant searching.
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
(function($) {
    $.fn.instantSearch = function(config) {
        return this.each(function() {
            initInstantSearch(this, $.extend(true, defaultConfig, config || {}));
        });
    };

    var defaultConfig = {
        minQueryLength: 2,
        maxPreviewItems: 10,
        previewDelay: 500,
        noItemsFoundMessage: 'No results found.'
    };

    function debounce(fn, delay) {
        var timer = null;
        return function () {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
                fn.apply(context, args);
            }, delay);
        };
    }

    var initInstantSearch = function(el, config) {
        var $input = $(el);
        var $form = $input.closest('form');
        var $preview = $('<ul class="search-preview list-group">').appendTo($form);

        var setPreviewItems = function(items) {
            $preview.empty();

            $.each(items, function(index, item) {
                if (index > config.maxPreviewItems) {
                    return;
                }

                addItemToPreview(item);
            });
        }

        var addItemToPreview = function(item) {
            var $link = $('<a>').attr('href', item.url).text(item.title);
            var $title = $('<h3>').attr('class', 'm-b-0').append($link);
            var $summary = $('<p>').text(item.summary);
            var $result = $('<div>').append($title).append($summary);

            $preview.append($result);
        }

        var noItemsFound = function() {
            var $result = $('<div>').text(config.noItemsFoundMessage);

            $preview.empty();
            $preview.append($result);
        }

        var updatePreview = function() {
            var query = $.trim($input.val()).replace(/\s{2,}/g, ' ');

            if (query.length < config.minQueryLength) {
                $preview.empty();
                return;
            }

            $.getJSON($form.attr('action') + '?' + $form.serialize(), function(items) {
                if (items.length === 0) {
                    noItemsFound();
                    return;
                }

                setPreviewItems(items);
            });
        }

        $input.focusout(function(e) {
            $preview.fadeOut();
        });

        $input.focusin(function(e) {
            $preview.fadeIn();
            updatePreview();
        });

        $input.keyup(debounce(updatePreview, config.previewDelay));
    }
})(window.jQuery);
