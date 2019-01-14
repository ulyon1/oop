<?php

namespace Metinet\Core\Logger;

class SimpleFormatter implements Formatter
{
    private const DEFAULT_FORMAT = "{date} - {message} - {url}\n";

    private $format;

    public function __construct(?string $format)
    {
        $this->format = $format ?? self::DEFAULT_FORMAT;
    }

    public function format(string $message, array $context): string
    {
        return str_replace(
            ['{date}', '{message}', '{url}'],
            [date(DATE_ATOM), $message, $context['url'] ?? ''],
            $this->format
        );
    }
}
