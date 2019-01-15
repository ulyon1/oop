<?php

namespace Metinet\Domain;

class PostalAddress
{
    private $street;
    private $postalCode;
    private $city;
    private $country;

    public function __construct(string $street, string $postalCode, string $city, string $country)
    {
        $this->street =
            $street;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->country = $country;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function __toString(): string
    {
        return sprintf(<<<ADDRESS
{$this->street}
{$this->postalCode} {$this->city}
{$this->country}
ADDRESS
);
    }
}

















