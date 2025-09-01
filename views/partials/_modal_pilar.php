<div id="modal-pilar" class="modal">
    <div class="modal-conteudo">
        <div class="modal-header">
            <h2 id="modal-pilar-titulo">Novo Pilar</h2>
            <button class="btn btn-icone btn-fechar-modal" data-modal-id="modal-pilar"><i class="fas fa-times"></i></button>
        </div>
        <form id="formulario-pilar">
            <input type="hidden" id="pilar-id">
            <div class="campo-grupo">
                <label for="pilar-nome" class="campo-label"><i class="fas fa-stream"></i> Nome do Pilar</label>
                <input type="text" id="pilar-nome" class="campo-input" required>
            </div>
            <div class="campo-grupo">
                <label for="pilar-descricao" class="campo-label"><i class="fas fa-align-left"></i> Descrição</label>
                <textarea id="pilar-descricao" class="campo-textarea"></textarea>
            </div>
            <div class="campo-grupo">
                <label for="pilar-cor" class="campo-label"><i class="fas fa-palette"></i> Cor</label>
                <input type="color" id="pilar-cor" class="campo-input" value="#6b46c1" style="padding: 5px; height: 45px;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secundario btn-fechar-modal" data-modal-id="modal-pilar">Cancelar</button>
                <button type="submit" class="btn btn-primario"><i class="fas fa-save"></i> Salvar Pilar</button>
            </div>
        </form>
    </div>
</div>
