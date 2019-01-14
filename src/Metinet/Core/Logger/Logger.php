<?php

namespace Metinet\Core\Logger;

interface Logger
{
    public function log(string $message, array $context = []): void;
}
