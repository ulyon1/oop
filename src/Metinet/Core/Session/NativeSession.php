<?php

namespace Metinet\Core\Session;

class NativeSession implements Session
{
    public function __construct()
    {
        $this->safeStart();
    }

    public function start(): void
    {
        session_start();
    }

    public function safeStart(): void
    {
        if (!$this->isStarted()) {
            $this->start();
        }
    }

    public function isStarted(): bool
    {
        return \PHP_SESSION_ACTIVE === session_status();
    }

    public function has(string $attributeName): bool
    {
        return isset($_SESSION[$attributeName]);
    }

    public function get(string $attributeName, $default = null)
    {
        return isset($_SESSION[$attributeName]) 
            ? unserialize($_SESSION[$attributeName])
            : $default;
    }

    public function set(string $attributeName, $value): void
    {
        $_SESSION[$attributeName] = serialize($value);
    }

    public function remove(string $attributeName): void
    {
        unset($_SESSION[$attributeName]);
    }

    public function all(): array
    {
        return $_SESSION;
    }
}
