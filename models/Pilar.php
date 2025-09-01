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

    /**
     * Cria um novo pilar no banco de dados.
     *
     * @param array $dados Os dados do pilar.
     * @return bool
     */
    public function criar($dados) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO {$this->tabela} (usuario_id, nome, descricao, cor, obrigatorio)
             VALUES (:usuario_id, :nome, :descricao, :cor, :obrigatorio)"
        );

        return $stmt->execute([
            'usuario_id' => $dados['usuario_id'],
            'nome' => $dados['nome'],
            'descricao' => $dados['descricao'],
            'cor' => $dados['cor'],
            'obrigatorio' => $dados['obrigatorio'],
        ]);
    }
}
