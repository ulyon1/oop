<?php

namespace Metinet\Controllers;

use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;
use Metinet\Domain\Email;
use Metinet\Domain\Members\Member;
use Metinet\Domain\Members\Profile;
use Metinet\Domain\PhoneNumber;
use Metinet\FormValidation\MemberSignUp;
use Metinet\FormValidation\MemberSignUpValidator;

class MembersController extends BaseController
{
    public function signUp(Request $request): Response
    {
        $signUp = MemberSignUp::fromRequest($request);

        if ($request->isPost()) {

            $memberSignUpValidator = new MemberSignUpValidator();
            $errors = $memberSignUpValidator->validate($signUp);

            if (0 === \count($errors)) {

                $member = Member::signUp(
                    new Profile($signUp->firstName, $signUp->lastName, new PhoneNumber($signUp->phoneNumber)),
                    new Email($signUp->email),
                    $signUp->password
                );

                return $this->redirect('/');
            }
        }

        return $this->renderResponse('members/signUp.html.twig', [
            'errors' => $errors ?? [],
            'signUp' => $signUp
        ]);
    }
}
