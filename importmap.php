<?php

/**
 * Returns the importmap for this application.
 *
 * - "path" is a path inside the asset mapper system. Use the
 *     "debug:asset-map" command to see the full list of paths.
 *
 * - "entrypoint" (JavaScript only) set to true for any module that will
 *     be used as an "entrypoint" (and passed to the importmap() Twig function).
 *
 * The "importmap:require" command can be used to add new entries to this file.
 */
return [
    'app' => [
        'path' => './assets/app.js',
        'entrypoint' => true,
    ],
    'admin' => [
        'path' => './assets/admin.js',
        'entrypoint' => true,
    ],
    '@hotwired/stimulus' => [
        'version' => '3.2.2',
    ],
    'bootstrap/js/dist/alert' => [
        'version' => '4.6.2',
    ],
    'bootstrap/dist/css/bootstrap.min.css' => [
        'version' => '4.6.2',
        'type' => 'css',
    ],
    'jquery' => [
        'version' => '3.7.1',
    ],
    'highlight.js/lib/core' => [
        'version' => '11.9.0',
    ],
    'highlight.js/lib/languages/php' => [
        'version' => '11.9.0',
    ],
    'highlight.js/lib/languages/twig' => [
        'version' => '11.9.0',
    ],
    '@symfony/stimulus-bundle' => [
        'path' => './vendor/symfony/stimulus-bundle/assets/dist/loader.js',
    ],
    'flatpickr' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/l10n' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/flatpickr.min.css' => [
        'version' => '4.6.13',
        'type' => 'css',
    ],
    'bootstrap/js/dist/collapse' => [
        'version' => '4.6.2',
    ],
    'bootstrap/js/dist/dropdown' => [
        'version' => '4.6.2',
    ],
    'bootstrap/js/dist/tab' => [
        'version' => '4.6.2',
    ],
    'bootstrap/js/dist/modal' => [
        'version' => '4.6.2',
    ],
    'highlight.js/styles/github-dark-dimmed.css' => [
        'version' => '11.9.0',
        'type' => 'css',
    ],
    '@fortawesome/fontawesome-free/css/all.css' => [
        'version' => '6.5.1',
        'type' => 'css',
    ],
    'lato-font/css/lato-font.css' => [
        'version' => '3.0.0',
        'type' => 'css',
    ],
    '@fortawesome/fontawesome-free/css/v4-shims.css' => [
        'version' => '6.5.1',
        'type' => 'css',
    ],
    'popper.js' => [
        'version' => '1.16.1',
    ],
    'typeahead.js' => [
        'version' => '0.11.1',
    ],
    'bloodhound-js' => [
        'version' => '1.2.3',
    ],
    'object-assign' => [
        'version' => '4.1.1',
    ],
    'es6-promise' => [
        'version' => '3.3.1',
    ],
    'storage2' => [
        'version' => '0.1.2',
    ],
    'superagent' => [
        'version' => '3.8.3',
    ],
    'component-emitter' => [
        'version' => '1.3.1',
    ],
    'bootstrap-tagsinput' => [
        'version' => '0.7.1',
    ],
    '@symfony/ux-live-component' => [
        'path' => './vendor/symfony/ux-live-component/assets/dist/live_controller.js',
    ],
];
