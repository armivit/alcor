#!/usr/bin/env php
<?php

declare(strict_types=1);

require __DIR__ . '/src/autoload.php';

use App\RequestMethod;

$router = new App\Router('_');

$router->addRoute(RequestMethod::any(), ['hello', ':name'], function (string $name) {
    echo "Hello {$name}!\n";
});

$handler = $router->resolve('GET', $_SERVER['argv'][1] ?? '');

if ($handler) {
    $handler->run();
} else {
    echo "Command not found.\n";
}
