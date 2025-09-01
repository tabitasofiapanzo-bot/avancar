<?php

class Categoria extends Modelo {
    protected $tabela = 'categoria';

    /**
     * Cria uma nova categoria no banco de dados.
     *
     * @param int $pilar_id
     * @param string $nome
     * @return bool
     */
    public function criar($pilar_id, $nome) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO {$this->tabela} (pilar_id, nome) VALUES (:pilar_id, :nome)"
        );

        return $stmt->execute([
            'pilar_id' => $pilar_id,
            'nome' => $nome
        ]);
    }
}
