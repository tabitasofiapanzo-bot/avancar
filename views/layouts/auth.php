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
    <link rel="stylesheet" href="<?= $config['base_url'] ?>/resource/css/auth.css">
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
    <script src="<?= $config['base_url'] ?>/resource/js/auth.js"></script>
</body>
</html>
