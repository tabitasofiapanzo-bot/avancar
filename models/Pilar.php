<?php

class Pilar extends Modelo {
    protected $tabela = 'pilar';

    /**
     * Busca todos os pilares de um usuário específico.
     *
     * @param int $usuario_id O ID do usuário.
     * @return array
     */
    public function buscarPorUsuario($usuario_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->tabela} WHERE usuario_id = :usuario_id ORDER BY id");
        $stmt->execute(['usuario_id' => $usuario_id]);
        return $stmt->fetchAll();
    }
}
