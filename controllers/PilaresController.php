<?php

class PilaresController extends Controlador {
    private $pilarModelo;

    public function __construct() {
        $this->pilarModelo = $this->carregarModelo('Pilar');
    }

    /**
     * Exibe a página de pilares com dados do banco de dados.
     */
    public function index() {
        // ID do usuário hardcoded para fins de teste (até a implementação de autenticação)
        $usuario_id = 1;

        $pilares = $this->pilarModelo->buscarPorUsuario($usuario_id);

        $dados = [
            'pilares' => $pilares
        ];

        $this->carregarVisao('pilares', $dados);
    }
}
