<?php

declare(strict_types=1);

namespace App;

class ConsoleRequest extends Request
{
    const PATH_PREFIX = '--';
    const PATH_DELIMITER = '-';

    public function __construct(string ...$argv)
    {
        $this->method = static::extractMethod($argv);
        $this->path = static::extractPath($argv);
        var_dump($this);
    }

    protected function extractMethod(array $argv): int
    {
        $options = [
            '-GET',
            '-HEAD',
            '-POST',
            '-PUT',
            '-DELETE',
            '-CONNECT',
            '-OPTIONS',
            '-TRACE',
            '-PATCH',
        ];

        foreach ($argv as $arg) {
            if (in_array($arg, $options, true)) {
                return RequestMethod::extract(substr($arg, 1));
            }
        }

        return RequestMethod::console();
    }

    protected function extractPath(array $argv): array
    {
        foreach ($argv as $arg) {
            if (strpos($arg, static::PATH_PREFIX) === 0) {
                return explode(static::PATH_DELIMITER, substr($arg, strlen(static::PATH_PREFIX)));
            }
        }

        return [];
    }
}
