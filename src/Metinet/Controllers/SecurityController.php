<?php

namespace Metinet\Controllers;

use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;
use Metinet\Core\Security\AuthenticationFailed;

class SecurityController extends BaseController
{
    public function signIn(Request $request): Response
    {
        if ($this->dependencyManager->getAuthenticationContext()->isAccountSignedIn()) {

            return $this->redirect('/');
        }

        if ($request->isPost()) {
            $email = $request->getRequest()->get('email');
            $password = $request->getRequest()->get('password');

            try {
                $this->dependencyManager->getAccountAuthenticator()
                    ->authenticate($email, $password);
            } catch (AuthenticationFailed $e) {

                return $this->renderResponse(
                    'signInFailed.html.twig',
                    ['reason' => $e->getMessage()]
                );
            }

            return $this->redirect('/');
        }

        return $this->renderResponse('signIn.html.twig', []);
    }

    public function successfullySignedIn(Request $request): Response
    {

        return $this->renderResponse('successfullySignedIn.html.twig');
    }

    public function signOut(Request $request): Response
    {
        $this->dependencyManager->getAuthenticationContext()->signOut();

        return $this->redirect('/signin');
    }
}
