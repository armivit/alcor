<?php

declare(strict_types=1);

namespace App;

class Router
{
    protected array $routes = [];

    public function addRoute(int $requestMethod, string $route, callable $resolver)
    {
        if (!isset($this->routes[$route])) {
            $this->routes[$route] = [];
        }

        $this->routes[$route][$requestMethod] = $resolver;
    }

    public function resolve(string $method, string $uri): ?callable
    {
        $requestMethod = constant(RequestMethod::class . '::' . $method);

        if (isset($this->routes[$uri])) {
            foreach ($this->routes[$uri] as $bitmask => $resolver) {
                if ($requestMethod & $bitmask) {
                    return $resolver;
                }
            }
        }

        return null;
    }
}
