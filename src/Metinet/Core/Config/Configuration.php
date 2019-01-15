<?php

namespace Metinet\Core\Config;

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
}
