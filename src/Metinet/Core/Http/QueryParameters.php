<?php

namespace Metinet\Core\Http;

class QueryParameters implements \IteratorAggregate
{
    private $queryParameters;

    public function __construct(array $queryParameters)
    {
        $this->queryParameters = $queryParameters;
    }

    public function get($name, $default = null)
    {
        return $this->queryParameters[$name] ?? $default;
    }

    public function getIterator(): iterable
    {
        return $this->queryParameters;
    }
}
