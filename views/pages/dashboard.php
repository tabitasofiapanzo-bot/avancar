<div class="cabecalho-pagina">
    <h1>Dashboard</h1>
    <div><!-- Ações do cabeçalho podem ser inseridas aqui --></div>
</div>
<div id="conteudo-especifico">
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-stream"></i> Meus Pilares</h3>
        </div>
        <div class="card-body">
            <?php if (empty($dados['pilares'])): ?>
                <p class="text-center">Você ainda não selecionou nenhum pilar. Complete o seu <a href="<?= base_url('onboarding') ?>">onboarding</a> para começar.</p>
            <?php else: ?>
                <div class="lista-pilares-dashboard">
                    <?php foreach ($dados['pilares'] as $pilar): ?>
                        <div class="pilar-item" style="border-left-color: <?= htmlspecialchars($pilar['cor']) ?>;">
                            <div class="pilar-info">
                                <h4><?= htmlspecialchars($pilar['nome']) ?></h4>
                                <p><?= htmlspecialchars($pilar['descricao']) ?></p>
                            </div>
                            <div class="pilar-progresso">
                                <!-- Lógica de progresso a ser implementada -->
                                <span class="progresso-percentagem">0%</span>
                                <div class="progresso-barra-fina">
                                    <div style="width: 0%;"></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="grid grid-2 mt-lg">
        <div class="card">
            <div class="card-header"><h3><i class="fas fa-tasks"></i> Próximas Tarefas</h3></div>
            <div class="card-body">
                <p class="text-center text-muted">A funcionalidade de tarefas será implementada em breve.</p>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h3><i class="fas fa-bullseye"></i> Foco da Semana</h3></div>
            <div class="card-body">
                <p class="text-center text-muted">A funcionalidade de metas será implementada em breve.</p>
            </div>
        </div>
    </div>
</div>
