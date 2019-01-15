<?php

namespace Metinet\FormValidation;

use Metinet\Core\Http\Request;

class MemberSignUp
{
    private $firstName;
    private $lastName;
    private $phoneNumber;
    private $password;
    private $passwordConfirm;
    private $email;

    private $errors = [];

    public static function fromRequest(Request $request): self
    {
        $signUp = new self();
        $signUp->firstName = $request->getRequest()->get('first_name');
        $signUp->lastName = $request->getRequest()->get('last_name');
        $signUp->email = $request->getRequest()->get('email');
        $signUp->password = $request->getRequest()->get('password');
        $signUp->passwordConfirm = $request->getRequest()->get('password_confirm');
        $signUp->phoneNumber = $request->getRequest()->get('phone_number');

        $signUp->validate();

        return $signUp;
    }

    private function validate(): void
    {
        if (empty($this->firstName)) {
            $this->errors[] = 'First Name cannot be empty';
        }

        if (empty($this->lastName)) {
            $this->errors[] = 'Last Name cannot be empty';
        }

        if (empty($this->email)) {
            $this->errors[] = 'Email cannot be empty';
        }

        if (empty($this->password)) {
            $this->errors[] = 'Password cannot be empty';
        }

        if (empty($this->passwordConfirm)) {
            $this->errors[] = 'Password confirmation cannot be empty';
        }

        if ($this->password !== $this->passwordConfirm) {
            $this->errors[] = 'Password mismatch';
        }

        if (empty($this->password)) {
            $this->errors[] = 'Password must be at least 1 char';
        }
    }

    public function isValid(): bool
    {
        return 0 === \count($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getPasswordConfirm(): ?string
    {
        return $this->passwordConfirm;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    private function __construct() {}
}
