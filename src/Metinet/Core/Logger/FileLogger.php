<?php

namespace Metinet\Core\Logger;

class FileLogger implements Logger
{
    private $path;
    private $formatter;

    public function __construct(string $path, Formatter $formatter)
    {
        $this->path = $path;
        $this->formatter = $formatter;
    }

    public function log(string $message, array $context = []): void
    {
        file_put_contents(
            $this->path,
            $this->formatter->format($message, $context),
            FILE_APPEND
        );
    }
}
