<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avançar - Organização Pessoal</title>

    <!-- Dependências Externas (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Recursos Locais -->
    <link rel="stylesheet" href="/resource/css/app.css">
</head>
<body>

    <div class="container-aplicacao">
        <!-- MENU LATERAL -->
        <?php include_once __DIR__ . '/../partials/_menu_lateral.php'; ?>

        <!-- CONTEÚDO PRINCIPAL -->
        <div class="conteudo-principal">
            <?php include_once __DIR__ . '/../partials/_cabecalho.php'; ?>

            <main class="container-pagina" id="container-pagina">
                <?= $conteudo ?? '' ?>
            </main>

            <?php include_once __DIR__ . '/../partials/_rodape.php'; ?>
        </div>
    </div>

    <!-- MODAIS -->
    <?php include_once __DIR__ . '/../partials/_modal_pilar.php'; ?>
    <?php include_once __DIR__ . '/../partials/_modal_meta.php'; ?>
    <?php include_once __DIR__ . '/../partials/_modal_tarefa.php'; ?>
    <?php include_once __DIR__ . '/../partials/_modal_onboarding.php'; ?>
    <?php include_once __DIR__ . '/../partials/_modal_edicao_item.php'; ?>

    <!-- Scripts Locais -->
    <script src="/resource/js/app.js"></script>
</body>
</html>
