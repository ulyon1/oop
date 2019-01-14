<?php

namespace Metinet\Core\Config;

use Metinet\Core\Logger\FileLogger;
use Metinet\Core\Logger\Logger;
use Metinet\Core\Logger\ObfuscatedFormatter;
use Metinet\Core\Logger\SimpleFormatter;

class LoggerFactory
{
    public static function create(array $loggerConfig): Logger
    {
        $loggerType = $loggerConfig['type'];
        $shouldBeObfuscated = (bool) ($loggerConfig['obfuscated'] ?? false);

        switch ($loggerType) {
            case 'file':
                $formatter = $shouldBeObfuscated
                    ? new ObfuscatedFormatter(new SimpleFormatter($loggerConfig['format'] ?? null))
                    : new SimpleFormatter($loggerConfig['format'] ?? null)
                ;
                $logger = new FileLogger($loggerConfig['path'], $formatter);
                break;
            default:
                throw new \Exception(sprintf('Unknown logger type: "%s"', $loggerType));
        }

        return $logger;
    }
}
