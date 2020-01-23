<?php

namespace App\System\Server;

use App\System\Exception\RouteIsEmptyException;

/**
 * Interface ServerInterface
 * @package App\System\Server
 */
interface ServerInterface
{
    /**
     * @return string
     * @throws RouteIsEmptyException
     */
    public function getRoute(): string;
}