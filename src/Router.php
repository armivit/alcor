<?php

declare(strict_types=1);

namespace App;

class Router
{
    protected array $routes = [];

    public function addRoute(string $method, string $route, callable $resolver)
    {
        if (!isset($this->routes[$route])) {
            $this->routes[$route] = [];
        }

        $this->routes[$route][$method] = $resolver;
    }

    public function resolve(string $method, string $uri): ?callable
    {
        if (isset($this->routes[$uri])) {
            foreach ([$method, '*'] as $method) {
                if (isset($this->routes[$uri][$method])) {
                    return $this->routes[$uri][$method];
                }
            }
        }

        return null;
    }
}
