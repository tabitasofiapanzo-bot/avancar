<?php

// Classe para gerir a conexão com a base de dados usando o padrão Singleton
class Conexao {
    private static $instancia;

    // Impede a criação de instâncias diretas
    private function __construct() {}

    // Impede a clonagem da instância
    private function __clone() {}

    // Impede a desserialização da instância
    public function __wakeup() {}

    /**
     * Retorna a instância única da conexão PDO.
     *
     * @return PDO
     */
    public static function getInstancia() {
        if (self::$instancia === null) {
            $config = require BASE_PATH . '/config/conexao.php';

            try {
                $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";

                self::$instancia = new PDO($dsn, $config['user'], $config['password'], [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);

            } catch (PDOException $e) {
                // Em um ambiente de produção, logaríamos o erro em vez de exibi-lo
                die("Erro de conexão com a base de dados: " . $e->getMessage());
            }
        }
        return self::$instancia;
    }
}
