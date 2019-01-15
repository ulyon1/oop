<?php

namespace Metinet\Domain;


class ConferenceParticipant
{
    private $name;
    private $email;
    private $phoneNumber;

    /**
     * ConferenceParticipant constructor.
     * @param $name
     * @param $email
     * @param $phoneNumber
     */
    public function __construct($name, $email, $phoneNumber)
    {

        $this->ensureValidName($name);
        $this->ensureValidEmail($email);
        $this->ensurePhoneNumber(filter_var($phoneNumber, FILTER_SANITIZE_NUMBER_INT));

        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    private function ensureValidName(string $name): void
    {
        if (strlen($name) < 3 || strlen($name) > 80) {
            throw new \InvalidArgumentException('Name must be between 3 & 80 characters');
        }
    }

    private function ensureValidEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Email must be valid.');
        }
    }

    private function ensurePhoneNumber(string $phone): void
    {
        if(strlen($phone) < 5) {
            throw new \InvalidArgumentException('Phone number must have at least 5 digits');
        }
    }
}