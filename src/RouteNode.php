<?php

namespace App;

class RouteNode
{
    public string $name;
    public bool $isDynamic;

    private array $children = [];
    private array $callable = [];

    public function __construct(string $expr = '')
    {
        $this->isDynamic = substr($expr, 0, 1) === ':';
        $this->name = $this->isDynamic ? substr($expr, 1) : $expr;
    }

    public function addChild(string $expr): void
    {
        $this->children[$expr] = new self($expr);
    }

    public function getChild(string $expr): self
    {
        return $this->children[$expr];
    }

    public function hasChild(string $expr): bool
    {
        return isset($this->children[$expr]);
    }

    public function findChild(string $slug): ?self
    {
        foreach ($this->children as $expr => $child) {
            if ($child->isDynamic xor $expr === $slug) {
                return $child;
            }
        }

        return null;
    }

    public function addCallable(int $requestMethod, callable $callable): void
    {
        $this->callable[$requestMethod] = $callable;
    }

    public function getCallable(int $requestMethod): ?callable
    {
        foreach ($this->callable as $bitmask => $callable) {
            if ($requestMethod && ($bitmask & $requestMethod) === $requestMethod) {
                return $callable;
            }
        }

        return null;
    }
}
