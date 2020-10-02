<?php

use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpFoundation\Request;

require dirname(__DIR__).'/vendor/autoload.php';

(new Dotenv())->bootEnv(dirname(__DIR__).'/.env');

if (filter_input(INPUT_SERVER, 'APP_DEBUG')) {
    umask(0000);

    Debug::enable();
}

if ($trustedProxies = filter_input(INPUT_SERVER, 'TRUSTED_PROXIES') ?? false) {
    Request::setTrustedProxies(explode(',', $trustedProxies), Request::HEADER_X_FORWARDED_ALL ^ Request::HEADER_X_FORWARDED_HOST);
}

if ($trustedHosts = filter_input(INPUT_SERVER, 'TRUSTED_HOSTS') ?? false) {
    Request::setTrustedHosts([$trustedHosts]);
}

$kernel = new Kernel(filter_input(INPUT_SERVER, 'APP_ENV'), (bool) filter_input(INPUT_SERVER, 'APP_DEBUG'));
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
