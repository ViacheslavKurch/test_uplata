<?php

namespace App\System\Server;

use App\System\Exception\RouteIsEmptyException;

/**
 * Class ServerCli
 * @package App\System\Server
 */
final class ServerCli implements ServerInterface
{
    private const ARGV_KEY = 'argv';

    private const ROUTE_KEY = 1;

    /**
     * @var array
     */
    private array $server;

    /**
     * ServerCli constructor.
     * @param array $server
     */
    public function __construct(array $server)
    {
        $this->server = $server[self::ARGV_KEY];
    }

    /**
     * @return string
     * @throws RouteIsEmptyException
     */
    public function getRoute(): string
    {
        if (true === empty($this->server[self::ROUTE_KEY])) {
            throw new RouteIsEmptyException('Route is empty');
        }

        return $this->server[self::ROUTE_KEY];
    }
}