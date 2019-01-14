<?php

namespace Metinet\Core\Routing;

class RouteNotFound extends \DomainException
{
    public function __construct(string $path, string $method)
    {
        parent::__construct(sprintf('No route found for %s (method: %s)', $path, $method));
    }
}
