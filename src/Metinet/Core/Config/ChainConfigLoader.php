<?php
namespace Metinet\Core\Config;

class ChainConfigLoader implements ConfigLoader
{
    /**
     * @var ConfigLoader[]
     */
    private $loaders;

    public function __construct(array $loaders)
    {
        $this->loaders = $loaders;
    }

    public function load(): array
    {
        $config = [];

        foreach ($this->loaders as $loader) {
            $config = array_merge_recursive($config, $loader->load());
        }

        return $config;
    }
}
