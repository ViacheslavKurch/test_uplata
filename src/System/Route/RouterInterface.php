<?php

namespace App\System\Route;

/**
 * Interface RouterInterface
 * @package App\System\Route
 */
interface RouterInterface
{
    /**
     * @return string
     */
    public function getClass(): string;

    /**
     * @return string
     */
    public function getMethod(): string;
}