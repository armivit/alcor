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
    const ANY = 511;

    public static function extract(string $const): int
    {
        return constant(static::class . '::' . $const);
    }
}
