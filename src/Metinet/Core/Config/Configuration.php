<?php

namespace Metinet\Core\Config;

use Metinet\Core\Logger\Logger;
use Metinet\Core\Routing\RouteCollection;

class Configuration
{
    private $loader;
    private $config;

    public function __construct(ConfigLoader $loader)
    {
        $this->loader = $loader;
    }

    public function getSection(string $section): array
    {
        if (!$this->config) {
            $this->config = $this->loader->load();
        }

        if (!isset($this->config[$section])) {

            throw ConfigurationError::unknownConfigurationSection($section);
        }

        return $this->config[$section];
    }

    public function getRoutes(): RouteCollection
    {
        return RouteCollectionFactory::createFromArray($this->getSection('routes'));
    }

    public function getLogger(): Logger
    {
        return LoggerFactory::create($this->getSection('logger'));
    }
}
