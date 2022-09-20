<?php

declare(strict_types=1);

namespace App;

class RequestMethod
{
    const GET = 1;
    const HEAD = 2;
    const POST = 4;
    const PUT = 8;
    const DELETE = 16;
    const CONNECT = 32;
    const OPTIONS = 64;
    const TRACE = 128;
    const PATCH = 256;

    public static function any(): int
    {
        return static::GET
            | static::HEAD
            | static::POST
            | static::PUT
            | static::DELETE
            | static::CONNECT
            | static::OPTIONS
            | static::TRACE
            | static::PATCH
            | static::console();
    }

    public static function web(): int
    {
        return static::GET
            | static::HEAD
            | static::POST
            | static::PUT
            | static::DELETE
            | static::CONNECT
            | static::OPTIONS
            | static::TRACE
            | static::PATCH;
    }

    public static function console(): int
    {
        return 512;
    }

    public static function extract(string $methodName): ?int
    {
        $constName = self::class . '::' . $methodName;

        return defined($constName) ? constant($constName) : null;
    }
}
