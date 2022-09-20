<?php

declare(strict_types=1);

namespace App;

class WebRequest extends Request
{
    const PATH_PREFIX = '/';
    const PATH_DELIMITER = '/';

    public function __construct(string $method, string $uri)
    {
        $this->method = RequestMethod::extract($method);

        if ($this->method === null) {
            $this->method = RequestMethod::web();
        }

        if (strpos($uri, static::PATH_PREFIX) === 0) {
            $uri = substr($uri, strlen(static::PATH_PREFIX));
        }

        $this->path = explode(static::PATH_DELIMITER, rtrim($uri, static::PATH_DELIMITER));
    }
}
