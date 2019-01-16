<?php

namespace Metinet\Core;

use Metinet\Core\Config\Configuration;
use Metinet\Core\Config\LoggerFactory;
use Metinet\Core\Config\RouteCollectionFactory;
use Metinet\Core\Logger\Logger;
use Metinet\Core\Routing\RouteCollection;
use Metinet\Core\Security\AccountAuthenticator;
use Metinet\Core\Security\AccountProvider;
use Metinet\Core\Security\AuthenticationContext;
use Metinet\Core\Security\PasswordEncoder;
use Metinet\Core\Security\PlainTextPasswordEncoder;
use Metinet\Core\Security\Sha1PasswordEncoder;
use Metinet\Core\Session\NativeSession;
use Metinet\Core\Session\Session;
use Metinet\Domain\Members\MemberFactory;
use Metinet\Repositories\BlogArticleRepository;
use Metinet\Repositories\BlogArticleSerializedFileRepository;
use Metinet\Repositories\MemberRepository;
use Metinet\Repositories\MemberSerializedFileRepository;

class DependencyManager
{
    private $configuration;
    private $dependencies = [];

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getLogger(): Logger
    {
        return LoggerFactory::create($this->configuration->getSection('logger'));
    }

    public function getRoutes(): RouteCollection
    {
        return RouteCollectionFactory::createFromArray($this->configuration->getSection('routes'));
    }

    public function getTwig(): \Twig_Environment
    {
        $debug = (bool) $this->configuration->getSection('twig')['debug'];

        $loader = new \Twig_Loader_Filesystem($this->configuration->getSection('twig')['viewsPath']);
        $twig = new \Twig_Environment($loader, [
            'debug' => $debug,
        ]);

        $twig->addExtension(new \Twig_Extensions_Extension_Date());

        if ($debug) {
            $twig->addExtension(new \Twig_Extension_Debug());
        }

        $twig->addGlobal('account', $this->getSession()->get('account'));

        return $twig;
    }

    public function getPasswordEncoder(): PasswordEncoder
    {
        $passwordEncoderId = $this->configuration->getSection('security')['passwordEncoder'];

        switch ($passwordEncoderId) {
            case 'sha1':
                return new Sha1PasswordEncoder();
            case 'plain':
                return new PlainTextPasswordEncoder();
            default:
                throw new \LogicException(sprintf('Unknown Security Encoder: "%s"', $passwordEncoderId));
        }
    }

    public function getMemberFactory(): MemberFactory
    {
        if (!isset($this->dependencies[__METHOD__])) {
            $this->dependencies[__METHOD__] = new MemberFactory($this->getPasswordEncoder());
        }

        return $this->dependencies[__METHOD__];
    }

    public function getMemberRepository(): MemberRepository
    {
        if (!isset($this->dependencies[__METHOD__])) {
            $this->dependencies[__METHOD__] = new MemberSerializedFileRepository(
                $this->configuration->getSection('repositories')['members']['serializedStorage']['path']
            );
        }

        return $this->dependencies[__METHOD__];
    }

    public function getAccountProvider(): AccountProvider
    {
        if (!isset($this->dependencies[__METHOD__])) {
            $this->dependencies[__METHOD__] = $this->getMemberRepository();
        }

        return $this->dependencies[__METHOD__];
    }

    public function getSession(): Session
    {
        if (!isset($this->dependencies[__METHOD__])) {
            $this->dependencies[__METHOD__] = new NativeSession();
        }

        return $this->dependencies[__METHOD__];
    }

    public function getAccountAuthenticator(): AccountAuthenticator
    {
        if (!isset($this->dependencies[__METHOD__])) {
            $this->dependencies[__METHOD__] = new AccountAuthenticator(
                $this->getAccountProvider(),
                $this->getPasswordEncoder(),
                $this->getSession()
            );
        }

        return $this->dependencies[__METHOD__];
    }

    public function getAuthenticationContext(): AuthenticationContext
    {
        if (!isset($this->dependencies[__METHOD__])) {
            $this->dependencies[__METHOD__] = new AuthenticationContext(
                $this->getSession()
            );
        }

        return $this->dependencies[__METHOD__];
    }

    public function getBlogArticleRepository(): BlogArticleRepository
    {
        if (!isset($this->dependencies[__METHOD__])) {
            $this->dependencies[__METHOD__] = new BlogArticleSerializedFileRepository(
                $this->configuration->getSection('repositories')['blogArticle']['serializedStorage']['path']
            );
        }

        return $this->dependencies[__METHOD__];
    }
}
