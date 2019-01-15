<?php

require __DIR__ . '/../vendor/autoload.php';

use Metinet\Core\Config\ChainConfigLoader;
use Metinet\Core\Config\Configuration;
use Metinet\Core\Config\JsonConfigLoader;
use Metinet\Core\Controller\ControllerResolver;
use Metinet\Core\DependencyManager;
use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;
use Metinet\Core\Routing\RouteNotFound;
use Metinet\Core\Routing\RouteUrlMatcher;

$request = Request::createFromGlobals();

$loader = new ChainConfigLoader([
    new JsonConfigLoader([
        __DIR__.'/../config/routes.json',
        __DIR__.'/../config/app.json'
    ]),
]);

$config = new Configuration($loader);

$dependencyManager = new DependencyManager($config);
$logger = $dependencyManager->getLogger();

try {
    $controllerResolver = new ControllerResolver(
        new RouteUrlMatcher($dependencyManager->getRoutes()),
        $dependencyManager
    );
    $callable = $controllerResolver->resolve($request);

    $response = call_user_func($callable, $request);

} catch (RouteNotFound $e) {
    $response = new Response($e->getMessage(), 404);
    $logger->log($e->getMessage(), ['url' => $request->getPath()]);
} catch (Throwable $e) {
    $logger->log($e->getMessage(), ['url' => $request->getPath()]);
    throw $e;
}

$response->send();
