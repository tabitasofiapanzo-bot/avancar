<?php

// Autoloader simples para carregar as classes do core, models e controllers
spl_autoload_register(function ($class) {
    // Converte o namespace para o caminho do diretório (PSR-4-like)
    // Ex: Controllers\Home -> controllers/Home.php
    $class_path = BASE_PATH . '/' . str_replace('\\', '/', lcfirst($class)) . '.php';

    if (file_exists($class_path)) {
        require_once $class_path;
    }
});
