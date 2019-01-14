<?php

require __DIR__ . '/../vendor/autoload.php';

use Metinet\Core\Config\ChainConfigLoader;
use Metinet\Core\Config\Configuration;
use Metinet\Core\Config\JsonConfigLoader;
use Metinet\Core\Config\PhpConfigLoader;
use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;
use Metinet\Core\Logger\FileLogger;
use Metinet\Core\Logger\ObfuscatedFormatter;
use Metinet\Core\Logger\SimpleFormatter;
use Metinet\Core\Routing\RouteNotFound;
use Metinet\Core\Routing\RouteUrlMatcher;

function sayHello(Request $request) {
    $name = $request->getQuery()->get('name');
    if (null === $name) {
        throw new Exception("I don't say Hello to anonymous, introduce yourself first!");
    }

    return new Response(sprintf('<p>Hello <b>%s</b></p>', htmlspecialchars($name, ENT_QUOTES, 'UTF-8')));
}

function about() {
    return new Response('À propos');
}

function signup() {
    return new Response('Inscription');
}

$request = Request::createFromGlobals();

$loader = new ChainConfigLoader([
    new JsonConfigLoader([__DIR__.'/../config/routes.json', __DIR__.'/../config/app.json']),
    new PhpConfigLoader([__DIR__.'/../config/routes.php'])
]);
$config = new Configuration($loader);

$routeUrlMatcher = new RouteUrlMatcher($config->getRoutes());

$logger = $config->getLogger();

try {
    $action = $routeUrlMatcher->match($request);
    if (!is_callable($action)) {

        throw new Exception('Action is not callable');
    }
    $response = call_user_func($action, $request);

} catch (RouteNotFound $e) {
    $response = new Response($e->getMessage(), 404);
    $logger->log($e->getMessage(), ['url' => $request->getPath()]);
} catch (\Exception $exception) {
    $response = new Response(
        'Unknown error occurred',
        500
    );
    $logger->log($exception->getMessage(), ['url' => $request->getPath()]);
}

$response->send();
