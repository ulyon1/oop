<?php

namespace Metinet\FormValidation;

class MemberSignUpValidator
{
    public function validate(MemberSignUp $memberSignUp): ValidatorResults
    {
        $errors = [];

        if (empty($memberSignUp->email)) {
            $errors[] = 'Email cannot be empty';
        }

        if (empty($memberSignUp->password)) {
            $errors[] = 'Password cannot be empty';
        }

        return new ValidatorResults($errors);
    }
}
