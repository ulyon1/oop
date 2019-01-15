<?php

namespace Metinet\Core;

use Metinet\Core\Config\Configuration;
use Metinet\Core\Config\LoggerFactory;
use Metinet\Core\Config\RouteCollectionFactory;
use Metinet\Core\Logger\Logger;
use Metinet\Core\Routing\RouteCollection;
use Metinet\Core\Security\PasswordEncoder;
use Metinet\Core\Security\PlainTextPasswordEncoder;
use Metinet\Core\Security\Sha1PasswordEncoder;
use Metinet\Domain\Members\MemberFactory;

class DependencyManager
{
    private $configuration;

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
            'debug' => $debug
        ]);

        $twig->addExtension(new \Twig_Extensions_Extension_Date());

        if ($debug) {
            $twig->addExtension(new \Twig_Extension_Debug());
        }

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
        return new MemberFactory($this->getPasswordEncoder());
    }
}
