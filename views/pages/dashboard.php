<div class="cabecalho-pagina">
    <h1>Dashboard</h1>
    <div><!-- Ações do cabeçalho podem ser inseridas aqui --></div>
</div>
<div id="conteudo-especifico">
    <div class="grid grid-2">
        <!-- Coluna Esquerda -->
        <div>
            <div class="card">
                <div class="card-header"><h3><i class="fas fa-sun"></i> Resumo do Dia</h3></div>
                <div class="card-body">
                    <p>Você concluiu <strong>1 de 3</strong> tarefas hoje.</p>
                    <div class="progresso-barra"><div style="width:33.3%;"></div></div>
                </div>
            </div>
            <div class="card mt-lg">
                <div class="card-header"><h3><i class="fas fa-tasks"></i> Tarefas de Hoje</h3></div>
                <div class="card-body" style="padding: 0;">
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
                        <li class="item-tarefa concluida" style="border-left-color: #2196f3;">
                            <input type="checkbox" class="checkbox-tarefa" data-acao="alternar-tarefa" data-id="2" checked="">
                            <div class="info-tarefa">
                                <div class="titulo-tarefa">Estudar Módulo 5</div>
                                <div class="detalhes-tarefa">Módulo 1-5</div>
                            </div>
                            <div class="horario-tarefa">
                            </div>
                        </li>
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
            </div>
        </div>
        <!-- Coluna Direita -->
        <div>
                <div class="card">
                <div class="card-header"><h3><i class="fas fa-exclamation-triangle"></i> Metas Urgentes</h3></div>
                <div class="card-body">
                    <p>Nenhuma meta urgente no momento.</p> <!-- Lógica a ser implementada -->
                </div>
            </div>
            <div class="card mt-lg">
                <div class="card-header"><h3><i class="fas fa-stream"></i> Progresso dos Pilares</h3></div>
                <div class="card-body">
                        <canvas id="grafico-pilares-donut"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
