<?php

require __DIR__ . '/../vendor/autoload.php';

use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;
use Metinet\Core\Routing\Route;
use Metinet\Core\Routing\RouteNotFound;
use Metinet\Core\Routing\RouteUrlMatcher;

function sayHello(Request $request) {
    $name = $request->getQuery()->get('name');
    if (null === $name) {
        throw new Exception("I don't say Hello to anonymous, introduce yourself first!");
    }

    return sprintf('<p>Hello <b>%s</b></p>', htmlspecialchars($name, ENT_QUOTES, 'UTF-8'));
}

function about() {
    return 'A propos';
}

function signup() {
    return 'Inscription';
}

$request = Request::createFromGlobals();

/** @var Route[] $routes */
$routes = [];
$routes[] = new Route('GET', '/hello', 'sayHello');
$routes[] = new Route('GET', '/about', 'about');
$routes[] = new Route('GET', '/signup', 'signup');
$routes[] = new Route('GET', '/inscription', 'signu');

$routeUrlMatcher = new RouteUrlMatcher($routes);
try {
    $action = $routeUrlMatcher->match($request);
    if (!is_callable($action)) {

        throw new Exception('Action is not callable');
    }
    $content = call_user_func($action, $request);
} catch (RouteNotFound $e) {
    $response = new Response($e->getMessage(), 404);
    $response->send();
    exit(1);
} catch (\Exception $exception) {
    $response = new Response(
        $exception->getMessage(),
        500
    );
    $response->send();
    exit(1);
}

$response = new Response(
    $content,
    200,
    ['Content-Type' => 'text/html; charset=utf-8']
);


$response->send();
