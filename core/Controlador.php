<?php

// Classe base para todos os controladores da aplicação.
abstract class Controlador {

    /**
     * Carrega um modelo.
     *
     * @param string $nomeModelo O nome do modelo a ser carregado.
     * @return object A instância do modelo.
     */
    protected function carregarModelo($nomeModelo) {
        $caminhoModelo = BASE_PATH . '/models/' . $nomeModelo . '.php';
        if (file_exists($caminhoModelo)) {
            // Não precisa de require_once por causa do autoloader
            return new $nomeModelo();
        } else {
            die("Erro: Modelo '{$nomeModelo}' não encontrado.");
        }
    }

    /**
     * Carrega e renderiza uma visão, passando dados para ela.
     *
     * @param string $nomeVisao O nome do arquivo da visão (sem .php).
     * @param array $dados Dados a serem extraídos e disponibilizados para a visão.
     */
    protected function carregarVisao($nomeVisao, $dados = []) {
        $caminhoVisao = BASE_PATH . '/views/pages/' . $nomeVisao . '.php';
        if (file_exists($caminhoVisao)) {
            // Extrai os dados para que possam ser usados como variáveis na visão
            extract($dados);

            // Inicia o buffer de saída para capturar o conteúdo da visão
            ob_start();
            require $caminhoVisao;
            $conteudo = ob_get_clean();

            // Inclui o layout principal, que usará a variável $conteudo
            require_once BASE_PATH . '/views/layouts/app.php';
        } else {
            die("Erro: Visão '{$nomeVisao}' não encontrada.");
        }
    }

     /**
     * Carrega uma visão parcial (um fragmento de HTML).
     *
     * @param string $nomeVisao O nome do arquivo da visão parcial.
     * @param array $dados Dados a serem extraídos.
     */
    protected function carregarVisaoParcial($nomeVisao, $dados = []) {
        $caminhoVisao = BASE_PATH . '/views/partials/' . $nomeVisao . '.php';
        if (file_exists($caminhoVisao)) {
            extract($dados);
            require $caminhoVisao;
        } else {
            die("Erro: Visão parcial '{$nomeVisao}' não encontrada.");
        }
    }
}
