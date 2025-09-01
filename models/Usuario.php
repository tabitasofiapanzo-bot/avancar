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

    public function buscarPorEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->tabela} WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function criar($dados) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO {$this->tabela} (nome, email, senha) VALUES (:nome, :email, :senha)"
        );

        $sucesso = $stmt->execute([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'senha' => $dados['senha'],
        ]);

        return $sucesso ? $this->pdo->lastInsertId() : false;
    }
}
