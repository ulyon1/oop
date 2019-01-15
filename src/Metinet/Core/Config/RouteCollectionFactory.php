<?php

namespace Metinet\Core\Config;

use Metinet\Core\Routing\Route;
use Metinet\Core\Routing\RouteCollection;

class RouteCollectionFactory
{
    public static function createFromArray(array $rawRoutes): RouteCollection
    {
        $routes = new RouteCollection();

        foreach ($rawRoutes as $rawRoute) {

            $routes->add(
                new Route(
                    $rawRoute['methods'],
                    $rawRoute['path'],
                    $rawRoute['action']
                )
            );
        }

        return $routes;
    }
}
