<?php

namespace App\System\Route;

use App\System\Exception\NotFoundRouteException;
use App\System\Exception\InvalidRouteFileException;

/**
 * Class Router
 * @package App\System\Route
 */
final class Router implements RouterInterface
{
    /**
     * @var string
     */
    private string $class;

    /**
     * @var string
     */
    private string $method;

    /**
     * Router constructor.
     * @param array $routersConfig
     * @param string $route
     * @throws InvalidRouteFileException
     * @throws NotFoundRouteException
     */
    public function __construct(array $routersConfig, string $route)
    {
        $config = $this->getRouteByConfig($routersConfig, $route);

        $this->setClassName($config);
        $this->setMethodName($config);
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param array $routersConfig
     * @param string $route
     * @return array
     * @throws InvalidRouteFileException
     * @throws NotFoundRouteException
     */
    private function getRouteByConfig(array $routersConfig, string $route): array
    {
        foreach ($routersConfig as $item) {
            if (true === empty($item['route'])) {
                throw new InvalidRouteFileException('Invalid route file');
            }

            if ($item['route'] == $route) {
                return $item;
            }
        }

        throw new NotFoundRouteException('Not found route');
    }

    /**
     * @param $item
     * @throws InvalidRouteFileException
     */
    private function setClassName($item): void
    {
        if (true === empty($item['class'])) {
            throw new InvalidRouteFileException('Invalid route file');
        }

        $this->class = $item['class'];
    }

    /**
     * @param $item
     * @throws InvalidRouteFileException
     */
    private function setMethodName($item): void
    {
        if (true === empty($item['method'])) {
            throw new InvalidRouteFileException('Invalid route file');
        }

        $this->method = $item['method'];
    }
}