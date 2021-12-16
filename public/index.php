<?php

use App\Kernel;

if (!is_file(dirname(__DIR__).'/vendor/autoload_runtime.php')) {
    throw new LogicException('Symfony Runtime is missing. Try running "composer require symfony/runtime".');
}

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

/**
 * This file is a Symfony Front Controller (entrypoint)
 * when a page is loaded from a browser.
 *
 * It boots Symfony in an HTTP Request-Response flow.
 * 
 * See https://symfony.com/doc/current/introduction/http_fundamentals.html#the-front-controller
 */

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
