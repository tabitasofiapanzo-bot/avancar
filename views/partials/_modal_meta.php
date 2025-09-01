<div id="modal-meta" class="modal">
    <div class="modal-conteudo">
        <div class="modal-header">
            <h2 id="modal-meta-titulo">Nova Meta</h2>
            <button class="btn btn-icone btn-fechar-modal" data-modal-id="modal-meta"><i class="fas fa-times"></i></button>
        </div>
        <form id="formulario-meta">
            <input type="hidden" id="meta-id">
            <div class="campo-grupo">
                <label for="meta-nome" class="campo-label"><i class="fas fa-bullseye"></i> Nome da Meta</label>
                <input type="text" id="meta-nome" class="campo-input" required>
            </div>
                <div class="campo-grupo">
                <label for="meta-pilar" class="campo-label"><i class="fas fa-stream"></i> Pilar Associado</label>
                <select id="meta-pilar" class="campo-select" required></select>
            </div>
            <div class="campo-grupo-horizontal">
                <div class="campo-grupo">
                    <label for="meta-data-inicio" class="campo-label"><i class="fas fa-calendar-plus"></i> Data de Início</label>
                    <input type="date" id="meta-data-inicio" class="campo-input" required>
                </div>
                <div class="campo-grupo">
                    <label for="meta-data-fim" class="campo-label"><i class="fas fa-calendar-check"></i> Data de Fim</label>
                    <input type="date" id="meta-data-fim" class="campo-input" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secundario btn-fechar-modal" data-modal-id="modal-meta">Cancelar</button>
                <button type="submit" class="btn btn-primario"><i class="fas fa-save"></i> Salvar Meta</button>
            </div>
        </form>
    </div>
</div>
