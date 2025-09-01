<?php

class Tarefa extends Modelo {
    protected $tabela = 'tarefa';

    /**
     * Cria uma nova tarefa no banco de dados.
     *
     * @param array $dados Os dados da tarefa.
     * @return bool
     */
    public function criar($dados) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO {$this->tabela} (micrometa_id, usuario_id, nome, data, tipo, horario, concluida)
             VALUES (:micrometa_id, :usuario_id, :nome, :data, :tipo, :horario, :concluida)"
        );

        return $stmt->execute([
            'micrometa_id' => $dados['micrometa_id'],
            'usuario_id' => $dados['usuario_id'],
            'nome' => $dados['nome'],
            'data' => $dados['data'],
            'tipo' => $dados['tipo'],
            'horario' => $dados['horario'] ?? null,
            'concluida' => $dados['concluida'] ?? false,
        ]);
    }
}
