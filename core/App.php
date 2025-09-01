<?php

// Classe principal da aplicação que gerencia o roteamento.
class App {
    private $roteador;

    public function __construct() {
        $this->roteador = new Roteador();
        $this->carregarRotas();
    }

    /**
     * Carrega as rotas definidas no arquivo de configuração.
     */
    private function carregarRotas() {
        $rotas = require BASE_PATH . '/config/rotas.php';
        foreach ($rotas as $uri => $acao) {
            $this->roteador->adicionarRota($uri, $acao);
        }
    }

    /**
     * Executa a aplicação.
     */
    public function run() {
        $this->roteador->despachar();
    }
}
