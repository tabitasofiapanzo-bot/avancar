<?php

class OnboardingController extends Controlador {
    private $pilarModelo;
    private $categoriaModelo;
    private $usuarioModelo;

    public function __construct() {
        $this->pilarModelo = $this->carregarModelo('Pilar');
        $this->categoriaModelo = $this->carregarModelo('Categoria');
        $this->usuarioModelo = $this->carregarModelo('Usuario');
    }

    /**
     * Processa os dados submetidos do formulário de onboarding.
     */
    public function salvar() {
        header('Content-Type: application/json');

        // 1. Receber e decodificar os dados JSON do POST.
        $dadosJson = file_get_contents('php://input');
        $dados = json_decode($dadosJson, true);

        // Simulação de autenticação - no futuro viria da sessão
        $usuario_id = 1;

        // Validação básica dos dados
        if (empty($dados) || !isset($dados['pilaresOpcionais']) || !isset($dados['categoriasIniciais'])) {
            echo json_encode(['sucesso' => false, 'mensagem' => 'Dados inválidos ou ausentes.']);
            return;
        }

        try {
            // 3. Inserir os pilares opcionais.
            foreach ($dados['pilaresOpcionais'] as $pilar) {
                // O modelo Pilar precisa de um método criar. Vamos adicioná-lo.
                $this->pilarModelo->criar([
                    'usuario_id' => $usuario_id,
                    'nome' => $pilar['nome'],
                    'descricao' => $pilar['descricao'],
                    'cor' => $pilar['cor'],
                    'obrigatorio' => false // Opcionais são sempre não-obrigatórios
                ]);
            }

            // 4. Inserir as categorias iniciais.
            foreach ($dados['categoriasIniciais'] as $categoria) {
                $this->categoriaModelo->criar(
                    $categoria['pilarId'],
                    $categoria['nome']
                );
            }

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
