<div class="cabecalho-pagina">
    <h1>Relatórios e Análises</h1>
    <div><button class="btn btn-primario" data-acao="exportar-relatorio"><i class="fas fa-download"></i> Exportar Relatório</button></div>
</div>
<div class="card">
    <div class="card-header">
        <h3><i class="fas fa-filter"></i> Filtros do Relatório</h3>
    </div>
    <div class="card-body">
        <div class="grid grid-3">
            <div class="campo-grupo">
                <label class="campo-label">Período</label>
                <select class="campo-select" id="filtro-relatorio-periodo">
                    <option value="7d">Últimos 7 dias</option>
                    <option value="30d" selected="">Últimos 30 dias</option>
                    <option value="mes_atual">Este Mês</option>
                    <option value="mes_passado">Mês Passado</option>
                </select>
            </div>
            <div class="campo-grupo">
                <label class="campo-label">Pilar</label>
                <select class="campo-select" id="filtro-relatorio-pilar">
                    <option value="todos">Todos os Pilares</option>
                    <option value="1">Saúde</option>
                    <option value="2">Educação</option>
                    <option value="3">Finanças</option>
                    <option value="4">Espiritualidade</option>
                    <option value="5">Global/Básico</option>
                </select>
            </div>
            <div class="campo-grupo">
                <label class="campo-label">Tipo de Relatório</label>
                <select class="campo-select" id="filtro-relatorio-tipo">
                    <option value="produtividade">Produtividade Geral</option>
                    <option value="padroes">Análise de Padrões</option>
                    <option value="balanco">Balanço de Pilares</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="card mt-lg">
        <div class="card-header">
        <h3 id="relatorio-titulo"><i class="fas fa-chart-bar"></i> Visualização do Relatório</h3>
    </div>
    <div class="card-body">
            <div class="grid grid-3" id="relatorio-sumario">
                <!-- O sumário será injetado aqui pelo JS -->
            </div>
        <canvas id="grafico-relatorio-produtividade" style="margin-top:20px;"></canvas>
    </div>
        <div class="card-footer" style="justify-content:space-between; align-items:center;">
        <p id="relatorio-data-geracao" style="font-size:0.9rem; color: var(--cor-texto-terciario)"></p>
        </div>
</div>
