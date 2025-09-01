<div class="cabecalho-pagina">
    <h1>Pilares</h1>
    <div><button class="btn btn-primario" data-acao="abrir-modal" data-modal-id="modal-pilar"><i class="fas fa-plus"></i> Novo Pilar</button></div>
</div>
<div class="grid grid-3" id="container-pilares">
    <?php if (empty($pilares)): ?>
        <p>Nenhum pilar encontrado. Comece a criar os seus!</p>
    <?php else: ?>
        <?php foreach ($pilares as $pilar): ?>
            <div class="card card-pilar" style="border-left-color: <?= htmlspecialchars($pilar['cor']); ?>;">
                <div class="card-header">
                    <h3><i class="fas fa-stream"></i> <?= htmlspecialchars($pilar['nome']); ?></h3>
                    <div class="card-acoes">
                        <?php if ($pilar['obrigatorio']): ?>
                            <i class="fas fa-lock" title="Pilar obrigatório"></i>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <p><?= htmlspecialchars($pilar['descricao'] ?: 'Sem descrição.'); ?></p>
                    <h4>Categorias:</h4>
                    <ul class="lista-sub-item">
                        <!-- A lógica para buscar e exibir categorias virá depois -->
                        <p style="font-size:0.9rem; color: var(--cor-texto-terciario);">Nenhuma categoria.</p>
                    </ul>
                    <form class="form-add-subitem" data-acao="add-categoria" data-pilar-id="<?= $pilar['id']; ?>">
                        <input type="text" class="campo-input" placeholder="Nova categoria..." required>
                        <button type="submit" class="btn btn-primario btn-pequeno"><i class="fas fa-plus"></i></button>
                    </form>
                </div>
                <div class="card-footer">
                    <button class="btn btn-secundario btn-pequeno" data-acao="editar-pilar" data-id="<?= $pilar['id']; ?>"><i class="fas fa-edit"></i> Editar</button>
                    <?php if (!$pilar['obrigatorio']): ?>
                        <button class="btn btn-perigo btn-pequeno" data-acao="excluir-pilar" data-id="<?= $pilar['id']; ?>"><i class="fas fa-trash"></i> Excluir</button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
