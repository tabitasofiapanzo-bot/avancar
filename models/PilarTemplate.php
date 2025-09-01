<?php

class PilarTemplate extends Modelo {
    protected $tabela = 'pilar_template';

    /**
     * Busca todos os templates de pilar que são obrigatórios.
     * @return array
     */
    public function buscarObrigatorios() {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->tabela} WHERE obrigatorio = 1");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Busca todos os templates de pilar que são opcionais.
     * @return array
     */
    public function buscarOpcionais() {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->tabela} WHERE obrigatorio = 0");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
