<?php

// Classe para gerir as rotas da aplicação.
class Roteador {
    protected $rotas = [];
    protected $controlador = 'PaginasController'; // Controlador padrão
    protected $metodo = 'index'; // Método padrão
    protected $parametros = [];

    public function __construct() {
        $this->parseUrl();
    }

    /**
     * Adiciona uma rota ao roteador.
     *
     * @param string $uri A URI da rota (ex: '/usuarios/:id').
     * @param string $acao A ação do controlador (ex: 'UsuariosController@mostrar').
     */
    public function adicionarRota($uri, $acao) {
        $this->rotas[$uri] = $acao;
    }

    /**
     * Analisa a URL para determinar o controlador, método e parâmetros.
     */
    public function parseUrl() {
        $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url_parts = explode('/', $url);

        // Determina o controlador
        if (!empty($url_parts[0])) {
            $nomeControlador = ucfirst($url_parts[0]) . 'Controller';
            if (file_exists(BASE_PATH . '/controllers/' . $nomeControlador . '.php')) {
                $this->controlador = $nomeControlador;
                unset($url_parts[0]);
            }
        }

        // Inclui e instancia o controlador
        require_once BASE_PATH . '/controllers/' . $this->controlador . '.php';
        $this->controlador = new $this->controlador;

        // Determina o método
        if (isset($url_parts[1])) {
            if (method_exists($this->controlador, $url_parts[1])) {
                $this->metodo = $url_parts[1];
                unset($url_parts[1]);
            }
        }

        // Obtém os parâmetros
        $this->parametros = $url_parts ? array_values($url_parts) : [];
    }

    /**
     * Despacha a requisição para o controlador e método apropriados.
     */
    public function despachar() {
        call_user_func_array([$this->controlador, $this->metodo], $this->parametros);
    }
}
