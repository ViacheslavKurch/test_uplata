<?php

namespace App\System\Config;

/**
 * Class Config
 * @package App\System\Config
 */
final class Config implements ConfigInterface
{
    /**
     * @var array
     */
    private array $data;

    /**
     * Config constructor.
     * @param string|null $config
     */
    public function __construct(string $config)
    {
        $this->data = $this->parseConfig($config);
    }

    /**
     * @param string $key
     * @return string
     */
    public function get(string $key): string
    {
        return $this->data[$key] ?? null;
    }

    /**
     * @param string $config
     * @return array
     */
    private function parseConfig(string $config): array
    {
        return parse_ini_file($config);
    }
}