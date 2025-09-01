<?php

class PaginasController extends Controlador {

    /**
     * Carrega a página inicial (dashboard).
     */
    public function index() {
        // Por enquanto, apenas carrega a visão estática do dashboard.
        // No futuro, buscaria dados dinâmicos.
        $this->carregarVisao('dashboard');
    }
}
