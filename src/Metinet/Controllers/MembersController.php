<?php

namespace Metinet\Controllers;

use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;
use Metinet\FormValidation\MemberSignUp;
use Metinet\FormValidation\MemberSignUpValidator;

class MembersController extends BaseController
{
    public function signUp(Request $request): Response
    {
        $signUp = MemberSignUp::fromRequest($request);

        if ($request->isPost()) {
            $memberSignUpValidator = new MemberSignUpValidator();
            $validationResults = $memberSignUpValidator->validate($signUp);

            if (!$validationResults->hasErrors()) {

                $member = $this->dependencyManager->getMemberFactory()->fromSignUp($signUp);
                $this->dependencyManager->getMemberRepository()->save($member);

                return $this->redirect('/');
            }
        }

        return $this->renderResponse('members/signUp.html.twig', [
            'errors' => $validationResults ?? [],
            'signUp' => $signUp
        ]);
    }
}
