<?php

use Symfony\Component\ClassLoader\ApcClassLoader;
use Symfony\Component\HttpFoundation\Request;

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';

// If your web server provides APC support for PHP applications, uncomment these
// lines to use APC for class autoloading. This can improve application performance
// very significantly. See http://symfony.com/doc/current/components/class_loader/cache_class_loader.html#apcclassloader
//
// $apcLoader = new ApcClassLoader('symfony_demo', $loader);
// $loader->unregister();
// $apcLoader->register(true);
//
// The first argument of ApcClassLoader() is a prefix that will be used to
// prevent cache key conflicts. In a real Symfony application, make sure to change
// it to a value that it's unique in the web server. A common practice is to use
// the domain name associated to the Symfony application.

require_once __DIR__.'/../app/AppKernel.php';

$kernel = new AppKernel('prod', false);
$kernel->loadClassCache();

// If you use HTTP Cache to improve application performance, uncomment the following lines:
// See http://symfony.com/doc/current/book/http_cache.html#symfony-reverse-proxy
//
// require_once __DIR__.'/../app/AppCache.php';
// $kernel = new AppKernel('prod', false);
// $kernel->loadClassCache();
// $kernel = new AppCache($kernel);
// Request::enableHttpMethodParameterOverride();

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
