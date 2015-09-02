/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
        noItemsFoundMessage: 'No items found'
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
            var $link = $('<a>').attr('href', item.url).text(item.result);
            var $li = $('<li class="list-group-item">').append($link);

            $preview.append($li);
        }

        var noItemsFound = function() {
            var $li = $('<li class="list-group-item">').text(config.noItemsFoundMessage);

            $preview.empty();
            $preview.append($li);
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
