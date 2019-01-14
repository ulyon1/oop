<?php

namespace Metinet\Core\Logger;

class NullLogger implements Logger
{
    public function log(string $message, array $context = []): void {}
}
