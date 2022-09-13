<?php

declare(strict_types=1);

namespace App;

abstract class Request
{
    protected int $method;
    protected array $path;

    public function getMethod(): int
    {
        return $this->method;
    }

    public function getPath(): array
    {
        return $this->path;
    }
}
