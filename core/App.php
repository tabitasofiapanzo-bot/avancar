<?php

// Classe principal da aplicação que gerencia o roteamento.
class App {
    protected $roteador;

    public function __construct() {
        $this->roteador = Roteador::carregar(BASE_PATH . '/config/rotas.php');
    }

    /**
     * Executa a aplicação, despachando a rota correspondente à URI e ao método da requisição.
     */
    public function run() {
        try {
            // Obtém a URI a partir do parâmetro 'url' fornecido pelo .htaccess
            $uri = '/' . ($_GET['url'] ?? '');

            // Remove a barra final, exceto se for a rota raiz
            if ($uri !== '/') {
                $uri = rtrim($uri, '/');
            }

            $metodo = $_SERVER['REQUEST_METHOD'];

            $this->roteador->despachar($uri, $metodo);
        } catch (Exception $e) {
            // Em ambiente de produção, logar o erro
            http_response_code(404);
            // Carregar uma view de 404
            require BASE_PATH . '/views/pages/404.php';
        }
    }
}
