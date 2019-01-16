<?php

namespace Metinet\Core\Security;

use Metinet\Core\Session\Session;

class AccountAuthenticator
{
    private $accountProvider;
    private $passwordEncoder;
    private $session;

    public function __construct(AccountProvider $accountProvider, PasswordEncoder $passwordEncoder, Session $session)
    {
        $this->accountProvider = $accountProvider;
        $this->passwordEncoder = $passwordEncoder;
        $this->session = $session;
    }

    public function authenticate(string $username, string $password): void
    {
        try {
            $account = $this->accountProvider->findByUsername($username);
        } catch (AccountNotFound $e) {

            throw AuthenticationFailed::accountNotFound($username);
        }

        $providedEncodedPassword = $this->passwordEncoder
            ->encode($password, $account->getEncodedPassword()->getSalt())
        ;

        if (!$account->getEncodedPassword()->equals($providedEncodedPassword)) {

            throw AuthenticationFailed::invalidPassword($account);
        }

        $this->session->set('account', $account);
    }
}
