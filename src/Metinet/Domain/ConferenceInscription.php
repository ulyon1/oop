<?php

namespace Metinet\Domain;

class ConferenceInscription
{
    private $email;
    private $lastName;
    private $firstName;
    private $phone;

    public function __construct(string $email, string $lastName, string $firstName, string $phone)
    {
        $this->ensureValidEmail($email);
        $this->ensureValidLastName($lastName);
        $this->ensureValidFirstName($firstName);
        $this->ensureValidPhone($phone);

        $this->email = $email;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->phone = $phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }


    private function ensureValidEmail(string $email): void
    {
        if ( !preg_match ( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ " , $email ) )
        {
            throw new \InvalidArgumentException('Email address is not valid');
        }
    }

    private function ensureValidLastName(string $lastName): void
    {
        if (strlen($lastName) < 2 || strlen($lastName) > 100) {

            throw new \InvalidArgumentException('Last name must be between 2  & 100 characters');
        }
    }

    private function ensureValidFirstName(string $firstName): void
    {
        if (strlen($firstName) < 2 || strlen($firstName) > 100) {

            throw new \InvalidArgumentException('First name must be between 2  & 100 characters');
        }
    }

    private function ensureValidPhone(string $phone): void
    {
        if (strlen($phone) != 10) {

            throw new \InvalidArgumentException('Phone number must be 10 characters long');
        }
    }


}
