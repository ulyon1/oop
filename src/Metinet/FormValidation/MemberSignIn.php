<?php

namespace Metinet\FormValidation;

use Metinet\Core\Http\Request;

class MemberSignIn
{
    public $password;
    public $email;

    public $errors = [];

    public static function fromRequest(Request $request): self
    {
        $signUp = new self();
        $signUp->email = $request->getRequest()->get('email');
        $signUp->password = $request->getRequest()->get('password');

        return $signUp;
    }

    private function __construct() {}
}
