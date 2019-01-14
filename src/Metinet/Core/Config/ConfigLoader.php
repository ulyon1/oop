<?php

namespace Metinet\Core\Config;

interface ConfigLoader
{
    public function load(): array;
}
