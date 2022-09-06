<?php

declare(strict_types=1);

spl_autoload_register(function (string $className) {
    if (strpos($className, 'App\\') === 0) {
        $file = __DIR__ . '/' . str_replace('\\', '/', substr($className, 4)) . '.php';

        if (file_exists($file)) {
            require $file;
        }
    }
});
