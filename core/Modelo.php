<?php

// Classe base para todos os modelos da aplicação.
abstract class Modelo {
    protected $pdo;
    protected $tabela; // A ser definida por cada modelo filho

    public function __construct() {
        $this->pdo = Conexao::getInstancia();
    }

    /**
     * Busca todos os registros de uma tabela.
     *
     * @return array
     */
    public function buscarTodos() {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->tabela}");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Busca um registro pelo ID.
     *
     * @param int $id
     * @return mixed
     */
    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->tabela} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Futuramente, podemos adicionar métodos genéricos de CRUD aqui (criar, atualizar, deletar).
}
