<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Members;

use Metinet\Core\Security\PasswordEncoder;
use Metinet\Domain\Conferences\Email;
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
                $memberSignUp->getFirstName(),
                $memberSignUp->getLastName(),
                $memberSignUp->getPhoneNumber()
            ),
            new Email($memberSignUp->getEmail()),
            $this->passwordEncoder->encode($memberSignUp->getPassword(), uniqid())
        );
    }
}
