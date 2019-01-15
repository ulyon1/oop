<?php

namespace Metinet\Domain\Members;

use Metinet\Domain\PhoneNumber;

class Profile
{
    private $firstName;
    private $lastName;
    private $phoneNumber;

    public function __construct(string $firstName, string $lastName, PhoneNumber $phoneNumber)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phoneNumber = $phoneNumber;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getPhoneNumber(): PhoneNumber
    {
        return $this->phoneNumber;
    }
}
