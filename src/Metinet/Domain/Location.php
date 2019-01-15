<?php

namespace Metinet\Domain;

class Location
{
    private $placeName;
    private $address;

    public function __construct(string $placeName, PostalAddress $address)
    {
        $this->address = $address;
        $this->placeName = $placeName;
    }

    public function getPlaceName(): string
    {
        return $this->placeName;
    }

    public function getAddress(): PostalAddress
    {
        return $this->address;
    }
}
