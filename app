#!/usr/bin/env php
<?php

declare(strict_types=1);

require __DIR__ . '/src/autoload.php';

$router = new App\Router();

$router->addRoute('GET', 'hello/world', function () {
    echo "Hello World!\n";
});

$callable = $router->resolve('GET', $_SERVER['argv'][1] ?? '');

if ($callable) {
    call_user_func($callable);
} else {
    echo "Command not found.\n";
}
