<?php

class Usuario extends Modelo {
    protected $tabela = 'usuario';

    /**
     * Marca o onboarding de um usuário como concluído.
     *
     * @param int $id O ID do usuário.
     * @return bool
     */
    public function marcarOnboardingConcluido($id) {
        $stmt = $this->pdo->prepare(
            "UPDATE {$this->tabela} SET onboarding_concluido = 1 WHERE id = :id"
        );

        return $stmt->execute(['id' => $id]);
    }
}
