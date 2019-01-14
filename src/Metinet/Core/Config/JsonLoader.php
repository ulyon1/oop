<?php

namespace Metinet\Core\Config;

class JsonLoader implements Loader
{
    private $paths;

    public function __construct(array $paths)
    {
        $this->paths = $paths;
    }

    public function load(): array
    {
        $config = [];
        foreach ($this->paths as $path) {
            $content = file_get_contents($path);
            $config = array_merge_recursive($config, json_decode($content, true));
        }

        return $config;
    }
}
