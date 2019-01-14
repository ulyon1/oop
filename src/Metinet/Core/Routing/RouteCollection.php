<?php

namespace Metinet\Core\Routing;

class RouteCollection
{
    private $routes = [];

    public function __construct(array $routes = [])
    {
        foreach ($routes as $route) {
            if (!$route instanceof Route) {
                throw new \LogicException('Invalid item provided, must be an instance of Route');
            }
        }
        $this->routes = $routes;
    }

    public function add(Route $route): void
    {
        $this->routes[] = $route;
    }

    /**
     * @return Route[]
     */
    public function all(): array
    {
        return $this->routes;
    }

    public function merge(RouteCollection $routes): void
    {
        foreach ($routes->all() as $route) {
            $this->routes[] = $route;
        }
    }
}
