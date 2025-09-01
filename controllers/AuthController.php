<?php

class AuthController extends Controlador {
    private $usuarioModelo;

    public function __construct() {
        $this->usuarioModelo = $this->carregarModelo('Usuario');
    }

    /**
     * Exibe a página de login.
     */
    public function login() {
        $this->carregarVisaoAuth('login');
    }

    /**
     * Exibe a página de registo.
     */
    public function registo() {
        $this->carregarVisaoAuth('registo');
    }

    /**
     * Processa a submissão do formulário de login.
     */
    public function processarLogin() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit;
        }

        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        if (empty($email) || empty($senha)) {
            die('Todos os campos são obrigatórios.');
        }

        $usuario = $this->usuarioModelo->buscarPorEmail($email);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            session_start();
            $_SESSION['usuario_id'] = $usuario['id'];
            header('Location: /');
            exit;
        } else {
            // Adicionar flash message de erro
            die('Email ou senha inválidos.');
        }
    }

    /**
     * Processa a submissão do formulário de registo.
     */
    public function processarRegisto() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /registo');
            exit;
        }

        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $confirmar_senha = $_POST['confirmar_senha'] ?? '';

        // Validações
        if (empty($nome) || empty($email) || empty($senha)) {
            // Adicionar mensagem de erro na sessão (flash message)
            die('Todos os campos são obrigatórios.');
        }

        if ($senha !== $confirmar_senha) {
            die('As senhas não coincidem.');
        }

        $usuarioExistente = $this->usuarioModelo->buscarPorEmail($email);
        if ($usuarioExistente) {
            die('Este email já está em uso.');
        }

        // Criar usuário
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $novoUsuarioId = $this->usuarioModelo->criar([
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha_hash
        ]);

        if ($novoUsuarioId) {
            // Lógica para adicionar pilares padrão
            $this->criarPilaresPadrao($novoUsuarioId);

            // Iniciar sessão e redirecionar para o onboarding
            session_start();
            $_SESSION['usuario_id'] = $novoUsuarioId;
            header('Location: /onboarding');
            exit;
        } else {
            die('Ocorreu um erro ao criar a sua conta.');
        }
    }

    private function criarPilaresPadrao($usuario_id) {
        $pilarTemplateModelo = $this->carregarModelo('PilarTemplate');
        $pilarUsuarioModelo = $this->carregarModelo('PilarUsuario');

        $pilaresObrigatorios = $pilarTemplateModelo->buscarObrigatorios();

        foreach ($pilaresObrigatorios as $pilarTmpl) {
            $pilarUsuarioModelo->criar($usuario_id, $pilarTmpl['id']);
        }
    }

    /**
     * Efetua o logout do usuário.
     */
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /login');
        exit;
    }
}
