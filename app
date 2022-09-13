#!/usr/bin/env php
<?php

declare(strict_types=1);

require __DIR__ . '/src/autoload.php';

use App\RequestMethod;

$router = new App\Router();

$router->addRoute(RequestMethod::console(), ['version'], function () {
    echo "0.0.1-dev\n";
});

$router->addRoute(RequestMethod::any(), ['hello', ':name'], function (string $name) {
    echo "Hello {$name}!\n";
});

$handler = $router->resolve(new App\ConsoleRequest(...$_SERVER['argv']));

if ($handler) {
    $handler->run();
} else {
    echo "Command not found.\n";
}
