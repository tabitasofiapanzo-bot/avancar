<?php

class PaginasController extends Controlador {
    private $pilarUsuarioModelo;

    public function __construct() {
        // Redireciona para o login se o usuário não estiver autenticado.
        if (!estaLogado()) {
            redirecionar('auth/login');
        }

        $this->pilarUsuarioModelo = $this->carregarModelo('PilarUsuario');
    }

    /**
     * Carrega a página inicial (dashboard) com os dados do usuário.
     */
    public function index() {
        $usuario_id = $_SESSION['usuario_id'];

        // Buscar os pilares que o usuário selecionou.
        $pilares = $this->pilarUsuarioModelo->buscarPilaresPorUsuario($usuario_id);

        $dados = [
            'pilares' => $pilares
        ];

        $this->carregarVisao('dashboard', $dados);
    }
}
