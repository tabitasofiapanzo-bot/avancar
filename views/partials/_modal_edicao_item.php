<div id="modal-edicao-item" class="modal">
    <div class="modal-conteudo" style="max-width: 400px;">
        <div class="modal-header">
            <h2 id="modal-edicao-titulo">Editar Item</h2>
            <button class="btn btn-icone btn-fechar-modal" data-modal-id="modal-edicao-item"><i class="fas fa-times"></i></button>
        </div>
        <form id="formulario-edicao-item">
            <input type="hidden" id="edicao-item-id">
            <input type="hidden" id="edicao-item-tipo">
            <div class="campo-grupo">
                <label for="edicao-item-nome" class="campo-label"><i class="fas fa-pencil-alt"></i> Nome</label>
                <input type="text" id="edicao-item-nome" class="campo-input" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secundario btn-fechar-modal" data-modal-id="modal-edicao-item">Cancelar</button>
                <button type="submit" class="btn btn-primario"><i class="fas fa-save"></i> Salvar</button>
            </div>
        </form>
    </div>
</div>
