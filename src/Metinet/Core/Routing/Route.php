<?php

namespace Metinet\Core\Routing;

class Route
{
    private $httpMethod;
    private $path;
    private $action;

    public function __construct(string $httpMethod, string $path, $action)
    {
        $this->httpMethod = $httpMethod;
        $this->path = $path;
        $this->action = $action;
    }

    public function getHttpMethod(): string
    {
        return $this->httpMethod;
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
