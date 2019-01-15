<?php

namespace Metinet\FormValidation;

class MemberSignUpValidator
{
    public function validate(MemberSignUp $memberSignUp): array
    {
        $errors = [];

        if (empty($memberSignUp->firstName)) {
            $errors[] = 'First Name cannot be empty';
        }

        if (empty($memberSignUp->lastName)) {
            $errors[] = 'Last Name cannot be empty';
        }

        if (empty($memberSignUp->email)) {
            $errors[] = 'Email cannot be empty';
        }

        if (empty($memberSignUp->password)) {
            $errors[] = 'Password cannot be empty';
        }

        if (empty($memberSignUp->passwordConfirm)) {
            $errors[] = 'Password confirmation cannot be empty';
        }

        if ($memberSignUp->password !== $memberSignUp->passwordConfirm) {
            $errors[] = 'Password mismatch';
        }

        if (empty($memberSignUp->password)) {
            $errors[] = 'Password must be at least 1 char';
        }

        return $errors;
    }
}
