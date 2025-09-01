<?php

// Classe para gerir as rotas da aplicação.
class Roteador {
    protected $rotas = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Carrega um arquivo de rotas.
     * @param string $arquivo O caminho para o arquivo de rotas.
     * @return static
     */
    public static function carregar($arquivo) {
        $roteador = new static;
        require $arquivo;
        return $roteador;
    }

    /**
     * Define uma rota GET.
     * @param string $uri
     * @param string $acao Controller@method
     */
    public function get($uri, $acao) {
        $this->rotas['GET'][$uri] = $acao;
    }

    /**
     * Define uma rota POST.
     * @param string $uri
     * @param string $acao Controller@method
     */
    public function post($uri, $acao) {
        $this->rotas['POST'][$uri] = $acao;
    }

    /**
     * Despacha a requisição para o controlador e método apropriados.
     * @param string $uri
     * @param string $metodoRequest
     */
    public function despachar($uri, $metodoRequest) {
        if (array_key_exists($uri, $this->rotas[$metodoRequest])) {
            $acao = $this->rotas[$metodoRequest][$uri];
            return $this->chamarAcao(...explode('@', $acao));
        }

        // Lançar uma exceção ou chamar um método de erro 404
        throw new Exception("Nenhuma rota definida para esta URI: {$uri}");
    }

    /**
     * Chama a ação do controlador.
     * @param string $controlador
     * @param string $metodo
     * @return mixed
     */
    protected function chamarAcao($controlador, $metodo) {
        $nomeControlador = "{$controlador}";

        if (!class_exists($nomeControlador)) {
            throw new Exception("Controlador '{$nomeControlador}' não encontrado.");
        }

        $controladorInstancia = new $nomeControlador;

        if (!method_exists($controladorInstancia, $metodo)) {
            throw new Exception("Método '{$metodo}' não encontrado no controlador '{$nomeControlador}'.");
        }

        return $controladorInstancia->$metodo();
    }
}
