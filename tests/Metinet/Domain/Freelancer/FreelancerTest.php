<?php

namespace Metinet\Domain\Freelancer;

use PHPUnit\Framework\TestCase;

class FreelancerTest extends TestCase
{

    public function testAFreelancerCanSignUp(): void
    {
        $firstName = "Michel";
        $lastName = "Eyquem de Montaigne";
        $dateOfBirth = "01-01-1533";
        $email = "michel.eyquem.de.montaigne@caramail.net";

        $signUp = Freelancer::signUp($firstName, $lastName, $dateOfBirth, $email);

        $this->assertEquals($firstName, $signUp->getFirstName());
        $this->assertEquals($lastName, $signUp->getLastName());
        $this->assertEquals($dateOfBirth, $signUp->getDateOfBirth());
    }

    public function testAFreelancerCantSignUpWithoutProvidingItsEmail(): void
    {
        $this->expectException(BadWordsDetected::class);
        $this->expectExceptionMessage('Bad words have been detected in your comment');


    }

    public function testAFreelancerCantSignUpIfHeIsUnder18(): void
    {

    }

    public function testARateCantBeNegative(): void
    {

    }

    public function testAFreelancerCannotBeAvailableIfARateIsNotDefined(): void
    {

    }

    public function testAFreelancerCanMarkHimselfAsUnavailable(): void
    {

    }

    public function testAFreelancerCanProvideABankAccount(): void
    {

    }

    public function testABankAccountMustBeValid(): void
    {

    }
}
