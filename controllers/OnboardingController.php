<?php

class OnboardingController extends Controlador {
    private $pilarUsuarioModelo;
    private $categoriaModelo;
    private $usuarioModelo;

    public function __construct() {
        $this->pilarUsuarioModelo = $this->carregarModelo('PilarUsuario');
        $this->categoriaModelo = $this->carregarModelo('Categoria');
        $this->usuarioModelo = $this->carregarModelo('Usuario');
    }

    /**
     * Exibe a página de onboarding.
     */
    public function index() {
        $this->carregarVisao('onboarding');
    }

    /**
     * Processa os dados submetidos do formulário de onboarding.
     */
    public function salvar() {
        header('Content-Type: application/json');

        // 1. Receber e decodificar os dados JSON do POST.
        $dadosJson = file_get_contents('php://input');
        $dados = json_decode($dadosJson, true);

        // O usuário deve estar logado para acessar esta função
        if (!isset($_SESSION['usuario_id'])) {
            http_response_code(401); // Unauthorized
            echo json_encode(['sucesso' => false, 'mensagem' => 'Acesso não autorizado.']);
            return;
        }
        $usuario_id = $_SESSION['usuario_id'];

        // Validação básica dos dados
        if (empty($dados) || !isset($dados['pilaresOpcionais']) || !isset($dados['categoriasIniciais'])) {
            echo json_encode(['sucesso' => false, 'mensagem' => 'Dados inválidos ou ausentes.']);
            return;
        }

        try {
            // 3. Inserir os pilares opcionais selecionados.
            foreach ($dados['pilaresOpcionais'] as $pilar) {
                // O frontend envia o objeto pilar completo, nós só precisamos do ID do template.
                $pilar_template_id = $pilar['id'];
                $this->pilarUsuarioModelo->criar($usuario_id, $pilar_template_id);
            }

            // 4. Inserir as categorias iniciais.
            // Esta parte precisa ser repensada, pois agora precisamos do ID da *instância* do pilar do usuário.
            // Por enquanto, vamos comentar esta lógica, pois requer uma query extra para buscar os IDs recém-criados.
            /*
            foreach ($dados['categoriasIniciais'] as $categoria) {
                // TODO: Encontrar o pilar_usuario_id correspondente ao pilar_template_id e usuario_id
                // $pilar_usuario_id = ...
                $this->categoriaModelo->criar(
                    $pilar_usuario_id,
                    $categoria['nome']
                );
            }
            */

            // 5. Inserir as tarefas de rotina (a ser implementado com mais detalhes no futuro)
            // Por agora, o passo mais importante é salvar os pilares e categorias.

            // 6. Atualizar o status de onboarding do usuário.
            $this->usuarioModelo->marcarOnboardingConcluido($usuario_id);

            // 7. Retornar uma resposta JSON de sucesso.
            echo json_encode(['sucesso' => true, 'mensagem' => 'Onboarding concluído com sucesso!']);

        } catch (Exception $e) {
            // Em caso de erro, retornar uma resposta de falha.
            // Em um ambiente real, logaríamos o erro $e->getMessage().
            http_response_code(500);
            echo json_encode(['sucesso' => false, 'mensagem' => 'Ocorreu um erro no servidor ao processar o onboarding.']);
        }
    }
}
