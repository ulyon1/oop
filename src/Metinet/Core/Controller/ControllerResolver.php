<?php

namespace Metinet\Core\Controller;

use Metinet\Core\Http\Request;
use Metinet\Core\Routing\RouteUrlMatcher;

class ControllerResolver
{
    private $urlMatcher;

    public function __construct(RouteUrlMatcher $urlMatcher)
    {
        $this->urlMatcher = $urlMatcher;
    }


    public function resolve(Request $request): callable
    {
        $action = $this->urlMatcher->match($request);

        [$controller, $method] = explode('::', $action);
        $controller = strtr($controller, ':', '\\');

        if (!class_exists($controller)) {

            throw UnableToResolveController::controllerNotFound($controller);
        }

        $controllerInstance = new $controller();

        if (!method_exists($controllerInstance, $method)) {

            throw UnableToResolveController::actionNotFoundInController($method, $controller);
        }

        return [$controllerInstance, $method];
    }
}
