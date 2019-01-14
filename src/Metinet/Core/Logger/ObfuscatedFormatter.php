<?php

namespace Metinet\Core\Logger;

class ObfuscatedFormatter implements Formatter
{
    private $formatter;

    public function __construct(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }

    public function format(string $message, array $context): string
    {
        $context['url'] = sha1($context['url'] ?? '');
        return $this->formatter->format($message, $context);
    }
}
