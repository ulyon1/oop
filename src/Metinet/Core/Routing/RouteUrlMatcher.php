<?php

namespace Metinet\Core\Routing;

use Metinet\Core\Http\Request;

class RouteUrlMatcher
{
    private $routes;

    public function __construct(RouteCollection $routes)
    {
        $this->routes = $routes;
    }

    public function match(Request $request)
    {
        foreach ($this->routes->all() as $route) {
            if ($route->getPath() === $request->getPath()
                && $route->getHttpMethod() === $request->getMethod()) {

                return $route->getAction();
            }

        }

        throw new RouteNotFound($request->getPath(), $request->getMethod());
    }
}
