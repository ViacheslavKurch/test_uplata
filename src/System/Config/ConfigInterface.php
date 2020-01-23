<?php

namespace App\System\Config;

/**
 * Interface ConfigInterface
 * @package App\System\Config
 */
interface ConfigInterface
{
    /**
     * @param string $key
     * @return string
     */
    public function get(string $key): string;
}