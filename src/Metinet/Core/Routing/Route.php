<?php

namespace Metinet\Core\Routing;

class Route
{
    private $httpMethods;
    private $path;
    private $action;

    public function __construct(array $httpMethods, string $path, $action)
    {
        $this->httpMethods = $httpMethods;
        $this->path = $path;
        $this->action = $action;
    }

    public function getHttpMethods(): array
    {
        return $this->httpMethods;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getAction()
    {
        return $this->action;
    }
}
