<?php

namespace Metinet\Core\Config;

class ConfigurationError extends \RuntimeException
{
    public static function unknownConfigurationSection(string $section): self
    {
        return new self(sprintf('Cannot find "%s" configuration section', $section));
    }
}
