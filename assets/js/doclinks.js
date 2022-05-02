'use strict';

// Wraps some elements in anchor tags referencing to the Symfony documentation
$(function() {
    var $modal = $('#sourceCodeModal');
    var $controllerCode = $modal.find('code.php');
    var $templateCode = $modal.find('code.twig');

    function anchor(url, content) {
        return '<a class="doclink" target="_blank" href="' + url + '">' + content + '</a>';
    };

    function wrap(content, links) {
        return content.replace(
            new RegExp(Object.keys(links).join('|'), 'g'),
            token => anchor(links[token], token)
        );
    };

    // Wraps links to the Symfony documentation
    $modal.find('.hljs-comment').each(function() {
        $(this).html($(this).html().replace(/https:\/\/symfony.com\/doc\/[\w/.#-]+/g, function(url) {
            return anchor(url, url);
        }));
    });

    // Wraps Symfony's attributes
    var attributes = {
        'Cache': 'https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/cache.html',
        'IsGranted': 'https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/security.html#isgranted',
        'ParamConverter': 'https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html',
        'Route': 'https://symfony.com/doc/current/routing.html#creating-routes-as-attributes-or-annotations',
        'Security': 'https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/security.html#security'
    };

    $controllerCode.find('.hljs-meta').each(function() {
        var src = $(this).text();

        $(this).html(wrap(src, attributes));
    });

    // Wraps Twig's tags
    $templateCode.find('.hljs-template-tag + .hljs-name').each(function() {
        var tag = $(this).text();

        if ('else' === tag || tag.match(/^end/)) {
            return;
        }

        var url = 'https://twig.symfony.com/doc/3.x/tags/' + tag + '.html#' + tag;

        $(this).html(anchor(url, tag));
    });

    // Wraps Twig's functions
    $templateCode.find('.hljs-template-variable > .hljs-name').each(function() {
        var func = $(this).text();

        var url = 'https://twig.symfony.com/doc/3.x/functions/' + func + '.html#' + func;

        $(this).html(anchor(url, func));
    });
});
