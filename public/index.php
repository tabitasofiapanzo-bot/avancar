<?php

session_start();

// Define o caminho base da aplicação
define('BASE_PATH', dirname(__DIR__));

// Carrega o autoloader
require_once BASE_PATH . '/core/autoloader.php';

// Futuramente, carregaremos outros arquivos de inicialização aqui (helpers, etc).

// Instancia a classe principal da aplicação para iniciar o processo de roteamento.
$app = new App();
$app->run();
