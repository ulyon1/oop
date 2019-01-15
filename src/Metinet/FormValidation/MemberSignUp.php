<?php

namespace Metinet\FormValidation;

use Metinet\Core\Http\Request;

class MemberSignUp
{
    public $firstName;
    public $lastName;
    public $phoneNumber;
    public $password;
    public $passwordConfirm;
    public $email;

    public $errors = [];

    public static function fromRequest(Request $request): self
    {
        $signUp = new self();
        $signUp->firstName = $request->getRequest()->get('first_name');
        $signUp->lastName = $request->getRequest()->get('last_name');
        $signUp->email = $request->getRequest()->get('email');
        $signUp->password = $request->getRequest()->get('password');
        $signUp->passwordConfirm = $request->getRequest()->get('password_confirm');
        $signUp->phoneNumber = $request->getRequest()->get('phone_number');

        return $signUp;
    }

    private function __construct() {}
}
