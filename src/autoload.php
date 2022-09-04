<?php

declare(strict_types=1);

/**
 * @see https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader-examples.md
 */
spl_autoload_register(function ($className) {
    $prefix = 'App\\';
    $length = strlen($prefix);

    if (strncmp($prefix, $className, $length) !== 0) {
        return;
    }

    $relativeClass = substr($className, $length);
    $file = __DIR__ . '/' . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});
