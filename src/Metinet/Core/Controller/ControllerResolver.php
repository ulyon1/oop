<?php

namespace Metinet\Core\Controller;

use Metinet\Core\DependencyManager;
use Metinet\Core\Http\Request;
use Metinet\Core\Routing\RouteUrlMatcher;

class ControllerResolver
{
    private $urlMatcher;
    private $dependencyManager;

    public function __construct(RouteUrlMatcher $urlMatcher, DependencyManager $dependencyManager)
    {
        $this->urlMatcher = $urlMatcher;
        $this->dependencyManager = $dependencyManager;
    }


    public function resolve(Request $request): callable
    {
        $action = $this->urlMatcher->match($request);

        [$controller, $method] = explode('::', $action);
        $controller = strtr($controller, ':', '\\');

        if (!class_exists($controller)) {

            throw UnableToResolveController::controllerNotFound($controller);
        }

        $controllerInstance = new $controller($this->dependencyManager);

        if (!method_exists($controllerInstance, $method)) {

            throw UnableToResolveController::actionNotFoundInController($method, $controller);
        }

        return [$controllerInstance, $method];
    }
}
