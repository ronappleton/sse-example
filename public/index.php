<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/database/bootstrap.php';
require_once dirname(__DIR__) . '/routes.php';

use RonAppleton\SseExample\Services\Router;

$router = new Router;

try {
    $router->resolveRequest();
} catch (ReflectionException $e) {
    echo sprintf('Oops.. Something went wrong: %s', $e->getMessage());
}
