<?php

declare(strict_types=1);

require __DIR__ . '/../src/autoload.php';

use App\RequestMethod;

$router = new App\Router();

$router->addRoute(RequestMethod::web(), [], function () {
    echo <<<HTML
<a href="hello/Alcor">hello world</a>
HTML;
});

$router->addRoute(RequestMethod::any(), ['hello', ':name'], function (string $name) {
    echo "Hello {$name}!\n";
});

$request = new App\WebRequest($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

$handler = $router->resolve($request);

if ($handler) {
    $handler->run();
} else {
    header('HTTP/1.1 404 Not Found');
    echo "Page not found.\n";
}
