<?php

declare(strict_types=1);

namespace App;

class Router
{
    private string $delimiter;
    private RouteNode $rootNode;

    public function __construct(string $delimiter)
    {
        $this->delimiter = $delimiter;
        $this->rootNode = new RouteNode();
    }

    public function addRoute(int $requestMethod, array $path, callable $callable)
    {
        $node = $this->rootNode;

        foreach ($path as $expr) {
            if (!$node->hasChild($expr)) {
                $node->addChild($expr);
            }

            $node = $node->getChild($expr);
        }

        $node->addCallable($requestMethod, $callable);
    }

    public function resolve(string $method, string $uri): ?RouteHandler
    {
        $node = $this->rootNode;
        $params = [];

        foreach (explode($this->delimiter, $uri) as $slug) {
            $node = $node->findChild($slug);

            if ($node === null) {
                return null;
            } elseif ($node->isDynamic) {
                $params[$node->name] = $slug;
            }
        }

        $callable = $node->getCallable(RequestMethod::extract($method));

        if ($callable) {
            return new RouteHandler($callable, $params);
        }

        return null;
    }
}
