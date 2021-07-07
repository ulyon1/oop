<?php

namespace Metinet\Domain\Freelancer;

class Freelancer
{
    private $firstName;
    private $lastName;
    private $dateOfBirth;

    private function __construct(string $firstName, string $lastName, string $dateOfBirth)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dateOfBirth = $dateOfBirth;
    }

    public static function signUp(string $firstName, string $lastName, string $dateOfBirth): Freelancer
    {
        return new self($firstName, $lastName, $dateOfBirth);
    }


    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getDateOfBirth(): string
    {
        return $this->dateOfBirth;
    }


}
