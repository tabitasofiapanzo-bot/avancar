<?php

// Define o caminho base da aplicação
define('BASE_PATH', dirname(__DIR__));

// Autoloader simples para carregar as classes do core, models e controllers
spl_autoload_register(function ($class) {
    // Converte o namespace para o caminho do diretório
    $class_path = BASE_PATH . '/' . str_replace('\\', '/', lcfirst($class)) . '.php';
    if (file_exists($class_path)) {
        require_once $class_path;
    }
});

// Futuramente, carregaremos configurações e inicializaremos serviços aqui.

// Instancia a classe principal da aplicação para iniciar o processo de roteamento.
$app = new App();
$app->run();
