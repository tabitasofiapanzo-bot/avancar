<div class="cabecalho-pagina">
    <h1>Página do Dia</h1>
    <div><button class="btn btn-primario" data-acao="abrir-modal" data-modal-id="modal-tarefa"><i class="fas fa-plus"></i> Nova Tarefa para Hoje</button></div>
</div>
<div id="conteudo-especifico">
    <div class="container-dia">
        <div class="secao-dia">
            <h3><i class="fas fa-clock"></i> Horário Marcado</h3>
            <ul class="lista-tarefas">
                <li class="item-tarefa" style="border-left-color: #2196f3;">
                    <input type="checkbox" class="checkbox-tarefa" data-acao="alternar-tarefa" data-id="3">
                    <div class="info-tarefa">
                        <div class="titulo-tarefa">Reunião do projeto</div>
                        <div class="detalhes-tarefa">Módulo 1-5</div>
                    </div>
                    <div class="horario-tarefa">
                        <span>14:30</span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="secao-dia">
            <h3><i class="fas fa-sun"></i> Manhã</h3>
            <ul class="lista-tarefas">
                <li class="item-tarefa" style="border-left-color: #2196f3;">
                    <input type="checkbox" class="checkbox-tarefa" data-acao="alternar-tarefa" data-id="1">
                    <div class="info-tarefa">
                        <div class="titulo-tarefa">Correr 20 minutos</div>
                        <div class="detalhes-tarefa">Correr 2km</div>
                    </div>
                    <div class="horario-tarefa">
                    </div>
                </li>
            </ul>
        </div>
        <div class="secao-dia">
            <h3><i class="fas fa-moon"></i> Noite</h3>
            <ul class="lista-tarefas">
                <li class="item-tarefa concluida" style="border-left-color: #2196f3;">
                    <input type="checkbox" class="checkbox-tarefa" data-acao="alternar-tarefa" data-id="2" checked="">
                    <div class="info-tarefa">
                        <div class="titulo-tarefa">Estudar Módulo 5</div>
                        <div class="detalhes-tarefa">Módulo 1-5</div>
                    </div>
                    <div class="horario-tarefa">
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
