<?php

namespace Metinet\Domain\Members;

use Metinet\Core\Security\EncodedPassword;
use Metinet\Domain\Email;

class Member
{
    private $id;
    private $profile;
    private $email;
    private $encodedPassword;

    public static function signUp(Profile $profile, Email $email, EncodedPassword $encodedPassword): self
    {
        return new self(uniqid(), $profile, $email, $encodedPassword);
    }

    private function __construct(string $id, Profile $profile, Email $email, EncodedPassword $encodedPassword)
    {
        $this->id = $id;
        $this->profile = $profile;
        $this->email = $email;
        $this->encodedPassword = $encodedPassword;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }

    public function getEmail(): string
    {
        return (string) $this->email;
    }

    public function getEncodedPassword(): EncodedPassword
    {
        return $this->encodedPassword;
    }
}
