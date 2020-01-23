<?php
error_reporting(0);

require_once 'vendor/autoload.php';

use App\System\Route\Router;
use App\System\Config\Config;
use App\System\Server\ServerCli;

$routersConfig = include 'route/route.php';

try {
    $server = new ServerCli($_SERVER);
    $router = new Router($routersConfig, $server->getRoute());
    $config = new Config('config/config.ini');
    $className = $router->getClass();
    $methodName = $router->getMethod();

    (new $className($config))->$methodName();
} catch (Throwable $e) {
    echo $e->getMessage();
}


