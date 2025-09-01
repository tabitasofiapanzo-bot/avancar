<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avançar - Autenticação</title>

    <!-- Dependências Externas (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Recursos Locais -->
    <link rel="stylesheet" href="/resource/css/app.css">

    <style>
        /* Estilos específicos para a página de autenticação */
        .auth-container {
            display: flex;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }
        .auth-branding {
            width: 50%;
            background-color: var(--cor-fundo-secundario);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            color: var(--cor-texto-principal);
        }
        .auth-branding h1 {
            font-size: 3rem;
            margin-bottom: 16px;
        }
        .auth-branding .logo {
            font-size: 4rem;
            color: var(--cor-primaria);
            margin-bottom: 24px;
        }
        .auth-form-container {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }
        .auth-form {
            width: 100%;
            max-width: 400px;
        }
        .auth-form h2 {
            margin-bottom: 24px;
            text-align: center;
        }
        .campo-grupo input {
            padding-left: 40px;
        }
        .campo-icone {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--cor-texto-terciario);
        }
        .campo-grupo {
            position: relative;
        }
        @media (max-width: 768px) {
            .auth-branding {
                display: none;
            }
            .auth-form-container {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="auth-container">
        <div class="auth-branding">
            <i class="fas fa-rocket logo"></i>
            <h1>Avançar</h1>
            <p>Transformando ideias em progresso.</p>
        </div>
        <div class="auth-form-container">
            <!-- O conteúdo do formulário (login ou registo) será injetado aqui -->
            <?= $conteudo ?? '' ?>
        </div>
    </div>

    <!-- Scripts Locais -->
    <script src="/resource/js/app.js"></script>
</body>
</html>
