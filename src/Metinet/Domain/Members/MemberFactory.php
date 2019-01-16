<?php

namespace Metinet\Domain\Members;

use Metinet\Core\Security\PasswordEncoder;
use Metinet\Domain\Email;
use Metinet\Domain\PhoneNumber;
use Metinet\FormValidation\MemberSignUp;

class MemberFactory
{
    private $passwordEncoder;

    public function __construct(PasswordEncoder $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function fromSignUp(MemberSignUp $memberSignUp): Member
    {
        return Member::signUp(
            new Profile(
                $memberSignUp->firstName,
                $memberSignUp->lastName,
                new PhoneNumber($memberSignUp->phoneNumber)
            ),
            new Email($memberSignUp->email),
            $this->passwordEncoder->encode($memberSignUp->password, sha1(uniqid()))
        );
    }
}
