<?php

namespace App;

class RouteHandler
{
    private $callable;
    private array $params;

    public function __construct(callable $callable, array $params)
    {
        $this->callable = $callable;
        $this->params = $params;
    }

    public function run(): void
    {
        call_user_func_array($this->callable, $this->params);
    }
}
