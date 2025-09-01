<div id="modal-tarefa" class="modal">
    <div class="modal-conteudo">
        <div class="modal-header">
            <h2 id="modal-tarefa-titulo">Nova Tarefa</h2>
            <button class="btn btn-icone btn-fechar-modal" data-modal-id="modal-tarefa"><i class="fas fa-times"></i></button>
        </div>
        <form id="formulario-tarefa">
            <input type="hidden" id="tarefa-id">
            <div class="campo-grupo">
                <label for="tarefa-nome" class="campo-label"><i class="fas fa-pencil-alt"></i> Nome da Tarefa</label>
                <input type="text" id="tarefa-nome" class="campo-input" required>
            </div>
            <div class="campo-grupo">
                <label for="tarefa-micrometa" class="campo-label"><i class="fas fa-check-double"></i> Micro-meta Associada</label>
                <select id="tarefa-micrometa" class="campo-select" required></select>
            </div>
            <div class="campo-grupo-horizontal">
                <div class="campo-grupo">
                    <label for="tarefa-data" class="campo-label"><i class="fas fa-calendar-day"></i> Data</label>
                    <input type="date" id="tarefa-data" class="campo-input" required>
                </div>
                <div class="campo-grupo">
                    <label for="tarefa-tipo" class="campo-label"><i class="fas fa-clock"></i> Tipo Temporal</label>
                    <select id="tarefa-tipo" class="campo-select">
                        <option value="arbitraria">Arbitrária</option>
                        <option value="manha">Manhã</option>
                        <option value="tarde">Tarde</option>
                        <option value="noite">Noite</option>
                        <option value="horario">Horário Fixo</option>
                    </select>
                </div>
            </div>
            <div id="campo-horario-fixo" class="campo-grupo display-none">
                <label for="tarefa-horario" class="campo-label">Horário</label>
                <input type="time" id="tarefa-horario" class="campo-input">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secundario btn-fechar-modal" data-modal-id="modal-tarefa">Cancelar</button>
                <button type="submit" class="btn btn-primario"><i class="fas fa-save"></i> Salvar Tarefa</button>
            </div>
        </form>
    </div>
</div>
