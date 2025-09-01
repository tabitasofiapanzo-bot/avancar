document.addEventListener('DOMContentLoaded', () => {

    const hoje = new Date();
    function hojeString() { return hoje.toISOString().split('T')[0]; }
    function amanhaString() { const amanha = new Date(hoje); amanha.setDate(hoje.getDate() + 1); return amanha.toISOString().split('T')[0]; }

    // ===== ESTADO DA APLICAÇÃO (Dados Mockados) =====
    const estado = {
        paginaAtual: 'dashboard',
        paginaDetalheId: null,
        mesCalendario: hoje.getMonth(), // 0-11
        anoCalendario: hoje.getFullYear(),
        onboarding: {
            etapaAtual: 1,
            pilaresSelecionados: [],
            tarefasGlobais: {},
            categoriasIniciais: {},
        },
        pilares: [
            // Obrigatórios
            { id: 1, nome: 'Saúde', descricao: 'Bem-estar físico e mental', cor: '#4caf50', obrigatorio: true },
            { id: 2, nome: 'Educação', descricao: 'Aprendizagem e desenvolvimento', cor: '#2196f3', obrigatorio: true },
            { id: 3, nome: 'Finanças', descricao: 'Gestão financeira e investimentos', cor: '#ff9800', obrigatorio: true },
            { id: 4, nome: 'Espiritualidade', descricao: 'Crescimento e conexão', cor: '#7e57c2', obrigatorio: true },
            { id: 5, nome: 'Global/Básico', descricao: 'Atividades essenciais do dia a dia', cor: '#78909c', obrigatorio: true },
        ],
        pilaresOpcionais: [
             { id: 6, nome: 'Carreira', descricao: 'Vida profissional e crescimento', cor: '#ef5350', obrigatorio: false },
             { id: 7, nome: 'Desenvolvimento Pessoal', descricao: 'Crescimento individual e habilidades', cor: '#ab47bc', obrigatorio: false },
             { id: 8, nome: 'Relacionamentos', descricao: 'Conexões sociais e amorosas', cor: '#ec407a', obrigatorio: false },
        ],
        tarefasGlobaisPredefinidas: [
            { id: 'tg-1', nome: 'Acordar', tipo: 'horario', horario: '07:00' },
            { id: 'tg-2', nome: 'Escovar os dentes (manhã)', tipo: 'manha' },
            { id: 'tg-3', nome: 'Tomar banho (manhã)', tipo: 'manha' },
            { id: 'tg-4', nome: 'Pequeno-almoço', tipo: 'horario', horario: '08:00' },
            { id: 'tg-5', nome: 'Almoço', tipo: 'horario', horario: '13:00' },
            { id: 'tg-6', nome: 'Jantar', tipo: 'horario', horario: '20:00' },
            { id: 'tg-7', nome: 'Escovar os dentes (noite)', tipo: 'noite' },
            { id: 'tg-8', nome: 'Dormir', tipo: 'horario', horario: '23:00' },
        ],
        categorias: [
            { id: 1, pilarId: 1, nome: 'Exercício Físico' },
            { id: 2, pilarId: 1, nome: 'Alimentação' },
            { id: 3, pilarId: 2, nome: 'Cursos Online' },
        ],
        subCategorias: [
            { id: 1, categoriaId: 1, nome: 'Corrida' },
            { id: 2, categoriaId: 1, nome: 'Musculação' },
        ],
        metas: [
            { id: 1, pilarId: 1, nome: 'Correr 5km sem parar', dataInicio: '2025-08-01', dataFim: '2025-10-31' },
            { id: 2, pilarId: 2, nome: 'Concluir curso de JS Avançado', dataInicio: '2025-08-15', dataFim: '2025-09-30'},
            { id: 3, pilarId: 3, nome: 'Economizar R$500', dataInicio: '2025-09-01', dataFim: '2025-09-30'}
        ],
        microMetas: [
            {id: 1, metaId: 1, nome: 'Correr 1km'},
            {id: 2, metaId: 1, nome: 'Correr 2km'},
            {id: 3, metaId: 2, nome: 'Módulo 1-5'},
        ],
        tarefas: [
            { id: 1, microMetaId: 2, nome: 'Correr 20 minutos', data: hojeString(), tipo: 'manha', horario: null, concluida: false },
            { id: 2, microMetaId: 3, nome: 'Estudar Módulo 5', data: hojeString(), tipo: 'noite', horario: null, concluida: true },
            { id: 3, microMetaId: 3, nome: 'Reunião do projeto', data: hojeString(), tipo: 'horario', horario: '14:30', concluida: false },
            { id: 4, microMetaId: 1, nome: 'Treino de fortalecimento', data: amanhaString(), tipo: 'tarde', horario: null, concluida: false },
        ]
    };

    // ===== ELEMENTOS DO DOM =====
    const containerPagina = document.getElementById('container-pagina');
    const linksNavegacao = document.querySelectorAll('.link-navegacao');
    const menuLateral = document.getElementById('menu-lateral');

    // ===== FUNÇÕES DE RENDERIZAÇÃO =====

    function renderizarPagina() {
        containerPagina.innerHTML = '';
        const nomePagina = estado.paginaAtual.charAt(0).toUpperCase() + estado.paginaAtual.slice(1);
        const acoesCabecalho = {
            pilares: `<button class="btn btn-primario" data-acao="abrir-modal" data-modal-id="modal-pilar"><i class="fas fa-plus"></i> Novo Pilar</button>`,
            metas: `<button class="btn btn-primario" data-acao="abrir-modal" data-modal-id="modal-meta"><i class="fas fa-plus"></i> Nova Meta</button>`,
            tarefas: `<button class="btn btn-primario" data-acao="abrir-modal" data-modal-id="modal-tarefa"><i class="fas fa-plus"></i> Nova Tarefa</button>`,
            dia: `<button class="btn btn-primario" data-acao="abrir-modal" data-modal-id="modal-tarefa"><i class="fas fa-plus"></i> Nova Tarefa para Hoje</button>`,
            planeamento: `<button class="btn btn-secundario" data-acao="sugestoes-planeamento"><i class="fas fa-magic"></i> Sugestões</button> <button class="btn btn-primario"><i class="fas fa-save"></i> Guardar Semana</button>`,
            relatorios: `<button class="btn btn-primario" data-acao="exportar-relatorio"><i class="fas fa-download"></i> Exportar Relatório</button>`,
        };

        const funcoesRender = {
            dashboard: renderizarDashboard,
            dia: renderizarPaginaDoDia,
            pilares: renderizarPaginaPilares,
            metas: renderizarPaginaMetas,
            tarefas: renderizarPaginaTarefas,
            calendario: renderizarPaginaCalendario,
            progresso: renderizarPaginaProgresso,
            planeamento: renderizarPaginaPlaneamento,
            relatorios: renderizarPaginaRelatorios,
            configuracoes: renderizarPaginaConfiguracoes,
            perfil: renderizarPaginaPerfil,
            categoria: renderizarPaginaDetalheCategoria,
        };

        const renderFunction = funcoesRender[estado.paginaAtual] || renderizarPaginaEmConstrucao;
        renderFunction(containerPagina, acoesCabecalho[estado.paginaAtual] || '');

        atualizarLinkAtivo();
    }

    function renderizarDashboard(container, acoes) {
        container.innerHTML = `
            <div class="cabecalho-pagina"><h1>Dashboard</h1><div>${acoes}</div></div>
            <div id="conteudo-especifico"></div>
        `;
        const conteudo = document.getElementById('conteudo-especifico');

        const tarefasHoje = estado.tarefas.filter(t => t.data === hojeString());
        const concluidasHoje = tarefasHoje.filter(t => t.concluida).length;
        const progressoHoje = tarefasHoje.length > 0 ? (concluidasHoje / tarefasHoje.length) * 100 : 0;

        conteudo.innerHTML = `
            <div class="grid grid-2">
                <!-- Coluna Esquerda -->
                <div>
                    <div class="card">
                        <div class="card-header"><h3><i class="fas fa-sun"></i> Resumo do Dia</h3></div>
                        <div class="card-body">
                            <p>Você concluiu <strong>${concluidasHoje} de ${tarefasHoje.length}</strong> tarefas hoje.</p>
                            <div class="progresso-barra"><div style="width:${progressoHoje}%;"></div></div>
                        </div>
                    </div>
                    <div class="card mt-lg">
                        <div class="card-header"><h3><i class="fas fa-tasks"></i> Tarefas de Hoje</h3></div>
                        <div class="card-body" style="padding: 0;">
                            <ul class="lista-tarefas">${tarefasHoje.length > 0 ? tarefasHoje.map(t => criarItemTarefa(t, false)).join('') : '<p class="texto-centro" style="padding: 20px;">Nenhuma tarefa para hoje. Bom descanso!</p>'}</ul>
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
        `;
        renderizarGraficoDonutPilares();
    }

    function renderizarPaginaDoDia(container, acoes) {
         container.innerHTML = `
            <div class="cabecalho-pagina"><h1>Página do Dia</h1><div>${acoes}</div></div>
            <div id="conteudo-especifico"></div>
        `;
        const conteudo = document.getElementById('conteudo-especifico');
        const tarefasDeHoje = estado.tarefas.filter(t => t.data === hojeString());
        const tarefasPorTipo = {
            horario: tarefasDeHoje.filter(t => t.tipo === 'horario').sort((a,b) => a.horario.localeCompare(b.horario)),
            manha: tarefasDeHoje.filter(t => t.tipo === 'manha'),
            tarde: tarefasDeHoje.filter(t => t.tipo === 'tarde'),
            noite: tarefasDeHoje.filter(t => t.tipo === 'noite'),
            arbitraria: tarefasDeHoje.filter(t => t.tipo === 'arbitraria')
        };

        conteudo.innerHTML = `
            <div class="container-dia">
                ${criarSecaoDia('🕐 Horário Marcado', tarefasPorTipo.horario)}
                ${criarSecaoDia('🌅 Manhã', tarefasPorTipo.manha)}
                ${criarSecaoDia('☀️ Tarde', tarefasPorTipo.tarde)}
                ${criarSecaoDia('🌙 Noite', tarefasPorTipo.noite)}
                ${criarSecaoDia('⏰ Arbitrárias', tarefasPorTipo.arbitraria)}
            </div>
        `;
    }

    function renderizarPaginaPilares(container, acoes) {
         container.innerHTML = `
            <div class="cabecalho-pagina"><h1>Pilares</h1><div>${acoes}</div></div>
            <div class="grid grid-3" id="container-pilares">
                ${estado.pilares.map(pilar => {
                    const categoriasDoPilar = estado.categorias.filter(c => c.pilarId === pilar.id);
                    return `
                    <div class="card card-pilar" style="border-left-color: ${pilar.cor};">
                        <div class="card-header">
                            <h3><i class="fas fa-stream"></i> ${pilar.nome}</h3>
                            <div class="card-acoes">
                                ${pilar.obrigatorio ? '<i class="fas fa-lock" title="Pilar obrigatório"></i>' : ''}
                            </div>
                        </div>
                        <div class="card-body">
                            <p>${pilar.descricao || 'Sem descrição.'}</p>
                            <h4>Categorias:</h4>
                            <ul class="lista-sub-item">
                                ${categoriasDoPilar.map(cat => `<li class="sub-item"><a href="#" data-acao="ver-categoria" data-id="${cat.id}">${cat.nome}</a></li>`).join('') || '<p style="font-size:0.9rem; color: var(--cor-texto-terciario);">Nenhuma categoria.</p>'}
                            </ul>
                             <form class="form-add-subitem" data-acao="add-categoria" data-pilar-id="${pilar.id}">
                                <input type="text" class="campo-input" placeholder="Nova categoria..." required>
                                <button type="submit" class="btn btn-primario btn-pequeno"><i class="fas fa-plus"></i></button>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-secundario btn-pequeno" data-acao="editar-pilar" data-id="${pilar.id}"><i class="fas fa-edit"></i> Editar</button>
                            ${!pilar.obrigatorio ? `<button class="btn btn-perigo btn-pequeno" data-acao="excluir-pilar" data-id="${pilar.id}"><i class="fas fa-trash"></i> Excluir</button>` : ''}
                        </div>
                    </div>
                `}).join('')}
            </div>
        `;
    }

    function renderizarPaginaDetalheCategoria(container) {
        const categoria = encontrarPorId(estado.categorias, estado.paginaDetalheId);
        const pilar = encontrarPorId(estado.pilares, categoria.pilarId);
        const subCategorias = estado.subCategorias.filter(sc => sc.categoriaId === categoria.id);

        container.innerHTML = `
             <div class="cabecalho-pagina">
                <div>
                    <div class="breadcrumb">
                        <a href="#" data-pagina="pilares" class="link-navegacao">Pilares</a> / <span>${pilar.nome}</span>
                    </div>
                    <h1>Categoria: ${categoria.nome}</h1>
                </div>
                <div>
                    <button class="btn btn-secundario" data-acao="editar-item" data-id="${categoria.id}" data-tipo="categoria"><i class="fas fa-edit"></i> Editar</button>
                    <button class="btn btn-perigo" data-acao="excluir-item" data-id="${categoria.id}" data-tipo="categoria"><i class="fas fa-trash"></i> Excluir</button>
                </div>
            </div>
            <div class="card">
                <div class="card-header"><h3><i class="fas fa-sitemap"></i> Subcategorias</h3></div>
                <div class="card-body">
                    <ul class="lista-sub-item">
                       ${subCategorias.map(sc => `<li class="sub-item"><span>${sc.nome}</span> <button class="btn btn-icone btn-pequeno" data-acao="excluir-item" data-id="${sc.id}" data-tipo="subcategoria"><i class="fas fa-trash"></i></button></li>`).join('') || '<p>Nenhuma subcategoria.</p>'}
                    </ul>
                     <form class="form-add-subitem" data-acao="add-subcategoria" data-categoria-id="${categoria.id}">
                        <input type="text" class="campo-input" placeholder="Nova subcategoria..." required>
                        <button type="submit" class="btn btn-primario"><i class="fas fa-plus"></i> Adicionar</button>
                    </form>
                </div>
            </div>
        `;
    }

    function renderizarPaginaMetas(container, acoes) {
        container.innerHTML = `
            <div class="cabecalho-pagina"><h1>Metas</h1><div>${acoes}</div></div>
            <div class="grid grid-3" id="container-metas">
                ${estado.metas.map(meta => {
                    const pilar = encontrarPorId(estado.pilares, meta.pilarId);
                    const microMetasDaMeta = estado.microMetas.filter(mm => mm.metaId === meta.id);
                    return `
                    <div class="card card-pilar" style="border-left-color: ${pilar ? pilar.cor : '#ccc'};">
                        <div class="card-header">
                            <h3><i class="fas fa-bullseye"></i> ${meta.nome}</h3>
                        </div>
                        <div class="card-body">
                           <p><strong><i class="fas fa-stream"></i> Pilar:</strong> ${pilar ? pilar.nome : 'N/A'}</p>
                           <p><strong><i class="fas fa-calendar-alt"></i> Prazo:</strong> ${formatarData(meta.dataInicio)} a ${formatarData(meta.dataFim)}</p>
                           <h4>Micro-metas:</h4>
                            <ul class="lista-sub-item">
                                ${microMetasDaMeta.map(mm => `<li class="sub-item"><span>${mm.nome}</span> <div> <button class="btn btn-icone btn-pequeno" data-acao="editar-item" data-id="${mm.id}" data-tipo="micrometa"><i class="fas fa-edit"></i></button> <button class="btn btn-icone btn-pequeno" data-acao="excluir-item" data-id="${mm.id}" data-tipo="micrometa"><i class="fas fa-trash"></i></button></div></li>`).join('') || '<p style="font-size:0.9rem; color: var(--cor-texto-terciario);">Nenhuma micro-meta.</p>'}
                            </ul>
                            <form class="form-add-subitem" data-acao="add-micrometa" data-meta-id="${meta.id}">
                                <input type="text" class="campo-input" placeholder="Nova micro-meta..." required>
                                <button type="submit" class="btn btn-primario btn-pequeno"><i class="fas fa-plus"></i></button>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-secundario btn-pequeno" data-acao="editar-meta" data-id="${meta.id}"><i class="fas fa-edit"></i> Editar</button>
                            <button class="btn btn-perigo btn-pequeno" data-acao="excluir-meta" data-id="${meta.id}"><i class="fas fa-trash"></i> Excluir</button>
                        </div>
                    </div>
                `}).join('')}
            </div>
        `;
    }

    function renderizarPaginaTarefas(container, acoes) {
        container.innerHTML = `
            <div class="cabecalho-pagina"><h1>Tarefas</h1><div>${acoes}</div></div>
            <div class="card">
                <div class="card-body" style="padding: 0;">
                    <ul class="lista-tarefas">
                        ${estado.tarefas.sort((a,b) => new Date(b.data) - new Date(a.data)).map(tarefa => criarItemTarefa(tarefa, true)).join('')}
                    </ul>
                </div>
            </div>
        `;
    }

    function renderizarPaginaCalendario(container, acoes) {
        const nomesMeses = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
        const primeiroDia = new Date(estado.anoCalendario, estado.mesCalendario, 1).getDay();
        const diasNoMes = new Date(estado.anoCalendario, estado.mesCalendario + 1, 0).getDate();
        const diaAtual = new Date();

        let diasHtml = '';
        for (let i = 0; i < primeiroDia; i++) {
            diasHtml += `<div class="dia-calendario outro-mes"></div>`;
        }
        for (let dia = 1; dia <= diasNoMes; dia++) {
            let classe = 'dia-calendario';
            if (dia === diaAtual.getDate() && estado.mesCalendario === diaAtual.getMonth() && estado.anoCalendario === diaAtual.getFullYear()) {
                classe += ' hoje';
            }
            if (dia === 18) classe += ' sucesso-completo';
            if (dia === 19) classe += ' sucesso-parcial';
            diasHtml += `<div class="${classe}"><span>${dia}</span></div>`;
        }

        container.innerHTML = `
            <div class="cabecalho-pagina"><h1>Calendário</h1><div>${acoes}</div></div>
            <div class="card">
                <div class="card-body">
                    <div class="cabecalho-calendario">
                        <div class="campo-grupo">
                           <select id="filtro-meta-calendario" class="campo-select">
                                <option value="">Filtrar por Meta...</option>
                           </select>
                        </div>
                        <div style="display:flex; align-items:center; gap: 10px;">
                            <button class="btn btn-icone" data-acao="mes-anterior"><i class="fas fa-chevron-left"></i></button>
                            <h3>${nomesMeses[estado.mesCalendario]} ${estado.anoCalendario}</h3>
                            <button class="btn btn-icone" data-acao="mes-seguinte"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                    <div class="grid" style="grid-template-columns: repeat(7, 1fr);">
                        <div class="header-calendario">Dom</div><div class="header-calendario">Seg</div><div class="header-calendario">Ter</div><div class="header-calendario">Qua</div><div class="header-calendario">Qui</div><div class="header-calendario">Sex</div><div class="header-calendario">Sáb</div>
                    </div>
                    <div class="container-calendario">${diasHtml}</div>
                </div>
            </div>
        `;
        preencherSelect('filtro-meta-calendario', estado.metas);
    }

    function renderizarPaginaProgresso(container, acoes) {
        container.innerHTML = `
            <div class="cabecalho-pagina"><h1>Progresso</h1><div>${acoes}</div></div>
             <div class="grid grid-2">
                <div class="card">
                    <div class="card-header"><h3><i class="fas fa-chart-line"></i> Conclusão de Tarefas (Últimos 7 dias)</h3></div>
                    <div class="card-body"><canvas id="grafico-progresso-linha"></canvas></div>
                </div>
                 <div class="card">
                    <div class="card-header"><h3><i class="fas fa-balance-scale"></i> Balanço dos Pilares</h3></div>
                    <div class="card-body"><canvas id="grafico-pilares-radar"></canvas></div>
                </div>
            </div>
        `;
        renderizarGraficoLinhaProgresso();
        renderizarGraficoRadarPilares();
    }

    function renderizarPaginaPerfil(container) {
        container.innerHTML = `
            <div class="cabecalho-pagina"><h1>Perfil</h1></div>
            <div class="card">
                <div class="card-body">
                    <div class="perfil-container">
                        <div class="perfil-avatar">
                            <img src="https://i.pravatar.cc/150?u=a042581f4e29026704d" alt="Avatar do Usuário">
                            <button class="btn btn-primario btn-pequeno">Alterar Foto</button>
                        </div>
                        <div class="perfil-info">
                            <h2>Nome do Usuário</h2>
                            <p>Email: usuario@avancar.com</p>
                            <hr style="border-color: var(--cor-bordas); margin: var(--espacamento-lg) 0;">
                            <h3>Estatísticas Gerais</h3>
                            <div class="grid grid-3 mt-lg">
                                <div class="stat-item"><div class="stat-valor">128</div><div class="stat-label">Tarefas Concluídas</div></div>
                                <div class="stat-item"><div class="stat-valor">12</div><div class="stat-label">Dias de Streak</div></div>
                                <div class="stat-item"><div class="stat-valor">8</div><div class="stat-label">Conquistas</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    function renderizarPaginaConfiguracoes(container) {
        container.innerHTML = `
            <div class="cabecalho-pagina"><h1>Configurações</h1></div>
            <div class="card">
                <div class="card-body">
                    <div class="config-item">
                        <div>
                            <h4>Notificações por Email</h4>
                            <p style="font-size:0.9rem; color:var(--cor-texto-terciario)">Receber resumos e alertas no seu email.</p>
                        </div>
                        <input type="checkbox" class="checkbox-tarefa" checked>
                    </div>
                    <div class="config-item">
                        <div>
                            <h4>Tema Escuro</h4>
                            <p style="font-size:0.9rem; color:var(--cor-texto-terciario)">Atualmente ativo.</p>
                        </div>
                        <input type="checkbox" class="checkbox-tarefa" checked disabled>
                    </div>
                     <div class="config-item">
                        <div>
                            <h4>Exportar Dados</h4>
                            <p style="font-size:0.9rem; color:var(--cor-texto-terciario)">Faça o backup de todos os seus dados.</p>
                        </div>
                        <button class="btn btn-secundario"><i class="fas fa-download"></i> Exportar</button>
                    </div>
                </div>
            </div>
        `;
    }

    function renderizarPaginaPlaneamento(container, acoes) {
        const diasDaSemana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
        container.innerHTML = `
            <div class="cabecalho-pagina">
                <h1>Planeamento Semanal</h1>
                <div>${acoes}</div>
            </div>
            <div class="container-planeamento">
                ${diasDaSemana.map((dia, index) => `
                    <div class="dia-semana" style="border-top-color: hsl(${index * 50}, 70%, 50%)">
                        <div class="dia-semana-header">
                            <h4>${dia}</h4>
                        </div>
                        <div class="dia-semana-body">
                            ${index === 1 ? `
                                <div class="tarefa-planeamento" draggable="true" style="border-left-color: ${estado.pilares[0].cor};">Correr 20 min</div>
                                <div class="tarefa-planeamento" draggable="true" style="border-left-color: ${estado.pilares[1].cor};">Estudar Módulo 5</div>
                            ` : ''}
                             ${index === 2 ? `
                                <div class="tarefa-planeamento" draggable="true" style="border-left-color: ${estado.pilares[0].cor};">Treino de força</div>
                            ` : ''}
                            <div class="tarefa-planeamento-placeholder">
                                <i class="fas fa-plus"></i>
                                <p>Arraste tarefas aqui</p>
                            </div>
                        </div>
                    </div>
                `).join('')}
            </div>
        `;
    }

    function renderizarPaginaRelatorios(container, acoes) {
        container.innerHTML = `
            <div class="cabecalho-pagina">
                <h1>Relatórios e Análises</h1>
                <div>${acoes}</div>
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
                                <option value="30d" selected>Últimos 30 dias</option>
                                <option value="mes_atual">Este Mês</option>
                                <option value="mes_passado">Mês Passado</option>
                            </select>
                        </div>
                        <div class="campo-grupo">
                            <label class="campo-label">Pilar</label>
                            <select class="campo-select" id="filtro-relatorio-pilar">
                                <option value="todos">Todos os Pilares</option>
                                ${estado.pilares.map(p => `<option value="${p.id}">${p.nome}</option>`).join('')}
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
                         <!-- O sumário será injetado aqui -->
                     </div>
                    <canvas id="grafico-relatorio-produtividade" style="margin-top:20px;"></canvas>
                </div>
                 <div class="card-footer" style="justify-content:space-between; align-items:center;">
                    <p id="relatorio-data-geracao" style="font-size:0.9rem; color: var(--cor-texto-terciario)"></p>
                 </div>
            </div>
        `;
        atualizarVisaoRelatorio();
    }

    function renderizarPaginaEmConstrucao(container, acoes) {
        container.innerHTML = `
            <div class="cabecalho-pagina"><h1>Página em Construção</h1><div>${acoes}</div></div>
            <div class="card">
                <div class="card-body texto-centro" style="padding: 50px;">
                    <i class="fas fa-tools fa-3x" style="color: var(--cor-aviso); margin-bottom: 20px;"></i>
                    <h2>Em Breve</h2>
                    <p>Esta funcionalidade está a ser desenvolvida para melhorar a sua experiência.</p>
                </div>
            </div>
        `;
    }



    // ===== FUNÇÕES AUXILIARES DE RENDERIZAÇÃO =====
    function criarSecaoDia(titulo, tarefas) {
        if (tarefas.length === 0) return '';
        return `
            <div class="secao-dia">
                <h3>${titulo}</h3>
                <ul class="lista-tarefas">
                    ${tarefas.map(tarefa => criarItemTarefa(tarefa, false)).join('')}
                </ul>
            </div>
        `;
    }

    function criarItemTarefa(tarefa, mostrarData = false) {
        const microMeta = encontrarPorId(estado.microMetas, tarefa.microMetaId);
        const meta = microMeta ? encontrarPorId(estado.metas, microMeta.metaId) : null;
        const pilar = meta ? encontrarPorId(estado.pilares, meta.pilarId) : null;
        return `
            <li class="item-tarefa ${tarefa.concluida ? 'concluida' : ''}" style="border-left-color: ${pilar ? pilar.cor : '#ccc'}">
                <input type="checkbox" class="checkbox-tarefa" data-acao="alternar-tarefa" data-id="${tarefa.id}" ${tarefa.concluida ? 'checked' : ''}>
                <div class="info-tarefa">
                    <div class="titulo-tarefa">${tarefa.nome}</div>
                    <div class="detalhes-tarefa">${microMeta ? microMeta.nome : 'Sem micro-meta'}</div>
                </div>
                <div class="horario-tarefa">
                    ${mostrarData ? `<span>${formatarData(tarefa.data)}</span>` : ''}
                    ${tarefa.horario ? `<span>${tarefa.horario}</span>` : ''}
                </div>
            </li>
        `;
    }

    function renderizarGraficoDonutPilares() {
        const ctx = document.getElementById('grafico-pilares-donut')?.getContext('2d');
        if (!ctx) return;

        const labels = estado.pilares.map(p => p.nome);
        const data = estado.pilares.map(pilar => {
            const metasDoPilar = estado.metas.filter(m => m.pilarId === pilar.id).map(m => m.id);
            const microMetasDoPilar = estado.microMetas.filter(mm => metasDoPilar.includes(mm.metaId)).map(mm => mm.id);
            return estado.tarefas.filter(t => microMetasDoPilar.includes(t.microMetaId) && t.concluida).length;
        });
        const colors = estado.pilares.map(p => p.cor);

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Tarefas Concluídas',
                    data: data,
                    backgroundColor: colors,
                    borderColor: 'var(--cor-fundo-secundario)',
                    borderWidth: 3
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'top', labels: { color: 'white' } } } }
        });
    }

    function renderizarGraficoLinhaProgresso() {
        const ctx = document.getElementById('grafico-progresso-linha')?.getContext('2d');
        if (!ctx) return;
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['D-6', 'D-5', 'D-4', 'D-3', 'D-2', 'Ontem', 'Hoje'],
                datasets: [{
                    label: 'Tarefas Concluídas',
                    data: [5, 6, 4, 7, 5, 8, estado.tarefas.filter(t=>t.data === hojeString() && t.concluida).length],
                    borderColor: 'var(--cor-primaria)',
                    backgroundColor: 'rgba(107, 70, 193, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { color: 'white' } }, x: { ticks: { color: 'white' } } } }
        });
    }

    function renderizarGraficoRadarPilares() {
        const ctx = document.getElementById('grafico-pilares-radar')?.getContext('2d');
        if (!ctx) return;
        const labels = estado.pilares.map(p => p.nome);
        const data = estado.pilares.map(pilar => {
             const metasDoPilar = estado.metas.filter(m => m.pilarId === pilar.id).map(m => m.id);
            const microMetasDoPilar = estado.microMetas.filter(mm => metasDoPilar.includes(mm.metaId)).map(mm => mm.id);
            return estado.tarefas.filter(t => microMetasDoPilar.includes(t.microMetaId)).length; // Total de tarefas planejadas
        });
        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nº de Tarefas Planejadas',
                    data: data,
                    borderColor: 'var(--cor-sucesso)',
                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
                }]
            },
            options: { responsive: true, scales: { r: { ticks: { backdropColor: 'transparent', color: 'white' }, pointLabels: { color: 'white' }, grid: { color: 'rgba(255,255,255,0.2)' } } }, plugins: { legend: { labels: { color: 'white' } } } }
        });
    }

    function atualizarVisaoRelatorio() {
        const periodoEl = document.getElementById('filtro-relatorio-periodo');
        const pilarEl = document.getElementById('filtro-relatorio-pilar');
        const tipoEl = document.getElementById('filtro-relatorio-tipo');
        if(!periodoEl || !pilarEl || !tipoEl) return;

        const pilarId = pilarEl.value;

        // 1. Atualizar Título
        const pilarSelecionado = estado.pilares.find(p => p.id == pilarId);
        const tituloPilar = pilarId === 'todos' ? 'Geral' : pilarSelecionado.nome;
        document.getElementById('relatorio-titulo').innerHTML = `<i class="fas fa-chart-bar"></i> Produtividade: ${tituloPilar}`;

        // 2. Simular novos dados com base nos filtros
        const tarefasConcluidas = Math.floor(Math.random() * (50 - 20 + 1)) + 20;
        const totalTarefas = tarefasConcluidas + Math.floor(Math.random() * 10);
        const taxaSucesso = totalTarefas > 0 ? ((tarefasConcluidas / totalTarefas) * 100).toFixed(1) : 0;
        const pilarMaisForte = estado.pilares[Math.floor(Math.random()*estado.pilares.length)].nome;

        // 3. Atualizar Sumário
        const sumarioContainer = document.getElementById('relatorio-sumario');
        sumarioContainer.innerHTML = `
            <div class="stat-item"><div class="stat-valor">${tarefasConcluidas}</div><div class="stat-label">Tarefas Concluídas</div></div>
            <div class="stat-item"><div class="stat-valor">${taxaSucesso}%</div><div class="stat-label">Taxa de Sucesso</div></div>
            <div class="stat-item"><div class="stat-valor">${pilarMaisForte}</div><div class="stat-label">Pilar de Destaque</div></div>
        `;

        document.getElementById('relatorio-data-geracao').textContent = `Relatório gerado em: ${new Date().toLocaleString('pt-BR')}`;

        // 4. Atualizar Gráfico
        const labels = ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'];
        const dataConcluidas = labels.map(() => Math.floor(Math.random() * (15 - 5 + 1)) + 5);
        const dataPlaneadas = dataConcluidas.map(v => v + Math.floor(Math.random() * 3));
        renderizarGraficoRelatorio(labels, dataConcluidas, dataPlaneadas);
    }

    function renderizarGraficoRelatorio(labels, dataConcluidas, dataPlaneadas) {
        const ctx = document.getElementById('grafico-relatorio-produtividade')?.getContext('2d');
        if (!ctx) return;

        if(window.graficoRelatorio instanceof Chart) {
            window.graficoRelatorio.destroy();
        }

        window.graficoRelatorio = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels || ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'],
                datasets: [{
                    label: 'Tarefas Concluídas',
                    data: dataConcluidas || [25, 32, 28, 35],
                    backgroundColor: 'var(--cor-sucesso)',
                }, {
                    label: 'Tarefas Planeadas',
                    data: dataPlaneadas || [30, 35, 32, 40],
                    backgroundColor: 'var(--cor-hover)',
                }]
            },
            options: { responsive: true, plugins: { legend: { labels: { color: 'white' } } }, scales: { y: { beginAtZero: true, ticks: { color: 'white' } }, x: { ticks: { color: 'white' } } } }
        });
    }


    // ===== LÓGICA DE CRUD (SIMULADA) =====

    function getArrayPorTipo(tipo) {
        if (tipo === 'subcategoria') return estado.subCategorias;
        if (tipo === 'micrometa') return estado.microMetas;
        return estado[tipo + 's'];
    }

    function salvarPilar(dados) {
        if (dados.id) { // Atualização
            const indice = estado.pilares.findIndex(p => p.id == dados.id);
            if (indice > -1) Object.assign(estado.pilares[indice], dados);
        } else { // Criação
            const novoId = Math.max(0, ...estado.pilares.map(p => p.id), ...estado.pilaresOpcionais.map(p => p.id)) + 1;
            estado.pilares.push({ ...dados, id: novoId });
        }
        renderizarPagina();
        notificacao('Sucesso!', 'Pilar salvo com sucesso.', 'success');
    }

    function excluirPilar(id) {
        // Lógica de exclusão em cascata...
        renderizarPagina();
        notificacao('Excluído!', 'Pilar e todos os seus dados associados foram excluídos.', 'success');
    }

    function salvarMeta(dados) {
        if (dados.id) { // Atualização
            const indice = estado.metas.findIndex(m => m.id == dados.id);
            if (indice > -1) Object.assign(estado.metas[indice], dados);
        } else { // Criação
            const novoId = Math.max(0, ...estado.metas.map(m => m.id)) + 1;
            estado.metas.push({ ...dados, id: novoId });
        }
        renderizarPagina();
        notificacao('Sucesso!', 'Meta salva com sucesso.', 'success');
    }

    function excluirMeta(id) {
        // Lógica de exclusão em cascata...
        renderizarPagina();
        notificacao('Excluído!', 'Meta e seus dados associados foram excluídos.', 'success');
    }

    function salvarItem(tipo, dados) {
        const array = getArrayPorTipo(tipo);
        if (!array) return;

        if (dados.id) {
            const indice = array.findIndex(i => i.id == dados.id);
            if (indice > -1) Object.assign(array[indice], dados);
        } else {
            const novoId = Math.max(0, ...array.map(i => i.id).filter(Number.isFinite)) + 1;
            array.push({ ...dados, id: novoId });
        }
        renderizarPagina();
        notificacao('Sucesso!', `${tipo.charAt(0).toUpperCase() + tipo.slice(1)} salvo com sucesso.`, 'success');
    }

    function excluirItem(tipo, id) {
        const array = getArrayPorTipo(tipo);
        if (!array) return;

        const novoArray = array.filter(i => i.id != id);

        if (tipo === 'subcategoria') {
            estado.subCategorias = novoArray;
        } else if (tipo === 'micrometa') {
            estado.microMetas = novoArray;
            estado.tarefas = estado.tarefas.filter(t => t.microMetaId != id);
        } else if (tipo === 'categoria') {
            estado.categorias = novoArray;
            estado.subCategorias = estado.subCategorias.filter(sc => sc.categoriaId != id);
        } else {
            estado[tipo + 's'] = novoArray;
        }

        renderizarPagina();
        notificacao('Excluído!', 'Item excluído.', 'success');
    }

    function salvarTarefa(dados) {
        if (dados.id) {
            const indice = estado.tarefas.findIndex(t => t.id == dados.id);
            if (indice > -1) Object.assign(estado.tarefas[indice], dados);
        } else {
            const novoId = Math.max(0, ...estado.tarefas.map(t => t.id)) + 1;
            estado.tarefas.push({ ...dados, id: novoId, concluida: false });
        }
        renderizarPagina();
        notificacao('Sucesso!', 'Tarefa salva com sucesso.', 'success');
    }

    function alternarStatusTarefa(id) {
        const tarefa = encontrarPorId(estado.tarefas, id);
        if (tarefa) tarefa.concluida = !tarefa.concluida;
        renderizarPagina();
    }

    // ===== MANIPULADORES DE EVENTOS =====

    document.querySelector('.menu-navegacao').addEventListener('click', e => {
        const link = e.target.closest('.link-navegacao');
        if (link) {
            e.preventDefault();
            estado.paginaAtual = link.dataset.pagina;
            renderizarPagina();
            if(window.innerWidth <= 768) menuLateral.classList.remove('aberto');
        }

        const grupoTitulo = e.target.closest('.grupo-titulo');
        if (grupoTitulo) {
            grupoTitulo.parentElement.classList.toggle('recolhido');
        }
    });

    document.body.addEventListener('click', (e) => {
        const alvo = e.target.closest('[data-acao]');
        if (!alvo) return;

        const acao = alvo.dataset.acao;
        const id = alvo.dataset.id;

        const acoes = {
            'abrir-modal': () => abrirModal(alvo.dataset.modalId),
            'editar-pilar': () => preencherModalPilar(id),
            'excluir-pilar': () => confirmarExclusao('pilar', id),
            'editar-meta': () => preencherModalMeta(id),
            'excluir-meta': () => confirmarExclusao('meta', id),
            'ver-categoria': () => { estado.paginaAtual = 'categoria'; estado.paginaDetalheId = id; renderizarPagina(); },
            'editar-item': () => preencherModalEdicaoItem(alvo.dataset.tipo, id),
            'excluir-item': () => confirmarExclusao(alvo.dataset.tipo, id),
            'alternar-tarefa': () => {
                if(e.target.tagName === 'INPUT') alternarStatusTarefa(id);
            },
            'mes-anterior': () => {
                if (estado.mesCalendario === 0) { estado.mesCalendario = 11; estado.anoCalendario--; }
                else { estado.mesCalendario--; }
                renderizarPagina();
            },
            'mes-seguinte': () => {
                if (estado.mesCalendario === 11) { estado.mesCalendario = 0; estado.anoCalendario++; }
                else { estado.mesCalendario++; }
                renderizarPagina();
            },
            'sugestoes-planeamento': () => {
                Swal.fire({
                    title: 'Sugestão de Planeamento',
                    html: `Com base no seu histórico, sugerimos focar em <strong>Saúde</strong> amanhã e <strong>Educação</strong> na quarta-feira.<br><br>Deseja adicionar tarefas relacionadas?`,
                    icon: 'info', showCancelButton: true, confirmButtonText: 'Sim, adicionar!', cancelButtonText: 'Não, obrigado',
                    background: 'var(--cor-fundo-secundario)', color: 'var(--cor-texto-principal)'
                });
            },
             'exportar-relatorio': () => notificacao('Em desenvolvimento', 'A funcionalidade de exportação de relatórios estará disponível em breve.', 'info')
        };

        if (acoes[acao]) {
            e.preventDefault();
            acoes[acao]();
        }
    });

    document.body.addEventListener('submit', e => {
        const form = e.target;
        if (!form.matches('form[data-acao]')) return;
        e.preventDefault();

        const acao = form.dataset.acao;
        const input = form.querySelector('input[type="text"]');

        if (acao === 'add-categoria') {
            salvarItem('categoria', { pilarId: parseInt(form.dataset.pilarId), nome: input.value });
        }
        if (acao === 'add-micrometa') {
            salvarItem('microMeta', { metaId: parseInt(form.dataset.metaId), nome: input.value });
        }
        if (acao === 'add-subcategoria') {
            salvarItem('subCategoria', { categoriaId: parseInt(form.dataset.categoriaId), nome: input.value });
        }
        form.reset();
    });

    containerPagina.addEventListener('change', e => {
        if (e.target.matches('#filtro-relatorio-periodo, #filtro-relatorio-pilar, #filtro-relatorio-tipo')) {
            atualizarVisaoRelatorio();
        }
    });

    document.querySelectorAll('.btn-fechar-modal').forEach(btn => {
        btn.addEventListener('click', () => fecharModal(btn.dataset.modalId));
    });
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', e => {
            if (e.target === modal) fecharModal(modal.id);
        });
    });

    document.getElementById('formulario-pilar').addEventListener('submit', (e) => {
        e.preventDefault();
        const dados = {
            id: document.getElementById('pilar-id').value,
            nome: document.getElementById('pilar-nome').value,
            descricao: document.getElementById('pilar-descricao').value,
            cor: document.getElementById('pilar-cor').value,
        };
        salvarPilar(dados);
        fecharModal('modal-pilar');
    });

    document.getElementById('formulario-meta').addEventListener('submit', (e) => {
        e.preventDefault();
        const dados = {
            id: document.getElementById('meta-id').value,
            nome: document.getElementById('meta-nome').value,
            pilarId: parseInt(document.getElementById('meta-pilar').value),
            dataInicio: document.getElementById('meta-data-inicio').value,
            dataFim: document.getElementById('meta-data-fim').value,
        };
        salvarMeta(dados);
        fecharModal('modal-meta');
    });

    document.getElementById('formulario-tarefa').addEventListener('submit', (e) => {
        e.preventDefault();
        const dados = {
            id: document.getElementById('tarefa-id').value,
            nome: document.getElementById('tarefa-nome').value,
            microMetaId: parseInt(document.getElementById('tarefa-micrometa').value),
            data: document.getElementById('tarefa-data').value,
            tipo: document.getElementById('tarefa-tipo').value,
            horario: document.getElementById('tarefa-tipo').value === 'horario' ? document.getElementById('tarefa-horario').value : null,
        };
        salvarTarefa(dados);
        fecharModal('modal-tarefa');
    });

    document.getElementById('formulario-edicao-item').addEventListener('submit', e => {
        e.preventDefault();
        const id = document.getElementById('edicao-item-id').value;
        const tipo = document.getElementById('edicao-item-tipo').value;
        const nome = document.getElementById('edicao-item-nome').value;
        salvarItem(tipo, { id, nome });
        fecharModal('modal-edicao-item');
    });

    document.getElementById('tarefa-tipo').addEventListener('change', (e) => {
        document.getElementById('campo-horario-fixo').classList.toggle('display-none', e.target.value !== 'horario');
    });

    document.getElementById('botao-hamburguer').addEventListener('click', () => {
        menuLateral.classList.toggle('aberto');
    });

    // ===== FUNÇÕES DE MODAL E FORMULÁRIOS =====
    function abrirModal(id) {
        if (id === 'modal-pilar') {
            document.getElementById('modal-pilar-titulo').textContent = 'Novo Pilar';
            document.getElementById('formulario-pilar').reset();
            document.getElementById('pilar-id').value = '';
        } else if (id === 'modal-meta') {
            document.getElementById('modal-meta-titulo').textContent = 'Nova Meta';
            document.getElementById('formulario-meta').reset();
            document.getElementById('meta-id').value = '';
            preencherSelect('meta-pilar', estado.pilares);
        } else if (id === 'modal-tarefa') {
            document.getElementById('modal-tarefa-titulo').textContent = 'Nova Tarefa';
            document.getElementById('formulario-tarefa').reset();
            document.getElementById('tarefa-id').value = '';
            document.getElementById('tarefa-data').value = hojeString();
            preencherSelect('tarefa-micrometa', estado.microMetas);
            document.getElementById('campo-horario-fixo').classList.add('display-none');
        }
        document.getElementById(id).classList.add('visivel');
    }

    function fecharModal(id) {
        document.getElementById(id).classList.remove('visivel');
    }

    function preencherModalPilar(id) {
        const pilar = encontrarPorId(estado.pilares, id);
        if (pilar) {
            document.getElementById('modal-pilar-titulo').textContent = 'Editar Pilar';
            document.getElementById('pilar-id').value = pilar.id;
            document.getElementById('pilar-nome').value = pilar.nome;
            document.getElementById('pilar-descricao').value = pilar.descricao;
            document.getElementById('pilar-cor').value = pilar.cor;
            abrirModal('modal-pilar');
        }
    }

    function preencherModalMeta(id) {
        const meta = encontrarPorId(estado.metas, id);
        if (meta) {
            document.getElementById('modal-meta-titulo').textContent = 'Editar Meta';
            preencherSelect('meta-pilar', estado.pilares, meta.pilarId);
            document.getElementById('meta-id').value = meta.id;
            document.getElementById('meta-nome').value = meta.nome;
            document.getElementById('meta-data-inicio').value = meta.dataInicio;
            document.getElementById('meta-data-fim').value = meta.dataFim;
            abrirModal('modal-meta');
        }
    }

    function preencherModalEdicaoItem(tipo, id) {
        const array = getArrayPorTipo(tipo);
        const item = encontrarPorId(array, id);

        if(item) {
            const tipoCapitalizado = tipo === 'micrometa' ? 'Micro-meta' : tipo.charAt(0).toUpperCase() + tipo.slice(1);
            document.getElementById('modal-edicao-titulo').textContent = `Editar ${tipoCapitalizado}`;
            document.getElementById('edicao-item-id').value = item.id;
            document.getElementById('edicao-item-tipo').value = tipo;
            document.getElementById('edicao-item-nome').value = item.nome;
            abrirModal('modal-edicao-item');
        }
    }

    // ===== LÓGICA DE ONBOARDING =====
    function renderizarEtapaOnboarding() {
        const { etapaAtual } = estado.onboarding;

        // Atualiza os indicadores de passo (stepper)
        document.querySelectorAll('.onboarding-step').forEach((el, index) => {
            el.classList.toggle('ativo', index + 1 === etapaAtual);
        });

        // Mostra o conteúdo da etapa atual e esconde os outros
        document.querySelectorAll('.step-content').forEach((el, index) => {
            el.classList.toggle('ativo', index + 1 === etapaAtual);
        });

        const btnAnterior = document.getElementById('btn-onboarding-anterior');
        const btnProximo = document.getElementById('btn-onboarding-proximo');

        btnAnterior.classList.toggle('display-none', etapaAtual === 1);
        btnProximo.innerHTML = 'Próximo <i class="fas fa-arrow-right"></i>';

        if (etapaAtual === 3) {
            // Carrega o conteúdo para a etapa de categorias
            const container = document.getElementById('configuracao-categorias-iniciais');
            const pilaresSelecionados = [...estado.pilares.filter(p => p.obrigatorio), ...estado.onboarding.pilaresSelecionados];
            container.innerHTML = pilaresSelecionados.map(p => `
                <div class="pilar-categoria-setup">
                    <h5 style="color: ${p.cor};">${p.nome}</h5>
                    <div class="form-add-subitem">
                        <input type="text" class="campo-input" placeholder="Nova categoria para ${p.nome}..." data-pilar-id-onboarding="${p.id}">
                    </div>
                </div>
            `).join('');
        }

        if (etapaAtual === 4) {
            btnProximo.innerHTML = 'Concluir <i class="fas fa-check"></i>';
        }
    }

    function navegarOnboarding(direcao) {
        let { etapaAtual } = estado.onboarding;
        if (direcao === 'proximo' && etapaAtual < 4) {
            estado.onboarding.etapaAtual++;
        } else if (direcao === 'anterior' && etapaAtual > 1) {
            estado.onboarding.etapaAtual--;
        }
        renderizarEtapaOnboarding();
    }

    function iniciarOnboarding() {
        if (localStorage.getItem('avancarOnboardingConcluido')) return;

        // Etapa 1: Pilares Opcionais
        const containerSelecao = document.getElementById('selecao-pilares-opcionais');
        containerSelecao.innerHTML = estado.pilaresOpcionais.map(pilar => `
            <div class="card card-clicavel" data-pilar-opcional-id="${pilar.id}">
                <div class="card-body texto-centro">
                    <h4 style="color:${pilar.cor};"><i class="fas fa-stream"></i> ${pilar.nome}</h4>
                    <p style="font-size: 0.8rem;">${pilar.descricao}</p>
                </div>
            </div>
        `).join('');

        // Etapa 2: Pilar Global
        const containerGlobal = document.getElementById('configuracao-pilar-global');
        containerGlobal.innerHTML = estado.tarefasGlobaisPredefinidas.map(tarefa => `
            <div class="tarefa-global-item">
                <label for="${tarefa.id}">${tarefa.nome}</label>
                <div class="campo-grupo">
                    <input type="${tarefa.tipo === 'horario' ? 'time' : 'hidden'}" id="${tarefa.id}" value="${tarefa.horario || ''}" class="campo-input">
                </div>
            </div>
        `).join('');

        renderizarEtapaOnboarding();
        abrirModal('modal-onboarding');
    }

    function concluirOnboarding() {
        // 1. Processar Pilares Opcionais
        estado.onboarding.pilaresSelecionados.forEach(pilar => {
             if(!encontrarPorId(estado.pilares, pilar.id)) estado.pilares.push(pilar);
        });

        // 2. Processar Tarefas do Pilar Global
        const pilarGlobalId = estado.pilares.find(p => p.nome === 'Global/Básico').id;
        const microMetaGlobal = { id: Math.max(0, ...estado.microMetas.map(m => m.id)) + 1, metaId: null, nome: 'Rotina Diária' };
        estado.microMetas.push(microMetaGlobal);

        document.querySelectorAll('#configuracao-pilar-global .tarefa-global-item input').forEach(input => {
            const tarefaPredefinida = estado.tarefasGlobaisPredefinidas.find(t => t.id === input.id);
            if (tarefaPredefinida && (!input.value || input.type === 'hidden')) {
                const novaTarefa = {
                    id: Math.max(0, ...estado.tarefas.map(t => t.id)) + 1,
                    microMetaId: microMetaGlobal.id,
                    nome: tarefaPredefinida.nome,
                    data: null, // Será recorrente
                    tipo: tarefaPredefinida.tipo,
                    horario: input.value || null,
                    concluida: false
                };
                // Aqui seria a lógica para adicionar como tarefa recorrente. Para o mock, vamos apenas logar.
                console.log("Adicionar tarefa global recorrente:", novaTarefa);
            }
        });

        // 3. Processar Categorias Iniciais
        document.querySelectorAll('#configuracao-categorias-iniciais input').forEach(input => {
            if (input.value.trim() !== '') {
                const novaCategoria = {
                    id: Math.max(0, ...estado.categorias.map(c => c.id)) + 1,
                    pilarId: parseInt(input.dataset.pilarIdOnboarding),
                    nome: input.value.trim()
                };
                estado.categorias.push(novaCategoria);
            }
        });

        localStorage.setItem('avancarOnboardingConcluido', 'true');
        fecharModal('modal-onboarding');
        renderizarPagina(); // Re-renderiza a página com os novos dados
        notificacao('Tudo pronto!', 'Sua jornada no Avançar começa agora.', 'success');
    }

    document.getElementById('selecao-pilares-opcionais').addEventListener('click', e => {
        const card = e.target.closest('.card');
        if(!card) return;
        card.classList.toggle('ativo');

        const pilarId = parseInt(card.dataset.pilarOpcionalId);
        const pilar = estado.pilaresOpcionais.find(p => p.id === pilarId);

        if (card.classList.contains('ativo')) {
            estado.onboarding.pilaresSelecionados.push(pilar);
        } else {
            estado.onboarding.pilaresSelecionados = estado.onboarding.pilaresSelecionados.filter(p => p.id !== pilarId);
        }
    });

    document.getElementById('btn-onboarding-proximo').addEventListener('click', () => {
        if (estado.onboarding.etapaAtual === 4) {
            concluirOnboarding();
        } else {
            navegarOnboarding('proximo');
        }
    });
    document.getElementById('btn-onboarding-anterior').addEventListener('click', () => navegarOnboarding('anterior'));


    // ===== FUNÇÕES UTILITÁRIAS =====
    function atualizarLinkAtivo() {
        linksNavegacao.forEach(link => {
            const isAtivo = link.dataset.pagina === estado.paginaAtual || (estado.paginaAtual === 'categoria' && link.dataset.pagina === 'pilares');
            link.classList.toggle('ativo', isAtivo);
        });
    }

    function encontrarPorId(array, id) {
        if (!array || !Array.isArray(array)) return undefined;
        return array.find(item => item.id == id);
    }

    function preencherSelect(selectId, dados, valorSelecionado = null) {
        const select = document.getElementById(selectId);
        if(!select) return;
        select.innerHTML = `<option value="">Selecione...</option>`;
        dados.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.nome;
            if (item.id == valorSelecionado) option.selected = true;
            select.appendChild(option);
        });
    }

    function formatarData(dataString) {
        if(!dataString) return '';
        const [ano, mes, dia] = dataString.split('-');
        return `${dia}/${mes}/${ano}`;
    }

    function notificacao(titulo, texto, icone) {
        Swal.fire({
            title: titulo, text: texto, icon: icone, toast: true, position: 'top-end',
            showConfirmButton: false, timer: 3000, timerProgressBar: true,
            background: 'var(--cor-fundo-secundario)', color: 'var(--cor-texto-principal)'
        });
    }

    function confirmarExclusao(tipo, id) {
        Swal.fire({
            title: 'Você tem certeza?', text: `Esta ação não pode ser revertida!`, icon: 'warning',
            showCancelButton: true, confirmButtonColor: 'var(--cor-erro)', cancelButtonColor: 'var(--cor-hover)',
            confirmButtonText: 'Sim, excluir!', cancelButtonText: 'Cancelar',
            background: 'var(--cor-fundo-secundario)', color: 'var(--cor-texto-principal)'
        }).then((resultado) => {
            if (resultado.isConfirmed) {
                excluirItem(tipo, id);
            }
        });
    }

    // ===== INICIALIZAÇÃO =====
    renderizarPagina();
    iniciarOnboarding();

});
