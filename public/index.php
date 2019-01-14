<?php

require __DIR__ . '/../vendor/autoload.php';

use Metinet\Core\Config\Configuration;
use Metinet\Core\Config\JsonLoader;
use Metinet\Core\Config\PhpLoader;
use Metinet\Core\Config\RouteCollectionFactory;
use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;
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

$config = new Configuration();
$routeUrlMatcher = new RouteUrlMatcher($config->getRoutes());

try {
    $action = $routeUrlMatcher->match($request);
    if (!is_callable($action)) {

        throw new Exception('Action is not callable');
    }
    $response = call_user_func($action, $request);

} catch (RouteNotFound $e) {
    $response = new Response($e->getMessage(), 404);
} catch (\Exception $exception) {
    $response = new Response(
        $exception->getMessage(),
        500
    );
}

$response->send();
