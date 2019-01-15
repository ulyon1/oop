<?php

namespace Metinet\Controllers;

use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;
use Metinet\FormValidation\MemberSignUp;

class MembersController extends BaseController
{
    public function signUp(Request $request): Response
    {
        $signUp = MemberSignUp::fromRequest($request);

        if ($request->isPost()) {

            if ($signUp->isValid()) {

                return $this->redirect('/');
            }

            $formErrors = $signUp->getErrors();
        }

        return $this->renderResponse('members/signUp.html.twig', [
            'errors' => $formErrors ?? [],
            'signUp' => $signUp
        ]);
    }
}
