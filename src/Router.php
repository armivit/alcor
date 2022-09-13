<?php

declare(strict_types=1);

namespace App;

class Router
{
    private RouteNode $rootNode;

    public function __construct()
    {
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

    public function resolve(Request $request): ?RouteHandler
    {
        $node = $this->rootNode;
        $params = [];

        foreach ($request->getPath() as $slug) {
            $node = $node->findChild($slug);

            if ($node === null) {
                return null;
            } elseif ($node->isDynamic) {
                $params[$node->name] = $slug;
            }
        }

        $callable = $node->getCallable($request->getMethod());

        if ($callable) {
            return new RouteHandler($callable, $params);
        }

        return null;
    }
}
