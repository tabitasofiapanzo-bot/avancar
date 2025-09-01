<?php

class PilaresController extends Controlador {
    private $pilarUsuarioModelo;

    public function __construct() {
        $this->pilarUsuarioModelo = $this->carregarModelo('PilarUsuario');
    }

    /**
     * Exibe a página de pilares com dados do banco de dados.
     */
    public function index() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /login');
            exit;
        }
        $usuario_id = $_SESSION['usuario_id'];

        $pilares = $this->pilarUsuarioModelo->buscarPilaresPorUsuario($usuario_id);

        $dados = [
            'pilares' => $pilares
        ];

        $this->carregarVisao('pilares', $dados);
    }
}
