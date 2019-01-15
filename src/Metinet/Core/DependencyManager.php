<?php

namespace Metinet\Core;

use Metinet\Core\Config\Configuration;
use Metinet\Core\Config\LoggerFactory;
use Metinet\Core\Config\RouteCollectionFactory;
use Metinet\Core\Logger\Logger;
use Metinet\Core\Routing\RouteCollection;

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
        $loader = new \Twig_Loader_Filesystem($this->configuration->getSection('twig')['viewsPath']);
        $twig = new \Twig_Environment($loader, [
            'debug' => (bool) $this->configuration->getSection('twig')['debug']
        ]);
        $twig->addExtension(new \Twig_Extensions_Extension_Date());
        $twig->addExtension(new \Twig_Extension_Debug());

        return $twig;
    }
}
