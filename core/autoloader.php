<?php

spl_autoload_register(function ($className) {
    // Lista de diretórios onde as classes podem ser encontradas
    $directories = [
        'core',
        'controllers',
        'models'
    ];

    foreach ($directories as $dir) {
        $file = BASE_PATH . "/{$dir}/{$className}.php";
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
