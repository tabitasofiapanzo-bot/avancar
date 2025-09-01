<?php

class PilarUsuario extends Modelo {
    protected $tabela = 'pilar_usuario';

    /**
     * Cria uma associação entre um usuário e um pilar template.
     *
     * @param int $usuario_id
     * @param int $pilar_template_id
     * @return bool
     */
    public function criar($usuario_id, $pilar_template_id) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO {$this->tabela} (usuario_id, pilar_template_id) VALUES (:usuario_id, :pilar_template_id)"
        );

        return $stmt->execute([
            'usuario_id' => $usuario_id,
            'pilar_template_id' => $pilar_template_id
        ]);
    }

    /**
     * Busca todos os pilares de um usuário, juntando com os dados do template.
     *
     * @param int $usuario_id
     * @return array
     */
    public function buscarPilaresPorUsuario($usuario_id) {
        $sql = "SELECT
                    pu.id,
                    pt.nome,
                    pt.descricao,
                    pt.cor,
                    pt.obrigatorio
                FROM
                    {$this->tabela} pu
                JOIN
                    pilar_template pt ON pu.pilar_template_id = pt.id
                WHERE
                    pu.usuario_id = :usuario_id
                ORDER BY
                    pt.id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['usuario_id' => $usuario_id]);
        return $stmt->fetchAll();
    }
}
