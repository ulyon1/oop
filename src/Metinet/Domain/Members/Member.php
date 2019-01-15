<?php

namespace Metinet\Domain\Members;

use Metinet\Core\Security\EncodedPassword;
use Metinet\Domain\Email;

class Member
{
    private $profile;
    private $email;
    private $encodedPassword;

    public static function signUp(Profile $profile, Email $email, EncodedPassword $encodedPassword): self
    {
        return new self($profile, $email, $encodedPassword);
    }

    private function __construct(Profile $profile, Email $email, EncodedPassword $encodedPassword)
    {
        $this->profile = $profile;
        $this->email = $email;
        $this->encodedPassword = $encodedPassword;
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }

    public function getEmail(): string
    {
        return (string) $this->email;
    }

    public function getEncodedPassword(): string
    {
        return $this->encodedPassword;
    }
}
